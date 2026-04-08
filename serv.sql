/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.13-MariaDB : Database - servic24_gestedificios
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`servic24_gestedificios` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `servic24_gestedificios`;

/*Table structure for table `articulos` */

DROP TABLE IF EXISTS `articulos`;

CREATE TABLE `articulos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `articulos` */

insert  into `articulos`(`id`,`nombre`,`created_at`,`updated_at`,`activo`) values (1,'articulo 1','2026-03-18 15:10:22','2026-03-18 15:10:46',1),(2,'articulo 2','2026-03-20 09:38:46','2026-03-20 09:38:46',1);

/*Table structure for table `checkout_detalles` */

DROP TABLE IF EXISTS `checkout_detalles`;

CREATE TABLE `checkout_detalles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `checkout_id` bigint(20) unsigned NOT NULL,
  `articulo_id` bigint(20) unsigned NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkout_detalles_checkout_id_foreign` (`checkout_id`),
  KEY `checkout_detalles_articulo_id_foreign` (`articulo_id`),
  CONSTRAINT `checkout_detalles_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `checkout_detalles_checkout_id_foreign` FOREIGN KEY (`checkout_id`) REFERENCES `checkouts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `checkout_detalles` */

insert  into `checkout_detalles`(`id`,`checkout_id`,`articulo_id`,`cantidad`,`created_at`,`updated_at`) values (1,2,1,2,'2026-03-18 16:57:31','2026-03-18 16:57:31'),(15,12,1,1,'2026-03-21 08:21:52','2026-03-21 08:21:52'),(16,12,2,2,'2026-03-21 08:21:52','2026-03-21 08:21:52'),(17,13,1,1,'2026-03-21 08:27:21','2026-03-21 08:27:21'),(18,13,2,2,'2026-03-21 08:27:21','2026-03-21 08:27:21'),(19,14,1,1,'2026-03-21 08:29:46','2026-03-21 08:29:46'),(20,14,2,1,'2026-03-21 08:29:46','2026-03-21 08:29:46'),(21,15,1,2,'2026-03-21 11:46:18','2026-03-21 11:46:18'),(22,15,2,2,'2026-03-21 11:46:18','2026-03-21 11:46:18'),(23,16,1,10,'2026-03-21 11:48:47','2026-03-23 10:49:18'),(24,16,2,12,'2026-03-21 11:48:47','2026-03-23 10:49:18');

/*Table structure for table `checkouts` */

DROP TABLE IF EXISTS `checkouts`;

CREATE TABLE `checkouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `edificio_id` bigint(20) unsigned NOT NULL,
  `tecnico_id` bigint(20) unsigned DEFAULT NULL,
  `bloque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_termino` date DEFAULT NULL,
  `pdf_solicitud` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_entrega` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `checkouts_edificio_id_foreign` (`edificio_id`),
  KEY `checkouts_tecnico_id_foreign` (`tecnico_id`),
  CONSTRAINT `checkouts_edificio_id_foreign` FOREIGN KEY (`edificio_id`) REFERENCES `edificios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `checkouts_tecnico_id_foreign` FOREIGN KEY (`tecnico_id`) REFERENCES `tecnicos` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `checkouts` */

insert  into `checkouts`(`id`,`edificio_id`,`tecnico_id`,`bloque`,`fecha_inicio`,`fecha_termino`,`pdf_solicitud`,`pdf_entrega`,`created_at`,`updated_at`) values (1,1,1,'123','2026-03-19','2026-03-19',NULL,NULL,'2026-03-18 16:56:41','2026-03-18 16:56:41'),(2,1,1,'123','2026-03-19','2026-03-19',NULL,NULL,'2026-03-18 16:57:31','2026-03-18 16:57:31'),(12,1,1,'123','2026-03-21','2026-03-21','V2wdaYohhsSvi4yoV83aLH8wJxfUgq22K3V6MVFE.pdf','vO8EkmV45Gck26fp6jtIeVdWes2RqYx0kXJLLsjn.pdf','2026-03-21 08:21:52','2026-03-21 08:21:52'),(13,1,1,'123','2026-03-21','2026-03-21','viVlvjHqK0NtQpt5EsL1EhOViwm348BxXDZtfvab.pdf','SNxfmdeNK2wdq4YfXwNKcrpgMA12kWhIbmJEtlln.pdf','2026-03-21 08:27:21','2026-03-21 08:27:21'),(14,1,1,'123','2026-03-29','2026-03-29','vDKJ8s9tQFJU7tp7x2JeIaCQJ6mSzUbZ6xvAdjps.pdf','zIpcZKnLSnwY47qqfIZbMbvA4bAw7Fgre814hNS9.pdf','2026-03-21 08:29:46','2026-03-21 08:29:46'),(15,1,1,'123','2026-03-21','2026-03-21','FI5zOHLmU6E8zL5TtK8C8a6wRFYz3klCxrM8LLdH.pdf','CnYYDTXbg6RHOfBG0wtBotEHqyDOmoCQxNpz5KIQ.pdf','2026-03-21 11:46:18','2026-03-21 11:46:18'),(16,1,2,'123','2026-03-21','2026-03-21','ItZYxHGRrQoW9xcI815MMjfY000jHzc7lQ3pmRhz.pdf','HCtaBKyyOLVnCGZmpx4kbZ383gVyswC1jPlIjSXf.pdf','2026-03-21 11:48:47','2026-03-23 10:42:07'),(17,1,1,'123','2026-03-25','2026-03-25',NULL,NULL,'2026-03-25 14:57:18','2026-03-25 14:57:18');

/*Table structure for table `edificios` */

DROP TABLE IF EXISTS `edificios`;

CREATE TABLE `edificios` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comuna` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ciudad` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacion` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `edificios` */

insert  into `edificios`(`id`,`nombre`,`direccion`,`comuna`,`ciudad`,`observacion`,`created_at`,`updated_at`) values (1,'Aviador','Direccion Prueba1','Comuna Prueba',NULL,NULL,'2026-03-18 16:08:01','2026-03-18 16:08:01');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `gestiones` */

DROP TABLE IF EXISTS `gestiones`;

CREATE TABLE `gestiones` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `departamento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_visita_estimada` date DEFAULT NULL,
  `hora_visita_estimada` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` enum('pendiente','en_proceso','resuelto') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `edificio_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gestiones_edificio_id_foreign` (`edificio_id`),
  CONSTRAINT `gestiones_edificio_id_foreign` FOREIGN KEY (`edificio_id`) REFERENCES `edificios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `gestiones` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (14,'2014_10_12_000000_create_users_table',1),(15,'2014_10_12_100000_create_password_resets_table',1),(16,'2019_08_19_000000_create_failed_jobs_table',1),(17,'2025_12_19_133445_create_gestiones_table',1),(18,'2025_12_20_112147_create_visitas_table',1),(19,'2026_01_08_011654_add_fecha_hora_visita_to_gestiones_table',1),(20,'2026_01_19_085126_create_reportes_table',1),(21,'2026_03_18_110000_create_tecnicos_table',1),(22,'2026_03_18_111000_create_edificios_table',1),(23,'2026_03_18_114207_create_articulos_table',1),(24,'2026_03_18_120000_create_checkouts_table',1),(25,'2026_03_18_121000_create_checkout_detalles_table',1),(26,'2026_03_18_140454_add_activo_to_articulos',1),(27,'2026_03_18_160614_add_edificio_id_to_gestiones',2);

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `reportes` */

DROP TABLE IF EXISTS `reportes`;

CREATE TABLE `reportes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `reportes` */

/*Table structure for table `tecnicos` */

DROP TABLE IF EXISTS `tecnicos`;

CREATE TABLE `tecnicos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tecnicos` */

insert  into `tecnicos`(`id`,`nombre`,`email`,`rut`,`telefono`,`activo`,`created_at`,`updated_at`) values (1,'Kevin Guerrero',NULL,'',NULL,1,'2026-03-18 15:11:57','2026-03-19 07:55:35'),(2,'Felipe Reyes',NULL,'',NULL,1,'2026-03-23 10:42:00','2026-03-23 10:42:00'),(3,'Kevin Guerrero','kevinguerrerop1@gmail.com','20.061.775-4','933996728',1,'2026-04-08 10:19:54','2026-04-08 10:19:54');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values (1,'Kevin Guerrero','kevinguerrerop1@gmail.com',NULL,'$2y$10$b1TRZNnr/B7JfSLjKxwNU.qFUa9C3syiPuAvxTv71431WZyzrnWLa',NULL,'2026-03-18 15:06:14','2026-03-18 15:06:14');

/*Table structure for table `visitas` */

DROP TABLE IF EXISTS `visitas`;

CREATE TABLE `visitas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `gestion_id` bigint(20) unsigned NOT NULL,
  `fecha_visita` date NOT NULL,
  `hora_visita` time NOT NULL,
  `estado` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendiente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visitas_gestion_id_foreign` (`gestion_id`),
  CONSTRAINT `visitas_gestion_id_foreign` FOREIGN KEY (`gestion_id`) REFERENCES `gestiones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `visitas` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
