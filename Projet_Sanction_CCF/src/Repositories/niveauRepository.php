<?php

require_once __DIR__ . '/../config/database.php';


function getNiveauById(PDO $connexion, int $id_niveau): array|false
{
    $requete = 'SELECT id_niveau,nom_niveau
                    FROM niveaux
                    WHERE id_niveau = :id_niveau';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':id_niveau', $id_niveau, PDO::PARAM_INT);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}

function getAllNiveaux(PDO $connexion): array
{
    $requete = 'SELECT id_niveau,nom_niveau
                FROM niveaux
                ORDER BY nom_niveau ASC';
    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    return $requetePDO->fetchAll(PDO::FETCH_ASSOC);
}
