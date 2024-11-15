-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-06-2013 a las 20:08:03
-- Versión del servidor: 5.5.25a
-- Versión de PHP: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bartolo`
--
CREATE DATABASE `bartolo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bartolo`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE IF NOT EXISTS `caja` (
  `nlinea` int(11) NOT NULL AUTO_INCREMENT,
  `numeromesa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `importetotal` double NOT NULL,
  PRIMARY KEY (`nlinea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`nlinea`, `numeromesa`, `fecha`, `hora`, `importetotal`) VALUES
(3, 1, '2013-06-19', '19:24:00', 8.5),
(4, 2, '2013-06-19', '19:36:00', 18.25),
(5, 2, '2013-06-19', '20:06:00', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE IF NOT EXISTS `cuenta` (
  `nlinea` int(11) NOT NULL AUTO_INCREMENT,
  `mesa` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  PRIMARY KEY (`nlinea`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`nlinea`, `mesa`, `cantidad`, `idproducto`) VALUES
(1, 3, 1, 1),
(2, 3, 1, 2),
(3, 3, 1, 3),
(5, 3, 1, 3),
(6, 3, 1, 4),
(7, 3, 1, 10),
(10, 6, 1, 11),
(11, 6, 1, 3),
(12, 6, 1, 1),
(29, 7, 1, 18),
(30, 7, 1, 1),
(31, 7, 1, 20),
(32, 7, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(250) NOT NULL,
  `categoria` varchar(250) NOT NULL,
  `precio` double(5,2) NOT NULL,
  `foto` varchar(250) NOT NULL,
  PRIMARY KEY (`idproducto`),
  UNIQUE KEY `idproducto` (`idproducto`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `nombre`, `categoria`, `precio`, `foto`) VALUES
(1, '7up', 'BEBIDAS', 1.00, '7up.jpg'),
(2, 'cerveza coronita', 'BEBIDAS', 2.00, 'cerveza coronita.jpg'),
(3, 'chipirones', 'APERITIVOS', 3.00, 'chipirones.jpg'),
(4, 'mejillones', 'APERITIVOS', 2.50, 'mejillones.jpg'),
(5, 'hamburguesa', 'SEGUNDOS', 3.50, 'hamburguesa.jpg'),
(6, 'patatas fritas', 'SEGUNDOS', 1.50, 'patatas fritas.jpg'),
(7, 'pimientos', 'PRIMEROS', 2.50, 'pimientos.jpg'),
(8, 'pizza jamon', 'PRIMEROS', 3.00, 'pizza jamon.jpg'),
(9, 'verduras', 'PRIMEROS', 1.75, 'verduras.jpg'),
(10, 'solomillo', 'SEGUNDOS', 5.00, 'solomillo.jpg'),
(11, 'infusion', 'CAFES', 1.00, 'infusion.jpg'),
(12, 'manzanilla', 'CAFES', 1.00, 'manzanilla.jpg'),
(13, 'marisco', 'APERITIVOS', 4.00, 'marisco.jpg'),
(14, 'agua 33', 'BEBIDAS', 1.00, 'agua 33.jpg'),
(15, 'almejas', 'APERITIVOS', 2.50, 'almejas.jpg'),
(16, 'aquarius', 'BEBIDAS', 1.00, 'aquarius.jpg'),
(17, 'cerveza quinto', 'BEBIDAS', 1.75, 'cerveza quinto.jpg'),
(18, 'fanta limon', 'BEBIDAS', 1.00, 'fanta limon.jpg'),
(19, 'cocacola', 'BEBIDAS', 1.00, 'cocacola.jpg'),
(20, 'kas limon', 'BEBIDAS', 1.00, 'kas limon.jpg'),
(21, 'tonica', 'BEBIDAS', 1.00, 'tonica.jpg'),
(22, 'vino blanco', 'BEBIDAS', 3.00, 'vino blanco.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `contrasena` varchar(250) NOT NULL,
  PRIMARY KEY (`contrasena`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
