<?php

require_once __DIR__ . '/../Repositories/classeRepository.php';
require_once __DIR__ . '/../Repositories/eleveRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_creationEleve(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $connexion = getDatabaseConnection();
    $classes = getAllClasses($connexion);

    $prenom_eleve   = '';
    $nom_eleve      = '';
    $id_classe      = '';
    $date_naissance = '';
    $errors         = [];

    if ($req->getMethod() === 'POST') {

        $nom_eleve      = trim($_POST['nom_eleve'] ?? '');
        $prenom_eleve   = trim($_POST['prenom_eleve'] ?? '');
        $date_naissance = trim($_POST['date_naissance'] ?? '');
        $id_classe      = trim($_POST['id_classe'] ?? '');
        if ($prenom_eleve === '') {
            $errors['prenom_eleve'] = 'Le prénom de l\'élève est requis.';
        }
        if ($nom_eleve === '') {
            $errors['nom_eleve'] = 'Le nom de l\'élève est requis.';
        }
        $date_naissance_sql = null;
        if ($date_naissance === '') {
            $errors['date_naissance'] = 'La date de naissance est requise.';
        } else {
            if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_naissance)) {
                $errors['date_naissance'] = 'Le format de la date de naissance est invalide. Utilisez JJ/MM/AAAA.';
            } else {
                [$jour, $mois, $annee] = explode('/', $date_naissance);

                if (!checkdate((int)$mois, (int)$jour, (int)$annee)) {
                    $errors['date_naissance'] = 'La date de naissance est invalide.';
                } else {
                    $date_naissance_sql = sprintf('%04d-%02d-%02d', $annee, $mois, $jour);
                }
            }
        }


        if ($id_classe === '') {
            $errors['id_classe'] = 'La classe est requise.';
        } else {
            $idsClassesValides = array_map(
                'strval',
                array_column($classes, 'id_classe')
            );
            if (!in_array((string)$id_classe, $idsClassesValides, true)) {
                $errors['id_classe'] = 'La classe sélectionnée est invalide.';
            }
        }

        if (empty($errors)) {
            $eleveData = [
                'prenom_eleve'   => $prenom_eleve,
                'nom_eleve'      => $nom_eleve,
                'date_naissance' => $date_naissance_sql,
                'id_classe'      => (int)$id_classe,
            ];

            $newEleveId = createEleve($connexion, $eleveData);

            if ($newEleveId !== false && $newEleveId !== null) {
                $res->redirect('index.php?action=listeEleves');
                return;
            } else {
                $errors['general'] = 'Une erreur est survenue lors de la création de l\'élève. Veuillez réessayer.';
            }
        }
    }

    $res->view('Gestions/creationEleve.php', [
        'prenom_eleve'   => $prenom_eleve,
        'nom_eleve'      => $nom_eleve,
        'date_naissance' => $date_naissance,
        'id_classe'      => $id_classe,
        'classes'        => $classes,
        'errors'         => $errors,
    ]);
}
