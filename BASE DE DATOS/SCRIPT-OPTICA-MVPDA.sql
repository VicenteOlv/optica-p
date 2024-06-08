-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 08, 2024 at 05:00 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `armazon`
--

CREATE TABLE `armazon` (
  `id_armazon` int(11) NOT NULL,
  `modelo` varchar(45) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `editado_por` int(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `armazon`
--

INSERT INTO `armazon` (`id_armazon`, `modelo`, `precio_compra`, `precio_venta`, `stock`, `editado_por`, `fecha_actualizado`) VALUES
(2, 'amarillo', 1000, 2000, 20, 19, '2024-06-07 17:43:06'),
(3, 'azul', 1500, 2000, 28, 19, '2024-06-06 14:25:16'),
(4, 'verdes', 700, 800, 100, 18, '2024-06-07 16:32:51');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `curp` varchar(45) NOT NULL,
  `nombre_completo` varchar(45) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `celular` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` varchar(45) NOT NULL,
  `editado_por` varchar(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`curp`, `nombre_completo`, `telefono`, `celular`, `email`, `fecha_nacimiento`, `direccion`, `editado_por`, `fecha_actualizado`) VALUES
('AACM6009191212', 'Paola Morales', '23423421212', '4421551087', 'pao@gmail.com', '2002-11-06', 'La estancia', '18', '2024-06-07 16:38:17'),
('MOA5674893945', 'Renata', '4426536915', '4426536916', 'ap.morales.anaya@gmail.com', '2003-12-06', 'av luz', '19', '2024-06-07 17:23:50'),
('OEVV020702HQTLZCA9', 'Pedro', '4421234234', '4421551087', 'chentespotts@gmail.com', '1965-05-19', 'Chihuhua #97 San josé de los Olvera', '19', '2024-06-07 17:44:03');

-- --------------------------------------------------------

--
-- Table structure for table `cristales`
--

CREATE TABLE `cristales` (
  `id_cristales` int(11) NOT NULL,
  `id_ojo_izq` int(11) NOT NULL,
  `id_ojo_der` int(11) NOT NULL,
  `precio_cristal` int(11) NOT NULL,
  `material` varchar(45) NOT NULL,
  `recubrimiento` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cristales`
--

INSERT INTO `cristales` (`id_cristales`, `id_ojo_izq`, `id_ojo_der`, `precio_cristal`, `material`, `recubrimiento`) VALUES
(1, 1, 1, 1000, 'policarbonato', 'antirayaduras');

-- --------------------------------------------------------

--
-- Table structure for table `detalle_venta`
--

CREATE TABLE `detalle_venta` (
  `id_detalle_venta` int(11) NOT NULL,
  `codigo_barras` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `descuento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `detalle_venta`
--

INSERT INTO `detalle_venta` (`id_detalle_venta`, `codigo_barras`, `id_venta`, `cantidad`, `precio_venta`, `descuento`) VALUES
(6, 3, 4, 1, 3000, 100),
(7, 3, 4, 1, 3000, 100);

-- --------------------------------------------------------

--
-- Table structure for table `fiscales`
--

CREATE TABLE `fiscales` (
  `rfc` varchar(45) NOT NULL,
  `regimen` varchar(45) NOT NULL,
  `curp` varchar(45) NOT NULL,
  `editado_por` varchar(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `fiscales`
--

INSERT INTO `fiscales` (`rfc`, `regimen`, `curp`, `editado_por`, `fecha_actualizado`) VALUES
('fiscalpaola', 'RGLPM', 'AACM6009191212', '18', '2024-06-07 16:39:58'),
('HUDIIOTJT', 'RAAGSP', 'MOA5674893945', '19', '2024-06-07 17:24:09'),
('RAPE650519GU3', 'RIF', 'OEVV020702HQTLZCA9', '19', '2024-06-07 17:44:47');

-- --------------------------------------------------------

--
-- Table structure for table `historia_clinicas`
--

CREATE TABLE `historia_clinicas` (
  `id_historia` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `curp` varchar(45) NOT NULL,
  `observaciones` varchar(45) NOT NULL,
  `editado_por` int(11) DEFAULT NULL,
  `fecha_actualizado` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `historia_clinicas`
--

INSERT INTO `historia_clinicas` (`id_historia`, `fecha`, `curp`, `observaciones`, `editado_por`, `fecha_actualizado`) VALUES
(1, '2024-06-07', 'AACM6009191212', 'Está bien ciega', 18, '2024-06-07 16:39:30'),
(3, '2024-06-07', 'MOA5674893945', 'Tiene conjuntivitis', 20, '2024-06-07 17:27:06'),
(4, '2024-06-07', 'OEVV020702HQTLZCA9', 'Está ciego', 20, '2024-06-07 17:46:55');

-- --------------------------------------------------------

--
-- Table structure for table `lentes`
--

CREATE TABLE `lentes` (
  `codigo_barras` int(11) NOT NULL,
  `id_cristales` int(11) DEFAULT NULL,
  `id_armazon` int(11) NOT NULL,
  `precio_lentes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `lentes`
--

INSERT INTO `lentes` (`codigo_barras`, `id_cristales`, `id_armazon`, `precio_lentes`) VALUES
(3, NULL, 3, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `ojo_der`
--

CREATE TABLE `ojo_der` (
  `id_ojo_der` int(11) NOT NULL,
  `esferico_der` decimal(5,2) NOT NULL,
  `cilindrico_der` decimal(5,2) NOT NULL,
  `eje_der` decimal(5,2) NOT NULL,
  `add_der` decimal(5,2) NOT NULL,
  `prisma_der` decimal(5,2) NOT NULL,
  `altura_oblea_der` decimal(5,2) NOT NULL,
  `av_der` decimal(5,2) NOT NULL,
  `id_historia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ojo_der`
--

INSERT INTO `ojo_der` (`id_ojo_der`, `esferico_der`, `cilindrico_der`, `eje_der`, `add_der`, `prisma_der`, `altura_oblea_der`, `av_der`, `id_historia`) VALUES
(1, -3.50, 2.00, 45.00, 1.00, 1.00, 10.75, 1.00, 1),
(2, -3.50, 2.00, 45.00, 2.50, 1.00, 10.75, 2.00, 1),
(3, 1.00, 1.00, 1.00, 1.00, 1.00, 0.50, 1.00, 3),
(4, -3.50, 1.00, 45.00, 2.50, 1.00, 10.75, 1.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `ojo_izq`
--

CREATE TABLE `ojo_izq` (
  `id_ojo_izq` int(11) NOT NULL,
  `esferico_izq` decimal(5,2) NOT NULL,
  `cilindrico_izq` decimal(5,2) NOT NULL,
  `eje_izq` decimal(5,2) NOT NULL,
  `add_izq` decimal(5,2) NOT NULL,
  `prisma_izq` decimal(5,2) NOT NULL,
  `altura_oblea_izq` decimal(5,2) NOT NULL,
  `av_izq` decimal(5,2) NOT NULL,
  `id_historia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ojo_izq`
--

INSERT INTO `ojo_izq` (`id_ojo_izq`, `esferico_izq`, `cilindrico_izq`, `eje_izq`, `add_izq`, `prisma_izq`, `altura_oblea_izq`, `av_izq`, `id_historia`) VALUES
(1, 0.50, -1.25, 180.00, 2.50, 0.50, 12.00, 1.00, 1),
(2, 1.00, 2.00, 180.00, 2.50, 0.50, 12.00, 1.00, 1),
(3, 0.50, 2.00, 180.00, 0.50, 2.00, 12.00, 1.00, 3),
(4, 1.25, -1.25, 180.00, 2.50, 2.00, 12.00, 1.00, 4);

-- --------------------------------------------------------

--
-- Table structure for table `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `nombre`) VALUES
(1, 'Escritorio'),
(2, 'Armazones'),
(3, 'Historiales'),
(4, 'Ventas'),
(5, 'Acceso');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `rol` varchar(20) NOT NULL,
  `login` varchar(20) NOT NULL,
  `clave` varchar(64) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL,
  `condicion` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombre`, `telefono`, `direccion`, `rol`, `login`, `clave`, `imagen`, `condicion`) VALUES
(12, 'arturo', '', '', 'oftalmologo', 'arturo', '11cdf86d5723eecce5af1f33e5fde9f066e608d0a1068f445d99820eef5c19ae', '1717778344.jpg', 1),
(18, 'admin', '', '', 'admin', 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', '1717778374.jpg', 1),
(19, 'vicente', '', '', 'mostrador', 'vicente', '8293e4c57c1440349e9c48c66bd52d7033e7d8ffcb8a1f59a11fb0477c0d0df4', '1717778401.jpg', 1),
(20, 'pao', '', '', 'oftalmologo', 'pao', '7b2b378417138a99b73ef4d69262b7e703cacc2bf9f3ee176038bfe03904f4ca', '1717778445.jpg', 1),
(21, 'david', '', '', 'admin', 'david', '07d046d5fac12b3f82daf5035b9aae86db5adc8275ebfbf05ec83005a4a8ba3e', '1717778463.jpg', 1),
(22, 'marco', '', '', 'mostrador', 'marco', '7c8ccc86c11654af029457d90fdd9d013ce6fb011ee8fdb1374832268cc8d967', '1717778478.jpg', 1),
(23, 'gjgjgj', '', '', 'si', 'si', '97a62ad21d79c01cceb7767952acec4fec86bfe909b06e5f3f6963365cf91ab8', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `id_usuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`id_usuario_permiso`, `idusuario`, `idpermiso`) VALUES
(91, 18, 1),
(92, 18, 2),
(93, 18, 3),
(94, 18, 4),
(95, 18, 5),
(96, 19, 2),
(97, 19, 4),
(101, 21, 1),
(102, 21, 2),
(103, 21, 3),
(104, 21, 4),
(105, 21, 5),
(106, 22, 2),
(107, 22, 4),
(113, 23, 1),
(114, 23, 2),
(115, 23, 3),
(116, 23, 4),
(117, 23, 5),
(118, 20, 1),
(119, 20, 2),
(120, 20, 3),
(121, 12, 1),
(122, 12, 2),
(123, 12, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `rfc` varchar(45) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id_venta`, `total`, `rfc`, `id_usuario`, `fecha`) VALUES
(4, 2900, 'RAPE650519GU3', 19, '2024-06-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armazon`
--
ALTER TABLE `armazon`
  ADD PRIMARY KEY (`id_armazon`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`curp`);

--
-- Indexes for table `cristales`
--
ALTER TABLE `cristales`
  ADD PRIMARY KEY (`id_cristales`),
  ADD KEY `fk_cristales_ojo_izq1_idx` (`id_ojo_izq`),
  ADD KEY `fk_cristales_ojo_der1_idx` (`id_ojo_der`);

--
-- Indexes for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD PRIMARY KEY (`id_detalle_venta`),
  ADD KEY `fk_detalle_venta_ventas1_idx` (`id_venta`),
  ADD KEY `fk_detalle_venta_lentes1` (`codigo_barras`);

--
-- Indexes for table `fiscales`
--
ALTER TABLE `fiscales`
  ADD PRIMARY KEY (`rfc`),
  ADD KEY `fk_fiscales_clientes1_idx` (`curp`);

--
-- Indexes for table `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  ADD PRIMARY KEY (`id_historia`),
  ADD KEY `fk_id_historia_Cliente1_idx` (`curp`);

--
-- Indexes for table `lentes`
--
ALTER TABLE `lentes`
  ADD PRIMARY KEY (`codigo_barras`),
  ADD KEY `fk_lentes_cristales1_idx` (`id_cristales`),
  ADD KEY `fk_lentes_armazon1_idx` (`id_armazon`);

--
-- Indexes for table `ojo_der`
--
ALTER TABLE `ojo_der`
  ADD PRIMARY KEY (`id_ojo_der`),
  ADD KEY `fk_ojo_der_historia_clinicas1_idx` (`id_historia`);

--
-- Indexes for table `ojo_izq`
--
ALTER TABLE `ojo_izq`
  ADD PRIMARY KEY (`id_ojo_izq`),
  ADD KEY `fk_ojo_izq_historia_clinicas1_idx` (`id_historia`);

--
-- Indexes for table `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`),
  ADD UNIQUE KEY `login_UNIQUE` (`login`);

--
-- Indexes for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`id_usuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuarios1_idx` (`idusuario`),
  ADD KEY `fk_usuario_permiso_permisos1_idx` (`idpermiso`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `fk_Venta_Fiscales1_idx` (`rfc`),
  ADD KEY `fk_ventas_usuarios1_idx` (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armazon`
--
ALTER TABLE `armazon`
  MODIFY `id_armazon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cristales`
--
ALTER TABLE `cristales`
  MODIFY `id_cristales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  MODIFY `id_detalle_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  MODIFY `id_historia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lentes`
--
ALTER TABLE `lentes`
  MODIFY `codigo_barras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ojo_der`
--
ALTER TABLE `ojo_der`
  MODIFY `id_ojo_der` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ojo_izq`
--
ALTER TABLE `ojo_izq`
  MODIFY `id_ojo_izq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `id_usuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cristales`
--
ALTER TABLE `cristales`
  ADD CONSTRAINT `fk_cristales_ojo_der1` FOREIGN KEY (`id_ojo_der`) REFERENCES `ojo_der` (`id_ojo_der`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_cristales_ojo_izq1` FOREIGN KEY (`id_ojo_izq`) REFERENCES `ojo_izq` (`id_ojo_izq`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detalle_venta`
--
ALTER TABLE `detalle_venta`
  ADD CONSTRAINT `fk_detalle_venta_lentes1` FOREIGN KEY (`codigo_barras`) REFERENCES `lentes` (`codigo_barras`),
  ADD CONSTRAINT `fk_detalle_venta_ventas1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `fiscales`
--
ALTER TABLE `fiscales`
  ADD CONSTRAINT `fk_fiscales_clientes1` FOREIGN KEY (`curp`) REFERENCES `clientes` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `historia_clinicas`
--
ALTER TABLE `historia_clinicas`
  ADD CONSTRAINT `fk_id_historia_Cliente1` FOREIGN KEY (`curp`) REFERENCES `clientes` (`curp`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `lentes`
--
ALTER TABLE `lentes`
  ADD CONSTRAINT `fk_lentes_armazon1` FOREIGN KEY (`id_armazon`) REFERENCES `armazon` (`id_armazon`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_lentes_cristales1` FOREIGN KEY (`id_cristales`) REFERENCES `cristales` (`id_cristales`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ojo_der`
--
ALTER TABLE `ojo_der`
  ADD CONSTRAINT `fk_ojo_der_historia_clinicas1` FOREIGN KEY (`id_historia`) REFERENCES `historia_clinicas` (`id_historia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ojo_izq`
--
ALTER TABLE `ojo_izq`
  ADD CONSTRAINT `fk_ojo_izq_historia_clinicas1` FOREIGN KEY (`id_historia`) REFERENCES `historia_clinicas` (`id_historia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permisos1` FOREIGN KEY (`idpermiso`) REFERENCES `permisos` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuarios1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `fk_Venta_Fiscales1` FOREIGN KEY (`rfc`) REFERENCES `fiscales` (`rfc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ventas_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
