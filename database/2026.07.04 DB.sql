-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 08:12 AM
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
-- Database: `eshop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `status` enum('new','progress','delivered','cancel') NOT NULL DEFAULT 'new',
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `shipping_cost` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `user_id`, `price`, `status`, `quantity`, `amount`, `shipping_cost`, `created_at`, `updated_at`) VALUES
(6, 47, 6, 2, 2750.00, 'new', 1, 2750.00, NULL, '2026-01-07 01:51:01', '2026-01-07 01:52:33'),
(7, 46, 7, 2, 1250.00, 'new', 1, 1250.00, NULL, '2026-01-07 02:02:01', '2026-01-07 02:03:05'),
(8, 47, 8, 2, 2750.00, 'new', 1, 2750.00, NULL, '2026-01-07 04:09:39', '2026-01-07 04:20:22'),
(9, 46, 10, 3, 1250.00, 'new', 1, 1250.00, NULL, '2026-01-08 12:24:39', '2026-01-08 12:28:35'),
(10, 47, 11, 2, 2750.00, 'new', 1, 2750.00, NULL, '2026-01-13 00:09:54', '2026-01-13 00:14:34'),
(11, 47, 12, 2, 2750.00, 'new', 1, 2750.00, NULL, '2026-01-13 10:54:53', '2026-01-13 11:06:39'),
(12, 46, 25, 2, 1250.00, 'new', 2, 2500.00, 0.00, '2026-01-13 11:16:39', '2026-03-13 00:19:42'),
(13, 46, 14, 2, 1250.00, 'new', 1, 1250.00, NULL, '2026-01-13 11:18:34', '2026-01-13 11:19:13'),
(14, 45, 15, 2, 5250.00, 'new', 1, 5250.00, NULL, '2026-01-13 11:26:18', '2026-01-13 11:26:58'),
(21, 48, 16, 2, 5250.00, 'new', 1, 5250.00, NULL, '2026-01-18 14:38:05', '2026-01-18 14:38:31'),
(25, 33, 17, 2, 11500.00, 'new', 1, 11500.00, NULL, '2026-01-27 12:18:53', '2026-01-27 12:19:32'),
(26, 27, 18, 2, 1100.00, 'new', 1, 1100.00, NULL, '2026-01-27 12:20:27', '2026-01-27 12:20:55'),
(27, 27, 19, 2, 1100.00, 'new', 1, 1100.00, NULL, '2026-01-27 12:23:10', '2026-01-27 12:27:32'),
(36, 1, 20, 2, 1500.00, 'new', 5, 7100.00, 350.00, '2026-02-05 03:07:32', '2026-02-13 11:54:31'),
(37, 47, 20, 2, 2750.00, 'new', 2, 5500.00, 0.00, '2026-02-05 04:01:12', '2026-02-13 11:54:31'),
(38, 48, 20, 2, 5250.00, 'new', 5, 26250.00, 0.00, '2026-02-05 05:11:11', '2026-02-13 11:54:31'),
(39, 2, 21, 2, 1600.00, 'new', 1, 2030.00, 430.00, '2026-02-13 12:01:34', '2026-02-13 12:02:35'),
(40, 1, 21, 2, 1500.00, 'new', 1, 1850.00, 350.00, '2026-02-13 12:02:07', '2026-02-13 12:02:35'),
(45, 38, 22, 2, 1100.00, 'new', 1, 1100.00, 0.00, '2026-02-27 00:31:18', '2026-02-27 00:33:17'),
(46, 34, 23, 2, 1500.00, 'new', 1, 1500.00, 0.00, '2026-02-27 00:51:09', '2026-02-27 00:52:46'),
(48, 1, 24, 9, 1500.00, 'new', 1, 1500.00, 0.00, '2026-02-27 01:21:55', '2026-02-27 01:23:17'),
(49, 44, 26, 2, 7500.00, 'new', 1, 7500.00, 0.00, '2026-03-13 00:26:38', '2026-03-13 00:27:26'),
(50, 47, 27, 2, 2750.00, 'new', 1, 2750.00, 0.00, '2026-03-13 00:36:09', '2026-03-13 00:37:56'),
(51, 47, 28, 2, 2750.00, 'new', 1, 2750.00, 0.00, '2026-03-13 01:02:49', '2026-03-13 01:04:39'),
(52, 45, 28, 2, 5250.00, 'new', 1, 5250.00, 0.00, '2026-03-13 01:02:57', '2026-03-13 01:04:39'),
(53, 41, 29, 2, 1300.00, 'new', 1, 1300.00, 0.00, '2026-03-13 01:12:39', '2026-03-13 01:14:40'),
(54, 35, 30, 2, 950.00, 'new', 1, 950.00, 0.00, '2026-03-13 01:21:10', '2026-03-13 01:22:12'),
(55, 40, 31, 2, 340.00, 'new', 1, 340.00, 0.00, '2026-03-16 10:55:24', '2026-03-16 10:56:21'),
(56, 8, 32, 2, 9900.00, 'new', 1, 9900.00, 0.00, '2026-04-04 03:31:19', '2026-04-08 12:09:22'),
(57, 45, 32, 2, 5250.00, 'new', 1, 5250.00, 0.00, '2026-04-08 11:48:25', '2026-04-08 12:09:22'),
(62, 45, 33, 10, 5250.00, 'new', 1, 5250.00, 0.00, '2026-04-12 10:33:29', '2026-04-12 10:34:54'),
(63, 45, 34, 10, 5250.00, 'new', 1, 5250.00, 0.00, '2026-04-12 10:35:48', '2026-04-12 10:36:39'),
(64, 60, NULL, 1, 120.00, 'new', 10, 2110.00, 910.00, '2026-04-12 12:04:54', '2026-05-08 23:40:08'),
(66, 45, 35, 2, 5250.00, 'new', 1, 5250.00, 0.00, '2026-05-04 12:21:16', '2026-05-04 12:33:01'),
(67, 48, 35, 2, 5250.00, 'new', 1, 5250.00, 0.00, '2026-05-04 12:21:23', '2026-05-04 12:33:01'),
(68, 43, 35, 2, 7500.00, 'new', 1, 7500.00, 0.00, '2026-05-04 12:21:31', '2026-05-04 12:33:01'),
(69, 38, 35, 2, 1100.00, 'new', 1, 1100.00, 0.00, '2026-05-04 12:21:43', '2026-05-04 12:33:01'),
(70, 43, 36, 2, 7500.00, 'new', 1, 7500.00, 0.00, '2026-05-05 09:44:23', '2026-05-05 09:46:51'),
(71, 1, 36, 2, 1500.00, 'new', 1, 1500.00, 0.00, '2026-05-05 09:44:39', '2026-05-05 09:46:51'),
(83, 60, 39, 15, 120.00, 'new', 3, 870.00, 510.00, '2026-05-09 00:45:15', '2026-05-09 00:46:17'),
(84, 45, 42, 16, 5250.00, 'new', 1, 5250.00, 0.00, '2026-06-08 23:28:13', '2026-06-09 12:12:51'),
(85, 1, 42, 16, 1500.00, 'new', 1, 1500.00, 0.00, '2026-06-08 23:28:24', '2026-06-09 12:12:51'),
(86, 2, 42, 16, 1600.00, 'new', 1, 2030.00, 430.00, '2026-06-08 23:29:02', '2026-06-09 12:12:51'),
(87, 60, 42, 16, 120.00, 'new', 1, 470.00, 350.00, '2026-06-08 23:29:10', '2026-06-09 12:12:51'),
(88, 48, 43, 16, 5250.00, 'new', 1, 5250.00, 0.00, '2026-06-09 12:13:16', '2026-06-09 12:14:20'),
(89, 44, 43, 16, 7500.00, 'new', 1, 7500.00, 0.00, '2026-06-09 12:13:32', '2026-06-09 12:14:20'),
(90, 37, 44, 16, 1350.00, 'new', 1, 1350.00, 0.00, '2026-06-09 13:40:56', '2026-06-09 14:00:26'),
(91, 35, 44, 16, 950.00, 'new', 1, 950.00, 0.00, '2026-06-09 13:41:05', '2026-06-09 14:00:26');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` text DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `is_parent` tinyint(1) NOT NULL DEFAULT 1,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `summary`, `photo`, `is_parent`, `parent_id`, `added_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Solar charger Controller', 'solar-charger-controller', NULL, '/storage/photos/1/Category/mini-banner1.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:46:23', '2026-01-05 01:47:25'),
(3, 'Inverters', 'inverters', NULL, '/storage/photos/1/Category/Solar charger Controller.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:48:28', '2026-01-05 02:32:10'),
(4, 'Batteries', 'batteries', NULL, '/storage/photos/1/Category/mini-banner3.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:48:49', '2026-01-05 01:48:49'),
(5, 'Battery Charger/Testers', 'battery-chargertesters', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:49:08', '2026-01-05 01:49:08'),
(6, 'Lights/ Bulbs/LED', 'lights-bulbsled', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:49:27', '2026-01-05 01:49:27'),
(7, 'Power Supplier', 'power-supplier', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:49:43', '2026-01-05 01:49:43'),
(8, 'Measuring tools', 'measuring-tools', NULL, '/storage/photos/1/Category/mini-banner1.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:49:59', '2026-01-05 01:49:59'),
(9, 'Mobile phone Accessories', 'mobile-phone-accessories', NULL, '/storage/photos/1/Category/mini-banner3.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:50:35', '2026-01-05 01:50:35'),
(10, 'Smart watches', 'smart-watches', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:50:56', '2026-01-05 01:50:56'),
(11, 'Engine Oil', 'engine-oil', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:51:12', '2026-01-05 01:51:12'),
(12, 'Ungroup', 'ungroup', NULL, '/storage/photos/1/Category/mini-banner2.jpg', 1, NULL, NULL, 'active', '2026-01-05 01:51:28', '2026-01-05 01:51:28');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(191) NOT NULL,
  `type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `value` decimal(20,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'abc123', 'fixed', 300.00, 'active', NULL, NULL),
(2, '111111', 'percent', 10.00, 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `couriers`
--

CREATE TABLE `couriers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `hotline` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `couriers`
--

INSERT INTO `couriers` (`id`, `name`, `hotline`, `created_at`, `updated_at`) VALUES
(1, 'DHL', '0715248956', '2026-06-09 13:14:37', '2026-06-09 13:14:37'),
(2, 'Kuubiyo', '0768495621', '2026-06-09 13:14:52', '2026-06-09 13:14:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_entries`
--

CREATE TABLE `ledger_entries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entry_date` date NOT NULL,
  `entry_type` varchar(10) NOT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `account` varchar(100) DEFAULT NULL,
  `reference_type` varchar(50) DEFAULT NULL,
  `reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `subject` text NOT NULL,
  `email` varchar(191) NOT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `message` longtext NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2020_07_10_021010_create_brands_table', 1),
(6, '2020_07_10_025334_create_banners_table', 1),
(7, '2020_07_10_112147_create_categories_table', 1),
(8, '2020_07_11_063857_create_products_table', 1),
(9, '2020_07_12_073132_create_post_categories_table', 1),
(10, '2020_07_12_073701_create_post_tags_table', 1),
(11, '2020_07_12_083638_create_posts_table', 1),
(12, '2020_07_13_151329_create_messages_table', 1),
(13, '2020_07_14_023748_create_shippings_table', 1),
(14, '2020_07_15_054356_create_orders_table', 1),
(15, '2020_07_15_102626_create_carts_table', 1),
(16, '2020_07_16_041623_create_notifications_table', 1),
(17, '2020_07_16_053240_create_coupons_table', 1),
(18, '2020_07_23_143757_create_wishlists_table', 1),
(19, '2020_07_24_074930_create_product_reviews_table', 1),
(20, '2020_07_24_131727_create_post_comments_table', 1),
(21, '2020_08_01_143408_create_settings_table', 1),
(22, '2023_06_21_164432_create_jobs_table', 1),
(23, '2026_01_05_000001_add_commerce_extensions_to_orders_table', 2),
(24, '2026_01_05_000002_add_wholesale_fields_to_products_table', 2),
(25, '2026_01_05_000003_add_customer_and_staff_fields_to_users_table', 2),
(26, '2026_01_05_000004_create_shipment_trackings_table', 2),
(27, '2026_01_05_000005_create_sms_logs_table', 2),
(28, '2026_01_05_000006_create_ledger_entries_table', 2),
(29, '2026_01_07_000000_add_social_links_to_settings_table', 3),
(30, '2026_01_08_000000_add_vision_mission_to_settings_table', 4),
(31, '2026_01_08_100000_add_commitment_energy_independence_to_settings_table', 5),
(32, '2026_01_08_110000_add_specialized_product_range_to_settings_table', 6),
(33, '2026_01_08_120000_add_why_choose_delimach_lanka_to_settings_table', 7),
(34, '2026_01_18_000000_create_wholesale_requests_table', 8),
(35, '2026_01_19_120000_add_warranty_and_returns_to_products_table', 9),
(36, '2026_01_19_130000_add_bulk_discount_fields_to_products_table', 10),
(37, '2026_01_19_140000_add_bulk_discount_amount_type_to_products_table', 11),
(38, '2026_01_22_000001_add_small_banner_to_settings_table', 12),
(39, '2026_01_27_000001_add_weight_to_products_table', 13),
(40, '2026_01_27_100000_create_product_variants_table', 14),
(41, '2026_01_30_000002_add_shipping_cost_to_carts_table', 15),
(42, '2026_01_30_000001_add_weight_to_products_table', 16),
(43, '2026_01_31_000004_add_phone_to_users_table', 17),
(44, '2026_01_31_000001_add_free_shipping_enabled_to_products_table', 18),
(45, '2026_02_13_000001_add_delivery_charge_to_orders_table', 19),
(46, '2026_02_13_000002_add_free_shipping_to_products_table', 20),
(47, '2026_02_13_000003_backfill_free_shipping_for_existing_products', 21),
(48, '2026_02_13_000004_sync_free_shipping_columns_on_products_table', 22),
(49, '2026_02_14_000001_disable_free_shipping_by_default_on_products_table', 23),
(50, '2026_02_27_000001_convert_users_role_to_varchar_and_add_sales_admin', 24),
(51, '2026_02_27_000003_make_users_phone_nullable_or_default', 24),
(52, '2026_02_27_000004_add_emergency_contact_to_orders_table', 25),
(53, '2026_02_27_000005_add_customer_profile_fields_to_users_table', 26),
(54, '2026_02_27_000006_add_youtube_link_to_products_table', 27),
(55, '2026_02_27_000007_change_orders_status_to_string_allow_pending', 28),
(56, '2026_04_08_000001_add_district_to_orders_table', 29),
(57, '2026_04_08_000002_add_purchase_and_sale_price_to_products_table', 30),
(58, '2026_04_12_000001_create_sales_admin_product_stocks_table', 31),
(59, '2026_04_12_000002_create_sales_admin_stock_transfers_table', 31),
(60, '2026_04_12_000003_add_weight_based_shipping_cost_to_settings_table', 32),
(61, '2026_04_30_000001_add_courier_tracking_message_to_orders_table', 33),
(62, '2026_05_04_000001_replace_tracking_with_courier_tracking_on_orders_table', 33),
(63, '2026_05_08_000001_add_return_fields_to_orders_table', 34),
(64, '2026_06_10_000001_create_couriers_table', 35),
(65, '2026_06_10_000002_add_courier_id_and_seller_edit_count_to_products_table', 35),
(66, '2026_06_10_000003_add_courier_id_to_orders_table', 36),
(67, '2026_06_10_000004_add_address3_to_orders_table', 37);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(191) NOT NULL,
  `notifiable_type` varchar(191) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('064e6d04-01e4-4b0f-939d-b79180545944', 'App\\Notifications\\WholesaleRequestAdded', 'App\\User', 1, '{\"title\":\"Wholesale added: Clamp meter (kasun chathuranga)\",\"fas\":\"fa-handshake\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/wholesale-requests\",\"wholesale_request_id\":2}', '2026-01-18 11:32:47', '2026-01-18 11:32:09', '2026-01-18 11:32:47'),
('065ae0a3-5ae7-49d8-8a61-bad15a7e0227', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/39\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-09 00:45:50', '2026-05-09 00:45:50'),
('0ccd9d24-1e67-479d-920b-a855adaf5793', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/6\",\"fas\":\"fa-file-alt\"}', '2026-01-07 02:05:11', '2026-01-07 01:52:31', '2026-01-07 02:05:11'),
('14c57aba-8180-41b6-a314-eb4544c159fa', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/29\",\"fas\":\"fa-file-alt\"}', '2026-05-04 12:18:00', '2026-03-13 01:14:32', '2026-05-04 12:18:00'),
('16e502ad-93b7-4212-8d47-419c6b4337ab', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/10\",\"fas\":\"fa-file-alt\"}', '2026-01-08 22:58:39', '2026-01-08 12:28:24', '2026-01-08 22:58:39'),
('1e38e383-b1d6-4561-8ab7-b8263a2cd860', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/4\",\"fas\":\"fa-file-alt\"}', '2026-01-06 01:04:58', '2026-01-05 14:08:16', '2026-01-06 01:04:58'),
('216060cd-1c5f-48a6-b4d2-579f94648d9a', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/3\",\"fas\":\"fa-file-alt\"}', '2026-01-05 13:51:11', '2026-01-05 13:50:14', '2026-01-05 13:51:11'),
('27a49d7a-9574-4185-9a8f-11148ba01ee1', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/clamp-meter-2601063953-238\",\"fas\":\"fa-star\"}', '2026-01-28 10:35:54', '2026-01-26 05:08:09', '2026-01-28 10:35:54'),
('2a2baacb-4362-4795-8893-1d55038718e3', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/34\",\"fas\":\"fa-file-alt\"}', '2026-04-30 10:07:45', '2026-04-12 10:36:27', '2026-04-30 10:07:45'),
('2dc7be08-bb74-4bb2-94d1-ce7cb92b692b', 'App\\Notifications\\WholesaleRequestAdded', 'App\\User', 1, '{\"title\":\"Wholesale added: Solar Charger Controller PWM 40A (kasun chathuranga)\",\"fas\":\"fa-handshake\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/wholesale-requests\",\"url\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/wholesale-requests\",\"wholesale_request_id\":3}', '2026-01-18 13:12:07', '2026-01-18 11:52:16', '2026-01-18 13:12:07'),
('305a56cc-fe6e-4133-8ebf-d461b11d4134', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"Stock received: Apple phone charger x2\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\",\"fas\":\"fa-box\"}', '2026-05-04 12:17:48', '2026-04-29 00:38:51', '2026-05-04 12:17:48'),
('324a0684-cecf-450f-a9f2-443a982d78c6', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/32\",\"fas\":\"fa-file-alt\"}', '2026-04-08 12:34:50', '2026-04-08 12:08:55', '2026-04-08 12:34:50'),
('337e2f79-4561-43d5-bc66-00d0bc14e220', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/42\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:12:32', '2026-06-09 12:12:32'),
('3587f277-5ed7-489f-a844-3c1645957209', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/38\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 23:25:33', '2026-05-08 23:25:33'),
('37011f10-c859-474c-aa59-4d71076131b4', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/35\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-04 12:32:53', '2026-05-04 12:32:53'),
('389e9d35-687e-4763-b522-3fa6951a50a1', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/31\",\"fas\":\"fa-file-alt\"}', '2026-03-25 02:33:27', '2026-03-16 10:55:49', '2026-03-25 02:33:27'),
('39a34c34-8487-4316-9b1d-a6a179cd15f0', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/9\",\"fas\":\"fa-file-alt\"}', '2026-01-08 22:58:44', '2026-01-08 12:26:34', '2026-01-08 22:58:44'),
('3a6db4ed-2bb8-42c8-8f57-9f600cafb7fa', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/solar-charger-controller\",\"fas\":\"fa-star\"}', '2026-01-06 01:04:30', '2026-01-06 01:00:52', '2026-01-06 01:04:30'),
('3b7704b4-1cda-4104-a6fc-28854abb5931', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/37\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 13:06:49', '2026-05-08 13:06:49'),
('3b8b45b6-d332-4ab2-b8be-15e4d34d2434', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/33\",\"fas\":\"fa-file-alt\"}', '2026-05-04 12:18:36', '2026-04-12 10:34:45', '2026-05-04 12:18:36'),
('3ce9d132-c896-436b-a5a2-e9ebcbdf026e', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/34\",\"fas\":\"fa-file-alt\"}', NULL, '2026-04-12 10:36:33', '2026-04-12 10:36:33'),
('40075bbc-eef4-4e01-ad10-df2187a4ffee', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/32\",\"fas\":\"fa-file-alt\"}', NULL, '2026-04-08 12:09:13', '2026-04-08 12:09:13'),
('53ada72a-316a-403b-9780-2b8098e9cc81', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/33\",\"fas\":\"fa-file-alt\"}', '2026-04-30 10:07:59', '2026-04-12 10:34:29', '2026-04-30 10:07:59'),
('5859c35f-82a5-4a76-8a6a-f486d5318d2f', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/37\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 13:07:04', '2026-05-08 13:07:04'),
('6b9fde25-5990-4d6a-812c-62a3fd64236b', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/8\",\"fas\":\"fa-file-alt\"}', '2026-01-07 04:21:50', '2026-01-07 04:20:16', '2026-01-07 04:21:50'),
('6e230674-fe55-4b49-ab61-018907278c56', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/37\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 13:07:06', '2026-05-08 13:07:06'),
('6e949550-c80f-44f0-bfa3-8c033bc38b03', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/31\",\"fas\":\"fa-file-alt\"}', NULL, '2026-03-16 10:56:10', '2026-03-16 10:56:10'),
('7567066e-a451-4d08-ba15-bade34ac7a0e', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/35\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-04 12:32:51', '2026-05-04 12:32:51'),
('7a8fd15a-1f8d-4efd-b5ac-8f2dd4f69412', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/battery-tester\",\"fas\":\"fa-star\"}', '2026-01-07 02:05:40', '2026-01-07 02:05:32', '2026-01-07 02:05:40'),
('7c9afe08-fc73-45c8-a99f-ad808e7376ad', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/30\",\"fas\":\"fa-file-alt\"}', '2026-03-13 01:25:48', '2026-03-13 01:21:45', '2026-03-13 01:25:48'),
('7d073d79-94a8-470d-86aa-9dad07766b22', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/1\",\"fas\":\"fa-file-alt\"}', '2026-01-05 12:42:15', '2026-01-05 11:48:16', '2026-01-05 12:42:15'),
('7dbc212e-f003-4189-bb22-62c2420cbb89', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/30\",\"fas\":\"fa-file-alt\"}', NULL, '2026-03-13 01:22:03', '2026-03-13 01:22:03'),
('7f101d4e-fbbb-4a9f-ab14-778726097eaf', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/42\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:12:42', '2026-06-09 12:12:42'),
('805ca4d6-2e3a-45e8-bd1a-cc5368b6984b', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"Stock transferred to kasun chathuranga: hello x35\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\",\"fas\":\"fa-box\"}', '2026-04-12 12:35:13', '2026-04-12 11:48:55', '2026-04-12 12:35:13'),
('847c4e73-3799-4bfe-a6a2-5ac63cd7217b', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"Stock received: hello x35\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\",\"fas\":\"fa-box\"}', '2026-05-04 12:18:29', '2026-04-12 11:48:48', '2026-05-04 12:18:29'),
('84d1ea2b-056e-4f2a-bc28-fc6c84b83440', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/12\",\"fas\":\"fa-file-alt\"}', '2026-01-14 00:04:34', '2026-01-13 11:06:16', '2026-01-14 00:04:34'),
('855993c7-8d97-469c-901f-0314b8929870', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/38\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 23:25:35', '2026-05-08 23:25:35'),
('886549a3-8eff-4ec8-8dd2-5f6717515219', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/36\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-05 09:46:39', '2026-05-05 09:46:39'),
('92286922-1417-42ec-ab78-e2383f45a1be', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/41\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:06:17', '2026-06-09 12:06:17'),
('9406a199-492f-4ae8-82b8-21385145bf07', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/clamp-meter-2601063953-238\",\"fas\":\"fa-star\"}', '2026-01-28 10:50:52', '2026-01-26 05:05:04', '2026-01-28 10:50:52'),
('9559329e-79ec-4900-89a0-83dda27f7e47', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/7\",\"fas\":\"fa-file-alt\"}', '2026-01-07 02:05:07', '2026-01-07 02:03:04', '2026-01-07 02:05:07'),
('9fe22a73-70c1-4fd3-9d3c-1aa8167e733c', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/solar-charger-controller\",\"fas\":\"fa-star\"}', '2026-01-06 01:05:03', '2026-01-06 01:00:38', '2026-01-06 01:05:03'),
('a20ebbee-35d7-4c7c-abc3-2de2e284cebd', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/35\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-04 12:32:35', '2026-05-04 12:32:35'),
('a23b879b-c6ac-48d9-a818-a11db9789511', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/43\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:14:13', '2026-06-09 12:14:13'),
('a33db34b-a365-4684-bd0a-ac14256daaf0', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/38\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-08 23:25:25', '2026-05-08 23:25:25'),
('ac72ef6e-ed2a-45fe-8a7e-921ab206474e', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/43\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:14:11', '2026-06-09 12:14:11'),
('b6b838c3-1f49-4502-ba64-5db8e747c193', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/5\",\"fas\":\"fa-file-alt\"}', '2026-01-06 01:04:52', '2026-01-05 14:17:10', '2026-01-06 01:04:52'),
('b9403a77-30e7-46dd-8c2f-045e405c31bb', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/43\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:14:05', '2026-06-09 12:14:05'),
('bca3ee2b-29b9-45da-8f5b-a1a6c5f80439', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"Stock transferred to kasun chathuranga: Apple phone charger x2\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\",\"fas\":\"fa-box\"}', '2026-04-30 10:07:28', '2026-04-29 00:39:08', '2026-04-30 10:07:28'),
('c0789cd5-e62c-459b-bb2d-fdd57f8c9c7f', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/44\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 14:00:17', '2026-06-09 14:00:17'),
('c42f7cc6-1fe6-4728-be29-136d6c4ec6be', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/2\",\"fas\":\"fa-file-alt\"}', '2026-01-05 13:41:30', '2026-01-05 13:36:56', '2026-01-05 13:41:30'),
('c8ae4c6a-eec0-4eba-acf6-8694597c05b8', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/29\",\"fas\":\"fa-file-alt\"}', '2026-03-13 01:25:58', '2026-03-13 01:14:09', '2026-03-13 01:25:58'),
('c96468a6-8a8e-4ddf-b29c-bcc09974d05b', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/44\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 14:00:19', '2026-06-09 14:00:19'),
('d0c1aa65-4b5d-4b72-a3ea-757cae7d2ff1', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/36\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-05 09:46:41', '2026-05-05 09:46:41'),
('d5ee8077-a654-4bc5-9910-fcd5032b6576', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/44\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 14:00:09', '2026-06-09 14:00:09'),
('e1fc018b-1093-476c-8fd4-33c5888b09d0', 'App\\Notifications\\StatusNotification', 'App\\User', 11, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/39\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-09 00:46:09', '2026-05-09 00:46:09'),
('e2140fda-2b92-4bab-8eb3-b69393fd1936', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/39\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-09 00:46:07', '2026-05-09 00:46:07'),
('ecb299fa-0a67-4fa5-89d7-79499778d654', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/11\",\"fas\":\"fa-file-alt\"}', '2026-01-14 00:04:43', '2026-01-13 00:14:13', '2026-01-14 00:04:43'),
('f095bb95-54a4-437f-9acd-4712709618e2', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/40\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-08 23:30:20', '2026-06-08 23:30:20'),
('f40d8d81-35cb-4526-bc17-cb88b8a998a4', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/36\",\"fas\":\"fa-file-alt\"}', NULL, '2026-05-05 09:46:17', '2026-05-05 09:46:17'),
('fd540de3-d81b-44fe-9c47-eeef74aadf47', 'App\\Notifications\\StatusNotification', 'App\\User', 8, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/42\",\"fas\":\"fa-file-alt\"}', NULL, '2026-06-09 12:12:39', '2026-06-09 12:12:39');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(191) NOT NULL,
  `offline_receipt_no` varchar(100) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sales_staff_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_total` double(8,2) NOT NULL,
  `shipping_id` bigint(20) UNSIGNED DEFAULT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `courier_name` varchar(100) DEFAULT NULL,
  `courier_tracking_number` varchar(150) DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `returned_at` timestamp NULL DEFAULT NULL,
  `return_reason` text DEFAULT NULL,
  `coupon` double(8,2) DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `delivery_charge` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` enum('cod','paypal') NOT NULL DEFAULT 'cod',
  `payment_gateway` varchar(50) DEFAULT NULL,
  `payment_reference` varchar(150) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `status` varchar(20) NOT NULL DEFAULT 'new',
  `order_source` varchar(30) NOT NULL DEFAULT 'online',
  `social_platform` varchar(50) DEFAULT NULL,
  `social_order_ref` varchar(100) DEFAULT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `emergency_contact` varchar(50) DEFAULT NULL,
  `country` varchar(191) NOT NULL,
  `post_code` varchar(191) DEFAULT NULL,
  `district` varchar(191) DEFAULT NULL,
  `address1` text NOT NULL,
  `address2` text DEFAULT NULL,
  `address3` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `offline_receipt_no`, `user_id`, `sales_staff_id`, `sub_total`, `shipping_id`, `courier_id`, `courier_name`, `courier_tracking_number`, `shipped_at`, `delivered_at`, `returned_at`, `return_reason`, `coupon`, `total_amount`, `quantity`, `delivery_charge`, `payment_method`, `payment_gateway`, `payment_reference`, `payment_status`, `status`, `order_source`, `social_platform`, `social_order_ref`, `first_name`, `last_name`, `email`, `phone`, `emergency_contact`, `country`, `post_code`, `district`, `address1`, `address2`, `address3`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'ORD-5WISLR4RIO', NULL, 2, NULL, 2950.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2950.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'process', 'online', NULL, NULL, 'perera', 'son', 'son@gmail.com', '0754869523', NULL, 'JO', '85696', NULL, 'digana', 'ampitiya', NULL, NULL, '2026-01-05 13:36:56', '2026-01-05 13:39:57'),
(4, 'ORD-KPOX19IZTW', NULL, 2, NULL, 3100.00, NULL, NULL, 'DHL', '123456', NULL, NULL, NULL, NULL, NULL, 3100.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'process', 'online', NULL, NULL, 'kasun', 'son', 'kasundeni1997@gmail.com', '0757207187', NULL, 'BD', '85696', NULL, 'naththaranpotha', 'ampitiya', NULL, NULL, '2026-01-05 14:08:15', '2026-01-07 04:41:11'),
(5, 'ORD-7XA8NNFXNC', NULL, 2, NULL, 1600.00, NULL, NULL, 'DHL', '123456', NULL, NULL, NULL, NULL, NULL, 1600.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'perera', 'chathuranga', 'eshop@gmail.com', '1234567890', NULL, 'BJ', '78569', NULL, 'digana', 'kundasale', NULL, NULL, '2026-01-05 14:17:09', '2026-01-05 14:28:27'),
(6, 'ORD-OBR7G3LUC3', NULL, 2, NULL, 2750.00, NULL, NULL, 'DHL', '111111', NULL, NULL, NULL, NULL, NULL, 2750.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'son', 'kchathuranga496@gmail.com', '94716853249', NULL, 'LK', '78569', NULL, 'digana', 'kundasale', NULL, NULL, '2026-01-07 01:52:29', '2026-01-08 12:44:07'),
(7, 'ORD-XWNRGLAVWG', NULL, 2, NULL, 1250.00, NULL, NULL, 'DHL', '123456', NULL, NULL, NULL, NULL, NULL, 1250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kchathuranga496@gmail.com', '716853249', NULL, 'LK', '81522', NULL, 'digana', 'naththaramotha', NULL, NULL, '2026-01-07 02:03:04', '2026-01-08 13:12:23'),
(8, 'ORD-AYVDOFXA93', NULL, 2, NULL, 2750.00, NULL, NULL, 'DHL', '111111', NULL, NULL, NULL, NULL, NULL, 2750.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'perera', 'disanayaka', 'kchathuranga496@gmail.com', '762251786', NULL, 'LK', '85696', NULL, 'Sanka, pallegama, deniyaya', 'kundasale', NULL, NULL, '2026-01-07 04:20:14', '2026-01-07 04:42:25'),
(9, 'ORD-O47V7YSMKO', NULL, 3, NULL, 1250.00, NULL, NULL, 'FedEx', '123456', NULL, NULL, NULL, NULL, NULL, 1250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Kavinda', 'Sadaruwan', 'kchathuranga496@gmail.com', '762251786', NULL, 'LK', '78569', NULL, 'arangala', 'ampitiya', NULL, NULL, '2026-01-08 12:26:29', '2026-01-08 12:42:53'),
(10, 'ORD-88G7IOM5NL', NULL, 3, NULL, 1250.00, NULL, NULL, 'DHL', '1999', NULL, NULL, NULL, NULL, NULL, 1250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Kavinda', 'Sadaruwan', 'kchathuranga496@gmail.com', '762251786', NULL, 'LK', '78569', NULL, 'arangala', 'ampitiya', NULL, NULL, '2026-01-08 12:28:24', '2026-01-08 12:35:40'),
(11, 'ORD-CGTDV0JN5Q', NULL, 2, NULL, 2750.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2750.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'process', 'online', NULL, NULL, 'kasun', 'son', 'kchathuranga496@gmail.com', '0725162953', NULL, 'AX', '85696', NULL, 'arangala', 'kadugannawa', NULL, NULL, '2026-01-13 00:14:11', '2026-01-23 04:44:28'),
(12, 'ORD-DUWHQMNQUO', NULL, 2, NULL, 2750.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2750.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'user', 'santha', 'User@gmail.com', '0715263859', NULL, 'AX', '81522', NULL, 'arangala', 'naththaranpotha', NULL, NULL, '2026-01-13 11:06:13', '2026-01-13 11:06:13'),
(14, 'ORD-XU8AOFCHAQ', NULL, 2, NULL, 1250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'sadun', 'santha', 'sadun@gmail.com', '0748596523', NULL, 'AS', '85967', NULL, 'arangala', 'kundasale', NULL, NULL, '2026-01-13 11:19:06', '2026-01-13 11:19:06'),
(15, 'ORD-VK1M6PXD0L', NULL, 2, NULL, 5250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'user', 'saliya', 'kasundeni1997@gmail.com', '0758695866', NULL, 'BS', '81522', NULL, 'arangala', 'naththaranpotha', NULL, NULL, '2026-01-13 11:26:56', '2026-01-13 11:26:56'),
(16, 'ORD-CCOTZCX2CO', NULL, 2, NULL, 5250.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'perera', 'disanayaka', 'kchathuranga496@gmail.com', '1234567890', NULL, 'AX', '81522', NULL, 'pallekele', 'ampitiya', NULL, NULL, '2026-01-18 14:38:31', '2026-01-18 14:38:31'),
(17, 'ORD-3HMK7L5JGM', NULL, 2, NULL, 11500.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11500.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'kasun', 'son', 'admin@gmail.com', '0757207187', NULL, 'AL', '78569', NULL, 'arangala', 'kundasale', NULL, NULL, '2026-01-27 12:19:32', '2026-01-27 12:19:32'),
(18, 'ORD-FTTVZSNRLS', NULL, 2, NULL, 1100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'perera', 'disanayaka', 'kasundeni1997@gmail.com', '0725162953', NULL, 'AL', '81522', NULL, 'digana', 'kundasale', NULL, NULL, '2026-01-27 12:20:55', '2026-01-27 12:20:55'),
(19, 'ORD-YTV8DLFXVI', NULL, 2, NULL, 1100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'perera', 'disanayaka', 'kchathuranga496@gmail.com', '0757207187', NULL, 'AX', '85696', NULL, 'arangala', 'theldeniya', NULL, NULL, '2026-01-27 12:27:30', '2026-01-27 12:27:30'),
(20, 'ORD-EJDZA4H23O', NULL, 2, NULL, 38850.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39200.00, 12, 350.00, 'paypal', NULL, NULL, 'paid', 'pending', 'online', NULL, NULL, 'kasun', 'disanayaka', 'user@gmail.com', '1234567890', NULL, 'Sri Lanka', NULL, NULL, 'pallekele', 'theldeniya', NULL, NULL, '2026-02-13 11:54:31', '2026-02-27 02:54:56'),
(21, 'ORD-QOXOFU5VXM', NULL, 2, NULL, 3880.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4660.00, 2, 780.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'kasun', 'disanayaka', 'user@gmail.com', '0757207187', NULL, 'Sri Lanka', NULL, NULL, 'pallekele', 'kadugannawa', NULL, NULL, '2026-02-13 12:02:35', '2026-02-13 12:02:35'),
(22, 'ORD-FXNOVMKYPD', NULL, 2, 8, 1100.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1100.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'rasun', 'chamod', 'rasun@gmail.com', '0714859845', NULL, 'Sri Lanka', NULL, NULL, 'kaluthara', 'kandy', NULL, NULL, '2026-02-27 00:33:17', '2026-02-27 00:37:48'),
(23, 'ORD-A0001', NULL, 2, NULL, 1500.00, NULL, NULL, NULL, 'TRN-A0001', NULL, NULL, NULL, NULL, NULL, 1500.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'dasun', 'shanaka', 'dasun@gmail.com', '0714586955', NULL, 'Sri Lanka', NULL, NULL, 'Y handiya', 'migamuwa', NULL, NULL, '2026-02-27 00:52:46', '2026-02-27 00:52:46'),
(24, 'ORD-A0002', NULL, 9, 8, 1500.00, NULL, 2, 'Kuubiyo', '1478523697000', NULL, NULL, NULL, NULL, NULL, 1500.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'pethum', 'Nissanka', 'pethum@gmail.com', '0725126389', '0745286956', 'Sri Lanka', NULL, NULL, '132/2', 'pitipana', NULL, NULL, '2026-02-27 01:23:17', '2026-06-09 13:30:07'),
(25, 'ORD-A0003', NULL, 2, NULL, 2500.00, NULL, NULL, NULL, 'TRN-A0003', NULL, NULL, NULL, NULL, NULL, 2500.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kasundeni1997@gmail.com', '0762251786', '0716853249', 'Sri Lanka', NULL, NULL, 'sanka', 'kolawenigama', NULL, NULL, '2026-03-13 00:19:32', '2026-03-13 00:19:32'),
(26, 'ORD-A0004', NULL, 2, NULL, 7500.00, NULL, NULL, NULL, 'TRN-A0004', NULL, NULL, NULL, NULL, NULL, 7500.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kasundeni1997@gmail.com', '0762251786', '0716853249', 'Sri Lanka', NULL, NULL, 'sanka', 'kolawenigama', NULL, NULL, '2026-03-13 00:27:20', '2026-03-13 00:27:20'),
(27, 'ORD-A0005', NULL, 2, NULL, 2750.00, NULL, NULL, 'DHL', NULL, NULL, NULL, '2026-05-08 12:44:08', 'user not satisfied', NULL, 2750.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'returned', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kasundeni1997@gmail.com', '0762251786', '0716853249', 'Sri Lanka', NULL, NULL, 'sanka', 'kolawenigama', NULL, NULL, '2026-03-13 00:37:50', '2026-05-08 12:44:08'),
(28, 'ORD-A0006', NULL, 2, NULL, 8000.00, NULL, NULL, NULL, 'TRN-A0006', NULL, NULL, NULL, NULL, NULL, 8000.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kasundeni1997@gmail.com', '0716853249', '0762259786', 'Sri Lanka', NULL, NULL, 'sanka', 'kolawenigama', NULL, NULL, '2026-03-13 01:04:31', '2026-03-13 01:09:18'),
(29, 'ORD-A0007', NULL, 2, NULL, 1300.00, NULL, NULL, 'DHL', '125685974152', NULL, NULL, NULL, NULL, NULL, 1300.00, 1, 0.00, 'cod', NULL, NULL, 'paid', 'delivered', 'online', NULL, NULL, 'kavinda', 'Rupasingha', 'user@gmail.com', '0771519979', '0760807461', 'Sri Lanka', NULL, NULL, 'warapitiya', 'medamahanuwara', NULL, NULL, '2026-03-13 01:14:05', '2026-05-04 11:49:52'),
(30, 'ORD-A0008', NULL, 2, NULL, 950.00, NULL, NULL, NULL, 'TRN-A0008', NULL, NULL, NULL, NULL, NULL, 950.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kavinda', 'Rupasingha', 'user@gmail.com', '0771519979', '0716853249', 'Sri Lanka', NULL, NULL, 'pallekele', 'kadugannawa', NULL, NULL, '2026-03-13 01:21:42', '2026-03-13 01:21:42'),
(31, 'ORD-A0009', NULL, 2, NULL, 340.00, NULL, NULL, 'DHL', '1478523697895', NULL, NULL, NULL, NULL, NULL, 340.00, 1, 0.00, 'cod', NULL, NULL, 'paid', 'delivered', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kasundeni1997@gmail.com', '0762251786', '0716853249', 'Sri Lanka', NULL, NULL, 'sanka', 'kolawenigama', NULL, NULL, '2026-03-16 10:55:46', '2026-05-04 11:50:36'),
(32, 'ORD-A0010', NULL, 2, NULL, 15150.00, NULL, NULL, NULL, 'TRN-A0010', NULL, NULL, NULL, NULL, NULL, 15150.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'ship', 'online', NULL, NULL, 'User', 'disanayaka', 'user@gmail.com', '0757207187', '0716853249', 'Sri Lanka', NULL, 'Kandy', 'pallekele', 'kadugannawa', NULL, NULL, '2026-04-08 12:08:53', '2026-04-09 06:17:38'),
(33, 'ORD-A0011', NULL, 10, NULL, 5250.00, NULL, NULL, NULL, '12568597486', NULL, NULL, NULL, NULL, NULL, 5250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'mahesh', 'kasufunny97@gmail.com', '0716853249', '0762251786', 'Sri Lanka', NULL, 'Matara', 'kasun mahesh', 'kolawenigama', NULL, NULL, '2026-04-12 10:34:26', '2026-05-04 11:30:53'),
(34, 'ORD-A0012', NULL, 10, NULL, 5250.00, NULL, NULL, NULL, 'TRN-A0012', NULL, NULL, NULL, NULL, NULL, 5250.00, 1, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'kasun', 'mahesh', 'kasufunny97@gmail.com', '0716853249', '0762259786', 'Sri Lanka', NULL, 'Matara', 'kasun mahesh', 'kolawenigama', NULL, NULL, '2026-04-12 10:36:26', '2026-04-12 10:36:26'),
(35, 'ORD-A0013', NULL, 2, NULL, 19100.00, NULL, NULL, 'DHL', '8235567690', NULL, NULL, NULL, NULL, NULL, 19100.00, 4, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Sithija', 'Mudalige', 'sithijamudalige15@gmail.com', '0787675866', '0748596758', 'Sri Lanka', NULL, 'Kandy', 'Dalukgolla Purana Raja Maha Viharaya Asala', 'Ampitiya', NULL, NULL, '2026-05-04 12:32:33', '2026-05-05 01:09:13'),
(36, 'ORD-A0014', NULL, 2, NULL, 9000.00, NULL, NULL, 'DHL', '4589678495', NULL, NULL, NULL, NULL, NULL, 9000.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Narada', 'Darshana', 'stadarshana@gmail.com', '0767385049', '0762251786', 'Sri Lanka', NULL, 'Nuwara Eliya', 'Nildannahinda', NULL, NULL, NULL, '2026-05-05 09:46:13', '2026-05-05 09:47:47'),
(37, 'ORD-A0015', NULL, NULL, NULL, 2110.00, NULL, NULL, 'DHL', NULL, NULL, NULL, '2026-05-08 13:13:34', 'asd', NULL, 2540.00, 14, 430.00, 'cod', NULL, NULL, 'unpaid', 'returned', 'online', NULL, NULL, 'Kavinda', 'Rupasingha', 'kavindarupasingha78@gmail.com', '0771519979', '0716853249', 'Sri Lanka', NULL, 'Kandy', 'pallekele', 'kadugannawa', NULL, NULL, '2026-05-08 13:06:46', '2026-05-08 13:13:34'),
(39, 'ORD-A0016', NULL, 15, NULL, 360.00, NULL, NULL, 'DHL', NULL, NULL, NULL, '2026-05-09 00:50:37', 'hi', NULL, 870.00, 3, 510.00, 'cod', NULL, NULL, 'unpaid', 'returned', 'online', NULL, NULL, 'Kavinda', 'Rupasingha', 'kavindarupasingha78@gmail.com', '0771519979', '0716853249', 'Sri Lanka', NULL, 'Ampara', 'pallekele', 'kadugannawa', NULL, NULL, '2026-05-09 00:45:48', '2026-05-09 00:50:37'),
(40, 'ORD-A0017', NULL, 16, NULL, 8470.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9250.00, 4, 780.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kasun', 'Maduranga', 'kasunmaduranga123@gmail.com', '0760807461', '0762259786', 'Sri Lanka', NULL, 'Colombo', '132/2', 'Homagama', NULL, NULL, '2026-06-08 23:30:18', '2026-06-08 23:30:18'),
(41, 'ORD-A0018', NULL, 16, NULL, 8470.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9250.00, 4, 780.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kasun', 'Maduranga', 'kasunmaduranga123@gmail.com', '0760807461', '0762259786', 'Sri Lanka', NULL, 'Ampara', 'pallekele', 'kadugannawa', NULL, NULL, '2026-06-09 12:06:14', '2026-06-09 12:06:14'),
(42, 'ORD-A0019', NULL, 16, NULL, 8470.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9250.00, 4, 780.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kasun', 'Maduranga', 'kasunmaduranga123@gmail.com', '0760807461', '0762259786', 'Sri Lanka', NULL, 'Ampara', 'pallekele', 'kadugannawa', NULL, NULL, '2026-06-09 12:12:32', '2026-06-09 12:12:32'),
(43, 'ORD-A0020', NULL, 16, NULL, 12750.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12750.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kasun', 'Maduranga', 'kasunmaduranga123@gmail.com', '0760807461', '0745286956', 'Sri Lanka', NULL, 'Badulla', 'sanka', 'kolawenigama', NULL, NULL, '2026-06-09 12:14:05', '2026-06-09 12:14:05'),
(44, 'ORD-A0021', NULL, 16, NULL, 2300.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2300.00, 2, 0.00, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'Kasun', 'Maduranga', 'kasunmaduranga123@gmail.com', '0760807461', '0762251786', 'Sri Lanka', NULL, 'Monaragala', '132/2', 'Mullegama', 'Homagama', NULL, '2026-06-09 14:00:07', '2026-06-09 14:00:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `quote` text DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `tags` varchar(191) DEFAULT NULL,
  `post_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_tag_id` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `comment` text NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `replied_comment` text DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `title`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 'අද දින සිට අපෙන් මිලදී ගන්නා සෑම උපකරණයකටම 10% වට්ටම්...!', 'homepage-marquee', 'active', '2026-04-08 23:07:23', '2026-05-12 23:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `summary` text NOT NULL,
  `description` longtext DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `warranty` text DEFAULT NULL,
  `returns` text DEFAULT NULL,
  `bulk_discount_type` enum('none','qty','value') NOT NULL DEFAULT 'none',
  `bulk_discount_threshold` int(11) DEFAULT NULL,
  `bulk_discount_amount` decimal(12,2) DEFAULT NULL,
  `bulk_discount_amount_type` enum('fixed','percent') NOT NULL DEFAULT 'fixed',
  `photo` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `size` varchar(191) DEFAULT 'M',
  `condition` enum('default','new','hot') NOT NULL DEFAULT 'default',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `price` double(8,2) NOT NULL,
  `purchase_price` decimal(12,2) DEFAULT NULL,
  `sale_price` decimal(12,2) DEFAULT NULL,
  `weight` double(8,2) NOT NULL DEFAULT 0.00,
  `wholesale_price` decimal(12,2) DEFAULT NULL,
  `wholesale_min_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `discount` double(8,2) NOT NULL,
  `free_shipping` tinyint(1) NOT NULL DEFAULT 0,
  `is_featured` tinyint(1) NOT NULL,
  `free_shipping_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `courier_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seller_edit_count` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `youtube_link`, `warranty`, `returns`, `bulk_discount_type`, `bulk_discount_threshold`, `bulk_discount_amount`, `bulk_discount_amount_type`, `photo`, `stock`, `size`, `condition`, `status`, `price`, `purchase_price`, `sale_price`, `weight`, `wholesale_price`, `wholesale_min_qty`, `discount`, `free_shipping`, `is_featured`, `free_shipping_enabled`, `cat_id`, `child_cat_id`, `brand_id`, `courier_id`, `seller_edit_count`, `created_at`, `updated_at`) VALUES
(1, 'Solar Charger Controller PWM 10A', 'solar-charger-controller-pwm-10a', '<p>PWM 10A ( Blue )</p>', '<p class=\"MsoNormal\"><span lang=\"EN-US\">Product name: 12V 8A pulse repair\r\nintelligent charger with liquid crystal lead-acid Battery<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Shell material: plastic<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Product size: 150??85??60mm<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Working voltage: 12V/24V<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Voltage detection: yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Switch mode technology: Yes <o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Polarity protection: yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Output short circuit protection: Yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Non-Battery link protection: Yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Surge protection: Yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Over temperature protection: Yes<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Input voltage: 100-240V AC, 50-60Hz<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Rated power: 12V DC, 5-8A Max.<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Minimum starting voltage: 8.0V<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Scope of application: most types of\r\nlead-acid batteries include calcium, gel and AGM, wet type, EFB, etc.<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Ba-ttery range: 4-120Ah<o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Thermal protection: 65</span><span lang=\"EN-US\" style=\"font-family:&quot;Cambria Math&quot;,serif;mso-bidi-font-family:&quot;Cambria Math&quot;\">???</span><span lang=\"EN-US\"> </span><span lang=\"EN-US\">??</span><span lang=\"EN-US\">5</span><span lang=\"EN-US\" style=\"font-family:&quot;Cambria Math&quot;,serif;\r\nmso-bidi-font-family:&quot;Cambria Math&quot;\">???</span><span lang=\"EN-US\"><o:p></o:p></span></p><p class=\"MsoNormal\"><span lang=\"EN-US\">Work efficiency: application. 85%.<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\"><span lang=\"EN-US\">Packing list: 12V 8A smart charger*1,\r\nmanual*1<o:p></o:p></span></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>10A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>25V</td></tr><tr><td>Power</td><td>120W</td></tr></tbody></table><p><br></p>', 'https://www.youtube.com/watch?v=w5KeRcdOBbE', '10 years', '2 weeks', 'qty', 3, 10.00, 'percent', '/storage/photos/1/Products/01.jpg,/storage/photos/1/Products/02.jpg,/storage/photos/1/Products/03.png,/storage/photos/1/Products/04.png,/storage/photos/1/Products/05.png,/storage/products/rxj7yn34S3xLFJABkA3BNqCuE61tbB2FK2olq0SG.jpg', 3, '', 'new', 'active', 1500.00, NULL, 1500.00, 0.35, NULL, 0, 0.00, 1, 1, 1, 2, NULL, NULL, NULL, 0, '2026-01-06 01:37:29', '2026-06-09 13:29:34'),
(2, 'Solar Charger Controller PWM 30A', 'solar-charger-controller-pwm-30a', '<p>PWM 30A ( Blue )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>30A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>25V</td></tr><tr><td>Power</td><td>360W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/02.jpg', 5, '', 'new', 'active', 1600.00, NULL, 1600.00, 1.25, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 01:58:24', '2026-02-13 13:16:12'),
(3, 'Solar Charger Controller PWM 20A', 'solar-charger-controller-pwm-20a', '<p>PWM 20A ( Green )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>20A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>260W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/03.png', 5, '', 'new', 'active', 2950.00, NULL, 2950.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:01:07', '2026-02-13 13:16:37'),
(4, 'Solar Charger Controller PWM 60A', 'solar-charger-controller-pwm-60a', '<p>PWM 60A ( Green )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>720W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/04.png', 5, '', 'new', 'active', 5750.00, NULL, 5750.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:04:25', '2026-02-13 13:16:56'),
(5, 'Solar Charger Controller PWM 20A', 'solar-charger-controller-pwm-20a-2601063735-866', '<p>PWM 20A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>20A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>250W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/05.png', 5, '', 'new', 'active', 3100.00, NULL, 3100.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:07:35', '2026-02-13 13:14:56'),
(6, 'Solar Charger Controller PWM 40A', 'solar-charger-controller-pwm-40a', '<p>PWM 40A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>40A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>480W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/06.png', 5, '', 'new', 'active', 4000.00, NULL, 4000.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:47:29', '2026-01-06 02:47:29'),
(7, 'Solar Charger Controller PWM 60A', 'solar-charger-controller-pwm-60a-2601062113-746', '<p>PWM 60A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>760W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/07.png', 5, '', 'new', 'active', 5750.00, NULL, 5750.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:51:13', '2026-01-06 02:51:13'),
(8, 'Solar Charger Controller PWM 100A', 'solar-charger-controller-pwm-100a', '<p>PWM 100A ( Orange )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>100A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>1200W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/08.png', 5, '', 'new', 'active', 9900.00, NULL, 9900.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:54:38', '2026-01-06 02:54:38'),
(9, 'Solar Charger Controller MPPT 60A', 'solar-charger-controller-mppt-60a', '<p>MPPT 60A ( Ash )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>760W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/09.jpeg', 5, '', 'new', 'active', 15750.00, NULL, 15750.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:56:59', '2026-01-06 02:56:59'),
(10, 'Solar Charger Controller MPPT 100A', 'solar-charger-controller-mppt-100a', '<p>MPPT 100A ( White )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>100A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>1300W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/10.png', 5, '', 'new', 'active', 24000.00, NULL, 24000.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 02:59:25', '2026-01-06 02:59:25'),
(11, 'Solar Charger Controller MPPT 40A', 'solar-charger-controller-mppt-40a', '<p>MPPT 40A ( Black )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>40A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>80V</td></tr><tr><td>Power</td><td>480W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/11.png', 5, '', 'new', 'active', 15500.00, NULL, 15500.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 03:01:12', '2026-01-06 03:01:12'),
(12, 'Solar Charger Controller MPPT 60A', 'solar-charger-controller-mppt-60a-2601063329-553', '<p>MPPT 60A ( Black )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>80V</td></tr><tr><td>Power</td><td>780W</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/12.png', 5, '', 'new', 'active', 19000.00, NULL, 19000.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 2, NULL, NULL, NULL, 0, '2026-01-06 03:03:29', '2026-01-06 03:03:29'),
(13, 'Inverter 700W', 'inverter-700w', '<p>Inverter 700W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>12V</td></tr><tr><td>Output</td><td>230V</td></tr><tr><td>Type</td><td>Modified Sine</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/13.jpg', 5, '', 'new', 'active', 7250.00, NULL, 7250.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 3, NULL, NULL, NULL, 0, '2026-01-06 04:02:51', '2026-01-06 04:02:51'),
(14, 'Inverter 3000W', 'inverter-3000w', '<p>Built in MPPT Charger</p><p>Change Over</p><p>Safety Cut off</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>24V</td></tr><tr><td>Output</td><td>230V</td></tr><tr><td>Type</td><td>Hybrid Inverter</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/14.jpg', 5, '', 'new', 'active', 120000.00, NULL, 120000.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 3, NULL, NULL, NULL, 0, '2026-01-06 04:05:00', '2026-01-06 04:05:00'),
(15, 'Battery charger', 'battery-charger', '<p>12V, 6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>12V</td></tr><tr><td>Current&nbsp;</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Capacity</td><td>Upto 90Ah</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/15.png', 5, '', 'new', 'active', 4000.00, NULL, 4000.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 04:07:52', '2026-01-06 04:23:41'),
(16, 'Battery charger', 'battery-charger-2601063940-802', '<p>12V, 24V, 8 A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>12V/24V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Capacity</td><td>Upto 120Ah</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/16.jpg', 5, '', 'new', 'active', 5800.00, NULL, 5800.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 04:09:40', '2026-01-06 04:09:40'),
(17, 'Router Cable', 'router-cable', '<p>DC 5V-12V</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Router Cable&nbsp;</td><td>USB to 12V</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/17.png', 5, '', 'new', 'active', 375.00, NULL, 375.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 12, NULL, NULL, NULL, 0, '2026-01-06 04:18:09', '2026-01-06 04:18:09'),
(18, 'DC Bulb', 'dc-bulb', '<p>12V, 9W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Socket</td><td>E27(Screy Type)</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/18.png', 5, '', 'new', 'active', 390.00, NULL, 390.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 6, NULL, NULL, NULL, 0, '2026-01-06 04:19:27', '2026-01-06 04:23:25'),
(19, 'DC Bulb 12V', 'dc-bulb-12v', '<p>12V, 12W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Socket</td><td>E27(Screy Type)</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/19.jpg', 5, '', 'new', 'active', 440.00, NULL, 440.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 6, NULL, NULL, NULL, 0, '2026-01-06 05:09:37', '2026-01-06 05:09:37'),
(20, '20W LED Chip', '20w-led-chip', '<p>Direct 230V Power</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Driver</td><td>No Drivers need</td></tr><tr><td>Power</td><td>230V</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/20.png', 5, '', 'new', 'active', 350.00, NULL, 350.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 6, NULL, NULL, NULL, 0, '2026-01-06 05:19:26', '2026-01-06 05:19:26'),
(21, 'Xooxi power bank', 'xooxi-power-bank', '<p>Xooxi power bank 10000Mah</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><table class=\"table table-bordered\" style=\"width: 1218.4px;\"><tbody><tr><td>Capacity</td><td>10000Mah</td></tr><tr><td>Power</td><td>22.5W</td></tr></tbody></table></td><td><br></td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/21.png', 5, '', 'new', 'active', 1800.00, NULL, 1800.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 7, NULL, NULL, NULL, 0, '2026-01-06 05:21:46', '2026-01-06 05:25:55'),
(22, 'VHF Mic', 'vhf-mic', '<p>80m Range</p><p>Less Noice</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Power</td><td>2+1AAA Battery</td></tr><tr><td><br></td><td>High Gain</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/22.png', 5, '', 'new', 'active', 2250.00, NULL, 2250.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 12, NULL, NULL, NULL, 0, '2026-01-06 05:24:35', '2026-01-06 05:24:35'),
(23, 'Ear Phone', 'ear-phone', '<p>Ear Phone Wire</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>2.5mm</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/23.png', 5, '', 'new', 'active', 360.00, NULL, 360.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 05:27:25', '2026-01-06 05:27:25'),
(24, 'Moisture Meter', 'moisture-meter', '<p>Coconut Chips</p><p>Grain, Rice, Floor</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Model</td><td>AR991</td></tr><tr><td>Power</td><td>AAA 4 Battery</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/24.png', 5, '', 'new', 'active', 5900.00, NULL, 5900.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 05:29:39', '2026-01-06 05:29:39'),
(25, 'Laser Distance Meter', 'laser-distance-meter', '<p>Pocket Size Small</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Charging Port</td><td>Micro USB</td></tr><tr><td>Power</td><td>Rechargable</td></tr><tr><td>Distance</td><td>80m</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/25.png', 5, '', 'new', 'active', 5900.00, NULL, 5900.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 05:32:08', '2026-01-06 05:32:08'),
(26, 'PH meter', 'ph-meter', '<p>Water Tester, EC, PH, TDS,&nbsp;<span style=\"font-size: 1rem;\">Salt</span></p>', '<p>5 in one</p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/26.png', 5, '', 'new', 'active', 4250.00, NULL, 4250.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 11:43:17', '2026-01-06 11:43:17'),
(27, 'Buck converter 300W', 'buck-converter-300w', '<p>Step Down</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Power</td><td>300W</td></tr><tr><td>Voltage</td><td>4.40V</td></tr><tr><td>Current</td><td>30A</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/27.jpg', 5, '', 'new', 'active', 1100.00, NULL, 1100.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 7, NULL, NULL, NULL, 0, '2026-01-06 11:47:20', '2026-01-06 11:47:20'),
(28, 'Charging control module', 'charging-control-module', '<p>30A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>6-60V adjust</td></tr><tr><td>Current</td><td>30A</td></tr><tr><td>Timer cutoff</td><td>Option</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/28.png', 5, '', 'new', 'active', 1100.00, NULL, 1100.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 11:49:20', '2026-01-06 11:49:20'),
(29, 'Battery charger', 'battery-charger-2601062105-555', '<p>14.4V, 1A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>1A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/29.png', 5, '', 'new', 'active', 650.00, NULL, 650.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 11:51:05', '2026-01-06 11:51:05'),
(30, 'Battery charger', 'battery-charger-2601062235-160', '<p>14.4V, 2A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>2A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/30.png', 5, '', 'new', 'active', 750.00, NULL, 750.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 11:52:35', '2026-01-06 11:52:35'),
(31, 'Battery charger', 'battery-charger-2601062357-744', '<p>14.4V, 3A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/31.png', 5, '', 'new', 'active', 950.00, NULL, 950.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 11:53:57', '2026-01-06 11:53:57'),
(32, 'Battery charger, Spray', 'battery-charger-spray', '<p>14.4V, 3A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>13A Female</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/32.png', 5, '', 'new', 'active', 975.00, NULL, 975.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 5, NULL, NULL, NULL, 0, '2026-01-06 11:55:28', '2026-01-06 11:55:28'),
(33, 'HV Meter', 'hv-meter', '<p>12MV</p><p>High Voltage meter</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Capacity</td><td>12000V</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/33.png', 5, '', 'new', 'active', 11500.00, NULL, 11500.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 11:59:02', '2026-01-06 11:59:02'),
(34, 'Arduino UNO', 'arduino-uno', '<p>Arduino UNO(Large IC) with cable</p>', NULL, NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/34.png', 5, '', 'new', 'active', 1500.00, NULL, 1500.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 12, NULL, NULL, NULL, 0, '2026-01-06 12:00:23', '2026-01-06 12:00:23'),
(35, 'Arduino UNO', 'arduino-uno-2601063125-204', '<p>Arduino UNO(Micro IC) with cable</p>', NULL, NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/35.png', 5, '', 'new', 'active', 950.00, NULL, 950.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 12, NULL, NULL, NULL, 0, '2026-01-06 12:01:25', '2026-01-06 12:01:25'),
(36, 'Car Charger', 'car-charger', '<p>Car Charger</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Option</td><td>18W</td></tr><tr><td><br></td><td>Fast Charging</td></tr><tr><td><br></td><td>Micro, USB</td></tr><tr><td><br></td><td>C port, PD</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/36.png', 5, '', 'new', 'active', 1300.00, NULL, 1300.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 12:52:20', '2026-01-06 12:52:20'),
(37, 'Apple phone charger', 'apple-phone-charger', '<p>Apple phone charger with cable&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Output</td><td>C Port to C Port</td></tr><tr><td><br></td><td>Iphone, 14, 15, 16</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/37.png', 5, '', 'new', 'active', 1350.00, NULL, 1350.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 12:54:18', '2026-01-06 12:54:18'),
(38, 'phone charger', 'phone-charger', '<p>Apple /samsung phone charger</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Output</td><td>C Port</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/38.png', 4, '', 'new', 'active', 1100.00, NULL, 1100.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 12:55:08', '2026-05-05 01:09:13'),
(39, 'Data Cable', 'data-cable', '<p>Data Cable for Phone</p><p>6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>USB</td></tr><tr><td>Output</td><td>Micro</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/39.png', 5, '', 'new', 'active', 240.00, NULL, 240.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 12:56:57', '2026-01-06 12:56:57'),
(40, 'Data Cable', 'data-cable-2601062811-634', '<p>Data Cable for Phone</p><p>6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>USB</td></tr><tr><td>Output</td><td>C Port</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/40.png', 4, '', 'new', 'active', 340.00, NULL, 340.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 9, NULL, NULL, NULL, 0, '2026-01-06 12:58:11', '2026-05-04 11:50:36'),
(41, 'Multimeter', 'multimeter', '<p>Multimeter</p><p>AnEngXL830</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Back Cover</td></tr><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/41.png', 4, '', 'new', 'active', 1300.00, NULL, 1300.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 12:59:51', '2026-05-04 11:49:52'),
(42, 'Multimeter', 'multimeter-2601063053-75', '<p>Multimeter</p><p>AnEngM1</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/42.png', 5, '', 'new', 'active', 1800.00, NULL, 1800.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:00:53', '2026-01-06 13:00:53'),
(43, 'Multimeter', 'multimeter-2601063202-398', '<p>Multimeter</p><p>AnEng8002</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr><tr><td>Temperature Prob</td></tr><tr><td>Pouch</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/43.jpg', 3, '', 'new', 'active', 7500.00, NULL, 7500.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:02:02', '2026-05-05 09:47:47'),
(44, 'Multimeter', 'multimeter-2601063320-875', '<p>Multimeter</p><p>AnEng113B</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr><tr><td>Temperature Prob</td></tr><tr><td>Pouch</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/photos/1/Products/44.png', 5, '', 'new', 'active', 7500.00, NULL, 7500.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:03:20', '2026-01-06 13:03:20'),
(45, 'Multimeter SMD tester', 'multimeter-smd-tester', '<p>Multimeter SMD tester</p><p>AnEng GN701</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 extra probes</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/45.PNG,/storage/products/SVVLZYWjGfJQA7OatLUsvCyNJlwXx5Ma17Ogxv3S.png', 2, '', 'new', 'active', 5250.00, 4500.00, 5250.00, 355.00, NULL, 0, 0.00, 1, 1, 1, 8, NULL, NULL, NULL, 0, '2026-01-06 13:05:00', '2026-05-05 01:09:13'),
(46, 'Battery Tester', 'battery-tester', '<p>Battery Tester</p><p>AnEng M1</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/46-removebg-preview.png', 3, '', 'new', 'active', 1250.00, NULL, 1250.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:06:45', '2026-01-29 05:21:46'),
(47, 'Clamp meter', 'clamp-meter', '<p>Clamp meter (AC only)</p><p>AnEng ST181&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Current</td><td>400A</td></tr><tr><td>Options</td><td>AC</td></tr><tr><td>Pouch</td><td><br></td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/47.jpg', 2, '', 'new', 'active', 2750.00, 2250.00, 2750.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:08:14', '2026-05-08 12:44:08'),
(48, 'Clamp meter', 'clamp-meter-2601063953-238', '<p>Clamp meter(AC/ DC both)</p><p>AnEng PN200&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Current</td><td>400A</td></tr><tr><td>Options</td><td>AC and DC</td></tr><tr><td>Temperature Pro</td><td><br></td></tr><tr><td>Pouch</td><td><br></td></tr></tbody></table><p><br></p>', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/photos/1/Products/48.jpg', 4, '', 'new', 'active', 5250.00, NULL, 5250.00, 0.00, NULL, 0, 0.00, 0, 1, 0, 8, NULL, NULL, NULL, 0, '2026-01-06 13:09:53', '2026-05-05 01:09:13'),
(57, 'CLI Test Product 1775674861', 'cli-test-product-1775674861', 'CLI inserted product', 'Inserted via scripts/test_create_product.php', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/products/test.jpg', 5, '', 'default', 'active', 999.00, 500.00, 999.00, 0.00, NULL, 0, 0.00, 0, 0, 0, 2, NULL, NULL, NULL, 0, '2026-04-08 13:31:01', '2026-04-08 13:31:01'),
(58, 'CLI Test Product 1775675781', 'cli-test-product-1775675781', 'CLI inserted product', 'Inserted via scripts/test_create_product.php', NULL, NULL, NULL, 'none', NULL, NULL, 'fixed', '/storage/products/test.jpg', 5, '', 'default', 'active', 999.00, 500.00, 999.00, 0.00, NULL, 0, 0.00, 0, 0, 0, 2, NULL, NULL, NULL, 0, '2026-04-08 13:46:21', '2026-04-08 13:46:21'),
(59, 'hi', 'hi', '<p>hello</p>', 'asdfghjkliuygf', NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/products/RNWrQbseg6oUjmT5Lg3UPMfe1CCH9AqQYJ5W0hfL.png,/storage/products/5oJZM0bRufa3Xj1LnHAvpOaMsvgwsZwboVLrY2YM.jpg,/storage/products/TCkvWxBDq2Imne4T82KycoEtmqVOdnXbIMrJ30U4.jpg', 34, '', 'new', 'active', 1500.00, 1300.00, 1500.00, 0.00, NULL, 0, 0.00, 0, 0, 0, 11, NULL, NULL, NULL, 0, '2026-04-08 13:46:59', '2026-06-09 14:50:34'),
(60, 'hello', 'hello', '<p>hi</p>', NULL, NULL, NULL, NULL, 'none', NULL, NULL, 'percent', '/storage/products/iGIkt7oFOr71W9PFKC8tSposiF78kdZ7lgu8RKOI.png,/storage/products/gMsD4pdjJpjkr9u3Cp86kVl1Wq0ercV2F8r7mKAJ.jpg,/storage/products/nPTw1Y7bQS1fx0kInHV8QG1ylXggv07OZt7cQJRX.png,/storage/products/xrkEuoSFay9fDfXuU4wQzH7dykLA9QESBePe2kH8.png', 120, '', 'new', 'active', 120.00, 150.00, 120.00, 0.80, NULL, 0, 0.00, 0, 1, 0, 11, NULL, NULL, NULL, 0, '2026-04-08 14:01:15', '2026-06-09 14:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rate` tinyint(4) NOT NULL DEFAULT 0,
  `review` text DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `user_id`, `product_id`, `rate`, `review`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 5, NULL, 'active', '2026-01-06 01:00:37', '2026-01-06 01:00:37'),
(2, 1, NULL, 3, NULL, 'active', '2026-01-06 01:00:51', '2026-01-06 01:00:51'),
(3, 1, 46, 4, NULL, 'active', '2026-01-07 02:05:32', '2026-01-07 02:05:32'),
(4, 2, 48, 5, 'gkgkgkd', 'active', '2026-01-26 05:05:00', '2026-01-26 05:05:00'),
(5, 2, 48, 5, NULL, 'active', '2026-01-26 05:08:08', '2026-01-26 05:08:08');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `value` varchar(191) NOT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_admin_product_stocks`
--

CREATE TABLE `sales_admin_product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_admin_product_stocks`
--

INSERT INTO `sales_admin_product_stocks` (`id`, `sales_admin_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 8, 60, 35, '2026-04-12 11:48:48', '2026-04-12 11:48:48'),
(2, 8, 37, 2, '2026-04-29 00:38:49', '2026-04-29 00:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `sales_admin_stock_transfers`
--

CREATE TABLE `sales_admin_stock_transfers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sales_admin_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales_admin_stock_transfers`
--

INSERT INTO `sales_admin_stock_transfers` (`id`, `sales_admin_id`, `product_id`, `quantity`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 8, 60, 35, 1, '2026-04-12 11:48:48', '2026-04-12 11:48:48'),
(2, 8, 37, 2, 1, '2026-04-29 00:38:49', '2026-04-29 00:38:49');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` longtext NOT NULL,
  `vision` longtext DEFAULT NULL,
  `mission` longtext DEFAULT NULL,
  `commitment_energy_independence` longtext DEFAULT NULL,
  `specialized_product_range` longtext DEFAULT NULL,
  `why_choose_delimach_lanka` longtext DEFAULT NULL,
  `short_des` text NOT NULL,
  `logo` varchar(191) NOT NULL,
  `photo` varchar(191) NOT NULL,
  `address` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `facebook` varchar(191) DEFAULT NULL,
  `instagram` varchar(191) DEFAULT NULL,
  `youtube` varchar(191) DEFAULT NULL,
  `twitter` varchar(191) DEFAULT NULL,
  `whatsapp` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `small_banner_image` varchar(191) DEFAULT NULL,
  `small_banner_link` varchar(191) DEFAULT NULL,
  `small_banner_status` varchar(191) NOT NULL DEFAULT 'inactive',
  `shipping_cost_upto_1kg` int(10) UNSIGNED NOT NULL DEFAULT 350,
  `shipping_cost_over_1kg_extra` int(10) UNSIGNED NOT NULL DEFAULT 80
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `description`, `vision`, `mission`, `commitment_energy_independence`, `specialized_product_range`, `why_choose_delimach_lanka`, `short_des`, `logo`, `photo`, `address`, `phone`, `email`, `facebook`, `instagram`, `youtube`, `twitter`, `whatsapp`, `created_at`, `updated_at`, `small_banner_image`, `small_banner_link`, `small_banner_status`, `shipping_cost_upto_1kg`, `shipping_cost_over_1kg_extra`) VALUES
(1, '<p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">Welcome to <b>Delimach\r\nLanka (Pvt) Ltd</b>, Sri Lanka\'s specialized online hub for advanced energy\r\nsolutions, automotive excellence, and smart technology. Based in Kadawatha, we\r\nhave evolved into a digital-first leader dedicated to delivering innovation\r\ndirectly to your doorstep no matter how remote your location.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"text-align:justify\">\r\n\r\n</p><p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">As an authorized\r\n<b>sub-distributor for Shell Engine Oils</b>, we combine the reliability of a\r\nglobal brand with our local expertise to serve online customer and our\r\ncorporate network<o:p></o:p></span></p>', '<p><span lang=\"EN-US\" style=\"font-size:12.0pt;line-height:115%;\r\nfont-family:&quot;Aptos&quot;,sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\r\nAptos;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:&quot;Iskoola Pota&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\r\nEN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">To be the primary\r\ncatalyst for energy independence in Sri Lanka, ensuring that even the most\r\nremote communities have access to sustainable power and high-performance\r\ntechnology.</span></p>', '<p><span lang=\"EN-US\" style=\"font-size:12.0pt;line-height:115%;\r\nfont-family:&quot;Aptos&quot;,sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\r\nAptos;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:&quot;Iskoola Pota&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\r\nEN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">To empower our\r\ncustomers with high-quality off grid system, DIY energy systems and premium\r\nlubricants through a seamless e-commerce platform, backed by technical and guidance.</span></p>', '<p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">At Delimach\r\nLanka, we recognize that reliable electricity is a necessity, not a luxury. We\r\ndeeply understand the challenges faced by communities in remote regions and the\r\nHill Country, where frequent grid failures and unstable power can disrupt daily\r\nlife and livelihoods.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">We believe that\r\nlow-income communities should not be left behind in the transition to modern\r\ntechnology. To bridge this gap, we specialize in providing:<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n</p><ul style=\"margin-top: 0in;\">\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Affordable DIY Energy Systems: We\r\n     offer cost-effective, high-quality components that allow families and\r\n     small businesses to build their own reliable backup power solutions.<o:p></o:p></span></li>\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Technical Empowerment: Beyond just\r\n     selling products, we provide the technical support and guidance needed to\r\n     help those with limited access to new technology successfully set up their\r\n     systems.<o:p></o:p></span></li>\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Bridging the Accessibility Gap:\r\n     Whether for retail or wholesale, we make the latest innovations in power\r\n     and electronics available at affordable prices, ensuring that geography\r\n     and income are no longer barriers to progress.<o:p></o:p></span></li>\r\n</ul>', '<ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Solar &amp; Backup Power:</span></b><span lang=\"EN-US\"> A\r\n     complete inventory of MPPT/PWM controllers, Pure Sine Wave and Hybrid\r\n     inverters, and long-life <b>LiFePO4 and Lead Acid batteries</b>.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Power Management &amp; Tools:</span></b><span lang=\"EN-US\">\r\n     Professional battery chargers, BMS modules, and diagnostic tools like\r\n     Multimeters and Battery Testers.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Authorized Shell Lubricants:</span></b><span lang=\"EN-US\">\r\n     Genuine <b>Shell Engine Oils</b> specifically formulated for Motorbikes,\r\n     Three-wheelers, and Cars.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Smart Tech &amp; Lighting:</span></b><span lang=\"EN-US\">\r\n     Energy-saving Solar/DC LED lighting, premium mobile accessories, and the\r\n     latest Smart Watches.<o:p></o:p></span></li>\r\n</ul>', '<ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Remote Accessibility:</span></b><span lang=\"EN-US\"> We bridge the gap for customers who cannot access specialized\r\n     technical shops in the city. We guaranteed every product you purchased\r\n     until you received it and checked for the intended purpose.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Expert Guidance:</span></b><span lang=\"EN-US\"> We understand the technical specs required for DIY backup\r\n     systems in the Sri Lankan climate.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Trust &amp; Authenticity:</span></b><span lang=\"EN-US\"> As a Shell partner, our commitment to quality is\r\n     non-negotiable.<o:p></o:p></span></li>\r\n</ul>', 'Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '/storage/photos/1/logo3.png', '/storage/photos/1/logo1.png', 'Delimach Lanka (Pvt) Ltd,  555/22B, Ranmuthugala, Kadawatha', '+94 77 782 0662', 'delimachlanka@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2026-06-09 12:50:35', NULL, NULL, 'inactive', 350, 80);

-- --------------------------------------------------------

--
-- Table structure for table `shipment_trackings`
--

CREATE TABLE `shipment_trackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(50) NOT NULL,
  `location` varchar(191) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `event_time` timestamp NULL DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipment_trackings`
--

INSERT INTO `shipment_trackings` (`id`, `order_id`, `status`, `location`, `description`, `event_time`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 5, 'ship', 'galle', 'oder', '2026-01-05 19:49:00', 1, '2026-01-05 14:19:50', '2026-01-05 14:19:50');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(191) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sms_logs`
--

CREATE TABLE `sms_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'queued',
  `sent_at` timestamp NULL DEFAULT NULL,
  `provider_response` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_logs`
--

INSERT INTO `sms_logs` (`id`, `order_id`, `phone`, `message`, `provider`, `status`, `sent_at`, `provider_response`, `created_by`, `created_at`, `updated_at`) VALUES
(1, NULL, '0718596742', 'Order placed successfully. Order No: ORD-KSGJNB3482 | Total: 2000 | Payment: cod', NULL, 'queued', NULL, NULL, 2, '2026-01-05 13:50:15', '2026-01-05 13:50:15'),
(2, NULL, '0718596742', 'Order update. Order No: ORD-KSGJNB3482 | Status: delivered', NULL, 'queued', NULL, NULL, 1, '2026-01-05 13:51:55', '2026-01-05 13:51:55'),
(3, 4, '0757207187', 'Order placed successfully. Order No: ORD-KPOX19IZTW | Total: 3100 | Payment: cod', NULL, 'queued', NULL, NULL, 2, '2026-01-05 14:08:16', '2026-01-05 14:08:16'),
(4, 5, '1234567890', 'Order placed successfully. Order No: ORD-7XA8NNFXNC | Total: 1600 | Payment: cod', NULL, 'queued', '2026-01-05 14:17:10', NULL, 2, '2026-01-05 14:17:10', '2026-01-05 14:17:10'),
(5, 5, '1234567890', 'Order update. Order No: ORD-7XA8NNFXNC | Status: new | Tracking: 123456', NULL, 'queued', '2026-01-05 14:28:05', NULL, 1, '2026-01-05 14:28:05', '2026-01-05 14:28:05'),
(6, 5, '1234567890', 'Order update. Order No: ORD-7XA8NNFXNC | Status: new | Courier: DHL | Tracking: 123456', NULL, 'queued', '2026-01-05 14:28:27', NULL, 1, '2026-01-05 14:28:27', '2026-01-05 14:28:27'),
(7, NULL, '1000000000', 'Test SMS Log entry', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', NULL, '2026-01-07 01:36:27', '2026-01-07 01:36:27'),
(8, NULL, '1000000000', 'Test SMS Log entry', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', NULL, '2026-01-07 01:44:34', '2026-01-07 01:44:34'),
(9, 6, '94716853249', 'Order placed successfully. Order No: ORD-OBR7G3LUC3 | Total: 2750 | Payment: cod', 'twilio', 'skipped', '2026-01-07 01:52:32', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-07 01:52:32', '2026-01-07 01:52:32'),
(10, 7, '716853249', 'Order placed successfully. Order No: ORD-XWNRGLAVWG | Total: 1250 | Payment: cod', 'twilio', 'skipped', '2026-01-07 02:03:05', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-07 02:03:05', '2026-01-07 02:03:05'),
(11, 7, '716853249', 'Order update. Order No: ORD-XWNRGLAVWG | Status: process | Courier: DHL | Tracking: 123456', 'twilio', 'skipped', '2026-01-07 02:16:10', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-07 02:16:10', '2026-01-07 02:16:10'),
(12, 8, '762251786', 'Order placed successfully. Order No: ORD-AYVDOFXA93 | Total: 2750 | Payment: cod', 'twilio', 'skipped', '2026-01-07 04:20:17', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-07 04:20:17', '2026-01-07 04:20:17'),
(13, 4, '0757207187', 'Order update. Order No: ORD-KPOX19IZTW | Status: process | Courier: DHL | Tracking: 123456', 'twilio', 'skipped', '2026-01-07 04:41:11', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-07 04:41:11', '2026-01-07 04:41:11'),
(14, 8, '762251786', 'Order update. Order No: ORD-AYVDOFXA93 | Status: delivered | Courier: DHL | Tracking: 111111', 'twilio', 'skipped', '2026-01-07 04:42:25', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-07 04:42:25', '2026-01-07 04:42:25'),
(15, 10, '762251786', 'Order placed successfully. Order No: ORD-88G7IOM5NL | Total: 1250 | Payment: cod', 'twilio', 'skipped', '2026-01-08 12:28:31', 'SMS sending disabled (services.sms.enabled=false).', 3, '2026-01-08 12:28:31', '2026-01-08 12:28:31'),
(16, 10, '762251786', 'Order update. Order No: ORD-88G7IOM5NL | Status: delivered | Courier: DHL | Tracking: 1999', 'twilio', 'skipped', '2026-01-08 12:35:40', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 12:35:40', '2026-01-08 12:35:40'),
(17, 6, '94716853249', 'Order update. Order No: ORD-OBR7G3LUC3 | Status: process | Courier: DHL | Tracking: 111111', 'twilio', 'skipped', '2026-01-08 12:38:44', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 12:38:44', '2026-01-08 12:38:44'),
(18, 9, '762251786', 'Order update. Order No: ORD-O47V7YSMKO | Status: process | Tracking: 123456', 'twilio', 'skipped', '2026-01-08 12:41:44', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 12:41:44', '2026-01-08 12:41:44'),
(19, 9, '762251786', 'Order update. Order No: ORD-O47V7YSMKO | Status: delivered | Courier: FedEx | Tracking: 123456', 'twilio', 'skipped', '2026-01-08 12:42:53', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 12:42:53', '2026-01-08 12:42:53'),
(20, 6, '94716853249', 'Order update. Order No: ORD-OBR7G3LUC3 | Status: delivered | Courier: DHL | Tracking: 111111', 'twilio', 'skipped', '2026-01-08 12:44:07', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 12:44:07', '2026-01-08 12:44:07'),
(21, 7, '716853249', 'Order update. Order No: ORD-XWNRGLAVWG | Status: delivered | Courier: DHL | Tracking: 123456', 'twilio', 'skipped', '2026-01-08 13:12:23', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 13:12:23', '2026-01-08 13:12:23'),
(22, 11, '0725162953', 'Order placed successfully. Order No: ORD-CGTDV0JN5Q | Total: 2750 | Payment: cod', 'twilio', 'skipped', '2026-01-13 00:14:31', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-13 00:14:31', '2026-01-13 00:14:31'),
(23, 12, '0715263859', 'Order placed successfully. Order No: ORD-DUWHQMNQUO | Total: 2750 | Payment: cod', 'twilio', 'skipped', '2026-01-13 11:06:35', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-13 11:06:35', '2026-01-13 11:06:35'),
(24, NULL, '0756285966', 'Order placed successfully. Order No: ORD-NWTNGHEASZ | Total: 1250 | Payment: cod', 'twilio', 'skipped', '2026-01-13 11:17:32', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-13 11:17:32', '2026-01-13 11:17:32'),
(25, 14, '0748596523', 'Order placed successfully. Order No: ORD-XU8AOFCHAQ | Total: 1250 | Payment: cod', 'twilio', 'skipped', '2026-01-13 11:19:07', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-13 11:19:07', '2026-01-13 11:19:07'),
(26, 15, '0758695866', 'Order placed successfully. Order No: ORD-VK1M6PXD0L | Total: 5250 | Payment: cod', 'twilio', 'skipped', '2026-01-13 11:26:58', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-13 11:26:58', '2026-01-13 11:26:58'),
(27, 16, '1234567890', 'Order placed successfully. Order No: ORD-CCOTZCX2CO | Total: 5250 | Payment: cod', 'twilio', 'skipped', '2026-01-18 14:38:31', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-18 14:38:31', '2026-01-18 14:38:31'),
(28, 11, '0725162953', 'Order update. Order No: ORD-CGTDV0JN5Q | Status: process', 'twilio', 'skipped', '2026-01-23 04:44:28', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-23 04:44:28', '2026-01-23 04:44:28'),
(29, 17, '0757207187', 'Order placed successfully. Order No: ORD-3HMK7L5JGM | Total: 11500 | Payment: cod', 'twilio', 'skipped', '2026-01-27 12:19:32', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-27 12:19:32', '2026-01-27 12:19:32'),
(30, 18, '0725162953', 'Order placed successfully. Order No: ORD-FTTVZSNRLS | Total: 1100 | Payment: cod', 'twilio', 'skipped', '2026-01-27 12:20:55', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-27 12:20:55', '2026-01-27 12:20:55'),
(31, 19, '0757207187', 'Order placed successfully. Order No: ORD-YTV8DLFXVI | Total: 1100 | Payment: cod', 'twilio', 'skipped', '2026-01-27 12:27:30', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-01-27 12:27:30', '2026-01-27 12:27:30'),
(32, 20, '1234567890', 'Order placed successfully. Order No: ORD-EJDZA4H23O | Total: 39200 | Payment: paypal', 'twilio', 'skipped', '2026-02-13 11:54:31', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-02-13 11:54:31', '2026-02-13 11:54:31'),
(33, 21, '0757207187', 'Order placed successfully. Order No: ORD-QOXOFU5VXM | Total: 4660 | Payment: cod', 'twilio', 'skipped', '2026-02-13 12:02:35', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-02-13 12:02:35', '2026-02-13 12:02:35'),
(34, 22, '0714859845', 'Order placed successfully. Order No: ORD-FXNOVMKYPD | Total: 1100 | Payment: cod', 'twilio', 'skipped', '2026-02-27 00:33:17', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-02-27 00:33:17', '2026-02-27 00:33:17'),
(35, 22, '0714859845', 'Order update. Order No: ORD-FXNOVMKYPD | Status: new', 'twilio', 'skipped', '2026-02-27 00:37:48', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-02-27 00:37:48', '2026-02-27 00:37:48'),
(36, 23, '0714586955', 'Order placed successfully. Order No: ORD-A0001 | Total: 1500 | Payment: cod', 'twilio', 'skipped', '2026-02-27 00:52:46', 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-02-27 00:52:46', '2026-02-27 00:52:46'),
(37, 24, '0725126389', 'Order placed successfully. Order No: ORD-A0002 | Total: 1500 | Payment: cod', 'twilio', 'skipped', '2026-02-27 01:23:17', 'SMS sending disabled (services.sms.enabled=false).', 9, '2026-02-27 01:23:17', '2026-02-27 01:23:17'),
(38, 24, '0725126389', 'Order update. Order No: ORD-A0002 | Status: process | Tracking: TRN-A0002', 'twilio', 'skipped', '2026-02-27 01:24:29', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-02-27 01:24:29', '2026-02-27 01:24:29'),
(39, 4, '0757207187', 'Order update. Order No: ORD-KPOX19IZTW | Status: process | Courier: DHL | Tracking: 123456', 'twilio', 'skipped', '2026-02-27 02:53:17', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-02-27 02:53:17', '2026-02-27 02:53:17'),
(40, 2, '0754869523', 'Order update. Order No: ORD-5WISLR4RIO | Status: process', 'twilio', 'skipped', '2026-02-27 02:54:19', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-02-27 02:54:19', '2026-02-27 02:54:19'),
(41, 20, '1234567890', 'Order update. Order No: ORD-EJDZA4H23O | Status: pending', 'twilio', 'skipped', '2026-02-27 02:54:56', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-02-27 02:54:56', '2026-02-27 02:54:56'),
(42, 25, '0762251786', 'Order placed successfully. Order No: ORD-A0003 | Total: 2500 | Payment: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-03-13 00:19:32', '2026-03-13 00:19:32'),
(43, 26, '0762251786', 'Order placed successfully. Order No: ORD-A0004 | Total: 7500 | Payment: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-03-13 00:27:20', '2026-03-13 00:27:20'),
(44, 27, '0762251786', 'Order placed successfully. Order No: ORD-A0005 | Total: 2750 | Payment: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 2, '2026-03-13 00:37:50', '2026-03-13 00:37:50'),
(45, NULL, '\\+94716853249\\', '\\Test SMS from Laravel (Textit.biz)\"', 'textit', 'sent', '2026-03-13 01:01:59', 'OK:1-MSG_GSM-36 Uploaded_Successfully', NULL, '2026-03-13 01:01:48', '2026-03-13 01:01:48'),
(46, 28, '0716853249', 'Order placed successfully. Order No: ORD-A0006 | Total: 8000 | Payment: cod', 'textit', 'sent', '2026-03-13 01:04:38', 'OK:1-MSG_GSM-75 Uploaded_Successfully', 2, '2026-03-13 01:04:31', '2026-03-13 01:04:31'),
(47, 28, '0716853249', 'Order delivered. Order No: ORD-A0006 | Status: delivered | Tracking: TRN-A0006', 'textit', 'sent', '2026-03-13 01:09:26', 'OK:1-MSG_GSM-78 Uploaded_Successfully', 1, '2026-03-13 01:09:18', '2026-03-13 01:09:18'),
(48, 29, '0771519979', 'Order placed successfully. Order No: ORD-A0007 | Total: 1300 | Payment: cod', 'textit', 'sent', '2026-03-13 01:14:39', 'OK:1-MSG_GSM-75 Uploaded_Successfully', 2, '2026-03-13 01:14:34', '2026-03-13 01:14:34'),
(49, 30, '0771519979', 'Order placed successfully. Name: Kavinda Rupasingha | Items: Arduino UNO | Order No: ORD-A0008 | Total Price: LKR 950 | Payment: cod', 'textit.biz', 'failed', '2026-03-13 01:22:11', 'Textit send failed (HTTP 402): ', 2, '2026-03-13 01:22:05', '2026-03-13 01:22:05'),
(50, 31, '0762251786', 'Order placed successfully. Name: kasun chathuranga | Items: Data Cable | Order No: ORD-A0009 | Total Price: LKR 340 | Payment: cod', 'textit.biz', 'failed', '2026-03-16 10:56:21', 'Textit send failed (HTTP 402): ', 2, '2026-03-16 10:56:13', '2026-03-16 10:56:13'),
(51, 32, '0757207187', 'Order placed successfully. Name: User disanayaka | Items: Solar Charger Controller PWM 100A, Multimeter SMD tester | Order No: ORD-A0010 | Total Price: LKR 15150 | Payment: cod', 'textit.biz', 'failed', '2026-04-08 12:09:22', 'Textit send failed (HTTP 402): ', 2, '2026-04-08 12:09:15', '2026-04-08 12:09:15'),
(52, 32, '0757207187', 'Order update. Order No: ORD-A0010 | Status: ship | Tracking: TRN-A0010', 'textit.biz', 'failed', '2026-04-09 06:17:51', 'Textit send failed (HTTP 402): ', 1, '2026-04-09 06:17:38', '2026-04-09 06:17:38'),
(53, 33, '0716853249', 'Order placed successfully. Name: kasun mahesh | Items: Multimeter SMD tester | Order No: ORD-A0011 | Total Price: LKR 5250 | Payment: cod', 'textit.biz', 'failed', '2026-04-12 10:34:54', 'Textit send failed (HTTP 402): ', 10, '2026-04-12 10:34:47', '2026-04-12 10:34:47'),
(54, 34, '0716853249', 'Order placed successfully. Name: kasun mahesh | Items: Multimeter SMD tester | Order No: ORD-A0012 | Total Price: LKR 5250 | Payment: cod', 'textit.biz', 'failed', '2026-04-12 10:36:39', 'Textit send failed (HTTP 402): ', 10, '2026-04-12 10:36:35', '2026-04-12 10:36:35'),
(55, 33, '0716853249', 'Order delivered. Order No: ORD-A0011 | Status: delivered | Courier Tracking: 12568597486', 'textit', 'sent', '2026-05-04 11:31:07', 'OK:1-MSG_GSM-88 Uploaded_Successfully', 1, '2026-05-04 11:30:54', '2026-05-04 11:30:54'),
(56, 29, '0771519979', 'Dear kavinda, payment received for your order. Items: Multimeter | Order No: ORD-A0007 | Payment Status: PAID | Total: 1300 | Method: COD', 'textit', 'sent', '2026-05-04 11:50:00', 'OK:1-MSG_GSM-137 Uploaded_Successfully', 1, '2026-05-04 11:49:52', '2026-05-04 11:49:52'),
(57, 29, '0771519979', 'Dear kavinda, Order delivered. Items: Multimeter | Order No: ORD-A0007 | Status: delivered | Payment Status: PAID | Courier: DHL | Courier Tracking: 125685974152', 'textit', 'sent', '2026-05-04 11:50:04', 'OK:1-MSG_GSM-161 Uploaded_Successfully', 1, '2026-05-04 11:50:01', '2026-05-04 11:50:01'),
(58, 31, '0762251786', 'Dear kasun, payment received for your order. Items: Data Cable | Order No: ORD-A0009 | Payment Status: PAID | Total: 340 | Method: COD', 'textit', 'sent', '2026-05-04 11:50:43', 'OK:1-MSG_GSM-134 Uploaded_Successfully', 1, '2026-05-04 11:50:36', '2026-05-04 11:50:36'),
(59, 31, '0762251786', 'Dear kasun, Order delivered. Items: Data Cable | Order No: ORD-A0009 | Status: delivered | Payment Status: PAID | Courier: DHL | Courier Tracking: 1478523697895', 'textit', 'sent', '2026-05-04 11:50:48', 'OK:1-MSG_GSM-160 Uploaded_Successfully', 1, '2026-05-04 11:50:44', '2026-05-04 11:50:44'),
(60, 35, '0787675866', 'Dear Sithija, your order placed successfully. Items: Multimeter SMD tester, Clamp meter, Multimeter, phone charger | Order No: ORD-A0013 | Status: new | Payment Status: UNPAID | Total Price: LKR 19100 | Payment Method: cod', 'textit', 'sent', '2026-05-04 12:33:00', 'OK:1-MSG_GSM-222 Uploaded_Successfully', 2, '2026-05-04 12:32:54', '2026-05-04 12:32:54'),
(61, 35, '0787675866', 'Dear Sithija, Order delivered. Items: Multimeter SMD tester, Clamp meter, Multimeter, phone charger | Order No: ORD-A0013 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 8235567690', 'textit', 'sent', '2026-05-05 01:09:26', 'OK:1-MSG_GSM-212 Uploaded_Successfully', 1, '2026-05-05 01:09:13', '2026-05-05 01:09:13'),
(62, 36, '0767385049', 'Dear Narada, your order placed successfully. Items: Multimeter, Solar Charger Controller PWM 10A | Order No: ORD-A0014 | Status: new | Payment Status: UNPAID | Total Price: LKR 9000 | Payment Method: cod', 'textit', 'sent', '2026-05-05 09:46:50', 'OK:1-MSG_GSM-203 Uploaded_Successfully', 2, '2026-05-05 09:46:44', '2026-05-05 09:46:44'),
(63, 36, '0767385049', 'Dear Narada, Order delivered. Items: Multimeter, Solar Charger Controller PWM 10A | Order No: ORD-A0014 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 4589678495', 'textit', 'sent', '2026-05-05 09:47:56', 'OK:1-MSG_GSM-194 Uploaded_Successfully', 1, '2026-05-05 09:47:47', '2026-05-05 09:47:47'),
(64, 27, '0762251786', 'Dear kasun, Order delivered. Items: Clamp meter | Order No: ORD-A0005 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 125685974864', 'textit', 'sent', '2026-05-08 12:40:43', 'OK:1-MSG_GSM-162 Uploaded_Successfully', 1, '2026-05-08 12:40:25', '2026-05-08 12:40:25'),
(65, 27, '0762251786', 'Dear kasun, payment received for your order. Items: Clamp meter | Order No: ORD-A0005 | Payment Status: PAID | Total: 2750 | Method: COD', 'textit', 'sent', '2026-05-08 12:42:16', 'OK:1-MSG_GSM-136 Uploaded_Successfully', 1, '2026-05-08 12:42:07', '2026-05-08 12:42:07'),
(66, 27, '0762251786', 'Dear kasun, Order update. Items: Clamp meter | Order No: ORD-A0005 | Status: delivered | Payment Status: PAID | Courier: DHL | Courier Tracking: 125685974864', 'textit', 'sent', '2026-05-08 12:42:22', 'OK:1-MSG_GSM-157 Uploaded_Successfully', 1, '2026-05-08 12:42:17', '2026-05-08 12:42:17'),
(67, 27, '0762251786', 'Dear kasun, Order update. Items: Clamp meter | Order No: ORD-A0005 | Status: returned | Payment Status: UNPAID | Courier: DHL', 'textit', 'sent', '2026-05-08 12:44:17', 'OK:1-MSG_GSM-125 Uploaded_Successfully', 1, '2026-05-08 12:44:08', '2026-05-08 12:44:08'),
(68, 37, '0771519979', 'Dear Kavinda, your order placed successfully. Items: hello | Order No: ORD-A0015 | Status: new | Payment Status: UNPAID | Total Price: LKR 2540 | Payment Method: cod', 'textit', 'sent', '2026-05-08 13:07:13', 'OK:1-MSG_GSM-165 Uploaded_Successfully', NULL, '2026-05-08 13:07:08', '2026-05-08 13:07:08'),
(69, 37, '0771519979', 'Dear Kavinda, Order delivered. Items: hello | Order No: ORD-A0015 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 123456789', 'textit', 'sent', '2026-05-08 13:10:38', 'OK:1-MSG_GSM-155 Uploaded_Successfully', 1, '2026-05-08 13:10:31', '2026-05-08 13:10:31'),
(70, 37, '0771519979', 'Dear Kavinda, Order update. Items: hello | Order No: ORD-A0015 | Status: returned | Payment Status: UNPAID | Courier: DHL', 'textit', 'sent', '2026-05-08 13:13:41', 'OK:1-MSG_GSM-121 Uploaded_Successfully', 1, '2026-05-08 13:13:34', '2026-05-08 13:13:34'),
(71, NULL, '0771519979', 'Dear Kavinda, your order placed successfully. Items: hello | Order No: ORD-A0016 | Status: new | Payment Status: UNPAID | Total Price: LKR 3020 | Payment Method: cod', 'textit', 'sent', '2026-05-08 23:25:42', 'OK:1-MSG_GSM-165 Uploaded_Successfully', NULL, '2026-05-08 23:25:37', '2026-05-08 23:25:37'),
(72, NULL, '0771519979', 'Dear Kavinda, Order delivered. Items: hello | Order No: ORD-A0016 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 1234567890', 'textit', 'sent', '2026-05-08 23:27:15', 'OK:1-MSG_GSM-156 Uploaded_Successfully', 1, '2026-05-08 23:27:07', '2026-05-08 23:27:07'),
(73, NULL, '0771519979', 'Dear Kavinda, Order update. Items: hello | Order No: ORD-A0016 | Status: returned | Payment Status: UNPAID | Courier: DHL', 'textit', 'sent', '2026-05-08 23:28:49', 'OK:1-MSG_GSM-121 Uploaded_Successfully', 1, '2026-05-08 23:28:42', '2026-05-08 23:28:42'),
(74, 39, '0771519979', 'Dear Kavinda, your order placed successfully. Items: hello | Order No: ORD-A0016 | Status: new | Payment Status: UNPAID | Total Price: LKR 870 | Payment Method: cod', 'textit', 'sent', '2026-05-09 00:46:17', 'OK:1-MSG_GSM-164 Uploaded_Successfully', 15, '2026-05-09 00:46:11', '2026-05-09 00:46:11'),
(75, 39, '0771519979', 'Dear Kavinda, Order delivered. Items: hello | Order No: ORD-A0016 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 12568597486490', 'textit', 'sent', '2026-05-09 00:48:44', 'OK:1-MSG_GSM-160 Uploaded_Successfully', 1, '2026-05-09 00:48:37', '2026-05-09 00:48:37'),
(76, 39, '0771519979', 'Dear Kavinda, Order update. Items: hello | Order No: ORD-A0016 | Status: returned | Payment Status: UNPAID | Courier: DHL', 'textit', 'sent', '2026-05-09 00:50:43', 'OK:1-MSG_GSM-121 Uploaded_Successfully', 1, '2026-05-09 00:50:37', '2026-05-09 00:50:37'),
(77, 42, '0760807461', 'Dear Kasun, your order placed successfully. Items: Multimeter SMD tester, Solar Charger Controller PWM 10A, Solar Charger Controller PWM 30A, hello | Order No: ORD-A0019 | Status: new | Payment Status: UNPAID | Total Price: LKR 9250 | Payment Method: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 16, '2026-06-09 12:12:45', '2026-06-09 12:12:45'),
(78, 43, '0760807461', 'Dear Kasun, your order placed successfully. Items: Clamp meter, Multimeter | Order No: ORD-A0020 | Status: new | Payment Status: UNPAID | Total Price: LKR 12750 | Payment Method: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 16, '2026-06-09 12:14:16', '2026-06-09 12:14:16'),
(79, 24, '0725126389', 'Dear pethum, Order delivered. Items: Solar Charger Controller PWM 10A | Order No: ORD-A0002 | Status: delivered | Payment Status: UNPAID | Courier: DHL | Courier Tracking: 1478523697895', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 8, '2026-06-09 13:29:34', '2026-06-09 13:29:34'),
(80, 24, '0725126389', 'Dear pethum, Order update. Items: Solar Charger Controller PWM 10A | Order No: ORD-A0002 | Status: delivered | Payment Status: UNPAID | Courier: Kuubiyo | Courier Tracking: 1478523697000', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 8, '2026-06-09 13:30:08', '2026-06-09 13:30:08'),
(81, 44, '0760807461', 'Dear Kasun, your order placed successfully. Items: Apple phone charger, Arduino UNO | Order No: ORD-A0021 | Status: new | Payment Status: UNPAID | Total Price: LKR 2300 | Payment Method: cod', 'twilio', 'skipped', NULL, 'SMS sending disabled (services.sms.enabled=false).', 16, '2026-06-09 14:00:21', '2026-06-09 14:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(50) DEFAULT '',
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `address3` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user',
  `customer_type` varchar(30) NOT NULL DEFAULT 'retail',
  `is_sales_staff` tinyint(1) NOT NULL DEFAULT 0,
  `provider` varchar(191) DEFAULT NULL,
  `provider_id` varchar(191) DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `company_name`, `email`, `phone`, `address1`, `address2`, `address3`, `email_verified_at`, `password`, `photo`, `role`, `customer_type`, `is_sales_staff`, `provider`, `provider_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL, NULL, 'admin@gmail.com', '', NULL, NULL, NULL, NULL, '$2y$10$.zvMJKXSR7qkyE62Po3Yuu2iOt9Vr6s6XyAvkMFyRzKh6p2Y9IAYq', '/storage/profiles/ZJn2rDzCZLX1PaElJXZ08zVxi2Vt5PqSCcTD13Mu.png', 'admin', 'retail', 0, NULL, NULL, 'active', NULL, NULL, '2026-06-09 12:56:57'),
(2, 'User', NULL, NULL, NULL, 'user@gmail.com', '', NULL, NULL, NULL, NULL, '$2y$10$3fj7rTgZPZwXG1qS5wxeY.Xiy10Ztm1N9990Ps829F.OsNsBhTl9y', '/storage/profiles/qapgKdHE630JTKzWqVQQj1cmnoFYVV1PYuR6V228.jpg', 'user', 'retail', 0, NULL, NULL, 'active', NULL, NULL, '2026-02-02 00:09:59'),
(3, 'kasun chathuranga', NULL, NULL, NULL, 'kchathuranga496@gmail.com', '', NULL, NULL, NULL, NULL, '$2y$10$Q8719bi0H0jhwdAJQnygMOGRShUpF.A9T3LpxH.GZsQFkhLyLTopi', NULL, 'user', 'retail', 0, NULL, NULL, 'active', 'b2FD5tA08wY1XIBnX8gnuaJtLV3wKBYgEjQbbc455DWcWR6s9EdF2fDKQlcL', '2026-01-08 12:23:02', '2026-01-08 13:59:16'),
(4, 'kasun madushan', NULL, NULL, NULL, 'kchathuranga49@gmail.com', '', NULL, NULL, NULL, NULL, '$2y$10$.7ENflO67m2U7dN2FWpeNuCIHdbOQVhpWHW6UXV2YurTRo1FfKlkq', '/storage/photos/1/123.jpeg', 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-01-23 04:56:26', '2026-01-23 04:56:26'),
(5, 'Dasun Manel', NULL, NULL, NULL, 'dasun123@gmail.com', '0701234567', NULL, NULL, NULL, NULL, '$2y$10$Nmhowkr8PYI6OjX4rZMkxeH3JKUxW/Z3utVCaDmLVhMQxOSr1V8hK', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-01-31 01:48:59', '2026-01-31 01:48:59'),
(6, 'Asela Bandara', NULL, NULL, NULL, 'asela123@gmail.com', '0771234567', NULL, NULL, NULL, NULL, '$2y$10$WBaDLpfaXz3mb0mzyCmKku9THhx0PR9FbLyUu.KMqXVvK3BSn0k/i', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-01-31 04:40:40', '2026-01-31 04:40:40'),
(7, 'kalpa sahan', NULL, NULL, NULL, 'kalpa123@Gmail.com', '0741234567', NULL, NULL, NULL, NULL, '$2y$10$D2uIC39plOsbalkL6JLcp.JdqgFquFHxdUYz2oMruMXQSNjPrI4GK', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-01-31 04:42:02', '2026-01-31 04:42:02'),
(8, 'kasun chathuranga', NULL, NULL, NULL, 'sales@gmail.com', '', NULL, NULL, NULL, NULL, '$2y$10$jNeyoXoXg.fkz6M1j89VZ.lNDuVsNIKBDX4JOcYGuQqdj4fdhCLOK', NULL, 'sales_admin', 'retail', 1, NULL, NULL, 'active', NULL, '2026-02-27 00:23:39', '2026-02-27 00:23:39'),
(9, 'pethum Nissanka', 'pethum', 'Nissanka', NULL, 'pethum@gmail.com', '0725126389', 'nagoda', 'galla', 'kalutara', NULL, '$2y$10$zQX4CAfFq.tMTDbkfyhYDuw8KpEDyP/LO7ZQEZOhBrBs7KeJmZm36', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-02-27 01:21:13', '2026-02-27 01:21:13'),
(10, 'kasun mahesh', 'kasun', 'mahesh', NULL, 'kasufunny97@gmail.com', '0716853249', 'kasun mahesh', 'pallegama', 'kolawenigama', NULL, '$2y$10$tztiyNMMNff788iNR9B/c.TM2QLstfiSHU0wIasujq2VeaRN5e0p.', '/storage/profiles/sKsIKUdhdINR1eDWPx7jnJcfi0KF0B6R0VFzbNEC.png', 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-04-12 10:31:19', '2026-04-12 10:41:48'),
(11, 'Kavinda anuhas', NULL, NULL, NULL, 'kavinda@gmail.com', '0715269845', NULL, NULL, NULL, NULL, '$2y$10$XzSR/TnkHEEPq8UjDUNix.KBgj8H0Q6Y8syNHrIO.RkSQn/u5e3qC', '/storage/profiles/gipQMH0o5oAPcGFVbDOhLgdL7ZSAJ58ai6i26GQU.png', 'sales_admin', 'retail', 1, NULL, NULL, 'active', NULL, '2026-04-12 10:58:48', '2026-04-12 10:58:48'),
(14, 'anjana gihan', 'anjana', 'gihan', NULL, 'anjana123@gmail.com', '0716853249', 'mullegama', 'millnnum city', 'athurugiriya', NULL, '$2y$10$qyMUfRHWFARqYTDRmhjv/uvs5KR51N/U9SPt0GvcZCvNspmZbNOHC', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-05-09 00:42:59', '2026-05-09 00:42:59'),
(15, 'Kavinda Rupasingha', 'Kavinda', 'Rupasingha', NULL, 'kavindarupasingha78@gmail.com', '0771519979', 'pallekele', 'Naththaramotha', 'kadugannawa', NULL, '$2y$10$8VMUrolm3salCjDuPMVdb.cgP5B5uFQQovL0JymVHvr8xxUQNTZMK', NULL, 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-05-09 00:44:50', '2026-05-09 00:44:50'),
(16, 'Kasun Maduranga silwa', 'Kasun', 'Maduranga', NULL, 'kasunmaduranga123@gmail.com', '0760807461', '132/2', 'Mullegama', 'Homagama', NULL, '$2y$10$IGMcRCtRNmMPMMNTCb5q0.XEHjXCE009STIe/n7M7CdV0JzlRO5ZO', '/storage/profiles/x6K4I9LKhyvmMssB1MSXroqHGIPcahlZxBzIJ3Ga.png', 'user', 'retail', 0, NULL, NULL, 'active', NULL, '2026-06-08 23:27:24', '2026-06-09 14:23:58');

-- --------------------------------------------------------

--
-- Table structure for table `wholesale_requests`
--

CREATE TABLE `wholesale_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `company` varchar(191) DEFAULT NULL,
  `quantity` int(10) UNSIGNED DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` varchar(191) NOT NULL DEFAULT 'new',
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wholesale_requests`
--

INSERT INTO `wholesale_requests` (`id`, `user_id`, `product_id`, `name`, `email`, `phone`, `company`, `quantity`, `message`, `status`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 2, 35, 'kasun mahesh', 'kchathuranga496@gmail.com', '0757207187', 'ABC', 10, 'ghsfdkgkdjgsjhdgjgjgd hjdkd', 'contacted', '127.0.0.1', '2026-01-18 11:07:49', '2026-01-18 11:24:23'),
(2, 2, 47, 'kasun chathuranga', 'kchathuranga496@gmail.com', '0725162953', 'ABC', 10, 'dsdasasd ad', 'contacted', '127.0.0.1', '2026-01-18 11:32:06', '2026-01-18 11:35:47'),
(3, 2, 6, 'kasun chathuranga', 'kchathuranga496@gmail.com', '0757207187', 'ABC', 5, 'rfghnm', 'closed', '127.0.0.1', '2026-01-18 11:52:15', '2026-02-02 05:48:55');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `cart_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `product_id`, `cart_id`, `user_id`, `price`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(2, 27, NULL, 2, 1100.00, 1, 1100.00, '2026-01-27 12:32:53', '2026-01-27 12:32:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banners_slug_unique` (`slug`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_slug_unique` (`slug`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_order_id_foreign` (`order_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`),
  ADD KEY `categories_added_by_foreign` (`added_by`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `couriers`
--
ALTER TABLE `couriers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ledger_entries_created_by_foreign` (`created_by`),
  ADD KEY `ledger_entries_reference_type_reference_id_index` (`reference_type`,`reference_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_shipping_id_foreign` (`shipping_id`),
  ADD KEY `orders_sales_staff_id_foreign` (`sales_staff_id`),
  ADD KEY `orders_courier_id_foreign` (`courier_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_post_cat_id_foreign` (`post_cat_id`),
  ADD KEY `posts_post_tag_id_foreign` (`post_tag_id`),
  ADD KEY `posts_added_by_foreign` (`added_by`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_comments_user_id_foreign` (`user_id`),
  ADD KEY `post_comments_post_id_foreign` (`post_id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_tags_slug_unique` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_cat_id_foreign` (`cat_id`),
  ADD KEY `products_child_cat_id_foreign` (`child_cat_id`),
  ADD KEY `products_courier_id_foreign` (`courier_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `sales_admin_product_stocks`
--
ALTER TABLE `sales_admin_product_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_admin_product_stocks_sales_admin_id_product_id_unique` (`sales_admin_id`,`product_id`),
  ADD KEY `sales_admin_product_stocks_product_id_foreign` (`product_id`);

--
-- Indexes for table `sales_admin_stock_transfers`
--
ALTER TABLE `sales_admin_stock_transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sales_admin_stock_transfers_sales_admin_id_foreign` (`sales_admin_id`),
  ADD KEY `sales_admin_stock_transfers_product_id_foreign` (`product_id`),
  ADD KEY `sales_admin_stock_transfers_created_by_foreign` (`created_by`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment_trackings`
--
ALTER TABLE `shipment_trackings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shipment_trackings_order_id_foreign` (`order_id`),
  ADD KEY `shipment_trackings_created_by_foreign` (`created_by`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sms_logs_order_id_foreign` (`order_id`),
  ADD KEY `sms_logs_created_by_foreign` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wholesale_requests`
--
ALTER TABLE `wholesale_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wholesale_requests_user_id_foreign` (`user_id`),
  ADD KEY `wholesale_requests_product_id_foreign` (`product_id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_cart_id_foreign` (`cart_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `couriers`
--
ALTER TABLE `couriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_admin_product_stocks`
--
ALTER TABLE `sales_admin_product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_admin_stock_transfers`
--
ALTER TABLE `sales_admin_stock_transfers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shipment_trackings`
--
ALTER TABLE `shipment_trackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_logs`
--
ALTER TABLE `sms_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `wholesale_requests`
--
ALTER TABLE `wholesale_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `ledger_entries`
--
ALTER TABLE `ledger_entries`
  ADD CONSTRAINT `ledger_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_sales_staff_id_foreign` FOREIGN KEY (`sales_staff_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_shipping_id_foreign` FOREIGN KEY (`shipping_id`) REFERENCES `shippings` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_cat_id_foreign` FOREIGN KEY (`post_cat_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_post_tag_id_foreign` FOREIGN KEY (`post_tag_id`) REFERENCES `post_tags` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_cat_id_foreign` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_child_cat_id_foreign` FOREIGN KEY (`child_cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `products_courier_id_foreign` FOREIGN KEY (`courier_id`) REFERENCES `couriers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_admin_product_stocks`
--
ALTER TABLE `sales_admin_product_stocks`
  ADD CONSTRAINT `sales_admin_product_stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_admin_product_stocks_sales_admin_id_foreign` FOREIGN KEY (`sales_admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sales_admin_stock_transfers`
--
ALTER TABLE `sales_admin_stock_transfers`
  ADD CONSTRAINT `sales_admin_stock_transfers_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sales_admin_stock_transfers_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_admin_stock_transfers_sales_admin_id_foreign` FOREIGN KEY (`sales_admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shipment_trackings`
--
ALTER TABLE `shipment_trackings`
  ADD CONSTRAINT `shipment_trackings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `shipment_trackings_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sms_logs`
--
ALTER TABLE `sms_logs`
  ADD CONSTRAINT `sms_logs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `sms_logs_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wholesale_requests`
--
ALTER TABLE `wholesale_requests`
  ADD CONSTRAINT `wholesale_requests_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wholesale_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_cart_id_foreign` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
