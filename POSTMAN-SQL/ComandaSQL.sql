-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-11-2021 a las 21:24:18
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `comanda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE `encuestas` (
  `id` int(255) NOT NULL,
  `id_mesa` varchar(255) NOT NULL,
  `id_cliente` varchar(255) NOT NULL,
  `valoracion_descripcion` varchar(255) NOT NULL,
  `valoracion_mesa` varchar(255) NOT NULL,
  `valoracion_restaurante` varchar(255) NOT NULL,
  `valoracion_mozo` varchar(255) NOT NULL,
  `valoracion_cocinero` varchar(255) NOT NULL,
  `valoracion_cervecero` varchar(255) NOT NULL,
  `valoracion_bartender` varchar(255) NOT NULL,
  `fecha_hora` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`id`, `id_mesa`, `id_cliente`, `valoracion_descripcion`, `valoracion_mesa`, `valoracion_restaurante`, `valoracion_mozo`, `valoracion_cocinero`, `valoracion_cervecero`, `valoracion_bartender`, `fecha_hora`) VALUES
(3, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10', '2021-11-26 22:53'),
(4, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10', '2021-11-26 22:55'),
(5, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10', '2021-11-26 22:56'),
(6, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10', '2021-11-26 22:56'),
(7, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10', '2021-11-26 23:06'),
(8, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:37'),
(9, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:37'),
(10, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:37'),
(11, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:37'),
(12, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:37'),
(13, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:52'),
(14, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:52'),
(15, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:52'),
(16, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:52'),
(17, '1', 'cliente@cliente.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:52'),
(18, '1', 'x@x.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:53'),
(19, '1', 'x@x.com', 'Todo Mas que bien', '9', '9', '9', '10', '10', '10\n', '2021-11-27 18:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesas`
--

CREATE TABLE `mesas` (
  `id` int(50) NOT NULL,
  `id_cliente` varchar(50) DEFAULT NULL,
  `id_mozo` varchar(50) DEFAULT NULL,
  `estado_mesa` varchar(50) DEFAULT NULL,
  `capacidad` varchar(50) NOT NULL,
  `cuenta` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mesas`
--

INSERT INTO `mesas` (`id`, `id_cliente`, `id_mozo`, `estado_mesa`, `capacidad`, `cuenta`) VALUES
(1, '1', '1', 'ABONO LA CUENTA', '10', '8240'),
(2, '-', '-', 'DISPONIBLE', '8', '-'),
(3, '-', '-', 'DISPONIBLE', '8', '-'),
(4, '-', '-', 'DISPONIBLE', '4', '-'),
(5, '-', '-', 'DISPONIBLE', '4', '-'),
(6, '-', '-', 'DISPONIBLE', '2', '-'),
(7, '-', '-', 'DISPONIBLE', '2', '-'),
(8, '-', '-', 'DISPONIBLE', '2', '-'),
(9, '-', '-', 'DISPONIBLE', '2', '-'),
(10, '-', '-', 'DISPONIBLE', '2', '-'),
(11, '-', '-', 'DISPONIBLE', '2', '-');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(50) NOT NULL,
  `id_mesa` varchar(50) NOT NULL,
  `id_cliente` varchar(50) NOT NULL,
  `id_producto` varchar(50) NOT NULL,
  `sector` varchar(50) NOT NULL,
  `minutosEspera` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cantidad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_mesa`, `id_cliente`, `id_producto`, `sector`, `minutosEspera`, `estado`, `cantidad`) VALUES
(1, '1', '1', '1', 'BARTENDER', '15', 'MODIFICADO POR bartender', '1'),
(2, '1', '1', '1', 'COCINERO', '15', 'MODIFICADO POR COCINERO', '1'),
(3, '1', '1', '1', 'CERVECERO', '5', 'EN ESPERA', '1'),
(4, '1', '1', '1', 'CERVECERO', '5', 'LISTO PARA ENTREGAR', '1'),
(5, '1', '13', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(6, '1', '13', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(7, '1', '14', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(8, '1', '15', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(9, '1', '15', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(10, '1', '13', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(11, '1', '14', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(12, '1', '19', '1', 'COCINA', '5', 'EN PREPARACION', '1'),
(13, '1', '20', '1', 'COCINA', '30', 'EN PREPARACION', '1'),
(14, '1', '20', '1', 'COCINA', '30', 'EN PREPARACION', '1'),
(15, '1', '20', '3', 'COCINA', '20', 'EN PREPARACION', '1'),
(16, '1', '20', '6', 'COCINA', '2', 'EN PREPARACION', '1'),
(17, '1', '20', '7', 'COCINA', '5', 'EN PREPARACION', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` double NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `tipo`, `status`) VALUES
(1, 'Milanesa a Caballo', 500, 'Plato Vegano', 'ACTIVO'),
(2, 'Milanesa de Pollo', 600, 'Plato Principal', 'ACTIVO'),
(3, 'Hamburguesa de Garbanzo', 1000, 'Plato Principal', 'ACTIVO'),
(4, 'Coca Cola', 120, 'Bebida', 'ACTIVO'),
(5, 'Pepsi', 120, 'Bebida', 'ACTIVO'),
(6, 'Cerveza Corona', 120, 'Bebida', 'ACTIVO'),
(7, 'Daikiri', 120, 'Bebida', 'ACTIVO'),
(8, 'Cerveza Brahma', 120, 'Bebida', 'ACTIVO'),
(9, 'Cerveza Quilmes', 120, 'Bebida', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `tipo_usuario` varchar(50) NOT NULL,
  `baja` varchar(50) NOT NULL,
  `mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `clave`, `tipo_usuario`, `baja`, `mail`) VALUES
(13, 'Leandro', 'Cabeza', '$2y$10$hQkI4bn00zsDx7gxbp1bTOg8rKqHWnYY9Tk5RK/Gw0sz5awTPKJ1C', 'SOCIO', 'ACTIVO', 'socio@socio.com'),
(14, 'Juan', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'MOZO', 'ACTIVO', 'mozo@mozo.com'),
(15, 'Pedro', 'Navaja', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'COCINERO', 'DESCANSANDO', 'cocinero@cocinero.com'),
(16, 'Sterling', 'Yan', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'CERVECERO', 'ACTIVO', 'cervecero@cervecero.com'),
(17, 'Pier', 'Yan', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'BARTENDER', 'ACTIVO', 'bartender@bartender.com'),
(18, 'Jose', 'Aldo', '$2y$10$Y8KiEYg19hKwbn/AyiH6zuyCl6C2eQslxA7zTI0Yv.ZxOzgyXVbyK', 'CLIENTE', 'ACTIVO', 'cliente@cliente.com'),
(19, 'Jose', 'Gomez', '$2y$10$gflBSIHAC5of55RQbHolk.Bju98/.8/9gv0RIWEjSU1fqlNd/Z4uy', 'CLIENTE', 'ACTIVO', 'Pedro@gmail.com'),
(20, 'Nahuel', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'CLIENTE', 'ACTIVO', 'clientex@clientex.com'),
(21, 'Pablo', 'Perez', '$2y$10$d0zqgQjLxsvxFoFuq4MELO1WCl.gAU6lVuP8AFzmNdBHXrTcV9xiO', 'MOZO', 'ACTIVO', 'mozo1@mozo1.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `mesas`
--
ALTER TABLE `mesas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `encuestas`
--
ALTER TABLE `encuestas`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `mesas`
--
ALTER TABLE `mesas`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
