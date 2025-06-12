CREATE DATABASE IF NOT EXISTS Studenti;
USE Studenti;

CREATE TABLE IF NOT EXISTS Corso_di_studi(
    Cod_corso INT AUTO_INCREMENT Primary KEY,
    Nome_corso VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Disciplina(
    Cod_dis int AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS Studenti (
    Matricola int PRIMARY KEY AUTO_INCREMENT,
    Cognome VARCHAR(50) NOT NULL,
    Nascita DATE NOT NULL,
    Fk_corso INT,
    FOREIGN KEY (Fk_corso) REFERENCES Corso_di_studi (Cod_corso) ON DELETE NO ACTION ON UPDATE CASCADE,
    Capogruppo INT NOT NULL
);

CREATE TABLE IF NOT EXISTS Valutazioni(
    Cod_val int AUTO_INCREMENT Primary key,
    voto int NOT NULL,
    data_voto date NOT NULL,
    Fk_Studenti int,
    Fk_disciplina int,
    FOREIGN KEY (Fk_Studenti) REFERENCES Studenti (Matricola) ON DELETE NO ACTION ON UPDATE CASCADE,
    FOREIGN KEY (Fk_disciplina) REFERENCES Disciplina (Cod_dis) ON DELETE NO ACTION ON UPDATE CASCADE
);

INSERT INTO Corso_di_studi (Nome_corso)
VALUES
('informarica'),
('Telecomunicazioni');

SELECT * FROM Corso_di_studi;

INSERT INTO Disciplina (Nome)
VALUES
('Matematica'),
('informatic'),
('storia');

SELECT * FROM Disciplina;

INSERT INTO Studenti (Cognome, Nascita, Capogruppo)
VALUES
('Rossi', '1990-05-15', 1),
('Bianchi', '1995-08-10', 1),
('Verdi', '1992-02-20', 3),
('Neri', '1993-07-05', 3);

SELECT * FROM Studenti;

SELECT s.Cognome, s1.Cognome
FROM Studenti s,Studenti s1
WHERE s.Capogruppo = s1.matricola;

UPDATE Studenti 
SET Capogruppo = '3'
WHERE Capogruppo = '2';