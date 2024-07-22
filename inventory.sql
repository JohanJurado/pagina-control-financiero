-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-07-2024 a las 15:31:42
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
(5, '30000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-18 18:39:54', 2),
(8, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-18 18:40:47', 1),
(23, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:34:16', 1),
(25, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:38:39', 2),
(26, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:40:13', 2),
(27, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:41:44', 1),
(28, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:42:03', 2),
(29, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:43:13', 2),
(30, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:45:52', 1),
(31, '26000', '0', '26000', '26000', 'Cerrada', NULL, '2024-07-19 15:46:20', 2),
(32, '26000', '0', '24000', '24000', 'Cerrada', 'Habian 24000 en caja', '2024-07-19 15:48:12', 1),
(33, '24000', '0', '20000', '20000', 'Cerrada', 'Habían 20000 en caja', '2024-07-19 15:49:12', 1),
(34, '20000', '0', '15000', '15000', 'Cerrada', 'Habian 15000 en caja\n', '2024-07-19 15:51:07', 2),
(35, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 07:18:03', 1),
(36, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 07:24:07', 2),
(37, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 07:30:12', 1),
(38, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 07:36:38', 2),
(39, '540000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 08:07:27', 1),
(40, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 08:08:48', 2),
(41, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 08:10:49', 1),
(42, '15000', '0', '15000', '15000', 'Cerrada', NULL, '2024-07-22 08:24:44', 1);

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
(4, 'Prueba2'),
(7, 'Piñateria'),
(10, 'Cacharreria');

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
(6, '2024-07-12', '200000', 'Pendiente', '150000', 2);

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
(13, 'abono factura 4', 'djdjklkkkl', 'Transferencia', '30000', 'Factura', 1, 3, '2024-07-12'),
(14, 'abono factura 4', 'djdjklkkkl', 'Efectivo', '20000', 'Factura', 1, 3, '2024-07-26'),
(17, 'Abono factura 2', 'Abono factura 2', 'Efectivo', '80000', 'Factura', 1, 3, '2024-07-18');

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
  `valorganancia_prod` int(10) NOT NULL,
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

INSERT INTO `producto` (`id_prod`, `nombre_prod`, `descripcion_prod`, `costo_prod`, `gananciainicial_prod`, `valorganancia_prod`, `stock_prod`, `stockMin_prod`, `importancia_prod`, `id_catProd`, `id_provProd`, `imagen`) VALUES
(10, 'Lana chenile', 'lana', '8000', '20', 2000, 44, 5, 'No', 7, 2, '../../img/093cad6c4509203bdf4dca730bf725f1.png'),
(11, 'Lapiz', 'Lapiz Amarillo B2', '500', '70.588235294118', 1200, 0, 5, 'No', 7, 2, '../../img/4a7ce4e358d89e79577c0769cf1ca839.jpg'),
(19, 'cebolla', 'cebolla cabezona', '1000', '52.380952380952', 1100, 30, 5, 'No', 4, 2, '../../img/7cfbadd81caea21325ca4ce6c7a1bc14.png'),
(20, 'Prueba Imagen', 'Imagen de prueba ', '5000', '58.333333333333', 7000, 10, 3, 'No', 4, 2, '../../img/14edd2a46c0b8d0db8556dd8d76ae832.jpg'),
(21, 'ImagenPrueba', 'ImagenPruebaCarpetaImg', '1000', '80', 4000, 5, 5, 'No', 4, 2, '../../img/d9349daf5c6b2abbc839b62ceb54d0a6.jpeg'),
(22, 'Prueba Imagen Po', 'Imagen de prueba Po', '50000', '50', 50000, 15, 5, 'No', 4, 2, '../../img/cf482f4daf3d29eca102af6ce81caeeb.jpeg');

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
(2, 'Prueba');

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
(1, 'Jorvan', 'Torres', 'Completa', '3172563452', 'correorandom@gmail.com', 'Activo', 'Admin', '1234'),
(2, 'Edison', 'Jaimes', 'Nocturna', '3172563452', 'correorandom@gmail.com', 'Activo', 'Empleado', '4321'),
(3, 'Jenniffer', 'Yepes', 'Mañana', '314235645', 'correo@gmail.com', 'Activo', 'Empleado', '1234');

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
(10, '2024-07-18 18:39:33', 'Efectivo', '10000', 5),
(29, '2024-07-22 07:44:13', 'Efectivo', '525000', 39),
(30, '0000-00-00 00:00:00', '', '0', 39);

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
(76, '20', 2000, '10000', 10, 10, 1, 10000),
(78, '80', 4000, '5000', 29, 21, 5, 25000),
(80, '50', 50000, '100000', 29, 22, 5, 500000);

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
  MODIFY `id_caja` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_cat` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_fac` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `gasto`
--
ALTER TABLE `gasto`
  MODIFY `id_gasto` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_prod` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_prov` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_us` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_ven` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `ventaprod`
--
ALTER TABLE `ventaprod`
  MODIFY `id_VP` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
