--Creazione database
CREATE DATABASE IF NOT EXISTS videoteca;
USE videoteca;

--Creazione della tabella per gli utenti
CREATE TABLE IF NOT EXISTS utenti (
  id_utente INT AUTO_INCREMENT PRIMARY KEY,
  cognome VARCHAR(50) NOT NULL,
  nome VARCHAR(50) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  pass VARCHAR(255) NOT NULL
);

--Creazione della tabella prenotazioni 
CREATE TABLE IF NOT EXISTS prenotazioni (
  id_prenotazione INT AUTO_INCREMENT PRIMARY KEY,
  periodo DATE NOT NULL,
  utente INT NOT NULL,
  film INT NOT NULL,
  FOREIGN KEY (utente) REFERENCES utenti (id_utente) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (film) REFERENCES film (id_film)ON DELETE NO ACTION ON UPDATE CASCADE
);

--Creazione della tabella film
CREATE TABLE IF NOT EXISTS film (
  id_film INT AUTO_INCREMENT PRIMARY KEY,
  titolo VARCHAR(100) NOT NULL,
  genere VARCHAR(50) NOT NULL,
  anno_uscita YEAR NOT NULL,
  durata TIME NOT NULL,
  id_regista INT NOT NULL,
  id_attore INT NOT NULL,
  id_contratto INT NOT NULL,
  FOREIGN KEY (id_regista) REFERENCES regista (id_regista) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (id_attore) REFERENCES attore (id_attore) ON DELETE NO ACTION ON UPDATE CASCADE,
  FOREIGN KEY (id_contratto) REFERENCES contratto (id_contratto) ON DELETE NO ACTION ON UPDATE CASCADE
);

--Creazione della tabella regista
CREATE TABLE IF NOT EXISTS regista (
  id_regista INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  cognome VARCHAR(50) NOT NULL
);

--Creazione della tabella contratto
CREATE TABLE IF NOT EXISTS contratto (
  id_contratto INT AUTO_INCREMENT PRIMARY KEY,
  periodo DATE NOT NULL
);

--Creazione della tabella attore
CREATE TABLE IF NOT EXISTS attore (
  id_attore INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(50) NOT NULL,
  cognome VARCHAR(50) NOT NULL,
  data_nascita DATE NOT NULL
);

--inserimento dai dati--

--inserimento nella tabella utente
INSERT INTO utenti (cognome,nome,email,pass)
VALUES
('Rossi', 'Mario', 'mario@gmail.com', 'mariorossi99'),
('Bianchi', 'Giuseppe', 'giuseppe@gmail.com', 'giuseppebianchi88');

SELECT * FROM utenti;

--inserimento nella tabella regista
INSERT INTO regista (nome, cognome)
VALUES
('Frank', 'Darabont'),
('George', 'Lucas');

SELECT * FROM regista;

--inserimento nella tabella attore
INSERT INTO attore (nome, cognome, data_nascita)
VALUES
('Michael', 'Clarke', '1957-10-12'),
('Harrison','Ford','1942-07-13');

SELECT * FROM attore;

--inserimento nella tabella contratto
INSERT INTO contratto (periodo)
VALUES
('2025-01-01'),
('2026-01-01');

SELECT * FROM contratto;

--inserimento nella tabella film   
INSERT INTO film (titolo, genere, anno_uscita, durata, id_regista, id_attore, id_contratto)
VALUES
('Il miglio verde','Giallo/Cinema fantastico','2000','3:09','1','1','1'),
('Guerre Stellari','fantascienza','1997','2:10','2','2','2');

SELECT * FROM film;

--inserimento nella tabella prenotazioni
INSERT INTO prenotazioni (periodo, utente, film)
VALUES
('2025-01-05','1','1'),
('2025-01-12','2','2');

SELECT * FROM prenotazioni;
