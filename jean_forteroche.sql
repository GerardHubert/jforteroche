-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  Dim 12 juil. 2020 à 20:51
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `jean_forteroche`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('jforteroche', '');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `comment_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `episode` tinyint(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reported_comment` tinyint(1) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `episode_comments` (`episode`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`comment_id`, `episode`, `pseudo`, `comment`, `comment_date`, `reported_comment`) VALUES
(1, 3, 'Gérard', 'Ce chapitre est vraiment merdique!', '2020-05-30 14:39:12', 0),
(2, 2, 'Jérémy', 'Et pourquoi c\'est en latin d\'abord!', '2020-05-30 14:43:02', 0),
(3, 2, 'Jacques', 'Il fait ça surement pour se donner un genre...', '2020-05-30 14:43:02', 0),
(8, 2, 'bob_sinclar', 'et si j\'essayais de laisser un commentaire ici', '2020-06-01 16:46:21', 0),
(9, 2, 'gérard', 'commentaire episode 2', '2020-06-27 14:16:18', 0),
(10, 3, 'hubert', 'test commentaire sur épisode 3!', '2020-06-27 14:24:59', 0),
(12, 2, 'un_pseudo_qui_tue', 'cet épisode jette un froid...', '2020-06-27 14:52:58', 0),
(13, 3, 'rick_hunter', 'est-ce que ça fonctionne toujours?', '2020-06-27 14:57:15', 1),
(14, 3, 'dsk', 'vive la politique', '2020-06-27 15:10:20', 1),
(22, 2, 'gérard', 'et si on essayait de laisser un commentaire?', '2020-07-01 20:08:56', 0),
(29, 3, 'jforteroche', 'c\'est moi l\'auteur', '2020-07-08 23:37:15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `drafts`
--

DROP TABLE IF EXISTS `drafts`;
CREATE TABLE IF NOT EXISTS `drafts` (
  `draft_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `episode` tinyint(4) DEFAULT NULL,
  `draft_title` varchar(255) NOT NULL,
  `draft_content` text NOT NULL,
  PRIMARY KEY (`draft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `drafts`
--

INSERT INTO `drafts` (`draft_id`, `episode`, `draft_title`, `draft_content`) VALUES
(1, 7, 'test titre', '<p>on r&eacute;essaie de changer le num&eacute;ro de l\'&eacute;pisode de ce brouillon...</p>'),
(4, 4, 'ceci est un brouillon', '<p>mis &agrave; jour?</p>'),
(9, 14, 'titre de fou', '<p>L\'&eacute;pisode de trop, comme dans game of throne, la derni&egrave;re saison est merdique!</p>');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

DROP TABLE IF EXISTS `episodes`;
CREATE TABLE IF NOT EXISTS `episodes` (
  `episode_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `numero_episode` int(11) NOT NULL,
  `episode_title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `episode_content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `episode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`episode_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`episode_id`, `numero_episode`, `episode_title`, `episode_content`, `episode_date`) VALUES
(2, 2, 'Les deux tours', 'Ut augue libero, molestie id sapien et, luctus gravida justo. Vivamus eu dapibus nisi. Integer molestie diam sem, quis iaculis lacus convallis vitae. Proin fermentum rhoncus ante sit amet condimentum. Quisque quis lacus et justo tristique sagittis non sit amet nibh. In hac habitasse platea dictumst. Pellentesque semper arcu eget eros euismod congue. Aenean et iaculis purus. Cras eget facilisis lorem, ac dapibus dolor. Curabitur at massa nec mi dignissim aliquam. Integer a tincidunt diam, sed aliquam quam. Nulla molestie dolor tortor, a egestas ante vulputate vel. Aenean venenatis, arcu at maximus euismod, nulla velit condimentum ligula, eu sagittis nibh dui quis est. Mauris suscipit fermentum nisi, at tempus elit mattis ut. Integer pellentesque blandit nisl, ac venenatis lectus pulvinar vel. Nunc in libero vel justo luctus accumsan ac at elit. ', '2020-05-30 10:21:15'),
(3, 3, 'Le retour du roi', 'Vestibulum ac porta enim, posuere ullamcorper mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse nulla libero, elementum eget quam non, scelerisque dictum sapien. Nam aliquet arcu nec tincidunt pharetra. Pellentesque porttitor fermentum ligula, eu egestas ipsum interdum nec. Aliquam mi felis, commodo nec magna a, eleifend pretium nisi. Aenean at fermentum orci. Sed ut fringilla neque. ', '2020-05-30 10:13:34');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `episode_comments` FOREIGN KEY (`episode`) REFERENCES `episodes` (`episode_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
