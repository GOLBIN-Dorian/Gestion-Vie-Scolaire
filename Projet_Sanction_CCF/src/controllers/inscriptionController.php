<?php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../repositories/userRepository.php';

use App\Http\Request;
use App\Http\Response;

function action_inscription(Request $req, Response $res): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!empty($_SESSION['user']) || !empty($_SESSION['loggedin'])) {
        $res->redirect('index.php?action=dashboard');
        return;
    }

    $email = $password = $confirm_password = $prenom = $nom = "";
    $errors = [];

    if ($req->getMethod() === 'POST') {

        $nom     = trim($_POST["nom"] ?? '');
        $prenom  = trim($_POST["prenom"] ?? '');
        $email   = trim($_POST["email"] ?? '');
        $password = trim($_POST["password"] ?? '');
        $confirm_password = trim($_POST["password2"] ?? '');

        if ($nom === '') {
            $errors['nom'] = "Veuillez entrer votre nom.";
        }

        if ($prenom === '') {
            $errors['prenom'] = "Veuillez entrer votre prénom.";
        }

        if ($email === '') {
            $errors['email'] = "Veuillez entrer une adresse email.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Veuillez entrer une adresse email valide.";
        } else {
            $connexion = getDatabaseConnection();
            if ($connexion && emailExiste($connexion, $email)) {
                $errors['email'] = "Cette adresse email est déjà utilisée.";
            }
        }

        if ($password === '') {
            $errors['password'] = "Veuillez entrer un mot de passe.";
        } elseif (strlen($password) < 8) {
            $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";
        } elseif (!preg_match('/[A-Z]/', $password)) {
            $errors['password'] = "Le mot de passe doit contenir au moins une majuscule.";
        } elseif (!preg_match('/[0-9]/', $password)) {
            $errors['password'] = "Le mot de passe doit contenir au moins un chiffre.";
        }

        if ($confirm_password === '') {
            $errors['password2'] = "Veuillez confirmer le mot de passe.";
        } elseif (empty($errors['password']) && $password !== $confirm_password) {
            $errors['password2'] = "Les mots de passe ne correspondent pas.";
        }

        if (empty($errors)) {

            $connexion = $connexion ?? getDatabaseConnection();

            $nouvelUtilisateur = [
                'email'  => $email,
                'password' => $password,
                'prenom' => $prenom,
                'nom'    => $nom
            ];

            if (createUser($connexion, $nouvelUtilisateur)) {
                $res->redirect('index.php?action=connexion');
                return;
            }

            $errors['general'] = "Une erreur est survenue.";
        }
    }

    $res->view('Gestions/inscription.php', [
        'errors' => $errors,
        'email'  => $email,
        'prenom' => $prenom,
        'nom'    => $nom,
    ]);
}
