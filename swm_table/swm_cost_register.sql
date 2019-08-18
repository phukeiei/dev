-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 02:39 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsp60_swmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `swm_cost_register`
--

CREATE TABLE `swm_cost_register` (
  `scr_id` int(11) NOT NULL,
  `scr_age_min` int(11) DEFAULT '0',
  `scr_age_max` int(11) DEFAULT '99',
  `scr_cost` int(11) DEFAULT NULL,
  `scr_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `scr_update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swm_cost_register`
--

INSERT INTO `swm_cost_register` (`scr_id`, `scr_age_min`, `scr_age_max`, `scr_cost`) VALUES
(1, 0, 17, 300),
(2, 18, 99, 500);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swm_cost_register`
--
ALTER TABLE `swm_cost_register`
  ADD PRIMARY KEY (`scr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swm_cost_register`
--
ALTER TABLE `swm_cost_register`
  MODIFY `scr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
