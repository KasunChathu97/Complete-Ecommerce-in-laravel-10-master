-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2026 at 04:52 AM
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `order_id`, `user_id`, `price`, `status`, `quantity`, `amount`, `created_at`, `updated_at`) VALUES
(6, 47, 6, 2, 2750.00, 'new', 1, 2750.00, '2026-01-07 01:51:01', '2026-01-07 01:52:33'),
(7, 46, 7, 2, 1250.00, 'new', 1, 1250.00, '2026-01-07 02:02:01', '2026-01-07 02:03:05'),
(8, 47, 8, 2, 2750.00, 'new', 1, 2750.00, '2026-01-07 04:09:39', '2026-01-07 04:20:22'),
(9, 46, 10, 3, 1250.00, 'new', 1, 1250.00, '2026-01-08 12:24:39', '2026-01-08 12:28:35');

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
(33, '2026_01_08_120000_add_why_choose_delimach_lanka_to_settings_table', 7);

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
('0ccd9d24-1e67-479d-920b-a855adaf5793', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/6\",\"fas\":\"fa-file-alt\"}', '2026-01-07 02:05:11', '2026-01-07 01:52:31', '2026-01-07 02:05:11'),
('16e502ad-93b7-4212-8d47-419c6b4337ab', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/10\",\"fas\":\"fa-file-alt\"}', '2026-01-08 22:58:39', '2026-01-08 12:28:24', '2026-01-08 22:58:39'),
('1e38e383-b1d6-4561-8ab7-b8263a2cd860', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/4\",\"fas\":\"fa-file-alt\"}', '2026-01-06 01:04:58', '2026-01-05 14:08:16', '2026-01-06 01:04:58'),
('216060cd-1c5f-48a6-b4d2-579f94648d9a', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/3\",\"fas\":\"fa-file-alt\"}', '2026-01-05 13:51:11', '2026-01-05 13:50:14', '2026-01-05 13:51:11'),
('39a34c34-8487-4316-9b1d-a6a179cd15f0', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/9\",\"fas\":\"fa-file-alt\"}', '2026-01-08 22:58:44', '2026-01-08 12:26:34', '2026-01-08 22:58:44'),
('3a6db4ed-2bb8-42c8-8f57-9f600cafb7fa', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/solar-charger-controller\",\"fas\":\"fa-star\"}', '2026-01-06 01:04:30', '2026-01-06 01:00:52', '2026-01-06 01:04:30'),
('6b9fde25-5990-4d6a-812c-62a3fd64236b', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/8\",\"fas\":\"fa-file-alt\"}', '2026-01-07 04:21:50', '2026-01-07 04:20:16', '2026-01-07 04:21:50'),
('7a8fd15a-1f8d-4efd-b5ac-8f2dd4f69412', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/battery-tester\",\"fas\":\"fa-star\"}', '2026-01-07 02:05:40', '2026-01-07 02:05:32', '2026-01-07 02:05:40'),
('7d073d79-94a8-470d-86aa-9dad07766b22', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/1\",\"fas\":\"fa-file-alt\"}', '2026-01-05 12:42:15', '2026-01-05 11:48:16', '2026-01-05 12:42:15'),
('9559329e-79ec-4900-89a0-83dda27f7e47', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/7\",\"fas\":\"fa-file-alt\"}', '2026-01-07 02:05:07', '2026-01-07 02:03:04', '2026-01-07 02:05:07'),
('9fe22a73-70c1-4fd3-9d3c-1aa8167e733c', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New Product Rating!\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/product-detail\\/solar-charger-controller\",\"fas\":\"fa-star\"}', '2026-01-06 01:05:03', '2026-01-06 01:00:38', '2026-01-06 01:05:03'),
('b6b838c3-1f49-4502-ba64-5db8e747c193', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/5\",\"fas\":\"fa-file-alt\"}', '2026-01-06 01:04:52', '2026-01-05 14:17:10', '2026-01-06 01:04:52'),
('c42f7cc6-1fe6-4728-be29-136d6c4ec6be', 'App\\Notifications\\StatusNotification', 'App\\User', 1, '{\"title\":\"New order created\",\"actionURL\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/order\\/2\",\"fas\":\"fa-file-alt\"}', '2026-01-05 13:41:30', '2026-01-05 13:36:56', '2026-01-05 13:41:30');

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
  `courier_name` varchar(100) DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `shipped_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `coupon` double(8,2) DEFAULT NULL,
  `total_amount` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `payment_method` enum('cod','paypal') NOT NULL DEFAULT 'cod',
  `payment_gateway` varchar(50) DEFAULT NULL,
  `payment_reference` varchar(150) DEFAULT NULL,
  `payment_status` enum('paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `status` enum('new','process','delivered','cancel') NOT NULL DEFAULT 'new',
  `order_source` varchar(30) NOT NULL DEFAULT 'online',
  `social_platform` varchar(50) DEFAULT NULL,
  `social_order_ref` varchar(100) DEFAULT NULL,
  `first_name` varchar(191) NOT NULL,
  `last_name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) NOT NULL,
  `country` varchar(191) NOT NULL,
  `post_code` varchar(191) DEFAULT NULL,
  `address1` text NOT NULL,
  `address2` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `offline_receipt_no`, `user_id`, `sales_staff_id`, `sub_total`, `shipping_id`, `courier_name`, `tracking_number`, `shipped_at`, `delivered_at`, `coupon`, `total_amount`, `quantity`, `payment_method`, `payment_gateway`, `payment_reference`, `payment_status`, `status`, `order_source`, `social_platform`, `social_order_ref`, `first_name`, `last_name`, `email`, `phone`, `country`, `post_code`, `address1`, `address2`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'ORD-5WISLR4RIO', NULL, 2, NULL, 2950.00, NULL, NULL, NULL, NULL, NULL, NULL, 2950.00, 1, 'cod', NULL, NULL, 'unpaid', 'process', 'online', NULL, NULL, 'perera', 'son', 'son@gmail.com', '0754869523', 'JO', '85696', 'digana', 'ampitiya', NULL, '2026-01-05 13:36:56', '2026-01-05 13:39:57'),
(3, 'ORD-KSGJNB3482', NULL, 2, NULL, 1500.00, 1, NULL, NULL, NULL, NULL, NULL, 2000.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kavinda', 'disanayaka', 'kavinda@gmail.com', '0718596742', 'AS', '78569', '2/1 Arangala', 'kundasale', NULL, '2026-01-05 13:50:12', '2026-01-05 13:51:55'),
(4, 'ORD-KPOX19IZTW', NULL, 2, NULL, 3100.00, NULL, 'DHL', '123456', NULL, NULL, NULL, 3100.00, 2, 'cod', NULL, NULL, 'unpaid', 'process', 'online', NULL, NULL, 'kasun', 'son', 'kasundeni1997@gmail.com', '0757207187', 'BD', '85696', 'naththaranpotha', 'ampitiya', NULL, '2026-01-05 14:08:15', '2026-01-07 04:41:11'),
(5, 'ORD-7XA8NNFXNC', NULL, 2, NULL, 1600.00, NULL, 'DHL', '123456', NULL, NULL, NULL, 1600.00, 1, 'cod', NULL, NULL, 'unpaid', 'new', 'online', NULL, NULL, 'perera', 'chathuranga', 'eshop@gmail.com', '1234567890', 'BJ', '78569', 'digana', 'kundasale', NULL, '2026-01-05 14:17:09', '2026-01-05 14:28:27'),
(6, 'ORD-OBR7G3LUC3', NULL, 2, NULL, 2750.00, NULL, 'DHL', '111111', NULL, NULL, NULL, 2750.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'son', 'kchathuranga496@gmail.com', '94716853249', 'LK', '78569', 'digana', 'kundasale', NULL, '2026-01-07 01:52:29', '2026-01-08 12:44:07'),
(7, 'ORD-XWNRGLAVWG', NULL, 2, NULL, 1250.00, NULL, 'DHL', '123456', NULL, NULL, NULL, 1250.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'kasun', 'chathuranga', 'kchathuranga496@gmail.com', '716853249', 'LK', '81522', 'digana', 'naththaramotha', NULL, '2026-01-07 02:03:04', '2026-01-08 13:12:23'),
(8, 'ORD-AYVDOFXA93', NULL, 2, NULL, 2750.00, NULL, 'DHL', '111111', NULL, NULL, NULL, 2750.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'perera', 'disanayaka', 'kchathuranga496@gmail.com', '762251786', 'LK', '85696', 'Sanka, pallegama, deniyaya', 'kundasale', NULL, '2026-01-07 04:20:14', '2026-01-07 04:42:25'),
(9, 'ORD-O47V7YSMKO', NULL, 3, NULL, 1250.00, NULL, 'FedEx', '123456', NULL, NULL, NULL, 1250.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Kavinda', 'Sadaruwan', 'kchathuranga496@gmail.com', '762251786', 'LK', '78569', 'arangala', 'ampitiya', NULL, '2026-01-08 12:26:29', '2026-01-08 12:42:53'),
(10, 'ORD-88G7IOM5NL', NULL, 3, NULL, 1250.00, NULL, 'DHL', '1999', NULL, NULL, NULL, 1250.00, 1, 'cod', NULL, NULL, 'unpaid', 'delivered', 'online', NULL, NULL, 'Kavinda', 'Sadaruwan', 'kchathuranga496@gmail.com', '762251786', 'LK', '78569', 'arangala', 'ampitiya', NULL, '2026-01-08 12:28:24', '2026-01-08 12:35:40');

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
  `photo` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 1,
  `size` varchar(191) DEFAULT 'M',
  `condition` enum('default','new','hot') NOT NULL DEFAULT 'default',
  `status` enum('active','inactive') NOT NULL DEFAULT 'inactive',
  `price` double(8,2) NOT NULL,
  `wholesale_price` decimal(12,2) DEFAULT NULL,
  `wholesale_min_qty` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `discount` double(8,2) NOT NULL,
  `is_featured` tinyint(1) NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `child_cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `summary`, `description`, `photo`, `stock`, `size`, `condition`, `status`, `price`, `wholesale_price`, `wholesale_min_qty`, `discount`, `is_featured`, `cat_id`, `child_cat_id`, `brand_id`, `created_at`, `updated_at`) VALUES
(1, 'Solar Charger Controller PWM 10A', 'solar-charger-controller-pwm-10a', '<p>PWM 10A ( Blue )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>10A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>25V</td></tr><tr><td>Power</td><td>120W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/01.jpg', 5, '', 'new', 'active', 1500.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 01:37:29', '2026-01-06 01:37:29'),
(2, 'Solar Charger Controller PWM 30A', 'solar-charger-controller-pwm-30a', '<p>PWM 30A ( Blue )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>30A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>25V</td></tr><tr><td>Power</td><td>360W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/02.jpg', 5, '', 'new', 'active', 1600.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 01:58:24', '2026-01-06 01:59:08'),
(3, 'Solar Charger Controller PWM 20A', 'solar-charger-controller-pwm-20a', '<p>PWM 20A ( Green )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>20A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>260W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/03.png', 5, '', 'new', 'active', 2950.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:01:07', '2026-01-06 02:01:07'),
(4, 'Solar Charger Controller PWM 60A', 'solar-charger-controller-pwm-60a', '<p>PWM 60A ( Green )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>720W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/04.png', 5, '', 'new', 'active', 5750.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:04:25', '2026-01-06 02:04:25'),
(5, 'Solar Charger Controller PWM 20A', 'solar-charger-controller-pwm-20a-2601063735-866', '<p>PWM 20A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>20A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>250W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/05.png', 5, '', 'new', 'active', 3100.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:07:35', '2026-01-06 02:07:35'),
(6, 'Solar Charger Controller PWM 40A', 'solar-charger-controller-pwm-40a', '<p>PWM 40A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>40A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>480W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/06.png', 5, '', 'new', 'active', 4000.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:47:29', '2026-01-06 02:47:29'),
(7, 'Solar Charger Controller PWM 60A', 'solar-charger-controller-pwm-60a-2601062113-746', '<p>PWM 60A ( White )</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V</td></tr><tr><td>PV Voltage</td><td>50V</td></tr><tr><td>Power</td><td>760W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/07.png', 5, '', 'new', 'active', 5750.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:51:13', '2026-01-06 02:51:13'),
(8, 'Solar Charger Controller PWM 100A', 'solar-charger-controller-pwm-100a', '<p>PWM 100A ( Orange )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>100A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>1200W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/08.png', 5, '', 'new', 'active', 9900.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:54:38', '2026-01-06 02:54:38'),
(9, 'Solar Charger Controller MPPT 60A', 'solar-charger-controller-mppt-60a', '<p>MPPT 60A ( Ash )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>760W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/09.jpeg', 5, '', 'new', 'active', 15750.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:56:59', '2026-01-06 02:56:59'),
(10, 'Solar Charger Controller MPPT 100A', 'solar-charger-controller-mppt-100a', '<p>MPPT 100A ( White )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>100A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>100V</td></tr><tr><td>Power</td><td>1300W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/10.png', 5, '', 'new', 'active', 24000.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 02:59:25', '2026-01-06 02:59:25'),
(11, 'Solar Charger Controller MPPT 40A', 'solar-charger-controller-mppt-40a', '<p>MPPT 40A ( Black )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>40A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>80V</td></tr><tr><td>Power</td><td>480W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/11.png', 5, '', 'new', 'active', 15500.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 03:01:12', '2026-01-06 03:01:12'),
(12, 'Solar Charger Controller MPPT 60A', 'solar-charger-controller-mppt-60a-2601063329-553', '<p>MPPT 60A ( Black )</p><p>Lithium, Leaf Battery Support</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Amp</td><td>60A</td></tr><tr><td>Battery Voltage</td><td>12V/24V/48V</td></tr><tr><td>PV Voltage</td><td>80V</td></tr><tr><td>Power</td><td>780W</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/12.png', 5, '', 'new', 'active', 19000.00, NULL, 0, 0.00, 1, 2, NULL, NULL, '2026-01-06 03:03:29', '2026-01-06 03:03:29'),
(13, 'Inverter 700W', 'inverter-700w', '<p>Inverter 700W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>12V</td></tr><tr><td>Output</td><td>230V</td></tr><tr><td>Type</td><td>Modified Sine</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/13.jpg', 5, '', 'new', 'active', 7250.00, NULL, 0, 0.00, 1, 3, NULL, NULL, '2026-01-06 04:02:51', '2026-01-06 04:02:51'),
(14, 'Inverter 3000W', 'inverter-3000w', '<p>Built in MPPT Charger</p><p>Change Over</p><p>Safety Cut off</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>24V</td></tr><tr><td>Output</td><td>230V</td></tr><tr><td>Type</td><td>Hybrid Inverter</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/14.jpg', 5, '', 'new', 'active', 120000.00, NULL, 0, 0.00, 1, 3, NULL, NULL, '2026-01-06 04:05:00', '2026-01-06 04:05:00'),
(15, 'Battery charger', 'battery-charger', '<p>12V, 6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>12V</td></tr><tr><td>Current&nbsp;</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Capacity</td><td>Upto 90Ah</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/15.png', 5, '', 'new', 'active', 4000.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 04:07:52', '2026-01-06 04:23:41'),
(16, 'Battery charger', 'battery-charger-2601063940-802', '<p>12V, 24V, 8 A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>12V/24V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Capacity</td><td>Upto 120Ah</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/16.jpg', 5, '', 'new', 'active', 5800.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 04:09:40', '2026-01-06 04:09:40'),
(17, 'Router Cable', 'router-cable', '<p>DC 5V-12V</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Router Cable&nbsp;</td><td>USB to 12V</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/17.png', 5, '', 'new', 'active', 375.00, NULL, 0, 0.00, 1, 12, NULL, NULL, '2026-01-06 04:18:09', '2026-01-06 04:18:09'),
(18, 'DC Bulb', 'dc-bulb', '<p>12V, 9W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Socket</td><td>E27(Screy Type)</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/18.png', 5, '', 'new', 'active', 390.00, NULL, 0, 0.00, 1, 6, NULL, NULL, '2026-01-06 04:19:27', '2026-01-06 04:23:25'),
(19, 'DC Bulb 12V', 'dc-bulb-12v', '<p>12V, 12W</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Socket</td><td>E27(Screy Type)</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/19.jpg', 5, '', 'new', 'active', 440.00, NULL, 0, 0.00, 1, 6, NULL, NULL, '2026-01-06 05:09:37', '2026-01-06 05:09:37'),
(20, '20W LED Chip', '20w-led-chip', '<p>Direct 230V Power</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Driver</td><td>No Drivers need</td></tr><tr><td>Power</td><td>230V</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/20.png', 5, '', 'new', 'active', 350.00, NULL, 0, 0.00, 1, 6, NULL, NULL, '2026-01-06 05:19:26', '2026-01-06 05:19:26'),
(21, 'Xooxi power bank', 'xooxi-power-bank', '<p>Xooxi power bank 10000Mah</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td><table class=\"table table-bordered\" style=\"width: 1218.4px;\"><tbody><tr><td>Capacity</td><td>10000Mah</td></tr><tr><td>Power</td><td>22.5W</td></tr></tbody></table></td><td><br></td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/21.png', 5, '', 'new', 'active', 1800.00, NULL, 0, 0.00, 1, 7, NULL, NULL, '2026-01-06 05:21:46', '2026-01-06 05:25:55'),
(22, 'VHF Mic', 'vhf-mic', '<p>80m Range</p><p>Less Noice</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Power</td><td>2+1AAA Battery</td></tr><tr><td><br></td><td>High Gain</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/22.png', 5, '', 'new', 'active', 2250.00, NULL, 0, 0.00, 1, 12, NULL, NULL, '2026-01-06 05:24:35', '2026-01-06 05:24:35'),
(23, 'Ear Phone', 'ear-phone', '<p>Ear Phone Wire</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>2.5mm</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/23.png', 5, '', 'new', 'active', 360.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 05:27:25', '2026-01-06 05:27:25'),
(24, 'Moisture Meter', 'moisture-meter', '<p>Coconut Chips</p><p>Grain, Rice, Floor</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Model</td><td>AR991</td></tr><tr><td>Power</td><td>AAA 4 Battery</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/24.png', 5, '', 'new', 'active', 5900.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 05:29:39', '2026-01-06 05:29:39'),
(25, 'Laser Distance Meter', 'laser-distance-meter', '<p>Pocket Size Small</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Charging Port</td><td>Micro USB</td></tr><tr><td>Power</td><td>Rechargable</td></tr><tr><td>Distance</td><td>80m</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/25.png', 5, '', 'new', 'active', 5900.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 05:32:08', '2026-01-06 05:32:08'),
(26, 'PH meter', 'ph-meter', '<p>Water Tester, EC, PH, TDS,&nbsp;<span style=\"font-size: 1rem;\">Salt</span></p>', '<p>5 in one</p>', '/storage/photos/1/Products/26.png', 5, '', 'new', 'active', 4250.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 11:43:17', '2026-01-06 11:43:17'),
(27, 'Buck converter 300W', 'buck-converter-300w', '<p>Step Down</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Power</td><td>300W</td></tr><tr><td>Voltage</td><td>4.40V</td></tr><tr><td>Current</td><td>30A</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/27.jpg', 5, '', 'new', 'active', 1100.00, NULL, 0, 0.00, 1, 7, NULL, NULL, '2026-01-06 11:47:20', '2026-01-06 11:47:20'),
(28, 'Charging control module', 'charging-control-module', '<p>30A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>6-60V adjust</td></tr><tr><td>Current</td><td>30A</td></tr><tr><td>Timer cutoff</td><td>Option</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/28.png', 5, '', 'new', 'active', 1100.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 11:49:20', '2026-01-06 11:49:20'),
(29, 'Battery charger', 'battery-charger-2601062105-555', '<p>14.4V, 1A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>1A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/29.png', 5, '', 'new', 'active', 650.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 11:51:05', '2026-01-06 11:51:05'),
(30, 'Battery charger', 'battery-charger-2601062235-160', '<p>14.4V, 2A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>2A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/30.png', 5, '', 'new', 'active', 750.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 11:52:35', '2026-01-06 11:52:35'),
(31, 'Battery charger', 'battery-charger-2601062357-744', '<p>14.4V, 3A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>2.5mm pin</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/31.png', 5, '', 'new', 'active', 950.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 11:53:57', '2026-01-06 11:53:57'),
(32, 'Battery charger, Spray', 'battery-charger-spray', '<p>14.4V, 3A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Voltage</td><td>14.4V</td></tr><tr><td>Current</td><td>3A</td></tr><tr><td>Cutoff</td><td>Auto</td></tr><tr><td>Output</td><td>13A Female</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/32.png', 5, '', 'new', 'active', 975.00, NULL, 0, 0.00, 1, 5, NULL, NULL, '2026-01-06 11:55:28', '2026-01-06 11:55:28'),
(33, 'HV Meter', 'hv-meter', '<p>12MV</p><p>High Voltage meter</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Capacity</td><td>12000V</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/33.png', 5, '', 'new', 'active', 11500.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 11:59:02', '2026-01-06 11:59:02'),
(34, 'Arduino UNO', 'arduino-uno', '<p>Arduino UNO(Large IC) with cable</p>', NULL, '/storage/photos/1/Products/34.png', 5, '', 'new', 'active', 1500.00, NULL, 0, 0.00, 1, 12, NULL, NULL, '2026-01-06 12:00:23', '2026-01-06 12:00:23'),
(35, 'Arduino UNO', 'arduino-uno-2601063125-204', '<p>Arduino UNO(Micro IC) with cable</p>', NULL, '/storage/photos/1/Products/35.png', 5, '', 'new', 'active', 950.00, NULL, 0, 0.00, 1, 12, NULL, NULL, '2026-01-06 12:01:25', '2026-01-06 12:01:25'),
(36, 'Car Charger', 'car-charger', '<p>Car Charger</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Option</td><td>18W</td></tr><tr><td><br></td><td>Fast Charging</td></tr><tr><td><br></td><td>Micro, USB</td></tr><tr><td><br></td><td>C port, PD</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/36.png', 5, '', 'new', 'active', 1300.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 12:52:20', '2026-01-06 12:52:20'),
(37, 'Apple phone charger', 'apple-phone-charger', '<p>Apple phone charger with cable&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Output</td><td>C Port to C Port</td></tr><tr><td><br></td><td>Iphone, 14, 15, 16</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/37.png', 5, '', 'new', 'active', 1350.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 12:54:18', '2026-01-06 12:54:18'),
(38, 'phone charger', 'phone-charger', '<p>Apple /samsung phone charger</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Output</td><td>C Port</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/38.png', 5, '', 'new', 'active', 1100.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 12:55:08', '2026-01-06 12:55:08'),
(39, 'Data Cable', 'data-cable', '<p>Data Cable for Phone</p><p>6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>USB</td></tr><tr><td>Output</td><td>Micro</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/39.png', 5, '', 'new', 'active', 240.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 12:56:57', '2026-01-06 12:56:57'),
(40, 'Data Cable', 'data-cable-2601062811-634', '<p>Data Cable for Phone</p><p>6A</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Input</td><td>USB</td></tr><tr><td>Output</td><td>C Port</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/40.png', 5, '', 'new', 'active', 340.00, NULL, 0, 0.00, 1, 9, NULL, NULL, '2026-01-06 12:58:11', '2026-01-06 12:58:11'),
(41, 'Multimeter', 'multimeter', '<p>Multimeter</p><p>AnEngXL830</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Back Cover</td></tr><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/41.png', 5, '', 'new', 'active', 1300.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 12:59:51', '2026-01-06 12:59:51'),
(42, 'Multimeter', 'multimeter-2601063053-75', '<p>Multimeter</p><p>AnEngM1</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/42.png', 5, '', 'new', 'active', 1800.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:00:53', '2026-01-06 13:00:53'),
(43, 'Multimeter', 'multimeter-2601063202-398', '<p>Multimeter</p><p>AnEng8002</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr><tr><td>Temperature Prob</td></tr><tr><td>Pouch</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/43.jpg', 5, '', 'new', 'active', 7500.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:02:02', '2026-01-06 13:03:44'),
(44, 'Multimeter', 'multimeter-2601063320-875', '<p>Multimeter</p><p>AnEng113B</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr><tr><td>Temperature Prob</td></tr><tr><td>Pouch</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/44.png', 5, '', 'new', 'active', 7500.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:03:20', '2026-01-06 13:03:20'),
(45, 'Multimeter SMD tester', 'multimeter-smd-tester', '<p>Multimeter SMD tester</p><p>AnEng GN701</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 extra probes</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/45.PNG', 5, '', 'new', 'active', 5250.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:05:00', '2026-01-06 13:05:00'),
(46, 'Battery Tester', 'battery-tester', '<p>Battery Tester</p><p>AnEng M1</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>2 Probes</td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/46.png', 3, '', 'new', 'active', 1250.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:06:45', '2026-01-08 13:12:23'),
(47, 'Clamp meter', 'clamp-meter', '<p>Clamp meter (AC only)</p><p>AnEng ST181&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Current</td><td>400A</td></tr><tr><td>Options</td><td>AC</td></tr><tr><td>Pouch</td><td><br></td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/47.jpg', 3, '', 'new', 'active', 2750.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:08:14', '2026-01-08 12:44:07'),
(48, 'Clamp meter', 'clamp-meter-2601063953-238', '<p>Clamp meter(AC/ DC both)</p><p>AnEng PN200&nbsp;</p>', '<p><br></p><table class=\"table table-bordered\"><tbody><tr><td>Current</td><td>400A</td></tr><tr><td>Options</td><td>AC and DC</td></tr><tr><td>Temperature Pro</td><td><br></td></tr><tr><td>Pouch</td><td><br></td></tr></tbody></table><p><br></p>', '/storage/photos/1/Products/48.jpg', 5, '', 'new', 'active', 5250.00, NULL, 0, 0.00, 1, 8, NULL, NULL, '2026-01-06 13:09:53', '2026-01-06 13:09:53');

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
(3, 1, 46, 4, NULL, 'active', '2026-01-07 02:05:32', '2026-01-07 02:05:32');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `description`, `vision`, `mission`, `commitment_energy_independence`, `specialized_product_range`, `why_choose_delimach_lanka`, `short_des`, `logo`, `photo`, `address`, `phone`, `email`, `facebook`, `instagram`, `youtube`, `twitter`, `whatsapp`, `created_at`, `updated_at`) VALUES
(1, '<p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">Welcome to <b>Delimach\r\nLanka (Pvt) Ltd</b>, Sri Lanka’s specialized online hub for advanced energy\r\nsolutions, automotive excellence, and smart technology. Based in Kadawatha, we\r\nhave evolved into a digital-first leader dedicated to delivering innovation\r\ndirectly to your doorstep no matter how remote your location.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"text-align:justify\">\r\n\r\n</p><p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">As an authorized\r\n<b>sub-distributor for Shell Engine Oils</b>, we combine the reliability of a\r\nglobal brand with our local expertise to serve online customer and our\r\ncorporate network<o:p></o:p></span></p>', '<p><span lang=\"EN-US\" style=\"font-size:12.0pt;line-height:115%;\r\nfont-family:&quot;Aptos&quot;,sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\r\nAptos;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:&quot;Iskoola Pota&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\r\nEN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">To be the primary\r\ncatalyst for energy independence in Sri Lanka, ensuring that even the most\r\nremote communities have access to sustainable power and high-performance\r\ntechnology.</span></p>', '<p><span lang=\"EN-US\" style=\"font-size:12.0pt;line-height:115%;\r\nfont-family:&quot;Aptos&quot;,sans-serif;mso-ascii-theme-font:minor-latin;mso-fareast-font-family:\r\nAptos;mso-fareast-theme-font:minor-latin;mso-hansi-theme-font:minor-latin;\r\nmso-bidi-font-family:&quot;Iskoola Pota&quot;;mso-bidi-theme-font:minor-bidi;mso-ansi-language:\r\nEN-US;mso-fareast-language:EN-US;mso-bidi-language:AR-SA\">To empower our\r\ncustomers with high-quality off grid system, DIY energy systems and premium\r\nlubricants through a seamless e-commerce platform, backed by technical and guidance.</span></p>', '<p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">At Delimach\r\nLanka, we recognize that reliable electricity is a necessity, not a luxury. We\r\ndeeply understand the challenges faced by communities in remote regions and the\r\nHill Country, where frequent grid failures and unstable power can disrupt daily\r\nlife and livelihoods.<o:p></o:p></span></p><p class=\"MsoNormal\" style=\"text-align:justify\"><span lang=\"EN-US\">We believe that\r\nlow-income communities should not be left behind in the transition to modern\r\ntechnology. To bridge this gap, we specialize in providing:<o:p></o:p></span></p><p>\r\n\r\n\r\n\r\n</p><ul style=\"margin-top: 0in;\">\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Affordable DIY Energy Systems: We\r\n     offer cost-effective, high-quality components that allow families and\r\n     small businesses to build their own reliable backup power solutions.<o:p></o:p></span></li>\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Technical Empowerment: Beyond just\r\n     selling products, we provide the technical support and guidance needed to\r\n     help those with limited access to new technology successfully set up their\r\n     systems.<o:p></o:p></span></li>\r\n <li style=\"text-align: justify;\"><span lang=\"EN-US\">Bridging the Accessibility Gap:\r\n     Whether for retail or wholesale, we make the latest innovations in power\r\n     and electronics available at affordable prices, ensuring that geography\r\n     and income are no longer barriers to progress.<o:p></o:p></span></li>\r\n</ul>', '<ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Solar &amp; Backup Power:</span></b><span lang=\"EN-US\"> A\r\n     complete inventory of MPPT/PWM controllers, Pure Sine Wave and Hybrid\r\n     inverters, and long-life <b>LiFePO4 and Lead Acid batteries</b>.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Power Management &amp; Tools:</span></b><span lang=\"EN-US\">\r\n     Professional battery chargers, BMS modules, and diagnostic tools like\r\n     Multimeters and Battery Testers.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Authorized Shell Lubricants:</span></b><span lang=\"EN-US\">\r\n     Genuine <b>Shell Engine Oils</b> specifically formulated for Motorbikes,\r\n     Three-wheelers, and Cars.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\"><b><span lang=\"EN-US\">Smart Tech &amp; Lighting:</span></b><span lang=\"EN-US\">\r\n     Energy-saving Solar/DC LED lighting, premium mobile accessories, and the\r\n     latest Smart Watches.<o:p></o:p></span></li>\r\n</ul>', '<ul style=\"margin-top:0in\" type=\"disc\">\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Remote Accessibility:</span></b><span lang=\"EN-US\"> We bridge the gap for customers who cannot access specialized\r\n     technical shops in the city. We guaranteed every product you purchased\r\n     until you received it and checked for the intended purpose.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Expert Guidance:</span></b><span lang=\"EN-US\"> We understand the technical specs required for DIY backup\r\n     systems in the Sri Lankan climate.<o:p></o:p></span></li>\r\n <li class=\"MsoNormal\" style=\"text-align:justify;mso-list:l0 level1 lfo1;\r\n     tab-stops:list .5in\"><b><span lang=\"EN-US\">Trust &amp; Authenticity:</span></b><span lang=\"EN-US\"> As a Shell partner, our commitment to quality is\r\n     non-negotiable.<o:p></o:p></span></li>\r\n</ul>', 'Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', '/storage/photos/1/DL logo.png', '/storage/photos/1/DL logo.png', 'Delimach Lanka (Pvt) Ltd,  555/22B, Ranmuthugala, Kadawatha', '+94 77 782 0662', 'delimachlanka@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2026-01-08 06:16:13');

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

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `type`, `price`, `status`, `created_at`, `updated_at`) VALUES
(1, 'car', 500.00, 'active', '2026-01-05 13:40:43', '2026-01-05 13:40:43');

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
(1, 3, '0718596742', 'Order placed successfully. Order No: ORD-KSGJNB3482 | Total: 2000 | Payment: cod', NULL, 'queued', NULL, NULL, 2, '2026-01-05 13:50:15', '2026-01-05 13:50:15'),
(2, 3, '0718596742', 'Order update. Order No: ORD-KSGJNB3482 | Status: delivered', NULL, 'queued', NULL, NULL, 1, '2026-01-05 13:51:55', '2026-01-05 13:51:55'),
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
(21, 7, '716853249', 'Order update. Order No: ORD-XWNRGLAVWG | Status: delivered | Courier: DHL | Tracking: 123456', 'twilio', 'skipped', '2026-01-08 13:12:23', 'SMS sending disabled (services.sms.enabled=false).', 1, '2026-01-08 13:12:23', '2026-01-08 13:12:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `company_name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL,
  `photo` varchar(191) DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
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

INSERT INTO `users` (`id`, `name`, `company_name`, `email`, `email_verified_at`, `password`, `photo`, `role`, `customer_type`, `is_sales_staff`, `provider`, `provider_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, 'admin@gmail.com', NULL, '$2y$10$.zvMJKXSR7qkyE62Po3Yuu2iOt9Vr6s6XyAvkMFyRzKh6p2Y9IAYq', '/storage/photos/1/users/d3aa0608415495fc9893b4ad68b4b08b.jpg', 'admin', 'retail', 0, NULL, NULL, 'active', NULL, NULL, '2026-01-07 03:28:52'),
(2, 'User', NULL, 'user@gmail.com', NULL, '$2y$10$3fj7rTgZPZwXG1qS5wxeY.Xiy10Ztm1N9990Ps829F.OsNsBhTl9y', '/storage/profiles/MVDflRix9ukzuove9Ihlch380Oj2NX2Yx2UK6jGq.png', 'user', 'retail', 0, NULL, NULL, 'active', NULL, NULL, '2026-01-07 03:42:19'),
(3, 'kasun chathuranga', NULL, 'kchathuranga496@gmail.com', NULL, '$2y$10$Q8719bi0H0jhwdAJQnygMOGRShUpF.A9T3LpxH.GZsQFkhLyLTopi', NULL, 'user', 'retail', 0, NULL, NULL, 'active', 'b2FD5tA08wY1XIBnX8gnuaJtLV3wKBYgEjQbbc455DWcWR6s9EdF2fDKQlcL', '2026-01-08 12:23:02', '2026-01-08 13:59:16');

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
  ADD KEY `orders_sales_staff_id_foreign` (`sales_staff_id`);

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
  ADD KEY `products_child_cat_id_foreign` (`child_cat_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_reviews_user_id_foreign` (`user_id`),
  ADD KEY `product_reviews_product_id_foreign` (`product_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `products_child_cat_id_foreign` FOREIGN KEY (`child_cat_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `product_reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `product_reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

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
