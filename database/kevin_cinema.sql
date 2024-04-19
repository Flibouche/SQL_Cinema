-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour kevin_cinema
CREATE DATABASE IF NOT EXISTS `kevin_cinema` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `kevin_cinema`;

-- Listage de la structure de la table kevin_cinema. actor
CREATE TABLE IF NOT EXISTS `actor` (
  `idActor` int NOT NULL AUTO_INCREMENT,
  `idPerson` int NOT NULL,
  PRIMARY KEY (`idActor`),
  KEY `idPerson` (`idPerson`),
  CONSTRAINT `FK1_actor_person` FOREIGN KEY (`idPerson`) REFERENCES `person` (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `idDirector` int NOT NULL AUTO_INCREMENT,
  `idPerson` int NOT NULL,
  PRIMARY KEY (`idDirector`),
  KEY `idPerson` (`idPerson`),
  CONSTRAINT `FK1_director_person` FOREIGN KEY (`idPerson`) REFERENCES `person` (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `idMovie` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `releaseYear` year NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `note` float NOT NULL DEFAULT (0),
  `synopsis` text,
  `poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `idDirector` int DEFAULT NULL,
  PRIMARY KEY (`idMovie`),
  KEY `idDirector` (`idDirector`),
  CONSTRAINT `FK1_movie_director` FOREIGN KEY (`idDirector`) REFERENCES `director` (`idDirector`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. movie_theme
CREATE TABLE IF NOT EXISTS `movie_theme` (
  `idMovie` int NOT NULL,
  `idTheme` int NOT NULL,
  KEY `idMovie` (`idMovie`),
  KEY `idTheme` (`idTheme`),
  CONSTRAINT `FK1_movie_theme_movie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`),
  CONSTRAINT `FK2_movie_theme_theme` FOREIGN KEY (`idTheme`) REFERENCES `theme` (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `idPerson` int NOT NULL AUTO_INCREMENT,
  `firstname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sex` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthdate` date NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. play
CREATE TABLE IF NOT EXISTS `play` (
  `idMovie` int NOT NULL,
  `idActor` int NOT NULL,
  `idRole` int NOT NULL,
  KEY `idMovie` (`idMovie`),
  KEY `idActor` (`idActor`),
  KEY `idRole` (`idRole`),
  CONSTRAINT `FK1_play_movie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`),
  CONSTRAINT `FK2_play_actor` FOREIGN KEY (`idActor`) REFERENCES `actor` (`idActor`),
  CONSTRAINT `FK3_play_role` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

-- Listage de la structure de la table kevin_cinema. theme
CREATE TABLE IF NOT EXISTS `theme` (
  `idTheme` int NOT NULL AUTO_INCREMENT,
  `typeName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Les données exportées n'étaient pas sélectionnées.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
