-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2019 at 08:19 AM
-- Server version: 8.0.13-4
-- PHP Version: 7.2.19-0ubuntu0.18.04.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bQkd29is69`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `verifycode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('admin','resident','gateman') COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('0','1','2') COLLATE utf8mb4_unicode_ci NOT NULL,
  `duty_time` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `2_factor_enabled` enum('no','yes') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fcm_token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `phone`, `email`, `email_verified_at`, `image`, `verifycode`, `user_type`, `role`, `duty_time`, `2_factor_enabled`, `fcm_token`, `device_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Vtomilola Emiola', NULL, '08053726116', 'vtomilola@gmail.com', NULL, 'noimage.jpg', '2681', 'resident', '1', NULL, 'no', NULL, '3455447679105817', NULL, '2019-10-24 20:12:14', '2019-10-24 20:12:14'),
(3, 'David Codefire', NULL, '07060959269', 'junipreach2017@gmail.com', NULL, 'noimage.jpg', '3790', 'resident', '1', NULL, 'no', NULL, '767uei783e3jy8eie9e7m-38ie3ee', NULL, '2019-10-24 20:23:15', '2019-10-25 08:18:02'),
(4, 'Winning', NULL, '08156664098', 'winninggreat@gmail.com', '2019-10-24 20:29:11', 'noimage.jpg', '7808', 'resident', '1', NULL, 'no', NULL, '1c627828720e6dc7', NULL, '2019-10-24 20:28:01', '2019-10-24 20:29:11'),
(5, 'Kelvin', NULL, '08038287791', 'mawhizzle@gmail.com', '2019-10-24 20:54:19', 'noimage.jpg', '8872', 'resident', '1', NULL, 'no', NULL, '60941add93489015', NULL, '2019-10-24 20:53:52', '2019-10-24 20:54:19'),
(6, 'Gradia', NULL, '0850194544', 'gradimutdev@gmail.com', '2019-10-24 21:15:23', 'noimage.jpg', '4200', 'resident', '1', NULL, 'no', NULL, '257a54de86804f91', NULL, '2019-10-24 21:14:59', '2019-10-24 21:15:23'),
(7, 'Jackie', NULL, '6600', 'bgbiri92@gmail.com', '2019-10-24 21:18:55', 'noimage.jpg', '2854', 'resident', '1', NULL, 'no', NULL, '6b3c2d6d07a6cb0b', NULL, '2019-10-24 21:18:00', '2019-10-24 21:18:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_fcm_column_unique` (`fcm_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
