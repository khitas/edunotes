# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.14)
# Database: mynotes
# Generation Time: 2017-02-07 10:02:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table fonts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `fonts`;

CREATE TABLE `fonts` (
  `font_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`font_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `fonts` WRITE;
/*!40000 ALTER TABLE `fonts` DISABLE KEYS */;

INSERT INTO `fonts` (`font_id`, `name`)
VALUES
	(1,'MusiQwik.ttf'),
	(2,'MusiQwik-Bold.ttf');

/*!40000 ALTER TABLE `fonts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lesson_notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lesson_notes`;

CREATE TABLE `lesson_notes` (
  `lesson_note_id` int(11) NOT NULL AUTO_INCREMENT,
  `lesson_id` int(11) DEFAULT NULL,
  `note_id` int(11) DEFAULT NULL,
  `note_type_id` int(11) DEFAULT NULL,
  `answer_note_type_id` int(11) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `secs_to_solve` float DEFAULT NULL,
  `secs_to_find` float DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  PRIMARY KEY (`lesson_note_id`),
  KEY `fk_lesson_notes_lessons1_idx` (`lesson_id`),
  KEY `fk_lesson_notes_note_types1_idx` (`note_type_id`),
  KEY `fk_lesson_notes_note_types2_idx` (`answer_note_type_id`),
  KEY `fk_lesson_notes_notes1_idx` (`note_id`),
  CONSTRAINT `fk_lesson_notes_lessons1` FOREIGN KEY (`lesson_id`) REFERENCES `lessons` (`lesson_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_lesson_notes_notes1` FOREIGN KEY (`note_id`) REFERENCES `notes` (`note_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lesson_notes_note_types1` FOREIGN KEY (`note_type_id`) REFERENCES `note_types` (`note_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lesson_notes_note_types2` FOREIGN KEY (`answer_note_type_id`) REFERENCES `note_types` (`note_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lesson_notes` WRITE;
/*!40000 ALTER TABLE `lesson_notes` DISABLE KEYS */;

INSERT INTO `lesson_notes` (`lesson_note_id`, `lesson_id`, `note_id`, `note_type_id`, `answer_note_type_id`, `start_at`, `secs_to_solve`, `secs_to_find`, `score`)
VALUES
	(2,64,27,3,NULL,'2015-11-26 19:52:35',10,NULL,NULL),
	(3,65,7,3,3,'2015-11-26 19:56:32',10,1,1),
	(4,65,10,6,6,'2015-11-26 19:56:39',10,1,1),
	(5,65,8,4,4,'2015-11-26 19:56:43',10,1,1),
	(6,65,99,4,4,'2015-11-26 19:56:46',10,1,1),
	(7,65,11,7,7,'2015-11-26 19:56:52',10,1,1),
	(8,65,48,3,3,'2015-11-26 19:56:56',10,1,1),
	(9,65,15,4,4,'2015-11-26 19:56:59',10,1,1),
	(10,65,15,4,4,'2015-11-26 19:57:02',10,1,1),
	(11,65,50,5,5,'2015-11-26 19:57:04',10,1,1),
	(12,65,49,4,4,'2015-11-26 19:57:08',10,1,1),
	(13,65,49,4,4,'2015-11-26 19:57:12',10,1,1),
	(14,65,78,4,4,'2015-11-26 19:57:16',10,1,1),
	(15,65,31,7,7,'2015-11-26 19:57:19',10,1,1),
	(16,65,36,4,4,'2015-11-26 19:57:22',10,1,1),
	(17,65,95,7,7,'2015-11-26 19:57:25',10,1,1),
	(18,65,73,7,7,'2015-11-26 19:57:27',10,1,1),
	(19,65,76,2,5,'2015-11-26 19:57:30',10,1,0),
	(20,65,78,4,4,'2015-11-26 19:57:33',10,1,1),
	(21,65,53,7,7,'2015-11-26 19:57:37',10,1,1),
	(22,65,97,2,2,'2015-11-26 19:57:40',10,1,1),
	(23,65,72,6,6,'2015-11-26 19:57:45',10,1,1),
	(24,65,11,7,7,'2015-11-26 19:57:49',10,1,1),
	(25,65,28,4,4,'2015-11-26 19:57:53',10,1,1),
	(26,65,52,7,7,'2015-11-26 19:57:59',10,1,1),
	(27,65,36,4,4,'2015-11-26 19:58:02',10,1,1),
	(28,65,7,3,3,'2015-11-26 19:58:04',10,1,1),
	(29,65,33,1,1,'2015-11-26 19:58:06',10,1,1),
	(30,65,96,1,1,'2015-11-26 19:58:12',10,1,1),
	(31,65,28,4,4,'2015-11-26 19:58:15',10,1,1),
	(32,65,78,4,4,'2015-11-26 19:58:17',10,1,1),
	(33,65,71,5,5,'2015-11-26 19:58:19',10,1,1),
	(34,65,9,5,5,'2015-11-26 19:58:24',10,1,1),
	(35,65,54,1,1,'2015-11-26 19:58:26',10,1,1),
	(36,65,52,7,7,'2015-11-26 19:58:30',10,1,1),
	(37,65,10,6,6,'2015-11-26 19:58:32',10,1,1),
	(38,65,70,4,4,'2015-11-26 19:58:36',10,1,1),
	(39,65,99,4,4,'2015-11-26 19:58:39',10,1,1),
	(40,65,55,2,2,'2015-11-26 19:58:41',10,1,1),
	(41,65,30,6,6,'2015-11-26 19:58:49',10,1,1),
	(42,65,90,3,3,'2015-11-26 19:58:53',10,1,1),
	(43,65,10,6,6,'2015-11-26 19:58:56',10,1,1),
	(44,65,96,1,1,'2015-11-26 19:59:03',10,1,1),
	(45,65,10,6,6,'2015-11-26 19:59:07',10,1,1),
	(46,65,98,3,6,'2015-11-26 19:59:12',10,1,0),
	(47,65,56,3,3,'2015-11-26 19:59:15',10,1,1),
	(48,65,31,7,7,'2015-11-26 19:59:24',10,1,1),
	(49,65,74,7,7,'2015-11-26 19:59:27',10,1,1),
	(50,65,90,3,3,'2015-11-26 19:59:33',10,1,1),
	(51,65,56,3,3,'2015-11-26 19:59:37',10,1,1),
	(52,65,14,3,3,'2015-11-26 19:59:58',10,1,1),
	(53,65,50,5,5,'2015-11-26 20:00:00',10,1,1),
	(54,65,93,6,6,'2015-11-26 20:00:07',10,1,1),
	(55,65,9,5,6,'2015-11-26 20:00:10',10,1,0),
	(56,65,14,3,3,'2015-11-26 20:00:13',10,1,1),
	(57,65,12,1,1,'2015-11-26 20:00:17',10,1,1),
	(58,65,29,5,5,'2015-11-26 20:00:21',10,1,1),
	(59,65,56,3,3,'2015-11-26 20:00:24',10,1,1),
	(60,65,69,3,3,'2015-11-26 20:00:27',10,1,1),
	(61,65,12,1,1,'2015-11-26 20:00:30',10,1,1),
	(62,65,94,7,7,'2015-11-26 20:00:34',10,1,1),
	(63,65,27,3,3,'2015-11-26 20:00:36',10,1,1),
	(64,65,95,7,7,'2015-11-26 20:00:39',10,1,1),
	(65,65,71,5,5,'2015-11-26 20:00:43',10,1,1),
	(66,65,15,4,4,'2015-11-26 20:00:55',10,1,1),
	(67,65,73,7,4,'2015-11-26 20:01:03',10,1,0),
	(68,65,53,7,7,'2015-11-26 20:01:06',10,1,1),
	(69,65,57,4,4,'2015-11-26 20:01:08',10,1,1),
	(70,65,69,3,3,'2015-11-26 20:01:12',10,1,1),
	(71,65,74,7,7,'2015-11-26 20:01:14',10,1,1),
	(72,65,14,3,3,'2015-11-26 20:01:17',10,1,1),
	(73,65,99,4,4,'2015-11-26 20:01:21',10,1,1),
	(74,65,76,2,2,'2015-11-26 20:01:24',10,1,1),
	(75,65,27,3,3,'2015-11-26 20:01:28',10,1,1),
	(76,65,32,7,7,'2015-11-26 20:01:31',10,1,1),
	(77,65,33,1,1,'2015-11-26 20:01:34',10,1,1),
	(78,65,30,6,6,'2015-11-26 20:01:37',10,1,1),
	(79,65,98,3,1,'2015-11-26 20:01:42',10,1,0),
	(80,65,72,6,6,'2015-11-26 20:01:45',10,1,1),
	(81,65,53,7,7,'2015-11-26 20:01:49',10,1,1),
	(82,65,30,6,6,'2015-11-26 20:01:51',10,1,1),
	(83,66,53,7,7,'2015-11-26 20:13:28',10,1,1),
	(84,66,71,5,5,'2015-11-26 20:13:31',10,1,1),
	(85,66,73,7,7,'2015-11-26 20:13:40',10,1,1),
	(86,66,36,4,NULL,'2015-11-26 20:14:03',10,NULL,NULL),
	(87,67,90,3,NULL,'2015-12-17 18:44:33',10,NULL,NULL);

/*!40000 ALTER TABLE `lesson_notes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table lessons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `lessons`;

CREATE TABLE `lessons` (
  `lesson_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `start_at` datetime DEFAULT NULL,
  `total_notes` int(11) DEFAULT NULL,
  `correct_notes` int(11) DEFAULT NULL COMMENT '	',
  `total_score` int(11) DEFAULT NULL,
  PRIMARY KEY (`lesson_id`),
  KEY `fk_lesson_note_users_idx` (`user_id`),
  CONSTRAINT `fk_lesson_notes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `lessons` WRITE;
/*!40000 ALTER TABLE `lessons` DISABLE KEYS */;

INSERT INTO `lessons` (`lesson_id`, `user_id`, `start_at`, `total_notes`, `correct_notes`, `total_score`)
VALUES
	(64,1,'2015-11-26 19:52:35',NULL,NULL,NULL),
	(65,1,'2015-11-26 19:56:32',80,75,75),
	(66,1,'2015-11-26 20:13:28',3,3,3),
	(67,1,'2015-12-17 18:44:33',NULL,NULL,NULL);

/*!40000 ALTER TABLE `lessons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table note_steps
# ------------------------------------------------------------

DROP TABLE IF EXISTS `note_steps`;

CREATE TABLE `note_steps` (
  `note_step_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`note_step_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `note_steps` WRITE;
/*!40000 ALTER TABLE `note_steps` DISABLE KEYS */;

INSERT INTO `note_steps` (`note_step_id`, `name`)
VALUES
	(1,'Ολόκληρα'),
	(2,'Μισά'),
	(3,'Τέταρτα'),
	(4,'Όγδοα');

/*!40000 ALTER TABLE `note_steps` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table note_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `note_types`;

CREATE TABLE `note_types` (
  `note_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '	',
  `fullname` varchar(255) DEFAULT NULL COMMENT '	',
  PRIMARY KEY (`note_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `note_types` WRITE;
/*!40000 ALTER TABLE `note_types` DISABLE KEYS */;

INSERT INTO `note_types` (`note_type_id`, `name`, `fullname`)
VALUES
	(1,'C','NTO'),
	(2,'D','RE'),
	(3,'E','MI'),
	(4,'F','FA'),
	(5,'G','SOL'),
	(6,'A','LA'),
	(7,'B','SI');

/*!40000 ALTER TABLE `note_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notes`;

CREATE TABLE `notes` (
  `note_id` int(11) NOT NULL AUTO_INCREMENT,
  `note_type_id` int(11) DEFAULT NULL,
  `letter` varchar(255) DEFAULT NULL,
  `scale` int(11) DEFAULT NULL,
  `top_align` int(11) DEFAULT NULL,
  `note_step_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `font_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`note_id`),
  KEY `fk_notes_note_types1_idx` (`note_type_id`),
  KEY `fk_notes_note_steps1_idx` (`note_step_id`),
  KEY `fk_notes_positions1_idx` (`position_id`),
  KEY `fk_notes_fonts1_idx` (`font_id`),
  CONSTRAINT `fk_notes_fonts1` FOREIGN KEY (`font_id`) REFERENCES `fonts` (`font_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notes_note_steps1` FOREIGN KEY (`note_step_id`) REFERENCES `note_steps` (`note_step_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notes_note_types1` FOREIGN KEY (`note_type_id`) REFERENCES `note_types` (`note_type_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_notes_positions1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`position_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;

INSERT INTO `notes` (`note_id`, `note_type_id`, `letter`, `scale`, `top_align`, `note_step_id`, `position_id`, `font_id`)
VALUES
	(1,4,'–',1,1,1,1,1),
	(2,5,'—',1,1,1,1,1),
	(3,6,'p',1,0,1,1,1),
	(4,7,'q',1,0,1,1,1),
	(5,1,'r',2,0,1,1,1),
	(6,2,'s',2,0,1,1,1),
	(7,3,'t',2,0,1,2,1),
	(8,4,'u',2,0,1,2,1),
	(9,5,'v',2,0,1,2,1),
	(10,6,'w',2,0,1,2,1),
	(11,7,'x',2,0,1,2,1),
	(12,1,'y',3,0,1,2,1),
	(13,2,'z',3,0,1,2,1),
	(14,3,'{',3,0,1,2,1),
	(15,4,'|',3,0,1,2,1),
	(16,5,'}',3,0,1,3,1),
	(17,6,'~',3,0,1,3,1),
	(18,7,'˜',3,-1,1,3,1),
	(19,1,'™',4,-1,1,3,1),
	(20,2,'š',4,-2,1,3,1),
	(21,4,'‘',1,1,2,1,1),
	(22,5,'’',1,1,2,1,1),
	(23,6,'`',1,0,2,1,1),
	(24,7,'a',1,0,2,1,1),
	(25,1,'b',2,0,2,1,1),
	(26,2,'c',2,0,2,1,1),
	(27,3,'d',2,0,2,2,1),
	(28,4,'e',2,0,2,2,1),
	(29,5,'f',2,0,2,2,1),
	(30,6,'g',2,0,2,2,1),
	(31,7,'h',2,0,2,2,1),
	(32,7,'o',2,0,2,2,1),
	(33,1,'i',3,0,2,2,1),
	(34,2,'j',3,0,2,2,1),
	(35,3,'k',3,0,2,2,1),
	(36,4,'l',3,0,2,2,1),
	(37,5,'m',3,0,2,3,1),
	(38,6,'n',3,0,2,3,1),
	(39,7,'“',3,-1,2,3,1),
	(40,1,'”',4,-1,2,3,1),
	(41,2,'•',4,-2,2,3,1),
	(42,4,'‡',1,1,3,1,1),
	(43,5,'ˆ',1,1,3,1,1),
	(44,6,'P',1,0,3,1,1),
	(45,7,'Q',1,0,3,1,1),
	(46,1,'R',2,0,3,1,1),
	(47,2,'S',2,0,3,1,1),
	(48,3,'T',2,0,3,2,1),
	(49,4,'U',2,0,3,2,1),
	(50,5,'V',2,0,3,2,1),
	(51,6,'W',2,0,3,2,1),
	(52,7,'X',2,0,3,2,1),
	(53,7,'_',2,0,3,2,1),
	(54,1,'Y',3,0,3,2,1),
	(55,2,'Z',3,0,3,2,1),
	(56,3,'[',3,0,3,2,1),
	(57,4,'\\',3,0,3,2,1),
	(58,5,']',3,0,3,3,1),
	(59,6,'^',3,0,3,3,1),
	(60,7,'‰',3,-1,3,3,1),
	(61,1,'Š',4,-1,3,3,1),
	(62,2,'‹',4,-2,3,3,1),
	(63,4,'‚',1,1,4,1,1),
	(64,5,'ƒ',1,1,4,1,1),
	(65,6,'@',1,0,4,1,1),
	(66,7,'A',1,0,4,1,1),
	(67,1,'B',2,0,4,1,1),
	(68,2,'C',2,0,4,1,1),
	(69,3,'D',2,0,4,2,1),
	(70,4,'E',2,0,4,2,1),
	(71,5,'F',2,0,4,2,1),
	(72,6,'G',2,0,4,2,1),
	(73,7,'O',2,0,4,2,1),
	(74,7,'H',2,0,4,2,1),
	(75,1,'I',3,0,4,2,1),
	(76,2,'J',3,0,4,2,1),
	(77,3,'K',3,0,4,2,1),
	(78,4,'L',3,0,4,2,1),
	(79,5,'M',3,0,4,3,1),
	(80,6,'N',3,0,4,3,1),
	(81,7,'„',3,-1,4,3,1),
	(82,1,'…',4,-1,4,3,1),
	(83,2,'†',4,-2,4,3,1),
	(84,4,'‚',1,1,4,1,2),
	(85,5,'ƒ',1,1,4,1,2),
	(86,6,'@',1,0,4,1,2),
	(87,7,'A',1,0,4,1,2),
	(88,1,'B',2,0,4,1,2),
	(89,2,'C',2,0,4,1,2),
	(90,3,'D',2,0,4,2,2),
	(91,4,'E',2,0,4,2,2),
	(92,5,'F',2,0,4,2,2),
	(93,6,'G',2,0,4,2,2),
	(94,7,'O',2,0,4,2,2),
	(95,7,'H',2,0,4,2,2),
	(96,1,'I',3,0,4,2,2),
	(97,2,'J',3,0,4,2,2),
	(98,3,'K',3,0,4,2,2),
	(99,4,'L',3,0,4,2,2),
	(100,5,'M',3,0,4,3,2),
	(101,6,'N',3,0,4,3,2),
	(102,7,'„',3,-1,4,3,2),
	(103,1,'…',4,-1,4,3,2),
	(104,2,'†',4,-2,4,3,2);

/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table positions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `positions`;

CREATE TABLE `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `positions` WRITE;
/*!40000 ALTER TABLE `positions` DISABLE KEYS */;

INSERT INTO `positions` (`position_id`, `name`)
VALUES
	(1,'Κάτω από το πεντάγραμμο'),
	(2,'Μεσα στο πεντάγραμμο'),
	(3,'Πάνω από το πεντάγραμμο');

/*!40000 ALTER TABLE `positions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL COMMENT '	',
  `password` varchar(255) DEFAULT NULL,
  `settings_notes_name` tinyint(1) DEFAULT NULL,
  `settings_notes_under` tinyint(1) DEFAULT NULL,
  `settings_notes_on` tinyint(1) DEFAULT NULL,
  `settings_notes_over` tinyint(1) DEFAULT NULL,
  `settings_debug` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`user_id`, `username`, `password`, `settings_notes_name`, `settings_notes_under`, `settings_notes_on`, `settings_notes_over`, `settings_debug`)
VALUES
	(1,'admin','202cb962ac59075b964b07152d234b70',1,NULL,1,NULL,NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
