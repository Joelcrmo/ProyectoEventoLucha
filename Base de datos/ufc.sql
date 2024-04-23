-- Crear la base de datos UFC si no existe
CREATE DATABASE IF NOT EXISTS UFC;

-- Seleccionar la base de datos UFC
USE UFC;

-- Crear tabla Categoria
CREATE TABLE IF NOT EXISTS Categoria (
    ID_Categoria INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Cat VARCHAR(50)
);

-- Crear tabla rol
CREATE TABLE IF NOT EXISTS Rol (
    ID_Rol INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Rol VARCHAR(50)
);

-- Crear tabla tecnica
CREATE TABLE IF NOT EXISTS Tecnica (
    ID_Tecnica INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Tecnica VARCHAR(50)
);

-- Crear tabla de paises
CREATE TABLE IF NOT EXISTS Pais (
    ID_Pais INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Pais VARCHAR(50)
);

-- Crear tabla Participante
CREATE TABLE IF NOT EXISTS Participante (
    ID_Participante INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Par VARCHAR(50),
    Apellido_Par VARCHAR(50),
    ID_Rol INT,
    ID_Tecnica INT,
    Altura_Par FLOAT,
    Peso_Par FLOAT,
    ID_Pais INT,
    ID_Categoria INT
);

-- Crear tabla Localizacion
CREATE TABLE IF NOT EXISTS Localizacion (
    ID_Localizacion INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Loc VARCHAR(50),
    ID_Pais INT
);

-- Crear tabla Velada
CREATE TABLE IF NOT EXISTS Velada (
    ID_Velada INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Vel VARCHAR(50),
    Fecha_Vel DATE,
    ID_Localizacion INT
);

-- Crear tabla Pelea
CREATE TABLE IF NOT EXISTS Pelea (
    ID_Pelea INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Pel VARCHAR(50),
    ID_Participante_Azul INT,
    ID_Participante_Rojo INT,
    ID_Juez INT,
    ID_Arbitro INT,
    ID_Velada INT
);

-- Crear tabla Usuario
CREATE TABLE IF NOT EXISTS Usuario (
    ID_Usuario INT AUTO_INCREMENT PRIMARY KEY,
    Nombre_Usu VARCHAR(50),
    Password_Usu VARCHAR(50)
);

-- Crear tabla Validacion
CREATE TABLE IF NOT EXISTS Validacion (
    ID_Validacion INT AUTO_INCREMENT PRIMARY KEY,
    Token VARCHAR(100),
    Fecha_Token DATE,
    Expiracion_Token DATE,
    ID_Usuario INT
);

-- Crear tabla de Relacion
CREATE TABLE IF NOT EXISTS Participante_Pelea (
    ID_Participante INT,
    ID_Pelea INT,
    CONSTRAINT Participante_Pelea_PK PRIMARY KEY (ID_Participante, ID_Pelea)
);

ALTER TABLE Participante
    ADD FOREIGN KEY (ID_Categoria) REFERENCES Categoria(ID_Categoria) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Rol) REFERENCES Rol(ID_Rol) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Tecnica) REFERENCES Tecnica(ID_Tecnica) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Pais) REFERENCES Pais(ID_Pais) ON UPDATE CASCADE ON DELETE CASCADE;
    

ALTER TABLE Velada
    ADD FOREIGN KEY (ID_Localizacion) REFERENCES Localizacion(ID_Localizacion) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Pelea
    ADD FOREIGN KEY (ID_Participante_Azul) REFERENCES Participante(ID_Participante) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Participante_Rojo) REFERENCES Participante(ID_Participante) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Juez) REFERENCES Participante(ID_Participante) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Arbitro) REFERENCES Participante(ID_Participante) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Velada) REFERENCES Velada(ID_Velada) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Validacion
    ADD FOREIGN KEY (ID_Usuario) REFERENCES Usuario(ID_Usuario) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Participante_Pelea
    ADD FOREIGN KEY (ID_Participante) REFERENCES Participante(ID_Participante) ON UPDATE CASCADE ON DELETE CASCADE,
    ADD FOREIGN KEY (ID_Pelea) REFERENCES Pelea(ID_Pelea) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE Localizacion 
    ADD FOREIGN KEY (ID_Pais) REFERENCES Pais(ID_Pais) ON UPDATE CASCADE ON DELETE CASCADE;

-- INSERT DE DATOS
INSERT IGNORE INTO Categoria (ID_Categoria, Nombre_Cat) VALUES
(1, 'Peso Mosca'),
(2, 'Peso Gallo'),
(3, 'Peso Pluma'),
(4, 'Peso Ligero'),
(5, 'Peso Welter'),
(6, 'Peso Medio'),
(7, 'Peso Semipesado'),
(8, 'Peso Pesado'),
(9, 'Peso Femenino'),
(10, 'Peso Flyweight Femenino');


INSERT IGNORE INTO Rol (ID_Rol, Nombre_Rol) VALUES
(1, 'Luchador'),
(2, 'Arbitro'),
(3, 'Juez');


INSERT IGNORE INTO Tecnica (ID_Tecnica, Nombre_Tecnica) VALUES
(1, 'Brazilian Jiu Jitsu'),
(2, 'Boxeo'),
(3, 'Kick Boxing'),
(4, 'Wresling'),
(5, 'Muay Thai'),
(6, 'Judo'),
(7, 'Jiu Jitsu');


INSERT IGNORE INTO Pais (ID_Pais, Nombre_Pais) VALUES
(1, 'Estados Unidos'),
(2, 'Brasil'),
(3, 'Inglaterra'),
(4, 'Australia'),
(5, 'Japon'),
(6, 'Espana'),
(7, 'Canada'),
(8, 'Arabia Saudi'),
(9, 'Holanda'),
(10, 'Rusia'),
(11, 'Suecia'),
(12, 'Mexico'),
(13, 'Ucrania'),
(14, 'China'),
(15, 'Argentina'),
(16, 'Nigeria'),
(17, 'Chile'),
(18, 'Costa Rica'),
(19, 'Irlanda'),
(20, 'Francia'),
(21, 'Irak'),
(22, 'Georgia'),
(23, 'Sudafrica'),
(24, 'Republica Checa');

INSERT IGNORE INTO Localizacion (ID_Localizacion, Nombre_Loc, ID_Pais) VALUES
(1, 'Las Vegas' ,1),
(2, 'California' ,1),
(3, 'Nueva York' ,1),
(4, 'Arizona' ,1),
(5, 'Toronto' ,7),
(6, 'Vancouver' ,7),
(7, 'São Paulo' ,2),
(8, 'Jeddah' ,8),
(9, 'Sydney' ,4),
(10, 'Londres' ,3),
(11, 'Madrid' ,6),
(12, 'Paris' ,20),
(13, 'Dublin' ,19);


INSERT IGNORE INTO Participante (ID_Participante, Nombre_Par, Apellido_Par, ID_Rol, ID_Tecnica, Altura_Par, Peso_Par, ID_Pais, ID_Categoria) VALUES
-- Peso Mosca
(1, 'Brandon', 'Moreno', 1, 7, 1.64, 54, 12, 1),
(2, 'Amir', 'Albazi', 1, 3, 1.65, 57, 21, 1),
(3, 'Brandon', 'Royval', 1, 5, 1.75, 56, 1, 1),
(4, 'Alexandre', 'Pantoja', 1, 1, 1.65, 57, 2, 1),

-- Peso Gallo
(5, 'Sean', 'O Malley', 1, 3, 1.80, 61, 1, 2),
(6, 'Merab', 'Dvalishvili', 1, 6, 1.68, 61, 22, 2),
(7, 'Aljamin', 'Sterling', 1, 1, 1.70, 62, 1, 2),
(8, 'Cory', 'Sandhagen', 1, 1, 1.80,  61, 1, 2),


-- Peso Pluma
(9, 'Ilia', 'Topuria', 1, 2, 1.70, 66, 6, 3),
(10, 'Alexander', 'Volkanovski', 1, 1, 1.68, 65, 4, 3),
(11, 'Max', 'Holloway', 1, 1, 1.80, 64, 1, 3),
(12, 'Yair', 'Rodriguez', 1, 3, 1.80, 66, 12, 3),

-- Peso Ligero
(13, 'Islam', 'Makhachev', 1, 4, 1.78, 72, 10, 4),
(14, 'Charles ', 'Oliveira', 1, 1, 1.78, 70, 2, 4),
(15, 'Justin', 'Gaethje', 1, 2, 1.80, 70, 1, 4),
(16, 'Dustin', 'Piorier', 1, 2, 1.75,   71, 1, 4),

-- Peso Welter
(17, 'Conor', 'McGregor', 1, 2, 1.75,77,19,5),
(18, 'Kamaru', 'Usman', 1, 4, 1.80,77,1,5),
(19, 'Leon', 'Edwards', 1, 1, 1.88,78,3,5),
(20, 'Belal', 'Muhammad', 1, 4, 1.78,77,1,5),


-- Peso Medio
(21, 'Dricus', 'Du Plessis',1, 3, 1.85, 84, 23, 6),
(22, 'Sean', 'Strickland',1, 2, 1.85, 85, 1, 6),
(23, 'Israel', 'Adesanya',1, 3, 1.93, 84, 16, 6),
(24, 'Robert', 'Whittaker',1, 3, 1.83, 84, 4, 6),


-- Peso Semipesado
(25, 'Alex', 'Pereira',1, 2, 1.93, 93, 2, 7),
(26, 'Jamahal', 'Hill', 1, 3, 1.93, 92, 1, 7),
(27, 'Jiri', 'Prochazka', 1, 5, 1.93, 93, 24, 7),
(28, 'Magomed', 'Ankalaev', 1, 4, 1.91, 93, 10, 7),


-- Peso Pesado
(29, 'Jon', 'Jones', 1, 3, 1.93, 113, 1, 8),
(30, 'Tom', 'Aspinal', 1, 1, 1.96, 116, 3, 8),
(31, 'Ciryl', 'Gane', 1, 3, 1.93, 112, 20, 8),
(32, 'Sergei', 'Pavlovich', 1, 2, 1.91, 119, 10, 8),


-- Peso Femenino
(33, 'Alexa', 'Grasso', 1, 2, 1.65, 57, 12, 9),
(34, 'Ronda', 'Rousey', 1, 6, 1.64, 54, 1, 9),
(35, 'Valentina', 'Shevchenko', 1, 5, 1.65, 56, 19, 9),
(36, 'Erin', 'Blanchfield', 1, 1, 1.70, 56, 1, 9),


-- Peso Flyweight Femenino
(37, 'Zhang', 'Weili', 1, 7, 1.63, 52, 14, 10),
(38, 'Yan', 'Xiaonan', 1, 7, 1.64, 53, 14, 10),
(39, 'Tatiana', 'Suarez', 1, 2, 1.65, 57, 1, 10),
(40, 'Amanda', 'Lemos', 1, 1, 1.63, 61, 2, 10),

-- Árbitros
(41, 'Herb', 'Dean', 2, 1, 1.85, 102, 1, 6),
(42, 'Jason', 'Herzog', 2, 1, 1.84, 95, 1, 6),
(43, 'Marc', 'Goddard', 2, 2, 1.75, 79, 1, 6),
(44, 'Jhon', 'McCarthy', 2, 2, 1.84, 104, 1, 6),

-- Jueces
(45, 'Joe', 'Rogan', 3, 1, 1.86, 95, 1, 6),
(46, 'Michael', 'Bisping', 3, 3, 1.85, 84, 3, 6),
(47, 'Daniel', 'Cormier', 3, 4, 1.80, 100, 1, 6);

-- Usuario
INSERT IGNORE INTO usuario (ID_Usuario, Nombre_Usu, Password_Usu) VALUES ('1', 'joel', '1234');

-- Velada de ejemplo
INSERT IGNORE INTO Velada (ID_Velada,Nombre_Vel, Fecha_Vel, ID_Localizacion) 
VALUES ('1','UFC 300', '2024-05-01', 11);

-- Pelea de ejemplo
INSERT IGNORE INTO Pelea (ID_Pelea,Nombre_Pel, ID_Participante_Azul, ID_Participante_Rojo, ID_Juez, ID_Arbitro, ID_Velada) 
VALUES ('1','Main Event', 1, 2, 41, 45, 1);
