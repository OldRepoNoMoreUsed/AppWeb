-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 11 Mai 2016 à 08:41
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `sandboxlearn`
--

-- --------------------------------------------------------

--
-- Structure de la table `tb_list`
--

CREATE TABLE IF NOT EXISTS `tb_list` (
  `ID_list` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(45) NOT NULL,
  `list_description` text,
  `list_commentary` text,
  `list_difficulty` int(11) DEFAULT NULL,
  `list_owner_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_list`),
  KEY `fk_list_user1_idx` (`list_owner_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `tb_list`
--

INSERT INTO `tb_list` (`ID_list`, `list_name`, `list_description`, `list_commentary`, `list_difficulty`, `list_owner_user`) VALUES
(2, 'Math', 'Question de math', 'C est facile de creer un questionnaire', 0, 4),
(3, 'Fancais', 'Question de francais', 'C est facile', 0, 4),
(4, 'Math', 'Truc', 'C est des math', 0, 5),
(5, 'Allemand', 'Questionnaire d''allemand', 'C est dur l''allemand', 0, 9),
(6, 'Math', 'Math', 'Math', 0, 10),
(7, 'Questionnaire info', 'Informatique', 'truc', 0, 5);

-- --------------------------------------------------------

--
-- Structure de la table `tb_list_question`
--

CREATE TABLE IF NOT EXISTS `tb_list_question` (
  `list_ID_list` int(11) NOT NULL,
  `question_ID_question` int(11) NOT NULL,
  PRIMARY KEY (`list_ID_list`,`question_ID_question`),
  KEY `fk_list_has_Question_Question1_idx` (`question_ID_question`),
  KEY `fk_list_has_Question_list1_idx` (`list_ID_list`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tb_list_question`
--

INSERT INTO `tb_list_question` (`list_ID_list`, `question_ID_question`) VALUES
(2, 12),
(2, 13),
(2, 14),
(3, 15),
(4, 16),
(4, 17),
(5, 18),
(6, 19),
(6, 20),
(7, 21),
(7, 22),
(4, 23),
(4, 24);

-- --------------------------------------------------------

--
-- Structure de la table `tb_list_tag`
--

CREATE TABLE IF NOT EXISTS `tb_list_tag` (
  `list_ID_list` int(11) NOT NULL,
  `tag_ID_tag` int(11) NOT NULL,
  PRIMARY KEY (`list_ID_list`,`tag_ID_tag`),
  KEY `fk_list_has_tag_tag1_idx` (`tag_ID_tag`),
  KEY `fk_list_has_tag_list1_idx` (`list_ID_list`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_list_workout`
--

CREATE TABLE IF NOT EXISTS `tb_list_workout` (
  `user_ID_user` int(11) NOT NULL,
  `list_ID_list` int(11) NOT NULL,
  PRIMARY KEY (`user_ID_user`,`list_ID_list`),
  KEY `fk_user_has_list_list1_idx` (`list_ID_list`),
  KEY `fk_user_has_list_user1_idx` (`user_ID_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_masteries`
--

CREATE TABLE IF NOT EXISTS `tb_masteries` (
  `user_ID_Utilisateur` int(11) NOT NULL,
  `question_ID_Question` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `last_answer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_ID_Utilisateur`,`question_ID_Question`),
  KEY `fk_user_has_Question_Question1_idx` (`question_ID_Question`),
  KEY `fk_user_has_Question_user1_idx` (`user_ID_Utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_question`
--

CREATE TABLE IF NOT EXISTS `tb_question` (
  `ID_Question` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(140) NOT NULL,
  `Answer` varchar(140) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `tb_question`
--

INSERT INTO `tb_question` (`ID_Question`, `Question`, `Answer`) VALUES
(12, '1+1', '2'),
(13, '2+2', '4'),
(14, '3+3', '6'),
(15, 'Comment ecrire: Salut ? ', 'Salut'),
(16, '1+1', '2'),
(17, '2+2', '4'),
(18, 'Le chien ', 'Hund'),
(19, '1+1', '2'),
(20, '2+2', '4'),
(21, 'Coucou', 'Poil'),
(22, 'Coucou', 'Poil'),
(23, '', ''),
(24, '2+3', '5');

-- --------------------------------------------------------

--
-- Structure de la table `tb_tag`
--

CREATE TABLE IF NOT EXISTS `tb_tag` (
  `ID_tag` int(11) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_user`
--

CREATE TABLE IF NOT EXISTS `tb_user` (
  `ID_User` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_User`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `tb_user`
--

INSERT INTO `tb_user` (`ID_User`, `username`, `password`) VALUES
(4, 'nicolas', '747ba81292263efe575671ecfc8c431eedca138f'),
(5, 'Fixfox', 'dbef73b7084cbcacaeea28f1d684298e0395bda1'),
(6, 'Fix', '6cfa2e38dc7c630da1c32d72bb0869320dfbc42c'),
(8, 'Charles', '40d09ce675c5946f52c8ac7daa910be120794f7d'),
(9, 'Mirine', '1f84d6679be01fead43c2901fed2d5be7956edf5'),
(10, 'Albert', 'ae505eb97bc09b41c1e918cabdbf34224c04f4da');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tb_list`
--
ALTER TABLE `tb_list`
  ADD CONSTRAINT `fk_list_user1` FOREIGN KEY (`list_owner_user`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tb_list_question`
--
ALTER TABLE `tb_list_question`
  ADD CONSTRAINT `fk_list_has_Question_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_list_has_Question_Question1` FOREIGN KEY (`question_ID_question`) REFERENCES `tb_question` (`ID_question`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tb_list_tag`
--
ALTER TABLE `tb_list_tag`
  ADD CONSTRAINT `fk_list_has_tag_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_list_has_tag_tag1` FOREIGN KEY (`tag_ID_tag`) REFERENCES `tb_tag` (`ID_tag`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tb_list_workout`
--
ALTER TABLE `tb_list_workout`
  ADD CONSTRAINT `fk_user_has_list_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_list_user1` FOREIGN KEY (`user_ID_user`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tb_masteries`
--
ALTER TABLE `tb_masteries`
  ADD CONSTRAINT `fk_user_has_Question_Question1` FOREIGN KEY (`question_ID_Question`) REFERENCES `tb_question` (`ID_question`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_has_Question_user1` FOREIGN KEY (`user_ID_Utilisateur`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
