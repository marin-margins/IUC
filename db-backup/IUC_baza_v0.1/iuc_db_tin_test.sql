/*
SQLyog Community v13.1.2 (64 bit)
MySQL - 10.1.37-MariaDB : Database - iuc_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`iuc_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `iuc_db`;

/*Table structure for table `city` */

DROP TABLE IF EXISTS `city`;

CREATE TABLE `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `countryId` int(10) unsigned NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_city_country` (`countryId`),
  CONSTRAINT `fk_city_country` FOREIGN KEY (`countryId`) REFERENCES `country` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `city` */

/*Table structure for table `continent` */

DROP TABLE IF EXISTS `continent`;

CREATE TABLE `continent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `continent` */

/*Table structure for table `country` */

DROP TABLE IF EXISTS `country`;

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

/*Data for the table `country` */

/*Table structure for table `currency` */

DROP TABLE IF EXISTS `currency`;

CREATE TABLE `currency` (
  `id` int(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(3) NOT NULL,
  `rate` decimal(10,5) DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `currency` */

/*Table structure for table `cycle` */

DROP TABLE IF EXISTS `cycle`;

CREATE TABLE `cycle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(9) NOT NULL,
  `active` char(1) DEFAULT 'N',
  `year_start` int(4) NOT NULL DEFAULT '2001',
  `year_end` int(4) NOT NULL DEFAULT '2001',
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cycle` */

/*Table structure for table `event_tags` */

DROP TABLE IF EXISTS `event_tags`;

CREATE TABLE `event_tags` (
  `eventId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  KEY `fk_event_tags_event` (`eventId`),
  KEY `fk_event_tags_tag` (`tagId`),
  CONSTRAINT `fk_event_tags_event` FOREIGN KEY (`eventId`) REFERENCES `eventt` (`id`),
  CONSTRAINT `fk_event_tags_tag` FOREIGN KEY (`tagId`) REFERENCES `tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `event_tags` */

/*Table structure for table `eventt` */

DROP TABLE IF EXISTS `eventt`;

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

/*Data for the table `eventt` */

/*Table structure for table `eventtype` */

DROP TABLE IF EXISTS `eventtype`;

CREATE TABLE `eventtype` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `eventtype` */

/*Table structure for table `fieldd` */

DROP TABLE IF EXISTS `fieldd`;

CREATE TABLE `fieldd` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `fieldd` */

/*Table structure for table `file` */

DROP TABLE IF EXISTS `file`;

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

/*Data for the table `file` */

/*Table structure for table `filetype` */

DROP TABLE IF EXISTS `filetype`;

CREATE TABLE `filetype` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `extension` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `filetype` */

/*Table structure for table `gallery` */

DROP TABLE IF EXISTS `gallery`;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `gallery` */

/*Table structure for table `govern_person` */

DROP TABLE IF EXISTS `govern_person`;

CREATE TABLE `govern_person` (
  `personId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `memberFrom` date NOT NULL,
  `memberTo` date DEFAULT NULL,
  `isActive` enum('Y','N') NOT NULL DEFAULT 'Y',
  `other` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`personId`),
  CONSTRAINT `fk_govern_person_person` FOREIGN KEY (`personId`) REFERENCES `person` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `govern_person` */

/*Table structure for table `img` */

DROP TABLE IF EXISTS `img`;

CREATE TABLE `img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(64) NOT NULL,
  `size` mediumint(9) NOT NULL,
  `sequence` int(3) unsigned DEFAULT '0',
  `dateAdded` date DEFAULT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `img` */

/*Table structure for table `img_gallery` */

DROP TABLE IF EXISTS `img_gallery`;

CREATE TABLE `img_gallery` (
  `imgId` int(11) NOT NULL,
  `galleryId` int(11) NOT NULL,
  KEY `fk_img_gallery_img` (`imgId`),
  KEY `fk_img_gallery_gallery` (`galleryId`),
  CONSTRAINT `fk_img_gallery_gallery` FOREIGN KEY (`galleryId`) REFERENCES `gallery` (`id`),
  CONSTRAINT `fk_img_gallery_img` FOREIGN KEY (`imgId`) REFERENCES `img` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `img_gallery` */

/*Table structure for table `institute` */

DROP TABLE IF EXISTS `institute`;

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

/*Data for the table `institute` */

/*Table structure for table `member_payment` */

DROP TABLE IF EXISTS `member_payment`;

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

/*Data for the table `member_payment` */

/*Table structure for table `navbar` */

DROP TABLE IF EXISTS `navbar`;

CREATE TABLE `navbar` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `navbar` */

/*Table structure for table `news` */

DROP TABLE IF EXISTS `news`;

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

/*Data for the table `news` */

/*Table structure for table `page` */

DROP TABLE IF EXISTS `page`;

CREATE TABLE `page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `subtitle` varchar(64) DEFAULT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_page_mainImg` (`mainImgId`),
  CONSTRAINT `fk_page_mainImg` FOREIGN KEY (`mainImgId`) REFERENCES `img` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `page` */

/*Table structure for table `person` */

DROP TABLE IF EXISTS `person`;

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
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `fk_person_institute` (`instituteId`),
  CONSTRAINT `fk_person_institute` FOREIGN KEY (`instituteId`) REFERENCES `institute` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `person` */

/*Table structure for table `region` */

DROP TABLE IF EXISTS `region`;

CREATE TABLE `region` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) unsigned DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `region` */

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tags` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
  `e-mail` varchar(100) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `surname` varchar(60) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `forgot_hash` varchar(250) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `forgot_expires` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`e-mail`,`name`,`surname`,`phone`,`password`,`forgot_hash`,`active`,`forgot_expires`) values 
(1,'tinmodric@yahoo.com','tin','modric','0959105570','password','ea9ac6f0fed310ad0e46b28cbc6f3780',1,'2019-05-03 10:05:40');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
