-- MySQL dump 10.13  Distrib 8.0.16, for Linux (x86_64)
--
-- Host: localhost    Database: iuc
-- ------------------------------------------------------
-- Server version	8.0.16

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8mb4 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `countryId` int(10) unsigned NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_city_country` (`countryId`),
  CONSTRAINT `fk_city_country` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `city`
--

LOCK TABLES `city` WRITE;
/*!40000 ALTER TABLE `city` DISABLE KEYS */;
/*!40000 ALTER TABLE `city` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `continent`
--

DROP TABLE IF EXISTS `continent`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `continent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `continent`
--

LOCK TABLES `continent` WRITE;
/*!40000 ALTER TABLE `continent` DISABLE KEYS */;
/*!40000 ALTER TABLE `continent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `country` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `continentId` int(10) unsigned NOT NULL,
  `regionId` int(10) unsigned NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_country_continent` (`continentId`),
  KEY `fk_country_region` (`regionId`),
  CONSTRAINT `fk_country_continent` FOREIGN KEY (`continentId`) REFERENCES `continent` (`id`),
  CONSTRAINT `fk_country_region` FOREIGN KEY (`regionId`) REFERENCES `region` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `currency`
--

DROP TABLE IF EXISTS `currency`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `currency` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(3) NOT NULL,
  `rate` decimal(10,5) DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `currency`
--

LOCK TABLES `currency` WRITE;
/*!40000 ALTER TABLE `currency` DISABLE KEYS */;
/*!40000 ALTER TABLE `currency` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(9) NOT NULL,
  `active` char(1) DEFAULT 'N',
  `year_start` int(4) NOT NULL DEFAULT '2001',
  `year_end` int(4) NOT NULL DEFAULT '2001',
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cycle`
--

LOCK TABLES `cycle` WRITE;
/*!40000 ALTER TABLE `cycle` DISABLE KEYS */;
/*!40000 ALTER TABLE `cycle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_tags`
--

DROP TABLE IF EXISTS `event_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `event_tags` (
  `eventId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  KEY `fk_event_tags_event` (`eventId`),
  KEY `fk_event_tags_tag` (`tagId`),
  CONSTRAINT `fk_event_tags_event` FOREIGN KEY (`eventId`) REFERENCES `eventt` (`id`),
  CONSTRAINT `fk_event_tags_tag` FOREIGN KEY (`tagId`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_tags`
--

LOCK TABLES `event_tags` WRITE;
/*!40000 ALTER TABLE `event_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventt`
--

DROP TABLE IF EXISTS `eventt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `eventt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeId` int(2) NOT NULL,
  `fieldId` int(4) NOT NULL,
  `galleryId` int(11) DEFAULT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  `cycleId` int(11) NOT NULL,
  `eventnum` varchar(4) NOT NULL DEFAULT '',
  `title` text NOT NULL,
  `description` text NOT NULL,
  `notice` text,
  `start_date` date NOT NULL DEFAULT '0000-00-00',
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `mystatus` text NOT NULL,
  `subtitle` text,
  `lang_en` int(1) NOT NULL DEFAULT '0',
  `lang_de` int(1) NOT NULL DEFAULT '0',
  `lang_fr` int(1) NOT NULL DEFAULT '0',
  `workschedule` text,
  `second_cycleId` mediumint(8) DEFAULT NULL,
  `gcf` decimal(10,2) NOT NULL,
  `paidAmount` decimal(10,2) NOT NULL,
  `paidCurrencyId` int(2) unsigned NOT NULL,
  `isWaiver` enum('Y','N') NOT NULL DEFAULT 'N',
  `participationFee` decimal(10,2) NOT NULL,
  `numUnregParticipants` int(11) NOT NULL,
  `confirmed` int(1) unsigned DEFAULT '0',
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_event_cycle` (`cycleId`),
  KEY `fk_event_paidCurrency` (`paidCurrencyId`),
  KEY `fk_event_type` (`typeId`),
  KEY `fk_event_field` (`fieldId`),
  KEY `fk_event_gallery` (`galleryId`),
  KEY `fk_event_mainImg` (`mainImgId`),
  CONSTRAINT `fk_event_cycle` FOREIGN KEY (`cycleId`) REFERENCES `cycle` (`id`),
  CONSTRAINT `fk_event_field` FOREIGN KEY (`fieldId`) REFERENCES `fieldd` (`id`),
  CONSTRAINT `fk_event_gallery` FOREIGN KEY (`galleryId`) REFERENCES `gallery` (`id`),
  CONSTRAINT `fk_event_mainImg` FOREIGN KEY (`mainImgId`) REFERENCES `img` (`id`),
  CONSTRAINT `fk_event_paidCurrency` FOREIGN KEY (`paidCurrencyId`) REFERENCES `currency` (`id`),
  CONSTRAINT `fk_event_type` FOREIGN KEY (`typeId`) REFERENCES `eventtype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventt`
--

LOCK TABLES `eventt` WRITE;
/*!40000 ALTER TABLE `eventt` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `eventtype`
--

DROP TABLE IF EXISTS `eventtype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `eventtype` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `eventtype`
--

LOCK TABLES `eventtype` WRITE;
/*!40000 ALTER TABLE `eventtype` DISABLE KEYS */;
/*!40000 ALTER TABLE `eventtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fieldd`
--

DROP TABLE IF EXISTS `fieldd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `fieldd` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fieldd`
--

LOCK TABLES `fieldd` WRITE;
/*!40000 ALTER TABLE `fieldd` DISABLE KEYS */;
/*!40000 ALTER TABLE `fieldd` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `typeId` int(3) NOT NULL,
  `size` mediumint(9) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_file_type` (`typeId`),
  CONSTRAINT `fk_file_type` FOREIGN KEY (`typeId`) REFERENCES `filetype` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `filetype`
--

DROP TABLE IF EXISTS `filetype`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `filetype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `extension` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `filetype`
--

LOCK TABLES `filetype` WRITE;
/*!40000 ALTER TABLE `filetype` DISABLE KEYS */;
/*!40000 ALTER TABLE `filetype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `gallery`
--

DROP TABLE IF EXISTS `gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery`
--

LOCK TABLES `gallery` WRITE;
/*!40000 ALTER TABLE `gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `govern_person`
--

DROP TABLE IF EXISTS `govern_person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `govern_person` (
  `personId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `memberFrom` date NOT NULL,
  `memberTo` date DEFAULT NULL,
  `isActive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `instituteName` varchar(512) DEFAULT NULL,
  `other` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`personId`),
  CONSTRAINT `fk_govern_person_person` FOREIGN KEY (`personId`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `govern_person`
--

LOCK TABLES `govern_person` WRITE;
/*!40000 ALTER TABLE `govern_person` DISABLE KEYS */;
/*!40000 ALTER TABLE `govern_person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `img`
--

DROP TABLE IF EXISTS `img`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(64) NOT NULL,
  `size` mediumint(9) NOT NULL,
  `sequence` int(3) unsigned DEFAULT '0',
  `dateAdded` date DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img`
--

LOCK TABLES `img` WRITE;
/*!40000 ALTER TABLE `img` DISABLE KEYS */;
INSERT INTO `img` VALUES (1,'da',2,1,'2019-05-01',1);
/*!40000 ALTER TABLE `img` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `img_gallery`
--

DROP TABLE IF EXISTS `img_gallery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `img_gallery` (
  `imgId` int(11) NOT NULL,
  `galleryId` int(11) NOT NULL,
  KEY `fk_img_gallery_img` (`imgId`),
  KEY `fk_img_gallery_gallery` (`galleryId`),
  CONSTRAINT `fk_img_gallery_gallery` FOREIGN KEY (`galleryId`) REFERENCES `gallery` (`id`),
  CONSTRAINT `fk_img_gallery_img` FOREIGN KEY (`imgId`) REFERENCES `img` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `img_gallery`
--

LOCK TABLES `img_gallery` WRITE;
/*!40000 ALTER TABLE `img_gallery` DISABLE KEYS */;
/*!40000 ALTER TABLE `img_gallery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `institute`
--

DROP TABLE IF EXISTS `institute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `institute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cityId` int(10) unsigned NOT NULL,
  `webAddress` varchar(128) DEFAULT NULL,
  `isMember` enum('Y','N') NOT NULL DEFAULT 'Y',
  `address` varchar(70) DEFAULT NULL,
  `president` varchar(70) DEFAULT NULL,
  `iucRepresentative` varchar(70) DEFAULT NULL,
  `financeContact` varchar(70) DEFAULT NULL,
  `internationalContact` varchar(70) DEFAULT NULL,
  `memberFrom` date NOT NULL,
  `memberTo` date DEFAULT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_institute_city` (`cityId`),
  CONSTRAINT `fk_institute_city` FOREIGN KEY (`cityId`) REFERENCES `city` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `institute`
--

LOCK TABLES `institute` WRITE;
/*!40000 ALTER TABLE `institute` DISABLE KEYS */;
/*!40000 ALTER TABLE `institute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member_payment`
--

DROP TABLE IF EXISTS `member_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `member_payment` (
  `instituteId` int(11) NOT NULL,
  `year` int(4) unsigned NOT NULL,
  `paidAmount` decimal(10,2) NOT NULL,
  `currencyId` int(2) unsigned NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  KEY `fk_member_payment_institute` (`instituteId`),
  KEY `fk_member_payment_currency` (`currencyId`),
  CONSTRAINT `fk_member_payment_currency` FOREIGN KEY (`currencyId`) REFERENCES `currency` (`id`),
  CONSTRAINT `fk_member_payment_institute` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member_payment`
--

LOCK TABLES `member_payment` WRITE;
/*!40000 ALTER TABLE `member_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `member_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navbar`
--

DROP TABLE IF EXISTS `navbar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `navbar` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navbar`
--

LOCK TABLES `navbar` WRITE;
/*!40000 ALTER TABLE `navbar` DISABLE KEYS */;
/*!40000 ALTER TABLE `navbar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  `galleryId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_news_gallery` (`galleryId`),
  KEY `fk_news_mainImg` (`mainImgId`),
  CONSTRAINT `fk_news_gallery` FOREIGN KEY (`galleryId`) REFERENCES `gallery` (`id`),
  CONSTRAINT `fk_news_mainImg` FOREIGN KEY (`mainImgId`) REFERENCES `img` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `subtitle` varchar(64) DEFAULT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_page_mainImg` (`mainImgId`),
  CONSTRAINT `fk_page_mainImg` FOREIGN KEY (`mainImgId`) REFERENCES `img` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page`
--

LOCK TABLES `page` WRITE;
/*!40000 ALTER TABLE `page` DISABLE KEYS */;
/*!40000 ALTER TABLE `page` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(24) NOT NULL,
  `firstname` varchar(24) NOT NULL,
  `instituteId` int(11) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `url` varchar(70) DEFAULT NULL,
  `academicStatus` varchar(30) NOT NULL,
  `department` varchar(100) NOT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `imgId` int(11) DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_person_institute` (`instituteId`),
  KEY `fk_person_country` (`countryId`),
  KEY `fk_person_image` (`imgId`),
  CONSTRAINT `fk_person_country` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`),
  CONSTRAINT `fk_person_image` FOREIGN KEY (`imgId`) REFERENCES `img` (`id`),
  CONSTRAINT `fk_person_institute` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person_event_role`
--

DROP TABLE IF EXISTS `person_event_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `person_event_role` (
  `personId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  `roleId` int(3) DEFAULT NULL,
  KEY `fk_person` (`personId`),
  KEY `fk_event` (`eventId`),
  KEY `fk_role` (`roleId`),
  CONSTRAINT `fk_event` FOREIGN KEY (`eventId`) REFERENCES `eventt` (`id`),
  CONSTRAINT `fk_person` FOREIGN KEY (`personId`) REFERENCES `person` (`id`),
  CONSTRAINT `fk_role` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person_event_role`
--

LOCK TABLES `person_event_role` WRITE;
/*!40000 ALTER TABLE `person_event_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `person_event_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `role` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'participant'),(2,'lecturer'),(3,'director');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tags`
--

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `user` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `e-mail` varchar(100) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `surname` varchar(60) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `forgot_hash` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `forgot_expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'tinmodric@yahoo.com','tin','modric','0959105570','21232f297a57a5a743894a0e4a801fc3',NULL,1,NULL),(2,'admin@admin.com','admin','adminovic','1234567891','21232f297a57a5a743894a0e4a801fc3',NULL,1,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-26 19:01:13
