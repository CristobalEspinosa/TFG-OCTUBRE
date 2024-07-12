-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-07-2024 a las 18:13:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

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
  `stock` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `idCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`idArticulo`, `articulo`, `pvp`, `stock`, `idProveedor`, `idCategoria`) VALUES
(1, 'Café Solo', 1.1, 23, 4, 2),
(2, 'Café Manchado', 1.1, 50, 4, 2),
(3, 'Café Cortado', 1.1, 50, 4, 2),
(4, 'Infusión Manzanilla', 1, 50, 4, 2),
(5, 'Infusión Poleo', 1.1, 50, 4, 2),
(6, 'Infusión Poleo-Menta', 1.1, 50, 4, 2),
(7, 'Té', 1.1, 47, 4, 2),
(8, 'Medio Bocadillo Tortilla', 1, 34, 1, 1),
(9, 'Medio Bocadillo Atún', 0.8, 33, 1, 1),
(10, 'Medio Bocadillo Jamón Serrano', 0.8, 37, 1, 1),
(11, 'Medio Bocadillo Jamón Cocido', 0.8, 46, 1, 1),
(12, 'Medio Bocadillo Queso Fresco', 0.8, 65, 1, 1),
(13, 'Entero Bocadillo Tortilla', 1.5, 31, 1, 1),
(14, 'Entero Bocadillo Atún', 1.5, 23, 1, 1),
(15, 'Entero Bocadillo Jamón Serrano', 1.5, 33, 1, 1),
(16, 'Entero Bocadillo Jamón Cocido', 1.5, 46, 1, 1),
(17, 'Entero Bocadillo Queso Fresco', 1.5, 65, 1, 1),
(22, 'Tostada Aceite', 1.5, 12, 1, 4),
(23, 'Tostada Atún', 1.5, 23, 1, 4),
(24, 'Tostada Tomate', 1.5, 13, 1, 4),
(26, 'Pizza Jamón', 1, 17, 5, 3),
(27, 'Pizza Atún', 1, 25, 5, 4),
(30, 'Empanadilla Jamón', 0.7, 17, 1, 8),
(31, 'Empanadilla Atún', 0.7, 23, 1, 8),
(32, 'Chicle Melón', 0.1, 45, 3, 5),
(33, 'Chicle Limón', 0.1, 65, 3, 5),
(34, 'Chicle Sandía', 0.1, 56, 3, 5),
(35, 'Chicle Menta', 0.1, 59, 3, 5),
(36, 'Caramelo', 0.1, 63, 3, 5),
(37, 'Bolsa Patatas Fritas', 0.35, 13, 2, 7),
(38, 'Bolsa Doritos', 0.35, 24, 2, 7),
(39, 'Bolsa Gusanitos', 0.35, 33, 2, 7),
(40, 'Bolsa Fantasmitos', 0.35, 18, 2, 7),
(41, 'Fanta de Naranja', 1.2, 43, 2, 6),
(42, 'Fanta de Limón', 1.2, 23, 2, 6),
(43, 'CocaCola', 1.2, -2, 2, 6),
(44, 'Nestea', 1.2, 46, 2, 6),
(45, 'Aquarius', 1.2, 34, 2, 6),
(46, 'Agua', 1.2, 100, 2, 6),
(47, 'Tostada Aguacate', 1.5, 17, 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL,
  `tipo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idCategoria`, `tipo`) VALUES
(1, 'Bocadillos'),
(2, 'Cafes'),
(3, 'Pizzas'),
(4, 'Tostadas'),
(5, 'Chicles'),
(6, 'Refrescos'),
(7, 'Bolsas'),
(8, 'Empanadillas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idPedido` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
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

INSERT INTO `pedido` (`idPedido`, `idUsuario`, `fecha`, `hora`, `pagado`, `realizado`, `precioPedido`, `finalizado`, `horaRecogida`, `siendoRealizado`) VALUES
(57, 4, '2024-07-10', '17:17:21', 0, 0, 3.60, 1, 'RECREO', 1);

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
(64, 43, 3, 57, NULL, 3.60);

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
('2024-06-01', 1, 13.00, 2),
('2024-06-01', 1, 5.50, 3),
('2024-06-01', 1, 3.00, 4),
('2024-06-01', 1, 3.00, 5),
('2024-06-01', 1, 2.00, 6),
('2024-06-01', 1, 7.80, 7),
('2024-06-01', 1, 2.70, 8),
('2024-06-01', 1, 3.20, 9),
('2024-06-01', 1, 6.90, 10),
('2024-06-01', 1, 6.90, 11),
('2024-06-01', 1, 0.00, 12),
('2024-06-01', 1, 1.60, 13),
('2024-06-01', 1, 4.50, 14),
('2024-07-01', 1, 4.50, 15),
('2024-07-01', 1, 4.50, 16),
('2024-07-01', 1, 4.50, 17),
('2024-07-01', 1, 4.50, 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `apellidos` varchar(200) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `contrasena` varchar(10) NOT NULL,
  `tipo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellidos`, `correo`, `contrasena`, `tipo`) VALUES
(4, 'Alumno', 'Alumno', 'a@a.com', '1234', 'Alumno'),
(5, 'Trabajador', 'Trabajador', 't@t.com', '1234', 'Trabajador'),
(11, 'Profesor', 'Profesor', 'p@p.com', '1234', 'Profesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `idVenta` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta-linea`
--

CREATE TABLE `venta-linea` (
  `idVentaLinea` int(11) NOT NULL,
  `idVenta` int(11) NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idCategoria`);

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
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`idVenta`);

--
-- Indices de la tabla `venta-linea`
--
ALTER TABLE `venta-linea`
  ADD PRIMARY KEY (`idVentaLinea`),
  ADD KEY `idArticulo` (`idArticulo`),
  ADD KEY `idVenta` (`idVenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `idArticulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `pedido-linea`
--
ALTER TABLE `pedido-linea`
  MODIFY `idPedidoLinea` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `totales`
--
ALTER TABLE `totales`
  MODIFY `idBeneficios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `idVenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta-linea`
--
ALTER TABLE `venta-linea`
  MODIFY `idVentaLinea` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Filtros para la tabla `venta-linea`
--
ALTER TABLE `venta-linea`
  ADD CONSTRAINT `venta-linea_ibfk_1` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`idArticulo`),
  ADD CONSTRAINT `venta-linea_ibfk_2` FOREIGN KEY (`idVenta`) REFERENCES `venta` (`idVenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
