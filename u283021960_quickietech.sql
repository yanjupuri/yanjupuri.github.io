-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 13, 2024 at 12:40 PM
-- Server version: 10.11.7-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u283021960_quickietech`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `header` text DEFAULT NULL,
  `body` text DEFAULT NULL,
  `footer` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `title`, `header`, `body`, `footer`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Your Trusted Tech Support Partner!', 'QuickieTech Creations is your dedicated tech support partner, offering reliable solutions for all your computer needs.', 'Swift and efficient service tailored to your needs.\r\nTransparent pricing with no hidden fees.\r\nExperienced technicians ensuring top-notch service quality.', 'Count on QuickieTech Creations to promptly resolve your computer issues and get you back on track.', 'streamers_1714186031.jpg', '2024-04-01 06:57:20', '2024-04-27 10:47:11');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(58, 51, 2, '2024-04-28 01:02:43', '2024-04-28 01:02:43'),
(61, 64, 4, '2024-04-28 15:02:16', '2024-04-28 15:02:16'),
(64, 65, 1, '2024-04-28 15:46:26', '2024-04-28 15:46:26'),
(65, 65, 1, '2024-04-28 15:46:31', '2024-04-28 15:46:31');

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `collection_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `mime_type` varchar(255) DEFAULT NULL,
  `disk` varchar(255) NOT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`manipulations`)),
  `custom_properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`custom_properties`)),
  `generated_conversions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`generated_conversions`)),
  `responsive_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`responsive_images`)),
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_11_09_064224_create_user_profiles_table', 1),
(5, '2021_11_11_110731_create_permission_tables', 1),
(6, '2021_11_16_114009_create_media_table', 1),
(7, '2024_03_22_121211_create_products_table', 1),
(8, '2024_03_22_121228_create_service_table', 1),
(9, '2024_03_25_122903_add_profile_picture_to_users_table', 1),
(10, '2024_03_25_160909_update_unique_username_to_users_table', 2),
(13, '2024_03_25_191033_create_reviews_table', 3),
(15, '2024_03_29_222240_update_user_profiles_table_add_description_column', 4),
(17, '2024_03_29_235110_update_user_profiles_table_change_columns', 5),
(18, '2024_04_01_023346_change_remember_token_to_users_table', 6),
(19, '2024_04_02_015658_add_image_column_on_reviews_table', 7),
(20, '2024_04_02_023516_add_category_on_reviews_table', 7),
(21, '2024_04_04_013431_add_column_reviews_table', 7),
(26, '2024_04_04_073258_create_notifications_table', 8),
(27, '2024_04_14_144800_create_visitors_table', 8),
(28, '2024_04_14_154435_create_revenues_table', 9),
(30, '2024_04_15_215351_add_purchase_date_column_on_revenues_table', 10),
(36, '2024_04_18_135820_add_columns_on_products_table', 11),
(37, '2024_04_18_140238_create_carts_table', 11),
(38, '2024_04_18_144212_add_column_on_products_table', 11),
(39, '2024_04_18_165507_add_column_on_services_table', 11),
(40, '2024_04_26_013831_create_order_history_tables', 12);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 30),
(1, 'App\\Models\\User', 41),
(1, 'App\\Models\\User', 45),
(1, 'App\\Models\\User', 55),
(2, 'App\\Models\\User', 39),
(2, 'App\\Models\\User', 40),
(2, 'App\\Models\\User', 47),
(2, 'App\\Models\\User', 51),
(2, 'App\\Models\\User', 54),
(2, 'App\\Models\\User', 56),
(2, 'App\\Models\\User', 58),
(2, 'App\\Models\\User', 62),
(2, 'App\\Models\\User', 64),
(2, 'App\\Models\\User', 65);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `content`, `read`, `created_at`, `updated_at`) VALUES
(2, 54, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=2', 0, '2024-04-07 16:55:01', '2024-04-07 16:55:01'),
(4, 58, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=5', 0, '2024-04-10 12:46:22', '2024-04-10 12:46:22'),
(5, 56, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=4', 0, '2024-04-13 02:07:01', '2024-04-13 02:07:01'),
(6, 58, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=8', 0, '2024-04-14 22:37:50', '2024-04-14 22:37:50'),
(7, 39, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=6', 0, '2024-04-16 08:41:52', '2024-04-16 08:41:52'),
(8, 51, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=7', 0, '2024-04-16 08:42:30', '2024-04-16 08:42:30'),
(9, 58, 'Your review has been replied to by an admin. Click here to view: https://quickiefixtech.online/public/reviews?id=9', 0, '2024-04-19 22:02:56', '2024-04-19 22:02:56');

-- --------------------------------------------------------

--
-- Table structure for table `order_history`
--

CREATE TABLE `order_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_name` text DEFAULT NULL,
  `purchased_date` date DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `base_price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `mode_of_payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `user_id`, `product_id`, `product_name`, `purchased_date`, `total_amount`, `base_price`, `quantity`, `status`, `mode_of_payment`, `created_at`, `updated_at`) VALUES
(1, '07F062824D120251V', 51, 2, '4PCS ABS KEYCAP CSGO', '2024-04-27', 185.41, 155, 1, 'completed', 'paypal', '2024-04-27 02:34:27', '2024-04-27 10:41:54'),
(2, '07F062824D120251V', 51, 1, 'RK Royal Kludge RK H81', '2024-04-27', 5983.95, 2879, 2, 'completed', 'paypal', '2024-04-27 02:34:27', '2024-04-28 00:56:21'),
(3, '6PS88912ME783843F', 58, 6, 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27', 2467.36, 2360, 1, 'completed', 'paypal', '2024-04-27 02:46:12', '2024-04-27 04:00:17'),
(4, '7JH482727J668003R', 58, 2, '4PCS ABS KEYCAP CSGO', '2024-04-27', 185.41, 155, 1, 'completed', 'paypal', '2024-04-27 02:47:07', '2024-04-28 16:20:01'),
(5, '8EW12840KE5870047', 58, 2, '4PCS ABS KEYCAP CSGO', '2024-04-27', 185.41, 155, 1, 'completed', 'paypal', '2024-04-27 03:00:54', '2024-04-27 03:29:00'),
(6, '636710590S5893254', 58, 2, '4PCS ABS KEYCAP CSGO', '2024-04-27', 185.41, 155, 1, 'completed', 'paypal', '2024-04-27 03:28:09', '2024-04-27 03:28:33'),
(7, '3R291704U1854182R', 58, 1, 'RK Royal Kludge RK H81', '2024-04-27', 3004.48, 2879, 1, 'completed', 'paypal', '2024-04-27 03:32:37', '2024-04-27 03:42:43'),
(8, '5FK943158B006923J', 58, 5, 'Samsung 870 EVO 1TB SSD 2.5-Inch SATA III 6GB/s Internal SSD MZ-77E1T0BW', '2024-04-27', 5094.98, 4899, 1, 'completed', 'paypal', '2024-04-27 03:43:19', '2024-04-27 03:59:58'),
(9, '5FK943158B006923J', 58, 6, 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27', 4909.73, 2360, 2, 'completed', 'paypal', '2024-04-27 03:43:19', '2024-04-27 03:44:15'),
(10, '5FK943158B006923J', 58, 2, '4PCS ABS KEYCAP CSGO', '2024-04-27', 345.82, 155, 2, 'completed', 'paypal', '2024-04-27 03:43:19', '2024-04-27 03:43:49'),
(11, '6R977071BH521183M', 58, 6, 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27', 12236.82, 2360, 5, 'completed', 'paypal', '2024-04-27 10:59:51', '2024-04-27 12:37:48'),
(12, '0N146990XX5942814', 58, 1, 'RK Royal Kludge RK H81', '2024-04-28', 8963.43, 2879, 3, 'pending', 'paypal', '2024-04-28 16:28:16', '2024-04-28 16:28:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hahaha@gmail.com', '$2y$10$zBedBvRKHUhHSlCmO1MrXuTTeceSfSMVhw65Qgd3dVzDXTh3NP1VS', '2024-03-30 16:40:50'),
('xt202002883@wmsu.edu.ph', '$2y$10$FC4pa1XDkC586sRysTQIsu7LvQmGPX754LxTLMpbkXsJBCovx18Ua', '2024-04-04 11:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add service', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(2, 'edit service', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(3, 'delete service', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(4, 'add product', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(5, 'edit product', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(6, 'delete product', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(7, 'add user', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54'),
(8, 'delete user', 'web', '2024-03-28 21:13:54', '2024-03-28 21:13:54');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isAvailable` tinyint(1) DEFAULT 1,
  `status` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`, `isAvailable`, `status`, `quantity`) VALUES
(1, 'RK Royal Kludge RK H81', 'RK Royal Kludge RK H81 81 Key Gasket Structure Tri-Mode RGB Wired Bluetooth 2.4G Wireless 3 Modes', 2879, 'rk 81 key_1711924536.jpg', '2024-04-01 06:35:36', '2024-04-28 01:00:23', 1, 'new', 8),
(2, '4PCS ABS KEYCAP CSGO', 'Abs Mechanical Keyboard Keycaps Light Transmission cf Ac And Fire Cutting Gun Shortcut Keys WASD Direction Key Keycaps. (Disclaimer: KEYCAPS ONLY)', 155, 'keycaps_1711924653.jpg', '2024-04-01 06:37:33', '2024-04-28 16:20:01', 1, 'new', 10),
(3, 'Sapphire Pulse AMD Radeon RX 6600 Gaming 8GB GDDR6 Graphic Card', 'Sapphire Pulse AMD Radeon RX 6600 Gaming 8GB GDDR6 Graphic Card (SPR-11310-01-20G)', 13499, 'RX 6600_1711924870.jpg', '2024-04-01 06:41:10', '2024-04-19 20:07:42', 0, 'new', 0),
(4, 'Cooler Master MWE GOLD 750 750W 80+ Gold - V2 Full Modular Power Supply Unit', 'The MWE Gold offers a high-efficient, affordable power solution with fully modular cabling. Enjoy 90% efficiency with 80 PLUS Gold certification. The MWE\'s design ensures improved efficiency while maintaining low temperatures and quiet operation. High quality heat-resistant components maintain gold-level performance even at increased temperatures up to 45°C. A near-quiet Silencio fan with an exclusive LDB bearing reduces noise, lasting longer than standard bearings. Be bold, power with gold', 6099, 'power supply_1711925055.jpg', '2024-04-01 06:44:15', '2024-04-28 01:00:10', 1, 'new', 20),
(5, 'Samsung 870 EVO 1TB SSD 2.5-Inch SATA III 6GB/s Internal SSD MZ-77E1T0BW', 'Samsung 870 EVO 1TB SSD 2.5-Inch SATA III 6GB/s Internal SSD MZ-77E1T0BW', 4899, 'samsung ssd_1711925189.jpg', '2024-04-01 06:46:29', '2024-04-27 03:59:58', 0, 'new', 0),
(6, 'Redragon H510 Zeus 2 All In One Gaming Headset', 'Enjoy the real clear and lossless sound quality with 7.1 Surround-Sound technology, it will make you be there on the scene wherever game field, live concert and chatting room. The 53mm drive unit offers a wider frequency range, richer sound fields, higher definition, and extreme fidelity sound.', 2360, 'headset_1711925306.jpg', '2024-04-01 06:48:26', '2024-04-27 12:37:48', 0, 'new', 0);

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `types` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `category` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `revenues`
--

INSERT INTO `revenues` (`id`, `types`, `amount`, `purchase_date`, `category`, `created_at`, `updated_at`) VALUES
(1, 'service', '1500', '2024-04-07', 'Programming Commission', '2024-04-16 01:21:33', '2024-04-16 01:21:33'),
(2, 'service', '600', '2024-03-25', 'Reformat & Reprogram', '2024-04-16 01:46:20', '2024-04-16 01:46:20'),
(3, 'service', '1000', '2024-04-11', 'Programming Commission', '2024-04-16 02:17:58', '2024-04-16 02:17:58'),
(4, 'service', '500', '2024-04-02', 'Network Setup', '2024-04-16 08:21:13', '2024-04-16 08:21:13'),
(5, 'product', '620', '2024-04-10', '4PCS ABS KEYCAP CSGO', '2024-04-16 08:22:07', '2024-04-16 08:22:07'),
(6, 'product', '4720', '2024-04-12', 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-16 08:48:09', '2024-04-16 08:48:09'),
(7, 'service', '300', '2024-04-15', 'Home Service', '2024-04-16 16:21:23', '2024-04-16 16:21:23'),
(8, 'product', '40497', '2024-02-14', 'Sapphire Pulse AMD Radeon RX 6600 Gaming 8GB GDDR6 Graphic Card', '2024-04-16 16:22:53', '2024-04-16 16:22:53'),
(9, 'product', '13499', '2024-01-09', 'Sapphire Pulse AMD Radeon RX 6600 Gaming 8GB GDDR6 Graphic Card', '2024-04-16 16:24:16', '2024-04-16 16:24:16'),
(10, 'service', '12000', '2023-11-07', 'Programming Commission', '2024-04-16 16:25:27', '2024-04-16 16:25:27'),
(11, 'service', '7000', '2023-04-16', 'Programming Commission', '2024-04-16 16:25:56', '2024-04-16 16:25:56'),
(12, 'service', '15000', '2024-02-01', 'Programming Commission', '2024-04-16 16:26:32', '2024-04-16 16:26:32'),
(13, 'service', '700', '2024-03-24', 'Hardware Repair', '2024-04-16 16:28:02', '2024-04-16 16:28:02'),
(14, 'product', '5758', '2024-04-16', 'RK Royal Kludge RK H81', '2024-04-16 16:32:51', '2024-04-16 16:32:51'),
(15, 'product', '6099', '2024-04-17', 'Cooler Master MWE GOLD 750 750W 80+ Gold - V2 Full Modular Power Supply Unit', '2024-04-16 17:44:11', '2024-04-16 17:44:11'),
(16, 'service', '7000', '2024-04-11', 'Programming Commission', '2024-04-17 22:40:22', '2024-04-17 22:40:22'),
(17, 'product', '775', '2024-04-17', '4PCS ABS KEYCAP CSGO', '2024-04-18 23:44:32', '2024-04-18 23:44:32'),
(18, 'product', '489900', '2024-04-15', 'Samsung 870 EVO 1TB SSD 2.5-Inch SATA III 6GB/s Internal SSD MZ-77E1T0BW', '2024-04-18 23:44:56', '2024-04-18 23:44:56'),
(19, 'product', '155', '2024-04-02', '4PCS ABS KEYCAP CSGO', '2024-04-18 23:45:12', '2024-04-18 23:45:12'),
(20, 'product', '26998', '2024-04-19', 'Sapphire Pulse AMD Radeon RX 6600 Gaming 8GB GDDR6 Graphic Card', '2024-04-19 20:07:42', '2024-04-19 20:07:42'),
(21, 'product', '2879', '2024-04-19', 'RK Royal Kludge RK H81', '2024-04-19 20:42:29', '2024-04-19 20:42:29'),
(22, 'product', '2360', '2024-04-19', 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-19 20:42:29', '2024-04-19 20:42:29'),
(23, 'service', '7000', '2024-04-12', 'Programming Commission', '2024-04-21 13:32:43', '2024-04-21 13:32:43'),
(24, 'service', '500', '2024-04-21', 'Hardware Repair', '2024-04-21 13:36:56', '2024-04-21 13:36:56'),
(25, 'product', '185.41', '2024-04-27', '4PCS ABS KEYCAP CSGO', '2024-04-27 03:28:33', '2024-04-27 03:28:33'),
(26, 'product', '185.41', '2024-04-27', '4PCS ABS KEYCAP CSGO', '2024-04-27 03:29:00', '2024-04-27 03:29:00'),
(27, 'product', '3004.48', '2024-04-27', 'RK Royal Kludge RK H81', '2024-04-27 03:42:43', '2024-04-27 03:42:43'),
(28, 'product', '345.82', '2024-04-27', '4PCS ABS KEYCAP CSGO', '2024-04-27 03:43:49', '2024-04-27 03:43:49'),
(29, 'product', '4909.73', '2024-04-27', 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27 03:44:15', '2024-04-27 03:44:15'),
(30, 'product', '5094.98', '2024-04-27', 'Samsung 870 EVO 1TB SSD 2.5-Inch SATA III 6GB/s Internal SSD MZ-77E1T0BW', '2024-04-27 03:59:58', '2024-04-27 03:59:58'),
(31, 'product', '2467.36', '2024-04-27', 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27 04:00:17', '2024-04-27 04:00:17'),
(32, 'product', '185.41', '2024-04-27', '4PCS ABS KEYCAP CSGO', '2024-04-27 10:41:54', '2024-04-27 10:41:54'),
(33, 'service', '200', '2024-04-27', 'Home Service', '2024-04-27 10:42:57', '2024-04-27 10:42:57'),
(34, 'product', '12236.82', '2024-04-27', 'Redragon H510 Zeus 2 All In One Gaming Headset', '2024-04-27 12:37:48', '2024-04-27 12:37:48'),
(35, 'product', '5983.95', '2024-04-27', 'RK Royal Kludge RK H81', '2024-04-28 00:56:21', '2024-04-28 00:56:21'),
(36, 'product', '185.41', '2024-04-27', '4PCS ABS KEYCAP CSGO', '2024-04-28 16:20:01', '2024-04-28 16:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rating_type` varchar(255) DEFAULT NULL,
  `stars` int(11) DEFAULT 5,
  `comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `replies` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rating_type`, `stars`, `comments`, `created_at`, `updated_at`, `image`, `category`, `replies`) VALUES
(2, 54, 'service', 5, NULL, '2024-04-07 14:09:30', '2024-04-07 16:55:01', '', 'Programming Commission', 'Thank you, Franz!!'),
(4, 56, 'service', 5, NULL, '2024-04-09 19:40:55', '2024-04-13 02:07:01', '20181228_142843_1712662855.jpg', 'PC Build', 'seh'),
(5, 58, 'service', 1, 'Very bad networking service. Mas lalong nasira networking setup namin dahil dito!!', '2024-04-10 11:06:55', '2024-04-10 12:46:22', 'JM0098_1712718415.jpg', 'Network Setup', 'hahaha buti nga sayo'),
(6, 39, 'service', 3, 'nays', '2024-04-14 00:31:11', '2024-04-16 08:41:52', '', 'PC Build', 'things'),
(7, 51, 'product', 5, 'a MUST HAVE!! napaka estetik guys!', '2024-04-14 19:04:17', '2024-04-16 08:42:30', '', '4PCS ABS KEYCAP CSGO', 'Thank you'),
(8, 58, 'service', 1, 'La talaga kwenta networking nila 😡😡😡', '2024-04-14 22:32:43', '2024-04-14 22:37:50', '', 'Network Setup', 'Hee-hee'),
(9, 58, 'product', 5, NULL, '2024-04-19 20:44:28', '2024-04-19 22:02:56', '', 'Cooler Master MWE GOLD 750 750W 80+ Gold - V2 Full Modular Power Supply Unit', 'Thanks, sir');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-03-25 15:55:12', '2024-03-25 15:55:12'),
(2, 'user', 'web', '2024-03-25 15:55:12', '2024-03-25 15:55:12'),
(3, 'employee', 'web', '2024-04-14 16:52:52', '2024-04-14 16:52:52');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isAvailable` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`, `isAvailable`) VALUES
(1, 'Programming Commission', 'Need a custom software solution? QuickieTech Creations offers programming commission services tailored to your needs. Our expert programmers will work closely with you to develop efficient and reliable software solutions, ensuring your project\'s success. From web development to mobile app creation, trust QuickieTech Creations to bring your ideas to life with precision and expertise.', 7000, 'programming_1714138431.jpg', '2024-04-01 03:30:20', '2024-04-26 21:33:51', 1),
(2, 'PC Build', 'Looking to build your dream PC? QuickieTech Creations offers expert PC building services tailored to your needs. Whether you\'re a gamer, designer, or professional, we\'ll help you assemble the perfect rig for your requirements. From selecting components to building and testing, trust QuickieTech Creations to bring your PC vision to life with precision and care.', 800, '20190205_183900_1714140508.jpg', '2024-04-01 03:34:24', '2024-04-26 22:08:28', 1),
(3, 'Troubleshooting Services', 'Encountering technical issues? QuickieTech Creations offers expert troubleshooting services to diagnose and resolve any problems with your devices. From software glitches to hardware malfunctions, our experienced technicians are here to provide efficient solutions and get you back up and running smoothly in no time.', 300, 'troubleshooting_1714138448.jpg', '2024-04-01 03:37:24', '2024-04-26 21:34:08', 1),
(4, 'Home Service', 'QuickieTech Creations offers convenient home service repair solutions. Whether it\'s fixing your computer, setting up your home network, or troubleshooting technical issues, our expert technicians will come to your doorstep to provide reliable and efficient solutions. Experience hassle-free tech support without leaving your home with QuickieTech Creations!', 200, '20190114_162452_1714140581.jpg', '2024-04-01 03:38:05', '2024-04-26 22:09:41', 1),
(5, 'Reformat & Reprogram', 'QuickieTech Creations offers professional reformatting and reprogramming services to breathe new life into your devices. Whether it\'s your computer, laptop, or mobile device, our expert technicians will wipe out the clutter, reinstall the operating system, and optimize performance. Get your devices running like new with QuickieTech Creations!', 500, 'IMG_20230114_151912_1714140913.jpg', '2024-04-01 03:38:40', '2024-04-26 22:15:13', 1),
(6, 'Upgrades & Maintenance', 'QuickieTech Creations offers comprehensive upgrades and maintenance services to keep your devices running smoothly. Whether it\'s upgrading hardware components, installing software updates, or performing routine maintenance tasks, our expert technicians ensure optimal performance and longevity for your devices. Trust QuickieTech Creations for all your upgrade and maintenance needs!', 500, 'received_654653542756999_1714140553.jpeg', '2024-04-01 03:39:13', '2024-04-26 22:09:13', 0),
(7, 'Hardware Repair', 'QuickieTech Creations provides expert hardware repair services to resolve issues with your devices\' physical components. Whether it\'s repairing a broken screen, replacing a faulty component, or diagnosing hardware failures, our skilled technicians deliver efficient and reliable solutions to get your devices back in working order. Trust QuickieTech Creations for all your hardware repair needs!', 500, 'received_1246033816138579_1714140322.jpeg', '2024-04-01 03:39:53', '2024-04-27 02:30:00', 1),
(8, 'Network Setup', 'QuickieTech Creations offers professional network setup services to ensure seamless connectivity in your home or office. Our experienced technicians will design, install, and configure your network infrastructure to optimize performance and security.', 500, 'networking_1714138413.jpg', '2024-04-01 03:40:30', '2024-04-26 21:33:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone_number`, `email_verified_at`, `user_type`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `profile_picture`, `token`) VALUES
(30, 'anthony bryanjupuri', 'Anthony Bryan', 'Jupuri', 'yanjupuri@gmail.com', '09264539945', '2024-03-31 18:26:41', 'user', '$2y$10$2B4Tg36d2cV4znIEFYddYO8NHgbZTFS.xWrR3RKWgyUMpeSovjsPO', 'pending', NULL, '2024-03-31 18:26:04', '2024-04-18 11:19:54', 'team-1_1713410394.jpg', '52afffb7-8396-4854-a210-208b660be05d'),
(39, 'gordzibrahim', 'Gordz', 'Ibrahim', 'xt202001643@wmsu.edu.ph', '09736825371', '2024-04-01 03:25:08', 'user', '$2y$10$IG0NRyLBYhZet.BzgpkdVOFSxIz18tlOWihStIOSFbx8WTZi/R21W', 'pending', NULL, '2024-04-01 03:10:03', '2024-04-07 21:25:21', 'received_980904186786291_1712496321.jpeg', '123a971d-1ac6-4107-bfc8-62dead31dade'),
(40, 'lorraine janjupuri', 'LORRAINE JAN', 'JUPURI', 'ljjupuri@gmail.com', '09081061574', '2024-04-01 03:54:53', 'user', '$2y$10$pJsY.BgY36lJis/NuBr5iuJi6.CyR1C.M2IthwsYxcb6io9Nrp2PS', 'pending', NULL, '2024-04-01 03:53:49', '2024-04-01 03:54:53', NULL, '8091a0a6-6978-4c57-be0b-fdb635aa3489'),
(41, 'benrazheiribrahim', 'Benrazheir', 'Ibrahim', 'bas1cibrahim11@gmail.com', '09168813442', '2024-04-01 05:25:57', 'user', '$2y$10$Easy5QwJhCgC8zvhDzdrYeBj0ZYEAkk6RbFpYo3ga0GUw81qxoMdK', 'pending', NULL, '2024-04-01 05:22:44', '2024-04-08 21:49:57', '431675324_1195977491374539_7002593632554187731_n_1712584197.jpg', '3761c5d9-41f6-41f5-b56c-994464657441'),
(45, 'denise alexihong', 'Denise Alexi', 'Hong', 'hongdenisealexi25@gmail.com', '09173628489', '2024-04-01 13:40:34', 'user', '$2y$10$sE9Dg2A6lj7aYvRDEqNp4uu17vuU4ISLbxyIOipo4wPP75jSXGU3i', 'pending', NULL, '2024-04-01 08:40:21', '2024-04-28 10:44:59', 'IMG_20240320_172358_1714272299.jpg', 'a59ea5dd-6ee1-464d-acfc-1d615f49a606'),
(47, 'jemharsabandal', 'Jemhar', 'Sabandal', 'jemharsabandal@gmail.com', '09365971986', '2024-04-02 17:10:43', 'user', '$2y$10$0lVGR8EKPwdD6bds7Aiw3.XMh7QL8VSvxL3jlEt5ZcMH0bwvyfhGK', 'pending', NULL, '2024-04-02 16:51:56', '2024-04-02 17:10:43', NULL, '39738d1c-8955-4ab6-b5ea-8a463df273ee'),
(51, 'userhong', 'User', 'Hong', 'xt202002883@wmsu.edu.ph', '09364923499', '2024-04-04 10:51:32', 'user', '$2y$10$bgtP9Pkfn0IJmNe6ETqUxOCsleKHLbTOSY6IvnMVev/KI4FqKd6k2', 'pending', NULL, '2024-04-04 10:49:44', '2024-04-07 18:24:40', '426438524_1314982712477701_3970847849554164636_n-removebg-preview_1712485480.png', '16dafe17-a6df-4c2f-8ef3-6e0c340f6272'),
(54, 'franzdispo', 'Franz', 'Dispo', 'franzdispo14@gmail.com', '09272112323', '2024-04-07 14:07:54', 'user', '$2y$10$0esqefLeg7mydu29OzYeXuIbLLqU6RWxGDhYxeL6AlQePqWt57Ng.', 'pending', NULL, '2024-04-07 14:07:04', '2024-04-07 14:07:54', NULL, '0e9919cf-2cd3-4631-abc6-336e2f70ebc4'),
(55, 'jorgecarmigregorio', 'Jorge Carmi', 'Gregorio', 'jorgecarmigregorio@gmail.com', '09123456998', '2024-04-08 20:41:02', 'user', '$2y$10$3ZTzO/uzhonK3qxpbPC22uA.ONH0Lyq4o1QFPE3vvVrLIPV7WwhiK', 'pending', NULL, '2024-04-08 20:40:35', '2024-04-12 13:12:07', '421459682_3680324988859003_6381583562920670993_n_1712898727.jpg', '1c7246f4-94df-42e8-ba6a-723d9ff3c4e4'),
(56, 'khabzyumang', 'Khabz', 'Yu Mang', 'wexxc000@gmail.com', '09103869254', '2024-04-09 00:29:56', 'user', '$2y$10$ZfHTZDW3Ikfn8G3zkYE5mu65G8uTUndWfSsEplk9YU8aqDLTtn7gG', 'pending', NULL, '2024-04-09 00:28:43', '2024-04-09 19:32:34', 'Screenshot_20240409_191232_1712662354.jpg', 'aec8fe4d-c686-432f-957a-131b8a2e6e94'),
(58, 'juandelacruz', 'Juan', 'Dela Cruz', 'xt202000404@wmsu.edu.ph', '09102645898', '2024-04-10 11:04:31', 'user', '$2y$10$xKmwoAYOjJOJXF5GnTwCzuxSxKN8XSSRnbUwJ/y7laMtuUVkYKp5q', 'pending', NULL, '2024-04-10 11:04:14', '2024-04-10 11:04:31', '58_profile.png', 'a0406d8f-f6c3-45be-8b86-4f1e5026f8b0'),
(62, 'useraccount', 'User', 'Account', 'user@gmail.com', '09123456789', '2024-04-27 00:47:17', 'user', '$2y$10$QyZqWSKRz6zcV15cjhdtT.B3tUb84G3tGULIxcwvAejTFMgZxToGi', 'pending', NULL, '2024-04-27 00:46:02', '2024-04-27 00:46:02', '62_profile.png', '245582ca-e9fb-4072-9df3-931a07ce5abd'),
(64, 'lemmynatti', 'Lemmy', 'Natti', 'bigay.lemuel@wmsu.edu.ph', '09164271328', '2024-04-28 14:59:31', 'user', '$2y$10$ekfo8vhgeh41DHozwYUuVOvyGPA9i4.bIIfZtjPYSRvXVcjJ6lad.', 'pending', NULL, '2024-04-28 14:57:02', '2024-04-28 14:59:31', '64_profile.png', 'e0aeac7d-15e7-4fd9-9b7b-c310f7a9ddb6'),
(65, 'monirakam', 'Monira', 'Kam', 'yameerjaz46@gmail.com', '09171234567', '2024-04-28 15:41:45', 'user', '$2y$10$kADU2LbBy8io52wViwqbGObxbUjsztjAGZ.5L81JYKTJZVMlu23vy', 'pending', NULL, '2024-04-28 15:32:48', '2024-04-28 15:41:45', '65_profile.png', '7079e952-7b9a-4004-b778-25c979661ab8');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `street_addr_1` varchar(255) DEFAULT NULL,
  `street_addr_2` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `alt_phone_number` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `pin_code` bigint(20) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `linkdin_url` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text DEFAULT NULL,
  `titles` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `company_name`, `street_addr_1`, `street_addr_2`, `phone_number`, `alt_phone_number`, `country`, `state`, `city`, `pin_code`, `facebook_url`, `instagram_url`, `twitter_url`, `linkdin_url`, `user_id`, `created_at`, `updated_at`, `description`, `titles`) VALUES
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, '2024-04-01 03:30:50', '2024-04-01 03:30:50', NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 30, '2024-04-01 03:42:16', '2024-04-06 15:36:40', 'As a skilled software engineer and technician, Engr. Anthony Bryan A. Jupuri brings a wealth of expertise and knowledge to every project he undertakes. With a passion for technology and a commitment to excellence, Bryan ensures that each task is executed with precision and efficiency. His dedication to innovation and problem-solving makes him a valuable asset to any team. Outside of work, Bryan enjoys exploring new technologies, spending time with family and friends, and engaging in outdoor activities.', 'Software Engineer | Computer Technician'),
(7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, '2024-04-01 05:27:22', '2024-04-28 10:39:08', 'Meet Engr. Benrazheir S. Ibrahim, your go-to expert for all things systems and networks. With years of hands-on experience, Benrazheir keeps your digital world running smoothly. From setting up networks to troubleshooting glitches, he\'s your tech-savvy problem solver. Trust him to secure your data and keep your systems ticking like clockwork. With Engr. Ibrahim on your team, technology hiccups become a thing of the past.', 'System and Network Engineer'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, '2024-04-01 06:26:06', '2024-04-01 06:26:06', NULL, NULL),
(9, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, '2024-04-01 07:39:20', '2024-04-01 07:39:20', NULL, NULL),
(10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, '2024-04-02 06:33:28', '2024-04-02 06:33:28', NULL, NULL),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, '2024-04-04 10:58:00', '2024-04-04 10:58:00', NULL, NULL),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, '2024-04-04 20:49:12', '2024-04-04 20:49:12', NULL, NULL),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, '2024-04-06 00:19:50', '2024-04-06 00:23:44', 'A skilled software testing professional with expertise in both manual and automated testing techniques. Dedicated to ensuring software quality, adept at crafting comprehensive test plans and executing various testing methodologies. Meticulously analyzes software systems to identify and rectify defects, ensuring seamless integration of testing practices throughout the software development lifecycle. Commits to continuous improvement and fosters a culture of quality within multidisciplinary teams. Delivers high-quality solutions that exceed stakeholder expectations.', 'Software Engineer | Tester'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, '2024-04-08 20:42:30', '2024-04-12 13:11:02', 'An experienced Front End Developer known for crafting visually stunning and user-friendly web interfaces. With a focus on clean code and best practices, Jorge excels in translating design concepts into seamless digital experiences. His passion for creating intuitive user interfaces, combined with his expertise in HTML, CSS, and JavaScript, positions him as a valuable asset for any project or team.', 'Software Engineer | Front-End Developer'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, '2024-04-09 07:13:01', '2024-04-09 07:13:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, '2001:4455:63e:9f00:3cf9:a687:5271:9abc', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 OPR/107.0.0.0', '2024-04-18 17:38:16', '2024-04-18 17:38:16'),
(2, '2001:4455:63e:9f00:3cf9:a687:5271:9abc', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 OPR/107.0.0.0', '2024-04-18 18:25:06', '2024-04-18 18:25:06'),
(3, '2001:4455:63e:9f00:3cf9:a687:5271:9abc', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 OPR/107.0.0.0', '2024-04-18 18:25:54', '2024-04-18 18:25:54'),
(4, '89.22.101.69', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/61.0.3163.100 Safari/537.36', '2024-04-18 19:17:10', '2024-04-18 19:17:10'),
(5, '54.236.58.43', 'got (https://github.com/sindresorhus/got)', '2024-04-18 19:30:45', '2024-04-18 19:30:45'),
(6, '3.145.97.20', 'curl/8.3.0', '2024-04-18 19:52:05', '2024-04-18 19:52:05'),
(7, '180.195.208.239', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36', '2024-04-18 20:08:28', '2024-04-18 20:08:28'),
(8, '180.195.208.239', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36', '2024-04-18 20:11:48', '2024-04-18 20:11:48'),
(9, '49.149.104.114', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36', '2024-04-18 20:20:54', '2024-04-18 20:20:54'),
(10, '42.83.147.34', 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)Chrome/74.0.3729.169 Safari/537.36', '2024-04-18 22:37:43', '2024-04-18 22:37:43'),
(11, '34.86.239.201', 'Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; rv:11.0) like Gecko', '2024-04-18 22:44:00', '2024-04-18 22:44:00'),
(12, '124.104.47.175', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', '2024-04-18 23:59:54', '2024-04-18 23:59:54'),
(13, '2001:4455:63e:9f00:85a3:6bef:8af6:b267', 'Chrome', '2024-04-19 02:42:28', '2024-04-19 02:42:28'),
(14, '2001:4455:63e:9f00:85a3:6bef:8af6:b267', 'Chrome', '2024-04-19 02:59:30', '2024-04-19 02:59:30'),
(15, '203.177.59.200', 'Chrome', '2024-04-19 02:59:42', '2024-04-19 02:59:42'),
(16, '180.195.208.239', 'Chrome', '2024-04-19 04:25:14', '2024-04-19 04:25:14'),
(17, '2a03:b0c0:2:d0::ebb:5001', 'Chrome', '2024-04-19 08:24:50', '2024-04-19 08:24:50'),
(18, '2a03:b0c0:2:d0::ebb:5001', 'Chrome', '2024-04-19 08:24:50', '2024-04-19 08:24:50'),
(19, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-19 10:00:25', '2024-04-19 10:00:25'),
(20, '43.130.7.211', 'Safari', '2024-04-19 10:50:31', '2024-04-19 10:50:31'),
(21, '172.59.8.184', 'Chrome', '2024-04-19 12:46:17', '2024-04-19 12:46:17'),
(22, '43.157.66.187', 'Safari', '2024-04-19 13:03:35', '2024-04-19 13:03:35'),
(23, '2001:4455:63e:9f00:2477:88cd:6171:2c0f', 'Chrome', '2024-04-19 13:26:53', '2024-04-19 13:26:53'),
(24, '2001:4455:63e:9f00:2477:88cd:6171:2c0f', 'Chrome', '2024-04-19 13:27:11', '2024-04-19 13:27:11'),
(25, '5.133.192.140', 'Chrome', '2024-04-19 15:13:47', '2024-04-19 15:13:47'),
(26, '65.154.226.168', 'Chrome', '2024-04-19 15:46:16', '2024-04-19 15:46:16'),
(27, '35.91.163.160', 'Chrome', '2024-04-19 18:13:04', '2024-04-19 18:13:04'),
(28, '2001:4455:63e:9f00:2477:88cd:6171:2c0f', 'Chrome', '2024-04-19 20:05:40', '2024-04-19 20:05:40'),
(29, '2001:4455:63e:9f00:2477:88cd:6171:2c0f', 'Chrome', '2024-04-19 20:10:04', '2024-04-19 20:10:04'),
(30, '2001:4455:63e:9f00:2477:88cd:6171:2c0f', 'Chrome', '2024-04-19 20:36:58', '2024-04-19 20:36:58'),
(31, '2a03:b0c0:2:d0::eba:a001', 'Chrome', '2024-04-19 20:55:00', '2024-04-19 20:55:00'),
(32, '2a03:b0c0:2:d0::eba:a001', 'Chrome', '2024-04-19 20:55:01', '2024-04-19 20:55:01'),
(33, '2a03:b0c0:2:d0::fdb:9001', 'Chrome', '2024-04-19 20:55:52', '2024-04-19 20:55:52'),
(34, '2a03:b0c0:2:d0::fdb:9001', 'Chrome', '2024-04-19 20:55:53', '2024-04-19 20:55:53'),
(35, '44.236.207.248', 'Chrome', '2024-04-19 21:03:33', '2024-04-19 21:03:33'),
(36, '66.249.79.233', 'Chrome', '2024-04-19 21:28:35', '2024-04-19 21:28:35'),
(37, '180.195.208.239', 'Chrome', '2024-04-19 22:00:11', '2024-04-19 22:00:11'),
(38, '209.38.158.54', 'Chrome', '2024-04-19 22:30:52', '2024-04-19 22:30:52'),
(39, '170.106.159.160', 'Safari', '2024-04-19 23:26:19', '2024-04-19 23:26:19'),
(40, '137.226.113.44', 'Unknown', '2024-04-19 23:35:58', '2024-04-19 23:35:58'),
(41, '137.226.113.44', 'Unknown', '2024-04-19 23:35:59', '2024-04-19 23:35:59'),
(42, '43.156.108.103', 'Chrome', '2024-04-20 02:30:37', '2024-04-20 02:30:37'),
(43, '43.134.37.211', 'Safari', '2024-04-20 02:32:11', '2024-04-20 02:32:11'),
(44, '199.244.88.219', 'Chrome', '2024-04-20 03:34:58', '2024-04-20 03:34:58'),
(45, '122.176.199.96', 'Chrome', '2024-04-20 07:11:02', '2024-04-20 07:11:02'),
(46, '121.229.185.160', 'Safari', '2024-04-20 08:55:48', '2024-04-20 08:55:48'),
(47, '8.41.221.60', 'Firefox', '2024-04-20 09:48:45', '2024-04-20 09:48:45'),
(48, '8.41.221.60', 'Firefox', '2024-04-20 09:48:48', '2024-04-20 09:48:48'),
(49, '144.217.135.203', 'Unknown', '2024-04-20 09:49:17', '2024-04-20 09:49:17'),
(50, '144.217.135.203', 'Unknown', '2024-04-20 09:49:20', '2024-04-20 09:49:20'),
(51, '144.217.135.203', 'Unknown', '2024-04-20 09:49:22', '2024-04-20 09:49:22'),
(52, '144.217.135.203', 'Unknown', '2024-04-20 09:49:23', '2024-04-20 09:49:23'),
(53, '144.217.135.203', 'Unknown', '2024-04-20 09:49:24', '2024-04-20 09:49:24'),
(54, '144.217.135.203', 'Unknown', '2024-04-20 09:49:25', '2024-04-20 09:49:25'),
(55, '144.217.135.203', 'Unknown', '2024-04-20 09:49:27', '2024-04-20 09:49:27'),
(56, '144.217.135.203', 'Unknown', '2024-04-20 09:49:28', '2024-04-20 09:49:28'),
(57, '144.217.135.203', 'Unknown', '2024-04-20 09:49:29', '2024-04-20 09:49:29'),
(58, '144.217.135.203', 'Unknown', '2024-04-20 09:49:30', '2024-04-20 09:49:30'),
(59, '144.217.135.203', 'Unknown', '2024-04-20 09:49:31', '2024-04-20 09:49:31'),
(60, '144.217.135.203', 'Chrome', '2024-04-20 09:49:34', '2024-04-20 09:49:34'),
(61, '149.56.150.183', 'Unknown', '2024-04-20 09:49:55', '2024-04-20 09:49:55'),
(62, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-20 10:00:25', '2024-04-20 10:00:25'),
(63, '170.106.104.42', 'Safari', '2024-04-20 10:44:31', '2024-04-20 10:44:31'),
(64, '65.154.226.170', 'Chrome', '2024-04-20 13:02:55', '2024-04-20 13:02:55'),
(65, '34.123.170.104', 'Chrome', '2024-04-20 13:02:56', '2024-04-20 13:02:56'),
(66, '205.169.39.126', 'Chrome', '2024-04-20 13:03:01', '2024-04-20 13:03:01'),
(67, '205.169.39.126', 'Chrome', '2024-04-20 13:03:25', '2024-04-20 13:03:25'),
(68, '128.90.170.38', 'Firefox', '2024-04-20 14:40:50', '2024-04-20 14:40:50'),
(69, '2604:2dc0:100:55dd::', 'Chrome', '2024-04-20 14:59:49', '2024-04-20 14:59:49'),
(70, '2604:2dc0:100:55dd::', 'Chrome', '2024-04-20 14:59:49', '2024-04-20 14:59:49'),
(71, '122.176.199.96', 'Chrome', '2024-04-20 23:26:36', '2024-04-20 23:26:36'),
(72, '170.106.82.193', 'Safari', '2024-04-21 02:43:19', '2024-04-21 02:43:19'),
(73, '2001:4455:63e:9f00:2975:1939:74d1:b40a', 'Chrome', '2024-04-21 03:37:04', '2024-04-21 03:37:04'),
(74, '123.6.49.15', 'Chrome', '2024-04-21 03:37:05', '2024-04-21 03:37:05'),
(75, '123.6.49.50', 'Chrome', '2024-04-21 03:37:06', '2024-04-21 03:37:06'),
(76, '123.6.49.42', 'Chrome', '2024-04-21 03:37:16', '2024-04-21 03:37:16'),
(77, '27.115.124.70', 'Chrome', '2024-04-21 03:37:17', '2024-04-21 03:37:17'),
(78, '23.95.55.24', 'Firefox', '2024-04-21 04:27:02', '2024-04-21 04:27:02'),
(79, '122.176.199.96', 'Chrome', '2024-04-21 04:35:36', '2024-04-21 04:35:36'),
(80, '43.157.66.187', 'Safari', '2024-04-21 05:49:58', '2024-04-21 05:49:58'),
(81, '128.90.62.26', 'Chrome', '2024-04-21 07:10:03', '2024-04-21 07:10:03'),
(82, '43.159.128.68', 'Safari', '2024-04-21 08:47:09', '2024-04-21 08:47:09'),
(83, '2a06:4880:d000::e7', 'Unknown', '2024-04-21 09:53:30', '2024-04-21 09:53:30'),
(84, '129.226.158.26', 'Safari', '2024-04-21 10:30:51', '2024-04-21 10:30:51'),
(85, '180.195.208.50', 'Chrome', '2024-04-21 13:03:19', '2024-04-21 13:03:19'),
(86, '2001:4455:68a:9d00:1493:fe85:fc41:9d8e', 'Chrome', '2024-04-21 13:23:58', '2024-04-21 13:23:58'),
(87, '158.220.80.104', 'Chrome', '2024-04-21 13:35:05', '2024-04-21 13:35:05'),
(88, '66.249.79.233', 'Unknown', '2024-04-21 15:20:25', '2024-04-21 15:20:25'),
(89, '66.249.79.233', 'Chrome', '2024-04-21 15:20:26', '2024-04-21 15:20:26'),
(90, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-21 16:32:46', '2024-04-21 16:32:46'),
(91, '178.62.195.12', 'Chrome', '2024-04-21 21:31:30', '2024-04-21 21:31:30'),
(92, '52.41.69.140', 'Chrome', '2024-04-21 21:36:26', '2024-04-21 21:36:26'),
(93, '128.90.62.26', 'Chrome', '2024-04-21 22:21:22', '2024-04-21 22:21:22'),
(94, '43.153.110.177', 'Safari', '2024-04-21 23:34:14', '2024-04-21 23:34:14'),
(95, '170.106.101.31', 'Safari', '2024-04-22 03:04:03', '2024-04-22 03:04:03'),
(96, '2604:2dc0:100:55dd::', 'Chrome', '2024-04-22 03:22:29', '2024-04-22 03:22:29'),
(97, '2604:2dc0:100:55dd::', 'Chrome', '2024-04-22 03:22:29', '2024-04-22 03:22:29'),
(98, '2604:2dc0:100:4f07::', 'Chrome', '2024-04-22 03:29:56', '2024-04-22 03:29:56'),
(99, '2604:2dc0:100:4f07::', 'Chrome', '2024-04-22 03:29:57', '2024-04-22 03:29:57'),
(100, '43.130.37.62', 'Safari', '2024-04-22 08:47:38', '2024-04-22 08:47:38'),
(101, '2a03:b0c0:2:d0::fdb:9001', 'Chrome', '2024-04-22 10:03:44', '2024-04-22 10:03:44'),
(102, '2a03:b0c0:2:d0::fdb:9001', 'Chrome', '2024-04-22 10:03:44', '2024-04-22 10:03:44'),
(103, '43.135.166.178', 'Safari', '2024-04-22 14:02:11', '2024-04-22 14:02:11'),
(104, '39.173.116.7', 'Chrome', '2024-04-22 15:51:04', '2024-04-22 15:51:04'),
(105, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-22 16:32:46', '2024-04-22 16:32:46'),
(106, '69.167.30.19', 'Chrome', '2024-04-22 19:19:49', '2024-04-22 19:19:49'),
(107, '73.138.205.121', 'Unknown', '2024-04-22 19:36:15', '2024-04-22 19:36:15'),
(108, '73.138.205.121', 'Unknown', '2024-04-22 19:36:20', '2024-04-22 19:36:20'),
(109, '49.149.108.145', 'Chrome', '2024-04-22 20:59:54', '2024-04-22 20:59:54'),
(110, '2a03:2880:11ff:b::face:b00c', 'Unknown', '2024-04-22 21:14:16', '2024-04-22 21:14:16'),
(111, '43.133.38.182', 'Safari', '2024-04-22 22:48:34', '2024-04-22 22:48:34'),
(112, '43.131.248.209', 'Safari', '2024-04-22 23:43:37', '2024-04-22 23:43:37'),
(113, '43.131.48.214', 'Safari', '2024-04-23 02:39:37', '2024-04-23 02:39:37'),
(114, '23.22.35.162', 'Safari', '2024-04-23 05:32:10', '2024-04-23 05:32:10'),
(115, '23.22.35.162', 'Safari', '2024-04-23 05:32:48', '2024-04-23 05:32:48'),
(116, '23.22.35.162', 'Safari', '2024-04-23 05:32:52', '2024-04-23 05:32:52'),
(117, '23.22.35.162', 'Safari', '2024-04-23 05:32:54', '2024-04-23 05:32:54'),
(118, '23.22.35.162', 'Safari', '2024-04-23 05:33:00', '2024-04-23 05:33:00'),
(119, '23.22.35.162', 'Safari', '2024-04-23 05:33:16', '2024-04-23 05:33:16'),
(120, '23.22.35.162', 'Safari', '2024-04-23 05:34:04', '2024-04-23 05:34:04'),
(121, '23.22.35.162', 'Safari', '2024-04-23 05:34:36', '2024-04-23 05:34:36'),
(122, '23.22.35.162', 'Safari', '2024-04-23 05:35:00', '2024-04-23 05:35:00'),
(123, '23.22.35.162', 'Safari', '2024-04-23 05:35:17', '2024-04-23 05:35:17'),
(124, '23.22.35.162', 'Safari', '2024-04-23 05:35:24', '2024-04-23 05:35:24'),
(125, '23.22.35.162', 'Safari', '2024-04-23 05:35:40', '2024-04-23 05:35:40'),
(126, '23.22.35.162', 'Safari', '2024-04-23 05:35:57', '2024-04-23 05:35:57'),
(127, '135.148.195.15', 'Chrome', '2024-04-23 05:38:42', '2024-04-23 05:38:42'),
(128, '128.90.170.38', 'Firefox', '2024-04-23 09:38:55', '2024-04-23 09:38:55'),
(129, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-23 16:32:46', '2024-04-23 16:32:46'),
(130, '36.77.229.80', 'Chrome', '2024-04-23 16:53:37', '2024-04-23 16:53:37'),
(131, '73.138.205.121', 'Unknown', '2024-04-23 19:36:59', '2024-04-23 19:36:59'),
(132, '35.89.22.12', 'Chrome', '2024-04-23 19:39:34', '2024-04-23 19:39:34'),
(133, '165.227.128.57', 'Chrome', '2024-04-23 21:21:23', '2024-04-23 21:21:23'),
(134, '103.27.231.20', 'Chrome', '2024-04-23 21:33:11', '2024-04-23 21:33:11'),
(135, '103.27.231.20', 'Chrome', '2024-04-23 21:33:47', '2024-04-23 21:33:47'),
(136, '43.130.39.101', 'Safari', '2024-04-23 23:38:31', '2024-04-23 23:38:31'),
(137, '208.80.194.41', 'Unknown', '2024-04-24 03:47:46', '2024-04-24 03:47:46'),
(138, '66.249.79.233', 'Unknown', '2024-04-24 04:11:45', '2024-04-24 04:11:45'),
(139, '66.249.79.232', 'Chrome', '2024-04-24 04:11:59', '2024-04-24 04:11:59'),
(140, '45.128.163.88', 'Firefox', '2024-04-24 05:13:47', '2024-04-24 05:13:47'),
(141, '43.134.37.211', 'Safari', '2024-04-24 08:50:10', '2024-04-24 08:50:10'),
(142, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-24 16:32:46', '2024-04-24 16:32:46'),
(143, '73.138.205.121', 'Unknown', '2024-04-24 21:01:49', '2024-04-24 21:01:49'),
(144, '35.171.144.152', 'Chrome', '2024-04-24 22:29:43', '2024-04-24 22:29:43'),
(145, '35.171.144.152', 'Chrome', '2024-04-24 22:29:52', '2024-04-24 22:29:52'),
(146, '180.195.212.21', 'Chrome', '2024-04-24 23:01:37', '2024-04-24 23:01:37'),
(147, '43.130.37.62', 'Safari', '2024-04-24 23:38:50', '2024-04-24 23:38:50'),
(148, '43.159.141.180', 'Safari', '2024-04-25 02:51:47', '2024-04-25 02:51:47'),
(149, '35.171.144.152', 'Chrome', '2024-04-25 03:45:22', '2024-04-25 03:45:22'),
(150, '2a00:6800:3:b9e::1', 'Chrome', '2024-04-25 04:28:24', '2024-04-25 04:28:24'),
(151, '221.229.106.25', 'Safari', '2024-04-25 07:33:38', '2024-04-25 07:33:38'),
(152, '69.167.30.19', 'Chrome', '2024-04-25 07:36:40', '2024-04-25 07:36:40'),
(153, '43.130.31.48', 'Safari', '2024-04-25 08:58:14', '2024-04-25 08:58:14'),
(154, '5.133.192.212', 'Firefox', '2024-04-25 09:12:17', '2024-04-25 09:12:17'),
(155, '5.133.192.140', 'Chrome', '2024-04-25 10:57:53', '2024-04-25 10:57:53'),
(156, '66.249.79.4', 'Chrome', '2024-04-25 12:14:02', '2024-04-25 12:14:02'),
(157, '66.249.79.4', 'Chrome', '2024-04-25 12:14:03', '2024-04-25 12:14:03'),
(158, '66.249.79.3', 'Chrome', '2024-04-25 12:14:44', '2024-04-25 12:14:44'),
(159, '14.102.171.5', 'Chrome', '2024-04-25 12:27:13', '2024-04-25 12:27:13'),
(160, '172.59.25.116', 'Chrome', '2024-04-25 12:38:43', '2024-04-25 12:38:43'),
(161, '138.197.121.123', 'Chrome', '2024-04-25 13:40:45', '2024-04-25 13:40:45'),
(162, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-25 16:32:46', '2024-04-25 16:32:46'),
(163, '17.241.227.250', 'Safari', '2024-04-25 17:25:21', '2024-04-25 17:25:21'),
(164, '73.138.205.121', 'Unknown', '2024-04-25 19:38:47', '2024-04-25 19:38:47'),
(165, '46.101.127.48', 'Chrome', '2024-04-25 22:46:36', '2024-04-25 22:46:36'),
(166, '43.159.128.68', 'Safari', '2024-04-25 23:44:34', '2024-04-25 23:44:34'),
(167, '2a12:5940:5433::2', 'Safari', '2024-04-26 02:35:29', '2024-04-26 02:35:29'),
(168, '43.159.141.180', 'Safari', '2024-04-26 03:02:20', '2024-04-26 03:02:20'),
(169, '181.214.218.240', 'Chrome', '2024-04-26 03:31:29', '2024-04-26 03:31:29'),
(170, '66.249.79.32', 'Chrome', '2024-04-26 04:24:02', '2024-04-26 04:24:02'),
(171, '119.96.24.54', 'Safari', '2024-04-26 06:45:04', '2024-04-26 06:45:04'),
(172, '31.6.17.32', 'Chrome', '2024-04-26 10:12:41', '2024-04-26 10:12:41'),
(173, '195.88.252.196', 'Chrome', '2024-04-26 14:03:27', '2024-04-26 14:03:27'),
(174, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-26 14:22:34', '2024-04-26 14:22:34'),
(175, '2001:4456:162:3b00:218f:9329:3c15:da9b', 'Chrome', '2024-04-26 18:34:00', '2024-04-26 18:34:00'),
(176, '36.111.67.189', 'Safari', '2024-04-26 18:38:48', '2024-04-26 18:38:48'),
(177, '73.138.205.121', 'Unknown', '2024-04-26 19:40:02', '2024-04-26 19:40:02'),
(178, '14.102.171.5', 'Chrome', '2024-04-26 21:22:56', '2024-04-26 21:22:56'),
(179, '2001:4455:6da:f300:1093:84d0:ce06:b658', 'Chrome', '2024-04-26 21:29:59', '2024-04-26 21:29:59'),
(180, '2001:4456:c1a:cb00:7542:b043:5a0d:a8d0', 'Chrome', '2024-04-26 21:40:08', '2024-04-26 21:40:08'),
(181, '14.102.171.5', 'Chrome', '2024-04-26 22:06:19', '2024-04-26 22:06:19'),
(182, '2001:4456:c46:bc00:64ff:85d8:52a6:7b7d', 'Chrome', '2024-04-26 22:15:10', '2024-04-26 22:15:10'),
(183, '2001:4456:c46:bc00:64ff:85d8:52a6:7b7d', 'Chrome', '2024-04-26 22:18:35', '2024-04-26 22:18:35'),
(184, '2001:4456:c46:bc00:64ff:85d8:52a6:7b7d', 'Chrome', '2024-04-26 22:32:11', '2024-04-26 22:32:11'),
(185, '2001:4456:c46:bc00:64ff:85d8:52a6:7b7d', 'Chrome', '2024-04-26 22:56:10', '2024-04-26 22:56:10'),
(186, '43.130.7.211', 'Safari', '2024-04-26 23:40:00', '2024-04-26 23:40:00'),
(187, '137.226.113.44', 'Unknown', '2024-04-26 23:40:47', '2024-04-26 23:40:47'),
(188, '137.226.113.44', 'Unknown', '2024-04-26 23:40:48', '2024-04-26 23:40:48'),
(189, '2a03:2880:ff:a::face:b00c', 'Unknown', '2024-04-27 00:42:28', '2024-04-27 00:42:28'),
(190, '2001:4455:6da:f300:1093:84d0:ce06:b658', 'Chrome', '2024-04-27 02:06:44', '2024-04-27 02:06:44'),
(191, '14.102.171.5', 'Chrome', '2024-04-27 02:12:10', '2024-04-27 02:12:10'),
(192, '2001:4456:c1a:cb00:9936:1758:b4e6:269f', 'Chrome', '2024-04-27 02:19:21', '2024-04-27 02:19:21'),
(193, '2001:4456:c1a:cb00:9936:1758:b4e6:269f', 'Chrome', '2024-04-27 02:31:02', '2024-04-27 02:31:02'),
(194, '2001:4456:c1a:cb00:9936:1758:b4e6:269f', 'Chrome', '2024-04-27 02:35:12', '2024-04-27 02:35:12'),
(195, '2001:4456:c1a:cb00:9936:1758:b4e6:269f', 'Chrome', '2024-04-27 02:41:35', '2024-04-27 02:41:35'),
(196, '2001:4456:c1a:cb00:9936:1758:b4e6:269f', 'Chrome', '2024-04-27 07:42:50', '2024-04-27 07:42:50'),
(197, '43.153.110.177', 'Safari', '2024-04-27 08:48:27', '2024-04-27 08:48:27'),
(198, '43.130.37.62', 'Safari', '2024-04-27 10:42:14', '2024-04-27 10:42:14'),
(199, '175.176.85.65', 'Chrome', '2024-04-27 10:51:07', '2024-04-27 10:51:07'),
(200, '2a12:5940:5433::2', 'Chrome', '2024-04-27 10:54:19', '2024-04-27 10:54:19'),
(201, '103.27.231.28', 'Chrome', '2024-04-27 13:37:45', '2024-04-27 13:37:45'),
(202, '103.27.231.28', 'Chrome', '2024-04-27 13:37:59', '2024-04-27 13:37:59'),
(203, '2001:4456:c90:7f00:54f2:9a34:7136:3b78', 'Chrome', '2024-04-27 14:22:03', '2024-04-27 14:22:03'),
(204, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-27 14:22:34', '2024-04-27 14:22:34'),
(205, '2001:4456:c90:7f00:c8fc:bb95:4f93:5a05', 'Chrome', '2024-04-27 15:09:24', '2024-04-27 15:09:24'),
(206, '161.35.139.80', 'Chrome', '2024-04-27 20:55:07', '2024-04-27 20:55:07'),
(207, '43.153.110.177', 'Safari', '2024-04-27 23:45:53', '2024-04-27 23:45:53'),
(208, '2001:4456:c75:4f00:a06e:6f54:b295:ee24', 'Chrome', '2024-04-28 01:01:09', '2024-04-28 01:01:09'),
(209, '2001:4456:c75:4f00:a06e:6f54:b295:ee24', 'Chrome', '2024-04-28 01:05:10', '2024-04-28 01:05:10'),
(210, '43.130.37.62', 'Safari', '2024-04-28 02:55:32', '2024-04-28 02:55:32'),
(211, '2a12:5940:5433::2', 'Chrome', '2024-04-28 04:56:52', '2024-04-28 04:56:52'),
(212, '43.135.166.178', 'Safari', '2024-04-28 08:50:59', '2024-04-28 08:50:59'),
(213, '2001:4456:c90:7f00:b4a9:3d9c:168e:1d1e', 'Chrome', '2024-04-28 10:37:53', '2024-04-28 10:37:53'),
(214, '2001:4456:c90:7f00:69ab:117d:4744:3aa4', 'Chrome', '2024-04-28 10:38:00', '2024-04-28 10:38:00'),
(215, '209.97.130.59', 'Chrome', '2024-04-28 11:07:45', '2024-04-28 11:07:45'),
(216, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-28 12:11:18', '2024-04-28 12:11:18'),
(217, '31.6.17.32', 'Chrome', '2024-04-28 12:12:18', '2024-04-28 12:12:18'),
(218, '2a03:2880:13ff:f::face:b00c', 'Unknown', '2024-04-28 14:08:26', '2024-04-28 14:08:26'),
(219, '27.122.12.153', 'Chrome', '2024-04-28 14:54:58', '2024-04-28 14:54:58'),
(220, '27.122.12.153', 'Chrome', '2024-04-28 14:59:31', '2024-04-28 14:59:31'),
(221, '49.149.110.224', 'Chrome', '2024-04-28 15:21:15', '2024-04-28 15:21:15'),
(222, '49.149.110.224', 'Chrome', '2024-04-28 15:41:45', '2024-04-28 15:41:45'),
(223, '14.102.171.5', 'Chrome', '2024-04-28 16:15:11', '2024-04-28 16:15:11'),
(224, '2600:1900:2000:a7::1:1900', 'Chrome', '2024-04-28 17:37:58', '2024-04-28 17:37:58'),
(225, '203.177.59.200', 'Chrome', '2024-04-28 21:21:30', '2024-04-28 21:21:30'),
(226, '2001:4456:c75:4f00:69ab:117d:4744:3aa4', 'Chrome', '2024-04-28 22:04:15', '2024-04-28 22:04:15'),
(227, '2001:4456:c8f:8500:84f3:ba79:9b1d:a320', 'Chrome', '2024-04-28 22:04:17', '2024-04-28 22:04:17'),
(228, '170.106.101.31', 'Safari', '2024-04-28 23:53:11', '2024-04-28 23:53:11'),
(229, '2001:4455:652:3000:24bd:86a:4562:7053', 'Chrome', '2024-04-29 01:43:31', '2024-04-29 01:43:31'),
(230, '203.177.59.200', 'Chrome', '2024-04-29 02:03:57', '2024-04-29 02:03:57'),
(231, '43.133.38.182', 'Safari', '2024-04-29 02:43:24', '2024-04-29 02:43:24'),
(232, '43.133.72.69', 'Safari', '2024-04-29 03:56:59', '2024-04-29 03:56:59'),
(233, '185.236.23.131', 'Unknown', '2024-04-29 05:35:23', '2024-04-29 05:35:23'),
(234, '185.236.23.131', 'Unknown', '2024-04-29 05:35:23', '2024-04-29 05:35:23'),
(235, '15.236.239.210', 'Chrome', '2024-04-29 05:38:52', '2024-04-29 05:38:52'),
(236, '128.90.174.243', 'Chrome', '2024-04-29 05:40:41', '2024-04-29 05:40:41'),
(237, '31.6.17.32', 'Chrome', '2024-04-29 09:20:53', '2024-04-29 09:20:53'),
(238, '170.106.104.42', 'Safari', '2024-04-29 10:49:40', '2024-04-29 10:49:40'),
(239, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-29 12:11:18', '2024-04-29 12:11:18'),
(240, '2a12:5940:5433::2', 'Chrome', '2024-04-29 13:02:38', '2024-04-29 13:02:38'),
(241, '66.249.70.68', 'Chrome', '2024-04-29 18:28:46', '2024-04-29 18:28:46'),
(242, '142.93.191.98', 'Unknown', '2024-04-29 19:36:56', '2024-04-29 19:36:56'),
(243, '207.237.190.136', 'Unknown', '2024-04-29 20:01:36', '2024-04-29 20:01:36'),
(244, '207.237.190.136', 'Unknown', '2024-04-29 20:25:25', '2024-04-29 20:25:25'),
(245, '143.198.51.166', 'Chrome', '2024-04-29 22:30:39', '2024-04-29 22:30:39'),
(246, '43.131.48.214', 'Safari', '2024-04-30 00:24:55', '2024-04-30 00:24:55'),
(247, '66.249.70.68', 'Unknown', '2024-04-30 01:14:43', '2024-04-30 01:14:43'),
(248, '66.249.70.67', 'Chrome', '2024-04-30 01:14:44', '2024-04-30 01:14:44'),
(249, '43.130.7.211', 'Safari', '2024-04-30 03:00:50', '2024-04-30 03:00:50'),
(250, '38.122.112.147', 'Firefox', '2024-04-30 05:13:15', '2024-04-30 05:13:15'),
(251, '146.247.229.2', 'Chrome', '2024-04-30 06:22:57', '2024-04-30 06:22:57'),
(252, '128.90.62.21', 'Chrome', '2024-04-30 06:55:01', '2024-04-30 06:55:01'),
(253, '93.159.230.87', 'Chrome', '2024-04-30 07:03:06', '2024-04-30 07:03:06'),
(254, '2a12:5940:5433::2', 'Chrome', '2024-04-30 08:25:35', '2024-04-30 08:25:35'),
(255, '35.201.31.3', 'Unknown', '2024-04-30 10:16:44', '2024-04-30 10:16:44'),
(256, '2a02:4780:11:c0de::21', 'Unknown', '2024-04-30 12:11:18', '2024-04-30 12:11:18'),
(257, '135.148.195.9', 'Chrome', '2024-04-30 14:47:44', '2024-04-30 14:47:44'),
(258, '66.249.70.109', 'Chrome', '2024-04-30 16:02:16', '2024-04-30 16:02:16'),
(259, '2a03:2880:12ff:78::face:b00c', 'Unknown', '2024-04-30 17:40:35', '2024-04-30 17:40:35'),
(260, '2a03:2880:ff:f::face:b00c', 'Chrome', '2024-04-30 17:40:37', '2024-04-30 17:40:37'),
(261, '2a03:2880:20ff:3::face:b00c', 'Unknown', '2024-04-30 17:41:12', '2024-04-30 17:41:12'),
(262, '207.237.190.136', 'Unknown', '2024-04-30 19:53:14', '2024-04-30 19:53:14'),
(263, '2001:4455:652:3000:7d62:5fbc:f769:9d7e', 'Chrome', '2024-04-30 22:07:12', '2024-04-30 22:07:12'),
(264, '2001:4455:652:3000:7d62:5fbc:f769:9d7e', 'Chrome', '2024-04-30 22:07:54', '2024-04-30 22:07:54'),
(265, '2001:4455:652:3000:7d62:5fbc:f769:9d7e', 'Chrome', '2024-04-30 22:08:58', '2024-04-30 22:08:58'),
(266, '43.135.181.13', 'Safari', '2024-04-30 23:52:47', '2024-04-30 23:52:47'),
(267, '43.130.47.136', 'Safari', '2024-05-01 03:04:26', '2024-05-01 03:04:26'),
(268, '111.7.96.155', 'Chrome', '2024-05-01 03:06:00', '2024-05-01 03:06:00'),
(269, '111.7.96.155', 'Chrome', '2024-05-01 03:06:02', '2024-05-01 03:06:02'),
(270, '45.128.163.88', 'Firefox', '2024-05-01 05:50:32', '2024-05-01 05:50:32'),
(271, '5.133.192.87', 'Chrome', '2024-05-01 06:25:28', '2024-05-01 06:25:28'),
(272, '208.80.194.42', 'Unknown', '2024-05-01 06:38:45', '2024-05-01 06:38:45'),
(273, '42.83.147.34', 'Chrome', '2024-05-01 06:46:13', '2024-05-01 06:46:13'),
(274, '43.133.66.151', 'Safari', '2024-05-01 09:10:02', '2024-05-01 09:10:02'),
(275, '207.237.190.136', 'Unknown', '2024-05-01 10:26:04', '2024-05-01 10:26:04'),
(276, '43.130.31.48', 'Safari', '2024-05-01 11:09:26', '2024-05-01 11:09:26'),
(277, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-01 12:11:18', '2024-05-01 12:11:18'),
(278, '207.237.190.136', 'Unknown', '2024-05-01 17:53:41', '2024-05-01 17:53:41'),
(279, '66.249.79.4', 'Chrome', '2024-05-01 19:54:38', '2024-05-01 19:54:38'),
(280, '66.249.79.4', 'Chrome', '2024-05-01 21:24:30', '2024-05-01 21:24:30'),
(281, '66.249.79.5', 'Chrome', '2024-05-01 21:24:31', '2024-05-01 21:24:31'),
(282, '66.249.79.3', 'Chrome', '2024-05-01 21:24:35', '2024-05-01 21:24:35'),
(283, '138.68.175.169', 'Chrome', '2024-05-01 21:28:40', '2024-05-01 21:28:40'),
(284, '43.130.47.136', 'Safari', '2024-05-01 23:44:19', '2024-05-01 23:44:19'),
(285, '43.133.38.182', 'Safari', '2024-05-02 02:50:49', '2024-05-02 02:50:49'),
(286, '81.181.56.109', 'Chrome', '2024-05-02 04:33:13', '2024-05-02 04:33:13'),
(287, '2a12:5940:5433::2', 'Chrome', '2024-05-02 08:46:39', '2024-05-02 08:46:39'),
(288, '43.135.129.233', 'Safari', '2024-05-02 09:45:01', '2024-05-02 09:45:01'),
(289, '43.153.110.177', 'Safari', '2024-05-02 10:54:50', '2024-05-02 10:54:50'),
(290, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-02 12:11:18', '2024-05-02 12:11:18'),
(291, '207.237.190.136', 'Unknown', '2024-05-02 19:44:27', '2024-05-02 19:44:27'),
(292, '43.155.152.154', 'Safari', '2024-05-02 20:40:01', '2024-05-02 20:40:01'),
(293, '185.255.114.28', 'Unknown', '2024-05-03 00:20:23', '2024-05-03 00:20:23'),
(294, '2001:8d8:97a:3300::7b:a343', 'Chrome', '2024-05-03 02:11:19', '2024-05-03 02:11:19'),
(295, '43.159.128.172', 'Safari', '2024-05-03 03:11:54', '2024-05-03 03:11:54'),
(296, '34.243.252.167', 'Unknown', '2024-05-03 03:19:50', '2024-05-03 03:19:50'),
(297, '2a12:5940:5433::2', 'Chrome', '2024-05-03 04:12:19', '2024-05-03 04:12:19'),
(298, '43.159.128.68', 'Safari', '2024-05-03 10:58:40', '2024-05-03 10:58:40'),
(299, '69.167.30.19', 'Chrome', '2024-05-03 11:11:23', '2024-05-03 11:11:23'),
(300, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-03 12:11:18', '2024-05-03 12:11:18'),
(301, '207.237.190.136', 'Unknown', '2024-05-03 19:24:44', '2024-05-03 19:24:44'),
(302, '52.11.136.93', 'Chrome', '2024-05-03 21:41:55', '2024-05-03 21:41:55'),
(303, '134.122.33.91', 'Chrome', '2024-05-03 22:36:22', '2024-05-03 22:36:22'),
(304, '137.226.113.44', 'Unknown', '2024-05-03 23:35:12', '2024-05-03 23:35:12'),
(305, '137.226.113.44', 'Unknown', '2024-05-03 23:35:13', '2024-05-03 23:35:13'),
(306, '43.130.31.48', 'Safari', '2024-05-03 23:37:46', '2024-05-03 23:37:46'),
(307, '2a00:6800:3:78a::1', 'Chrome', '2024-05-04 02:08:56', '2024-05-04 02:08:56'),
(308, '43.159.128.68', 'Safari', '2024-05-04 04:00:30', '2024-05-04 04:00:30'),
(309, '2a12:5940:5433::2', 'Safari', '2024-05-04 08:52:21', '2024-05-04 08:52:21'),
(310, '43.130.62.164', 'Safari', '2024-05-04 11:21:12', '2024-05-04 11:21:12'),
(311, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-04 12:11:18', '2024-05-04 12:11:18'),
(312, '43.153.210.150', 'Chrome', '2024-05-04 15:57:35', '2024-05-04 15:57:35'),
(313, '192.3.215.248', 'Chrome', '2024-05-04 20:09:33', '2024-05-04 20:09:33'),
(314, '43.131.248.209', 'Safari', '2024-05-04 23:34:10', '2024-05-04 23:34:10'),
(315, '66.249.79.33', 'Chrome', '2024-05-05 01:14:04', '2024-05-05 01:14:04'),
(316, '2607:5300:60:7e27::1', 'Chrome', '2024-05-05 07:49:45', '2024-05-05 07:49:45'),
(317, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-05 09:11:53', '2024-05-05 09:11:53'),
(318, '36.99.136.129', 'Chrome', '2024-05-05 09:16:12', '2024-05-05 09:16:12'),
(319, '43.153.110.177', 'Safari', '2024-05-05 11:00:03', '2024-05-05 11:00:03'),
(320, '2a12:5940:5433::2', 'Chrome', '2024-05-05 12:26:20', '2024-05-05 12:26:20'),
(321, '69.167.30.19', 'Chrome', '2024-05-05 16:54:23', '2024-05-05 16:54:23'),
(322, '43.159.128.172', 'Safari', '2024-05-05 20:20:09', '2024-05-05 20:20:09'),
(323, '138.68.78.188', 'Chrome', '2024-05-05 21:49:18', '2024-05-05 21:49:18'),
(324, '43.157.40.112', 'Safari', '2024-05-06 00:10:44', '2024-05-06 00:10:44'),
(325, '43.135.149.154', 'Safari', '2024-05-06 03:16:57', '2024-05-06 03:16:57'),
(326, '49.149.109.210', 'Chrome', '2024-05-06 03:45:11', '2024-05-06 03:45:11'),
(327, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-06 09:11:52', '2024-05-06 09:11:52'),
(328, '2a12:5940:5433::2', 'Chrome', '2024-05-06 10:31:28', '2024-05-06 10:31:28'),
(329, '43.159.128.172', 'Safari', '2024-05-06 10:58:54', '2024-05-06 10:58:54'),
(330, '42.83.147.53', 'Chrome', '2024-05-06 16:30:21', '2024-05-06 16:30:21'),
(331, '2001:4455:6e1:4200:a5ee:a74e:d738:f3ec', 'Chrome', '2024-05-06 19:58:58', '2024-05-06 19:58:58'),
(332, '35.171.144.152', 'Chrome', '2024-05-06 21:34:51', '2024-05-06 21:34:51'),
(333, '73.138.205.121', 'Unknown', '2024-05-06 21:45:39', '2024-05-06 21:45:39'),
(334, '170.106.159.160', 'Safari', '2024-05-06 23:48:06', '2024-05-06 23:48:06'),
(335, '51.222.88.214', 'Unknown', '2024-05-07 01:22:17', '2024-05-07 01:22:17'),
(336, '5.133.192.88', 'Chrome', '2024-05-07 02:16:09', '2024-05-07 02:16:09'),
(337, '135.148.195.12', 'Chrome', '2024-05-07 02:33:52', '2024-05-07 02:33:52'),
(338, '2a12:5940:5433::2', 'Chrome', '2024-05-07 03:35:15', '2024-05-07 03:35:15'),
(339, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-07 09:11:52', '2024-05-07 09:11:52'),
(340, '43.135.129.233', 'Safari', '2024-05-07 09:12:11', '2024-05-07 09:12:11'),
(341, '49.51.206.130', 'Safari', '2024-05-07 11:03:30', '2024-05-07 11:03:30'),
(342, '34.174.90.147', 'Chrome', '2024-05-07 14:59:39', '2024-05-07 14:59:39'),
(343, '2a01:4f9:c012:4941::1', 'Unknown', '2024-05-07 17:16:17', '2024-05-07 17:16:17'),
(344, '73.138.205.121', 'Unknown', '2024-05-07 19:52:45', '2024-05-07 19:52:45'),
(345, '111.7.96.160', 'Chrome', '2024-05-07 21:08:02', '2024-05-07 21:08:02'),
(346, '54.191.166.233', 'Chrome', '2024-05-07 21:23:09', '2024-05-07 21:23:09'),
(347, '18.236.107.154', 'Chrome', '2024-05-07 21:23:18', '2024-05-07 21:23:18'),
(348, '43.134.89.111', 'Safari', '2024-05-07 22:39:50', '2024-05-07 22:39:50'),
(349, '67.205.162.7', 'Chrome', '2024-05-07 22:56:42', '2024-05-07 22:56:42'),
(350, '43.153.110.177', 'Safari', '2024-05-07 23:41:09', '2024-05-07 23:41:09'),
(351, '122.176.197.201', 'Safari', '2024-05-08 02:14:41', '2024-05-08 02:14:41'),
(352, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-08 09:11:52', '2024-05-08 09:11:52'),
(353, '43.135.149.154', 'Safari', '2024-05-08 09:18:23', '2024-05-08 09:18:23'),
(354, '43.130.39.101', 'Safari', '2024-05-08 11:04:12', '2024-05-08 11:04:12'),
(355, '36.99.136.137', 'Chrome', '2024-05-08 11:58:44', '2024-05-08 11:58:44'),
(356, '2a12:5940:5433::2', 'Chrome', '2024-05-08 13:31:37', '2024-05-08 13:31:37'),
(357, '43.135.129.233', 'Safari', '2024-05-08 18:56:07', '2024-05-08 18:56:07'),
(358, '2001:fd8:2678:31a7:17cd:57dc:9f24:800e', 'Chrome', '2024-05-08 19:44:57', '2024-05-08 19:44:57'),
(359, '66.249.79.233', 'Chrome', '2024-05-08 22:16:20', '2024-05-08 22:16:20'),
(360, '43.135.129.233', 'Safari', '2024-05-08 23:33:49', '2024-05-08 23:33:49'),
(361, '73.138.205.121', 'Unknown', '2024-05-09 01:30:21', '2024-05-09 01:30:21'),
(362, '43.131.248.209', 'Safari', '2024-05-09 02:54:33', '2024-05-09 02:54:33'),
(363, '42.83.147.53', 'Chrome', '2024-05-09 04:54:58', '2024-05-09 04:54:58'),
(364, '2a06:4880:5000::5d', 'Unknown', '2024-05-09 05:09:22', '2024-05-09 05:09:22'),
(365, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-09 09:11:52', '2024-05-09 09:11:52'),
(366, '43.131.62.4', 'Safari', '2024-05-09 11:15:26', '2024-05-09 11:15:26'),
(367, '2a12:5940:5433::2', 'Chrome', '2024-05-09 13:06:33', '2024-05-09 13:06:33'),
(368, '31.6.17.31', 'Chrome', '2024-05-09 13:16:22', '2024-05-09 13:16:22'),
(369, '143.110.215.143', 'Chrome', '2024-05-09 14:15:09', '2024-05-09 14:15:09'),
(370, '165.22.29.157', 'Chrome', '2024-05-09 16:35:43', '2024-05-09 16:35:43'),
(371, '35.89.56.146', 'Chrome', '2024-05-09 19:12:42', '2024-05-09 19:12:42'),
(372, '35.89.67.195', 'Chrome', '2024-05-09 19:12:45', '2024-05-09 19:12:45'),
(373, '73.138.205.121', 'Unknown', '2024-05-09 21:00:51', '2024-05-09 21:00:51'),
(374, '180.195.208.248', 'Chrome', '2024-05-09 21:37:47', '2024-05-09 21:37:47'),
(375, '2a03:2880:11ff:f::face:b00c', 'Unknown', '2024-05-09 21:40:24', '2024-05-09 21:40:24'),
(376, '43.133.38.182', 'Safari', '2024-05-09 23:39:49', '2024-05-09 23:39:49'),
(377, '139.59.21.247', 'Chrome', '2024-05-09 23:43:07', '2024-05-09 23:43:07'),
(378, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-10 09:11:52', '2024-05-10 09:11:52'),
(379, '170.106.101.31', 'Safari', '2024-05-10 12:32:04', '2024-05-10 12:32:04'),
(380, '138.246.253.15', 'Unknown', '2024-05-10 16:29:05', '2024-05-10 16:29:05'),
(381, '66.249.79.3', 'Chrome', '2024-05-10 20:22:28', '2024-05-10 20:22:28'),
(382, '66.249.79.4', 'Unknown', '2024-05-10 20:22:29', '2024-05-10 20:22:29'),
(383, '43.134.89.111', 'Safari', '2024-05-10 22:27:12', '2024-05-10 22:27:12'),
(384, '137.226.113.44', 'Unknown', '2024-05-10 23:21:54', '2024-05-10 23:21:54'),
(385, '137.226.113.44', 'Unknown', '2024-05-10 23:21:55', '2024-05-10 23:21:55'),
(386, '43.159.141.180', 'Safari', '2024-05-10 23:47:13', '2024-05-10 23:47:13'),
(387, '209.97.151.183', 'Unknown', '2024-05-11 01:23:45', '2024-05-11 01:23:45'),
(388, '167.99.207.201', 'Unknown', '2024-05-11 01:30:26', '2024-05-11 01:30:26'),
(389, '134.209.203.77', 'Unknown', '2024-05-11 01:49:12', '2024-05-11 01:49:12'),
(390, '43.159.141.180', 'Safari', '2024-05-11 03:14:48', '2024-05-11 03:14:48'),
(391, '66.249.79.33', 'Chrome', '2024-05-11 05:39:18', '2024-05-11 05:39:18'),
(392, '159.65.55.191', 'Chrome', '2024-05-11 07:08:01', '2024-05-11 07:08:01'),
(393, '66.249.79.4', 'Chrome', '2024-05-11 07:41:16', '2024-05-11 07:41:16'),
(394, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-11 09:11:52', '2024-05-11 09:11:52'),
(395, '37.19.223.250', 'Chrome', '2024-05-11 12:04:35', '2024-05-11 12:04:35'),
(396, '43.159.141.180', 'Safari', '2024-05-11 14:12:00', '2024-05-11 14:12:00'),
(397, '43.135.149.154', 'Safari', '2024-05-11 14:55:47', '2024-05-11 14:55:47'),
(398, '64.23.169.137', 'Chrome', '2024-05-11 14:59:09', '2024-05-11 14:59:09'),
(399, '2a00:6800:3:b78::1', 'Chrome', '2024-05-11 16:34:59', '2024-05-11 16:34:59'),
(400, '159.223.233.152', 'Chrome', '2024-05-11 17:15:02', '2024-05-11 17:15:02'),
(401, '165.22.123.242', 'Chrome', '2024-05-11 18:52:18', '2024-05-11 18:52:18'),
(402, '54.213.245.91', 'Chrome', '2024-05-11 20:16:34', '2024-05-11 20:16:34'),
(403, '35.163.70.62', 'Chrome', '2024-05-11 20:42:07', '2024-05-11 20:42:07'),
(404, '142.93.179.131', 'Chrome', '2024-05-11 22:00:11', '2024-05-11 22:00:11'),
(405, '104.131.78.52', 'Chrome', '2024-05-11 22:27:50', '2024-05-11 22:27:50'),
(406, '138.68.183.198', 'Chrome', '2024-05-11 22:35:01', '2024-05-11 22:35:01'),
(407, '43.159.141.180', 'Safari', '2024-05-11 22:36:24', '2024-05-11 22:36:24'),
(408, '142.93.179.139', 'Chrome', '2024-05-11 23:17:15', '2024-05-11 23:17:15'),
(409, '159.223.233.152', 'Chrome', '2024-05-12 01:26:10', '2024-05-12 01:26:10'),
(410, '161.35.137.225', 'Chrome', '2024-05-12 03:00:37', '2024-05-12 03:00:37'),
(411, '165.232.139.125', 'Chrome', '2024-05-12 03:09:31', '2024-05-12 03:09:31'),
(412, '209.38.130.231', 'Chrome', '2024-05-12 03:45:46', '2024-05-12 03:45:46'),
(413, '66.249.82.101', 'Chrome', '2024-05-12 04:20:13', '2024-05-12 04:20:13'),
(414, '2001:4ca0:108:42::15', 'Unknown', '2024-05-12 06:55:28', '2024-05-12 06:55:28'),
(415, '64.227.39.7', 'Chrome', '2024-05-12 09:32:21', '2024-05-12 09:32:21'),
(416, '170.106.159.160', 'Safari', '2024-05-12 11:46:06', '2024-05-12 11:46:06'),
(417, '192.36.109.129', 'Chrome', '2024-05-12 14:00:32', '2024-05-12 14:00:32'),
(418, '66.249.79.4', 'Chrome', '2024-05-12 17:33:10', '2024-05-12 17:33:10'),
(419, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-12 17:48:21', '2024-05-12 17:48:21'),
(420, '35.95.56.130', 'Unknown', '2024-05-12 19:20:14', '2024-05-12 19:20:14'),
(421, '43.131.248.209', 'Safari', '2024-05-12 21:36:41', '2024-05-12 21:36:41'),
(422, '5.133.192.171', 'Chrome', '2024-05-12 23:56:55', '2024-05-12 23:56:55'),
(423, '49.51.179.103', 'Safari', '2024-05-12 23:56:59', '2024-05-12 23:56:59'),
(424, '192.154.207.58', 'Firefox', '2024-05-13 00:29:13', '2024-05-13 00:29:13'),
(425, '66.249.79.5', 'Chrome', '2024-05-13 05:33:53', '2024-05-13 05:33:53'),
(426, '66.249.79.4', 'Chrome', '2024-05-13 07:34:26', '2024-05-13 07:34:26'),
(427, '43.133.38.182', 'Safari', '2024-05-13 09:02:19', '2024-05-13 09:02:19'),
(428, '182.42.105.85', 'Safari', '2024-05-13 09:36:31', '2024-05-13 09:36:31'),
(429, '43.131.48.214', 'Safari', '2024-05-13 11:09:47', '2024-05-13 11:09:47'),
(430, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-13 17:48:21', '2024-05-13 17:48:21'),
(431, '34.217.127.56', 'Chrome', '2024-05-13 19:48:43', '2024-05-13 19:48:43'),
(432, '35.90.208.246', 'Chrome', '2024-05-13 19:48:45', '2024-05-13 19:48:45'),
(433, '43.159.128.149', 'Safari', '2024-05-13 20:00:48', '2024-05-13 20:00:48'),
(434, '162.243.165.15', 'Chrome', '2024-05-13 22:10:54', '2024-05-13 22:10:54'),
(435, '43.134.89.111', 'Safari', '2024-05-13 23:56:48', '2024-05-13 23:56:48'),
(436, '135.148.195.9', 'Firefox', '2024-05-14 04:08:59', '2024-05-14 04:08:59'),
(437, '93.159.230.87', 'Chrome', '2024-05-14 07:08:30', '2024-05-14 07:08:30'),
(438, '52.176.165.162', 'Firefox', '2024-05-14 07:46:25', '2024-05-14 07:46:25'),
(439, '37.19.223.120', 'Chrome', '2024-05-14 13:44:02', '2024-05-14 13:44:02'),
(440, '2.57.122.148', 'Chrome', '2024-05-14 16:09:07', '2024-05-14 16:09:07'),
(441, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-14 17:48:21', '2024-05-14 17:48:21'),
(442, '43.157.66.187', 'Safari', '2024-05-15 00:27:35', '2024-05-15 00:27:35'),
(443, '66.249.79.5', 'Unknown', '2024-05-15 08:32:07', '2024-05-15 08:32:07'),
(444, '43.155.152.154', 'Safari', '2024-05-15 08:56:13', '2024-05-15 08:56:13'),
(445, '43.134.89.111', 'Safari', '2024-05-15 10:44:03', '2024-05-15 10:44:03'),
(446, '43.135.149.154', 'Safari', '2024-05-15 17:42:34', '2024-05-15 17:42:34'),
(447, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-15 17:48:21', '2024-05-15 17:48:21'),
(448, '45.128.163.88', 'Firefox', '2024-05-15 19:03:03', '2024-05-15 19:03:03'),
(449, '164.90.206.193', 'Chrome', '2024-05-15 22:00:34', '2024-05-15 22:00:34'),
(450, '73.138.205.121', 'Unknown', '2024-05-15 22:32:06', '2024-05-15 22:32:06'),
(451, '43.131.248.209', 'Safari', '2024-05-16 00:11:24', '2024-05-16 00:11:24'),
(452, '122.180.183.21', 'Chrome', '2024-05-16 02:56:23', '2024-05-16 02:56:23'),
(453, '43.159.128.68', 'Safari', '2024-05-16 03:28:34', '2024-05-16 03:28:34'),
(454, '43.155.152.154', 'Safari', '2024-05-16 05:34:04', '2024-05-16 05:34:04'),
(455, '122.180.183.21', 'Chrome', '2024-05-16 05:39:11', '2024-05-16 05:39:11'),
(456, '72.13.46.2', 'Unknown', '2024-05-16 09:34:38', '2024-05-16 09:34:38'),
(457, '182.44.10.67', 'Safari', '2024-05-16 17:33:16', '2024-05-16 17:33:16'),
(458, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-16 17:48:21', '2024-05-16 17:48:21'),
(459, '174.176.25.43', 'Unknown', '2024-05-16 19:48:02', '2024-05-16 19:48:02'),
(460, '43.135.181.13', 'Safari', '2024-05-17 05:54:21', '2024-05-17 05:54:21'),
(461, '66.249.79.34', 'Chrome', '2024-05-17 07:56:50', '2024-05-17 07:56:50'),
(462, '170.106.159.160', 'Safari', '2024-05-17 09:18:07', '2024-05-17 09:18:07'),
(463, '43.251.164.63', 'Chrome', '2024-05-17 10:11:52', '2024-05-17 10:11:52'),
(464, '43.153.216.189', 'Safari', '2024-05-17 11:04:14', '2024-05-17 11:04:14'),
(465, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-17 17:48:21', '2024-05-17 17:48:21'),
(466, '182.40.104.255', 'Safari', '2024-05-17 18:07:00', '2024-05-17 18:07:00'),
(467, '35.165.215.140', 'Unknown', '2024-05-17 18:44:55', '2024-05-17 18:44:55'),
(468, '35.165.215.140', 'Unknown', '2024-05-17 18:44:55', '2024-05-17 18:44:55'),
(469, '35.165.215.140', 'Chrome', '2024-05-17 18:44:56', '2024-05-17 18:44:56'),
(470, '18.236.74.131', 'Chrome', '2024-05-17 19:23:26', '2024-05-17 19:23:26'),
(471, '138.246.253.15', 'Unknown', '2024-05-17 19:35:02', '2024-05-17 19:35:02'),
(472, '37.19.223.120', 'Chrome', '2024-05-17 19:42:15', '2024-05-17 19:42:15'),
(473, '174.176.25.43', 'Unknown', '2024-05-17 19:45:05', '2024-05-17 19:45:05'),
(474, '161.35.39.120', 'Chrome', '2024-05-17 20:25:36', '2024-05-17 20:25:36'),
(475, '137.226.113.44', 'Unknown', '2024-05-17 23:22:28', '2024-05-17 23:22:28'),
(476, '137.226.113.44', 'Unknown', '2024-05-17 23:22:28', '2024-05-17 23:22:28'),
(477, '43.135.149.154', 'Safari', '2024-05-18 00:10:02', '2024-05-18 00:10:02'),
(478, '209.95.169.110', 'Safari', '2024-05-18 01:15:22', '2024-05-18 01:15:22'),
(479, '206.204.47.56', 'Safari', '2024-05-18 01:15:32', '2024-05-18 01:15:32'),
(480, '43.133.66.151', 'Safari', '2024-05-18 03:11:37', '2024-05-18 03:11:37'),
(481, '43.155.152.154', 'Safari', '2024-05-18 09:28:55', '2024-05-18 09:28:55'),
(482, '43.130.31.48', 'Safari', '2024-05-18 11:50:38', '2024-05-18 11:50:38'),
(483, '38.122.112.147', 'Firefox', '2024-05-18 15:00:32', '2024-05-18 15:00:32'),
(484, '31.6.17.38', 'Chrome', '2024-05-18 15:33:48', '2024-05-18 15:33:48'),
(485, '2a03:b0c0:2:d0::10fd:3001', 'Chrome', '2024-05-18 17:02:20', '2024-05-18 17:02:20'),
(486, '2a03:b0c0:2:d0::1773:1001', 'Chrome', '2024-05-18 17:02:20', '2024-05-18 17:02:20'),
(487, '2a01:4f9:c012:6365::1', 'Chrome', '2024-05-18 17:02:22', '2024-05-18 17:02:22'),
(488, '51.81.245.138', 'Chrome', '2024-05-18 17:02:25', '2024-05-18 17:02:25'),
(489, '176.125.235.91', 'Chrome', '2024-05-18 17:02:25', '2024-05-18 17:02:25'),
(490, '65.154.226.170', 'Chrome', '2024-05-18 17:02:53', '2024-05-18 17:02:53'),
(491, '207.241.236.85', 'Unknown', '2024-05-18 17:05:54', '2024-05-18 17:05:54'),
(492, '207.241.236.85', 'Unknown', '2024-05-18 17:06:05', '2024-05-18 17:06:05'),
(493, '34.116.248.103', 'Chrome', '2024-05-18 17:07:51', '2024-05-18 17:07:51'),
(494, '54.91.64.160', 'Chrome', '2024-05-18 17:15:33', '2024-05-18 17:15:33'),
(495, '129.153.125.162', 'Safari', '2024-05-18 17:28:41', '2024-05-18 17:28:41'),
(496, '2a02:4780:11:c0de::21', 'Unknown', '2024-05-18 17:48:21', '2024-05-18 17:48:21'),
(497, '64.15.129.103', 'Chrome', '2024-05-18 18:13:00', '2024-05-18 18:13:00'),
(498, '64.15.129.113', 'Chrome', '2024-05-18 18:13:02', '2024-05-18 18:13:02'),
(499, '64.15.129.125', 'Chrome', '2024-05-18 18:13:06', '2024-05-18 18:13:06'),
(500, '64.15.129.106', 'Chrome', '2024-05-18 18:13:08', '2024-05-18 18:13:08'),
(501, '64.15.129.113', 'Chrome', '2024-05-18 18:13:10', '2024-05-18 18:13:10'),
(502, '192.175.111.246', 'Chrome', '2024-05-18 18:13:12', '2024-05-18 18:13:12'),
(503, '64.15.129.113', 'Chrome', '2024-05-18 18:13:16', '2024-05-18 18:13:16'),
(504, '64.15.129.123', 'Chrome', '2024-05-18 18:13:18', '2024-05-18 18:13:18'),
(505, '2a13:6304:0:15::1', 'Safari', '2024-05-18 18:37:04', '2024-05-18 18:37:04'),
(506, '89.149.38.99', 'Chrome', '2024-05-18 18:37:04', '2024-05-18 18:37:04'),
(507, '68.235.38.136', 'Safari', '2024-05-18 18:37:04', '2024-05-18 18:37:04'),
(508, '129.153.125.162', 'Safari', '2024-05-18 18:53:55', '2024-05-18 18:53:55'),
(509, '5.133.192.171', 'Chrome', '2024-05-18 21:25:07', '2024-05-18 21:25:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_history_user_id_foreign` (`user_id`),
  ADD KEY `order_history_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_token_unique` (`token`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_history`
--
ALTER TABLE `order_history`
  ADD CONSTRAINT `order_history_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
