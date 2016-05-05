-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sandboxlearn
-- ------------------------------------------------------
-- Server version	5.6.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_list`
--

DROP TABLE IF EXISTS `tb_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_list` (
  `ID_list` int(11) NOT NULL AUTO_INCREMENT,
  `list_name` varchar(45) NOT NULL,
  `list_description` text,
  `list_commentary` text,
  `list_difficulty` int(11) DEFAULT NULL,
  `list_owner_user` int(11) NOT NULL,
  PRIMARY KEY (`ID_list`),
  KEY `fk_list_user1_idx` (`list_owner_user`),
  CONSTRAINT `fk_list_user1` FOREIGN KEY (`list_owner_user`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_list_question`
--

DROP TABLE IF EXISTS `tb_list_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_list_question` (
  `list_ID_list` int(11) NOT NULL,
  `question_ID_question` int(11) NOT NULL,
  PRIMARY KEY (`list_ID_list`,`question_ID_question`),
  KEY `fk_list_has_Question_Question1_idx` (`question_ID_question`),
  KEY `fk_list_has_Question_list1_idx` (`list_ID_list`),
  CONSTRAINT `fk_list_has_Question_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_list_has_Question_Question1` FOREIGN KEY (`question_ID_question`) REFERENCES `tb_question` (`ID_question`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_list_tag`
--

DROP TABLE IF EXISTS `tb_list_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_list_tag` (
  `list_ID_list` int(11) NOT NULL,
  `tag_ID_tag` int(11) NOT NULL,
  PRIMARY KEY (`list_ID_list`,`tag_ID_tag`),
  KEY `fk_list_has_tag_tag1_idx` (`tag_ID_tag`),
  KEY `fk_list_has_tag_list1_idx` (`list_ID_list`),
  CONSTRAINT `fk_list_has_tag_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_list_has_tag_tag1` FOREIGN KEY (`tag_ID_tag`) REFERENCES `tb_tag` (`ID_tag`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_list_workout`
--

DROP TABLE IF EXISTS `tb_list_workout`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_list_workout` (
  `user_ID_user` int(11) NOT NULL,
  `list_ID_list` int(11) NOT NULL,
  PRIMARY KEY (`user_ID_user`,`list_ID_list`),
  KEY `fk_user_has_list_list1_idx` (`list_ID_list`),
  KEY `fk_user_has_list_user1_idx` (`user_ID_user`),
  CONSTRAINT `fk_user_has_list_list1` FOREIGN KEY (`list_ID_list`) REFERENCES `tb_list` (`ID_list`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_list_user1` FOREIGN KEY (`user_ID_user`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_masteries`
--

DROP TABLE IF EXISTS `tb_masteries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_masteries` (
  `user_ID_Utilisateur` int(11) NOT NULL,
  `question_ID_Question` int(11) NOT NULL,
  `level` int(11) DEFAULT NULL,
  `last_answer` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_ID_Utilisateur`,`question_ID_Question`),
  KEY `fk_user_has_Question_Question1_idx` (`question_ID_Question`),
  KEY `fk_user_has_Question_user1_idx` (`user_ID_Utilisateur`),
  CONSTRAINT `fk_user_has_Question_Question1` FOREIGN KEY (`question_ID_Question`) REFERENCES `tb_question` (`ID_question`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_Question_user1` FOREIGN KEY (`user_ID_Utilisateur`) REFERENCES `tb_user` (`ID_user`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_question`
--

DROP TABLE IF EXISTS `tb_question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_question` (
  `ID_Question` int(11) NOT NULL AUTO_INCREMENT,
  `Question` varchar(140) NOT NULL,
  `Answer` varchar(140) NOT NULL,
  PRIMARY KEY (`ID_Question`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_tag`
--

DROP TABLE IF EXISTS `tb_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_tag` (
  `ID_tag` int(11) NOT NULL,
  `tag` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `tb_user`
--

DROP TABLE IF EXISTS `tb_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_user` (
  `ID_User` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(45) NOT NULL,
  PRIMARY KEY (`ID_User`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-05 22:29:36
