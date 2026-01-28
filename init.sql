-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : sam. 03 jan. 2026 à 16:07
-- Version du serveur : 8.0.44
-- Version de PHP : 8.3.26
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_sanctions`
--
-- --------------------------------------------------------
--
-- Structure de la table `classes`
--
CREATE TABLE
  `classes` (
    `id_classe` int NOT NULL,
    `nom_classe` varchar(255) NOT NULL,
    `id_niveau` int NOT NULL,
    `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `classes`
--
INSERT INTO
  `classes` (
    `id_classe`,
    `nom_classe`,
    `id_niveau`,
    `date_creation`
  )
VALUES
  (12, 'BTS1', 4, '2025-11-28 16:39:27'),
  (13, 'SIO1', 2, '2025-11-28 16:39:34'),
  (14, 'premiere', 2, '2025-11-28 16:39:45'),
  (15, 'SIO2', 4, '2025-11-28 16:48:03');

-- --------------------------------------------------------
--
-- Structure de la table `eleves`
--
CREATE TABLE
  `eleves` (
    `id_eleve` int NOT NULL,
    `nom_eleve` varchar(50) NOT NULL,
    `prenom_eleve` varchar(50) NOT NULL,
    `date_naissance` date NOT NULL,
    `id_classe` int NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `eleves`
--
INSERT INTO
  `eleves` (
    `id_eleve`,
    `nom_eleve`,
    `prenom_eleve`,
    `date_naissance`,
    `id_classe`
  )
VALUES
  (1, 'GOLBIN', 'Dorian', '2004-12-06', 12);

-- --------------------------------------------------------
--
-- Structure de la table `niveaux`
--
CREATE TABLE
  `niveaux` (
    `id_niveau` int NOT NULL,
    `nom_niveau` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `niveaux`
--
INSERT INTO
  `niveaux` (`id_niveau`, `nom_niveau`)
VALUES
  (1, 'Seconde'),
  (2, 'Première'),
  (3, 'Terminale'),
  (4, 'BTS');

-- --------------------------------------------------------
--
-- Structure de la table `professeurs`
--
CREATE TABLE
  `professeurs` (
    `id_professeur` int NOT NULL,
    `prenom_professeur` varchar(50) NOT NULL,
    `nom_professeur` varchar(50) NOT NULL,
    `matiere_professeur` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `professeurs`
--
INSERT INTO
  `professeurs` (
    `id_professeur`,
    `prenom_professeur`,
    `nom_professeur`,
    `matiere_professeur`
  )
VALUES
  (2, 'Mathéo', 'Koehler', 'Hgéo');

-- --------------------------------------------------------
--
-- Structure de la table `sanctions`
--
CREATE TABLE
  `sanctions` (
    `id_sanction` int NOT NULL,
    `id_type` int NOT NULL,
    `date_sanction` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `id_eleve` int NOT NULL,
    `motif_sanction` varchar(255) NOT NULL,
    `id_professeur` int NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

-- --------------------------------------------------------
--
-- Structure de la table `type_sanctions`
--
CREATE TABLE
  `type_sanctions` (
    `id_sanction` int NOT NULL,
    `type_sanction` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `type_sanctions` (AJOUTÉ POUR TEST)
--
INSERT INTO
  `type_sanctions` (`id_sanction`, `type_sanction`)
VALUES
  (1, 'Avertissement verbal'),
  (2, 'Heure de colle'),
  (3, 'Exclusion temporaire'),
  (4, 'Devoir supplémentaire');

-- --------------------------------------------------------
--
-- Structure de la table `utilisateurs`
--
CREATE TABLE
  `utilisateurs` (
    `id` int NOT NULL,
    `password` varchar(255) NOT NULL,
    `nom` varchar(255) NOT NULL,
    `prenom` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL
  ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--
INSERT INTO
  `utilisateurs` (`id`, `password`, `nom`, `prenom`, `email`)
VALUES
  (
    8,
    '$2y$12$wd4iPV1PYX2D7maaU1jetunU73udekDvhhzyE.p0neMlCX8f2k.oi',
    'Golbin',
    'Dorian',
    'dorian70210@gmail.com'
  ),
  (
    9,
    '$2y$12$UDLdlLeqfD1zaA.W6DbCbusN011TR.t5pyZq.Dbon8iirrQ.JiZha',
    'Golbin',
    'Dorian',
    'dorian7020@gmail.com'
  ),
  (
    10,
    '$2y$12$OUjvgVyA0OY3qcDp8KNrMelW6hHMGAjQzESeYUi7gWFT5IDNIslfy',
    'Golbin',
    'Dorian',
    'dorian10@gmail.com'
  );

--
-- Index pour les tables déchargées
--
--
-- Index pour la table `classes`
--
ALTER TABLE `classes` ADD PRIMARY KEY (`id_classe`),
ADD KEY `FK_id_niveau` (`id_niveau`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves` ADD PRIMARY KEY (`id_eleve`),
ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `niveaux`
--
ALTER TABLE `niveaux` ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `professeurs`
--
ALTER TABLE `professeurs` ADD PRIMARY KEY (`id_professeur`);

--
-- Index pour la table `sanctions`
--
ALTER TABLE `sanctions` ADD PRIMARY KEY (`id_sanction`),
ADD KEY `FK_sanctions_id_type` (`id_type`),
ADD KEY `FK_sanctions_id_eleve` (`id_eleve`),
ADD KEY `FK_sanctions_id_professeur` (`id_professeur`);

--
-- Index pour la table `type_sanctions` (CORRIGÉ)
--
ALTER TABLE `type_sanctions` ADD PRIMARY KEY (`id_sanction`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs` ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes` MODIFY `id_classe` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 16;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves` MODIFY `id_eleve` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 2;

--
-- AUTO_INCREMENT pour la table `niveaux`
--
ALTER TABLE `niveaux` MODIFY `id_niveau` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 6;

--
-- AUTO_INCREMENT pour la table `professeurs`
--
ALTER TABLE `professeurs` MODIFY `id_professeur` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT pour la table `sanctions`
--
ALTER TABLE `sanctions` MODIFY `id_sanction` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_sanctions` (CORRIGÉ)
--
ALTER TABLE `type_sanctions` MODIFY `id_sanction` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 5;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs` MODIFY `id` int NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 11;

--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes` ADD CONSTRAINT `FK_id_niveau` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id_niveau`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves` ADD CONSTRAINT `FK_id_classe` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sanctions`
--
ALTER TABLE `sanctions` ADD CONSTRAINT `FK_sanctions_id_eleve` FOREIGN KEY (`id_eleve`) REFERENCES `eleves` (`id_eleve`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_sanctions_id_professeur` FOREIGN KEY (`id_professeur`) REFERENCES `professeurs` (`id_professeur`) ON DELETE RESTRICT ON UPDATE RESTRICT,
ADD CONSTRAINT `FK_sanctions_id_type` FOREIGN KEY (`id_type`) REFERENCES `type_sanctions` (`id_sanction`) ON DELETE RESTRICT ON UPDATE RESTRICT;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;