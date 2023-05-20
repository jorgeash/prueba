-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-05-2023 a las 18:31:36
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `Prueba`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pagos`
--

CREATE TABLE `Pagos` (
  `pago_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `tipo_pago` varchar(80) NOT NULL,
  `cantidad` float NOT NULL,
  `monto_pagar` float NOT NULL,
  `fecha_pago` date NOT NULL,
  `total_pagar` float NOT NULL,
  `comentario` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `Pagos`
--

INSERT INTO `Pagos` (`pago_id`, `usuario_id`, `tipo_pago`, `cantidad`, `monto_pagar`, `fecha_pago`, `total_pagar`, `comentario`) VALUES
(27, 27, 'Bonos', 3, 5.5, '2023-05-20', 16.5, ''),
(28, 28, 'Bonos', 1, 20, '2023-05-20', 20, 'Se pago 1 bono'),
(29, 28, 'Horas Extras', 3, 2.5, '2023-05-20', 7.5, 'Se pago 3 horas extras');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuarios`
--

CREATE TABLE `Usuarios` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(300) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `estado` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `Usuarios`
--

INSERT INTO `Usuarios` (`usuario_id`, `nombre`, `apellido`, `email`, `password`, `rol`, `estado`) VALUES
(24, 'Juana Lizet', 'Perez Ramirez', 'juana@gmail.com', '66381ea008bd50616daf79d91d411ba000a0fd72239a3c997fe00372c122391f83fd6060e8742bced0cc22dc6f2d16772cefcc688ff60a016675f64071f2033fREW8anr51Ycq5uNPmJMRuMNcZvFS4DTUgar4CC5ibHo=', 'Administrador', 'Activo'),
(27, 'Sandra Lizet ', 'Miranda Perez', 'sandra.miranda@test.com', 'b7e4d11aba81e331b1a6d8321a19bd3e1ba5a8ff148432adf5819fe479f4a8e0ab77113e67c225ca91ea0fc1bae4fa15ad138fa7126448be0a7bed4215d48ca73bYMfEvzBW1wrYzdRIZrGDYjnaf8CA+NTQygx+iZbzM=', 'Normal', 'Activo'),
(28, 'Luis', 'Antonio', 'luis@test.com', 'ded5953101e14ae40158c6d687e2418ecbd558fbab26228d815ff508b4c1daa19a42e8f926f8300fb64d2496961fb36fada9bcedd374515b2652ba2d3462d7fdKIN2FlWFYQHccOwrv1Hio145OnWX9iEwZFuXN4PwUuU=', 'Normal', 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Pagos`
--
ALTER TABLE `Pagos`
  ADD PRIMARY KEY (`pago_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Pagos`
--
ALTER TABLE `Pagos`
  MODIFY `pago_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Pagos`
--
ALTER TABLE `Pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `Usuarios` (`usuario_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
