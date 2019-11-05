-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2019 at 01:58 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gateapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `estates`
--

CREATE TABLE `estates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `estate_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `estates`
--

INSERT INTO `estates` (`id`, `estate_name`, `address`, `city`, `country`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Family Groove', 'Surelere', 'Lagos', 'Nigeria', 'noimage.jpg', '2019-10-26 07:47:37', '2019-10-26 07:47:37'),
(2, 'Tenance Tower', 'Plot 3 kadic avenue', 'Port Harcourt', 'Nigeria', 'noimage.jpg', '2019-10-26 07:48:27', '2019-10-26 07:48:27'),
(3, 'Peace Estate', 'Lekki', 'Lagos', 'Nigeria', 'noimage.jpg', '2019-10-26 07:49:04', '2019-10-26 07:49:04'),
(4, 'Gatic Estate', 'Victoria island', 'Lagos', 'Nigeria', 'noimage.jpg', '2019-10-26 07:49:56', '2019-10-26 07:49:56'),
(5, 'Princess Villa', 'GRA', 'Port Harcourt', 'Nigeria', 'noimage.jpg', '2019-10-26 07:50:57', '2019-10-26 07:50:57'),
(6, 'Freds Home', 'Garki', 'Abuja', 'Nigeria', 'noimage.jpg', '2019-10-26 07:51:45', '2019-10-26 07:51:45'),
(7, 'Harmony Estate', 'Eleme', 'Port Harcout', 'Nigeria', 'noimage.jpg', '2019-10-26 07:52:25', '2019-10-26 07:52:25'),
(8, 'Harry Estate', 'Eleme Env', 'Port Harcout', 'Nigeria', 'noimage.jpg', '2019-10-26 07:56:41', '2019-10-26 07:56:41'),
(10, 'BestWestern Estate', 'Asokoro ', 'Abuja', 'Nigeria', 'noimage.jpg', '2019-10-29 14:27:21', '2019-10-29 14:27:21'),
(11, 'Bestwestern Estate', 'Airport road', 'Accra', 'Ghana', 'cpao5imgiiczfqufdcw4.jpg', '2019-10-30 06:26:06', '2019-10-30 07:11:24'),
(12, 'Prince and Princess', 'Galadimawa Express way', 'Abuja', 'Nigeria', 'noimage.jpg', '2019-10-30 06:31:48', '2019-10-30 06:31:48'),
(13, 'Anthony Enahoro', 'Ogba Ikeja', 'Lagos', 'Nigeria', 'zgegvexiz1jmigbo2k8q.jpg', '2019-10-30 06:44:43', '2019-10-30 06:44:43'),
(14, 'Anthony Enahoro', 'Utako', 'Abuja', 'Nigeria', 'gvsxvczd79fcseupdvin.jpg', '2019-10-30 06:51:19', '2019-10-30 06:51:19'),
(15, 'Sylvester Stallone', 'Maitama', 'Abuja', 'Nigeria', 'noimage.jpg', '2019-10-30 06:54:41', '2019-10-30 06:54:41');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'What is Gate Guard?', 'Gate Guard is a mobile application developed and maintained by HNG Tech interns. It is an application that provides a seamless way for users to maintain their visitors.', '2019-10-29 00:00:00', NULL),
(2, 'How can I add a Gateman?', 'You will be required to inform the gateman of your choice to download the app. You can then add the gateman by searching for the gateman in the add gateman section', '2019-10-29 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gateman_notifications`
--

CREATE TABLE `gateman_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `resident_id` bigint(20) UNSIGNED NOT NULL,
  `gateman_id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `date_sent` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homes`
--

CREATE TABLE `homes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `estate_id` bigint(20) UNSIGNED NOT NULL,
  `house_block` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qr_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `homes`
--

INSERT INTO `homes` (`id`, `user_id`, `estate_id`, `house_block`, `qr_code`, `created_at`, `updated_at`) VALUES
(1, 2, 5, NULL, NULL, '2019-10-26 08:20:18', '2019-10-26 08:20:18'),
(2, 3, 7, NULL, NULL, '2019-10-26 08:27:47', '2019-10-26 08:27:47'),
(3, 4, 3, NULL, NULL, '2019-10-26 08:53:40', '2019-10-26 08:53:40'),
(4, 5, 7, 'Flat 12B', NULL, '2019-10-26 09:03:11', '2019-10-29 19:42:55'),
(5, 8, 3, NULL, NULL, '2019-10-26 11:28:53', '2019-10-26 11:28:53'),
(6, 9, 2, 'Nbgu', NULL, '2019-10-26 13:09:33', '2019-10-26 19:35:40'),
(7, 10, 6, NULL, NULL, '2019-10-26 18:41:07', '2019-10-26 18:41:07'),
(8, 13, 2, NULL, NULL, '2019-10-27 11:36:12', '2019-10-27 11:36:12'),
(9, 14, 6, NULL, NULL, '2019-10-27 12:18:48', '2019-10-27 12:18:48'),
(10, 16, 2, NULL, NULL, '2019-10-27 13:01:42', '2019-10-27 13:01:42'),
(11, 17, 2, NULL, NULL, '2019-10-27 13:55:51', '2019-10-27 13:55:51'),
(12, 18, 3, NULL, NULL, '2019-10-27 14:06:19', '2019-10-27 14:06:19'),
(13, 19, 3, '5555', NULL, '2019-10-28 07:43:24', '2019-10-28 10:37:37'),
(15, 21, 1, NULL, NULL, '2019-10-28 12:49:40', '2019-10-28 12:49:40'),
(16, 22, 3, NULL, NULL, '2019-10-28 12:52:26', '2019-10-28 12:52:26'),
(17, 31, 3, NULL, NULL, '2019-10-29 13:58:13', '2019-10-29 13:58:13'),
(28, 44, 3, NULL, NULL, '2019-10-29 15:25:53', '2019-10-29 15:25:53'),
(29, 45, 3, NULL, NULL, '2019-10-29 18:46:51', '2019-10-29 18:46:51'),
(30, 46, 3, NULL, NULL, '2019-10-29 18:50:53', '2019-10-29 18:50:53'),
(31, 47, 3, NULL, NULL, '2019-10-29 18:57:05', '2019-10-29 18:57:05'),
(32, 48, 3, NULL, NULL, '2019-10-29 19:40:19', '2019-10-29 19:40:19'),
(33, 51, 3, NULL, NULL, '2019-10-30 10:07:04', '2019-10-30 10:07:04'),
(34, 53, 3, NULL, NULL, '2019-10-30 18:09:20', '2019-10-30 18:09:20'),
(35, 55, 3, NULL, NULL, '2019-10-31 06:30:03', '2019-10-31 06:30:03'),
(36, 56, 3, NULL, NULL, '2019-10-31 19:57:22', '2019-10-31 19:57:22'),
(37, 57, 3, NULL, NULL, '2019-10-31 21:51:51', '2019-10-31 21:51:51'),
(38, 62, 3, NULL, NULL, '2019-11-01 10:27:48', '2019-11-01 10:27:48'),
(39, 63, 3, NULL, NULL, '2019-11-01 10:39:18', '2019-11-01 10:39:18'),
(40, 64, 1, NULL, NULL, '2019-11-01 11:02:23', '2019-11-01 11:02:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read` tinyint(1) NOT NULL,
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
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_09_16_184920_create_sp_category_table', 1),
(4, '2019_10_08_150246_create_estates_table', 1),
(5, '2019_10_08_190014_create_tests_table', 1),
(6, '2019_10_09_002748_create_visitors_table', 1),
(7, '2019_10_09_184614_create_homes_table', 1),
(8, '2019_10_09_184750_create_payments_table', 1),
(9, '2019_10_09_185006_create_roles_table', 1),
(10, '2019_10_09_185042_create_settings_table', 1),
(11, '2019_10_09_185145_create_service_providers_table', 1),
(12, '2019_10_09_185221_create_gateman_notifications_table', 1),
(13, '2019_10_11_170342_create_messages_table', 1),
(14, '2019_10_16_015032_create_resident_gateman_table', 1),
(15, '2019_10_16_103459_change_fcm_to_fcm_token_on_users_table', 1),
(16, '2019_10_17_184755_create_notifications_table', 1),
(17, '2019_10_22_234725_create_faqs_table', 1),
(18, '2019_10_23_145830_create_supports_table', 2),
(19, '2019_10_23_163021_modify_settings_table', 2),
(20, '2019_10_30_113945_create_visitors_history_table', 3),
(21, '2019_10_26_100644_create_newsletter_subscribers_table', 4),
(22, '2019_10_30_194339_create_scheduled_visits_table', 4),
(23, '2019_10_31_183816_add_banned_col_to_visitors_column', 4);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter_subscribers`
--

CREATE TABLE `newsletter_subscribers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('03d81c2a-991c-40c5-a86f-58c58c664dbd', 'App\\Notifications\\VisitorArrivalNotification', 'App\\User', 4, '{\"title\":\"yhjkhas arrived to see you\",\"body\":\"They were are being checked in by JudeJay\",\"visitor_details\":{\"id\":33,\"name\":\"yhjk\",\"arrival_date\":\"2019-10-28\",\"car_plate_no\":\"\",\"phone_no\":\"\",\"purpose\":\"none\",\"image\":\"noimage.jpg\",\"visitor_group\":null,\"status\":0,\"time_in\":null,\"time_out\":null,\"user_id\":9,\"qr_code\":\"UGU3Yx\",\"estate_id\":null,\"visiting_period\":\"Evening\",\"description\":\"\",\"visit_count\":1,\"created_at\":\"2019-10-28 08:14:07\",\"updated_at\":\"2019-10-28 08:14:07\"},\"gateman_details\":{\"id\":4,\"name\":\"JudeJay\",\"username\":null,\"phone\":\"09033447744\",\"email\":\"jonathanjude27@gmail.com\",\"image\":\"noimage.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"a686bfc2d772ad6b\",\"access\":1,\"created_at\":\"2019-10-26 08:52:47\",\"updated_at\":\"2019-10-27 14:05:03\"}}', NULL, '2019-10-30 22:38:33', '2019-10-30 22:38:33'),
('060d3d64-1fed-4947-9a3b-d9129f1e321d', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 09:27:06', '2019-10-31 09:27:06'),
('0ca15a29-64f4-4ff0-ac4d-8040850a3963', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:35:45', '2019-10-31 13:35:45'),
('12279444-a03e-45d7-8588-527c5bd35d28', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:42:11', '2019-10-31 13:42:11'),
('18dfadb4-08c8-4cdc-a530-92127967f2ca', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 08:42:43', '2019-10-31 08:42:43'),
('29d1d3b7-272f-4e3d-be9a-04beb3a605a0', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Mayowa  has invited you as a gateman to his home\",\"resident\":{\"id\":8,\"name\":\"Mayowa\",\"username\":null,\"phone\":\"08045454545\",\"email\":\"mayowhizzle@gmail.com\",\"image\":\"noimage.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"60941add93489015\",\"access\":1,\"created_at\":\"2019-10-26 11:28:02\",\"updated_at\":\"2019-10-26 11:28:20\"}}', NULL, '2019-10-31 21:39:10', '2019-10-31 21:39:10'),
('36917252-e332-4952-a24b-1f6e75200341', 'App\\Notifications\\VisitorArrivalNotification', 'App\\User', 31, '{\"title\":\"testing phonehas arrived to see you\",\"body\":\"They were are being checked in by Bakare\",\"visitor_details\":{\"id\":39,\"name\":\"testing phone\",\"arrival_date\":\"2019-10-31\",\"car_plate_no\":\"Gh-G\",\"phone_no\":\"080564568\",\"purpose\":\"phone\",\"image\":\"ag80r1kp8i7hrtunfy4v.jpg\",\"visitor_group\":null,\"status\":0,\"time_in\":null,\"time_out\":null,\"user_id\":47,\"qr_code\":\"66qARO\",\"estate_id\":null,\"visiting_period\":\"afternoon\",\"description\":\"\",\"visit_count\":1,\"created_at\":\"2019-10-30 08:56:10\",\"updated_at\":\"2019-10-30 08:56:10\"},\"gateman_details\":{\"id\":31,\"name\":\"Bakare\",\"username\":null,\"phone\":\"6750\",\"email\":\"bhummiejonson@gmail.com\",\"image\":\"noimage.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"6b4784f4f3615bf0\",\"access\":1,\"created_at\":\"2019-10-29 13:56:45\",\"updated_at\":\"2019-10-29 13:58:01\"}}', NULL, '2019-10-30 22:38:30', '2019-10-30 22:38:30'),
('3a5cde16-4c7b-47fc-af85-d60129669c9a', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 09:37:06', '2019-10-31 09:37:06'),
('4281b316-34df-4042-9f4d-323ba6bd3115', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 14:28:32', '2019-10-31 14:28:32'),
('4c02f309-e45e-4e9c-9c4f-7c530a8df064', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 06:35:13', '2019-10-31 06:35:13'),
('529e29f0-6eab-45e8-89a7-5d37e38223f9', 'App\\Notifications\\GatemanAcceptanceNotification', 'App\\User', 8, '{\"title\":\"Acceptance\",\"body\":\"W has accepted to be your gateman\",\"gateman_id\":55}', NULL, '2019-10-31 21:41:28', '2019-10-31 21:41:28'),
('63451d78-0dc7-44fd-bea2-f3b1a9e7ff1f', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:44:38', '2019-10-31 13:44:38'),
('6bfc9610-0029-450c-813b-6daec101b51d', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 07:41:23', '2019-10-31 07:41:23'),
('7d35038e-51a0-492d-928b-3f9064cb35bc', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 07:10:42', '2019-10-31 07:10:42'),
('80dd0a17-03d0-4bcd-a286-ab1e8edbc5e7', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:03:30', '2019-10-31 13:03:30'),
('84ff6989-7ed3-473d-a195-967c2f727d0b', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 09:21:31', '2019-10-31 09:21:31'),
('88a55671-f0ad-4907-9c88-a70658547cfb', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Mayowa  has invited you as a gateman to his home\",\"resident\":{\"id\":8,\"name\":\"Mayowa\",\"username\":null,\"phone\":\"08045454545\",\"email\":\"mayowhizzle@gmail.com\",\"image\":\"noimage.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"60941add93489015\",\"access\":1,\"created_at\":\"2019-10-26 11:28:02\",\"updated_at\":\"2019-10-26 11:28:20\"}}', NULL, '2019-10-31 21:39:09', '2019-10-31 21:39:09'),
('89953eb3-5cb5-41b1-ad72-e0c47d4d1795', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 49, '{\"title\":\"Super Admin Default  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":32,\"name\":\"Super Admin Default\",\"username\":\"@default\",\"phone\":\"07060959269\",\"email\":\"super_admin@gateguard.co\",\"image\":\"noimage.jpg\",\"user_type\":\"super_admin\",\"duty_time\":null,\"device_id\":null,\"access\":1,\"created_at\":null,\"updated_at\":null}}', NULL, '2019-10-30 22:39:57', '2019-10-30 22:39:57'),
('8afc153d-7ac2-4063-a43d-fd787b8d138f', 'App\\Notifications\\GatemanAcceptanceNotification', 'App\\User', 47, '{\"title\":\"Acceptance\",\"body\":\"Win101 has accepted to be your gateman\",\"gateman_id\":55}', NULL, '2019-10-31 14:29:12', '2019-10-31 14:29:12'),
('986781dc-d359-4a55-9979-46cd01fe6b3f', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 12, '{\"title\":\"Okechukwu Obi  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":2,\"name\":\"Okechukwu Obi\",\"username\":null,\"phone\":\"08157098756\",\"email\":\"junicodefire@gmail.com\",\"image\":\"noimage.jpg\",\"user_type\":\"gateman\",\"duty_time\":\"0\",\"device_id\":\"dd9ffe53986fb3f2\",\"access\":1,\"created_at\":\"2019-10-26 08:19:33\",\"updated_at\":\"2019-10-26 08:19:51\"}}', NULL, '2019-10-30 22:40:54', '2019-10-30 22:40:54'),
('a08f0747-3b61-421e-8f6e-74eb47dc0b44', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:51:09', '2019-10-31 13:51:09'),
('a0d185ac-bfbc-47d4-937c-388a9501f9ec', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 12:53:05', '2019-10-31 12:53:05'),
('aaf52c5b-4bc0-44f5-8cce-4f805786c7e2', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 09:15:40', '2019-10-31 09:15:40'),
('ac317e81-ef3a-4f3a-95c4-ee0ea35b9c28', 'App\\Notifications\\VisitorArrivalNotification', 'App\\User', 12, '{\"title\":\"Wats uphas arrived to see you\",\"body\":\"They were are being checked in by Isaac Adegboye\",\"visitor_details\":{\"id\":30,\"name\":\"Wats up\",\"arrival_date\":\"2019-10-28\",\"car_plate_no\":\"\",\"phone_no\":\"\",\"purpose\":\"none\",\"image\":\"noimage.jpg\",\"visitor_group\":null,\"status\":0,\"time_in\":null,\"time_out\":null,\"user_id\":9,\"qr_code\":\"IKhuUU\",\"estate_id\":null,\"visiting_period\":\"morning\",\"description\":\"\",\"visit_count\":1,\"created_at\":\"2019-10-28 07:52:11\",\"updated_at\":\"2019-10-28 07:52:11\"},\"gateman_details\":{\"id\":12,\"name\":\"Isaac Adegboye\",\"username\":null,\"phone\":\"08166459287\",\"email\":\"isaac.adegboye@yahoo.com\",\"image\":\"noimage.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"35211c93d962db35\",\"access\":1,\"created_at\":\"2019-10-27 08:29:53\",\"updated_at\":\"2019-10-27 08:29:53\"}}', NULL, '2019-10-30 22:37:26', '2019-10-30 22:37:26'),
('b9de0f2f-c1a2-45d4-bb3e-6e371ad549c6', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 53, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 07:38:04', '2019-10-31 07:38:04'),
('bbbd2bcc-0779-4a2c-a4f4-c378ace709a7', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 07:38:49', '2019-10-31 07:38:49'),
('c0eec9e2-b3ec-4ee1-8430-66022c007ed0', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 07:46:03', '2019-10-31 07:46:03'),
('c99f7b3a-83c4-43b5-99ee-a78ce2b7a8a7', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 08:33:22', '2019-10-31 08:33:22'),
('ce4b54b0-7611-4f9d-884a-56c9397b26aa', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 07:32:57', '2019-10-31 07:32:57'),
('d51aaf56-5702-498d-9e81-33db59bf81d0', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Invite\",\"body\":\"Winn  has invited you as a gateman to his home\",\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-31 07:31:07\"}}', NULL, '2019-10-31 13:53:20', '2019-10-31 13:53:20'),
('d8dbbc47-8d9b-4113-bace-30604034db5d', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 07:06:22', '2019-10-31 07:06:22'),
('e63b8fc1-8a0f-48f4-990a-2b5ad2624aeb', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 06:59:55', '2019-10-31 06:59:55'),
('e9fe808b-9bbe-4ee1-84d1-a08dc2a4a335', 'App\\Notifications\\GatemanAcceptanceNotification', 'App\\User', 8, '{\"title\":\"Acceptance\",\"body\":\"W has accepted to be your gateman\",\"gateman_id\":55}', NULL, '2019-10-31 21:41:48', '2019-10-31 21:41:48'),
('f0101841-55ab-44a5-9b24-9516fccd60e6', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 06:49:15', '2019-10-31 06:49:15'),
('f58ba2a2-ed6b-4c60-bb72-f4291c4dfee9', 'App\\Notifications\\GatemanInvitationNotification', 'App\\User', 55, '{\"title\":\"Winn  has invited you as a gateman to his home\",\"body\":null,\"resident\":{\"id\":47,\"name\":\"Winn\",\"username\":null,\"phone\":\"+28\",\"email\":\"winninggreat+28@gmail.com\",\"image\":\"hyl17etovsyt1nreda9h.jpg\",\"user_type\":\"resident\",\"duty_time\":null,\"device_id\":\"1c627828720e6dc7\",\"access\":1,\"created_at\":\"2019-10-29 18:56:02\",\"updated_at\":\"2019-10-29 20:03:27\"}}', NULL, '2019-10-31 06:30:29', '2019-10-31 06:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `home_id` bigint(20) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resident_gateman`
--

CREATE TABLE `resident_gateman` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_status` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `gateman_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resident_gateman`
--

INSERT INTO `resident_gateman` (`id`, `request_status`, `user_id`, `gateman_id`, `created_at`, `updated_at`) VALUES
(3, 1, 2, 13, '2019-10-27 14:27:49', '2019-10-28 04:00:50'),
(4, 1, 4, 18, '2019-10-27 14:27:49', '2019-10-28 04:01:15'),
(9, 0, 19, 22, '2019-10-29 18:59:50', '2019-10-29 18:59:50'),
(10, 0, 19, 22, '2019-10-29 18:59:51', '2019-10-29 18:59:51'),
(12, 1, 3, 13, '2019-10-30 00:00:00', '2019-10-30 12:06:17'),
(17, 1, 21, 13, '2019-10-30 18:23:07', '2019-10-30 18:23:07'),
(47, 1, 47, 55, '2019-10-31 14:28:30', '2019-10-31 14:29:07'),
(48, 1, 8, 55, '2019-10-31 21:39:07', '2019-10-31 21:41:26'),
(49, 1, 8, 55, '2019-10-31 21:39:08', '2019-10-31 21:41:46');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_visits`
--

CREATE TABLE `scheduled_visits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `scheduled_visits`
--

INSERT INTO `scheduled_visits` (`id`, `visitor_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 40, 21, '2019-10-31 23:04:25', '2019-10-31 23:04:25'),
(3, 41, 21, '2019-10-31 23:08:43', '2019-10-31 23:08:43'),
(4, 48, 21, '2019-10-31 23:14:27', '2019-10-31 23:14:27'),
(5, 48, 21, '2019-10-31 23:31:56', '2019-10-31 23:31:56'),
(6, 48, 21, '2019-10-31 23:36:37', '2019-10-31 23:36:37'),
(7, 48, 21, '2019-10-31 23:45:17', '2019-10-31 23:45:17'),
(8, 48, 21, '2019-10-31 23:49:19', '2019-10-31 23:49:19'),
(9, 48, 21, '2019-10-31 23:52:53', '2019-10-31 23:52:53'),
(10, 48, 21, '2019-10-31 23:57:19', '2019-10-31 23:57:19'),
(11, 48, 21, '2019-10-31 23:59:59', '2019-10-31 23:59:59'),
(12, 49, 21, '2019-11-01 00:04:33', '2019-11-01 00:04:33'),
(13, 2, 3, '2019-11-01 08:04:36', '2019-11-01 08:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(2000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `estate_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `status` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `name`, `phone`, `description`, `image`, `estate_id`, `category_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'David Aneke', '0802341123', 'Doctor', 'noimage.jpg', 1, 1, '1', '2019-10-28 12:48:28', '2019-10-28 12:48:28'),
(2, 'Daniella  Aneke', '0802341123', 'Nurse', 'noimage.jpg', 2, 1, '1', '2019-10-28 12:48:32', '2019-10-28 12:48:32'),
(3, 'Daniella  Aneke', '0802341123', 'Nurse', 'noimage.jpg', 3, 2, '1', '2019-10-28 12:48:32', '2019-10-28 12:48:32'),
(4, 'Daniella  Aneke', '0802341123', 'Nurse', 'noimage.jpg', 3, 2, '0', '2019-10-28 12:48:32', '2019-10-28 12:48:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_notification` tinyint(1) NOT NULL,
  `push_notification` tinyint(1) NOT NULL,
  `location_tracking` tinyint(1) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_category`
--

CREATE TABLE `sp_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sp_category`
--

INSERT INTO `sp_category` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Clinic', '2019-10-28 12:45:55', '2019-10-28 12:45:55'),
(2, 'Carpenter', '2019-10-28 12:45:55', '2019-10-28 12:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `supports`
--

CREATE TABLE `supports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supports`
--

INSERT INTO `supports` (`id`, `email`, `subject`, `message`, `created_at`, `updated_at`) VALUES
(1, 'test@mail.test', 'I do not know what to say', 'lorem ipseum setoun', '2019-10-27 13:10:30', '2019-10-27 13:10:30'),
(2, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:06:20', '2019-10-30 14:06:20'),
(3, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:15:13', '2019-10-30 14:15:13'),
(4, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:16:57', '2019-10-30 14:16:57'),
(5, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:18:13', '2019-10-30 14:18:13'),
(6, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:18:51', '2019-10-30 14:18:51'),
(7, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:35:49', '2019-10-30 14:35:49'),
(8, 'remidongmophp@gmail.com', 'Remi', 'Too sloww', '2019-10-30 14:46:39', '2019-10-30 14:46:39'),
(9, 'andersoncgdongmo@gmail.com', 'Visitor', 'I cant see visitors', '2019-10-30 14:48:55', '2019-10-30 14:48:55'),
(10, 'remidongmophp@gmail.com', 'Resident failure', 'I cant view my redidents', '2019-10-30 14:54:17', '2019-10-30 14:54:17');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `verifycode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type` enum('super_admin','resident','gateman','estate_admin') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('0','1','2','3') COLLATE utf8mb4_unicode_ci NOT NULL,
  `2_factor_enabled` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duty_time` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access` tinyint(191) DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `email`, `email_verified_at`, `image`, `verifycode`, `user_type`, `role`, `2_factor_enabled`, `fcm_token`, `duty_time`, `device_id`, `access`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Okechukwu Obi', NULL, NULL, '08157098756', 'junicodefire@gmail.com', '2019-10-26 08:19:51', 'noimage.jpg', '9821', 'gateman', '0', 'no', NULL, '0', 'dd9ffe53986fb3f2', 1, NULL, '2019-10-26 08:19:33', '2019-10-26 08:19:51'),
(3, 'Okechukwu', NULL, NULL, '07080875757', 'junipreach2017@gmail.com', '2019-11-01 11:53:08', 'en22d0lqcc7ayoplozgk.png', '2816', 'resident', '1', 'no', NULL, NULL, 'dd9ffe53986fb3f2', 1, NULL, '2019-10-26 08:26:45', '2019-11-01 11:53:08'),
(4, 'Jude', NULL, NULL, '09033447744', 'jonathanjude27@gmail.com', '2019-10-31 21:47:01', 'noimage.jpg', '3341', 'resident', '1', 'no', NULL, NULL, 'a686bfc2d772ad6b', 1, NULL, '2019-10-26 08:52:47', '2019-10-31 21:47:01'),
(5, 'Frederick Damasus', NULL, NULL, '08038511954', 'frederickdamasus@gmail.com', '2019-10-31 21:50:34', 'eaqklqovbgnnvyo3yh0b.png', '2879', 'resident', '1', 'no', NULL, NULL, '39f193cf326ec8fc', 1, NULL, '2019-10-26 09:02:07', '2019-10-31 21:50:34'),
(8, 'Mayowa', NULL, NULL, '08045454545', 'mayowhizzle@gmail.com', '2019-10-26 11:28:20', 'noimage.jpg', '7033', 'resident', '1', 'no', NULL, NULL, '60941add93489015', 1, NULL, '2019-10-26 11:28:02', '2019-10-26 11:28:20'),
(9, 'W', NULL, NULL, '08156664098', 'winninggreat@gmail.com', '2019-10-31 21:13:19', 'fw2pto0hq4b8apaxe9cj.jpg', '9989', 'resident', '1', 'no', 'dYiRq6KRDFk:APA91bElKj3jVMGWYip-PE53aw0KPsb07FyLPxpUw_wa3guiEECMhO27XFqGKgWXQ1pj9Ul1JtP1SsESfSOwjJlbnZGXipzKuB9CXVbWnOSiBV0xy7g38G7jtdh8mXO5QV6G6OQ4LRON', NULL, '1c627828720e6dc7', 1, NULL, '2019-10-26 13:09:03', '2019-10-31 21:13:19'),
(10, 'Zooga', NULL, NULL, '00', 'winninggreat+10@gmail.com', NULL, 'noimage.jpg', '9640', 'resident', '1', 'no', NULL, NULL, '42ae6fd2e4fd3aa1', 1, NULL, '2019-10-26 18:40:24', '2019-10-30 14:18:46'),
(11, 'Name', NULL, NULL, '08161691655', 'name@gmail.com', NULL, 'noimage.jpg', '8487', 'resident', '1', 'no', NULL, NULL, '35211c93d962db35', 1, NULL, '2019-10-27 08:26:21', '2019-10-27 08:26:21'),
(12, 'Isaac Adegboye', NULL, NULL, '08166459287', 'isaac.adegboye@yahoo.com', NULL, 'noimage.jpg', '7111', 'resident', '1', 'no', NULL, NULL, '35211c93d962db35', 1, NULL, '2019-10-27 08:29:53', '2019-10-27 08:29:53'),
(13, 'Winn', NULL, NULL, '081566640981', 'winninggreat+11@gmail.com', '2019-10-30 12:10:01', 'noimage.jpg', '5590', 'gateman', '2', 'no', NULL, '0', '1c627828720e6dc7', 1, NULL, '2019-10-27 11:35:34', '2019-10-30 12:10:01'),
(14, 'Win', NULL, NULL, '0800000', 'winninggreat+12@gmail.com', '2019-10-27 12:18:30', 'noimage.jpg', '4777', 'resident', '1', 'no', NULL, NULL, '1c627828720e6dc7', 1, NULL, '2019-10-27 12:18:14', '2019-10-27 12:18:30'),
(15, 'Win', NULL, NULL, '+13', 'winninggreat+13@gmail.com', '2019-10-27 12:36:15', 'noimage.jpg', '8458', 'resident', '1', 'no', NULL, NULL, '1c627828720e6dc7', 1, NULL, '2019-10-27 12:21:16', '2019-10-27 12:36:15'),
(16, 'Lolw', NULL, NULL, '+20', 'winninggreat+20@gmail.com', '2019-10-27 13:00:59', 'noimage.jpg', '7413', 'resident', '1', 'no', NULL, NULL, '1c627828720e6dc7', 1, NULL, '2019-10-27 13:00:31', '2019-10-27 13:00:59'),
(17, 'WinningG', NULL, NULL, '+22', 'winninggreat+22@gmail.com', '2019-10-27 13:55:37', 'noimage.jpg', '5680', 'gateman', '2', 'no', NULL, '0', '1c627828720e6dc7', 1, NULL, '2019-10-27 13:55:16', '2019-10-27 13:55:37'),
(18, 'Win', NULL, NULL, '+23', 'winninggreat+23@gmail.com', '2019-10-28 04:01:53', 'noimage.jpg', '9467', 'gateman', '2', 'no', NULL, '0', '1c627828720e6dc7', 1, NULL, '2019-10-27 14:03:24', '2019-10-28 04:01:53'),
(19, 'Remi Resident', NULL, NULL, '00237698783117', 'remidongmophp@gmail.com', '2019-10-28 10:25:01', 'ssrkreaezyzhjidrwni7.jpg', '9542', 'resident', '1', 'no', NULL, NULL, '90c0ad6bbe852ec0', 1, NULL, '2019-10-28 07:42:09', '2019-10-28 10:25:01'),
(20, 'Remi Gateman', NULL, NULL, '00650913861', 'andersoncgdongmo@gmail.com', '2019-10-30 08:21:45', 'noimage.jpg', '5534', 'gateman', '2', 'no', NULL, '0', '6ae6a916074bd41f', 1, NULL, '2019-10-28 09:25:02', '2019-10-30 08:21:45'),
(21, 'Danny West', NULL, NULL, '07070959269', 'Aunipreach2017@gmail.com', '2019-10-28 12:43:12', 'noimage.jpg', '7332', 'resident', '1', 'no', NULL, NULL, '767uei783e3jy8eie9e7m038ie3ee', 1, NULL, '2019-10-28 12:39:59', '2019-10-28 12:43:12'),
(22, 'Barclays', NULL, NULL, '6745', 'bgbiri92@gmail.com', '2019-10-29 17:39:04', 'noimage.jpg', '4829', 'gateman', '2', 'no', NULL, '0', '6b4784f4f3615bf0', 1, NULL, '2019-10-28 12:46:56', '2019-10-29 17:39:04'),
(23, 'Gradia', NULL, NULL, '0850194544', 'gradimutdev@gmail.com', '2019-10-28 20:52:21', 'noimage.jpg', '1800', 'resident', '1', 'no', NULL, NULL, '257a54de86804f91', 1, NULL, '2019-10-28 20:51:21', '2019-10-28 20:52:21'),
(24, 'Nnamdi Obiesie', NULL, NULL, '07062675209', 'nnamdy6286@gmail.com', '2019-10-28 20:52:43', 'noimage.jpg', '3268', 'resident', '1', 'no', NULL, NULL, 'fdd84415a1abfe7a', 1, NULL, '2019-10-28 20:52:22', '2019-10-28 20:52:43'),
(30, 'Akindele Taiwo', NULL, NULL, '08062359610', 'akindele_taiwo57@yahoo.com', NULL, 'noimage.jpg', '1823', 'resident', '1', 'no', NULL, NULL, 'f9fe5d366c5ddec0', 1, NULL, '2019-10-29 12:13:46', '2019-10-31 20:48:40'),
(31, 'Bakare', NULL, NULL, '6750', 'bhummiejonson@gmail.com', '2019-10-29 13:58:01', 'noimage.jpg', '2724', 'resident', '1', 'no', NULL, NULL, '6b4784f4f3615bf0', 1, NULL, '2019-10-29 13:56:45', '2019-10-29 13:58:01'),
(32, 'Okechukwu', '@default', '$2y$10$b.rCVK5aYI.lKj2FKqote.YjC1uEW4.VP20tONSgFwC8wMRvLM7Fe', '07060959269', 'super_admin@gateguard.co', NULL, 'noimage.jpg', '2247', 'super_admin', '0', 'no', NULL, NULL, 'dd9ffe53986fb3f2', 1, NULL, NULL, '2019-11-01 11:51:10'),
(44, NULL, NULL, '$2y$10$YBgxLnhkN4yyUqbN2lKc6e4ZnYh/.3or7EVt0781WC.OFvq/6kE9a', NULL, 'goalsetterapp@gmail.com', NULL, 'noimage.jpg', '4800', 'estate_admin', '3', 'no', NULL, NULL, NULL, 1, NULL, '2019-10-29 15:25:53', '2019-10-29 15:25:53'),
(45, NULL, NULL, '$2y$10$V08xYToATVDR8GIxaCrWjOhXWPcmI615VX0noM1Y7jzegFRhiBsrG', NULL, 'e_fadairo@yahoo.com', NULL, 'noimage.jpg', '9826', 'estate_admin', '3', 'no', NULL, NULL, NULL, 1, NULL, '2019-10-29 18:46:51', '2019-10-29 18:46:51'),
(46, NULL, NULL, '$2y$10$w.SBd4WvcfeRJT9Gm2vqeO0zt/NE/xktgE7Sw.oRUIVaAf/Mzd5PG', NULL, 'mawhizzle@yahoo.com', NULL, 'noimage.jpg', '5254', 'estate_admin', '3', 'no', NULL, NULL, NULL, 1, NULL, '2019-10-29 18:50:53', '2019-10-29 18:50:53'),
(47, 'Winn', NULL, NULL, '+28', 'winninggreat+28@gmail.com', '2019-10-29 18:56:48', 'hyl17etovsyt1nreda9h.jpg', '4077', 'resident', '1', 'no', 'dQdFPztCskw:APA91bG0Pvqe4kuhoF1Rx-4u4vQMkABdYWRGApE1YKqMkmoG62yvDRQK3Aed6ZDfzIIgk2ezXmVIQO2iNnRwPIL15gXO7LmydXb3wAwLxJ2NtkdcmmW6dvpf4WYQyYWGZDg66cWUD3s8', NULL, '1c627828720e6dc7', 1, NULL, '2019-10-29 18:56:02', '2019-10-31 07:31:07'),
(48, 'Fidelis Inaku', NULL, NULL, '08124448103', 'fidelisinaku@gmail.com', '2019-10-29 19:39:44', 'noimage.jpg', '5452', 'resident', '1', 'no', NULL, NULL, '3a608472985d8910', 1, NULL, '2019-10-29 19:39:06', '2019-10-29 19:39:44'),
(49, 'seyi', NULL, NULL, '08160614229', 'seyi@hng.tech', '2019-10-29 19:42:45', 'ljpgs9g1q3gol9yt3pda.png', '9230', 'resident', '1', 'no', NULL, NULL, '693e7a78bfeaa67e', 1, NULL, '2019-10-29 19:42:20', '2019-10-29 19:48:53'),
(50, 'Oyemade Olufemi', NULL, NULL, '08069172143', 'pharmtex08@yahoo.com', NULL, 'noimage.jpg', '6126', 'resident', '1', 'no', NULL, NULL, '6e80b301f45853d5', 1, NULL, '2019-10-30 05:14:27', '2019-10-30 05:14:27'),
(51, 'Oops', NULL, NULL, '090', 'zoluwatobi@gmail.com', '2019-10-31 06:59:21', 'noimage.jpg', '1413', 'gateman', '2', 'no', NULL, '0', '42ae6fd2e4fd3aa1', 1, NULL, '2019-10-30 10:04:59', '2019-10-31 06:59:21'),
(52, 'A Gateman', NULL, NULL, '080623344556', 'testteman@mail.com', NULL, 'noimage.jpg', '9509', 'gateman', '2', 'no', NULL, '0', '43r34f4t34f54t4534666645t45f6r4', 1, NULL, '2019-10-30 17:48:46', '2019-10-30 17:48:46'),
(53, 'Wwwwinning10', NULL, NULL, '+100', 'winninggreat+100@gmail.com', '2019-10-30 18:08:47', 'noimage.jpg', '2717', 'gateman', '2', 'no', NULL, '0', '8d531de6972321a4', 1, NULL, '2019-10-30 18:08:22', '2019-10-30 18:08:47'),
(54, 'Win99', NULL, NULL, '+99', 'winninggreat+99@gmail.com', '2019-10-31 06:24:26', 'noimage.jpg', '8577', 'gateman', '2', 'no', NULL, '0', '8d531de6972321a4', 1, NULL, '2019-10-31 06:12:45', '2019-10-31 06:24:26'),
(55, 'W', NULL, NULL, '+101', 'winninggreat+101@gmail.com', '2019-10-31 21:38:28', 'noimage.jpg', '5122', 'gateman', '2', 'no', 'ehC5ii56830:APA91bEyXQxARF2rn-WFw6R_3o7pa4KQBNnZdbJ0zP7wyD3xmV-veYd9fcYTBZ-52ssk42RTLehwT1TVgdpCVWGNbvDOCpgf2RK6TLZJ_F0vbWdzE2-No_AU4AWjZHukwmh7N2rVjaEW', '0', '1c627828720e6dc7', 1, NULL, '2019-10-31 06:29:23', '2019-10-31 21:39:13'),
(56, 'Seun ogunyemi', NULL, NULL, '08035874478', 'timothyogunyemi@gmail.com', '2019-10-31 19:56:58', 'noimage.jpg', '6839', 'resident', '1', 'no', NULL, NULL, 'e7fc50cdb6b212a4', 1, NULL, '2019-10-31 19:56:15', '2019-10-31 19:56:58'),
(57, 'Alexander', NULL, NULL, '09067967853', 'alexandergaruba96@gmail.com', '2019-10-31 21:51:28', 'noimage.jpg', '8512', 'resident', '1', 'no', NULL, NULL, 'acbbd2d16dbb8f5e', 1, NULL, '2019-10-31 21:45:02', '2019-10-31 21:51:28'),
(58, 'Adike kizigo', NULL, NULL, '08137140110', 'adike@ail.com', NULL, 'noimage.jpg', '7455', 'resident', '1', 'no', NULL, NULL, 'f08ee4b797b733d3', 1, NULL, '2019-10-31 21:50:24', '2019-10-31 21:50:24'),
(59, 'VeronicaTee', NULL, NULL, '08053726116', 'vtomilola77@gmail.com', NULL, 'noimage.jpg', '4088', 'resident', '1', 'no', NULL, NULL, '767uei783e3jy8eie9e7m-38ie3ee', 1, NULL, '2019-11-01 04:28:20', '2019-11-01 04:37:01'),
(60, 'VeronicaTee', NULL, NULL, '08038343587', 'veronicatomilola@gmail.com', '2019-11-01 04:39:11', 'noimage.jpg', '8969', 'resident', '1', 'no', NULL, NULL, '767uei783e3jy8eie9e7m-38ie3ee', 1, NULL, '2019-11-01 04:37:25', '2019-11-01 04:39:11'),
(61, 'Loveth', NULL, NULL, '07061831022', 'kulloveth@yahoo.com', NULL, 'noimage.jpg', '4412', 'resident', '1', 'no', NULL, NULL, '8311c02678b86560', 1, NULL, '2019-11-01 06:04:28', '2019-11-01 06:04:28'),
(62, 'W', NULL, NULL, '+500', 'winninggreat+500@gmail.com', '2019-11-01 10:27:28', 'noimage.jpg', '4003', 'resident', '1', 'no', NULL, NULL, '1c627828720e6dc7', 1, NULL, '2019-11-01 10:26:33', '2019-11-01 10:27:28'),
(63, 'W', NULL, NULL, '+600', 'winninggreat+600@gmail.com', '2019-11-01 10:38:45', 'noimage.jpg', '5756', 'resident', '1', 'no', 'cfDOCnw7OY0:APA91bH7Dgg32vT0eWNRyWK7j06iL33Z05aF1wP06PuH1JidupCFLyrAU1Ub630Bp7Sc_bvoXh-rz1JLB9OhBJ14zT3CKzvAkfffrhmv4vb3nxjOjDT0BDmoHz9pT9dr96lfCq3GOrpT', NULL, '1c627828720e6dc7', 1, NULL, '2019-11-01 10:38:17', '2019-11-01 10:40:31'),
(64, NULL, NULL, '$2y$10$1M1jMk3nk6L5NNvjz6qrCebBu1dFS3swbN4Bhfppvd7oRT21D.8Va', NULL, 'e_fadairo@gmail.com', NULL, 'noimage.jpg', '7742', 'estate_admin', '3', 'no', NULL, NULL, NULL, 1, NULL, '2019-11-01 11:02:22', '2019-11-01 11:18:04');

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `arrival_date` date DEFAULT NULL,
  `car_plate_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_no` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `purpose` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `visitor_group` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` bigint(20) NOT NULL DEFAULT 1,
  `time_in` timestamp NULL DEFAULT NULL,
  `time_out` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `qr_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estate_id` int(11) DEFAULT NULL,
  `visiting_period` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_count` bigint(255) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `banned` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `name`, `arrival_date`, `car_plate_no`, `phone_no`, `purpose`, `image`, `visitor_group`, `status`, `time_in`, `time_out`, `user_id`, `qr_code`, `estate_id`, `visiting_period`, `description`, `visit_count`, `created_at`, `updated_at`, `banned`) VALUES
(2, 'terry banks', '2020-12-10', '', '', 'give me my dime', 'noimage.jpg', NULL, 1, '2019-10-30 12:22:22', '2019-10-30 13:47:59', 3, '3wUzAv', 7, 'night', '', 2, '2019-10-26 09:12:44', '2019-11-01 08:04:37', 0),
(3, 'Visit', '2019-11-15', 'JHG1234', '', 'well', 'pzayyjmzxlnuijjrazuf.jpg', NULL, 0, '2019-10-30 12:20:08', NULL, 4, 'NUpynu', 3, 'morning', '', 1, '2019-10-26 09:13:30', '2019-10-30 12:20:08', 0),
(4, 'yello', '2019-10-26', '', '', 'give me money', 'noimage.jpg', NULL, 0, NULL, NULL, 3, 'hlkNmP', 7, 'afternoon', '', 1, '2019-10-26 10:02:52', '2019-10-26 10:02:52', 0),
(5, 'Pelz', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 8, 'ZZMm10', 3, 'afternoon', '', 1, '2019-10-26 11:29:44', '2019-10-26 11:29:44', 0),
(6, 'Wuhhvvv', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'wBc8Zc', NULL, 'morning', '', 1, '2019-10-26 15:26:49', '2019-10-26 15:26:49', 0),
(7, 'Sijh', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'KX4bh6', NULL, 'morning', '', 1, '2019-10-26 16:52:03', '2019-10-26 16:52:03', 0),
(8, 'xxdr', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, '9CSJbL', NULL, 'morning', '', 1, '2019-10-26 16:52:36', '2019-10-26 16:52:36', 0),
(9, 'lol', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'xz93M7', NULL, 'morning', '', 1, '2019-10-26 17:05:44', '2019-10-26 17:05:44', 0),
(10, 'lol', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'dNwpIX', NULL, 'morning', '', 1, '2019-10-26 17:06:56', '2019-10-26 17:06:56', 0),
(11, 'bfff', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'MYzMvJ', NULL, 'morning', '', 1, '2019-10-26 17:07:17', '2019-10-26 17:07:17', 0),
(12, 'Sage Art', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'FkaJ7U', NULL, 'morning', '', 1, '2019-10-26 17:37:35', '2019-10-26 17:37:35', 0),
(13, 'plkjj', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'Ssen3J', NULL, 'morning', '', 1, '2019-10-26 17:43:30', '2019-10-26 17:43:30', 0),
(14, 'testing', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'ysuKLp', NULL, 'afternoon', '', 1, '2019-10-26 18:36:17', '2019-10-26 18:36:17', 0),
(15, 'Tantel Makeover', '2019-10-26', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'aRzkZZ', NULL, 'morning', '', 1, '2019-10-26 22:52:43', '2019-10-26 22:52:43', 0),
(16, 'Faith Torti', '2019-10-27', '', '', 'Marriage', 'noimage.jpg', NULL, 0, NULL, NULL, 5, 'czJRtc', NULL, 'afternoon', '', 1, '2019-10-27 01:04:26', '2019-10-27 01:04:26', 0),
(17, 'Like', '2019-10-27', '', '', 'none', 'k3gjf7lpn5nprv7ksk7c.jpg', NULL, 0, NULL, NULL, 9, '7HocYL', NULL, 'morning', '', 1, '2019-10-27 07:09:27', '2019-10-27 07:09:27', 0),
(18, 'Sweet', '2019-10-27', '', '', 'none', 'zt0u35macfph5wxepsrn.jpg', NULL, 0, NULL, NULL, 9, 'eMIJUA', NULL, 'morning', '', 1, '2019-10-27 07:14:40', '2019-10-27 07:14:40', 0),
(19, 'Testing the', '2019-10-27', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'AkMivn', NULL, 'morning', '', 1, '2019-10-27 07:21:49', '2019-10-27 07:21:49', 0),
(20, 'Afhh', '2019-10-27', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'nuKh5o', NULL, 'morning', '', 1, '2019-10-27 07:22:16', '2019-10-27 07:22:16', 0),
(21, 'ki', NULL, '', '', 'none', 'noimage.jpg', NULL, 0, '2019-10-30 14:50:41', '2019-10-30 15:06:37', 9, NULL, NULL, 'morning', '', 1, '2019-10-27 07:22:50', '2019-10-30 15:06:37', 0),
(22, 'date test', '2019-10-27', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'HD7e5C', NULL, 'morning', '', 1, '2019-10-27 07:28:00', '2019-10-27 07:28:00', 0),
(23, 'k', '2019-10-28', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'ipaFyP', NULL, 'morning', '', 1, '2019-10-27 07:45:38', '2019-10-27 07:45:38', 0),
(24, 'hjlo', '2019-10-27', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'U4Uu7Q', NULL, 'morning', '', 1, '2019-10-27 07:46:26', '2019-10-27 07:46:26', 0),
(25, 'rfffg', '2019-10-30', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, '4f5XgJ', NULL, 'afternoon', '', 1, '2019-10-27 10:47:01', '2019-10-27 10:47:01', 0),
(26, 'Red Screen', '2019-10-30', '', '', 'lol', 'd4vk6iiz7z4eeil6nelj.jpg', NULL, 0, NULL, NULL, 9, 'tDN2AX', NULL, 'afternoon', '', 1, '2019-10-27 10:52:36', '2019-10-27 10:52:36', 0),
(27, 'gjj', '2019-10-30', '', '', 'none', 'ahqfpu4j5imjypa1yxky.jpg', NULL, 0, NULL, NULL, 9, 'Cu45oL', NULL, 'morning', '', 1, '2019-10-28 00:44:10', '2019-10-28 00:44:10', 0),
(28, 'ijgc', '2019-10-28', '', '', 'none', 'au45hdtxdgwp9hir4gfv.jpg', NULL, 0, NULL, NULL, 9, 'feqx5G', NULL, 'morning', '', 1, '2019-10-28 01:28:55', '2019-10-28 01:28:55', 0),
(29, 'Jean Marie', '2019-10-28', '5555', '', 'for weed', 'noimage.jpg', NULL, 0, NULL, NULL, 19, 'mDbnxp', NULL, 'morning', '', 1, '2019-10-28 07:44:46', '2019-10-28 07:44:46', 0),
(30, 'Wats up', '2019-10-28', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'IKhuUU', NULL, 'morning', '', 1, '2019-10-28 07:52:11', '2019-10-28 07:52:11', 0),
(31, 'lphfff', '2019-10-28', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'Dnzr5W', NULL, 'morning', '', 1, '2019-10-28 08:10:18', '2019-10-28 08:10:18', 0),
(32, 'lphfff', '2019-10-28', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'eiHSFE', NULL, 'Evening', '', 1, '2019-10-28 08:10:34', '2019-10-28 08:10:34', 0),
(33, 'yhjk', '2019-10-28', '', '', 'none', 'noimage.jpg', NULL, 0, NULL, NULL, 9, 'UGU3Yx', NULL, 'Evening', '', 1, '2019-10-28 08:14:07', '2019-10-28 08:14:07', 0),
(34, 'John Kenfack', '2019-10-30', '', '', 'for weed too', 'y9nfq01ijfunvys2m4m7.jpg', NULL, 0, NULL, NULL, 19, 'spngJT', NULL, 'afternoon', '', 1, '2019-10-28 10:33:46', '2019-10-28 10:33:46', 0),
(35, 'Wifey', '2019-10-29', 'JJJ528', '', 'Check up on my baby', 'oycihfu2wryb3k7vhkom.jpg', NULL, 0, NULL, NULL, 9, 'FtFbPf', NULL, 'Evening', '', 1, '2019-10-29 09:15:43', '2019-10-29 09:15:43', 0),
(36, 'Frank', '2019-10-31', 'ZH633V', '', 'family', 'noimage.jpg', NULL, 0, NULL, NULL, 48, 'ej6KbD', NULL, 'afternoon', '', 1, '2019-10-29 19:41:18', '2019-10-29 19:41:18', 0),
(37, 'Jason Haywire', '2019-10-30', '', '', 'Friends', 'noimage.jpg', NULL, 0, NULL, NULL, 48, '4gvYoq', NULL, 'Evening', '', 1, '2019-10-29 19:42:39', '2019-10-29 19:42:39', 0),
(38, 'Okechukwu Oni', NULL, 'ZF-220-UYJ', '080334455667', 'Dignissimos est aperiam non.', 'noimage.jpg', NULL, 0, '2019-10-30 00:00:00', '2019-10-30 15:48:07', 21, NULL, NULL, 'Afetrnoon', 'He is a tall dark man with long bears', 1, '2019-10-30 08:26:15', '2019-10-30 15:48:07', 0),
(39, 'testing phone', '2019-10-31', 'Gh-G', '080564568', 'phone', 'ag80r1kp8i7hrtunfy4v.jpg', NULL, 0, NULL, NULL, 47, '66qARO', NULL, 'afternoon', '', 1, '2019-10-30 08:56:10', '2019-10-30 08:56:10', 0),
(40, 'Okechukwu Oni', '2020-12-10', 'ZF-220-UYJ', '', 'Dignissimos est aperiam non.', 'noimage.jpg', 'friend', 0, '2019-10-31 23:38:40', '2019-10-31 23:38:52', 21, NULL, NULL, 'Afternoon', 'He is a tall dark man with long bears', 2, '2019-10-30 14:00:15', '2019-10-31 23:38:52', 0),
(41, 'Okechukwu Oni', '2020-12-10', 'ZF-220-UYJ', '08023456787', 'Dignissimos est aperiam non.', 'noimage.jpg', 'friend', 1, NULL, '2019-10-30 15:17:04', 21, 'm5eitc', NULL, 'Afternoon', 'He is a tall dark man with long bears', 2, '2019-10-30 14:01:06', '2019-10-31 23:08:43', 0),
(42, 'Okechukwu Oni', NULL, 'ZF-220-UYJ', '08023456787', 'Dignissimos est aperiam non.', 'noimage.jpg', 'family', 0, NULL, '2019-10-30 15:17:04', 21, NULL, NULL, 'Afetrnoon', 'He is a tall dark man with long bears', 1, '2019-10-30 14:13:14', '2019-10-30 15:17:04', 0),
(43, 'great', '2019-10-30', 'JG543', '08134291805', 'visit', 'hkdbzb2ihg89lin31nbd.jpg', NULL, 0, NULL, NULL, 47, 'IcgnW3', NULL, 'morning', '', 1, '2019-10-30 16:11:07', '2019-10-30 16:11:07', 0),
(44, 'sweet', '2019-10-31', 'Hfhjj', 'hhvhi', 'stesl', 'noimage.jpg', '', 1, NULL, NULL, 9, 'rsLYz6', NULL, 'afternoon', '', 1, '2019-10-31 20:17:23', '2019-10-31 20:17:23', 0),
(45, 'Sylvester Stallone', '2019-10-31', '', '', 'Next hit movie', 'noimage.jpg', '', 1, NULL, NULL, 8, '4dyyNp', NULL, 'afternoon', '', 1, '2019-10-31 21:37:03', '2019-10-31 21:37:03', 0),
(46, 'Emily Oni', '2019-12-19', 'ZF-220-UYJ', '08023456787', 'Dignissimos est aperiam non.', 'noimage.jpg', 'Family', 0, '2019-11-01 11:56:18', '2019-11-01 11:56:29', 21, NULL, 1, 'Afetrnoon', 'She is really fair and tall', 1, '2019-10-31 23:12:03', '2019-11-01 11:56:29', 0),
(48, 'Emily Oni', '2020-12-25', 'ZF-220-UYJ', '08023456787', 'Dignissimos est aperiam non.', 'noimage.jpg', 'Family', 1, NULL, NULL, 21, 'U1lgH5', 1, 'Afternoon', 'She is really fair and tall', 8, '2019-10-31 23:14:26', '2019-10-31 23:59:59', 0),
(49, 'Emily Oni', '2019-12-19', 'ZF-220-UYJ', '08023456787', 'Dignissimos est aperiam non.', 'noimage.jpg', 'Family', 1, NULL, NULL, 21, '31bRbI', 1, 'Afetrnoon', 'She is really fair and tall', 1, '2019-11-01 00:04:33', '2019-11-01 00:04:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `visitors_history`
--

CREATE TABLE `visitors_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `visitor_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `visit_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `visitors_history`
--

INSERT INTO `visitors_history` (`id`, `visitor_id`, `user_id`, `visit_date`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2019-10-30', '2019-10-30 12:46:29', '2019-10-30 12:46:29'),
(2, 2, 3, '2019-10-30', '2019-10-30 13:30:48', '2019-10-30 13:30:48'),
(3, 2, 3, '2019-10-30', '2019-10-30 13:31:17', '2019-10-30 13:31:17'),
(4, 2, 3, '2019-10-30', '2019-10-30 13:32:34', '2019-10-30 13:32:34'),
(5, 2, 3, '2019-10-30', '2019-10-30 13:32:53', '2019-10-30 13:32:53'),
(6, 2, 3, '2019-10-26', '2019-10-30 13:40:59', '2019-10-30 13:40:59'),
(7, 2, 3, '2019-10-26', '2019-10-30 13:42:41', '2019-10-30 13:42:41'),
(8, 2, 3, '2019-10-26', '2019-10-30 13:44:28', '2019-10-30 13:44:28'),
(9, 2, 3, '2019-10-26', '2019-10-30 13:47:58', '2019-10-30 13:47:58'),
(10, 21, 9, '2019-10-27', '2019-10-30 15:05:46', '2019-10-30 15:05:46'),
(11, 38, 21, '1990-08-26', '2019-10-30 15:06:37', '2019-10-30 15:06:37'),
(12, 38, 21, '1990-08-26', '2019-10-30 15:07:22', '2019-10-30 15:07:22'),
(13, 38, 21, '2019-10-30', '2019-10-30 15:17:04', '2019-10-30 15:17:04'),
(14, 38, 21, '2019-10-30', '2019-10-30 15:24:03', '2019-10-30 15:24:03'),
(15, 38, 21, '2019-10-30', '2019-10-30 15:40:30', '2019-10-30 15:40:30'),
(16, 38, 21, '2019-10-30', '2019-10-30 15:48:08', '2019-10-30 15:48:08'),
(17, 38, 21, '2019-10-30', '2019-10-31 23:26:15', '2019-10-31 23:26:15'),
(18, 38, 21, '2019-10-30', '2019-10-31 23:33:27', '2019-10-31 23:33:27'),
(19, 38, 21, '2019-10-30', '2019-10-31 23:37:19', '2019-10-31 23:37:19'),
(20, 38, 21, '2019-10-30', '2019-10-31 23:38:53', '2019-10-31 23:38:53'),
(21, 38, 21, '2019-10-30', '2019-10-31 23:45:51', '2019-10-31 23:45:51'),
(22, 48, 21, '2019-10-31', '2019-10-31 23:54:07', '2019-10-31 23:54:07'),
(23, 48, 21, '2019-10-31', '2019-10-31 23:59:06', '2019-10-31 23:59:06'),
(24, 46, 21, '2019-11-01', '2019-11-01 11:56:30', '2019-11-01 11:56:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estates`
--
ALTER TABLE `estates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estates_address_unique` (`address`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gateman_notifications`
--
ALTER TABLE `gateman_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gateman_notifications_resident_id_foreign` (`resident_id`),
  ADD KEY `gateman_notifications_gateman_id_foreign` (`gateman_id`),
  ADD KEY `gateman_notifications_visitor_id_foreign` (`visitor_id`),
  ADD KEY `gateman_notifications_home_id_foreign` (`home_id`);

--
-- Indexes for table `homes`
--
ALTER TABLE `homes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homes_user_id_foreign` (`user_id`),
  ADD KEY `homes_estate_id_foreign` (`estate_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_home_id_foreign` (`home_id`);

--
-- Indexes for table `resident_gateman`
--
ALTER TABLE `resident_gateman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resident_gateman_user_id_foreign` (`user_id`),
  ADD KEY `resident_gateman_gateman_id_foreign` (`gateman_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scheduled_visits`
--
ALTER TABLE `scheduled_visits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scheduled_visits_user_id_foreign` (`user_id`),
  ADD KEY `scheduled_visits_visitor_id_foreign` (`visitor_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_providers_estate_id_foreign` (`estate_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_user_id_foreign` (`user_id`);

--
-- Indexes for table `sp_category`
--
ALTER TABLE `sp_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supports`
--
ALTER TABLE `supports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_fcm_column_unique` (`fcm_token`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_user_id_foreign` (`user_id`);

--
-- Indexes for table `visitors_history`
--
ALTER TABLE `visitors_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visitors_history_user_id_foreign` (`user_id`),
  ADD KEY `visitors_history_visitor_id_foreign` (`visitor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estates`
--
ALTER TABLE `estates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gateman_notifications`
--
ALTER TABLE `gateman_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homes`
--
ALTER TABLE `homes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `newsletter_subscribers`
--
ALTER TABLE `newsletter_subscribers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resident_gateman`
--
ALTER TABLE `resident_gateman`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `scheduled_visits`
--
ALTER TABLE `scheduled_visits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_category`
--
ALTER TABLE `sp_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supports`
--
ALTER TABLE `supports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `visitors_history`
--
ALTER TABLE `visitors_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gateman_notifications`
--
ALTER TABLE `gateman_notifications`
  ADD CONSTRAINT `gateman_notifications_gateman_id_foreign` FOREIGN KEY (`gateman_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gateman_notifications_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `homes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gateman_notifications_resident_id_foreign` FOREIGN KEY (`resident_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gateman_notifications_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `homes`
--
ALTER TABLE `homes`
  ADD CONSTRAINT `homes_estate_id_foreign` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `homes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_home_id_foreign` FOREIGN KEY (`home_id`) REFERENCES `homes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `resident_gateman`
--
ALTER TABLE `resident_gateman`
  ADD CONSTRAINT `resident_gateman_gateman_id_foreign` FOREIGN KEY (`gateman_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `resident_gateman_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `scheduled_visits`
--
ALTER TABLE `scheduled_visits`
  ADD CONSTRAINT `scheduled_visits_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scheduled_visits_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD CONSTRAINT `service_providers_estate_id_foreign` FOREIGN KEY (`estate_id`) REFERENCES `estates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors`
--
ALTER TABLE `visitors`
  ADD CONSTRAINT `visitors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visitors_history`
--
ALTER TABLE `visitors_history`
  ADD CONSTRAINT `visitors_history_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visitors_history_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `visitors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
