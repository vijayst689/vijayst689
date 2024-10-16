-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: recharge
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `request_payment`
--

DROP TABLE IF EXISTS `request_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `req_time` varchar(20) DEFAULT NULL,
  `req_date` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `req_image` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
);
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_payment`
--

LOCK TABLES `request_payment` WRITE;
/*!40000 ALTER TABLE `request_payment` DISABLE KEYS */;
INSERT INTO `request_payment` VALUES (1,204,1,3000.00,'2024-03-26 22:07:20','2024-03-26','Approved','1.jpg'),(2,46447,1,319.00,'2024-03-30 08:46:41','2024-03-30','Declined','2.jpg'),(3,46452,1,265.00,'2024-04-03 15:47:24','2024-04-03','Declined','3.jpg'),(4,46452,1,265.00,'2024-04-03 15:47:25','2024-04-03','Approved','4.jpg'),(5,46452,1,155.00,'2024-04-03 15:55:47','2024-04-03','Declined','5.jpg'),(6,46452,1,155.00,'2024-04-03 15:55:49','2024-04-03','Declined','6.jpg'),(7,46452,1,155.00,'2024-04-03 15:55:52','2024-04-03','Declined','7.jpg'),(8,46452,1,155.00,'2024-04-03 15:55:53','2024-04-03','Declined','8.jpg'),(9,46452,1,155.00,'2024-04-03 15:55:53','2024-04-03','Declined','9.jpg'),(10,46452,1,155.00,'2024-04-03 15:56:01','2024-04-03','Declined','10.jpg'),(11,46452,1,155.00,'2024-04-03 15:56:02','2024-04-03','Approved','11.jpg'),(12,12906,1,299.00,'2024-04-03 22:13:59','2024-04-03','Approved','12.jpg'),(13,46449,1,550.00,'2024-04-04 14:57:59','2024-04-04','Approved','13.jpg'),(14,46449,1,500.00,'2024-04-04 15:10:51','2024-04-04','Approved','14.jpg'),(15,3,1,1.00,'2024-04-06 17:02:30','2024-04-06','Approved','15.png'),(16,3,1,1.00,'2024-04-06 17:02:32','2024-04-06','Declined','16.png'),(17,46436,1,1.00,'2024-04-06 17:14:37','2024-04-06','Declined','17.jpg'),(18,46463,1,1.00,'2024-04-06 17:19:08','2024-04-06','Approved','18.jpg'),(19,46440,1,1.00,'2024-04-06 17:20:55','2024-04-06','Approved','19.png'),(20,2,1,1.00,'2024-04-06 20:27:19','2024-04-06','Approved','20.jpg'),(21,1958,1,1000.00,'2024-04-08 11:17:56','2024-04-08','Approved','21.png'),(22,46465,1,259.00,'2024-04-09 12:57:39','2024-04-09','Approved','22.jpg'),(23,46463,1,208.00,'2024-04-11 11:15:58','2024-04-11','Approved','23.jpg'),(24,46464,1,160.00,'2024-04-11 19:53:18','2024-04-11','Approved','24.jpg'),(25,13492,1,500.00,'2024-04-11 22:11:33','2024-04-11','Approved','25.jpg'),(26,46468,1,10.00,'2024-04-12 08:50:41','2024-04-12','Approved','26.jpg'),(27,46438,1,10.00,'2024-04-14 10:30:09','2024-04-14','Approved','27.jpg'),(28,46464,1,15.00,'2024-04-14 18:47:20','2024-04-14','Approved','28.jpg');
/*!40000 ALTER TABLE `request_payment` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-04 22:02:25
