-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mar. 29 sep. 2020 à 01:06
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
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `comment_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `episode` tinyint(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `reported_comment` int(10) NOT NULL,
  PRIMARY KEY (`comment_id`),
  KEY `episodeId` (`episode`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`comment_id`, `episode`, `pseudo`, `comment`, `comment_date`, `reported_comment`) VALUES
(2, 2, 'Jérémy', 'Et pourquoi c\'est en latin d\'abord!', '2020-05-30 14:43:02', 0),
(10, 3, 'hubert', 'test commentaire sur épisode 3!', '2020-06-27 14:24:59', 2),
(12, 2, 'un_pseudo_qui_tue', 'cet épisode jette un froid...', '2020-06-27 14:52:58', 2),
(13, 3, 'rick_hunter', 'est-ce que ça fonctionne toujours?', '2020-06-27 14:57:15', 2),
(29, 3, 'jforteroche', 'c\'est moi l\'auteur', '2020-07-08 23:37:15', 2),
(32, 3, 'alfred de musset', 'commentaire x', '2020-07-21 17:11:13', 2),
(33, 2, 'toto', 't\'es trop nul!!!!!!', '2020-07-21 17:35:43', 2),
(40, 2, 'gérard', 'météo de merde', '2020-07-27 17:49:11', 0),
(42, 22, 'gérard', 'essayons de laisser un commentaire sous l\'épisode 4!', '2020-08-04 22:52:26', 0),
(43, 22, 'gérard', 'test commentaire', '2020-08-04 22:54:58', 0),
(53, 2, 'delafuentes', 'bonjour commissaire gordon', '2020-08-05 10:40:54', 0),
(74, 2, 'dodo_la_saumure', 'vive les partie boung bounga', '0000-00-00 00:00:00', 0),
(76, 22, 'bob_dylan', 'j\'adore le rock', '0000-00-00 00:00:00', 1),
(78, 3, 'gianluigi_buffon', 'je suis le plus grand gardien de but de l\'histoire, et j\'adore ta barbe!', '2020-08-05 14:28:12', 0),
(79, 3, 'gérard', 'commentaire ok?', '2020-08-10 14:57:37', 0),
(81, 33, 'franco', 'commentaire sur épisode 6?', '2020-08-10 14:59:09', 1),
(82, 15, 'gérard', 'cet épisode ne s\'affiche pas très bien...', '2020-08-10 14:59:59', 2),
(83, 22, 'lewis hamilton', 'plus rapide que moi, y a pas!', '2020-08-10 15:00:26', 0),
(92, 22, 'delafuentes', 'test de commentaire !', '2020-08-16 09:05:38', 0),
(98, 28, 'gérard', 'test', '2020-09-06 22:18:13', 1),
(99, 28, 'gerard', 'test - bis', '2020-09-06 22:19:34', 1),
(100, 28, 'alfred', 'pennyworth', '2020-09-06 22:29:48', 1),
(101, 28, 'batman', 'et robin', '2020-09-06 22:30:42', 0),
(104, 22, 'jean-jacques', 'j&#39;adore la musique', '2020-09-07 17:13:17', 0),
(105, 2, 'oss_117', '&#39;mais les gens ne portent donc pas de souliers ici ?!&#39;', '2020-09-12 17:57:40', 0),
(106, 2, 'gérard', 'test numéro 2257&#13;&#10;', '2020-09-12 18:04:07', 0),
(111, 15, 'Diego', 'Bonjour, j&#39;suis le cousin de Dora l&#39;exploratrice !', '2020-09-13 01:20:25', 0),
(114, 33, 'gérard', 'test 2', '2020-09-14 17:50:00', 1),
(115, 33, 'gérard', 'commentaire', '2020-09-14 22:26:39', 1);

-- --------------------------------------------------------

--
-- Structure de la table `episodes`
--

DROP TABLE IF EXISTS `episodes`;
CREATE TABLE IF NOT EXISTS `episodes` (
  `episode_id` tinyint(11) NOT NULL AUTO_INCREMENT,
  `numero_episode` tinyint(11) NOT NULL,
  `episode_title` char(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `episode_content` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `episode_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `episode_status` int(1) NOT NULL,
  PRIMARY KEY (`episode_id`),
  UNIQUE KEY `unicite` (`numero_episode`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `episodes`
--

INSERT INTO `episodes` (`episode_id`, `numero_episode`, `episode_title`, `episode_content`, `episode_date`, `episode_status`) VALUES
(2, 2, 'Les deux tours', 'Ut augue libero, molestie id sapien et, luctus gravida justo. Vivamus eu dapibus nisi. Integer molestie diam sem, quis iaculis lacus convallis vitae. Proin fermentum rhoncus ante sit amet condimentum. Quisque quis lacus et justo tristique sagittis non sit amet nibh. In hac habitasse platea dictumst. Pellentesque semper arcu eget eros euismod congue. Aenean et iaculis purus. Cras eget facilisis lorem, ac dapibus dolor. Curabitur at massa nec mi dignissim aliquam. Integer a tincidunt diam, sed aliquam quam. Nulla molestie dolor tortor, a egestas ante vulputate vel. Aenean venenatis, arcu at maximus euismod, nulla velit condimentum ligula, eu sagittis nibh dui quis est. Mauris suscipit fermentum nisi, at tempus elit mattis ut. Integer pellentesque blandit nisl, ac venenatis lectus pulvinar vel. Nunc in libero vel justo luctus accumsan ac at elit.', '2020-05-30 10:21:15', 1),
(3, 3, 'Le retour du roi', 'Vestibulum ac porta enim, posuere ullamcorper mi. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse nulla libero, elementum eget quam non, scelerisque dictum sapien. Nam aliquet arcu nec tincidunt pharetra. Pellentesque porttitor fermentum ligula, eu egestas ipsum interdum nec. Aliquam mi felis, commodo nec magna a, eleifend pretium nisi. Aenean at fermentum orci. Sed ut fringilla neque. ', '2020-05-30 10:13:34', 1),
(15, 5, 'Chapitre 5', '&#60;p&#62;Nunc non massa vitae lorem pharetra lobortis. Suspendisse tempor nulla quis magna pretium ornare. Ut vitae lorem et tortor blandit imperdiet. Etiam blandit augue sit amet augue consequat luctus. Suspendisse diam felis, mollis sed arcu et, varius sagittis enim. Praesent diam quam, congue ut purus ac, lacinia ornare sem. Nam nec consectetur dolor, vel sodales velit.Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nulla tristique mauris in sapien convallis, id tristique ipsum accumsan. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas aliquam libero molestie turpis ullamcorper semper. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Phasellus accumsan mi quis orci ornare, ut interdum lacus pretium. Suspendisse egestas massa purus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In ac turpis aliquam ex placerat cursus. Praesent condimentum nibh in convallis commodo.&#60;/p&#62;&#13;&#10;&#60;p&#62;Sed eleifend ultrices placerat. Nullam iaculis nec eros eget commodo. Cras molestie, leo vitae rhoncus convallis, sapien dolor gravida mauris, et sollicitudin lorem lorem nec ligula. Nunc diam nunc, mollis ac nisl eget, tristique malesuada mi. Nunc vitae congue nibh. Nullam mattis eu dui feugiat venenatis. Etiam porta, ex nec consectetur elementum, neque neque cursus arcu, eu bibendum purus magna at nibh. Nullam dapibus sed diam in ornare. Ut tempus ante ac urna posuere pharetra. Etiam aliquam augue at purus accumsan mattis. Etiam auctor, eros id tempor laoreet, odio tortor porttitor felis, sit amet dapibus dui nibh et est. Sed facilisis mollis efficitur. Ut pharetra sagittis nibh non ultricies. Vestibulum blandit commodo nisi ut iaculis. Maecenas sit amet nibh viverra, dictum odio at, sodales nunc. Donec auctor felis et urna vehicula lacinia malesuada vel ipsum.&#60;/p&#62;&#13;&#10;&#60;p&#62;Nam consequat justo viverra tortor varius aliquam. Pellentesque vulputate eros vitae velit dictum, id tristique ex ornare. Maecenas quis vehicula diam. Vivamus ac arcu ornare, suscipit ligula id, tincidunt urna. Nam eget suscipit arcu. Donec id urna mauris. Maecenas nec nibh eget velit venenatis auctor quis a eros. Nunc sed euismod ante. Suspendisse potenti. Integer a pharetra ligula, eget sodales odio. Ut auctor, enim ut bibendum elementum, turpis sapien vestibulum dui, ut scelerisque erat ipsum quis neque.&#60;/p&#62;&#13;&#10;&#60;p&#62;Donec tempus arcu diam, quis scelerisque nisi semper eget. Nulla sit amet quam sit amet ipsum pharetra varius et ac tortor. Vestibulum pellentesque pretium dui, et hendrerit erat lobortis vel. Donec tincidunt tellus eget rutrum vestibulum. Praesent id erat ut arcu lacinia tristique quis vitae mauris. Aliquam cursus sed magna quis placerat. Fusce faucibus orci nec suscipit iaculis. Praesent dictum sem ante, a rhoncus nibh commodo vel. In hac habitasse platea dictumst. Nam maximus, tortor at eleifend hendrerit, ipsum lectus lobortis quam, eu rutrum mi odio sit amet nulla. Integer quis imperdiet lectus, at facilisis massa. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce ut lectus sit amet lectus interdum posuere ut quis felis. Nam rutrum augue et nibh bibendum, ut faucibus risus maximus. Ut consequat, diam in tristique tempor, nisi velit congue sem, non varius ipsum ipsum nec velit. Aliquam ac sem lacus.&#60;/p&#62;&#13;&#10;&#60;p&#62;Donec ac varius nulla. Quisque rhoncus purus vitae condimentum tempor. Quisque in blandit arcu. Nam elementum quam eu tellus fermentum, eu venenatis nisl consectetur. Nunc at quam fringilla, iaculis nisl in, placerat dui. Sed egestas nisl a nibh consequat, vel congue dui ullamcorper. Aliquam consequat lorem vitae elementum gravida.&#60;/p&#62;&#13;&#10;&#60;p&#62;Mauris lobortis laoreet nulla, quis ultrices turpis fringilla non. Vivamus varius nulla dui, et vehicula nisi iaculis congue. Maecenas blandit vehicula dapibus. Donec pretium purus vitae odio tincidunt blandit. Quisque in lacus iaculis ligula bibendum pharetra sed vitae ante. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi at tempus risus. Donec faucibus dui lorem, a euismod leo mollis non. Integer&#60;/p&#62;', '2020-07-21 00:43:39', 1),
(22, 4, 'Le quatuor infernal', '&#60;p&#62;Les expendables sont l&#38;agrave;: Stallone, Schwarzennegger, VanDamme et WesleySnipes!&#60;/p&#62;', '2020-07-21 22:49:53', 1),
(28, 1, 'Le début de la fin', '&#60;p&#62;r&#38;eacute;vision 1&#60;/p&#62;&#13;&#10;&#60;p&#62;On ajoute un paragraphe ici !&#60;/p&#62;&#13;&#10;&#60;p&#62;Vestibulum faucibus nisl felis, eget consequat ipsum consequat eu. Donec et lobortis metus, sed finibus nunc. Nam nisl lacus, gravida et mi et, vehicula commodo orci. Maecenas porttitor sem id sapien posuere, porta convallis lorem suscipit. Ut feugiat neque id feugiat congue. Maecenas finibus sapien neque, ultrices rhoncus neque vulputate non. Donec gravida massa in dolor tincidunt bibendum non et lacus. Proin at vehicula massa, non finibus ipsum. Aenean suscipit nunc et mattis sollicitudin. Duis in eros sodales, porttitor tortor non, rhoncus augue. Donec consequat molestie viverra. In condimentum sit amet diam eu tristique. Vestibulum quis luctus libero, in mattis leo. Integer eu mattis tellus. Donec malesuada laoreet semper. Curabitur tempor est eu ex tempus, eget bibendum nunc rutrum. Praesent eu tristique sem. Nulla scelerisque dui ac velit facilisis pulvinar nec vitae enim. Nulla volutpat tellus enim, sit amet posuere tortor viverra et. Pellentesque et mattis nulla, eu consectetur eros. Pellentesque ut tristique nisl, lacinia luctus lectus. Fusce elementum, lectus eu pellentesque ullamcorper, urna sapien feugiat leo, eget sodales risus ex eget sapien. Nunc interdum quam in leo gravida porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse ut blandit nibh. Praesent eu facilisis tortor. Fusce euismod id leo ac faucibus. Ut ornare dolor tristique mattis&#60;/p&#62;', '2020-08-01 00:36:33', 1),
(33, 6, 'John Wick: baddass!', ' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean auctor justo vel sollicitudin consectetur. Quisque varius dolor arcu, eget suscipit ex venenatis non. Sed cursus lacinia tempor. Maecenas venenatis eleifend pellentesque. Quisque venenatis sit amet urna id egestas. Nulla consectetur enim id dui euismod tincidunt. Donec semper mollis tortor, at interdum nulla hendrerit nec. Aenean sodales augue ac elit porta congue. Morbi ac est nunc. Duis ac tortor magna. Vivamus venenatis nulla vel rutrum sagittis. Phasellus nisl orci, luctus sed felis sit amet, placerat vehicula arcu.\r\n\r\nSed id mauris massa. Nunc quis dictum purus, sit amet pharetra augue. Nam mattis molestie ex semper convallis. Ut malesuada erat eu velit molestie lobortis. Maecenas feugiat turpis elit, vel fermentum est pharetra vitae. Integer dictum ex dictum, convallis justo in, tristique ipsum. Duis pretium convallis lorem, eget vehicula magna pharetra pretium. Proin ut consequat dui, a aliquet lorem. Aliquam facilisis semper pulvinar. Nunc fringilla sem sem, sit amet auctor neque finibus vel. In ac risus sed lorem mattis condimentum eu in urna. Nam leo turpis, maximus eget dictum sit amet, cursus eleifend metus. Morbi eu leo eu nisl bibendum blandit et at risus. ', '2020-08-09 22:34:24', 1),
(75, 10, 'test révision 1', '&#60;p&#62;brouillon 2 initial&#60;/p&#62;&#13;&#10;&#60;p&#62;r&#38;eacute;vision 1&#60;/p&#62;&#13;&#10;&#60;p&#62;r&#38;eacute;vision 2&#60;/p&#62;', '2020-09-28 23:04:29', 1),
(76, 55, 'coucou', '&#60;p&#62;test&#60;/p&#62;', '2020-09-29 02:40:25', 1),
(77, 79, 'test', '', '2020-09-29 02:40:50', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `pass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`username`, `pass`) VALUES
('gerard', '$2y$10$nET2GXwuP/VGNrlvv1pFCe4bJWUsn0DKAh3rgefADf2y82VA7Aiim');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `episodeId` FOREIGN KEY (`episode`) REFERENCES `episodes` (`episode_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
