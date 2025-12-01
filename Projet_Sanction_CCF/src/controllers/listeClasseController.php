<?php

require_once __DIR__ . '/../Repositories/classeRepository.php';
require_once __DIR__ . '/../config/database.php';

use App\Http\Request;
use App\Http\Response;

function action_listeClasse(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    $connexion = getDatabaseConnection();
    $classes = getAllClassesWithNiveaux($connexion);

    $res->view('Gestions/listeClasse.php', [
        'title'   => 'Gestion des classes',
        'classes' => $classes,
    ]);
}
