<?php

use App\Http\Request;
use App\Http\Response;

function action_index(Request $req, Response $res): void
{
    // 🔒 Déjà connecté ? → Dashboard
    if (!empty($_SESSION['user'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }

    // 🔹 Affiche la page d'accueil
    $res->view('Gestions/index.php');
}
