-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-02-2023 a las 23:29:49
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soporte`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesores`
--

CREATE DATABASE IF NOT EXISTS `soporte` CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE `asesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `cargo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `asesores`
--

INSERT INTO `asesores` (`id`, `nombre`, `email`, `telefono`, `cargo`) VALUES
(121548, 'ANDY RENTERIA', 'andy.renteria@insuempresa.com', '3204155698', 'ASESOR'),
(25654785, 'JOPSAN RODIRGUEZ', 'jopsan.rodriguez@insuempresa.com', '3256987414', 'JEFE DE SOPORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` varchar(60) NOT NULL,
  `nombre` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL,
  `direccion` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `ciudad` varchar(60) NOT NULL,
  `nombre_contacto` varchar(150) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `celular` varchar(20) NOT NULL,
  `email_contacto` varchar(150) NOT NULL,
  `tiempo` int(11) DEFAULT 0,
  `actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `email`, `direccion`, `telefono`, `ciudad`, `nombre_contacto`, `cargo`, `celular`, `email_contacto`, `tiempo`, `actualizacion`) VALUES
('123154165', 'ALGODOSAN/BIOESPUMAS/ESPUMASDOS BUCARAMANGA FELIX ANTONIO RINO¡CÑ', 'bioespumas@gmail.com', 'Calle 16 # 3-28', '7118243', 'PIEDECUESTA', 'Ezequiel Bernad Reguera', 'CONTADOR', '3105471535', 'ezequiel.bernad@gmail.com\r\n', 135, '2023-02-03 12:12:54'),
('123456789', 'JOSE PEREZ', 'jose.perez@example.com', 'CLL 7 # 12-16', '3204895623', 'BUCARAMANGA', 'OMAR TORRES', 'CONTADOR', '3216547896', 'OMAR.TORRES@EXAMPLE.COM', 0, NULL),
('156548451', 'JUAN CARLOS ALDANA', 'juan.aldana@gmail.com', 'Carrera 10 # 3-92', '6949514', 'SAN GIL', 'Jose Angel Abril Belmonte', 'ADMINISTRADOR', '3221724758', 'jose.abril@gmail.com\r\n', 0, '2023-02-03 12:12:54'),
('201584151', 'ANDRÉS MAURICIO ESCARIA BARRAZA  ESCUELA NACIONAL DE FORMACION EN SALUD', 'andres.escaria@gmail.com', 'Calle 5 # 4-48', '5098753', 'GIRON', 'Leire Antúnez Fiol', 'ADMINISTRADOR', '3041456642', 'leire.antunez@gmail.com\r\n', 0, '2023-02-03 12:12:54'),
('231514548', 'MANUEL GUILLERMO ARENAS GARCIA', 'manuel.arenas@gmail.com', 'Avenida 3 norte # 50N-20', '7540796', 'LEBRIJA', 'Herminio Romeu Galindo', 'CONTADOR', '3002282749', 'herminio.romeu@gmail.com\r\n', 0, '2023-02-03 12:12:54'),
('326232165', 'SARA TATIANA GIRALDO GIRALDO', 'sara.giraldo@gmail.com', 'carrera 8 #15?-19', '7154267', 'BARRANCABERMEJA', 'Esteban Amorós Benavente', 'CONTADOR', '3116452536', 'esteban.amoros@gmail.com\r\n', 0, '2023-02-03 12:12:54'),
('415615184', 'NENA CECILIA GIRALDO GOMEZ', 'nena.giraldo@gmail.com', 'Transversal 9 a No. 29 - 29', '9284003', 'FLORIDABLANCA', 'Paz Ramis Paniagua', 'CONTADOR', '3204589625', 'paz.paniagua@gmail.com\r\n', 0, '2023-02-03 12:12:54'),
('900458654', 'FERNEL  DIAZ PRADA  HOTEL MONACO', 'hotelmontano@gmail.com', 'Calle 10 # 5-51', '5639777', 'BUCARAMANGA', 'Toribio de Ortega', 'ADMINISTRADOR', '3135487126', 'toribio.ortega@gmail.com\r\n', 0, '2023-02-03 12:12:54');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_factura` varchar(60) NOT NULL,
  `id_cliente` varchar(60) NOT NULL,
  `fecha` date NOT NULL,
  `fecha_ven` date NOT NULL,
  `valor` varchar(60) NOT NULL,
  `tiempo` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_factura`, `id_cliente`, `fecha`, `fecha_ven`, `valor`, `tiempo`) VALUES
('FVT001', '123154165', '2023-02-03', '2023-03-02', '168000', '120'),
('FVT002', '123154165', '2023-02-03', '2023-03-03', '78000', '60');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id`, `nombre`) VALUES
(5, 'CONTABILIDAD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `id_factura` varchar(60) NOT NULL,
  `fecha` date NOT NULL,
  `abono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `id_factura`, `fecha`, `abono`) VALUES
(2, 'FVT001', '2023-02-03', '100000'),
(3, 'FVT001', '2023-02-03', '68000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` varchar(1) CHARACTER SET latin1 NOT NULL,
  `nombre` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`) VALUES
('1', 'Administrador'),
('2', 'Cliente'),
('3', 'Asesor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_cliente` varchar(15) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL DEFAULT 0,
  `tipo_servicio` int(11) NOT NULL,
  `ticket` varchar(11) NOT NULL,
  `modulo` int(11) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `fecha` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `tiempo` varchar(10) NOT NULL,
  `persona_recibe` varchar(600) NOT NULL,
  `cargo` varchar(600) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_cliente`, `id_asesor`, `id_servicio`, `tipo_servicio`, `ticket`, `modulo`, `descripcion`, `fecha`, `hora_inicio`, `hora_fin`, `tiempo`, `persona_recibe`, `cargo`) VALUES
('123154165', 121548, 2301001, 1, 'SI', 5, 'JDH', '2023-01-30', '12:00:00', '13:00:00', '45', 'Nombre persona que recibe', 'Cargo  Persona'),
('123154165', 121548, 2302002, 1, 'SI', 5, 'ACTUALIZACION DEL SOFTWARE', '2023-02-03', '08:00:00', '09:00:00', '45', 'JUAN PEREZ', 'CONTADOR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id` int(11) NOT NULL,
  `id_ticket` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `id_asesor` int(11) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `solucion` varchar(600) DEFAULT NULL,
  `tarea_cliente` varchar(600) NOT NULL,
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id`, `id_ticket`, `id_servicio`, `id_asesor`, `descripcion`, `solucion`, `tarea_cliente`, `estado`) VALUES
(3, 1, 2301001, 121548, 'ABSSDDS', 'solución desde la pagina del asesor', 'Ninguna', 'RESUELTO'),
(4, 1, 2301001, 121548, 'tarea de prueba', 'solucion de prueba', 'ninguna tarea pendiente por el cliente', 'RESUELTO'),
(2302002, 1, 2302002, 121548, 'REVISION DE LA BASE DE DATOS DEL SOFTWARE', NULL, 'NINGUNO', 'PENDIENTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tickets`
--

INSERT INTO `tickets` (`id`, `nombre`) VALUES
(1, 'REVISION BD');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_servicio`
--

CREATE TABLE `tipo_servicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_servicio`
--

INSERT INTO `tipo_servicio` (`id`, `nombre`) VALUES
(1, 'SOPORTE TECNICO VIRTUAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `cargo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `clave`, `cargo`) VALUES
('1003504814', 'ANGI BENAVIDES', 'desarrollo@nobutic.com', '931108', '1'),
('121548', 'ASESOR PRUEBA', 'asesor@insuempresa.com', '931108', '3'),
('123154165', 'ALGODON BUCARAMANGA', 'algodonbga@cliente.com', '931108', '2'),
('25654785', 'JOPSAN RODIRGUEZ', 'jopsan.rodriguez@insuempresa.com', '123456', '3');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asesores`
--
ALTER TABLE `asesores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `fk_clientecompra` (`id_cliente`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_compra` (`id_factura`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`),
  ADD KEY `fk_cliente` (`id_cliente`),
  ADD KEY `fk_asesor` (`id_asesor`),
  ADD KEY `fk_tipo_servicio` (`tipo_servicio`),
  ADD KEY `fk_modulo` (`modulo`);

--
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_asesor_tarea` (`id_asesor`),
  ADD KEY `fk_servicio` (`id_servicio`);

--
-- Indices de la tabla `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rol` (`cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_servicio`
--
ALTER TABLE `tipo_servicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `fk_clientecompra` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `fk_compra` FOREIGN KEY (`id_factura`) REFERENCES `compras` (`id_factura`);

--
-- Filtros para la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD CONSTRAINT `fk_asesor` FOREIGN KEY (`id_asesor`) REFERENCES `asesores` (`id`),
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `fk_modulo` FOREIGN KEY (`modulo`) REFERENCES `modulos` (`id`),
  ADD CONSTRAINT `fk_tipo_servicio` FOREIGN KEY (`tipo_servicio`) REFERENCES `tipo_servicio` (`id`);

--
-- Filtros para la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD CONSTRAINT `fk_asesor_tarea` FOREIGN KEY (`id_asesor`) REFERENCES `asesores` (`id`),
  ADD CONSTRAINT `fk_servicio` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`cargo`) REFERENCES `rol` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
