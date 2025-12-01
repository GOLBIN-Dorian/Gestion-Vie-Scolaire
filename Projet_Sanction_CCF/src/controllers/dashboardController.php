<?php

use App\Http\Request;
use App\Http\Response;

function action_dashboard(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si l'utilisateur n'est pas connecté
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    // Connexion BDD
    $connexion = getDatabaseConnection();

    // Récupération du total des classes
    $totalClasses = getTotalClasses($connexion);
    $totalEleves  = getTotalEleves($connexion);

    // Infos utilisateur
    $user   = $_SESSION['user'];
    $nom    = $user['nom']    ?? '';
    $prenom = $user['prenom'] ?? '';
    $email  = $user['email']  ?? '';

    // Message de succès après connexion (flash)
    $success_dashboard = $_SESSION['success_dashboard'] ?? null;
    unset($_SESSION['success_dashboard']); // on le consomme une fois

    // Passage à la vue
    $res->view('Gestions/dashboard.php', [
        'user'             => $user,
        'nom'              => $nom,
        'prenom'           => $prenom,
        'email'            => $email,
        'totalClasses'     => $totalClasses,
        'totalEleves'        => $totalEleves,
        'success_dashboard' => $success_dashboard,
    ]);
}
