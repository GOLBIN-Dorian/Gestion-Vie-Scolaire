<?php

// inclure la config BDD (chemin relatif depuis controllers vers src/config)
require_once __DIR__ . '/../config/database.php';
// <-- ajout : inclure le modèle utilisateur
require_once __DIR__ . '/../repositories/userRepository.php';

use App\Http\Request;
use App\Http\Response;

function action_connexion(Request $req, Response $res): void
{
    // Démarrer la session si nécessaire
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION['user']) || !empty($_SESSION['loggedin'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }

    $errors = [];
    $email = '';

    if ($req->getMethod() === 'POST') {

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($email === '') {
            $errors['email'] = 'Veuillez entrer votre email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez entrer une adresse email valide';
        }

        if ($password === '') {
            $errors['password'] = 'Veuillez entrer votre mot de passe';
        }

        if (empty($errors)) {
            // Créer une connexion avec la BDD
            $connexion = getDatabaseConnection();

            if ($connexion === false) {
                $errors['db'] = "Impossible de se connecter à la base de données. Vérifiez la configuration.";
            } else {
                $utilisateur = getUserByEmail($connexion, $email);

                if ($utilisateur && password_verify($password, $utilisateur['password'])) {
                    // Authentification réussie
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = [
                        'id' => $utilisateur['id'],
                        'email' => $utilisateur['email'],
                        'nom' => $utilisateur['nom'],
                        'prenom' => $utilisateur['prenom'],
                    ];

                    $res->redirect('index.php?action=dashboard');
                    return;
                }

                // Identifiants incorrects (utilisateur absent ou mot de passe invalide)
                $errors['login'] = 'Identifiants incorrects';
            }
        }
    }

    // Afficher la vue du formulaire (GET ou POST avec erreurs)
    $res->view('Gestions/connexion.php', [
        'errors' => $errors,
        'email'  => $email
    ]);
}
