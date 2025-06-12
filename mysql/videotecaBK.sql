-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: videoteca
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `attore`
--

DROP TABLE IF EXISTS `attore`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `attore` (
  `id_attore` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `data_nascita` date NOT NULL,
  PRIMARY KEY (`id_attore`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attore`
--

LOCK TABLES `attore` WRITE;
/*!40000 ALTER TABLE `attore` DISABLE KEYS */;
INSERT INTO `attore` VALUES (1,'Michael','Clarke','1957-10-12'),(2,'Harrison','Ford','1942-07-13');
/*!40000 ALTER TABLE `attore` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contratto`
--

DROP TABLE IF EXISTS `contratto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contratto` (
  `id_contratto` int NOT NULL AUTO_INCREMENT,
  `periodo` date NOT NULL,
  PRIMARY KEY (`id_contratto`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contratto`
--

LOCK TABLES `contratto` WRITE;
/*!40000 ALTER TABLE `contratto` DISABLE KEYS */;
INSERT INTO `contratto` VALUES (1,'2025-01-01'),(2,'2026-01-01');
/*!40000 ALTER TABLE `contratto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `film`
--

DROP TABLE IF EXISTS `film`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `film` (
  `id_film` int NOT NULL AUTO_INCREMENT,
  `titolo` varchar(100) NOT NULL,
  `genere` varchar(50) NOT NULL,
  `anno_uscita` year NOT NULL,
  `durata` time NOT NULL,
  `id_regista` int NOT NULL,
  `id_attore` int NOT NULL,
  `id_contratto` int NOT NULL,
  PRIMARY KEY (`id_film`),
  KEY `id_regista` (`id_regista`),
  KEY `id_attore` (`id_attore`),
  KEY `id_contratto` (`id_contratto`),
  CONSTRAINT `film_ibfk_1` FOREIGN KEY (`id_regista`) REFERENCES `regista` (`id_regista`) ON UPDATE CASCADE,
  CONSTRAINT `film_ibfk_2` FOREIGN KEY (`id_attore`) REFERENCES `attore` (`id_attore`) ON UPDATE CASCADE,
  CONSTRAINT `film_ibfk_3` FOREIGN KEY (`id_contratto`) REFERENCES `contratto` (`id_contratto`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `film`
--

LOCK TABLES `film` WRITE;
/*!40000 ALTER TABLE `film` DISABLE KEYS */;
INSERT INTO `film` VALUES (1,'Il miglio verde','Giallo/Cinema fantastico',2000,'03:09:00',1,1,1),(2,'Guerre Stellari','fantascienza',1997,'02:10:00',2,2,2);
/*!40000 ALTER TABLE `film` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prenotazioni`
--

DROP TABLE IF EXISTS `prenotazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prenotazioni` (
  `id_prenotazione` int NOT NULL AUTO_INCREMENT,
  `periodo` date NOT NULL,
  `utente` int NOT NULL,
  `film` int NOT NULL,
  PRIMARY KEY (`id_prenotazione`),
  KEY `utente` (`utente`),
  KEY `film` (`film`),
  CONSTRAINT `prenotazioni_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`id_utente`) ON UPDATE CASCADE,
  CONSTRAINT `prenotazioni_ibfk_2` FOREIGN KEY (`film`) REFERENCES `film` (`id_film`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prenotazioni`
--

LOCK TABLES `prenotazioni` WRITE;
/*!40000 ALTER TABLE `prenotazioni` DISABLE KEYS */;
INSERT INTO `prenotazioni` VALUES (1,'2025-01-05',1,1),(2,'2025-01-12',2,2);
/*!40000 ALTER TABLE `prenotazioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `regista`
--

DROP TABLE IF EXISTS `regista`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `regista` (
  `id_regista` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  PRIMARY KEY (`id_regista`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `regista`
--

LOCK TABLES `regista` WRITE;
/*!40000 ALTER TABLE `regista` DISABLE KEYS */;
INSERT INTO `regista` VALUES (1,'Frank','Darabont'),(2,'George','Lucas');
/*!40000 ALTER TABLE `regista` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utenti`
--

DROP TABLE IF EXISTS `utenti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utenti` (
  `id_utente` int NOT NULL AUTO_INCREMENT,
  `cognome` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utente`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utenti`
--

LOCK TABLES `utenti` WRITE;
/*!40000 ALTER TABLE `utenti` DISABLE KEYS */;
INSERT INTO `utenti` VALUES (1,'Rossi','Mario','mario@gmail.com','mariorossi99'),(2,'Bianchi','Giuseppe','giuseppe@gmail.com','giuseppebianchi88');
/*!40000 ALTER TABLE `utenti` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-04 12:42:23
