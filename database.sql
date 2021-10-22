-- phpMyAdmin SQL Dump
-- version 5.0.4deb2ubuntu5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-10-2021 a las 13:00:59
-- Versión del servidor: 8.0.26-0ubuntu1
-- Versión de PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `database`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

CREATE TABLE `partida` (
  `num_partida` varchar(15) NOT NULL,
  `mapa` varchar(15) NOT NULL,
  `puntos` int NOT NULL,
  `bajas` int NOT NULL,
  `muertes` int NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`num_partida`, `mapa`, `puntos`, `bajas`, `muertes`, `nombreUsuario`) VALUES
('432RH', 'Nuketown', 23000, 35, 18, 'SrJowy'),
('843jfk', 'The Pines', 3892, 4, 1, 'SrJowy'),
('DOSF789', 'The Pines', 34032, 17, 5, 'boscoaran'),
('ofhs79', 'Cartel', 32408, 24, 9, 'SrJowy'),
('RHEW89', 'Nuketown', 30472, 35, 20, 'boscoaran');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) CHARACTER SET utf8mb4 NOT NULL,
  `dni` varchar(9) NOT NULL,
  `telefono` int NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 NOT NULL,
  `contra` varchar(20) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `dni`, `telefono`, `fecha_nac`, `email`, `contra`, `nombreUsuario`) VALUES
('Bosco', 'Aranguren', '65004204V', 760242495, '2001-04-03', 'bosco@gmail.com', '987654321', 'boscoaran'),
('Joel', 'Bra Ortiz', '22756654V', 634277609, '2001-07-09', 'joelbraortiz@gmail.com', '123456', 'JuanAntonio'),
('Juan', 'Alfonso', '22766905X', 944781748, '2003-07-09', 'juand@gmail.com', 'AVEMARIA', 'MariaAA'),
('Joel', 'Bra Ortiz', '22756654V', 987654321, '2001-07-09', 'joelbraortiz@hotmail.com', 'HJELXL14', 'SrJowy');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`num_partida`,`nombreUsuario`),
  ADD KEY `nombreUsuario` (`nombreUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombreUsuario`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`nombreUsuario`) REFERENCES `usuario` (`nombreUsuario`),
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`nombreUsuario`) REFERENCES `usuario` (`nombreUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
