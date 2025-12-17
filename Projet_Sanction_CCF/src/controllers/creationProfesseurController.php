<?php

require_once __DIR__ . '/../Repositories/professeurRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_creationProfesseur(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $connexion = getDatabaseConnection();

    $prenom_professeur = '';
    $nom_professeur    = '';
    $matiere_professeur = '';
    $errors           = [];

    if ($req->getMethod() === 'POST') {
        $prenom_professeur = trim($_POST['prenom_professeur'] ?? '');
        $nom_professeur    = trim($_POST['nom_professeur'] ?? '');
        $matiere_professeur = trim($_POST['matiere_professeur'] ?? '');

        if ($prenom_professeur === '') {
            $errors['prenom_professeur'] = 'Le prénom du professeur est requis.';
        } elseif (strlen($prenom_professeur) < 2 || strlen($prenom_professeur) > 50) {
            $errors['prenom_professeur'] = 'Le prénom du professeur doit contenir entre 2 et 50 caractères.';
        }

        if ($nom_professeur === '') {
            $errors['nom_professeur'] = 'Le nom du professeur est requis.';
        } elseif (strlen($nom_professeur) < 2 || strlen($nom_professeur) > 50) {
            $errors['nom_professeur'] = 'Le nom du professeur doit contenir entre 2 et 50 caractères.';
        }

        if ($matiere_professeur === '') {
            $errors['matiere_professeur'] = 'La matière du professeur est requise.';
        }

        if (empty($errors)) {
            $professeurData = [
                'prenom_professeur' => $prenom_professeur,
                'nom_professeur'    => $nom_professeur,
                'matiere_professeur' => $matiere_professeur
            ];

            $newProfesseurId = createProfesseur($connexion, $professeurData);

            if ($newProfesseurId !== false) {
                $_SESSION['success_message'] = 'Le professeur a bien été créé.';
                $res->redirect('index.php?action=listeProfesseur');
                return;
            } else {
                $errors['general'] = 'Une erreur est survenue lors de la création du professeur. Veuillez réessayer.';
            }
        }
    }
    $res->view('Gestions/creationProfesseur.php', [
        'prenom_professeur' => $prenom_professeur,
        'nom_professeur'    => $nom_professeur,
        'matiere_professeur' => $matiere_professeur,
        'errors'           => $errors,
    ]);
}
