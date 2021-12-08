-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 24-10-2021 a las 17:10:12
-- Versión del servidor: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- Versión de PHP: 7.4.20

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
  `puntos` int(11) NOT NULL,
  `bajas` int(11) NOT NULL,
  `muertes` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`num_partida`, `mapa`, `puntos`, `bajas`, `muertes`, `nombreUsuario`) VALUES
('DOSF789', 'The Pines', 34032, 17, 5, 'boscoaran'),
('HFAI9131', 'Cartel', 34000, 23, 18, 'xaherpo'),
('HJEL3820', 'Nuketown', 23000, 35, 18, 'SrJowy'),
('HJQO7384', 'The Pines', 42894, 13, 5, 'SrJowy'),
('jkeu9384', 'The Pines', 3892, 4, 1, 'SrJowy'),
('ofhs7987', 'Cartel', 32408, 24, 9, 'SrJowy'),
('RHEW89', 'Nuketown', 30472, 35, 20, 'boscoaran'),
('URJS7391', 'Nuketown', 83020, 45, 27, 'diegom14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `dni` varchar(9) NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha_nac` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `contra` varchar(20) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `apellidos`, `dni`, `telefono`, `fecha_nac`, `email`, `contra`, `nombreUsuario`) VALUES
('Bosco', 'Aranguren', '65004204V', 760242495, '2001-04-03', 'bosco@gmail.com', '987654321', 'boscoaran'),
('Diego', 'Marta Hurtado', '00000023T', 743241907, '2000-09-04', 'diegomarta14@gmail.com', '987654321', 'diegom14'),
('Joel', 'Bra Ortiz', '22756654V', 634277690, '2001-07-09', 'jbra@gmail.com', '123456', 'JoelTest'),
('Juan', 'Alfonso', '22766905X', 944781748, '2003-07-09', 'juand@gmail.com', '987654321', 'JuanAn'),
('Joel', 'Bra Ortiz', '22756654V', 987654321, '2001-07-09', 'joelbraortiz@hotmail.com', '987654321', 'SrJowy'),
('Xabier', 'Hernández Polo', '00000023T', 723911398, '1999-12-03', 'xaherpo@gmail.com', '987654321', 'xaherpo');

--
-- Índices para tablas volcadas
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sesión`
--

CREATE TABLE `sesión` (
  `id` int(11) NOT NULL,
  `nombreUsuario` varchar(15) NOT NULL,
  `contra` varchar(20) NOT NULL,
  `fechahora` timestamp NOT NULL DEFAULT current_timestamp(),
  `exito` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

-- --------------------------------------------------------

--
-- Indices de la tabla `partida`
--
ALTER TABLE `partida`
  ADD PRIMARY KEY (`num_partida`,`nombreUsuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`nombreUsuario`);

--
-- Indices de la tabla `sesión`
--
ALTER TABLE `sesión`
  ADD PRIMARY KEY (`id`);


--
-- AUTO_INCREMENT de la tabla `sesión`
--
ALTER TABLE `sesión`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
