<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/userRepository.php';

use App\Http\Request;
use App\Http\Response;

function action_connexion(Request $req, Response $res): void
{
    // Démarrer la session si nécessaire
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si déjà connecté, on redirige vers le dashboard
    if (!empty($_SESSION['user']) || !empty($_SESSION['loggedin'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }

    $errors = [];
    $email  = '';

    // Récupération du message de succès (flash, après inscription)
    $success_message = $_SESSION['success'] ?? null;
    unset($_SESSION['success']); // On le consomme une fois

    // Traitement du formulaire de connexion
    if ($req->getMethod() === 'POST') {

        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');

        // Validation email
        if ($email === '') {
            $errors['email'] = 'Veuillez entrer votre email';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Veuillez entrer une adresse email valide';
        }

        // Validation mot de passe
        if ($password === '') {
            $errors['password'] = 'Veuillez entrer votre mot de passe';
        }

        // Si pas d’erreurs de saisie
        if (empty($errors)) {

            $connexion = getDatabaseConnection();

            if ($connexion === false) {
                $errors['login'] = "Impossible de se connecter à la base de données. Veuillez réessayer plus tard.";
            } else {
                // Récupération de l’utilisateur par son email
                $utilisateur = getUserByEmail($connexion, $email);

                // Vérification de l’existence + du mot de passe
                if ($utilisateur && password_verify($password, $utilisateur['password'])) {

                    // Authentification réussie
                    $_SESSION['loggedin'] = true;
                    $_SESSION['user'] = [
                        'id'     => $utilisateur['id'],
                        'email'  => $utilisateur['email'],
                        'nom'    => $utilisateur['nom'],
                        'prenom' => $utilisateur['prenom'],
                    ];

                    // 🔔 Message de succès pour le dashboard (flash)
                    $_SESSION['success_dashboard'] = "Connexion réussie. Bienvenue dans votre tableau de bord.";

                    $res->redirect('index.php?action=dashboard');
                    return;
                }

                // Identifiants incorrects
                $errors['login'] = 'Identifiants incorrects';
            }
        }
    }

    // Affichage de la vue (GET initial ou POST avec erreurs)
    $res->view('Gestions/connexion.php', [
        'errors'  => $errors,
        'email'   => $email,
        'success' => $success_message,
    ]);
}
