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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.actor : ~0 rows (environ)
INSERT INTO `actor` (`idActor`, `idPerson`) VALUES
	(1, 1),
	(2, 2),
	(3, 3),
	(4, 5),
	(5, 6),
	(6, 7),
	(7, 9),
	(8, 10),
	(9, 11),
	(10, 12),
	(11, 13),
	(12, 14),
	(13, 15);

-- Listage de la structure de la table kevin_cinema. director
CREATE TABLE IF NOT EXISTS `director` (
  `idDirector` int NOT NULL AUTO_INCREMENT,
  `idPerson` int NOT NULL,
  PRIMARY KEY (`idDirector`),
  KEY `idPerson` (`idPerson`),
  CONSTRAINT `FK1_director_person` FOREIGN KEY (`idPerson`) REFERENCES `person` (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.director : ~0 rows (environ)
INSERT INTO `director` (`idDirector`, `idPerson`) VALUES
	(1, 4),
	(2, 8),
	(3, 9);

-- Listage de la structure de la table kevin_cinema. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `idMovie` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `releaseYear` int NOT NULL DEFAULT '0',
  `duration` int NOT NULL DEFAULT '0',
  `note` int NOT NULL DEFAULT '0',
  `synopsis` text,
  `poster` varchar(255) NOT NULL,
  `idDirector` int NOT NULL,
  PRIMARY KEY (`idMovie`),
  KEY `idDirector` (`idDirector`),
  CONSTRAINT `FK1_movie_director` FOREIGN KEY (`idDirector`) REFERENCES `director` (`idDirector`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.movie : ~5 rows (environ)
INSERT INTO `movie` (`idMovie`, `title`, `releaseYear`, `duration`, `note`, `synopsis`, `poster`, `idDirector`) VALUES
	(1, 'Le Seigneur des anneaux : la communauté de l\'anneau', 2001, 178, 5, 'Dans ce chapitre de la trilogie, le jeune et timide Hobbit, Frodon Sacquet, hérite d\'un anneau. Bien loin d\'être une simple babiole, il s\'agit de l\'Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. À moins que Frodon, aidé d\'une Compagnie constituée de Hobbits, d\'Hommes, d\'un Magicien, d\'un Nain, et d\'un Elfe, ne parvienne à emporter l\'Anneau à travers la Terre du Milieu jusqu\'à la Crevasse du Destin, lieu où il a été forgé, et à le détruire pour toujours. Un tel périple signifie s\'aventurer très loin en Mordor, les terres du Seigneur des ténèbres, où est rassemblée son armée d\'Orques maléfiques... La Compagnie doit non seulement combattre les forces extérieures du mal mais aussi les dissensions internes et l\'influence corruptrice qu\'exerce l\'Anneau lui-même.\r\n\r\nL\'issue de l\'histoire à venir est intimement liée au sort de la Compagnie.\r\n', 'https://www.affiche-cine.com/images/thumb-518x690/0/37290643774763633692.jpg', 1),
	(2, 'X-Men', 2000, 105, 4, '1944, dans un camp de concentration. Séparé par la force de ses parents, le jeune Erik Magnus Lehnsherr se découvre d\'étranges pouvoirs sous le coup de la colère : il peut contrôler les métaux. C\'est un mutant. Soixante ans plus tard, l\'existence des mutants est reconnue mais provoque toujours un vif émoi au sein de la population. Puissant télépathe, le professeur Charles Xavier dirige une école destinée à recueillir ces êtres différents, souvent rejetés par les humains, et accueille un nouveau venu solitaire au passé mystérieux : Logan, alias Wolverine. En compagnie de Cyclope, Tornade et Jean Grey, les deux hommes forment les X-Men et vont affronter les sombres mutants ralliés à la cause de Erik Lehnsherr / Magnéto, en guerre contre l\'humanité.', 'https://www.affiche-cine.com/images/thumb-518x690/33/affiche-cine-83190.jpg', 2),
	(3, 'Pulp Fiction', 1994, 149, 5, 'L\'odyssée sanglante et burlesque de petits malfrats dans la jungle de Hollywood à travers trois histoires qui s\'entremêlent.', 'https://www.affiche-cine.com/images/thumb-518x690/14/41043941436113963340.jpg', 3),
	(4, 'Les Huit salopards', 2016, 168, 4, 'Quelques années après la Guerre de Sécession, le chasseur de primes John Ruth, dit Le Bourreau, fait route vers Red Rock, où il conduit sa prisonnière Daisy Domergue se faire pendre. Sur leur route, ils rencontrent le Major Marquis Warren, un ancien soldat lui aussi devenu chasseur de primes, et Chris Mannix, le nouveau shérif de Red Rock. Surpris par le blizzard, ils trouvent refuge dans une auberge au milieu des montagnes, où ils sont accueillis par quatre personnages énigmatiques : le confédéré, le mexicain, le cowboy et le court-sur-pattes. Alors que la tempête s’abat au-dessus du massif, l’auberge va abriter une série de tromperies et de trahisons. L’un de ces huit salopards n’est pas celui qu’il prétend être ; il y a fort à parier que tout le monde ne sortira pas vivant de l’auberge de Minnie…', 'https://www.affiche-cine.com/images/thumb-518x690/19/423245068181014827913.jpg', 3),
	(5, 'Django Unchained', 2013, 164, 5, 'Dans le sud des États-Unis, deux ans avant la guerre de Sécession, le Dr King Schultz, un chasseur de primes allemand, fait l’acquisition de Django, un esclave qui peut l’aider à traquer les frères Brittle, les meurtriers qu’il recherche. Schultz promet à Django de lui rendre sa liberté lorsqu’il aura capturé les Brittle – morts ou vifs.\r\n\r\nAlors que les deux hommes pistent les dangereux criminels, Django n’oublie pas que son seul but est de retrouver Broomhilda, sa femme, dont il fut séparé à cause du commerce des esclaves…\r\n\r\nLorsque Django et Schultz arrivent dans l’immense plantation du puissant Calvin Candie, ils éveillent les soupçons de Stephen, un esclave qui sert Candie et a toute sa confiance. Le moindre de leurs mouvements est désormais épié par une dangereuse organisation de plus en plus proche… Si Django et Schultz veulent espérer s’enfuir avec Broomhilda, ils vont devoir choisir entre l’indépendance et la solidarité, entre le sacrifice et la survie…\r\n', 'https://www.affiche-cine.com/images/thumb-518x690/17/41835872524580589780.jpg', 3);

-- Listage de la structure de la table kevin_cinema. movie_theme
CREATE TABLE IF NOT EXISTS `movie_theme` (
  `idMovie` int NOT NULL,
  `idTheme` int NOT NULL,
  KEY `idMovie` (`idMovie`),
  KEY `idTheme` (`idTheme`),
  CONSTRAINT `FK1_movie_theme_movie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`),
  CONSTRAINT `FK2_movie_theme_theme` FOREIGN KEY (`idTheme`) REFERENCES `theme` (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.movie_theme : ~0 rows (environ)
INSERT INTO `movie_theme` (`idMovie`, `idTheme`) VALUES
	(1, 1),
	(1, 2),
	(2, 2),
	(2, 3),
	(2, 4),
	(2, 5),
	(3, 6),
	(3, 7),
	(4, 8),
	(5, 8);

-- Listage de la structure de la table kevin_cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `idPerson` int NOT NULL AUTO_INCREMENT,
  `firstname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sex` char(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthdate` date NOT NULL,
  PRIMARY KEY (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.person : ~0 rows (environ)
INSERT INTO `person` (`idPerson`, `firstname`, `surname`, `sex`, `birthdate`) VALUES
	(1, 'Elijah', 'Wood', 'H', '1981-01-28'),
	(2, 'Sean', 'Astin', 'H', '1971-02-25'),
	(3, 'Ian', 'McKellen', 'H', '1939-05-25'),
	(4, 'Peter', 'Jackson', 'H', '1961-10-31'),
	(5, 'Patrick', 'Stewart', 'H', '1940-07-13'),
	(6, 'Hugh', 'Jackman', 'H', '1968-10-12'),
	(7, 'Halle', 'Berry', 'F', '1966-08-14'),
	(8, 'Bryan', 'Singer', 'H', '1965-09-17'),
	(9, 'Quentin', 'Tarantino', 'H', '1963-03-27'),
	(10, 'John', 'Travolta', 'H', '1954-02-18'),
	(11, 'Samuel L.', 'Jackson', 'H', '1948-12-21'),
	(12, 'Uma', 'Thurman', 'F', '1970-04-29'),
	(13, 'Kurt', 'Russell', 'H', '1951-03-17'),
	(14, 'Walton', 'Goggins', 'H', '1971-11-10'),
	(15, 'Jammie', 'Fox', 'H', '1967-12-13');

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

-- Listage des données de la table kevin_cinema.play : ~0 rows (environ)
INSERT INTO `play` (`idMovie`, `idActor`, `idRole`) VALUES
	(1, 1, 1),
	(1, 2, 2),
	(1, 3, 3),
	(2, 3, 5),
	(2, 4, 4),
	(2, 5, 6),
	(2, 6, 7),
	(3, 7, 11),
	(3, 8, 8),
	(3, 9, 9),
	(3, 10, 10),
	(4, 9, 12),
	(4, 11, 13),
	(4, 12, 14),
	(5, 9, 16),
	(5, 13, 15),
	(5, 12, 17);

-- Listage de la structure de la table kevin_cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.role : ~0 rows (environ)
INSERT INTO `role` (`idRole`, `name`) VALUES
	(1, 'Frodon Sacquet'),
	(2, 'Sam Gamegie'),
	(3, 'Gandalf'),
	(4, 'Charles Francis Xavier'),
	(5, 'Magneto'),
	(6, 'Wolverine'),
	(7, 'Tornade'),
	(8, 'Vincent Vega'),
	(9, 'Jules Winnfield'),
	(10, 'Mia Wallace'),
	(11, 'Jimmie Dimmick'),
	(12, 'Commandant Warren'),
	(13, 'John Ruth'),
	(14, 'Chris Mannix'),
	(15, 'Django'),
	(16, 'Stephen'),
	(17, 'Billy Crash');

-- Listage de la structure de la table kevin_cinema. theme
CREATE TABLE IF NOT EXISTS `theme` (
  `idTheme` int NOT NULL AUTO_INCREMENT,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.theme : ~0 rows (environ)
INSERT INTO `theme` (`idTheme`, `type`) VALUES
	(1, 'Aventure'),
	(2, 'Fantastique'),
	(3, 'Science-Fiction'),
	(4, 'Thriller'),
	(5, 'Action'),
	(6, 'Policier'),
	(7, 'Drame'),
	(8, 'Western');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
