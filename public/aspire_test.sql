-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 01:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aspire_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `request_amount` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `user_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manager_remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_amount` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `approved_date` timestamp NULL DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `user_id`, `request_date`, `request_amount`, `term`, `user_remarks`, `manager_remarks`, `approved_amount`, `status`, `approved_date`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2021-05-26 10:38:44', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 05:08:44', 2, '2021-05-26 05:08:43', '2021-05-26 05:08:44'),
(2, 1, '2021-05-26 11:12:54', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 05:42:54', 2, '2021-05-26 05:10:18', '2021-05-26 05:42:54'),
(3, 1, '2021-05-26 11:23:28', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 05:53:28', 2, '2021-05-26 05:11:01', '2021-05-26 05:53:28'),
(4, 1, '2021-05-26 11:23:28', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 05:53:28', 2, '2021-05-26 05:15:43', '2021-05-26 05:53:28'),
(5, 1, '2021-05-26 11:25:00', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 05:55:00', 2, '2021-05-26 05:17:06', '2021-05-26 05:55:00'),
(6, 1, '2021-05-26 11:25:00', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 05:55:00', 2, '2021-05-26 05:18:01', '2021-05-26 05:55:00'),
(7, 1, '2021-05-26 11:29:11', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 05:59:11', 2, '2021-05-26 05:18:48', '2021-05-26 05:59:11'),
(8, 1, '2021-05-26 11:29:11', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 05:59:11', 2, '2021-05-26 05:22:22', '2021-05-26 05:59:11'),
(9, 1, '2021-05-26 11:30:04', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 06:00:04', 2, '2021-05-26 05:22:23', '2021-05-26 06:00:04'),
(10, 1, '2021-05-26 11:30:04', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 06:00:04', 2, '2021-05-26 05:23:19', '2021-05-26 06:00:04'),
(11, 1, '2021-05-26 11:33:58', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 06:03:58', 2, '2021-05-26 05:23:20', '2021-05-26 06:03:58'),
(12, 1, '2021-05-26 11:33:58', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 06:03:58', 2, '2021-05-26 05:38:43', '2021-05-26 06:03:58'),
(13, 1, '2021-05-26 11:44:12', 1000, 3, NULL, NULL, 1000, 1, '2021-05-26 06:14:12', 2, '2021-05-26 05:38:43', '2021-05-26 06:14:12'),
(14, 1, '2021-05-26 11:44:13', 1000, 3, NULL, NULL, 0, 2, '2021-05-26 06:14:13', 2, '2021-05-26 05:39:46', '2021-05-26 06:14:13'),
(15, 1, '2021-05-26 11:09:46', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:39:46', '2021-05-26 05:39:46'),
(16, 1, '2021-05-26 11:11:18', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:41:18', '2021-05-26 05:41:18'),
(17, 1, '2021-05-26 11:11:19', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:41:19', '2021-05-26 05:41:19'),
(18, 1, '2021-05-26 11:12:53', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:42:53', '2021-05-26 05:42:53'),
(19, 1, '2021-05-26 11:23:28', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:53:28', '2021-05-26 05:53:28'),
(20, 1, '2021-05-26 11:24:59', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:54:59', '2021-05-26 05:54:59'),
(21, 1, '2021-05-26 11:29:10', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 05:59:10', '2021-05-26 05:59:10'),
(22, 1, '2021-05-26 11:30:04', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 06:00:04', '2021-05-26 06:00:04'),
(23, 1, '2021-05-26 11:33:58', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 06:03:58', '2021-05-26 06:03:58'),
(24, 1, '2021-05-26 11:44:12', 1000, 3, NULL, NULL, 0, 0, NULL, NULL, '2021-05-26 06:14:12', '2021-05-26 06:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `loan_repayments`
--

CREATE TABLE `loan_repayments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) NOT NULL,
  `amount` int(11) NOT NULL,
  `paid_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_repayments`
--

INSERT INTO `loan_repayments` (`id`, `loan_id`, `amount`, `paid_date`, `created_at`, `updated_at`) VALUES
(1, 1, 100, '2021-05-26 06:14:13', '2021-05-26 06:14:13', '2021-05-26 06:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(11) NOT NULL,
  `api_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`, `api_token`) VALUES
(1, 'ABC', 'abc@gmail.com', '2021-05-25 13:21:33', '$2y$12$ej5utrURvEln24i6Zhl6WuJ/ih0vlwZdfAmsrEVsyAQUe/oRTZK6i', NULL, '2021-05-25 13:21:33', '2021-05-25 11:04:23', 1, 'd05620f71a677c2acc6b4ab2f6e11134'),
(2, 'loan_manager1', 'loan_manager1@aspireapp.com', NULL, '$2y$12$DHH.ZrV8yyGMnz.yoGdIUOa9X7sy1mO034n7QrEy1DcPaEHfbUiJS', NULL, '2021-05-25 19:25:20', '2021-05-25 13:55:59', 2, 'ea0b77d84d5064283bb9daef4af7df5d');

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
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approved_by` (`approved_by`);

--
-- Indexes for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `loan_repayments`
--
ALTER TABLE `loan_repayments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
