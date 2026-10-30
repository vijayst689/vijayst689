-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: pkrmsolution
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.20.04.1

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
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `district` (
  `id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `short_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Chennai',NULL,'Active'),(2,'Coimbatore',NULL,'Active'),(3,'Cuddalore',NULL,'Active'),(4,'Dharmapuri',NULL,'Active'),(5,'Dindigul',NULL,'Active'),(6,'Erode',NULL,'Active'),(7,'Kancheepuram',NULL,'Active'),(8,'Kanniyakumari',NULL,'Active'),(9,'Karur',NULL,'Active'),(10,'Madurai',NULL,'Active'),(11,'Nagapattinam',NULL,'Active'),(12,'Namakkal',NULL,'Active'),(13,'The Nilgiris',NULL,'Active'),(14,'Perambalur',NULL,'Active'),(15,'Pudukottai',NULL,'Active'),(16,'Ramanathapuram',NULL,'Active'),(17,'Salem',NULL,'Active'),(18,'Sivagangai',NULL,'Active'),(19,'Thanjavur',NULL,'Active'),(20,'Theni',NULL,'Active'),(21,'Thiruvallur',NULL,'Active'),(22,'Thiruvannamalai',NULL,'Active'),(23,'Thiruvarur',NULL,'Active'),(24,'Thoothukudi',NULL,'Active'),(25,'Tiruchirappalli',NULL,'Active'),(26,'Tirunelveli',NULL,'Active'),(27,'Vellore',NULL,'Active'),(28,'Villupuram',NULL,'Active'),(29,'Virudhunagar',NULL,'Active'),(30,'Ariyalur',NULL,'Active'),(31,'Krishnagiri',NULL,'Active'),(32,'Tiruppur',NULL,'Active'),(33,'Chengalpattu',NULL,'Active'),(34,'Kallakurichi',NULL,'Active'),(35,'Ranipet',NULL,'Active'),(36,'Tenkasi',NULL,'Active'),(37,'Tirupathur',NULL,'Active'),(38,'Mayiladuthurai',NULL,'Active');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-10-29 13:09:25
