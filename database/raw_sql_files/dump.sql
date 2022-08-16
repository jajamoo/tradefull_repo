

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
SET NAMES utf8mb4;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


DROP TABLE IF EXISTS `creatives`;

CREATE TABLE `creatives` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) unsigned NOT NULL,
    `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `creatives_user_id_index` (`user_id`),
    CONSTRAINT `creatives_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `creatives` WRITE;
/*!40000 ALTER TABLE `creatives` DISABLE KEYS */;

INSERT INTO `creatives` (`id`, `user_id`, `image_url`, `created_at`, `updated_at`)
VALUES
    (1,1,'https://bucket.s3.amazonsaws.com/images/image.jpg','2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `creatives` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table order_line_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `order_line_items`;

CREATE TABLE `order_line_items` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `order_id` bigint(20) unsigned NOT NULL,
    `product_id` bigint(20) unsigned NOT NULL,
    `quantity` smallint(5) unsigned NOT NULL,
    `vendor_id` bigint(20) unsigned NOT NULL,
    `shipped_at` timestamp NULL DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `order_line_items_order_id_index` (`order_id`),
    KEY `order_line_items_product_id_index` (`product_id`),
    KEY `order_line_items_vendor_id_index` (`vendor_id`),
    CONSTRAINT `order_line_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
    CONSTRAINT `order_line_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
    CONSTRAINT `order_line_items_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `order_line_items` WRITE;
/*!40000 ALTER TABLE `order_line_items` DISABLE KEYS */;

INSERT INTO `order_line_items` (`id`, `order_id`, `product_id`, `quantity`, `vendor_id`, `shipped_at`, `created_at`, `updated_at`)
VALUES
    (45678,12345,12,1,1,NULL,'2021-06-08 00:00:00','2021-06-08 00:00:00'),
    (45679,12345,13,3,2,NULL,'2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `order_line_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `user_id` bigint(20) unsigned NOT NULL,
    `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `state` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `postal_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `orders_user_id_index` (`user_id`),
    CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;

INSERT INTO `orders` (`id`, `user_id`, `first_name`, `last_name`, `address_1`, `address_2`, `city`, `state`, `postal_code`, `country`, `created_at`, `updated_at`)
VALUES
    (12345,1,'John','Doe','123 Main Street',NULL,'Santa Monica','CA','90014','US','2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_type_vendor
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_type_vendor`;

CREATE TABLE `product_type_vendor` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `product_type_id` bigint(20) unsigned NOT NULL,
    `vendor_id` bigint(20) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY `product_type_vendor_product_type_id_index` (`product_type_id`),
    KEY `product_type_vendor_vendor_id_index` (`vendor_id`),
    CONSTRAINT `product_type_vendor_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`),
    CONSTRAINT `product_type_vendor_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `vendors` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product_type_vendor` WRITE;
/*!40000 ALTER TABLE `product_type_vendor` DISABLE KEYS */;

INSERT INTO `product_type_vendor` (`id`, `product_type_id`, `vendor_id`)
VALUES
    (1,1,1),
    (2,2,2);

/*!40000 ALTER TABLE `product_type_vendor` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product_types`;

CREATE TABLE `product_types` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product_types` WRITE;
/*!40000 ALTER TABLE `product_types` DISABLE KEYS */;

INSERT INTO `product_types` (`id`, `name`, `created_at`, `updated_at`)
VALUES
    (1,'Fine Art Print','2021-06-08 00:00:00','2021-06-08 00:00:00'),
    (2,'T-shirt','2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `product_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table products
# ------------------------------------------------------------

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `creative_id` bigint(20) unsigned NOT NULL,
    `product_type_id` bigint(20) unsigned NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    `deleted_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `products_creative_id_index` (`creative_id`),
    KEY `products_product_type_id_index` (`product_type_id`),
    CONSTRAINT `products_creative_id_foreign` FOREIGN KEY (`creative_id`) REFERENCES `creatives` (`id`),
    CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;

INSERT INTO `products` (`id`, `creative_id`, `product_type_id`, `created_at`, `updated_at`, `deleted_at`)
VALUES
    (12,1,1,'2021-06-08 00:00:00','2021-06-08 00:00:00',NULL),
    (13,1,2,'2021-06-08 00:00:00','2021-06-08 00:00:00',NULL);

/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `email_verified_at` timestamp NULL DEFAULT NULL,
    `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_unique` (`email`),
    UNIQUE KEY `users_api_token_unique` (`api_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`)
VALUES
    (1,'William','william Wallace <william.wallace@leafgroup.com>',NULL,'$2y$10$HwKpJl920MbZukc.a62YpOWtCRwLoW5i.SLvkIYxNBsKxeurIs6r6','ScukuepUoGL0ywMufxheQMscLJqi5BXa7s4LkbECiauOXj40krZyQcMjo7ZChIuxklkGBuOQnqN7f8Dm',NULL,'2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vendors
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vendors`;

CREATE TABLE `vendors` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp NULL DEFAULT NULL,
    `updated_at` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;

INSERT INTO `vendors` (`id`, `name`, `created_at`, `updated_at`)
VALUES
    (1,'Marco Fine Arts','2021-06-08 00:00:00','2021-06-08 00:00:00'),
    (2,'DreamJunction','2021-06-08 00:00:00','2021-06-08 00:00:00');

/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

