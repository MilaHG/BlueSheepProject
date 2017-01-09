# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.42)
# Database: blue_sheep
# Generation Time: 2017-01-09 16:07:10 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table activity
# ------------------------------------------------------------

DROP TABLE IF EXISTS `activity`;

CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `participant_solo` tinyint(1) DEFAULT NULL,
  `participant_duo` tinyint(1) DEFAULT NULL,
  `participant_family` tinyint(1) DEFAULT NULL,
  `participant_friend` tinyint(1) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `recording_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC74095A12469DE2` (`category_id`),
  KEY `IDX_AC74095AA76ED395` (`user_id`),
  CONSTRAINT `FK_AC74095AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_AC74095A12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;

INSERT INTO `activity` (`id`, `category_id`, `user_id`, `participant_solo`, `participant_duo`, `participant_family`, `participant_friend`, `title`, `address`, `zip`, `city`, `description`, `recording_date`)
VALUES
	(1,6,1,1,1,6,0,'pharetra. Nam ac','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2017-06-16'),
	(2,10,1,1,1,7,1,'ornare, libero at','157 Boulevard Macdonald','75019','Paris','Lorem','2016-06-24'),
	(3,6,1,0,1,1,1,'faucibus orci luctus','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-12-28'),
	(4,4,2,1,1,5,0,'Nunc sollicitudin commodo','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-11-10'),
	(5,2,2,0,0,3,0,'massa. Vestibulum accumsan','157 Boulevard Macdonald','75019','Paris','Lorem','2016-11-07'),
	(6,3,2,1,0,0,1,'nulla. Cras eu','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-03-06'),
	(7,5,2,0,0,2,1,'eu arcu. Morbi','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2016-12-26'),
	(8,4,2,1,0,0,0,'tempus scelerisque, lorem','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2017-11-10'),
	(9,4,2,1,0,8,1,'ac, feugiat non,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2016-07-01'),
	(10,5,1,0,1,4,0,'gravida mauris ut','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-04-11'),
	(11,3,1,1,0,5,1,'luctus aliquet odio.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-07-15'),
	(12,2,1,1,1,0,1,'vitae sodales nisi','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-09-30'),
	(13,4,2,1,1,6,0,'a, scelerisque sed,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2016-04-29'),
	(14,10,1,1,1,2,1,'aliquam, enim nec','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-10-24'),
	(15,10,1,1,1,4,1,'dolor. Quisque tincidunt','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-02-24'),
	(16,6,2,0,1,7,1,'Phasellus in felis.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2017-01-28'),
	(17,9,2,0,0,0,1,'Praesent eu dui.','157 Boulevard Macdonald','75019','Paris','Lorem','2016-06-16'),
	(18,9,1,1,1,3,1,'Nunc mauris. Morbi','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2016-10-23'),
	(19,8,1,0,0,0,1,'sapien. Cras dolor','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2017-08-17'),
	(20,7,2,1,1,1,1,'id enim. Curabitur','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2017-07-07'),
	(21,3,1,1,0,2,0,'enim, sit amet','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-04-15'),
	(22,4,2,1,1,1,1,'Nullam feugiat placerat','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-11-24'),
	(23,3,2,1,1,0,0,'orci quis lectus.','157 Boulevard Macdonald','75019','Paris','Lorem','2017-11-08'),
	(24,6,2,0,1,4,1,'Suspendisse aliquet, sem','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2016-09-14'),
	(25,2,1,1,1,0,0,'Quisque nonummy ipsum','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2017-07-27'),
	(26,2,2,0,0,3,1,'vehicula aliquet libero.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2016-07-06'),
	(27,9,1,1,1,6,0,'auctor vitae, aliquet','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-12-12'),
	(28,3,1,0,1,9,1,'non magna. Nam','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2017-04-22'),
	(29,10,1,1,0,2,1,'ac, feugiat non,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2017-01-28'),
	(30,5,2,1,0,8,1,'Duis volutpat nunc','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-07-18'),
	(31,2,2,1,0,9,0,'odio, auctor vitae,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2017-03-02'),
	(32,3,2,0,1,4,0,'Fusce mollis. Duis','30 rue Pierre Curie','92000','Nanterre','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2017-08-21'),
	(33,6,1,1,0,1,1,'in, cursus et,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-08-13'),
	(34,5,2,0,0,6,0,'pharetra nibh. Aliquam','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2016-10-13'),
	(35,7,1,1,1,6,1,'Suspendisse aliquet molestie','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-01-16'),
	(36,6,1,0,1,1,1,'amet diam eu','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-08-22'),
	(37,6,2,1,1,9,1,'Suspendisse aliquet, sem','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2016-11-10'),
	(38,8,2,1,1,1,0,'quis lectus. Nullam','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2017-06-21'),
	(39,7,2,1,0,1,0,'orci. Ut sagittis','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-12-22'),
	(40,10,2,0,0,0,0,'malesuada. Integer id','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2016-08-17'),
	(41,1,1,1,0,2,0,'Mauris blandit enim','157 Boulevard Macdonald','75019','Paris','Lorem','2017-08-11'),
	(42,7,2,0,1,1,1,'euismod est arcu','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2016-06-26'),
	(43,4,2,0,0,6,0,'faucibus id, libero.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-12-20'),
	(44,6,2,0,1,9,0,'a, aliquet vel,','157 Boulevard Macdonald','75019','Paris','Lorem','2017-12-06'),
	(45,6,1,1,1,6,1,'elit, pellentesque a,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-04-07'),
	(46,2,1,0,0,5,1,'imperdiet non, vestibulum','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2017-04-22'),
	(47,1,2,1,0,1,1,'Ut sagittis lobortis','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2016-08-26'),
	(48,8,1,1,0,8,0,'et, euismod et,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-11-08'),
	(49,2,2,0,0,9,1,'felis purus ac','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-09-16'),
	(50,4,2,1,0,0,0,'metus. In lorem.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-10-25'),
	(51,1,2,0,1,4,0,'adipiscing ligula. Aenean','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-08-19'),
	(52,10,2,0,1,5,1,'scelerisque sed, sapien.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2017-01-07'),
	(53,4,2,0,1,7,1,'lorem ipsum sodales','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-01-15'),
	(54,3,2,0,0,7,0,'nonummy ipsum non','157 Boulevard Macdonald','75019','Paris','Lorem','2017-01-20'),
	(55,7,1,0,0,7,1,'ut, sem. Nulla','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-05-25'),
	(56,1,2,0,1,9,0,'vel, faucibus id,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2016-06-04'),
	(57,8,2,1,0,7,1,'molestie arcu. Sed','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2017-10-27'),
	(58,7,1,1,0,4,0,'sed dui. Fusce','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2016-01-20'),
	(59,6,1,0,1,10,0,'nec, mollis vitae,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-10-01'),
	(60,10,2,1,0,10,1,'Aenean egestas hendrerit','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-01-13'),
	(61,9,1,1,0,6,0,'molestie arcu. Sed','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2016-01-25'),
	(62,4,2,0,0,4,1,'Cras lorem lorem,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2016-11-27'),
	(63,10,1,0,0,4,1,'mus. Proin vel','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-08-28'),
	(64,4,1,0,1,6,1,'Morbi vehicula. Pellentesque','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-02-10'),
	(65,5,1,1,0,6,0,'Curae; Donec tincidunt.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2017-09-14'),
	(66,1,1,0,0,2,1,'posuere, enim nisl','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-04-29'),
	(67,6,2,1,1,9,1,'nec metus facilisis','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur sed','2017-12-24'),
	(68,6,2,0,0,8,1,'Mauris ut quam','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet,','2017-10-04'),
	(69,5,1,1,1,10,0,'faucibus ut, nulla.','157 Boulevard Macdonald','75019','Paris','Lorem','2016-09-11'),
	(70,5,2,0,1,4,1,'in magna. Phasellus','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-11-11'),
	(71,4,1,1,0,5,1,'Nunc mauris sapien,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-06-13'),
	(72,7,2,0,0,1,1,'Duis a mi','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-05-20'),
	(73,3,1,1,0,9,0,'sollicitudin orci sem','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2017-08-03'),
	(74,9,2,1,0,6,1,'vel arcu. Curabitur','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2016-12-29'),
	(75,7,1,1,1,7,0,'sit amet, consectetuer','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-09-18'),
	(76,9,1,0,0,8,0,'tellus non magna.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-09-21'),
	(77,10,1,1,0,2,1,'Nulla eu neque','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-05-08'),
	(78,8,1,0,0,2,1,'vehicula et, rutrum','157 Boulevard Macdonald','75019','Paris','Lorem','2016-07-30'),
	(79,4,2,0,1,8,0,'vehicula et, rutrum','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2018-01-03'),
	(80,2,2,0,0,9,1,'ipsum primis in','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2017-08-01'),
	(81,1,2,0,0,7,1,'Mauris blandit enim','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2016-09-01'),
	(82,1,1,0,1,7,1,'tincidunt orci quis','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-04-19'),
	(83,10,2,0,0,8,1,'ullamcorper eu, euismod','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-03-03'),
	(84,8,1,1,1,3,0,'Nullam nisl. Maecenas','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2016-06-22'),
	(85,4,2,1,1,10,0,'porttitor tellus non','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2016-09-27'),
	(86,1,2,0,1,10,1,'Duis volutpat nunc','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2017-07-24'),
	(87,4,2,0,1,10,1,'Nunc quis arcu','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-10-01'),
	(88,1,2,0,1,5,0,'id, libero. Donec','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Curabitur','2016-12-01'),
	(89,9,2,1,1,9,1,'Aliquam rutrum lorem','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2016-10-16'),
	(90,5,1,1,0,1,0,'semper rutrum. Fusce','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-03-18'),
	(91,7,1,0,1,2,1,'a, malesuada id,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-02-23'),
	(92,5,1,1,0,10,0,'consectetuer euismod est','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2017-12-29'),
	(93,6,2,0,0,8,0,'magna nec quam.','157 Boulevard Macdonald','75019','Paris','Lorem ipsum','2017-08-09'),
	(94,9,1,1,1,5,0,'convallis erat, eget','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2017-07-26'),
	(95,9,1,0,0,1,0,'semper et, lacinia','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing elit.','2016-06-02'),
	(96,6,2,1,0,0,1,'orci, adipiscing non,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-04-20'),
	(97,7,2,1,0,3,1,'felis. Donec tempor,','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor','2017-11-17'),
	(98,7,1,0,1,7,0,'mi felis, adipiscing','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer adipiscing','2016-03-28'),
	(99,9,1,0,1,1,1,'ac ipsum. Phasellus','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit amet, consectetuer','2017-03-30'),
	(100,2,1,1,0,7,0,'ac libero nec','157 Boulevard Macdonald','75019','Paris','Lorem ipsum dolor sit','2017-04-18');

/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table bookmark
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookmark`;

CREATE TABLE `bookmark` (
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`activity_id`),
  KEY `IDX_DA62921DA76ED395` (`user_id`),
  KEY `IDX_DA62921D81C06096` (`activity_id`),
  CONSTRAINT `FK_DA62921D81C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  CONSTRAINT `FK_DA62921DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `name`, `description`, `photo`)
VALUES
	(1,'Sorties','urna suscipit nonummy. Fusce fermentum fermentum',''),
	(2,'Sport','Phasellus at augue id ante dictum cursus.',''),
	(3,'Cinema','Curae; Phasellus ornare. Fusce mollis.',''),
	(4,'Theâtre','a nunc. In',''),
	(5,'Randonnée','risus. Nunc',''),
	(6,'Gastronomie','sit amet ante. Vivamus non lorem vitae odio sagittis semper. Nam tempor',''),
	(7,'Decouvertes','Phasellus elit pede, malesuada vel, venenatis vel, faucibus id, libero. Donec consectetuer mauris id sapien.',''),
	(8,'Nature','Curabitur massa. Vestibulum accumsan neque et nunc. Quisque ornare',''),
	(9,'Musée','lacus. Quisque imperdiet, erat',''),
	(10,'Jeux','risus. Morbi metus. Vivamus euismod urna. Nullam lobortis quam','');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL,
  `note` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C81C06096` (`activity_id`),
  CONSTRAINT `FK_9474526C81C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;

INSERT INTO `comment` (`id`, `user_id`, `activity_id`, `comment`, `note`, `date`)
VALUES
	(3,2,8,'dsfsdfdsfscqcqc',3,'2017-01-08'),
	(4,1,8,'bonne actvité ',3,'2017-01-08'),
	(7,1,4,'bonne actvité  je recommande ',4,'2017-01-08'),
	(8,1,4,'bonne actvité  je recommande \na faire absolument ',4,'2017-01-08'),
	(9,1,4,'dzdzdz',4,'2017-01-08'),
	(10,1,4,'dzdzdz',4,'2017-01-08'),
	(11,1,4,'dzdzdz',4,'2017-01-08'),
	(12,1,4,'dzdzdz',4,'2017-01-08'),
	(13,1,4,'dzdzdz',4,'2017-01-08'),
	(14,3,4,'Faux plan',1,'2017-01-08'),
	(15,3,4,'Faux plan',1,'2017-01-08'),
	(16,3,4,'Faux plan',1,'2017-01-08'),
	(17,3,4,'Faux plan',1,'2017-01-08'),
	(18,3,4,'bon plan',5,'2017-01-08'),
	(19,3,4,'bon plan',5,'2017-01-08'),
	(20,3,4,'bon plan',5,'2017-01-08'),
	(21,1,47,'tres bon plan',5,'2017-01-09'),
	(22,3,47,'qsdsqdqs',2,'2017-01-09'),
	(23,3,32,'sdsqdsdqsdqsd',3,'0000-00-00');

/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customer
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `birthdate` date NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `register_date` date NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_81398E09E7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table detail_reservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `detail_reservation`;

CREATE TABLE `detail_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_product` int(11) DEFAULT NULL,
  `id_reservation` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `id_product_attribute` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2DC32404DD7ADDD` (`id_product`),
  KEY `IDX_2DC324045ADA84A2` (`id_reservation`),
  KEY `IDX_2DC3240465ED3161` (`id_product_attribute`),
  CONSTRAINT `FK_2DC324045ADA84A2` FOREIGN KEY (`id_reservation`) REFERENCES `reservation` (`id`),
  CONSTRAINT `FK_2DC3240465ED3161` FOREIGN KEY (`id_product_attribute`) REFERENCES `product_attribute` (`id`),
  CONSTRAINT `FK_2DC32404DD7ADDD` FOREIGN KEY (`id_product`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `detail_reservation` WRITE;
/*!40000 ALTER TABLE `detail_reservation` DISABLE KEYS */;

INSERT INTO `detail_reservation` (`id`, `id_product`, `id_reservation`, `quantity`, `id_product_attribute`)
VALUES
	(19,4,26,1,NULL),
	(20,66,26,1,NULL),
	(21,4,27,1,NULL),
	(22,66,27,1,NULL),
	(23,4,28,1,NULL),
	(24,66,28,1,NULL),
	(25,33,29,1,175),
	(26,64,29,1,77),
	(27,33,29,1,175),
	(28,39,30,1,NULL),
	(29,4,31,1,16);

/*!40000 ALTER TABLE `detail_reservation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table hobby
# ------------------------------------------------------------

DROP TABLE IF EXISTS `hobby`;

CREATE TABLE `hobby` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_category` int(11) DEFAULT NULL,
  `note` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `search_idx` (`id_user`,`id_category`),
  KEY `IDX_3964F3376B3CA4B` (`id_user`),
  KEY `IDX_3964F3375697F554` (`id_category`),
  CONSTRAINT `FK_3964F3375697F554` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_3964F3376B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `hobby` WRITE;
/*!40000 ALTER TABLE `hobby` DISABLE KEYS */;

INSERT INTO `hobby` (`id`, `id_user`, `id_category`, `note`)
VALUES
	(2,1,2,2);

/*!40000 ALTER TABLE `hobby` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table partner
# ------------------------------------------------------------

DROP TABLE IF EXISTS `partner`;

CREATE TABLE `partner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `pseudo` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `commercial_registry` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_312B3E16E7927C74` (`email`),
  UNIQUE KEY `UNIQ_312B3E1671AC0F4B` (`commercial_registry`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table photo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `photo`;

CREATE TABLE `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_14B7841881C06096` (`activity_id`),
  CONSTRAINT `FK_14B7841881C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD81C06096` (`activity_id`),
  CONSTRAINT `FK_D34A04AD81C06096` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `activity_id`, `stock`, `price`, `date`)
VALUES
	(1,61,19,140,'2016-01-09 00:00:00'),
	(2,76,20,138,'2016-05-13 00:00:00'),
	(3,69,10,69,'2016-11-24 00:00:00'),
	(4,47,12,110,'2016-07-13 00:00:00'),
	(5,6,15,110,'2017-10-17 00:00:00'),
	(6,52,20,142,'2017-09-15 00:00:00'),
	(7,96,30,129,'2017-01-30 00:00:00'),
	(8,17,14,148,'2017-05-09 00:00:00'),
	(9,32,27,54,'2016-05-27 00:00:00'),
	(10,35,29,120,'2016-09-14 00:00:00'),
	(11,53,16,101,'2017-09-27 00:00:00'),
	(12,34,24,116,'2017-05-19 00:00:00'),
	(13,84,22,28,'2017-08-12 00:00:00'),
	(14,25,27,22,'2017-04-29 00:00:00'),
	(15,47,20,33,'2017-07-21 00:00:00'),
	(16,65,30,60,'2017-03-06 00:00:00'),
	(17,84,12,146,'2017-11-30 00:00:00'),
	(18,45,28,77,'2016-02-18 00:00:00'),
	(19,19,13,91,'2016-09-24 00:00:00'),
	(20,31,18,81,'2017-05-28 00:00:00'),
	(21,59,29,141,'2017-02-21 00:00:00'),
	(22,95,18,102,'2016-08-17 00:00:00'),
	(23,30,10,106,'2017-09-02 00:00:00'),
	(24,48,29,77,'2016-04-14 00:00:00'),
	(25,62,20,49,'2017-08-31 00:00:00'),
	(26,52,18,52,'2016-06-09 00:00:00'),
	(27,92,23,117,'2016-04-16 00:00:00'),
	(28,91,30,110,'2018-01-04 00:00:00'),
	(29,64,23,115,'2016-01-05 00:00:00'),
	(30,8,22,113,'2017-10-05 00:00:00'),
	(31,79,22,60,'2017-11-04 00:00:00'),
	(32,2,26,15,'2016-05-30 00:00:00'),
	(33,33,28,56,'2017-08-05 00:00:00'),
	(34,79,22,68,'2016-10-02 00:00:00'),
	(35,26,11,107,'2017-09-21 00:00:00'),
	(36,46,22,37,'2017-08-09 00:00:00'),
	(37,44,20,109,'2016-10-19 00:00:00'),
	(38,40,20,96,'2016-08-15 00:00:00'),
	(39,73,23,67,'2017-10-17 00:00:00'),
	(40,67,27,87,'2016-12-22 00:00:00'),
	(41,25,25,24,'2016-02-03 00:00:00'),
	(42,12,29,34,'2017-06-23 00:00:00'),
	(43,43,27,119,'2017-05-10 00:00:00'),
	(44,87,14,18,'2016-03-04 00:00:00'),
	(45,37,19,78,'2016-04-23 00:00:00'),
	(46,58,11,87,'2017-03-16 00:00:00'),
	(47,17,14,57,'2016-09-18 00:00:00'),
	(48,18,21,18,'2016-09-03 00:00:00'),
	(49,42,12,93,'2017-03-25 00:00:00'),
	(50,91,30,98,'2017-11-16 00:00:00'),
	(51,72,23,69,'2017-11-09 00:00:00'),
	(52,92,16,42,'2016-12-14 00:00:00'),
	(53,53,21,64,'2016-10-18 00:00:00'),
	(54,65,22,75,'2016-07-08 00:00:00'),
	(55,8,17,123,'2017-01-25 00:00:00'),
	(56,88,26,112,'2016-09-20 00:00:00'),
	(57,6,17,81,'2016-08-17 00:00:00'),
	(58,52,28,19,'2017-09-06 00:00:00'),
	(59,88,26,13,'2016-02-13 00:00:00'),
	(60,40,13,143,'2017-07-24 00:00:00'),
	(61,71,30,68,'2016-05-31 00:00:00'),
	(62,74,26,92,'2017-09-06 00:00:00'),
	(63,43,14,87,'2016-03-27 00:00:00'),
	(64,33,16,81,'2016-07-26 00:00:00'),
	(65,91,10,133,'2016-06-28 00:00:00'),
	(66,30,10,69,'2017-12-21 00:00:00'),
	(67,59,27,130,'2017-06-29 00:00:00'),
	(68,67,21,53,'2017-10-27 00:00:00'),
	(69,96,27,87,'2016-05-14 00:00:00'),
	(70,42,24,21,'2016-01-29 00:00:00'),
	(71,90,19,56,'2016-03-19 00:00:00'),
	(72,15,24,64,'2016-12-04 00:00:00'),
	(73,91,21,130,'2016-04-13 00:00:00'),
	(74,68,27,116,'2017-04-01 00:00:00'),
	(75,22,17,89,'2017-10-11 00:00:00'),
	(76,40,30,130,'2017-02-28 00:00:00'),
	(77,29,23,14,'2016-03-10 00:00:00'),
	(78,33,28,80,'2016-12-31 00:00:00'),
	(79,18,27,42,'2016-10-11 00:00:00'),
	(80,40,25,74,'2017-05-21 00:00:00'),
	(81,84,11,74,'2017-12-25 00:00:00'),
	(82,23,24,14,'2016-12-06 00:00:00'),
	(83,62,23,53,'2016-10-24 00:00:00'),
	(84,66,28,46,'2016-04-24 00:00:00'),
	(85,56,15,32,'2017-07-21 00:00:00'),
	(86,47,22,148,'2016-10-03 00:00:00'),
	(87,100,30,132,'2016-01-06 00:00:00'),
	(88,97,30,148,'2017-06-01 00:00:00'),
	(89,91,25,111,'2017-01-04 00:00:00'),
	(90,62,23,43,'2017-12-19 00:00:00'),
	(91,14,14,28,'2017-09-29 00:00:00'),
	(92,45,12,128,'2017-01-17 00:00:00'),
	(93,18,21,97,'2017-05-20 00:00:00'),
	(94,26,28,116,'2016-10-22 00:00:00'),
	(95,2,24,145,'2017-03-17 00:00:00'),
	(96,76,25,138,'2017-11-15 00:00:00'),
	(97,23,23,40,'2017-09-04 00:00:00'),
	(98,52,15,91,'2016-07-18 00:00:00'),
	(99,97,16,62,'2017-09-04 00:00:00'),
	(100,8,18,18,'2016-11-16 00:00:00');

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_attribute
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_attribute`;

CREATE TABLE `product_attribute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extra_fee` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_94DA59764584665A` (`product_id`),
  CONSTRAINT `FK_94DA59764584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `product_attribute` WRITE;
/*!40000 ALTER TABLE `product_attribute` DISABLE KEYS */;

INSERT INTO `product_attribute` (`id`, `product_id`, `name`, `value`, `extra_fee`)
VALUES
	(1,1,'et, eros. Proin ultrices. Duis','interdum. Curabitur',151),
	(2,1,'tincidunt dui augue eu','nec, euismod in, dolor. Fusce',177),
	(3,1,'dictum','vulputate,',109),
	(4,1,'Cum sociis','pharetra sed, hendrerit',163),
	(5,3,'pede, ultrices a, auctor non,','mauris eu',131),
	(6,1,'montes, nascetur ridiculus mus. Donec','adipiscing ligula.',145),
	(7,1,'urna suscipit nonummy. Fusce','vitae,',146),
	(8,1,'tincidunt, nunc','eros nec tellus. Nunc lectus',70),
	(9,6,'Aenean eget','augue',17),
	(10,1,'sociis','posuere,',44),
	(11,1,'molestie tortor nibh','ante.',131),
	(12,2,'Aenean gravida nunc sed','dignissim tempor arcu.',186),
	(13,9,'nulla. Integer','arcu. Vivamus',151),
	(14,1,'Aenean','sem, vitae aliquam eros',163),
	(15,8,'semper cursus.','vitae, aliquet nec, imperdiet',76),
	(16,4,'Lorem ipsum dolor sit amet,','Etiam laoreet, libero',19),
	(17,1,'Donec tincidunt. Donec','sed, sapien. Nunc pulvinar arcu',118),
	(18,15,'non, lacinia at, iaculis quis,','posuere vulputate, lacus. Cras',8),
	(19,4,'bibendum','eget mollis',69),
	(20,18,'lacus. Etiam','dis',131),
	(21,15,'ad litora','malesuada id,',93),
	(22,9,'eleifend. Cras sed leo. Cras','mus.',122),
	(23,8,'et, euismod et, commodo at,','dui,',31),
	(24,10,'nulla','Cras',133),
	(25,24,'ornare lectus justo eu','nec, cursus',186),
	(26,24,'Vivamus nibh dolor,','quam quis diam.',183),
	(27,3,'et, rutrum non, hendrerit','libero',128),
	(28,3,'Etiam gravida molestie arcu. Sed','vulputate mauris sagittis placerat.',146),
	(29,6,'Maecenas','nec ante. Maecenas mi felis,',136),
	(30,19,'nec metus facilisis','ipsum. Suspendisse',129),
	(31,2,'massa lobortis ultrices.','enim. Sed',135),
	(32,25,'orci lacus vestibulum lorem,','vehicula et, rutrum eu, ultrices',140),
	(33,1,'Curabitur dictum. Phasellus in','et tristique pellentesque, tellus',138),
	(34,24,'sodales. Mauris blandit enim consequat','mi eleifend egestas.',81),
	(35,2,'Lorem ipsum dolor sit amet,','turpis vitae purus gravida',97),
	(36,26,'rutrum non, hendrerit','libero mauris, aliquam',78),
	(37,5,'aliquam eros turpis','egestas a,',5),
	(38,7,'lorem vitae','accumsan',121),
	(39,34,'pede et risus.','nec',116),
	(40,16,'cursus. Nunc mauris elit,','ac',5),
	(41,35,'interdum','Quisque ornare',186),
	(42,29,'dolor. Quisque tincidunt pede','Quisque',181),
	(43,25,'dui quis accumsan convallis, ante','eu neque',11),
	(44,40,'Sed','et magnis dis',87),
	(45,9,'Vivamus non lorem vitae','lectus pede,',190),
	(46,44,'ut cursus luctus, ipsum','tristique pharetra. Quisque ac',155),
	(47,45,'eu turpis. Nulla','erat semper',183),
	(48,43,'Curabitur ut odio vel est','rhoncus. Nullam velit',60),
	(49,6,'vehicula','viverra. Donec tempus, lorem fringilla',78),
	(50,4,'ac mattis','montes,',28),
	(51,23,'rutrum lorem ac risus. Morbi','Proin non massa',160),
	(52,2,'rhoncus id, mollis nec, cursus','Quisque ornare tortor at risus.',152),
	(53,14,'luctus ut, pellentesque eget, dictum','nascetur ridiculus mus.',55),
	(54,29,'ac risus. Morbi','massa. Vestibulum accumsan neque',66),
	(55,2,'neque non','pede. Suspendisse dui.',87),
	(56,53,'fringilla cursus','eget,',200),
	(57,43,'elit fermentum risus, at fringilla','penatibus',189),
	(58,53,'id,','tellus',87),
	(59,32,'nec tempus scelerisque, lorem','velit egestas lacinia. Sed',150),
	(60,7,'natoque penatibus et magnis dis','et magnis dis parturient',99),
	(61,17,'consequat nec,','Nunc mauris. Morbi non',83),
	(62,1,'neque','vel arcu.',106),
	(63,61,'fringilla, porttitor vulputate, posuere','accumsan convallis,',82),
	(64,26,'nulla','pede blandit congue.',93),
	(65,61,'ligula consectetuer rhoncus.','non',123),
	(66,46,'ut nisi a odio','nisi dictum augue malesuada',10),
	(67,60,'amet','nisi. Mauris nulla. Integer',85),
	(68,6,'Quisque','accumsan neque et nunc. Quisque',127),
	(69,53,'pede blandit congue. In','sit amet, faucibus ut,',158),
	(70,16,'nec','diam dictum sapien. Aenean massa.',106),
	(71,38,'sed turpis nec mauris blandit','Nulla eu',54),
	(72,9,'fringilla','pretium',188),
	(73,42,'Curae;','id,',166),
	(74,70,'Donec elementum,','nec',152),
	(75,51,'dui. Suspendisse ac','est, vitae sodales nisi',155),
	(76,16,'ornare, libero at auctor ullamcorper,','urna. Nullam lobortis quam a',6),
	(77,64,'at pretium aliquet,','porttitor vulputate, posuere vulputate,',145),
	(78,60,'elementum at,','dolor sit',179),
	(79,19,'sed','Praesent eu',50),
	(80,21,'Curabitur ut odio','malesuada malesuada. Integer',47),
	(81,16,'sem,','dictum mi, ac mattis',55),
	(82,9,'dictum','cursus et, eros.',173),
	(83,10,'lacus. Ut nec urna et','gravida',153),
	(84,75,'mauris sit amet lorem','non,',189),
	(85,65,'parturient montes, nascetur','gravida sit amet, dapibus id,',16),
	(86,10,'nibh. Aliquam ornare,','vel est tempor bibendum.',58),
	(87,76,'consectetuer adipiscing elit.','velit egestas lacinia.',44),
	(88,63,'In nec','enim. Etiam imperdiet dictum magna.',141),
	(89,41,'cursus non, egestas','vitae erat vel',12),
	(90,9,'ornare tortor at risus.','sapien. Aenean massa.',6),
	(91,76,'Integer vitae nibh. Donec','enim. Sed nulla',191),
	(92,6,'gravida sagittis. Duis gravida.','sem, consequat nec,',128),
	(93,19,'molestie dapibus ligula. Aliquam','ultrices',39),
	(94,9,'primis in','tellus lorem eu',133),
	(95,68,'eu','id, blandit',47),
	(96,76,'libero','porta elit, a feugiat',129),
	(97,93,'elit sed','a, enim. Suspendisse aliquet, sem',17),
	(98,64,'adipiscing elit. Curabitur sed tortor.','magna. Ut',110),
	(99,59,'lobortis. Class aptent taciti sociosqu','egestas hendrerit neque.',60),
	(100,60,'eget varius','nisi dictum augue',172),
	(101,23,'parturient','Nam ligula elit,',24),
	(102,62,'felis ullamcorper viverra.','cursus',7),
	(103,19,'Quisque tincidunt pede','ornare placerat, orci',32),
	(104,1,'sit amet ante.','et ipsum cursus',127),
	(105,87,'Sed','Morbi quis',87),
	(106,23,'ut erat. Sed','eu eros. Nam consequat',153),
	(107,73,'mattis velit justo','nisi magna sed',116),
	(108,1,'orci sem eget','mollis',168),
	(109,13,'dictum mi, ac mattis velit','mollis lectus pede',20),
	(110,47,'feugiat.','sodales. Mauris blandit enim consequat',41),
	(111,3,'magna a neque. Nullam ut','ac, feugiat non,',174),
	(112,6,'egestas a, scelerisque sed,','Nam interdum',64),
	(113,2,'Donec','porttitor tellus non magna.',64),
	(114,86,'lectus pede,','eros. Nam consequat',7),
	(115,39,'aliquam eros turpis','erat volutpat.',194),
	(116,59,'erat vitae risus.','malesuada fames ac turpis egestas.',71),
	(117,12,'tincidunt aliquam arcu. Aliquam ultrices','rutrum lorem ac risus. Morbi',120),
	(118,10,'ipsum leo elementum','turpis egestas. Aliquam fringilla cursus',193),
	(119,64,'cursus vestibulum. Mauris','rhoncus.',181),
	(120,54,'convallis ligula. Donec luctus','sagittis.',108),
	(121,49,'consequat nec, mollis vitae,','vulputate ullamcorper magna.',74),
	(122,1,'ac ipsum. Phasellus vitae mauris','in',195),
	(123,29,'varius ultrices, mauris ipsum porta','arcu. Morbi sit',161),
	(124,71,'Sed dictum. Proin eget odio.','Nunc mauris. Morbi non sapien',90),
	(125,89,'a, auctor','convallis ligula. Donec luctus aliquet',62),
	(126,89,'lectus pede, ultrices a,','vehicula',80),
	(127,32,'ut quam vel sapien','metus. Aliquam erat',181),
	(128,45,'parturient montes, nascetur ridiculus','quis, pede.',127),
	(129,16,'neque','risus. In mi',186),
	(130,4,'a, magna. Lorem ipsum dolor','dictum sapien.',162),
	(131,8,'sodales nisi','eu',87),
	(132,57,'ut dolor dapibus gravida. Aliquam','eros non enim',103),
	(133,60,'neque tellus, imperdiet','Nulla dignissim. Maecenas ornare egestas',96),
	(134,58,'id sapien. Cras dolor dolor,','quis accumsan',160),
	(135,72,'non, vestibulum','nostra, per inceptos hymenaeos.',48),
	(136,94,'urna justo faucibus','risus varius',38),
	(137,2,'velit. Aliquam nisl. Nulla eu','sapien. Nunc pulvinar',160),
	(138,96,'Fusce fermentum fermentum arcu. Vestibulum','auctor odio a',135),
	(139,46,'interdum enim non nisi. Aenean','ante lectus',135),
	(140,89,'a,','risus. Donec nibh enim,',70),
	(141,28,'Mauris blandit enim','magna. Phasellus dolor elit, pellentesque',100),
	(142,100,'ipsum ac mi eleifend','at,',46),
	(143,37,'Proin vel','Aliquam erat volutpat. Nulla facilisis.',62),
	(144,25,'magna. Lorem ipsum dolor sit','Sed',159),
	(145,88,'lectus convallis','eros. Nam',157),
	(146,7,'vel,','libero',183),
	(147,34,'mi enim, condimentum eget, volutpat','aliquet diam. Sed diam',77),
	(148,54,'quam. Pellentesque habitant morbi','aliquet nec, imperdiet nec, leo.',131),
	(149,72,'odio tristique','nisl sem, consequat nec, mollis',46),
	(150,100,'et ipsum cursus vestibulum. Mauris','id, erat. Etiam',59),
	(151,26,'blandit at, nisi. Cum sociis','nec quam. Curabitur vel',135),
	(152,47,'semper rutrum. Fusce dolor','eros. Nam consequat',132),
	(153,46,'gravida.','Pellentesque habitant morbi tristique senectus',122),
	(154,91,'Proin vel nisl. Quisque fringilla','enim. Nunc',88),
	(155,13,'non leo. Vivamus nibh','lorem, sit amet',21),
	(156,98,'orci lacus','egestas',5),
	(157,85,'odio a','turpis egestas. Aliquam',53),
	(158,44,'lacus. Mauris','aliquet, sem',109),
	(159,1,'auctor. Mauris','Suspendisse',112),
	(160,37,'consequat','Suspendisse tristique neque',65),
	(161,51,'sit amet massa. Quisque','lacus. Mauris non dui',77),
	(162,23,'erat. Etiam vestibulum massa rutrum','tincidunt, neque vitae semper',95),
	(163,69,'mollis. Integer tincidunt aliquam arcu.','Mauris non dui nec',180),
	(164,16,'nibh. Donec','ultrices. Vivamus rhoncus. Donec',108),
	(165,48,'tellus, imperdiet','malesuada fringilla est. Mauris',133),
	(166,3,'diam dictum sapien.','erat, in consectetuer ipsum nunc',7),
	(167,26,'Nunc laoreet','ornare, facilisis eget, ipsum. Donec',44),
	(168,17,'sem. Nulla','scelerisque sed, sapien. Nunc pulvinar',156),
	(169,35,'fringilla','erat vitae risus. Duis a',103),
	(170,41,'Nulla dignissim. Maecenas','metus. Vivamus euismod urna. Nullam',152),
	(171,20,'leo. Morbi neque tellus,','sem egestas blandit. Nam nulla',156),
	(172,50,'vestibulum nec, euismod in,','sagittis augue,',115),
	(173,48,'luctus felis purus','lorem,',87),
	(174,20,'tellus','interdum. Nunc sollicitudin commodo ipsum.',91),
	(175,33,'ipsum. Donec','nulla. Integer urna. Vivamus molestie',7),
	(176,68,'id, libero. Donec','Curabitur massa. Vestibulum accumsan',51),
	(177,54,'faucibus lectus, a sollicitudin','Donec vitae erat vel',55),
	(178,33,'auctor. Mauris','velit eu sem. Pellentesque ut',51),
	(179,54,'mollis vitae, posuere','Sed et libero.',48),
	(180,67,'justo faucibus','molestie pharetra',174),
	(181,29,'placerat','et libero. Proin mi. Aliquam',76),
	(182,31,'blandit viverra. Donec','eleifend vitae, erat. Vivamus nisi.',46),
	(183,5,'mattis semper,','Suspendisse',149),
	(184,55,'enim. Curabitur','mattis semper, dui lectus',105),
	(185,12,'amet, dapibus','nunc. In at pede.',60),
	(186,72,'Cum sociis','aliquam arcu. Aliquam ultrices iaculis',171),
	(187,66,'consectetuer adipiscing elit.','Duis gravida. Praesent',34),
	(188,35,'dis parturient','imperdiet,',83),
	(189,28,'inceptos hymenaeos. Mauris','Sed nunc est,',41),
	(190,6,'augue ut lacus. Nulla','consequat dolor vitae dolor.',7),
	(191,68,'at fringilla purus mauris','Cras eu',154),
	(192,94,'augue malesuada malesuada.','nunc risus',177),
	(193,96,'cursus, diam at pretium','euismod ac,',144),
	(194,26,'orci quis lectus. Nullam suscipit,','eget',76),
	(195,19,'cursus et,','lectus',187),
	(196,35,'viverra. Donec','leo,',70),
	(197,62,'rutrum urna, nec luctus','eu',95),
	(198,22,'erat neque non quam. Pellentesque','aliquet odio.',125),
	(199,91,'lorem, vehicula et,','eu,',67),
	(200,56,'sed leo.','ut eros',163);

/*!40000 ALTER TABLE `product_attribute` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table reservation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `reservation`;

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C849556B3CA4B` (`id_user`),
  CONSTRAINT `FK_42C849556B3CA4B` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;

INSERT INTO `reservation` (`id`, `id_user`, `date`)
VALUES
	(26,1,'2017-01-07'),
	(27,1,'2017-01-07'),
	(28,1,'2017-01-07'),
	(29,3,'2017-01-08'),
	(30,3,'2017-01-08'),
	(31,1,'2017-01-09');

/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `gender` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `commercial_registry` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthdate` datetime NOT NULL,
  `role` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `register_date` datetime NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D64971AC0F4B` (`commercial_registry`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`, `gender`, `firstname`, `address`, `lastname`, `company`, `commercial_registry`, `zip`, `city`, `birthdate`, `role`, `register_date`, `photo`)
VALUES
	(1,'dia42r','dia42r','dia42r@gmail.com','dia42r@gmail.com',1,NULL,'$2y$13$Mab20BWPdYdo/ouzm5sD6ekH7FvpmYAIWJ6DbHBAAXbiWbayRJhYG','2017-01-09 11:36:50',NULL,NULL,'a:0:{}','M','Diarra','30 rue Pierre Cure','Abdoul',NULL,NULL,'92000','Nanterre','2012-01-01 00:00:00','ROLE_PARTNER','2017-01-04 18:02:51',''),
	(2,'webroad','webroad','contact@webroad.fr','contact@webroad.fr',1,NULL,'$2y$13$BaLtWRrELHZ.aXJ0ICp4NuFWWgvoIVOch90sgqWuEN/OnT1nCO7CS','2017-01-05 00:41:41',NULL,NULL,'a:0:{}','M','Abdoul','12 rue de Picardie','Diarra',NULL,NULL,'95310','SOLA','2012-01-01 00:00:00','ROLE_ADMIN','2017-01-04 23:24:17',''),
	(3,'webroad2','webroad2','abdoul@webroad.fr','abdoul@webroad.fr',1,NULL,'$2y$13$UvFxsQAO.RzjVl/dThNdOuXfnYH9DYxiLsSHudINzI7PZ0hqUMTiy','2017-01-09 12:33:45',NULL,NULL,'a:0:{}','M','De souza','12 rue de Picardie','Clement','Webroad',NULL,'95310','SOLA','2013-01-01 00:00:00','ROLE_PARTNER','2017-01-07 23:09:57',NULL),
	(4,'def','def','diei@ds.fr','diei@ds.fr',1,NULL,'$2y$13$2JxVWe2YqDoMlo5avhkqnODAIP9lSW7SS661DJy/qfhzdyo0l1Asm','2017-01-09 16:46:35',NULL,NULL,'a:0:{}','MME','dzdz','efzfdzfz','zdzdzd','zdzdz',NULL,'89000','SOLA','2012-01-01 00:00:00','ROLE_PARTNER','2017-01-09 16:46:32',NULL),
	(5,'fdezfe','fdezfe','zerzer@df.fr','zerzer@df.fr',1,NULL,'$2y$13$RTveKh9rcg3vIxiBgtLWd.wPy11.EccqlY2WOiQQWLeYfOHL.EKHy','2017-01-09 16:49:41',NULL,NULL,'a:0:{}','M','fzefzef','fezfzef','ezfezfez','fezfze','124677888','90009','efezfzef','2012-01-01 00:00:00','ROLE_PARTNER','2017-01-09 16:49:38',NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
