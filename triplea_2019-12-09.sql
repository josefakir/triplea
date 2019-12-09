# ************************************************************
# Sequel Pro SQL dump
# Version 5446
#
# https://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 8.0.18)
# Database: triplea
# Generation Time: 2019-12-09 23:48:18 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bookings
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bookings`;

CREATE TABLE `bookings` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `indumentaria` varchar(255) DEFAULT NULL,
  `comentarios` text,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table rols
# ------------------------------------------------------------

DROP TABLE IF EXISTS `rols`;

CREATE TABLE `rols` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `rols` WRITE;
/*!40000 ALTER TABLE `rols` DISABLE KEYS */;

INSERT INTO `rols` (`id`, `nombre`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Administrador',1,'2019-11-25 15:23:32','2019-11-25 15:23:32'),
	(2,'Editor',1,'2019-11-25 15:23:32','2019-11-25 15:23:32'),
	(3,'Talento (Luchador)',1,'2019-11-25 15:23:32','2019-11-25 21:46:54');

/*!40000 ALTER TABLE `rols` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tipos
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tipos`;

CREATE TABLE `tipos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `tipos` WRITE;
/*!40000 ALTER TABLE `tipos` DISABLE KEYS */;

INSERT INTO `tipos` (`id`, `nombre`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'Televisión',1,'2019-11-25 21:51:30','2019-11-25 21:51:30'),
	(2,'Firma de autógrafos',1,'2019-11-25 21:52:50','2019-11-25 21:52:50'),
	(3,'Evento Privado',1,'2019-11-25 21:52:55','2019-11-25 21:52:55'),
	(4,'Prensa',1,'2019-11-25 21:53:37','2019-11-28 17:53:36'),
	(6,'Reunión Oficina',1,'2019-11-28 17:53:42','2019-11-28 17:53:42'),
	(7,'House Show',1,'2019-11-28 17:53:48','2019-11-28 17:53:48');

/*!40000 ALTER TABLE `tipos` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `correo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `contrasena` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `apikey` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `rol` int(11) NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `apikey` (`apikey`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
