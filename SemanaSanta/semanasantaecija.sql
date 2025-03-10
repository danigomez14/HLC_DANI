-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 06-03-2025 a las 14:02:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `semanasantaecija`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `hermandad_id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_hermandades`
--

CREATE TABLE `detalles_hermandades` (
  `id` int(11) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL,
  `recorrido` text NOT NULL,
  `nazarenos` int(11) NOT NULL,
  `banda` varchar(255) NOT NULL,
  `dia_salida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hermandades`
--

CREATE TABLE `hermandades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dia` enum('Domingo de Ramos','Lunes Santo','Martes Santo','Miércoles Santo','Jueves Santo','Madrugá','Viernes Santo','Sábado Santo','Domingo de Resurrección') NOT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `hermandades`
--

INSERT INTO `hermandades` (`id`, `nombre`, `dia`, `imagen_principal`) VALUES
(1, 'Hermandad y Cofradía de Nazarenos de la Sagrada Entrada Triunfal de Jesús en Jerusalén, Nuestro Padre Jesús Cautivo, Nuestra Madre y Señora de Las Lágrimas', 'Domingo de Ramos', NULL),
(2, 'Hermandad del Amor', 'Domingo de Ramos', NULL),
(3, 'Hermandad del Santísimo Cristo de la Yedra, Nuestra Señora de la Caridad', 'Lunes Santo', NULL),
(4, 'Hermandad del Santísimo Cristo de la Expiración, Nuestra Señora de los Dolores y Nuestro Padre Jesús Nazareno de la Misericordia', 'Martes Santo', NULL),
(5, 'Hermandad Sacramental y Real Archicofradía de Nazarenos de la Coronación de Espinas de Nuestro Señor Jesucristo, Santísimo Cristo de la Salud, Nuestra Señora de los Dolores', 'Miércoles Santo', NULL),
(6, 'Real, Muy Antigua y Fervorosa Hermandad del Santísimo Cristo de la Sangre y Nuestra Señora de los Dolores', 'Jueves Santo', NULL),
(7, 'Real y Fervorosa Hermandad y Cofradía de Penitencia, Santísimo Cristo de la Sagrada Columna y Azotes, Santísimo Cristo de Confalón y Nuestra Señora de la Esperanza', 'Jueves Santo', NULL),
(8, 'Real y Venerable Hermandad y Cofradía de Nazarenos de Nuestro Padre Jesús Nazareno Abrazado a la Cruz y María Santísima de la Amargura', 'Madrugá', NULL),
(9, 'Pontificia, Ilustre y Muy Antigua Hermandad y Cofradía de Nuestro Padre Jesús Nazareno, Santa Cruz en Jerusalén, María Santísima de las Misericordias', 'Madrugá', NULL),
(10, 'Hermandad Sacramental y Cofradía de Nazarenos del Santísimo Cristo de la Misericordia, Nuestro Padre Jesús Descendido de la Cruz en el Misterio de su Sagrada Mortaja y María Santísima de la Piedad', 'Viernes Santo', NULL),
(11, 'Muy Antigua y Fervorosa Hermandad de Nuestra Señora de la Piedad y Santísimo Cristo de la Exaltación en la Cruz', 'Viernes Santo', NULL),
(12, 'Hermandad y Cofradía de Nuestro Padre Jesús Sin Soga, Nuestra Señora de la Fe', 'Viernes Santo', NULL),
(13, 'Real, Muy Ilustre, Antigua y Noble Cofradía de Nazarenos de Nuestra Señora en la Consideración de sus Angustias y Soledad, Santo Entierro de Nuestro Señor Jesucristo', 'Sábado Santo', NULL),
(14, 'Hermandad del Santísimo Sacramento, Gloriosa Resurrección de Nuestro Señor Jesucristo, María Santísima de la Alegría', 'Domingo de Resurrección', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasos`
--

CREATE TABLE `pasos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pasos`
--

INSERT INTO `pasos` (`id`, `nombre`, `hermandad_id`) VALUES
(1, 'La Borriquita', 1),
(2, 'Nuestro Padre Jesús Cautivo', 1),
(3, 'Nuestra Madre y Señora de Las Lágrimas', 1),
(4, 'Nuestro Padre Jesús del Amor', 2),
(5, 'Santísimo Cristo de la Yedra', 3),
(6, 'Nuestra Señora de la Caridad', 3),
(7, 'Nuestro Padre Jesús de la Misericordia', 4),
(8, 'Cristo de la Expiración', 4),
(9, 'Nuestra Señora de los Dolores', 4),
(10, 'Coronación de Espinas', 5),
(11, 'Cristo de la Salud', 5),
(12, 'Nuestra Señora de los Dolores', 5),
(13, 'Santísimo Cristo de la Sangre', 6),
(14, 'Nuestra Señora de los Dolores', 6),
(15, 'Santísimo Cristo de la Sagrada Columna y Azotes', 7),
(16, 'Cristo de Confalón', 7),
(17, 'Nuestra Señora de la Esperanza', 7),
(18, 'Nuestro Padre Jesús Nazareno Abrazado a la Cruz', 8),
(19, 'María Santísima de la Amargura', 8),
(20, 'Nuestro Padre Jesús Nazareno', 9),
(21, 'María Santísima de las Misericordias', 9),
(22, 'La Sagrada Mortaja', 10),
(23, 'Santísimo Cristo Exaltado en la Cruz', 11),
(24, 'Nuestra Señora de la Piedad', 11),
(25, 'Nuestro Padre Jesús Sin Soga', 12),
(26, 'Nuestra Señora de la Fe', 12),
(27, 'La Quinta Angustia', 13),
(28, 'El Santo Entierro', 13),
(29, 'Nuestra Señora de la Soledad', 13),
(30, 'Nuestro Padre Jesús Resucitado', 14),
(31, 'Nuestra Señora de la Alegría', 14);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`, `hermandad_id`, `es_admin`) VALUES
(30, 'admin', '$2y$10$ZiKo0coxHhkw5RJxFsiAXOF1/uY6.3sUwpK3uTCut.mdsaLebhyVC', NULL, 1),
(31, 'consejo', '$2y$10$QEPUCUI/d/ihnv.wTEilq.O0uORgDh/N7KXGLqf0ieQdIjw2V8De6', NULL, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

--
-- Indices de la tabla `detalles_hermandades`
--
ALTER TABLE `detalles_hermandades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

--
-- Indices de la tabla `hermandades`
--
ALTER TABLE `hermandades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasos`
--
ALTER TABLE `pasos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `hermandad_id` (`hermandad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalles_hermandades`
--
ALTER TABLE `detalles_hermandades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `hermandades`
--
ALTER TABLE `hermandades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `pasos`
--
ALTER TABLE `pasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);

--
-- Filtros para la tabla `detalles_hermandades`
--
ALTER TABLE `detalles_hermandades`
  ADD CONSTRAINT `detalles_hermandades_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pasos`
--
ALTER TABLE `pasos`
  ADD CONSTRAINT `pasos_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
