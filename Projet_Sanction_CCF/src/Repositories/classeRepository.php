<?php

function createClasse(PDO $connexion, array $classe): int|false
{
    $nom_classe = $classe['nom_classe'] ?? null;
    $niveau     = $classe['id_niveau'] ?? null;

    if ($nom_classe === null || $niveau === null) {
        return false;
    }

    try {
        $sql = "INSERT INTO classes (nom_classe, id_niveau)
                VALUES (:nom_classe, :niveau)";
        $stmt = $connexion->prepare($sql);

        $stmt->bindValue(':nom_classe', $nom_classe, PDO::PARAM_STR);
        $stmt->bindValue(':niveau', $niveau, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return (int) $connexion->lastInsertId();
        }

        return false;
    } catch (PDOException $e) {
        error_log('createClasse PDO Error: ' . $e->getMessage());
        return false;
    }
}

function getClasseById(PDO $connexion, int $id_classe): array|false
{
    $requete = 'SELECT id_classe, nom_classe, id_niveau
                FROM classes
                WHERE id_classe = :id_classe';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}

function getAllClasses(PDO $connexion): array
{
    $requete = 'SELECT id_classe, nom_classe, id_niveau
                FROM classes
                ORDER BY nom_classe ASC';
    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    return $requetePDO->fetchAll(PDO::FETCH_ASSOC);
}

function findClasseByNom(PDO $connexion, string $nomClasse): array|false
{
    try {
        $sql = "SELECT * FROM classes WHERE nom_classe = :nom";
        $stmt = $connexion->prepare($sql);
        $stmt->bindValue(':nom', $nomClasse, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    } catch (PDOException $e) {
        error_log('findClasseByNom PDO Error: ' . $e->getMessage());
        return false;
    }
}

function getAllClassesWithNiveaux(PDO $connexion): array
{
    $requete = '
        SELECT 
            c.id_classe,
            c.nom_classe,
            n.nom_niveau,
            c.date_creation
        FROM classes c
        JOIN niveaux n ON c.id_niveau = n.id_niveau
        ORDER BY n.nom_niveau ASC, c.nom_classe ASC
    ';

    $stmt = $connexion->prepare($requete);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
}

function getTotalClasses(PDO $connexion): int
{
    $sql = "SELECT COUNT(*) FROM classes";
    $stmt = $connexion->query($sql);
    return (int)$stmt->fetchColumn();
}
