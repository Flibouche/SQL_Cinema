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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.actor : ~13 rows (environ)
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.director : ~4 rows (environ)
INSERT INTO `director` (`idDirector`, `idPerson`) VALUES
	(1, 4),
	(2, 8),
	(3, 9),
	(9, 54);

-- Listage de la structure de la table kevin_cinema. movie
CREATE TABLE IF NOT EXISTS `movie` (
  `idMovie` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `releaseYear` year NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `note` float NOT NULL DEFAULT (0),
  `synopsis` text,
  `poster` varchar(255) NOT NULL,
  `idDirector` int DEFAULT NULL,
  PRIMARY KEY (`idMovie`),
  KEY `idDirector` (`idDirector`),
  CONSTRAINT `FK1_movie_director` FOREIGN KEY (`idDirector`) REFERENCES `director` (`idDirector`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.movie : ~9 rows (environ)
INSERT INTO `movie` (`idMovie`, `title`, `releaseYear`, `duration`, `note`, `synopsis`, `poster`, `idDirector`) VALUES
	(1, 'Le Seigneur des anneaux : la communauté de l\'anneau', '2001', 178, 4.5, 'Dans ce chapitre de la trilogie, le jeune et timide Hobbit, Frodon Sacquet, hérite d\'un anneau. Bien loin d\'être une simple babiole, il s\'agit de l\'Anneau Unique, un instrument de pouvoir absolu qui permettrait à Sauron, le Seigneur des ténèbres, de régner sur la Terre du Milieu et de réduire en esclavage ses peuples. À moins que Frodon, aidé d\'une Compagnie constituée de Hobbits, d\'Hommes, d\'un Magicien, d\'un Nain, et d\'un Elfe, ne parvienne à emporter l\'Anneau à travers la Terre du Milieu jusqu\'à la Crevasse du Destin, lieu où il a été forgé, et à le détruire pour toujours. Un tel périple signifie s\'aventurer très loin en Mordor, les terres du Seigneur des ténèbres, où est rassemblée son armée d\'Orques maléfiques... La Compagnie doit non seulement combattre les forces extérieures du mal mais aussi les dissensions internes et l\'influence corruptrice qu\'exerce l\'Anneau lui-même.\r\n\r\nL\'issue de l\'histoire à venir est intimement liée au sort de la Compagnie.\r\n', 'https://www.affiche-cine.com/images/thumb-518x690/0/37290643774763633692.jpg', 1),
	(2, 'X-Men', '2000', 105, 3.9, '1944, dans un camp de concentration. Séparé par la force de ses parents, le jeune Erik Magnus Lehnsherr se découvre d\'étranges pouvoirs sous le coup de la colère : il peut contrôler les métaux. C\'est un mutant. Soixante ans plus tard, l\'existence des mutants est reconnue mais provoque toujours un vif émoi au sein de la population. Puissant télépathe, le professeur Charles Xavier dirige une école destinée à recueillir ces êtres différents, souvent rejetés par les humains, et accueille un nouveau venu solitaire au passé mystérieux : Logan, alias Wolverine. En compagnie de Cyclope, Tornade et Jean Grey, les deux hommes forment les X-Men et vont affronter les sombres mutants ralliés à la cause de Erik Lehnsherr / Magnéto, en guerre contre l\'humanité.', 'https://www.affiche-cine.com/images/thumb-518x690/33/affiche-cine-83190.jpg', 2),
	(3, 'Pulp Fiction', '1994', 149, 4.5, 'L&#039;odyss&eacute;e sanglante et burlesque de petits malfrats dans la jungle de Hollywood &agrave; travers trois histoires qui s&#039;entrem&ecirc;lent.', './public/img/movies/6622621e577f05.53545470.webp', 3),
	(4, 'Les Huit salopards', '2016', 168, 4.1, 'Quelques années après la Guerre de Sécession, le chasseur de primes John Ruth, dit Le Bourreau, fait route vers Red Rock, où il conduit sa prisonnière Daisy Domergue se faire pendre. Sur leur route, ils rencontrent le Major Marquis Warren, un ancien soldat lui aussi devenu chasseur de primes, et Chris Mannix, le nouveau shérif de Red Rock. Surpris par le blizzard, ils trouvent refuge dans une auberge au milieu des montagnes, où ils sont accueillis par quatre personnages énigmatiques : le confédéré, le mexicain, le cowboy et le court-sur-pattes. Alors que la tempête s’abat au-dessus du massif, l’auberge va abriter une série de tromperies et de trahisons. L’un de ces huit salopards n’est pas celui qu’il prétend être ; il y a fort à parier que tout le monde ne sortira pas vivant de l’auberge de Minnie…', 'https://www.affiche-cine.com/images/thumb-518x690/19/423245068181014827913.jpg', 3),
	(5, 'Django Unchained', '2013', 164, 4.5, 'Dans le sud des États-Unis, deux ans avant la guerre de Sécession, le Dr King Schultz, un chasseur de primes allemand, fait l’acquisition de Django, un esclave qui peut l’aider à traquer les frères Brittle, les meurtriers qu’il recherche. Schultz promet à Django de lui rendre sa liberté lorsqu’il aura capturé les Brittle – morts ou vifs.\r\n\r\nAlors que les deux hommes pistent les dangereux criminels, Django n’oublie pas que son seul but est de retrouver Broomhilda, sa femme, dont il fut séparé à cause du commerce des esclaves…\r\n\r\nLorsque Django et Schultz arrivent dans l’immense plantation du puissant Calvin Candie, ils éveillent les soupçons de Stephen, un esclave qui sert Candie et a toute sa confiance. Le moindre de leurs mouvements est désormais épié par une dangereuse organisation de plus en plus proche… Si Django et Schultz veulent espérer s’enfuir avec Broomhilda, ils vont devoir choisir entre l’indépendance et la solidarité, entre le sacrifice et la survie…\r\n', 'https://www.affiche-cine.com/images/thumb-518x690/17/41835872524580589780.jpg', 3),
	(30, 'Le Seigneur des anneaux : les deux tours', '2002', 179, 4.5, 'Apr&egrave;s la mort de Boromir et la disparition de Gandalf, la Communaut&eacute; s&#039;est scind&eacute;e en trois. Perdus dans les collines d&#039;Emyn Muil, Frodon et Sam d&eacute;couvrent qu&#039;ils sont suivis par Gollum, une cr&eacute;ature versatile corrompue par l&#039;Anneau. Celui-ci promet de conduire les Hobbits jusqu&#039;&agrave; la Porte Noire du Mordor. A travers la Terre du Milieu, Aragorn, Legolas et Gimli font route vers le Rohan, le royaume assi&eacute;g&eacute; de Theoden. Cet ancien grand roi, manipul&eacute; par l&#039;espion de Saroumane, le sinistre Langue de Serpent, est d&eacute;sormais tomb&eacute; sous la coupe du malfaisant Magicien. Eowyn, la ni&egrave;ce du Roi, reconna&icirc;t en Aragorn un meneur d&#039;hommes. Entretemps, les Hobbits Merry et Pippin, prisonniers des Uruk-hai, se sont &eacute;chapp&eacute;s et ont d&eacute;couvert dans la myst&eacute;rieuse For&ecirc;t de Fangorn un alli&eacute; inattendu : Sylvebarbe, gardien des arbres, repr&eacute;sentant d&#039;un ancien peuple v&eacute;g&eacute;tal dont Saroumane a d&eacute;cim&eacute; la for&ecirc;t...', 'https://www.affiche-cine.com/images/thumb-518x690/2/37641624377511007566.jpg', 1),
	(31, 'Le Seigneur des anneaux : le retour du roi', '2003', 201, 4.5, '\r\n\r\nLes arm&eacute;es de Sauron ont attaqu&eacute; Minas Tirith, la capitale de Gondor. Jamais ce royaume autrefois puissant n&#039;a eu autant besoin de son roi. Mais Aragorn trouvera-t-il en lui la volont&eacute; d&#039;accomplir sa destin&eacute;e ?\r\n\r\nTandis que Gandalf s&#039;efforce de soutenir les forces bris&eacute;es de Gondor, Th&eacute;oden exhorte les guerriers de Rohan &agrave; se joindre au combat. Mais malgr&eacute; leur courage et leur loyaut&eacute;, les forces des Hommes ne sont pas de taille &agrave; lutter contre les innombrables l&eacute;gions d&#039;ennemis qui s&#039;abattent sur le royaume...\r\n\r\nChaque victoire se paye d&#039;immenses sacrifices. Malgr&eacute; ses pertes, la Communaut&eacute; se jette dans la bataille pour la vie, ses membres faisant tout pour d&eacute;tourner l&#039;attention de Sauron afin de donner &agrave; Frodon une chance d&#039;accomplir sa qu&ecirc;te.\r\n\r\nVoyageant &agrave; travers les terres ennemies, ce dernier doit se reposer sur Sam et Gollum, tandis que l&#039;Anneau continue de le tenter...', 'https://www.affiche-cine.com/images/thumb-518x690/3/37992676957328273784.jpg', 1),
	(40, 'Tenet', '2000', 150, 5, 'Azerty', './public/img/movies/66225985e1e4e5.65253426.webp', 1);

-- Listage de la structure de la table kevin_cinema. movie_theme
CREATE TABLE IF NOT EXISTS `movie_theme` (
  `idMovie` int NOT NULL,
  `idTheme` int NOT NULL,
  KEY `idMovie` (`idMovie`),
  KEY `idTheme` (`idTheme`),
  CONSTRAINT `FK1_movie_theme_movie` FOREIGN KEY (`idMovie`) REFERENCES `movie` (`idMovie`),
  CONSTRAINT `FK2_movie_theme_theme` FOREIGN KEY (`idTheme`) REFERENCES `theme` (`idTheme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.movie_theme : ~16 rows (environ)
INSERT INTO `movie_theme` (`idMovie`, `idTheme`) VALUES
	(1, 1),
	(1, 2),
	(2, 2),
	(2, 3),
	(2, 4),
	(2, 5),
	(4, 8),
	(5, 8),
	(30, 1),
	(30, 2),
	(31, 1),
	(31, 2),
	(40, 5),
	(3, 7),
	(3, 6);

-- Listage de la structure de la table kevin_cinema. person
CREATE TABLE IF NOT EXISTS `person` (
  `idPerson` int NOT NULL AUTO_INCREMENT,
  `firstname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `surname` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sex` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `birthdate` date NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idPerson`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.person : ~16 rows (environ)
INSERT INTO `person` (`idPerson`, `firstname`, `surname`, `sex`, `birthdate`, `picture`) VALUES
	(1, 'Elijah', 'Wood', 'M', '1981-01-28', './public/img/persons/662237324f6c35.82620521.webp'),
	(2, 'Sean', 'Astin', 'M', '1971-02-25', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/07/22/17/26/392369.jpg'),
	(3, 'Ian', 'McKellen', 'M', '1939-05-25', 'https://fr.web.img2.acsta.net/c_310_420/pictures/14/12/04/10/40/127447.jpg'),
	(4, 'Peter', 'Jackson', 'M', '1961-10-31', 'https://fr.web.img6.acsta.net/c_310_420/pictures/14/12/04/10/39/195496.jpg'),
	(5, 'Patrick', 'Stewart', 'M', '1940-07-13', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/11/12/17/00/5910399.jpg'),
	(6, 'Hugh', 'Jackman', 'M', '1968-10-12', 'https://fr.web.img2.acsta.net/c_310_420/pictures/15/09/21/15/14/169867.jpg'),
	(7, 'Halle', 'Berry', 'F', '1966-08-14', 'https://fr.web.img5.acsta.net/c_310_420/pictures/15/10/29/14/27/267556.jpg'),
	(8, 'Bryan', 'Singer', 'M', '1965-09-17', 'https://fr.web.img2.acsta.net/c_310_420/pictures/16/03/09/12/21/271292.jpg'),
	(9, 'Quentin', 'Tarantino', 'M', '1963-03-27', 'https://fr.web.img6.acsta.net/c_310_420/pictures/19/05/22/10/33/5945451.jpg'),
	(10, 'John', 'Travolta', 'M', '1954-02-18', 'https://fr.web.img6.acsta.net/c_310_420/pictures/18/05/15/15/20/5209194.jpg'),
	(11, 'Samuel L.', 'Jackson', 'M', '1948-12-21', 'https://fr.web.img3.acsta.net/c_310_420/pictures/15/07/27/12/24/354255.jpg'),
	(12, 'Uma', 'Thurman', 'F', '1970-04-29', 'https://fr.web.img6.acsta.net/c_310_420/pictures/17/04/21/14/43/578296.jpg'),
	(13, 'Kurt', 'Russell', 'M', '1951-03-17', 'https://fr.web.img4.acsta.net/c_310_420/pictures/17/04/25/14/52/158476.jpg'),
	(14, 'Walton', 'Goggins', 'M', '1971-11-10', 'https://fr.web.img4.acsta.net/c_310_420/pictures/15/12/21/10/19/202230.jpg'),
	(15, 'Jamie', 'Fox', 'M', '1967-12-13', 'https://fr.web.img2.acsta.net/c_310_420/pictures/20/01/14/15/37/5077458.jpg'),
	(54, 'Denis', 'Villeneuve', 'M', '1967-10-03', 'https://fr.web.img2.acsta.net/c_310_420/pictures/17/08/16/14/22/169738.jpg');

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
	(5, 12, 17),
	(1, 13, 5);

-- Listage de la structure de la table kevin_cinema. role
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int NOT NULL AUTO_INCREMENT,
  `roleName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.role : ~0 rows (environ)
INSERT INTO `role` (`idRole`, `roleName`) VALUES
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
  `typeName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idTheme`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table kevin_cinema.theme : ~9 rows (environ)
INSERT INTO `theme` (`idTheme`, `typeName`) VALUES
	(1, 'Aventure'),
	(2, 'Fantastique'),
	(3, 'Science-Fiction'),
	(4, 'Thriller'),
	(5, 'Action'),
	(6, 'Policier'),
	(7, 'Drame'),
	(8, 'Western'),
	(10, 'Romance');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
