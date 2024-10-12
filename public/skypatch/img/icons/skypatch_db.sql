-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2024 at 01:43 PM
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
-- Database: `skypatch_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('skypatch@customer.com|127.0.0.1', 'i:5;', 1728485762),
('skypatch@customer.com|127.0.0.1:timer', 'i:1728485762;', 1728485762);

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
-- Table structure for table `card_types`
--

CREATE TABLE `card_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer_bill_infos`
--

CREATE TABLE `customer_bill_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `card_holder_name` varchar(255) DEFAULT NULL,
  `card_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `card_expiry` varchar(255) DEFAULT NULL,
  `vcc` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_types`
--

CREATE TABLE `delivery_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `delivery_types`
--

INSERT INTO `delivery_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Normal Delivery', '2024-10-11 15:46:11', '2024-10-11 15:46:11'),
(2, 'Super Urgent', '2024-10-11 15:46:11', '2024-10-11 15:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fabrics`
--

CREATE TABLE `fabrics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fabrics`
--

INSERT INTO `fabrics` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Blanket', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(2, 'Canis', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(3, 'Canvas', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(4, 'Cotton Woven (selected)', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(5, 'Denim', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(6, 'Felt', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(7, 'Flannel', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(8, 'Fleece', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(9, 'Leather', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(10, 'Nylon', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(11, 'Pique', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(12, 'Polyester', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(13, 'Silk', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(14, 'Single Jersey', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(15, 'Towel', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(16, 'Twill', '2024-10-08 20:58:25', '2024-10-08 20:58:25'),
(17, 'Others', '2024-10-08 20:58:25', '2024-10-08 20:58:25');

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
-- Table structure for table `instructions`
--

CREATE TABLE `instructions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cust_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `description` text DEFAULT NULL,
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vector_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructions`
--

INSERT INTO `instructions` (`id`, `cust_id`, `emp_id`, `description`, `quote_id`, `created_at`, `updated_at`, `order_id`, `vector_id`) VALUES
(1, 2, NULL, 'Blanket#1', NULL, '2024-10-12 05:26:24', '2024-10-12 05:26:24', 1, NULL),
(2, 2, NULL, 'Hello I\'m a David I require this design.\r\nif you have this design kindly provide me asap\r\nthanks.', NULL, '2024-10-12 05:29:35', '2024-10-12 05:31:47', NULL, 1),
(3, 2, NULL, 'I want to buy this towel. Check My Instruction as well.', 1, '2024-10-12 05:35:08', '2024-10-12 05:40:09', NULL, NULL);

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
(4, '2024_10_07_140836_create_fabrics_table', 1),
(5, '2024_10_07_141551_create_placements_table', 1),
(6, '2024_10_07_142017_create_statuses_table', 1),
(7, '2024_10_08_125340_create_roles_table', 1),
(8, '2024_10_08_150654_create_delivery_types_table', 1),
(9, '2024_10_08_164345_create_vector_required_formats_table', 1),
(10, '2024_10_08_180516_create_card_types_table', 1),
(11, '2024_10_08_182301_create_option_types_table', 1),
(12, '2024_10_08_182748_create_comments_table', 1),
(13, '2024_10_08_183428_create_pricing_criterias_table', 1),
(14, '2024_10_07_135919_create_required_formats_table', 2),
(16, '2024_10_08_151244_create_employees_table', 4),
(17, '2024_10_08_175816_add_contact_fields_to_users_table', 5),
(18, '2024_10_08_151037_create_reason_edits_table', 6),
(19, '2024_10_08_182412_create_options_table', 7),
(20, '2024_10_07_144037_create_quotes_table', 8),
(21, '2024_10_08_124251_create_instructions_table', 9),
(22, '2024_10_08_175952_create_customer_bill_infos_table', 10),
(23, '2024_10_08_150348_create_vector_orders_table', 11),
(24, '2024_10_08_140840_create_orders_table', 12),
(25, '2024_10_07_145929_create_quote_file_logs_table', 13),
(26, '2024_10_08_200603_add_instruction_id_to_quotes_table', 14),
(27, '2024_10_08_201014_add_instruction_id_to_vector_orders_table', 15),
(28, '2024_10_08_203050_create_tests_table', 16),
(29, '2024_10_08_203758_add_vector_id_to_instructions_table', 17),
(30, '2024_10_08_204855_add_date_received_to_vector_orders_table', 18),
(31, '2024_10_10_125156_create_quote_edit_i_d_s_table', 19),
(32, '2024_10_10_135425_create_order_edit_i_d_s_table', 20),
(33, '2024_10_10_144936_add_super_urgent_to_orders_table', 21),
(34, '2024_10_11_114343_create_vector_edit_i_d_s_table', 22);

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_types_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `comment_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_upload` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `option_types`
--

CREATE TABLE `option_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `required_format_id` bigint(20) UNSIGNED NOT NULL,
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `placement_id` bigint(20) UNSIGNED NOT NULL,
  `edit_order_id` varchar(255) DEFAULT NULL,
  `edit_reason_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `date_received` timestamp NULL DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `number_of_colors` int(11) DEFAULT NULL,
  `super_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `instruction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `delivery_type_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `quote_id`, `required_format_id`, `fabric_id`, `placement_id`, `edit_order_id`, `edit_reason_id`, `status_id`, `date_received`, `name`, `height`, `width`, `number_of_colors`, `super_urgent`, `instruction_id`, `delivery_type_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 16, 1, 13, NULL, NULL, 2, NULL, 'Designer Double Bed Mink Blanket', 9.00, 13.00, 2, 1, NULL, 2, '2024-10-12 05:19:32', '2024-10-12 05:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `order_edit_i_d_s`
--

CREATE TABLE `order_edit_i_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_edit_i_d_s`
--

INSERT INTO `order_edit_i_d_s` (`id`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-10-12 05:23:14', '2024-10-12 05:23:14'),
(2, 1, '2024-10-12 05:23:56', '2024-10-12 05:23:56'),
(3, 1, '2024-10-12 05:24:40', '2024-10-12 05:24:40'),
(4, 1, '2024-10-12 05:24:57', '2024-10-12 05:24:57'),
(5, 1, '2024-10-12 05:26:24', '2024-10-12 05:26:24');

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
-- Table structure for table `placements`
--

CREATE TABLE `placements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `placements`
--

INSERT INTO `placements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Apron', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(2, 'Bags', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(3, 'Cap', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(4, 'Cap Side', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(5, 'Cap Back', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(6, 'Chest (selected)', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(7, 'Gloves', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(8, 'Jacket Back', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(9, 'Patches', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(10, 'Sleeve', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(11, 'Towel', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(12, 'Visor', '2024-10-08 21:01:08', '2024-10-08 21:01:08'),
(13, 'Others', '2024-10-08 21:01:08', '2024-10-08 21:01:08');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_criterias`
--

CREATE TABLE `pricing_criterias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `delivery_type_id` bigint(20) UNSIGNED NOT NULL,
  `minimum_price` decimal(8,2) DEFAULT NULL,
  `maximum_price` decimal(8,2) DEFAULT NULL,
  `stitches` int(11) DEFAULT NULL,
  `editing_changes` varchar(255) DEFAULT NULL,
  `editing_in_stitch_file` varchar(255) DEFAULT NULL,
  `comment_box_1` text DEFAULT NULL,
  `comment_box_2` text DEFAULT NULL,
  `comment_box_3` text DEFAULT NULL,
  `comment_box_4` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE `quotes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `required_format_id` bigint(20) UNSIGNED NOT NULL,
  `fabric_id` bigint(20) UNSIGNED NOT NULL,
  `placement_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `quote_id_edit` varchar(255) DEFAULT NULL,
  `date_finalized` timestamp NULL DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `height` decimal(8,2) DEFAULT NULL,
  `width` decimal(8,2) DEFAULT NULL,
  `number_of_colors` int(11) DEFAULT NULL,
  `super_urgent` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `instruction_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`id`, `customer_id`, `required_format_id`, `fabric_id`, `placement_id`, `status_id`, `quote_id_edit`, `date_finalized`, `name`, `height`, `width`, `number_of_colors`, `super_urgent`, `created_at`, `updated_at`, `instruction_id`) VALUES
(1, 2, 6, 14, 11, 2, NULL, NULL, 'The Best Bath Towel21', 4.00, 5.00, 3, 0, '2024-10-12 05:35:08', '2024-10-12 05:50:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quote_edit_i_d_s`
--

CREATE TABLE `quote_edit_i_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_edit_i_d_s`
--

INSERT INTO `quote_edit_i_d_s` (`id`, `quote_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-10-12 05:40:09', '2024-10-12 05:40:09'),
(2, 1, '2024-10-12 05:40:25', '2024-10-12 05:40:25'),
(3, 1, '2024-10-12 05:50:17', '2024-10-12 05:50:17');

-- --------------------------------------------------------

--
-- Table structure for table `quote_file_logs`
--

CREATE TABLE `quote_file_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quote_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `vector_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cust_id` bigint(20) UNSIGNED DEFAULT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `files` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quote_file_logs`
--

INSERT INTO `quote_file_logs` (`id`, `quote_id`, `order_id`, `vector_order_id`, `cust_id`, `emp_id`, `files`, `created_at`, `updated_at`) VALUES
(3, NULL, 1, NULL, 2, NULL, 'uploads/quotes/czAIFNJ4AUVwUgZkBdOtbyY1muhV3f8Iz6dUw51f.webp', '2024-10-12 05:24:57', '2024-10-12 05:24:57'),
(6, NULL, NULL, 1, 2, NULL, 'uploads/vector-order/g78TCCXCdTx0H2wLhuRdfMEhf9IQiLwYcWrNnQJi.png', '2024-10-12 05:31:56', '2024-10-12 05:31:56'),
(9, 1, NULL, NULL, 2, NULL, 'uploads/quotes/pwl1jx41fx46Do3yPq1TjNf9gPHiAUoLMmJ7av19.jpg', '2024-10-12 05:40:25', '2024-10-12 05:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `reason_edits`
--

CREATE TABLE `reason_edits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `required_formats`
--

CREATE TABLE `required_formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `required_formats`
--

INSERT INTO `required_formats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'cdr', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(2, 'cnd', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(3, 'dsb', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(4, 'dst', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(5, 'dsz', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(6, 'emb', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(7, 'exp', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(8, 'jef', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(9, 'ksm', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(10, 'ofm', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(11, 'pes', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(12, 'pdf', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(13, 'pof', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(14, 'tap', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(15, 'xxx', '2024-10-08 20:59:49', '2024-10-08 20:59:49'),
(16, 'others', '2024-10-08 20:59:49', '2024-10-08 20:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(2, 'Employee', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(3, 'Quote Digitizer Leader', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(4, 'Quote Digitizer Worker', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(5, 'Order Digitizer Leader', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(6, 'Order Digitizer Worker', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(7, 'Vector Digitizer Leader', '2024-10-09 06:52:49', '2024-10-09 06:52:49'),
(8, 'Vector Digitizer Worker', '2024-10-09 06:52:49', '2024-10-09 06:52:49');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hV9bNBSiDhcbama3OPDbeqlv0EMiQd3DDnofL59I', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/129.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieHVqeE1lTW5TM0ZtUXRIVm5GMjdyOGRpaTZjYlZHVHIzMVJBWnpmaCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mjt9', 1728733389);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Released', '2024-10-08 21:03:15', '2024-10-08 21:03:15'),
(2, 'In Progress', '2024-10-08 21:03:15', '2024-10-08 21:03:15');

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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_type` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `cell` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `email_1` varchar(255) DEFAULT NULL,
  `email_2` varchar(255) DEFAULT NULL,
  `email_3` varchar(255) DEFAULT NULL,
  `email_4` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `contact_name`, `company_name`, `company_type`, `phone`, `cell`, `fax`, `email_1`, `email_2`, `email_3`, `email_4`, `address`, `city`, `state`, `zipcode`, `country`) VALUES
(1, 'John', 'john@skypatch.com', NULL, '$2y$12$h7nAV7f1KkYBQl0fmFN9neaPV5XmOAL5IQrKAZmetkWXu1u93avTq', NULL, '2024-10-09 06:54:31', '2024-10-09 06:54:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'david', 'david@skypatch.com', NULL, '$2y$12$si04ek0a/6.n3XtumZyeWudT.W4SbgX.nX7nW5Z.OS64aKNiBc96m', NULL, '2024-10-11 06:13:33', '2024-10-11 06:13:33', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vector_edit_i_d_s`
--

CREATE TABLE `vector_edit_i_d_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vector_order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vector_edit_i_d_s`
--

INSERT INTO `vector_edit_i_d_s` (`id`, `vector_order_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-10-12 05:31:15', '2024-10-12 05:31:15'),
(2, 1, '2024-10-12 05:31:15', '2024-10-12 05:31:15'),
(3, 1, '2024-10-12 05:31:47', '2024-10-12 05:31:47'),
(4, 1, '2024-10-12 05:31:56', '2024-10-12 05:31:56');

-- --------------------------------------------------------

--
-- Table structure for table `vector_orders`
--

CREATE TABLE `vector_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `required_format_id` bigint(20) UNSIGNED NOT NULL,
  `edit_vector_id` varchar(255) DEFAULT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `number_of_colors` int(11) DEFAULT NULL,
  `super_urgent` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `instruction_id` bigint(20) UNSIGNED DEFAULT NULL,
  `date_finalized` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vector_orders`
--

INSERT INTO `vector_orders` (`id`, `customer_id`, `required_format_id`, `edit_vector_id`, `status_id`, `name`, `number_of_colors`, `super_urgent`, `created_at`, `updated_at`, `instruction_id`, `date_finalized`) VALUES
(1, 2, 4, NULL, 2, 'Vector Order#1', 1, 0, '2024-10-12 05:29:35', '2024-10-12 05:29:35', NULL, '2024-10-12 10:29:35');

-- --------------------------------------------------------

--
-- Table structure for table `vector_required_formats`
--

CREATE TABLE `vector_required_formats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vector_required_formats`
--

INSERT INTO `vector_required_formats` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ai', '2024-10-08 21:04:15', '2024-10-08 21:04:15'),
(2, 'cdr', '2024-10-08 21:04:15', '2024-10-08 21:04:15'),
(3, 'aps', '2024-10-08 21:04:15', '2024-10-08 21:04:15'),
(4, 'others', '2024-10-08 21:04:15', '2024-10-08 21:04:15');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `card_types`
--
ALTER TABLE `card_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_bill_infos`
--
ALTER TABLE `customer_bill_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_bill_infos_customer_id_foreign` (`customer_id`),
  ADD KEY `customer_bill_infos_card_type_id_foreign` (`card_type_id`);

--
-- Indexes for table `delivery_types`
--
ALTER TABLE `delivery_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `delivery_types_type_unique` (`type`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_role_id_foreign` (`role_id`);

--
-- Indexes for table `fabrics`
--
ALTER TABLE `fabrics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fabrics_name_unique` (`name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructions`
--
ALTER TABLE `instructions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructions_cust_id_foreign` (`cust_id`),
  ADD KEY `instructions_emp_id_foreign` (`emp_id`),
  ADD KEY `instructions_quote_id_foreign` (`quote_id`),
  ADD KEY `instructions_order_id_foreign` (`order_id`),
  ADD KEY `instructions_vector_id_foreign` (`vector_id`);

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
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD KEY `options_option_types_id_foreign` (`option_types_id`),
  ADD KEY `options_role_id_foreign` (`role_id`),
  ADD KEY `options_comment_id_foreign` (`comment_id`);

--
-- Indexes for table `option_types`
--
ALTER TABLE `option_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `option_types_name_unique` (`name`) USING HASH;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_quote_id_foreign` (`quote_id`),
  ADD KEY `orders_required_format_id_foreign` (`required_format_id`),
  ADD KEY `orders_fabric_id_foreign` (`fabric_id`),
  ADD KEY `orders_placement_id_foreign` (`placement_id`),
  ADD KEY `orders_edit_reason_id_foreign` (`edit_reason_id`),
  ADD KEY `orders_status_id_foreign` (`status_id`),
  ADD KEY `orders_instruction_id_foreign` (`instruction_id`),
  ADD KEY `orders_delivery_type_id_foreign` (`delivery_type_id`);

--
-- Indexes for table `order_edit_i_d_s`
--
ALTER TABLE `order_edit_i_d_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_edit_i_d_s_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `placements`
--
ALTER TABLE `placements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `placements_name_unique` (`name`);

--
-- Indexes for table `pricing_criterias`
--
ALTER TABLE `pricing_criterias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pricing_criterias_delivery_type_id_foreign` (`delivery_type_id`);

--
-- Indexes for table `quotes`
--
ALTER TABLE `quotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quotes_customer_id_foreign` (`customer_id`),
  ADD KEY `quotes_required_format_id_foreign` (`required_format_id`),
  ADD KEY `quotes_fabric_id_foreign` (`fabric_id`),
  ADD KEY `quotes_placement_id_foreign` (`placement_id`),
  ADD KEY `quotes_status_id_foreign` (`status_id`),
  ADD KEY `quotes_instruction_id_foreign` (`instruction_id`);

--
-- Indexes for table `quote_edit_i_d_s`
--
ALTER TABLE `quote_edit_i_d_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quote_edit_i_d_s_quote_id_foreign` (`quote_id`);

--
-- Indexes for table `quote_file_logs`
--
ALTER TABLE `quote_file_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `quote_file_logs_files_unique` (`files`) USING HASH,
  ADD KEY `quote_file_logs_quote_id_foreign` (`quote_id`),
  ADD KEY `quote_file_logs_order_id_foreign` (`order_id`),
  ADD KEY `quote_file_logs_vector_order_id_foreign` (`vector_order_id`),
  ADD KEY `quote_file_logs_cust_id_foreign` (`cust_id`),
  ADD KEY `quote_file_logs_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `reason_edits`
--
ALTER TABLE `reason_edits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reason_edits_emp_id_foreign` (`emp_id`);

--
-- Indexes for table `required_formats`
--
ALTER TABLE `required_formats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `required_formats_name_unique` (`name`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `statuses_name_unique` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vector_edit_i_d_s`
--
ALTER TABLE `vector_edit_i_d_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vector_edit_i_d_s_vector_order_id_foreign` (`vector_order_id`);

--
-- Indexes for table `vector_orders`
--
ALTER TABLE `vector_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vector_orders_customer_id_foreign` (`customer_id`),
  ADD KEY `vector_orders_required_format_id_foreign` (`required_format_id`),
  ADD KEY `vector_orders_status_id_foreign` (`status_id`),
  ADD KEY `vector_orders_instruction_id_foreign` (`instruction_id`);

--
-- Indexes for table `vector_required_formats`
--
ALTER TABLE `vector_required_formats`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vector_required_formats_name_unique` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `card_types`
--
ALTER TABLE `card_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer_bill_infos`
--
ALTER TABLE `customer_bill_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_types`
--
ALTER TABLE `delivery_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabrics`
--
ALTER TABLE `fabrics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructions`
--
ALTER TABLE `instructions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `option_types`
--
ALTER TABLE `option_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_edit_i_d_s`
--
ALTER TABLE `order_edit_i_d_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `placements`
--
ALTER TABLE `placements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pricing_criterias`
--
ALTER TABLE `pricing_criterias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotes`
--
ALTER TABLE `quotes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quote_edit_i_d_s`
--
ALTER TABLE `quote_edit_i_d_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quote_file_logs`
--
ALTER TABLE `quote_file_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `reason_edits`
--
ALTER TABLE `reason_edits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `required_formats`
--
ALTER TABLE `required_formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vector_edit_i_d_s`
--
ALTER TABLE `vector_edit_i_d_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vector_orders`
--
ALTER TABLE `vector_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vector_required_formats`
--
ALTER TABLE `vector_required_formats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_bill_infos`
--
ALTER TABLE `customer_bill_infos`
  ADD CONSTRAINT `customer_bill_infos_card_type_id_foreign` FOREIGN KEY (`card_type_id`) REFERENCES `card_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_bill_infos_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructions`
--
ALTER TABLE `instructions`
  ADD CONSTRAINT `instructions_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructions_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructions_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `instructions_vector_id_foreign` FOREIGN KEY (`vector_id`) REFERENCES `vector_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_option_types_id_foreign` FOREIGN KEY (`option_types_id`) REFERENCES `option_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `options_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_delivery_type_id_foreign` FOREIGN KEY (`delivery_type_id`) REFERENCES `delivery_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_edit_reason_id_foreign` FOREIGN KEY (`edit_reason_id`) REFERENCES `reason_edits` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_fabric_id_foreign` FOREIGN KEY (`fabric_id`) REFERENCES `fabrics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_instruction_id_foreign` FOREIGN KEY (`instruction_id`) REFERENCES `instructions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_placement_id_foreign` FOREIGN KEY (`placement_id`) REFERENCES `placements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_required_format_id_foreign` FOREIGN KEY (`required_format_id`) REFERENCES `required_formats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_edit_i_d_s`
--
ALTER TABLE `order_edit_i_d_s`
  ADD CONSTRAINT `order_edit_i_d_s_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pricing_criterias`
--
ALTER TABLE `pricing_criterias`
  ADD CONSTRAINT `pricing_criterias_delivery_type_id_foreign` FOREIGN KEY (`delivery_type_id`) REFERENCES `delivery_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotes`
--
ALTER TABLE `quotes`
  ADD CONSTRAINT `quotes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotes_fabric_id_foreign` FOREIGN KEY (`fabric_id`) REFERENCES `fabrics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotes_instruction_id_foreign` FOREIGN KEY (`instruction_id`) REFERENCES `instructions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotes_placement_id_foreign` FOREIGN KEY (`placement_id`) REFERENCES `placements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotes_required_format_id_foreign` FOREIGN KEY (`required_format_id`) REFERENCES `required_formats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotes_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote_edit_i_d_s`
--
ALTER TABLE `quote_edit_i_d_s`
  ADD CONSTRAINT `quote_edit_i_d_s_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quote_file_logs`
--
ALTER TABLE `quote_file_logs`
  ADD CONSTRAINT `quote_file_logs_cust_id_foreign` FOREIGN KEY (`cust_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_file_logs_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_file_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_file_logs_quote_id_foreign` FOREIGN KEY (`quote_id`) REFERENCES `quotes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quote_file_logs_vector_order_id_foreign` FOREIGN KEY (`vector_order_id`) REFERENCES `vector_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reason_edits`
--
ALTER TABLE `reason_edits`
  ADD CONSTRAINT `reason_edits_emp_id_foreign` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vector_edit_i_d_s`
--
ALTER TABLE `vector_edit_i_d_s`
  ADD CONSTRAINT `vector_edit_i_d_s_vector_order_id_foreign` FOREIGN KEY (`vector_order_id`) REFERENCES `vector_orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vector_orders`
--
ALTER TABLE `vector_orders`
  ADD CONSTRAINT `vector_orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vector_orders_instruction_id_foreign` FOREIGN KEY (`instruction_id`) REFERENCES `instructions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vector_orders_required_format_id_foreign` FOREIGN KEY (`required_format_id`) REFERENCES `vector_required_formats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vector_orders_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
