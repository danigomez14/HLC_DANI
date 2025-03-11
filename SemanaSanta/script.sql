CREATE DATABASE semanasantaecija;
USE semanasantaecija;

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `hermandad_id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `comentario` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `detalles_hermandades` (
  `id` int(11) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL,
  `recorrido` text NOT NULL,
  `nazarenos` int(11) NOT NULL,
  `banda` varchar(255) NOT NULL,
  `dia_salida` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `hermandades` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `dia` enum('Domingo de Ramos','Lunes Santo','Martes Santo','Miércoles Santo','Jueves Santo','Madrugá','Viernes Santo','Sábado Santo','Domingo de Resurrección') NOT NULL,
  `imagen_principal` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `pasos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hermandad_id` int(11) DEFAULT NULL,
  `es_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Índices
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

ALTER TABLE `detalles_hermandades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

ALTER TABLE `hermandades`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `pasos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hermandad_id` (`hermandad_id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `hermandad_id` (`hermandad_id`);

-- Auto Increment
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `detalles_hermandades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `hermandades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `pasos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

-- Restricciones
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);

ALTER TABLE `detalles_hermandades`
  ADD CONSTRAINT `detalles_hermandades_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`) ON DELETE CASCADE;

ALTER TABLE `pasos`
  ADD CONSTRAINT `pasos_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);

ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`hermandad_id`) REFERENCES `hermandades` (`id`);



