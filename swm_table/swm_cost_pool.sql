-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 02:38 PM
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
-- Table structure for table `swm_cost_pool`
--

CREATE TABLE `swm_cost_pool` (
  `scp_id` int(11) NOT NULL,
  `scp_age_min` int(11) DEFAULT '0',
  `scp_age_max` int(11) DEFAULT '99',
  `scp_cost` int(11) DEFAULT NULL,
  `scp_sug_id` int(11) NOT NULL,
  `scp_reference` int(11) NOT NULL COMMENT 'รหัสอ้างอิงของการตั้งค่าราคาเข้าใช้',
  `scp_is_active` varchar(5) NOT NULL DEFAULT 'N' COMMENT 'Y = เปิดใช้งาย ,  N =  ปิดใช้งาน',
  `scp_create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `scp_update_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swm_cost_pool`
--

INSERT INTO `swm_cost_pool` (`scp_id`, `scp_age_min`, `scp_age_max`, `scp_cost`, `scp_sug_id`, `scp_reference`, `scp_is_active`) VALUES
(1, 0, 17, 300, 2, 1, 'N'),
(2, 18, 99, 500, 2, 1, 'N'),
(3, 0, 17, 350, 1, 2, 'Y'),
(4, 18, 99, 550, 1, 2, 'Y'),
(6, 0, 17, 100, 2, 3, 'Y'),
(7, 18, 99, 250, 2, 3, 'Y'),
(8, 0, 17, 400, 1, 4, 'N'),
(9, 18, 99, 600, 1, 4, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swm_cost_pool`
--
ALTER TABLE `swm_cost_pool`
  ADD PRIMARY KEY (`scp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swm_cost_pool`
--
ALTER TABLE `swm_cost_pool`
  MODIFY `scp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
