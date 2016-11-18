-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2016 at 03:16 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-04:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fertinv`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Nuevo','Usado','Roto','Reparado','Obsoleto') COLLATE utf8_unicode_ci DEFAULT 'Nuevo',
  `articulo_id` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `serial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `modelo_id` int(10) UNSIGNED NOT NULL,
  `datos` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ubicacion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` enum('Nuevo','Usado','Roto','Reparado','Obsoleto') COLLATE utf8_unicode_ci DEFAULT 'Nuevo',
  `fecha_de_compra` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `articulo_id` int(10) UNSIGNED NOT NULL,
  `hasta` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `consumos`
--

CREATE TABLE `consumos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `renta_id` int(10) UNSIGNED NOT NULL,
  `consumido` varchar(15) COLLATE utf8_unicode_ci DEFAULT '0',
  `excedente` varchar(10) COLLATE utf8_unicode_ci DEFAULT '0',
  `monto_bs` float UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contratos`
--

CREATE TABLE `contratos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `fecha_de_inicio` date NOT NULL,
  `fecha_de_culminacion` date DEFAULT NULL,
  `tipo_de_contrato` enum('Temporal','Permanente') COLLATE utf8_unicode_ci DEFAULT 'Temporal',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contratos`
--

INSERT INTO `contratos` (`id`, `titulo`, `trabajador_id`, `fecha_de_inicio`, `fecha_de_culminacion`, `tipo_de_contrato`, `created`, `modified`) VALUES
(1, 'primer contrato de david', 1, '2016-09-05', NULL, 'Temporal', '2016-11-06 00:00:00', '2016-11-06 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `articulo_id` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE `facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `paguese_antes_de` date DEFAULT NULL,
  `balance` float UNSIGNED NOT NULL DEFAULT '0',
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `numero_de_cuenta` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lineas`
--

CREATE TABLE `lineas` (
  `id` int(10) UNSIGNED NOT NULL,
  `operadora` enum('Movilnet','Movistar') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Movilnet',
  `numero` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `puk` int(10) UNSIGNED DEFAULT NULL,
  `pin` int(10) UNSIGNED DEFAULT NULL,
  `codigo_sim` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articulo_id` int(10) UNSIGNED DEFAULT NULL,
  `estado` enum('Activa','Inactiva','Suspendida','Perdida') COLLATE utf8_unicode_ci DEFAULT 'Inactiva',
  `observaciones` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lineas_rentas`
--

CREATE TABLE `lineas_rentas` (
  `linea_id` int(10) UNSIGNED NOT NULL,
  `renta_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modelos`
--

CREATE TABLE `modelos` (
  `id` int(10) UNSIGNED NOT NULL,
  `marca` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `modelo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_de_articulo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `serial_comun` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imagen` text COLLATE utf8_unicode_ci,
  `abstracto` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `procesos`
--

CREATE TABLE `procesos` (
  `id` int(10) UNSIGNED NOT NULL,
  `titulo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` enum('Asignacion','Devolucion','Mixto') COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_de_solicitud` date NOT NULL,
  `fecha_de_aprobacion` date DEFAULT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado','Completado') COLLATE utf8_unicode_ci DEFAULT 'Pendiente',
  `observaciones` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `procesos`
--

INSERT INTO `procesos` (`id`, `titulo`, `motivo`, `tipo`, `fecha_de_solicitud`, `fecha_de_aprobacion`, `estado`, `observaciones`, `created`, `modified`) VALUES
(1, '', 'probar las relaciones', 'Asignacion', '2016-11-05', NULL, 'Pendiente', '', '2016-11-05 20:54:32', '2016-11-05 20:54:32'),
(2, 'dd', 'ddd', 'Asignacion', '2016-11-07', NULL, 'Pendiente', '', '2016-11-07 01:38:18', '2016-11-07 01:38:18'),
(3, 'dasd', 'sadsad', 'Asignacion', '0000-00-00', NULL, 'Pendiente', '', '2016-11-07 01:40:44', '2016-11-07 01:40:44'),
(4, 'asdasd', 'sddasdasd', 'Asignacion', '2016-11-07', NULL, 'Pendiente', '', '2016-11-07 02:00:52', '2016-11-07 02:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `procesos_trabajadores`
--

CREATE TABLE `procesos_trabajadores` (
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `rol` enum('Solicitante','Supervisor','Encargado') COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `procesos_trabajadores`
--

INSERT INTO `procesos_trabajadores` (`trabajador_id`, `proceso_id`, `rol`) VALUES
(1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rentas`
--

CREATE TABLE `rentas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `monto_basico` float DEFAULT '0',
  `operadora` enum('Movilnet','Movistar') COLLATE utf8_unicode_ci DEFAULT 'Movilnet',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `rentas`
--

INSERT INTO `rentas` (`id`, `nombre`, `monto_basico`, `operadora`, `created`, `modified`) VALUES
(1, 'Empresas full 3.0', 504.55, 'Movistar', '2016-11-06 18:52:34', '2016-11-06 18:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` enum('M','F') COLLATE utf8_unicode_ci DEFAULT NULL,
  `gerencia` enum('IT','Recursos Humanos','Finanzas','Contratacion','Servicios Generales','Planificacion','Confiabiliad','Mantenimiento','Produccion','Gestion') COLLATE utf8_unicode_ci NOT NULL,
  `cargo` enum('Gerente','Supervisor','Supervisora','Analista','Pasante','Superintendente','Jefe de planta','Jefa de planta','Secretaria','Secretario','Consultor','Consultora','Consejera','Consejero') COLLATE utf8_unicode_ci NOT NULL,
  `sede` smallint(6) DEFAULT '0',
  `numero_de_oficina` smallint(6) DEFAULT NULL,
  `telefono_personal` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rif` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residencia` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `apellido`, `cedula`, `sexo`, `gerencia`, `cargo`, `sede`, `numero_de_oficina`, `telefono_personal`, `rif`, `residencia`, `created`, `modified`) VALUES
(1, 'David', 'Gomez', '20359596', 'M', 'IT', 'Pasante', 0, 14, '04148128602', '', '', '2016-11-05 20:26:25', '2016-11-05 20:26:25'),
(2, 'Persona', 'X', '55555', 'M', 'IT', 'Pasante', 1, NULL, '', '', '', '2016-11-06 01:34:29', '2016-11-06 02:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_de_usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `funcion` enum('Superadministrador','Administrador','Operador','Visitante') COLLATE utf8_unicode_ci DEFAULT 'Visitante',
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `imagen` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_de_usuario`, `email`, `clave`, `funcion`, `trabajador_id`, `imagen`, `created`, `modified`) VALUES
(1, 'david7852', 'pasanteit@fertinitro.com', '$2y$10$bRVN23gkzOJRbCKhA1HxmuueViQVTCYXgqoYxvs6kB5Tq.FGyaEU6', 'Visitante', 1, '', '2016-11-05 20:50:15', '2016-11-05 20:50:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_asociados` (`articulo_id`);

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `marca_y_modelo` (`modelo_id`);

--
-- Indexes for table `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_asignado` (`articulo_id`),
  ADD KEY `parte_del_proceso` (`proceso_id`);

--
-- Indexes for table `consumos`
--
ALTER TABLE `consumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consumo_de` (`factura_id`),
  ADD KEY `renta_mensual` (`renta_id`);

--
-- Indexes for table `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajador_contratado` (`trabajador_id`);

--
-- Indexes for table `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_devuelto` (`articulo_id`),
  ADD KEY `parte_del_proceso` (`proceso_id`);

--
-- Indexes for table `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea_de_factura` (`linea_id`);

--
-- Indexes for table `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_de_linea` (`articulo_id`);

--
-- Indexes for table `lineas_rentas`
--
ALTER TABLE `lineas_rentas`
  ADD PRIMARY KEY (`linea_id`,`renta_id`),
  ADD KEY `renta_id` (`renta_id`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `procesos_trabajadores`
--
ALTER TABLE `procesos_trabajadores`
  ADD PRIMARY KEY (`trabajador_id`,`proceso_id`),
  ADD KEY `proceso_id` (`proceso_id`);

--
-- Indexes for table `rentas`
--
ALTER TABLE `rentas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_de_usuario` (`nombre_de_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `datos_de_usuario` (`trabajador_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `consumos`
--
ALTER TABLE `consumos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `procesos`
--
ALTER TABLE `procesos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rentas`
--
ALTER TABLE `rentas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `accesorios_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `consumos`
--
ALTER TABLE `consumos`
  ADD CONSTRAINT `consumos_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `consumos_ibfk_2` FOREIGN KEY (`renta_id`) REFERENCES `rentas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `lineas_rentas`
--
ALTER TABLE `lineas_rentas`
  ADD CONSTRAINT `lineas_rentas_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_rentas_ibfk_2` FOREIGN KEY (`renta_id`) REFERENCES `rentas` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `procesos_trabajadores`
--
ALTER TABLE `procesos_trabajadores`
  ADD CONSTRAINT `procesos_trabajadores_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `procesos_trabajadores_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
