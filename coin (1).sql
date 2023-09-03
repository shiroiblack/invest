-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 11:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coin`
--

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_data`
--

CREATE TABLE `dashboard_data` (
  `id` int(11) NOT NULL,
  `deposit_wallet` decimal(10,2) DEFAULT NULL,
  `interest_wallet` decimal(10,2) DEFAULT NULL,
  `total_deposit` decimal(10,2) DEFAULT NULL,
  `total_invest` decimal(10,2) DEFAULT NULL,
  `total_withdraw` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `available_funds` decimal(10,2) DEFAULT NULL,
  `interest_wallet_balance` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deposit_history`
--

CREATE TABLE `deposit_history` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `gateway_title` varchar(255) NOT NULL,
  `pending_deposit_amount` decimal(10,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `pending_status` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `start_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `interest_rate` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `deposit_history`
--

INSERT INTO `deposit_history` (`id`, `email`, `username`, `gateway_title`, `pending_deposit_amount`, `transaction_id`, `pending_status`, `created_at`, `start_date`, `duration`, `interest_rate`, `status`) VALUES
(29, 'hdiwuedhgwiu@gmail.com', 'peter', 'Bitcoin', 99999999.99, 'THVI3QNB8Y', 0, '2023-06-09 01:07:03', NULL, NULL, NULL, NULL),
(30, 'hdiwuedhgwiu@gmail.com', 'peter', 'Bitcoin', 87687.00, 'NTRM5OCYGQ', 0, '2023-06-09 01:11:33', NULL, NULL, NULL, NULL),
(31, 'hdiwuedhgwiu@gmail.com', 'peter', 'Bitcoin', 99999999.99, 'UJZS0H5M0R', 0, '2023-06-09 01:17:31', NULL, NULL, NULL, NULL),
(32, 'hdiwuedhgwiu@gmail.com', 'peter', 'Bitcoin', 97907070.00, 'TQ2QKPEGB0', 0, '2023-06-09 06:18:11', NULL, NULL, NULL, NULL),
(33, 'hdiwuedhgwiu@gmail.com', 'peter', 'Ethereum', 67576567.00, '7FI4Q1X5JC', 0, '2023-06-09 06:31:49', NULL, NULL, NULL, NULL),
(34, 'hdiwuedhgwiu@gmail.com', 'peter', 'Ethereum', 67576567.00, '7FI4Q1X5JC', 0, '2023-06-09 06:31:56', NULL, NULL, NULL, NULL),
(35, 'yfuyfyfyf@gmail.com', 'test', 'Bitcoin', 767676.00, 'KNRX650C5A', 0, '2023-06-09 21:49:57', NULL, NULL, NULL, NULL),
(36, 'yfuyfyfyf@gmail.com', 'test', 'Ethereum', 677676.00, 'ETT7IEA2Z8', 1, '2023-06-09 21:51:11', NULL, NULL, NULL, NULL),
(37, 'peter@gmail.com', 'peter', 'Bitcoin', 7878.00, 'C23FWMGBJ3', 0, '2023-06-09 23:14:01', NULL, NULL, NULL, NULL),
(38, 'peter@gmail.com', 'peter', 'Bitcoin', 7878.00, 'C23FWMGBJ3', 0, '2023-06-09 23:40:58', NULL, NULL, NULL, NULL),
(39, 'shgjsdjh@gmail.com', 'deji', 'Ethereum', 2000.00, 'MGMWKGU610', 0, '2023-06-10 09:04:50', NULL, NULL, NULL, NULL),
(40, 'shgjsdjh@gmail.com', 'deji', 'Bitcoin', 8900.00, 'KQ0W97W2EQ', 0, '2023-06-10 19:38:31', NULL, NULL, NULL, NULL),
(41, 'peter@gmail.com', 'peter', 'Bitcoin', 56464.00, 'FCW2J4MM24', 0, '2023-06-11 17:01:17', NULL, NULL, NULL, NULL),
(42, 'peter@gmail.com', 'peter', 'Bitcoin', 7888.00, 'D8RJIWZ832', 0, '2023-06-11 17:21:04', NULL, NULL, NULL, NULL),
(43, 'peter@gmail.com', 'peter', 'Bitcoin', 7888.00, 'D8RJIWZ832', 0, '2023-06-11 17:21:42', NULL, NULL, NULL, NULL),
(44, 'peter@gmail.com', 'peter', 'Ethereum', 6700.00, 'IS1ABDMLLZ', 0, '2023-06-11 18:22:57', NULL, NULL, NULL, NULL),
(45, 'peter@gmail.com', 'peter', 'Bitcoin', 7800.00, 'MFUUXGI8D0', 1, '2023-06-11 18:26:08', NULL, NULL, NULL, NULL),
(46, 'peter@gmail.com', 'peter', 'Bitcoin', 3400.00, '1AYEGQ0VKK', 0, '2023-06-11 18:26:27', NULL, NULL, NULL, NULL),
(47, 'shgjsdjh@gmail.com', 'deji', 'Bitcoin', 5000.00, '5EP07UHR77', 0, '2023-06-12 00:51:12', NULL, NULL, NULL, NULL),
(48, 'shgjsdjh@gmail.com', 'deji', 'Ethereum', 10000.00, 'HSHVPZ57T6', 0, '2023-06-12 01:06:58', NULL, NULL, NULL, NULL),
(49, '', 'deji', '', 2000.00, '', 1, '2023-06-12 08:20:47', '2023-06-12', 7, 1.50, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `deposit_table`
--

CREATE TABLE `deposit_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `pending_deposit_amount` decimal(10,2) DEFAULT NULL,
  `gateway_type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `interest_rate` decimal(4,2) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `user_id`, `amount`, `start_date`, `duration`, `interest_rate`, `status`) VALUES
(1, 0, 1000.00, '2023-06-12', 7, 1.50, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `terms` varchar(255) DEFAULT NULL,
  `deposit_wallet_balance` decimal(10,2) DEFAULT 0.00,
  `interest_wallet_balance` decimal(10,2) DEFAULT 0.00,
  `total_deposit` decimal(10,2) DEFAULT 0.00,
  `total_invest` decimal(10,2) DEFAULT 0.00,
  `total_withdraw` decimal(10,2) DEFAULT 0.00,
  `balance_in_account` decimal(10,2) DEFAULT 0.00,
  `interest_wallet` decimal(10,2) DEFAULT 0.00,
  `total` decimal(10,2) DEFAULT 0.00,
  `pending_deposit_amount` decimal(10,2) DEFAULT 0.00,
  `transaction_id` varchar(255) DEFAULT NULL,
  `referrer_id` int(11) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `country`, `mobile`, `email`, `username`, `password`, `terms`, `deposit_wallet_balance`, `interest_wallet_balance`, `total_deposit`, `total_invest`, `total_withdraw`, `balance_in_account`, `interest_wallet`, `total`, `pending_deposit_amount`, `transaction_id`, `referrer_id`, `referrer`) VALUES
(9, 'peter', 'mbah', 'AF', '7856757', 'peter@gmail.com', 'peter', '54321', 'on', -43308517.00, 0.00, 3400.00, 99999999.99, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL),
(10, 'emma', 'emma', 'AF', '6252626', 'hdiwuedhgwiu@gmail.com', 'tiger', '54321', 'on', 7878.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL),
(11, 'henry', 'harp', 'AF', '8775765', 'yfuyfyfyf@gmail.com', 'test', 'test', 'on', 7878.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, NULL),
(12, 'deji', 'chef', 'AT', '764736847', 'shgjsdjh@gmail.com', 'deji', '54321', 'on', 743.00, 12.00, 15000.00, 24957.00, 0.00, 0.00, 0.00, 755.00, 0.00, NULL, NULL, NULL),
(13, 'mike', 'milan', 'AF', '+234454553333', 'milan@gmail.com', 'mike', '54321', 'on', 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, NULL, 'deji');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dashboard_data`
--
ALTER TABLE `dashboard_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deposit_history`
--
ALTER TABLE `deposit_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
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
-- AUTO_INCREMENT for table `dashboard_data`
--
ALTER TABLE `dashboard_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deposit_history`
--
ALTER TABLE `deposit_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
