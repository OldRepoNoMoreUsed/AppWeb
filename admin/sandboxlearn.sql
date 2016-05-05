-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 05 Mai 2016 à 13:05
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

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
  `ID_list` int(11) NOT NULL,
  `list_name` varchar(45) NOT NULL,
  `list_description` text,
  `list_commentary` text,
  `list_difficulty` int(11) DEFAULT NULL,
  `list_owner_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_list`,`list_owner_user`),
  KEY `fk_list_user1_idx` (`list_owner_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tb_list`
--

INSERT INTO `tb_list` (`ID_list`, `list_name`, `list_description`, `list_commentary`, `list_difficulty`, `list_owner_user`) VALUES
(0, 'jeanclaudeliste', 'listedejeanclaude', 'c''est la liste de jeanclaude', 0, 1),
(0, 'listedemicheline', 'micheline micheline', 'C''est la liste de michou', 0, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `tb_question`
--

INSERT INTO `tb_question` (`ID_Question`, `Question`, `Answer`) VALUES
(1, 'micheline ?', 'micheline'),
(2, 'micheline ?', 'micheline'),
(3, 'alala ?', 'alala'),
(4, 'alala ?', 'alala'),
(5, 'mot ?', 'mot'),
(6, 'ralph ? ', 'ralph'),
(7, 'as', 'as'),
(8, 'as', 'ass'),
(9, 'as', 'ass');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tb_user`
--

INSERT INTO `tb_user` (`ID_User`, `username`, `password`) VALUES
(1, 'jeanclaude', 'bd38569543fcf364ab330953b538a1bbaa28318c'),
(2, 'micheline', 'cead3d9a75808e4499c12889085dc8164568fa96'),
(3, 'Ralph', '670570dc40d295c82be16b04bf88cce6a2e5db79');

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
