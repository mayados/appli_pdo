-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour store
CREATE DATABASE IF NOT EXISTS `store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `store`;

-- Listage de la structure de table store. product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Listage des données de la table store.product : ~4 rows (environ)
INSERT INTO `product` (`id`, `name`, `description`, `price`) VALUES
	(15, 'Okami', 'Ōkami est un jeu vidéo d\'action-aventure developpé par Clover Studio et édité par Capcom en 2006 sur PlayStation 2. L\'adaptation sur la console Wii, développée par Ready at Dawn, est sortie le 12 juin 2008. Une suite sur Nintendo DS appelée Ōkamiden est sortie début 2011', 22),
	(16, 'Psychonauts', 'Psychonauts est un jeu de plate-forme développé par Double Fine Productions et édité par Majesco, sorti en 2005 sur Xbox, PlayStation 2, Windows et en 2007 sur le marketplace de la Xbox 360. Une version Linux est sortie en 2012, portée par icculus et diffusée via l\'Humble Indie Bundle V', 15),
	(17, 'It Takes Two', 'It Takes Two est un jeu vidéo d\'aventure développé par Hazelight Studios et édité par EA Originals. Le jeu est sorti le 26 mars 2021 sur Xbox One, Xbox Series, PlayStation 4, PlayStation 5 et Microsoft Windows. C\'est le deuxième jeu du studio de Josef Fares après A Way Out', 30),
	(18, 'Visage', 'Visage est un jeu vidéo indépendant d\'horreur psychologique en vue à la première personne, développé par l\'entreprise québécoise SadSquare Studio. Le projet du jeu, débuté en janvier 2016, a été financé par une campagne Kickstarter. Le jeu est disponible en accès anticipé depuis le 2 octobre 2018', 45);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
