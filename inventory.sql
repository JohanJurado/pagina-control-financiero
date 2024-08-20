-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 12:05:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(10) NOT NULL,
  `efectivoesperado_caja` varchar(60) DEFAULT NULL,
  `monedas_caja` varchar(60) DEFAULT NULL,
  `billetes_caja` varchar(60) DEFAULT NULL,
  `total_caja` varchar(60) DEFAULT NULL,
  `estado_caja` varchar(60) DEFAULT NULL,
  `descreporte_caja` varchar(200) DEFAULT NULL,
  `fecha_caja` datetime NOT NULL,
  `id_usCaja` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id_caja`, `efectivoesperado_caja`, `monedas_caja`, `billetes_caja`, `total_caja`, `estado_caja`, `descreporte_caja`, `fecha_caja`, `id_usCaja`) VALUES
(1, '0', '0', '0', '0', 'Exitoso', 'Ninguna novedad', '2024-06-27 16:36:49', 1),
(5, '30000', '0', '26000', '26000', 'Cerrada', 'Ninguna novedad', '2024-07-18 18:39:54', 2),
(10, '42000', '2000', '40000', '42000', 'Cerrada', NULL, '2024-07-20 12:04:53', 3),
(11, '19500', '4500', '15000', '19500', 'Cerrada', 'Se encontro 40 mil pesos', '2024-07-20 12:57:09', 1),
(12, '29500', '0', '40000', '40000', 'Cerrada', 'Se conto 40k', '2024-07-20 16:12:21', 4),
(13, '40000', '0', '40000', '40000', 'Cerrada', NULL, '2024-07-20 16:35:58', 1),
(14, '59200', '9200', '50000', '59200', 'Cerrada', 'Se encontro abierta con 35k', '2024-07-20 17:23:49', 4),
(15, '9200', '9200', '50000', '59200', 'Cerrada', NULL, '2024-07-20 17:51:41', 1),
(16, '83200', '0', '15000', '15000', 'Cerrada', '15k', '2024-07-22 21:34:38', 1),
(17, '15000', '0', '15000', '15000', 'cerrada', NULL, '2024-08-05 08:37:06', 1),
(18, '15000', '0', '15000', '15000', 'cerrada', NULL, '2024-08-05 09:15:43', 3),
(19, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-08-05 09:19:08', 2),
(20, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-08-05 09:26:57', 2),
(21, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-08-05 09:36:44', 1),
(23, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-08-05 16:15:12', 1),
(24, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-08-05 16:15:37', 2),
(26, '227000', '0', '227000', '227000', 'Cerrada', NULL, '2024-08-20 05:05:19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id_cat` int(10) NOT NULL,
  `nombre_cat` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id_cat`, `nombre_cat`) VALUES
(13, 'Papeleria'),
(14, 'Piñateria'),
(15, 'Cacharrería');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_fac` int(10) NOT NULL,
  `fecha_fac` date NOT NULL,
  `total_fac` varchar(60) NOT NULL,
  `estado_fac` varchar(60) NOT NULL,
  `abono_fac` varchar(60) NOT NULL,
  `id_provFac` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`id_fac`, `fecha_fac`, `total_fac`, `estado_fac`, `abono_fac`, `id_provFac`) VALUES
(1, '2024-06-01', '0', 'Sin Estado', '0', 1),
(2, '2024-06-28', '100000', 'Pagado', '100000', 2),
(3, '2024-06-28', '100000', 'Pagado', '100000', 2),
(6, '2024-07-12', '200000', 'Pagado', '200000', 2),
(7, '2024-07-20', '200000', 'Pendiente', '125000', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gasto`
--

CREATE TABLE `gasto` (
  `id_gasto` int(10) NOT NULL,
  `nombre_gasto` varchar(60) NOT NULL,
  `desc_gasto` text NOT NULL,
  `metodopago_gasto` varchar(60) NOT NULL,
  `total_gasto` varchar(60) NOT NULL,
  `tipo_gasto` varchar(60) NOT NULL,
  `id_cajaGasto` int(10) NOT NULL,
  `id_facturaGasto` int(10) NOT NULL,
  `fecha_gasto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `gasto`
--

INSERT INTO `gasto` (`id_gasto`, `nombre_gasto`, `desc_gasto`, `metodopago_gasto`, `total_gasto`, `tipo_gasto`, `id_cajaGasto`, `id_facturaGasto`, `fecha_gasto`) VALUES
(1, 'Cafes', 'Cafe de Jorvan', 'Efectivo', '11000', 'Otro', 1, 1, '2024-06-27'),
(7, 'Abono factura 3', 'Abono factura 3', 'Efectivo', '25000', 'Factura', 1, 3, '2024-06-19'),
(9, 'Abono factura 3', 'Abono factura 3', 'Transferencia', '50000', 'Factura', 1, 3, '2024-06-18'),
(10, 'Abono factura 3', 'Abono factura 3', 'Efectivo', '50000', 'Factura', 1, 3, '2024-06-28'),
(11, 'Abono factura 2', 'Abono factura 2', 'Efectivo', '10000', 'Factura', 1, 2, '2024-06-28'),
(12, 'Abono factura 2', 'Abono factura 2', 'Efectivo', '65000', 'Factura', 1, 2, '2024-06-28'),
(13, 'abono factura 4', 'Abono', 'Transferencia', '30000', 'Factura', 1, 3, '2024-07-12'),
(14, 'abono factura 4', 'Abono', 'Efectivo', '20000', 'Factura', 1, 3, '2024-07-26'),
(17, 'Abono factura 2', 'Abono factura 2', 'Efectivo', '80000', 'Factura', 1, 3, '2024-07-18'),
(24, 'Cafes', 'cafes', 'Efectivo', '2000', 'Otro', 10, 1, '2024-07-20'),
(25, 'Cafe ', 'cafe', 'Efectivo', '100', 'Otro', 10, 1, '2024-07-20'),
(26, 'cafe Rojo', 'Cafe baratico', 'Efectivo', '300', 'Otro', 10, 1, '2024-07-20'),
(27, 'abono factura 7', 'abono 25.000', 'Efectivo', '25000', 'Factura', 11, 7, '2024-07-20'),
(28, 'abono factura 6', '50000', 'Efectivo', '50000', 'Factura', 15, 6, '2024-07-20'),
(30, 'Cafe', 'Café empleado', 'Efectivo', '3000', 'Otro', 16, 1, '2024-07-25'),
(31, 'silla', 'silla de repuesto', 'Efectivo', '20000', 'Otro', 26, 1, '2024-08-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_prod` int(10) NOT NULL,
  `nombre_prod` varchar(60) NOT NULL,
  `descripcion_prod` varchar(60) NOT NULL,
  `costo_prod` varchar(60) NOT NULL,
  `gananciainicial_prod` varchar(60) NOT NULL,
  `gananciainicialmay_prod` int(10) NOT NULL,
  `valorganancia_prod` int(10) NOT NULL,
  `valorgananciamay_prod` int(10) NOT NULL,
  `stock_prod` int(5) NOT NULL,
  `stockMin_prod` int(5) NOT NULL,
  `importancia_prod` varchar(60) NOT NULL,
  `id_catProd` int(10) NOT NULL,
  `id_provProd` int(10) NOT NULL,
  `imagen` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_prod`, `nombre_prod`, `descripcion_prod`, `costo_prod`, `gananciainicial_prod`, `gananciainicialmay_prod`, `valorganancia_prod`, `valorgananciamay_prod`, `stock_prod`, `stockMin_prod`, `importancia_prod`, `id_catProd`, `id_provProd`, `imagen`) VALUES
(21, 'Sarten', 'Sarten Antiadherente ', '40000', '42.857142857143', 33, 30000, 20000, 8, 2, 'No', 15, 2, '../../img/58143d530ef1b5b470b4b5f7cc2e9104.png'),
(22, 'Cucharon', 'Cucharon de madera', '15000', '40', 25, 10000, 5000, 14, 3, 'No', 15, 2, '../../img/80805bad9151b3bcc64d724e10e178f8.jpeg'),
(23, 'Molde', 'Molde de reposteria', '40000', '27.2727', 20, 15000, 10000, 10, 2, 'No', 15, 2, '../../img/5fd4b1c7093130296b93bf0d235f3482.jpg'),
(24, 'Confeti', 'Confeti de colores', '8000', '20', 11, 2000, 1000, 15, 4, 'No', 14, 4, '../../img/c87f7807876a1541b12d663a2141534d.png'),
(25, 'Globos', 'Paquete de 10 de colores', '3000', '50', 40, 3000, 2000, 37, 5, 'No', 14, 4, '../../img/a93cbf6d5b1241a9ae8d6e3d958f6767.jpg'),
(26, 'Banderines', 'Banderines de Colores', '8000', '46.666666666667', 35, 7000, 4000, 20, 3, 'No', 14, 4, '../../img/6bf2d56750c526b892c71de9d3ff4bbe.jpeg'),
(27, 'Marcadores', 'Marcadores Gruesos x5 unidades', '30000', '33.333333333333', 25, 15000, 10000, 7, 2, 'No', 13, 5, '../../img/55f8f8acf9e0fbcd489f3bf7054f7003.jpg'),
(28, 'Bond', 'Paquete de hojas de bond x15 unidades', '5000', '37.5', 29, 3000, 2000, 37, 5, 'No', 13, 5, '../../img/3deaf1ccdc864d32a3ec4216b0f5e15c.jpg'),
(29, 'Tinta China', 'Tinta China 30ml', '15000', '40', 25, 10000, 5000, 13, 2, 'No', 13, 5, '../../img/74f4e0c5943b67b4bf9bb6d1f9e6456a.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_prov` int(10) NOT NULL,
  `nombre_prov` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`id_prov`, `nombre_prov`) VALUES
(1, 'Sin Proveedor'),
(2, 'Paula'),
(4, 'Oscar Mora'),
(5, 'Lina');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_us` int(10) NOT NULL,
  `nombre_us` varchar(60) NOT NULL,
  `apellido_us` varchar(60) NOT NULL,
  `jornada_us` varchar(60) NOT NULL,
  `telefono_us` varchar(10) NOT NULL,
  `correo_us` varchar(60) NOT NULL,
  `estado_us` varchar(60) NOT NULL,
  `rol_us` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_us`, `nombre_us`, `apellido_us`, `jornada_us`, `telefono_us`, `correo_us`, `estado_us`, `rol_us`, `password`) VALUES
(1, 'Jennifer', 'Yepes', 'Completa', '3172563452', 'correoadmin@gmail.com', 'Activo', 'Admin', '1234'),
(2, 'Edison', 'Jaimes', 'Nocturna', '3172563452', 'correoedison@gmail.com', 'Activo', 'Empleado', '1234'),
(3, 'Jorvan', 'Torres', 'Completa', '314235645', 'correoajorvan@gmail.com', 'Activo', 'Empleado', '1234'),
(4, 'Diego', 'Hernandez', 'Mañana', '3162547823', 'correodiego@gmail.com', 'Activo', 'Empleado', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_ven` int(10) NOT NULL,
  `fecha_ven` datetime NOT NULL,
  `metodopago_ven` varchar(60) NOT NULL,
  `valortotal_ven` varchar(60) NOT NULL,
  `id_cajaVenta` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_ven`, `fecha_ven`, `metodopago_ven`, `valortotal_ven`, `id_cajaVenta`) VALUES
(1, '2024-08-20 04:56:38', 'Efectivo', '70000', 26),
(37, '2024-08-20 04:56:57', 'Efectivo', '50000', 26),
(38, '2024-08-20 04:57:17', 'Transferencia', '120000', 26),
(39, '2024-08-20 04:57:47', 'Efectivo', '34000', 26),
(40, '2024-08-20 04:58:29', 'Efectivo', '78000', 26),
(41, '0000-00-00 00:00:00', '', '0', 26);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventaprod`
--

CREATE TABLE `ventaprod` (
  `id_VP` int(10) NOT NULL,
  `ganancia_VP` varchar(60) NOT NULL,
  `valorganancia_VP` int(10) NOT NULL,
  `precioventa_VP` varchar(60) NOT NULL,
  `id_venVP` int(10) NOT NULL,
  `id_prodVP` int(10) NOT NULL,
  `cantidad_VP` int(10) NOT NULL,
  `total_VP` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ventaprod`
--

INSERT INTO `ventaprod` (`id_VP`, `ganancia_VP`, `valorganancia_VP`, `precioventa_VP`, `id_venVP`, `id_prodVP`, `cantidad_VP`, `total_VP`) VALUES
(117, '43', 30000, '70000', 1, 21, 1, 70000),
(118, '20', 2000, '10000', 37, 24, 5, 50000),
(119, '40', 10000, '25000', 38, 22, 1, 25000),
(120, '43', 30000, '70000', 38, 21, 1, 70000),
(121, '40', 10000, '25000', 38, 29, 1, 25000),
(122, '50', 3000, '6000', 39, 25, 3, 18000),
(123, '38', 3000, '8000', 39, 28, 2, 16000),
(124, '33', 15000, '45000', 40, 27, 1, 45000),
(125, '40', 10000, '25000', 40, 29, 1, 25000),
(126, '38', 3000, '8000', 40, 28, 1, 8000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `id_usCaja` (`id_usCaja`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_fac`),
  ADD KEY `id_provFac` (`id_provFac`);

--
-- Indices de la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD PRIMARY KEY (`id_gasto`),
  ADD KEY `id_cajaGasto` (`id_cajaGasto`,`id_facturaGasto`),
  ADD KEY `id_facturaGasto` (`id_facturaGasto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_catProd` (`id_catProd`,`id_provProd`),
  ADD KEY `id_provProd` (`id_provProd`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_prov`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_us`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_ven`),
  ADD KEY `id_cajaVenta` (`id_cajaVenta`);

--
-- Indices de la tabla `ventaprod`
--
ALTER TABLE `ventaprod`
  ADD PRIMARY KEY (`id_VP`),
  ADD KEY `id_venVP` (`id_venVP`,`id_prodVP`),
  ADD KEY `id_prodVP` (`id_prodVP`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_fac` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id_gasto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_prod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_prov` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_ven` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `ventaprod`
--
ALTER TABLE `ventaprod`
  MODIFY `id_VP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caja`
--
ALTER TABLE `caja`
  ADD CONSTRAINT `caja_ibfk_1` FOREIGN KEY (`id_usCaja`) REFERENCES `usuario` (`id_us`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`id_provFac`) REFERENCES `proveedor` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `gasto`
--
ALTER TABLE `gasto`
  ADD CONSTRAINT `gasto_ibfk_1` FOREIGN KEY (`id_cajaGasto`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gasto_ibfk_2` FOREIGN KEY (`id_facturaGasto`) REFERENCES `factura` (`id_fac`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id_provProd`) REFERENCES `proveedor` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`id_catProd`) REFERENCES `categoria` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_1` FOREIGN KEY (`id_cajaVenta`) REFERENCES `caja` (`id_caja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventaprod`
--
ALTER TABLE `ventaprod`
  ADD CONSTRAINT `ventaprod_ibfk_1` FOREIGN KEY (`id_prodVP`) REFERENCES `producto` (`id_prod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventaprod_ibfk_2` FOREIGN KEY (`id_venVP`) REFERENCES `venta` (`id_ven`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
