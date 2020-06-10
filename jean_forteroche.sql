-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 10 juin 2020 à 01:20
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `password`) VALUES
('jean_forteroche', 'blog_2_jean');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `comment_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `episode` tinyint(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`),
  KEY `episode_comment` (`episode`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`comment_id`, `episode`, `pseudo`, `comment`, `comment_date`) VALUES
(1, 3, 'Gérard', 'Ce chapitre est vraiment merdique!', '2020-05-30 14:39:12'),
(2, 2, 'Jérémy', 'Et pourquoi c\'est en latin d\'abord!', '2020-05-30 14:43:02'),
(3, 2, 'Jacques', 'Il fait ça surement pour se donner un genre...', '2020-05-30 14:43:02'),
(4, 1, 'Pascale', 'Ce prologue me donne bien envie de lire la suite', '2020-05-30 14:43:02'),
(5, 4, 'Elizabeth', 'Le cliff de de fin de ce dernier chapitre est insoutenable !!! Vite, le prochain épisode!!', '2020-05-30 14:43:02'),
(6, 1, 'gerard', 'test', '2020-06-01 01:34:10'),
(7, 4, 'hubert', 'Putain, ça marche!', '2020-06-01 01:35:28'),
(8, 2, 'bon_sinclar', 'et si j\'essayais de laisser un commentaire ici', '2020-06-01 16:46:21');

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

DROP TABLE IF EXISTS `episodes`;
CREATE TABLE IF NOT EXISTS `episodes` (
  `episode_id` tinyint(11) NOT NULL,
  `episode_title` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `episode_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `episode_date` datetime NOT NULL,
  PRIMARY KEY (`episode_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`episode_id`, `episode_title`, `episode_content`, `episode_date`) VALUES
(1, 'La communauté de l\'anneau', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eleifend pulvinar tellus, vel pulvinar sem tristique et. In tempus aliquam risus ut malesuada. Integer elementum, erat quis rutrum elementum, nunc enim porttitor tortor, id viverra risus nunc vitae odio. Pellentesque augue ipsum, feugiat non varius eu, fringilla blandit magna. Curabitur quis eros erat. Donec in lobortis erat. Vestibulum sed lectus quis mi ullamcorper auctor. Duis fringilla mi non arcu euismod, sit amet consectetur tortor bibendum. Vivamus eu magna pretium, porta odio quis, accumsan mi. Quisque efficitur lorem at molestie vehicula. Pellentesque semper lacus ut mollis varius. Aenean ut lectus semper, luctus turpis vitae, bibendum magna. Cras rhoncus leo consectetur, imperdiet nulla at, dignissim justo.\r\n\r\nDonec iaculis justo id nisi suscipit maximus. Curabitur in augue vitae erat vehicula accumsan. Nam iaculis congue tellus at commodo. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed egestas dui et velit laoreet, non facilisis lacus imperdiet. Vivamus in dapibus velit, eu rhoncus lacus. Ut sodales arcu eu pellentesque laoreet. Phasellus varius quam elementum, porta magna malesuada, semper justo. Praesent rutrum, massa nec dignissim finibus, urna odio semper tortor, id maximus nunc ligula nec odio. Morbi sapien enim, tristique non risus ac, egestas eleifend ligula. Interdum et malesuada fames ac ante ipsum primis in faucibus.\r\n\r\nIn mattis tempor odio, congue consequat nisi fermentum nec. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla hendrerit risus lectus. Nunc finibus, tortor vitae luctus tincidunt, arcu velit maximus lectus, quis sodales erat velit porttitor magna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum rutrum scelerisque tincidunt. Donec vel risus quis lectus finibus faucibus. Donec vitae lacus id nisl luctus porta vel eu diam. Curabitur sit amet pharetra est.', '2020-05-30 13:14:35'),
(2, 'Les deux tours', 'Ut augue libero, molestie id sapien et, luctus gravida justo. Vivamus eu dapibus nisi. Integer molestie diam sem, quis iaculis lacus convallis vitae. Proin fermentum rhoncus ante sit amet condimentum. Quisque quis lacus et justo tristique sagittis non sit amet nibh. In hac habitasse platea dictumst. Pellentesque semper arcu eget eros euismod congue. Aenean et iaculis purus. Cras eget facilisis lorem, ac dapibus dolor. Curabitur at massa nec mi dignissim aliquam. Integer a tincidunt diam, sed aliquam quam. Nulla molestie dolor tortor, a egestas ante vulputate vel. Aenean venenatis, arcu at maximus euismod, nulla velit condimentum ligula, eu sagittis nibh dui quis est. Mauris suscipit fermentum nisi, at tempus elit mattis ut. Integer pellentesque blandit nisl, ac venenatis lectus pulvinar vel. Nunc in libero vel justo luctus accumsan ac at elit. ', '2020-05-30 10:21:15'),
(3, 'Le retour du roi', 'Vestibulum ac porta enim, posuere ullamcorper mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse nulla libero, elementum eget quam non, scelerisque dictum sapien. Nam aliquet arcu nec tincidunt pharetra. Pellentesque porttitor fermentum ligula, eu egestas ipsum interdum nec. Aliquam mi felis, commodo nec magna a, eleifend pretium nisi. Aenean at fermentum orci. Sed ut fringilla neque. ', '2020-05-30 10:13:34'),
(4, 'Le Hobbbit: un voyage inattendu', 'Sed mollis sit amet augue sed tempor. Vestibulum sollicitudin commodo est eu feugiat. Pellentesque at dolor non tellus tristique facilisis a in nibh. Donec commodo ante turpis, a ultrices ex euismod in. Morbi varius consequat eleifend. Mauris auctor elit ac justo cursus pretium. Suspendisse vel elit ac velit suscipit semper vitae sed urna. Quisque in pretium urna, non ullamcorper justo. Duis ut pharetra sapien, et congue erat. Vivamus venenatis nisl id ipsum suscipit, ut suscipit lorem mollis. Phasellus tincidunt tincidunt metus, non elementum arcu. Ut aliquet turpis ut quam commodo, tincidunt tristique eros congue. Aenean ultricies pretium porttitor. Proin sit amet arcu sit amet ex mollis posuere. Nullam iaculis, justo ut porttitor euismod, lectus sapien cursus dolor, a fermentum est augue ut purus. Praesent justo nibh, mattis nec turpis et, gravida tempor nisi. ', '2020-05-30 18:26:53');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `episode_comment` FOREIGN KEY (`episode`) REFERENCES `episodes` (`episode_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
