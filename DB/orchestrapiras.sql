-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: orchestrapiras
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
-- Table structure for table `abilita`
--

DROP TABLE IF EXISTS `abilita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abilita` (
  `codmus` varchar(7) NOT NULL,
  `nomestr` varchar(20) NOT NULL,
  PRIMARY KEY (`codmus`,`nomestr`),
  KEY `nomestr` (`nomestr`),
  CONSTRAINT `abilita_ibfk_1` FOREIGN KEY (`nomestr`) REFERENCES `strumenti` (`nomestr`),
  CONSTRAINT `abilita_ibfk_2` FOREIGN KEY (`codmus`) REFERENCES `musicisti` (`codmus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abilita`
--

LOCK TABLES `abilita` WRITE;
/*!40000 ALTER TABLE `abilita` DISABLE KEYS */;
INSERT INTO `abilita` VALUES ('CM12340','Pianoforte'),('CM12341','Arpa'),('CM12343','Tromba'),('CM12344','Chitarra'),('CM12345','Chitarra'),('CM12346','Basso'),('CM12346','Batteria'),('CM12346','Chitarra'),('CM12346','Percussioni'),('CM12346','Pianoforte'),('CM12346','Tromba'),('CM12347','Chitarra'),('CM12348','Sax Tenore'),('CM12349','Tromba');
/*!40000 ALTER TABLE `abilita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `musicisti`
--

DROP TABLE IF EXISTS `musicisti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `musicisti` (
  `codmus` varchar(7) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `datanascita` date DEFAULT NULL,
  `sesso` enum('M','F') NOT NULL,
  PRIMARY KEY (`codmus`),
  UNIQUE KEY `nome` (`nome`,`cognome`,`datanascita`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `musicisti`
--

LOCK TABLES `musicisti` WRITE;
/*!40000 ALTER TABLE `musicisti` DISABLE KEYS */;
INSERT INTO `musicisti` VALUES ('CM12340','Angela','Hewitt','1955-03-30','F'),('CM12341','Cecilia','Chaily','1971-12-15','F'),('CM12342','Billie','Holiday','1915-04-07','F'),('CM12343','Chet','Baker','1929-12-23','M'),('CM12344','Pat','Metheny','1954-08-12','M'),('CM12345','Keith','Richards','1943-12-18','M'),('CM12346','Mike','Oldfield','1949-11-20','M'),('CM12347','Janis','Joplin','1943-01-19','F'),('CM12348','John','Coltrane','1926-08-20','M'),('CM12349','Miles','Davis','1926-05-26','M');
/*!40000 ALTER TABLE `musicisti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `strumenti`
--

DROP TABLE IF EXISTS `strumenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `strumenti` (
  `nomestr` varchar(20) NOT NULL,
  `categoria` varchar(20) NOT NULL DEFAULT 'Non Definito',
  PRIMARY KEY (`nomestr`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `strumenti`
--

LOCK TABLES `strumenti` WRITE;
/*!40000 ALTER TABLE `strumenti` DISABLE KEYS */;
INSERT INTO `strumenti` VALUES ('Arpa','A Corde'),('Basso','A Corde'),('Batteria','Ritmica'),('Chitarra','A Corde'),('Percussioni','Ritmica'),('Pianoforte','A Corde'),('Sax Tenore','Ottoni'),('Tromba','Ottoni'),('Violino','A Corde');
/*!40000 ALTER TABLE `strumenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-25 10:53:37
