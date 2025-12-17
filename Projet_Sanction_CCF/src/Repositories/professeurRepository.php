<?php



function createProfesseur(PDO $connexion, array $professeur): int|false
{
    $prenom_professeur = $professeur['prenom_professeur'] ?? null;
    $nom_professeur = $professeur['nom_professeur'] ?? null;
    $matiere_professeur = $professeur['matiere_professeur'] ?? null;

    if ($prenom_professeur === null || $nom_professeur === null || $matiere_professeur === null) {
        return false;
    }

    try {
        $sql = "INSERT INTO professeurs(prenom_professeur,nom_professeur,matiere_professeur) VALUES (:prenom_professeur, :nom_professeur, :matiere_professeur)";
        $stmt = $connexion->prepare($sql);

        $stmt->bindValue(':prenom_professeur', $prenom_professeur, PDO::PARAM_STR);
        $stmt->bindValue(':nom_professeur', $nom_professeur, PDO::PARAM_STR);
        $stmt->bindValue(':matiere_professeur', $matiere_professeur, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return (int)$connexion->lastInsertId();
        }

        return false;
    } catch (PDOException $e) {
        error_log('createProfesseur PDO Error: ' . $e->getMessage());
        return false;
    }
}

function getProfesseurById(PDO $connexion, int $id_professeur): array|false
{
    $requete = '
        SELECT id_professeur, prenom_professeur, nom_professeur, matiere_professeur
        FROM professeurs
        WHERE id_professeur = :id_professeur
    ';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':id_professeur', $id_professeur, PDO::PARAM_INT);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}

function getAllProfesseurs(PDO $connexion): array
{
    $requete = '
        SELECT id_professeur, prenom_professeur, nom_professeur, matiere_professeur
        FROM professeurs
        ORDER BY nom_professeur, prenom_professeur
    ';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    return $requetePDO->fetchAll(PDO::FETCH_ASSOC);
}

function getTotalProfesseurs(PDO $connexion): int
{
    $requete = 'SELECT COUNT(*) AS total FROM professeurs';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    $result = $requetePDO->fetch(PDO::FETCH_ASSOC);
    return (int)($result['total'] ?? 0);
}
