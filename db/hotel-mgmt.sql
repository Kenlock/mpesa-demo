-- MySQL dump 10.13  Distrib 5.7.23, for Linux (x86_64)
--
-- Host: localhost    Database: hotels
-- ------------------------------------------------------
-- Server version	5.7.23-0ubuntu0.18.04.1

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
-- Table structure for table `hotel_booking`
--

DROP TABLE IF EXISTS `hotel_booking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) NOT NULL,
  `total_rooms` tinyint(4) DEFAULT NULL,
  `total_guests` tinyint(4) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `leave_date` datetime DEFAULT NULL,
  `total_rent` decimal(10,0) DEFAULT NULL,
  `paid` enum('Yes','No') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  CONSTRAINT `hotel_booking_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_booking`
--

LOCK TABLES `hotel_booking` WRITE;
/*!40000 ALTER TABLE `hotel_booking` DISABLE KEYS */;
INSERT INTO `hotel_booking` VALUES (3,2,2,6,'2018-08-08 00:00:00','2018-08-10 00:00:00',NULL,NULL,'No','2018-08-30 17:12:19','2018-08-30 17:12:19',1),(4,2,1,1,'2018-09-05 00:00:00','2018-09-06 00:00:00',NULL,NULL,'No','2018-09-04 11:46:06','2018-09-04 11:46:06',1);
/*!40000 ALTER TABLE `hotel_booking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_guest_members`
--

DROP TABLE IF EXISTS `hotel_guest_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_guest_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guest_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `age` smallint(6) NOT NULL,
  `age_type` enum('Adult','Child') NOT NULL,
  `gender` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `hotel_guest_members_ibfk_1` FOREIGN KEY (`guest_id`) REFERENCES `hotel_guests` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_guest_members`
--

LOCK TABLES `hotel_guest_members` WRITE;
/*!40000 ALTER TABLE `hotel_guest_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `hotel_guest_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_guests`
--

DROP TABLE IF EXISTS `hotel_guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_guests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `pincode` varchar(100) NOT NULL,
  `IDNumberType1` varchar(50) DEFAULT NULL,
  `IDNumber1` varchar(50) DEFAULT NULL,
  `IDNumberType2` varchar(50) DEFAULT NULL,
  `IDNumber2` varchar(50) DEFAULT NULL,
  `AddrNumberType1` varchar(50) DEFAULT NULL,
  `AddrNumber1` varchar(50) DEFAULT NULL,
  `AddrNumberType2` varchar(50) DEFAULT NULL,
  `AddrNumber2` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `hotel_guests_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  CONSTRAINT `hotel_guests_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `hotel_booking` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_guests`
--

LOCK TABLES `hotel_guests` WRITE;
/*!40000 ALTER TABLE `hotel_guests` DISABLE KEYS */;
INSERT INTO `hotel_guests` VALUES (3,3,2,'kkk','k','aaa','cc','st','111211','pan','awa',NULL,NULL,'addr','3214',NULL,NULL,'2018-08-30 17:12:20','2018-08-30 17:12:20',1),(4,4,2,'ABC','ZYZ','DDDD','ctt','stt','1212','PAN','99999',NULL,NULL,'ADDA','ooooo',NULL,NULL,'2018-09-04 11:46:06','2018-09-04 11:46:06',1);
/*!40000 ALTER TABLE `hotel_guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_menu_item_type`
--

DROP TABLE IF EXISTS `hotel_menu_item_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_menu_item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_menu_item_type`
--

LOCK TABLES `hotel_menu_item_type` WRITE;
/*!40000 ALTER TABLE `hotel_menu_item_type` DISABLE KEYS */;
INSERT INTO `hotel_menu_item_type` VALUES (1,'Breakfast','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(2,'Lunch','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(3,'Snacks','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(4,'Dinner','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(5,'Dessert','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(6,'North Indian','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(7,'South Indian','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(8,'Gujrati','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(9,'Maharstrian','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(10,'Chinese','2018-08-22 19:36:33','2018-08-22 19:36:33',1),(11,'Continental','2018-08-22 19:36:34','2018-08-22 19:36:34',1);
/*!40000 ALTER TABLE `hotel_menu_item_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_menu_items`
--

DROP TABLE IF EXISTS `hotel_menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `item_type` varchar(100) NOT NULL,
  `item_price` decimal(10,0) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  CONSTRAINT `hotel_menu_items_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_menu_items`
--

LOCK TABLES `hotel_menu_items` WRITE;
/*!40000 ALTER TABLE `hotel_menu_items` DISABLE KEYS */;
INSERT INTO `hotel_menu_items` VALUES (1,'Bread Omlette','11',50,NULL,'2018-08-22 14:12:45','2018-08-22 14:12:45',1,2),(2,'Chole Bhature','6',130,NULL,'2018-08-22 14:13:24','2018-08-22 14:46:35',1,2),(3,'Bread Butter','11',30,NULL,'2018-08-22 14:14:00','2018-08-22 14:14:00',1,2),(4,'Masala Dosa','7',80,NULL,'2018-08-22 14:14:34','2018-08-22 14:14:34',1,2);
/*!40000 ALTER TABLE `hotel_menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_menu_order_items`
--

DROP TABLE IF EXISTS `hotel_menu_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_menu_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_order_id` int(11) NOT NULL,
  `menu_item_id` int(11) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `qty` smallint(6) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_order_id` (`menu_order_id`),
  KEY `menu_item_id` (`menu_item_id`),
  CONSTRAINT `hotel_menu_order_items_ibfk_1` FOREIGN KEY (`menu_order_id`) REFERENCES `hotel_menu_orders` (`id`),
  CONSTRAINT `hotel_menu_order_items_ibfk_2` FOREIGN KEY (`menu_item_id`) REFERENCES `hotel_menu_items` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_menu_order_items`
--

LOCK TABLES `hotel_menu_order_items` WRITE;
/*!40000 ALTER TABLE `hotel_menu_order_items` DISABLE KEYS */;
INSERT INTO `hotel_menu_order_items` VALUES (9,8,1,50,1,'2018-09-04 17:51:29','2018-09-04 17:51:29',1),(10,8,2,130,0,'2018-09-04 17:51:29','2018-09-04 17:51:29',1),(11,8,3,30,1,'2018-09-04 17:51:29','2018-09-04 17:51:29',1),(12,8,4,80,2,'2018-09-04 17:51:29','2018-09-04 17:51:29',1),(13,9,1,50,1,'2018-09-04 17:51:40','2018-09-04 17:51:40',1),(14,9,2,130,2,'2018-09-04 17:51:40','2018-09-04 17:51:40',1),(15,9,3,30,0,'2018-09-04 17:51:40','2018-09-04 17:51:40',1),(16,9,4,80,0,'2018-09-04 17:51:40','2018-09-04 17:51:40',1),(17,10,3,30,1,'2018-09-04 17:52:55','2018-09-04 17:52:55',1),(18,10,4,80,2,'2018-09-04 17:52:55','2018-09-04 17:52:55',1);
/*!40000 ALTER TABLE `hotel_menu_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_menu_orders`
--

DROP TABLE IF EXISTS `hotel_menu_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_menu_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT NULL,
  `order_fullfilled` enum('YES','No') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `room_id` (`room_id`),
  KEY `guest_id` (`guest_id`),
  CONSTRAINT `hotel_menu_orders_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  CONSTRAINT `hotel_menu_orders_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `hotel_rooms` (`id`),
  CONSTRAINT `hotel_menu_orders_ibfk_3` FOREIGN KEY (`guest_id`) REFERENCES `hotel_guests` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_menu_orders`
--

LOCK TABLES `hotel_menu_orders` WRITE;
/*!40000 ALTER TABLE `hotel_menu_orders` DISABLE KEYS */;
INSERT INTO `hotel_menu_orders` VALUES (8,2,3,1,'2018-09-04 17:51:29',240,'YES','2018-09-04 17:51:29','2018-09-04 17:51:29',1),(9,2,3,1,'2018-09-04 17:51:39',310,'YES','2018-09-04 17:51:39','2018-09-04 17:51:40',1),(10,2,3,1,'2018-09-04 17:52:54',190,'YES','2018-09-04 17:52:55','2018-09-04 17:52:55',1);
/*!40000 ALTER TABLE `hotel_menu_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_room_occupations`
--

DROP TABLE IF EXISTS `hotel_room_occupations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_room_occupations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `booking_id` int(11) DEFAULT NULL,
  `room_id` int(11) NOT NULL,
  `guest_id` int(11) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `leave_date` datetime DEFAULT NULL,
  `total_rent` decimal(10,0) DEFAULT NULL,
  `paid` enum('Yes','No') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `guest_id` (`guest_id`),
  KEY `room_id` (`room_id`),
  KEY `booking_id` (`booking_id`),
  CONSTRAINT `hotel_room_occupations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `hotel_rooms` (`id`),
  CONSTRAINT `hotel_room_occupations_ibfk_2` FOREIGN KEY (`guest_id`) REFERENCES `hotel_guests` (`id`),
  CONSTRAINT `hotel_room_occupations_ibfk_3` FOREIGN KEY (`booking_id`) REFERENCES `hotel_booking` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_room_occupations`
--

LOCK TABLES `hotel_room_occupations` WRITE;
/*!40000 ALTER TABLE `hotel_room_occupations` DISABLE KEYS */;
INSERT INTO `hotel_room_occupations` VALUES (3,3,1,3,'2018-08-08 00:00:00','2018-08-10 00:00:00',NULL,NULL,'No','2018-08-30 17:12:20','2018-08-30 17:12:20',1),(4,3,3,3,'2018-08-08 00:00:00','2018-08-10 00:00:00',NULL,NULL,'No','2018-08-30 17:12:20','2018-08-30 17:12:20',1),(5,4,2,4,'2018-09-05 00:00:00','2018-09-06 00:00:00',NULL,NULL,'No','2018-09-04 11:46:06','2018-09-04 11:46:06',1);
/*!40000 ALTER TABLE `hotel_room_occupations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_rooms`
--

DROP TABLE IF EXISTS `hotel_rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `room_no` varchar(10) NOT NULL,
  `room_type_id` int(11) NOT NULL,
  `occupied` enum('Yes','No') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  KEY `room_type_id` (`room_type_id`),
  CONSTRAINT `hotel_rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`),
  CONSTRAINT `hotel_rooms_ibfk_2` FOREIGN KEY (`room_type_id`) REFERENCES `hotel_roomtypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_rooms`
--

LOCK TABLES `hotel_rooms` WRITE;
/*!40000 ALTER TABLE `hotel_rooms` DISABLE KEYS */;
INSERT INTO `hotel_rooms` VALUES (1,2,3,'101',1,'Yes','2018-08-22 11:39:19','2018-08-30 17:12:20',1),(2,2,4,'102',1,'Yes','2018-08-22 11:39:29','2018-09-04 11:46:06',1),(3,2,3,'103',2,'Yes','2018-08-22 11:39:43','2018-08-30 17:12:20',1),(4,2,NULL,'104',2,'No','2018-08-22 11:39:56','2018-08-22 11:39:56',1),(5,2,NULL,'105',3,'No','2018-08-22 11:50:14','2018-08-22 11:50:14',1),(6,2,NULL,'106',1,'No','2018-09-04 12:22:45','2018-09-04 12:22:45',1),(7,2,NULL,'107',2,'No','2018-09-04 12:22:53','2018-09-04 12:22:53',1),(8,2,NULL,'109',3,'No','2018-09-04 12:23:02','2018-09-04 12:23:02',1),(9,2,NULL,'110',4,'No','2018-09-04 12:23:10','2018-09-04 12:23:10',1);
/*!40000 ALTER TABLE `hotel_rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_roomtypes`
--

DROP TABLE IF EXISTS `hotel_roomtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_roomtypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hotel_id` int(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hotel_id` (`hotel_id`),
  CONSTRAINT `hotel_roomtypes_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_roomtypes`
--

LOCK TABLES `hotel_roomtypes` WRITE;
/*!40000 ALTER TABLE `hotel_roomtypes` DISABLE KEYS */;
INSERT INTO `hotel_roomtypes` VALUES (1,2,'Single Bed Room',1400,'2018-08-22 08:36:28','2018-08-22 08:39:44',1),(2,2,'Double Bed Room',2900,'2018-08-22 08:37:23','2018-08-22 08:39:52',1),(3,2,'Twin Basis',2500,'2018-08-22 08:37:44','2018-08-22 08:37:44',1),(4,2,'Deluxe Room',3500,'2018-08-22 08:52:00','2018-08-22 08:52:00',1);
/*!40000 ALTER TABLE `hotel_roomtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotel_roomtypes_facilities`
--

DROP TABLE IF EXISTS `hotel_roomtypes_facilities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel_roomtypes_facilities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `room_type_id` int(11) DEFAULT NULL,
  `facility` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `room_type_id` (`room_type_id`),
  CONSTRAINT `hotel_roomtypes_facilities_ibfk_1` FOREIGN KEY (`room_type_id`) REFERENCES `hotel_roomtypes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel_roomtypes_facilities`
--

LOCK TABLES `hotel_roomtypes_facilities` WRITE;
/*!40000 ALTER TABLE `hotel_roomtypes_facilities` DISABLE KEYS */;
INSERT INTO `hotel_roomtypes_facilities` VALUES (5,4,'Double King Size Bed','2018-08-22 10:34:41','2018-08-22 10:34:41',NULL),(6,4,'LED TV','2018-08-22 10:34:41','2018-08-22 10:34:41',NULL),(7,4,'Cold and Hot Bath available','2018-08-22 10:34:41','2018-08-22 10:34:41',NULL),(8,4,'City View','2018-08-22 10:34:41','2018-08-22 10:34:41',NULL),(9,4,'Include Buffet','2018-08-22 10:34:41','2018-08-22 10:34:41',NULL);
/*!40000 ALTER TABLE `hotel_roomtypes_facilities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(150) NOT NULL,
  `state` varchar(150) NOT NULL,
  `pincode` varchar(20) NOT NULL,
  `contact_name` varchar(150) NOT NULL,
  `contact_phone1` varchar(20) NOT NULL,
  `contact_phone2` varchar(20) DEFAULT NULL,
  `contact_phone3` varchar(20) DEFAULT NULL,
  `contact_phone4` varchar(20) DEFAULT NULL,
  `contact_phone5` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'dsdsddadd','dffdsfsfds','xcxc','xcxzcxzc','czxcxz','xcxcxzcx','czxczc','xczxcxz','czxcz',NULL,NULL,NULL,'2018-08-21 18:35:11',NULL,0,'2018-08-22 07:33:24'),(2,'radblue','Radisson Blue','Industrial Area','Haridwar','Uttarakhand','249412','Mr. Vinay Sehgal','01334-223345','09887112112',NULL,NULL,NULL,'2018-08-22 07:26:24',NULL,1,'2018-08-22 07:26:24'),(3,'lakshaya','Hotel Lakshya','Kankhal, near by Gurukul Kangri Universiity','Haridwar','Uttarakhand','249408','Mr. Suresh Tyagi','01334-220099','08899776655',NULL,NULL,NULL,'2018-08-22 07:36:23',NULL,1,'2018-08-22 07:36:23');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '_self',
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `menu_items_menu_id_foreign` (`menu_id`),
  CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,1,'Dashboard','','_self','voyager-boat',NULL,NULL,1,'2018-08-21 06:32:04','2018-08-21 06:32:04','voyager.dashboard',NULL),(2,1,'Media','','_self','voyager-images',NULL,NULL,5,'2018-08-21 06:32:04','2018-08-21 06:32:04','voyager.media.index',NULL),(3,1,'Users','','_self','voyager-person',NULL,NULL,3,'2018-08-21 06:32:04','2018-08-21 06:32:04','voyager.users.index',NULL),(4,1,'Roles','','_self','voyager-lock',NULL,NULL,2,'2018-08-21 06:32:04','2018-08-21 06:32:04','voyager.roles.index',NULL),(5,1,'Tools','','_self','voyager-tools',NULL,NULL,9,'2018-08-21 06:32:04','2018-08-21 06:32:04',NULL,NULL),(6,1,'Menu Builder','','_self','voyager-list',NULL,5,10,'2018-08-21 06:32:04','2018-08-21 06:32:04','voyager.menus.index',NULL),(7,1,'Database','','_self','voyager-data',NULL,5,11,'2018-08-21 06:32:05','2018-08-21 06:32:05','voyager.database.index',NULL),(8,1,'Compass','','_self','voyager-compass',NULL,5,12,'2018-08-21 06:32:05','2018-08-21 06:32:05','voyager.compass.index',NULL),(9,1,'BREAD','','_self','voyager-bread',NULL,5,13,'2018-08-21 06:32:05','2018-08-21 06:32:05','voyager.bread.index',NULL),(10,1,'Settings','','_self','voyager-settings',NULL,NULL,14,'2018-08-21 06:32:05','2018-08-21 06:32:05','voyager.settings.index',NULL),(11,1,'Categories','','_self','voyager-categories',NULL,NULL,8,'2018-08-21 06:32:18','2018-08-21 06:32:18','voyager.categories.index',NULL),(12,1,'Posts','','_self','voyager-news',NULL,NULL,6,'2018-08-21 06:32:20','2018-08-21 06:32:20','voyager.posts.index',NULL),(13,1,'Pages','','_self','voyager-file-text',NULL,NULL,7,'2018-08-21 06:32:21','2018-08-21 06:32:21','voyager.pages.index',NULL),(14,1,'Hooks','','_self','voyager-hook',NULL,5,13,'2018-08-21 06:32:25','2018-08-21 06:32:25','voyager.hooks',NULL),(15,1,'Hotels','','_self',NULL,NULL,NULL,15,'2018-08-21 07:16:48','2018-08-21 07:16:48','voyager.hotels.index',NULL);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'admin','2018-08-21 06:32:04','2018-08-21 06:32:04');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-09-22 13:58:01
