-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2025 at 06:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pnexus`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpa_details`
--

CREATE TABLE `cpa_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `diploma` varchar(255) NOT NULL,
  `gov_id` varchar(255) NOT NULL,
  `selfie` varchar(255) NOT NULL,
  `modules` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL DEFAULT 'Unverified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpa_details`
--

INSERT INTO `cpa_details` (`id`, `user_id`, `full_name`, `email`, `phone`, `diploma`, `gov_id`, `selfie`, `modules`, `license`, `created_at`, `status`) VALUES
(3, 9, 'Pepito Manaloto', 'cpa@gmail.com', '09214027874', 'uploads/1000012195_fc0da0b64c.jpg', 'uploads/1000012195_fc0da0b64c.jpg', 'uploads/1000012195_fc0da0b64c.jpg', 'uploads/1000012195_fc0da0b64c.jpg', 'uploads/1000012195_fc0da0b64c.jpg', '2025-01-24 15:47:24', 'Verified');

-- --------------------------------------------------------

--
-- Table structure for table `gamified`
--

CREATE TABLE `gamified` (
  `gamefied_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `afr` int(11) DEFAULT NULL,
  `afar` int(11) DEFAULT NULL,
  `taxation` int(11) DEFAULT NULL,
  `auditing` int(11) DEFAULT NULL,
  `rfbt` int(11) DEFAULT NULL,
  `mds` int(11) DEFAULT NULL,
  `quiz_status` varchar(50) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `quiz_title` varchar(255) NOT NULL,
  `gcash_name` varchar(255) NOT NULL,
  `gcash_number` varchar(20) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending',
  `timer` varchar(10) NOT NULL DEFAULT 'disabled',
  `attempt` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `homeworkhelp`
--

CREATE TABLE `homeworkhelp` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `afr` int(11) DEFAULT NULL,
  `afar` int(11) DEFAULT NULL,
  `taxation` int(11) DEFAULT NULL,
  `auditing` int(11) DEFAULT NULL,
  `rfbt` int(11) DEFAULT NULL,
  `mds` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `subject_title` varchar(255) DEFAULT NULL,
  `assignment_difficulty` varchar(50) DEFAULT NULL,
  `urgency` varchar(50) DEFAULT NULL,
  `assignment_question` text DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gcash_name` varchar(255) DEFAULT NULL,
  `payment_proof` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaderboards`
--

CREATE TABLE `leaderboards` (
  `id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `code` text NOT NULL,
  `academic_level` varchar(255) DEFAULT NULL,
  `learning_goals` text DEFAULT NULL,
  `areas_of_difficulty` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verify` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `code`, `academic_level`, `learning_goals`, `areas_of_difficulty`, `created_at`, `verify`) VALUES
(7, 'Aelred', 'student@gmail.com', 'a01610228fe998f515a72dd730294d87', '', '', NULL, NULL, NULL, '2025-01-02 03:12:43', 0),
(8, 'Alyssa', 'admin@gmail.com', 'a01610228fe998f515a72dd730294d87', 'admin', '', NULL, NULL, NULL, '2025-01-22 00:37:55', 0),
(9, 'Pepito Manaloto', 'aelred123456@gmail.com', 'a01610228fe998f515a72dd730294d87', 'CPA', '', NULL, NULL, NULL, '2025-01-24 15:15:38', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpa_details`
--
ALTER TABLE `cpa_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gamified`
--
ALTER TABLE `gamified`
  ADD PRIMARY KEY (`gamefied_id`);

--
-- Indexes for table `homeworkhelp`
--
ALTER TABLE `homeworkhelp`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `leaderboards`
--
ALTER TABLE `leaderboards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpa_details`
--
ALTER TABLE `cpa_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gamified`
--
ALTER TABLE `gamified`
  MODIFY `gamefied_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000348179;

--
-- AUTO_INCREMENT for table `homeworkhelp`
--
ALTER TABLE `homeworkhelp`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaderboards`
--
ALTER TABLE `leaderboards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
