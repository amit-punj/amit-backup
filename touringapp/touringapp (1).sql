-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2020 at 10:47 AM
-- Server version: 5.7.28-0ubuntu0.16.04.2
-- PHP Version: 7.1.33-3+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `touringapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('apamitpunj@gmail.com', '$2y$10$PDp3OpWeY2jFaCrKWM26eezuqgZudtma335ywAIJiDv5FEgwbiQYS', '2019-07-10 00:15:24');

-- --------------------------------------------------------

--
-- Table structure for table `poi`
--

CREATE TABLE `poi` (
  `id` int(11) NOT NULL,
  `poi_id` varchar(50) DEFAULT NULL,
  `tour_id` int(11) NOT NULL,
  `variation_id` varchar(50) DEFAULT NULL,
  `poi_name` varchar(250) NOT NULL,
  `default_poi` int(5) DEFAULT '0',
  `lat` varchar(250) DEFAULT NULL,
  `long` varchar(250) DEFAULT NULL,
  `poi_location` varchar(250) DEFAULT NULL,
  `icon_type` varchar(250) NOT NULL,
  `content_type` varchar(250) NOT NULL,
  `content` text,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `poi_id`, `tour_id`, `variation_id`, `poi_name`, `default_poi`, `lat`, `long`, `poi_location`, `icon_type`, `content_type`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, NULL, 7, NULL, 'test with english', 1, '30.722993111535768', '76.97770152441399', NULL, 'icon1', 'text', NULL, NULL, '2019-08-06 04:49:22', '2019-08-06 08:19:22'),
(2, NULL, 7, NULL, 'ds', 0, '30.70646405184397', '76.9783881699218', NULL, 'icon1', 'image', NULL, NULL, '2019-08-06 05:03:15', '2019-08-06 08:19:22'),
(3, NULL, 7, NULL, 'ddd', 0, '30.707275812879253', '77.02370677343742', NULL, 'icon1', 'video', NULL, NULL, '2019-08-06 07:47:43', '2019-08-06 08:19:22');

-- --------------------------------------------------------

--
-- Table structure for table `poi_content`
--

CREATE TABLE `poi_content` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `variation_id` int(11) NOT NULL,
  `poi_id` int(11) NOT NULL,
  `content` text,
  `image` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `poi_content`
--

INSERT INTO `poi_content` (`id`, `tour_id`, `variation_id`, `poi_id`, `content`, `image`, `created_at`, `updated_at`) VALUES
(1, 7, 1, 1, '<p>sss</p>', NULL, '2019-08-06 04:49:22', '2019-08-06 04:49:22'),
(2, 7, 1, 2, '', 'iconfinder.png', '2019-08-06 05:03:15', '2019-08-06 07:58:35'),
(3, 7, 1, 3, NULL, '<iframe src="https://player.vimeo.com/video/319551659" width="640" height="564" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>', '2019-08-06 07:47:44', '2019-08-06 07:47:44');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int(11) NOT NULL,
  `tour_name` varchar(50) NOT NULL,
  `tour_owner` varchar(50) NOT NULL,
  `center_lattitude` varchar(50) DEFAULT NULL,
  `center_longitude` varchar(50) DEFAULT NULL,
  `top` varchar(50) DEFAULT NULL,
  `right` varchar(50) DEFAULT NULL,
  `bottom` varchar(50) DEFAULT NULL,
  `left` varchar(50) DEFAULT NULL,
  `minimum_zoom` int(11) DEFAULT NULL,
  `maximum_zoom` int(11) DEFAULT NULL,
  `set_password` varchar(250) DEFAULT NULL,
  `password_type` varchar(250) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `current_password` varchar(250) DEFAULT NULL,
  `variations` varchar(250) DEFAULT NULL,
  `poi` varchar(250) DEFAULT NULL,
  `tour_control` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `tour_name`, `tour_owner`, `center_lattitude`, `center_longitude`, `top`, `right`, `bottom`, `left`, `minimum_zoom`, `maximum_zoom`, `set_password`, `password_type`, `password`, `current_password`, `variations`, `poi`, `tour_control`, `created_at`, `updated_at`) VALUES
(1, 'new tour', '3', NULL, NULL, '30.716665', '76.853813', '30.713088', '76.844801', 13, 16, 'temporary', 'month', NULL, '1', NULL, NULL, 'yes', '2019-07-31 08:16:53', '2019-08-01 07:04:09'),
(2, 'fd', '3', NULL, NULL, 'df', 'df', 'df', 'd', 13, 16, 'temporary', 'week', NULL, '1f', NULL, NULL, 'yes', '2019-08-01 06:11:08', '2019-08-01 06:11:50'),
(3, 'sddsd', '3', NULL, NULL, '30.716665', '77.686525', '30.713088', '74.588573', 13, 16, 'temporary', 'month', NULL, '1r', NULL, NULL, NULL, '2019-08-01 06:25:58', '2019-08-01 06:25:58'),
(6, 'sddsd', '4', NULL, NULL, '30.716665', '77.686525', '30.713088', '30.723528', 13, 16, 'temporary', 'week', NULL, '233', NULL, NULL, 'yes', '2019-08-01 06:39:32', '2019-08-01 07:50:53'),
(7, 'sddsd', '4', NULL, NULL, '30.716665', '30.721226', '30.713088', '76.897364', 13, 16, 'temporary', 'month', NULL, 'dfd', NULL, NULL, 'no', '2019-08-01 07:51:13', '2019-08-06 07:52:40');

-- --------------------------------------------------------

--
-- Table structure for table `tour_passwords`
--

CREATE TABLE `tour_passwords` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `set_password` varchar(50) DEFAULT NULL,
  `password_type` varchar(50) DEFAULT NULL,
  `current_password` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `status` int(2) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tour_passwords`
--

INSERT INTO `tour_passwords` (`id`, `tour_id`, `set_password`, `password_type`, `current_password`, `password`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'temporary', 'month', NULL, '1', 0, '2019-08-01 06:10:25', '2019-08-01 06:10:40'),
(7, 1, 'temporary', 'month', NULL, '2', 0, '2019-08-01 06:10:25', '2019-08-01 06:10:41'),
(8, 1, 'temporary', 'month', NULL, '3', 0, '2019-08-01 06:10:26', '2019-08-01 06:10:41'),
(9, 2, 'temporary', 'week', NULL, '1f', 1, '2019-08-01 06:11:08', '2019-08-01 06:11:50'),
(10, 2, 'temporary', 'week', NULL, '2f', 0, '2019-08-01 06:11:08', '2019-08-01 06:11:50'),
(11, 2, 'temporary', 'week', NULL, '3r', 0, '2019-08-01 06:11:08', '2019-08-01 06:11:50'),
(12, 3, 'temporary', 'month', NULL, '1r', 1, '2019-08-01 06:25:58', '2019-08-01 06:25:58'),
(13, 4, 'temporary', 'month', NULL, '1D', 1, '2019-08-01 06:38:14', '2019-08-01 06:38:14'),
(14, 5, 'temporary', 'month', NULL, '1D', 1, '2019-08-01 06:38:40', '2019-08-01 06:38:40'),
(15, 5, 'temporary', 'month', NULL, 'w1', 0, '2019-08-01 06:38:41', '2019-08-01 06:38:41'),
(16, 5, 'temporary', 'month', NULL, 'D', 0, '2019-08-01 06:38:41', '2019-08-01 06:38:41'),
(20, 1, 'temporary', 'month', NULL, '4', 0, '2019-08-01 07:02:54', '2019-08-01 07:02:54'),
(21, 1, 'temporary', 'month', NULL, 'df', 0, '2019-08-01 07:04:10', '2019-08-01 07:04:10'),
(22, 6, 'temporary', 'week', NULL, '233', 0, '2019-08-01 07:04:21', '2019-08-01 07:47:55'),
(23, 6, 'temporary', 'week', NULL, 'fdf', 0, '2019-08-01 07:05:22', '2019-08-01 07:47:55'),
(24, 6, 'temporary', 'week', NULL, 'fdffff', 0, '2019-08-01 07:05:22', '2019-08-01 07:47:55'),
(25, 6, 'temporary', 'week', NULL, 'fdfgfgg', 0, '2019-08-01 07:05:22', '2019-08-01 07:47:55'),
(26, 6, 'temporary', 'week', NULL, '233', 0, '2019-08-01 07:47:22', '2019-08-01 07:47:56'),
(27, 6, 'temporary', 'week', NULL, 'fdf', 0, '2019-08-01 07:47:56', '2019-08-01 07:47:56'),
(28, 6, 'temporary', 'week', NULL, 'fdffff', 0, '2019-08-01 07:47:56', '2019-08-01 07:47:56'),
(29, 6, 'temporary', 'week', NULL, 'dds', 0, '2019-08-01 07:47:56', '2019-08-01 07:47:56'),
(30, 7, 'temporary', 'month', NULL, 'dfd', 1, '2019-08-01 07:51:13', '2019-08-01 07:51:13'),
(31, 7, 'temporary', 'month', NULL, 'dd', 0, '2019-08-01 07:51:13', '2019-08-01 07:51:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `company` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_vat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(11) NOT NULL DEFAULT '10',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `lname`, `email`, `email_verified_at`, `company`, `company_name`, `company_address`, `company_vat`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'gagan ggg', 'gagan ggg', 'saini', 'saini.gagan.3080@gmail.com', NULL, 'no', NULL, NULL, NULL, '$2y$10$KhaccInC9XqneNiotHzit.W4e4SMYBAvJLew2jAaCsEhRI/QD5WNG', 10, '4ler8iSuVC0LQN1sJtFHXiacFw0005rrV0b7uLSVeYA1yICwZrEdjhO8O414', '2019-06-10 04:16:52', '2019-07-03 23:57:05'),
(2, 'amit', 'amit', 'sharm', 'sahilsharma22vision@gmail.com', NULL, 'yes', 'company', 'Company Address', 'Comapny VAT', '$2y$10$v5bspascNsdLymWsyAMrEu68tWPd5rXOXSoDJFFUiV8wDK/053HrG', 1, NULL, '2019-06-10 08:41:52', '2019-06-11 00:45:03'),
(3, 'amit punj', 'amit punj', 'sharma', 'apamitpunj@gmail.com', NULL, 'no', NULL, NULL, NULL, '$2y$10$AWuJRPpMROHm8uIXJN5h6.sn6mC0L/jCjZ3Zz1Q7SoRU2WGEcjopG', 1, 'lRNYVpsu4DHmspG9ARiVjb4lTTMcRYGmZJEEXQEDbHWRpRVeiwZ9ePjJhiRw', '2019-06-10 08:52:16', '2019-06-27 05:04:06'),
(4, 'asd', 'asd', 'asd', 'saini.gagan.3080@gmail.comt', NULL, 'no', NULL, NULL, NULL, '$2y$10$M35Ev6wgCJ39aLRFZyqeUuue91MhhvwQ2RrsiGYpB278a2HhVDtN.', 10, NULL, '2019-07-03 23:54:00', '2019-07-03 23:55:39'),
(5, 'amit', 'amit', 'sharma', 'd@g.c', NULL, 'no', NULL, NULL, NULL, '$2y$10$mTco8cCTXDoBjG8kws.jnOERnclqliromOHWzqRRdi5aZFa5Symuy', 10, NULL, '2019-07-22 23:17:32', '2019-07-22 23:18:15');

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` int(11) NOT NULL,
  `tour_id` int(11) NOT NULL,
  `variation_name` varchar(250) NOT NULL,
  `language` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `tour_id`, `variation_name`, `language`, `created_at`, `updated_at`) VALUES
(1, 7, 'English', NULL, '2019-08-06 04:48:58', '2019-08-06 04:48:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `poi`
--
ALTER TABLE `poi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poi_content`
--
ALTER TABLE `poi_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_passwords`
--
ALTER TABLE `tour_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `poi`
--
ALTER TABLE `poi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poi_content`
--
ALTER TABLE `poi_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tour_passwords`
--
ALTER TABLE `tour_passwords`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
