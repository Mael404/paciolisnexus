-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 07:19 PM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpa_details`
--
ALTER TABLE `cpa_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpa_details`
--
ALTER TABLE `cpa_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
