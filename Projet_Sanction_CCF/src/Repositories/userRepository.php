<?php


require_once __DIR__ . '/../config/database.php';
function createUser(PDO $connexion, array $utilisateur): int|false
{
    $email         = $utilisateur['email'];
    $password      = $utilisateur['password'];
    $nom           = $utilisateur['nom'];
    $prenom        = $utilisateur['prenom'];

    if ($email === null || $password === null || $nom === null || $prenom === null) {
        return false;
    }



    try {
        $sql = "INSERT INTO utilisateurs (email, password, nom, prenom)
                VALUES (:email, :password, :nom, :prenom)";
        $stmt = $connexion->prepare($sql);

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR);
        $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindValue(':prenom', $prenom, PDO::PARAM_STR);


        if ($stmt->execute()) {
            return (int) $connexion->lastInsertId();
        }

        return false;
    } catch (PDOException $e) {
        error_log('createUser PDO Error: ' . $e->getMessage());
        return false;
    }
}


function emailExiste(PDO $connexion, string $email): bool
{
    $requete = "SELECT id FROM utilisateurs WHERE email = :email";
    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':email', $email, PDO::PARAM_STR);

    $requetePDO->execute();

    return $requetePDO->rowCount() > 0;
}

function getUserByEmail(PDO $connexion, string $email): array|false
{
    $requete = "SELECT id, email, password, prenom, nom
                FROM utilisateurs
                WHERE email = :email";

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':email', $email, PDO::PARAM_STR);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}
