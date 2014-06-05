-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2014 at 08:01 PM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `instinto_db`
--
CREATE DATABASE IF NOT EXISTS `instinto_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `instinto_db`;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

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
  KEY `IDX_1F1B251E64D218E` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `brand_id`, `type_id`, `color_id`, `size_id`, `origin_id`, `code`, `quantity`, `cost`, `price`, `final_price`, `description`, `photo_dir`, `creation_date`, `modified_date`) VALUES
(10, 6, 5, 6, 2, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:25', NULL),
(11, 6, 5, 7, 2, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:25', NULL),
(12, 6, 5, 8, 2, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:25', NULL),
(13, 6, 5, 2, 3, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(14, 6, 5, 8, 3, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(15, 6, 5, 6, 3, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(16, 6, 5, 7, 4, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(17, 6, 5, 2, 4, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(18, 6, 5, 6, 4, 5, 'JF-B3200', 3, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(19, 6, 5, 8, 4, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(20, 6, 5, 2, 5, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(21, 6, 5, 8, 5, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:26', NULL),
(22, 6, 5, 7, 5, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(23, 6, 5, 6, 5, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(24, 6, 5, 8, 6, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(25, 6, 5, 2, 6, 5, 'JF-B3200', 2, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(26, 6, 5, 7, 6, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(27, 6, 5, 6, 6, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL),
(28, 6, 5, 2, 7, 5, 'JF-B3200', 1, '93.33', '149.00', '144.00', 'Chamarra de cuerina.', 'JF-B3200', '2014-06-03 19:06:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item_availability`
--

DROP TABLE IF EXISTS `item_availability`;
CREATE TABLE IF NOT EXISTS `item_availability` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_brand`
--

DROP TABLE IF EXISTS `item_brand`;
CREATE TABLE IF NOT EXISTS `item_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `item_brand`
--

INSERT INTO `item_brand` (`id`, `name`, `description`) VALUES
(1, 'CAPREME', NULL),
(3, 'BACCI', NULL),
(4, 'ESKAPARATE', 'Calzados, carteras y bisuteria.'),
(5, 'AQUARELLA', 'Calzados y carteras.'),
(6, 'BLU DEISE', 'Chamarras');

-- --------------------------------------------------------

--
-- Table structure for table `item_color`
--

DROP TABLE IF EXISTS `item_color`;
CREATE TABLE IF NOT EXISTS `item_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `item_color`
--

INSERT INTO `item_color` (`id`, `name`) VALUES
(1, 'Blanco'),
(2, 'Negro'),
(3, 'Turquesa'),
(4, 'Azul marino'),
(5, 'Guindo'),
(6, 'Verde'),
(7, 'Fucsia'),
(8, 'Beige'),
(9, 'CafÃ©'),
(10, 'Rojo'),
(11, 'Menta'),
(12, 'Azul pastel');

-- --------------------------------------------------------

--
-- Table structure for table `item_origin`
--

DROP TABLE IF EXISTS `item_origin`;
CREATE TABLE IF NOT EXISTS `item_origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item_origin`
--

INSERT INTO `item_origin` (`id`, `name`) VALUES
(1, 'Fashion Trend'),
(2, 'Santa Cruz'),
(3, 'Aquarella'),
(4, 'Eskaparate'),
(5, 'Rui Yi');

-- --------------------------------------------------------

--
-- Table structure for table `item_size`
--

DROP TABLE IF EXISTS `item_size`;
CREATE TABLE IF NOT EXISTS `item_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `item_size`
--

INSERT INTO `item_size` (`id`, `name`, `description`) VALUES
(1, 'Unico', 'Para items cuyo tamaÃ±o no es relevante.'),
(2, 'S/P', 'PequeÃ±o'),
(3, 'M/M', 'Mediano'),
(4, 'L/G', ''),
(5, 'XL/GG', ''),
(6, 'XXL', ''),
(7, 'No tiene', 'Para items cuya talla no es visible o se desconoce.');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `description`) VALUES
(1, 'Enterizo', ''),
(2, 'PantalÃ³n', ''),
(3, 'Calzado', ''),
(4, 'Cartera/Bolso', ''),
(5, 'Chamarra', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_1F1B251E44F5D008` FOREIGN KEY (`brand_id`) REFERENCES `item_brand` (`id`),
  ADD CONSTRAINT `FK_1F1B251E56A273CC` FOREIGN KEY (`size_id`) REFERENCES `item_size` (`id`),
  ADD CONSTRAINT `FK_1F1B251E7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `item_color` (`id`),
  ADD CONSTRAINT `FK_1F1B251EC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `item_type` (`id`),
  ADD CONSTRAINT `FK_1F1B251EE308AC6F` FOREIGN KEY (`origin_id`) REFERENCES `item_origin` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
