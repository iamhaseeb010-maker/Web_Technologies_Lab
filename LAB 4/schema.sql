-- 1. Create the Database
CREATE DATABASE IF NOT EXISTS `crud_system` 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE `crud_system`;

-- 2. Create the Students Table
CREATE TABLE IF NOT EXISTS `students` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(150) NOT NULL,
  `dob` DATE DEFAULT NULL,
  `course` VARCHAR(150) DEFAULT NULL,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;