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

    // Protection : redirection si utilisateur non connecté
    if (empty($_SESSION['user'])) {
        $res->redirect('index.php?action=connexion');
        return;
    }

    // Connexion BDD
    $connexion = getDatabaseConnection();

    // Récupération de toutes les classes depuis la BDD
    // >>> Cette fonction doit exister dans ton classeRepository.php
    $classes = getAllClassesWithNiveaux($connexion);

    // Rendu de la vue + passage des données
    $res->view('Gestions/listeClasse.php', [
        'title'   => 'Gestion des classes',
        'classes' => $classes,
    ]);
}
