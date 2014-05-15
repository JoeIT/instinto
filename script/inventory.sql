-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.11 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for zafiro_db
DROP DATABASE IF EXISTS `zafiro_db`;
CREATE DATABASE IF NOT EXISTS `zafiro_db` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `zafiro_db`;


-- Dumping structure for table zafiro_db.item
DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `origin_id` int(11) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `quantity` int(10) NOT NULL,
  `cost` decimal(10,2) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `final_price` decimal(10,2) DEFAULT NULL,
  `description` longtext,
  `photo_dir` varchar(100) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `modified_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1F1B251E44F5D008` (`brand_id`),
  KEY `IDX_1F1B251EC54C8C93` (`type_id`),
  KEY `IDX_1F1B251E7ADA1FB5` (`color_id`),
  KEY `IDX_1F1B251E56A273CC` (`origin_id`),
  KEY `IDX_1F1B251E64D218E` (`size_id`),
  CONSTRAINT `FK_1F1B251E44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `item_brand` (`id`),
  CONSTRAINT `FK_1F1B251EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `item_type` (`id`),
  CONSTRAINT `FK_1F1B251E7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `item_color` (`id`),
  CONSTRAINT `FK_1F1B251EE308AC6F` FOREIGN KEY (`origin_id`) REFERENCES `item_origin` (`id`),
  CONSTRAINT `FK_1F1B251E56A273CC` FOREIGN KEY (`size_id`) REFERENCES `item_size` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item: ~0 rows (approximately)
DELETE FROM `item`;


-- Dumping structure for table zafiro_db.item_size
DROP TABLE IF EXISTS `item_size`;
CREATE TABLE IF NOT EXISTS `item_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item_size: ~0 rows (approximately)
DELETE FROM `item_size`;

-- Dumping structure for table zafiro_db.item_brand
DROP TABLE IF EXISTS `item_brand`;
CREATE TABLE IF NOT EXISTS `item_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item_brand: ~0 rows (approximately)
DELETE FROM `item_brand`;


-- Dumping structure for table zafiro_db.item_color
DROP TABLE IF EXISTS `item_color`;
CREATE TABLE IF NOT EXISTS `item_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item_color: ~0 rows (approximately)
DELETE FROM `item_color`;


-- Dumping structure for table zafiro_db.item_origin
DROP TABLE IF EXISTS `item_origin`;
CREATE TABLE IF NOT EXISTS `item_origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item_origin: ~0 rows (approximately)
DELETE FROM `item_origin`;


-- Dumping structure for table zafiro_db.item_type
DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- Dumping data for table zafiro_db.item_type: ~13 rows (approximately)
DELETE FROM `item_type`;
