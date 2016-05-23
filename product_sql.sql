/*
SQLyog Ultimate v9.51 
MySQL - 5.6.21 : Database - laravel5_test1
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel5_test1` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `laravel5_test1`;

/*Table structure for table `measure_units` */

DROP TABLE IF EXISTS `measure_units`;

CREATE TABLE `measure_units` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

/*Data for the table `measure_units` */

insert  into `measure_units`(`id`,`name`) values (1,'Litre'),(2,'Gallon'),(3,'Kilogram'),(4,'Piece (for 1 item)'),(5,'Metre'),(6,'Tonne');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `total_cost` float(10,2) DEFAULT NULL,
  `tax` float(10,2) DEFAULT NULL,
  `order_total` float(10,2) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order` */

/*Table structure for table `order_line` */

DROP TABLE IF EXISTS `order_line`;

CREATE TABLE `order_line` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `qty` float(10,2) DEFAULT NULL,
  `sale_price_per_unit` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `order_line` */

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `password_resets` */

insert  into `password_resets`(`id`,`email`,`token`,`created_at`) values (5,'ravi.kant@asergis.in','5d4c4f017bc254a9362eba8682ab9255194c7175a640c2225c9e48884c1bc04a','2016-05-21 11:51:51');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `id_uom` int(11) NOT NULL,
  `price_per_unit` decimal(10,2) NOT NULL,
  `qty_in_stock` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `products` */

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `password` varchar(128) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `address1` varchar(128) DEFAULT NULL,
  `address2` varchar(128) DEFAULT NULL,
  `city` varchar(64) DEFAULT NULL,
  `country` varchar(64) DEFAULT NULL,
  `credit_limit` float(10,2) DEFAULT NULL,
  `user_type` tinyint(1) DEFAULT NULL COMMENT '0 = user, 1 = customer',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`email`,`password`,`remember_token`,`address1`,`address2`,`city`,`country`,`credit_limit`,`user_type`,`created_at`,`updated_at`) values (3,'Ravi','ravi.kant@asergis.in','$2y$10$lNLLjFddDHmkB8P9PZIx8eR.lXxJAjvdS43fNVHTBmRYxiSOGqirG','V65YZHMXlKWbWEI2QjAL1G0NX4mBMhNtF7Jlmks3IfSi7szmHGleu8KqW02w',NULL,NULL,NULL,NULL,11.20,NULL,'2016-05-21 10:20:45','2016-05-21 10:20:45');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
