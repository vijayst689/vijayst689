-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: pkrm
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `aadhaarcard`
--

DROP TABLE IF EXISTS `aadhaarcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aadhaarcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `name_english` varchar(30) DEFAULT NULL,
  `name_tamil` varchar(30) DEFAULT NULL,
  `address_tamil` varchar(200) DEFAULT NULL,
  `address_english` varchar(200) DEFAULT NULL,
  `address_proof` varchar(200) DEFAULT NULL,
  `enrollment_slip` varchar(20) DEFAULT NULL,
  `correction_proof` varchar(20) DEFAULT NULL,
  `enrollment_no` varchar(20) DEFAULT NULL,
  `enrollment_type` varchar(30) DEFAULT NULL,
  `proof` varchar(20) DEFAULT NULL,
  `pan_card_no` varchar(15) DEFAULT NULL,
  `aadhaar_entrolment_slip` varchar(20) DEFAULT NULL,
  `smart_link_no` varchar(15) DEFAULT NULL,
  `door_no` text DEFAULT NULL,
  `street_name` text DEFAULT NULL,
  `postal_area_english` text DEFAULT NULL,
  `pin_code` text DEFAULT NULL,
  `street_name_tamil` text DEFAULT NULL,
  `postal_area_tamil` text DEFAULT NULL,
  `documents` varchar(30) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(20) DEFAULT NULL,
  `lects` varchar(20) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aadhaarcard`
--

LOCK TABLES `aadhaarcard` WRITE;
/*!40000 ALTER TABLE `aadhaarcard` DISABLE KEYS */;
INSERT INTO `aadhaarcard` VALUES (1,56,1,9,0,0,60.00,'aaaaa','9943843241',9,NULL,0,'68971c7ac7e40.jpg',NULL,NULL,NULL,'68971c7ac9c5a.jpg','68971c7aca80c.jpg',NULL,NULL,NULL,'fffffffffffffffff','ffffffffffffffffffffffff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1221','aaaa','fffffffffffffff','629701','ffffffffffffffffff','ffffffff',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending','அஞ்சல் பெயர்','2025-08-09',NULL,'2025-08-09'),(2,56,1,5,0,0,60.00,'Dummy','8686767676',16,NULL,0,'689ad6462db4d.jpg',NULL,NULL,NULL,'689ad6464e4d4.jpg','689ad6464f16c.jpg',NULL,NULL,NULL,'xsdfdxfg','tbhuybytjniuknmjik',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'58912','gthgy','erftrse','123456','tyhujutsws','ujutstr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'2025-08-12',NULL,'2025-08-12'),(3,56,1,5,0,0,60.00,'Dummy','8686767676',16,NULL,0,'689ad754aeee5.jpg',NULL,NULL,NULL,'689ad754b1271.jpg','689ad754b2161.jpg',NULL,NULL,NULL,'xsdfdxfg','tbhuybytjniuknmjik',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'58912','gthgy','erftrse','123456','tyhujutsws','ujutstr',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'2025-08-12',NULL,'2025-08-12');
/*!40000 ALTER TABLE `aadhaarcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agentregister`
--

DROP TABLE IF EXISTS `agentregister`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agentregister` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `taluk` varchar(50) DEFAULT NULL,
  `post_office` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `village` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `userid` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agentregister`
--

LOCK TABLES `agentregister` WRITE;
/*!40000 ALTER TABLE `agentregister` DISABLE KEYS */;
/*!40000 ALTER TABLE `agentregister` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agri_details`
--

DROP TABLE IF EXISTS `agri_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agri_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `patta_no` varchar(100) DEFAULT NULL,
  `field_no` varchar(100) DEFAULT NULL,
  `subdivision_no` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `pattatype` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agri_details`
--

LOCK TABLES `agri_details` WRITE;
/*!40000 ALTER TABLE `agri_details` DISABLE KEYS */;
INSERT INTO `agri_details` VALUES (1,5,'மாவட்டம்','தாலுகா','வருவாய் கிராமம்','எண்','எண்','எண்','பரப்பளவு(Area/Hectares)','Joint Strap'),(2,5,'jfu','rvrr','கிராமம்','பட்டா','புல','உட்பிரிவு','தேவையான','Strap');
/*!40000 ALTER TABLE `agri_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `agri_stack`
--

DROP TABLE IF EXISTS `agri_stack`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `agri_stack` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `aadhaar_no` varchar(15) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `agri_stack`
--

LOCK TABLES `agri_stack` WRITE;
/*!40000 ALTER TABLE `agri_stack` DISABLE KEYS */;
/*!40000 ALTER TABLE `agri_stack` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `applied_service`
--

DROP TABLE IF EXISTS `applied_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applied_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `service_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applied_service`
--

LOCK TABLES `applied_service` WRITE;
/*!40000 ALTER TABLE `applied_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `applied_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `appointment_reg`
--

DROP TABLE IF EXISTS `appointment_reg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `appointment_reg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `is_completed` int(11) DEFAULT 0,
  `username` varchar(100) DEFAULT NULL,
  `usertype` varchar(100) DEFAULT NULL,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `village` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `station_name` varchar(100) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `appointment_reg`
--

LOCK TABLES `appointment_reg` WRITE;
/*!40000 ALTER TABLE `appointment_reg` DISABLE KEYS */;
/*!40000 ALTER TABLE `appointment_reg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `birth_certificate`
--

DROP TABLE IF EXISTS `birth_certificate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `birth_certificate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `childname` varchar(30) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `date_of_death` varchar(10) DEFAULT NULL,
  `place_of_death` varchar(100) DEFAULT NULL,
  `place_of_birth` varchar(100) DEFAULT NULL,
  `hospital_name` varchar(50) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `birth_certificate`
--

LOCK TABLES `birth_certificate` WRITE;
/*!40000 ALTER TABLE `birth_certificate` DISABLE KEYS */;
/*!40000 ALTER TABLE `birth_certificate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bond`
--

DROP TABLE IF EXISTS `bond`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bond` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `applicant_name` varchar(50) DEFAULT NULL,
  `document_number` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(20) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bond`
--

LOCK TABLES `bond` WRITE;
/*!40000 ALTER TABLE `bond` DISABLE KEYS */;
/*!40000 ALTER TABLE `bond` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bulk_service_orders`
--

DROP TABLE IF EXISTS `bulk_service_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bulk_service_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `added_datetime` date NOT NULL,
  `login_id` int(11) NOT NULL,
  `user_type_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `superadmin_amount` decimal(10,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `login_id` (`login_id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bulk_service_orders`
--

LOCK TABLES `bulk_service_orders` WRITE;
/*!40000 ALTER TABLE `bulk_service_orders` DISABLE KEYS */;
INSERT INTO `bulk_service_orders` VALUES (1,1,1,100.00,'2025-11-10',3,3,2,'Delivered',0.00,'2025-11-10 07:17:30','2025-11-10 07:19:49'),(2,1,1,100.00,'2025-11-10',3,3,2,'Delivered',0.00,'2025-11-10 07:18:55','2025-11-10 07:19:49'),(3,2,1,100.00,'2025-11-10',3,3,2,'Delivered',0.00,'2025-11-10 07:24:58','2025-11-10 07:25:35');
/*!40000 ALTER TABLE `bulk_service_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bulk_service_usage`
--

DROP TABLE IF EXISTS `bulk_service_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bulk_service_usage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  `used` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `service_id` (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bulk_service_usage`
--

LOCK TABLES `bulk_service_usage` WRITE;
/*!40000 ALTER TABLE `bulk_service_usage` DISABLE KEYS */;
INSERT INTO `bulk_service_usage` VALUES (1,3,1,2,0,'2025-11-10 07:17:30','2025-11-10 07:18:55'),(2,3,2,1,0,'2025-11-10 07:24:58','2025-11-10 07:24:58');
/*!40000 ALTER TABLE `bulk_service_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `callback`
--

DROP TABLE IF EXISTS `callback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `callback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operator` varchar(200) DEFAULT NULL,
  `callback_date` varchar(10) DEFAULT NULL,
  `callback_time` varchar(10) DEFAULT NULL,
  `usertx` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `callback`
--

LOCK TABLES `callback` WRITE;
/*!40000 ALTER TABLE `callback` DISABLE KEYS */;
/*!40000 ALTER TABLE `callback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `can_edit`
--

DROP TABLE IF EXISTS `can_edit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `can_edit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `can_number` varchar(30) DEFAULT NULL,
  `name_tamil` varchar(50) DEFAULT NULL,
  `name_english` varchar(50) DEFAULT NULL,
  `personalized_name_english` varchar(50) DEFAULT NULL,
  `personalized` varchar(50) DEFAULT NULL,
  `personalized_name_tamil` varchar(50) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `relationship_name_tamil` varchar(50) DEFAULT NULL,
  `relationship_name_english` varchar(50) DEFAULT NULL,
  `relationship1` varchar(50) DEFAULT NULL,
  `mother_name_tamil` varchar(50) DEFAULT NULL,
  `mother_name_english` varchar(50) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `religion` varchar(20) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `work` varchar(50) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `village_administrative_area` varchar(20) DEFAULT NULL,
  `community` varchar(20) DEFAULT NULL,
  `caste` varchar(20) DEFAULT NULL,
  `maritial_status` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_number` varchar(15) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `smartcard_number` varchar(15) DEFAULT NULL,
  `street_name_tamil` varchar(50) DEFAULT NULL,
  `postal_name` varchar(50) DEFAULT NULL,
  `street_name` varchar(50) DEFAULT NULL,
  `pin_code` varchar(15) DEFAULT NULL,
  `original_dob` varchar(10) DEFAULT NULL,
  `new_mobile_no` varchar(10) DEFAULT NULL,
  `certificate_name` varchar(100) DEFAULT NULL,
  `address_tamil` varchar(200) DEFAULT NULL,
  `address_english` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `applicant_name` varchar(100) DEFAULT NULL,
  `certificate_number` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `document` varchar(20) DEFAULT NULL,
  `save_application_number` varchar(20) DEFAULT NULL,
  `save_certificate` varchar(20) DEFAULT NULL,
  `api_response` varchar(20) DEFAULT NULL,
  `application_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `can_edit`
--

LOCK TABLES `can_edit` WRITE;
/*!40000 ALTER TABLE `can_edit` DISABLE KEYS */;
INSERT INTO `can_edit` VALUES (1,60,10,5,0,0,60.00,12,97,4880,NULL,NULL,NULL,'qqqqqq','திருமதி','sddddd','தந்தை','Saravanan p','Saravanan p',NULL,NULL,NULL,'2024-11-13','9943843246','Addddddd','qqqq','qqqqqqq','33','629601','BC','test','Single','672cbdb97b568.jpg','111111111111','672cbdb94bc2d.jpg','qqq111111111','Elanthavilai Pallam Post','629601','Elanthavilai Pallam Post','629601',NULL,NULL,NULL,NULL,NULL,NULL,'Resubmit','test',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-07',NULL,'2024-11-07',NULL,NULL,NULL,NULL,NULL),(2,64,1,5,0,0,NULL,0,0,0,'10101010101012',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1010101012',NULL,NULL,NULL,NULL,'Rejected','resubmit',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-05-27',NULL,'2025-05-27',NULL,NULL,NULL,NULL,NULL),(3,227,1,5,0,0,60.00,0,0,0,'133060730773444',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'68414ee20c6b4.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'vvv',NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-05',NULL,'2025-06-05',NULL,NULL,NULL,NULL,'vvvv'),(4,227,1,5,0,0,NULL,0,0,0,'133060730773982',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6841508b92a08.png',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'utfyhfgfgfh',NULL,NULL,NULL,'Rejected','vvv',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-06-05',NULL,'2025-06-05',NULL,NULL,NULL,NULL,'vvvvvvv');
/*!40000 ALTER TABLE `can_edit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinator_permission`
--

DROP TABLE IF EXISTS `coordinator_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coordinator_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinator_permission`
--

LOCK TABLES `coordinator_permission` WRITE;
/*!40000 ALTER TABLE `coordinator_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordinator_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coursepayment`
--

DROP TABLE IF EXISTS `coursepayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `coursepayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `admin_amount` decimal(10,2) DEFAULT 0.00,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coursepayment`
--

LOCK TABLES `coursepayment` WRITE;
/*!40000 ALTER TABLE `coursepayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `coursepayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `covid`
--

DROP TABLE IF EXISTS `covid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `covid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `passport_no` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `covid`
--

LOCK TABLES `covid` WRITE;
/*!40000 ALTER TABLE `covid` DISABLE KEYS */;
/*!40000 ALTER TABLE `covid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cus_document`
--

DROP TABLE IF EXISTS `cus_document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cus_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(10) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `cus_docx` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cus_document`
--

LOCK TABLES `cus_document` WRITE;
/*!40000 ALTER TABLE `cus_document` DISABLE KEYS */;
INSERT INTO `cus_document` VALUES (1,'2','aadhar','1.jpg');
/*!40000 ALTER TABLE `cus_document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `username_type` varchar(50) DEFAULT NULL,
  `user_type_id` varchar(10) DEFAULT NULL,
  `nalavariyam_usertype` int(11) DEFAULT NULL,
  `refferal_id` varchar(10) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `aadhaar_file` varchar(10) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `pan_file` varchar(10) DEFAULT NULL,
  `smartcard` varchar(20) DEFAULT NULL,
  `smartcard_no` varchar(15) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `dist_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `nalavariyam_dist_id` int(11) DEFAULT NULL,
  `nalavariyam_taluk_id` int(11) DEFAULT NULL,
  `panchayath_name` varchar(50) DEFAULT NULL,
  `can_details` varchar(20) DEFAULT NULL,
  `can_number` varchar(20) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `cpassword` varchar(20) DEFAULT NULL,
  `profile` varchar(10) DEFAULT NULL,
  `qr_image` varchar(30) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT 0.00,
  `rawallet` decimal(10,2) DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_completed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dharsan`
--

DROP TABLE IF EXISTS `dharsan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dharsan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `darshan_date` varchar(10) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dharsan`
--

LOCK TABLES `dharsan` WRITE;
/*!40000 ALTER TABLE `dharsan` DISABLE KEYS */;
/*!40000 ALTER TABLE `dharsan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) DEFAULT NULL,
  `short_name` varchar(20) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `district`
--

LOCK TABLES `district` WRITE;
/*!40000 ALTER TABLE `district` DISABLE KEYS */;
INSERT INTO `district` VALUES (1,'Chennai',NULL,'Active'),(2,'Coimbatore',NULL,'Active'),(3,'Cuddalore',NULL,'Active'),(4,'Dharmapuri',NULL,'Active'),(5,'Dindigul',NULL,'Active'),(6,'Erode',NULL,'Active'),(7,'Kancheepuram',NULL,'Active'),(8,'Kanniyakumari',NULL,'Active'),(9,'Karur',NULL,'Active'),(10,'Madurai',NULL,'Active'),(11,'Nagapattinam',NULL,'Active'),(12,'Namakkal',NULL,'Active'),(13,'The Nilgiris',NULL,'Active'),(14,'Perambalur',NULL,'Active'),(15,'Pudukottai',NULL,'Active'),(16,'Ramanathapuram',NULL,'Active'),(17,'Salem',NULL,'Active'),(18,'Sivagangai',NULL,'Active'),(19,'Thanjavur',NULL,'Active'),(20,'Theni',NULL,'Active'),(21,'Thiruvallur',NULL,'Active'),(22,'Thiruvannamalai',NULL,'Active'),(23,'Thiruvarur',NULL,'Active'),(24,'Thoothukudi',NULL,'Active'),(25,'Tiruchirappalli',NULL,'Active'),(26,'Tirunelveli',NULL,'Active'),(27,'Vellore',NULL,'Active'),(28,'Villupuram',NULL,'Active'),(29,'Virudhunagar',NULL,'Active'),(30,'Ariyalur',NULL,'Active'),(31,'Krishnagiri',NULL,'Active'),(32,'Tiruppur',NULL,'Active'),(33,'Chengalpattu',NULL,'Active'),(34,'Kallakurichi',NULL,'Active'),(35,'Ranipet',NULL,'Active'),(36,'Tenkasi',NULL,'Active'),(37,'Tirupathur',NULL,'Active'),(38,'Mayiladuthurai',NULL,'Active');
/*!40000 ALTER TABLE `district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dl`
--

DROP TABLE IF EXISTS `dl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT NULL,
  `dlnumber` varchar(20) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dl`
--

LOCK TABLES `dl` WRITE;
/*!40000 ALTER TABLE `dl` DISABLE KEYS */;
/*!40000 ALTER TABLE `dl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `doc_name` varchar(50) DEFAULT NULL,
  `doc` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (1,5,'Deed','689304da4c0b7.jpg');
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `requirement` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enquiry`
--

LOCK TABLES `enquiry` WRITE;
/*!40000 ALTER TABLE `enquiry` DISABLE KEYS */;
/*!40000 ALTER TABLE `enquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `family_member`
--

DROP TABLE IF EXISTS `family_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `family_member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `relation` varchar(30) DEFAULT NULL,
  `relation_name` varchar(80) DEFAULT NULL,
  `relation_name_tamil` text DEFAULT NULL,
  `occupation` text DEFAULT NULL,
  `relation_age` varchar(10) DEFAULT NULL,
  `relation_status` varchar(20) DEFAULT NULL,
  `income` int(11) DEFAULT 0,
  `profession` varchar(20) DEFAULT NULL,
  `relationaadhaar_card` varchar(20) DEFAULT NULL,
  `relationdeath_cert` varchar(20) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `doc` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `family_member`
--

LOCK TABLES `family_member` WRITE;
/*!40000 ALTER TABLE `family_member` DISABLE KEYS */;
/*!40000 ALTER TABLE `family_member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `find_payment`
--

DROP TABLE IF EXISTS `find_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `find_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `ramjiservice_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `find_payment`
--

LOCK TABLES `find_payment` WRITE;
/*!40000 ALTER TABLE `find_payment` DISABLE KEYS */;
INSERT INTO `find_payment` VALUES (1,1,1,1,NULL,NULL,NULL),(2,1,2,2,NULL,NULL,NULL),(3,1,3,0,NULL,NULL,NULL),(4,1,4,0,NULL,NULL,NULL),(5,1,5,0,NULL,NULL,NULL),(6,1,6,0,NULL,NULL,NULL),(7,1,7,0,NULL,NULL,NULL);
/*!40000 ALTER TABLE `find_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `find_services`
--

DROP TABLE IF EXISTS `find_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `find_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ramjiservice_id` int(11) DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `find_services`
--

LOCK TABLES `find_services` WRITE;
/*!40000 ALTER TABLE `find_services` DISABLE KEYS */;
INSERT INTO `find_services` VALUES (1,1,'Adhaar to Pan Number',100.00,'1.jpg','Active','2024-12-19 09:38:31'),(2,2,'Pan To Pan Details',200.00,'2.jpg','Active','2024-12-19 09:45:15'),(3,0,'Driving License PDF',7.00,'3.jpg','Active','2024-12-19 09:48:00'),(4,0,'RC Pdf',10.00,'4.jpg','Active','2024-12-19 09:49:12'),(5,0,'Smart Card Pdf',7.00,'5.jpg','Active','2024-12-19 09:51:21'),(6,0,'Cell Number Link In Voter ID',25.00,'6.jpg','Active','2024-12-20 19:12:02'),(7,0,'Voter ID Pdf',25.00,'7.jpg','Active','2024-12-20 19:14:05');
/*!40000 ALTER TABLE `find_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fssai`
--

DROP TABLE IF EXISTS `fssai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fssai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `shop_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `old_food_license` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `food_service` varchar(20) DEFAULT NULL,
  `shop_photo` varchar(20) DEFAULT NULL,
  `mobile_no` varchar(20) DEFAULT NULL,
  `documents` varchar(20) DEFAULT NULL,
  `rental_agreement` varchar(20) DEFAULT NULL,
  `electricity_bill` varchar(20) DEFAULT NULL,
  `property_tax` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fssai`
--

LOCK TABLES `fssai` WRITE;
/*!40000 ALTER TABLE `fssai` DISABLE KEYS */;
/*!40000 ALTER TABLE `fssai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gst`
--

DROP TABLE IF EXISTS `gst`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gst` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `pan_no` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `trade_name` varchar(50) DEFAULT NULL,
  `business_details` varchar(50) DEFAULT NULL,
  `business_details_documents` varchar(50) DEFAULT NULL,
  `rental_agreement` varchar(20) DEFAULT NULL,
  `ebbill` varchar(20) DEFAULT NULL,
  `property_tax` varchar(20) DEFAULT NULL,
  `bank_pass_book_front_page` varchar(20) DEFAULT NULL,
  `business_address` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gst`
--

LOCK TABLES `gst` WRITE;
/*!40000 ALTER TABLE `gst` DISABLE KEYS */;
/*!40000 ALTER TABLE `gst` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `itr`
--

DROP TABLE IF EXISTS `itr`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `itr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `bank_passbook` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `itr`
--

LOCK TABLES `itr` WRITE;
/*!40000 ALTER TABLE `itr` DISABLE KEYS */;
INSERT INTO `itr` VALUES (1,51,6,0,0,0,60.00,'Saravanan p','9943843246','anish@gmail.com','0000000',0,0,0,'674970496c90a.jpg','674970496621f.jpg',NULL,'674970496ea04.jpg',NULL,NULL,'Resubmit','good',NULL,NULL,NULL,NULL,NULL,'2024-11-29',NULL,'2024-11-29');
/*!40000 ALTER TABLE `itr` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `license` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `driving_license_no` varchar(15) DEFAULT NULL,
  `rc_number` varchar(15) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `driving_license` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `license`
--

LOCK TABLES `license` WRITE;
/*!40000 ALTER TABLE `license` DISABLE KEYS */;
/*!40000 ALTER TABLE `license` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `medicalscheme`
--

DROP TABLE IF EXISTS `medicalscheme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `medicalscheme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `family_head_name` varchar(30) DEFAULT NULL,
  `smartcard_onlineprint` varchar(20) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `allfamily_mem_aadhaarcard` varchar(20) DEFAULT NULL,
  `family_head_photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `member` varchar(20) DEFAULT NULL,
  `aadhaar` varchar(20) DEFAULT NULL,
  `aadhaar2` varchar(20) DEFAULT NULL,
  `aadhaar3` varchar(20) DEFAULT NULL,
  `aadhaar4` varchar(20) DEFAULT NULL,
  `aadhaar5` varchar(20) DEFAULT NULL,
  `aadhaar6` varchar(20) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `passportsize_photo` varchar(20) DEFAULT NULL,
  `pin_code` varchar(10) DEFAULT NULL,
  `husband_name` text DEFAULT NULL,
  `father_name` text DEFAULT NULL,
  `marital_status` varchar(50) DEFAULT NULL,
  `aadhaar_no` varchar(20) DEFAULT NULL,
  `smartcard_no` varchar(20) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `relation` varchar(50) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `vao_or_income_certificate` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `medicalscheme`
--

LOCK TABLES `medicalscheme` WRITE;
/*!40000 ALTER TABLE `medicalscheme` DISABLE KEYS */;
/*!40000 ALTER TABLE `medicalscheme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `msme`
--

DROP TABLE IF EXISTS `msme`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `cmp_name` varchar(100) DEFAULT NULL,
  `community` varchar(50) DEFAULT NULL,
  `building_name` varchar(100) DEFAULT NULL,
  `ward_no` varchar(50) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `account_no` varchar(50) DEFAULT NULL,
  `confirm_account_no` varchar(50) DEFAULT NULL,
  `ifsc_code` varchar(100) DEFAULT NULL,
  `micr_no` varchar(100) DEFAULT NULL,
  `male_count` varchar(100) DEFAULT NULL,
  `female_count` varchar(100) DEFAULT NULL,
  `amount_in_lakhs` varchar(100) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `gst_number` varchar(20) DEFAULT NULL,
  `itr` varchar(100) DEFAULT NULL,
  `itr_form` varchar(100) DEFAULT NULL,
  `organization` varchar(100) DEFAULT NULL,
  `category_of_work` varchar(100) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `msme`
--

LOCK TABLES `msme` WRITE;
/*!40000 ALTER TABLE `msme` DISABLE KEYS */;
/*!40000 ALTER TABLE `msme` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam`
--

DROP TABLE IF EXISTS `nalavariyam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `mobile` varchar(10) DEFAULT NULL,
  `register_no` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam`
--

LOCK TABLES `nalavariyam` WRITE;
/*!40000 ALTER TABLE `nalavariyam` DISABLE KEYS */;
INSERT INTO `nalavariyam` VALUES (1,95,11,0,3,0,20.00,'9887877777','1211','333333333333',NULL,'','',NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,'2024-11-08',NULL,'2024-11-08'),(2,95,10,5,0,0,20.00,'9927738839','123111111111','332222222222',NULL,'','','672de9ee35325.jpg','Processing','good','1',NULL,NULL,NULL,NULL,'2024-11-08',NULL,'2024-11-08'),(3,96,6,0,0,0,30.00,NULL,'22222222','868630079735',NULL,'','',NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-11',NULL,'2025-02-11');
/*!40000 ALTER TABLE `nalavariyam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_customer`
--

DROP TABLE IF EXISTS `nalavariyam_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district` varchar(100) DEFAULT NULL,
  `taluk` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `refferal` int(11) DEFAULT NULL,
  `customer_user_type_id` int(11) DEFAULT 0,
  `date` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_customer`
--

LOCK TABLES `nalavariyam_customer` WRITE;
/*!40000 ALTER TABLE `nalavariyam_customer` DISABLE KEYS */;
INSERT INTO `nalavariyam_customer` VALUES (1,'2','5','New Card','8015826802','Active','1245896321',3,1,'2025-11-06'),(2,'2','5','New Card','8015826806','Active','1245876321',2,1,'2025-11-10');
/*!40000 ALTER TABLE `nalavariyam_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_district`
--

DROP TABLE IF EXISTS `nalavariyam_district`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `district_name` varchar(100) DEFAULT NULL,
  `districtid` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_district`
--

LOCK TABLES `nalavariyam_district` WRITE;
/*!40000 ALTER TABLE `nalavariyam_district` DISABLE KEYS */;
INSERT INTO `nalavariyam_district` VALUES (1,'????????','01',20,'Active'),(2,'????????????','02',29,'Active'),(3,'??????','03',24,'Active'),(4,'????????????? ','04',12,'Active'),(5,'??????','05',83,'Active'),(6,'????????','06',108,'Active'),(7,'???????????','07',80,'Active'),(8,'?????','08',45,'Active'),(9,'??????????????','09',25,'Active'),(10,'???????????','10',32,'Active'),(11,'???????????','11',4,'Active'),(12,'?????','12',39,'Active'),(13,'???????????','13',27,'Active'),(14,'?????','14',62,'Active'),(15,'???????????','15',1,'Active'),(16,'?????????????','16',41,'Active'),(17,'????????','17',110,'Active'),(18,'??????????','18',78,'Active'),(19,'????????????','19',82,'Active'),(20,'???????????','20',35,'Active'),(21,'????????????','21',33,'Active'),(22,'?????','22',1521,'Active'),(23,'????????','23',36,'Active'),(24,'????????','24',42,'Active'),(25,'?????????','25',44,'Active'),(26,'???????','26',85,'Active'),(27,'????','27',5,'Active'),(28,'?????????????????','28',77,'Active'),(29,'??????????','29',79,'Active'),(30,'????????????','30',31,'Active'),(31,'????????????','31',70,'Active'),(32,'?????????????','32',2191,'Active'),(33,'??????????','33',26,'Active'),(34,'???????????','34',43,'Active'),(35,'????????????','35',34,'Active'),(36,'??????','36',65,'Active'),(37,'???????????','38',81,'Active'),(38,'??????????','38',109,'Active'),(39,'????????','',NULL,'Active'),(40,'?????????????','',NULL,'Active'),(42,'????????????',NULL,NULL,'Active');
/*!40000 ALTER TABLE `nalavariyam_district` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_form`
--

DROP TABLE IF EXISTS `nalavariyam_form`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) DEFAULT 0,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `user_type_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `service_id` int(11) DEFAULT 0,
  `customer_user_type_id` int(11) DEFAULT 0,
  `service_status` varchar(100) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `from_image` varchar(300) DEFAULT NULL,
  `log_id` int(11) DEFAULT 0,
  `online_status` varchar(200) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `online_reason` text DEFAULT NULL,
  `bill` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_form`
--

LOCK TABLES `nalavariyam_form` WRITE;
/*!40000 ALTER TABLE `nalavariyam_form` DISABLE KEYS */;
/*!40000 ALTER TABLE `nalavariyam_form` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_payment`
--

DROP TABLE IF EXISTS `nalavariyam_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  `admin_amount` decimal(10,2) DEFAULT 0.00,
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_payment`
--

LOCK TABLES `nalavariyam_payment` WRITE;
/*!40000 ALTER TABLE `nalavariyam_payment` DISABLE KEYS */;
INSERT INTO `nalavariyam_payment` VALUES (1,22,1,100.00,150.00,0.00,50.00,NULL),(2,22,2,100.00,150.00,0.00,50.00,NULL),(3,22,3,100.00,150.00,0.00,50.00,NULL),(4,22,4,100.00,150.00,0.00,50.00,NULL),(5,22,5,100.00,150.00,0.00,50.00,NULL),(6,22,6,100.00,150.00,0.00,50.00,NULL),(7,22,7,100.00,150.00,0.00,50.00,NULL),(8,22,8,100.00,150.00,0.00,50.00,NULL),(9,22,11,100.00,150.00,0.00,50.00,NULL),(10,22,12,100.00,150.00,0.00,50.00,NULL),(11,22,13,100.00,150.00,0.00,50.00,NULL),(12,22,14,100.00,150.00,0.00,50.00,NULL),(13,22,16,100.00,150.00,0.00,50.00,NULL),(14,22,21,100.00,150.00,0.00,50.00,NULL),(15,22,22,100.00,150.00,0.00,50.00,NULL);
/*!40000 ALTER TABLE `nalavariyam_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_remarks`
--

DROP TABLE IF EXISTS `nalavariyam_remarks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_remarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `remarks` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_remarks`
--

LOCK TABLES `nalavariyam_remarks` WRITE;
/*!40000 ALTER TABLE `nalavariyam_remarks` DISABLE KEYS */;
INSERT INTO `nalavariyam_remarks` VALUES (1,'Crop and Resize (800*1100)','Active'),(2,'Fill All Columns','Active'),(3,'Use Blue Ink','Active'),(4,'Fill Academic Year(Example : 2025-2026)','Active'),(5,'Fill studying year (Example: 1st Year, 2nd Year ,3rd Year,4th Year)','Active'),(6,'Signature (Dont Cut & Paste)','Active'),(7,'Fill Date Of Birth ( Expect Adhaar)','Active'),(8,'Degree Name (Example BA, MBA,MA,BE, Diploma, ITI,....)','Active'),(9,'Fill Registration Number & Date','Active'),(10,'Fill Working Years','Active'),(11,'Fill Work Name As Per Labour Department work list Chart','Active');
/*!40000 ALTER TABLE `nalavariyam_remarks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_request`
--

DROP TABLE IF EXISTS `nalavariyam_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `req_date` date NOT NULL,
  `req_time` time NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_request`
--

LOCK TABLES `nalavariyam_request` WRITE;
/*!40000 ALTER TABLE `nalavariyam_request` DISABLE KEYS */;
INSERT INTO `nalavariyam_request` VALUES (1,2,1,100.00,'Approved','2026-01-20','14:38:00','1768919880.jpeg');
/*!40000 ALTER TABLE `nalavariyam_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_service`
--

DROP TABLE IF EXISTS `nalavariyam_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(100) DEFAULT NULL,
  `service_payment` varchar(10) DEFAULT NULL,
  `additional_url` varchar(50) DEFAULT NULL,
  `next_url` int(11) DEFAULT NULL,
  `nexts` varchar(100) DEFAULT NULL,
  `from_image` varchar(500) DEFAULT NULL,
  `from_pdf` varchar(200) DEFAULT NULL,
  `download` varchar(5000) DEFAULT NULL,
  `upload` varchar(5000) DEFAULT NULL,
  `submitting_url` varchar(1000) DEFAULT NULL,
  `marge_right` varchar(10) DEFAULT NULL,
  `marge_bottom` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `servicetype` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_service`
--

LOCK TABLES `nalavariyam_service` WRITE;
/*!40000 ALTER TABLE `nalavariyam_service` DISABLE KEYS */;
INSERT INTO `nalavariyam_service` VALUES (1,'புதிய பதிவு','120','edit',1,'2','1.pdf',NULL,NULL,'1.Upload the filled application form</br>\r\n2.Click \"SUBMIT\"</br>\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION</br>\r\n4.Click the link to apply \"LABOUR IDENTITY CARD\".</br>(நலவாரியம்  அடையாள அட்டை)','https://tnuwwb.tn.gov.in/applications/register','100','120','Active',NULL,NULL,1),(2,'கல்வி உதவித்தொகை 6, 7, 8 & 9 பயிலும் குழந்தைகள்','90','scholarship1',1,'2','fom_12183916191222.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to Renewal your labour Identity Card.','https://tnuwwb.tn.gov.in/renewalhistories/login','100','90','Active','2025-06-01','2026-04-30',2),(3,'கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்','120','scholarship2',1,'2','fom_44423916191222.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply  Educational Scholarship','https://tnuwwb.tn.gov.in/users/login','100','90','Active','2025-06-01','2026-04-30',2),(4,'கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி','120','scholarship3',1,'2','fom_14583916191222.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply Marriage Welfare Benifits.','https://tnuwwb.tn.gov.in/users/login','100','90','Active','2025-06-01','2026-05-30',1),(5,'உயர்க்கல்வி (பட்டம் மற்றும் பட்ட மேற்படிப்பு)','120','scholarship4',1,'2','fom_61284016191222.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply Marriage Welfare Benifits.','https://tnuwwb.tn.gov.in/users/login','100','90','Active','2025-06-01','2026-05-30',1),(6,'புதுப்பித்தல் \\ சங்கத்தில் இணைத்தல்','120','renewal',1,'2','6.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply MarernityWelfare Benifits.','https://tnuwwb.tn.gov.in/users/login','450','100','Active',NULL,NULL,1),(7,'திருமணம் உதவி தொகை (கட்டுமானம்)','120','naturaldeath',1,'2','fom_51143615170323.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply NATURAL DEADTH  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/SkcxTnQ5TDd2dk9yMEN0YUxReVhZdz09','100','90','Active',NULL,NULL,1),(8,'திருமணம் உதவி தொகை (உடலுழைப்பு வாரியம்)','120','naturaldeath2',1,'2','fom_50265015170323.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply NATURAL DEADTH  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/ZFlYRHg3RDFpcmxZZTQrZjZtamdLZz09','100','90','Active',NULL,NULL,1),(11,'திருமணம் உதவி தொகை (ஓட்டுநர் வாரியம்)','120',NULL,1,'2','fom_53035215170323.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply ACCIDENTIAL DEADTH  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/R3JNY0JNeWF4bWVOSi8yU1JHZXlxZz09','100','90','Active',NULL,NULL,1),(12,'மகபேறு உதவித்தொகை','120',NULL,1,'2','fom_4038595200323.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply ACCIDENTIAL DEADTH  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/MVF6ME4rUVF2aFJYQm5yTG1TdmZ1UT09','100','90','Active',NULL,NULL,1),(13,'மாத ஓய்வூதியம்','120',NULL,1,'2','fom_47280116170323.pdf',NULL,'1.Dowload The Application Form\r\n2.Fill The Application form correctly (Use only blue ink)\r\n3.Payment.','1.Upload the filled application form\r\n2.Click \"SUBMIT\"\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION\r\n4.Click the link to apply ACCIDENTIAL DEADTH  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/SmNDeldrTTc1VkE5bGM4ZEhRQUlYUT09','450','100','Active',NULL,NULL,1),(14,'இயற்கை மரண நிதி உதவித்தொகை','120',NULL,1,'2','14.pdf',NULL,'1.Dowload The Application Form</br>\r\n2.Fill The Application form correctly (Use only blue ink)</br>\r\n3.Payment.','1.Upload the filled application form</br>\r\n2.Click \"SUBMIT\"</br>\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION</br>\r\n4.Click the link to apply Monthly Pension  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/K1pLNHNRYzUybnM5NXNNdzNmdnUzUT09','100','100','Active',NULL,NULL,1),(16,'கண்கண்ணாடி உதவி தொகை','50',NULL,1,'2','fom_79354416191222.pdf',NULL,'1.Dowload The Application Form</br>\r\n2.Fill The Application form correctly (Use only blue ink)</br>\r\n3.Payment.','1.Upload the filled application form</br>\r\n2.Click \"SUBMIT\"</br>\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION</br>\r\n4.Click the link to apply Monthly Pension  Welfare BENEFITS.','https://tnuwwb.tn.gov.in/claims/claimlogin/M2lQYmxXdi84b0lQaENhQmR3aHc3dz09','100','90','Active',NULL,NULL,1),(17,'குடும்ப ஓய்வூதியம் (கட்டுமானம் மட்டும்)','120',NULL,1,'2','fom_27144817301122.pdf',NULL,'1.Dowload The Application Form</br>\r\n2.Fill The Application form correctly (Use only blue ink)</br>\r\n3.Payment.','1.Upload the filled application form</br>\r\n2.Click \"SUBMIT\"</br>\r\n3.Dowload the \"EMPLOYMENT CERTIFICATE\" from our UNION</br>\r\n4.Click the link to apply Monthly  Family Pension  Welfare Benifits.','https://tnuwwb.tn.gov.in/claims/claimlogin/RGxaUzJFYWdKSUtsTWk3VGI3ZEJWdz09','90','100','Inactive',NULL,NULL,1),(21,'விபத்து மரண நிதி உதவித்தொகை','120',NULL,NULL,NULL,'21.pdf',NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,1),(22,'புதிய பதிவு','120',NULL,NULL,NULL,'22.pdf',NULL,NULL,NULL,NULL,'100','120','Active',NULL,NULL,1);
/*!40000 ALTER TABLE `nalavariyam_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyam_taluk`
--

DROP TABLE IF EXISTS `nalavariyam_taluk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyam_taluk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taluk_name` text CHARACTER SET utf8 COLLATE utf8_croatian_ci NOT NULL,
  `parent` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyam_taluk`
--

LOCK TABLES `nalavariyam_taluk` WRITE;
/*!40000 ALTER TABLE `nalavariyam_taluk` DISABLE KEYS */;
INSERT INTO `nalavariyam_taluk` VALUES (1,'?????????',1,1),(2,'????????',1,1),(3,'????????',1,1),(4,'??????????????',1,1),(5,'????????????',2,1),(6,'????????',2,1),(7,'??????????',2,1),(8,'?????????',2,1),(9,'????????',2,1),(10,'????????????????',2,1),(11,'????????????',2,1),(12,'????????',2,1),(13,'????????',3,1),(14,'??????????',3,1),(15,'??????????',3,1),(16,'????????',3,1),(17,'???????',3,1),(18,'??????',3,1),(19,'???????',39,1),(20,'?????????',3,1),(21,'????????',3,1),(22,'???????????',3,1),(23,'?????????',3,1),(24,'????????????',3,1),(25,'??????????????',3,1),(26,'??????????????',39,1),(27,'???????????????',3,1),(28,'???????',3,1),(29,'??????',4,1),(30,'???????',4,1),(31,'?????????????(??????)',4,1),(32,'?????????????(??????)',4,1),(33,'???????????',4,1),(34,'????????',4,1),(35,'?????????????',4,1),(36,'??????',4,1),(37,'??????????',4,1),(38,'??????',4,1),(39,'????????',4,1),(40,'????????',5,1),(41,'?????????',42,1),(42,'??????',5,1),(43,'???????????????????',5,1),(44,'????????????',42,1),(45,'?????????',42,1),(46,'???????????',5,1),(47,'???????????',42,1),(48,'????????',5,1),(49,'????????????',42,1),(50,'????????',6,1),(51,'?????',6,1),(52,'???????????',6,1),(53,'????????????',6,1),(54,'?????????',6,1),(55,'????????????????',6,1),(56,'??????????',6,1),(57,'???????',7,1),(58,'???????????(???????)',7,1),(59,'???????????(??????)',7,1),(60,'?????????????',7,1),(61,'???????????',7,1),(62,'??????',7,1),(63,'?????????',7,1),(64,'??????????????',7,1),(65,'????',7,1),(66,'?????????',7,1),(67,'?????????',8,1),(68,'?????',8,1),(69,'?????',8,1),(70,'?????????????????',8,1),(71,'????????',8,1),(72,'?????????????',8,1),(73,'?????????',8,1),(74,'??????????',8,1),(75,'?????????????',8,1),(76,'?????',8,1),(77,'??????????',9,1),(78,'????????? ???',9,1),(79,'????????????',9,1),(80,'??????????',9,1),(81,'??????????????',9,1),(82,'???????????????',9,1),(83,'???????????',10,1),(84,'???????????',10,1),(85,'????????????????',10,1),(86,'????????????',10,1),(87,'??????????',10,1),(88,'????????????',11,1),(89,'????????',11,1),(90,'??????????',40,1),(91,'???????????',40,1),(92,'??????',11,1),(93,'??????????',40,1),(94,'?????????????',12,1),(95,'??????',12,1),(96,'?????',12,1),(97,'???????????????',12,1),(98,'?????????',12,1),(99,'??????????',12,1),(100,'???????',12,1),(101,'?????????',13,1),(102,'???????',13,1),(103,'?????????????',13,1),(104,'?????',13,1),(105,'???????????',13,1),(106,'????????????',13,1),(107,'???????',13,1),(108,'?????????',13,1),(109,'?????????',14,1),(110,'?????(???????)',14,1),(111,'?????(??????)',14,1),(112,'?????(??????)',14,1),(113,'?????(??????)',14,1),(114,'??????',14,1),(115,'????????',14,1),(116,'?????????????????',14,1),(117,'???????????',14,1),(118,'???????????',14,1),(119,'?????????',14,1),(120,'?????????',15,1),(121,'???????????',15,1),(122,'????????',15,1),(123,'???????????',15,1),(124,'??????????',16,1),(125,'?????????????',16,1),(126,'???????????',16,1),(127,'??????????',16,1),(128,'?????????',17,1),(129,'????????????',17,1),(130,'???????',17,1),(131,'????????',17,1),(132,'?????????????',17,1),(133,'?????????',17,1),(134,'????????????',17,1),(135,'??????????????',17,1),(136,'????????',18,1),(137,'???????',18,1),(138,'??????????',18,1),(139,'????????????',18,1),(140,'????????',19,1),(141,'??????????',19,1),(142,'??????????????',19,1),(143,'?????????????',19,1),(144,'???????????',19,1),(145,'???????????',19,1),(146,'?????????',19,1),(147,'??????????',19,1),(148,'???????????',19,1),(149,'????????????',19,1),(150,'????????',19,1),(151,'?????????',19,1),(152,'??????',20,1),(153,'?????',20,1),(154,'??????',20,1),(155,'?????????????',20,1),(156,'?????????',20,1),(157,'???????????????',20,1),(158,'????????????',20,1),(159,'??????????',20,1),(160,'?????????',20,1),(161,'?????????',21,1),(162,'???????',21,1),(163,'????',21,1),(164,'??????',21,1),(165,'?????????',21,1),(166,'????????????',21,1),(167,'???????',22,1),(168,'????????',22,1),(169,'??????????',22,1),(170,'???????????',22,1),(171,'????????',22,1),(172,'??????',22,1),(173,'???????????????????',22,1),(174,'?????',22,1),(175,'????? ??????',22,1),(176,'????? ??????',22,1),(177,'????????',22,1),(178,'????????',22,1),(179,'??????',22,1),(180,'???????',22,1),(181,'???????????',23,1),(182,'???????????',23,1),(183,'?????????????',23,1),(184,'??????????',23,1),(185,'?????????',23,1),(186,'????????????',23,1),(187,'????????',23,1),(188,'????????????',23,1),(189,'?????????????',23,1),(190,'?????????',24,1),(191,'???????????',24,1),(192,'?????????????',24,1),(193,'??????????',24,1),(194,'???????',24,1),(195,'????????',24,1),(196,'????????????',24,1),(197,'????????????',24,1),(198,'???????',25,1),(199,'??????????',25,1),(200,'?????????',25,1),(201,'????????',25,1),(202,'?????????????',25,1),(203,'?????????',25,1),(204,'?????????',25,1),(205,'??????????',25,1),(206,'???????????????',25,1),(207,'????????',26,1),(208,'???????',26,1),(209,'?????????',26,1),(210,'??????',26,1),(211,'????????',26,1),(212,'??????????',26,1),(213,'????????????',27,1),(214,'???????????',27,1),(215,'??????????',27,1),(216,'????',27,1),(217,'????????????',27,1),(218,'????????',28,1),(219,'????????????',28,1),(220,'????????',28,1),(221,'???????????',28,1),(222,'??????',28,1),(223,'??????????',28,1),(224,'?????????????????-??????',28,1),(225,'?????????????',28,1),(226,'?????????',28,1),(227,'????????',28,1),(228,'?????????????????-???????',28,1),(229,'????????????',29,1),(230,'????????',29,1),(231,'???????????',29,1),(232,'????????',29,1),(233,'??????????',29,1),(234,'??????????????????',29,1),(235,'??????????',29,1),(236,'??????????',29,1),(237,'????',30,1),(238,'??????????',30,1),(239,'????????',30,1),(240,'???????????',30,1),(241,'???????????',30,1),(242,'????????????',30,1),(243,'?????????????',30,1),(244,'????????????',30,1),(245,'??????????????',30,1),(246,'?????????????',30,1),(247,'???????????????',31,1),(248,'???????????',31,1),(249,'??????',31,1),(250,'??????????',31,1),(251,'?????????????',31,1),(252,'?????????',31,1),(253,'???????????',31,1),(254,'????????????',31,1),(255,'???????',32,1),(256,'???????????',32,1),(257,'??????????? ??????',32,1),(258,'???????????',32,1),(259,'???????',33,1),(260,'?????????',33,1),(261,'?????????',33,1),(262,'??????????????',33,1),(263,'???????',33,1),(264,'?????????? ??????',33,1),(265,'?????????? ??????',33,1),(266,'??????????????',33,1),(267,'???????????',33,1),(268,'????',34,1),(269,'????????????????',39,1),(270,'????????????',34,1),(271,'????????',39,1),(272,'??????????',34,1),(273,'R.K.??????',34,1),(274,'?????????',34,1),(275,'???????????',34,1),(276,'??????????',34,1),(277,'????',35,1),(278,'???????',35,1),(279,'??????????',35,1),(280,'????????',35,1),(281,'??????????',35,1),(282,'??????????',35,1),(283,'?????????????',35,1),(284,'??????',35,1),(285,'?????????????',35,1),(286,'????????????',35,1),(287,'????????',35,1),(288,'???????????',35,1),(289,'????????',36,1),(290,'???????????',36,1),(291,'K V ???????',36,1),(292,'???????? ??????',36,1),(293,'?????????????',36,1),(294,'?????? ??????',36,1),(295,'??????',37,1),(296,'??????????????',37,1),(297,'?????????',37,1),(298,'????????????',37,1),(299,'???????????????????',37,1),(300,'??????????',37,1),(301,'??????',37,1),(302,'?????????????',37,1),(303,'???????????',37,1),(304,'?????????????',38,1),(305,'???????????',38,1),(306,'??????????',38,1),(307,'????????',38,1),(308,'???????',38,1),(309,'??????????????????',38,1),(310,'??????????',38,1),(311,'?????????????',38,1),(312,'??????????',38,1),(313,'???????????????',38,1),(315,'??????????',17,1),(317,'???????? ??????',36,1),(319,'????????????(?????)',35,1),(320,'????????? ?????',25,1),(322,'????????????? ??????',32,1),(323,'??????',11,1),(324,'???????? NEW',26,1),(325,'?????? ??????',36,1),(328,'??????????? ?????',30,1);
/*!40000 ALTER TABLE `nalavariyam_taluk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nalavariyampayment`
--

DROP TABLE IF EXISTS `nalavariyampayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nalavariyampayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT 0,
  `to_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `newbalance` decimal(10,2) DEFAULT 0.00,
  `iscommission` tinyint(4) DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `service_status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ad_info` varchar(100) DEFAULT NULL,
  `ad_info2` varchar(100) DEFAULT NULL,
  `paid_image` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `paydate` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `k_status` int(11) DEFAULT 1,
  `service_entity` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nalavariyampayment`
--

LOCK TABLES `nalavariyampayment` WRITE;
/*!40000 ALTER TABLE `nalavariyampayment` DISABLE KEYS */;
INSERT INTO `nalavariyampayment` VALUES (1,1,2,50.00,9950.00,0,NULL,NULL,2,'Out Payment',NULL,'Bulk Service Payment',NULL,NULL,'07:18:55','2025-11-10',2,1,NULL),(2,2,1,50.00,10050.00,0,NULL,NULL,2,'IN Payment',NULL,'Bulk Service Payment',NULL,NULL,'07:18:55','2025-11-10',2,1,NULL),(3,1,2,50.00,9900.00,0,NULL,NULL,2,'Out Payment',NULL,'Bulk Service Payment',NULL,NULL,'07:24:59','2025-11-10',2,1,NULL),(4,2,1,50.00,10100.00,0,NULL,NULL,2,'IN Payment',NULL,'Bulk Service Payment',NULL,NULL,'07:24:59','2025-11-10',2,1,NULL),(5,1,2,100.00,100.00,0,NULL,NULL,1,'In Payment',NULL,'Nalavariyam Wallet Add Money',NULL,NULL,'14:39:32','2026-01-20',2,1,NULL),(6,1,2,100.00,1920.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'06:35:16','2026-01-21',2,1,NULL),(7,2,1,100.00,100.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'06:35:16','2026-01-21',2,1,NULL),(8,1,2,250.00,250.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit Tailoring Certificate',NULL,NULL,'08:51:08','2026-01-21',2,1,NULL),(9,2,1,250.00,350.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit Tailoring Certificate',NULL,NULL,'08:51:08','2026-01-21',2,1,NULL);
/*!40000 ALTER TABLE `nalavariyampayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newenquiry`
--

DROP TABLE IF EXISTS `newenquiry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newenquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(500) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newenquiry`
--

LOCK TABLES `newenquiry` WRITE;
/*!40000 ALTER TABLE `newenquiry` DISABLE KEYS */;
INSERT INTO `newenquiry` VALUES (1,'svn','ramji@gmail.com',NULL,'kjchjk'),(2,'Saravanan p','murugesanv533@gmail.com','jhgfghjkl','lkjhvvbncvbnnm'),(3,'jhghjk','ramji@gmail.com','jhgfghjkl','kjcvb,'),(4,'Saravanan p','admin@gmail.com','jhgfghjkl','gggggggg'),(5,'lyla','ramji@gmail.com','sddddddddddd','www');
/*!40000 ALTER TABLE `newenquiry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notify` varchar(2000) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operator`
--

DROP TABLE IF EXISTS `operator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) DEFAULT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT 0.00,
  `retailer_commission` decimal(10,2) DEFAULT 0.00,
  `ramjiservice_id` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operator`
--

LOCK TABLES `operator` WRITE;
/*!40000 ALTER TABLE `operator` DISABLE KEYS */;
/*!40000 ALTER TABLE `operator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pancard`
--

DROP TABLE IF EXISTS `pancard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pancard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `last_name` varchar(40) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `title` varchar(30) DEFAULT NULL,
  `mode` varchar(30) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `pancard_type` varchar(20) DEFAULT NULL,
  `relative_name` varchar(20) DEFAULT NULL,
  `signature` varchar(40) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `email_id` varchar(40) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `api_status` varchar(30) DEFAULT NULL,
  `api_url` varchar(700) DEFAULT NULL,
  `api_txid` varchar(30) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `message` varchar(500) DEFAULT NULL,
  `father_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pancard`
--

LOCK TABLES `pancard` WRITE;
/*!40000 ALTER TABLE `pancard` DISABLE KEYS */;
INSERT INTO `pancard` VALUES (1,69,1,5,0,0,60.00,'Saravanan p',NULL,'9887877777',NULL,NULL,'EKYC',NULL,0,0,0,NULL,'0000000',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Resubmit','Failure','','523495','good','2024-12-11',NULL,'2024-12-11',NULL,NULL,NULL);
/*!40000 ALTER TABLE `pancard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pancard_find`
--

DROP TABLE IF EXISTS `pancard_find`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pancard_find` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `father_name` varchar(200) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `dob` varchar(20) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pancard_find`
--

LOCK TABLES `pancard_find` WRITE;
/*!40000 ALTER TABLE `pancard_find` DISABLE KEYS */;
INSERT INTO `pancard_find` VALUES (1,2,NULL,NULL,NULL,'KFLPS8934D','PERUMALNADAR SARAVANAN',NULL,'Male','08/06/1997','PN details retrieved successfully','Approved','2024-12-21 07:55:21'),(2,2,1,12.00,'868630079735','KFLPS8934D','PERUMALNADAR SARAVANAN',NULL,NULL,'08/06/1997','Entered Aadhaar number is already linked with a PAN','Approved','2025-01-25 ');
/*!40000 ALTER TABLE `pancard_find` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panchayath`
--

DROP TABLE IF EXISTS `panchayath`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panchayath` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `panchayath_name` text NOT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17857 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panchayath`
--

LOCK TABLES `panchayath` WRITE;
/*!40000 ALTER TABLE `panchayath` DISABLE KEYS */;
INSERT INTO `panchayath` VALUES (1,'அய்யூர்',1,1),(2,'அழகாபுரம்',1,1),(3,'ஆண்டிமடம்',1,1),(4,'அணிக்குதிச்சான் தெற்கு',1,1),(5,'அணிக்குதிச்சான் வடக்கு',1,1),(6,'ஆத்துக்குறிச்சி',1,1),(7,'இடையாக்குறிச்சி',1,1),(8,'இலையூர் கிழக்கு',1,1),(9,'இலையூர் மேற்கு',1,1),(10,'காட்டத்தூர் வடக்கு',1,1),(11,'காட்டத்தூர் தெற்கு',1,1),(12,'கொடுக்கூர்',1,1),(13,'கூவத்தூர் வடக்கு',1,1),(14,'கூவத்தூர் தெற்கு',1,1),(15,'குவாகம்',1,1),(16,'மருதூர்',1,1),(17,'மேலூர்',1,1),(18,'ஓலையூர்',1,1),(19,'பெரியகிருஷ்ணாபுரம்',1,1),(20,'இராங்கியம்',1,1),(21,'சிலம்பூர் வடக்கு.',1,1),(22,'சிலம்பூர் தெற்கு',1,1),(23,'சிலுவைச்சேரி',1,1),(24,'ஸ்ரீராமன்',1,1),(25,'தேவனூர்',1,1),(26,'திருக்களபூர்',1,1),(27,'வரதராஜன்பேட்டை',1,1),(28,'வாரியங்கவால்',1,1),(29,'விளந்தை வடக்கு',1,1),(30,'விளந்தை தெற்கு',1,1),(31,'அழகியமணவாளம்',2,1),(32,'ஆலந்துடையார்கட்டளை',2,1),(33,'அமீனபாத்',2,1),(34,'ஆண்டிப்பட்டாக்காடு',2,1),(35,'அன்னிமங்கலம்',2,1),(36,'அரியலூர் வடக்கு',2,1),(37,'அரியலூர் தெற்கு',2,1),(38,'அருங்கால்',2,1),(39,'அயன்ஆத்தூர்',2,1),(40,'அயன்சுத்தமல்லி',2,1),(41,'சென்னிவனம்',2,1),(42,'சின்னபட்டாக்காடு',2,1),(43,'ஏலாக்குறிச்சி',2,1),(44,'எலந்தகூடம்',2,1),(45,'கோவிந்தபுரம்',2,1),(46,'இடையாத்தங்குடி',2,1),(47,'இலுப்பையூர்',2,1),(48,'கடுகூர்',2,1),(49,'கயர்லாபாத்',2,1),(50,'கல்லங்குறிச்சி',2,1),(51,'காமரசவல்லி',2,1),(52,'கண்டிராதீர்த்தம்',2,1),(53,'கரையவெட்டி',2,1),(54,'கருப்பிலாக்கட்டளை',2,1),(55,'கருப்பூர் சேனாபதி',2,1),(56,'காவனூர்',2,1),(57,'கீழகாவட்டான்குறிச்சி',2,1),(58,'கீழக்கொளத்தூர்',2,1),(59,'கீழப்பழுவூர்',2,1),(60,'கீழையூர்',2,1),(61,'கோவில் எசனை கிழக்கு',2,1),(62,'கோவில் எசனை மேற்கு',2,1),(63,'கோவிலூர்',2,1),(64,'குலமாணிக்கம் கிழக்கு',2,1),(65,'குலமாணிக்கம் மேற்கு',2,1),(66,'குருவாடி',2,1),(67,'மல்லூர்',2,1),(68,'மஞ்சமேடு',2,1),(69,'மேலப்பழுவூர்',2,1),(70,'நாகமங்கலம்',2,1),(71,'ஓரியூர்',2,1),(72,'ஓட்டக்கோவில்',2,1),(73,'பளிங்காநத்தம்',2,1),(74,'பார்ப்பணச்சேரி',2,1),(75,'பெரியநாகலூர்',2,1),(76,'பெரியதிருக்கோணம்',2,1),(77,'பூண்டி',2,1),(78,'பொட்டவெளி',2,1),(79,'புதுப்பாளையம்',2,1),(80,'புங்கங்குழி',2,1),(81,'இராயம்புரம்',2,1),(82,'ரெட்டிபாளையம்',2,1),(83,'சன்னாவூர் வடக்கு',2,1),(84,'சன்னாவூர் தெற்கு',2,1),(85,'சாத்தமங்கலம்',2,1),(86,'சிறுவளூர்',2,1),(87,'சுள்ளங்குடி',2,1),(88,'தேளூர்',2,1),(89,'திருமழப்பாடி',2,1),(90,'திருமானூர்',2,1),(91,'தூத்தூர்',2,1),(92,'வடுகபாளையம்',2,1),(93,'வாலாஜாநகரம்',2,1),(94,'வாரணவாசி',2,1),(95,'வெங்கனூர்',2,1),(96,'வெற்றியூர்',2,1),(97,'விளாங்குடி',2,1),(98,'விழுப்பணங்குறிச்சி',2,1),(99,'ஆனந்தவாடி',3,1),(100,'ஆலத்தியூர்',3,1),(101,'அசாவீரன்குடிக்காடு',3,1),(102,'ஆதனக்குறிச்சி',3,1),(103,'அயன்தத்தனூர்',3,1),(104,'இரும்புலிக்குறிச்சி',3,1),(105,'கீழமாளிகை',3,1),(106,'கிளிமங்கலம்',3,1),(107,'குழுமூர்',3,1),(108,'மணக்குடையான்',3,1),(109,'மணப்பத்தூர்',3,1),(110,'மருவத்தூர்',3,1),(111,'நாகல்குழி',3,1),(112,'நக்கம்பாடி',3,1),(113,'நமங்குணம்',3,1),(114,'பரணம்',3,1),(115,'பெரியாக்குறிச்சி',3,1),(116,'பிலாக்குறிச்சி',3,1),(117,'பொன்பரப்பி',3,1),(118,'சன்னாசிநல்லூர்',3,1),(119,'செந்துறை',3,1),(120,'சிறுகடம்பூர்',3,1),(121,'சிறுகளத்தூர்',3,1),(122,'தளவாய் வடக்கு',3,1),(123,'தளவாய் தெற்கு',3,1),(124,'துளார்',3,1),(125,'உஞ்சினி',3,1),(126,'வஞ்சினபுரம்',3,1),(127,'ஆமணக்கந்தோண்டி',NULL,1),(128,'அம்பாப்பூர்',4,1),(129,'அணைக்குடம்',4,1),(130,'அங்கராயநல்லூர் கிழக்கு',4,1),(131,'அங்கராயநல்லூர் மேற்கு',4,1),(132,'ஆமணக்கந்தோண்டி',NULL,1),(133,'தேவாமங்கலம் ',4,1),(134,'தர்மசமுத்திரம் ',4,1),(135,'இடங்கண்ணி ',4,1),(136,'இடையார் ',4,1),(137,'இளையபெருமாள் நல்லூர் ',4,1),(138,'ஏரவாங்குடி ',4,1),(139,'இருகையூர் ',4,1),(140,'கோவிந்தபுத்தூர் ',4,1),(141,'ஜெயங்கொண்டம் ',4,1),(142,'கடம்பூர் ',4,1),(143,'காரைக்குறிச்சி ',4,1),(144,'காட்டகரம் வடக்கு ',4,1),(145,'காட்டகரம் தெற்கு ',4,1),(146,'கீழக்குடியிருப்பு ',4,1),(148,'கோடாலிக்கருப்பூர் ',4,1),(149,'கோடங்குடி வடக்கு ',4,1),(150,'கோடங்குடி தெற்கு ',4,1),(151,'குலோத்துங்கநல்லூர் ',4,1),(152,'குண்டவெளி கிழக்கு ',4,1),(153,'குண்டவெளி மேற்கு ',4,1),(154,'குருவாலப்பர்கோவில் ',4,1),(155,'மணகெதி  ',4,1),(156,'முத்துசேர்வாமடம் ',4,1),(157,'நடுவலூர் கிழக்கு ',4,1),(158,'நடுவலூர் மேற்கு ',4,1),(159,'நாயகனைப்பிரியாள் ',4,1),(160,'பாப்பாக்குடி வடக்கு ',4,1),(161,'பாப்பாக்குடி தெற்கு ',4,1),(162,'பருக்கல் கிழக்கு ',4,1),(163,'பருக்கல் மேற்கு ',4,1),(164,'பெரியவளையம் ',4,1),(165,'பிச்சனூர் ',4,1),(166,'பிலிச்சிக்குழி ',4,1),(167,'பிராஞ்சேரி ',4,1),(168,'சாத்தம்பாடி ',4,1),(169,'சூரிய மணல் ',4,1),(170,'ஸ்ரீ புரந்தான்  வடக்கு ',4,1),(171,'ஸ்ரீ புரந்தான் தெற்கு	',4,1),(172,'சுத்தமல்லி ',4,1),(173,'தா  சோழங்குறிச்சி  வடக்கு ',4,1),(174,'தா சோழங்குறிச்சி தெற்கு ',4,1),(175,'தா  பழூர் ',4,1),(176,'தழுதாழைமேடு ',4,1),(177,'தண்டலை ',4,1),(178,'தத்தனூர் கிழக்கு ',4,1),(179,'தத்தனூர் மேற்கு ',4,1),(180,'தென்கச்சிபெருமாள்நத்தம் ',4,1),(181,'உடையார் பாளையம்  கிழக்கு ',4,1),(182,'உடையார் பாளையம் மேற்கு	',4,1),(183,'உடையவர்தீயனூர் ',4,1),(184,'உதயநத்தம் கிழக்கு ',4,1),(185,'உதயநத்தம்  மேற்கு ',4,1),(186,'உல்லியக்குடி ',4,1),(187,'உட்கோட்டை  வடக்கு ',4,1),(188,'உட்கோட்டை தெற்கு ',4,1),(189,'வாழைக் குறிச்சி ',4,1),(190,'வாணதிரையன்பட்டினம்  ',4,1),(191,'வங்குடி ',4,1),(192,'வேம்புகுடி ',4,1),(193,'வெண்மான்கொண்டான்  கிழக்கு  ',4,1),(194,'வெண்மான்கொண்டான் மேற்கு ',4,1),(195,'வெத்தியார்வெட்டு ',4,1),(196,'ஆலப்பக்கம் ',5,1),(197,'அம்மனம்பாக்கம் ',5,1),(198,'அஞ்சூர் ',5,1),(199,'அனுமந்தை ',5,1),(200,'அனுமந்தபுத்தேரி ',5,1),(201,'ஆப்பூர் ',5,1),(202,'ஆத்தூர்   ஆ ',5,1),(203,'ஆத்தூர் அ ',5,1),(204,'சட்டமங்கலம் ',5,1),(205,'செங்கல்பட்டு ',5,1),(206,'சென்னேரி ',5,1),(207,'செட்டிபுண்ணியம் ',5,1),(208,'சித்தமனூர் ',5,1),(209,'ஈச்சங்கரணை ',5,1),(210,'எடையான் கொடுமந்தாங்கல் ',5,1),(211,'குருவன்மேடு ',5,1),(212,'இருங்குன்றபள்ளி ',5,1),(213,'காச்சாடிமங்கலம் ',5,1),(214,'கடம்பூர் ',5,1),(215,'களிவந்தம்பட்டு ',5,1),(216,'காந்தலூர் ',5,1),(217,'கரிநிலம் ',5,1),(218,'கரும்பூர் ',5,1),(219,'காட்டங்கொளத்தூர் ',5,1),(220,'காயரம்பேடு ',5,1),(221,'கீழ்க்கரணை  ',5,1),(222,'கோளத்துர்  ',5,1),(223,'கோனாதி ',5,1),(224,'கொண்டமங்கலம் ',5,1),(225,'கோங்காடு ',5,1),(226,'கூடலூர் ',5,1),(227,'கோவிலந்தாங்கல் ',5,1),(228,'குண்டூர் ',5,1),(229,'குன்னவாக்கம் ',5,1),(230,'மேலமையூர் ',5,1),(231,'மேல்மனப்பாக்கம் ',5,1),(232,'நத்தம்  அ ',5,1),(233,'நத்தம் ஆ ',5,1),(234,'நின்னக்கரை ',5,1),(235,'ஓழலூர் ',5,1),(236,'பாரேரி ',5,1),(237,'பாலூர்  அ ',5,1),(238,'பாலூர் ஆ ',5,1),(239,'பாலூர் இ ',5,1),(240,'பனங்கோட்டூர்  ',5,1),(241,'பரனூர் ',5,1),(242,'பட்டரவாக்கம் ',5,1),(243,'பழவேலி ',5,1),(244,'பேரமனூர் ',5,1),(245,'பெரியபுத்தேரி ',5,1),(246,'பெருமாள்தாங்கல் ',5,1),(247,'பொருந்தவாக்கம் ',5,1),(248,'போத்தேரி ',5,1),(249,'புலிப்பாக்கம் ',5,1),(250,'ராஜகுளிபேட்டை ',5,1),(251,'சாஸ்திரம்பாக்கம் ',5,1),(252,'செங்குன்றம் ',5,1),(253,'சேந்தமங்கலம் ',5,1),(254,'சிங்கபெருமாள்கோவில் ',5,1),(255,'தைலாபுரம் ',5,1),(256,'தாலிமங்கலம் ',5,1),(257,'தாசரி குன்னதூர் ',5,1),(258,'தென்மேல்பாக்கம் ',5,1),(259,'தேனூர் ',5,1),(260,'திருக்கச்சூர் ',5,1),(261,'திருத்தேரி ',5,1),(262,'திருவடிசூலம் ',5,1),(263,'வல்லம் ',5,1),(264,'வல்லஞ்சேரி ',5,1),(265,'வேத நாராயணபுரம் ',5,1),(266,'வீராபுரம் ',5,1),(267,'வெங்கடாபுரம் ',5,1),(268,'வேண்பாக்கம் ',5,1),(269,'வெண்பாக்கம்',5,1),(270,'வில்லியம்பாக்கம் ',5,1),(271,'விஞ்சியம்பாக்கம் ',5,1),(272,'AGARAM',6,1),(273,'AKKINAMPATTU',6,1),(274,'ALAMBARAI',6,1),(275,'AMMANAMBAKKAM',6,1),(276,'AMMANUR',6,1),(277,'ANDARKUPPAM',6,1),(278,'ARAPPEDU',6,1),(279,'AMANTHANKARANAI',6,1),(280,'ARASUR',6,1),(281,'PORAIYUR',6,1),(282,'MAZHAVANKARANAI',6,1),(283,'POLAMBAKKAM',6,1),(284,'KURUMPIRAI',6,1),(285,'CHITHAMOOR',6,1),(286,'KANNIMANGALAM',6,1),(287,'MUGUNTHAGIRI',6,1),(288,'PERAMBAKKAM',6,1),(289,'PERUNGARANAI ZONE 1',6,1),(290,'PERUNGARANAI ZONE 2',6,1),(291,'PAZHAOOR',6,1),(292,'POORIYAMPAKKAM',6,1),(293,'PARUKKAL',6,1),(294,'VETTAPERUMPAKKAM',6,1),(295,'THANDALAM',6,1),(296,'PERIYAKALAKKADI',6,1),(297,'SIRUKALATHUR',6,1),(298,'SOTHUPAKKAM',6,1),(299,'KESAVARAYANPETTAI',6,1),(300,'MELMARUVATHUR',6,1),(301,'KIZMARUVATHUR',6,1),(302,'VILANGADU',6,1),(303,'PORUR',6,1),(304,'PONTHUR',6,1),(305,'KOONANKARANAI',6,1),(306,'POONGUNAM',6,1),(307,'NUGUMBAL',6,1),(308,'KOLLATHANALLUR',6,1),(309,'ERUMBULI',6,1),(310,'SIRUKKARANAI',6,1),(311,'ELLEDU',6,1),(312,'KAYANALLUR, ',6,1),(313,'VENNANTHAL',6,1),(314,'PUDUPATTU',6,1),(315,'VELLANKONDAGARAM',6,1),(316,'ESUR',6,1),(317,'PICHANTHANGAL',6,1),(318,'PUTHIRANKOTTAI',6,1),(319,'PUDHUKUPPAM',6,1),(320,'VANNIYANALLUR',6,1),(321,'VILAMPATTU',6,1),(322,'THURAIYUR',6,1),(323,'MAMPATTU',6,1),(324,'MAMBAKKAM',6,1),(325,'THUNDAMVELLERI',6,1),(326,'PANAIYADIVAKKAM',6,1),(327,'KALPATTU',6,1),(328,'THENNERIPATTU',6,1),(329,'CHINNAKALAKKADI',6,1),(330,'VELLOR',6,1),(331,'SOONAMBEDU',6,1),(332,'VILLIPAKKAM',6,1),(333,'MANAPAKKAM',6,1),(334,'KAVANUR',6,1),(335,'KOKKARATHANGAL',6,1),(336,'VAYALUR',6,1),(337,'OTHIVILAGAM',6,1),(338,'PALLAMBAKKAM',6,1),(339,'SOORAKUPPAM',6,1),(340,'THOTTACHERI',6,1),(341,'VEMBANUR',6,1),(342,'KADAPAKKAM',6,1),(343,'PANAIYUR, ',6,1),(344,'VILAMBUR',6,1),(345,'KOTTAIKADU',6,1),(346,'THENPAKKAM',6,1),(347,'KOLATHUR',6,1),(348,'VENNANGUPATTU',6,1),(349,'KADUKKALUR',6,1),(350,'KARUMBAKKAM',6,1),(351,'NALLUR',6,1),(352,'GENGADEVANKUPPAM',6,1),(353,'KOVAIPAKKAM',6,1),(354,'SEMBULIVARAM',6,1),(355,'KAPPIVAKKAM',6,1),(356,'MUDALIARKUPPAM',6,1),(357,'NAINARKUPPAM',6,1),(358,'OTHIYUR',6,1),(359,'VEDOL',6,1),(360,'CHITHARKADU',6,1),(361,'THANNEERPANTHAL',6,1),(362,'NANKALATHUR',6,1),(363,'PALAIYUR',6,1),(364,'INTHALUR',6,1),(365,'PULIYANI',6,1),(366,'THUTHUVILAMPATTU',6,1),(367,'SIRUVILAMPAKKAM',6,1),(368,'KOLATHUR',6,1),(369,'PUTHAMANGALAM',6,1),(370,'NERKUNAM',6,1),(371,'VAYALUR',6,1),(372,'KADAPERI',6,1),(373,'THENPAKKAM',6,1),(374,'PERIYAKAYAPAKKAM',6,1),(375,'CHINNAKAYAPAKKAM',6,1),(376,'CHITLAPAKKAM',6,1),(377,'SIRUNAGAR',6,1),(378,'KUMULI',6,1),(379,'CHITHUR',6,1),(380,'PILANKUPPAM',6,1),(381,'SIRUMAILUR',6,1),(382,'ERAVANALLUR',6,1),(383,'VENMALAGARAM',6,1),(384,'KOOVATHOUR',6,1),(385,'KIZHARKOLLAI',6,1),(386,'KADALUR',6,1),(387,'CHINNAKUPPAM',6,1),(388,'ALIKUPPAM',6,1),(389,'PERIYAKUPPAM',6,1),(390,'VEPPANCHERI',6,1),(391,'NEDUMARAM',6,1),(392,'MURUKKANTHANGAL',6,1),(393,'MALRAJKUPPAM',6,1),(394,'PERUMALCHERI',6,1),(395,'SATHIYAMANGALAM',6,1),(396,'MUGAIYUR',6,1),(397,'THENPATTINAM',6,1),(398,'KOLATHURMALACHERI',6,1),(399,'VETTAKKARAKUPPAM',6,1),(400,'PARAMANKENI',6,1),(401,'PERUNTHURAVU',6,1),(402,'SEKKANANKUPPAM',6,1),(403,'PAKKUR',6,1),(404,'VELLUR',6,1),(405,'MADAIYAMPAKKAM',6,1),(406,'ATCHIVILAGAM',6,1),(407,'VADAPATTINAM',6,1),(408,'KODAPATTINAM',6,1),(409,'KANATHUR',6,1),(410,'KODOUR (MADAVILAGAM)',6,1),(411,'PALUR',6,1),(412,'SEEVADI',6,1),(413,'UZHUTHAMANGALAM',6,1),(414,'LATHUR',6,1),(415,'PACHAMPAKKAM',6,1),(416,'NEELAMANGALAM',6,1),(417,'SATHAMANGALAM',6,1),(418,'NELVOY',6,1),(419,'PEKKARANAI',6,1),(420,'PARAMESWARAMANGALAM',6,1),(421,'GUNDUMANICHERI',6,1),(422,'SOZHAKATTU',6,1),(423,'UDALKARAKUPPAM',6,1),(424,'KALKUNAM',6,1),(425,'SEVUR',6,1),(426,'MADAVILAGAM',6,1),(427,'PAVUNJUR',6,1),(428,'NELVOIPALAYAM',6,1),(429,'MANIKUPPAM',6,1),(430,'VADAKKUVAYALUR',6,1),(431,'KARUPPUR',6,1),(432,'PUNNAMAI',6,1),(433,'SEMBUR',6,1),(434,'PARASANALLUR',6,1),(435,'THONDAMANALLUR',6,1),(436,'KUMARAKUPPAM',6,1),(437,'NARIYUR',6,1),(438,'THATHANKUPPAM',6,1),(439,'THANDARAI',6,1),(440,'POIGAINALLUR',6,1),(441,'PURANCHERI',6,1),(442,'PERIYAVELIKADU',6,1),(443,'NERKUNAPATTU',6,1),(444,'THATTAMPATTU',6,1),(445,'VEERABOGAM',6,1),(446,'SUNDIVAKKAM',6,1),(447,'KEZHACHERI',6,1),(448,'PUDUPATTU',6,1),(449,'THIRIPURAKOVIL',6,1),(450,'PAKKUVANCHERI',6,1),(451,'NEMANTHAM',6,1),(452,'KADUGUPATTU',6,1),(453,'ERANIYASITHI',6,1),(454,'THIRUVATHUR',6,1),(455,'SENGATTUR',6,1),(456,'MARUTHERI',6,1),(457,'PERUMBAKKAM',6,1),(458,'MELAPATTU',6,1),(459,'SIRUVANKUNAM',6,1),(460,'MARUTHERI',6,1),(461,'CHINNAVELIKADU',6,1),(462,'KALPATTU',6,1),(463,'PENNAKANDAI',6,1),(464,'CHEYYUR ZONE A & R',6,1),(465,'CHEYYUR ZONE B',6,1),(466,'CHEYYUR ZONE C',6,1),(467,'CHEYYUR ZONE D& E',6,1),(468,'ARCOT',6,1),(469,'ALAMBARAI',6,1),(470,'ATTUPATTIKOTTAIPUNJAI',6,1),(471,'AYAKUNNAM',6,1),(472,'ANAIKATTU',6,1),(473,'Agili',7,1),(474,'Alapakkam',7,1),(475,'Allur',7,1),(476,'Amayampattu',7,1),(477,'Anathamangalam',7,1),(478,'Anddavaakkam',7,1),(479,'Annangal',7,1),(480,'Annumanthakuppam',7,1),(481,'Ariyanur',7,1),(482,'Ariypakkam',7,1),(483,'Arungunam',7,1),(484,'Atcharapakkam',7,1),(485,'Athiur',7,1),(486,'Athivakkam',7,1),(487,'Athivakkam',7,1),(488,'Athur',7,1),(489,'Attimanam',7,1),(490,'Avirimedu',7,1),(491,'Baburayanpettai',7,1),(492,'Chinnavenmani',7,1),(493,'Chinthamani',7,1),(494,'Chirunagaloor',7,1),(495,'Chiruthamur',7,1),(496,'Chiruthamur',7,1),(497,'Chithandi',7,1),(498,'Chithrawadi',7,1),(499,'Chozhanthangal',7,1),(500,'Devadoor',7,1),(501,'Dharmapuram',7,1),(502,'Edayalam',7,1),(503,'Elappakkam',7,1),(504,'Endaththur',7,1),(505,'Eruvakkam',7,1),(506,'Esoor',7,1),(507,'Irumbedu',7,1),(508,'Irusamanallur',7,1),(509,'Jameen Endathur',7,1),(510,'Jameen Puthur',7,1),(511,'Janakipuram',7,1),(512,'Kadamalaiputhoor',7,1),(513,'Kadambur',7,1),(514,'Kadaperi',7,1),(515,'Kalathur',7,1),(516,'Kallaparanpuram',7,1),(517,'Karasangal',7,1),(518,'Karikkilli',7,1),(519,'Karunagarachcheery',7,1),(520,'Karrunagaravilagam',7,1),(521,'Karunkuzhi',7,1),(522,'Kathiricheri',7,1),(523,'Kattudavathur',7,1),(524,'Kattugudalur',7,1),(525,'Kattukkaranai',7,1),(526,'Kavathur',7,1),(527,'Kazhanipakkam',7,1),(528,'keelpattu',7,1),(529,'Keezhvasalai',7,1),(530,'Keilamoor',7,1),(531,'Kendiracherri',7,1),(532,'Kilianagar',7,1),(533,'Killathivakkam',7,1),(534,'Kinnar',7,1),(535,'Kizhvaalam',7,1),(536,'Kodithandalam',7,1),(537,'Kolathur',7,1),(538,'Kongaraimampattu',7,1),(539,'Koodalur',7,1),(540,'Kooddapakkam',7,1),(541,'Kozhiyalam',7,1),(542,'Kumaravadi',7,1),(543,'Kunankaranai',7,1),(544,'Kunnankolathur',7,1),(545,'Kunnathur',7,1),(546,'Kunnavakkam',7,1),(547,'Laadakaranai',7,1),(548,'lakshiminarayanapuram',7,1),(549,'Madhoor',7,1),(550,'Madurai',7,1),(551,'Maduranthakam-1',7,1),(552,'Mamandur',7,1),(553,'Mambakkam',7,1),(554,'Mambattu',7,1),(555,'Mangalam',7,1),(556,'Marriputhur',7,1),(557,'Mathur',7,1),(558,'Melakandai',7,1),(559,'MelavalamMeyyur',7,1),(560,'Minnal kilminnal',7,1),(561,'Mogalvadi',7,1),(562,'Morappakkam',7,1),(563,'Mulli',7,1),(564,'Muniyanthangal',7,1),(565,'Munnakulam',7,1),(566,'Munnuthikuppam',7,1),(567,'Murugambakkam',7,1),(568,'Murukancheri',7,1),(569,'Murungai',7,1),(570,'Musivakkam',7,1),(571,'Nallamur',7,1),(572,'Nallur',7,1),(573,'Nedungal',7,1),(574,'Neerper',7,1),(575,'Nelli',7,1),(576,'Nelli',7,1),(577,'Nelvoy',7,1),(578,'Nemam',7,1),(579,'Nesapakkam',7,1),(580,'Nethappakkam',7,1),(581,'Netrampakkam',7,1),(582,'Orathi',7,1),(583,'Orathur',7,1),(584,'Ozhivetti',7,1),(585,'Padalam',7,1),(586,'Padiri',7,1),(587,'Pakkam',7,1),(588,'Palamathur',7,1),(589,'Pallipettai',7,1),(590,'Palliyakaram',7,1),(591,'Pambayampattu',7,1),(592,'Papanalloor',7,1),(593,'Pasumbur',7,1),(594,'Pasuvankaranai',7,1),(595,'Patthur',7,1),(596,'Pazhayanur',7,1),(597,'Periyavenmani',7,1),(598,'Perumpakkam',7,1),(599,'Perumperakandigai',7,1),(600,'Peruvelli',7,1),(601,'Pilappur',7,1),(602,'Pillanthikuppam',7,1),(603,'Pinnampoondi',7,1),(604,'Poondi',7,1),(605,'Poorpankarani',7,1),(606,'Poothur',7,1),(607,'Porakal',7,1),(608,'Puducchery',7,1),(609,'Pudupattu',7,1),(610,'Pukadurai',7,1),(611,'Pulikoradu',7,1),(612,'Puliparakkoil',7,1),(613,'Puiyaranankottai',7,1),(614,'Puzhuthivakkam',7,1),(615,'Rajapalayam',7,1),(616,'Ravuthhanallur',7,1),(617,'Sampathinallur',7,1),(618,'Sathamay',7,1),(619,'Seerunallore',7,1),(620,'Seethapuram',7,1),(621,'sempoondy',7,1),(622,'senaiyaneri',7,1),(623,'sendivakkam',7,1),(624,'Silavattam',7,1),(625,'Siruperapanndi',7,1),(626,'Siruvankunnam',7,1),(627,'Sithamoor',7,1),(628,'Sitthathur',7,1),(629,'Soorai',7,1),(630,'Tandarai',7,1),(631,'Thandalam',7,1),(632,'Thevanoor',7,1),(633,'Thimmapuram',7,1),(634,'Thinnaloor',7,1),(635,'Thirumukkadu',7,1),(636,'Thitalam',7,1),(637,'Thitanaval',7,1),(638,'Thozhupeddu',7,1),(639,'Thuraiyur',7,1),(640,'Unamalai',7,1),(641,'Utthamanallur',7,1),(642,'Uzhuthamangalam',7,1),(643,'Vadakuputhur',7,1),(644,'Vadamanipakkam',7,1),(645,'Vaiayur',7,1),(646,'Vaippannai',7,1),(647,'Valaamur',7,1),(648,'Valarpirai',7,1),(649,'Valayaputhdur',7,1),(650,'Vasanthavaddi',7,1),(651,'Vedanthangal',7,1),(652,'Vedavakkam',7,1),(653,'Veeranakkunnam',7,1),(654,'Veliyampakkam',7,1),(655,'Vellaputhoor',7,1),(656,'Vellarai',7,1),(657,'Veppankaranai',7,1),(658,'Veralore',7,1),(659,'Vilagam',7,1),(660,'Vilangadu',7,1),(661,'Vilvarayanallur',7,1),(662,'Vinayaganallur',7,1),(663,'Vinnampoondi',7,1),(664,'Anagaputthur',8,1),(665,'cantonment pallavaram',8,1),(666,'Esa pallavaram',8,1),(667,'Jameen pallavaram',8,1),(668,'kowlbazar',8,1),(669,'Moovarasampattu',8,1),(670,'Nimilicheri',8,1),(671,'Pammal',8,1),(672,'Pozhichalur',8,1),(673,'ST. Thomas mount',8,1),(674,'Thirisulam',8,1),(675,'Thiruneermalai',8,1),(676,'Aaraankalani',9,1),(677,'Akaram then',9,1),(678,'Chitlapakkam',9,1),(679,'Chittalapakkam',9,1),(680,'Gowrivakkam',9,1),(681,'Irumbuliyur',9,1),(682,'Kadaperi',9,1),(683,'Kaspapuram',9,1),(684,'Kovilacheri',9,1),(685,'Kovilambakkam',9,1),(686,'Maddambakkam',9,1),(687,'Madurapakam',9,1),(688,'Medavakkam',9,1),(689,'Mudicchur',9,1),(690,'Mulacheri',9,1),(691,'Nanmangalam',9,1),(692,'Otiyampakkam',9,1),(693,'Peerkkararanai',9,1),(694,'Perumpakkam',9,1),(695,'Perrunkalathur',9,1),(696,'Pulikoradu',9,1),(697,'Rajakizhpakkam',9,1),(698,'Selaiyur',9,1),(699,'Sembakkam',9,1),(700,'Tambaram',9,1),(701,'tThiruvancherri',9,1),(702,'Vengaivaasal',9,1),(703,'Vengapakkam',9,1),(704,'Aamaippakkam',10,1),(705,'Aanur',10,1),(706,'Acharavakkaam',10,1),(707,'Adavilaagam',10,1),(708,'Aminjikarai',10,1),(709,'Ammanampakkam',10,1),(710,'Angampattu',10,1),(711,'Arambakkam',10,1),(712,'Attavattam',10,1),(713,'Ayyapakkam',10,1),(714,'Azhaku samuthiram',10,1),(715,'Bommarajapuram',10,1),(716,'Chinnakattupakkam',10,1),(717,'Eachur',10,1),(718,'Edayur',10,1),(719,'Egai',10,1),(720,'Eichankaranai',10,1),(721,'Elumichampattu',10,1),(722,'Idaiyathur',10,1),(723,'Irumpulee',10,1),(724,'Janakipuram',10,1),(725,'Kadampade',10,1),(726,'Kangeyan kuppam',10,1),(727,'Karumarapakkam',10,1),(728,'Keezhavedu',10,1),(729,'Kerapakkam',10,1),(730,'Kilappakkam',10,1),(731,'Kokilamedu',10,1),(732,'Kondakarikuppam',10,1),(733,'Korapattu',10,1),(734,'Kothimangalam',10,1),(735,'Kudiperambakkam',10,1),(736,'Kunnathur',10,1),(737,'Kunnavakkam',10,1),(738,'Kunnavakkam 2',10,1),(739,'Kuzhipanthandlam',10,1),(740,'Lathur',10,1),(741,'Mamallapuram',10,1),(742,'Mampakkam',10,1),(743,'Manamai',10,1),(744,'Manapakkam',10,1),(745,'Mangalam B',10,1),(746,'Meiyur',10,1),(747,'Melakkuppam',10,1),(748,'Melapattu',10,1),(749,'Meleripakkam',10,1),(750,'Merkandai',10,1),(751,'Mosivakkam',10,1),(752,'mudaiyur',10,1),(753,'Mullikolathur',10,1),(754,'Muthigai nallan kuppam',10,1),(755,'Naduvakkarai',10,1),(756,'Nallanpetral',10,1),(757,'Nallaththur',10,1),(758,'Nallur',10,1),(759,'Narapakkam',10,1),(760,'Narasangkuppam',10,1),(761,'Natham kariyacheri',10,1),(762,'Navalur',10,1),(763,'Neikuppi C',10,1),(764,'Neikuppi A',10,1),(765,'Nelvouy',10,1),(766,'Nemili',10,1),(767,'Nerumpur',10,1),(768,'Ottivakam',10,1),(769,'P.V.Kalathur B',10,1),(770,'P.V.Kalathur A',10,1),(771,'Pakkam',10,1),(772,'Panagattucheri',10,1),(773,'Pandour',10,1),(774,'Pattikadu',10,1),(775,'Perambakkam',10,1),(776,'Periyakattupakkam',10,1),(777,'Perumaleri',10,1),(778,'Perumpedu',10,1),(779,'Ponpathirkuttam',10,1),(780,'Pooncheri',10,1),(781,'Poonthandalam',10,1),(782,'Pulikundram',10,1),(783,'Puliyoor',10,1),(784,'Pulleri',10,1),(785,'Punnampattu',10,1),(786,'Puthupakkam',10,1),(787,'Puthupattinam',10,1),(788,'Ruthirakudi',10,1),(789,'Saaloor',10,1),(790,'Sathurangapattinam',10,1),(791,'Sogandi',10,1),(792,'Solaikuppam',10,1),(793,'Sooradimankalam',10,1),(794,'Thathalur',10,1),(795,'Thazhampedu',10,1),(796,'Thimmur',10,1),(797,'Thirukalukundram',10,1),(798,'Thirukalukundram B',10,1),(799,'Thirumani',10,1),(800,'Thunjam',10,1),(801,'Udyampakkam',10,1),(802,'Vasavasamuthiram',10,1),(803,'Vayaloor',10,1),(804,'Vazuvathur',10,1),(805,'Veerakuppam',10,1),(806,'Veerapuram',10,1),(807,'Veerapuram',10,1),(808,'Vellapandal',10,1),(809,'Venbakkam',10,1),(810,'Venkambakkam',10,1),(811,'Venpakkam',10,1),(812,'Vilagam',10,1),(813,'Villipuram',10,1),(814,'vittalapuram',10,1),(815,'Yedaiyur',10,1),(816,'Aalanthur',11,1),(817,'Aathigamanallur',11,1),(818,'Achravakkam',11,1),(819,'Agaram',11,1),(820,'Agaram',11,1),(821,'Amaiyanpattu',11,1),(822,'Amirthapallam',11,1),(823,'Amur',11,1),(824,'Anumanthapuram',11,1),(825,'Arukundram',11,1),(826,'Chettipattu ramaiyankuppam',11,1),(827,'Chinnairumbeddu',11,1),(828,'Chinnavippedu',11,1),(829,'Dhachenavarathi',11,1),(830,'Eagattur',11,1),(831,'Edaiankuppam',11,1),(832,'Edakundram',11,1),(833,'Illaloor',11,1),(834,'Kaaranai',11,1),(835,'Kalavakkam',11,1),(836,'Kanathurredikupam',11,1),(837,'Kannakapattu',11,1),(838,'Karumpakkam',11,1),(839,'Karungkuzipallam',11,1),(840,'Kattakazhani',11,1),(841,'Kattoor',11,1),(842,'Kayaar',11,1),(843,'Kazhanippakkam',11,1),(844,'Kazhipathur',11,1),(845,'Kelampakkam',11,1),(846,'kizhur',11,1),(847,'Kondangi',11,1),(848,'Konerikuppam',11,1),(849,'Kottamedu',11,1),(850,'Kovalam',11,1),(851,'Krishnankaranai',11,1),(852,'Kunnampattu',11,1),(853,'Madayaththur',11,1),(854,'Mailai',11,1),(855,'Manamathi',11,1),(856,'Mannavedu devadhanam',11,1),(857,'Marutheri',11,1),(858,'Melkanakampettu',11,1),(859,'Mellayoor',11,1),(860,'Mullipakkam',11,1),(861,'Muttukadu',11,1),(862,'Navaloor',11,1),(863,'Nellikuppam',11,1),(864,'Nemmeli',11,1),(865,'Orakadam',11,1),(866,'Orathur',11,1),(867,'Otteri',11,1),(868,'Padoor',11,1),(869,'Paiyanur',11,1),(870,'Panchanthiruthi',11,1),(871,'Pattipulam',11,1),(872,'PeriyaIrumbedu',11,1),(873,'Periyavippedu',11,1),(874,'Perunthandalam',11,1),(875,'Pooelumbai',11,1),(876,'Poondi',11,1),(877,'Porunthavakkam',11,1),(878,'Rayamangalam',11,1),(879,'Rettikuppam',11,1),(880,'Royalpattu',11,1),(881,'Saluvankuppam',11,1),(882,'Santhanampattu',11,1),(883,'Sempakkam',11,1),(884,'Senkadu',11,1),(885,'Sirukundrem',11,1),(886,'Siruthavur',11,1),(887,'Thaiyoor A',11,1),(888,'Thaiyoor B',11,1),(889,'Thandalam',11,1),(890,'Thandarai',11,1),(891,'Thasarikuppam',11,1),(892,'Thirunilai',11,1),(893,'Thirupporur',11,1),(894,'Thiruvidanthai',11,1),(895,'Valarkuram',11,1),(896,'valavanthangal',11,1),(897,'Veeralapakkam',11,1),(898,'Vengur',11,1),(899,'Venkaneri',11,1),(900,'Venpedu',11,1),(901,'Arungal',12,1),(902,'asthinapuram',12,1),(903,'Ayancherry',12,1),(904,'Guduvancheri',12,1),(905,'Kaaranaipuducheri',12,1),(906,'Kalvai',12,1),(907,'Kannivakkam',12,1),(908,'karanai',12,1),(909,'Keerapakkam',12,1),(910,'Keezhakottaiyoor',12,1),(911,'Kilampakkam',12,1),(912,'Kolathur',12,1),(913,'Kozapakkam',12,1),(914,'Kumili',12,1),(915,'Mampakkam',12,1),(916,'Mannivakkam',12,1),(917,'Melakkotaiyur',12,1),(918,'Murugamangalam',12,1),(919,'Nallampakkam',12,1),(920,'Nanthivaram',12,1),(921,'Nedungundram',12,1),(922,'Oonamnjeri',12,1),(923,'OOrapakkam',12,1),(924,'Othivakkam',12,1),(925,'Pandur',12,1),(926,'Perumattunallur',12,1),(927,'Polacherry',12,1),(928,'Ponmar',12,1),(929,'Pudupakkam',12,1),(930,'Puthhur',12,1),(931,'Rathinamangalam',12,1),(932,'Sirucheri',12,1),(933,'Sonalur',12,1),(934,'Thazhambur',12,1),(935,'vandalur',12,1),(936,'Velichai',12,1),(937,'vengadamangallam',12,1),(938,'Adambakkam',13,1),(939,'Alandur',13,1),(940,'Madhananthapuram',13,1),(941,'Manappakkam',13,1),(942,'Meenampakkam',13,1),(943,'Mukalivakkam',13,1),(944,'Nandambakkam',13,1),(945,'Nanganallur',13,1),(946,'Palavanthangal',13,1),(947,'Thalakanaacheri',13,1),(948,'Ambattur',14,1),(949,'Athipattu',14,1),(950,'Kakkapallam',14,1),(951,'Korattur',14,1),(952,'Mannur',14,1),(953,'Menambedu',14,1),(954,'Mugapair',14,1),(955,'Oragadam',14,1),(956,'Padi',14,1),(957,'Pattravakkam',14,1),(958,'Aminjikarai',15,1),(959,'Arumbakkam',15,1),(960,'Chinnakudal',15,1),(961,'Koyambedu',15,1),(962,'Mullam',15,1),(963,'Naduvankarai',15,1),(964,'Periyakudal',15,1),(965,'Sencheri',15,1),(966,'Thirumangalam',15,1),(967,'Vaddaa agram',15,1),(968,'Villivakkam',15,1),(969,'Ayanavaram (part 1)',16,1),(970,'Ayanavaram (part 2)',16,1),(971,'Chinna sembarambakkam',16,1),(972,'Kolathur',16,1),(973,'Konnur',16,1),(974,'Mallikaicheri',16,1),(975,'Peruvallur',16,1),(976,'Siruvallur',16,1),(977,'எக்மோர்  1',17,1),(978,'எக்மோர் 2',17,1),(979,'நுங்கம்பாக்கம் ',17,1),(980,'புலியூர் ',17,1),(981,'Adayar (part 1)',18,1),(982,'Adayar (part 2)',18,1),(983,'Alandur',18,1),(984,'Ekkatuthangal',18,1),(985,'Govt.farm',18,1),(986,'Guindy park',18,1),(987,'Kottur',18,1),(988,'T.nagar',18,1),(989,'Venkatapuram',18,1),(990,'Chettimedu',19,1),(991,'Kadirvedu',19,1),(992,'Kosapur',19,1),(993,'Madhavaram',19,1),(994,'Manjambakkam',19,1),(995,'Mathur',19,1),(996,'Puthagaram',19,1),(997,'Puzzhal',19,1),(998,'Soorapattu',19,1),(999,'Vadaperumbakkam',19,1),(1000,'Vilakkupattu',19,1),(1001,'Chettiaragaram',20,1),(1002,'Karambakkam',20,1),(1003,'Maduravoyal',20,1),(1004,'Nerkundram',20,1),(1005,'Nolambur',20,1),(1006,'Porur',20,1),(1007,'Ramapuram',20,1),(1008,'Sivapoodam',20,1),(1009,'Thundalam',20,1),(1010,'Valasaravakkam',20,1),(1011,'கோடம்பாக்கம்   1',21,1),(1012,'கோடம்பாக்கம் 2',21,1),(1013,'மாம்பலம் ',21,1),(1014,'நேசபாக்கம் ',21,1),(1015,'சைதாபேட்டை ',21,1),(1016,'சாலிக்கிராமம் ',21,1),(1017,'விருகம்பாக்கம் ',21,1),(1018,'மயிலாப்பூர்  1',22,1),(1019,'மயிலாப்பூர் 2',22,1),(1020,'chintadripet ',22,1),(1021,'Triplicane (part 1)',22,1),(1022,'Triplicane (part2)',22,1),(1023,'Erukkencheri',23,1),(1024,'Jambuli',23,1),(1025,'Kondungaiyur',23,1),(1026,'Perambur (pat 1)',23,1),(1027,'Perambur (pat 2)',23,1),(1028,'Perambur (pat 3)',23,1),(1029,'Selvoyil',23,1),(1030,'Sembium',23,1),(1031,'Purasawalkam (part 1)',24,1),(1032,'Purasawalkam (par 2)',24,1),(1033,'V.o.c Nagar',24,1),(1034,'Vepery',24,1),(1035,'Chemmancheri',25,1),(1036,'Chozhinganallur-1',25,1),(1037,'Chozhinganallur-2',25,1),(1038,'Enchambakkam',25,1),(1039,'Jaladampettai',25,1),(1040,'Karapakkam',25,1),(1041,'Kottivakkam',25,1),(1042,'Madipakkam',25,1),(1043,'Madipakkam-2',25,1),(1044,'Neelangarai',25,1),(1045,'Okkiyam thoraibakkam',25,1),(1046,'Palavaakkam',25,1),(1047,'Pallikaranai',25,1),(1048,'Perungudi',25,1),(1049,'Seevaram',25,1),(1050,'Ullagaram',25,1),(1051,'Utthandi',25,1),(1052,'Ariyalur',26,1),(1053,'Chinnasekkadu',26,1),(1054,'Edayanchavadi',26,1),(1055,'Edayanchavadi 2',26,1),(1056,'Elanthanjeri',26,1),(1057,'Ernavoor',26,1),(1058,'Kadapakkam',26,1),(1059,'Kahivakkam',26,1),(1060,'Manali',26,1),(1061,'Sadayankuppam',26,1),(1062,'Sathangadu',26,1),(1063,'Thiruvottiyur',26,1),(1064,'Tondiarpet (part 1)',27,1),(1065,'Tondiarpet (part 2)',27,1),(1066,'Tondiarpet (part 3)',27,1),(1067,'Tondiarpet (part 4)',27,1),(1068,'Kaanagam',28,1),(1069,'Kalikundram',28,1),(1070,'Pallipattu',28,1),(1071,'Taramani',28,1),(1072,'Thiruvanmiyur',28,1),(1073,'Urur',28,1),(1074,'Velachery (part 1)',28,1),(1075,'Velachery (part 2)',28,1),(1076,'Aathupollachi',29,1),(1077,'Ambarampalayam',29,1),(1078,'Anaimalai',29,1),(1079,'Angalakurrichi',29,1),(1080,'Arthanaripalayam',29,1),(1081,'Jallipatty',29,1),(1082,'Kaliyapuram',29,1),(1083,'Kambalapatty',29,1),(1084,'Kariyachettipalayam',29,1),(1085,'Kottur',29,1),(1086,'Marchanaickenpalayam',29,1),(1087,'Naickenpalayam',29,1),(1088,'Nallur',29,1),(1089,'Odayakulam',29,1),(1090,'Pazhayur',29,1),(1091,'Periyapodu',29,1),(1092,'Pethanaickanur',29,1),(1093,'Pilsinampalayam',29,1),(1094,'S. Ponnapuram',29,1),(1095,'Samathur',29,1),(1096,'Singanallur',29,1),(1097,'Somanthurai',29,1),(1098,'Thalavaipalayam',29,1),(1099,'Thenkumarapalayam',29,1),(1100,'Thensangampalayam',29,1),(1101,'Thenssittor',29,1),(1102,'Thondamuthur',29,1),(1103,'Thuraiyur',29,1),(1104,'Vakkampalayam',29,1),(1105,'Veeralpatti',29,1),(1106,'Vettaikaranputhur',29,1),(1107,'aambothi',30,1),(1108,'Agraharasamakulam',30,1),(1109,'Akkarai sengapally',30,1),(1110,'Allapalyam',30,1),(1111,'Annur',30,1),(1112,'Annur mettupalayam',30,1),(1113,'Bogalur',30,1),(1114,'Idikarai',30,1),(1115,'Kallipalayam',30,1),(1116,'Kanjampally',30,1),(1117,'Kanuvakarai',30,1),(1118,'Karegoundenpalayam',30,1),(1119,'Kariyampalayam',30,1),(1120,'Kattampattty',30,1),(1121,'Keeranatham',30,1),(1122,'Kondayampalayam',30,1),(1123,'Kunnathur',30,1),(1124,'Kuppanur',30,1),(1125,'Kuppepalayam',30,1),(1126,'Masagoundenchettipalayam',30,1),(1127,'Naranapuram',30,1),(1128,'Odderpalayam',30,1),(1129,'Pachapalayam',30,1),(1130,'Pasoor',30,1),(1131,'Pillayapampalayam',30,1),(1132,'Sarkar samakulam',30,1),(1133,'Vadakkalur',30,1),(1134,'Vadavalli',30,1),(1135,'Vellamadaai',30,1),(1136,'Vellanaipatty',30,1),(1137,'Anupperpalayam',31,1),(1138,'Billichi (e) And (w)',31,1),(1139,'Chinnathadagam',31,1),(1140,'Chinnavedampatty',31,1),(1141,'Ganapathy (e) and (w)',31,1),(1142,'Goundenpalayam',31,1),(1143,'Gudalur(n) and (s)',31,1),(1144,'Kalapatty (east)',31,1),(1145,'Kalapatty (west)',31,1),(1146,'Krishnarayapuram',31,1),(1147,'Kurudampalayam',31,1),(1148,'Naikenpalayam',31,1),(1149,'Nanjundapuram',31,1),(1150,'Narasimmanaikenplayalm',31,1),(1151,'Pannimadai',31,1),(1152,'Periyanaikanpalayam',31,1),(1153,'Puliyakulam',31,1),(1154,'Sanganur',31,1),(1155,'Saravanmpatty',31,1),(1156,'Somayampalayam',31,1),(1157,'Thelungupalayam',31,1),(1158,'Thudiyalur',31,1),(1159,'Veerapandi 004',31,1),(1160,'Veerapandi 024',31,1),(1161,'Vellakinar',31,1),(1162,'Vilankurichy',31,1),(1163,'Coimbatore Old Vill. and O1',32,1),(1164,'Ramanathapuram',32,1),(1165,'Singanallur',32,1),(1166,'Sowrripalayam',32,1),(1167,'Uppilipalayam',32,1),(1168,'Andipalayam',33,1),(1169,'Arasampalayam',33,1),(1170,'Chettiyakkapalayam',33,1),(1171,'Devanampalayam',33,1),(1172,'Devarrayapuram',33,1),(1173,'Govindapuram',33,1),(1174,'Kakkadavu',33,1),(1175,'Kaniyalampalayam',33,1),(1176,'Kappalankarai',33,1),(1177,'Kattampatty',33,1),(1178,'Kinthukaddavu',33,1),(1179,'Kodangipalayam',33,1),(1180,'Kodavadi',33,1),(1181,'Kondampatty',33,1),(1182,'Krishnarayapuram',33,1),(1183,'Kurunallipalayam',33,1),(1184,'Kuthirayalampalayam',33,1),(1185,'Mettubavi',33,1),(1186,'Mettupalayam',33,1),(1187,'Mullipatti',33,1),(1188,'Muthur',33,1),(1189,'Nallattipalayam',33,1),(1190,'Panapatti',33,1),(1191,'Periyakalandai',33,1),(1192,'Pottayandipuram',33,1),(1193,'Sankarayapuram',33,1),(1194,'Sokkanur',33,1),(1195,'Solavampalayam',33,1),(1196,'Soolakal',33,1),(1197,'Sozhanur',33,1),(1198,'Surukalandai',33,1),(1199,'Vadachittor',33,1),(1200,'Vaddaapudur',33,1),(1201,'Vakuthampalayam',33,1),(1202,'Vardanur',33,1),(1203,'Arisipalyam',34,1),(1204,'Chettypalayam',34,1),(1205,'Ettimadai',34,1),(1206,'Karunchamigoundenpalayam',34,1),(1207,'Kurichy',34,1),(1208,'Madukkarai',34,1),(1209,'Malumichampatty',34,1),(1210,'Mavuthampathy',34,1),(1211,'Myleripalayam',34,1),(1212,'Nachipalayam',34,1),(1213,'Oorattukuppai',34,1),(1214,'Othakalmandapam',34,1),(1215,'palathurai',34,1),(1216,'Picanur',34,1),(1217,'Seerapalayam',34,1),(1218,'Thammagoundenpalayam',34,1),(1219,'Thirumalayampalayam (n)',34,1),(1220,'Thirumalayampalayam (s)',34,1),(1221,'Vazhukuparai',34,1),(1222,'Vellalur',34,1),(1223,'Bellathi',35,1),(1224,'Bellepalayam',35,1),(1225,'Chinnakallipatty',35,1),(1226,'Iluppanatham',35,1),(1227,'Irumburai',35,1),(1228,'Jadayampalayam',35,1),(1229,'Kalampalayam',35,1),(1230,'Karramadai',35,1),(1231,'kemmaarampalayam',35,1),(1232,'Marudur',35,1),(1233,'Mooduthurai',35,1),(1234,'Nellithurai',35,1),(1235,'Odanthurai',35,1),(1236,'Sikkadasampalayam',35,1),(1237,'Sikkarampalayam',35,1),(1238,'Sirumugai',35,1),(1239,'Thekkampatty',35,1),(1240,'Tholampalayam',35,1),(1241,'Velliyankadu',35,1),(1242,'Alanthurai',36,1),(1243,'Devarayanpuram',36,1),(1244,'east Chithirai Chavadi',36,1),(1245,'Ikaraipoluvampatty (n)',36,1),(1246,'Jakirnaikenpalayam',36,1),(1247,'Kalikanaiken palayam',36,1),(1248,'Komarapalayam',36,1),(1249,'Kuniamuthur',36,1),(1250,'Madampatty',36,1),(1251,'Madavarayapuram',36,1),(1252,'Narrasipuram',36,1),(1253,'Perur',36,1),(1254,'Perurchettipalayam',36,1),(1255,'Pooluvampatti',36,1),(1256,'Semmedu',36,1),(1257,'Sundakamuthur',36,1),(1258,'Theethipalayam',36,1),(1259,'Thenamanallur',36,1),(1260,'Thenkarai',36,1),(1261,'Thondamuthur',36,1),(1262,'Vadavalli',36,1),(1263,'Vedapatty',36,1),(1264,'Veera Keralam',36,1),(1265,'Vellimalaipattinam',36,1),(1266,'West Chithirai Chavadi',36,1),(1267,'A. Nagur',37,1),(1268,'Achipatty',37,1),(1269,'Anupperpalayam',37,1),(1270,'Avalappampatty',37,1),(1271,'Ayyampalayam',37,1),(1272,'Bodipalayam',37,1),(1273,'Chandirapuram',37,1),(1274,'Chinna Negamam',37,1),(1275,'Chinnampalayam',37,1),(1276,'Devampadi',37,1),(1277,'Eripatty',37,1),(1278,'Gomangalam',37,1),(1279,'Gomangalampudur',37,1),(1280,'Kallipatty',37,1),(1281,'Kandegoundampalayam',37,1),(1282,'Kanjampatti',37,1),(1283,'Kavilipalayam',37,1),(1284,'Kittasoorampalayam',37,1),(1285,'Kolarpatti',37,1),(1286,'Kollapatty',37,1),(1287,'Kondegoundenpalayam',37,1),(1288,'Koolanaikenpatti',37,1),(1289,'Kulathur',37,1),(1290,'Kullakapalayaam',37,1),(1291,'Kullichettipalayam',37,1),(1292,'Kumarapalayam',37,1),(1293,'Kurumbapalayam',37,1),(1294,'Makkinampatty',37,1),(1295,'Mannur',37,1),(1296,'Mulanur',37,1),(1297,'Nallampalayam',37,1),(1298,'Nallathukuzhuli',37,1),(1299,'Nattukalpalayam',37,1),(1300,'Okkulipalayam',37,1),(1301,'Oonjavelampatty',37,1),(1302,'PeriyaNegamam',37,1),(1303,'Pollachi',37,1),(1304,'Polygoundampalayam',37,1),(1305,'Poosanaickenthali',37,1),(1306,'Appanaikenpatty',38,1),(1307,'Arasur',38,1),(1308,'Bogampatty',38,1),(1309,'Idayapalayam',38,1),(1310,'Irugur',38,1),(1311,'J.krisnapuram',38,1),(1312,'Jallipatty',38,1),(1313,'Kadampadi',38,1),(1314,'Kaduvettipalayam',38,1),(1315,'Kallapalayam',38,1),(1316,'Kallengal',38,1),(1317,'Kammalapatty',38,1),(1318,'Kangayampalayam',38,1),(1319,'Kaniyur',38,1),(1320,'Kannampalayam',38,1),(1321,'Karavazhimadampoor',38,1),(1322,'Karumathampatty',38,1),(1323,'Kittampalayam',38,1),(1324,'Kumarapalayam',38,1),(1325,'Malaipalayam',38,1),(1326,'Moppiripalayam',38,1),(1327,'Mylampatty',38,1),(1328,'Neelambur',38,1),(1329,'Otterpalayam',38,1),(1330,'Pachapalayam',38,1),(1331,'Paduvampalli',38,1),(1332,'Pappampatty',38,1),(1333,'Pattanam',38,1),(1334,'Peedampalli',38,1),(1335,'Poorandampalayam',38,1),(1336,'Rasipalayam',38,1),(1337,'S.ayyampalayam',38,1),(1338,'selakkarichel',38,1),(1339,'semmandampalayam',38,1),(1340,'Sencheripudur',38,1),(1341,'Sulur',38,1),(1342,'Thalakari',38,1),(1343,'Vadambacheri',38,1),(1344,'Vadavalli',38,1),(1345,'Vadavedampatty',38,1),(1346,'Varapatty',38,1),(1347,'Anamalai kundrugal',39,1),(1348,'Agaraalambadi',40,1),(1349,'Agarram',40,1),(1350,'Alamrlumangapuraam',40,1),(1351,'Ambapuram',40,1),(1352,'anaivari',40,1),(1353,'Ariyakozhiit',40,1),(1354,'Ayeepuram',40,1),(1355,'Azhichikudi',40,1),(1356,'B.Arunmozhidevan',40,1),(1357,'B.athivarrahanallur',40,1),(1358,'B.kolakudi',40,1),(1359,'B.mutlur',40,1),(1360,'B.sitheri',40,1),(1361,'B.udaiyur',40,1),(1362,'Boothavarayaanpetttai',40,1),(1363,'C mutlur',40,1),(1364,'Chinnakumatti',40,1),(1365,'Chockkankollai',40,1),(1366,'Ellakudi',40,1),(1367,'Erumbur',40,1),(1368,'Jayankondan',40,1),(1369,'Kaspa Alambadi',40,1),(1370,'Kathazhai',40,1),(1371,'KeelBhuvanagiri',40,1),(1372,'Keezhamanakudi',40,1),(1373,'Kilavaddi Natham',40,1),(1374,'Kothattai',40,1),(1375,'Kumudimulai',40,1),(1376,'Kuriyamangalam',40,1),(1377,'Manikollai',40,1),(1378,'ManjakollaiManjakuzhi',40,1),(1379,'Marudur',40,1),(1380,'MelBhuvanagiri',40,1),(1381,'Melamanakudi',40,1),(1382,'Merralur',40,1),(1383,'Nathamedu',40,1),(1384,'Nellikollai',40,1),(1385,'Palvathunnan',40,1),(1386,'Parangipettai',40,1),(1387,'Periyakumatti',40,1),(1388,'Periyanarkunam',40,1),(1389,'Periyapattu',40,1),(1390,'Pinnalur',40,1),(1391,'Poovalai (east and west)',40,1),(1392,'Poovalai (west)',40,1),(1393,'Prasaannaramapuram',40,1),(1394,'Sathappadi',40,1),(1395,'Seeyapadi',40,1),(1396,'Senthirakillai',40,1),(1397,'Senthiyathoppu',40,1),(1398,'Silambimangalam',40,1),(1399,'Sinnanarkunam',40,1),(1400,'Suthukuzhi',40,1),(1401,'Thatchakkadu',40,1),(1402,'Thenkrishnapuram',40,1),(1403,'Thenthalaikulam',40,1),(1404,'Therkuthittai',40,1),(1405,'Thurnjikollai',40,1),(1406,'Uluthur',40,1),(1407,'Vadakrishnapuram',40,1),(1408,'vadakuthitttai',40,1),(1409,'vadathalaikulam',40,1),(1410,'Valayamadevi (kil)',40,1),(1411,'Valayamadevi (mel)',40,1),(1412,'Vandurayanpattu',40,1),(1413,'Vatharayanththu',40,1),(1414,'Vayalamoor',40,1),(1415,'Veeramudaiyanatham',40,1),(1416,'Velangipattu',40,1),(1417,'Villiyanallur',40,1),(1418,'A.Puliankudi',41,1),(1419,'Adoor (s and n)',41,1),(1420,'Agaranallur',41,1),(1421,'ambigapuram',41,1),(1422,'Ayeepattai',41,1),(1423,'Ayyanur Akkaamangalam',41,1),(1424,'B. maduvankarai',41,1),(1425,'Boothankudi',41,1),(1426,'C Kothangudi',41,1),(1427,'C veerasozhgan west',41,1),(1428,'c.manambadi',41,1),(1429,'C.melavanniyur',41,1),(1430,'C.sathamangalam',41,1),(1431,'C.Thandeeswaranallur',41,1),(1432,'C.Vakkaramari',41,1),(1433,'Chettimuttu',41,1),(1434,'Chidambaram Municipal',41,1),(1435,'Chidambaran N M',41,1),(1436,'Chidambaranathanpettai',41,1),(1437,'Dhevankudi',41,1),(1438,'Edayanpalcchori',41,1),(1439,'Elanangur',41,1),(1440,'Ennagaram',41,1),(1441,'Erukkankattupadugai',41,1),(1442,'Esanai',41,1),(1443,'Janyankondapattinam',41,1),(1444,'K adoor south',41,1),(1445,'Kadavachery',41,1),(1446,'Kanakkarapattu',41,1),(1447,'Kannangudi',41,1),(1448,'Kattukudalur',41,1),(1449,'Kavarapattu',41,1),(1450,'Keerapalayam',41,1),(1451,'Keezanuvampattu',41,1),(1452,'Keezhakundalapadi',41,1),(1453,'Keezhamoongiladi',41,1),(1454,'Keezhaperambai',41,1),(1455,'Keezhathirukazhipalai',41,1),(1456,'Keezhnatham',41,1),(1457,'Kiliyanur',41,1),(1458,'Killai (north and south)',41,1),(1459,'Killai south',41,1),(1460,'Kodipallam',41,1),(1461,'KodiyLm',41,1),(1462,'Koolapadi',41,1),(1463,'Koothangoil',41,1),(1464,'Koovilampoondi',41,1),(1465,'Kumaramangalam',41,1),(1466,'Lalpuram',41,1),(1467,'Manakudiyanirruppu',41,1),(1468,'Mathurranthaganallur',41,1),(1469,'Meethikudi',41,1),(1470,'Melachokknathanpettai',41,1),(1471,'Melamoongiladi',41,1),(1472,'Melanuvampattu',41,1),(1473,'Melathirukazhipalai',41,1),(1474,'Mugaiyur',41,1),(1475,'Nakkaravanthankudi',41,1),(1476,'Nanjaimahathuvazhkkai west',41,1),(1477,'Nanjaimahathuvazhkkai (e-w)',41,1),(1478,'Nanjalur',41,1),(1479,'Odakkanallur',41,1),(1480,'Orathur',41,1),(1481,'Palayanserndagudi',41,1),(1482,'Pallipadai',41,1),(1483,'Paluthangarai',41,1),(1484,'Pannapattu',41,1),(1485,'Parameswaranallur',41,1),(1486,'Parathur (north)',41,1),(1487,'Parathur (south0',41,1),(1488,'Perampattu',41,1),(1489,'Perungalur',41,1),(1490,'Petttai',41,1),(1491,'Pichavaram',41,1),(1492,'Pinnathur east',41,1),(1493,'Pinnathur west',41,1),(1494,'Poolamedu',41,1),(1495,'Poongudi',41,1),(1496,'Poonthottam',41,1),(1497,'Punjaimagathuvazhkai',41,1),(1498,'Radhavilagam',41,1),(1499,'Sakkangudi',41,1),(1500,'Saliyanthoppu',41,1),(1501,'Sengalmedu',41,1),(1502,'Sethiyur',41,1),(1503,'Sirukalur',41,1),(1504,'Sithalapaddi',41,1),(1505,'Sivapurri',41,1),(1506,'Sivayam',41,1),(1507,'T.madaappuram (south)',41,1),(1508,'T.manalur',41,1),(1509,'T.neduncherry',41,1),(1510,'thandavarayancholaganpettai',41,1),(1511,'Tharasur',41,1),(1512,'Thathampettai',41,1),(1513,'Thavarrthampattu',41,1),(1514,'Thenharirajapuram',41,1),(1515,'Therkku Viruthangan',41,1),(1516,'Thillainayagapuram',41,1),(1517,'Thillaividangan south',41,1),(1518,'Thillaividangan north',41,1),(1519,'Thirupaninatham',41,1),(1520,'Thiruvakulam',41,1),(1521,'Thunisiramedu',41,1),(1522,'Usuppur',41,1),(1523,'Uthamachozhamangalam',41,1),(1524,'Vadaharirajapuram',41,1),(1525,'Vadakku Viruthangan',41,1),(1526,'Vaddaapakkam',41,1),(1527,'Vaiyur',41,1),(1528,'Vakkur',41,1),(1529,'Vallampadugai',41,1),(1530,'Varakur',41,1),(1531,'Vasaputhur',41,1),(1532,'Vayalur',41,1),(1533,'Vazhakollai',41,1),(1534,'Veerasozhgan',41,1),(1535,'Veiyalur',41,1),(1536,'Velliyagudi',41,1),(1537,'Vilakam',41,1),(1538,'Alappakkam',42,1),(1539,'Andarmullippallam',42,1),(1540,'Annavalli',42,1),(1541,'Arisiperiyankuppam',42,1),(1542,'Azhakinatham',42,1),(1543,'C.n palayam',42,1),(1544,'Cellankuppam',42,1),(1545,'Chinnakanganagkuppam',42,1),(1546,'Cuddalore O.t',42,1),(1547,'Devanampattinam',42,1),(1548,'Erandayaramvilagam',42,1),(1549,'Gangamanayakankuppam',42,1),(1550,'Gothandaramaapuram',42,1),(1551,'Gunduppalavadi',42,1),(1552,'Lalaiyur',42,1),(1553,'Kampalimedu',42,1),(1554,'Karaikadu',42,1),(1555,'Karaimedu',42,1),(1556,'karaiyaravitakuppam',42,1),(1557,'Karamanikuppam',42,1),(1558,'Karanapatu',42,1),(1559,'Karupadithundu',42,1),(1560,'Kayalpattu',42,1),(1561,'Keezhazhinjipattu',42,1),(1562,'Keezhkumarramangalam',42,1),(1563,'Kilingikuppam',42,1),(1564,'Kondur',42,1),(1565,'Koothapakkam',42,1),(1566,'Kudikadu',42,1),(1567,'Kumarapettai',42,1),(1568,'Kunamangalam',42,1),(1569,'Maavadipalayam',42,1),(1570,'Malaiperumalagaram',42,1),(1571,'Manjakuppam',42,1),(1572,'Marudhadu',42,1),(1573,'Mathalapattu',42,1),(1574,'Melakuppam',42,1),(1575,'Melazhinchipattu',42,1),(1576,'Nadduveerapattu',42,1),(1577,'Nakappanur',42,1),(1578,'Nallathur',42,1),(1579,'Nathapattu',42,1),(1580,'Odalapattu',42,1),(1581,'Ottari',42,1),(1582,'Pachayakuppam',42,1),(1583,'Pallipattu',42,1),(1584,'Pathirikuppam',42,1),(1585,'Periyakanganakuppam',42,1),(1586,'Pillali',42,1),(1587,'Poniyangkuppam',42,1),(1588,'Pudhukkadai',42,1),(1589,'Ramapuram',42,1),(1590,'Sedapalayam',42,1),(1591,'Sellancheri',42,1),(1592,'Sembankuppam',42,1),(1593,'Senjikumarapuram',42,1),(1594,'Singirikudi',42,1),(1595,'Subauppalavadi',42,1),(1596,'Thennam Pakkam',42,1),(1597,'Thiruchopuram',42,1),(1598,'Thirumanikuzhi',42,1),(1599,'Thirupanambakkam',42,1),(1600,'Thiruppapuliyur',42,1),(1601,'Thiruvandhipuram',42,1),(1602,'Thiyagavalli',42,1),(1603,'Thondamanatham',42,1),(1604,'Thookkanampakkam',42,1),(1605,'Thottappattu',42,1),(1606,'Uchimedu',42,1),(1607,'Udharamanikkam',42,1),(1608,'Ullaripattu',42,1),(1609,'Vadapuram Keezpathi',42,1),(1610,'Vanamadevi north',42,1),(1611,'Vanamadevi south',42,1),(1612,'Vanniyar palayam',42,1),(1613,'Varakalpattu',42,1),(1614,'Velisemmandalam',42,1),(1615,'Vellakarai',42,1),(1616,'Vellappakkam',42,1),(1617,'Vettukulam',42,1),(1618,'Vilangalpattu',42,1),(1619,'Vilvarayanatham',42,1),(1620,'Achalpuram',43,1),(1621,'Agaraputhur',43,1),(1622,'Alangathan',43,1),(1623,'Alinjimangalam',43,1),(1624,'Athippattu',43,1),(1625,'Atkondanatham',43,1),(1626,'Ayangudi',43,1),(1627,'C.arasur',43,1),(1628,'Chettikattalai',43,1),(1629,'Chettithangal',43,1),(1630,'Eachampoondi',43,1),(1631,'Edaiyar',43,1),(1632,'Elankambur',43,1),(1633,'Elleri (east)',43,1),(1634,'Elleri(west)',43,1),(1635,'Eyyalore',43,1),(1636,'Gunavasal',43,1),(1637,'Kalikadanthan',43,1),(1638,'Kaliyamalai',43,1),(1639,'Kalnattampuliyur',43,1),(1640,'Kandakumaran',43,1),(1641,'Kanjankollaii',43,1),(1642,'Kanjivai',43,1),(1643,'Karunakaranallur',43,1),(1644,'Karuppur',43,1),(1645,'Keelakadambur',43,1),(1646,'Keezhadhankudi',43,1),(1647,'Keezhakkarai',43,1),(1648,'Keezhaparuthikudi',43,1),(1649,'Keezhavanniyur',43,1),(1650,'Keezhnedumbur',43,1),(1651,'Keezhpuliyampattu',43,1),(1652,'Keezhradhamur',43,1),(1653,'Koilpathu',43,1),(1654,'Kollimalai Keezhpathi',43,1),(1655,'Kollimalai Melpathi',43,1),(1656,'Kondasamuthiram',43,1),(1657,'Kooduveli',43,1),(1658,'Koothur',43,1),(1659,'Kottavasal',43,1),(1660,'Kuchur',43,1),(1661,'Kumaratchi (east)',43,1),(1662,'Kumaratchi (west)',43,1),(1663,'Kunjamedu',43,1),(1664,'Kuppankuzhi Poovizhanthanallur',43,1),(1665,'Kuppapillichavadi',43,1),(1666,'Kurungudi',43,1),(1667,'Lakshmikudi',43,1),(1668,'Lalpettai',43,1),(1669,'M.adhanur',43,1),(1670,'Ma.Kotthangudi',43,1),(1671,'Ma.araasur',43,1),(1672,'Ma.puliyangudi',43,1),(1673,'Ma.udaiyur',43,1),(1674,'Maaniya Aadoor',43,1),(1675,'Mamangalam',43,1),(1676,'Mannar Kulakkudi',43,1),(1677,'Mannargudi',43,1),(1678,'Mathar Soodaamani',43,1),(1679,'Melakadambur',43,1),(1680,'Melaparuthikkudi',43,1),(1681,'Melavanniyur',43,1),(1682,'Melnedumbur',43,1),(1683,'Melpakkathurai',43,1),(1684,'Melradhamur',43,1),(1685,'Meyyathur',43,1),(1686,'Movur(south)',43,1),(1687,'Movur((north)',43,1),(1688,'Mullangudi',43,1),(1689,'Muttam',43,1),(1690,'Naduthittu',43,1),(1691,'Nalamputhur',43,1),(1692,'Nandhimangalam',43,1),(1693,'Nathamalai',43,1),(1694,'Nattarmangalam',43,1),(1695,'Neivasal',43,1),(1696,'Oblanjimedu',43,1),(1697,'Omampuliyur',43,1),(1698,'Palvaikandan',43,1),(1699,'Parivilagam',43,1),(1700,'Pazhanjanallur',43,1),(1701,'Periyakottagam',43,1),(1702,'Pillaiyarthangal',43,1),(1703,'Poorthangudi',43,1),(1704,'Radhanallur',43,1),(1705,'Rajendrachozhagam',43,1),(1706,'Raayanallur',43,1),(1707,'Reddiyur',43,1),(1708,'Sarvarajanpettai',43,1),(1709,'Shandan',43,1),(1710,'Sholakkur',43,1),(1711,'Sirukattur',43,1),(1712,'Sithamalli',43,1),(1713,'Sivakkam',43,1),(1714,'Suravizhandur',43,1),(1715,'T.arulmozhidevan',43,1),(1716,'T.puthur',43,1),(1717,'Themmur',43,1),(1718,'Therkumangudi',43,1),(1719,'Thiruchinnpuram',43,1),(1720,'Thirunaraiyur',43,1),(1721,'Thondamanatham',43,1),(1722,'Thorappu',43,1),(1723,'Thurakozhi',43,1),(1724,'Udaiyargudi',43,1),(1725,'Uthamachozhagan',43,1),(1726,'Vadakku Kolakkudi',43,1),(1727,'Vadakkumangudi',43,1),(1728,'Vadamur',43,1),(1729,'Vanamadevi',43,1),(1730,'Vanathirayanpettai',43,1),(1731,'Veerachozhapuram',43,1),(1732,'Veerananallur',43,1),(1733,'Veeranadhapuram',43,1),(1734,'Veeranatham',43,1),(1735,'Velapoondi',43,1),(1736,'Vellur',43,1),(1737,'Vennaiyur',43,1),(1738,'Vetchiyur',43,1),(1739,'Vilathur Thirupaniyapurm',43,1),(1740,'Vouvalthoppu',43,1),(1741,'Aadur Agaram',44,1),(1742,'Abatharanapuram',44,1),(1743,'Adinarayanapuram (east)',44,1),(1744,'Adinarayanapuram (west)',44,1),(1745,'Adurkuppam',44,1),(1746,'Agaram East',44,1),(1747,'Agaram West',44,1),(1748,'Akkatthimapuram',44,1),(1749,'Ambalavanampettai',44,1),(1750,'Annathanapettai',44,1),(1751,'Anukampattu',44,1),(1752,'Arangamangalam',44,1),(1753,'Athipattu (neyveli Ts)',44,1),(1754,'Ayekuppam',44,1),(1755,'Boothampadi',44,1),(1756,'Edangondampattu',44,1),(1757,'Elavarasampattu (neyveli Ts)',44,1),(1758,'Ellappenpettai',44,1),(1759,'Kalkunam',44,1),(1760,'Kanchamanathapuram',44,1),(1761,'Kanjamanathanpettai',44,1),(1762,'Kannady',44,1),(1763,'Karunkuzhi',44,1),(1764,'Karuveppampadi',44,1),(1765,'Keezhur',44,1),(1766,'Kesavanarayanapuram',44,1),(1767,'Kolakudi',44,1),(1768,'Kooraiyapettai (neyveli Ts)',44,1),(1769,'Koranapattu',44,1),(1770,'Kothavachery',44,1),(1771,'Krishnagkuppam',44,1),(1772,'Kundiamallur North',44,1),(1773,'Kundiamallur South',44,1),(1774,'Kurinjipadi North',44,1),(1775,'Kurinjipadi south',44,1),(1776,'Kuruvappanpettai',44,1),(1777,'Madhanagopalapuram',44,1),(1778,'Maruvai',44,1),(1779,'Melappudhupettai',44,1),(1780,'Nainarkuppam',44,1),(1781,'Parvathipuram',44,1),(1782,'Peramathur (neyveli Ts)',44,1),(1783,'Pethanayakkankuppam',44,1),(1784,'Peykkanatham',44,1),(1785,'Puliyur (east)',44,1),(1786,'Puliyur (West)',44,1),(1787,'Puvanikuppam north',44,1),(1788,'Puvanikuppam south',44,1),(1789,'Pyirvelivellaiankuppam',44,1),(1790,'Renganathapuram',44,1),(1791,'Rasakuppam',44,1),(1792,'Serakuppam',44,1),(1793,'Sirupalaiyr North',44,1),(1794,'Sirupalaiyr South',44,1),(1795,'T.palayam',44,1),(1796,'Thaiyalkunam Patinam',44,1),(1797,'Thambipettai',44,1),(1798,'Thanur',44,1),(1799,'Theerthanagiri',44,1),(1800,'Thenkuthu (neyveli Ts)',44,1),(1801,'Therkkumelur(neyveli Ts)',44,1),(1802,'Thimmaravuthankuppam',44,1),(1803,'Thoppukollai',44,1),(1804,'Vadakkumelur(neyveli Ts)',44,1),(1805,'Vadakuthu',44,1),(1806,'Vanathirayapuram (neyveli Ts)',44,1),(1807,'Vazhudhalampattu',44,1),(1808,'Velankulam(neyveli Ts)',44,1),(1809,'Veludiyanpattu (neyveli Ts)',44,1),(1810,'Vengadampettai',44,1),(1811,'Viruppatchi',44,1),(1812,'Akkadavalli',45,1),(1813,'Alagaperummal Kuppam',45,1),(1814,'andikkuppam',45,1),(1815,'Anguchettypalayam',45,1),(1816,'Ariirundhamangalam',45,1),(1817,'Aviyanur',45,1),(1818,'Azhagappa Samuthiram',45,1),(1819,'Chozhavalli',45,1),(1820,'Eithanur',45,1),(1821,'Elanthampattu',45,1),(1822,'Enathirimangalam',45,1),(1823,'Ezhumedu',45,1),(1824,'Kadampuliyur',45,1),(1825,'Kandarakottai',45,1),(1826,'Kanisapakkam',45,1),(1827,'Karukkai',45,1),(1828,'Karumbur',45,1),(1829,'Kattu Kudalore',45,1),(1830,'Kavanur',45,1),(1831,'Kayapakkam',45,1),(1832,'Keelkuppam',45,1),(1833,'Keelmampattu',45,1),(1834,'Keezharunggunam',45,1),(1835,'Keezhkangeyankuppam',45,1),(1836,'Keezhkavarapattu',45,1),(1837,'Keezhpathi',45,1),(1838,'Kezhiruppu',45,1),(1839,'Kizhpattampakkam',45,1),(1840,'Kolapakkam',45,1),(1841,'Kongarayanur',45,1),(1842,'Korathi',45,1),(1843,'Kotlambakkam',45,1),(1844,'Kozhipakkam',45,1),(1845,'Kudithangi',45,1),(1846,'Lakshminarayanapuram',45,1),(1847,'Maligaimedu',45,1),(1848,'Maligampattu',45,1),(1849,'Manamthauizhnthaputhur',45,1),(1850,'Manapakkam',45,1),(1851,'marungur',45,1),(1852,'Melarungunam',45,1),(1853,'Meliruppu',45,1),(1854,'Melkangeyankuppam',45,1),(1855,'Melkavarapattu',45,1),(1856,'Melkumaramangalam (north)',45,1),(1857,'Melkumaramangalam (south)',45,1),(1858,'Melmampattu',45,1),(1859,'Melpathi',45,1),(1860,'Melpattampakkam',45,1),(1861,'Mulligrampattu',45,1),(1862,'Nadukuppam',45,1),(1863,'Natham',45,1),(1864,'Nellikuppam',45,1),(1865,'Oraiyur',45,1),(1866,'Pagandai',45,1),(1867,'paithambadi',45,1),(1868,'Palapattu',45,1),(1869,'Pallavarayanatham',45,1),(1870,'Palur',45,1),(1871,'Panapakkam',45,1),(1872,'Pandrakottai',45,1),(1873,'Panikkankuppam',45,1),(1874,'Panruti',45,1),(1875,'Perperiyankuppam',45,1),(1876,'Perumalnayakkanpalayam',45,1),(1877,'Poondi',45,1),(1878,'Poongunam',45,1),(1879,'Pulavanur',45,1),(1880,'Purangani',45,1),(1881,'Rayarpalayam',45,1),(1882,'Sanniyasipettai',45,1),(1883,'Sathipattu',45,1),(1884,'Semakottai',45,1),(1885,'Semmedu',45,1),(1886,'Silambinathan Pettai',45,1),(1887,'Sirugramam',45,1),(1888,'Sirunangaivadi',45,1),(1889,'Siruvathur',45,1),(1890,'Sitharasur',45,1),(1891,'Sorathur',45,1),(1892,'Sundaravandi',45,1),(1893,'Thazhampattu',45,1),(1894,'Thirasu',45,1),(1895,'Thirukandesvaram',45,1),(1896,'Thiruthuraiyur',45,1),(1897,'Thiruvadhigai',45,1),(1898,'Thiruvamur',45,1),(1899,'Thorapadi',45,1),(1900,'Ulundampattu',45,1),(1901,'Vadakailaasam',45,1),(1902,'Vaidapakkam',45,1),(1903,'Vallam',45,1),(1904,'Vanpaakkam',45,1),(1905,'Varingippakkam',45,1),(1906,'Veerapperumanallur',45,1),(1907,'Veerasingankuppam',45,1),(1908,'Vegakollai',45,1),(1909,'Visur',45,1),(1910,'Vizhamangalam',45,1),(1911,'Adivaraganallur',46,1),(1912,'Anandhankudi',46,1),(1913,'Ayankeelpuliyangudi',46,1),(1914,'C.keeranur',46,1),(1915,'Devankudi',46,1),(1916,'Gunamangalam',46,1),(1917,'Kallippadi',46,1),(1918,'Kanur',46,1),(1919,'Karmankudi',46,1),(1920,'Kavalakkudi',46,1),(1921,'Kavanur',46,1),(1922,'Keelpuliyangudi',46,1),(1923,'Keeramangalam',46,1),(1924,'Keezhapalaiyur',46,1),(1925,'Kodhandavilagam',46,1),(1926,'Kodumanur',46,1),(1927,'Kokkarasanpettai',46,1),(1928,'Kozhai',46,1),(1929,'Kudalaiyathur',46,1),(1930,'Kumaragudi',46,1),(1931,'Kurunjigudi',46,1),(1932,'Marungur',46,1),(1933,'Mathakalirmanickam',46,1),(1934,'Mazhavarayanallur',46,1),(1935,'Melapalaiyur',46,1),(1936,'Melpuliyangudi',46,1),(1937,'Mudikandanallur',46,1),(1938,'Nagarappadi',46,1),(1939,'Nangudi',46,1),(1940,'Nantheeswaramangalam',46,1),(1941,'Palaiyankottai melpathi',46,1),(1942,'Palaiyamkottai keelpathi',46,1),(1943,'Perur',46,1),(1944,'Pudaiyur',46,1),(1945,'Ramapuram',46,1),(1946,'Sakaramangalam',46,1),(1947,'Sathavattam',46,1),(1948,'Solatharam',46,1),(1949,'Sri Sathamangala',46,1),(1950,'Srimushnam',46,1),(1951,'Srinedunjeri',46,1),(1952,'Sriputhur',46,1),(1953,'T.pavalangudi',46,1),(1954,'Thethampattu',46,1),(1955,'Thorankuppam',46,1),(1956,'Thozhur',46,1),(1957,'Vadakkupaalayam',46,1),(1958,'Vakkaramari',46,1),(1959,'Valasakkadu',46,1),(1960,'Valliyam',46,1),(1961,'Vattathur',46,1),(1962,'A.agaram',47,1),(1963,'Aakkanur',47,1),(1964,'Aavinangudi',47,1),(1965,'Adhamangalam',47,1),(1966,'Alampadi',47,1),(1967,'Alathur',47,1),(1968,'Arangur',47,1),(1969,'Ariyaravi',47,1),(1970,'Arugeri',47,1),(1971,'Atharnatham',47,1),(1972,'Avatti',47,1),(1973,'Elamangalam',47,1),(1974,'eraiyur',47,1),(1975,'Erappavur',47,1),(1976,'Ezhumathur',47,1),(1977,'Ezhuthur',47,1),(1978,'Idaicheruhuvai',47,1),(1979,'Irulampattu',47,1),(1980,'Ivanoor',47,1),(1981,'Kalloor',47,1),(1982,'Kanagampadi',47,1),(1983,'Kandamandhan',47,1),(1984,'Karaiyur',47,1),(1985,'Kazhudhoor',47,1),(1986,'Keeranoor',47,1),(1987,'KeezhCheruvaai',47,1),(1988,'Keezh Nemili',47,1),(1989,'Keezhakalpoondi',47,1),(1990,'Keezhathanur',47,1),(1991,'Kilimangalam',47,1),(1992,'Kodangudi',47,1),(1993,'Kodikalam',47,1),(1994,'Konur',47,1),(1995,'Korakkai',47,1),(1996,'Korakkavadi',47,1),(1997,'Kosapalam',47,1),(1998,'Kothattai',47,1),(1999,'Kovilur',47,1),(2000,'Kozhiyoor',47,1),(2001,'Kudalur',47,1),(2002,'Kumarai',47,1),(2003,'Kurukkathancheri',47,1),(2004,'Lakkur',47,1),(2005,'Latchumanapuram',47,1),(2006,'m.podayur',47,1),(2007,'Mduravalli',47,1),(2008,'Maligaikottam',47,1),(2009,'Maruthathur',47,1),(2010,'Mel Aathanur',47,1),(2011,'Melakalpoondi',47,1),(2012,'Melnemili',47,1),(2013,'Melur',47,1),(2014,'Mosattai',47,1),(2015,'Murugankudi',47,1),(2016,'Nangur',47,1),(2017,'Nanthimangalam',47,1),(2018,'Narasingamangalam',47,1),(2019,'Navaloor',47,1),(2020,'Nedungulam',47,1),(2021,'Neivasal',47,1),(2022,'Nidhinatham',47,1),(2023,'O.keeranuur',47,1),(2024,'P.kollathangkurichi',47,1),(2025,'Panaiyanthur',47,1),(2026,'Pasaar',47,1),(2027,'Pattakurichi',47,1),(2028,'Pattur',47,1),(2029,'Pe.Poonneri',47,1),(2030,'Po.Poovanur',47,1),(2031,'Pelanthurai',47,1),(2032,'Pennadam',47,1),(2033,'Perangiyam',47,1),(2034,'Perumulai',47,1),(2035,'Pothiramangalam (east)',47,1),(2036,'Pothiramangalam (west)',47,1),(2037,'Pudukkulam',47,1),(2038,'Puligarambalur',47,1),(2039,'Pulivalam',47,1),(2040,'Pullur',47,1),(2041,'Putheri',47,1),(2042,'Ramanatham',47,1),(2043,'Sevur',47,1),(2044,'Sevveri',47,1),(2045,'Sirukarambalur',47,1),(2046,'Sirumangalam',47,1),(2047,'Sirumulai',47,1),(2048,'Soundrasolapuram',47,1),(2049,'T.eanthaal',47,1),(2050,'Thachur',47,1),(2051,'Thazhanallur',47,1),(2052,'Theevalur',47,1),(2053,'Thirumalai Agaram',47,1),(2054,'Thiruvattathurai',47,1),(2055,'Thittakudi',47,1),(2056,'Tholar (north)',47,1),(2057,'Tholar (south)',47,1),(2058,'Thondankuruchi',47,1),(2059,'Thozhuthur',47,1),(2060,'Thuraiyoor',47,1),(2061,'V.sithur',47,1),(2062,'Vadakarai',47,1),(2063,'Vadakarampoondi',47,1),(2064,'Vaithiyanathapuram',47,1),(2065,'Vaiyangudi',47,1),(2066,'Vakaiyoor',47,1),(2067,'Vallimathuram',47,1),(2068,'Vathistapuram',47,1),(2069,'Venganuur',47,1),(2070,'Venkarampur',47,1),(2071,'A.chittur',48,1),(2072,'A.kolappakkam',48,1),(2073,'A.marur',48,1),(2074,'Aathiyur',48,1),(2075,'Addari',48,1),(2076,'Arasankudi',48,1),(2077,'Elangiyanur',48,1),(2078,'Ivadukudi',48,1),(2079,'Ja.endal',48,1),(2080,'Kalathur',48,1),(2081,'Kaliyamedu',48,1),(2082,'Kanjirankulam',48,1),(2083,'Katchimayilur',48,1),(2084,'Kattumailur',48,1),(2085,'Keelakurichi',48,1),(2086,'KeezhOrathur',48,1),(2087,'Ko.Kodhanur',48,1),(2088,'Kolavai',48,1),(2089,'M.kothanur',48,1),(2090,'Ma.puthur',48,1),(2091,'Malaiyanur',48,1),(2092,'Maligaimedu',48,1),(2093,'Mangalam Ko',48,1),(2094,'Mangalur',48,1),(2095,'Mannambadi',48,1),(2096,'Me.mathur',48,1),(2097,'Meelakurichi',48,1),(2098,'N.naraiyur',48,1),(2099,'Nagar',48,1),(2100,'Nallur',48,1),(2101,'narayur',48,1),(2102,'Neramani',48,1),(2103,'Orangur',48,1),(2104,'Pa.kodhanur',48,1),(2105,'Periyanesalur',48,1),(2106,'Pinjanur',48,1),(2107,'Poolampadi',48,1),(2108,'Poyinappadi',48,1),(2109,'pudaiyur(devasthanam)',48,1),(2110,'Rettakurichi',48,1),(2111,'Sathiyam',48,1),(2112,'Seppakkam',48,1),(2113,'Sethuvarayankuppam',48,1),(2114,'Sirunesalur',48,1),(2115,'Sirupakkam',48,1),(2116,'Sitheri',48,1),(2117,'Thirupaiyar',48,1),(2118,'Vadapathi',48,1),(2119,'Valasai',48,1),(2120,'Vannathur',48,1),(2121,'Varambanur',48,1),(2122,'Veppur',48,1),(2123,'Vinayakanandal',48,1),(2124,'AadhandaarKollai',49,1),(2125,'Aaladi',49,1),(2126,'Aalichikudi',49,1),(2127,'Agaram (uthangal)',49,1),(2128,'Alanduraipattu',49,1),(2129,'Ammeri',49,1),(2130,'Arasakuzhi',49,1),(2131,'Azisnagar',49,1),(2132,'Boothamur',49,1),(2133,'Chinnakapankulam',49,1),(2134,'Chinnapandarankuppam',49,1),(2135,'Chinnaparur',49,1),(2136,'Chinnathukkurichi',49,1),(2137,'Chinnavadavadi',49,1),(2138,'Chitherikuppam',49,1),(2139,'Dharmanallur',49,1),(2140,'Edachittur',49,1),(2141,'Edaiyur',49,1),(2142,'Enadhimedu',49,1),(2143,'Erumanur',49,1),(2144,'Gangaikondan',49,1),(2145,'Gopalapuram',49,1),(2146,'Gopurapuram',49,1),(2147,'Irulakurichi',49,1),(2148,'Iruppu',49,1),(2149,'Irusalakuppam',49,1),(2150,'Ka.elamangallam',49,1),(2151,'Ka.puttur',49,1),(2152,'Kachiperumanatham',49,1),(2153,'Kachirayanatham',49,1),(2154,'Kammapuram',49,1),(2155,'Kanathukandan',49,1),(2156,'Kandiyankuppam',49,1),(2157,'Karrkudal',49,1),(2158,'Karnatham',49,1),(2159,'Karuvepilakurichi',49,1),(2160,'Kattiyanallur',49,1),(2161,'Kattuparur',49,1),(2162,'Kavanai',49,1),(2163,'Keelpathi',49,1),(2164,'Keerambur',49,1),(2165,'Ko.Boovaanur',49,1),(2166,'Ko.aathanur',49,1),(2167,'ko.mavidhandal',49,1),(2168,'Ko.ponneri',49,1),(2169,'Kodukur',49,1),(2170,'Kolirupu',49,1),(2171,'Komangalam',49,1),(2172,'Kottagam',49,1),(2173,'Kotteri',49,1),(2174,'Kottumulai',49,1),(2175,'Kovilanur',49,1),(2176,'Kovilkuppam',49,1),(2177,'Kumaramangalam',49,1),(2178,'Kunankuruchi',49,1),(2179,'Kuppanatham',49,1),(2180,'M.agaram',49,1),(2181,'M.parur',49,1),(2182,'Managathi',49,1),(2183,'Manakollai',49,1),(2184,'Manalur (T)',49,1),(2185,'Manavalanallur',49,1),(2186,'Mangalam',49,1),(2187,'Mathur',49,1),(2188,'Melpappanapattu',49,1),(2189,'Melpathi',49,1),(2190,'Mudapulli',49,1),(2191,'Mudhanai',49,1),(2192,'Mugundhanallur',49,1),(2193,'Mummudiccholagan',49,1),(2194,'Nachiyarpettai',49,1),(2195,'Nadiyapattu',49,1),(2196,'Narumanam',49,1),(2197,'Nemam',49,1),(2198,'Neyveli',49,1),(2199,'Ottimedu',49,1),(2200,'Padukalanatham',49,1),(2201,'Palakollai',49,1),(2202,'Pallipattu',49,1),(2203,'Paravalur',49,1),(2204,'Pavazhangudi (Ko)',49,1),(2205,'Pazhayapattinum',49,1),(2206,'Peralaiyu',49,1),(2207,'Perampalur',49,1),(2208,'Periyakurichi',49,1),(2209,'Periyavadavadi',49,1),(2210,'Periyakapankulam',49,1),(2211,'Perundurai',49,1),(2212,'Peruvarapur',49,1),(2213,'Poonthottam',49,1),(2214,'Pu.kollathankurichi',49,1),(2215,'Pudhukoraipettai',49,1),(2216,'Puliyur',49,1),(2217,'Rajendirapattanam',49,1),(2218,'Ropanarayananallur',49,1),(2219,'Sathukkudal (kelpathi)',49,1),(2220,'Sathukkudal (melpathi)',49,1),(2221,'Sathamangalam',49,1),(2222,'Sathapadi',49,1),(2223,'Sathiyavadi',49,1),(2224,'Sembalakurichi',49,1),(2225,'Sepalanatham',49,1),(2226,'Siruvambar',49,1),(2227,'Siruvarapur',49,1),(2228,'Sotttavanam',49,1),(2229,'Su.keenanur',49,1),(2230,'T.Mavidhandal',49,1),(2231,'Therrkku vadakku Puthur',49,1),(2232,'Thoravalur',49,1),(2233,'U.aathanur',49,1),(2234,'U.kolapakkam',49,1),(2235,'Umangalam',49,1),(2236,'Uthangal',49,1),(2237,'Uyyakondaravi',49,1),(2238,'Vadakkuvellur',49,1),(2239,'Vannankudikaddu',49,1),(2240,'Vayalur',49,1),(2241,'Veppankuricchi',49,1),(2242,'Vettakudi',49,1),(2243,'Vijayama nagaram',49,1),(2244,'Vilakapadi',49,1),(2245,'Vilankattur',49,1),(2246,'Visalur',49,1),(2247,'Vridhachalam',49,1),(2248,'A.reddihalli',50,1),(2249,'Adagappadi',50,1),(2250,'Akkammanahalli',50,1),(2251,'Anasagaram',50,1),(2252,'Andihalli',50,1),(2253,'Goduhalli',50,1),(2254,'Helaya Dharmapuri',50,1),(2255,'K.naduhalli',50,1),(2256,'Kadagattur',50,1),(2257,'Konanginayakkanahalli',50,1),(2258,'Kondaharahalli',50,1),(2259,'Kondampatti',50,1),(2260,'Krishnapuram',50,1),(2261,'Kukalamalai',50,1),(2262,'Kuppur',50,1),(2263,'Mukkalnaickennahalli',50,1),(2264,'Mukkanur',50,1),(2265,'Nallanahalli',50,1),(2266,'Nayakkanahalli',50,1),(2267,'Noolahalli',50,1),(2268,'NoolahalliReddihalli',50,1),(2269,'Papinayakanahalli',50,1),(2270,'Puludikarai',50,1),(2271,'Semmandakuppam',50,1),(2272,'Settikarai',50,1),(2273,'Thippireddihalli',50,1),(2274,'Ungaranhalli',50,1),(2275,'Vathlamalai',50,1),(2276,'Vellaikkavundanpalaiyam',50,1),(2277,'Vellalappatti',50,1),(2278,'Vellolai',50,1),(2279,'Veppliaimuthampatti',50,1),(2280,'Virupakshipuram',50,1),(2281,'Achalavadi',51,1),(2282,'Agraharram',51,1),(2283,'Alampatti',51,1),(2284,'Ammapettai',51,1),(2285,'Andipatty',51,1),(2286,'Andiyur',51,1),(2287,'Appiyampatty',51,1),(2288,'Avalampatty',51,1),(2289,'Avalur',51,1),(2290,'Baimayakampatty',51,1),(2291,'Bodinaickenpatty',51,1),(2292,'Chandrapuram',51,1),(2293,'Chellampatty',51,1),(2294,'chettikuttai',51,1),(2295,'Chinnakoundanpatty',51,1),(2296,'Chinnapannimadugu',51,1),(2297,'Dasirihalli',51,1),(2298,'Doddampatti',51,1),(2299,'Elavadai',51,1),(2300,'Ellapudayampatty',51,1),(2301,'Ettipatti',51,1),(2302,'Ganapathipatty',51,1),(2303,'Gettupatti',51,1),(2304,'Gobinathampatti',51,1),(2305,'Gudalur',51,1),(2306,'Harur',51,1),(2307,'Iacchchambaddi',51,1),(2308,'ilaiyampatti',51,1),(2309,'Ittalahapatty',51,1),(2310,'Ittiampatty',51,1),(2311,'Jadaiyankombai',51,1),(2312,'jangalavaddi',51,1),(2313,'Kalladipatty',51,1),(2314,'Kalladipatty',51,1),(2315,'Kamalampatty',51,1),(2316,'Kambalai',51,1),(2317,'Karappadi',51,1),(2318,'Karuthampatty',51,1),(2319,'Kattavaddichampatty',51,1),(2320,'Kattiripatty',51,1),(2321,'Katttur',51,1),(2322,'Kovoipatty',51,1),(2323,'kilanur',51,1),(2324,'kilapparai',51,1),(2325,'Kilchengampadi',51,1),(2326,'Kilmorappur',51,1),(2327,'kiraipatty',51,1),(2328,'Kodamandapatty',51,1),(2329,'Koluthambinatham',51,1),(2330,'Konampatty',51,1),(2331,'Kondampatty',51,1),(2332,'Kondayampatti',51,1),(2333,'Kongavembu',51,1),(2334,'Kosapatty',51,1),(2335,'Kothanampatty',51,1),(2336,'Kottapatty',51,1),(2337,'Kottarapatty',51,1),(2338,'Kudumiyampatty',51,1),(2339,'Kumarrampatty',51,1),(2340,'Kurumbapatty',51,1),(2341,'Kurumbapatty',51,1),(2342,'Kurumbapatty',51,1),(2343,'Kuttapatty',51,1),(2344,'Kuttipatty',51,1),(2345,'Lingapuram',51,1),(2346,'Malatangi',51,1),(2347,'Mambadi',51,1),(2348,'Mampatty',51,1),(2349,'Mandikulampatty',51,1),(2350,'Mangalapatty',51,1),(2351,'Marudipatti',51,1),(2352,'Mattiyampatti',51,1),(2353,'Mattiyampatti',51,1),(2354,'Maveripatty',51,1),(2355,'Maveripatty',51,1),(2356,'Melanur',51,1),(2357,'Melsengambadi',51,1),(2358,'Mettupatti',51,1),(2359,'Mettuvalasaai',51,1),(2360,'Mobirippatti',51,1),(2361,'Mondikuli',51,1),(2362,'Morappur',51,1),(2363,'Morasappatti',51,1),(2364,'Mottayampatti',51,1),(2365,'Mukkanurpatti',51,1),(2366,'Mungilpatti',51,1),(2367,'Nachanampatti',51,1),(2368,'Nachanampatti',51,1),(2369,'Naddupatti',51,1),(2370,'Narippalli',51,1),(2371,'Nariyampatti',51,1),(2372,'Navaalai',51,1),(2373,'Nayinakavundampatti',51,1),(2374,'Neruppandakuppam',51,1),(2375,'Obilinayakkanpatti',51,1),(2376,'Pachchanampatti',51,1),(2377,'Palayam',51,1),(2378,'Palayam',51,1),(2379,'Pallipatti',51,1),(2380,'Panamarathupatti',51,1),(2381,'Papinayakkanvalasai',51,1),(2382,'Paraiyapatti',51,1),(2383,'Perayapannimaduvu',51,1),(2384,'Periyapatti',51,1),(2385,'Polayampalli',51,1),(2386,'Ponneri',51,1),(2387,'Poyyapatti',51,1),(2388,'Pudinattam',51,1),(2389,'Pudur',51,1),(2390,'Rasalampatti',51,1),(2391,'Reddippatti',51,1),(2392,'Runganavalasai',51,1),(2393,'S.thadampatti',51,1),(2394,'Sakkilipatti',51,1),(2395,'Samanattam',51,1),(2396,'Samandahalli',51,1),(2397,'Sandappatti',51,1),(2398,'Selambai',51,1),(2399,'Sengandippatti',51,1),(2400,'Sennampatti',51,1),(2401,'Senrayampatti',51,1),(2402,'Setrapatti',51,1),(2403,'Sikkalur',51,1),(2404,'Sikkampatti',51,1),(2405,'Singirippatti',51,1),(2406,'Sittilingi',51,1),(2407,'Soriyampatti',51,1),(2408,'Sundangipatti',51,1),(2409,'Suranattam',51,1),(2410,'Surappatti',51,1),(2411,'Tadaravalasai',51,1),(2412,'Tamaleripatti',51,1),(2413,'Tamarakoliyampatti',51,1),(2414,'Tambal',51,1),(2415,'Tammichettipatti',51,1),(2416,'Tandekuppam',51,1),(2417,'Tanippadi',51,1),(2418,'Tarisal',51,1),(2419,'Tekkanampatti',51,1),(2420,'Thadampatti',51,1),(2421,'Thadampatti',51,1),(2422,'Theerthamalai',51,1),(2423,'Thippampatti',51,1),(2424,'Thoppampatti',51,1),(2425,'Thuranampatti',51,1),(2426,'Vadappatti',51,1),(2427,'Vadugapatti',51,1),(2428,'Valaduppu',51,1),(2429,'Vanakkampadi',51,1),(2430,'Varunathirtham',51,1),(2431,'vedakattamaduvu',51,1),(2432,'Vedapatti',51,1),(2433,'Velampatti',51,1),(2434,'Velampatti',51,1),(2435,'Velanur',51,1),(2436,'Velimadurai',51,1),(2437,'Vengiyampatti',51,1),(2438,'Vengiyampatti',51,1),(2439,'Veppampatti',51,1),(2440,'Veppanatham',51,1),(2441,'Veppasennampatti',51,1),(2442,'Vetrapatti',51,1),(2443,'Vetrapatti',51,1),(2444,'Virappanayakanpatti',51,1),(2445,'adilam',52,1),(2446,'Agraharam',52,1),(2447,'Baisuhalli',52,1),(2448,'Bandarahalli',52,1),(2449,'Battalahalli',52,1),(2450,'Begarahalli',52,1),(2451,'Bommahalli',52,1),(2452,'Dindal',52,1),(2453,'Donnenahalli',52,1),(2454,'Elumincchanahalli',52,1),(2455,'Hanumanthapuram',52,1),(2456,'Ichchambadi',52,1),(2457,'Indamangalam',52,1),(2458,'Irumattur',52,1),(2459,'Jakkupatti',52,1),(2460,'Kalppanahalli',52,1),(2461,'Kambainallur',52,1),(2462,'Karimangalam',52,1),(2463,'Kelavalli',52,1),(2464,'Kerekodihalli',52,1),(2465,'Kondachamanahalli',52,1),(2466,'Kongarapatti',52,1),(2467,'Kottumaranahalli',52,1),(2468,'Kumbarahalli',52,1),(2469,'Malliyakuttai',52,1),(2470,'Molappanaha;lli',52,1),(2471,'Mukkulam',52,1),(2472,'Murukampatti',52,1),(2473,'Naganampatti',52,1),(2474,'Nariyanahalli',52,1),(2475,'Pachiganapalli',52,1),(2476,'Pallipatti',52,1),(2477,'Pannikulam',52,1),(2478,'Periyanahalli',52,1),(2479,'Pumandahalli',52,1),(2480,'Punadanahalli',52,1),(2481,'Senarayanahalli',52,1),(2482,'Tellanahalli',52,1),(2483,'Vagurappampatti',52,1),(2484,'Vedarampatti',52,1),(2485,'A.Jettihalli',53,1),(2486,'Adamankottai',53,1),(2487,'Balajangamanahalli',53,1),(2488,'Bolanahalli',53,1),(2489,'Budanahalli',53,1),(2490,'Dalavoyhalli',53,1),(2491,'Dinnahalli',53,1),(2492,'Dokkubodanahalli',53,1),(2493,'Echchanahalli',53,1),(2494,'Elagiri',53,1),(2495,'Errabaiyanahalli',53,1),(2496,'Kammampatti',53,1),(2497,'Konangihalli',53,1),(2498,'Kumbalappaddi',53,1),(2499,'Laligam',53,1),(2500,'M.Reddihalli',53,1),(2501,'mademangalam',53,1),(2502,'Maniyathahalli',53,1),(2503,'Mukkanahalli',53,1),(2504,'Nagarkudal',53,1),(2505,'Nallampalli',53,1),(2506,'Nattahalli',53,1),(2507,'Nekkundi',53,1),(2508,'Pagalahalli',53,1),(2509,'Palavadi',53,1),(2510,'Palayam',53,1),(2511,'Pangunatham',53,1),(2512,'Sivvadi',53,1),(2513,'Somanahalli',53,1),(2514,'Tadangam',53,1),(2515,'Toppur Kanigarahalli',53,1),(2516,'அன்னாமலைஹள்ளி',54,1),(2517,'அத்திமுட்லு',54,1),(2518,'பேளாராஹள்ளி',54,1),(2519,'ஜாகீர்வரகூர்',54,1),(2520,'பத்தலஹள்ளி',54,1),(2521,'பெலகாபுரம்',54,1),(2522,'பெலமாரனஹள்ளி',54,1),(2523,'பேவஹள்ளி',54,1),(2524,'பிக்கனாள்ளி',54,1),(2525,'பூகுட்லஹள்ளி',54,1),(2526,'Bolabaguthanahalli',54,1),(2527,'Boppadi',54,1),(2528,'budihalli',54,1),(2529,'Buganahalli',54,1),(2530,'Chekkodi',54,1),(2531,'Chennamanahalli',54,1),(2532,'Chikkadoranabetta',54,1),(2533,'Chikkamarandahalli',54,1),(2534,'Chikkardanahalli',54,1),(2535,'Chinnegoundaanahalli',54,1),(2536,'Chudanur',54,1),(2537,'Danddukarnahalli',54,1),(2538,'Errakuttahalli',54,1),(2539,'Erudukuttahalli',54,1),(2540,'Giddanahalli',54,1),(2541,'Goravandahalli',54,1),(2542,'Gummanur',54,1),(2543,'Guttalahalli',54,1),(2544,'Jakkasamudram',54,1),(2545,'Jertalav',54,1),(2546,'Jittandahalli',54,1),(2547,'Kanavanahalli',54,1),(2548,'Kandenahalli',54,1),(2549,'Karagadahalli',54,1),(2550,'Karrakkanahalli',54,1),(2551,'Karukkamaranahalli',54,1),(2552,'Kattanahalli',54,1),(2553,'Mahendramangalam',54,1),(2554,'Marandahalli',54,1),(2555,'Maravadi',54,1),(2556,'Modugulahalli',54,1),(2557,'Murukkalanattam',54,1),(2558,'Nallur',54,1),(2559,'Nammandahalli',54,1),(2560,'Neralamaradahalli',54,1),(2561,'P.gllahalli',54,1),(2562,'P.settihalli',54,1),(2563,'Palakodu',54,1),(2564,'Panjapalli',54,1),(2565,'Papanaickenpatty',54,1),(2566,'Periyanur',54,1),(2567,'Pothalahalli',54,1),(2568,'புலிக்கல்',54,1),(2569,'புலிக்கரை',54,1),(2570,'ரங்கம்பட்டி',54,1),(2571,'செல்லியம்பட்டி',54,1),(2572,'சாமனூர்',54,1),(2573,'Sanganbauvantalav',54,1),(2574,'Settihalli',54,1),(2575,'Sirandapuuram',54,1),(2576,'Sirenahalli',54,1),(2577,'Sitiganahalli',54,1),(2578,'Thirumalvadi',54,1),(2579,'Timmarayanahalli',54,1),(2580,'Tomalahalli',54,1),(2581,'Upparahalli',54,1),(2582,'Velakalahalli',54,1),(2583,'A.pallipattu',55,1),(2584,'Adikarapatty',55,1),(2585,'Ajjampatti',55,1),(2586,'Alapuram',55,1),(2587,'Allalapatti',55,1),(2588,'Almelupuram',55,1),(2589,'Ammapalayam',55,1),(2590,'Andipatty',55,1),(2591,'Annamalaihalli',55,1),(2592,'Annamalaipatty',55,1),(2593,'bairnatham',55,1),(2594,'Balasamuthiram',55,1),(2595,'Bandarasettipatty',55,1),(2596,'Basavapuram',55,1),(2597,'Battalahalli',55,1),(2598,'Bommidi',55,1),(2599,'Bosinaickenhalli',55,1),(2600,'Bothakkadu',55,1),(2601,'Buddireddipatti',55,1),(2602,'Chinnamancchavadi',55,1),(2603,'Chinnankuppam',55,1),(2604,'chintalpadi',55,1),(2605,'Devarajapalaya',55,1),(2606,'Devarajapalaya',55,1),(2607,'Erumiyampatti',55,1),(2608,'Gobichettipalayam',55,1),(2609,'Gopalapuram',55,1),(2610,'Gundalamaduvu',55,1),(2611,'Guruparahalli',55,1),(2612,'Hunisinahalli',55,1),(2613,'EIlandaikuttapatty',55,1),(2614,'Irulapatty',55,1),(2615,'Jammanahalli',55,1),(2616,'Jangalahalli',55,1),(2617,'Kadattur',55,1),(2618,'Kadavanampatty',55,1),(2619,'Kadiripuram',55,1),(2620,'Kallattupatty',55,1),(2621,'Kavandampatty',55,1),(2622,'Kedaparahalli',55,1),(2623,'Kerehodihalli',55,1),(2624,'Kettureddipatty',55,1),(2625,'Kokkarapatty',55,1),(2626,'Kolagampatti',55,1),(2627,'Kolimookanuru',55,1),(2628,'Kombur',55,1),(2629,'Kullampatty',55,1),(2630,'Kumbarahalli',55,1),(2631,'Linginaickenahalli',55,1),(2632,'Malagappadi',55,1),(2633,'Mallapuram',55,1),(2634,'Mangade',55,1),(2635,'Maniyabadi',55,1),(2636,'Manjavadi',55,1),(2637,'Matadaahalli',55,1),(2638,'Mekalanayakkanahalli',55,1),(2639,'Menisi',55,1),(2640,'Molaiyanur',55,1),(2641,'Mookareddipatti',55,1),(2642,'Mottankuricchcchi',55,1),(2643,'Nadupatti',55,1),(2644,'Nallaggudalahalli',55,1),(2645,'Nambippatti',55,1),(2646,'Naranapuram',55,1),(2647,'Nonaqnganur',55,1),(2648,'Obilinayakkanpatti',55,1),(2649,'Oddupatti',55,1),(2650,'P.pallipatti',55,1),(2651,'Papichettipatti',55,1),(2652,'Pappambadi',55,1),(2653,'Pappireddipattty',55,1),(2654,'Paraiyapatti',55,1),(2655,'Pattukanampatti',55,1),(2656,'Peddampattti',55,1),(2657,'Peddasamudram',55,1),(2658,'Peddur',55,1),(2659,'Pudinattam',55,1),(2660,'Pudupatti',55,1),(2661,'Puilparuthi',55,1),(2662,'Puludiyur',55,1),(2663,'Ramanahalli',55,1),(2664,'Regadahalli',55,1),(2665,'Sembiyanur',55,1),(2666,'Sikkampatti',55,1),(2667,'Singirihalli',55,1),(2668,'Sitterri',55,1),(2669,'Sunkarahalli',55,1),(2670,'Suriyagadai',55,1),(2671,'Tadanur',55,1),(2672,'Talanatham',55,1),(2673,'Thenkaraikottai',55,1),(2674,'Thadampatti',55,1),(2675,'Thinnahalli',55,1),(2676,'Thurinjihalli',55,1),(2677,'Vachchatti',55,1),(2678,'Vairanur',55,1),(2679,'Vellalapatti',55,1),(2680,'Venkatasamudram',55,1),(2681,'Ajjanahalli',56,1),(2682,'Alepuram',56,1),(2683,'Andarahalli',56,1),(2684,'Anjehalli',56,1),(2685,'Arakasanahalli',56,1),(2686,'Batharahalli',56,1),(2687,'Chinnampalli',56,1),(2688,'D.solapatty',56,1),(2689,'Donnakuttahalli',56,1),(2690,'Kadamadai',56,1),(2691,'Kalappampadi',56,1),(2692,'Karibaiyanahalli',56,1),(2693,'Kattinayakanahalli',56,1),(2694,'Kodihalli',56,1),(2695,'Kondehalli',56,1),(2696,'Kookutamaruthahalli',56,1),(2697,'Koothapaddi',56,1),(2698,'Madehalli',56,1),(2699,'Manguruchi',56,1),(2700,'Manjarahalli',56,1),(2701,'Manjinayakanahalli',56,1),(2702,'Nagamarai',56,1),(2703,'Pallipaty',56,1),(2704,'Panaikulam',56,1),(2705,'Paruvathanahalli',56,1),(2706,'Pauparapatty',56,1),(2707,'Pennagaram',56,1),(2708,'Perumbalai',56,1),(2709,'Peyalmari',56,1),(2710,'Pikili',56,1),(2711,'Pnnapagoundanahalli',56,1),(2712,'Pudupatty',56,1),(2713,'Ramakondahalli',56,1),(2714,'Rangapuram',56,1),(2715,'Sathiyanathapuram',56,1),(2716,'Senganur',56,1),(2717,'Sidumanahalli',56,1),(2718,'Sigaralahalli',56,1),(2719,'Sunjalnatham',56,1),(2720,'Thinnabellur',56,1),(2721,'Thithiyopanahalli',56,1),(2722,'Vattuvanahalli',56,1),(2723,'Velampatty',56,1),(2724,'Alamarathupatty',57,1),(2725,'Ambathurai',57,1),(2726,'Athoor',57,1),(2727,'Ayyampalayam',57,1),(2728,'Bodikamanvadi',57,1),(2729,'Kalikkampatty',57,1),(2730,'Kannivadimalai south',57,1),(2731,'Keelakottai',57,1),(2732,'Kummampatty',57,1),(2733,'Manaloor',57,1),(2734,'Munnilaikottai',57,1),(2735,'N.panjampatty',57,1),(2736,'Narasingapuram',57,1),(2737,'Palayankottai',57,1),(2738,'Paraipatty',57,1),(2739,'Pillayanattham',57,1),(2740,'Pithalaipatty',57,1),(2741,'Seevalsaaragu',57,1),(2742,'Sitharevu',57,1),(2743,'Thoppampatty',57,1),(2744,'Vakkampatty',57,1),(2745,'Veerrakkal',57,1),(2746,'Adianoothu',58,1),(2747,'Ammakulathupatty',58,1),(2748,'Anjukulipatty',58,1),(2749,'Avilipatty',58,1),(2750,'Balakrishnapuram',58,1),(2751,'Emakkalapuram',58,1),(2752,'Jothampatty',58,1),(2753,'Kambiliampatty',58,1),(2754,'Kanavoipatty',58,1),(2755,'Kombaipatty',58,1),(2756,'Konapatty',58,1),(2757,'Koovanuthu',58,1),(2758,'Kovilur',58,1),(2759,'Madur',58,1),(2760,'Markkampatty',58,1),(2761,'Marunoothu',58,1),(2762,'Mullipadi',58,1),(2763,'Periakottai',58,1),(2764,'Ragalapuram',58,1),(2765,'Rajakkapatty',58,1),(2766,'Sakkiliankodaai',58,1),(2767,'Sengurichi',58,1),(2768,'Shanarpatty',58,1),(2769,'Siluvathur',58,1),(2770,'Sirumalai',58,1),(2771,'T.panchampatty',58,1),(2772,'T.pudupatty',58,1),(2773,'Thamaraipadi',58,1),(2774,'Thavasimaddaai',58,1),(2775,'Thethampatty',58,1),(2776,'Thimmanallur',58,1),(2777,'Thotttanutthu',58,1),(2778,'Vadakattupatty',58,1),(2779,'Vajraseraikarankottai',58,1),(2780,'Vathalathoppampatty',58,1),(2781,'Veerrachinnampatty',58,1),(2782,'Vellodu',58,1),(2783,'Vembarpatty',58,1),(2784,'Vangamanoothu',58,1),(2785,'Viralipatty',58,1),(2786,'Adalur',59,1),(2787,'Agaram',59,1),(2788,'Alagupatty',59,1),(2789,'Alakkuvarpatty',59,1),(2790,'Ammapatty',59,1),(2791,'Anaipatty',59,1),(2792,'Chatrapatty',59,1),(2793,'Chettinaickenpatty',59,1),(2794,'Gurunathanaickanur',59,1),(2795,'K.pudukotttai',59,1),(2796,'Kamatchipuram',59,1),(2797,'Kannivaddimalai North',59,1),(2798,'Kasavanampatty',59,1),(2799,'Kodalvavi',59,1),(2800,'Kothapulli',59,1),(2801,'Kurumbapatty',59,1),(2802,'Kuttathupatty',59,1),(2803,'Mangarai',59,1),(2804,'Neelamalaikottai',59,1),(2805,'Palakkanoothu',59,1),(2806,'Palayakannivadi',59,1),(2807,'Pallapatty',59,1),(2808,'Pandrimalai',59,1),(2809,'Seelapadi',59,1),(2810,'Silvarpatty',59,1),(2811,'Sinthalakandu',59,1),(2812,'Sirankadu',59,1),(2813,'Sullarumbu',59,1),(2814,'Thadicombu',59,1),(2815,'Thamaraikulam',59,1),(2816,'Thethupatty',59,1),(2817,'Thonimalai',59,1),(2818,'Alambadi',60,1),(2819,'Chinnaluppai',60,1),(2820,'D Gudalur',60,1),(2821,'Karikali',60,1),(2822,'Karungal',60,1),(2823,'Koombur',60,1),(2824,'Kottanatham',60,1),(2825,'Kudappam',60,1),(2826,'Kulathupatty',60,1),(2827,'Lanthakottai',60,1),(2828,'Mallapuram',60,1),(2829,'Nagayakottai',60,1),(2830,'Nallur',60,1),(2831,'Palayam',60,1),(2832,'R Kombai',60,1),(2833,'r Pudukottai',60,1),(2834,'R Vellodu',60,1),(2835,'Theedakal',60,1),(2836,'Thirukuranam',60,1),(2837,'Tholipatty',60,1),(2838,'Ulliyakottai',60,1),(2839,'Vadugambadi',60,1),(2840,'Vanikarai',60,1),(2841,'Vembur',60,1),(2842,'Adukkam',61,1),(2843,'K.chettiyapatty',61,1),(2844,'Kamanur',61,1),(2845,'Kodaikanal',61,1),(2846,'Kookal',61,1),(2847,'Mannavanoor',61,1),(2848,'Pachalur',61,1),(2849,'Pannaikadu',61,1),(2850,'Periyur',61,1),(2851,'Poolathur',61,1),(2852,'Poombarai',61,1),(2853,'Poondi',61,1),(2854,'Thandikudi',61,1),(2855,'Vadagounchi',61,1),(2856,'Vellakavi',61,1),(2857,'Avichipatty',62,1),(2858,'Bannuvarpatty',62,1),(2859,'Boothagudi',62,1),(2860,'Idiayapatty',62,1),(2861,'Kottaiyur',62,1),(2862,'Kudagipattty',62,1),(2863,'Lingavaddi',62,1),(2864,'Mulaiyur',62,1),(2865,'Nadumandalam',62,1),(2866,'Natham',62,1),(2867,'Palappanaickenpatty',62,1),(2868,'Panniamalai',62,1),(2869,'Pappapatty',62,1),(2870,'Pillayarnatham',62,1),(2871,'Pudur',62,1),(2872,'Punnapattty',62,1),(2873,'Reddiapatty',62,1),(2874,'Samuthrapatty',62,1),(2875,'Sathampadi',62,1),(2876,'Sellappanaickenpattty',62,1),(2877,'senthurai',62,1),(2878,'Sethur',62,1),(2879,'Sirangatttupatty',62,1),(2880,'Sirugudi',62,1),(2881,'Uralipattty',62,1),(2882,'Velampatty',62,1),(2883,'Bangalapatty',63,1),(2884,'Bodiagoundenpatty',63,1),(2885,'Chinnamanaickenkottai',63,1),(2886,'Ethilodu',63,1),(2887,'Gullalagundu',63,1),(2888,'Gullichetttipatty',63,1),(2889,'Jambuthuraikottai',63,1),(2890,'Kalladipatty',63,1),(2891,'Kanavoipatty',63,1),(2892,'Kodangidnaickenpatty',63,1),(2893,'Kombaipatty',63,1),(2894,'Koovanoothu',63,1),(2895,'Kottu',63,1),(2896,'Kunnuvarankottai',63,1),(2897,'Malayagoundenpatty',63,1),(2898,'Mallanampatty',63,1),(2899,'Mattaparai',63,1),(2900,'Musuvanoothu',63,1),(2901,'Nadakottai',63,1),(2902,'Nakkaluthu',63,1),(2903,'Nariyuthu',63,1),(2904,'Nilakottai',63,1),(2905,'Noothulapuram',63,1),(2906,'Oruthattu',63,1),(2907,'Pallapatty',63,1),(2908,'Pannaipatty',63,1),(2909,'Patchamalayankottai',63,1),(2910,'Pillayarnatham',63,1),(2911,'Ramarajapuram',63,1),(2912,'Rengappanaickenpatty',63,1),(2913,'Sandaiyur',63,1),(2914,'Sekkapatty',63,1),(2915,'Sengattampatty',63,1),(2916,'Sevugampatty',63,1),(2917,'Silukkuvarpatty',63,1),(2918,'Sithargalnatham',63,1),(2919,'Sivanganapuram',63,1),(2920,'Vathalagundu',63,1),(2921,'Veelinaickenpatty',63,1),(2922,'Vilampatty',63,1),(2923,'Viralimayanpatti',63,1),(2924,'Viralipatty',63,1),(2925,'Viruveedu',63,1),(2926,'Ambilikkai',64,1),(2927,'Appanoothu',64,1),(2928,'Appayampatty',64,1),(2929,'Appipalayam',64,1),(2930,'Arasappapaillipatty',64,1),(2931,'Athappampatty',64,1),(2932,'Athikombai',64,1),(2933,'Chatrapatty',64,1),(2934,'Chinnakkampatty',64,1),(2935,'Dasaripattty',64,1),(2936,'Devathur',64,1),(2937,'Ellapatty',64,1),(2938,'I.vaddipatty',64,1),(2939,'Idayakottai',64,1),(2940,'Javathupatty',64,1),(2941,'Jogipatty',64,1),(2942,'Kalanjipatty',64,1),(2943,'Kallimandayam',64,1),(2944,'Kallupatty',64,1),(2945,'Kappiliapatty',64,1),(2946,'Kariyampatty',64,1),(2947,'Kaveriammapatty',64,1),(2948,'Kethaiyurambu',64,1),(2949,'Kollapatty',64,1),(2950,'Kodarangikeeranur',64,1),(2951,'Koothampoondi',64,1),(2952,'Kothayam',64,1),(2953,'Kuthiluppai',64,1),(2954,'Lakkayankottai',64,1),(2955,'Mandavadi',64,1),(2956,'Manjanaickenpatty',64,1),(2957,'Markkampatty',64,1),(2958,'Navakani',64,1),(2959,'Odaipattty',64,1),(2960,'Oddenchatram',64,1),(2961,'Palappanpatty',64,1),(2962,'Parithiyur',64,1),(2963,'Periakottai',64,1),(2964,'Poduvarpatty',64,1),(2965,'Poosaripatty',64,1),(2966,'Porulur',64,1),(2967,'Pottikkampatty',64,1),(2968,'Pudukottai',64,1),(2969,'Pudur',64,1),(2970,'Puliamarathukottai',64,1),(2971,'Puliyurnatham',64,1),(2972,'Pungamathur',64,1),(2973,'Radddiapatty',64,1),(2974,'Sikkamanaickenpatty',64,1),(2975,'Sindalapatty',64,1),(2976,'Sindalavadampatty',64,1),(2977,'Thangachiammapatty',64,1),(2978,'Vadakadu',64,1),(2979,'Valayapatty',64,1),(2980,'Veeralapatty',64,1),(2981,'Veriappoor',64,1),(2982,'Virupatchi',64,1),(2983,'A.kalayamputhur',65,1),(2984,'Akkaraipatty',65,1),(2985,'Amarapoondi',65,1),(2986,'Andipatty',65,1),(2987,'Ayakudi (east)',65,1),(2988,'Ayakudi (west)',65,1),(2989,'Ayyampalayam',65,1),(2990,'Ayyampulli',65,1),(2991,'Balasamudaram',65,1),(2992,'Chinnakalayamputhur',65,1),(2993,'Chinnammapatty',65,1),(2994,'Chithiraikulam',65,1),(2995,'Errramanaickenpatty',65,1),(2996,'Kalikkanaickenpatty',65,1),(2997,'Kanakkanpatty',65,1),(2998,'Kavalapatty',65,1),(2999,'Keeranur',65,1),(3000,'Kolumankondaan',65,1),(3001,'Kombaipatty',65,1),(3002,'Korikadavu',65,1),(3003,'Kodaimangalam',65,1),(3004,'Kottathurai',65,1),(3005,'Kovilammapatty',65,1),(3006,'Manoor',65,1),(3007,'Marichilambu',65,1),(3008,'Melakaraipatty',65,1),(3009,'Melakottai',65,1),(3010,'Mettupatty',65,1),(3011,'Midapadi',65,1),(3012,'Mollampatty',65,1),(3013,'Muthanaickenpatty',65,1),(3014,'Neikkarapatty',65,1),(3015,'Pachalanayacckenpatty',65,1),(3016,'Palani',65,1),(3017,'Pappampatty',65,1),(3018,'Periakalayamputhur',65,1),(3019,'Periammapatty',65,1),(3020,'Pethanaickenpatty',65,1),(3021,'Puduchu',65,1),(3022,'Pudur',65,1),(3023,'Puliampatty',65,1),(3024,'Pushapathur',65,1),(3025,'R.vadipatty south',65,1),(3026,'Rajampatty',65,1),(3027,'Ravimangalam',65,1),(3028,'Reddiampadi',65,1),(3029,'Sitharevu',65,1),(3030,'Sivagiripatty',65,1),(3031,'Sukkamanaickenpatty',65,1),(3032,'Thalaiyuthu',65,1),(3033,'Thamaraikulam',65,1),(3034,'Thatanaickenpatty-north',65,1),(3035,'Thatanaickenpatty-south',65,1),(3036,'Thattankulam',65,1),(3037,'Thoppampatty',65,1),(3038,'Thummalapatty',65,1),(3039,'Vadipatti-north',65,1),(3040,'Vakarai',65,1),(3041,'Velampatty',65,1),(3042,'Velasamudram',65,1),(3043,'Vemban Valasu',65,1),(3044,'Vilvathampatty',65,1),(3045,'A.kombai',66,1),(3046,'Ammapatty',66,1),(3047,'Ayyalur',66,1),(3048,'Baganatham',66,1),(3049,'Boothipuram',66,1),(3050,'E.cchithoor',66,1),(3051,'Eriodu',66,1),(3052,'Kaithiankottai',66,1),(3053,'Kalvarpatty',66,1),(3054,'Kanapaddi',66,1),(3055,'Kollapatty',66,1),(3056,'Komberipatty',66,1),(3057,'Koovakkapatty',66,1),(3058,'Kulathur',66,1),(3059,'Kuttam',66,1),(3060,'Malvarpatty',66,1),(3061,'Marampadi',66,1),(3062,'Morrepattty',66,1),(3063,'Nallamanarkotttai',66,1),(3064,'Nathapatty',66,1),(3065,'Padiyur',66,1),(3066,'Palapatty',66,1),(3067,'Panjamthangi',66,1),(3068,'Perumpulli',66,1),(3069,'Pilathu',66,1),(3070,'Puthur',66,1),(3071,'Ramanathapuram',66,1),(3072,'Singarakottai',66,1),(3073,'Sithuvarpatty',66,1),(3074,'Sriramapuram',66,1),(3075,'Sukkampatty',66,1),(3076,'Thennampatty',66,1),(3077,'Usilampatty',66,1),(3078,'V.pudukottai',66,1),(3079,'Vadamadurai',66,1),(3080,'Vedasandur',66,1),(3081,'Velayuthampalayam',66,1),(3082,'Vellampatty',66,1),(3083,'Velvarkottai',66,1),(3084,'Ammapettai',67,1),(3085,'Ammapettai -B',67,1),(3086,'Anthiyur',67,1),(3087,'Anthiyur -B',67,1),(3088,'Ariyagoundanur',67,1),(3089,'Athani',67,1),(3090,'Attavanipudur',67,1),(3091,'Bargur',67,1),(3092,'Bargur -B',67,1),(3093,'Boothapadi',67,1),(3094,'Brammadesam',67,1),(3095,'Chennampatti',67,1),(3096,'Ennamangalam',67,1),(3097,'Ilipulli',67,1),(3098,'Kannappalli',67,1),(3099,'Kettisamudram',67,1),(3100,'Kilvani',67,1),(3101,'Komarayanur',67,1),(3102,'Koothampoondi',67,1),(3103,'Kuppandampalayam',67,1),(3104,'Mathur',67,1),(3105,'Mugasipudur',67,1),(3106,'Mungilpatti',67,1),(3107,'Nagalur',67,1),(3108,'Nerinjipettai',67,1),(3109,'Ottappalayam',67,1),(3110,'Pachapalayam',67,1),(3111,'Patlur',67,1),(3112,'Poonachi',67,1),(3113,'Pudhur',67,1),(3114,'Sangarapalayam',67,1),(3115,'Vellitiruppu',67,1),(3116,'Vempathi',67,1),(3117,'Vempathi -B',67,1),(3118,'Alathur',68,1),(3119,'Andikulam',68,1),(3120,'Appakudal',68,1),(3121,'Bhavani',68,1),(3122,'Bhavani -B',68,1),(3123,'Chettipalayam',68,1),(3124,'Chinnapuliyur',68,1),(3125,'Jambai-A',68,1),(3126,'Jambai-B',68,1),(3127,'Kadapanallur',68,1),(3128,'Kalpavi',68,1),(3129,'Kavindapadi',68,1),(3130,'Kavindapadi -B',68,1),(3131,'Kavindapadi -C',68,1),(3132,'Kesarimangalam',68,1),(3133,'Kurichi',68,1),(3134,'Kurichi -B',68,1),(3135,'Mayilambadi',68,1),(3136,'Odathurai',68,1),(3137,'Odathurai -B',68,1),(3138,'Olagadam',68,1),(3139,'Oricheri',68,1),(3140,'P.Mettupalayam',68,1),(3141,'P.Mettupalayam (B)',68,1),(3142,'Padavalkalvai',68,1),(3143,'Paruvachi',68,1),(3144,'Periyapuliyur',68,1),(3145,'Perunthalayur',68,1),(3146,'Punnam',68,1),(3147,'Salangapalayam',68,1),(3148,'Salangapalayam -B',68,1),(3149,'Salangapalayam -C',68,1),(3150,'Saniyasipatti',68,1),(3151,'Singampetta',68,1),(3152,'Thalakulam',68,1),(3153,'Uratchikottai',68,1),(3154,'Vairamangalam',68,1),(3155,'Varadhanallur',68,1),(3156,'Annainasuvampalayam',69,1),(3157,'Attayampalayam',69,1),(3158,'B.P.Agraharam',69,1),(3159,'B.S. Agraharam',69,1),(3160,'Chithode',69,1),(3161,'Elavamalai',69,1),(3162,'Ellapalayam',69,1),(3163,'Erode (A)',69,1),(3164,'Erode (B)',69,1),(3165,'Erode (C)',69,1),(3166,'Gangapuram',69,1),(3167,'Karai Ellapalayam',69,1),(3168,'Kathirampatti',69,1),(3169,'Koorapalayam',69,1),(3170,'Kumilam Parappu',69,1),(3171,'Mettunasuvanmpalayam',69,1),(3172,'Moolakarai',69,1),(3173,'Muthampalayam',69,1),(3174,'Nallagoundampalayam',69,1),(3175,'Nanjai Thalavai Plm',69,1),(3176,'Nanjanapuram',69,1),(3177,'Nasiyanur',69,1),(3178,'Nasiyanur (B)',69,1),(3179,'Nochipalayam',69,1),(3180,'Pavalathampalayam',69,1),(3181,'Peelamedu',69,1),(3182,'Periyasemur',69,1),(3183,'Periyasemur (B)',69,1),(3184,'Perodu',69,1),(3185,'Puthur Puthuppalayam',69,1),(3186,'Rayapalayam',69,1),(3187,'Samigoundenpalayam',69,1),(3188,'Sarcar Chinna Agraharam',69,1),(3189,'Sarcar Periya Agraharam',69,1),(3190,'Surampatti',69,1),(3191,'Suriyampalayam',69,1),(3192,'Suriyampalayam (B)',69,1),(3193,'Thairpalayam',69,1),(3194,'Thindal',69,1),(3195,'Thindal',69,1),(3196,'Thottani',69,1),(3197,'Vairapalayam',69,1),(3198,'Vendipalayam',69,1),(3199,'Veppampalayam',69,1),(3200,'Vettai Periya Palayam',69,1),(3201,'Villarasampatti (A)',69,1),(3202,'Villarasampatti (B)',69,1),(3203,'Agraharakarai',70,1),(3204,'Akkarai Kodiveri',70,1),(3205,'Alukuli',70,1),(3206,'Alukuzhi (B)',70,1),(3207,'Ammapalayam',70,1),(3208,'Arakkankottai',70,1),(3209,'Arakkankottaikarai',70,1),(3210,'Ayalur',70,1),(3211,'Bodichinnampalayam',70,1),(3212,'Chandrapuram',70,1),(3213,'Chenrayampalayam',70,1),(3214,'Chinnakodiveri',70,1),(3215,'Chozhamadhevi Karai',70,1),(3216,'Kadukkampalayam',70,1),(3217,'Kalingiyam',70,1),(3218,'Kalingiyam (B)',70,1),(3219,'Kanakkampalayam',70,1),(3220,'Kolappalur',70,1),(3221,'Kondayampalayam',70,1),(3222,'Konkara Palayam (B)',70,1),(3223,'Konkarpalayam',70,1),(3224,'Kottupulampalayam',70,1),(3225,'Kovundampalayam',70,1),(3226,'Kugalur',70,1),(3227,'Kugalur (B)',70,1),(3228,'Kugalur C',70,1),(3229,'Kullampalayam',70,1),(3230,'Lakkampatti',70,1),(3231,'Mevani',70,1),(3232,'Modachur',70,1),(3233,'Nadhipalayam',70,1),(3234,'Nagadevampalayam',70,1),(3235,'Nagadevampalayam (B)',70,1),(3236,'Nanjai Gobichettipalayam',70,1),(3237,'Nanjai Puliampatti',70,1),(3238,'Nanjai Thuraiyampalayam',70,1),(3239,'Odayakavundampalayam',70,1),(3240,'Palaiya Pariyur Karai',70,1),(3241,'Pariyur',70,1),(3242,'Periyakodiveri',70,1),(3243,'Perumugai',70,1),(3244,'Perumugai (B)',70,1),(3245,'Pettaikarai',70,1),(3246,'Polavakkalipalayam',70,1),(3247,'Pudukarai',70,1),(3248,'Pullappanaickanpalayam',70,1),(3249,'Punjai Thuraiyampalayam',70,1),(3250,'Punjaithuraiyampalayam (B)',70,1),(3251,'Savandapur (B)',70,1),(3252,'Savundapur',70,1),(3253,'Senkalarai Karai',70,1),(3254,'Seyyampalayam',70,1),(3255,'Singiripalayam',70,1),(3256,'Siruvalur',70,1),(3257,'Thadapalli Gramam',70,1),(3258,'Thadapallikarai',70,1),(3259,'Vanipudur',70,1),(3260,'Vanipudur (B)',70,1),(3261,'Veerapand',70,1),(3262,'Vellalapalayam',70,1),(3263,'Vellankovil',70,1),(3264,'A. Unjalur',71,1),(3265,'Anjur',71,1),(3266,'Anjur (B)',71,1),(3267,'Avudayaparai',71,1),(3268,'Ayyampalayam',71,1),(3269,'Chenna Samudram',71,1),(3270,'Chenna Samudram (B)',71,1),(3271,'Devakiyammapuram',71,1),(3272,'Elunuthimangalam',71,1),(3273,'Elunuthimangalam (B)',71,1),(3274,'Ichipalayam',71,1),(3275,'chipalayam (B)',71,1),(3276,'Kodumudi',71,1),(3277,'Kodumudi (B)',71,1),(3278,'Kolathupalayam',71,1),(3279,'Kolathupalayam (B)',71,1),(3280,'Kollankoil',71,1),(3281,'Kollankovil (B)',71,1),(3282,'Kongudaiyampalayam',71,1),(3283,'Konthalam',71,1),(3284,'Konthalam (B)',71,1),(3285,'Murungiyampalayam',71,1),(3286,'Nagamanaykanpalayam',71,1),(3287,'Nanjaikilampadi',71,1),(3288,'Nanjaikolanalli',71,1),(3289,'Pasur',71,1),(3290,'Punjai Kilampadi',71,1),(3291,'Punjai Kilampadi (B)',71,1),(3292,'Punjaikolanalli',71,1),(3293,'Punjaikolanalli (B)',71,1),(3294,'Sivagiri',71,1),(3295,'Sivagiri (C)',71,1),(3296,'Sivakiri (B)',71,1),(3297,'Vadivullamangalam',71,1),(3298,'Vallipuram',71,1),(3299,'Venkambur',71,1),(3300,'Venkambur (B)',71,1),(3301,'Arachalur',72,1),(3302,'Arachalur (B)',72,1),(3303,'Arachalur (C)',72,1),(3304,'Attavanai Anumanpalli',72,1),(3305,'Attavanai Anumanpalli (B)',72,1),(3306,'Aval Poondurai (A)',72,1),(3307,'Aval Poondurai (B)',72,1),(3308,'Aval Poondurai (C)',72,1),(3309,'Ellaikadu',72,1),(3310,'Elumathur',72,1),(3311,'Elumathur (B)',72,1),(3312,'Injampalli',72,1),(3313,'Injampalli (B)',72,1),(3314,'Kagam',72,1),(3315,'Kanagapuram (A)',72,1),(3316,'Kanagapuram (B)',72,1),(3317,'Kangayam Palayam',72,1),(3318,'Kaspapettai (A)',72,1),(3319,'Kaspapettai (B)',72,1),(3320,'Kulavilakku',72,1),(3321,'Kulavilakku (B)',72,1),(3322,'Kurukkapalayam',72,1),(3323,'Modakkurichi',72,1),(3324,'Modakkurichi (B)',72,1),(3325,'Mugasi Anumanpalli',72,1),(3326,'Mukasi Anumanpalli',72,1),(3327,'Nanjai Kalamangalam',72,1),(3328,'Nanjai Lakkapuram',72,1),(3329,'Nanjai Uthukuli (A)',72,1),(3330,'Nanjai Uthukuli (B)',72,1),(3331,'Palamangalam',72,1),(3332,'Poonduraisemur',72,1),(3333,'Pudur (A)',72,1),(3334,'Pudur (B)',72,1),(3335,'Punjai Kalamangalam',72,1),(3336,'Punjai Kalamangalam (B)',72,1),(3337,'Punjai Lakkapuram',72,1),(3338,'Sathambur',72,1),(3339,'Thanathampalayam',72,1),(3340,'Thuyyampoondurai (A)',72,1),(3341,'Thuyyampoondurai (B)',72,1),(3342,'Thuyyampoondurai (C)',72,1),(3343,'Vadugapatti',72,1),(3344,'Vadugapatti (B)',72,1),(3345,'Vadugapatti (C)',72,1),(3346,'Velampalayam',72,1),(3347,'Velampalayam',72,1),(3348,'Velampalayam (B)',72,1),(3349,'Vilakkethi',72,1),(3350,'Vilakkethi (B)',72,1),(3351,'Aandipalayam',73,1),(3352,'Anjanur',73,1),(3353,'Avalampalayam',73,1),(3354,'Chinnaripalayam',73,1),(3355,'Elathur',73,1),(3356,'Ellathur B',73,1),(3357,'Emmampoondi',73,1),(3358,'Emmampoondi B',73,1),(3359,'Irugalur',73,1),(3360,'Kadasellipalayam',73,1),(3361,'Kadathur',73,1),(3362,'Karapadi',73,1),(3363,'Karattupalayam',73,1),(3364,'Karattupalayam B',73,1),(3365,'Kavilipalayam',73,1),(3366,'Kosanam',73,1),(3367,'Kosanam B',73,1),(3368,'Kuddakarai',73,1),(3369,'Kurumanthur',73,1),(3370,'Lagampalayam',73,1),(3371,'Mottanam',73,1),(3372,'Nambiyur',73,1),(3373,'Nambiyur B',73,1),(3374,'Nichampalayam',73,1),(3375,'Ozhalakkoil',73,1),(3376,'Polavapalayam',73,1),(3377,'Santhipalayam',73,1),(3378,'Sellappampalayam',73,1),(3379,'Sundakkampalayam',73,1),(3380,'Thazhkuni',73,1),(3381,'Varappalayam',73,1),(3382,'Vemandampalayam',73,1),(3383,'Vemandampalayam B',73,1),(3384,'Ag.Vijayamangalam',74,1),(3385,'Attavanaipidariyur',74,1),(3386,'Ayigoundempalayam',74,1),(3387,'Chennimalai',74,1),(3388,'Chennimalai -B',74,1),(3389,'Chinna Veerasangili',74,1),(3390,'Chinnamallanpalayam',74,1),(3391,'Chinnavillamalai',74,1),(3392,'Ekkattampalayam',74,1),(3393,'Ekkattampalayam -B',74,1),(3394,'Ellaigramam',74,1),(3395,'Ingur',74,1),(3396,'Ingur - B',74,1),(3397,'Kallakulam',74,1),(3398,'Kambaliyampatti',74,1),(3399,'Kandampalayam',74,1),(3400,'Kanjikoil',74,1),(3401,'Kanjikoil -B',74,1),(3402,'Karandipalayam',74,1),(3403,'Karukkuppalayam',74,1),(3404,'Karumandisellipalayam',74,1),(3405,'Karumandisellipalayam -B',74,1),(3406,'Kavundichipalayam',74,1),(3407,'Kavundichipalayam -B',74,1),(3408,'Kodumanal',74,1),(3409,'Kongampalayam',74,1),(3410,'Koothampalayam',74,1),(3411,'Koyilpalayam',74,1),(3412,'Kullampalayam',74,1),(3413,'Kuppichipalayam',74,1),(3414,'Madathupalayam',74,1),(3415,'Marappanaickanpalayam',74,1),(3416,'Mettuppudhur',74,1),(3417,'Moongilpalayam',74,1),(3418,'Mugasipidariyur',74,1),(3419,'Mugasipidariyur -B',74,1),(3420,'Mugasipulavampalayam',74,1),(3421,'Mullampatti',74,1),(3422,'Murungathozhuvu',74,1),(3423,'Murungathozhuvu -B',74,1),(3424,'Nallampatti',74,1),(3425,'Nanjai Palathozhuvu',74,1),(3426,'Nichampalayam',74,1),(3427,'Nimittipalayam',74,1),(3428,'Orathupalayam',74,1),(3429,'Palakkarai',74,1),(3430,'Pallapalayam',74,1),(3431,'Pallapalayam -B',74,1),(3432,'Pandiyampalayam',74,1),(3433,'Pandiyampalayam -B',74,1),(3434,'Pappampalayam',74,1),(3435,'Pasuvapatti',74,1),(3436,'Pasuvapatti -B',74,1),(3437,'Pattakaranpalayam',74,1),(3438,'Periya Veera Sangili',74,1),(3439,'Periyavilamalai',74,1),(3440,'Perundurai',74,1),(3441,'Perundurai -B',74,1),(3442,'Pethampalayam -B',74,1),(3443,'Pethampalayam-A,B',74,1),(3444,'Polanaickenpalayam',74,1),(3445,'Ponmudi',74,1),(3446,'Poovampalayam',74,1),(3447,'Pudupalayam',74,1),(3448,'Pungambadi',74,1),(3449,'Punjai Palathozhuvu',74,1),(3450,'Seenapuram',74,1),(3451,'Sellappampalayam',74,1),(3452,'Singanallur - A',74,1),(3453,'Singanallur -B',74,1),(3454,'Sirukalanji',74,1),(3455,'Sullipalayam',74,1),(3456,'Sungakaranpalayam',74,1),(3457,'Thalaiyampalayam',74,1),(3458,'Thenmugam Vellode',74,1),(3459,'Thenmugam Vellode -B',74,1),(3460,'Thingalur',74,1),(3461,'Thiruvachi',74,1),(3462,'Thiruvachi -B',74,1),(3463,'Thoranavavi',74,1),(3464,'Thuduppathi',74,1),(3465,'Unjappalayam',74,1),(3466,'Vadamugam Vellode',74,1),(3467,'Vadamugam Vellode -B',74,1),(3468,'Vaipadi',74,1),(3469,'Varappalayam',74,1),(3470,'Vettainkinar',74,1),(3471,'Vijayapuri',74,1),(3472,'Akkarainegamam',75,1),(3473,'Akkaraithathapalli',75,1),(3474,'Allathukkombai',75,1),(3475,'Arasur',75,1),(3476,'Ariyappampalayam',75,1),(3477,'Ayyampalayam',75,1),(3478,'Dhottampalayam',75,1),(3479,'Gundri',75,1),(3480,'Guthiyalathur',75,1),(3481,'Ikkarai Thathapalli',75,1),(3482,'Ikkarainegamam',75,1),(3483,'Indiampalayam',75,1),(3484,'Karidhoddampalayam',75,1),(3485,'Kembanaickanpalayam',75,1),(3486,'Komarapalayam',75,1),(3487,'Konamoolai',75,1),(3488,'Kondappanaickanpalayam',75,1),(3489,'Koothampalayam',75,1),(3490,'Kothamangalam',75,1),(3491,'Kottuveerampalayam',75,1),(3492,'Kurumbapalayam',75,1),(3493,'Maakanangombai',75,1),(3494,'Maarayipalayam',75,1),(3495,'Maathampalayam',75,1),(3496,'Malayadipudhur',75,1),(3497,'Mudukkanthurai',75,1),(3498,'Nallur',75,1),(3499,'Paguthampalayam',75,1),(3500,'Panayampalli',75,1),(3501,'Pattavarthi Ayyampalayam',75,1),(3502,'Pazhayakalaiyanur',75,1),(3503,'Periyakallipatti',75,1),(3504,'Poosaripalayam',75,1),(3505,'Pungampalli',75,1),(3506,'Pungar',75,1),(3507,'Punjai Puliampatti',75,1),(3508,'Puthukalaiyanur',75,1),(3509,'Puthupeerkadavu',75,1),(3510,'Rajannagar',75,1),(3511,'Rangasamudram',75,1),(3512,'Sathumugai',75,1),(3513,'Sathyamangalam',75,1),(3514,'Sellipalayam',75,1),(3515,'Senbagapudur',75,1),(3516,'Senbagapudur (B)',75,1),(3517,'Sikkarasampalayam',75,1),(3518,'Sungakaranpalayam',75,1),(3519,'Thachuperumapalayam',75,1),(3520,'Thasaripalayam',75,1),(3521,'Thingalur A',75,1),(3522,'Thingalur B',75,1),(3523,'Thoppampalayam',75,1),(3524,'Ukkaram (B)',75,1),(3525,'Ukkaram A',75,1),(3526,'Ukkaram C',75,1),(3527,'Varathappampalayam',75,1),(3528,'Vinnappalli',75,1),(3529,'Arulavadi',76,1),(3530,'Chikkakajanur',76,1),(3531,'Eranahalli',76,1),(3532,'Haasanur',76,1),(3533,'Ikkalur',76,1),(3534,'Karalavadi',76,1),(3535,'Maathahalli',76,1),(3536,'Mallankuzhi',76,1),(3537,'Marur',76,1),(3538,'Neithalapuram',76,1),(3539,'Paiyanapuram',76,1),(3540,'Panagahalli',76,1),(3541,'Thalamalai',76,1),(3542,'Thalavadi',76,1),(3543,'Thiginaarai',76,1),(3544,'Thottakajanur',76,1),(3545,'Thottamudhukarai',76,1),(3546,'Ammaiyakaram',77,1),(3547,'Ammakalathur',77,1),(3548,'Anumandhal',77,1),(3549,'Chinnasalem(North)',77,1),(3550,'Chinnasalem(South)',77,1),(3551,'Earvaipattinam',77,1),(3552,'Eduthavainatham',77,1),(3553,'Eeriyur',77,1),(3554,'Elavadi',77,1),(3555,'Eliyathur',77,1),(3556,'Kachirayapalaiyam',77,1),(3557,'Kadathur',77,1),(3558,'Kalasamuthiram',77,1),(3559,'Kallanatham',77,1),(3560,'Karadisithur(North)',77,1),(3561,'Karadisithur(South)',77,1),(3562,'Karundalakurichi',77,1),(3563,'Karunguzhi',77,1),(3564,'Keezhkuppam',77,1),(3565,'Koogaiyur',77,1),(3566,'Kuraal',77,1),(3567,'Madhavacheri(North)',77,1),(3568,'Madhavacheri(South)',77,1),(3569,'Malliyampadi',77,1),(3570,'Manmalai',77,1),(3571,'Maravanatham',77,1),(3572,'Mathur',77,1),(3573,'Melnariyappanur',77,1),(3574,'Moonkilpadi',77,1),(3575,'Nallasevipuram',77,1),(3576,'Nayinarpalayam',77,1),(3577,'Pakkampadi',77,1),(3578,'Palarampattu',77,1),(3579,'Pandiyanguppam',77,1),(3580,'Parigam',77,1),(3581,'Patharampallam',77,1),(3582,'Payithanthurai',77,1),(3583,'Pethasamuthiram',77,1),(3584,'Poondi',77,1),(3585,'Poosappadi',77,1),(3586,'Pottium',77,1),(3587,'Rayappanur',77,1),(3588,'Sellampattu',77,1),(3589,'Sembakurichi',77,1),(3590,'Siruvallur(South)',77,1),(3591,'Thagantheerthapuram',77,1),(3592,'Thagarai',77,1),(3593,'Thathathiripuram',77,1),(3594,'Thavadipattu',77,1),(3595,'Thenchettiyandhal',77,1),(3596,'Thengiyanatham',77,1),(3597,'Thenponparappi',77,1),(3598,'Thottappadi',77,1),(3599,'Thottiyam',77,1),(3600,'V.Alambalam',77,1),(3601,'V.Krishnapuram',77,1),(3602,'V.Mamandur',77,1),(3603,'Vadakanandhal(East)',77,1),(3604,'Vadakananthal(West',77,1),(3605,'Vasudevanur',77,1),(3606,'Veerapayankaram',77,1),(3607,'Vettiperumalagaram',77,1),(3608,'Aalanur',78,1),(3609,'Aarampoondi',78,1),(3610,'Aravangadu',78,1),(3611,'Ennadu',78,1),(3612,'Erukkampattu(K.Hills)',78,1),(3613,'KErukkampattu(V.Malai)',78,1),(3614,'Ezhuthur',78,1),(3615,'Kalliparai',78,1),(3616,'Kandickal',78,1),(3617,'Kariyalur',78,1),(3618,'Karuvelampadi',78,1),(3619,'Keelathukuzhi',78,1),(3620,'Keezhnilavoor',78,1),(3621,'Kilakadu',78,1),(3622,'Kondiyanatham',78,1),(3623,'Koodaram',78,1),(3624,'Kurumpalur',78,1),(3625,'Maniyarpalayam',78,1),(3626,'Mavadipattu',78,1),(3627,'Melathukuzhi',78,1),(3628,'Melnilavoor',78,1),(3629,'Melpachchery',78,1),(3630,'Mottaiyanor',78,1),(3631,'Mozhipattu',78,1),(3632,'Mundiyur',78,1),(3633,'Naranampattu',78,1),(3634,'Nochimedu',78,1),(3635,'Perumanatham',78,1),(3636,'Perumpur',78,1),(3637,'Serappattu',78,1),(3638,'Sirukkalur',78,1),(3639,'Thoradipattu',78,1),(3640,'Thorangur',78,1),(3641,'Uppur',78,1),(3642,'Vaaram',78,1),(3643,'Vanchikuzhi',78,1),(3644,'Vandagapadi',78,1),(3645,'Vanniyur',78,1),(3646,'Vazhaikuzhi',78,1),(3647,'Vazhapadi',78,1),(3648,'Vellarikadu',78,1),(3649,'Vellimalai',78,1),(3650,'Vengodu',78,1),(3651,'Vilvaathi',78,1),(3652,'Magarur',79,1),(3653,'Malaikottalam',79,1),(3654,'Mattigaikurichi',79,1),(3655,'Melur',79,1),(3656,'Melvizhi',79,1),(3657,'Mudiyanoor',79,1),(3658,'Nagaloor',79,1),(3659,'Nallathur',79,1),(3660,'Namasivayapuram',79,1),(3661,'Nattarmangalam',79,1),(3662,'Neelamangalam',79,1),(3663,'Ninnaiyur',79,1),(3664,'Niraimathi',79,1),(3665,'Ogaiyur(E)',79,1),(3666,'Pangaram',79,1),(3667,'Periyamampattu',79,1),(3668,'Perumangalam',79,1),(3669,'Peruvangur',79,1),(3670,'Pethanur',79,1),(3671,'Pirithivimangalam',79,1),(3672,'Poraiyur',79,1),(3673,'Porasakurichi',79,1),(3674,'Porpadakkurichi',79,1),(3675,'Pukkiravari',79,1),(3676,'Pukkulam',79,1),(3677,'Sadaiyampattu',79,1),(3678,'Sathanur',79,1),(3679,'Sirumangalam',79,1),(3680,'Sirunagalur',79,1),(3681,'Siruval',79,1),(3682,'Siruvangur',79,1),(3683,'Siruvathur',79,1),(3684,'Sithalur',79,1),(3685,'Sithathur',79,1),(3686,'Sitheri',79,1),(3687,'Somanathapuram',79,1),(3688,'Thachur',79,1),(3689,'Thennerikuppam',79,1),(3690,'Thimmalai',79,1),(3691,'Thiyagai',79,1),(3692,'Thorasalur(North)',79,1),(3693,'Thorasalur(South)',79,1),(3694,'Udayamampattu',79,1),(3695,'Udayanachi',79,1),(3696,'Ulagankathan',79,1),(3697,'Ulakiyanallur',79,1),(3698,'Vadapoondi',79,1),(3699,'Vanavaretti',79,1),(3700,'Varadhappanoor',79,1),(3701,'Varancharam',79,1),(3702,'Vazhavandhankuppam',79,1),(3703,'Veerachozhapuram(East)',79,1),(3704,'Veerachozhapuram(West)',79,1),(3705,'Velakurichi',79,1),(3706,'Vengaivadi',79,1),(3707,'Vilakkur',79,1),(3708,'Vilambar',79,1),(3709,'Vinaitheerthapuram',79,1),(3710,'Virugavoor',79,1),(3711,'A. Pandalam',80,1),(3712,'Aalathur',80,1),(3713,'Aarkavadi',80,1),(3714,'Aarur',80,1),(3715,'Aathanur',80,1),(3716,'Agarakottalam',80,1),(3717,'Aliyabath',80,1),(3718,'Anaikaraikottalam',80,1),(3719,'Arasampattu',80,1),(3720,'Arasarampattu',80,1),(3721,'Ariaperumanur',80,1),(3722,'Ariyalur',80,1),(3723,'Arulampadi',80,1),(3724,'Arumparampattu',80,1),(3725,'Aththiyur',80,1),(3726,'Aviriur',80,1),(3727,'Chinnakolliyur',80,1),(3728,'Chitheripattu',80,1),(3729,'Devapandalam',80,1),(3730,'Dhandalai North',80,1),(3731,'Dhozhuvanthangal',80,1),(3732,'Eduthanur',80,1),(3733,'Eirudaiyanpattu',80,1),(3734,'Enthal',80,1),(3735,'Jampadai',80,1),(3736,'Ka.Alambalam',80,1),(3737,'Kadampoor',80,1),(3738,'Kaduvanur',80,1),(3739,'Kalaiyanallur',80,1),(3740,'Kallerikuppam',80,1),(3741,'Kallipattu',80,1),(3742,'Kanangkadu',80,1),(3743,'Kattuvannanchur',80,1),(3744,'Keezhapattu',80,1),(3745,'Keezhpadi',80,1),(3746,'Kidangudaiyampattu',80,1),(3747,'Kosappadi',80,1),(3748,'La. Gudalur',80,1),(3749,'Lakinayakkanpatti',80,1),(3750,'Maiyanur',80,1),(3751,'Mallapuram',80,1),(3752,'Manaloor',80,1),(3753,'Mandagapadi',80,1),(3754,'Mangalam',80,1),(3755,'Maniyanthal',80,1),(3756,'Manjaputhur',80,1),(3757,'Maroor',80,1),(3758,'Melapattu',80,1),(3759,'Melapazhangur',80,1),(3760,'Melsiruvallur',80,1),(3761,'Mo.Vannanchur',80,1),(3762,'Mohur',80,1),(3763,'Mookkanur',80,1),(3764,'Moorarpath',80,1),(3765,'Mulakadu',80,1),(3766,'Mungilduraipattu',80,1),(3767,'Munivazhai',80,1),(3768,'Muttium',80,1),(3769,'Nagalkudi',80,1),(3770,'Nedumanur',80,1),(3771,'Neyvanatham',80,1),(3772,'Nurolai',80,1),(3773,'Odiyanthal',80,1),(3774,'Olakalapadi',80,1),(3775,'Oorangani',80,1),(3776,'Pachchery',80,1),(3777,'Pakkam',80,1),(3778,'Palaya Siruvankur',80,1),(3779,'Pallakacherry',80,1),(3780,'Pallipattu',80,1),(3781,'Paramanatham',80,1),(3782,'Pasar',80,1),(3783,'Pavanthur',80,1),(3784,'Pavunchipattu',80,1),(3785,'Pazhaiyanur',80,1),(3786,'Peelamedu',80,1),(3787,'Peral',80,1),(3788,'Periakolliyur',80,1),(3789,'Periapagandai',80,1),(3790,'Pirividaiyampattu',80,1),(3791,'Poikunam',80,1),(3792,'Ponparappattu',80,1),(3793,'Poottai',80,1),(3794,'Porasapattu',80,1),(3795,'Porpalampattu',80,1),(3796,'Poruvallur',80,1),(3797,'Pramakundam',80,1),(3798,'Puthirampattu',80,1),(3799,'Puthupalapattu',80,1),(3800,'Puthupattu',80,1),(3801,'Ramarajapuram',80,1),(3802,'Rangapanur',80,1),(3803,'Ravathanallur',80,1),(3804,'Rayasamuthiram',80,1),(3805,'Rishivanthiyam',80,1),(3806,'S.V.Palayam',80,1),(3807,'Sankarapuram',80,1),(3808,'Sathaputhur',80,1),(3809,'Seerpathanallur',80,1),(3810,'Sellakkaikuppam',80,1),(3811,'Sembarampattu',80,1),(3812,'Sempadakurichi',80,1),(3813,'Seshasamuthiram',80,1),(3814,'Shivapuram',80,1),(3815,'Sirpananthal',80,1),(3816,'Sirupanaiyur',80,1),(3817,'Sitanthangal',80,1),(3818,'Sitthal',80,1),(3819,'Somandarkudi',80,1),(3820,'Soolangkurichi',80,1),(3821,'Sozhampattu',80,1),(3822,'Su. Kallipadi',80,1),(3823,'Su.Kulathur',80,1),(3824,'Suthamalai',80,1),(3825,'Thandalai South',80,1),(3826,'Thimmanandal',80,1),(3827,'Thirukanangur',80,1),(3828,'Thiruvarangam',80,1),(3829,'Thiyagarajapuram',80,1),(3830,'Ulakudaiyam Pattu',80,1),(3831,'Vadachettiyanthal',80,1),(3832,'Vadakeeranur',80,1),(3833,'Vadamamanthur',80,1),(3834,'Vadaponparapi',80,1),(3835,'Vadasiruvallur',80,1),(3836,'Valayampattu',80,1),(3837,'Vanapuram',80,1),(3838,'Vaniyanthal',80,1),(3839,'Varakur',80,1),(3840,'Velananthal',80,1),(3841,'Venkalam',80,1),(3842,'Viriyur',80,1),(3843,'Yaal',80,1),(3844,'Aalur',81,1),(3845,'Aaviyur',81,1),(3846,'Agasthiyarmoolai',81,1),(3847,'Ariyur',81,1),(3848,'Arumpakkam',81,1),(3849,'Aruthangudi',81,1),(3850,'Athandamarthur',81,1),(3851,'Atthiyanthal',81,1),(3852,'Deviagaram',81,1),(3853,'Deviyanthal',81,1),(3854,'Edaiyur',81,1),(3855,'Elrampattu',81,1),(3856,'Eravalam',81,1),(3857,'Erumbalakkurichi',81,1),(3858,'Ja. Sithamoor',81,1),(3859,'Jambai',81,1),(3860,'Kadiyar',81,1),(3861,'Kanagananthal',81,1),(3862,'Kangiyanur',81,1),(3863,'Karadi',81,1),(3864,'Katchikku Vatchan',81,1),(3865,'Kattupaiyur',81,1),(3866,'Kazhumalam',81,1),(3867,'Keeranur',81,1),(3868,'Keezhaiyur',81,1),(3869,'Keezhthalanur',81,1),(3870,'Kodiyur',81,1),(3871,'Kolapparai',81,1),(3872,'Konakkalavadi',81,1),(3873,'Konganamoor',81,1),(3874,'Koovanur',81,1),(3875,'Kottakam',81,1),(3876,'Kozhundirampattu',81,1),(3877,'Kulappakkam(Aviyur)',81,1),(3878,'Kulatheepamangalam',81,1),(3879,'Kunnathur',81,1),(3880,'Madampoonidi',81,1),(3881,'Manalurpettai',81,1),(3882,'Melanthal',81,1),(3883,'Melaripattu',81,1),(3884,'Melathalanur',81,1),(3885,'Memalur',81,1),(3886,'Mogalar',81,1),(3887,'Mrukkampadi',81,1),(3888,'Mudiyanoor',81,1),(3889,'Muthalur',81,1),(3890,'Nariyanthal',81,1),(3891,'Nedumudaiyan',81,1),(3892,'Nedungamppattu',81,1),(3893,'Padiyanthal',81,1),(3894,'Pallichandal',81,1),(3895,'Panapadi',81,1),(3896,'Paradappattu',81,1),(3897,'Pazhangur',81,1),(3898,'Perianoor',81,1),(3899,'Po.Meyyur',81,1),(3900,'Ponniyanthal',81,1),(3901,'Poomari',81,1),(3902,'Putthagaram',81,1),(3903,'Sadaikatti',81,1),(3904,'Sangiyam',81,1),(3905,'Sellankuppam',81,1),(3906,'Senganangkollai',81,1),(3907,'Sithapattanam',81,1),(3908,'Sivanarthankal',81,1),(3909,'Sorayapattu',81,1),(3910,'Sozhavandipuram',81,1),(3911,'T.Athipakkam',81,1),(3912,'Thagadi',81,1),(3913,'Thanakananthal',81,1),(3914,'Thathanur',81,1),(3915,'Thevaradiyarkuppam',81,1),(3916,'Thimichur',81,1),(3917,'Thirukoilur (North)',81,1),(3918,'Thirukoilur (South)',81,1),(3919,'Thirupalapanthal',81,1),(3920,'Thurinjipattu',81,1),(3921,'Vadamalaiyanur',81,1),(3922,'Vadamarudhur',81,1),(3923,'Vadukku Nemali',81,1),(3924,'Vengur',81,1),(3925,'Venmar',81,1),(3926,'Veranampattu',81,1),(3927,'Vilanthai',81,1),(3928,'Villivalam',81,1),(3929,'A. Puthur',82,1),(3930,'A.Kullathur',82,1),(3931,'A.Kumaramangalam',82,1),(3932,'A.Kurumpoor',82,1),(3933,'A.Mazhavarayanur',82,1),(3934,'A.Sathanur',82,1),(3935,'Aandikuzhi',82,1),(3936,'Aarinatham',82,1),(3937,'Aasanur',82,1),(3938,'Aathanur',82,1),(3939,'Aathur',82,1),(3940,'Aavalam',82,1),(3941,'Adaiyur',82,1),(3942,'Alangiri',82,1),(3943,'Anganur',82,1),(3944,'Arali',82,1),(3945,'Arasampoondi',82,1),(3946,'Arumpalavadi',82,1),(3947,'Athippakkam',82,1),(3948,'Chemanangur',82,1),(3949,'Chettiyanthal',82,1),(3950,'Deviyananthal',82,1),(3951,'Eamam',82,1),(3952,'Easwarakandanallur',82,1),(3953,'Edaikal',82,1),(3954,'Edaiyalam',82,1),(3955,'Edalavadi',82,1),(3956,'Elavathadi',82,1),(3957,'Ellai Kramam',82,1),(3958,'Eraiyur',82,1),(3959,'Erunthai',82,1),(3960,'Gingeekuppam',82,1),(3961,'Gunamangalam',82,1),(3962,'Iluppaiyur',82,1),(3963,'Kaampattu',82,1),(3964,'Kalamaruthur',82,1),(3965,'Kalathur',82,1),(3966,'Kalavanur',82,1),(3967,'Kallamedu',82,1),(3968,'Kanaiyar',82,1),(3969,'Kattu Edaiyur',82,1),(3970,'Kattuchellur',82,1),(3971,'Kattunemili',82,1),(3972,'Kiliyur',82,1),(3973,'Komma Samuthiram',82,1),(3974,'Koo. Kallakurichi',82,1),(3975,'Koothanur',82,1),(3976,'Koottadi',82,1),(3977,'Koovadu',82,1),(3978,'Koovagam',82,1),(3979,'Korattur',82,1),(3980,'Kunjaram',82,1),(3981,'Ma.Kunnathur',82,1),(3982,'Madapattu',82,1),(3983,'Manalur',82,1),(3984,'Marudhur East',82,1),(3985,'Mathiyanoor',82,1),(3986,'Mattigai',82,1),(3987,'Mayiladunthangal',82,1),(3988,'Meppuliyur',82,1),(3989,'Mettathur',82,1),(3990,'Moolasamuthiram',82,1),(3991,'Nachiyarpettai',82,1),(3992,'Nagar',82,1),(3993,'Nannaram',82,1),(3994,'Nathamoor',82,1),(3995,'Nedumanur',82,1),(3996,'Neivanai',82,1),(3997,'Nonaiyavadi',82,1),(3998,'Odapankuppam',82,1),(3999,'Olaiyanur',82,1),(4000,'P.Killanur',82,1),(4001,'P.Konalavadi',82,1),(4002,'Pa.Killanur',82,1),(4003,'Paandur',82,1),(4004,'Pali',82,1),(4005,'Pallavadi',82,1),(4006,'Parameswarimangalam',82,1),(4007,'Paravananthal',82,1),(4008,'Parikal',82,1),(4009,'Parinthal',82,1),(4010,'Patchapalayam',82,1),(4011,'Pathoor',82,1),(4012,'Pazhangunam',82,1),(4013,'Periappattu',82,1),(4014,'Periyakurukkai',82,1),(4015,'Perumpakkam',82,1),(4016,'Perumpattu',82,1),(4017,'Pidagam',82,1),(4018,'Pillaiyar Palayam',82,1),(4019,'Pinnalavadi',82,1),(4020,'Poondi',82,1),(4021,'Poovanoor',82,1),(4022,'Pu.Malaiyanur',82,1),(4023,'Pu.Mampakkam',82,1),(4024,'KPugaippatti',82,1),(4025,'Pullur',82,1),(4026,'Puthamangalam',82,1),(4027,'Puthananthal',82,1),(4028,'Puthukkazhani',82,1),(4029,'Raghunathapuram',82,1),(4030,'Ravutharayankuppam',82,1),(4031,'Salappakkam',82,1),(4032,'Seedevi',82,1),(4033,'Seekampattu',82,1),(4034,'Seeyamangalam',82,1),(4035,'Sembiamadevi',82,1),(4036,'Semmananthal',82,1),(4037,'Sempattamalaiyanur',82,1),(4038,'Senkurichi',82,1),(4039,'Senthamangalam',82,1),(4040,'Senthanadu',82,1),(4041,'Sikkadu',82,1),(4042,'Sirulapattu',82,1),(4043,'Sirunagalur',82,1),(4044,'Sirupakkam',82,1),(4045,'Sirupuliyur',82,1),(4046,'Siruthanur',82,1),(4047,'Siruvathur',82,1),(4048,'Sivappattinam',82,1),(4049,'Somasipalayam',82,1),(4050,'Sundaravandi',82,1),(4051,'T. Orathur',82,1),(4052,'Thamal',82,1),(4053,'Thanam',82,1),(4054,'Thenkunam',82,1),(4055,'Thirunarangkondrai',82,1),(4056,'Thirunavalur',82,1),(4057,'Thirupeyar',82,1),(4058,'U.Cellur',82,1),(4059,'U.Keeranur',82,1),(4060,'U.Nemili',82,1),(4061,'Udaiyananthal',82,1),(4062,'Ulunthoor',82,1),(4063,'Vadakurumbur',82,1),(4064,'Vadamampakkam',82,1),(4065,'Vandippalayam',82,1),(4066,'Vannagapadi',82,1),(4067,'Vannampattu',82,1),(4068,'Veeramangalam',82,1),(4069,'Vellaiyur',82,1),(4070,'Vellore',82,1),(4071,'Vijayangkuppam',82,1),(4072,'Achukattu',83,1),(4073,'Alapakkam',83,1),(4074,'Alavantharmedu',83,1),(4075,'Anchoor',83,1),(4076,'Arapanancheri',83,1),(4077,'Ariyampakkam',83,1),(4078,'Ariyaperumpakkam',83,1),(4079,'Athivakkam',83,1),(4080,'Attupputhur',83,1),(4081,'Chinnaiyankulam',83,1),(4082,'Chitherimedu',83,1),(4083,'Cietty',83,1),(4084,'Ciruvallur',83,1),(4085,'Damal - A',83,1),(4086,'Damal - B',83,1),(4087,'Damal - C',83,1),(4088,'Eanathur - B',83,1),(4089,'Eanchampakkam',83,1),(4090,'Earivakkam-73',83,1),(4091,'Enathur - A',83,1),(4092,'Illuppappattu',83,1),(4093,'Iyangarkulam',83,1),(4094,'Kaliyanoor',83,1),(4095,'Kallakambanpattadai-74',83,1),(4096,'Kamukampallam',83,1),(4097,'Kanakambakkam',83,1),(4098,'Kancheepuram',83,1),(4099,'Karai',83,1),(4100,'Karapettai',83,1),(4101,'Karupadithattai',83,1),(4102,'Karur',83,1),(4103,'Keelambi',83,1),(4104,'Kilar',83,1),(4105,'Kilkathirpur',83,1),(4106,'Konerikuppam - B',83,1),(4107,'Konerikuppam-A',83,1),(4108,'Kooram - A',83,1),(4109,'Kooram - B',83,1),(4110,'Kottakaval',83,1),(4111,'Kottavakkam',83,1),(4112,'Kovindavadi - A',83,1),(4113,'Kovindavadi - B',83,1),(4114,'Kozhivakkam',83,1),(4115,'Kuthirambakkam',83,1),(4116,'Madapuram',83,1),(4117,'Mangalpadi',83,1),(4118,'Maniyatchi',83,1),(4119,'Marutham',83,1),(4120,'Mel Ottivakkam',83,1),(4121,'Melambi',83,1),(4122,'Melbangaram',83,1),(4123,'Melkathirpur',83,1),(4124,'Mettukuppam',83,1),(4125,'Moola Pattu',83,1),(4126,'Mumalpattu',83,1),(4127,'Murugan Thangal',83,1),(4128,'Musaravakkam - A',83,1),(4129,'Musaravakkam - B',83,1),(4130,'Muthavedu',83,1),(4131,'Muttavakkam',83,1),(4132,'Narapakkam',83,1),(4133,'Nasarath Pettai',83,1),(4134,'Nathapettai',83,1),(4135,'Neervalur',83,1),(4136,'Nellur',83,1),(4137,'Nellvoy',83,1),(4138,'Netteri',83,1),(4139,'Ooveri',83,1),(4140,'Orikkai',83,1),(4141,'Ozhaiyur',83,1),(4142,'Padunelli',83,1),(4143,'Pallampakkam',83,1),(4144,'Papankuzhi',83,1),(4145,'Paranthur - A',83,1),(4146,'Paranthur - B',83,1),(4147,'Periyakarumpur',83,1),(4148,'Periyathottam',83,1),(4149,'Perumbakkam',83,1),(4150,'Pitchavadi',83,1),(4151,'Podavoor',83,1),(4152,'Ponthavakkam',83,1),(4153,'Poondithangal',83,1),(4154,'Pudupakkam',83,1),(4155,'Pullalur - A',83,1),(4156,'Pullalur - B',83,1),(4157,'Punchaiarasanthangal',83,1),(4158,'Purisai',83,1),(4159,'Putheri',83,1),(4160,'Putheri-26',83,1),(4161,'Sadanthangal',83,1),(4162,'Salabogam',83,1),(4163,'Sekankulam',83,1),(4164,'Semanthangal',83,1),(4165,'Sembarambakkam',83,1),(4166,'Sevilimadu - A',83,1),(4167,'Sevilimedu - B',83,1),(4168,'Singadivakkam',83,1),(4169,'Sirukaveripakkam',83,1),(4170,'Sirunaiperukal',83,1),(4171,'Siruvakkam',83,1),(4172,'Siruvedal',83,1),(4173,'Sittiampakkam',83,1),(4174,'Surameni',83,1),(4175,'தண்டலம்',83,1),(4176,'Thandalam',83,1),(4177,'Thattitoppu',83,1),(4178,'Thayapakkam',83,1),(4179,'Thenampakkam',83,1),(4180,'Thimmasamuthiram',83,1),(4181,'Thirumalpadi',83,1),(4182,'Thirumalpattu',83,1),(4183,'Thiruveethipallm',83,1),(4184,'Thodur',83,1),(4185,'Thulangumthandalam',83,1),(4186,'Tirupukuzhi',83,1),(4187,'Uppukulam',83,1),(4188,'Uzhakkolpattu',83,1),(4189,'Vaiyavur',83,1),(4190,'Valathottam',83,1),(4191,'Valathur - A',83,1),(4192,'Valathur - B',83,1),(4193,'Vathiyur',83,1),(4194,'Vedal -A',83,1),(4195,'Veerambadi',83,1),(4196,'Velingapattatai',83,1),(4197,'Velliyur',83,1),(4198,'Vippedu',83,1),(4199,'Vishakandi Kuppam',83,1),(4200,'Vishnu Kanchi - A',83,1),(4201,'Vishnu Kanchi - B',83,1),(4202,'Vissar',83,1),(4203,'ஆதனஞ்சேரி',84,1),(4204,'ஆதனூர்',84,1),(4205,'அம்மணம்பாக்கம்',84,1),(4206,'அமரம்பேடு',84,1),(4207,'ஆரம்பாக்கம்',84,1),(4208,'அய்யப்பன்தாங்கல்',84,1),(4209,'பாதர்வாடி',84,1),(4210,'சென்னகுப்பம்',84,1),(4211,'சேத்துப்பட்டு',84,1),(4212,'சின்னப்பணிச்சேரி',84,1),(4213,'எருமையுர்',84,1),(4214,'எழிச்சூர்',84,1),(4215,'காஞ்சிவாக்கம்',84,1),(4216,'காரணைதாங்கல்',84,1),(4217,'கரசங்கால்',84,1),(4218,'கருணாகரச்சேரி',84,1),(4219,'காட்டுப்பாக்கம்',84,1),(4220,'காவல்கழனி',84,1),(4221,'காவனூர்',84,1),(4222,'காவனூர்  64',84,1),(4223,'கெருகம்பாக்கம்',84,1),(4224,'கீழக்கழனி',84,1),(4225,'கொளப்பாக்கம்',84,1),(4226,'கொல்லச்சேரி',84,1),(4227,'கொளூத்துவாஞ்சேரி',84,1),(4228,'கோவூர்',84,1),(4229,'கொருக்கன்தாங்கல்',84,1),(4230,'கொழுமணிவாக்கம்',84,1),(4231,'குன்றத்தூர் அ',84,1),(4232,'குன்றத்தூர் ஆ',84,1),(4233,'குத்தனூர்',84,1),(4234,'கூழங்கச்சேரி',84,1),(4235,'மாடம்பாக்கம்',84,1),(4236,'மலைப்பட்டு',84,1),(4237,'மலையம்பாக்கம்',84,1),(4238,'மணஞ்சேரி',84,1),(4239,'மாங்காடு அ',84,1),(4240,'மாங்காடு ஆ',84,1),(4241,'மணிமங்கலம் அ',84,1),(4242,'மணிமங்கலம் ஆ',84,1),(4243,'மௌலிவாக்கம்',84,1),(4244,'Mundragkattalai',84,1),(4245,'Naduveerap Pattu',84,1),(4246,'Nallur',84,1),(4247,'Nanthampakkam',84,1),(4248,'Nariyampakkam',84,1),(4249,'Nattarasampattu',84,1),(4250,'Navalur 151',84,1),(4251,'Neelamangalam',84,1),(4252,'Orakadam',84,1),(4253,'Orathur',84,1),(4254,'Panapakkam',84,1),(4255,'Pannayur',84,1),(4256,'Paraniputthur',84,1),(4257,'Patapai',84,1),(4258,'Pazanthandalam',84,1),(4259,'Periya Panicheri',84,1),(4260,'Poondi',84,1),(4261,'Poonthandalam',84,1),(4262,'Puduchery',84,1),(4263,'Rendankattalai',84,1),(4264,'Salamangalam',84,1),(4265,'Serppananjeri',84,1),(4266,'Sikkarayapuram',84,1),(4267,'Sirukalathur',84,1),(4268,'Sirumathur',84,1),(4269,'Siruvanjur',84,1),(4270,'Somangalam A',84,1),(4271,'Somangalam B',84,1),(4272,'Srinivasapuram',84,1),(4273,'Thandalam',84,1),(4274,'Tharapakkam',84,1),(4275,'Thelliaragaram',84,1),(4276,'Thirumudivakkam',84,1),(4277,'Thirunakesvaram',84,1),(4278,'Thiruvamputheri',84,1),(4279,'Thundal Kazani',84,1),(4280,'Umayal Paranacherry',84,1),(4281,'Vadakkupattu B',84,1),(4282,'Vadamalpakkam',84,1),(4283,'Vaippur A Block',84,1),(4284,'Vaippur B Block',84,1),(4285,'Vakkupattu A',84,1),(4286,'Valaiya Karanai',84,1),(4287,'Vanjuvancherry',84,1),(4288,'Varatharajapuram',84,1),(4289,'Vattambakkam',84,1),(4290,'Vellerithangal',84,1),(4291,'Vengatapuram',84,1),(4292,'Yerivakkam',84,1),(4293,'Aayakollathur',85,1),(4294,'Akkamapuram',85,1),(4295,'Araneri',85,1),(4296,'Azhakur',85,1),(4297,'Boothanur',85,1),(4298,'Bunrutti A',85,1),(4299,'Edayar Pakkam',85,1),(4300,'Ekkanapuram',85,1),(4301,'Elimiyan Kottur',85,1),(4302,'Errumbadu',85,1),(4303,'Ettchuur A',85,1),(4304,'Etthur B',85,1),(4305,'Etti Kuthi Madu',85,1),(4306,'Ierungulam',85,1),(4307,'Irrungattukottai A',85,1),(4308,'Irunkattukotai B',85,1),(4309,'Jambhodai',85,1),(4310,'Kaduvanchery',85,1),(4311,'Kandamankallam',85,1),(4312,'Kandivakkam',85,1),(4313,'Kannan Thangal',85,1),(4314,'Kanthur',85,1),(4315,'Kappankotoor',85,1),(4316,'Katrambakkam B',85,1),(4317,'Katrampakkam-A',85,1),(4318,'Keeranallur',85,1),(4319,'Kilaiy',85,1),(4320,'Kodamanallur',85,1),(4321,'Kollathur',85,1),(4322,'Kontavakkam',85,1),(4323,'Koothavakkam',85,1),(4324,'Kotour',85,1),(4325,'Kunakarampakkam',85,1),(4326,'Kunduperum Padu',85,1),(4327,'Kunnam',85,1),(4328,'Maduramankalam A',85,1),(4329,'Maduramankalam B',85,1),(4330,'Magadevimangalam',85,1),(4331,'Maganyam',85,1),(4332,'Mambakkam',85,1),(4333,'Mannur',85,1),(4334,'Mathur',85,1),(4335,'Melmaduramangalam',85,1),(4336,'Mettupalayam',85,1),(4337,'Mevalur Kuppam-B',85,1),(4338,'Mevalurkupam A',85,1),(4339,'Molachr',85,1),(4340,'Nallamperumpedu',85,1),(4341,'Nandimedu',85,1),(4342,'Navalloor',85,1),(4343,'Nemili B',85,1),(4344,'Nemili-A',85,1),(4345,'Oddankaranai',85,1),(4346,'Oragada Mahadevimangalam',85,1),(4347,'Padicheri',85,1),(4348,'Panruti B',85,1),(4349,'Pappanguli',85,1),(4350,'Pennalur',85,1),(4351,'Pillaipakkam B',85,1),(4352,'Pillaippakkam-A',85,1),(4353,'Pitchivakkam',85,1),(4354,'Podavur',85,1),(4355,'Pondur B',85,1),(4356,'Pondur C',85,1),(4357,'Ponthur-A',85,1),(4358,'Pudupper',85,1),(4359,'Ramanujapuram',85,1),(4360,'Santhavellore A',85,1),(4361,'Santhavellur B',85,1),(4362,'Santhavellur C',85,1),(4363,'Selvazhi Mangalam',85,1),(4364,'Sengadu',85,1),(4365,'Senthamangalam',85,1),(4366,'Sinkilpadi',85,1),(4367,'Sirukalathur',85,1),(4368,'Sirukiloy',85,1),(4369,'Sirumangadu',85,1),(4370,'Sivan Kodal',85,1),(4371,'Sivapuram',85,1),(4372,'Sogandi',85,1),(4373,'Sriperumbudur A',85,1),(4374,'Sriperumbudur B',85,1),(4375,'Sriperumbudur C',85,1),(4376,'Thandalam',85,1),(4377,'Tharavoor',85,1),(4378,'Thirumangalam',85,1),(4379,'Thulasapuram',85,1),(4380,'Vada Mankalam',85,1),(4381,'Vadakal A',85,1),(4382,'Vadakal B',85,1),(4383,'Vadakal C',85,1),(4384,'Valarpuram',85,1),(4385,'Valathancheri',85,1),(4386,'Vallam A',85,1),(4387,'Vallam B',85,1),(4388,'Vellari',85,1),(4389,'Venkadu',85,1),(4390,'Vittavidakai',85,1),(4391,'Aanumanththandalam',86,1),(4392,'Agaramtholi',86,1),(4393,'Alancheri',86,1),(4394,'Allapakkam',86,1),(4395,'Ammaiyappanallur',86,1),(4396,'Anampakkam',86,1),(4397,'Andithangal',86,1),(4398,'Annathur',86,1),(4399,'Arasanimangalam',86,1),(4400,'Arumpuliur',86,1),(4401,'Athambakkam',86,1),(4402,'Athiyour Melthuli',86,1),(4403,'Azhisur',86,1),(4404,'Chinnalampady',86,1),(4405,'Chitanancherri',86,1),(4406,'Chithanakavur',86,1),(4407,'Edaiyambudur',86,1),(4408,'Edamachi',86,1),(4409,'Elanagar',86,1),(4410,'Ellappakkam',86,1),(4411,'Guruvadi',86,1),(4412,'Guruvencherri',86,1),(4413,'Irumaram',86,1),(4414,'Kadalmangalam',86,1),(4415,'Kaithandalam',86,1),(4416,'Kaliyampoondi',86,1),(4417,'Kaliyappettai',86,1),(4418,'Kammalampoondi',86,1),(4419,'Kannikulam',86,1),(4420,'Karanai',86,1),(4421,'Kariamangalam',86,1),(4422,'Karumpakkam',86,1),(4423,'Karuveppam Poondi',86,1),(4424,'Kattankullam',86,1),(4425,'Kattiyam Panthal',86,1),(4426,'Kattuputhur',86,1),(4427,'Kavampayer',86,1),(4428,'Kavanipakkam',86,1),(4429,'Kavanur Puthucheri',86,1),(4430,'Kaviitthandalam',86,1),(4431,'Kidankarai',86,1),(4432,'Klakadi',86,1),(4433,'Kunnavakkam',86,1),(4434,'Kurambarai',86,1),(4435,'Malaiyankulam',86,1),(4436,'Malliyankaranai',86,1),(4437,'Malliyankaranai-B',86,1),(4438,'Mampakkam',86,1),(4439,'Mamputhur',86,1),(4440,'Manammathy',86,1),(4441,'Mananallur',86,1),(4442,'Marutham',86,1),(4443,'Marutthuvanpadi',86,1),(4444,'Melpakkam',86,1),(4445,'Mulakinimeni',86,1),(4446,'Murukkary',86,1),(4447,'Nadupattu',86,1),(4448,'Nanchipuram',86,1),(4449,'Nariyampakkam',86,1),(4450,'Nariyamputhur',86,1),(4451,'Neerkunram',86,1),(4452,'Nelveli',86,1),(4453,'Nerkundram',86,1),(4454,'Neyyadupakkam',86,1),(4455,'Niradi',86,1),(4456,'Oonkur',86,1),(4457,'Orakkattu Pettai',86,1),(4458,'Ottan Thangal',86,1),(4459,'Ozhaiyur',86,1),(4460,'Ozhukarai',86,1),(4461,'Padur',86,1),(4462,'Palesvaram',86,1),(4463,'Pandavakkam',86,1),(4464,'Pazhaveri',86,1),(4465,'Pennalour',86,1),(4466,'Peranakaur',86,1),(4467,'Perunagar',86,1),(4468,'Perunagar-B',86,1),(4469,'Perunkozhi',86,1),(4470,'Pinayur',86,1),(4471,'Poonthandalam',86,1),(4472,'Poorpanthal',86,1),(4473,'Puggananthal',86,1),(4474,'Pulipakkam',86,1),(4475,'Pulivai',86,1),(4476,'Pullambakkam D',86,1),(4477,'Pulliyur',86,1),(4478,'Puthaly',86,1),(4479,'Ravathanallur',86,1),(4480,'Rettai Mangalam',86,1),(4481,'Sadasi Vakkam',86,1),(4482,'Salavakkam',86,1),(4483,'Sathancherry',86,1),(4484,'Saththupattu',86,1),(4485,'Seethapuram',86,1),(4486,'Sembalam',86,1),(4487,'Serpakkam',86,1),(4488,'Silambakkam',86,1),(4489,'Sirukalathur',86,1),(4490,'Sirumailour',86,1),(4491,'Sirupinayur',86,1),(4492,'Siruthamur',86,1),(4493,'Sithlapakkam',86,1),(4494,'Thalavrampoondi',86,1),(4495,'Thandarai',86,1),(4496,'Thandari',86,1),(4497,'Thinayampoondi',86,1),(4498,'Thirumukkudal',86,1),(4499,'Thiruppulivanam',86,1),(4500,'Thiruvanaikovil',86,1),(4501,'Thottanaval',86,1),(4502,'Uthiramerur-B',86,1),(4503,'Utthiramerur',86,1),(4504,'Vadavur',86,1),(4505,'Vallatthodu',86,1),(4506,'Vandivakkam',86,1),(4507,'Vangaram',86,1),(4508,'Vayalakkavour',86,1),(4509,'Vayalore',86,1),(4510,'Vedapalayam',86,1),(4511,'Vengacheri',86,1),(4512,'Vichsur',86,1),(4513,'Vinnamangalam',86,1),(4514,'Visur',86,1),(4515,'Aarpakkam',87,1),(4516,'Aasoor',87,1),(4517,'Agaram',87,1),(4518,'Allavur',87,1),(4519,'Ambakkam',87,1),(4520,'Angampakkam',87,1),(4521,'Athipattu',87,1),(4522,'Avalur',87,1),(4523,'Ayimicheri',87,1),(4524,'Chinnamadurampakkam',87,1),(4525,'Chinnivakkam',87,1),(4526,'Chithathur',87,1),(4527,'Devariyambakkam',87,1),(4528,'Earivai',87,1),(4529,'Ekanampettai',87,1),(4530,'Illaiyanar Vellore',87,1),(4531,'Iyampettai',87,1),(4532,'Kalakattur',87,1),(4533,'Kallipattu',87,1),(4534,'Kallur - A',87,1),(4535,'Kalur - B',87,1),(4536,'Kammarajapuram',87,1),(4537,'Kattavakkam',87,1),(4538,'Kavanthandalam',87,1),(4539,'Keel Puthur',87,1),(4540,'Keelottivakkam',87,1),(4541,'Kolathur',87,1),(4542,'Kosappattu',87,1),(4543,'Kovalavedu',87,1),(4544,'Koyamppakkam',87,1),(4545,'Kunnavakkam',87,1),(4546,'Kuruvimalai',87,1),(4547,'Madavilagam',87,1),(4548,'Magaral - A',87,1),(4549,'Magaral - B',87,1),(4550,'Manchamedu',87,1),(4551,'Melputthur',87,1),(4552,'Muthiyalpattai',87,1),(4553,'Natha Nallur',87,1),(4554,'Navettigulam',87,1),(4555,'Nayakkankuppam',87,1),(4556,'Nayakkanpettai',87,1),(4557,'Nelveli',87,1),(4558,'Neykuppam',87,1),(4559,'Ottanthangal',87,1),(4560,'Padappam',87,1),(4561,'Pavasahib Pettai',87,1),(4562,'Pazhayaseevaram - A',87,1),(4563,'Pazhayaseevaram - B',87,1),(4564,'Peramanallur',87,1),(4565,'Periyamadurampakkam',87,1),(4566,'Poosivakkam',87,1),(4567,'Puliambakam',87,1),(4568,'Puthagaram',87,1),(4569,'Seeyamangalam',87,1),(4570,'Sirubagal',87,1),(4571,'Thalaiyillaperumpakam',87,1),(4572,'Thammanur',87,1),(4573,'Thangi',87,1),(4574,'Thazhayampet',87,1),(4575,'Thenneri',87,1),(4576,'Thimmarajampettai',87,1),(4577,'Thimmayapettai',87,1),(4578,'Thiruvenkaranai',87,1),(4579,'Thollazhi',87,1),(4580,'Thonankulam',87,1),(4581,'Ullavoor',87,1),(4582,'Uthukadu - B',87,1),(4583,'Uthukkadu - A',87,1),(4584,'Vadaveri Pattu',87,1),(4585,'Vallapakkam',87,1),(4586,'Valluvapakkam',87,1),(4587,'Varanavasi',87,1),(4588,'Vedal-42',87,1),(4589,'Vengudi',87,1),(4590,'Venpakkam',87,1),(4591,'Vichanthangal',87,1),(4592,'Vilagam',87,1),(4593,'Villivalam',87,1),(4594,'Walajabad',87,1),(4595,'அஞ்சுகிராமம்',88,1),(4596,'அழகப்பபுரம்',88,1),(4597,'தர்மபுரம் கிழக்கு',88,1),(4598,'தர்மபுரம் வடக்கு',88,1),(4599,'தர்மபுரம் தெற்கு',88,1),(4600,'இரவிபுதூர்',88,1),(4601,'கணியாகுளம்',88,1),(4602,'கன்னியாகுமரி',88,1),(4603,'கொட்டாரம் கிழக்கு',88,1),(4604,'கொட்டாரம் மேற்கு',88,1),(4605,'அகஸ்தீஸ்வரம்',88,1),(4606,'குலசேகரபுரம்',88,1),(4607,'லீபுரம்',88,1),(4608,'மதுசூதனபுரம் வடக்கு',88,1),(4609,'மதுசூதனபுரம் தெற்கு',88,1),(4610,'மருங்கூர்',88,1),(4611,'மைலாடி',88,1),(4612,'நாகர்கோவில் வடக்கு நகரம்',88,1),(4613,'நாகர்கோவில் தெற்கு நகரம்',88,1),(4614,'நல்லூர்',88,1),(4615,'நீண்டகரை அ கிழக்கு நகரம்',88,1),(4616,'நீண்டகரை அ மேற்கு',88,1),(4617,'நீண்டகரை ஆ',88,1),(4618,'வடக்கு தாமரைக்குளம்',88,1),(4619,'பறக்கை',88,1),(4620,'புத்தளம்',88,1),(4621,'புத்தேரி',88,1),(4622,'இராஜாக்கமங்கலம்',88,1),(4623,'ராமபுரம்',88,1),(4624,'தெற்கு தாமரைக்குளம்',88,1),(4625,'சுசீந்திரம்',88,1),(4626,'தெங்கம்புதூர்',88,1),(4627,'தேரேகால்புதூர்',88,1),(4628,'தேரூர்',88,1),(4629,'வடசேரி கிழக்கு நகரம்',88,1),(4630,'வடசேரி தெற்கு நகரம்',88,1),(4631,'வடசேரி மேற்கு நகரம்',88,1),(4632,'வடிவீஸ்வரம் கிழக்கு கிராமம்',88,1),(4633,'வடிவீஸ்வரம் வடக்கு நகரம்',88,1),(4634,'வடிவீஸ்வரம் தெற்கு நகரம்',88,1),(4635,'வேம்பனூர் கிழக்கு',88,1),(4636,'வேம்பனூர் மேற்கு',88,1),(4637,'ஆத்திவிளை',89,1),(4638,'ஆளூர் அ',89,1),(4639,'ஆளூர் ஆ',89,1),(4640,'சடையமங்கலம்',89,1),(4641,'செம்பொன்விளை',89,1),(4642,'குளச்சல் அ',89,1),(4643,'குளச்சல் ஆ',89,1),(4644,'இரணியல்',89,1),(4645,'கடியப்பட்டினம்',89,1),(4646,'கக்கோட்டுதலை',89,1),(4647,'கல்குளம்',89,1),(4648,'கல்லுக்கூட்டம்',89,1),(4649,'கப்பியறை அ',89,1),(4650,'கப்பியறை ஆ',89,1),(4651,'கோதநல்லூர்',89,1),(4652,'குமாரபுரம்',89,1),(4653,'குருந்தன்கோடு அ',89,1),(4654,'குருந்தன்கோடு ஆ',89,1),(4655,'லெட்சுமிபுரம்',89,1),(4656,'மணவாளக்குறிச்சி',89,1),(4657,'மருதூர்குறிச்சி',89,1),(4658,'மண்டைக்காடு',89,1),(4659,'முளகுமூடு',89,1),(4660,'முத்தலகுறிச்சி',89,1),(4661,'நெய்யூர்',89,1),(4662,'நுள்ளிவிளை அ',89,1),(4663,'நுள்ளிவிளை ஆ',89,1),(4664,'பத்மநாபபுரம் அ',89,1),(4665,'பத்மநாபபுரம் ஆ',89,1),(4666,'ரீத்தாபுரம்',89,1),(4667,'சைமன்காலனி',89,1),(4668,'தலக்குளம்',89,1),(4669,'திக்கணங்கோடு',89,1),(4670,'திங்கள்நகர்',89,1),(4671,'திருவிதாங்கோடு',89,1),(4672,'தக்கலை',89,1),(4673,'வாழ்வச்சகோஷ்டம் அ',89,1),(4674,'வாழ்வச்சகோஷ்டம் ஆ',89,1),(4675,'வேளிமலை',89,1),(4676,'வெள்ளிசந்தை அ',89,1),(4677,'வெள்ளிசந்தை ஆ',89,1),(4678,'வெள்ளிமலை',89,1),(4679,'வில்லுக்குறி அ',89,1),(4680,'வில்லுக்குறி ஆ',89,1),(4681,'வில்லுக்குறி இ',89,1),(4682,'அடைக்காகுழி',90,1),(4683,'ஆறுதேசம்',90,1),(4684,'அதங்கோடு',90,1),(4685,'சூழால்',90,1),(4686,'இனயம்புத்தன்துறை',90,1),(4687,'ஏழுதேசம் அ',90,1),(4688,'ஏழுதேசம் ஆ',90,1),(4689,'ஏழுதேசம் இ',90,1),(4690,'கருங்கல்',90,1),(4691,'கீழ்குளம் அ',90,1),(4692,'கீழ்குளம் ஆ',90,1),(4693,'கீழ்மிடாலம் அ',90,1),(4694,'கீழ்மிடாலம் ஆ',90,1),(4695,'கிள்ளியூர் அ',90,1),(4696,'கிள்ளியூர் ஆ',90,1),(4697,'கொல்லங்கோடு அ',90,1),(4698,'கொல்லங்கோடு ஆ',90,1),(4699,'குளப்புறம்',90,1),(4700,'மத்திகோடு',90,1),(4701,'மெதுகும்மல்',90,1),(4702,'மிடாலம் அ',90,1),(4703,'மிடாலம் ஆ',90,1),(4704,'முள்ளங்கினாவிளை',90,1),(4705,'முஞ்சிறை',90,1),(4706,'பைங்குளம்',90,1),(4707,'பாலூர்',90,1),(4708,'தேங்காய்பட்டணம்',90,1),(4709,'அருவிக்கரை',91,1),(4710,'ஆற்றூர்',91,1),(4711,'அயக்கோடு',91,1),(4712,'செறுகோல்',91,1),(4713,'சுருளகோடு',91,1),(4714,'கண்ணனூர்',91,1),(4715,'குலசேகரம் அ',91,1),(4716,'குலசேகரம் ஆ',91,1),(4717,'குமரன்குடி',91,1),(4718,'மேக்கோடு',91,1),(4719,'பேச்சிப்பாறை',91,1),(4720,'பெருஞ்சாணி',91,1),(4721,'பொன்மனை அ',91,1),(4722,'பொன்மனை ஆ',91,1),(4723,'திற்பரப்பு',91,1),(4724,'திருவட்டார்',91,1),(4725,'தும்பகோடு ஆ',91,1),(4726,'தும்பகோடு அ',91,1),(4727,'வீயன்னூர் ஆ',91,1),(4728,'வீயன்னூர் அ',91,1),(4729,'ஏற்றக்கோடு',91,1),(4730,'அனந்தபுரம்',92,1),(4731,'ஆரல்வாய்மொழி வடக்கு',92,1),(4732,'ஆரல்வாய்மொழி தெற்கு',92,1),(4733,'அருமநல்லூர்',92,1),(4734,'அழகியபாண்டியபுரம்',92,1),(4735,'பூதப்பாண்டி',92,1),(4736,'சிறமடம்',92,1),(4737,'தெரிசனங்கோப்பு',92,1),(4738,'இறச்சகுளம்',92,1),(4739,'ஈசாந்திமங்கலம் வடக்கு',92,1),(4740,'ஈசாந்திமங்கலம் தெற்கு',92,1),(4741,'ஞாலம்',92,1),(4742,'காட்டுப்புதூர்',92,1),(4743,'குமாரபுரம்',92,1),(4744,'மாதவலாயம்',92,1),(4745,'நாவல்காடு',92,1),(4746,'சண்முகபுரம்',92,1),(4747,'செண்பகராமன்புதூர்',92,1),(4748,'தடிக்காரன்கோணம்',92,1),(4749,'தாழக்குடி',92,1),(4750,'திடல்',92,1),(4751,'தோவாளை',92,1),(4752,'திருப்பதிசாரம்',92,1),(4753,'வீரமார்தாண்டன்புதூர்',92,1),(4754,'அண்டுக்கோடு அ',93,1),(4755,'அண்டுக்கோடு ஆ',93,1),(4756,'அருமனை',93,1),(4757,'சிதறால்',93,1),(4758,'தேவிக்கோடு',93,1),(4759,'இடைக்கோடு',93,1),(4760,'கடையால்',93,1),(4761,'களியக்காவிளை',93,1),(4762,'களியல்',93,1),(4763,'கொல்லஞ்சி',93,1),(4764,'குன்னத்தூர்',93,1),(4765,'குழித்துறை நகரம்',93,1),(4766,'மலையடி',93,1),(4767,'மாங்கோடு',93,1),(4768,'மஞ்சாலுமூடு',93,1),(4769,'மருந்தங்கோடு',93,1),(4770,'முழுக்கோடு',93,1),(4771,'நல்லூர்',93,1),(4772,'நட்டாலம் அ',93,1),(4773,'நட்டாலம் ஆ',93,1),(4774,'பாகோடு அ',93,1),(4775,'பாகோடு ஆ',93,1),(4776,'பளுகல்',93,1),(4777,'புலியூர்சாலை',93,1),(4778,'உண்ணாமலைக்கடை',93,1),(4779,'வெள்ளாம்கோடு',93,1),(4780,'விளாத்துறை',93,1),(4781,'விளவங்கோடு',93,1),(4782,'Alamarathupatti',94,1),(4783,'Ammapatti',94,1),(4784,'Anjakoundanpatti',94,1),(4785,'Aravakurichi',94,1),(4786,'Ariyur',94,1),(4787,'Chinnadarapuram',94,1),(4788,'Cudalore East Bit 1',94,1),(4789,'Cudalore East Bit 2',94,1),(4790,'Cudalore West',94,1),(4791,'Elavanur',94,1),(4792,'Erumarpatti',94,1),(4793,'Esanatham',94,1),(4794,'Inuganur',94,1),(4795,'Kodaiyur',94,1),(4796,'Kodanthur North',94,1),(4797,'Kodanthur South',94,1),(4798,'Modakkur East',94,1),(4799,'Modakkur West',94,1),(4800,'Nadanthai North',94,1),(4801,'Nadanthai South',94,1),(4802,'Nagampalli',94,1),(4803,'Nanjaikalakurichi',94,1),(4804,'P.Anaipalayam',94,1),(4805,'Pallapatti',94,1),(4806,'Periyamanjuvelli',94,1),(4807,'Pungambadi East',94,1),(4808,'Pungambadi West',94,1),(4809,'Punjaikalakurichi',94,1),(4810,'Rajapuram',94,1),(4811,'Santhapadi',94,1),(4812,'Senthamangalam East',94,1),(4813,'Senthamangalam West',94,1),(4814,'Sudamani',94,1),(4815,'T.Venkatapuram',94,1),(4816,'Thethupatti',94,1),(4817,'Thokkupatti',94,1),(4818,'Thumbivadi',94,1),(4819,'Velampadi',94,1),(4820,'Venjamangoodalureast',94,1),(4821,'Venjamangoodalurwest',94,1),(4822,'Aathanur',95,1),(4823,'D.Edayapatti (E)',95,1),(4824,'D.Edayapatti(W)',95,1),(4825,'Devarmalai',95,1),(4826,'Kalayapatti',95,1),(4827,'Keelapaguthi',95,1),(4828,'Keranur',95,1),(4829,'Kosoor',95,1),(4830,'Manjanaikanpatti',95,1),(4831,'Mathagiri',95,1),(4832,'Mavathur',95,1),(4833,'Melepaguthi',95,1),(4834,'Mullipadi',95,1),(4835,'Palaviduthi',95,1),(4836,'Pannapatti',95,1),(4837,'Pappayampadi',95,1),(4838,'Sembiyanatham',95,1),(4839,'Thennilai',95,1),(4840,'Thondamanginam',95,1),(4841,'Vadavampadi',95,1),(4842,'Valvarmangalam',95,1),(4843,'Varavanai',95,1),(4844,'Velapatti',95,1),(4845,'Achimangalam',96,1),(4846,'Baganatham',96,1),(4847,'Balambalpuram',96,1),(4848,'Emoor',96,1),(4849,'Jegadabi',96,1),(4850,'K.Pitchampatti',96,1),(4851,'Kakkavadi',96,1),(4852,'Karur',96,1),(4853,'L.N.Samudram',96,1),(4854,'Manavaddi',96,1),(4855,'Melapalayam',96,1),(4856,'Mookanakurichi',96,1),(4857,'Puliyur',96,1),(4858,'Puthampur',96,1),(4859,'Sanapiratti',96,1),(4860,'Thanthoni',96,1),(4861,'Thirumanilayur',96,1),(4862,'Thoranakalpatti',96,1),(4863,'Uppidamangalam East',96,1),(4864,'Uppidamangalam West',96,1),(4865,'Velliyanai North',96,1),(4866,'Velliyanai South',96,1),(4867,'Balarajapuram',97,1),(4868,'Chindalavadi',97,1),(4869,'Chithalavai',97,1),(4870,'Kallapalli',97,1),(4871,'Kammanallur',97,1),(4872,'Karupathur',97,1),(4873,'Krishnarayapuram(N)',97,1),(4874,'Krishnarayapuram(S)',97,1),(4875,'Mahathanapuram North',97,1),(4876,'Mahathanapuram South',97,1),(4877,'Manavasi',97,1),(4878,'Mayanoor',97,1),(4879,'Muthurengampatti',97,1),(4880,'Panchapatti',97,1),(4881,'Pappakappatti',97,1),(4882,'Pillapalayam',97,1),(4883,'Pothurauthanpatti',97,1),(4884,'Renganathapuram(N)',97,1),(4885,'Renganathapuram(S)',97,1),(4886,'Sengal',97,1),(4887,'Sivayam(N)',97,1),(4888,'Sivayam(S)',97,1),(4889,'Thirukampuliyur',97,1),(4890,'Vayaloor',97,1),(4891,'Veeriyapalayam',97,1),(4892,'Aalathur',98,1),(4893,'Chiniyampalayam',98,1),(4894,'Earaniyamangalam',98,1),(4895,'Gudalur',98,1),(4896,'Inungur',98,1),(4897,'Kadambarkoil',98,1),(4898,'Kalladai',98,1),(4899,'Kallai',98,1),(4900,'Kaluhoor',98,1),(4901,'Karuvapanaikanpettai',98,1),(4902,'Kulithalai',98,1),(4903,'Kumaramangalam',98,1),(4904,'Manathattai',98,1),(4905,'Maruthoor North-1',98,1),(4906,'Maruthoor North-2',98,1),(4907,'Maruthoor South - 1',98,1),(4908,'Maruthoor South - 2',98,1),(4909,'Muthalaipatti',98,1),(4910,'Nahanoor',98,1),(4911,'Nallur',98,1),(4912,'Nangavaram(N)-I',98,1),(4913,'Nangavaram(N)-Ii',98,1),(4914,'Nangavaram(S)-I',98,1),(4915,'Nangavaram(S)-Ii',98,1),(4916,'Neithalur(North)',98,1),(4917,'Neithalur(South)',98,1),(4918,'Pathiripatti',98,1),(4919,'Pillur',98,1),(4920,'Porundaloor',98,1),(4921,'Poyyamani',98,1),(4922,'Puluderi',98,1),(4923,'Puthur',98,1),(4924,'Rachandarthirumalai',98,1),(4925,'Rajendrem North',98,1),(4926,'Rajendrem South',98,1),(4927,'Sathiyamangalam',98,1),(4928,'Sepalapatti',98,1),(4929,'Suriyanur',98,1),(4930,'Thalinji',98,1),(4931,'Thogamalai',98,1),(4932,'Uthupatti',98,1),(4933,'Vadaseri',98,1),(4934,'Vaigainallur North',98,1),(4935,'Vaigainallur South',98,1),(4936,'Vathiyam',98,1),(4937,'Achamapuram',99,1),(4938,'Andankoil East',99,1),(4939,'Andankoil West',99,1),(4940,'Appipalayam',99,1),(4941,'Athur',99,1),(4942,'Kadamban Kurichi (Nanjai)',99,1),(4943,'Kadambankurichi(Punjai)',99,1),(4944,'Kadaparai',99,1),(4945,'Karuppampalayam',99,1),(4946,'Koyampalli',99,1),(4947,'Kuppuchipalayam',99,1),(4948,'Manmangalam',99,1),(4949,'Minnampall',99,1),(4950,'Nanniyur',99,1),(4951,'Nerur North',99,1),(4952,'Nerur South',99,1),(4953,'Pallapalayam',99,1),(4954,'Panchamadevi',99,1),(4955,'Somur',99,1),(4956,'Thallapatti',99,1),(4957,'Vangal',99,1),(4958,'Anjur',100,1),(4959,'Athipalayam',100,1),(4960,'E.R.Puram',100,1),(4961,'K.Paramathi',100,1),(4962,'Karudayampalayam',100,1),(4963,'Karvazhi',100,1),(4964,'Kombupalayam',100,1),(4965,'Kuppam',100,1),(4966,'Monjanur East',100,1),(4967,'Monjanur West',100,1),(4968,'Munnur',100,1),(4969,'Nedungur',100,1),(4970,'Pavithram',100,1),(4971,'Pugalur Nanjai',100,1),(4972,'Punjaipugalur North',100,1),(4973,'Punjaipugalur South',100,1),(4974,'Punnam',100,1),(4975,'Thennilai (East)',100,1),(4976,'Thennilai (South)',100,1),(4977,'Thennilai (West)',100,1),(4978,'Thirukattuthurai',100,1),(4979,'Thotakurichi Nanjai',100,1),(4980,'Thotakurichi Punjai',100,1),(4981,'Thukkachi',100,1),(4982,'Vettamangalam East',100,1),(4983,'Vettamangalam West',100,1),(4984,'Viswanathapuri',100,1),(4985,'Anchetti East',101,1),(4986,'Anchetti West',101,1),(4987,'Doddamanchi',101,1),(4988,'Kottaiyur',101,1),(4989,'Madakkal',101,1),(4990,'Manchugondapalli',101,1),(4991,'Natrampalayam',101,1),(4992,'Taggatti',101,1),(4993,'Urigam Sakth',101,1),(4994,'Achchamangalam',102,1),(4995,'Aikondamkothapalle',102,1),(4996,'Balanayanipalli',102,1),(4997,'Bargur',102,1),(4998,'Batlapalli',102,1),(4999,'Bommepalli',102,1),(5000,'Chendrappalli',102,1),(5001,'Chigaralapalli',102,1),(5002,'Chinnamatarapalli',102,1),(5003,'Chinnathimminayanapalli',102,1),(5004,'Guruvinayanapalli',102,1),(5005,'Jegadevipalayam',102,1),(5006,'Kannandahalli',102,1),(5007,'Kondappanayanapalli',102,1),(5008,'Kuttur',102,1),(5009,'Madepalli',102,1),(5010,'Mallappadi',102,1),(5011,'Masjidgollahalli',102,1),(5012,'Modikuppam',102,1),(5013,'Nagampatti',102,1),(5014,'Oppathavadi',102,1),(5015,'Orappam',102,1),(5016,'Palapalle',102,1),(5017,'Pasinayanapalli',102,1),(5018,'Pichukondanahalli',102,1),(5019,'Puligunta',102,1),(5020,'Salinayanipalli',102,1),(5021,'Sevvampatti',102,1),(5022,'Sulamalai',102,1),(5023,'Varattanapalli',102,1),(5024,'Achchubalu',103,1),(5025,'Agalakotta',103,1),(5026,'Andevanapalli',103,1),(5027,'Anegollu',103,1),(5028,'Anniyalam',103,1),(5029,'Arasakuppam',103,1),(5030,'Arupalli Agraharam',103,1),(5031,'Avaripalli',103,1),(5032,'Ballapalli',103,1),(5033,'Belagondapalli',103,1),(5034,'Bettamugulalam',103,1),(5035,'Bevunatham',103,1),(5036,'Bilalam',103,1),(5037,'Binnamangalam',103,1),(5038,'Biramangalam',103,1),(5039,'Bithereddi',103,1),(5040,'Bodichipalli',103,1),(5041,'Chikka Avarepalli',103,1),(5042,'Chudasandiram',103,1),(5043,'Daravendiram',103,1),(5044,'Denkanikotta',103,1),(5045,'Devaganapalli',103,1),(5046,'Doddaubbanur',103,1),(5047,'Echanahalli',103,1),(5048,'Erudukotta',103,1),(5049,'Gumalapuram',103,1),(5050,'Hanumanthapuram',103,1),(5051,'Hosapuram',103,1),(5052,'Jagirkarupalli',103,1),(5053,'Jakkeri',103,1),(5054,'Jawlagiri',103,1),(5055,'Kakkadasam Agraharam',103,1),(5056,'Kalugondapalli',103,1),(5057,'Karandapalli',103,1),(5058,'Karukkanahalli',103,1),(5059,'Kasi Agraharam',103,1),(5060,'Kelamangalam',103,1),(5061,'Kempatti',103,1),(5062,'Kodiyalam',103,1),(5063,'Kolatti',103,1),(5064,'Komaranapalli',103,1),(5065,'Kottamadugu',103,1),(5066,'Kottur',103,1),(5067,'Kunchena Agraharam',103,1),(5068,'Kundumaranapalli',103,1),(5069,'Kuppatti',103,1),(5070,'Mallasandiram',103,1),(5071,'Malligarjunadurgam',103,1),(5072,'Maradanapalli',103,1),(5073,'Marupalli',103,1),(5074,'Mathagondapalli',103,1),(5075,'Muthnahalli',103,1),(5076,'Nagamangalam',103,1),(5077,'Nagappan Agraharam',103,1),(5078,'Nallur',103,1),(5079,'Nandimangalam',103,1),(5080,'Nellumaru Agraharam',103,1),(5081,'Noganoor',103,1),(5082,'Odayandahalli',103,1),(5083,'Pachchapanatti',103,1),(5084,'Palayamkotta',103,1),(5085,'Peddamadagondapalli',103,1),(5086,'Pillari Agraharam',103,1),(5087,'Ratnagiri',103,1),(5088,'Rayakottah',103,1),(5089,'Salivaram',103,1),(5090,'Sangita Agraharam',103,1),(5091,'Santhanapalli',103,1),(5092,'Saragapalli',103,1),(5093,'Sarandapalli',103,1),(5094,'Sathanoor',103,1),(5095,'Sengodachinnahalli',103,1),(5096,'Settipalli',103,1),(5097,'Suligunta',103,1),(5098,'T.Gollahalli',103,1),(5099,'Thalikothanur',103,1),(5100,'Thalli',103,1),(5101,'Thandarai',103,1),(5102,'Thavarakarai',103,1),(5103,'Thimijepalli',103,1),(5104,'Thogarai Agraharam',103,1),(5105,'Udedurgam',103,1),(5106,'Ulimangalam',103,1),(5107,'Ulimaranapalli',103,1),(5108,'Unisenatham',103,1),(5109,'Achettipalli',104,1),(5110,'Aduvanapalle',104,1),(5111,'Alasapalli',104,1),(5112,'Alenattam',104,1),(5113,'Alur',104,1),(5114,'Alur',104,1),(5115,'Anumepalli',104,1),(5116,'Attur',104,1),(5117,'Attur',104,1),(5118,'Avalapalli',104,1),(5119,'Badathepalli',104,1),(5120,'Bagalur',104,1),(5121,'Baliganapalli',104,1),(5122,'Battavarapalli',104,1),(5123,'Begaipalli',104,1),(5124,'Belathur',104,1),(5125,'Boblapuram',104,1),(5126,'Chennasandiram',104,1),(5127,'Chennathur',104,1),(5128,'Chennathur (N)',104,1),(5129,'Chinnakullu',104,1),(5130,'Chokkarasanapalli',104,1),(5131,'Dasapalli',104,1),(5132,'Deveripalli',104,1),(5133,'Dhinnapalli',104,1),(5134,'Eachangur',104,1),(5135,'Eluvapalle',104,1),(5136,'Gobanapalli',104,1),(5137,'Govindaagraharam',104,1),(5138,'Hosur',104,1),(5139,'Hosur Urban',104,1),(5140,'Idipalle',104,1),(5141,'Jimangalam',104,1),(5142,'Kadiringanadinna',104,1),(5143,'Kaganur',104,1),(5144,'Kalasamanapalli',104,1),(5145,'Kalasthipuram',104,1),(5146,'Kalliagraharam',104,1),(5147,'Kallipuram',104,1),(5148,'Kanimangalam',104,1),(5149,'Karibasanapuram',104,1),(5150,'Karupallle',104,1),(5151,'Kelavarapalli',104,1),(5152,'Kembasandiram',104,1),(5153,'Kodiyalam',104,1),(5154,'Koladasapuram',104,1),(5155,'Kothakondapalli',104,1),(5156,'Kottapalli',104,1),(5157,'Kusanapalli',104,1),(5158,'Lingapuram',104,1),(5159,'Mallasandiram',104,1),(5160,'Mathigiri',104,1),(5161,'Moranapalli',104,1),(5162,'Motham Agraharam',104,1),(5163,'Mugalapalle',104,1),(5164,'Mugalur',104,1),(5165,'Mukondapalli',104,1),(5166,'Murtiganadinna',104,1),(5167,'Muthalli',104,1),(5168,'Muthganapalli',104,1),(5169,'Muthuganapalli',104,1),(5170,'Nagondapalli',104,1),(5171,'Naligabettamagraharam',104,1),(5172,'Nallur',104,1),(5173,'Nandimangalam',104,1),(5174,'Nanjapuram',104,1),(5175,'Nariganapuram',104,1),(5176,'Oddapalli',104,1),(5177,'Oddapallidinna',104,1),(5178,'Onnalavadi',104,1),(5179,'Palavanapalli',104,1),(5180,'Panchakshipuram',104,1),(5181,'Peddakullu',104,1),(5182,'Peddamuttali',104,1),(5183,'Pichchugondapalli',104,1),(5184,'Poonapalli',104,1),(5185,'Punakandoddi',104,1),(5186,'Puram',104,1),(5187,'Rangopanditaagraharam',104,1),(5188,'Santhapuram',104,1),(5189,'Sevaganapalli',104,1),(5190,'Siddanapalli',104,1),(5191,'Singasadanapalli',104,1),(5192,'Sokkanadhapuram',104,1),(5193,'Sudagondapalli',104,1),(5194,'Tattaginapalli',104,1),(5195,'Thorapalliagraharam',104,1),(5196,'Thummanapalli',104,1),(5197,'Vathiripalli ( P)',104,1),(5198,'Vattiripalli',104,1),(5199,'Visvanathapuram',104,1),(5200,'Zuzuvadi',104,1),(5201,'Agaram',105,1),(5202,'Agasipalli',105,1),(5203,'Alappatti',105,1),(5204,'Appinayakkankottai',105,1),(5205,'Ariyanapalli',105,1),(5206,'Arrahalli - 2',105,1),(5207,'Avalnattam',105,1),(5208,'Baiyanapalli',105,1),(5209,'Balaguli - 2',105,1),(5210,'Balanapalle',105,1),(5211,'Balekuli',105,1),(5212,'Bannihalli',105,1),(5213,'Bathimadugu',105,1),(5214,'Bellampalli',105,1),(5215,'Bellarapalli',105,1),(5216,'Billanakuppam',105,1),(5217,'Bimandapalli',105,1),(5218,'Boganapalli',105,1),(5219,'Bommarasanapalle',105,1),(5220,'Budimutlu',105,1),(5221,'Chaparthi',105,1),(5222,'Chennasandiram',105,1),(5223,'Chickkapuvathi',105,1),(5224,'Chigaralapalli',105,1),(5225,'Chinnakottur',105,1),(5226,'Chowtahalli',105,1),(5227,'Dandegoundanahalli',105,1),(5228,'Dasegaunipalli',105,1),(5229,'Dasiripalli',105,1),(5230,'Devarakundani',105,1),(5231,'Devasamudram',105,1),(5232,'Doddakanama',105,1),(5233,'Ebbari',105,1),(5234,'Edayarapalle',105,1),(5235,'Errahalli',105,1),(5236,'Ettipalle',105,1),(5237,'Ettipallitalav',105,1),(5238,'Gangaleri',105,1),(5239,'Gangamadugu',105,1),(5240,'Gollappalle',105,1),(5241,'Gollappalle',105,1),(5242,'Guliyam',105,1),(5243,'Gundalapatti - 2',105,1),(5244,'Guntapalle',105,1),(5245,'Halekrishnapuram',105,1),(5246,'Halekundani',105,1),(5247,'Idippalle',105,1),(5248,'Idippalle',105,1),(5249,'Jagadab',105,1),(5250,'Jinjupalli',105,1),(5251,'Kadavarappalle',105,1),(5252,'Kallugurikki',105,1),(5253,'Kammampalle',105,1),(5254,'Karadihalli',105,1),(5255,'Kariyasagaramtalav',105,1),(5256,'Kasiriganappalli',105,1),(5257,'Katheri',105,1),(5258,'Katheri - 2',105,1),(5259,'Kattiganapalli',105,1),(5260,'Kattinayanapalle',105,1),(5261,'Kattiripalle',105,1),(5262,'Kaveripatnam',105,1),(5263,'Kaveripatnam - 2',105,1),(5264,'Kodipalli',105,1),(5265,'Kompalli',105,1),(5266,'Kondapalli',105,1),(5267,'Kondappanayakanapalli',105,1),(5268,'Konganapalli',105,1),(5269,'Kothigutlapalli',105,1),(5270,'Kottapeta',105,1),(5271,'Krishnagiri',105,1),(5272,'Krishnappanaickanpodur',105,1),(5273,'Kundalapatti',105,1),(5274,'Kundarappalli',105,1),(5275,'Kuppachiparai',105,1),(5276,'Kurubarapalli',105,1),(5277,'Lakkabattalapalli',105,1),(5278,'Madepalli',105,1),(5279,'Manavaranapalli',105,1),(5280,'Marasandiram',105,1),(5281,'Marichettyhalli - 2',105,1),(5282,'Marigampalli',105,1),(5283,'Marisettihalli',105,1),(5284,'Mettahalli - 2',105,1),(5285,'Mittahalli',105,1),(5286,'Mottur',105,1),(5287,'Nachchikuppam',105,1),(5288,'Naduvanapalli',105,1),(5289,'Nallur',105,1),(5290,'Naralapalle',105,1),(5291,'Neralagiri',105,1),(5292,'Nimmalavadi',105,1),(5293,'Oddappalli',105,1),(5294,'Paiyur',105,1),(5295,'Pandikurikki',105,1),(5296,'Pannapalli',105,1),(5297,'Peddanapalli',105,1),(5298,'Peddatalapalli',105,1),(5299,'Pennaswaramatam',105,1),(5300,'Pennaswaramatam - 2',105,1),(5301,'Periamuthur - 2',105,1),(5302,'Periyamuthur',105,1),(5303,'Piyur - 2',105,1),(5304,'Polupalli',105,1),(5305,'Ponnappagaunipalle',105,1),(5306,'Puliyancheri',105,1),(5307,'Puram',105,1),(5308,'Ragimakanapalli',105,1),(5309,'Ragimakanapalli',105,1),(5310,'Sembadamuttur',105,1),(5311,'Sigaramaganapalli',105,1),(5312,'Singiripalli',105,1),(5313,'Siranapalle',105,1),(5314,'Sokkadi',105,1),(5315,'Sowtahalli - 2',105,1),(5316,'Sulamalai',105,1),(5317,'Sundekuppam',105,1),(5318,'Sundekuppam - 2',105,1),(5319,'Talihalli',105,1),(5320,'Talippalle',105,1),(5321,'Tankadikuppam',105,1),(5322,'Tatarahalli',105,1),(5323,'Tatatarai',105,1),(5324,'Thalihalli - 2',105,1),(5325,'Thimmapuram - 2',105,1),(5326,'Timmapuram',105,1),(5327,'Tirtam',105,1),(5328,'Undiganattam',105,1),(5329,'Velagalahalli',105,1),(5330,'Veppanapalli',105,1),(5331,'Verupasandiram',105,1),(5332,'Alerahalli',106,1),(5333,'Balethottam',106,1),(5334,'Barur',106,1),(5335,'Batrahalli',106,1),(5336,'Bendarahalli',106,1),(5337,'Bendarahalli-1',106,1),(5338,'Chellakuttapatti',106,1),(5339,'Damodarahalli',106,1),(5340,'Gendigampatti',106,1),(5341,'Jambukuttappatti',106,1),(5342,'Jingahathirampatti-1',106,1),(5343,'Jinkalakadirampatti',106,1),(5344,'Kattagaram',106,1),(5345,'Kilkuppam',106,1),(5346,'Kodappasandampatti',106,1),(5347,'Kondireddipatti',106,1),(5348,'Kottaippatti',106,1),(5349,'Kudimenahalli',106,1),(5350,'Mahadevagollahalli',106,1),(5351,'Marappanaickanpatti',106,1),(5352,'Maruderi',106,1),(5353,'Mattinayakkanpatti',106,1),(5354,'Mookampatti',106,1),(5355,'Nagojanahalli',106,1),(5356,'Pannandur',106,1),(5357,'Parandapalli',106,1),(5358,'Peddappampatti',106,1),(5359,'Puliyampatti',106,1),(5360,'ரங்கம்பட்டி',106,1),(5361,'Sonarahalli',106,1),(5362,'Tadampatti',106,1),(5363,'Thimminaikempatti',106,1),(5364,'Vadamalampatti',106,1),(5365,'Vadamangalam',106,1),(5366,'Veppalampatti',106,1),(5367,'Vilangamudai',106,1),(5368,'Viramalai R',106,1),(5369,'A.Settipalli',107,1),(5370,'Addagurukki',107,1),(5371,'Agaram Agraharam',107,1),(5372,'Amuthukondapalli',107,1),(5373,'Angondapalli',107,1),(5374,'Angondapalli (S)',107,1),(5375,'Athimugam',107,1),(5376,'Ayarnapalli',107,1),(5377,'B.Kurubarapalli',107,1),(5378,'B.S.Thimmasandiram',107,1),(5379,'Balagundarayandurgam',107,1),(5380,'Bedapalle',107,1),(5381,'Beerepalli',107,1),(5382,'Berigai',107,1),(5383,'Bikkanapalli',107,1),(5384,'Bukkanakkanapalli',107,1),(5385,'Bukkasagaram',107,1),(5386,'Bukkasagaram (A)',107,1),(5387,'Chennappalli',107,1),(5388,'Chinnabalinaikkanpalayam',107,1),(5389,'Chinnakudibala',107,1),(5390,'Chinnarandhoddi',107,1),(5391,'Chokkapuram',107,1),(5392,'Devaraguddapalli',107,1),(5393,'Dhoripalli',107,1),(5394,'Doddegavunipalli',107,1),(5395,'Doddur',107,1),(5396,'Eluvapalli (Berigai)',107,1),(5397,'Enusonai',107,1),(5398,'Errandapalli',107,1),(5399,'Gedalandoddi',107,1),(5400,'Gudusalapalli',107,1),(5401,'Gundalappalli',107,1),(5402,'Halekotta',107,1),(5403,'Hosahalli',107,1),(5404,'Hosahalli (U)',107,1),(5405,'Immidinaikkanahalli',107,1),(5406,'Kalingavaram',107,1),(5407,'Kamandhoddi',107,1),(5408,'Karikalupalli',107,1),(5409,'Kariyasandiram',107,1),(5410,'Kattinaikkandhoddi',107,1),(5411,'Kodikathimmannapalli',107,1),(5412,'Kollappalli',107,1),(5413,'Kottasadanapalli',107,1),(5414,'Kudisadanapalli',107,1),(5415,'Kullu',107,1),(5416,'Kumbalam',107,1),(5417,'Mahadevapuram',107,1),(5418,'Malakalakki',107,1),(5419,'Mallanakottur',107,1),(5420,'Mallasandiram',107,1),(5421,'Marandapalli',107,1),(5422,'Marudhandapalli',107,1),(5423,'Mathinayakkanpalayam',107,1),(5424,'Mattampalli',107,1),(5425,'Meenandoddi',107,1),(5426,'Melumalai',107,1),(5427,'Mettubandanapalli',107,1),(5428,'Midithepalli',107,1),(5429,'Muduppinayakanpalayam',107,1),(5430,'Mutturayanipudur',107,1),(5431,'Nallakanakothapalli',107,1),(5432,'Nerigam',107,1),(5433,'Pannapalli',107,1),(5434,'Pasthalapalli',107,1),(5435,'Pattagurubarapalli',107,1),(5436,'Pattagurubarapalli (P)',107,1),(5437,'Peddchigarlapalli',107,1),(5438,'Podur',107,1),(5439,'Ramandoddi',107,1),(5440,'Sahadevapuram',107,1),(5441,'Sammanapalli',107,1),(5442,'Sanamavu',107,1),(5443,'Saprapalli',107,1),(5444,'Seekkalapalli',107,1),(5445,'Seekkanapalli',107,1),(5446,'Seluvandoddi',107,1),(5447,'Sembarsanapalli',107,1),(5448,'Shoolagiri',107,1),(5449,'Shoolagiri (T)',107,1),(5450,'Sorakayalupalli',107,1),(5451,'Subbagiri',107,1),(5452,'Suligunda',107,1),(5453,'Thiyagarasanapalli',107,1),(5454,'Thiyarana Durgam',107,1),(5455,'Thuppuganapalli',107,1),(5456,'Uddanapalli',107,1),(5457,'Ulagam',107,1),(5458,'Ullatti',107,1),(5459,'Vanamangalam',107,1),(5460,'Venkatesapuram',107,1),(5461,'Ammiyampatti',108,1),(5462,'Anandur',108,1),(5463,'Andipatti',108,1),(5464,'Andiyur',108,1),(5465,'Appinaickampatti',108,1),(5466,'Arunapathi',108,1),(5467,'Athippadi',108,1),(5468,'Athiveeriyampatti',108,1),(5469,'Badappalli',108,1),(5470,'Bommadasampatti',108,1),(5471,'Bommampatti',108,1),(5472,'Burgalapalli',108,1),(5473,'Chandrapatti',108,1),(5474,'Chennappanaickanur',108,1),(5475,'Chinnakunnathur',108,1),(5476,'Chinnathagarapatti',108,1),(5477,'Chinnathallappadi',108,1),(5478,'Dasampatti',108,1),(5479,'Eggoor',108,1),(5480,'Elachiyur',108,1),(5481,'Elavambadi',108,1),(5482,'Ettipatty',108,1),(5483,'Garigepalli',108,1),(5484,'Gendiganur',108,1),(5485,'Gengaberampatti',108,1),(5486,'Genginaickanpatti',108,1),(5487,'Giddampatti',108,1),(5488,'Gollapatti',108,1),(5489,'Gollapatti',108,1),(5490,'Gollapatti (Pasanti)',108,1),(5491,'Govindapuram',108,1),(5492,'Gurubaravalasai',108,1),(5493,'Hanumantheertham',108,1),(5494,'Iluppaikuttaippatti',108,1),(5495,'Inamkattuppatti',108,1),(5496,'K Ettipatty',108,1),(5497,'K Papparappatti',108,1),(5498,'Kadhavani',108,1),(5499,'Kadirampatti',108,1),(5500,'Kalluganur',108,1),(5501,'Kaludaipatti',108,1),(5502,'Kamakshipatti',108,1),(5503,'Kanakkampatti',108,1),(5504,'Kanampatti',108,1),(5505,'Kanganur',108,1),(5506,'Kanichi',108,1),(5507,'Kanjanur',108,1),(5508,'Karappattu',108,1),(5509,'Kariyaperumalvalasai',108,1),(5510,'Karukkampatti',108,1),(5511,'Karumandapathi',108,1),(5512,'Kattanur',108,1),(5513,'Katteri',108,1),(5514,'Kattusingiripatti',108,1),(5515,'Kedakaranur',108,1),(5516,'Kedhunaickanpatti',108,1),(5517,'Kilkuppam',108,1),(5518,'Kilmathur',108,1),(5519,'Kittampatti',108,1),(5520,'Kolinaickanpatti',108,1),(5521,'Kollanur',108,1),(5522,'Kollapatti',108,1),(5523,'Kommampattu',108,1),(5524,'Konampatti',108,1),(5525,'Kondampatti',108,1),(5526,'Koorakkupatti',108,1),(5527,'Kottappathi',108,1),(5528,'Kottarappatti',108,1),(5529,'Kottukkaranpatti',108,1),(5530,'Kullampathi',108,1),(5531,'Kullauganapalle',108,1),(5532,'Kumarampatti',108,1),(5533,'Kunampatti',108,1),(5534,'Kungilipatti',108,1),(5535,'Kunnathur',108,1),(5536,'Kuppanatham',108,1),(5537,'Kursampatti',108,1),(5538,'Kurugapatti',108,1),(5539,'Lakkampatti',108,1),(5540,'Maganurpatti',108,1),(5541,'Mallampatti',108,1),(5542,'Mallapuram',108,1),(5543,'Mallupatti',108,1),(5544,'Mannadipatti',108,1),(5545,'Marampatti',108,1),(5546,'Mettuthangal',108,1),(5547,'Meyyandappatti',108,1),(5548,'Mittappalli',108,1),(5549,'Moondrampatti',108,1),(5550,'Mottur',108,1),(5551,'Muchilikuttai',108,1),(5552,'Mukkarampalli',108,1),(5553,'Mungileri',108,1),(5554,'Murukkantal',108,1),(5555,'Murungipatti',108,1),(5556,'Muthampatti',108,1),(5557,'Naduppatti',108,1),(5558,'Naduppatti',108,1),(5559,'Nagalpatti',108,1),(5560,'Naickanur',108,1),(5561,'Naiperampatti',108,1),(5562,'Nallavampatti',108,1),(5563,'Naralappalli',108,1),(5564,'Narasampatti',108,1),(5565,'Nochchipatti',108,1),(5566,'Obakkavalasai',108,1),(5567,'Obilinaickanpatti',108,1),(5568,'Oddampatti',108,1),(5569,'Oddapatti',108,1),(5570,'Olaippatti',108,1),(5571,'Onnagarai',108,1),(5572,'Onnagarai',108,1),(5573,'Pachchanampatti',108,1),(5574,'Padadhasampatti',108,1),(5575,'Padadhasampatti',108,1),(5576,'Padavanur',108,1),(5577,'Palayakottai',108,1),(5578,'Palluthur',108,1),(5579,'Panamarathuppatti',108,1),(5580,'Papichettipatti',108,1),(5581,'Papparappatti',108,1),(5582,'Parasanur',108,1),(5583,'Pasandi',108,1),(5584,'Pavakkal',108,1),(5585,'Periyakottakulam',108,1),(5586,'Periyathallappadi',108,1),(5587,'Perumalkuppam',108,1),(5588,'Perumalnaickenpatti',108,1),(5589,'Peyanur',108,1),(5590,'Podar',108,1),(5591,'Ponnagarappatti',108,1),(5592,'Poorsampatti',108,1),(5593,'Poovampatti',108,1),(5594,'Potharajanpatti',108,1),(5595,'Puduppatti',108,1),(5596,'Pudur',108,1),(5597,'Pudur',108,1),(5598,'Pudurpunganai',108,1),(5599,'Puliyampatti',108,1),(5600,'Puliyampatti',108,1),(5601,'Puliyanur',108,1),(5602,'Pullavedampadhi',108,1),(5603,'Pungani',108,1),(5604,'Ramakrishnampathi',108,1),(5605,'Reddipatti',108,1),(5606,'Reddipatti',108,1),(5607,'Reddivalasai',108,1),(5608,'Rendattampatti',108,1),(5609,'Salamarathuppatti',108,1),(5610,'Samakavundanvalasai',108,1),(5611,'Samalpatti',108,1),(5612,'Savadiyur',108,1),(5613,'Selakkarampatti',108,1),(5614,'Sengalpatti',108,1),(5615,'Singarapettai',108,1),(5616,'Solakkapatti',108,1),(5617,'Soolagarai',108,1),(5618,'Sorakkappatti',108,1),(5619,'Sunnalampatti',108,1),(5620,'Tadanur',108,1),(5621,'Tagarappatti',108,1),(5622,'Tanneerpandal',108,1),(5623,'Thadinaickanpatti',108,1),(5624,'Thandiyappanur',108,1),(5625,'Theerthagirivalasai',108,1),(5626,'Thiruvanappatti',108,1),(5627,'Thurinjipatti',108,1),(5628,'Tippampatti',108,1),(5629,'Umaikavundanpatti',108,1),(5630,'Umaiyanur',108,1),(5631,'Upparappatti',108,1),(5632,'Uttangarai',108,1),(5633,'Vaduganur',108,1),(5634,'Vannanpatti',108,1),(5635,'Vaththiyanur',108,1),(5636,'Vedappatti',108,1),(5637,'Veerachikuppam',108,1),(5638,'Veeranakuppam',108,1),(5639,'Veeriyampatti',108,1),(5640,'Velampatti',108,1),(5641,'Vellalappatti',108,1),(5642,'Vellalappatti',108,1),(5643,'Venkatadhampatti',108,1),(5644,'Venkatapuram',108,1),(5645,'Veppalampatti',108,1),(5646,'A.Pudukulam',109,1),(5647,'Achchankulam',109,1),(5648,'Chinnaulagani',109,1),(5649,'Chitthur',109,1),(5650,'Idayanatham',109,1),(5651,'Illuppaikulam',109,1),(5652,'K.Vellakulam Bit 1',109,1),(5653,'K.Vellakulam Bit 2',109,1),(5654,'Kallanai',109,1),(5655,'Kalligudi Bit 1',109,1),(5656,'Kalligudi Bit 2',109,1),(5657,'Karisalkalampatti',109,1),(5658,'Karukkuvaipatti',109,1),(5659,'Kasipuram',109,1),(5660,'Keelanesaneri',109,1),(5661,'Kokkulancheri',109,1),(5662,'Koodakovil',109,1),(5663,'Kuraiyur Bit 1',109,1),(5664,'Kuraiyur Bit 2',109,1),(5665,'M Puliyangulam',109,1),(5666,'Maiyittanpatti',109,1),(5667,'Maruthangudi',109,1),(5668,'Melanesaneri',109,1),(5669,'Melauppilikkundu',109,1),(5670,'Nallamanaickanpatti',109,1),(5671,'Nedungulam',109,1),(5672,'Odaipatti',109,1),(5673,'Paraikkulam',109,1),(5674,'Peykulam',109,1),(5675,'S. Vellakulam',109,1),(5676,'Saluppapillaiyarnatham',109,1),(5677,'Sengappadai Bit 1',109,1),(5678,'Sengappadai Bit 2',109,1),(5679,'Sennampatti',109,1),(5680,'Sivarakkottai',109,1),(5681,'Sundarangundu',109,1),(5682,'Swamimallampatti',109,1),(5683,'T Arasapatti',109,1),(5684,'T.Kokkula',109,1),(5685,'Thennamanallur',109,1),(5686,'Thirumal',109,1),(5687,'Thumbakkulam',109,1),(5688,'Ulagani',109,1),(5689,'Valaiyankulam',109,1),(5690,'Veppangulam',109,1),(5691,'Villur Bit 1',109,1),(5692,'Villur Bit 2',109,1),(5693,'Alavanthan',110,1),(5694,'Ananjiyur',110,1),(5695,'Andaman',110,1),(5696,'Andarkottaram',110,1),(5697,'Angadimangalam Bit 1',110,1),(5698,'Angadimangalam Bit 2',110,1),(5699,'Appanthirupathi',110,1),(5700,'Arumbanur Bit 1',110,1),(5701,'Arumbanur Bit 2',110,1),(5702,'Athikulam',110,1),(5703,'Aylangudi',110,1),(5704,'Chettikulam',110,1),(5705,'Echaneri',110,1),(5706,'G.Pappankulam',110,1),(5707,'Idayapatti',110,1),(5708,'Ilamanur',110,1),(5709,'Ilandhaikulam',110,1),(5710,'Ilankiyendal',110,1),(5711,'Isalani',110,1),(5712,'Jothiya Patti',110,1),(5713,'K.Pappankulam',110,1),(5714,'Kalikappan Bit 1',110,1),(5715,'Kalikappan Bit 2',110,1),(5716,'Kalimangalam',110,1),(5717,'Kallandiri Bit 1',110,1),(5718,'Kallandiri Bit 2',110,1),(5719,'Karseri',110,1),(5720,'Karuppapillaiyendal',110,1),(5721,'Karuppukal',110,1),(5722,'Kathakinaru',110,1),(5723,'Kathavanendal',110,1),(5724,'Kodikulam Bit 1',110,1),(5725,'Kodikulam Bit 2',110,1),(5726,'Kolikudi',110,1),(5727,'Kollankulam',110,1),(5728,'Kondapethan',110,1),(5729,'Kosavikulam',110,1),(5730,'Kundukulam',110,1),(5731,'Kunnathur Bit 1',110,1),(5732,'Kunnathur Bit 2',110,1),(5733,'Kuruthur',110,1),(5734,'Mangalakudi',110,1),(5735,'Mangulam Bit 1',110,1),(5736,'Mankulam Bit 2',110,1),(5737,'Mathur',110,1),(5738,'Meenakshipuram Bit 1',110,1),(5739,'Meenakshipuram Bit 2',110,1),(5740,'Melamadai Bit 1',110,1),(5741,'Melamadai Bit 2',110,1),(5742,'Mundanayagam',110,1),(5743,'Mylangundu',110,1),(5744,'Naickanpatti',110,1),(5745,'Narasingam Bit 1',110,1),(5746,'Narasingam Bit 2',110,1),(5747,'Narasingam Bit 3',110,1),(5748,'Narasingam Bit 4',110,1),(5749,'Nattarmangalam',110,1),(5750,'Ovalur',110,1),(5751,'Panaikulam',110,1),(5752,'Pappakudi',110,1),(5753,'Parayankulam',110,1),(5754,'Perakur',110,1),(5755,'Pilluseri',110,1),(5756,'Podasapatti',110,1),(5757,'Poikairaipatti',110,1),(5758,'Poolampatti',110,1),(5759,'Poolankulam',110,1),(5760,'Poovakudi',110,1),(5761,'Porusupatti',110,1),(5762,'Pottapanaiyur',110,1),(5763,'Pudupatti',110,1),(5764,'Rajagambeeram',110,1),(5765,'Rajakur',110,1),(5766,'S.Nedunkulam',110,1),(5767,'Sakkimangalam Bit 1',110,1),(5768,'Sakkimangalam Bit 2',110,1),(5769,'Sakkudi',110,1),(5770,'Savalakkarayan',110,1),(5771,'Seegankulam',110,1),(5772,'Sembiyanendal',110,1),(5773,'Senkottai',110,1),(5774,'Sithakur',110,1),(5775,'Sivalingam',110,1),(5776,'Thamarai Patti Bit 2',110,1),(5777,'Thamaraipatti Bit 1',110,1),(5778,'Thatchanendal',110,1),(5779,'Thathankulam',110,1),(5780,'Thindiyur',110,1),(5781,'Thirukanai',110,1),(5782,'Thirumohur',110,1),(5783,'Thuyyaneri',110,1),(5784,'Udankundu',110,1),(5785,'Ulaganeri',110,1),(5786,'Uthankudi',110,1),(5787,'Valachikulam',110,1),(5788,'Vallakundu',110,1),(5789,'Vandiyur Bit 1',110,1),(5790,'Vandiyur Bit 2',110,1),(5791,'Varaganeri',110,1),(5792,'Varichiyur',110,1),(5793,'Veerapanchan',110,1),(5794,'Vellakuppan',110,1),(5795,'Vellankulam',110,1),(5796,'Velliyankundram',110,1),(5797,'Vidathakulam',110,1),(5798,'Vilathur',110,1),(5799,'Alathur',111,1),(5800,'Ambalathadi',111,1),(5801,'Anaiyur Bit 1',111,1),(5802,'Anaiyur Bit 2',111,1),(5803,'Ariyur',111,1),(5804,'Athalai',111,1),(5805,'Athikulam',111,1),(5806,'B B Kulam',111,1),(5807,'Boothakudi',111,1),(5808,'Chathirathondamanpatti',111,1),(5809,'Chellananakoundanpatti',111,1),(5810,'Chettikulam',111,1),(5811,'Chinnapatti',111,1),(5812,'Chokkikulam',111,1),(5813,'Erukalainatham',111,1),(5814,'Goripalayam',111,1),(5815,'Illupakudi',111,1),(5816,'Iraniyam',111,1),(5817,'Kadavur',111,1),(5818,'Kallikudi',111,1),(5819,'Kannanendal',111,1),(5820,'Kannikudi',111,1),(5821,'Karuvanur',111,1),(5822,'Kavanur',111,1),(5823,'Keelanedungulam',111,1),(5824,'Keelapanangadi',111,1),(5825,'Kodimangalam',111,1),(5826,'Koil Kuruthankulam',111,1),(5827,'Koolapandi',111,1),(5828,'Kovilpappakudi',111,1),(5829,'Kulamangalam Bit 1',111,1),(5830,'Kulamangalam Bit 2',111,1),(5831,'Malaipatti',111,1),(5832,'Managiri Bit 2',111,1),(5833,'Manjampatti',111,1),(5834,'Manthikulam',111,1),(5835,'Maranavariyenthal',111,1),(5836,'Melapanangadi',111,1),(5837,'Milagaranai',111,1),(5838,'Moolakurichi',111,1),(5839,'North Madurai',111,1),(5840,'Paraipatti',111,1),(5841,'Parasurampatti',111,1),(5842,'Paravai Bit 1',111,1),(5843,'Paravai Bit 2',111,1),(5844,'Parayathikulam',111,1),(5845,'Pattakuruchi',111,1),(5846,'Periyapatti',111,1),(5847,'Petchikulam',111,1),(5848,'Pillaiyarnatham',111,1),(5849,'Poolampatti',111,1),(5850,'Poonari',111,1),(5851,'Pothumbu Bit 1',111,1),(5852,'Pothumbu Bit 2',111,1),(5853,'Samayanallur',111,1),(5854,'Sambakulam',111,1),(5855,'Sambanthar Alangulam',111,1),(5856,'Sathamangalam',111,1),(5857,'Sellur',111,1),(5858,'Silayaneri',111,1),(5859,'Siruthur',111,1),(5860,'Siruvalai',111,1),(5861,'Tallakulam',111,1),(5862,'Thathaneri',111,1),(5863,'Thenur Bit 1',111,1),(5864,'Thenur Bit 2',111,1),(5865,'Therkkupethampatti',111,1),(5866,'Thiruppalai',111,1),(5867,'Thodaneri Bit 1',111,1),(5868,'Thodaneri Bit 2',111,1),(5869,'Usilampatti',111,1),(5870,'Vadugapatti',111,1),(5871,'Vagaikulam',111,1),(5872,'Vairavanatham',111,1),(5873,'Vayalur',111,1),(5874,'Veerapandi Bit 1',111,1),(5875,'Veerapandi Bit 2',111,1),(5876,'Velichanatham',111,1),(5877,'Vepankulam',111,1),(5878,'Vilangudi Bit 1',111,1),(5879,'Vilangudi Bit 2',111,1),(5880,'Vitangulam',111,1),(5881,'Achampathu',112,1),(5882,'Arappalayam',112,1),(5883,'Erkudi',112,1),(5884,'Karadipatti',112,1),(5885,'Keelakuilkudi',112,1),(5886,'Keelamathur',112,1),(5887,'Keelmathikaattinan',112,1),(5888,'Kochadai',112,1),(5889,'Kodimangalam',112,1),(5890,'Kokkulappi',112,1),(5891,'Melakuilkudi',112,1),(5892,'Melamathur',112,1),(5893,'Melmadurai',112,1),(5894,'Ponmeni',112,1),(5895,'Pudukulam Bit 1',112,1),(5896,'Sambakkudi',112,1),(5897,'Thattanur',112,1),(5898,'Thuvariman',112,1),(5899,'Vadapalanchi',112,1),(5900,'Vadivelkarai',112,1),(5901,'Vilacheri',112,1),(5902,'Airavathanallur',113,1),(5903,'Annupanadi',113,1),(5904,'Avaniyapuram',113,1),(5905,'Ayanpappakudi',113,1),(5906,'Chettikulam',113,1),(5907,'Chinthamani',113,1),(5908,'East Madurai',113,1),(5909,'Kalkulam',113,1),(5910,'Kallambal',113,1),(5911,'Kudalsenkulam',113,1),(5912,'Kusavankundu',113,1),(5913,'Kusavapatti',113,1),(5914,'Kuthiraikuthi',113,1),(5915,'M.Alankulam',113,1),(5916,'M.Panaikulam',113,1),(5917,'Meenakshipuram',113,1),(5918,'Moothankulam',113,1),(5919,'Nallur',113,1),(5920,'Nedunkulam',113,1),(5921,'Panaiyur',113,1),(5922,'Pappanodai',113,1),(5923,'Perumanendal',113,1),(5924,'Pirakudi',113,1),(5925,'Puliyankulam',113,1),(5926,'Ramankulam',113,1),(5927,'Samanatham',113,1),(5928,'Silaiman',113,1),(5929,'Solankuruni',113,1),(5930,'Villapuram',113,1),(5931,'Virahanur',113,1),(5932,'Virathanur',113,1),(5933,'A.Valayapatti',114,1),(5934,'A.Vallalapatti',114,1),(5935,'Ambalakaranpatti',114,1),(5936,'Amoor',114,1),(5937,'Arasappanpatti',114,1),(5938,'Arittapatti',114,1),(5939,'Attappatti',114,1),(5940,'Attukulam',114,1),(5941,'Ayan Pandangudi',114,1),(5942,'Ayathampatti',114,1),(5943,'Ayyapatti',114,1),(5944,'Boothamangalam',114,1),(5945,'Chockalingapuram',114,1),(5946,'Chokkampatti',114,1),(5947,'E.Malampatti',114,1),(5948,'Ettimangalm',114,1),(5949,'Inam Pandangudi',114,1),(5950,'Kachchirayanpatti',114,1),(5951,'Kalikkulam',114,1),(5952,'Kambur',114,1),(5953,'Karungalakkudi',114,1),(5954,'Karuthapuliyampatti',114,1),(5955,'Kavattayampatti',114,1),(5956,'Keelaiyur',114,1),(5957,'Keelavalavu',114,1),(5958,'Keeranur',114,1),(5959,'Kesampatti',114,1),(5960,'Kidaripatti',114,1),(5961,'Kodukkampatti',114,1),(5962,'Kongampatti',114,1),(5963,'Kottakudi',114,1),(5964,'Kottampatti',114,1),(5965,'Kunnarampatti',114,1),(5966,'Kurichipatti',114,1),(5967,'Manappacheri',114,1),(5968,'Maruthur',114,1),(5969,'Melur Town',114,1),(5970,'Mukkampatti',114,1),(5971,'Nalukulam',114,1),(5972,'Narasingampatti',114,1),(5973,'Navinippatti',114,1),(5974,'Pallapatti',114,1),(5975,'Panankadi',114,1),(5976,'Pathinettankudi',114,1),(5977,'Pattur',114,1),(5978,'Perungalakudi',114,1),(5979,'Poonchuthi',114,1),(5980,'Pottapatti',114,1),(5981,'Pudusukkampatti',114,1),(5982,'Pulippatti',114,1),(5983,'Saruguvalayapatti',114,1),(5984,'Sathamangalam',114,1),(5985,'Sathurmadankan',114,1),(5986,'Sekkipatti',114,1),(5987,'Seminipatti',114,1),(5988,'Silambakkonpatti',114,1),(5989,'Soorakundu',114,1),(5990,'Soorappatti',114,1),(5991,'Sorukkulippatti',114,1),(5992,'Sukkampatti',114,1),(5993,'T.Kovilpatti',114,1),(5994,'T.Manickampatti',114,1),(5995,'Thaniyamangalam',114,1),(5996,'Tharkakudi',114,1),(5997,'Therkutheru',114,1),(5998,'Thiruchunai',114,1),(5999,'Thiruvathavur',114,1),(6000,'Thonthilingapuram',114,1),(6001,'Thumbaipatti',114,1),(6002,'Thuvarankulam',114,1),(6003,'Uduppakulam',114,1),(6004,'Uranganpatti',114,1),(6005,'Valaiseripatti',114,1),(6006,'Vanchi Nagaram',114,1),(6007,'Vannamparaipatti',114,1),(6008,'Vellalur',114,1),(6009,'Veppadappu',114,1),(6010,'Appakarai',115,1),(6011,'Athanur',115,1),(6012,'Athikaripatti',115,1),(6013,'Athippatti',115,1),(6014,'Avalseri',115,1),(6015,'Chinnakattalai',115,1),(6016,'Chinnareddipatti',115,1),(6017,'E.Kottaipatti',115,1),(6018,'Elumalai',115,1),(6019,'Eswaraperi',115,1),(6020,'Gopalapuram',115,1),(6021,'Jambalapuram',115,1),(6022,'Jari Usilampatti',115,1),(6023,'Kadaneri',115,1),(6024,'Kalappanpatti',115,1),(6025,'Karaikeni',115,1),(6026,'Kenchampatti Bit 1',115,1),(6027,'Kenchampatti Bit 2',115,1),(6028,'Keththuvarpatti',115,1),(6029,'Kilankulam',115,1),(6030,'Koovalapuram',115,1),(6031,'Koundanpatti Bit 1',115,1),(6032,'Koundanpatti Bit 2',115,1),(6033,'Kudipatti',115,1),(6034,'Kudiseri',115,1),(6035,'Kunnathur Bit 1',115,1),(6036,'Kunnathur Bit 2',115,1),(6037,'Kuppalnatham',115,1),(6038,'Lakshmipuram',115,1),(6039,'M.Senkulam',115,1),(6040,'Mallapuram',115,1),(6041,'Mangalrevu',115,1),(6042,'Manibamettupatti',115,1),(6043,'Mathakkarai',115,1),(6044,'Melathirumanickam',115,1),(6045,'Mothagam',115,1),(6046,'Muruganeri',115,1),(6047,'Muthunagaiyapuram Bit 1',115,1),(6048,'Muthunagaiyapuram Bit 2',115,1),(6049,'Nagaiyapuram',115,1),(6050,'Nallamaram',115,1),(6051,'P.Suppulapuram',115,1),(6052,'Pappinaickanpatti',115,1),(6053,'Paraipatti',115,1),(6054,'Peraiyur Bit 1',115,1),(6055,'Peraiyur Bit 2',115,1),(6056,'Perayampatti',115,1),(6057,'Periyakattalai',115,1),(6058,'Perungamanallur',115,1),(6059,'Poosalapuram',115,1),(6060,'S.Keelapatti',115,1),(6061,'Salisanthai',115,1),(6062,'Santhaiyur',115,1),(6063,'Saptur',115,1),(6064,'Sedapatti',115,1),(6065,'Seelnaickanpatti',115,1),(6066,'Sembarani',115,1),(6067,'Silamalaipatti',115,1),(6068,'Silarpatti',115,1),(6069,'Sinnapoolampatti',115,1),(6070,'Sittulotti',115,1),(6071,'Sulappapuram',115,1),(6072,'T.Kallupatti',115,1),(6073,'Thaadayampatti',115,1),(6074,'Thirumanickam',115,1),(6075,'Thullukkutinayakkanur',115,1),(6076,'Uthappuram',115,1),(6077,'V Ammapatti',115,1),(6078,'Vaiyur',115,1),(6079,'Vandari',115,1),(6080,'Vannankulam',115,1),(6081,'Vannivelampatti',115,1),(6082,'Velambur Bit 1',115,1),(6083,'Velambur Bit 2',115,1),(6084,'Vittalpatti',115,1),(6085,'Eliyarpathi',116,1),(6086,'K.Pudupatti @ Astinpatti',116,1),(6087,'Kombadi',116,1),(6088,'Madakulam',116,1),(6089,'Melanedunkulam',116,1),(6090,'Mullakulam',116,1),(6091,'Nedumadurai',116,1),(6092,'Nilayur Bit 1',116,1),(6093,'Nilayur Bit 2',116,1),(6094,'Othai Alankulam',116,1),(6095,'Parapathi',116,1),(6096,'Periya Alankulam',116,1),(6097,'Periyakoodakkoil',116,1),(6098,'Perungudi',116,1),(6099,'Pudukulam Bit 2',116,1),(6100,'Pudukulam Bit 3',116,1),(6101,'Sakilipatti',116,1),(6102,'Surakkulam',116,1),(6103,'Thanakkankulam',116,1),(6104,'Thenpalanchi',116,1),(6105,'Thirupparankundram',116,1),(6106,'Thoppur',116,1),(6107,'Thotiyapatti',116,1),(6108,'Valanenthal',116,1),(6109,'Valayapatti',116,1),(6110,'Vedarpuliyankulam',116,1),(6111,'A.Ammappatti',117,1),(6112,'A.Kokkulam',117,1),(6113,'Alagusirai',117,1),(6114,'Alapalachcheri',117,1),(6115,'Chettikulam',117,1),(6116,'Chettipillaiyarnatham',117,1),(6117,'Chiththalai',117,1),(6118,'Chockanathanpatti',117,1),(6119,'Dharmathupatti',117,1),(6120,'Erramallampatti',117,1),(6121,'Giriyakoundanpatti',117,1),(6122,'Jari Sengulam',117,1),(6123,'Josiyar Alankulam',117,1),(6124,'K.Puliyankulam',117,1),(6125,'Kandai',117,1),(6126,'Kangeyanatham',117,1),(6127,'Kannukulam',117,1),(6128,'Kappalur',117,1),(6129,'Karadikkal',117,1),(6130,'Karisal Patti',117,1),(6131,'Kilavaneri',117,1),(6132,'Kinnimangalam',117,1),(6133,'Kudiraichanikulam',117,1),(6134,'Kunnanampatti',117,1),(6135,'Madippanur Bit 1',117,1),(6136,'Madippanur Bit 2',117,1),(6137,'Maikudi',117,1),(6138,'Mallampatti',117,1),(6139,'Maravankulam',117,1),(6140,'Melakotta',117,1),(6141,'Melendalipandi',117,1),(6142,'Nadukkottai',117,1),(6143,'Naduvakkottai',117,1),(6144,'Palakkapudupatti',117,1),(6145,'Pannikundu',117,1),(6146,'Pokkampatti',117,1),(6147,'Ponnamangalam',117,1),(6148,'Ponnampatti',117,1),(6149,'Puliyagoundanpatti',117,1),(6150,'Pungankulam',117,1),(6151,'Rayapalayam',117,1),(6152,'S.Puliyankulam',117,1),(6153,'Saththankudi Bit 1',117,1),(6154,'Saththankudi Bit 2',117,1),(6155,'Savudarpatti Bit 1',117,1),(6156,'Savudarpatti Bit 2',117,1),(6157,'T Puduppatti',117,1),(6158,'T.Andipatti',117,1),(6159,'Thangalachcheri',117,1),(6160,'Thirumangalam',117,1),(6161,'Tirali Bit 1',117,1),(6162,'Tirali Bit 2',117,1),(6163,'Uchapatti',117,1),(6164,'Urappanur Bit 1',117,1),(6165,'Urappanur Bit 2',117,1),(6166,'Vadakarai',117,1),(6167,'Vagaikulam',117,1),(6168,'Vannankulam',117,1),(6169,'Venkatasamuthiram',117,1),(6170,'Vidathakulam',117,1),(6171,'Virusankulam',117,1),(6172,'A.Krishnapuram',118,1),(6173,'A.Pudupatti',118,1),(6174,'Allikundam',118,1),(6175,'Ariyapatti',118,1),(6176,'Ayan Mettupatti',118,1),(6177,'Ayyanarkulam',118,1),(6178,'Boothipuram',118,1),(6179,'Dottappanayakkanur',118,1),(6180,'Eravarpatti',118,1),(6181,'Erumarpatti',118,1),(6182,'Jothilnayakkanur',118,1),(6183,'Jothimanickam',118,1),(6184,'Kalluthu',118,1),(6185,'Kannanur',118,1),(6186,'Karumathur',118,1),(6187,'Kattakaruppanpatti',118,1),(6188,'Keeripatti',118,1),(6189,'Kodikulam',118,1),(6190,'Kovilangulam',118,1),(6191,'Kuravakudi',118,1),(6192,'Manuthu',118,1),(6193,'Mekkilarpatti',118,1),(6194,'Muthalaikulam',118,1),(6195,'Nadupatti',118,1),(6196,'Nakklapatti',118,1),(6197,'Nalluthevanpatti',118,1),(6198,'Nattarmangalam',118,1),(6199,'Panamooppanpatti',118,1),(6200,'Panniyan',118,1),(6201,'Pappapatti',118,1),(6202,'Perumalpatti',118,1),(6203,'Poduvarpatti',118,1),(6204,'Poruppumettupatti',118,1),(6205,'Pothampatti',118,1),(6206,'Pottulupatti',118,1),(6207,'Pullaneri',118,1),(6208,'Sadachipatti',118,1),(6209,'Sakarappanayakkanur',118,1),(6210,'Seemanuthu',118,1),(6211,'Sempatti',118,1),(6212,'Sikkampatti',118,1),(6213,'Sinthupatti',118,1),(6214,'Sirupatti',118,1),(6215,'Thidiyan',118,1),(6216,'Thimmanatham',118,1),(6217,'Thumalapatti',118,1),(6218,'Thummakundu',118,1),(6219,'Usilampatti',118,1),(6220,'Uthappanyakkanur',118,1),(6221,'Vagurani',118,1),(6222,'Valanthur',118,1),(6223,'Veppanuthu',118,1),(6224,'Vikkiramangalam',118,1),(6225,'Vinnakudi',118,1),(6226,'Achampatti',119,1),(6227,'Alagapuri',119,1),(6228,'Alanganallur',119,1),(6229,'Amaradakki',119,1),(6230,'Athanur',119,1),(6231,'Ayan Kuruvithurai',119,1),(6232,'Ayan Thenkarai',119,1),(6233,'Ayyur',119,1),(6234,'Bodinayakanpatti',119,1),(6235,'Chinnamanaickanpatti',119,1),(6236,'Devaseri',119,1),(6237,'Errampatti',119,1),(6238,'Ilavankulam',119,1),(6239,'Irumbadi',119,1),(6240,'Jari Viralipatti',119,1),(6241,'Kachirairuppu',119,1),(6242,'Kallanai',119,1),(6243,'Kalvelippatti',119,1),(6244,'Karuppatti',119,1),(6245,'Katchaikatti',119,1),(6246,'Kattakulam',119,1),(6247,'Keelakarai',119,1),(6248,'Keelasinnampatti',119,1),(6249,'Kodangipatti',119,1),(6250,'Konappatti',119,1),(6251,'Kondayampatti',119,1),(6252,'Kovil Kuruvithurai',119,1),(6253,'Kovil Thenkarai',119,1),(6254,'Kovilpatti',119,1),(6255,'Krishnapuram',119,1),(6256,'Kulasekarankottai',119,1),(6257,'Kumaram',119,1),(6258,'Kuttimeikkipatti',119,1),(6259,'Manickampatti',119,1),(6260,'Maniyanchi',119,1),(6261,'Mannadimangalam',119,1),(6262,'Melakkal',119,1),(6263,'Mettupatti',119,1),(6264,'Muduvarpatti',119,1),(6265,'Mullipallam',119,1),(6266,'Nachikulam',119,1),(6267,'Nagari',119,1),(6268,'Nedunkulam',119,1),(6269,'Neerathan',119,1),(6270,'Palamedu',119,1),(6271,'Pannaikudi',119,1),(6272,'Paraipatti',119,1),(6273,'Parali',119,1),(6274,'Periya Ilanthaikulam',119,1),(6275,'Pettai',119,1),(6276,'Rajakkalpatti',119,1),(6277,'Ramagowndanpatti',119,1),(6278,'Sambakkulam',119,1),(6279,'Saranthangi',119,1),(6280,'Sathiravellalapatti',119,1),(6281,'Sempatti',119,1),(6282,'Senthamangalam',119,1),(6283,'Sholavandan',119,1),(6284,'Sinna Ilanthaikulam',119,1),(6285,'Sithalankudi',119,1),(6286,'Solaikurichi',119,1),(6287,'Sukkampatti',119,1),(6288,'T.Andipatti',119,1),(6289,'Thandalai',119,1),(6291,'Thathampatti',119,1),(6292,'Thattankulam',119,1),(6293,'Thethur',119,1),(6294,'Thirumalnatham',119,1),(6295,'Thiruvalavayanallur',119,1),(6296,'Thiruvedagam',119,1),(6297,'Thumbichampatti',119,1),(6298,'Urseri',119,1),(6299,'Vaikasipatti',119,1),(6300,'Valayapatti',119,1),(6301,'Vavida Maruthur',119,1),(6302,'Vellayampatti',119,1),(6303,'Alangudi',120,1),(6304,'Ananthanallur',120,1),(6305,'Arivaloor',120,1),(6306,'Asikadu',120,1),(6307,'Enam Kuttalam',120,1),(6308,'Enam Senniyanullur',120,1),(6309,'Enam Thiruvalangadu',120,1),(6310,'Enam Umambalpuram',120,1),(6311,'Ezhumagalur',120,1),(6312,'Gangadharapuram',120,1),(6313,'Kaanchivoi',120,1),(6314,'Kadalangudi-M',120,1),(6315,'Kalanivasal',120,1),(6316,'Kappur',120,1),(6317,'Karuppur',120,1),(6318,'Kizhaparuthikudi',120,1),(6319,'Kodimangalam',120,1),(6320,'Kokkur',120,1),(6321,'Komal Kizhasethi',120,1),(6322,'Komal Melasethi',120,1),(6323,'Konerirajapuram-1',120,1),(6324,'Konerirajapuram-2',120,1),(6325,'Kozhaiyur',120,1),(6326,'Kuthalam',120,1),(6327,'Maanthai',120,1),(6328,'Manganallur',120,1),(6329,'Marudhur',120,1),(6330,'Mathirimangalam',120,1),(6331,'Mekkirimangalam',120,1),(6332,'Melahalangan',120,1),(6333,'Melaiyur',120,1),(6334,'Melaparuthikudi',120,1),(6335,'Nakkambadi',120,1),(6336,'Nallavoor',120,1),(6337,'Paalaiyur',120,1),(6338,'Palayakudalur',120,1),(6339,'Pandaravadai',120,1),(6340,'Peravoor',120,1),(6341,'Perumalkoil',120,1),(6342,'Peruncheri',120,1),(6343,'Porumpur',120,1),(6344,'Sengudi',120,1),(6345,'Senniyanallur',120,1),(6346,'Sethirabalapuram',120,1),(6347,'Sivanaraharam',120,1),(6348,'Sri Kandapuram',120,1),(6349,'Thathangudi',120,1),(6350,'Therezhandur',120,1),(6351,'Thirumanamchery',120,1),(6352,'Thirunalkondachery',120,1),(6353,'Thiruvaduthurai',120,1),(6354,'Thiruvalangadu',120,1),(6355,'Thozhudalangudi',120,1),(6356,'Thulasenthirapuram',120,1),(6357,'Vanathirajapuram',120,1),(6358,'Vazhuvoor',120,1),(6359,'Villiyanallur',120,1),(6360,'Aathur',121,1),(6361,'Agarakeerangudi',121,1),(6362,'Anaimelagaram',121,1),(6363,'Anathandavapuram',121,1),(6364,'Arunmozhidevan',121,1),(6365,'Aruvapadi',121,1),(6366,'Boothangudi',121,1),(6367,'Chozhampettai',121,1),(6368,'Dharumadhanapuram',121,1),(6369,'Elanthoppu',121,1),(6370,'Ivanullur',121,1),(6371,'Kadakkam',121,1),(6372,'Kadalangudi',121,1),(6373,'Kaduvangudi',121,1),(6374,'Kali - 1',121,1),(6375,'Kali - 2',121,1),(6376,'Kanganamputhur',121,1),(6377,'Kesingan',121,1),(6378,'Kizhai',121,1),(6379,'Kizhamarudhanthanallur',121,1),(6380,'Kodangudi',121,1),(6381,'Koranadu',121,1),(6382,'Korkai',121,1),(6383,'Kovangudi',121,1),(6384,'Kulichar',121,1),(6385,'Kuruchi',121,1),(6386,'Maharajapuram',121,1),(6387,'Manakudi',121,1),(6388,'Manalmedu',121,1),(6389,'Mannampandal',121,1),(6390,'Maraiyur',121,1),(6391,'Mayiladuthurai',121,1),(6392,'Melanallur',121,1),(6393,'Moovalur',121,1),(6394,'Mozhaiyur',121,1),(6395,'Mudikondanallur',121,1),(6396,'Murugamangalam',121,1),(6397,'Nallathukudi',121,1),(6398,'Namachivayapuram',121,1),(6399,'Nidur',121,1),(6400,'Paandur',121,1),(6401,'Pandaravadai Mappadugai',121,1),(6402,'Pattamangalam',121,1),(6403,'Pattavarthi',121,1),(6404,'Ponmasanallur',121,1),(6405,'Ponnur',121,1),(6406,'Seruthiyur',121,1),(6407,'Sethur',121,1),(6408,'Sidharkadu',121,1),(6409,'Sithamalli',121,1),(6410,'Thalaignayaru - 1',121,1),(6411,'Thalaignayaru - 2',121,1),(6412,'Thazhanchery',121,1),(6413,'Thiruchitrambalam',121,1),(6414,'Thiruindalur',121,1),(6415,'Thirumangalam',121,1),(6416,'Thiruvalaputhur',121,1),(6417,'Uluthukuppai',121,1),(6418,'Varadhampattu',121,1),(6419,'Vellalagaram',121,1),(6420,'Villiyanallur',121,1),(6421,'Aachalpuram',122,1),(6422,'Aalalasundaram',122,1),(6423,'Aalangadu',122,1),(6424,'Aalaveli',122,1),(6425,'Aarapallam',122,1),(6426,'Aarpakkam',122,1),(6427,'Agani',122,1),(6428,'Agaraelathur',122,1),(6429,'Agaraperunthottam',122,1),(6430,'Agaravattaram',122,1),(6431,'Alakudi',122,1),(6432,'Arasur',122,1),(6433,'Athiyur',122,1),(6434,'Cauverypoompattinam',122,1),(6435,'Edagudivadapathi - 1',122,1),(6436,'Edagudivadapathi - 2',122,1),(6437,'Edamanal',122,1),(6438,'Erukoor',122,1),(6439,'Gopalasamuthiram',122,1),(6440,'Kadavasal',122,1),(6441,'Kaivilancherry',122,1),(6442,'Kannapiranadi',122,1),(6443,'Kanniyakudi',122,1),(6444,'Karaimedu',122,1),(6445,'Karkoil',122,1),(6446,'Kathiramangalam',122,1),(6447,'Kathiruppu',122,1),(6448,'Kattur',122,1),(6449,'Keelamathur',122,1),(6450,'Keelasattanathapuram',122,1),(6451,'Kondal',122,1),(6452,'Kondathur',122,1),(6453,'Kondathur',122,1),(6454,'Kunnam',122,1),(6455,'Kuruviyampallam',122,1),(6456,'Kuthiyampettai',122,1),(6457,'Maadhanam',122,1),(6458,'Maharajapuram',122,1),(6459,'Mahendrapalli',122,1),(6460,'Mangaimadam',122,1),(6461,'Manigrammam',122,1),(6462,'Marudhangudi',122,1),(6463,'Maruvathur',122,1),(6464,'Mathiravelur',122,1),(6465,'Melaiyur',122,1),(6466,'Muthalaimedu',122,1),(6467,'Nallanayagapuram',122,1),(6468,'Nangur',122,1),(6469,'Natham',122,1),(6470,'Nemmali',122,1),(6471,'Neppathur',122,1),(6472,'Odhavanthankudi',122,1),(6473,'Olaiyamputhur',122,1),(6474,'Pachai Perumanallur',122,1),(6475,'Pagasalai',122,1),(6476,'Palaiyapalayam',122,1),(6477,'Pannangudi',122,1),(6478,'Perumangalam',122,1),(6479,'Perunthottam - 1',122,1),(6480,'Perunthottam - 2',122,1),(6481,'Pudhupattianam',122,1),(6482,'Pudhuthurai',122,1),(6483,'Puliyanthurai',122,1),(6484,'Punganoor',122,1),(6485,'Puthur',122,1),(6486,'Radhanallur (41)',122,1),(6487,'Radhanallur (69)',122,1),(6488,'Sattanathapuram',122,1),(6489,'Semangalam',122,1),(6490,'Semmangudi',122,1),(6491,'Sempadhaniruppu',122,1),(6492,'Serugudi',122,1),(6493,'Sirkali',122,1),(6494,'Sothiyakudi',122,1),(6495,'Thadaalankoil',122,1),(6496,'Thandavankulam',122,1),(6497,'Thennampattinam',122,1),(6498,'Thillaividangan',122,1),(6499,'Thirukarukavur',122,1),(6500,'Thirumailadi',122,1),(6501,'Thirumullaivasal',122,1),(6502,'Thirunagari',122,1),(6503,'Thirupunkur',122,1),(6504,'Thiruvaali',122,1),(6505,'Thiruvenkadu',122,1),(6506,'Thittai',122,1),(6507,'Umaiyalpathi',122,1),(6508,'Vadarangam',122,1),(6509,'Valluvakudi',122,1),(6510,'Vanagiri',122,1),(6511,'Varisaipathu Vadakal',122,1),(6512,'Vettangudi',122,1),(6513,'Vilanthidasamuthiram',122,1),(6514,'Aakur Pandaravadai',123,1),(6515,'Aaru Pathi',123,1),(6516,'Aathu Pakkam',123,1),(6517,'Aharadhanur',123,1),(6518,'Aharavallam',123,1),(6519,'Annavasal',123,1),(6520,'Arasur',123,1),(6521,'Chandrapadi',123,1),(6522,'Echchangudi',123,1),(6523,'Edakudi',123,1),(6524,'Eduthukatti',123,1),(6525,'Eravancheri',123,1),(6526,'Erukkattencheri',123,1),(6527,'Ilaiyalur',123,1),(6528,'Iluppur',123,1),(6529,'Kaalamanallur',123,1),(6530,'Kadakkam',123,1),(6531,'Kalahastinatha Puram',123,1),(6532,'Kanjanaharam',123,1),(6533,'Kattucheri',123,1),(6534,'Kazhiyappa Nallur',123,1),(6535,'Keezha Perumpallam',123,1),(6536,'Keezhaiyur',123,1),(6537,'Kidangal',123,1),(6538,'Kidarankondan',123,1),(6539,'Kiliyanur',123,1),(6540,'Killiyur',123,1),(6541,'Kizha Mathur',123,1),(6542,'Kodavilaham',123,1),(6543,'Koodalur',123,1),(6544,'Kothangudi',123,1),(6545,'Madapuram',123,1),(6546,'Mamakudi',123,1),(6547,'Manalmedu',123,1),(6548,'Manikapangu',123,1),(6549,'Marudampallam',123,1),(6550,'Mathur',123,1),(6551,'Melaiyur',123,1),(6552,'Melaperumpallam',123,1),(6553,'Memathur',123,1),(6554,'Mudikandanallur',123,1),(6555,'Mukkarumbur',123,1),(6556,'Muthur',123,1),(6557,'Nadukarai Keezhpathi',123,1),(6558,'Nadukarai Melpathi',123,1),(6559,'Nallaadai',123,1),(6560,'Narasinganatham',123,1),(6561,'Neduvasal',123,1),(6562,'Parasalur',123,1),(6563,'Perambur',123,1),(6564,'Pillaiperumanallur',123,1),(6565,'Poraiyar',123,1),(6566,'Ramachandran Kovil Pathu',123,1),(6567,'Saththangudi',123,1),(6568,'Sembanarkoil',123,1),(6569,'Sethur',123,1),(6570,'Thalaiyudaiyavar Kovil Pathu',123,1),(6571,'Thillaiyadi',123,1),(6572,'Thiruchampalli',123,1),(6573,'Thirukadaiyur',123,1),(6574,'Thirukalacheri',123,1),(6575,'Thiruvidaikazhi',123,1),(6576,'Thiruvilaiyattam',123,1),(6577,'Udaiyavar Kovilpathu',123,1),(6578,'Uthirangudi',123,1),(6579,'Vilaham',123,1),(6580,'Visalur',123,1),(6581,'Aanaimangalam',124,1),(6582,'Aharakadambanur',124,1),(6583,'Anakkudi',124,1),(6584,'Andhakudi',124,1),(6585,'Athipuliyur',124,1),(6586,'Chozhavidyapuram',124,1),(6587,'Eraiyangudi',124,1),(6588,'Eravancheri',124,1),(6589,'Iluppur',124,1),(6590,'Irukkai',124,1),(6591,'Kakkalani',124,1),(6592,'Karapidahai North',124,1),(6593,'Karapidahai South',124,1),(6594,'Karungannii',124,1),(6595,'Keezhaiyur',124,1),(6596,'Killukudi',124,1),(6597,'Kilvelur',124,1),(6598,'Kizha Pidahai',124,1),(6599,'Kohur',124,1),(6600,'Koorathangudi',124,1),(6601,'Koothur',124,1),(6602,'Kovilkannapur',124,1),(6603,'Kurukathi',124,1),(6604,'Kurumanangudi',124,1),(6605,'Maanalur',124,1),(6606,'Manalur',124,1),(6607,'Mohanur',124,1),(6608,'Okkur',124,1),(6609,'Ottathattai',124,1),(6610,'Palakurichi',124,1),(6611,'Pattamangalam',124,1),(6612,'Pradabaramapuram',124,1),(6613,'Radhamangalam',124,1),(6614,'Satiyakudi',124,1),(6615,'Serunallur',124,1),(6616,'Sihar',124,1),(6617,'Sinnathumbur',124,1),(6618,'Thalaiyamazhai',124,1),(6619,'Thannilapadi',124,1),(6620,'Thevur',124,1),(6621,'Thirukannangudi',124,1),(6622,'Thirukannangudi Agaram',124,1),(6623,'Thirupoondi East',124,1),(6624,'Thirupoondi West',124,1),(6625,'Vadakalathur',124,1),(6626,'Vadakarai',124,1),(6627,'Vadakkuveli',124,1),(6628,'Vandalur',124,1),(6629,'Veilankanni',124,1),(6630,'Vengidangal',124,1),(6631,'Venmanacheri',124,1),(6632,'Venmani',124,1),(6633,'Veppancheri',124,1),(6634,'Vettaikaraniruppu',124,1),(6635,'Vizhundhamavadi',124,1),(6636,'Aabaranadari',125,1),(6637,'Aadhalaiyur',125,1),(6638,'Aalatthur',125,1),(6639,'Agalanggan',125,1),(6640,'Agarakontagai',125,1),(6641,'Agaraorathur',125,1),(6642,'Aivanallur',125,1),(6643,'Alangudi',125,1),(6644,'Ambal',125,1),(6645,'Andanapettai',125,1),(6646,'Arunmozhidevan',125,1),(6647,'Edaiyathangudi',125,1),(6648,'Elangadambanur',125,1),(6649,'Enangudi',125,1),(6650,'Eravancheri',125,1),(6651,'Ervadi',125,1),(6652,'Gopurajapuram',125,1),(6653,'Kaaraiyur',125,1),(6654,'Kangalanchery',125,1),(6655,'Karuvelangadai',125,1),(6656,'Kattumavadi',125,1),(6657,'Kayathur',125,1),(6658,'Keezha Boodhanur',125,1),(6659,'Keezha Thanjavur',125,1),(6660,'Kidamangalam',125,1),(6661,'Kongarayanallur',125,1),(6662,'Kothamangalam',125,1),(6663,'Kottapadi',125,1),(6664,'Kottarakudi',125,1),(6665,'Kottur',125,1),(6666,'Kuruchi',125,1),(6667,'Kuruvadi',125,1),(6668,'Kuthalam',125,1),(6669,'Mahadhanam',125,1),(6670,'Marungur',125,1),(6671,'Mathirimangalam',125,1),(6672,'Melaboodhanur',125,1),(6673,'Nagapattinam Village',125,1),(6674,'Nagore Village',125,1),(6675,'Narimanam',125,1),(6676,'Neikkuppai',125,1),(6677,'Oratthur',125,1),(6678,'Palaiyur',125,1),(6679,'Panangudi',125,1),(6680,'Pandaravadai',125,1),(6681,'Pappakoil',125,1),(6682,'Periyakannamangalam',125,1),(6683,'Perunkadambanur',125,1),(6684,'Pillali',125,1),(6685,'Polagam',125,1),(6686,'Ponveli',125,1),(6687,'Porakudi',125,1),(6688,'Poravachery',125,1),(6689,'Puducheri',125,1),(6690,'Puthagaram',125,1),(6691,'Puthukadai',125,1),(6692,'Raranthimangalam',125,1),(6693,'Sangamangalam',125,1),(6694,'Sekal',125,1),(6695,'Sellur',125,1),(6696,'Sembiyanmadevi',125,1),(6697,'Sesamulai',125,1),(6698,'Sikkal',125,1),(6699,'Sirangudipulliyur Kulandai',125,1),(6700,'Siyathamangai',125,1),(6701,'Themangalam',125,1),(6702,'Thenkarai',125,1),(6703,'Thenpidagai',125,1),(6704,'Therkupoigainallur',125,1),(6705,'Thethi',125,1),(6706,'Thirukannapuram',125,1),(6707,'Thirupayathangudi',125,1),(6708,'Thirupugalur',125,1),(6709,'Thirusenkattangudi',125,1),(6710,'Thittachery',125,1),(6711,'Thiurmarugal',125,1),(6712,'Thuraiyur',125,1),(6713,'Uthamachozhapuram',125,1),(6714,'Vadakarai',125,1),(6715,'Vadakku Poigainallur',125,1),(6716,'Vadakudi',125,1),(6717,'Vadugachery',125,1),(6718,'Vaduvur',125,1),(6719,'Vazhkudi',125,1),(6720,'Virkudi',125,1),(6721,'Aadamangalam',126,1),(6722,'Aaimoor',126,1),(6723,'Anakkudi',126,1),(6724,'Eesanur',126,1),(6725,'Ettukudi',126,1),(6726,'Kaarkudi',126,1),(6727,'Kachanaharam',126,1),(6728,'Keeramper',126,1),(6729,'Kodiyalathur',126,1),(6730,'Kolappadu',126,1),(6731,'Koothangudi',126,1),(6732,'Kothangudi',126,1),(6733,'Madapuram',126,1),(6734,'Manakudi',126,1),(6735,'Meenamanallur',126,1),(6736,'Mela Vazhakarai',126,1),(6737,'Mutharasapuram',126,1),(6738,'Nathapallam',126,1),(6739,'Neermoolai',126,1),(6740,'Paangal',126,1),(6741,'Panangadi',126,1),(6742,'Pannatheru',126,1),(6743,'Puthur',126,1),(6744,'Sithaimur',126,1),(6745,'Thenmaruthur',126,1),(6746,'Therkupanaiyur',126,1),(6747,'Thirukuvalai',126,1),(6748,'Thiruvaimur',126,1),(6749,'Thiruvudaimaruthur',126,1),(6750,'Thozhudur',126,1),(6751,'Vaazhakarai',126,1),(6752,'Vadakkupanaiyur',126,1),(6753,'Vaduhoor',126,1),(6754,'Valivalam',126,1),(6755,'Vallam',126,1),(6756,'Aadhanur',127,1),(6757,'Ahasthiyam Palli',127,1),(6758,'Andahathurai',127,1),(6759,'Ayakaranpulam 1 St Sethi',127,1),(6760,'Ayakaranpulam 2 Nd Sethi',127,1),(6761,'Ayakaranpulam 3 Rd Sethi',127,1),(6762,'Ayakaranpulam 4 Th Sethi',127,1),(6763,'Kaadanthethi',127,1),(6764,'Kadinavayal',127,1),(6765,'Kallimedu',127,1),(6766,'Karuppampulam',127,1),(6767,'Kathiripulam',127,1),(6768,'Kodiakadu',127,1),(6769,'Kodiayakarai',127,1),(6770,'Kovilpaththu',127,1),(6771,'Kuravappalam',127,1),(6772,'Maharajapuram Kilpathi',127,1),(6773,'Maharajapuram Kizhakku',127,1),(6774,'Maharajapuram Melpathi',127,1),(6775,'Marudhur North',127,1),(6776,'Marudhur South',127,1),(6777,'Moolakarai',127,1),(6778,'Nahakudaiyan',127,1),(6779,'Naluvedapathi',127,1),(6780,'Neivilakku',127,1),(6781,'Panjanadhikulam East',127,1),(6782,'Panjanadhikulam Nadusethi',127,1),(6783,'Panjanadhikulam West',127,1),(6784,'Pannal',127,1),(6785,'Periakuthahai',127,1),(6786,'Pirinjimoolai',127,1),(6787,'Prandhiyankarai',127,1),(6788,'Putpavanam',127,1),(6789,'Sembodai',127,1),(6790,'Senbaharayanallur',127,1),(6791,'Settipulam',127,1),(6792,'Thakattur Pethachikadu',127,1),(6793,'Thakattur Subramaniyakadu',127,1),(6794,'Thalanayar 1 St Sethi',127,1),(6795,'Thalanayar 2 Nd Sethi',127,1),(6796,'Thalanayar 3 Rd Sethi',127,1),(6797,'Thalanayar 4 Th Sethi',127,1),(6798,'Thalanayar 5 Th Sethi',127,1),(6799,'Thalanayar Agraharam',127,1),(6800,'Thanikottaham',127,1),(6801,'Thennadar',127,1),(6802,'Thethakudi North',127,1),(6803,'Thethakudi South',127,1),(6804,'Thirumaalam',127,1),(6805,'Thopputhurai',127,1),(6806,'Thulasapuram',127,1),(6807,'Umbalacheri',127,1),(6808,'Vadamazhai',127,1),(6809,'Vanduvancheri',127,1),(6810,'Vedaranyam Part - 1',127,1),(6811,'Vedaranyam Part - 2',127,1),(6812,'Vedaranyam Pattinam',127,1),(6813,'Vedaranyapuram',127,1),(6814,'Vellapallam',127,1),(6815,'Voimedu East',127,1),(6816,'Voimedu West',127,1),(6817,'Adakkam Puducombai',128,1),(6818,'Alathur Nadu',128,1),(6819,'Ariyur Nadu',128,1),(6820,'Bail Nadu',128,1),(6821,'Chittur Nadu',128,1),(6822,'Devanur Nadu',128,1),(6823,'Edappuli Nadu',128,1),(6824,'Gunduni Nadu',128,1),(6825,'Gundur Nadu',128,1),(6826,'Perakkarai Nadu',128,1),(6827,'Perlapadi Nadu',128,1),(6828,'Sellur Nadu',128,1),(6829,'Thinnaur Nadu',128,1),(6830,'Thiruppuli Nadu',128,1),(6831,'Valappur Nadu',128,1),(6832,'Valavanthi Nadu',128,1),(6833,'Anangur',129,1),(6834,'Ayyampalayam Agraharam',129,1),(6835,'Elanthakuttai',129,1),(6836,'Kadachanallur',129,1),(6837,'Kaliyanur',129,1),(6838,'Kaliyanur Agraharam',129,1),(6839,'Kokkarayanpettai',129,1),(6840,'Kumarapalayam Agraharam',129,1),(6841,'Kumarapalayam Amani',129,1),(6842,'Modamangalam Nklvao',129,1),(6843,'Modamangalam Agraharam',129,1),(6844,'Oodapalli Agraharam',129,1),(6845,'Padaveedu',129,1),(6846,'Pallakkapalayam',129,1),(6847,'Pallipalayam',129,1),(6848,'Pallipalayam Agraharam',129,1),(6849,'Pappampalyam',129,1),(6850,'Pudupalayam Agraharam',129,1),(6851,'Samayasangili Agraharam',129,1),(6852,'Sodapuram',129,1),(6853,'Agrahara Manappalli',130,1),(6854,'Agrahara Valavanthi',130,1),(6855,'Andapuram',130,1),(6856,'Andapuram Agraharam',130,1),(6857,'Aniyapuram',130,1),(6858,'Arasanatham',130,1),(6859,'Ariyur',130,1),(6860,'Arur Nklvao',130,1),(6861,'Chennapathampatti',130,1),(6862,'Idumpankulam',130,1),(6863,'K. Puliyampatty',130,1),(6864,'Kalipalayam Nklvao',130,1),(6865,'Komarapalayam',130,1),(6866,'Kumaripalayam',130,1),(6867,'Kuttalamparai',130,1),(6868,'Ladduvadi Nklvao',130,1),(6869,'Madakasampatty',130,1),(6870,'Mettupatty',130,1),(6871,'Mettupatty A',130,1),(6872,'Mohanur',130,1),(6873,'Moorthinaickanpatty',130,1),(6874,'N.Pudupatty',130,1),(6875,'Nanjai Edaiyar',130,1),(6876,'Oruvanthur',130,1),(6877,'Parali',130,1),(6878,'Peramandampalayam',130,1),(6879,'Pettapalayam',130,1),(6880,'Punjai Edaiyar',130,1),(6881,'Rasipalayam',130,1),(6882,'Sarkar Manappalli',130,1),(6883,'Sarkar Valavanthi',130,1),(6884,'Sengapalli',130,1),(6885,'Sevanthipatti',130,1),(6886,'Thipramahadevi',130,1),(6887,'Thipramahadevi Agraharam Nklvao',130,1),(6888,'Tholur',130,1),(6889,'Vadavathur',130,1),(6890,'Valavathi Enam',130,1),(6891,'Valayapatti',130,1),(6892,'A.K.Samudhiram',131,1),(6893,'Agrahara Ayyapalayam',131,1),(6894,'Agrahara Nattamangalam',131,1),(6895,'Agrahara Uduppam',131,1),(6896,'Avalnayakkanpatti',131,1),(6897,'Chinnamuthalaipatty Nklvao',131,1),(6898,'Elayapuram Agraharam',131,1),(6899,'Elayapuram Ayan',131,1),(6900,'Elur',131,1),(6901,'Ernapuram',131,1),(6902,'Jaggalnaikenpatti',131,1),(6903,'Jodikai Aniyar Nklvao',131,1),(6904,'Kadanthappatty',131,1),(6905,'Kalangani Nklvao',131,1),(6906,'Kalyani',131,1),(6907,'Kannoorpatty',131,1),(6908,'Karadipatty',131,1),(6909,'Karadipatty Thanthampatti',131,1),(6910,'Karaikurichi',131,1),(6911,'Kathapalli Nklvao',131,1),(6912,'Kathiranallur',131,1),(6913,'Keelsathampur',131,1),(6914,'Keerambur',131,1),(6915,'Kondichetty Patty',131,1),(6916,'Konur Nklvao',131,1),(6917,'Lakkapuram',131,1),(6918,'Malapatty Melmugam',131,1),(6919,'Marappanaickanpatty',131,1),(6920,'Marurpatti',131,1),(6921,'Minnampalli',131,1),(6922,'Mitta Aniyar',131,1),(6923,'Muthalaipatty',131,1),(6924,'N. Kosavampatty Nklvao',131,1),(6925,'Nallakoundanpalayam',131,1),(6926,'Nallipalayam Nklvao',131,1),(6927,'Namakkal',131,1),(6928,'Naravalur Agraharam',131,1),(6929,'Navani',131,1),(6930,'Pachal',131,1),(6931,'Pappinaickenpatty Nklvao',131,1),(6932,'Periapatty Nklvao',131,1),(6933,'Periya Goundampalayam',131,1),(6934,'Pidaripatty',131,1),(6935,'Podangam',131,1),(6936,'R. Puliyampatti',131,1),(6937,'Ramanaickenpatty Nklvao',131,1),(6938,'Rangappanaickanpalayam',131,1),(6939,'Rasampalayam',131,1),(6940,'Sarkar Nattamangalam Nklvao',131,1),(6941,'Sarkar Uduppam',131,1),(6942,'Sarvamaniya Aniyar Nklvao',131,1),(6943,'Sellppampatty',131,1),(6944,'Siluvampatty',131,1),(6945,'Singilipatty',131,1),(6946,'Thalampadi Nklvao',131,1),(6947,'Thaligai Nklvao',131,1),(6948,'Thanathampatti Nklvao',131,1),(6949,'Thathathiripuram Nklvao',131,1),(6950,'Thathayangarpatty',131,1),(6951,'Thathithiripuram Karadipatti',131,1),(6952,'Thindamangalam',131,1),(6953,'Thottipalayam',131,1),(6954,'Thottiyapatti Nklvao',131,1),(6955,'Thummankurichi Nklvao',131,1),(6956,'Vagurampatty Nklvao',131,1),(6957,'Vallipuram',131,1),(6958,'Vasanthapuram Nklvao',131,1),(6959,'Veesanam',131,1),(6960,'Vettambadi',131,1),(6961,'Vittamanaickanpatty',131,1),(6962,'Agrahara Konthalam',132,1),(6963,'Agrahara Kunnathur',132,1),(6964,'Agraharavengarai',132,1),(6965,'Anangur',132,1),(6966,'Ariyurpatty',132,1),(6967,'Arthanaripalayam',132,1),(6968,'Devanampalayam',132,1),(6969,'Devaraya Samutharam',132,1),(6970,'E.Nallagoundampalayam',132,1),(6971,'Eruttanai',132,1),(6972,'Irrukur',132,1),(6973,'Jamine Ellampalli',132,1),(6974,'Kabilakuruchi',132,1),(6975,'Kodhur',132,1),(6976,'Kodhur Agraharam',132,1),(6977,'Kolaram',132,1),(6978,'Koodacherry',132,1),(6979,'Koppanampalayam',132,1),(6980,'Kothamangalam',132,1),(6981,'Kunnamalai',132,1),(6982,'Kuppirikkapalayam',132,1),(6983,'Kurumpalamahadevi',132,1),(6984,'Manickanatham',132,1),(6985,'Maniyanur',132,1),(6986,'Melsathampur',132,1),(6987,'Mitta Kunnathur',132,1),(6988,'Velur Nadanthai',132,1),(6989,'Nallur',132,1),(6990,'Pandamangala',132,1),(6991,'Paramathi',132,1),(6992,'Periyasolipalayam',132,1),(6993,'Perunkurichi',132,1),(6994,'Pillaikalathur',132,1),(6995,'Pillikalpalayam',132,1),(6996,'Pillur',132,1),(6997,'Piranthagam',132,1),(6998,'Pommalapalayam',132,1),(6999,'Pothananur',132,1),(7000,'Punjai Edaiyar Melmugam',132,1),(7001,'Ramadevam',132,1),(7002,'Sarkar Konthalam',132,1),(7003,'Sarkar Vengarai',132,1),(7004,'Seerappalli',132,1),(7005,'Selur',132,1),(7006,'Serukkalai',132,1),(7007,'Sirunallikoil',132,1),(7008,'Sithampoondi',132,1),(7009,'Solasiramani',132,1),(7010,'Sullipalayam',132,1),(7011,'Sungakarampatty',132,1),(7012,'Thidumal',132,1),(7013,'Thidumal Goundampalayam',132,1),(7014,'Vadagaraiattur Melmugam',132,1),(7015,'Veeranampalayam',132,1),(7016,'Velur',132,1),(7017,'Villipalayam',132,1),(7021,'ஆலக்குடி add',204,1),(7023,'திருப்பரங்குன்றம்',316,1),(7028,'Computer Education 1',316,1),(7029,'Computer Education 2',316,1),(7030,'மத்திக்கோடு',89,1),(7031,'Computer Education 3',316,1),(7032,'Computer Education 4',316,1),(7034,'திங்கள்சந்தை',89,1),(7035,'Computer Education 5',316,1),(7036,'ஊத்தங்கரை',108,1),(7037,'Computer Education 6',316,1),(7039,'Computer Education 7',316,1),(7045,'Computer Education 8',316,1),(7046,'Computer Education 9',316,1),(7047,'Computer Education 10',316,1),(7048,'Computer Education 11',316,1),(7053,'குட்டலாடம்பட்டி',133,1),(7054,'மலையாம்பாளையம்',133,1),(7055,'மலையாம்பட்டி',133,1),(7056,'Computer Education 12',316,1),(7057,'மதியம் பட்டி',133,1),(7058,'ஆலக்குடி chief',204,1),(7059,'மாட்டுவேலம்பட்டி',133,1),(7060,'Computer Education 13',316,1),(7061,'Computer Education 14',316,1),(7062,'மின்னக்கல்',133,1),(7063,'Computer Education 15',316,1),(7064,'மூலக்குறிச்சி',133,1),(7065,'மூலக்காடு',133,1),(7066,'மூலக்காடு.',133,1),(7067,'Computer Education 16',316,1),(7068,'கல்விராயன்பட்டி',204,1),(7069,'முருங்கப்பட்டி',133,1),(7070,'Computer Education 17',316,1),(7072,'நடுப்பட்டி',133,1),(7073,'நாமகிரிப்பேட்டை',133,1),(7074,'நாரைக்கிணறு',133,1),(7075,'நாவல்பட்டி',133,1),(7076,'ஒ.ஜேடர்பாளையம்',133,1),(7077,'கும்பகோணம்',199,1),(7078,'ஒடுவன்குறிச்சி',133,1),(7079,'திருப்பரங்குன்றம்',116,1),(7080,' Tondiarpet (part 5)',27,1),(7081,' குடியாத்தம்',290,1),(7084,'விழுப்புரம் நகரம்',303,1),(7085,'பாலப்பள்ளம்',90,1),(7086,'Computer Education 18',316,1),(7087,'Computer Education 19',316,1),(7088,'Tailoring Institution 1',318,1),(7090,'தெற்கு கழுகுமலை',240,1),(7093,'கோட்டார்',88,1),(7094,'அந்தியூர் A',67,1),(7095,'Tailoring Institution 2',318,1),(7096,'பிள்ளையார்பட்டி',204,1),(7102,'தாமரைக்குளம்',88,1),(7107,'நுள்ளிவிளை',89,1),(7108,'பாவுப்பட்டு',NULL,1),(7109,'திருவண்ணாமலை',NULL,1),(7110,'ஆடையூர்',NULL,1),(7111,'ராஜக்கமங்கலம்',88,1),(7112,'பள்ளிஅக்ரஹாரம்',204,1),(7113,'கோவில்பட்டி.',240,1),(7114,'A. Palayapalayam',134,1),(7115,'Ackiampatty Nklvao',134,1),(7116,'Bellukkurchi Nklvao',134,1),(7117,'Bodinaickenpatty',134,1),(7118,'Bommasamudram',134,1),(7119,'Boommasamuthiram',134,1),(7120,'Chithamparapatty',134,1),(7121,'Devarayapuram',134,1),(7122,'Erumapatti Nklvao',134,1),(7123,'Gajakombai',134,1),(7124,'Ichchampatti',134,1),(7125,'Kalappanaickenpatty',134,1),(7126,'Kalkurichi Nklvao',134,1),(7127,'Kavakaranpatti',134,1),(7128,'Kejalnaickanpatti Nklvao',134,1),(7129,'Konangipatty',134,1),(7130,'Kondamanaickepatty Nklvao',134,1),(7131,'Melapatty',134,1),(7132,'Muthukappatty',134,1),(7133,'Muttanchetti',134,1),(7134,'Naducombai Nklvao',134,1),(7135,'Pachudayam Patty',134,1),(7136,'Palapatti',134,1),(7137,'Palapatty Agraharam',134,1),(7138,'Pallamparai',134,1),(7139,'Pallipatty',134,1),(7140,'Pavithram Nklvao',134,1),(7141,'Pavithram Puthur',134,1),(7142,'Periakulam',134,1),(7143,'Perumapatti Keelakku',134,1),(7144,'Perumapatti Merkku',134,1),(7145,'Perumapatty Agraharam',134,1),(7146,'Perumaptty',134,1),(7147,'Ponnarakulam Bit 1,3,4',134,1),(7148,'Ponnarakulam Bit 2',134,1),(7149,'Ponneri Nklvao',134,1),(7150,'Pottanam',134,1),(7151,'Potty Reddypatti',134,1),(7152,'Potty Reddypatti Agraharam',134,1),(7153,'Pudukkottai',134,1),(7154,'Pudukombai Nklvao',134,1),(7155,'Reddipatti Agraharam',134,1),(7156,'Reddipatty',134,1),(7157,'S. Palayapalayam',134,1),(7158,'Sendamangalam',134,1),(7159,'Singalangombai',134,1),(7160,'Sivanaickanpatti',134,1),(7161,'Thirumalaigiri Nklvao',134,1),(7162,'Thirumalaipatti',134,1),(7163,'Thoittamudayampatti',134,1),(7164,'Thusur',134,1),(7165,'Thuthikulam',134,1),(7166,'Uthirakidikaval',134,1),(7167,'Valavanthicombai',134,1),(7168,'Valayapatty Ichchampatti',134,1),(7169,'Varagur',134,1),(7170,'Varatharajapuram',134,1),(7171,'A.Erayamangalam',135,1),(7172,'Agaram',135,1),(7173,'Akkalampatty',135,1),(7174,'Andarapatti',135,1),(7175,'Andipalayam',135,1),(7176,'Animoor',135,1),(7177,'Athipalayam',135,1),(7178,'Avinasipatty',135,1),(7179,'Bommanpatti',135,1),(7180,'Chikkanaickenpalayam',135,1),(7181,'Chinnamanali',135,1),(7182,'Chinnathambipalayam',135,1),(7183,'Chittalandur',135,1),(7184,'Devanankurichi',135,1),(7185,'Elanagar',135,1),(7186,'Elayampalayam',135,1),(7187,'Elayampalayam',135,1),(7188,'Emapalli',135,1),(7189,'Goundampalayam',135,1),(7190,'Illupuli',135,1),(7191,'Kailamsampalayam',135,1),(7192,'Kailasampalayam',135,1),(7193,'Kallupalayam Nklvao',135,1),(7194,'Karumanur',135,1),(7195,'Karumapuram',135,1),(7196,'Karungalpatty',135,1),(7197,'Karuppagoundampalayam',135,1),(7198,'Karveppampatti',135,1),(7199,'Kilapalayam',135,1),(7200,'Kokkalai',135,1),(7201,'Kolangondai',135,1),(7202,'Konnaiyar',135,1),(7203,'Koothampoondi',135,1),(7204,'Koothampoondi Agraharam',135,1),(7205,'Kottapalayam',135,1),(7206,'Kottapalayam',135,1),(7207,'Kovilpalayam',135,1),(7208,'Kumaramangalam',135,1),(7209,'Kumarapalayam @ Koundampalayam',135,1),(7210,'Kumarapalyam',135,1),(7211,'Kuppandapalayam',135,1),(7212,'Kuthanatham',135,1),(7213,'Lathuvadi',135,1),(7214,'Mallasamudram East',135,1),(7215,'Mallasamudram West',135,1),(7216,'Mamundi',135,1),(7217,'Manathi',135,1),(7218,'Mandagapalayam',135,1),(7219,'Mangalam',135,1),(7220,'Maraparai',135,1),(7221,'Mavureddipatty',135,1),(7222,'Mettupalayam Nklvao',135,1),(7223,'Minnampalli',135,1),(7224,'Molasi',135,1),(7225,'Molipalli',135,1),(7226,'Morangam',135,1),(7227,'Munjanoor',135,1),(7228,'Musiri',135,1),(7229,'Muthanampalayam',135,1),(7230,'Nagarpalayam',135,1),(7231,'Nallipalayam',135,1),(7232,'Neikarapatty',135,1),(7233,'Oduvampalayam',135,1),(7234,'Palamedu',135,1),(7235,'Pallakuli',135,1),(7236,'Pallakuli Agraharam',135,1),(7237,'Paruthipalli',135,1),(7238,'Patlur',135,1),(7239,'Periyamanali',135,1),(7240,'Pillanatham',135,1),(7241,'Pirithi',135,1),(7242,'Pokkampalayam',135,1),(7243,'Pudupuliampatti',135,1),(7244,'Pullagoundampatty',135,1),(7245,'Punjai Pudupalayam',135,1),(7246,'Puthur-East',135,1),(7247,'Rajapalayam',135,1),(7248,'Ramapuram',135,1),(7249,'S.Erayamangalam',135,1),(7250,'Sappayapuram',135,1),(7251,'Sathinaickenpalayam',135,1),(7252,'Seetharampalayam',135,1),(7253,'Sembampalayam',135,1),(7254,'Sengodampalayam',135,1),(7255,'Shenbagamadevi',135,1),(7256,'Sirumolasi',135,1),(7257,'Sundangipalayam',135,1),(7258,'Thirumangalam',135,1),(7259,'Thirumangalam Pudupalayam',135,1),(7260,'Thokkavadi',135,1),(7261,'Thokkavadi-Goundempalayam',135,1),(7262,'Thondipatty',135,1),(7263,'Thottipalayam',135,1),(7264,'Tiruchengode',135,1),(7265,'Unjanai',135,1),(7266,'Vandinatham',135,1),(7267,'Varagurampatty',135,1),(7268,'Vattapparappu',135,1),(7269,'Vattoor',135,1),(7270,'Vettuvampalayam',135,1),(7271,'Aiynapuram',136,1),(7272,'Alagiripalayam',136,1),(7273,'Athanur(N)',136,1),(7274,'Athanur(S)',136,1),(7275,'Athur',136,1),(7276,'Chettikulam',136,1),(7277,'Elanthalapatti',136,1),(7278,'Irur',136,1),(7279,'Kannapadi',136,1),(7280,'Karai(E)',136,1),(7281,'Karai(W)',136,1),(7282,'Kolakkanatham',136,1),(7283,'Kolathur(E)',136,1),(7284,'Kolathur(W)',136,1),(7285,'Koothur',136,1),(7286,'Kottarai',136,1),(7287,'Kudalore',136,1),(7288,'Mavillangai',136,1),(7289,'Melamathur',136,1),(7290,'Nakkasalem',136,1),(7291,'Naranamangalam',136,1),(7292,'Nattarmangala',136,1),(7293,'Nochikulam',136,1),(7294,'Padalur(E)',136,1),(7295,'Padalur(W)',136,1),(7296,'Pujangarayanallur',136,1),(7297,'Puthu Ammapalayam',136,1),(7298,'Sathanur',136,1),(7299,'Sillakudi(N)',136,1),(7300,'Sillakudi(S)',136,1),(7301,'Sirukanpur(E)',136,1),(7302,'Sirukanpur(W)',136,1),(7303,'Siruvayalur',136,1),(7304,'T.Kalathur',136,1),(7305,'Thenur',136,1),(7306,'Therani',136,1),(7307,'Thondapadi',136,1),(7308,'Timmur',136,1),(7309,'Varagupadi',136,1),(7310,'Adu Thurai',137,1),(7311,'Agaramsegoor',137,1),(7312,'Asur',137,1),(7313,'Athiyur(N)',137,1),(7314,'Athiyur(S)',137,1),(7315,'Elumur(E)',137,1),(7316,'Elumur(W)',137,1),(7317,'Kadur(N)',137,1),(7318,'Kadur(S)',137,1),(7319,'Kelaperambalur',137,1),(7320,'Kelapuliyur(N)',137,1),(7321,'Kelapuliyur(S)',137,1),(7322,'Killumathur(N)',137,1),(7323,'Kilumathur(S)',137,1),(7324,'Krumbur',137,1),(7325,'Kulapadi',137,1),(7326,'Kunnam',137,1),(7327,'Malavarayanallur',137,1),(7328,'Nannai(E)',137,1),(7329,'Nannai(W)',137,1),(7330,'Ogalur(E)',137,1),(7331,'Ogalur(W)',137,1),(7332,'Olaipadi(E)',137,1),(7333,'Olaipadi(W)',137,1),(7334,'Othiyam',137,1),(7335,'Paravai(E)',137,1),(7336,'Paravai(W)',137,1),(7337,'Pennakonam(N)',137,1),(7338,'Pennakonam(S)',137,1),(7339,'Perali(N)',137,1),(7340,'Perali(S)',137,1),(7341,'Periyammapalayam',137,1),(7342,'Periyavenmani(E)',137,1),(7343,'Periyavenmani(W)',137,1),(7344,'Perumathur(N)',137,1),(7345,'Perumathur(S)',137,1),(7346,'Puduvettakudi',137,1),(7347,'Sirumathur',137,1),(7348,'Sithali(E)',137,1),(7349,'Sithali(W)',137,1),(7350,'Thirumanthurai',137,1),(7351,'Thungapuram(N)',137,1),(7352,'Thungapuram(S)',137,1),(7353,'Vadakkalur',137,1),(7354,'Varagur',137,1),(7355,'Vasistapuram',137,1),(7356,'Vayalapadi',137,1),(7357,'Aiylur',138,1),(7358,'Alangili',138,1),(7359,'Ammapalayam',138,1),(7360,'Aranarai(N)',138,1),(7361,'Aranarai(S)',138,1),(7362,'Chatramanai',138,1),(7363,'Elambalur',138,1),(7364,'Esanai',138,1),(7365,'Kalarampatti',138,1),(7366,'Kalpadi (N)',138,1),(7367,'Kalpadi(S)',138,1),(7368,'Keelakarai',138,1),(7369,'Kurumbalur(N)',138,1),(7370,'Kurumbalur(S)',138,1),(7371,'Ladapuram(E)',138,1),(7372,'Ladapuram(W)',138,1),(7373,'Melapuliyur(E)',138,1),(7374,'Melapuliyur(W)',138,1),(7375,'Nochiyam',138,1),(7376,'Perambalur(N)',138,1),(7377,'Perambalur(S)',138,1),(7378,'Pommanapadi',138,1),(7379,'Pudu Naduvalur',138,1),(7380,'Sengunam',138,1),(7381,'Siruvachur',138,1),(7382,'Thurai Mangalam',138,1),(7383,'Velur',138,1),(7384,'Agaram',139,1),(7385,'Anukkur',139,1),(7386,'Arumbavur',139,1),(7387,'Eraiyur',139,1),(7388,'Kaikalathur(E)',139,1),(7389,'Kaikalathur(W)',139,1),(7390,'Kariyanur',139,1),(7391,'Malayalapatti',139,1),(7392,'Mettupalayam(N)',139,1),(7393,'Mettupalayam(S)',139,1),(7394,'Neikuppai',139,1),(7395,'Noothapur(N)',139,1),(7396,'Noothapur(S)',139,1),(7397,'Pandagapadi',139,1),(7398,'Pasumbalur(N)',139,1),(7399,'Pasumbalur(S)',139,1),(7400,'Peraiyur',139,1),(7401,'Periyavadakarai',139,1),(7402,'Pillankulam',139,1),(7403,'Pimbalur',139,1),(7404,'Poolambadi(E)',139,1),(7405,'Poolambadi(W)',139,1),(7406,'Prammadesam',139,1),(7407,'Thaluthalai',139,1),(7408,'Thevaiyur(N)',139,1),(7409,'Thevaiyur(S)',139,1),(7410,'Thiruvalathurai',139,1),(7411,'Thondamanthurai(E)',139,1),(7412,'Thondamanthurai(W)',139,1),(7413,'Thondapadi',139,1),(7414,'Udumbium',139,1),(7415,'V.Kalathur',139,1),(7416,'Vallikandapuram',139,1),(7417,'Venbavoor',139,1),(7418,'Vengalam(E)',139,1),(7419,'Vengalam(W)',139,1),(7420,'Venganur',139,1),(7421,'Veppanthattai (N)',139,1),(7422,'Veppanthattai (S)',139,1),(7423,'Alangudi',140,1),(7424,'Anavayal 1 Pit',140,1),(7425,'Anavayal 2 Pit',140,1),(7426,'Andavarayapuram',140,1),(7427,'Araiyappatti',140,1),(7428,'Ayippatti',140,1),(7429,'Immanampatti',140,1),(7430,'Isukuppatti',140,1),(7431,'K.Rasiyamangalam',140,1),(7432,'K.V.Kottai',140,1),(7433,'Kaikkurichi',140,1),(7434,'Kalangudi',140,1),(7435,'Kallalangudi',140,1),(7436,'Kanniyampatti',140,1),(7437,'Karambakadu Inam',140,1),(7438,'Karambakkadu Jamin',140,1),(7439,'Katthakurichi',140,1),(7440,'Kayampatti',140,1),(7441,'Keelaiyur',140,1),(7442,'Keelathur',140,1),(7443,'Keeramangalam North',140,1),(7444,'Keeramangalam South',140,1),(7445,'Koodalur',140,1),(7446,'Kothamangalam',140,1),(7447,'Kothamangalam North',140,1),(7448,'Kothamangalam South',140,1),(7449,'Kotthakottai',140,1),(7450,'Kovilur',140,1),(7451,'Kovilur Devasthanam',140,1),(7452,'Kulamangalam North',140,1),(7453,'Kulamangalam South',140,1),(7454,'Kulavaippatti',140,1),(7455,'Kuppakudi',140,1),(7456,'L.N.Puram',140,1),(7457,'M.Rasiyamangalam',140,1),(7458,'Malakkudi',140,1),(7459,'Manaiyambalam',140,1),(7460,'Mangadu',140,1),(7461,'Manjanviduthi',140,1),(7462,'Melathur',140,1),(7463,'Mudukkuvayal',140,1),(7464,'Muthupattinam',140,1),(7465,'Nagaram',140,1),(7466,'Nambukuli',140,1),(7467,'Neduvasal Keelpathi',140,1),(7468,'Neduvasal Melpathi',140,1),(7469,'Paalaiyur',140,1),(7470,'Pachikkottai',140,1),(7471,'Pallathividuthi',140,1),(7472,'Panankulam',140,1),(7473,'Pathampatti',140,1),(7474,'Poovarasakudi',140,1),(7475,'Pudukkottaividuthi',140,1),(7476,'Pulichankadu',140,1),(7477,'Pullanviduthi',140,1),(7478,'Senthakkudi',140,1),(7479,'Senthankudi',140,1),(7480,'Seriyalur Inam',140,1),(7481,'Seriyalur Jameen',140,1),(7482,'Settienthal',140,1),(7483,'Settivayal',140,1),(7484,'Sooranviduthi',140,1),(7485,'Thechinapuram',140,1),(7486,'Thirukattalai',140,1),(7487,'Thiruvarangulam',140,1),(7488,'Vadakadu',140,1),(7489,'Vallathirakkottai',140,1),(7490,'Vandakkottai',140,1),(7491,'Venkadakkulam',140,1),(7492,'Vennavalkudi',140,1),(7493,'Veppangudi',140,1),(7494,'Vijayaregunathapuram',140,1),(7495,'Alangudi',141,1),(7496,'Alapiranthan',141,1),(7497,'Aliyanilai',141,1),(7498,'Allaraimelavayal',141,1),(7499,'Amanchi',141,1),(7500,'Amarasimendrapuram',141,1),(7501,'Ambalpuram',141,1),(7502,'Ammanchaki',141,1),(7503,'Aranthangi',141,1),(7504,'Arasarkulam East',141,1),(7505,'Arasarkulam West',141,1),(7506,'Ariyamaraikadu',141,1),(7507,'Arunachalapuram',141,1),(7508,'Athani - North',141,1),(7509,'Athani - South',141,1),(7510,'Avanaththaankottai',141,1),(7511,'Ayinkudi',141,1),(7512,'Balakrishnapuram',141,1),(7513,'Biramanavayal',141,1),(7514,'Chettikadu',141,1),(7515,'Chidambarapuram',141,1),(7516,'Chidambaraviduthi',141,1),(7517,'Dharmarajanvayal',141,1),(7518,'Eaganivayal',141,1),(7519,'Eagaperumalur',141,1),(7520,'Erukalakkottai',141,1),(7521,'Ettiyathali',141,1),(7522,'Idaiyar',141,1),(7523,'Kalakkamangalam',141,1),(7524,'Kalakudi',141,1),(7525,'Kammankadu',141,1),(7526,'Kandichankadu',141,1),(7527,'Karaikadu',141,1),(7528,'Karavayal',141,1),(7529,'Keelacheri',141,1),(7530,'Keelavijayapuram',141,1),(7531,'Keelkudi',141,1),(7532,'Kodivayal',141,1),(7533,'Koohanur',141,1),(7534,'Koongudi',141,1),(7535,'Kovilvayal',141,1),(7536,'Kulathur',141,1),(7537,'Kummakkadu',141,1),(7538,'Kundagavayal',141,1),(7539,'Kurumboor',141,1),(7540,'Maivayal',141,1),(7541,'Manavanallur',141,1),(7542,'Mangalanadu North',141,1),(7543,'Mangalanadu South',141,1),(7544,'Mangudi',141,1),(7545,'Manivilanvayal',141,1),(7546,'Mannakudi',141,1),(7547,'Maramadakki',141,1),(7548,'Maruthankudi',141,1),(7549,'Mathur',141,1),(7550,'Melapattu',141,1),(7551,'Melmangalam',141,1),(7552,'Merpanaikadu',141,1),(7553,'Mookudi',141,1),(7554,'Munnuthanvayal',141,1),(7555,'Nagudi',141,1),(7556,'Narpavalakudi',141,1),(7557,'Neivaththali',141,1),(7558,'Neivelinathapuram',141,1),(7559,'Nemelikadu',141,1),(7560,'Oomakanvayal',141,1),(7561,'Oorvani',141,1),(7562,'Pallathivayal',141,1),(7563,'Pangayathankudi',141,1),(7564,'Panjathi',141,1),(7565,'Paravakkottai',141,1),(7566,'Pedaarikadu',141,1),(7567,'Periyaalur',141,1),(7568,'Perunavalur',141,1),(7569,'Poonaiyankundu',141,1),(7570,'Poovaththakudi',141,1),(7571,'Puduvakottai',141,1),(7572,'Rajendrapuram',141,1),(7573,'Ramasamypuram',141,1),(7574,'Rayanvayal',141,1),(7575,'Rethinakkottai',141,1),(7576,'Saththanenthal',141,1),(7577,'SAeenamangalam',141,1),(7578,'Sengamari',141,1),(7579,'Silatoor',141,1),(7580,'Sirunattanvayal',141,1),(7581,'Sithakanni (068)',141,1),(7582,'Sithakanni (069)',141,1),(7583,'Sivanthankadu',141,1),(7584,'Subramaniapuram',141,1),(7585,'Thanthani',141,1),(7586,'Thedaki',141,1),(7587,'Thirunalur',141,1),(7588,'Thiruvapadi',141,1),(7589,'Thoothakudi',141,1),(7590,'Ulagalanthanvayal',141,1),(7591,'Vallavari',141,1),(7592,'Vellattumangalam',141,1),(7593,'Vembankudi',141,1),(7594,'Vengur',141,1),(7595,'Veramangalam',141,1),(7596,'Vettanur I-Bit',141,1),(7597,'Vettanur Ii-Bit',141,1),(7598,'Vijayapuram',141,1),(7599,'Amaradakki',142,1),(7600,'Arasur',142,1),(7601,'Arasur (Mathagam)',142,1),(7602,'Avudaiyarkoil',142,1),(7603,'Chithakkur',142,1),(7604,'Eambal',142,1),(7605,'Eanangam',142,1),(7606,'Echikkottai',142,1),(7607,'Eechangudi',142,1),(7608,'Ellunuthimangalam',142,1),(7609,'Esamangalam',142,1),(7610,'Irumbanadu',142,1),(7611,'Kaanoor',142,1),(7612,'Kadavakkottai',142,1),(7613,'Kalabam',142,1),(7614,'Kallakathan',142,1),(7615,'Kandayan Kottai',142,1),(7616,'Kannakkur',142,1),(7617,'Kannamangalam',142,1),(7618,'Karur',142,1),(7619,'Kasavayal',142,1),(7620,'Kathiramangalam',142,1),(7621,'Kavathukudi',142,1),(7622,'Keelkudi',142,1),(7623,'Kidankivayal',142,1),(7624,'Koveriyenthal',142,1),(7625,'Kovinikidangu',142,1),(7626,'Kudikadu',142,1),(7627,'Kulathur',142,1),(7628,'Kumulur',142,1),(7629,'Kurungalur',142,1),(7630,'Magalienthal',142,1),(7631,'Maruthangudi',142,1),(7632,'Mathagam',142,1),(7633,'Memisal',142,1),(7634,'Muthuvalarkudi',142,1),(7635,'Narasingapuram',142,1),(7636,'Nariyanenthal',142,1),(7637,'Nattanipurasakudi',142,1),(7638,'Okkur',142,1),(7639,'P.U. Subramaniyapuram',142,1),(7640,'P.U.P.Vadavayal',142,1),(7641,'Pallivayal',142,1),(7642,'Palzhavarasan',142,1),(7643,'Parayathur',142,1),(7644,'Pattamudayan',142,1),(7645,'Pazhankulam',142,1),(7646,'Peranur',142,1),(7647,'Perunthamarai',142,1),(7648,'Pilluvalasai',142,1),(7649,'Piranthani',142,1),(7650,'Ponpethi',142,1),(7651,'Poovalur',142,1),(7652,'Puduvakadu',142,1),(7653,'Puduvettivayal',142,1),(7654,'Punniyavayal',142,1),(7655,'Ramachandrapuram',142,1),(7656,'Sananenthal',142,1),(7657,'Sathiyadi',142,1),(7658,'Satthakudi',142,1),(7659,'Satthiakudi',142,1),(7660,'Satthirappatti',142,1),(7661,'Selvanenthal',142,1),(7662,'Senganam',142,1),(7663,'Seppavayal',142,1),(7664,'Sirukadavakkottai',142,1),(7665,'Sirumaruthur',142,1),(7666,'Siruveli',142,1),(7667,'Sivaganapuram',142,1),(7668,'Sounthirinayagi Puram',142,1),(7669,'Thakkadivayal',142,1),(7670,'Thalanur',142,1),(7671,'Thalikadu',142,1),(7672,'Thanikondan',142,1),(7673,'Theeyathur',142,1),(7674,'Theeyur',142,1),(7675,'Thennamari',142,1),(7676,'Thillaivayal',142,1),(7677,'Thirapidungi',142,1),(7678,'Thiruppunavasal',142,1),(7679,'Thiruvakudi',142,1),(7680,'Thonnakudy',142,1),(7681,'Thunsanur',142,1),(7682,'Valayanvayal',142,1),(7683,'Valuvur',142,1),(7684,'Vattatthur',142,1),(7685,'Veelimangalam',142,1),(7686,'Veelimar',142,1),(7687,'Veliathur',142,1),(7688,'Velivayal (034)',142,1),(7689,'Velivayal (081)',142,1),(7690,'Vellalavayal',142,1),(7691,'Velvarai',142,1),(7692,'Vethinivayal',142,1),(7693,'Andanur',143,1),(7694,'Aravampatti',143,1),(7695,'Ariyanipatti',143,1),(7696,'Athangaraividuthi',143,1),(7697,'Kallakottai',143,1),(7698,'Kattunaval',143,1),(7699,'Komapuram',143,1),(7700,'Kovilur',143,1),(7701,'Kulathur',143,1),(7702,'Kurumpoondi',143,1),(7703,'Malaiyadippatti',143,1),(7704,'Manchapettai',143,1),(7705,'Manganur',143,1),(7706,'Mattangal',143,1),(7707,'Meikudipatti',143,1),(7708,'Mudhukulam',143,1),(7709,'Nadupatti',143,1),(7710,'Nampuranpatti',143,1),(7711,'Nepughai',143,1),(7712,'Nodiyur',143,1),(7713,'Palayagandarvakottai',143,1),(7714,'Periayakottai',143,1),(7715,'Pisanathur',143,1),(7716,'Pudunagar',143,1),(7717,'Pudupatti',143,1),(7718,'Punakkulam',143,1),(7719,'Sengamviduthi',143,1),(7720,'Sevier Kudikadu',143,1),(7721,'Sothuppalai',143,1),(7722,'Sundampatti',143,1),(7723,'Thachankurichi',143,1),(7724,'Thuvar',143,1),(7725,'Vadugapatti',143,1),(7726,'Valavampatti',143,1),(7727,'Veeradipatti',143,1),(7728,'Vellalaviduthi',143,1),(7729,'Viralippatti',143,1),(7730,'Alathur',144,1),(7731,'Annavasal',144,1),(7732,'Ariyur',144,1),(7733,'Ayingudi',144,1),(7734,'Chithannavasal',144,1),(7735,'Ennai Melapatti',144,1),(7736,'Esvarankovil',144,1),(7737,'Gothandaramapuram',144,1),(7738,'Idaiyapatti',144,1),(7739,'Iluppur',144,1),(7740,'Irunthirapatti',144,1),(7741,'Kadamparayapatti',144,1),(7742,'Kathavampatti',144,1),(7743,'Kattakudi',144,1),(7744,'Keezhakurichi',144,1),(7745,'Kilikkudi',144,1),(7746,'Kongudipatti',144,1),(7747,'Koodalur',144,1),(7748,'Kothirapatti',144,1),(7749,'Kudumiyanmalai',144,1),(7750,'Kurukkapatti',144,1),(7751,'Lekkanapatti',144,1),(7752,'Mampatti',144,1),(7753,'Mangudi',144,1),(7754,'Marayappatti',144,1),(7755,'Maruthampatti',144,1),(7756,'Mathiyanallur',144,1),(7757,'Nangupatti',144,1),(7758,'Paiyur',144,1),(7759,'Pakkudi',144,1),(7760,'Panampatti',144,1),(7761,'Panangudi',144,1),(7762,'Parampur',144,1),(7763,'Pathipatti',144,1),(7764,'Perumanadu',144,1),(7765,'Perunchinai',144,1),(7766,'Perungudipatti',144,1),(7767,'Peyaal',144,1),(7768,'Pillankudi',144,1),(7769,'Pulvayal',144,1),(7770,'Punkinipatti',144,1),(7771,'Puthur',144,1),(7772,'Rapoosal',144,1),(7773,'Suntharapatti',144,1),(7774,'Thachampatti',144,1),(7775,'Thalinchi',144,1),(7776,'Thannangudi',144,1),(7777,'Thayinipatti',144,1),(7778,'Thirunallur',144,1),(7779,'Thiruvengaivasal',144,1),(7780,'Vannarappatti',144,1),(7781,'Vayalogam',144,1),(7782,'Veerapatti',144,1),(7783,'Vellanchar',144,1),(7784,'Vettukadu',144,1),(7785,'Vilapatti',144,1),(7786,'Vilathupatti',144,1),(7787,'Visalur',144,1),(7788,'Ambukovil',145,1),(7789,'Athiranviduthi',145,1),(7790,'Ayippatti',145,1),(7791,'Echanviduthi',145,1),(7792,'Ilaikadividuthi',145,1),(7793,'K.Thergutheru',145,1),(7794,'Kalabam',145,1),(7795,'Kaliyaranviduthi',145,1),(7796,'Kallumadai',145,1),(7797,'Kanakkankadu',145,1),(7798,'Karambakkudi',145,1),(7799,'Karambaviduthi',145,1),(7800,'Karu Kelatheru',145,1),(7801,'Karuppattippatti',145,1),(7802,'Kattathi',145,1),(7803,'Keerathur',145,1),(7804,'Kilankadu',145,1),(7805,'Kulanthiranpattu',145,1),(7806,'Kurumbivayal',145,1),(7807,'Mailankonpatti',145,1),(7808,'Malaiyur',145,1),(7809,'Mankottai',145,1),(7810,'Maruthankonviduthi',145,1),(7811,'Mullankurichi North',145,1),(7812,'Mullankurichi South',145,1),(7813,'Muthalippatti',145,1),(7814,'Odappaviduthi',145,1),(7815,'Pallavarayanpathai',145,1),(7816,'Panthuvakkottai',145,1),(7817,'Pappapatti',145,1),(7818,'Pattathikkadu',145,1),(7819,'Peyadippatti',145,1),(7820,'Pilaviduthi',145,1),(7821,'Ponnanviduthi',145,1),(7822,'Puduviduthi',145,1),(7823,'Rangiyanviduthi',145,1),(7824,'Regunathapuram',145,1),(7825,'Sengamedu',145,1),(7826,'Sinnankonviduthi',145,1),(7827,'Teethanippatti',145,1),(7828,'Teethanviduthi',145,1),(7829,'Thattamanaippatti',145,1),(7830,'Thergutheru',145,1),(7831,'Thirumanancheri',145,1),(7832,'Thiruppakkovil',145,1),(7833,'Vadatheru',145,1),(7834,'Valankondanviduthi',145,1),(7835,'Vanakkankadu',145,1),(7836,'Vandanviduthi',145,1),(7837,'Vellalaviduthi',145,1),(7838,'Ammachathiram',146,1),(7839,'Andakulam',146,1),(7840,'Chettipatti',146,1),(7841,'Irumbali Nedunchery',146,1),(7842,'Kadambavayal',146,1),(7843,'Kalamavur',146,1),(7844,'Kannankudi',146,1),(7845,'Kattukottaipatti',146,1),(7846,'Keelaiyur',146,1),(7847,'Keeranur',146,1),(7848,'Killanur',146,1),(7849,'Killukottai',146,1),(7850,'Killukulavaipatti',146,1),(7851,'Kulathur',146,1),(7852,'Kumaramangalam',146,1),(7853,'Kunnandarkoil',146,1),(7854,'Lakshmanapatti',146,1),(7855,'Mandaiyur',146,1),(7856,'Mangathevanpatti',146,1),(7857,'Maruthur',146,1),(7858,'Mathur',146,1),(7859,'Melapudhuvayal',146,1),(7860,'Melur',146,1),(7861,'Mettupatti',146,1),(7862,'Minnathur',146,1),(7863,'Moottampatti',146,1),(7864,'Muttukadu',146,1),(7865,'Nanjur',146,1),(7866,'Narangiyanpatti',146,1),(7867,'Narthamalai',146,1),(7868,'Odugampatti',146,1),(7869,'Odukur',146,1),(7870,'Palandanpatti',146,1),(7871,'Perambur',146,1),(7872,'Poongudi',146,1),(7873,'Pragathanbalpuram',146,1),(7874,'Puliur',146,1),(7875,'Rakathanpatti',146,1),(7876,'Sathinipatti',146,1),(7877,'Sathiyamangalam',146,1),(7878,'Seemanur',146,1),(7879,'Seerangampatti',146,1),(7880,'Senaiyakudi',146,1),(7881,'Sengalur',146,1),(7882,'Singathakuruchi',146,1),(7883,'Sivagamipuram',146,1),(7884,'Themmavur',146,1),(7885,'Thennankudi',146,1),(7886,'Thennathirayanpatti',146,1),(7887,'Thudaiyur',146,1),(7888,'Uchani',146,1),(7889,'Udaiyalipatti',146,1),(7890,'Ulagankathanpatti',146,1),(7891,'Upiliyakudi',146,1),(7892,'Vadugapatti',146,1),(7893,'Vaithur',146,1),(7894,'Valamangalam',146,1),(7895,'Valiayampatti',146,1),(7896,'Vathanakottai',146,1),(7897,'Vathanakuruchi',146,1),(7898,'Veerakudi',146,1),(7899,'Vellanur',146,1),(7900,'Vellapillaiyarpatti',146,1),(7901,'Vengaivayal',146,1),(7902,'Visalur',146,1),(7903,'Alakanvayal',147,1),(7904,'Avudaiyarpattinam',147,1),(7905,'Biramanavayal',147,1),(7906,'Dhandalai',147,1),(7907,'Dharmarajanvayal',147,1),(7908,'Enathi',147,1),(7909,'Idaiyathimangalam',147,1),(7910,'Idaiyathur',147,1),(7911,'K.Palankulam',147,1),(7912,'Kadai Idaiyathur',147,1),(7913,'Kallakurichi',147,1),(7914,'Kambarkovil',147,1),(7915,'Kanadu',147,1),(7916,'Kandanivayal',147,1),(7917,'Karakathikkottai',147,1),(7918,'Karakkottai',147,1),(7919,'Karkamalam',147,1),(7920,'Kavaloor',147,1),(7921,'Keelamanjakudi',147,1),(7922,'Keelapappanur',147,1),(7923,'Kilaravayal',147,1),(7924,'Kodikkulam',147,1),(7925,'Kokkumoottai',147,1),(7926,'Kolenthiram',147,1),(7927,'Kolluthidal',147,1),(7928,'Koompallam',147,1),(7929,'Koothaloor',147,1),(7930,'Koothankudi',147,1),(7931,'Kopalapuram',147,1),(7932,'M.O.Regunathapuram',147,1),(7933,'Manalur',147,1),(7934,'Manamelkudi',147,1),(7935,'Manjakudi',147,1),(7936,'Manthankudi',147,1),(7937,'Mavilankanenthal',147,1),(7938,'Melapappanur',147,1),(7939,'Melasthanam',147,1),(7940,'Minnamoli',147,1),(7941,'Mumbalai',147,1),(7942,'Neervilankulam',147,1),(7943,'Neikkuppai',147,1),(7944,'Nelveli',147,1),(7945,'Nemmelivayal',147,1),(7946,'Nilaiyur',147,1),(7947,'Ollanur',147,1),(7948,'P.K.Pichanenthal',147,1),(7949,'Paanavayal',147,1),(7950,'Palaiyavettivayal',147,1),(7951,'Periyamadaipachal',147,1),(7952,'Perumaruthur',147,1),(7953,'Pettivayal',147,1),(7954,'Pillaiyarthidal',147,1),(7955,'Pillankudi',147,1),(7956,'R.U.Regunathapuram',147,1),(7957,'Ravuthanvayal',147,1),(7958,'Rettaiyalam',147,1),(7959,'Sathiyadi',147,1),(7960,'Seiyanam',147,1),(7961,'Sellappankottai',147,1),(7962,'Silaathani',147,1),(7963,'Singavanam',147,1),(7964,'Solani',147,1),(7965,'Subramaniapuram',147,1),(7966,'Sudalaivayal',147,1),(7967,'Thalikkottai',147,1),(7968,'Thinaiyakkudi',147,1),(7969,'Thirunellivayal',147,1),(7970,'V.D.Kopalapuram',147,1),(7971,'Vellur',147,1),(7972,'Vellur Siruvarai',147,1),(7973,'Vettivayal',147,1),(7974,'Vichur',147,1),(7975,'Alavayal',148,1),(7976,'Ammankuruchi',148,1),(7977,'Arasamalai',148,1),(7978,'Avaampatty',148,1),(7979,'Idaiyathur',148,1),(7980,'Kalanivaipatti',148,1),(7981,'Kallampatti',148,1),(7982,'Kandiayanatham',148,1),(7983,'Karaiyur',148,1),(7984,'Karanapatti',148,1),(7985,'Keelakurichippatty',148,1),(7986,'Keelathaniyam',148,1),(7987,'Konnaiyur',148,1),(7988,'Koodalur',148,1),(7989,'Kovanur',148,1),(7990,'Maravamadurai',148,1),(7991,'Mathiyani',148,1),(7992,'Mekkinippatti',148,1),(7993,'Melathaniayam',148,1),(7994,'Melmelnilai',148,1),(7995,'Moolangudi',148,1),(7996,'Mullipattai',148,1),(7997,'Nagarapatti',148,1),(7998,'Nalloor',148,1),(7999,'Nathupatti',148,1),(8000,'Neively',148,1),(8001,'Nerinjikudi',148,1),(8002,'Oliyamangalam',148,1),(8003,'Ponnamaravathi East',148,1),(8004,'Ponnamaravathi West',148,1),(8005,'R. Palakurchi',148,1),(8006,'Sathanur',148,1),(8007,'Semmalapatti',148,1),(8008,'Sempoothi',148,1),(8009,'Seranoor',148,1),(8010,'Sevalur',148,1),(8011,'Sithur',148,1),(8012,'Sundaram',148,1),(8013,'Surappatty',148,1),(8014,'Thenoor',148,1),(8015,'Thirukalampur',148,1),(8016,'Thuthoor',148,1),(8017,'Usilampatty',148,1),(8018,'Vaarppattu',148,1),(8019,'Vadakupatti',148,1),(8020,'Valakuruchi',148,1),(8021,'Vellakudi I Bit',148,1),(8022,'Vellakudy Ii Bit',148,1),(8023,'Vellayakavundanpatty',148,1),(8024,'Aathanakotta',149,1),(8025,'Ayyavayal',149,1),(8026,'Chokkanathappatti',149,1),(8027,'Eagavayal',149,1),(8028,'Ganapathipuram',149,1),(8029,'Ichadi I Bit',149,1),(8030,'Ichadi Ii Bit',149,1),(8031,'Kallukaranpatti',149,1),(8032,'Kavinadu East',149,1),(8033,'Kavinadu West',149,1),(8034,'Kedayappatti',149,1),(8035,'Kulavaaipatti',149,1),(8036,'Kuppaiyanpatti',149,1),(8037,'Kuruchippatti',149,1),(8038,'Manaviduthi',149,1),(8039,'Mangalathupatti',149,1),(8040,'Mookkampatti',149,1),(8041,'Mullur',149,1),(8042,'Nathampannai',149,1),(8043,'Nemmelippatti',149,1),(8044,'Perungalur',149,1),(8045,'Perunkondanviduthi',149,1),(8046,'Pudukkottai - North',149,1),(8047,'Pudukkottai - South',149,1),(8048,'Pulavankadu',149,1),(8049,'Purakarainathampannai',149,1),(8050,'Puthampur',149,1),(8051,'Sammattividuthi',149,1),(8052,'Sanivayal',149,1),(8053,'Sellukudi',149,1),(8054,'Sempattoor',149,1),(8055,'Siruvayal',149,1),(8056,'Thattampatti',149,1),(8057,'Thennathirayanpatti',149,1),(8058,'Thirumalairayasamuthiram',149,1),(8059,'Thondamonoorani',149,1),(8060,'Vadavalam',149,1),(8061,'Vagavasal',149,1),(8062,'Vannarappatti',149,1),(8063,'Varappur',149,1),(8064,'Adugapatti',150,1),(8065,'Agavayal (109)',150,1),(8066,'Akavayal (121)',150,1),(8067,'Alavayal',150,1),(8068,'Allanvayal',150,1),(8069,'Anikini',150,1),(8070,'Aranmanaipatti',150,1),(8071,'Arasanthampatti',150,1),(8072,'Arimalam',150,1),(8073,'Athanur',150,1),(8074,'Athur',150,1),(8075,'Chiraayampatty',150,1),(8076,'Chittanpatti',150,1),(8077,'Chokkanathappatti',150,1),(8078,'Edaiyan Vayal',150,1),(8079,'Enapatti',150,1),(8080,'Ilanjavur',150,1),(8081,'K. Rayapuram',150,1),(8082,'Kadambavayal',150,1),(8083,'Kaikulanvayal',150,1),(8084,'Kannakarakkudi',150,1),(8085,'Kannanur I Bit',150,1),(8086,'Kannanur Ii Bit',150,1),(8087,'Karamangalam',150,1),(8088,'Kelapanaiyur',150,1),(8089,'Konappattu',150,1),(8090,'Koottur',150,1),(8091,'Kottaiyur',150,1),(8092,'Kulamangalam',150,1),(8093,'Kulathupatti',150,1),(8094,'Kulipirai',150,1),(8095,'Kummankudy (059)',150,1),(8096,'Kummankudy (112)',150,1),(8097,'Kunnathupatti',150,1),(8098,'Kurichi',150,1),(8099,'Lempalakudi',150,1),(8100,'Mallankudi',150,1),(8101,'Manchinipatti',150,1),(8102,'Melanilaivayal',150,1),(8103,'Melappanaiyur',150,1),(8104,'Melivayal',150,1),(8105,'Melur',150,1),(8106,'Meyapuram',150,1),(8107,'Mirattunilai',150,1),(8108,'Nallambalsamuthiram',150,1),(8109,'Nedunkudi',150,1),(8110,'Neikkonam',150,1),(8111,'Neivasal',150,1),(8112,'Oonaiur',150,1),(8113,'Pallivasal',150,1),(8114,'Panangudi',150,1),(8115,'Peraiyur',150,1),(8116,'Perundurai',150,1),(8117,'Perunkudi',150,1),(8118,'Pilakudipatti',150,1),(8119,'Pilivalam',150,1),(8120,'Piliyavayal',150,1),(8121,'Pillamangalam',150,1),(8122,'Poovampatti',150,1),(8123,'Pudunilaivayal',150,1),(8124,'Rangiayam',150,1),(8125,'Rarapuram',150,1),(8126,'Rayaregunathasamuthiram',150,1),(8127,'Rayavaram',150,1),(8128,'Samanthanvayal',150,1),(8129,'Samuthiram',150,1),(8130,'Seerathakudi',150,1),(8131,'Sengeerai',150,1),(8132,'Thalaiyathivayal',150,1),(8133,'Thekkattur',150,1),(8134,'Thirumayam',150,1),(8135,'Thulaiyanur',150,1),(8136,'Thuraiur',150,1),(8137,'Thurvasapuram',150,1),(8138,'Valaramanickam',150,1),(8139,'Valayam Patty',150,1),(8140,'Vanniyulanthanvayal',150,1),(8141,'Velavayal',150,1),(8142,'Vengalur',150,1),(8143,'Virachilai I Bit',150,1),(8144,'Virachilai Ii Bit',150,1),(8145,'Agarapatti',151,1),(8146,'Akkalnayaganpatti',151,1),(8147,'Alangudi',151,1),(8148,'Amboorpatti',151,1),(8149,'Gomangalam',151,1),(8150,'Kalgudi',151,1),(8151,'Kasavanur',151,1),(8152,'Kathalur',151,1),(8153,'Kodumpalur',151,1),(8154,'Kumarapatti',151,1),(8155,'Kunnathur',151,1),(8156,'Mathayanaipatti',151,1),(8157,'Meenaveli',151,1),(8158,'Melapachakudi',151,1),(8159,'Mepoothakudi',151,1),(8160,'Mullaiyur',151,1),(8161,'Nammanpatti',151,1),(8162,'Neerpalani',151,1),(8163,'Peraambur',151,1),(8164,'Poothagudi',151,1),(8165,'Poruvoi',151,1),(8166,'Poyyamani',151,1),(8167,'Rajagiri',151,1),(8168,'Rajalipatti',151,1),(8169,'Sengalakudi',151,1),(8170,'Sooriur',151,1),(8171,'Thengathinnipatti',151,1),(8172,'Thennampadi',151,1),(8173,'Theravur',151,1),(8174,'Vadugapatti',151,1),(8175,'Vanathirayanpatti',151,1),(8176,'Veloor',151,1),(8177,'Vemmani',151,1),(8178,'Viralimalai',151,1),(8179,'Viralur',151,1),(8180,'Viruthapatti',151,1),(8181,'Vittamapatti',151,1),(8182,'Alavankulam / அளவன்குளம்',152,1),(8183,'Annavi Nedungulam / அன்னாவி நெடுங்குளம்',152,1),(8184,'Appanur / ஆப்பனூர்',152,1),(8185,'Appanur Punavasal / ஆப்பனூர் புனவாசல்',152,1),(8186,'Archanaipagam Usilangulam / அர்ச்சனைப்பாகம் உசிலங்குளம்',152,1),(8187,'Avathandai / அவத்தாண்டை',152,1),(8188,'Iruveli / இருவேலி',152,1),(8189,'Kadaladi / கடலாடி',152,1),(8190,'Kadaladi Veppankulam / கடலாடி வேப்பங்குளம்',152,1),(8191,'Kadugusandai / கடுகுசந்தை',152,1),(8192,'Kannirajapuram / கன்னிராஜபுரம்',152,1),(8193,'Keelakidaram / கீழ்க்கிடாரம்',152,1),(8194,'Keelaselvanur / கீழ்செல்வனூர்',152,1),(8195,'Kokkarasankottai / கொக்கரசன்கோட்டை',152,1),(8196,'Kondunallanpatti / கொண்டுநல்லான்பட்டி',152,1),(8197,'Kurichikulam / குறிச்சிகுளம்',152,1),(8198,'Kuthiraimozhi / குதிரைமொழி',152,1),(8199,'Marandai / மாரந்தை',152,1),(8200,'Maravar Karisalkulam / மறவர் கரிசல்குளம்',152,1),(8201,'Meenangudi / மீனங்குடி',152,1),(8202,'Melakidaram / மேலக்கிடாரம்',152,1),(8203,'Melaselvanur / மேல்செல்வனூர்',152,1),(8204,'Mookkaiyur / மூக்கையூர்',152,1),(8205,'Narippaiyur / நரிப்பையூர்',152,1),(8206,'Orivayal / ஓரிவயல்',152,1),(8207,'Oruvanendal / ஒருவானேந்தல்',152,1),(8208,'Panivasal / பனிவாசல்',152,1),(8209,'Pannantha Keerandai / பன்னந்த கீரந்தை',152,1),(8210,'Peikkulam / பேய்க்குளம்',152,1),(8211,'Periyakulam / பெரியகுளம்',152,1),(8212,'Pramanankulam / பிராமணன்குளம்',152,1),(8213,'Sayalkudi / சாயல்குடி',152,1),(8214,'Sayalkudi Tharaikudi / சாயல்குடி தரைக்குடி',152,1),(8215,'Sayalkudi Vagaikulam / சாயல்குடி வாகைக்குளம்',152,1),(8216,'Sikkal / சிக்கல்',152,1),(8217,'Sippikulam / சிப்பிகுளம்',152,1),(8218,'Siraikulam / சிறைக்குளம்',152,1),(8219,'Terku Karisalkulam / தெற்கு கரிசல்குளம்',152,1),(8220,'Thanichiyam / தனிச்சியம்',152,1),(8221,'Therku Veppankulam / தெற்கு வேப்பங்குளம்',152,1),(8222,'Tirumallukandankottai / திருமாலுகந்தன்கோட்டை',152,1),(8223,'Tulukkai Mariyur / துலுக்கை மாரியூர்',152,1),(8224,'Valinokkam / வாலிநோக்கம்',152,1),(8225,'Abiramam / அபிராமம்',153,1),(8226,'Abiramam Tharaikudi / அபிராம்ம் தரைக்குடி',153,1),(8227,'Achankulam / அச்சங்குளம்',153,1),(8228,'Anaiyur / ஆனையூர்',153,1),(8229,'Ariyamangalam / அரியமங்கலம்',153,1),(8230,'D.valasubbiramaniyapuram / து.வாலசுப்பிரமணியபுரம்',153,1),(8231,'Eluvanur / எழுவனூர்',153,1),(8232,'Idivilagi / இடிவிலகி',153,1),(8233,'Kadamangalam / காடமங்கலம்',153,1),(8234,'Kakkudi / காக்குடி',153,1),(8235,'Kallikulam / கள்ளிக்குளம்',153,1),(8236,'Kamuthi / கமுதி',153,1),(8237,'Kamuthi Nedungulam / கமுதி நெடுங்குளம்',153,1),(8238,'Kamuthi Veppankulam / கமுதி வேப்பங்குளம்',153,1),(8239,'Keela Ramanati / கீழ ராமநதி',153,1),(8240,'Komboothi / கொம்பூதி',153,1),(8241,'Koodakkulam / கூடக்குளம்',153,1),(8242,'Kovilankulam / கோவிலாங்குளம்',153,1),(8243,'Mandalamanikkam / மண்டலமாணிக்கம்',153,1),(8244,'Marakkulam / மரக்குளம்',153,1),(8245,'Mavilangai / மாவிலங்கை',153,1),(8246,'Mela Ramanati / மேல ராமநதி',153,1),(8247,'Mudhaliyar Pudukulam / முதலியார் புதுக்குளம்',153,1),(8248,'Mudimannarkottai / முடிமன்னார்கோட்டை',153,1),(8249,'Mustakurichi / முஷ்டக்குறிச்சி',153,1),(8250,'Muthalnadu / முதல்நாடு',153,1),(8251,'Nagaratharkurichi / நகரத்தார்குறிச்சி',153,1),(8252,'Nattam / நத்தம்',153,1),(8253,'Neeravi / நீராவி',153,1),(8254,'Neeravikarisalkulam / நீராவிகரிசல்குளம்',153,1),(8255,'Oosampottal Karisalkulam / ஊசம்பொட்டல் கரிசல்குளம்',153,1),(8256,'P.muthuramalingapuram / பா.முத்துராமலிங்கபுரம்',153,1),(8257,'Pakkuvetti / பாக்குவெட்டி',153,1),(8258,'Pammanendal / பம்மனேந்தல்',153,1),(8259,'Peraiyur / பேரையூர்',153,1),(8260,'Periyanaikulam / பெரியானைக்குளம்',153,1),(8261,'Perunazhi / பெருநாழி',153,1),(8262,'Ponthampuli / பொந்தம்புளி',153,1),(8263,'Puthukottai / புதுக்கோட்டை',153,1),(8264,'Sadayanendal / சடையனேந்தல்',153,1),(8265,'Sambakulam / சம்பக்குளம்',153,1),(8266,'Seemanendal / சீமானேந்தல்',153,1),(8267,'Sengapadai / செங்கப்படை',153,1),(8268,'Tharaikkudi Punavasal / தரைக்குடி புனவாசல்',153,1),(8269,'Thavasikurichi / தவசிக்குறிச்சி',153,1),(8270,'Timmanathapuram / திம்மநாதபுரம்',153,1),(8271,'Vallandai / வல்லந்தை',153,1),(8272,'Vangarupuram / வங்காருபுரம்',153,1),(8273,'Villanendal / வில்லானேந்தல்',153,1),(8274,'Alangulam / ஆலங்குளம்',154,1),(8275,'Ekkakudi / எக்ககுடி',154,1),(8276,'Erwadi / ஏர்வாடி',154,1),(8277,'Ithampadal / இதம்பாடல்',154,1),(8278,'Kalari / களரி',154,1),(8279,'Kalimankundu / களிமண்குண்டு',154,1),(8280,'Kanjirangudi / காஞ்சிரங்குடி',154,1),(8281,'Keelakkarai / கீழக்கரை',154,1),(8282,'Kulapatham / குளபதம்',154,1),(8283,'Kuthakkottai / குதக்கோட்டை',154,1),(8284,'Malangudi / மாலங்குடி',154,1),(8285,'Mallal / மல்லல்',154,1),(8286,'Manickaneri / மாணிக்கனேரி',154,1),(8287,'Mayakulam / மாயகுளம்',154,1),(8288,'Nallirukkai / நல்லிருக்கை',154,1),(8289,'Pallamorkulam / பள்ளமோர்குளம்',154,1),(8290,'Panaikkulam / பனைக்குளம்',154,1),(8291,'Panaiyadiyendal / பனையடியேந்தல்',154,1),(8292,'Periyapattinam / பெரியபட்டினம்',154,1),(8293,'Pullanthai / புல்லந்தை',154,1),(8294,'Regunathapuram / இரகுநாதபுரம்',154,1),(8295,'Thiru Uthirakosamangai / திரு உத்தரகோசமங்கை',154,1),(8296,'Thiruppulani / திருப்புல்லாணி',154,1),(8297,'Vannankundu / வண்ணான்குண்டு',154,1),(8298,'Velanur / வேளானூர்',154,1),(8299,'Vellamarichchukkatti / வெள்ளாமரிச்சுக்கட்டி',154,1),(8300,'Anaiseri / ஆனைசேரி',155,1),(8301,'ATHANKOTHANKUDI / ஆதங்கொத்தங்குடி',155,1),(8302,'Enathi / ஏனாதி',155,1),(8303,'Ilanchemboor / இளஞ்செம்பூர்',155,1),(8304,'Ilankakkoor / இளங்காக்கூர்',155,1),(8305,'Kakkoor / காக்கூர்',155,1),(8306,'Kandilan / கண்டிலான்',155,1),(8307,'Karumal / கருமல்',155,1),(8308,'Keelakodumalur / கீழக்கொடுமலூர்',155,1),(8309,'Keelakulam / கீழ்க்குளம்',155,1),(8310,'Keelasirupothu / கீழசிறுபோது',155,1),(8311,'Keelathooval / கீழத்தூவல்',155,1),(8312,'Keeranoor / கீரனூர்',155,1),(8313,'Kila Mudukulathur / கீழமுதுகுளத்தூர்',155,1),(8314,'Kolunthaurai / கொழுந்துரை',155,1),(8315,'Koothadiyendal / கூத்தாடியேந்தல்',155,1),(8316,'Kumarakurichi / குமாரக்குறிச்சி',155,1),(8317,'Manaloor / மணலூர்',155,1),(8318,'Melakodumalur / மேலக்கொடுமலூர்',155,1),(8319,'Melamudukulathur / மேலமுதுகுளத்தூர்',155,1),(8320,'Melasirupothu / மேலசிறுபோது',155,1),(8321,'Melathooval / மேலத்தூவல்',155,1),(8322,'Melkkulam / மேல்க்குளம்',155,1),(8323,'Merku Kottakudi / மேற்கு கொட்டகுடி',155,1),(8324,'Nalloor / நல்லூர்',155,1),(8325,'Pirabakkaloor / பிரபக்களூர்',155,1),(8326,'POOSERI / பூசேரி',155,1),(8327,'Posukudi / பொசுக்குடி',155,1),(8328,'Puliyankudi / புளியங்குடி',155,1),(8329,'Pulvoikulam / புல்வாய்க்குளம்',155,1),(8330,'Sadayanendal / சடையனேந்தல்',155,1),(8331,'Sathanur / சாத்தனூர்',155,1),(8332,'Sellur / செல்லூர்',155,1),(8333,'Senthaneri / சேந்தனேரி',155,1),(8334,'Sithirankudi / சித்திரங்குடி',155,1),(8335,'Sonaipiriyankottai / சோனைபிரியான்கோட்டை',155,1),(8336,'Suvathan / சுவாத்தான்',155,1),(8337,'THALIYARENDAL / தாளியாரேந்தல்',155,1),(8338,'Thattanendal / தட்டானேந்தல்',155,1),(8339,'THERIRUVELI / தேரிருவேலி',155,1),(8340,'Thiruvarangam / திருவரங்கம்',155,1),(8341,'Ulaiyoor / உலையூர்',155,1),(8342,'Valanadu / வளநாடு',155,1),(8343,'Vengalakkurichi / வெங்கலக்குறிச்சி',155,1),(8344,'Vikkramapandiyapuram / விக்கிரமபாண்டியபுரம்',155,1),(8345,'Vilangalathur / விளங்களத்தூர்',155,1),(8346,'PERUNGARAI / பெருங்கரை',155,1),(8347,'PIDARISERI / பிடாரிசேரி',155,1),(8348,'POTHUVAKUDI / பொதுவக்குடி',155,1),(8349,'Pottagavayal / பொட்டகவயல்',155,1),(8350,'Rathapuli / இராதாப்புளி',155,1),(8351,'Sathurveda Mangalam / சதுர்வேத மங்களம்',155,1),(8352,'Semanoor Kodikulam / சேமனூர் கொடிக்குளம்',155,1),(8353,'Semanur / சேமனூர்',155,1),(8354,'Sethukal / சேதுகால்',155,1),(8355,'Sevvur / செவ்வூர்',155,1),(8356,'Seyyalur / செய்யாலூர்',155,1),(8357,'Siragikottai / சிரகிக்கோட்டை',155,1),(8358,'Siruvayal / சிறுவயல்',155,1),(8359,'Sithanendal / சித்தனேந்தல்',155,1),(8360,'SOODIYUR / சூடியூர்',155,1),(8361,'SOUTH ANDAKUDI / தெற்கு அண்டக்குடி',155,1),(8362,'South Kavanoor / தெற்கு காவனூர்',155,1),(8363,'THADUTHALANKOTTAI / தடுத்தலாங்கோட்டை',155,1),(8364,'Thalaiyadikottai / தாளையடிக்கோட்டை',155,1),(8365,'Thavalaikulam / தவளைக்குளம்',155,1),(8366,'Theeyanur / தீயனூர்',155,1),(8367,'Thenpothuvakudi / தென்பொதுவக்குடி',155,1),(8368,'Thethangal / தேத்தாங்கால்',155,1),(8369,'Thiyagavanseri / தியாகவன்சேரி',155,1),(8370,'Tholur / தோளூர்',155,1),(8371,'URAPPULI / உரப்புளி',155,1),(8372,'Urathur / உரத்தூர்',155,1),(8373,'Vagavayal / வாகவயல்',155,1),(8374,'VALANGUDI / வாலாங்குடி',155,1),(8375,'VALIMARICHCHAN / வழிமறிச்சான்',155,1),(8376,'Vallakulam / வல்லக்குளம்',155,1),(8377,'Vallam / வல்லம்',155,1),(8378,'Vaniyavallam / வாணியவல்லம்',155,1),(8379,'VATHAVANERI / வாதவனேரி',155,1),(8380,'Veeravanur / வீரவனூர்',155,1),(8381,'VENGALUR / வெங்காளூர்',155,1),(8382,'VENKITTANKURICHCHI / வெங்கிட்டங்குறிச்சி',155,1),(8383,'VENTHONI / வேந்தோணி',155,1),(8384,'VEPPANKULAM / வேப்பங்குளம்',155,1),(8385,'VILATHUR / விளத்தூர்',155,1),(8386,'Akkiramesi / அக்கிரமேசி',156,1),(8387,'Anchamadai Kachan / அஞ்சாமடை காச்சான்',156,1),(8388,'Arasanur / அரசனூர்',156,1),(8389,'Ariyakudi / அரியக்குடி',156,1),(8390,'Ariyakudi Puttur / அரியக்குடி புத்தூர்',156,1),(8391,'ARIYANENDAL / அரியனேந்தல்',156,1),(8392,'Bogalur / போகலூர்',156,1),(8393,'Emaneswaram / எமனேஸ்வரம்',156,1),(8394,'Ettivayal / எட்டிவயல்',156,1),(8395,'Gangaikondan / கங்கைகொண்டான்',156,1),(8396,'Kakkanendal / காக்கனேந்தல்',156,1),(8397,'Kalaiyoor / கலையூர்',156,1),(8398,'Kalaiyoor Karungulam / கலையூர் கருங்குளம்',156,1),(8399,'KALLIKUDI / கள்ளிக்குடி',156,1),(8400,'Kamankottai / காமன்கோட்டை',156,1),(8401,'KAMUTHAKUDI / கமுதக்குடி',156,1),(8402,'Karadanthakudi / காரடர்ந்தகுடி',156,1),(8403,'KATTUPARAMAKUDI / காட்டுபரமக்குடி',156,1),(8404,'KEELAPARUTHIYUR / கீழப்பருத்தியூர்',156,1),(8405,'Keelkottai / கீழ்க்கோட்டை',156,1),(8406,'Kiliyur / கிளியூர்',156,1),(8407,'Koluvur / கொளுவூர்',156,1),(8408,'KOONANGULAM / கூனங்குளம்',156,1),(8409,'Koraikulam / கோரைக்குளம்',156,1),(8410,'KOTHANKULAM / கொத்தங்குளம்',156,1),(8411,'Kottakudi / கொட்டகுடி',156,1),(8412,'KULANDAPURI / குழந்தாபுரி',156,1),(8413,'Kulathur / குளத்தூர்',156,1),(8414,'Kumukottai / குமுக்கோட்டை',156,1),(8415,'MADANDAI / மடந்தை',156,1),(8416,'Manakkudi / மணக்குடி',156,1),(8417,'Manjakkollai / மஞ்சக்கொல்லை',156,1),(8418,'Manjoor / மஞ்சூர்',156,1),(8419,'MELAPARTHIBANUR / மேலப்பார்த்திபனூர்',156,1),(8420,'MELAYKUDI / மேலாய்குடி',156,1),(8421,'Mennandhi / மென்னந்தி',156,1),(8422,'MOSUKUDI / மோசுகுடி',156,1),(8423,'Mummudisathan / மும்முடிச்சாத்தான்',156,1),(8424,'MUTHALUR / முதலூர்',156,1),(8425,'N.pethanendal / நா.பெத்தனேந்தல்',156,1),(8426,'Nagachi / நாகாச்சி',156,1),(8427,'Nagaram / நகரம்',156,1),(8428,'Nagaramangalam / நகரமங்கலம்',156,1),(8429,'Pambur / பாம்பூர்',156,1),(8430,'Panaiyur / பனையூர்',156,1),(8431,'Pandappanendal / பந்தப்பனேந்தல்',156,1),(8432,'Pandikanmoi / பாண்டிக்கண்மாய்',156,1),(8433,'Pandiyur / பாண்டியூர்',156,1),(8434,'Paraiyankulam Kodikkulam / பறையன்குளம் கொடிக்குளம்',156,1),(8435,'Periyanendal / பெரியனேந்தல்',156,1),(8436,'Perungalur / பெருங்களூர்',156,1),(8437,'Alagathevankottai / அழகத்தேவன்கோட்டை',157,1),(8438,'Anaiyarkottai / ஆனையார் கோட்டை',157,1),(8439,'Anandur / ஆனந்தூர்',157,1),(8440,'Ariyankottai / அரியாங்கோட்டை',157,1),(8441,'Arunuthimangalam / அருநுதிமங்கலம்',157,1),(8442,'Attankudi / ஆட்டாங்குடி',157,1),(8443,'Bagavathi Mangalam / பகவதி மங்கலம்',157,1),(8444,'Chitturvadi / சித்தூர்வாடி',157,1),(8445,'Govindamangalam / கோவிந்தமங்கலம்',157,1),(8446,'Gudalur / கூடலூர்',157,1),(8447,'Kalangappuli / களங்காப்புலி',157,1),(8448,'Kallikudi / கள்ளிக்குடி',157,1),(8449,'Karungudi / கருங்குடி',157,1),(8450,'Karungudi / கருங்குடி',157,1),(8451,'Kavvur / கவ்வூர்',157,1),(8452,'Kokkurani / கொக்கூரணி',157,1),(8453,'Kulamanikkam / குலமாணிக்கம்',157,1),(8454,'Odaikkal / ஓடைக்கால்',157,1),(8455,'Odakkarai / ஓடக்கரை',157,1),(8456,'Paranur / பாரனூர்',157,1),(8457,'Pettartevan Kottai / பெத்தார்தேவன்கோட்டை',157,1),(8458,'Pullamadai / புல்லமடை',157,1),(8459,'Rajasingamangalam / இராஜசிங்கமங்கலம்',157,1),(8460,'Ramanathamadai / ராமநாதமடை',157,1),(8461,'Rathanur / ராதானூர்',157,1),(8462,'Rettaiyuranivilladi Vagai / இரட்டையூரணி வில்லடிவாகை',157,1),(8463,'Sattanur / சாத்தனூர்',157,1),(8464,'Sengudi / செங்குடி',157,1),(8465,'Settidal / சேத்திடல்',157,1),(8466,'Sinangudi / சீனாங்குடி',157,1),(8467,'Solandur / சோழந்தூர்',157,1),(8468,'Thumbadaikkakootai / தும்படைக்காகோட்டை',157,1),(8469,'Tiruppalaikudi / திருப்பாலைக்குடி',157,1),(8470,'Tiruttervalai / திருத்தேர்வளை',157,1),(8471,'Tuthiyendal / துத்தியேந்தல்',157,1),(8472,'Uppur / உப்பூர்',157,1),(8473,'Uranangudi / ஊரணங்குடி',157,1),(8474,'valamavur / வளமாவூர்',157,1),(8475,'Varavani / வரவணி',157,1),(8476,'Achchadipirambu / அச்சடிப்பிரம்பு',158,1),(8477,'Achunthanvayal / அச்சுந்தன்வயல்',158,1),(8478,'Alagankulam / அழகன்குளம்',158,1),(8479,'Alamanendal / அலமனேந்தல்',158,1),(8480,'Andichanenthal / ஆண்டிச்சனேந்தல்',158,1),(8481,'Athangarai / ஆற்றாங்கரை',158,1),(8482,'Athiyuthu / அத்தியூத்து',158,1),(8483,'Chitharkottai / சித்தார்கோட்டை',158,1),(8484,'Devipattanam / தேவிபட்டினம்/',158,1),(8485,'Enmanamkondan / என்மனங்கொண்டான்',158,1),(8486,'Kalukoorani / கழுகூரணி',158,1),(8487,'Karan / காரான்',158,1),(8488,'Karendal / காரேந்தல்',158,1),(8489,'Kavanoor / காவனூர்',158,1),(8490,'Kumariyendal / குமரியேந்தல்',158,1),(8491,'Kumbaram / கும்பரம்',158,1),(8492,'Kuriyur / கூரியூர்',158,1),(8493,'Kuyavankudi / குயவன்குடி',158,1),(8494,'Ladanendal / லாடனேந்தல்',158,1),(8495,'Landai / லாந்தை',158,1),(8496,'Mandapam / மண்டபம்',158,1),(8497,'Nagachi / நாகாச்சி',158,1),(8498,'Naranamangalam / நாரணமங்கலம்',158,1),(8499,'Nochiyoorani / நொச்சியூரணி',158,1),(8500,'Palankulam / பழங்குளம்',158,1),(8501,'Pandamangalam / பாண்டமங்கலம்',158,1),(8502,'Pathanenthal / பத்தனேந்தல்',158,1),(8503,'Pattinamkathan / பட்டினம் காத்தான்',158,1),(8504,'Perungulam / பெருங்குளம்',158,1),(8505,'Peruvayal / பெருவயல்',158,1),(8506,'Pirappanvalasai / பிரப்பன் வலசை',158,1),(8507,'Pullangudi / புல்லங்குடி',158,1),(8508,'Puthumadam / புதுமடம்',158,1),(8509,'Rajasuriamadai / இராஜசூரியமடை',158,1),(8510,'Rettaiyurani / இரட்டையூரணி',158,1),(8511,'Sakkarakkottai / சக்கரக்கோட்டை',158,1),(8512,'Sathakon Valasai / சாத்தக்கோன்வலசை',158,1),(8513,'Soorankottai / சூரன்கோட்டை',158,1),(8514,'Terbhogi / தேர்போகி',158,1),(8515,'Toruvallur / தொருவளுர்',158,1),(8516,'Valantaravai / வாலாந்தரவை',158,1),(8517,'Vannivayal / வன்னிவயல்',158,1),(8518,'Vennathur / வெண்ணத்தூர்',158,1),(8519,'Rameswaram',159,1),(8520,'Adhiyur / ஆதியூர்',160,1),(8521,'Akkalur / ஆக்கலூர்',160,1),(8522,'Alagardevanmanakkudi / அழகர்தேவன் மணக்குடி',160,1),(8523,'Aligudi / ஆழிகுடி',160,1),(8524,'Anjukottai / அஞ்சுகோட்டை',160,1),(8525,'Arasur / அரசூர்',160,1),(8526,'Attur / ஆட்டூர்',160,1),(8527,'Baganur / பாகனூர்',160,1),(8528,'Chinnathondi / சின்னதொண்டி',160,1),(8529,'Chithamangalam / சித்தாமங்கலம்',160,1),(8530,'Ilaiyathanvayal / இளையாத்தான்வயல்',160,1),(8531,'Kadambakudi / கடம்பாகுடி',160,1),(8532,'Kadambanendal / கடம்பனேந்தல்',160,1),(8533,'Kadambur / கடம்பூர்',160,1),(8534,'Kadangudi / காடாங்குடி',160,1),(8535,'Kaliyanagari / கலியநகரி',160,1),(8536,'Kanattangudi / கானாட்டாங்குடி',160,1),(8537,'Karungalakkudi / கருங்காலக்குடி',160,1),(8538,'Kattavilagam / கட்டவிளாகம்',160,1),(8539,'Kattimangalam / கட்டிமங்கலம்',160,1),(8540,'Keelapanaiyur / கீழப்பனையூர்',160,1),(8541,'Keelarumbur / கீழரும்பூர்',160,1),(8542,'Kiliyur / கிளியூர்',160,1),(8543,'Kodipangu / கொடிப்பங்கு',160,1),(8544,'Kookudi / கூகுடி',160,1),(8545,'Kulathur / குளத்தூர்',160,1),(8546,'Machur / மச்சூர்',160,1),(8547,'Mallanur / மல்லனூர்',160,1),(8548,'Mangalakkudi / மங்களக்குடி',160,1),(8549,'Marungur / மருங்கூர்',160,1),(8550,'Mavur / மாவூர்',160,1),(8551,'Mugilthagam / முகிழ்தகம்',160,1),(8552,'Muthuramalingapattinam / முத்துராமலிங்கப்பட்டிணம்',160,1),(8553,'Nagarikathan / நகரிகாத்தான்',160,1),(8554,'Nambuthalai / நம்புதாளை',160,1),(8555,'Neerkundram / நீர்க்குன்றம்',160,1),(8556,'Neivayal / நெய்வயல்',160,1),(8557,'Nilamazhagiya Mangalam / நிலமழகியமங்கலம்',160,1),(8558,'Odavayal / ஓடவயல்',160,1),(8559,'Orikkottai / ஓரிக்கோட்டை',160,1),(8560,'Oriyur / ஓரியூர்',160,1),(8561,'Palankulam / பழங்குளம்',160,1),(8562,'Pandugudi / பாண்டுகுடி',160,1),(8563,'Panichakudi / பனிச்சகுடி',160,1),(8564,'Parur / பாரூர்/',160,1),(8565,'Pattamangalam / பட்டமங்கலம்',160,1),(8566,'Pullur / புல்லூர்',160,1),(8567,'Puthupattinam / புதுப்பட்டிணம்',160,1),(8568,'Sekkanthidal / செக்காந்திடல்',160,1),(8569,'Sirukambaiyur / சிறுகம்பையூர்',160,1),(8570,'Sirumalaikkottai / சிறுமலைக்கோட்டை',160,1),(8571,'Thalirmarungur / தளிர்மருங்கூர்',160,1),(8572,'Thelur / தேளூர்',160,1),(8573,'Thiruvadanai Nagini / திருவாடானை நாகினி',160,1),(8574,'Thiruvetriyur / திருவெற்றியூர்',160,1),(8575,'Thondi / தொண்டி',160,1),(8576,'Thottamangalam / தோட்டாமங்கலம்',160,1),(8577,'Thuthakudi / துத்தாகுடி',160,1),(8578,'Tiruvadanai / திருவாடானை',160,1),(8579,'Vattanam / வட்டாணம்',160,1),(8580,'Velangudi / வேலங்குடி',160,1),(8581,'Aarikilapadi',161,1),(8582,'Ambarisipuram',161,1),(8583,'Ammanur',161,1),(8584,'Anaikkattapudur',161,1),(8585,'Anaipakkam',161,1),(8586,'Anandapuram',161,1),(8587,'Anvarthikhanpettai',161,1),(8588,'Arakkonam',161,1),(8589,'Arumpakkam',161,1),(8590,'Asamandur',161,1),(8591,'Athur',161,1),(8592,'Attuppakkam',161,1),(8593,'Cheyyur',161,1),(8594,'Chithur',161,1),(8595,'Echiputhur',161,1),(8596,'Ganapathipuram',161,1),(8597,'Ilupaithandalam',161,1),(8598,'Kainur',161,1),(8599,'Kavanoor',161,1),(8600,'Keelanthur',161,1),(8601,'Keelkuppam',161,1),(8602,'Keelpakkam',161,1),(8603,'Kilavanam',161,1),(8604,'Konalam',161,1),(8605,'Krishnapuram',161,1),(8606,'Mankattucheri',161,1),(8607,'Melpakkam',161,1),(8608,'Minnal',161,1),(8609,'Moodur',161,1),(8610,'Mosur',161,1),(8611,'Mulvoy',161,1),(8612,'Murungai',161,1),(8613,'Nagarikuppam',161,1),(8614,'Nanthiveduthangal',161,1),(8615,'Pallur',161,1),(8616,'Parameswara Mglm.',161,1),(8617,'Paranji',161,1),(8618,'Parithiputhur',161,1),(8619,'Perumalrajapettai',161,1),(8620,'Perumuchi',161,1),(8621,'Perunkalathur',161,1),(8622,'Pinnavaram',161,1),(8623,'Poiyapakkam',161,1),(8624,'Pudukesavaram',161,1),(8625,'Puliamangalam',161,1),(8626,'Sembedu',161,1),(8627,'Sithambadi',161,1),(8628,'Sitheri',161,1),(8629,'Thakkolam',161,1),(8630,'Thandalam',161,1),(8631,'Thanigaipolur',161,1),(8632,'Vadamampakkam',161,1),(8633,'Valarpuram',161,1),(8634,'Vedal',161,1),(8635,'Vellur Pettai',161,1),(8636,'Vuliampakkam',161,1),(8637,'Vuriyur',161,1),(8638,'Anaimallur',162,1),(8639,'Arcot',162,1),(8640,'Arumpakkam',162,1),(8641,'Athithangal',162,1),(8642,'Chakkaramallur',162,1),(8643,'Dhurgam',162,1),(8644,'Esaiyanur',162,1),(8645,'Gurumudithangal',162,1),(8646,'Kadappanthangal',162,1),(8647,'Karikkanthangal',162,1),(8648,'Karivedu',162,1),(8649,'Kavanoor',162,1),(8650,'Keerampadi',162,1),(8651,'Kilambadi',162,1),(8652,'Kilanthangal',162,1),(8653,'Kukundi',162,1),(8654,'Kuncharappantgl.',162,1),(8655,'Kuppam',162,1),(8656,'Ladavaram',162,1),(8657,'Mangadu',162,1),(8658,'Maruthuvambadi',162,1),(8659,'Mecheri',162,1),(8660,'Mel Nckm.Plym.',162,1),(8661,'Melaththangal',162,1),(8662,'Mosur',162,1),(8663,'Mulluvadi',162,1),(8664,'Muppathuvetti',162,1),(8665,'Nambarai',162,1),(8666,'Ozhalai',162,1),(8667,'Padi',162,1),(8668,'Palayam',162,1),(8669,'Papperi',162,1),(8670,'Paradarami',162,1),(8671,'Pattanam',162,1),(8672,'Perungalmedu',162,1),(8673,'Poonkodu',162,1),(8674,'Pudupadi',162,1),(8675,'Punganur',162,1),(8676,'Punnappadi',162,1),(8677,'Sarvanthangal',162,1),(8678,'Sathur',162,1),(8679,'Sembedu',162,1),(8680,'Tajpura',162,1),(8681,'Thamaraipakkam',162,1),(8682,'Thimiri',162,1),(8683,'Valavanur',162,1),(8684,'Vanakkampadi',162,1),(8685,'Varagur',162,1),(8686,'Vellur',162,1),(8687,'Venkatapuram',162,1),(8688,'Vilappakkam',162,1),(8689,'Vilari',162,1),(8690,'Aaroor',163,1),(8691,'Agaram',163,1),(8692,'Allalacheri',163,1),(8693,'Athiyanam',163,1),(8694,'Ayiramangalam',163,1),(8695,'Cheiyathuvannam',163,1),(8696,'Chenkanavaram',163,1),(8697,'Chennaleri',163,1),(8698,'Chennasamudram',163,1),(8699,'Chittanthangal',163,1),(8700,'Irungur',163,1),(8701,'Kalavai',163,1),(8702,'Kalavaiputhur',163,1),(8703,'Kaniyanur',163,1),(8704,'Kelpadi',163,1),(8705,'Kodali',163,1),(8706,'Kundaleri',163,1),(8707,'Kuppudisatham',163,1),(8708,'Kuttiyam',163,1),(8709,'Malaiyur',163,1),(8710,'Mampakkam',163,1),(8711,'Marudam',163,1),(8712,'Marudamangalam',163,1),(8713,'Melapalanthai',163,1),(8714,'Melnelli',163,1),(8715,'Melnetham Pkm',163,1),(8716,'Melpudupakkam',163,1),(8717,'Melpulam',163,1),(8718,'Nagaleri',163,1),(8719,'Nallur',163,1),(8720,'Nangamangalam',163,1),(8721,'Palaiyanur',163,1),(8722,'Pali',163,1),(8723,'Pariamangalam',163,1),(8724,'Parikkalpattu',163,1),(8725,'Pennagar',163,1),(8726,'Perumanthangal',163,1),(8727,'Pindithangal',163,1),(8728,'Pinnanthangal',163,1),(8729,'Ponnambalam',163,1),(8730,'Sembakkam',163,1),(8731,'Siruvidagam',163,1),(8732,'Soraiyur',163,1),(8733,'Thattacheri',163,1),(8734,'Thenmanapakkam',163,1),(8735,'Thonimedu',163,1),(8736,'Valapandal',163,1),(8737,'Valayathur',163,1),(8738,'Vellambi',163,1),(8739,'Vembi',163,1),(8740,'Agavalam',164,1),(8741,'Alappakkam',164,1),(8742,'Asanellikuppam',164,1),(8743,'Athipattu',164,1),(8744,'Avalur',164,1),(8745,'Ayarpadi',164,1),(8746,'Cheri',164,1),(8747,'Dharmaneedhi',164,1),(8748,'Elathur',164,1),(8749,'Eralacherry',164,1),(8750,'Jagirthandalam',164,1),(8751,'Kalathur',164,1),(8752,'Kariakudal',164,1),(8753,'Karivedu',164,1),(8754,'Karnavur',164,1),(8755,'Kattalai',164,1),(8756,'Kattupakkam',164,1),(8757,'Kaveripakkam',164,1),(8758,'Keelandurai',164,1),(8759,'Keelkalathur',164,1),(8760,'Keelveedhi',164,1),(8761,'Keelvenkatapuram',164,1),(8762,'Keelvenpakkam',164,1),(8763,'Kodampakkam',164,1),(8764,'Kondapuram',164,1),(8765,'Mahanipattu',164,1),(8766,'Mahendravadi',164,1),(8767,'Mamandoor',164,1),(8768,'Melanthurai',164,1),(8769,'Melapulam',164,1),(8770,'Melari',164,1),(8771,'Melkalathur',164,1),(8772,'Melvenpakkam',164,1),(8773,'Nagavedu',164,1),(8774,'Nangamangalam',164,1),(8775,'Nedumpuli',164,1),(8776,'Nelvoy',164,1),(8777,'Nemili',164,1),(8778,'Ochalam',164,1),(8779,'Ocheri',164,1),(8780,'Panappakkam',164,1),(8781,'Panniyur',164,1),(8782,'Perapperi',164,1),(8783,'Perumpulipakkam',164,1),(8784,'Peruvalayam',164,1),(8785,'Poigainallur',164,1),(8786,'Puduppattu',164,1),(8787,'Punnai',164,1),(8788,'Reddivalam',164,1),(8789,'S.Kulathur',164,1),(8790,'Sangaranpadi',164,1),(8791,'Sayanavaram',164,1),(8792,'Silamandai',164,1),(8793,'Sirukarumpur',164,1),(8794,'Sirunamalli',164,1),(8795,'Siruvalayam',164,1),(8796,'Thenmambakkam',164,1),(8797,'Thirumalpoor',164,1),(8798,'Thuraiperumpakkam',164,1),(8799,'Thuraiyur',164,1),(8800,'Uliyanallur',164,1),(8801,'Uthirampattu',164,1),(8802,'Vegamangalam',164,1),(8803,'Velithangipuram',164,1),(8804,'Veliyanallur',164,1),(8805,'Vepperi',164,1),(8806,'Vettankulam',164,1),(8807,'Akkachikuppam',165,1),(8808,'Ariyur',165,1),(8809,'Ayal',165,1),(8810,'Banavaram',165,1),(8811,'Chekkidikuppam',165,1),(8812,'Chengalnatham',165,1),(8813,'Chithathur',165,1),(8814,'Govindacheri',165,1),(8815,'Govindacherikuppam',165,1),(8816,'Gudalur',165,1),(8817,'Ibedu',165,1),(8818,'Jumbukulam',165,1),(8819,'Kallalankuppam',165,1),(8820,'Kalpattu',165,1),(8821,'Karikkal',165,1),(8822,'Kattrampakkam',165,1),(8823,'Keelveeranam',165,1),(8824,'Kesavanankuppam',165,1),(8825,'Kodakkal',165,1),(8826,'Kolatheri',165,1),(8827,'Kondapalayam',165,1),(8828,'Koothampakkam',165,1),(8829,'Kunnathur',165,1),(8830,'Mangalam',165,1),(8831,'Marudhalam',165,1),(8832,'Melveeranam',165,1),(8833,'Melvenkatapuram',165,1),(8834,'Nandhimangalam',165,1),(8835,'Ozhughur',165,1),(8836,'Palayapalayam',165,1),(8837,'Pandiyanallur',165,1),(8838,'Paravathur',165,1),(8839,'Polipakkam',165,1),(8840,'Ponnappanthangal',165,1),(8841,'Pudur',165,1),(8842,'Pulivalam',165,1),(8843,'Rendady',165,1),(8844,'Sholinghur',165,1),(8845,'Somasamudram',165,1),(8846,'Soorai',165,1),(8847,'Thagarakuppam',165,1),(8848,'Thalangai',165,1),(8849,'Thalikkal',165,1),(8850,'Thappur',165,1),(8851,'Vadakadappanthangal',165,1),(8852,'Vangoor',165,1),(8853,'Velam',165,1),(8854,'Venguppattu',165,1),(8855,'Vylambadi',165,1),(8856,'Ammananthangal',166,1),(8857,'Ammoor',166,1),(8858,'Anandalai',166,1),(8859,'Arappakkam',166,1),(8860,'Arunkundram',166,1),(8861,'Ayilam',166,1),(8862,'Chennasamudram',166,1),(8863,'Chettithangal',166,1),(8864,'Egambaranallur',166,1),(8865,'Gudimallur',166,1),(8866,'Kadapperi',166,1),(8867,'Kalmelkuppam',166,1),(8868,'Karai',166,1),(8869,'Katharikuppam',166,1),(8870,'Kathiyavadi',166,1),(8871,'Katteri',166,1),(8872,'Keelminnal',166,1),(8873,'Kelkuppam',166,1),(8874,'Kondakuppam',166,1),(8875,'Koorampadi',166,1),(8876,'Lalapettai',166,1),(8877,'Maniampattu',166,1),(8878,'Manthaangal',166,1),(8879,'Maruthampakkam',166,1),(8880,'Melakuppam',166,1),(8881,'Mukundarayapuram',166,1),(8882,'Musiri',166,1),(8883,'Nandhiyalam',166,1),(8884,'Narasingapuram',166,1),(8885,'Navlockgarden',166,1),(8886,'Padiyambakkam',166,1),(8887,'Pagaveli',166,1),(8888,'Palleri',166,1),(8889,'Pinchi',166,1),(8890,'Poondi',166,1),(8891,'Rasathupuram',166,1),(8892,'Sathampakkam',166,1),(8893,'Sengadu',166,1),(8894,'Sikkarajapuram',166,1),(8895,'Sumaithangi',166,1),(8896,'Thalanur',166,1),(8897,'Thandalam',166,1),(8898,'Thengal',166,1),(8899,'Thenkadappanthangal',166,1),(8900,'Thimnachari Kpm.',166,1),(8901,'Thirumalaicheri',166,1),(8902,'Thirupparkadal',166,1),(8903,'Vadagal',166,1),(8904,'Valluambakkam',166,1),(8905,'Vanapadi',166,1),(8906,'Vannivedu',166,1),(8907,'Vasur',166,1),(8908,'Veppur',166,1),(8909,'Visharam',166,1),(8910,'Wallajah',166,1),(8911,'Akkichettipalayam',167,1),(8912,'Alagapuram',167,1),(8913,'Ammampalayam',167,1),(8914,'Appamasamudram',167,1),(8915,'Aragalur',167,1),(8916,'Arasanatham',167,1),(8917,'Aratti Agragaram',167,1),(8918,'Attavanai Kotambadi',167,1),(8919,'Attur',167,1),(8920,'Chokkanathapuram',167,1),(8921,'Deviyakurichi',167,1),(8922,'Govindampalayam',167,1),(8923,'Ichampatti',167,1),(8924,'Jari Kotambadi',167,1),(8925,'Kallanatham',167,1),(8926,'Kalpaganur',167,1),(8927,'Kamakkapalayam',167,1),(8928,'Kattukottai',167,1),(8929,'Kirippatti',167,1),(8930,'Lakshmanasamudram',167,1),(8931,'Malliyakarai',167,1),(8932,'Manivilundan',167,1),(8933,'Manjini',167,1),(8934,'Mullaivadi',167,1),(8935,'Mummudi',167,1),(8936,'Muttal',167,1),(8937,'Narasingapuram',167,1),(8938,'Nathakkarai',167,1),(8939,'Navakkurichi',167,1),(8940,'Navalur',167,1),(8941,'Paithur (North)',167,1),(8942,'Paittur South',167,1),(8943,'Pallipalayam',167,1),(8944,'Pattuthurai',167,1),(8945,'Periyeri',167,1),(8946,'Punalvasal',167,1),(8947,'Pungavadi',167,1),(8948,'Puttur',167,1),(8949,'Ramanayakanpalayam South',167,1),(8950,'Ramanayakkanpalayam North',167,1),(8951,'Sadasivapuram',167,1),(8952,'Sarvaoy',167,1),(8953,'Satapadi',167,1),(8954,'Siliyampatti',167,1),(8955,'Siruvachur South',167,1),(8956,'Siruvachur(North)',167,1),(8957,'Sitheri',167,1),(8958,'Tandavarayapuram',167,1),(8959,'Tennangudipalayam',167,1),(8960,'Thalaivasal',167,1),(8961,'Thenkumarai',167,1),(8962,'Thiyaganur',167,1),(8963,'Tulukkanur',167,1),(8964,'Udayampatti',167,1),(8965,'Unatur',167,1),(8966,'Vadakumarai',167,1),(8967,'Valaiyamadevi',167,1),(8968,'Varagur',167,1),(8969,'Veppanatam',167,1),(8970,'Adaiyur',168,1),(8971,'Avaniperur (East)',168,1),(8972,'Avaniperur (West)',168,1),(8973,'Chettimankurichchi',168,1),(8974,'Chinnamanali',168,1),(8975,'Chittur - Bit 2',168,1),(8976,'Chittur Bit 1',168,1),(8977,'Dadapuram',168,1),(8978,'Erumaipatti',168,1),(8979,'Idappadi',168,1),(8980,'Irupali',168,1),(8981,'Kachchippalli',168,1),(8982,'Konasamudaram',168,1),(8983,'Konganapuram',168,1),(8984,'Koranampatti',168,1),(8985,'Kurumbapatti',168,1),(8986,'Nedungulam',168,1),(8987,'Pakkanadu',168,1),(8988,'Puduppalaiyam',168,1),(8989,'Pulampatti',168,1),(8990,'Samudaram',168,1),(8991,'Tangayur',168,1),(8992,'Vellalapuram',168,1),(8993,'Vellarivalli',168,1),(8994,'Vembaneri',168,1),(8995,'Vembaneri',168,1),(8996,'Anaiyampatti',169,1),(8997,'Belur',169,1),(8998,'Chokkanur Agraharam',169,1),(8999,'East Rajapalayam',169,1),(9000,'Gangavalli',169,1),(9001,'Ilupainatham',169,1),(9002,'Jangamasamudram',169,1),(9003,'Kadambur',169,1),(9004,'Kallipatti Seradi',169,1),(9005,'Kavarpanai',169,1),(9006,'Kondayampalli',169,1),(9007,'Koneripatti',169,1),(9008,'Krishnapuram',169,1),(9009,'Kudumalai',169,1),(9010,'Laddivadi',169,1),(9011,'Manmalai',169,1),(9012,'Mudakkupatti',169,1),(9013,'Naduvalur',169,1),(9014,'Nagiyampatti',169,1),(9015,'Nattar Agraharam',169,1),(9016,'Odiyattur',169,1),(9017,'Pachchamali',169,1),(9018,'Pagadappadi',169,1),(9019,'Pillayarmathi',169,1),(9020,'Pinnanur',169,1),(9021,'Puliyankurichi',169,1),(9022,'Sendarappatti',169,1),(9023,'Sengadu',169,1),(9024,'Seradi Mulai',169,1),(9025,'Tammampatti',169,1),(9026,'Teadavur',169,1),(9027,'Tittacheri',169,1),(9028,'Ulipuram',169,1),(9029,'Valakkombai',169,1),(9030,'Valasaikkallipatti',169,1),(9031,'Vellaiyur',169,1),(9032,'Veppadi',169,1),(9033,'Veppampundi',169,1),(9034,'Veppantattai',169,1),(9035,'Viraganur',169,1),(9036,'Danishpet',170,1),(9037,'Darapuram',170,1),(9038,'Dasagasamudram',170,1),(9039,'Divattippatti',170,1),(9040,'Elattur',170,1),(9041,'Gundukkal',170,1),(9042,'Kadayampatti (South)',170,1),(9043,'Kadayampatti North',170,1),(9044,'Kanavoipudur',170,1),(9045,'Kanjanayakkanpatti',170,1),(9046,'Ketunayakkampatti',170,1),(9047,'Kongupatti (North)',170,1),(9048,'Kongupatti South',170,1),(9049,'Kukuttaipatti',170,1),(9050,'Marakkottai',170,1),(9051,'Mukkanur',170,1),(9052,'Nachchanampatti',170,1),(9053,'Naduppatti',170,1),(9054,'Palappallikombai',170,1),(9055,'Pannappatti',170,1),(9056,'Poosaripatti',170,1),(9057,'Pottipuram',170,1),(9058,'Sekkarapatti',170,1),(9059,'Semmandappatti',170,1),(9060,'Sikkanampatti',170,1),(9061,'Tattyanpatti',170,1),(9062,'Tumbipadi',170,1),(9063,'Veppilai',170,1),(9064,'Alamarathupatti',171,1),(9065,'Amaram',171,1),(9066,'Aranganur',171,1),(9067,'Avadattur',171,1),(9068,'Banapuram',171,1),(9069,'Bukkampatti',171,1),(9070,'Chinna Soragai',171,1),(9071,'Chinnasattapadi',171,1),(9072,'Dasagappatti',171,1),(9073,'Dinnappatti',171,1),(9074,'Doramangalam',171,1),(9075,'Gonur West',171,1),(9076,'Guttappatti',171,1),(9077,'Kannamuchi',171,1),(9078,'Karikkappatti',171,1),(9079,'Kaveripuram',171,1),(9080,'Kaveripuram South',171,1),(9081,'Kolnayakkanpatti',171,1),(9082,'Konur East',171,1),(9083,'Koppam',171,1),(9084,'Koppampatti',171,1),(9085,'Kulathur',171,1),(9086,'Kunandiyur',171,1),(9087,'Lakkampatti',171,1),(9088,'M.Kalippatti',171,1),(9089,'Mallikundam',171,1),(9090,'Mallikuttappatti',171,1),(9091,'Manattal Nallakavundanpatti',171,1),(9092,'Mechcheri',171,1),(9093,'Mulakkadu',171,1),(9094,'Nangavalli',171,1),(9095,'Navappatti',171,1),(9096,'Olaippatti',171,1),(9097,'Palamalai',171,1),(9098,'Pallippatti',171,1),(9099,'Periya Soragai',171,1),(9100,'Periyasattappadi',171,1),(9101,'Pottaneri',171,1),(9102,'Pottaneri Nallakavundanpatti',171,1),(9103,'Samballi',171,1),(9104,'Singiripatti',171,1),(9105,'Surappalli',171,1),(9106,'Thethigiripatti',171,1),(9107,'Vanavasi',171,1),(9108,'Vellar',171,1),(9109,'Virakkal',171,1),(9110,'Virakkalpudur',171,1),(9111,'Virudasampatti',171,1),(9112,'Alagusamudram',172,1),(9113,'Amarakundhi',172,1),(9114,'Anaikavundanpatti',172,1),(9115,'Ariyampatti',172,1),(9116,'Arurpatti',172,1),(9117,'Balbakki',172,1),(9118,'Chellapillaikuttai',172,1),(9119,'Chettipatti',172,1),(9120,'Dasavilakku (South)',172,1),(9121,'Dasavilakku North',172,1),(9122,'Ettikuttaipatti',172,1),(9123,'Gobinathapuram',172,1),(9124,'Gollappatti',172,1),(9125,'Idaiyappatti',172,1),(9126,'Ilavampatti',172,1),(9127,'Jagadevempatti',172,1),(9128,'Kamalapuram',172,1),(9129,'Kaminayakkanpatti',172,1),(9130,'Karukkalvadi',172,1),(9131,'Karuppanampatti',172,1),(9132,'Karuppur',172,1),(9133,'Kasuvireddippatti',172,1),(9134,'Kattaperiyampatti',172,1),(9135,'Konagapadi',172,1),(9136,'Kottaimettupatti',172,1),(9137,'Kottakkavundampatti',172,1),(9138,'Kullamanayakanpatti',172,1),(9139,'Kurukkuppatti',172,1),(9140,'Mailappalaiyam',172,1),(9141,'Mallikuttai',172,1),(9142,'Manattal',172,1),(9143,'Mankuppai',172,1),(9144,'Mungilpadi',172,1),(9145,'Muthunayakanpatti',172,1),(9146,'Naranampalayam',172,1),(9147,'Omalur',172,1),(9148,'P.Kalippatti',172,1),(9149,'Pachchanampatti',172,1),(9150,'Pagalpatti',172,1),(9151,'Panikkanur',172,1),(9152,'Pappambadi',172,1),(9153,'Periyerippatti',172,1),(9154,'Puliyampatti',172,1),(9155,'Ramireddipatti',172,1),(9156,'Reddipatti',172,1),(9157,'Sakkarasettipatti',172,1),(9158,'Saminayakkampatti',172,1),(9159,'Sangitappatti',172,1),(9160,'Sekkarapatti',172,1),(9161,'Selavadai',172,1),(9162,'Sikkampatti',172,1),(9163,'T.Maramangalam',172,1),(9164,'Taramangalam',172,1),(9165,'Tattayangarpatti',172,1),(9166,'Tekkampatti',172,1),(9167,'Tindamangalam',172,1),(9168,'Tolasampatti',172,1),(9169,'Tundumaniyam',172,1),(9170,'Umbilika Maramangalam',172,1),(9171,'Vedappatti',172,1),(9172,'Vellakkalpatti',172,1),(9173,'Vellalapatti',172,1),(9174,'A.Karadippatti',173,1),(9175,'Abinavam',173,1),(9176,'Adiyanur',173,1),(9177,'Ariyapalayam',173,1),(9178,'Chekkadipatti',173,1),(9179,'Chinnakalrayanmalai North',173,1),(9180,'Chinnakalrayanmalai South',173,1),(9181,'Chinnakrishnapuram',173,1),(9182,'Chinnamasamudram',173,1),(9183,'Errammasamudram',173,1),(9184,'Ettapur',173,1),(9185,'Gopalapuram',173,1),(9186,'Iddayappatti',173,1),(9187,'Kalarampatti',173,1),(9188,'Kalleripatti',173,1),(9189,'Kalyanagiri',173,1),(9190,'Karadipatti Belur',173,1),(9191,'Kariyakovilvalavu',173,1),(9192,'Keelavarai',173,1),(9193,'Komarapalayam',173,1),(9194,'Kottavadi',173,1),(9195,'Kovilputhur',173,1),(9196,'Kunnur',173,1),(9197,'Malayalappatti 1',173,1),(9198,'Mannur',173,1),(9199,'Mettudaiyampalayam',173,1),(9200,'Mettuppalayam',173,1),(9201,'Muthakavundanur',173,1),(9202,'Neyyamalai',173,1),(9203,'Oddapatti',173,1),(9204,'Olaipadi',173,1),(9205,'Palaniyapuri',173,1),(9206,'Panaimadal',173,1),(9207,'Peddanayakkanpalayam',173,1),(9208,'Periyakrishnapuram',173,1),(9209,'Puthirakavundanpalayam',173,1),(9210,'Rangappanayakanpalayam',173,1),(9211,'Soolankurichi',173,1),(9212,'Tamayanur',173,1),(9213,'Tennampillaiyur',173,1),(9214,'Thalavaipatti',173,1),(9215,'Thumbal',173,1),(9216,'Thurumalainamasamudram',173,1),(9217,'Umaiyalpuram',173,1),(9218,'Vadugathampatti',173,1),(9219,'Virakavundanur',173,1),(9220,'West Rajapalayam',173,1),(9221,'Achanguttaipatti Pudur',174,1),(9222,'Achanguttapatti',174,1),(9223,'Adikarapatti',174,1),(9224,'Adimalaipatti',174,1),(9225,'Ammapalayam',174,1),(9226,'Ammapettai',174,1),(9227,'Aramanur',174,1),(9228,'Ayyamperumalpatti',174,1),(9229,'Chinnanur',174,1),(9230,'Dhasinayakkanpatti',174,1),(9231,'Eramanayakkanpalayam',174,1),(9232,'Eramanayakkanpalayam',174,1),(9233,'Eramanayakkanpalayam',174,1),(9234,'Erumapalaiyam',174,1),(9235,'Gejjalnayakkanpatti',174,1),(9236,'Hasthampatti',174,1),(9237,'Jalluttuppatti',174,1),(9238,'Jerugumalai',174,1),(9239,'Kammalapatti',174,1),(9240,'Kannankurichi',174,1),(9241,'Karpagam',174,1),(9242,'Kattiripatti',174,1),(9243,'Kondamanayakkanpatti',174,1),(9244,'Koratthupatti',174,1),(9245,'Kumaraswamipatti',174,1),(9246,'Kuppanur',174,1),(9247,'Mallur',174,1),(9248,'Maravaneri',174,1),(9249,'Mettupattitadanur',174,1),(9250,'Mukkanur',174,1),(9251,'Mukkuttipalayam',174,1),(9252,'Nalikkalpatti',174,1),(9253,'Nilavarapatti',174,1),(9254,'Nulattukombai',174,1),(9255,'Palapatti',174,1),(9256,'Pallipatti',174,1),(9257,'Pallitteruppatti',174,1),(9258,'Panamarattupatti',174,1),(9259,'Periyeri',174,1),(9260,'Perumalpalayam',174,1),(9261,'Salem Town',174,1),(9262,'Sambakttaipatti',174,1),(9263,'Sandiyur',174,1),(9264,'Sandiyur Attayampatti',174,1),(9265,'Sukkampatti',174,1),(9266,'Tadanur',174,1),(9267,'Tailanur',174,1),(9268,'Thatampatti',174,1),(9269,'Tippampatti',174,1),(9270,'Tumbalpatti',174,1),(9271,'Udayappatti',174,1),(9272,'Valaiyakkaranur',174,1),(9273,'Valakuttapatti',174,1),(9274,'Valasaiyur',174,1),(9275,'Vedappatti',174,1),(9276,'Vedappatti',174,1),(9277,'Veeranam',174,1),(9278,'Vellaiyampatti',174,1),(9279,'Vengampatti',174,1),(9280,'Akkaraipalayam',175,1),(9281,'Amani Kondalampatti',175,1),(9282,'Anaikkuttaipatti',175,1),(9283,'Annadanapatti',175,1),(9284,'Ariyampalayam',175,1),(9285,'Attavanai Pulaveri',175,1),(9286,'Attayampatti',175,1),(9287,'Bairoji Agraharam',175,1),(9288,'Basuvanattampatti',175,1),(9289,'Chennagiri',175,1),(9290,'Chinna Siragappadi',175,1),(9291,'Erachinampatti',175,1),(9292,'Eravadi Pettampatti',175,1),(9293,'Ettimanickampatti',175,1),(9294,'Ilampillai',175,1),(9295,'Jari Kondalampatti',175,1),(9296,'Kadathur Agraharam',175,1),(9297,'Kalparappatti',175,1),(9298,'Kombadipatti',175,1),(9299,'Marulayampalayam',175,1),(9300,'Muttanampalyam',175,1),(9301,'Nallarayyampatti',175,1),(9302,'Nayinampatti',175,1),(9303,'Neikkarapatti',175,1),(9304,'Palampatti',175,1),(9305,'Papparapatti',175,1),(9306,'Para Nattamangalam',175,1),(9307,'Parappatti',175,1),(9308,'Peria Siragappadi',175,1),(9309,'Perumakkavundanpatti',175,1),(9310,'Pettampatti',175,1),(9311,'Pulaveri Agraharam',175,1),(9312,'Rajapalayam',175,1),(9313,'Rakkippatti',175,1),(9314,'Ramapuram',175,1),(9315,'Reddipatti',175,1),(9316,'Selliyampalayam',175,1),(9317,'Senaipalayam',175,1),(9318,'Sevampalayam',175,1),(9319,'Silanayakkanpatti',175,1),(9320,'Sittaneri',175,1),(9321,'Tadagapatti',175,1),(9322,'Tammanayakkanpatti',175,1),(9323,'Thanakuttipalayam',175,1),(9324,'Utamasolapuram',175,1),(9325,'Vaniyambadi',175,1),(9326,'Velanattam',175,1),(9327,'Vembaditalam',175,1),(9328,'Virapandi',175,1),(9329,'Alagapuram',176,1),(9330,'Alagapuram Pudur',176,1),(9331,'Ariyakkavundanpatti',176,1),(9332,'Ariyakkavundanpatti',176,1),(9333,'Ayyamperumalpatti',176,1),(9334,'Bodinayakanpatti',176,1),(9335,'Chettichavadi',176,1),(9336,'Dalavaypatti',176,1),(9337,'Jagir Ammapalayam',176,1),(9338,'Kandampatti',176,1),(9339,'Karichipatti',176,1),(9340,'Keerapappampadi',176,1),(9341,'Kottanur',176,1),(9342,'Kullanampatti',176,1),(9343,'Laguvampatti',176,1),(9344,'Majara Gollappatti',176,1),(9345,'Mallamuppanpatti',176,1),(9346,'Mallaravuthanpatti',176,1),(9347,'Maramangalattupatti',176,1),(9348,'Meyyanur',176,1),(9349,'Muduthurai',176,1),(9350,'Murungapatti',176,1),(9351,'Nallampatti',176,1),(9352,'Narasojipatti',176,1),(9353,'Nayakkanpatti',176,1),(9354,'Pallappatti',176,1),(9355,'Perumampatti',176,1),(9356,'Petthampatti',176,1),(9357,'Poomandapatti',176,1),(9358,'Puthur Agraharam',176,1),(9359,'Reddiyur',176,1),(9360,'Sarkar Gollappatti',176,1),(9361,'Selattanpatti',176,1),(9362,'Sittanur Gollapatti',176,1),(9363,'Soudapuram',176,1),(9364,'Suramangalam',176,1),(9365,'Tirumalagiri',176,1),(9366,'Tumbatulipatti',176,1),(9367,'Vattamutthampatti',176,1),(9368,'Vedakuttampatti',176,1),(9369,'Agrahara Talaiyur',177,1),(9370,'Aiveli',177,1),(9371,'Alattur',177,1),(9372,'Annadanapatti',177,1),(9373,'Arasiramani Bit.1',177,1),(9374,'Arasiramani Bit.2',177,1),(9375,'Avarangampalaiyam',177,1),(9376,'Chinnakavundanur',177,1),(9377,'Devanakavundanur',177,1),(9378,'Egapuram',177,1),(9379,'Ernapuram',177,1),(9380,'Gedikaval',177,1),(9381,'Gudalur',177,1),(9382,'Idanganasalai Bit.1',177,1),(9383,'Idanganasalai Bit.2',177,1),(9384,'Irugalur',177,1),(9385,'Kalikavundanpalaiyam',177,1),(9386,'Kanagagiri',177,1),(9387,'Kandarkula',177,1),(9388,'Kannanderi',177,1),(9389,'Kasturippatti',177,1),(9390,'Katteri',177,1),(9391,'Kaveripatti Agraharam',177,1),(9392,'Kaverippatti',177,1),(9393,'Koneripatti',177,1),(9394,'Koneripatti Agraharam',177,1),(9395,'Kottavaradampatti',177,1),(9396,'Manjakkalpatti',177,1),(9397,'Morur Bit 2',177,1),(9398,'Morur Bit.1',177,1),(9399,'Naduvaneri',177,1),(9400,'Olakkachinnanur',177,1),(9401,'Puchampatti',177,1),(9402,'Puduppalayam',177,1),(9403,'Pudur',177,1),(9404,'Pullakkavundampatti',177,1),(9405,'Pullakkavundampatti Agraharam',177,1),(9406,'Sankagiri',177,1),(9407,'Sanniyasipatti Agraharam',177,1),(9408,'Sellappampatti',177,1),(9409,'Sungidivarathampatti 3',177,1),(9410,'Sungidivarathampatti 5',177,1),(9411,'Teppakkuttai',177,1),(9412,'Thevur',177,1),(9413,'Uthuppalaiyam',177,1),(9414,'Vadugappatti',177,1),(9415,'Vaikuntam',177,1),(9416,'Valayasettipalaiyam',177,1),(9417,'Veerachipalayam Agm',177,1),(9418,'Veppampatti',177,1),(9419,'Vettukkadupatti',177,1),(9420,'Virachipalaiyam(Amani)',177,1),(9421,'Aragalur',178,1),(9422,'Aratti Agragaram',178,1),(9423,'Chokkanur agraharam',178,1),(9424,'Deviyakurichi',178,1),(9425,'East Rajapalayam',178,1),(9426,'Govindampalayam',178,1),(9427,'Ilupainatham',178,1),(9428,'Kamakkapalayam',178,1),(9429,'Kattukottai',178,1),(9430,'Kavarpanai',178,1),(9431,'Laddivadi',178,1),(9432,'Manivilundan',178,1),(9433,'Mummudi',178,1),(9434,'Nathakkarai',178,1),(9435,'Nattar Agraharam',178,1),(9436,'Navakkuricchi',178,1),(9437,'Navalur',178,1),(9438,'Pagadappadi',178,1),(9439,'Pallipalayam',178,1),(9440,'Pattuythurai',178,1),(9441,'Periyeri',178,1),(9442,'Pinnanur',178,1),(9443,'Puliyankurichi',178,1),(9444,'Punalvasal',178,1),(9445,'Puttur',178,1),(9446,'Sadasivapuram',178,1),(9447,'Sarvaoy',178,1),(9448,'Satapadi',178,1),(9449,'Siruvachur south',178,1),(9450,'Sitheri',178,1),(9451,'Thalaivasal',178,1),(9452,'Thenkumarai',178,1),(9453,'Thiyaganur',178,1),(9454,'Tittacherri',178,1),(9455,'Unatur',178,1),(9456,'Vadakumarai',178,1),(9457,'Varagur',178,1),(9458,'Vellaiyur',178,1),(9459,'Veppampundi',178,1),(9460,'Veppanatam',178,1),(9461,'Viraganur',178,1),(9462,'Agrahara Valapadi',179,1),(9463,'Agraharanattamangalam',179,1),(9464,'Aladippatti',179,1),(9465,'Anuppur',179,1),(9466,'Arunuttumalai',179,1),(9467,'Attanurpatti',179,1),(9468,'Ayodhyapattianam',179,1),(9469,'Belur',179,1),(9470,'Chandrapillaivalasu',179,1),(9471,'Chenrayampalayam',179,1),(9472,'Chinnakavundapuram',179,1),(9473,'Chinnakuttimaduvu',179,1),(9474,'Chinnamanayakanpalayam',179,1),(9475,'Chinnavelampatti',179,1),(9476,'Eripudur',179,1),(9477,'Jambuttumalai',179,1),(9478,'Kankattiala',179,1),(9479,'Karipatti',179,1),(9480,'Karumapuram',179,1),(9481,'Karungalpatti',179,1),(9482,'Kattuveppilaipatti',179,1),(9483,'Kavarkalpatti',179,1),(9484,'Kiraippatti',179,1),(9485,'Kolattukombai',179,1),(9486,'Kullampatti',179,1),(9487,'Kumarapalayam',179,1),(9488,'Kumarasamiyur',179,1),(9489,'Kurichi',179,1),(9490,'Kuttattupatti',179,1),(9491,'Malaiyalapatti',179,1),(9492,'Mannarpalayam',179,1),(9493,'Mannayakkanpatti',179,1),(9494,'Masinayakkanpatti',179,1),(9495,'Mettupatti',179,1),(9496,'Minnampalli',179,1),(9497,'Mottur',179,1),(9498,'Mutampatti',179,1),(9499,'Nirmullikuttai',179,1),(9500,'Palapatti',179,1),(9501,'Pallikkadu',179,1),(9502,'Pelappadi',179,1),(9503,'Periyakavundapuram',179,1),(9504,'Periyakuttimaduvu',179,1),(9505,'Periyavelampatti',179,1),(9506,'Perumapalayam.M',179,1),(9507,'Ponnarampatti',179,1),(9508,'Pudupalayam',179,1),(9509,'Puludikkuttai',179,1),(9510,'Pungamaduvu',179,1),(9511,'Sandumalai',179,1),(9512,'Sarkar Nattamangalam',179,1),(9513,'Sarkar Valapadi',179,1),(9514,'Singipuram',179,1),(9515,'Sirumalai',179,1),(9516,'Somampatti',179,1),(9517,'Tekkalpatti',179,1),(9518,'Thukkiyampalayam',179,1),(9519,'Tirumanur',179,1),(9520,'Vellalakundam',179,1),(9521,'Veppilaipatti',179,1),(9522,'Veppilaipatti Pudur',179,1),(9523,'Vettaikkaranur',179,1),(9524,'Vilampatti',179,1),(9525,'Vilaripalayam',179,1),(9526,'Anaikkadu',180,1),(9527,'Arangam',180,1),(9528,'Aranmanaikadu',180,1),(9529,'Arasamarattur',180,1),(9530,'Asambur',180,1),(9531,'Attiyur',180,1),(9532,'Chinnamadur',180,1),(9533,'Choalambadi',180,1),(9534,'Elavadi',180,1),(9535,'Gundur',180,1),(9536,'Kadukkamarattur',180,1),(9537,'Kakkampadi',180,1),(9538,'Karadiyur',180,1),(9539,'Kelaiyur',180,1),(9540,'Kiliyur',180,1),(9541,'Kiraikadu',180,1),(9542,'Kolagur',180,1),(9543,'Kombuttukki',180,1),(9544,'Kommakadu',180,1),(9545,'Kondaiyanur',180,1),(9546,'Kottachchedu',180,1),(9547,'Kovilur',180,1),(9548,'Kumbippadi',180,1),(9549,'Kuttumuttal',180,1),(9550,'Madur',180,1),(9551,'Mailappatti',180,1),(9552,'Mangalam',180,1),(9553,'Manjakkuttai',180,1),(9554,'Maramangalam',180,1),(9555,'Mavutthu',180,1),(9556,'Melur',180,1),(9557,'Mottur',180,1),(9558,'Muluvi',180,1),(9559,'Mundachchedu',180,1),(9560,'Mundagambadi',180,1),(9561,'Nagalur',180,1),(9562,'Nallur',180,1),(9563,'Narathanchedu',180,1),(9564,'Narttanchedu',180,1),(9565,'Olavakodu',180,1),(9566,'Palakkadu',180,1),(9567,'Pattippadi',180,1),(9568,'Periyakadu',180,1),(9569,'Pilleri',180,1),(9570,'Pottukkadu',180,1),(9571,'Pudur',180,1),(9572,'Puliyampatti',180,1),(9573,'Puliyankadai',180,1),(9574,'Puliyur',180,1),(9575,'Puttur',180,1),(9576,'Puttur',180,1),(9577,'Semmaduvu',180,1),(9578,'Semmanatham',180,1),(9579,'Sendittu',180,1),(9580,'Sengadu',180,1),(9581,'Sengalattuppadi',180,1),(9582,'Solur',180,1),(9583,'Sonappadi',180,1),(9584,'Sorakkappatti',180,1),(9585,'Teppakadu',180,1),(9586,'Thalaichcholai',180,1),(9587,'Valavandi',180,1),(9588,'Vasambadi',180,1),(9589,'Vellakkadi',180,1),(9590,'Velur',180,1),(9591,'Veppadi',180,1),(9592,'Yercaud',180,1),(9593,'Anthakudi',181,1),(9594,'Aravayal',181,1),(9595,'Chittanur',181,1),(9596,'Eluvankottai',181,1),(9597,'Hanumandagudi',181,1),(9598,'Idaiyakudi',181,1),(9599,'Igaraaikottavayal',181,1),(9600,'Ilakkanivayal',181,1),(9601,'Iravuseri',181,1),(9602,'Irumbuvayal',181,1),(9603,'Iruvanivayal',181,1),(9604,'Kadagampatti',181,1),(9605,'Kalapangudi',181,1),(9606,'Kalattur',181,1),(9607,'Kallangudi',181,1),(9608,'Kandadevi',181,1),(9609,'Kandiyur',181,1),(9610,'Kannankottai',181,1),(9611,'Kannankudi',181,1),(9612,'Kappalur',181,1),(9613,'Karai',181,1),(9614,'Karkalattur',181,1),(9615,'Kilamalai',181,1),(9616,'Kodakudi',181,1),(9617,'Kodikkottai',181,1),(9618,'Kodikulam',181,1),(9619,'Kottur',181,1),(9620,'Kumani',181,1),(9621,'Kumari Attani Chatthiram',181,1),(9622,'Kurunthanakkottai',181,1),(9623,'Madakkottai',181,1),(9624,'Manjani',181,1),(9625,'Marani Sarugani',181,1),(9626,'Maviduthikkottai',181,1),(9627,'Melasemponmari',181,1),(9628,'Minittankudi',181,1),(9629,'Muppaiyur',181,1),(9630,'N.Manakudi',181,1),(9631,'Nachchangulam',181,1),(9632,'Nagamangalam',181,1),(9633,'Nagamathi',181,1),(9634,'Nallangudi',181,1),(9635,'Naranamangalam',181,1),(9636,'Nedodai',181,1),(9637,'Nedungulam',181,1),(9638,'Orasur',181,1),(9639,'Orumanienthal',181,1),(9640,'Pagaiyani Pirandani',181,1),(9641,'Panangulam',181,1),(9642,'Parayanenfdal',181,1),(9643,'Perattukottai',181,1),(9644,'Ponnalikottai',181,1),(9645,'Porkudi',181,1),(9646,'Pudukkottai',181,1),(9647,'Pulangudi',181,1),(9648,'Pusalagudi',181,1),(9649,'Putturani',181,1),(9650,'Sadaiyamangalam',181,1),(9651,'Sakkandi',181,1),(9652,'Saranendal',181,1),(9653,'Sattikkottai',181,1),(9654,'Selugai',181,1),(9655,'Seluvathi',181,1),(9656,'Siruganur',181,1),(9657,'Sirumarudur',181,1),(9658,'Sirunallur',181,1),(9659,'Siruvathi',181,1),(9660,'Tachchanvayal',181,1),(9661,'Teralappur',181,1),(9662,'Thalaiyur',181,1),(9663,'Thalakkavayal',181,1),(9664,'Thalanenthal',181,1),(9665,'Thangankudi',181,1),(9666,'Thennirvayal',181,1),(9667,'Thirani',181,1),(9668,'Thirumanavayal',181,1),(9669,'Thiruppakkottai',181,1),(9670,'Thiruvegampathu',181,1),(9671,'Tidakkottai',181,1),(9672,'Udaiyachi',181,1),(9673,'Unjanai',181,1),(9674,'Uruvatti',181,1),(9675,'Vadinanniyur',181,1),(9676,'Vagaikudi',181,1),(9677,'Vasandani',181,1),(9678,'Vellikatti',181,1),(9679,'Vengalur',181,1),(9680,'Vettiyalangulam',181,1),(9681,'Vijayapuram',181,1),(9682,'Virisur',181,1),(9683,'Vizhimar',181,1),(9684,'Akkavayal',182,1),(9685,'Alavidanganl',182,1),(9686,'Andakkudi North',182,1),(9687,'Aranaiyur',182,1),(9688,'Aranmanaikarai',182,1),(9689,'Elamanu',182,1),(9690,'Ilayankudi North',182,1),(9691,'Ilayankudi South',182,1),(9692,'Kalaikulam',182,1),(9693,'Kalanagathankottai',182,1),(9694,'Kannamangalam',182,1),(9695,'Karaikulam',182,1),(9696,'Karunchutti',182,1),(9697,'Katchathanallur',182,1),(9698,'Kattanur',182,1),(9699,'Keelanettur',182,1),(9700,'Keelayur',182,1),(9701,'Kottaiyur',182,1),(9702,'Kumarakurichi',182,1),(9703,'Kurichi',182,1),(9704,'Melapidariseri',182,1),(9705,'Melathuraiyur',182,1),(9706,'Melayur',182,1),(9707,'Mulliyarendal',182,1),(9708,'Munaivenri',182,1),(9709,'Muthur',182,1),(9710,'Nagamugundangudi',182,1),(9711,'Nagarkkudi',182,1),(9712,'Nenjathur',182,1),(9713,'Perumbacheri',182,1),(9714,'Pudukkottai',182,1),(9715,'Salaigramam',182,1),(9716,'Samudram',182,1),(9717,'Sathanur',182,1),(9718,'Sirupalai',182,1),(9719,'Sivaladi',182,1),(9720,'Sooranam',182,1),(9721,'Sothukudi',182,1),(9722,'Tevattagudi',182,1),(9723,'Thayamangalam',182,1),(9724,'Thiruvallur',182,1),(9725,'Thiruvudaiyarpuram',182,1),(9726,'Tugavur',182,1),(9727,'Udaynur',182,1),(9728,'Uthamanur',182,1),(9729,'Vadakkukeeranur',182,1),(9730,'Valayanendal',182,1),(9731,'Vandal',182,1),(9732,'Vijayangudi',182,1),(9733,'Virayathakandan',182,1),(9734,'Visavanur',182,1),(9735,'Vllakulam',182,1),(9736,'Adappadakki',183,1),(9737,'Allur',183,1),(9738,'Alpattaviduthi',183,1),(9739,'Gouripatti',183,1),(9740,'K.Perungarai',183,1),(9741,'Kakulam',183,1),(9742,'Kangipatti',183,1),(9743,'Kangiram',183,1),(9744,'Kilapidavur',183,1),(9745,'Kodikadukadamburani',183,1),(9746,'Kolandhi',183,1),(9747,'Kollangudi',183,1),(9748,'Kurunthani Variyendal',183,1),(9749,'M.Vagaikulam',183,1),(9750,'M.Velangulam',183,1),(9751,'Mallal',183,1),(9752,'Mangattendal',183,1),(9753,'Marakkattur',183,1),(9754,'Marandai',183,1),(9755,'Marathur',183,1),(9756,'Mathukanmoi',183,1),(9757,'Mongankanmoi',183,1),(9758,'Moovarkanmoi',183,1),(9759,'Mudikkarai',183,1),(9760,'Muthur',183,1),(9761,'Nadamangalam',183,1),(9762,'Nallendal',183,1),(9763,'Nattarasankottai',183,1),(9764,'Nedungulam',183,1),(9765,'Oyyavandan',183,1),(9766,'P.Udayarendal',183,1),(9767,'Palkulam',183,1),(9768,'Pallivayal',183,1),(9769,'Panangadi',183,1),(9770,'Paruthikanmoi',183,1),(9771,'Periyakannanur',183,1),(9772,'Pirandaikulam',183,1),(9773,'Poovali',183,1),(9774,'Pudukiluvachi',183,1),(9775,'Pulavanvayal',183,1),(9776,'Puliyangulam',183,1),(9777,'Purasadi Udappu',183,1),(9778,'Sakkur',183,1),(9779,'Sedambal',183,1),(9780,'Sembanur',183,1),(9781,'Sempar',183,1),(9782,'Sennalkudi',183,1),(9783,'Settur',183,1),(9784,'Sevavurani',183,1),(9785,'Silukkapatti',183,1),(9786,'Siramam',183,1),(9787,'Siriyur',183,1),(9788,'Sirukanaperi',183,1),(9789,'Solavandan',183,1),(9790,'Somanathamangalam',183,1),(9791,'Thadiyamangalam',183,1),(9792,'Usilanendal Sundanendal',183,1),(9793,'Usilangulam',183,1),(9794,'Valanai',183,1),(9795,'Vaniyangudi',183,1),(9796,'Vannikkudi',183,1),(9797,'Vettukulam',183,1),(9798,'Vittaneri',183,1),(9799,'Alampatti',184,1),(9800,'Alavilampatti @ Kilathurumbu',184,1),(9801,'Amaravathi',184,1),(9802,'Ambakkudi',184,1),(9803,'Aranmanaipatti',184,1),(9804,'Aranmanaisiruvayal',184,1),(9805,'Ariyakkudi',184,1),(9806,'Athankudi',184,1),(9807,'Elandamangalam',184,1),(9808,'Iluppaikkudi',184,1),(9809,'Jayamkondan',184,1),(9810,'K.Nerpugapatti',184,1),(9811,'Kalanivasal',184,1),(9812,'Kalattur',184,1),(9813,'Kallal',184,1),(9814,'Kallangudi',184,1),(9815,'Kalluppatti',184,1),(9816,'Kanadukattan',184,1),(9817,'Kandanur',184,1),(9818,'Karaikkudi',184,1),(9819,'Kilappoongudi',184,1),(9820,'Kiranipatti',184,1),(9821,'Koothalur',184,1),(9822,'Kothamangalam',184,1),(9823,'Kothari',184,1),(9824,'Kottaiyur',184,1),(9825,'Kovilur',184,1),(9826,'Kulappadi',184,1),(9827,'Kurunthampattu',184,1),(9828,'Malakkandan',184,1),(9829,'Malmanakkudi',184,1),(9830,'Mammudisampatti',184,1),(9831,'Managiri Sukkanendal',184,1),(9832,'Mattur',184,1),(9833,'Mithiravayal',184,1),(9834,'Natticheri',184,1),(9835,'Palaiyoor',184,1),(9836,'Pallattur',184,1),(9837,'Panangudi',184,1),(9838,'Pananvayal',184,1),(9839,'Periyakottai',184,1),(9840,'Periyakottakudi',184,1),(9841,'Pilar',184,1),(9842,'Pirambuvayal',184,1),(9843,'Pudur',184,1),(9844,'Pukkudi',184,1),(9845,'Sakkottai',184,1),(9846,'Sannavanam',184,1),(9847,'Seduregunathapattinam',184,1),(9848,'Sekkalaikottai',184,1),(9849,'Sembanur',184,1),(9850,'Sengathankudi',184,1),(9851,'Senjai',184,1),(9852,'Sirugavayal',184,1),(9853,'Thevapattu',184,1),(9854,'Thiruthipatti',184,1),(9855,'Thiruvelangudi',184,1),(9856,'Uyyakondansiruvayal',184,1),(9857,'Varivayal',184,1),(9858,'Velangudi',184,1),(9859,'Vellippatti',184,1),(9860,'Veppangulam',184,1),(9861,'Vettiyur',184,1),(9862,'Vilavadiendal',184,1),(9863,'Annavasal',185,1),(9864,'Arasanendal',185,1),(9865,'Arimandapam',185,1),(9866,'Chinnakannanur',185,1),(9867,'Elunutrumangalam',185,1),(9868,'K.K.Pallam',185,1),(9869,'Kalpiravu',185,1),(9870,'Kattikulam',185,1),(9871,'Katturani',185,1),(9872,'Keelapasalai',185,1),(9873,'Kilangattur',185,1),(9874,'Kirungakottai',185,1),(9875,'Kuvalaiveli',185,1),(9876,'M.Karisalkulam',185,1),(9877,'Malavarayanendal',185,1),(9878,'Manamadurai',185,1),(9879,'Manampakki',185,1),(9880,'Mangulam',185,1),(9881,'Maranadu',185,1),(9882,'Melanettur',185,1),(9883,'Melapidavur',185,1),(9884,'Milaganur',185,1),(9885,'P.Alangulam',185,1),(9886,'Perumbacheri',185,1),(9887,'Pudukkulam',185,1),(9888,'Rajakambiram',185,1),(9889,'S.Karaikkudi',185,1),(9890,'Seikalathur',185,1),(9891,'Senthattiyendal',185,1),(9892,'Sirugudi',185,1),(9893,'Soorakkulam',185,1),(9894,'Sullangudi',185,1),(9895,'T.Pudukkottai',185,1),(9896,'Thamaikudi',185,1),(9897,'Theethanpettai',185,1),(9898,'Therkuchandanur',185,1),(9899,'Vadakkuchandanur',185,1),(9900,'Vagudi',185,1),(9901,'Vedhiyarendal',185,1),(9902,'Vellikurichi',185,1),(9903,'Vilathur',185,1),(9904,'A. Kalappur',186,1),(9905,'A.Melaiyur',186,1),(9906,'Aralikkottai',186,1),(9907,'Chettikurichi',186,1),(9908,'D.Kalappur',186,1),(9909,'Dharmapatti',186,1),(9910,'Eriyur',186,1),(9911,'Erumaipatti',186,1),(9912,'Jeyamkondanilai',186,1),(9913,'Karisalpatti',186,1),(9914,'Kayampatti',186,1),(9915,'Kilvayal',186,1),(9916,'Kirungakkottai',186,1),(9917,'Kulattuppatti',186,1),(9918,'Mallakottai',186,1),(9919,'Mampatti North',186,1),(9920,'Mampatti South',186,1),(9921,'Mampatti Devasthanam',186,1),(9922,'Manalur',186,1),(9923,'Mandhakudipatti',186,1),(9924,'Melapatti',186,1),(9925,'Melavannariruppu',186,1),(9926,'Minnamalaippatti',186,1),(9927,'Muraiyur',186,1),(9928,'Musundapatti',186,1),(9929,'Nainapatti',186,1),(9930,'Neduvayal',186,1),(9931,'Piranmalai',186,1),(9932,'Piranpatti',186,1),(9933,'S.Mathur',186,1),(9934,'Sathurvedhamangalam-Maruthipat',186,1),(9935,'Semmampattipudur',186,1),(9936,'Sevalpatti',186,1),(9937,'Singampunari North',186,1),(9938,'Singampunari South',186,1),(9939,'Sirumarudur',186,1),(9940,'Surakkudi',186,1),(9941,'Ulagampatti',186,1),(9942,'Vadavanpatti',186,1),(9943,'Valasaippatti',186,1),(9944,'Warappur',186,1),(9945,'Alagamaneri',187,1),(9946,'Alagichipatti',187,1),(9947,'Alangulam',187,1),(9948,'Alavakottai',187,1),(9949,'Ammampatti',187,1),(9950,'Arasani',187,1),(9951,'Arasanur',187,1),(9952,'Idaikattur',187,1),(9953,'Idayamelur',187,1),(9954,'Iluppaikudi',187,1),(9955,'Kadambangulam',187,1),(9956,'Kadaneri',187,1),(9957,'Kallarathinipatti',187,1),(9958,'Kallurani',187,1),(9959,'Kandangipatti',187,1),(9960,'Kanjirangal',187,1),(9961,'Kannariruppu',187,1),(9962,'Karungalakudi',187,1),(9963,'Kathapattu',187,1),(9964,'Kattanipatti',187,1),(9965,'Kayangulam',187,1),(9966,'Kilakandani',187,1),(9967,'Kilakottai',187,1),(9968,'Kilamangalam',187,1),(9969,'Kilapoongudi',187,1),(9970,'Kilathari',187,1),(9971,'Kootturavupatti',187,1),(9972,'Kottagudi',187,1),(9973,'Kottappatti',187,1),(9974,'Kovanur',187,1),(9975,'Kumarapatti',187,1),(9976,'Madatgupatti',187,1),(9977,'Malampatti',187,1),(9978,'Mangudi',187,1),(9979,'Marani Usilangulam',187,1),(9980,'Mattur',187,1),(9981,'Melapoongudi',187,1),(9982,'Melavaniyangudi',187,1),(9983,'Mudikandam',187,1),(9984,'Nagarampatti',187,1),(9985,'Nalukottai',187,1),(9986,'Namanur',187,1),(9987,'Nariyankudi',187,1),(9988,'O.Pudur',187,1),(9989,'Okkur',187,1),(9990,'Padamattur',187,1),(9991,'Paganeri',187,1),(9992,'Paiyur Pillaivayal',187,1),(9993,'Paniyur',187,1),(9994,'Perungudi',187,1),(9995,'Pillurr',187,1),(9996,'Ponnakulam',187,1),(9997,'Pudupatti',187,1),(9998,'Sallur',187,1),(9999,'Senthi Udayanathapuram',187,1),(10000,'Silanthikudi',187,1),(10001,'Sozhapuram',187,1),(10002,'Sundaranadappu(Thuvangal)',187,1),(10003,'Surakulam',187,1),(10004,'Thamaraki North',187,1),(10005,'Thamaraki South',187,1),(10006,'Thiraniendal',187,1),(10007,'Thirumalai',187,1),(10008,'V.Pudukulam',187,1),(10009,'Valuthani',187,1),(10010,'Vempangudi',187,1),(10011,'Vempattur',187,1),(10012,'Allinagaram',188,1),(10013,'Ambalathadi',188,1),(10014,'D. Karisalkulam',188,1),(10015,'Enathi',188,1),(10016,'Erukkalavellur',188,1),(10017,'Kaliyandur',188,1),(10018,'Kalukerkadai',188,1),(10019,'Kaluvankulam',188,1),(10020,'Kanjirankulam',188,1),(10021,'Kanur',188,1),(10022,'Keeladi',188,1),(10023,'Kondagai',188,1),(10024,'Kothangulam',188,1),(10025,'Ladanendal',188,1),(10026,'Madappuram',188,1),(10027,'Manalur',188,1),(10028,'Mankudi',188,1),(10029,'Melachorikulam',188,1),(10030,'Melarangiyam',188,1),(10031,'Mukkudi',188,1),(10032,'Palayanur',188,1),(10033,'Panayanendal',188,1),(10034,'Pappagudi',188,1),(10035,'Piramanur',188,1),(10036,'Poovanthi',188,1),(10037,'Pottapalayam',188,1),(10038,'S.Vagaikulam',188,1),(10039,'Saluppanodai',188,1),(10040,'Sayanapuram',188,1),(10041,'Semboor',188,1),(10042,'Senkulam',188,1),(10043,'Sottathatti',188,1),(10044,'T.Athikarai',188,1),(10045,'T.Nelmudikarai',188,1),(10046,'Theli',188,1),(10047,'Thiruppachetti North',188,1),(10048,'Thiruppachetti South',188,1),(10049,'Thiruppuvanam Pudur',188,1),(10050,'Thoothai',188,1),(10051,'Valayanendal',188,1),(10052,'Vallarendal',188,1),(10053,'Veeranendal',188,1),(10054,'Vellur',188,1),(10055,'Alagapuri',189,1),(10056,'Alangudi',189,1),(10057,'Attikkadu Thekkur',189,1),(10058,'Brahmanapatti',189,1),(10059,'Ilankudi',189,1),(10060,'Ilayattankudi North',189,1),(10061,'Ilayattankudi South',189,1),(10062,'K.Attangudi',189,1),(10063,'K.Vairavanpatti And Karugapi',189,1),(10064,'Kallipattu',189,1),(10065,'Kambanur',189,1),(10066,'Kandavarayanpatti',189,1),(10067,'Karaiyur',189,1),(10068,'Karuppur',189,1),(10069,'Kattambur',189,1),(10070,'Kavanur',189,1),(10071,'Kottaiyiruppu',189,1),(10072,'Kunnakkudi',189,1),(10073,'Madavarayanpatti',189,1),(10074,'Mahibalanpatti',189,1),(10075,'Naduvikkottai Kilaiyur',189,1),(10076,'Naduvikkottai',189,1),(10077,'Nattarmangalam',189,1),(10078,'Nedumaram',189,1),(10079,'Nemam',189,1),(10080,'Nerkuppai',189,1),(10081,'Olugumangalam',189,1),(10082,'P.Karungulam',189,1),(10083,'Paiyur',189,1),(10084,'Pattakurichi',189,1),(10085,'Pattamangalam East',189,1),(10086,'Pattamangalam West',189,1),(10087,'Perichikoil',189,1),(10088,'Pulankurichi',189,1),(10089,'Ranasingapuram',189,1),(10090,'S.Velangudi',189,1),(10091,'Senbagampettai',189,1),(10092,'Sevarakkottai',189,1),(10093,'Sevvur',189,1),(10094,'Siravayal',189,1),(10095,'Sirukudalpatti',189,1),(10096,'Sullangudi',189,1),(10097,'Sunnambiruppu',189,1),(10098,'T. Vairavanpatti',189,1),(10099,'Tenkarai',189,1),(10100,'Tevarambur',189,1),(10101,'Thanipatti',189,1),(10102,'Thattati',189,1),(10103,'Thenmapattu',189,1),(10104,'Thirukkalappatti',189,1),(10105,'Thirukkolakkudi',189,1),(10106,'Thirukoshtiyur',189,1),(10107,'Thiruppathur',189,1),(10108,'Thiruvudaiyarpatti',189,1),(10109,'Thuvar',189,1),(10110,'Vadamavali',189,1),(10111,'Vaiyakalathur',189,1),(10112,'Vaniyankadu',189,1),(10113,'Veliyathur',189,1),(10114,'Alangulam',190,1),(10115,'Anainthaperumalnadanoor',190,1),(10116,'Andipatti',190,1),(10117,'Anjankattalai',190,1),(10118,'Ayyanarkulam',190,1),(10119,'Kadanganeri',190,1),(10120,'Kaduvetti',190,1),(10121,'Kaluneerkulam',190,1),(10122,'Kasikkuvaithan',190,1),(10123,'Kavalakuruchi',190,1),(10124,'Keelapavoor Part-1',190,1),(10125,'Keelapavoor Part-2',190,1),(10126,'Kidarakulam',190,1),(10127,'Kuthapanjan',190,1),(10128,'Madathur',190,1),(10129,'Maranthai',190,1),(10130,'Maruthamputhur Part-1',190,1),(10131,'Maruthamputhur Part-2',190,1),(10132,'Mayamankuruchi',190,1),(10133,'Naranapuram',190,1),(10134,'Nettur',190,1),(10135,'Odaimarichchan',190,1),(10136,'Pethanadarpatti Part-1',190,1),(10137,'Pethanadarpatti Part-2',190,1),(10138,'Poolankulam',190,1),(10139,'Pudupatti Part-1',190,1),(10140,'Pudupatti Part-2',190,1),(10141,'Ravuthaperi',190,1),(10142,'Sivalarkulam',190,1),(10143,'Subbiahpuram',190,1),(10144,'Thuppakudi',190,1),(10145,'Thuthikulam',190,1),(10146,'Udaiyampuli',190,1),(10147,'Venkadampatti Part-1',190,1),(10148,'Venkadampatti Part-2',190,1),(10149,'Achanpudur',191,1),(10150,'Alangulam',191,1),(10151,'Ariyanayagipuram',191,1),(10152,'Ayikudi',191,1),(10153,'Boganallur',191,1),(10154,'Chinthamani',191,1),(10155,'Chokkampatti',191,1),(10156,'Idaikal',191,1),(10157,'Kadayanallur',191,1),(10158,'Kampaneri Pudukudi Part-1',191,1),(10159,'Kampaneri Pudukudi Part-2',191,1),(10160,'Kanagasabapathiperi',191,1),(10161,'Kasitharmam',191,1),(10162,'Kilangadu',191,1),(10163,'Kodikurichi',191,1),(10164,'Krishnapuram',191,1),(10165,'Madathupatti',191,1),(10166,'Malayadikkurichi',191,1),(10167,'Melapuliyankudi',191,1),(10168,'Nagaram',191,1),(10169,'Nainaragaram',191,1),(10170,'Poigai',191,1),(10171,'Puliangudi',191,1),(10172,'Punnaivanam',191,1),(10173,'Ramasamiyapuram',191,1),(10174,'Sambavar Vadakarai',191,1),(10175,'Sendamangalam',191,1),(10176,'Thalaivankottai',191,1),(10177,'Thirumalainayakan Pudukkudi',191,1),(10178,'Urmelalagiyan',191,1),(10179,'Vairavankulam',191,1),(10180,'Chinnakovilan Kulam',192,1),(10181,'Gurukkalpatti',192,1),(10182,'Ilanthaikulam',192,1),(10183,'K.Maruthappapuram',192,1),(10184,'Kalappakulam',192,1),(10185,'Karivalamvantha Nallur',192,1),(10186,'Keelaneelithanallur',192,1),(10187,'Keelaveerasigamani',192,1),(10188,'Kulasekaramangalam',192,1),(10189,'Kuvalaikanni',192,1),(10190,'Manaloor',192,1),(10191,'Melaneelithanallur',192,1),(10192,'Naduvakurichi-Major',192,1),(10193,'Naduvakurichi-Minor',192,1),(10194,'Nochikulam',192,1),(10195,'Panaiyoor',192,1),(10196,'Panthapuli',192,1),(10197,'Paruvakudi',192,1),(10198,'Pattadaikatti',192,1),(10199,'Periyakovilan Kulam',192,1),(10200,'Periyoor',192,1),(10201,'Perumalpatti',192,1),(10202,'Perumpathur',192,1),(10203,'Poigai',192,1),(10204,'Sankarankovil',192,1),(10205,'Therku Sankarankovil',192,1),(10206,'Vadakku Panai Vadali',192,1),(10207,'Vaddakuputhur',192,1),(10208,'Vadikkottai',192,1),(10209,'Valavanthapuram',192,1),(10210,'Vayali',192,1),(10211,'Veerasigamani',192,1),(10212,'Veeriruppu',192,1),(10213,'Vellalankulam',192,1),(10214,'Yechantha',192,1),(10215,'Elathur',193,1),(10216,'Kanakkapillaivalasai',193,1),(10217,'Karkudi',193,1),(10218,'Kunnakudy',193,1),(10219,'Mekkarai',193,1),(10220,'Nagalkadu',193,1),(10221,'Neduvayal',193,1),(10222,'Panpoli',193,1),(10223,'Periyapillaivalasai',193,1),(10224,'Piranoor',193,1),(10225,'Pudur',193,1),(10226,'Puliyarai',193,1),(10227,'Sengottai Keelur',193,1),(10228,'Sengottai Melur',193,1),(10229,'Sengottai Town',193,1),(10230,'Thenpothai',193,1),(10231,'Vadakarai Keelpidagai',193,1),(10232,'Vadakarai Melpidagai',193,1),(10233,'Vallam',193,1),(10234,'Ariyur',194,1),(10235,'Cuddalor',194,1),(10236,'Dharugapuram',194,1),(10237,'Inamkovilpatti',194,1),(10238,'Naranapuram - Part-1',194,1),(10239,'Naranapuram - Part-2',194,1),(10240,'Nelkattumseval',194,1),(10241,'Patakurichi',194,1),(10242,'Ramanathapuram',194,1),(10243,'Rayagiri - Part-1',194,1),(10244,'Rayagiri - Part-2',194,1),(10245,'Sanganaperi',194,1),(10246,'Sivagiri - Part-1',194,1),(10247,'Sivagiri - Part-2',194,1),(10248,'Subramaniyapuram',194,1),(10249,'Thenmalai - Part-1',194,1),(10250,'Thenmalai - Part-2',194,1),(10251,'Thirumalapuram',194,1),(10252,'Vasudevanallur',194,1),(10253,'Viswanathaperi - Part-1',194,1),(10254,'Viswanathaperi - Part-2',194,1),(10255,'Adaichani',195,1),(10256,'Alwarkurichi Part-1',195,1),(10257,'Alwarkurichi Part-2',195,1),(10258,'Avudaiyannur',195,1),(10259,'Ayan Dharmapuramadam',195,1),(10260,'Ayan Pottalpudhur',195,1),(10261,'Ayiraperi',195,1),(10262,'Courtrallam',195,1),(10263,'Govindaperi',195,1),(10264,'Gunaramanallur',195,1),(10265,'Ilanji',195,1),(10266,'Kadaiyam Perumpathu Part-1',195,1),(10267,'Kadaiyam Perumpathu Part-2',195,1),(10268,'Kallurani',195,1),(10269,'Keela Ambur',195,1),(10270,'Keela Kadaiyam Part-1',195,1),(10271,'Keela Kadaiyam Part-2',195,1),(10272,'Kulasekarapatti',195,1),(10273,'Kuthukkalvalasai',195,1),(10274,'Mathalamparai',195,1),(10275,'Mela Ambur Part-1',195,1),(10276,'Mela Ambur Part-2',195,1),(10277,'Mela Kadaiyam',195,1),(10278,'Melagaram',195,1),(10279,'Melapavoor',195,1),(10280,'Minnadicheri',195,1),(10281,'Pattakuruchi',195,1),(10282,'Pattapathu',195,1),(10283,'Pulliyur',195,1),(10284,'Ravanasamudram',195,1),(10285,'Sillaraipuravu',195,1),(10286,'Sivasailam',195,1),(10287,'Sundarapandiapuram',195,1),(10288,'Tenkasi',195,1),(10289,'Therkku Kadaiyam',195,1),(10290,'Therkku Madathur',195,1),(10291,'Thippanampatti',195,1),(10292,'Thiruchitrambalam',195,1),(10293,'Vadakku Pappankulam',195,1),(10294,'Veerasamudram',195,1),(10295,'A.Kariselkulam',196,1),(10296,'A.Mathurapuri',196,1),(10297,'Athippatti',196,1),(10298,'Azagapuri',196,1),(10299,'Chandirangondan',196,1),(10300,'Chathirapatti',196,1),(10301,'Chavelkulam',196,1),(10302,'Chettikulam',196,1),(10303,'K.Alangulam',196,1),(10304,'K.Karisalkulam',196,1),(10305,'Kalappalangulam',196,1),(10306,'Kalingapatti Part-1',196,1),(10307,'Kalingapatti Part-2',196,1),(10308,'Karisathan',196,1),(10309,'Kulakkattakurichi',196,1),(10310,'Kulasekarapperi',196,1),(10311,'Kurinchakulam',196,1),(10312,'Mahendravadi',196,1),(10313,'Maipparai',196,1),(10314,'Malaiyan Kulam',196,1),(10315,'Maruthan Ginaru',196,1),(10316,'Mathurapuri',196,1),(10317,'Naduvappatti',196,1),(10318,'Nalanthula',196,1),(10319,'Naluvasan Kottai',196,1),(10320,'Pazhakottai',196,1),(10321,'Perungkottur',196,1),(10322,'Ramalinga Puram',196,1),(10323,'Rengasamudram',196,1),(10324,'Sangupatti',196,1),(10325,'Sayamalai Part-1',196,1),(10326,'Sayamalai Part-2',196,1),(10327,'Subbaiah Puram',196,1),(10328,'Sundaresapuram',196,1),(10329,'Therku Kuruvikulam',196,1),(10330,'Thiruvengadam',196,1),(10331,'Usilangulam',196,1),(10332,'Vadakku Kuruvikulam',196,1),(10333,'Vagaikulam',196,1),(10334,'Varaganoor',196,1),(10335,'Vellakulam',196,1),(10336,'Achankuttam',197,1),(10337,'Agaram',197,1),(10338,'Anaikulam',197,1),(10339,'Balapathiraramapuram',197,1),(10340,'Karuvantha',197,1),(10341,'Keelakalangal',197,1),(10342,'Kulayaneri',197,1),(10343,'Kurichanpatti',197,1),(10344,'Marukkalankulam',197,1),(10345,'Melakalangal',197,1),(10346,'Melamarudappapuram',197,1),(10347,'Muthammalpuram',197,1),(10348,'Navaneethakrishnapuram',197,1),(10349,'Rajagopalaperi',197,1),(10350,'Sivagurunathapuram',197,1),(10351,'Surandai Part-I',197,1),(10352,'Surandai Part-Ii',197,1),(10353,'Uthumalai',197,1),(10354,'Vadakkukavalakurichi',197,1),(10355,'Vadi',197,1),(10356,'Veerakeralampudur',197,1),(10357,'Veeranam',197,1),(10358,'Vellakal',197,1),(10359,'Zamin Surandai',197,1),(10360,'Aavarampatti',198,1),(10361,'Achampatti',198,1),(10362,'Adanjur',198,1),(10363,'Agarappettai',198,1),(10364,'Alamelupuram',198,1),(10365,'Ammaiyagaram',198,1),(10366,'Arcod',198,1),(10367,'Budalur',198,1),(10368,'Budarayanallur',198,1),(10369,'Chellappanpettai',198,1),(10370,'Chithirakkudi',198,1),(10371,'Chithirakkudi Addl.',198,1),(10372,'Chozhakampatti',198,1),(10373,'Deetcha Samuthiram',198,1),(10374,'Indalur',198,1),(10375,'Kadambankudi',198,1),(10376,'Kalumangalam',198,1),(10377,'Kandamangalam',198,1),(10378,'Kankeyampatti',198,1),(10379,'Katchamangalam',198,1),(10380,'Koothur',198,1),(10381,'Kottrapatti',198,1),(10382,'Koviladi',198,1),(10383,'Kovilpathu',198,1),(10384,'Mahadevapuram',198,1),(10385,'Manaiyeripatti',198,1),(10386,'Maraneri',198,1),(10387,'Maruthakkudi',198,1),(10388,'Megalathur',198,1),(10389,'Michelpatti',198,1),(10390,'Muthuveerakandiyanpatti',198,1),(10391,'Nandavanapatti',198,1),(10392,'Nathamangalam',198,1),(10393,'Nemam',198,1),(10394,'Onpathuveli',198,1),(10395,'Orathur',198,1),(10396,'Palaiyapatti North',198,1),(10397,'Palaiyapatti South',198,1),(10398,'Palayivayal',198,1),(10399,'Pathirakkudi',198,1),(10400,'Pavanamangalam',198,1),(10401,'Pazhamaneri',198,1),(10402,'Pudukkudi Thenpathi',198,1),(10403,'Pudukkudi Vadapathi',198,1),(10404,'Pudupatti',198,1),(10405,'Rajagiri',198,1),(10406,'Rayamundanpatti',198,1),(10407,'Rayanthur',198,1),(10408,'Renganathapuram',198,1),(10409,'Sanurapatti',198,1),(10410,'Sengipatti',198,1),(10411,'Sorakkudipatti',198,1),(10412,'Thiruchanampoondi',198,1),(10413,'Thirukkattupalli',198,1),(10414,'Thogur',198,1),(10415,'Thondarayanpadi',198,1),(10416,'Unjini',198,1),(10417,'Vanarankudi',198,1),(10418,'Veeramarasanpettai',198,1),(10419,'Vendayampatti',198,1),(10420,'Venkata Samuthiram 1St Sethi',198,1),(10421,'Vinnamangalam',198,1),(10422,'Vishnampettai',198,1),(10423,'Vittalapuram',198,1),(10424,'Aandalur',199,1),(10425,'Aariyapadaiveedu',199,1),(10426,'Agarathur',199,1),(10427,'Agrakaram Perumandi',199,1),(10428,'அம்மாச்சத்திரம்',199,1),(10429,'Ammankudi',199,1),(10430,'Ammath Thottam',199,1),(10431,'Anakkudi Thirunageswaram',199,1),(10432,'Andakkudi Thottam',199,1),(10433,'Annalakrakaram',199,1),(10434,'Asur',199,1),(10435,'Athiyur',199,1),(10436,'Baburajapuram',199,1),(10437,'Channapuram Minor Inam',199,1),(10438,'Chidambaranatha Mudali Thottam',199,1),(10439,'Chozhanmaligai',199,1),(10440,'Chozhapuram',199,1),(10441,'Denampadugai',199,1),(10442,'Denampadugai Thattimal',199,1),(10443,'Devanancheri',199,1),(10444,'Dharasuram',199,1),(10445,'Enanallur',199,1),(10446,'Erakaram',199,1),(10447,'Erandamkattalai',199,1),(10448,'Govilacheri',199,1),(10449,'Ilanthurai (Vittalur)',199,1),(10450,'Inam Asur',199,1),(10451,'Injikkollai',199,1),(10452,'Innambur',199,1),(10453,'Kadichampadi',199,1),(10454,'Kallapuliyur',199,1),(10455,'Kallur',199,1),(10456,'Karanattukaruppur 2',199,1),(10457,'Karuppur',199,1),(10458,'Katchukattu',199,1),(10459,'Kavalai Thottam',199,1),(10460,'Kavaraithottam',199,1),(10461,'Keeranur',199,1),(10462,'Kezhakorkkai',199,1),(10463,'Kodiyan Thottam',199,1),(10464,'Koranattukaruppur 1',199,1),(10465,'Kothankudi',199,1),(10466,'Kothankudi Thattimal',199,1),(10467,'Kottaiyur Munish',199,1),(10468,'Kovanur',199,1),(10469,'Krishnapuram',199,1),(10470,'Kukur',199,1),(10471,'Kumaramangalam',199,1),(10472,'Kumarankudi',199,1),(10473,'Kumbakonam (Pattanam)',199,1),(10474,'Malaiyappa Nallur (281)',199,1),(10475,'Malaiyappa Nallur (474)',199,1),(10476,'Mallapuram',199,1),(10477,'Mankudi',199,1),(10478,'Maruthakudi',199,1),(10479,'Maruthanallur',199,1),(10480,'Mathavapuram',199,1),(10481,'Mathi',199,1),(10482,'Mathur',199,1),(10483,'Mela Cauvery',199,1),(10484,'Melakorkkai',199,1),(10485,'Miruthiyanchapadai Veedu',199,1),(10486,'Mugasa Innambur Thenpathi',199,1),(10487,'Muppakovil',199,1),(10488,'Nachiyar Thottam',199,1),(10489,'Nachiyarkovil',199,1),(10490,'Nagakudi',199,1),(10491,'Nagarasampettai',199,1),(10492,'Neerathanallur',199,1),(10493,'Paangal',199,1),(10494,'Palaiyanallur',199,1),(10495,'Pandaravadai Perumandi',199,1),(10496,'Paruthicheri',199,1),(10497,'Pateeswaram Padugai',199,1),(10498,'Patteeswaram Thirugnana',199,1),(10499,'Pazhavatankattalai',199,1),(10500,'Perappadi',199,1),(10501,'Perumandi',199,1),(10502,'Poundaregapuram',199,1),(10503,'Pudu Thivan Vada Thottam',199,1),(10504,'Puthakaram',199,1),(10505,'Rajan Thottam',199,1),(10506,'Sakkottai',199,1),(10507,'Sannapuram',199,1),(10508,'Sarankapanipettai',199,1),(10509,'Seenivasanallur',199,1),(10510,'Seeran Kattalai',199,1),(10511,'Sembiyavarambal',199,1),(10512,'Semmankudi',199,1),(10513,'Seshampadi',199,1),(10514,'Sivapuram Bit 1',199,1),(10515,'Sundaraperumal Kovil North',199,1),(10516,'Sundaraperumalkovil South',199,1),(10517,'Swamimalai',199,1),(10518,'Thandalam',199,1),(10519,'Thandanthottam',199,1),(10520,'The. Kothankudi',199,1),(10521,'Thillaiyambur',199,1),(10522,'Thimmakkudi (Baburajapuram)',199,1),(10523,'Thippirajapuram',199,1),(10524,'Thirivalansuli Thattimal',199,1),(10525,'Thirucherai',199,1),(10526,'Thirumeignanam',199,1),(10527,'Thirunallur',199,1),(10528,'Thirunaraiyur',199,1),(10529,'Thirupirambiyam',199,1),(10530,'Thiruppanthurai',199,1),(10531,'Thiruvalasuli',199,1),(10532,'Thukkatchi',199,1),(10533,'Udaiyalur',199,1),(10534,'Ullur',199,1),(10535,'Uthamathani',199,1),(10536,'Valaiyapettai',199,1),(10537,'Valapuram',199,1),(10538,'Vanduvancheri',199,1),(10539,'Vaniyankarambai Thirugnana',199,1),(10540,'Varvankkarai',199,1),(10541,'Velankudi',199,1),(10542,'Vellapillayampettai',199,1),(10543,'Vilankudi',199,1),(10544,'Vilanthakandam',199,1),(10545,'Villiyavarambal',199,1),(10546,'Visalur',199,1),(10547,'Vittalur',199,1),(10548,'Aambalapattu Gopalapuram',200,1),(10549,'Aambalapattu North',200,1),(10550,'Aambalapattu Ramapuram',200,1),(10551,'Akkaraivattam',200,1),(10552,'Alivoikkal',200,1),(10553,'Ambalapattu South',200,1),(10554,'Ambalapattu South',200,1),(10555,'Ammankudi',200,1),(10556,'Arasapattu',200,1),(10557,'Arumulai',200,1),(10558,'Athanakkottai',200,1),(10559,'Avidanalla Vijayapuram',200,1),(10560,'Ayangudi',200,1),(10561,'Balangandar Gudikadu',200,1),(10562,'Chenniyaviduthi',200,1),(10563,'Chenniyaviduthi (Krishnapuram)',200,1),(10564,'Chinna Ammankudi',200,1),(10565,'Chinna Ponnappur',200,1),(10566,'Chozhakankudikadu',200,1),(10567,'Chozhapuram',200,1),(10568,'Eachankottai',200,1),(10569,'Illuppaividuthi',200,1),(10570,'Kaavaarappattu',200,1),(10571,'Kaduvettividuthi',200,1),(10572,'Kakkarai',200,1),(10573,'Kakkaraikkottai',200,1),(10574,'Kannanthankudi Keelaiyur Addl.',200,1),(10575,'Kannanthankudi Melaiyur Addl.',200,1),(10576,'Kannthankudi Keelaiyur Chief',200,1),(10577,'Kannthankudi Melaiyur Chief',200,1),(10578,'Kannukkudi Keelpathi',200,1),(10579,'Kannukkudi Melpathi Addl.',200,1),(10580,'Kannukkudi Melpathi Chief',200,1),(10581,'Karaimendarkottai',200,1),(10582,'Karukadipatti',200,1),(10583,'Karukkakottai',200,1),(10584,'Kattukuruchi',200,1),(10585,'Kavalipatti',200,1),(10586,'Keela Ulur',200,1),(10587,'Keela Ulur Paruthiyapparkoil',200,1),(10588,'Keezhavannipattu',200,1),(10589,'Kilamangalam',200,1),(10590,'Kodiyalam',200,1),(10591,'Kovilur',200,1),(10592,'Krishnapuram',200,1),(10593,'Kulamangalam',200,1),(10594,'Mandalakkottai',200,1),(10595,'Medayakkollai',200,1),(10596,'Mullurpattikkadu',200,1),(10597,'Muruthiyambalpuram',200,1),(10598,'Muthambalpuram',200,1),(10599,'Naduvur',200,1),(10600,'Neivasal Thenpathi',200,1),(10601,'Neiveli Thenpathi',200,1),(10602,'Neiveli Vadapathi',200,1),(10603,'Nemali Thippiyakkudi',200,1),(10604,'Okkanadu Keelaiyur Addl.',200,1),(10605,'Okkanadu Keelaiyur Chief',200,1),(10606,'Okkanadu Melaiyur',200,1),(10607,'Pachur',200,1),(10608,'Palamputhur',200,1),(10609,'Panayakkottai',200,1),(10610,'Panchanathikottai',200,1),(10611,'Pandipazhamanaikkadu',200,1),(10612,'Panikondanviduthi',200,1),(10613,'Paravathur',200,1),(10614,'Paruthikkottai',200,1),(10615,'Paruthiyapparkovil',200,1),(10616,'Peikkarumban Kottai',200,1),(10617,'Periya Ammankudi',200,1),(10618,'Periyakottaikadu',200,1),(10619,'Pinnaiyur East',200,1),(10620,'Pinnaiyur West',200,1),(10621,'Poiyundarkottai',200,1),(10622,'Poiyundarkudikadu',200,1),(10623,'Ponnappur Keelpathi',200,1),(10624,'Ponnappur Melpathi',200,1),(10625,'Poovathur',200,1),(10626,'Poovathur Pudunagar',200,1),(10627,'Pugalsillathur',200,1),(10628,'Pulavankadu',200,1),(10629,'Puthur',200,1),(10630,'Ragavambalpuram',200,1),(10631,'Sadaiyarkoil',200,1),(10632,'Samayankudikadu',200,1),(10633,'Samipatti',200,1),(10634,'Sankaranarkudikadu',200,1),(10635,'Sethurayankudikadu',200,1),(10636,'Sillathur',200,1),(10637,'Sooriyamurthipuram',200,1),(10638,'Thalaiyamangalam',200,1),(10639,'Thalikaividuthi',200,1),(10640,'Thekkur',200,1),(10641,'Thelunkankudikadu',200,1),(10642,'Thennamanadu North',200,1),(10643,'Thennamanadu South',200,1),(10644,'Therkkukottai',200,1),(10645,'Thippanviduthi',200,1),(10646,'Thirunallur',200,1),(10647,'Thondarampattu East',200,1),(10648,'Thondarampattu West',200,1),(10649,'Thoppuviduthi',200,1),(10650,'Tirumangalakkottai Keelaiyur',200,1),(10651,'Tirumangalakkottai Melaiyur',200,1),(10652,'Tirumangalakottai K.Colony',200,1),(10653,'Tirumangalakottai M.Colony',200,1),(10654,'Ulur East',200,1),(10655,'Ulur West',200,1),(10656,'Unchiyaviduthi',200,1),(10657,'Uranipuram',200,1),(10658,'Vadakkukottai',200,1),(10659,'Vadakkukottai',200,1),(10660,'Vadakkur Therkku Sethi',200,1),(10661,'Vadakkur Vadakku Sethi',200,1),(10662,'Vadaseri North',200,1),(10663,'Vadaseri South',200,1),(10664,'Vandaiyar Irruppu',200,1),(10665,'Veda Vijayapuram',200,1),(10666,'Vedanayakipuram',200,1),(10667,'Vellur',200,1),(10668,'Venkarai Part',200,1),(10669,'Vettikadu',200,1),(10670,'Vettuvakkottai',200,1),(10671,'Yokanayakipuram',200,1),(10672,'Aalankudi',201,1),(10673,'Aalankudi Bit',201,1),(10674,'Aathur Thottam',201,1),(10675,'Akaramangudi',201,1),(10676,'Alavanthipuram',201,1),(10677,'Annappanpettai',201,1),(10678,'Araiyapuram',201,1),(10679,'Araiyapuram Thatimalpadukai',201,1),(10680,'Arulmozhipettai',201,1),(10681,'Arunthavapuram - 1',201,1),(10682,'Arunthavapuram - 2',201,1),(10683,'Athanur',201,1),(10684,'Ayyampettai',201,1),(10685,'Bavaniyambalpuram',201,1),(10686,'Chakkarapalli - Bit',201,1),(10687,'Deebambalpuram',201,1),(10688,'Devarayanpettai',201,1),(10689,'Eachankudi',201,1),(10690,'Edakkudi',201,1),(10691,'Edavakkudi',201,1),(10692,'Ganapathi Agrakaram - 1',201,1),(10693,'Ganapathi Agrakaram - 2',201,1),(10694,'Gopurajapuram',201,1),(10695,'Govindanattucheri',201,1),(10696,'Idaiyirruppu',201,1),(10697,'Illuppakkorai',201,1),(10698,'Illuppakkorai Bit',201,1),(10699,'Jambugapuram',201,1),(10700,'Jambukambalpuram - 1',201,1),(10701,'Jambukambalpuram - 2',201,1),(10702,'Kabisthalam',201,1),(10703,'Kalancheri',201,1),(10704,'Kambayanatham',201,1),(10705,'Kanthaavanam',201,1),(10706,'Karamudukku Thattimal Padugai',201,1),(10707,'Karuppur Padukai',201,1),(10708,'Kathirinatham',201,1),(10709,'Katturkurichi',201,1),(10710,'Kavalur',201,1),(10711,'Keezhakovilpathu',201,1),(10712,'Konthakai',201,1),(10713,'Koonancheri',201,1),(10714,'Kothankudi',201,1),(10715,'Kumilakkudi',201,1),(10716,'Mahimalai',201,1),(10717,'Mahimalai Bit',201,1),(10718,'Manojiappachavadi',201,1),(10719,'Maruthuvakkudi',201,1),(10720,'Mela Kabisthalam',201,1),(10721,'Melakalakkudi',201,1),(10722,'Melasemmankudi',201,1),(10723,'Milattur 1St Sethi',201,1),(10724,'Milattur 4Th Sethi',201,1),(10725,'Milattur 5Th Sethi',201,1),(10726,'Millatur 2Nd Sethi',201,1),(10727,'Millatur 3Rd Sethi',201,1),(10728,'Nadupadugai',201,1),(10729,'Nalla Vanniyan Kudikkadu',201,1),(10730,'Narasingapuram',201,1),(10731,'Neduvasal',201,1),(10732,'Neikkunnam',201,1),(10733,'Neithalur',201,1),(10734,'Nellithoppu',201,1),(10735,'Olaipadi',201,1),(10736,'Onpathuveli',201,1),(10737,'Palliyur',201,1),(10738,'Pandaravaadai',201,1),(10739,'Papanasam',201,1),(10740,'Pasupathikoil 1',201,1),(10741,'Pasupathikovil - 2',201,1),(10742,'Perumakkanallur',201,1),(10743,'Perumalkovil',201,1),(10744,'Ponmeinthanallur',201,1),(10745,'Poondi - 1',201,1),(10746,'Poondi - 2',201,1),(10747,'Porakkudi',201,1),(10748,'Pugazhl Kulichappattu',201,1),(10749,'Pulavarnatham',201,1),(10750,'Pulimangalam',201,1),(10751,'Puliyakkudi - 1',201,1),(10752,'Puliyakkudi - 2',201,1),(10753,'Puthur',201,1),(10754,'Rajagiri',201,1),(10755,'Ramanunjapuram',201,1),(10756,'Raramuthirakkottai',201,1),(10757,'Regunathapuram',201,1),(10758,'Saliyamangalam',201,1),(10759,'Sarukkai',201,1),(10760,'Sathiyamangalam',201,1),(10761,'Serbojirajapuram',201,1),(10762,'Serumakkanallur',201,1),(10763,'Sooliyakottai - Kambarnatham',201,1),(10764,'Sulamangalam 1St Sethi',201,1),(10765,'Sulamangalam 2Nd Sethi',201,1),(10766,'Sulamangalam 2Nd Sethi Bit',201,1),(10767,'Suraikkayur',201,1),(10768,'Thalaivaipalayam',201,1),(10769,'Thiayagasamuthiram',201,1),(10770,'Thirukkarukavur',201,1),(10771,'Thirumandankudi',201,1),(10772,'Thirupallathurai',201,1),(10773,'Thirupuvanam',201,1),(10774,'Thiruvaikavur',201,1),(10775,'Thiruvaiyathukkudi',201,1),(10776,'Thurumbur',201,1),(10777,'Ukkadai',201,1),(10778,'Ullikkadai',201,1),(10779,'Umaiyalpuram - 2',201,1),(10780,'Umayalpuram - 1',201,1),(10781,'Umbalapadi',201,1),(10782,'Utharamangalam',201,1),(10783,'Utharamangalam Thottam',201,1),(10784,'Vadakkumangudi',201,1),(10785,'Vadapathi',201,1),(10786,'Vaiyacheri',201,1),(10787,'Valuthur',201,1),(10788,'Veeramankudi',201,1),(10789,'Vembukkudi',201,1),(10790,'Vennukkudi Thottam',201,1),(10791,'Viluthiyur',201,1),(10792,'Aaladikkadu',202,1),(10793,'Aaladikkumulai',202,1),(10794,'Aalampallam',202,1),(10795,'Aalathur',202,1),(10796,'Aandikkadu',202,1),(10797,'Aathikkottai',202,1),(10798,'Aavikkottai',202,1),(10799,'Adirampattinam',202,1),(10800,'Alamathikkadu',202,1),(10801,'Alivalam',202,1),(10802,'Anaikkadu',202,1),(10803,'Ananthagopalapuram North',202,1),(10804,'Ananthagopalapuram South',202,1),(10805,'Anantheeswarapuram',202,1),(10806,'Andami',202,1),(10807,'Athambai North',202,1),(10808,'Athambai South',202,1),(10809,'Athivetti East',202,1),(10810,'Athivetti West',202,1),(10811,'Azhakiya Nayakipuram',202,1),(10812,'Bainkattuvayal',202,1),(10813,'Balamuthi',202,1),(10814,'Balayee Akraharam',202,1),(10815,'Balojiragurama Samuthiram',202,1),(10816,'Bavajikkottai',202,1),(10817,'Chathiram Thokkalikadu',202,1),(10818,'Chinna Avudaiyar Koil',202,1),(10819,'Chokkanathapuram',202,1),(10820,'Chokkanavur',202,1),(10821,'Elankadu',202,1),(10822,'Eluthanivayal',202,1),(10823,'Enathi',202,1),(10824,'Ennanivayal',202,1),(10825,'Eripurakkarai',202,1),(10826,'Ettivayal',202,1),(10827,'Ettupulikkadu',202,1),(10828,'Gopalasamuthiram',202,1),(10829,'Idaiyathi North',202,1),(10830,'Idaiyathi South',202,1),(10831,'Kaarappankadu',202,1),(10832,'Kadanthankudi',202,1),(10833,'Kailasanathapuram',202,1),(10834,'Kalathur East',202,1),(10835,'Kalathur West',202,1),(10836,'Kalichankottai',202,1),(10837,'Kallivayal',202,1),(10838,'Kalyana Odai',202,1),(10839,'Kamukapulikkadu',202,1),(10840,'Kanniyakurichi',202,1),(10841,'Karambiam',202,1),(10842,'Karisaivayal',202,1),(10843,'Karkavayal',202,1),(10844,'Karuppur',202,1),(10845,'Kasankadu',202,1),(10846,'Kattayankadu',202,1),(10847,'Kattayankadu Ukkadai',202,1),(10848,'Kayavur',202,1),(10849,'Keelakurichi East',202,1),(10850,'Keelakurichi West',202,1),(10851,'Kollukkadu',202,1),(10852,'Kollukkadu',202,1),(10853,'Kondikulam',202,1),(10854,'Krishnapuram',202,1),(10855,'Krishnapuram',202,1),(10856,'Kurichi',202,1),(10857,'Kuthadivayal',202,1),(10858,'Madathikkadu',202,1),(10859,'Madukkur North',202,1),(10860,'Madukkur South',202,1),(10861,'Mahadevapuram',202,1),(10862,'Maharajapuram Samuthiram',202,1),(10863,'Mahizhankottai',202,1),(10864,'Manavayal',202,1),(10865,'Mannankadu',202,1),(10866,'Maravanvayal',202,1),(10867,'Maruthangavayal',202,1),(10868,'Mathanpattavur',202,1),(10869,'Maturabashanipuram',202,1),(10870,'Mohur',202,1),(10871,'Moothakuruchi',202,1),(10872,'Musiri',202,1),(10873,'Muthalseri',202,1),(10874,'Nadiyammalpuram',202,1),(10875,'Naduvikkottai',202,1),(10876,'Naduvikurichi',202,1),(10877,'Nainankulam',202,1),(10878,'Nambivayal',202,1),(10879,'Narasingapuram',202,1),(10880,'Nattusaalai',202,1),(10881,'Neiva Vaduthi',202,1),(10882,'Nemeli',202,1),(10883,'Olaiyakkunnam',202,1),(10884,'Ottankadu',202,1),(10885,'Ottankadu Ukkadai',202,1),(10886,'Paalathali',202,1),(10887,'Pallathur',202,1),(10888,'Pallikondan',202,1),(10889,'Palliyodaivayal',202,1),(10890,'Pannavayal',202,1),(10891,'Pappaveli Palayakottai',202,1),(10892,'Parakkalakottai',202,1),(10893,'Parasuramanenthal',202,1),(10894,'Pathirankottai North',202,1),(10895,'Pathirankottai South',202,1),(10896,'Pattukkottai',202,1),(10897,'Pazhanjur',202,1),(10898,'Pazhaverikkadu',202,1),(10899,'Periyakkottai',202,1),(10900,'Pillankuzhi',202,1),(10901,'Ponnankundu',202,1),(10902,'Ponnavarayankottai',202,1),(10903,'Ponnavarayankottai Ukkadai',202,1),(10904,'Poovaanam',202,1),(10905,'Poovalur',202,1),(10906,'Pudukkottai Ullur',202,1),(10907,'Pudukkottakam',202,1),(10908,'Pudupattinam',202,1),(10909,'Pukkarambai',202,1),(10910,'Pulavanchi',202,1),(10911,'Puliyakkudi',202,1),(10912,'Punavasal East',202,1),(10913,'Punavasal West',202,1),(10914,'Puthirivayal',202,1),(10915,'Rajamadam',202,1),(10916,'Ramambalpuram',202,1),(10917,'Reghunathapuram',202,1),(10918,'Reguramasamutiram',202,1),(10919,'Rendampulikkadu',202,1),(10920,'Renkojiyappa Thottam',202,1),(10921,'Santhankadu',202,1),(10922,'Sarabendirarajan Pattinam',202,1),(10923,'Sembalur',202,1),(10924,'Sentaakkottai',202,1),(10925,'Sentankkadu Bit 1',202,1),(10926,'Sentankkadu Bit 2',202,1),(10927,'Seruvaviduthi North',202,1),(10928,'Seruvaviduthi South',202,1),(10929,'Siramelkudi',202,1),(10930,'Sowntharanayaki Puram',202,1),(10931,'Sowntiranayakipuram',202,1),(10932,'Sukkirampatti',202,1),(10933,'Sundaram',202,1),(10934,'Surapallam',202,1),(10935,'Suriyanarayanapuram',202,1),(10936,'Thalikkottai',202,1),(10937,'Thamarankottai North',202,1),(10938,'Thamarankottai South',202,1),(10939,'Thambikkottai Maravakkadu',202,1),(10940,'Thambikkottai Melakkadu',202,1),(10941,'Thambikkottai Vadakadu',202,1),(10942,'Thandamaraikkadu',202,1),(10943,'Thiruchitrambalam East',202,1),(10944,'Thiruchitrambalam West',202,1),(10945,'Thittakkudi',202,1),(10946,'Thokkalikadu',202,1),(10947,'Thuravikkadu',202,1),(10948,'Thurvarankurichi North',202,1),(10949,'Thurvarankurichi South',202,1),(10950,'Thuvaramadai',202,1),(10951,'Uthayamudaiyan',202,1),(10952,'Vadiyakkadu',202,1),(10953,'Vadukan Kuthakai',202,1),(10954,'Valuthalai Vattam',202,1),(10955,'Vattakkudi',202,1),(10956,'Vattakkudi Ukkadai',202,1),(10957,'Vattathikottai Kollukkadu',202,1),(10958,'Vattathikottai Ukkadai B.Puram',202,1),(10959,'Veerakurichi',202,1),(10960,'Velivayal',202,1),(10961,'Vendakkottai',202,1),(10962,'Veppankadu',202,1),(10963,'Veppankadu Ukkadai',202,1),(10964,'Veppankulam',202,1),(10965,'Vikramam',202,1),(10966,'Yeralivayal',202,1),(10967,'ஆத்தாளூர்',203,1),(10968,'ஆதனூர்',203,1),(10969,'ஆவணம்',203,1),(10970,'ஆவிடையாணிக்கோட்டை',203,1),(10971,'அடைக்கத்தேவன்',203,1),(10972,'அம்மையாண்டி',203,1),(10973,'அரசலங்கரம்பை',203,1),(10974,'அரியக்குட்டித்தேவன்',203,1),(10975,'பைங்காலுக்கடை',203,1),(10976,'செட்டிவயல்',203,1),(10977,'சின்ன அரசலங்கரம்பை',203,1),(10978,'ஏனாதிக்கரம்பை',203,1),(10979,'கெங்காதரபுரம்',203,1),(10980,'காலகம் -1',203,1),(10981,'கைவினிவயல்',203,1),(10982,'காலகம் -2',203,1),(10983,'கல்லூரணிக்காடு',203,1),(10984,'Kalyanaramanathapuram',203,1),(10985,'Karambakkadu',203,1),(10986,'Kazhanivasal',203,1),(10987,'Kodivayal',203,1),(10988,'Kolakkudi',203,1),(10989,'Korattur',203,1),(10990,'Korattur Ukkadai',203,1),(10991,'Kottaikkadu',203,1),(10992,'Kuppathevan',203,1),(10993,'Kuruvikkarambai - 1',203,1),(10994,'Kuruvikkarambai - 2',203,1),(10995,'Lakshminarasimma Puram',203,1),(10996,'Maavadukurichi West',203,1),(10997,'Manakkadu',203,1),(10998,'Marakavalasai',203,1),(10999,'Maravanvayal',203,1),(11000,'Marungapallam',203,1),(11001,'Mavadukurichi East',203,1),(11002,'Mudapulikkadu - 2 Bit',203,1),(11003,'Mudapulikkadu 1 Bit',203,1),(11004,'Mudukadu',203,1),(11005,'Nadiam',203,1),(11006,'Nattanikkottai',203,1),(11007,'Nayakathivayal',203,1),(11008,'Nelliyadikkadu',203,1),(11009,'Padapanarvayl',203,1),(11010,'Palacherikkadu',203,1),(11011,'Palaiyanagaram',203,1),(11012,'Panancheri',203,1),(11013,'Panankulam',203,1),(11014,'Panchanathipuram',203,1),(11015,'Pattankkadu',203,1),(11016,'Peravurani - 1',203,1),(11017,'Peravurani - 2',203,1),(11018,'Periyakathikkottai',203,1),(11019,'Periyanayakipuram',203,1),(11020,'Perumagalur Vadapati',203,1),(11021,'Perumakalur Thenpathi',203,1),(11022,'Pethanatchivayal',203,1),(11023,'Pinnavasal',203,1),(11024,'Poolankollai',203,1),(11025,'Poonaikuthikkadu',203,1),(11026,'Pulichankadu',203,1),(11027,'Ravuthanvayal',203,1),(11028,'Regunathapuram',203,1),(11029,'Regunayakipuram',203,1),(11030,'Renganayakipuram',203,1),(11031,'Rettaivayal Ukkadai',203,1),(11032,'Rettavayal',203,1),(11033,'Ruthirachinthamani',203,1),(11034,'Saanthampettai',203,1),(11035,'Sanakkarai',203,1),(11036,'Sengamangalam',203,1),(11037,'Senthalaivayal',203,1),(11038,'Serupalakkadu',203,1),(11039,'Sethubavachathiram',203,1),(11040,'Sithathikkadu',203,1),(11041,'Solaikkadu',203,1),(11042,'Sornakkadu',203,1),(11043,'Thennankudi',203,1),(11044,'Thiruvatheva',203,1),(11045,'Thonthupulikkadu',203,1),(11046,'Thuraiyur',203,1),(11047,'Thurankudi',203,1),(11048,'Valapiramankadu',203,1),(11049,'Valayanvayal',203,1),(11050,'Vathalaikkadu',203,1),(11051,'Veerakkudi',203,1),(11052,'Veeriyankottai Part - 1',203,1),(11053,'Veeriyankottai Part - 2',203,1),(11054,'Vilankulam',203,1),(11055,'Villunivayal',203,1),(11056,'Vumathanadu',203,1),(11059,'Avusahib Thottam',204,1),(11060,'Chakkarasamantham',320,1),(11061,'Chatram Nedar',204,1),(11062,'Chennampatti',320,1),(11063,'Inathukanpatti',204,1),(11064,'Kadakadabai',204,1),(11065,'Kadakadappai Thottam',204,1),(11066,'Kalvirayanpettai',320,1),(11067,'Kandithampattu',204,1),(11068,'Kanjanayakkan Thottam',204,1),(11069,'Karunthattankudi',204,1),(11070,'Kasanadu Pudur',204,1),(11071,'Kattur',204,1),(11072,'Keeraikollai',320,1),(11073,'Kollankarai',204,1),(11074,'Kollankarai Vallundanpattu',204,1),(11075,'Kondavattanthidal',320,1),(11076,'Kudalur',204,1),(11077,'Kulichappattu',204,1),(11078,'Kurungalur',204,1),(11079,'Kurunkulam East',204,1),(11080,'Kurunkulam West',204,1),(11081,'Kuruvadipatti',204,1),(11082,'MadikaI',204,1),(11083,'Manankorai',204,1),(11084,'Marunkulam',320,1),(11085,'Mathur',204,1),(11086,'Mela Chitharkadu',320,1),(11087,'Melaveli Thottam',320,1),(11088,'Nallicheri',204,1),(11089,'Nanchikkottai',320,1),(11090,'Nanchikkottai Vallundanpattu',320,1),(11091,'Narasikanayakapuram',204,1),(11092,'Neelagiri Therkku Thottam',204,1),(11093,'Palliyakrakaram',204,1),(11094,'Palliyeri',320,1),(11095,'Perambur 2Nd Sethi',320,1),(11096,'Perambur First Sethi',320,1),(11097,'Pillaiyarnatham',320,1),(11098,'Pillaiyarpatti',320,1),(11099,'Pinnainallur',204,1),(11100,'Pudupattinam',204,1),(11101,'Puliyanthoppu',320,1),(11102,'Ramanathapuram Addl.',320,1),(11103,'Ramanathapuram Chief',320,1),(11104,'Ramapuram',204,1),(11105,'Seeralur',320,1),(11106,'Soorakkottai',320,1),(11107,'Thandankorai',204,1),(11108,'Thirukanurpatti',204,1),(11109,'Thiruvethikudi',204,1),(11110,'Thittai',204,1),(11111,'Thottakkadu',204,1),(11112,'Tirumalaisamuthiram',320,1),(11113,'Valamirankottai',204,1),(11114,'Valampuri Unit',204,1),(11115,'Vallam North',320,1),(11116,'Vallam South',320,1),(11117,'Vallampudur',320,1),(11118,'Vannarapettai Addl.',320,1),(11119,'Vannarapettai Chief',320,1),(11120,'Velur',204,1),(11121,'Velur Govindarao Thottam',204,1),(11122,'Vennalodai',320,1),(11123,'Vilar',320,1),(11124,'Aachanur',205,1),(11125,'Allur',205,1),(11126,'Ambathumelakaram',205,1),(11127,'Arasur Chinna Avusahib Thottam',205,1),(11128,'Avikkarai',205,1),(11129,'Eswaran Kovilpathu',205,1),(11130,'Kaduveli',205,1),(11131,'Kaliyabanurajathottam',205,1),(11132,'Kalyanapuram 1St Sethi',205,1),(11133,'Kalyanapuram 2Nd Sethi',205,1),(11134,'Kandiyur',205,1),(11135,'Karukkudi',205,1),(11136,'Karuppur',205,1),(11137,'Karur',205,1),(11138,'Keelathiruppoonthuruthi',205,1),(11139,'Konerirajapuram',205,1),(11140,'Kuzhimathur',205,1),(11141,'Maharajapuram',205,1),(11142,'Manakkarambai',205,1),(11143,'Mannarsamuthiram',205,1),(11144,'Marur',205,1),(11145,'Melapunavasal',205,1),(11146,'Melathiruppoonthuruthi Addl',205,1),(11147,'Melathiruppoonthuruthi Chief',205,1),(11148,'Mugasa Kalyanapuram',205,1),(11149,'Naducauvery East',205,1),(11150,'Naducauvery West',205,1),(11151,'Nagathi',205,1),(11152,'Okkakudi (Peramur)',205,1),(11153,'Peramur',205,1),(11154,'Perumpuliyur',205,1),(11155,'Punavasal',205,1),(11156,'Rajendiram',205,1),(11157,'Rayampettai',205,1),(11158,'Sathanur',205,1),(11159,'Semmankudi',205,1),(11160,'Sengaluneer Thottam',205,1),(11161,'Sheshanarayana Thottam',205,1),(11162,'Suyampatchanallur',205,1),(11163,'Thennancheri',205,1),(11164,'Thenperambur',205,1),(11165,'Thiruchotruthurai',205,1),(11166,'Thirupazhanam',205,1),(11167,'Thiruvaiyaru East',205,1),(11168,'Thiruvaiyaru West',205,1),(11169,'Thiruvalampozhil',205,1),(11170,'Thulasenthira Maharajapuram',205,1),(11171,'Uppukatchipettai',205,1),(11172,'Vadukakkudi',205,1),(11173,'Vaithiyanathanpettai',205,1),(11174,'Valappakkudi',205,1),(11175,'Varahur',205,1),(11176,'Vellamperambur East',205,1),(11177,'Vellamperambur West',205,1),(11178,'Vilangudi Chief',205,1),(11179,'Vilankudy Addl.',205,1),(11180,'Aaralur',206,1),(11181,'Anakkudi',206,1),(11182,'Athipakkam',206,1),(11183,'Bagavathapuram (56/1)',206,1),(11184,'Bagavathapuram (62/2)',206,1),(11185,'Baskarajapuram',206,1),(11186,'Chidambaranathapuram',206,1),(11187,'Govindapuram (61/1)',206,1),(11188,'Govindapuram (64/1)',206,1),(11189,'Govindapuram (67/1)',206,1),(11190,'Irumoolai',206,1),(11191,'Kanjanur',206,1),(11192,'Kannarakkudi',206,1),(11193,'Karuppur',206,1),(11194,'Kathiramangalam',206,1),(11195,'Kattanagaram',206,1),(11196,'Kavanur',206,1),(11197,'Keelamanakkudi',206,1),(11198,'Keelasuriyamoolai',206,1),(11199,'Keezhlmanthur',206,1),(11200,'Kondasamuthiram',206,1),(11201,'Koothanur',206,1),(11202,'Kottur',206,1),(11203,'Kovilramapuram',206,1),(11204,'Kulasekaranallur',206,1),(11205,'Kunathalapadi',206,1),(11206,'Kurichi',206,1),(11207,'Maharajapuram',206,1),(11208,'Maharasapuram',206,1),(11209,'Mahathanapuram',206,1),(11210,'Manalur',206,1),(11211,'Manambadi',206,1),(11212,'Manchamalli',206,1),(11213,'Manikkudi',206,1),(11214,'Marathurai',206,1),(11215,'Maruthuvakkudi -1',206,1),(11216,'Maruthuvakkudi -2',206,1),(11217,'Mavuthiruppu',206,1),(11218,'Melaiyur',206,1),(11219,'Melakattur',206,1),(11220,'Mullankudi',206,1),(11221,'Mullukkudi',206,1),(11222,'Muthur',206,1),(11223,'Naducauvery Padukaithotta',206,1),(11224,'Narasinganpettai',206,1),(11225,'Narikkudi',206,1),(11226,'Neikuppai',206,1),(11227,'Neivasal',206,1),(11228,'Panthanallur',206,1),(11229,'Paruthikkudi',206,1),(11230,'Pattam',206,1),(11231,'Puththur',206,1),(11232,'S.Pudur',206,1),(11233,'Sarabojirasapuram',206,1),(11234,'Sathanur',206,1),(11235,'Sathanur',206,1),(11236,'Sayanapuram',206,1),(11237,'Senkanur',206,1),(11238,'Serukudi',206,1),(11239,'Sikkalnayakanpettai',206,1),(11240,'Sivapurani',206,1),(11241,'Sooriyamoolai',206,1),(11242,'Sooriyanarkovil',206,1),(11243,'T.Pandaravaadai',206,1),(11244,'Thepperumanallur',206,1),(11245,'Thirubuvanam',206,1),(11246,'Thirubuvanam Bit',206,1),(11247,'Thirukodikkaval',206,1),(11248,'Thiruloki',206,1),(11249,'Thirumangaicheri',206,1),(11250,'Thirumangalakkudi',206,1),(11251,'Thirumanthurai',206,1),(11252,'Thiruneelakkudi',206,1),(11253,'Thiruppanandal East',206,1),(11254,'Thiruppanandal West',206,1),(11255,'Thiruvelliyankudi',206,1),(11256,'Thiruvidaimaruthur',206,1),(11257,'Thiruvisanallur',206,1),(11258,'Thittaicheri',206,1),(11259,'Thukili',206,1),(11260,'Ukkarai',206,1),(11261,'Umamaheswarapuram',206,1),(11262,'Vannikkudi',206,1),(11263,'Veerakkan',206,1),(11264,'Velur',206,1),(11265,'Vepathur -1',206,1),(11266,'Veppathur -2',206,1),(11267,'Vinayakan Street',206,1),(11268,'Vishwanathapuram',206,1),(11269,'Adigaratty 1',207,1),(11270,'Athigaratty 2',207,1),(11271,'Burliar',207,1),(11272,'Conoor Town',207,1),(11273,'Coonoor Rural',207,1),(11274,'Hubathalai',207,1),(11275,'Hulical 1',207,1),(11276,'Hulical 2',207,1),(11277,'Ketti 1',207,1),(11278,'Ketti 2',207,1),(11279,'Ketti 3',207,1),(11280,'Melur 1',207,1),(11281,'Melur 2',207,1),(11282,'Melur 3',207,1),(11283,'Yedapally',207,1),(11284,'Cherumulli 1',208,1),(11285,'Cherumulli 2',208,1),(11286,'Cherumulli 2 - Ca',208,1),(11287,'Devala 1',208,1),(11288,'Devala 1 - Ca',208,1),(11289,'Devala 2',208,1),(11290,'Devala 2 - Ca',208,1),(11291,'Gudalur 1',208,1),(11292,'Gudalur 1 - Gr',208,1),(11293,'Gudalur 1- Ca',208,1),(11294,'Gudalur 2',208,1),(11295,'Gudalur 2 - Ca',208,1),(11296,'Gudalur 2 - Gr',208,1),(11297,'Mudumalai',208,1),(11298,'Nellakotta',208,1),(11299,'O Valley',208,1),(11300,'Ovalley 1',208,1),(11301,'Ovalley 2',208,1),(11302,'Padanthorai 1',208,1),(11303,'Padanthorai 1 -Ca',208,1),(11304,'Padanthorai 2',208,1),(11305,'Padanthorai 2 - Ca',208,1),(11306,'Sree Madurai',208,1),(11307,'Sree Madurai - Ca',208,1),(11308,'Aracode',209,1),(11309,'Denad-I',209,1),(11310,'Denad-Ii',209,1),(11311,'Hallimoyar',209,1),(11312,'Jackanarai',209,1),(11313,'Jagathala-I',209,1),(11314,'Jagathala-Ii',209,1),(11315,'Kadinamala',209,1),(11316,'Kallampalayam',209,1),(11317,'Kengarai 1',209,1),(11318,'Kenkarai-Ii',209,1),(11319,'Kodanad',209,1),(11320,'Kokodu',209,1),(11321,'Konavakorai -2',209,1),(11322,'Konavakorai-I',209,1),(11323,'Kotagiri -1',209,1),(11324,'Kotagiri 2',209,1),(11325,'Kotagiri 3',209,1),(11326,'Nadhuhatty-2',209,1),(11327,'Naduhatty-1',209,1),(11328,'Nandhipuram',209,1),(11329,'Nedugula-I',209,1),(11330,'Nedugula-Ii',209,1),(11331,'Balacola 2',210,1),(11332,'Balacola-1',210,1),(11333,'Bikkatty',210,1),(11334,'Ithalar 1',210,1),(11335,'Ithalar 2',210,1),(11336,'Kil Kundah 1',210,1),(11337,'Kil-Kundah 2',210,1),(11338,'Kinnakorai',210,1),(11339,'Mel-Kundah',210,1),(11340,'Mulligoor',210,1),(11341,'Cherangode1',211,1),(11342,'Cherangode-1Jenmam',211,1),(11343,'Cherangode-2',211,1),(11344,'Cherangode-2Jenmam',211,1),(11345,'Erumad 1',211,1),(11346,'Erumad-2',211,1),(11347,'Moonad-2',211,1),(11348,'Moonanad-1Jenmam',211,1),(11349,'Moonanad-2Jenmam',211,1),(11350,'Moonnad 1',211,1),(11351,'Nelliyalam 1',211,1),(11352,'Nelliyalam-1Ca',211,1),(11353,'Nelliyalam-1Janmam',211,1),(11354,'Nelliyalam-2',211,1),(11355,'Nelliyalam-2Jenman',211,1),(11356,'Ebbanad 1',212,1),(11357,'Ebbanad 2',212,1),(11358,'Hullathy',212,1),(11359,'Kadanad 1',212,1),(11360,'Kadanad 2',212,1),(11361,'Kagguchi 1',212,1),(11362,'Kagguchi 2',212,1),(11363,'Kookal',212,1),(11364,'Masinagudi',212,1),(11365,'Naduvattam',212,1),(11366,'Nanjanad2',212,1),(11367,'Nanjand1',212,1),(11368,'Sholur',212,1),(11369,'Thummanatty 1',212,1),(11370,'Thummanatty 2',212,1),(11371,'Thuneri',212,1),(11372,'Udhagai - Rural',212,1),(11373,'Udhagai Town(East)',212,1),(11374,'Udhagai Town(West)',212,1),(11375,'Andipatti Bit-2',213,1),(11376,'Andipatti Bit-I',213,1),(11377,'Balakombai',213,1),(11378,'Chittarpatti',213,1),(11379,'G.Usilampatti',213,1),(11380,'Kadamalaikundu',213,1),(11381,'Kanavaipatti',213,1),(11382,'Kothaloothu',213,1),(11383,'Kothapatti',213,1),(11384,'Kovilpatti',213,1),(11385,'Kunnur',213,1),(11386,'Marigundu',213,1),(11387,'Megamalai',213,1),(11388,'Motanoothu',213,1),(11389,'Myladumparai',213,1),(11390,'Palayakottai',213,1),(11391,'Pulimangkombai',213,1),(11392,'Rajdhani',213,1),(11393,'Ramkrishnapuram',213,1),(11394,'Sanmugasundrapuram',213,1),(11395,'Thekkampatti',213,1),(11396,'Theppampatti',213,1),(11397,'Thimmarasanayaknaur Bit-1',213,1),(11398,'Thimmarasanayanur Bit-2',213,1),(11399,'Vallalnathi',213,1),(11400,'(Bodi) North Hills',214,1),(11401,'(Bodi) West Hills',214,1),(11402,'Agamalai',214,1),(11403,'Ammapatti',214,1),(11404,'B.Meenatchipuram',214,1),(11405,'Bodi(Town)',214,1),(11406,'Boothipuram',214,1),(11407,'Dombucherry',214,1),(11408,'Kodangipatti',214,1),(11409,'Koolayanur',214,1),(11410,'Kottakudi',214,1),(11411,'Melachokkanathapuram',214,1),(11412,'Rasingapuram',214,1),(11413,'Silamalai',214,1),(11414,'Uppukottai',214,1),(11415,'A. Kamatchipuram',215,1),(11416,'Endapulli',215,1),(11417,'Genguvarpatti Bit - 1',215,1),(11418,'Genguvarpatti Bit -2',215,1),(11419,'Jeyamangalam Bit -- 1',215,1),(11420,'Jeyamangalam Bit - 2',215,1),(11421,'Keelavadagarai',215,1),(11422,'Kullappuram',215,1),(11423,'Melmangalam Bit -- 1',215,1),(11424,'Melmangalam Bit -2',215,1),(11425,'Pudukotai',215,1),(11426,'Silvarpatti',215,1),(11427,'Thamaraikulam Bit -1',215,1),(11428,'Thamaraikulam Bit -2',215,1),(11429,'Thengarai Bit-2',215,1),(11430,'Thenkarai Bit -1',215,1),(11431,'Thevathanapatti Bit -1',215,1),(11432,'Thevathanapatti Bit -2',215,1),(11433,'Vadagarai Bit -1',215,1),(11434,'Vadagarai Bit -2',215,1),(11435,'Vadaveeranaickanpatti',215,1),(11436,'Vadipatti',215,1),(11437,'Allinagaram',216,1),(11438,'Govindanagaram',216,1),(11439,'Jangalpatti',216,1),(11440,'Koduvilarpatti',216,1),(11441,'Kottur',216,1),(11442,'Poomalaikundu',216,1),(11443,'Seelayampatti',216,1),(11444,'Thadicherry',216,1),(11445,'Thappukundu',216,1),(11446,'Unjampatti',216,1),(11447,'Upparpatti',216,1),(11448,'Veerapandi',216,1),(11449,'Alagapuri',217,1),(11450,'C.Pudupatty',217,1),(11451,'Chinnamanur',217,1),(11452,'Chinnaovulapuram',217,1),(11453,'Cumbum',217,1),(11454,'Erasai-Hills',217,1),(11455,'Erasakkanayaknaur',217,1),(11456,'Hanumanthanpatti',217,1),(11457,'Kamayagoundanpatti',217,1),(11458,'Kanniservaipatti',217,1),(11459,'Karungattankulam',217,1),(11460,'Keelagudalur East',217,1),(11461,'Keelagudalur-West',217,1),(11462,'Kokilapuram',217,1),(11463,'Kombai-East',217,1),(11464,'Kombai-West',217,1),(11465,'Kutchanur',217,1),(11466,'Mallingapuram',217,1),(11467,'Markayankottai',217,1),(11468,'Melagudalur -North',217,1),(11469,'Melagudalur-South',217,1),(11470,'Muthulapuram',217,1),(11471,'N.T.Patti-Hills',217,1),(11472,'N.T.Patti-North',217,1),(11473,'N.T.Patti-South',217,1),(11474,'Odaipatti',217,1),(11475,'Pannaipuram',217,1),(11476,'Poolananthapuram',217,1),(11477,'Pottipuram',217,1),(11478,'Pulikuthi',217,1),(11479,'Royappanpatti',217,1),(11480,'Sangarapuram',217,1),(11481,'Seepalakottai',217,1),(11482,'T.Meenatchipuram',217,1),(11483,'Thevaram',217,1),(11484,'Thevaram Hills',217,1),(11485,'Uthamapalayam (South)',217,1),(11486,'Uthamapalayam-North',217,1),(11487,'Uthamapuram',217,1),(11488,'Veppampatti',217,1),(11489,'Adhikudi',218,1),(11490,'Alambadi',218,1),(11491,'Alambakkam',218,1),(11492,'Alangudi Mahajanam',218,1),(11493,'Angarai',218,1),(11494,'Appadurai',218,1),(11495,'Ariyur',218,1),(11496,'Esanakorai',218,1),(11497,'Garudamangalam(North)',218,1),(11498,'Garudamangalam(South)',218,1),(11499,'Idaiyathumangalam',218,1),(11500,'Idangimangalam',218,1),(11501,'Jengamarajapuram',218,1),(11502,'Jevanthinathapuram',218,1),(11503,'Kallagam',218,1),(11504,'Kallakudi',218,1),(11505,'Kanakiliyanallur',218,1),(11506,'Kannakudi',218,1),(11507,'Keelanbil',218,1),(11508,'Keelaperungavur',218,1),(11509,'Keelarasur',218,1),(11510,'Keeramangalam',218,1),(11511,'Komakudi',218,1),(11512,'Koohur',218,1),(11513,'Kovandakurichi',218,1),(11514,'Kumulur',218,1),(11515,'L.Abisekapuiram',218,1),(11516,'M.Kannanur',218,1),(11517,'Madakudi',218,1),(11518,'Mahilampadi',218,1),(11519,'Malvoi',218,1),(11520,'Manakkal (East)',218,1),(11521,'Manakkal(West)',218,1),(11522,'Mangammalpuram',218,1),(11523,'Maruthur',218,1),(11524,'Melarasur',218,1),(11525,'Mettupatti',218,1),(11526,'Mudhuvathur',218,1),(11527,'Mummudi Cholamangalam',218,1),(11528,'Nagar',218,1),(11529,'Nambukurichi',218,1),(11530,'Nanjai',218,1),(11531,'Nathamangudi',218,1),(11532,'Neikulam',218,1),(11533,'Neikuppai (North)',218,1),(11534,'Neikuppai (South)',218,1),(11535,'Nerunjalakkudi',218,1),(11536,'Oottathur',218,1),(11537,'Orathur',218,1),(11538,'Pambaram',218,1),(11539,'Periyakurukkai',218,1),(11540,'Peruvalanallur (East)',218,1),(11541,'Peruvalanallur(West)',218,1),(11542,'Peruvalappur',218,1),(11543,'Poovalur(East)',218,1),(11544,'Poovalur(West)',218,1),(11545,'Pudur Palayam',218,1),(11546,'Pudur Uthamanur',218,1),(11547,'Pullambadi(North)',218,1),(11548,'Pullambadi(South)',218,1),(11549,'Punjai Sangenthi',218,1),(11550,'Puthukudi',218,1),(11551,'R.Valavanoor',218,1),(11552,'Reddimangudi',218,1),(11553,'Sadhurbagam',218,1),(11554,'Saradamangalam',218,1),(11555,'Sathamangalam',218,1),(11556,'Sembarai',218,1),(11557,'Shesasamudram',218,1),(11558,'Sirudaiyur',218,1),(11559,'Sirugalappur',218,1),(11560,'Sirumaruthoor',218,1),(11561,'Sirumayangudi (East)',218,1),(11562,'Sirumayangudi [West]',218,1),(11563,'T.Kallikudi',218,1),(11564,'T.Valavanoor',218,1),(11565,'Thalakudi',218,1),(11566,'Thappai',218,1),(11567,'Thatchankurichi',218,1),(11568,'Thinniyam',218,1),(11569,'Thiranipalayam',218,1),(11570,'Thirumanamedu (East)',218,1),(11571,'Thirumanamedu (West)',218,1),(11572,'Thirumangalam',218,1),(11573,'Thiruthavathuraikattalai',218,1),(11574,'V.Thuraiyur',218,1),(11575,'Valadi',218,1),(11576,'Vandalai Koodalur',218,1),(11577,'Varakuppai',218,1),(11578,'Vellanur',218,1),(11579,'Venkatachalapuram (South)',218,1),(11580,'Venkatachalapuram(North)',218,1),(11581,'Virahalur',218,1),(11582,'Aaikudi',219,1),(11583,'Alakiyamanavalam',219,1),(11584,'Avaravalli',219,1),(11585,'Ayyampalayam',219,1),(11586,'Cholanganallur',219,1),(11587,'Deerampalayam',219,1),(11588,'Ethumalai',219,1),(11589,'Irungalur',219,1),(11590,'Kalpalayam',219,1),(11591,'Kariyamanikam',219,1),(11592,'Kariyamanikam (West)',219,1),(11593,'Kariyamanikam(East)',219,1),(11594,'Killiyanallur (North)',219,1),(11595,'Killiyanallur (South)',219,1),(11596,'Konalai',219,1),(11597,'Koothur',219,1),(11598,'Kovathakudi',219,1),(11599,'Mannachanallur',219,1),(11600,'Mathavaperumalkoil',219,1),(11601,'Melasridevimanagalam',219,1),(11602,'Melpathu',219,1),(11603,'Omanthur',219,1),(11604,'Palaiyur',219,1),(11605,'Perakambi',219,1),(11606,'Pitchandarkoil',219,1),(11607,'Poonampalayam',219,1),(11608,'Rasampalayam',219,1),(11609,'S.Kannanur (East)',219,1),(11610,'S.Kannanur(West)',219,1),(11611,'Samayapuram',219,1),(11612,'Sanamangalam',219,1),(11613,'Seedevimangalam (North)',219,1),(11614,'Seedevimangalam (South)',219,1),(11615,'Siruganur',219,1),(11616,'Sirukudi',219,1),(11617,'Sirupathur',219,1),(11618,'Thathamangalam',219,1),(11619,'Thirupattur',219,1),(11620,'Thiruppanjeeli (North)',219,1),(11621,'Thiruppanjeeli (South)',219,1),(11622,'Thirvasi',219,1),(11623,'Thriuvelarai',219,1),(11624,'Ulunthangudi',219,1),(11625,'Valaiyur',219,1),(11626,'Vazhaiyur',219,1),(11627,'Venkankudi',219,1),(11628,'Adampatty',220,1),(11629,'Amayapuram',220,1),(11630,'Aniyapur',220,1),(11631,'Chathirapatty',220,1),(11632,'Chettiapatty',220,1),(11633,'Chettichathiram',220,1),(11634,'Chithanatham',220,1),(11635,'Elamanam',220,1),(11636,'F.Kezhiur',220,1),(11637,'Inamidayapatty',220,1),(11638,'Inamkovilpatty',220,1),(11639,'Inampudur',220,1),(11640,'Inamreddiapatty',220,1),(11641,'Iyanreddiapatty',220,1),(11642,'K.Periyapatty(North)',220,1),(11643,'K.Periyapatty(South)',220,1),(11644,'Kalingapatty',220,1),(11645,'Kannudaiyanpatty',220,1),(11646,'Karuppur',220,1),(11647,'Kumaravadi',220,1),(11648,'Madhampatty',220,1),(11649,'Malayadipatty',220,1),(11650,'Mondipatty',220,1),(11651,'Mookureddiapatty',220,1),(11652,'Mugavanoor(North)',220,1),(11653,'Mugavanoor(South)',220,1),(11654,'Nadupatty',220,1),(11655,'Nallampillai',220,1),(11656,'Palayakottai',220,1),(11657,'Pannapatty (East)',220,1),(11658,'Pannapatty(West)',220,1),(11659,'Poigaipatty',220,1),(11660,'Ponnnampalampatty',220,1),(11661,'Puthanatham',220,1),(11662,'Puthukkottai',220,1),(11663,'Puthuvadi',220,1),(11664,'Sampatty',220,1),(11665,'Samuthiram',220,1),(11666,'Seegampatty',220,1),(11667,'Sekkanam',220,1),(11668,'Sevalur',220,1),(11669,'Sooliapatty',220,1),(11670,'Thavalaiveeranpatty',220,1),(11671,'Thoppampatty',220,1),(11672,'Usilampatty',220,1),(11673,'V.Periapatty',220,1),(11674,'Vadugapatty',220,1),(11675,'Vaiyampatty',220,1),(11676,'Vaiyyamalaypalayam',220,1),(11677,'Vellalapatty',220,1),(11678,'Vengaikuruchi',220,1),(11679,'Akkiampatty',221,1),(11680,'Alagapuri',221,1),(11681,'Amanakkampatty',221,1),(11682,'Ammasatram',221,1),(11683,'Ayanporuvai',221,1),(11684,'Ayanpudupatty',221,1),(11685,'Endapuli',221,1),(11686,'Ikkaraikosukuruchi',221,1),(11687,'Kalingapatty(East)',221,1),(11688,'Kalingapatty(West)',221,1),(11689,'Kanchanayakkanpatty',221,1),(11690,'Kannivadugapatty',221,1),(11691,'Kannukkuli',221,1),(11692,'Kannuthu',221,1),(11693,'Kappakudi',221,1),(11694,'Karaipatty',221,1),(11695,'Karumalai',221,1),(11696,'Kavinaripatty',221,1),(11697,'Kodumpapatty',221,1),(11698,'Lekkanayakkanpatty',221,1),(11699,'Marungapuri',221,1),(11700,'Muthalvarpatty Kadar',221,1),(11701,'Nallur',221,1),(11702,'Palakuruchi',221,1),(11703,'Paluvanchi(East)',221,1),(11704,'Paluvanchi(West)',221,1),(11705,'Pirampatti(North)',221,1),(11706,'Pirampatty(South)',221,1),(11707,'Puthakudi',221,1),(11708,'Sevalpatty',221,1),(11709,'Sevanthampatty',221,1),(11710,'T.Iddayapatty',221,1),(11711,'Thathanoor',221,1),(11712,'Thenur',221,1),(11713,'Thettur',221,1),(11714,'Thirunellipatty',221,1),(11715,'Thottiapatty',221,1),(11716,'Thuvarankuruchi',221,1),(11717,'Uthukkuli',221,1),(11718,'Valanadu',221,1),(11719,'Vellakuruchi',221,1),(11720,'Vellayakonepatty',221,1),(11721,'Vembanoor',221,1),(11722,'Venkatnayakkanpatty',221,1),(11723,'Yagapuram',221,1),(11724,'Amoor',222,1),(11725,'Anjanam',222,1),(11726,'Arachi',222,1),(11727,'Ayyampalayam',222,1),(11728,'Devanoor',222,1),(11729,'Evoor',222,1),(11730,'Gunaseelam',222,1),(11731,'Jambumadai',222,1),(11732,'Jayankondan',222,1),(11733,'Kamatchipatty',222,1),(11734,'Karattampatty',222,1),(11735,'Karigali',222,1),(11736,'Karugudi',222,1),(11737,'Kattukulam',222,1),(11738,'Kodunthurai',222,1),(11739,'Komangalam',222,1),(11740,'Konappampatty',222,1),(11741,'M.Puthupatty (Kel)',222,1),(11742,'M.Puthupatty (Mel)',222,1),(11743,'Mahadevi',222,1),(11744,'Manbarai',222,1),(11745,'Mangalam',222,1),(11746,'Mavilippatty',222,1),(11747,'Moovali',222,1),(11748,'Moovanoor',222,1),(11749,'Morupatty',222,1),(11750,'Musiri (Kel)',222,1),(11751,'Musiri (Mel)',222,1),(11752,'Muthampatty',222,1),(11753,'Neyvali',222,1),(11754,'Oorakarai',222,1),(11755,'Paithambarai',222,1),(11756,'Peramangalam',222,1),(11757,'Perur',222,1),(11758,'Pillapalayam',222,1),(11759,'Pillathurai',222,1),(11760,'Poolancheri',222,1),(11761,'Pulivalam',222,1),(11762,'Serugudi',222,1),(11763,'Sevanthalingapuram',222,1),(11764,'Sithamboor',222,1),(11765,'Sitilari',222,1),(11766,'Soorampatty',222,1),(11767,'Sukkampatty',222,1),(11768,'T.Puthupatty',222,1),(11769,'Thandalaiputhur',222,1),(11770,'Thathiengarpattai',222,1),(11771,'Thinakkonam',222,1),(11772,'Thinnanoor',222,1),(11773,'Thiruthalayr',222,1),(11774,'Thiruthiyamalai',222,1),(11775,'Thulayanatham',222,1),(11776,'Thumbalam',222,1),(11777,'Umayalpuram',222,1),(11778,'Vadamalaipatty',222,1),(11779,'Valaieduppu',222,1),(11780,'Valasiramani',222,1),(11781,'Valavanthi (Kel)',222,1),(11782,'Valavanthi (Mel)',222,1),(11783,'Vellor',222,1),(11784,'Vengaimandalam',222,1),(11785,'Allur',223,1),(11786,'Alundur',223,1),(11787,'Ammapettai',223,1),(11788,'Anthanallur',223,1),(11789,'Ariyavoor',223,1),(11790,'Athavathur East',223,1),(11791,'Athavathur West',223,1),(11792,'Jambukeshwaram',223,1),(11793,'Kadiyakkurichi',223,1),(11794,'Kallikkudi North',223,1),(11795,'Kallikkudi South',223,1),(11796,'Kambarsampettai',223,1),(11797,'Kilikoodu',223,1),(11798,'Kodiyalam',223,1),(11799,'Kondayampettai',223,1),(11800,'Koppu North',223,1),(11801,'Koppu South',223,1),(11802,'Kottappatu',223,1),(11803,'Kozhukattaikudi',223,1),(11804,'Kulathur',223,1),(11805,'Kulumani',223,1),(11806,'Kumaravayalur',223,1),(11807,'Malliyampathu',223,1),(11808,'Maruthandakkurichi',223,1),(11809,'Mathur',223,1),(11810,'Mekkdui 72',223,1),(11811,'Mekkudi 13',223,1),(11812,'Melur',223,1),(11813,'Mudikandam',223,1),(11814,'Mulikarumbur',223,1),(11815,'Mutharasanallur',223,1),(11816,'Nachikurichi',223,1),(11817,'Nagamangalam',223,1),(11818,'Navalurkottapattu',223,1),(11819,'Olayur',223,1),(11820,'Paganoor',223,1),(11821,'Palur',223,1),(11822,'Panayapuram',223,1),(11823,'Periyakaruppur',223,1),(11824,'Periyanayakisathiram',223,1),(11825,'Perugamani',223,1),(11826,'Perur',223,1),(11827,'Pettavaithalai',223,1),(11828,'Pothavur',223,1),(11829,'Puliyur',223,1),(11830,'Sethurappatti',223,1),(11831,'Sirugamani East',223,1),(11832,'Sirugamani West',223,1),(11833,'Solanganallur',223,1),(11834,'Somarasampettai',223,1),(11835,'Thayanoor',223,1),(11836,'Thimmarayasamuthram',223,1),(11837,'Thiruchendurai',223,1),(11838,'Thirumalaisamuthiram',223,1),(11839,'Thirupparaithurai',223,1),(11840,'Thiruvalarcholai',223,1),(11841,'Thorakkudi',223,1),(11842,'Ukkadai Ariyavoor',223,1),(11843,'Uthamseri',223,1),(11844,'Vellithirumuttham',223,1),(11845,'சின்னவடவூர்',224,1),(11846,'சிந்தாமணி',224,1),(11847,'கோ.அபிஷேகபுரம்',224,1),(11848,'பஞ்சப்பூர்',224,1),(11849,'பாண்டமங்கலம்',224,1),(11850,'பெரியவடவூர்',224,1),(11851,'பிராட்டியூர்(கிழக்கு)',224,1),(11852,'பிராட்டியூர்(மேற்கு)',224,1),(11853,'புத்தூர்',224,1),(11854,'தாமலவாருபயம்',224,1),(11855,'தென்னூர்',224,1),(11856,'உய்யக்கொண்டான்திருமலை',224,1),(11857,'அகரம்',225,1),(11858,'அரசங்குடி',225,1),(11859,'அசூர்',225,1),(11860,'சோழமாதேவி',225,1),(11861,'எலந்தப்பட்டி',225,1),(11862,'எல்லகுடி',225,1),(11863,'குண்டூர்',225,1),(11864,'காந்தலூர்',225,1),(11865,'கீழகல்கண்டர்கோட்டை',225,1),(11866,'கீழக்குறிச்சி',225,1),(11867,'கீழமுல்லக்குடி',225,1),(11868,'கிளியூர்',225,1),(11869,'கூத்தைப்பார்',225,1),(11870,'கிருஷ்ணசமுத்திரம்',225,1),(11871,'கும்பகுடி வேலாயுதங்குடி',225,1),(11872,'குவளகுடி',225,1),(11873,'நடராஜபுரம்',225,1),(11874,'நாவல்பட்டு',225,1),(11875,'பழங்கனாங்குடி',225,1),(11876,'பனையகுறிச்சி',225,1),(11877,'பாப்பாக்குறிச்சி',225,1),(11878,'பத்தளாப்பேட்டை',225,1),(11879,'பூலாங்குடி',225,1),(11880,'செம்மங்குளம்',225,1),(11881,'சூரியூர்',225,1),(11882,'தேனேரிப்பட்டி',225,1),(11883,'திருநெடுங்குளம்',225,1),(11884,'திருவெறும்பூர்',225,1),(11885,'துவாக்குடி',225,1),(11886,'வாளவந்தான்கோட்டை',225,1),(11887,'வேங்கூர்',225,1),(11888,'அலகரை',226,1),(11889,'அப்பணநல்லூர்',226,1),(11890,'அரங்கூர்',226,1),(11891,'அரசலூர்',226,1),(11892,'சின்னப்பள்ளிபாளையம்',226,1),(11893,'ஏலூர்பட்டி',226,1),(11894,'காடுவெட்டி',226,1),(11895,'காமலாபுரம்',226,1),(11896,'காட்டுப்புதூர்(கிழக்கு)',226,1),(11897,'காட்டுப்புதூர்(மேற்கு)',226,1),(11898,'கிடாரம்',226,1),(11899,'கொளக்குடி',226,1),(11900,'எம்.களத்தூர்',226,1),(11901,'எம்.புத்தூர்',226,1),(11902,'மணமேடு',226,1),(11903,'முள்ளிப்படி',226,1),(11904,'முருங்கை',226,1),(11905,'நாகையநல்லூர்',226,1),(11906,'நத்தம்',226,1),(11907,'பெரியபள்ளிபாளையம்',226,1),(11908,'பிடாரமங்கலம்',226,1),(11909,'சீலைப்பிள்ளையார்புத்தூர்',226,1),(11910,'சித்தூர்',226,1),(11911,'சீனிவாசநல்லூர்',226,1),(11912,'ஸ்ரீராமசமுத்திரம்',226,1),(11913,'திருநாராயணபுரம்',226,1),(11914,'தோளூர்பட்டி',226,1),(11915,'தொட்டியம்',226,1),(11916,'உன்னியூர்',226,1),(11917,'வாள்வேல்புதூர்',226,1),(11918,'அபினிமங்கலம்',227,1),(11919,'அழகாபுரி',227,1),(11920,'ஆலத்துடையான்பட்டி',227,1),(11921,'அம்மாபட்டி',227,1),(11922,'ஆதனூர்',227,1),(11923,'பாலகிருஷ்ணம்பட்டி(கிழக்கு)',227,1),(11924,'பாலகிருஷ்ணம்பட்டி(மேற்கு)',227,1),(11925,'சொக்கநாதபுரம்',227,1),(11926,'எ.பாதர்பேட்டை',227,1),(11927,'எரகுடி(வடக்கு)',227,1),(11928,'எரகுடி(தெற்கு)',227,1),(11929,'கலிங்கமுடையான்பட்டி',227,1),(11930,'கல்லாத்துகோம்பை',227,1),(11931,'காமாட்சிபுரம்',227,1),(11932,'கண்ணனூர்',227,1),(11933,'காரப்புடையான்பட்டி',227,1),(11934,'கீரம்பூர்',227,1),(11935,'கொல்லப்பட்டி',227,1),(11936,'கோம்பை',227,1),(11937,'கொப்பமாபுரி',227,1),(11938,'கொப்பம்பட்டி',227,1),(11939,'கோட்டையூர்',227,1),(11940,'கோட்டப்பாளையம்(கிழக்கு)',227,1),(11941,'கோட்டப்பாளையம்(மேற்கு)',227,1),(11942,'கோட்டத்தூர்',227,1),(11943,'மருவத்தூர்',227,1),(11944,'முருகூர்',227,1),(11945,'முத்தியம்பாளையம்',227,1),(11946,'நடுவலூர்',227,1),(11947,'நாகலாபுரம்',227,1),(11948,'நல்லமாத்திகோம்பை',227,1),(11949,'ஒக்கரை',227,1),(11950,'ஓசரப்பள்ளி',227,1),(11951,'பச்சப்பெருமாள்பட்டி(வடக்கு)',227,1),(11952,'பச்சப்பெருமாள்பட்டி(தெற்கு)',227,1),(11953,'பகளவாடி',227,1),(11954,'பசரிக்கோம்பை',227,1),(11955,'பொங்கலாயகோம்பை',227,1),(11956,'பொன்னுசங்கம்பட்டி',227,1),(11957,'புளியஞ்சோலைகோம்பை',227,1),(11958,'புத்தனாம்பட்டி',227,1),(11959,'சங்கம்பட்டிகோம்பை-1',227,1),(11960,'சங்கம்பட்டிகோம்பை-2',227,1),(11961,'சேனப்பநல்லூர்',227,1),(11962,'செங்காட்டுப்பட்டி',227,1),(11963,'சிக்கத்தம்பூர் வடக்கு',227,1),(11964,'சிக்கத்தம்பூர் தெற்கு',227,1),(11965,'சிங்களாந்தபுரம்',227,1),(11966,'சிறுநத்தம்',227,1),(11967,'சிறுநாவலூர்',227,1),(11968,'சோபனபுரம்',227,1),(11969,'சூக்கலாம்பட்டிகோம்பை',227,1),(11970,'து.ரெங்கநாதபுரம்',227,1),(11971,'தளுகை',227,1),(11972,'தென்பரநாடு',227,1),(11973,'துறையூர்',227,1),(11974,'உப்பிலியபுரம் (வடக்கு)',227,1),(11975,'உப்பிலியபுரம் (தெற்கு)',227,1),(11976,'வடக்குவெளி',227,1),(11977,'வைரிச்செட்டிபாளையம்',227,1),(11978,'வண்ணாடு',227,1),(11979,'வீரமச்சான்பட்டி',227,1),(11980,'வேங்கடத்தானூர்',227,1),(11981,'வெங்கடாசலபுரம்',227,1),(11982,'வேங்கடேசபுரம்',227,1),(11983,'விசாலாட்சிஅம்மாள்சமுத்திரம்',227,1),(11984,'ஆலந்தூர்',228,1),(11985,'அரியமங்கலம்',228,1),(11986,'தேவதானம்',228,1),(11987,'கே.சாத்தனூர்(தெற்கு)',228,1),(11988,'கே.சாத்தனூர்(வடக்கு)',228,1),(11989,'கொட்டப்பட்டு',228,1),(11990,'செங்குளம்',228,1),(11991,'தாராநல்லூர்',228,1),(11992,'திருச்சி டவுண்',228,1),(11993,'உக்கடை அரியமங்கலம்',228,1),(11994,'வரகனேரி',228,1),(11995,'ஆய்க்குடி',229,1),(11996,'அதங்குடி',229,1),(11997,'அகரவேளுக்குடி',229,1),(11998,'அரிச்சந்திரபுரம்',229,1),(11999,'அத்திசோழமங்கலம்',229,1),(12000,'ஆய்குடி',229,1),(12001,'சித்தாம்பூர்',229,1),(12002,'சித்திரையூர்',229,1),(12003,'எருக்காட்டூர்',229,1),(12004,'காவனூர்',229,1),(12005,'காக்கையாடி',229,1),(12006,'கமலாபுரம்',229,1),(12007,'கண்கொடுத்தவணிதம்',229,1),(12008,'கீழ்மணலி',229,1),(12009,'கிளியனுர்',229,1),(12010,'கூத்தாநல்லூர்',229,1),(12011,'கொத்தங்குடி',229,1),(12012,'குலமாணிக்கம்',229,1),(12013,'லெட்சுமாங்குடி',229,1),(12014,'மணக்கரை',229,1),(12015,'மஞ்சனவாடி',229,1),(12016,'மாரங்குடி',229,1),(12017,'மாவட்டகுடி',229,1),(12018,'மேலராதாநல்லூர்',229,1),(12019,'மேலதிருமதிக்குன்னம்',229,1),(12020,'முசிரியம்',229,1),(12021,'நாலில் ஒன்று',229,1),(12022,'நட்டுவாக்குடி',229,1),(12023,'ஒகைப்பேரையூர்',229,1),(12024,'ஓவர்ச்சேரி',229,1),(12025,'பழையனூர்',229,1),(12026,'பாலக்குறிச்சி',229,1),(12027,'பண்டுதக்குடி',229,1),(12028,'பருத்தியூர்',229,1),(12029,'பெரியகொத்தூர்',229,1),(12030,'பூந்தாழங்குடி',229,1),(12031,'புள்ளமங்கலம்',229,1),(12032,'புனவாசல்',229,1),(12033,'ராமநாதன்கோவில்',229,1),(12034,'சாத்தனூர்',229,1),(12035,'சேகரை',229,1),(12036,'சேந்தங்குடி',229,1),(12037,'செருவாமணி',229,1),(12038,'சித்தன்னக்குடி',229,1),(12039,'தென்கோவனூர்',229,1),(12040,'திருராமேஸ்வரம்',229,1),(12041,'திருவிடவாசல்',229,1),(12042,'திட்டாணிமுட்டம்',229,1),(12043,'வடகோவனூர்',229,1),(12044,'வடபாதிமங்கலம்',229,1),(12045,'வக்கராநல்லூர்',229,1),(12046,'வெள்ளக்குடி',229,1),(12047,'வெங்காரம்பேரையூர்',229,1),(12048,'வேற்குடி',229,1),(12049,'விடயபுரம்',229,1),(12050,'ஆலடிக்கருப்பூர்',230,1),(12051,'ஆலத்தூர்',230,1),(12052,'ஆர்பார்',230,1),(12053,'அபிவிருத்தீஸ்வரம்',230,1),(12054,'அதம்பார் உக்கடை',230,1),(12055,'அடிப்பூலியூர்',230,1),(12056,'அகரஓகை',230,1),(12057,'அன்னவாசல்',230,1),(12058,'அன்னியூர்',230,1),(12059,'அரசூர்',230,1),(12060,'இலையூர்',230,1),(12061,'கடலங்குடி',230,1),(12062,'கண்டரமாணிக்கம்',230,1),(12063,'கரையாப்பாலையூர்',230,1),(12064,'கீழப்பாலையூர்',230,1),(12065,'கிள்ளியூர்',230,1),(12066,'கூந்தலூர்',230,1),(12067,'குடவாசல்',230,1),(12068,'மணப்பறவை',230,1),(12069,'மணவாளநல்லூர்',230,1),(12070,'மஞ்சக்குடி',230,1),(12071,'மருத்துவக்குடி',230,1),(12072,'மேலாதிச்சமங்கலம்',230,1),(12073,'மேலப்பாலையூர்',230,1),(12074,'மேலராமன்சேத்தி',230,1),(12075,'நாரணமங்கலம்',230,1),(12076,'நெடுஞ்சேரி',230,1),(12077,'நெய்குப்பை',230,1),(12078,'பரவாக்கரை',230,1),(12079,'பருத்தியூர்',230,1),(12080,'பெருமங்கலம்',230,1),(12081,'பெரும்பண்ணையூர்',230,1),(12082,'பிரதாபராமபுரம்',230,1),(12083,'புதுக்குடி',230,1),(12084,'புதுக்குடி',230,1),(12085,'புளியஞ்சேரி',230,1),(12086,'சரபோஜிராஜபுரம்',230,1),(12087,'சர்குணேஸ்வரபுரம்',230,1),(12088,'சீதக்கமங்கலம்',230,1),(12089,'செல்லூர்',230,1),(12090,'சேங்காலிபுரம்',230,1),(12091,'செருகுடி',230,1),(12092,'செருகளத்தூர்',230,1),(12093,'சேதினிபுரம்',230,1),(12094,'சிமிழி',230,1),(12095,'சித்தாடி',230,1),(12096,'சுரைக்காயூர்',230,1),(12097,'தேதியூர்',230,1),(12098,'திருக்குடி',230,1),(12099,'திருப்பாம்புரம்',230,1),(12100,'திருவீழிமிழலை',230,1),(12101,'திருவிடச்சேரி',230,1),(12102,'திருக்களம்பூர்',230,1),(12103,'உத்திரங்குடி',230,1),(12104,'வடமட்டம்',230,1),(12105,'வடவேர்',230,1),(12106,'வடுகக்குடி',230,1),(12107,'வளவநல்லூர்',230,1),(12108,'வயலூர்',230,1),(12109,'வெள்ளை அதம்பார்',230,1),(12110,'விக்கிரபாண்டியம்',230,1),(12111,'விளாகம்',230,1),(12112,'விஷ்னுபுரம்',230,1),(12113,'ஆண்டிக்குளம்',231,1),(12114,'ஆதிச்சபுரம்',231,1),(12115,'அக்கரைக்கோட்டகம்',231,1),(12116,'ஆலத்தூர்',231,1),(12117,'அப்பரசம்பேட்டை பேரையூர்',231,1),(12118,'அரவத்தூர்',231,1),(12119,'அஷேசம்',231,1),(12120,'அத்திக்கோட்டை',231,1),(12121,'பீகாஜி மடிகேராவ் தோட்டம்',231,1),(12122,'சித்தமல்லி',231,1),(12123,'எடயைர் நத்தம்',231,1),(12124,'எளவனூர்',231,1),(12125,'ஏத்தக்குடி',231,1),(12126,'கோபிரளயம்',231,1),(12127,'இடையர் எம்பேத்தி',231,1),(12128,'இருள்நீக்கி',231,1),(12129,'ஜாலசாகிப் தோட்டம்',231,1),(12130,'காரிக்கோட்டை',231,1),(12131,'கைலாசநாதர்கோவில்',231,1),(12132,'கல்கி அக்கா தோட்டம்',231,1),(12133,'கள்ளர் எம்பேத்தி',231,1),(12134,'கண்டமங்கலம்',231,1),(12135,'கண்டிதம்பேட்டை',231,1),(12136,'காரக்கோட்டை',231,1),(12137,'கர்ணாவூர்',231,1),(12138,'கருப்புக்கிளார்',231,1),(12139,'கருவாக்குறிச்சி',231,1),(12140,'கட்டக்குடி பேரையூர்',231,1),(12141,'கெழுவத்தூர்',231,1),(12142,'கூப்பாச்சிக்கோட்டை',231,1),(12143,'கோட்டூர்',231,1),(12144,'கோட்டூர் தோட்டம்',231,1),(12145,'குலமாணிக்கம்',231,1),(12146,'குமரபுரம்',231,1),(12147,'குன்னியூர்',231,1),(12148,'குறிச்சி',231,1),(12149,'குறிச்சிமூலை',231,1),(12150,'குறிச்சிமூலை',231,1),(12151,'மகாதேவப்பட்டிணம்',231,1),(12152,'மகாதேவப்பட்டிணம்',231,1),(12153,'மழவராயநல்லூர்',231,1),(12154,'மானங்காத்தான்கோட்டகம்',231,1),(12155,'மன்னார்குடி',231,1),(12156,'மண்ணுக்குமுண்டான்',231,1),(12157,'மரவாக்காடு',231,1),(12158,'மேலநத்தம்',231,1),(12159,'மேலவாசல் நகராட்சி',231,1),(12160,'மேலவாசல் நரசிம்மாச்சாரி',231,1),(12161,'மேலவாசல்',231,1),(12162,'மூன்றாம்சேத்தி',231,1),(12163,'மூவாநல்லூர்',231,1),(12164,'முக்குளம் சாத்தனூர்',231,1),(12165,'முதல்சேத்தி',231,1),(12166,'நாலாம்சேத்தி',231,1),(12167,'நல்லூர்',231,1),(12168,'நாரணயபுரம் களப்பால்',231,1),(12169,'நருவளிகளப்பால்',231,1),(12170,'நெடுவாக்கோட்டை',231,1),(12171,'நீலகண்டகாடேராவ் தோட்டம்',231,1),(12172,'நெம்மேலி',231,1),(12173,'நெம்மேலி',231,1),(12174,'நெம்மேலி',231,1),(12175,'நொச்சியூர்',231,1),(12176,'நோக்கன் உக்கடை',231,1),(12177,'ஒரத்தூர்',231,1),(12178,'ஓவேல்குடி பேரையூர்',231,1),(12179,'பாலையூர்',231,1),(12180,'பைங்காநாடு',231,1),(12181,'பைங்காட்டூர்',231,1),(12182,'பாளையக்கோட்டை பரசபுரம்',231,1),(12183,'பள்ளிவர்த்தி',231,1),(12184,'பாமணி',231,1),(12185,'பனையூர்',231,1),(12186,'பரவாக்கோட்டை',231,1),(12187,'பரவாக்கோட்டை',231,1),(12188,'பருத்திக்கோட்டை',231,1),(12189,'பேரையூர்',231,1),(12190,'பெருகவாழ்ந்தான்',231,1),(12191,'பெருகவாழ்ந்தான்',231,1),(12192,'பெருவிடைமருதூர்',231,1),(12193,'புழுதிக்குடி',231,1),(12194,'புத்தகரம்',231,1),(12195,'ராஜசாம்பாள்புரம்',231,1),(12196,'ராமாபுரம்',231,1),(12197,'ராசாளி குடிகாடு',231,1),(12198,'ராதாநரசிம்மபுரம்',231,1),(12199,'ரெங்கமாவுத்தன் தோட்டம்',231,1),(12200,'ரெங்கனாதபுரம்',231,1),(12201,'சவளக்காரன்',231,1),(12202,'செம்மன்குளம்',231,1),(12203,'சேந்தமங்கலம்',231,1),(12204,'சேரங்குளம்',231,1),(12205,'செருகளத்தூர்',231,1),(12206,'செருமங்கலம்',231,1),(12207,'செருமங்கலம்',231,1),(12208,'சுந்தரக்கோட்டை',231,1),(12209,'தலையாமங்கலம்',231,1),(12210,'தளிக்கோட்டை',231,1),(12211,'தென்பரை',231,1),(12212,'தென்பாதி',231,1),(12213,'தெற்கு நாணலூர்',231,1),(12214,'தேவதானம்',231,1),(12215,'திருக்களார்',231,1),(12216,'திருமக்கோட்டை',231,1),(12217,'திருமக்கோட்டை',231,1),(12218,'திருப்பாலக்குடிஆலங்கோட்',231,1),(12219,'திருப்பாலக்குடி',231,1),(12220,'திருப்பாலக்குடி',231,1),(12221,'துளசேந்திரபுரம்',231,1),(12222,'உள்ளிக்கோட்டை',231,1),(12223,'வடபாதி',231,1),(12224,'வல்லூர்',231,1),(12225,'வாட்டார்',231,1),(12226,'வெங்கத்தாங்குடி',231,1),(12227,'விக்கிரபாண்டியம்',231,1),(12228,'ஆலங்குடி',232,1),(12229,'ஆனைக்குப்பம்',232,1),(12230,'அச்சுதமங்கலம்',232,1),(12231,'அதம்பார்',232,1),(12232,'அதம்பார் -',232,1),(12233,'அகரத்திருமாளம்',232,1),(12234,'அன்னதானபுரம்',232,1),(12235,'அய்யம்பேட்டை',232,1),(12236,'கடகக்குடி',232,1),(12237,'கடகம்',232,1),(12238,'கடுவங்குடி',232,1),(12239,'காளியாகுட',232,1),(12240,'கீழ்க்குடி',232,1),(12241,'கீரனூர்',232,1),(12242,'கொல்லாபுரம்',232,1),(12243,'கொல்லுமாங்குடி -',232,1),(12244,'கூத்தனூர்',232,1),(12245,'கூத்தனூர்',232,1),(12246,'கொத்தவாசல்',232,1),(12247,'கொட்டூர்',232,1),(12248,'கோவில்திருமாளம்',232,1),(12249,'குமாரக்குடி',232,1),(12250,'குருங்குளம்',232,1),(12251,'குவளைக்கால்',232,1),(12252,'மகிழஞ்சேரி',232,1),(12253,'மகாராஜபுரம்',232,1),(12254,'மணவாளம்பேட்டை',232,1),(12255,'மருதவாஞ்சேரி',232,1),(12256,'மேனாங்குடி',232,1),(12257,'மூலமங்கலம்',232,1),(12258,'மூலங்குடி',232,1),(12259,'மூங்கில்குடி',232,1),(12260,'முடிகொண்டான்',232,1),(12261,'முகுந்தனூர்',232,1),(12262,'நாகக்குடி',232,1),(12263,'நல்லமாங்குடி',232,1),(12264,'நன்னிலம்',232,1),(12265,'நெடுங்குளம்',232,1),(12266,'நீலக்குடி',232,1),(12267,'நெம்மேலி',232,1),(12268,'பனங்காட்டாங்குடி',232,1),(12269,'பனங்குடி',232,1),(12270,'பண்டாரவாடை',232,1),(12271,'பருத்தியூர்',232,1),(12272,'பாவட்டக்குடி',232,1),(12273,'பேரளம்',232,1),(12274,'பெரும்புகளூர்',232,1),(12275,'பில்லூர்',232,1),(12276,'போழக்குடி',232,1),(12277,'பூங்குளம்',232,1),(12278,'ரெட்டக்குடி',232,1),(12279,'சலிப்போரி',232,1),(12280,'சன்னாநல்லூர்',232,1),(12281,'செம்பியநல்லூர்',232,1),(12282,'சேங்கனூர்',232,1),(12283,'செருவளூர்',232,1),(12284,'சிறுபுலியூர்',232,1),(12285,'ஸ்ரீவாஞ்சியம்',232,1),(12286,'சுரக்குடி',232,1),(12287,'தலையூர்',232,1),(12288,'தட்டாத்திமூலை',232,1),(12289,'திருக்கண்டீஸ்வரம்',232,1),(12290,'திருக்கொட்டாரம்',232,1),(12291,'திருமியச்சூர்',232,1),(12292,'திருப்பள்ளிமுக்கூடல் -',232,1),(12293,'தூத்துக்குடி',232,1),(12294,'உபயவேதாந்தபுரம்',232,1),(12295,'வாழ்க்கை',232,1),(12296,'வடகுடி',232,1),(12297,'வண்டாம்பாலை',232,1),(12298,'வேலங்குடி',232,1),(12299,'வீதிவிடங்கன்',232,1),(12300,'விசலூர்',232,1),(12301,'அன்னவாசல்',233,1),(12302,'அன்னவாசல் தென்பாதி',233,1),(12303,'அனுமந்தபுரம்',233,1),(12304,'அரிச்சபுரம்',233,1),(12305,'ஆதனூர்',233,1),(12306,'செட்டிசத்திரம்',233,1),(12307,'சித்தமல்லி மேல்பாதி',233,1),(12308,'எடகீழையூர்',233,1),(12309,'எடகீழையூர்',233,1),(12310,'எடமேலையூர்',233,1),(12311,'எடமேலையூர்',233,1),(12312,'எடமேலையூர்',233,1),(12313,'இடையர்நத்தம் படுகை',233,1),(12314,'காளாஞ்சிமேடு',233,1),(12315,'காளாச்சேரி',233,1),(12316,'களத்தூர்',233,1),(12317,'கமுகக்குடி',233,1),(12318,'கீழாளவந்தசோரி',233,1),(12319,'கோவில்வெண்ணி',233,1),(12320,'கிருஷ்ணன் கோட்டகம்',233,1),(12321,'மாங்குடி',233,1),(12322,'மேலாளவந்தசேரி',233,1),(12323,'மூவர்க்கோட்டை',233,1),(12324,'முன்னாவல்கோட்டை',233,1),(12325,'முன்னாவல்கோட்டை',233,1),(12326,'நகர்',233,1),(12327,'ஒளிமதி',233,1),(12328,'ஒட்டக்குடி',233,1),(12329,'பழைய நீடாமங்கலம்',233,1),(12330,'பழங்களத்தூர்',233,1),(12331,'பன்னிமங்கலம்',233,1),(12332,'பரப்பனாமோடு',233,1),(12333,'பத்தூர்',233,1),(12334,'பெரம்பூர்',233,1),(12335,'பெருமாளகரம்',233,1),(12336,'பித்துண்டம்',233,1),(12337,'பூவனூர்',233,1),(12338,'புள்ளவராயன்குடிகாடு',233,1),(12339,'புதுத்தேவன்குடி',233,1),(12340,'ராயபுரம்',233,1),(12341,'ரிஷியூர்',233,1),(12342,'திருக்கண்ணமங்கை கோட்டகம்',233,1),(12343,'ஊர்குடி',233,1),(12344,'வடகாரவயல்',233,1),(12345,'வடுவூர் அக்ரஹாரம்',233,1),(12346,'வடுவூர் மேல்பாதி',233,1),(12347,'வடுவூர் தென்பாதி',233,1),(12348,'வடுவூர்தென்பாதி',233,1),(12349,'வடுவூர் வடபாதி',233,1),(12350,'வையகளத்தூர்',233,1),(12351,'விஸ்வநாதபுரம்',233,1),(12352,'ஆலங்காடு',234,1),(12353,'ஆலத்தம்பாடி',234,1),(12354,'ஆலிவலம்',234,1),(12355,'ஆண்டாங்கரை',234,1),(12356,'ஆரியலூர்',234,1),(12357,'அம்மனூர்',234,1),(12358,'ஆதனூர்',234,1),(12359,'ஆதிரங்கம்',234,1),(12360,'செட்டியமூலை -',234,1),(12361,'தீவம்மாபுரம்',234,1),(12362,'எக்கல்',234,1),(12363,'எழிலூர்',234,1),(12364,'இடையூர்',234,1),(12365,'இடும்பாவனம்',234,1),(12366,'ஜாம்புவானோடை',234,1),(12367,'கச்சனம்',234,1),(12368,'காடுவா கொத்தமங்கலம் -',234,1),(12369,'கள்ளிக்குடி',234,1),(12370,'கழுவங்காடு',234,1),(12371,'கற்பகநாதர்குளம் -',234,1),(12372,'கட்டிமோடு',234,1),(12373,'கீராளத்தூர்',234,1),(12374,'கீழ பாண்டி',234,1),(12375,'கீழநம்மங்குறிச்சி',234,1),(12376,'கீழப்பெருமழை',234,1),(12377,'கீரக்களுர்',234,1),(12378,'கொக்காலடி',234,1),(12379,'கோமல்',234,1),(12380,'கொருக்கை',234,1),(12381,'கொத்தமங்கலம்',234,1),(12382,'குன்னலூர்',234,1),(12383,'குன்னூர்',234,1),(12384,'குரும்பல்',234,1),(12385,'மணலி',234,1),(12386,'மங்கல்',234,1),(12387,'மாங்குடி',234,1),(12388,'மருதவனம்',234,1),(12389,'மேல மருதூர்',234,1),(12390,'மேலநம்மங்குறிச்சி',234,1),(12391,'மேலப்பெருமழை',234,1),(12392,'மேட்டுபாளையம்',234,1),(12393,'முத்துப்பேட்டை',234,1),(12394,'நெடும்பலம்',234,1),(12395,'நுணாக்காடு',234,1),(12396,'ஓவரூர்',234,1),(12397,'பழையங்குடி',234,1),(12398,'பாமணி',234,1),(12399,'பனையூர்',234,1),(12400,'பாண்டி',234,1),(12401,'பின்னத்தூர்',234,1),(12402,'பிச்சங்கோட்டகம்',234,1),(12403,'பூசலாங்குடி',234,1),(12404,'ராயநல்லூர்',234,1),(12405,'சங்கந்தி',234,1),(12406,'சாத்தங்குடி',234,1),(12407,'சேகல்',234,1),(12408,'சிங்களாந்தி',234,1),(12409,'தெற்குகாடு',234,1),(12410,'தேசிங்குராசபுரம் -',234,1),(12411,'தில்லைவிளாகம்',234,1),(12412,'திருப்பத்தூர்',234,1),(12413,'திருத்தங்கூர்',234,1),(12414,'திருத்துறைப்பூண்டி',234,1),(12415,'திருவலஞ்சுழி',234,1),(12416,'தோலி',234,1),(12417,'தொண்டியக்காடு -',234,1),(12418,'துரைக்காடு',234,1),(12419,'உப்பூர்',234,1),(12420,'உதயமார்த்தாண்டபுரம்',234,1),(12421,'வடகாடு',234,1),(12422,'வடசங்கந்தி',234,1),(12423,'வங்க நகர்',234,1),(12424,'வீரன்வயல் -',234,1),(12425,'வேளூர்',234,1),(12426,'விளாங்காடு -',234,1),(12427,'விளக்குடி',234,1),(12428,'விளத்தூர்',234,1),(12429,'ஆனைவடபாதி',235,1),(12430,'அடிப்புதுச்சேரி',235,1),(12431,'அடியக்கமங்கலம்',235,1),(12432,'அகரத்திருநல்லூர்',235,1),(12433,'அலிவலம்',235,1),(12434,'அம்மையப்பன்',235,1),(12435,'ஆமூர் ஆமூர்',235,1),(12436,'அரசவனங்காடு',235,1),(12437,'சோழங்கநல்லூர்',235,1),(12438,'தீபங்குடி',235,1),(12439,'தேவர்கண்டநல்லூர்',235,1),(12440,'எண்கண்',235,1),(12441,'இலவங்கார்குடி',235,1),(12442,'காப்பணாமங்கலம்',235,1),(12443,'காட்டூர்',235,1),(12444,'கடுவங்குடி',235,1),(12445,'கல்லிக்குடி',235,1),(12446,'கல்யாணமகாதேவி',235,1),(12447,'கல்யாணசுந்தரபுரம்',235,1),(12448,'கருப்பூர்',235,1),(12449,'கீழ்காவதுகுடி',235,1),(12450,'கீழ்க்கூத்தங்குடி',235,1),(12451,'கீரங்குடி',235,1),(12452,'கிடாரங்கொண்டான்',235,1),(12453,'குளிக்கரை',235,1),(12454,'குன்னியூர்',235,1),(12455,'குரும்பேரி',235,1),(12456,'மணக்கால்',235,1),(12457,'மாங்குடி',235,1),(12458,'நடப்பூர்',235,1),(12459,'நாரணமங்கலம்',235,1),(12460,'நெய்க்குப்பை',235,1),(12461,'ஒடாச்சேரி',235,1),(12462,'பழையவலம்',235,1),(12463,'பழவனக்குடி',235,1),(12464,'பள்ளிவாரமங்கலம்',235,1),(12465,'பெருந்தரக்குடி',235,1),(12466,'பெருங்குடி',235,1),(12467,'பின்னவாசல்',235,1),(12468,'புதுப்பத்தூர்',235,1),(12469,'புதூர்',235,1),(12470,'புலவநல்லூர்',235,1),(12471,'புலிவலம்',235,1),(12472,'ராதாநல்லூர்',235,1),(12473,'ராமகயை',235,1),(12474,'சேமங்கலம்',235,1),(12475,'செம்மங்குடி',235,1),(12476,'செருகுடி',235,1),(12477,'சுந்தரவிளாகம்',235,1),(12478,'தண்டலை',235,1),(12479,'தப்பளாம்புலியூர்',235,1),(12480,'தப்பளாம்புலியூர்',235,1),(12481,'தியாகராஜபுரம்',235,1),(12482,'திருக்காரவாசல்',235,1),(12483,'திருக்கண்ணமங்கை',235,1),(12484,'திருநெய்ப்பேர்',235,1),(12485,'திருவாரூர் தெற்கு சேத்தி',235,1),(12486,'திருவாரூர் வடக்கு சேத்தி',235,1),(12487,'திருவாதிரைமங்கலம்',235,1),(12488,'உமாமகேஸ்வரபுரம்',235,1),(12489,'வடகண்டம்',235,1),(12490,'வடகரை',235,1),(12491,'வைப்பூர்',235,1),(12492,'வஞ்சியூர்',235,1),(12493,'வெங்கடேஸ்வரபுரம்',235,1),(12494,'வேப்பத்தாங்குடி',235,1),(12495,'விஜயபுரம்',235,1),(12496,'விளமல்',235,1),(12497,'ஆலங்குடி',236,1),(12498,'ஆதிச்சமங்கலம்',236,1),(12499,'ஆவிச்சாவடி -',236,1),(12500,'ஆவூர்',236,1),(12501,'அமராவதி -',236,1),(12502,'அன்னுக்குடி',236,1),(12503,'அரவத்தூர்',236,1),(12504,'அரவூர்',236,1),(12505,'அரித்துவாரமங்கலம்',236,1),(12506,'அவளிவநல்லூர்',236,1),(12507,'சந்திரசேகரபுரம்',236,1),(12508,'சித்தன்வாழூர்',236,1),(12509,'ஏரி -',236,1),(12510,'எருமைப்படுகை -',236,1),(12511,'கோவிந்தகுடி',236,1),(12512,'இனாம்கிளியூர் -',236,1),(12513,'களத்துர்',236,1),(12514,'கண்டியூர்',236,1),(12515,'கீழவிடையல்',236,1),(12516,'கேத்தனூர்',236,1),(12517,'கிளியூர்',236,1),(12518,'கிளியூர் -',236,1),(12519,'கொட்டையூர்',236,1),(12520,'மாளிகைத்திடல்',236,1),(12521,'மாத்தூர்',236,1),(12522,'மணக்கால்',236,1),(12523,'மணலூர்',236,1),(12524,'மாணிக்கமங்கலம்',236,1),(12525,'மருவத்தூர்',236,1),(12526,'மதகரம்',236,1),(12527,'மேலவிடையல்',236,1),(12528,'மூலாழ்வாஞ்சேரி',236,1),(12529,'முனியூர்',236,1),(12530,'நல்லம்பூர்',236,1),(12531,'நல்லூர்',236,1),(12532,'நார்த்தாங்குடி',236,1),(12533,'நெம்மேலிக்குடிபடுகை',236,1),(12534,'நெம்மேலிக்குடி',236,1),(12535,'பாடகச்சேரி',236,1),(12536,'பாப்பாக்குடி',236,1),(12537,'பயத்தஞ்சேரி -',236,1),(12538,'பெருங்குடி',236,1),(12539,'பூனாயிருப்பு',236,1),(12540,'பூந்தோட்டம்',236,1),(12541,'புலவநத்தம்',236,1),(12542,'புளியக்குடி',236,1),(12543,'ரகுனாதபுரம்',236,1),(12544,'ராஜேந்திரநல்லூர்',236,1),(12545,'ர‌ெகுனாதபுரம்',236,1),(12546,'ர‌ெகுனாதபுரம்',236,1),(12547,'ர‌ெங்கனாதபுரம்',236,1),(12548,'சாரநத்தம்',236,1),(12549,'சடையங்கால் -',236,1),(12550,'சாலபோகம்',236,1),(12551,'செம்மங்குடி',236,1),(12552,'சிங்காரம்பாளையம் -',236,1),(12553,'தென்குவளவேலி',236,1),(12554,'தெற்குப்பட்டம்',236,1),(12555,'திருவோணமங்கலம்',236,1),(12556,'தொழுவூர்',236,1),(12557,'உத்தமதானபுரம்',236,1),(12558,'ஊத்துக்காடு',236,1),(12559,'வடக்குப்பட்டம்',236,1),(12560,'வலங்கைமான்',236,1),(12561,'வாணியங்கரம்பை -',236,1),(12562,'வேலங்குடி',236,1),(12563,'வேலூர்',236,1),(12564,'வீரமங்கலம்',236,1),(12565,'வீராணம்',236,1),(12566,'விளத்தூர்',236,1),(12567,'விருப்பாச்சிபுரம்',236,1),(12568,'ஆதிநாதபுரம்',237,1),(12569,'அகரம்',237,1),(12570,'அழகியமணவாளபுரம்',237,1),(12571,'ஆழ்வார்திருநகரி',237,1),(12572,'அங்கமங்கலம்',237,1),(12573,'ஆறுமுகமங்கலம்',237,1),(12574,'இருவப்பபுரம் பகுதி-1',237,1),(12575,'இருவப்பபுரம் பகுதி-2',237,1),(12576,'கீழ்ப்பிடாகை அப்பன்கோவில்',237,1),(12577,'கச்சனாவிளை',237,1),(12578,'கடையனோடை',237,1),(12579,'கீழ்ப்பிடாகை கஸ்பா',237,1),(12580,'கொடுங்கனி',237,1),(12581,'கொற்கை',237,1),(12582,'கொட்டாரக்குறிச்சி',237,1),(12583,'குறிப்பன்குளம்',237,1),(12584,'குருக்காட்டூர்',237,1),(12585,'மாரமங்கலம்',237,1),(12586,'மழவராயநத்தம்',237,1),(12587,'மங்கலக்குறிச்சி',237,1),(12588,'மஞ்சள்நீர்க்காயல்',237,1),(12589,'மாவடிபண்ணை',237,1),(12590,'முக்காணி',237,1),(12591,'மூக்குப்பீறி',237,1),(12592,'நாலுமாவடி',237,1),(12593,'நட்டாத்தி',237,1),(12594,'நாசரேத்',237,1),(12595,'பழையகாயல்',237,1),(12596,'பெருங்குளம்',237,1),(12597,'புறையூர்',237,1),(12598,'இராஜபதி',237,1),(12599,'சாயர்புரம்',237,1),(12600,'சேதுக்குவாய்த்தான்',237,1),(12601,'சிறுத்தொண்டநல்லூர்',237,1),(12602,'சிவகளை',237,1),(12603,'தன்னூத்து',237,1),(12604,'தேமாங்குளம்',237,1),(12605,'தென்திருப்பேரை',237,1),(12606,'திருக்களூர்',237,1),(12607,'திருநாவீருடையார்புரம்',237,1),(12608,'திருப்பணிசெட்டியாபத்து',237,1),(12609,'திருப்பணிசெட்டிகுளம்',237,1),(12610,'உடையார்குளம்',237,1),(12611,'வாழவல்லான்',237,1),(12612,'வெள்ளமடம்',237,1),(12613,'அருணாசலபுரம்',238,1),(12614,'ஆத்திக்கிணர்',238,1),(12615,'அய்ன்வடமலாபுரம்',238,1),(12616,'அயன்கரிசல்குளம்',238,1),(12617,'அய்யாக்கோட்டையூர்',238,1),(12618,'சிதம்பராபுரம்',238,1),(12619,'சின்னமலைக்குன்று',238,1),(12620,'சோழபுரம்',238,1),(12621,'எட்டயபுரம்',238,1),(12622,'எத்திலப்பநாயக்கன்பட்டி',238,1),(12623,'இளம்புவனம்',238,1),(12624,'ஈராச்சி',238,1),(12625,'கடலையூர்',238,1),(12626,'கழுகாசலபுரம்',238,1),(12627,'கன்னக்கட்டை',238,1),(12628,'கருப்பூர்',238,1),(12629,'கட்டராமன்பட்டி',238,1),(12630,'கீழஈரால்',238,1),(12631,'கீழக்கரந்தை',238,1),(12632,'கீழ்நாட்டுக்குறிச்சி',238,1),(12633,'குமாரகிரி',238,1),(12634,'மஞ்சநாயக்கன்பட்டி',238,1),(12635,'மாசார்பட்டி',238,1),(12636,'மீனாட்சிபுரம்',238,1),(12637,'மேலஈரால்.',238,1),(12638,'மேலக்கரந்தை',238,1),(12639,'முத்துலாபுரம்',238,1),(12640,'என்.வேடப்பட்டி',238,1),(12641,'என்.புதுப்பட்டி',238,1),(12642,'நக்கலக்கட்டை',238,1),(12643,'நம்பிபுரம்',238,1),(12644,'நாவலக்கம்பட்டி',238,1),(12645,'படர்ந்தபுளி',238,1),(12646,'பேரிலோவன்பட்டி',238,1),(12647,'போடுபட்டி',238,1),(12648,'புங்கவர்நத்தம்',238,1),(12649,'ராஜாபட்டி',238,1),(12650,'இராமனுத்து',238,1),(12651,'ரணசூரஎட்டுநாயக்கன்பட்டி',238,1),(12652,'சக்கிலிபட்டி',238,1),(12653,'செமப்புதூர்',238,1),(12654,'சிந்தலக்கரை',238,1),(12655,'சிங்கிலிபட்டி',238,1),(12656,'சுரைக்காய்பட்டி',238,1),(12657,'டி.அருணாசலபுரம்',238,1),(12658,'தி.சண்முகபுரம்',238,1),(12659,'டி.தங்கம்மாள்புரம்',238,1),(12660,'தலைக்காட்டுபுரம்',238,1),(12661,'தாப்பாத்தி',238,1),(12662,'தோழ்மாலைப்பட்டி',238,1),(12663,'உருளைகுடி',238,1),(12664,'வி.கோடாங்கிப்பட்டி',238,1),(12665,'வாலம்பட்டி',238,1),(12666,'வீரப்பட்டி',238,1),(12667,'வேலிடுபட்டி',238,1),(12668,'வெம்பூர்',238,1),(12669,'ஆசூர்',239,1),(12670,'அச்சன்குளம்',239,1),(12671,'அகிலாண்டபுரம்',239,1),(12672,'அய்யனாரூத்து',239,1),(12673,'செட்டிகுறிச்சி',239,1),(12674,'சிதம்பரம்பட்டி',239,1),(12675,'கோவிந்தன்பட்டி',239,1),(12676,'இளவேலங்கால்',239,1),(12677,'கே.சிதம்பராபுரம்',239,1),(12678,'கே.குமாரபுரம்',239,1),(12679,'கே.சுப்பிரமணியபுரம்',239,1),(12680,'கே.உசிலங்குளம்',239,1),(12681,'கடம்பூர்',239,1),(12682,'காளாம்பட்டி',239,1),(12683,'காலாங்கரைப்பட்டி',239,1),(12684,'கலப்பைபட்டி',239,1),(12685,'காமநாயக்கன்பட்டி',239,1),(12686,'காப்புலிங்கம்பட்டி',239,1),(12687,'கரடிகுளம்',239,1),(12688,'கத்தாளம்பட்டி',239,1),(12689,'கட்டாரங்குளம்',239,1),(12690,'கயத்தார்',239,1),(12691,'கொப்பம்பட்டி',239,1),(12692,'கொத்தாளி',239,1),(12693,'குப்பணாபுரம்',239,1),(12694,'குருமலை',239,1),(12695,'குருவிநத்தம்',239,1),(12696,'குதிரைக்குளம்',239,1),(12697,'மேலப்பாறைப்பட்டி',239,1),(12698,'முடுக்கலாங்குளம்',239,1),(12699,'நாகம்பட்டி',239,1),(12700,'ஓணமாக்குளம்',239,1),(12701,'ஒட்டுடன்பட்டி',239,1),(12702,'பணிக்கர்குளம்',239,1),(12703,'பன்னிகுளம்',239,1),(12704,'புதுக்கோட்டை',239,1),(12705,'ராஜாபுதுக்குடி',239,1),(12706,'எஸ்.குமரெட்டையாபுரம்',239,1),(12707,'சங்கரப்பேரி',239,1),(12708,'சன்னபுதுக்குடி',239,1),(12709,'சரவணாபுரம்',239,1),(12710,'சவலாப்பேரி',239,1),(12711,'சிவஞானபுரம்',239,1),(12712,'தெற்குகழுகுமலை',239,1),(12713,'சுந்தரேஸ்வரபுரம்',239,1),(12714,'தீத்தாம்பட்டி',239,1),(12715,'தென்னம்பட்டி',239,1),(12716,'தெற்கு வண்டானம்',239,1),(12717,'தெற்குஇலந்தைக்குளம்',239,1),(12718,'தெற்கு மயிலோடை',239,1),(12719,'திருமலாபுரம்',239,1),(12720,'திருமங்கலக்குறிச்சி',239,1),(12721,'தொட்டம்பட்டி',239,1),(12722,'வடக்குவண்டானம்',239,1),(12723,'வடக்குஇலந்தைக்குளம்',239,1),(12724,'வானரமுட்டி',239,1),(12725,'வெள்ளாளங்கோட்டை',239,1),(12726,'ஆலம்பட்டி',240,1),(12727,'அப்பனேரி',240,1),(12728,'ஆவல்நத்தம்',240,1),(12729,'அய்யனேரி',240,1),(12730,'சித்திரம்பட்டி',240,1),(12731,'துறையூர்',240,1),(12732,'இடைசெவல் பகுதி-1',240,1),(12733,'இடைசெவல் பகுதி-2',240,1),(12734,'இளையரசனேந்தல்',240,1),(12735,'இலுப்பையூரணி',240,1),(12736,'இனாம் மணியாச்சி',240,1),(12737,'ஜமீன்தேவர்குளம்',240,1),(12738,'கே.வெங்கடேஸ்வரபுரம்',240,1),(12739,'கழுகுமலை',240,1),(12740,'கங்கன்குளம்',240,1),(12741,'கிளவிபட்டி',240,1),(12742,'கொடுக்கம்பாறை',240,1),(12743,'கோவில்பட்டி',240,1),(12744,'லெட்சுமியம்மாள்புரம்',240,1),(12745,'லிங்கம்பட்டி',240,1),(12746,'மந்தித்தோப்பு',240,1),(12747,'முடுக்குமீண்டான்பட்டி',240,1),(12748,'முக்கூட்டுமலை',240,1),(12749,'நக்கலமுத்தன்பட்டி',240,1),(12750,'நாலாட்டின்புத்தூர்',240,1),(12751,'பாண்டவர்மங்கலம்',240,1),(12752,'பிச்சைத்தலைவன்பட்டி',240,1),(12753,'பிள்ளையார்நத்தம்',240,1),(12754,'புளியங்குளம்',240,1),(12755,'பூசாரிபட்டி',240,1),(12756,'சிவந்திபட்டி',240,1),(12757,'தோணுகால்',240,1),(12758,'திட்டங்குளம்',240,1),(12759,'ஊத்துப்பட்டி',240,1),(12760,'வடக்குப்பட்டி',240,1),(12761,'வானரமுட்டி',240,1),(12762,'வில்லிசேரி பகுதி-1',240,1),(12763,'வில்லிசேரி பகுதி-2',240,1),(12764,'ஆதனூர்',241,1),(12765,'அக்காநாயக்கன்பட்டி',241,1),(12766,'ஆரைக்குளம்',241,1),(12767,'சந்திரகிரி',241,1),(12768,'டி.துரைச்சாமிபுரம்',241,1),(12769,'எப்போதும்வென்றான்',241,1),(12770,'கோவிந்தாபுரம்',241,1),(12771,'ஜம்புலிங்கபுரம்',241,1),(12772,'ஜெகவீரபாண்டியபுரம்',241,1),(12773,'கே.சண்முகபுரம்',241,1),(12774,'கச்சேரிதளவாய்புரம்',241,1),(12775,'காட்டுநாயக்கன்பட்டி',241,1),(12776,'கீழஅரசடி',241,1),(12777,'கீழக்கோட்டை',241,1),(12778,'கீழமங்கலம்',241,1),(12779,'கீழமுடியன்',241,1),(12780,'கொடியன்குளம்',241,1),(12781,'கொல்லம்பரும்பு',241,1),(12782,'கொல்லங்கிணர்',241,1),(12783,'குலசேகரநல்லூர்',241,1),(12784,'குமரெட்டியாபுரம்',241,1),(12785,'மலைப்பட்டி',241,1),(12786,'மருதன்வாழ்வுநாரைக்கிணறு',241,1),(12787,'மீனாட்சிபுரம்',241,1),(12788,'மேலஅரசடி',241,1),(12789,'மேலமருதூர்',241,1),(12790,'மேலப்பாண்டியாபுரம்',241,1),(12791,'முள்ளூர்முத்துக்குமாரபுரம்',241,1),(12792,'முறம்பன்',241,1),(12793,'முத்துராமலிங்கபுரம்',241,1),(12794,'ஒட்டநத்தம்',241,1),(12795,'ஓட்டப்பிடாரம்',241,1),(12796,'பி.துரைச்சாமிபுரம்',241,1),(12797,'பாஞ்சாலங்குறிச்சி',241,1),(12798,'பாறைக்குட்டம்',241,1),(12799,'பரிவல்லிக்கோட்டை',241,1),(12800,'பசுவந்தனை',241,1),(12801,'பட்டிணமருதூர்',241,1),(12802,'புதியம்புத்தூர்',241,1),(12803,'புதூர்பாண்டியாபுரம்',241,1),(12804,'எஸ்.குமாரபுரம்',241,1),(12805,'சாமிநத்தம்',241,1),(12806,'சங்கம்பட்டி',241,1),(12807,'சவரிமங்கலம்',241,1),(12808,'சில்லாநத்தம்',241,1),(12809,'சில்லாங்குளம்',241,1),(12810,'சிந்தலக்கட்டை',241,1),(12811,'தருவைக்குளம்',241,1),(12812,'தெற்கு வீரபாண்டியாபுரம்',241,1),(12813,'தெற்கு கல்மேடு',241,1),(12814,'வாலசமுத்திரம்',241,1),(12815,'வேடநத்தம்',241,1),(12816,'வெள்ளாரம்',241,1),(12817,'வெங்கடேஸ்வரபுரம்',241,1),(12818,'வேப்பலோடை',241,1),(12819,'அரசூர் பகுதி-1',242,1),(12820,'அரசூர் பகுதி-2',242,1),(12821,'செட்டியிருப்பு',242,1),(12822,'எழுவரைமுக்கி',242,1),(12823,'கருங்கடல்',242,1),(12824,'கட்டாரிமங்கலம்',242,1),(12825,'கோமானேரி',242,1),(12826,'கொம்பன்குளம்',242,1),(12827,'கொம்மடிக்கோட்டை',242,1),(12828,'மீரான்குளம் பகுதி-1',242,1),(12829,'மீரான்குளம் பகுதி-2',242,1),(12830,'முதலூர்',242,1),(12831,'நடுவக்குறிச்சி',242,1),(12832,'நெடுங்குளம்',242,1),(12833,'படுக்கப்பத்து',242,1),(12834,'பழங்குளம்',242,1),(12835,'பள்ளக்குறிச்சி',242,1),(12836,'பன்னம்பாறை',242,1),(12837,'பிடானேரி',242,1),(12838,'புதுக்குளம்',242,1),(12839,'சாஸ்தாவிநல்லூர்',242,1),(12840,'சாத்தான்குளம்',242,1),(12841,'ஸ்ரீவெங்கடேஸ்வரபுரம்',242,1),(12842,'தச்சமொழி',242,1),(12843,'திருப்பணிபுத்தன்தருவை',242,1),(12844,'ஆறாம்பண்ணை',243,1),(12845,'ஆலந்தா',243,1),(12846,'ஆழிகுடி',243,1),(12847,'ஆழ்வார்கற்குளம்',243,1),(12848,'அணியாபரநல்லூர்',243,1),(12849,'சேரகுளம்',243,1),(12850,'செட்டிமல்லன்பட்டி',243,1),(12851,'தெய்வச்செயல்புரம்',243,1),(12852,'எல்லைநாயக்கன்பட்டி',243,1),(12853,'கே.வரதராஜபுரம்',243,1),(12854,'கலியாவூர்',243,1),(12855,'கால்வாய்',243,1),(12856,'கருங்குளம்',243,1),(12857,'கீழவல்லநாடு',243,1),(12858,'கொங்கராயக்குறிச்சி',243,1),(12859,'முறப்பநாடுகீழப்புத்தனேரி',243,1),(12860,'முறப்பநாடுகோவில்பத்து',243,1),(12861,'முறப்பநாடுபுதுக்கிராமம்',243,1),(12862,'மணக்கரை',243,1),(12863,'முத்தலாங்குறிச்சி',243,1),(12864,'நாணல்காடு',243,1),(12865,'பத்மநாபமங்கலம்',243,1),(12866,'பராக்கிரமபாண்டி',243,1),(12867,'பேரூர்',243,1),(12868,'பூவாணி',243,1),(12869,'செய்துங்கநல்லூர்',243,1),(12870,'செக்காரக்குடி பகுதி -1',243,1),(12871,'செக்காரக்குடி பகுதி -2',243,1),(12872,'சிங்கத்தாகுறிச்சி',243,1),(12873,'ஸ்ரீமூலக்கரை',243,1),(12874,'ஸ்ரீபராங்குசநல்லூர்',243,1),(12875,'ஸ்ரீவைகுண்டம்',243,1),(12876,'தெற்கு காரசேரி',243,1),(12877,'திருப்புளியங்குடி',243,1),(12878,'தோழப்பன்பண்ணை',243,1),(12879,'உழக்குடி',243,1),(12880,'வீட்டிலாபுரம்கோவில்பத்து',243,1),(12881,'வடக்குகாரசேரி',243,1),(12882,'வல்லகுளம்',243,1),(12883,'வல்லநாடுகஸ்பா',243,1),(12884,'வடவல்லநாடு',243,1),(12885,'வசவப்பபுரம்',243,1),(12886,'வேளூர் ஆதிச்சநல்லூர்',243,1),(12887,'வேளூர் கஸ்பா',243,1),(12888,'வேளூர் புதுக்குடி',243,1),(12889,'விட்டிலாபுரம்',243,1),(12890,'அல்லிகுளம்',244,1),(12891,'அய்யனடைப்பு',244,1),(12892,'கட்டாலங்குளம்',244,1),(12893,'கீழத் தட்டப்பாறை',244,1),(12894,'கூட்டுடன்காடு',244,1),(12895,'கோரம்பள்ளம் பகுதி-1',244,1),(12896,'கோரம்பள்ளம் பகுதி-2',244,1),(12897,'குலையன்கரிசல்',244,1),(12898,'குமாரகிரி',244,1),(12899,'மாப்பிள்ளையூரணி',244,1),(12900,'மறவன்மடம்',244,1),(12901,'மீளவிட்டான் பகுதி-1',244,1),(12902,'மீளவிட்டான் பகுதி-2',244,1),(12903,'மேலத் தட்டப்பாறை',244,1),(12904,'முடிவைத்தானேந்தல்',244,1),(12905,'முள்ளக்காடு பகுதி-1',244,1),(12906,'முள்ளக்காடு பகுதி-2',244,1),(12907,'முத்துசாமிபுரம்',244,1),(12908,'வடக்கு சிலுக்கன்பட்டி',244,1),(12909,'பேரூரணி',244,1),(12910,'புலிப்பாஞ்சான்குளம்',244,1),(12911,'இராமநாதபுரம்',244,1),(12912,'இராமசாமிபுரம்',244,1),(12913,'சங்கரப்பேரி',244,1),(12914,'செந்திலாம்பண்ணை',244,1),(12915,'சேர்வைக்காரன்மடம்',244,1),(12916,'தெற்கு சிலுக்கன்பட்டி',244,1),(12917,'தளவாய்புரம்',244,1),(12918,'திம்மராஜபுரம்',244,1),(12919,'தூத்துக்குடி பகுதி-1',244,1),(12920,'தூத்துக்குடி பகுதி-2',244,1),(12921,'உமரிக்கோட்டை',244,1),(12922,'வரத்தகரெட்டிபட்டி',244,1),(12923,'ஆதியாக்குறிச்சி',245,1),(12924,'அம்மன்புரம்',245,1),(12925,'ஆறுமுகநேரி',245,1),(12926,'ஆத்தூர்கஸ்பா',245,1),(12927,'செட்டியாபத்து',245,1),(12928,'காலான்குடியுருப்பு',245,1),(12929,'கானம்',245,1),(12930,'கந்தசாமிபுரம்',245,1),(12931,'காயல்பட்டணம் வடபாகம்',245,1),(12932,'காயல்பட்டணம் தென்பாகம்',245,1),(12933,'காயாமொழி',245,1),(12934,'கீழத்திருச்செந்தூர்',245,1),(12935,'குலசேகரன்பட்டணம்',245,1),(12936,'குதிரைமொழி',245,1),(12937,'லெட்சுமிபுரம்',245,1),(12938,'மாதவன்குறிச்சி',245,1),(12939,'மானாடுதண்டுபத்து',245,1),(12940,'மணப்பாடு',245,1),(12941,'மெஞ்ஞானபுரம்',245,1),(12942,'மேலத்திருச்செந்தூர்',245,1),(12943,'மேலஆத்தூர்',245,1),(12944,'மூலக்கரை',245,1),(12945,'நல்லூர்',245,1),(12946,'நங்கைமொழி',245,1),(12947,'நத்தக்குளம்',245,1),(12948,'பள்ளிப்பத்து',245,1),(12949,'பரமன்குறிச்சி',245,1),(12950,'புன்னக்காயல்',245,1),(12951,'செம்மறிகுளம்',245,1),(12952,'சேர்ந்தமங்கலம்',245,1),(12953,'சுகந்தலை..',245,1),(12954,'உடன்குடி',245,1),(12955,'வாகைவிளை',245,1),(12956,'வீரமாணிக்கம்',245,1),(12957,'வீரபாண்டியபட்டணம்',245,1),(12958,'வெங்கட்டராமானுஜபுரம்',245,1),(12959,'ஏ.சுப்ரமணியபுரம்',246,1),(12960,'அரியநாயகிபுரம்',246,1),(12961,'அருங்குளம்',246,1),(12962,'ஆற்றங்கரை',246,1),(12963,'அயன்பொம்மையாபுரம்',246,1),(12964,'அயன்செங்கல்படை',246,1),(12965,'பூதலாபுரம்',246,1),(12966,'சின்னூர்',246,1),(12967,'சித்தவநாயக்கன்பட்டி',246,1),(12968,'இ.வேலாயுதபுரம்',246,1),(12969,'இனாம்வடமலாபுரம்',246,1),(12970,'குருவார்பட்டி',246,1),(12971,'கே.துரைச்சாமிபுரம்',246,1),(12972,'கே.குமரெட்டையாபுரம்',246,1),(12973,'கே.தங்கம்மாள்புரம்',246,1),(12974,'காடல்குடி',246,1),(12975,'கல்லூரணி',246,1),(12976,'கமலாபுரம்',246,1),(12977,'கந்தசாமிபுரம்',246,1),(12978,'கன்னிமார்குட்டம்',246,1),(12979,'கவுண்டன்பட்டி',246,1),(12980,'கீழவிளாத்திக்குளம் பகுதி-1',246,1),(12981,'கீழவிளாத்திக்குளம் பகுதி-2',246,1),(12982,'கூத்தலூரணி',246,1),(12983,'கோட்டநத்தம்',246,1),(12984,'குளக்கட்டாக்குறிச்சி',246,1),(12985,'குளத்தூர் கிழக்கு..',246,1),(12986,'குளத்தூர் தெற்கு',246,1),(12987,'குளத்தூர்வடக்கு',246,1),(12988,'குமாரசித்தன்பட்டி',246,1),(12989,'எஸ்.குமாரகிரி',246,1),(12990,'குமாரலிங்கபுரம்',246,1),(12991,'குமாரசக்கானபுரம்',246,1),(12992,'குறளையம்பட்டி',246,1),(12993,'லெட்சுமிபுரம்',246,1),(12994,'எம்.சுப்ரமணியபுரம்',246,1),(12995,'எம்.கோடாங்கிபட்டி',246,1),(12996,'எம்.குமாரசக்கானபுரம்',246,1),(12997,'எம்.சண்முகபுரம்',246,1),(12998,'மாதலாபுரம்',246,1),(12999,'மல்லீஸ்வரபுரம்',246,1),(13000,'மந்திகுளம்',246,1),(13001,'மணியக்காரன்பட்டி',246,1),(13002,'மார்த்தாண்டம்பட்டி',246,1),(13003,'மாதராஜபுரம்',246,1),(13004,'மாவிலோடை',246,1),(13005,'மேலக்கல்லூரணி',246,1),(13006,'மேல்மாந்தை',246,1),(13007,'மெட்டில்பட்டி',246,1),(13008,'முத்தையாபுரம்',246,1),(13009,'முத்துசாமிபுரம்',246,1),(13010,'என்.ஜெகவீரபுரம்',246,1),(13011,'நடுக்காட்டூர்',246,1),(13012,'நாகலாபுரம்',246,1),(13013,'நமசிவாயபுரம்',246,1),(13014,'நெடுங்குளம்',246,1),(13015,'பி.ஜெகவீரபுரம்',246,1),(13016,'பல்லாகுளம்',246,1),(13017,'பட்டிதேவன்பட்டி',246,1),(13018,'பெரியசாமிபுரம்',246,1),(13019,'பூசனூர்',246,1),(13020,'புதூர்',246,1),(13021,'புளியங்குளம்',246,1),(13022,'இராமச்சந்திராபுரம்',246,1),(13023,'சக்கம்மாள்புரம்',246,1),(13024,'சங்கரலிங்கபுரம்',246,1),(13025,'செங்கோட்டை',246,1),(13026,'சென்னம்பட்டி',246,1),(13027,'சிவஞானபுரம்',246,1),(13028,'சிவலார்பட்டி',246,1),(13029,'சிவபெருங்குன்றம்',246,1),(13030,'சூரங்குடி',246,1),(13031,'சுப்பையாபுரம்',246,1),(13032,'சுந்தரப்பச்சையாபுரம்',246,1),(13033,'டி.சுப்பையாபுரம்',246,1),(13034,'தத்தனேரி',246,1),(13035,'வி.வேடப்பட்டி',246,1),(13036,'வைப்பார் பகுதி-1',246,1),(13037,'வைப்பார் பகுதி-2',246,1),(13038,'வன்னிப்பட்டி',246,1),(13039,'வாதலக்கரை',246,1),(13040,'வீரபாண்டியபுரம்',246,1),(13041,'வெள்ளையம்மாள்புரம்',246,1),(13042,'வேம்பார்',246,1),(13043,'விளாத்திகுளம்',246,1),(13044,'விருசம்பட்டி',246,1),(13045,'வௌவால்தொத்தி',246,1),(13046,'ஜமீன் கரிசல்குளம்',246,1),(13047,'ஜமீன்செங்கல்படை',246,1),(13048,'அடையக்கருங்குளம்',247,1),(13049,'ஆலடியூர் -1',247,1),(13050,'ஆலடியூர் -2',247,1),(13051,'அயன் சிங்கம்பட்டி',247,1),(13052,'அயன்திருவாலிஸ்வரம்',247,1),(13053,'பிரம்மதேசம்',247,1),(13054,'இடைகால் பகுதி இரண்டு',247,1),(13055,'இடைகால் பகுதி ஒன்று',247,1),(13056,'ஈசானமடம்',247,1),(13057,'கல்லிடைக்குறிச்சி வடக்கு',247,1),(13058,'கீழ்முகம்',247,1),(13059,'கீழ் அம்பாசமுத்திரம்',247,1),(13060,'கோடாரங்குளம்',247,1),(13061,'மன்னர்மங்கலம்',247,1),(13062,'மன்னார்கோவில்',247,1),(13063,'மேல அம்பாசமுத்திரம்',247,1),(13064,'பள்ளக்கால்',247,1),(13065,'பணஞ்சாடி',247,1),(13066,'ரெங்கசமுத்திரம்',247,1),(13067,'சாட்டுப்பத்து',247,1),(13068,'சிங்கம்பட்டி ஜமின்- 1',247,1),(13069,'சிங்கம்பட்டி ஜமின்-2',247,1),(13070,'சிவந்திபுரம்',247,1),(13071,'தெற்குகல்லிடைக்குறிச்சி-1',247,1),(13072,'தெற்குகல்லிடைக்குறிச்சி-2',247,1),(13073,'தெற்கு பாப்பான்குளம்',247,1),(13074,'திம்மராஜசமுத்திரம்',247,1),(13075,'ஊரகாடு',247,1),(13076,'வாகைக்குளம்',247,1),(13077,'வைராவிகுளம்',247,1),(13078,'வெள்ளங்குளி',247,1),(13079,'விக்கிரமசிங்கபுரம்-1',247,1),(13080,'விக்கிரமசிங்கபுரம்-2',247,1),(13081,'ஏகாம்பரபுரம்',247,1),(13082,'அரசன்குளம்',248,1),(13083,'அரிகேசவநல்லூர்',248,1),(13084,'அத்தாளநல்லூர்',248,1),(13085,'சேரன் கோவில்பத்து',248,1),(13086,'சேரன்மகாதேவி',248,1),(13087,'சொக்கலிங்கபுரம்',248,1),(13088,'தேசமாணிக்கம்',248,1),(13089,'கிரியம்மாள்புரம்',248,1),(13090,'கோபாலசமுத்திரம்',248,1),(13091,'இலுப்பைகுறிச்சி',248,1),(13092,'கபாலிபாறை',248,1),(13093,'கரிசல்பட்டி',248,1),(13094,'கரிசூழ்ந்தமங்கலம்',248,1),(13095,'காசிதர்மம்',248,1),(13096,'கீழச்செவல்',248,1),(13097,'கேசவசமுத்திரம்',248,1),(13098,'கொழுமடை',248,1),(13099,'கூனியூர்',248,1),(13100,'மலையான்குளம்',248,1),(13101,'மானாபரநல்லூர்',248,1),(13102,'மேலச்செவல் பகுதி-1',248,1),(13103,'மேலச்செவல் பகுதி-2',248,1),(13104,'முககூடல்',248,1),(13105,'நயினார்குளம்',248,1),(13106,'ஓமநல்லூர்',248,1),(13107,'பாப்பாக்குடி பகுதி-1',248,1),(13108,'பாப்பாக்குடி பகுதி-2',248,1),(13109,'பத்தமடை',248,1),(13110,'பிராஞ்சேரி',248,1),(13111,'பூங்குடையார்குளம்',248,1),(13112,'பதுக்குடி',248,1),(13113,'செங்குளம்',248,1),(13114,'தென்திருப்புவனம்',248,1),(13115,'தெற்கு அரியநாயகிபுரம்',248,1),(13116,'தெற்கு காருகுறிச்சி தெற்கு வீரவநல்லூர் பகுதி-1',248,1),(13117,'தெற்கு வீரவநல்லூர் பகுதி-2',248,1),(13118,'திருப்புடைமருதூர்',248,1),(13119,'திருத்து',248,1),(13120,'திருவிருந்தான்புள்ளி பகுதி-1',248,1),(13121,'திருவிருந்தான்புள்ளி பகுதி-2',248,1),(13122,'உதயமார்த்தாண்டபுரம்',248,1),(13123,'உலகன்குளம்',248,1),(13124,'உமையம்மாள்புரம்',248,1),(13125,'வடக்கு காருகுறிச்சி',248,1),(13126,'வடககு வீரவநல்லூர் பகுதி-2',248,1),(13127,'வடக்கு வீரவநல்லூர் பகுதி-1',248,1),(13128,'வடக்குஅரியநாயகிபுரம் பகுதி-1',248,1),(13129,'வடக்க அரியநாயகிபுரம் பகுதி-2',248,1),(13130,'வீற்றிருந்தான்குளம்',248,1),(13131,'வெங்கட்ரெங்கபுரம்',248,1),(13132,'அழகியபாண்டியபுரம்',249,1),(13133,'அச்சம்பட்டி',249,1),(13134,'சித்தார்சத்திரம்',249,1),(13135,'எட்டான்குளம்',249,1),(13136,'களக்குடி',249,1),(13137,'கானார்பட்டி',249,1),(13138,'கட்டாரங்குளம்',249,1),(13139,'குறிச்சிக்குளம்',249,1),(13140,'மதவக்குறிச்சி',249,1),(13141,'மானூர்',249,1),(13142,'மாவடி',249,1),(13143,'மேல இலந்தைக் குளம்',249,1),(13144,'மூவிருந்தாளி',249,1),(13145,'நாஞ்சான்குளம்',249,1),(13146,'நரக்குடி',249,1),(13147,'பல்லிக்கோட்டை',249,1),(13148,'பிள்ளையார்குளம்',249,1),(13149,'பிராஞ்சேரி',249,1),(13150,'சேதுராயன்புதூர்',249,1),(13151,'செழியநல்லூர்',249,1),(13152,'சுண்டங்குறிச்சி',249,1),(13153,'தடியம்பட்டி',249,1),(13154,'தாழையூத்து',249,1),(13155,'தென்கலம்',249,1),(13156,'தெற்குப்பட்டி',249,1),(13157,'தேவர்குளம்',249,1),(13158,'துலுக்கர்பட்டி',249,1),(13159,'உக்கிரன்கோட்டை',249,1),(13160,'வாகைகுளம்',249,1),(13161,'வல்லவன் கோட்டை',249,1),(13162,'வன்னிக்கோனேந்தல்',249,1),(13163,'வெள்ளப்பனேரி',249,1),(13164,'அ-சாத்தான்குளம்',250,1),(13165,'ஆலங்குளம்',250,1),(13166,'ஆழ்வாநேரி',250,1),(13167,'அரியகுளம்',250,1),(13168,'சீவலப்பேரி',250,1),(13169,'செங்களாக்குறிச்சி',250,1),(13170,'சிங்கநேரி',250,1),(13171,'தேவநல்லூர்',250,1),(13172,'இடையன்குளம்',250,1),(13173,'இளையார்குளம்',250,1),(13174,'இனாம் இடையன்குளம்',250,1),(13175,'இறைப்புவாரி',250,1),(13176,'ஏர்வாடி பகுதி-1',250,1),(13177,'ஏர்வாடி பகுதி-2',250,1),(13178,'காரங்காடு',250,1),(13179,'கடம்போடுவாழ்வு',250,1),(13180,'காடான்குளம்',250,1),(13181,'திருமலாபுரம்',250,1),(13182,'களக்காடு பகுதி-1',250,1),(13183,'களக்காடு பகுதி-2',250,1),(13184,'கள்ளிகுளம்',250,1),(13185,'கரந்தாநேரி',250,1),(13186,'கீழகாடுவெட்டி',250,1),(13187,'கீழக்கருவேலன்குளம்',250,1),(13188,'கோவிலம்மாள்புரம்',250,1),(13189,'கூந்தன்குளம்',250,1),(13190,'மடம் ஆலங்குளம்',250,1),(13191,'மலையடிப்புதூர்',250,1),(13192,'மறுகால்குறிச்சி',250,1),(13193,'மகிழடி',250,1),(13194,'மேலமலையநேரி',250,1),(13195,'மேலபுத்தனேரி',250,1),(13196,'மேல்கரை',250,1),(13197,'மூலைக்கரைப்பட்டி பகுதி-1',250,1),(13198,'மூலைக்கரைப்பட்டி பகுதி-2',250,1),(13199,'முனைஞ்சிப்பட்டி',250,1),(13200,'நம்பிபுரம்',250,1),(13201,'நம்பிதலைவன்பட்டயம்',250,1),(13202,'நாங்குநேரி',250,1),(13203,'பாப்பான்குளம்',250,1),(13204,'படலையார குளம்',250,1),(13205,'பம்பன்குளம்',250,1),(13206,'பத்தை பாகம்-1',250,1),(13207,'பத்தை பாகம்-2',250,1),(13208,'பத்மநேரி',250,1),(13209,'பழங்குளம்',250,1),(13210,'புலம் பாக்கம்-1',250,1),(13211,'புலம் பாக்கம்-2',250,1),(13212,'புலியூர்குறிச்சி',250,1),(13213,'இராஜக்கள்மங்கலம் பகுதி-2',250,1),(13214,'இராஜக்கள்மங்கலம் பகுதி-1',250,1),(13215,'செண்பகராமநல்லூர்',250,1),(13216,'சிங்கிகுளம் பழைய கிராம்',250,1),(13217,'சிங்கிகுளம் புதுக்கிராமம்',250,1),(13218,'சித்தாமணி',250,1),(13219,'சூரன்குடி',250,1),(13220,'தெற்கு நாங்குநேரி',250,1),(13221,'‌‍‌‌‍ ‌ஶ்ரீவரமங்கைபுரம்',250,1),(13222,'தளபதிசமுத்திரம் பகுதி-1',250,1),(13223,'தெய்வநாயப்பேரி',250,1),(13224,'தென்னீர்குளம்',250,1),(13225,'திருக்குறுங்குடி பகுதி-1',250,1),(13226,'திருக்குறுங்குடி பகுதி-2',250,1),(13227,'திருவரங்கநேரி',250,1),(13228,'தோட்டாக்குடி',250,1),(13229,'உன்னங்குளம்',250,1),(13230,'ஊச்சிகுளம்',250,1),(13231,'வடகரை',250,1),(13232,'வடமலை சமுத்திரம்',250,1),(13233,'வடுகச்சிமதில்',250,1),(13234,'வேப்பன்குளம்',250,1),(13235,'வில்வராயன்குளம்',250,1),(13236,'இலங்குளம்',250,1),(13237,'ஆரைகுளம்',251,1),(13238,'அரியகுளம்',251,1),(13239,'அவனாப்பேரி',251,1),(13240,'செங்குளம்',251,1),(13241,'இட்டேரி',251,1),(13242,'கங்கைநாடார் குளம்',251,1),(13243,'கான்சாபுரம்',251,1),(13244,'கருப்பந்துரை',251,1),(13245,'கீழநத்தம்',251,1),(13246,'கீழப்பாட்டம்',251,1),(13247,'கீழத்திருவேங்கடநாதபுரம்',251,1),(13248,'கீழவீரராகவபுரம்',251,1),(13249,'கொக்கட்டி குளம்',251,1),(13250,'கொங்கந்தான்பாறை',251,1),(13251,'கிருஷ்ணாபுரம்',251,1),(13252,'குலவணிகர்புரம்',251,1),(13253,'குன்னத்தூர்',251,1),(13254,'குறவர்குளம்',251,1),(13255,'மணப்படை வீடு',251,1),(13256,'மருதூர்',251,1),(13257,'மேலநத்தம்',251,1),(13258,'மேலப்பாளையம்',251,1),(13259,'மேலப்பாட்டம்',251,1),(13260,'மேலப்புத்தனேரி',251,1),(13261,'மேலத்திடியூர்',251,1),(13262,'மேலத்திருவேங்கடநாதபுரம்',251,1),(13263,'முன்னீரபள்ளம்',251,1),(13264,'முத்தூர்',251,1),(13265,'முத்தூர் ரெட்டியார்பட்டி',251,1),(13266,'நடுக்கமுடையாரகுளம்',251,1),(13267,'நடுவக்குறிச்சி',251,1),(13268,'நொச்சிகுளம்',251,1),(13269,'பாளையங்கோட்டை ப-1',251,1),(13270,'பாளையங்கோட்டை ப-2',251,1),(13271,'பாளையங்கோட்டை ப-3',251,1),(13272,'பாளையஞ் செட்டிகுளம்',251,1),(13273,'பனையன்குளம்',251,1),(13274,'பாறைக்குளம்',251,1),(13275,'பற்பகுளம்',251,1),(13276,'பொன்னாக்குடி',251,1),(13277,'புதுக்குளம்',251,1),(13278,'இராஜகோபாலபுரம்',251,1),(13279,'ரெட்டியார்பட்டி',251,1),(13280,'சீவல்ப்பேரி',251,1),(13281,'சிவனடியாரகுளம்',251,1),(13282,'சிவந்திப்பட்டி',251,1),(13283,'தருவை',251,1),(13284,'திடியூர்',251,1),(13285,'திம்மராஜபுரம்',251,1),(13286,'திருமலைக்கொழுந்துபுரம்',251,1),(13287,'திருத்து',251,1),(13288,'திருவண்ணாபுரம்',251,1),(13289,'உடையாரகுளம்',251,1),(13290,'உத்தமபாண்டியன்குளம்',251,1),(13291,'வாகைகுளம்',251,1),(13292,'வேலன்குளம்',251,1),(13293,'வெள்ளக் கோவில்',251,1),(13294,'வெங்களுநீர் சமுத்திரம்',251,1),(13295,'விஜயராகவமுதலியாரசத்திரம்',251,1),(13296,'விளாகம்',251,1),(13297,'அடங்கார் குளம்',252,1),(13298,'அழகனேரி',252,1),(13299,'ஆலங்கிணறு திருமலாபுரம்',252,1),(13300,'ஆனைகுளம்',252,1),(13301,'அச்சம்பாடு',252,1),(13302,'செட்டிகுளம்',252,1),(13303,'இருக்கன்துறை பகுதி-1',252,1),(13304,'இருக்கன்துறை பகுதி-2',252,1),(13305,'கருங்குளம்',252,1),(13306,'கூடங்குளம்',252,1),(13307,'கும்பிகுளம்',252,1),(13308,'லெவிஞ்சிபுரம்',252,1),(13309,'பணகுடி பகுதி-1',252,1),(13310,'பணகுடி பகுதி-2',252,1),(13311,'பரமேஸ்வரபுரம்',252,1),(13312,'பரிவிரிசூரியன்',252,1),(13313,'பழவூர் பகுதி-1',252,1),(13314,'பழவூர் பகுதி-2',252,1),(13315,'பெருங்குடி பகுதி-1',252,1),(13316,'பெருங்குடி பகுதி_2',252,1),(13317,'இராதாபுரம்',252,1),(13318,'சடையனேரி',252,1),(13319,'சமூகரெங்கபுரம்',252,1),(13320,'செளத்திரபாண்டியபுரம்',252,1),(13321,'தனக்கரகுளம்',252,1),(13322,'தண்டையார்குளம்',252,1),(13323,'தெற்குகள்ளிகுளம்',252,1),(13324,'திருவம்பலபுரம்',252,1),(13325,'உதயத்தூர்',252,1),(13326,'வடக்கு வள்ளியூர் பகுதி-1',252,1),(13327,'வடக்கு வள்ளியூர் பகுதி-2',252,1),(13328,'தெற்கு வள்ளியூர் பகுதி-1',252,1),(13329,'தெற்கு வள்ளியூர் பகுதி_2',252,1),(13330,'வேப்பிலான்குளம் பகுதி-2',252,1),(13331,'வேப்பிலான்குளம் பகுதி-1',252,1),(13332,'விஜயாபதி',252,1),(13333,'அப்புவிளை',253,1),(13334,'இட்டமொழி',253,1),(13335,'கண்ணநல்லூர்',253,1),(13336,'கரைசுத்துபுதூர்',253,1),(13337,'கரைசுத்து உவரி',253,1),(13338,'கஸ்தூரிரெங்கபுரம் பகுதி-2',253,1),(13339,'கஸ்தூரிரெங்கபுரம் பகுதி-1',253,1),(13340,'கோட்டைக் கருங்குளம் பகுதி-2',253,1),(13341,'கோட்டைக் கருங்குளம் பகுதி-1',253,1),(13342,'கோவன்குளம்',253,1),(13343,'குமாரபுரம்',253,1),(13344,'குட்டம்',253,1),(13345,'முதுமொத்தான்மொழி',253,1),(13346,'இராமகிருஷ்ணாபுரம்',253,1),(13347,'சடையநேரி',253,1),(13348,'திசையன்விளை',253,1),(13349,'உறுமன்குளம்',253,1),(13350,'விஜயநாராயணம் பகுதி-1',253,1),(13351,'விஜயநாராயணம் பகுதி-2',253,1),(13352,'விஜயநாராயணம் பகுதி-3',253,1),(13353,'விஜயநாராயணம் பகுதி-4',253,1),(13354,'அபிஷேகப்பட்டி',254,1),(13355,'அழகனேரி',254,1),(13356,'அழகனேரி',254,1),(13357,'அலஙகாரபேரி',254,1),(13358,'அனந்த கிருஷ்ண்ர்புரம்',254,1),(13359,'அருகன்குளம்',254,1),(13360,'சத்திரம் புதுக்குளம்',254,1),(13361,'கங்கைகொண்டான்-1',254,1),(13362,'கங்கைகொண்டான்-2',254,1),(13363,'கல்குறிச்சி',254,1),(13364,'கண்டியபேரி பகுதி-1',254,1),(13365,'கண்டியபேரி பகுதி-2',254,1),(13366,'கரையிருப்பு',254,1),(13367,'கருங்காடு',254,1),(13368,'கருவநல்லூர்',254,1),(13369,'கருவேலங்குளம்',254,1),(13370,'கட்டளை உதயநேரி',254,1),(13371,'காட்டாம்புளி',254,1),(13372,'கோடகநல்லூர்',254,1),(13373,'கொண்டாநகரம்',254,1),(13374,'குப்பகுறிச்சி',254,1),(13375,'மணிமூரத்தீஸ்வரம்',254,1),(13376,'மேகமுடையாரகுளம்',254,1),(13377,'மேலக்கல்லூர்',254,1),(13378,'மேலவீரராகவபுரம்',254,1),(13379,'நாரணம்மாள்புரம் பகுதி-1',254,1),(13380,'நாரணம்மாள்புரம் பகுதி-2',254,1),(13381,'நரசிங்க நல்லூர்',254,1),(13382,'பாலாமடை',254,1),(13383,'பழவுர்',254,1),(13384,'பதினாலாம்பேரி',254,1),(13385,'பேட்டை-1',254,1),(13386,'பேட்டை-2',254,1),(13387,'பிள்ளையன்கட்டளை',254,1),(13388,'பிராயன்குளம்',254,1),(13389,'புதூர்',254,1),(13390,'ராஜவல்லிபுரம்',254,1),(13391,'ராமலிங்கனேர',254,1),(13392,'ராமையன்பட்டி',254,1),(13393,'சமூகரெங்கய்யன்கட்டளை',254,1),(13394,'சங்கன்திரடு',254,1),(13395,'சீதபற்பநல்லூர்',254,1),(13396,'சேந்திமங்கலம்',254,1),(13397,'சிந்திபுந்துரை',254,1),(13398,'சிறுக்கன் குறிச்சி',254,1),(13399,'சிவகுருநாதன் திருத்து',254,1),(13400,'சிவனியாரகுளம்',254,1),(13401,'சுத்தமல்லி',254,1),(13402,'தச்சநல்லூர்',254,1),(13403,'தென்பத்து',254,1),(13404,'திருப்பணி நெல்லையாபுரம்',254,1),(13405,'துலக்கரகுளம்',254,1),(13406,'துவராசி',254,1),(13407,'திருநெல்வேலி',254,1),(13408,'உதயனேரி',254,1),(13409,'உகந்தான்பட்டி',254,1),(13410,'வடுகம்பட்டி',254,1),(13411,'வாகைகுளம்-ம',254,1),(13412,'வேளாரகுளம்',254,1),(13413,'வேப்பங்குளம்',254,1),(13414,'வெட்டுவான்குளம்',254,1),(13415,'ஆலாங்குப்பம்',255,1),(13416,'ஆம்பர்',255,1),(13417,'அயித்தம்பட்டு',255,1),(13418,'பைரப்பள்ளி',255,1),(13419,'பாவர்தம்பட்டடை',255,1),(13420,'சின்னபள்ளிகுப்பம்',255,1),(13421,'சின்னவரிகம்',255,1),(13422,'தேவலாபரம்',255,1),(13423,'ஈச்சம்பட்டு',255,1),(13424,'கைலாசகிரி',255,1),(13425,'கம்மகிருஷ்ணாபள்ளி',255,1),(13426,'கம்மியம்பட்டு',255,1),(13427,'கன்னடிகுப்பம்',255,1),(13428,'காரப்பட்டு',255,1),(13429,'கரும்பூர்',255,1),(13430,'கதவாலம்',255,1),(13431,'கீழ்முருங்கை',255,1),(13432,'கொம்மேஸ்வரம்',255,1),(13433,'கொம்மேஸ்வரம்',255,1),(13434,'குளிதிகை',255,1),(13435,'குமாரமங்கலம்',255,1),(13436,'லப்பைமாங்குப்பம்',255,1),(13437,'எம்.எஸ்.குப்பம்',255,1),(13438,'மாதனூர்',255,1),(13439,'மலையம்பட்டு',255,1),(13440,'மணியாரகுப்பம்',255,1),(13441,'மேல்கிருஷ்ணாபுரம்',255,1),(13442,'மின்னூர்',255,1),(13443,'மிட்டாளம்',255,1),(13444,'நாச்சார்குப்பம்',255,1),(13445,'நாய்க்கனேரி',255,1),(13446,'நாயக்கனேரி(காமனூர்தட்டு)',255,1),(13447,'நாயக்கனேரி(பனங்காட்டோரி)',255,1),(13448,'நரியம்பட்டு',255,1),(13449,'பாலூர்',255,1),(13450,'பாப்பனபள்ளி',255,1),(13451,'பார்சனபள்ளி',255,1),(13452,'பெரியாங்குப்பம்',255,1),(13453,'பெரியவரிகம்',255,1),(13454,'சாணாங்குப்பம்',255,1),(13455,'சாத்தம்பாக்கம்',255,1),(13456,'செங்கிலிகுப்பம்',255,1),(13457,'சோலூர்',255,1),(13458,'சோமலாபுரம்',255,1),(13459,'தென்னம்பட்டு',255,1),(13460,'திருமலைகுப்பம்',255,1),(13461,'தோட்டாலம்',255,1),(13462,'துத்திபட்டு',255,1),(13463,'வடசேரி',255,1),(13464,'வடகரை',255,1),(13465,'வடபுதுப்பட்டு',255,1),(13466,'வீராங்குப்பம்',255,1),(13467,'வெள்ளக்கல்',255,1),(13468,'வெங்கிலி',255,1),(13469,'வெங்கடசமுத்திரம்',255,1),(13470,'விண்ணமங்கலம்',255,1),(13471,'அக்ரஹாரம்',256,1),(13472,'அம்மணாங்கோயில்',256,1),(13473,'ஆத்தூர்குப்பம்',256,1),(13474,'பெத்தகல்லுப்பள்ளி',256,1),(13475,'பையனப்பள்ளி',256,1),(13476,'சந்திரபுரம்',256,1),(13477,'சின்னமோட்டூர்',256,1),(13478,'குருபவானிகுண்டா',256,1),(13479,'கத்தாரி',256,1),(13480,'கேதாண்டபட்டி',256,1),(13481,'கொல்லங்குட்டை',256,1),(13482,'கொத்தூர்',256,1),(13483,'குடியானகுப்பம்',256,1),(13484,'மல்லகுண்டா',256,1),(13485,'மல்லங்குப்பம்',256,1),(13486,'மல்லபள்ளி',256,1),(13487,'மூக்கனூர்',256,1),(13488,'நாட்றம்பள்ளி',256,1),(13489,'நாயணசெருவு',256,1),(13490,'கே.பந்தாரபள்ளி',256,1),(13491,'பணியாண்டப்பள்ளி',256,1),(13492,'பச்சூர்',256,1),(13493,'புத்தகரம்',256,1),(13494,'சொரக்காயல்நத்தம்',256,1),(13495,'தெக்குபட்டு',256,1),(13496,'திரியாலம்',256,1),(13497,'தோப்பலகுண்டா',256,1),(13498,'வெலக்கல்நத்தம்',256,1),(13499,'வேட்டப்பட்டு',256,1),(13500,'விருபாட்சிபுரம்',256,1),(13501,'ஏ.கே.மோட்டூர்',257,1),(13502,'அச்சமங்கலம்',322,1),(13503,'ஆதியூர்',322,1),(13504,'ஆண்டியம்பணூர்',257,1),(13505,'ஆவல்நாயக்கன்பட்டி',322,1),(13506,'பதனவாடி',322,1),(13507,'பொம்மிகுப்பம்',257,1),(13508,'சக்கரகுப்பம்',257,1),(13509,'சின்னகண்ணாலப்பட்டி',322,1),(13510,'சின்னகந்திலி',322,1),(13511,'சின்னாரம்பட்டி',322,1),(13512,'சொக்கனாம்பட்டி',322,1),(13513,'ஏலகிரி கிராமம்',257,1),(13514,'ஏலகிரிமலை',257,1),(13515,'எலவம்பட்டி',322,1),(13516,'எர்ரம்பட்டி',322,1),(13517,'கெங்கிநாயக்கன்பட்டி',322,1),(13518,'கும்மிடிகாம்பட்டி',322,1),(13519,'இருனாப்பட்டி',257,1),(13520,'ஜோலார்பேட்டை',257,1),(13521,'கதிரம்பட்டி',322,1),(13522,'கதிரிமங்கலம்',257,1),(13523,'காக்கங்கரை',322,1),(13524,'கந்திலி',322,1),(13525,'கருங்காலிபட்டி',322,1),(13526,'கசிநாயக்கன்பட்டி',322,1),(13527,'கட்டேரி',257,1),(13528,'கோனேரிகுப்பம்',257,1),(13529,'கூடப்பட்டு',257,1),(13530,'கொரட்டி',322,1),(13531,'கிருஷ்ணாபுரம்',322,1),(13532,'குனிச்சி',322,1),(13533,'குரிசிலாப்பட்டு',257,1),(13534,'குரும்பேரி',257,1),(13535,'லக்கிநாயக்கன்பட்டி',322,1),(13536,'மாடப்பள்ளி',257,1),(13537,'மண்டலநாபணகுண்டா',322,1),(13538,'மண்டலவாடி',257,1),(13539,'மரிமாணிகுப்பம்',257,1),(13540,'மட்றப்பள்ளி',322,1),(13541,'மொளகரம்பட்டி',322,1),(13542,'நாச்சார்குப்பம்',257,1),(13543,'நரவிந்தம்பட்டி',322,1),(13544,'நரியனேரி',322,1),(13545,'நத்தம்',322,1),(13546,'நெல்லிவாசல்நாடு',257,1),(13547,'பாச்சல்',257,1),(13548,'பால்னாங்குப்பம்',257,1),(13549,'பேராம்பட்டு',257,1),(13550,'பெரியகரம்',322,1),(13551,'பெரியகண்ணாலப்பட்டி',322,1),(13552,'பெருமாப்பட்டு',257,1),(13553,'பொன்னேரி',257,1),(13554,'பூங்குளம்',257,1),(13555,'புதுப்பட்டி',322,1),(13556,'புதூர்நாடு',257,1),(13557,'புங்கம்பட்டுநாடு',257,1),(13558,'ராச்சமங்கலம்',257,1),(13559,'சு.பள்ளிபட்டு',322,1),(13560,'செவ்வாத்தூர்',322,1),(13561,'சிம்மணபுதூர்',257,1),(13562,'சுந்தரம்பள்ளி',322,1),(13563,'தோக்கியம்',322,1),(13564,'திருப்பத்தூர் நகரம்',257,1),(13565,'திருப்பத்தூர் கிராமம்',322,1),(13566,'உடையாமுத்தூர்',257,1),(13567,'வெங்களாபுரம்',257,1),(13568,'விஷமங்கலம்',257,1),(13569,'ஆலங்காயம்',258,1),(13570,'அலசந்தாபுரம்',258,1),(13571,'அம்பலூர்',258,1),(13572,'ஆம்பூர்பேட்டை',258,1),(13573,'பீமகுளம்',258,1),(13574,'சிக்கனாங்குப்பம்',258,1),(13575,'சின்னவேப்பம்பட்டு',258,1),(13576,'தேவஸ்தானம்',258,1),(13577,'இளையநகரம்',258,1),(13578,'கிரிசமுத்திரம்',258,1),(13579,'கோவிந்தாபுரம்',258,1),(13580,'ஜவ்வாதுராமசமுத்திரம்',258,1),(13581,'கலந்திரா',258,1),(13582,'கவுக்காபட்டு',258,1),(13583,'கொடுகுமாணிபட்டடை',258,1),(13584,'கொல்லகுப்பம்',258,1),(13585,'கொல்லபள்ளி',258,1),(13586,'கொத்தகோட்டை',258,1),(13587,'மதனாஞ்சேரி',258,1),(13588,'நாயக்கனூர்',258,1),(13589,'நரசிங்கபுரம்',258,1),(13590,'நாராயணபுரம்',258,1),(13591,'நெக்னாமலை',258,1),(13592,'நிம்மியம்பட்டு',258,1),(13593,'பெத்தூர்',258,1),(13594,'புள்ளூர்',258,1),(13595,'ராமநாராயக்கன்பேட்டை',258,1),(13596,'ரெட்டியூர்',258,1),(13597,'சிமுக்கம்பட்டு',258,1),(13598,'சிந்தகமானிபெண்டா',258,1),(13599,'திம்மாம்பேட்டை',258,1),(13600,'தும்பேரி',258,1),(13601,'உதயேந்திரம்',258,1),(13602,'வடக்குபட்டு',258,1),(13603,'வளையாம்பட்டு',258,1),(13604,'வள்ளிபட்டு',258,1),(13605,'வாணியம்பாடி நகரம்',258,1),(13606,'வாணியம்பாடி கிராமம்',258,1),(13607,'வெள்ளகுட்டை',258,1),(13608,'வெங்கடராஜபுரம்',258,1),(13609,'வெளதிகமாணிபெண்டா',258,1),(13610,'ஆலத்தூர்',259,1),(13611,'அவிநாசி',259,1),(13612,'அய்யம்பாளையம்',259,1),(13613,'சின்னாரிபாளையம்',259,1),(13614,'ஈட்டிவீரம்பாளையம்',259,1),(13615,'காளிபாளையம்',259,1),(13616,'கணியாம்பூண்டி',259,1),(13617,'கானூர்',259,1),(13618,'கருமாபாளையம்',259,1),(13619,'கருவலூர்',259,1),(13620,'குப்பாண்டம்பாளையம்',259,1),(13621,'குட்டகம்',259,1),(13622,'மங்கரசவலையபாளையம்',259,1),(13623,'மேற்குபதி',259,1),(13624,'முறியாண்டம்பாளையம்',259,1),(13625,'நடுவச்சேரி',259,1),(13626,'நம்பியாம்பாளையம்',259,1),(13627,'பாப்பான்குளம்',259,1),(13628,'பட்டப்பாளையம்',259,1),(13629,'பழங்கரை',259,1),(13630,'பெருமாநல்லூர்',259,1),(13631,'பொங்கலூர்',259,1),(13632,'போத்தம்பாளையம்',259,1),(13633,'புதுப்பாளையம் வ தெ',259,1),(13634,'புலிப்பார்',259,1),(13635,'புஞ்சைதாமரைக்குளம்',259,1),(13636,'ராக்கியாபாளையம்',259,1),(13637,'இராமநாதபுரம்',259,1),(13638,'செம்பியநல்லூர்',259,1),(13639,'சேவூர்',259,1),(13640,'சொக்கனூர்',259,1),(13641,'தண்டக்காரம்பாளையம்',259,1),(13642,'தத்தனூர்',259,1),(13643,'தெக்கலூர்',259,1),(13644,'தொரவலூர்',259,1),(13645,'துலக்கமுத்தூர்',259,1),(13646,'உப்பிலிபாளையம்',259,1),(13647,'வள்ளிபுரம்',259,1),(13648,'வடுகபாளையம்',259,1),(13649,'வேலாயுதம்பாளையம்',259,1),(13650,'வேட்டுவபாளையம்',259,1),(13651,'ஆலாம்பாளையம்',260,1),(13652,'அலங்கியம்',260,1),(13653,'அரிக்காரன்வலசு',260,1),(13654,'புங்கந்துறை',260,1),(13655,'செலாம்பாளையம்',260,1),(13656,'சின்னக்காபாளையம்',260,1),(13657,'சின்னமருதூர்',260,1),(13658,'சின்னபுத்தூர்',260,1),(13659,'சிறுகிணறு',260,1),(13660,'சித்தராவுத்தபாளையம்',260,1),(13661,'தாராபுரம் வடக்கு',260,1),(13662,'தூரம்பாடி',260,1),(13663,'எடக்கல்பாடி',260,1),(13664,'எரகாம்பட்டி',260,1),(13665,'எரசிணம்பாளையம்',260,1),(13666,'கோவிந்தாபுரம்',260,1),(13667,'ஜோதியம்பட்டி',260,1),(13668,'காளிபாளையம்',260,1),(13669,'காங்கயம்பாளையம்',260,1),(13670,'கண்ணாங்கோவில்',260,1),(13671,'கன்னிவாடி',260,1),(13672,'காசிலிங்கபாளையம்',260,1),(13673,'கெத்தல்ரேவ்',260,1),(13674,'கிளாங்குண்டல்',260,1),(13675,'கொக்கம்பாளையம்',260,1),(13676,'கொளத்துப்பாளையம்',260,1),(13677,'கொழுமாங்குளி',260,1),(13678,'கொமாரபாளையம்',260,1),(13679,'கொங்கூர்',260,1),(13680,'கொளிஞ்சிவாடி',260,1),(13681,'குண்டடம்',260,1),(13682,'மடத்துப்பாளையம்',260,1),(13683,'மாம்பாடி',260,1),(13684,'மணக்கடவு',260,1),(13685,'மானூர்பாளையம்',260,1),(13686,'மருதூர்',260,1),(13687,'மோளரப்பட்டி',260,1),(13688,'மூலனூர்',260,1),(13689,'முளையாம்புண்டி',260,1),(13690,'முண்டுவேலம்பட்டி',260,1),(13691,'முத்தியம்பட்டி',260,1),(13692,'நாதம்பாளையம்',260,1),(13693,'நல்லாம்பாளையம்',260,1),(13694,'நஞ்சைத்தலையூர்',260,1),(13695,'நஞ்சியம்பாளையம்',260,1),(13696,'நந்தவனம்பாளையம்',260,1),(13697,'நாராயணபுரம்',260,1),(13698,'நவநாரி',260,1),(13699,'பெல்லம்பட்டி',260,1),(13700,'பெரிமியம்',260,1),(13701,'பெரியகுமாரபாளையம்',260,1),(13702,'பொம்மநல்லூர்',260,1),(13703,'பொன்னாபுரம்',260,1),(13704,'பொன்னிவாடி',260,1),(13705,'புதுப்பை',260,1),(13706,'புஞ்சைத் தலையூர்',260,1),(13707,'சேனாபதிபாளையம்',260,1),(13708,'சங்கரண்டாம்பாளையம்',260,1),(13709,'சுண்டக்காம்பாளையம்',260,1),(13710,'சூரநல்லூர்',260,1),(13711,'தளவாய்பட்டினம்',260,1),(13712,'தாராபுரம் தெற்கு',260,1),(13713,'தட்டாரவலசு',260,1),(13714,'தொப்பம்பட்டி',260,1),(13715,'ஊத்துப்பாளையம்',260,1),(13716,'வடுகபாளையம்',260,1),(13717,'வரப்பாளையம்',260,1),(13718,'வீராட்சிமங்கலம்',260,1),(13719,'வேளாம்பூண்டி',260,1),(13720,'வேலாயுதம்பாளையம்',260,1),(13721,'வெள்ளவாவிப்புதூர்',260,1),(13722,'ஆலாம்பாடி',261,1),(13723,'ஆரத்தொழுவு',261,1),(13724,'சின்னமுத்தூர்',261,1),(13725,'கணபதிபாளையம்',261,1),(13726,'குருக்கபாளையம்',261,1),(13727,'காடையூர்',261,1),(13728,'கம்பளியம்பட்டி',261,1),(13729,'காங்கயம்பாளையம்',261,1),(13730,'காங்கயம்',261,1),(13731,'கத்தாங்கன்னி',261,1),(13732,'கூரனூர்',261,1),(13733,'குட்டப்பாளையம்',261,1),(13734,'இலக்கமநாயக்கன்பட்டி',261,1),(13735,'மங்கலப்பட்டி',261,1),(13736,'மரவபாளையம்',261,1),(13737,'மருதுறை',261,1),(13738,'மேட்டுப்பாளையம்',261,1),(13739,'முதலிபாளையம்',261,1),(13740,'முள்ளிபுரம்',261,1),(13741,'முத்தூர்',261,1),(13742,'நால்ரோடு',261,1),(13743,'நத்தக்காடையூர்',261,1),(13744,'நெழலி',261,1),(13745,'பச்சாபாளையம்',261,1),(13746,'படியூர்',261,1),(13747,'பழையகோட்டை',261,1),(13748,'பாப்பினி',261,1),(13749,'பரஞ்சேர்வழி',261,1),(13750,'பூமாண்டன்வலசு',261,1),(13751,'ராசாத்தாவலசு',261,1),(13752,'சம்பந்தம்பாளையம்',261,1),(13753,'சேனாபதிபாளையம்',261,1),(13754,'சிவன்மலை',261,1),(13755,'தம்மரெட்டிபாளையம்',261,1),(13756,'உடையம்',261,1),(13757,'உத்தமபாளையம்',261,1),(13758,'ஊதியூர்',261,1),(13759,'வடசின்னாரபாளையம்',261,1),(13760,'வள்ளியரச்சல்',261,1),(13761,'வட்டமலை',261,1),(13762,'வீரணம்பாளையம்',261,1),(13763,'வீரசோழபுரம்',261,1),(13764,'வேலம்பாளையம்',261,1),(13765,'வெள்ளக்கோவில்',261,1),(13766,'அக்ரஹாரக் கண்ணாடிபுதூர்',262,1),(13767,'சோழமாதேவி',262,1),(13768,'ஜோத்தம்பட்டி',262,1),(13769,'கடத்தூர்',262,1),(13770,'கணியூர்',262,1),(13771,'காரத்தொழுவு',262,1),(13772,'கொமரலிங்கம் கிழக்கு',262,1),(13773,'கொமரலிங்கம் மேற்கு',262,1),(13774,'கொழுமம்',262,1),(13775,'மெட்ராத்தி(1-2)',262,1),(13776,'மைவாடி 1-2',262,1),(13777,'பாப்பாங்குளம்',262,1),(13778,'சங்கராமநல்லூர் வடக்கு',262,1),(13779,'சங்கராமநல்லூர் தெற்கு',262,1),(13780,'சர்க்கார் கண்ணாடிப்புதூர்',262,1),(13781,'தாந்தோணி',262,1),(13782,'துங்காவி 1-2',262,1),(13783,'வேடபட்டி',262,1),(13784,'எ.வடமலைபாளையம்',263,1),(13785,'அனுப்பட்டி',263,1),(13786,'எலவந்தி',263,1),(13787,'கணபதிபாளையம்',263,1),(13788,'இச்சிப்பட்டி',263,1),(13789,'கே.அய்யம்பாளையம்',263,1),(13790,'கே.கிருஷ்ணாபுரம்',263,1),(13791,'கரடிவாவி',263,1),(13792,'கரைப்புதூர்',263,1),(13793,'காட்டூர்',263,1),(13794,'கோடங்கிபாளையம்',263,1),(13795,'மாதப்பூர்',263,1),(13796,'மல்லிகவுண்டன்பாளையம்',263,1),(13797,'நாரணாபுரம்',263,1),(13798,'பல்லடம்',263,1),(13799,'பணிக்கம்பட்டி',263,1),(13800,'பருவாய்',263,1),(13801,'பொங்கலூர்',263,1),(13802,'பூமலூர்',263,1),(13803,'புளியம்பட்டி',263,1),(13804,'சாமளாபுரம்',263,1),(13805,'செம்மிபாளையம்',263,1),(13806,'சிற்றம்பலம்',263,1),(13807,'சுக்கம்பாளையம்',263,1),(13808,'கேத்தனூர்',263,1),(13809,'வி.காளிபாளையம்',263,1),(13810,'வடுகபாளையம்',263,1),(13811,'வாவிபாளையம்',263,1),(13812,'வேலம்பாளையம்',263,1),(13813,'செட்டிபாளையம்',264,1),(13814,'கணக்கம்பாளையம்',264,1),(13815,'மண்ணரை',264,1),(13816,'பொங்குபாளையம்',264,1),(13817,'நெருப்பெரிச்சல்',264,1),(13818,'தொட்டிபாளையம்',264,1),(13819,'வேலம்பாளையம்',264,1),(13820,'ஆண்டிபாளையம்',265,1),(13821,'அழுகுமலை',265,1),(13822,'இடுவாய்',265,1),(13823,'கண்டியன்கோயில்',265,1),(13824,'மங்கலம்',265,1),(13825,'முதலிபாளையம்',265,1),(13826,'முத்தனம்பாளையம்',265,1),(13827,'நாச்சிபாளையம்',265,1),(13828,'நல்லூர்',265,1),(13829,'வடக்கு அவிநாசிபாளையம்',265,1),(13830,'பெருந்தொழுவு',265,1),(13831,'தெற்கு அவிநாசிபாளையம்',265,1),(13832,'தொங்குடிபாளையம்',265,1),(13833,'திருப்பூர்',265,1),(13834,'உகாயனூர்',265,1),(13835,'வீரபாண்டி',265,1),(13836,'ஆலாம்பாளையம்',266,1),(13837,'ஆமந்தக்கடவு',266,1),(13838,'ஆண்டியகவுண்டனூர்(1)',266,1),(13839,'ஆண்டியகவுண்டனூர்(2)',266,1),(13840,'அணிக்கடவு',266,1),(13841,'அந்தியூர்',266,1),(13842,'அரசூர்',266,1),(13843,'ஆத்திக்கிணத்துப்பட்டி',266,1),(13844,'போடிப்பட்டி',266,1),(13845,'போகிகவுண்டன்தாசர்பட்டி',266,1),(13846,'செல்லப்பம்பாளையம்',266,1),(13847,'சின்னக்குமாரபாளையம்',266,1),(13848,'சின்ன பாப்பனூத்து',266,1),(13849,'சின்னவாளவாடி',266,1),(13850,'சின்னவீரம்பட்டி',266,1),(13851,'தேவனூர்புதூர்',266,1),(13852,'எலையமுத்தூர்',266,1),(13853,'எரிசனம்பட்டி',266,1),(13854,'கணபதிபாளையம்',266,1),(13855,'குடிமங்கலம்',266,1),(13856,'இலுப்ப நகரம்',266,1),(13857,'ஜல்லிபட்டி',266,1),(13858,'ஜிலோபநாயக்கன்பாளையம்',266,1),(13859,'கல்லாபுரம்',266,1),(13860,'கணக்கம்பாளையம்',266,1),(13861,'கண்ணமநாயக்கனூர் 1-2',266,1),(13862,'கொடுங்கியம்',266,1),(13863,'கொண்டம்பட்டி',266,1),(13864,'கொங்கல் நகரம்',266,1),(13865,'கொசவம்பாளையம்',266,1),(13866,'கோட்டமங்கலம்',266,1),(13867,'கிருஷ்ணாபுரம்',266,1),(13868,'குப்பம்பாளையம்',266,1),(13869,'குரல்குட்டை',266,1),(13870,'குறிச்சிக்கோட்டை',266,1),(13871,'குருஞ்சேரி',266,1),(13872,'குருவப்பநாயக்கனூர்',266,1),(13873,'லிங்கமாவூர்',266,1),(13874,'மானுப்பட்டி',266,1),(13875,'மொடக்குப்பட்டி',266,1),(13876,'முக்கூடு ஜல்லிப்பட்டி',266,1),(13877,'மூங்கில் தொழுவு',266,1),(13878,'பள்ளபாளையம்',266,1),(13879,'பண்ணைக்கிணர்',266,1),(13880,'பெரிய கோட்டை',266,1),(13881,'பெரிய பாப்பனூத்து',266,1),(13882,'பெரியபட்டி',266,1),(13883,'பெரியவாளவாடி',266,1),(13884,'பொன்னேரி',266,1),(13885,'புலாங்கிணறு',266,1),(13886,'பூளவாடி',266,1),(13887,'புதுப்பாளையம்',266,1),(13888,'புக்குளம்',266,1),(13889,'புங்கமுத்தூர்',266,1),(13890,'ராகல்பாவி',266,1),(13891,'ராவணாபுரம்',266,1),(13892,'ரெட்டிபாளையம்',266,1),(13893,'சர்கார் புதூர்',266,1),(13894,'சோமவாரப்பட்டி',266,1),(13895,'தளி-1.திருமூர்த்தி நகர்',266,1),(13896,'தீபாலப்பட்டி',266,1),(13897,'தென்புதிநத்தம்',266,1),(13898,'தின்னப்பட்டி',266,1),(13899,'தொடடம்பட்டி',266,1),(13900,'தும்பலப்பட்டி',266,1),(13901,'உடுக்கம்பாளையம்',266,1),(13902,'உடுமலைப்பேட்டை',266,1),(13903,'வடபுதிநத்தம்',266,1),(13904,'வடுகபாளையம்',266,1),(13905,'வாகத்தொழுவு',266,1),(13906,'வலையபாளையம்',266,1),(13907,'வீதம்பட்டி',266,1),(13908,'ஆர் வேலூர்',266,1),(13909,'வெனசப்பட்டி',266,1),(13910,'வெங்கிட்டாபுரம்',266,1),(13911,'விருகல்பட்டி',266,1),(13912,'அ பல்லகவுண்டம்பாளையம்',267,1),(13913,'அக்ரஹார கத்தாங்கண்ணி',267,1),(13914,'அக்ரஹார பெரியபாளையம்',267,1),(13915,'அணைப்பாளையம்',267,1),(13916,'செங்கப்பள்ளி',267,1),(13917,'செட்டிகுட்டை',267,1),(13918,'சின்னேகவுண்டன்வலசு',267,1),(13919,'சின்னயம்பாளையம்',267,1),(13920,'எடையபாளையம்',267,1),(13921,'எருமைக்காரன்பாளையம்',267,1),(13922,'கணபதிபாளையம்',267,1),(13923,'இச்சிப்பாளையம்',267,1),(13924,'கம்மாளகுட்டை',267,1),(13925,'கருமஞ்சிறை',267,1),(13926,'கவுண்டம்பாளையம்',267,1),(13927,'காவுத்தம்பாளையம்',267,1),(13928,'குமாரகவுண்டம்பாளையம்',267,1),(13929,'கூனம்பட்டி',267,1),(13930,'குன்னத்தூர்',267,1),(13931,'குறிச்சி',267,1),(13932,'மு பல்லகவுண்டன்பாளையம்',267,1),(13933,'மேட்டுப்பாளையம்',267,1),(13934,'மொரட்டுப்பாளையம்',267,1),(13935,'முத்தம்பாளையம்',267,1),(13936,'வ காங்கயம்பாளையம்',267,1),(13937,'நடுப்பட்டி',267,1),(13938,'நல்லிகவுண்டம்பாளையம்',267,1),(13939,'நவக்காடு',267,1),(13940,'நெட்டிச்சிபாளையம்',267,1),(13941,'பல்லவராயன்பாளையம்',267,1),(13942,'புலாங்குளம்',267,1),(13943,'புதுப்பாளையம்',267,1),(13944,'புஞ்சை ஊத்துகுளி',267,1),(13945,'புஞ்சை தளவாய்பாளையம்',267,1),(13946,'புத்தூர் பள்ளபாளையம்',267,1),(13947,'ரெட்டிபாளையம்',267,1),(13948,'ராக்கியாபாளையம் ஊ',267,1),(13949,'தெ காங்கயம்பாளையம்',267,1),(13950,'சர்க்கார் பெரியபாளையம்',267,1),(13951,'சர்க்கார் பெரியபாளையம்',267,1),(13952,'சரக்காரகத்தாங்கன்னி',267,1),(13953,'செங்காளி பாளையம்',267,1),(13954,'சுண்டக்காம்பாளையம்',267,1),(13955,'வடுகபாளையம் ஊ',267,1),(13956,'வலையபாளையம்',267,1),(13957,'வட்டாலபதி',267,1),(13958,'வேலம்பாளையம்',267,1),(13959,'வெள்ளிரவெளி',267,1),(13960,'வெள்ளியம்பதி',267,1),(13961,'விருமாண்டாம்பாளையம்',267,1),(13962,'அக்ரஹாரமேல்',268,1),(13963,'ஆலத்தூர்',268,1),(13964,'அரக்கம்பாக்கம்',268,1),(13965,'அயப்பாக்கம்',268,1),(13966,'கதவூர்',268,1),(13967,'கருணாகரச்சேரி',268,1),(13968,'கீழ்க்கொண்டையார்',268,1),(13969,'கோயில்பதாகை',268,1),(13970,'மேல்பாக்கம்',268,1),(13971,'மிட்னமல்லி',268,1),(13972,'மோரை',268,1),(13973,'மோரை 2',268,1),(13974,'முக்காபுதுப்பட்டு',268,1),(13975,'நடுகுத்தகை',268,1),(13976,'நெமிலிச்சேரி',268,1),(13977,'பாலவேடு',268,1),(13978,'பாலேரிபட்டு',268,1),(13979,'பம்மதுகுளம்',268,1),(13980,'பாண்டேஸ்வரம்',268,1),(13981,'பருத்திபட்டு',268,1),(13982,'பொத்தூர்',268,1),(13983,'சோராஞ்சேரி B',268,1),(13984,'தண்டுரை',268,1),(13985,'திருமுல்லைவாயல்',268,1),(13986,'திருநின்றவூர் அ',268,1),(13987,'திருநின்றவூர் ஆ',268,1),(13988,'வெள்ளச்சேரி',268,1),(13989,'வெள்ளானூர்',268,1),(13990,'வெள்ளானூர் 2',268,1),(13991,'விளிஞ்சியம்பாக்கம்',268,1),(13992,'ஆத்துப்பாக்கம்',269,1),(13993,'அமிர்தமங்கலம்',269,1),(13994,'அன்னப்பநாயக்கன்குப்பம்',269,1),(13995,'அப்பாவரம்',269,1),(13996,'ஆரம்பாக்கம்',269,1),(13997,'அரிகத்துறை',269,1),(13998,'அயநல்லூர்',269,1),(13999,'புதூர்',269,1),(14000,'சென்னவரம்',269,1),(14001,'சின்னஒபுளாபுரம்',269,1),(14002,'சின்னபுலியூர்',269,1),(14003,'சின்னாரெட்டிகண்டிகை',269,1),(14004,'சின்னசோழியம்பாக்கம்',269,1),(14005,'சித்தூர்நத்தம்',269,1),(14006,'சித்தரசூர்',269,1),(14007,'சிந்தலகுப்பம்',269,1),(14008,'தர்காஸ்துகண்டிகை',269,1),(14009,'ஏடூர்',269,1),(14010,'எகுமதுரை',269,1),(14011,'ஈகுவார்பாளையம்',269,1),(14012,'எளாவூர்',269,1),(14013,'ஏனாதிமேல்பாக்கம்',269,1),(14014,'எருக்குவாய்',269,1),(14015,'கெட்னமல்லி',269,1),(14016,'குருவராஜ கண்டிகை',269,1),(14017,'குருவாட்டுசேரி',269,1),(14018,'குருவிஅகரம்',269,1),(14019,'கள்ளூர்',269,1),(14020,'கண்ணம்பாக்கம்',269,1),(14021,'கண்ணன்கோட்டை',269,1),(14022,'கரடிபுத்தூர்',269,1),(14023,'காரணி',269,1),(14024,'கரும்புகுப்பம்',269,1),(14025,'கீழ்முதலம்பேடு',269,1),(14026,'கொள்ளனூர்',269,1),(14027,'மாதர்பாக்கம்',269,1),(14028,'மாதவரம்',269,1),(14029,'மணலி',269,1),(14030,'மாநல்லூர்',269,1),(14031,'மங்கலம்',269,1),(14032,'மங்காவரம்',269,1),(14033,'மெதிபாளையம்',269,1),(14034,'மேலக்கழனி',269,1),(14035,'மேல்முதலம்பேடு',269,1),(14036,'மேல்பாக்கம்',269,1),(14037,'முக்கரம்பாக்கம்',269,1),(14038,'நாயுடுகுப்பம்',269,1),(14039,'நங்கபள்ளம்',269,1),(14040,'நரசிங்கபுரம்',269,1),(14041,'நத்தம்',269,1),(14042,'நெல்வாய்',269,1),(14043,'நேமலூர்',269,1),(14044,'ஓபசமுத்திரம்',269,1),(14045,'பழையகும்மிடிப்பூண்டி',269,1),(14046,'பாஞ்சாலை',269,1),(14047,'பாலவாக்கம்',269,1),(14048,'பாலேஸ்வரம்',269,1),(14049,'பாலேஸ்வரன்கண்டிகை',269,1),(14050,'பல்லாவாடா',269,1),(14051,'பண்பாக்கம்',269,1),(14052,'பாப்பாங்குப்பம்',269,1),(14053,'பெரிய ஒபுளாபுரம்',269,1),(14054,'பெரியபுலியூர்',269,1),(14055,'பெரியசோழியம்பாக்கம்',269,1),(14056,'பெருவாயல்',269,1),(14057,'பெத்திகுப்பம்',269,1),(14058,'போந்தவாக்கம்',269,1),(14059,'பூவளை',269,1),(14060,'பூவலம்பேடு',269,1),(14061,'புதுகும்மிடிபூண்டி',269,1),(14062,'புதுப்பாளையம்',269,1),(14063,'புதுவாயல்',269,1),(14064,'ரெட்டம்பேடு',269,1),(14065,'சாணாபுத்தூர்',269,1),(14066,'செதில்பாக்கம்',269,1),(14067,'சேர்பேடு',269,1),(14068,'சிறுபுழல்பேட்டை',269,1),(14069,'சிறுவாடா',269,1),(14070,'சூரபபபூண்டி',269,1),(14071,'சுண்ணாம்புகுளம்',269,1),(14072,'தண்டலசேரி',269,1),(14073,'தேர்வழி',269,1),(14074,'தேர்வாய்க்கண்டிகை',269,1),(14075,'தோக்கமூர்',269,1),(14076,'துராபள்ளம்',269,1),(14077,'வாணியமல்லி',269,1),(14078,'வான்ராசிகுப்பம்',269,1),(14079,'வழுதலம்பேடு',269,1),(14080,'வெண்குழி',269,1),(14081,'வேர்காடு',269,1),(14082,'அத்திமஞ்சேரி',270,1),(14083,'ஈச்சம்பாடி',270,1),(14084,'கொல்லாலகுப்பம்',270,1),(14085,'இருதலைவாரப்பட்டடை',270,1),(14086,'காக்களூர்',270,1),(14087,'கரிம்பேடு',270,1),(14088,'கர்லம்பாக்கம்',270,1),(14089,'கதனநகரம்',270,1),(14090,'கீச்சலம்',270,1),(14091,'கீளப்புடி',270,1),(14092,'கொடிவலசா',270,1),(14093,'கொளத்தூர்',270,1),(14094,'கோணசமுத்திரம்',270,1),(14095,'கொத்தகுப்பம்',270,1),(14096,'கிருஷ்ணமராஜகுப்பம்',270,1),(14097,'குமாராஜிபேட்டை',270,1),(14098,'மேலப்புடி',270,1),(14099,'நெடியம்',270,1),(14100,'நெடிகல்',270,1),(14101,'நொச்சிலி (கி)',270,1),(14102,'நொச்சிலி (மே)',270,1),(14103,'பாண்டரவேடு',270,1),(14104,'பெருமாநல்லூர்',270,1),(14105,'பேட்டைகண்டிகை',270,1),(14106,'பொதட்டூர்பேட்டை (கி)',270,1),(14107,'பொதட்டிர்பேட்டை(மே)',270,1),(14108,'புதுப்பட்டு',270,1),(14109,'புதுப்பட்டு',270,1),(14110,'புண்ணியம்',270,1),(14111,'ராமசமுத்திரம்',270,1),(14112,'சாமந்தவாடா',270,1),(14113,'திருமல்ராஜிபேட்டை',270,1),(14114,'வெளியகரம்',270,1),(14115,'வெங்கட்ராஜகுப்பம்',270,1),(14116,'ஆலாடு 1',271,1),(14117,'ஆலாடு 2',271,1),(14118,'ஆசானபுதூர்',271,1),(14119,'ஆவூர்',271,1),(14120,'அடம்பாக்கம்',271,1),(14121,'அகரம்',271,1),(14122,'அலமாதி',271,1),(14123,'அலமாதி 2',271,1),(14124,'அழிஞ்சிவாக்கம்',271,1),(14125,'ஆமூர்',271,1),(14126,'ஆமூர் 2',271,1),(14127,'ஆண்டார்மடம்',271,1),(14128,'அண்டவாயல்',271,1),(14129,'ஆங்காடு',271,1),(14130,'அண்ணாமலைச்சேரி',271,1),(14131,'அனுப்பம்பட்டு',271,1),(14132,'அனுப்பம்பட்டு 2',271,1),(14133,'அப்ளாபுரம்',271,1),(14134,'ஆரணி',271,1),(14135,'ஆரணி 2',271,1),(14136,'அரசூர்',271,1),(14137,'அரியன்வாயல்',271,1),(14138,'அருமந்தை',271,1),(14139,'அத்தமணஞ்சேரி',271,1),(14140,'அத்திப்பட்டு',271,1),(14141,'அத்திப்பட்டு 2',271,1),(14142,'அத்திவாக்கம்',271,1),(14143,'ஆத்தூர்',271,1),(14144,'ஆட்டந்தாங்கல்',271,1),(14145,'ஆவூர் 2',271,1),(14146,'அவுரிவாக்கம்',271,1),(14147,'பண்டிகாவனூர்',271,1),(14148,'புதூர்',271,1),(14149,'சின்னகாவணம்',271,1),(14150,'சின்னக்காவணம் 2',271,1),(14151,'சின்னம்பேடு',271,1),(14152,'சின்னம்பேடு 2',271,1),(14153,'சின்னம்பேடு 3',271,1),(14154,'சின்னமுல்லவாயல்',271,1),(14155,'சின்னவெப்பத்தூர்',271,1),(14156,'தேவதானம்',271,1),(14157,'தேவம்பட்டு',271,1),(14158,'துரைநல்லூர்',271,1),(14159,'எலியம்பேடு 2',271,1),(14160,'ஏப்ரஹான்புரம்',271,1),(14161,'இடையன்சாவடி ஆ',271,1),(14162,'ஏலியம்பேடு',271,1),(14163,'ஈஞ்சூர்',271,1),(14164,'எண்ணூர்',271,1),(14165,'எரியபிள்ளைகுப்பம்',271,1),(14166,'எர்ணாகுரச்சேரி',271,1),(14167,'எரணவாக்கம்',271,1),(14168,'ஞாயிறு',271,1),(14169,'ஞாயிறு 2',271,1),(14170,'கிராண்ட்லயன்',271,1),(14171,'கூடுவாஞ்சேரி',271,1),(14172,'இலுப்பாக்கம்',271,1),(14173,'லையன்கிராண்ட்',271,1),(14174,'ஜெகநாதபுரம் 3',271,1),(14175,'ஜெகநாதபுரம் 2',271,1),(14176,'ஜெகநாதபுரம்',271,1),(14177,'கடமஞ்சேரி',271,1),(14178,'கடப்பாக்கம்',271,1),(14179,'காளாஞ்சி',271,1),(14180,'கல்பாக்கம்',271,1),(14181,'கள்ளூர்',271,1),(14182,'கனகவல்லிபுரம்',271,1),(14183,'கணவன்துரை',271,1),(14184,'கண்டிகை',271,1),(14185,'கங்காணிமேடு',271,1),(14186,'காணியம்பாக்கம்',271,1),(14187,'காரணோடை',271,1),(14188,'கரிமணல்',271,1),(14189,'கருங்காலி',271,1),(14190,'காட்டாவூர்',271,1),(14191,'காட்டுப்பள்ளி',271,1),(14192,'காட்டூர்',271,1),(14193,'காட்டூர் 2',271,1),(14194,'கீரப்பாக்கம்',271,1),(14195,'கீழ்மேனி',271,1),(14196,'கிளிக்கொடி',271,1),(14197,'கொடிப்பள்ளம்',271,1),(14198,'கொள்ளட்டி',271,1),(14199,'கோளூர்',271,1),(14200,'கோளூர் 2',271,1),(14201,'கோளூர் 3',271,1),(14202,'குமரஞ்சேரி',271,1),(14203,'குமரசிறுளப்பாக்கம்',271,1),(14204,'கும்மனூர்',271,1),(14205,'லிங்கபையன்பேட்டை',271,1),(14206,'மாபுஸ்காண்பேட்டை',271,1),(14207,'மாதவரம்',271,1),(14208,'மடியூர்',271,1),(14209,'மல்லியன்குப்பம்',271,1),(14210,'மாங்கோடு',271,1),(14211,'மாரம்பேடு',271,1),(14212,'மெதூர்',271,1),(14213,'மெதூர் 2',271,1),(14214,'மெதூர் 3',271,1),(14215,'மேல்சிங்கிலிமேடு',271,1),(14216,'மெரட்டூர்',271,1),(14217,'மீஞ்சூர்',271,1),(14218,'மீஞ்சூர் 2',271,1),(14219,'நாலூர்',271,1),(14220,'நாலூர் 2',271,1),(14221,'நல்லூர்',271,1),(14222,'நந்தியம்பாக்கம்',271,1),(14223,'நாரவாரிக்குப்பம்',271,1),(14224,'நத்தம்',271,1),(14225,'நெய்தவாயல்',271,1),(14226,'நெய்தவாயல் 2',271,1),(14227,'நெற்குன்றம்',271,1),(14228,'புதிய எருமைவெட்டிபாளையம்',271,1),(14229,'பழைய எருமைவெட்டிபாளையம்',271,1),(14230,'ஒரக்காடு',271,1),(14231,'பாடியநல்லூர்',271,1),(14232,'பாக்கம்',271,1),(14233,'பாலவாயல்',271,1),(14234,'பனப்பாக்கம்',271,1),(14235,'பஞ்செட்டி',271,1),(14236,'பரணம்பேடு',271,1),(14237,'பாயசம்பாக்கம்',271,1),(14238,'பழவேற்காடு',271,1),(14239,'பெரவள்ளூர்',271,1),(14240,'பெரியகரும்பூர்',271,1),(14241,'பெரியமுல்லைவாயல்',271,1),(14242,'பெரியவெப்பத்தூர்',271,1),(14243,'பெரும்பேடு',271,1),(14244,'பெரும்பேடு 2',271,1),(14245,'பெருங்காவூர்',271,1),(14246,'பெருங்காவூர் 2',271,1),(14247,'பிரளயம்பாக்கம்',271,1),(14248,'பிரளயம்பாக்கம் 2',271,1),(14249,'போந்தவாக்கம்',271,1),(14250,'பொன்னேரி',271,1),(14251,'பொன்னேரி 2',271,1),(14252,'பூங்குளம்',271,1),(14253,'பூவாமி',271,1),(14254,'புதுப்பாக்கம்',271,1),(14255,'புழுதிவாக்கம்',271,1),(14256,'செங்குன்றம்',271,1),(14257,'சேலியம்பேடு',271,1),(14258,'சீமாபுரம்',271,1),(14259,'சேகண்யம்',271,1),(14260,'செக்கஞ்சேரி',271,1),(14261,'செம்பிலிவரம்',271,1),(14262,'செவிட்டுபனப்பாக்கம்',271,1),(14263,'சோழவரம்',271,1),(14264,'சிறுகாவூர்',271,1),(14265,'சிறுளப்பாக்கம்',271,1),(14266,'சிருளப்பனஞ்சேரி',271,1),(14267,'சிருணியம்',271,1),(14268,'சிறுபழவேற்காடு',271,1),(14269,'சிறுவேளூர்',271,1),(14270,'சோமஞ்சேரி',271,1),(14271,'சோம்பட்டு',271,1),(14272,'சூரப்பட்டு',271,1),(14273,'சோத்துப்பாக்கம்',271,1),(14274,'சோத்துப்பெரும்பேடு',271,1),(14275,'சவுண்டாபுரம்',271,1),(14276,'தடபெரும்பாக்கம் 1',271,1),(14277,'தடபெரும்பாக்கம் 2',271,1),(14278,'தண்டல்கழனி',271,1),(14279,'தங்கல்பெரும்புலம்',271,1),(14280,'தச்சூர்',271,1),(14281,'தச்சூர் 2',271,1),(14282,'தத்தமஞ்சி',271,1),(14283,'தீர்த்தகிரியம்பட்டு',271,1),(14284,'தினைப்பாக்கம்',271,1),(14285,'திருநிலை',271,1),(14286,'திருப்பேர்',271,1),(14287,'திருபாளைவனம் 1',271,1),(14288,'திருபாளைவனம் 2',271,1),(14289,'திருவெள்ளவாயல்',271,1),(14290,'தோட்டக்காடு',271,1),(14291,'உமிப்பேடு',271,1),(14292,'உப்புநெல்வாயல்',271,1),(14293,'வடகரை',271,1),(14294,'வடக்குநல்லூர்',271,1),(14295,'வைரவன்குப்பம்',271,1),(14296,'வள்ளூர்(டி)',271,1),(14297,'வல்லூர்',271,1),(14298,'வள்ளூர்(ஆ)',271,1),(14299,'வள்ளுர்(சி)',271,1),(14300,'வஞ்சிவாக்கம்',271,1),(14301,'வன்னிபாக்கம்',271,1),(14302,'வாயலூர் 2',271,1),(14303,'வயலூர் 3',271,1),(14304,'வழுதிகைமேடு',271,1),(14305,'வெள்ளம்பாக்கம்',271,1),(14306,'வெள்ளிவாயல்',271,1),(14307,'வெள்ளிவாயல் 2',271,1),(14308,'வேளூர்',271,1),(14309,'வேம்பேடு',271,1),(14310,'விடத்தண்டலம்',271,1),(14311,'விஜயநல்லூர்',271,1),(14312,'விளாங்காடுபாக்கம்',271,1),(14313,'விச்சூர்',271,1),(14314,'விச்சூர் 2',271,1),(14315,'வாயலூர்',271,1),(14316,'அடையாளம்பட்டு',272,1),(14317,'அகரம்மேல்',272,1),(14318,'அக்ரஹாரம்',272,1),(14319,'அமுதூர்மேடு',272,1),(14320,'அரியமந்தநல்லூர்',272,1),(14321,'அயனம்பாக்கம்',272,1),(14322,'பானவேடுதோட்டம்',272,1),(14323,'செம்பரம்பாக்கம்',272,1),(14324,'கோபரசநல்லூர்',272,1),(14325,'கூடப்பாக்கம்',272,1),(14326,'கண்ணபாளையம்',272,1),(14327,'காட்டுப்பாக்கம்',272,1),(14328,'கீழ்மணம்பேடு',272,1),(14329,'கோலடி',272,1),(14330,'கோளப்பஞ்சேரி',272,1),(14331,'கொரட்டூர் ஆ',272,1),(14332,'கொரட்டூர் அ',272,1),(14333,'குத்தம்பாக்கம்',272,1),(14334,'மடவிளாகம்',272,1),(14335,'மேல்பாக்கம்',272,1),(14336,'மேப்பூர்',272,1),(14337,'மெய்யூர்',272,1),(14338,'நரசிங்கபுரம்',272,1),(14339,'நசரத்பேட்டை',272,1),(14340,'நேமம் அ',272,1),(14341,'நேமம் ஆ',272,1),(14342,'நொச்சிமேடு',272,1),(14343,'நூம்பல்',272,1),(14344,'படூர்',272,1),(14345,'பழஞ்சூர்',272,1),(14346,'பாரிவாக்கம்',272,1),(14347,'பர்வதராஜபுரம்',272,1),(14348,'பொருமாளகரம்',272,1),(14349,'பிடாரிதாங்கல்',272,1),(14350,'பூந்தமல்லி',272,1),(14351,'புளியம்பேடு',272,1),(14352,'சென்னீர்குப்பம்',272,1),(14353,'சோராஞ்சேரி அ',272,1),(14354,'சுந்தரசோழவரம்',272,1),(14355,'திருமலைராஜபுரம்',272,1),(14356,'திருமழிசை',272,1),(14357,'திருவேற்காடு',272,1),(14358,'தூக்கணாம்பட்டு',272,1),(14359,'உடையார்கோயில்',272,1),(14360,'வானகரம்',272,1),(14361,'வரதராஜபுரம்',272,1),(14362,'வயலாநல்லூர் அ',272,1),(14363,'வயலாநல்லூர் ஆ',272,1),(14364,'வீரராகவபுரம்',272,1),(14365,'வெள்ளவேடு',272,1),(14366,'அம்மனேரி',273,1),(14367,'அம்மையார்குப்பம்',273,1),(14368,'அஸ்வரேவந்தபுரம்',273,1),(14369,'ஆதிவாரகபுரம்',273,1),(14370,'அய்யனேரி கி',273,1),(14371,'அய்யனேரி மே',273,1),(14372,'பாலாபுரம்',273,1),(14373,'செல்லாத்தூர',273,1),(14374,'தேவலம்பாபுரம்',273,1),(14375,'ஜி சி எஸ் கண்டிகை ஆ',273,1),(14376,'ஜி சி எஸ் கண்டிகை',273,1),(14377,'ஜனகராஜகுப்பம்',273,1),(14378,'காண்டாபுரம்',273,1),(14379,'கதனநகரம்',273,1),(14380,'மகான்காளிகாபுரம்',273,1),(14381,'மீசரகாண்டாபுரம்',273,1),(14382,'மைலார்வாடா கி',273,1),(14383,'மைலரவாடா மே',273,1),(14384,'பத்மாபுரம்',273,1),(14385,'பைவலசா',273,1),(14386,'பெத்தநாகபூடி',273,1),(14387,'பெத்தராமாபுரம்',273,1),(14388,'இராகவநாயுடுகுப்பம்',273,1),(14389,'இராஜாநகரம்',273,1),(14390,'சந்தானவேணுகோபாலபுரம்',273,1),(14391,'சகஸ்ரபத்மாபுரம்',273,1),(14392,'சாணுரமல்லாவரம்',273,1),(14393,'ஶ்ரீகாளிகாபுரம்',273,1),(14394,'ஶ்ரீவிலாசபுரம்',273,1),(14395,'வங்கனூர்',273,1),(14396,'வெடியங்காடு',273,1),(14397,'வீரமங்கலம்',273,1),(14398,'வீரமங்கலம் ஆ',273,1),(14399,'வீராணத்தூர்',273,1),(14400,'வெள்ளாத்தூர்',273,1),(14401,'வேணுகோபாலபுரம்',273,1),(14402,'விளக்கணாம்புடி',273,1),(14403,'அகூர்',274,1),(14404,'அலமேலுமங்காபுரம்',274,1),(14405,'அமிர்தாபுரம்',274,1),(14406,'ஆற்காடு',274,1),(14407,'அரும்பாக்கம்',274,1),(14408,'அருங்குளம்',274,1),(14409,'அத்திப்பட்டு',274,1),(14410,'பீரகுப்பம்',274,1),(14411,'செருக்கனூர்',274,1),(14412,'சின்னகடம்பூர்',274,1),(14413,'சின்னமண்டலி',274,1),(14414,'சின்னமாபேட்டை',274,1),(14415,'சிவ்வாடா',274,1),(14416,'தேவசேனாபுரம்',274,1),(14417,'தரணிவராகபுரம்',274,1),(14418,'கொல்லாலகுப்பம்',274,1),(14419,'கூளூர்',274,1),(14420,'அரிச்சந்திராபுரம்',274,1),(14421,'இலுப்பூர்',274,1),(14422,'ஜே எஸ் ராமாபுரம்',274,1),(14423,'ஜாகீர்மங்கலம்',274,1),(14424,'காபுலகண்டிகை',274,1),(14425,'களாம்பாக்கம்',274,1),(14426,'காஞ்சிபாடி',274,1),(14427,'கார்த்திகேயபுரம்',274,1),(14428,'காவேரிராசபுரம்',274,1),(14429,'கீழ்தேவதானம்',274,1),(14430,'கோரமங்கலம்',274,1),(14431,'கிருஷ்ணசமுத்திரம் ஆ',274,1),(14432,'கிருஷ்ணசமுத்திரம் அ',274,1),(14433,'குப்பம்',274,1),(14434,'லட்சுமிவிலாசபுரம்',274,1),(14435,'மடம்மத்தூர்',274,1),(14436,'மாத்தூர் ஆ',274,1),(14437,'மாமண்டூர்',274,1),(14438,'மாம்பாக்கம்',274,1),(14439,'மணவூர்',274,1),(14440,'மருதவல்லிபுரம்',274,1),(14441,'முருக்கம்பட்டு',274,1),(14442,'முத்துகொண்டபுரம்',274,1),(14443,'நாபளூர்',274,1),(14444,'நல்லாணிகுண்டா',274,1),(14445,'நல்லாட்டூர்',274,1),(14446,'நெடும்பரம்',274,1),(14447,'நெமிலி',274,1),(14448,'ஒரத்தூர்',274,1),(14449,'பாகசாலை',274,1),(14450,'பழையனூர்',274,1),(14451,'பனப்பாக்கம்',274,1),(14452,'பட்டாபிராம்புரம்',274,1),(14453,'பெரியகளக்காட்டூர் அ',274,1),(14454,'பெரியகளக்காட்டூர் ஆ',274,1),(14455,'பெரியகடம்பூர்',274,1),(14456,'பொன்பாடி',274,1),(14457,'பூனிமாங்காடு அ',274,1),(14458,'புனிமாங்காடு ஆ',274,1),(14459,'ராஜபத்மாபுரம்',274,1),(14460,'ராமாபுரம்',274,1),(14461,'சந்தானகோபாலபுரம்',274,1),(14462,'சத்தரஞ்செயபுரம்',274,1),(14463,'செளகளத்தூர் அக்ரஹாரம்',274,1),(14464,'சிறுகுமி',274,1),(14465,'சூரியநகரம்',274,1),(14466,'தாடூர்',274,1),(14467,'தாழவேடு',274,1),(14468,'திருவாலங்காடு',274,1),(14469,'தும்பலசெருவுகண்டிகை',274,1),(14470,'திருத்தணி',274,1),(14471,'வள்ளிமாபுரம்',274,1),(14472,'வீரகாவேரிராசபுரம்',274,1),(14473,'வீரகநல்லூர்',274,1),(14474,'வீரராகவபுரம் அ',274,1),(14475,'வீரராகவபுரம் ஆ',274,1),(14476,'வேலஞ்சேரி',274,1),(14477,'வேலூர்கிருஷ்ணமநாயுடு கண்டிகை',274,1),(14478,'வேணுகோபாலபுரம்',274,1),(14479,'வியாசபுரம்',274,1),(14480,'ஆப்பிரகாம்புரம்',275,1),(14481,'அகரம்',275,1),(14482,'அகரம்-2',275,1),(14483,'அல்லிக்குழி',275,1),(14484,'அம்மணம்பாக்கம்',275,1),(14485,'அரண்வாயல்',275,1),(14486,'அரண்வாயல் குப்பம்',275,1),(14487,'அரும்பாக்கம்',275,1),(14488,'அரும்பாக்கம்',275,1),(14489,'அதிகத்தூர்',275,1),(14490,'ஆர்க்கம்பட்டு',275,1),(14491,'ஆட்டுபாக்கம்',275,1),(14492,'ஆயல்சேரி',275,1),(14493,'ஆயலூர்',275,1),(14494,'அயத்தூர்',275,1),(14495,'அழிஞ்சிவாக்கம்',275,1),(14496,'பீமாவரம்',275,1),(14497,'செஞ்சி',275,1),(14498,'சென்னாவரம்',275,1),(14499,'சீயஞ்சேரி',275,1),(14500,'சிட்ரம்பாக்கம்',275,1),(14501,'ஏகாட்டூர்',275,1),(14502,'எரையூர்',275,1),(14503,'எரையாமங்கலம்',275,1),(14504,'கெங்குலுகண்டிகை',275,1),(14505,'கெருகம்பூண்டி',275,1),(14506,'கோவிந்தமேடு',275,1),(14507,'குருவாயல்',275,1),(14508,'உசேன்நகரம்',275,1),(14509,'அட்சன் நகரம்',275,1),(14510,'ஹட்சன்புரம்',275,1),(14511,'ஈக்காடு அ',275,1),(14512,'ஈக்காடு கண்டிகை',275,1),(14513,'இலுப்பூர்',275,1),(14514,'இருளஞ்சேரி',275,1),(14515,'கடம்பத்தூர்',275,1),(14516,'கைவண்டுர்',275,1),(14517,'காக்களூர்',275,1),(14518,'கலியனூர்',275,1),(14519,'கல்லம்பேடு',275,1),(14520,'கல்யாணக்குப்பம்',275,1),(14521,'கனகவல்லிபுரம்',275,1),(14522,'கண்ணம்மாபேட்டை',275,1),(14523,'கண்ணன் காரணை',275,1),(14524,'கண்ணூர்',275,1),(14525,'காரணை-1',275,1),(14526,'காரணை-2',275,1),(14527,'காரணை-3',275,1),(14528,'காரணிநிசாம்பட்டு',275,1),(14529,'கரட்டானூர்',275,1),(14530,'கரிக்கலவாக்கம்',275,1),(14531,'கசவநல்லாத்தூர்',275,1),(14532,'காவங்கொளத்தூர்',275,1),(14533,'கிளாம்பாக்கம்',275,1),(14534,'கீழ்விளாகம்',275,1),(14535,'கிரின்வேல்நத்தம்',275,1),(14536,'கீழச்சேரி',275,1),(14537,'கீழானூர்',275,1),(14538,'கோடுவெளி',275,1),(14539,'கோயில் குப்பம்',275,1),(14540,'கொழுந்தலூர்',275,1),(14541,'கொண்டாஞ்சேரி',275,1),(14542,'கூவம்',275,1),(14543,'கொப்பூர்',275,1),(14544,'கொட்டையூர்',275,1),(14545,'கிருஷ்ணாபுரம்',275,1),(14546,'குமாரச்சேரி',275,1),(14547,'குண்ணவலம்',275,1),(14548,'மடத்துக்குப்பம்',275,1),(14549,'மாகரல்',275,1),(14550,'மணமேடு',275,1),(14551,'மப்பேடு',275,1),(14552,'மேலக்கொண்டையூர்',275,1),(14553,'மேலானூர்',275,1),(14554,'மேல்நல்லாத்தூர்',275,1),(14555,'மேல்விளாகம்',275,1),(14556,'மொண்ணவேடு',275,1),(14557,'மோவூர்',275,1),(14558,'முதுகூர்',275,1),(14559,'மும்முடிக்குப்பம்',275,1),(14560,'நல்லான்காவனூர்',275,1),(14561,'நரசிங்கபுரம்',275,1),(14562,'நத்தமேடு',275,1),(14563,'நயப்பாக்கம்',275,1),(14564,'நெமிலி அகரம்',275,1),(14565,'நெய்வேலி',275,1),(14566,'நுங்கம்பாக்கம்',275,1),(14567,'ஒதிக்காடு',275,1),(14568,'பாக்கம்',275,1),(14569,'பள்ளியரைகுப்பம்',275,1),(14570,'பானம்பாக்கம்',275,1),(14571,'பாண்டூர்',275,1),(14572,'பாப்பரம்பாக்கம்',275,1),(14573,'பட்டரைபெரும்புதூர்',275,1),(14574,'பேரம்பாக்கம்',275,1),(14575,'பேரத்தூர்',275,1),(14576,'பெரியகுப்பம்',275,1),(14577,'பெருமாள்பட்டு',275,1),(14578,'பெரும்பாக்கம்',275,1),(14579,'பிள்ளையார்குப்பம்',275,1),(14580,'பிஞ்சிவாக்கம்',275,1),(14581,'பிரயாங்குப்பம்',275,1),(14582,'பிளேஸ்பாளையம்',275,1),(14583,'போளிவாக்கம்',275,1),(14584,'பூண்டி',275,1),(14585,'புதுகுப்பம்',275,1),(14586,'புதுமாவிலங்கை',275,1),(14587,'புல்லரம்பாக்கம்',275,1),(14588,'புலியூர்',275,1),(14589,'புங்கத்தூர்',275,1),(14590,'புன்னப்பாக்கம்',275,1),(14591,'புன்னப்பட்டு',275,1),(14592,'புதுப்பட்டு',275,1),(14593,'புட்லூர்',275,1),(14594,'இராமன்கோயில்',275,1),(14595,'இராமஞ்சேரி',275,1),(14596,'இராமதண்டலம்',275,1),(14597,'ரங்காபுரம்',275,1),(14598,'சத்தரை',275,1),(14599,'சேலை',275,1),(14600,'செம்பேடு',275,1),(14601,'சென்றான்பாளையம்',275,1),(14602,'சேத்துப்பாக்கம்',275,1),(14603,'செவ்வாய்பேட்டை',275,1),(14604,'சிங்கிலிகுப்பம்',275,1),(14605,'சிறியபேரம்பாக்கம்',275,1),(14606,'சிறுகடல்',275,1),(14607,'சிறுகளத்தூர்',275,1),(14608,'சிறுவானூர்',275,1),(14609,'சிவன்வாயல்',275,1),(14610,'தலக்காஞ்சேரி',275,1),(14611,'தாமரைப்பாக்கம்',275,1),(14612,'தண்டலம்',275,1),(14613,'தண்ணீர்குளம்',275,1),(14614,'தங்கானூர்',275,1),(14615,'தென்காரணை',275,1),(14616,'திருக்கணஞ்சேரி',275,1),(14617,'திருமேணிக்குப்பம்',275,1),(14618,'திருப்பந்தியூர்',275,1),(14619,'திருப்பாச்சூர்',275,1),(14620,'திருப்பேர்',275,1),(14621,'திருவூர்',275,1),(14622,'தொடுகாடு',275,1),(14623,'தோமூர்',275,1),(14624,'தொட்டிக்கலை',275,1),(14625,'தொழுவூர்',275,1),(14626,'தொழுதவாக்கம்',275,1),(14627,'திருவள்ளூர்',275,1),(14628,'உளுந்தை',275,1),(14629,'உத்திரம்பாக்கம்',275,1),(14630,'வைகாசி கண்டிகை',275,1),(14631,'வலசைவெட்டிக்காடு',275,1),(14632,'வரதாபுரம்',275,1),(14633,'வதட்டூர்',275,1),(14634,'வயலூர்',275,1),(14635,'விடையூர்',275,1),(14636,'வேடங்கிநல்லூர்',275,1),(14637,'வெள்ளேரித்தாங்கல்',275,1),(14638,'வெள்ளியூர்',275,1),(14639,'வெங்கல்',275,1),(14640,'வெங்கல் குப்பம்',275,1),(14641,'வெங்கத்தூர்',275,1),(14642,'வெண்மணம்புதூர்',275,1),(14643,'வெப்பம்பட்டு-1',275,1),(14644,'வெப்பம்பட்டு-2',275,1),(14645,'விளாப்பாக்கம்',275,1),(14646,'விஷ்ணுவாக்கம்',275,1),(14647,'அக்கரப்பாக்கம்',276,1),(14648,'ஆலப்பாக்கம்',276,1),(14649,'அழிஞ்சிவாக்கம்',276,1),(14650,'அமிதாநல்லூர்',276,1),(14651,'அம்மம்பாக்கம்',276,1),(14652,'அனந்தேரி',276,1),(14653,'அன்னதானகாக்கவாக்கம்',276,1),(14654,'அரியப்பாக்கம்',276,1),(14655,'அரியத்தூர்',276,1),(14656,'அரியப்பாக்கம்',276,1),(14657,'அத்திங்கிகாவனூர்',276,1),(14658,'அதிலிவாக்கம்',276,1),(14659,'அத்திவாக்கம்',276,1),(14660,'ஆத்துப்பாக்கம்',276,1),(14661,'ஆட்ரம்பாக்கம்',276,1),(14662,'ஆலப்பாக்கம்',276,1),(14663,'அவிச்சேரி',276,1),(14664,'சென்னகேசவபுரம்',276,1),(14665,'சித்தரியம்பாக்கம்',276,1),(14666,'தேவந்தவாக்கம்',276,1),(14667,'எடம்பேடு',276,1),(14668,'எல்லாபுரம்',276,1),(14669,'ஏனம்பாக்கம்',276,1),(14670,'எர்ணாங்குப்பம்',276,1),(14671,'கெருகம்பாக்கம்',276,1),(14672,'கூனிப்பாளையம்',276,1),(14673,'கோவிந்தராஜகுப்பம்',276,1),(14674,'குருபுரம்',276,1),(14675,'கையடை',276,1),(14676,'காக்கவாக்கம்',276,1),(14677,'கலவை',276,1),(14678,'கல்பட்டு',276,1),(14679,'கன்னிகைப்பேர்',276,1),(14680,'கச்சூர்',276,1),(14681,'காதர்வேடு',276,1),(14682,'கீழகரமனூர்',276,1),(14683,'கூரம்பாக்கம்',276,1),(14684,'கொரக்கந்தண்டலம்',276,1),(14685,'கோட்டகுப்பம்',276,1),(14686,'கிருஷ்ணாபுரம் கண்டிகை',276,1),(14687,'குஞ்சரம்',276,1),(14688,'லச்சிவாக்கம்',276,1),(14689,'மடவிளாகம்',276,1),(14690,'மதுரவாசல்',276,1),(14691,'மைலாப்பூர்',276,1),(14692,'மாம்பாக்கம்',276,1),(14693,'மாம்பள்ளம்',276,1),(14694,'மாம்பட்டு',276,1),(14695,'மஞ்சங்காரணை',276,1),(14696,'மேலக்கரமனூர்',276,1),(14697,'மாளந்தூர்',276,1),(14698,'மேல்மாளிகைப்கைபட்டு',276,1),(14699,'மெய்யூர்',276,1),(14700,'மூங்கில்பட்டு',276,1),(14701,'நம்பாக்கம்',276,1),(14702,'நயப்பாக்கம்',276,1),(14703,'நெல்வாய்',276,1),(14704,'நெய்வேலி',276,1),(14705,'ஓதப்பை',276,1),(14706,'பாகல்மேடு',276,1),(14707,'பாலவாக்கம்',276,1),(14708,'பனப்பாக்கம்',276,1),(14709,'பனப்பாக்கம்',276,1),(14710,'பனையஞ்சேரி',276,1),(14711,'பருத்திமேனிக்குப்பம்',276,1),(14712,'பென்னாலூர்பேட்டை',276,1),(14713,'பேரண்டூர்',276,1),(14714,'பேரிட்டிவாக்கம்',276,1),(14715,'பெரியபாளையம்',276,1),(14716,'பெருமுடிவாக்கம்',276,1),(14717,'போந்தவாக்கம்',276,1),(14718,'பூச்சி அத்திப்பட்டி',276,1),(14719,'புதுச்சேரி',276,1),(14720,'புன்னபாக்கம்',276,1),(14721,'ராள்ளபாடி',276,1),(14722,'சீயஞ்சேரி',276,1),(14723,'செங்கரை',276,1),(14724,'செங்காத்தாகுளம்',276,1),(14725,'செங்குன்றம்',276,1),(14726,'செஞ்சியரகம்',276,1),(14727,'சென்னங்காரணை',276,1),(14728,'சிறுணை',276,1),(14729,'சூளைமேனி',276,1),(14730,'தாமரைக்குப்பம்',276,1),(14731,'தண்டலம்',276,1),(14732,'தாராட்சி',276,1),(14733,'திம்மபூபாலபுரம்',276,1),(14734,'திருகண்டலம்',276,1),(14735,'திருநிலை',276,1),(14736,'தொளவேடு',276,1),(14737,'தொட்டாரெட்டிகுப்பம்',276,1),(14738,'தும்பாக்கம்',276,1),(14739,'ஊத்துக்கோட்டை',276,1),(14740,'வடமதுரை அ',276,1),(14741,'வடதில்லை',276,1),(14742,'வண்ணாங்குப்பம்',276,1),(14743,'வேளகாபுரம்',276,1),(14744,'வேலப்பாக்கம்',276,1),(14745,'வெள்ளாத்துக்கோட்டை',276,1),(14746,'வெம்பேடு',276,1),(14747,'12.புத்தூர்',277,1),(14748,'5.புதூர்',277,1),(14749,'ஆகரம்',277,1),(14750,'ஆதனூர்',277,1),(14751,'அடயபுலம்',277,1),(14752,'அகர்பாலயம்',277,1),(14753,'அரயலம்',277,1),(14754,'அரியபாடி',277,1),(14755,'ஆரணி',277,1),(14756,'ஆரணி (மேற்கு)',277,1),(14757,'அத்திமலை பட்டு',277,1),(14758,'அய்யம்பாளையம்',277,1),(14759,'இரும்பேடு',277,1),(14760,'கால்புன்டி',277,1),(14761,'கண்ணமங்கலம்',277,1),(14762,'கட்டுகனலூர்',277,1),(14763,'கீழ்நகர்',277,1),(14764,'கொளத்தூர்',277,1),(14765,'குண்ணத்தூர்',277,1),(14766,'குப்பம்',277,1),(14767,'மாமண்டூர்',277,1),(14768,'மருசூர்',277,1),(14769,'மாட்டதாரி',277,1),(14770,'மேல்நகர்',277,1),(14771,'மெய்யூர்',277,1),(14772,'மூர்பந்தாங்கல்',277,1),(14773,'முல்லந்திரம்',277,1),(14774,'முள்ளிப்பட்டு',277,1),(14775,'நிசல்',277,1),(14776,'ஓகையூர்',277,1),(14777,'பையூர்',277,1),(14778,'பாளையம்',277,1),(14779,'பனையூர்',277,1),(14780,'பூசிமலைகுப்பம்',277,1),(14781,'புளவன்பாடி',277,1),(14782,'புங்கம்பாடி',277,1),(14783,'ரந்தம்கொரட்டூர்',277,1),(14784,'ரத்தினமங்களம்',277,1),(14785,'ச.வி.நகரம்',277,1),(14786,'சென்னநண்டல்',277,1),(14787,'சேவூர்',277,1),(14788,'சிருமூர்',277,1),(14789,'தச்சூர்',277,1),(14790,'வடுகசாது',277,1),(14791,'வன்னான்குலம்',277,1),(14792,'வெலபாடி',277,1),(14793,'வெல்லெரி',277,1),(14794,'வெட்டியாந்தொழுவம்',277,1),(14795,'வின்னமங்கலம்',277,1),(14796,'ஆலப்புத்தூர்',278,1),(14797,'ஆலத்தூர்',278,1),(14798,'அல்லியந்தல்',278,1),(14799,'ஆனந்தவாடி',278,1),(14800,'ஆண்டிப்பட்டி',278,1),(14801,'அன்னந்தல்',278,1),(14802,'அந்தனூர்',278,1),(14803,'அன்வராபாத்',278,1),(14804,'அரசங்கண்ணி',278,1),(14805,'அரட்டவாடி',278,1),(14806,'அரிதாரிமங்கலம்',278,1),(14807,'அரியாக்குஞ்சூர்',278,1),(14808,'அஸ்வநாகசுரணை',278,1),(14809,'பீமானந்தல்',278,1),(14810,'செங்கம்',278,1),(14811,'சென்னசமுத்திரம்',278,1),(14812,'சின்னகோளாப்பாடி',278,1),(14813,'ஏந்தல்',278,1),(14814,'எறையூர்',278,1),(14815,'சி.கெங்கம்பட்டு',278,1),(14816,'இளங்குண்ணி',278,1),(14817,'ஜப்திகாரியந்தல்',278,1),(14818,'காக்கரசம்பாளையம்',278,1),(14819,'கல்லடாவி',278,1),(14820,'கல்லரப்பாடி',278,1),(14821,'கல்லாத்தூர்',278,1),(14822,'காஞ்சி',278,1),(14823,'கண்ணக்குருக்கை',278,1),(14824,'காரப்பட்டு',278,1),(14825,'கரிமலைபாடி',278,1),(14826,'கரியமங்கலம்',278,1),(14827,'கருங்காலிபாடிப்பட்டி',278,1),(14828,'கட்டமடுவு',278,1),(14829,'காயம்பட்டு',278,1),(14830,'கிளையூர்',278,1),(14831,'கீழ்படூர்',278,1),(14832,'கொரட்டாம்பட்டு',278,1),(14833,'கொட்டகுளம்',278,1),(14834,'குலால்பாடி',278,1),(14835,'குப்பநத்தம்',278,1),(14836,'குருமப்பட்டி',278,1),(14837,'மேல்படூர்',278,1),(14838,'மண்ணான்டிப்பட்டி',278,1),(14839,'மணிக்கல்',278,1),(14840,'மண்மலை',278,1),(14841,'மஷார்',278,1),(14842,'மேலப்புஞ்சை',278,1),(14843,'மேல்செங்கம்',278,1),(14844,'மேல்முடியனூர்',278,1),(14845,'மேல்நாச்சிப்பட்டு',278,1),(14846,'மேல்பள்ளிப்பட்டு',278,1),(14847,'மேல்பென்னாத்தூர்',278,1),(14848,'மேல்புழுதியூர்',278,1),(14849,'மேல்ராவந்தவாடி',278,1),(14850,'மேல்வணக்கம்பாடி',278,1),(14851,'முன்னூர்மங்கலம்',278,1),(14852,'முத்தனூர்',278,1),(14853,'பா.நல்லூர்',278,1),(14854,'சி.நம்மியந்தல்',278,1),(14855,'நந்திமங்கலம்',278,1),(14856,'நரடாப்பட்டு',278,1),(14857,'நரசிங்கநல்லூர்',278,1),(14858,'நத்தவாடி',278,1),(14859,'நயம்பாடி',278,1),(14860,'நீப்பத்துறை',278,1),(14861,'ஊர்கவுண்டனூர்',278,1),(14862,'ஓரவந்தவாடி',278,1),(14863,'பாச்சல்',278,1),(14864,'படிஅக்ரகாரம்',278,1),(14865,'பக்கிரிபாளையம்',278,1),(14866,'பாலியப்பட்டு',278,1),(14867,'பனைஓலைபாடி',278,1),(14868,'பண்டிரேவ்',278,1),(14869,'பரமனந்தல்',278,1),(14870,'பெரியகோளாப்பாடி',278,1),(14871,'பெரியேரி',278,1),(14872,'பெரும்பாக்கம்',278,1),(14873,'பெரும்பட்டம்',278,1),(14874,'பிஞ்சூர்',278,1),(14875,'பொரசப்பட்டு',278,1),(14876,'புதுப்பாளையம்',278,1),(14877,'புதுப்பட்டு',278,1),(14878,'கொ.புதுப்பட்டு',278,1),(14879,'புளியம்பட்டி',278,1),(14880,'புதூர்செங்கம்',278,1),(14881,'குயிலம்',278,1),(14882,'செ.நாச்சிப்பட்டு',278,1),(14883,'செ.அகரம்',278,1),(14884,'சேந்தமங்கலம்',278,1),(14885,'சி.சொர்ப்பனந்தல்',278,1),(14886,'தாமரைப்பாக்கம்',278,1),(14887,'தம்புநாயக்கன்பட்டி',278,1),(14888,'தாழையூத்து',278,1),(14889,'தீத்தாண்டாப்பட்டு',278,1),(14890,'தோக்கவாடி',278,1),(14891,'தொரப்பாடி',278,1),(14892,'துக்காப்பேட்டை',278,1),(14893,'உச்சிமலைகுப்பம்',278,1),(14894,'உண்ணாமலைபாளையம்',278,1),(14895,'வடமாத்தூர்',278,1),(14896,'வாய்விடாந்தாங்கல்',278,1),(14897,'வளையாம்பட்டு',278,1),(14898,'வாசுதேவம்பட்டு',278,1),(14899,'வேடங்குப்பம்',278,1),(14900,'வீரானந்தல்',278,1),(14901,'வெள்ளாலம்பட்டி',278,1),(14902,'விண்ணவனூர்',278,1),(14903,'ஆளியூர்',279,1),(14904,'அல்லியந்தல்',279,1),(14905,'அனாதிமங்கலம்',279,1),(14906,'அன்மருதை',279,1),(14907,'அப்பேடு',279,1),(14908,'அரசம்பட்டு',279,1),(14909,'ஆத்துரை',279,1),(14910,'ஆவணியாபுரம்',279,1),(14911,'சந்திரம்பாடி',279,1),(14912,'சேத்துப்பட்டு',279,1),(14913,'தேவிகாபுரம்',279,1),(14914,'தேவிமங்கலம்',279,1),(14915,'எடையக்குளத்தூர்',279,1),(14916,'ஏந்தல்',279,1),(14917,'கெங்கைசூடாமணி',279,1),(14918,'கெங்காபுரம்',279,1),(14919,'இமாபுரம்',279,1),(14920,'இந்திரவனம்',279,1),(14921,'இசாகொளத்தூர்',279,1),(14922,'ஜெகன்நாதபுரம்',279,1),(14923,'கல்யாணபுரம்',279,1),(14924,'கண்ணணூர்',279,1),(14925,'கட்டமங்கலம்',279,1),(14926,'கொலக்கரவாடி',279,1),(14927,'கொழப்பலூர்',279,1),(14928,'கோனையூர்',279,1),(14929,'கோனாமங்கலம்',279,1),(14930,'கொத்தந்தவாடி',279,1),(14931,'கோட்டுப்பாக்கம்',279,1),(14932,'கோழிபுலியூர்',279,1),(14933,'மடம்',279,1),(14934,'மன்சூராபாத்',279,1),(14935,'மரக்குணம்',279,1),(14936,'மருத்துவாம்பாடி',279,1),(14937,'மேலச்சேரி',279,1),(14938,'மேலானூர்',279,1),(14939,'மேலப்பூண்டி',279,1),(14940,'மேலத்தாங்கல்',279,1),(14941,'மேல்நந்தியம்பாடி',279,1),(14942,'மேல்சாத்தமங்கலம்',279,1),(14943,'மேல்வில்லிவலம்',279,1),(14944,'மோரக்கனியனூர்',279,1),(14945,'மோதனபாளையம்',279,1),(14946,'முருகமங்கலம்',279,1),(14947,'முருகநண்டல்',279,1),(14948,'நசாபுரம்',279,1),(14949,'நல்லடிசேனை',279,1),(14950,'நமத்தோடு',279,1),(14951,'நம்பேடு',279,1),(14952,'நரசிங்கபுரம்',279,1),(14953,'நாராயணமங்கலம்',279,1),(14954,'நரியம்பாடி',279,1),(14955,'நெடுங்குணம்',279,1),(14956,'ஓதலவாடி',279,1),(14957,'ஊத்தூர்',279,1),(14958,'பெரணபாக்கம்',279,1),(14959,'பெரணம்பாக்கம்',279,1),(14960,'பூங்குணம்',279,1),(14961,'Sசு. காட்டேரி',279,1),(14962,'செம்மாம்பாடி',279,1),(14963,'செவரப்பூண்டி',279,1),(14964,'செய்யானந்தல்',279,1),(14965,'சித்தாத்துரை',279,1),(14966,'சோலை அருகாவூர்',279,1),(14967,'சோழவரம்',279,1),(14968,'தச்சாம்பாடி',279,1),(14969,'தெள்ளாரம்பட்டு',279,1),(14970,'தெள்ளுர்',279,1),(14971,'தென்கடப்பந்தாங்கல்',279,1),(14972,'தும்பூர்',279,1),(14973,'உலகம்பட்டு',279,1),(14974,'வயலூர்',279,1),(14975,'வேப்பம்பட்டு',279,1),(14976,'வீரசம்பனூர்',279,1),(14977,'வினாயகபுரம்',279,1),(14978,'விசாமங்கலம்',279,1),(14979,'அகத்தேரிப்பட்டு',280,1),(14980,'ஆக்கூர்',280,1),(14981,'ஆலத்தூர்',280,1),(14982,'அளத்துறை',280,1),(14983,'அனப்பத்தூர்',280,1),(14984,'அனக்காவூர்',280,1),(14985,'அரசூர்',280,1),(14986,'ஆராத்திரிவேலூர்',280,1),(14987,'அருகாவூர்',280,1),(14988,'ரும்பருத்தி',280,1),(14989,'அத்தி',280,1),(14990,'பரிதிபுரம்',280,1),(14991,'சேராம்பட்டு',280,1),(14992,'செய்யாற்றைவென்றான்',280,1),(14993,'சித்தாமூர்',280,1),(14994,'தேவனாத்தூர்',280,1),(14995,'தூளி',280,1),(14996,'எச்சூர்',280,1),(14997,'எடவல்',280,1),(14998,'இளநீரகுன்றம்',280,1),(14999,'ஏனாதவாடி',280,1),(15000,'எரையூர்',280,1),(15001,'எருமைவெட்டி',280,1),(15002,'இருங்கல்',280,1),(15003,'அய்யவாடி',280,1),(15004,'ஜடேரி',280,1),(15005,'கடுகனூர்',280,1),(15006,'காரணை',280,1),(15007,'கழனிப்பாக்கம்',280,1),(15008,'காழியூர்',280,1),(15009,'கீழாத்தூர்',280,1),(15010,'கீழ்கொளத்தூர்',280,1),(15011,'கீழ்மட்டை',280,1),(15012,'கீழ்நீரகுன்றம்',280,1),(15013,'கீழ்நேத்தப்பாக்கம்',280,1),(15014,'கீழப்பந்தை',280,1),(15015,'கீழ்ப்புதுப்பாக்கம்',280,1),(15016,'கொடநகர்',280,1),(15017,'கூழமந்தல்',280,1),(15018,'கொற்க்கை',280,1),(15019,'கொருக்காத்தூர்',280,1),(15020,'கோட்டகரம்',280,1),(15021,'கோவிலூர்',280,1),(15022,'குன்னத்தூர்',280,1),(15023,'குன்னவாக்கம்',280,1),(15024,'குரும்பூர்',280,1),(15025,'மடிப்பாக்கம்',280,1),(15026,'மதுரை',280,1),(15027,'மகாஜனப்பாக்கம்',280,1),(15028,'மாளிகைப்பட்டு',280,1),(15029,'மங்கலம்',280,1),(15030,'மரியநல்லூர்',280,1),(15031,'மேல்கொளத்தூர்',280,1),(15032,'மேல்கொவளைவேடு',280,1),(15033,'மேல்மா',280,1),(15034,'மேல்மட்டை',280,1),(15035,'மேல்நகரம்பேடு',280,1),(15036,'மேல்நெமிலி',280,1),(15037,'மேல்புத்தூர்',280,1),(15038,'மேல்சீசமங்கலம்',280,1),(15039,'மேல்நர்மா',280,1),(15040,'முக்கூர்',280,1),(15041,'முளகிரிப்பட்டு',280,1),(15042,'முனுகப்பட்டு',280,1),(15043,'முருக்காத்தாம்புண்டி',280,1),(15044,'நல்லாளம்',280,1),(15045,'நரமாபள்ளம்',280,1),(15046,'நாவல்',280,1),(15047,'நாவல்பாக்கம்',280,1),(15048,'நெடும்பிறை',280,1),(15049,'நெடுங்கல்',280,1),(15050,'நெல்வாய்',280,1),(15051,'பைங்கிணர்',280,1),(15052,'பையூர்',280,1),(15053,'பல்லி',280,1),(15054,'பாண்டியம்பாக்கம்',280,1),(15055,'பாப்பந்தாங்கல்',280,1),(15056,'பாராசூர்',280,1),(15057,'பரதந்தாங்கல்',280,1),(15058,'பழஞ்சூர்',280,1),(15059,'பெரியகோயில்',280,1),(15060,'பெரும்பாலை',280,1),(15061,'பெரும்பள்ளம்',280,1),(15062,'பெருங்களத்தூர்',280,1),(15063,'பெரும்புண்டி',280,1),(15064,'பில்லாந்தி',280,1),(15065,'புதுக்கோட்டை',280,1),(15066,'புளிந்தை',280,1),(15067,'புளியரம்பாக்கம்',280,1),(15068,'புரிசை',280,1),(15069,'இராமகிருஷ்ணாபுரம்',280,1),(15070,'செங்காடு',280,1),(15071,'செங்காட்டான்குண்டில்',280,1),(15072,'சிறுங்கட்டூர்',280,1),(15073,'சிறுவெளியநல்லூர்',280,1),(15074,'சௌந்தரயபுரம்',280,1),(15075,'சுண்டிவாக்கம்',280,1),(15076,'தண்டரை',280,1),(15077,'தவசி',280,1),(15078,'தெனெலப்பாக்கம்',280,1),(15079,'தெனிலுப்பை',280,1),(15080,'தென்கல்பாக்கம்',280,1),(15081,'தென்மாவந்தல்',280,1),(15082,'தென்பூண்டிப்பட்டு',280,1),(15083,'தென்தண்டலம்',280,1),(15084,'தேத்துறை',280,1),(15085,'திருமணி',280,1),(15086,'திரும்புண்டி',280,1),(15087,'திருவத்தூர்',280,1),(15088,'தளரபாடி',280,1),(15089,'தொழுப்பேடு',280,1),(15090,'தும்பை',280,1),(15091,'உக்கல்',280,1),(15092,'வாச்சனூர்',280,1),(15093,'வடாஅளபிறந்தான்',280,1),(15094,'வடஎலப்பாக்கம்',280,1),(15095,'வடநாங்கூர்',280,1),(15096,'வடங்கம்பட்டு',280,1),(15097,'வடப்புணடிப்பட்டு',280,1),(15098,'வடதண்டலம்',280,1),(15099,'வடதின்னலூர்',280,1),(15100,'வடுகப்பட்டு',280,1),(15101,'வாழ்குடை',280,1),(15102,'விண்ணவாடி',280,1),(15103,'வீரம்பாக்கம்',280,1),(15104,'வெள்ளை',280,1),(15105,'வெள்ளேரிப்பட்டு',280,1),(15106,'வெளியநல்லூர்',280,1),(15107,'வெங்கோடு',280,1),(15108,'விளாரிப்பட்டு',280,1),(15109,'விண்ணமங்கலம்',280,1),(15110,'அமிரதி',281,1),(15111,'அத்திப்பட்டு',281,1),(15112,'ஏரியூர்',281,1),(15113,'எருக்கம்பட்டு',281,1),(15114,'எருமையனூர்',281,1),(15115,'கானமலை',281,1),(15116,'கீழ்கணவாயூர்',281,1),(15117,'கீழ்ப்பட்டு',281,1),(15118,'கீழ்தட்டியாப்பட்டு',281,1),(15119,'கீழ்தட்டியாப்பட்டு',281,1),(15120,'கோவிலூர்',281,1),(15121,'குட்டக்கரை',281,1),(15122,'மண்டபாறை',281,1),(15123,'மேல்பட்டு',281,1),(15124,'மேல்சிலம்படி',281,1),(15125,'மேல்சிப்பிலி',281,1),(15126,'மேல்தட்டியாப்பட்டு',281,1),(15127,'நம்மியம்பட்டு',281,1),(15128,'நீப்பலாம்பட்டு',281,1),(15129,'நெல்லிவாய்',281,1),(15130,'ஓடமங்கலம்',281,1),(15131,'படபஞ்சமரத்தூர்',281,1),(15132,'பட்டரைக்காடு',281,1),(15133,'பெலாமரத்தூர்',281,1),(15134,'பெருமுட்டம்',281,1),(15135,'புதுப்பட்டு',281,1),(15136,'புளியங்குப்பம்',281,1),(15137,'புலியூர்',281,1),(15138,'செண்பகத்தோப்பு',281,1),(15139,'செங்காடு',281,1),(15140,'சின்னக்கீழ்ப்பட்டு',281,1),(15141,'தும்பக்காடு',281,1),(15142,'வண்ணாங்குட்டை',281,1),(15143,'வீரப்பனுர்',281,1),(15144,'ஆதமங்கலம்',282,1),(15145,'அலங்காரமங்கலம்',282,1),(15146,'ஆனைவாடி',282,1),(15147,'அணியாலை',282,1),(15148,'அருணகிரிமங்கலம்',282,1),(15149,'தேவராயன்பாளையம்',282,1),(15150,'எலத்தூர்',282,1),(15151,'எரணாமங்கலம்',282,1),(15152,'கெங்கநல்லூர்',282,1),(15153,'கெங்கவரம்',282,1),(15154,'கச்சேரிமங்கலம்',282,1),(15155,'கடலாடி',282,1),(15156,'கலசபாக்கம்',282,1),(15157,'காலூர்',282,1),(15158,'காம்பட்டு',282,1),(15159,'காந்தபாளையம்',282,1),(15160,'கப்பலூர்',282,1),(15161,'கேட்டவரம்பாளையம்',282,1),(15162,'கிடாம்பாளையம்',282,1),(15163,'கீழ்பொத்தரை',282,1),(15164,'கீழ்பாலூர்',282,1),(15165,'லாடவரம்',282,1),(15166,'மட்டவெட்டு',282,1),(15167,'மேலாரணி',282,1),(15168,'மேல்பாலூர்',282,1),(15169,'மேல்சோழங்குப்பம்',282,1),(15170,'மேல்வில்வராயநல்லூர்',282,1),(15171,'ந.பி. பெற்றாள்',282,1),(15172,'பாடகம்',282,1),(15173,'படியம்புத்தூர்',282,1),(15174,'பானாம்பட்டு',282,1),(15175,'பத்தியவாடி',282,1),(15176,'பழங்கோயில்',282,1),(15177,'பில்லூர்',282,1),(15178,'பிராயம்பட்டு',282,1),(15179,'பூண்டி',282,1),(15180,'சீனந்தல்',282,1),(15181,'சீட்டாம்பட்டு',282,1),(15182,'சேங்கப்புத்தேரி',282,1),(15183,'கெங்கலமகாதேவி',282,1),(15184,'சிறுவள்ளூர்',282,1),(15185,'சோழவரம்',282,1),(15186,'தென்மாதிமங்கலம்',282,1),(15187,'தென்னகரம்',282,1),(15188,'தென்பள்ளியம்பட்டு',282,1),(15189,'வடகரைநம்மியந்தல்',282,1),(15190,'வன்னியனூர்',282,1),(15191,'வீரளூர்',282,1),(15192,'விண்ணுவாம்பட்டு',282,1),(15193,'ஆங்குணம்',283,1),(15194,'அகரம்',283,1),(15195,'ஆனானந்தல்',283,1),(15196,'ஆண்டாலூர்',283,1),(15197,'அண்டம்பள்ளம்',283,1),(15198,'அணுக்குமலை',283,1),(15199,'ஆராஞ்சி',283,1),(15200,'அரும்பாக்கம்',283,1),(15201,'ஆவூர்',283,1),(15202,'ஐங்குணம்',283,1),(15203,'செய்யலேரி',283,1),(15204,'ஏரப்பாக்கம்',283,1),(15205,'இலுப்பந்தாங்கல்',283,1),(15206,'எரும்பூண்டி',283,1),(15207,'இசுக்கழிக்காட்டேரி',283,1),(15208,'ஐமீன்கூடலூர்',283,1),(15209,'கடம்பை',283,1),(15210,'கலிங்கலேரி',283,1),(15211,'கலித்தேரி',283,1),(15212,'கல்லணை',283,1),(15213,'கல்லாயி',283,1),(15214,'கல்பூண்டி',283,1),(15215,'கானலாப்பாடி',283,1),(15216,'கனபாபுரம்',283,1),(15217,'கணியாம்பூண்டி',283,1),(15218,'கத்தாழம்பட்டு',283,1),(15219,'காரணாம்பூண்டி',283,1),(15220,'கருக்கலாம்பாடி',283,1),(15221,'காட்டுமலையனூர்',283,1),(15222,'காட்டுவேளானந்தல்',283,1),(15223,'கழிக்குளம்',283,1),(15224,'கீக்களுர்',283,1),(15225,'கீரனுர்',283,1),(15226,'கீழ்கரிப்பூர்',283,1),(15227,'கீழ்பென்னத்தூர்',283,1),(15228,'கொளத்தூர்',283,1),(15229,'கோணலூர்',283,1),(15230,'கொத்தந்தவாடி',283,1),(15231,'குமரகுடி',283,1),(15232,'குன்னங்குப்பம்',283,1),(15233,'மானாவரம்',283,1),(15234,'மதுராம்பட்டு',283,1),(15235,'மேக்களுர்',283,1),(15236,'நா.கெங்குப்பட்டு',283,1),(15237,'நாடழகானந்தல்',283,1),(15238,'நாரையூர்',283,1),(15239,'நாரயமங்கலம்',283,1),(15240,'நெய்வானத்தம்',283,1),(15241,'ஓலைப்பாடி',283,1),(15242,'ஊதம்பூண்டி',283,1),(15243,'பன்னியூர்',283,1),(15244,'பொலக்குணம்',283,1),(15245,'பொன்னமேடு',283,1),(15246,'புதமங்கலம்',283,1),(15247,'ராஐந்தாங்கல்',283,1),(15248,'ராயம்பேட்டை',283,1),(15249,'சாணிப்பூண்டி',283,1),(15250,'செல்லங்குப்பம்',283,1),(15251,'சோரப்பனந்தல்',283,1),(15252,'செவரப்பூண்டி',283,1),(15253,'சிறுகொத்தான்',283,1),(15254,'சிறுநாத்தூர்',283,1),(15255,'சோ.நம்மியந்தல்',283,1),(15256,'சோமாசிப்பாடி',283,1),(15257,'சொரத்தூர்',283,1),(15258,'தண்டரை',283,1),(15259,'வி.நெய்குப்பம்',283,1),(15260,'வைப்பூர்',283,1),(15261,'வைரபெரியாங்குப்பம்',283,1),(15262,'வட்டாரப்புத்தூர்',283,1),(15263,'வயலூர்',283,1),(15264,'வழுதலங்குணம்',283,1),(15265,'வேடநத்தம்',283,1),(15266,'வேடந்தவாடி',283,1),(15267,'வேளானந்தல்',283,1),(15268,'வென்னியந்தல்',283,1),(15269,'வேட்டவலம்',283,1),(15270,'ஆலம்பூண்டி',284,1),(15271,'அலியாலமங்கலம்',284,1),(15272,'அலியாபாத்',284,1),(15273,'அல்லிநகர்',284,1),(15274,'அனந்தபுரம்',284,1),(15275,'அரியாத்தூர்',284,1),(15276,'அரும்பலூர்',284,1),(15277,'அத்திமூர்',284,1),(15278,'ஆத்துவாம்பாடி',284,1),(15279,'எடப்பிறை',284,1),(15280,'ஏந்துவாம்பாடி',284,1),(15281,'எட்டிவாடி',284,1),(15282,'ஈயகொளத்தூர்',284,1),(15283,'எழுவாம்பாடி',284,1),(15284,'கூடலூர்',284,1),(15285,'இலுப்பகுணம்',284,1),(15286,'இரும்புலி',284,1),(15287,'இருவட்டேணி',284,1),(15288,'ஜம்புகோணம்பட்டு',284,1),(15289,'ஜடதாரிகுப்பம்',284,1),(15290,'காங்கிரானந்தல்',284,1),(15291,'களியம்',284,1),(15292,'கல்குப்பம்',284,1),(15293,'கல்பட்டு',284,1),(15294,'காளசமுத்திரம்',284,1),(15295,'கல்வாசல்',284,1),(15296,'காங்கேயனூர்',284,1),(15297,'கரப்பூண்டி',284,1),(15298,'கரிக்காத்தூர்',284,1),(15299,'கஸ்தம்பாடி',284,1),(15300,'கட்டிப்புண்டி',284,1),(15301,'கேளூர்',284,1),(15302,'கீழ்கரிக்காத்தூர்',284,1),(15303,'கீழ்பட்டு',284,1),(15304,'கொரால்பாக்கம்',284,1),(15305,'கொழாவூர்',284,1),(15306,'குன்னத்தூர்',284,1),(15307,'குப்பம்',284,1),(15308,'குருவிமலை',284,1),(15309,'மடவிளாகம்',284,1),(15310,'மாம்பட்டு',284,1),(15311,'மண்டகொளத்தூர்',284,1),(15312,'மாணிக்கவள்ளி',284,1),(15313,'மட்டபிறையூர்',284,1),(15314,'மொடையூர்',284,1),(15315,'முக்குறும்பை',284,1),(15316,'முனியந்தாங்கல்',284,1),(15317,'முருகாபாடி',284,1),(15318,'நாராயணகுப்பம்',284,1),(15319,'ஓசூர்',284,1),(15320,'ஒதியந்தாங்கல்',284,1),(15321,'ஓடநகரம்',284,1),(15322,'ஓட்டேரி',284,1),(15323,'படவேடு',284,1),(15324,'படியம்பட்டு',284,1),(15325,'பால்வாரத்துவென்றான்',284,1),(15326,'பாப்பாம்பாடி',284,1),(15327,'பார்வதிஅகரம்',284,1),(15328,'பெலாசூர்',284,1),(15329,'பெரியகரம்',284,1),(15330,'போளூர்',284,1),(15331,'பொத்தரை',284,1),(15332,'புதுப்பாளையம்',284,1),(15333,'புலிவானந்தல்',284,1),(15334,'புஷ்பகிரி',284,1),(15335,'ராந்தம்',284,1),(15336,'ராயங்குப்பம்',284,1),(15337,'ரெண்டேரிப்பட்டு',284,1),(15338,'சதுப்பேரிபாளையம்',284,1),(15339,'சனிக்கவாடி',284,1),(15340,'சந்தவாசல்',284,1),(15341,'சதுப்பேரி',284,1),(15342,'செம்மியமங்கலம்',284,1),(15343,'செங்குணம்',284,1),(15344,'சேதாரம்பட்டு',284,1),(15345,'சித்தேரி',284,1),(15346,'சோமந்தபுத்தூர்',284,1),(15347,'சோத்துக்கண்ணி',284,1),(15348,'சு.நம்மியந்தல்',284,1),(15349,'தேப்பனந்தல்',284,1),(15350,'திருவாட்டியாந்தல்',284,1),(15351,'துளுவபுஷ்பகிரி',284,1),(15352,'துரிஞ்சிகுப்பம்',284,1),(15353,'திண்டிவனம்',284,1),(15354,'திருமலை',284,1),(15355,'திருசூர்',284,1),(15356,'வடமாதிமங்கலம்',284,1),(15357,'வம்பலூர்',284,1),(15358,'வசூர்',284,1),(15359,'வாழியூர்',284,1),(15360,'வெளியூர்',284,1),(15361,'வெண்மணி',284,1),(15362,'விளாப்பாக்கம்',284,1),(15363,'விளாங்குப்பம்',284,1),(15364,'ஆத்திப்பாடி',285,1),(15365,'அகரம்பள்ளிப்பட்டு',285,1),(15366,'அக்கரைப்பட்டி',285,1),(15367,'அல்லப்பனூர்',285,1),(15368,'அப்புநாயக்கன்பாளையம்',285,1),(15369,'பீமரப்பட்டி',285,1),(15370,'போந்தை',285,1),(15371,'சின்னியம்பேட்டை',285,1),(15372,'எடக்கல்',285,1),(15373,'எடத்தனூர்',285,1),(15374,'ஜம்போடை',285,1),(15375,'க.உண்ணாமலைபாளையம்',285,1),(15376,'காம்பட்டு',285,1),(15377,'கண்ணக்கந்தல்',285,1),(15378,'கீழ்பாச்சார்',285,1),(15379,'கீழ்ராவந்தவாடி',285,1),(15380,'கீழ்சிறுப்பாக்கம்',285,1),(15381,'கீழ்வணக்கம்பாடி',285,1),(15382,'கொளமஞ்சனூர்',285,1),(15383,'கொட்டையூர்',285,1),(15384,'கொழுந்தம்பட்டு',285,1),(15385,'குங்கிலியநத்தம்',285,1),(15386,'மலையனூர்செக்கடி',285,1),(15387,'மலமஞ்சனூர்',285,1),(15388,'மழுவம்பட்டு',285,1),(15389,'மேல்கரிப்பூர்',285,1),(15390,'மேல்மலச்சி',285,1),(15391,'மேல்முத்தானூர்',285,1),(15392,'மேல்பாச்சார்',285,1),(15393,'மேல்சிறுப்பாக்கம்',285,1),(15394,'மோத்தக்கல்',285,1),(15395,'நாராயணகுப்பம்',285,1),(15396,'நெடுங்காவாடி',285,1),(15397,'ஒலகலப்பாடி',285,1),(15398,'பேராயம்பட்டு',285,1),(15399,'பெருங்குளத்தூர்',285,1),(15400,'பெருந்துறைப்பட்டு',285,1),(15401,'புதூர்செக்கடி',285,1),(15402,'புத்தூர்செக்கடி',285,1),(15403,'ராதாபுரம்',285,1),(15404,'ராயண்டபுரம்',285,1),(15405,'ரெட்டியாப்பாளையம்',285,1),(15406,'சதகுப்பம்',285,1),(15407,'சாத்தனூர்',285,1),(15408,'செ.ஆண்டாப்பட்டு',285,1),(15409,'செ.கூடலூர்',285,1),(15410,'செம்மம்பட்டி',285,1),(15411,'சேரந்தாங்கல்',285,1),(15412,'சேர்ப்பாப்பட்டு',285,1),(15413,'டி.வேலூர்',285,1),(15414,'தண்டராம்பட்டு',285,1),(15415,'தானிப்பாடி',285,1),(15416,'தென்கரிம்பலூர்',285,1),(15417,'தென்முடியனூர்',285,1),(15418,'திருவடத்தனூர்',285,1),(15419,'தொண்டமானூர்',285,1),(15420,'தரடாப்பட்டு',285,1),(15421,'வாக்கிலாப்பட்டு',285,1),(15422,'வாணாபுரம்',285,1),(15423,'வரகூர்',285,1),(15424,'வாழவச்சனூர்',285,1),(15425,'வீரணம்',285,1),(15426,'வேப்பூர்செக்கடி',285,1),(15428,'அடிஅண்ணாமலை',NULL,1),(15429,'அகரம்சிப்பந்தி',286,1),(15430,'அல்லிகொண்டாப்பட்டு',NULL,1),(15432,'அப்புப்பட்டு',286,1),(15434,'ஆரப்பாக்கம்',286,1),(15435,'அரசுடையாம்பட்டு',286,1),(15436,'ஆரூத்திராப்பட்டு',286,1),(15437,'அத்திப்பட்டு',286,1),(15438,'அத்தியந்தல்',319,1),(15439,'அய்யம்பாளையம்',319,1),(15440,'அழகானந்தல்',286,1),(15441,'சி.ஆண்டாப்பட்டு',286,1),(15442,'சக்கரத்தாமடை',286,1),(15443,'சின்னங்காங்கேயனூர்',286,1),(15444,'சின்னகல்லப்பபாடி',319,1),(15445,'தேவனாம்பட்டு',319,1),(15446,'தேவனந்தல்',319,1),(15447,'தேவனூர்',319,1),(15448,'துரக்கைநம்மியந்தல்',319,1),(15449,'துரிஞ்சாபுரம்',319,1),(15450,'இனாம்காரியந்தல்',319,1),(15451,'காடகமான்',286,1),(15452,'கல்லேரி',286,1),(15453,'கல்லொட்டு',286,1),(15454,'கமலப்புத்தூர்',286,1),(15457,'கண்ணப்பந்தல்',319,1),(15458,'காரகோணம்',286,1),(15459,'கருந்துவாம்பாடி',319,1),(15460,'க தம்பாடி',286,1),(15461,'காட்டடாம்பூண்டி',319,1),(15462,'காட்டுபபுத்தூர்',286,1),(15463,'காவேரயாம்பூண்டி',286,1),(15464,'கிளியாப்பட்டு',319,1),(15465,'கீழணைக்கரை',319,1),(15466,'கீழாத்தூர்',286,1),(15467,'கீழ்செட்டிப்பட்டு',319,1),(15468,'கீழ்கச்சிராப்பட்டு',319,1),(15469,'கீழ்நாத்தூர்',319,1),(15470,'கொளக்குடி',286,1),(15471,'கொளக்கரவாடி',319,1),(15472,'கோசாலை',286,1),(15473,'கூத்தலவாடி',319,1),(15474,'கோவூர்',286,1),(15475,'குன்னியந்தல்',319,1),(15476,'குன்னுமுறிஞ்சி',286,1),(15477,'மலப்பாம்பாடி',286,1),(15478,'ம.நாயக்கன்பாளையம்',286,1),(15479,'மல்லவாடி',319,1),(15480,'மங்கலம்',319,1),(15481,'மஞ்சம்பூண்டி',319,1),(15482,'மருத்துவாம்பாடி',319,1),(15483,'மாதலம்பாடி',319,1),(15484,'மேலதிக்கான்',286,1),(15485,'மேல்செட்டிப்பட்டு',286,1),(15486,'மேல்கச்சிராப்பட்டு',286,1),(15487,'மேல்புத்தியந்தல்',286,1),(15488,'மேப்பத்துரை',286,1),(15489,'மெய்யூர்',319,1),(15490,'முனியந்தல்',286,1),(15491,'முத்திரசம்பட்டு',286,1),(15492,'நாச்சானந்தல்',319,1),(15493,'நடுப்பட்டு',286,1),(15494,'நாயுடுமங்கலம்',319,1),(15495,'நல்லான்பிள்ளைபெற்றாள்',319,1),(15496,'நல்லவன்பாளையம்',319,1),(15497,'நரியப்பட்டு',286,1),(15498,'நாரத்தாம்புண்டி',319,1),(15499,'நவம்பட்டு',319,1),(15500,'நாயர்பட்டு',286,1),(15501,'நெல்லிமேடு',286,1),(15502,'நொச்சிமலை',286,1),(15503,'நூக்காம்பாடி',319,1),(15504,'ஊசாம்பாடி',319,1),(15505,'பாலானந்தல்',286,1),(15506,'பள்ளிக்கொண்டாப்பட்டு',319,1),(15507,'பள்ளியம்பட்டு',286,1),(15508,'பனையூர்',286,1),(15509,'பண்டிதப்பட்டு',319,1),(15510,'பறையம்பட்டு',286,1),(15511,'பவித்திரம்',286,1),(15513,'பழையனூர்',319,1),(15514,'பெரியகல்லப்பாடி',319,1),(15515,'பெரியகிளாம்பாடி',286,1),(15516,'பெருமணம்',286,1),(15517,'பிச்சானந்நதல்',286,1),(15518,'பொற்குணம்',286,1),(15519,'பொரிக்கல்',286,1),(15520,'ராந்தம்',286,1),(15521,'சடையனோடை',286,1),(15522,'சாலையனூர்',286,1),(15523,'சம்மந்தனூர்',286,1),(15524,'சமுத்திரம்',319,1),(15525,'சானானந்தல்',286,1),(15526,'சாவல்பூண்டி',286,1),(15527,'சீலப்பந்தல்',319,1),(15528,'சிறுகிளாம்பாடி',286,1),(15529,'சோ.நாச்சிப்பட்டு',286,1),(15530,'சொரகுளத்தூர்',319,1),(15531,'சொரந்தை',286,1),(15532,'சு.ஆண்டாப்பட்டு',286,1),(15533,'சு.கீழ்நாச்சிப்பட்டு',319,1),(15534,'சு.நல்லூர்',286,1),(15535,'சு.பாப்பாம்பாடி',286,1),(15536,'சு. வாளாவெட்டி',286,1),(15537,'தச்சம்பட்டு',319,1),(15538,'தலையாம்பள்ளம்',319,1),(15539,'தெள்ளானந்தல்',286,1),(15540,'தென்மாத்தூர்',319,1),(15541,'திருக்களுர்வாளாவெட்டி',286,1),(15542,'திருவாணைமுகம்',286,1),(15543,'திருவண்ணாமலை',286,1),(15544,'திருவரங்கவாளாவெட்டி',286,1),(15545,'உடையானந்தல்',286,1),(15546,'உதிரம்புண்டி',286,1),(15547,'வ.நம்மியந்தல்',286,1),(15548,'வ.ஆண்டாப்பட்டு',286,1),(15549,'வடகரிங்காலிப்பாடி',286,1),(15550,'வடகரிம்பலூர்',286,1),(15551,'வடபுழதியூர்',319,1),(15552,'வள்ளிவாகை',319,1),(15553,'வாணியந்தாங்கல்',286,1),(15554,'வேளையாம்பாக்கம்',286,1),(15555,'வெளுக்கனந்தல்',286,1),(15556,'வெளுக்கனந்தல்',286,1),(15557,'வெங்காயவேலூர்',319,1),(15558,'வேங்கிக்கால்',319,1),(15559,'வெரையூர்',319,1),(15560,'விருதுவிளங்கினான்',286,1),(15561,'விசுவந்தாங்கல்',286,1),(15562,'ஆச்சமங்கலம்',287,1),(15563,'அகரகொரக்கோட்டை',287,1),(15564,'அகரம்',287,1),(15565,'அம்மணம்பாக்கம்',287,1),(15566,'அமூடுர்',287,1),(15567,'ஆனைபோகி',287,1),(15568,'அரசூர்',287,1),(15569,'அரியம்பூண்டி',287,1),(15570,'அரியபாடி',287,1),(15571,'ஆரயாத்தூர்',287,1),(15572,'அருங்குணம்',287,1),(15573,'அருந்தோடு',287,1),(15574,'அதியனூர்',287,1),(15575,'அத்திப்பாக்கம்',287,1),(15576,'அதியங்குப்பம்',287,1),(15577,'ஆவணவாடி',287,1),(15578,'ஆயலவாடி',287,1),(15579,'பாதூர்',287,1),(15580,'பிருதூர்',287,1),(15581,'சேத்துப்பட்டு',287,1),(15582,'தேசூர்',287,1),(15583,'எய்ப்பாக்கம்',287,1),(15584,'ஏம்பலம்',287,1),(15585,'எரமலூர்',287,1),(15586,'ஏரிப்பட்டு',287,1),(15587,'எறும்பூர்',287,1),(15588,'கெங்கம்பூண்டி',287,1),(15589,'கூனம்பாடி',287,1),(15590,'கூடலூர்',287,1),(15591,'இளங்காடு',287,1),(15592,'இஞ்சிமேடு',287,1),(15593,'இரும்பேடு',287,1),(15594,'இரும்பிலி',287,1),(15595,'ஜம்மம்பட்டு',287,1),(15596,'ஜப்திகாரணி',287,1),(15597,'கடம்பை',287,1),(15598,'கல்பட்டுநைனாங்குப்பம்',287,1),(15599,'கண்டவராட்டி',287,1),(15600,'கண்டியநல்லூர்',287,1),(15601,'காரம்',287,1),(15602,'காரணை',287,1),(15603,'கருடபுரம்',287,1),(15604,'காவணியாத்தூர்',287,1),(15605,'காவேடு',287,1),(15606,'கீழ்நர்மா',287,1),(15607,'கீழ்கொடுங்காலூர்',287,1),(15608,'கீழ்குவளைவேடு',287,1),(15609,'கீழ்நமண்டி',287,1),(15610,'கீழ்பாக்கம்',287,1),(15611,'கீழ்புத்தூர்',287,1),(15612,'கீழ்சாத்தமங்கலம்',287,1),(15613,'கீழ்செம்பேடு',287,1),(15614,'கீழ்சீசமங்கலம்',287,1),(15615,'கீழ்வெள்ளியூர்',287,1),(15616,'கீழ்வில்லிவலம்',287,1),(15617,'கிழங்குணம்',287,1),(15618,'கொடநல்லூர்',287,1),(15619,'கொடியாலம்',287,1),(15620,'கோயில்குப்பம்',287,1),(15621,'கூத்தம்பட்டு',287,1),(15622,'கூத்தவேடு',287,1),(15623,'கொரக்கோட்டை',287,1),(15624,'கொசப்பட்டு',287,1),(15625,'கோதண்டபுரம்',287,1),(15626,'கொட்டை',287,1),(15627,'கொவளை',287,1),(15628,'குண்ணகம்பூண்டி',287,1),(15629,'மகமாயிதிருமணி',287,1),(15630,'மகாதேவிமங்கலம்',287,1),(15631,'மாமண்டுர்',287,1),(15632,'மாம்பட்டு',287,1),(15633,'மங்கலம்',287,1),(15634,'மங்கநல்லூர்',287,1),(15635,'மாணிக்கமங்கலம்',287,1),(15636,'மருதாடு',287,1),(15637,'மாவலவாடி',287,1),(15638,'மழையூர்',287,1),(15639,'மழவங்கரணை',287,1),(15640,'மீசநல்லூர்',287,1),(15641,'மேல்கொடுங்காலூர்',287,1),(15642,'மேல்பாளையம்',287,1),(15643,'மேல்பாதி',287,1),(15644,'மேல்செம்பேடு',287,1),(15645,'மோசவாடி',287,1),(15646,'மூடூர்',287,1),(15647,'மும்முனி',287,1),(15648,'நடுகுப்பம்',287,1),(15649,'நல்லேரி',287,1),(15650,'நல்லூர்',287,1),(15651,'நம்பேடு',287,1),(15652,'நாவல்பாக்கம்',287,1),(15653,'நெல்லியாங்குளம்',287,1),(15654,'நெற்குணம்',287,1),(15655,'ஓசூர்',287,1),(15656,'ஒழப்பாக்கம்',287,1),(15657,'படூர்',287,1),(15658,'பாஞ்சரை',287,1),(15659,'பாப்பநல்லுர்',287,1),(15660,'பாதிரி',287,1),(15661,'பழவேரி',287,1),(15662,'பென்னாட்டகரம்',287,1),(15663,'பெரணமல்லூர்',287,1),(15664,'பெருங்கடபுத்தூர்',287,1),(15665,'பொன்னூர்',287,1),(15666,'புலிவாய்',287,1),(15667,'புன்னை',287,1),(15668,'ரகுநாதசமுத்திரம்',287,1),(15669,'ராமசமுத்திரம்',287,1),(15670,'ரெட்டிக்குப்பம்',287,1),(15671,'சாலவேடு',287,1),(15672,'சலுக்கை',287,1),(15673,'சாத்தனூர்',287,1),(15674,'சத்தியவாடி',287,1),(15675,'சாத்தப்பூண்டி',287,1),(15676,'சீயாளம்',287,1),(15677,'சீயமங்கலம்',287,1),(15678,'செம்பூர்',287,1),(15679,'சேனல்',287,1),(15680,'சென்னாவரம்',287,1),(15681,'செப்டாங்குளம்',287,1),(15682,'சேதாரக்குப்பம்',287,1),(15683,'சிங்கம்பூண்டி',287,1),(15684,'சிறுநாவல்பாக்கம்',287,1),(15685,'சித்தருகாவூர்',287,1),(15686,'சிவனம்',287,1),(15687,'சோகத்தூர்',287,1),(15688,'சோரப்புத்தூர்',287,1),(15689,'ஸ்ரீரங்கராஐபுரம்',287,1),(15690,'சு. காட்டேர',287,1),(15691,'தாடிநொளம்பை',287,1),(15692,'தக்கண்டராயபுரம்',287,1),(15693,'தவணி',287,1),(15694,'தாழம்பள்ளம்',287,1),(15695,'தழுதாழை',287,1),(15696,'தெள்ளார்',287,1),(15697,'தெள்ளூர்',287,1),(15698,'தெனாளப்பிறந்தான்',287,1),(15699,'தென்கரை',287,1),(15700,'தென்னாங்கூர்',287,1),(15701,'தென்னாத்தூர்',287,1),(15702,'தென்சேந்தமங்கலம்',287,1),(15703,'தென்திண்ணலூர்',287,1),(15704,'தென்வணக்கம்பாடி',287,1),(15705,'தெய்யார்',287,1),(15706,'திரக்கோயில்',287,1),(15707,'உளுந்தை',287,1),(15708,'ஊர்குடி',287,1),(15709,'வடக்குப்பட்டு',287,1),(15710,'வட வணக்கம்பாடி',287,1),(15711,'வடுகமங்கலம்',287,1),(15712,'வல்லம்',287,1),(15713,'வந்தவாசி',287,1),(15714,'வங்காரம்',287,1),(15715,'வழூர்',287,1),(15716,'வெடால்',287,1),(15717,'வெளியம்பாக்கம்',287,1),(15718,'வெங்குணம்',287,1),(15719,'வெண்மந்தை',287,1),(15720,'விளாநல்லூர்',287,1),(15721,'விளங்காடு',287,1),(15722,'விழுதுபட்டு',287,1),(15723,'அப்துல்லாபுரம்',288,1),(15724,'ஆனந்தாங்கல்',288,1),(15725,'அரசாணிப்பாலை',288,1),(15726,'அரசங்குப்பம்',288,1),(15727,'அரியரப்பாக்கம்',288,1),(15728,'அரியூர்',288,1),(15729,'அசனமாப்பேட்டை',288,1),(15730,'அழிஞ்சல்பட்டு',288,1),(15731,'அழிவிடைதாங்கி',288,1),(15732,'பகவந்தபுரம்',288,1),(15733,'பிரம்மதேசம்',288,1),(15734,'செல்லபெரும்புலிமேடு',288,1),(15735,'செய்யனூர்',288,1),(15736,'சித்தலப்பாக்கம்',288,1),(15737,'சித்தாத்தூர்',288,1),(15738,'சோழவரம்',288,1),(15739,'தரமச்சேரி',288,1),(15740,'தூசி',288,1),(15741,'ஏழாச்சேரி',288,1),(15742,'கிரிஜாபுரம்',288,1),(15743,'இருமரம்',288,1),(15744,'காகனம்',288,1),(15745,'கம்மந்தாங்கல்',288,1),(15746,'கனகம்பாக்கம்',288,1),(15747,'கணிகிலுப்பை',288,1),(15748,'கரந்தை',288,1),(15749,'கீழ்நாய்க்கன்பாளையம்',288,1),(15750,'கீழ்நெல்லி',288,1),(15751,'கொடைய்ம்பாக்கம்',288,1),(15752,'குண்டியாந்தண்டலம்',288,1),(15753,'குரங்கணில்முட்டம்',288,1),(15754,'குத்தனூர்',288,1),(15755,'மாமண்டூர்',288,1),(15756,'மாங்கால்',288,1),(15757,'மாத்தூர்',288,1),(15758,'மேல்பூதேரி',288,1),(15759,'மேனல்லூர்',288,1),(15760,'மோரணம்',288,1),(15761,'ழூஞ்ஞூர்பட்டு',288,1),(15762,'நமண்டி',288,1),(15763,'நரசமங்கலம்',288,1),(15764,'நாட்டேரி',288,1),(15765,'நாயந்தாங்கல்',288,1),(15766,'நெமிலி',288,1),(15767,'ஒழுக்கவாக்கம்',288,1),(15768,'பில்லர்நதாங்கல்',288,1),(15769,'பல்லாவரம்',288,1),(15770,'பனைமுகை',288,1),(15771,'பாவூர்',288,1),(15772,'பெருமந்தாங்கல்',288,1),(15773,'பெரும்புலிமேடு',288,1),(15774,'பெருங்கட்டூர்',288,1),(15775,'புனைத்தாங்கல்',288,1),(15776,'புந்தண்டலம்',288,1),(15777,'பூதேரி',288,1),(15778,'புதுப்பாளையம்',288,1),(15779,'புலிவலம்',288,1),(15780,'புல்லவாக்கம்',288,1),(15781,'புண்ணை',288,1),(15782,'ராந்தம்',288,1),(15783,'சட்டுவந்தாங்கல்',288,1),(15784,'சீவரம்',288,1),(15785,'சேலேரி',288,1),(15786,'சேணியநல்லூர்',288,1),(15787,'செட்டித்தாங்கல்',288,1),(15788,'சிறுநாவல்பட்டு',288,1),(15789,'சிறுநல்லூர்',288,1),(15790,'சிறுவஞ்சிப்பட்டு',288,1),(15791,'சோதியம்பாக்கம்',288,1),(15792,'சுமங்கலி',288,1),(15793,'சுனைப்பட்டு',288,1),(15794,'சுருட்டல்',288,1),(15795,'தாளிக்கல்',288,1),(15796,'தண்டப்பந்தாங்கல்',288,1),(15797,'தென்கழனி',288,1),(15798,'தென்னம்பட்டு',288,1),(15799,'திருப்பணமூர்',288,1),(15800,'திருப்பனங்காடு',288,1),(15801,'திருவடிராயபுரம்',288,1),(15802,'உக்கம்பெரும்பாக்கம்',288,1),(15803,'உமையாள்புரம்',288,1),(15804,'வடஇலுப்பை',288,1),(15805,'வடகல்பாக்கம்',288,1),(15806,'வடமணபாக்கம்',288,1),(15807,'வடமாவந்தல்',288,1),(15808,'வாகை',288,1),(15809,'வயலாத்தூர்',288,1),(15810,'வாழவந்தல்',288,1),(15811,'வெள்ளகுளம்',288,1),(15812,'வெம்பாக்கம்',288,1),(15813,'வெங்களத்தூர்',288,1),(15814,'அகரம்',289,1),(15815,'அக்ரஹாரம்',289,1),(15816,'அல்லேரி',289,1),(15817,'அணைக்கட்டு',289,1),(15818,'அப்புக்கல்',289,1),(15819,'அரிமலை',289,1),(15820,'ஆர்ஜாதி',289,1),(15821,'ஆசனாம்பட்டு',289,1),(15822,'அத்திகுப்பம்',289,1),(15823,'அத்தியூர்',289,1),(15824,'பூதூர்',289,1),(15825,'பிராமணமங்கலம்',289,1),(15826,'சின்னபள்ளிகுப்பம்',289,1),(15827,'தேவிசெட்டிகுப்பம்',289,1),(15828,'இலவம்பாடி',289,1),(15829,'எள்ளுபாறை',289,1),(15830,'இறையன்காடு',289,1),(15831,'கெங்கநல்லூர்',289,1),(15832,'கோவிந்தம்பாடி',289,1),(15833,'குருவராஜபாளையம்',289,1),(15834,'ஜார்தான்கொல்லை',289,1),(15835,'கழனிப்பாக்கம்',289,1),(15836,'கல்லப்பாறை',289,1),(15837,'கந்தனேரி',289,1),(15838,'கரடிகுடி',289,1),(15839,'கருங்காலி',289,1),(15840,'கத்தாரிகுப்பம்',289,1),(15841,'கீழாச்சூர்',289,1),(15842,'கீழ்கொத்தூர்',289,1),(15843,'கீழ்கிருஷ்ணாபுரம்',289,1),(15844,'கெங்கசாணிக்குப்பம்',289,1),(15845,'கொம்மளாங்குட்டை',289,1),(15846,'குப்பம்',289,1),(15847,'குப்பம்பாளையம்',289,1),(15848,'குப்பம்பட்டு',289,1),(15849,'மடையப்பட்டு',289,1),(15850,'மகமதுபுரம்',289,1),(15851,'மேலரசம்பட்டு',289,1),(15852,'மேல்பள்ளிபட்டு',289,1),(15853,'முள்ளுவாடி',289,1),(15854,'முருக்கேரி',289,1),(15855,'நெடுமிபாளையம்',289,1),(15856,'நேமந்தபுரம்',289,1),(15857,'ஒடுகத்தூர்',289,1),(15858,'ஒக்கனாபுரம்',289,1),(15859,'ஓங்கப்பாடி',289,1),(15860,'ஒதியத்தூர்',289,1),(15861,'பாக்கம்',289,1),(15862,'பாக்கம்பாளையம்',289,1),(15863,'பாலப்பாடி',289,1),(15864,'பள்ளிகொண்டா',289,1),(15865,'பீஞ்சமந்தை',289,1),(15866,'பெலாம்பட்டு',289,1),(15867,'பெரியபனப்பாறை',289,1),(15868,'பின்னத்துறை',289,1),(15869,'பொய்கை',289,1),(15870,'புதுக்குப்பம்',289,1),(15871,'புலிமேடு',289,1),(15872,'புத்தூர்',289,1),(15873,'இராமநாயிணிகுப்பம்',289,1),(15874,'சத்தியமங்கலம்',289,1),(15875,'சேக்கனூர்',289,1),(15876,'செம்பேடு',289,1),(15877,'சேர்பாடி',289,1),(15878,'செதுவாலை',289,1),(15879,'தெள்ளூர்',289,1),(15880,'தென்புதுப்பட்டு',289,1),(15881,'திப்பசமுத்திரம்',289,1),(15882,'தோளப்பள்ளி',289,1),(15883,'உமையம்பட்டு',289,1),(15884,'ஊசூர்',289,1),(15885,'வல்லண்டராமம்',289,1),(15886,'வாணியம்பாடி',289,1),(15887,'வண்ணான்தாங்கல்',289,1),(15888,'வரதலம்பட்டு',289,1),(15889,'வசந்தநடை',289,1),(15890,'வேப்பங்குப்பம்',289,1),(15891,'வெட்டுவானம்',289,1),(15892,'விரிஞ்சிபுரம்',289,1),(15893,'ஊனை',289,1),(15894,'அக்ரஹாரம்',290,1),(15895,'அகரம்சேரி',290,1),(15896,'அம்மணாங்குப்பம்',290,1),(15897,'அனங்காநல்லூர்',290,1),(15898,'போஜனாபுரம்',290,1),(15899,'செட்டிகுப்பம்',290,1),(15900,'சின்னாலப்பள்ளி',290,1),(15901,'சின்னதோட்டாளம்',290,1),(15902,'சித்தாத்தூர்',290,1),(15903,'தனகொண்டபல்லி',290,1),(15904,'தட்சிணாபாதபாளையம்',290,1),(15905,'எர்த்தாங்கல்',290,1),(15906,'கொல்லமங்கலம்',290,1),(15907,'கூடநகரம்',290,1),(15908,'குடியாத்தம் நகரம் 1',290,1),(15909,'குடியாத்தம் நகரம் 2',290,1),(15910,'ஜிட்டப்பல்லி',290,1),(15911,'கல்லப்பாடி',290,1),(15912,'கருணீகசமுத்திரம்',290,1),(15913,'கத்தாரிகுப்பம்',290,1),(15914,'கீழ்பாடி',290,1),(15915,'கொண்டசமுத்திரம்',290,1),(15916,'கொத்தகுப்பம்',290,1),(15917,'குளிதிகை',290,1),(15918,'கூத்தம்பாக்கம்',290,1),(15919,'மேலாலத்தூர்',290,1),(15920,'மேல்முட்டுகூர்',290,1),(15921,'மோடிகுப்பம்',290,1),(15922,'மூங்கப்பட்டு',290,1),(15923,'மோர்தானா',290,1),(15924,'முக்குன்றம்',290,1),(15925,'நெல்லூர்பேட்டை',290,1),(15926,'ஒலகாசி',290,1),(15927,'பாக்கம்',290,1),(15928,'பள்ளிகுப்பம்',290,1),(15929,'பங்கரிஷிகுப்பம்',290,1),(15930,'பரதராமி',290,1),(15931,'பட்டு',290,1),(15932,'பெரும்பாடி',290,1),(15933,'பிச்சனூர்',290,1),(15934,'புட்டவாரிபல்லி',290,1),(15935,'ராஜகுப்பம்',290,1),(15936,'ராமாலை',290,1),(15937,'ரங்கசமுத்திரம்',290,1),(15938,'ரங்கசமுத்திரம்',290,1),(15939,'செதுக்கரை',290,1),(15940,'சீவூர்',290,1),(15941,'செம்பேடு',290,1),(15942,'சேம்பள்ளி',290,1),(15943,'செங்குன்றம்',290,1),(15944,'செருவங்கி',290,1),(15945,'சேத்துவண்டை',290,1),(15946,'சிங்கல்பாடி',290,1),(15947,'தட்டப்பாறை',290,1),(15948,'தாட்டிமானபல்லி',290,1),(15949,'தாழையாத்தம்',290,1),(15950,'உள்ளி',290,1),(15951,'வளத்தூர்',290,1),(15952,'வரதாரெட்டிபல்லி',290,1),(15953,'வீரிசெட்டிபல்லி',290,1),(15954,'வேப்பூர்',290,1),(15955,'விழுதோணிபாளையம்',290,1),(15956,'ஆலங்கனேரி',291,1),(15957,'அங்காரங்குப்பம்',291,1),(15958,'அன்னங்குடி',291,1),(15959,'அரும்பாக்கம்',291,1),(15960,'பொம்மிநாயக்கன்பாளையம்',291,1),(15961,'செஞ்சி',291,1),(15962,'சென்னங்குப்பம்',291,1),(15963,'தேவரிஷிகுப்பம்',291,1),(15964,'காலாம்பட்டு',291,1),(15965,'காங்குப்பம்',291,1),(15966,'காவனூர்',291,1),(15967,'கீழூர்',291,1),(15968,'கீழாலத்தூர்',291,1),(15969,'கீழ்முட்டூகூர்',291,1),(15970,'கீழ்வைத்துனாங்குப்பம்',291,1),(15971,'கீழ்விலாச்சூர்',291,1),(15972,'கொத்தமங்கலம்',291,1),(15973,'லத்தேரி',291,1),(15974,'மாச்சனூர்',291,1),(15975,'மாளியாப்பட்டு',291,1),(15976,'மேல்மாங்குப்பம்',291,1),(15977,'மேல்மாயில்',291,1),(15978,'மேலூர்',291,1),(15979,'மேல்விலாச்சூர்',291,1),(15980,'முதினம்பட்டு',291,1),(15981,'முருக்கம்பட்டு',291,1),(15982,'நாகல்',291,1),(15983,'நெட்டேரி',291,1),(15984,'ஒழையாத்தூர்',291,1),(15985,'பழையகிருஷ்ணாபுரம்',291,1),(15986,'பனமடங்கி',291,1),(15987,'பசுமாத்தூர்',291,1),(15988,'பில்லாந்திபட்டு',291,1),(15989,'சோழமூர்',291,1),(15990,'திருமணி',291,1),(15991,'தொண்டான்துளசி',291,1),(15992,'துத்தித்தாங்கல்',291,1),(15993,'வடவிரிஞ்சிபுரம்',291,1),(15994,'வடுகந்தாங்கல்',291,1),(15995,'வாழ்வாங்குன்றம்',291,1),(15996,'வேலம்பட்டு',291,1),(15997,'வேப்பங்கனேரி',291,1),(15998,'விக்கிரமாச்சி',291,1),(15999,'விழுந்தக்கால்',291,1),(16000,'Ammavaripalli',292,1),(16001,'Ammundi',292,1),(16002,'Arumparuthi',292,1),(16003,'Bhirammapuram',292,1),(16004,'Dharapadavedu',292,1),(16005,'Eilayanallur',292,1),(16006,'Eranthangal',292,1),(16007,'Erukkampattu',292,1),(16008,'Gugaiyanallur',292,1),(16009,'Jabrapettai',292,1),(16010,'Kalinjur',292,1),(16011,'Kandipedu',292,1),(16012,'Kankeyaanallur',292,1),(16013,'Karanammbut',292,1),(16014,'Karasamangalam',292,1),(16015,'Karigiri',292,1),(16016,'Katpadi',292,1),(16017,'Keeraisathu',292,1),(16018,'Kembarajapuram',292,1),(16019,'Kodukkan Thangal',292,1),(16020,'Kollapalli',292,1),(16021,'Kondareddy Palli',292,1),(16022,'Magimandalam',292,1),(16023,'Mathandakuppam',292,1),(16024,'Melpadi',292,1),(16025,'Mutharasi Kuppam',292,1),(16026,'Oottanthangal',292,1),(16027,'Palekuppam',292,1),(16028,'Paramasathu',292,1),(16029,'Perumalkuppam',292,1),(16030,'Ponnai',292,1),(16031,'Puthur',292,1),(16032,'Senbarayanallur',292,1),(16033,'Senur',292,1),(16034,'Serkadu',292,1),(16035,'Sevur',292,1),(16036,'Sripathanallur',292,1),(16037,'T.K.Puram',292,1),(16038,'Thalaiyarampattu',292,1),(16039,'Thempalli',292,1),(16040,'Thengal',292,1),(16041,'Thiruvalam',292,1),(16042,'Unnamalaisamudram',292,1),(16043,'Vallimalai',292,1),(16044,'Vandaranthangal',292,1),(16045,'Vanjur',292,1),(16046,'Veepalai',292,1),(16047,'Vinnampalli',292,1),(16048,'Virudhampattu',292,1),(16049,'அழிஞ்சிகுப்பம்',293,1),(16050,'அரவட்லா',293,1),(16051,'பாலூர்',293,1),(16052,'சின்னதாமல்செருவு',293,1),(16053,'ஏரிகுத்தி',293,1),(16054,'எருக்கம்பட்டு',293,1),(16055,'ஜோதிகம்மவார்பல்லி',293,1),(16056,'கார்கூர்',293,1),(16057,'கெம்பசமுத்திரம்',293,1),(16058,'கொத்தமாரிகுப்பம்',293,1),(16059,'கொத்தபல்லி',293,1),(16060,'குண்டலபள்ளி',293,1),(16061,'மாச்சம்பட்டு',293,1),(16062,'மசிகம்',293,1),(16063,'மேல்கொத்தகுப்பம்',293,1),(16064,'மேல்முருங்கை',293,1),(16065,'மேல்பட்டு',293,1),(16066,'மேல்வழித்துணையாங்குப்பம்',293,1),(16067,'மொரசப்பல்லி',293,1),(16068,'பல்லலகுப்பம்',293,1),(16069,'பரவக்கல்',293,1),(16070,'பத்தலபள்ளி',293,1),(16071,'பேரனாம்பட்டு',293,1),(16072,'பொகளூர்',293,1),(16073,'ராஜக்கல்',293,1),(16074,'ரங்கம்பேட்டை',293,1),(16075,'ரெட்டிமாங்குப்பம்',293,1),(16076,'சாரக்கல்',293,1),(16077,'செண்டத்தூர்',293,1),(16078,'சொக்கரிஷிகுப்பம்',293,1),(16079,'தொட்டி துறை மோட்டூர்',293,1),(16080,'வாசனாம்பள்ளி',293,1),(16081,'அப்துல்லாபுரம்',294,1),(16082,'அடுக்கம்பாறை',294,1),(16083,'அலமேலுமங்காபுரம்',294,1),(16084,'அல்லாபுரம்',294,1),(16085,'அன்பூண்டி',294,1),(16086,'அரியூர்',294,1),(16087,'பாலமதி',294,1),(16088,'சோழவரம்',294,1),(16089,'இடையன்சாத்து',294,1),(16090,'கம்மசமுத்திரம்',294,1),(16091,'கனிகிணியாண்',294,1),(16092,'கணியம்பாடி',294,1),(16093,'கருகம்பத்தூர்',294,1),(16094,'கத்தாழம்பட்டு',294,1),(16095,'காட்பாடி ரெயில்வே நிலையம்',294,1),(16096,'காட்டுபுத்தூர்',294,1),(16097,'கீழரசம்பட்டு',294,1),(16098,'கீழ்மொணவூர்',294,1),(16099,'கீழ்பள்ளிப்பட்டு',294,1),(16100,'கொணவட்டம்',294,1),(16101,'மேல்மொணவூர்',294,1),(16102,'மேட்டுப்பாளையம்',294,1),(16103,'மூஞ்சூர்பட்டு',294,1),(16104,'மோத்தக்கல்',294,1),(16105,'நெல்வாய்',294,1),(16106,'பாலம்பாக்கம்',294,1),(16107,'பாலாத்துவண்ணான்',294,1),(16108,'பலவன்சாத்து',294,1),(16109,'பங்களத்தான்',294,1),(16110,'பென்னாத்தூர்',294,1),(16111,'பெருமுகை',294,1),(16112,'சலமநத்தம்',294,1),(16113,'சம்பங்கிநல்லூர்',294,1),(16114,'சாத்துமதுரை',294,1),(16115,'சாத்துப்பாளையம்',294,1),(16116,'சதுப்பேரி',294,1),(16117,'சத்துவாச்சாரி',294,1),(16118,'சேண்பாக்கம்',294,1),(16119,'சிங்கிரிகோயில்',294,1),(16120,'சிறுகளம்பூர்',294,1),(16121,'சிறுகாஞ்சி',294,1),(16122,'தெள்ளை',294,1),(16123,'தென்வேலூர்',294,1),(16124,'தொரப்பாடி',294,1),(16125,'துத்திக்காடு',294,1),(16126,'துத்திப்பட்டு',294,1),(16127,'வடவேலூர்',294,1),(16128,'வல்லம்',294,1),(16129,'வெங்கடாபுரம்',294,1),(16130,'வேப்பம்பட்டு',294,1),(16131,'விருபாட்சிபுரம்',294,1),(16132,'ஆலம்பூண்டி',295,1),(16133,'ஆமூர்',295,1),(16134,'ஆனாங்கூர்',295,1),(16135,'ஆனத்தூர்',295,1),(16136,'அகலூர்',295,1),(16137,'அணையேரி',295,1),(16138,'அனந்தபுரம்',295,1),(16139,'அணிலாடி',295,1),(16140,'அஞ்சாஞ்சேரி',295,1),(16141,'அப்பம்பட்டு',295,1),(16142,'அருகாவூர்',295,1),(16143,'அருங்குணம்(மேல்)',295,1),(16144,'அத்தியூர்',295,1),(16145,'அவியூர்',295,1),(16146,'சின்னகரம்',295,1),(16147,'சின்னபொன்னம்பூண்டி',295,1),(16148,'சிட்டாம் பூண்டி',295,1),(16149,'சோழங்குணம்',295,1),(16150,'தேவதானம்பேட்டை',295,1),(16151,'இடைமலை',295,1),(16152,'ஏதாநெமிலி',295,1),(16153,'ஈச்சூர்',295,1),(16154,'எர்ரம்பட்டு',295,1),(16155,'கெங்கவரம்',295,1),(16156,'செஞ்சி',295,1),(16157,'இல்லோடு',295,1),(16158,'இந்திரசங்குப்பம்',295,1),(16159,'இரும்புலி',295,1),(16160,'ஜம்போதி',295,1),(16161,'ஜெயங்கொண்டான்',295,1),(16162,'காரியமங்கலம்',295,1),(16163,'கடகம் பூண்டி',295,1),(16164,'கடம்பூர்',295,1),(16165,'களையூர்',295,1),(16166,'கல்லடிக்குப்பம்',295,1),(16167,'கல்லாலிப்பட்டு',295,1),(16168,'கள்ளப்புலியூர்',295,1),(16169,'காமகரம்',295,1),(16170,'கம்மந்தூர்',295,1),(16171,'கணக்கன்குப்பம்',295,1),(16172,'கண்டமநல்லூர்',295,1),(16173,'கஞ்சூர்',295,1),(16174,'கப்பை',295,1),(16175,'காரை',295,1),(16176,'கருங்குழி',295,1),(16177,'காட்டு சித்தாமூர்',295,1),(16178,'கவரை',295,1),(16179,'கீழையூர்',295,1),(16180,'கீழ்பாப்பம்பாடி',295,1),(16181,'கீழ்மலை',295,1),(16182,'கீழ்மாம்பட்டு',295,1),(16183,'கீழ்வைலாமூர்',295,1),(16184,'கொம்மேடு',295,1),(16185,'கோணை',295,1),(16186,'கொணலூர்',295,1),(16187,'கொங்கரப்பட்டு',295,1),(16188,'கொரவனந்தல்',295,1),(16189,'கிருஷ்ணாபுரம்',295,1),(16190,'குறிஞ்சிப்பை',295,1),(16191,'மாதப்பூண்டி',295,1),(16192,'மகாதேவிமங்கலம்',295,1),(16193,'மல்லரசங்குப்பம்',295,1),(16194,'மணலப்பாடி',295,1),(16195,'மணியம்பட்டி',295,1),(16196,'மரூர்',295,1),(16197,'மருதேரி',295,1),(16198,'மாத்தூர் திருக்கை',295,1),(16199,'மட்டப்பாறை',295,1),(16200,'மாவட்டம்பாடி',295,1),(16201,'மழவந்தாங்கல்',295,1),(16202,'மீனம்மூர்',295,1),(16203,'மேல்எடையாளம்',295,1),(16204,'மேல்ஓல்க்கூர்',295,1),(16205,'மேல்சித்தாமூர்',295,1),(16206,'மேலத்திப்பாக்கம்',295,1),(16207,'மேலாத்தூர்',295,1),(16208,'மேல்களவாய்',295,1),(16209,'மேல்கூடலூர்',295,1),(16210,'மேல்கூத்தப்பாக்கம்',295,1),(16211,'மேல்பாப்பம்பட்டி',295,1),(16212,'மேல்சேவூர் கிழக்கு',295,1),(16213,'மேல்சேவூர் மேற்கு',295,1),(16214,'மொடையூர் கிழக்கு',295,1),(16215,'மொடையூர் மேற்கு',295,1),(16216,'முக்குணம்',295,1),(16217,'முள்ளூர்',295,1),(16218,'நாகலாம்பட்டு',295,1),(16219,'நாகந்தூர்',295,1),(16220,'நல்லாண்பிள்ளைபெற்றாள்',295,1),(16221,'நங்கிலிகொண்டான்',295,1),(16222,'நரசிங்கராயன்பேட்டை',295,1),(16223,'நாட்டார்மங்கலம்',295,1),(16224,'நயம்பாடி',295,1),(16225,'நீர்பெருத்தகரம்',295,1),(16226,'நெகனூர்',295,1),(16227,'ஊரணித்தாங்கல்',295,1),(16228,'ஒதியத்தூர்',295,1),(16229,'ஓட்டம்பட்டு',295,1),(16230,'பாடிப்பள்ளம்',295,1),(16231,'பாக்கம்',295,1),(16232,'பாலப்பட்டு',295,1),(16233,'பள்ளிகுளம்',295,1),(16234,'பனப்பாக்கம்',295,1),(16235,'பரதன் தாங்கல்',295,1),(16236,'பசுமலைத்தாங்கல்',295,1),(16237,'பழவலம்',295,1),(16238,'பென்னகர்',295,1),(16239,'பேராம்பட்டு',295,1),(16240,'பெரியாமூர்',295,1),(16241,'பெரும்பூண்டி',295,1),(16242,'பெரும்புகை',295,1),(16243,'பெருங்காப்பூர்',295,1),(16244,'பொன்னங்குப்பம்',295,1),(16245,'பொன்பத்தி',295,1),(16246,'போந்தை',295,1),(16247,'பூதேரி',295,1),(16248,'போத்துவாய்',295,1),(16249,'புதுப்பாளையம்',295,1),(16250,'புலிப்பட்டு',295,1),(16251,'புலிவந்தி',295,1),(16252,'புத்தகரம்',295,1),(16253,'ராஜாம்புலியூர்',295,1),(16254,'சக்கராபுரம்',295,1),(16255,'சண்டிசாட்சி',295,1),(16256,'சத்தியமங்கலம்',295,1),(16257,'சே.பேட்டை',295,1),(16258,'செல்லபிராட்டி',295,1),(16259,'செம்மேடு',295,1),(16260,'சென்னாலூர்',295,1),(16261,'சேர்விளாகம்',295,1),(16262,'செத்தவரை',295,1),(16263,'சேதுவராயநல்லூர்',295,1),(16264,'சிங்கவரம்',295,1),(16265,'சிறுகடம்பூர்',295,1),(16266,'சிறுணாம்பூண்டி',295,1),(16267,'சித்தரசூர்',295,1),(16268,'சொ.குப்பம்',295,1),(16269,'சொரத்தூர்',295,1),(16270,'தச்சம்பட்டு',295,1),(16271,'தடாகம்',295,1),(16272,'தையூர்',295,1),(16273,'தளவாளப்பட்டு',295,1),(16274,'தளவானூர்',295,1),(16275,'தாமனூர்',295,1),(16276,'தாண்டவசமுத்திரம்',295,1),(16277,'தாதங்குப்பம்',295,1),(16278,'தென்புத்தூர்',295,1),(16279,'தென்புதுப்பட்டு',295,1),(16280,'திருவம்பட்டு',295,1),(16281,'திருவதிக்குன்றம்',295,1),(16282,'தொண்டூர்',295,1),(16283,'துடுப்பாக்கம்',295,1),(16284,'துத்திப்பட்டு',295,1),(16285,'உடையாந்தாங்கல்',295,1),(16286,'உளியம்பட்டு',295,1),(16287,'வடபுத்தூர்',295,1),(16288,'வடதரம்',295,1),(16289,'வடவானூர்',295,1),(16290,'வல்லம்',295,1),(16291,'வரிக்கல்',295,1),(16292,'வீரமநல்லுர்',295,1),(16293,'வீராணமூர்',295,1),(16294,'வில்வமாதேவி',295,1),(16295,'விற்பட்டு',295,1),(16296,'வௌவால்குன்றம்',295,1),(16297,'ஆ.கூடலூர்',296,1),(16298,'ஆடூர் கொளப்பாக்கம்',296,1),(16299,'ஆயந்தூர்',296,1),(16300,'அடுக்கம்',296,1),(16301,'ஆலம்பாடி',296,1),(16302,'அந்திலி',296,1),(16303,'அப்பனந்தல்',296,1),(16304,'அரகண்டநல்லூர்',296,1),(16305,'அரசங்குப்பம்',296,1),(16306,'ஆற்காடு வடக்கு',296,1),(16307,'ஆற்காடு தெற்கு',296,1),(16308,'அருளவாடி',296,1),(16309,'அருமலை',296,1),(16310,'அருணாபுரம்',296,1),(16311,'ஆதிச்சனூர்',296,1),(16312,'செங்கமேடு',296,1),(16313,'சென்னகுணம்',296,1),(16314,'சித்தாத்தூர்',296,1),(16315,'தேவனூர்',296,1),(16316,'ஏமப்பேர்',296,1),(16317,'காடகனூர்',296,1),(16318,'கல்லந்தல்',296,1),(16319,'கண்டாச்சிபுரம்',296,1),(16320,'கஸ்பாகாரணை',296,1),(16321,'கீழ்வாலை',296,1),(16322,'கிங்கிலிவாடி',296,1),(16323,'கீழ்க்கொண்டூர்',296,1),(16324,'கொடுக்கப்பட்டு',296,1),(16325,'கொடுங்கால்',296,1),(16326,'கோட்ட மருதூர்',296,1),(16327,'குடமுருட்டி',296,1),(16328,'மடவிளாகம்',296,1),(16329,'மணம்பூண்டி',296,1),(16330,'மேலக்கொண்டூர்',296,1),(16331,'மேல்வாலை',296,1),(16332,'முகையூர்',296,1),(16333,'நாயனூர்',296,1),(16334,'நெற்குணம்',296,1),(16335,'ஒடுவன்குப்பம்',296,1),(16336,'ஓதியத்தூர்',296,1),(16337,'ஓட்டம்பட்டு',296,1),(16338,'பரனூர்',296,1),(16339,'பெரிச்சானூர்',296,1),(16340,'பில்ராம்பட்டு',296,1),(16341,'புல்க்கல்',296,1),(16342,'சத்தியகண்டனூர்',296,1),(16343,'சித்தேரிப்பட்டு',296,1),(16344,'சு.கொல்லூர்',296,1),(16345,'தண்டரை',296,1),(16346,'தணிக்கலாம்பட்டு',296,1),(16347,'திருமலைப்பட்டு',296,1),(16348,'வி.புத்தூர்',296,1),(16349,'வடகரைத்தாழனூர்',296,1),(16350,'வசந்த-கிருஷ்ணாபுரம்',296,1),(16351,'வி.சித்தாமூர்',296,1),(16352,'வி.புதுப்பாளையம்',296,1),(16353,'வேடாலம்',296,1),(16354,'வீரங்கிபுரம்',296,1),(16355,'வீரப்பாண்டி',296,1),(16356,'வீரசோழபுரம்',296,1),(16357,'வேளாக்குளம்',296,1),(16358,'வெள்ளம்புத்தூர்',296,1),(16359,'ஆலங்குப்பம்',297,1),(16360,'ஆலப்பாக்கம்',297,1),(16361,'ஆலத்தூர்',297,1),(16362,'ஆட்சிக்காடு',297,1),(16363,'அடசல்',297,1),(16364,'ஆடவல்லிகூத்தான்',297,1),(16365,'அனுமந்தை',297,1),(16366,'அரியதாங்கல்',297,1),(16367,'அசப்பூர்',297,1),(16368,'அழகியப்பாக்கம்',297,1),(16369,'பிரம்மதேசம்',297,1),(16370,'செட்டிக்குப்பம்',297,1),(16371,'சொக்கந்தாங்கல்',297,1),(16372,'ஏந்தூர்',297,1),(16373,'கந்தாடு கிழக்கு',297,1),(16374,'கந்தாடு மேற்கு',297,1),(16375,'கீழ்புத்துப்பட்டு',297,1),(16376,'கேசவநாயக்கன்பாளையம்',297,1),(16377,'கீழ்ப்பேட்டை',297,1),(16378,'கீழ்சிவிரி',297,1),(16379,'கீழ்அருங்குணம்',297,1),(16380,'கொளத்தூர்',297,1),(16381,'கூனிமேடு',297,1),(16382,'குரும்பரம்',297,1),(16383,'குரூர்',297,1),(16384,'எம்.புதுப்பாக்கம்',297,1),(16385,'மடவந்தாங்கல்',297,1),(16386,'மரக்காணம் தெற்கு',297,1),(16387,'மரக்காணம் வடக்கு',297,1),(16388,'முன்னூர் வடக்கு',297,1),(16389,'முன்னூர் தெற்கு',297,1),(16390,'முருக்கேரி',297,1),(16391,'நடுக்குப்பம் கிழக்கு',297,1),(16392,'நடுக்குப்பம் மேற்கு',297,1),(16393,'நாகல்பாக்கம்',297,1),(16394,'நகர்',297,1),(16395,'நல்லூர்',297,1),(16396,'நல்முக்கல்',297,1),(16397,'ஓமிப்பேர்',297,1),(16398,'ஊரணி',297,1),(16399,'பனிச்சமேடு',297,1),(16400,'பந்தாடு',297,1),(16401,'பழமுக்கல்',297,1),(16402,'பெருமுக்கல்',297,1),(16403,'ராயநல்லூர்',297,1),(16404,'சாத்தமங்கலம்',297,1),(16405,'செய்யாங்குப்பம்',297,1),(16406,'சிங்கனந்தல்',297,1),(16407,'சிறுவாடி',297,1),(16408,'சொரப்பட்டு',297,1),(16409,'தி.நல்லாளம்',297,1),(16410,'தென்னேரி',297,1),(16411,'திருக்கனூர்',297,1),(16412,'வடஅகரம்',297,1),(16413,'வடகோடிப்பாக்கம்',297,1),(16414,'வடகொளப்பாக்கம்',297,1),(16415,'வடநெற்குணம்',297,1),(16416,'வைடப்பாக்கம்',297,1),(16417,'வன்னிப்பேர்',297,1),(16418,'வேப்பேரி',297,1),(16419,'ஆர்க்காம்பூண்டி',298,1),(16420,'ஆத்திப்பட்டு',298,1),(16421,'அன்னமங்கலம்',298,1),(16422,'அவலூர்பேட்டை',298,1),(16423,'சின்னநொளம்பை',298,1),(16424,'தேவனூர்',298,1),(16425,'தேவந்தவாடி',298,1),(16426,'எடப்பட்டு',298,1),(16427,'ஏம்பலம்',298,1),(16428,'ஈயகுணம்',298,1),(16429,'எய்யில்',298,1),(16430,'கெங்கபுரம்',298,1),(16431,'கடலி',298,1),(16432,'கடப்பனந்தல்',298,1),(16433,'கைவிடாந்தாங்கல்',298,1),(16434,'கலத்தம்பட்டு',298,1),(16435,'கம்மந்தாங்கல்',298,1),(16436,'கன்னலம்',298,1),(16437,'கப்ளாம்பாடி',298,1),(16438,'கிழவம்பூண்டி',298,1),(16439,'கீழ்செவலாம்பாடி',298,1),(16440,'கொடம்பாடி',298,1),(16441,'கொடுக்கன்குப்பம்',298,1),(16442,'கூடுவாம்பூண்டி',298,1),(16443,'கோட்டப்பூண்டி',298,1),(16444,'கோவில்புறையூர்',298,1),(16445,'கொழப்பலூர்',298,1),(16446,'குந்தலம்பட்டு',298,1),(16447,'மானந்தல்',298,1),(16448,'மரக்கோணம்',298,1),(16449,'மாவனந்தல்',298,1),(16450,'மேல்அருங்குணம்',298,1),(16451,'மேல்காராணை',298,1),(16452,'மேல்நெமிலி',298,1),(16453,'மேலச்சேரி',298,1),(16454,'மேல்மலையனூர்',298,1),(16455,'மேல்மாம்பட்டு',298,1),(16456,'மேல்மண்ணூர்',298,1),(16457,'மேல்புதுப்பட்டு',298,1),(16458,'மேல்செவலாம்பாடி',298,1),(16459,'மேல் வைலாமூர்',298,1),(16460,'மோடிப்பட்டு',298,1),(16461,'நத்திபுரம்‌',298,1),(16462,'நாரணமங்கலம்',298,1),(16463,'நொச்சலூர்',298,1),(16464,'பாப்பந்தாங்கல்',298,1),(16465,'பரையம்பட்டு',298,1),(16466,'பரையந்தாங்கல்',298,1),(16467,'பருதிபுரம்',298,1),(16468,'பழம்பூண்டி',298,1),(16469,'பெரியநொளம்பை',298,1),(16470,'பெருவளூர்',298,1),(16471,'பின்னனூர்',298,1),(16472,'பொற்குணம்',298,1),(16473,'சமத்தங்குப்பம்',298,1),(16474,'சங்கிலிகுப்பம்',298,1),(16475,'சாத்தாம்பாடி',298,1),(16476,'சாத்தனந்தல்',298,1),(16477,'சாத்தபுத்தூர்',298,1),(16478,'சீயப்பூண்டி',298,1),(16479,'செவலபுரை வடக்கு',298,1),(16480,'செவலபுரை தெற்கு',298,1),(16481,'சிந்தகம்பூண்டி',298,1),(16482,'சிந்திப்பட்டு',298,1),(16483,'சிறுதலைபூண்டி',298,1),(16484,'சித்தேரி',298,1),(16485,'சொக்கபலம்',298,1),(16486,'சொக்கனந்தல்',298,1),(16487,'தாயனூர்',298,1),(16488,'தாழங்குணம்',298,1),(16489,'தென்பாலை',298,1),(16490,'தேப்பிராம்பட்டு',298,1),(16491,'தொரப்பாடி',298,1),(16492,'துறிஞ்சிப்பூண்டி',298,1),(16493,'உண்ணாமநத்தல்',298,1),(16494,'வடபாலை',298,1),(16495,'வடவெட்டி',298,1),(16496,'வடுகப்பூண்டி',298,1),(16497,'வளத்தி',298,1),(16498,'வணக்கம்பாடி',298,1),(16499,'ஆக்கனூர்',299,1),(16500,'ஆலங்குப்பம்',299,1),(16501,'ஆமூர்',299,1),(16502,'ஆணைவாரி',299,1),(16503,'ஆத்திப்பட்டு',299,1),(16504,'ஆனத்தூர்',299,1),(16505,'அண்டராயனூர்',299,1),(16506,'அரசூர்',299,1),(16507,'அரும்பட்டு',299,1),(16508,'அருங்குருக்கை',299,1),(16509,'சி மெய்யூர்',299,1),(16510,'சின்னசெவலை',299,1),(16511,'இளந்துரை',299,1),(16512,'ஏமப்பூர் வடக்கு',299,1),(16513,'ஏமப்பூர் தெற்கு',299,1),(16514,'ஏனாதிமங்கலம்',299,1),(16515,'எரளூர்',299,1),(16516,'இருவேல்பட்டு',299,1),(16517,'காந்தலவாடி',299,1),(16518,'கண்ணாரம்பட்டு',299,1),(16519,'கரடிப்பாக்கம்',299,1),(16520,'காரப்பட்டு',299,1),(16521,'கீழமங்கலம்',299,1),(16522,'கீழ் தணியாளம்பட்டு',299,1),(16523,'கொண்டசமுத்திரம்',299,1),(16524,'கொங்கராயனூர்',299,1),(16525,'கூரானூர்',299,1),(16526,'கொத்தனூர்',299,1),(16527,'மாதம்பட்டு',299,1),(16528,'மாமந்தூர்',299,1),(16529,'மணக்குப்பம்',299,1),(16530,'மாரங்கியூர்',299,1),(16531,'மழையம்பட்டு',299,1),(16532,'மேலமங்கலம்',299,1),(16533,'மேல் தணியாளம்பட்டு',299,1),(16534,'ஒட்டநந்தல்',299,1),(16535,'பையூர்',299,1),(16536,'பனப்பாக்கம்',299,1),(16537,'பருகம்பட்டு',299,1),(16538,'பாவந்தூர்',299,1),(16539,'பெண்ணைவலம்',299,1),(16540,'பேரங்கியூர்',299,1),(16541,'பெரியசெவலை',299,1),(16542,'பொய்யரசூர்',299,1),(16543,'சரவணபாக்கம்',299,1),(16544,'சேமங்கலம்',299,1),(16545,'செம்மார்',299,1),(16546,'சிறுமதுரை',299,1),(16547,'சிறுவானூர்',299,1),(16548,'சித்திலிங்கமடம் கிழக்கு',299,1),(16549,'சித்தானங்கூர்',299,1),(16550,'சித்திலிங்கமடம் மேற்கு',299,1),(16551,'டி எடையார்',299,1),(16552,'டி குமாரமங்கலம்',299,1),(16553,'டி மழவராயனூர்',299,1),(16554,'டி புதுப்பாளையம்',299,1),(16555,'டி சாத்தனூர்',299,1),(16556,'டி கொணலவாடி',299,1),(16557,'தி குளத்தூர்',299,1),(16558,'தடுத்தாட்கொண்டூர்',299,1),(16559,'தென்மங்கலம்',299,1),(16560,'திருமுன்டீச்சரம்',299,1),(16561,'திருவெண்ணைநல்லூர் வடக்கு',299,1),(16562,'திருவெண்ணைநல்லூர் தெற்கு',299,1),(16563,'துலங்கம்பட்டு',299,1),(16564,'வளையாம்பட்டு',299,1),(16565,'ஆலகிராமம் மேற்கு',300,1),(16566,'ஆசூர்',300,1),(16567,'ஆத்திப்பாக்கம்',300,1),(16568,'ஆத்தூர்',300,1),(16569,'அகூர்',300,1),(16570,'ஆலகிராமம் கிழக்கு',300,1),(16571,'அம்மணம்பாக்கம்',300,1),(16572,'அண்டப்பட்டு',300,1),(16573,'அங்காணிக்குப்பம்',300,1),(16574,'அன்னம்பாக்கம்',300,1),(16575,'அன்னம்புத்தூர்',300,1),(16576,'அரியாங்குப்பம்',300,1),(16577,'ஆட்சிப்பாக்கம்',300,1),(16578,'அவ்வையார்குப்பம்',300,1),(16579,'அவணம்பட்டு',300,1),(16580,'ஆவனிப்பூர்',300,1),(16581,'அவரப்பாக்கம்',300,1),(16582,'சேனலூர்',300,1),(16583,'சின்ன வளவனூர்',300,1),(16584,'சின்னநெற்குணம்',300,1),(16585,'தாதாபுரம்',300,1),(16586,'எழாய்',300,1),(16587,'ஈச்சேரி',300,1),(16588,'இளமங்கலம்',300,1),(16589,'எலவளப்பாக்கம்',300,1),(16590,'எண்டியூர்',300,1),(16591,'ஏப்பாக்கம்',300,1),(16592,'எறையானூர்',300,1),(16593,'ஏவலூர்',300,1),(16594,'கணபதிபட்டு',300,1),(16595,'ஜக்காம்பேட்டை',300,1),(16596,'கடவம்பாக்கம்',300,1),(16597,'கள்ளக்கொளத்தூர்',300,1),(16598,'கல்பாக்கம்',300,1),(16599,'கம்பூர்',300,1),(16600,'கன்னியம்',300,1),(16601,'கரிக்கம்பட்டு',300,1),(16602,'கர்ணாவூர்',300,1),(16603,'கருப்பூர்',300,1),(16604,'கருவம்பாக்கம்',300,1),(16605,'கட்டளை',300,1),(16606,'காட்டுப்புஞ்சை',300,1),(16607,'காட்டுச்சிவிரி',300,1),(16608,'காவேரிப்பாக்கம்',300,1),(16609,'கீழ்ஆதனூர்',300,1),(16610,'கீழ்எடையாளம்',300,1),(16611,'கீழ்க்காரணை',300,1),(16612,'கீழ்கூடலூர்',300,1),(16613,'கீழ்மண்ணூர்',300,1),(16614,'கீழ்மாவிலங்கை',300,1),(16615,'கீழ்நெமிலி',300,1),(16616,'கீழ்பசார்',300,1),(16617,'கீழ்பேரடிக்குப்பம்',300,1),(16618,'கீழ்சேவூர்',300,1),(16619,'கீழ்சித்தாமூர்',300,1),(16620,'கீழ்பூதேரி',300,1),(16621,'கிடங்கல்',300,1),(16622,'கிராண்டிபுரம்',300,1),(16623,'கொடிமா',300,1),(16624,'கொடியம்',300,1),(16625,'கொள்ளார்',300,1),(16626,'கொல்லியங்குணம்',300,1),(16627,'கோணலூர்',300,1),(16628,'கொணமங்கலம்',300,1),(16629,'கூச்சிக்கொளத்தூர்',300,1),(16630,'கூட்டேரிப்பட்டு',300,1),(16631,'கொரளூர்',300,1),(16632,'கோவடி',300,1),(16633,'குன்னப்பாக்கம்',300,1),(16634,'குருவம்மாபேட்டை',300,1),(16635,'மயிலம்',300,1),(16636,'மலையனூர் (கீழ்)',300,1),(16637,'மாம்பாக்கம்',300,1),(16638,'மண்டபெரும்பாக்கம்',300,1),(16639,'மங்களம்',300,1),(16640,'மன்னம்பூண்டி',300,1),(16641,'மானூர்',300,1),(16642,'மேலாதனூர்',300,1),(16643,'மேல்மாவிலங்கை',300,1),(16644,'மேல்பாக்கம்',300,1),(16645,'மேல்பேரடிக்குப்பம்',300,1),(16646,'மேல்பேட்டை',300,1),(16647,'மேல்சிவிரி',300,1),(16648,'மொளசூர்',300,1),(16649,'முப்புளி',300,1),(16650,'முட்டியூர்',300,1),(16651,'நடுவனந்தல்',300,1),(16652,'நாகவரம்',300,1),(16653,'நல்லாமூர்',300,1),(16654,'நல்லாத்தூர்',300,1),(16655,'நங்குணம்',300,1),(16656,'நரமாகாணி',300,1),(16657,'நெடிமோழியனூர்',300,1),(16658,'நெடுந்தோண்டி',300,1),(16659,'நெய்குப்பி',300,1),(16660,'நொளம்பூர்',300,1),(16661,'ஓலக்கூர் கீழ்பாதி',300,1),(16662,'ஓலக்கூர் மேல்பாதி',300,1),(16663,'ஓமந்தூர்',300,1),(16664,'ஓங்கூர்',300,1),(16665,'ஊரல்',300,1),(16666,'பாலப்பட்டு',300,1),(16667,'பள்ளிப்பாக்கம்',300,1),(16668,'பாம்பூண்டி',300,1),(16669,'பனையூர்',300,1),(16670,'பாங்கொளத்தூர்',300,1),(16671,'பந்தமங்கலம்',300,1),(16672,'பாதிராப்புலியூர்',300,1),(16673,'பாதிரி',300,1),(16674,'பட்டணம்',300,1),(16675,'பெலாக்குப்பம்',300,1),(16676,'பெரமண்டூர்(கிழக்கு)',300,1),(16677,'பெரமண்டூர்(மேற்கு)',300,1),(16678,'பேரணி',300,1),(16679,'பெரப்பேரி',300,1),(16680,'பெரியதச்சூர் தெற்கு',300,1),(16681,'பெரியதச்சூர் வடக்கு',300,1),(16682,'புலியனூர்',300,1),(16683,'புலியூர்',300,1),(16684,'புறங்கரை',300,1),(16685,'புத்தநந்தல்',300,1),(16686,'ரெட்டணை மேற்கு',300,1),(16687,'ரெட்டணை கிழக்கு',300,1),(16688,'ரோசணை',300,1),(16689,'ச.கடூர்',300,1),(16690,'சாலை',300,1),(16691,'சலவாதி',300,1),(16692,'சாரம்',300,1),(16693,'சாத்தனூர்',300,1),(16694,'செ.கொத்தமங்கலம்',300,1),(16695,'செம்பாக்கம்',300,1),(16696,'செண்டியம்பாக்கம்',300,1),(16697,'செண்டூர்',300,1),(16698,'சேந்தமங்கலம்',300,1),(16699,'சிங்காணிக்குப்பம்',300,1),(16700,'சிங்கனூர்',300,1),(16701,'வடசிறுவளூர்',300,1),(16702,'சித்தணி',300,1),(16703,'சித்தேரிப்பட்டு',300,1),(16704,'சோழி சொக்குணம்',300,1),(16705,'தி.பாஞ்சாலம்',300,1),(16706,'தி.கேணிப்பட்டு',300,1),(16707,'தழுதாளி',300,1),(16708,'தணியல்',300,1),(16709,'தீவனூர்',300,1),(16710,'தென் ஆலப்பாக்கம்',300,1),(16711,'தென்னம்பூண்டி',300,1),(16712,'தேங்காய்பாக்கம்',300,1),(16713,'தென்களவாய்',300,1),(16714,'தென்கொளப்பாக்கம்',300,1),(16715,'தென்நெற்குணம்',300,1),(16716,'தென்பசியார்',300,1),(16717,'திண்டிவனம்',300,1),(16718,'வி.நல்லாளம்',300,1),(16719,'வி.பாஞ்சாலம்',300,1),(16720,'வட ஆலப்பாக்கம்',300,1),(16721,'வடகளவாய்',300,1),(16722,'வடம்பூண்டி',300,1),(16723,'வைரபுரம்',300,1),(16724,'வண்டராம்பூண்டி',300,1),(16725,'வரகுபட்டு',300,1),(16726,'வீடூர்(கிழக்கு)',300,1),(16727,'வீடூர்(மேற்கு)',300,1),(16728,'வெளியனூர்',300,1),(16729,'வெள்ளிமேடுப்பேட்டை',300,1),(16730,'வேம்பூண்டி',300,1),(16731,'வேங்கை',300,1),(16732,'வெங்கந்தூர்',300,1),(16733,'வெண்மணியாத்தூர்',300,1),(16734,'விளங்கம்பாடி',300,1),(16735,'விட்டலாபுரம்',300,1),(16736,'விழுக்கம்',300,1),(16737,'ஆகாசம்பட்டு',301,1),(16738,'ஆண்பாக்கம்',301,1),(16739,'ஆப்பிரம்பட்டு',301,1),(16740,'அச்சரம்பட்டு',301,1),(16741,'அய்வேலி',301,1),(16742,'அம்புழுக்கை',301,1),(16743,'அறுவடை',301,1),(16744,'அருவாப்பாக்கம்',301,1),(16745,'ஆதனப்பட்டு',301,1),(16746,'பொம்மையார்பாளையம்',301,1),(16747,'தேவநந்தல்',301,1),(16748,'எடச்சேரி',301,1),(16749,'எடையப்பட்டு',301,1),(16750,'இளையாண்டிப்பட்டு',301,1),(16751,'எலவம்பட்டு',301,1),(16752,'எறையூர்',301,1),(16753,'இரும்பை',301,1),(16754,'கடகம்பட்டு',301,1),(16755,'கடப்பேரிக்குப்பம்',301,1),(16756,'கரசானூர்',301,1),(16757,'காரட்டை',301,1),(16758,'காட்ராம்பாக்கம்',301,1),(16759,'காயல்மேடு',301,1),(16760,'கழுப்பெரும்பாக்கம்',301,1),(16761,'கீழ்கூத்தப்பாக்கம்',301,1),(16762,'கிளாபாக்கம்',301,1),(16763,'கிளியனூர்(கிழக்கு)',301,1),(16764,'கிளியனூர் மேற்கு',301,1),(16765,'கொடூர்',301,1),(16766,'கொமடிப்பட்டு',301,1),(16767,'கொண்டாலங்குப்பம்',301,1),(16768,'கொந்தமூர்',301,1),(16769,'கொஞ்சிமங்கலம்',301,1),(16770,'கோரைக்கேணி',301,1),(16771,'கோட்டக்குப்பம்',301,1),(16772,'கொழுவாரி',301,1),(16773,'குமளம்பட்டு',301,1),(16774,'குன்னம்',301,1),(16775,'மாத்தூர்',301,1),(16776,'முருக்கம்',301,1),(16777,'நல்லாவூர்',301,1),(16778,'நெமிலி',301,1),(16779,'நெசல்',301,1),(16780,'ஒழிந்தியாம்பட்டு',301,1),(16781,'ஒட்டை',301,1),(16782,'பரிக்கல்பட்டு',301,1),(16783,'பட்டானூர்',301,1),(16784,'பெரம்பை',301,1),(16785,'பேராவூர்',301,1),(16786,'பெரும்பாக்கம்',301,1),(16787,'பொம்பூர்',301,1),(16788,'பொன்னம்பூண்டி',301,1),(16789,'பூத்துறை',301,1),(16790,'புளிச்சபள்ளம்',301,1),(16791,'புதுக்குப்பம்',301,1),(16792,'இராயஒட்டை',301,1),(16793,'ராயபுதுப்பாக்கம்',301,1),(16794,'சேமங்கலம்',301,1),(16795,'செங்கமேடு',301,1),(16796,'சிறுநாவூர்',301,1),(16797,'சிறுவை',301,1),(16798,'சித்தனப்பாக்கம்',301,1),(16799,'டி.பரங்கனி',301,1),(16800,'தைலாபுரம்',301,1),(16801,'தலைக்காணிகுப்பம்',301,1),(16802,'தென்கோடிப்பாக்கம்',301,1),(16803,'தென்னகரம்',301,1),(16804,'தென்சிறுவளூர்',301,1),(16805,'தேற்குணம்',301,1),(16806,'திருச்சிற்றம்பலம்',301,1),(16807,'திருவக்கரை',301,1),(16808,'தொள்ளாமூர்',301,1),(16809,'துருவை',301,1),(16810,'உலகாபுரம்',301,1),(16811,'உப்புவேலூர்',301,1),(16812,'வி.கேணிப்பட்டு',301,1),(16813,'வி.பரங்கனி',301,1),(16814,'வி.புதுப்பாக்கம்',301,1),(16815,'வானூர்',301,1),(16816,'வெங்காரம்',301,1),(16817,'வில்வநத்தம்',301,1),(16818,'ஆசூர் தெற்கு',302,1),(16819,'ஆசூர் வடக்கு',302,1),(16820,'ஆவுடையார்பட்டு',302,1),(16821,'அம்மணங்குப்பம்',302,1),(16822,'அன்னியூர்',302,1),(16823,'அனுமந்தபுரம்',302,1),(16824,'அரசலாபுரம்',302,1),(16825,'அரும்புலி',302,1),(16826,'அதனூர்',302,1),(16827,'அத்தியூர் திருக்கை',302,1),(16828,'அய்யூர் அகரம்',302,1),(16829,'பிரம்மதேசம்',302,1),(16830,'சின்னபாபுசமுத்திரம்',302,1),(16831,'சின்னதச்சூர்',302,1),(16832,'இ.மண்டகப்பட்டு',302,1),(16833,'ஈச்சங்குப்பம்',302,1),(16834,'எண்ணாயிரம்',302,1),(16835,'ஏழுசெம்பொன்',302,1),(16836,'அய்யங்கோவில்பட்டு',302,1),(16837,'கடயம்',302,1),(16838,'கக்கனூர்',302,1),(16839,'கலிங்கமலை',302,1),(16840,'கலித்திராம்பட்டு',302,1),(16841,'கல்யாணம்பூண்டி',302,1),(16842,'கஞ்சனூர்',302,1),(16843,'கன்னந்தல்',302,1),(16844,'கப்பியாம்புலியூர்',302,1),(16845,'கருவாட்சி',302,1),(16846,'கஸ்பாகரணை',302,1),(16847,'கயத்தூர்',302,1),(16848,'கொடுக்கூர்',302,1),(16849,'கொங்கராம்பூண்டி',302,1),(16850,'கொரளூர்',302,1),(16851,'கொட்டியாம்பூண்டி',302,1),(16852,'குளப்பாக்கம்',302,1),(16853,'குளிர்சுனை',302,1),(16854,'குமுளம்',302,1),(16855,'குண்டலப்புலியூர்',302,1),(16856,'குன்னத்தூர்தாங்கல்',302,1),(16857,'குராம்பாளையம்',302,1),(16858,'குத்தாம்பூண்டி',302,1),(16859,'மதுரப்பாக்கம்',302,1),(16860,'மேலக்கொந்தை',302,1),(16861,'மேல்காரணை',302,1),(16862,'முண்டியம்பாக்கம்',302,1),(16863,'மூங்கில்பட்டு',302,1),(16864,'முதலியார்குப்பம்',302,1),(16865,'முட்டத்தூர்',302,1),(16866,'முட்ராம்பட்டு',302,1),(16867,'நகர்',302,1),(16868,'நல்லாப்பாளையம்',302,1),(16869,'நந்திவாடி',302,1),(16870,'நங்காத்தூர்',302,1),(16871,'நரசிங்கனூர்',302,1),(16872,'நேமூர்',302,1),(16873,'உலகலாம்பூண்டி',302,1),(16874,'ஒரத்தூர்',302,1),(16875,'பகண்டை',302,1),(16876,'பக்கிரிபாளையம்',302,1),(16877,'பனைமலை வடக்கு',302,1),(16878,'பனமலை தெற்கு',302,1),(16879,'பனப்பாக்கம்',302,1),(16880,'பனையபுரம்',302,1),(16881,'பாப்பனப்பட்டு',302,1),(16882,'பிடாரிப்பட்டு',302,1),(16883,'பெரியபாபுசமுத்திரம்',302,1),(16884,'பெருங்கலாம்பூண்டி',302,1),(16885,'பிள்ளையார்குப்பம்',302,1),(16886,'பூண்டி',302,1),(16887,'பூங்குணம்',302,1),(16888,'போரூர்',302,1),(16889,'ராதாபுரம்',302,1),(16890,'ரெட்டிக்குப்பம்',302,1),(16891,'சாலவனூர்',302,1),(16892,'சங்கீதமங்களம்',302,1),(16893,'செ.புதூர்',302,1),(16894,'செ.குண்ணத்தூர்',302,1),(16895,'செய்யாதுவிண்ணான்',302,1),(16896,'செம்மேடு',302,1),(16897,'சென்னப்ப நாயக்கன்பாளையம்',302,1),(16898,'சேஷாங்கனூர்',302,1),(16899,'சிறுவாலை',302,1),(16900,'சிறுவள்ளிக்குப்பம்',302,1),(16901,'சித்தலம்பட்டு',302,1),(16902,'சித்தேரி',302,1),(16903,'சூரப்பட்டு',302,1),(16904,'சோழகனூர்',302,1),(16905,'தென்னமாதேவி',302,1),(16906,'தென்னவராயன்பட்டு',302,1),(16907,'தென்பேர்',302,1),(16908,'திருக்குணம்',302,1),(16909,'திருமங்கலம்',302,1),(16910,'திருநந்திபுரம்',302,1),(16911,'திருவாமாத்தூர்',302,1),(16912,'தொரவி',302,1),(16913,'தும்பூர்',302,1),(16914,'உடையாநத்தம்',302,1),(16915,'வி.மாத்தூர்',302,1),(16916,'வி.நெற்குணம்',302,1),(16917,'வி.சாலை',302,1),(16918,'வி.சாத்தனூர்',302,1),(16919,'வடகுச்சிபாளையம்',302,1),(16920,'வாக்கூர்',302,1),(16921,'வாதனூர்',302,1),(16922,'வழுதாவூர்',302,1),(16923,'வேலியந்தல்',302,1),(16924,'வெள்ளையாம்பட்டு',302,1),(16925,'வெள்ளேரிப்பட்டு',302,1),(16926,'வேம்பி',302,1),(16927,'வெங்கமூர்',302,1),(16928,'வெங்காயகுப்பம்',302,1),(16929,'வெட்டுக்காடு',302,1),(16930,'விஜயங்குப்பம்',302,1),(16931,'விக்கிரவாண்டி கிழக்கு',302,1),(16932,'விக்கிரவாண்டி மேற்கு',302,1),(16933,'எசாலம்',302,1),(16934,'ஆலாத்துர்',303,1),(16935,'ஆணாங்கூர்',303,1),(16936,'ஆரியூர்',303,1),(16937,'ஆசாரங்குப்பம்',303,1),(16938,'ஆழியூர்',303,1),(16939,'அகரம் சித்தாமூர்',303,1),(16940,'அரசமங்கலம்',303,1),(16941,'அரியலூர்-திருக்கை',303,1),(16942,'அற்பிசம்பாளையம்',303,1),(16943,'அத்தியூர்-திருவாதி',303,1),(16944,'சொக்கம்பட்டு',303,1),(16945,'சோழாம்பூண்டி',303,1),(16946,'எடப்பாளையம்',303,1),(16947,'இளங்காடு',303,1),(16948,'எருமணந்தாங்கல்',303,1),(16949,'கா.குப்பம்',303,1),(16950,'கலிஞ்சிகுப்பம்',303,1),(16951,'கல்லப்பட்டு',303,1),(16952,'கள்ளிப்பட்டு',303,1),(16953,'கல்பட்டு கிழக்கு',303,1),(16954,'கல்பட்டு‌ மேற்கு',303,1),(16955,'காணை',303,1),(16956,'கண்டமானடி',303,1),(16957,'கண்டமங்கலம்',303,1),(16958,'கண்டம்பாக்கம்',303,1),(16959,'கண்டியமடை',303,1),(16960,'காங்கியனூர்',303,1),(16961,'கப்பூர்',303,1),(16962,'கருங்காலிப்பட்டு',303,1),(16963,'காவணிப்பாக்கம்',303,1),(16964,'கெடார்',303,1),(16965,'கெங்கராம்பாளையம்',303,1),(16966,'கீழ்பெரும்பாக்கம்',303,1),(16967,'கொளத்தூர்',303,1),(16968,'கோலியனூர்',303,1),(16969,'கொண்டங்கி',303,1),(16970,'கோண்டூர்',303,1),(16971,'கொங்கம்பட்டு',303,1),(16972,'கொங்கரகொண்டான்',303,1),(16973,'கோனூர்',303,1),(16974,'கொத்தம் பாக்கம்',303,1),(16975,'கோழிப்பட்டு',303,1),(16976,'கிருஷ்ணாபுரம்',303,1),(16977,'குடுமியாங்குப்பம்',303,1),(16978,'குமாரக்குப்பம்',303,1),(16979,'குப்பம்',303,1),(16980,'மகாராஜபுரம்',303,1),(16981,'மல்லிகைப்பட்டு',303,1),(16982,'மல்ராஜன்குப்பம்',303,1),(16983,'மாம்பழப்பட்டு',303,1),(16984,'மாங்குப்பம்',303,1),(16985,'மரகதபுரம்',303,1),(16986,'மாதிரிமங்கலம்',303,1),(16987,'மழவராயனூர்',303,1),(16988,'மேல்பாதி',303,1),(16989,'மேட்டுப்பாளையம்',303,1),(16990,'மிட்டாமண்டகப்பட்டு',303,1),(16991,'மோட்சகுளம்',303,1),(16992,'நன்னாடு',303,1),(16993,'நன்னாட்டாம்பாளையம்',303,1),(16994,'நரையூர்',303,1),(16995,'நவமால் மருதூர்',303,1),(16996,'நவமால்காப்பேர்',303,1),(16997,'ஒருகோடி',303,1),(16998,'பாக்கம் வடக்கு',303,1),(16999,'பாக்கம் தெற்கு',303,1),(17000,'பள்ளிச்சேரி',303,1),(17001,'பள்ளிநேலியனூர்',303,1),(17002,'பள்ளிப்புதுப்பட்டு',303,1),(17003,'பள்ளித்தென்னல்',303,1),(17004,'பள்ளியந்தூர்',303,1),(17005,'பனங்குப்பம்',303,1),(17006,'பாணாம்பட்டு',303,1),(17007,'பஞ்சமாதேவி',303,1),(17008,'பரசுரெட்டிப்பாளையம்',303,1),(17009,'பேரிச்சம்பாக்கம்',303,1),(17010,'பெரும்பாக்கம்',303,1),(17011,'பெத்துரெட்டிக்குப்பம்',303,1),(17012,'பிடாகம்',303,1),(17013,'பில்லூர்',303,1),(17014,'பூந்தோட்டம்',303,1),(17015,'பொய்யப்பாக்கம்',303,1),(17016,'பூவரசங்குப்பம்',303,1),(17017,'ராம்பாக்கம்',303,1),(17018,'சாலைஅகரம்',303,1),(17019,'சாலாமேடு',303,1),(17020,'சாலையாம்பாளையம் கிழக்கு',303,1),(17021,'சாலையாம்பாளையம் மேற்கு',303,1),(17022,'சத்திப்பட்டு',303,1),(17023,'செங்காடு',303,1),(17024,'சேர்ந்தனூர்',303,1),(17025,'சிறுவாக்கூர்',303,1),(17026,'சிறுவந்தாடு',303,1),(17027,'சித்தாத்தூர் திருக்கை',303,1),(17028,'சொரப்பூர்',303,1),(17029,'சொர்ணாவூர் மேல்பாதி',303,1),(17030,'சொர்ணாவூர் கீழ்பாதி',303,1),(17031,'தளவனூர்',303,1),(17032,'தெளி',303,1),(17033,'தென்குச்சிப்பாளையம்',303,1),(17034,'திருப்பாச்சனூர்',303,1),(17035,'தொடர்ந்தனூர்',303,1),(17036,'தோகவாடி',303,1),(17037,'வி.அகரம்',303,1),(17038,'வி.அரியலூர்',303,1),(17039,'வி.கொத்தமங்கலம்',303,1),(17040,'வி.மருதூர்',303,1),(17041,'வி.புதூர்',303,1),(17042,'வடவாம்பலம்',303,1),(17043,'வடுகநாதன்குப்பம்',303,1),(17044,'வைலாமூர்',303,1),(17045,'வளவனூர்',303,1),(17046,'வாழப்பட்டு',303,1),(17047,'வழுதரெட்டி',303,1),(17048,'வேடம்பட்டு',303,1),(17049,'வீரமூர்',303,1),(17050,'வீராணம்',303,1),(17051,'வெங்கந்தூர்',303,1),(17052,'வெங்கடேசபுரம்',303,1),(17053,'வெண்மணியாத்தூர்',303,1),(17054,'விராட்டிக்குப்பம்',303,1),(17055,'வேலியம்பாக்கம்',303,1),(17056,'விழுப்புரம்',303,1),(17057,'Tailoring Institution 3',318,1),(17058,'Tailoring Institution 4',318,1),(17059,'Tailoring Institution 5',318,1),(17060,'அருப்புக்கோட்டை',304,1),(17061,'Tailoring Institution 6',318,1),(17062,'செட்டிக்குறிச்சி',304,1),(17063,'Tailoring Institution 7',318,1),(17064,'Tailoring Institution 8',318,1),(17065,'Tailoring Institution 9',318,1),(17066,'கோபலபுரம்',304,1),(17067,'பென்னாத்தூர்',294,1),(17068,'காளையார்கரிசல்குளம்',304,1),(17069,'கள்ளிக்காரி',304,1),(17070,'கல்லுமார்பட்டி',304,1),(17071,'கல்லூரணி',304,1),(17072,'கல்யாணசுந்தரபுரம்',304,1),(17073,'கணக்கி',304,1),(17074,'கஞ்சநாயக்கன்பட்டி',304,1),(17075,'கறுப்புக்கட்டியேந்தல்',304,1),(17076,'கட்டக்கஞ்சம்பட்டி',304,1),(17077,'கட்டங்குடி',304,1),(17078,'கீழ்குடி',304,1),(17079,'கொங்கணக்குறிச்சி',304,1),(17080,'கூத்திப்பாறை',304,1),(17081,'கோவிலாங்குளம்',304,1),(17082,'குலசேகரநல்லூர்',304,1),(17083,'குல்லம்பட்டி',304,1),(17084,'குல்லூர்சந்தை',304,1),(17085,'குறிஞ்சாங்குளம்',304,1),(17086,'குருணைக்குளம்',304,1),(17087,'குருந்தமடம்',304,1),(17088,'மண்டபசாலை',304,1),(17089,'மாங்குளம்',304,1),(17090,'மறவர்பெருங்குடி',304,1),(17091,'மேலையூர்',304,1),(17092,'மேலக்கண்டமங்கலம்',304,1),(17093,'மேட்டுத்தொட்டியான்குளம்',304,1),(17094,'முத்துராமலிங்கபுரம்',304,1),(17095,'நார்த்தம்பட்டி',304,1),(17096,'பி ஆண்டிபட்டி',304,1),(17097,'பாலவநத்தம்',304,1),(17098,'பாலையம்பட்டி',304,1),(17099,'பந்தல்குடி',304,1),(17100,'பரளச்சி',304,1),(17101,'பரட்டநத்தம்',304,1),(17102,'பெரியபுளியம்பட்டி(கிழக்கு)',304,1),(17103,'பெரியபுளியம்பட்டி(மேற்க்கு)',304,1),(17104,'போடம்பட்டி',304,1),(17105,'பொம்மக்கோட்டை',304,1),(17106,'பூலாங்கால்',304,1),(17107,'பொய்யான்குளம்',304,1),(17108,'புலியூரான்',304,1),(17109,'புல்லாநாயக்கன்பட்டி',304,1),(17110,'புரசலூர்',304,1),(17111,'ஆர்.கல்லுமடம்',304,1),(17112,'இராஜகோபாலபுரம்',304,1),(17113,'ராமாபுரம்',304,1),(17114,'சலுக்குவார்பட்டி',304,1),(17115,'சவ்வாஸ்புரம்',304,1),(17116,'செம்பட்டி',304,1),(17117,'செங்குளம்',304,1),(17118,'சிலுக்குபட்டி',304,1),(17119,'சூலக்கரை',304,1),(17120,'சுக்கிலநத்தம்',304,1),(17121,'சுண்டக்கோட்டை',304,1),(17122,'சுத்தமடம்',304,1),(17123,'டி.மீனாட்சிபுரம்',304,1),(17124,'டி.கொப்புசித்தம்பட்டி',304,1),(17125,'தம்மநாயக்கன்பட்டி',304,1),(17126,'தெற்குநத்தம்',304,1),(17127,'திருமலைபுரம்',304,1),(17128,'திருவிருந்தாள்புரம்',304,1),(17129,'தொப்பலாக்கரை',304,1),(17130,'தும்மக்குண்டு',304,1),(17131,'தும்முசின்னம்பட்டி',304,1),(17132,'வி கொப்புசித்தம்பட்டி',304,1),(17133,'வடக்குநத்தம்',304,1),(17134,'வாழவந்தாபுரம்',304,1),(17135,'நுள்ளிவிளை NEW',324,1),(17136,'நல்லூர் B',93,1),(17137,'ராமநாதபுரம்',32,1),(17138,'கரிகிரி',317,1),(17139,'பென்னாத்தூர்',294,1),(17140,'வடக்கு தர்மபுரம்',88,1),(17141,'எ தொட்டியாங்குளம்',305,1),(17142,'அச்சம்பட்டி',305,1),(17143,'அச்சங்குளம்',305,1),(17144,'அழகியநல்லூர்',305,1),(17145,'ஆலங்குளம்',305,1),(17146,'அல்லாளப்பேரி',305,1),(17147,'அல்லிக்குளம்',305,1),(17148,'அல்லிக்குளம்',305,1),(17149,'ஆமைபிரக்கி',305,1),(17150,'அம்பைக்குளம்',305,1),(17151,'அனுப்பனேந்தல்',305,1),(17152,'அரசகுளம்',305,1),(17153,'அரியனேந்தல்',305,1),(17154,'ஆத்திகுளம்',305,1),(17155,'ஆத்திகுளம்',305,1),(17156,'ஆவியூர்',305,1),(17157,'அயன்ரெட்டியபட்டி',305,1),(17158,'அய்யனார்குளம்',305,1),(17159,'சந்தனேந்தல்',305,1),(17160,'சந்திரங்குளம்',305,1),(17161,'சத்திரபுளியங்குளம்',305,1),(17162,'சின்ன ஆலங்குளம்',305,1),(17163,'சொக்கனேந்தல்',305,1),(17164,'இசலிமடை',305,1),(17165,'ஜோகில்பட்டி',305,1),(17166,'கே.நெடுங்குளம்',305,1),(17167,'கல்குறிச்சி',305,1),(17168,'கழுவனச்சேரி',305,1),(17169,'கம்பிக்குடி',305,1),(17170,'கம்பாளி',305,1),(17171,'கணக்கனேந்தல்',305,1),(17172,'காரைக்குளம்',305,1),(17173,'காரியாபட்டி',305,1),(17174,'கரியனேந்தல்',305,1),(17175,'கட்டுகுத்தகை கரிசல்குளம்',305,1),(17176,'கீழ் புதுப்பட்டி',305,1),(17177,'கீழ்இடையன்குளம்',305,1),(17178,'கீழ்கள்ளிகுளம்',305,1),(17179,'கீழ்காஞ்சிரங்குளம்',305,1),(17180,'கீழ்உடைகுளம்',305,1),(17181,'கிழவனேரி',305,1),(17182,'கூவர்குளம்',305,1),(17183,'கோவிலாங்குளம்',305,1),(17184,'குடும்பன்குளம்',305,1),(17185,'குண்டுகுளம்',305,1),(17186,'குரண்டி',305,1),(17187,'குறிஞ்சாக்குளம்',305,1),(17188,'குறிஞ்சாக்குளம்',305,1),(17189,'எம்.இலுப்பைக்குளம்',305,1),(17190,'மல்லாங்கிணர்',305,1),(17191,'மானங்காத்தான்',305,1),(17192,'மனைவியேந்தல்',305,1),(17193,'மாங்குளம்',305,1),(17194,'மாந்தோப்பு',305,1),(17195,'மேலக்கள்ளங்குளம்',305,1),(17196,'மேலக்கள்ளிகுளம்',305,1),(17197,'மேலக்காஞ்சிரங்குளம்',305,1),(17198,'மேலிடையன்குளம்',305,1),(17199,'மேல்புதுப்பட்டி',305,1),(17200,'மின்னிரஞ்சன்பட்டி',305,1),(17201,'முடுக்கன்குளம்',305,1),(17202,'முஷ்டக்குறிச்சி',305,1),(17203,'என் நெடுங்குளம்',305,1),(17204,'நந்திக்குண்டு',305,1),(17205,'பாம்பாட்டி',305,1),(17206,'பனைக்குளம்',305,1),(17207,'பந்தனேந்தல்',305,1),(17208,'பனிக்குறிப்பு',305,1),(17209,'பாஞ்சார்',305,1),(17210,'பாப்பணம்',305,1),(17211,'பரையனகுத்தி',305,1),(17212,'பெரியஆலங்குளம்',305,1),(17213,'பிசிண்டி',305,1),(17214,'பொட்டல்குளம்',305,1),(17215,'புலவனக்குண்டு',305,1),(17216,'புதுக்குளம்',305,1),(17217,'எஸ் கல்லுப்பட்டி',305,1),(17218,'எஸ் தொண்டாரேந்தல்',305,1),(17219,'சிங்கநாதபுரம்',305,1),(17220,'சிறுகுளம்',305,1),(17221,'சிறுவேப்பங்குளம்',305,1),(17222,'சித்தனேந்தல்',305,1),(17223,'சித்துமூன்றடைப்பு',305,1),(17224,'சூரனூர்',305,1),(17225,'டி செட்டிகுளம்',305,1),(17226,'டி கடம்பங்குளம்',305,1),(17227,'டி வேப்பங்குளம்',305,1),(17228,'தாமரைக்குளம்',305,1),(17229,'தேனூர்',305,1),(17230,'திம்மாபுரம்',305,1),(17231,'தோணுகால்',305,1),(17232,'தோப்பூர்',305,1),(17233,'துலுக்கன்குளம்',305,1),(17234,'ஊத்தாகுளம்',305,1),(17235,'வி நாங்கூர்',305,1),(17236,'வடகரை',305,1),(17237,'வடக்குப்புளியம்பட்டி',305,1),(17238,'வையம்பட்டி',305,1),(17239,'வக்கணாங்குண்டு',305,1),(17240,'வலையபட்டி',305,1),(17241,'வலுக்கலொட்டி',305,1),(17242,'வரலொட்டி',305,1),(17243,'வேளாங்குளம்',305,1),(17244,'வெற்றிலைமுறியன்பட்டி',305,1),(17245,'விளாக்குளம்',305,1),(17246,'அப்பனேரி',306,1),(17247,'அரசியார்பட்டி',306,1),(17248,'அயன்கொல்லங்கொண்டான் - 1',306,1),(17249,'அயன்கொல்லங்கொண்டான் - 2',306,1),(17250,'செட்டியார்பட்டி',306,1),(17251,'சொக்கநாதன்புத்தூர்',306,1),(17252,'சோழபுரம் -1',306,1),(17253,'சோழபுரம் - 2',306,1),(17254,'இளந்திரைகொண்டான்',306,1),(17255,'கடம்பன்குளம்',306,1),(17256,'கொல்லங்கொண்டான்',306,1),(17257,'கொத்தன்குளம்',306,1),(17258,'கோவிலூர்',306,1),(17259,'மேலப்பாட்டம்கரிசல்குளம்',306,1),(17260,'மேலராஜகுலராமன்',306,1),(17261,'மேலூர்துரைச்சாமிபுரம்',306,1),(17262,'மேட்டுப்பட்டி',306,1),(17263,'முத்துச்சாமிபுரம்',306,1),(17264,'நல்லமங்கலம்',306,1),(17265,'வடக்கு தேவதானம்',306,1),(17266,'வடக்கு வெங்காநல்லூர்',306,1),(17267,'புதுப்பாளையம்',306,1),(17268,'புத்தூர்',306,1),(17269,'இராஜபாளையம்',306,1),(17270,'ரெகுநாதபுரம்',306,1),(17271,'எஸ் இராமலிங்காபுரம்',306,1),(17272,'சம்மந்தபுரம்',306,1),(17273,'சமுசிகாபுரம்',306,1),(17274,'சேத்தூர்',306,1),(17275,'சோலைசேரி',306,1),(17276,'தெற்கு தேவதனம்',306,1),(17277,'தெற்கு வெங்காநல்லூர்',306,1),(17278,'சுந்தரராஜபுரம்',306,1),(17279,'திருச்சலூர்',306,1),(17280,'ஜமீன்நத்தம்பட்டி',306,1),(17281,'ஆலம்பட்டி',307,1),(17282,'அம்மாபட்டி',307,1),(17283,'ஆத்திபட்டி',307,1),(17284,'அய்யம்பட்டி',307,1),(17285,'பந்துவார்பட்டி',307,1),(17286,'சத்திரப்பட்டி',307,1),(17287,'சின்னக்காமன்பட்டி',307,1),(17288,'சின்னகொல்லபட்டி',307,1),(17289,'சின்னதம்பியாபுரம்',307,1),(17290,'சிந்தப்பள்ளி',307,1),(17291,'தர்மாசனம் சின்ன ஓடைப்பட்டி',307,1),(17292,'இ.குமாரலிங்கபுரம்',307,1),(17293,'இ.முத்துலிங்காபுரம்',307,1),(17294,'கோல்வார்பட்டி',307,1),(17295,'கஞ்சம்பட்டி',307,1),(17296,'கரிசல்பட்டி',307,1),(17297,'கத்தாளம்பட்டி',307,1),(17298,'கோசுகுண்டு',307,1),(17299,'கோட்டப்பச்சேரி',307,1),(17300,'குண்டலகுத்தூர்',307,1),(17301,'எம்.சொக்கலிங்கபுரம்',307,1),(17302,'எம்.நாகலாபுரம்',307,1),(17303,'மடம் சின்ன ஓடைப்பட்டி',307,1),(17304,'மடத்துக்காடு',307,1),(17305,'மேலமடை',307,1),(17306,'மேட்டமலை',307,1),(17307,'முள்ளிசெவல்',307,1),(17308,'என் மேட்டுப்பட்டி',307,1),(17309,'நல்லமநாயக்கன்பட்டி',307,1),(17310,'நல்லமுத்தன்பட்டி',307,1),(17311,'நல்லி',307,1),(17312,'நென்மேனி',307,1),(17313,'ஓ மேட்டுப்பட்டி',307,1),(17314,'ஒத்தையால்',307,1),(17315,'ஓவநாயக்கன்பட்டி',307,1),(17316,'படந்தால்',307,1),(17317,'பாப்பாகுடி',307,1),(17318,'பேரையம்பட்டி',307,1),(17319,'பெரியகொல்லபட்டி',307,1),(17320,'பெத்துரெட்டிபட்டி',307,1),(17321,'போத்திரெட்டிபட்டி',307,1),(17322,'ராவுத்தன்பட்டி',307,1),(17323,'சந்தையூர்',307,1),(17324,'சங்கரநத்தம்',307,1),(17325,'சாத்தூர்',307,1),(17326,'சிந்துவம்பட்டி',307,1),(17327,'சிறுகுளம்',307,1),(17328,'சூரங்குடி',307,1),(17329,'சுப்ரமணியபுரம்',307,1),(17330,'ஊமத்தம்பட்டி',307,1),(17331,'உப்பத்தூர்',307,1),(17332,'வடமலாபுரம்',307,1),(17333,'வேப்பிலைபட்டி',307,1),(17334,'ஏ மீனாட்சிபுரம்',308,1),(17335,'ஆனைக்குட்டம்',308,1),(17336,'ஆணையூர்',308,1),(17337,'அனுப்பன்குளம்',308,1),(17338,'துரைச்சாமிபுரம்',308,1),(17339,'ஈஞ்சார்',308,1),(17340,'எரிச்சநத்தம்',308,1),(17341,'காளையார்குறிச்சி',308,1),(17342,'காரிசேரி',308,1),(17343,'கீழத்திருத்தங்கல்',308,1),(17344,'கொங்கலாபுரம்',308,1),(17345,'கவுண்டம்பட்டி',308,1),(17346,'கிருஷ்ணபேரி',308,1),(17347,'மங்கலம்',308,1),(17348,'மாரனேரி',308,1),(17349,'மேலாமத்தூர்',308,1),(17350,'நமஸ்கரித்தான்பட்டி',308,1),(17351,'நாரணாபுரம்',308,1),(17352,'நெடுங்குளம்',308,1),(17353,'பேர்நாயக்கன்பட்டி',308,1),(17354,'பூரணசந்திரபுரம்',308,1),(17355,'புதுக்கோட்டை',308,1),(17356,'சல்வார்பட்டி',308,1),(17357,'செவலூர்',308,1),(17358,'சிவகாசி',308,1),(17359,'சுப்ரமணியபுரம்',308,1),(17360,'தச்சகுடி',308,1),(17361,'தாயில்பட்டி',308,1),(17362,'திருத்தங்கல்',308,1),(17363,'வி சொக்கலிங்கபுரம்',308,1),(17364,'வடபட்டி',308,1),(17365,'வாடி',308,1),(17366,'வெள்ளூர்',308,1),(17367,'வேண்டுராயபுரம்',308,1),(17368,'வெற்றிலையூரணி',308,1),(17369,'விஸ்வநத்தம்',308,1),(17370,'அச்சந்தவிழ்த்தான்',309,1),(17371,'அத்திகுளம் செங்குளம்',309,1),(17372,'அயன் நாச்சியார்கோவில்',309,1),(17373,'தெய்வேந்திரி',309,1),(17374,'குருக்கள்குளம்',309,1),(17375,'மல்லி',309,1),(17376,'மம்சாபுரம்',309,1),(17377,'முள்ளிக்குளம்',309,1),(17378,'முத்துவெங்கட்ராயபுரம்',309,1),(17379,'நல்லிங்கபேரி',309,1),(17380,'படிக்காசுவைத்தான்பட்டி',309,1),(17381,'பாட்டக்குளம் சல்லிபட்டி',309,1),(17382,'பிள்ளையார்குளம்',309,1),(17383,'பிள்ளையார்நத்தம்',309,1),(17384,'பொன்னாங்கன்னி',309,1),(17385,'பூவாணி',309,1),(17386,'ச அம்மாபட்டி',309,1),(17387,'சிங்கம்மாள்புரம்',309,1),(17388,'சிவந்திபட்டி',309,1),(17389,'ஸ்ரீவில்லிபுத்தூர்',309,1),(17390,'டி மானகசேரி',309,1),(17391,'தைலாகுளம்',309,1),(17392,'வடக்கு ஸ்ரீவில்லிபுத்தூர்',309,1),(17393,'வாழைக்குளம்',309,1),(17394,'வெங்கடேஸ்வரபுரம்',309,1),(17395,'விழுப்பனூர்',309,1),(17396,'தென்மாத்தூர்',286,1),(17397,'சு கீழ்நாச்சிப்பட்டு',286,1),(17398,'ஆணைக்குளம்',310,1),(17399,'கண்ணப்பந்தல்',286,1),(17400,'நடுப்பட்டு',286,1),(17401,'ஆண்டியேந்தல்',310,1),(17402,'அனிக்கலக்கியேந்தல்',310,1),(17403,'அச்சங்குளம்',310,1),(17404,'அத்திகுளம்',310,1),(17405,'ஆதித்தனேந்தல்',310,1),(17406,'பூம்பிடாகை',310,1),(17407,'செம்பொன்நெருஞ்சி',310,1),(17408,'சென்னிலைக்குடி',310,1),(17409,'சின்னவண்ணான்குளம்',310,1),(17410,'சித்தலக்குண்டு',310,1),(17411,'சொக்கம்பட்டி',310,1),(17412,'சூச்சனேரி',310,1),(17413,'சொரிக்குளம்',310,1),(17414,'சொட்டமுறி',310,1),(17415,'தாமோதரபுரம்',310,1),(17416,'எழுவணி',310,1),(17417,'எருமைக்குளம்',310,1),(17418,'கொங்கலாக்குடி',310,1),(17419,'குருந்தன்குளம்',310,1),(17420,'இடையன்குளம்',310,1),(17421,'இலுப்பைகுளம்',310,1),(17422,'இலுப்பையூர்',310,1),(17423,'இருஞ்சிறை',310,1),(17424,'இசலி',310,1),(17425,'கே நெடுங்குளம்',310,1),(17426,'கடல்பாச்சி',310,1),(17427,'கடம்பன்குளம்',310,1),(17428,'கடம்பன்குளம்',310,1),(17429,'கடையனேந்தல்',310,1),(17430,'காலடிபாப்பான்குளம்',310,1),(17431,'களத்தூர்',310,1),(17432,'கல்லத்திகுளம்',310,1),(17433,'கமலிபுளியங்குளம்',310,1),(17434,'கண்டுகொண்டான்மாணிக்கம்',310,1),(17435,'காரேந்தல்',310,1),(17436,'காத்தான்பட்டி',310,1),(17437,'கட்டனூர்',310,1),(17438,'கீழச்செம்பூர்',310,1),(17439,'கீழக்கண்டமங்கலம்',310,1),(17440,'கீழப்புலியாண்டார்கோட்டை',310,1),(17441,'கொய்கைப்பித்தான்',310,1),(17442,'கொக்குளம்',310,1),(17443,'கொல்லனேந்தல்',310,1),(17444,'கோணப்பனேந்தல்',310,1),(17445,'கூத்தனார்கோட்டை',310,1),(17446,'குண்டுகுளம்',310,1),(17447,'குறையரவாசித்தான்',310,1),(17448,'குறிஞ்சாகுளம்',310,1),(17449,'குச்சம்பட்டி',310,1),(17450,'எம் புதுக்குளம்',310,1),(17451,'மி புளியங்குளம்',310,1),(17452,'மைலி',310,1),(17453,'மணக்குளம்',310,1),(17454,'மணவராயனேந்தல்',310,1),(17455,'மானூர்',310,1),(17456,'மாயலேரி',310,1),(17457,'மீனாட்சிபுரம்',310,1),(17458,'மேலச்செம்பூர்',310,1),(17459,'மேலகுமிலங்குளம்',310,1),(17460,'மேலபருத்தியூர்',310,1),(17461,'மேலேந்தல்',310,1),(17462,'முத்தனெரி',310,1),(17463,'முத்துராமலிங்கபுரம்',310,1),(17464,'நாடாகுளம்',310,1),(17465,'நடுவப்பச்சேரி',310,1),(17466,'நல்லதரை',310,1),(17467,'நல்லுக்குறிச்சி',310,1),(17468,'நாலூர்',310,1),(17469,'நம்பியேந்தல்',310,1),(17470,'நத்தகுளம்',310,1),(17471,'நத்தக்குளம் வீ',310,1),(17472,'நெல்லிகுளம்',310,1),(17473,'நொச்சிகுளம்',310,1),(17474,'ஊரணிபட்டு',310,1),(17475,'ஓட்டங்குளம்',310,1),(17476,'பெ.புதுப்பட்டி',310,1),(17477,'பி.வாகைக்குளம்',310,1),(17478,'பள்ளிமடம்',310,1),(17479,'பனைக்குடி',310,1),(17480,'பனையூர்',310,1),(17481,'பண்ணைமூன்றடைப்பு',310,1),(17482,'பாப்பான்குளம்',310,1),(17483,'பாறைக்குளம்',310,1),(17484,'பாதனக்குறிச்சி',310,1),(17485,'பெருமானேந்தல்',310,1),(17486,'பிள்ளையாரேந்தல்',310,1),(17487,'பிளையார்குளம்',310,1),(17488,'பிள்ளையார்தொட்டியங்குளம்',310,1),(17489,'பிச்சங்குடி',310,1),(17490,'பூமாலைபட்டி',310,1),(17491,'புளிச்சிகுளம்',310,1),(17492,'புலிக்குறிச்சி',310,1),(17493,'புல்வாய்கரை',310,1),(17494,'புதியனேந்தல்',310,1),(17495,'ரெகுநாதமடை',310,1),(17496,'எஸ் கல்லுமடை',310,1),(17497,'சாலைஇலுப்பைக்குளம்',310,1),(17498,'சம்மனேந்தல்',310,1),(17499,'சப்பாணியேந்தல்',310,1),(17500,'சாத்திசேரி',310,1),(17501,'சீலம்பட்டி',310,1),(17502,'சீனியேந்தல்',310,1),(17503,'சேதுபுரம்',310,1),(17504,'சிலந்திகுளம்',310,1),(17505,'சிறுமிதிலைக்குளம்',310,1),(17506,'ஸ்ரீராமனேந்தல்',310,1),(17507,'சுள்ளங்குடி',310,1),(17508,'சுந்தரத்தான்',310,1),(17509,'சுரைக்குளம்',310,1),(17510,'டி கரிசல்குளம்',310,1),(17511,'டி நெடுங்குளம்',310,1),(17512,'டி வேலங்குடி',310,1),(17513,'தேளி',310,1),(17514,'தெற்காரியான்குளம்',310,1),(17515,'திடுவூர்',310,1),(17516,'திப்பம்பட்டி',310,1),(17517,'திருவிடநல்லூர்',310,1),(17518,'தொண்டைமான்குளம்',310,1),(17519,'திருச்சுழி',310,1),(17520,'உடைச்சியேந்தல்',310,1),(17521,'உடையனாம்பட்டி',310,1),(17522,'உடையாரேந்தல்',310,1),(17523,'உலக்குடி',310,1),(17524,'உண்டுருமிகிடாகுளம்',310,1),(17525,'உசிலங்குளம்',310,1),(17526,'வி கரிசல்குளம்',310,1),(17527,'வடக்காரியன்குளம்',310,1),(17528,'வடபாலை',310,1),(17529,'வலையனேந்தல்',310,1),(17530,'வாலில்லாபேரி',310,1),(17531,'வரிசையூர்',310,1),(17532,'வீரஆலங்குளம்',310,1),(17533,'வீரசோழன்',310,1),(17534,'வீரக்குடி',310,1),(17535,'வேளானேரி',310,1),(17536,'வேலனூரணி',310,1),(17537,'வேலாயுதபுரம்',310,1),(17538,'விடத்தகுளம்',310,1),(17539,'ஏ லட்சுமிபுரம்',311,1),(17540,'அச்சங்குளம்',311,1),(17541,'ஆலங்குளம்',311,1),(17542,'அப்பையநாயக்கன்பட்டி',311,1),(17543,'இ இராமநாதபுரம்',311,1),(17544,'இ ரெட்டியபட்டி',311,1),(17545,'எதிர்கோட்டை',311,1),(17546,'ஏழாயிரம்பண்ணை',311,1),(17547,'கோபாலபுரம்',311,1),(17548,'குகன்பாறை',311,1),(17549,'கனஞ்சாம்பட்டி',311,1),(17550,'கங்கரக்கோட்டை',311,1),(17551,'கங்கரசெவல்',311,1),(17552,'கீழாண்மறைநாடு',311,1),(17553,'கீழராஜகுலராமன்',311,1),(17554,'கொங்கன்குளம்',311,1),(17555,'கொருக்காம்பட்டி',311,1),(17556,'குண்டாயிருப்பு',311,1),(17557,'குரிச்சியார்பட்டி',311,1),(17558,'முத்தாண்டியபுரம்',311,1),(17559,'நதிக்குடி',311,1),(17560,'ஓ முத்துச்சாமிபுரம்',311,1),(17561,'பனையடிபட்டி',311,1),(17562,'சானாண்குளம்',311,1),(17563,'சங்கரபாண்டியபுரம்',311,1),(17564,'சேர்வைக்காரன்பட்டி',311,1),(17565,'செவல்பட்டி',311,1),(17566,'சிப்பிப்பாறை',311,1),(17567,'சூரார்பட்டி',311,1),(17568,'தென்கரை',311,1),(17569,'துலுக்கன்குறிச்சி',311,1),(17570,'ஊத்துப்பட்டி',311,1),(17571,'வடகரை',311,1),(17572,'வரகுணராமபுரம்',311,1),(17573,'வெம்பக்கோட்டை',311,1),(17574,'விஜயகரிசல்குளம்',311,1),(17575,'விஜயரெங்கபுரம்',311,1),(17576,'ஆறுமுத்தாம்பாளையம்',263,1),(17577,'அழகாபுரி',312,1),(17578,'அல்லம்பட்டி',312,1),(17579,'ஆமத்தூர்',312,1),(17580,'அப்பையநாயக்கன்பட்டி',312,1),(17581,'ஆவுடையாபுரம்',312,1),(17582,'சத்திரரெட்டியாபட்டி',312,1),(17583,'செட்டிபட்டி',312,1),(17584,'சின்னமூப்பன்பட்டி',312,1),(17585,'சின்னவாடி',312,1),(17586,'எல்லிங்கநாயக்கன்பட்டி',312,1),(17587,'எண்டப்புலி',312,1),(17588,'கே புதூர்',312,1),(17589,'கடம்பன்குளம்',312,1),(17590,'கலங்காபேரி',312,1),(17591,'காசிரெட்டியபட்டி',312,1),(17592,'கூரைக்குண்டு',312,1),(17593,'கோட்டைபட்டி',312,1),(17594,'கோட்டையூர்',312,1),(17595,'கோட்டநத்தம்',312,1),(17596,'கோவில்வீரார்பட்டி',312,1),(17597,'மன்னார்கோட்டை',312,1),(17598,'மருளுத்து',312,1),(17599,'மீசலூர்',312,1),(17600,'மெட்டுகுண்டு',312,1),(17601,'மூளிப்பட்டி',312,1),(17602,'முத்துராமன்பட்டி',312,1),(17603,'நாட்டார்மங்கலம்',312,1),(17604,'ஒண்டிபுலிநாயக்கனூர்',312,1),(17605,'பாச்சாகுளம்',312,1),(17606,'பட்டம்புதூர்',312,1),(17607,'பாவாலி',312,1),(17608,'பேளம்பட்டி',312,1),(17609,'பெரியபேராலி',312,1),(17610,'பா குமாரலிங்கபுரம்',312,1),(17611,'புளியங்குளம்',312,1),(17612,'புல்லலக்கோட்டை',312,1),(17613,'ரோசல்பட்டி',312,1),(17614,'சீநியாபுரம்',312,1),(17615,'செங்குன்றாபுரம்',312,1),(17616,'செங்கோட்டை',312,1),(17617,'சென்னல்குடி',312,1),(17618,'சிவஞானபுரம்',312,1),(17619,'தம்மநாயக்கன்பட்டி',312,1),(17620,'தாதம்பட்டி',312,1),(17621,'துலுக்கபட்டி',312,1),(17622,'வி.முத்துலிங்காபுரம்',312,1),(17623,'வாடமலைக்குறிச்சி',312,1),(17624,'வாய்பூட்டான்பட்டி',312,1),(17625,'வச்சக்காரபட்டி',312,1),(17626,'விருதுநகர்',312,1),(17627,'வி சுந்தரலிங்கபுரம்',312,1),(17628,'அம்மாபட்டி',313,1),(17629,'ஆயர்தர்மம்',313,1),(17630,'அயன்கரிசல்குளம்',313,1),(17631,'கோவிந்தநல்லூர்',313,1),(17632,'இலந்தக்குளம்',313,1),(17633,'களத்தூர்',313,1),(17634,'கான்சாபுரம்',313,1),(17635,'கோட்டையூர்',313,1),(17636,'குன்னூர்',313,1),(17637,'மகாராஜாபுரம்',313,1),(17638,'மரிக்கலம்காத்தான்',313,1),(17639,'மூவரைவென்றான்',313,1),(17640,'நத்தம்பட்டி',313,1),(17641,'ருத்திரப்பநாயக்கன்பட்டி',313,1),(17642,'எஸ் கொடிக்குளம்',313,1),(17643,'செம்மணான்டி கரிசல்குளம்',313,1),(17644,'சுந்தரபாண்டியம்',313,1),(17645,'தம்பிபட்டி',313,1),(17646,'துலுக்கப்பட்டி',313,1),(17647,'வடுகபட்டி',313,1),(17648,'வெள்ளப்பொட்டல்',313,1),(17649,'வ புதுப்பட்டி',313,1),(17650,'வத்திராயிருப்பு',313,1),(17651,'85 கொமாரபாளையம்',315,1),(17652,'அத்தனூர்',315,1),(17653,'அத்தனூர் ஆயிபாளையம்',315,1),(17654,'அரியாகவுண்டம்பட்டி',315,1),(17655,'ஆணைகட்டிபாளையம்',315,1),(17656,'ஆதாம் பட்டி',315,1),(17657,'ஆயிப்பாளையம்',315,1),(17658,'ஆயில் பட்டி',315,1),(17659,'ஈஸ்வரமூர்த்தி பாளையம்',315,1),(17660,'ஊனந்தாங்கல்',315,1),(17661,'எல்லாப் பாளையம்',315,1),(17662,'கரியாம்பட்டி',315,1),(17663,'கல்லாங்குளம்',315,1),(17664,'கீரனூர்',315,1),(17665,'கீளூர்',315,1),(17666,'கெடமலை',315,1),(17667,'கொலக்கமேடு',315,1),(17668,'சின்ன செக்கடி',315,1),(17669,'சின்னக்காபாளையம்',315,1),(17670,'தேங்கல்பாளையம்',315,1),(17671,'தொட்டியபட்டி',315,1),(17672,'பச்சாகவுண்டம்பட்டி',315,1),(17673,'பல்லவநாயக்கன்பட்டி',315,1),(17674,'பழந்தின்னிப்பட்டி',315,1),(17675,'புதுப்பட்டி',315,1),(17676,'புதுப்பாளையம்',315,1),(17677,'புதூர் மலையாளப்பட்டி',315,1),(17678,'புதூர்பாலப்பட்டி',315,1),(17679,'பெரப்பஞ்சோலை',315,1),(17680,'பெரிய குறிச்சி',315,1),(17681,'பெரிய கோம்பை',315,1),(17682,'பெரியசெக்கடி',315,1),(17683,'பெருமாகவுண்டம்பாளையம்',315,1),(17684,'பொன்குறிச்சி',315,1),(17685,'மங்களபுரம்',315,1),(17686,'மத்துரூட்டு',315,1),(17687,'மாவார்',315,1),(17688,'முத்துக்காளிப்பட்டி',315,1),(17689,'முள்ளுக்குறிச்சி',315,1),(17690,'மூலபள்ளிபட்டி',315,1),(17691,'மேலூர்',315,1),(17692,'மோளப்பாளையம்',315,1),(17693,'வடுகம்',315,1),(17694,'வடுகம் முனியப்பம்பாளையம்',315,1),(17695,'வரகூர் கோம்பை',315,1),(17696,'வெண்ணந்தூர்',315,1),(17697,'வெள்ளக்கல்பட்டி',315,1),(17698,'திருப்பத்தூர்',257,1),(17699,' திருப்பூர் வடக்கு',264,1),(17700,'ஆண்டாக்கோட்டை',203,1),(17701,'கோவளம் ',88,1),(17702,'ஆவாரைகுளம்',252,1),(17703,'பட்டுக்கோட்டை',202,1),(17716,'Tailoring Institution 10',318,1),(17717,'Mehandhi',326,1),(17718,'Beautician course',327,1),(17719,'பள்ளப்பட்டி',59,1),(17720,'கொளத்தூர்',16,1),(17721,'Attur Town',167,1),(17722,'ஆத்தூர்',167,1),(17723,'Sadupperi',289,1),(17724,'ஆனாய்பிறந்தான்',286,1),(17725,'அரடாப்பட்டு',286,1),(17726,'அத்தியந்தல்',286,1),(17727,'அய்யம்பாளையம்',286,1),(17728,'சின்னகல்லப்பபாடி',286,1),(17729,'தேவனாம்பட்டு',286,1),(17730,'தேவனந்தல்',286,1),(17731,'தேவனூர்',286,1),(17732,'துரக்கைநம்மியந்தல்',286,1),(17733,'துரிஞ்சாபுரம்',286,1),(17734,'இனாம்காரியந்தல்',286,1),(17735,'கணந்தம்பூண்டி',286,1),(17736,'கண்டியாங்குப்பம்',286,1),(17737,'கண்ணப்பந்தல்',286,1),(17738,'கருந்துவாம்பாடி',286,1),(17739,'காட்டடாம்பூண்டி',286,1),(17740,'கிளியாப்பட்டு',286,1),(17741,'கீழணைக்கரை',286,1),(17742,'கீழ்செட்டிப்பட்டு',286,1),(17743,'கீழ்கச்சிராப்பட்டு',286,1),(17744,'கீழ்நாத்தூர்',286,1),(17745,'கொளக்கரவாடி',286,1),(17746,'கூத்தலவாடி',286,1),(17747,'குன்னியந்தல்',286,1),(17748,'நல்லவன்பாளையம்',286,1),(17749,'நல்லான்பிள்ளைபெற்றாள்',286,1),(17750,'நாயுடுமங்கலம்',286,1),(17751,'நாச்சானந்தல்',286,1),(17752,'மெய்யூர்',286,1),(17753,'மாதலம்பாடி',286,1),(17754,'மருத்துவாம்பாடி',286,1),(17755,'மஞ்சம்பூண்டி',286,1),(17756,'மங்கலம்',286,1),(17757,'மல்லவாடி',286,1),(17758,'சீலப்பந்தல்',286,1),(17759,'சமுத்திரம்',286,1),(17760,'பெரியகல்லப்பாடி',286,1),(17761,'பழையனூர்',286,1),(17762,'பண்டிதப்பட்டு',286,1),(17763,'பள்ளிக்கொண்டாப்பட்டு',286,1),(17764,'ஊசாம்பாடி',286,1),(17765,'நூக்காம்பாடி',286,1),(17766,'நவம்பட்டு',286,1),(17767,'நாரத்தாம்புண்டி',286,1),(17768,'சொரகுளத்தூர்',286,1),(17769,'சு.கீழ்நாச்சிப்பட்டு',286,1),(17770,'தச்சம்பட்டு',286,1),(17771,'தலையாம்பள்ளம்',286,1),(17772,'தென்மாத்தூர்',286,1),(17773,'வடபுழதியூர்',286,1),(17774,'வள்ளிவாகை',286,1),(17775,'வெங்காயவேலூர்',286,1),(17776,'வேங்கிக்கால்',286,1),(17777,'வெரையூர்',286,1),(17778,'3 கொமாரபாளையம்',315,1),(17779,'அக்கரைப்பட்டி',315,1),(17780,'அலவாய் பட்டி',315,1),(17781,'தொப்பப்பட்டி',315,1),(17782,'தொ.பச்சுடையாம்பாளையம்',315,1),(17783,'தொ.ஜேடர்பாளையம்',315,1),(17784,'திம்மநாயக்கன்பட்டி',315,1),(17785,'சௌதாபுரம்',315,1),(17786,'அணைப்பாளையம்',315,1),(17787,'பட்டணம்',315,1),(17788,'பட்டணம் முனியப்பம் பாளையம்',315,1),(17789,'பிள்ளாநல்லூர்',315,1),(17790,'பொன்பரப்பிபட்டி',315,1),(17791,'பொரசல்பட்டி',315,1),(17792,'இராசிபுரம்',315,1),(17793,'சீராப்பள்ளி',315,1),(17794,'செம்மாண்டபட்டி',315,1),(17795,'சிங்களாந்தபுரம்',315,1),(17796,'அனந்தக்கவுண்டம்பாளையம்',315,1),(17797,'ஆண்டகலூர்',315,1),(17798,'அண்ணாமலைப்பட்டி',315,1),(17799,'சந்திரசேகரபுரம் அக்ரஹாரம்',315,1),(17800,'காக்காவேரி',315,1),(17801,'கார்கூடல்பட்டி பிட்-1',315,1),(17802,'கார்கூடல்பட்டி பிட்-2',315,1),(17803,'கார்கூடல்பட்டி பிட்-3',315,1),(17804,'கட்டனாச்சம்பட்டி',315,1),(17805,'கோனேரி பட்டி',315,1),(17806,'கூனவேலம்பட்டி',315,1),(17807,'கோப்பம்பட்டி',315,1),(17808,'குருக்கபுரம்',315,1),(17809,'குட்டலாடம்பட்டி',315,1),(17810,'மலையாம்பாளையம்',315,1),(17811,'மலையாம்பட்டி',315,1),(17812,'மதியம் பட்டி',315,1),(17813,'மாட்டுவேலம்பட்டி',315,1),(17814,'மின்னக்கல்',315,1),(17815,'மூலக்குறிச்சி',315,1),(17816,'மூலக்காடு',315,1),(17817,'முருங்கப்பட்டி',315,1),(17818,'நாச்சிப்பட்டி',315,1),(17819,'நடுப்பட்டி',315,1),(17820,'நாமகிரிப்பேட்டை',315,1),(17821,'நாரைக்கிணறு',315,1),(17822,'நாவல்பட்டி',315,1),(17823,'ஒ.ஜேடர்பாளையம்',315,1),(17824,'ஒடுவன்குறிச்சி',315,1),(17826,'Chakkarasamantham',204,1),(17827,'Chennampatti',204,1),(17828,'Kalvirayanpettai',204,1),(17829,'Keeraikollai',204,1),(17830,'Kondavattanthidal',204,1),(17831,'Marunkulam',204,1),(17832,'Mela Chitharkadu',204,1),(17833,'Melaveli Thottam',204,1),(17834,'Nanchikkottai',204,1),(17835,'Nanchikkottai Vallundanpattu',204,1),(17836,'Palliyeri',204,1),(17837,'Perambur 2Nd Sethi',204,1),(17838,'Perambur First Sethi',204,1),(17839,'Pillaiyarnatham',204,1),(17840,'Pillaiyarpatti',204,1),(17841,'Puliyanthoppu',204,1),(17842,'Ramanathapuram Addl.',204,1),(17843,'Ramanathapuram Chief',204,1),(17844,'Seeralur',204,1),(17845,'Soorakkottai',204,1),(17846,'Tirumalaisamuthiram',204,1),(17847,'Vallam North',204,1),(17848,'Vallam South',204,1),(17849,'Vallampudur',204,1),(17850,'Vannarapettai Addl.',204,1),(17851,'Vannarapettai Chief',204,1),(17852,'Vennalodai',204,1),(17853,'Vilar',204,1),(17854,'சோழமாதேவி',4,1),(17855,'ஆமணக்கந்தோண்டி',4,1),(17856,'கீழாநத்தம்',4,1);
/*!40000 ALTER TABLE `panchayath` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panpayment`
--

DROP TABLE IF EXISTS `panpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `ramjiservice_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panpayment`
--

LOCK TABLES `panpayment` WRITE;
/*!40000 ALTER TABLE `panpayment` DISABLE KEYS */;
INSERT INTO `panpayment` VALUES (1,1,1,1,NULL,NULL,NULL),(2,1,2,2,NULL,NULL,NULL);
/*!40000 ALTER TABLE `panpayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `panservice`
--

DROP TABLE IF EXISTS `panservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `panservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ramjiservice_id` int(11) DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `panservice`
--

LOCK TABLES `panservice` WRITE;
/*!40000 ALTER TABLE `panservice` DISABLE KEYS */;
INSERT INTO `panservice` VALUES (1,1,'New Card','1.jpg',100.00,'Active','2024-12-27 12:44:39'),(2,2,'Correction Pan Card','2.png',200.00,'Active','2024-12-27 12:45:25');
/*!40000 ALTER TABLE `panservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `passport`
--

DROP TABLE IF EXISTS `passport`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `passport` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `application_type` varchar(20) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `no_of_pages` varchar(20) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `mother_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `validity` varchar(10) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `place_of_birth` varchar(30) DEFAULT NULL,
  `district_of_birth` varchar(30) DEFAULT NULL,
  `state_of_birth` varchar(30) DEFAULT NULL,
  `qualification` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `email_id` varchar(20) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `age_id_proof` varchar(50) DEFAULT NULL,
  `employee_type` varchar(50) DEFAULT NULL,
  `area_police_station_name` varchar(30) DEFAULT NULL,
  `address_proof` varchar(500) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `school_tc` varchar(20) DEFAULT NULL,
  `marksheet` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `driving_licence` varchar(20) DEFAULT NULL,
  `lic_policy_bond` varchar(20) DEFAULT NULL,
  `service_record_extract` varchar(20) DEFAULT NULL,
  `bank_statement` varchar(20) DEFAULT NULL,
  `old_passport_copy` varchar(20) DEFAULT NULL,
  `electric` varchar(20) DEFAULT NULL,
  `gas_connection_proof` varchar(20) DEFAULT NULL,
  `rent_agreement` varchar(20) DEFAULT NULL,
  `certificate_from_employer` varchar(20) DEFAULT NULL,
  `parent_passport` varchar(20) DEFAULT NULL,
  `income_tax_assesssment` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `passport`
--

LOCK TABLES `passport` WRITE;
/*!40000 ALTER TABLE `passport` DISABLE KEYS */;
/*!40000 ALTER TABLE `passport` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patta`
--

DROP TABLE IF EXISTS `patta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `can_no` varchar(15) DEFAULT NULL,
  `reg_office` varchar(50) DEFAULT NULL,
  `subdivision_no` varchar(30) DEFAULT NULL,
  `rev_village` varchar(50) DEFAULT NULL,
  `survey_no` varchar(30) DEFAULT NULL,
  `transacted_area` varchar(50) DEFAULT NULL,
  `bond_doc` varchar(50) DEFAULT NULL,
  `ec` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patta`
--

LOCK TABLES `patta` WRITE;
/*!40000 ALTER TABLE `patta` DISABLE KEYS */;
/*!40000 ALTER TABLE `patta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT 0,
  `to_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `newbalance` decimal(10,2) DEFAULT 0.00,
  `iscommission` tinyint(4) DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `service_status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ad_info` varchar(100) DEFAULT NULL,
  `ad_info2` varchar(100) DEFAULT NULL,
  `paid_image` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `paydate` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `k_status` int(11) DEFAULT 1,
  `service_entity` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,3,2,300.00,3900.00,0,NULL,NULL,3,'Out Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'06:55:31','2026-01-21',3,1,NULL),(2,2,3,300.00,6830.00,0,NULL,NULL,3,'IN Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'06:55:31','2026-01-21',3,1,NULL),(3,3,2,300.00,3600.00,0,NULL,NULL,3,'Out Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'08:42:30','2026-01-21',3,1,NULL),(4,2,3,300.00,7130.00,0,NULL,NULL,3,'IN Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'08:42:30','2026-01-21',3,1,NULL),(5,3,2,300.00,3300.00,0,NULL,NULL,3,'Out Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'08:51:07','2026-01-21',3,1,NULL),(6,2,3,300.00,7430.00,0,NULL,NULL,3,'IN Payment',NULL,'Service Payment Tailoring Certificate',NULL,NULL,'08:51:07','2026-01-21',3,1,NULL);
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pmkissan`
--

DROP TABLE IF EXISTS `pmkissan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmkissan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `land_document` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmkissan`
--

LOCK TABLES `pmkissan` WRITE;
/*!40000 ALTER TABLE `pmkissan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pmkissan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pstm`
--

DROP TABLE IF EXISTS `pstm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pstm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `name` varchar(100) DEFAULT NULL,
  `name_tamil` varchar(100) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `father_name_tamil` varchar(100) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `mother_name` varchar(100) DEFAULT NULL,
  `mother_name_tamil` varchar(100) DEFAULT NULL,
  `emis_id` varchar(30) DEFAULT NULL,
  `academic_yr_from` varchar(30) DEFAULT NULL,
  `class_to` varchar(20) DEFAULT NULL,
  `school_type` varchar(30) DEFAULT NULL,
  `academic_yr_to` varchar(30) DEFAULT NULL,
  `school_name` varchar(200) DEFAULT NULL,
  `class_from` varchar(20) DEFAULT NULL,
  `block` varchar(200) DEFAULT NULL,
  `tc` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pstm`
--

LOCK TABLES `pstm` WRITE;
/*!40000 ALTER TABLE `pstm` DISABLE KEYS */;
/*!40000 ALTER TABLE `pstm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvc_card`
--

DROP TABLE IF EXISTS `pvc_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pvc_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `delivery_name` varchar(90) DEFAULT NULL,
  `delivery_mobile` varchar(20) DEFAULT NULL,
  `delivery_address` varchar(500) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvc_card`
--

LOCK TABLES `pvc_card` WRITE;
/*!40000 ALTER TABLE `pvc_card` DISABLE KEYS */;
/*!40000 ALTER TABLE `pvc_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pvc_details`
--

DROP TABLE IF EXISTS `pvc_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pvc_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pvc_id` int(10) unsigned NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `pvc_rationpdf` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `pvc_id` (`pvc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pvc_details`
--

LOCK TABLES `pvc_details` WRITE;
/*!40000 ALTER TABLE `pvc_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `pvc_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ramji_payment`
--

DROP TABLE IF EXISTS `ramji_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ramji_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) DEFAULT 0,
  `to_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `newbalance` decimal(10,2) DEFAULT 0.00,
  `iscommission` tinyint(4) DEFAULT 0,
  `customer_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `pay_id` int(11) DEFAULT NULL,
  `service_status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  `ad_info` varchar(100) DEFAULT NULL,
  `ad_info2` varchar(100) DEFAULT NULL,
  `paid_image` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `paydate` varchar(50) DEFAULT NULL,
  `log_id` int(11) DEFAULT NULL,
  `k_status` int(11) DEFAULT 1,
  `service_entity` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ramji_payment`
--

LOCK TABLES `ramji_payment` WRITE;
/*!40000 ALTER TABLE `ramji_payment` DISABLE KEYS */;
INSERT INTO `ramji_payment` VALUES (1,1,2,10.00,0.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit(PANADVANCE VERIFY)',NULL,NULL,'07:55:22','2024-12-21',2,1,NULL),(2,2,1,10.00,0.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit(PANADVANCE VERIFY)',NULL,NULL,'07:55:22','2024-12-21',2,1,NULL),(3,1,2,10.00,10.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit(RC PDF)',NULL,NULL,'13:33:57','2025-01-25',2,1,NULL),(4,2,1,10.00,20.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit(RC PDF)',NULL,NULL,'13:33:57','2025-01-25',2,1,NULL),(5,1,2,12.00,38.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit(PanCard)',NULL,NULL,'13:44:44','2025-01-25',2,1,NULL),(6,2,1,12.00,32.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit(PanCard)',NULL,NULL,'13:44:44','2025-01-25',2,1,NULL),(7,2,1,100.00,-68.00,0,NULL,NULL,2,'Out Payment',NULL,'Fund Transfer',NULL,NULL,'10:41:07','2025-02-28',1,1,NULL),(8,1,2,100.00,138.00,0,NULL,NULL,2,'IN Payment',NULL,'Fund Transfer',NULL,NULL,'10:41:07','2025-02-28',1,1,NULL),(9,1,2,30.00,108.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit Mobile Number',NULL,NULL,'10:45:51','2025-05-27',2,1,NULL),(10,2,1,30.00,-38.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit Mobile Number',NULL,NULL,'10:45:51','2025-05-27',2,1,NULL),(11,2,1,30.00,-68.00,0,NULL,NULL,5,'Out Payment',NULL,'Ramji Wallet Refund Mobile Number',NULL,NULL,'11:34:23','2025-05-27',1,1,NULL),(12,1,2,30.00,138.00,0,NULL,NULL,5,'IN Payment',NULL,'Ramji Wallet Refund Mobile Number',NULL,NULL,'11:34:23','2025-05-27',1,1,NULL),(13,1,2,20.00,118.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit Return Application Removed',NULL,NULL,'08:08:44','2025-06-05',2,1,NULL),(14,2,1,20.00,-48.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit Return Application Removed',NULL,NULL,'08:08:44','2025-06-05',2,1,NULL),(15,2,1,20.00,-68.00,0,NULL,NULL,5,'Out Payment',NULL,'Ramji Wallet Refund Return Application Removed',NULL,NULL,'08:14:48','2025-06-05',1,1,NULL),(16,1,2,20.00,138.00,0,NULL,NULL,5,'IN Payment',NULL,'Ramji Wallet Refund Return Application Removed',NULL,NULL,'08:14:48','2025-06-05',1,1,NULL),(17,2,1,30.00,-98.00,0,NULL,NULL,5,'Out Payment',NULL,'Ramji Wallet Refund ?????????? ?????????',NULL,NULL,'07:20:34','2025-08-06',1,1,NULL),(18,1,2,30.00,168.00,0,NULL,NULL,5,'IN Payment',NULL,'Ramji Wallet Refund ?????????? ?????????',NULL,NULL,'07:20:34','2025-08-06',1,1,NULL),(19,1,2,35.00,133.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit Adhaar Adress (Without Proof)',NULL,NULL,'09:51:31','2025-08-09',2,1,NULL),(20,2,1,35.00,-63.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit Adhaar Adress (Without Proof)',NULL,NULL,'09:51:31','2025-08-09',2,1,NULL),(21,1,2,35.00,98.00,0,NULL,NULL,2,'Out Payment',NULL,'Ramji Wallet Debit Adhaar Adress (Without Proof)',NULL,NULL,'10:01:31','2025-08-09',2,1,NULL),(22,2,1,35.00,-28.00,0,NULL,NULL,2,'IN Payment',NULL,'Ramji Wallet Credit Adhaar Adress (Without Proof)',NULL,NULL,'10:01:31','2025-08-09',2,1,NULL),(23,1,2,100.00,9800.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment புதிய பதிவு',NULL,NULL,'07:39:12','2025-11-10',2,1,NULL),(24,2,1,100.00,10200.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment புதிய பதிவு',NULL,NULL,'07:39:12','2025-11-10',2,1,NULL),(25,1,2,100.00,9700.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'07:39:19','2025-11-10',2,1,NULL),(26,2,1,100.00,10300.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'07:39:19','2025-11-10',2,1,NULL),(27,1,2,100.00,9600.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'07:45:10','2025-11-10',2,1,NULL),(28,2,1,100.00,10400.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'07:45:10','2025-11-10',2,1,NULL),(29,1,2,50.00,9550.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'07:47:14','2025-11-10',2,1,NULL),(30,2,1,50.00,10450.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'07:47:14','2025-11-10',2,1,NULL),(31,1,2,100.00,9450.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'14:53:49','2026-01-20',2,1,NULL),(32,2,1,100.00,10550.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'14:53:49','2026-01-20',2,1,NULL),(33,1,2,0.00,9450.00,0,NULL,NULL,2,'Out Payment',NULL,'Activation Payment (Tailoring Certificate - 2)',NULL,NULL,'15:02:27','2026-01-20',2,1,NULL),(34,2,1,0.00,10550.00,0,NULL,NULL,2,'IN Payment',NULL,'Activation Payment (Tailoring Certificate - 2)',NULL,NULL,'15:02:27','2026-01-20',2,1,NULL),(35,1,2,0.00,9450.00,0,NULL,NULL,2,'Out Payment',NULL,'Activation Payment (Computer Certificate - 2)',NULL,NULL,'15:02:42','2026-01-20',2,1,NULL),(36,2,1,0.00,10550.00,0,NULL,NULL,2,'IN Payment',NULL,'Activation Payment (Computer Certificate - 2)',NULL,NULL,'15:02:42','2026-01-20',2,1,NULL),(37,1,2,100.00,9350.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'05:51:56','2026-01-21',2,1,NULL),(38,2,1,100.00,10650.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10 & 12 தேர்ச்சி',NULL,NULL,'05:51:56','2026-01-21',2,1,NULL),(39,1,2,100.00,9250.00,0,NULL,NULL,2,'Out Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'05:54:01','2026-01-21',2,1,NULL),(40,2,1,100.00,10750.00,0,NULL,NULL,2,'IN Payment',NULL,'Service Payment கல்வி உதவித்தொகை 10,11&12 பயிலும் பெண் குழந்தைகள்',NULL,NULL,'05:54:01','2026-01-21',2,1,NULL);
/*!40000 ALTER TABLE `ramji_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ration`
--

DROP TABLE IF EXISTS `ration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `name` varchar(200) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ration`
--

LOCK TABLES `ration` WRITE;
/*!40000 ALTER TABLE `ration` DISABLE KEYS */;
/*!40000 ALTER TABLE `ration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rc`
--

DROP TABLE IF EXISTS `rc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rc` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT NULL,
  `rc_no` varchar(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rc`
--

LOCK TABLES `rc` WRITE;
/*!40000 ALTER TABLE `rc` DISABLE KEYS */;
INSERT INTO `rc` VALUES (1,2,4,10.00,'TN74AP3802','SARAVANAN','6794e84507f29.pdf','Approved','2025-01-25 13:33:57');
/*!40000 ALTER TABLE `rc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge`
--

DROP TABLE IF EXISTS `recharge`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile` varchar(20) DEFAULT NULL,
  `circle` varchar(10) DEFAULT NULL,
  `operator` varchar(10) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `commission_amount` decimal(10,2) DEFAULT 0.00,
  `recharge_date` date NOT NULL,
  `recharge_time` varchar(10) DEFAULT NULL,
  `user_id` int(11) DEFAULT 0,
  `plan_id` int(11) DEFAULT 0,
  `usertx` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `message` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge`
--

LOCK TABLES `recharge` WRITE;
/*!40000 ALTER TABLE `recharge` DISABLE KEYS */;
/*!40000 ALTER TABLE `recharge` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge_payment`
--

DROP TABLE IF EXISTS `recharge_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `ramjiservice_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge_payment`
--

LOCK TABLES `recharge_payment` WRITE;
/*!40000 ALTER TABLE `recharge_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `recharge_payment` ENABLE KEYS */;
UNLOCK TABLES;

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_payment`
--

LOCK TABLES `request_payment` WRITE;
/*!40000 ALTER TABLE `request_payment` DISABLE KEYS */;
INSERT INTO `request_payment` VALUES (1,2,2,1000.00,'08:12:12','2024-10-05','Approved','1.jpg'),(2,3,2,5000.00,'09:27:44','2024-11-08','Approved','2.jpg'),(3,7,1,10000.00,'09:15:08','2024-12-04','Pending','3.jpg'),(4,7,1,5000.00,'10:20:10','2024-12-04','Approved','4.jpg'),(5,6,2,100.00,'10:20:08','2025-02-11','Approved','5.jpg'),(6,2,1,100.00,'10:37:46','2025-02-28','Approved','6.jpg'),(7,5,2,200.00,'12:08:29','2025-04-21','Approved','7.jpg');
/*!40000 ALTER TABLE `request_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `serverpayment`
--

DROP TABLE IF EXISTS `serverpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `serverpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0.00,
  `activation_date` varchar(20) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  `website_name` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `serverpayment`
--

LOCK TABLES `serverpayment` WRITE;
/*!40000 ALTER TABLE `serverpayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `serverpayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_details`
--

DROP TABLE IF EXISTS `service_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT 0,
  `service_type` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_details`
--

LOCK TABLES `service_details` WRITE;
/*!40000 ALTER TABLE `service_details` DISABLE KEYS */;
INSERT INTO `service_details` VALUES (1,1,1,1,NULL),(2,1,2,2,NULL),(3,1,3,1,NULL),(4,1,4,1,NULL),(5,1,5,1,NULL),(6,1,6,1,NULL),(7,1,7,1,NULL),(8,1,8,1,NULL),(9,1,9,1,NULL),(10,1,10,1,NULL),(11,1,11,1,NULL),(12,1,12,1,NULL),(13,1,13,1,NULL),(14,1,14,1,NULL),(15,1,15,1,NULL),(16,1,16,1,NULL),(17,1,17,1,NULL),(18,1,18,1,NULL),(19,1,19,1,NULL),(20,1,20,1,NULL),(21,1,21,1,NULL),(22,1,22,1,NULL),(23,1,23,1,NULL),(24,1,24,1,NULL),(25,1,25,1,NULL),(26,1,26,1,NULL),(27,1,27,1,NULL),(28,1,28,1,NULL),(29,1,29,1,NULL),(30,1,30,1,NULL),(31,1,31,1,NULL),(32,1,32,1,NULL),(33,1,33,1,NULL),(34,1,34,1,NULL),(35,1,35,1,NULL),(36,1,36,1,NULL),(37,1,37,1,NULL),(38,1,38,1,NULL),(39,1,39,1,NULL),(40,1,40,1,NULL),(41,1,42,1,NULL),(42,2,1,1,NULL),(43,2,2,2,NULL),(44,2,3,1,NULL),(45,2,4,1,NULL),(46,2,5,1,NULL),(47,2,6,1,NULL),(48,2,7,1,NULL),(49,2,8,1,NULL),(50,2,9,1,NULL),(51,2,10,1,NULL),(52,2,11,1,NULL),(53,2,12,1,NULL),(54,2,13,1,NULL),(55,2,14,1,NULL),(56,2,15,1,NULL),(57,2,16,1,NULL),(58,2,17,1,NULL),(59,2,18,1,NULL),(60,2,19,1,NULL),(61,2,20,1,NULL),(62,2,21,1,NULL),(63,2,22,1,NULL),(64,2,23,1,NULL),(65,2,24,1,NULL),(66,2,25,1,NULL),(67,2,26,1,NULL),(68,2,27,1,NULL),(69,2,28,1,NULL),(70,2,29,1,NULL),(71,2,30,1,NULL),(72,2,31,1,NULL),(73,2,32,1,NULL),(74,2,33,1,NULL),(75,2,34,1,NULL),(76,2,35,1,NULL),(77,2,36,1,NULL),(78,2,37,1,NULL),(79,2,38,1,NULL),(80,2,39,1,NULL),(81,2,40,1,NULL),(82,2,42,1,NULL),(83,3,1,1,NULL),(84,3,2,1,NULL),(85,3,3,1,NULL),(86,3,4,2,NULL),(87,3,5,1,NULL),(88,3,6,1,NULL),(89,3,7,1,NULL),(90,3,8,1,NULL),(91,3,9,1,NULL),(92,3,10,1,NULL),(93,3,11,1,NULL),(94,3,12,1,NULL),(95,3,13,1,NULL),(96,3,14,1,NULL),(97,3,15,1,NULL),(98,3,16,1,NULL),(99,3,17,1,NULL),(100,3,18,1,NULL),(101,3,19,1,NULL),(102,3,20,1,NULL),(103,3,21,1,NULL),(104,3,22,1,NULL),(105,3,23,1,NULL),(106,3,24,1,NULL),(107,3,25,1,NULL),(108,3,26,1,NULL),(109,3,27,1,NULL),(110,3,28,1,NULL),(111,3,29,1,NULL),(112,3,30,1,NULL),(113,3,31,1,NULL),(114,3,32,1,NULL),(115,3,33,1,NULL),(116,3,34,1,NULL),(117,3,35,1,NULL),(118,3,36,1,NULL),(119,3,37,1,NULL),(120,3,38,1,NULL),(121,3,39,1,NULL),(122,3,40,1,NULL),(123,3,42,1,NULL),(124,4,1,1,NULL),(125,4,2,1,NULL),(126,4,3,1,NULL),(127,4,4,1,NULL),(128,4,5,1,NULL),(129,4,6,1,NULL),(130,4,7,1,NULL),(131,4,8,1,NULL),(132,4,9,1,NULL),(133,4,10,1,NULL),(134,4,11,1,NULL),(135,4,12,1,NULL),(136,4,13,1,NULL),(137,4,14,1,NULL),(138,4,15,1,NULL),(139,4,16,2,NULL),(140,4,17,1,NULL),(141,4,18,1,NULL),(142,4,19,1,NULL),(143,4,20,1,NULL),(144,4,21,1,NULL),(145,4,22,1,NULL),(146,4,23,1,NULL),(147,4,24,1,NULL),(148,4,25,1,NULL),(149,4,26,1,NULL),(150,4,27,1,NULL),(151,4,28,1,NULL),(152,4,29,1,NULL),(153,4,30,1,NULL),(154,4,31,1,NULL),(155,4,32,1,NULL),(156,4,33,1,NULL),(157,4,34,1,NULL),(158,4,35,1,NULL),(159,4,36,1,NULL),(160,4,37,1,NULL),(161,4,38,1,NULL),(162,4,39,1,NULL),(163,4,40,1,NULL),(164,4,42,1,NULL),(165,5,1,1,NULL),(166,5,2,2,NULL),(167,5,3,1,NULL),(168,5,4,1,NULL),(169,5,5,1,NULL),(170,5,6,1,NULL),(171,5,7,1,NULL),(172,5,8,1,NULL),(173,5,9,1,NULL),(174,5,10,1,NULL),(175,5,11,1,NULL),(176,5,12,1,NULL),(177,5,13,1,NULL),(178,5,14,1,NULL),(179,5,15,1,NULL),(180,5,16,1,NULL),(181,5,17,1,NULL),(182,5,18,1,NULL),(183,5,19,1,NULL),(184,5,20,1,NULL),(185,5,21,1,NULL),(186,5,22,1,NULL),(187,5,23,1,NULL),(188,5,24,1,NULL),(189,5,25,1,NULL),(190,5,26,1,NULL),(191,5,27,1,NULL),(192,5,28,1,NULL),(193,5,29,1,NULL),(194,5,30,1,NULL),(195,5,31,1,NULL),(196,5,32,1,NULL),(197,5,33,1,NULL),(198,5,34,1,NULL),(199,5,35,1,NULL),(200,5,36,1,NULL),(201,5,37,1,NULL),(202,5,38,1,NULL),(203,5,39,1,NULL),(204,5,40,1,NULL),(205,5,42,1,NULL),(206,7,1,1,NULL),(207,7,2,2,NULL),(208,7,3,1,NULL),(209,7,4,1,NULL),(210,7,5,1,NULL),(211,7,6,1,NULL),(212,7,7,1,NULL),(213,7,8,1,NULL),(214,7,9,1,NULL),(215,7,10,1,NULL),(216,7,11,1,NULL),(217,7,12,1,NULL),(218,7,13,1,NULL),(219,7,14,1,NULL),(220,7,15,1,NULL),(221,7,16,1,NULL),(222,7,17,1,NULL),(223,7,18,1,NULL),(224,7,19,1,NULL),(225,7,20,1,NULL),(226,7,21,1,NULL),(227,7,22,1,NULL),(228,7,23,1,NULL),(229,7,24,1,NULL),(230,7,25,1,NULL),(231,7,26,1,NULL),(232,7,27,1,NULL),(233,7,28,1,NULL),(234,7,29,1,NULL),(235,7,30,1,NULL),(236,7,31,1,NULL),(237,7,32,1,NULL),(238,7,33,1,NULL),(239,7,34,1,NULL),(240,7,35,1,NULL),(241,7,36,1,NULL),(242,7,37,1,NULL),(243,7,38,1,NULL),(244,7,39,1,NULL),(245,7,40,1,NULL),(246,7,42,1,NULL),(288,11,1,1,NULL),(289,11,2,2,NULL),(290,11,3,1,NULL),(291,11,4,1,NULL),(292,11,5,1,NULL),(293,11,6,1,NULL),(294,11,7,1,NULL),(295,11,8,1,NULL),(296,11,9,1,NULL),(297,11,10,1,NULL),(298,11,11,1,NULL),(299,11,12,1,NULL),(300,11,13,1,NULL),(301,11,14,1,NULL),(302,11,15,1,NULL),(303,11,16,1,NULL),(304,11,17,1,NULL),(305,11,18,1,NULL),(306,11,19,1,NULL),(307,11,20,1,NULL),(308,11,21,1,NULL),(309,11,22,1,NULL),(310,11,23,1,NULL),(311,11,24,1,NULL),(312,11,25,1,NULL),(313,11,26,1,NULL),(314,11,27,1,NULL),(315,11,28,1,NULL),(316,11,29,1,NULL),(317,11,30,1,NULL),(318,11,31,1,NULL),(319,11,32,1,NULL),(320,11,33,1,NULL),(321,11,34,1,NULL),(322,11,35,1,NULL),(323,11,36,1,NULL),(324,11,37,1,NULL),(325,11,38,1,NULL),(326,11,39,1,NULL),(327,11,40,1,NULL),(328,11,42,1,NULL);
/*!40000 ALTER TABLE `service_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_payment`
--

DROP TABLE IF EXISTS `service_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `ramjiservice_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  `admin_amount` decimal(10,2) DEFAULT 0.00,
  `coordinator_permission` int(11) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_payment`
--

LOCK TABLES `service_payment` WRITE;
/*!40000 ALTER TABLE `service_payment` DISABLE KEYS */;
INSERT INTO `service_payment` VALUES (18,53,0,54,10.00,5.00,20.00,0.00,0),(19,53,0,55,NULL,NULL,NULL,0.00,0),(20,53,0,124,NULL,NULL,NULL,0.00,0),(21,53,0,165,NULL,NULL,NULL,0.00,0),(22,53,0,166,NULL,NULL,NULL,0.00,0),(23,53,0,167,NULL,NULL,NULL,0.00,0),(24,53,0,168,NULL,NULL,NULL,0.00,0),(25,53,0,169,NULL,NULL,NULL,0.00,0),(34,59,0,60,10.00,80.00,5.00,50.00,1),(35,59,0,62,20.00,70.00,10.00,50.00,1),(36,59,0,63,30.00,60.00,15.00,20.00,1),(37,59,0,64,40.00,50.00,20.00,30.00,1),(38,59,0,65,50.00,40.00,25.00,40.00,1),(39,59,0,66,60.00,30.00,30.00,50.00,1),(40,59,0,67,70.00,20.00,35.00,60.00,1),(41,59,0,121,80.00,10.00,40.00,70.00,1),(42,59,0,208,10.00,20.00,12.00,20.00,1),(43,59,0,209,10.00,20.00,12.00,30.00,1),(44,59,0,210,10.00,20.00,12.00,20.00,1),(45,59,0,211,10.00,20.00,12.00,20.00,1),(46,59,0,226,20.00,70.00,12.00,20.00,1),(47,59,0,227,10.00,20.00,12.00,20.00,1),(48,1,2,2,100.00,100.00,100.00,1000.00,1),(49,1,3,3,30.00,30.00,30.00,500.00,1),(50,1,4,4,30.00,30.00,30.00,10.00,1),(51,1,0,11,30.00,30.00,30.00,30.00,1),(52,1,0,14,30.00,30.00,30.00,30.00,1),(53,1,0,15,30.00,30.00,30.00,30.00,1),(54,1,0,17,30.00,30.00,30.00,30.00,1),(55,1,0,20,30.00,30.00,30.00,30.00,1),(56,1,0,21,30.00,30.00,30.00,30.00,1),(57,1,0,22,30.00,30.00,30.00,30.00,1),(58,1,0,23,30.00,30.00,30.00,30.00,1),(59,1,0,24,30.00,30.00,30.00,30.00,1),(60,1,0,25,30.00,30.00,30.00,30.00,1),(61,1,0,26,30.00,30.00,30.00,30.00,1),(62,1,0,27,30.00,30.00,30.00,30.00,1),(63,1,0,28,30.00,30.00,30.00,30.00,1),(64,1,0,129,30.00,30.00,30.00,30.00,1),(65,1,0,151,30.00,30.00,30.00,30.00,1),(66,1,0,170,30.00,30.00,30.00,30.00,1),(67,1,0,171,30.00,30.00,30.00,30.00,1),(68,1,0,172,30.00,30.00,30.00,30.00,1),(69,1,0,173,30.00,30.00,30.00,30.00,1),(70,1,0,174,30.00,30.00,30.00,30.00,1),(71,1,0,175,30.00,30.00,30.00,30.00,1),(72,1,0,176,30.00,30.00,30.00,30.00,1),(73,1,0,177,30.00,30.00,30.00,30.00,1),(74,1,0,178,30.00,30.00,30.00,30.00,1),(75,57,0,56,30.00,30.00,NULL,35.00,1),(76,57,0,58,30.00,30.00,NULL,35.00,1),(77,57,0,72,30.00,30.00,NULL,35.00,1),(78,57,0,158,100.00,30.00,NULL,35.00,1),(79,57,0,159,30.00,30.00,NULL,35.00,1),(80,57,0,160,30.00,30.00,NULL,35.00,1),(81,57,0,161,30.00,30.00,NULL,35.00,1),(82,57,0,162,100.00,30.00,NULL,35.00,1),(83,57,0,163,30.00,30.00,NULL,35.00,1),(84,109,0,152,300.00,NULL,NULL,250.00,1),(85,109,0,153,300.00,NULL,NULL,300.00,1);
/*!40000 ALTER TABLE `service_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `ramjiservice_id` int(11) DEFAULT 0,
  `ser_id` int(11) DEFAULT 0,
  `api_id` int(11) DEFAULT 0,
  `service_name` varchar(100) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `aadhaar_image` varchar(10) DEFAULT NULL,
  `pan_image` varchar(10) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `service_image` varchar(10) DEFAULT NULL,
  `sub_service_image` varchar(30) DEFAULT NULL,
  `software` varchar(50) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,0,0,1,0,'TNeGA',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','1.jpg',NULL,NULL,NULL),(2,1,2,0,0,'???????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','2.png',NULL,NULL,60.00),(3,1,3,0,0,'?????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','3.png',NULL,NULL,60.00),(4,1,4,0,0,'OBC ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','4.png',NULL,NULL,60.00),(6,0,0,0,2,'Nalavariyam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','6.png',NULL,NULL,NULL),(10,0,0,0,0,'Software Keys',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','10.jpg',NULL,NULL,NULL),(11,1,0,0,0,'?????????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','11.png',NULL,NULL,60.00),(14,1,0,0,0,'?????????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','14.png',NULL,NULL,60.00),(15,1,0,0,0,'????? ???????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','15.png',NULL,NULL,60.00),(17,1,0,0,0,'???????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','17.png',NULL,NULL,60.00),(20,1,0,0,0,'???????? ???????? ???? ??????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','20.png',NULL,NULL,60.00),(21,1,0,0,0,'?????????? ??????? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','21.png',NULL,NULL,60.00),(22,1,0,0,0,'?????? ?????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','22.png',NULL,NULL,60.00),(23,1,0,0,0,'???? ???? ??????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','23.png',NULL,NULL,60.00),(24,1,0,0,0,'???????? ???????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','24.png',NULL,NULL,60.00),(25,1,0,0,0,'?????????? ???????? ??????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','25.png',NULL,NULL,60.00),(26,1,0,0,0,'??????? ???? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','26.png',NULL,NULL,60.00),(27,1,0,0,0,'??????? ????? ????????? ??????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','27.png',NULL,NULL,60.00),(28,1,0,0,0,'????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(30,0,0,0,0,'Digital Banner',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','30.jpg',NULL,NULL,NULL),(32,30,0,0,0,'Whatsapp Add',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','32.png',NULL,NULL,60.00),(33,0,0,0,0,'MSME',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','33.png',NULL,NULL,NULL),(34,33,0,8,0,'MSME',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','34.png',NULL,NULL,50.00),(35,0,0,0,0,'RATION CARD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','35.jpg',NULL,NULL,NULL),(36,35,0,9,0,'????? ??????? ?????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','36.png',NULL,NULL,500.00),(37,35,0,9,0,'???? ?????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','37.png',NULL,NULL,500.00),(38,35,0,9,0,'????? ??????? (With Proof)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','38.png',NULL,NULL,500.00),(39,35,0,9,0,'????? ??????? (Without Proof)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','39.png',NULL,NULL,500.00),(41,35,0,9,0,'????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','41.png',NULL,NULL,500.00),(42,35,0,9,0,'?????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','42.png',NULL,NULL,500.00),(43,35,0,9,0,'??????? ?????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','43.png',NULL,NULL,500.00),(46,45,0,0,0,'ITR Fillings',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','46.jpg',NULL,NULL,500.00),(48,47,0,0,0,'GST Registration',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','48.png',NULL,NULL,500.00),(49,0,0,0,0,'ITR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','49.png',NULL,NULL,NULL),(50,0,0,0,0,'GST',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','50.jpg',NULL,NULL,NULL),(51,49,0,0,0,'ITR Fillings',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','51.jpg',NULL,NULL,60.00),(52,50,0,0,0,'GST Registration',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','52.png',NULL,NULL,60.00),(53,0,0,0,0,'TEC Exam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','53.png',NULL,NULL,NULL),(54,53,0,0,0,'?????? ????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','54.jpg',NULL,NULL,60.00),(55,53,0,0,0,'TEC EXAM REGISTERATION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,30.00),(56,57,0,10,0,'Adhaar Adress (Without Proof)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(57,0,0,0,0,'Adhaar Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','57.jpg',NULL,NULL,NULL),(58,57,0,10,0,'Adhaar Adress (With Proof)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(59,0,0,0,0,'CAN EDIT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','59.jpg',NULL,NULL,NULL),(60,59,0,4,0,'New Can Registration',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(62,59,0,4,0,'Name Correction',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(63,59,0,4,0,'DOB Correction',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(64,59,0,4,0,'Mobile Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(65,59,0,4,0,'Certificate Find',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(66,59,0,4,0,'Can Delete',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(67,59,0,4,0,'Legal Heir Certificate Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(68,0,0,0,0,'Fast Tag',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','68.png',NULL,NULL,NULL),(69,68,0,0,0,'Agent Id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(70,68,0,0,0,'Coupon Booking',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(71,68,0,0,0,'Apply Fast Tag',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(72,57,0,10,0,'Find Adhaar Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(73,6,0,0,0,'????? ?????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(74,6,0,0,0,'(6,7,8 & 9)???? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,90.00),(75,6,0,0,0,'10,11&12 ??????? ???? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(76,6,0,0,0,'????? ?????????? 10&12????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(77,35,0,9,0,'Find Cell Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(78,35,0,9,0,'Re - Activation',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(79,35,0,9,0,'Smart Card Approval',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(80,35,0,9,0,'Adhaar Link',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(81,35,0,9,0,'Change Card Type',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(82,35,0,9,0,'Name Limit Cross',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(83,35,0,9,0,'Find Family Members',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(84,35,0,9,0,'Smart Card Find (Without Otp)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(85,6,0,0,0,'??????????? ???? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(86,6,0,0,0,'?????????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(87,6,0,0,0,'?????????? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,30.00),(88,6,0,0,0,'???????? ????(???????????)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(89,6,0,0,0,'???????? ????(??????????)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(91,6,0,0,0,'?????? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(92,6,0,0,0,'??? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(93,6,0,0,0,'??????? ??? ???? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(94,6,0,0,0,'?????? ??? ???? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,120.00),(95,6,0,0,0,'?????? ?????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,20.00),(96,6,0,0,0,'?????? ??? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,30.00),(97,6,0,0,0,'????? ???????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,30.00),(98,6,0,0,0,'?????????? ??????? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,30.00),(99,0,0,0,0,'????? ????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','99.jpg',NULL,NULL,NULL),(100,99,0,0,0,'?????? ????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(101,0,0,0,0,'Voter ID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','101.jpg',NULL,NULL,NULL),(102,0,0,0,0,'Passport',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','102.png',NULL,NULL,NULL),(103,0,0,0,0,'Ramji Union',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','103.jpg',NULL,NULL,NULL),(104,0,0,0,0,'Dharsan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','104.jpg',NULL,NULL,NULL),(105,0,0,0,0,'EPF',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','105.png',NULL,NULL,NULL),(106,0,0,0,0,'PM Kisan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','106.jpg',NULL,NULL,NULL),(107,0,0,0,0,'Birth & Death',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','107.jpg',NULL,NULL,NULL),(108,0,0,0,0,'FSSAI',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','108.jpg',NULL,NULL,NULL),(109,0,0,0,0,'Certificate Courses',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','109.jpg',NULL,NULL,NULL),(110,0,0,0,0,'EMPLOYMENT SERVICES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','110.jpg',NULL,NULL,NULL),(111,0,0,0,0,'COVID - 19',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','111.jpg',NULL,NULL,NULL),(112,0,0,0,0,'TNEB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','112.jpg',NULL,NULL,NULL),(113,101,0,5,0,'NEW VOTER ID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(114,0,0,0,0,'GAZETTE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','114.jpg',NULL,NULL,NULL),(115,0,0,0,0,'License',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','115.jpg',NULL,NULL,NULL),(116,0,0,0,0,'Medical Scheme',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','116.jpg',NULL,NULL,NULL),(117,0,0,0,0,'CIBIL SCORE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','117.webp',NULL,NULL,NULL),(118,0,0,0,0,'AEPS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','118.jpg',NULL,NULL,NULL),(119,0,0,0,0,'LIC',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','119.jpg',NULL,NULL,NULL),(120,101,0,5,0,'Find Voter ID',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(121,59,0,0,0,'Find Can Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,5.00),(122,108,0,11,0,'New Registration(Food service)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(123,108,0,11,0,'Renewal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(124,53,0,0,0,'TEC CORRECTION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(125,111,0,0,0,'Dose- Double dose',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(126,0,0,0,0,'e sevai',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','126.jpg',NULL,NULL,NULL),(127,0,0,0,0,'e sevai',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','127.jpg',NULL,NULL,NULL),(128,0,0,0,0,'e sevai',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','128.jpg',NULL,NULL,NULL),(129,1,0,0,0,'PSTM ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(130,0,0,0,0,'GENERAL ISSURANCE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','130.jpg',NULL,NULL,NULL),(131,0,0,0,0,'HEALTH INSURANCE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','131.jpg',NULL,NULL,NULL),(132,0,0,0,0,'DIGITAL GOLD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','132.jpg',NULL,NULL,NULL),(133,0,0,0,0,'TOURS & TRAVELS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','133.jpg',NULL,NULL,NULL),(134,0,0,0,0,'SCHOLARSHIP',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','134.jpg',NULL,NULL,NULL),(135,0,0,0,0,'SHOPPPING',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','135.jpg',NULL,NULL,NULL),(136,0,0,0,0,'ADMISSION',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','136.jpg',NULL,NULL,NULL),(137,0,0,0,0,'FOOD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','137.jpg',NULL,NULL,NULL),(138,0,0,0,0,'MATRIMONY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','138.jpg',NULL,NULL,NULL),(139,0,0,0,0,'EVENT MANAGEMENT',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','139.jpg',NULL,NULL,NULL),(140,0,0,0,0,'SERVICES',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','140.jpg',NULL,NULL,NULL),(141,0,0,0,0,'FOR SALE',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive','141.png',NULL,NULL,NULL),(142,115,0,0,0,'New License ( LLR)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(143,115,0,0,0,'Driving License Renewal',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(144,115,0,0,0,'Apply Duplicate License',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(145,115,0,0,0,'Adress Change',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(146,115,0,0,0,'International Driving Permit',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(147,115,0,0,0,'Find Driving License',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(148,115,0,0,0,'Rc PDF',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(149,115,0,0,0,'Find RC For Check',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(150,115,0,0,0,'Driving License PDF',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(151,1,0,0,0,'????? ?????? ????? ??????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(152,109,0,0,0,'Tailoring Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,300.00),(153,109,0,0,0,'Computer Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,300.00),(154,109,0,0,0,'Beautician Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,300.00),(155,107,0,0,0,'Birth Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(156,107,0,0,0,'Deadth Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(157,106,0,0,0,'New Registeration Approval',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(158,57,0,10,0,'Adhaar Name Limit Cross',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(159,57,0,10,0,'Aadhaar DOB Limit Cross',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(160,57,0,10,0,'EID to Adhaar PDF(without Otp)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(161,57,0,10,0,'EID to Adhaar Number(without Otp)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(162,57,0,10,0,'Adhaar Number to Adhaar PDF(Without Otp)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(163,57,0,10,0,'Eshram to Adhaar PDF',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(164,101,0,5,0,'Link Mobile Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(165,53,0,0,0,'Csc Approved',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(166,53,0,0,0,'IIBF EXAM REGISTERATIONN',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(167,53,0,0,0,'INS Exam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(168,53,0,0,0,'RAP Exam',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(169,53,0,0,0,'VLE Insurance',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(170,1,0,0,0,'??? ?????? ???????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(171,1,0,0,0,'????????????? ?????? ???? ????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(172,1,0,0,0,'?????????????? ????????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(173,1,0,0,0,'??????????????? ????????????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(174,1,0,0,0,'??????????? ????? ???????????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(175,1,0,0,0,'??????????? ?????? ???? ??????? ???????????? ???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(176,1,0,0,0,'????????? ???? ?????????? ??????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(177,1,0,0,0,'????? ????? ?????? ??????????(???? ?????, ?????????)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(178,1,0,0,0,'????? ???????? ????????? ???????????????? ?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(179,116,0,0,0,'CM Health Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(180,116,0,0,0,'Ayushman Health Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(181,101,0,5,0,'Voter ID Correction',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(182,101,0,5,0,'Delete Duplicate Voter Id',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(183,104,0,0,0,'???????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(184,104,0,0,0,'?????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(185,104,0,0,0,'????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(186,104,0,0,0,'??????????????',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(187,10,0,6,0,'EPRO - 13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(188,10,0,6,0,'TN - Health Card Maker With QR',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(189,10,0,6,0,'Long Adhaar Setup',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(190,68,0,0,0,'Pan Details',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(191,30,0,0,0,'Visiting Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(192,30,0,0,0,'Banners',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(193,10,0,6,0,'TNPDS Smart Card PVC Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(194,10,0,6,0,'Pan Card NSDL and UTI Manual Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(195,10,0,6,0,'Eshram Id Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(196,10,0,6,0,'Epic Voter Id Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(197,10,0,6,0,'Pahal Aadhaar pdf Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(198,10,0,6,0,'Passport Size photo Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(199,10,0,6,0,'RC PVC Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(200,10,0,0,0,'DL PVC Maker',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(201,10,0,0,0,'Tamil Astrology',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(202,10,0,0,0,'Fisherman Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(203,10,0,0,0,'Epro 12.5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(204,10,0,0,0,'PMJAY',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(205,10,0,0,0,'Insant Pan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(206,10,0,0,0,'Colour  Adhaar PVC Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(207,10,0,0,0,'Whole Software Keys',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,60.00),(208,59,0,4,0,'Name + Cell Number',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(209,59,0,4,0,'Name + Date of Birth',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(210,59,0,4,0,'Cell Number + Date of Birth',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(211,59,0,4,0,'Name  + Cell Number + DOB',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,75.00),(212,0,0,0,0,'Patta',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','212.jpg',NULL,NULL,NULL),(213,212,0,2,0,'Patta Transfer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(214,212,0,2,0,'Rural Patta Transfer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(215,212,0,2,0,'Natham Patta Transfer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(216,0,0,0,0,'Utisl Pan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','216.jpg',NULL,NULL,NULL),(217,216,0,3,0,'NewUtisl Pan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','217.jpg',NULL,NULL,NULL),(218,216,0,3,0,'CorrectionUtisl Pan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','217.jpg',NULL,NULL,NULL),(219,212,0,2,0,'Agri Stock',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,300.00),(220,0,0,0,0,'Smart Card',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','220.jpg',NULL,NULL,NULL),(221,220,0,0,0,'Name Removal (Without OTP)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(222,220,0,0,0,'ADD Family Member(Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(223,220,0,0,0,'Name Transfer (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(224,0,0,0,0,'PSTM Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active','224.jpg',NULL,NULL,NULL),(225,224,0,0,0,'PSTM Certificate',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(226,59,0,0,0,'Saved Application Removed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,60.00),(227,59,0,0,0,'Return Application Removed',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(228,220,0,0,0,'Name Correction (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(229,220,0,0,0,'DOB Correction (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(230,220,0,0,0,'Relationship Change(Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(231,220,0,0,0,'Name - DOB (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(232,220,0,0,0,'Name-DOB-Relationship Correction-(Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(233,220,0,0,0,'Name - Relationship (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(234,220,0,0,0,'Date Of Birth - Relationship(Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Active',NULL,NULL,NULL,NULL),(235,220,0,0,0,'Adress Correction(Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(236,220,0,0,0,'CHANGE FAMILY HEAD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(237,220,0,0,0,'SMART CARD UNBLOCK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(238,220,0,0,0,'NAME LIMIT CROSS',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(239,220,0,0,0,'FIND SMART CARD LINK CELL NUMBER',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(240,220,0,0,0,'ADHAAR LINK IN SMART CARD',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL),(241,220,0,0,0,'DOB Correction (Smart Card)',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Inactive',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sitepayment`
--

DROP TABLE IF EXISTS `sitepayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sitepayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website_id` int(11) DEFAULT 0,
  `site_paymentid` varchar(50) DEFAULT NULL,
  `type` text DEFAULT NULL,
  `payment_reason` text DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT 0.00,
  `payment_status` varchar(20) DEFAULT NULL,
  `paid_status` varchar(20) DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `updated_at` varchar(20) DEFAULT NULL,
  `created_at` varchar(20) DEFAULT NULL,
  `paid_image` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sitepayment`
--

LOCK TABLES `sitepayment` WRITE;
/*!40000 ALTER TABLE `sitepayment` DISABLE KEYS */;
INSERT INTO `sitepayment` VALUES (1,18,'1','Service','Pan Card',300.00,'PAID','Approved','2025-09-25','2025-09-24 10:48:37','2025-09-24 10:48:37','1.jpg');
/*!40000 ALTER TABLE `sitepayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smartcard`
--

DROP TABLE IF EXISTS `smartcard`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smartcard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT '0',
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `member` varchar(50) DEFAULT NULL,
  `aadhaar` varchar(50) DEFAULT NULL,
  `aadhaar2` varchar(20) DEFAULT NULL,
  `aadhaar3` varchar(20) DEFAULT NULL,
  `documents` varchar(20) DEFAULT NULL,
  `patta` varchar(20) DEFAULT NULL,
  `rental_agreement` varchar(20) DEFAULT NULL,
  `already_applied_application` text DEFAULT NULL,
  `aadhaar4` varchar(20) DEFAULT NULL,
  `aadhaar5` varchar(20) DEFAULT NULL,
  `add_member` varchar(50) DEFAULT NULL,
  `aadhaar_card2` varchar(20) DEFAULT NULL,
  `aadhaar_card3` varchar(20) DEFAULT NULL,
  `aadhaar_card4` varchar(20) DEFAULT NULL,
  `aadhaar_card5` varchar(20) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(100) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `birth_certificate` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `death_certificate` varchar(20) DEFAULT NULL,
  `mrg_certificate` varchar(20) DEFAULT NULL,
  `mrg_invitation` varchar(20) DEFAULT NULL,
  `passport` varchar(20) DEFAULT NULL,
  `bank_passbook` varchar(50) DEFAULT NULL,
  `family_head_name` varchar(50) DEFAULT NULL,
  `email_id` varchar(50) DEFAULT NULL,
  `electricity_bill_receipt` varchar(20) DEFAULT NULL,
  `telephone_charges` varchar(20) DEFAULT NULL,
  `gas_cylinder_receipt` varchar(20) DEFAULT NULL,
  `property_tax_applicant_owns_house` varchar(20) DEFAULT NULL,
  `lease_deed` varchar(20) DEFAULT NULL,
  `allotment_rder_of_slum_replacement_board` varchar(20) DEFAULT NULL,
  `bond_leave_proof` varchar(20) DEFAULT NULL,
  `first_page_of_bank_account_book` varchar(20) DEFAULT NULL,
  `name_tamil` varchar(20) DEFAULT NULL,
  `father_or_husband_tamil` varchar(50) DEFAULT NULL,
  `name_english` varchar(20) DEFAULT NULL,
  `father_or_husband_english` varchar(50) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `monthly_income` varchar(20) DEFAULT NULL,
  `family_head_photo` varchar(50) DEFAULT NULL,
  `family_head_aadhaar` text DEFAULT NULL,
  `address_tamil_1` varchar(50) DEFAULT NULL,
  `address_tamil_2` varchar(50) DEFAULT NULL,
  `address_tamil_3` varchar(50) DEFAULT NULL,
  `address_english_1` varchar(50) DEFAULT NULL,
  `address_english_2` varchar(50) DEFAULT NULL,
  `address_english_3` varchar(50) DEFAULT NULL,
  `gas_connection_no` varchar(50) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `commodity_card` varchar(20) DEFAULT NULL,
  `rice_card` varchar(20) DEFAULT NULL,
  `sugar_card` varchar(20) DEFAULT NULL,
  `any_proof` varchar(40) DEFAULT NULL,
  `new_proof` varchar(40) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applicant_reciept` varchar(20) DEFAULT NULL,
  `smart_mobile` varchar(10) DEFAULT NULL,
  `change_cardtype` varchar(20) DEFAULT NULL,
  `smartcard_online` varchar(20) DEFAULT NULL,
  `others` varchar(20) DEFAULT NULL,
  `any_document` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `dob` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartcard`
--

LOCK TABLES `smartcard` WRITE;
/*!40000 ALTER TABLE `smartcard` DISABLE KEYS */;
/*!40000 ALTER TABLE `smartcard` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smartcard_otp`
--

DROP TABLE IF EXISTS `smartcard_otp`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smartcard_otp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `smart_card` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `application` varchar(50) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `documents` varchar(20) DEFAULT NULL,
  `name_tamil` varchar(100) DEFAULT NULL,
  `name_english` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartcard_otp`
--

LOCK TABLES `smartcard_otp` WRITE;
/*!40000 ALTER TABLE `smartcard_otp` DISABLE KEYS */;
/*!40000 ALTER TABLE `smartcard_otp` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `smartcard_payment`
--

DROP TABLE IF EXISTS `smartcard_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `smartcard_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  `admin_amount` decimal(10,2) DEFAULT 0.00,
  `time` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `smartcard_payment`
--

LOCK TABLES `smartcard_payment` WRITE;
/*!40000 ALTER TABLE `smartcard_payment` DISABLE KEYS */;
INSERT INTO `smartcard_payment` VALUES (3,35,36,1,10.00,100.00,50.00,50.00,NULL);
/*!40000 ALTER TABLE `smartcard_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `software`
--

DROP TABLE IF EXISTS `software`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `software` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `device_name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `software`
--

LOCK TABLES `software` WRITE;
/*!40000 ALTER TABLE `software` DISABLE KEYS */;
/*!40000 ALTER TABLE `software` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tailor`
--

DROP TABLE IF EXISTS `tailor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tailor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(30) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `significant` varchar(20) DEFAULT NULL,
  `father_or_hus_name` varchar(30) DEFAULT NULL,
  `door_no` varchar(20) DEFAULT NULL,
  `street_name` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `postal_area` varchar(100) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `course_name` varchar(50) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `entity` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tailor`
--

LOCK TABLES `tailor` WRITE;
/*!40000 ALTER TABLE `tailor` DISABLE KEYS */;
INSERT INTO `tailor` VALUES (1,152,1,0,3,0,300.00,'Saravanan p',11,95,NULL,'D/O','aaaaaaaaaaaaa','qqq','ELANTHAVILAI PALLAM POST','629601','629601','234567876543','Aari work & Designing','6970937b5975b.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,'2026-01-21',NULL,'2026-01-21',NULL);
/*!40000 ALTER TABLE `tailor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taluk`
--

DROP TABLE IF EXISTS `taluk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taluk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dist_id` int(11) DEFAULT NULL,
  `taluk_name` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=314 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taluk`
--

LOCK TABLES `taluk` WRITE;
/*!40000 ALTER TABLE `taluk` DISABLE KEYS */;
INSERT INTO `taluk` VALUES (1,1,'Alandur','Active'),(2,1,'Ambattur','Active'),(3,1,'Aminjikarai','Active'),(4,1,'Ayanavaram','Active'),(5,1,'Egmore','Active'),(6,1,'Guindy','Active'),(7,1,'Madhavaram','Active'),(8,1,'Madhuravoyal','Active'),(9,1,'Mambalam','Active'),(10,1,'Mylapore','Active'),(11,1,'Perambur','Active'),(12,1,'Purasavakkam','Active'),(13,1,'Sholinganallur','Active'),(14,1,'Thiruvottriyur','Active'),(15,1,'Tondiarpet','Active'),(16,1,'Velacherry','Active'),(17,2,'Aanaimalai','Active'),(18,2,'Annur','Active'),(19,2,'Coimbatore(North)','Active'),(20,2,'Coimbatore(South)','Active'),(21,2,'Kinathukadavu','Active'),(22,2,'Madukarai','Active'),(23,2,'Mettupalayam','Active'),(24,2,'Perur','Active'),(25,2,'Pollachi','Active'),(26,2,'Sulur','Active'),(27,2,'Valparai','Active'),(28,3,'Cuddalore','Active'),(29,3,'Bhuvanagiri','Active'),(30,3,'Chidambaram','Active'),(31,3,'Kattumannarkoil','Active'),(32,3,'Kurinjipadi','Active'),(33,3,'Panruti','Active'),(34,3,'Srimushnam','Active'),(35,3,'Thittakudi','Active'),(36,3,'Veppur','Active'),(37,3,'Virudhachalam','Active'),(38,4,'Dharmapuri','Active'),(39,4,'Harur','Active'),(40,4,'Karimangalam','Active'),(41,4,'Nallampalli','Active'),(42,4,'Palacode','Active'),(43,4,'Pappireddipatti','Active'),(44,4,'Pennagaram','Active'),(45,5,'Atthur','Active'),(46,5,'Dindigul (East)','Active'),(47,5,'Dindigul (West)','Active'),(48,5,'Guziliyamparai','Active'),(49,5,'Kodaikanal','Active'),(50,5,'Natham','Active'),(51,5,'Nilakottai','Active'),(52,5,'Oddanchatram','Active'),(53,5,'Palani','Active'),(54,5,'Vedasandur','Active'),(55,6,'Erode','Active'),(56,6,'Anthiyur','Active'),(57,6,'Bhavani','Active'),(58,6,'Gobichettipalayam','Active'),(59,6,'Kodumudi','Active'),(60,6,'Modakurichi','Active'),(61,6,'Nambiyur','Active'),(62,6,'Perundurai','Active'),(63,6,'Sathiyamangalam','Active'),(64,6,'Thalavadi','Active'),(65,7,'Kancheepuram','Active'),(66,7,'Kundrathur','Active'),(67,7,'Sriperumbudur','Active'),(68,7,'Uthiramerur','Active'),(69,7,'Walajabad','Active'),(70,8,'Agasteeswaram','Active'),(71,8,'Kalkulam','Active'),(72,8,'Killiyur','Active'),(73,8,'Thiruvatar','Active'),(74,8,'Thovalai','Active'),(75,8,'Vilavankodu','Active'),(76,9,'Karur','Active'),(77,9,'Aravakurichi','Active'),(78,9,'Kadavur','Active'),(79,9,'Krishnarayapuram','Active'),(80,9,'Kulithalai','Active'),(81,9,'Manmangalam','Active'),(82,9,'Pugalur','Active'),(83,10,'Kallikudi','Active'),(84,10,'Madurai (East)','Active'),(85,10,'Madurai (North)','Active'),(86,10,'Madurai (South)','Active'),(87,10,'Madurai (West)','Active'),(88,10,'Melur','Active'),(89,10,'Peraiyur','Active'),(90,10,'Thirumangalam','Active'),(91,10,'Thiruparankundram','Active'),(92,10,'Usilampatti','Active'),(93,10,'Vadipatti','Active'),(94,11,'Nagapattinam','Active'),(95,11,'Kilvelur','Active'),(96,11,'Thirukkuvalai','Active'),(97,11,'Vedaranyam','Active'),(98,12,'Namakkal','Active'),(99,12,'Kholli Hills','Active'),(100,12,'Kumarapalayam','Active'),(101,12,'Mohanoor','Active'),(102,12,'Paramathi Velur','Active'),(103,12,'Rasipuram','Active'),(104,12,'Senthamangalam','Active'),(105,12,'Tiruchengode','Active'),(106,13,'Udagamandalam','Active'),(107,13,'Coonoor','Active'),(108,13,'Gudalur','Active'),(109,13,'Kothagiri','Active'),(110,13,'Kundah','Active'),(111,13,'Pandalur','Active'),(112,14,'Perambalur','Active'),(113,14,'Alathur','Active'),(114,14,'Kunnam','Active'),(115,14,'Veppanthattai','Active'),(116,15,'Pudukottai','Active'),(117,15,'Alangudi','Active'),(118,15,'Aranthangi','Active'),(119,15,'Avudiyarkoil','Active'),(120,15,'Gandarvakottai','Active'),(121,15,'Iluppur','Active'),(122,15,'Karambakudi','Active'),(123,15,'Kulathur','Active'),(124,15,'Manamelkudi','Active'),(125,15,'Ponnamaravathi','Active'),(126,15,'Thirumayam','Active'),(127,15,'Viralimalai','Active'),(128,16,'Ramanathapuram','Active'),(129,16,'Kadaladi','Active'),(130,16,'Kamuthi','Active'),(131,16,'Kezhakarai','Active'),(132,16,'Mudukulathur','Active'),(133,16,'Paramakudi','Active'),(134,16,'Rajasingamangalam','Active'),(135,16,'Rameswaram','Active'),(136,16,'Tiruvadanai','Active'),(137,17,'Salem','Active'),(138,17,'Attur','Active'),(139,17,'Edapadi','Active'),(140,17,'Gangavalli','Active'),(141,17,'Kadaiyampatti','Active'),(142,17,'Mettur','Active'),(143,17,'Omalur','Active'),(144,17,'Pethanayakanpalayam','Active'),(145,17,'Salem South','Active'),(146,17,'Salem West','Active'),(147,17,'Sankari','Active'),(148,17,'Vazhapadi','Active'),(149,17,'Yercaud','Active'),(150,18,'Sivagangai','Active'),(151,18,'Devakottai','Active'),(152,18,'Ilayankudi','Active'),(153,18,'Kalaiyarkovil','Active'),(154,18,'Karaikudi','Active'),(155,18,'Manamadurai','Active'),(156,18,'Singampunari','Active'),(157,18,'Thirupuvanam','Active'),(158,18,'Tirupathur','Active'),(159,19,'Thanjavur','Active'),(160,19,'Boothalur','Active'),(161,19,'Kumbakonam','Active'),(162,19,'Orathanadu','Active'),(163,19,'Papanasam','Active'),(164,19,'Pattukottai','Active'),(165,19,'Peravurani','Active'),(166,19,'Thiruvaiyaru','Active'),(167,19,'Thiruvidaimaruthur','Active'),(168,20,'Theni','Active'),(169,20,'Aandipatti','Active'),(170,20,'Bodinayakanur','Active'),(171,20,'Periyakulam','Active'),(172,20,'Uthamapalayam','Active'),(173,21,'Thiruvallur','Active'),(174,21,'Avadi','Active'),(175,21,'Gummidipoondi','Active'),(176,21,'Pallipattu','Active'),(177,21,'Ponneri','Active'),(178,21,'Poonamallee','Active'),(179,21,'R.K. Pet','Active'),(180,21,'Tiruthani','Active'),(181,21,'Uthukottai','Active'),(182,22,'Thiruvannamalai','Active'),(183,22,'Arni','Active'),(184,22,'Chengam','Active'),(185,22,'Chetpet','Active'),(186,22,'Cheyyar','Active'),(187,22,'Jamunamarathur','Active'),(188,22,'Kalasapakkam','Active'),(189,22,'Kilpennathur','Active'),(190,22,'Polur','Active'),(191,22,'Thandramet','Active'),(192,22,'Vandavasi','Active'),(193,22,'Vembakkam','Active'),(194,23,'Thiruvarur','Active'),(195,23,'Kodavasal','Active'),(196,23,'Koothanallur','Active'),(197,23,'Mannargudi','Active'),(198,23,'Nannilam','Active'),(199,23,'Needamangalam','Active'),(200,23,'Thiruthuraipoondi','Active'),(201,23,'Valangaiman','Active'),(202,24,'Thoothukudi','Active'),(203,24,'Eral','Active'),(204,24,'Ettayapuram','Active'),(205,24,'Kayathar','Active'),(206,24,'Kovilpatti','Active'),(207,24,'Ottapidaram','Active'),(208,24,'Sattankulam','Active'),(209,24,'Srivaikundam','Active'),(210,24,'Tiruchendur','Active'),(211,24,'Vilathikulam','Active'),(212,25,'Lalgudi','Active'),(213,25,'Manachanallur','Active'),(214,25,'Manapparai','Active'),(215,25,'Marungapuri','Active'),(216,25,'Musiri','Active'),(217,25,'Srirangam','Active'),(218,25,'Thottiam','Active'),(219,25,'Thuraiyur','Active'),(220,25,'Tiruchirapalli (West)','Active'),(221,25,'Tiruchirappalli (East)','Active'),(222,25,'Tiruverumbur','Active'),(223,26,'Tirunelveli','Active'),(224,26,'Ambasamudram','Active'),(225,26,'Cheranmahadevi','Active'),(226,26,'Manur','Active'),(227,26,'Nanguneri','Active'),(228,26,'Palayamkottai','Active'),(229,26,'Radhapuram','Active'),(230,26,'Thisayanvilai','Active'),(231,27,'Vellore','Active'),(232,27,'Aanikattu','Active'),(233,27,'Gudiyatham','Active'),(234,27,'K V Kuppam','Active'),(235,27,'Katpadi','Active'),(236,27,'Pernambut','Active'),(237,28,'Villupuram','Active'),(238,28,'Gingee','Active'),(239,28,'Kandachipuram','Active'),(240,28,'Marakanam','Active'),(241,28,'Melmalaiyanur','Active'),(242,28,'Thiruvennainallur','Active'),(243,28,'Tindivanam','Active'),(244,28,'Vanur','Active'),(245,28,'Vikravandi','Active'),(246,29,'Virudhunagar','Active'),(247,29,'Aruppukottai','Active'),(248,29,'Kariyapatti','Active'),(249,29,'Rajapalayam','Active'),(250,29,'Sathur','Active'),(251,29,'Sivakasi','Active'),(252,29,'Srivilliputhur','Active'),(253,29,'Tiruchuli','Active'),(254,29,'Vembakottai','Active'),(255,29,'Watrap','Active'),(256,30,'Ariyalur','Active'),(257,30,'Andimadam','Active'),(258,30,'Sendurai','Active'),(259,30,'Udaiyarpalayam','Active'),(260,31,'Krishnagiri','Active'),(261,31,'Anjetty','Active'),(262,31,'Bargur','Active'),(263,31,'Hosur','Active'),(264,31,'Pochampalli','Active'),(265,31,'Sulagiri','Active'),(266,31,'Thenkanikottai','Active'),(267,31,'Uthangarai','Active'),(268,32,'Avinashi','Active'),(269,32,'Dharapuram','Active'),(270,32,'Kangeyam','Active'),(271,32,'Madathukkulam','Active'),(272,32,'Oothukuli','Active'),(273,32,'Palladam','Active'),(274,32,'Tiruppur (North)','Active'),(275,32,'Tiruppur (South)','Active'),(276,32,'Udumalaipettai','Active'),(277,33,'Chengalpattu','Active'),(278,33,'Cheyyur','Active'),(279,33,'Maduranthakam','Active'),(280,33,'Pallavaram','Active'),(281,33,'Tambaram','Active'),(282,33,'Thirukalukundram','Active'),(283,33,'Tiruporur','Active'),(284,33,'Vandalur','Active'),(285,34,'Kallakurichi','Active'),(286,34,'Chinnaselam','Active'),(287,34,'Kalvarayan Hills','Active'),(288,34,'Sankarapuram','Active'),(289,34,'Tirukoilur','Active'),(290,34,'Ulundurpet','Active'),(291,35,'Arakkonam','Active'),(292,35,'Arcot','Active'),(293,35,'Kalavai','Active'),(294,35,'Nemili','Active'),(295,35,'Sholingur','Active'),(296,35,'Walajah','Active'),(297,36,'Tenkasi','Active'),(298,36,'Alangulam','Active'),(299,36,'Kadayanallur','Active'),(300,36,'Sankarankovil','Active'),(301,36,'Shenkottai','Active'),(302,36,'Sivagiri','Active'),(303,36,'Thiruvengadam','Active'),(304,36,'Veerakeralampudur','Active'),(305,37,'Tirupathur','Active'),(306,37,'Ambur','Active'),(307,37,'Natrampalli','Active'),(308,37,'Vaniyambadi','Active'),(309,38,'Mayiladuthurai','Active'),(310,38,'Kuthalam','Active'),(311,38,'Sirkali','Active'),(312,38,'Tharangambadi','Active'),(313,30,'Jayankondam','Active');
/*!40000 ALTER TABLE `taluk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tec_exam`
--

DROP TABLE IF EXISTS `tec_exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tec_exam` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `tec_number` varchar(50) DEFAULT NULL,
  `tec_password` varchar(20) DEFAULT NULL,
  `applicant_name` varchar(30) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `shop_name` varchar(50) DEFAULT NULL,
  `shop_address` varchar(200) DEFAULT NULL,
  `postal_name` varchar(30) DEFAULT NULL,
  `village_name` varchar(30) DEFAULT NULL,
  `street_name` varchar(30) DEFAULT NULL,
  `pincode` varchar(10) DEFAULT NULL,
  `pan_card` varchar(20) DEFAULT NULL,
  `tec_certificate` varchar(20) DEFAULT NULL,
  `bank_passbook` varchar(20) DEFAULT NULL,
  `voterid` varchar(20) DEFAULT NULL,
  `bc_agent_certificate` varchar(20) DEFAULT NULL,
  `csc_id_number` varchar(20) DEFAULT NULL,
  `csc_password` varchar(15) DEFAULT NULL,
  `e_aadhaar_pdf` varchar(20) DEFAULT NULL,
  `e_aadhaar_password` varchar(15) DEFAULT NULL,
  `door_no` varchar(15) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `district` varchar(15) DEFAULT NULL,
  `father_name` varchar(30) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `any_proof` varchar(100) DEFAULT NULL,
  `new_proof` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `any_document` varchar(100) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tec_exam`
--

LOCK TABLES `tec_exam` WRITE;
/*!40000 ALTER TABLE `tec_exam` DISABLE KEYS */;
INSERT INTO `tec_exam` VALUES (1,54,6,0,0,0,60.00,NULL,NULL,NULL,NULL,'2222','ddddd',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'67ab2dba47da8.jpg','67ab2dba4cbcd.jpg',NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-11',NULL,'2025-02-11');
/*!40000 ALTER TABLE `tec_exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tnega_services`
--

DROP TABLE IF EXISTS `tnega_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tnega_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` text DEFAULT '0',
  `aadhaar_no` text DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `panchayath_id` int(11) DEFAULT 0,
  `aadhaar_card` text DEFAULT NULL,
  `aadhaar_back` text DEFAULT NULL,
  `smart_card` text DEFAULT NULL,
  `signature` text DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `old_can_document` text DEFAULT NULL,
  `can_number` text DEFAULT NULL,
  `can_details` text DEFAULT NULL,
  `personalized` text DEFAULT NULL,
  `relationship_1` text DEFAULT NULL,
  `relationship_2` text DEFAULT NULL,
  `relationship_3` text DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `religion` text DEFAULT NULL,
  `education` text DEFAULT NULL,
  `work` text DEFAULT NULL,
  `door_no` text DEFAULT NULL,
  `personalized_name_tamil` text DEFAULT NULL,
  `relationship_name_tamil_1` text DEFAULT NULL,
  `mother_name_tamil` text DEFAULT NULL,
  `mother_name_english` text DEFAULT NULL,
  `relationship_name_tamil_2` text DEFAULT NULL,
  `relationship_name_tamil_3` text DEFAULT NULL,
  `community` text DEFAULT NULL,
  `smartcard_number` text DEFAULT NULL,
  `street_name_tamil` text DEFAULT NULL,
  `personalized_name_english` text DEFAULT NULL,
  `relationship_name_english_1` text DEFAULT NULL,
  `relationship_name_english_2` text DEFAULT NULL,
  `relationship_name_english_3` text DEFAULT NULL,
  `maritial_status` text DEFAULT NULL,
  `caste` text DEFAULT NULL,
  `street_name` text DEFAULT NULL,
  `pin_code` text DEFAULT NULL,
  `postal_area_tamil` text DEFAULT NULL,
  `postal_area_english` text DEFAULT NULL,
  `family_relationship` text DEFAULT NULL,
  `relation_name` text DEFAULT NULL,
  `relation_name_tamil` text DEFAULT NULL,
  `relation_age` text DEFAULT NULL,
  `village_administrative_area` text DEFAULT NULL,
  `village_administrative_area_tamil` text DEFAULT NULL,
  `job_type` text DEFAULT NULL,
  `salary_slip` text DEFAULT NULL,
  `pancard` text DEFAULT NULL,
  `income_yearly` text DEFAULT NULL,
  `income_monthly` text DEFAULT NULL,
  `relationship` text DEFAULT NULL,
  `affidavit` text DEFAULT NULL,
  `course_complete` text DEFAULT NULL,
  `year_of_passing` text DEFAULT NULL,
  `current_course` text DEFAULT NULL,
  `current_academy_yr` text DEFAULT NULL,
  `institute_name_tamil` text DEFAULT NULL,
  `institute_name_english` text DEFAULT NULL,
  `institute_address_tamil` text DEFAULT NULL,
  `institute_address_english` text DEFAULT NULL,
  `self_community_certificate` text DEFAULT NULL,
  `tc_community_certificate` text DEFAULT NULL,
  `income_certificate` text DEFAULT NULL,
  `community_certificate` text DEFAULT NULL,
  `birth_certificate` text DEFAULT NULL,
  `smartcard_online` text DEFAULT NULL,
  `age_proof` text DEFAULT NULL,
  `voterid` text DEFAULT NULL,
  `driving_license` text DEFAULT NULL,
  `marksheet` text DEFAULT NULL,
  `mrg_invitation` text DEFAULT NULL,
  `deed` text DEFAULT NULL,
  `bank_pass_book` text DEFAULT NULL,
  `personal_strap` text DEFAULT NULL,
  `joint_strap` text DEFAULT NULL,
  `deed_details` text DEFAULT NULL,
  `deed_yes` text DEFAULT NULL,
  `hus_wife_photo` text DEFAULT NULL,
  `permanent_social_certificate_groom` text DEFAULT NULL,
  `bride_permanent_social_certificate` text DEFAULT NULL,
  `mrg_registration_certificate` text DEFAULT NULL,
  `anyothers_certificate` text DEFAULT NULL,
  `chitta` text DEFAULT NULL,
  `aggregation` text DEFAULT NULL,
  `ec_certificate` text DEFAULT NULL,
  `villankam` text DEFAULT NULL,
  `vao_certificate` text DEFAULT NULL,
  `self_declaration_certificate` text DEFAULT NULL,
  `other_certificate` text DEFAULT NULL,
  `passport` text DEFAULT NULL,
  `placement_registration` text DEFAULT NULL,
  `school_transfer_certificate` text DEFAULT NULL,
  `study_proof` text DEFAULT NULL,
  `family_income_certificate` text DEFAULT NULL,
  `husband_death_certificate` text DEFAULT NULL,
  `legal_heir_certificate` text DEFAULT NULL,
  `widow_certificate` text DEFAULT NULL,
  `mrg_documents` text DEFAULT NULL,
  `mrg_docdetails` text DEFAULT NULL,
  `any_proof` text DEFAULT NULL,
  `smartcard_no` text DEFAULT NULL,
  `tailoring_certificate` text DEFAULT NULL,
  `family_plannnig_certificate` text DEFAULT NULL,
  `birth_certificate_children` text DEFAULT NULL,
  `id_proof` text DEFAULT NULL,
  `family_photo` text DEFAULT NULL,
  `handicapped_proof` text DEFAULT NULL,
  `udid_card` text DEFAULT NULL,
  `registered_deed` text DEFAULT NULL,
  `chitta_and_villangam` text DEFAULT NULL,
  `property_details` text DEFAULT NULL,
  `residential_certificate` text DEFAULT NULL,
  `damage_certificate` text DEFAULT NULL,
  `acknowledgement` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `application_no` text DEFAULT NULL,
  `application` text DEFAULT NULL,
  `lects` text DEFAULT NULL,
  `selects` text DEFAULT NULL,
  `certificate` text DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  `living_status_1` text DEFAULT NULL,
  `living_status_2` text DEFAULT NULL,
  `signature1` text DEFAULT NULL,
  `signature2` text DEFAULT NULL,
  `father_form` text DEFAULT NULL,
  `mother_form` text DEFAULT NULL,
  `area` text DEFAULT NULL,
  `strap` text DEFAULT NULL,
  `father_community` text DEFAULT NULL,
  `father_caste` text DEFAULT NULL,
  `mother_community` text DEFAULT NULL,
  `mother_caste` varchar(100) DEFAULT NULL,
  `address_proof` text DEFAULT NULL,
  `previous_licence` text DEFAULT NULL,
  `solvency_certificate` text DEFAULT NULL,
  `shop_address_proof` text DEFAULT NULL,
  `challan` text DEFAULT NULL,
  `form_A` text DEFAULT NULL,
  `building_licence_document` text DEFAULT NULL,
  `building_blue_print` text DEFAULT NULL,
  `lease_agreement` text DEFAULT NULL,
  `it_return_document` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tnega_services`
--

LOCK TABLES `tnega_services` WRITE;
/*!40000 ALTER TABLE `tnega_services` DISABLE KEYS */;
INSERT INTO `tnega_services` VALUES (1,11,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'36546384568446','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6892f9f2c9c86.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,11,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'9874561230','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6892fb7deb8e7.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Rejected','recorrect',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,3,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'No','செல்வன்','உறவினர்',NULL,NULL,NULL,'Religion','Private Employee',NULL,'58912','vani','Narayana selvan','Rajathi','Rajathi N',NULL,NULL,'OBC',NULL,'Aundivilai','Applicant Name','Name In English',NULL,NULL,'Married',NULL,'Street Name','629701','Agasteeswaram','Postal Area',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Mother','6892fd2d38294.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6892fd2d38be3.jpg','6892fd2d36944.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Approved','xxx','85769','ஸிவாணி பாய் சு',NULL,NULL,NULL,'http://127.0.0.1:9000/upload/services/apiprocessing/6893020586afc.jpg','http://127.0.0.1:9000/upload/services/apiapproved/68930230e5c47.jpg','2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'SC Arunthathiyar','Caste','DNC/DNT','Caste',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,23,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'4561230789','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'68930481a66dd.jpg','68930481a85aa.jpg',NULL,'','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Joint Strap',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,23,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'4561230789','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'689304da4618c.jpg','689304da48419.jpg',NULL,'','','','',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Joint Strap',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,129,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'582558956358','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893221462940.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending','vvv',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,177,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'9986993966939','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,177,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'9986993966939','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893462173a1f.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'68934621701f0.jpg','68934621720df.jpg','6893462172f3c.jpg',NULL,NULL,NULL,'Pending','உன்மை நகல்',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,26,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'789456123321456','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893483c8b0bd.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893483c8bb82.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893487379167.jpg','6893483c8a4c3.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Processing','சான்றிதழ்','ஆதாரம்',NULL,NULL,NULL,NULL,'http://127.0.0.1:9000/upload/services/apiprocessing/689348960927c.jpg',NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,178,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'321456987456','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,178,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'321456987456','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893494a0c195.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893494a09d3a.jpg',NULL,NULL,'Pending',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,178,10,5,0,0,60.00,'0',NULL,NULL,0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,'321456987456','Yes',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893495eb740a.jpg',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6893495eb5505.jpg','6893495eb8629.jpg',NULL,'Pending','ஜெராக்ஸ்',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-08-06',NULL,'2025-08-06',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `tnega_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_permission`
--

DROP TABLE IF EXISTS `user_permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_permission`
--

LOCK TABLES `user_permission` WRITE;
/*!40000 ALTER TABLE `user_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `useractivation`
--

DROP TABLE IF EXISTS `useractivation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `useractivation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `admin_amount` decimal(10,2) DEFAULT 0.00,
  `superadmin_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `useractivation`
--

LOCK TABLES `useractivation` WRITE;
/*!40000 ALTER TABLE `useractivation` DISABLE KEYS */;
/*!40000 ALTER TABLE `useractivation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) NOT NULL,
  `user_type_id` varchar(10) DEFAULT NULL,
  `nalavariyam_usertype` int(11) DEFAULT NULL,
  `refferal_id` varchar(10) DEFAULT NULL,
  `verified` int(11) DEFAULT NULL,
  `dist_id` int(11) DEFAULT NULL,
  `taluk_id` int(11) DEFAULT NULL,
  `panchayath_id` int(11) DEFAULT NULL,
  `panchayath_name` varchar(50) DEFAULT NULL,
  `nalavariyam_dist_id` int(11) DEFAULT NULL,
  `nalavariyam_taluk_id` int(11) DEFAULT NULL,
  `smartcard` varchar(20) DEFAULT NULL,
  `smartcard_no` varchar(15) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `can_number` varchar(20) DEFAULT NULL,
  `can_details` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `aadhaar_file` varchar(10) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `pan_file` varchar(10) DEFAULT NULL,
  `date_of_birth` varchar(10) DEFAULT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `cpassword` varchar(10) DEFAULT NULL,
  `profile` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `wallet` decimal(10,2) DEFAULT 0.00,
  `nalavariyamwallet` decimal(10,2) DEFAULT 0.00,
  `rawallet` decimal(10,2) DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `server_amount` decimal(10,2) DEFAULT 0.00,
  `payment_status` int(11) DEFAULT 0,
  `is_completed` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'superadmin','1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'superadmin@gmail.com',NULL,'$2a$12$MPUnu9JtOW2CcilCa32Ob.Yeg/LUdPplxNz.Calrw8NkIh0UUI/am','123','3.jpg',NULL,5000.00,350.00,10750.00,NULL,'2024-10-03 01:17:28','2024-10-03 01:17:28',NULL,0.00,0,NULL),(2,'admin','2',3,NULL,1,NULL,NULL,NULL,NULL,2,4,NULL,NULL,NULL,NULL,NULL,'Male','9943843246','Elanthavilai Pallam Post','12345678',NULL,NULL,NULL,'2024-10-15','admin@gmail.com',NULL,'$2y$10$kT3rwVwrgBzIJouUPjY3DOMJb18jHJU.6lvVT8co5ZL0noyWTCdVO','123','7.jpg','Active',7430.00,250.00,9250.00,NULL,NULL,NULL,'2026-12-29',100.00,0,NULL),(3,'distributer','3',3,NULL,1,NULL,NULL,NULL,NULL,2,4,NULL,NULL,NULL,NULL,NULL,'Male','9943843244','kanniyakumari','343423435555',NULL,NULL,NULL,'2024-10-23','distributer@gmail.com',NULL,'$2y$10$3Ap8BAzCY3WiWmfWHYNonu6SGVpUI7Fp/.vPjXXUQDd3be/ozyvNq','123','3.jpg','Active',3300.00,-300.00,0.00,NULL,NULL,'2025-11-10 01:03:25',NULL,0.00,0,NULL),(5,'retailer','4',4,'2',1,NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL,NULL,NULL,'Male','2222222222','wwwwwwwwwwwww','222222222222',NULL,NULL,NULL,NULL,'retailer@gmail.com',NULL,'$2y$10$UUu.IFS6BsExm.Wg34gGlOYTVzsP5ZiHTbZc1Oc82jtBI8CDvU3TO','123','3.jpg','Active',4570.00,0.00,1000.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(6,'customer','5',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'customer@gmail.com',NULL,'$2y$10$3Ap8BAzCY3WiWmfWHYNonu6SGVpUI7Fp/.vPjXXUQDd3be/ozyvNq','123','3.jpg','Active',60.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(8,'solan','3',NULL,'7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Male','9943843242','Elanthavilai Pallam Post ssss','12345678',NULL,NULL,NULL,NULL,'solan@gmail.com',NULL,'$2y$10$zSZTKc/IWEj03Eo6NsW2O.x81cfMJ42e6/.fMNrXGp0VLa8.S/Ptm','123','8.jpg','Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(9,'test another','4',NULL,'3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Male','9943843246','weee','34342343',NULL,NULL,NULL,NULL,'test@gmail.com',NULL,'$2y$10$8P6d/MZjcQAhshe3qd0wGu3JMaRwVZzbiBeJs7onb2kZ8OHxh7UdW','123','9.jpg','Active',4700.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(10,'saravanan','5',NULL,'5',NULL,13,106,5345,NULL,NULL,NULL,'10.jpg',NULL,'10.jpg',NULL,NULL,NULL,'9943843241','qqq','111111111123','10.jpg',NULL,NULL,'2024-11-12','saro@gmail.com',NULL,'$2y$10$2MC.dSbCrmgkgdXXnIEbVeCBqY3WZU788WGaVlRRgM4VZxsUCr6Nm','123','10.jpg','Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(11,'Saravanan p','5',NULL,'3',NULL,1,1,12,NULL,NULL,NULL,'11.jpg',NULL,'11.jpg',NULL,'Yes','Male','9943843243','Elanthavilai Pallam Post','343423422222','11.jpg',NULL,NULL,'2024-11-12','customer1@gmail.com',NULL,'$2y$10$9T9LL5vKOJMwfYsfyvbzYOrW.D72cjvaZFuF8Ny1GOFnFkWgzJdyO',NULL,'11.jpg','Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(12,'sanjay','5',NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'6622222222',NULL,NULL,'12.jpg',NULL,NULL,NULL,'sanjay@gmail.com',NULL,'$2y$10$WiO53Py61TewkjsgXfFoUe.zrq0lCtF3/NYaABAb4z.syKYQ3h34a','123',NULL,NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(13,'test','5',NULL,'7',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'3533333333',NULL,NULL,NULL,NULL,NULL,NULL,'testing@gmail.com',NULL,'$2y$10$k0TRaLvM0sLYEER2CcthDON12c7ViO7ZFCRLLg2NfDrSmX7FNJM0q','123','',NULL,0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(14,'santhosh','5',NULL,'9',NULL,11,88,4609,NULL,NULL,NULL,'14.jpg','yui2222222','14.jpg',NULL,NULL,'Male','9943843256','Elanthavilai Pallam Post','937899999999','14.jpg',NULL,NULL,'2024-11-14','santhosh@gmail.com',NULL,'$2y$10$SldRNEFXTVy/mxiC/qS2oeMECvf7D9Aup794YkVEXgWbV.jcrMMGy','123','14.jpg','Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(15,'testsvn','3',NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9943843200',NULL,'000000022222','15.jpg','wj2kkkk222','15.jpg',NULL,'testsvn@gmail.com',NULL,'$2y$10$Z8hXQJw8dNU4b0moFLF4G.hzZzvWpU6oHZd9fPelMR2lrv1K4JlxG','123',NULL,'Inactive',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(16,'testing','3',NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'9765567898',NULL,'457654345654','',NULL,'',NULL,'testi@gmail.com',NULL,'$2y$10$FuC0/ilgK7MOUXstTJtFvuyO8TYOihd9PDBSnYACzwc4kAla1sd/.','123',NULL,'Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(17,'sdfghjk','3',NULL,'2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'24432123',NULL,'23432233','',NULL,'',NULL,'an@gmail.com',NULL,'$2y$10$zuh.PTP0FascDXjXvHqwN.T8fMADHT0KMp5sX6y1VvSAwPmblrOLG','123',NULL,'Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL),(18,'kaviya','3',NULL,'2',NULL,13,108,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2412332123',NULL,'124321233211',NULL,NULL,NULL,NULL,'kaviya@gmail.com',NULL,'$2y$10$P2m4ix.C.agCVq2hk2PreOxc/F14HRcvgIljmps4wWCU/cp4n7eDa','123',NULL,'Active',0.00,0.00,0.00,NULL,NULL,NULL,NULL,0.00,0,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utility_services`
--

DROP TABLE IF EXISTS `utility_services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utility_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utility_services`
--

LOCK TABLES `utility_services` WRITE;
/*!40000 ALTER TABLE `utility_services` DISABLE KEYS */;
INSERT INTO `utility_services` VALUES (1,'Mobile Recharge','1.jpg','Active','2024-12-20 10:21:50'),(2,'DTH Recharge','2.png','Active','2024-12-20 10:20:22');
/*!40000 ALTER TABLE `utility_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utislpan`
--

DROP TABLE IF EXISTS `utislpan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utislpan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pan_no` varchar(10) DEFAULT NULL,
  `date_of_birth` varchar(100) DEFAULT NULL,
  `father_name` varchar(20) DEFAULT NULL,
  `mode` varchar(20) DEFAULT NULL,
  `aadhaar_pdf` varchar(20) DEFAULT NULL,
  `pan_file` varchar(20) DEFAULT NULL,
  `signature` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utislpan`
--

LOCK TABLES `utislpan` WRITE;
/*!40000 ALTER TABLE `utislpan` DISABLE KEYS */;
/*!40000 ALTER TABLE `utislpan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utislpanpayment`
--

DROP TABLE IF EXISTS `utislpanpayment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utislpanpayment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `distributor_amount` decimal(10,2) DEFAULT 0.00,
  `retailer_amount` decimal(10,2) DEFAULT 0.00,
  `customer_amount` decimal(10,2) DEFAULT 0.00,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utislpanpayment`
--

LOCK TABLES `utislpanpayment` WRITE;
/*!40000 ALTER TABLE `utislpanpayment` DISABLE KEYS */;
/*!40000 ALTER TABLE `utislpanpayment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utislpanservice`
--

DROP TABLE IF EXISTS `utislpanservice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utislpanservice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(200) DEFAULT NULL,
  `ser_image` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utislpanservice`
--

LOCK TABLES `utislpanservice` WRITE;
/*!40000 ALTER TABLE `utislpanservice` DISABLE KEYS */;
/*!40000 ALTER TABLE `utislpanservice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voter_find`
--

DROP TABLE IF EXISTS `voter_find`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voter_find` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT 0,
  `service_id` int(11) DEFAULT 0,
  `epic_no` varchar(20) DEFAULT NULL,
  `scode` varchar(20) DEFAULT NULL,
  `amount` varchar(20) DEFAULT NULL,
  `pdf` longtext DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `new_mobile` varchar(10) DEFAULT NULL,
  `state_name` varchar(50) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voter_find`
--

LOCK TABLES `voter_find` WRITE;
/*!40000 ALTER TABLE `voter_find` DISABLE KEYS */;
/*!40000 ALTER TABLE `voter_find` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voterid`
--

DROP TABLE IF EXISTS `voterid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voterid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `name` varchar(50) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `aadhaar_card` varchar(20) DEFAULT NULL,
  `voter_id` varchar(20) DEFAULT NULL,
  `photo` varchar(20) DEFAULT NULL,
  `relationship` varchar(20) DEFAULT NULL,
  `epic_no` varchar(10) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `application_no` varchar(50) DEFAULT NULL,
  `selects` varchar(20) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voterid`
--

LOCK TABLES `voterid` WRITE;
/*!40000 ALTER TABLE `voterid` DISABLE KEYS */;
INSERT INTO `voterid` VALUES (1,113,1,5,0,0,60.00,'Saravanan','9927738838','675bc07cc89ac.jpg','675bc07da6f16.jpg','675bc07d9ab4a.jpg','Father',NULL,'675bc0a4a90e3.jpg','Approved',NULL,'1',NULL,'675bc0de70f00.jpg',NULL,NULL,'2024-12-13','2024-12-13','2024-12-13');
/*!40000 ALTER TABLE `voterid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voterid_details`
--

DROP TABLE IF EXISTS `voterid_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voterid_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `wrong_data` varchar(100) DEFAULT NULL,
  `new_data` varchar(100) DEFAULT NULL,
  `correction_documents` varchar(50) DEFAULT NULL,
  `voterid_correction` varchar(20) DEFAULT NULL,
  `doc` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voterid_details`
--

LOCK TABLES `voterid_details` WRITE;
/*!40000 ALTER TABLE `voterid_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `voterid_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `voteridpdf_download`
--

DROP TABLE IF EXISTS `voteridpdf_download`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voteridpdf_download` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `retailer_id` int(11) DEFAULT 0,
  `distributor_id` int(11) DEFAULT 0,
  `admin_id` int(11) DEFAULT 0,
  `amount` decimal(10,2) DEFAULT 0.00,
  `dist_id` int(11) DEFAULT 0,
  `taluk_id` int(11) DEFAULT 0,
  `name` text DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `epic_no` varchar(20) DEFAULT NULL,
  `acknowledgement` varchar(20) DEFAULT NULL,
  `application_no` varchar(100) DEFAULT NULL,
  `application` varchar(100) DEFAULT NULL,
  `lects` varchar(50) DEFAULT NULL,
  `selects` varchar(50) DEFAULT NULL,
  `certificate` varchar(20) DEFAULT NULL,
  `api_processing` text DEFAULT NULL,
  `api_approved` text DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `remarks` varchar(100) DEFAULT NULL,
  `applied_date` varchar(10) DEFAULT NULL,
  `completed_date` varchar(10) DEFAULT NULL,
  `created_at` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voteridpdf_download`
--

LOCK TABLES `voteridpdf_download` WRITE;
/*!40000 ALTER TABLE `voteridpdf_download` DISABLE KEYS */;
/*!40000 ALTER TABLE `voteridpdf_download` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_topup`
--

DROP TABLE IF EXISTS `wallet_topup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wallet_topup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `website_index` varchar(50) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT 0.00,
  `date` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_topup`
--

LOCK TABLES `wallet_topup` WRITE;
/*!40000 ALTER TABLE `wallet_topup` DISABLE KEYS */;
/*!40000 ALTER TABLE `wallet_topup` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-01-23 17:41:29
