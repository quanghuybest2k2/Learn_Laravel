-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 30, 2023 lúc 09:27 AM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `ecommercepro`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'shirt', '2023-01-02 06:22:40', '2023-01-02 06:22:40'),
(2, 'toy', '2023-01-02 06:33:49', '2023-01-02 06:33:49'),
(3, 'Laptop', '2023-01-02 06:34:48', '2023-01-02 06:34:48'),
(4, 'mobile', '2023-01-02 06:40:11', '2023-01-02 06:40:11'),
(5, 'TV', '2023-01-02 06:41:47', '2023-01-02 06:41:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` longtext DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`id`, `name`, `comment`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Đoàn Quang Huy', 'sản phẩm này ok phết', '1', '2023-01-16 20:34:00', '2023-01-16 20:34:00'),
(2, 'Đoàn Quang Huy', 'Shop này tận tình lắm bà con ơi!', '1', '2023-01-16 20:40:24', '2023-01-16 20:40:24'),
(3, 'SH Team', 'Mong shop ra nhiều sản phẩm hơn', '3', '2023-01-16 21:34:23', '2023-01-16 21:34:23');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `failed_jobs`
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
-- Cấu trúc bảng cho bảng `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_29_125604_create_sessions_table', 1),
(7, '2023_01_02_125821_create_categories_table', 2),
(8, '2023_01_05_025218_create_products_table', 3),
(9, '2023_01_08_132434_create_carts_table', 4),
(10, '2023_01_09_110312_create_orders_table', 5),
(11, '2023_01_14_034000_create_notifications_table', 6),
(12, '2023_01_17_030938_create_comments_table', 7),
(13, '2023_01_17_031007_create_replies_table', 7);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) NOT NULL,
  `type` varchar(255) NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `delivery_status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone`, `address`, `user_id`, `product_title`, `quantity`, `price`, `image`, `product_id`, `payment_status`, `delivery_status`, `created_at`, `updated_at`) VALUES
(9, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '2', '20', '1673065547.jpg', '4', 'cash on delivery', 'Bạn đã hủy đơn hàng', '2023-01-09 04:47:58', '2023-01-16 07:42:16'),
(10, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'TV LG', '2', '2000', '1673098012.png', '5', 'Paid', 'delivered', '2023-01-09 04:47:58', '2023-01-11 06:14:08'),
(11, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '4', '40', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-09 04:47:58', '2023-01-09 04:47:58'),
(12, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Xe đồ chơi trẻ em', '2', '216', '1673068321.jpg', '2', 'Paid', 'delivered', '2023-01-09 04:47:58', '2023-01-11 06:15:54'),
(13, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '2', '20', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-09 04:55:18', '2023-01-09 04:55:18'),
(14, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Áo Polo', '4', '40', '1673065423.png', '3', 'cash on delivery', 'processing', '2023-01-09 04:55:18', '2023-01-09 04:55:18'),
(15, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '2', '20', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-09 04:59:00', '2023-01-09 04:59:00'),
(16, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '2', '20', '1673065547.jpg', '4', 'Paid', 'processing', '2023-01-10 03:05:50', '2023-01-10 03:05:50'),
(17, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'TV LG', '2', '2000', '1673098012.png', '5', 'Paid', 'processing', '2023-01-10 03:05:50', '2023-01-10 03:05:50'),
(18, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Áo Polo', '2', '20', '1673065423.png', '3', 'Paid', 'processing', '2023-01-10 03:24:39', '2023-01-10 03:24:39'),
(19, 'SH Team', 'gahoccode@gmail.com', '0123456789', '33 Bùi Viện, Phường Phạm Ngũ Lão, Quận 1, Thành phố Hồ Chí Minh', '3', 'Laptop Apple MacBook Air M1', '3', '30', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-13 21:34:03', '2023-01-13 21:34:03'),
(20, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Áo Polo', '9', '90', '1673065423.png', '3', 'cash on delivery', 'processing', '2023-01-18 05:52:43', '2023-01-18 05:52:43'),
(21, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '10', '100', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-18 05:52:43', '2023-01-18 05:52:43'),
(22, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Xe đồ chơi trẻ em', '2', '216', '1673068321.jpg', '2', 'cash on delivery', 'processing', '2023-01-18 05:52:43', '2023-01-18 05:52:43'),
(23, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '1', '10', '1673065547.jpg', '4', 'cash on delivery', 'processing', '2023-01-18 05:55:11', '2023-01-18 05:55:11'),
(24, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Áo Polo', '2', '20', '1673065423.png', '3', 'Paid', 'processing', '2023-01-19 00:47:28', '2023-01-19 00:47:28'),
(25, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '1', 'Laptop Apple MacBook Air M1', '2', '20', '1673065547.jpg', '4', 'Paid', 'processing', '2023-01-19 00:47:28', '2023-01-19 00:47:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `personal_access_tokens`
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
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `discount_price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `category`, `quantity`, `price`, `discount_price`, `created_at`, `updated_at`) VALUES
(2, 'Xe đồ chơi trẻ em', 'Xe đồ chơi trẻ em dưới 10 tuổi', '1673068321.jpg', 'toy', '1', '200', '108', '2023-01-04 21:39:14', '2023-01-06 22:16:45'),
(3, 'Áo Polo', 'Áo Polo phiên bản mùa xuân', '1673065423.png', 'shirt', '2', '20', '10', '2023-01-06 21:23:43', '2023-01-06 21:23:43'),
(4, 'Laptop Apple MacBook Air M1', 'Laptop Apple MacBook Air M1 2020 16GB/256GB/7-core GPU (Z12A0004Z)', '1673065547.jpg', 'Laptop', '1', '2000', '10', '2023-01-06 21:25:47', '2023-01-06 21:25:47'),
(5, 'TV LG', 'TV LG 50 inch', '1673098012.png', 'TV', '2', '1000', NULL, '2023-01-07 06:26:52', '2023-01-07 06:26:52');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment_id` varchar(255) DEFAULT NULL,
  `reply` longtext DEFAULT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `replies`
--

INSERT INTO `replies` (`id`, `name`, `comment_id`, `reply`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'SH Team', '1', 'Tôi cũng thấy vậy á hi hi', '3', '2023-01-16 21:13:19', '2023-01-16 21:13:19'),
(2, 'SH Team', '2', 'Tui mua ưng ý lắm', '3', '2023-01-16 21:26:34', '2023-01-16 21:26:34'),
(3, 'Đoàn Quang Huy', '3', 'hi hi', '1', '2023-01-16 21:35:49', '2023-01-16 21:35:49'),
(4, 'Đoàn Quang Huy', '2', 'không mua thì phí lắm', '1', '2023-01-16 21:36:15', '2023-01-16 21:36:15');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sessions`
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
-- Đang đổ dữ liệu cho bảng `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('hjUqToKPFwMunp6NB0cOcBF1S3BC4wJemuNVv7L7', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiSHYyNDV4b3hWMzFwSThiSDBwN0NiZVBzdXRnU3RJekNlYTNpM3lKZCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcmludF9wZGYvOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1674273965);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL DEFAULT '0',
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `usertype`, `phone`, `address`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Đoàn Quang Huy', 'quanghuybest@gmail.com', '0', '0859476166', 'Ninh Sơn, Ninh Thuận, Việt Nam', '2023-01-12 02:38:55', '$2y$10$4rptyORygYoqOMicCDnCGeR0vO.Gzjh5n5GkLQm71qu7AxgcJXktK', NULL, NULL, NULL, '5kbIgktohh40PnN4jPJb4VXuqe7WajAPq9KcFKFgJXSf0pi1GwgFURL0I3Tp', NULL, NULL, '2022-12-30 22:26:11', '2022-12-30 22:26:11'),
(2, 'admin', 'admin@gmail.com', '1', '0123456789', 'Đà Lạt, Lâm Đồng, Việt Nam', '2023-01-12 02:38:28', '$2y$10$Fe/Q0D0Wup2GAH7s0etYZ.T3GrJYM5FJhszQ.eVhE5CGfStwstpB.', NULL, NULL, NULL, 'VKEc7mcir5I2E3iVXuNQeLDsH2JGc9YXc10sRxZhHTGTYqLopH1Ut4cJDDKU', NULL, NULL, '2022-12-30 22:39:01', '2022-12-30 22:39:01'),
(3, 'SH Team', 'gahoccode@gmail.com', '0', '0123456789', '33 Bùi Viện, Phường Phạm Ngũ Lão, Quận 1, Thành phố Hồ Chí Minh', '2023-01-12 19:35:55', '$2y$10$VrSQk7zr9fkTbWoKbklGyeUwavEHoTd3jYYOiID8MWVzoId6VwA.S', NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-12 19:33:49', '2023-01-12 19:35:55');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Chỉ mục cho bảng `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Chỉ mục cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
