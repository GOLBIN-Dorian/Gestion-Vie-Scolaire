<?php

use App\Http\Request;
use App\Http\Response;

function action_dashboard(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }
    $connexion = getDatabaseConnection();
    $totalClasses = getTotalClasses($connexion);
    $totalEleves  = getTotalEleves($connexion);

    $user   = $_SESSION['user'];
    $nom    = $user['nom']    ?? '';
    $prenom = $user['prenom'] ?? '';
    $email  = $user['email']  ?? '';

    $success_dashboard = $_SESSION['success_dashboard'] ?? null;
    unset($_SESSION['success_dashboard']);
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
