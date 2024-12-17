-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 14-12-2024 a las 18:52:35
-- Versión del servidor: 5.7.43
-- Versión de PHP: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `meowpic`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`, `fecha_registro`) VALUES
(1, 'GatoConBotas', 'botas@gatemail.com', 'contrasena123', '2024-12-14 18:22:02'),
(2, 'MiauTástico', 'miau.tastico@gatemail.com', 'miau123', '2024-12-14 18:22:02'),
(3, 'SrBigotes', 'bigotes@gatemail.com', 'bigotes123', '2024-12-14 18:22:02'),
(4, 'PelusaEnAccion', 'pelusa@gatemail.com', 'pelusa123', '2024-12-14 18:22:02'),
(5, 'Ronroneador2000', 'ronroneador@gatemail.com', 'ronroneador123', '2024-12-14 18:22:02'),
(6, 'MichiCEO', 'ceo@gatemail.com', 'ceo123', '2024-12-14 18:22:02'),
(7, 'GarfieldFan', 'garfield@gatemail.com', 'garfield123', '2024-12-14 18:22:02'),
(8, 'ZarpaLuminosa', 'zarpa@gatemail.com', 'zarpa123', '2024-12-14 18:22:02'),
(9, 'Gatolicioso', 'gatolicioso@gatemail.com', 'gatolicioso123', '2024-12-14 18:22:02'),
(10, 'MiauFiestero', 'fiestero@gatemail.com', 'fiestero123', '2024-12-14 18:22:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
