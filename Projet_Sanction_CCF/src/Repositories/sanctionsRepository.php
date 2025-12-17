<?php



function createSanction(PDO $connexion, array $sanction): int|false
{
    // Normalisation des clés possibles et nettoyage
    $type_sanction = null;
    if (isset($sanction['id_type'])) {
        $type_sanction = (int)$sanction['id_type'];
    } elseif (isset($sanction['type_sanction'])) {
        $type_sanction = is_numeric($sanction['type_sanction']) ? (int)$sanction['type_sanction'] : trim($sanction['type_sanction']);
    }

    $date_sanction  = isset($sanction['date_sanction']) ? trim($sanction['date_sanction']) : null;
    $id_eleve       = isset($sanction['id_eleve']) ? (int)$sanction['id_eleve'] : null;
    $id_professeur  = isset($sanction['id_professeur']) ? (int)$sanction['id_professeur'] : null;
    $motif_sanction = isset($sanction['motif_sanction']) ? trim($sanction['motif_sanction']) : null;

    // Validation simple: non null et non vide (pour les strings)
    if ($type_sanction === null || $date_sanction === null || $id_eleve === null || $id_professeur === null || $motif_sanction === null) {
        return false;
    }
    if ($date_sanction === '' || $motif_sanction === '') {
        return false;
    }

    try {
        $sql = "INSERT INTO sanctions (type_sanction, date_sanction, id_eleve, id_professeur, motif_sanction)
                VALUES (:type_sanction, :date_sanction, :id_eleve, :id_professeur, :motif_sanction)";
        $stmt = $connexion->prepare($sql);

        // Bind en respectant les types (type_sanction peut être un id)
        if (is_int($type_sanction)) {
            $stmt->bindValue(':type_sanction', $type_sanction, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':type_sanction', $type_sanction, PDO::PARAM_STR);
        }
        $stmt->bindValue(':date_sanction', $date_sanction, PDO::PARAM_STR);
        $stmt->bindValue(':id_eleve', $id_eleve, PDO::PARAM_INT);
        $stmt->bindValue(':id_professeur', $id_professeur, PDO::PARAM_INT);
        $stmt->bindValue(':motif_sanction', $motif_sanction, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return (int)$connexion->lastInsertId();
        }

        return false;
    } catch (PDOException $e) {
        error_log('createSanction PDO Error: ' . $e->getMessage());
        return false;
    }
}

function getSanctionById(PDO $connexion, int $id_sanction): array|false
{
    $requete = 'SELECT id_sanction, type_sanction, date_sanction, id_eleve, id_professeur, motif_sanction
                    FROM sanctions
                    WHERE id_sanction = :id_sanction';

    try {
        $requetePDO = $connexion->prepare($requete);
        $requetePDO->bindValue(':id_sanction', $id_sanction, PDO::PARAM_INT);
        $requetePDO->execute();

        $result = $requetePDO->fetch(PDO::FETCH_ASSOC);
        return $result === false ? false : $result;
    } catch (PDOException $e) {
        error_log('getSanctionById PDO Error: ' . $e->getMessage());
        return false;
    }
}

function getAllSanctions(PDO $connexion): array
{
    $requete = 'SELECT id_sanction, type_sanction, date_sanction, id_eleve, id_professeur, motif_sanction
                FROM sanctions
                ORDER BY date_sanction DESC';

    try {
        $requetePDO = $connexion->prepare($requete);
        $requetePDO->execute();

        return $requetePDO->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
        error_log('getAllSanctions PDO Error: ' . $e->getMessage());
        return [];
    }
}
