<?php

require_once __DIR__ . '/../Repositories/classeRepository.php';
require_once __DIR__ . '/../Repositories/niveauRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_creationClasse(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }
    $connexion = getDatabaseConnection();
    $niveaux = getAllNiveaux($connexion);
    $nom_classe = '';
    $id_niveau  = '';
    $errors     = [];
    if ($req->getMethod() === 'POST') {

        $nom_classe = trim($_POST['nom_classe'] ?? '');
        $id_niveau  = trim($_POST['id_niveau'] ?? '');
        if ($nom_classe === '') {
            $errors['nom_classe'] = 'Le nom de la classe est requis.';
        }
        if ($id_niveau === '') {
            $errors['id_niveau'] = 'Le niveau est requis.';
        } else {
            $idsNiveauxValides = array_map('strval', array_column($niveaux, 'id_niveau'));

            if (!in_array((string)$id_niveau, $idsNiveauxValides, true)) {
                $errors['id_niveau'] = 'Le niveau sélectionné est invalide.';
            }
        }

        if (empty($errors)) {
            $classeExistante = findClasseByNom($connexion, $nom_classe);

            if ($classeExistante) {
                $errors['nom_classe'] = 'Une classe avec ce nom existe déjà.';
            } else {

                $nouvelleClasse = [
                    'nom_classe' => $nom_classe,
                    'id_niveau'  => $id_niveau,
                ];

                $classe = createClasse($connexion, $nouvelleClasse);

                if ($classe) {
                    $_SESSION['success_message'] = 'La classe a bien été créée.';
                    $res->redirect('index.php?action=listeClasse');
                    return;
                }
                $errors['general'] = 'Une erreur est survenue lors de la création de la classe.';
            }
        }
    }
    $res->view('Gestions/creationClasse.php', [
        'nom_classe' => $nom_classe,
        'id_niveau'  => $id_niveau,
        'errors'     => $errors,
        'niveaux'    => $niveaux,
    ]);
}
