-- Estructura de la base de datos para la Semana Santa de Écija

CREATE DATABASE SemanaSantaEcija;
USE SemanaSantaEcija;

CREATE TABLE Hermandades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    dia ENUM('Domingo de Ramos', 'Lunes Santo', 'Martes Santo', 'Miércoles Santo', 'Jueves Santo', 'Madrugá', 'Viernes Santo', 'Sábado Santo', 'Domingo de Resurrección') NOT NULL
);

CREATE TABLE Pasos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    hermandad_id INT,
    FOREIGN KEY (hermandad_id) REFERENCES Hermandades(id)
);

