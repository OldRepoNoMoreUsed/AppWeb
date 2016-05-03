-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 24 Janvier 2016 à 12:52
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `exercicepoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) NOT NULL,
  `password_user` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_user`),
  UNIQUE KEY `name_user` (`name_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `tb_users`
--

INSERT INTO `tb_users` (`ID_user`, `name_user`, `password_user`) VALUES
(6, 'Michel', 'e6001e7b094a44fd74d2f4b70ac8332af0004d06'),
(7, 'Andre', 'f090c4b22631f6ee9ac27997c2c8506ed2bb0daa'),
(8, 'as', '7ddbb6309d14a74d92e31b26f3ff5454dfa0708b'),
(9, 'michouillle', 'f2d257805521548c8a26a17e470ae8445901d779'),
(12, 'asassa', '91eaf35cda9cf20d78166b4989050bb9e84c6842');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
