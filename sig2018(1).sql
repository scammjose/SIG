-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2019 a las 07:09:48
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sig2018`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `correo` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `correo`, `password`, `created_at`, `updated_at`) VALUES
(1, 'upt@h.com', '$2y$10$bcLlgiRcP8ONhT3Om3NGCer6/eI6LG5a0qKd.YiEZjOvCbigJMU5S', '2018-12-10 18:24:40', '0000-00-00 00:00:00'),
(2, 'pedro@hotmail.com', '$2y$10$bcLlgiRcP8ONhT3Om3NGCer6/eI6LG5a0qKd.YiEZjOvCbigJMU5S', '2018-12-08 07:00:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivo`
--

CREATE TABLE `archivo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` int(1) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `src_archivo` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `visible` int(11) NOT NULL,
  `slug` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `carpeta` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `archivo`
--

INSERT INTO `archivo` (`id`, `nombre`, `tipo`, `usuarioId`, `categoriaId`, `src_archivo`, `visible`, `slug`, `carpeta`, `created_at`, `updated_at`) VALUES
(12, 'prueba1', 1, 2, 2, 'archivos/gestion-de-proyectos/proyectos-de-mecanica/', 1, 'prueba1.docx', NULL, '2019-01-15 14:02:36', '2019-01-15 14:02:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `carpeta` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `posicion` int(5) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `carpeta`, `posicion`, `created_at`, `updated_at`) VALUES
(1, 'hola', 'prueba', 7, '2018-12-12 06:36:38', '2018-12-12 06:36:38'),
(2, 'Gestion de Proyectos', 'gestion-de-proyectos', 7, '2018-12-14 00:20:59', '2018-12-14 00:20:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL,
  `bienvenida` text COLLATE utf8_spanish_ci,
  `politica` text COLLATE utf8_spanish_ci,
  `mision` text COLLATE utf8_spanish_ci,
  `vision` text COLLATE utf8_spanish_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id`, `bienvenida`, `politica`, `mision`, `vision`, `created_at`, `updated_at`) VALUES
(1, 'Bienvenido al Portal del SIG de la Universidad Politécnica de Tecámac, en este lugar encontrarás los documentos que integran nuestro Sistema Integral de Gestión basado en las normas NMX-CC-9001-IMNC-2008 (ISO 9001:2008) y NMX-SAA-14001-IMNC-2004 (ISO 14001:2004), te invitamos a que consultesla Política de Calidad y Gestión Ambiental, Procedimientos, Formatos y demás documentos que forman parte de tu proceso, ¡Únete a la Calidad y a la Gestión Ambiental!.', '\"Brindar servicios educativos referentes a la inscripción, reinscripción y fortalecimiento académico con un enfoque de respeto al medio ambiente y uso racional de los recursos, comprometidos con el cumplimiento de la legislación ambiental y los requisitos suscritos aplicables, a través del Sistema Integral de Gestión como herramienta de mejora continua.\"', '\"Contribuir al crecimiento nacional, mediante la formación de profesionistas con calidad, a través de competencias profesionales con innovación en la generación de tecnología; que permita resolver la problemática de las empresas, fomentar el bienestar social, avivar los valores humaísticos y la conservación de la cultura ecológica.\"', '\"Ser un referente nacional, con reconocimiento internacional en educación superior basada en competencias profesionales por la calidad y pertenencia de sus programas educativos que se expresan en la competencia técnica y calidad personal de sus egresados; por sus aportaciones al desarrollo económico y social, a través de la investigación, el desarrollo tecnológico, la promoción de la cultura, el compromiso con la mejora continua y la preservación del medio ambiente.\"', '2018-12-12 20:06:45', '2018-12-13 02:06:45');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimiento_usuario`
--

CREATE TABLE `movimiento_usuario` (
  `id` int(11) NOT NULL,
  `movimiento` varchar(1) COLLATE utf8_spanish_ci NOT NULL,
  `informe` text COLLATE utf8_spanish_ci NOT NULL,
  `archivoId` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesion_usuario`
--

CREATE TABLE `sesion_usuario` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sesion_usuario`
--

INSERT INTO `sesion_usuario` (`id`, `usuarioId`, `created_at`, `updated_at`) VALUES
(1, 3, '2018-12-12 19:13:57', '0000-00-00 00:00:00'),
(2, 3, '2018-12-13 01:56:45', '2018-12-13 01:56:45'),
(3, 1, '2018-12-13 01:57:29', '2018-12-13 01:57:29'),
(4, 1, '2018-12-13 01:57:35', '2018-12-13 01:57:35'),
(5, 3, '2018-12-13 01:59:12', '2018-12-13 01:59:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subcategoria`
--

CREATE TABLE `subcategoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `categoriaId` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `subcategoria`
--

INSERT INTO `subcategoria` (`id`, `nombre`, `categoriaId`, `created_at`, `updated_at`) VALUES
(1, 'proyectos de mecanica', 2, '2018-12-13 18:32:41', '0000-00-00 00:00:00'),
(2, 'hola una subcategoria', 1, '2018-12-13 18:51:11', '0000-00-00 00:00:00'),
(4, 'nueva sub de hola', 1, '2018-12-13 18:52:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoPaterno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `apellidoMaterno` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` tinyint(1) NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `codigo` varchar(256) COLLATE utf8_spanish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidoPaterno`, `apellidoMaterno`, `correo`, `password`, `tipo`, `estatus`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 'oscar I', 'Peralta', 'Najera', 'oklp1995@hotmail.com', '$2y$10$ObSQuIQt5cvjIS9Ih2P5b.xtuMlNWOQ0sCVCrxR8C6s3Ql68G0W9a', 1, 1, '[object Object]', '2018-12-12 19:57:42', '2018-12-13 01:57:42'),
(3, 'Claudia', 'Altamirano', 'Hernandez', 'claudia@hotmail.com', '$2y$10$xXQwN6Gs4cLZVMCcK4YZxu2//LtoIYZwmwiH9cVAAhimO2rCcT5i2', 2, 1, 'CVrBRaN', '2018-12-12 18:53:14', '2018-12-13 00:53:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`),
  ADD KEY `categoriaId` (`categoriaId`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimiento_usuario`
--
ALTER TABLE `movimiento_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `archivoId` (`archivoId`);

--
-- Indices de la tabla `sesion_usuario`
--
ALTER TABLE `sesion_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`);

--
-- Indices de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoriaId` (`categoriaId`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `archivo`
--
ALTER TABLE `archivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `movimiento_usuario`
--
ALTER TABLE `movimiento_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sesion_usuario`
--
ALTER TABLE `sesion_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivo`
--
ALTER TABLE `archivo`
  ADD CONSTRAINT `archivo_ibfk_1` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `movimiento_usuario`
--
ALTER TABLE `movimiento_usuario`
  ADD CONSTRAINT `movimiento_usuario_ibfk_1` FOREIGN KEY (`archivoId`) REFERENCES `archivo` (`id`);

--
-- Filtros para la tabla `sesion_usuario`
--
ALTER TABLE `sesion_usuario`
  ADD CONSTRAINT `sesion_usuario_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`id`);

--
-- Filtros para la tabla `subcategoria`
--
ALTER TABLE `subcategoria`
  ADD CONSTRAINT `subcategoria_ibfk_1` FOREIGN KEY (`categoriaId`) REFERENCES `categoria` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
