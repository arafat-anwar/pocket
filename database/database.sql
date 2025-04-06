/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 8.0.30 : Database - auction_exchange
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `auction_bids` */

DROP TABLE IF EXISTS `auction_bids`;

CREATE TABLE `auction_bids` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `notes` text COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_bids_auction_id_foreign` (`auction_id`),
  KEY `auction_bids_user_id_foreign` (`user_id`),
  KEY `auction_bids_creator_id_foreign` (`creator_id`),
  KEY `auction_bids_editor_id_foreign` (`editor_id`),
  CONSTRAINT `auction_bids_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auction_bids_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auction_bids_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auction_bids_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auction_bids` */

/*Table structure for table `auction_logs` */

DROP TABLE IF EXISTS `auction_logs`;

CREATE TABLE `auction_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `auction_id` bigint unsigned NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auction_logs_auction_id_foreign` (`auction_id`),
  KEY `auction_logs_creator_id_foreign` (`creator_id`),
  KEY `auction_logs_editor_id_foreign` (`editor_id`),
  CONSTRAINT `auction_logs_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auctions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auction_logs_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auction_logs_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auction_logs` */

/*Table structure for table `auctions` */

DROP TABLE IF EXISTS `auctions`;

CREATE TABLE `auctions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_at` datetime DEFAULT NULL,
  `deadline` datetime DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `base_price` double NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `terms_and_conditions` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `auctions_product_id_foreign` (`product_id`),
  KEY `auctions_creator_id_foreign` (`creator_id`),
  KEY `auctions_editor_id_foreign` (`editor_id`),
  CONSTRAINT `auctions_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auctions_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auctions_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `auctions` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `countries` */

insert  into `countries`(`id`,`code`,`name`,`nationality`,`desc`,`status`,`created_at`,`updated_at`) values (1,'UAE','United Arab Emirates','Emirati',NULL,1,NULL,'2023-07-31 01:00:48'),(2,'OM','Oman','Omani',NULL,1,'2025-02-07 06:50:07','2025-02-07 06:50:07'),(3,'YEMEN','YEMEN','YEMEN',NULL,1,'2025-02-14 23:01:17','2025-02-14 23:01:17'),(4,'IN','INDIA','INDIAN',NULL,1,'2025-02-22 05:28:42','2025-02-22 05:28:42');

/*Table structure for table `crons` */

DROP TABLE IF EXISTS `crons`;

CREATE TABLE `crons` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `process` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `output` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `crons` */

/*Table structure for table `customer_balances` */

DROP TABLE IF EXISTS `customer_balances`;

CREATE TABLE `customer_balances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `type` enum('purchase','sale') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'purchase',
  `purchase_id` bigint unsigned DEFAULT NULL,
  `sale_id` bigint unsigned DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_balances_customer_id_foreign` (`customer_id`),
  KEY `customer_balances_purchase_id_foreign` (`purchase_id`),
  KEY `customer_balances_sale_id_foreign` (`sale_id`),
  KEY `customer_balances_creator_id_foreign` (`creator_id`),
  KEY `customer_balances_editor_id_foreign` (`editor_id`),
  CONSTRAINT `customer_balances_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_balances_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_balances_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_balances_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `customer_balances_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customer_balances` */

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`name`,`phone`,`email`,`address`,`description`,`image`,`deleted_at`,`created_at`,`updated_at`) values (4,'Arafat Anwar','01754148869',NULL,NULL,NULL,'uploads/customers/1930830401-493548959.png',NULL,'2025-02-11 06:42:57','2025-02-11 06:42:57');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `identity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `identity_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `passport` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `passport_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `license` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `license_file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` enum('driver','trip-staff','office-staff') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'driver',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

/*Table structure for table `entries` */

DROP TABLE IF EXISTS `entries`;

CREATE TABLE `entries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `expense` double NOT NULL DEFAULT '0',
  `income` double NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `attachment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned NOT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entries_creator_id_foreign` (`creator_id`),
  KEY `entries_editor_id_foreign` (`editor_id`),
  CONSTRAINT `entries_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entries_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `entries` */

/*Table structure for table `entry_items` */

DROP TABLE IF EXISTS `entry_items`;

CREATE TABLE `entry_items` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `entry_id` bigint unsigned NOT NULL,
  `ledger_id` bigint unsigned NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `entry_items_entry_id_foreign` (`entry_id`),
  KEY `entry_items_ledger_id_foreign` (`ledger_id`),
  CONSTRAINT `entry_items_entry_id_foreign` FOREIGN KEY (`entry_id`) REFERENCES `entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `entry_items_ledger_id_foreign` FOREIGN KEY (`ledger_id`) REFERENCES `ledgers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `entry_items` */

/*Table structure for table `exchange_logs` */

DROP TABLE IF EXISTS `exchange_logs`;

CREATE TABLE `exchange_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exchange_id` bigint unsigned NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exchange_logs_exchange_id_foreign` (`exchange_id`),
  KEY `exchange_logs_creator_id_foreign` (`creator_id`),
  KEY `exchange_logs_editor_id_foreign` (`editor_id`),
  CONSTRAINT `exchange_logs_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exchange_logs_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exchange_logs_exchange_id_foreign` FOREIGN KEY (`exchange_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exchange_logs` */

/*Table structure for table `exchanges` */

DROP TABLE IF EXISTS `exchanges`;

CREATE TABLE `exchanges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `asking_price` double NOT NULL DEFAULT '0',
  `exchange_price` double NOT NULL DEFAULT '0',
  `requested_at` datetime DEFAULT NULL,
  `exchanged_at` datetime DEFAULT NULL,
  `status` enum('requested','verified','exchanged','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'requested',
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `exchanges_supplier_id_foreign` (`supplier_id`),
  KEY `exchanges_product_id_foreign` (`product_id`),
  KEY `exchanges_creator_id_foreign` (`creator_id`),
  KEY `exchanges_editor_id_foreign` (`editor_id`),
  CONSTRAINT `exchanges_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exchanges_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exchanges_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `exchanges_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `exchanges` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `inventories` */

DROP TABLE IF EXISTS `inventories`;

CREATE TABLE `inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `type` enum('purchase','sale','exchange') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'purchase',
  `customer_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `price` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventories_product_id_foreign` (`product_id`),
  KEY `inventories_customer_id_foreign` (`customer_id`),
  KEY `inventories_supplier_id_foreign` (`supplier_id`),
  KEY `inventories_creator_id_foreign` (`creator_id`),
  KEY `inventories_editor_id_foreign` (`editor_id`),
  CONSTRAINT `inventories_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventories_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventories_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventories_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `inventories_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `inventories` */

/*Table structure for table `language_libraries` */

DROP TABLE IF EXISTS `language_libraries`;

CREATE TABLE `language_libraries` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `language_id` bigint unsigned NOT NULL,
  `slug` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `translation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `language_libraries_language_id_foreign` (`language_id`),
  CONSTRAINT `language_libraries_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=803 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `language_libraries` */

insert  into `language_libraries`(`id`,`language_id`,`slug`,`translation`,`created_at`,`updated_at`) values (1,1,'Language','Language','2024-02-27 21:22:54','2024-02-27 21:22:54'),(2,2,'Language','اللغة','2024-02-27 21:22:54','2024-05-28 19:14:26'),(3,1,'Language Library','Language Library','2024-02-27 22:47:54','2024-02-27 22:47:54'),(4,2,'Language Library','مكتبة اللغات','2024-02-27 22:47:54','2024-02-28 08:08:05'),(5,1,'Setups','Setups','2024-02-28 07:26:44','2024-02-28 07:26:44'),(6,2,'Setups','التركيب','2024-02-28 07:26:44','2024-03-01 02:45:55'),(7,1,'People','People','2024-02-28 07:26:44','2025-02-05 07:28:58'),(8,2,'People','قائمة الموظفين','2024-02-28 07:26:44','2024-03-01 03:09:27'),(9,1,'Attendance','Attendance','2024-02-28 07:26:44','2024-02-28 07:26:44'),(10,2,'Attendance','الحضور','2024-02-28 07:26:44','2024-03-01 02:46:25'),(11,1,'Overtime','Overtime','2024-02-28 07:26:44','2024-02-28 07:26:44'),(12,2,'Overtime','العمل الاضافي','2024-02-28 07:26:44','2024-02-29 00:34:00'),(13,1,'Leave','Leave','2024-02-28 07:26:44','2024-02-28 07:26:44'),(14,2,'Leave','الاجازات','2024-02-28 07:26:44','2024-02-29 00:33:51'),(15,1,'Payroll','Payroll','2024-02-28 07:26:44','2024-02-28 07:26:44'),(16,2,'Payroll','كشف رواتب','2024-02-28 07:26:44','2024-02-28 08:12:19'),(17,1,'Device','Device','2024-02-28 07:26:44','2024-02-28 07:26:44'),(18,2,'Device','جهاز','2024-02-28 07:26:44','2024-02-28 07:57:26'),(19,1,'Issues','Issues','2024-02-28 07:26:44','2024-02-28 07:26:44'),(20,2,'Issues','مشاكل','2024-02-28 07:26:44','2024-02-28 08:07:16'),(21,1,'HR Reports','HR Reports','2024-02-28 07:26:44','2024-02-28 07:26:44'),(22,2,'HR Reports','تقارير الموارد البشرية','2024-02-28 07:26:44','2024-02-28 08:06:45'),(23,1,'Publishments','Publishments','2024-02-28 07:26:44','2024-02-28 07:26:44'),(24,2,'Publishments','المنشورات','2024-02-28 07:26:44','2024-02-28 08:16:39'),(25,1,'Biotime','Biotime','2024-02-28 07:26:44','2024-02-28 07:51:25'),(26,2,'Biotime','بيوتايم','2024-02-28 07:26:44','2024-02-29 00:35:53'),(27,1,'ZKTeco','ZKTeco','2024-02-28 07:26:44','2024-02-28 07:26:44'),(28,2,'ZKTeco','ZKTeco','2024-02-28 07:26:44','2024-02-28 07:26:44'),(29,1,'Task Management','Task Management','2024-02-28 07:26:44','2024-02-28 07:26:44'),(30,2,'Task Management','ادارة المهام','2024-02-28 07:26:44','2024-02-28 08:20:41'),(31,1,'Document Manager','Document Manager','2024-02-28 07:26:44','2024-02-28 07:26:44'),(32,2,'Document Manager','مدير الوثائق','2024-02-28 07:26:44','2024-02-28 07:57:49'),(33,1,'Payroll Reports','Payroll Reports','2024-02-28 07:26:44','2024-02-28 07:26:44'),(34,2,'Payroll Reports','تقارير الرواتب','2024-02-28 07:26:44','2024-02-28 08:12:30'),(35,1,'System Settings','System Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(36,2,'System Settings','اعدادات النظام','2024-02-28 07:26:45','2024-02-28 08:20:31'),(37,1,'Role Management','Role Management','2024-02-28 07:26:45','2024-02-28 07:26:45'),(38,2,'Role Management','إدارة الأدوار','2024-02-28 07:26:45','2024-02-28 08:17:07'),(39,1,'Employees','Employees','2024-02-28 07:26:45','2024-02-28 07:26:45'),(40,2,'Employees','موظفين','2024-02-28 07:26:45','2024-02-28 08:04:50'),(41,1,'Actions','Actions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(42,2,'Actions','الإجراءات','2024-02-28 07:26:45','2024-03-01 02:46:40'),(43,1,'Employee Settings','Employee Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(44,2,'Employee Settings','إعدادات الموظف','2024-02-28 07:26:45','2024-02-28 08:04:35'),(45,1,'Attendance Settings','Attendance Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(46,2,'Attendance Settings','إعدادات الحضور','2024-02-28 07:26:45','2024-02-28 07:48:12'),(47,1,'Leave Settings','Leave Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(48,2,'Leave Settings','اعدادات الاجازات','2024-02-28 07:26:45','2024-04-09 19:43:05'),(49,1,'Balance','Balance','2024-02-28 07:26:45','2024-02-28 07:26:45'),(50,2,'Balance','الرصيد','2024-02-28 07:26:45','2024-02-29 00:37:40'),(51,1,'Applications','Applications','2024-02-28 07:26:45','2024-02-28 07:26:45'),(52,2,'Applications','التطبيقات','2024-02-28 07:26:45','2024-02-28 07:43:46'),(53,1,'On Special Duties','On Special Duties','2024-02-28 07:26:45','2024-02-28 07:26:45'),(54,2,'On Special Duties','مهام خاصة','2024-02-28 07:26:45','2024-04-21 20:53:57'),(57,1,'Devices','Devices','2024-02-28 07:26:45','2024-02-28 07:26:45'),(58,2,'Devices','الأجهزة','2024-02-28 07:26:45','2024-02-28 07:57:37'),(59,1,'Remote Attendances','Remote Attendances','2024-02-28 07:26:45','2024-02-28 07:26:45'),(60,2,'Remote Attendances','الحضور عن بعد','2024-02-28 07:26:45','2024-02-28 08:16:57'),(61,1,'Solutions','Solutions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(62,2,'Solutions','حلول','2024-02-28 07:26:45','2024-02-28 08:19:27'),(63,1,'Issue Settings','Issue Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(64,2,'Issue Settings','إعدادات المشكلة','2024-02-28 07:26:45','2024-02-28 08:07:03'),(65,1,'Provident Funds','Provident Funds','2024-02-28 07:26:45','2024-02-28 07:26:45'),(66,2,'Provident Funds','صناديق الادخار','2024-02-28 07:26:45','2024-02-28 08:16:06'),(67,1,'Loans','Loans','2024-02-28 07:26:45','2024-02-28 07:26:45'),(68,2,'Loans','القروض','2024-02-28 07:26:45','2024-02-28 08:10:01'),(69,1,'PF','Provident Fund','2024-02-28 07:26:45','2024-02-28 08:14:08'),(70,2,'PF','صندوق التامينات','2024-02-28 07:26:45','2024-05-28 20:08:36'),(71,1,'Loan Settings','Loan Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(72,2,'Loan Settings','إعدادات القرض','2024-02-28 07:26:45','2024-02-28 08:09:43'),(73,1,'Payroll Settings','Payroll Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(74,2,'Payroll Settings','إعدادات الرواتب','2024-02-28 07:26:45','2024-02-28 08:12:41'),(75,1,'Monthly Payrolls','Monthly Payrolls','2024-02-28 07:26:45','2024-02-28 07:26:45'),(76,2,'Monthly Payrolls','الرواتب الشهرية','2024-02-28 07:26:45','2024-02-28 08:10:41'),(77,1,'Weekly Payrolls','Weekly Payrolls','2024-02-28 07:26:45','2024-02-28 07:26:45'),(78,2,'Weekly Payrolls','كشوف المرتبات الأسبوعية','2024-02-28 07:26:45','2024-02-28 08:22:59'),(79,1,'Publishment Settings','Publishment Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(80,2,'Publishment Settings','إعدادات النشر','2024-02-28 07:26:45','2024-02-28 08:16:17'),(81,1,'Employee Register','Employee Register','2024-02-28 07:26:45','2024-02-28 07:26:45'),(82,2,'Employee Register','سجل الموظف','2024-02-28 07:26:45','2024-02-28 08:04:25'),(83,1,'Attendance Reports','Attendance Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(84,2,'Attendance Reports','تقارير الحضور','2024-02-28 07:26:45','2024-02-28 07:48:00'),(85,1,'Leave Register','Leave Register','2024-02-28 07:26:45','2024-02-28 07:26:45'),(86,2,'Leave Register','سجلات الاجازات','2024-02-28 07:26:45','2024-04-21 20:51:50'),(87,1,'Leave Applications','Leave Applications','2024-02-28 07:26:45','2024-02-28 07:26:45'),(88,2,'Leave Applications','طلبات الاجازات','2024-02-28 07:26:45','2024-04-21 20:53:20'),(89,1,'Overtime Pre-Approval','Overtime Pre-Approval','2024-02-28 07:26:45','2024-02-28 07:26:45'),(90,2,'Overtime Pre-Approval','الموافقة المسبقة على العمل الإضافي','2024-02-28 07:26:45','2024-02-28 08:11:48'),(91,1,'System Information','System Information','2024-02-28 07:26:45','2024-02-28 07:26:45'),(92,2,'System Information','معلومات النظام','2024-02-28 07:26:45','2024-02-28 08:20:22'),(93,1,'Areas','Areas','2024-02-28 07:26:45','2024-02-28 07:26:45'),(94,2,'Areas','المناطق','2024-02-28 07:26:45','2024-02-28 07:44:21'),(95,1,'Departments','Departments','2024-02-28 07:26:45','2024-02-28 07:26:45'),(96,2,'Departments','الأقسام','2024-02-28 07:26:45','2024-02-28 07:56:56'),(97,1,'Positions','Positions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(98,2,'Positions','المواقف','2024-02-28 07:26:45','2024-02-28 08:14:47'),(99,1,'Transactions','Transactions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(100,2,'Transactions','المعاملات','2024-02-28 07:26:45','2024-02-28 08:21:51'),(101,1,'Employee','Employee','2024-02-28 07:26:45','2024-02-28 07:26:45'),(102,2,'Employee','الموظف','2024-02-28 07:26:45','2024-04-23 02:21:49'),(103,1,'Check In and Outs','Check In and Outs','2024-02-28 07:26:45','2024-02-28 07:26:45'),(104,2,'Check In and Outs','تسجيل الدخول والخروج','2024-02-28 07:26:45','2024-02-28 07:54:14'),(105,1,'Checkinouts','Checkinouts','2024-02-28 07:26:45','2024-02-28 07:26:45'),(106,2,'Checkinouts','تسجيل الدخول والخروج','2024-02-28 07:26:45','2024-02-28 07:54:25'),(107,1,'Organogram','Organogram','2024-02-28 07:26:45','2024-02-28 07:26:45'),(108,2,'Organogram','مخطط عضوي','2024-02-28 07:26:45','2024-02-28 08:11:22'),(109,1,'Tasks','Tasks','2024-02-28 07:26:45','2024-02-28 07:26:45'),(110,2,'Tasks','مهام','2024-02-28 07:26:45','2024-02-28 08:20:54'),(111,1,'Manual Attendance','Manual Attendance','2024-02-28 07:26:45','2024-02-28 07:26:45'),(112,2,'Manual Attendance','الحضور اليدوي','2024-02-28 07:26:45','2024-02-28 08:10:11'),(113,1,'HR Forms','HR Forms','2024-02-28 07:26:45','2024-02-28 07:26:45'),(114,2,'HR Forms','نماذج الموارد البشرية','2024-02-28 07:26:45','2024-02-28 08:06:36'),(115,1,'Templates','Templates','2024-02-28 07:26:45','2024-02-28 07:26:45'),(116,2,'Templates','النماذج','2024-02-28 07:26:45','2024-04-21 21:04:25'),(117,1,'Documents','Documents','2024-02-28 07:26:45','2024-02-28 07:26:45'),(118,2,'Documents','الوثائق','2024-02-28 07:26:45','2024-03-01 02:46:58'),(119,1,'Expiry Reports','Expiry Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(120,2,'Expiry Reports','تقارير انتهاء الصلاحية','2024-02-28 07:26:45','2024-02-28 08:05:11'),(121,1,'Asset Register','Asset Register','2024-02-28 07:26:45','2024-02-28 07:26:45'),(122,2,'Asset Register','سجل الأصول','2024-02-28 07:26:45','2024-02-28 07:44:32'),(123,1,'Project Payroll','Project Payroll','2024-02-28 07:26:45','2024-02-28 07:26:45'),(124,2,'Project Payroll','رواتب المشروع','2024-02-28 07:26:45','2024-02-28 08:15:25'),(125,1,'Attendance & Payroll Calculations','Attendance and Payroll Calculations','2024-02-28 07:26:45','2024-02-28 07:46:06'),(126,2,'Attendance & Payroll Calculations','الحضور وحسابات الرواتب','2024-02-28 07:26:45','2024-02-28 07:45:29'),(127,1,'Combined Full Month','Combined Full Month','2024-02-28 07:26:45','2024-02-28 07:26:45'),(128,2,'Combined Full Month','تجميع الشهر الكامل','2024-02-28 07:26:45','2024-04-21 20:58:51'),(129,1,'Bank Payslips','Bank Payslips','2024-02-28 07:26:45','2024-02-28 07:26:45'),(130,2,'Bank Payslips','كشوف المرتبات البنكية','2024-02-28 07:26:45','2024-02-28 07:50:30'),(131,1,'Company Wise Reports','Company Wise Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(132,2,'Company Wise Reports','التقارير حسب بالشركة','2024-02-28 07:26:45','2024-04-21 20:56:14'),(133,1,'Bank Request','Bank Request','2024-02-28 07:26:45','2024-02-28 07:26:45'),(134,2,'Bank Request','طلب البنك','2024-02-28 07:26:45','2024-02-28 07:50:53'),(135,1,'Bank Request Summery','Bank Request Summery','2024-02-28 07:26:45','2024-02-28 07:26:45'),(136,2,'Bank Request Summery','ملخص طلب البنك','2024-02-28 07:26:45','2024-02-28 07:51:05'),(137,1,'Cash Request','Cash Request','2024-02-28 07:26:45','2024-02-28 07:26:45'),(138,2,'Cash Request','طلب نقدي','2024-02-28 07:26:45','2024-02-28 07:52:29'),(139,1,'Cash Request Summery','Cash Request Summery','2024-02-28 07:26:45','2024-02-28 07:26:45'),(140,2,'Cash Request Summery','ملخص طلب النقدية','2024-02-28 07:26:45','2024-02-28 07:52:40'),(141,1,'SIF Summery','SIF Summary','2024-02-28 07:26:45','2024-02-28 08:19:18'),(142,2,'SIF Summery','SIF ملخص','2024-02-28 07:26:45','2024-02-28 08:19:18'),(143,1,'Cash Payslips','Cash Payslips','2024-02-28 07:26:45','2024-02-28 07:26:45'),(144,2,'Cash Payslips','كشوف المرتبات النقدية','2024-02-28 07:26:45','2024-02-28 07:52:04'),(145,1,'Absent Reports','Absent Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(146,2,'Absent Reports','تقارير الغياب','2024-02-28 07:26:45','2024-04-21 20:52:17'),(147,1,'Absent Summery','Absent Summary','2024-02-28 07:26:45','2024-04-21 20:52:45'),(148,2,'Absent Summery','ملخص الغياب','2024-02-28 07:26:45','2024-04-21 20:52:50'),(149,1,'Duty Roaster Reports','Duty Roaster Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(150,2,'Duty Roaster Reports','تقرير جداول المهام','2024-02-28 07:26:45','2024-04-21 20:51:10'),(151,1,'Modules','Modules','2024-02-28 07:26:45','2024-02-28 07:26:45'),(152,2,'Modules','مكونات النظام','2024-02-28 07:26:45','2024-03-01 03:02:24'),(153,1,'Menu','Menu','2024-02-28 07:26:45','2024-02-28 07:26:45'),(154,2,'Menu','القائمة الرئيسية','2024-02-28 07:26:45','2024-03-01 03:02:48'),(155,1,'Submenu','Submenu','2024-02-28 07:26:45','2024-02-28 07:26:45'),(156,2,'Submenu','القائمة الفرعية','2024-02-28 07:26:45','2024-02-28 08:20:12'),(157,1,'Roles','Roles','2024-02-28 07:26:45','2024-02-28 07:26:45'),(158,2,'Roles','الأدوار','2024-02-28 07:26:45','2024-02-28 08:17:41'),(159,1,'Role Permissions','Role Permissions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(160,2,'Role Permissions','أذونات الدور','2024-02-28 07:26:45','2024-02-28 08:17:18'),(161,1,'Users','Users','2024-02-28 07:26:45','2024-02-28 07:26:45'),(162,2,'Users','المستخدمين','2024-02-28 07:26:45','2024-02-28 08:22:29'),(163,1,'My Team','My Team','2024-02-28 07:26:45','2024-02-28 07:26:45'),(164,2,'My Team','فريقي','2024-02-28 07:26:45','2024-02-28 08:10:52'),(165,1,'Company Hierarchy','Company Hierarchy','2024-02-28 07:26:45','2024-02-28 07:26:45'),(166,2,'Company Hierarchy','التسلسل الهرمي للشركة','2024-02-28 07:26:45','2024-02-28 07:55:06'),(167,1,'Our Trustee Boards','Our Trustee Boards','2024-02-28 07:26:45','2024-02-28 07:26:45'),(168,2,'Our Trustee Boards','مجالس الأمناء لدينا','2024-02-28 07:26:45','2024-02-28 08:11:31'),(169,1,'Ex-Employees','Ex-Employees','2024-02-28 07:26:45','2024-02-28 07:26:45'),(170,2,'Ex-Employees','الموظفين السابقين','2024-02-28 07:26:45','2024-02-28 08:05:00'),(171,1,'Password Change Requests','Password Change Requests','2024-02-28 07:26:45','2024-02-28 07:26:45'),(172,2,'Password Change Requests','طلبات تغيير كلمة المرور','2024-02-28 07:26:45','2024-02-28 08:12:07'),(173,1,'Shift Change Requests','Shift Change Requests','2024-02-28 07:26:45','2024-02-28 07:26:45'),(174,2,'Shift Change Requests','طلبات التغيير التحول','2024-02-28 07:26:45','2024-02-28 08:18:45'),(175,1,'Probation Notifications','Probation Notifications','2024-02-28 07:26:45','2024-02-28 07:26:45'),(176,2,'Probation Notifications','إخطارات الاختبار','2024-02-28 07:26:45','2024-02-28 08:15:05'),(177,1,'Designations','Designations','2024-02-28 07:26:45','2024-02-28 07:26:45'),(178,2,'Designations','التسميات','2024-02-28 07:26:45','2024-02-28 07:57:05'),(179,1,'Functions','Departments','2024-02-28 07:26:45','2024-02-28 08:05:39'),(180,2,'Functions','الإدارات','2024-02-28 07:26:45','2024-02-28 08:05:39'),(181,1,'Sub-Functions','Sub-Departments','2024-02-28 07:26:45','2024-02-28 08:19:59'),(182,2,'Sub-Functions','الأقسام الفرعية','2024-02-28 07:26:45','2024-02-28 08:19:59'),(183,1,'Job Levels','Job Levels','2024-02-28 07:26:45','2024-02-28 07:26:45'),(184,2,'Job Levels','المستويات الوظيفية','2024-02-28 07:26:45','2024-02-28 08:07:26'),(185,1,'Job Locations','Job Locations','2024-02-28 07:26:45','2024-02-28 07:26:45'),(186,2,'Job Locations','مواقع العمل','2024-02-28 07:26:45','2024-02-28 08:07:36'),(187,1,'Teams','Teams','2024-02-28 07:26:45','2024-02-28 07:26:45'),(188,2,'Teams','فرق','2024-02-28 07:26:45','2024-02-28 08:21:12'),(189,1,'Employee Categories','Employee Categories','2024-02-28 07:26:45','2024-02-28 07:26:45'),(190,2,'Employee Categories','فئات الموظفين','2024-02-28 07:26:45','2024-02-28 08:04:14'),(191,1,'Brands','Brands','2024-02-28 07:26:45','2024-02-28 07:26:45'),(192,2,'Brands','العلامات التجارية','2024-02-28 07:26:45','2024-02-28 07:51:52'),(193,1,'Legal Entities','Legal Entities','2024-02-28 07:26:45','2024-02-28 07:26:45'),(194,2,'Legal Entities','الكيانات القانونية','2024-02-28 07:26:45','2024-02-28 08:09:24'),(195,1,'Religions','Religions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(196,2,'Religions','الأديان','2024-02-28 07:26:45','2024-02-28 08:16:48'),(197,1,'Separation Options','Separation Options','2024-02-28 07:26:45','2024-02-28 07:26:45'),(198,2,'Separation Options','خيارات الانفصال','2024-02-28 07:26:45','2024-02-28 08:18:26'),(199,1,'Trustee Boards','Trustee Boards','2024-02-28 07:26:45','2024-02-28 07:26:45'),(200,2,'Trustee Boards','مجالس الأمناء','2024-02-28 07:26:45','2024-02-28 08:22:10'),(201,1,'Trustee Board Members','Trustee Board Members','2024-02-28 07:26:45','2024-02-28 07:26:45'),(202,2,'Trustee Board Members','أعضاء مجلس الأمناء','2024-02-28 07:26:45','2024-02-28 08:22:00'),(203,1,'Shifts','Shifts','2024-02-28 07:26:45','2024-02-28 07:26:45'),(204,2,'Shifts','الورديات (شفت)','2024-02-28 07:26:45','2024-02-29 00:35:23'),(205,1,'Leave Types','Leave Types','2024-02-28 07:26:45','2024-02-28 07:26:45'),(206,2,'Leave Types','أنواع الإجازات','2024-02-28 07:26:45','2024-02-28 08:08:59'),(207,1,'Holiday','Holiday','2024-02-28 07:26:45','2024-02-28 07:26:45'),(208,2,'Holiday','عطلة','2024-02-28 07:26:45','2024-02-28 08:06:11'),(209,1,'Holiday Types','Holiday Types','2024-02-28 07:26:45','2024-02-28 07:26:45'),(210,2,'Holiday Types','أنواع العطلات','2024-02-28 07:26:45','2024-02-28 08:06:22'),(211,1,'Approved Applications','Approved Applications','2024-02-28 07:26:45','2024-02-28 07:26:45'),(212,2,'Approved Applications','التطبيقات المعتمدة','2024-02-28 07:26:45','2024-02-28 07:44:11'),(213,1,'Denied Applications','Rejected Applications','2024-02-28 07:26:45','2024-04-21 18:45:09'),(214,2,'Denied Applications','الطلبات المرفوضة','2024-02-28 07:26:45','2024-02-28 07:56:30'),(215,1,'Pending Applications','Pending Applications','2024-02-28 07:26:45','2024-02-28 07:26:45'),(216,2,'Pending Applications','الطلبات المعلقة','2024-02-28 07:26:45','2024-02-28 08:13:02'),(217,1,'Leave Withdrawal','Cancel Leave','2024-02-28 07:26:45','2024-04-21 18:45:33'),(218,2,'Leave Withdrawal','الغاء الاجازة','2024-02-28 07:26:45','2024-02-29 00:34:30'),(219,1,'Approved','Approved','2024-02-28 07:26:45','2024-02-28 07:26:45'),(220,2,'Approved','موافقة','2024-02-28 07:26:45','2024-02-28 07:44:00'),(221,1,'Denied','Denied','2024-02-28 07:26:45','2024-02-28 07:26:45'),(222,2,'Denied','رفض','2024-02-28 07:26:45','2024-02-28 07:56:17'),(223,1,'Pending','Pending','2024-02-28 07:26:45','2024-02-28 07:26:45'),(224,2,'Pending','قيد الانتظار','2024-02-28 07:26:45','2024-02-28 08:12:50'),(225,1,'Running','Running','2024-02-28 07:26:45','2024-02-28 07:26:45'),(226,2,'Running','عمل','2024-02-28 07:26:45','2024-02-28 08:17:58'),(227,1,'Solved','Solved','2024-02-28 07:26:45','2024-02-28 07:26:45'),(228,2,'Solved','تم حلها','2024-02-28 07:26:45','2024-02-28 08:19:37'),(229,1,'Topics','Topics','2024-02-28 07:26:45','2024-02-28 07:26:45'),(230,2,'Topics','المواضيع','2024-02-28 07:26:45','2024-02-28 08:21:42'),(231,1,'Loan Types','Loan Types','2024-02-28 07:26:45','2024-02-28 07:26:45'),(232,2,'Loan Types','أنواع القروض','2024-02-28 07:26:45','2024-02-28 08:09:52'),(233,1,'Loan Rules','Loan Rules','2024-02-28 07:26:45','2024-02-28 07:26:45'),(234,2,'Loan Rules','قواعد القرض','2024-02-28 07:26:45','2024-02-28 08:09:34'),(235,1,'Pending Loans','Pending Loans','2024-02-28 07:26:45','2024-02-28 07:26:45'),(236,2,'Pending Loans','طلبات القروض المعلقة','2024-02-28 07:26:45','2024-04-23 02:24:41'),(237,1,'Running Loans','Running Loans','2024-02-28 07:26:45','2024-02-28 07:26:45'),(238,2,'Running Loans','طلبات القروض الجارية','2024-02-28 07:26:45','2024-04-23 02:25:40'),(239,1,'Completed Loans','Completed Loans','2024-02-28 07:26:45','2024-02-28 07:26:45'),(240,2,'Completed Loans','طلبات القروض المكتملة','2024-02-28 07:26:45','2024-04-23 02:23:32'),(241,1,'Denied Loans','Denied Loans','2024-02-28 07:26:45','2024-02-28 07:26:45'),(242,2,'Denied Loans','طلبات القروض المرفوضة','2024-02-28 07:26:45','2024-04-23 02:23:17'),(243,1,'Salary Heads','Salary Heads','2024-02-28 07:26:45','2024-02-28 07:26:45'),(244,2,'Salary Heads','تفصيلة الراتب','2024-02-28 07:26:45','2024-05-28 20:20:34'),(245,1,'Attendance Based Salary Heads','Attendance Based Salary Heads','2024-02-28 07:26:45','2024-02-28 07:26:45'),(246,2,'Attendance Based Salary Heads','رؤساء الرواتب على أساس الحضور','2024-02-28 07:26:45','2024-02-28 07:47:49'),(247,1,'Taxes','Taxes','2024-02-28 07:26:45','2024-02-28 07:26:45'),(248,2,'Taxes','الضرائب','2024-02-28 07:26:45','2024-02-28 08:21:03'),(249,1,'Generate Payroll','Generate Payroll','2024-02-28 07:26:45','2024-02-28 07:26:45'),(250,2,'Generate Payroll','إنشاء كشوف المرتبات','2024-02-28 07:26:45','2024-02-28 08:05:48'),(251,1,'View Payroll','View Payroll','2024-02-28 07:26:45','2024-02-28 07:26:45'),(252,2,'View Payroll','عرض كشوف المرتبات','2024-02-28 07:26:45','2024-02-28 08:22:38'),(253,1,'Bank Reports','Bank Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(254,2,'Bank Reports','تقارير البنك','2024-02-28 07:26:45','2024-02-28 07:50:42'),(255,1,'Cash Reports','Cash Reports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(256,2,'Cash Reports','التقارير النقدية','2024-02-28 07:26:45','2024-02-28 07:52:15'),(257,1,'View Payrolls','View Payrolls','2024-02-28 07:26:45','2024-02-28 07:26:45'),(258,2,'View Payrolls','عرض كشوف المرتبات','2024-02-28 07:26:45','2024-02-28 08:22:47'),(259,1,'Poor Fund','Poor Fund','2024-02-28 07:26:45','2024-02-28 07:26:45'),(260,2,'Poor Fund','صندوق الفقراء','2024-02-28 07:26:45','2024-02-28 08:14:38'),(261,1,'Provident Fund','Provident Fund','2024-02-28 07:26:45','2024-02-28 07:26:45'),(262,2,'Provident Fund','صندوق الادخار','2024-02-28 07:26:45','2024-02-28 08:15:57'),(263,1,'PF Settings','Provident Fund Settings','2024-02-28 07:26:45','2024-02-28 08:14:28'),(264,2,'PF Settings','إعدادات صندوق الادخار','2024-02-28 07:26:45','2024-02-28 08:14:28'),(265,1,'Publishment Types','Publishment Types','2024-02-28 07:26:45','2024-02-28 07:26:45'),(266,2,'Publishment Types','أنواع النشر','2024-02-28 07:26:45','2024-02-28 08:16:29'),(267,1,'Permissions','Permissions','2024-02-28 07:26:45','2024-02-28 07:26:45'),(268,2,'Permissions','الأذونات','2024-02-28 07:26:45','2024-02-28 08:13:42'),(269,1,'Company','Company','2024-02-28 07:26:45','2024-02-28 07:26:45'),(270,2,'Company','الشركة','2024-02-28 07:26:45','2024-05-28 19:13:51'),(271,1,'Project','Project','2024-02-28 07:26:45','2024-02-28 07:26:45'),(272,2,'Project','مشروع','2024-02-28 07:26:45','2024-02-28 08:15:16'),(273,1,'Postings','Postings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(274,2,'Postings','منشورات','2024-02-28 07:26:45','2024-02-28 08:14:56'),(275,1,'National IDs','National IDs','2024-02-28 07:26:45','2024-02-28 07:26:45'),(276,2,'National IDs','الهويات الوطنية','2024-02-28 07:26:45','2024-02-28 08:11:03'),(277,1,'Passports','Passports','2024-02-28 07:26:45','2024-02-28 07:26:45'),(278,2,'Passports','جوازات السفر','2024-02-28 07:26:45','2024-02-28 08:11:57'),(279,1,'Labour Cards','Labour Cards','2024-02-28 07:26:45','2024-02-28 07:26:45'),(280,2,'Labour Cards','بطاقات العمل','2024-02-28 07:26:45','2024-02-28 08:07:45'),(281,1,'Timing Settings','Timing Settings','2024-02-28 07:26:45','2024-02-28 07:26:45'),(282,2,'Timing Settings','إعدادات التوقيت','2024-02-28 07:26:45','2024-02-28 08:21:32'),(283,1,'Insurances','Insurances','2024-02-28 07:26:45','2024-02-28 07:26:45'),(284,2,'Insurances','التأمينات','2024-02-28 07:26:45','2024-02-28 08:06:54'),(285,1,'Generate Project Payroll','Generate Project Payroll','2024-02-28 07:26:45','2024-02-28 07:26:45'),(286,2,'Generate Project Payroll','إنشاء كشوف مرتبات المشروع','2024-02-28 07:26:45','2024-02-28 08:05:59'),(287,1,'Project wise Payroll Calculations','Project wise Payroll Calculations','2024-02-28 07:26:45','2024-02-28 07:26:45'),(288,2,'Project wise Payroll Calculations','حسابات الرواتب للمشروع','2024-02-28 07:26:45','2024-04-21 20:59:22'),(289,1,'Country','Country','2024-02-28 07:26:45','2024-02-28 07:26:45'),(290,2,'Country','الدولة','2024-02-28 07:26:45','2024-05-28 19:18:46'),(291,1,'Delete Project Payroll','Delete Project Payroll','2024-02-28 07:26:45','2024-02-28 07:26:45'),(292,2,'Delete Project Payroll','حذف كشوف رواتب المشروع','2024-02-28 07:26:45','2024-02-28 07:56:07'),(293,1,'Crons','Crons','2024-02-28 07:26:45','2024-02-28 07:26:45'),(294,2,'Crons','المهام المجدولة','2024-02-28 07:26:45','2024-03-01 03:05:39'),(295,1,'Project Wise Shift Change','Project Wise Shift Change','2024-02-28 07:26:45','2024-02-28 07:26:45'),(296,2,'Project Wise Shift Change','تغيير الوردية حسب المشروع','2024-02-28 07:26:45','2024-04-21 20:59:13'),(297,1,'Home','Home','2024-02-28 07:28:46','2024-02-28 07:28:46'),(298,2,'Home','الرئيسية','2024-02-28 07:28:46','2024-02-29 00:44:33'),(299,1,'Attendance and Payroll Calculations','Attendance & Payroll Calculations','2024-02-28 07:47:16','2024-02-28 07:47:16'),(300,2,'Attendance and Payroll Calculations','الحضور وحسابات الرواتب','2024-02-28 07:47:16','2024-02-28 07:47:16'),(301,1,'My Profile','My Profile','2024-02-28 08:26:59','2024-02-28 08:26:59'),(302,2,'My Profile','ملفي','2024-02-28 08:26:59','2024-02-28 08:26:59'),(303,1,'My Image','My Image','2024-02-28 08:27:11','2024-02-28 08:27:11'),(304,2,'My Image','صورتي','2024-02-28 08:27:11','2024-02-28 08:27:11'),(305,1,'Change Password','Change Password','2024-02-28 08:27:33','2024-02-28 08:27:33'),(306,2,'Change Password','تغيير كلمة المرور','2024-02-28 08:27:33','2024-02-28 08:27:33'),(307,1,'Log Out','Log Out','2024-02-28 08:27:43','2024-02-28 08:27:43'),(308,2,'Log Out','تسجيل خروج','2024-02-28 08:27:43','2024-02-28 08:27:43'),(309,1,'Copyright','Copyright','2024-02-28 08:28:52','2024-02-28 08:28:52'),(310,2,'Copyright','حقوق النشر','2024-02-28 08:28:52','2024-02-28 08:28:52'),(311,1,'All rights reserved','All rights reserved','2024-02-28 08:29:10','2024-02-28 08:29:10'),(312,2,'All rights reserved','جميع الحقوق محفوظة','2024-02-28 08:29:10','2024-05-28 19:14:09'),(313,1,'Data has been deleted','Data has been deleted','2024-02-28 08:29:43','2024-02-28 08:29:43'),(314,2,'Data has been deleted','تم حذف البيانات','2024-02-28 08:29:43','2024-02-28 08:29:43'),(315,1,'Something went wrong!','Something went wrong!','2024-02-28 08:30:07','2024-02-28 08:30:07'),(316,2,'Something went wrong!','هناك خطأ ما!','2024-02-28 08:30:07','2024-02-28 08:30:07'),(317,1,'Are you sure to delete ?','Are you sure to delete ?','2024-02-28 08:30:29','2024-02-28 08:30:29'),(318,2,'Are you sure to delete ?','هل انت متأكد من الحذف ؟','2024-02-28 08:30:29','2024-02-28 08:30:29'),(319,1,'Please wait...','Please wait...','2024-02-28 08:30:50','2024-02-28 08:30:50'),(320,2,'Please wait...','انتظر من فضلك...','2024-02-28 08:30:50','2024-02-28 08:30:50'),(321,1,'Check In','Check In','2024-02-28 09:46:13','2024-02-28 09:46:13'),(322,2,'Check In','تسجيل الدخول','2024-02-28 09:46:13','2024-03-01 02:44:12'),(323,1,'Check Out','Check Out','2024-02-28 09:46:13','2024-02-28 09:46:13'),(324,2,'Check Out','تسجيل الخروج','2024-02-28 09:46:13','2024-03-01 02:44:21'),(325,1,'Backdated Check In/Out','Backdated Check In/Out','2024-02-28 09:46:13','2024-02-28 09:46:13'),(326,2,'Backdated Check In/Out','تسجيل الدخول والخروج بأثر رجعي','2024-02-28 09:46:13','2024-02-28 09:56:29'),(327,1,'Search','Search','2024-02-28 09:46:13','2024-02-28 09:46:13'),(328,2,'Search','بحث','2024-02-28 09:46:13','2024-04-23 02:19:58'),(329,1,'Events','Events','2024-02-28 09:46:13','2024-02-28 09:46:13'),(330,2,'Events','الأحداث','2024-02-28 09:46:13','2024-02-28 09:56:51'),(331,1,'Checked In','Checked In','2024-02-28 10:01:38','2024-02-28 10:01:38'),(332,2,'Checked In','تم تسجيل الدخول','2024-02-28 10:01:38','2024-03-01 02:49:44'),(333,1,'checked out','checked out','2024-02-28 10:01:56','2024-02-28 10:01:56'),(334,2,'checked out','فحصت','2024-02-28 10:01:56','2024-02-28 10:01:56'),(335,1,'Are you sure ?','Are you sure ?','2024-02-28 10:02:47','2024-02-28 10:02:47'),(336,2,'Are you sure ?','هل أنت متأكد ؟','2024-02-28 10:02:47','2024-02-28 10:02:47'),(337,1,'Yes','Yes','2024-02-28 10:02:58','2024-02-28 10:02:58'),(338,2,'Yes','نعم','2024-02-28 10:02:58','2024-02-28 10:02:58'),(339,1,'No','No','2024-02-28 10:03:25','2024-02-28 10:03:25'),(340,2,'No','لا','2024-02-28 10:03:25','2024-02-28 10:03:25'),(341,1,'Confirm','Confirm','2024-02-28 10:04:04','2024-02-28 10:04:04'),(342,2,'Confirm','التأكيد','2024-02-28 10:04:04','2024-02-28 10:23:11'),(351,1,'Apply Leave Here','Apply Leave Here','2024-04-21 12:08:15','2024-04-21 12:08:15'),(352,2,'Apply Leave Here','تقديم الاجازة','2024-04-21 12:08:15','2024-04-21 12:08:15'),(353,1,'Delete All','Delete All','2024-04-21 12:08:29','2024-04-21 12:08:29'),(354,2,'Delete All','الغاء الكل','2024-04-21 12:08:29','2024-04-21 12:08:29'),(355,1,'Deny All','Deny All','2024-04-21 12:08:45','2024-04-21 12:08:45'),(356,2,'Deny All','تجاهل الكل','2024-04-21 12:08:45','2024-04-21 12:08:45'),(357,1,'Approve All','Approve All','2024-04-21 12:09:09','2024-04-21 12:09:09'),(358,2,'Approve All','الموافقة للكل','2024-04-21 12:09:09','2024-04-21 12:09:09'),(359,1,'Sick Leave','Sick Leave','2024-04-21 12:09:31','2024-04-21 12:09:31'),(360,2,'Sick Leave','اجازة مرضية','2024-04-21 12:09:31','2024-04-21 12:09:31'),(361,1,'Haj Leave','Haj Leave','2024-04-21 12:10:07','2024-04-21 12:10:07'),(362,2,'Haj Leave','اجازة حج','2024-04-21 12:10:07','2024-04-21 12:10:07'),(363,1,'Death of a first or second grade','Death of a first or second grade','2024-04-21 12:10:24','2024-04-21 12:10:24'),(364,2,'Death of a first or second grade','الوفاة من الدرجة الاولى أو الثانية','2024-04-21 12:10:24','2024-04-21 12:10:24'),(365,1,'Annual Leave','Annual Leave','2024-04-21 12:10:51','2024-04-21 12:10:51'),(366,2,'Annual Leave','اجازة سنوية','2024-04-21 12:10:51','2024-04-21 12:10:51'),(367,1,'Pay Type','Pay Type','2024-04-21 12:11:04','2024-04-21 12:11:04'),(368,2,'Pay Type','طريقة الدفع','2024-04-21 12:11:04','2024-04-21 12:11:04'),(369,1,'Paid with Salary','Paid with Salary','2024-04-21 12:11:22','2024-04-21 12:11:22'),(370,2,'Paid with Salary','الدفع مع الراتب','2024-04-21 12:11:22','2024-04-21 12:11:22'),(371,1,'Paid in Advance','Paid in Advance','2024-04-21 12:11:39','2024-04-21 12:11:39'),(372,2,'Paid in Advance','الدفع مقدما','2024-04-21 12:11:39','2024-04-21 12:11:39'),(373,1,'Date From','Date From','2024-04-21 12:11:54','2024-04-21 12:11:54'),(374,2,'Date From','التاريخ من','2024-04-21 12:11:54','2024-04-21 12:11:54'),(375,1,'Date To','Date To','2024-04-21 12:12:07','2024-04-21 12:12:07'),(376,2,'Date To','التاريخ الى','2024-04-21 12:12:07','2024-04-21 12:12:07'),(377,1,'Reason','Reason','2024-04-21 12:12:27','2024-04-21 12:12:27'),(378,2,'Reason','السبب','2024-04-21 12:12:27','2024-04-21 12:12:27'),(379,1,'Notes','Notes','2024-04-21 12:12:41','2024-04-21 12:12:41'),(380,2,'Notes','ملاحظات','2024-04-21 12:12:41','2024-04-21 12:12:41'),(381,1,'Starts From','Starts From','2024-04-21 12:12:54','2024-04-21 12:12:54'),(382,2,'Starts From','البداية من','2024-04-21 12:12:54','2024-04-21 12:12:54'),(383,1,'Ends To','Ends To','2024-04-21 12:13:09','2024-04-21 12:13:09'),(384,2,'Ends To','لنهاية في','2024-04-21 12:13:09','2024-04-21 12:13:09'),(385,1,'Full Day','Full Day','2024-04-21 12:13:33','2024-04-21 12:13:33'),(386,2,'Full Day','يوم كامل','2024-04-21 12:13:33','2024-04-21 12:13:33'),(387,1,'Half Day (First Half)','Half Day (First Half)','2024-04-21 12:14:01','2024-04-21 12:14:01'),(388,2,'Half Day (First Half)','نصف يوم (النصف الاول)','2024-04-21 12:14:01','2024-04-21 12:14:01'),(389,1,'Half Day (Second Half)','Half Day (Second Half)','2024-04-21 12:14:23','2024-04-21 12:14:23'),(390,2,'Half Day (Second Half)','نصف يوم (النصف الثاني)','2024-04-21 12:14:23','2024-04-21 12:14:23'),(391,1,'Leave Balance','Leave Balance','2024-04-21 12:14:47','2024-04-21 12:14:47'),(392,2,'Leave Balance','رصيد الاجازات','2024-04-21 12:14:47','2024-04-21 12:14:47'),(393,1,'Qouta','Qouta','2024-04-21 12:15:02','2024-04-21 12:15:02'),(394,2,'Qouta','العدد','2024-04-21 12:15:02','2024-04-21 12:15:02'),(395,1,'Taken','ما تم استخدامه','2024-04-21 12:15:19','2024-04-21 12:15:19'),(396,2,'Taken','ما تم استخدامه','2024-04-21 12:15:19','2024-04-21 12:15:19'),(397,1,'Payrolls','Payrolls','2024-04-21 12:27:31','2024-04-21 12:27:31'),(398,2,'Payrolls','الرواتب','2024-04-21 12:27:31','2024-04-21 12:27:31'),(399,1,'Apply Leave','Apply Leave','2024-04-21 18:37:01','2024-04-21 18:37:01'),(400,2,'Apply Leave','تقديم الاجازة','2024-04-21 18:37:01','2024-04-21 18:37:01'),(401,1,'Close','Close','2024-04-21 18:37:12','2024-04-21 18:37:12'),(402,2,'Close','اغلاق','2024-04-21 18:37:12','2024-04-21 18:37:12'),(403,1,'Apply for Leave','Apply for Leave','2024-04-21 18:37:25','2024-04-21 18:37:25'),(404,2,'Apply for Leave','تقديم طلب الاجازة','2024-04-21 18:37:25','2024-04-21 18:37:25'),(405,1,'Duty Roaster Report','Duty Roaster Report','2024-04-21 20:50:52','2024-04-21 20:50:52'),(406,2,'Duty Roaster Report','تقرير جدول المهام','2024-04-21 20:50:52','2024-04-21 20:50:52'),(407,1,'Working from Home','Working from Home','2024-04-22 00:13:30','2024-04-22 00:13:30'),(408,2,'Working from Home','العمل من المنزل','2024-04-22 00:13:30','2024-04-22 00:13:30'),(409,1,'Payroll Type','Payroll Type','2024-04-23 02:17:33','2024-04-23 02:17:33'),(410,2,'Payroll Type','نوع الراتب','2024-04-23 02:17:33','2024-04-23 02:17:33'),(411,1,'Year','Year','2024-04-23 02:17:59','2024-04-23 02:17:59'),(412,2,'Year','السنة','2024-04-23 02:17:59','2024-04-23 02:17:59'),(413,1,'Month','Month','2024-04-23 02:18:16','2024-04-23 02:18:16'),(414,2,'Month','الشهر','2024-04-23 02:18:16','2024-04-23 02:18:16'),(415,1,'From','From','2024-04-23 02:18:30','2024-04-23 02:18:30'),(416,2,'From','من','2024-04-23 02:18:30','2024-04-23 02:18:30'),(417,1,'To','To','2024-04-23 02:18:44','2024-04-23 02:18:44'),(418,2,'To','إلى','2024-04-23 02:18:44','2024-04-23 02:18:44'),(419,1,'Generate Payrolls','Generate Payrolls','2024-04-23 02:19:38','2024-04-23 02:19:38'),(420,2,'Generate Payrolls','تجهيز كشوف الرواتب','2024-04-23 02:19:38','2024-04-23 02:19:38'),(421,1,'search here','Search Here','2024-04-23 02:20:54','2024-04-23 02:20:54'),(422,2,'search here','ابحث هنا','2024-04-23 02:20:54','2024-04-23 02:20:54'),(423,1,'days','days','2024-04-23 02:21:25','2024-04-23 02:21:25'),(424,2,'days','ايام','2024-04-23 02:21:25','2024-05-28 19:14:52'),(425,1,'Name','Name','2024-05-28 19:16:22','2024-05-28 19:16:22'),(426,2,'Name','الاسم','2024-05-28 19:16:22','2024-05-28 19:16:22'),(427,1,'Designation','Designation','2024-05-28 19:16:56','2024-05-28 19:16:56'),(428,2,'Designation','الوظيفة','2024-05-28 19:16:56','2024-05-28 19:16:56'),(429,1,'Finger Print No','Finger Print No','2024-05-28 19:17:58','2024-05-28 19:17:58'),(430,2,'Finger Print No','رقم جهاز البصمة','2024-05-28 19:17:58','2024-05-28 19:17:58'),(431,1,'Machine ID','Machine ID','2024-05-28 19:18:36','2024-05-28 19:18:36'),(432,2,'Machine ID','رقم ماكينة البصمة','2024-05-28 19:18:36','2024-05-28 19:18:36'),(433,1,'Basic Info','Basic Info','2024-05-28 19:19:14','2024-05-28 19:19:14'),(434,2,'Basic Info','المعلومات الاساسية','2024-05-28 19:19:14','2024-05-28 19:19:14'),(435,1,'Edit','Edit','2024-05-28 19:20:52','2024-05-28 19:20:52'),(436,2,'Edit','تحرير','2024-05-28 19:20:52','2024-05-28 19:20:52'),(437,1,'Reporting Manager','Reporting Manager','2024-05-28 19:21:33','2024-05-28 19:21:33'),(438,2,'Reporting Manager','المدير المباشر','2024-05-28 19:21:33','2024-05-28 19:21:33'),(439,1,'First Name (English (US))','First Name (English (US))','2024-05-28 19:21:57','2024-05-28 19:21:57'),(440,2,'First Name (English (US))','الإسم الأول باللغة الإنجليزية','2024-05-28 19:21:57','2024-05-28 19:21:57'),(441,1,'Authorized Manager','Authorized Manager','2024-05-28 19:22:09','2024-05-28 19:22:09'),(442,2,'Authorized Manager','المدير المفوض','2024-05-28 19:22:09','2024-05-28 19:22:09'),(443,1,'Biotime Employee','Biotime Employee','2024-05-28 19:22:29','2024-05-28 19:22:29'),(444,2,'Biotime Employee','اسم الموظف بجهاز البصمة','2024-05-28 19:22:29','2024-05-28 19:22:29'),(445,1,'Division','Division','2024-05-28 19:22:39','2024-05-28 19:22:39'),(446,2,'Division','القطاع','2024-05-28 19:22:39','2024-05-28 19:22:39'),(447,1,'First Name (Arabic (Kuwait))','First Name (Arabic (Kuwait))','2024-05-28 19:22:47','2024-05-28 19:22:47'),(448,2,'First Name (Arabic (Kuwait))','الإسم الأول باللغة العربية','2024-05-28 19:22:47','2024-05-28 19:22:47'),(449,1,'Sub-Division','Sub-Division','2024-05-28 19:22:59','2024-05-28 19:22:59'),(450,2,'Sub-Division','القطاع الفرعي','2024-05-28 19:22:59','2024-05-28 19:22:59'),(451,1,'Team','Team','2024-05-28 19:23:13','2024-05-28 19:23:13'),(452,2,'Team','الفريق','2024-05-28 19:23:13','2024-05-28 19:23:13'),(453,1,'Job Level','Job Level','2024-05-28 19:23:50','2024-05-28 19:23:50'),(454,2,'Job Level','المستوى الوظيفي','2024-05-28 19:23:50','2024-05-28 19:23:50'),(455,1,'Middle Name (English (US))','Middle Name (English (US))','2024-05-28 19:23:55','2024-05-28 19:23:55'),(456,2,'Middle Name (English (US))','الإسم الأوسط باللغة الإنجليزية','2024-05-28 19:23:55','2024-05-28 19:23:55'),(457,1,'Job Location','Job Location','2024-05-28 19:24:14','2024-05-28 19:24:14'),(458,2,'Job Location','مكان العمل','2024-05-28 19:24:14','2024-05-28 19:24:14'),(459,1,'Category','Category','2024-05-28 19:24:25','2024-05-28 19:24:25'),(460,2,'Category','التصنيف','2024-05-28 19:24:25','2024-05-28 19:24:25'),(461,1,'Middle Name (Arabic (Kuwait))','Middle Name (Arabic (Kuwait))','2024-05-28 19:24:29','2024-05-28 19:24:29'),(462,2,'Middle Name (Arabic (Kuwait))','الإسم الأوسط باللغة العربية','2024-05-28 19:24:29','2024-05-28 19:24:29'),(463,1,'Brand','Brand','2024-05-28 19:25:08','2024-05-28 19:25:08'),(464,2,'Brand','العلامة التجارية','2024-05-28 19:25:08','2024-05-28 19:25:08'),(465,1,'Last Name (English (US))','Last Name (English (US))','2024-05-28 19:25:17','2024-05-28 19:25:17'),(466,2,'Last Name (English (US))','الإسم الأخير باللغة الإنجليزية','2024-05-28 19:25:17','2024-05-28 19:25:17'),(467,1,'Legal Entity','Legal Entity','2024-05-28 19:25:42','2024-05-28 19:25:42'),(468,2,'Legal Entity','الكيان القانوني','2024-05-28 19:25:42','2024-05-28 19:25:42'),(469,1,'Last Name (Arabic (Kuwait))','Last Name (Arabic (Kuwait))','2024-05-28 19:26:01','2024-05-28 19:26:01'),(470,2,'Last Name (Arabic (Kuwait))','الإسم الأخير باللغة العربية','2024-05-28 19:26:01','2024-05-28 19:26:01'),(471,1,'Gender','Gender','2024-05-28 19:26:26','2024-05-28 19:26:26'),(472,2,'Gender','النوع','2024-05-28 19:26:26','2024-05-28 19:26:26'),(473,1,'female','female','2024-05-28 19:28:02','2024-05-28 19:28:02'),(474,2,'female','أنثى','2024-05-28 19:28:02','2024-05-28 19:28:02'),(475,1,'male','male','2024-05-28 19:29:26','2024-05-28 19:29:26'),(476,2,'male','ذكر','2024-05-28 19:29:26','2024-05-28 19:29:26'),(477,1,'others','others','2024-05-28 19:30:12','2024-05-28 19:30:12'),(478,2,'others','أخرى','2024-05-28 19:30:12','2024-05-28 19:30:12'),(479,1,'Religion','Religion','2024-05-28 19:37:45','2024-05-28 19:37:45'),(480,2,'Religion','الديانة','2024-05-28 19:37:45','2024-05-28 20:15:16'),(481,1,'muslim','muslim','2024-05-28 19:38:50','2024-05-28 19:38:50'),(482,2,'muslim','مسلم','2024-05-28 19:38:50','2024-05-28 19:38:50'),(483,1,'Packco Head Office','Packco Head Office','2024-05-28 19:40:08','2024-05-28 19:40:08'),(484,2,'Packco Head Office','المكتب الرئيسي - باكو','2024-05-28 19:40:08','2024-05-28 19:40:08'),(485,1,'Permanent','Permanent','2024-05-28 19:40:30','2024-05-28 19:40:30'),(486,2,'Permanent','دائم','2024-05-28 19:40:30','2024-05-28 19:40:30'),(487,1,'christian','christian','2024-05-28 19:41:00','2024-05-28 19:41:00'),(488,2,'christian','مسيحى','2024-05-28 19:41:00','2024-05-28 19:41:00'),(489,1,'Basic Information','Basic Information','2024-05-28 19:45:13','2024-05-28 19:45:13'),(490,2,'Basic Information','البيانات الأساسية','2024-05-28 19:45:13','2024-05-28 19:45:13'),(491,1,'Fixed ?','Fixed ?','2024-05-28 19:45:51','2024-05-28 19:45:51'),(492,2,'Fixed ?','ثابت ؟','2024-05-28 19:45:51','2024-05-28 19:45:51'),(493,1,'Fixed','Fixed','2024-05-28 19:46:26','2024-05-28 19:46:26'),(494,2,'Fixed','ثابت','2024-05-28 19:46:26','2024-05-28 19:46:26'),(495,1,'Last Name','Last Name','2024-05-28 19:47:07','2024-05-28 19:47:07'),(496,2,'Last Name','الاسم الاخير','2024-05-28 19:47:07','2024-05-28 19:47:07'),(497,1,'English (US)','English (US)','2024-05-28 19:47:33','2024-05-28 19:47:33'),(498,2,'English (US)','الانجليزية','2024-05-28 19:47:33','2024-05-28 19:47:33'),(499,1,'Arabic (Kuwait)','Arabic (Kuwait)','2024-05-28 19:47:57','2024-05-28 19:47:57'),(500,2,'Arabic (Kuwait)','العربية','2024-05-28 19:47:57','2024-05-28 19:47:57'),(501,1,'Middle Name','Middle Name','2024-05-28 19:49:05','2024-05-28 19:49:05'),(502,2,'Middle Name','الاسم الأوسط','2024-05-28 19:49:05','2024-05-28 19:49:05'),(503,1,'First Name','First Name','2024-05-28 19:49:29','2024-05-28 19:49:29'),(504,2,'First Name','الإسم الأول','2024-05-28 19:49:29','2024-05-28 19:49:29'),(505,1,'Employee Number','Employee Number','2024-05-28 19:50:20','2024-05-28 19:50:20'),(506,2,'Employee Number','الرقم الوظيفي','2024-05-28 19:50:20','2024-05-28 19:50:20'),(507,1,'Authorized Person','Authorized Person','2024-05-28 19:50:36','2024-05-28 19:50:36'),(508,2,'Authorized Person','الشخص المفوض','2024-05-28 19:50:36','2024-05-28 19:50:36'),(509,1,'Official Information','Official Information','2024-05-28 19:50:57','2024-05-28 19:50:57'),(510,2,'Official Information','البيانات الرسمية','2024-05-28 19:50:57','2024-05-28 19:50:57'),(511,1,'Vehicle','Vehicle','2024-05-28 19:51:28','2024-05-28 19:51:28'),(512,2,'Vehicle','لديه سيارة','2024-05-28 19:51:28','2024-05-28 19:51:28'),(513,1,'Email Address','Email Address','2024-05-28 19:51:42','2024-05-28 19:51:42'),(514,2,'Email Address','الايميل','2024-05-28 19:51:42','2024-05-28 19:51:42'),(515,1,'Joinning Date','Joinning Date','2024-05-28 19:52:04','2024-05-28 19:52:04'),(516,2,'Joinning Date','تاريخ مباشرة العمل','2024-05-28 19:52:04','2024-05-28 19:52:04'),(517,1,'Date of Birth','Date of Birth','2024-05-28 19:52:30','2024-05-28 19:52:30'),(518,2,'Date of Birth','تاريخ الميلاد','2024-05-28 19:52:30','2024-05-28 19:52:30'),(519,1,'Details Information','Details Information','2024-05-28 19:52:55','2024-05-28 19:52:55'),(520,2,'Details Information','معلومات اضافية','2024-05-28 19:52:55','2024-05-28 19:52:55'),(521,1,'Date of Birth (Official)','Date of Birth (Official)','2024-05-28 19:57:39','2024-05-28 19:57:39'),(522,2,'Date of Birth (Official)','تاريخ الميلاد (رسمي)','2024-05-28 19:57:39','2024-05-28 19:57:39'),(523,1,'Date of Birth (Actual)','Date of Birth (Actual)','2024-05-28 19:58:14','2024-05-28 19:58:14'),(524,2,'Date of Birth (Actual)','تاريخ الميلاد (الفعلي)','2024-05-28 19:58:14','2024-05-28 19:58:14'),(525,1,'Confirmation Date','Confirmation Date','2024-05-28 19:59:27','2024-05-28 19:59:27'),(526,2,'Confirmation Date','تاريخ تأكيد التعيين','2024-05-28 19:59:27','2024-05-28 19:59:27'),(527,1,'Weekends','Weekends','2024-05-28 19:59:54','2024-05-28 19:59:54'),(528,2,'Weekends','العطل الاسبوعية','2024-05-28 19:59:54','2024-05-28 19:59:54'),(529,1,'Blood','Blood Type','2024-05-28 20:00:46','2024-05-28 20:00:46'),(530,2,'Blood','فصيلة الدم','2024-05-28 20:00:46','2024-05-28 20:00:46'),(531,1,'Current Address','Current Address','2024-05-28 20:01:12','2024-05-28 20:01:12'),(532,2,'Current Address','العنوان الحالي','2024-05-28 20:01:12','2024-05-28 20:01:12'),(533,1,'Permanent Address','Permanent Address','2024-05-28 20:01:25','2024-05-28 20:01:25'),(534,2,'Permanent Address','العنوان الدائم','2024-05-28 20:01:25','2024-05-28 20:01:25'),(535,1,'Father Name','Father Name','2024-05-28 20:01:46','2024-05-28 20:01:46'),(536,2,'Father Name','اسم الأب','2024-05-28 20:01:46','2024-05-28 20:01:46'),(537,1,'Mother Name','Mother Name','2024-05-28 20:02:02','2024-05-28 20:02:02'),(538,2,'Mother Name','اسم الأم','2024-05-28 20:02:02','2024-05-28 20:02:02'),(539,1,'Marital Status','Marital Status','2024-05-28 20:02:23','2024-05-28 20:02:23'),(540,2,'Marital Status','الحالة الاجتماعية','2024-05-28 20:02:23','2024-05-28 20:02:23'),(541,1,'Spouse Name','Spouse Name','2024-05-28 20:03:15','2024-05-28 20:03:15'),(542,2,'Spouse Name','اسم الزوج/الزوجة','2024-05-28 20:03:15','2024-05-28 20:03:15'),(543,1,'Emg. Contact No.','Emg. Contact No.','2024-05-28 20:03:41','2024-05-28 20:03:41'),(544,2,'Emg. Contact No.','رقم الاتصال في حالات الطوارئ','2024-05-28 20:03:41','2024-05-28 20:03:41'),(545,1,'Emg. Contact Person','Emg. Contact Person','2024-05-28 20:04:17','2024-05-28 20:04:17'),(546,2,'Emg. Contact Person','الشخص المعني في حالات الطوارئ','2024-05-28 20:04:17','2024-05-28 20:04:17'),(547,1,'Relation with Emg. Contact Person','Relation with Emg. Contact Person','2024-05-28 20:05:10','2024-05-28 20:05:10'),(548,2,'Relation with Emg. Contact Person','قرابة حالة الطوارئ','2024-05-28 20:05:10','2024-05-28 20:05:10'),(549,1,'Health Issues','Health Issues','2024-05-28 20:05:28','2024-05-28 20:05:28'),(550,2,'Health Issues','الحالات الصحية','2024-05-28 20:05:28','2024-05-28 20:05:28'),(551,1,'Contact & Family Information','Contact & Family Information','2024-05-28 20:06:08','2024-05-28 20:06:08'),(552,2,'Contact & Family Information','معلومات الاتصال والعائلة','2024-05-28 20:06:08','2024-05-28 20:06:08'),(553,1,'OT','OT','2024-05-28 20:06:34','2024-05-28 20:06:34'),(554,2,'OT','اضافي','2024-05-28 20:06:34','2024-05-28 20:06:34'),(555,1,'Phone no.','Phone no.','2024-05-28 20:07:07','2024-05-28 20:07:07'),(556,2,'Phone no.','رقم الهاتف','2024-05-28 20:07:07','2024-05-28 20:07:07'),(557,1,'Confirm Password','Confirm Password','2024-05-28 20:08:12','2024-05-28 20:08:12'),(558,2,'Confirm Password','تأكيد الرقم السرى','2024-05-28 20:08:12','2024-05-28 20:08:12'),(559,1,'New Password','New Password','2024-05-28 20:09:31','2024-05-28 20:09:31'),(560,2,'New Password','الرقم السرى الجديد','2024-05-28 20:09:31','2024-05-28 20:09:31'),(561,1,'New Employee +','New Employee +','2024-05-28 20:09:34','2024-05-28 20:09:34'),(562,2,'New Employee +','إضافة موظف +','2024-05-28 20:09:34','2024-05-28 20:09:34'),(563,1,'New Employee','New Employee','2024-05-28 20:09:57','2024-05-28 20:09:57'),(564,2,'New Employee','إضافة موظف','2024-05-28 20:09:57','2024-05-28 20:10:05'),(565,1,'Choose Roles','Choose Roles','2024-05-28 20:10:56','2024-05-28 20:10:56'),(566,2,'Choose Roles','تحديد الصلاحيات','2024-05-28 20:10:56','2024-05-28 20:10:56'),(567,1,'Details Info','Details Info','2024-05-28 20:12:11','2024-05-28 20:12:11'),(568,2,'Details Info','بيانات الموظف','2024-05-28 20:12:11','2024-05-28 20:12:29'),(569,1,'Phone','Phone','2024-05-28 20:12:57','2024-05-28 20:12:57'),(570,2,'Phone','الهاتف','2024-05-28 20:12:57','2024-05-28 20:12:57'),(571,1,'Blood Group','Blood Group','2024-05-28 20:13:34','2024-05-28 20:13:34'),(572,2,'Blood Group','فصيلة الدم','2024-05-28 20:13:34','2024-05-28 20:13:34'),(573,1,'Joining Date','Joining Date','2024-05-28 20:14:31','2024-05-28 20:14:31'),(574,2,'Joining Date','تاريخ التعيين','2024-05-28 20:14:31','2024-05-28 20:14:31'),(575,1,'Salary','Salary','2024-05-28 20:16:25','2024-05-28 20:16:25'),(576,2,'Salary','الراتب','2024-05-28 20:16:25','2024-05-28 20:16:25'),(577,1,'Salaries','Salaries','2024-05-28 20:16:52','2024-05-28 20:16:52'),(578,2,'Salaries','الرواتب','2024-05-28 20:16:52','2024-05-28 20:16:52'),(579,1,'Bank Name','Bank Name','2024-05-28 20:17:09','2024-05-28 20:17:09'),(580,2,'Bank Name','اسم البنك','2024-05-28 20:17:09','2024-05-28 20:17:09'),(581,1,'Bank IBAN Number','Bank IBAN Number','2024-05-28 20:17:20','2024-05-28 20:17:20'),(582,2,'Bank IBAN Number','الايبان','2024-05-28 20:17:20','2024-05-28 20:17:20'),(583,1,'Date','Date','2024-05-28 20:17:35','2024-05-28 20:17:35'),(584,2,'Date','التاريخ','2024-05-28 20:17:35','2024-05-28 20:17:35'),(585,1,'Picture','Picture','2024-05-28 20:18:41','2024-05-28 20:18:41'),(586,2,'Picture','الصورة','2024-05-28 20:18:41','2024-05-28 20:18:41'),(587,1,'Apply On Special Duty','Apply On Special Duty','2024-05-28 20:19:00','2024-05-28 20:19:00'),(588,2,'Apply On Special Duty','تقديم مهام خاصة','2024-05-28 20:19:00','2024-05-28 20:19:00'),(589,1,'Cash Payment Amount','Cash Payment Amount','2024-05-28 20:19:03','2024-05-28 20:19:03'),(590,2,'Cash Payment Amount','الدفع نقدي','2024-05-28 20:19:03','2024-05-28 20:19:03'),(591,1,'Bank Payment Amount','Bank Payment Amount','2024-05-28 20:19:25','2024-05-28 20:19:25'),(592,2,'Bank Payment Amount','التحويل البنكي','2024-05-28 20:19:25','2024-05-28 20:19:25'),(593,1,'Gross Salary','Gross Salary','2024-05-28 20:19:42','2024-05-28 20:19:42'),(594,2,'Gross Salary','الراتب الإجمالي','2024-05-28 20:19:42','2024-05-28 20:19:42'),(595,1,'Options','Options','2024-05-28 20:20:04','2024-05-28 20:20:04'),(596,2,'Options','خيارات','2024-05-28 20:20:04','2024-05-28 20:20:04'),(597,1,'Per Hour Rate','Per Hour Rate','2024-05-28 20:21:06','2024-05-28 20:21:06'),(598,2,'Per Hour Rate','الراتب بالساعة','2024-05-28 20:21:06','2024-05-28 20:21:06'),(599,1,'Per Hour Deduction Rate','Per Hour Deduction Rate','2024-05-28 20:21:32','2024-05-28 20:21:32'),(600,2,'Per Hour Deduction Rate','الخصم براتب الساعة','2024-05-28 20:21:32','2024-05-28 20:21:32'),(601,1,'Overtime Per Hour (%)','Overtime Per Hour (%)','2024-05-28 20:21:51','2024-05-28 20:21:51'),(602,2,'Overtime Per Hour (%)','الاضافي بالساعة (%)','2024-05-28 20:21:51','2024-05-28 20:21:51'),(603,1,'Apply On Special Duty Here','Apply On Special Duty here','2024-05-28 20:22:04','2024-05-28 20:22:04'),(604,2,'Apply On Special Duty Here','قدم هنا على المهام الخاصة','2024-05-28 20:22:04','2024-05-28 20:22:04'),(605,1,'Overtime Per Hour (Amount)','Overtime Per Hour (Amount)','2024-05-28 20:22:12','2024-05-28 20:22:12'),(606,2,'Overtime Per Hour (Amount)','الاضافي بالساعة (مبلغ)','2024-05-28 20:22:12','2024-05-28 20:22:12'),(607,1,'Holiday Per Hour (Amount)','Holiday Per Hour (Amount)','2024-05-28 20:22:45','2024-05-28 20:22:45'),(608,2,'Holiday Per Hour (Amount)','الاجازات بالساعة (مبلغ)','2024-05-28 20:22:45','2024-05-28 20:22:45'),(609,1,'Approved On Special Duties','Approved On Special Duties','2024-05-28 20:23:02','2024-05-28 20:23:02'),(610,2,'Approved On Special Duties','الموافقة على المهام الخاصة','2024-05-28 20:23:02','2024-05-28 20:23:02'),(611,1,'Add New Salary +','Add New Salary +','2024-05-28 20:23:16','2024-05-28 20:23:16'),(612,2,'Add New Salary +','اضافة راتب جديد +','2024-05-28 20:23:16','2024-05-28 20:23:16'),(613,1,'Add New Salary','Add New Salary','2024-05-28 20:23:29','2024-05-28 20:23:29'),(614,2,'Add New Salary','إضافة راتب جديد','2024-05-28 20:23:29','2024-05-28 20:23:29'),(615,1,'Add Child','Add Child','2024-05-28 20:25:30','2024-05-28 20:25:30'),(616,2,'Add Child','إضافة طفل','2024-05-28 20:25:30','2024-05-28 20:25:30'),(617,1,'Father\'s Name','Father\'s Name','2024-05-28 20:26:07','2024-05-28 20:26:07'),(618,2,'Father\'s Name','اسم الاب','2024-05-28 20:26:07','2024-05-28 20:26:07'),(619,1,'Mother\'s Name','Mother\'s Name','2024-05-28 20:26:27','2024-05-28 20:26:27'),(620,2,'Mother\'s Name','اسم الام','2024-05-28 20:26:27','2024-05-28 20:26:27'),(621,1,'Emergency Contact No.','Emergency Contact No.','2024-05-28 20:26:52','2024-05-28 20:26:52'),(622,2,'Emergency Contact No.','معلومات الطوارئ للاتصال','2024-05-28 20:26:52','2024-05-28 20:26:52'),(623,1,'Emergency Contact Person','Emergency Contact Person','2024-05-28 20:27:11','2024-05-28 20:27:11'),(624,2,'Emergency Contact Person','معلومات الشخص للطوارئ','2024-05-28 20:27:11','2024-05-28 20:27:11'),(625,1,'Relation with the Person','Relation with the Person','2024-05-28 20:27:35','2024-05-28 20:27:35'),(626,2,'Relation with the Person','العلاقة بالشخص','2024-05-28 20:27:35','2024-05-28 20:27:35'),(627,1,'No data available right now','No data available right now','2024-05-28 20:27:35','2024-05-28 20:27:35'),(628,2,'No data available right now','لا يتوفر بيانات حاليا','2024-05-28 20:27:35','2024-05-28 20:28:20'),(629,1,'House Address','House Address','2024-05-28 20:28:16','2024-05-28 20:28:16'),(630,2,'House Address','عنوان السكن','2024-05-28 20:28:16','2024-05-28 20:28:16'),(631,1,'SL','SL','2024-05-28 20:33:23','2024-05-28 20:33:23'),(632,2,'SL','م','2024-05-28 20:33:23','2024-05-28 20:33:23'),(633,1,'Contacts & Family','Contacts & Family','2024-05-28 20:33:55','2024-05-28 20:33:55'),(634,2,'Contacts & Family','العائلة ومعلومات الاتصال','2024-05-28 20:33:55','2024-05-28 20:33:55'),(635,1,'Education','Education','2024-05-28 20:34:23','2024-05-28 20:34:23'),(636,2,'Education','المؤهلات الدراسية','2024-05-28 20:34:23','2024-05-28 20:34:31'),(637,1,'Exam/Degree/Title','Exam/Degree/Title','2024-05-28 20:34:57','2024-05-28 20:34:57'),(638,2,'Exam/Degree/Title','الدرجة / المؤهل/الاختبار','2024-05-28 20:34:57','2024-05-28 20:34:57'),(639,1,'Concentration/ Major/Group','Concentration/ Major/Group','2024-05-28 20:35:45','2024-05-28 20:35:45'),(640,2,'Concentration/ Major/Group','التخصص / الرئيسي / المجموعة','2024-05-28 20:35:45','2024-05-28 20:35:45'),(641,1,'Institute Name','Institute Name','2024-05-28 20:36:03','2024-05-28 20:36:03'),(642,2,'Institute Name','اسم المؤسسة التعليمية','2024-05-28 20:36:03','2024-05-28 20:36:03'),(643,1,'Result','Result','2024-05-28 20:36:15','2024-05-28 20:36:15'),(644,2,'Result','النتيجة','2024-05-28 20:36:15','2024-05-28 20:36:15'),(645,1,'CGPA','CGPA','2024-05-28 20:37:05','2024-05-28 20:37:05'),(646,2,'CGPA','المعدل التراكمي','2024-05-28 20:37:05','2024-05-28 20:37:05'),(647,1,'Scale','Scale','2024-05-28 20:37:24','2024-05-28 20:37:24'),(648,2,'Scale','المقياس','2024-05-28 20:37:24','2024-05-28 20:37:24'),(649,1,'Year of Passing','Year of Passing','2024-05-28 20:37:39','2024-05-28 20:37:39'),(650,2,'Year of Passing','سنة التخرج','2024-05-28 20:37:39','2024-05-28 20:37:39'),(651,1,'Duration (Years)','Duration (Years)','2024-05-28 20:37:54','2024-05-28 20:37:54'),(652,2,'Duration (Years)','المدة (بالسنوات)','2024-05-28 20:37:54','2024-05-28 20:37:54'),(653,1,'Add Education','Add Education','2024-05-28 20:39:11','2024-05-28 20:39:11'),(654,2,'Add Education','إضافة مؤهل','2024-05-28 20:39:11','2024-05-28 20:39:11'),(655,1,'Add Education+','Add Education+','2024-05-28 20:39:51','2024-05-28 20:39:51'),(656,2,'Add Education+','إضافة مؤهل+','2024-05-28 20:39:51','2024-05-28 20:39:51'),(657,1,'Add Education +','Add Education +','2024-05-28 20:40:20','2024-05-28 20:40:20'),(658,2,'Add Education +','إضافة مؤهل +','2024-05-28 20:40:20','2024-05-28 20:40:20'),(659,1,'Type','Type','2024-05-28 20:40:51','2024-05-28 20:40:51'),(660,2,'Type','النوع','2024-05-28 20:40:51','2024-05-28 20:40:51'),(661,1,'Shift Name','Shift Name','2024-05-28 20:41:06','2024-05-28 20:41:06'),(662,2,'Shift Name','اسم الوردية','2024-05-28 20:41:06','2024-05-28 20:41:06'),(663,1,'Shift Duration','Shift Duration','2024-05-28 20:41:19','2024-05-28 20:41:19'),(664,2,'Shift Duration','مدة الوردية','2024-05-28 20:41:19','2024-05-28 20:41:19'),(665,1,'Updated At','Updated At','2024-05-28 20:41:37','2024-05-28 20:41:37'),(666,2,'Updated At','التعديل في','2024-05-28 20:41:37','2024-05-28 20:41:37'),(667,1,'Leave Balances','Leave Balances','2024-05-28 20:42:23','2024-05-28 20:42:23'),(668,2,'Leave Balances','رصيد الأجازات','2024-05-28 20:42:23','2024-05-28 20:42:23'),(669,1,'Civil IDs','Civil IDs & Licenses','2024-05-28 20:42:44','2024-05-28 20:42:44'),(670,2,'Civil IDs','البطاقات والرخص','2024-05-28 20:42:44','2024-05-28 20:42:44'),(671,1,'Issue Date','Issue Date','2024-05-28 20:43:03','2024-05-28 20:43:03'),(672,2,'Issue Date','تاريخ الاصدار','2024-05-28 20:43:03','2024-05-28 20:43:03'),(673,1,'Expiry Date','Expiry Date','2024-05-28 20:43:18','2024-05-28 20:43:18'),(674,2,'Expiry Date','تاريخ الانتهاء','2024-05-28 20:43:18','2024-05-28 20:43:18'),(675,1,'Description','Description','2024-05-28 20:43:32','2024-05-28 20:43:32'),(676,2,'Description','الوصف','2024-05-28 20:43:32','2024-05-28 20:43:32'),(677,1,'Attachements\') }}','Attachements\') }}','2024-05-28 20:43:47','2024-05-28 20:43:47'),(678,2,'Attachements\') }}','المرفقات\') }}','2024-05-28 20:43:47','2024-05-28 20:43:47'),(679,1,'Attachements','Attachements','2024-05-28 20:44:01','2024-05-28 20:44:01'),(680,2,'Attachements','المرفقات','2024-05-28 20:44:01','2024-05-28 20:44:01'),(681,1,'Add Civil ID','Add New ID','2024-05-28 20:44:49','2024-05-28 20:44:49'),(682,2,'Add Civil ID','إضافة هوية جديدة','2024-05-28 20:44:49','2024-05-28 20:44:49'),(683,1,'Civil ID','Civil ID','2024-05-28 20:45:12','2024-05-28 20:45:12'),(684,2,'Civil ID','الهوية','2024-05-28 20:45:12','2024-05-28 20:45:12'),(685,1,'Passport Number','Passport Number','2024-05-28 20:46:30','2024-05-28 20:46:30'),(686,2,'Passport Number','رقم الجواز','2024-05-28 20:46:30','2024-05-28 20:46:30'),(687,1,'Labour Card Number','Labour Card Number','2024-05-28 20:46:54','2024-05-28 20:46:54'),(688,2,'Labour Card Number','هوية العمل','2024-05-28 20:46:54','2024-05-28 20:46:54'),(689,1,'Assets','Assets','2024-05-28 20:47:26','2024-05-28 20:47:26'),(690,2,'Assets','العهد والأصول','2024-05-28 20:47:26','2024-05-28 20:47:26'),(691,1,'Age','Age','2024-05-28 20:49:15','2024-05-28 20:49:15'),(692,2,'Age','العمر','2024-05-28 20:49:15','2024-05-28 20:49:15'),(693,1,'Resignation Letter','Resignation Letter','2024-05-28 20:50:32','2024-05-28 20:50:32'),(694,2,'Resignation Letter','خطاب استقالة','2024-05-28 20:50:32','2024-05-28 20:50:32'),(695,1,'Logs','Logs','2024-05-28 20:51:11','2024-05-28 20:51:11'),(696,2,'Logs','السجلات','2024-05-28 20:51:11','2024-05-28 20:51:11'),(697,1,'NID No.','NID No.','2024-05-28 20:53:59','2024-05-28 20:53:59'),(698,2,'NID No.','رقم الهوية الوطنية','2024-05-28 20:53:59','2024-05-28 20:53:59'),(699,1,'Image','Image','2024-05-28 20:54:40','2024-05-28 20:54:40'),(700,2,'Image','الصورة','2024-05-28 20:54:40','2024-05-28 20:54:40'),(701,1,'Approved Leave Applications','Approved Leave Applications','2024-05-28 20:54:50','2024-05-28 20:54:50'),(702,2,'Approved Leave Applications','طلبات الأجازة المعتمدة','2024-05-28 20:54:50','2024-05-28 20:54:50'),(703,1,'Insurer','Insurer','2024-05-28 20:55:11','2024-05-28 20:55:11'),(704,2,'Insurer','شركة التأمين','2024-05-28 20:55:11','2024-05-28 20:55:11'),(705,1,'Insurance Amount','Insurance Amount','2024-05-28 20:55:33','2024-05-28 20:55:33'),(706,2,'Insurance Amount','مبلغ التأمين','2024-05-28 20:55:33','2024-05-28 20:55:33'),(707,1,'Valid Till','Valid Till','2024-05-28 20:56:10','2024-05-28 20:56:10'),(708,2,'Valid Till','صالح حتى','2024-05-28 20:56:10','2024-05-28 20:56:10'),(709,1,'Insurance Number','Insurance Number','2024-05-28 20:56:35','2024-05-28 20:56:35'),(710,2,'Insurance Number','الرقم التأميني','2024-05-28 20:56:35','2024-05-28 20:56:35'),(711,1,'Holiday Per Hour (%)','Holiday Per Hour (%)','2024-05-28 20:57:28','2024-05-28 20:57:28'),(712,2,'Holiday Per Hour (%)','الإجازة بالساعة (%)','2024-05-28 20:57:28','2024-05-28 20:57:28'),(713,1,'Denied Leave Applications','Denied Leave Applications','2024-05-28 20:57:48','2024-05-28 20:57:48'),(714,2,'Denied Leave Applications','طلبات الأجازة المرفوضة','2024-05-28 20:57:48','2024-05-28 20:57:48'),(715,1,'Pending Leave Applications','Pending Leave Applications','2024-05-28 20:58:27','2024-05-28 20:58:27'),(716,2,'Pending Leave Applications','طلبات الأجازة المعلقة','2024-05-28 20:58:27','2024-05-28 20:58:27'),(717,1,'Add Shift','Add Shift','2024-05-28 20:58:36','2024-05-28 20:58:36'),(718,2,'Add Shift','اضافة وردية (شفت)','2024-05-28 20:58:36','2024-05-28 20:58:36'),(719,1,'New Task','New Task','2024-05-28 20:59:36','2024-05-28 20:59:36'),(720,2,'New Task','مهمة جديدة','2024-05-28 20:59:36','2024-05-28 20:59:36'),(721,1,'Add Eduction','Add Eduction','2024-05-28 21:00:18','2024-05-28 21:00:18'),(722,2,'Add Eduction','إضافة مؤهل','2024-05-28 21:00:18','2024-05-28 21:00:18'),(723,1,'Percentage','Percentage','2024-05-28 21:00:23','2024-05-28 21:00:23'),(724,2,'Percentage','النسبة المئوية','2024-05-28 21:00:24','2024-05-28 21:00:24'),(725,1,'Perticipants','Perticipants','2024-05-28 21:01:33','2024-05-28 21:01:33'),(726,2,'Perticipants','المشاركون','2024-05-28 21:01:33','2024-05-28 21:01:33'),(727,1,'Add Posting','Add Posting','2024-05-28 21:03:17','2024-05-28 21:03:17'),(728,2,'Add Posting','إضافة منشور','2024-05-28 21:03:17','2024-05-28 21:03:17'),(729,1,'add Perticipants','add Perticipants','2024-05-28 21:03:50','2024-05-28 21:03:50'),(730,2,'add Perticipants','إضافة مشاركين','2024-05-28 21:03:50','2024-05-28 21:03:50'),(731,1,'Add Passport','Add Passport','2024-05-28 21:03:52','2024-05-28 21:03:52'),(732,2,'Add Passport','اضافة جواز','2024-05-28 21:03:52','2024-05-28 21:03:52'),(733,1,'Add Labour Card','Add Labour Card','2024-05-28 21:04:42','2024-05-28 21:04:42'),(734,2,'Add Labour Card','إضافة بطاقة عمل','2024-05-28 21:04:42','2024-05-28 21:04:42'),(735,1,'Add Asset','Add Asset','2024-05-28 21:05:35','2024-05-28 21:05:35'),(736,2,'Add Asset','إضافة أصول','2024-05-28 21:05:35','2024-05-28 21:05:35'),(737,1,'Asset Code','Asset Code','2024-05-28 21:06:08','2024-05-28 21:06:08'),(738,2,'Asset Code','رمز الأصل / العهدة','2024-05-28 21:06:08','2024-05-28 21:06:08'),(739,1,'Asset Name','Asset Name','2024-05-28 21:06:33','2024-05-28 21:06:33'),(740,2,'Asset Name','اسم الأصل','2024-05-28 21:06:33','2024-05-28 21:06:33'),(741,1,'Document','Document','2024-05-28 21:07:07','2024-05-28 21:07:07'),(742,2,'Document','الوثيقة','2024-05-28 21:07:07','2024-05-28 21:07:07'),(743,1,'Add Document','Add Document','2024-05-28 21:07:29','2024-05-28 21:07:29'),(744,2,'Add Document','إضافة وثيقة','2024-05-28 21:07:29','2024-05-28 21:07:29'),(745,1,'Apply for Loan','Apply for Loan','2024-05-28 21:07:39','2024-05-28 21:07:39'),(746,2,'Apply for Loan','طلب القرض','2024-05-28 21:07:39','2024-05-28 21:07:39'),(747,1,'Loan Type','Loan Type','2024-05-28 21:08:06','2024-05-28 21:08:06'),(748,2,'Loan Type','نوع القرض','2024-05-28 21:08:06','2024-05-28 21:08:06'),(749,1,'Add Insurance','Add Insurance','2024-05-28 21:08:06','2024-05-28 21:08:06'),(750,2,'Add Insurance','إضافة تأمين','2024-05-28 21:08:06','2024-05-28 21:08:06'),(751,1,'Loan Amount','Loan Amount','2024-05-28 21:08:43','2024-05-28 21:08:43'),(752,2,'Loan Amount','قيمة القرض','2024-05-28 21:08:43','2024-05-28 21:08:43'),(753,1,'Attachments','Attachments','2024-05-28 21:09:36','2024-05-28 21:09:36'),(754,2,'Attachments','المرفقات','2024-05-28 21:09:36','2024-05-28 21:09:36'),(755,1,'choose files','choose files','2024-05-28 21:13:16','2024-05-28 21:13:16'),(756,2,'choose files','اختار الملف','2024-05-28 21:13:16','2024-05-28 21:13:16'),(757,1,'Genders','Genders','2024-05-29 19:59:51','2024-05-29 19:59:51'),(758,2,'Genders','النوع','2024-05-29 19:59:51','2024-05-29 19:59:51'),(759,1,'Categories','Categories','2024-05-29 20:00:37','2024-05-29 20:00:37'),(760,2,'Categories','التصنيفات','2024-05-29 20:00:37','2024-05-29 20:00:37'),(761,1,'Projects','Projects','2024-05-29 20:01:32','2024-05-29 20:01:32'),(762,2,'Projects','المشاريع','2024-05-29 20:01:32','2024-05-29 20:01:32'),(763,1,'New Document','New Document','2024-05-29 20:07:06','2024-05-29 20:07:06'),(764,2,'New Document','وثيقة جديدة','2024-05-29 20:07:06','2024-05-29 20:07:06'),(765,1,'New Template','New Template','2024-05-29 20:08:17','2024-05-29 20:08:17'),(766,2,'New Template','نموذج جديد','2024-05-29 20:08:17','2024-05-29 20:08:17'),(767,1,'New HR Form','New HR Form','2024-05-29 20:40:28','2024-05-29 20:40:28'),(768,2,'New HR Form','طلب جديد','2024-05-29 20:40:28','2024-05-29 20:40:28'),(769,1,'New Publishment','New Publishment','2024-05-29 20:41:27','2024-05-29 20:41:27'),(770,2,'New Publishment','منشور جديد','2024-05-29 20:41:27','2024-05-29 20:41:27'),(771,1,'Solved Issues','Solved Issues','2024-05-29 20:43:29','2024-05-29 20:43:29'),(772,2,'Solved Issues','مشاكل محلولة','2024-05-29 20:43:29','2024-05-29 20:44:06'),(773,1,'Level','Level','2024-06-11 17:21:32','2024-06-11 17:21:32'),(774,2,'Level','المستوى','2024-06-11 17:21:32','2024-06-11 17:21:32'),(775,1,'Location','Location','2024-06-11 17:22:12','2024-06-11 17:22:12'),(776,2,'Location','الموقع','2024-06-11 17:22:12','2024-06-11 17:22:12'),(777,1,'Manager','Manager','2024-06-11 17:22:35','2024-06-11 17:22:35'),(778,2,'Manager','المدير','2024-06-11 17:22:35','2024-06-11 17:22:35'),(779,1,'Attendances','Attendances','2024-06-23 20:09:06','2024-06-23 20:09:06'),(780,2,'Attendances','الحضور والإنصراف','2024-06-23 20:09:06','2024-06-23 20:09:06'),(781,1,'Generate Attendances','Generate Attendances','2024-06-23 20:10:32','2024-06-23 20:10:32'),(782,2,'Generate Attendances','إضافة حضور وانصراف','2024-06-23 20:10:32','2024-06-23 20:10:32'),(783,1,'Choose Employees','Choose Employees','2024-06-23 20:12:23','2024-06-23 20:12:23'),(784,2,'Choose Employees','اختيار الموظفين','2024-06-23 20:12:23','2024-06-23 20:12:23'),(785,1,'Denied On Special Duties','Denied On Special Duties','2024-06-23 21:29:40','2024-06-23 21:29:40'),(786,2,'Denied On Special Duties','قرارات مرفوضة للعمل بمهام خاصة','2024-06-23 21:29:40','2024-06-23 21:32:49'),(787,1,'Pending On Special Duties','Pending On Special Duties','2024-06-23 21:31:33','2024-06-23 21:31:33'),(788,2,'Pending On Special Duties','قرارات معلقة للعمل بمهام خاصة','2024-06-23 21:31:33','2024-06-23 21:31:33'),(789,1,'Approved Working From Home','Approved Working From Home','2024-06-23 21:34:22','2024-06-23 21:34:22'),(790,2,'Approved Working From Home','موافقات العمل من المنزل','2024-06-23 21:34:22','2024-06-23 21:34:22'),(791,1,'Apply Working From Home','Apply Working From Home','2024-06-23 21:35:58','2024-06-23 21:35:58'),(792,2,'Apply Working From Home','طلب العمل من المنزل','2024-06-23 21:35:58','2024-06-23 21:35:58'),(793,1,'Apply Working From Home here','Apply Working From Home here','2024-06-23 21:40:20','2024-06-23 21:40:20'),(794,2,'Apply Working From Home here','تقديم طلب عمل من المنزل هنا','2024-06-23 21:40:20','2024-06-23 21:40:20'),(795,1,'About the company','About the company','2025-02-20 09:11:51','2025-02-20 09:11:51'),(796,2,'About the company','عن الشركة','2025-02-20 09:11:51','2025-02-20 09:11:51'),(797,1,'What makes us different','What makes us different','2025-02-20 09:12:04','2025-02-20 09:12:04'),(798,2,'What makes us different','ما الذي يميزنا','2025-02-20 09:12:04','2025-02-20 09:12:04'),(799,1,'Our Location','Our Location','2025-02-20 09:12:15','2025-02-20 09:12:15'),(800,2,'Our Location','موقعنا','2025-02-20 09:12:15','2025-02-20 09:12:15'),(801,1,'Royal Express International Transport','Royal Express International Transport','2025-02-20 09:12:27','2025-02-20 09:12:27'),(802,2,'Royal Express International Transport','رويال اكسبرس للنقل الدولي','2025-02-20 09:12:27','2025-02-20 09:12:27');

/*Table structure for table `languages` */

DROP TABLE IF EXISTS `languages`;

CREATE TABLE `languages` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `direction` enum('ltr','rtl') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ltr',
  `flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'US',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `languages` */

insert  into `languages`(`id`,`code`,`name`,`direction`,`flag`,`deleted_at`,`created_at`,`updated_at`) values (1,'en','English (US)','ltr','US',NULL,'2024-02-27 21:11:57','2024-10-31 20:58:14'),(2,'ar-AE','Arabic (UAE)','rtl','AE',NULL,'2024-02-27 21:13:16','2024-02-28 04:51:41');

/*Table structure for table `ledgers` */

DROP TABLE IF EXISTS `ledgers`;

CREATE TABLE `ledgers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint unsigned DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('income','expense') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'expense',
  `opening_balance` double NOT NULL DEFAULT '0',
  `opening_balance_date` date DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned NOT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ledgers_parent_id_foreign` (`parent_id`),
  KEY `ledgers_creator_id_foreign` (`creator_id`),
  KEY `ledgers_editor_id_foreign` (`editor_id`),
  CONSTRAINT `ledgers_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ledgers_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ledgers_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `ledgers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `ledgers` */

insert  into `ledgers`(`id`,`parent_id`,`code`,`name`,`type`,`opening_balance`,`opening_balance_date`,`description`,`creator_id`,`editor_id`,`deleted_at`,`created_at`,`updated_at`) values (1,NULL,'1001','Bus','expense',0,NULL,NULL,1,NULL,NULL,'2025-02-08 04:56:42','2025-02-08 04:56:42'),(2,NULL,'102','Office','expense',0,NULL,NULL,1,NULL,NULL,'2025-02-08 04:57:43','2025-02-08 04:57:43');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `serial` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_module_id_foreign` (`module_id`),
  CONSTRAINT `menu_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=150 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu` */

insert  into `menu`(`id`,`module_id`,`name`,`route`,`icon`,`desc`,`serial`,`status`,`created_at`,`updated_at`) values (8,6,'System Settings','#','fas fa-chart-pie',NULL,1,1,'2020-05-16 00:45:58','2022-12-09 02:03:52'),(10,6,'Role Management','#','fab fa-pied-piper-alt',NULL,2,1,'2020-05-16 04:37:59','2022-12-09 02:03:44'),(11,7,'Users','users','fa fa-user',NULL,1,1,'2020-05-18 03:16:40','2025-02-05 07:29:47'),(13,6,'Employee Settings','#','fa fa-tasks',NULL,3,1,'2020-05-18 03:48:15','2020-05-18 03:49:06'),(42,6,'Publishment Types','publishment-types',NULL,NULL,10,1,'2020-08-23 01:17:01','2025-02-06 06:53:27'),(43,16,'Publishments','publishments','fa fa-envelope',NULL,1,1,'2020-08-23 01:27:21','2020-08-23 01:27:21'),(53,6,'System Information','system-information','fa fa-home',NULL,0,1,'2022-12-09 02:04:16','2022-12-09 02:04:16'),(78,6,'Country','countries','fa fa-globe',NULL,11,1,'2023-07-09 23:51:41','2025-02-06 06:54:20'),(100,25,'Language Library','language-libraries','fas fa-atlas',NULL,0,1,'2024-10-31 20:55:24','2024-10-31 20:55:24'),(101,25,'Language','languages','fas fa-globe',NULL,1,1,'2024-10-31 20:55:53','2024-10-31 20:55:53'),(133,7,'Employees','employees','fas fa-users',NULL,0,1,'2025-02-06 07:16:02','2025-02-06 07:16:33'),(141,36,'Entries','entries','fas fa-receipt',NULL,0,1,'2025-02-08 04:54:22','2025-02-08 04:54:22'),(142,36,'Ledgers','ledgers','fas fa-wallet',NULL,10,1,'2025-02-08 04:54:58','2025-02-08 04:54:58'),(143,36,'Opening Balance','opening-balance',NULL,NULL,20,1,'2025-02-08 04:55:23','2025-02-08 04:55:23'),(144,36,'Financial Statement','financial-statements','fas fa-hand-holding-usd',NULL,100,1,'2025-02-08 04:55:49','2025-02-08 04:55:49'),(145,33,'Customer','customers','fas fa-user-secret',NULL,30,1,'2025-02-10 06:34:56','2025-02-10 06:34:56');

/*Table structure for table `menu_permissions` */

DROP TABLE IF EXISTS `menu_permissions`;

CREATE TABLE `menu_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_permissions_menu_id_foreign` (`menu_id`),
  KEY `menu_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `menu_permissions_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `menu_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1520 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menu_permissions` */

insert  into `menu_permissions`(`id`,`menu_id`,`permission_id`,`created_at`,`updated_at`) values (123,43,3831,NULL,NULL),(125,43,3833,NULL,NULL),(126,43,3834,NULL,NULL),(155,53,3863,NULL,NULL),(891,8,3903,NULL,NULL),(892,8,3904,NULL,NULL),(893,8,3905,NULL,NULL),(894,8,3906,NULL,NULL),(895,8,3907,NULL,NULL),(896,8,3908,NULL,NULL),(897,8,3909,NULL,NULL),(898,8,3910,NULL,NULL),(899,8,3911,NULL,NULL),(900,8,3912,NULL,NULL),(901,8,3913,NULL,NULL),(902,8,3914,NULL,NULL),(903,10,3915,NULL,NULL),(904,10,3916,NULL,NULL),(905,10,3917,NULL,NULL),(906,10,3918,NULL,NULL),(907,10,3919,NULL,NULL),(911,10,4247,NULL,NULL),(912,10,4248,NULL,NULL),(913,10,4249,NULL,NULL),(914,10,4250,NULL,NULL),(1167,42,4175,NULL,NULL),(1168,42,4176,NULL,NULL),(1169,42,4177,NULL,NULL),(1170,42,4178,NULL,NULL),(1319,100,4440,'2024-10-31 20:55:24','2024-10-31 20:55:24'),(1320,101,4436,'2024-10-31 20:55:53','2024-10-31 20:55:53'),(1321,101,4437,'2024-10-31 20:55:53','2024-10-31 20:55:53'),(1322,101,4438,'2024-10-31 20:55:53','2024-10-31 20:55:53'),(1323,101,4439,'2024-10-31 20:55:53','2024-10-31 20:55:53'),(1448,78,4393,'2025-02-06 06:54:20','2025-02-06 06:54:20'),(1449,78,4394,'2025-02-06 06:54:20','2025-02-06 06:54:20'),(1450,78,4395,'2025-02-06 06:54:20','2025-02-06 06:54:20'),(1451,78,4396,'2025-02-06 06:54:20','2025-02-06 06:54:20'),(1452,11,4647,'2025-02-06 07:14:47','2025-02-06 07:14:47'),(1453,11,4648,'2025-02-06 07:14:47','2025-02-06 07:14:47'),(1454,11,4649,'2025-02-06 07:14:47','2025-02-06 07:14:47'),(1455,11,4650,'2025-02-06 07:14:47','2025-02-06 07:14:47'),(1456,133,4663,'2025-02-06 07:16:02','2025-02-06 07:16:02'),(1457,133,4664,'2025-02-06 07:16:02','2025-02-06 07:16:02'),(1458,133,4665,'2025-02-06 07:16:02','2025-02-06 07:16:02'),(1459,133,4666,'2025-02-06 07:16:02','2025-02-06 07:16:02'),(1487,141,4685,'2025-02-08 04:54:22','2025-02-08 04:54:22'),(1488,141,4686,'2025-02-08 04:54:22','2025-02-08 04:54:22'),(1489,141,4687,'2025-02-08 04:54:22','2025-02-08 04:54:22'),(1490,141,4688,'2025-02-08 04:54:22','2025-02-08 04:54:22'),(1491,142,4681,'2025-02-08 04:54:58','2025-02-08 04:54:58'),(1492,142,4682,'2025-02-08 04:54:58','2025-02-08 04:54:58'),(1493,142,4683,'2025-02-08 04:54:58','2025-02-08 04:54:58'),(1494,142,4684,'2025-02-08 04:54:58','2025-02-08 04:54:58'),(1495,143,4693,'2025-02-08 04:55:23','2025-02-08 04:55:23'),(1496,143,4694,'2025-02-08 04:55:23','2025-02-08 04:55:23'),(1497,143,4695,'2025-02-08 04:55:23','2025-02-08 04:55:23'),(1498,143,4696,'2025-02-08 04:55:23','2025-02-08 04:55:23'),(1499,144,4689,'2025-02-08 04:55:49','2025-02-08 04:55:49'),(1500,144,4690,'2025-02-08 04:55:49','2025-02-08 04:55:49'),(1501,144,4691,'2025-02-08 04:55:49','2025-02-08 04:55:49'),(1502,144,4692,'2025-02-08 04:55:49','2025-02-08 04:55:49'),(1503,145,4706,'2025-02-10 06:34:56','2025-02-10 06:34:56'),(1504,145,4707,'2025-02-10 06:34:56','2025-02-10 06:34:56'),(1505,145,4708,'2025-02-10 06:34:56','2025-02-10 06:34:56'),(1506,145,4709,'2025-02-10 06:34:56','2025-02-10 06:34:56');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1273 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2020_05_14_184001_roles',1),(6,'2020_05_15_093124_modules',1),(7,'2020_05_15_093132_menu',1),(8,'2020_05_15_093136_submenu',1),(9,'2020_05_15_093142_options',1),(10,'2020_05_15_095045_firstforeignkeys',1),(11,'2020_05_17_160043_freelinks',1),(12,'2020_05_17_164259_employees',1),(13,'2020_05_17_170924_designations',1),(14,'2020_05_17_170932_functions',1),(15,'2020_05_17_170938_subfunctions',1),(16,'2020_05_17_171043_joblevels',1),(17,'2020_05_17_171048_joblocations',1),(18,'2020_05_17_171102_teams',1),(19,'2020_05_17_171112_employee_categories',1),(20,'2020_05_17_171126_brands',1),(21,'2020_05_17_171135_legal_entitiess',1),(22,'2020_05_17_171144_religions',1),(23,'2020_05_17_171201_separation_options',1),(24,'2020_05_17_171209_trustee_boards',1),(25,'2020_05_17_171214_trustee_board_members',1),(26,'2020_05_17_172607_employee_details',1),(27,'2020_05_17_174712_countries',1),(28,'2020_05_17_175951_employee_logs',1),(29,'2020_05_17_180206_employee_foreignkeys',1),(30,'2020_05_20_140543_shifts',1),(31,'2020_05_20_140855_employeeshifts',1),(32,'2020_05_20_140910_employee_first_foreignkeys',1),(33,'2020_05_22_163952_employee_childs',1),(34,'2020_05_22_163959_employee_educations',1),(35,'2020_05_22_164058_EmployeeSecondforeign_keys',1),(36,'2020_05_28_114753_holiday_types',1),(37,'2020_05_28_114759_holidays',1),(38,'2020_05_28_115304_Secondforeignkeys',1),(39,'2020_05_28_115454_leave_types',1),(40,'2020_05_28_141811_leaves',1),(41,'2020_05_28_141826_leave_foreign_keys',1),(42,'2020_07_15_141637_devices',1),(43,'2020_07_15_141645_checkinouts',1),(44,'2020_07_18_151601_attendances',1),(45,'2020_07_18_151923_Attendance_foreign_keys',1),(46,'2020_07_19_095809_on_special_duties',1),(47,'2020_07_19_095822_working_from_home',1),(48,'2020_07_19_100308_Attendance_foreign_keys_stage_2',1),(49,'2020_07_19_123705_remote_attendance',1),(50,'2020_07_20_160012_ot_applications',1),(51,'2020_07_20_160024_overtime_foreign_keys',1),(52,'2020_07_22_135547_issues',1),(53,'2020_07_22_135602_solutions',1),(54,'2020_07_22_135906_topics',1),(55,'2020_07_22_140142_issue_foreign_keys',1),(56,'2020_07_23_100645_provident_fund_settings',1),(57,'2020_07_23_100655_loan_settings',1),(58,'2020_07_23_110955_loan_types',1),(59,'2020_07_23_111006_foreign_keys_last_stage',1),(60,'2020_07_23_120522_provident_fund',1),(61,'2020_07_23_120534_loans',1),(62,'2020_07_23_120602_loan_installements',1),(63,'2020_07_23_120641_payroll_first_foreign_keys',1),(64,'2020_07_26_070137_salary_heads',1),(65,'2020_07_26_070151_attendance_based_salary_heads',1),(66,'2020_07_26_070256_employee_salaries',1),(67,'2020_07_26_070308_employee_salary_heads',1),(68,'2020_07_26_070326_EmployeeThirdforeign_keyes',1),(69,'2020_07_26_070357_taxes',1),(70,'2020_07_26_070403_tax_rules',1),(71,'2020_07_26_070413_third_foreign_keys',1),(72,'2020_08_08_124701_monthly_payrolls',1),(73,'2020_08_08_124712_monthly_payroll_heads',1),(74,'2020_08_08_124720_monthly_payroll_attendance_based_heads',1),(75,'2020_08_08_124738_monthly_payroll_foreign_keys',1),(76,'2020_08_08_133557_weekly_payroll',1),(77,'2020_08_08_133602_weekly_payroll_foreign_keys',1),(78,'2020_08_09_125158_salary_head_details',1),(79,'2020_08_09_125209_attendance_baesd_salary_head_details',1),(80,'2020_08_09_125222_foreign_key_latest_stage',1),(81,'2020_08_22_140133_publishment_types',1),(82,'2020_08_22_140313_publishments',1),(83,'2020_08_22_140320_publishment_foreign_keys',1),(84,'2022_08_23_142728_payroll_new_keys',1),(85,'2022_08_23_150158_update_users',1),(87,'2022_12_08_085841_system_information',2),(89,'2022_12_11_052219_portfolios',4),(90,'2022_12_11_052226_programs',4),(91,'2022_12_11_052317_project_types',4),(92,'2022_12_11_052342_objectives',4),(93,'2022_12_11_052451_program_project_types',4),(94,'2022_12_11_052618_projects',4),(95,'2022_12_11_052626_project_boards',4),(96,'2022_12_11_052638_project_departments',4),(97,'2022_12_11_052836_project_scopes',4),(98,'2022_12_11_052856_project_objectives',4),(99,'2022_12_11_052910_project_phases',4),(100,'2022_12_11_052917_project_milestones',4),(101,'2022_12_11_052925_project_tasks',4),(102,'2022_12_11_052932_project_dependencies',4),(103,'2022_12_11_052941_project_task_documents',4),(104,'2022_12_11_053012_project_goals',4),(105,'2022_12_11_053041_project_milestone_employees',4),(106,'2022_12_11_071541_project_task_updates',4),(107,'2022_12_11_082259_project_task_coversations',4),(108,'2022_12_11_082333_project_task_coversation_messages',4),(109,'2022_12_11_083111_project_logs',4),(110,'2022_12_09_103629_tags',5),(111,'2022_12_09_103638_bank_accounts',5),(112,'2022_12_09_103652_fiscal_years',5),(113,'2022_12_09_103705_companies',5),(114,'2022_12_09_103716_profit_centres',5),(115,'2022_12_09_103722_cost_centres',5),(116,'2022_12_10_103920_currency_types',5),(117,'2022_12_10_103926_currencies',5),(118,'2022_12_10_103934_exchange_rates',5),(119,'2022_12_11_103540_ledger_classes',5),(120,'2022_12_11_103542_ledger_groups',5),(121,'2022_12_11_103546_ledgers',5),(122,'2022_12_11_103558_transaction_types',5),(123,'2022_12_11_103610_transactions',5),(124,'2022_12_11_103616_transaction_entries',5),(125,'2022_12_11_103759_finance_setups',5),(126,'2022_12_11_103846_advance_categories',5),(127,'2022_12_11_103911_bank_reconciliation_statements',5),(136,'2022_12_11_132248_skills',6),(137,'2022_12_11_132315_project_type_skills',6),(138,'2022_12_11_132338_task_skills',6),(139,'2022_12_11_132357_task_reviewers',6),(140,'2022_12_11_135619_task_skill_reviews',6),(141,'2023_01_24_173227_create_permission_tables',7),(142,'2023_01_25_142540_add_module_to_permissions',8),(143,'2023_01_25_173355_menu_permissions',9),(144,'2023_01_25_173400_submenu_permissions',9),(145,'2023_01_26_100950_user_column_visibilities',10),(163,'2023_02_18_121949_add_biotime_info_to_employee',15),(174,'2023_02_17_103933_biotime_areas',16),(175,'2023_02_17_104005_biotime_departments',16),(176,'2023_02_17_104022_biotime_positions',16),(177,'2023_02_17_104053_biotime_employees',16),(178,'2023_02_17_104126_biotime_devices',16),(179,'2023_02_17_104308_biotime_transactions',16),(180,'2023_02_17_122114_update_biotime_employees',16),(181,'2023_02_17_122701_employee_areas',16),(182,'2023_02_17_122830_remove_area_from_employees',16),(183,'2023_02_17_135045_add_id_to_all_tables',16),(187,'2023_02_23_063650_zkteco_devices',17),(188,'2023_02_23_063659_zkteco_checkinouts',17),(189,'2023_02_23_143620_zkteco_employees',17),(388,'2023_02_24_072815_requisition_types',18),(389,'2023_02_24_072827_add_requisition_types_to_requisitions',18),(694,'2023_02_24_073919_purchase_order_bills',19),(698,'2023_02_24_074048_good_received_notes',19),(699,'2023_02_24_074054_good_received_note_items',19),(873,'2023_02_24_074147_inventories',20),(876,'2023_02_24_074349_approval_ranges',20),(995,'2023_02_24_071932_vendors',21),(996,'2023_02_24_071949_categories',21),(997,'2023_02_24_071958_products',21),(998,'2023_02_24_072008_attributes',21),(999,'2023_02_24_072014_attribute_options',21),(1000,'2023_02_24_072026_product_attributes',21),(1001,'2023_02_24_072047_suppliers',21),(1002,'2023_02_24_072138_supplier_addresses',21),(1003,'2023_02_24_072155_supplier_bank_accounts',21),(1004,'2023_02_24_072204_supplier_contact_persons',21),(1005,'2023_02_24_072238_supplier_currencies',21),(1006,'2023_02_24_072248_payment_terms',21),(1007,'2023_02_24_072256_supplier_payment_terms',21),(1008,'2023_02_24_072304_review_criterias',21),(1009,'2023_02_24_072305_supplier_reviews',21),(1010,'2023_02_24_072314_supplier_logs',21),(1011,'2023_02_24_072333_supplier_products',21),(1012,'2023_02_24_072436_product_units',21),(1013,'2023_02_24_072505_product_available_units',21),(1014,'2023_02_24_072523_unit_conversions',21),(1015,'2023_02_24_072642_supplier_ledgers',21),(1016,'2023_02_24_072650_product_ledgers',21),(1017,'2023_02_24_072658_category_ledgers',21),(1018,'2023_02_24_072700_requisition_types',21),(1019,'2023_02_24_072753_requisitions',21),(1020,'2023_02_24_072846_requisition_items',21),(1021,'2023_02_24_072853_requisition_notes',21),(1022,'2023_02_24_072902_requisition_trackings',21),(1023,'2023_02_24_073008_warehouses',21),(1024,'2023_02_24_073016_units',21),(1025,'2023_02_24_073037_requisition_deliveries',21),(1026,'2023_02_24_073049_requisition_delivery_items',21),(1027,'2023_02_24_073134_proposals',21),(1028,'2023_02_24_073145_proposal_items',21),(1029,'2023_02_24_073154_proposal_requisitions',21),(1030,'2023_02_24_073201_proposal_trackings',21),(1031,'2023_02_24_073211_proposal_suppliers',21),(1032,'2023_02_24_073703_category_functions',21),(1033,'2023_02_24_073711_category_attributes',21),(1034,'2023_02_24_073812_quotations',21),(1035,'2023_02_24_073820_quotation_items',21),(1036,'2023_02_24_073830_purchase_orders',21),(1037,'2023_02_24_073851_purchase_order_items',21),(1038,'2023_02_24_073906_purchase_order_requisitions',21),(1039,'2023_02_24_073933_purchase_order_transactions',21),(1040,'2023_02_24_073934_good_received_notes',21),(1041,'2023_02_24_073935_good_received_note_items',21),(1042,'2023_02_24_073944_purchase_order_returns',21),(1043,'2023_02_24_074001_purchase_order_gate_outs',21),(1044,'2023_02_24_074102_stocks',21),(1045,'2023_02_24_074245_faqs',21),(1046,'2023_02_24_074331_supplier_transactions',21),(1047,'2023_02_24_074427_employee_warehouses',21),(1048,'2023_02_24_180234_product_vendors',21),(1049,'2023_02_25_073919_purchase_order_bills',21),(1050,'2023_02_26_162934_add_grn_to_bills',21),(1051,'2023_02_26_173942_return_faq',21),(1052,'2023_07_09_094114_companies',22),(1053,'2023_07_09_094122_projects',22),(1054,'2023_07_09_094340_employee_postings',23),(1055,'2023_07_09_094351_employee_assets',23),(1056,'2023_07_09_094638_employee_national_ids',23),(1057,'2023_07_09_094645_employee_passports',23),(1058,'2023_07_09_094654_employee_labour_cards',23),(1060,'2023_07_09_094603_hr_forms',25),(1061,'2023_07_09_094610_templates',25),(1062,'2023_07_09_094617_documents',25),(1063,'2023_07_09_095025_tasks',26),(1064,'2023_07_09_095037_task_perticipants',26),(1065,'2023_07_09_095038_task_milestones',26),(1066,'2023_07_09_095049_task_messages',26),(1067,'2023_07_10_092821_add_policy_to_company',27),(1070,'2023_07_09_094717_manual_attendances',28),(1071,'2023_07_11_064416_attendance_seetings',29),(1072,'2023_07_14_043724_add_company_to_employee',30),(1073,'2023_07_14_043748_employee_insurances',30),(1074,'2023_07_14_044333_update_employee_postings',31),(1076,'2023_07_16_040501_add_columns_to_company',33),(1079,'2023_07_22_100506_add_columns_to_milstone',35),(1081,'2023_07_14_172513_add_salary_info_to_employee',36),(1082,'2023_07_24_143435_add_columns_to_cards',37),(1083,'2023_07_25_154717_update_employee_insurance',38),(1084,'2023_07_25_162433_update_employee_salary',39),(1087,'2023_07_16_160748_project_payroll',40),(1088,'2023_07_16_160753_project_payroll_details',40),(1089,'2023_07_26_154423_update_project_payrolls',40),(1090,'2023_07_29_132807_update_employee_salary_and_profile',41),(1091,'2023_07_29_175632_assign_employees',42),(1092,'2023_07_30_134051_update_company',43),(1093,'2023_08_02_163902_add_fixed_to_project_payroll',44),(1094,'2023_08_09_044543_schedules',45),(1095,'2024_01_21_033756_languages',46),(1096,'2024_01_21_033805_language_libraries',46),(1097,'2024_01_26_091208_add_flag_to_language',46),(1098,'2024_02_27_055942_add_direction_to_language',46),(1099,'2024_11_02_044616_customers',47),(1100,'2024_11_02_044622_suppliers',47),(1101,'2024_11_02_044638_categories',47),(1102,'2024_11_02_044649_sub_categories',47),(1103,'2024_11_02_044751_test_parameters',47),(1104,'2024_11_02_044801_test_methods',47),(1105,'2024_11_02_044809_test_units',47),(1106,'2024_11_02_044820_test_limits',47),(1107,'2024_11_02_045105_test_instrument_techniques',47),(1108,'2024_11_02_045127_tests',47),(1109,'2024_11_02_061459_product_types',48),(1110,'2024_11_02_061527_product_brands',48),(1111,'2024_11_02_061537_product_catgories',48),(1112,'2024_11_02_061541_product_sub_catgories',48),(1113,'2024_11_02_061547_product_units',48),(1114,'2024_11_02_061615_products',49),(1115,'2024_11_02_061621_product_suppliers',49),(1132,'2024_11_04_180431_test_quotations',50),(1133,'2024_11_04_180516_test_quotation_tests',50),(1134,'2024_11_04_180616_job_works',50),(1135,'2024_11_04_180753_job_work_samples',50),(1136,'2024_11_04_180828_job_work_tests',50),(1137,'2024_11_04_180848_job_work_invoices',50),(1138,'2024_11_04_180855_job_work_invoice_payments',50),(1139,'2024_11_04_181958_test_quotation_logs',50),(1140,'2024_11_07_104435_customer_vat',51),(1141,'2024_11_07_173550_customer_company',52),(1142,'2024_11_09_083116_job_work_logs',53),(1143,'2024_11_09_133711_job_work_sample_tests',54),(1144,'2024_11_11_140657_report_logo_switch',55),(1145,'2024_11_15_055221_sample_image',56),(1146,'2024_11_15_055405_invoice_gsm',56),(1157,'2024_11_20_052111_warehouses',59),(1158,'2024_11_20_050103_quotations',60),(1159,'2024_11_20_050207_quotation_items',60),(1160,'2024_11_20_050213_quotation_logs',60),(1161,'2024_11_20_045731_purchases',61),(1162,'2024_11_20_045748_purchase_items',61),(1163,'2024_11_20_045842_purchase_payments',61),(1164,'2024_11_20_045852_purchase_logs',61),(1165,'2024_11_20_050351_sales',62),(1166,'2024_11_20_050413_sale_items',62),(1167,'2024_11_20_050418_sale_logs',62),(1168,'2024_11_20_050452_sale_payments',62),(1171,'2024_11_21_070017_sale_delivery',63),(1172,'2024_11_23_055137_tax_rates',64),(1173,'2024_11_23_055150_email_templates',64),(1174,'2024_11_23_055313_terms',64),(1180,'2024_11_23_055412_add_tax_to_quotation',68),(1181,'2024_11_23_055419_add_tax_to_purchase',69),(1182,'2024_11_23_055428_add_tax_to_sale',70),(1183,'2024_11_24_070447_quotation_term',71),(1184,'2024_11_24_070457_purchase_term',72),(1185,'2024_11_24_070506_sales_term',73),(1186,'2024_12_19_142051_code_nullable',74),(1187,'2024_12_19_145231_job_work_report_comments',75),(1188,'2025_01_19_130247_report_credentials',76),(1189,'2025_01_26_053016_update_quotations',77),(1191,'2025_02_01_033536_test_parameter_groups',79),(1192,'2025_02_01_033546_test_parameter_group_parameters',79),(1193,'2025_02_01_034038_remove_parameter_from_tests',79),(1194,'2025_02_01_053506_add_parameter_group_to_tables',80),(1197,'2025_02_02_053425_job_work_test_parameters',81),(1198,'2025_02_04_150128_update_user',82),(1199,'2025_02_05_153628_branches',83),(1200,'2025_02_05_153634_stations',83),(1201,'2025_02_05_153641_vehicles',83),(1202,'2025_02_05_153649_expense_categories',83),(1210,'2025_02_05_160407_user_branches',85),(1222,'2025_02_05_153748_employees',90),(1228,'2024_11_15_122510_ledgers',92),(1229,'2024_11_15_122529_entries',92),(1230,'2024_11_15_122545_entry_items',92),(1231,'2024_11_16_094650_update_entries',92),(1232,'2025_01_31_150421_opening_balance',92),(1233,'2025_02_05_153848_trips',93),(1234,'2025_02_05_153907_trip_employees',93),(1235,'2025_02_05_153914_trip_passengers',93),(1236,'2025_02_05_153920_trip_passenger_cargos',93),(1237,'2025_02_05_153939_trip_passenger_invoices',93),(1238,'2025_02_08_085353_update_trip_passengers',94),(1241,'2025_02_09_034611_passenger_ticket_info',95),(1242,'2025_02_09_034618_trip_cargos',95),(1245,'2025_02_09_141429_vehicle_number_plate',97),(1246,'2025_02_09_142452_remove_number_plate_from_branch',98),(1247,'2025_02_09_142850_customers',99),(1248,'2025_02_09_144039_update_trip',100),(1253,'2025_02_10_163654_basic_information',102),(1254,'2025_02_11_155023_system_information_arabic',103),(1255,'2025_02_10_160616_features',104),(1256,'2025_02_10_160844_blogs',104),(1257,'2025_02_10_160936_pages',104),(1258,'2025_03_01_074055_suppliers',105),(1259,'2025_03_01_074359_products',105),(1260,'2025_03_01_162111_purchases',106),(1261,'2025_03_01_162130_purchase_logs',106),(1262,'2025_03_01_160912_sales',107),(1263,'2025_03_01_162153_sale_logs',107),(1264,'2025_03_01_160623_Inventory',108),(1265,'2025_03_01_160731_exchanges',109),(1266,'2025_03_01_162223_exchange_logs',109),(1267,'2025_03_01_160811_supplier_balances',110),(1268,'2025_03_01_160818_customer_balances',110),(1269,'2025_03_01_161120_auctions',111),(1270,'2025_03_01_161126_auction_bids',111),(1271,'2025_03_01_162330_auction_logs',111),(1272,'2025_03_01_180711_user_type',112);

/*Table structure for table `model_has_permissions` */

DROP TABLE IF EXISTS `model_has_permissions`;

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_permissions` */

/*Table structure for table `model_has_roles` */

DROP TABLE IF EXISTS `model_has_roles`;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `model_has_roles` */

insert  into `model_has_roles`(`role_id`,`model_type`,`model_id`) values (1,'App\\Models\\User',1),(8,'App\\Models\\User',2),(9,'App\\Models\\User',3),(9,'App\\Models\\User',5),(9,'App\\Models\\User',6),(1,'App\\Models\\User',9),(2,'App\\Models\\User',9),(8,'App\\Models\\User',9),(9,'App\\Models\\User',9),(9,'App\\Models\\User',10),(9,'App\\Models\\User',11),(9,'App\\Models\\User',12),(9,'App\\Models\\User',13),(9,'App\\Models\\User',14),(9,'App\\Models\\User',15),(9,'App\\Models\\User',16),(9,'App\\Models\\User',17),(9,'App\\Models\\User',18),(9,'App\\Models\\User',19),(9,'App\\Models\\User',20),(9,'App\\Models\\User',21),(9,'App\\Models\\User',22),(9,'App\\Models\\User',23),(9,'App\\Models\\User',24),(9,'App\\Models\\User',25),(9,'App\\Models\\User',26),(9,'App\\Models\\User',27),(9,'App\\Models\\User',28),(9,'App\\Models\\User',29),(9,'App\\Models\\User',30),(9,'App\\Models\\User',31),(9,'App\\Models\\User',32),(9,'App\\Models\\User',33),(9,'App\\Models\\User',34),(9,'App\\Models\\User',35),(9,'App\\Models\\User',36),(9,'App\\Models\\User',37),(9,'App\\Models\\User',38),(9,'App\\Models\\User',39),(9,'App\\Models\\User',40),(9,'App\\Models\\User',41),(9,'App\\Models\\User',42),(9,'App\\Models\\User',43),(9,'App\\Models\\User',44),(9,'App\\Models\\User',45),(9,'App\\Models\\User',46),(9,'App\\Models\\User',47),(9,'App\\Models\\User',48),(9,'App\\Models\\User',49),(9,'App\\Models\\User',50),(9,'App\\Models\\User',51),(9,'App\\Models\\User',52),(9,'App\\Models\\User',53),(9,'App\\Models\\User',54),(9,'App\\Models\\User',55),(9,'App\\Models\\User',56),(9,'App\\Models\\User',57),(9,'App\\Models\\User',58),(9,'App\\Models\\User',59),(9,'App\\Models\\User',60),(9,'App\\Models\\User',61),(9,'App\\Models\\User',62),(9,'App\\Models\\User',63),(9,'App\\Models\\User',64),(9,'App\\Models\\User',65),(9,'App\\Models\\User',66),(9,'App\\Models\\User',67),(9,'App\\Models\\User',68),(9,'App\\Models\\User',69),(9,'App\\Models\\User',70),(9,'App\\Models\\User',71),(9,'App\\Models\\User',72),(9,'App\\Models\\User',73),(9,'App\\Models\\User',74),(9,'App\\Models\\User',75),(9,'App\\Models\\User',76),(9,'App\\Models\\User',77),(9,'App\\Models\\User',78),(9,'App\\Models\\User',79),(9,'App\\Models\\User',80),(9,'App\\Models\\User',81),(9,'App\\Models\\User',82),(9,'App\\Models\\User',83),(9,'App\\Models\\User',84),(9,'App\\Models\\User',85),(9,'App\\Models\\User',86),(9,'App\\Models\\User',87),(9,'App\\Models\\User',88),(9,'App\\Models\\User',89),(9,'App\\Models\\User',90),(9,'App\\Models\\User',91),(9,'App\\Models\\User',92),(9,'App\\Models\\User',93),(9,'App\\Models\\User',94),(9,'App\\Models\\User',95),(9,'App\\Models\\User',96),(9,'App\\Models\\User',97),(9,'App\\Models\\User',98),(9,'App\\Models\\User',99),(9,'App\\Models\\User',100),(9,'App\\Models\\User',101),(9,'App\\Models\\User',102),(9,'App\\Models\\User',103),(9,'App\\Models\\User',104),(9,'App\\Models\\User',105),(9,'App\\Models\\User',106),(9,'App\\Models\\User',107),(9,'App\\Models\\User',108),(9,'App\\Models\\User',109),(9,'App\\Models\\User',110),(9,'App\\Models\\User',111),(9,'App\\Models\\User',112),(9,'App\\Models\\User',113),(9,'App\\Models\\User',114),(9,'App\\Models\\User',115),(9,'App\\Models\\User',116),(9,'App\\Models\\User',117),(9,'App\\Models\\User',118),(9,'App\\Models\\User',119),(9,'App\\Models\\User',120),(9,'App\\Models\\User',121),(9,'App\\Models\\User',122),(9,'App\\Models\\User',123),(9,'App\\Models\\User',124),(9,'App\\Models\\User',125),(9,'App\\Models\\User',126),(9,'App\\Models\\User',127),(9,'App\\Models\\User',128),(9,'App\\Models\\User',129),(9,'App\\Models\\User',130),(9,'App\\Models\\User',131),(9,'App\\Models\\User',132),(9,'App\\Models\\User',133),(9,'App\\Models\\User',134),(9,'App\\Models\\User',135),(9,'App\\Models\\User',136),(9,'App\\Models\\User',137),(9,'App\\Models\\User',138),(9,'App\\Models\\User',139),(9,'App\\Models\\User',140),(9,'App\\Models\\User',141),(9,'App\\Models\\User',142),(9,'App\\Models\\User',143),(9,'App\\Models\\User',144),(9,'App\\Models\\User',145),(9,'App\\Models\\User',146),(9,'App\\Models\\User',147),(9,'App\\Models\\User',148),(9,'App\\Models\\User',149),(9,'App\\Models\\User',150),(9,'App\\Models\\User',151),(9,'App\\Models\\User',152),(9,'App\\Models\\User',153),(9,'App\\Models\\User',154),(9,'App\\Models\\User',155),(9,'App\\Models\\User',156),(9,'App\\Models\\User',157),(9,'App\\Models\\User',158),(9,'App\\Models\\User',159),(9,'App\\Models\\User',160),(9,'App\\Models\\User',161),(9,'App\\Models\\User',162),(9,'App\\Models\\User',163),(9,'App\\Models\\User',164),(9,'App\\Models\\User',165),(9,'App\\Models\\User',166),(9,'App\\Models\\User',167),(9,'App\\Models\\User',168),(9,'App\\Models\\User',169),(9,'App\\Models\\User',170),(9,'App\\Models\\User',171),(9,'App\\Models\\User',172),(9,'App\\Models\\User',173),(9,'App\\Models\\User',174),(9,'App\\Models\\User',175),(9,'App\\Models\\User',176),(9,'App\\Models\\User',177),(9,'App\\Models\\User',178),(9,'App\\Models\\User',179),(9,'App\\Models\\User',180),(9,'App\\Models\\User',181),(9,'App\\Models\\User',182),(9,'App\\Models\\User',183),(9,'App\\Models\\User',184),(9,'App\\Models\\User',185),(9,'App\\Models\\User',186),(9,'App\\Models\\User',187),(9,'App\\Models\\User',188),(9,'App\\Models\\User',189),(9,'App\\Models\\User',190),(9,'App\\Models\\User',191),(9,'App\\Models\\User',192),(9,'App\\Models\\User',193),(9,'App\\Models\\User',194),(9,'App\\Models\\User',195),(9,'App\\Models\\User',196),(9,'App\\Models\\User',197),(9,'App\\Models\\User',198),(9,'App\\Models\\User',199),(9,'App\\Models\\User',200),(9,'App\\Models\\User',201),(9,'App\\Models\\User',202),(9,'App\\Models\\User',203),(9,'App\\Models\\User',204),(9,'App\\Models\\User',205),(9,'App\\Models\\User',206),(9,'App\\Models\\User',207),(9,'App\\Models\\User',208),(9,'App\\Models\\User',209),(9,'App\\Models\\User',210),(9,'App\\Models\\User',211),(9,'App\\Models\\User',212),(9,'App\\Models\\User',213),(9,'App\\Models\\User',214),(9,'App\\Models\\User',215),(9,'App\\Models\\User',216),(9,'App\\Models\\User',217),(9,'App\\Models\\User',218),(9,'App\\Models\\User',219),(9,'App\\Models\\User',220),(9,'App\\Models\\User',221),(9,'App\\Models\\User',222),(9,'App\\Models\\User',223),(9,'App\\Models\\User',224),(9,'App\\Models\\User',225),(9,'App\\Models\\User',226),(9,'App\\Models\\User',227),(9,'App\\Models\\User',228),(9,'App\\Models\\User',229),(9,'App\\Models\\User',230),(9,'App\\Models\\User',231),(9,'App\\Models\\User',232),(9,'App\\Models\\User',233),(9,'App\\Models\\User',234),(9,'App\\Models\\User',235),(9,'App\\Models\\User',236),(9,'App\\Models\\User',237),(9,'App\\Models\\User',238),(9,'App\\Models\\User',239),(9,'App\\Models\\User',240),(9,'App\\Models\\User',241),(9,'App\\Models\\User',242),(9,'App\\Models\\User',243),(9,'App\\Models\\User',244),(9,'App\\Models\\User',245),(9,'App\\Models\\User',246),(9,'App\\Models\\User',247),(9,'App\\Models\\User',248),(9,'App\\Models\\User',249),(9,'App\\Models\\User',250),(9,'App\\Models\\User',251),(9,'App\\Models\\User',252),(9,'App\\Models\\User',253),(9,'App\\Models\\User',254),(9,'App\\Models\\User',255),(9,'App\\Models\\User',256),(9,'App\\Models\\User',257),(9,'App\\Models\\User',258),(9,'App\\Models\\User',259),(9,'App\\Models\\User',260),(9,'App\\Models\\User',261),(9,'App\\Models\\User',262),(9,'App\\Models\\User',263),(9,'App\\Models\\User',264),(9,'App\\Models\\User',265),(9,'App\\Models\\User',266),(9,'App\\Models\\User',267),(9,'App\\Models\\User',268),(9,'App\\Models\\User',269),(9,'App\\Models\\User',270),(9,'App\\Models\\User',271),(9,'App\\Models\\User',272),(9,'App\\Models\\User',273),(9,'App\\Models\\User',274),(9,'App\\Models\\User',275),(9,'App\\Models\\User',276),(9,'App\\Models\\User',277),(9,'App\\Models\\User',278),(9,'App\\Models\\User',279),(9,'App\\Models\\User',280),(9,'App\\Models\\User',281),(9,'App\\Models\\User',282),(9,'App\\Models\\User',283),(9,'App\\Models\\User',284),(9,'App\\Models\\User',285),(9,'App\\Models\\User',286),(9,'App\\Models\\User',287),(9,'App\\Models\\User',288),(9,'App\\Models\\User',289),(9,'App\\Models\\User',290),(9,'App\\Models\\User',291),(9,'App\\Models\\User',292),(9,'App\\Models\\User',293),(9,'App\\Models\\User',294),(9,'App\\Models\\User',295),(9,'App\\Models\\User',296),(9,'App\\Models\\User',297),(9,'App\\Models\\User',298),(9,'App\\Models\\User',299),(9,'App\\Models\\User',300),(9,'App\\Models\\User',301),(9,'App\\Models\\User',302),(9,'App\\Models\\User',303),(9,'App\\Models\\User',304),(9,'App\\Models\\User',305),(9,'App\\Models\\User',306),(9,'App\\Models\\User',307),(9,'App\\Models\\User',308),(9,'App\\Models\\User',309),(9,'App\\Models\\User',310),(9,'App\\Models\\User',311),(9,'App\\Models\\User',312),(9,'App\\Models\\User',313),(9,'App\\Models\\User',314),(9,'App\\Models\\User',315),(9,'App\\Models\\User',316),(9,'App\\Models\\User',317),(9,'App\\Models\\User',318),(9,'App\\Models\\User',319),(9,'App\\Models\\User',320),(9,'App\\Models\\User',321),(9,'App\\Models\\User',322),(9,'App\\Models\\User',323),(9,'App\\Models\\User',324),(9,'App\\Models\\User',325),(9,'App\\Models\\User',326),(9,'App\\Models\\User',327),(9,'App\\Models\\User',328),(9,'App\\Models\\User',329),(9,'App\\Models\\User',330),(9,'App\\Models\\User',331),(9,'App\\Models\\User',332),(9,'App\\Models\\User',333),(9,'App\\Models\\User',334),(9,'App\\Models\\User',335),(9,'App\\Models\\User',336),(9,'App\\Models\\User',337),(9,'App\\Models\\User',338),(9,'App\\Models\\User',339),(9,'App\\Models\\User',340),(9,'App\\Models\\User',341),(9,'App\\Models\\User',342),(9,'App\\Models\\User',343),(9,'App\\Models\\User',344),(9,'App\\Models\\User',345),(9,'App\\Models\\User',346),(9,'App\\Models\\User',347),(9,'App\\Models\\User',348),(9,'App\\Models\\User',349),(9,'App\\Models\\User',350),(9,'App\\Models\\User',351),(9,'App\\Models\\User',352),(9,'App\\Models\\User',353),(9,'App\\Models\\User',354),(9,'App\\Models\\User',355),(9,'App\\Models\\User',356),(9,'App\\Models\\User',357),(9,'App\\Models\\User',358),(9,'App\\Models\\User',359),(9,'App\\Models\\User',360),(9,'App\\Models\\User',361),(9,'App\\Models\\User',362),(9,'App\\Models\\User',363),(9,'App\\Models\\User',364),(9,'App\\Models\\User',365),(9,'App\\Models\\User',366),(9,'App\\Models\\User',367),(9,'App\\Models\\User',368),(9,'App\\Models\\User',369),(9,'App\\Models\\User',370),(9,'App\\Models\\User',371),(9,'App\\Models\\User',372),(9,'App\\Models\\User',373),(9,'App\\Models\\User',374),(9,'App\\Models\\User',375),(9,'App\\Models\\User',376),(9,'App\\Models\\User',377),(9,'App\\Models\\User',378),(9,'App\\Models\\User',379),(9,'App\\Models\\User',380),(9,'App\\Models\\User',381),(9,'App\\Models\\User',382),(9,'App\\Models\\User',383),(9,'App\\Models\\User',384),(9,'App\\Models\\User',385),(9,'App\\Models\\User',386),(9,'App\\Models\\User',387),(9,'App\\Models\\User',388),(9,'App\\Models\\User',389),(9,'App\\Models\\User',390),(9,'App\\Models\\User',391),(9,'App\\Models\\User',392),(9,'App\\Models\\User',393),(9,'App\\Models\\User',394),(9,'App\\Models\\User',395),(9,'App\\Models\\User',396),(9,'App\\Models\\User',397),(9,'App\\Models\\User',398),(9,'App\\Models\\User',399),(9,'App\\Models\\User',400),(9,'App\\Models\\User',401),(9,'App\\Models\\User',402),(9,'App\\Models\\User',403),(9,'App\\Models\\User',404),(9,'App\\Models\\User',405),(9,'App\\Models\\User',406),(9,'App\\Models\\User',407),(9,'App\\Models\\User',408),(9,'App\\Models\\User',409),(9,'App\\Models\\User',410),(9,'App\\Models\\User',411),(9,'App\\Models\\User',412),(9,'App\\Models\\User',413),(9,'App\\Models\\User',414),(9,'App\\Models\\User',415),(9,'App\\Models\\User',416),(9,'App\\Models\\User',417),(9,'App\\Models\\User',418),(9,'App\\Models\\User',419),(9,'App\\Models\\User',420),(9,'App\\Models\\User',421),(9,'App\\Models\\User',422),(9,'App\\Models\\User',423),(9,'App\\Models\\User',424),(9,'App\\Models\\User',425),(9,'App\\Models\\User',426),(9,'App\\Models\\User',427),(9,'App\\Models\\User',428),(9,'App\\Models\\User',429),(9,'App\\Models\\User',430),(9,'App\\Models\\User',431),(9,'App\\Models\\User',432),(9,'App\\Models\\User',433),(9,'App\\Models\\User',434),(9,'App\\Models\\User',435),(9,'App\\Models\\User',436),(9,'App\\Models\\User',437),(9,'App\\Models\\User',438),(9,'App\\Models\\User',439),(9,'App\\Models\\User',440),(9,'App\\Models\\User',441),(9,'App\\Models\\User',442),(9,'App\\Models\\User',443),(9,'App\\Models\\User',444),(9,'App\\Models\\User',445),(9,'App\\Models\\User',446),(9,'App\\Models\\User',447),(9,'App\\Models\\User',448),(9,'App\\Models\\User',449),(9,'App\\Models\\User',450),(9,'App\\Models\\User',451),(9,'App\\Models\\User',452),(9,'App\\Models\\User',453),(9,'App\\Models\\User',454),(9,'App\\Models\\User',455),(9,'App\\Models\\User',456),(9,'App\\Models\\User',457),(9,'App\\Models\\User',458),(9,'App\\Models\\User',459),(9,'App\\Models\\User',460),(9,'App\\Models\\User',461),(9,'App\\Models\\User',462),(9,'App\\Models\\User',463),(9,'App\\Models\\User',464),(9,'App\\Models\\User',465),(9,'App\\Models\\User',466),(9,'App\\Models\\User',467),(9,'App\\Models\\User',468),(9,'App\\Models\\User',469),(9,'App\\Models\\User',470),(9,'App\\Models\\User',471),(9,'App\\Models\\User',472),(9,'App\\Models\\User',473),(9,'App\\Models\\User',474),(9,'App\\Models\\User',475),(9,'App\\Models\\User',476),(9,'App\\Models\\User',477),(9,'App\\Models\\User',478),(9,'App\\Models\\User',479),(9,'App\\Models\\User',480),(9,'App\\Models\\User',481),(9,'App\\Models\\User',482),(9,'App\\Models\\User',483),(9,'App\\Models\\User',484),(9,'App\\Models\\User',485),(9,'App\\Models\\User',486),(9,'App\\Models\\User',487),(9,'App\\Models\\User',488),(9,'App\\Models\\User',489),(9,'App\\Models\\User',490),(9,'App\\Models\\User',491),(9,'App\\Models\\User',492),(9,'App\\Models\\User',493),(9,'App\\Models\\User',494),(9,'App\\Models\\User',495),(9,'App\\Models\\User',496),(9,'App\\Models\\User',497),(9,'App\\Models\\User',498),(9,'App\\Models\\User',499),(9,'App\\Models\\User',500),(9,'App\\Models\\User',501),(9,'App\\Models\\User',502),(9,'App\\Models\\User',503),(9,'App\\Models\\User',504),(9,'App\\Models\\User',505),(9,'App\\Models\\User',506),(9,'App\\Models\\User',507),(9,'App\\Models\\User',508),(9,'App\\Models\\User',509),(9,'App\\Models\\User',510),(9,'App\\Models\\User',511),(9,'App\\Models\\User',512),(9,'App\\Models\\User',513),(9,'App\\Models\\User',514),(9,'App\\Models\\User',515),(9,'App\\Models\\User',516),(9,'App\\Models\\User',517),(9,'App\\Models\\User',518),(9,'App\\Models\\User',519),(9,'App\\Models\\User',520),(9,'App\\Models\\User',521),(9,'App\\Models\\User',522),(9,'App\\Models\\User',523),(9,'App\\Models\\User',524),(9,'App\\Models\\User',525),(9,'App\\Models\\User',526),(9,'App\\Models\\User',527),(9,'App\\Models\\User',528),(9,'App\\Models\\User',529),(9,'App\\Models\\User',530),(9,'App\\Models\\User',531),(9,'App\\Models\\User',532),(9,'App\\Models\\User',533),(9,'App\\Models\\User',534),(9,'App\\Models\\User',535),(9,'App\\Models\\User',536),(9,'App\\Models\\User',537),(9,'App\\Models\\User',538),(9,'App\\Models\\User',539),(9,'App\\Models\\User',540),(9,'App\\Models\\User',541),(9,'App\\Models\\User',542),(9,'App\\Models\\User',543),(9,'App\\Models\\User',544),(9,'App\\Models\\User',545),(9,'App\\Models\\User',546),(9,'App\\Models\\User',547),(9,'App\\Models\\User',548),(9,'App\\Models\\User',549),(9,'App\\Models\\User',550),(9,'App\\Models\\User',551),(9,'App\\Models\\User',552),(9,'App\\Models\\User',553),(9,'App\\Models\\User',554),(9,'App\\Models\\User',555),(9,'App\\Models\\User',556),(9,'App\\Models\\User',557),(9,'App\\Models\\User',558),(9,'App\\Models\\User',559),(9,'App\\Models\\User',560),(9,'App\\Models\\User',561),(9,'App\\Models\\User',562),(9,'App\\Models\\User',563),(9,'App\\Models\\User',564),(9,'App\\Models\\User',565),(9,'App\\Models\\User',566),(9,'App\\Models\\User',567),(9,'App\\Models\\User',568),(9,'App\\Models\\User',569),(9,'App\\Models\\User',570),(9,'App\\Models\\User',571),(9,'App\\Models\\User',572),(9,'App\\Models\\User',573),(9,'App\\Models\\User',574),(9,'App\\Models\\User',575),(9,'App\\Models\\User',576),(9,'App\\Models\\User',577),(9,'App\\Models\\User',578),(9,'App\\Models\\User',579),(9,'App\\Models\\User',580),(9,'App\\Models\\User',581),(9,'App\\Models\\User',582),(9,'App\\Models\\User',583),(9,'App\\Models\\User',584),(9,'App\\Models\\User',585),(9,'App\\Models\\User',586),(9,'App\\Models\\User',587),(9,'App\\Models\\User',588),(9,'App\\Models\\User',589),(9,'App\\Models\\User',590),(9,'App\\Models\\User',591),(9,'App\\Models\\User',592),(9,'App\\Models\\User',593),(9,'App\\Models\\User',594),(9,'App\\Models\\User',595),(9,'App\\Models\\User',596),(9,'App\\Models\\User',597),(9,'App\\Models\\User',598),(9,'App\\Models\\User',599),(9,'App\\Models\\User',600),(9,'App\\Models\\User',601),(9,'App\\Models\\User',602),(9,'App\\Models\\User',603),(9,'App\\Models\\User',604),(9,'App\\Models\\User',605),(9,'App\\Models\\User',606),(9,'App\\Models\\User',607),(9,'App\\Models\\User',608),(9,'App\\Models\\User',609),(9,'App\\Models\\User',610),(9,'App\\Models\\User',611),(9,'App\\Models\\User',612),(9,'App\\Models\\User',613),(9,'App\\Models\\User',614),(9,'App\\Models\\User',615),(9,'App\\Models\\User',616),(9,'App\\Models\\User',617),(9,'App\\Models\\User',618),(9,'App\\Models\\User',619),(9,'App\\Models\\User',620),(9,'App\\Models\\User',621),(9,'App\\Models\\User',622),(9,'App\\Models\\User',623),(9,'App\\Models\\User',624),(9,'App\\Models\\User',625),(9,'App\\Models\\User',626),(9,'App\\Models\\User',627),(9,'App\\Models\\User',628),(9,'App\\Models\\User',629),(9,'App\\Models\\User',630),(9,'App\\Models\\User',631),(9,'App\\Models\\User',632),(9,'App\\Models\\User',633),(9,'App\\Models\\User',634),(9,'App\\Models\\User',635),(9,'App\\Models\\User',636),(9,'App\\Models\\User',637),(9,'App\\Models\\User',638),(9,'App\\Models\\User',639),(9,'App\\Models\\User',640),(9,'App\\Models\\User',641),(9,'App\\Models\\User',642),(9,'App\\Models\\User',643),(9,'App\\Models\\User',644),(9,'App\\Models\\User',645),(9,'App\\Models\\User',646),(9,'App\\Models\\User',647),(9,'App\\Models\\User',648),(9,'App\\Models\\User',649),(9,'App\\Models\\User',650),(9,'App\\Models\\User',651),(9,'App\\Models\\User',652),(9,'App\\Models\\User',653),(9,'App\\Models\\User',654),(9,'App\\Models\\User',655),(9,'App\\Models\\User',656),(9,'App\\Models\\User',657),(9,'App\\Models\\User',658),(9,'App\\Models\\User',659),(9,'App\\Models\\User',660),(9,'App\\Models\\User',661),(9,'App\\Models\\User',662),(9,'App\\Models\\User',663),(9,'App\\Models\\User',664),(9,'App\\Models\\User',665),(9,'App\\Models\\User',666),(9,'App\\Models\\User',667),(9,'App\\Models\\User',668),(9,'App\\Models\\User',669),(9,'App\\Models\\User',670);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `serial` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`route`,`icon`,`desc`,`serial`,`status`,`created_at`,`updated_at`) values (6,'Setups','setups','fas fa-cogs',NULL,0,1,'2020-05-15 21:58:39','2023-01-27 05:44:13'),(7,'People','peoples','fa fa-users',NULL,30,1,'2020-05-18 03:15:30','2025-02-06 07:11:53'),(16,'Publishments','publishment','far fa-envelope',NULL,100,1,'2020-07-23 00:54:47','2025-02-06 07:14:24'),(25,'Language','language','fas fa-globe',NULL,10,1,'2024-10-31 20:54:38','2024-11-02 20:22:56'),(33,'Master','master','fas fa-tasks',NULL,20,1,'2025-02-06 07:11:34','2025-02-06 07:11:44'),(34,'Trip','trip','fas fa-bus-alt',NULL,40,1,'2025-02-06 07:13:41','2025-02-06 07:13:41'),(36,'Finance','finance','fas fa-money-check-alt',NULL,50,1,'2025-02-08 04:52:48','2025-02-08 04:52:48'),(37,'Content','content','fas fa-tasks',NULL,60,1,'2025-02-11 08:26:46','2025-02-11 08:26:46');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `module` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4723 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`module`,`name`,`guard_name`,`created_at`,`updated_at`) values (3831,'Publishments','publishments-index','web',NULL,NULL),(3833,'Publishments','publishments-edit','web',NULL,NULL),(3834,'Publishments','publishments-delete','web',NULL,NULL),(3863,'Setups','system-information','web',NULL,NULL),(3903,'Setups','modules-index','web',NULL,NULL),(3904,'Setups','modules-create','web',NULL,NULL),(3905,'Setups','modules-edit','web',NULL,NULL),(3906,'Setups','modules-delete','web',NULL,NULL),(3907,'Setups','menu-index','web',NULL,NULL),(3908,'Setups','menu-create','web',NULL,NULL),(3909,'Setups','menu-edit','web',NULL,NULL),(3910,'Setups','menu-delete','web',NULL,NULL),(3911,'Setups','submenu-index','web',NULL,NULL),(3912,'Setups','submenu-create','web',NULL,NULL),(3913,'Setups','submenu-edit','web',NULL,NULL),(3914,'Setups','submenu-delete','web',NULL,NULL),(3915,'Setups','roles-index','web',NULL,NULL),(3916,'Setups','roles-create','web',NULL,NULL),(3917,'Setups','roles-edit','web',NULL,NULL),(3918,'Setups','roles-delete','web',NULL,NULL),(3919,'Setups','role-permissions','web',NULL,NULL),(4175,'Setups','publishment-types-index','web',NULL,NULL),(4176,'Setups','publishment-types-create','web',NULL,NULL),(4177,'Setups','publishment-types-edit','web',NULL,NULL),(4178,'Setups','publishment-types-delete','web',NULL,NULL),(4247,'Setups','permissions-index','web',NULL,NULL),(4248,'Setups','permissions-create','web',NULL,NULL),(4249,'Setups','permissions-edit','web',NULL,NULL),(4250,'Setups','permissions-delete','web',NULL,NULL),(4266,'Publishments','publishments-create','web','2023-03-14 04:59:08','2023-03-14 04:59:08'),(4267,'Setups','company-index','web','2023-07-09 23:54:46','2023-07-09 23:54:46'),(4268,'Setups','company-create','web','2023-07-09 23:54:46','2023-07-09 23:54:46'),(4269,'Setups','company-edit','web','2023-07-09 23:54:46','2023-07-09 23:54:46'),(4270,'Setups','company-delete','web','2023-07-09 23:54:46','2023-07-09 23:54:46'),(4393,'Setups','countries-index','web','2023-07-31 00:50:32','2023-07-31 00:50:32'),(4394,'Setups','countries-create','web','2023-07-31 00:50:32','2023-07-31 00:50:32'),(4395,'Setups','countries-edit','web','2023-07-31 00:50:32','2023-07-31 00:50:32'),(4396,'Setups','countries-delete','web','2023-07-31 00:50:32','2023-07-31 00:50:32'),(4398,'Setups','crons','web','2023-08-09 16:29:01','2023-08-09 16:29:01'),(4436,'Language','language-index','web','2024-10-31 20:53:46','2024-10-31 20:53:46'),(4437,'Language','language-create','web','2024-10-31 20:53:46','2024-10-31 20:53:46'),(4438,'Language','language-edit','web','2024-10-31 20:53:46','2024-10-31 20:53:46'),(4439,'Language','language-delete','web','2024-10-31 20:53:46','2024-10-31 20:53:46'),(4440,'Language','language-library','web','2024-10-31 20:53:46','2024-10-31 20:53:46'),(4643,'Setups','religions-index','web','2025-02-05 07:23:18','2025-02-05 07:23:18'),(4644,'Setups','religions-create','web','2025-02-05 07:23:18','2025-02-05 07:23:18'),(4645,'Setups','religions-edit','web','2025-02-05 07:23:18','2025-02-05 07:23:18'),(4646,'Setups','religions-delete','web','2025-02-05 07:23:18','2025-02-05 07:23:18'),(4647,'People','users-index','web','2025-02-05 07:31:30','2025-02-05 07:31:30'),(4648,'People','users-create','web','2025-02-05 07:31:30','2025-02-05 07:31:30'),(4649,'People','users-edit','web','2025-02-05 07:31:30','2025-02-05 07:31:30'),(4650,'People','users-delete','web','2025-02-05 07:31:30','2025-02-05 07:31:30'),(4663,'People','employee-index','web','2025-02-06 07:10:09','2025-02-06 07:10:09'),(4664,'People','employee-create','web','2025-02-06 07:10:09','2025-02-06 07:10:09'),(4665,'People','employee-edit','web','2025-02-06 07:10:09','2025-02-06 07:10:09'),(4666,'People','employee-delete','web','2025-02-06 07:10:09','2025-02-06 07:10:09'),(4681,'Finance','ledger-index','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4682,'Finance','ledger-create','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4683,'Finance','ledger-edit','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4684,'Finance','ledger-delete','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4685,'Finance','entry-index','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4686,'Finance','entry-create','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4687,'Finance','entry-edit','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4688,'Finance','entry-delete','web','2024-11-16 05:11:39','2024-11-16 05:11:39'),(4689,'Finance','finance-report-index','web','2024-11-16 05:12:16','2024-11-16 05:12:16'),(4690,'Finance','finance-report-print','web','2024-11-16 05:12:16','2024-11-16 05:12:16'),(4691,'Finance','finance-report-pdf','web','2024-11-16 05:12:16','2024-11-16 05:12:16'),(4692,'Finance','finance-report-excel','web','2024-11-16 05:12:16','2024-11-16 05:12:16'),(4693,'Finance','opening-balance','web','2025-02-01 07:07:52','2025-02-01 07:07:52'),(4694,'Finance','opening-balance-print','web','2025-02-01 07:07:52','2025-02-01 07:07:52'),(4695,'Finance','opening-balance-pdf','web','2025-02-01 07:07:52','2025-02-01 07:07:52'),(4696,'Finance','opening-balance-excel','web','2025-02-01 07:07:52','2025-02-01 07:07:52'),(4706,'Master','customer-index','web','2025-02-10 06:32:50','2025-02-10 06:32:50'),(4707,'Master','customer-create','web','2025-02-10 06:32:50','2025-02-10 06:32:50'),(4708,'Master','customer-edit','web','2025-02-10 06:32:50','2025-02-10 06:32:50'),(4709,'Master','customer-delete','web','2025-02-10 06:32:50','2025-02-10 06:32:50');

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `fine_points` longtext COLLATE utf8mb4_unicode_ci,
  `categories` longtext COLLATE utf8mb4_unicode_ci,
  `tags` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `additional_information` longtext COLLATE utf8mb4_unicode_ci,
  `delivery_information` longtext COLLATE utf8mb4_unicode_ci,
  `shopping_information` longtext COLLATE utf8mb4_unicode_ci,
  `composition_and_care` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

/*Table structure for table `publishment_types` */

DROP TABLE IF EXISTS `publishment_types`;

CREATE TABLE `publishment_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `publishment_types` */

insert  into `publishment_types`(`id`,`name`,`desc`,`status`,`created_at`,`updated_at`) values (1,'Holidays',NULL,1,'2020-08-23 01:24:22','2020-08-23 01:25:44'),(2,'Emergency',NULL,1,'2020-08-23 01:24:41','2020-08-23 01:24:41'),(3,'Notice',NULL,1,'2020-08-23 01:24:48','2020-08-23 01:24:48'),(4,'Festival',NULL,1,'2020-08-23 01:24:55','2020-08-23 01:24:55');

/*Table structure for table `publishments` */

DROP TABLE IF EXISTS `publishments`;

CREATE TABLE `publishments` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `publishment_type_id` bigint unsigned NOT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `attachments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `publishments_publishment_type_id_foreign` (`publishment_type_id`),
  CONSTRAINT `publishments_publishment_type_id_foreign` FOREIGN KEY (`publishment_type_id`) REFERENCES `publishment_types` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `publishments` */

/*Table structure for table `purchase_logs` */

DROP TABLE IF EXISTS `purchase_logs`;

CREATE TABLE `purchase_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint unsigned NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchase_logs_purchase_id_foreign` (`purchase_id`),
  KEY `purchase_logs_creator_id_foreign` (`creator_id`),
  KEY `purchase_logs_editor_id_foreign` (`editor_id`),
  CONSTRAINT `purchase_logs_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_logs_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchase_logs_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchase_logs` */

/*Table structure for table `purchases` */

DROP TABLE IF EXISTS `purchases`;

CREATE TABLE `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `asking_price` double NOT NULL DEFAULT '0',
  `purchase_price` double NOT NULL DEFAULT '0',
  `taken_at` datetime DEFAULT NULL,
  `purchased_at` datetime DEFAULT NULL,
  `status` enum('taken','verified','purchased','denied') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'taken',
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_customer_id_foreign` (`customer_id`),
  KEY `purchases_product_id_foreign` (`product_id`),
  KEY `purchases_creator_id_foreign` (`creator_id`),
  KEY `purchases_editor_id_foreign` (`editor_id`),
  CONSTRAINT `purchases_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchases_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchases_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `purchases_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `purchases` */

/*Table structure for table `role_has_permissions` */

DROP TABLE IF EXISTS `role_has_permissions`;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `role_has_permissions` */

insert  into `role_has_permissions`(`permission_id`,`role_id`) values (3831,1),(3833,1),(3834,1),(3863,1),(3903,1),(3904,1),(3905,1),(3906,1),(3907,1),(3908,1),(3909,1),(3910,1),(3911,1),(3912,1),(3913,1),(3914,1),(3915,1),(3916,1),(3917,1),(3918,1),(3919,1),(4175,1),(4176,1),(4177,1),(4178,1),(4247,1),(4248,1),(4249,1),(4250,1),(4266,1),(4267,1),(4268,1),(4269,1),(4270,1),(4393,1),(4394,1),(4395,1),(4396,1),(4398,1),(4436,1),(4437,1),(4438,1),(4439,1),(4440,1),(4643,1),(4644,1),(4645,1),(4646,1),(4647,1),(4648,1),(4649,1),(4650,1),(4663,1),(4664,1),(4665,1),(4666,1),(4681,1),(4682,1),(4683,1),(4684,1),(4685,1),(4686,1),(4687,1),(4688,1),(4689,1),(4690,1),(4691,1),(4692,1),(4693,1),(4694,1),(4695,1),(4696,1),(4706,1),(4707,1),(4708,1),(4709,1),(3831,2),(3833,2),(3834,2),(3863,2),(3903,2),(3904,2),(3905,2),(3906,2),(3907,2),(3908,2),(3909,2),(3910,2),(3911,2),(3912,2),(3913,2),(3914,2),(3915,2),(3916,2),(3917,2),(3918,2),(3919,2),(4175,2),(4176,2),(4177,2),(4178,2),(4247,2),(4248,2),(4249,2),(4250,2),(4266,2),(4267,2),(4268,2),(4269,2),(4270,2),(4393,2),(4394,2),(4395,2),(4396,2);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `roles` */

insert  into `roles`(`id`,`name`,`guard_name`,`created_at`,`updated_at`) values (1,'Super Admin','web','2023-01-26 03:51:05','2023-01-26 03:51:05'),(2,'Admin','web','2023-01-26 03:51:05','2023-01-26 03:51:05'),(8,'Manager','web','2023-01-26 03:51:05','2023-01-26 03:51:05'),(9,'Employee','web','2023-01-26 03:51:05','2023-01-26 03:51:05');

/*Table structure for table `sale_logs` */

DROP TABLE IF EXISTS `sale_logs`;

CREATE TABLE `sale_logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` bigint unsigned NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `log` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_logs_sale_id_foreign` (`sale_id`),
  KEY `sale_logs_creator_id_foreign` (`creator_id`),
  KEY `sale_logs_editor_id_foreign` (`editor_id`),
  CONSTRAINT `sale_logs_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_logs_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sale_logs_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sale_logs` */

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint unsigned NOT NULL,
  `product_id` bigint unsigned NOT NULL,
  `price` double NOT NULL DEFAULT '0',
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_product_id_foreign` (`product_id`),
  KEY `sales_creator_id_foreign` (`creator_id`),
  KEY `sales_editor_id_foreign` (`editor_id`),
  CONSTRAINT `sales_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sales_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `sales` */

/*Table structure for table `submenu` */

DROP TABLE IF EXISTS `submenu`;

CREATE TABLE `submenu` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `menu_id` bigint unsigned NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `serial` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submenu_menu_id_foreign` (`menu_id`),
  CONSTRAINT `submenu_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `submenu` */

insert  into `submenu`(`id`,`menu_id`,`name`,`route`,`icon`,`desc`,`serial`,`status`,`created_at`,`updated_at`) values (1,8,'Modules','modules','fa fa-tasks',NULL,1,1,'2020-05-16 00:46:36','2020-05-16 00:46:36'),(2,8,'Menu','menu','fa fa-tasks',NULL,2,1,'2020-05-16 00:47:39','2020-05-16 00:47:39'),(3,8,'Submenu','submenu','fa fa-tasks',NULL,3,1,'2020-05-16 00:47:52','2020-05-16 00:47:52'),(5,10,'Roles','roles','fab fa-accessible-icon',NULL,1,1,'2020-05-16 04:40:50','2020-05-16 04:40:50'),(6,10,'Role Permissions','role-permissions','fab fa-angellist',NULL,0,1,'2020-05-16 04:42:12','2020-05-16 04:42:12'),(26,13,'Religions','religions','fa fa-tasks',NULL,10,1,'2020-05-18 03:57:44','2020-05-18 03:57:44'),(93,10,'Permissions','permissions','fas fa-question-circle',NULL,3,1,'2023-01-26 02:10:26','2023-01-26 02:10:26'),(107,8,'Crons','crons','fa fa-cogs',NULL,4,1,'2023-08-09 16:29:43','2023-08-09 16:29:43');

/*Table structure for table `submenu_permissions` */

DROP TABLE IF EXISTS `submenu_permissions`;

CREATE TABLE `submenu_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `submenu_id` bigint unsigned NOT NULL,
  `permission_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submenu_permissions_submenu_id_foreign` (`submenu_id`),
  KEY `submenu_permissions_permission_id_foreign` (`permission_id`),
  CONSTRAINT `submenu_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `submenu_permissions_submenu_id_foreign` FOREIGN KEY (`submenu_id`) REFERENCES `submenu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=823 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `submenu_permissions` */

insert  into `submenu_permissions`(`id`,`submenu_id`,`permission_id`,`created_at`,`updated_at`) values (350,1,3903,NULL,NULL),(351,1,3904,NULL,NULL),(352,1,3905,NULL,NULL),(353,1,3906,NULL,NULL),(354,2,3907,NULL,NULL),(355,2,3908,NULL,NULL),(356,2,3909,NULL,NULL),(357,2,3910,NULL,NULL),(358,3,3911,NULL,NULL),(359,3,3912,NULL,NULL),(360,3,3913,NULL,NULL),(361,3,3914,NULL,NULL),(362,5,3915,NULL,NULL),(363,5,3916,NULL,NULL),(364,5,3917,NULL,NULL),(365,5,3918,NULL,NULL),(366,6,3919,NULL,NULL),(694,93,4247,NULL,NULL),(695,93,4248,NULL,NULL),(696,93,4249,NULL,NULL),(697,93,4250,NULL,NULL),(733,107,4398,'2023-08-09 16:29:43','2023-08-09 16:29:43');

/*Table structure for table `supplier_balances` */

DROP TABLE IF EXISTS `supplier_balances`;

CREATE TABLE `supplier_balances` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint unsigned NOT NULL,
  `type` enum('cash-pay','exchange-in','exchange-out') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash-pay',
  `exchange_id` bigint unsigned DEFAULT NULL,
  `datetime` datetime NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `creator_id` bigint unsigned DEFAULT NULL,
  `editor_id` bigint unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_balances_supplier_id_foreign` (`supplier_id`),
  KEY `supplier_balances_exchange_id_foreign` (`exchange_id`),
  KEY `supplier_balances_creator_id_foreign` (`creator_id`),
  KEY `supplier_balances_editor_id_foreign` (`editor_id`),
  CONSTRAINT `supplier_balances_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `supplier_balances_editor_id_foreign` FOREIGN KEY (`editor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `supplier_balances_exchange_id_foreign` FOREIGN KEY (`exchange_id`) REFERENCES `exchanges` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `supplier_balances_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `supplier_balances` */

/*Table structure for table `suppliers` */

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text COLLATE utf8mb4_unicode_ci,
  `email` text COLLATE utf8mb4_unicode_ci,
  `address` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `suppliers` */

/*Table structure for table `system_information` */

DROP TABLE IF EXISTS `system_information`;

CREATE TABLE `system_information` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `motto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tagline` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `skype` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `linked_in` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_logo_in_report` enum('yes','no') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `secondary_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `test_report_header_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_header_left_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_header_right_logo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_remarks` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_notes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_approver` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `test_report_footer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `whatsapp_1` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `whatsapp_2` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner_text` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `about_the_company` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `banner` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `map` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `system_information` */

insert  into `system_information`(`id`,`name`,`description`,`motto`,`tagline`,`phone`,`mobile`,`address`,`email`,`website`,`twitter`,`facebook`,`instagram`,`skype`,`linked_in`,`logo`,`show_logo_in_report`,`secondary_logo`,`icon`,`test_report_header_title`,`test_report_header_left_logo`,`test_report_header_right_logo`,`test_report_remarks`,`test_report_notes`,`test_report_approver`,`test_report_footer`,`whatsapp_1`,`whatsapp_2`,`banner_text`,`about_the_company`,`banner`,`map`,`status`,`created_at`,`updated_at`) values (1,'HR SkyWatches','Auction & Exchange','HR SkyWatches','Auction & Exchange','025565313','025565313','World','info@hrskywatches.com','https://','#','#','#','#','https://bd.linkedin.com','1-20250301112714-1310474742-243431771.png','yes','1-20250301112714-659370840-443269289.png','1-20250301112807-511306480-1311336410.png','RACS TESTING AND CONFORMITY LLC','1-20250119173631-517047455-465289676.png','1-20250119173658-624150586-1665200469.jpg','1) No symbol: Accredited as per 17025, 2) “*”: Not Accredited, 3) ”***\' : Subcontracted lab Comply ISO 17025, 4) LOQ - Limit of Quantification 5) NA - Not Applicable 6) mm - millimeters &amp; mg - milligrams 7) CFU- Colony forming unit 8) PPM – Parts per Million 9) PPB- Parts per Billion','<p>1) These results apply only to the sample(s) submitted and received by the lab and not to the product from which it was taken.</p><p><span style=\"font-size: 1rem;\">2) The Report shall not be reproduced except in full, without written approval from RACS.</span></p><p><span style=\"font-size: 1rem;\">3) All test parameters requested by customer.</span></p><p><span style=\"font-size: 1rem;\">4) Any feedback / complaints about this report should be communicated in writing within 07 days of issuing this report.</span></p><p><span style=\"font-size: 1rem;\">5) Imperishable Sample will be destroyed after 01 month and Perishable samples will be destroyed after one week.</span></p><p><span style=\"font-size: 1rem;\">6) This report is not to be reproduced wholly or in parts as evidence in a court of law. If the customer needs to use the test report as evidence in court of law, they must inform the laboratory in advance by writing to follow the necessary procedures.</span></p>','<p style=\"text-align: center; \">Mr. Govindarao Ampolu</p><p style=\"text-align: center; \">Lab Manager</p><p style=\"text-align: center; \">RACS Testing and Conformity LLC</p>','<div style=\"text-align: center;\"><span style=\"font-size: 1rem;\">Marina Building Ground Floor, Building No.: 1549, Way 5026. Opp: Al-Maha Petrol Station, Ghala Heights, Postal Code 130, Tel: +968 24 210091, Muscat, Sultanate of Oman.</span></div>','00971508181853','00971555434390','{\"en\":\"<p>Your ideal partner Flights without limits, A comfort you trust<\\/p>\",\"ar-AE\":\"<p>\\u0634\\u0631\\u064a\\u0643\\u0643 \\u0627\\u0644\\u0645\\u062b\\u0627\\u0644\\u064a . . .<\\/p><p>\\u0631\\u062d\\u0644\\u0627\\u062a \\u0628\\u0644\\u0627 \\u062d\\u062f\\u0648\\u062f\\u060c \\u0631\\u0627\\u062d\\u0629 \\u062a\\u062b\\u0642 \\u0628\\u0647\\u0627<\\/p>\"}','{\"en\":\"<p>We are here to change the concept of international transport. Royal Express offers an unforgettable travel experience, where safety and comfort meet in our modern fleet of buses. Our team of professional drivers leads your trips with experience and skill, focusing on meeting your needs. We believe that every trip should be special, so we offer our services at competitive prices that make us the perfect choice for travelers looking for a unique and comfortable experience.<\\/p>\",\"ar-AE\":\"<p>\\u0646\\u062d\\u0646 \\u0647\\u0646\\u0627 \\u0644\\u0646\\u063a\\u064a\\u0631 \\u0645\\u0641\\u0647\\u0648\\u0645 \\u0627\\u0644\\u0646\\u0642\\u0644 \\u0627\\u0644\\u062f\\u0648\\u0644\\u064a. \\u062a\\u0642\\u062f\\u0645 \\u0631\\u0648\\u064a\\u0627\\u0644 \\u0627\\u0643\\u0633\\u0628\\u0631\\u0633 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0633\\u0641\\u0631 \\u0644\\u0627 \\u062a\\u064f\\u0646\\u0633\\u0649, \\u062d\\u064a\\u062b \\u064a\\u062c\\u062a\\u0645\\u0639 \\u0627\\u0644\\u0623\\u0645\\u0627\\u0646 \\u0648\\u0627\\u0644\\u0631\\u0627\\u062d\\u0629 \\u0641\\u064a \\u0623\\u0633\\u0637\\u0648\\u0644\\u0646\\u0627 \\u0627\\u0644\\u062d\\u062f\\u064a\\u062b \\u0645\\u0646 \\u0627\\u0644\\u062d\\u0627\\u0641\\u0644\\u0627\\u062a. \\u064a\\u0642\\u0648\\u062f \\u0641\\u0631\\u064a\\u0642\\u0646\\u0627 \\u0645\\u0646 \\u0627\\u0644\\u0633\\u0627\\u0626\\u0642\\u064a\\u0646 \\u0627\\u0644\\u0645\\u062d\\u062a\\u0631\\u0641\\u064a\\u0646 \\u0631\\u062d\\u0644\\u0627\\u062a\\u0643 \\u0628\\u062e\\u0628\\u0631\\u0629 \\u0648\\u0645\\u0647\\u0627\\u0631\\u0629\\u060c \\u0645\\u0639 \\u0627\\u0644\\u062a\\u0631\\u0643\\u064a\\u0632 \\u0639\\u0644\\u0649 \\u062a\\u0644\\u0628\\u064a\\u0629 \\u0627\\u062d\\u062a\\u064a\\u0627\\u062c\\u0627\\u062a\\u0643. \\u0646\\u062d\\u0646 \\u0646\\u0624\\u0645\\u0646 \\u0628\\u0623\\u0646 \\u0643\\u0644 \\u0631\\u062d\\u0644\\u0629 \\u064a\\u062c\\u0628 \\u0623\\u0646 \\u062a\\u0643\\u0648\\u0646 \\u0645\\u0645\\u064a\\u0632\\u0629\\u060c \\u0644\\u0630\\u0627 \\u0646\\u0642\\u062f\\u0645 \\u062e\\u062f\\u0645\\u0627\\u062a\\u0646\\u0627 \\u0628\\u0623\\u0633\\u0639\\u0627\\u0631 \\u062a\\u0646\\u0627\\u0641\\u0633\\u064a\\u0629 \\u062a\\u062c\\u0639\\u0644\\u0646\\u0627 \\u0627\\u0644\\u062e\\u064a\\u0627\\u0631 \\u0627\\u0644\\u0623\\u0645\\u062b\\u0644 \\u0644\\u0644\\u0645\\u0633\\u0627\\u0641\\u0631\\u064a\\u0646 \\u0627\\u0644\\u0628\\u0627\\u062d\\u062b\\u064a\\u0646 \\u0639\\u0646 \\u062a\\u062c\\u0631\\u0628\\u0629 \\u0641\\u0631\\u064a\\u062f\\u0629 \\u0648\\u0645\\u0631\\u064a\\u062d\\u0629 .<\\/p>\"}','1-20250219210857-434418125-1774799981.jpg','https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14546.05148939983!2d54.6263534!3d24.2937394!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5e37165770b8c9%3A0x2133f8c32a4e8d4c!2z2LHZiNmK2KfZhCDYp9mD2LPYqNix2LMg2YTZhNmG2YLZhCDYp9mE2K_ZiNmE2Yo!5e0!3m2!1sar!2sae!4v1729964338712!5m2!1sar!2sae',1,NULL,'2025-03-01 11:33:03');

/*Table structure for table `user_column_visibilities` */

DROP TABLE IF EXISTS `user_column_visibilities`;

CREATE TABLE `user_column_visibilities` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `columns` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_column_visibilities_user_id_foreign` (`user_id`),
  CONSTRAINT `user_column_visibilities_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `user_column_visibilities` */

insert  into `user_column_visibilities`(`id`,`user_id`,`url`,`columns`,`created_at`,`updated_at`) values (1,1,'http://localhost:8000/setups/permissions','[\"true\",\"true\",\"true\",\"true\",\"true\"]','2023-01-27 02:52:28','2023-01-27 02:52:51'),(2,1,'http://localhost:8000/biotime/biotime-employees','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"false\",\"false\",\"false\",\"true\",\"false\",\"false\",\"false\",\"true\"]','2023-02-23 04:26:55','2023-02-23 04:27:03'),(3,1,'http://localhost:8000/attendance/manual-attendances','[\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\",\"true\"]','2023-07-11 02:15:44','2023-07-11 02:15:49');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` int NOT NULL DEFAULT '1',
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_developer` int NOT NULL DEFAULT '0',
  `type` enum('admin','customer','supplier') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `customer_id` bigint unsigned DEFAULT NULL,
  `supplier_id` bigint unsigned DEFAULT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int NOT NULL DEFAULT '1',
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_customer_id_foreign` (`customer_id`),
  KEY `users_supplier_id_foreign` (`supplier_id`),
  CONSTRAINT `users_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `users_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`gender`,`username`,`email_verified_at`,`password`,`is_developer`,`type`,`customer_id`,`supplier_id`,`image`,`status`,`remember_token`,`created_at`,`updated_at`) values (1,'Super Admin','admin@trip.com',1,'super-admin',NULL,'$2y$10$vS.HcJr6d/qkxOu/JlRC0e2WFaNZW5leKGR0gRaEn3gB5DJLr.IRK',1,'admin',NULL,NULL,NULL,1,NULL,'2022-08-24 08:20:45','2025-02-05 08:21:36'),(9,'Arafat Anwar','anwarullah834@gmail.com',1,'abdulrehman',NULL,'$2y$10$KD88AmfATNIr2T9U9KcsguAeyYPQB9JxZOI67rcQNdiPLVMEh1lLS',0,'admin',NULL,NULL,'uploads/user-images/419710809-311479002.png',1,NULL,'2025-02-05 08:08:20','2025-02-14 23:56:32');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
