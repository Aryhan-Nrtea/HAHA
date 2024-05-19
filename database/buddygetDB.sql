-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 05:33 AM
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
-- Database: `expense_budget_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(30) NOT NULL,
  `user_id` int(50) NOT NULL,
  `category` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `balance` float NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category`, `description`, `status`, `balance`, `date_created`, `date_updated`) VALUES
(35, 16, 'Rent', '', 1, 1000, '2024-05-07 15:03:15', '2024-05-07 15:03:32'),
(36, 16, 'Water', '', 1, 100, '2024-05-09 09:16:58', '2024-05-09 09:18:17'),
(41, 1, 'Rent\r\n', '&lt;p&gt;Test1&lt;/p&gt;', 1, 500, '2024-05-09 10:57:02', '2024-05-09 11:01:18'),
(42, 1, 'Water', '&lt;p&gt;Test2&lt;/p&gt;', 1, 500, '2024-05-09 10:57:49', '2024-05-09 11:01:40'),
(43, 1, 'Snacks', '&lt;p&gt;Test3&lt;/p&gt;', 1, 250, '2024-05-09 10:58:09', '2024-05-09 11:01:54'),
(44, 1, 'Electricity', '&lt;p&gt;Test4&lt;/p&gt;', 1, 2000, '2024-05-09 10:58:23', '2024-05-09 11:28:09'),
(45, 1, 'Fare', '&lt;p&gt;Test5&lt;/p&gt;', 1, 250, '2024-05-09 10:58:33', '2024-05-09 11:02:24');

-- --------------------------------------------------------

--
-- Table structure for table `running_balance`
--

CREATE TABLE `running_balance` (
  `id` int(30) NOT NULL,
  `u_id` int(50) NOT NULL,
  `balance_type` tinyint(1) NOT NULL COMMENT '1=budget, 2=expense',
  `category_id` int(30) NOT NULL,
  `amount` float NOT NULL,
  `remarks` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `running_balance`
--

INSERT INTO `running_balance` (`id`, `u_id`, `balance_type`, `category_id`, `amount`, `remarks`, `date_created`, `date_updated`) VALUES
(79, 16, 1, 35, 1000, '', '2024-05-07 15:03:32', NULL),
(82, 16, 1, 36, 200, '', '2024-05-09 09:17:54', NULL),
(83, 16, 2, 36, 100, '', '2024-05-09 09:18:17', NULL),
(85, 1, 1, 41, 1000, '&lt;p&gt;Test1&lt;/p&gt;', '2024-05-09 10:57:17', NULL),
(86, 1, 1, 42, 1000, '&lt;p&gt;Test2&lt;/p&gt;', '2024-05-09 10:59:10', '2024-05-09 10:59:49'),
(87, 1, 1, 43, 500, '&lt;p&gt;Test3&lt;/p&gt;', '2024-05-09 10:59:20', '2024-05-09 11:00:07'),
(88, 1, 1, 44, 5000, '&lt;p&gt;Test4&lt;/p&gt;', '2024-05-09 10:59:27', '2024-05-09 11:00:15'),
(89, 1, 1, 45, 500, '&lt;p&gt;Test5&lt;/p&gt;', '2024-05-09 10:59:37', '2024-05-09 11:00:24'),
(90, 1, 2, 41, 500, '&lt;p&gt;Test1&lt;/p&gt;', '2024-05-09 11:01:17', NULL),
(91, 1, 2, 42, 500, '&lt;p&gt;Test2&lt;/p&gt;', '2024-05-09 11:01:40', NULL),
(92, 1, 2, 43, 250, '&lt;p&gt;Test3&lt;/p&gt;', '2024-05-09 11:01:54', NULL),
(93, 1, 2, 44, 2500, '&lt;p&gt;Test4&lt;/p&gt;', '2024-05-09 11:02:06', NULL),
(94, 1, 2, 45, 250, '&lt;p&gt;Test5&lt;/p&gt;', '2024-05-09 11:02:24', NULL),
(95, 1, 2, 44, 500, '', '2024-05-09 11:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'BuddyGet: Savings Management System'),
(6, 'short_name', 'BuddyGet'),
(11, 'logo', 'uploads/1627606920_modeylogo.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Arian', 'Nartea', 'Arian', '0192023a7bbd73250516f069df18b500', 'uploads/1713767700_taytay.jpg', NULL, 1, '2021-01-20 14:02:37', '2024-05-07 14:42:23'),
(16, 'Dummy', 'Account', 'Test', 'cc03e747a6afbbcbf8be7668acfebee5', NULL, NULL, 0, '2024-04-30 11:34:45', '2024-05-07 09:52:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `running_balance`
--
ALTER TABLE `running_balance`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `running_balance`
--
ALTER TABLE `running_balance`
  ADD CONSTRAINT `running_balance_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `running_balance_ibfk_2` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
