<?php

require_once __DIR__ . '/../Repositories/sanctionsRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_listeSanction(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $connexion = getDatabaseConnection();
    $sanctions = getAllSanctionsWithType($connexion);


    $res->view('Gestions/listeSanction.php', [
        'title'   => 'Gestion des sanctions',
        'sanctions' => $sanctions,
    ]);
}
