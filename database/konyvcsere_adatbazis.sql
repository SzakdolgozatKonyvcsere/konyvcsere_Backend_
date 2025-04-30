-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2025 at 09:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `konyvcsere`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_book_offers_by_quality` (IN `p_operator` VARCHAR(2), IN `p_quality` INT)   begin
            if p_operator = '<' then
                select * from book_offers where quality < p_quality;
            elseif p_operator = '<=' then
                select * from book_offers where quality <= p_quality;
            elseif p_operator = '>' then
                select * from book_offers where quality > p_quality;
            elseif p_operator = '>=' then
                select * from book_offers where quality >= p_quality;
            elseif p_operator = '=' then
                select * from book_offers where quality = p_quality;
            else
                signal sqlstate '45000' set message_text = 'Hiba! Érvénytelen operátor';
            end if;
        end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE `authors` (
  `author_id` bigint(20) UNSIGNED NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`, `created_at`, `updated_at`) VALUES
(1, 'Móricz Zsigmond', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(2, 'Kosztolányi Dezső', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(3, 'Jókai Mór', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(4, 'Szerb Antal', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(5, 'Leiner Laura', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(6, 'Kerstin Gier', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(7, 'Agatha Christie', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(8, 'Gárdonyi Géza', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(9, 'Popper Péter', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(10, 'J. R. R. Tolkien', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(11, 'Rick Riordan', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(12, 'Dr. Bagdy Emőke', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(13, 'Koltai Mária', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(14, 'Pál Ferenc', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(15, 'Stephen King', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(16, 'Owen King', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(17, 'J. K. Rowling', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(18, 'Anatolij Kuzmicsov', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(19, 'Popov', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(20, 'Dan Brown', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(21, 'Zsadányi Edit', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(22, 'Nógrádi Gergely', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(23, 'Jeff Kinney', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(24, 'George Orwell', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(25, 'Tamási Áron', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(26, 'Robert Louis Stevenson', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(27, 'C. G. Jung', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(28, 'Jim Pinnels', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(29, 'Petőfi Sándor', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(30, 'Zrínyi Miklós', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(31, 'Honoré de Balzac', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(32, 'Turbucz Dávid', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(33, 'Mikszáth Kálmán', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(34, 'Karinthy Frigyes', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(35, 'Michael Cole', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(36, 'Sheila R. Cole', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `book_demands`
--

CREATE TABLE `book_demands` (
  `demand_id` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `publisher` bigint(20) UNSIGNED DEFAULT NULL,
  `work` bigint(20) UNSIGNED DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `min_publication_year` int(11) DEFAULT NULL,
  `max_publication_year` int(11) DEFAULT NULL,
  `demand_status` char(255) NOT NULL DEFAULT 'k',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ;

--
-- Dumping data for table `book_demands`
--

INSERT INTO `book_demands` (`demand_id`, `user`, `publisher`, `work`, `language`, `min_publication_year`, `max_publication_year`, `demand_status`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 11, NULL, 2000, 2010, 'k', NULL, NULL),
(2, 2, NULL, 36, NULL, 2020, 2025, 'k', NULL, NULL),
(3, 2, 2, 37, 'magyar', 2005, 2025, 'k', NULL, NULL),
(4, 2, NULL, 15, 'holland', 1997, 2005, 't', NULL, NULL),
(5, 2, NULL, 28, 'magyar', 2015, 2025, 'e', NULL, NULL),
(6, 3, NULL, 18, 'magyar', NULL, NULL, 'k', NULL, NULL),
(7, 3, 2, 38, 'magyar', 2006, 2006, 'k', NULL, NULL),
(8, 3, NULL, 2, 'magyar', 2010, 2025, 't', NULL, NULL),
(9, 3, NULL, 30, 'magyar', 2020, 2025, 'e', NULL, NULL),
(10, 4, NULL, 20, 'magyar', 2000, 2025, 't', NULL, NULL),
(11, 5, 9, 9, NULL, 2000, 2020, 'k', NULL, NULL),
(12, 5, 3, 29, 'magyar', 2000, 2025, 'e', NULL, NULL);

--
-- Triggers `book_demands`
--
DELIMITER $$
CREATE TRIGGER `check_demand_status_values` BEFORE INSERT ON `book_demands` FOR EACH ROW begin
                if not exists (select 1 from dictionaries where type = 'demand_status' and value = new.demand_status) then
                    signal sqlstate '45000' set message_text = 'invalid demand_status value';
                end if;
            end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `book_offers`
--

CREATE TABLE `book_offers` (
  `offer_id` bigint(20) UNSIGNED NOT NULL,
  `user` bigint(20) UNSIGNED NOT NULL,
  `publisher` bigint(20) UNSIGNED NOT NULL,
  `work` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(255) NOT NULL,
  `publication_year` int(11) NOT NULL,
  `quality` int(11) NOT NULL,
  `book_status` char(255) NOT NULL DEFAULT 's',
  `img_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `book_offers`
--

INSERT INTO `book_offers` (`offer_id`, `user`, `publisher`, `work`, `language`, `publication_year`, `quality`, `book_status`, `img_url`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'magyar', 2022, 5, 's', 'books_pictures/LegyJoMindhalaligMoricz.jpg', '2025-04-25 07:43:29', '2025-04-25 07:43:29'),
(2, 2, 2, 2, 'magyar', 2019, 4, 's', 'books_pictures/kosztolanyiedesanna.jpg', '2025-03-25 09:43:29', '2025-03-25 09:43:29'),
(3, 2, 3, 3, 'magyar', 2013, 3, 's', 'books_pictures/RokonokMoricz.jpg', '2024-12-15 10:40:30', '2024-12-15 10:40:30'),
(4, 2, 4, 4, 'magyar', 2021, 4, 's', 'books_pictures/KoszivuEuropaK.jpg', '2025-02-02 14:45:35', '2025-02-02 14:50:20'),
(5, 2, 6, 6, 'magyar', 2023, 4, 's', 'books_pictures/NemEgyszeruLeiner.jpg', '2025-03-23 13:22:55', '2025-03-23 13:22:55'),
(6, 2, 7, 7, 'magyar', 2015, 3, 's', 'books_pictures/RubinvorosGier.jpg', '2025-04-11 16:44:07', '2025-04-11 16:44:07'),
(7, 2, 8, 8, 'magyar', 2024, 5, 's', 'books_pictures/OsziBorzongasChristie.jpg', '2025-04-14 15:02:06', '2025-04-14 15:02:06'),
(8, 2, 9, 9, 'magyar', 2022, 4, 's', 'books_pictures/EgriCsillagokKreativK.jpg', '2025-03-25 15:33:17', '2025-03-25 15:33:17'),
(9, 2, 17, 24, 'magyar', 2016, 4, 'e', 'books_pictures/KincsesSzigetStevenson.jpg', '2025-01-13 13:46:28', '2025-01-13 13:46:28'),
(10, 2, 3, 29, 'magyar', 2024, 5, 'e', 'books_pictures/SzigetiVeszedelemZrinyi.jpg', '2024-12-22 14:39:03', '2024-12-22 14:39:03'),
(11, 2, 5, 32, 'magyar', 2024, 5, 'f', 'books_pictures/UtasEsHoldvilagSzerb.jpg', '2025-02-22 11:34:51', '2025-02-22 11:34:51'),
(12, 3, 10, 10, 'magyar', 2023, 5, 's', 'books_pictures/LelekragcsalokPopper.jpg', '2025-02-13 13:13:32', '2025-02-13 13:13:32'),
(13, 3, 5, 11, 'magyar', 2025, 5, 's', 'books_pictures/HobbitTolkien.jpg', '2025-02-18 12:34:23', '2025-02-18 12:34:23'),
(14, 3, 7, 12, 'magyar', 2016, 2, 's', 'books_pictures/SzornyekTengereRiordan.jpg', '2025-03-20 08:02:32', '2025-03-20 08:02:32'),
(15, 3, 10, 13, 'magyar', 2011, 4, 's', 'books_pictures/BelenkEgettMultBagdy.jpg', '2025-02-11 07:07:57', '2025-02-11 07:07:57'),
(16, 3, 4, 14, 'magyar', 2023, 5, 's', 'books_pictures/CsipkerozsikakKing.jpg', '2025-03-21 09:34:12', '2025-03-21 09:34:12'),
(17, 3, 11, 15, 'holland', 2001, 3, 's', 'books_pictures/HPholland.jpg', '2025-04-12 09:54:23', '2025-04-12 09:54:23'),
(18, 3, 4, 25, 'magyar', 2009, 3, 'e', 'books_pictures/NemZorogAHarasztChristie.jpg', '2025-03-24 11:43:11', '2025-03-24 11:43:11'),
(19, 3, 19, 27, 'angol', 1990, 2, 'e', 'books_pictures/WritingProcessPinnels.jpg', '2025-03-02 12:46:56', '2025-03-02 12:46:56'),
(20, 3, 5, 31, 'magyar', 2022, 4, 'e', 'books_pictures/ApendragonLegendaSzerb.jpg', '2025-04-10 12:23:49', '2025-04-10 12:23:49'),
(21, 4, 12, 16, 'magyar', 1987, 3, 's', 'books_pictures/MarciusiSzelKuzmicsov.jpg', '2025-04-16 11:49:11', '2025-04-16 11:49:11'),
(22, 4, 13, 17, 'magyar', 1951, 4, 's', 'books_pictures/AcelEsSalakPopov.jpg', '2025-04-05 13:11:08', '2025-04-05 13:11:08'),
(23, 4, 14, 18, 'angol', 2004, 4, 's', 'books_pictures/TheDaVinciCodeBrown.jpg', '2025-04-11 11:28:19', '2025-04-11 11:28:19'),
(24, 4, 15, 19, 'magyar', 2025, 5, 's', 'books_pictures/MegszolalAzAlarendeltZsadanyi.jpg', '2025-03-01 14:20:55', '2025-03-01 14:20:55'),
(25, 4, 4, 9, 'magyar', 2023, 5, 's', 'books_pictures/EgriCsillagokEuropaK.jpg', '2025-01-27 18:19:03', '2025-01-27 18:19:03'),
(26, 4, 1, 23, 'magyar', 1963, 3, 'e', 'books_pictures/HazaiTukorTamasi.jpg', '2025-01-14 19:43:19', '2025-01-14 19:43:19'),
(27, 4, 18, 26, 'magyar', 2021, 5, 'e', 'books_pictures/ASzellemCGJung.jpg', '2025-02-06 16:40:27', '2025-02-06 16:40:27'),
(28, 4, 3, 34, 'magyar', 2024, 5, 'f', 'books_pictures/GoirotApoBalzac.jpg', '2025-02-16 15:26:06', '2025-02-16 15:26:06'),
(29, 5, 16, 20, 'magyar', 2023, 5, 's', 'books_pictures/KoszivuNogradiJokai.jpg', '2025-03-11 13:17:10', '2025-03-11 13:17:10'),
(30, 5, 7, 21, 'magyar', 2016, 2, 's', 'books_pictures/RopiNaplojaKinney.jpg', '2025-03-28 11:15:36', '2025-03-28 11:15:36'),
(31, 5, 4, 22, 'magyar', 2020, 5, 'e', 'books_pictures/AllatfarmOrwell.jpg', '2025-03-01 18:52:07', '2025-03-01 18:52:07'),
(32, 5, 9, 28, 'magyar', 2022, 5, 'e', 'books_pictures/JanosVitezPetofi.jpg', '2025-04-17 20:04:25', '2025-04-17 20:04:25'),
(33, 5, 8, 30, 'magyar', 2023, 3, 'e', 'books_pictures/OtKismalacChristie.jpg', '2025-04-22 14:26:11', '2025-04-22 14:26:11'),
(34, 5, 2, 33, 'magyar', 2024, 5, 'f', 'books_pictures/EstiKornelKosztolanyi.jpg', '2025-03-18 13:22:54', '2025-03-18 13:22:54'),
(35, 5, 20, 35, 'magyar', 2014, 5, 'f', 'books_pictures/HorthyMiklosTubucz.jpg', '2025-03-04 11:16:33', '2025-03-04 11:16:33');

--
-- Triggers `book_offers`
--
DELIMITER $$
CREATE TRIGGER `check_book_status_values` BEFORE INSERT ON `book_offers` FOR EACH ROW begin
                if not exists (select 1 from dictionaries where type = 'book_status' and value = new.book_status) then
                    signal sqlstate '45000' set message_text = 'invalid book_status value';
                end if;
            end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `publication_year_not_in_future_insert` AFTER INSERT ON `book_offers` FOR EACH ROW BEGIN
                IF NEW.publication_year > YEAR(CURDATE()) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! Jövőbeli kiadási dátum nem megengedett.';
                END IF;
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `publication_year_not_in_future_update` BEFORE UPDATE ON `book_offers` FOR EACH ROW BEGIN
                IF NEW.publication_year > YEAR(CURDATE()) THEN
                    SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Hiba! Jövőbeli kiadási dátum nem megengedett.';
                END IF;
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dictionaries`
--

CREATE TABLE `dictionaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dictionaries`
--

INSERT INTO `dictionaries` (`id`, `type`, `value`, `created_at`, `updated_at`) VALUES
(1, 'demand_status', 'e', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(2, 'demand_status', 'k', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(3, 'demand_status', 't', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(4, 'demand_status', 'x', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(5, 'book_status', 'e', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(6, 'book_status', 'f', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(7, 'book_status', 's', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(8, 'book_status', 'x', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(9, 'exchange_status', 'a', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(10, 'exchange_status', 'k', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(11, 'exchange_status', 'f', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(12, 'exchange_status', 'v', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(13, 'exchange_status', 'x', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_histories`
--

CREATE TABLE `exchange_histories` (
  `exchange_id` bigint(20) UNSIGNED NOT NULL,
  `interested_user` bigint(20) UNSIGNED NOT NULL,
  `desired_item` bigint(20) UNSIGNED NOT NULL,
  `offered_item` bigint(20) UNSIGNED DEFAULT NULL,
  `exchange_status` char(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exchange_histories`
--

INSERT INTO `exchange_histories` (`exchange_id`, `interested_user`, `desired_item`, `offered_item`, `exchange_status`, `created_at`, `updated_at`) VALUES
(1, 4, 32, 27, 'a', '2025-04-25 21:44:22', '2025-04-26 10:16:33'),
(2, 3, 10, 19, 'a', '2025-04-25 20:33:17', '2025-04-27 14:37:04'),
(3, 3, 28, 20, 'a', '2025-04-26 21:44:22', '2025-04-26 10:16:33'),
(4, 3, 33, 11, 'a', '2025-04-26 16:22:10', '2025-04-27 10:06:03'),
(5, 3, 34, 21, 'a', '2025-04-27 08:03:55', '2025-04-27 17:39:24'),
(6, 4, 5, NULL, 'k', '2025-04-26 18:26:11', '2025-04-26 18:26:11'),
(7, 2, 35, NULL, 'k', '2025-04-27 09:27:53', '2025-04-27 09:27:53'),
(8, 4, 29, NULL, 'f', '2025-04-28 10:11:42', '2025-04-28 10:11:42');

--
-- Triggers `exchange_histories`
--
DELIMITER $$
CREATE TRIGGER `check_exchange_status_values` BEFORE INSERT ON `exchange_histories` FOR EACH ROW begin
                if not exists (select 1 from dictionaries where type = 'exchange_status' and value = new.exchange_status) then
                    signal sqlstate '45000' set message_text = 'invalid exchange_status value';
                end if;
            end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `genres`
--

CREATE TABLE `genres` (
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `genre_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `genres`
--

INSERT INTO `genres` (`genre_id`, `genre_name`, `created_at`, `updated_at`) VALUES
(1, 'Regény', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(2, 'Sci-Fi', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(3, 'Fantasy', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(4, 'Dráma', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(5, 'Horror', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(6, 'Romantikus', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(7, 'Kaland', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(8, 'Krimi', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(9, 'Thriller', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(10, 'Történelmi', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(11, 'Életrajzi', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(12, 'Szatíra', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(13, 'Humor', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(14, 'Disztópia', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(15, 'Posztapokaliptikus', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(16, 'Gasztronómiai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(17, 'Pszichológiai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(18, 'Háborús', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(19, 'Politikai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(20, 'Filozófiai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(21, 'Esszé', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(22, 'Napló', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(23, 'Verseskötet', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(24, 'Ifjúsági', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(25, 'Gyermekkönyv', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(26, 'Képregény', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(27, 'Manga', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(28, 'Vallási', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(29, 'Önsegítő', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(30, 'Ismeretterjesztő', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(31, 'Tudományos', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(32, 'Oktatási', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(33, 'Dokumentumregény', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(34, 'Egyéb', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_12_02_092857_create_personal_access_tokens_table', 1),
(5, '2025_01_21_141413_create_genres_table', 1),
(6, '2025_01_21_141428_create_publishers_table', 1),
(7, '2025_01_21_141453_create_authors_table', 1),
(8, '2025_01_21_141524_create_works_table', 1),
(9, '2025_01_21_141543_create_written_bies_table', 1),
(10, '2025_01_21_141726_create_book_demands_table', 1),
(11, '2025_01_21_141744_create_book_offers_table', 1),
(12, '2025_01_21_141838_create_exchange_histories_table', 1),
(13, '2025_01_21_141854_create_dictionaries_table', 1),
(14, '2025_02_25_115752_create_view_book_demands_with_users', 1),
(15, '2025_02_25_121559_create_view_book_offers_by_user', 1),
(16, '2025_02_25_144636_create_view_book_offers_admin', 1),
(17, '2025_02_28_142018_create_proc_book_offers_by_quality', 1),
(18, '2025_03_05_150323_create_trigger_for_dictionaries_values', 1),
(19, '3025_02_27_140827_create_trigger_publication_year_not_in_future', 1),
(20, '3025_03_01_123518_create_trigger_for_book_search_release_date', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `publishers`
--

CREATE TABLE `publishers` (
  `publisher_id` bigint(20) UNSIGNED NOT NULL,
  `publisher_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`, `created_at`, `updated_at`) VALUES
(1, 'Móra', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(2, 'Osiris', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(3, 'Akkord', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(4, 'Európa', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(5, 'Magvető', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(6, 'Laulin', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(7, 'Könyvmolyképző', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(8, 'Helikon', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(9, 'Kreatív', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(10, 'Kulcslyuk', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(11, 'Uitgeverij De Harmonie', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(12, 'Kossuth', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(13, 'Új Magyar', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(14, 'Corgi Books', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(15, 'Balassi', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(16, 'Manó', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(17, 'Holnap', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(18, 'Scolar', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(19, 'Harper & Row', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(20, 'Napvilág', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `role` smallint(6) NOT NULL DEFAULT 1,
  `online_status` smallint(6) NOT NULL DEFAULT 0,
  `img_url` varchar(5000) NOT NULL DEFAULT 'https://i.pinimg.com/1200x/2c/47/d5/2c47d5dd5b532f83bb55c4cd6f5bd1ef.jpg',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `full_name`, `city`, `tel`, `role`, `online_status`, `img_url`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin_michael', 'michael@admin.com', '2025-04-30 17:47:49', '$2y$12$n7grMoyivAMr0JFTqWmweOV56ezRtwlrEDdC/rFOxT.tR/BwJ7Ij6', 'Sir Michael Adminsson', 'Manuelmouth', '272-459-0483', 0, 0, 'profile_pictures/user_basic_pfp.jpg', 'QNFRbQ0S3axACY6cMOiE76PSpjmRjM', '2025-04-30 17:47:49', '2025-04-30 17:47:49'),
(2, 'test_sophia', 'sophia@test.com', '2025-04-30 17:47:49', '$2y$12$iGmB0HqcvKoBvyeGY4VAZOFYt.AROmlkeWL1KlQBmzCPrxeJ3b4g.', 'Sophia Tucker', 'Uptonview', '(307) 434-9638', 1, 0, 'profile_pictures/user_basic_pfp.jpg', 'GW2YeNKYU7q2cxO2M6y2CaNO2HXugt', '2025-04-30 17:47:49', '2025-04-30 17:47:49'),
(3, 'test_andrew', 'andrew@test.com', '2025-04-30 17:47:49', '$2y$12$0Ul8NUkyFh04bUqt6yK69.Yfjhwl5YJTy1tgRS1bcBWtK0StDoMJW', 'Andrew Smith', 'Lake Stacey', '954-973-9493', 1, 0, 'profile_pictures/user_basic_pfp.jpg', 'OYGHFDmLJmsLmpZYR8aQUxxDhthfej', '2025-04-30 17:47:49', '2025-04-30 17:47:49'),
(4, 'test_theodore', 'theodore@test.com', '2025-04-30 17:47:49', '$2y$12$O5xHiD6B.dMNTx9/3fh8qePaLMkMzWn5V6IPOj4JsTzpHZ3vztvIG', 'Theodore Milford', 'Edwintown', '+1 (607) 982-6320', 1, 0, 'profile_pictures/user_basic_pfp.jpg', 'sQ9DW2mI396xoSyWVylmROcMhwNKdF', '2025-04-30 17:47:49', '2025-04-30 17:47:49'),
(5, 'test_marika', 'marika@test.com', '2025-04-30 17:47:50', '$2y$12$duF4P6XBqyyopSsxeB2lMuuFw5WR/ZrKqiRF69zrtwvrMOjX02aeO', 'Marika Kovács', 'Lake Petrahaven', '(720) 438-0663', 1, 0, 'profile_pictures/user_basic_pfp.jpg', '8lNoFeGQmXKmwx0ornRsk9i4xGwKnS', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_book_demands`
-- (See below for the actual view)
--
CREATE TABLE `view_book_demands` (
`id` bigint(20) unsigned
,`full_name` varchar(255)
,`work_id` bigint(20) unsigned
,`title` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_book_offers_admin`
-- (See below for the actual view)
--
CREATE TABLE `view_book_offers_admin` (
`name` varchar(255)
,`publisher_name` varchar(255)
,`title` varchar(255)
,`language` varchar(255)
,`publication_year` int(11)
,`quality` int(11)
,`book_status` char(255)
,`created_at` timestamp
,`updated_at` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_book_offers_by_user`
-- (See below for the actual view)
--
CREATE TABLE `view_book_offers_by_user` (
`title` varchar(255)
,`publisher_name` varchar(255)
,`book_status` char(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `work_id` bigint(20) UNSIGNED NOT NULL,
  `genre_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`work_id`, `genre_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 1, 'Légy jó mindhalálig', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(2, 1, 'Édes Anna', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(3, 1, 'Rokonok', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(4, 1, 'A kőszívű ember fiai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(5, 1, 'Utas és holdvilág', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(6, 6, 'Nem egyszerű', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(7, 6, 'Rubinvörös – Időtlen szerelem', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(8, 8, 'Őszi borzongás', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(9, 1, 'Egri csillagok', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(10, 17, 'Lélekrágcsálók', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(11, 3, 'A hobbit', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(12, 3, 'Percy Jackson és az olimposziak 2. - A szörnyek tengere', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(13, 17, 'A belénk égett múlt – Elengedés, megbocsájtás, újrakezdés', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(14, 9, 'Csipkerózsikák', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(15, 3, 'Harry Potter en de Vuurbeker', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(16, 10, 'Márciusi szél', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(17, 10, 'Acél és Salak (dedikált)', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(18, 8, 'The Da Vinci Code', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(19, 31, 'Megszólal az alárendelt? - A kiszolgáltatottak történetmondása 20-21. századi irodalmi művekben', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(20, 1, 'Kőszívű ember fiai', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(21, 26, 'Egy ropi naplója', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(22, 12, 'Állatfarm', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(23, 1, 'Hazai Tükör', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(24, 1, 'Kincses Sziget', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(25, 8, 'Nem zörög a haraszt', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(26, 17, 'A szellem jelensége a művészetben és a tudományban', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(27, 32, 'Writing Process and Structure', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(28, 23, 'János vitéz', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(29, 34, 'Szigeti veszedelem', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(30, 8, 'Öt kismalac', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(31, 8, 'A pendragon legenda', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(32, 1, 'Utas és holdvilág', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(33, 1, 'Esti Kornél', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(34, 1, 'Goirot apó', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(35, 10, 'Horthy Miklós', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(36, 1, 'Szent Péter esernyője', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(37, 1, 'Tanár úr kérem', '2025-04-30 17:47:50', '2025-04-30 17:47:50'),
(38, 17, 'Fejlődéslélektan', '2025-04-30 17:47:50', '2025-04-30 17:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `written_bies`
--

CREATE TABLE `written_bies` (
  `work` bigint(20) UNSIGNED NOT NULL,
  `author` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `written_bies`
--

INSERT INTO `written_bies` (`work`, `author`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(3, 1, NULL, NULL),
(4, 3, NULL, NULL),
(5, 4, NULL, NULL),
(6, 5, NULL, NULL),
(7, 6, NULL, NULL),
(8, 7, NULL, NULL),
(9, 8, NULL, NULL),
(10, 9, NULL, NULL),
(11, 10, NULL, NULL),
(12, 11, NULL, NULL),
(13, 9, NULL, NULL),
(13, 12, NULL, NULL),
(13, 13, NULL, NULL),
(13, 14, NULL, NULL),
(14, 15, NULL, NULL),
(14, 16, NULL, NULL),
(15, 17, NULL, NULL),
(16, 18, NULL, NULL),
(17, 19, NULL, NULL),
(18, 20, NULL, NULL),
(19, 21, NULL, NULL),
(20, 3, NULL, NULL),
(20, 22, NULL, NULL),
(21, 23, NULL, NULL),
(22, 24, NULL, NULL),
(23, 25, NULL, NULL),
(24, 26, NULL, NULL),
(25, 7, NULL, NULL),
(26, 27, NULL, NULL),
(27, 28, NULL, NULL),
(28, 29, NULL, NULL),
(29, 30, NULL, NULL),
(30, 7, NULL, NULL),
(31, 4, NULL, NULL),
(32, 4, NULL, NULL),
(33, 2, NULL, NULL),
(34, 31, NULL, NULL),
(35, 32, NULL, NULL),
(36, 33, NULL, NULL),
(37, 34, NULL, NULL),
(38, 35, NULL, NULL),
(38, 36, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure for view `view_book_demands`
--
DROP TABLE IF EXISTS `view_book_demands`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book_demands`  AS SELECT `users`.`id` AS `id`, `users`.`full_name` AS `full_name`, `book_demands`.`work` AS `work_id`, `works`.`title` AS `title` FROM ((`book_demands` join `users` on(`book_demands`.`user` = `users`.`id`)) join `works` on(`book_demands`.`work` = `works`.`work_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_book_offers_admin`
--
DROP TABLE IF EXISTS `view_book_offers_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book_offers_admin`  AS SELECT `u`.`name` AS `name`, `p`.`publisher_name` AS `publisher_name`, `w`.`title` AS `title`, `b`.`language` AS `language`, `b`.`publication_year` AS `publication_year`, `b`.`quality` AS `quality`, `b`.`book_status` AS `book_status`, `b`.`created_at` AS `created_at`, `b`.`updated_at` AS `updated_at` FROM (((`book_offers` `b` join `users` `u` on(`u`.`id` = `b`.`user`)) join `publishers` `p` on(`p`.`publisher_id` = `b`.`publisher`)) join `works` `w` on(`w`.`work_id` = `b`.`work`)) ;

-- --------------------------------------------------------

--
-- Structure for view `view_book_offers_by_user`
--
DROP TABLE IF EXISTS `view_book_offers_by_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_book_offers_by_user`  AS SELECT `works`.`title` AS `title`, `publishers`.`publisher_name` AS `publisher_name`, `book_offers`.`book_status` AS `book_status` FROM ((`book_offers` join `works` on(`book_offers`.`work` = `works`.`work_id`)) join `publishers` on(`book_offers`.`publisher` = `publishers`.`publisher_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`author_id`),
  ADD UNIQUE KEY `authors_author_name_unique` (`author_name`);

--
-- Indexes for table `book_demands`
--
ALTER TABLE `book_demands`
  ADD PRIMARY KEY (`demand_id`),
  ADD KEY `book_demands_user_foreign` (`user`),
  ADD KEY `book_demands_publisher_foreign` (`publisher`),
  ADD KEY `book_demands_work_foreign` (`work`);

--
-- Indexes for table `book_offers`
--
ALTER TABLE `book_offers`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `book_offers_user_foreign` (`user`),
  ADD KEY `book_offers_publisher_foreign` (`publisher`),
  ADD KEY `book_offers_work_foreign` (`work`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `dictionaries`
--
ALTER TABLE `dictionaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_histories`
--
ALTER TABLE `exchange_histories`
  ADD PRIMARY KEY (`exchange_id`),
  ADD KEY `exchange_histories_interested_user_foreign` (`interested_user`),
  ADD KEY `exchange_histories_desired_item_foreign` (`desired_item`),
  ADD KEY `exchange_histories_offered_item_foreign` (`offered_item`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`genre_id`),
  ADD UNIQUE KEY `genres_genre_name_unique` (`genre_name`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `publishers`
--
ALTER TABLE `publishers`
  ADD PRIMARY KEY (`publisher_id`),
  ADD UNIQUE KEY `publishers_publisher_name_unique` (`publisher_name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_name_unique` (`name`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`),
  ADD KEY `works_genre_id_foreign` (`genre_id`);

--
-- Indexes for table `written_bies`
--
ALTER TABLE `written_bies`
  ADD PRIMARY KEY (`work`,`author`),
  ADD KEY `written_bies_author_foreign` (`author`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `authors`
--
ALTER TABLE `authors`
  MODIFY `author_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `book_demands`
--
ALTER TABLE `book_demands`
  MODIFY `demand_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `book_offers`
--
ALTER TABLE `book_offers`
  MODIFY `offer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dictionaries`
--
ALTER TABLE `dictionaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `exchange_histories`
--
ALTER TABLE `exchange_histories`
  MODIFY `exchange_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `genre_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `publishers`
--
ALTER TABLE `publishers`
  MODIFY `publisher_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `work_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_demands`
--
ALTER TABLE `book_demands`
  ADD CONSTRAINT `book_demands_publisher_foreign` FOREIGN KEY (`publisher`) REFERENCES `publishers` (`publisher_id`),
  ADD CONSTRAINT `book_demands_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `book_demands_work_foreign` FOREIGN KEY (`work`) REFERENCES `works` (`work_id`);

--
-- Constraints for table `book_offers`
--
ALTER TABLE `book_offers`
  ADD CONSTRAINT `book_offers_publisher_foreign` FOREIGN KEY (`publisher`) REFERENCES `publishers` (`publisher_id`),
  ADD CONSTRAINT `book_offers_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `book_offers_work_foreign` FOREIGN KEY (`work`) REFERENCES `works` (`work_id`);

--
-- Constraints for table `exchange_histories`
--
ALTER TABLE `exchange_histories`
  ADD CONSTRAINT `exchange_histories_desired_item_foreign` FOREIGN KEY (`desired_item`) REFERENCES `book_offers` (`offer_id`),
  ADD CONSTRAINT `exchange_histories_interested_user_foreign` FOREIGN KEY (`interested_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `exchange_histories_offered_item_foreign` FOREIGN KEY (`offered_item`) REFERENCES `book_offers` (`offer_id`);

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_genre_id_foreign` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`genre_id`);

--
-- Constraints for table `written_bies`
--
ALTER TABLE `written_bies`
  ADD CONSTRAINT `written_bies_author_foreign` FOREIGN KEY (`author`) REFERENCES `authors` (`author_id`),
  ADD CONSTRAINT `written_bies_work_foreign` FOREIGN KEY (`work`) REFERENCES `works` (`work_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
