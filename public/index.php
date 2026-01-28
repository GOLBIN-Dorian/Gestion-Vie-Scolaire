<?php
session_start();

// Autoload avec Composer (PSR-4 + fichiers procéduraux)
require __DIR__ . '/../vendor/autoload.php';

use App\Http\Request;
use App\Http\Response;
use App\Routing\Router;

try {
    $request  = new Request();
    $response = new Response();
    $router   = new Router($request, $response);

    $router
        ->addRoute('index',       'action_index',       ['GET'])
        ->addRoute('connexion',   'action_connexion',   ['GET', 'POST'])
        ->addRoute('inscription', 'action_inscription', ['GET', 'POST'])
        ->addRoute('dashboard',   'action_dashboard',   ['GET'])
        ->addRoute('deconnexion', 'action_deconnexion', ['GET'])
        ->addRoute('creationClasse', 'action_creationClasse', ['GET', 'POST'])
        ->addRoute('listeClasse', 'action_listeClasse', ['GET'])
        ->addRoute('creationEleve', 'action_creationEleve', ['GET', 'POST'])
        ->addRoute('listeEleve', 'action_listeEleve', ['GET'])
        ->addRoute('creationProfesseur', 'action_creationProfesseur', ['GET', 'POST'])
        ->addRoute('creationSanction', 'action_creationSanction', ['GET', 'POST'])
        ->addRoute('listeSanction', 'action_listeSanction', ['GET']);

    $router->handleRequest();
} catch (Exception $e) {
    http_response_code(500);
    echo "Erreur interne : " . htmlspecialchars($e->getMessage());
}
