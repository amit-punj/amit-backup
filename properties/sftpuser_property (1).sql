-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 11, 2020 at 07:13 AM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.0.33-8+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sftpuser_property`
--

-- --------------------------------------------------------

--
-- Table structure for table `agent_connect`
--

CREATE TABLE `agent_connect` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `confirm` int(2) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `id` int(11) NOT NULL,
  `amenities_name` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`id`, `amenities_name`) VALUES
(34, 'Balcony'),
(8, 'Parking'),
(9, 'Heating'),
(31, 'Foyer'),
(12, 'Bathroom'),
(14, 'Kitchen'),
(33, 'Working Fireplace'),
(16, 'Lounge'),
(18, 'Storage'),
(32, 'Washer/Dryer'),
(23, 'Near Public Transport'),
(24, 'penthouse'),
(26, 'Disability Access'),
(30, 'Multi-level'),
(27, 'Den/office'),
(28, 'Library'),
(29, 'Formal DiningRoom'),
(35, 'Terrace'),
(36, 'Patio'),
(37, 'Dining Alcove'),
(38, 'Eat-in kitchen'),
(39, 'windowed kitchen'),
(40, 'Galley Kitchen'),
(41, 'Island Kitchen'),
(42, 'Chef’s Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `building_features`
--

CREATE TABLE `building_features` (
  `id` bigint(20) NOT NULL,
  `feature_name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `building_features`
--

INSERT INTO `building_features` (`id`, `feature_name`) VALUES
(1, 'Pets Allowed'),
(2, 'Court Yard'),
(3, 'Roof Deck'),
(4, 'Concierge'),
(5, 'F/T Doorman'),
(6, 'P/T Doorman'),
(7, 'Elevator'),
(8, 'Walk-up Building'),
(9, 'Wheelchair access'),
(10, 'Laundry in building'),
(11, 'smoke free'),
(12, 'Garage Parking'),
(13, 'Valet Parking'),
(14, 'Bike room'),
(15, 'cold storage'),
(16, 'Package Room'),
(17, 'Children’s Playroom'),
(18, 'Gym'),
(19, 'Media Room'),
(20, 'Recreation Room'),
(21, 'Swimming Pool'),
(22, 'Prewar'),
(23, ' New Development Garden'),
(24, 'Live-in super'),
(25, 'Lounge');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `client_image` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `delete_conversation`
--

CREATE TABLE `delete_conversation` (
  `id` bigint(20) NOT NULL,
  `delete_1` int(11) DEFAULT NULL,
  `delete_2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_video` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin_email` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_line_1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_line_2` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fb_appID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `fd_secretKey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_appID` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_secretKey` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_host` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_port` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_protocol` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_username` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `smtp_password` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `title`, `logo`, `site_video`, `instagram`, `twitter`, `facebook`, `admin_email`, `email`, `address_line_1`, `address_line_2`, `city`, `country`, `state`, `postcode`, `fb_appID`, `fd_secretKey`, `stripe_appID`, `stripe_secretKey`, `smtp_host`, `smtp_port`, `smtp_protocol`, `smtp_username`, `smtp_password`, `remember_token`, `created_at`, `updated_at`) VALUES
(8, 'MARKET PLACE WEBSITE', '1572590747.svg', 'Time_Lapse_House_Clouds_1B.mp4', 'https://www.instagram.com/', 'https://twitter.com/', 'https://www.facebook.com/', 'manpreetvision@gmail.com', 'info@agentsconnect.us', 'SAHA', 'SAHA', '1267', '101', '14', '101', 'djvhfj', '547', '4365', 'njhmnjhm', 'smtp.gmail.com', '589', 'OFF', 'bvn@gfh.hj', '1234456456', NULL, '2018-08-16 06:14:35', '2019-11-01 06:45:47');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double DEFAULT NULL,
  `paid` tinyint(1) DEFAULT NULL,
  `subscription_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_payment` timestamp NULL DEFAULT NULL,
  `next_payment` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `package_id`, `package_name`, `title`, `price`, `paid`, `subscription_id`, `transaction_id`, `last_payment`, `next_payment`, `status`, `created_at`, `updated_at`) VALUES
(1, 100, 2, '1 Month Membership #1', 'Invoice Order #1', 35, 1, 'I-JB1EPC3CUPRV', '', '2019-08-10 13:46:24', '2019-09-10 13:46:24', NULL, '2019-08-10 13:46:24', '2019-08-10 13:46:24'),
(2, 101, 2, '1 Month Membership #2', 'Invoice Order #2', 35, 1, 'I-2BGT0HMH2FLX', '', '2019-08-10 14:35:08', '2019-09-10 14:35:08', NULL, '2019-08-10 14:35:08', '2019-08-10 14:35:08'),
(3, 104, 4, '12 Months Membership #3', 'Invoice Order #3', 250, 1, 'I-H1J06X6FD17G', '', '2019-08-12 05:54:51', '2019-09-12 05:54:51', NULL, '2019-08-12 05:54:51', '2019-08-12 05:54:51'),
(4, 105, 3, '6 Months Membership #4', 'Invoice Order #4', 150, 1, 'I-SCR0A21LNBLN', '', '2019-08-12 05:56:31', '2019-09-12 05:56:31', NULL, '2019-08-12 05:56:31', '2019-08-12 05:56:31'),
(5, 106, 4, '12 Months Membership #5', 'Invoice Order #5', 250, 1, 'I-36YL17T1NC07', '', '2019-08-12 05:58:01', '2019-09-12 05:58:01', NULL, '2019-08-12 05:58:01', '2019-08-12 05:58:01'),
(6, 107, 2, '1 Month Membership #6', 'Invoice Order #6', 35, 1, 'I-29JH4F95DLPH', '', '2019-08-12 06:07:45', '2019-09-12 06:07:45', NULL, '2019-08-12 06:07:45', '2019-08-12 06:07:45'),
(7, 109, 3, '6 Months Membership #7', 'Invoice Order #7', 150, 1, 'I-PTW7X5C8P06S', '', '2019-08-12 06:27:36', '2019-09-12 06:27:36', NULL, '2019-08-12 06:27:36', '2019-08-12 06:27:36'),
(8, 112, 4, '12 Months Membership #8', 'Invoice Order #8', 240, 1, 'I-CPBBJH9FG75G', '', '2019-08-14 04:34:21', '2019-09-14 04:34:21', NULL, '2019-08-14 04:34:21', '2019-08-14 04:34:21'),
(9, 102, 4, '12 Months Membership #9', 'Invoice Order #9', 240, 1, 'I-S9J3S7D3RH6R', '', '2019-08-14 05:03:50', '2019-09-14 05:03:50', NULL, '2019-08-14 05:03:50', '2019-08-14 05:03:50'),
(10, 115, 3, '6 Months Membership #10', 'Invoice Order #10', 150, 1, 'I-4C714JVYWGSD', '', '2019-08-14 05:25:51', '2019-09-14 05:25:51', NULL, '2019-08-14 05:25:51', '2019-08-14 05:25:51'),
(11, 116, 2, '1 Month Membership #11', 'Invoice Order #11', 35, 1, 'I-H39YC3NEXWMA', '', '2019-08-14 05:32:12', '2019-09-14 05:32:12', NULL, '2019-08-14 05:32:12', '2019-08-14 05:32:12'),
(12, 118, 2, '1 Month Membership #12', 'Invoice Order #12', 35, 1, 'I-9K058VT5KPAK', '', '2019-08-14 05:58:32', '2019-09-14 05:58:32', NULL, '2019-08-14 05:58:32', '2019-08-14 05:58:32'),
(13, 119, 3, '6 Months Membership #13', 'Invoice Order #13', 150, 1, 'I-4K9H33A9NM34', '', '2019-08-14 06:16:18', '2019-09-14 06:16:18', NULL, '2019-08-14 06:16:18', '2019-08-14 06:16:18'),
(14, 120, 3, '6 Months Membership #14', 'Invoice Order #14', 150, 1, 'I-Y01RF1U8J4EW', '', '2019-08-14 07:14:17', '2019-09-14 07:14:17', NULL, '2019-08-14 07:14:17', '2019-08-14 07:14:17'),
(15, 122, 4, '12 Months Membership #15', 'Invoice Order #15', 240, 1, 'I-XJMGHJMXUT66', '', '2019-08-14 07:43:14', '2019-09-14 07:43:14', NULL, '2019-08-14 07:43:14', '2019-08-14 07:43:14'),
(16, 121, 2, '1 Month Membership #16', 'Invoice Order #16', 35, 1, 'I-HUXF2MW23AEH', '', '2019-08-14 07:49:46', '2019-09-14 07:49:46', NULL, '2019-08-14 07:49:46', '2019-08-14 07:49:46'),
(17, 124, 2, '1 Month Membership #17', 'Invoice Order #17', 35, 1, 'I-S74WU4AW3RFJ', '', '2019-08-14 12:43:10', '2019-09-14 12:43:10', NULL, '2019-08-14 12:43:10', '2019-08-14 12:43:10'),
(18, 127, 2, '1 Month Membership #18', 'Invoice Order #18', 35, 1, 'I-9TXG6DTNWWUN', '', '2019-08-19 05:20:46', '2019-09-19 05:20:46', NULL, '2019-08-19 05:20:46', '2019-08-19 05:20:46'),
(19, 128, 2, '1 Month Membership #19', 'Invoice Order #19', 35, 1, 'I-46R3J0E70J4D', '', '2019-08-19 05:34:40', '2019-09-19 05:34:40', 0, '2019-08-19 05:34:40', '2020-01-07 08:34:00'),
(20, 129, 3, '6 Months Membership #20', 'Invoice Order #20', 150, 1, 'I-0MV8VRET0YF4', '', '2019-08-19 13:33:57', '2019-09-19 13:33:57', NULL, '2019-08-19 13:33:57', '2019-08-19 13:33:57'),
(21, 132, 3, '6 Months Membership #21', 'Invoice Order #21', 150, 1, 'I-MLFTM87TJUEU', '', '2019-08-24 07:32:54', '2019-09-24 07:32:54', NULL, '2019-08-24 07:32:54', '2019-08-24 07:32:54'),
(22, 133, 2, '1 Month Membership #22', 'Invoice Order #22', 35, 1, 'I-4XRV1UFD1K2L', '', '2019-08-29 05:37:10', '2019-09-29 05:37:10', NULL, '2019-08-29 05:37:10', '2019-08-29 05:37:10'),
(23, 134, 4, '12 Months Membership #23', 'Invoice Order #23', 240, 1, 'I-90C4L0AHY5JM', '', '2019-08-29 05:51:59', '2019-09-29 05:51:59', NULL, '2019-08-29 05:51:59', '2019-08-29 05:51:59'),
(24, 136, 3, '6 Months Membership #24', 'Invoice Order #24', 150, 1, 'I-LVSG5VBXRA4A', '', '2019-08-30 14:23:36', '2019-09-30 14:23:36', NULL, '2019-08-30 14:23:36', '2019-08-30 14:23:36'),
(25, 137, 2, '1 Month Membership #25', 'Invoice Order #25', 35, 1, 'I-4J2GPJYE5BB7', '', '2019-09-03 04:05:56', '2019-10-03 04:05:56', NULL, '2019-09-03 04:05:56', '2019-09-03 04:05:56'),
(26, 138, 2, '1 Month Membership #26', 'Invoice Order #26', 35, 1, 'I-XSW7WW0VL5CF', '', '2019-09-05 07:26:06', '2019-10-05 07:26:06', NULL, '2019-09-05 07:26:06', '2019-09-05 07:26:06'),
(27, 139, 4, '12 Months Membership #27', 'Invoice Order #27', 240, 1, 'I-TXWN1MXJMHX5', '', '2019-09-05 07:51:56', '2019-10-05 07:51:56', NULL, '2019-09-05 07:51:56', '2019-09-05 07:51:56'),
(28, 140, 2, '1 Month Membership #28', 'Invoice Order #28', 35, 1, 'I-8E0CL53SHL9N', '', '2019-09-07 05:50:33', '2019-10-07 05:50:33', NULL, '2019-09-07 05:50:33', '2019-09-07 05:50:33'),
(29, -88, NULL, 'kl', 'io', 9, 1, '', '', NULL, NULL, NULL, NULL, NULL),
(30, 145, 2, '1 Month Membership #30', 'Invoice Order #30', 35, 1, 'I-NVHE6UPYFXXH', '', '2019-09-09 13:08:57', '2019-10-09 13:08:57', NULL, '2019-09-09 13:08:57', '2019-09-09 13:08:57'),
(31, -888, 34, 'ew', 'sd', 343, 1, '', '', NULL, NULL, NULL, NULL, NULL),
(32, 147, 3, '6 Months Membership #32', 'Invoice Order #32', 150, 1, 'I-E4W7049YWUMK', '', '2019-09-09 13:23:31', '2019-10-09 13:23:31', NULL, '2019-09-09 13:23:31', '2019-09-09 13:23:31'),
(33, 148, 3, '6 Months Membership #33', 'Invoice Order #33', 150, 1, 'I-URK22AWPPMKN', '', '2019-09-09 13:25:28', '2019-10-09 13:25:28', NULL, '2019-09-09 13:25:28', '2019-09-09 13:25:28'),
(34, 149, 3, '6 Months Membership #34', 'Invoice Order #34', 150, 1, 'I-6ALF4WH3FRRW', '', '2019-09-09 13:27:08', '2019-10-09 13:27:08', NULL, '2019-09-09 13:27:08', '2019-09-09 13:27:08'),
(35, 151, 2, '1 Month Membership #35', 'Invoice Order #35', 35, 1, 'I-7GF85N4KCK2H', '', '2019-09-09 13:28:40', '2019-10-09 13:28:40', NULL, '2019-09-09 13:28:40', '2019-09-09 13:28:40'),
(36, 155, 2, '1 Month Membership #36', 'Invoice Order #36', 35, 1, 'I-HAHVM6YTF9PE', '', '2019-09-09 13:33:33', '2019-10-09 13:33:33', NULL, '2019-09-09 13:33:33', '2019-09-09 13:33:33'),
(37, 156, 2, '1 Month Membership #37', 'Invoice Order #37', 35, 1, 'I-W1H6P503C5WY', '', '2019-09-09 13:35:40', '2019-10-09 13:35:40', NULL, '2019-09-09 13:35:40', '2019-09-09 13:35:40'),
(58, 163, 3, '6 Months Membership #58', 'Invoice Order #58', 150, 1, 'I-BWC0RA1U386S', '', '2019-09-09 14:24:00', '2019-10-09 14:24:00', NULL, '2019-09-09 14:24:00', '2019-09-09 14:24:00'),
(59, 164, 2, '1 Month Membership #59', 'Invoice Order #59', 35, 1, 'I-FA46RFTR92B9', '', '2019-09-09 14:25:47', '2019-10-09 14:25:47', NULL, '2019-09-09 14:25:47', '2019-09-09 14:25:47'),
(60, 165, 2, '1 Month Membership #40', 'Invoice Order #40', 35, 1, 'I-L9AXEUEA0RRV', '', '2019-09-09 14:30:01', '2019-10-09 14:30:01', NULL, '2019-09-09 14:30:01', '2019-09-09 14:30:01'),
(61, 166, 2, '1 Month Membership #41', 'Invoice Order #41', 35, 1, 'I-81078HNWAMA5', '', '2019-09-10 04:41:10', '2019-10-10 04:41:10', NULL, '2019-09-10 04:41:10', '2019-09-10 04:41:10'),
(62, 167, 2, '1 Month Membership #42', 'Invoice Order #42', 35, 1, 'I-YBRKBL2A4SAM', '', '2019-09-10 05:40:03', '2019-10-10 05:40:03', NULL, '2019-09-10 05:40:03', '2019-09-10 05:40:03'),
(63, 167, 3, '6 Months Membership #43', 'Invoice Order #43', 150, 1, 'I-46BVKB7FVFNT', '', '2019-09-10 06:12:44', '2019-10-10 06:12:44', NULL, '2019-09-10 06:12:44', '2019-09-10 06:12:44'),
(64, 167, 2, '1 Month Membership #44', 'Invoice Order #44', 35, 1, 'I-93K5Y2MS4NYL', '', '2019-09-10 06:14:13', '2019-10-10 06:14:13', NULL, '2019-09-10 06:14:13', '2019-09-10 06:14:13'),
(65, 167, 2, '1 Month Membership #45', 'Invoice Order #45', 35, 1, 'I-A8Y0WW828JAB', '', '2019-09-10 06:17:55', '2019-10-10 06:17:55', NULL, '2019-09-10 06:17:55', '2019-09-10 06:17:55'),
(66, 167, 4, '12 Months Membership #46', 'Invoice Order #46', 240, 1, 'I-ETCJFLFS1WN4', '', '2019-09-10 06:22:02', '2019-10-10 06:22:02', NULL, '2019-09-10 06:22:02', '2019-09-10 06:22:02'),
(67, 168, 2, '1 Month Membership #47', 'Invoice Order #47', 35, 1, 'I-JM549D80138E', '', '2019-09-10 06:53:45', '2019-10-10 06:53:45', NULL, '2019-09-10 06:53:45', '2019-09-10 06:53:45'),
(77, 172, 2, '1 Month Membership #57', 'Invoice Order #57', 35, 1, 'I-HCV5BGS9VELK', '', '2019-09-10 07:20:39', '2019-10-10 07:20:39', NULL, '2019-09-10 07:20:39', '2019-09-10 07:20:39'),
(78, 174, 3, '6 Months Membership #58', 'Invoice Order #58', 150, 1, 'I-P54UJ36MUAN7', '', '2019-09-10 07:25:30', '2019-10-10 07:25:30', NULL, '2019-09-10 07:25:30', '2019-09-10 07:25:30'),
(79, 174, 4, '12 Months Membership #59', 'Invoice Order #59', 240, 1, 'I-5GE67N0GXN4A', '', '2019-09-10 07:26:26', '2019-10-10 07:26:26', NULL, '2019-09-10 07:26:26', '2019-09-10 07:26:26'),
(83, 174, 4, '12 Months Membership #63', 'Invoice Order #63', 240, 1, 'I-XM1548381H92', '', '2019-09-10 07:44:16', '2019-10-10 07:44:16', NULL, '2019-09-10 07:44:16', '2019-09-10 07:44:16'),
(84, 174, 4, '12 Months Membership #64', 'Invoice Order #64', 240, 1, 'I-UBXAHXH5N9HY', '', '2019-09-10 07:47:57', '2020-09-10 07:47:57', NULL, '2019-09-10 07:47:57', '2019-09-10 07:47:57'),
(85, 174, 3, '6 Months Membership #65', 'Invoice Order #65', 150, 1, 'I-3EBTV945HRUK', '', '2019-09-10 07:48:49', '2020-03-10 07:48:49', NULL, '2019-09-10 07:48:49', '2019-09-10 07:48:49'),
(86, 111, 3, '6 Months Membership #66', 'Invoice Order #66', 150, 1, 'I-CRTFFDA2CM9C', '', '2019-09-10 07:52:34', '2020-03-10 07:52:34', 0, '2019-09-10 07:52:34', '2019-10-14 12:29:17'),
(87, 175, 2, '1 Month Membership #67', 'Invoice Order #67', 35, 1, 'I-FXM3N1U5R6XL', '', '2019-09-11 06:28:10', '2019-10-11 06:28:10', NULL, '2019-09-11 06:28:10', '2019-09-11 06:28:10'),
(88, 176, 2, '1 Month Membership #68', 'Invoice Order #68', 35, 1, 'I-VF65A013T31A', '', '2019-09-11 06:54:12', '2019-10-11 06:54:12', NULL, '2019-09-11 06:54:12', '2019-09-11 06:54:12'),
(89, 183, 2, '1 Month Membership #69', 'Invoice Order #69', 35, 1, 'I-KV2E05ET4RCD', '', '2019-09-19 13:49:44', '2019-10-19 13:49:44', NULL, '2019-09-19 13:49:44', '2019-09-19 13:49:44'),
(90, 186, 3, '6 Months Membership #70', 'Invoice Order #70', 150, 1, 'I-USVDCNES7A1V', '', '2019-10-01 08:47:50', '2020-04-01 08:47:50', NULL, '2019-10-01 08:47:50', '2019-10-01 08:47:50'),
(91, 111, 3, '6 Months Membership #59', 'Invoice Order #59', 150, 1, 'I-UVMRB29T5RKU', '', '2019-10-10 13:35:55', '2020-04-10 13:35:55', 0, '2019-10-10 13:35:55', '2019-10-14 12:29:17'),
(92, 111, 2, '1 Month Membership #60', 'Invoice Order #60', 35, 1, 'I-D97FXH3FTCKR', '', '2019-10-10 13:40:51', '2019-11-10 13:40:51', 0, '2019-10-10 13:40:51', '2019-10-14 12:29:17'),
(93, 187, 4, '12 Months Membership #61', 'Invoice Order #61', 240, 1, 'I-X27R7RYM73CW', '', '2019-10-10 14:16:10', '2020-10-10 14:16:10', 0, '2019-10-10 14:16:10', '2019-10-10 14:17:33'),
(94, 187, 3, '6 Months Membership #62', 'Invoice Order #62', 150, 1, 'I-R9YX7HD30GF6', '', '2019-10-10 14:17:33', '2020-04-10 14:17:33', 1, '2019-10-10 14:17:33', '2019-10-10 14:17:33'),
(95, 15, 3, '6 Months Membership #63', 'Invoice Order #63', 150, 1, 'I-KU5B11RRDHJ9', '', '2019-10-10 14:43:19', '2020-04-10 14:43:19', 1, '2019-10-10 14:43:19', '2019-10-10 14:43:19'),
(96, 29, 2, '1 Month Membership #64', 'Invoice Order #64', 35, 1, 'I-M3UHXD46187S', '', '2019-10-14 08:34:21', '2019-11-14 08:34:21', 0, '2019-10-14 08:34:21', '2019-11-21 12:48:11'),
(97, 29, 3, '6 Months Membership #65', 'Invoice Order #65', 150, 1, 'I-YWBARY5KR8PS', '', '2019-10-14 08:35:40', '2020-04-14 08:35:40', 0, '2019-10-14 08:35:40', '2019-11-21 12:48:11'),
(98, 29, 4, '12 Months Membership #66', 'Invoice Order #66', 240, 1, 'I-KE7X26B6YNN2', '', '2019-10-14 08:36:25', '2020-10-14 08:36:25', 0, '2019-10-14 08:36:25', '2019-11-21 12:48:11'),
(99, 188, 2, '1 Month Membership #67', 'Invoice Order #67', 35, 1, 'I-WH9HFECLEH43', '', '2019-10-14 08:41:24', '2019-11-14 08:41:24', 1, '2019-10-14 08:41:24', '2019-10-14 08:41:24'),
(100, 111, 3, '6 Months Membership #68', 'Invoice Order #68', 150, 1, 'I-S3AYE0H2NFJ2', '', '2019-10-14 12:05:37', '2020-04-14 12:05:37', 0, '2019-10-14 12:05:37', '2019-10-14 12:29:17'),
(101, 111, 4, '12 Months Membership #69', 'Invoice Order #69', 240, 1, 'I-VP0JCB875V3F', '', '2019-10-14 12:29:17', '2020-10-14 12:29:17', 1, '2019-10-14 12:29:18', '2019-10-14 12:29:18'),
(102, 29, 2, '1 Month Membership #70', 'Invoice Order #70', 35, 1, 'I-MMX8BNCD0LFU', '', '2019-10-16 13:37:47', '2019-11-16 13:37:47', 0, '2019-10-16 13:37:47', '2019-11-21 12:48:11'),
(103, 189, 3, '6 Months Membership #71', 'Invoice Order #71', 150, 1, 'I-XMTNTG533SDC', '', '2019-11-05 07:29:25', '2020-05-05 07:29:25', 1, '2019-11-05 07:29:25', '2019-11-05 07:29:25'),
(104, 190, 3, '6 Months Membership #72', 'Invoice Order #72', 150, 1, 'I-RRLLVBLT4579', '', '2019-11-07 14:34:52', '2020-05-07 14:34:52', 1, '2019-11-07 14:34:52', '2019-11-07 14:34:52'),
(105, 191, 2, '1 Month Membership #73', 'Invoice Order #73', 35, 1, 'I-KTAUV2TM98H4', '', '2019-11-13 05:19:43', '2019-12-13 05:19:43', 1, '2019-11-13 05:19:43', '2019-11-13 05:19:43'),
(106, 192, 2, '1 Month Membership #74', 'Invoice Order #74', 35, 1, 'I-63NDGXB8DEKX', '', '2019-11-15 05:11:41', '2019-12-15 05:11:41', 1, '2019-11-15 05:11:41', '2019-11-15 05:11:41'),
(107, 193, 2, '1 Month Membership #75', 'Invoice Order #75', 35, 1, 'I-SWXX99C90LDF', '', '2019-11-15 05:14:39', '2019-12-15 05:14:39', 1, '2019-11-15 05:14:39', '2019-11-15 05:14:39'),
(108, 29, 3, '6 Months Membership #76', 'Invoice Order #76', 150, 1, 'I-MKTX4TBT60CU', '', '2019-11-21 12:48:11', '2020-05-21 12:48:11', 1, '2019-11-21 12:48:11', '2019-11-21 12:48:11'),
(109, 128, 2, '1 Month Membership #77', 'Invoice Order #77', 35, 1, 'I-S1A232HJ2RXL', '', '2020-01-07 08:34:00', '2020-02-07 08:34:00', 1, '2020-01-07 08:34:01', '2020-01-07 08:34:01');

-- --------------------------------------------------------

--
-- Table structure for table `invoices-old`
--

CREATE TABLE `invoices-old` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `subscription_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices-old`
--

INSERT INTO `invoices-old` (`id`, `user_id`, `title`, `price`, `paid`, `subscription_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
(1, 0, 'Order #1 Invoice', 19.97, 1, '', '', '2019-07-27 02:26:24', '2019-07-27 02:26:24'),
(2, 0, 'Order #2 Invoice', 19.97, 1, '', '', '2019-07-27 02:38:34', '2019-07-27 02:38:34'),
(3, 0, 'Order #3 Invoice', 19.97, 1, '', '', '2019-07-27 02:40:42', '2019-07-27 02:40:42'),
(4, 0, 'Order #4 Invoice', 0, 1, '', '', '2019-07-27 02:45:54', '2019-07-27 02:45:54'),
(5, 0, 'Order #5 Invoice', 0, 1, '', '', '2019-07-27 02:56:04', '2019-07-27 02:56:04'),
(6, 0, 'as', 55, 1, '', '', NULL, NULL),
(7, 0, 'Order #7 Invoice', 120, 1, 'I-YT0YADN7BRRN', '', '2019-07-27 07:21:38', '2019-07-27 07:21:38'),
(8, 0, 'Order #8 Invoice', 120, 1, 'I-LAXSUMWBU35K', '', '2019-07-27 07:22:23', '2019-07-27 07:22:23'),
(9, 0, 'Order #9 Invoice', 70, 1, 'I-SJ6YH4G3HNKG', '', '2019-07-27 07:25:36', '2019-07-27 07:25:36'),
(10, 48, 'Order #10 Invoice', 70, 1, 'I-G3M76PLY9RBW', '', '2019-07-27 07:31:42', '2019-07-27 07:31:42'),
(11, 48, 'Order #11 Invoice', 120, 1, 'I-5VHRYS82AVF2', '', '2019-07-27 07:41:31', '2019-07-27 07:41:31'),
(12, 48, 'Order #12 Invoice', 40, 1, 'I-F36WHJMKUT5C', '', '2019-07-27 07:43:08', '2019-07-27 07:43:08'),
(13, 48, 'Order #13 Invoice', 40, 1, 'I-ECPED6875RSJ', '', '2019-07-27 07:45:02', '2019-07-27 07:45:02'),
(14, 48, 'Order #14 Invoice', 40, 1, 'I-GLWT73FX026E', '', '2019-07-27 07:47:53', '2019-07-27 07:47:53'),
(15, 48, 'Order #15 Invoice', 120, 1, 'I-GKURJ4C5FKHX', '', '2019-07-27 07:50:39', '2019-07-27 07:50:39'),
(16, 48, 'Order #16 Invoice', 70, 1, 'I-DLCJN967TPF9', '', '2019-07-27 07:53:24', '2019-07-27 07:53:24'),
(17, 49, 'Order #17 Invoice', 546, 1, 'I-5V5Y04Y1STT1', '', '2019-07-27 14:05:42', '2019-07-27 14:05:42'),
(18, 50, 'Order #18 Invoice', 546, 1, 'I-FG2UTNSX9PP4', '', '2019-07-27 14:07:55', '2019-07-27 14:07:55'),
(19, 57, 'Order #19 Invoice', 4, 1, 'I-3FDM2D0NPWHY', '', '2019-07-29 09:11:20', '2019-07-29 09:11:20'),
(20, 63, 'Order #20 Invoice', 4, 1, 'I-FYRJ9NUS3230', '', '2019-07-29 11:38:06', '2019-07-29 11:38:06'),
(21, 64, 'Order #21 Invoice', 4, 1, 'I-VV6DRHDUE1TR', '', '2019-07-29 12:30:50', '2019-07-29 12:30:50'),
(22, 66, 'Order #22 Invoice', 4, 1, 'I-SF5KKJMYHAPF', '', '2019-07-29 14:14:47', '2019-07-29 14:14:47'),
(23, 67, 'Order #23 Invoice', 455, 1, 'I-1Y311071NW86', '', '2019-07-30 04:41:22', '2019-07-30 04:41:22'),
(24, 68, 'Order #24 Invoice', 4, 1, 'I-20GSE2PHEFVM', '', '2019-07-30 06:21:39', '2019-07-30 06:21:39'),
(25, 69, 'Order #25 Invoice', 4, 1, 'I-7C99SH9T2N3M', '', '2019-08-01 05:43:44', '2019-08-01 05:43:44'),
(26, 70, 'Order #26 Invoice', 4, 1, 'I-09MSS3N8L60W', '', '2019-08-02 00:02:08', '2019-08-02 00:02:08'),
(27, 71, 'Order #27 Invoice', 4, 1, 'I-CK0GHJH0JBUA', '', '2019-08-02 10:47:13', '2019-08-02 10:47:13'),
(28, 83, 'Order #28 Invoice', 4, 1, 'I-A58913HXS2Y4', '', '2019-08-05 07:00:29', '2019-08-05 07:00:29'),
(29, 87, 'Order #29 Invoice', 455, 1, 'I-PMAP906NCRW6', '', '2019-08-07 13:42:56', '2019-08-07 13:42:56'),
(30, 88, 'Order #30 Invoice', 4, 1, 'I-DK041BYVLV81', '', '2019-08-09 05:31:42', '2019-08-09 05:31:42'),
(31, 90, 'Order #31 Invoice', 546, 1, 'I-DF99S04G74MN', '', '2019-08-09 06:08:38', '2019-08-09 06:08:38'),
(32, 91, 'Order #32 Invoice', 4, 1, 'I-HSD26BC71MM0', '', '2019-08-09 06:18:32', '2019-08-09 06:18:32'),
(33, 92, 'Order #33 Invoice', 4, 1, 'I-KXF6YPDEEX61', '', '2019-08-09 06:24:02', '2019-08-09 06:24:02'),
(34, 93, 'Order #34 Invoice', 455, 1, 'I-VX588BDE5NEH', '', '2019-08-09 06:28:12', '2019-08-09 06:28:12'),
(35, 97, 'Order #35 Invoice', 4, 1, 'I-Y35H5R8AJP5M', '', '2019-08-10 04:47:30', '2019-08-10 04:47:30');

-- --------------------------------------------------------

--
-- Table structure for table `ipn_status`
--

CREATE TABLE `ipn_status` (
  `id` int(10) UNSIGNED NOT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_price` double NOT NULL,
  `item_qty` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `invoice_id`, `item_name`, `item_price`, `item_qty`, `created_at`, `updated_at`) VALUES
(1, 1, '1 Month Membership #1', 35, 1, '2019-08-10 13:46:25', '2019-08-10 13:46:25'),
(2, 2, '1 Month Membership #2', 35, 1, '2019-08-10 14:35:08', '2019-08-10 14:35:08'),
(3, 3, '12 Months Membership #3', 250, 1, '2019-08-12 05:54:51', '2019-08-12 05:54:51'),
(4, 4, '6 Months Membership #4', 150, 1, '2019-08-12 05:56:31', '2019-08-12 05:56:31'),
(5, 5, '12 Months Membership #5', 250, 1, '2019-08-12 05:58:02', '2019-08-12 05:58:02'),
(6, 6, '1 Month Membership #6', 35, 1, '2019-08-12 06:07:45', '2019-08-12 06:07:45'),
(7, 7, '6 Months Membership #7', 150, 1, '2019-08-12 06:27:36', '2019-08-12 06:27:36'),
(8, 8, '12 Months Membership #8', 240, 1, '2019-08-14 04:34:21', '2019-08-14 04:34:21'),
(9, 9, '12 Months Membership #9', 240, 1, '2019-08-14 05:03:50', '2019-08-14 05:03:50'),
(10, 10, '6 Months Membership #10', 150, 1, '2019-08-14 05:25:51', '2019-08-14 05:25:51'),
(11, 11, '1 Month Membership #11', 35, 1, '2019-08-14 05:32:12', '2019-08-14 05:32:12'),
(12, 12, '1 Month Membership #12', 35, 1, '2019-08-14 05:58:32', '2019-08-14 05:58:32'),
(13, 13, '6 Months Membership #13', 150, 1, '2019-08-14 06:16:18', '2019-08-14 06:16:18'),
(14, 14, '6 Months Membership #14', 150, 1, '2019-08-14 07:14:17', '2019-08-14 07:14:17'),
(15, 15, '12 Months Membership #15', 240, 1, '2019-08-14 07:43:14', '2019-08-14 07:43:14'),
(16, 16, '1 Month Membership #16', 35, 1, '2019-08-14 07:49:46', '2019-08-14 07:49:46'),
(17, 17, '1 Month Membership #17', 35, 1, '2019-08-14 12:43:10', '2019-08-14 12:43:10'),
(18, 18, '1 Month Membership #18', 35, 1, '2019-08-19 05:20:46', '2019-08-19 05:20:46'),
(19, 19, '1 Month Membership #19', 35, 1, '2019-08-19 05:34:40', '2019-08-19 05:34:40'),
(20, 20, '6 Months Membership #20', 150, 1, '2019-08-19 13:33:57', '2019-08-19 13:33:57'),
(21, 21, '6 Months Membership #21', 150, 1, '2019-08-24 07:32:54', '2019-08-24 07:32:54'),
(22, 22, '1 Month Membership #22', 35, 1, '2019-08-29 05:37:10', '2019-08-29 05:37:10'),
(23, 23, '12 Months Membership #23', 240, 1, '2019-08-29 05:51:59', '2019-08-29 05:51:59'),
(24, 24, '6 Months Membership #24', 150, 1, '2019-08-30 14:23:36', '2019-08-30 14:23:36'),
(25, 25, '1 Month Membership #25', 35, 1, '2019-09-03 04:05:56', '2019-09-03 04:05:56'),
(26, 26, '1 Month Membership #26', 35, 1, '2019-09-05 07:26:06', '2019-09-05 07:26:06'),
(27, 27, '12 Months Membership #27', 240, 1, '2019-09-05 07:51:56', '2019-09-05 07:51:56'),
(28, 28, '1 Month Membership #28', 35, 1, '2019-09-07 05:50:33', '2019-09-07 05:50:33'),
(29, 30, '1 Month Membership #30', 35, 1, '2019-09-09 13:08:57', '2019-09-09 13:08:57'),
(30, 32, '6 Months Membership #32', 150, 1, '2019-09-09 13:23:31', '2019-09-09 13:23:31'),
(31, 33, '6 Months Membership #33', 150, 1, '2019-09-09 13:25:28', '2019-09-09 13:25:28'),
(32, 34, '6 Months Membership #34', 150, 1, '2019-09-09 13:27:08', '2019-09-09 13:27:08'),
(33, 35, '1 Month Membership #35', 35, 1, '2019-09-09 13:28:40', '2019-09-09 13:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `message` longtext,
  `file` varchar(255) DEFAULT NULL,
  `delete_1` int(11) DEFAULT NULL,
  `delete_2` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(2, '2014_10_12_100000_create_password_resets_table', 2),
(3, '2019_07_10_080217_create_property_images_table', 3),
(4, '2019_09_12_052356_create_requirement_views_table', 4),
(5, '2019_09_12_052442_create_requirement_table', 5),
(6, '2019_09_12_052521_create_property_views_table', 6),
(7, '2019_09_12_052553_create_pages_table', 7),
(8, '2019_09_12_052630_create_items_table', 8),
(9, '2019_09_12_052703_create_ipn_status_table', 9),
(10, '2019_09_12_052734_create_invoices-old_table', 10),
(11, '2019_09_12_052806_create_invoices_table', 11),
(12, '2019_09_12_052835_create_general_settings_table', 12),
(13, '2019_09_12_052913_create_client_table', 13),
(14, '2019_09_12_052940_create_amenities_table', 14),
(15, '2019_09_12_053028_create_transaction_table', 15),
(16, '2019_09_12_062623_create_transaction_old_table', 16),
(17, '2019_09_12_063420_create_testimonial_table', 17),
(18, '2019_09_12_065121_create_property_list_table', 18),
(19, '2019_09_12_073617_create_slider_table', 19),
(20, '2019_09_12_133807_create_subscription_table.php', 20);

-- --------------------------------------------------------

--
-- Table structure for table `msg_list`
--

CREATE TABLE `msg_list` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reciver_id` int(11) NOT NULL,
  `last_message_id` bigint(20) DEFAULT NULL,
  `delete_status` int(3) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci,
  `status` int(11) NOT NULL,
  `meta_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `content`, `slug`, `status`, `meta_key`, `meta_value`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'About Us', '<h2 style=\"font-style:normal\">What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'about-us', 1, 'About Us', 'About Us', NULL, '2018-08-16 08:22:44', '2019-08-12 13:59:57'),
(3, 'Terms and Conditions', '<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'terms-condition', 1, 'Terms and Conditions', 'Terms and Conditions', NULL, '2018-08-16 22:52:14', '2019-08-08 00:46:08'),
(4, 'Contact Us', '<p>he Argument Against Filler Text If you&rsquo;re thinking that filler text seems pretty boring and uncontroversial, you&rsquo;d be wrong. Surprisingly, there is a very vocal faction of the design community that wants to see filler text banished to the original sources from whence it came. Perhaps not surprisingly, in an era of endless quibbling, there is an equally vocal contingent of designers leaping to defend the use of the time-honored tradition of greeking. The argument in favor of using filler text goes something like this: If you use real content in the design process, anytime you reach a review point you&rsquo;ll end up reviewing and negotiating the content itself and not the design. This will just slow down the design process. Design first, with real content in mind (of course!), but don&rsquo;t drop in the real content until the design is well on its way. Using filler text avoids the inevitable argumentation that accompanies the use of real content in the design process. Those opposed to using filler text of any sort counter by saying: The ultimate purpose of any digital product, whether a website, app, or HTML email, is to showcase real content, not to showcase great design. You can&rsquo;t get a true sense for how your content plays with your design unless you us<br />\r\n<br />\r\nC/O https://placeholder.com/text/</p>', 'contact-us', 1, 'Contact Us', 'Contact Us', NULL, '2018-08-16 22:54:06', '2019-08-08 00:46:46'),
(5, 'Help Page', '<h2 style=\"font-style:normal\">What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'help-page', 1, 'Help Page', 'Help Page', NULL, '2018-08-16 22:54:30', '2019-08-12 14:00:34'),
(6, 'Reviews', '<p>xdzasaddddddddddddddddddddd</p>', 'reviews', 1, 'Reviews', 'Reviews', NULL, '2019-08-08 00:37:58', '2019-08-08 00:49:10'),
(7, 'Legal Notice', '<h2 style=\"font-style:normal\">What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', 'legal-notice', 1, 'Legal Notice', 'Legal Notice', NULL, '2019-08-08 00:49:58', '2019-08-12 14:01:04'),
(8, 'Affilates', '<p><a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">Affilates</a>&nbsp;</p>', 'Affilates', 1, 'Affilates ', 'Affilates ', NULL, '2019-08-08 00:50:32', '2019-08-08 00:50:43'),
(9, 'My Account', '<p><a href=\"http://localhost/amit_data/properties/public/#\">My Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My AccountMy Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My AccountMy Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My AccountMy Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My AccountMy Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My AccountMy Account</a>&nbsp;<a href=\"http://localhost/amit_data/properties/public/#\">My Account</a></p>', 'my-account', 1, 'My Account', 'My Account', NULL, '2019-08-08 00:51:33', '2019-08-08 00:51:33'),
(10, 'd', '<p>d</p>', NULL, 1, '', '', NULL, '2019-08-22 05:30:30', '2019-08-22 05:30:30'),
(11, 's', '<p>s</p>', 's', 1, '', '', NULL, '2019-08-22 05:33:20', '2019-08-22 05:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$gBZglXn4kiq2A1K3nUemyuBYVjv9D7H8EaoWk1N4xsyyidjBA5BH2', '2019-08-13 13:25:46'),
('pankajdheer071@gmail.com', '$2y$10$7PLHpPhv5BAASYIGIe7STe7rNZ7XIWB7FsdcKIDg7x4E3LtFpvoL2', '2019-09-05 06:40:08'),
('manpreetvision@gmail.com', '$2y$10$HWXmk.w8jH5ioMheVnZrcO/AOzvOgNmk5REhweTm4DZkJ5rwdEGae', '2019-09-05 06:44:18'),
('pankajdev@gmail.com', '$2y$10$tybi7L2ka7kODPGasvHEE.x8NFL7smxM.3.Bj.VgK/P4Qou8C53wS', '2019-09-05 07:12:02'),
('test3@gmail.com', '$2y$10$OSB/jMf7Ie6oNrkn8tecL.cXxSg1Q3FLMi4nT.A3mBVmae3ZCs2Mq', '2019-09-05 07:33:55');

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(11) NOT NULL,
  `image_name` varchar(225) NOT NULL,
  `property_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `image_name`, `property_id`, `created_by`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '5e1481da944da_1578402266_133.png', 160, 133, NULL, '2020-01-07 13:04:26', '2020-01-07 13:04:32');

-- --------------------------------------------------------

--
-- Table structure for table `property_list`
--

CREATE TABLE `property_list` (
  `id` int(11) NOT NULL,
  `property_type` varchar(100) DEFAULT NULL,
  `size` varchar(500) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `discription` varchar(3000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_name` varchar(200) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `address` text,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bathroom` int(11) DEFAULT NULL,
  `half_bathroom` varchar(50) DEFAULT NULL,
  `cross_streets` text,
  `amenities` varchar(300) DEFAULT NULL,
  `building_features` varchar(300) DEFAULT NULL,
  `local_area` varchar(225) DEFAULT NULL,
  `all_cash` varchar(50) DEFAULT 'no',
  `exchange` varchar(50) DEFAULT 'no',
  `cover_pic` varchar(150) DEFAULT NULL,
  `zipcode` varchar(150) DEFAULT NULL,
  `monthly_tax` bigint(20) DEFAULT NULL,
  `monthly_maintenance` bigint(20) DEFAULT NULL,
  `exposure` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_list`
--

INSERT INTO `property_list` (`id`, `property_type`, `size`, `price`, `rooms`, `discription`, `created_by`, `user_id`, `city_name`, `longitude`, `latitude`, `purpose`, `address`, `type`, `status`, `bathroom`, `half_bathroom`, `cross_streets`, `amenities`, `building_features`, `local_area`, `all_cash`, `exchange`, `cover_pic`, `zipcode`, `monthly_tax`, `monthly_maintenance`, `exposure`, `created_at`, `updated_at`, `title`, `client`) VALUES
(7, 'Multi Family Townhouse', '20000', 26500000, 27, 'Listing description coming soon!', 128, 128, '807 Park Avenue', '-73.9623541', '40.7726347', NULL, '807 Park Avenue', 'buy', 'active', 16, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 21785, 0, NULL, '2020-01-07 09:00:45', '2020-01-07 09:00:45', '14C', NULL),
(8, 'Condo', '4763', 23950000, 8, 'Listing description coming soon!', 128, 128, '275 West 10th Street', '-74.0079612', '40.7336877', NULL, '275 West 10th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 6620, 5055, NULL, '2020-01-07 09:00:46', '2020-01-07 09:00:46', 'Penthouse-B', NULL),
(9, 'Condo', '3420', 18000000, 4, 'Listing description coming soon!', 128, 128, '555 West End Avenue', '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 6594, 5744, NULL, '2020-01-07 09:00:47', '2020-01-07 09:00:47', 'Solarium Penthouse', NULL),
(10, 'Condo', '3463', 10500000, 7, 'Listing description coming soon!', 128, 128, '555 West End Avenue', '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 5342, 4653, NULL, '2020-01-07 09:00:47', '2020-01-07 09:00:47', 'The library', NULL),
(11, 'Condo', '3474', 10300000, 7, 'Listing description coming soon!', 128, 128, '555 West End Avenue', '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 0, NULL, '2020-01-07 09:00:48', '2020-01-07 09:00:48', '4E', NULL),
(12, 'Co-Op', '0', 9950000, 10, 'Listing description coming soon!', 128, 128, '910 Fifth Avenue', '-73.96663869999999', '40.7725174', NULL, '910 Fifth Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 13524, NULL, '2020-01-07 09:00:49', '2020-01-07 09:00:49', '14C', NULL),
(13, 'Condo', '3970', 9295000, 9, 'Listing description coming soon!', 128, 128, '141 East 88th Street', '-73.95431', '40.7807557', NULL, '141 East 88th Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 4410, 4934, NULL, '2020-01-07 09:00:50', '2020-01-07 09:00:50', 'Penthouse 11A', NULL),
(14, 'Condo', '2716', 7900000, 6, 'Listing description coming soon!', 128, 128, '555 West End Avenue', '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4189, 3650, NULL, '2020-01-07 09:00:50', '2020-01-07 09:00:50', '3W', NULL),
(15, 'Single Family Townhouse', '', 7500000, 0, 'Listing description coming soon!', 128, 128, '159 East 78th Street', '-73.9587707', '40.7742176', NULL, '159 East 78th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 3692, 0, NULL, '2020-01-07 09:00:51', '2020-01-07 09:00:51', '14C', NULL),
(16, 'Co-Op', '0', 7350000, 7, 'Listing description coming soon!', 128, 128, '300 Central Park West', '-73.9674607', '40.7882884', NULL, '300 Central Park West', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 5914, NULL, '2020-01-07 09:00:52', '2020-01-07 09:00:52', '14F', NULL),
(17, 'Condo', '2720', 7200000, 7, 'Listing description coming soon!', 129, 129, '210 West 77th Street', '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 5463, 2586, NULL, '2020-01-07 09:14:57', '2020-01-07 09:14:57', '11W', NULL),
(18, 'Condo', '2082', 5300000, 5, 'Listing description coming soon!', 129, 129, '210 West 77th Street', '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4174, 1979, NULL, '2020-01-07 09:14:58', '2020-01-07 09:14:58', '8E ', NULL),
(19, 'Single Family Townhouse', '5225', 11900000, 12, 'Listing description coming soon!', 129, 129, '211 East 62nd Street', '-73.9644509', '40.7632975', NULL, '211 East 62nd Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9667, 0, NULL, '2020-01-07 09:14:59', '2020-01-07 09:14:59', '', NULL),
(20, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 129, 129, '630 Park Avenue', '-73.9670704', '40.767228', NULL, '630 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 6732, NULL, '2020-01-07 09:14:59', '2020-01-07 09:14:59', '10C ', NULL),
(21, 'Co-Op', '', 1400000, 6, 'Listing description coming soon!', 129, 129, '66 East 79th Street', '-73.9614914', '40.7756749', NULL, '66 East 79th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5355, NULL, '2020-01-07 09:15:00', '2020-01-07 09:15:00', '2S ', NULL),
(22, 'Single Family Townhouse', '2555', 2200000, 8, 'Listing description coming soon!', 129, 129, '336 Park Avenue', '-73.9736375', '40.757825', NULL, '336 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 785, 0, NULL, '2020-01-07 09:15:01', '2020-01-07 09:15:01', '', NULL),
(23, 'Co-Op', '', 1900000, 7, 'Listing description coming soon!', 129, 129, '41 Eastern Parkway', '-73.9670704', '40.67316270000001', NULL, '41 Eastern Parkway', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Prospect Heights', 'no', 'no', NULL, '', 0, 2252, NULL, '2020-01-07 09:15:02', '2020-01-07 09:15:02', '4A', NULL),
(24, 'Condo', '1105', 1200000, 5, 'Listing description coming soon!', 129, 129, '320 Washington Avenue', '-73.9665194', '40.6890043', NULL, '320 Washington Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 392, 494, NULL, '2020-01-07 09:15:03', '2020-01-07 09:15:03', '3E', NULL),
(25, 'Co-Op', '', 2950000, 8, 'Listing description coming soon!', 129, 129, '425 Park Avenue South', '-73.9832618', '40.74400259999999', NULL, '425 Park Avenue South', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 0, 4123, NULL, '2020-01-07 09:15:04', '2020-01-07 09:15:04', '8BC ', NULL),
(26, 'Co-Op', '', 1299000, 4, 'Listing description coming soon!', 129, 129, '27 East 65th Street', '-73.9683647', '40.7673406', NULL, '27 East 65th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4938, NULL, '2020-01-07 09:15:05', '2020-01-07 09:15:05', '14B ', NULL),
(27, 'Co-Op', '', 1295000, 6, 'Listing description coming soon!', 129, 129, '60 East 96th Street', '-73.9536584', '40.7868429', NULL, '60 East 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3029, NULL, '2020-01-07 09:15:06', '2020-01-07 09:15:06', '1B', NULL),
(28, 'Condo', '2082', 5300000, 5, 'Listing description coming soon!', 130, 130, '210 West 77th Street', '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4174, 1979, NULL, '2020-01-07 09:17:55', '2020-01-07 09:17:55', '8E ', NULL),
(29, 'Single Family Townhouse', '5225', 11900000, 12, 'Listing description coming soon!', 130, 130, '211 East 62nd Street', '-73.9644509', '40.7632975', NULL, '211 East 62nd Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9667, 0, NULL, '2020-01-07 09:17:55', '2020-01-07 09:17:55', '', NULL),
(30, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 130, 130, '630 Park Avenue', '-73.9670704', '40.767228', NULL, '630 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 6732, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '10C ', NULL),
(31, 'Co-Op', '', 1400000, 6, 'Listing description coming soon!', 130, 130, '66 East 79th Street', '-73.9614914', '40.7756749', NULL, '66 East 79th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5355, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '2S ', NULL),
(32, 'Single Family Townhouse', '2555', 2200000, 8, 'Listing description coming soon!', 130, 130, '336 Park Avenue', '-73.9736375', '40.757825', NULL, '336 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 785, 0, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '', NULL),
(33, 'Co-Op', '', 1900000, 7, 'Listing description coming soon!', 130, 130, '41 Eastern Parkway', '-73.9670704', '40.67316270000001', NULL, '41 Eastern Parkway', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Prospect Heights', 'no', 'no', NULL, '', 0, 2252, NULL, '2020-01-07 09:17:57', '2020-01-07 09:17:57', '4A', NULL),
(34, 'Condo', '1105', 1200000, 5, 'Listing description coming soon!', 130, 130, '320 Washington Avenue', '-73.9665194', '40.6890043', NULL, '320 Washington Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 392, 494, NULL, '2020-01-07 09:17:57', '2020-01-07 09:17:57', '3E', NULL),
(35, 'Co-Op', '', 2950000, 8, 'Listing description coming soon!', 130, 130, '425 Park Avenue South', '-73.9832618', '40.74400259999999', NULL, '425 Park Avenue South', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 0, 4123, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '8BC ', NULL),
(36, 'Co-Op', '', 1299000, 4, 'Listing description coming soon!', 130, 130, '27 East 65th Street', '-73.9683647', '40.7673406', NULL, '27 East 65th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4938, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '14B ', NULL),
(37, 'Co-Op', '', 1295000, 6, 'Listing description coming soon!', 130, 130, '60 East 96th Street', '-73.9536584', '40.7868429', NULL, '60 East 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3029, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '1B', NULL),
(38, 'Condo', '1790', 2750000, 5, 'Listing description coming soon!', 130, 130, '115 Fourth Avenue', '-73.98976610000001', '40.7328931', NULL, '115 Fourth Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 1497, 1820, NULL, '2020-01-07 09:17:59', '2020-01-07 09:17:59', '6F', NULL),
(39, 'Condo', '1629', 2700000, 5, 'Listing description coming soon!', 131, 131, '265 State Street', '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1804, 1656, NULL, '2020-01-07 10:25:43', '2020-01-07 10:25:43', '1603', NULL),
(40, 'Condo', '1496', 2250000, 6, 'Listing description coming soon!', 131, 131, '265 State Street', '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1845, 1420, NULL, '2020-01-07 10:25:43', '2020-01-07 10:25:43', '1113', NULL),
(41, 'Condo', '1847', 2150000, 8, 'Listing description coming soon!', 131, 131, '360 Furman Street', '-73.9996652', '40.6934857', NULL, '360 Furman Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Brooklyn Heights', 'no', 'no', NULL, '', 120, 2185, NULL, '2020-01-07 10:25:44', '2020-01-07 10:25:44', '607-608', NULL),
(42, 'Condo', '1800', 1875000, 6, 'Listing description coming soon!', 131, 131, '365 Bridge Street', '-73.9850079', '40.6924772', NULL, '365 Bridge Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 83, 977, NULL, '2020-01-07 10:25:45', '2020-01-07 10:25:45', '7P', NULL),
(43, 'Condo', '1356', 1750000, 4, 'Listing description coming soon!', 131, 131, '265 State Street', '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1379, 1267, NULL, '2020-01-07 10:25:45', '2020-01-07 10:25:45', '806', NULL),
(44, 'Condo', '1156', 1625000, 4, 'Listing description coming soon!', 131, 131, '110 Livingston Street', '-73.98993570000002', '40.6909375', NULL, '110 Livingston Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 191, 885, NULL, '2020-01-07 10:25:46', '2020-01-07 10:25:46', '7B', NULL),
(45, 'Condo', '854', 1100000, 4, 'Listing description coming soon!', 131, 131, '53 Boerum Place', '-73.9897107', '40.6898591', NULL, '53 Boerum Place', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 417, 740, NULL, '2020-01-07 10:25:46', '2020-01-07 10:25:46', '10F', NULL),
(46, 'Multi Family Townhouse', '2816', 3200000, 11, 'Listing description coming soon!', 131, 131, '446 State Street', '-73.9826161', '40.6867141', NULL, '446 State Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 570, 0, NULL, '2020-01-07 10:25:47', '2020-01-07 10:25:47', '', NULL),
(47, 'Condo', '980', 1435000, 5, 'Listing description coming soon!', 131, 131, '275 West 96th Street', '-73.9722665', '40.7949934', NULL, '275 West 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 874, 1142, NULL, '2020-01-07 10:25:48', '2020-01-07 10:25:48', '7O', NULL),
(48, 'Condo', '1034', 1325000, 4, 'Listing description coming soon!', 131, 131, '497 Pacific Street', '-73.9812819', '40.6849159', NULL, '497 Pacific Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 742, 915, NULL, '2020-01-07 10:25:49', '2020-01-07 10:25:49', '4B', NULL),
(49, 'Condo', '1600', 1375000, 8, 'Listing description coming soon!', 131, 131, '319 East 105th Street', '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 1132, 1503, NULL, '2020-01-07 10:25:50', '2020-01-07 10:25:50', '5AB', NULL),
(50, 'Condo', '841', 665000, 4, 'Listing description coming soon!', 132, 132, '319 East 105th Street', '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 556, 796, NULL, '2020-01-07 10:29:28', '2020-01-07 10:29:28', '5A', NULL),
(51, 'Condo', '755', 620000, 4, 'Listing description coming soon!', 132, 132, '319 East 105th Street', '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 576, 716, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', '5-B', NULL),
(52, 'Condo', '1943', 5650000, 6, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 3187, 2070, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', 'PHB', NULL),
(53, 'Condo', '1248', 3305000, 4, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 2042, 1326, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', '18A', NULL),
(54, 'Condo', '1183', 3110000, 4, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1939, 1259, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '20B', NULL),
(55, 'Condo', '1539', 2995000, 6, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 2527, 1641, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '9B', NULL),
(56, 'Condo', '1193', 2380000, 4, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1959, 1273, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '4C', NULL),
(57, 'Condo', '734', 1515000, 3, 'Listing description coming soon!', 132, 132, '570 Broome Street', '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1206, 783, NULL, '2020-01-07 10:29:31', '2020-01-07 10:29:31', '9C', NULL),
(58, 'Co-Op', '', 2650000, 4, 'Listing description coming soon!', 132, 132, '465 Park Avenue', '-73.9703425', '40.7617486', NULL, '465 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 0, 8094, NULL, '2020-01-07 10:29:31', '2020-01-07 10:29:31', '31A', NULL),
(59, 'Co-Op', '', 1495000, 4, 'Listing description coming soon!', 132, 132, '465 Park Avenue', '-73.9703425', '40.7617486', NULL, '465 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 0, 4089, NULL, '2020-01-07 10:29:32', '2020-01-07 10:29:32', '14D', NULL),
(60, 'Condop', '1050', 1479000, 4, 'Listing description coming soon!', 132, 132, '20 East 68th Street', '-73.96770839999999', '40.76919609999999', NULL, '20 East 68th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2059, NULL, '2020-01-07 10:29:32', '2020-01-07 10:29:32', '10F', NULL),
(61, 'Condo', '715', 879000, 3, 'Listing description coming soon!', 133, 133, '235 East 40th Street', '-73.9738354', '40.7490253', NULL, '235 East 40th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 1085, 842, NULL, '2020-01-07 10:33:02', '2020-01-07 10:33:02', '18D', NULL),
(62, 'Co-Op', '', 6195000, 9, 'Listing description coming soon!', 133, 133, '1016 Fifth Avenue', '-73.9615353', '40.7793023', NULL, '1016 Fifth Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 7784, NULL, '2020-01-07 10:33:03', '2020-01-07 10:33:03', '7A', NULL),
(63, 'Condo', '2553', 5850000, 5, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 4126, 3155, NULL, '2020-01-07 10:33:04', '2020-01-07 10:33:04', 'PHA', NULL),
(64, 'Condo', '1806', 3995000, 6, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 3144, 2415, NULL, '2020-01-07 10:33:04', '2020-01-07 10:33:04', 'PHD', NULL),
(65, 'Condo', '2849', 3495000, 7, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2926, 2247, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', 'Garden D', NULL),
(66, 'Condo', '1666', 3295000, 5, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2223, 1707, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '4E', NULL),
(67, 'Condo', '1710', 3095000, 5, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2281, 1752, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '3B', NULL),
(68, 'Condo', '1489', 2450000, 5, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1986, 1526, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '3C', NULL),
(69, 'Condo', '1000', 1920000, 4, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1334, 1024, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '6A', NULL),
(70, 'Condo', '1012', 1835000, 4, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1350, 1037, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '3D', NULL),
(71, 'Condo', '1155', 1775000, 4, 'Listing description coming soon!', 133, 133, '350 West 71st Street', '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1540, 1183, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '3F', NULL),
(72, 'Co-Op', '', 895000, 5, 'Listing description coming soon!', 134, 134, '603 West 111th Street', '-73.9666342', '40.8052161', NULL, '603 West 111th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Morningside Heights', 'no', 'no', NULL, '', 0, 2450, NULL, '2020-01-07 10:38:26', '2020-01-07 10:38:26', '1E', NULL),
(73, 'Co-Op', '', 795000, 5, 'Listing description coming soon!', 134, 134, '603 West 111th Street', '-73.9666342', '40.8052161', NULL, '603 West 111th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Morningside Heights', 'no', 'no', NULL, '', 0, 2450, NULL, '2020-01-07 10:38:26', '2020-01-07 10:38:26', '1W', NULL),
(74, 'Condo', '7750', 19500000, 10, 'Listing description coming soon!', 134, 134, '641 Fifth Avenue', '-73.9762743', '40.7591282', NULL, '641 Fifth Avenue', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 11683, 10501, NULL, '2020-01-07 10:38:28', '2020-01-07 10:38:28', '46/47C ', NULL),
(75, 'Condo', '2752', 5950000, 6, 'Listing description coming soon!', 134, 134, '182 West 82nd Street', '-73.9767013', '40.7848415', NULL, '182 West 82nd Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 3511, 3123, NULL, '2020-01-07 10:38:28', '2020-01-07 10:38:28', '3W', NULL),
(76, 'Condo', '2484', 5825000, 5, 'Listing description coming soon!', 134, 134, '71 Laight Street', '-74.01019269999999', '40.7223271', NULL, '71 Laight Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 2913, 4206, NULL, '2020-01-07 10:38:29', '2020-01-07 10:38:29', 'MAIS1B', NULL),
(77, 'Condo', '4444', 4950000, 12, 'Listing description coming soon!', 134, 134, '243 West 98th Street', '-73.971203', '40.7962402', NULL, '243 West 98th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 2695, 2951, NULL, '2020-01-07 10:38:30', '2020-01-07 10:38:30', '3CD4D', NULL),
(78, 'Condo', '1737', 4695000, 5, 'Listing description coming soon!', 134, 134, '2150 Broadway', '-73.9806864', '40.7814599', NULL, '2150 Broadway', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 1441, 1650, NULL, '2020-01-07 10:38:31', '2020-01-07 10:38:31', '9e', NULL),
(79, 'Condo', '1586', 3250000, 4, 'Listing description coming soon!', 134, 134, '9 College Place', '-73.9946186', '40.696547', NULL, '9 College Place', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Brooklyn Heights', 'no', 'no', NULL, '', 1079, 2315, NULL, '2020-01-07 10:38:31', '2020-01-07 10:38:31', 'ph4b', NULL),
(80, 'Condo', '1741', 3200000, 5, 'Listing description coming soon!', 134, 134, '117 East 57th Street', '-73.9698441', '40.7614678', NULL, '117 East 57th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 1966, 2909, NULL, '2020-01-07 10:38:32', '2020-01-07 10:38:32', '38A', NULL),
(81, 'Co-Op', '0', 2150000, 6, 'Listing description coming soon!', 134, 134, '265 West 94th Street', '-73.97349419999999', '40.7937654', NULL, '265 West 94th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 2760, NULL, '2020-01-07 10:38:33', '2020-01-07 10:38:33', '02/01/2003', NULL),
(82, 'Co-Op', '', 1900000, 4, 'Listing description coming soon!', 134, 134, '120 East 75th Street', '-73.9615603', '40.7724635', NULL, '120 East 75th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 3361, NULL, '2020-01-07 10:38:34', '2020-01-07 10:38:34', '5a', NULL),
(83, 'Co-Op', '', 1699999, 5, 'Listing description coming soon!', 135, 135, '308 East 79th Street', '-73.9545596', '40.7729185', NULL, '308 East 79th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 2527, NULL, '2020-01-07 10:45:44', '2020-01-07 10:45:44', '2GH', NULL),
(84, 'Condo', '1637', 3500000, 6, 'Listing description coming soon!', 135, 135, '400 Fifth Avenue', '-73.98375899999999', '40.7501833', NULL, '400 Fifth Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Garment District', 'no', 'no', NULL, '', 1983, 2502, NULL, '2020-01-07 10:45:45', '2020-01-07 10:45:45', '35A', NULL),
(85, 'Co-Op', '', 825000, 3, 'Listing description coming soon!', 135, 135, '165 Christopher Street', '-74.00885029999999', '40.7330157', NULL, '165 Christopher Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 0, 968, NULL, '2020-01-07 10:45:46', '2020-01-07 10:45:46', '1F', NULL),
(86, 'Multi Family Townhouse', '', 1250000, 10, 'Listing description coming soon!', 135, 135, '653 58th Street', '-74.0112595', '40.6386265', NULL, '653 58th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Sunset Park', 'no', 'no', NULL, '', 216, 0, NULL, '2020-01-07 10:45:47', '2020-01-07 10:45:47', '', NULL),
(87, 'Co-Op', '', 1095000, 5, 'Listing description coming soon!', 135, 135, '137 East 36th Street', '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 2397, NULL, '2020-01-07 10:45:47', '2020-01-07 10:45:47', '4K ', NULL),
(88, 'Co-Op', '', 999000, 5, 'Listing description coming soon!', 135, 135, '205 East 63rd Street', '-73.964336', '40.7640501', NULL, '205 East 63rd Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4155, NULL, '2020-01-07 10:45:48', '2020-01-07 10:45:48', '15D ', NULL),
(89, 'Co-Op', '1100', 825000, 5, 'Listing description coming soon!', 135, 135, '137 East 36th Street', '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 2491, NULL, '2020-01-07 10:45:48', '2020-01-07 10:45:48', '11A ', NULL),
(90, 'Co-Op', '', 725000, 3, 'Listing description coming soon!', 135, 135, '23 East 10th Street', '-73.9934301', '40.7327657', NULL, '23 East 10th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 0, 991, NULL, '2020-01-07 10:45:49', '2020-01-07 10:45:49', '4E ', NULL),
(91, 'Co-Op', '', 675000, 3, 'Listing description coming soon!', 135, 135, '137 East 36th Street', '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 1549, NULL, '2020-01-07 10:45:50', '2020-01-07 10:45:50', '15H', NULL),
(92, 'Co-Op', '', 640000, 4, 'Listing description coming soon!', 135, 135, '137 East 36th Street', '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 1445, NULL, '2020-01-07 10:45:50', '2020-01-07 10:45:50', '14D ', NULL),
(93, 'Co-Op', '', 525000, 3, 'Listing description coming soon!', 135, 135, '200 East 27th Street', '-73.9807589', '40.7409294', NULL, '200 East 27th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Kips Bay', 'no', 'no', NULL, '', 0, 937, NULL, '2020-01-07 10:45:51', '2020-01-07 10:45:51', '7J ', NULL),
(105, 'Single Family Townhouse', '6150', 17500000, 12, 'Listing description coming soon!', 136, 136, '9 East 81st Street', '-73.96189319999999', '40.7781334', NULL, '9 East 81st Street', 'buy', 'active', 8, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 65942, 0, NULL, '2020-01-07 10:54:04', '2020-01-07 10:54:04', '', NULL),
(106, 'Co-Op', '0', 5350000, 11, 'Listing description coming soon!', 136, 136, '130 East 75th Street', '-73.9612082', '40.7724209', NULL, '130 East 75th Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 8903, NULL, '2020-01-07 10:54:05', '2020-01-07 10:54:05', '11CD', NULL),
(107, 'Co-Op', '', 1595000, 3, 'Listing description coming soon!', 136, 136, '1 East 66th Street', '-73.96926909999999', '40.7685235', NULL, '1 East 66th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2549, NULL, '2020-01-07 10:54:05', '2020-01-07 10:54:05', '5B', NULL),
(108, 'Co-Op', '', 8450000, 6, 'Listing description coming soon!', 136, 136, '115 Central Park West', '-73.9764703', '40.7758882', NULL, '115 Central Park West', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 0, 5149, NULL, '2020-01-07 10:54:06', '2020-01-07 10:54:06', '23F', NULL),
(109, 'Condo', '2840', 3555000, 11, 'Listing description coming soon!', 136, 136, '444 East 57th Street', '-73.9614914', '40.7573479', NULL, '444 East 57th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Sutton', 'no', 'no', NULL, '', 2769, 4355, NULL, '2020-01-07 10:54:07', '2020-01-07 10:54:07', '6CD', NULL),
(110, 'Condo', '1600', 1825000, 6, 'Listing description coming soon!', 136, 136, '444 East 57th Street', '-73.9614914', '40.7573479', NULL, '444 East 57th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Sutton', 'no', 'no', NULL, '', 1550, 2340, NULL, '2020-01-07 10:54:07', '2020-01-07 10:54:07', '6D ', NULL),
(111, 'Co-Op', '0', 5450000, 8, 'Listing description coming soon!', 136, 136, '710 Park Avenue', '-73.9652198', '40.7697663', NULL, '710 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 7506, NULL, '2020-01-07 10:54:08', '2020-01-07 10:54:08', '16AB', NULL),
(112, 'Co-Op', '0', 3879000, 6, 'Listing description coming soon!', 136, 136, '1080 Fifth Avenue', '-73.9586193', '40.78348829999999', NULL, '1080 Fifth Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 4343, NULL, '2020-01-07 10:54:09', '2020-01-07 10:54:09', '4C', NULL),
(113, 'Co-Op', '', 2700000, 5, 'Listing description coming soon!', 136, 136, '1080 Fifth Avenue', '-73.9586193', '40.78348829999999', NULL, '1080 Fifth Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3237, NULL, '2020-01-07 10:54:09', '2020-01-07 10:54:09', '6A ', NULL),
(114, 'Single Family Townhouse', '8000', 16900000, 16, 'Listing description coming soon!', 136, 136, '123 East 69th Street', '-73.9640144', '40.7689087', NULL, '123 East 69th Street', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9333, 0, NULL, '2020-01-07 10:54:10', '2020-01-07 10:54:10', '', NULL),
(115, 'Condop', '', 10750000, 10, 'Listing description coming soon!', 136, 136, '30 East 71st Street', '-73.9656929', '40.7705818', NULL, '30 East 71st Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 1576, NULL, '2020-01-07 10:54:11', '2020-01-07 10:54:11', '7A', NULL),
(116, 'Co-Op', '', 3300000, 7, 'Listing description coming soon!', 137, 137, '108 East 82nd Street', '-73.95853199999999', '40.7771029', NULL, '108 East 82nd Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 4503, NULL, '2020-01-07 10:55:33', '2020-01-07 10:55:33', '6A ', NULL),
(117, 'Condo', '1378', 2750000, 5, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1987, 1912, NULL, '2020-01-07 10:55:34', '2020-01-07 10:55:34', '2C', NULL),
(118, 'Condo', '1217', 2375000, 4, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1773, 1706, NULL, '2020-01-07 10:55:34', '2020-01-07 10:55:34', '4A', NULL),
(119, 'Condo', '1065', 2195000, 4, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1551, 1493, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '4E', NULL),
(120, 'Condo', '1029', 2137000, 4, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1491, 1435, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '3G', NULL),
(121, 'Condo', '864', 1795000, 4, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1265, 1217, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '5H', NULL),
(122, 'Condo', '610', 1165000, 3, 'Listing description coming soon!', 137, 137, '150 Rivington Street', '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 893, 860, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '5B', NULL),
(123, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 137, 137, '15 West 81st Street', '-73.9725574', '40.7827254', NULL, '15 West 81st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 5864, NULL, '2020-01-07 10:55:36', '2020-01-07 10:55:36', '5B', NULL),
(124, 'Co-Op', '', 3495000, 7, 'Listing description coming soon!', 137, 137, '860 United Nations Plaza', '-73.9658814', '40.7526338', NULL, '860 United Nations Plaza', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Beekman', 'no', 'no', NULL, '', 0, 7471, NULL, '2020-01-07 10:55:37', '2020-01-07 10:55:37', '31/32A', NULL),
(125, 'Co-Op', '2227', 2600000, 6, 'Listing description coming soon!', 137, 137, '140 East 81st Street', '-73.9577296', '40.7760492', NULL, '140 East 81st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5871, NULL, '2020-01-07 10:55:38', '2020-01-07 10:55:38', 'PHW', NULL),
(126, 'Co-Op', '', 1995000, 6, 'Listing description coming soon!', 137, 137, '370 Riverside Drive', '-73.96828719999999', '40.8042172', NULL, '370 Riverside Drive', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3302, NULL, '2020-01-07 10:55:39', '2020-01-07 10:55:39', '3B', NULL),
(127, 'Co-Op', '0', 1275000, 4, 'Listing description coming soon!', 138, 138, '11 Fifth Avenue', '-73.99579849999999', '40.7324189', NULL, '11 Fifth Avenue', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 0, 1922, NULL, '2020-01-07 11:03:23', '2020-01-07 11:03:23', '9S', NULL),
(128, 'Co-Op', '', 1145000, 5, 'Listing description coming soon!', 138, 138, '173-175 Riverside Drive', '-73.978251', '40.7916779', NULL, '173-175 Riverside Drive', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 2349, NULL, '2020-01-07 11:03:24', '2020-01-07 11:03:24', '12L', NULL),
(129, 'Co-Op', '0', 500000, 4, 'Listing description coming soon!', 138, 138, '155 East 49th Street', '-73.97183989999999', '40.75567849999999', NULL, '155 East 49th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Turtle Bay', 'no', 'no', NULL, '', 0, 2179, NULL, '2020-01-07 11:03:24', '2020-01-07 11:03:24', '10A', NULL),
(130, 'Single Family Townhouse', '0', 17900000, 19, 'Listing description coming soon!', 138, 138, '166 East 81st Street', '-73.95707800000001', '40.77565', NULL, '166 East 81st Street', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 8235, 0, NULL, '2020-01-07 11:03:25', '2020-01-07 11:03:25', '', NULL),
(131, 'Single Family Townhouse', '2830', 2545000, 8, 'Listing description coming soon!', 138, 138, '74 Sullivan Street', '-74.011622', '40.6776743', NULL, '74 Sullivan Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1352, 0, NULL, '2020-01-07 11:03:26', '2020-01-07 11:03:26', '', NULL),
(132, 'Single Family Townhouse', '2722', 2545000, 8, 'Listing description coming soon!', 138, 138, '109 King Street', '-74.0110026', '40.677643', NULL, '109 King Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1391, 0, NULL, '2020-01-07 11:03:27', '2020-01-07 11:03:27', '', NULL),
(133, 'Multi Family Townhouse', '1700', 2145000, 6, 'Listing description coming soon!', 138, 138, '34 Dikeman Street', '-74.0109995', '40.675237', NULL, '34 Dikeman Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 688, 0, NULL, '2020-01-07 11:03:27', '2020-01-07 11:03:27', '', NULL),
(134, 'Condo', '637', 950000, 4, 'Listing description coming soon!', 138, 138, '308 West 30th Street', '-73.9960686', '40.7498367', NULL, '308 West 30th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Chelsea', 'no', 'no', NULL, '', 652, 489, NULL, '2020-01-07 11:03:28', '2020-01-07 11:03:28', '3D', NULL),
(135, 'Co-Op', '0', 3000000, 7, 'Listing description coming soon!', 138, 138, '285 Riverside Drive', '-73.9723967', '40.7989206', NULL, '285 Riverside Drive', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3603, NULL, '2020-01-07 11:03:29', '2020-01-07 11:03:29', '8A ', NULL),
(136, 'Condo', '712', 715000, 3, 'Listing description coming soon!', 138, 138, '510 West 110th Street', '-73.96476369999999', '40.803279', NULL, '510 West 110th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Manhattan Valley', 'no', 'no', NULL, '', 403, 777, NULL, '2020-01-07 11:03:30', '2020-01-07 11:03:30', '3E', NULL),
(137, 'Multi Family Townhouse', '3778', 2799000, 12, 'Listing description coming soon!', 138, 138, '203 Halsey Street', '-73.945122', '40.682559', NULL, '203 Halsey Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Bed Stuy', 'no', 'no', NULL, '', 1823, 0, NULL, '2020-01-07 11:03:31', '2020-01-07 11:03:31', '', NULL),
(138, 'Single Family Townhouse', '1000', 1450000, 0, 'Listing description coming soon!', 139, 139, '166 Coffey Street', '-74.015644', '40.677544', NULL, '166 Coffey Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1267, 0, NULL, '2020-01-07 11:06:25', '2020-01-07 11:06:25', '', NULL),
(139, 'Condo', '1439', 1149000, 6, 'Listing description coming soon!', 139, 139, '1138 Ocean Avenue', '-73.95848370000002', '40.6345604', NULL, '1138 Ocean Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Ditmas Park', 'no', 'no', NULL, '', 20, 821, NULL, '2020-01-07 11:06:26', '2020-01-07 11:06:26', '5C', NULL),
(140, 'Condo', '5874', 20000000, 7, 'Listing description coming soon!', 139, 139, '62 Wooster Street', '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 7529, 4170, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '5FL', NULL),
(141, 'Condo', '3109', 9300000, 5, 'Listing description coming soon!', 139, 139, '62 Wooster Street', '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 3500, 1938, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '3A', NULL),
(142, 'Condo', '2411', 7400000, 5, 'Listing description coming soon!', 139, 139, '62 Wooster Street', '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 2785, 1542, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '3B', NULL),
(143, 'Co-Op', '', 10350000, 13, 'Listing description coming soon!', 139, 139, '555 Park Avenue', '-73.9680365', '40.7644635', NULL, '555 Park Avenue', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 8237, NULL, '2020-01-07 11:06:28', '2020-01-07 11:06:28', '5W', NULL),
(144, 'Co-Op', '', 1025000, 4, 'Listing description coming soon!', 139, 139, '710 Park Avenue', '-73.9652198', '40.7697663', NULL, '710 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2459, NULL, '2020-01-07 11:06:28', '2020-01-07 11:06:28', '3D', NULL),
(145, 'Condo', '2353', 6500000, 5, 'Listing description coming soon!', 139, 139, '200 Eleventh Avenue', '-74.006323', '40.749334', NULL, '200 Eleventh Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Chelsea', 'no', 'no', NULL, '', 3376, 4741, NULL, '2020-01-07 11:06:29', '2020-01-07 11:06:29', '3N', NULL),
(146, 'Condo', '641', 899000, 3, 'Listing description coming soon!', 139, 139, '380 Rector Place', '-74.0177561', '40.7090972', NULL, '380 Rector Place', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Battery Park', 'no', 'no', NULL, '', 1150, 980, NULL, '2020-01-07 11:06:30', '2020-01-07 11:06:30', '5N', NULL),
(147, 'Co-Op', '750', 820000, 3, 'Listing description coming soon!', 139, 139, '7 East 14th Street', '-73.99250669999999', '40.735795', NULL, '7 East 14th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Flatiron', 'no', 'no', NULL, '', 0, 1370, NULL, '2020-01-07 11:06:30', '2020-01-07 11:06:30', '1627', NULL),
(148, 'Co-Op', '630', 559000, 2, 'Listing description coming soon!', 139, 139, '215 Park Row', '-73.9993575', '40.7127421', NULL, '215 Park Row', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Civic Center', 'no', 'no', NULL, '', 0, 785, NULL, '2020-01-07 11:06:31', '2020-01-07 11:06:31', '14G ', NULL),
(149, 'Co-Op', '', 485000, 1, 'Listing description coming soon!', 140, 140, '41 Jane Street', '-74.0046097', '40.7383084', NULL, '41 Jane Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 0, 677, NULL, '2020-01-07 11:09:27', '2020-01-07 11:09:27', '3B ', NULL),
(150, 'Co-Op', '436', 415000, 3, 'Listing description coming soon!', 140, 140, '353 West 47th Street', '-73.9896881', '40.7615527', NULL, '353 West 47th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Hells Kitchen', 'no', 'no', NULL, '', 0, 378, NULL, '2020-01-07 11:09:28', '2020-01-07 11:09:28', '4FE', NULL),
(151, 'Condo', '1953', 6795000, 6, 'Listing description coming soon!', 140, 140, '109 Greene Street', '-73.99985710000001', '40.7247199', NULL, '109 Greene Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 3427, 4079, NULL, '2020-01-07 11:09:29', '2020-01-07 11:09:29', 'PHA ', NULL),
(152, 'Condo', '1872', 4395000, 7, 'Listing description coming soon!', 140, 140, '120 East 87th Street', '-73.9558669', '40.7804094', NULL, '120 East 87th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 3520, 2750, NULL, '2020-01-07 11:09:30', '2020-01-07 11:09:30', 'R12E', NULL),
(153, 'Co-Op', '0', 3295000, 7, 'Listing description coming soon!', 140, 140, '473 West End Avenue', '-73.9794507', '40.786741', NULL, '473 West End Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3858, NULL, '2020-01-07 11:09:31', '2020-01-07 11:09:31', '2A ', NULL),
(154, 'Condo', '3999', 11250000, 10, 'Listing description coming soon!', 140, 140, '27 North Moore Street', '-74.00738129999999', '40.7200645', NULL, '27 North Moore Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 3964, 2800, NULL, '2020-01-07 11:09:31', '2020-01-07 11:09:31', '7CD', NULL),
(155, 'Co-Op', '', 5950000, 9, 'Listing description coming soon!', 140, 140, '439 East 51st Street', '-73.9641139', '40.7540619', NULL, '439 East 51st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Beekman', 'no', 'no', NULL, '', 0, 8854, NULL, '2020-01-07 11:09:33', '2020-01-07 11:09:33', 'PH10/11F', NULL),
(156, 'Condo', '2490', 4650000, 6, 'Listing description coming soon!', 140, 140, '79 Laight Street', '-74.0111532', '40.7220701', NULL, '79 Laight Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 1861, 2189, NULL, '2020-01-07 11:09:33', '2020-01-07 11:09:33', '3B', NULL),
(157, 'Condo', '1993', 3595000, 7, 'Listing description coming soon!', 140, 140, '295 Greenwich Street', '-74.0108415', '40.7158824', NULL, '295 Greenwich Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 2195, 2674, NULL, '2020-01-07 11:09:34', '2020-01-07 11:09:34', '10B', NULL),
(158, 'Condo', '1769', 2550000, 6, 'Listing description coming soon!', 140, 140, '76 Madison Avenue', '-73.9860561', '40.74397099999999', NULL, '76 Madison Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 2276, 2792, NULL, '2020-01-07 11:09:35', '2020-01-07 11:09:35', '8A ', NULL),
(159, 'Condo', '1370', 2500000, 5, 'Listing description coming soon!', 140, 140, '959 First Avenue', '-73.9652383', '40.7557059', NULL, '959 First Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Turtle Bay', 'no', 'no', NULL, '', 232, 2061, NULL, '2020-01-07 11:09:36', '2020-01-07 11:09:36', '18D', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_list_0701`
--

CREATE TABLE `property_list_0701` (
  `id` int(11) NOT NULL,
  `property_type` varchar(100) DEFAULT NULL,
  `size` varchar(500) DEFAULT NULL,
  `price` bigint(20) DEFAULT NULL,
  `rooms` int(11) DEFAULT NULL,
  `discription` varchar(3000) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `city_name` varchar(200) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `address` text,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `bathroom` int(11) DEFAULT NULL,
  `half_bathroom` varchar(50) DEFAULT NULL,
  `cross_streets` text,
  `amenities` varchar(300) DEFAULT NULL,
  `building_features` varchar(300) DEFAULT NULL,
  `local_area` varchar(225) DEFAULT NULL,
  `all_cash` varchar(50) DEFAULT 'no',
  `exchange` varchar(50) DEFAULT 'no',
  `cover_pic` varchar(150) DEFAULT NULL,
  `zipcode` varchar(150) DEFAULT NULL,
  `monthly_tax` bigint(20) DEFAULT NULL,
  `monthly_maintenance` bigint(20) DEFAULT NULL,
  `exposure` varchar(150) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_list_0701`
--

INSERT INTO `property_list_0701` (`id`, `property_type`, `size`, `price`, `rooms`, `discription`, `created_by`, `user_id`, `city_name`, `longitude`, `latitude`, `purpose`, `address`, `type`, `status`, `bathroom`, `half_bathroom`, `cross_streets`, `amenities`, `building_features`, `local_area`, `all_cash`, `exchange`, `cover_pic`, `zipcode`, `monthly_tax`, `monthly_maintenance`, `exposure`, `created_at`, `updated_at`, `title`, `client`) VALUES
(7, 'Multi Family Townhouse', '20000', 26500000, 27, 'Listing description coming soon!', 128, 128, NULL, '-73.9623541', '40.7726347', NULL, '807 Park Avenue', 'buy', 'active', 16, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 21785, 0, NULL, '2020-01-07 09:00:45', '2020-01-07 09:00:45', '14C', NULL),
(8, 'Condo', '4763', 23950000, 8, 'Listing description coming soon!', 128, 128, NULL, '-74.0079612', '40.7336877', NULL, '275 West 10th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 6620, 5055, NULL, '2020-01-07 09:00:46', '2020-01-07 09:00:46', 'Penthouse-B', NULL),
(9, 'Condo', '3420', 18000000, 4, 'Listing description coming soon!', 128, 128, NULL, '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 6594, 5744, NULL, '2020-01-07 09:00:47', '2020-01-07 09:00:47', 'Solarium Penthouse', NULL),
(10, 'Condo', '3463', 10500000, 7, 'Listing description coming soon!', 128, 128, NULL, '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 5342, 4653, NULL, '2020-01-07 09:00:47', '2020-01-07 09:00:47', 'The library', NULL),
(11, 'Condo', '3474', 10300000, 7, 'Listing description coming soon!', 128, 128, NULL, '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 0, NULL, '2020-01-07 09:00:48', '2020-01-07 09:00:48', '4E', NULL),
(12, 'Co-Op', '0', 9950000, 10, 'Listing description coming soon!', 128, 128, NULL, '-73.96663869999999', '40.7725174', NULL, '910 Fifth Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 13524, NULL, '2020-01-07 09:00:49', '2020-01-07 09:00:49', '14C', NULL),
(13, 'Condo', '3970', 9295000, 9, 'Listing description coming soon!', 128, 128, NULL, '-73.95431', '40.7807557', NULL, '141 East 88th Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 4410, 4934, NULL, '2020-01-07 09:00:50', '2020-01-07 09:00:50', 'Penthouse 11A', NULL),
(14, 'Condo', '2716', 7900000, 6, 'Listing description coming soon!', 128, 128, NULL, '-73.9778147', '40.78950880000001', NULL, '555 West End Avenue', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4189, 3650, NULL, '2020-01-07 09:00:50', '2020-01-07 09:00:50', '3W', NULL),
(15, 'Single Family Townhouse', '', 7500000, 0, 'Listing description coming soon!', 128, 128, NULL, '-73.9587707', '40.7742176', NULL, '159 East 78th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 3692, 0, NULL, '2020-01-07 09:00:51', '2020-01-07 09:00:51', '14C', NULL),
(16, 'Co-Op', '0', 7350000, 7, 'Listing description coming soon!', 128, 128, NULL, '-73.9674607', '40.7882884', NULL, '300 Central Park West', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 5914, NULL, '2020-01-07 09:00:52', '2020-01-07 09:00:52', '14F', NULL),
(17, 'Condo', '2720', 7200000, 7, 'Listing description coming soon!', 129, 129, NULL, '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 5463, 2586, NULL, '2020-01-07 09:14:57', '2020-01-07 09:14:57', '11W', NULL),
(18, 'Condo', '2082', 5300000, 5, 'Listing description coming soon!', 129, 129, NULL, '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4174, 1979, NULL, '2020-01-07 09:14:58', '2020-01-07 09:14:58', '8E ', NULL),
(19, 'Single Family Townhouse', '5225', 11900000, 12, 'Listing description coming soon!', 129, 129, NULL, '-73.9644509', '40.7632975', NULL, '211 East 62nd Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9667, 0, NULL, '2020-01-07 09:14:59', '2020-01-07 09:14:59', '', NULL),
(20, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 129, 129, NULL, '-73.9670704', '40.767228', NULL, '630 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 6732, NULL, '2020-01-07 09:14:59', '2020-01-07 09:14:59', '10C ', NULL),
(21, 'Co-Op', '', 1400000, 6, 'Listing description coming soon!', 129, 129, NULL, '-73.9614914', '40.7756749', NULL, '66 East 79th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5355, NULL, '2020-01-07 09:15:00', '2020-01-07 09:15:00', '2S ', NULL),
(22, 'Single Family Townhouse', '2555', 2200000, 8, 'Listing description coming soon!', 129, 129, NULL, '-73.9736375', '40.757825', NULL, '336 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 785, 0, NULL, '2020-01-07 09:15:01', '2020-01-07 09:15:01', '', NULL),
(23, 'Co-Op', '', 1900000, 7, 'Listing description coming soon!', 129, 129, NULL, '-73.9670704', '40.67316270000001', NULL, '41 Eastern Parkway', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Prospect Heights', 'no', 'no', NULL, '', 0, 2252, NULL, '2020-01-07 09:15:02', '2020-01-07 09:15:02', '4A', NULL),
(24, 'Condo', '1105', 1200000, 5, 'Listing description coming soon!', 129, 129, NULL, '-73.9665194', '40.6890043', NULL, '320 Washington Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 392, 494, NULL, '2020-01-07 09:15:03', '2020-01-07 09:15:03', '3E', NULL),
(25, 'Co-Op', '', 2950000, 8, 'Listing description coming soon!', 129, 129, NULL, '-73.9832618', '40.74400259999999', NULL, '425 Park Avenue South', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 0, 4123, NULL, '2020-01-07 09:15:04', '2020-01-07 09:15:04', '8BC ', NULL),
(26, 'Co-Op', '', 1299000, 4, 'Listing description coming soon!', 129, 129, NULL, '-73.9683647', '40.7673406', NULL, '27 East 65th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4938, NULL, '2020-01-07 09:15:05', '2020-01-07 09:15:05', '14B ', NULL),
(27, 'Co-Op', '', 1295000, 6, 'Listing description coming soon!', 129, 129, NULL, '-73.9536584', '40.7868429', NULL, '60 East 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3029, NULL, '2020-01-07 09:15:06', '2020-01-07 09:15:06', '1B', NULL),
(28, 'Condo', '2082', 5300000, 5, 'Listing description coming soon!', 130, 130, NULL, '-73.9807919', '40.78387720000001', NULL, '210 West 77th Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 4174, 1979, NULL, '2020-01-07 09:17:55', '2020-01-07 09:17:55', '8E ', NULL),
(29, 'Single Family Townhouse', '5225', 11900000, 12, 'Listing description coming soon!', 130, 130, NULL, '-73.9644509', '40.7632975', NULL, '211 East 62nd Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9667, 0, NULL, '2020-01-07 09:17:55', '2020-01-07 09:17:55', '', NULL),
(30, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 130, 130, NULL, '-73.9670704', '40.767228', NULL, '630 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 6732, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '10C ', NULL),
(31, 'Co-Op', '', 1400000, 6, 'Listing description coming soon!', 130, 130, NULL, '-73.9614914', '40.7756749', NULL, '66 East 79th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5355, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '2S ', NULL),
(32, 'Single Family Townhouse', '2555', 2200000, 8, 'Listing description coming soon!', 130, 130, NULL, '-73.9736375', '40.757825', NULL, '336 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 785, 0, NULL, '2020-01-07 09:17:56', '2020-01-07 09:17:56', '', NULL),
(33, 'Co-Op', '', 1900000, 7, 'Listing description coming soon!', 130, 130, NULL, '-73.9670704', '40.67316270000001', NULL, '41 Eastern Parkway', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Prospect Heights', 'no', 'no', NULL, '', 0, 2252, NULL, '2020-01-07 09:17:57', '2020-01-07 09:17:57', '4A', NULL),
(34, 'Condo', '1105', 1200000, 5, 'Listing description coming soon!', 130, 130, NULL, '-73.9665194', '40.6890043', NULL, '320 Washington Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Clinton Hill', 'no', 'no', NULL, '', 392, 494, NULL, '2020-01-07 09:17:57', '2020-01-07 09:17:57', '3E', NULL),
(35, 'Co-Op', '', 2950000, 8, 'Listing description coming soon!', 130, 130, NULL, '-73.9832618', '40.74400259999999', NULL, '425 Park Avenue South', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 0, 4123, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '8BC ', NULL),
(36, 'Co-Op', '', 1299000, 4, 'Listing description coming soon!', 130, 130, NULL, '-73.9683647', '40.7673406', NULL, '27 East 65th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4938, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '14B ', NULL),
(37, 'Co-Op', '', 1295000, 6, 'Listing description coming soon!', 130, 130, NULL, '-73.9536584', '40.7868429', NULL, '60 East 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3029, NULL, '2020-01-07 09:17:58', '2020-01-07 09:17:58', '1B', NULL),
(38, 'Condo', '1790', 2750000, 5, 'Listing description coming soon!', 130, 130, NULL, '-73.98976610000001', '40.7328931', NULL, '115 Fourth Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 1497, 1820, NULL, '2020-01-07 09:17:59', '2020-01-07 09:17:59', '6F', NULL),
(39, 'Condo', '1629', 2700000, 5, 'Listing description coming soon!', 131, 131, NULL, '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1804, 1656, NULL, '2020-01-07 10:25:43', '2020-01-07 10:25:43', '1603', NULL),
(40, 'Condo', '1496', 2250000, 6, 'Listing description coming soon!', 131, 131, NULL, '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1845, 1420, NULL, '2020-01-07 10:25:43', '2020-01-07 10:25:43', '1113', NULL),
(41, 'Condo', '1847', 2150000, 8, 'Listing description coming soon!', 131, 131, NULL, '-73.9996652', '40.6934857', NULL, '360 Furman Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Brooklyn Heights', 'no', 'no', NULL, '', 120, 2185, NULL, '2020-01-07 10:25:44', '2020-01-07 10:25:44', '607-608', NULL),
(42, 'Condo', '1800', 1875000, 6, 'Listing description coming soon!', 131, 131, NULL, '-73.9850079', '40.6924772', NULL, '365 Bridge Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 83, 977, NULL, '2020-01-07 10:25:45', '2020-01-07 10:25:45', '7P', NULL),
(43, 'Condo', '1356', 1750000, 4, 'Listing description coming soon!', 131, 131, NULL, '-73.98827849999999', '40.6892122', NULL, '265 State Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 1379, 1267, NULL, '2020-01-07 10:25:45', '2020-01-07 10:25:45', '806', NULL),
(44, 'Condo', '1156', 1625000, 4, 'Listing description coming soon!', 131, 131, NULL, '-73.98993570000002', '40.6909375', NULL, '110 Livingston Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 191, 885, NULL, '2020-01-07 10:25:46', '2020-01-07 10:25:46', '7B', NULL),
(45, 'Condo', '854', 1100000, 4, 'Listing description coming soon!', 131, 131, NULL, '-73.9897107', '40.6898591', NULL, '53 Boerum Place', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Downtown Brooklyn', 'no', 'no', NULL, '', 417, 740, NULL, '2020-01-07 10:25:46', '2020-01-07 10:25:46', '10F', NULL),
(46, 'Multi Family Townhouse', '2816', 3200000, 11, 'Listing description coming soon!', 131, 131, NULL, '-73.9826161', '40.6867141', NULL, '446 State Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 570, 0, NULL, '2020-01-07 10:25:47', '2020-01-07 10:25:47', '', NULL),
(47, 'Condo', '980', 1435000, 5, 'Listing description coming soon!', 131, 131, NULL, '-73.9722665', '40.7949934', NULL, '275 West 96th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 874, 1142, NULL, '2020-01-07 10:25:48', '2020-01-07 10:25:48', '7O', NULL),
(48, 'Condo', '1034', 1325000, 4, 'Listing description coming soon!', 131, 131, NULL, '-73.9812819', '40.6849159', NULL, '497 Pacific Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Boerum Hill', 'no', 'no', NULL, '', 742, 915, NULL, '2020-01-07 10:25:49', '2020-01-07 10:25:49', '4B', NULL),
(49, 'Condo', '1600', 1375000, 8, 'Listing description coming soon!', 131, 131, NULL, '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 1132, 1503, NULL, '2020-01-07 10:25:50', '2020-01-07 10:25:50', '5AB', NULL),
(50, 'Condo', '841', 665000, 4, 'Listing description coming soon!', 132, 132, NULL, '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 556, 796, NULL, '2020-01-07 10:29:28', '2020-01-07 10:29:28', '5A', NULL),
(51, 'Condo', '755', 620000, 4, 'Listing description coming soon!', 132, 132, NULL, '-73.9417915', '40.7897278', NULL, '319 East 105th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'East Harlem', 'no', 'no', NULL, '', 576, 716, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', '5-B', NULL),
(52, 'Condo', '1943', 5650000, 6, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 3187, 2070, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', 'PHB', NULL),
(53, 'Condo', '1248', 3305000, 4, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 2042, 1326, NULL, '2020-01-07 10:29:29', '2020-01-07 10:29:29', '18A', NULL),
(54, 'Condo', '1183', 3110000, 4, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1939, 1259, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '20B', NULL),
(55, 'Condo', '1539', 2995000, 6, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 2527, 1641, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '9B', NULL),
(56, 'Condo', '1193', 2380000, 4, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1959, 1273, NULL, '2020-01-07 10:29:30', '2020-01-07 10:29:30', '4C', NULL),
(57, 'Condo', '734', 1515000, 3, 'Listing description coming soon!', 132, 132, NULL, '-74.0098299', '40.724533', NULL, '570 Broome Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Hudson Square', 'no', 'no', NULL, '', 1206, 783, NULL, '2020-01-07 10:29:31', '2020-01-07 10:29:31', '9C', NULL),
(58, 'Co-Op', '', 2650000, 4, 'Listing description coming soon!', 132, 132, NULL, '-73.9703425', '40.7617486', NULL, '465 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 0, 8094, NULL, '2020-01-07 10:29:31', '2020-01-07 10:29:31', '31A', NULL),
(59, 'Co-Op', '', 1495000, 4, 'Listing description coming soon!', 132, 132, NULL, '-73.9703425', '40.7617486', NULL, '465 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 0, 4089, NULL, '2020-01-07 10:29:32', '2020-01-07 10:29:32', '14D', NULL),
(60, 'Condop', '1050', 1479000, 4, 'Listing description coming soon!', 132, 132, NULL, '-73.96770839999999', '40.76919609999999', NULL, '20 East 68th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2059, NULL, '2020-01-07 10:29:32', '2020-01-07 10:29:32', '10F', NULL),
(61, 'Condo', '715', 879000, 3, 'Listing description coming soon!', 133, 133, NULL, '-73.9738354', '40.7490253', NULL, '235 East 40th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 1085, 842, NULL, '2020-01-07 10:33:02', '2020-01-07 10:33:02', '18D', NULL),
(62, 'Co-Op', '', 6195000, 9, 'Listing description coming soon!', 133, 133, NULL, '-73.9615353', '40.7793023', NULL, '1016 Fifth Avenue', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 7784, NULL, '2020-01-07 10:33:03', '2020-01-07 10:33:03', '7A', NULL),
(63, 'Condo', '2553', 5850000, 5, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 4126, 3155, NULL, '2020-01-07 10:33:04', '2020-01-07 10:33:04', 'PHA', NULL),
(64, 'Condo', '1806', 3995000, 6, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 3144, 2415, NULL, '2020-01-07 10:33:04', '2020-01-07 10:33:04', 'PHD', NULL),
(65, 'Condo', '2849', 3495000, 7, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2926, 2247, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', 'Garden D', NULL),
(66, 'Condo', '1666', 3295000, 5, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2223, 1707, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '4E', NULL),
(67, 'Condo', '1710', 3095000, 5, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 2281, 1752, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '3B', NULL),
(68, 'Condo', '1489', 2450000, 5, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1986, 1526, NULL, '2020-01-07 10:33:05', '2020-01-07 10:33:05', '3C', NULL),
(69, 'Condo', '1000', 1920000, 4, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1334, 1024, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '6A', NULL),
(70, 'Condo', '1012', 1835000, 4, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1350, 1037, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '3D', NULL),
(71, 'Condo', '1155', 1775000, 4, 'Listing description coming soon!', 133, 133, NULL, '-73.986914', '40.7797089', NULL, '350 West 71st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 1540, 1183, NULL, '2020-01-07 10:33:06', '2020-01-07 10:33:06', '3F', NULL),
(72, 'Co-Op', '', 895000, 5, 'Listing description coming soon!', 134, 134, NULL, '-73.9666342', '40.8052161', NULL, '603 West 111th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Morningside Heights', 'no', 'no', NULL, '', 0, 2450, NULL, '2020-01-07 10:38:26', '2020-01-07 10:38:26', '1E', NULL),
(73, 'Co-Op', '', 795000, 5, 'Listing description coming soon!', 134, 134, NULL, '-73.9666342', '40.8052161', NULL, '603 West 111th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Morningside Heights', 'no', 'no', NULL, '', 0, 2450, NULL, '2020-01-07 10:38:26', '2020-01-07 10:38:26', '1W', NULL),
(74, 'Condo', '7750', 19500000, 10, 'Listing description coming soon!', 134, 134, NULL, '-73.9762743', '40.7591282', NULL, '641 Fifth Avenue', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 11683, 10501, NULL, '2020-01-07 10:38:28', '2020-01-07 10:38:28', '46/47C ', NULL),
(75, 'Condo', '2752', 5950000, 6, 'Listing description coming soon!', 134, 134, NULL, '-73.9767013', '40.7848415', NULL, '182 West 82nd Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 3511, 3123, NULL, '2020-01-07 10:38:28', '2020-01-07 10:38:28', '3W', NULL),
(76, 'Condo', '2484', 5825000, 5, 'Listing description coming soon!', 134, 134, NULL, '-74.01019269999999', '40.7223271', NULL, '71 Laight Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 2913, 4206, NULL, '2020-01-07 10:38:29', '2020-01-07 10:38:29', 'MAIS1B', NULL),
(77, 'Condo', '4444', 4950000, 12, 'Listing description coming soon!', 134, 134, NULL, '-73.971203', '40.7962402', NULL, '243 West 98th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 2695, 2951, NULL, '2020-01-07 10:38:30', '2020-01-07 10:38:30', '3CD4D', NULL),
(78, 'Condo', '1737', 4695000, 5, 'Listing description coming soon!', 134, 134, NULL, '-73.9806864', '40.7814599', NULL, '2150 Broadway', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 1441, 1650, NULL, '2020-01-07 10:38:31', '2020-01-07 10:38:31', '9e', NULL),
(79, 'Condo', '1586', 3250000, 4, 'Listing description coming soon!', 134, 134, NULL, '-73.9946186', '40.696547', NULL, '9 College Place', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Brooklyn Heights', 'no', 'no', NULL, '', 1079, 2315, NULL, '2020-01-07 10:38:31', '2020-01-07 10:38:31', 'ph4b', NULL),
(80, 'Condo', '1741', 3200000, 5, 'Listing description coming soon!', 134, 134, NULL, '-73.9698441', '40.7614678', NULL, '117 East 57th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Midtown Central', 'no', 'no', NULL, '', 1966, 2909, NULL, '2020-01-07 10:38:32', '2020-01-07 10:38:32', '38A', NULL),
(81, 'Co-Op', '0', 2150000, 6, 'Listing description coming soon!', 134, 134, NULL, '-73.97349419999999', '40.7937654', NULL, '265 West 94th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 2760, NULL, '2020-01-07 10:38:33', '2020-01-07 10:38:33', '02/01/2003', NULL),
(82, 'Co-Op', '', 1900000, 4, 'Listing description coming soon!', 134, 134, NULL, '-73.9615603', '40.7724635', NULL, '120 East 75th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 3361, NULL, '2020-01-07 10:38:34', '2020-01-07 10:38:34', '5a', NULL),
(83, 'Co-Op', '', 1699999, 5, 'Listing description coming soon!', 135, 135, NULL, '-73.9545596', '40.7729185', NULL, '308 East 79th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 2527, NULL, '2020-01-07 10:45:44', '2020-01-07 10:45:44', '2GH', NULL),
(84, 'Condo', '1637', 3500000, 6, 'Listing description coming soon!', 135, 135, NULL, '-73.98375899999999', '40.7501833', NULL, '400 Fifth Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Garment District', 'no', 'no', NULL, '', 1983, 2502, NULL, '2020-01-07 10:45:45', '2020-01-07 10:45:45', '35A', NULL),
(85, 'Co-Op', '', 825000, 3, 'Listing description coming soon!', 135, 135, NULL, '-74.00885029999999', '40.7330157', NULL, '165 Christopher Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 0, 968, NULL, '2020-01-07 10:45:46', '2020-01-07 10:45:46', '1F', NULL),
(86, 'Multi Family Townhouse', '', 1250000, 10, 'Listing description coming soon!', 135, 135, NULL, '-74.0112595', '40.6386265', NULL, '653 58th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Sunset Park', 'no', 'no', NULL, '', 216, 0, NULL, '2020-01-07 10:45:47', '2020-01-07 10:45:47', '', NULL),
(87, 'Co-Op', '', 1095000, 5, 'Listing description coming soon!', 135, 135, NULL, '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 2397, NULL, '2020-01-07 10:45:47', '2020-01-07 10:45:47', '4K ', NULL),
(88, 'Co-Op', '', 999000, 5, 'Listing description coming soon!', 135, 135, NULL, '-73.964336', '40.7640501', NULL, '205 East 63rd Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 4155, NULL, '2020-01-07 10:45:48', '2020-01-07 10:45:48', '15D ', NULL),
(89, 'Co-Op', '1100', 825000, 5, 'Listing description coming soon!', 135, 135, NULL, '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 2491, NULL, '2020-01-07 10:45:48', '2020-01-07 10:45:48', '11A ', NULL),
(90, 'Co-Op', '', 725000, 3, 'Listing description coming soon!', 135, 135, NULL, '-73.9934301', '40.7327657', NULL, '23 East 10th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 0, 991, NULL, '2020-01-07 10:45:49', '2020-01-07 10:45:49', '4E ', NULL),
(91, 'Co-Op', '', 675000, 3, 'Listing description coming soon!', 135, 135, NULL, '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 1549, NULL, '2020-01-07 10:45:50', '2020-01-07 10:45:50', '15H', NULL),
(92, 'Co-Op', '', 640000, 4, 'Listing description coming soon!', 135, 135, NULL, '-73.9784399', '40.747797', NULL, '137 East 36th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Murray Hill', 'no', 'no', NULL, '', 0, 1445, NULL, '2020-01-07 10:45:50', '2020-01-07 10:45:50', '14D ', NULL),
(93, 'Co-Op', '', 525000, 3, 'Listing description coming soon!', 135, 135, NULL, '-73.9807589', '40.7409294', NULL, '200 East 27th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Kips Bay', 'no', 'no', NULL, '', 0, 937, NULL, '2020-01-07 10:45:51', '2020-01-07 10:45:51', '7J ', NULL),
(105, 'Single Family Townhouse', '6150', 17500000, 12, 'Listing description coming soon!', 136, 136, NULL, '-73.96189319999999', '40.7781334', NULL, '9 East 81st Street', 'buy', 'active', 8, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 65942, 0, NULL, '2020-01-07 10:54:04', '2020-01-07 10:54:04', '', NULL),
(106, 'Co-Op', '0', 5350000, 11, 'Listing description coming soon!', 136, 136, NULL, '-73.9612082', '40.7724209', NULL, '130 East 75th Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 8903, NULL, '2020-01-07 10:54:05', '2020-01-07 10:54:05', '11CD', NULL),
(107, 'Co-Op', '', 1595000, 3, 'Listing description coming soon!', 136, 136, NULL, '-73.96926909999999', '40.7685235', NULL, '1 East 66th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2549, NULL, '2020-01-07 10:54:05', '2020-01-07 10:54:05', '5B', NULL),
(108, 'Co-Op', '', 8450000, 6, 'Listing description coming soon!', 136, 136, NULL, '-73.9764703', '40.7758882', NULL, '115 Central Park West', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lincoln Square', 'no', 'no', NULL, '', 0, 5149, NULL, '2020-01-07 10:54:06', '2020-01-07 10:54:06', '23F', NULL),
(109, 'Condo', '2840', 3555000, 11, 'Listing description coming soon!', 136, 136, NULL, '-73.9614914', '40.7573479', NULL, '444 East 57th Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Sutton', 'no', 'no', NULL, '', 2769, 4355, NULL, '2020-01-07 10:54:07', '2020-01-07 10:54:07', '6CD', NULL),
(110, 'Condo', '1600', 1825000, 6, 'Listing description coming soon!', 136, 136, NULL, '-73.9614914', '40.7573479', NULL, '444 East 57th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Sutton', 'no', 'no', NULL, '', 1550, 2340, NULL, '2020-01-07 10:54:07', '2020-01-07 10:54:07', '6D ', NULL),
(111, 'Co-Op', '0', 5450000, 8, 'Listing description coming soon!', 136, 136, NULL, '-73.9652198', '40.7697663', NULL, '710 Park Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 7506, NULL, '2020-01-07 10:54:08', '2020-01-07 10:54:08', '16AB', NULL),
(112, 'Co-Op', '0', 3879000, 6, 'Listing description coming soon!', 136, 136, NULL, '-73.9586193', '40.78348829999999', NULL, '1080 Fifth Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 4343, NULL, '2020-01-07 10:54:09', '2020-01-07 10:54:09', '4C', NULL),
(113, 'Co-Op', '', 2700000, 5, 'Listing description coming soon!', 136, 136, NULL, '-73.9586193', '40.78348829999999', NULL, '1080 Fifth Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 0, 3237, NULL, '2020-01-07 10:54:09', '2020-01-07 10:54:09', '6A ', NULL),
(114, 'Single Family Townhouse', '8000', 16900000, 16, 'Listing description coming soon!', 136, 136, NULL, '-73.9640144', '40.7689087', NULL, '123 East 69th Street', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 9333, 0, NULL, '2020-01-07 10:54:10', '2020-01-07 10:54:10', '', NULL),
(115, 'Condop', '', 10750000, 10, 'Listing description coming soon!', 136, 136, NULL, '-73.9656929', '40.7705818', NULL, '30 East 71st Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 1576, NULL, '2020-01-07 10:54:11', '2020-01-07 10:54:11', '7A', NULL),
(116, 'Co-Op', '', 3300000, 7, 'Listing description coming soon!', 137, 137, NULL, '-73.95853199999999', '40.7771029', NULL, '108 East 82nd Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 4503, NULL, '2020-01-07 10:55:33', '2020-01-07 10:55:33', '6A ', NULL),
(117, 'Condo', '1378', 2750000, 5, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1987, 1912, NULL, '2020-01-07 10:55:34', '2020-01-07 10:55:34', '2C', NULL),
(118, 'Condo', '1217', 2375000, 4, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1773, 1706, NULL, '2020-01-07 10:55:34', '2020-01-07 10:55:34', '4A', NULL),
(119, 'Condo', '1065', 2195000, 4, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1551, 1493, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '4E', NULL),
(120, 'Condo', '1029', 2137000, 4, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1491, 1435, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '3G', NULL),
(121, 'Condo', '864', 1795000, 4, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 1265, 1217, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '5H', NULL),
(122, 'Condo', '610', 1165000, 3, 'Listing description coming soon!', 137, 137, NULL, '-73.98564569999999', '40.7193816', NULL, '150 Rivington Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Lower East Side', 'no', 'no', NULL, '', 893, 860, NULL, '2020-01-07 10:55:35', '2020-01-07 10:55:35', '5B', NULL),
(123, 'Co-Op', '', 4995000, 7, 'Listing description coming soon!', 137, 137, NULL, '-73.9725574', '40.7827254', NULL, '15 West 81st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 5864, NULL, '2020-01-07 10:55:36', '2020-01-07 10:55:36', '5B', NULL),
(124, 'Co-Op', '', 3495000, 7, 'Listing description coming soon!', 137, 137, NULL, '-73.9658814', '40.7526338', NULL, '860 United Nations Plaza', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Beekman', 'no', 'no', NULL, '', 0, 7471, NULL, '2020-01-07 10:55:37', '2020-01-07 10:55:37', '31/32A', NULL),
(125, 'Co-Op', '2227', 2600000, 6, 'Listing description coming soon!', 137, 137, NULL, '-73.9577296', '40.7760492', NULL, '140 East 81st Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 0, 5871, NULL, '2020-01-07 10:55:38', '2020-01-07 10:55:38', 'PHW', NULL),
(126, 'Co-Op', '', 1995000, 6, 'Listing description coming soon!', 137, 137, NULL, '-73.96828719999999', '40.8042172', NULL, '370 Riverside Drive', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3302, NULL, '2020-01-07 10:55:39', '2020-01-07 10:55:39', '3B', NULL),
(127, 'Co-Op', '0', 1275000, 4, 'Listing description coming soon!', 138, 138, NULL, '-73.99579849999999', '40.7324189', NULL, '11 Fifth Avenue', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Greenwich Village', 'no', 'no', NULL, '', 0, 1922, NULL, '2020-01-07 11:03:23', '2020-01-07 11:03:23', '9S', NULL),
(128, 'Co-Op', '', 1145000, 5, 'Listing description coming soon!', 138, 138, NULL, '-73.978251', '40.7916779', NULL, '173-175 Riverside Drive', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 2349, NULL, '2020-01-07 11:03:24', '2020-01-07 11:03:24', '12L', NULL),
(129, 'Co-Op', '0', 500000, 4, 'Listing description coming soon!', 138, 138, NULL, '-73.97183989999999', '40.75567849999999', NULL, '155 East 49th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Turtle Bay', 'no', 'no', NULL, '', 0, 2179, NULL, '2020-01-07 11:03:24', '2020-01-07 11:03:24', '10A', NULL),
(130, 'Single Family Townhouse', '0', 17900000, 19, 'Listing description coming soon!', 138, 138, NULL, '-73.95707800000001', '40.77565', NULL, '166 East 81st Street', 'buy', 'active', 7, NULL, NULL, NULL, NULL, 'Upper East Side', 'no', 'no', NULL, '', 8235, 0, NULL, '2020-01-07 11:03:25', '2020-01-07 11:03:25', '', NULL),
(131, 'Single Family Townhouse', '2830', 2545000, 8, 'Listing description coming soon!', 138, 138, NULL, '-74.011622', '40.6776743', NULL, '74 Sullivan Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1352, 0, NULL, '2020-01-07 11:03:26', '2020-01-07 11:03:26', '', NULL),
(132, 'Single Family Townhouse', '2722', 2545000, 8, 'Listing description coming soon!', 138, 138, NULL, '-74.0110026', '40.677643', NULL, '109 King Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1391, 0, NULL, '2020-01-07 11:03:27', '2020-01-07 11:03:27', '', NULL),
(133, 'Multi Family Townhouse', '1700', 2145000, 6, 'Listing description coming soon!', 138, 138, NULL, '-74.0109995', '40.675237', NULL, '34 Dikeman Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 688, 0, NULL, '2020-01-07 11:03:27', '2020-01-07 11:03:27', '', NULL),
(134, 'Condo', '637', 950000, 4, 'Listing description coming soon!', 138, 138, NULL, '-73.9960686', '40.7498367', NULL, '308 West 30th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Chelsea', 'no', 'no', NULL, '', 652, 489, NULL, '2020-01-07 11:03:28', '2020-01-07 11:03:28', '3D', NULL),
(135, 'Co-Op', '0', 3000000, 7, 'Listing description coming soon!', 138, 138, NULL, '-73.9723967', '40.7989206', NULL, '285 Riverside Drive', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3603, NULL, '2020-01-07 11:03:29', '2020-01-07 11:03:29', '8A ', NULL),
(136, 'Condo', '712', 715000, 3, 'Listing description coming soon!', 138, 138, NULL, '-73.96476369999999', '40.803279', NULL, '510 West 110th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Manhattan Valley', 'no', 'no', NULL, '', 403, 777, NULL, '2020-01-07 11:03:30', '2020-01-07 11:03:30', '3E', NULL),
(137, 'Multi Family Townhouse', '3778', 2799000, 12, 'Listing description coming soon!', 138, 138, NULL, '-73.945122', '40.682559', NULL, '203 Halsey Street', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Bed Stuy', 'no', 'no', NULL, '', 1823, 0, NULL, '2020-01-07 11:03:31', '2020-01-07 11:03:31', '', NULL),
(138, 'Single Family Townhouse', '1000', 1450000, 0, 'Listing description coming soon!', 139, 139, NULL, '-74.015644', '40.677544', NULL, '166 Coffey Street', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Red Hook', 'no', 'no', NULL, '', 1267, 0, NULL, '2020-01-07 11:06:25', '2020-01-07 11:06:25', '', NULL),
(139, 'Condo', '1439', 1149000, 6, 'Listing description coming soon!', 139, 139, NULL, '-73.95848370000002', '40.6345604', NULL, '1138 Ocean Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Ditmas Park', 'no', 'no', NULL, '', 20, 821, NULL, '2020-01-07 11:06:26', '2020-01-07 11:06:26', '5C', NULL),
(140, 'Condo', '5874', 20000000, 7, 'Listing description coming soon!', 139, 139, NULL, '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 5, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 7529, 4170, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '5FL', NULL),
(141, 'Condo', '3109', 9300000, 5, 'Listing description coming soon!', 139, 139, NULL, '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 3500, 1938, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '3A', NULL),
(142, 'Condo', '2411', 7400000, 5, 'Listing description coming soon!', 139, 139, NULL, '-74.0017116', '40.72318060000001', NULL, '62 Wooster Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 2785, 1542, NULL, '2020-01-07 11:06:27', '2020-01-07 11:06:27', '3B', NULL),
(143, 'Co-Op', '', 10350000, 13, 'Listing description coming soon!', 139, 139, NULL, '-73.9680365', '40.7644635', NULL, '555 Park Avenue', 'buy', 'active', 6, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 8237, NULL, '2020-01-07 11:06:28', '2020-01-07 11:06:28', '5W', NULL),
(144, 'Co-Op', '', 1025000, 4, 'Listing description coming soon!', 139, 139, NULL, '-73.9652198', '40.7697663', NULL, '710 Park Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'Lenox Hill', 'no', 'no', NULL, '', 0, 2459, NULL, '2020-01-07 11:06:28', '2020-01-07 11:06:28', '3D', NULL),
(145, 'Condo', '2353', 6500000, 5, 'Listing description coming soon!', 139, 139, NULL, '-74.006323', '40.749334', NULL, '200 Eleventh Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Chelsea', 'no', 'no', NULL, '', 3376, 4741, NULL, '2020-01-07 11:06:29', '2020-01-07 11:06:29', '3N', NULL),
(146, 'Condo', '641', 899000, 3, 'Listing description coming soon!', 139, 139, NULL, '-74.0177561', '40.7090972', NULL, '380 Rector Place', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Battery Park', 'no', 'no', NULL, '', 1150, 980, NULL, '2020-01-07 11:06:30', '2020-01-07 11:06:30', '5N', NULL),
(147, 'Co-Op', '750', 820000, 3, 'Listing description coming soon!', 139, 139, NULL, '-73.99250669999999', '40.735795', NULL, '7 East 14th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Flatiron', 'no', 'no', NULL, '', 0, 1370, NULL, '2020-01-07 11:06:30', '2020-01-07 11:06:30', '1627', NULL),
(148, 'Co-Op', '630', 559000, 2, 'Listing description coming soon!', 139, 139, NULL, '-73.9993575', '40.7127421', NULL, '215 Park Row', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Civic Center', 'no', 'no', NULL, '', 0, 785, NULL, '2020-01-07 11:06:31', '2020-01-07 11:06:31', '14G ', NULL),
(149, 'Co-Op', '', 485000, 1, 'Listing description coming soon!', 140, 140, NULL, '-74.0046097', '40.7383084', NULL, '41 Jane Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'West Village', 'no', 'no', NULL, '', 0, 677, NULL, '2020-01-07 11:09:27', '2020-01-07 11:09:27', '3B ', NULL),
(150, 'Co-Op', '436', 415000, 3, 'Listing description coming soon!', 140, 140, NULL, '-73.9896881', '40.7615527', NULL, '353 West 47th Street', 'buy', 'active', 1, NULL, NULL, NULL, NULL, 'Hells Kitchen', 'no', 'no', NULL, '', 0, 378, NULL, '2020-01-07 11:09:28', '2020-01-07 11:09:28', '4FE', NULL),
(151, 'Condo', '1953', 6795000, 6, 'Listing description coming soon!', 140, 140, NULL, '-73.99985710000001', '40.7247199', NULL, '109 Greene Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'SoHo', 'no', 'no', NULL, '', 3427, 4079, NULL, '2020-01-07 11:09:29', '2020-01-07 11:09:29', 'PHA ', NULL),
(152, 'Condo', '1872', 4395000, 7, 'Listing description coming soon!', 140, 140, NULL, '-73.9558669', '40.7804094', NULL, '120 East 87th Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Carnegie Hill', 'no', 'no', NULL, '', 3520, 2750, NULL, '2020-01-07 11:09:30', '2020-01-07 11:09:30', 'R12E', NULL),
(153, 'Co-Op', '0', 3295000, 7, 'Listing description coming soon!', 140, 140, NULL, '-73.9794507', '40.786741', NULL, '473 West End Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Upper West Side', 'no', 'no', NULL, '', 0, 3858, NULL, '2020-01-07 11:09:31', '2020-01-07 11:09:31', '2A ', NULL),
(154, 'Condo', '3999', 11250000, 10, 'Listing description coming soon!', 140, 140, NULL, '-74.00738129999999', '40.7200645', NULL, '27 North Moore Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 3964, 2800, NULL, '2020-01-07 11:09:31', '2020-01-07 11:09:31', '7CD', NULL),
(155, 'Co-Op', '', 5950000, 9, 'Listing description coming soon!', 140, 140, NULL, '-73.9641139', '40.7540619', NULL, '439 East 51st Street', 'buy', 'active', 4, NULL, NULL, NULL, NULL, 'Beekman', 'no', 'no', NULL, '', 0, 8854, NULL, '2020-01-07 11:09:33', '2020-01-07 11:09:33', 'PH10/11F', NULL),
(156, 'Condo', '2490', 4650000, 6, 'Listing description coming soon!', 140, 140, NULL, '-74.0111532', '40.7220701', NULL, '79 Laight Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 1861, 2189, NULL, '2020-01-07 11:09:33', '2020-01-07 11:09:33', '3B', NULL),
(157, 'Condo', '1993', 3595000, 7, 'Listing description coming soon!', 140, 140, NULL, '-74.0108415', '40.7158824', NULL, '295 Greenwich Street', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'TriBeCa', 'no', 'no', NULL, '', 2195, 2674, NULL, '2020-01-07 11:09:34', '2020-01-07 11:09:34', '10B', NULL),
(158, 'Condo', '1769', 2550000, 6, 'Listing description coming soon!', 140, 140, NULL, '-73.9860561', '40.74397099999999', NULL, '76 Madison Avenue', 'buy', 'active', 2, NULL, NULL, NULL, NULL, 'NoMad', 'no', 'no', NULL, '', 2276, 2792, NULL, '2020-01-07 11:09:35', '2020-01-07 11:09:35', '8A ', NULL),
(159, 'Condo', '1370', 2500000, 5, 'Listing description coming soon!', 140, 140, NULL, '-73.9652383', '40.7557059', NULL, '959 First Avenue', 'buy', 'active', 3, NULL, NULL, NULL, NULL, 'Turtle Bay', 'no', 'no', NULL, '', 232, 2061, NULL, '2020-01-07 11:09:36', '2020-01-07 11:09:36', '18D', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_views`
--

CREATE TABLE `property_views` (
  `id` int(11) NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_views`
--

INSERT INTO `property_views` (`id`, `property_id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 4, 128, '192.168.1.58', '2020-01-07 11:31:08', '2020-01-07 11:31:08'),
(2, 4, 128, '192.168.1.58', '2020-01-07 11:32:48', '2020-01-07 11:32:48'),
(3, 16, 128, '192.168.1.58', '2020-01-07 11:36:30', '2020-01-07 11:36:30'),
(4, 16, 128, '192.168.1.58', '2020-01-07 11:37:43', '2020-01-07 11:37:43'),
(5, 16, 128, '192.168.1.58', '2020-01-07 11:49:24', '2020-01-07 11:49:24'),
(6, 16, 128, '192.168.1.58', '2020-01-07 11:55:00', '2020-01-07 11:55:00'),
(7, 15, 128, '192.168.1.58', '2020-01-07 11:56:34', '2020-01-07 11:56:34'),
(8, 7, 128, '192.168.1.58', '2020-01-07 12:02:53', '2020-01-07 12:02:53'),
(9, 7, 128, '192.168.1.58', '2020-01-07 12:08:43', '2020-01-07 12:08:43'),
(10, 8, 128, '192.168.1.58', '2020-01-07 12:11:32', '2020-01-07 12:11:32'),
(11, 10, 128, '192.168.1.58', '2020-01-07 12:14:28', '2020-01-07 12:14:28'),
(12, 9, 128, '192.168.1.58', '2020-01-07 12:14:29', '2020-01-07 12:14:29'),
(13, 11, 128, '192.168.1.58', '2020-01-07 12:18:48', '2020-01-07 12:18:48'),
(14, 22, 129, '192.168.1.58', '2020-01-07 12:24:25', '2020-01-07 12:24:25'),
(15, 19, 129, '192.168.1.58', '2020-01-07 12:40:31', '2020-01-07 12:40:31'),
(16, 158, 140, '192.168.1.58', '2020-01-07 12:52:53', '2020-01-07 12:52:53'),
(17, 155, 140, '192.168.1.58', '2020-01-07 12:53:59', '2020-01-07 12:53:59'),
(18, 62, 133, '192.168.1.58', '2020-01-07 12:58:38', '2020-01-07 12:58:38'),
(19, 160, 133, '192.168.1.58', '2020-01-07 13:04:53', '2020-01-07 13:04:53'),
(20, 160, 129, '192.168.1.58', '2020-01-07 13:06:15', '2020-01-07 13:06:15'),
(21, 160, 133, '192.168.1.58', '2020-01-07 13:08:09', '2020-01-07 13:08:09'),
(22, 160, 129, '192.168.1.58', '2020-01-07 13:08:37', '2020-01-07 13:08:37'),
(23, 160, 129, '192.168.1.58', '2020-01-07 13:29:02', '2020-01-07 13:29:02'),
(24, 16, 128, '122.160.138.253', '2020-01-08 05:16:10', '2020-01-08 05:16:10'),
(25, 159, 111, '192.168.1.125', '2020-01-08 12:41:13', '2020-01-08 12:41:13'),
(26, 158, 111, '192.168.1.125', '2020-01-08 12:41:18', '2020-01-08 12:41:18'),
(27, 157, 111, '192.168.1.125', '2020-01-08 12:41:22', '2020-01-08 12:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `requirement`
--

CREATE TABLE `requirement` (
  `id` int(11) NOT NULL,
  `property_type` varchar(200) DEFAULT NULL,
  `min_price` bigint(20) DEFAULT NULL,
  `max_price` bigint(20) DEFAULT NULL,
  `discription` varchar(3000) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  `purpose` varchar(200) DEFAULT NULL,
  `min_room` int(11) DEFAULT NULL,
  `max_room` int(11) DEFAULT NULL,
  `all_cash` varchar(40) DEFAULT NULL,
  `exchange` varchar(20) DEFAULT NULL,
  `pre_approved` varchar(250) DEFAULT NULL,
  `investment_buyer` varchar(250) DEFAULT NULL,
  `status` varchar(250) DEFAULT NULL,
  `min_bathroom` int(11) DEFAULT NULL,
  `max_bathroom` int(11) DEFAULT NULL,
  `amenities` varchar(400) DEFAULT NULL,
  `building_features` varchar(300) DEFAULT NULL,
  `city_name` varchar(200) DEFAULT NULL,
  `local_area` varchar(300) DEFAULT NULL,
  `latitude` varchar(100) DEFAULT NULL,
  `longitude` varchar(100) DEFAULT NULL,
  `min_size` varchar(70) DEFAULT NULL,
  `max_size` varchar(70) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirement`
--

INSERT INTO `requirement` (`id`, `property_type`, `min_price`, `max_price`, `discription`, `userid`, `purpose`, `min_room`, `max_room`, `all_cash`, `exchange`, `pre_approved`, `investment_buyer`, `status`, `min_bathroom`, `max_bathroom`, `amenities`, `building_features`, `city_name`, `local_area`, `latitude`, `longitude`, `min_size`, `max_size`, `created_at`, `updated_at`, `title`, `client`) VALUES
(1, 'residential', 1000, 2000, 'this is description', 111, 'buy', 1, 3, 'yes', 'yes', 'yes', '', 'active', 2, 4, '8', '', 'sunder nagar', 'hhh', '232.938', '2872372.73', '1200', '2000', '2019-12-25 11:21:53', '2020-01-08 12:41:55', 'my first buyer', 0),
(2, 'commercial', 2000, 2500, 'this is good', 10, 'rent', 1, 4, 'no', 'no', 'no', '', NULL, 3, 4, '2,4,6,8', NULL, 'mandi', 'jjj', '123213.12', '23213.773', '1400', '1600', '2019-12-25 11:21:53', '2019-12-25 11:21:53', 'my second buyer', 3);

-- --------------------------------------------------------

--
-- Table structure for table `requirement_views`
--

CREATE TABLE `requirement_views` (
  `id` int(11) NOT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requirement_views`
--

INSERT INTO `requirement_views` (`id`, `requirement_id`, `user_id`, `ip_address`, `created_at`, `updated_at`) VALUES
(1, 1, 133, '192.168.1.58', '2020-01-07 13:09:30', '2020-01-07 13:09:30'),
(2, 1, 111, '192.168.1.125', '2020-01-08 12:41:55', '2020-01-08 12:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `search_data`
--

CREATE TABLE `search_data` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` varchar(500) DEFAULT NULL,
  `url` varchar(5000) DEFAULT NULL,
  `search_type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `title` text,
  `description` text,
  `search_bar` int(11) DEFAULT NULL,
  `slider_image` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `description`, `search_bar`, `slider_image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Start your search here buyer and pocket listing Buyer and pocket Listing', 'Agentconnect is the first platform built to let Real Estate Agent List and search for buyers and pocket listings. from the real esate agents so they can connect and genrate new lead.', 1, 'logi_signup_bg.jpg', 'Active', '2019-07-15 00:38:53', '2019-10-04 05:09:11'),
(3, 'Start your search here buyer and pocket listing Buyer and pocket Listing', 'Agentconnect is the first platform build to let Real Estate Agent List and search for buyers and pocket listings. from the real esate agents so they can connect and genrate new lead.', 0, 'sushibox.jpg', 'Active', '2019-07-15 00:41:30', '2019-07-25 14:17:07'),
(5, 'damsel dream home find here..', 'Agentconnect is the first platform build to let Real Estate Agent List and search for buyers and pocket listings. from the real esate agents so they can connect and genrate new lead. real esate agents so they can connect and genrate new lead.', 0, 'images (1).jpeg', 'Active', '2019-07-15 00:57:17', '2019-07-25 14:17:24'),
(6, 'New', 'bklbhj', 0, '21.jpg', 'InActive', '2019-07-15 07:22:09', '2019-07-25 14:17:44'),
(7, 'damsel', 'Developer is a hub for the latest news, blogs, comment, strategy and advice from leading brands and experts across the apps industry. ... With thousands of engagements every week, Developer is your perfect partner for integrated advertising campaigns. ...', 0, 'sushibox.jpg', 'InActive', '2019-07-16 14:15:08', '2019-07-25 14:17:53');

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `month_price` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`id`, `name`, `description`, `price`, `month_price`, `duration`, `remember_token`, `created_at`, `updated_at`, `agent`) VALUES
(2, '1 Month Membership', '1 Month 30 Days Membership $35', '35', '35', '1', NULL, '2019-06-25 01:35:47', '2019-08-22 05:15:07', 30),
(3, '6 Months Membership', '6 Months membership 180 Days Membership - $150 ($25 per Month)', '150', '25', '6', NULL, '2019-07-12 08:41:01', '2019-08-10 08:00:49', 180),
(4, '12 Months Membership', '12 Months Membership  365 Days Membership $250 ($20 per Month)', '240', '20', '12', NULL, '2019-08-10 05:54:08', '2019-08-10 06:57:25', 365);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `designation` varchar(250) DEFAULT NULL,
  `testimonial` text,
  `image` varchar(250) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `name`, `designation`, `testimonial`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'pankaj dheer', 'devloper', 'Developer is a hub for the latest news, blogs, comment, strategy and advice from leading brands and experts across the apps industry. ... With thousands of engagements every week, Developer is your perfect partner for integrated advertising campaigns. ...', 'greystone.jpg', 'Active', '2019-07-16 14:12:07', '2019-07-17 11:45:12'),
(3, 'rahul sharma', 'Tester', 'Tester is a hub for the latest news, blogs, comment, strategy and advice from leading brands and experts across the apps industry. ... With thousands of engagements every week, Developer is your perfect partner for integrated advertising campaigns. ...', 'Handler.ashx.png', 'Active', '2019-07-16 14:12:47', '2019-07-16 14:12:47'),
(4, 'panku', 'designer', 'Desginer is a hub for the latest news, blogs, comment, strategy and advice from leading brands and experts across the apps industry. ... With thousands of engagements every week, Developer is your perfect partner for integrated advertising campaigns. ...', 'sushibox.jpg', 'Active', '2019-07-16 14:13:15', '2019-07-16 14:13:15'),
(6, 'yjtyuk', 'yuktyuk', 'yjyjyt dvfgbdtgfht gbhnrtgfhtgn nbntghntghtgn ghhrn rh nghrtherhreshrtn reg', 'images (1).jpeg', 'Active', '2019-07-19 12:38:50', '2019-07-19 12:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(50) DEFAULT NULL,
  `subscription_id` varchar(100) DEFAULT NULL,
  `plan_id` varchar(100) DEFAULT NULL,
  `renew_time` varchar(50) DEFAULT NULL,
  `amount` varchar(100) DEFAULT NULL,
  `next_payment` varchar(50) DEFAULT NULL,
  `failed` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `invoice_id`, `subscription_id`, `plan_id`, `renew_time`, `amount`, `next_payment`, `failed`, `created_at`, `updated_at`) VALUES
(2, '19', 'I-BW452GLLEP1G', 'P-5ML4271244454362WXNWU5NQ', '2018-12-10T21:20:49Z', '10.00', '2019-01-01T00:20:49Z', '2', '2019-08-07 08:06:41', '2019-08-07 08:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_old`
--

CREATE TABLE `transaction_old` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_amount` varchar(50) DEFAULT NULL,
  `package_name` varchar(250) DEFAULT NULL,
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_old`
--

INSERT INTO `transaction_old` (`id`, `user_id`, `package_id`, `package_amount`, `package_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 45, 2, '70', 'Two month subscription', 0, '2019-07-26 04:42:41', '2019-07-26 04:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('1','2','3','4') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '4',
  `phone_no` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `public_view` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zipcode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firm_logo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agent_profile_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state_licence_id` varchar(70) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `realestate_firm` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone_no`, `public_view`, `telephone`, `address`, `zipcode`, `fname`, `lname`, `profile_pic`, `firm_logo`, `remember_token`, `created_at`, `updated_at`, `state`, `agent_profile_url`, `state_licence_id`, `realestate_firm`, `city_name`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$10$gD2xpkqS7l4waz2kbwajseavP5AI0O9ccy0oILDAPclNGTuQNSoQi', '1', NULL, NULL, NULL, NULL, NULL, 'Admin', '', '5d84bc3db5484.png', NULL, NULL, '2019-07-01 02:03:05', '2019-09-20 11:47:09', NULL, NULL, NULL, NULL, NULL),
(29, 'Jyoti', 'jyotivisionvivante@gmail.com', NULL, '$2y$10$wMrduGS3z84lypAVqLpwiODmXw9D6XwXTKOZB2FcN1IBRYQ.PAnKe', '3', NULL, NULL, NULL, '32', NULL, 'jyoti', NULL, NULL, NULL, 'uAvdAeuwOXkoY6vR06MpPduf6XH2AXtr6Yntnf0ePmtcuZW5fOBD2HM9oRgL', '2019-07-25 09:03:05', '2019-11-21 12:48:12', NULL, NULL, NULL, NULL, NULL),
(111, 'pankaj', 'pankajdheervisionvivante@gmail.com', NULL, '$2y$10$UCPen.jL8PIcu.i66Vv9Tuq8lBCdOwH84QfoAvS95aqJ2MfyWWLh2', '3', '6373839303', 'yes', NULL, NULL, '2233165464', 'pankaj', 'dheer', '5dfb88b0ada4c.jpg', 'poster.jpg', 'RvIWrdFVKRv4P5UnDWKy2uMlml2mGYyOR9oihTObNeG95nAO1EtgDnvQDhgy', '2019-08-14 04:27:21', '2019-12-19 14:26:56', 'Rhode Island', 'pankajdheer@wd', '1234567', 'Rhode Island', 'Providence'),
(128, NULL, 'testuser1@yopmail.com', NULL, '$2y$10$CnorAmK9tHwxrkvAJ8xQremVfTw6UDcsXyPBFwJNQqKz78bnfe8ly', '3', NULL, NULL, NULL, NULL, '123', 'test', 'user 1', NULL, NULL, NULL, '2020-01-07 08:29:46', '2020-01-07 08:34:01', 'washington', NULL, 'dfsfd', 'df', 'new york'),
(129, NULL, 'testuser2@yopmail.com', NULL, '$2y$10$LK3gnWfL8aooEfQgs/.tcOo1CHHf7b9fUxbWrvdgEWXeVnQIMQRny', '3', NULL, NULL, NULL, NULL, '232', 'user', 'test2', NULL, NULL, NULL, '2020-01-07 09:02:59', '2020-01-07 09:02:59', 'haryana', NULL, 'f', 'fdgg', 'chandigarh'),
(130, NULL, 'testuser3@yopmail.com', NULL, '$2y$10$ESlpL1GNpPAVXlJQOKu3z.h.J5kgk38KgBYqb/4LlpWfH7wsTQk2G', '3', NULL, NULL, NULL, NULL, '3434', 'sdf', 'dsf', NULL, NULL, NULL, '2020-01-07 09:16:22', '2020-01-07 09:16:22', 'haryana', NULL, 'test', 'test', 'panchkula'),
(131, NULL, 'testuser4@yopmail.com', NULL, '$2y$10$1/vvOJM80TtCooA77eRhHefBbJyNCLvkSIycm9RbwJyHYEsD5KJNO', '3', NULL, NULL, NULL, NULL, '534', 'sdf', 'sdf', NULL, NULL, NULL, '2020-01-07 10:22:25', '2020-01-07 10:22:25', 'washington', NULL, 'dfas', 'ds', 'new york'),
(132, NULL, 'testuser5@yopmail.com', NULL, '$2y$10$1/vvOJM80TtCooA77eRhHefBbJyNCLvkSIycm9RbwJyHYEsD5KJNO', '3', NULL, NULL, NULL, NULL, '434', 'akshit', 'punj', NULL, NULL, NULL, '2020-01-07 00:00:00', '2020-01-07 00:00:00', NULL, NULL, NULL, NULL, NULL),
(133, NULL, 'testuser6@yopmail.com', NULL, '$2y$10$1/vvOJM80TtCooA77eRhHefBbJyNCLvkSIycm9RbwJyHYEsD5KJNO', '3', NULL, NULL, NULL, NULL, 'ew', 'amit', 'sharma', NULL, NULL, NULL, '2020-01-07 00:00:00', '2020-01-07 00:00:00', NULL, NULL, NULL, NULL, NULL),
(134, NULL, 'testuser7@yopmail.com', NULL, '$2y$10$dQbA3MKmhpfBm6BWr61jpuNHeWrJIil3NNukurUnq1e.b9WNhCEda', '3', NULL, NULL, NULL, NULL, '2323', 'zdf', 'sdf', NULL, NULL, NULL, '2020-01-07 10:33:48', '2020-01-07 10:33:48', 'washington', NULL, 'test', 'test', 'new york'),
(135, NULL, 'testuser8@yopmail.com', NULL, '$2y$10$K56Yd3DMMxaip2yo/avaa.HPgcfJ..ZTMWE1SldVT37zQJzqhm7V6', '3', NULL, NULL, NULL, NULL, '2344', 'amitpunj', 'user', NULL, NULL, NULL, '2020-01-07 10:39:22', '2020-01-07 10:39:22', 'UK', NULL, 'test', 'test', 'london'),
(136, NULL, 'testuser9@yopmail.com', NULL, '$2y$10$FfRz4HDIJRGfr6HkRhmat.TE.GYJns9RcSo0yabP4WAHONskjx72q', '3', NULL, NULL, NULL, NULL, '43', 'vikram', 'Sharma', NULL, NULL, NULL, '2020-01-07 10:47:24', '2020-01-07 10:47:24', 'haryana', NULL, 'state', 'real', 'chandigarh'),
(137, NULL, 'testuser10@yopmail.com', NULL, '$2y$10$/KzajiGaFY54tVJA3xMKt.JJQyv4U/T/vKUmCHtnSFXpSx9KfPAwq', '3', NULL, NULL, NULL, NULL, '34', 'sdf', 'sdf', NULL, NULL, NULL, '2020-01-07 10:49:42', '2020-01-07 10:49:42', 'UK', NULL, 'state', 'real', 'rome'),
(138, NULL, 'testuser11@yopmail.com', NULL, '$2y$10$eQX0iXV30oX3h6Eix3GDneJ6rh81nlGdVjEH5KLmiwf.YzxaAipm.', '3', NULL, NULL, NULL, NULL, '2354', 'vikram', 'punj', NULL, NULL, NULL, '2020-01-07 11:01:03', '2020-01-07 11:01:03', 'USA', NULL, 'state', 'real', 'newyork'),
(139, NULL, 'testuser12@yopmail.com', NULL, '$2y$10$fGD5C/Hg9sOgvuSDDCUvnuZkNHlNP/4q.toTbsMz.ChA5yk2t4qa2', '3', NULL, NULL, NULL, NULL, '243', 'abhishake', 'Sharma', NULL, NULL, NULL, '2020-01-07 11:04:18', '2020-01-07 11:04:18', 'Delhi', NULL, 'state', 'real', 'Delhi'),
(140, NULL, 'testuser13@yopmail.com', NULL, '$2y$10$lWJlI2GHxw2kp0W/NBaFJeIzkQK1asyKizQ6ChE2BHINJSVPQ/9sS', '3', NULL, NULL, NULL, NULL, '2354', 'amitpunj', 'user', NULL, NULL, NULL, '2020-01-07 11:07:29', '2020-01-07 11:07:29', 'new york', NULL, 'state', 'test', 'new york');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agent_connect`
--
ALTER TABLE `agent_connect`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `building_features`
--
ALTER TABLE `building_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delete_conversation`
--
ALTER TABLE `delete_conversation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices-old`
--
ALTER TABLE `invoices-old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ipn_status`
--
ALTER TABLE `ipn_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_invoice_id_foreign` (`invoice_id`);

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
-- Indexes for table `msg_list`
--
ALTER TABLE `msg_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_list`
--
ALTER TABLE `property_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_list_0701`
--
ALTER TABLE `property_list_0701`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_views`
--
ALTER TABLE `property_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirement`
--
ALTER TABLE `requirement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirement_views`
--
ALTER TABLE `requirement_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search_data`
--
ALTER TABLE `search_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_old`
--
ALTER TABLE `transaction_old`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agent_connect`
--
ALTER TABLE `agent_connect`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `building_features`
--
ALTER TABLE `building_features`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;
--
-- AUTO_INCREMENT for table `delete_conversation`
--
ALTER TABLE `delete_conversation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;
--
-- AUTO_INCREMENT for table `invoices-old`
--
ALTER TABLE `invoices-old`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `ipn_status`
--
ALTER TABLE `ipn_status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `msg_list`
--
ALTER TABLE `msg_list`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `property_list`
--
ALTER TABLE `property_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `property_list_0701`
--
ALTER TABLE `property_list_0701`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
--
-- AUTO_INCREMENT for table `property_views`
--
ALTER TABLE `property_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `requirement`
--
ALTER TABLE `requirement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `requirement_views`
--
ALTER TABLE `requirement_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `search_data`
--
ALTER TABLE `search_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `transaction_old`
--
ALTER TABLE `transaction_old`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices-old` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
