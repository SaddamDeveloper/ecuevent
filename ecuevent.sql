-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2020 at 12:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecuevent`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$8wnMGsrTy9aFRY3RWoWh7OUik2I2d51vlmp4EEQuQvoK.25a72NCW', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `commission_history`
--

CREATE TABLE `commission_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `pair_number` bigint(20) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `comment` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=credited, 2=not credited',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commission_history`
--

INSERT INTO `commission_history` (`id`, `user_id`, `pair_number`, `amount`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '900.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '1', '2020-03-20 13:37:45', NULL),
(3, 1, 1, '0.00', '0 Income of Pair Number 1 isnot credited to your wallet beacuase of Duplicate time frame! ', '2', '2020-03-20 13:46:01', NULL),
(4, 2, 1, '900.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '1', '2020-03-20 13:50:17', NULL),
(10, 1, 1, '900.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '1', '2020-03-20 14:04:52', NULL),
(11, 1, 1, '0.00', '0 Income of Pair Number 1 isnot credited to your wallet beacuase of Duplicate time frame! ', '2', '2020-03-20 14:16:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cutoff`
--

CREATE TABLE `cutoff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cutoff` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cutoff`
--

INSERT INTO `cutoff` (`id`, `cutoff`, `created_at`, `updated_at`) VALUES
(1, '3', '2020-03-17 08:33:53', NULL),
(2, '5', '2020-03-17 08:33:53', NULL),
(3, '7', '2020-03-17 08:33:53', NULL),
(4, '9', '2020-03-17 08:33:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `epin`
--

CREATE TABLE `epin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `epin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1=Used, 2=Not used',
  `alloted_to` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alloted_date` timestamp NULL DEFAULT NULL,
  `used_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `epin`
--

INSERT INTO `epin` (`id`, `epin`, `status`, `alloted_to`, `alloted_date`, `used_by`, `created_at`, `updated_at`) VALUES
(1, 'NT440931', '1', '1', '2020-03-18 10:04:16', '11', '2020-03-18 10:03:56', '2020-03-18 10:04:16'),
(2, 'RB640582', '1', '1', '2020-03-18 10:04:16', '2', '2020-03-18 10:03:56', '2020-03-18 10:04:16'),
(3, 'RH782683', '1', '1', '2020-03-18 10:04:16', '2', '2020-03-18 10:03:57', '2020-03-18 10:04:16'),
(4, 'XZ768564', '1', '1', '2020-03-18 10:04:16', '5', '2020-03-18 10:03:57', '2020-03-18 10:04:16'),
(5, 'FO859155', '1', '1', '2020-03-18 10:04:16', '2', '2020-03-18 10:03:57', '2020-03-18 10:04:16'),
(6, 'GF664926', '1', '1', '2020-03-18 10:04:16', '3', '2020-03-18 10:03:57', '2020-03-18 10:04:16'),
(7, 'NT226817', '1', '1', '2020-03-18 13:15:31', '7', '2020-03-18 13:15:12', '2020-03-18 13:15:31'),
(8, 'TE475118', '1', '1', '2020-03-18 13:15:31', '8', '2020-03-18 13:15:12', '2020-03-18 13:15:31'),
(9, 'ZV298359', '1', '1', '2020-03-18 13:15:31', '9', '2020-03-18 13:15:12', '2020-03-18 13:15:31'),
(10, 'TO947710', '1', '1', '2020-03-18 13:15:31', '3', '2020-03-18 13:15:12', '2020-03-18 13:15:31'),
(11, 'IS379111', '1', '1', '2020-03-18 13:15:31', '4', '2020-03-18 13:15:12', '2020-03-18 13:15:31'),
(12, 'NC160112', '1', '1', '2020-03-18 13:15:32', '5', '2020-03-18 13:15:12', '2020-03-18 13:15:32'),
(13, 'ES669613', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(14, 'ZG575814', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(15, 'IG837115', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(16, 'WT539416', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(17, 'CY952317', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(18, 'QJ498918', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(19, 'FJ515619', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(20, 'LK520420', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:03', '2020-03-19 08:39:33'),
(21, 'LK632721', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:04', '2020-03-19 08:39:33'),
(22, 'JB938822', '2', '3', '2020-03-19 08:39:33', NULL, '2020-03-19 08:39:04', '2020-03-19 08:39:33'),
(23, 'GN547523', '1', '1', '2020-03-19 08:51:54', '50', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(24, 'BR749424', '1', '1', '2020-03-19 08:51:54', '51', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(25, 'OJ677825', '1', '1', '2020-03-19 08:51:54', '2', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(26, 'YR951026', '1', '1', '2020-03-19 08:51:54', '2', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(27, 'TM795227', '1', '1', '2020-03-19 08:51:54', '3', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(28, 'OG119028', '1', '1', '2020-03-19 08:51:54', '4', '2020-03-19 08:40:11', '2020-03-19 08:51:54'),
(29, 'GX573229', '1', '1', '2020-03-19 08:51:54', '5', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(30, 'MF155830', '1', '1', '2020-03-19 08:51:54', '2', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(31, 'DN645831', '1', '1', '2020-03-19 08:51:54', '3', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(32, 'BW879332', '1', '1', '2020-03-19 08:51:54', '4', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(33, 'DS844733', '1', '1', '2020-03-19 08:51:54', '5', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(34, 'QD787734', '1', '1', '2020-03-19 08:51:54', '86', '2020-03-19 08:40:12', '2020-03-19 08:51:54'),
(35, 'CO649235', '1', '1', '2020-03-20 13:19:36', '32', '2020-03-19 08:40:12', '2020-03-20 13:19:36'),
(36, 'NV521036', '1', '1', '2020-03-20 13:19:36', '31', '2020-03-19 08:40:12', '2020-03-20 13:19:36'),
(37, 'NX741337', '1', '1', '2020-03-20 13:19:36', '38', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(38, 'XC171538', '1', '1', '2020-03-20 13:19:36', '14', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(39, 'MH229939', '1', '1', '2020-03-20 13:19:36', '13', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(40, 'TY505340', '1', '1', '2020-03-20 13:19:36', '5', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(41, 'NF350941', '1', '1', '2020-03-20 13:19:36', '23', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(42, 'TN317542', '2', '1', '2020-03-20 13:19:36', NULL, '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(43, 'MS832943', '1', '1', '2020-03-20 13:19:36', '2', '2020-03-19 08:51:43', '2020-03-20 13:19:36'),
(44, 'GP181044', '1', '1', '2020-03-20 13:19:36', '3', '2020-03-19 08:51:44', '2020-03-20 13:19:36'),
(45, 'GL225445', '2', '1', '2020-03-20 13:19:36', NULL, '2020-03-19 08:51:44', '2020-03-20 13:19:36'),
(46, 'EK802246', '1', '1', '2020-03-20 13:19:36', '4', '2020-03-19 08:51:44', '2020-03-20 13:19:36'),
(47, 'VT677247', '2', NULL, NULL, NULL, '2020-03-19 08:51:44', NULL),
(48, 'ID603248', '2', NULL, NULL, NULL, '2020-03-19 08:51:44', NULL),
(49, 'PA519049', '2', NULL, NULL, NULL, '2020-03-20 13:19:21', NULL),
(50, 'FX864250', '2', NULL, NULL, NULL, '2020-03-20 13:19:21', NULL),
(51, 'ZN259451', '2', NULL, NULL, NULL, '2020-03-20 13:19:21', NULL),
(52, 'IE969552', '2', NULL, NULL, NULL, '2020-03-20 13:19:21', NULL),
(53, 'NL311853', '2', NULL, NULL, NULL, '2020-03-20 13:19:21', NULL),
(54, 'OO307454', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(55, 'NI612555', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(56, 'LX515256', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(57, 'KI362157', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(58, 'QF693458', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(59, 'KA207659', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL),
(60, 'AX570660', '2', NULL, NULL, NULL, '2020-03-20 13:19:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `matching_income`
--

CREATE TABLE `matching_income` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `income` decimal(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matching_income`
--

INSERT INTO `matching_income` (`id`, `income`, `created_at`, `updated_at`) VALUES
(3, '900.00', '2020-03-18 08:19:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `member_id` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` varchar(44) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_pair` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT '1=Temp, 2=Active, 3=Deactive',
  `epin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_relation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_mobile` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nominee_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` int(11) DEFAULT NULL,
  `address_proof_doc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_proof_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_proof` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `document_status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '2' COMMENT '1=Verified, 2=Not Verified, 3=Uploaded',
  `policy_is_agree` char(1) COLLATE utf8mb4_unicode_ci DEFAULT '1' COMMENT '1=agree, 2=Not Agree',
  `regitered_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `member_id`, `name`, `email`, `password`, `mobile`, `gender`, `dob`, `total_pair`, `status`, `epin`, `nominee_relation`, `nominee_name`, `nominee_mobile`, `nominee_address`, `state`, `city`, `pin`, `address_proof_doc`, `address_proof_no`, `photo_proof`, `document_status`, `policy_is_agree`, `regitered_by`, `created_at`, `updated_at`) VALUES
(1, 'EE000001', 'ECU EVENT', 'member@mail.com', '$2y$10$8wnMGsrTy9aFRY3RWoWh7OUik2I2d51vlmp4EEQuQvoK.25a72NCW', '8486935380', '1', '0000-00-00', NULL, '1', NULL, NULL, NULL, NULL, NULL, 'Assam', 'Barpeta', 781308, NULL, NULL, NULL, '2', '1', NULL, NULL, NULL),
(2, 'SH000002', 'Saddam  Hussain', 'iamsaddamhussain99@gmail.com', '$2y$10$gySA5cMvYX0rim30fxrbu.cTwPzxFG9TrY0yfqMo7QJQZC5ckuxem', '345678765', '1', '03/10/1971', NULL, '1', 'MS832943', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:35:59', NULL),
(3, 'PD000003', 'Pranab  Das', 'pranab@mail.com', '$2y$10$8wnMGsrTy9aFRY3RWoWh7OUik2I2d51vlmp4EEQuQvoK.25a72NCW', '8486935380123', '2', '03/02/2020', NULL, '1', 'GP181044', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:36:58', NULL),
(4, 'VN000004', 'Vishal  Nag', 'vish@mail.com', '$2y$10$SOq11y1gAyQZA5DbIT32cO/J2AJWI2w3QRxu22q.KGtstE.ipe/46', '123456789012', '1', '03/20/2002', NULL, '1', 'EK802246', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:37:45', NULL),
(5, 'GC000005', 'Gulzar  Chowdhry', 'gulu@mail.com', '$2y$10$DbxrsumeO54tWxe1P5jbXOQZg.RtILLUwfOl6H3mixvyMsPct0JVG', '975796796', '1', '03/10/1981', NULL, '1', 'TY505340', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:39:04', NULL),
(13, 'RC000013', 'Rashan Islam Chowdhry', 'memlber@mail.com', '$2y$10$FIIa0BdM69e4G9nqT2L4zeCTk4g5lAgZzQr7FmJYEVUw56Qxe.I2e', '848693538012123', '2', '03/10/1981', NULL, '1', 'MH229939', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:46:01', NULL),
(14, 'HX000014', 'Hussan  Xaddam', 'hx@mail.com', '$2y$10$fLks/NC6wt9d2OtTWgOSmuUFBhH57Pc1yz5wAaft7itkUVtmJ1XYW', '5679675', '1', '03/21/2001', NULL, '1', 'XC171538', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 13:50:17', NULL),
(31, 'MS000031', 'Malon  Samules', 'mal@mail.com', '$2y$10$hYy7BP0tqYUuAHGc84hQm.h507bSJPsHwlQ3aoE8hIAi6QfwDYSZC', '755658656', '1', '03/10/1971', NULL, '1', 'NV521036', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 14:04:52', NULL),
(32, 'JD000032', 'John  Doe', 'jdoe@mail.com', '$2y$10$srtu9gKCGPEzGw5XTqR.duppPprErBm6uNQQiO9kkZEacXE5F1Ky.', '34567898765', '1', '03/10/1971', NULL, '1', 'CO649235', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 14:12:08', NULL),
(38, 'SD000038', 'Saddam Kashmiri  Das', 'adminas@mail.com', '$2y$10$jQUtVgy8Uz2581ZNMiTUFuv6sYvfM5wJ71JzEareIeX9YL9rO9use', '8486935380875', '2', '03/02/2020', NULL, '1', 'NX741337', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2', '1', NULL, '2020-03-20 14:16:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_joining_order`
--

CREATE TABLE `member_joining_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `epin` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_joining_order`
--

INSERT INTO `member_joining_order` (`id`, `user_id`, `epin`, `product_name`, `image1`, `image2`, `created_at`, `updated_at`) VALUES
(1, 2, 'SC452732', 'Saree with Bag', 'd95f160e78c094c023f9a49460346d6b1.jpg', '', '2020-03-16 09:25:10', NULL),
(2, 3, 'SU157783', 'Saree with Bag', 'd95f160e78c094c023f9a49460346d6b1.jpg', 'd95f160e78c094c023f9a49460346d6b1.jpg', '2020-03-16 10:38:13', NULL),
(3, 4, 'HV568454', 'Churidar with Bag', '31f00e20dbcf5088157080474fdb69c51.jpg', NULL, '2020-03-16 10:50:36', NULL),
(4, 12, 'DC274388', 'Saree with Bag', 'd95f160e78c094c023f9a49460346d6b1.jpg', NULL, '2020-03-16 12:00:13', NULL),
(5, 47, 'UI193657', 'Saree with Bag', 'd95f160e78c094c023f9a49460346d6b1.jpg', NULL, '2020-03-17 12:06:41', NULL),
(6, 48, 'JV495123', 'Saree with Bag', 'd95f160e78c094c023f9a49460346d6b1.jpg', NULL, '2020-03-17 12:14:16', NULL),
(7, 3, 'RB640582', 'Shirt and Pant with Bag', 'fe1fa0c3057865a16332ddcfcd861dea1.jpg', NULL, '2020-03-18 11:07:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_pair_timing`
--

CREATE TABLE `member_pair_timing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_pair_timing`
--

INSERT INTO `member_pair_timing` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-03-16 13:00:03', NULL),
(19, 1, '2020-03-17 13:33:00', NULL),
(20, 1, '2020-03-18 13:37:45', NULL),
(28, 1, '2020-03-19 13:46:01', NULL),
(29, 2, '2020-03-19 13:50:17', NULL),
(46, 1, '2020-03-19 14:04:52', NULL),
(52, 1, '2020-03-20 14:16:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_product`
--

CREATE TABLE `member_product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `image1` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image2` varchar(256) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member_product`
--

INSERT INTO `member_product` (`id`, `name`, `price`, `image1`, `image2`, `created_at`, `updated_at`) VALUES
(1, 'Saree with Bag', '2999.00', 'd95f160e78c094c023f9a49460346d6b1.jpg', 'd95f160e78c094c023f9a49460346d6b2.jpg', '2020-03-11 10:55:25', NULL),
(2, 'Shirt and Pant with Bag', '2999.00', 'fe1fa0c3057865a16332ddcfcd861dea1.jpg', 'fe1fa0c3057865a16332ddcfcd861dea2.jpg', '2020-03-11 10:55:47', NULL),
(3, 'Churidar with Bag', '2999.00', '31f00e20dbcf5088157080474fdb69c51.jpg', '91bc41ec4b24e71f4af4e9e26a36db462.jpg', '2020-03-11 12:07:27', NULL),
(4, 'Test with Test', '2999.00', '020c5b0b2f13369f8699e09bba6284881.jpg', '87e5abfcc5f844ae594426234d561e222.jpg', '2020-03-12 07:34:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member_product_image`
--

CREATE TABLE `member_product_image` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `p_id` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_03_02_082800_create_admin_table', 2),
(5, '2020_03_02_133154_create_member_product_table', 3),
(6, '2020_03_02_133451_create_member_product_image_table', 4),
(7, '2020_03_03_132604_create_epin_table', 5),
(8, '2020_03_04_110109_create_matching_income_table', 6),
(9, '2020_03_04_115411_create_members_table', 7),
(10, '2020_03_05_115516_create_tree_table', 8),
(11, '2020_03_13_065418_create_wallet_table', 9),
(12, '2020_03_13_065751_create_wallet_history_table', 10),
(13, '2020_03_13_131115_create_member_joining_order_table', 11),
(14, '2020_03_17_065236_create_pair_timing_table', 12),
(15, '2020_03_17_083102_create_cutoff_table', 13),
(16, '2020_03_19_082715_create_commission_history_table', 14),
(17, '2020_03_19_103249_create_commission_member_timing_table', 15);

-- --------------------------------------------------------

--
-- Table structure for table `pair_timing`
--

CREATE TABLE `pair_timing` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pair_timing`
--

INSERT INTO `pair_timing` (`id`, `name`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '1st', '00:00:00', '06:00:00', '2020-03-17 07:12:45', NULL),
(2, '2nd', '06:00:00', '12:00:00', '2020-03-17 07:13:34', NULL),
(3, '3rd', '12:00:00', '18:00:00', '2020-03-17 07:18:12', NULL),
(4, '4th', '18:00:00', '23:59:59', '2020-03-17 07:18:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `left_id` int(11) DEFAULT NULL,
  `right_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `registered_by` int(11) DEFAULT NULL,
  `left_count` int(11) NOT NULL DEFAULT 0,
  `right_count` int(11) NOT NULL DEFAULT 0,
  `total_left_count` bigint(20) NOT NULL DEFAULT 0,
  `total_right_count` bigint(20) NOT NULL DEFAULT 0,
  `total_pair` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` (`id`, `user_id`, `left_id`, `right_id`, `parent_id`, `registered_by`, `left_count`, `right_count`, `total_left_count`, `total_right_count`, `total_pair`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, NULL, 1, 0, 0, 5, 4, 4, '2020-03-11 07:49:25', '2020-03-20 14:16:39'),
(2, 2, 4, 5, 1, 1, 1, 0, 3, 1, 1, '2020-03-20 13:35:59', '2020-03-20 14:12:08'),
(3, 3, NULL, 13, 1, 1, 0, 3, 0, 3, 0, '2020-03-20 13:36:58', '2020-03-20 14:16:38'),
(4, 4, 14, NULL, 2, 1, 2, 0, 2, 0, 0, '2020-03-20 13:37:45', '2020-03-20 14:12:08'),
(5, 5, NULL, NULL, 2, 1, 0, 0, 0, 0, 0, '2020-03-20 13:39:04', NULL),
(13, 13, NULL, 31, 3, 1, 0, 2, 0, 2, 0, '2020-03-20 13:46:01', '2020-03-20 14:16:38'),
(14, 14, 32, NULL, 4, 1, 1, 0, 1, 0, 0, '2020-03-20 13:50:17', '2020-03-20 14:12:08'),
(31, 31, NULL, 38, 13, 1, 0, 1, 0, 1, 0, '2020-03-20 14:04:52', '2020-03-20 14:16:38'),
(32, 32, NULL, NULL, 14, 1, 0, 0, 0, 0, 0, '2020-03-20 14:12:08', NULL),
(38, 38, NULL, NULL, 31, 1, 0, 0, 0, 0, 0, '2020-03-20 14:16:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(8,2) DEFAULT NULL,
  `status` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=active, 2=incative',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `user_id`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '1800.00', '1', '2020-03-19 06:13:51', NULL),
(2, 2, '900.00', '1', '2020-03-20 13:35:59', NULL),
(3, 3, '0.00', '1', '2020-03-20 13:36:58', NULL),
(4, 4, '0.00', '1', '2020-03-20 13:37:45', NULL),
(5, 5, '0.00', '1', '2020-03-20 13:39:04', NULL),
(13, 13, '0.00', '1', '2020-03-20 13:46:01', NULL),
(14, 14, '0.00', '1', '2020-03-20 13:50:17', NULL),
(31, 31, '0.00', '1', '2020-03-20 14:04:52', NULL),
(32, 32, '0.00', '1', '2020-03-20 14:12:08', NULL),
(38, 38, '0.00', '1', '2020-03-20 14:16:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_history`
--

CREATE TABLE `wallet_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `wallet_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_type` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '1=cr, 2=dr',
  `amount` decimal(8,2) DEFAULT NULL,
  `total_amount` decimal(8,2) DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_history`
--

INSERT INTO `wallet_history` (`id`, `wallet_id`, `user_id`, `transaction_type`, `amount`, `total_amount`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', '900.00', '900.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '2020-03-20 13:37:45', NULL),
(2, 2, 2, '1', '900.00', '900.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '2020-03-20 13:50:17', NULL),
(6, 1, 1, '1', '900.00', '1800.00', '900.00 Income of Pair Number 1 is successfully credited to your wallet! ', '2020-03-20 14:04:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_email_unique` (`email`);

--
-- Indexes for table `commission_history`
--
ALTER TABLE `commission_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cutoff`
--
ALTER TABLE `cutoff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `epin`
--
ALTER TABLE `epin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `matching_income`
--
ALTER TABLE `matching_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_joining_order`
--
ALTER TABLE `member_joining_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_pair_timing`
--
ALTER TABLE `member_pair_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_product`
--
ALTER TABLE `member_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `member_product_image`
--
ALTER TABLE `member_product_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pair_timing`
--
ALTER TABLE `pair_timing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tree`
--
ALTER TABLE `tree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_history`
--
ALTER TABLE `wallet_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `commission_history`
--
ALTER TABLE `commission_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cutoff`
--
ALTER TABLE `cutoff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `epin`
--
ALTER TABLE `epin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matching_income`
--
ALTER TABLE `matching_income`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `member_joining_order`
--
ALTER TABLE `member_joining_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member_pair_timing`
--
ALTER TABLE `member_pair_timing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `member_product`
--
ALTER TABLE `member_product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `member_product_image`
--
ALTER TABLE `member_product_image`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pair_timing`
--
ALTER TABLE `pair_timing`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tree`
--
ALTER TABLE `tree`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `wallet_history`
--
ALTER TABLE `wallet_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
