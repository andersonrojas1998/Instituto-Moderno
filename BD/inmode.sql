-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 29-03-2021 a las 01:46:29
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inmode`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acudiente`
--

DROP TABLE IF EXISTS `acudiente`;
CREATE TABLE IF NOT EXISTS `acudiente` (
  `id_acudiente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `identificacion` int(11) DEFAULT NULL,
  `id_tipo_parentesco` int(11) DEFAULT NULL,
  `expedida` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `barrio_id` int(11) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `profesion` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `empresa` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `grupo_etnico` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `discapacidad` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `viveCon` bigint(20) DEFAULT '1',
  `id_estado_civil` int(11) DEFAULT NULL,
  `responsable` bigint(20) DEFAULT '0',
  PRIMARY KEY (`id_acudiente`),
  KEY `fk_acudiente_tipo_parentesco1_idx` (`id_tipo_parentesco`),
  KEY `fk_acudiente_estado_civil1_idx` (`id_estado_civil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo_doc` int(11) NOT NULL,
  `identificacion` int(30) DEFAULT NULL,
  `lugar_expedicion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido1` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellido2` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre1` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre2` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `id_barrio` int(11) NOT NULL,
  `id_tipo_eps` int(11) NOT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `nac_depto` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `nac_muni` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `genero` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bigint(20) DEFAULT '1',
  `celular` int(11) DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_tipo_sangre` int(11) DEFAULT NULL,
  `email` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_alumno`),
  KEY `fk_alumno_tipo_eps1_idx` (`id_tipo_eps`),
  KEY `fk_alumno_tipo_documento1_idx` (`id_tipo_doc`),
  KEY `fk_alumno_departamento1_idx` (`id_departamento`),
  KEY `fk_alumno_municipio1_idx` (`id_municipio`),
  KEY `fk_alumno_barrio1_idx` (`id_barrio`),
  KEY `fk_alumno_tipo_sangre1_idx` (`id_tipo_sangre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno_acudiente`
--

DROP TABLE IF EXISTS `alumno_acudiente`;
CREATE TABLE IF NOT EXISTS `alumno_acudiente` (
  `id_alumno` int(11) NOT NULL,
  `id_acudiente` int(11) NOT NULL,
  KEY `fk_alumno_has_acudiente_acudiente1_idx` (`id_acudiente`),
  KEY `fk_alumno_has_acudiente_alumno1_idx` (`id_alumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aptitudes`
--

DROP TABLE IF EXISTS `aptitudes`;
CREATE TABLE IF NOT EXISTS `aptitudes` (
  `id_aptitudes` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_aptitudes`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

DROP TABLE IF EXISTS `area`;
CREATE TABLE IF NOT EXISTS `area` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignatura`
--

DROP TABLE IF EXISTS `asignatura`;
CREATE TABLE IF NOT EXISTS `asignatura` (
  `id_asignatura` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `orden_print` int(11) DEFAULT NULL,
  `tag` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_asignatura`),
  KEY `fk_materia_categoria1_idx` (`id_area`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

DROP TABLE IF EXISTS `asistencia`;
CREATE TABLE IF NOT EXISTS `asistencia` (
  `id_asistencia` int(11) NOT NULL AUTO_INCREMENT,
  `fecha_asistencia` datetime DEFAULT NULL,
  `asistio` bigint(20) DEFAULT '1',
  `id_curso` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_asistencia`),
  KEY `fk_asistencia_grado_docente_materia1_idx` (`id_curso`),
  KEY `fk_asistencia_matricula1_idx` (`id_matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `barrio`
--

DROP TABLE IF EXISTS `barrio`;
CREATE TABLE IF NOT EXISTS `barrio` (
  `id_barrio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_municipio` int(11) NOT NULL,
  `estrato` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_barrio`),
  KEY `fk_barrio_municipio1_idx` (`id_municipio`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `barrio`
--

INSERT INTO `barrio` (`id_barrio`, `nombre`, `id_municipio`, `estrato`) VALUES
(1, 'ALAMOS', 1, '1'),
(2, 'ALFONSO BONILLA', 1, '1'),
(3, 'ALIRIO MORA', 1, '1'),
(4, 'ANTONIO NARIÑO', 1, '1'),
(5, 'BRISAS DE LOS ALAMOS', 1, '1'),
(6, 'CALIMIO DESEPAZ', 1, '1'),
(7, 'CALIPSO', 1, '1'),
(8, 'CIUDAD CORDOBA', 1, '1'),
(9, 'CIUDADELA DEL RIO', 1, '1'),
(10, 'CIUDADELA DESEPAZ', 1, '1'),
(11, 'CIUDADELA INVICALI', 1, '1'),
(12, 'COMPARTIR', 1, '1'),
(13, 'COMUNEROS 2', 1, '1'),
(14, 'DESEPAZ', 1, '1'),
(15, 'EL TRONCAL', 1, '1'),
(16, 'FRANJA DEL RIO', 1, '1'),
(17, 'JARILLON', 1, '1'),
(18, 'JARILLÓN REMANSOS DE COMFANDI', 1, '1'),
(19, 'LA PAZ', 1, '1'),
(20, 'LAS ORQUIDEAS', 1, '1'),
(21, 'LIDERES', 1, '1'),
(22, 'LLANO VERDE', 1, '1'),
(23, 'MANANTIAL', 1, '1'),
(24, 'MANUELA BELTRAN', 1, '1'),
(25, 'MARROQUIN', 1, '1'),
(26, 'NAVARRO', 1, '1'),
(27, 'NUEVE DE ENERO ', 1, NULL),
(28, 'PETECUY', 1, NULL),
(29, 'PIZAMOS', 1, NULL),
(30, 'PIZAMOS 1', 1, NULL),
(31, 'PIZAMOS 2', 1, NULL),
(32, 'PIZAMOS 3', 1, NULL),
(34, 'POBLADO 2', 1, NULL),
(35, 'POTRERO GRANDE', 1, NULL),
(36, 'PUERTAS DEL SOL', 1, '1'),
(37, 'REMANSOS DE COMFANDI', 1, NULL),
(38, 'RIO CAUCA', 1, '1'),
(39, 'SAN MARCOS', 1, '1'),
(40, 'SIETE DE AGOSTO', 1, NULL),
(41, 'SOL DE ORIENTE', 1, NULL),
(42, 'TALANGA', 1, NULL),
(43, 'TALLERES', 1, '1'),
(44, 'TERCER MILENIO', 1, ''),
(45, 'TRONCAL', 1, ''),
(46, 'VALLEGRANDE', 1, '2'),
(47, 'NO DISPONIBLE', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calendario`
--

DROP TABLE IF EXISTS `calendario`;
CREATE TABLE IF NOT EXISTS `calendario` (
  `id_calendario` int(10) NOT NULL AUTO_INCREMENT,
  `tag` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_calendario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `calendario`
--

INSERT INTO `calendario` (`id_calendario`, `tag`, `descripcion`) VALUES
(1, 'A', NULL),
(2, 'B', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificaciones`
--

DROP TABLE IF EXISTS `calificaciones`;
CREATE TABLE IF NOT EXISTS `calificaciones` (
  `id_calificaciones` int(11) NOT NULL AUTO_INCREMENT,
  `id_periodo` int(11) NOT NULL,
  `id_matricula` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_asignatura` int(11) NOT NULL,
  `nota_cog1` float DEFAULT NULL,
  `nota_cog2` float DEFAULT NULL,
  `nota_cog3` float DEFAULT NULL,
  `nota_cog4` float DEFAULT NULL,
  `nota_soc1` float DEFAULT NULL,
  `nota_soc2` float DEFAULT NULL,
  `nota_soc3` float DEFAULT NULL,
  `nota_per1` float DEFAULT NULL,
  `nota_per2` float DEFAULT NULL,
  `nota_per3` float DEFAULT NULL,
  `nota_auto` float DEFAULT NULL,
  `nota_coe` float DEFAULT NULL,
  `nota_recuperacion` float DEFAULT NULL,
  `nota_definitiva` float NOT NULL,
  `aprobo` bigint(20) NOT NULL,
  `acumulativo` float NOT NULL,
  `notas_adicionales_id_nota` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_calificaciones`),
  KEY `fk_nota_periodo1_idx` (`id_periodo`),
  KEY `fk_nota_materia1_idx` (`id_asignatura`),
  KEY `fk_nota_profesor1_idx` (`id_docente`),
  KEY `fk_nota_matricula1_idx` (`id_matricula`),
  KEY `fk_calificaciones_notas_adicionales1_idx` (`notas_adicionales_id_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad_religiosa`
--

DROP TABLE IF EXISTS `comunidad_religiosa`;
CREATE TABLE IF NOT EXISTS `comunidad_religiosa` (
  `id_comunidad_religiosa` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_comunidad_religiosa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `curso`
--

DROP TABLE IF EXISTS `curso`;
CREATE TABLE IF NOT EXISTS `curso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_grado` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `año` year(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `intensidad_horaria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_grado_has_docente_docente1_idx` (`id_docente`),
  KEY `fk_grado_has_docente_grado1_idx` (`id_grado`),
  KEY `fk_grado_has_docente_materia_materia1_idx` (`id_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id_departamento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_pais` int(11) NOT NULL,
  `tag` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_departamento`),
  KEY `fk_departamento_pais1_idx` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	';

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id_departamento`, `nombre`, `id_pais`, `tag`) VALUES
(1, 'VALLE', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_civil`
--

DROP TABLE IF EXISTS `estado_civil`;
CREATE TABLE IF NOT EXISTS `estado_civil` (
  `id_estado_civil` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estado_civil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_matricula`
--

DROP TABLE IF EXISTS `estado_matricula`;
CREATE TABLE IF NOT EXISTS `estado_matricula` (
  `id_estado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_estado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

DROP TABLE IF EXISTS `grado`;
CREATE TABLE IF NOT EXISTS `grado` (
  `id_grado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `grupo` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `id_jornada` int(11) NOT NULL,
  `id_nivel_educativo` int(11) NOT NULL,
  `tag` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_docente` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_grado`),
  KEY `fk_grado_jornada_idx` (`id_jornada`),
  KEY `fk_grado_nivel_educativo1_idx` (`id_nivel_educativo`),
  KEY `fk_grado_users1_idx` (`id_docente`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`id_grado`, `nombre`, `grupo`, `id_jornada`, `id_nivel_educativo`, `tag`, `id_docente`, `created_at`, `updated_at`) VALUES
(1, 'GRUPO 0', '0-1', 1, 2, '0', NULL, '2021-03-28 23:57:21', '2021-03-28 23:57:53'),
(2, 'JARDIN', 'JARDIN-1', 1, 1, 'J', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(3, 'JARDIN', 'JARDIN-2', 2, 1, 'J', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(4, 'GRUPO 0', '0-2', 2, 2, '0', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(5, 'PRIMERO', '1-1', 1, 2, '1', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(6, 'PRIMERO', '1-2', 2, 2, '1', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(7, 'SEGUNDO', '2-1', 1, 2, '2', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(8, 'SEGUNDO', '2-2', 2, 2, '2', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(9, 'TERCERO', '3-1', 1, 2, '3', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(10, 'TERCERO', '3-2', 2, 2, '3', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(11, 'CUARTO', '4-1', 1, 2, '4', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(12, 'CUARTO', '4-2', 2, 2, '4', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(13, 'QUINTO', '5-1', 1, 2, '5', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(14, 'QUINTO', '5-2', 2, 2, '5', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(15, 'SEXTO', '6-1', 1, 3, '6', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(16, 'SEXTO', '6-2', 2, 3, '6', NULL, '2021-03-29 04:57:57', '2021-03-29 04:57:57'),
(17, 'SEPTIMO', '7-1', 1, 3, '7', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(18, 'SEPTIMO', '7-2', 1, 3, '7', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(19, 'SEPTIMO', '7-3', 2, 3, '7', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(20, 'OCTAVO', '8-1', 1, 3, '8', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(21, 'OCTAVO', '8-2', 2, 3, '8', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(22, 'NOVENO', '9-1', 1, 3, '9', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(23, 'NOVENO', '9-2', 2, 3, '9', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(24, 'DECIMO', '10-1', 1, 4, '10', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(25, 'DECIMO', '10-2', 1, 4, '10', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58'),
(26, 'ONCE', '11-1', 1, 4, '11', NULL, '2021-03-29 04:57:58', '2021-03-29 04:57:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_etnico`
--

DROP TABLE IF EXISTS `grupo_etnico`;
CREATE TABLE IF NOT EXISTS `grupo_etnico` (
  `id_grupo_etnico` int(11) NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_grupo_etnico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `grupo_etnico`
--

INSERT INTO `grupo_etnico` (`id_grupo_etnico`, `descripcion`) VALUES
(1, 'AFRO'),
(2, 'NINGUNO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

DROP TABLE IF EXISTS `institucion`;
CREATE TABLE IF NOT EXISTS `institucion` (
  `id_institucion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nit` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lema` varchar(150) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo_dane` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resolucion1` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resolucionCiclos` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `especialidad` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `comuna` int(11) DEFAULT '21',
  `paginaWeb` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_calendario` int(11) NOT NULL,
  `logo` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_institucion`),
  KEY `fk_institucion_calendario1_idx` (`id_calendario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`id_institucion`, `nombre`, `nit`, `lema`, `codigo_dane`, `resolucion1`, `resolucionCiclos`, `especialidad`, `comuna`, `paginaWeb`, `id_calendario`, `logo`) VALUES
(2, 'Instituto Moderno Desepaz', '900294173', 'Instruye al niño en su camino que aún aunque fuera viejo no se apartará de él. Proverbio 22:6', NULL, NULL, NULL, NULL, 21, 'inmode.edu.co', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

DROP TABLE IF EXISTS `jornada`;
CREATE TABLE IF NOT EXISTS `jornada` (
  `id_jornada` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) COLLATE utf8_spanish_ci DEFAULT NULL,
  `codigo` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jornada`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id_jornada`, `nombre`, `codigo`, `created_at`, `updated_at`) VALUES
(1, 'MAÑANA', 'A', '2021-03-28 20:42:39', '2021-03-28 20:42:39'),
(2, 'TARDE', 'B', '2021-03-28 20:42:39', '2021-03-28 20:42:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

DROP TABLE IF EXISTS `matricula`;
CREATE TABLE IF NOT EXISTS `matricula` (
  `id_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `cod_libro` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `simat` varchar(70) COLLATE utf8_spanish_ci NOT NULL,
  `grupo_simat` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_cursar` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `metodologia` int(11) DEFAULT '1',
  `año` year(4) NOT NULL,
  `fecha_matricula` datetime DEFAULT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_estado_matricula` int(11) DEFAULT NULL,
  `inst_anterior` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ciudad_colegio_origen` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `victima_conflicto` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `subsidiado` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `viveCon` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_motivos_retiro` int(11) DEFAULT NULL,
  `fecha_retiro` date DEFAULT NULL,
  `total_hermanos` int(11) DEFAULT NULL,
  `no_mujeres` int(11) DEFAULT NULL,
  `no_hombres` int(11) DEFAULT NULL,
  `lugar_ocupa_hermanos` int(11) DEFAULT NULL,
  `hm_inmode` int(11) DEFAULT NULL,
  `parientes_inmode` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_pariente` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `grado_pariente` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_motivo_matricula` int(11) DEFAULT NULL,
  `comunidad_religiosa` int(11) DEFAULT NULL,
  `grupo_etnico` int(11) NOT NULL,
  `tipo_discapacidad` int(11) NOT NULL,
  `info_general` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `conCuantosVive` int(11) DEFAULT NULL,
  `conQuienPermanceMas` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `areaEstudioPreferida` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `areaMayorDificultad` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_sede` int(11) NOT NULL,
  `id_tipo_matricula` int(11) DEFAULT NULL,
  `id_modalidad_sena` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_matricula`),
  KEY `fk_matricula_alumno1_idx` (`id_alumno`),
  KEY `fk_matricula_grado1_idx` (`id_grado`),
  KEY `fk_matricula_estado_matricula1_idx` (`id_estado_matricula`),
  KEY `fk_matricula_motivos_retiro1_idx` (`id_motivos_retiro`),
  KEY `fk_matricula_motivo_matricula1_idx` (`id_motivo_matricula`),
  KEY `fk_matricula_comunidad_religiosa1_idx` (`comunidad_religiosa`),
  KEY `fk_matricula_grupo_etnico1_idx` (`grupo_etnico`),
  KEY `fk_matricula_tipo_discapacidad1_idx` (`tipo_discapacidad`),
  KEY `fk_matricula_sede1_idx` (`id_sede`),
  KEY `fk_matricula_tipo_matricula1_idx` (`id_tipo_matricula`),
  KEY `fk_matricula_modalidad_sena1_idx` (`id_modalidad_sena`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula_has_aptitudes`
--

DROP TABLE IF EXISTS `matricula_has_aptitudes`;
CREATE TABLE IF NOT EXISTS `matricula_has_aptitudes` (
  `matricula_id_matricula` int(11) NOT NULL,
  `aptitudes_id_aptitudes` int(11) NOT NULL,
  KEY `fk_matricula_has_aptitudes_aptitudes1_idx` (`aptitudes_id_aptitudes`),
  KEY `fk_matricula_has_aptitudes_matricula1_idx` (`matricula_id_matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modalidad_sena`
--

DROP TABLE IF EXISTS `modalidad_sena`;
CREATE TABLE IF NOT EXISTS `modalidad_sena` (
  `id_modalidad_sena` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `estado` bigint(20) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_modalidad_sena`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `modalidad_sena`
--

INSERT INTO `modalidad_sena` (`id_modalidad_sena`, `nombre`, `descripcion`, `tag`, `estado`, `created_at`) VALUES
(1, 'MODALIDAD MIPS', 'Paneles solares', 'M1', 1, '2021-03-27 22:38:52'),
(2, 'MODALIDAD MA', 'Medio ambiente', 'M2', 1, '2021-03-27 22:38:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos_retiro`
--

DROP TABLE IF EXISTS `motivos_retiro`;
CREATE TABLE IF NOT EXISTS `motivos_retiro` (
  `id_motivos_retiro` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_motivos_retiro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivo_matricula`
--

DROP TABLE IF EXISTS `motivo_matricula`;
CREATE TABLE IF NOT EXISTS `motivo_matricula` (
  `id_motivo_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_motivo_matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='	';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id_municipio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id_municipio`),
  KEY `fk_municipio_departamento1_idx` (`id_departamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='		';

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `nombre`, `id_departamento`) VALUES
(1, 'CALI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nivel_educativo`
--

DROP TABLE IF EXISTS `nivel_educativo`;
CREATE TABLE IF NOT EXISTS `nivel_educativo` (
  `id_nivel_educativo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_nivel_educativo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `nivel_educativo`
--

INSERT INTO `nivel_educativo` (`id_nivel_educativo`, `nombre`, `tag`) VALUES
(1, 'PRESCOLAR', 'PRI'),
(2, 'PRIMARIA', 'SEC'),
(3, 'SECUNDARIA', NULL),
(4, 'EDUCACION MEDIA', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas_adicionales`
--

DROP TABLE IF EXISTS `notas_adicionales`;
CREATE TABLE IF NOT EXISTS `notas_adicionales` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(80) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id_nota`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`, `tag`) VALUES
(1, 'Colombia', 'COL'),
(2, 'Venezuela', 'VENZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodo`
--

DROP TABLE IF EXISTS `periodo`;
CREATE TABLE IF NOT EXISTS `periodo` (
  `id_periodo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porcentaje` int(11) DEFAULT NULL,
  `codigo` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `inicio_periodo` date DEFAULT NULL,
  `fin_periodo` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `estado` bigint(20) DEFAULT '1',
  PRIMARY KEY (`id_periodo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci COMMENT='		';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE IF NOT EXISTS `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `id_institucion` int(11) NOT NULL,
  `barrio` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_sede`),
  KEY `fk_sede_institucion1_idx` (`id_institucion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre`, `telefono`, `direccion`, `email`, `id_institucion`, `barrio`) VALUES
(1, 'PRINCIPAL', '301 3772939', 'CRA. 25BIS NO. 122-19', 'inmode12@yahoo.es', 2, 'Desepaz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_discapacidad`
--

DROP TABLE IF EXISTS `tipo_discapacidad`;
CREATE TABLE IF NOT EXISTS `tipo_discapacidad` (
  `id_tipo_discapacidad` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_discapacidad`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_discapacidad`
--

INSERT INTO `tipo_discapacidad` (`id_tipo_discapacidad`, `descripcion`) VALUES
(1, 'AUDITIVA'),
(2, 'VISUAL'),
(3, 'SI'),
(4, 'NINGUNA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

DROP TABLE IF EXISTS `tipo_documento`;
CREATE TABLE IF NOT EXISTS `tipo_documento` (
  `id_tipo_doc` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `tag` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_tipo_doc`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_doc`, `descripcion`, `tag`) VALUES
(1, 'Registro Civil TI', 'RC'),
(2, 'Tarjeta de identidad', 'TI'),
(4, ' Cédula de ciudadanía', 'CC'),
(5, 'Cédula de extranjería', 'CE'),
(6, 'Pasaporte', 'PA'),
(7, 'Menor sin identificación', ' MS'),
(8, 'Permiso especial', 'PE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_eps`
--

DROP TABLE IF EXISTS `tipo_eps`;
CREATE TABLE IF NOT EXISTS `tipo_eps` (
  `id_tipo_eps` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_eps`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_eps`
--

INSERT INTO `tipo_eps` (`id_tipo_eps`, `nombre`) VALUES
(1, 'ASMED SALUD '),
(2, 'ASOCIACION INDIGENA DEL CAUCA '),
(3, 'ASOCIACION MUTUAL BARRIOS UNIDOS DE QUIBDO '),
(4, 'ASOCIACION MUTUAL EMPRESA SOLIDARIA DE SALUD NARIÑO '),
(5, 'CAFE SALUD'),
(6, 'CALI SALUD '),
(7, 'CAPRECOM '),
(8, 'CARTA SISBEN'),
(9, 'CEDIMA'),
(10, 'COFENALCO'),
(11, 'COLSUBSIDIO '),
(12, 'COMFA CHOCO '),
(14, 'COMFENALCO'),
(15, 'COMPENSAR '),
(16, 'COODSALUD'),
(17, 'COOMEVA'),
(18, 'COONGUA'),
(19, 'CRUZ BLANCA'),
(20, 'E.S.E MUNICIPAL'),
(21, 'EMSSANAR  '),
(22, 'FAMISANAR EPS CAFAM'),
(23, 'MEDICALL'),
(24, 'MEDIMAS '),
(25, 'N/A'),
(26, 'NO APLICA'),
(27, 'NUEVA EPS'),
(28, 'PENDIENTE'),
(29, 'POLICIA NACIONAL '),
(30, 'POLICLINICA '),
(31, 'S.O.S'),
(32, 'SALUD TOTAL'),
(33, 'SALUDCOOP'),
(34, 'SANIDAD FUERZAS MILITARES '),
(35, 'SANITAS '),
(36, 'SERVICIO OCCIDENTAL DE SALUD-S.O.S. S.A.'),
(37, 'SISBEN '),
(38, 'SURA '),
(39, 'COMFAMILIAR NARIÑO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_matricula`
--

DROP TABLE IF EXISTS `tipo_matricula`;
CREATE TABLE IF NOT EXISTS `tipo_matricula` (
  `id_tipo_matricula` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_matricula`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_matricula`
--

INSERT INTO `tipo_matricula` (`id_tipo_matricula`, `descripcion`) VALUES
(1, 'NUEVO'),
(2, 'REPITENTE'),
(3, 'ANTIGUO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_parentesco`
--

DROP TABLE IF EXISTS `tipo_parentesco`;
CREATE TABLE IF NOT EXISTS `tipo_parentesco` (
  `id_tipo_parentesco` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_parentesco`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_parentesco`
--

INSERT INTO `tipo_parentesco` (`id_tipo_parentesco`, `nombre`) VALUES
(1, 'ABUELA'),
(2, 'ABUELO'),
(3, 'AMIGA'),
(4, 'MADRASTRA'),
(5, 'TIA'),
(6, 'BISABUELA'),
(7, 'HERMANA'),
(8, 'HERMANO'),
(9, 'MADRE'),
(10, 'MADRE ADOPTIVA'),
(11, 'MADRINA'),
(12, 'NIÑERA'),
(13, 'OTRO'),
(14, 'PADRASTRO'),
(15, 'PADRE'),
(16, 'PADRINO'),
(17, 'PRIMA'),
(18, 'TIA '),
(19, 'TIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_sangre`
--

DROP TABLE IF EXISTS `tipo_sangre`;
CREATE TABLE IF NOT EXISTS `tipo_sangre` (
  `id_tipo_sangre` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_tipo_sangre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` int(30) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` bigint(10) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telefono` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `celular` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_sede` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `lugar_expedicion` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cargo` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genero` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_estado_civil` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_sede1_idx` (`id_sede`),
  KEY `fk_users_estado_civil1_idx` (`id_estado_civil`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `identificacion`, `name`, `estado`, `created_at`, `updated_at`, `email`, `email_verified_at`, `password`, `remember_token`, `direccion`, `telefono`, `celular`, `id_sede`, `fecha_nacimiento`, `lugar_expedicion`, `cargo`, `genero`, `foto`, `id_estado_civil`) VALUES
(1, 1143991688, 'Anderson David Rojas', 1, '2021-03-26 03:06:58', '2021-03-26 03:06:58', 'rojasanderson07@gmail.com', NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', 'mwqvZZzYMeUrRJopHl0FlvjJmp6RZuVcmWsbsMVs0m5UFZbUwNDAIZC7zCFQ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 31991910, 'ADRIANA ACOSTA', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', 'CHGLoC1CKYPQ5TBljycjYE7iikFaYMPxugXvO0qERvRIvUBtilLpCg5VztYD', NULL, NULL, '3168115832', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(3, 31532061, 'ALEXANDRA CUEVAS', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3187480447', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(4, 87944792, 'ANGELO CORTES', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3175919954', 1, NULL, NULL, 'Docente', 'M', NULL, NULL),
(5, 31176988, 'ELIZABETH BONILLA', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3152726784', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(6, 7534502, 'HECTOR ANTONIO GONZALEZ', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '315238829', 1, NULL, NULL, 'Docente', 'M', NULL, NULL),
(7, 1144149099, 'ILVIA MARCELA VILLAREAL', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3043411895', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(8, 1126454580, 'JHONIER MAURICIO ORTIZ', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3217155204', 1, NULL, NULL, 'Docente', 'M', NULL, NULL),
(9, 29120588, 'LILIA DEL SOCORRO IBARGUEN MACHADO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3104176453', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(10, 1130666252, 'NANCY LUCIA  CASTILLO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3142976543', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(11, 66920722, 'NAYDA CUERO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3153066048', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(12, 31490312, 'OLGA MARIA HERNANDEZ', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3188448098', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(13, 123456789, 'ADRIANA PARDO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3175144266', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(14, 38463925, 'SANDRA OSORIO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3184522924', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(15, 1060356144, 'CATHERINE CHOCO', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3234863036', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(16, 1097398325, 'NATALIA SEPULVEDA ', 1, '2021-03-29 04:15:19', '2021-03-29 04:15:19', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3176646729', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(17, 16925362, 'JHON CRUZ', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3168121559', 1, NULL, NULL, 'Docente', 'M', NULL, NULL),
(18, 1143990130, 'JESSICA CASTRO MENESES ', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3114501075', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(19, 66829568, 'LUZ ELENA MORENO', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3041026866', 1, NULL, NULL, 'Docente', 'F', NULL, NULL),
(20, 1143957806, 'FREINER RAMIREZ', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3052598008', 1, NULL, NULL, 'Coordinador', 'F', NULL, NULL),
(21, 1118285661, 'LILIANA VARELA MUÑOZ', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3154683200', 1, NULL, NULL, 'Rectora', 'F', NULL, NULL),
(22, 1144192422, 'DIANA ALEJANDRA ROJAS ', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3185389435', 1, NULL, NULL, 'Secretaria', 'F', NULL, NULL),
(23, 16743912, 'JAIRO CRUZ BOLAÑOS', 1, '2021-03-29 04:15:20', '2021-03-29 04:15:20', NULL, NULL, '$2y$10$odheLv9bS5EGTjxmIgFUmeaqy/GZrhT9UFn0lfUIpCX8tjc5Lo0ni', NULL, NULL, NULL, '3154663617', 1, NULL, NULL, 'Representante legal', 'M', NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acudiente`
--
ALTER TABLE `acudiente`
  ADD CONSTRAINT `fk_acudiente_estado_civil1` FOREIGN KEY (`id_estado_civil`) REFERENCES `estado_civil` (`id_estado_civil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_acudiente_tipo_parentesco1` FOREIGN KEY (`id_tipo_parentesco`) REFERENCES `tipo_parentesco` (`id_tipo_parentesco`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno`
--
ALTER TABLE `alumno`
  ADD CONSTRAINT `fk_alumno_barrio1` FOREIGN KEY (`id_barrio`) REFERENCES `barrio` (`id_barrio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_departamento1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_municipio1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_tipo_documento1` FOREIGN KEY (`id_tipo_doc`) REFERENCES `tipo_documento` (`id_tipo_doc`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_tipo_eps1` FOREIGN KEY (`id_tipo_eps`) REFERENCES `tipo_eps` (`id_tipo_eps`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_tipo_sangre1` FOREIGN KEY (`id_tipo_sangre`) REFERENCES `tipo_sangre` (`id_tipo_sangre`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `alumno_acudiente`
--
ALTER TABLE `alumno_acudiente`
  ADD CONSTRAINT `fk_alumno_has_acudiente_acudiente1` FOREIGN KEY (`id_acudiente`) REFERENCES `acudiente` (`id_acudiente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_alumno_has_acudiente_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asignatura`
--
ALTER TABLE `asignatura`
  ADD CONSTRAINT `fk_materia_categoria1` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_categoria`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `fk_asistencia_grado_docente_materia1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_asistencia_matricula1` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `barrio`
--
ALTER TABLE `barrio`
  ADD CONSTRAINT `fk_barrio_municipio1` FOREIGN KEY (`id_municipio`) REFERENCES `municipio` (`id_municipio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `calificaciones`
--
ALTER TABLE `calificaciones`
  ADD CONSTRAINT `fk_calificaciones_notas_adicionales1` FOREIGN KEY (`notas_adicionales_id_nota`) REFERENCES `notas_adicionales` (`id_nota`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_materia1` FOREIGN KEY (`id_asignatura`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_matricula1` FOREIGN KEY (`id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_periodo1` FOREIGN KEY (`id_periodo`) REFERENCES `periodo` (`id_periodo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_profesor1` FOREIGN KEY (`id_docente`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `curso`
--
ALTER TABLE `curso`
  ADD CONSTRAINT `fk_grado_has_docente_docente1` FOREIGN KEY (`id_docente`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_has_docente_grado1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_has_docente_materia_materia1` FOREIGN KEY (`id_materia`) REFERENCES `asignatura` (`id_asignatura`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `fk_departamento_pais1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id_pais`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `grado`
--
ALTER TABLE `grado`
  ADD CONSTRAINT `fk_grado_jornada` FOREIGN KEY (`id_jornada`) REFERENCES `jornada` (`id_jornada`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_nivel_educativo1` FOREIGN KEY (`id_nivel_educativo`) REFERENCES `nivel_educativo` (`id_nivel_educativo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_grado_users1` FOREIGN KEY (`id_docente`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD CONSTRAINT `fk_institucion_calendario1` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `fk_matricula_alumno1` FOREIGN KEY (`id_alumno`) REFERENCES `alumno` (`id_alumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_comunidad_religiosa1` FOREIGN KEY (`comunidad_religiosa`) REFERENCES `comunidad_religiosa` (`id_comunidad_religiosa`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_estado_matricula1` FOREIGN KEY (`id_estado_matricula`) REFERENCES `estado_matricula` (`id_estado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_grado1` FOREIGN KEY (`id_grado`) REFERENCES `grado` (`id_grado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_grupo_etnico1` FOREIGN KEY (`grupo_etnico`) REFERENCES `grupo_etnico` (`id_grupo_etnico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_modalidad_sena1` FOREIGN KEY (`id_modalidad_sena`) REFERENCES `modalidad_sena` (`id_modalidad_sena`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_motivo_matricula1` FOREIGN KEY (`id_motivo_matricula`) REFERENCES `motivo_matricula` (`id_motivo_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_motivos_retiro1` FOREIGN KEY (`id_motivos_retiro`) REFERENCES `motivos_retiro` (`id_motivos_retiro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_sede1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_tipo_discapacidad1` FOREIGN KEY (`tipo_discapacidad`) REFERENCES `tipo_discapacidad` (`id_tipo_discapacidad`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_tipo_matricula1` FOREIGN KEY (`id_tipo_matricula`) REFERENCES `tipo_matricula` (`id_tipo_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `matricula_has_aptitudes`
--
ALTER TABLE `matricula_has_aptitudes`
  ADD CONSTRAINT `fk_matricula_has_aptitudes_aptitudes1` FOREIGN KEY (`aptitudes_id_aptitudes`) REFERENCES `aptitudes` (`id_aptitudes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_matricula_has_aptitudes_matricula1` FOREIGN KEY (`matricula_id_matricula`) REFERENCES `matricula` (`id_matricula`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `fk_municipio_departamento1` FOREIGN KEY (`id_departamento`) REFERENCES `departamento` (`id_departamento`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sede`
--
ALTER TABLE `sede`
  ADD CONSTRAINT `fk_sede_institucion1` FOREIGN KEY (`id_institucion`) REFERENCES `institucion` (`id_institucion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_estado_civil1` FOREIGN KEY (`id_estado_civil`) REFERENCES `estado_civil` (`id_estado_civil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_sede1` FOREIGN KEY (`id_sede`) REFERENCES `sede` (`id_sede`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
