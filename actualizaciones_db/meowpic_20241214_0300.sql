-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: database
-- Tiempo de generación: 15-12-2024 a las 02:00:36
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
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE `fotos` (
  `id` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `descripcion` text,
  `fecha_subida` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `usuario_id` int(11) NOT NULL,
  `gatito_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `fotos`
--

INSERT INTO `fotos` (`id`, `ruta`, `descripcion`, `fecha_subida`, `usuario_id`, `gatito_id`) VALUES
(1, 'imagenes/gatitos/gato1.jpg', 'Gato juguetón en su camita', '2024-12-14 00:00:00', 1, 1),
(2, 'imagenes/gatitos/gato2.jpg', 'Gato durmiendo bajo el sol', '2024-12-14 00:00:00', 2, 2),
(3, 'imagenes/gatitos/gato3.jpg', 'Gatito explorando el jardín', '2024-12-14 00:00:00', 3, 3),
(4, 'imagenes/gatitos/gato4.jpg', 'Gato curioso mirando la cámara', '2024-12-14 00:00:00', 4, 4),
(5, 'imagenes/gatitos/gato5.jpg', 'Gatito descansando en una silla', '2024-12-14 00:00:00', 5, 5),
(6, 'imagenes/gatitos/gato6.jpg', 'Gato jugando con una pelota', '2024-12-14 00:00:00', 6, 6),
(7, 'imagenes/gatitos/gato7.jpg', 'Gatito mirando por la ventana', '2024-12-14 00:00:00', 7, 7),
(8, 'imagenes/gatitos/gato8.jpg', 'Gato acurrucado en una manta', '2024-12-14 00:00:00', 8, 8),
(9, 'imagenes/gatitos/gato9.jpg', 'Gato trepando por un árbol', '2024-12-14 00:00:00', 9, 9),
(10, 'imagenes/gatitos/gato10.jpg', 'Gatito jugando con otro gato', '2024-12-14 00:00:00', 10, 10),
(11, 'imagenes/gatitos/gato_naranja.jpeg', 'Es naranja', '2024-12-15 01:39:49', 11, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gatitos`
--

CREATE TABLE `gatitos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `sexo` char(1) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `edad` int(11) DEFAULT NULL,
  `raza` varchar(50) DEFAULT NULL,
  `peso` decimal(5,2) DEFAULT NULL,
  `descripcion` text,
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `gatitos`
--

INSERT INTO `gatitos` (`id`, `nombre`, `sexo`, `fecha_nacimiento`, `edad`, `raza`, `peso`, `descripcion`, `usuario_id`) VALUES
(1, 'Luna', 'H', '2020-05-12', 4, 'Siamés', '4.50', 'Un gatito muy especial.', 1),
(2, 'Simba', 'M', '2018-07-23', 6, 'Persa', '5.20', 'Le encanta dormir bajo el sol.', 2),
(3, 'Mochi', 'M', '2022-01-15', 2, 'Maine Coon', '7.80', 'Tiene un pelaje increíblemente suave.', 3),
(4, 'Nala', 'H', '2019-09-03', 5, 'Bengala', '4.00', 'Muy curiosa y juguetona.', 4),
(5, 'Oliver', 'M', '2021-11-28', 3, 'Esfinge', '3.90', 'Siempre busca el calor.', 5),
(6, 'Mía', 'H', '2017-06-14', 7, 'Calicó', '4.30', 'Una gatita tranquila y cariñosa.', 1),
(7, 'Toby', 'M', '2023-03-09', 1, 'Común Europeo', '2.70', 'El más pequeño de todos.', 2),
(8, 'Cleo', 'H', '2016-04-22', 8, 'Angora', '5.00', 'Le encanta estar en las alturas.', 3),
(9, 'Leo', 'M', '2019-08-05', 5, 'Bengala', '6.40', 'Muy ágil y rápido.', 4),
(10, 'Milo', 'M', '2020-02-18', 4, 'Persa', '4.80', 'Siempre está detrás de su juguete favorito.', 5),
(11, 'Julepe', 'M', '2022-01-14', NULL, 'Naranja', '9.00', 'Es naranja', 11);

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
(10, 'MiauFiestero', 'fiestero@gatemail.com', 'fiestero123', '2024-12-14 18:22:02'),
(11, 'admin', 'admin@gmail.com', '$2y$10$aw2l3pphjael4A.jbISl0uLe3znccUA/9Yw2nwOXqRBQTrruT8KnO', '2024-12-14 19:40:44');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `gatito_id` (`gatito_id`);

--
-- Indices de la tabla `gatitos`
--
ALTER TABLE `gatitos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

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
-- AUTO_INCREMENT de la tabla `fotos`
--
ALTER TABLE `fotos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `gatitos`
--
ALTER TABLE `gatitos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fotos`
--
ALTER TABLE `fotos`
  ADD CONSTRAINT `fotos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fotos_ibfk_2` FOREIGN KEY (`gatito_id`) REFERENCES `gatitos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `gatitos`
--
ALTER TABLE `gatitos`
  ADD CONSTRAINT `gatitos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
