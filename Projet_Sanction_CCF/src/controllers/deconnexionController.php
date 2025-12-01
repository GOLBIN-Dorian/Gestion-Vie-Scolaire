<?php

use App\Http\Request;
use App\Http\Response;

function action_deconnexion(Request $req, Response $res): void
{
    $_SESSION = [];
    session_destroy();
    $res->redirect('index.php?action=connexion');
}
