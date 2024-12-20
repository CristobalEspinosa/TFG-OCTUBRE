-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 23:14:30
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tfg`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `idArticulo` int(11) NOT NULL,
  `articulo` varchar(200) NOT NULL,
  `pvp` float NOT NULL,
  `precioCompra` float NOT NULL,
  `stock` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `articulo`, `pvp`, `precioCompra`, `stock`, `idProveedor`, `idCategoria`, `imagen`) VALUES
(1, 'Café Solo', 1, 0.3, 22, 4, 2, 'cafe solo.jpg'),
(2, 'Café Manchado', 1.1, 0.3, 49, 4, 2, 'cafe solo.jpg'),
(3, 'Café Cortado', 1.1, 0.3, 50, 4, 2, 'cafe cortado.jpg'),
(4, 'Infusión Manzanilla', 1, 0.3, 50, 4, 10, 'te.jpg'),
(5, 'Infusión Poleo', 1.1, 0.3, 50, 4, 10, 'te.jpg'),
(6, 'Infusión Poleo-Menta', 1.1, 0.3, 50, 4, 10, 'te.jpg'),
(7, 'Té', 1.1, 0.3, 47, 4, 10, 'te.jpg'),
(8, 'Medio Bocadillo Tortilla', 0.8, 0.5, 34, 1, 9, 'bocadillo.png'),
(9, 'Medio Bocadillo Atún', 0.8, 0.5, 33, 1, 9, 'bocadillo.png'),
(10, 'Medio Bocadillo Jamón Serrano', 0.8, 0.5, 34, 1, 9, 'bocadillo.png'),
(11, 'Medio Bocadillo Jamón Cocido', 0.8, 0.5, 46, 1, 9, 'bocadillo.png'),
(12, 'Medio Bocadillo Queso Fresco', 0.8, 0.5, 65, 1, 9, 'bocadillo.png'),
(13, 'Entero Bocadillo Tortilla', 1.5, 0.5, 31, 1, 1, 'bocadillo.png'),
(14, 'Entero Bocadillo Atún', 1.5, 0.5, 18, 1, 1, 'bocadillo.png'),
(15, 'Entero Bocadillo Jamón Serrano', 1.5, 0.5, 33, 1, 1, 'bocadillo.png'),
(16, 'Entero Bocadillo Jamón Cocido', 1.5, 0.5, 46, 1, 1, 'bocadillo.png'),
(17, 'Entero Bocadillo Queso Fresco', 1.5, 0.5, 65, 1, 1, 'bocadillo.png'),
(22, 'Tostada Aceite', 1.5, 0.5, 12, 1, 4, 'tostada.png'),
(23, 'Tostada Atún', 1.5, 0.5, 23, 1, 4, 'tostada.png'),
(24, 'Tostada Tomate', 1.5, 0.5, 11, 1, 4, 'tostada.png'),
(26, 'Pizza Jamón', 1, 0.3, 14, 5, 3, 'pizza jamon.jpg'),
(27, 'Pizza Atún', 1, 0.3, 25, 5, 3, 'pizza verdura.jpg'),
(30, 'Empanadilla Jamón', 0.7, 0.2, 17, 1, 8, 'empanadilla.png'),
(31, 'Empanadilla Atún', 0.7, 0.2, 23, 1, 8, 'empanadilla.png'),
(32, 'Chicle Melón', 0.1, 0.05, 45, 3, 5, ''),
(33, 'Chicle Limón', 0.1, 0.05, 64, 3, 5, ''),
(34, 'Chicle Sandía', 0.1, 0.05, 55, 3, 5, ''),
(35, 'Chicle Menta', 0.1, 0.05, 59, 3, 5, ''),
(36, 'Caramelo', 0.1, 0.05, 63, 3, 5, ''),
(37, 'Bolsa Patatas Fritas', 0.35, 0.1, 13, 2, 7, ''),
(38, 'Bolsa Doritos', 0.35, 0.1, 24, 2, 7, ''),
(39, 'Bolsa Gusanitos', 0.35, 0.1, 33, 2, 7, ''),
(40, 'Bolsa Fantasmitos', 0.35, 0.1, 18, 2, 7, ''),
(41, 'Fanta de Naranja', 1.2, 0.5, 43, 2, 6, 'fanta naranja.jpg'),
(42, 'Fanta de Limón', 1.2, 0.5, 18, 2, 6, 'fanta limon.jpg'),
(43, 'CocaCola', 1.2, 0.5, -3, 2, 6, 'cocacola.jpg'),
(44, 'Nestea', 1.2, 0.5, 46, 2, 6, 'nestea.jpg'),
(45, 'Aquarius', 1.2, 0.5, 34, 2, 6, 'aquarius.jpg'),
(46, 'Agua', 1.2, 0.5, 100, 2, 6, 'agua 33.jpg'),
(47, 'Tostada Aguacate', 1.5, 0.5, 17, 1, 4, 'tostada.png'),
(48, 'Chicle Fresa', 0.1, 0.05, 45, 3, 5, ''),
(49, 'ejemplo', 1.09, 0.8, 34, 1, 8, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `idCaja` int(11) NOT NULL,
  `abierta` tinyint(1) NOT NULL,
  `cantidadActual` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`idCaja`, `abierta`, `cantidadActual`) VALUES
(1, 1, 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja2`
--

CREATE TABLE `caja2` (
  `nlinea` int(11) NOT NULL,
  `numeromesa` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `importetotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `caja2`
--

INSERT INTO `caja2` (`nlinea`, `numeromesa`, `fecha`, `hora`, `importetotal`) VALUES
(1, 1, '2024-11-14', '23:00:00', 2.7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `tipo`, `imagen`) VALUES
(1, 'Bocadillos Enteros', 'bocadillo.png'),
(2, 'Cafes', 'cafe con leche.jpg'),
(3, 'Pizzas', 'pizza jamon.jpg'),
(4, 'Tostadas', 'tostada.png'),
(5, 'Chicles', 'chuches.png'),
(6, 'Refrescos', 'cocacola.jpg'),
(7, 'Bolsas', ''),
(8, 'Empanadillas', 'empanadilla.png'),
(9, 'Bocadillos Medios', 'bocadillo.png'),
(10, 'Infusiones', 'te.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `nlinea` int(11) NOT NULL,
  `mesa` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`nlinea`, `mesa`, `cantidad`, `idproducto`) VALUES
(5, 1, 1, 13),
(6, 1, 1, 15),
(8, 1, 2, 45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horario`
--

CREATE TABLE `horario` (
  `idHorario` int(11) NOT NULL,
  `dia` varchar(100) NOT NULL,
  `horario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horario`
--

INSERT INTO `horario` (`idHorario`, `dia`, `horario`) VALUES
(1, 'Lunes', '8:00-12:00'),
(2, 'Martes', '8:00-12:00'),
(3, 'Miercoles', '8:00-12:00'),
(4, 'Jueves', '8:00-12:00'),
(5, 'Viernes', '8:00-12:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `idPagos` int(11) NOT NULL,
  `concepto` varchar(200) NOT NULL,
  `cantidad` float NOT NULL,
  `idTotales` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`idPagos`, `concepto`, `cantidad`, `idTotales`) VALUES
(4, 'ejemplo', 2, 35),
(5, 'cena', 12, 4),
(12, 'resta', 2, 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `fechaRecogida` date DEFAULT NULL,
  `pagado` tinyint(1) NOT NULL,
  `realizado` tinyint(1) NOT NULL,
  `precioPedido` decimal(10,2) NOT NULL,
  `finalizado` tinyint(1) DEFAULT NULL,
  `horaRecogida` varchar(50) DEFAULT NULL,
  `siendoRealizado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idPedido`, `idUsuario`, `fecha`, `hora`, `fechaRecogida`, `pagado`, `realizado`, `precioPedido`, `finalizado`, `horaRecogida`, `siendoRealizado`) VALUES
(60, 11, '2024-08-26', '12:33:26', NULL, 1, 0, 2.00, 1, '2ªHORA', 0),
(61, 11, '2024-09-16', '12:05:06', NULL, 0, 0, 0.00, NULL, NULL, NULL),
(63, 36, '2024-09-18', '00:28:33', NULL, 0, 0, 0.00, NULL, NULL, NULL),
(71, 4, '2024-11-05', '01:02:26', '2024-11-05', 0, 0, 1.00, 1, 'RECREO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido-linea`
--

CREATE TABLE `pedido-linea` (
  `idPedidoLinea` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `idPedido` int(11) NOT NULL,
  `extra` varchar(200) DEFAULT NULL,
  `precioLinea` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedido-linea`
--

INSERT INTO `pedido-linea` (`idPedidoLinea`, `idArticulo`, `cantidad`, `idPedido`, `extra`, `precioLinea`) VALUES
(67, 26, 2, 60, NULL, 2.00),
(75, 1, 1, 71, NULL, 1.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idProveedor` int(11) NOT NULL,
  `NombreEmpresa` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idProveedor`, `NombreEmpresa`) VALUES
(1, 'Panadería Juana'),
(2, 'Consum'),
(3, 'Chucherías Fini'),
(4, 'Cafés Salzillo'),
(5, 'Pizzería Verona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `totales`
--

CREATE TABLE `totales` (
  `mes` date NOT NULL,
  `numPedidos` int(11) NOT NULL,
  `totalVentas` decimal(10,2) NOT NULL,
  `idBeneficios` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `totales`
--

INSERT INTO `totales` (`mes`, `numPedidos`, `totalVentas`, `idBeneficios`) VALUES
('2024-06-01', 13, 63.50, 2),
('2024-07-01', 4, 18.00, 3),
('2024-08-01', 11, 27.20, 4),
('2024-09-01', 19, 48.63, 5),
('2024-10-01', 1, 3.20, 35),
('2024-11-01', 1, 2.60, 36);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `contrasena` varchar(64) NOT NULL,
  `telefono` int(11) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `correo`, `contrasena`, `telefono`, `tipo`) VALUES
(4, 'Alumno', 'Alumno', 'a@a.com', 'f7745f4df4394027716de160fb2acd6aac36699576a8be586b75ac09acf6a0df', 648911837, 'Alumno'),
(5, 'Trabajador', 'Trabajador', 't@t.com', 'f7745f4df4394027716de160fb2acd6aac36699576a8be586b75ac09acf6a0df', 605202877, 'Trabajador'),
(11, 'Profesor', 'Profesor', 'p@p.com', 'f7745f4df4394027716de160fb2acd6aac36699576a8be586b75ac09acf6a0df', 605202877, 'Profesor'),
(36, 'Ejemplo', 'Ejemplo', 'Ej@alu.murciaeduca.es', '', 605202877, 'Alumno');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`idArticulo`),
  ADD KEY `idCategoria` (`idCategoria`),
  ADD KEY `idProveedor` (`idProveedor`);

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`idCaja`);

--
-- Indices de la tabla `caja2`
--
ALTER TABLE `caja2`
  ADD PRIMARY KEY (`nlinea`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`nlinea`);

--
-- Indices de la tabla `horario`
--
ALTER TABLE `horario`
  ADD PRIMARY KEY (`idHorario`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`idPagos`),
  ADD KEY `fk_totales` (`idTotales`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `Fk_usuario` (`idUsuario`);

--
-- Indices de la tabla `pedido-linea`
--
ALTER TABLE `pedido-linea`
  ADD PRIMARY KEY (`idPedidoLinea`),
  ADD UNIQUE KEY `idPedidoLinea` (`idPedidoLinea`),
  ADD KEY `FK_articulo` (`idArticulo`),
  ADD KEY `fkPedido` (`idPedido`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idProveedor`);

--
-- Indices de la tabla `totales`
--
ALTER TABLE `totales`
  ADD PRIMARY KEY (`idBeneficios`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `idCaja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `caja2`
--
ALTER TABLE `caja2`
  MODIFY `nlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `nlinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `horario`
--
ALTER TABLE `horario`
  MODIFY `idHorario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `idPagos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT de la tabla `pedido-linea`
--
ALTER TABLE `pedido-linea`
  MODIFY `idPedidoLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `totales`
--
ALTER TABLE `totales`
  MODIFY `idBeneficios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`idProveedor`) REFERENCES `proveedores` (`idProveedor`);

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `fk_totales` FOREIGN KEY (`idTotales`) REFERENCES `totales` (`idBeneficios`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `Fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido-linea`
--
ALTER TABLE `pedido-linea`
  ADD CONSTRAINT `FK_articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkPedido` FOREIGN KEY (`idPedido`) REFERENCES `pedido` (`idPedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
