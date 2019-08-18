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
-- Table structure for table `swm_flow_state`
--

CREATE TABLE `swm_flow_state` (
  `sfs_id` int(11) NOT NULL COMMENT 'PK รหัสขั้นตอน',
  `sfs_create_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้างขั้นตอน',
  `sfs_su_id` int(11) NOT NULL COMMENT 'id สมาชิกจากตาราง swm_user',
  `sfs_ss_id` int(11) NOT NULL COMMENT 'id สถานะจากตาราง swm_status',
  `sfs_comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'ความคิดเห็น/เหตุผล'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swm_flow_state`
--

INSERT INTO `swm_flow_state` (`sfs_id`, `sfs_su_id`, `sfs_ss_id`, `sfs_comment`) VALUES
(1, 1, 3, 'ghjghmghmgmh'),
(2, 1, 1, ''),
(3, 1, 2, ''),
(4, 1, 1, 'ggggg'),
(5, 1, 2, 'ttttt'),
(6, 1, 2, 'ttttt'),
(7, 7, 2, ''),
(8, 7, 2, ''),
(9, 7, 2, ''),
(10, 7, 2, ''),
(11, 7, 2, ''),
(12, 7, 2, ''),
(13, 7, 2, ''),
(14, 7, 2, ''),
(15, 7, 2, ''),
(16, 7, 2, ''),
(17, 7, 2, ''),
(18, 7, 2, ''),
(19, 7, 2, ''),
(20, 7, 2, ''),
(21, 7, 2, ''),
(22, 7, 1, ''),
(23, 1, 1, ''),
(24, 1, 2, ''),
(25, 2, 1, ''),
(26, 2, 2, ''),
(27, 7, 3, ''),
(28, 0, 1, ''),
(29, 12, 2, ''),
(30, 0, 2, ''),
(31, 0, 2, ''),
(32, 0, 2, ''),
(33, 41, 4, ''),
(34, 0, 4, ''),
(35, 0, 1, ''),
(36, 0, 2, ''),
(37, 0, 0, ''),
(38, 0, 4, ''),
(39, 0, 1, ''),
(40, 0, 2, ''),
(41, 0, 2, ''),
(42, 0, 1, ''),
(43, 1, 2, ''),
(44, 0, 2, ''),
(45, 0, 2, ''),
(46, 0, 1, ''),
(47, 0, 2, ''),
(48, 1, 1, ''),
(49, 1, 3, 'กก'),
(50, 1, 2, 'ดกหหด'),
(51, 1, 3, ''),
(52, 1, 2, ''),
(53, 2, 1, 'op[pk[op'),
(54, 1, 3, ';uiuui'),
(55, 1, 3, ';uiuui'),
(56, 1, 3, ';uiuui'),
(57, 1, 2, ''),
(58, 1, 2, ''),
(59, 1, 2, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swm_flow_state`
--
ALTER TABLE `swm_flow_state`
  ADD PRIMARY KEY (`sfs_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swm_flow_state`
--
ALTER TABLE `swm_flow_state`
  MODIFY `sfs_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK รหัสขั้นตอน', AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
