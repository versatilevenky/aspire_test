-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2021 at 01:57 PM
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
-- Database: `aspire`
--

-- --------------------------------------------------------

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
