-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 06-06-2019 a las 19:48:28
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softcomplentdb`
--
CREATE DATABASE IF NOT EXISTS `softcomplentdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `softcomplentdb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `control_ingreso`
--

CREATE TABLE `control_ingreso` (
  `idControlIngreso` int(11) NOT NULL,
  `idTarifa` int(11) NOT NULL,
  `responsableVehiculo` varchar(30) NOT NULL,
  `telefonoResponsable` varchar(30) NOT NULL,
  `Placa` varchar(6) NOT NULL,
  `usuarioEntrada` int(11) NOT NULL,
  `fechaEntrada` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `usuarioSalida` int(11) DEFAULT NULL,
  `fechaSalida` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `control_ingreso`
--

INSERT INTO `control_ingreso` (`idControlIngreso`, `idTarifa`, `responsableVehiculo`, `telefonoResponsable`, `Placa`, `usuarioEntrada`, `fechaEntrada`, `usuarioSalida`, `fechaSalida`, `Estado`) VALUES
(12, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:13:46', 1, '2019-06-05 22:19:05', b'0'),
(13, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:22:20', 1, '2019-06-05 17:24:57', b'0'),
(14, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:26:17', 1, '2019-06-05 17:26:30', b'0'),
(15, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:27:17', 1, '2019-06-05 17:27:28', b'0'),
(16, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:28:14', 1, '2019-06-05 17:28:23', b'0'),
(17, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:29:25', 1, '2019-06-05 17:37:09', b'0'),
(18, 5, 'Omar Javier Pacanchique', '3423424243', 'ERT444', 1, '2019-06-05 17:38:55', 1, '2019-06-05 17:42:30', b'0'),
(19, 3, 'Omar Javier Pacanchique', '3423424243', 'ERT44D', 1, '2019-06-05 17:46:10', 1, '2019-06-05 17:46:37', b'0'),
(20, 3, 'Omar Javier Pacanchique', '3423424243', 'ERT44D', 1, '2019-06-05 22:48:51', 2, '2019-06-06 18:22:39', b'0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `niveles_servicio`
--

CREATE TABLE `niveles_servicio` (
  `idNivelServicio` int(11) NOT NULL,
  `nombreNivelServicio` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `niveles_servicio`
--

INSERT INTO `niveles_servicio` (`idNivelServicio`, `nombreNivelServicio`) VALUES
(1, 'En altura o subterraneo con dos o más niveles'),
(2, 'Subterraneo, un solo nivel y 50 cupos o más'),
(3, 'Subterraneo, un solo nivel y con menos de 50 cupos'),
(4, 'A nivel, piso en concreto, asfalto o gravilla lavada de rio compactada y con 50 cupos o más'),
(5, 'A nivel, piso en concreto, asfalto o gravilla lavada de rio compactada y con menos de 50 cupos'),
(6, 'A nivel, pisos de afirmado o cesped');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL,
  `nombreRol` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `nombreRol`) VALUES
(1, 'Administrador'),
(2, 'Auxiliar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `idTarifa` int(11) NOT NULL,
  `idTipoVehiculo` int(11) NOT NULL,
  `idNivelServicio` int(11) NOT NULL,
  `valorTarifa` double(6,2) NOT NULL,
  `Estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idTarifa`, `idTipoVehiculo`, `idNivelServicio`, `valorTarifa`, `Estado`) VALUES
(3, 1, 1, 77.00, b'1'),
(5, 2, 1, 110.00, b'1'),
(6, 1, 2, 69.00, b'1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `idTipoDocumento` int(11) NOT NULL,
  `nombreTipoDocumento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`idTipoDocumento`, `nombreTipoDocumento`) VALUES
(1, 'Cédula'),
(2, 'Cédula extranjería'),
(3, 'Pasaporte');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_evento`
--

CREATE TABLE `tipo_evento` (
  `idTipoEvento` int(11) NOT NULL,
  `nombreTipoEvento` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_evento`
--

INSERT INTO `tipo_evento` (`idTipoEvento`, `nombreTipoEvento`) VALUES
(1, 'Ingreso'),
(2, 'Salida');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vehiculo`
--

CREATE TABLE `tipo_vehiculo` (
  `idTipoVehiculo` int(11) NOT NULL,
  `nombreTipoVehiculo` varchar(52) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_vehiculo`
--

INSERT INTO `tipo_vehiculo` (`idTipoVehiculo`, `nombreTipoVehiculo`) VALUES
(1, 'Motocicleta'),
(2, 'Automóviles, camperos, camionetas, vehículos pesados');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `idTipoDocumento` int(11) NOT NULL,
  `numeroDocumento` int(11) NOT NULL,
  `nombreUsuario` varchar(30) NOT NULL,
  `apellidoUsuario` varchar(30) NOT NULL,
  `telefonoUsuario` varchar(30) NOT NULL,
  `direccionUsuario` varchar(50) NOT NULL,
  `idRol` int(11) NOT NULL,
  `usuarioLogin` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Estado` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `idTipoDocumento`, `numeroDocumento`, `nombreUsuario`, `apellidoUsuario`, `telefonoUsuario`, `direccionUsuario`, `idRol`, `usuarioLogin`, `Password`, `Estado`) VALUES
(1, 1, 1019105979, 'Omar Javier', 'Pacanchique León', '3183587617', 'Carrera 156 # 137 03', 1, 'elpaco', '12345678', b'1'),
(2, 1, 102830902, 'Maria', 'Muñoz', '3124567889', 'Av siempre viva 742', 2, 'kakeles', '12345678', b'0');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `control_ingreso`
--
ALTER TABLE `control_ingreso`
  ADD PRIMARY KEY (`idControlIngreso`),
  ADD KEY `idTarifa` (`idTarifa`),
  ADD KEY `FK_control_ingreso_usuario` (`usuarioEntrada`),
  ADD KEY `FK_control_ingreso_usuario_2` (`usuarioSalida`);

--
-- Indices de la tabla `niveles_servicio`
--
ALTER TABLE `niveles_servicio`
  ADD PRIMARY KEY (`idNivelServicio`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`idTarifa`),
  ADD KEY `idTipoVehiculo` (`idTipoVehiculo`),
  ADD KEY `idNivelServicio` (`idNivelServicio`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`idTipoDocumento`);

--
-- Indices de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  ADD PRIMARY KEY (`idTipoEvento`);

--
-- Indices de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  ADD PRIMARY KEY (`idTipoVehiculo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `UNIQUE_Documento` (`idTipoDocumento`,`numeroDocumento`),
  ADD UNIQUE KEY `UsuarioLogin` (`usuarioLogin`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `control_ingreso`
--
ALTER TABLE `control_ingreso`
  MODIFY `idControlIngreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `niveles_servicio`
--
ALTER TABLE `niveles_servicio`
  MODIFY `idNivelServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `idTarifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `idTipoDocumento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_evento`
--
ALTER TABLE `tipo_evento`
  MODIFY `idTipoEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_vehiculo`
--
ALTER TABLE `tipo_vehiculo`
  MODIFY `idTipoVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `control_ingreso`
--
ALTER TABLE `control_ingreso`
  ADD CONSTRAINT `FK_control_ingreso_usuario` FOREIGN KEY (`usuarioEntrada`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `FK_control_ingreso_usuario_2` FOREIGN KEY (`usuarioSalida`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `control_ingreso_ibfk_1` FOREIGN KEY (`idTarifa`) REFERENCES `tarifa` (`idTarifa`);

--
-- Filtros para la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD CONSTRAINT `tarifa_ibfk_1` FOREIGN KEY (`idTipoVehiculo`) REFERENCES `tipo_vehiculo` (`idTipoVehiculo`),
  ADD CONSTRAINT `tarifa_ibfk_2` FOREIGN KEY (`idNivelServicio`) REFERENCES `niveles_servicio` (`idNivelServicio`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idTipoDocumento`) REFERENCES `tipo_documento` (`idTipoDocumento`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
