-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: newsite
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.20.04.1

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
-- Table structure for table `family_member`
--

DROP TABLE IF EXISTS `family_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `family_member` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT '0',
  `relation` varchar(30) DEFAULT NULL,
  `relation_name` varchar(80) DEFAULT NULL,
  `relation_age` varchar(10) DEFAULT NULL,
  `relation_status` varchar(20) DEFAULT NULL,
  `relationaadhaar_card` varchar(20) DEFAULT NULL,
  `relationdeath_cert` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family_member`
--

LOCK TABLES `family_member` WRITE;
/*!40000 ALTER TABLE `family_member` DISABLE KEYS */;
INSERT INTO `family_member` VALUES (1,120,'Daughter','gurumurthi','53','Alive',NULL,NULL),(2,121,'Daughter','gurumurthi','53','Alive',NULL,NULL),(3,129,'Husband','Gurumurthi K','53','Alive',NULL,NULL),(4,130,'Wife','PAVITHRA V','24','Alive',NULL,NULL),(5,131,'Wife','PAVITHRA V','24','Alive',NULL,NULL),(6,132,'Wife','PAVITHRA V','24','Alive',NULL,NULL),(7,133,'Wife','Rajalakshmi','34','Alive',NULL,NULL),(8,134,'Wife','Rajalakshmi','34','Alive',NULL,NULL),(9,138,'Husband','VINOTHPRABAKARAN','32','Alive',NULL,NULL),(10,142,'Husband','VINOTHPRABAKARAN','32','Alive','10.jpg',NULL),(11,147,'Daughter','amuthavalli','26','Alive','11.jpg',NULL),(12,157,'Wife','gee','45','Alive','12.jpg',NULL),(13,158,'Husband','raj','32','Alive','13.jpg',NULL),(14,165,'Wife','SARATHA','26','Alive','14.jpg',NULL),(15,165,'Daughter','HARSHIKALAKSHMI','5','Alive','15.jpg',NULL),(16,166,'Husband','MAHENDRAN','38','Alive','16.pdf',NULL),(17,166,'Daughter','PRANAVAKARTHIKA','4','Alive','17.pdf',NULL),(18,171,'Husband','VINOTHPRABAKARAN','32','Alive','18.jpg',NULL),(19,174,'Wife','1','36','Alive','19.jpg',NULL),(20,176,'Husband','dgf','29','Alive','20.jpg',NULL);
/*!40000 ALTER TABLE `family_member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-11-05  7:25:05
