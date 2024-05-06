-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 06 mai 2024 à 11:46
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reprise_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id_evenements` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(50) NOT NULL,
  `nb_places` int NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id_evenements`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id_evenements`, `titre`, `date`, `description`, `nb_places`, `image`) VALUES
(1, 'SZA', '2024-05-25', 'Parc Des Princes ', 100, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.townandcountrymag.com%2Fleisure%2Farts-and-culture%2Fa42199631%2Fprincess-diana-sza-sos-album-art%2F&psig=AOvVaw24r6MhTIy2DmQa9cDi0_og&ust=1715032316201000&source=images&cd=vfe&opi=89978449&ved=0CBIQjR'),
(2, 'GAZO', '2024-05-24', 'Stade De France', 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fmusic.apple.com%2Ffr%2Fartist%2Fgazo%2F1039356043&psig=AOvVaw0rl5bTmvdQQGDXQaJttGgD&ust=1715032340755000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCMDR8rq_94UDFQAAAAAdAAAAABAE'),
(3, 'PNL', '2024-05-23', 'Adidas Arena', 80, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fen.wikipedia.org%2Fwiki%2FDans_la_l%25C3%25A9gende&psig=AOvVaw26Xe0o-VChe8-yquuLbse-&ust=1715032356186000&source=images&cd=vfe&opi=89978449&ved=0CBIQjRxqFwoTCOC-xMG_94UDFQAAAAAdAAAAABAE');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

DROP TABLE IF EXISTS `reserver`;
CREATE TABLE IF NOT EXISTS `reserver` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `ref_evenements` int NOT NULL,
  `ref_user` int NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `fk_ref_evenements` (`ref_evenements`),
  KEY `fk_ref_user` (`ref_user`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`id_reservation`, `ref_evenements`, `ref_user`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `libelle`) VALUES
(1, 'Utilisateur'),
(2, 'Administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `ref_role` int NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_ref_role` (`ref_role`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `email`, `mdp`, `ref_role`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', 'motdepasse', 1),
(2, 'Martin', 'Marie', 'marie.martin@example.com', 'password', 1),
(3, 'Durand', 'Pierre', 'pierre.durand@example.com', '123456', 1),
(4, 'Admin', 'Admin', 'admin@example.com', 'adminpassword', 2),
(5, 'e', 'e', 'e@lprs.fr', '$2y$10$2l15tajpFy0wl6EGasVQku.cTSwdgIMBbnVNagxwUER7wFVM8Bb6e', 1);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `vue_reservations`
-- (Voir ci-dessous la vue réelle)
--
DROP VIEW IF EXISTS `vue_reservations`;
CREATE TABLE IF NOT EXISTS `vue_reservations` (
);

-- --------------------------------------------------------

--
-- Structure de la vue `vue_reservations`
--
DROP TABLE IF EXISTS `vue_reservations`;

DROP VIEW IF EXISTS `vue_reservations`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vue_reservations`  AS SELECT `r`.`ref_evenements` AS `ref_evenements`, `r`.`ref_user` AS `ref_user`, `e`.`titre` AS `titre_evenement`, `e`.`date` AS `date_evenement`, `e`.`description` AS `description_evenement`, `e`.`nb_places` AS `nb_places_evenement`, `u`.`nom` AS `nom_utilisateur`, `u`.`prenom` AS `prenom_utilisateur`, `u`.`mail` AS `mail_utilisateur`, `r`.`ref_user` in (select `user`.`id_user` from `user` where (`user`.`ref_role` = 2)) AS `est_administrateur` FROM ((`reserver` `r` join `evenements` `e` on((`r`.`ref_evenements` = `e`.`id_evenements`))) join `user` `u` on((`r`.`ref_user` = `u`.`id_user`))) ;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_ref_role` FOREIGN KEY (`ref_role`) REFERENCES `role` (`id_role`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
