<?php

use App\Http\Request;
use App\Http\Response;

function action_deconnexion(Request $req, Response $res): void
{
    $_SESSION = [];
    session_destroy();
    // Redirection après déconnexion
    $res->redirect('index.php?action=connexion');
}
