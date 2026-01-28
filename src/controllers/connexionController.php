<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/userRepository.php';

use App\Http\Request;
use App\Http\Response;

function action_connexion(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!empty($_SESSION['user']) || !empty($_SESSION['loggedin'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }

    $errors = [];
    $email  = '';

    $success_message = $_SESSION['success'] ?? null;
    unset($_SESSION['success']);
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

            $connexion = getDatabaseConnection();

            if ($connexion === false) {
                $errors['login'] = "Impossible de se connecter à la base de données. Veuillez réessayer plus tard.";
            } else {

                $utilisateur = getUserByEmail($connexion, $email);


                if ($utilisateur && password_verify($password, $utilisateur['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = [
                        'id'     => $utilisateur['id'],
                        'email'  => $utilisateur['email'],
                        'nom'    => $utilisateur['nom'],
                        'prenom' => $utilisateur['prenom'],
                    ];
                    $_SESSION['success_dashboard'] = "Connexion réussie. Bienvenue dans votre tableau de bord.";

                    $res->redirect('index.php?action=dashboard');
                    return;
                }


                $errors['login'] = 'Identifiants incorrects';
            }
        }
    }


    $res->view('Gestions/connexion.php', [
        'errors'  => $errors,
        'email'   => $email,
        'success' => $success_message,
    ]);
}
