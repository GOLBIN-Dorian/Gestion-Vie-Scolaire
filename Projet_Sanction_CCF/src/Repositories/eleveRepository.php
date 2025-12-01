<?php

function createEleve(PDO $connexion, array $eleve): int|false
{
    $prenom_eleve   = $eleve['prenom_eleve'] ?? null;
    $nom_eleve      = $eleve['nom_eleve'] ?? null;
    $date_naissance = $eleve['date_naissance'] ?? null;
    $id_classe      = $eleve['id_classe'] ?? null;

    if ($prenom_eleve === null || $nom_eleve === null || $date_naissance === null || $id_classe === null) {
        return false;
    }

    try {
        $sql = "INSERT INTO eleves (prenom_eleve, nom_eleve, date_naissance, id_classe)
                VALUES (:prenom_eleve, :nom_eleve, :date_naissance, :id_classe)";
        $stmt = $connexion->prepare($sql);

        $stmt->bindValue(':prenom_eleve', $prenom_eleve, PDO::PARAM_STR);
        $stmt->bindValue(':nom_eleve', $nom_eleve, PDO::PARAM_STR);
        $stmt->bindValue(':date_naissance', $date_naissance, PDO::PARAM_STR);
        $stmt->bindValue(':id_classe', $id_classe, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return (int) $connexion->lastInsertId();
        }

        return false;
    } catch (PDOException $e) {
        error_log('createEleve PDO Error: ' . $e->getMessage());
        return false;
    }
}

/**
 * Un élève seul (sans jointures)
 */
function getEleveById(PDO $connexion, int $id_eleve): array|false
{
    $requete = '
        SELECT id_eleve, prenom_eleve, nom_eleve,
               date_naissance, id_classe
        FROM eleves
        WHERE id_eleve = :id_eleve
    ';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}

/**
 * Tous les élèves AVEC leur classe et leur niveau
 * -> utilisé par ta liste des élèves
 */
function getAllEleves(PDO $connexion): array
{
    $requete = '
        SELECT
            e.id_eleve,
            e.prenom_eleve,
            e.nom_eleve,
            e.date_naissance,
            e.id_classe,
            c.nom_classe   AS classe,
            n.nom_niveau   AS niveau
        FROM eleves e
        LEFT JOIN classes c ON e.id_classe = c.id_classe
        LEFT JOIN niveaux n ON c.id_niveau = n.id_niveau
        ORDER BY e.nom_eleve ASC, e.prenom_eleve ASC
    ';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    return $requetePDO->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Total des élèves (corrigé : on avait oublié execute())
 */
function getTotalEleves(PDO $connexion): int
{
    $requete = 'SELECT COUNT(*) AS total FROM eleves';
    $requetePDO = $connexion->prepare($requete);
    $requetePDO->execute();

    return (int) $requetePDO->fetchColumn();
}

/**
 * Un élève + sa classe + son niveau (détail)
 */
function getEleveWithClasses(PDO $connexion, int $id_eleve): array|false
{
    $requete = '
        SELECT 
            e.id_eleve,
            e.prenom_eleve,
            e.nom_eleve,
            e.date_naissance,
            c.id_classe,
            c.nom_classe     AS classe,
            n.id_niveau,
            n.nom_niveau     AS niveau
        FROM eleves e
        JOIN classes c ON e.id_classe = c.id_classe
        JOIN niveaux n ON c.id_niveau = n.id_niveau
        WHERE e.id_eleve = :id_eleve
    ';

    $requetePDO = $connexion->prepare($requete);
    $requetePDO->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
    $requetePDO->execute();

    return $requetePDO->fetch(PDO::FETCH_ASSOC);
}
