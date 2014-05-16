-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2014 a las 00:53:48
-- Versión del servidor: 5.6.14
-- Versión de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `zafiro_db`
--
CREATE DATABASE IF NOT EXISTS `zafiro_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `zafiro_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `item`
--

INSERT INTO `item` (`id`, `brand_id`, `type_id`, `color_id`, `size_id`, `origin_id`, `code`, `quantity`, `cost`, `price`, `final_price`, `description`, `photo_dir`, `creation_date`, `modified_date`) VALUES
(1, 4, 4, 3, 4, 4, 'ESK0001', 12, '50.00', '90.00', '75.00', 'Carteras eskaparate.', 'ESK0001', '2014-05-15 19:05:22', '2014-05-16 18:05:13'),
(3, 5, 4, 4, 3, 3, 'AQU0001', 50, '50.00', '80.00', '70.00', 'Algo de descrip', 'AQU0001', '2014-05-16 16:05:52', '2014-05-16 18:05:22'),
(4, 3, 2, 4, 2, 1, 'BAC0001', 20, '150.00', '200.00', '185.00', '', 'BAC0001', '2014-05-16 18:05:00', NULL),
(5, 4, 3, 1, 3, 4, 'ESK0002', 24, '250.00', '300.00', '280.00', 'Calzados de cuero.', 'ESK0002', '2014-05-16 18:05:45', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_brand`
--

DROP TABLE IF EXISTS `item_brand`;
CREATE TABLE IF NOT EXISTS `item_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `item_brand`
--

INSERT INTO `item_brand` (`id`, `name`, `description`) VALUES
(1, 'CAPREME', NULL),
(3, 'BACCI', NULL),
(4, 'ESKAPARATE', 'Calzados, carteras y bisuteria.'),
(5, 'AQUARELLA', 'Calzados y carteras.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_color`
--

DROP TABLE IF EXISTS `item_color`;
CREATE TABLE IF NOT EXISTS `item_color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `item_color`
--

INSERT INTO `item_color` (`id`, `name`) VALUES
(1, 'Blanco'),
(2, 'Negro'),
(3, 'Turquesa'),
(4, 'Azul');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_origin`
--

DROP TABLE IF EXISTS `item_origin`;
CREATE TABLE IF NOT EXISTS `item_origin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `item_origin`
--

INSERT INTO `item_origin` (`id`, `name`) VALUES
(1, 'Fashion Trend'),
(2, 'Santa Cruz'),
(3, 'Aquarella'),
(4, 'Eskaparate');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_size`
--

DROP TABLE IF EXISTS `item_size`;
CREATE TABLE IF NOT EXISTS `item_size` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(10) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `item_size`
--

INSERT INTO `item_size` (`id`, `name`, `description`) VALUES
(2, 'S/P', 'PequeÃ±o'),
(3, 'M/M', 'Mediano'),
(4, 'No aplica', 'Para items cuyo tamaÃ±o no es relevante.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_type`
--

DROP TABLE IF EXISTS `item_type`;
CREATE TABLE IF NOT EXISTS `item_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `item_type`
--

INSERT INTO `item_type` (`id`, `name`, `description`) VALUES
(1, 'Enterizo', ''),
(2, 'PantalÃ³n', ''),
(3, 'Calzado', ''),
(4, 'Cartera/Bolso', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `item`
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
