-- Inserción de datos
USE semanasantaecija;
INSERT INTO Hermandades (nombre, dia) VALUES
('Hermandad y Cofradía de Nazarenos de la Sagrada Entrada Triunfal de Jesús en Jerusalén, Nuestro Padre Jesús Cautivo, Nuestra Madre y Señora de Las Lágrimas', 'Domingo de Ramos'),
('Hermandad del Amor', 'Domingo de Ramos'),
('Hermandad del Santísimo Cristo de la Yedra, Nuestra Señora de la Caridad', 'Lunes Santo'),
('Hermandad del Santísimo Cristo de la Expiración, Nuestra Señora de los Dolores y Nuestro Padre Jesús Nazareno de la Misericordia', 'Martes Santo'),
('Hermandad Sacramental y Real Archicofradía de Nazarenos de la Coronación de Espinas de Nuestro Señor Jesucristo, Santísimo Cristo de la Salud, Nuestra Señora de los Dolores', 'Miércoles Santo'),
('Real, Muy Antigua y Fervorosa Hermandad del Santísimo Cristo de la Sangre y Nuestra Señora de los Dolores', 'Jueves Santo'),
('Real y Fervorosa Hermandad y Cofradía de Penitencia, Santísimo Cristo de la Sagrada Columna y Azotes, Santísimo Cristo de Confalón y Nuestra Señora de la Esperanza', 'Jueves Santo'),
('Real y Venerable Hermandad y Cofradía de Nazarenos de Nuestro Padre Jesús Nazareno Abrazado a la Cruz y María Santísima de la Amargura', 'Madrugá'),
('Pontificia, Ilustre y Muy Antigua Hermandad y Cofradía de Nuestro Padre Jesús Nazareno, Santa Cruz en Jerusalén, María Santísima de las Misericordias', 'Madrugá'),
('Hermandad Sacramental y Cofradía de Nazarenos del Santísimo Cristo de la Misericordia, Nuestro Padre Jesús Descendido de la Cruz en el Misterio de su Sagrada Mortaja y María Santísima de la Piedad', 'Viernes Santo'),
('Muy Antigua y Fervorosa Hermandad de Nuestra Señora de la Piedad y Santísimo Cristo de la Exaltación en la Cruz', 'Viernes Santo'),
('Hermandad y Cofradía de Nuestro Padre Jesús Sin Soga, Nuestra Señora de la Fe', 'Viernes Santo'),
('Real, Muy Ilustre, Antigua y Noble Cofradía de Nazarenos de Nuestra Señora en la Consideración de sus Angustias y Soledad, Santo Entierro de Nuestro Señor Jesucristo', 'Sábado Santo'),
('Hermandad del Santísimo Sacramento, Gloriosa Resurrección de Nuestro Señor Jesucristo, María Santísima de la Alegría', 'Domingo de Resurrección');

INSERT INTO Pasos (nombre, hermandad_id) VALUES
('La Borriquita', 1),
('Nuestro Padre Jesús Cautivo', 1),
('Nuestra Madre y Señora de Las Lágrimas', 1),
('Nuestro Padre Jesús del Amor', 2),
('Santísimo Cristo de la Yedra', 3),
('Nuestra Señora de la Caridad', 3),
('Nuestro Padre Jesús de la Misericordia', 4),
('Cristo de la Expiración', 4),
('Nuestra Señora de los Dolores', 4),
('Coronación de Espinas', 5),
('Cristo de la Salud', 5),
('Nuestra Señora de los Dolores', 5),
('Santísimo Cristo de la Sangre', 6),
('Nuestra Señora de los Dolores', 6),
('Santísimo Cristo de la Sagrada Columna y Azotes', 7),
('Cristo de Confalón', 7),
('Nuestra Señora de la Esperanza', 7),
('Nuestro Padre Jesús Nazareno Abrazado a la Cruz', 8),
('María Santísima de la Amargura', 8),
('Nuestro Padre Jesús Nazareno', 9),
('María Santísima de las Misericordias', 9),
('La Sagrada Mortaja', 10),
('Santísimo Cristo Exaltado en la Cruz', 11),
('Nuestra Señora de la Piedad', 11),
('Nuestro Padre Jesús Sin Soga', 12),
('Nuestra Señora de la Fe', 12),
('La Quinta Angustia', 13),
('El Santo Entierro', 13),
('Nuestra Señora de la Soledad', 13),
('Nuestro Padre Jesús Resucitado', 14),
('Nuestra Señora de la Alegría', 14);
