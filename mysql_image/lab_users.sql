-- MySQL dump 10.13  Distrib 8.0.31, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: HR-DB
-- ------------------------------------------------------
-- Server version	8.0.31

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credentials` (
  `ID` int unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `EID` varchar(20) DEFAULT NULL,
  `Salary` int DEFAULT NULL,
  `Birth` varchar(20) DEFAULT NULL,
  `NationalInsuranceNo` varchar(20) DEFAULT NULL,
  `PhoneNumber` varchar(20) DEFAULT NULL,
  `Email` varchar(300) DEFAULT NULL,
  `Password` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employees`
--

LOCK TABLES `credentials` WRITE;
/*!40000 ALTER TABLE `credentials` DISABLE KEYS */;
INSERT INTO `credentials` VALUES  (1,'Alpha','10',80000,'10/07','NB12746325B','','','6132295fcf5570fb8b0a944ef322a598'),
                                  (2,'Bravo','20',75000,'20/04','DA83762163V','','','01a2da07bf36766155f48fc670d53fe8'),
                                  (3,'Charlie','30',40000,'01/08','JC834645277B','','','ea2bfa79cd221f1e88a9bf39ea155cd8'),
                                  (4,'Delta','40',90000,'11/01','EF2747556298A','','','db1f4ab5845def61a83d5df13e0c2397'),
                                  (5,'Ethan','50',55000,'11/03','OP63624164B','','','e05699b45eae134804f4419d3fbb3139'),
                                  (6,'Faraday','60',50000,'23/02','JY2734827C','','','8a2616385414d08a46c455359bf20f8e'),
                                  (7,'Admin','99',null,'','','','','c418f34f261efe1473465ade95bfc22c');
/*!40000 ALTER TABLE `credentials` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `dept_no` char(4) NOT NULL,
  `dept_name` varchar(40) NOT NULL,
  PRIMARY KEY (`dept_no`),
  UNIQUE KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES ('d009','Cyber Security'),('d005','Creative Tech'),('d002','Business Computing'),('d003','Computer Science'),('d001','Executive Admin');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;
