<?php

require_once __DIR__ . '/../Repositories/eleveRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_listeEleve(Request $requ, Response $res): void
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

    $res->view('Gestions/listeEleve.php', [
        'title' => 'Gestion des élèves',
        'eleves' => $eleves,
    ]);
}
