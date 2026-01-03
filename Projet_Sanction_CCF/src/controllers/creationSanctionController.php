<?php

require_once __DIR__ . '/../Repositories/eleveRepository.php';
require_once __DIR__ . '/../Repositories/professeurRepository.php';
require_once __DIR__ . '/../Repositories/sanctionsRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_creationSanction(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $connexion = getDatabaseConnection();

    $eleves = getAllEleves($connexion);

    $professeurs = getAllProfesseurs($connexion);

    $id_eleve = '';
    $id_prof = '';
    $id_type = '';
    $date_incident = '';
    $motif = '';
    $errors = [];

    $stmt = $connexion->query("SELECT id_sanction, type_sanction FROM type_sanctions ORDER BY type_sanction");
    $types = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_eleve = $_POST['id_eleve'] ?? '';
        $id_prof = $_POST['id_prof'] ?? '';
        $id_type = $_POST['id_type'] ?? '';
        $date_incident = $_POST['date_incident'] ?? '';
        $motif = $_POST['motif'] ?? '';

        if (empty($id_eleve)) {
            $errors['id_eleve'] = "L'élève est obligatoire.";
        }
        if (empty($id_prof)) {
            $errors['id_prof'] = "Le professeur est obligatoire.";
        }
        if (empty($id_type) || (int)$id_type <= 0) {
            $errors['id_type'] = "Le type de sanction est obligatoire et doit être valide.";
        }
        if (empty($date_incident)) {
            $errors['date_incident'] = "La date de l'incident est obligatoire.";
        }
        if (empty($motif)) {
            $errors['motif'] = "Le motif est obligatoire.";
        }

        if (empty($errors)) {
            $sanctionData = [
                'type_sanction' => (int)$id_type,
                'date_sanction' => $date_incident,
                'id_eleve' => (int)$id_eleve,
                'id_professeur' => (int)$id_prof,
                'motif_sanction' => $motif,
            ];

            $result = createSanction($connexion, $sanctionData);
            if ($result !== false) {
                $res->redirect('index.php?action=listeSanctions');
                return;
            } else {
                $errors['general'] = "Erreur lors de l'enregistrement de la sanction. Vérifiez les données ou contactez l'administrateur.";
            }
        }
    }

    $res->view('Gestions/creationSanction.php', [
        'eleves' => $eleves,
        'professeurs' => $professeurs,
        'types' => $types,
        'id_eleve' => $id_eleve,
        'id_prof' => $id_prof,
        'id_type' => $id_type,
        'date_incident' => $date_incident,
        'motif' => $motif,
        'errors' => $errors,
    ]);
}
