<?php

use App\Http\Request;
use App\Http\Response;

function action_index(Request $req, Response $res): void
{
    if (!empty($_SESSION['user'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }
    $res->view('Gestions/index.php');
}
