-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: artisti
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

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
-- Table structure for table `artisti`
--

DROP TABLE IF EXISTS `artisti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `artisti` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `genere` varchar(20) DEFAULT NULL,
  `nazionalita` varchar(20) NOT NULL,
  `note` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `artisti`
--

LOCK TABLES `artisti` WRITE;
/*!40000 ALTER TABLE `artisti` DISABLE KEYS */;
INSERT INTO `artisti` VALUES (1,'mika','pop','inglese',NULL),(2,'nicky minaj','pop','inglese',NULL),(3,'mina','pop','italiana',NULL),(4,'eminem','rap','inglese',NULL),(5,'enrique iglesias','pop','spagnola',NULL),(6,'alvaro soleil','pop','spagnola',NULL);
/*!40000 ALTER TABLE `artisti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brani`
--

DROP TABLE IF EXISTS `brani`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brani` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(20) NOT NULL,
  `durata` int(11) NOT NULL,
  `posizione` int(11) NOT NULL,
  `idartista` int(11) NOT NULL,
  `idregistrazione` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idartista` (`idartista`),
  KEY `idregistrazione` (`idregistrazione`),
  CONSTRAINT `brani_ibfk_1` FOREIGN KEY (`idartista`) REFERENCES `artisti` (`id`),
  CONSTRAINT `brani_ibfk_2` FOREIGN KEY (`idregistrazione`) REFERENCES `registrazioni` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brani`
--

LOCK TABLES `brani` WRITE;
/*!40000 ALTER TABLE `brani` DISABLE KEYS */;
INSERT INTO `brani` VALUES (1,'io',5,1,5,1),(2,'sono',5,2,5,1),(3,'me',5,3,5,1),(4,'rap god',5,1,4,2);
/*!40000 ALTER TABLE `brani` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registrazioni`
--

DROP TABLE IF EXISTS `registrazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registrazioni` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titolo` varchar(20) NOT NULL,
  `etichetta` varchar(20) DEFAULT NULL,
  `data` date NOT NULL,
  `numerobrani` int(11) NOT NULL,
  `duratatotale` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registrazioni`
--

LOCK TABLES `registrazioni` WRITE;
/*!40000 ALTER TABLE `registrazioni` DISABLE KEYS */;
INSERT INTO `registrazioni` VALUES (1,'the dark side of the',NULL,'2017-02-07',3,50),(2,'recovery',NULL,'2017-02-07',3,50);
/*!40000 ALTER TABLE `registrazioni` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-11 10:38:35
