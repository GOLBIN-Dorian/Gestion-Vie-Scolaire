-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 01 déc. 2025 à 10:39
-- Version du serveur : 8.0.44
-- Version de PHP : 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


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

CREATE TABLE `classes` (
  `id_classe` int NOT NULL,
  `nom_classe` varchar(255) NOT NULL,
  `id_niveau` int NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `classes`
--

INSERT INTO `classes` (`id_classe`, `nom_classe`, `id_niveau`, `date_creation`) VALUES
(13, 'SIO1', 4, '2025-11-28 16:39:34'),
(15, 'SIO2', 4, '2025-11-28 16:48:03');

-- --------------------------------------------------------

--
-- Structure de la table `eleves`
--

CREATE TABLE `eleves` (
  `id_eleve` int NOT NULL,
  `nom_eleve` varchar(50) NOT NULL,
  `prenom_eleve` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `id_classe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `eleves`
--

INSERT INTO `eleves` (`id_eleve`, `nom_eleve`, `prenom_eleve`, `date_naissance`, `id_classe`) VALUES
(4, 'ACCHINI', 'Alessandro', '2006-08-03', 13),
(5, 'GALLARDO', 'Pierre', '2003-10-10', 15),
(6, 'AMAND', 'Alexandre', '2003-10-15', 15),
(7, 'URBAIN', 'Thomas', '2006-01-01', 15);

-- --------------------------------------------------------

--
-- Structure de la table `niveaux`
--

CREATE TABLE `niveaux` (
  `id_niveau` int NOT NULL,
  `nom_niveau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `niveaux`
--

INSERT INTO `niveaux` (`id_niveau`, `nom_niveau`) VALUES
(1, 'Seconde'),
(2, 'Première'),
(3, 'Terminale'),
(4, 'BTS');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `password`, `nom`, `prenom`, `email`) VALUES
(8, '$2y$12$wd4iPV1PYX2D7maaU1jetunU73udekDvhhzyE.p0neMlCX8f2k.oi', 'Golbin', 'Dorian', 'dorian70210@gmail.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id_classe`),
  ADD KEY `FK_id_niveau` (`id_niveau`);

--
-- Index pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `id_classe` (`id_classe`);

--
-- Index pour la table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id_niveau`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id_classe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `eleves`
--
ALTER TABLE `eleves`
  MODIFY `id_eleve` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id_niveau` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `FK_id_niveau` FOREIGN KEY (`id_niveau`) REFERENCES `niveaux` (`id_niveau`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `eleves`
--
ALTER TABLE `eleves`
  ADD CONSTRAINT `FK_id_classe` FOREIGN KEY (`id_classe`) REFERENCES `classes` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
