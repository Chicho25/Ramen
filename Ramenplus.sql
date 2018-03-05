-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 16-11-2017 a las 08:18:55
-- Versión del servidor: 5.6.36-cll-lve
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `Ramenplus`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `country` int(11) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `smtp` varchar(100) NOT NULL,
  `port` varchar(50) NOT NULL,
  `sslOption` varchar(100) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `company`
--

INSERT INTO `company` (`id`, `name`, `phone`, `address1`, `address2`, `country`, `province`, `city`, `thirdparty`, `smtp`, `port`, `sslOption`, `subject`, `stat`, `created_on`) VALUES
(10, 'GRUAS SHL', '2315818', 'CARRETERA TRANSISTMICA', 'MILLA 8', 1, 'PANAMA', 'PANAMA', '02', '.', '.', '.', '.', 1, '2017-08-15 07:14:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `company_logo`
--

CREATE TABLE IF NOT EXISTS `company_logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `path` varchar(500) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `company_logo`
--

INSERT INTO `company_logo` (`id`, `id_company`, `name`, `path`, `createdOn`) VALUES
(3, 10, 'companylogo/ARTE FINAL LOGO GRUAS SHL CUADRADO.jpg', 'companylogo/10_thumb.jpg', '2017-08-15 07:14:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `cellno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `customer` int(11) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`id`, `name`, `stat`) VALUES
(1, 'PANAMA', 1),
(2, 'NICARAGUA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `country` int(11) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documents_file`
--

CREATE TABLE IF NOT EXISTS `documents_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_document` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `path` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `jobtitle` varchar(50) NOT NULL,
  `cellno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `craneoperator` tinyint(1) NOT NULL,
  `qlfcertified1` tinyint(1) NOT NULL,
  `certificationdate1` varchar(100) NOT NULL,
  `expirationdate1` varchar(100) NOT NULL,
  `qlfsignalperson` tinyint(1) NOT NULL,
  `qlfcertified2` tinyint(1) NOT NULL,
  `certificationdate2` varchar(100) NOT NULL,
  `expirationdate2` varchar(100) NOT NULL,
  `qlfrigger` tinyint(1) NOT NULL,
  `qlfcertified3` tinyint(1) NOT NULL,
  `certificationdate3` varchar(100) NOT NULL,
  `expirationdate3` varchar(100) NOT NULL,
  `qlfmechanic` tinyint(1) NOT NULL,
  `qlfelectromechanic` tinyint(1) NOT NULL,
  `qlfinspector` tinyint(1) NOT NULL,
  `hourly_bare` float NOT NULL,
  `daily_bare` float NOT NULL,
  `weekly_bare` float NOT NULL,
  `monthly_bare` float NOT NULL,
  `yearly_bare` int(11) NOT NULL,
  `overtime_bare` float NOT NULL,
  `doubletime_bare` float NOT NULL,
  `traveltime_bare` float NOT NULL,
  `dailyminimum_bare` float NOT NULL,
  `projectminimum_bare` float NOT NULL,
  `salesperson` tinyint(1) NOT NULL,
  `commission` varchar(100) NOT NULL,
  `driver` tinyint(1) NOT NULL,
  `licensenumber` varchar(100) NOT NULL,
  `licenseclass` varchar(100) NOT NULL,
  `licenseexpire` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=90 ;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`id`, `idcard`, `firstname`, `lastname`, `jobtitle`, `cellno`, `email`, `thirdparty`, `craneoperator`, `qlfcertified1`, `certificationdate1`, `expirationdate1`, `qlfsignalperson`, `qlfcertified2`, `certificationdate2`, `expirationdate2`, `qlfrigger`, `qlfcertified3`, `certificationdate3`, `expirationdate3`, `qlfmechanic`, `qlfelectromechanic`, `qlfinspector`, `hourly_bare`, `daily_bare`, `weekly_bare`, `monthly_bare`, `yearly_bare`, `overtime_bare`, `doubletime_bare`, `traveltime_bare`, `dailyminimum_bare`, `projectminimum_bare`, `salesperson`, `commission`, `driver`, `licensenumber`, `licenseclass`, `licenseexpire`, `stat`, `created_on`) VALUES
(1, '8-725-34', 'Luis', 'Hernandez', 'administrador', '63721914', 'taller@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '8-725-34', 'F', '01/06/2021', 1, '2017-06-11 09:07:09'),
(2, '8-856-182', 'Katherine', 'DÃ­az', 'Compras', '6679-3058', 'mantenimiento@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-06-11 10:24:20'),
(3, 'E-8-141420', 'Gustavo', 'Quintero', 'Jefe de taller', '6747-3515', 'electrinica@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-06-11 10:38:00'),
(4, '8-870-2292', 'Marcos', 'Ãbrego', 'MecÃ¡nico', '6210-6611', 'a@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-06-21 02:15:21'),
(5, '8-829-1179', 'Javier', 'Ortega', 'MecÃ¡nico', '6848-4361', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 07:11:48'),
(6, '8-833-1383', 'JosÃ©', 'Rivas', 'Ayudante', '6285-2695', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 07:13:41'),
(7, '3-728-2306', 'Felicito', 'MartÃ­nez', 'Ayudante', '6309-0680', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 07:18:48'),
(8, '8-790-1146', 'Edgardo', 'Harris', 'MecÃ¡nico', '6779-4296', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 07:26:47'),
(9, '3-73-2732', 'Teofilo', 'Vivies', 'Mecanico', '6726-2550', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '04-04-2020', 1, '2017-08-15 07:30:20'),
(10, 'AR689115', 'Oscar', 'Suarez', 'ElectromecÃ¡nico', '6604-3196', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 07:32:29'),
(11, '8-911-2500', 'Irving', 'Espinoza', 'ElectromecÃ¡cino', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 07:35:28'),
(12, '9-211-667', 'Jorge', 'Vega', 'Mensajero', '6675-0899', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-15 08:04:36'),
(13, '10-27-971', 'Nelson', 'Herrera', 'Tornero', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:05:24'),
(14, '7-93-1208', 'Yony', 'Mendieta', 'Soldador', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:06:49'),
(15, '5-708-676', 'Oxman', 'Asmaca', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:08:41'),
(16, '8-717-590', 'Vilma', 'De Gracia', 'Recepcionista', '6679-7597', 'recepcion@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:51:42'),
(17, '8-711-1033', 'Johana', 'Arrocha', 'RRHH', '6980-5049', 'johana.arrocha@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:54:02'),
(18, '8-733-104', 'Yenisel', 'asd', 'Planilla', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 08:54:46'),
(20, '3-123-700', 'Yasmina', 'Garcia', 'Jefa de contabilidad', '6998-4532', 'contabilidad1@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 09:00:03'),
(21, '8-906-9', 'Ernesto', 'Ortega', 'Asistente de contabilidad', '', 'contabilidad2@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 09:01:49'),
(22, '6-86-5', 'Moira', 'Chavez', 'Ventas', '', 'mercadeo@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '0', 0, '', '', '', 1, '2017-08-15 09:05:29'),
(23, '8-746-1715', 'Yenika', 'GonzÃ¡lez', 'FacturaciÃ³n y Post Venta', '6998-3750', 'yenika.gonzalez@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 09:07:17'),
(24, '8-934-1237', 'Irma', 'RodrÃ­guez', 'Asistente de ventas', '6675-6207', 'clientes@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '', 0, '', '', '', 1, '2017-08-15 09:27:27'),
(26, '3-724-1944', 'Silvano', 'Garcia', 'Logistica', '6675-5248', 'logistica@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-15 09:35:01'),
(27, '6-713-2165', 'Javier', 'Arenas', 'Inspector', '6672-8807', 'ventas2@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '', 1, '', '', '', 1, '2017-08-15 09:38:46'),
(28, '8-N-21-696', 'Manuel', 'Enciso', 'Inspector', '6780-8692', 'ventas3@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '', 1, '', '', '18-06-2020', 1, '2017-08-15 09:44:38'),
(29, '8-838-596', 'Edwar', 'CedeÃ±o', 'Operador', '6651-5265', 'd@d.com', '', 1, 1, '', '2017-08-29', 1, 1, '', '2018-07-04', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '002368336', 'I', '31-08-2019', 1, '2017-08-16 01:40:26'),
(30, '4-727-2462', 'JosÃ©', 'Castillo', 'Operador', '6747-0793', 'd@d.com', '', 1, 1, '', '2018-09-13', 1, 1, '', '2017-07-25', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '18-03-2020', 1, '2017-08-16 01:42:22'),
(31, '7-92-1402', 'Clemente', 'CedeÃ±o', 'Operador', '6254-0064', 'd@d.com', '', 1, 1, '', '2018-11-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-05-2019', 1, '2017-08-16 01:43:41'),
(32, '7-91-1839', 'Eugenio', 'Cerrud', 'Operador', '6480-6382', 'd@d.com', '', 1, 1, '', '2019-01-18', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-03-2018', 1, '2017-08-16 01:45:53'),
(33, '8-364-689', 'Eberto', 'Carrera', 'Operador', '6538-0305', 'd@d.com', '', 1, 1, '', '2018-09-27', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '17-06-2020', 1, '2017-08-16 01:48:32'),
(34, '1-708-2247', 'Abdiel', 'MartÃ­nez', 'Operador', '6409-1985', 'd@d.com', '', 1, 1, '', '2018-11-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '02-04-2020', 1, '2017-08-16 01:49:49'),
(35, '4-748-1157', 'Katherine', 'Caballero', 'Operador', '6200-2168', 'd@d.com', '', 1, 1, '', '2017-08-18', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-09-2018', 1, '2017-08-16 01:51:26'),
(36, '8-756-536', 'Luis', 'Lee', 'Operador', '6703-2894', 'd@d.com', '', 1, 1, '', '2018-09-27', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-05-2019', 1, '2017-08-16 01:55:16'),
(37, '8-482-534', 'Estevan', 'GirÃ³n', 'Operador', '6413-7665', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '25-02-2020', 1, '2017-08-16 01:56:54'),
(38, '4-743-1193', 'Andy', 'PÃ©rez', 'Operador', '6709-5417', 'd@d.com', '', 1, 1, '', '2019-01-18', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '07-07-2020', 1, '2017-08-16 03:02:20'),
(39, '8-742-894', 'Briceida', 'GonzÃ¡lez', 'Operador', '6362-3266', 'd@d.com', '', 1, 1, '', '2017-08-29', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '01-08-2020', 1, '2017-08-16 03:05:22'),
(40, '8-259-41', 'Candido', 'Correa', 'Operador', '', 'd@d.com', '', 1, 1, '', '2018-09-27', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-07-2018', 1, '2017-08-16 03:07:36'),
(41, '8-374-60', 'Cipriano', 'RodrÃ­guez', 'Operador', '6676-5065', 'd@d.com', '', 1, 1, '', '2018-11-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '10-01-2021', 1, '2017-08-16 03:10:01'),
(42, '8-324-882', 'Edwin', 'Cuan', 'Operador', '6267-3365', 'd@d.com', '', 1, 1, '', '2018-06-30', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', 'D', '31-03-2018', 1, '2017-08-16 03:14:21'),
(43, '9-213-948', 'Edwin', 'RodrÃ­guez', 'Operador', '6648-0886', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-10-2018', 1, '2017-08-16 03:17:52'),
(44, '8-773-1972', 'Elvis', 'Pitty', 'Operador', '6748-3659', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '04-03-2020', 1, '2017-08-16 03:22:28'),
(45, '8-701-30', 'Francisco', 'GonzÃ¡lez', 'Operador', '6606-3603', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-06-2018', 1, '2017-08-16 03:27:10'),
(46, '8-165-2268', 'JosÃ©', 'Coronado', 'Operador', '6484-8031', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-09-2018', 1, '2017-08-16 03:33:00'),
(47, '2-723-1672', 'Leonel', 'Solis', 'Operador', '6381-4495', 'd@d.com', '', 1, 1, '', '2017-10-09', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '03-07-2021', 1, '2017-08-16 03:35:47'),
(48, '8-248-110', 'Manuel', 'Renys', 'Operador', '6826-6747', 'd@d.com', '', 1, 1, '', '2018-06-24', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-10-2017', 1, '2017-08-16 03:38:55'),
(49, '3-739-85', 'Melquicided', 'Montero', 'Operador', '', 'd@d.com', '', 1, 1, '', '2019-01-18', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '19-01-2020', 1, '2017-08-16 03:43:22'),
(50, '4-743-2129', 'Yousell', 'GÃ³mez', 'Operador', '6839-6025', 'd@d.com', '', 1, 1, '', '2018-09-27', 1, 1, '', '2018-10-07', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '09-12-2020', 1, '2017-08-16 03:45:30'),
(51, '3-727-898', 'Angel', 'Jimenez', 'Operador', '6792-3653', 'd@d.com', '', 1, 1, '', '2018-09-27', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-04-2018', 1, '2017-08-16 04:11:55'),
(52, '3-717-1488', 'Luis', 'Lucero', 'Mulero', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-08-2018', 1, '2017-08-16 04:15:30'),
(53, '8-255-276', 'Amado', 'Cortes', 'Mulero', '6206-6053', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '14-11-2019', 1, '2017-08-16 04:16:41'),
(54, '2-105-826', 'Cornelio', 'Garcia', 'Mulero', '6093-1880', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-08-2017', 1, '2017-08-16 04:18:09'),
(55, '8-738-11', 'Roberto', 'Garcia', 'Mulero', '6783-9460', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-06-2021', 1, '2017-08-16 04:19:47'),
(56, '8-792-1500', 'Irwing', 'Oro', 'Mulero', '6271-8850', 'd@d.com', '', 1, 1, '', '2018-07-04', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-12-2017', 1, '2017-08-16 04:24:51'),
(57, '4-111-897', 'Virgilio', 'Quintero', 'Surtidor de combustible', '6675-1879', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '14-10-2020', 1, '2017-08-16 04:27:32'),
(58, '8-449-531', 'Noel', 'Quintero', 'Mensajero', '6780-2514', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-16 04:37:59'),
(59, '8-473-415', 'Adalberto', 'Garcia', 'Ayudante', '6441-9933', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-07-04', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-10-2017', 1, '2017-08-16 04:56:52'),
(60, '8-765-1111', 'Anel', 'Mendoza', 'Ayudante', '6414-5051', 'd@d.com', '', 1, 1, '', '', 1, 1, '', '2018-07-04', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-04-2018', 1, '2017-08-16 04:59:25'),
(61, '3-705-1124', 'David', 'MarÃ­n', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-02-21', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-06-2020', 1, '2017-08-16 05:04:20'),
(62, '8-887-1185', 'Eduardo', 'AndriÃ³n', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-06-27', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-10-2018', 1, '2017-08-16 05:06:06'),
(63, '8-837-2274', 'Eric', 'Vargas', 'Ayudante', '6222-6710', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-09-06', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-12-2019', 1, '2017-08-16 05:08:15'),
(64, '2-734-2288', 'Fernando', 'GonzÃ¡lez', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '30-06-2019', 1, '2017-08-16 05:10:43'),
(65, '3-88-1815', 'Francisco', 'Mena', 'Ayudante', '6059-5712', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2017-11-15', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '17-08-2020', 1, '2017-08-16 07:32:18'),
(66, '4-741-1759', 'Henry', 'DÃ­az', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-06-13', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '02-03-2021', 1, '2017-08-16 07:34:20'),
(67, '8-900-1001', 'John', 'Davis', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-06-13', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-12-2019', 1, '2017-08-16 07:36:26'),
(68, '8-797-1478', 'Jorge', 'Arias', 'Ayudante', '6894-0135', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-09-06', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-08-2017', 1, '2017-08-16 07:38:29'),
(69, '8-877-1250', 'Michael', 'Mela', 'Ayudante', '6540-8293', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-02-21', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-01-2019', 1, '2017-08-16 07:40:44'),
(70, '3-716-2446', 'Oscar', 'Garcia', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-07-04', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-12-2017', 1, '2017-08-16 07:43:24'),
(71, '4-863-444', 'Victor', 'YangÃ¼ez', 'Ayudante', '6940-6006', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2017-11-07', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '31-08-2018', 1, '2017-08-16 07:47:30'),
(72, '8-783-83', 'Roberto', 'SÃ¡nchez', 'Ayudante', '', 'd@d.com', '', 0, 0, '', '', 1, 1, '', '2018-03-28', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 07:59:16'),
(73, '9-158-684', 'Saturnino', 'Segura', 'Mensajero', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-16 08:00:38'),
(74, '8-331-516', 'Juan', 'Romero', 'Mensajero', '6609-0236', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 1, '', '', '', 1, '2017-08-16 08:02:32'),
(75, '8-753-1453', 'Omar', 'Salerno GonzÃ¡lez', 'Gerente', '6679-3442', 'osalerno@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 08:06:05'),
(76, '8-202-2427', 'Omar', 'Salerno Guerrero', 'Gerente', '6780-8014', 'milla81@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 08:10:54'),
(77, '9-125-2245', 'Gregorio', 'Ruiz', 'Vigilante', '6413-5147', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:13:00'),
(78, '9-122-2212', 'JosÃ©', 'Delgado', 'Vigilante', '6413-5147', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:14:34'),
(79, '9-185-573', 'Juanito', 'RodrÃ­guez', 'Vigilante', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:20:44'),
(80, '4-202-278', 'Ruben', 'MartÃ­nez', 'Vigilante', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:21:27'),
(81, '3-717-1015', 'Moises', 'Carranza', 'Operador', '', 'd@d.com', '', 1, 1, '', '2017-12-02', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:23:24'),
(82, '7-88-1428', 'Digna', 'Garcia', 'Aseador', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:24:41'),
(83, '8-807-2100', 'Deivid', 'Batista', 'Asistente', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:25:57'),
(84, '732300', 'Luis', 'Marrugo', 'Tornero', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:26:23'),
(85, '8-224-1821', 'Marcos', 'Hooper', 'Vendedor', '', 'd@d.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '0', 0, '', '', '', 1, '2017-08-16 09:27:17'),
(86, '4-801-1140', 'Eliecer', 'PÃ©rez', 'Almacenista', '6422-1316', 'plataformas@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:31:33'),
(87, '2-708-1713', 'Jovany', 'Aguilar', 'Asistente', '6877-1166', 'jovany.aguilar@salernoheavylift.com', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-08-16 09:32:43'),
(88, '123-456-789', 'Pedro', 'Fernandez', 'Cantante', '1234567890', 'abc@mail.mail', '', 0, 0, '2017-09-24', '2017-09-03', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 0, '2017-09-14 03:00:33'),
(89, '3-73-2732', 'ADRIAN', 'RANGEL', 'TECNICO', '123456', 'ADRIANRANGEL.0606@GMAIL.COM', '', 0, 0, '', '', 0, 0, '', '', 0, 0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, '', '', '', 1, '2017-11-01 03:36:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee_document`
--

CREATE TABLE IF NOT EXISTS `employee_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_employee` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fleet_issue`
--

CREATE TABLE IF NOT EXISTS `fleet_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `reportedOn` date NOT NULL,
  `id_vehsection` int(11) NOT NULL,
  `odometer` float NOT NULL,
  `enginehour` float NOT NULL,
  `summary` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `id_priority` int(11) NOT NULL,
  `id_reportedby` int(11) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `isClosed` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Volcado de datos para la tabla `fleet_issue`
--

INSERT INTO `fleet_issue` (`id`, `id_vehicle`, `reportedOn`, `id_vehsection`, `odometer`, `enginehour`, `summary`, `description`, `id_priority`, `id_reportedby`, `stat`, `isClosed`, `createdOn`) VALUES
(1, 7, '2017-11-08', 1, 20555, 0, 'NECESITA MANTENIMIENTO', 'DIA 9 DE NOV', 2, 86, 1, 0, '2017-11-08 08:16:10'),
(2, 12, '2017-11-14', 1, 46695, 46695, 'NECESITA MANTENIMIENTO', 'EL MOTOR ESTA PRÃ“XIMO A MANTENIMIENTO.', 2, 86, 1, 0, '2017-11-14 02:51:38'),
(3, 16, '2017-11-14', 1, 71258, 0, 'NECESITA MANTENIMIENTO', 'PRÃ“XIMA  A MANTENIMIENTO DEL MOTR', 2, 86, 1, 0, '2017-11-14 02:54:22'),
(4, 65, '2017-11-14', 2, 0, 4539, 'NECESITA MANTENIMIENTO', 'MOTOR SUPER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 02:55:31'),
(5, 11, '2017-11-14', 1, 44552, 0, 'NECESITA MANTENIMIENTO', 'MOTOR CARRIER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 02:56:34'),
(6, 4, '2017-11-14', 1, 129122, 0, 'NECESITA MANTENIMIENTO', 'MOTOR CARRIER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 02:57:23'),
(7, 29, '2017-11-14', 1, 20823, 0, 'NECESITA MANTENIMIENTO', 'MOTOR CARRIER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 02:58:25'),
(8, 43, '2017-11-14', 1, 4850, 0, 'NECESITA MANTENIMIENTO', 'MOTOR CARRIER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 02:59:25'),
(9, 42, '2017-11-14', 1, 4787, 0, 'NECESITA MANTENIMIENTO', 'MOTOR CARRIER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 03:00:07'),
(10, 54, '2017-11-14', 2, 0, 2525, 'NECESITA MANTENIMIENTO', 'MOTOR SUPER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 03:01:13'),
(11, 57, '2017-11-14', 2, 0, 1452, 'NECESITA MANTENIMIENTO', 'MOTOR SUPER PRÃ“XIMO A MANTENIMIENTO', 2, 86, 1, 0, '2017-11-14 03:02:11'),
(12, 59, '2017-11-15', 1, 0, 0, 'VERIFICACIÃ“N COMPLETA DE LUCES DIRECCIONALES', 'HACEN FALTA LUCES DE DIRECCIÃ“N , ALGUNAS DEBEN REMPLAZARSE Y OTRAS REPARAR.', 2, 33, 1, 0, '2017-11-15 08:46:15'),
(13, 59, '2017-11-15', 1, 0, 0, 'PENDIENTE REPARACIÃ“N DE LLANTA 1 Y 3 DEL LADO DEL PASAJERO  ', 'LAS LLANTA 1 Y 3 TIENDEN A FLAT, NO TAN RÃPIDO PERO DEBEN SER REPARADAS.', 2, 33, 1, 0, '2017-11-15 08:53:04'),
(14, 59, '2017-11-15', 1, 0, 0, 'PENDIENTE REMPLAZO DE LUCES TRASERAS ', 'DE LAS 2 LAMPARAS UNA ESTA QUEBRADA Y LA OTRA NO FUNCIONA.\r\nSE DEBEN REMPLAZAR AMBAS.', 2, 33, 1, 0, '2017-11-15 08:54:51'),
(15, 59, '2017-11-15', 1, 0, 0, 'PENDIENTE REPARACIÃ“N DE PUERTAS DE CAJONES TRASEROS DE LA GRUA', 'LA GRÃšA CUENTA CON 2 CAJONES EN LA PARTE TRASERA, AMBOS SUS PUERTAS TIENEN A SALIRSE DE LAS BISAGRAS, NECESITAN REMPLAZO DE BISAGRAS.', 2, 33, 1, 0, '2017-11-15 08:57:17'),
(16, 59, '2017-11-15', 1, 0, 0, 'REPARACIÃ“N DE LUCES DE TODOS LOS PLATOS ESTABILIZADORES', 'AL MOMENTO DE ACTIVAR LOS PLATOS ESTABILIZADORES NO FUNCIONAN NINGUNAS DE LAS LUCES.\r\n\r\n', 2, 33, 1, 0, '2017-11-15 09:37:04'),
(17, 59, '2017-11-15', 1, 0, 0, 'MASTER SWITCH DEL MOTOR CARRIER NO FUNCIONA ', 'EL MÃSTER SWITCH NO FUNCIONA NECESITA REPARACIÃ“N O REMPLAZO.', 2, 33, 1, 0, '2017-11-15 09:43:17'),
(18, 59, '2017-11-15', 1, 0, 0, 'VERIFICACIÃ“N Y REMPLAZO DE LUCES DEL TABLERO ', 'NECESITA VERIFICACIÃ“N Y REMPLAZO DE LUCES DEL TABLERO DE LA CABINA DEL MOTOR CARRIER', 2, 33, 1, 0, '2017-11-15 09:44:38'),
(19, 59, '2017-11-15', 2, 0, 0, 'LIK DE ACEITE EN EL PISTÃ“N INTERNO DEL BOOM', 'EL PISTÃ“N INTERNO DEL BOOM  LLEVA TIEMPO CON UN LIK DE ACEITE.', 1, 33, 1, 0, '2017-11-15 09:46:30'),
(20, 59, '2017-11-15', 1, 0, 0, 'PENDIENTE SOLDAR PLATOS ESTABILIZADORES TRASEROS, LADO IZQUIERDO Y DERECHO ', 'AMBOS ESTÃN DAÃ‘ADOS, DEBEN SER REFORZADOS Y SOLADOS.', 2, 33, 1, 0, '2017-11-15 09:47:40'),
(21, 45, '2017-11-16', 1, 0, 0, 'CAMBIO DE CARRETE', 'PERSONAL A CARGO:\r\nJAVIER ORTEGA: MECANICO\r\nYOUSELL GOMEZ: OPERADOR', 2, 1, 1, 0, '2017-11-16 02:50:31'),
(22, 45, '2017-11-16', 1, 0, 0, 'REPARAR MOFLE', 'PERSONAL A CARGO:\r\nJOSE: ELECTROMECANICO\r\nJONNY: SOLDADOR\r\n', 2, 1, 1, 0, '2017-11-16 02:51:33'),
(23, 45, '2017-11-16', 2, 0, 0, 'LIK DE ACEITE EN EL CILINDRO DE ELEVACIÃ“N ', 'ESTE TRABAJO QUEDARA PENDIENTE.', 2, 1, 1, 0, '2017-11-16 02:52:30'),
(24, 45, '2017-11-16', 1, 0, 0, 'PENDIENTE ENGRASAR PATAS', 'PERSONAL ENCARGADO:\r\nYOUSELL GOMEZ: OPERADOR', 2, 1, 1, 0, '2017-11-16 02:53:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fuel`
--

CREATE TABLE IF NOT EXISTS `fuel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `fuelDate` date NOT NULL,
  `id_vehsection` int(11) NOT NULL,
  `odometer` float NOT NULL,
  `enginehour` float NOT NULL,
  `liters` float NOT NULL,
  `price` float NOT NULL,
  `fueltype` varchar(100) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `partialfuel` tinyint(1) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `fuel`
--

INSERT INTO `fuel` (`id`, `id_vehicle`, `fuelDate`, `id_vehsection`, `odometer`, `enginehour`, `liters`, `price`, `fueltype`, `id_supplier`, `reference`, `partialfuel`, `stat`, `createdOn`) VALUES
(4, 31, '2017-10-12', 1, 8603, 0, 40, 0.671, '1', 39, '1745', 0, 1, '2017-11-15 06:37:24'),
(5, 69, '2017-10-12', 1, 0, 0, 203, 0.671, '1', 39, '1746', 0, 1, '2017-11-15 06:40:52'),
(6, 50, '2017-10-13', 1, 6661, 0, 195, 0.671, '1', 39, '1747', 0, 1, '2017-11-15 06:42:44'),
(7, 37, '2017-10-13', 1, 207275, 650, 183, 0.671, '1', 39, '1748', 0, 1, '2017-11-15 07:00:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventory_adjustment`
--

CREATE TABLE IF NOT EXISTS `inventory_adjustment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_warehouse` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `receive_by` int(11) NOT NULL,
  `order_no` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_in_hand` float NOT NULL,
  `qty_new` float NOT NULL,
  `reason` varchar(1000) NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=107 ;

--
-- Volcado de datos para la tabla `inventory_adjustment`
--

INSERT INTO `inventory_adjustment` (`id`, `id_warehouse`, `id_item`, `reference`, `date`, `receive_by`, `order_no`, `qty`, `qty_in_hand`, `qty_new`, `reason`, `entry_by`) VALUES
(1, 1, 100, 'FILTRO', '2017-11-14', 0, 1, 2, 0, 2, 'COMPRA PARA MANTENIMIENTO', 5),
(2, 1, 101, 'FILTRO', '2017-11-14', 0, 2, 2, 0, 2, 'COMPRA PARA MANTENIMIENTO', 5),
(3, 1, 102, 'FILTRO', '2017-11-14', 0, 3, 2, 0, 2, 'COMPRA PARA MANTENIMIENTO', 5),
(4, 1, 100, 'Requisition# 4', '2017-11-14', 0, 0, -1, 2, 1, 'Work Order#  and Requisition# 4', 5),
(5, 1, 101, 'Requisition# 4', '2017-11-14', 0, 0, -1, 2, 1, 'Work Order#  and Requisition# 4', 5),
(6, 1, 102, 'Requisition# 4', '2017-11-14', 0, 0, -1, 2, 1, 'Work Order#  and Requisition# 4', 5),
(7, 1, 100, 'Requisition# 6', '2017-11-14', 0, 0, -1, 1, 0, 'Work Order#  and Requisition# 6', 5),
(8, 1, 101, 'Requisition# 6', '2017-11-14', 0, 0, -1, 1, 0, 'Work Order#  and Requisition# 6', 5),
(9, 1, 102, 'Requisition# 6', '2017-11-14', 0, 0, -1, 1, 0, 'Work Order#  and Requisition# 6', 5),
(10, 1, 1, 'FILTRO', '2017-11-14', 0, 4, 8, 0, 8, 'INVENTARIO INICIAL\r\n', 5),
(11, 1, 2, 'FILTRO', '2017-11-14', 0, 5, 8, 0, 8, 'INVENTARIO INICIAL', 5),
(12, 1, 3, 'FILTRO', '2017-11-14', 0, 6, 7, 0, 7, 'INVENTARIO INICIAL', 5),
(13, 1, 4, 'FILTRO', '2017-11-14', 0, 7, 5, 0, 5, 'INVENTARIO INICIAL', 5),
(14, 1, 5, 'FILTRO', '2017-11-14', 0, 8, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(15, 1, 7, 'FILTRO', '2017-11-14', 0, 9, 3, 0, 3, 'INVENTARIO INICIAL\r\n', 5),
(16, 1, 8, 'FILTRO', '2017-11-14', 0, 10, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(17, 1, 9, 'FILTRO', '2017-11-14', 0, 11, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(18, 1, 10, 'FILTRO', '2017-11-14', 0, 12, 12, 0, 12, 'INVENTARIO INICIAL', 5),
(19, 1, 11, 'FILTRO', '2017-11-14', 0, 13, 5, 0, 5, 'INVENTARIO INICIAL', 5),
(20, 1, 12, 'FILTRO', '2017-11-14', 0, 14, 5, 0, 5, 'INVENTARIO INICIAL', 5),
(21, 1, 13, 'FILTRO', '2017-11-14', 0, 15, 15, 0, 15, 'INVENTARIO INICIAL', 5),
(22, 1, 14, 'FILTRO', '2017-11-14', 0, 16, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(23, 1, 15, 'FILTRO', '2017-11-14', 0, 17, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(24, 1, 16, 'FILTRO', '2017-11-14', 0, 18, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(25, 1, 17, 'FILTRO', '2017-11-14', 0, 19, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(26, 1, 18, 'FILTRO', '2017-11-14', 0, 20, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(27, 1, 19, 'FILTRO', '2017-11-14', 0, 21, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(28, 1, 20, 'FILTRO', '2017-11-14', 0, 22, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(29, 1, 21, 'FILTRO', '2017-11-14', 0, 23, 9, 0, 9, 'INVENTARIO INICIAL', 5),
(30, 1, 22, 'FILTRO', '2017-11-14', 0, 24, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(31, 1, 23, 'FILTRO', '2017-11-14', 0, 25, 8, 0, 8, 'INVENTARIO INICIAL', 5),
(32, 1, 24, 'FILTRO', '2017-11-14', 0, 26, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(33, 1, 25, 'FILTRO', '2017-11-14', 0, 27, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(34, 1, 26, 'FILTRO', '2017-11-14', 0, 28, 5, 0, 5, 'INVENTARIO INICIAL', 5),
(35, 1, 27, 'FILTRO', '2017-11-14', 0, 29, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(36, 1, 28, 'FILTRO', '2017-11-14', 0, 30, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(37, 1, 29, 'FILTRO', '2017-11-14', 0, 31, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(38, 1, 30, 'FILTRO', '2017-11-14', 0, 32, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(39, 1, 31, 'FILTRO', '2017-11-14', 0, 33, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(40, 1, 32, 'FILTRO', '2017-11-14', 0, 34, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(41, 1, 34, 'FILTRO', '2017-11-14', 0, 35, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(42, 1, 36, 'FILTRO', '2017-11-14', 0, 36, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(43, 1, 37, 'FILTRO', '2017-11-14', 0, 37, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(44, 1, 38, 'FILTRO', '2017-11-14', 0, 38, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(45, 1, 39, 'FILTRO', '2017-11-14', 0, 39, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(46, 1, 40, 'FILTRO', '2017-11-14', 0, 40, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(47, 1, 41, 'FILTRO', '2017-11-14', 0, 41, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(48, 1, 42, 'FILTRO', '2017-11-14', 0, 42, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(49, 1, 43, 'FILTRO', '2017-11-14', 0, 43, 7, 0, 7, 'INVENTARIO INICIAL', 5),
(50, 1, 44, 'FILTRO', '2017-11-14', 0, 44, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(51, 1, 45, 'FILTRO', '2017-11-14', 0, 45, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(52, 1, 46, 'FILTRO', '2017-11-14', 0, 46, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(53, 1, 47, 'FILTRO', '2017-11-14', 0, 47, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(54, 1, 49, 'FILTRO', '2017-11-14', 0, 48, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(55, 1, 50, 'FILTRO', '2017-11-14', 0, 49, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(56, 1, 51, 'FILTRO', '2017-11-14', 0, 50, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(57, 1, 52, 'FILTRO', '2017-11-14', 0, 51, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(58, 1, 53, 'FILTRO', '2017-11-14', 0, 52, 8, 0, 8, 'INVENTARIO INICIAL', 5),
(59, 1, 54, 'FILTRO', '2017-11-14', 0, 53, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(60, 1, 55, 'FILTRO', '2017-11-14', 0, 54, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(61, 1, 56, 'FILTRO', '2017-11-14', 0, 55, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(62, 1, 58, 'FILTRO', '2017-11-14', 0, 56, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(63, 1, 60, 'FILTRO', '2017-11-14', 0, 57, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(64, 1, 61, 'FILTRO', '2017-11-14', 0, 58, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(65, 1, 62, 'FILTRO', '2017-11-14', 0, 59, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(66, 1, 63, 'FILTRO', '2017-11-14', 0, 60, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(67, 1, 64, 'FILTRO', '2017-11-14', 0, 61, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(68, 1, 66, 'FILTRO', '2017-11-14', 0, 62, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(69, 1, 67, 'FILTRO', '2017-11-14', 0, 63, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(70, 1, 69, 'FILTRO', '2017-11-14', 0, 64, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(71, 1, 70, 'FILTRO', '2017-11-14', 0, 65, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(72, 1, 71, 'FILTRO', '2017-11-14', 0, 66, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(73, 1, 72, 'FILTRO', '2017-11-14', 0, 67, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(74, 1, 73, 'FILTRO', '2017-11-14', 0, 68, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(75, 1, 75, 'FILTRO', '2017-11-14', 0, 69, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(76, 1, 75, 'FILTRO', '2017-11-14', 0, 70, 1, 1, 2, 'INVENTARIO INICIAL', 5),
(77, 1, 71, 'FILTRO', '2017-11-14', 0, 71, -1, 2, 1, 'MAL AJUSTE EL REAL ES SOLAMENTE 1', 5),
(78, 1, 76, 'FILTRO', '2017-11-14', 0, 72, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(79, 1, 78, 'FILTRO', '2017-11-14', 0, 73, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(80, 1, 79, 'FILTRO', '2017-11-14', 0, 74, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(81, 1, 80, 'FILTRO', '2017-11-14', 0, 75, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(82, 1, 81, 'FILTRO', '2017-11-14', 0, 76, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(83, 1, 82, 'FILTRO', '2017-11-14', 0, 77, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(84, 1, 83, 'FILTRO', '2017-11-14', 0, 78, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(85, 1, 84, 'FILTRO', '2017-11-14', 0, 79, 3, 0, 3, 'INVENTARIO INICIAL', 5),
(86, 1, 86, 'FILTRO', '2017-11-14', 0, 80, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(87, 1, 87, 'FILTRO', '2017-11-14', 0, 81, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(88, 1, 88, 'FILTRO', '2017-11-14', 0, 82, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(89, 1, 89, 'FILTRO', '2017-11-14', 0, 83, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(90, 1, 90, 'FILTRO', '2017-11-14', 0, 84, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(91, 1, 91, 'FILTRO', '2017-11-14', 0, 85, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(92, 1, 92, 'FILTRO', '2017-11-14', 0, 86, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(93, 1, 93, 'FILTRO', '2017-11-14', 0, 87, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(94, 1, 94, 'FILTRO', '2017-11-14', 0, 88, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(95, 1, 95, 'FILTRO', '2017-11-14', 0, 89, 4, 0, 4, 'INVENTARIO INICIAL', 5),
(96, 1, 97, 'FILTRO', '2017-11-14', 0, 90, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(97, 1, 98, 'FILTRO', '2017-11-14', 0, 91, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(98, 1, 99, 'FILTRO', '2017-11-14', 0, 92, 2, 0, 2, 'INVENTARIO INICIAL', 5),
(99, 1, 7, 'FILTRO', '2017-11-14', 0, 93, 1, 3, 4, 'INVENTARIO INICIAL\r\n', 5),
(100, 1, 57, 'FILTRO', '2017-11-14', 0, 94, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(101, 1, 68, 'FILTRO', '2017-11-14', 0, 95, 1, 0, 1, 'INVENTARIO INICIAL', 5),
(102, 1, 80, 'FILTRO', '2017-11-14', 0, 96, 4, 3, 7, 'INVENTARIO INICIAL', 5),
(103, 1, 80, 'Requisition# 7', '2017-11-14', 0, 0, -1, 7, 6, 'Work Order#  and Requisition# 7', 5),
(104, 1, 57, 'Requisition# 7', '2017-11-14', 0, 0, -1, 1, 0, 'Work Order#  and Requisition# 7', 5),
(105, 1, 68, 'Requisition# 7', '2017-11-14', 0, 0, -1, 1, 0, 'Work Order#  and Requisition# 7', 5),
(106, 1, 7, 'Requisition# 7', '2017-11-14', 0, 0, -1, 4, 3, 'Work Order#  and Requisition# 7', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `id_type` int(11) NOT NULL,
  `manufacturer` varchar(200) NOT NULL,
  `manufacturer_num` varchar(100) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  `rowbin` varchar(200) NOT NULL,
  `unitofmeasure` varchar(100) NOT NULL,
  `lastunitcost` float NOT NULL,
  `barcode` varchar(200) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=103 ;

--
-- Volcado de datos para la tabla `items`
--

INSERT INTO `items` (`id`, `description`, `id_type`, `manufacturer`, `manufacturer_num`, `id_warehouse`, `rowbin`, `unitofmeasure`, `lastunitcost`, `barcode`, `stat`) VALUES
(1, 'LIEBHERR 10012450', 1, 'LIEBHERR', '10012450', 0, '', 'PIEZA', 0, '10012450', 1),
(2, 'LIEBHERR 10032835', 1, 'LIEBHERR', '10032835', 0, '', 'PIEZA', 0, '10032835', 1),
(3, 'LIEBHERR 10044373', 1, 'LIEBHERR', '10044373', 0, '', 'PIEZA', 0, '10044373', 1),
(4, 'LIEBHERR 10278553', 1, 'LIEBHERR', '10278553', 0, '', 'PIEZA', 0, '10278553', 1),
(5, 'LIEBHERR 10278562', 1, 'LIEBHERR', '10278562', 0, '', 'PIEZA', 0, '10278562', 1),
(6, 'LIEBHERR 10429946', 1, 'LIEBHERR', '10429946', 0, '', 'PIEZA', 0, '10429946', 1),
(7, 'BALDWIN 151-30', 1, 'BALDWIN', '151-30', 0, '', 'PIEZA', 0, 'N/A', 1),
(8, 'BALDWIN B236', 1, 'BALDWIN', 'B236', 0, '', 'PIEZA', 0, 'N/A', 1),
(9, 'BALDWIN B252', 1, 'BALDWIN', 'B252', 0, '', 'PIEZA', 0, 'N/A', 1),
(10, 'BALDWIN B7171', 1, 'BALDWIN', 'B7171', 0, '', 'PIEZA', 0, 'N/A', 1),
(11, 'BALDWIN B7174-MPG', 1, 'BALDWIN', 'B7174-MPG', 0, '', 'PIEZA', 0, 'N/A', 1),
(12, 'BALDWIN B7177', 1, 'BALDWIN', 'B7177', 0, '', 'PIEZA', 0, 'N/A', 1),
(13, 'BALDWIN B76', 1, 'BALDWIN', 'B76', 0, '', 'PIEZA', 0, 'N/A', 1),
(14, 'BALDWIN BF7888', 1, 'BALDWIN', 'BF7888', 0, '', 'PIEZA', 0, 'N/A', 1),
(15, 'BALDWIN B99', 1, 'BALDWIN', 'B99', 0, '', 'PIEZA', 0, 'N/A', 1),
(16, 'BALDWIN BA5374', 1, 'BALDWIN', 'BA5374', 0, '', 'PIEZA', 0, 'N/A', 1),
(17, 'BALDWIN BD103', 1, 'BALDWIN', 'BD103', 0, '', 'PIEZA', 0, 'N/A', 1),
(18, 'BALDWIN BD7154-MPG', 1, 'BALDWIN', 'BD7154-MPG', 0, '', 'PIEZA', 0, 'N/A', 1),
(19, 'BALDWIN BF1212', 1, 'BALDWIN', 'BF1212', 0, '', 'PIEZA', 0, 'N/A', 1),
(20, 'BALDWIN BF1216', 1, 'BALDWIN', 'BF1216', 0, '', 'PIEZA', 0, 'N/A', 1),
(21, 'BALDWIN BF1223-0', 1, 'BALDWIN', 'BF1223-0', 0, '', 'PIEZA', 0, 'N/A', 1),
(22, 'BALDWIN BF1226', 1, 'BALDWIN', 'BF1226', 0, '', 'PIEZA', 0, 'N/A', 1),
(23, 'BALDWIN BF1259', 1, 'BALDWIN', 'BF1259', 0, '', 'PIEZA', 0, 'N/A', 1),
(24, 'BALDWIN BF1280', 1, 'BALDWIN', 'BF1280', 0, '', 'PIEZA', 0, 'N/A', 1),
(25, 'BALDWIN BF1329-0', 1, 'BALDWIN', 'BF1329-', 0, '', 'PIEZA', 0, 'N/A', 1),
(26, 'BALDWIN BF1345', 1, 'BALDWIN', 'BF1345', 0, '', 'PIEZA', 0, 'N/A', 1),
(27, 'BALDWIN BF1385-SP', 1, 'BALDWIN', 'BF1385-SPS', 0, '', 'PIEZA', 0, 'N/A', 1),
(28, 'BALDWIN BF1390-0', 1, 'BALDWIN', 'BF1390-0', 0, '', 'PIEZA', 0, 'N/A', 1),
(29, 'BALDWIN BF5800', 1, 'BALDWIN', 'BF5800', 0, '', 'PIEZA', 0, 'N/A', 1),
(30, 'BALDWIN BF584', 1, 'BALDWIN', 'BF584', 0, '', 'PIEZA', 0, 'N/A', 1),
(31, 'BALDWIN BF596', 1, 'BALDWIN', 'BF596', 0, '', 'PIEZA', 0, 'N/A', 1),
(32, 'BALDWIN B7024', 1, 'BALDWIN', 'B7024', 0, '', 'PIEZA', 0, 'N/A', 1),
(33, 'BALDWIN BF7577', 1, 'BALDWIN', 'BF7577', 0, '', 'PIEZA', 0, 'N/A', 1),
(34, 'BALDWIN BF7587', 1, 'BALDWIN', 'BF7587', 0, '', 'PIEZA', 0, 'N/A', 1),
(35, 'BALDWIN BF7634', 1, 'BALDWIN', 'BF7634', 0, '', 'PIEZA', 0, 'N/A', 1),
(36, 'BALDWIN BF7656', 1, 'BALDWIN', 'BF7656', 0, '', 'PIEZA', 0, 'N/A', 1),
(37, 'BALDWIN BF7657', 1, 'BALDWIN', 'BF7657', 0, '', 'PIEZA', 0, 'N/A', 1),
(38, 'BALDWIN BF7813', 1, 'BALDWIN', 'BF7813', 0, '', 'PIEZA', 0, 'N/A', 1),
(39, 'BALDWIN BF7814', 1, 'BALDWIN', 'BF7814', 0, '', 'PIEZA', 0, 'N/A', 1),
(40, 'BALDWIN BF789', 1, 'BALDWIN', 'BF789', 0, '', 'PIEZA', 0, 'N/A', 1),
(41, 'BALDWIN BF7912', 1, 'BALDWIN', 'BF7912', 0, '', 'PIEZA', 0, 'N/A', 1),
(42, 'BALDWIN BF7922', 1, 'BALDWIN', 'BF7922', 0, '', 'PIEZA', 0, 'N/A', 1),
(43, 'BALDWIN BF957', 1, 'BALDWIN', 'BF957', 0, '', 'PIEZA', 0, 'N/A', 1),
(44, 'BALDWIN BF970', 1, 'BALDWIN', 'BF970', 0, '', 'PIEZA', 0, 'N/A', 1),
(45, 'BALDWIN BF976', 1, 'BALDWIN', 'BF976', 0, '', 'PIEZA', 0, 'N/A', 1),
(46, 'BALWIN BT359', 1, 'BALDWIN', 'BT359', 0, '', 'PIEZA', 0, 'N/A', 1),
(47, 'BALDWIN BT388-10', 1, 'BALDWIN', 'BT388-10', 0, '', 'PIEZA', 0, 'N/A', 1),
(48, 'BALDWIN BT8309-MPG', 1, 'BALDWIN', 'BT8309-MPG', 0, '', 'PIEZA', 0, 'N/A', 1),
(49, 'BALDWIN BT8426-MPG', 1, 'BALDWIN', 'BT8426-MPG', 0, '', 'PIEZA', 0, 'N/A', 1),
(50, 'BALDWIN BT9422', 1, 'BALDWIN', 'BT9422', 0, '', 'PIEZA', 0, 'N/A', 1),
(51, 'BALDWIN BW5071', 1, 'BALDWIN', 'BW5071', 0, '', 'PIEZA', 0, 'N/A', 1),
(52, 'BALDWIN BW5073', 1, 'BALDWIN', 'BW5073', 0, '', 'PIEZA', 0, 'N/A', 1),
(53, 'BALDWIN BW5137', 1, 'BALDWIN', 'BW5137', 0, '', 'PIEZA', 0, 'N/A', 1),
(54, 'BALDWEIN BW5139', 1, 'BALDWIN', 'BW5139', 0, '', 'PIEZA', 0, 'N/A', 1),
(55, 'BALDWIN BW5178', 1, 'BALDWIN', 'BW5178', 0, '', 'PIEZA', 0, 'N/A', 1),
(56, 'BALDWIN DHLE 31E9-01226', 1, 'BALDWIN', '31E9-0126', 0, '', 'PIEZA', 0, 'N/A', 1),
(57, 'BALDWIN P7188', 1, 'BALDWIN', 'P7188', 0, '', 'PIEZA', 0, 'N/A', 1),
(58, 'BALDWIN P7190', 1, 'BALDWIN', 'P7190', 0, '', 'PIEZA', 0, 'N/A', 1),
(59, 'BALDWIN P7190', 1, 'BALDWIN', 'P7190', 0, '', 'PIEZA', 0, 'N/A', 1),
(60, 'BALDWIN P7192', 1, 'BALDWIN', 'P7192', 0, '', 'PIEZA', 0, 'N/A', 1),
(61, 'BALDWIN P7199', 1, 'BALDWIN', 'P7199', 0, '', 'PIEZA', 0, 'N/A', 1),
(62, 'BALDWIN P999-HD ', 1, 'BALDWIN', 'P999-HD', 0, '', 'PIEZA', 0, 'N/A', 1),
(63, 'BALDWIN PA1637', 1, 'BALDWIN', 'PA1637', 0, '', 'PIEZA', 0, 'N/A', 1),
(64, 'BALDWIN0PA1846', 1, 'BALDWIN', 'PA1846', 0, '', 'PIEZA', 0, 'N/A', 1),
(65, 'BALDWIN PA2445', 1, 'BALDWIN', 'PA2445', 0, '', 'PIEZA', 0, 'N/A', 1),
(66, 'BALDWIN PA2456', 1, 'BALDWIN', 'PA2456', 0, '', 'PIEZA', 0, 'N/A', 1),
(67, 'BALDWIN PA2457', 1, 'BALDWIN', 'PA2457', 0, '', 'PIEZA', 0, 'N/A', 1),
(68, 'BALDWIN PA2475', 1, 'BALDWIN', 'PA2475', 0, '', 'PIEZA', 0, 'N/A', 1),
(69, 'BALDWIN PA2650', 1, 'BALDWIN', 'PA2650', 0, '', 'PIEZA', 0, 'N/A', 1),
(70, 'BALDWIN PA2680', 1, 'BALDWIN', 'PA2680', 0, '', 'PIEZA', 0, 'N/A', 1),
(71, 'BALDWIN PA2729', 1, 'BALDWIN', 'PA2729', 0, '', 'PIEZA', 0, 'N/A', 1),
(72, 'BALDWIN PA2776', 1, 'BALDWIN', 'PA2776', 0, '', 'PIEZA', 0, 'N/A', 1),
(73, 'BALDWIN PA2797', 1, 'BALDWIN', 'PA2797', 0, '', 'PIEZA', 0, 'N/A', 1),
(74, 'BALDWIN PA2797', 1, 'BALDWIN', 'PA2797', 0, '', 'PIEZA', 0, 'N/A', 1),
(75, 'BALDWIN PA3494', 1, 'BALDWIN', 'PA3494', 0, '', 'PIEZA', 0, 'N/A', 1),
(76, 'BALDWIN PA3844', 1, 'BALDWIN', 'PA3844', 0, '', 'PIEZA', 0, 'N/A', 1),
(77, 'BALDWIN PA3899', 1, 'BALDWIN', 'PA3899', 0, '', 'PIEZA', 0, 'N/A', 1),
(78, 'BALDWIN PA3898', 1, 'BALDWIN', 'PA3898', 0, '', 'PIEZA', 0, 'N/A', 1),
(79, 'BALDWIN PF7680', 1, 'BALDWIN', 'PF7620', 0, '', 'PIEZA', 0, 'N/A', 1),
(80, 'BALDWIN PF7735', 1, 'BALDWIN', 'PF7735', 0, '', 'PIEZA', 0, 'N/A', 1),
(81, 'BALDWIN PF7761', 1, 'BALDWIN', 'PF7761', 0, '', 'PIEZA', 0, 'N/A', 1),
(82, 'BALDWIN PF7878', 1, 'BALDWIN', 'PF7878', 0, '', 'PIEZA', 0, 'N/A', 1),
(83, 'BALDWIN PF7890', 1, 'BALDWIN', 'PF7890', 0, '', 'PIEZA', 0, 'N/A', 1),
(84, 'BALDWIN PF7890-30', 1, 'BALDWIN', 'PF7890-30', 0, '', 'PIEZA', 0, 'N/A', 1),
(85, 'BALDWIN PF7935', 1, 'BALDWIN', 'PF7935', 0, '', 'PIEZA', 0, 'N/A', 1),
(86, 'BALDWIN PT543 KIT', 1, 'BALDWIN', 'PT543 KIT', 0, '', 'PIEZA', 0, 'N/A', 1),
(87, 'BALDWIN PT9394-MPG', 1, 'BALDWIN', 'PT9394-MPG', 0, '', 'PIEZA', 0, 'N/A', 1),
(88, 'BALDWIN RS30168', 1, 'BALDWIN', 'RS30168', 0, '', 'PIEZA', 0, 'N/A', 1),
(89, 'BALDWIN RS3722', 1, 'BALDWIN', 'RS3722', 0, '', 'PIEZA', 0, 'N/A', 1),
(90, 'BALDWIN RS3740', 1, 'BALDWIN', 'RS3740', 0, '', 'PIEZA', 0, 'N/A', 1),
(91, 'BALDWIN RS3744', 1, 'BALDWIN', 'RS3744', 0, '', 'PIEZA', 0, 'N/A', 1),
(92, 'BALDWIN RS3745', 1, 'BALDWIN', 'RS3745', 0, '', 'PIEZA', 0, 'N/A', 1),
(93, 'BALDWIN RS3748', 1, 'BALDWIN', 'RS3748', 0, '', 'PIEZA', 0, 'N/A', 1),
(94, 'BALDWIN RS3992', 1, 'BALDWIN', 'RS3992', 0, '', 'PIEZA', 0, 'N/A', 1),
(95, 'BALDWIN RS3993', 1, 'BALDWIN', 'RS3993', 0, '', 'PIEZA', 0, 'N/A', 1),
(96, 'BALDWIN RS4584', 1, 'BALDWIN', 'RS4584', 0, '', 'PIEZA', 0, 'N/A', 1),
(97, 'BALDWIN RS4634', 1, 'BALDWIN', 'RS4634', 0, '', 'PIEZA', 0, 'N/A', 1),
(98, 'BALDWIN RS5470', 1, 'BALDWIN', 'RS5470', 0, '', 'PIEZA', 0, 'N/A', 1),
(99, 'BALDWIN RS5534', 1, 'BALDWIN', 'RS5534', 0, '', 'PIEZA', 0, 'N/A', 1),
(100, 'FILTRO DE ACEITE LFP805-L-FINER', 10, 'SERVICENTRO ASIA CENTER', 'LFP-805', 0, '', 'PIEZA', 0, 'N/A', 1),
(101, 'FILTRO DE AIRE OK6BO-23-603-OKIYA', 10, 'SERVICENTRO ASIA CENTER', 'OK6BO-23-603', 0, '', 'PIEZA', 0, 'N/A', 1),
(102, 'FILTRO DE DIESEL MB220900-OKIYA', 10, 'SERVICENTRO ASIA CENTER', 'MB220900', 0, '', 'PIEZA', 0, 'N/A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_types`
--

CREATE TABLE IF NOT EXISTS `item_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `item_types`
--

INSERT INTO `item_types` (`id`, `description`, `stat`) VALUES
(1, 'FILTROS GRUAS', 1),
(2, 'BATERIAS', 1),
(3, 'ACEITES', 1),
(4, 'LLANTAS', 1),
(5, 'GRASAS', 1),
(6, 'HERRAMIENTAS', 1),
(7, 'EXTINTORES', 1),
(8, 'REPUESTOS', 1),
(9, 'FILTROS MULAS', 1),
(10, 'FILTROS AUTOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticketid` int(11) NOT NULL,
  `project` varchar(250) NOT NULL,
  `id_contact` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `starttime` time NOT NULL,
  `estimatedate` date NOT NULL,
  `estimatetime` time NOT NULL,
  `deliverydate` date NOT NULL,
  `deliverytime` time NOT NULL,
  `actualenddate` date NOT NULL,
  `actualendtime` time NOT NULL,
  `status` int(11) NOT NULL,
  `contact` varchar(250) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address1` varchar(1000) NOT NULL,
  `address2` varchar(1000) NOT NULL,
  `notes` varchar(500) NOT NULL,
  `liftprovidedby` tinyint(1) NOT NULL,
  `providor` varchar(250) NOT NULL,
  `unit` int(11) NOT NULL,
  `loadweight` varchar(50) NOT NULL,
  `loadlength` varchar(50) NOT NULL,
  `loadwidth` varchar(50) NOT NULL,
  `loadheight` varchar(50) NOT NULL,
  `loadradius` varchar(50) NOT NULL,
  `obstructionlength` varchar(50) NOT NULL,
  `obstructionwidth` varchar(50) NOT NULL,
  `obstructionheight` varchar(50) NOT NULL,
  `liftdepth` varchar(50) NOT NULL,
  `setupdistance` varchar(50) NOT NULL,
  `travelp` int(11) NOT NULL,
  `streetusep` int(11) NOT NULL,
  `cityp` int(11) NOT NULL,
  `countryp` int(11) NOT NULL,
  `statep` int(11) NOT NULL,
  `miscellaneousp` int(11) NOT NULL,
  `jobdesc` varchar(1000) NOT NULL,
  `jobcomments` varchar(1000) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs_resource_employee`
--

CREATE TABLE IF NOT EXISTS `jobs_resource_employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_job` int(11) NOT NULL,
  `id_employee` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs_resource_vehicle`
--

CREATE TABLE IF NOT EXISTS `jobs_resource_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_job` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(200) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `location`
--

INSERT INTO `location` (`id`, `description`, `stat`) VALUES
(1, 'MILLA8 - ALMACEN#1', 1),
(2, 'MILLA8 - ALMACEN#2', 1),
(3, 'MILLA8 - ALMACEN#3', 1),
(4, 'BUENAVISTA - ALMACEN#1', 1),
(5, 'BUENAVISTA - ALMACEN#2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `odometer_history`
--

CREATE TABLE IF NOT EXISTS `odometer_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_record` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  `id_vehsection` int(11) NOT NULL,
  `fuelDate` date NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` datetime NOT NULL,
  `odometer` float NOT NULL,
  `enginehour` float NOT NULL,
  `createdOn` datetime NOT NULL,
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `odometer_history`
--

INSERT INTO `odometer_history` (`id`, `id_record`, `id_vehicle`, `id_vehsection`, `fuelDate`, `type`, `date`, `odometer`, `enginehour`, `createdOn`, `createdBy`) VALUES
(2, 2, 68, 1, '2017-11-01', 'Fuel', '0000-00-00 00:00:00', 2000, 2, '2017-11-13 04:58:54', 1),
(3, 2, 12, 1, '0000-00-00', 'WorkOrder', '0000-00-00 00:00:00', 46695, 0, '2017-11-14 02:49:36', 5),
(4, 2, 12, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 46695, 46695, '2017-11-14 02:51:38', 5),
(5, 3, 16, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 71258, 0, '2017-11-14 02:54:22', 5),
(6, 4, 65, 2, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 0, 4539, '2017-11-14 02:55:31', 5),
(7, 5, 11, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 44552, 0, '2017-11-14 02:56:34', 5),
(8, 6, 4, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 129122, 0, '2017-11-14 02:57:23', 5),
(9, 7, 29, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 20823, 0, '2017-11-14 02:58:25', 5),
(10, 8, 43, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 4850, 0, '2017-11-14 02:59:25', 5),
(11, 9, 42, 1, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 4787, 0, '2017-11-14 03:00:07', 5),
(12, 10, 54, 2, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 0, 2525, '2017-11-14 03:01:13', 5),
(13, 11, 57, 2, '2017-11-14', 'Fleet', '0000-00-00 00:00:00', 0, 1452, '2017-11-14 03:02:11', 5),
(14, 3, 16, 1, '0000-00-00', 'WorkOrder', '0000-00-00 00:00:00', 71258, 0, '2017-11-14 03:04:21', 5),
(15, 4, 65, 2, '0000-00-00', 'WorkOrder', '0000-00-00 00:00:00', 0, 4539, '2017-11-14 03:07:03', 5),
(16, 5, 12, 1, '0000-00-00', 'WorkOrder', '0000-00-00 00:00:00', 46695, 46695, '2017-11-14 03:42:19', 5),
(17, 3, 3, 1, '2017-11-15', 'Fuel', '0000-00-00 00:00:00', 3000, 17546, '2017-11-15 03:16:22', 5),
(18, 4, 31, 1, '2017-10-12', 'Fuel', '0000-00-00 00:00:00', 8603, 0, '2017-11-15 06:37:24', 5),
(19, 5, 69, 1, '2017-10-12', 'Fuel', '0000-00-00 00:00:00', 0, 0, '2017-11-15 06:40:52', 5),
(20, 6, 50, 1, '2017-10-13', 'Fuel', '0000-00-00 00:00:00', 6661, 0, '2017-11-15 06:42:44', 5),
(21, 7, 37, 1, '2017-10-13', 'Fuel', '0000-00-00 00:00:00', 207275, 650, '2017-11-15 07:00:38', 5),
(22, 12, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 08:46:15', 5),
(23, 13, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 08:53:04', 5),
(24, 14, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 08:54:51', 5),
(25, 15, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 08:57:17', 5),
(26, 16, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 09:37:04', 5),
(27, 17, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 09:43:17', 5),
(28, 18, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 09:44:38', 5),
(29, 19, 59, 2, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 09:46:30', 5),
(30, 20, 59, 1, '2017-11-15', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-15 09:47:40', 5),
(31, 21, 45, 1, '2017-11-16', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-16 02:50:31', 5),
(32, 22, 45, 1, '2017-11-16', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-16 02:51:33', 5),
(33, 23, 45, 2, '2017-11-16', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-16 02:52:30', 5),
(34, 24, 45, 1, '2017-11-16', 'Fleet', '0000-00-00 00:00:00', 0, 0, '2017-11-16 02:53:25', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proposal_note`
--

CREATE TABLE IF NOT EXISTS `proposal_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `coverletter` text NOT NULL,
  `proposalnote` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `proposal_note`
--

INSERT INTO `proposal_note` (`id`, `coverletter`, `proposalnote`) VALUES
(1, 'this is dumy', 'this is proposal note');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_detail`
--

CREATE TABLE IF NOT EXISTS `purchase_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_po` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qty` float NOT NULL,
  `unitmeasure` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `amount` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `po_no` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_warehouse` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `wo_no` int(11) NOT NULL,
  `department` varchar(200) NOT NULL,
  `request_by` int(11) NOT NULL,
  `terms` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  `unittoal` float NOT NULL,
  `discount` float NOT NULL,
  `taxval` float NOT NULL,
  `grandtotal` float NOT NULL,
  `isReceived` tinyint(1) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receive_detail`
--

CREATE TABLE IF NOT EXISTS `receive_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ro` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qty` float NOT NULL,
  `unitmeasure` varchar(100) NOT NULL,
  `cost` float NOT NULL,
  `amount` int(11) NOT NULL,
  `RecvQty` float NOT NULL,
  `AisleRowBin` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `receive_order`
--

CREATE TABLE IF NOT EXISTS `receive_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_warehouse` int(11) NOT NULL,
  `po_no` int(11) NOT NULL,
  `receive_date` date NOT NULL,
  `receive_by` int(11) NOT NULL,
  `reference` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `renewal_reminder`
--

CREATE TABLE IF NOT EXISTS `renewal_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `reason` varchar(250) NOT NULL,
  `duedate` date NOT NULL,
  `tiemthreshold` int(11) NOT NULL,
  `timethresholdopt` varchar(50) NOT NULL,
  `emailsubscribed` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `renewal_reminder`
--

INSERT INTO `renewal_reminder` (`id`, `id_vehicle`, `reason`, `duedate`, `tiemthreshold`, `timethresholdopt`, `emailsubscribed`, `createdOn`, `stat`) VALUES
(1, 7, 'placa', '0000-00-00', 4, 'Day', 'plataformas@salernoheavylift.com', '2017-11-08 08:21:08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisition`
--

CREATE TABLE IF NOT EXISTS `requisition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_warehouse` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `wo_no` int(11) NOT NULL,
  `department` varchar(200) NOT NULL,
  `request_by` int(11) NOT NULL,
  `notes` varchar(1000) NOT NULL,
  `is_Approved` tinyint(1) NOT NULL,
  `entry_by` int(11) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `requisition`
--

INSERT INTO `requisition` (`id`, `id_warehouse`, `request_date`, `wo_no`, `department`, `request_by`, `notes`, `is_Approved`, `entry_by`, `stat`) VALUES
(4, 1, '2017-11-14', 3, 'taller', 9, 'PARA MANTENIMIENTO DEL KIA K2700 AI5757\r\nSOLICITADO POR TEOFILO VIVIES                     \r\nAYUDANTE: FELICITO MARTINEZ', 1, 5, 1),
(6, 1, '2017-11-14', 5, 'taller', 9, 'PARA MANTENIMIENTO DEL KIA K2700 AI5755\r\nSOLICITADO POR TEOFILO VIVIES                     \r\nAYUDANTE: FELICITO MARTINEZ', 1, 5, 1),
(7, 1, '2017-11-14', 4, 'taller', 9, 'PARA MANTENIMIENTO DEL MOTOR SUPER DE LA GMK-6250', 1, 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `requisition_detail`
--

CREATE TABLE IF NOT EXISTS `requisition_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_req` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `itmdesc` varchar(200) NOT NULL,
  `stock` float NOT NULL,
  `qty` float NOT NULL,
  `buy` float NOT NULL,
  `unitmeasure` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `requisition_detail`
--

INSERT INTO `requisition_detail` (`id`, `id_req`, `id_item`, `itmdesc`, `stock`, `qty`, `buy`, `unitmeasure`) VALUES
(1, 1, 1, 'LIEBHERR 10012450', 0, 1, 1, 'pieces'),
(2, 1, 2, 'LIEBHERR 10032835', 0, 2, 2, 'pieces'),
(3, 2, 1, 'LIEBHERR 10012450', 0, 1, 1, 'pieces'),
(4, 3, 1, 'LIEBHERR 10012450', 0, 3, 3, 'pieces'),
(8, 5, 1, 'LIEBHERR 10012450', 0, 4, 4, 'pieces'),
(9, 4, 100, 'FILTRO DE ACEITE LFP805-L-FINER', 2, 1, 0, 'pieces'),
(10, 4, 101, 'FILTRO DE AIRE OK6BO-23-603-OKIYA', 2, 1, 0, 'pieces'),
(11, 4, 102, 'FILTRO DE DIESEL MB220900-OKIYA', 2, 1, 0, 'pieces'),
(12, 6, 100, 'FILTRO DE ACEITE LFP805-L-FINER', 2, 1, 0, 'pieces'),
(13, 6, 101, 'FILTRO DE AIRE OK6BO-23-603-OKIYA', 2, 1, 0, 'pieces'),
(14, 6, 102, 'FILTRO DE DIESEL MB220900-OKIYA', 2, 1, 0, 'pieces'),
(15, 7, 80, 'BALDWIN PF7735', 3, 1, 0, 'pieces'),
(16, 7, 57, 'BALDWIN P7188', 1, 1, 0, 'pieces'),
(17, 7, 68, 'BALDWIN PA2475', 1, 1, 0, 'pieces'),
(18, 7, 7, 'BALDWIN 151-30', 4, 1, 0, 'pieces');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(500) NOT NULL,
  `price` float NOT NULL,
  `tax` tinyint(1) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_agreement`
--

CREATE TABLE IF NOT EXISTS `service_agreement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customtext` varchar(2000) NOT NULL,
  `label` varchar(250) NOT NULL,
  `pricenote1` varchar(2000) NOT NULL,
  `pricenote2` varchar(2000) NOT NULL,
  `signHeader` varchar(2000) NOT NULL,
  `signFooter` varchar(2000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_reminder`
--

CREATE TABLE IF NOT EXISTS `service_reminder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `service` varchar(200) NOT NULL,
  `meterinterval` int(11) NOT NULL,
  `tieminterval` int(11) NOT NULL,
  `timeintervalopt` varchar(50) NOT NULL,
  `meterthreshold` int(11) NOT NULL,
  `tiemthreshold` int(11) NOT NULL,
  `timethresholdopt` varchar(50) NOT NULL,
  `emailsubscribed` text NOT NULL,
  `createdOn` datetime NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `service_reminder`
--

INSERT INTO `service_reminder` (`id`, `id_vehicle`, `service`, `meterinterval`, `tieminterval`, `timeintervalopt`, `meterthreshold`, `tiemthreshold`, `timethresholdopt`, `emailsubscribed`, `createdOn`, `stat`) VALUES
(1, 3, 'MANT', 8000, 2, 'Month', 69000, 1, 'Day', 'plataformas@salernohevylift.com', '2017-11-08 08:19:33', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_transfer`
--

CREATE TABLE IF NOT EXISTS `stock_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_warehouse` int(11) NOT NULL,
  `id_warehouseTo` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `delivery_date` date NOT NULL,
  `request_by` int(11) NOT NULL,
  `authorize_by` int(11) NOT NULL,
  `createdOn` datetime NOT NULL,
  `entry_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock_transfer_detail`
--

CREATE TABLE IF NOT EXISTS `stock_transfer_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `qty` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `website` varchar(500) NOT NULL,
  `contactname` varchar(100) NOT NULL,
  `cellno` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address1` varchar(500) NOT NULL,
  `address2` varchar(500) NOT NULL,
  `id_country` int(11) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `thirdparty` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `website`, `contactname`, `cellno`, `email`, `address1`, `address2`, `id_country`, `province`, `city`, `thirdparty`, `stat`) VALUES
(1, 'Distribuidora Iberica', '341', 'www.distribuidoraiberica.com', 'Rafael Pons', '66788599', 'admin@distribuidoraiberica.com', 'aaaaaaa', 'bbbbbbbbbb', 1, 'PANAMA', 'PANAMA', 'sss', 1),
(2, 'Central de Lubricantes, S.A.', '2230090', 'www.bremenautoservice.com', 'Ellis Moran', '6226-8320', 'ellis.moran@bremen.com', 'VÃ­a EspaÃ±a con VÃ­a Brasil, Fte a Farmacias Arrocha', 'Vista Hermosa', 1, 'Panama', 'PanamÃ¡', '', 1),
(3, 'Partes Generales Mackummins, S.A.', '2618239', '', 'JesÃºs DÃ­az', '6672-6405', 'ventas1@pgm.com.pa', 'Via Fernadez de Cordova', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(4, 'Hidroca PanamÃ¡', '304-0300', 'www.hidroca.com.pa', 'asd', '', 'a@d.com', 'Costa del Este, Parque Industrial 2da. Calle a la izquierda, Edificio Hidroca.', 'Plaza Airport Commercial Center, Locales 22,23,24 VÃ­a Domingo DÃ­az, entrando por Villa Catalina', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(5, 'Nat Parts, S.A.', '261-5299', '', 'Yolanda Flores', '', 'natpartsayolanda@cwpanama.net', 'Monte Oscuro, Calle 22', '', 1, '', '', '', 1),
(6, 'Parts Trading Panama Inc.', '315-1656', 'http://www.partstradingpanama.com', 'Eduardo Ramos', '6781-4969', 'd@d.com', 'Calle Justo Lara, Local #3  Albrook, ', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(7, 'Dilupa Panama, S.A.', '229-8766', 'www.dilupa.com', 'Jannia Espinosa', '6575-3926', 'jannia@dilupa.com', 'Vista Hermosa Local #85', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(8, 'Panama Diesel Power, Inc.', '221-5438', 'panamadieselpower.com', 'Victor Ãbrego', '6543-8785', 'vabrego@panamadieselpower.com', 'Calle Novena, Pueblo Nuevo', 'Calle Novena, Pueblo Nuevo', 1, 'PanamÃ¡', 'PanamÃ¡', 'asd', 1),
(9, 'Servicentro Asia Center', '268-9766', '', 'Kenny', '6242-2350', 'asiacenter1@hotmail.com', 'Transistmica principal Diagonal a la entrada de Ciudad Bolivar , Las Cumbres', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(10, 'Bandas y Muelles, S.A.', '261-2469', '', 'Miguel Reyes', '6441-0668', 'vendedor2@bandaymuelle.com', 'VÃ­a SimÃ³n BolÃ­var PanamÃ¡', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(11, 'Ferreteria Industrial S.A.', '368-1800', 'www.feinsa.com/', 'asd', '', 'ventas@feinsa.com', 'Ricardo Miro Guardia (frente a la Barriada Ciudad San Lorenzo) Calzada Larga, El Chungal', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(12, 'Productos Mundiales', '224-8143', '', 'Virginia', '', 'promusaxm@cableonda.net', 'Av Ernesto T Lefevre ', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(13, 'Durallantas, S.A.', '2290603', 'www.durallantas.com', 'Javier Asprilla', '6781-6700', 'asprilla@durallantas.com', 'Avenida 12 de octubre', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(14, 'Proveedora TÃ©cnica, S.A.', '227-3533', 'www.protecsa.com.pa', 'Edgardo Batista', '6480-2288', 'eb@protecsa.com.pa', '', '', 1, '', '', '', 1),
(15, 'Soldadura y Equipo, S.A.', '203-1171', '', 'Madelein Rodriguez.', '6678-4861', 'ventas@seqpanama.com', 'Milla 8, Las Cumbres, Edif. Correagua, Local 001-A', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(16, 'La Casa del Extintor', '217-2345', '', 'Jhoana GonzÃ¡lez', '', 'casa.extintor@gmail.com', 'Villa CÃ¡ceres, Calle M Casa 215', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(17, 'Aceti OxÃ­geno', '270-1977', '', 'Juan Carlos CedeÃ±o', '', 'jcedeno@acetioxigeno.com.pa', 'Boca La Caja, Avenida Principal, Paitilla', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(18, 'Panama Hoses Inc. S.A.', '229-0074', '', 'Polo MarÃ­n', '6673-3204', 'remangsa@yahoo.es', 'Pueblo Nuevo, Calle 15', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(19, 'Mangueras Hidraulicas de PanamÃ¡, S.A.', '392-3228', '', 'Nefertiti', '', 'manpanama@cableonda.net', 'Bethania, Centro Comercial Balid Local 1 y 2', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(20, 'Wurth Centroamerica', '300-2026', 'www.wurth.com.pa', 'Elvin Batista', '6480-5784', 'ebatista@wurth.com.pa', 'Costa del Este, Parque Industrial, Calle Segunda 2da', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(21, 'CorporaciÃ³n Impa Doel, S.A.', '302-1200', '', 'Oscar MarÃ­n', '6678-9707', 'oscar.marin@impadoel.com', 'Av Juan Pablo II', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(22, 'Ferrecentro Universal', '268-0208', '', 'Antonio', '', 'd@d.com', 'La Cabima', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(23, 'Motor Plus Panama, S.A.', '303-3517', '', 'Julio Bovell', '6879-2404', 'ventas5@motorpluspanama.com', 'VÃ­a EspaÃ±a, Centro Comercial Torremolinos locales 9-10', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(24, 'IIASA Panama, S.A.', '275-9173', 'iiasacat.com.pa', 'Marianela Cornejo', '6432-5114', 'cornejo_marianela@iiasacat.com', 'Via Panamaricana (Pacora)', '', 1, '', '', '', 1),
(25, 'F. Icaza y Cia, S.A.', '229-3377', 'www.ficaza.com', 'David Ãbrego', '6151-4948', 'ventas@ficaza.com', 'Carret. Panamericana, via principal Pacora', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(26, 'Global Lube, S.A.', '293-3133', 'www.global-lube.com', 'Rafael Barreto', '6279-4126', 'facturacion@global-lube.com', 'VÃ­a Tocumen, Frente a entrada de Urb. Don Bosco', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(27, 'Metales (Milla 8), S.A.', '300-0004', '', 'ventas.tubotec@gmail.com', '', 'milla8.ventas2@gmail.com', 'Milla 8, Las Cumbres', 'Las Cumbres', 1, 'PanamÃ¡', 'PanamÃ¡', 'asd', 1),
(28, 'Servi Joseph', '399-6252', '', 'asd', '', 'd@d.com', 'Las Cumbrecitas, Estacion Texaco Local 2', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(29, 'Victor Salazar', '6752-1012', '', 'Victor Salazar', '6752-1012', 'd@d.com', 'Chilibre', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(30, 'Alexander Madrid', '6690-5562', '', 'Alexander Madrid', '6690-5562', 'd@d.com', '', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(31, 'JosÃ© Campbell', 'JosÃ© Campbell', '', 'JosÃ© Campbell', 'JosÃ© Campbell', 'd@d.com', '', '', 1, '', '', '', 1),
(32, 'Herramientas y Tornillos, S.A.', '220-2057', '', 'Pedro RodrÃ­guez', '6346-3396', 'prodriguez@ht.com.pa', 'Parque Lefevre, Calle Ernesto Lefevre', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(33, 'Ricardo PÃ©rez, S.A.', '279-4500', 'www.toyotarp.com', 'Carlos Murgas', '6456-7297', 'cmurgas@toyotarp.com', 'Milla 8, Las Cumbres', 'Las Cumbres', 1, 'PanamÃ¡', 'PanamÃ¡', 'asd', 1),
(34, 'Silaba Motors, S.A.', '230-8900 ', 'www.silaba.com', 'Jonnathan Garcia', '6115-8153', 'jgarcia@silaba.com', 'Entrada de Condado del Rey', 'Tumba Muerto', 1, 'PanamÃ¡', 'PanamÃ¡', 'asd', 1),
(35, 'Motores Japoneses, S.A.', '226-2626', 'www.suzukipan.com', 'Jorge Coto', '', 'repuestos3@suzukipan.com', 'Calle 50 Este y VÃ­a Cincuentenario', 'Avenida Ricardo J Alfaro, frente a MigraciÃ³n', 1, 'PanamÃ¡', 'PanamÃ¡', 'asd', 1),
(36, 'GNG Construction Marine Suppliers, S.A.', '222-4335', 'www.gngpanama.com', 'Hector Rivera', '', 'ventas@gngpanama.com', 'Ofidepositos Costa del Este', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(37, 'Max Industrias', '224-5050', 'max-industrias.com', 'Pedro AraÃºz', '6679-4975', 'pedro.arauz@max-industrias.com', 'Avenida Ernesto T. Lefevre', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(38, 'Cavenguayas PanamÃ¡, S.A.', '273-7950', '', 'Juan Carlos Rojo', '6673 6614', 'jrojo@cavenguayas.com', 'Zona Franca de Panexport. Ojo de Agua. San Miguelito. Galera 7D', '', 1, 'PanamÃ¡', 'PanamÃ¡', '', 1),
(39, 'Estacion Packai, S.A.', '3948698', '', 'Rolando', '65692237', 'na@gmail.com', 'transistmica, milla8', 'las cumbres', 1, 'PANAMA', 'PANAMA', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terms`
--

CREATE TABLE IF NOT EXISTS `terms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_user`
--

CREATE TABLE IF NOT EXISTS `type_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `type_user`
--

INSERT INTO `type_user` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Supervisor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_vehicle`
--

CREATE TABLE IF NOT EXISTS `type_vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `type_vehicle`
--

INSERT INTO `type_vehicle` (`id`, `name`) VALUES
(1, 'Trucks'),
(2, 'Cranes'),
(3, 'Cars');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Last_name` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `Email` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL,
  `stat` int(4) NOT NULL,
  `id_roll_user` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `Name`, `Last_name`, `user`, `Email`, `create_date`, `stat`, `id_roll_user`, `password`) VALUES
(1, 'Administrator', 'dd', 'admin', 'admin@admin.com', '2017-06-03 01:58:58', 1, 1, '3mGZ4LnURKeN+f/j4kdw7eTryPmQVTMo7SvU6+Fc2uY='),
(2, 'Supervisor', 'sp', 'supervisor', 'sp@tt.com', '2017-06-03 12:28:31', 1, 2, 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek='),
(3, 'Katherine', 'Diaz', 'kdiaz', 'mantenimiento@salernoheavylift.com', '2017-08-15 16:51:58', 1, 1, 'K+fBmHr9uCwjE6UTnL57IFDG8NHM6Reb95x+T9pSEfk='),
(4, 'Eliecer', 'Perez', 'xavierP', 'plataforma@salernoheavylift.com', '2017-08-15 17:01:14', 1, 1, 'JDFsxSfg0qU0QJTMY+fqFZRHf9o9fMAzysTCNj6/3Mg='),
(5, 'Eliezer', 'Perez', 'eperez', 'plataformas@salernoheavylift.com', '2017-10-27 19:37:12', 1, 2, 'rEqbiBtYxeOa4ZSRiIuwkVh532h7w2Ldbgtv+UJ47ek=');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `make` varchar(100) NOT NULL,
  `model` varchar(100) NOT NULL,
  `year` varchar(50) NOT NULL,
  `license_plate` varchar(100) NOT NULL,
  `serial_no` varchar(100) NOT NULL,
  `tonnage` varchar(100) NOT NULL,
  `type` int(11) NOT NULL,
  `bare_rental_product` tinyint(1) NOT NULL,
  `hourly_bare` float NOT NULL,
  `daily_bare` float NOT NULL,
  `weekly_bare` float NOT NULL,
  `monthly_bare` float NOT NULL,
  `yearly_bare` int(11) NOT NULL,
  `overtime_bare` float NOT NULL,
  `doubletime_bare` float NOT NULL,
  `traveltime_bare` float NOT NULL,
  `dailyminimum_bare` float NOT NULL,
  `projectminimum_bare` float NOT NULL,
  `manned_rental_product` tinyint(1) NOT NULL,
  `hourly_manned` float NOT NULL,
  `daily_manned` float NOT NULL,
  `weekly_manned` float NOT NULL,
  `monthly_manned` float NOT NULL,
  `yearly_manned` float NOT NULL,
  `overtime_manned` float NOT NULL,
  `doubletime_manned` float NOT NULL,
  `traveltime_manned` float NOT NULL,
  `dailyminimum_manned` float NOT NULL,
  `projectminimum_manned` float NOT NULL,
  `fuelcarrier` varchar(100) NOT NULL,
  `fuelupper` varchar(100) NOT NULL,
  `fuelcapacity1carrier` varchar(100) NOT NULL,
  `fuelcapacity1upper` varchar(100) NOT NULL,
  `fuelcapacity2carrier` varchar(100) NOT NULL,
  `fuelcapacity2upper` varchar(100) NOT NULL,
  `engineoilcarrier` varchar(100) NOT NULL,
  `engineoilupper` varchar(100) NOT NULL,
  `hydraulicoilcarrier` varchar(100) NOT NULL,
  `hydraulicoilupper` varchar(100) NOT NULL,
  `transmissionoilcarrier` varchar(100) NOT NULL,
  `transmissionoilupper` varchar(100) NOT NULL,
  `differentialoilcarrier` varchar(100) NOT NULL,
  `differentialoilupper` varchar(100) NOT NULL,
  `gearoilcarrier` varchar(100) NOT NULL,
  `gearoilupper` varchar(100) NOT NULL,
  `axleoilcarrier` varchar(100) NOT NULL,
  `axleoilupper` varchar(100) NOT NULL,
  `greasecarrier` varchar(100) NOT NULL,
  `greaseupper` varchar(100) NOT NULL,
  `coolantcarrier` varchar(100) NOT NULL,
  `coolantupper` varchar(100) NOT NULL,
  `otherscarrier` varchar(100) NOT NULL,
  `othersupper` varchar(100) NOT NULL,
  `fronttire` varchar(100) NOT NULL,
  `reartire` varchar(100) NOT NULL,
  `fronttirepsi` varchar(100) NOT NULL,
  `reartirepsi` varchar(100) NOT NULL,
  `primarymeter` varchar(10) NOT NULL,
  `odometer` varchar(100) NOT NULL,
  `carrierengine` varchar(100) NOT NULL,
  `upperengine` varchar(100) NOT NULL,
  `wfcarrier` varchar(100) NOT NULL,
  `wfupper` varchar(100) NOT NULL,
  `pfcarrier` varchar(100) NOT NULL,
  `pfupper` varchar(100) NOT NULL,
  `ofcarrier` varchar(100) NOT NULL,
  `ofupper` varchar(100) NOT NULL,
  `ffcarrier` varchar(100) NOT NULL,
  `ffupper` int(100) NOT NULL,
  `hfcarrier` varchar(100) NOT NULL,
  `hfupper` varchar(100) NOT NULL,
  `sfcarrier` varchar(100) NOT NULL,
  `sfupper` varchar(100) NOT NULL,
  `tfcarrier` varchar(100) NOT NULL,
  `tfupper` varchar(100) NOT NULL,
  `afcarrier` varchar(100) NOT NULL,
  `afupper` varchar(100) NOT NULL,
  `gfcarrier` varchar(100) NOT NULL,
  `gfupper` varchar(100) NOT NULL,
  `otfcarrier` varchar(100) NOT NULL,
  `otfupper` varchar(100) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Volcado de datos para la tabla `vehicle`
--

INSERT INTO `vehicle` (`id`, `name`, `make`, `model`, `year`, `license_plate`, `serial_no`, `tonnage`, `type`, `bare_rental_product`, `hourly_bare`, `daily_bare`, `weekly_bare`, `monthly_bare`, `yearly_bare`, `overtime_bare`, `doubletime_bare`, `traveltime_bare`, `dailyminimum_bare`, `projectminimum_bare`, `manned_rental_product`, `hourly_manned`, `daily_manned`, `weekly_manned`, `monthly_manned`, `yearly_manned`, `overtime_manned`, `doubletime_manned`, `traveltime_manned`, `dailyminimum_manned`, `projectminimum_manned`, `fuelcarrier`, `fuelupper`, `fuelcapacity1carrier`, `fuelcapacity1upper`, `fuelcapacity2carrier`, `fuelcapacity2upper`, `engineoilcarrier`, `engineoilupper`, `hydraulicoilcarrier`, `hydraulicoilupper`, `transmissionoilcarrier`, `transmissionoilupper`, `differentialoilcarrier`, `differentialoilupper`, `gearoilcarrier`, `gearoilupper`, `axleoilcarrier`, `axleoilupper`, `greasecarrier`, `greaseupper`, `coolantcarrier`, `coolantupper`, `otherscarrier`, `othersupper`, `fronttire`, `reartire`, `fronttirepsi`, `reartirepsi`, `primarymeter`, `odometer`, `carrierengine`, `upperengine`, `wfcarrier`, `wfupper`, `pfcarrier`, `pfupper`, `ofcarrier`, `ofupper`, `ffcarrier`, `ffupper`, `hfcarrier`, `hfupper`, `sfcarrier`, `sfupper`, `tfcarrier`, `tfupper`, `afcarrier`, `afupper`, `gfcarrier`, `gfupper`, `otfcarrier`, `otfupper`, `stat`, `created_on`) VALUES
(1, 'BMW--1', 'DD--1', 'Latest--1', '2016', 'ang-1000--1', '00099991', 'jjk--1', 2, 0, 21, 31, 41, 51, 61, 71, 81, 91, 101, 111, 1, 121, 131, 141, 151, 161, 171, 181, 191, 201, 211, 'a1', 'aa1', 'b1', 'bb1', 'c1', 'cc1', 'd1', 'dd1', 'e1', 'ee1', 'f1', 'ff1', 'g1', 'gg1', 'h1', 'hh1', 'i1', 'ii1', 'j1', 'jj1', 'k1', 'kk1', 'l1', 'll1', 'Tyre japenese1', 'rear japanese 1', 'front psi1', 'rear psi1', 'hc', '121', '131', '121', 'n1', 'nn1', 'k1', 'kk1', 'l1', 'll1', '', 0, 'd1', 'dd1', 's1', 'ss1', 'a1', 'aa1', 'i1', 'ii1', 'e1', 'ee1', 'w1', 'ww1', 0, '2017-06-04 11:29:07'),
(2, 'GMK5020', 'Grove', 'GMK5020', '2010', 'ap4564', '', '100', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, '2017-08-01 08:39:00'),
(3, 'FORD RANGER-AG2918', 'FORD', 'RANGER', '2013', 'AG2918', '6FPPXXMJ2PDJ86469', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '4053479482514', '1005', '4053479482514', '', '4053479482514', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'hcu', '3000', '17546', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:05:05'),
(4, 'FORD RANGER-AG2919 ', 'FORD', 'RANGER', '2013', 'AG2919', '6FPPXXMJ2PDJ86470', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:06:24'),
(5, 'FORD RANGER-AU7522 ', 'FORD', 'RANGER', '2014', 'AU7522', '6FPPXXMJ2PDG36862', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:07:14'),
(6, 'FORD RANGER-AS8006 ', 'FORD', 'RANGER', '2014', 'AS8006', '6FPPXXMJPDG35215', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:08:27'),
(7, 'HINO-CB9658', 'HINO', 'C300', '2016', 'CB9658', 'JHHAFJ3H6HK005341', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:09:22'),
(8, 'HYUNDAI I10-692401', 'HYUNDAI', 'I10', '2011', '692401', 'MALAM51BABM764786', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:10:31'),
(9, 'HYUNDAI I10-559339', 'HYUNDAI', 'I10', '2009', '559339', 'MALAM51CP9M214017', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:11:22'),
(10, 'KIA K2700-890383', 'KIA', 'K2700', '2013', '890383', 'KNCSHX71AD7667619', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:13:40'),
(11, 'KIA K2700-AI5756', 'KIA', 'K2700', '2017', 'AI5756', 'KNCSHX71AH7049353', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:15:38'),
(12, 'KIA K2700-AI5755', 'KIA', 'K2700', '2017', 'AI5755', 'KNCSHX71AH7049357', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:17:13'),
(13, 'KIA K2700-AP1379', 'KIA', 'K2700', '2015', 'AP1379', 'KNCSHX71AF910619', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:20:49'),
(14, 'KIA K2700-CB4895', 'KIA', 'K2700', '2017', 'CB4895', 'KNCSHX71CH7094932', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:22:11'),
(15, 'KIA K2700-AR0818', 'KIA', 'K2700', '2015', 'AR0818', 'KNCSHX71AF7921362', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:23:25'),
(16, 'KIA K2700-AI5757', 'KIA', 'K2700', '2017', 'AI5757', 'KNCSHX71AH7049356', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:25:00'),
(17, 'KIA K2700-AM6624', 'KIA', 'K2700', '2015', 'AM6624', 'KNCSHX71A7880956', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:26:09'),
(18, 'KIA K2700-AM6564', 'KIA', 'K2700', '2015', 'AM6564', 'KNCSHX71AF7867874', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:27:16'),
(19, 'SUZUKI CELERIO-AM5869', 'SUZUKI', 'CELERIO', '2015', 'AM5869', 'MA3FC31S2FA760353', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:32:37'),
(20, 'SUZUKI CELERIO-AM2428', 'SUZUKI', 'CELERIO', '2015', 'AM2428', 'MA3FC31S5FA738435', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:34:58'),
(21, 'SUZUKI CELERIO-AH8831', 'SUZUKI', 'CELERIO', '2015', 'AH8831', 'MAC3FC31SFFA30796', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:38:08'),
(22, 'SUZUKI ALTO-AM5974', 'SUZUKI', 'ALTO', '2015', 'AM5974', 'MA3FB32S2F0454390', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:39:29'),
(23, 'SUZUKI SWIFT-AM5966', 'SUZUKI', 'SWIFT', '2015', 'AM5966', 'MA3ZC62S7FA671956', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:40:31'),
(24, 'SUZUKI CELERIO-560024', 'SUZUKI', 'CELERIO', '2010', '560024', 'MA3FC31S6AA183576', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:42:09'),
(25, 'SUZUKI SX4-694520', 'SUZUKI', 'SX4', '2009', '694520', 'JSYA21S695102145', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:43:24'),
(26, 'TOYOTA HILUX-813637', 'TOYOTA', 'HILUX', '2013', '813637', 'MROER32G106028170', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:44:20'),
(27, 'TOYOTA HILUX-654280', 'TOYOTA', 'HILUX', '2011', '654280', 'MROER32G706012040', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:46:13'),
(28, 'TOYOTA HILUX-642462', 'TOYOTA', 'HILUX', '2012', '642462', '8AJCR32G000012906', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:47:56'),
(29, 'TOYOTA HILUX-CE0633', 'TOYOTA', 'HILUX', '2016', 'CE0633', 'MROES8DB900183149', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:49:24'),
(30, 'TOYOTA HILUX-AI5067', 'TOYOTA', 'HILUX', '2016', 'AI5067', 'MROESBDD800195116', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:50:17'),
(31, 'KIA K2700-CJ2306', 'KIA', 'K2700', '2017', 'CJ2306', '', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:51:02'),
(32, 'KIA K2700-CJ2307', 'KIA', 'K2700', '2017', 'CJ2307', '', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:51:19'),
(33, 'TOYOTA HILUX-CG2294', 'TOYOTA', 'HILUX', '2017', 'CG2294', '', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-15 01:53:15'),
(34, 'AUTOCAR ROJA AH0675 ', 'AUTOCAR', 'WITHEGMC', '1993', 'AH0675', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:06:47'),
(35, 'INTERNATIONAL 827735', 'INTERNATIONAL', 'TRUCK', '1979', '827735', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:07:38'),
(36, 'KENWORTH 447787', 'KENWORTH', 'C500', '1981', '447787', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:08:20'),
(37, 'KENWORTH NEGRA 485909', 'KENWORTH', 'C500', '1985', '485909', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:09:46'),
(38, 'MACK BLANCA 381900', 'MACK', 'S/N', '2001', '381900', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:10:49'),
(39, 'MACK TADANO 517183', 'MACK', 'TADANO', '1990', '517183', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:11:31'),
(40, 'MACK AMARILLA CE6536', 'MACK', 'GU813E', '2017', 'CE6536', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:12:17'),
(41, 'MACK AMARILLA CE6537', 'MACK', 'GU813E', '2017', 'CE6537', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:12:50'),
(42, 'SIMON ROFT 404887 ', 'SIMON ROFT', 'LT900', '1992', '404887', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:13:29'),
(43, 'AUTOCAR AMARILLA AH7297', 'AUTOCAR', 'ACL-64B', '1989', 'AH7297', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:14:12'),
(44, 'WESTERN STAR AI3482', 'WESTERN STAR', '4964-FX', '1999', 'AI3482', '', '', 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:14:56'),
(45, 'STERLING 388249', 'STERLING', '440', '2000', '388249', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:35:09'),
(46, 'MACK VISION 511480', 'MACK', '600', '2000', '511480', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:36:12'),
(47, 'RT-530/1', 'GROVE', 'RT-530E', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:38:29'),
(48, 'RT-530/2', 'GROVE', 'RT-530E', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:38:50'),
(49, 'RT-880 ', 'GROVE', 'RT-880', '', '', '280260', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:39:11'),
(50, 'LIEBHERR LTM-1040', 'LIEBHERR', 'LTM-1040', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'hcu', '', '12', '34', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:40:13'),
(51, 'LIEBHERR LTM-1050', 'LIEBHERR', 'LTM-1050', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:40:39'),
(52, 'LIEBHERR LTM-1080', 'LIEBHERR', 'LTM-1080', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'hcu', ' ', '1,160', '17,521', 'BW5073', '', 'BF1226', '', 'B236', '', '', 0, '', '', 'BA5374', '', 'BT9422', '', 'PA2776', '', '', '', 'BF970\r\nPA3494', '', 1, '2017-08-16 07:41:17'),
(53, 'LIEBHERR LTM-1100/1', 'LIEBHERR', 'LTM-1100', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:41:54'),
(54, 'LIEBHERR LTM-1100/2', 'LIEBHERR', 'LTM-1100', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:42:12'),
(55, 'LIEBHERR LTM-1200', 'LIEBHERR', 'LTM-1200', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:42:31'),
(56, 'LIEBHERR LTM-1400/1', 'LIEBHERR', 'LTM-1400', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:42:57'),
(57, 'LIEBHERR LTM-1400/2', 'LIEBHERR', 'LTM-1400', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:43:21'),
(58, 'LIEBHERR LR-1600', 'LIEBHERR', 'LR-1600', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:43:46'),
(59, 'GROVE GMK-5100', 'GROVE', 'GMK-5100', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:44:28'),
(60, 'GROVE GMK-5130', 'GROVE', 'GMK-5130', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:44:45'),
(61, 'GROVE GMK-5180', 'GROVE', 'GMK-5180', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:45:14'),
(62, 'GROVE GMK-5210', 'GROVE', 'GMK-5210', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:46:09'),
(63, 'GROVE GMK-5220', 'GROVE', 'GMK-5220', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:46:32'),
(64, 'GROVE GMK-6220L', 'GROVE', 'GMK-6220L', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:49:01'),
(65, 'GROVE GMK-6250', 'GROVE', 'GMK-6250', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 07:52:05'),
(66, 'GROVE GMK-6350', 'GROVE', 'GMK-6350', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-08-16 08:24:01'),
(67, 'FERRARI DAYTONA-123ABC', 'FERRARI', 'DAYTONA', '', '', '', '', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-09-13 04:16:39'),
(68, 'prueba V1', 'make v1', 'modelo v1', '2017', 'qs12', '13', '1d3', 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'kc', '10000', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-11-13 04:48:01'),
(69, 'GROVE TMS760-E', 'GROVE', 'TMS-760E', '', '', '', '', 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, '2017-11-15 06:39:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle_document`
--

CREATE TABLE IF NOT EXISTS `vehicle_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `path` varchar(1000) NOT NULL,
  `createdOn` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `workorder`
--

CREATE TABLE IF NOT EXISTS `workorder` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `wo_no` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  `createdOn` date NOT NULL,
  `id_status` int(11) NOT NULL,
  `id_vehsection` int(11) NOT NULL,
  `odometer` float NOT NULL,
  `enginehour` float NOT NULL,
  `assigneddate` date NOT NULL,
  `completiondate` date NOT NULL,
  `id_priority` int(11) NOT NULL,
  `id_person_change` int(11) NOT NULL,
  `id_especialist1` int(11) NOT NULL,
  `id_especialist2` int(11) NOT NULL,
  `id_especialist3` int(11) NOT NULL,
  `id_especialist4` int(11) NOT NULL,
  `id_especialist5` int(11) NOT NULL,
  `worktoperformed` varchar(250) NOT NULL,
  `relatedIssues` varchar(250) NOT NULL,
  `id_person_change_hr` varchar(50) NOT NULL,
  `especialist1hr` varchar(50) NOT NULL,
  `especialist2hr` varchar(50) NOT NULL,
  `especialist3hr` varchar(50) NOT NULL,
  `especialist4hr` varchar(50) NOT NULL,
  `especialist5hr` varchar(50) NOT NULL,
  `costinparts` varchar(50) NOT NULL,
  `costinthirdparty` varchar(50) NOT NULL,
  `thirdpartylaborhr` varchar(50) NOT NULL,
  `reference` varchar(50) NOT NULL,
  `relatedReq` varchar(500) NOT NULL,
  `isCompleted` tinyint(1) NOT NULL,
  `stat` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `workorder`
--

INSERT INTO `workorder` (`id`, `wo_no`, `id_type`, `id_vehicle`, `createdOn`, `id_status`, `id_vehsection`, `odometer`, `enginehour`, `assigneddate`, `completiondate`, `id_priority`, `id_person_change`, `id_especialist1`, `id_especialist2`, `id_especialist3`, `id_especialist4`, `id_especialist5`, `worktoperformed`, `relatedIssues`, `id_person_change_hr`, `especialist1hr`, `especialist2hr`, `especialist3hr`, `especialist4hr`, `especialist5hr`, `costinparts`, `costinthirdparty`, `thirdpartylaborhr`, `reference`, `relatedReq`, `isCompleted`, `stat`) VALUES
(1, 1, 2, 7, '2017-11-08', 1, 1, 20555, 0, '2017-11-09', '2017-11-09', 2, 9, 0, 0, 0, 0, 0, 'COMPRA DE FILTROS\r\n', '', '', '', '', '', '', '', '', '', '', '', '', 0, 1),
(3, 3, 2, 16, '2017-11-14', 1, 1, 71258, 0, '2017-11-14', '2017-11-14', 2, 9, 7, 0, 0, 0, 0, 'HORA DE SALIDA 10:00 AM\r\nLUGAR: COSTA NORTE', '3', '', '', '', '', '', '', '', '', '', '', '', 0, 1),
(4, 4, 2, 65, '2017-11-14', 1, 2, 0, 4539, '2017-11-14', '2017-11-14', 2, 9, 7, 0, 0, 0, 0, 'HORA DE SALIDA: 10:00 AM\r\nLUGAR: COSTA NORTE', '4', '', '', '', '', '', '', '', '', '', '', '', 0, 1),
(5, 5, 2, 12, '2017-11-14', 1, 1, 46695, 46695, '2017-11-14', '2017-11-14', 2, 9, 7, 0, 0, 0, 0, 'HORA DE SALIDA: 10:00 AM\r\nLUGAR: COSTA NORTE\r\n', '2', '', '', '', '', '', '', '', '', '', '', '', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
