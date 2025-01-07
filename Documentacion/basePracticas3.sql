DROP DATABASE IF EXISTS practica;
CREATE DATABASE practica;
USE practica;

CREATE TABLE cargos(
 idCargo INT NOT NULL,
 Cargo VARCHAR(255),
 PRIMARY KEY(idCargo)
);

CREATE TABLE carreras(
  ID_Carrera INT(11) NOT NULL AUTO_INCREMENT,
  Carrera VARCHAR(255) NOT NULL,
  PRIMARY KEY(ID_Carrera)
);

CREATE TABLE sexo(
	ID_Sexo INT NOT NULL,
    Sexo VARCHAR(255),
	PRIMARY KEY(ID_Sexo)
);

CREATE TABLE año(
	ID_Año INT(11) NOT NULL AUTO_INCREMENT,
	Año VARCHAR(255),
    PRIMARY KEY(ID_Año)
);

CREATE TABLE diaPractica(
	ID_DiaPractica INT NOT NULL AUTO_INCREMENT,
    DiaSemana VARCHAR(255),
    PRIMARY KEY(ID_DiaPractica)
);

CREATE TABLE materias(
	ID_Materias INT NOT NULL AUTO_INCREMENT,
    Materia VARCHAR(255),
    ID_Carrera INT NOT NULL,
    PRIMARY KEY(ID_Materias),
    CONSTRAINT FOREIGN KEY (ID_Carrera) REFERENCES carreras(ID_Carrera)
);

CREATE TABLE usuarios( 
  ID_Usuario INT(11) NOT NULL AUTO_INCREMENT,
  Usuario INT(45) NOT NULL,
  Contraseña VARCHAR(255) NOT NULL,
  Email VARCHAR(255) NOT NULL,
  idCargo INT NOT NULL,
  PRIMARY KEY(ID_Usuario),
  CONSTRAINT FOREIGN KEY(idCargo) REFERENCES cargos(idCargo)
);

CREATE TABLE profesores(
  ID_Profesores INT(11) NOT NULL AUTO_INCREMENT,
  Nombre VARCHAR(255) NOT NULL,
  Apellido VARCHAR(255) NOT NULL,
  DNI INT NOT NULL,
  FechaNacimiento DATE NOT NULL,
  celular INT NOT NULL,
  Genero INT NOT NULL,
  ID_Usuario INT(11) NOT NULL,
  PRIMARY KEY(ID_Profesores),
  FOREIGN KEY(Genero) REFERENCES sexo(ID_Sexo),
  FOREIGN KEY(ID_Usuario) REFERENCES usuarios(ID_Usuario)
);

CREATE TABLE alumno(
  ID_Alumno INT(11) NOT NULL AUTO_INCREMENT,
  DNI INT NOT NULL,
  Apellido VARCHAR(255) NOT NULL,
  Nombre VARCHAR(255) NOT NULL, 
  FechaNacimiento VARCHAR(255) NOT NULL,
  Telefono INT(255) NOT NULL,
  Genero INT NOT NULL,
  ID_Usuario INT(11) NOT NULL,
  PRIMARY KEY (ID_Alumno),
  CONSTRAINT FOREIGN KEY (ID_Usuario) REFERENCES usuarios (ID_Usuario),
  CONSTRAINT FOREIGN KEY (Genero) REFERENCES sexo(ID_Sexo)
);

CREATE TABLE practicas (
  ID_Practica INT(11) NOT NULL AUTO_INCREMENT,
  Practica VARCHAR(255) NOT NULL,
  Lugar VARCHAR(255) NOT NULL,
  HorarioInicio VARCHAR(255) NOT NULL,
  HorarioFinal VARCHAR(255) NOT NULL,
  Vacantes INT NOT NULL,
  Fecha_apertura Date,
  ID_Profesores INT(11) NOT NULL,
  ID_Carrera INT(11) NOT NULL,
  ID_Materias INT(11) NOT NULL,
  Observacion TEXT(255) NOT NULL,
  PRIMARY KEY(ID_Practica),
  CONSTRAINT FOREIGN KEY(ID_Profesores) REFERENCES profesores(ID_Profesores),
  CONSTRAINT FOREIGN KEY(ID_Carrera) REFERENCES carreras (ID_Carrera),
  CONSTRAINT FOREIGN KEY(ID_Materias) REFERENCES materias (ID_Materias)
);

CREATE TABLE profeAño(
	ID_Tabla INT(11) NOT NULL AUTO_INCREMENT,
    ID_Profesores INT(11) NOT NULL,
    ID_Año INT(11) NOT NULL,
    PRIMARY KEY(ID_Tabla),
    FOREIGN KEY(ID_Profesores) REFERENCES profesores(ID_Profesores),
	FOREIGN KEY(ID_Año) REFERENCES año(ID_Año)
);


CREATE TABLE listapracticas (
  ID_ListaPractica INT(11) NOT NULL AUTO_INCREMENT,
  ID_Alumno INT(11) NOT NULL,
  ID_Practica INT(11) NOT NULL,
  PRIMARY KEY(ID_ListaPractica),
  CONSTRAINT FOREIGN KEY(ID_Alumno) REFERENCES alumno(ID_Alumno),
  CONSTRAINT FOREIGN KEY(ID_Practica) REFERENCES practicas (ID_Practica)
);

CREATE TABLE inscripcion(
	ID_Inscripcion INT NOT NULL AUTO_INCREMENT,
    ID_Usuario INT NOT NULL,
	ID_Carrera INT NOT NULL,
    ID_Materias INT NOT NULL,
    ID_Año INT NOT NULL,
    fechaInscripcion DATETIME,
    ID_Practica INT NOT NULL,
    PRIMARY KEY(ID_Inscripcion),
    CONSTRAINT FOREIGN KEY(ID_Usuario) REFERENCES usuarios(ID_Usuario),
	CONSTRAINT FOREIGN KEY(ID_Carrera) REFERENCES carreras(ID_Carrera),
    CONSTRAINT FOREIGN KEY(ID_Materias) REFERENCES materias(ID_Materias),
    CONSTRAINT FOREIGN KEY(ID_Año) REFERENCES año(ID_Año),
    CONSTRAINT FOREIGN KEY(ID_Practica) REFERENCES practicas(ID_Practica)
);

CREATE TABLE practicaDia(
	ID_Tabla INT NOT NULL AUTO_INCREMENT,
    ID_Profesores INT NOT NULL,
    ID_Practica INT NOT NULL,
	ID_DiaPractica INT NOT NULL,
    PRIMARY KEY(ID_Tabla),
    FOREIGN KEY(ID_Profesores) REFERENCES profesores(ID_Profesores),
    FOREIGN KEY(ID_Practica) REFERENCES practicas(ID_Practica),
    FOREIGN KEY(ID_DiaPractica) REFERENCES diaPractica(ID_DiaPractica)
);

CREATE TABLE alumnosCarrera(
	ID_Tabla INT NOT NULL AUTO_INCREMENT,
    ID_Usuario INT NOT NULL,
    ID_Carrera INT NOT NULL,
    PRIMARY KEY(ID_Tabla),
    FOREIGN KEY(ID_Usuario) REFERENCES usuarios(ID_Usuario),
    FOREIGN KEY(ID_Carrera) REFERENCES carreras(ID_Carrera)
);

CREATE TABLE profesoresCarrera(
	ID_Tabla INT NOT NULL AUTO_INCREMENT,
    ID_Usuario INT NOT NULL,
    ID_Carrera INT NOT NULL,
    PRIMARY KEY(ID_Tabla),
    FOREIGN KEY(ID_Usuario) REFERENCES usuarios(ID_Usuario),
    FOREIGN KEY(ID_Carrera) REFERENCES carreras(ID_Carrera)
);

INSERT INTO cargos VALUES(1,"ADMIN");
INSERT INTO cargos VALUES(2,"PROFESOR");
INSERT INTO cargos VALUES(3,"ALUMNO");

INSERT INTO sexo VALUES(1,"M");
INSERT INTO sexo VALUES(2,"F");
INSERT INTO sexo VALUES(3,"X");

INSERT INTO año VALUES(1,"Primero");
INSERT INTO año VALUES(2,"Segundo");
INSERT INTO año VALUES(3,"Tercero");

INSERT INTO diaPractica VALUES(1,"Lunes");
INSERT INTO diaPractica VALUES(2,"Martes");
INSERT INTO diaPractica VALUES(3,"Miercoles");
INSERT INTO diaPractica VALUES(4,"Jueves");
INSERT INTO diaPractica VALUES(5,"Viernes");
INSERT INTO diaPractica VALUES(6,"Sabado");
INSERT INTO diaPractica VALUES(7,"Domingo");


INSERT INTO carreras VALUES(1,"Enfermeria");
INSERT INTO carreras VALUES(2,"Higiene y Seguridad en el Trabajo");
INSERT INTO carreras VALUES(3,"Administración de Recursos Humanos");
INSERT INTO carreras VALUES(4,"Instrumentación Quirúrgica");
INSERT INTO carreras VALUES(5,"Bibliotecología");
INSERT INTO carreras VALUES(6,"Bibliotecario instituciones Educativas");

INSERT INTO materias VALUES(1,"Practicas I",1);
INSERT INTO materias VALUES(2,"Practicas II",1);
INSERT INTO materias VALUES(3,"Practicas III",1);

INSERT INTO materias VALUES(4,"Practicas I",4);
INSERT INTO materias VALUES(5,"Practicas II ",4);
INSERT INTO materias VALUES(6,"Practicas III",4);

INSERT INTO materias VALUES(7,"Practicas I",5);
INSERT INTO materias VALUES(8,"Practicas II",5);
INSERT INTO materias VALUES(9,"Practicas III ",5);

INSERT INTO materias VALUES(10,"Practicas I",2);
INSERT INTO materias VALUES(11,"Practicas II",2);
INSERT INTO materias VALUES(12,"Practicas III",2);

INSERT INTO materias VALUES(13,"Practicas I",6);
INSERT INTO materias VALUES(14,"Practicas II",6);
INSERT INTO materias VALUES(15,"Practicas III",6);

INSERT INTO materias VALUES(16,"Practicas I",3);
INSERT INTO materias VALUES(17,"Practicas II",3);
INSERT INTO materias VALUES(18,"Practicas III",3);

INSERT INTO usuarios VALUES(1,123,"admin","admin@gmail.com",1);
INSERT INTO usuarios VALUES(2,123,"profesor","profesor@gmail.com",2);
INSERT INTO usuarios VALUES(3,123,"alumno","alumno@gmail.com",3);


DELIMITER $$

CREATE TRIGGER evitar_inscripcion_duplicada
BEFORE INSERT ON inscripcion
FOR EACH ROW
BEGIN
    DECLARE carrera_existente INT;
    
    -- Verificar si ya existe una inscripción para el mismo usuario y carrera
    SELECT COUNT(*) INTO carrera_existente
    FROM inscripcion
    WHERE ID_Usuario = NEW.ID_Usuario
    AND ID_Carrera = NEW.ID_Carrera;
    
    -- Si existe, lanzar un error
    IF carrera_existente > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Ya estás inscrito en esta practica.';
    END IF;
END$$

DELIMITER ;


DELIMITER //

CREATE TRIGGER borrar_inscripciones
BEFORE DELETE ON practicas
FOR EACH ROW
BEGIN
    DELETE FROM inscripcion WHERE ID_Practica = OLD.ID_Practica;
END;

//

DELIMITER ;

DELIMITER //

CREATE TRIGGER sumar_vacante
AFTER DELETE ON inscripcion
FOR EACH ROW
BEGIN
    UPDATE practicas
    SET Vacantes = Vacantes + 1
    WHERE ID_Practica = OLD.ID_Practica;
END//

DELIMITER ;

DELIMITER //

CREATE TRIGGER restar_vacante
BEFORE INSERT ON inscripcion
FOR EACH ROW
BEGIN
    DECLARE vacantes_actuales INT;

    -- Obtenemos el número de vacantes actuales para la práctica
    SELECT Vacantes INTO vacantes_actuales
    FROM practicas
    WHERE ID_Practica = NEW.ID_Practica;

    -- Validamos que haya vacantes disponibles
    IF vacantes_actuales <= 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'No hay más vacantes disponibles para esta práctica';
    ELSE
        -- Restamos una vacante si hay disponibles
        UPDATE practicas
        SET Vacantes = Vacantes - 1
        WHERE ID_Practica = NEW.ID_Practica;
    END IF;
END//

DELIMITER ;