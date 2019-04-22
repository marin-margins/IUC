DROP DATABASE IF EXISTS iuc_hokuspokus;
CREATE DATABASE IF NOT EXISTS iuc_hokuspokus;
USE iuc_hokuspokus;

CREATE TABLE  `region` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `continent` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `country` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `continentId` int(10) UNSIGNED NOT NULL,
  `regionId` int(10) UNSIGNED NOT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_country_continent FOREIGN KEY (continentId) REFERENCES continent(id),
  CONSTRAINT fk_country_region FOREIGN KEY (regionId) REFERENCES region(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `city` (
  `id` int(10) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `countryId` int(10) UNSIGNED NOT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_city_country FOREIGN KEY (countryId) REFERENCES country(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `institute` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `cityId` int(10) UNSIGNED NOT NULL,
  `webAddress` varchar(128),
  `isMember` enum('Y','N') NOT NULL DEFAULT 'Y',
  `address` varchar(70) DEFAULT NULL,
  `president` varchar(70) DEFAULT NULL,
  `iucRepresentative` varchar(70) DEFAULT NULL,
  `financeContact` varchar(70) DEFAULT NULL,
  `internationalContact` varchar(70) DEFAULT NULL,
  `memberFrom` date NOT NULL,
  `memberTo` date DEFAULT NULL,
  `comment` varchar(2000) DEFAULT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_institute_city FOREIGN KEY (cityId) REFERENCES city(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `currency` (
  `id` int(2) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` char(3) NOT NULL,
  `rate` decimal(10,5) DEFAULT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `member_payment` (
  `instituteId` int(11) NOT NULL,
  `year` int(4) UNSIGNED NOT NULL,
  `paidAmount` decimal(10,2) NOT NULL,
  `currencyId` int(2) UNSIGNED NOT NULL,
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_member_payment_institute FOREIGN KEY (instituteId) REFERENCES institute(id),
  CONSTRAINT fk_member_payment_currency FOREIGN KEY (currencyId) REFERENCES currency(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `person` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_person_institute FOREIGN KEY (instituteId) REFERENCES institute(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `govern_person` (
	`personId` int(11) NOT NULL PRIMARY KEY,
    `title` varchar(100) NOT NULL,
    `memberFrom` date NOT NULL,
	`memberTo` date DEFAULT NULL,
    `isActive` enum('Y','N') NOT NULL DEFAULT 'Y',
    `other` varchar(2000) DEFAULT NULL,
    CONSTRAINT fk_govern_person_person FOREIGN KEY (personId) REFERENCES person(id)
    )ENGINE=InnoDB DEFAULT CHARSET=utf8;
    
    
-- -----------------------------------------------

CREATE TABLE `fileType` (
  `id` int(3) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `extension` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `file` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `typeId` int(3) NOT NULL,
  `size` mediumint(9) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  CONSTRAINT fk_file_type FOREIGN KEY (typeId) REFERENCES fileType(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `img` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `filename` varchar(64) NOT NULL,
  `size` mediumint(9) NOT NULL,
  `sequence` int(3) UNSIGNED DEFAULT 0,
  `dateAdded` date,
  `aktivan` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `img_gallery`(
	`imgId` int(11) NOT NULL,
    `galleryId` int(11) NOT NULL,
    CONSTRAINT fk_img_gallery_img FOREIGN KEY (imgId) REFERENCES img(id),
    CONSTRAINT fk_img_gallery_gallery FOREIGN KEY (galleryId) REFERENCES gallery(id)
    ) ENGINE=InnoDB DEFAULT CHARSET =utf8;
    
CREATE TABLE `navbar`(
	`id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET =utf8;


CREATE TABLE `tags` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eventType` (
  `id` int(2) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `fieldd` (
  `id` int(4) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `txt` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `cycle` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(9) NOT NULL,
  `active` char(1) DEFAULT 'N',
  `year_start` int(4) NOT NULL DEFAULT '2001',
  `year_end` int(4) NOT NULL DEFAULT '2001',
  `aktivan` int(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `eventt` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
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
  `paidCurrencyId` int(2) UNSIGNED NOT NULL,
  
  `isWaiver` enum('Y','N') NOT NULL DEFAULT 'N',
  `participationFee` decimal(10,2) NOT NULL,
  `numUnregParticipants` int(11) NOT NULL,
  `confirmed` int(1) UNSIGNED DEFAULT 0,
  `aktivan` int(1) UNSIGNED DEFAULT 1,
  CONSTRAINT fk_event_cycle FOREIGN KEY (cycleId) REFERENCES cycle(id),
  CONSTRAINT fk_event_paidCurrency FOREIGN KEY (paidCurrencyId) REFERENCES currency(id),
  CONSTRAINT fk_event_type FOREIGN KEY (typeId) REFERENCES eventType(id),
  CONSTRAINT fk_event_field FOREIGN KEY (fieldId) REFERENCES fieldd(id),
  CONSTRAINT fk_event_gallery FOREIGN KEY (galleryId) REFERENCES gallery(id),
  CONSTRAINT fk_event_mainImg FOREIGN KEY (mainImgId) REFERENCES img(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
   

   
CREATE TABLE `event_tags` (
  `eventId` int(11) NOT NULL,
  `tagId` int(11) NOT NULL,
  CONSTRAINT fk_event_tags_event FOREIGN KEY (eventId) REFERENCES eventt(id),
  CONSTRAINT fk_event_tags_tag FOREIGN KEY (tagId) REFERENCES tags(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `news` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` text NOT NULL,
  `summary` text NOT NULL,
  `body` text NOT NULL,
  `date` date NOT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  `galleryId` int(11) DEFAULT NULL,
  CONSTRAINT fk_news_gallery FOREIGN KEY (galleryId) REFERENCES gallery(id),
  CONSTRAINT fk_news_mainImg FOREIGN KEY (mainImgId) REFERENCES img(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `page` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `subtitle` varchar(64) DEFAULT NULL,
  `mainImgId` int(11) DEFAULT NULL,
  CONSTRAINT fk_page_mainImg FOREIGN KEY (mainImgId) REFERENCES img(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


