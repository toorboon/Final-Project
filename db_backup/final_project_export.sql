CREATE DATABASE  IF NOT EXISTS `mariocf_final_project` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `mariocf_final_project`;
-- MySQL dump 10.13  Distrib 5.7.24, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: slpt_final_project
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.36-MariaDB

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
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `office_start` time DEFAULT NULL,
  `office_end` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_day`
--

DROP TABLE IF EXISTS `course_day`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_day` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `technology` varchar(55) DEFAULT NULL,
  `technology_day` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_day_1_idx` (`course_id`),
  CONSTRAINT `fk_course_day_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_day`
--

LOCK TABLES `course_day` WRITE;
/*!40000 ALTER TABLE `course_day` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_day` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_exercises`
--

DROP TABLE IF EXISTS `course_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_day_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_course_exercises_1_idx` (`course_day_id`),
  CONSTRAINT `fk_course_exercises_1` FOREIGN KEY (`course_day_id`) REFERENCES `course_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_exercises`
--

LOCK TABLES `course_exercises` WRITE;
/*!40000 ALTER TABLE `course_exercises` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_exercises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_enrollment_1_idx` (`user_id`),
  KEY `fk_enrollment_2_idx` (`course_id`),
  CONSTRAINT `fk_enrollment_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_enrollment_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pair`
--

DROP TABLE IF EXISTS `pair`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pair` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_day_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pair_1_idx` (`course_day_id`),
  CONSTRAINT `fk_pair_1` FOREIGN KEY (`course_day_id`) REFERENCES `course_day` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pair`
--

LOCK TABLES `pair` WRITE;
/*!40000 ALTER TABLE `pair` DISABLE KEYS */;
/*!40000 ALTER TABLE `pair` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pair_exercises`
--

DROP TABLE IF EXISTS `pair_exercises`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pair_exercises` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pair_id` int(11) NOT NULL,
  `course_exercise_id` int(11) NOT NULL,
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pair_exercises_1_idx` (`pair_id`),
  KEY `fk_pair_exercises_2_idx` (`course_exercise_id`),
  CONSTRAINT `fk_pair_exercises_1` FOREIGN KEY (`pair_id`) REFERENCES `pair` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pair_exercises_2` FOREIGN KEY (`course_exercise_id`) REFERENCES `course_exercises` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pair_exercises`
--

LOCK TABLES `pair_exercises` WRITE;
/*!40000 ALTER TABLE `pair_exercises` DISABLE KEYS */;
/*!40000 ALTER TABLE `pair_exercises` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pair_partner`
--

DROP TABLE IF EXISTS `pair_partner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pair_partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pair_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `leader` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pair_partner_1_idx` (`pair_id`),
  KEY `fk_pair_partner_2_idx` (`user_id`),
  CONSTRAINT `fk_pair_partner_1` FOREIGN KEY (`pair_id`) REFERENCES `pair` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_pair_partner_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pair_partner`
--

LOCK TABLES `pair_partner` WRITE;
/*!40000 ALTER TABLE `pair_partner` DISABLE KEYS */;
/*!40000 ALTER TABLE `pair_partner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(155) NOT NULL,
  `lname` varchar(155) NOT NULL,
  `username` varchar(55) NOT NULL,
  `password` char(76) NOT NULL,
  `email` varchar(55) NOT NULL,
  `github` varchar(155) NOT NULL,
  `info` text,
  `user_role_id` int(11) NOT NULL,
  `door_entry_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `github_UNIQUE` (`github`),
  KEY `fk_user_1_idx` (`user_role_id`),
  CONSTRAINT `fk_user_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-07 13:03:00
