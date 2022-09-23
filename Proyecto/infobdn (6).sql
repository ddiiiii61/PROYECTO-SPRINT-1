-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-09-2022 a las 19:18:46
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `infobdn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `USUARI` varchar(20) NOT NULL,
  `PASSWD` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`USUARI`, `PASSWD`) VALUES
('admin', '0cc175b9c0f1b6a831c399e269772661');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnes`
--

CREATE TABLE `alumnes` (
  `EMAIL` varchar(20) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `COGNOMS` varchar(20) NOT NULL,
  `EDAT` int(11) NOT NULL,
  `FOTO` varchar(50) NOT NULL,
  `CURSOS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `CODI` int(11) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `DESCRIPCIO` varchar(50) NOT NULL,
  `HORES` int(11) NOT NULL,
  `INICI` date NOT NULL,
  `FI` date NOT NULL,
  `DNIPROFESSOR` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`CODI`, `NOM`, `DESCRIPCIO`, `HORES`, `INICI`, `FI`, `DNIPROFESSOR`) VALUES
(161, 'ASIX', '', 120, '2022-09-09', '2022-09-24', '123A'),
(183, 'DAW', '', 100, '2022-09-02', '2022-10-29', '123A'),
(588, 'Anatomía', '', 190, '2022-09-04', '2022-12-30', '49457S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `matricula`
--

CREATE TABLE `matricula` (
  `CODI` int(11) NOT NULL,
  `DNI ALUMNE` varchar(20) NOT NULL,
  `NOTA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `professors`
--

CREATE TABLE `professors` (
  `DNI` varchar(20) NOT NULL,
  `CONTRASENYA` varchar(50) NOT NULL,
  `NOM` varchar(20) NOT NULL,
  `COGNOMS` varchar(20) NOT NULL,
  `TITOL` varchar(20) NOT NULL,
  `FOTO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `professors`
--

INSERT INTO `professors` (`DNI`, `CONTRASENYA`, `NOM`, `COGNOMS`, `TITOL`, `FOTO`) VALUES
('12345B', '92eb5ffee6ae2fec3ad71c777531578f', 'Igor', 'Sputz', 'Matemático', 'imagenes-JPEG.jpg'),
('123A', '0cc175b9c0f1b6a831c399e269772661', 'Carlos', 'Redondo', 'Ingeniero', 'news-presentacion-nueva-news-v2.jpg'),
('49457S', 'e1671797c52e15f763380b45e841ec32', 'Sara', 'Ponts', 'Medicina', 'Captura.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnes`
--
ALTER TABLE `alumnes`
  ADD PRIMARY KEY (`EMAIL`,`DNI`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`CODI`),
  ADD KEY `cursos_ibfk_1` (`DNIPROFESSOR`);

--
-- Indices de la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`CODI`,`DNI ALUMNE`);

--
-- Indices de la tabla `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`DNI`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD CONSTRAINT `cursos_ibfk_1` FOREIGN KEY (`DNIPROFESSOR`) REFERENCES `professors` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`CODI`) REFERENCES `cursos` (`CODI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
