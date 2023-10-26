-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2020 at 07:15 AM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.0.33-8+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sftpuser_lara1511`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_permissions`
--

CREATE TABLE `access_permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `po_id` int(11) DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL COMMENT '3-Property Manager, 4-Property Description Experts, 5-Legal Advisor, 6- Visit Organizer',
  `unit_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `contract_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `meter_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `reading_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `booking_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `transactio_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `documents_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `tickets_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `legal_permission` int(11) DEFAULT NULL COMMENT '0 = Read, 1 = Write,2 = Full Access',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `access_permissions`
--

INSERT INTO `access_permissions` (`id`, `po_id`, `user_role`, `unit_permission`, `contract_permission`, `meter_permission`, `reading_permission`, `booking_permission`, `transactio_permission`, `documents_permission`, `tickets_permission`, `legal_permission`, `created_at`, `updated_at`) VALUES
(1, 10, 5, 0, 0, 0, 0, 0, 0, 0, 0, 2, '2019-11-19 16:35:25', '2019-12-16 12:45:24'),
(2, 10, 3, 2, 2, 2, 2, 2, 2, 2, 2, 2, '2019-11-19 16:35:38', '2019-11-19 16:35:38'),
(3, 10, 4, 0, 0, 2, 2, 2, 0, 2, 0, 0, '2019-11-19 16:35:46', '2019-12-16 19:26:37'),
(4, 27, 4, 0, 0, 2, 2, 0, 0, 2, 0, 0, '2019-12-14 20:00:03', '2019-12-16 18:42:24'),
(5, 27, 3, 2, 0, 1, 2, 2, 0, 2, 1, 0, '2019-12-16 18:41:55', '2019-12-16 18:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `amenities_name` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenities_name`, `created_at`, `updated_at`) VALUES
(1, 'Wifi', NULL, NULL),
(2, 'Tables', NULL, NULL),
(3, 'Chairs', NULL, NULL),
(4, 'Fire extinguisher', NULL, NULL),
(5, 'Heating', NULL, NULL),
(6, 'Air conditioner', NULL, NULL),
(7, 'Bar', NULL, NULL),
(8, 'Lounge', NULL, NULL),
(9, 'Storage', NULL, NULL),
(10, 'Whiteboard', NULL, NULL),
(11, 'Near Public Transport', NULL, NULL),
(12, 'Penthouse', NULL, NULL),
(13, 'Office', NULL, NULL),
(14, 'Den/Library', NULL, NULL),
(15, 'Formal DiningRoom', NULL, NULL),
(16, 'pet friendly', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `terminate_id` int(11) DEFAULT NULL,
  `created_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `book_status` int(11) NOT NULL DEFAULT '0',
  `reply_status` int(11) NOT NULL DEFAULT '0' COMMENT '0= default, 1= send, 2 = did not send',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `appointment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0= by default, 1 = accept, 2 = reject, 3 = reject by tenant, 4 = assigned another dates',
  `parent` int(11) NOT NULL DEFAULT '0',
  `IsDeleted` int(11) NOT NULL DEFAULT '0',
  `assign_dates` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `unit_id`, `contract_id`, `tenant_id`, `pde_id`, `vo_id`, `terminate_id`, `created_by`, `assigned_to`, `appointment_type`, `title`, `description`, `time`, `book_status`, `reply_status`, `created_at`, `updated_at`, `appointment_status`, `parent`, `IsDeleted`, `assign_dates`) VALUES
(1, 1, NULL, 4, NULL, 2, NULL, '4', '2', 'Visit', 'swde', 'we', '2019/11/20 14:45:53', 0, 2, '2019-11-18 11:28:02', '2020-01-07 18:32:20', 0, 0, 0, NULL),
(2, 3, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'Florida Best Boat Rental - Boobur', 'Boat', '2019/11/18 14:30:34', 0, 1, '2019-11-18 14:27:57', '2019-11-18 14:31:46', 1, 0, 0, NULL),
(3, 3, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'Title', 'Description', '2019/11/18 16:25:46', 0, 2, '2019-11-18 16:23:27', '2020-01-07 18:32:28', 0, 0, 0, NULL),
(4, 3, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'Florida Best Boat Rental - Boobur', 'Descriptionllghj jhkj', '2019/11/18 16:30:39', 0, 2, '2019-11-18 16:26:39', '2020-01-07 18:32:35', 0, 0, 0, NULL),
(5, 3, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'Florida Best Boat Rental - Boobur', 'Description33', '2019/11/18 16:35:00', 0, 2, '2019-11-18 16:31:41', '2020-01-07 18:32:43', 0, 0, 0, NULL),
(6, 5, NULL, 11, NULL, 10, NULL, '11', '10', 'Visit', 'Title 1', 'Description 1', '2019/11/19 16:55:09', 0, 2, '2019-11-19 16:52:12', '2020-01-07 18:32:50', 0, 0, 0, NULL),
(7, 7, 3, 13, 10, NULL, NULL, '13', '10', 'Entry', '24d', 'pde26@yopmail.com', '2019/11/22 14:20:52', 0, 2, '2019-11-19 18:25:10', '2020-01-07 18:32:59', 0, 0, 0, NULL),
(8, 9, 5, 9, 13, NULL, NULL, '9', '13', 'Entry', 'weew', 'poihjk', '2019/11/20 17:50:24', 0, 2, '2019-11-20 17:47:41', '2020-01-07 18:33:07', 0, 0, 0, NULL),
(9, 9, 5, 9, 13, NULL, NULL, '9', '13', 'Entry', '24d', 'mail.com', '2019/11/20 17:55:12', 0, 2, '2019-11-20 17:49:33', '2020-01-07 18:33:15', 0, 0, 0, NULL),
(10, 9, 5, 9, 13, NULL, NULL, '9', '13', 'Entry', '24d', 'mail.com', '2019/11/20 17:55:12', 0, 2, '2019-11-20 17:49:45', '2020-01-07 18:33:23', 0, 0, 0, NULL),
(11, 4, 7, 4, 13, NULL, NULL, '4', '13', 'Entry', '66666', '666rytyty', '2019/12/02 10:55:46', 0, 2, '2019-11-22 10:59:04', '2020-01-07 18:33:31', 2, 0, 0, NULL),
(12, 4, 7, 4, 13, NULL, NULL, '4', '13', 'Entry', '66666', '666rytyty', '2019/12/02 10:55:46', 0, 2, '2019-11-22 10:59:36', '2020-01-07 18:33:39', 1, 0, 0, NULL),
(13, 4, 7, 4, 13, NULL, NULL, '4', '13', 'Entry', '66666', '666rytyty', '2019/12/02 10:55:46', 0, 2, '2019-11-22 11:00:06', '2020-01-07 18:33:47', 2, 0, 0, NULL),
(14, 4, 7, 4, 13, NULL, NULL, '4', '13', 'Entry', 'test again', 'djsbfkdkasfjbkjbdsfkbjksgfsd', '2019/11/29 11:35:15', 0, 2, '2019-11-22 11:39:28', '2020-01-07 18:33:55', 2, 0, 0, NULL),
(15, 12, 8, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'qwerty', '2019/11/23 15:30:18', 0, 1, '2019-11-22 15:27:41', '2019-11-22 15:29:22', 1, 0, 0, NULL),
(16, 11, 9, 9, 13, NULL, NULL, '9', '13', 'Entry', 'wew', 'qas', '2019/11/22 16:05:16', 0, 2, '2019-11-22 16:02:25', '2020-01-07 18:34:03', 1, 0, 0, NULL),
(17, 8, NULL, 4, NULL, 12, NULL, '4', '12', 'Visit', 'New', 'XZSdasdasd', '2019/11/22 19:35:29', 0, 2, '2019-11-22 19:41:01', '2020-01-07 18:34:11', 0, 0, 0, NULL),
(18, 8, NULL, 4, NULL, 12, NULL, '4', '12', 'Visit', 'tst', 'vbgdfg', '2019/11/23 19:40:12', 0, 2, '2019-11-22 19:41:56', '2020-01-07 18:34:19', 1, 0, 0, NULL),
(19, 26, 16, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'lo', '2019/11/29 00:00:45', 0, 2, '2019-11-25 12:57:53', '2020-01-07 18:34:27', 0, 0, 0, NULL),
(20, 16, NULL, 16, NULL, 1, NULL, '16', '1', 'Visit', 'vjhhn', 'kglgkg', '2019/11/26 14:10:00', 0, 2, '2019-11-25 13:17:19', '2020-01-07 18:34:35', 0, 0, 0, NULL),
(21, 27, 20, 9, 13, NULL, NULL, '9', '13', 'Entry', 'test title', 'test description', '2019/11/25 15:55:46', 0, 2, '2019-11-25 15:51:09', '2020-01-07 18:34:43', 1, 0, 0, NULL),
(22, 3, NULL, 19, NULL, 12, NULL, '19', '12', 'Visit', 'dsd', 'dfdsf', '2019/11/30 17:40:34', 0, 2, '2019-11-26 17:42:03', '2020-01-07 18:34:51', 0, 0, 0, NULL),
(23, 50, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'tt', 'dd', '2019/12/04 12:50:18', 0, 2, '2019-12-04 12:49:53', '2020-01-07 18:34:59', 0, 0, 0, NULL),
(24, 50, NULL, 9, NULL, 12, NULL, '9', '12', 'Visit', 'ttt', 'ddd', '2019/12/04 12:55:08', 0, 2, '2019-12-04 12:50:48', '2020-01-07 18:35:07', 1, 0, 0, NULL),
(25, 51, 52, 9, 13, NULL, NULL, '9', '13', 'Entry', 'aa', 'ss', '2019/12/02 00:00:03', 0, 2, '2019-12-04 13:05:28', '2020-01-07 18:35:15', 1, 0, 0, NULL),
(26, 52, 53, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'SS', '2019/12/01 00:00:10', 0, 2, '2019-12-04 13:26:20', '2020-01-07 18:35:23', 0, 0, 0, NULL),
(27, 52, 53, 9, 13, NULL, NULL, '9', '13', 'Entry', 's', 'as', '2019/12/01 00:05:47', 0, 2, '2019-12-04 13:31:54', '2020-01-07 18:35:31', 1, 0, 0, NULL),
(28, 53, NULL, 29, NULL, 23, NULL, '29', '23', 'Visit', 'asa', 'asas', '2019/12/04 13:57:09', 0, 2, '2019-12-04 13:57:21', '2020-01-07 18:35:39', 0, 0, 0, NULL),
(29, 53, NULL, 29, NULL, 23, NULL, '29', '23', 'Visit', 'v', 'v', '2019/12/05 14:45:32', 0, 2, '2019-12-04 14:16:58', '2020-01-07 18:35:47', 1, 0, 0, NULL),
(32, 60, 2, 43, 13, NULL, NULL, '43', '13', 'Entry', 'reg', 'dgfdgf', '2019/12/02 14:35:25', 0, 1, '2019-12-11 14:39:59', '2019-12-11 16:08:32', 1, 0, 0, NULL),
(33, 63, 4, 9, 13, NULL, NULL, '9', '13', 'Entry', 'dd', 'fff', '2019/12/12 10:40:53', 0, 2, '2019-12-12 10:37:05', '2020-01-07 18:35:55', 0, 0, 0, NULL),
(34, 63, 4, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'cvbnc', '2019/12/12 10:55:06', 0, 1, '2019-12-12 10:51:15', '2019-12-12 10:52:08', 1, 0, 0, NULL),
(35, 65, 6, 29, 25, NULL, NULL, '29', '25', 'Entry', 'entry appointment', 'entry appointment description', '2019/12/13 11:40:26', 0, 2, '2019-12-13 11:46:55', '2020-01-07 18:36:03', 1, 0, 0, NULL),
(36, 53, 8, 29, 25, NULL, NULL, '29', '25', 'Entry', 'entry appointment 2', 'entry appointment 2entry appointment 2entry appointment 2', '2019/12/13 14:20:06', 0, 2, '2019-12-13 13:13:33', '2020-01-07 18:36:11', 1, 0, 0, NULL),
(37, 65, 6, 29, 25, NULL, 4, '29', '25', 'Exit', 'exit appointment', 'exit appointmentexit appointmentexit appointmentexit appointment', '2019/12/13 14:15:48', 0, 2, '2019-12-13 13:16:28', '2020-01-07 18:36:19', 0, 0, 0, NULL),
(38, 47, 14, 40, 13, NULL, NULL, '40', '13', 'Entry', 'qqqq', 'aaaa', '2019/12/16 17:30:59', 0, 0, '2019-12-16 17:25:23', '2019-12-16 17:25:23', 0, 0, 0, NULL),
(39, 69, 15, 40, 13, NULL, NULL, '40', '13', 'Entry', 'q', 'q', '2019/12/16 19:20:10', 0, 0, '2019-12-16 19:19:20', '2019-12-16 19:19:59', 1, 0, 0, NULL),
(40, 71, 16, 29, 25, NULL, NULL, '29', '25', 'Entry', 'tete', 'tertete', '2019/12/17 17:00:19', 0, 0, '2019-12-17 16:56:36', '2019-12-17 16:57:03', 1, 0, 0, NULL),
(41, 72, 17, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019/12/17 17:35:07', 0, 1, '2019-12-17 17:30:55', '2019-12-17 17:34:05', 1, 0, 0, NULL),
(42, 73, 18, 9, 13, NULL, NULL, '9', '13', 'Entry', 'aa', 'ss', '2019/12/17 17:50:26', 0, 1, '2019-12-17 17:44:35', '2019-12-17 17:45:36', 1, 0, 0, NULL),
(43, 74, 19, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Florida Best Boat Rental - Boobur', 'Florida Best Boat Rental - Boobur  Description', '2019/12/17 18:45:14', 0, 0, '2019-12-17 18:41:34', '2019-12-17 18:43:51', 1, 0, 0, NULL),
(44, 78, 24, 9, 13, NULL, NULL, '9', '13', 'Entry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.q', '2019/12/18 12:25:09', 0, 1, '2019-12-18 12:22:27', '2019-12-18 12:25:11', 1, 0, 0, NULL),
(45, 78, 24, 9, 13, NULL, NULL, '9', '13', 'Entry', '24d', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019/12/18 12:30:54', 0, 0, '2019-12-18 12:26:05', '2019-12-18 12:26:05', 0, 0, 0, NULL),
(46, 79, 25, 9, 13, NULL, NULL, '9', '13', 'Entry', 'weew', 'https://prnt.sc/qce6yj', '2019/12/18 12:50:10', 0, 0, '2019-12-18 12:47:55', '2019-12-18 12:49:07', 1, 0, 0, NULL),
(47, 84, 28, 40, 13, NULL, NULL, '40', '13', 'Entry', 'qqqqqqqqqqqqqqqqqqqqq', 'wwwwwwwwwwwwwwwww', '2019/12/19 18:35:58', 0, 0, '2019-12-19 18:33:15', '2019-12-19 18:34:32', 1, 0, 0, NULL),
(48, 86, 29, 9, 13, NULL, NULL, '9', '13', 'Entry', 'entry appointment', 'dfg', '2019/12/20 16:35:11', 0, 0, '2019-12-20 16:31:24', '2019-12-20 16:34:06', 1, 0, 0, NULL),
(49, 87, 30, 9, 13, NULL, NULL, '9', '13', 'Entry', 'exit', 'dfdf', '2019/12/19 17:20:20', 0, 0, '2019-12-20 17:16:49', '2019-12-20 17:17:05', 1, 0, 0, NULL),
(50, 87, 30, 9, 13, NULL, 6, '9', '13', 'Exit', 'exit with', 'exit withexit withexit withexit withexit with', '2019/12/20 17:35:54', 0, 0, '2019-12-20 17:36:19', '2019-12-20 17:36:19', 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_reason`
--

CREATE TABLE `appointment_reason` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `send` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reason` longtext COLLATE utf8mb4_unicode_ci,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0= default, 1= send, 2 = did not send',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_appointment`
--

CREATE TABLE `book_appointment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenent_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `pde_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `text` longtext COLLATE utf8mb4_unicode_ci,
  `time` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `note` longtext COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cmspages`
--

CREATE TABLE `cmspages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `starting_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contract_communication_language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_expert_id` int(11) DEFAULT NULL,
  `signature_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_provision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `uploaded_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `doc_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `unit_id`, `user_type`, `contract_id`, `uploaded_by`, `related_to`, `doc_name`, `created_at`, `updated_at`) VALUES
(1, 11, 4, 9, '13', 'EntryPDReport', 'document1574418957.png', '2019-11-22 16:05:57', '2019-11-22 16:05:57'),
(2, 11, 4, 9, '13', 'EntryPDReport', 'document1574418960.png', '2019-11-22 16:06:00', '2019-11-22 16:06:00'),
(3, 11, 4, 9, '13', 'EntryPDReport', 'document1574418962.png', '2019-11-22 16:06:02', '2019-11-22 16:06:02'),
(4, 11, 4, 9, '13', 'EntryPDReport', 'document1574418962.png', '2019-11-22 16:06:02', '2019-11-22 16:06:02'),
(5, 27, 4, 20, '13', 'EntryPDReport', 'document1574677640.png', '2019-11-25 15:57:20', '2019-11-25 15:57:20'),
(6, 27, 4, 20, '13', 'EntryPDReport', 'document1574677641.png', '2019-11-25 15:57:21', '2019-11-25 15:57:21'),
(7, 12, 4, 8, '13', 'EntryPDReport', 'document1574834515.jpg', '2019-11-27 11:31:55', '2019-11-27 11:31:55'),
(8, 12, 4, 8, '13', 'EntryPDReport', 'document1574834599.jpg', '2019-11-27 11:33:19', '2019-11-27 11:33:19'),
(9, 51, 4, 52, '13', 'EntryPDReport', 'document1575445223.png', '2019-12-04 13:10:23', '2019-12-04 13:10:23'),
(10, 52, 4, 53, '13', 'EntryPDReport', 'document1575447065.png', '2019-12-04 13:41:05', '2019-12-04 13:41:05'),
(11, 60, 4, 2, '13', 'EntryPDReport', 'document1576061350.jpeg', '2019-12-11 16:19:10', '2019-12-11 16:19:10'),
(12, 65, 4, 6, '25', 'EntryPDReport', 'document1576217947.jpeg', '2019-12-13 11:49:07', '2019-12-13 11:49:07'),
(13, 65, 4, 6, '25', 'EntryPDReport', 'document1576333694.pdf', '2019-12-14 19:58:14', '2019-12-14 19:58:14'),
(14, 53, 4, 8, '25', 'EntryPDReport', 'document1576500997.png', '2019-12-16 18:26:37', '2019-12-16 18:26:37'),
(15, 69, 4, 15, '13', 'EntryPDReport', 'document1576504225.png', '2019-12-16 19:20:25', '2019-12-16 19:20:25'),
(16, 63, 4, 4, '13', 'EntryPDReport', 'document1576505096.png', '2019-12-16 19:34:56', '2019-12-16 19:34:56'),
(17, 60, 4, 2, '13', 'EntryPDReport', 'document1576505391.png', '2019-12-16 19:39:51', '2019-12-16 19:39:51'),
(18, 71, 4, 16, '25', 'EntryPDReport', 'document1576582361.png', '2019-12-17 17:02:41', '2019-12-17 17:02:41'),
(19, 72, 4, 17, '13', 'EntryPDReport', 'document1576584349.jpg', '2019-12-17 17:35:49', '2019-12-17 17:35:49'),
(20, 72, 4, 17, '13', 'EntryPDReport', 'document1576584448.jpg', '2019-12-17 17:37:28', '2019-12-17 17:37:28'),
(21, 73, 4, 18, '13', 'EntryPDReport', 'document1576585312.png', '2019-12-17 17:51:52', '2019-12-17 17:51:52'),
(22, 74, 4, 19, '13', 'EntryPDReport', 'document1576588580.png', '2019-12-17 18:46:20', '2019-12-17 18:46:20'),
(23, 78, 4, 24, '13', 'EntryPDReport', 'document1576652207.png', '2019-12-18 12:26:47', '2019-12-18 12:26:47'),
(24, 79, 4, 25, '13', 'EntryPDReport', 'document1576653650.png', '2019-12-18 12:50:50', '2019-12-18 12:50:50'),
(25, 84, 4, 28, '13', 'EntryPDReport', 'document1576761115.png', '2019-12-19 18:41:55', '2019-12-19 18:41:55'),
(26, 87, 4, 30, '13', 'EntryPDReport', 'document1576843326.docx', '2019-12-20 17:32:06', '2019-12-20 17:32:06'),
(27, 86, 4, 29, '13', 'EntryPDReport', 'document1576844609.png', '2019-12-20 17:53:29', '2019-12-20 17:53:29'),
(28, 87, 4, 30, '13', 'ExitPDReport', 'document1576844734.png', '2019-12-20 17:55:34', '2019-12-20 17:55:34'),
(29, 79, 4, 25, '13', 'EntryPDReport', 'document1578548395.png', '2020-01-09 11:09:55', '2020-01-09 11:09:55'),
(30, 87, 4, 30, '13', 'ExitPDReport', 'document1578573341.png', '2020-01-09 18:05:41', '2020-01-09 18:05:41'),
(31, 87, 4, 30, '13', 'ExitPDReport', 'document1578573360.png', '2020-01-09 18:06:00', '2020-01-09 18:06:00'),
(32, 87, 4, 30, '13', 'ExitPDReport', 'document1578573966.png', '2020-01-09 18:16:07', '2020-01-09 18:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `email_log`
--

CREATE TABLE `email_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `send` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_log`
--

INSERT INTO `email_log` (`id`, `unit_id`, `tenant_id`, `pde_id`, `vo_id`, `send`, `received`, `email_type`, `message`, `created_at`, `updated_at`) VALUES
(1, 8, 9, NULL, 10, '9', '10', 'message', 'Lorem Ipsum 12345', '2019-11-25 11:12:47', '2019-11-25 11:12:47'),
(2, 22, 16, NULL, 1, '16', '1', 'message', 'mk', '2019-11-25 13:18:01', '2019-11-25 13:18:01'),
(3, 3, 20, NULL, 10, '20', '10', 'message', 'gfggggggggggggggg', '2019-11-26 17:46:27', '2019-11-26 17:46:27'),
(4, 50, 9, NULL, 10, '9', '10', 'message', 'se', '2019-12-04 12:52:07', '2019-12-04 12:52:07'),
(5, 52, 43, NULL, 10, '4', '10', 'message', 'test', '2019-12-11 18:08:36', '2019-12-11 18:08:36'),
(6, 22, 4, NULL, 10, '4', '10', 'message', 'Test', '2019-12-12 12:08:54', '2019-12-12 12:08:54'),
(7, 52, 4, NULL, 10, '10', '4', 'message', 'ftsest', '2019-12-12 12:48:33', '2019-12-12 12:48:33'),
(8, 52, 4, NULL, 10, '4', '10', 'message', 'ffffffffffffffffffffff', '2019-12-12 13:10:45', '2019-12-12 13:10:45'),
(9, 52, 4, NULL, 10, '4', '10', 'message', 'testing wala', '2019-12-12 18:21:04', '2019-12-12 18:21:04'),
(16, 45, 4, NULL, 10, '4', '10', 'message', 'my new unit', '2019-12-12 19:21:05', '2019-12-12 19:21:05'),
(17, 45, 4, NULL, 10, '4', '10', 'message', 'xsdfs', '2019-12-12 19:40:33', '2019-12-12 19:40:33'),
(18, 45, 4, NULL, 10, '4', '10', 'message', 'test with email', '2019-12-12 19:42:50', '2019-12-12 19:42:50'),
(19, 45, 4, NULL, 10, '10', '4', 'message', 'hhhhhhhhhhhh', '2019-12-12 19:45:56', '2019-12-12 19:45:56'),
(20, 45, 4, NULL, 10, '4', '10', 'message', 'hgjhgfjgjgfjgjgjjjj', '2019-12-12 19:46:13', '2019-12-12 19:46:13'),
(21, 52, 9, NULL, 10, '9', '10', 'message', 'msg with another user', '2019-12-13 10:47:34', '2019-12-13 10:47:34'),
(22, 45, 4, NULL, 10, '4', '10', 'message', 'tes wuthkbdfk hdsjfhhhh hhhhhhhhhhht', '2019-12-14 11:36:46', '2019-12-14 11:36:46'),
(23, 45, 4, NULL, 10, '10', '4', 'message', 'doen', '2019-12-14 11:38:44', '2019-12-14 11:38:44'),
(24, 45, 4, NULL, 10, '4', '10', 'message', 'fffff', '2019-12-14 11:39:06', '2019-12-14 11:39:06'),
(25, 52, 43, NULL, 10, '10', '43', 'message', 'ab kya kre', '2019-12-14 13:40:01', '2019-12-14 13:40:01'),
(26, 52, 43, NULL, 10, '10', '43', 'message', 'ye kya hua', '2019-12-14 13:42:06', '2019-12-14 13:42:06'),
(31, 22, 4, NULL, 10, '4', '10', 'message', 'f', '2019-12-14 14:30:10', '2019-12-14 14:30:10'),
(32, 22, 4, NULL, 10, '10', '4', 'message', 'again test', '2019-12-14 14:31:48', '2019-12-14 14:31:48'),
(33, 22, 4, NULL, 10, '4', '10', 'message', 'Okay', '2019-12-14 14:33:03', '2019-12-14 14:33:03'),
(34, 22, 4, NULL, 10, '10', '4', 'message', 'done', '2019-12-14 14:33:28', '2019-12-14 14:33:28'),
(35, 22, 9, NULL, 10, '9', '10', 'message', 'asking for question', '2019-12-14 14:40:09', '2019-12-14 14:40:09'),
(36, 8, 9, NULL, 10, '10', '9', 'message', 'testing done', '2019-12-14 17:02:31', '2019-12-14 17:02:31'),
(37, 52, 4, NULL, 10, '4', '10', 'message', 'abc', '2019-12-14 17:02:57', '2019-12-14 17:02:57'),
(38, 52, 4, NULL, 10, '4', '10', 'message', 'ds', '2019-12-14 17:06:50', '2019-12-14 17:06:50'),
(39, 50, 29, NULL, 10, '29', '10', 'message', 'ffffffffffffffffffffffffffffffffffffffffffffff', '2019-12-14 19:39:16', '2019-12-14 19:39:16'),
(40, 66, 29, NULL, 27, '29', '27', 'message', 'testing', '2019-12-14 19:42:52', '2019-12-14 19:42:52'),
(41, 68, 9, NULL, 10, '9', '10', 'message', 'test', '2019-12-16 17:10:20', '2019-12-16 17:10:20'),
(42, 80, 9, NULL, 10, '9', '10', 'message', 'Is this Property for rent purpose ?', '2019-12-18 13:24:52', '2019-12-18 13:24:52'),
(43, 50, 29, NULL, 10, '10', '29', 'message', 'yes', '2019-12-18 19:03:59', '2019-12-18 19:03:59'),
(44, 50, 29, NULL, 10, '29', '10', 'message', 'agt', '2019-12-18 19:04:17', '2019-12-18 19:04:17'),
(45, 66, 29, NULL, 27, '29', '27', 'message', 'done hain mam', '2019-12-18 19:11:24', '2019-12-18 19:11:24'),
(46, 80, 29, NULL, 10, '29', '10', 'message', 'Test message...', '2019-12-18 19:15:27', '2019-12-18 19:15:27'),
(47, 80, 29, NULL, 10, '29', '10', 'message', 'dfsgfsgds', '2019-12-18 19:15:45', '2019-12-18 19:15:45'),
(48, 50, 29, NULL, 10, '10', '29', 'message', 'qqqqq rrrr', '2019-12-18 19:23:29', '2019-12-18 19:23:29'),
(49, 8, 9, NULL, 10, '10', '9', 'message', 'aaaa bbbb', '2019-12-18 19:24:31', '2019-12-18 19:24:31'),
(50, 80, 29, NULL, 10, '10', '29', 'message', 'hhhhhhhhhhhh', '2019-12-18 19:25:47', '2019-12-18 19:25:47'),
(51, 3, 20, NULL, 10, '10', '20', 'message', 'testing done', '2019-12-18 19:32:01', '2019-12-18 19:32:01'),
(52, 3, 20, NULL, 10, '10', '20', 'message', 'opoikkk', '2019-12-18 19:33:12', '2019-12-18 19:33:12'),
(53, 80, 29, NULL, 10, '29', '10', 'message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-12-18 19:34:18', '2019-12-18 19:34:18'),
(54, 81, 29, NULL, 10, '29', '10', 'message', 'fd', '2019-12-18 19:34:55', '2019-12-18 19:34:55'),
(55, 80, 29, NULL, 10, '10', '29', 'message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-12-18 19:35:01', '2019-12-18 19:35:01'),
(56, 81, 29, NULL, 10, '29', '10', 'message', 'hi', '2019-12-18 19:35:30', '2019-12-18 19:35:30'),
(57, 80, 29, NULL, 10, '29', '10', 'message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-12-18 19:35:31', '2019-12-18 19:35:31'),
(58, 80, 29, NULL, 10, '29', '10', 'message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-12-18 19:35:54', '2019-12-18 19:35:54'),
(59, 80, 29, NULL, 10, '29', '10', 'message', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '2019-12-18 19:36:16', '2019-12-18 19:36:16'),
(60, 80, 29, NULL, 10, '29', '10', 'message', 'kk', '2019-12-18 19:40:24', '2019-12-18 19:40:24'),
(61, 80, 29, NULL, 10, '29', '10', 'message', 'hjklhjklh', '2019-12-18 19:41:48', '2019-12-18 19:41:48'),
(62, 8, 9, NULL, 10, '9', '10', 'message', 'vmbn,', '2019-12-20 12:28:00', '2019-12-20 12:28:00'),
(63, 8, 9, NULL, 10, '9', '10', 'message', 'vmbn,', '2019-12-20 12:28:01', '2019-12-20 12:28:01'),
(64, 8, 9, NULL, 10, '9', '10', 'message', 'hjhjhj', '2019-12-20 18:17:51', '2019-12-20 18:17:51'),
(65, 8, 9, NULL, 10, '9', '10', 'message', 'hjhjhj', '2019-12-20 18:17:54', '2019-12-20 18:17:54'),
(66, 22, 9, NULL, 10, '9', '10', 'message', NULL, '2019-12-20 18:35:22', '2019-12-20 18:35:22'),
(67, 22, 9, NULL, 10, '9', '10', 'message', 'cfhndgfc', '2019-12-20 18:35:32', '2019-12-20 18:35:32'),
(68, 22, 9, NULL, 10, '9', '10', 'message', NULL, '2019-12-20 18:35:43', '2019-12-20 18:35:43'),
(69, 68, 9, NULL, 10, '9', '10', 'message', 'nnnnnnnnnnn', '2019-12-20 18:41:16', '2019-12-20 18:41:16'),
(70, 68, 9, NULL, 10, '9', '10', 'message', NULL, '2019-12-20 18:41:29', '2019-12-20 18:41:29'),
(71, 68, 9, NULL, 10, '10', '9', 'message', 'ff', '2019-12-20 18:42:59', '2019-12-20 18:42:59'),
(72, 68, 9, NULL, 10, '9', '10', 'message', NULL, '2019-12-20 18:53:52', '2019-12-20 18:53:52'),
(73, 50, 29, NULL, 10, '29', '10', 'message', 'ask questions', '2019-12-25 15:10:34', '2019-12-25 15:10:34'),
(74, 50, 29, NULL, 10, '29', '10', 'message', 'send', '2019-12-25 15:25:16', '2019-12-25 15:25:16'),
(75, 66, 29, NULL, 27, '27', '29', 'message', 'here type', '2019-12-25 15:27:50', '2019-12-25 15:27:50'),
(76, 66, 29, NULL, 27, '29', '27', 'message', 'sen', '2019-12-25 15:28:14', '2019-12-25 15:28:14');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extend_request`
--

CREATE TABLE `extend_request` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `extend_date` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extend_time` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = termination request, 1 = accept, 2 = reject',
  `isDeleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `extend_request`
--

INSERT INTO `extend_request` (`id`, `unit_id`, `booking_id`, `tenant_id`, `pde_id`, `pm_id`, `po_id`, `extend_date`, `extend_time`, `remark`, `transaction_id`, `status`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 4, 13, 11, 10, '2021/12/29', '205', 'bvn', NULL, '0', 0, '2019-11-25 13:53:24', '2019-11-25 13:53:24'),
(2, 4, 7, 4, 13, 11, 10, '2021/12/31', '25', 'gf', NULL, '0', 0, '2019-11-25 13:58:20', '2019-11-25 13:58:20');

-- --------------------------------------------------------

--
-- Table structure for table `guarantor`
--

CREATE TABLE `guarantor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_id_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guarantor`
--

INSERT INTO `guarantor` (`id`, `name`, `email`, `phone_no`, `address`, `photo`, `photo_id_proof`, `status`, `created_at`, `updated_at`, `tenant_id`, `unit_id`) VALUES
(1, 'Florida Boj', 'jyotivisionvivante@gmail.com', '8669200980', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574079336.png', NULL, '2019-11-18 16:57:37', '2019-11-18 17:45:36', 9, 3),
(2, 'bvn', 'ewf@fds.yhg', '9512536219', '11', NULL, 'photo_id_proof1574152375.png', NULL, '2019-11-19 14:02:55', '2019-11-19 14:02:55', 13, 3),
(3, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574167839.png', NULL, '2019-11-19 18:20:39', '2019-11-19 18:20:39', 13, 7),
(4, 'das', 'ds@gmail.df', '3232343434', 'r', NULL, 'photo_id_proof1574168824.png', NULL, '2019-11-19 18:37:04', '2019-11-19 18:37:04', 4, 6),
(5, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574251889.png', NULL, '2019-11-20 17:41:29', '2019-11-20 17:41:29', 9, 9),
(6, 'adf', 'dsd@gf.bnbv', '4545454554', 'yyrty', NULL, 'photo_id_proof1574319414.png', NULL, '2019-11-21 12:26:54', '2019-11-21 12:26:54', 4, 7),
(7, 'ds', 'sd@gfh.bn', '2323232323', 'f', NULL, 'photo_id_proof1574338549.png', NULL, '2019-11-21 17:45:49', '2019-11-21 17:45:49', 4, 4),
(8, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574416371.png', NULL, '2019-11-22 15:22:51', '2019-11-22 15:22:51', 9, 12),
(9, 'weat', 'ws@gmail.vom', '9786556763', '1234', NULL, 'photo_id_proof1574418362.png', NULL, '2019-11-22 15:56:02', '2019-11-22 15:56:02', 9, 11),
(10, 'qwerty', 'test@yopmail.com', '8765679078', 'Post', NULL, 'photo_id_proof1574422624.png', NULL, '2019-11-22 17:06:18', '2019-11-22 17:07:04', 9, 10),
(11, 'guarantor@gmail.com', 'guarantor@gmail.com', '3233323421', '122', NULL, 'photo_id_proof1574423678.png', NULL, '2019-11-22 17:24:38', '2019-11-22 17:24:38', 9, 7),
(12, 'asdfgg', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574658439.png', NULL, '2019-11-25 10:37:19', '2019-11-25 10:37:19', 16, 6),
(13, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574659750.png', NULL, '2019-11-25 10:59:10', '2019-11-25 10:59:10', 9, 23),
(14, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574660895.png', NULL, '2019-11-25 11:18:15', '2019-11-25 11:18:15', 9, 24),
(15, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574662817.png', NULL, '2019-11-25 11:50:17', '2019-11-25 11:50:17', 9, 25),
(16, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574665139.png', NULL, '2019-11-25 12:28:59', '2019-11-25 12:28:59', 9, 26),
(17, 'asd', 'adscfa@gmail.com', '12345678900', 'swdfereg bvgreg', NULL, 'photo_id_proof1574667655.jpg', NULL, '2019-11-25 13:10:55', '2019-11-25 13:10:55', 16, 16),
(18, 'ttt', 'ttjol@gmail.com', '4444444444', 'fdgdfg', NULL, 'photo_id_proof1574668144.jpg', NULL, '2019-11-25 13:19:04', '2019-11-25 13:19:04', 16, 22),
(19, 'wqew', 'wdew@f', '6282828655', 'ddssc', NULL, 'photo_id_proof1574668401.jpg', NULL, '2019-11-25 13:23:21', '2019-11-25 13:23:21', 16, 5),
(20, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574676983.png', NULL, '2019-11-25 15:46:23', '2019-11-25 15:46:23', 9, 27),
(21, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574683251.png', NULL, '2019-11-25 17:30:51', '2019-11-25 17:30:51', 9, 28),
(22, 'qqwwww', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574684889.png', NULL, '2019-11-25 17:58:09', '2019-11-25 17:58:09', 9, 29),
(23, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574687029.png', NULL, '2019-11-25 18:33:49', '2019-11-25 18:33:49', 9, 30),
(24, 'fg', 'fg@fgh.bnh', '6767676767', 'hj', NULL, 'photo_id_proof1574754428.png', NULL, '2019-11-26 13:17:08', '2019-11-26 13:17:08', 4, 8),
(25, 'dfgv', 'df@dfgh.n', '7676767677', 'ghj', NULL, 'photo_id_proof1574758055.png', NULL, '2019-11-26 14:17:35', '2019-11-26 14:17:35', 4, 23),
(26, 'dfs', 'dfs@dfh.b', '4545454545', 'g', NULL, 'photo_id_proof1574764182.jpg', NULL, '2019-11-26 15:59:42', '2019-11-26 15:59:42', 4, 5),
(27, 'sd', 'sdf@gh.n', '3434343434', 'fg', NULL, 'photo_id_proof1574765876.png', NULL, '2019-11-26 16:27:56', '2019-11-26 16:27:56', 9, 5),
(28, 'ljnaa', 'bg@h.c', '9844444447', 'xc', NULL, 'photo_id_proof1574771560.jpg', NULL, '2019-11-26 18:02:40', '2019-11-26 18:02:40', 20, 3),
(29, '5e', 'dgf@hj.bbb', '9813607878', '56', NULL, 'photo_id_proof1574831246.png', NULL, '2019-11-27 10:37:26', '2019-11-27 10:37:26', 21, 6),
(30, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574850098.png', NULL, '2019-11-27 15:51:38', '2019-11-27 15:51:38', 9, 35),
(31, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574850784.png', NULL, '2019-11-27 16:03:04', '2019-11-27 16:03:04', 9, 36),
(32, 'ghhjuyy tyyyy', 'chetanvisionvivante@gmail.com', '8669266287', 'tttghhh', NULL, 'photo_id_proof1574851605.png', NULL, '2019-11-27 16:16:45', '2019-11-27 16:16:45', 9, 37),
(33, 'ghhjuyy tyyyy', 'chetanvisionvivante@gmail.com', '8669266287', 'tttghhh', NULL, 'photo_id_proof1574853952.png', NULL, '2019-11-27 16:28:59', '2019-11-27 16:55:52', 9, 38),
(34, 'sssss dddd', 'chetanvisionvivante@gmail.com', '8669266287', 'aaaa', NULL, 'photo_id_proof1574852724.png', NULL, '2019-11-27 16:35:24', '2019-11-27 16:35:24', 9, 39),
(35, 'ghhjuyy tyyyy', 'chetanvisionvivante@gmail.com', '8669266287', 'tttghhh', NULL, 'photo_id_proof1574855789.png', NULL, '2019-11-27 17:17:37', '2019-11-27 17:26:29', 9, 40),
(36, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574919062.png', NULL, '2019-11-27 17:28:48', '2019-11-28 11:01:02', 9, 42),
(37, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574918828.png', NULL, '2019-11-28 10:46:31', '2019-11-28 10:57:08', 9, 44),
(38, 'dsg dfgd', 'chetanvisionvivante@gmail.com', '8669266287', 'dfg', NULL, 'photo_id_proof1574919617.png', NULL, '2019-11-28 11:08:25', '2019-11-28 11:10:17', 9, 45),
(39, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574920130.png', NULL, '2019-11-28 11:17:00', '2019-11-28 11:18:50', 9, 46),
(40, 'ghhjuyy tyyyy', 'chetanvisionvivante@gmail.com', '8669266287', 'tttghhh', NULL, 'photo_id_proof1576497085.png', NULL, '2019-11-28 11:29:45', '2019-12-16 17:21:25', 9, 47),
(41, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1574921278.png', NULL, '2019-11-28 11:37:58', '2019-11-28 11:37:58', 9, 48),
(42, 'gg', 'jyotivisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1575444195.png', NULL, '2019-12-04 12:53:15', '2019-12-04 12:53:15', 9, 50),
(43, 'Florida Boats', 'jyotivisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1575444761.png', NULL, '2019-12-04 13:02:41', '2019-12-04 13:02:41', 9, 51),
(44, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1575446061.png', NULL, '2019-12-04 13:24:21', '2019-12-04 13:24:21', 9, 52),
(45, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1575449671.png', NULL, '2019-12-04 14:24:31', '2019-12-04 14:24:31', 9, 49),
(46, 'gg', 'gg@yopmail.com', '9466567889', 'manimajra', NULL, 'photo_id_proof1576222316.png', NULL, '2019-12-04 14:40:47', '2019-12-13 13:01:56', 29, 53),
(47, 'ert', 'dfs@dfg.bbhb', '9898989898', 'bvfhjfg', NULL, 'photo_id_proof1576219423.png', NULL, '2019-12-04 18:44:49', '2019-12-13 12:13:43', 29, 52),
(48, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1575964973.png', NULL, '2019-12-10 13:32:53', '2019-12-10 13:32:53', 9, 59),
(49, 'AAAA ASSASA', 'chetanvisionvivante@gmail.com', '8669266287', 'QQWQEQ', NULL, 'photo_id_proof1576045825.jpeg', NULL, '2019-12-10 13:55:38', '2019-12-11 12:00:25', 9, 54),
(50, 'dfg', 'dfg3@fgh.b', '4545454545', 'dfg', NULL, 'photo_id_proof1576048358.png', NULL, '2019-12-11 12:42:38', '2019-12-11 12:42:38', 9, 60),
(51, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576126722.png', NULL, '2019-12-12 10:28:42', '2019-12-12 10:28:42', 9, 62),
(52, 'qwerty', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576127068.png', NULL, '2019-12-12 10:34:28', '2019-12-12 10:34:28', 9, 63),
(53, 'ghhjuyy tyyyy', 'chetanvisionvivante@gmail.com', '8669266287', 'tttghhh', NULL, 'photo_id_proof1576148685.png', NULL, '2019-12-12 16:34:45', '2019-12-12 16:34:45', 9, 64),
(54, 'guarantor', 'guarantor@yopmail.com', '9813604578', 'paris', NULL, 'photo_id_proof1576217661.jpeg', NULL, '2019-12-13 11:44:21', '2019-12-13 11:44:21', 29, 65),
(55, '453', '5435@g.com', '7707907575', 'test', NULL, 'photo_id_proof1576483105.jpeg', NULL, '2019-12-16 13:28:25', '2019-12-16 13:28:25', 49, 49),
(56, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576493893.png', NULL, '2019-12-16 16:28:13', '2019-12-16 16:28:13', 9, 67),
(57, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576496581.png', NULL, '2019-12-16 17:13:01', '2019-12-16 17:13:01', 9, 68),
(58, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576503908.png', NULL, '2019-12-16 19:15:08', '2019-12-16 19:15:08', 9, 69),
(59, 'k', 'gnv@yopmail.com', '9845645478', '204', NULL, 'photo_id_proof1576581826.png', NULL, '2019-12-17 16:53:46', '2019-12-17 16:53:46', 29, 71),
(60, 'Florida Boats', 'jyotivisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576583488.png', NULL, '2019-12-17 17:21:28', '2019-12-17 17:21:28', 9, 72),
(61, 'dsg dfgd', 'jyotivisionvivante@gmail.com', '8669266287', 'dfg', NULL, 'photo_id_proof1576584725.png', NULL, '2019-12-17 17:42:05', '2019-12-17 17:42:05', 9, 73),
(62, 'qwerty ytrewq', 'jyotivisionvivante@gmail.com', '8669266287', 'qwerty', NULL, 'photo_id_proof1576587927.png', NULL, '2019-12-17 18:35:27', '2019-12-17 18:35:27', 9, 74),
(63, 'Florida Boats', 'jyotivisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576646333.png', NULL, '2019-12-18 10:48:53', '2019-12-18 10:48:53', 9, 75),
(64, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576649354.png', NULL, '2019-12-18 11:39:14', '2019-12-18 11:39:14', 9, 76),
(65, 'ter', 'ert@DSGF.GH', '6767676767', 'SSD', NULL, 'photo_id_proof1576649851.jpg', NULL, '2019-12-18 11:47:31', '2019-12-18 11:47:31', 4, 70),
(66, 'dsg dfgd', 'jyotivisionvivante@gmail.com', '8669266287', 'dfg', NULL, 'photo_id_proof1576649908.png', NULL, '2019-12-18 11:48:28', '2019-12-18 11:48:28', 9, 77),
(67, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576650862.png', NULL, '2019-12-18 12:04:22', '2019-12-18 12:04:22', 9, 78),
(68, 'dsg dfgd', 'jyotivisionvivante@gmail.com', '8669266287', 'dfg', NULL, 'photo_id_proof1576652980.png', NULL, '2019-12-18 12:39:40', '2019-12-18 12:39:40', 9, 79),
(69, 'Florida Boats', 'chetanvisionvivante@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576676265.png', NULL, '2019-12-18 19:07:45', '2019-12-18 19:07:45', 9, 82),
(70, 'fdg', 'dfg@dfs.com', '5465463546', 'gfh', NULL, 'photo_id_proof1576678063.PNG', NULL, '2019-12-18 19:37:43', '2019-12-18 19:37:43', 29, 81),
(71, 'Florida Boats', 'a@gmail.com', '8669266287', '279 Circuit St, Hanover,', NULL, 'photo_id_proof1576760344.png', NULL, '2019-12-19 18:29:04', '2019-12-19 18:29:04', 9, 84),
(72, '34', 'g@yopmail.com', '3485453453', 'panchkula', NULL, 'photo_id_proof1576839144.png', NULL, '2019-12-20 16:22:24', '2019-12-20 16:22:24', 9, 86),
(73, 'g', 'g@yopmail.com', '3434343434', 'london', NULL, 'photo_id_proof1576839535.png', NULL, '2019-12-20 16:28:55', '2019-12-20 16:28:55', 9, 87),
(74, 'amit', 'amit@yopmail.com', '9198136078', 'dsf', NULL, 'photo_id_proof1578399050.jpg', NULL, '2020-01-07 17:40:50', '2020-01-07 17:40:50', 66, 1),
(75, 'amit', 'jatin@gmail.com', '3454234238', 'test', NULL, 'photo_id_proof1578401322.jpg', NULL, '2020-01-07 18:18:42', '2020-01-07 18:18:42', 66, 11),
(76, 'sehgal', 'jatin@gmail.com', '3454234234', 'test', NULL, 'photo_id_proof1578401539.jpg', NULL, '2020-01-07 18:22:19', '2020-01-07 18:22:19', 66, 50),
(77, 'asd', 'as@fg.n', '4545454545', 'rrtry', NULL, 'photo_id_proof1578402075.jpg', NULL, '2020-01-07 18:31:15', '2020-01-07 18:31:15', 66, 46),
(78, 'dasf', 'sdf@ds.vbmn', '5445454545', 'dgh', NULL, 'photo_id_proof1578462438.jpg', NULL, '2020-01-08 11:17:18', '2020-01-08 11:17:18', 66, 88);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `user_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `property_unit_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leagl_actions`
--

CREATE TABLE `leagl_actions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `related_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `legal_advisor_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `due_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `create_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action_comment` text COLLATE utf8mb4_unicode_ci,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leagl_actions`
--

INSERT INTO `leagl_actions` (`id`, `related_to`, `po_id`, `unit_id`, `tenant_id`, `legal_advisor_id`, `contract_id`, `due_amount`, `comment`, `status`, `create_time`, `action_time`, `action_comment`, `document`, `created_at`, `updated_at`) VALUES
(1, 'bill', 10, 9, 9, 14, 5, '43', 'dfg', 'pending', '2019-11-26 18:52:02', NULL, NULL, NULL, '2019-11-26 18:52:02', '2019-11-26 18:52:02'),
(2, '7', 10, 27, 9, 14, 20, '123', '55', 'complete', '2019-11-27 13:33:22', NULL, 'vcxbv', '1574841898.jpg', '2019-11-27 13:33:22', '2019-11-27 13:34:58'),
(3, 'gh', 27, 53, 29, 24, 55, '55', 'hj hjgh', 'pending', '2019-12-06 19:58:33', NULL, NULL, NULL, '2019-12-06 19:58:33', '2019-12-06 19:58:33'),
(4, 'meter', 10, 6, 4, 14, 4, '54', 'dsfs', 'complete', '2019-12-09 18:42:15', NULL, 'resolved (by la)', '1576477145.png', '2019-12-09 18:42:15', '2019-12-16 11:49:05'),
(5, 'test', 27, 65, 29, 24, 6, '111', '111', 'pending', '2019-12-13 12:39:48', NULL, NULL, NULL, '2019-12-13 12:39:48', '2019-12-13 12:39:48'),
(6, 'test', 10, 62, 9, 14, 3, '5435', '65465', 'complete', '2019-12-16 18:44:17', NULL, 'MXZ', '1576658749.png', '2019-12-16 18:44:17', '2019-12-18 14:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `membership_payments`
--

CREATE TABLE `membership_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amount` int(11) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `membership_end_at` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `membership_payments`
--

INSERT INTO `membership_payments` (`id`, `user_id`, `payment_email`, `status`, `first_name`, `last_name`, `payer_id`, `total_amount`, `currency`, `payment_time`, `plan_id`, `membership_end_at`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'po@gmail.com', 'succeeded', 'Po', 'po', 'ch_1FfK2mET9w4zgxTQJt6KwBvv', 55, 'EUR', '2019-11-16 11:12:01', 1, '2019-12-16 11:12:01', '0', '2019-11-16 11:12:01', '2019-11-16 11:12:01'),
(2, 2, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-16 11:27:50', 1, '2019-12-16 11:27:50', '0', '2019-11-16 11:27:50', '2019-11-16 11:27:50'),
(3, 5, 'p@yopmail.com', 'succeeded', 'amit', 'sharma', 'ch_1FfQUSET9w4zgxTQ0yHhbLPt', 55, 'EUR', '2019-11-16 18:05:01', 1, '2019-12-16 18:05:01', '0', '2019-11-16 18:05:02', '2019-11-16 18:05:02'),
(4, 8, 'tes@yopmail.com', 'succeeded', 'dddd', 'ssss', 'ch_1Fg51pET9w4zgxTQStHpGmKG', 55, 'EUR', '2019-11-18 13:22:10', 1, '2019-12-18 13:22:10', '0', '2019-11-18 13:22:10', '2019-11-18 13:22:10'),
(5, 8, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-18 13:39:56', 1, '2019-12-18 13:39:56', '0', '2019-11-18 13:39:56', '2019-11-18 13:39:56'),
(6, 8, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-18 13:47:57', 1, '2019-12-18 13:47:57', '0', '2019-11-18 13:47:57', '2019-11-18 13:47:57'),
(7, 10, 'po26@yopmail.com', 'succeeded', 'fname', 'lname', 'ch_1Fg5aEET9w4zgxTQRrZ2mfc4', 55, 'EUR', '2019-11-18 13:57:43', 1, '2019-12-18 13:57:43', '0', '2019-11-18 13:57:43', '2019-11-18 13:57:43'),
(8, 10, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-25 13:32:29', 1, '2019-12-25 13:32:29', '0', '2019-11-25 13:32:29', '2019-11-25 13:32:29'),
(9, 10, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-25 13:35:21', 1, '2019-12-25 13:35:21', '0', '2019-11-25 13:35:21', '2019-11-25 13:35:21'),
(10, 10, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-11-25 13:36:16', 1, '2019-12-25 13:36:16', '0', '2019-11-25 13:36:16', '2019-11-25 13:36:16'),
(11, 22, 'po28@yopmail.com', 'succeeded', 'sadf', 'fafa', 'ch_1FjQdGET9w4zgxTQJ1cb3rwX', 55, 'EUR', '2019-11-27 19:02:38', 1, '2019-12-27 19:02:38', '0', '2019-11-27 19:02:38', '2019-11-27 19:02:38'),
(12, 27, 'POjatinsehgal@yopmail.com', 'succeeded', 'POjatin', 'POsehgal', 'ch_1FlsloET9w4zgxTQ1jfWQ7kE', 55, 'EUR', '2019-12-04 13:29:36', 1, '2020-01-04 13:29:36', '0', '2019-12-04 13:29:36', '2019-12-04 13:29:36'),
(13, 28, 'malkeetvisionvivante54543@gmail.com', 'succeeded', 'test', 'test', 'ch_1FlsmxET9w4zgxTQmN7npPjq', 55, 'EUR', '2019-12-04 13:30:48', 1, '2020-01-04 13:30:48', '0', '2019-12-04 13:30:48', '2019-12-04 13:30:48'),
(14, 30, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'EUR', '2019-12-04 15:45:45', 1, '2020-01-04 15:45:45', '0', '2019-12-04 15:45:45', '2019-12-04 15:45:45'),
(15, 10, 'surajbansalvision-buyer@gmail.com', 'approved', 'test', 'buyer', 'MKU6WJBYDC2QA', 55, 'USD', '2019-12-16 15:47:07', 1, '2020-01-16 15:47:07', '0', '2019-12-16 15:47:07', '2019-12-16 15:47:07'),
(17, 10, 'po26@yopmail.com', 'succeeded', 'fname', 'lname', 'ch_1FqH17ET9w4zgxTQ91lCuZwl', 55, 'EUR', '2019-12-16 16:11:34', 1, '2020-01-16 16:11:34', '0', '2019-12-16 16:11:34', '2019-12-16 16:11:34'),
(18, 10, 'malkeetvisionvivante@gmail.com', 'succeeded', 'fname', 'lname', 'ch_1FqHA5ET9w4zgxTQPDE1Y6yr', 55, 'EUR', '2019-12-16 16:20:50', 1, '2020-01-16 16:20:50', '0', '2019-12-16 16:20:50', '2019-12-16 16:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `send` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0= default, 1= send, 2 = did not send',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `unit_id`, `appointment_id`, `booking_id`, `tenant_id`, `pde_id`, `vo_id`, `send`, `received`, `email_type`, `message`, `time`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 4, NULL, 2, '4', '2', 'Visit', 'we', '2019/11/19 11:11:02', 0, '2019-11-18 11:28:02', '2019-11-18 11:28:02'),
(2, 3, 2, NULL, 9, NULL, 12, '9', '12', 'Visit', 'Boat', '2019/11/19 14:11:57', 0, '2019-11-18 14:27:57', '2019-11-18 14:27:57'),
(3, 3, 2, NULL, 9, NULL, 12, '12', '9', 'Visit', 'oiou', '2019/11/19 14:11:46', 1, '2019-11-18 14:31:46', '2019-11-18 14:31:46'),
(4, 3, 3, NULL, 9, NULL, 12, '9', '12', 'Visit', 'Description', '2019/11/19 16:11:27', 0, '2019-11-18 16:23:27', '2019-11-18 16:23:27'),
(5, 3, 4, NULL, 9, NULL, 12, '9', '12', 'Visit', 'Descriptionllghj jhkj', '2019/11/19 16:11:39', 0, '2019-11-18 16:26:39', '2019-11-18 16:26:39'),
(6, 3, 5, NULL, 9, NULL, 12, '9', '12', 'Visit', 'Description33', '2019/11/19 16:11:41', 0, '2019-11-18 16:31:41', '2019-11-18 16:31:41'),
(7, 5, 6, NULL, 11, NULL, 10, '11', '10', 'Visit', 'Description 1', '2019/11/20 16:11:13', 0, '2019-11-19 16:52:13', '2019-11-19 16:52:13'),
(8, 12, 15, NULL, 9, 13, NULL, '13', '9', 'Visit', 'bvnvmn', '2019/11/23 15:11:22', 1, '2019-11-22 15:29:22', '2019-11-22 15:29:22'),
(9, 8, 17, NULL, 4, NULL, 12, '4', '12', 'Visit', 'XZSdasdasd', '2019/11/23 19:11:01', 0, '2019-11-22 19:41:01', '2019-11-22 19:41:01'),
(10, 8, 18, NULL, 4, NULL, 12, '4', '12', 'Visit', 'vbgdfg', '2019/11/23 19:11:56', 0, '2019-11-22 19:41:56', '2019-11-22 19:41:56'),
(11, 16, 20, NULL, 16, NULL, 1, '16', '1', 'Visit', 'kglgkg', '2019/11/26 13:11:19', 0, '2019-11-25 13:17:19', '2019-11-25 13:17:19'),
(12, 3, 22, NULL, 19, NULL, 12, '19', '12', 'Visit', 'dfdsf', '2019/11/27 17:11:03', 0, '2019-11-26 17:42:03', '2019-11-26 17:42:03'),
(13, 50, 23, NULL, 9, NULL, 12, '9', '12', 'Visit', 'dd', '2019/12/05 12:12:53', 0, '2019-12-04 12:49:53', '2019-12-04 12:49:53'),
(14, 50, 24, NULL, 9, NULL, 12, '9', '12', 'Visit', 'ddd', '2019/12/05 12:12:48', 0, '2019-12-04 12:50:48', '2019-12-04 12:50:48'),
(15, 53, 28, NULL, 29, NULL, 23, '29', '23', 'Visit', 'asas', '2019/12/05 13:12:21', 0, '2019-12-04 13:57:21', '2019-12-04 13:57:21'),
(16, 53, 29, NULL, 29, NULL, 23, '29', '23', 'Visit', 'v', '2019/12/05 14:12:58', 0, '2019-12-04 14:16:58', '2019-12-04 14:16:58'),
(17, 60, 32, NULL, 43, 13, NULL, '13', '43', 'Visit', 'dfgdgd', '2019/12/12 16:12:09', 1, '2019-12-11 16:08:09', '2019-12-11 16:08:09'),
(18, 63, 34, NULL, 9, 13, NULL, '13', '9', 'Visit', 'http://122.160.138.253/bigsaver/', '2019/12/13 10:12:08', 1, '2019-12-12 10:52:08', '2019-12-12 10:52:08'),
(19, 72, 41, NULL, 9, 13, NULL, '13', '9', 'Visit', 'Please be on time for PD Visit', '2019/12/18 17:12:05', 1, '2019-12-17 17:34:05', '2019-12-17 17:34:05'),
(20, 73, 42, NULL, 9, 13, NULL, '13', '9', 'Visit', 'd', '2019/12/18 17:12:36', 1, '2019-12-17 17:45:36', '2019-12-17 17:45:36'),
(21, 78, 44, NULL, 9, 13, NULL, '13', '9', 'Visit', 'Be on time', '2019/12/19 12:12:11', 1, '2019-12-18 12:25:11', '2019-12-18 12:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE `meters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `meter_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meter_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ean_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `consumption` int(50) DEFAULT '0',
  `document_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meters`
--

INSERT INTO `meters` (`id`, `unit_id`, `meter_type`, `meter_number`, `ean_number`, `unit_price`, `consumption`, `document_file`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'electric_meter', '888888888888888', 'EN5654645', '6', 1, NULL, 2, '2019-11-16 11:40:09', '2019-11-16 11:40:09'),
(2, 1, 'gas_meter', '6546546546', 'EN5654645', '6', 1, NULL, NULL, '2019-11-16 11:41:43', '2019-11-16 11:41:43'),
(3, 2, 'electric_meter', '6546546546', 'EN5435345', '6', 1, NULL, 2, '2019-11-16 11:43:32', '2019-11-16 11:43:32'),
(4, 4, 'water_meter', 'dfgfdsg', 'srft', '4', 1, NULL, 10, '2019-11-19 16:24:20', '2019-11-19 16:24:20'),
(5, 12, 'electric_meter', 'met123', 'ean123', '8', 1, NULL, 10, '2019-11-22 11:32:10', '2019-11-22 11:32:10'),
(6, 12, 'water_meter', 'met1', 'ean2', '2', 1, NULL, 10, '2019-11-22 11:32:10', '2019-11-22 11:32:10'),
(7, 12, 'gas_meter', 'met24', 'ean1q', '20', 1, NULL, 10, '2019-11-22 11:32:10', '2019-11-22 11:32:10'),
(8, 2, 'electric_meter', '12452', '133', '23', 1, NULL, 1, '2019-11-22 20:09:42', '2019-11-22 20:09:42'),
(9, 2, 'electric_meter', '89', '56', '12', 1, NULL, 1, '2019-11-22 20:09:42', '2019-11-22 20:09:42'),
(10, 21, 'electric_meter', '12345', '12345', '12345', 1, NULL, 1, '2019-11-25 10:19:28', '2019-11-25 10:19:28'),
(11, 22, 'electric_meter', '1234', '1234', '1234', 1, NULL, 1, '2019-11-25 10:21:31', '2019-11-25 10:21:31'),
(12, 21, 'electric_meter', '34534', '34543', '21423', 1, NULL, 1, '2019-11-25 10:51:59', '2019-11-25 10:51:59'),
(13, 27, 'electric_meter', 'met456', 'ean123', '8', 1, NULL, NULL, '2019-11-25 15:58:27', '2019-11-25 15:58:27'),
(14, 27, 'water_meter', 'netwed', 'qq', '2', 1, NULL, NULL, '2019-11-25 15:58:42', '2019-11-25 15:58:42'),
(15, 27, 'gas_meter', 'we234', 'ean12345', '5', 1, NULL, NULL, '2019-11-25 15:58:58', '2019-11-25 15:58:58'),
(16, 28, 'electric_meter', 'a1', 'q1', '1', 1, NULL, 10, '2019-11-25 17:28:35', '2019-11-25 17:28:35'),
(17, 28, 'water_meter', 'q123', 'ean123', '2', 1, NULL, 10, '2019-11-25 17:28:36', '2019-11-25 17:28:36'),
(18, 28, 'gas_meter', 'aq123', 'eaw123', '3', 1, NULL, 10, '2019-11-25 17:28:36', '2019-11-25 17:28:36'),
(19, 28, 'electric_meter', 'as2', 'sw2', '2', 1, NULL, 10, '2019-11-25 17:28:36', '2019-11-25 17:28:36'),
(20, 34, 'electric_meter', '12LMKP', 'PL908', '8', 1, NULL, 10, '2019-11-27 13:58:53', '2019-11-27 13:58:53'),
(21, 34, 'water_meter', 'MJN120', 'POL142', '1', 1, NULL, 10, '2019-11-27 13:58:54', '2019-11-27 13:58:54'),
(22, 41, 'electric_meter', '12', '12en', '12', 1, NULL, 1, '2019-11-27 17:19:47', '2019-11-27 17:19:47'),
(23, 43, 'electric_meter', '121', 'en_12323', '1', 1, NULL, 1, '2019-11-27 19:00:28', '2019-11-27 19:00:28'),
(24, 47, 'electric_meter', 'wwsed', 'ffsdd', '3', 1, NULL, 10, '2019-11-28 11:29:04', '2019-11-28 11:29:04'),
(25, 53, 'electric_meter', '32423', '32423', '11', 1, NULL, 27, '2019-12-04 13:47:51', '2019-12-04 13:47:51'),
(26, 55, 'electric_meter', '223131', '312131', '2', 1, NULL, 10, '2019-12-10 13:12:39', '2019-12-10 13:12:39'),
(27, 57, 'water_meter', 'ghjgh', 'ghjg', '2', 1, NULL, 10, '2019-12-10 13:18:39', '2019-12-10 13:18:39'),
(28, 65, 'water_meter', 'dfg3333', 'df', '43', 1, NULL, 27, '2019-12-13 11:43:09', '2019-12-13 11:43:09'),
(29, 66, 'gas_meter', 'rtg444', '45', '5', 1, NULL, 27, '2019-12-14 19:42:13', '2019-12-14 19:42:13'),
(30, 64, 'electric_meter', '6546546546', 'EN5654645', '6', 1, NULL, NULL, '2019-12-16 11:46:03', '2019-12-16 12:06:10'),
(31, 68, 'electric_meter', 'wse1234', 'wes123', '2', 1, NULL, 10, '2019-12-16 16:18:22', '2019-12-16 16:18:22'),
(32, 53, 'water_meter', 'meter45', 'ean5', '10', 1, NULL, NULL, '2019-12-16 18:29:44', '2019-12-16 18:42:50'),
(33, 69, 'electric_meter', '234qwertrrttr', '212qwerty', '2', 1, NULL, NULL, '2019-12-16 19:21:39', '2019-12-16 19:21:39'),
(34, 69, 'electric_meter', 'rew123', 'wes123', '56', 1, NULL, NULL, '2019-12-16 19:23:09', '2019-12-16 19:23:09'),
(35, 63, 'electric_meter', 'dsfds4', '2324df', '12', 1, NULL, 10, '2019-12-16 19:36:47', '2019-12-16 19:36:47'),
(36, 63, 'gas_meter', '12wew', '32wrew', '23', 1, NULL, 10, '2019-12-16 19:36:48', '2019-12-16 19:36:48'),
(37, 60, 'electric_meter', '23424dsf', '2123xzf', '10', 1, NULL, 10, '2019-12-16 19:39:17', '2019-12-16 19:41:04'),
(38, 60, 'water_meter', 'dzfas', 'saf', '33', 1, NULL, 10, '2019-12-16 19:39:17', '2019-12-16 19:39:17'),
(39, 70, 'water_meter', 'dgf', '4554', '45', 1, NULL, NULL, '2019-12-17 11:02:51', '2019-12-17 11:02:51'),
(40, 71, 'gas_meter', 'ree', '34', '5', 1, NULL, 27, '2019-12-17 16:52:14', '2019-12-17 18:33:42'),
(41, 72, 'electric_meter', 'MET1234', 'EAN1234', '8', 1, NULL, 10, '2019-12-17 17:19:08', '2019-12-17 17:19:08'),
(42, 72, 'water_meter', 'EWQ123', 'QWE123', '2', 1, NULL, 10, '2019-12-17 17:19:08', '2019-12-17 17:19:08'),
(43, 72, 'gas_meter', 'BHU123', 'ACS123', '5', 1, NULL, 10, '2019-12-17 17:19:08', '2019-12-17 17:19:08'),
(44, 73, 'electric_meter', 'MNQWERTY', 'EQWERTY', '8.22', 1, NULL, 10, '2019-12-17 17:41:05', '2019-12-17 18:17:08'),
(45, 73, 'water_meter', 'SWE123', '123WSE', '5', 1, NULL, 10, '2019-12-17 17:41:05', '2019-12-17 17:41:05'),
(46, 73, 'gas_meter', '2232RFESR', 'WESD', '12', 1, NULL, 10, '2019-12-17 17:41:05', '2019-12-17 17:41:05'),
(47, 74, 'electric_meter', 'we234', '212qwerty', '1', 1, NULL, 10, '2019-12-17 17:48:08', '2019-12-17 17:48:08'),
(48, 74, 'water_meter', '24242', 'wse233', '11', 1, NULL, 10, '2019-12-17 17:48:08', '2019-12-17 17:48:08'),
(49, 79, 'electric_meter', 'wsa123', 'esa123', '3', 1, NULL, 10, '2019-12-18 12:50:32', '2019-12-18 12:50:32'),
(50, 79, 'water_meter', 'dfgdf', 'sdrf', '1', 1, NULL, 10, '2019-12-18 12:50:32', '2019-12-18 12:50:32'),
(51, 79, 'gas_meter', '2232RFESR', 'EAN123', '12', 1, NULL, 10, '2019-12-18 12:50:32', '2019-12-18 12:50:32'),
(52, 80, 'electric_meter', 'des123', 'wsa123', '1', 1, NULL, 10, '2019-12-18 13:21:49', '2019-12-18 13:21:49'),
(53, 80, 'water_meter', 'dsfds', 'asfda', '2', 1, NULL, 10, '2019-12-18 13:21:49', '2019-12-18 13:21:49'),
(54, 82, 'electric_meter', 'www23', 'sdd3', '2', 1, NULL, 10, '2019-12-18 18:56:27', '2019-12-18 18:56:27'),
(55, 84, 'electric_meter', 'met12345', 'ean12345', '8.25', 1, NULL, 10, '2019-12-19 18:05:04', '2019-12-19 18:05:04'),
(56, 84, 'water_meter', 'metg123', 'eang123', '2', 1, NULL, 10, '2019-12-19 18:05:04', '2019-12-19 18:05:04'),
(57, 84, 'gas_meter', 'metgas123', 'gasean123', '5', 1, NULL, 10, '2019-12-19 18:05:04', '2019-12-19 18:05:04'),
(58, 85, 'electric_meter', 'f123', 'w123', '2', 1, NULL, 10, '2019-12-19 18:06:34', '2019-12-19 18:06:34'),
(59, 85, 'gas_meter', '121wsw2', '112qa2', '23', 1, NULL, 10, '2019-12-19 18:06:34', '2019-12-19 18:06:34'),
(60, 86, 'water_meter', 'eeee', '34dsd', '22', 1, NULL, 10, '2019-12-20 16:19:55', '2019-12-20 17:54:09'),
(61, 87, 'water_meter', 'we', '33', '32', 1, NULL, 10, '2019-12-20 16:21:31', '2019-12-20 16:21:31'),
(62, 87, 'water_meter', '3', '34', '3', 1, NULL, 10, '2019-12-20 16:21:31', '2019-12-20 16:21:31'),
(63, 89, 'electric_meter', 'dsf3', 'dsf333', '34', 6, NULL, 10, '2020-01-09 13:35:07', '2020-01-09 13:35:07'),
(64, 89, 'water_meter', '444', 'df43', '43', 12, NULL, 10, '2020-01-09 13:37:02', '2020-01-09 13:52:32'),
(65, 89, 'gas_meter', '34', 'df43', '43', 34, NULL, 10, '2020-01-09 13:39:16', '2020-01-09 13:39:16');

-- --------------------------------------------------------

--
-- Table structure for table `meter_readings`
--

CREATE TABLE `meter_readings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reading_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_reading` int(11) DEFAULT NULL,
  `current_reading` int(11) DEFAULT NULL,
  `per_unit_price` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `upload_document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `meter_id` int(11) DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reading_type` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meter_readings`
--

INSERT INTO `meter_readings` (`id`, `reading_date`, `last_reading`, `current_reading`, `per_unit_price`, `amount`, `upload_document`, `created_at`, `updated_at`, `unit_id`, `meter_id`, `status`, `reading_type`) VALUES
(1, '2019/11/16 11:50:52', 200, 300, 6, 600, NULL, '2019-11-16 11:41:06', '2019-11-16 11:41:06', 1, 1, 'pending', NULL),
(2, '2019/12/18 11:35:16', 6565, 6569, 6, 24, NULL, '2019-12-16 11:47:16', '2019-12-16 11:47:16', 64, 30, 'pending', NULL),
(3, '2019/12/19 14:45:38', 6569, 7000, 6, 2586, NULL, '2019-12-16 12:07:04', '2019-12-16 12:07:04', 64, 30, 'pending', NULL),
(4, '2019/12/16 18:45:38', 100, 110, 5, 50, '1576501859_2_(1).png', '2019-12-16 18:41:01', '2019-12-16 18:41:01', 53, 32, 'pending', NULL),
(5, '2019/12/18 19:25:9', 123, 133, 43, 430, '1576504589_2_(1)_(1).png', '2019-12-16 19:26:32', '2019-12-16 19:26:32', 65, 28, 'confirm', NULL),
(6, '2019/12/16 19:40:51', 6, 12, 11, 66, '1576504812_2_(1).png', '2019-12-16 19:30:13', '2019-12-16 19:30:13', 53, 25, 'pending', NULL),
(7, '2019/12/16 19:45:8', 122, 129, 10, 70, '1576505667_5dc8f191ba479_(1).png', '2019-12-16 19:45:08', '2019-12-16 19:45:08', 60, 37, 'confirm', NULL),
(8, '2019/12/18 11:00:57', 34, 34, 45, 0, '1576560793_download_(2).png', '2019-12-17 11:03:33', '2019-12-17 11:03:33', 70, 39, 'confirm', NULL),
(9, '2019/12/17 14:55:6', NULL, 123, 11, 0, NULL, '2019-12-17 14:00:09', '2019-12-17 14:00:09', 53, 25, 'confirm', NULL),
(10, '2019/12/17 17:45:14', NULL, 123, 45, 0, NULL, '2019-12-17 17:03:38', '2019-12-17 17:03:38', 71, 40, 'pending', NULL),
(11, '2019/12/17 17:55:57', NULL, 1000, 8, 0, NULL, '2019-12-17 17:58:23', '2019-12-17 17:58:23', 73, 44, 'confirm', NULL),
(12, '2019/12/17 18:00:27', NULL, 77, 8, 0, NULL, '2019-12-17 17:59:11', '2019-12-17 17:59:11', 73, 44, 'confirm', NULL),
(13, '2019/12/17 18:00:15', NULL, 22222, 8, 0, NULL, '2019-12-17 17:59:48', '2019-12-17 17:59:48', 73, 44, 'pending', NULL),
(14, '2019/12/17 18:20:29', NULL, 121, 8, 0, NULL, '2019-12-17 18:18:01', '2019-12-17 18:18:01', 73, 44, 'confirm', NULL),
(15, '2019/12/17 18:25:8', NULL, 11, 5, 0, NULL, '2019-12-17 18:22:23', '2019-12-17 18:22:23', 73, 45, 'confirm', NULL),
(16, '2019/12/17 18:25:27', NULL, 565, 5, 0, NULL, '2019-12-17 18:22:39', '2019-12-17 18:22:39', 73, 45, 'confirm', NULL),
(17, '2019/12/17 18:25:49', NULL, 123, 12, 0, NULL, '2019-12-17 18:26:00', '2019-12-17 18:26:00', 73, 46, 'pending', NULL),
(18, '2019/12/17 18:30:4', NULL, 111, 12, 0, NULL, '2019-12-17 18:26:39', '2019-12-17 18:26:39', 73, 46, 'confirm', NULL),
(19, '2019/12/17 18:50:44', NULL, 111, 1, 0, NULL, '2019-12-17 18:47:37', '2019-12-17 18:47:37', 74, 47, 'pending', NULL),
(20, '2019/12/17 18:50:41', NULL, 1111, 1, 0, NULL, '2019-12-17 18:48:08', '2019-12-17 18:48:08', 74, 47, 'confirm', NULL),
(21, '2019/12/17 18:50:18', NULL, 656790, 1, 0, NULL, '2019-12-17 18:48:34', '2019-12-17 18:48:34', 74, 47, 'confirm', NULL),
(22, '2019/12/17 18:50:38', NULL, 1190, 1, 0, NULL, '2019-12-17 18:48:56', '2019-12-17 18:48:56', 74, 47, 'pending', NULL),
(23, '2019/12/17 18:50:0', NULL, 44, 1, 0, NULL, '2019-12-17 18:49:12', '2019-12-17 18:49:12', 74, 47, 'pending', NULL),
(24, '2019/12/18 19:05:23', NULL, 23, 5, 0, NULL, '2019-12-17 19:07:36', '2019-12-17 19:07:36', 71, 40, 'confirm', NULL),
(25, '2019/12/18 19:10:43', NULL, 345, 5, 0, '1576590226_Screenshot_from_2018-11-03_12-59-16.png', '2019-12-17 19:13:54', '2019-12-17 19:13:54', 71, 40, 'confirm', NULL),
(26, '2019/12/18 12:55:16', NULL, 120, 3, 0, '1576653792_5dc8f191ba479.png', '2019-12-18 12:53:13', '2019-12-18 12:53:13', 79, 49, 'pending', NULL),
(27, '2019/12/18 12:55:18', NULL, 123323, 3, 0, '1576653837_attractive-beautiful-beauty-1024311.jpg', '2019-12-18 12:53:59', '2019-12-18 12:53:59', 79, 49, 'confirm', NULL),
(28, '2019/12/18 13:00:28', NULL, 111111, 1, 0, NULL, '2019-12-18 12:54:50', '2019-12-18 12:54:50', 79, 50, 'confirm', NULL),
(29, '2019/12/19 18:30:34', NULL, 45, 5, 0, '1576674235_star1.png', '2019-12-18 18:33:56', '2019-12-18 18:33:56', 71, 40, 'confirm', NULL),
(30, '2019/12/18 18:40:32', NULL, 100, 1, 0, '1576674529_5dc8f191ba479_(1).png', '2019-12-18 18:38:52', '2019-12-18 18:38:52', 79, 50, 'confirm', NULL),
(31, '2019/12/20 17:45:38', NULL, 123, 32, 0, '1576843370_2_(1)_(2).png', '2019-12-20 17:32:51', '2019-12-20 17:32:51', 87, 61, 'confirm', NULL),
(32, '2019/12/20 17:45:1', NULL, 100, 3, 0, '1576843396_1-tech_(2).jpg', '2019-12-20 17:33:16', '2019-12-20 17:33:16', 87, 62, 'confirm', NULL),
(33, '2019/12/20 17:55:11', NULL, 10203, 22, 0, '1576844672_1571818609_image_(1).png', '2019-12-20 17:54:35', '2019-12-20 17:54:35', 86, 60, 'confirm', NULL),
(34, '2020/1/9 11:30:40', NULL, 123, 3, 0, '1578550439_16.jpg', '2020-01-09 11:44:07', '2020-01-09 11:44:07', 79, 49, 'confirm', 'start'),
(35, '2020/1/9 12:40:5', NULL, 123, 1, 0, NULL, '2020-01-09 12:03:19', '2020-01-09 12:03:19', 79, 50, 'confirm', 'start'),
(36, '2020/01/09 18:01:06', NULL, 4545, 32, 0, 'document1578573966.png', '2020-01-09 18:16:06', '2020-01-09 18:16:06', 87, 61, 'pending', 'last'),
(37, '2020/01/09 18:01:07', NULL, 45454, 3, 0, 'document1578573966.png', '2020-01-09 18:16:07', '2020-01-09 18:16:07', 87, 62, 'pending', 'last');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_16_121559_add_extra_field_to_users_table', 1),
(4, '2019_07_18_053547_create_cmspage_table', 1),
(5, '2019_07_18_103653_alter_user_table', 1),
(6, '2019_09_12_114411_create_amenities_table', 1),
(7, '2019_09_12_114759_create_contracts_table1', 1),
(8, '2019_09_12_114829_create_events_table', 1),
(9, '2019_09_12_120305_create_invitations_table', 1),
(10, '2019_09_12_120414_create_membership_payments_table', 1),
(11, '2019_09_12_120438_create_meters_table', 1),
(12, '2019_09_12_122114_create_plans_table', 1),
(13, '2019_09_12_122149_create_properties_table', 1),
(14, '2019_09_12_124235_create_property_units_table', 1),
(15, '2019_09_12_124902_create_property_visits_table', 1),
(16, '2019_09_12_125608_create_tasks_table', 1),
(17, '2019_09_12_125906_create_verify_emails_table', 1),
(18, '2019_09_12_130155_create_verify_users_table', 1),
(19, '2019_09_21_122528_alter_property_units_table_add_colume1', 1),
(20, '2019_09_21_132022_create_book_appointment_table', 1),
(21, '2019_09_23_052856_add_votes_to_users_table', 1),
(22, '2019_09_23_053048_add_title_to_book_appointment_table', 1),
(23, '2019_09_23_065959_create_property_vendors_table', 1),
(24, '2019_09_23_081528_alter_property_units_table_remove_colume', 1),
(25, '2019_09_23_092640_alter_meters_table_remove_colume', 1),
(26, '2019_09_23_100222_alter_properties_table_colume', 1),
(27, '2019_09_25_063457_add_vo_to_users_table', 1),
(28, '2019_09_25_073201_add_company_users_table', 1),
(29, '2019_09_26_073213_create_appointments_table', 1),
(30, '2019_09_27_070237_alter_users_colume', 1),
(31, '2019_09_27_071053_add_phone_verify_to_users', 1),
(32, '2019_09_27_122726_add_appointment_status_to_appointments', 1),
(33, '2019_09_30_174709_add_paid_to_users', 1),
(34, '2019_09_30_174749_add_parent_to_appointments', 1),
(35, '2019_10_01_104855_add_dates_to_appointments', 1),
(36, '2019_10_01_171109_create_users_e', 1),
(37, '2019_10_01_171140_create_email_log_table', 1),
(38, '2019_10_03_132611_create_unit_booking_table', 1),
(39, '2019_10_03_132704_create_guarantor_table', 1),
(40, '2019_10_03_142343_add_change-status_unit_booking', 1),
(41, '2019_10_03_162609_add_tenant_id_unit_guarantor', 1),
(42, '2019_10_03_171418_add_company_email_users', 1),
(43, '2019_10_04_165109_add_photo_to_unit_booking', 1),
(44, '2019_10_04_190029_add_unit_id_to_guarantor', 1),
(45, '2019_10_05_113334_create_meters_reading_table', 1),
(46, '2019_10_05_124355_alter_meter_readings_colume1', 1),
(47, '2019_10_07_124522_create_transactions_table', 1),
(48, '2019_10_07_134415_add_payment_status_to_unit_booking', 1),
(49, '2019_10_07_162059_alter_contracts_colume', 1),
(50, '2019_10_07_175244_alter_unit_booking_colume', 1),
(51, '2019_10_07_183305_add_booking_status_to_property_units', 1),
(52, '2019_10_08_142510_add_receipt_status_to_unit_booking', 1),
(53, '2019_10_08_142528_add_receipt_to_transactions', 1),
(54, '2019_10_08_172512_alter_transactions_colume', 1),
(55, '2019_10_14_132011_create_users_account_table', 1),
(56, '2019_10_14_174613_create_documents_table', 1),
(57, '2019_10_14_181000_create_tickets_table', 1),
(58, '2019_10_15_180412_alter_property_units_colume', 1),
(59, '2019_10_17_123846_create_notifications_table', 1),
(60, '2019_10_17_165142_create_access_permissions_table', 1),
(61, '2019_10_21_153430_create_terminate_table', 1),
(62, '2019_10_22_192744_alter_transactions_colume1', 1),
(63, '2019_10_25_113548_create_leagl_actions_table', 1),
(64, '2019_10_31_161441_create_users_availability_table', 1),
(65, '2019_11_01_140255_create_units_rent_table', 1),
(66, '2019_11_01_152302_alter_units_rent_colume', 1),
(67, '2019_11_01_183750_create_rating_table', 1),
(68, '2019_11_05_162135_create_refunds_table', 1),
(69, '2019_11_06_181531_alter_plans_colume', 1),
(70, '2019_11_07_142042_create_messages_table', 1),
(71, '2019_11_08_171330_alter_property_units_colume1', 1),
(72, '2019_11_08_191831_create_appointment_reason_table', 1),
(73, '2019_11_25_121537_create_extend_request_table', 2),
(74, '2019_12_10_115111_create_sub_tenants_table', 3),
(76, '2019_12_19_113105_create_ticket_threads_table', 4),
(77, '2020_01_10_103120_create_tenant_invitation_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('008fea84-6ecd-44ac-bd1e-aa05188746fd', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-22 16:06:05', '2019-11-22 16:06:05'),
('013f15cc-4ebd-43cd-86eb-1096cf7fbcd8', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-17 17:36:26', '2019-12-17 17:36:26'),
('021dee87-b5e9-4891-bae0-befa38ada6ed', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:32', '2020-01-07 18:34:32'),
('03b0a59b-67de-4a8a-8ea5-c2fe271ce6b2', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:20', '2020-01-07 18:33:20'),
('042efa62-6575-4551-a493-80533ab21286', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-18 12:50:58', '2019-12-18 12:50:58'),
('043f69d9-f9e8-414a-b6a3-c34fee858df2', 'App\\Notifications\\MyFirstNotification', 'App\\User', 19, '[]', NULL, '2019-12-16 19:40:15', '2019-12-16 19:40:15'),
('04b34fcc-92e9-4e2c-9083-3a84766e550d', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:23', '2020-01-07 18:34:23'),
('05f81203-8d3e-4a89-b604-4cf00f502b42', 'App\\Notifications\\MyFirstNotification', 'App\\User', 3, '[]', NULL, '2019-12-17 17:03:03', '2019-12-17 17:03:03'),
('085ef12b-3a5f-43e1-a4bb-34ced2bfe67c', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:40', '2020-01-07 18:33:40'),
('08ed7e17-edab-4b14-bcdc-eddf14a867e8', 'App\\Notifications\\MyFirstNotification', 'App\\User', 25, '[]', NULL, '2019-12-17 17:02:46', '2019-12-17 17:02:46'),
('099322b4-8105-46c2-8b53-699b7e2b821b', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2020-01-09 18:06:09', '2020-01-09 18:06:09'),
('0a86d8cd-e564-4555-96b0-00de2664d106', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-20 17:55:38', '2019-12-20 17:55:38'),
('0a8871a2-0395-4bc0-9836-fd05572db73d', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:20', '2020-01-07 18:35:20'),
('0b6c8ace-0a9c-4d50-9ed0-8faeca995cc2', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:04', '2020-01-07 18:35:04'),
('0c461e46-e328-4d13-a4d9-816b5976b5e4', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:25', '2020-01-07 18:32:25'),
('0ccde7b2-93b5-4354-96fb-3f9c2af2331d', 'App\\Notifications\\MyFirstNotification', 'App\\User', 62, '[]', NULL, '2019-12-17 17:38:40', '2019-12-17 17:38:40'),
('0cd3ceae-10ac-4e8d-9796-b40f1a94f2c1', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:27', '2020-01-07 18:35:27'),
('0ce29130-1eaa-40b5-868e-5488794cf1a4', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:27', '2020-01-07 18:34:27'),
('0edbeabd-5232-4df4-a234-53254a8c024e', 'App\\Notifications\\MyFirstNotification', 'App\\User', 26, '[]', NULL, '2019-12-13 11:49:19', '2019-12-13 11:49:19'),
('0f055f1f-13d5-40f1-8629-4b931db1205d', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:47', '2020-01-07 18:33:47'),
('10bfd225-e926-4274-b4f2-2933630e1a65', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:00', '2020-01-07 18:35:00'),
('11e06577-52f2-4b97-ba5d-1741ac30183b', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-17 17:52:09', '2019-12-17 17:52:09'),
('12305a53-62af-4ca4-81c0-070dfcb776c5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-11 16:19:15', '2019-12-11 16:19:15'),
('128b26cc-c7fb-4e65-bdbe-96439de961b6', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:07', '2020-01-07 18:34:07'),
('13648463-bca4-410c-8367-681b8c49ba99', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:51', '2020-01-07 18:33:51'),
('175a4b09-6eea-4685-9dee-c860bce20978', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-04 13:41:22', '2019-12-04 13:41:22'),
('1772e07a-7291-473e-b357-5d931666e6e1', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:02', '2020-01-07 18:33:02'),
('1995a4dd-a040-41a7-9870-499009aeba3c', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:36:07', '2020-01-07 18:36:07'),
('19e48302-4f1f-4941-bd49-79f0529119db', 'App\\Notifications\\MyFirstNotification', 'App\\User', 26, '[]', NULL, '2019-12-14 19:58:51', '2019-12-14 19:58:51'),
('1bbd3550-6296-4409-a1b6-d7d1194a52e2', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:35:55', '2020-01-07 18:35:55'),
('1c6f27f8-fbca-4bde-90ad-f3a104db8fe4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 26, '[]', NULL, '2019-12-17 17:02:55', '2019-12-17 17:02:55'),
('1d2b2628-6a2b-4ca1-945d-0adcad3bc1ff', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:48', '2020-01-07 18:32:48'),
('1e8b0f9a-10af-4491-afb0-c7f71279105b', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:40', '2020-01-07 18:35:40'),
('1f1cc3a7-7c02-477d-995b-4481183910ee', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-16 19:35:18', '2019-12-16 19:35:18'),
('1f641cfa-f6df-433a-8107-6e5b7c0b79e4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-22 16:06:07', '2019-11-22 16:06:07'),
('203fd519-28e1-4144-ac09-ec578ad19c5a', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2020-01-09 18:05:55', '2020-01-09 18:05:55'),
('223e8c8d-db64-4571-beef-a14ff4818517', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:36:12', '2020-01-07 18:36:12'),
('23089298-f45e-4b8c-a0f5-19e56712fd7b', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-04 13:10:38', '2019-12-04 13:10:38'),
('23d75b5e-f0fa-4b75-91fc-068d8765c686', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:34:40', '2020-01-07 18:34:40'),
('24214f06-d25d-43b1-ae6f-a395d956cf2c', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:32:55', '2020-01-07 18:32:55'),
('24f9bd71-37e9-4891-9b1b-87c707b96be6', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:35', '2020-01-07 18:33:35'),
('25b7575f-ad45-40cd-b57f-012d29582498', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:36:15', '2020-01-07 18:36:15'),
('262c77b6-75fd-42f8-a494-2414875a2643', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-27 11:32:02', '2019-11-27 11:32:02'),
('277f5bf4-a937-45ad-8e18-6c7580840dba', 'App\\Notifications\\CoTenantNotification', 'App\\User', 66, '[]', NULL, '2020-01-10 14:42:06', '2020-01-10 14:42:06'),
('2a0842b1-b887-430d-a498-74152432a2b7', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:27', '2020-01-07 18:33:27'),
('2b05b9b8-46e1-4cd4-87f7-6c2028e5ca52', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:48', '2020-01-07 18:34:48'),
('2b981cab-194f-4ca6-8144-a404a18e70b7', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2020-01-09 18:06:13', '2020-01-09 18:06:13'),
('2c8bf5e8-417c-4c3c-9db2-cb63230bd985', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-04 13:10:34', '2019-12-04 13:10:34'),
('2c9466b9-d86d-4bd7-af52-3d608bd4836a', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-22 16:06:05', '2019-11-22 16:06:05'),
('2d092ce7-08b6-4573-a390-cc04a31a669e', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-22 16:06:01', '2019-11-22 16:06:01'),
('2e08465b-2c7c-45a3-b0d0-ddf70c86d865', 'App\\Notifications\\MyFirstNotification', 'App\\User', 29, '[]', NULL, '2019-12-14 19:58:39', '2019-12-14 19:58:39'),
('2e9bf824-03a7-4825-b508-3ec802fa6c3d', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:12', '2020-01-07 18:35:12'),
('2ecd7976-516a-4614-a722-c26f5aa61f3f', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-22 16:06:10', '2019-11-22 16:06:10'),
('2f06b0cd-5f4b-4384-96cf-c6bda70dc29e', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:11', '2020-01-07 18:35:11'),
('2f58e542-ec3c-471d-a429-fe25ab6cfaa2', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:35:55', '2020-01-07 18:35:55'),
('2ff54635-6cba-4a01-9c61-3a2f80d7bd63', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:19', '2020-01-07 18:35:19'),
('31e54800-5162-4766-b57f-ef2c0e59ac3b', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:28', '2020-01-07 18:34:28'),
('3217aa41-3cf2-4ff7-b543-fa14892bfe2b', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:15', '2020-01-07 18:33:15'),
('3296ae17-fd74-4979-a5c0-2e778e3d4ca5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-20 17:55:42', '2019-12-20 17:55:42'),
('33026fb9-e5ee-4916-a772-87450e3fcac6', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:36:08', '2020-01-07 18:36:08'),
('33215ed8-4f20-42a4-be57-41405c63ded2', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-22 16:06:06', '2019-11-22 16:06:06'),
('33559704-6e08-42aa-a578-17e5bb6cc8dc', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:22', '2020-01-07 18:33:22'),
('336f699a-25ac-4fdb-b2db-540137a2896e', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:32:55', '2020-01-07 18:32:55'),
('3415dae2-7203-496b-bb64-70e2bf1d1032', 'App\\Notifications\\MyFirstNotification', 'App\\User', 41, '[]', NULL, '2019-12-17 17:36:51', '2019-12-17 17:36:51'),
('34faeb12-c111-47d7-903c-db2aab7f47a0', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-04 13:41:11', '2019-12-04 13:41:11'),
('34fdaf28-35e4-4f81-a1ef-b95efdc2eb9f', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:52', '2020-01-07 18:34:52'),
('359a0e02-2e6d-4404-83c5-89b24a5542b1', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2020-01-09 11:10:12', '2020-01-09 11:10:12'),
('361ce5d0-11b6-437e-b993-cc1f4d67d9a0', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:24', '2020-01-07 18:33:24'),
('368ca3dd-fe10-4507-8efb-8be6c2153c78', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:00', '2020-01-07 18:34:00'),
('37401fc1-e92d-49c7-8a7d-ceb2f08d4db3', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2020-01-09 18:05:46', '2020-01-09 18:05:46'),
('377f4ae8-d316-40f5-b06f-62a5127ea668', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-16 19:39:55', '2019-12-16 19:39:55'),
('3e763f3f-3c8b-43fb-aab2-199914c3c907', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-18 12:26:59', '2019-12-18 12:26:59'),
('3e8df2c2-ec16-4c00-af2e-d3f168cf93ca', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-17 17:38:52', '2019-12-17 17:38:52'),
('3f04afba-cb97-4297-8402-f46c354a9c17', 'App\\Notifications\\MyFirstNotification', 'App\\User', 43, '[]', NULL, '2019-12-11 16:19:27', '2019-12-11 16:19:27'),
('3f6f6eb3-4bac-4880-843c-d95b9b9cfa98', 'App\\Notifications\\MyFirstNotification', 'App\\User', 25, '[]', NULL, '2019-12-16 18:26:43', '2019-12-16 18:26:43'),
('3fb2a6bd-5665-4398-bf4d-48651cc2ee1b', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-27 11:33:41', '2019-11-27 11:33:41'),
('40a60d5d-f483-4bc0-9ff7-05f5982119cf', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:32', '2020-01-07 18:33:32'),
('40b027c8-9fc4-415d-8769-49d4aac0884f', 'App\\Notifications\\MyFirstNotification', 'App\\User', 29, '[]', NULL, '2019-12-16 18:26:48', '2019-12-16 18:26:48'),
('42408b70-df7e-4d6e-8b6c-ef56a31303da', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:59', '2020-01-07 18:33:59'),
('430401b3-647f-4cef-8f3e-a7542e5d6ae3', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:03', '2020-01-07 18:33:03'),
('432184f6-5635-4433-a1f2-5a63af309414', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:31', '2020-01-07 18:34:31'),
('4395bced-6aa1-4852-802e-0d697d48b179', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:35:51', '2020-01-07 18:35:51'),
('4568de1b-a60c-4acf-b75d-2dcab3b4dd13', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-27 11:32:13', '2019-11-27 11:32:13'),
('4738d72d-368f-49f8-979c-726d670bfb5d', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-20 17:32:10', '2019-12-20 17:32:10'),
('481ae799-3009-45e6-ab3f-54d10634c570', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:36:19', '2020-01-07 18:36:19'),
('48f6e87c-7d33-4c7f-a7ec-d3a1455fec80', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-19 18:42:02', '2019-12-19 18:42:02'),
('49a8002e-de65-4e13-b01a-13d30856d9c7', 'App\\Notifications\\MyFirstNotification', 'App\\User', 25, '[]', NULL, '2019-12-14 19:58:27', '2019-12-14 19:58:27'),
('4c2a0a3c-40a2-4478-8b96-ddd985b63bad', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-25 15:57:26', '2019-11-25 15:57:26'),
('4d3c62ac-4e1e-4805-8834-bfbb2c4c6854', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:28', '2020-01-07 18:33:28'),
('4d799298-2137-4c4a-b7da-1fded8e7aaa4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2020-01-09 18:16:16', '2020-01-09 18:16:16'),
('4e504dbb-221c-47c4-9470-535b64707dd3', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-18 12:26:54', '2019-12-18 12:26:54'),
('4fcb2a61-e94f-474a-a1e8-6062fe944b0e', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:36', '2020-01-07 18:35:36'),
('4fd20a87-78a6-4e6d-9775-04085aecbcf4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-16 19:20:39', '2019-12-16 19:20:39'),
('51f20212-5b73-479d-ac8c-7da1f0b672be', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-22 16:06:11', '2019-11-22 16:06:11'),
('51f72af7-a879-4afc-9f9f-960d6e940ca1', 'App\\Notifications\\MyFirstNotification', 'App\\User', 26, '[]', NULL, '2019-12-16 18:26:53', '2019-12-16 18:26:53'),
('54f82a01-d233-4e3e-8011-5ee905c4a8d4', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:08', '2020-01-07 18:35:08'),
('553af67a-e8c4-4c90-8dd7-f216b81d3b45', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-19 18:42:14', '2019-12-19 18:42:14'),
('553b3d9e-95a3-4c4c-bc9c-bcf1a3f56da3', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:35:47', '2020-01-07 18:35:47'),
('5790bda5-e8f7-4c79-886d-f85981b6f619', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-19 18:42:08', '2019-12-19 18:42:08'),
('58048072-6325-4ef6-b231-8e4a3d27dd22', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:39', '2020-01-07 18:32:39'),
('5adac3f8-a522-4a3d-ab3e-d6135237af27', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-20 17:53:38', '2019-12-20 17:53:38'),
('5c21e664-1efd-464c-8b33-c673c51d44e1', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:30', '2020-01-07 18:33:30'),
('5d12d774-d272-4144-8a3e-b1e823b722d2', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:34:39', '2020-01-07 18:34:39'),
('5e2e3e56-22a0-40f1-b258-a0e47f9427c0', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:35', '2020-01-07 18:34:35'),
('5e575406-5f39-475c-a39d-8f6f4dfba971', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:36:11', '2020-01-07 18:36:11'),
('5e6a5691-7e73-4d98-9099-ebba3e819128', 'App\\Notifications\\MyFirstNotification', 'App\\User', 41, '[]', NULL, '2019-12-17 17:39:04', '2019-12-17 17:39:04'),
('5f15dcee-7b3a-4e1d-8f91-9e6ea8ddaa9b', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:19', '2020-01-07 18:33:19'),
('5fabecd4-ce7e-4fc5-bf65-b97ac657ba81', 'App\\Notifications\\MyFirstNotification', 'App\\User', 44, '[]', NULL, '2019-12-16 19:40:11', '2019-12-16 19:40:11'),
('61fc9281-1dfd-4993-b60d-e9ba95a74b56', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-22 16:06:09', '2019-11-22 16:06:09'),
('62a5343c-e849-4687-afcd-ceb10f0a2115', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2020-01-09 18:05:50', '2020-01-09 18:05:50'),
('631ccd39-0dd8-4f3b-bb2a-35c068095661', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:39', '2020-01-07 18:35:39'),
('67e7583c-0ded-4a39-837e-5e97054e5412', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:36', '2020-01-07 18:33:36'),
('68c82093-9db4-4eeb-af38-14f0b9ecb287', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-22 16:06:15', '2019-11-22 16:06:15'),
('6a775247-a551-47c4-b307-63df4dcefef6', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:51', '2020-01-07 18:34:51'),
('6c65cacd-52e3-4c4d-9126-caa97bc97d28', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-22 16:06:10', '2019-11-22 16:06:10'),
('6da95216-4958-410d-b99f-3eb6ab2d2c3a', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:50', '2020-01-07 18:32:50'),
('6e31833b-8d17-48f0-89b1-dd0aafe573a5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-11 16:19:19', '2019-12-11 16:19:19'),
('6e934e8c-575a-42b8-b668-cc5fe04b5b85', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:03', '2020-01-07 18:35:03'),
('6fa6492e-d7f6-4380-b021-0a09bc01a6a7', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-18 12:51:03', '2019-12-18 12:51:03'),
('73372166-89ba-44a7-8572-89c3c98f1010', 'App\\Notifications\\MyFirstNotification', 'App\\User', 43, '[]', NULL, '2019-12-16 19:40:07', '2019-12-16 19:40:07'),
('74244f68-cdb0-4cfb-8abb-6516c72c716b', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-17 17:37:52', '2019-12-17 17:37:52'),
('768fed64-0236-4f10-a0bd-8484a7daec95', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-17 18:46:32', '2019-12-17 18:46:32'),
('77977863-4512-4a5b-bde8-7bd3b72122e7', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-17 17:52:01', '2019-12-17 17:52:01'),
('77d7e1a3-32da-4ab6-9fa0-45e67fa060ce', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-19 18:42:19', '2019-12-19 18:42:19'),
('785246c9-4992-4b3b-8f20-4d63faa9e287', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:36:20', '2020-01-07 18:36:20'),
('79d59c64-7e53-4e2b-a48b-f856ee6e0502', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:03', '2020-01-07 18:34:03'),
('79e3abb3-ba47-4eef-aa12-3dea18cc6a40', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:25', '2020-01-07 18:34:25'),
('79eaa514-0ae0-4aaf-91ab-69a31584dd46', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-17 17:36:39', '2019-12-17 17:36:39'),
('7cfb096b-bb70-44bd-bba7-e86fc0719f79', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-17 17:36:02', '2019-12-17 17:36:02'),
('7d5b950f-9d78-4921-8a49-9efd7316ec1e', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:07', '2020-01-07 18:33:07'),
('7ea72b7f-7285-45d8-8077-0eea53e3c224', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:34:43', '2020-01-07 18:34:43'),
('7f797fa8-c594-448a-afa0-e8869f12b101', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-17 18:46:28', '2019-12-17 18:46:28'),
('7fd35432-537a-4c18-9aaa-718f5ba394fd', 'App\\Notifications\\MyFirstNotification', 'App\\User', 25, '[]', NULL, '2019-12-13 11:49:11', '2019-12-13 11:49:11'),
('7fd8cdb0-2d88-4799-8205-5cf450d1f26c', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:56', '2020-01-07 18:34:56'),
('80c366a5-d66b-4018-91a8-8038f40a0fb5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 62, '[]', NULL, '2019-12-17 17:39:16', '2019-12-17 17:39:16'),
('81fa1378-bed3-45b1-80bb-6c950e2f48f3', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:59', '2020-01-07 18:35:59'),
('82fba9ec-37aa-494d-8a13-73e71b7c6ac7', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:28', '2020-01-07 18:32:28'),
('8521c0ee-77fc-4315-b368-8b1d5b22dfef', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-27 11:33:34', '2019-11-27 11:33:34'),
('8680b9ba-a2eb-437b-ad46-bb6fc1b640e0', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-16 19:20:30', '2019-12-16 19:20:30'),
('880423b9-a9ac-4f8e-9855-3d2832e98f32', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-17 18:46:24', '2019-12-17 18:46:24'),
('882f3eda-4568-4a42-962b-f4a76cd05ff6', 'App\\Notifications\\MyFirstNotification', 'App\\User', 29, '[]', NULL, '2019-12-13 11:49:15', '2019-12-13 11:49:15'),
('885d8487-04c5-413e-ae84-1a7144dcffbc', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-20 17:53:34', '2019-12-20 17:53:34'),
('89e3ff35-30b9-4646-8072-aae711b7d01c', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-17 17:52:04', '2019-12-17 17:52:04'),
('8d4c48f9-f49e-4271-8cdf-46798fbf74c8', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-25 15:57:33', '2019-11-25 15:57:33'),
('8dc05207-df2e-4bbc-a85b-7554a26be198', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-27 11:33:27', '2019-11-27 11:33:27'),
('8e447f88-86af-4945-a3e0-746c49add4f1', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:51', '2020-01-07 18:32:51'),
('8eac4459-fc25-4853-9cb9-81a177906eb5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 41, '[]', NULL, '2019-12-17 17:38:28', '2019-12-17 17:38:28'),
('93b2dac7-e828-4c01-b7fd-b31cf9ae5056', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:16', '2020-01-07 18:35:16'),
('952cff27-40ab-42bc-927f-af42cdae3fa4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-25 15:57:30', '2019-11-25 15:57:30'),
('95510e93-84e8-45eb-a3ef-4aa39c14f3b2', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-27 11:32:08', '2019-11-27 11:32:08'),
('95cff794-9550-4da1-8fe3-897118fb9384', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:44', '2020-01-07 18:33:44'),
('95d1a6d5-21e5-4aa1-b2c0-e1cd4c988b4e', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:11', '2020-01-07 18:34:11'),
('97e846e4-928a-413d-8a75-29453aae8709', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2020-01-09 11:10:17', '2020-01-09 11:10:17'),
('987d350b-c11d-4295-9bf1-f07996ea4476', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:58', '2020-01-07 18:32:58'),
('9a84cd31-aa29-4201-be9b-74c65ab88c13', 'App\\Notifications\\MyFirstNotification', 'App\\User', 62, '[]', NULL, '2019-12-17 17:37:03', '2019-12-17 17:37:03'),
('9d7f170e-540b-4ab5-ba6a-1477e8a9b145', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:36:03', '2020-01-07 18:36:03'),
('9da70250-94a6-48dd-91bd-c756660254fb', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:48', '2020-01-07 18:33:48'),
('9ec80043-80f4-4c0f-81ce-369cc479f358', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:35:43', '2020-01-07 18:35:43'),
('a096031a-0814-48c0-a923-9bed877ad408', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:55', '2020-01-07 18:33:55'),
('a2ef880f-39e3-4fd0-afb8-625557a84a23', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-16 19:35:12', '2019-12-16 19:35:12'),
('a85a9458-a1f7-4e2e-8823-5ed454c59bac', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:59', '2020-01-07 18:32:59'),
('aab2faba-d1d9-4fcb-a3dc-7ec51221b457', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-17 17:37:15', '2019-12-17 17:37:15'),
('aaf80e28-e332-40f0-a7c6-d40b4bd15d50', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-16 19:20:34', '2019-12-16 19:20:34'),
('ab386163-5825-4aac-8dc2-83a4ef9fe6f5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-16 19:35:02', '2019-12-16 19:35:02'),
('abdcabd6-073e-44b7-b6ec-fb85fdc1445a', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:35', '2020-01-07 18:35:35'),
('ad9140fd-7161-4b00-9609-d6b6b94e1cfa', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-16 19:39:59', '2019-12-16 19:39:59'),
('ae402a3d-1379-407b-9433-2d4fed4dc1a5', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:19', '2020-01-07 18:34:19'),
('ae46bc2b-4059-43dd-a0f7-785f572497e8', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-16 19:20:43', '2019-12-16 19:20:43'),
('b0cba880-52a2-4b26-b99c-4f2d1d9e9f8c', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-16 19:40:03', '2019-12-16 19:40:03'),
('b18ca2e5-3332-4e92-9c91-857db48da0f2', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:47', '2020-01-07 18:34:47'),
('b1c94749-8c13-42fc-b8b2-f8df7ea94189', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:36', '2020-01-07 18:32:36'),
('b1eabdd6-0b62-447b-a0fc-c1103f6649ca', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:07', '2020-01-07 18:35:07'),
('b37a1185-fd02-4c98-aef7-ad020e704794', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:32', '2020-01-07 18:35:32'),
('b41c16a1-476e-469b-8c82-6f8245f64fa1', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:46', '2020-01-07 18:32:46'),
('b438d533-4dbc-46b4-a029-afff29515c92', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:21', '2020-01-07 18:34:21'),
('b4bab3f8-120b-4aa2-9cfb-a299b9bd7f20', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:16', '2020-01-07 18:33:16'),
('b6179bcf-62ea-48ff-8eb0-c7613cbbb36f', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:13', '2020-01-07 18:34:13'),
('b7d3a713-014a-4fc0-bd68-f2fbf92e7704', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:43', '2020-01-07 18:33:43'),
('b977056d-8101-4dad-8010-43377ef02255', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-20 17:32:14', '2019-12-20 17:32:14'),
('ba972461-c22a-4c29-adbb-6e0c90c6a2ab', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:17', '2020-01-07 18:34:17'),
('bc71eb82-02bc-4481-b45e-eae4897081b2', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:23', '2020-01-07 18:35:23'),
('bcd126b2-7fab-4fcf-bd7d-57d44f9fd7c7', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:36:16', '2020-01-07 18:36:16'),
('c0e49cff-3f54-4aec-8134-27e96c1e815f', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:24', '2020-01-07 18:35:24'),
('c15bc459-636f-49fa-9112-74fa8300646b', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:44', '2020-01-07 18:32:44'),
('c170328e-4747-4014-8cb6-f76e152cf0db', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:59', '2020-01-07 18:34:59'),
('c471280d-2f5b-43e1-afd5-c1737859e2fd', 'App\\Notifications\\MyFirstNotification', 'App\\User', 29, '[]', NULL, '2019-12-17 17:02:50', '2019-12-17 17:02:50'),
('c49e64b9-2e91-4982-b766-da50d5b1eec5', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-20 17:32:19', '2019-12-20 17:32:19'),
('c5ee9263-c65f-4cee-bb93-eaa0572db023', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:55', '2020-01-07 18:34:55'),
('c83b756e-0106-404d-8999-b338040e5fad', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:52', '2020-01-07 18:33:52'),
('c8f4beda-8ca0-4802-99d3-44025b219f25', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:28', '2020-01-07 18:35:28'),
('c90d68ce-aef5-405e-b049-789afe2b137f', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:40', '2020-01-07 18:32:40'),
('c93f3d86-4a5d-4658-b351-94b2e59fd1f9', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-25 15:57:35', '2019-11-25 15:57:35'),
('ca402b45-4435-4115-b1be-c1920b62b068', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:15', '2020-01-07 18:34:15'),
('cb720574-77c7-4ebd-ad11-13260580a0cc', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-22 16:06:14', '2019-11-22 16:06:14'),
('cd9193f5-68e2-45a5-b1f6-e395facf0903', 'App\\Notifications\\CoTenantNotification', 'App\\User', 66, '[]', NULL, '2020-01-10 14:46:32', '2020-01-10 14:46:32'),
('cdeed622-5f96-4124-bd85-a67f48747aed', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:04', '2020-01-07 18:34:04'),
('d008b9dd-4900-4ff6-a8d6-7df59f47653c', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:32:43', '2020-01-07 18:32:43'),
('d12f410a-964b-44f3-90d9-ef99c857a087', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-20 17:55:46', '2019-12-20 17:55:46'),
('d2394680-99b6-4066-9b15-6a60b58f6183', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-11-22 16:06:15', '2019-11-22 16:06:15'),
('d2ae2eaf-b9ad-485a-9283-92c303e26963', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-11-25 15:57:25', '2019-11-25 15:57:25'),
('d812c1d5-fc7d-4ac2-a7ac-0e85ba789f7e', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-17 17:36:15', '2019-12-17 17:36:15'),
('d8b3af6b-0ca5-4de4-b78a-2bc64756ba06', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-17 17:37:40', '2019-12-17 17:37:40'),
('d913c270-830b-4a8c-b761-610c660689cf', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:12', '2020-01-07 18:33:12'),
('d99ca069-97da-4db9-9a82-dfd48910fccc', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-16 19:40:28', '2019-12-16 19:40:28'),
('d9d776f6-745a-4bc4-bd12-1215274e15f4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 62, '[]', NULL, '2019-12-17 17:37:38', '2019-12-17 17:37:38'),
('d9f9af51-5636-44cb-8507-53cd96bb0e41', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-20 17:53:42', '2019-12-20 17:53:42'),
('da28c82b-4d5b-4925-93ee-e678fbdc5eb0', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:31', '2020-01-07 18:35:31'),
('da6a5cf5-808a-4a5c-9f56-d3e29051e7fd', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-17 17:38:03', '2019-12-17 17:38:03'),
('de6abd66-7b6a-4780-8484-dab6e75fd52d', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:39', '2020-01-07 18:33:39'),
('df5891d0-b842-45bc-963d-01bd6b3dc71f', 'App\\Notifications\\MyFirstNotification', 'App\\User', 4, '[]', NULL, '2019-12-16 19:40:19', '2019-12-16 19:40:19'),
('e133eba1-8ad8-4935-b56b-ccdfe9bb2878', 'App\\Notifications\\MyFirstNotification', 'App\\User', 41, '[]', NULL, '2019-12-17 17:37:26', '2019-12-17 17:37:26'),
('e477fe14-2b14-48be-b476-1274f58a7d12', 'App\\Notifications\\MyFirstNotification', 'App\\User', 40, '[]', NULL, '2019-12-17 17:38:16', '2019-12-17 17:38:16'),
('e4960ef9-f560-4f77-b034-23bc75c348e5', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:11', '2020-01-07 18:33:11'),
('e5dc78d1-f9d6-4bb9-8c4a-e4732b6e93b2', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-17 17:51:57', '2019-12-17 17:51:57'),
('e61eb6bc-36b0-4d04-9b7b-30aa9b5fffd4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-18 12:50:54', '2019-12-18 12:50:54'),
('e63cc376-bc77-4f2a-86a0-04e377a865d2', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2020-01-09 18:06:04', '2020-01-09 18:06:04'),
('e6d0be7c-eead-4c21-8bde-f6f07be38936', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:34:08', '2020-01-07 18:34:08'),
('e76b5bd6-5492-4cfa-8de1-bdd73da1f1ae', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:35:52', '2020-01-07 18:35:52'),
('e7f757c4-cd08-4916-b642-fb7d2e8096b0', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-18 12:26:51', '2019-12-18 12:26:51'),
('e880bb76-0320-4b56-9bb8-aee68b8fdded', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2020-01-09 18:16:11', '2020-01-09 18:16:11'),
('e937a249-be7d-46ea-9ec3-01f95b5357e3', 'App\\Notifications\\WarningEmail', 'App\\User', 27, '[]', NULL, '2020-01-07 18:35:44', '2020-01-07 18:35:44'),
('ec9eed39-43ad-4e5b-9125-6ba2522c176f', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:33:56', '2020-01-07 18:33:56'),
('ed6f16cb-3ada-4fb7-8baf-3a4b7ab0e248', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2020-01-09 11:10:07', '2020-01-09 11:10:07'),
('ed73fede-9df9-4833-b0f4-c3c01d91cdc6', 'App\\Notifications\\WarningEmail', 'App\\User', 26, '[]', NULL, '2020-01-07 18:35:47', '2020-01-07 18:35:47'),
('ee7bc8fd-fabc-4a6b-90ad-c854d5d53926', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2019-12-11 16:19:22', '2019-12-11 16:19:22'),
('f07333b6-1aeb-44f2-9130-b27f4ad98738', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:34:36', '2020-01-07 18:34:36'),
('f23d02d3-2982-4b8e-8dd9-2296237d1fb6', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-12-04 13:41:16', '2019-12-04 13:41:16'),
('f3539d53-9ef7-4510-82f0-3a35848ffa8b', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:33:07', '2020-01-07 18:33:07'),
('f59979c6-61e3-491a-bcc7-5049b1fd2fc4', 'App\\Notifications\\WarningEmail', 'App\\User', 1, '[]', NULL, '2020-01-07 18:34:44', '2020-01-07 18:34:44'),
('f5e62218-aae6-4bd9-a8b4-03404871cacd', 'App\\Notifications\\MyFirstNotification', 'App\\User', 41, '[]', NULL, '2019-12-16 19:20:47', '2019-12-16 19:20:47'),
('f848f950-9538-47cc-a118-9549567862ea', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:35:59', '2020-01-07 18:35:59'),
('f978ae96-0b9f-4f3c-8f81-21b6eab0f000', 'App\\Notifications\\MyFirstNotification', 'App\\User', 9, '[]', NULL, '2019-11-25 15:57:29', '2019-11-25 15:57:29'),
('fa3cce02-dfb1-47c0-9bc2-a58cb6c3bc2a', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:35:15', '2020-01-07 18:35:15'),
('fb7b73a9-3c17-43cb-9e83-0e6d9a739574', 'App\\Notifications\\WarningEmail', 'App\\User', 11, '[]', NULL, '2020-01-07 18:36:02', '2020-01-07 18:36:02'),
('fc4fb15a-33c0-46d1-88d5-9db1acd7f3d1', 'App\\Notifications\\WarningEmail', 'App\\User', 10, '[]', NULL, '2020-01-07 18:32:32', '2020-01-07 18:32:32'),
('ff0fbfa3-a575-4f92-a5ca-a64ec0d41b70', 'App\\Notifications\\MyFirstNotification', 'App\\User', 11, '[]', NULL, '2020-01-09 18:16:20', '2020-01-09 18:16:20'),
('ff4fe7e7-c094-442d-83c8-e555282060f4', 'App\\Notifications\\MyFirstNotification', 'App\\User', 13, '[]', NULL, '2019-12-04 13:10:30', '2019-12-04 13:10:30'),
('ff8b4f8c-7abe-44e7-b2b6-88a78060ee1e', 'App\\Notifications\\MyFirstNotification', 'App\\User', 15, '[]', NULL, '2019-12-16 19:40:23', '2019-12-16 19:40:23');

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
('amitT@yopmail.com', '$2y$10$bd/3sjV8xpP94YF8cpfjPe0YCveAj2j2E3ODRdEMo51L3pfnHulIe', '2019-12-16 17:39:25'),
('testT@yopmail.com', '$2y$10$/LU/WAVUDNlRkivrnUqj9OWFowBa32D8BaVX0QPs8VH7Lgq8gUiFe', '2019-12-16 17:52:16'),
('LAjatinsehgal@yopmail.com', '$2y$10$mnDG/rOPS2TrNRrerLRazO8mE7oOdzUL0OvhhLNEjwLwwzfdgXYkW', '2019-12-18 19:41:27'),
('po26@yopmail.com', '$2y$10$X.dl3.kYDkvT7R8CZThLuOozPFbrTq/rSKw8xebsFCse4O.nn88.q', '2019-12-19 10:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `price` double(8,2) NOT NULL,
  `short_description` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `time_period_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time_period` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `features` longtext COLLATE utf8mb4_unicode_ci,
  `plan_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`id`, `title`, `status`, `price`, `short_description`, `description`, `time_period_type`, `time_period`, `created_at`, `updated_at`, `features`, `plan_type`) VALUES
(1, 'For 1 Month', 1, 55.00, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '<p><strong style=\'margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'>Lorem Ipsum</strong><span style=\'font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</span><br></p>\n', 'monthly', '1', '2019-11-16 11:08:21', '2019-11-16 11:08:21', '<ul><li><span style=\'font-weight: bolder; margin: 0px; padding: 0px; font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'>Lorem Ipsum</span><span style=\'font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'>&nbsp;is simply dummy&nbsp;</span></li><li><span style=\'font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'><span style=\"font-weight: bolder; margin: 0px; padding: 0px;\">Lorem Ipsum</span>&nbsp;is simply dummy&nbsp;</span></li><li><span style=\'font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'><span style=\"font-weight: bolder; margin: 0px; padding: 0px;\">Lorem Ipsum</span>&nbsp;is simply dummy&nbsp;</span></li><li><span style=\'font-family: \"Open Sans\", Arial, sans-serif; text-align: justify;\'><span style=\"font-weight: bolder; margin: 0px; padding: 0px;\">Lorem Ipsum</span>&nbsp;is simply dummy&nbsp;<br></span></li></ul>\n', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `p_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` double DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `status` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsDeleted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `property_manager_id` int(11) DEFAULT NULL,
  `property_description_experts_id` int(11) DEFAULT NULL,
  `property_legal_advisor_id` int(11) DEFAULT NULL,
  `property_visit_organizer_id` int(11) DEFAULT NULL,
  `registration_possible` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cleaning_commonc_room_incl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cleaning_private_room_incl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `animal_allowed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `play_musical_instrument` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_allowed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `unit_name`, `address`, `cover_image`, `images`, `p_type`, `latitude`, `longitude`, `area`, `description`, `status`, `IsDeleted`, `created_at`, `updated_at`, `property_manager_id`, `property_description_experts_id`, `property_legal_advisor_id`, `property_visit_organizer_id`, `registration_possible`, `cleaning_commonc_room_incl`, `cleaning_private_room_incl`, `animal_allowed`, `play_musical_instrument`, `smoking_allowed`) VALUES
(1, 2, 'First Building', '54 test, Goldens Bridge, NY, USA', '1573884261_Screenshot_from_2019-10-18_10-11-35.png', '1573884265_Screenshot_from_2019-10-18_10-12-33.png,1573884265_Screenshot_from_2019-10-16_18-45-15.png,', 'building', '41.2930104', '-73.6789804', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, 0, '2019-11-16 11:34:28', '2019-11-16 11:34:28', 2, 2, 2, 2, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(2, 1, 'cghh', 'Hamburg, Germany', '1574418909_080817_0622_35Placestov15.jpg', '1574418913_080817_0622_35Placestov16.jpg,', 'building', '53.5510846', '9.993681899999956', NULL, 'thanks', NULL, 0, '2019-11-22 16:05:14', '2019-11-22 18:18:36', 1, 1, 1, 1, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(3, 10, 'ddddd', 'Sydney NSW, Australia', '1574667096_Palace-at-Chail-Solan.jpg', '1574667102_9427629256_e48741498f_b.jpg,1574667102_2018041275.jpg,1574667102_2018041221-1.jpg,1574667102_080817_0622_35Placestov16.jpg,1574667102_080817_0622_35Placestov15.jpg,', 'building', '-33.8688197', '151.20929550000005', NULL, 'dddddddddd', NULL, 1, '2019-11-25 13:01:47', '2019-12-09 17:05:59', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(4, 1, 'gfh', '45, SCO Lane 1, Haryana, India', '1574777933_about_us_–_our_story_11970.jpg', '1574777937_about_us_–_our_story_11970.jpg,', 'building', '29.9600963', '76.88968769999997', NULL, 'ghf', NULL, 0, '2019-11-26 19:49:05', '2019-11-26 19:49:05', 1, 1, 1, 1, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(5, 1, 'ghd', 'Guadalajara, Jalisco, Mexico', '1574832109_2018041221-1.jpg', '1574832115_080817_0622_35Placestov15.jpg,', 'building', '20.65969879999999', '-103.34960920000003', NULL, 'ffffh', NULL, 0, '2019-11-27 10:51:59', '2019-11-27 10:51:59', 1, 1, 1, 1, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(6, 10, 'tgfh', 'Jakarta, Indonesia', '1574832322_080817_0622_35Placestov16.jpg', '1574832326_080817_0622_35Placestov15.jpg,', 'building', '-6.2087634', '106.84559899999999', NULL, 'dftgh', NULL, 0, '2019-11-27 10:55:28', '2019-11-27 10:55:28', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(7, 10, '27 Building 1', 'London, UK', '1574836992_1571818609_image_(1).png', '1574836996_5dc8f191ba479.png,', 'building', '51.5073509', '-0.12775829999998223', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1, '2019-11-27 12:13:18', '2019-12-10 13:15:25', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(8, 10, 'b u i', 'York, UK', '1574838381_1571818609_image_(1).png', '1574838384_5dc8f191ba479.png,', 'building', '53.95996510000001', '-1.0872979000000669', NULL, 'hytyjty', NULL, 0, '2019-11-27 12:36:25', '2019-11-27 12:36:25', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(9, 1, 'ge', 'VFW Parkway, West Roxbury, MA, USA', '1574857609_080817_0622_35Placestov15.jpg', '1574857616_9427629256_e48741498f_b.jpg,1574857616_2018041275.jpg,1574857616_Apple-Blossom-Kalpa-min-3.jpg,1574857616_080817_0622_35Placestov16.jpg,', 'building', '42.2805015', '-71.17078830000003', NULL, 'bveaaa', NULL, 0, '2019-11-27 17:57:02', '2019-11-27 19:06:43', 1, 1, 1, 1, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(10, 27, 'DLF', 'IT Park Road, Phase - I, Manimajra, Chandigarh, Haryana, India', '1575446820_about_us_–_our_story_11970.jpg', '1575446823_about_us_–_our_story_11970.jpg,', 'building', '30.7255129', '76.84634140000003', NULL, 'DLF Description', NULL, 0, '2019-12-04 13:37:07', '2019-12-04 13:37:07', 27, 27, 27, 27, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(11, 10, 'SCO 45', 'Aspen, CO, USA', '1575963651_1571818609_image_(1).png', '1575963654_5dc8f191ba479.png,', 'building', '39.1910983', '-106.8175387', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1, '2019-12-10 13:10:56', '2019-12-10 13:15:43', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(12, 10, 'panchkula', 'Dubai - United Arab Emirates', '1575963994_close-envelope.png', '1575963997_1571818609_image_(1).png,', 'building', '25.2048493', '55.270782800000006', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1, '2019-12-10 13:16:38', '2019-12-10 13:19:03', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(13, 10, 'ABCD', 'Plymouth, UK', '1575964376_close-envelope.png', '1575964379_5dc8f191ba479.png,', 'building', '50.3754565', '-4.14265649999993', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1, '2019-12-10 13:23:00', '2019-12-10 13:38:37', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(14, 10, 'XYZ', 'Kolkata, West Bengal, India', '1576649641_5dc8f191ba479_(1).png', '1576649644_5dc8f191ba479_(1).png,', 'building', '22.572646', '88.36389499999996', 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', NULL, 1, '2019-12-18 11:44:05', '2019-12-18 11:51:00', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(15, 10, 'PQRS', 'Quito, Ecuador', '1576650477_action-adult-adventure-1122462.jpg', '1576650480_5dc8f191ba479_(1).png,', 'building', '-0.1806532', '-78.46783820000002', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 1, '2019-12-18 11:58:02', '2019-12-18 12:06:06', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(16, 10, 'abcd', 'Quito, Ecuador', '1576652563_5dc8f191ba479_(1).png', '1576652566_5dc8f191ba479_(1).png,', 'building', '-0.1806532', '-78.46783820000002', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 0, '2019-12-18 12:32:48', '2019-12-18 12:32:48', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(17, 10, 'QRST', 'Sydney NSW, Australia', '1576674145_5dc8f191ba479_(1).png', '1576674148_5dc8f191ba479.png,', 'building', '-33.8688197', '151.20929550000005', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, 0, '2019-12-18 18:32:30', '2019-12-18 18:32:30', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no'),
(18, 10, 'zxxzcfzx', 'Sydney NSW, Australia', '1576676348_5dc8f191ba479_(1).png', '1576676353_1576477145.png,', 'building', '-33.8688197', '151.20929550000005', NULL, 'das', NULL, 1, '2019-12-18 19:09:14', '2019-12-18 19:11:44', 10, 10, 10, 10, 'yes', 'no', 'yes', 'yes', 'no', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `property_units`
--

CREATE TABLE `property_units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_manager_id` int(11) DEFAULT NULL,
  `property_description_experts_id` int(11) DEFAULT NULL,
  `property_legal_advisor_id` int(11) DEFAULT NULL,
  `property_visit_organizer_id` int(11) DEFAULT NULL,
  `po_esignature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsDeleted` int(11) NOT NULL DEFAULT '0',
  `tax` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `fix_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `choose_guarantor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'yes',
  `amenities` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci,
  `u_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL,
  `cost_provision` int(11) DEFAULT NULL,
  `bedrooms` int(11) DEFAULT NULL,
  `bed_funished` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bed_lock` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kitchen` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `toilet` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `living_room` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balcony_terrace` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `garden` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `basement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parking` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wheelchair` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `allergy_friendly` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preferred_gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_age` int(11) DEFAULT NULL,
  `max_age` int(11) DEFAULT NULL,
  `tenant_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couples_allowed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_possible` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cleaning_commonc_room_incl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cleaning_private_room_incl` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `animal_allowed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `play_musical_instrument` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `smoking_allowed` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cover_image` longtext COLLATE utf8mb4_unicode_ci,
  `images` longtext COLLATE utf8mb4_unicode_ci,
  `booking_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT '0 for view in front,1 for draft contract, 2 for complete contract',
  `unit_category` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_in` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'SI unit of area',
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_units`
--

INSERT INTO `property_units` (`id`, `unit_name`, `rent`, `deposit`, `property_manager_id`, `property_description_experts_id`, `property_legal_advisor_id`, `property_visit_organizer_id`, `po_esignature`, `IsDeleted`, `tax`, `fix_price`, `choose_guarantor`, `amenities`, `created_at`, `updated_at`, `user_id`, `p_type`, `area`, `description`, `latitude`, `longitude`, `address`, `u_type`, `building_id`, `cost_provision`, `bedrooms`, `bed_funished`, `bed_lock`, `kitchen`, `toilet`, `living_room`, `balcony_terrace`, `garden`, `basement`, `parking`, `wheelchair`, `allergy_friendly`, `preferred_gender`, `min_age`, `max_age`, `tenant_type`, `couples_allowed`, `registration_possible`, `cleaning_commonc_room_incl`, `cleaning_private_room_incl`, `animal_allowed`, `play_musical_instrument`, `smoking_allowed`, `cover_image`, `images`, `booking_status`, `unit_category`, `area_in`, `total_amount`) VALUES
(1, 'First Unit', '200', '600', 11, 13, 6, 12, 'photo_esignature1573884329.png', 0, '300', '200', 'yes', '2,3,5,6,7', '2019-11-16 11:40:08', '2020-01-07 17:42:14', 10, 'unit', 50000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '50.832103', '-0.3410086000000092', '54 Test Road, Sompting, Lancing, UK', 'residential', NULL, 200, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 55, 57, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1573884407_Screenshot_from_2019-10-16_18-45-15.png', '1573884411_Screenshot_from_2019-10-18_10-12-33.png,1573884411_Screenshot_from_2019-10-18_10-11-35.png,', '1', 'room', 'square feet', '1500'),
(2, 'second unit', '300', '500', 1, 1, 1, 1, 'photo_esignature1573884763.png', 0, '200', '200', 'yes', '2,5,8,11,14', '2019-11-16 11:43:32', '2019-11-22 20:09:42', 1, 'unit', 500, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '40.0612924', '-76.7819748', '54 Test Road, York, PA, USA', 'residential', NULL, 300, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 55, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1573884807_Screenshot_from_2019-10-16_18-38-00.png', '1573884810_Screenshot_from_2019-10-18_10-11-35.png,1573884810_Screenshot_from_2019-10-16_18-45-15.png,', '0', 'apartment', 'square feet', '1500'),
(3, 'Property A', '10', '50', 11, 13, 14, 12, 'photo_esignature1574067094.png', 0, '40', '30', 'yes', '2,5,8', '2019-11-18 14:22:38', '2019-11-21 13:21:59', 10, 'unit', 4553, 'http://122.160.138.253:8080/property15/public/home', '50.7308605', '16.65678920000005', 'Dzierżoniów, Poland', 'commercial', NULL, 20, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574067150_1571818609_image_(1).png', '1574067155_1571818609_image_(1).png,', '0', 'office', 'square feet', '150'),
(4, 'test new job', '43', '4', 11, 13, 14, 12, 'photo_esignature1574160798.png', 0, '4', '4', 'yes', '2', '2019-11-19 16:24:20', '2019-11-21 17:46:24', 10, 'unit', 23, 'sdfsfdsfdsfdsfdsf', '51.4947186', '-0.1436198000000104', 'Victoria Station, London, UK', 'residential', NULL, 3, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 34, 44, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574160853_download_(2).png', '1574160857_latest-blog6.jpg,', '0', 'apartment', 'square meter', '58'),
(5, 'Role 1', '1', '5', 11, 1, 6, 12, 'photo_esignature1574161619.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-11-19 16:38:01', '2019-11-26 17:32:50', 1, 'unit', 1200, 'Lorem Ipsum is the dummy text of printing and typesetting industry.', '30.6942091', '76.86056499999995', 'Panchkula, Haryana, India', 'commercial', 1, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 25, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574161675_1571818609_image.png', '1574161679_1571818609_image.png,', '0', 'office', 'square feet', '15'),
(6, 'Role Two Check', '1', '5', 11, 10, 14, 12, 'photo_esignature1574163595.png', 0, '4', '3', 'yes', '2,5,8,11', '2019-11-19 17:11:13', '2019-11-25 11:07:20', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '11.9415915', '79.80831330000001', 'Pondicherry, Puducherry, India', 'commercial', NULL, 2, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574163667_1571818609_image.png', '1574163671_1571818609_image_(1).png,', '0', 'office', 'square feet', '15'),
(7, 'Role 3', '10', '50', 10, 13, 14, 12, 'photo_esignature1574163813.png', 0, '40', '30', 'yes', '2,5,8', '2019-11-19 17:14:20', '2019-11-22 17:31:48', 10, 'unit', 1200, 'Lorem', '33.01984309999999', '-96.69888559999998', 'Plano, TX, USA', 'commercial', NULL, 20, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574163851_5dc8f191ba479.png', '1574163857_5dc8f191ba479.png,', '0', 'warehouse', 'square feet', '150'),
(8, 'PM', '10', '50', 10, 13, 14, 12, 'photo_esignature1574167511.png', 0, '40', '30', 'yes', '2,5,8,11,14', '2019-11-19 18:16:17', '2019-11-27 10:35:55', 10, 'unit', 1222, 'Lorem Ipsum is the dummy text.', '35.7765247', '-78.63876549999998', 'PNC Plaza, Fayetteville Street, Raleigh, NC, USA', 'commercial', NULL, 20, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574167568_1571818609_image_(1).png', '1574167572_1571818609_image.png,', '0', 'office', 'square feet', '150'),
(9, 'Villa One', '100', '500', 11, 13, 14, 12, 'photo_esignature1574251621.png', 0, '400', '300', 'yes', '2,5,8', '2019-11-20 17:37:53', '2019-11-20 17:42:32', 10, 'unit', 1200, 'Lorem Ipsum is the dummy text pf printing and typesetting industry.', '50.11092209999999', '8.682126700000026', 'Frankfurt, Germany', 'commercial', NULL, 200, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574251667_1571818609_image_(1).png', '1574251672_1571818609_image.png,', '0', 'office', 'square feet', '1500'),
(10, 'First Property', '1', '5', 11, 13, 14, 12, 'photo_esignature1574344093.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-11-21 19:19:51', '2019-11-26 20:01:30', 10, 'unit', 1200, 'Lorem Ipsum is the dummy text of printing and typesetting industry.', '30.6942091', '76.86056499999995', 'Panchkula, Haryana, India', 'commercial', NULL, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574344183_action-adult-adventure-1122462.jpg', '1574344188_boat-boating-cap-209978.jpg,', '0', 'industrial', 'square feet', '15'),
(11, 'Vision Vivante', '1', '5', 11, 13, 14, 12, 'photo_esignature1574399886.png', 0, '4', '3', 'yes', '2,5', '2019-11-22 10:49:35', '2020-01-07 18:19:46', 10, 'unit', 1200, 'Lorem Description', '30.6942091', '76.86056499999995', 'Panchkula, Haryana, India', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574399947_1571818609_image_(1).png', '1574399954_bay-boats-dawn-327412.jpg,', '0', 'office', 'square meter', '15'),
(12, 'a', '1200', '1600', 11, 13, 14, 12, 'photo_esignature1574404442.png', 0, '1500', '1400', 'yes', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', '2019-11-22 11:16:02', '2019-11-22 15:24:40', 10, 'unit', 150000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '48.85661400000001', '2.3522219000000177', 'Paris, France', 'commercial', NULL, 1300, 5, 'no', 'no', 'private', 'shared', 'private', 'private', 'private', 'no', 'no', 'no', 'no', 'female', 20, 70, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574401558_5dc8f191ba479.png', '1574401561_5dc8f191ba479_(1).png,', '0', 'retail', 'square feet', '7000'),
(13, 'q', '12', '12', 11, 13, 6, 12, 'photo_esignature1574407993.png', 0, '12', '12', 'yes', '5,6', '2019-11-22 13:04:52', '2019-11-22 13:04:52', 1, 'unit', 213, 'sxc', '52.3666969', '4.894539799999961', 'Amsterdam, Netherlands', 'residential', NULL, 12, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 56, 67, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574408085_080817_0622_35Placestov15.jpg', '1574408075_shutterstock_1084035929-Copy.jpg,1574408075_rakchham-valley-nature.jpg,1574408075_9427629256_e48741498f_b.jpg,1574408075_Apple-Blossom-Kalpa-min-3.jpg,1574408075_Palace-at-Chail-Solan.jpg,1574408075_2018041275.jpg,1574408075_2018041221-1.jpg,1574408075_080817_0622_35Placestov16.jpg,1574408075_080817_0622_35Placestov15.jpg,1574408075_22himachal07.jpg,', '0', 'apartment', 'square feet', '60'),
(14, 'gggggg', '343', '2', 11, 13, 6, 12, 'photo_esignature1574409358.png', 0, '2', '22', 'yes', '2,3,16', '2019-11-22 13:27:30', '2019-11-22 13:27:30', 1, 'unit', 234, 'saasfsv dgrsg dsgsrg dgsrg dfbgdrsg saasfsv dgrsg dsgsrg dgsrg dfbgdrsgsaasfsv dgrsg dsgsrg dgsrg dfbgdrsg saasfsv dgrsg dsgsrg dgsrg dfbgdrsg', '50.11092209999999', '8.682126700000026', 'Frankfurt, Germany', 'commercial', NULL, 22, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 60, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574409438_2018041275.jpg', '1574409444_rakchham-valley-nature.jpg,1574409444_9427629256_e48741498f_b.jpg,1574409444_2018041221-1.jpg,1574409444_Palace-at-Chail-Solan.jpg,1574409445_080817_0622_35Placestov16.jpg,', '0', 'industrial', 'square feet', '391'),
(15, 'dfyrt', '23', '3', 11, 13, 6, 12, 'photo_esignature1574410621.png', 0, '32', '345', 'yes', '8', '2019-11-22 13:47:56', '2019-11-22 13:47:56', 1, 'unit', 6534, 'etgerg', '19.4326077', '-99.13320799999997', 'Mexico City, CDMX, Mexico', 'residential', NULL, 4, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 34, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574410670_shutterstock_1084035929-Copy.jpg', '1574410674_9427629256_e48741498f_b.jpg,1574410674_2018041275.jpg,1574410674_2018041221-1.jpg,', '0', 'apartment', 'square feet', '407'),
(16, 'qsa', '23', '2', 1, 1, 1, 1, 'photo_esignature1574422624.png', 0, '2', '2', 'yes', '2', '2019-11-22 17:07:46', '2019-11-27 10:36:21', 1, 'unit', 123, 'sdfe sdf', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'residential', NULL, 2, 6, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574422660_2018041275.jpg', '1574422664_22himachal07.jpg,', '0', 'apartment', 'square feet', '31'),
(17, 'qwerty', '23', '2', 1, 1, 1, 1, 'photo_esignature1574424070.png', 0, '2', '2', 'yes', '2,3,9,10,13,14,15,16', '2019-11-22 17:09:28', '2019-11-22 17:35:05', 1, 'unit', 123456, 'dsf', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 2, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 56, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574422763_22himachal07.jpg', '1574422766_080817_0622_35Placestov16.jpg,', '0', 'apartment', 'square feet', '31'),
(18, 'second', '12', '2', 1, 1, 1, 1, 'photo_esignature1574423893.png', 0, '52323', '45', 'yes', '1,12,13', '2019-11-22 17:22:55', '2019-11-22 17:28:23', 1, 'unit', 12345, 'asd', '52.3666969', '4.894539799999961', 'Amsterdam, Netherlands', 'residential', NULL, 12, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 19, 69, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574423568_2018041275.jpg', '1574423572_080817_0622_35Placestov15.jpg,1574423573_2018041221-1.jpg,', '0', 'apartment', 'square feet', '52394'),
(19, '2', '12', '33333', 1, 1, 1, 1, 'photo_esignature1574424746.png', 0, '25223', '34', 'yes', '2,3,4', '2019-11-22 17:43:18', '2019-11-22 17:44:15', 1, 'unit', 12, '2wds', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 11, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 33, 54, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574424792_9427629256_e48741498f_b.jpg', '1574424796_2018041275.jpg,', '0', 'studio', 'square feet', '58613'),
(20, 'asdas', '12', '33', 1, 1, 1, 1, 'photo_esignature1574425516.png', 0, '22', '25', 'yes', '2,3', '2019-11-22 17:55:42', '2019-11-22 17:56:09', 1, 'unit', 123, 'dsfsv ssw', '50.11092209999999', '8.682126700000026', 'Frankfurt, Germany', 'residential', NULL, 133, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 18, 63, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574425537_2018041221-1.jpg', '1574425540_080817_0622_35Placestov15.jpg,', '0', 'apartment', 'square feet', '225'),
(21, 'aa', '12', '1', 1, 1, 1, 1, 'photo_esignature1574838568.png', 0, '2', '43', 'yes', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16', '2019-11-22 18:01:34', '2019-11-27 12:39:37', 1, 'unit', 12, 'qwdeqw', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', 1, 45, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 13, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574425888_2018041221-1.jpg', '1574756998_2018041275.jpg,1574764017_shutterstock_1084035929-Copy.jpg,1574764017_rakchham-valley-nature.jpg,1574764030_shutterstock_1084035929-Copy.jpg,1574764030_rakchham-valley-nature.jpg,1574764030_9427629256_e48741498f_b.jpg,1574764030_Palace-at-Chail-Solan.jpg,1574764030_Apple-Blossom-Kalpa-min-3.jpg,1574764030_2018041275.jpg,1574764030_2018041221-1.jpg,1574764030_080817_0622_35Placestov16.jpg,1574764031_22himachal07.jpg,1574764031_080817_0622_35Placestov15.jpg,', '0', 'apartment', 'square feet', '103'),
(22, 'aabbcc', '12345', '123', 1, 1, 1, 1, 'photo_esignature1574657416.png', 0, '123', '123', 'yes', '5,6', '2019-11-25 10:21:31', '2019-11-27 10:36:13', 10, 'unit', 1233456, 'd dzxvds dfvgds dfvdf d', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'residential', NULL, 123, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 18, 70, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574657480_080817_0622_35Placestov16.jpg', '1574657483_shutterstock_1084035929-Copy.jpg,1574657483_Palace-at-Chail-Solan.jpg,1574657487_080817_0622_35Placestov16.jpg,1574657487_080817_0622_35Placestov15.jpg,', '0', 'apartment', 'square feet', '12837'),
(23, 'Check 2 Days', '1', '5', 11, 13, 14, 12, 'photo_esignature1574659223.png', 0, '4', '3', 'yes', '2,5,8', '2019-11-25 10:51:09', '2019-11-26 14:17:56', 10, 'unit', 1000, 'Lorem Ipsum is the dummy text.', '20.0139048', '73.81062320000001', 'Panchvati, Nashik, Maharashtra, India', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574659262_action-athlete-beach-1654498.jpg', '1574659266_action-beach-fun-416676.jpg,', '0', 'office', 'square feet', '15'),
(24, 'Credit Card Check', '1', '5', 11, 13, 14, 12, 'photo_esignature1574660776.png', 0, '4', '3', 'yes', '2,5', '2019-11-25 11:17:02', '2019-11-25 11:18:39', 10, 'unit', 1200, 'Lorem Ipsum', '48.85661400000001', '2.3522219000000177', 'Paris, France', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 48, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574660816_1571818609_image_(1).png', '1574660821_1571818609_image_(1).png,', '0', 'office', 'square feet', '15'),
(25, 'Payment Receipt', '1', '5', 11, 13, 14, 12, 'photo_esignature1574662395.png', 0, '4', '3', 'yes', '2,5', '2019-11-25 11:43:59', '2019-11-25 11:52:58', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '51.5073509', '-0.12775829999998223', 'London, UK', 'commercial', NULL, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 48, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574662434_5dc8f191ba479.png', '1574662438_5dc8f191ba479_(1).png,', '0', 'office', 'square feet', '15'),
(26, 'Accept Testing', '1', '5', 11, 13, 14, 12, 'photo_esignature1574664885.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-11-25 12:25:23', '2019-11-25 12:30:00', 10, 'unit', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '39.7392358', '-104.990251', 'Denver, CO, USA', 'residential', 1, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574664918_1571818609_image_(1).png', '1574664921_1571818609_image.png,', '0', 'apartment', 'square feet', '15'),
(27, 'Test PDE Process', '1200', '1600', 11, 13, 14, 12, 'photo_esignature1574676818.png', 0, '1500', '1400', 'yes', '2,8', '2019-11-25 15:44:30', '2019-11-25 15:48:50', 10, 'unit', 1200, 'Lorem Ipsum is the dummy text.', '23.35745709999999', '87.81137059999992', 'Panchkula, West Bengal, India', 'commercial', NULL, 1300, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574676866_1571818609_image_(1).png', '1574676869_1571818609_image_(1).png,', '0', 'office', 'square feet', '7000'),
(28, 'Space 1', '1', '5', 11, 13, 6, 12, 'photo_esignature1574682605.png', 0, '4', '3', 'yes', '2,5', '2019-11-25 17:28:35', '2019-11-25 17:45:47', 10, 'unit', 1000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '51.5073509', '-0.12775829999998223', 'London, UK', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 12, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574683109_1571818609_image_(1).png', '1574683114_1571818609_image.png,', '0', 'office', 'square feet', '15'),
(29, 'Space 2', '12', '16', 11, 13, 14, 12, 'photo_esignature1574684789.png', 0, '15', '14', 'yes', '2,5', '2019-11-25 17:57:15', '2019-11-25 17:59:07', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '38.9071923', '-77.03687070000001', 'Washington D.C., DC, USA', 'commercial', NULL, 13, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574684830_5dc8f191ba479.png', '1574684834_5dc8f191ba479_(1).png,', '0', 'office', 'square feet', '70'),
(30, 'Space 3', '1', '5', 11, 13, 14, 12, 'photo_esignature1574686949.png', 0, '4', '3', 'yes', '2,5', '2019-11-25 18:33:13', '2019-11-25 18:34:17', 10, 'unit', 1000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '51.4556432', '7.011555199999975', 'Essen, Germany', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574686985_1571818609_image_(1).png', '1574686991_1571818609_image_(1).png,', '0', 'office', 'square feet', '15'),
(31, 'a', '2', '2', 1, 1, 1, 1, 'photo_esignature1574758644.png', 0, '2', '2', 'yes', '5,8', '2019-11-26 14:27:03', '2019-11-26 14:27:35', 1, 'unit', 123, 'desf', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 12, 12, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574758617_9427629256_e48741498f_b.jpg', '1574758621_080817_0622_35Placestov16.jpg,', '0', 'apartment', 'square feet', '10'),
(32, '27 Unit 1', '1', '5', 11, 13, 14, 12, 'photo_esignature1574837069.png', 1, '4', '3', 'yes', '8', '2019-11-27 12:15:11', '2019-12-10 13:15:25', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '51.5073509', '-0.12775829999998223', 'London, UK', 'commercial', 7, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574837107_1571818609_image_(1).png', '1574837110_1571818609_image_(1).png,', '0', 'retail', 'square feet', '15'),
(33, 'Commercial', '100', '500', 11, 13, 14, 12, 'photo_esignature1574838663.png', 0, '400', '300', 'yes', '2,5', '2019-11-27 12:42:15', '2019-11-27 12:42:15', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '41.90278349999999', '12.496365500000024', 'Roma, Metropolitan City of Rome, Italy', 'commercial', NULL, 200, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 60, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574838718_5dc8f191ba479.png', '1574838721_1571818609_image_(1).png,', '0', 'office', 'square feet', '1500'),
(34, 'ACE', '1', '5', 11, 13, 14, 12, 'photo_esignature1574843216.png', 0, '4', '3', 'yes', '2,5', '2019-11-27 13:58:53', '2019-11-27 13:58:53', 10, 'unit', 1200, '(Out of Scope now)', '-12.0463731', '-77.042754', 'Lima, Peru', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574843328_1571818609_image_(1).png', '1574843332_5dc8f191ba479.png,', '0', 'office', 'square feet', '15'),
(35, 'Farm 1', '100', '500', 11, 13, 14, 12, 'photo_esignature1574849959.png', 0, '400', '300', 'yes', '11,14', '2019-11-27 15:50:07', '2019-11-27 15:54:18', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', NULL, NULL, 'xzcfxz', 'residential', NULL, 200, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574850003_1571818609_image_(1).png', '1574850006_5dc8f191ba479.png,', '0', 'studio', 'square feet', '1500'),
(36, 'Farm2', '1', '5', 11, 13, 14, 12, 'photo_esignature1574850600.png', 0, '4', '3', 'yes', '2,5', '2019-11-27 16:00:58', '2019-11-27 16:03:32', 10, 'unit', 100, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '41.90278349999999', '12.496365500000024', 'Roma, Metropolitan City of Rome, Italy', 'residential', NULL, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574850651_1571818609_image_(1).png', '1574850656_action-adventure-boats-1076992.jpg,', '0', 'house', 'square feet', '15'),
(37, 'Farm 3', '1', '5', 11, 13, 14, 12, 'photo_esignature1574851339.png', 0, '4', '3', 'yes', '2,5,8,11', '2019-11-27 16:13:01', '2019-11-27 16:21:21', 10, 'unit', 1200, 'dsfdsgfds', '40.7504662', '-73.96597159999999', 'FDR Drive, New York, NY, USA', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574851377_1571818609_image_(1).png', '1574851380_1571818609_image_(1).png,', '0', 'room', 'square feet', '15'),
(38, 'Farm 5', '1', '5', 11, 13, 14, 12, 'photo_esignature1574852179.png', 0, '4', '3', 'yes', '11', '2019-11-27 16:27:12', '2019-11-27 17:00:46', 10, 'unit', 222, 'lorem ipsum is the dummy text.', '48.85661400000001', '2.3522219000000177', 'Paris, France', 'residential', NULL, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 60, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574852228_1571818609_image_(1).png', '1574852231_1571818609_image.png,', '0', 'room', 'square feet', '15'),
(39, 'Farm 6', '1', '5', 11, 13, 14, 12, 'photo_esignature1574852555.png', 0, '4', '3', 'yes', '2,5,8', '2019-11-27 16:33:15', '2019-11-27 16:42:03', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '-23.5173078', '-46.6266493', 'Rua Voluntários da Pátria, 344 - Santana, São Paulo - State of São Paulo, Brazil', 'residential', NULL, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574852591_5dc8f191ba479.png', '1574852594_5dc8f191ba479.png,', '0', 'studio', 'square feet', '15'),
(40, 'Farm 7', '1', '5', 11, 13, 14, 10, 'photo_esignature1574855125.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-11-27 17:16:26', '2019-11-27 17:32:27', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '41.90278349999999', '12.496365500000024', 'Roma, Metropolitan City of Rome, Italy', 'residential', NULL, 2, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574855182_1571818609_image_(1).png', '1574855185_1571818609_image_(1).png,', '0', 'studio', 'square feet', '15'),
(41, 'pankaj', '12', '12', 1, 1, 1, 1, 'photo_esignature1574855289.png', 0, '12', '12', 'yes', '5,8,11', '2019-11-27 17:19:47', '2019-11-27 17:19:47', 1, 'unit', 1200, 'dryhrtf', '20.65969879999999', '-103.34960920000003', 'Guadalajara, Jalisco, Mexico', 'residential', 1, 12, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 15, 23, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574855379_Apple-Blossom-Kalpa-min-3.jpg', '1574855383_2018041221-1.jpg,', '0', 'apartment', 'square feet', '60'),
(42, 'Farm 8', '1', '5', 11, 13, 14, 12, 'photo_esignature1574855502.png', 0, '4', '3', 'yes', '2,5,8', '2019-11-27 17:22:26', '2019-11-28 11:01:38', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574855540_1571818609_image_(1).png', '1574855544_1571818609_image_(1).png,', '0', 'house', 'square feet', '15'),
(43, 'new unit', '12', '12', 11, 13, 6, 12, 'photo_esignature1574861226.png', 0, '12', '12', 'yes', '2,5,7,10,11,12,14,15', '2019-11-27 19:00:28', '2019-11-27 19:00:28', 1, 'unit', 700, 'this is descriptions', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'residential', NULL, 12, 8, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'no preference', 12, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574861418_9427629256_e48741498f_b.jpg', '1574861424_shutterstock_1084035929-Copy.jpg,1574861425_2018041221-1.jpg,1574861424_2018041275.jpg,1574861425_080817_0622_35Placestov16.jpg,', '0', 'room', 'square feet', '60'),
(44, 'MDC 1', '1', '5', 11, 13, 14, 12, 'photo_esignature1574918068.png', 0, '4', '3', 'yes', '2,5', '2019-11-28 10:45:37', '2019-11-28 10:57:29', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '52.3666969', '4.894539799999961', 'Amsterdam, Netherlands', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574918132_1571818609_image_(1).png', '1574918136_5dc8f191ba479.png,', '0', 'retail', 'square feet', '15'),
(45, 'Home1', '1000', '5000', 11, 13, 14, 12, 'photo_esignature1574919362.png', 0, '4000', '3000', 'yes', '2,5', '2019-11-28 11:07:20', '2019-11-28 11:10:40', 10, 'unit', 12000, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '51.4556432', '7.011555199999975', 'Essen, Germany', 'residential', NULL, 2000, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574919434_action-adventure-boats-1076992.jpg', '1574919439_1571818609_image.png,', '0', 'house', 'square feet', '15000'),
(46, 'bt', '1', '5', 11, 13, 14, 12, 'photo_esignature1574919889.png', 0, '4', '3', 'yes', '2,5', '2019-11-28 11:15:31', '2020-01-07 19:34:08', 10, 'unit', 1233, 'fdsfsd gds', '50.11092209999999', '8.682126700000026', 'Frankfurt, Germany', 'residential', NULL, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 12, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574919925_1571818609_image_(1).png', '1574919929_action-adventure-boats-1076992.jpg,', '0', 'studio', 'square feet', '15'),
(47, 'pp', '1', '10000', 11, 13, 14, 12, 'photo_esignature1574920685.png', 0, '1000', '100', 'yes', '2,5', '2019-11-28 11:29:03', '2019-12-16 17:21:45', 10, 'unit', 1222, 'ewr wt trwt ewtt wet', '39.7392358', '-104.990251', 'Denver, CO, USA', 'residential', NULL, 10, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 11, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574920739_1571818609_image_(1).png', '1574920742_5dc8f191ba479.png,', '1', 'room', 'square feet', '11111'),
(48, 'A Unituu', '1', '2', 11, 13, 14, 12, 'photo_esignature1574921145.png', 1, '1', '3', 'yes', '2,5', '2019-11-28 11:36:34', '2019-12-10 13:15:25', 10, 'unit', 1200, 'Lorem Ipsum is the dummy text.', '51.4556432', '7.011555199999975', 'Essen, Germany', 'commercial', 7, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574921190_5dc8f191ba479.png', '1574921193_1571818609_image_(1).png,', '0', 'retail', 'square feet', '9'),
(49, 'pde not', '1', '5', 11, 10, 14, 12, 'photo_esignature1574923501.png', 0, '4', '3', 'yes', '5,8', '2019-11-28 12:15:43', '2019-11-28 12:15:43', 10, 'unit', 1200, 'rtyurt urturt urtutr', '12.9148603', '77.52063950000002', 'RR Nagar, Bengaluru, Karnataka, India', 'residential', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 34, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1574923535_action-athlete-beach-1654498.jpg', '1574923538_action-athlete-beach-1654498.jpg,', '0', 'apartment', 'square feet', '15'),
(50, 'Test A', '1', '5', 11, 13, 14, 12, 'photo_esignature1575443871.png', 0, '4', '3', 'yes', '2', '2019-12-04 12:49:00', '2020-01-07 19:34:08', 10, 'unit', 1200, 'Lorem Ipsum', '56.130366', '-106.34677099999999', 'Canada', 'commercial', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 44, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575443934_1571818609_image.png', '1575443938_action-beach-fun-416676.jpg,', '0', 'office', 'square feet', '15'),
(51, 'Test B', '1', '7', 11, 13, 14, 12, 'photo_esignature1575444678.png', 0, '5', '3', 'yes', '2,5', '2019-12-04 13:02:02', '2019-12-04 13:03:47', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '51.5072009', '-0.22125210000001516', 'Westfield Shopping Centre, London, UK', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 12, 23, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575444713_1571818609_image_(1).png', '1575444718_1571818609_image.png,', '0', 'apartment', 'square feet', '18'),
(52, 'q', '11', '15', 11, 13, 14, 12, 'photo_esignature1575445883.png', 0, '14', '13', 'yes', '2,3', '2019-12-04 13:22:06', '2019-12-13 13:00:22', 10, 'unit', 111, 'qwerty', '-0.1806532', '-78.46783820000002', 'Quito, Ecuador', 'residential', NULL, 12, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575445921_1571818609_image.png', '1575445924_action-beach-fun-416676.jpg,', '1', 'room', 'square feet', '65'),
(53, 'Miracle Studios', '1000', '1200', 26, 25, 24, 23, 'photo_esignature1575447430.png', 0, '100', '200', 'yes', '2,5,8,11,14', '2019-12-04 13:47:50', '2019-12-13 13:02:25', 27, 'unit', 1000, 'Miracle Studios Description', '30.7252367', '76.8519139', 'IT Park Road, Mansa Devi Complex, Phase - I, Manimajra, Panchkula, Haryana, India', 'commercial', 10, 300, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'male', 18, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575447464_about_us_–_our_story_11970.jpg', '1575447467_about_us_–_our_story_11970.jpg,', '1', 'office', 'square feet', '2800'),
(54, 'test c', '1', '1222', 11, 13, 14, 12, 'photo_esignature1575449524.png', 0, '4', '3', 'yes', '8', '2019-12-04 14:22:45', '2019-12-11 12:00:54', 10, 'unit', 1222, 'dasd fdsf sdgf', '15.0270487', '120.69408420000002', 'DSF Building, Gen Hizon Extension, San Fernando, Pampanga, Philippines', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575449558_1571818609_image_(1).png', '1575449564_1571818609_image_(1).png,', '1', 'apartment', 'square feet', '1232'),
(55, 'vISION', '1', '1', 11, 13, 14, 12, 'photo_esignature1575963699.png', 1, '3', '3', 'yes', '8', '2019-12-10 13:12:39', '2019-12-10 13:15:43', 10, 'unit', 1000, 'QQQQ', '6.4418773', '3.415938600000004', 'Awolowo Road, Lagos, Nigeria', 'residential', 11, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575963756_1571818609_image_(1).png', '1575963758_5dc8f191ba479.png,', '0', 'parking', 'square feet', '10'),
(56, 'SB', '11', '55', 11, 13, 14, 12, 'photo_esignature1575963816.png', 1, '44', '33', 'yes', '5', '2019-12-10 13:14:17', '2019-12-10 13:15:43', 10, 'unit', 2233, 'LOREM IPSUM', '50.98476789999999', '11.029880000000048', 'Erfurt, Germany', 'commercial', 11, 22, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575963852_1571818609_image_(1).png', '1575963856_close-envelope.png,', '0', 'office', 'square feet', '165'),
(57, 'sec1', '10', '50', 11, 13, 14, 12, 'photo_esignature1575964025.png', 1, '40', '30', 'yes', '11', '2019-12-10 13:17:59', '2019-12-10 13:19:04', 10, 'unit', 33, 'sdsfds', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'commercial', 12, 20, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 44, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575964075_1571818609_image_(1).png', '1575964078_5dc8f191ba479.png,', '0', 'office', 'square feet', '150'),
(58, 'A', '12', '16', 11, 13, 14, 12, 'photo_esignature1575964457.png', 1, '15', '14', 'yes', '2,5', '2019-12-10 13:25:18', '2019-12-10 13:38:37', 10, 'unit', 1200, 'lorem', '20.6295586', '-87.07388509999998', 'Playa del Carmen, Quintana Roo, Mexico', 'residential', 13, 13, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 23, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575964513_1571818609_image_(1).png', '1575964516_5dc8f191ba479.png,', '0', 'house', 'square feet', '70'),
(59, 'B', '3', '2', 11, 13, 14, 12, 'photo_esignature1575964555.png', 1, '0', '1', 'yes', '5', '2019-12-10 13:26:49', '2019-12-10 13:38:37', 10, 'unit', 12, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '13.9282697', '121.43804580000005', 'Lorema Subdivision Main Road, Candelaria, Quezon, Philippines', 'residential', 13, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 26, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575964605_document1574677641.png', '1575964608_1571818609_image_(1).png,', '0', 'room', 'square feet', '8'),
(60, 'QWASWS', '2', '3', 11, 13, 14, 12, 'photo_esignature1575964676.png', 0, '4', '4', 'yes', '5', '2019-12-10 13:28:35', '2019-12-11 12:43:03', 10, 'unit', 1233, 'DSFDF FGDF GG DSGDFSG', '55.953252', '-3.188266999999996', 'Edinburgh, UK', 'residential', NULL, 3, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575964711_close-envelope.png', '1575964714_1571818609_image_(1).png,', '1', 'apartment', 'square feet', '16'),
(61, 'C', '2', '2', 11, 13, 14, 12, 'photo_esignature1575964761.png', 1, '1', '2', 'yes', '14', '2019-12-10 13:30:08', '2019-12-10 13:38:37', 10, 'unit', 1233, 'WEW', '38.9071923', '-77.03687070000001', 'Washington D.C., DC, USA', 'commercial', 13, 3, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1575964805_5dc8f191ba479.png', '1575964807_5dc8f191ba479_(1).png,', '0', 'office', 'square feet', '10'),
(62, '1 Unit Test', '12', '16', 11, 13, 14, 12, 'photo_esignature1576126480.png', 0, '15', '14', 'yes', '11', '2019-12-12 10:28:01', '2019-12-12 10:29:14', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '34.0533056', '-118.26610040000003', '1234 Wilshire Boulevard, Los Angeles, CA, USA', 'residential', NULL, 13, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 25, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576126674_action-athlete-beach-1654498.jpg', '1576126678_beach-clouds-coastline-1268865.jpg,', '1', 'room', 'square feet', '70'),
(63, '2 Unit Test', '1', '1', 11, 13, 14, 12, 'photo_esignature1576126981.png', 0, '2', '3', 'yes', '2,5,8', '2019-12-12 10:33:43', '2019-12-12 10:35:27', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '39.1910983', '-106.8175387', 'Aspen, CO, USA', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576127017_adult-blond-casual-1493373.jpg', '1576127022_action-beach-fun-416676.jpg,', '1', 'office', 'square feet', '9'),
(64, '3 Unit Test', '1', '5', 11, 13, 14, 12, 'photo_esignature1576484140.png', 0, '4', '3', 'yes', '5,8', '2019-12-12 16:34:01', '2019-12-16 13:45:49', 10, 'unit', 1200, 'lorem ipsum', '51.919438', '19.14513599999998', 'Poland', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576148637_adult-blond-casual-1493373.jpg', '1576148640_action-athlete-beach-1654498.jpg,', '1', 'house', 'square feet', '15'),
(65, 'new test', '100', '500', 26, 25, 24, 23, 'photo_esignature1576217499.png', 0, '40', '50', 'yes', '2', '2019-12-13 11:43:09', '2019-12-13 11:44:53', 27, 'unit', 34, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsu', '48.85661400000001', '2.3522219000000177', 'Paris, France', 'commercial', NULL, 200, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576217582_download_(4).jpeg', '1576217586_Bindersart1.png,1576217586_Screenshot_from_2018-11-03_12-59-16.png,', '1', 'office', 'square feet', '890'),
(66, '55', '34', '4444', 26, 25, 24, 23, 'photo_esignature1576332682.png', 0, '34', '34', 'yes', '11', '2019-12-14 19:42:13', '2019-12-14 19:42:13', 27, 'unit', 55, 'dftyg', '42.3631542', '-71.06883340000002', '55 Fruit Street, Boston, MA, USA', 'commercial', NULL, 34, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 44, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576332727_Bindersart1.png', '1576332731_Bindersart1.png,1576332731_Screenshot_from_2019-06-04_18-57-01.png,1576332731_Screenshot_from_2019-07-27_17-36-21.png,', '0', 'industrial', 'square meter', '4580'),
(67, 'Alpha Unit', '100', '500', 11, 13, 14, 12, 'photo_esignature1576493123.png', 0, '400', '300', 'yes', '2,5,8,11', '2019-12-16 16:16:43', '2019-12-16 16:28:41', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '39.1910983', '-106.8175387', 'Aspen, CO, USA', 'residential', NULL, 200, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576493199_1571818609_image_(1).png', '1576493202_5dc8f191ba479_(1).png,', '1', 'room', 'square feet', '1500'),
(68, 'Beta', '100', '500', 11, 13, 14, 12, 'photo_esignature1576493232.png', 0, '400', '300', 'yes', '2', '2019-12-16 16:18:22', '2019-12-16 17:15:41', 10, 'unit', 1300, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '40.4529251', '49.73332349999998', 'Xırdalan, Azerbaijan', 'residential', NULL, 200, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576493296_1571818609_image_(1).png', '1576493300_1571818609_image_(1).png,', '1', 'room', 'square feet', '1500'),
(69, '100', '1', '5', 11, 13, 14, 12, 'photo_esignature1576497486.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-12-16 17:28:56', '2019-12-16 19:16:54', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '28.3843253', '-81.31644240000003', '12340 Boggy Creek Road, Orlando, FL, USA', 'residential', NULL, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 50, 60, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576497531_1571818609_image_(1).png', '1576497535_5dc8f191ba479_(1).png,', '1', 'house', 'square feet', '15'),
(70, '99', '1', '5', 11, 13, 14, 12, 'photo_esignature1576497852.png', 0, '4', '3', 'yes', '2,5,8,11,14', '2019-12-16 17:34:55', '2019-12-18 12:55:18', 10, 'unit', 1300, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '42.3353902', '-71.0737292', 'FGH Building, Harrison Avenue, Boston, MA, USA', 'residential', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576497890_5dc8f191ba479_(1).png', '1576497894_1571818609_image_(1).png,', '1', 'house', 'square feet', '15'),
(71, 'PDE testing', '400', '2000', 26, 25, 24, 23, 'photo_esignature1576581664.png', 0, '50', '100', 'yes', '11', '2019-12-17 16:52:14', '2019-12-17 16:54:50', 27, 'unit', 1222, 'cfdsfdsf', '40.7589632', '-73.97933739999996', '30 Rockefeller Plaza, New York, NY, USA', 'residential', NULL, 200, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 24, 42, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576581730_download_(2).png', '1576581732_star2.png,', '1', 'room', 'square meter', '2750'),
(72, 'Check Readings', '11', '15', 11, 13, 14, 12, 'photo_esignature1576582961.png', 1, '14', '13', 'yes', '2,5,8,11,14', '2019-12-17 17:17:51', '2019-12-18 10:36:42', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '51.5072009', '-0.22125210000001516', 'Westfield Shopping Centre, London, UK', 'commercial', NULL, 12, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 10, 20, 'any', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '1576583259_document1574677640.png', '1576583263_5dc8f191ba479.png,', '1', 'office', 'square feet', '65'),
(73, 'Check R2', '11', '15', 11, 13, 14, 12, 'photo_esignature1576584640.png', 0, '14', '13', 'yes', '2,5,8,11,14', '2019-12-17 17:41:05', '2019-12-17 17:42:44', 10, 'unit', 12333, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '51.4556432', '7.011555199999975', 'Essen, Germany', 'residential', NULL, 12, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 55, 56, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576584661_1571818609_image_(1).png', '1576584664_1571818609_image_(1).png,', '1', 'room', 'square feet', '65'),
(74, 'Check R3', '1', '5', 11, 13, 14, 12, 'photo_esignature1576585012.png', 1, '4', '3', 'yes', '8', '2019-12-17 17:48:08', '2019-12-18 10:36:58', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '38.9071923', '-77.03687070000001', 'Washington D.C., DC, USA', 'residential', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 35, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576585084_5dc8f191ba479_(1).png', '1576585087_5dc8f191ba479.png,', '1', 'house', 'square feet', '15');
INSERT INTO `property_units` (`id`, `unit_name`, `rent`, `deposit`, `property_manager_id`, `property_description_experts_id`, `property_legal_advisor_id`, `property_visit_organizer_id`, `po_esignature`, `IsDeleted`, `tax`, `fix_price`, `choose_guarantor`, `amenities`, `created_at`, `updated_at`, `user_id`, `p_type`, `area`, `description`, `latitude`, `longitude`, `address`, `u_type`, `building_id`, `cost_provision`, `bedrooms`, `bed_funished`, `bed_lock`, `kitchen`, `toilet`, `living_room`, `balcony_terrace`, `garden`, `basement`, `parking`, `wheelchair`, `allergy_friendly`, `preferred_gender`, `min_age`, `max_age`, `tenant_type`, `couples_allowed`, `registration_possible`, `cleaning_commonc_room_incl`, `cleaning_private_room_incl`, `animal_allowed`, `play_musical_instrument`, `smoking_allowed`, `cover_image`, `images`, `booking_status`, `unit_category`, `area_in`, `total_amount`) VALUES
(75, 'Note', '1', '5', 11, 13, 14, 12, 'photo_esignature1576646156.png', 0, '4', '3', 'yes', '2,5', '2019-12-18 10:46:53', '2019-12-18 10:49:50', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '-0.1806532', '-78.46783820000002', 'Quito, Ecuador', 'residential', NULL, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576646209_1576477145.png', '1576646212_5dc8f191ba479_(1).png,', '1', 'room', 'square feet', '15'),
(76, 'ABCDEFGH', '2', '65', 11, 13, 14, 12, 'photo_esignature1576649250.png', 0, '5', '4', 'yes', '2,5,8', '2019-12-18 11:38:17', '2019-12-18 11:39:51', 10, 'unit', 22, '323', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 3, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 56, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576649293_5dc8f191ba479_(1).png', '1576649296_5dc8f191ba479_(1).png,', '1', 'apartment', 'square feet', '79'),
(77, 'X', '1', '56', 11, 13, 14, 12, 'photo_esignature1576649739.png', 1, '54', '34', 'yes', '2,5,8', '2019-12-18 11:46:37', '2019-12-18 11:51:00', 10, 'unit', 1233, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '51.5072009', '-0.22125210000001516', 'Westfield Shopping Centre, London, UK', 'residential', 14, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 12, 50, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576649782_5dc8f191ba479_(1).png', '1576649786_5dc8f191ba479_(1).png,', '1', 'room', 'square feet', '147'),
(78, 'P', '1', '22', 11, 13, 14, 12, 'photo_esignature1576650570.png', 1, '33', '3', 'yes', '2,5,8,11', '2019-12-18 12:00:22', '2019-12-18 12:06:06', 10, 'unit', 121, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', 15, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 44, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576650619_5dc8f191ba479_(1).png', '1576650621_5dc8f191ba479_(1).png,', '1', 'room', 'square feet', '61'),
(79, 'a', '2', '4', 11, 13, 14, 12, 'photo_esignature1576652605.png', 0, '5', '3', 'yes', '2,5', '2019-12-18 12:38:32', '2019-12-18 12:40:10', 10, 'unit', 11, 'lorem', '52.3666969', '4.894539799999961', 'Amsterdam, Netherlands', 'residential', 16, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 44, 55, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576652907_5dc8f191ba479_(1).png', '1576652911_5dc8f191ba479_(1).png,', '1', 'room', 'square feet', '16'),
(80, 'Unit 1', '1', '22', 11, 13, 14, 12, 'photo_esignature1576655439.png', 0, '44', '33', 'yes', '8', '2019-12-18 13:21:49', '2019-12-18 13:21:49', 10, 'unit', 122, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', 16, 2, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 22, 60, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576655505_1576477145.png', '1576655508_5dc8f191ba479_(1).png,', '0', 'studio', 'square feet', '102'),
(81, 'Unit 2', '11', '114', 11, 13, 14, 12, 'photo_esignature1576655548.png', 0, '44', '33', 'yes', '2,5,8', '2019-12-18 13:23:15', '2019-12-18 13:23:15', 10, 'unit', 2344, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '51.1078852', '17.03853760000004', 'Wrocław, Poland', 'residential', NULL, 22, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 24, 45, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576655591_1576477145.png', '1576655594_5dc8f191ba479_(1).png,', '0', 'room', 'square feet', '224'),
(82, 'Q', '5', '7', 11, 13, 14, 12, 'photo_esignature1576674835.png', 0, '6', '5', 'yes', '2,5,8', '2019-12-18 18:54:38', '2019-12-18 19:08:30', 10, 'unit', 1234, 'lorem ipsum', '37.1773363', '-3.5985570999999936', 'Granada, Spain', 'residential', 17, 6, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 30, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576675472_1576477145.png', '1576675477_1576477145.png,', '1', 'apartment', 'square feet', '29'),
(83, '12qww2', '1', '3', 11, 13, 14, 12, 'photo_esignature1576676415.png', 1, '3', '3', 'yes', '14', '2019-12-18 19:11:28', '2019-12-18 19:11:44', 10, 'unit', 123, 'fd', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'commercial', 18, 22, 1, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 34, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576676478_1571818609_image_(1).png', '1576676482_5dc8f191ba479_(1).png,', '0', 'office', 'square feet', '32'),
(84, 'Ticket1', '1', '2', 11, 13, 14, 12, 'photo_esignature1576758844.png', 0, '3', '3', 'yes', '2,5,8,11,14', '2019-12-19 18:05:04', '2019-12-19 18:30:06', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and', '52.3666969', '4.894539799999961', 'Amsterdam, Netherlands', 'commercial', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 20, 40, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576758899_5dc8f191ba479.png', '1576758902_1576477145.png,', '1', 'retail', 'square feet', '11'),
(85, 'Ticket2', '1', '423', 11, 13, 14, 12, 'photo_esignature1576758938.png', 0, '44', '334', 'yes', '2,5', '2019-12-19 18:06:34', '2019-12-19 18:06:34', 10, 'unit', 1200, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '-33.8688197', '151.20929550000005', 'Sydney NSW, Australia', 'residential', NULL, 2, 2, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576758990_5dc8f191ba479_(1).png', '1576758993_5dc8f191ba479_(1).png,', '0', 'studio', 'square feet', '804'),
(86, 'test for entry', '100', '1000', 11, 13, 14, 12, 'photo_esignature1576838844.png', 0, '50', '50', 'yes', '11', '2019-12-20 16:19:55', '2019-12-20 16:22:53', 10, 'unit', 23, 'Lorem Ipsum is simply dummy text of the printing and', '41.90278349999999', '12.496365500000024', 'Roma, Metropolitan City of Rome, Italy', 'commercial', NULL, 200, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576838989_download.png', '1576838993_latest-blog6.jpg,1576838993_download.png,1576838993_star2.png,', '1', 'office', 'square feet', '1400'),
(87, 'exit', '200', '1000', 11, 13, 14, 12, 'photo_esignature1576839018.png', 0, '50', '50', 'yes', '11', '2019-12-20 16:21:31', '2019-12-20 16:29:17', 10, 'unit', 234, 'dsfdsf', '40.7589632', '-73.97933739999996', '30 Rockefeller Plaza, New York, NY, USA', 'residential', 8, 100, 5, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 33, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1576839086_star2.png', '1576839089_download_(1).png,1576839089_download_(2).png,', '1', 'apartment', 'square feet', '1400'),
(88, 'hi', '1', '5', 11, 13, 14, 12, 'photo_esignature1578400567.png', 0, '4', '3', 'yes', '2,5', '2020-01-07 18:06:50', '2020-01-07 18:06:50', 10, 'unit', 1222, 'test description', '25.2048493', '55.270782800000006', 'Dubai - United Arab Emirates', 'residential', NULL, 2, 3, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 23, 34, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1578400605_1571818609_image_(1).png', '1578400608_close-envelope.png,', '0', 'apartment', 'square feet', '15'),
(89, 'rew', '434', '4', 11, 13, 14, 12, 'photo_esignature1578557051.png', 0, '34', '3434', 'yes', '2', '2020-01-09 13:35:07', '2020-01-09 13:35:07', 10, 'unit', 34, 'dfg', '50.11092209999999', '8.6821267', 'Frankfurt, Germany', 'commercial', NULL, 3434, 4, 'no', 'yes', 'private', 'private', 'shared', 'shared', 'shared', 'shared', 'private', 'no', 'private', 'female', 34, 44, 'any', 'yes', 'yes', 'no', 'yes', 'yes', 'no', 'no', '1578557103_download_(3).jpeg', '1578557105_Screenshot_from_2019-08-19_17-11-28.png,', '0', 'industrial', 'square feet', '7340');

-- --------------------------------------------------------

--
-- Table structure for table `property_vendors`
--

CREATE TABLE `property_vendors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL,
  `property_unit_id` int(11) DEFAULT NULL,
  `vendor_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsDeleted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_vendors`
--

INSERT INTO `property_vendors` (`id`, `user_id`, `building_id`, `property_unit_id`, `vendor_type`, `name`, `phone_no`, `email`, `IsDeleted`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, 'Locksmith', 'test67657', '43543', '4354@g.com', 0, '2019-11-16 11:40:08', '2019-11-16 11:40:08'),
(2, 1, NULL, 13, 'Locksmith', 'sd', '34', 'sdg@dg', 0, '2019-11-22 13:04:52', '2019-11-22 13:04:52'),
(3, 1, NULL, 15, 'Locksmith', 'ghh', '3535', 'sdg@rg', 0, '2019-11-22 13:47:56', '2019-11-22 13:47:56'),
(4, 1, NULL, 2, 'Locksmith', 'qwqerty', '12344456', 'sddsf@f', 0, '2019-11-22 20:09:42', '2019-11-22 20:09:42'),
(5, 10, NULL, 28, 'Plumber', 'qwerty', '9876512345', 'test@yopmail.com', 0, '2019-11-25 17:28:35', '2019-11-25 17:28:35'),
(6, 1, 4, NULL, 'Locksmith', 'fg', '54352345', 'jj@fgd.com', 0, '2019-11-26 19:49:05', '2019-11-26 19:49:05'),
(7, 1, 4, NULL, 'Locksmith', 'trw', '5342534', 'jj@fgd.com', 0, '2019-11-26 19:49:05', '2019-11-26 19:49:05'),
(8, 1, 4, NULL, 'Heating', 'wt', '6543654', 'jj@fgd.com', 0, '2019-11-26 19:49:05', '2019-11-26 19:49:05'),
(9, 1, 5, NULL, 'Locksmith', 's', '322', 's@gmail.com', 0, '2019-11-27 10:51:59', '2019-11-27 10:51:59'),
(10, 10, 7, NULL, 'Electrician', 'Einstein', '9512245152', 'jyotivisionvivante@gmail.com', 1, '2019-11-27 12:13:18', '2019-12-10 13:15:25'),
(11, 10, 7, NULL, 'Heating', 'helin', '9089780009', 'jyotivisionvivante@gmail.com', 1, '2019-11-27 12:13:18', '2019-12-10 13:15:25'),
(12, 10, 8, NULL, 'Plumber', 'ttggg', '6545656789', 'jyotivisionvivante@gmail.com', 0, '2019-11-27 12:36:25', '2019-11-27 12:36:25'),
(13, 10, NULL, 36, 'Electrician', 'west', '9089780009', 'jyotivisionvivante@gmail.com', 0, '2019-11-27 16:00:58', '2019-11-27 16:00:58'),
(14, 10, NULL, 38, 'Plumber', 'yry', '6545654567', 'hgh@f', 0, '2019-11-27 16:27:12', '2019-11-27 16:27:12'),
(15, 1, 9, NULL, 'Building Manager', 'asds', '34234', 'dfgdf@gmail.com', 0, '2019-11-27 17:57:02', '2019-11-27 17:57:02'),
(16, 1, 9, NULL, 'Locksmith', 'ss', '32213', 'aaa@gmail.com', 0, '2019-11-27 17:57:03', '2019-11-27 17:57:03'),
(17, 1, NULL, 43, 'Insurance', 'insurance', '213213222', 'amitpunjvision@gmail.com', 0, '2019-11-27 19:00:28', '2019-11-27 19:00:28'),
(18, 1, 9, NULL, 'Locksmith', 'sds', '5445', '4gg@g', 0, '2019-11-27 19:08:55', '2019-11-27 19:08:55'),
(19, 10, NULL, 44, 'Locksmith', 'AWES', '9812323456', 'jyotivisionvivante@gmail.com', 0, '2019-11-28 10:45:37', '2019-11-28 10:45:37'),
(20, 10, NULL, 50, 'Plumber', 'qwerty', '7654456767', 'a@yopmail.com', 0, '2019-12-04 12:49:00', '2019-12-04 12:49:00'),
(21, 27, 10, NULL, 'Locksmith', 'ABC', '6543654', 'ABC@gmail.com', 0, '2019-12-04 13:37:07', '2019-12-04 13:37:07'),
(22, 27, NULL, 53, 'Electrician', 'Elect', '567566', 'jj@fgd.com', 0, '2019-12-04 13:47:51', '2019-12-04 13:47:51'),
(23, 10, 11, NULL, 'Plumber', 'SS', '2322323333', 'jyotivisionvivante@gmail.com', 1, '2019-12-10 13:10:56', '2019-12-10 13:15:44'),
(24, 10, 13, NULL, 'Electrician', 'Hi', '9800087909', 'jyotivisionvivante@gmail.com', 1, '2019-12-10 13:23:00', '2019-12-10 13:38:37'),
(25, 10, NULL, 62, 'Plumber', 'qwerty', '9514452585', 'jyotivisionvivante@gmail.com', 0, '2019-12-12 10:28:01', '2019-12-12 10:28:01'),
(26, 10, NULL, 64, 'Locksmith', 'ed', '3331232345', 'jyotivisionvivante@gmail.com', 0, '2019-12-12 16:34:01', '2019-12-12 16:34:01'),
(27, 27, NULL, 65, 'Locksmith', 'amit', '9812304545', 'abc@yopmail.com', 0, '2019-12-13 11:43:09', '2019-12-13 11:43:09'),
(28, 10, NULL, 67, 'Locksmith', 'test', '7867787890', 'jyotivisionvivante@gmail.com', 0, '2019-12-16 16:16:43', '2019-12-16 16:16:43'),
(29, 27, NULL, 71, 'Electrician', 'jj', '5656', 'fg@xfg.n', 0, '2019-12-17 16:52:14', '2019-12-17 16:52:14'),
(30, 10, NULL, 72, 'Locksmith', 'qwerty', '2222111111', 'h@h.jjj', 1, '2019-12-17 17:17:51', '2019-12-18 10:36:42'),
(31, 10, NULL, 75, 'Locksmith', 'qwerty', '9812234345', 'jyotivisionvivante@gmail.com', 0, '2019-12-18 10:46:53', '2019-12-18 10:46:53'),
(32, 10, 14, NULL, 'Locksmith', 'Jyoti', '9812232345', 'jyotivisionvivante@gmail.com', 1, '2019-12-18 11:44:05', '2019-12-18 11:51:00'),
(33, 10, 16, NULL, 'Locksmith', 'qwerty', '9014423454', 'jyotivisionvivante@gmail.com', 0, '2019-12-18 12:32:48', '2019-12-18 12:32:48'),
(34, 10, NULL, 80, 'Locksmith', 'qqqq', '4321123434', 'jyotivisionvivante@gmail.com', 0, '2019-12-18 13:21:49', '2019-12-18 13:21:49'),
(35, 10, 17, NULL, 'Locksmith', 'AA', '4312234567', 'jyotivisionvivante@gmail.com', 0, '2019-12-18 18:32:31', '2019-12-18 18:32:31'),
(36, 10, NULL, 84, 'Electrician', 'test', '8512201203', 'w@gmail.com', 0, '2019-12-19 18:05:04', '2019-12-19 18:05:04'),
(37, 10, NULL, 86, 'Electrician', 'aas', '3434', 'sdf@dsg.bbb', 0, '2019-12-20 16:19:55', '2019-12-20 16:19:55'),
(38, 10, NULL, 87, 'Locksmith', '34', '34', 'sw@dfsg.n', 0, '2019-12-20 16:21:31', '2019-12-20 16:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `property_visits`
--

CREATE TABLE `property_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `property_unit_id` int(11) DEFAULT NULL,
  `property_visit_organizer_id` int(11) DEFAULT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `phone_number` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `given_by` int(11) DEFAULT NULL,
  `given_to` int(11) DEFAULT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `contract_id`, `unit_id`, `tenant_id`, `po_id`, `given_by`, `given_to`, `rating`, `created_at`, `updated_at`) VALUES
(1, 53, 52, NULL, NULL, 10, 9, 3, '2019-12-04 14:04:44', '2019-12-04 14:04:44'),
(2, 53, 52, NULL, NULL, 9, 10, 5, '2019-12-04 14:05:34', '2019-12-04 14:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `refund_amount` int(11) DEFAULT NULL,
  `method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refundID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `refunds`
--

INSERT INTO `refunds` (`id`, `contract_id`, `unit_id`, `tenant_id`, `po_id`, `refund_amount`, `method`, `refundID`, `time`, `status`, `related_to`, `created_at`, `updated_at`) VALUES
(1, 2, 3, NULL, 10, 150, 'stripe', 're_1FhASIET9w4zgxTQcB3V90ls', '2019/11/21 13:11:59', 'done', 'PropertyReject', '2019-11-21 13:21:59', '2019-11-21 13:21:59'),
(2, 3, 7, NULL, 10, 150, 'stripe', 're_1FhAVwET9w4zgxTQSMk4YKFI', '2019/11/21 13:11:45', 'done', 'PropertyReject', '2019-11-21 13:25:45', '2019-11-21 13:25:45'),
(3, 4, 6, NULL, 10, 15, 'stripe', 're_1FhBjWET9w4zgxTQwJP549cN', '2019/11/21 14:11:51', 'done', 'PropertyReject', '2019-11-21 14:43:51', '2019-11-21 14:43:51'),
(4, 26, 5, NULL, 10, 15, 'stripe', 're_1Fj1LWET9w4zgxTQoJnzjtdx', '2019/11/26 16:11:39', 'done', 'PropertyReject', '2019-11-26 16:02:39', '2019-11-26 16:02:39'),
(5, 30, 35, NULL, 10, 1500, 'stripe', 're_1FjNh0ET9w4zgxTQRgn82Ys1', '2019/11/27 15:11:18', 'done', 'PropertyReject', '2019-11-27 15:54:18', '2019-11-27 15:54:18'),
(6, 32, 37, NULL, 10, 8, 'paypal', '12S98329SG474302T', '2019/11/27 16:11:21', 'done', 'PropertyReject', '2019-11-27 16:21:21', '2019-11-27 16:21:21'),
(7, 34, 39, NULL, 10, 15, 'stripe', 're_1FjORCET9w4zgxTQ0wZqj3J4', '2019/11/27 16:11:03', 'done', 'PropertyReject', '2019-11-27 16:42:03', '2019-11-27 16:42:03'),
(8, 35, 38, NULL, 10, 13, 'paypal', '0VV237166E4278836', '2019/11/27 17:11:46', 'done', 'PropertyReject', '2019-11-27 17:00:46', '2019-11-27 17:00:46'),
(9, 37, 40, NULL, 10, 2, 'paypal', '3RC8065403807300M', '2019/11/27 17:11:29', 'done', 'PropertyReject', '2019-11-27 17:25:29', '2019-11-27 17:25:29'),
(10, 44, 45, NULL, 10, 15000, 'stripe', 're_1Fjfj5ET9w4zgxTQKQQJMyCv', '2019/11/28 11:11:40', 'done', 'PropertyReject', '2019-11-28 11:09:40', '2019-11-28 11:09:40'),
(11, 48, 47, NULL, 10, 1, 'paypal', '02193515636344137', '2019/11/28 11:11:26', 'done', 'PropertyReject', '2019-11-28 11:32:26', '2019-11-28 11:32:26'),
(12, 32, 11, NULL, 10, 15, 'stripe', 're_1FyHVGET9w4zgxTQlkjrg4O7', '2020/01/07 18:01:46', 'done', 'PropertyReject', '2020-01-07 18:19:46', '2020-01-07 18:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `sub_tenants`
--

CREATE TABLE `sub_tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `isDeleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_tenants`
--

INSERT INTO `sub_tenants` (`id`, `unit_id`, `booking_id`, `tenant_id`, `pde_id`, `pm_id`, `po_id`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 54, 1, 42, NULL, NULL, NULL, 0, '2019-12-11 12:03:20', '2019-12-11 12:03:20'),
(2, 60, 2, 43, NULL, NULL, NULL, 0, '2019-12-11 12:46:57', '2019-12-11 12:46:57'),
(3, 60, 2, 44, NULL, NULL, NULL, 0, '2019-12-12 11:24:23', '2019-12-12 11:24:23'),
(4, 60, 2, 19, NULL, NULL, NULL, 0, '2019-12-12 11:36:54', '2019-12-12 11:36:54'),
(5, 60, 2, 4, NULL, NULL, NULL, 0, '2019-12-12 11:42:12', '2019-12-12 11:42:12'),
(6, 60, 2, 15, NULL, NULL, NULL, 0, '2019-12-12 11:43:14', '2019-12-12 11:43:14'),
(7, 60, 2, 9, NULL, NULL, NULL, 0, '2019-12-12 12:05:37', '2019-12-12 12:05:37'),
(8, 64, 5, 29, NULL, NULL, NULL, 0, '2019-12-12 16:47:05', '2019-12-12 16:47:05'),
(9, 64, 5, 46, NULL, NULL, NULL, 0, '2019-12-12 16:52:47', '2019-12-12 16:52:47'),
(13, 51, 11, 3, NULL, NULL, NULL, 0, '2019-12-16 16:04:30', '2019-12-16 16:04:30'),
(14, 51, 11, 37, NULL, NULL, NULL, 0, '2019-12-16 16:04:30', '2019-12-16 16:04:30'),
(15, 67, 12, 40, NULL, NULL, NULL, 0, '2019-12-16 16:28:02', '2019-12-16 16:28:02'),
(16, 67, 12, 41, NULL, NULL, NULL, 0, '2019-12-16 16:28:03', '2019-12-16 16:28:03'),
(17, 68, 13, 40, NULL, NULL, NULL, 0, '2019-12-16 17:12:25', '2019-12-16 17:12:25'),
(18, 68, 13, 41, NULL, NULL, NULL, 0, '2019-12-16 17:12:25', '2019-12-16 17:12:25'),
(19, 51, 11, 3, NULL, NULL, NULL, 0, '2019-12-16 17:16:05', '2019-12-16 17:16:05'),
(20, 51, 11, 37, NULL, NULL, NULL, 0, '2019-12-16 17:16:06', '2019-12-16 17:16:06'),
(21, 51, 11, 59, NULL, NULL, NULL, 0, '2019-12-16 17:16:06', '2019-12-16 17:16:06'),
(22, 47, 14, 40, NULL, NULL, NULL, 0, '2019-12-16 17:21:17', '2019-12-16 17:21:17'),
(23, 47, 14, 41, NULL, NULL, NULL, 0, '2019-12-16 17:21:17', '2019-12-16 17:21:17'),
(24, 47, 14, 61, NULL, NULL, NULL, 0, '2019-12-16 17:21:17', '2019-12-16 17:21:17'),
(25, 69, 15, 40, NULL, NULL, NULL, 0, '2019-12-16 19:15:00', '2019-12-16 19:15:00'),
(26, 69, 15, 41, NULL, NULL, NULL, 0, '2019-12-16 19:15:00', '2019-12-16 19:15:00'),
(27, 71, 16, 3, NULL, NULL, NULL, 0, '2019-12-17 16:53:17', '2019-12-17 16:53:17'),
(28, 72, 17, 40, NULL, NULL, NULL, 0, '2019-12-17 17:21:01', '2019-12-17 17:21:01'),
(29, 72, 17, 41, NULL, NULL, NULL, 0, '2019-12-17 17:21:01', '2019-12-17 17:21:01'),
(30, 72, 17, 62, NULL, NULL, NULL, 0, '2019-12-17 17:21:01', '2019-12-17 17:21:01'),
(31, 72, 17, 40, NULL, NULL, NULL, 0, '2019-12-17 17:21:06', '2019-12-17 17:21:06'),
(32, 72, 17, 41, NULL, NULL, NULL, 0, '2019-12-17 17:21:06', '2019-12-17 17:21:06'),
(33, 72, 17, 62, NULL, NULL, NULL, 0, '2019-12-17 17:21:06', '2019-12-17 17:21:06'),
(34, 73, 18, 40, NULL, NULL, NULL, 0, '2019-12-17 17:41:50', '2019-12-17 17:41:50'),
(35, 70, 22, 3, NULL, NULL, NULL, 0, '2019-12-18 11:47:09', '2019-12-18 11:47:09'),
(36, 84, 28, 40, NULL, NULL, NULL, 0, '2019-12-19 18:28:51', '2019-12-19 18:28:51'),
(37, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 13:38:53', '2020-01-10 13:38:53'),
(38, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 13:48:36', '2020-01-10 13:48:36'),
(39, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 14:09:49', '2020-01-10 14:09:49'),
(40, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 14:10:01', '2020-01-10 14:10:01'),
(41, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 14:10:46', '2020-01-10 14:10:46'),
(42, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 14:41:24', '2020-01-10 14:41:24'),
(43, 89, 36, 66, NULL, NULL, NULL, 0, '2020-01-10 14:42:02', '2020-01-10 14:42:02');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `task_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenant_invitations`
--

CREATE TABLE `tenant_invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` bigint(20) DEFAULT NULL,
  `booking_id` bigint(20) DEFAULT NULL,
  `tenant_id` bigint(20) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `send_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Yes','No') COLLATE utf8mb4_unicode_ci DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenant_invitations`
--

INSERT INTO `tenant_invitations` (`id`, `unit_id`, `booking_id`, `tenant_id`, `email`, `send_time`, `status`, `created_at`, `updated_at`) VALUES
(1, 89, 36, 66, 'cotenant1@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:06:10', '2020-01-10 11:06:10'),
(2, 89, 36, 66, 'cotenant2@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:06:17', '2020-01-10 11:06:17'),
(3, 89, 36, 66, 'cotenant3@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:06:23', '2020-01-10 11:06:23'),
(4, 89, 36, 66, 'cotenant1@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:24:56', '2020-01-10 11:24:56'),
(5, 89, 36, 66, 'cotenant1@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:25:30', '2020-01-10 11:25:30'),
(6, 89, 36, 66, 'cotenant2@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:25:37', '2020-01-10 11:25:37'),
(7, 89, 36, 66, 'cotenant3@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:25:42', '2020-01-10 11:25:42'),
(8, 89, 36, 66, 'cotenant1@yopmail.com', '2020/01/10 00:00:00', NULL, '2020-01-10 11:29:28', '2020-01-10 11:29:28'),
(9, 89, 36, 66, 'cotenant1@yopmail.com', '2020/01/10 00:00:00', 'Yes', '2020-01-10 11:52:11', '2020-01-10 13:38:53'),
(10, 89, 36, 66, 'cotenant@yopmail.com', '2020/01/10 02:40:42', 'Yes', '2020-01-10 14:40:42', '2020-01-10 14:41:24'),
(11, 89, 36, 66, 'cotenant12@yopmail.com', '2020/01/10 02:40:47', 'No', '2020-01-10 14:40:47', '2020-01-10 14:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `terminate`
--

CREATE TABLE `terminate` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `step` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `transaction_id` bigint(20) DEFAULT NULL,
  `appointment_id` int(11) DEFAULT NULL,
  `appointment_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notice_period_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `report` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pay_dues` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pending,paid',
  `claim_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `refund_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'pending' COMMENT 'pending,paid',
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = termination request, 1 = book appointment, 2 = appointment done, 3 = pending PDE report, 4 = upload PDE report, 5 = payment pending with bank, 6 = payment paid, 7 = dues clear, 8 = refund claimed, 9 = refund status pending, 10 = refund status paid',
  `StatusForPMPO` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0' COMMENT 'column for asking PM or PO to update the final status of termination request and let unit to show in frontend to another booking, 0 = by default to Wait to update status for PO and PM, 1 = asking to update, 2 = updated',
  `isDeleted` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terminate`
--

INSERT INTO `terminate` (`id`, `step`, `unit_id`, `booking_id`, `tenant_id`, `pde_id`, `pm_id`, `po_id`, `transaction_id`, `appointment_id`, `appointment_time`, `notice`, `notice_period_date`, `report`, `pay_dues`, `payment_method`, `payment_status`, `claim_method`, `refund_status`, `status`, `StatusForPMPO`, `isDeleted`, `created_at`, `updated_at`) VALUES
(1, 5, 51, 52, 9, 13, 11, 10, 52, NULL, NULL, 'BeforeTenancy', NULL, NULL, 'payment', 'paypal', 'paid', 'paypal', 'pending', '8', '1', 0, '2019-12-04 13:13:55', '2019-12-04 13:18:00'),
(2, 5, 52, 53, 9, 13, 11, 10, 56, NULL, NULL, 'BeforeTenancy', NULL, NULL, 'payment', 'Stripe', 'paid', 'paypal', 'paid', '10', '2', 0, '2019-12-04 13:45:21', '2019-12-04 13:53:27'),
(3, 3, 60, 2, 9, 13, 11, 10, NULL, NULL, NULL, 'BeforeTenancy', NULL, NULL, NULL, NULL, NULL, NULL, 'pending', '0', '0', 0, '2019-12-11 17:55:19', '2019-12-11 17:55:19'),
(4, 2, 65, 6, 29, 25, 26, 27, NULL, 37, '2019/12/13 13:35:48', 'Yes', '2020/03/12', NULL, NULL, NULL, NULL, NULL, 'pending', '1', '0', 0, '2019-12-13 13:15:48', '2019-12-13 13:16:35'),
(5, 4, 79, 25, 9, 13, 11, 10, 91, NULL, NULL, 'BeforeTenancy', NULL, NULL, 'payment', 'Stripe', 'paid', NULL, 'pending', '7', '1', 0, '2019-12-20 16:11:00', '2019-12-20 16:13:45'),
(6, 2, 87, 30, 9, 13, 11, 10, NULL, 50, '2019/12/21 17:35:54', 'Yes', '2020/03/19', NULL, NULL, NULL, NULL, NULL, 'pending', '4', '0', 0, '2019-12-20 17:35:54', '2020-01-09 18:16:07');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `department` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `unit_id`, `booking_id`, `tenant_id`, `title`, `description`, `department`, `status`, `created_at`, `updated_at`) VALUES
(1, 30, 23, 9, 'tic1', 'tic1 description', 'gq', 'closed', '2019-11-25 18:53:17', '2019-11-25 18:56:04'),
(2, 30, 23, 9, 'tic2', 'tic2 description', 'electricity', 'closed', '2019-11-25 18:54:04', '2019-11-25 19:09:35'),
(3, 21, 14, 9, 'adswd', 'asdasdf', 'internet', 'closed', '2019-11-25 19:20:56', '2019-11-26 12:15:30'),
(4, 27, 20, 1, 'sdsd', 'ascdas', 'electricity', 'closed', '2019-11-25 19:50:04', '2019-11-25 19:57:58'),
(5, 27, 20, 1, 'xds', 'asdas', 'electricity', 'closed', '2019-11-25 19:51:36', '2019-11-25 19:56:19'),
(6, 27, 20, 1, 'XZScf', 'dascf', 'insurance', 'closed', '2019-11-25 20:07:38', '2019-11-25 20:08:23'),
(7, 25, 15, 1, 'ffffff', 'hhhhhh', 'pm', 'closed', '2019-11-26 17:51:38', '2019-11-26 19:00:43'),
(8, 5, 27, 1, 'fhj', 'gjfj', 'pm', 'closed', '2019-11-26 18:33:30', '2019-11-27 10:27:22'),
(9, 9, 5, 1, 'hvh', 'hfg', 'electricity', 'closed', '2019-11-26 18:41:01', '2019-11-27 11:20:58'),
(10, 23, 25, 1, 'question', 'how many rooms available in ypur units.', 'gq', 'closed', '2019-11-26 19:27:56', '2019-11-27 10:58:42'),
(11, 5, 27, 9, 'test ticket', 'lorem ipsum is the dummy text.', 'gq', 'closed', '2019-11-27 11:20:28', '2019-11-28 10:14:11'),
(12, 42, 40, 9, 'fd', 'gdfsg', 'electricity', 'pending', '2019-11-27 17:41:38', '2019-11-27 17:41:38'),
(13, 40, 37, 1, 'sd', 'dscfs', 'gq', 'pending', '2019-11-27 18:38:45', '2019-11-27 18:38:45'),
(14, 38, 35, 9, 'sdfsd', 'cfff', 'electricity', 'closed', '2019-11-27 18:56:23', '2019-11-27 19:00:07'),
(15, 38, 35, 9, 'gf', 'vgfd', 'insurance', 'pending', '2019-11-27 19:00:18', '2019-11-27 19:00:18'),
(16, 44, 41, 9, 'xvvb', 'https://prnt.sc/q34zgc', 'keys', 'closed', '2019-11-28 10:49:04', '2019-11-28 10:49:32'),
(17, 7, 3, 4, 'df', 'dgfs', 'electricity', 'pending', '2019-11-30 17:15:54', '2019-11-30 17:15:54'),
(18, 53, 55, 29, 'hn', 'bvnc', 'gq', 'pending', '2019-12-06 19:23:11', '2019-12-06 19:23:11'),
(19, 54, 58, 38, 'sd', 'dsffdsf', 'gq', 'pending', '2019-12-11 11:00:34', '2019-12-11 11:00:34'),
(20, 47, 48, 9, 'sd', 'sd', 'internet', 'pending', '2019-12-11 11:41:28', '2019-12-11 11:41:28'),
(21, 60, 2, 9, 'test', 'dsfgdg', 'electricity', 'closed', '2019-12-11 16:29:54', '2019-12-11 17:54:03'),
(22, 60, 2, 43, 'yuuy', 'yuuuuuuuuuu', 'electricity', 'pending', '2019-12-11 17:38:02', '2019-12-11 17:38:02'),
(23, 60, 2, 9, 'testing', 'fgdfgd', 'gq', 'pending', '2019-12-11 17:38:44', '2019-12-11 17:38:44'),
(24, 67, 12, 9, 'qqqq', 'lorem', 'keys', 'pending', '2019-12-16 17:09:25', '2019-12-16 17:09:25'),
(25, 82, 26, 9, 'fdf', 'xz', 'other', 'closed', '2019-12-19 11:11:55', '2019-12-19 11:13:16'),
(26, 79, 25, 9, 'TEST TITLE', 'LOREM IPSUM', 'electricity', 'closed', '2019-12-19 11:37:34', '2019-12-19 16:56:04'),
(27, 82, 26, 9, 'first repair', 'first repair getting issue in plumbing', 'plumbing', 'pending', '2019-12-19 12:22:19', '2019-12-19 12:22:19'),
(28, 82, 26, 9, 'DSFG', 'DFFDFFF', 'gq', 'pending', '2019-12-19 17:08:20', '2019-12-19 17:08:20'),
(29, 84, 28, 40, 'Tenant Title', 'Description Test', 'electricity', 'pending', '2019-12-19 18:48:14', '2019-12-19 18:48:14'),
(30, 79, 25, 9, 'tttt', 'desv', 'electricity', 'closed', '2019-12-19 19:01:21', '2019-12-19 19:02:36'),
(31, 73, 18, 9, 'test', 'dsf', 'electricity', 'pending', '2019-12-20 18:20:16', '2019-12-20 18:20:16'),
(32, 71, 16, 29, 'electricity problem', 'desc', 'electricity', 'pending', '2019-12-25 15:07:02', '2019-12-25 15:07:02');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_threads`
--

CREATE TABLE `ticket_threads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `role` smallint(6) DEFAULT NULL,
  `send` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ticket_threads`
--

INSERT INTO `ticket_threads` (`id`, `ticket_id`, `unit_id`, `booking_id`, `tenant_id`, `role`, `send`, `message`, `time`, `created_at`, `updated_at`) VALUES
(1, 27, 82, 26, 9, 2, '10', 'fffff', '2019/12/19 12:12:26', '2019-12-19 12:42:26', '2019-12-19 12:42:26'),
(2, 27, 82, 26, 9, 1, '9', 'dddd', '2019/12/19 12:12:42', '2019-12-19 12:53:42', '2019-12-19 12:53:42'),
(3, 27, 82, 26, 9, 3, '11', 'I am PM', '2019/12/19 12:12:19', '2019-12-19 12:57:19', '2019-12-19 12:57:19'),
(4, 27, 82, 26, 9, 2, '10', 'hmmmm', '2019/12/19 13:12:10', '2019-12-19 13:02:10', '2019-12-19 13:02:10'),
(5, 27, 82, 26, 9, 3, '11', 'r u there?', '2019/12/19 13:12:43', '2019-12-19 13:02:43', '2019-12-19 13:02:43'),
(6, 27, 82, 26, 9, 2, '10', 'No, I am busy ??', '2019/12/19 13:12:16', '2019-12-19 13:15:16', '2019-12-19 13:15:16'),
(7, 27, 82, 26, 9, 0, '1', 'testing by admin', '2019/12/19 16:12:20', '2019-12-19 16:31:20', '2019-12-19 16:31:20'),
(8, 27, 82, 26, 9, 1, '9', NULL, '2019/12/19 16:12:25', '2019-12-19 16:32:25', '2019-12-19 16:32:25'),
(9, 27, 82, 26, 9, 0, '1', 'xfv', '2019/12/19 16:12:44', '2019-12-19 16:48:44', '2019-12-19 16:48:44'),
(10, 27, 82, 26, 9, 1, '9', 'ggg', '2019/12/19 16:12:51', '2019-12-19 16:49:51', '2019-12-19 16:49:51'),
(11, 27, 82, 26, 9, 0, '1', 'nh', '2019/12/19 16:12:29', '2019-12-19 16:53:29', '2019-12-19 16:53:29'),
(12, 26, 79, 25, 9, 0, '1', 'fisrt message', '2019/12/19 16:12:53', '2019-12-19 16:55:53', '2019-12-19 16:55:53'),
(13, 28, 82, 26, 9, 0, '1', 'FFFF', '2019/12/19 17:12:48', '2019-12-19 17:08:48', '2019-12-19 17:08:48'),
(14, 28, 82, 26, 9, 1, '9', 'MESSAGE BY TENANT', '2019/12/19 17:12:18', '2019-12-19 17:09:18', '2019-12-19 17:09:18'),
(15, 29, 84, 28, 40, 2, '10', 'Hi', '2019/12/19 18:12:10', '2019-12-19 18:49:11', '2019-12-19 18:49:11'),
(16, 27, 82, 26, 9, 1, '9', 'ggggg', '2019/12/19 18:12:56', '2019-12-19 18:59:56', '2019-12-19 18:59:56'),
(17, 30, 79, 25, 9, 2, '10', 'first', '2019/12/19 19:12:13', '2019-12-19 19:02:13', '2019-12-19 19:02:13'),
(18, 29, 84, 28, 40, 0, '1', 'jkjkj', '2019/12/19 19:12:04', '2019-12-19 19:05:04', '2019-12-19 19:05:04'),
(19, 29, 84, 28, 40, 1, '40', 'xcbgvcxbcv', '2019/12/20 12:12:16', '2019-12-20 12:25:16', '2019-12-20 12:25:16'),
(20, 29, 84, 28, 40, 1, '40', 'cvnbcvncvncv', '2019/12/20 12:12:22', '2019-12-20 12:25:22', '2019-12-20 12:25:22'),
(21, 29, 84, 28, 40, 1, '40', 'bhcv', '2019/12/20 12:12:52', '2019-12-20 12:26:52', '2019-12-20 12:26:52'),
(22, 31, 73, 18, 9, 1, '9', 'cvvvv', '2019/12/20 18:12:35', '2019-12-20 18:20:35', '2019-12-20 18:20:35'),
(23, 31, 73, 18, 9, 2, '10', 'ddd', '2019/12/20 18:12:19', '2019-12-20 18:21:19', '2019-12-20 18:21:19'),
(24, 31, 73, 18, 9, 0, '1', 'vb', '2019/12/20 18:12:46', '2019-12-20 18:36:46', '2019-12-20 18:36:46');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paypal_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `saleId` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `terminate_id` bigint(20) DEFAULT NULL,
  `paypal_PayerID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_refundID` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `bank_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_customer_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_capture_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `paypal_id`, `saleId`, `booking_id`, `tenant_id`, `terminate_id`, `paypal_PayerID`, `paypal_status`, `related_to`, `description`, `amount`, `payment_by`, `stripe_refundID`, `created_at`, `updated_at`, `bank_receipt`, `receipt_status`, `contract_id`, `stripe_id`, `stripe_customer_id`, `stripe_capture_id`) VALUES
(60, NULL, NULL, 1, NULL, NULL, NULL, NULL, 'rent', NULL, '1232', 'Stripe', NULL, '2019-12-11 12:00:54', '2019-12-11 12:07:16', NULL, NULL, NULL, 'ch_1FoOinET9w4zgxTQBDEr2OGn', NULL, 'ch_1FoOinET9w4zgxTQBDEr2OGn'),
(61, NULL, NULL, 2, NULL, NULL, NULL, NULL, 'rent', NULL, '16', 'Stripe', NULL, '2019-12-11 12:43:03', '2019-12-11 13:42:31', NULL, NULL, NULL, 'ch_1FoPNaET9w4zgxTQgBsvPn1A', NULL, 'ch_1FoPNaET9w4zgxTQgBsvPn1A'),
(62, NULL, NULL, 3, NULL, NULL, NULL, NULL, 'rent', NULL, '70', 'Stripe', NULL, '2019-12-12 10:29:14', '2019-12-12 10:30:04', NULL, NULL, NULL, 'ch_1FojleET9w4zgxTQ6gW8lqNf', NULL, 'ch_1FojleET9w4zgxTQ6gW8lqNf'),
(63, NULL, NULL, 4, NULL, NULL, NULL, NULL, 'Rent', NULL, '9', 'Bank Transfer', NULL, '2019-12-12 10:35:57', '2019-12-12 10:35:57', NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, 5, NULL, NULL, NULL, NULL, 'Rent', NULL, '15', 'Bank Transfer', NULL, '2019-12-13 11:35:11', '2019-12-13 11:35:11', NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, 6, NULL, NULL, NULL, NULL, 'rent', NULL, '890', 'Stripe', NULL, '2019-12-13 11:44:53', '2019-12-13 11:45:38', NULL, NULL, NULL, 'ch_1Fp7QOET9w4zgxTQcBwzTeVT', NULL, 'ch_1Fp7QOET9w4zgxTQcBwzTeVT'),
(66, NULL, NULL, 7, NULL, NULL, NULL, NULL, 'rent', NULL, '65', 'Stripe', NULL, '2019-12-13 13:00:22', '2019-12-13 13:00:22', NULL, NULL, NULL, 'ch_1Fp8bSET9w4zgxTQbmK4v8Vf', NULL, NULL),
(67, NULL, NULL, 8, NULL, NULL, NULL, NULL, 'rent', NULL, '2800', 'Stripe', NULL, '2019-12-13 13:02:25', '2019-12-13 13:12:39', NULL, NULL, NULL, 'ch_1Fp8dRET9w4zgxTQKOmfT0IF', NULL, 'ch_1Fp8dRET9w4zgxTQKOmfT0IF'),
(71, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'membership', NULL, '55', 'Stripe', NULL, '2019-12-16 16:11:34', '2019-12-16 16:11:34', NULL, NULL, NULL, 'ch_1FqH17ET9w4zgxTQ91lCuZwl', NULL, NULL),
(72, NULL, NULL, NULL, 10, NULL, NULL, NULL, 'membership', NULL, '55', 'Stripe', NULL, '2019-12-16 16:20:50', '2019-12-16 16:20:50', NULL, NULL, NULL, 'ch_1FqHA5ET9w4zgxTQPDE1Y6yr', NULL, NULL),
(73, NULL, NULL, 12, NULL, NULL, NULL, NULL, 'rent', NULL, '1500', 'Stripe', NULL, '2019-12-16 16:28:41', '2019-12-16 16:50:03', NULL, NULL, NULL, 'ch_1FqHHgET9w4zgxTQZ7MxDqki', NULL, 'ch_1FqHHgET9w4zgxTQZ7MxDqki'),
(74, 'PAYID-LX3W3YY73268840UR3719608', '85T93186B7112213E', 13, NULL, NULL, 'MKU6WJBYDC2QA', 'paid', 'rent', NULL, '1500', 'Paypal', NULL, '2019-12-16 17:15:41', '2019-12-16 17:15:41', NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, NULL, 14, NULL, NULL, NULL, NULL, 'rent', NULL, '11111', 'Stripe', NULL, '2019-12-16 17:21:45', '2019-12-16 17:24:22', NULL, NULL, NULL, 'ch_1FqI73ET9w4zgxTQrCG7F6Ct', NULL, 'ch_1FqI73ET9w4zgxTQrCG7F6Ct'),
(76, 'PAYID-LX3YVEQ0NY533079L742842W', '96776658DK247024K', 15, NULL, NULL, 'MKU6WJBYDC2QA', 'paid', 'rent', NULL, '15', 'Paypal', NULL, '2019-12-16 19:16:54', '2019-12-16 19:16:54', NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, NULL, 8, 29, NULL, NULL, NULL, 'meter bill', NULL, '0', 'wallet', NULL, '2019-12-17 14:00:04', '2019-12-17 14:00:04', NULL, NULL, 8, NULL, NULL, NULL),
(78, NULL, NULL, 16, NULL, NULL, NULL, NULL, 'rent', NULL, '2750', 'Stripe', NULL, '2019-12-17 16:54:50', '2019-12-17 16:55:43', NULL, NULL, NULL, 'ch_1FqeAXET9w4zgxTQKigrTmP2', NULL, 'ch_1FqeAXET9w4zgxTQKigrTmP2'),
(79, 'PAYID-LX4MEEA2462393213291392G', '2UH734823N403774S', 17, NULL, NULL, 'MKU6WJBYDC2QA', 'paid', 'rent', NULL, '65', 'Paypal', NULL, '2019-12-17 17:26:11', '2019-12-17 17:26:11', NULL, NULL, NULL, NULL, NULL, NULL),
(80, NULL, NULL, 18, NULL, NULL, NULL, NULL, 'rent', NULL, '65', 'Stripe', NULL, '2019-12-17 17:42:44', '2019-12-17 17:43:47', NULL, NULL, NULL, 'ch_1FqeuuET9w4zgxTQy4rHRvZ0', NULL, 'ch_1FqeuuET9w4zgxTQy4rHRvZ0'),
(81, NULL, NULL, 19, NULL, NULL, NULL, NULL, 'rent', NULL, '15', 'Stripe', NULL, '2019-12-17 18:39:47', '2019-12-17 18:40:24', NULL, NULL, NULL, 'ch_1Fqfo7ET9w4zgxTQbBqRvpmw', NULL, 'ch_1Fqfo7ET9w4zgxTQbBqRvpmw'),
(82, NULL, NULL, 20, NULL, NULL, NULL, NULL, 'rent', NULL, '15', 'Stripe', NULL, '2019-12-18 10:49:50', '2019-12-18 11:30:45', NULL, NULL, NULL, 'ch_1FquwsET9w4zgxTQpm7SiVf3', NULL, 'ch_1FquwsET9w4zgxTQpm7SiVf3'),
(83, NULL, NULL, 21, NULL, NULL, NULL, NULL, 'rent', NULL, '79', 'Stripe', NULL, '2019-12-18 11:39:51', '2019-12-18 11:39:51', NULL, NULL, NULL, 'ch_1FqvjFET9w4zgxTQUl6loSO5', NULL, NULL),
(84, NULL, NULL, 23, NULL, NULL, NULL, NULL, 'rent', NULL, '147', 'Stripe', NULL, '2019-12-18 11:50:25', '2019-12-18 11:50:25', NULL, NULL, NULL, 'ch_1FqvtVET9w4zgxTQBkrpnPI6', NULL, NULL),
(85, NULL, NULL, 24, NULL, NULL, NULL, NULL, 'rent', NULL, '61', 'Stripe', NULL, '2019-12-18 12:05:30', '2019-12-18 12:17:25', NULL, NULL, NULL, 'ch_1Fqw86ET9w4zgxTQzfzmZaqE', NULL, 'ch_1Fqw86ET9w4zgxTQzfzmZaqE'),
(86, NULL, NULL, 25, NULL, NULL, NULL, NULL, 'Rent', NULL, '16', 'Bank Transfer', NULL, '2019-12-18 12:42:40', '2019-12-18 12:42:40', NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, 22, NULL, NULL, NULL, NULL, 'rent', NULL, '15', 'Stripe', NULL, '2019-12-18 12:54:05', '2019-12-18 12:54:05', NULL, NULL, NULL, 'ch_1Fqwt6ET9w4zgxTQrVTFrY9f', NULL, NULL),
(88, NULL, NULL, 22, NULL, NULL, NULL, NULL, 'rent', NULL, '15', 'Stripe', NULL, '2019-12-18 12:55:18', '2019-12-18 12:55:18', NULL, NULL, NULL, 'ch_1FqwuHET9w4zgxTQFmLhwS8r', NULL, NULL),
(89, NULL, NULL, 26, NULL, NULL, NULL, NULL, 'rent', NULL, '29', 'Stripe', NULL, '2019-12-18 19:08:30', '2019-12-18 19:08:30', NULL, NULL, NULL, 'ch_1Fr2jRET9w4zgxTQ1xNs6W2O', NULL, NULL),
(90, NULL, NULL, 28, NULL, NULL, NULL, NULL, 'rent', NULL, '11', 'Stripe', NULL, '2019-12-19 18:30:06', '2019-12-19 18:31:42', NULL, NULL, NULL, 'ch_1FrObqET9w4zgxTQ5U8TocAK', NULL, 'ch_1FrObqET9w4zgxTQ5U8TocAK'),
(91, NULL, NULL, 25, NULL, 5, NULL, NULL, 'PayDues', NULL, '6', 'Stripe', NULL, '2019-12-20 16:13:45', '2019-12-20 16:13:45', NULL, NULL, NULL, 'ch_1FrixRET9w4zgxTQj7bn44aj', NULL, NULL),
(92, NULL, NULL, 29, NULL, NULL, NULL, NULL, 'rent', NULL, '1400', 'Stripe', NULL, '2019-12-20 16:22:53', '2019-12-20 16:30:25', NULL, NULL, NULL, 'ch_1Frj6GET9w4zgxTQmmC5Oa4C', NULL, 'ch_1Frj6GET9w4zgxTQmmC5Oa4C'),
(93, NULL, NULL, 30, NULL, NULL, NULL, NULL, 'rent', NULL, '1400', 'Stripe', NULL, '2019-12-20 16:29:17', '2019-12-20 16:30:07', NULL, NULL, NULL, 'ch_1FrjCTET9w4zgxTQqeyENzqr', NULL, 'ch_1FrjCTET9w4zgxTQqeyENzqr'),
(94, NULL, NULL, 18, 9, NULL, NULL, NULL, 'rent', NULL, '11', 'wallet', NULL, '2020-01-04 00:00:02', '2020-01-04 00:00:02', NULL, NULL, 18, NULL, NULL, NULL),
(95, NULL, NULL, 31, NULL, NULL, NULL, NULL, 'rent', NULL, '1500', 'Stripe', NULL, '2020-01-07 17:42:14', '2020-01-07 18:16:09', NULL, NULL, NULL, 'ch_1FyGuvET9w4zgxTQVeSq5PWp', NULL, 'ch_1FyGuvET9w4zgxTQVeSq5PWp'),
(96, NULL, NULL, 32, NULL, NULL, NULL, NULL, 'rent', NULL, '15', 'Stripe', 're_1FyHVGET9w4zgxTQlkjrg4O7', '2020-01-07 18:19:26', '2020-01-07 18:19:46', NULL, NULL, NULL, 'ch_1FyHUuET9w4zgxTQTywFltnv', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units_rent`
--

CREATE TABLE `units_rent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `electric_bill` int(11) DEFAULT NULL,
  `water_bill` int(11) DEFAULT NULL,
  `gas_bill` int(11) DEFAULT NULL,
  `rent` int(11) DEFAULT NULL,
  `total_amount` bigint(20) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Rent for Month',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_balance` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rent_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pending,paid,processing,hold'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units_rent`
--

INSERT INTO `units_rent` (`id`, `electric_bill`, `water_bill`, `gas_bill`, `rent`, `total_amount`, `user_id`, `contract_id`, `unit_id`, `date`, `payment_method`, `payment_status`, `wallet_balance`, `created_at`, `updated_at`, `rent_status`) VALUES
(1, NULL, NULL, NULL, 11, 11, 9, 18, 73, '2020/01/04', NULL, NULL, NULL, '2020-01-04 00:00:08', '2020-01-04 00:00:08', 'paid'),
(2, NULL, NULL, NULL, 100, 100, 29, 6, 65, '2020/01/05', NULL, NULL, NULL, '2020-01-05 00:00:01', '2020-01-05 00:00:01', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `unit_booking`
--

CREATE TABLE `unit_booking` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `guarantor_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `terminate_id` int(11) DEFAULT NULL,
  `lad_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `contract_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dues` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `damage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = draft,1= pending payment, 2= payment done, 3 = accept, 4 = reject by pm, 5 = expert done, 6 = complete, 7 = cancel by tenant',
  `tenant_pay_slip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `choose_guarantor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `receipt_upload_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `step` int(11) NOT NULL DEFAULT '0',
  `tenant_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_id_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_esignature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pending,paid',
  `contract_communication_language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_provision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sendMail_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =  already in draft, 1 =  passed booking,',
  `bank_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_booked` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_booking`
--

INSERT INTO `unit_booking` (`id`, `unit_id`, `contract_id`, `tenant_id`, `guarantor_id`, `pde_id`, `vo_id`, `pm_id`, `po_id`, `terminate_id`, `lad_id`, `transaction_id`, `contract_type`, `start_date`, `end_date`, `total_amount`, `dues`, `damage`, `payment_method`, `status`, `tenant_pay_slip`, `remark`, `guarantor`, `choose_guarantor`, `receipt_upload_time`, `created_at`, `updated_at`, `step`, `tenant_photo`, `tenant_photo_id_proof`, `tenant_photo_esignature`, `payment_status`, `contract_communication_language`, `signature_date`, `rent`, `cost_provision`, `fixed_charges`, `property_tax`, `deposit_amount`, `contract_time`, `sendMail_time`, `current_status`, `bank_receipt`, `receipt_status`, `appointment_booked`) VALUES
(1, 54, NULL, 9, 49, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/30', '2020/12/31', '1232', '0', '0', 'stripe', '3', 'pay_slip1576045809.png', NULL, 'yes', 'yes', NULL, '2019-12-11 12:00:10', '2019-12-11 12:07:16', 5, 'photo1576045809.png', 'photo_id_proof1576045809.png', 'photo_esignature1576045833.png', 'paid', NULL, NULL, '1', '2', '3', '4', '1222', NULL, '2019/12/11 12:12:14', 0, NULL, NULL, 0),
(2, 60, NULL, 9, 50, 13, 12, 11, 10, 3, NULL, NULL, 'Commercial', '2019/12/30', '2020/1/31', '16', '0', '0', 'stripe', '6', 'pay_slip1576048342.png', NULL, 'yes', 'yes', NULL, '2019-12-11 12:42:22', '2019-12-16 19:39:51', 5, 'photo1576048342.png', 'photo_id_proof1576048342.png', 'photo_esignature1576048369.png', 'paid', NULL, NULL, '2', '3', '4', '4', '3', NULL, '2019/12/12 14:12:09', 0, NULL, NULL, 1),
(3, 62, NULL, 9, 51, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/12', '2019/12/22', '70', '0', '0', 'stripe', '3', 'pay_slip1576126715.png', NULL, 'yes', 'yes', NULL, '2019-12-12 10:28:35', '2019-12-12 10:30:05', 5, 'photo1576126715.png', 'photo_id_proof1576126715.png', 'photo_esignature1576126737.png', 'paid', NULL, NULL, '12', '13', '14', '15', '16', NULL, '2019/12/12 10:12:03', 0, NULL, NULL, 0),
(4, 63, NULL, 9, 52, 13, 12, 11, 10, NULL, NULL, 63, 'Commercial', '2019/12/31', '2020/1/15', '9', '0', '0', 'bank', '6', 'pay_slip1576127055.png', NULL, 'yes', 'yes', '2019/12/14', '2019-12-12 10:34:16', '2019-12-16 19:34:56', 5, 'photo1576127055.png', 'photo_id_proof1576127055.png', 'photo_esignature1576127111.png', 'paid', NULL, NULL, '1', '2', '3', '2', '1', NULL, '2019/12/10 10:12:05', 0, 'receipt1576127157.png', 'yes', 1),
(5, 64, NULL, 9, 53, 13, 12, 11, 10, NULL, 14, 64, 'Commercial', '2019/12/30', '2020/1/30', '15', '0', '0', 'bank', '0', 'pay_slip1576148678.png', NULL, 'yes', 'yes', '2019/12/14', '2019-12-12 16:34:38', '2019-12-13 11:35:11', 5, 'photo1576148678.png', 'photo_id_proof1576148678.png', 'photo_esignature1576148708.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, 'receipt1576217111.png', 'yes', 0),
(6, 65, NULL, 29, 54, 25, 23, 26, 27, 4, 24, NULL, 'Commercial', '2019/12/05', '2020/4/30', '890', '0', '0', 'stripe', '6', 'pay_slip1576217626.png', NULL, 'yes', 'yes', NULL, '2019-12-13 11:43:47', '2019-12-14 19:58:14', 5, 'photo1576217626.jpeg', 'photo_id_proof1576217626.png', 'photo_esignature1576217676.png', 'paid', NULL, NULL, '100', '200', '50', '40', '500', NULL, '2019/12/11 11:12:55', 0, NULL, NULL, 0),
(7, 52, NULL, 29, 47, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/13', '2019/12/31', '65', '0', '0', 'stripe', '0', 'pay_slip1576219419.png', NULL, 'yes', 'yes', NULL, '2019-12-13 12:13:39', '2019-12-13 13:00:22', 5, 'photo1576219419.png', 'photo_id_proof1576219419.png', 'photo_esignature1576219434.png', 'hold', NULL, NULL, '11', '12', '13', '14', '15', NULL, NULL, 0, NULL, NULL, 0),
(8, 53, NULL, 29, 46, 25, 23, 26, 27, NULL, 24, NULL, 'Commercial', '2019/12/14', '2019/12/31', '2800', '0', '0', 'stripe', '6', 'pay_slip1576222312.jpeg', NULL, 'yes', 'yes', NULL, '2019-12-13 13:01:52', '2019-12-16 18:26:37', 5, 'photo1576222312.png', 'photo_id_proof1576222312.png', 'photo_esignature1576222332.png', 'paid', NULL, NULL, '1000', '300', '200', '100', '1200', NULL, '2019/12/11 13:12:33', 0, NULL, NULL, 0),
(9, 49, NULL, 49, 55, 10, 12, 11, 10, NULL, 14, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, '', NULL, 'yes', 'yes', NULL, '2019-12-16 13:27:58', '2019-12-16 13:28:25', 2, 'photo1576483074.png', 'photo_id_proof1576483074.jpeg', NULL, NULL, NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(11, 51, NULL, 4, NULL, 13, 12, 11, 10, NULL, 14, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 'pay_slip1576496765.png', NULL, 'yes', 'yes', NULL, '2019-12-16 16:04:30', '2019-12-16 17:16:05', 1, 'photo1576496765.png', 'photo_id_proof1576496765.png', NULL, NULL, NULL, NULL, '1', '2', '3', '5', '7', NULL, NULL, 0, NULL, NULL, 0),
(12, 67, NULL, 9, 56, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/16', '2019/12/18', '1500', '0', '0', 'stripe', '3', 'pay_slip1576493882.png', NULL, 'yes', 'yes', NULL, '2019-12-16 16:28:02', '2019-12-16 16:50:03', 5, 'photo1576493882.png', 'photo_id_proof1576493882.png', 'photo_esignature1576493896.png', 'paid', NULL, NULL, '100', '200', '300', '400', '500', NULL, '2019/12/16 16:12:02', 0, NULL, NULL, 0),
(13, 68, NULL, 9, 57, 13, 12, 11, 10, NULL, 14, 74, 'Commercial', '2020/1/1', '2020/1/8', '1500', '0', '0', 'paypal', '0', 'pay_slip1576496545.png', NULL, 'yes', 'yes', NULL, '2019-12-16 17:12:25', '2019-12-16 17:15:41', 5, 'photo1576496545.png', 'photo_id_proof1576496545.png', 'photo_esignature1576496596.png', 'paid', NULL, NULL, '100', '200', '300', '400', '500', NULL, NULL, 0, NULL, NULL, 0),
(14, 47, NULL, 9, 40, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/31', '2020/1/1', '11111', '0', '0', 'stripe', '3', 'pay_slip1576497077.png', NULL, 'yes', 'yes', NULL, '2019-12-16 17:21:17', '2019-12-16 17:25:23', 5, 'photo1576497077.png', 'photo_id_proof1576497077.png', 'photo_esignature1576497094.png', 'paid', NULL, NULL, '1', '10', '100', '1000', '10000', NULL, '2019/12/14 17:12:23', 0, NULL, NULL, 0),
(15, 69, NULL, 9, 58, 13, 12, 11, 10, NULL, 14, 76, 'Commercial', '2020/1/1', '2020/1/15', '15', '0', '0', 'paypal', '6', 'pay_slip1576503900.png', NULL, 'yes', 'yes', NULL, '2019-12-16 19:15:00', '2019-12-16 19:20:25', 5, 'photo1576503900.png', 'photo_id_proof1576503900.png', 'photo_esignature1576503940.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/12/14 19:12:24', 0, NULL, NULL, 0),
(16, 71, NULL, 29, 59, 25, 23, 26, 27, NULL, 24, NULL, 'Commercial', '2019/12/15', '2019/12/31', '2750', '0', '0', 'stripe', '6', 'pay_slip1576581797.png', NULL, 'yes', 'yes', NULL, '2019-12-17 16:53:17', '2019-12-17 17:02:41', 5, 'photo1576581797.png', 'photo_id_proof1576581797.png', 'photo_esignature1576581836.png', 'paid', NULL, NULL, '400', '200', '100', '50', '2000', NULL, '2019/12/17 16:12:42', 0, NULL, NULL, 1),
(17, 72, NULL, 9, 60, 13, 12, 11, 10, NULL, 14, 79, 'Commercial', '2020/1/5', '2020/1/25', '65', '0', '0', 'paypal', '6', 'pay_slip1576583466.png', NULL, 'yes', 'yes', NULL, '2019-12-17 17:21:01', '2019-12-17 17:37:28', 5, 'photo1576583466.png', 'photo_id_proof1576583466.png', 'photo_esignature1576583677.png', 'paid', NULL, NULL, '11', '12', '13', '14', '15', NULL, '2019/12/15 17:12:55', 0, NULL, NULL, 0),
(18, 73, NULL, 9, 61, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/1/4', '2020/1/6', '65', '0', '0', 'stripe', '6', 'pay_slip1576584710.png', NULL, 'yes', 'yes', NULL, '2019-12-17 17:41:50', '2019-12-17 17:51:52', 5, 'photo1576584710.png', 'photo_id_proof1576584710.png', 'photo_esignature1576584751.png', 'paid', NULL, NULL, '11', '12', '13', '14', '15', NULL, '2019/12/15 17:12:35', 0, NULL, NULL, 0),
(19, 74, NULL, 9, 62, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/8', '2020/1/9', '15', '0', '0', 'stripe', '6', 'pay_slip1576585218.jpg', NULL, 'yes', 'yes', NULL, '2019-12-17 17:50:18', '2019-12-17 18:46:20', 5, 'photo1576585218.png', 'photo_id_proof1576585218.png', 'photo_esignature1576587960.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/12/15 18:12:34', 0, NULL, NULL, 0),
(20, 75, NULL, 9, 63, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/8', '2020/1/9', '15', '0', '0', 'stripe', '3', 'pay_slip1576646321.png', NULL, 'yes', 'yes', NULL, '2019-12-18 10:48:33', '2019-12-18 11:30:45', 5, 'photo1576646321.png', 'photo_id_proof1576646321.png', 'photo_esignature1576646376.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/12/18 11:12:44', 0, NULL, NULL, 0),
(21, 76, NULL, 9, 64, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/6', '2020/1/7', '79', '0', '0', 'stripe', '0', 'pay_slip1576649347.png', NULL, 'yes', 'yes', NULL, '2019-12-18 11:39:08', '2019-12-18 11:39:51', 5, 'photo1576649347.png', 'photo_id_proof1576649347.png', 'photo_esignature1576649375.png', 'hold', NULL, NULL, '2', '3', '4', '5', '65', NULL, NULL, 0, NULL, NULL, 0),
(22, 70, NULL, 4, 65, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/19', '2019/12/31', '15', '0', '0', 'stripe', '0', 'pay_slip1576649829.png', NULL, 'yes', 'yes', NULL, '2019-12-18 11:47:09', '2019-12-18 12:55:18', 5, 'photo1576649829.png', 'photo_id_proof1576649829.png', 'photo_esignature1576649931.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(23, 77, NULL, 9, 66, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/6', '2020/1/7', '147', '0', '0', 'stripe', '0', 'pay_slip1576649890.png', NULL, 'yes', 'yes', NULL, '2019-12-18 11:48:10', '2019-12-18 11:50:25', 5, 'photo1576649890.png', 'photo_id_proof1576649890.png', 'photo_esignature1576649923.png', 'hold', NULL, NULL, '1', '2', '34', '54', '56', NULL, NULL, 0, NULL, NULL, 0),
(24, 78, NULL, 9, 67, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/8', '2020/1/9', '61', '0', '0', 'stripe', '6', 'pay_slip1576650856.png', NULL, 'yes', 'yes', NULL, '2019-12-18 12:04:16', '2019-12-18 12:26:47', 5, 'photo1576650856.png', 'photo_id_proof1576650856.png', 'photo_esignature1576650889.png', 'paid', NULL, NULL, '1', '2', '3', '33', '22', NULL, '2019/12/16 12:12:27', 0, NULL, NULL, 1),
(25, 79, NULL, 9, 68, 13, 12, 11, 10, 5, 14, 86, 'Commercial', '2020/1/7', '2020/1/8', '16', '0', '0', 'bank', '6', 'pay_slip1576652964.png', NULL, 'yes', 'yes', '2019/12/20', '2019-12-18 12:39:24', '2020-01-09 11:09:56', 5, 'photo1576652964.png', 'photo_id_proof1576652964.png', 'photo_esignature1576652999.png', 'paid', NULL, NULL, '2', '2', '3', '5', '-2', NULL, '2019/12/16 12:12:55', 0, 'receipt1576653160.png', 'yes', 0),
(26, 82, NULL, 9, 69, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/16', '2020/1/17', '29', '0', '0', 'stripe', '0', 'pay_slip1576676254.png', NULL, 'yes', 'yes', NULL, '2019-12-18 19:07:34', '2019-12-18 19:08:30', 5, 'photo1576676254.png', 'photo_id_proof1576676254.png', 'photo_esignature1576676285.png', 'hold', NULL, NULL, '5', '6', '5', '6', '7', NULL, NULL, 0, NULL, NULL, 0),
(27, 81, NULL, 29, 70, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/18', '2020/12/31', '224', '0', '0', NULL, NULL, 'pay_slip1576678042.png', NULL, 'yes', 'yes', NULL, '2019-12-18 19:37:22', '2019-12-18 19:38:14', 4, 'photo1576678042.jpg', 'photo_id_proof1576678042.png', 'photo_esignature1576678079.png', NULL, NULL, NULL, '11', '22', '33', '44', '114', NULL, NULL, 0, NULL, NULL, 0),
(28, 84, NULL, 9, 71, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/8', '2020/1/9', '11', '0', '0', 'stripe', '6', 'pay_slip1576760331.png', NULL, 'yes', 'yes', NULL, '2019-12-19 18:28:51', '2019-12-19 18:41:55', 5, 'photo1576760331.png', 'photo_id_proof1576760331.png', 'photo_esignature1576760393.png', 'paid', NULL, NULL, '1', '2', '3', '3', '2', NULL, '2019/12/17 18:12:15', 0, NULL, NULL, 0),
(29, 86, NULL, 9, 72, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2019/12/20', '2019/12/31', '1400', '0', '0', 'stripe', '6', 'pay_slip1576839117.png', NULL, 'yes', 'yes', NULL, '2019-12-20 16:21:57', '2019-12-20 17:53:29', 5, 'photo1576839117.jpeg', 'photo_id_proof1576839117.png', 'photo_esignature1576839152.png', 'paid', NULL, NULL, '100', '200', '50', '50', '1000', NULL, '2019/12/20 16:12:24', 0, NULL, NULL, 1),
(30, 87, NULL, 9, 73, 13, 12, 11, 10, 6, 14, NULL, 'Commercial', '2019/12/20', '2019/12/31', '1400', '4', '4', 'stripe', '8', 'pay_slip1576839510.png', NULL, 'yes', 'yes', NULL, '2019-12-20 16:28:30', '2020-01-09 18:16:07', 5, 'photo1576839510.jpeg', 'photo_id_proof1576839510.png', 'photo_esignature1576839538.png', 'paid', NULL, NULL, '200', '100', '50', '50', '1000', NULL, '2019/12/18 17:12:49', 0, NULL, NULL, 0),
(31, 1, NULL, 66, 74, 13, 12, 11, 10, NULL, 6, NULL, 'Commercial', '2020/1/15', '2020/4/30', '1500', '0', '0', 'stripe', '3', '', NULL, 'yes', 'yes', NULL, '2020-01-07 17:40:14', '2020-01-07 18:16:10', 5, 'photo1578399011.jpg', 'photo_id_proof1578399011.jpg', 'photo_esignature1578399063.png', 'paid', NULL, NULL, '200', '200', '200', '300', '600', NULL, '2020/01/07 18:01:08', 0, NULL, NULL, 0),
(32, 11, NULL, 66, 75, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/15', '2020/1/31', '15', '0', '0', 'stripe', '4', 'pay_slip1578401307.jpg', NULL, 'yes', 'yes', NULL, '2020-01-07 18:18:27', '2020-01-07 18:19:46', 5, 'photo1578401307.jpg', 'photo_id_proof1578401307.jpg', 'photo_esignature1578401331.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(33, 50, NULL, 66, 76, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/15', '2020/1/31', '15', '0', '0', 'bank', '10', 'pay_slip1578401531.jpg', NULL, 'yes', 'yes', '2020/01/06', '2020-01-07 18:22:11', '2020-01-07 19:34:07', 5, 'photo1578401531.jpg', 'photo_id_proof1578401531.jpg', 'photo_esignature1578401546.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(34, 46, NULL, 66, 77, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/15', '2020/1/31', '15', '0', '0', 'bank', '10', 'pay_slip1578402062.jpg', NULL, 'yes', 'yes', '2020/01/06', '2020-01-07 18:31:02', '2020-01-07 19:34:08', 5, 'photo1578402062.jpg', 'photo_id_proof1578402062.jpg', 'photo_esignature1578402082.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(35, 88, NULL, 66, 78, 13, 12, 11, 10, NULL, 14, NULL, 'Commercial', '2020/1/8', '2020/1/31', '15', '0', '0', NULL, NULL, 'pay_slip1578462423.jpg', NULL, 'yes', 'yes', NULL, '2020-01-08 11:17:03', '2020-01-08 11:17:30', 4, 'photo1578462423.jpg', 'photo_id_proof1578462423.jpg', 'photo_esignature1578462446.png', NULL, NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(36, 89, NULL, 66, NULL, 13, 12, 11, 10, NULL, 14, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, '', NULL, 'yes', 'yes', NULL, '2020-01-09 20:00:04', '2020-01-10 14:40:42', 1, 'photo1578647442.png', 'photo_id_proof1578647442.png', NULL, NULL, NULL, NULL, '434', '3434', '3434', '34', '4', NULL, NULL, 0, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_booking-1112`
--

CREATE TABLE `unit_booking-1112` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `contract_id` int(11) DEFAULT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `guarantor_id` int(11) DEFAULT NULL,
  `pde_id` int(11) DEFAULT NULL,
  `vo_id` int(11) DEFAULT NULL,
  `pm_id` int(11) DEFAULT NULL,
  `po_id` int(11) DEFAULT NULL,
  `terminate_id` int(11) DEFAULT NULL,
  `lad_id` int(11) DEFAULT NULL,
  `transaction_id` int(11) DEFAULT NULL,
  `contract_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dues` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `damage` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0 = draft,1= pending payment, 2= payment done, 3 = accept, 4 = reject by pm, 5 = expert done, 6 = complete, 7 = cancel by tenant',
  `tenant_pay_slip` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guarantor` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `choose_guarantor` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT 'yes',
  `receipt_upload_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `step` int(11) NOT NULL DEFAULT '0',
  `tenant_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_id_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_esignature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'pending,paid',
  `contract_communication_language` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `signature_date` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rent` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost_provision` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fixed_charges` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `property_tax` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sendMail_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_status` int(11) NOT NULL DEFAULT '0' COMMENT '0 =  already in draft, 1 =  passed booking,',
  `bank_receipt` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receipt_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `appointment_booked` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_booking-1112`
--

INSERT INTO `unit_booking-1112` (`id`, `unit_id`, `contract_id`, `tenant_id`, `guarantor_id`, `pde_id`, `vo_id`, `pm_id`, `po_id`, `terminate_id`, `lad_id`, `transaction_id`, `contract_type`, `start_date`, `end_date`, `total_amount`, `dues`, `damage`, `payment_method`, `status`, `tenant_pay_slip`, `remark`, `guarantor`, `choose_guarantor`, `receipt_upload_time`, `created_at`, `updated_at`, `step`, `tenant_photo`, `tenant_photo_id_proof`, `tenant_photo_esignature`, `payment_status`, `contract_communication_language`, `signature_date`, `rent`, `cost_provision`, `fixed_charges`, `property_tax`, `deposit_amount`, `contract_time`, `sendMail_time`, `current_status`, `bank_receipt`, `receipt_status`, `appointment_booked`) VALUES
(2, 3, NULL, 4, 2, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/19', '2019/11/21', '150', '0', '0', 'stripe', '0', '', NULL, 'yes', 'yes', NULL, '2019-11-19 13:53:39', '2019-11-21 13:21:59', 5, 'photo1574151819.png', 'photo_id_proof1574151819.png', 'photo_esignature1574152381.png', 'refund', NULL, NULL, '10', '20', '30', '40', '50', NULL, '', 0, NULL, NULL, 0),
(3, 7, NULL, 4, 3, 10, 12, 10, 10, NULL, NULL, NULL, 'Commercial', '2019/11/20', '2019/11/29', '150', '0', '0', 'stripe', '0', '', NULL, 'yes', 'yes', NULL, '2019-11-19 18:20:31', '2019-11-21 13:25:45', 5, 'photo1574167831.jpg', 'photo_id_proof1574167831.png', 'photo_esignature1574167843.png', 'refund', NULL, NULL, '10', '20', '30', '40', '50', NULL, '', 0, NULL, NULL, 0),
(4, 6, NULL, 4, 4, 10, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/20', '2019/11/30', '15', '0', '0', 'stripe', '4', 'pay_slip1574168812.jpeg', NULL, 'yes', 'yes', NULL, '2019-11-19 18:36:52', '2019-11-21 14:43:51', 5, 'photo1574168812.png', 'photo_id_proof1574168812.png', 'photo_esignature1574168832.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 0, NULL, NULL, 0),
(5, 9, NULL, 9, 5, 13, 12, 11, 10, NULL, NULL, 8, 'Commercial', '2019/11/20', '2019/11/28', '1500', '0', '0', 'paypal', '3', 'pay_slip1574251881.png', NULL, 'yes', 'yes', NULL, '2019-11-20 17:41:21', '2019-11-21 14:42:09', 5, 'photo1574251881.png', 'photo_id_proof1574251881.png', 'photo_esignature1574251893.png', 'paid', NULL, NULL, '100', '200', '300', '400', '500', NULL, '2019/11/21 14:11:09', 0, NULL, NULL, 0),
(6, 7, NULL, 4, 6, 13, 12, 10, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, 'pay_slip1574319394.png', NULL, 'yes', 'yes', NULL, '2019-11-21 12:26:34', '2019-11-21 12:26:55', 2, 'photo1574319394.png', 'photo_id_proof1574319394.png', NULL, NULL, NULL, NULL, '10', '20', '30', '40', '50', NULL, NULL, 0, NULL, NULL, 0),
(7, 4, NULL, 4, 7, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/6', '2021/12/31', '58', '0', '0', 'stripe', '6', 'pay_slip1574338532.png', 'gf', 'yes', 'yes', NULL, '2019-11-21 17:45:33', '2019-11-25 13:58:20', 5, 'photo1574338532.png', 'photo_id_proof1574338532.png', 'photo_esignature1574338566.png', 'paid', NULL, NULL, '43', '3', '4', '4', '4', NULL, '2019/11/21 17:11:37', 0, NULL, NULL, 0),
(8, 12, NULL, 9, 8, 13, 12, 11, 10, NULL, NULL, 10, 'Commercial', '2019/12/7', '2019/12/11', '7000', '0', '0', 'paypal', '6', 'pay_slip1574416361.jpg', NULL, 'yes', 'yes', NULL, '2019-11-22 15:22:41', '2019-11-27 11:33:19', 5, 'photo1574416361.png', 'photo_id_proof1574416361.png', 'photo_esignature1574416380.png', 'paid', NULL, NULL, '1200', '1300', '1400', '1500', '1600', NULL, '2019/11/22 15:11:19', 0, NULL, NULL, 1),
(9, 11, NULL, 9, 9, 13, 12, 11, 10, NULL, NULL, 11, 'Commercial', '2019/12/7', '2019/12/11', '15', '0', '0', 'paypal', '6', 'pay_slip1574418323.png', NULL, 'yes', 'yes', NULL, '2019-11-22 15:55:23', '2019-11-22 16:06:02', 5, 'photo1574418323.png', 'photo_id_proof1574418323.png', 'photo_esignature1574418371.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/22 16:11:35', 0, NULL, NULL, 1),
(10, 10, NULL, 9, 10, 13, 12, 11, 10, NULL, NULL, 12, 'Commercial', '2019/12/7', '2019/12/31', '15', '0', '0', 'paypal', '4', 'pay_slip1574422529.png', NULL, 'yes', 'yes', NULL, '2019-11-22 17:05:29', '2019-11-27 17:31:45', 5, 'photo1574422529.png', 'photo_id_proof1574422529.png', 'photo_esignature1574423238.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(11, 7, NULL, 9, 11, 13, 12, 10, 10, NULL, NULL, 13, 'Commercial', '2019/12/7', '2019/12/31', '150', '0', '0', 'paypal', '3', 'pay_slip1574423638.png', NULL, 'yes', 'yes', NULL, '2019-11-22 17:23:58', '2019-11-25 11:06:45', 5, 'photo1574423638.png', 'photo_id_proof1574423638.png', 'photo_esignature1574424028.png', 'paid', NULL, NULL, '10', '20', '30', '40', '50', NULL, '2019/11/25 11:11:45', 0, NULL, NULL, 0),
(12, 6, NULL, 16, 12, 10, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/30', '15', '0', '0', 'bank', '4', '', NULL, 'yes', 'yes', '2019/11/27', '2019-11-25 10:29:20', '2019-11-25 11:07:20', 5, 'photo1574657955.png', 'photo_id_proof1574657955.png', 'photo_esignature1574658476.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 0, NULL, NULL, 0),
(13, 23, NULL, 9, 13, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/25', '15', '0', '0', 'bank', '4', 'pay_slip1574659741.png', NULL, 'yes', 'yes', '2019/11/27', '2019-11-25 10:59:01', '2019-11-25 11:07:30', 5, 'photo1574659741.png', 'photo_id_proof1574659741.png', 'photo_esignature1574659758.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 0, NULL, NULL, 0),
(15, 25, NULL, 9, 15, 13, 12, 11, 10, NULL, NULL, 15, 'Commercial', '2019/12/10', '2019/12/30', '15', '0', '0', 'paypal', '3', 'pay_slip1574662809.png', NULL, 'yes', 'yes', NULL, '2019-11-25 11:50:09', '2019-11-25 11:55:13', 5, 'photo1574662809.png', 'photo_id_proof1574662809.png', 'photo_esignature1574662822.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/25 11:11:13', 0, NULL, NULL, 0),
(16, 26, NULL, 9, 16, 13, 12, 11, 10, NULL, NULL, 16, 'Commercial', '2019/12/10', '2019/12/25', '15', '0', '0', 'paypal', '3', 'pay_slip1574665133.png', NULL, 'yes', 'yes', NULL, '2019-11-25 12:28:53', '2019-11-25 12:57:53', 5, 'photo1574665133.png', 'photo_id_proof1574665133.png', 'photo_esignature1574665144.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/23 12:11:53', 0, NULL, NULL, 0),
(17, 16, NULL, 16, 17, 1, 1, 1, 1, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/12', '31', '0', '0', 'bank', '4', 'pay_slip1574667603.jpg', NULL, 'yes', 'yes', '2019/11/27', '2019-11-25 13:10:04', '2019-11-27 10:36:21', 5, 'photo1574667603.jpg', 'photo_id_proof1574667603.jpg', 'photo_esignature1574667677.png', 'pending', NULL, NULL, '23', '2', '2', '2', '2', NULL, '', 0, NULL, NULL, 0),
(18, 22, NULL, 16, 18, 1, 1, 1, 1, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/19', '12837', '0', '0', 'bank', '4', 'pay_slip1574668113.jpg', NULL, 'yes', 'yes', '2019/11/27', '2019-11-25 13:18:33', '2019-11-27 10:36:13', 5, 'photo1574668113.jpg', 'photo_id_proof1574668113.jpg', 'photo_esignature1574668157.png', 'pending', NULL, NULL, '12345', '123', '123', '123', '123', NULL, '', 0, NULL, NULL, 0),
(19, 5, NULL, 16, 19, 10, 10, 10, 10, NULL, NULL, NULL, 'Commercial', '2019/12/25', '2019/12/26', '15', '0', '0', NULL, NULL, 'pay_slip1574668372.jpg', NULL, 'yes', 'yes', NULL, '2019-11-25 13:22:52', '2019-11-25 13:23:59', 4, 'photo1574668372.jpg', 'photo_id_proof1574668372.jpg', 'photo_esignature1574668430.png', NULL, NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(20, 27, NULL, 9, 20, 13, 12, 11, 10, NULL, NULL, 17, 'Commercial', '2019/12/10', '2019/12/11', '7000', '0', '0', 'paypal', '6', 'pay_slip1574676975.jpg', NULL, 'yes', 'yes', NULL, '2019-11-25 15:46:16', '2019-11-25 15:57:21', 5, 'photo1574676975.png', 'photo_id_proof1574676975.png', 'photo_esignature1574676994.png', 'paid', NULL, NULL, '1200', '1300', '1400', '1500', '1600', NULL, '2019/11/25 15:11:47', 0, NULL, NULL, 1),
(21, 28, NULL, 9, 21, 13, 12, 11, 10, NULL, NULL, 18, 'Commercial', '2019/11/25', '2019/11/26', '15', '0', '0', 'paypal', '3', 'pay_slip1574683241.jpg', NULL, 'yes', 'yes', NULL, '2019-11-25 17:30:41', '2019-11-25 17:52:46', 5, 'photo1574683241.png', 'photo_id_proof1574683241.png', 'photo_esignature1574684042.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/25 17:11:46', 0, NULL, NULL, 0),
(22, 29, NULL, 9, 22, 13, 12, 11, 10, NULL, NULL, 19, 'Commercial', '2019/11/25', '2019/11/26', '70', '0', '0', 'paypal', '3', 'pay_slip1574684877.png', NULL, 'yes', 'yes', NULL, '2019-11-25 17:57:57', '2019-11-25 17:59:47', 5, 'photo1574684877.png', 'photo_id_proof1574684877.png', 'photo_esignature1574684893.png', 'paid', NULL, NULL, '12', '13', '14', '15', '16', NULL, '2019/11/25 17:11:47', 0, NULL, NULL, 0),
(23, 30, NULL, 9, 23, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/25', '2019/11/26', '15', '0', '0', 'stripe', '3', 'pay_slip1574687023.png', NULL, 'yes', 'yes', NULL, '2019-11-25 18:33:43', '2019-11-26 14:03:52', 5, 'photo1574687023.png', 'photo_id_proof1574687023.png', 'photo_esignature1574687033.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/26 14:11:51', 0, NULL, NULL, 0),
(24, 8, NULL, 4, 24, 13, 12, 10, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2027/11/17', '150', '0', '0', 'bank', '4', 'pay_slip1574754413.png', NULL, 'yes', 'yes', '2019/11/28', '2019-11-26 13:16:53', '2019-11-27 10:35:55', 5, 'photo1574754413.png', 'photo_id_proof1574754413.jpg', 'photo_esignature1574757944.png', 'pending', NULL, NULL, '10', '20', '30', '40', '50', NULL, '', 0, NULL, NULL, 0),
(25, 23, NULL, 4, 25, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/30', '2019/12/31', '15', '0', '0', 'stripe', '3', 'pay_slip1574758043.jpg', NULL, 'yes', 'yes', NULL, '2019-11-26 14:17:23', '2019-11-26 15:52:15', 5, 'photo1574758043.png', 'photo_id_proof1574758043.png', 'photo_esignature1574758063.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/26 15:11:13', 0, NULL, NULL, 0),
(26, 5, NULL, 4, 26, 10, 10, 10, 10, NULL, NULL, NULL, 'Commercial', '2019/11/30', '2019/12/31', '15', '0', '0', 'stripe', '4', 'pay_slip1574764167.png', NULL, 'yes', 'yes', NULL, '2019-11-26 15:59:27', '2019-11-26 16:02:39', 5, 'photo1574764167.png', 'photo_id_proof1574764167.jpg', 'photo_esignature1574764189.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 0, NULL, NULL, 0),
(27, 5, NULL, 9, 27, 10, 10, 10, 10, NULL, NULL, NULL, 'Commercial', '2019/11/30', '2019/12/28', '15', '0', '0', 'stripe', '3', 'pay_slip1574765860.png', NULL, 'yes', 'yes', NULL, '2019-11-26 16:27:40', '2019-11-26 16:29:04', 5, 'photo1574765860.png', 'photo_id_proof1574765860.png', 'photo_esignature1574765883.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/26 16:11:03', 0, NULL, NULL, 0),
(28, 3, NULL, 20, 28, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2021/11/1', '2022/11/1', '150', '0', '0', NULL, NULL, 'pay_slip1574771529.png', NULL, 'yes', 'yes', NULL, '2019-11-26 18:02:09', '2019-11-26 18:03:04', 4, 'photo1574771529.jpg', 'photo_id_proof1574771529.jpg', 'photo_esignature1574771581.png', NULL, NULL, NULL, '10', '20', '30', '40', '50', NULL, NULL, 0, NULL, NULL, 0),
(29, 6, NULL, 21, 29, 10, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2019/11/27', NULL, '0', '0', NULL, NULL, '', NULL, 'yes', 'yes', NULL, '2019-11-27 10:37:05', '2019-11-27 12:35:46', 3, 'photo1574831221.png', 'photo_id_proof1574831221.png', 'photo_esignature1574838340.png', NULL, NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(30, 35, NULL, 9, 30, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2019/11/28', '1500', '0', '0', 'stripe', '4', 'pay_slip1574850088.png', NULL, 'yes', 'yes', NULL, '2019-11-27 15:51:28', '2019-11-27 15:54:18', 5, 'photo1574850088.png', 'photo_id_proof1574850088.png', 'photo_esignature1574850102.png', 'refund', NULL, NULL, '100', '200', '300', '400', '500', NULL, '', 0, NULL, NULL, 0),
(31, 36, NULL, 9, 31, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'stripe', '3', 'pay_slip1574850776.jpg', NULL, 'yes', 'yes', NULL, '2019-11-27 16:02:56', '2019-11-27 16:05:27', 5, 'photo1574850776.png', 'photo_id_proof1574850776.png', 'photo_esignature1574850792.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/27 16:11:25', 0, NULL, NULL, 0),
(32, 37, NULL, 9, 32, 13, 12, 11, 10, NULL, NULL, 30, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'paypal', '7', 'pay_slip1574851595.png', NULL, 'yes', 'yes', NULL, '2019-11-27 16:16:35', '2019-11-27 16:22:42', 5, 'photo1574851595.png', 'photo_id_proof1574851595.png', 'photo_esignature1574851609.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(33, 38, NULL, 9, 33, 13, 12, 11, 10, NULL, NULL, 33, 'Commercial', '2020/1/1', '2021/1/1', '15', '0', '0', 'paypal', '3', 'pay_slip1574852332.png', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 16:28:52', '2019-11-27 17:21:15', 5, 'photo1574852332.png', 'photo_id_proof1574852332.png', 'photo_esignature1574853969.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/27 17:11:15', 1, 'receipt1574852513.png', 'yes', 0),
(34, 39, NULL, 9, 34, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'stripe', '4', 'pay_slip1574852715.jpg', NULL, 'yes', 'yes', NULL, '2019-11-27 16:35:16', '2019-11-27 16:42:03', 5, 'photo1574852715.png', 'photo_id_proof1574852715.png', 'photo_esignature1574852728.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(35, 38, NULL, 9, 33, 13, 12, 11, 10, NULL, NULL, 33, 'Commercial', '2020/1/1', '2021/1/1', '15', '0', '0', 'paypal', '3', 'pay_slip1574853945.png', NULL, 'yes', 'yes', NULL, '2019-11-27 16:55:45', '2019-11-27 17:00:46', 5, 'photo1574853945.png', 'photo_id_proof1574853945.png', 'photo_esignature1574853969.png', 'refund', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 1, NULL, NULL, 0),
(36, 40, NULL, 9, 35, 13, 10, 11, 10, NULL, NULL, 34, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'bank', '4', 'pay_slip1574855248.jpg', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 17:17:28', '2019-11-27 17:32:34', 5, 'photo1574855248.png', 'photo_id_proof1574855248.png', 'photo_esignature1574855793.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(37, 40, NULL, 9, 35, 13, 10, 11, 10, NULL, NULL, 34, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'bank', '4', 'pay_slip1574855587.png', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 17:23:07', '2019-11-27 17:32:30', 5, 'photo1574855587.png', 'photo_id_proof1574855587.png', 'photo_esignature1574855793.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(38, 40, NULL, 9, 35, 13, 10, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/27', '2019/11/28', '15', '0', '0', 'bank', '4', 'pay_slip1574855784.png', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 17:26:24', '2019-11-27 17:32:26', 5, 'photo1574855784.png', 'photo_id_proof1574855784.png', 'photo_esignature1574855793.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(39, 42, NULL, 9, 36, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'stripe', '0', 'pay_slip1574855922.png', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 17:28:42', '2019-11-28 11:01:37', 5, 'photo1574855922.png', 'photo_id_proof1574855922.png', 'photo_esignature1574919069.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(40, 42, NULL, 9, 36, 13, 12, 11, 10, NULL, NULL, 35, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'stripe', '0', 'pay_slip1574856005.png', NULL, 'yes', 'yes', '2019/11/29', '2019-11-27 17:30:06', '2019-11-28 11:01:37', 5, 'photo1574856005.png', 'photo_id_proof1574856005.png', 'photo_esignature1574919069.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, 'receipt1574856182.png', 'yes', 0),
(41, 44, NULL, 9, 37, 13, 12, 11, 10, NULL, NULL, 37, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'stripe', '0', 'pay_slip1574918184.jpg', NULL, 'yes', 'yes', NULL, '2019-11-28 10:46:24', '2019-11-28 10:57:29', 5, 'photo1574918184.png', 'photo_id_proof1574918184.png', 'photo_esignature1574918832.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/11/28 10:11:32', 1, NULL, NULL, 0),
(42, 44, NULL, 9, 37, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'stripe', '0', 'pay_slip1574918821.png', NULL, 'yes', 'yes', NULL, '2019-11-28 10:57:01', '2019-11-28 10:57:29', 5, 'photo1574918821.png', 'photo_id_proof1574918821.png', 'photo_esignature1574918832.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(43, 42, NULL, 9, 36, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'stripe', '0', 'pay_slip1574919054.png', NULL, 'yes', 'yes', NULL, '2019-11-28 11:00:54', '2019-11-28 11:01:37', 5, 'photo1574919054.png', 'photo_id_proof1574919054.png', 'photo_esignature1574919069.png', 'hold', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(44, 45, NULL, 9, 38, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15000', '0', '0', 'stripe', '0', 'pay_slip1574919491.png', NULL, 'yes', 'yes', NULL, '2019-11-28 11:08:11', '2019-11-28 11:10:40', 5, 'photo1574919491.png', 'photo_id_proof1574919491.png', 'photo_esignature1574919622.png', 'hold', NULL, NULL, '1000', '2000', '3000', '4000', '5000', NULL, '', 1, NULL, NULL, 0),
(45, 45, NULL, 9, 38, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15000', '0', '0', 'stripe', '0', 'pay_slip1574919611.jpg', NULL, 'yes', 'yes', NULL, '2019-11-28 11:10:11', '2019-11-28 11:10:40', 5, 'photo1574919611.png', 'photo_id_proof1574919611.png', 'photo_esignature1574919622.png', 'hold', NULL, NULL, '1000', '2000', '3000', '4000', '5000', NULL, NULL, 0, NULL, NULL, 0),
(46, 46, NULL, 9, 39, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'bank', '0', 'pay_slip1574920004.png', NULL, 'yes', 'yes', '2019/11/30', '2019-11-28 11:16:44', '2019-11-28 11:19:05', 5, 'photo1574920004.png', 'photo_id_proof1574920004.png', 'photo_esignature1574920137.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, '', 1, NULL, NULL, 0),
(47, 46, NULL, 9, 39, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/11/28', '2019/11/29', '15', '0', '0', 'bank', '0', 'pay_slip1574920115.png', NULL, 'yes', 'yes', '2019/11/30', '2019-11-28 11:18:35', '2019-11-28 11:19:05', 5, 'photo1574920115.png', 'photo_id_proof1574920115.png', 'photo_esignature1574920137.png', 'pending', NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(48, 47, NULL, 9, 40, 13, 12, 11, 10, NULL, NULL, 43, 'Commercial', '2019/11/28', '2019/11/29', '11111', '0', '0', 'paypal', '3', 'pay_slip1574920776.png', NULL, 'yes', 'yes', NULL, '2019-11-28 11:29:36', '2019-12-11 11:45:29', 5, 'photo1574920776.png', 'photo_id_proof1574920776.png', 'photo_esignature1574920993.png', 'paid', NULL, NULL, '1', '10', '100', '1000', '10000', NULL, '2019/12/11 11:12:29', 1, NULL, NULL, 0),
(49, 47, NULL, 9, 40, 13, 12, 11, 10, NULL, NULL, 43, 'Commercial', '2019/11/28', '2019/11/29', '11111', '0', '0', 'paypal', '3', 'pay_slip1574920981.png', NULL, 'yes', 'yes', NULL, '2019-11-28 11:33:01', '2019-11-28 11:34:24', 5, 'photo1574920981.png', 'photo_id_proof1574920981.png', 'photo_esignature1574920993.png', 'paid', NULL, NULL, '1', '10', '100', '1000', '10000', NULL, '2019/11/28 11:11:24', 0, NULL, NULL, 0),
(50, 48, NULL, 9, 41, 13, 12, 11, 10, NULL, NULL, 44, 'Commercial', '2019/11/28', '2019/11/29', '9', '0', '0', 'paypal', '3', 'pay_slip1574921272.jpg', NULL, 'yes', 'yes', NULL, '2019-11-28 11:37:52', '2019-11-28 11:39:46', 5, 'photo1574921272.png', 'photo_id_proof1574921272.png', 'photo_esignature1574921289.png', 'paid', NULL, NULL, '1', '2', '3', '1', '2', NULL, '2019/11/28 11:11:46', 0, NULL, NULL, 0),
(51, 50, NULL, 9, 42, 13, 12, 11, 10, NULL, NULL, 45, 'Commercial', '2019/12/4', '2019/12/5', '15', '0', '0', 'paypal', '3', 'pay_slip1575444172.png', NULL, 'yes', 'yes', NULL, '2019-12-04 12:52:52', '2019-12-04 12:55:53', 5, 'photo1575444172.png', 'photo_id_proof1575444172.png', 'photo_esignature1575444205.png', 'paid', NULL, NULL, '1', '2', '3', '4', '5', NULL, '2019/12/04 12:12:53', 0, NULL, NULL, 0),
(52, 51, NULL, 9, 43, 13, 12, 11, 10, 1, NULL, 46, 'Commercial', '2019/12/21', '2019/12/30', '18', '0', '0', 'paypal', '8', 'pay_slip1575444749.png', NULL, 'yes', 'yes', NULL, '2019-12-04 13:02:29', '2019-12-04 13:16:41', 5, 'photo1575444749.png', 'photo_id_proof1575444749.png', 'photo_esignature1575444783.png', 'paid', NULL, NULL, '1', '2', '3', '5', '-11', NULL, '2019/12/04 13:12:12', 0, NULL, NULL, 1),
(53, 52, NULL, 9, 44, 13, 12, 11, 10, 2, NULL, NULL, 'Commercial', '2019/12/24', '2019/12/25', '65', '0', '0', 'stripe', '9', 'pay_slip1575446054.png', NULL, 'yes', 'yes', NULL, '2019-12-04 13:24:14', '2019-12-04 13:53:27', 5, 'photo1575446054.png', 'photo_id_proof1575446054.png', 'photo_esignature1575446073.png', 'paid', NULL, NULL, '11', '12', '13', '14', '-18', NULL, '2019/12/02 13:12:20', 1, NULL, NULL, 1),
(54, 49, NULL, 9, 45, 10, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/4', '2019/12/5', '15', '0', '0', NULL, NULL, 'pay_slip1575449664.png', NULL, 'yes', 'yes', NULL, '2019-12-04 14:24:24', '2019-12-04 14:24:56', 4, 'photo1575449664.png', 'photo_id_proof1575449664.png', 'photo_esignature1575449693.png', NULL, NULL, NULL, '1', '2', '3', '4', '5', NULL, NULL, 0, NULL, NULL, 0),
(55, 53, NULL, 29, 46, 25, 23, 26, 27, NULL, NULL, NULL, 'Commercial', '2019/12/14', '2020/12/31', '2800', '0', '0', 'stripe', '3', 'pay_slip1575450601.jpg', NULL, 'yes', 'yes', NULL, '2019-12-04 14:40:01', '2019-12-04 14:55:04', 5, 'photo1575450601.jpg', 'photo_id_proof1575450601.jpg', 'photo_esignature1575450675.png', 'paid', NULL, NULL, '1000', '300', '200', '100', '1200', NULL, '2019/12/04 14:12:02', 0, NULL, NULL, 0),
(56, 52, NULL, 29, 47, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/28', '2019/12/31', NULL, '0', '0', NULL, NULL, 'pay_slip1575465270.png', NULL, 'yes', 'yes', NULL, '2019-12-04 18:44:30', '2019-12-04 18:45:15', 3, 'photo1575465270.png', 'photo_id_proof1575465270.png', 'photo_esignature1575465300.png', NULL, NULL, NULL, '11', '12', '13', '14', '15', NULL, NULL, 0, NULL, NULL, 0),
(57, 59, NULL, 9, 48, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/11', '8', '0', '0', 'stripe', '3', 'pay_slip1575964967.png', NULL, 'yes', 'yes', NULL, '2019-12-10 13:32:47', '2019-12-10 13:38:05', 5, 'photo1575964967.png', 'photo_id_proof1575964967.png', 'photo_esignature1575964981.png', 'paid', NULL, NULL, '3', '2', '1', '0', '2', NULL, '2019/12/10 13:12:03', 0, NULL, NULL, 0),
(58, 54, NULL, 38, 49, 13, 12, 11, 10, NULL, NULL, NULL, 'Commercial', '2019/12/10', '2019/12/17', '1232', '0', '0', 'bank', '7', 'pay_slip1575966330.png', NULL, 'yes', 'yes', '2019/12/12', '2019-12-10 13:55:30', '2019-12-10 19:07:29', 5, 'photo1575966330.png', 'photo_id_proof1575966330.png', 'photo_esignature1575966342.png', 'pending', NULL, NULL, '1', '2', '3', '4', '1222', NULL, NULL, 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'John',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `confirmation_code` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `receipt_failed_count` int(11) NOT NULL DEFAULT '0',
  `user_role` int(11) NOT NULL DEFAULT '1' COMMENT ' 0-admin, 1-Tenant, 2-Property Owner, 3-Property Manager, 4-Property Description Experts, 5-Legal Advisor, 6- Visit Organizer',
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_no` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_amount` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `postal` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `professional_status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `school_company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vat_nr` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_verify` int(11) DEFAULT NULL,
  `company_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_id_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_photo_esignature` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `confirmation_code`, `verified`, `receipt_failed_count`, `user_role`, `last_name`, `phone_no`, `wallet_amount`, `gender`, `image`, `google_id`, `facebook_id`, `remember_token`, `created_at`, `updated_at`, `postal`, `nr`, `postal_code`, `city`, `id_card`, `professional_status`, `company_name`, `tenant_type`, `school_company_name`, `company_address`, `vat_nr`, `registration_number`, `bank_account_number`, `phone_verify`, `company_email`, `company_phone`, `tenant_address`, `tenant_photo`, `tenant_photo_id_proof`, `tenant_photo_esignature`) VALUES
(1, 'admin', 'admin@gmail.com', '2019-08-28 10:30:21', '$2y$10$FCjfWNIL7aJsOoFhdP6G0eWKSsoutPFh6bmQVxK8p1nOYTv/jCjFm', NULL, 1, 0, 0, 'Admin', NULL, '0', NULL, '5dde61e6d1ae5.jpg', NULL, NULL, NULL, NULL, '2019-11-27 17:50:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Po', 'po@gmail.com', '2019-08-28 10:30:20', '$2y$10$CVIwwRN9kQIsv3IQKkPHjOMFPBjdxB9hc6pSx9CdObAyBr36yA2ce', NULL, 0, 0, 2, 'po', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-16 11:12:01', '2019-11-16 11:12:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'john', 'tenent@gmail.com', '2019-08-28 10:30:20', '$2y$10$46ZW0/4TOHo85UooL6w4T.lZPEEHfW9OCdPa79XWYqjx0B2j1.jo6', NULL, 0, 0, 1, 'john', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-16 11:47:02', '2019-11-18 11:49:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'John', 't@yopmail.com', '2019-11-16 17:22:17', '$2y$10$AXxLFrUdmOFEodu5vOOtOOXMyHNrNSANeIzFuSr1B6zZcLtO1imiS', NULL, 0, 0, 1, 'sddd', '919813607878', '0', NULL, NULL, NULL, NULL, 'ZmzAwjE2yKYqLUJJE8WB9BAmRSvj9GuhkWkjBfmZITGC9mRhZo2etoUJIncf', '2019-11-16 17:17:22', '2019-12-18 11:47:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Dubai - United Arab Emirates', NULL, NULL, NULL),
(5, 'amit', 'p@yopmail.com', '2019-11-16 18:05:46', '$2y$10$fG5AVaFBfxhcUDiwtgTOEOxPX9I3HoBJ8fBZC5uu53VJxX4Obz/4q', NULL, 0, 0, 2, 'sharma', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-16 18:05:01', '2019-11-16 18:05:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'legal', 'legal@yopmail.com', '2019-11-18 11:54:41', '$2y$10$UDgD5TzHNzMdi2ajoO8VReZbg4tuQ5x7nCeCT/.lM3zASXB4AI04.', NULL, 0, 0, 5, 'adviser', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-18 11:52:20', '2019-11-20 10:53:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'dddd', 'tes@yopmail.com', '2019-11-18 13:24:13', '$2y$10$3dduTwGPKk84aTL8FWUz1eAb47vlVzKZnHuUVABHUdw/GIw5zYkgO', NULL, 0, 0, 2, 'ssss', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-18 13:22:10', '2019-11-18 13:24:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'f tenant', 'tenant26@yopmail.com', '2019-11-18 14:08:33', '$2y$10$I0eAQeuZgXXNWLXcUYxcKe3eCS8wPkOMdJOZvxxx3N4D5AGIbNTU2', NULL, 0, 0, 1, 'l tenant', '919876656789', '6202.09', 'Female', '1574772948.jpg', NULL, NULL, 'Rmht5D6FDj9PW8wsRhomLC4aAfMzOB6NVUY14UlPve6Oq0OF3O4jRE3ex3UI', '2019-11-18 13:52:04', '2020-01-04 00:00:02', '32', '12', '140106', 'Punjab', '761123343422', 'Student', NULL, 'person', 'dc', NULL, NULL, NULL, NULL, 1, NULL, NULL, '12', NULL, NULL, NULL),
(10, 'fname', 'po26@yopmail.com', '2019-11-18 13:58:15', '$2y$10$MhDG5v3pLUZpGxi/qqrn5.rSyZvIaG/jmbyFmL0i16wU1I6HVYF.W', NULL, 0, 0, 2, 'lname', '919813607878', '0', 'Male', '1576323473.jpeg', NULL, NULL, 'Radg8pdn3gDG7gVQmGevVA7vpJMM4MQDLX3OgaZQRzrPGO11uzWGecO9Lp0S', '2019-11-18 13:57:43', '2019-12-14 17:07:53', 'ret', '5', 'drf', '5', '54', 'Intern', NULL, NULL, 're', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'pm first', 'pm26@yopmail.com', '2019-11-18 14:09:46', '$2y$10$Dk5wZM02osFTNaieCxfHguuxkijblMtt2GneBaKbwccs2DIuyBWiC', NULL, 0, 0, 3, 'pm last', NULL, '0', NULL, NULL, NULL, NULL, 'G8soUXMIYFBnKPJzQ96lkksx1nLJniE0vMMX5qwAveh1OF4CNmh8gtD19uzG', '2019-11-18 14:01:20', '2019-12-04 12:41:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'vo first', 'vo26@yopmail.com', '2019-11-18 14:14:42', '$2y$10$z5xdOFOWgY10kDqG84a2OODXqBjj9ZbG3pldoi1o5y3yipFXXxjjy', NULL, 0, 0, 6, 'vo last', '919512452152', '0', 'Female', '1574925914.jpg', NULL, NULL, 'qxA0L9pQmEmWdyoL0ozrRjnTPxuxgEkWLyiHqvJObMzcmorOcXOLC5SyvPt0', '2019-11-18 14:03:54', '2019-12-04 12:45:17', 'fdg', 'dfh', 'dfgfd', 'dfh', 'dfhd', 'Student', NULL, NULL, 'fdhfd', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'pde first', 'pde26@yopmail.com', '2019-11-18 14:16:19', '$2y$10$oWN8AlL2GozeeRf4QIKQre5gwiSi7ap/31zZyDUGNlzK.ZyIcbSPS', NULL, 0, 0, 4, 'pde last', '919512514252', '0', 'Male', '1574924505.png', NULL, NULL, '78MiJLHvlqKKciSWGOqN4lWocEz6CyIHDLWiVn2uCTPGfMrFIEgG5V3s1QI8', '2019-11-18 14:04:49', '2019-11-28 12:31:45', 'r', 'e', 'r', 'w', '123432', 'Student', 'Boobur Boat Rentals', 'company', 'qwsert', '279 Circuit St, Hanover,', 'jlkjljkl', '453332', '2241qw2', 1, 'chetanvisionvivante@gmail.com', '8669266287', 'GF-1/18, Golmuri Road, New Line, Punjabi Refugee Colony, Golmuri, Jamshedpur, Jharkhand, India', NULL, NULL, NULL),
(14, 'la first', 'la26@yopmail.com', '2019-11-20 11:01:20', '$2y$10$wo74v4VIZlqfVOD37rxw5um8Z0HEnxyTykCU45N7VqUvpfGtV2en2', NULL, 0, 0, 5, 'la last', NULL, '0', NULL, NULL, NULL, NULL, 'wbG8E7gk9oN9kidr9bd0MGMgHbdTxf5L3wFEkhe8viOOoRbAvxes2cozqjUt', '2019-11-18 14:07:13', '2019-11-25 19:54:20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'place', 'pe26@yopmail.com', '2019-11-25 18:03:46', '$2y$10$LlI5X1bxrf7h.QrTow81U..UNSVYBqUbCS96n5YnQHBhplqBkD65K', NULL, 0, 0, 1, 'expert', '918265022909', '0', 'Male', '1574685368.jpg', NULL, NULL, NULL, '2019-11-20 10:55:51', '2019-11-25 18:06:08', 'awsd', '34gdfg', '3243', 'fghfgh', '4534534', 'Employee', NULL, NULL, 'tghtrh', NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'qwerty', 'test32@yopmail.com', '2019-11-25 10:29:15', '$2y$10$Uf91oi3FCHEQmsB9fKT0g.rE/D6/CHtCdXg/tb6wxDG1D72SoJA7q', NULL, 1, 0, 1, 'ghff', '917548444415', '0', NULL, NULL, NULL, NULL, NULL, '2019-11-25 10:29:15', '2019-11-25 13:22:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '1234 Market Street, Philadelphia, PA, USA', 'photo1574657960.png', 'photo_id_proof1574657960.png', NULL),
(17, 'popankaj1', 'pankajdheer@gmail.com', NULL, '$2y$10$aoXNUTLjfOS0WoeCBR5OnerEotkclIiuWR/nDVVhx0dH2pGNqC4f2', NULL, 0, 0, 2, 'dheer', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-25 12:49:23', '2019-11-25 12:49:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'pankajpo2', 'pankajdheervisionvivante@gmail.com', '2019-11-25 12:53:33', '$2y$10$OA/KSbPbJfHUp3XG0zDjOewTVdHNdFaQO06acge/38.VaVRZCkyai', NULL, 0, 0, 3, 'dheer', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-25 12:52:29', '2019-11-26 17:06:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'hjhj', 'ttest@yopmail.com', '2019-11-26 17:41:59', '$2y$10$LmFE81vSDsnOltRkKfVIQO8vpAOln6oVfO9EaZ/G0RtCEcDPxbGaW', NULL, 1, 0, 1, NULL, '919813607878', '0', NULL, NULL, NULL, NULL, NULL, '2019-11-26 17:41:59', '2019-11-26 17:41:59', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'bvnhfgh', 'sdf@yopmail.com', '2019-11-26 17:46:14', '$2y$10$eygESK3IYcFSEEVwmLLQguFdCyQFjhVOpaPHnu0s9lkVhuHD3cxiG', NULL, 1, 0, 1, NULL, '919813607878', '0', NULL, NULL, NULL, NULL, NULL, '2019-11-26 17:46:14', '2019-11-26 18:02:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, '525 South Riverside Avenue, Croton-on-Hudson, NY, USA', NULL, NULL, NULL),
(21, 'df', 'er@yopmail.com', '2019-11-27 10:37:01', '$2y$10$5IegmOEB/HmaDl3MLRfzfuxMkugJxUDjzT96pr.QTzFEizk8/r0Yq', NULL, 1, 0, 1, NULL, '919813607878', '0', NULL, NULL, NULL, NULL, NULL, '2019-11-27 10:37:01', '2019-11-27 10:37:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Roma, Metropolitan City of Rome, Italy', 'photo1574831221.png', 'photo_id_proof1574831221.png', NULL),
(22, 'sadf', 'po28@yopmail.com', '2019-11-27 19:03:44', '$2y$10$xA.l5DEBBIoTPsnwrYgLE.LnwVYpZpJOEmK2i1NbbXDZBR91GNMn2', NULL, 0, 0, 2, 'fafa', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-11-27 19:02:38', '2019-11-27 19:03:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'VOjatin', 'VOjatinsehgal@yopmail.com', '2019-12-04 14:00:34', '$2y$10$kwl6uNqUnY.NiynY2S3HD..myVhWgtwuXYloRj38DUNg8S7KkF4bW', NULL, 0, 0, 6, 'VOSehgal', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-03 17:56:42', '2019-12-04 14:00:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'LAjatin', 'LAjatinsehgal@yopmail.com', '2019-12-06 19:59:57', '$2y$10$HXsG2nj.aqIQymIXMnZ37O6O2WzF1.olzk.p9U28W5GE2SRydqoom', NULL, 0, 0, 5, 'LAsehgal', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-03 18:03:16', '2019-12-18 19:43:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'PDAjatin', 'PDAjatinsehgal@yopmail.com', '2019-12-04 14:38:24', '$2y$10$ditqPIUfaQE4ML8ftv1YyexIBB2AyHAj9Y5otR47w4XzjgSQuWwMq', NULL, 0, 0, 4, 'PDAsehgal', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-03 18:04:35', '2019-12-04 14:38:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'PMjatin', 'PMjatinsehgal@yopmail.com', '2019-12-06 17:54:13', '$2y$10$Ud9yQ.LaU9GrnIJNQAEwp.DuzmHNn3R8Y7d0Pg9XQ97iZLJE4RExy', NULL, 0, 0, 3, 'PMsehgal', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-03 18:06:46', '2019-12-06 17:54:13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'POjatin', 'POjatinsehgal@yopmail.com', '2019-12-04 13:31:00', '$2y$10$XjCoFsW5Vu4FcXgks9/rmOpEmugoypaZ4XZ8qNDYBepZ/Ii9e14t6', NULL, 0, 0, 2, 'POsehgal', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-04 13:29:36', '2019-12-04 13:31:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'test', 'malkeetvisionvivante54543@gmail.com', NULL, '$2y$10$PfMwaVI77kaPMEEl9FI4g.cgZlsoL5GAVBuik0GwUfeJ1ijuA0SRm', NULL, 0, 0, 2, 'test', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-04 13:30:48', '2019-12-04 13:30:48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'John', 'Tjatinsehgal@yopmail.com', '2019-12-04 13:54:28', '$2y$10$0wmQmREEapzvbvpmIknq6ew.F9PtHVwvaO4Th1fx5W2qUORc2TIy.', NULL, 0, 0, 1, NULL, '919465677676', '0', NULL, NULL, NULL, NULL, NULL, '2019-12-04 13:53:48', '2019-12-25 15:10:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Manimajra, Chandigarh, India', NULL, NULL, NULL),
(30, 'rewr', 'malkeetvision34535435vivante@gmail.com', NULL, '$2y$10$1bKR8Vh0Gh6U0OyReyB8rep1Wg84zIFTe.iDVUbd.VYzlGlLxZvsG', NULL, 0, 0, 2, 'rewr', NULL, '0', NULL, NULL, NULL, NULL, NULL, '2019-12-04 15:45:45', '2019-12-04 15:45:45', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'a', 'sd@fd.bin', NULL, '$2y$10$Kh4vvu/oYPNPpUNrsUWsi.0dAB8Xi5hQp8g53jUAveoXKoIXdmto.', NULL, 0, 0, 1, 'xzvzx', '555555555', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-09 17:15:54', '2019-12-09 17:15:54', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gfd', NULL, NULL, NULL),
(32, 'dfxcg', 'w@yopmail.com', '2019-12-09 17:19:44', '$2y$10$/3EfJQWU.NBv./fikEyUjudAKR561qYfTZHRoIczat9yKyQSEfHBW', NULL, 0, 0, 1, 'fdgdf', '54654654', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-09 17:18:18', '2019-12-09 17:19:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dfghfd', NULL, NULL, NULL),
(34, 'amit', 'asdf@yopmail.com', NULL, '$2y$10$u.PAXsH18coL55vbizt5muNuce2SH4AQnaU4psA8FL87FHgLl0pMS', NULL, 0, 0, 1, 'fg', '34535435', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-10 12:44:40', '2019-12-10 12:44:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '34', NULL, NULL, NULL),
(35, 'sdf', 'adminddd@gmail.com', NULL, '$2y$10$WuZo/dvoiQ/cBeVGh5IpGuQd6X.24WXYh5i85MKdJlwyywEnvacMu', NULL, 0, 0, 1, 'sd', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-10 13:34:15', '2019-12-10 13:34:15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '204', NULL, NULL, NULL),
(36, 'sdf', 's@gmail.com', NULL, '$2y$10$egGDnW3/vdID/j3Z/JfiE.rBVLS3czp7yXZ7HqrXq.ZOAClFFh.sO', NULL, 0, 0, 1, 'sd', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-10 13:35:04', '2019-12-10 13:35:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '204', NULL, NULL, NULL),
(37, 'sdf', 's@gmail.coms', NULL, '$2y$10$nak9ojjfYlTYyGgIqzG.Iu4PMVkSBPkU5Oo5T//4V8NM74CR1kA62', NULL, 0, 0, 1, 'sd', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-10 13:35:36', '2019-12-10 13:35:36', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '204', NULL, NULL, NULL),
(38, 'sfg', 'rte@yopmail.com', '2019-12-10 13:56:31', '$2y$10$IgZR5ytQfkhpv1Zb/FNY7euWkauvIwKTeDFEur4S/xAtmexj4T1uW', NULL, 0, 0, 1, 'df', '34344343434', '0', 'female', NULL, NULL, NULL, NULL, '2019-12-10 13:38:16', '2019-12-10 13:56:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xaddasas', NULL, NULL, NULL),
(39, 'Florida', 'chetanvisionvivante@gmail.com', NULL, '$2y$10$id31.gojIYr713FnvvXRZurkHNCImfk53dcWV15sCrNw5KzEhq9Sq', NULL, 0, 0, 1, 'Boats', '8669266287', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-10 15:48:23', '2019-12-10 15:48:23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '279 Circuit St, Hanover,', NULL, NULL, NULL),
(40, 'amit', 'amitT@yopmail.com', '2019-12-10 19:06:32', '$2y$10$1Doz1OHz1PHaiRBpLaGHUuyFoxjve0CN92VwkfXkN5pQsluCCe0pC', NULL, 0, 0, 1, 'sharma', '34344343434', '0', 'male', NULL, NULL, NULL, 'CXqq8cg3UdYlBIYEYl9xMYegjA1BBef1dLZE94MPWYr6t98bE0s9MmO6OYVA', '2019-12-10 19:05:06', '2019-12-16 17:43:49', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xaddasas', NULL, NULL, NULL),
(41, 'test', 'testT@yopmail.com', '2019-12-11 11:21:29', '$2y$10$z7UKydbrjqtGdr.QXYMgleXY4NNdmlB/hnjZHMYfsuE1ZdifMX5lK', NULL, 0, 0, 1, 'tenanrt', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-11 11:20:37', '2019-12-11 11:21:29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xaddasas', NULL, NULL, NULL),
(42, 'amit', 'ase@yopmail.com', '2019-12-11 12:04:37', '$2y$10$LLPr6WdLoWj6a7WNxe74/.rnf8XeJit7zVjjtPuR9J6jdkdDVM0yO', NULL, 0, 0, 1, 'asdf', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-11 12:03:17', '2019-12-11 12:04:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'xaddasas', NULL, NULL, NULL),
(43, 'asdf', 'sdsd@yopmail.com', '2019-12-11 12:47:47', '$2y$10$mvBU39H0lcKccq.UJklotu.bZr59e8PA4Vgb0G2ZMmE9vd8ahOuXK', NULL, 0, 0, 1, 'sdf', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-11 12:46:53', '2019-12-11 18:08:27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'ewr', NULL, NULL, NULL),
(44, 'amit', 'uy@hfdgh.g', NULL, '$2y$10$SD3XiSddpBf7vTtlq2I6Vud9bYTHcNILtZRkMvOBEKRcbX..sPSPy', NULL, 0, 0, 1, 'yt', '34344343434', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-12 11:24:19', '2019-12-12 11:24:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'kl', NULL, NULL, NULL),
(46, 'amit', 'tenant101@yopmail.com', '2019-12-12 17:18:43', '$2y$10$5K06KhqXLzLyMO/HWKcRJOZrnl/Jp.FFLB5Bjv19/PnltbvzoGhCK', NULL, 0, 0, 1, 'amit tenant', '6214452152', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-12 16:52:42', '2019-12-12 17:18:43', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '12/24', NULL, NULL, NULL),
(47, '', '', NULL, '$2y$10$s8v62RBQj6KX1vchIBUbquqrS138T9DFQvljWMz9eEK23.eZl/Bdu', NULL, 0, 0, 1, '', '', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 12:47:52', '2019-12-16 12:47:52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL),
(48, 'test', 'multid@yopmail.com', NULL, '$2y$10$SbDPHSyrBO1v6w8WeQSB9.R9yJ7dMcWTgfsi35xJ9Pn0GKQy1oaYG', NULL, 0, 0, 1, 'mulit', '919813607878', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 13:14:37', '2019-12-16 13:14:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ffffdd', NULL, NULL, NULL),
(49, 'tes', 'test@g.com', '2019-12-16 13:27:54', '$2y$10$ykAeawV5OZiBMfr9IcQgmeVPWrZrMux14Jl9yw8seqQPVMSw8FHLy', NULL, 1, 0, 1, NULL, '917707907575', '0', NULL, NULL, NULL, NULL, NULL, '2019-12-16 13:27:54', '2019-12-16 13:27:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Test, Test, Sakha Republic, Russia', 'photo1576483078.png', 'photo_id_proof1576483078.jpeg', NULL),
(50, 'dasf', 'sdf@dfgdf.hghg', NULL, '$2y$10$/ndODXZzItiXu.PtM/5R8udUr2QIQN5iMVXyaxSvQSeSNoE6B7G3i', NULL, 0, 0, 1, 'sdf', '4545454', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 13:37:42', '2019-12-16 13:37:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rt', NULL, NULL, NULL),
(51, 'dasf', 'sdfff@dfgdf.hghg', NULL, '$2y$10$qjKa20Bq7MWPiuur6fMb3eFv.q75e5lIB0Vd7Hr0QO9lacmsRLrvy', NULL, 0, 0, 1, 'sdf', '4545454', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 13:38:24', '2019-12-16 13:38:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rt', NULL, NULL, NULL),
(52, 'amity', 'rest@hfff.com', NULL, '$2y$10$QxoTLDBloXTvF9v/Tq7m8u4liRb8x7hx39sOgMIoEVh1iFgsWwN3e', NULL, 0, 0, 1, 'rest', '45646', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 13:44:09', '2019-12-16 13:44:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ghgfh', NULL, NULL, NULL),
(53, 'testing', 'testing@hain.com', NULL, '$2y$10$mHVbs56mw14ZQs8MgHPnGuQYenkPLaUl0hxThj8EIhjC1RZAJ/VvW', NULL, 0, 0, 1, 'hain', '54645654', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 13:48:19', '2019-12-16 13:48:19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dfgghh', NULL, NULL, NULL),
(54, 'sdf', 'sdfsd@dsgf.nnnn', NULL, '$2y$10$t9mEknGWL.wQ1K07Ly3gLu8Q7f5h9nI8wNDSYtRCj3TT4A.ra.72S', NULL, 0, 0, 1, 'sdfdfs', '5656', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 14:29:18', '2019-12-16 14:29:18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ghfgfh', NULL, NULL, NULL),
(55, 'drfrfgd', 'resr@rest.com', NULL, '$2y$10$gXdrcBsJYXDsvper4MvQhev93tvtDDaiqCy5zcK82W4Nr8TwLqk2G', NULL, 0, 0, 1, 'dfgdfg', '4567', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 14:32:11', '2019-12-16 14:32:11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hgh', NULL, NULL, NULL),
(56, 'qwerty', 'vik@ewrfewrt.ghg', NULL, '$2y$10$06Clvr/Qju8oIlmcX33t7uxlgJG2ufsJthRjQVxjhp1G2/CzZWMsy', NULL, 0, 0, 1, 'qwerty', '54455445454', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 16:56:24', '2019-12-16 16:56:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'gfghfgh', NULL, NULL, NULL),
(57, 'new', 'newtenant@yopmail.com', NULL, '$2y$10$BvXQ4FxmWiVOK05U1IxBeO2Sz2dZtSfq9rVGXki6RVBOpbDHguhBm', NULL, 0, 0, 1, 'newtenant@yopmail.com', '8669266287', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 17:12:04', '2019-12-16 17:12:04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '279 Circuit St, Hanover,', NULL, NULL, NULL),
(58, 'amit', 'punj@yopmail.com', NULL, '$2y$10$ezxUFYooe9Ai9nP/XcvUfupaxvFEHN7ta.nsDJfgrI3LcQXZ4o2NW', NULL, 0, 0, 1, 'punj', '2345345345', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 17:12:55', '2019-12-16 17:12:55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'fdgdgf', NULL, NULL, NULL),
(59, 'punj', 'punj1@yopmail.com', NULL, '$2y$10$fN/zkHu7EcRWiSLdRVupO.Tb2nsHRaSYUV6wx2Wa2MDPQAq8yObKi', NULL, 0, 0, 1, 'asdfkl', '3423', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 17:15:37', '2019-12-16 17:15:37', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dghdf', NULL, NULL, NULL),
(60, 'Florida', 'newtenant1@yopmail.com', NULL, '$2y$10$ZQr/BCvptNzG4yrgLODtj.o8X6Pgz5X6jqIFRxhJE0RANONgvxc5e', NULL, 0, 0, 1, 'Boats', '8669266287', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 17:18:51', '2019-12-16 17:18:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '279 Circuit St, Hanover,', NULL, NULL, NULL),
(61, 'Florida', 'newtenant2@gmail.com', NULL, '$2y$10$.V/I8Lfgs/onFLFcwdCITOWkwHYWHlBFxYwsB4xXdYC4gRf93HNC2', NULL, 0, 0, 1, 'Boats', '8669266287', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-16 17:20:31', '2019-12-16 17:20:31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '279 Circuit St, Hanover,', NULL, NULL, NULL),
(62, 'Jyoti1', 'jyotit@yopmail.com', NULL, '$2y$10$iw1dyQfdFfxxHdlZtTWRi.aYDZL34Un2.jFZMYq1bv97O1uHmd5Q.', NULL, 0, 0, 1, 'TENANT', '1201120120', '0', 'female', NULL, NULL, NULL, NULL, '2019-12-17 17:20:09', '2019-12-17 17:20:09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'd', NULL, NULL, NULL),
(63, 'gg', 'tenant103@yopmail.com', NULL, '$2y$10$I/SoKPAFp5By5d1DajcnnOiVUXfqK91QszewbIi1477fk.yLNxOUa', NULL, 0, 0, 1, 'gg', '65767', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-19 18:04:56', '2019-12-19 18:04:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'dsdsds', NULL, NULL, NULL),
(64, '', 'tenant26@yopmail.comd', NULL, '$2y$10$w3f28L9EoMaGRDUH3V9ZrOnvojrgWqmexLm3i73C0oNqGJAwDeDNK', NULL, 0, 0, 1, '', '', '0', 'male', NULL, NULL, NULL, NULL, '2019-12-19 18:32:00', '2019-12-19 18:32:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL),
(65, 'amit', 'newtenant11@yopmail.com', NULL, '$2y$10$smPyp4rfKB35MysDSByFi.uX3Ht.pEqgZpbJ3ziNpq3ljSeacEh8G', NULL, 0, 0, 1, 'sharma', '9813607878', '0', 'female', NULL, NULL, NULL, NULL, '2019-12-25 14:48:39', '2019-12-25 14:48:39', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'chandigarh', NULL, NULL, NULL),
(66, 'amit', 'amit123@yopmail.com', '2020-01-07 17:40:12', '$2y$10$jeuBJxdyu2fBNH4Bllq2F.CLpx2NoD1U0RG8gyyHtzWUjOHuDOTXy', NULL, 1, 4, 1, NULL, '919813607878', '0', NULL, NULL, NULL, NULL, NULL, '2020-01-07 17:40:12', '2020-01-10 14:40:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'person', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 'Testorf, Zarrentin am Schaalsee, Germany', 'photo1578399014.jpg', 'photo_id_proof1578399014.jpg', NULL),
(67, 'John', 'dfg@yopmail.com', '2020-01-10 12:37:05', '$2y$10$IPMOqgvoUo5212VtqsMy6.oavt8SvfaDpt3IRLHI60CWK1/17osVm', NULL, 0, 0, 1, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '2020-01-10 12:36:41', '2020-01-10 12:37:05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'John', 'cotenant1@yopmail.com', NULL, '$2y$10$ftVxlCUs9vh6z9MDOgQUvunsuKCwUjL39giotfVNcX4HYgyNJqZsK', NULL, 0, 0, 1, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '2020-01-10 14:10:46', '2020-01-10 14:10:46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'John', 'cotenant@yopmail.com', NULL, '$2y$10$m0yRl/IdZ71gS1mvmhCmCOVJxvC62J18bXGH2UjGdHirtNAwaqTuq', NULL, 0, 0, 1, NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, '2020-01-10 14:41:24', '2020-01-10 14:41:24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_account`
--

CREATE TABLE `users_account` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `terminate_id` int(11) DEFAULT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ada_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routing_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paypal_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_account`
--

INSERT INTO `users_account` (`id`, `user_id`, `terminate_id`, `booking_id`, `user_type`, `bank_name`, `ada_number`, `account_number`, `routing_number`, `paypal_email`, `created_at`, `updated_at`) VALUES
(1, 9, 2, 53, 1, 'ICICI', 'IC89809', '9812223123459900', 'R123456', 'surajbansalvision-buyer@gmail.com', '2019-11-25 16:42:17', '2019-12-04 13:52:52'),
(2, 10, NULL, NULL, 2, 'indusind', 'xc12345', 'we12345', 'ro12312', NULL, '2019-11-27 16:30:07', '2019-11-27 16:30:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_availability`
--

CREATE TABLE `users_availability` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `start_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `days` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selecteddates` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_availability`
--

INSERT INTO `users_availability` (`id`, `user_id`, `start_time`, `end_time`, `days`, `selecteddates`, `created_at`, `updated_at`) VALUES
(1, 13, '10:00:00 AM', '7:00:00 PM', '2,3', '11/28/2019', '2019-11-21 14:00:34', '2019-11-22 19:01:28'),
(2, 12, '9:00:00 AM', '9:00:00 PM', '1', '11/29/2019,11/25/2019', '2019-11-22 17:50:52', '2019-11-22 19:34:11'),
(3, 25, '9:00:00 AM', '9:00:00 PM', '1,2', '12/20/2019,12/26/2019', '2019-12-04 17:40:48', '2019-12-04 17:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `users_e`
--

CREATE TABLE `users_e` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `verify_emails`
--

CREATE TABLE `verify_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `confirmation_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verify_emails`
--

INSERT INTO `verify_emails` (`id`, `email`, `confirmation_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 'ttest@yopmail.com', '51703', 1, '2019-11-26 17:40:50', '2019-11-26 17:41:44'),
(2, 'sdf@yopmail.com', '82278', 1, '2019-11-26 17:45:41', '2019-11-26 17:46:00'),
(3, 'er@yopmail.com', '47508', 1, '2019-11-27 10:36:25', '2019-11-27 10:36:47'),
(4, 'test@g.com', '88434', 1, '2019-12-16 13:26:44', '2019-12-16 13:27:21'),
(5, 'jatin@gmail.com', '91731', 0, '2020-01-07 17:38:45', '2020-01-07 17:38:45'),
(6, 'amit123@yopmail.com', '91702', 1, '2020-01-07 17:39:02', '2020-01-07 17:39:33');

-- --------------------------------------------------------

--
-- Table structure for table `verify_users`
--

CREATE TABLE `verify_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_permissions`
--
ALTER TABLE `access_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_reason`
--
ALTER TABLE `appointment_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_appointment`
--
ALTER TABLE `book_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmspages`
--
ALTER TABLE `cmspages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_log`
--
ALTER TABLE `email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extend_request`
--
ALTER TABLE `extend_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guarantor`
--
ALTER TABLE `guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leagl_actions`
--
ALTER TABLE `leagl_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membership_payments`
--
ALTER TABLE `membership_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meter_readings`
--
ALTER TABLE `meter_readings`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_units`
--
ALTER TABLE `property_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_vendors`
--
ALTER TABLE `property_vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_visits`
--
ALTER TABLE `property_visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_tenants`
--
ALTER TABLE `sub_tenants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_invitations`
--
ALTER TABLE `tenant_invitations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terminate`
--
ALTER TABLE `terminate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_threads`
--
ALTER TABLE `ticket_threads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units_rent`
--
ALTER TABLE `units_rent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_booking`
--
ALTER TABLE `unit_booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_booking-1112`
--
ALTER TABLE `unit_booking-1112`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_account`
--
ALTER TABLE `users_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_availability`
--
ALTER TABLE `users_availability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_e`
--
ALTER TABLE `users_e`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_emails`
--
ALTER TABLE `verify_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verify_users`
--
ALTER TABLE `verify_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_permissions`
--
ALTER TABLE `access_permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `appointment_reason`
--
ALTER TABLE `appointment_reason`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `book_appointment`
--
ALTER TABLE `book_appointment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cmspages`
--
ALTER TABLE `cmspages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `email_log`
--
ALTER TABLE `email_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `extend_request`
--
ALTER TABLE `extend_request`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `guarantor`
--
ALTER TABLE `guarantor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `leagl_actions`
--
ALTER TABLE `leagl_actions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `membership_payments`
--
ALTER TABLE `membership_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT for table `meter_readings`
--
ALTER TABLE `meter_readings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `property_units`
--
ALTER TABLE `property_units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `property_vendors`
--
ALTER TABLE `property_vendors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `property_visits`
--
ALTER TABLE `property_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sub_tenants`
--
ALTER TABLE `sub_tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tenant_invitations`
--
ALTER TABLE `tenant_invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `terminate`
--
ALTER TABLE `terminate`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ticket_threads`
--
ALTER TABLE `ticket_threads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- AUTO_INCREMENT for table `units_rent`
--
ALTER TABLE `units_rent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `unit_booking`
--
ALTER TABLE `unit_booking`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `unit_booking-1112`
--
ALTER TABLE `unit_booking-1112`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `users_account`
--
ALTER TABLE `users_account`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_availability`
--
ALTER TABLE `users_availability`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users_e`
--
ALTER TABLE `users_e`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `verify_emails`
--
ALTER TABLE `verify_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `verify_users`
--
ALTER TABLE `verify_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
