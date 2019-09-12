-- MySQL dump 10.16  Distrib 10.1.22-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: rocomplaints
-- ------------------------------------------------------
-- Server version	10.1.22-MariaDB

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `admin_cpf` int(11) NOT NULL,
  `admin_type` enum('ALL','CIVIL','ELECTRICAL','HOUSEKEEPING') NOT NULL,
  PRIMARY KEY (`admin_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (48347,'ELECTRICAL'),(78344,'ALL'),(121726,'ALL'),(122467,'HOUSEKEEPING'),(125619,'CIVIL'),(134015,'ALL');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `complains`
--

DROP TABLE IF EXISTS `complains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `complains` (
  `complain_type` enum('CIVIL','ELECTRICAL','HOUSEKEEPING','INFOCOM') NOT NULL,
  `complain_id` int(11) NOT NULL AUTO_INCREMENT,
  `complain_category` varchar(256) NOT NULL,
  `complain_location` enum('OFFICE','RESIDENCE') NOT NULL,
  `complain_office_colony` varchar(64) NOT NULL,
  `complain_address` varchar(256) NOT NULL,
  `complain_description` varchar(512) DEFAULT NULL,
  `complain_time` varchar(128) DEFAULT NULL,
  `complain_createdat` date NOT NULL,
  `complain_cpf` int(11) NOT NULL,
  `complain_status` enum('OPEN','ASSIGNED','CLOSED') NOT NULL DEFAULT 'OPEN',
  `complain_name` varchar(128) NOT NULL,
  `complain_dept` varchar(128) DEFAULT NULL,
  `complain_desg` varchar(64) NOT NULL,
  `complain_mob` varchar(16) DEFAULT NULL,
  `complain_remark` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`complain_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `complains`
--

LOCK TABLES `complains` WRITE;
/*!40000 ALTER TABLE `complains` DISABLE KEYS */;
INSERT INTO `complains` VALUES ('INFOCOM',1,'Telephone(Landline)','OFFICE','Vasudhara Bhawan','C4, 4th Floor, B Wing','Telephone not working. Please fix.','Any time.','2019-09-05',125619,'OPEN','BHANU PRATAP SINGH','CORP GEOPHYSICAL SERVICES (MUMBAI)','Sr.Prog.Officer','09969226645',NULL),('CIVIL',2,'Carpentary','RESIDENCE','Gokuldham, Goregaon (E)','301, A-82','Door is broken. Please replace.','After 6:30 pm.','2019-09-05',125619,'OPEN','BHANU PRATAP SINGH','CORP GEOPHYSICAL SERVICES (MUMBAI)','Sr.Prog.Officer','09969226645',NULL),('ELECTRICAL',3,'Power Supply','OFFICE','NBP Green Heights','C6, 4-Q-4','UPS failed.','Work hours.','2019-09-05',125619,'OPEN','BHANU PRATAP SINGH','CORP GEOPHYSICAL SERVICES (MUMBAI)','Sr.Prog.Officer','09969226645',NULL);
/*!40000 ALTER TABLE `complains` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-05 17:08:17
