-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 01:23 PM
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
-- Database: `quickietech`
--

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
(13, '2024_03_25_191033_create_reviews_table', 3);

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
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 22),
(1, 'App\\Models\\User', 26),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(7, 'Ryzen 5 5600g', 'ASDASD', 2000, 'rp_41181041_0059444363_l_1711662037.png', '2024-03-28 21:40:37', '2024-03-28 21:40:37');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `rating_type`, `stars`, `comments`, `created_at`, `updated_at`) VALUES
(15, 1, 'product', 5, 'VERYYY NICE ANG MOTHERBOARD', '2024-03-28 14:08:47', '2024-03-28 14:08:47'),
(16, 1, 'service', 1, '!NICEEEEEEEEE', '2024-03-28 14:09:16', '2024-03-28 14:09:16'),
(17, 22, 'product', 5, 'NICEEESUHHH!', '2024-03-28 15:02:42', '2024-03-28 15:02:42'),
(18, 22, 'service', 5, 'VERRRY NICE PO', '2024-03-28 15:03:01', '2024-03-28 15:03:01'),
(19, 23, 'service', 3, 'PWEDE NA', '2024-03-28 15:05:00', '2024-03-28 15:05:00'),
(20, 23, 'product', 5, 'SALAMAT SA CONDOM!', '2024-03-28 15:05:31', '2024-03-28 15:05:31'),
(21, 24, 'service', 1, 'BOANG BRYAN!', '2024-03-28 15:10:09', '2024-03-28 15:10:09'),
(22, 24, 'product', 5, NULL, '2024-03-28 15:10:41', '2024-03-28 15:10:41'),
(23, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(24, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(25, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(26, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(27, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(28, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(29, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(30, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(31, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(32, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(33, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(34, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:14:19', '2024-03-28 15:14:19'),
(35, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(36, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(37, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(38, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(39, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(40, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(41, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(42, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(43, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(44, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(45, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(46, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:14:49', '2024-03-28 15:14:49'),
(47, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(48, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(49, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(50, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(51, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(52, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(53, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(54, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(55, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(56, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(57, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(58, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:14:54', '2024-03-28 15:14:54'),
(59, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(60, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(61, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(62, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(63, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(64, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(65, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(66, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(67, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(68, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(69, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(70, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:15:00', '2024-03-28 15:15:00'),
(71, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(72, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(73, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(74, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(75, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(76, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(77, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(78, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(79, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(80, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(81, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(82, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:15:03', '2024-03-28 15:15:03'),
(83, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(84, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(85, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(86, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(87, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(88, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(89, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(90, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(91, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(92, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(93, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(94, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:15:06', '2024-03-28 15:15:06'),
(95, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(96, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(97, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(98, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(99, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(100, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(101, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(102, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(103, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(104, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(105, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(106, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:15:09', '2024-03-28 15:15:09'),
(107, 1, 'product', 4, 'Great product, highly recommended', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(108, 22, 'service', 5, 'Excellent service, very satisfied', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(109, 23, 'product', 3, 'Good product, but could be better', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(110, 24, 'service', 2, 'Disappointing service, needs improvement', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(111, 1, 'service', 4, 'Impressed with the service quality', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(112, 22, 'product', 5, 'Absolutely amazing product, exceeded expectations', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(113, 23, 'service', 4, 'Professional service, would recommend', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(114, 24, 'product', 1, 'Terrible product, waste of money', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(115, 1, 'product', 3, 'Average product, nothing special', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(116, 22, 'service', 5, 'Exceptional service, prompt and courteous', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(117, 23, 'product', 4, 'Good value for money, satisfied overall', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(118, 24, 'service', 3, 'Fair service, could be improved', '2024-03-28 15:15:14', '2024-03-28 15:15:14'),
(143, 25, 'product', 3, 'FAIR!', '2024-03-28 15:47:02', '2024-03-28 15:47:02'),
(144, 1, 'product', 2, 'Not satisfied with the product, poor quality', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(145, 22, 'service', 1, 'Extremely disappointed with the service, unacceptable', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(146, 23, 'product', 2, 'Product did not meet expectations, very disappointed', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(147, 24, 'service', 1, 'Service was terrible, would not recommend', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(148, 1, 'service', 2, 'Service quality was poor, not impressed', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(149, 22, 'product', 1, 'Product fell short of expectations, complete waste of money', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(150, 23, 'service', 2, 'Service was below average, needs significant improvement', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(151, 24, 'product', 1, 'Product was a total disappointment, regret buying it', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(152, 1, 'product', 2, 'Product performance was unsatisfactory, not recommended', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(153, 22, 'service', 1, 'Service experience was horrendous, avoid at all costs', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(154, 23, 'product', 2, 'Product quality was subpar, do not recommend', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(155, 24, 'service', 1, 'Service was appalling, do not use this service provider', '2024-03-28 17:12:01', '2024-03-28 17:12:01'),
(156, 1, 'product', 2, 'Not satisfied with the product, poor quality', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(157, 22, 'service', 1, 'Extremely disappointed with the service, unacceptable', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(158, 23, 'product', 2, 'Product did not meet expectations, very disappointed', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(159, 24, 'service', 1, 'Service was terrible, would not recommend', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(160, 1, 'service', 2, 'Service quality was poor, not impressed', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(161, 22, 'product', 1, 'Product fell short of expectations, complete waste of money', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(162, 23, 'service', 2, 'Service was below average, needs significant improvement', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(163, 24, 'product', 1, 'Product was a total disappointment, regret buying it', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(164, 1, 'product', 2, 'Product performance was unsatisfactory, not recommended', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(165, 22, 'service', 1, 'Service experience was horrendous, avoid at all costs', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(166, 23, 'product', 2, 'Product quality was subpar, do not recommend', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(167, 24, 'service', 1, 'Service was appalling, do not use this service provider', '2024-03-28 17:12:06', '2024-03-28 17:12:06'),
(168, 25, 'service', 5, 'POGI!!', '2024-03-28 17:48:40', '2024-03-28 17:48:40'),
(169, 22, 'product', 3, 'Average', '2024-03-29 11:56:19', '2024-03-29 11:56:19'),
(170, 22, 'service', 5, NULL, '2024-03-29 11:59:23', '2024-03-29 11:59:23'),
(171, 22, 'product', 1, NULL, '2024-03-29 12:10:17', '2024-03-29 12:10:17'),
(172, 22, 'product', 3, NULL, '2024-03-29 12:10:33', '2024-03-29 12:10:33'),
(173, 22, 'service', 4, NULL, '2024-03-29 12:10:48', '2024-03-29 12:10:48'),
(174, 22, 'service', 5, NULL, '2024-03-29 12:11:11', '2024-03-29 12:11:11');

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
(2, 'user', 'web', '2024-03-25 15:55:12', '2024-03-25 15:55:12');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `price`, `image`, `created_at`, `updated_at`) VALUES
(6, 'Reformat & Reprogram', 'Reprogram', 300, 'How-to-Completely-reset-refreshformat-or-reformat-your-laptop_1711661985.jpg', '2024-03-28 21:39:45', '2024-03-28 21:39:45');

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
  `profile_picture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `email`, `phone_number`, `email_verified_at`, `user_type`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `profile_picture`) VALUES
(1, 'anthony bryanjupuri', 'Anthony Bryan', 'Jupuri', 'yanjupuri@gmail.com', '09264539945', '2024-03-25 07:57:43', 'user', '$2y$10$asGEbLiNRfJC2JTI/ezYg.zvIHJlZS86tNcfwdsopzaKaxM99gb..', 'pending', NULL, '2024-03-25 07:57:23', '2024-03-26 02:28:50', 'DSC00719_1711448930.JPG'),
(22, 'antheresegallano', 'Antherese', 'Gallano', 'hahaha@gmail.com', '09123456789', '2024-03-28 14:35:14', 'user', '$2y$10$Gxd/XQnR8Xjx5lpb2AkRyO0IaI6HzgzuwoRB9xLw5ASHx38GzBIzu', 'pending', NULL, '2024-03-28 14:34:54', '2024-03-28 14:34:54', NULL),
(23, 'samuel mausersavellon', 'Samuel Mauser', 'Savellon', 'samsam@gmail.com', '09123456789', '2024-03-28 15:04:35', 'user', '$2y$10$SSrTM8asRbc2FHMEF0aXoOD03DVqM7GQAlZLCGz4vuRXF3yMSXAX2', 'pending', NULL, '2024-03-28 15:04:21', '2024-03-28 15:05:09', 'team-2_1711638309.jpg'),
(24, 'hanz reynoldmacrohon', 'Hanz Reynold', 'Macrohon', 'hanzhanz@gmail.com', '09123456789', '2024-03-28 15:09:47', 'user', '$2y$10$s8Dk2c/scZRgaf4LLkeKQOyw90ZOKPEydPjASZHXpw9zkc6QVLP/S', 'pending', NULL, '2024-03-28 15:09:33', '2024-03-28 15:09:33', NULL),
(25, 'khabzwexxc', 'Khabz', 'Wexxc', 'khabz@gmail.com', '12312312312', '2024-03-28 15:41:04', 'user', '$2y$10$8UyOhKC.NpKrZJ5xQrUzLOqxS99HnM1Li1Y3fU9TIZpax2wISnYc.', 'pending', NULL, '2024-03-28 15:40:46', '2024-03-28 15:40:46', NULL),
(26, 'sample samplejups', 'Sample Sample', 'Jups', 'sample@gmail.com', '09224546878', NULL, 'user', '$2y$10$Dmsa6J6ppHUx1.KjUpscIeRU7iBCdoSJe2YHv9W74jDNqM4EeYGii', 'pending', NULL, '2024-03-28 23:18:25', '2024-03-28 23:18:25', NULL);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
