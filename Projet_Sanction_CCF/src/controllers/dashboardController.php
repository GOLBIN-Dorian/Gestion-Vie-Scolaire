<?php

use App\Http\Request;
use App\Http\Response;

function action_dashboard(Request $req, Response $res): void
{
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $user = $_SESSION['user'];

    $res->view('Gestions/dashboard.php', [
        'user' => $user
    ]);
}
