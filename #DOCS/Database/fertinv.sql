-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2017 a las 20:43:11
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fertinv`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE `accesorios` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Nuevo','Usado','Roto','Reparado','Obsoleto') COLLATE utf8_unicode_ci DEFAULT 'Nuevo',
  `articulo_id` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `accesorios`
--

INSERT INTO `accesorios` (`id`, `descripcion`, `estado`, `articulo_id`, `created`, `modified`) VALUES
(1, 'audifonos', 'Usado', 2, '2017-01-10 15:25:34', '2017-01-10 15:25:34'),
(2, 'fff', 'Nuevo', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
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

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `serial`, `modelo_id`, `datos`, `ubicacion`, `estado`, `fecha_de_compra`, `created`, `modified`) VALUES
(1, 'bv45bvb4hxfg', 1, 'Distribucion De idioma', '', 'Usado', '2016-06-12', '2017-01-05 12:01:56', '2017-01-05 12:01:56'),
(2, 'c67bskamc', 2, '', 'en oficina it', 'Usado', '2013-12-18', '2017-01-05 12:04:57', '2017-01-18 14:43:59'),
(3, 'mxl31600xx', 3, '', '', 'Nuevo', '2012-11-18', '2017-01-05 18:58:32', '2017-01-05 18:58:32'),
(4, 'cfcg6125assaf', 4, '', '', 'Nuevo', NULL, '2017-01-05 19:00:35', '2017-01-05 19:00:35'),
(5, 's1w56xx', 5, '', '', 'Usado', '2004-07-15', '2017-01-06 19:39:06', '2017-01-06 19:39:06'),
(6, 'hdsjsa', 6, '', 'trailer gestion', 'Nuevo', '2014-04-15', '2017-01-17 17:21:05', '2017-02-24 12:02:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `articulo_id` int(10) UNSIGNED NOT NULL,
  `hasta` date DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `proceso_id`, `articulo_id`, `hasta`, `created`, `modified`) VALUES
(2, 13, 1, '2017-03-23', '2017-01-11 18:17:54', '2017-01-11 18:17:54'),
(5, 18, 6, '2017-01-17', '2017-01-17 19:26:40', '2017-01-18 14:43:59'),
(6, 19, 6, '2017-01-17', '2017-01-17 19:32:03', '2017-01-18 14:43:59'),
(7, 20, 6, '2018-01-17', '2017-01-17 19:39:54', '2017-01-27 13:51:06'),
(8, 20, 2, '2020-01-18', '2017-01-18 13:55:36', '2017-01-18 13:55:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consumos`
--

CREATE TABLE `consumos` (
  `id` int(10) UNSIGNED NOT NULL,
  `factura_id` int(10) UNSIGNED NOT NULL,
  `servicio_id` int(10) UNSIGNED NOT NULL,
  `consumido` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `excedente` varchar(20) COLLATE utf8_unicode_ci DEFAULT '0',
  `monto_bs` float NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `consumos`
--

INSERT INTO `consumos` (`id`, `factura_id`, `servicio_id`, `consumido`, `excedente`, `monto_bs`, `created`, `modified`) VALUES
(1, 1, 2, '0', '0', 0, '2017-01-27 13:14:56', '2017-01-27 13:14:56'),
(2, 1, 2, '450', '0', 1580, '2017-02-02 11:38:24', '2017-02-02 11:38:24'),
(3, 1, 2, '400', '0', 1548, '2017-02-02 11:46:57', '2017-02-02 11:46:57'),
(4, 1, 2, '400', '0', 1548, '2017-02-02 11:48:19', '2017-02-02 11:48:19'),
(5, 1, 2, '400', '0', 1548, '2017-02-02 11:49:22', '2017-02-02 11:49:22'),
(6, 1, 2, '487', '0', 1584, '2017-02-02 12:42:33', '2017-02-02 12:42:33'),
(7, 1, 2, '444', '0', 1500, '2017-02-02 12:45:36', '2017-02-02 12:45:36'),
(8, 1, 2, '0', '0', 0, '2017-02-02 12:47:16', '2017-02-02 12:47:16'),
(9, 1, 2, '0', '0', 0, '2017-02-02 12:48:27', '2017-02-02 12:48:27'),
(10, 1, 2, '0', '0', 0, '2017-02-02 14:27:14', '2017-02-02 14:27:14'),
(11, 1, 2, '0', '0', 0, '2017-02-02 14:27:54', '2017-02-02 14:27:54'),
(12, 4, 2, '0', '0', 0, '2017-02-14 18:13:38', '2017-02-14 18:13:38'),
(13, 1, 2, '501', '1', 1, '2017-02-14 18:18:45', '2017-02-14 18:18:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contratos`
--

CREATE TABLE `contratos` (
  `id` int(10) UNSIGNED NOT NULL,
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `fecha_de_inicio` date NOT NULL,
  `fecha_de_culminacion` date DEFAULT NULL,
  `tipo_de_contrato` enum('Temporal','Permanente') COLLATE utf8_unicode_ci DEFAULT 'Temporal',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `contratos`
--

INSERT INTO `contratos` (`id`, `trabajador_id`, `fecha_de_inicio`, `fecha_de_culminacion`, `tipo_de_contrato`, `created`, `modified`) VALUES
(1, 1, '2016-11-18', '2017-03-04', 'Temporal', '2016-11-18 18:05:26', '2016-11-18 18:05:26'),
(2, 2, '2017-01-31', '2017-03-31', 'Temporal', '2017-01-31 16:38:09', '2017-01-31 16:38:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `devoluciones`
--

CREATE TABLE `devoluciones` (
  `id` int(10) UNSIGNED NOT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `articulo_id` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `devoluciones`
--

INSERT INTO `devoluciones` (`id`, `proceso_id`, `articulo_id`, `created`, `modified`) VALUES
(2, 16, 1, '2017-01-16 14:25:19', '2017-01-16 14:25:19'),
(3, 20, 6, '2017-01-18 13:56:07', '2017-01-18 13:56:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(10) UNSIGNED NOT NULL,
  `linea_id` int(10) UNSIGNED NOT NULL,
  `paguese_antes_de` date DEFAULT NULL,
  `balance` float NOT NULL DEFAULT '0',
  `iva` float DEFAULT '0',
  `cargos_extra` float DEFAULT '0',
  `desde` date NOT NULL,
  `hasta` date NOT NULL,
  `numero_de_cuenta` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `linea_id`, `paguese_antes_de`, `balance`, `iva`, `cargos_extra`, `desde`, `hasta`, `numero_de_cuenta`, `created`, `modified`) VALUES
(1, 1, '2015-04-03', 9863, 0, 0, '2017-11-18', '2016-11-18', '', '2016-11-18 17:43:38', '2017-02-20 11:24:54'),
(3, 2, '2017-03-29', 554, 0, 0, '2017-02-14', '2017-03-14', '', '2017-02-14 16:59:00', '2017-02-20 11:24:54'),
(4, 1, '2017-03-29', 0, 0, 0, '2016-02-14', '2017-03-14', '', '2017-02-14 16:59:13', '2017-02-14 18:20:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE `lineas` (
  `id` int(10) UNSIGNED NOT NULL,
  `operadora` enum('Movilnet','Movistar') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Movilnet',
  `numero` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `puk` int(10) UNSIGNED DEFAULT NULL,
  `pin` int(10) UNSIGNED DEFAULT NULL,
  `codigo_sim` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `articulo_id` int(10) UNSIGNED DEFAULT NULL,
  `estado` enum('Activa','Inactiva','Suspendida','Perdida') COLLATE utf8_unicode_ci DEFAULT 'Inactiva',
  `observaciones` varchar(140) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`id`, `operadora`, `numero`, `puk`, `pin`, `codigo_sim`, `articulo_id`, `estado`, `observaciones`, `created`, `modified`) VALUES
(1, 'Movistar', '04148128602', NULL, NULL, '', 6, 'Activa', '', '2016-11-18 17:43:19', '2017-01-30 17:46:23'),
(2, 'Movilnet', '04168837753', NULL, NULL, '', NULL, 'Inactiva', '', '2017-01-27 15:13:12', '2017-02-14 19:38:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_rentas`
--

CREATE TABLE `lineas_rentas` (
  `linea_id` int(10) UNSIGNED NOT NULL,
  `renta_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `lineas_rentas`
--

INSERT INTO `lineas_rentas` (`linea_id`, `renta_id`) VALUES
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modelos`
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

--
-- Volcado de datos para la tabla `modelos`
--

INSERT INTO `modelos` (`id`, `marca`, `modelo`, `tipo_de_articulo`, `serial_comun`, `imagen`, `abstracto`, `created`, `modified`) VALUES
(1, 'HP', 'KU-1156', 'Teclado', '', 'HP Ku-1156.png', '', '2017-01-03 14:36:45', '2017-01-04 11:58:38'),
(2, 'HP', 'LV1911', 'Monitor', NULL, 'HP LV1911.png', '', '2017-01-03 19:21:29', '2017-01-04 18:17:37'),
(3, 'HP', 'Pro 6300', 'PC', NULL, 'HP Pro 6300.png', '', '2017-01-04 11:23:40', '2017-01-04 11:58:52'),
(4, 'HP', 'USB 2-Button Laser', 'Mouse', NULL, 'HP USB 2-Button Laser.png', '', '2017-01-04 11:54:49', '2017-01-04 11:54:49'),
(5, 'Lenovo', 'C1S', 'Pc', NULL, 'Lenovo A70z.png', '', '2017-01-06 18:42:16', '2017-01-06 18:42:16'),
(6, 'Apple', 'Iphone 6s', 'Celular', NULL, 'iphone 5s.png', '', '2017-01-17 17:17:57', '2017-01-27 19:31:49');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos`
--

CREATE TABLE `procesos` (
  `id` int(10) UNSIGNED NOT NULL,
  `motivo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tipo` enum('Asignacion','Devolucion','Mixto') COLLATE utf8_unicode_ci DEFAULT 'Asignacion',
  `fecha_de_aprobacion` date DEFAULT NULL,
  `fecha_de_complecion` date DEFAULT NULL,
  `estado` enum('Pendiente','Aprobado','Rechazado','Completado') COLLATE utf8_unicode_ci DEFAULT 'Pendiente',
  `observaciones` text COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procesos`
--

INSERT INTO `procesos` (`id`, `motivo`, `tipo`, `fecha_de_aprobacion`, `fecha_de_complecion`, `estado`, `observaciones`, `created`, `modified`) VALUES
(13, '232323', 'Asignacion', '2017-01-11', '2017-02-01', 'Completado', '2323232', '2017-01-11 12:48:35', '2017-01-11 19:25:19'),
(16, 'prueba dev', 'Devolucion', '2017-01-16', NULL, 'Aprobado', 'Devolucion de teclado por presentar fallas en tecla alt', '2017-01-16 12:57:25', '2017-02-10 12:11:50'),
(18, 'Asignar telefono movil a gestion1...', 'Asignacion', '2017-01-18', '2017-02-24', 'Completado', 'ninguna', '2017-01-17 19:26:40', '2017-02-24 12:02:37'),
(19, 'Asignar telefono movil a gestion1...', 'Asignacion', '2017-01-17', NULL, 'Completado', 'ningunasss', '2017-01-17 19:32:03', '2017-01-18 16:47:52'),
(20, 'Asignar telefono movil a gestion1...', 'Mixto', '2017-01-18', NULL, 'Completado', 'ningunasss', '2017-01-17 19:39:54', '2017-01-19 11:59:49'),
(21, 'prueba 3.1', 'Mixto', NULL, NULL, 'Pendiente', 'probando que nada explote', '2017-02-24 12:29:27', '2017-02-24 12:29:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procesos_trabajadores`
--

CREATE TABLE `procesos_trabajadores` (
  `trabajador_id` int(10) UNSIGNED NOT NULL,
  `proceso_id` int(10) UNSIGNED NOT NULL,
  `rol` enum('Solicitante','Supervisor','Encargado') COLLATE utf8_unicode_ci DEFAULT 'Encargado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `procesos_trabajadores`
--

INSERT INTO `procesos_trabajadores` (`trabajador_id`, `proceso_id`, `rol`) VALUES
(1, 13, 'Supervisor'),
(1, 16, 'Supervisor'),
(1, 18, 'Supervisor'),
(1, 19, 'Supervisor'),
(1, 20, 'Supervisor'),
(2, 19, 'Solicitante'),
(2, 20, 'Solicitante'),
(2, 21, 'Solicitante'),
(3, 13, 'Solicitante'),
(3, 18, 'Solicitante'),
(5, 16, 'Solicitante'),
(6, 20, 'Encargado'),
(7, 16, 'Encargado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rentas`
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
-- Volcado de datos para la tabla `rentas`
--

INSERT INTO `rentas` (`id`, `nombre`, `monto_basico`, `operadora`, `created`, `modified`) VALUES
(1, 'HP habla con otros 500', 554, 'Movistar', '2016-11-18 17:47:38', '2016-11-18 17:47:38');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cupo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `renta_id` int(10) UNSIGNED NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `cupo`, `renta_id`, `created`, `modified`) VALUES
(2, 'minutos', '750''00"', 1, '2016-11-18 17:47:57', '2016-11-18 17:47:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajadores`
--

CREATE TABLE `trabajadores` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cedula` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` enum('M','F') COLLATE utf8_unicode_ci DEFAULT NULL,
  `gerencia` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cargo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sede` smallint(6) DEFAULT '0',
  `puesto_de_trabajo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefono_personal` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extension` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rif` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `residencia` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `trabajadores`
--

INSERT INTO `trabajadores` (`id`, `nombre`, `apellido`, `cedula`, `sexo`, `gerencia`, `cargo`, `area`, `sede`, `puesto_de_trabajo`, `telefono_personal`, `extension`, `rif`, `residencia`, `created`, `modified`) VALUES
(1, 'David', 'Gomez', '20359590', 'M', 'IT', 'Gerente', 'Sistemas e infraestructura', 0, 'oficina 14', '04148128602', '3426', '', 'Pt Morro, Lecheria', '2016-11-18 13:54:33', '2017-02-10 16:19:53'),
(2, 'persona x', '1dds', '2016522', 'M', 'IT', 'Jefa de planta', 'mantenimiento', 1, 'en oficina it', '', NULL, '', '', '2016-12-20 19:01:36', '2017-01-18 14:41:08'),
(3, 'Gestion', '1', '99999999', '', 'Gestion', 'Consultor', '', 0, 'trailer gestion', '', NULL, '', '', '2016-12-21 17:25:04', '2016-12-21 17:25:04'),
(4, 'mm', 'nn', '12345678', 'M', 'IT', 'Gerente', '', 0, '', '', NULL, '', '', '2016-12-28 11:42:16', '2016-12-28 11:42:16'),
(5, 'David', 'Gonzales', '20359596', 'M', 'RRHH', 'Pasante', 'Sistemas y telecomunicacion', 0, 'adm piso 1', '', NULL, '', '', '2016-12-29 18:21:02', '2016-12-29 18:21:02'),
(6, 'Daniel', 'Gomez', '20359597', 'M', 'IT', 'Analista', '', 0, '', '', NULL, '', '', '2016-12-29 18:21:35', '2016-12-29 18:21:35'),
(7, 'Dario', 'Gomez', '20359598', '', 'IT', 'Supervisor', '', 0, '', '', NULL, '', '', '2016-12-29 18:22:21', '2016-12-29 18:22:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre_de_usuario` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pregunta` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `respuesta` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `funcion` enum('Superadministrador','Administrador','Operador','Visitante') COLLATE utf8_unicode_ci DEFAULT 'Visitante',
  `trabajador_id` int(10) UNSIGNED DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre_de_usuario`, `email`, `clave`, `pregunta`, `respuesta`, `funcion`, `trabajador_id`, `created`, `modified`) VALUES
(1, 'david7852', 'pasanteit@fertinitro.com', '$2y$10$sim9XTwWNHQ2nLjnvnc1NuRgiJSeobCxKhQqDemxVIgOzqempImMS', '¿Color favorito?', 'verde', 'Superadministrador', 1, '2016-11-18 13:55:12', '2017-02-24 16:03:37'),
(7, 'GomezD', 'GomezD@fertinitro.com', '$2y$10$RJcH2/WXxLIhQIauTdAM6.zrxCmxOodljvdaCobtbfU3yXnEVmlHS', NULL, NULL, 'Operador', 5, '2016-12-29 18:22:54', '2016-12-29 18:22:54'),
(8, 'GomezD2', 'GomezD2@fertinitro.com', '$2y$10$C.RWC0KU95u3mTbAYgrOLObkPBERMGmIxq9B8SWLRiTR5I8YHdVSa', 'color favorito', 'verde', 'Visitante', 2, '2016-12-29 18:23:12', '2017-02-24 12:56:33'),
(9, 'GomezD3', 'GomezD3@fertinitro.com', '$2y$10$6vyu15K5iwwAHUpebdiBs.il2RbpT1PsCSPJFu9sleVKIGg0pR2M.', NULL, NULL, 'Administrador', 7, '2016-12-29 18:23:25', '2016-12-29 18:23:25');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_asociados` (`articulo_id`);

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial` (`serial`),
  ADD KEY `marca_y_modelo` (`modelo_id`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_asignado` (`articulo_id`),
  ADD KEY `parte_del_proceso` (`proceso_id`);

--
-- Indices de la tabla `consumos`
--
ALTER TABLE `consumos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `consumo_de` (`factura_id`),
  ADD KEY `consumo_del_servicio` (`servicio_id`);

--
-- Indices de la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trabajador_contratado` (`trabajador_id`);

--
-- Indices de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_devuelto` (`articulo_id`),
  ADD KEY `parte_del_proceso` (`proceso_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `linea_de_factura` (`linea_id`);

--
-- Indices de la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo_de_linea` (`articulo_id`);

--
-- Indices de la tabla `lineas_rentas`
--
ALTER TABLE `lineas_rentas`
  ADD PRIMARY KEY (`linea_id`,`renta_id`),
  ADD KEY `renta_id` (`renta_id`);

--
-- Indices de la tabla `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `procesos`
--
ALTER TABLE `procesos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `procesos_trabajadores`
--
ALTER TABLE `procesos_trabajadores`
  ADD PRIMARY KEY (`trabajador_id`,`proceso_id`),
  ADD KEY `proceso_id` (`proceso_id`);

--
-- Indices de la tabla `rentas`
--
ALTER TABLE `rentas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `servicio_de_renta` (`renta_id`);

--
-- Indices de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_de_usuario` (`nombre_de_usuario`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `datos_de_usuario` (`trabajador_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `consumos`
--
ALTER TABLE `consumos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de la tabla `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `lineas`
--
ALTER TABLE `lineas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `modelos`
--
ALTER TABLE `modelos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `procesos`
--
ALTER TABLE `procesos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `rentas`
--
ALTER TABLE `rentas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `trabajadores`
--
ALTER TABLE `trabajadores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD CONSTRAINT `accesorios_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`modelo_id`) REFERENCES `modelos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `consumos`
--
ALTER TABLE `consumos`
  ADD CONSTRAINT `consumos_ibfk_1` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `consumos_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `servicios` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `contratos`
--
ALTER TABLE `contratos`
  ADD CONSTRAINT `contratos_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `devoluciones`
--
ALTER TABLE `devoluciones`
  ADD CONSTRAINT `devoluciones_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `devoluciones_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `lineas_rentas`
--
ALTER TABLE `lineas_rentas`
  ADD CONSTRAINT `lineas_rentas_ibfk_1` FOREIGN KEY (`linea_id`) REFERENCES `lineas` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_rentas_ibfk_2` FOREIGN KEY (`renta_id`) REFERENCES `rentas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `procesos_trabajadores`
--
ALTER TABLE `procesos_trabajadores`
  ADD CONSTRAINT `procesos_trabajadores_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `procesos_trabajadores_ibfk_2` FOREIGN KEY (`proceso_id`) REFERENCES `procesos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `servicios_ibfk_1` FOREIGN KEY (`renta_id`) REFERENCES `rentas` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`trabajador_id`) REFERENCES `trabajadores` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
