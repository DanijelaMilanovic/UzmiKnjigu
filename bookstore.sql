-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 06:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--
CREATE DATABASE IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookstore`;

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `author_id_UNIQUE` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `first_name`, `last_name`) VALUES
(1, 'Vene', 'Bogoslavov '),
(2, 'Danijel ', 'Mijić '),
(3, 'Vladimir', 'Vujović '),
(4, 'Mirjana ', 'Maksimović '),
(5, 'Srđan ', 'Nogo '),
(6, 'Vuk', 'Milatović '),
(7, 'Tomislav ', 'Šipovac '),
(8, 'Branko ', 'Savić');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `author_id` int(11) UNSIGNED DEFAULT NULL,
  `publisher_id` int(11) UNSIGNED DEFAULT NULL,
  `title_id` int(11) UNSIGNED DEFAULT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `state_id` int(11) UNSIGNED DEFAULT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `publishing_year` int(11) UNSIGNED NOT NULL,
  `pages` int(11) UNSIGNED NOT NULL,
  `status_id` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_book_user1_idx` (`user_id`),
  KEY `fk_book_state1_idx` (`state_id`),
  KEY `fk_book_title1_idx` (`title_id`),
  KEY `fk_book_author1_idx` (`author_id`),
  KEY `fk_book_publisher1_idx` (`publisher_id`),
  KEY `fk_book_status` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `author_id`, `publisher_id`, `title_id`, `user_id`, `state_id`, `price`, `publishing_year`, `pages`, `status_id`) VALUES
(1, 8, 2, 1, 1, 1, '10.00', 2006, 200, 1),
(2, 8, 2, 1, 1, 1, '10.00', 2006, 200, 1),
(3, 8, 1, 1, 1, 1, '22.00', 2005, 200, 1),
(4, 8, 1, 1, 1, 1, '22.00', 2005, 200, 1),
(5, 7, 2, 2, 1, 3, '20.00', 2004, 200, 1),
(6, 7, 2, 2, 1, 3, '20.00', 2004, 200, 1),
(7, 7, 2, 2, 1, 3, '20.00', 2004, 200, 1),
(8, 1, 3, 1, 1, 3, '10.00', 2003, 200, 1),
(9, 1, 3, 1, 1, 3, '10.00', 2003, 200, 1),
(10, 1, 1, 2, 1, 1, '23.00', 2005, 200, 1),
(11, 1, 2, 3, 1, 1, '10.00', 2005, 200, 1),
(12, 1, 1, 3, 1, 1, '10.00', 2003, 20, 1),
(13, 1, 1, 1, 1, 1, '10.00', 2003, 20, 1),
(14, 1, 1, 4, 1, 1, '10.00', 2003, 20, 1),
(15, 1, 1, 1, 1, 1, '10.00', 2003, 20, 1),
(16, 1, 1, 1, 1, 1, '10.00', 2003, 20, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(45) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_id_UNIQUE` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Osnovna škola'),
(2, 'Srednja škola'),
(3, 'Fakultet');

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `image_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` int(11) UNSIGNED NOT NULL,
  `image_url` varchar(45) NOT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_id_UNIQUE` (`image_id`),
  UNIQUE KEY `image_url_UNIQUE` (`image_url`),
  KEY `fk_image_book1_idx` (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `residence` varchar(45) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  UNIQUE KEY `publisher_id_UNIQUE` (`publisher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `residence`) VALUES
(1, 'ZUNS Istočno Sarajevo', 'Nikole Tesle 58, Istočno Novo Sarajevo'),
(2, 'ZUNS Beograd', 'Obilićev venac 5, Beograd'),
(3, 'Akademska Misao Beograd', 'Bulevar Kralja Aleksandra 73, Beograd');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_name` varchar(45) NOT NULL,
  PRIMARY KEY (`state_id`),
  UNIQUE KEY `state_id_UNIQUE` (`state_id`),
  UNIQUE KEY `state_UNIQUE` (`state_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Dobro'),
(3, 'Loše'),
(2, 'Srednje');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status_name`) VALUES
(1, 'Slobodno'),
(2, 'Prodato'),
(3, 'Rezervisano');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE IF NOT EXISTS `title` (
  `title_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(11) UNSIGNED NOT NULL,
  `title_name` varchar(45) NOT NULL,
  `school_class` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`title_id`),
  UNIQUE KEY `title_id_UNIQUE` (`title_id`),
  KEY `fk_title_category1_idx` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `category_id`, `title_name`, `school_class`) VALUES
(1, 1, 'Bukvar', '2'),
(2, 1, 'Učim da pišem', '2'),
(3, 2, 'Zbirka rešenih zadataka iz matematike I', '1'),
(4, 2, 'Zbirka rešenih zadataka iz matematike II', '2'),
(5, 2, 'Zbirka rešenih zadataka iz matematike III', '3'),
(6, 2, 'Zbirka zadataka iz matematike za IV razred gi', '4'),
(7, 3, 'Uvod u veb programiranje', '4'),
(8, 3, 'Prenos podataka', '3'),
(9, 3, 'Projektovanje i dizajn softvera', '4'),
(10, 3, 'Baze podataka', '3');

-- --------------------------------------------------------

--
-- Table structure for table `type_of_user`
--

CREATE TABLE IF NOT EXISTS `type_of_user` (
  `type_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  PRIMARY KEY (`type_id`),
  UNIQUE KEY `type_id_UNIQUE` (`type_id`),
  UNIQUE KEY `type_UNIQUE` (`type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_of_user`
--

INSERT INTO `type_of_user` (`type_id`, `type`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `description` text DEFAULT NULL,
  `profile_picture` varchar(45) DEFAULT NULL,
  `user_type` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `e-mail_UNIQUE` (`email`),
  KEY `fk_user_type_usera_idx` (`user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `description`, `profile_picture`, `user_type`) VALUES
(1, 'Stefan', 'Jokic', '$2y$10$RSpsCBK0YIdtu0IOha2LaOJpS/RgDvm3mp5mfaDZuTAAYKLRpCPlm', 'stefan.jokic99@hotmail.com', NULL, NULL, 2),
(3, 'Danijela', 'Milanovic', '$2y$10$JaBnSLqFIrm/kuOXp.uuS.oht3zr7ea4PTAtBu5dwy0cojWFHxLn2', 'danijelamilanovic222@gmail.com', NULL, NULL, 2),
(4, 'Stefan', 'Jokic', '$2y$10$bD0H1bzUwV/EHs./lXanNOEvSwvLfYECwdVAnwxDF35cN8N5yGDai', 'stefan.jokic123@hotmail.com', NULL, NULL, 2),
(5, 'Test', 'Test', '$2y$10$5TLv6EUGkHhnV0MXt/5u8eVa62gHlFWBuzWAxa3QhjS0.ye5bpdB2', 'test@test.com', NULL, NULL, 2),
(6, 'Testiranje', 'Test', '$2y$10$cSAZCqR75fzUn5p9X9VJneas8X9CLLuQFOvX.XkqFX5Hwp.afcQtq', 'testiranje@email.com', NULL, NULL, 2),
(7, 'Test', 'Test', '$2y$10$CBnFauVEwgiuBhI3BAxudOyx3C9Sb/x3YZbSt/EZ3AABDZg1Mr6AW', 'tes232t@test.com', NULL, NULL, 2),
(8, 'Stefan', 'Jokic', '$2y$10$4DoDAA9ueLL556fdRAWkq.oc5eIC.NLvUcR4YXyL9EiL1R2jdFNi.', 'stefan.jokic.2002@student.etf.ues.rs.ba', NULL, NULL, 2),
(9, 'Testic', 'testic', '$2y$10$PC.eok.ul.r4o.583GfReOspHxOckG2RGlnw5jJlv/jnwgYYGHD2u', 'sda@sd.com', NULL, NULL, 2),
(10, 'Stef', 'Joka', '$2y$10$i2cOdadnL1mfSs5.irCyquZlOXLk3CxyM163Y7w7vawnKjU5VOQay', 'stef@joka.com', NULL, NULL, 2),
(11, 'ASA', 'ASA', '$2y$10$aPflvnCOM89HxkAauMS09.N7M5.px7a8h.SeXkkzrZdHGp9qzytAi', 'asa@asa.com', NULL, NULL, 2),
(12, 'ASq', 'asw', '$2y$10$H1IPj/cigyGmxK7X.SHt3uAAOEIjyRcrsRbo5Z.M6Lz3X2NwhBh3q', 'sa@sa.com', NULL, NULL, 2),
(13, 'Asas', 'asas', '$2y$10$tSzSQOYV82XFsTAHjjgBL.qTGnDLh3M8YGaua/sx9YpPK.NRenzFq', 'asas@sda.com', NULL, NULL, 2),
(14, 'aasda', 'sadsa', '$2y$10$FJtljUdrKbL8xdXwfnb4YeBOkcgIcLBcRsWDF/g4kplthVh454tny', 'sdas23@dsajd.com', NULL, NULL, 2),
(15, 'sds', 'sada', '$2y$10$KFKKIwrlsjOCWvA6AJyXzOkJCQW04dwoy7KC7uKPmq1hMSmyvcmpO', 's@sdsad.com', NULL, NULL, 2),
(16, 'Testic', 'test', '$2y$10$QXNVFhc7znmQiHHlL7xJr.9/DXvUZmiVJMSNu8lJUw4UieYY4cWKC', 'ster@stef.com', NULL, NULL, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `fk_book_author` FOREIGN KEY (`author_id`) REFERENCES `author` (`author_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_publisher` FOREIGN KEY (`publisher_id`) REFERENCES `publisher` (`publisher_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_state` FOREIGN KEY (`state_id`) REFERENCES `state` (`state_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_title` FOREIGN KEY (`title_id`) REFERENCES `title` (`title_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_book_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `fk_image_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON UPDATE CASCADE;

--
-- Constraints for table `title`
--
ALTER TABLE `title`
  ADD CONSTRAINT `fk_title_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_type_usera` FOREIGN KEY (`user_type`) REFERENCES `type_of_user` (`type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
