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
-- Table structure for table `swm_user_group`
--

CREATE TABLE `swm_user_group` (
  `sug_id` int(11) NOT NULL COMMENT 'PK  รหัสกลุ่มสมาชิก',
  `sug_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT 'ชื่อประเภทกลุ่มสมาชิก',
  `sug_create_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT 'วันที่สร้างกลุ่มสมาชิก',
  `sug_update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'วันที่แก้ไขกลุ่มสมาชิก'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swm_user_group`
--

INSERT INTO `swm_user_group` (`sug_id`, `sug_name`) VALUES
(1, 'ทั่วไป'),
(2, 'สมาชิก');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swm_user_group`
--
ALTER TABLE `swm_user_group`
  ADD PRIMARY KEY (`sug_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swm_user_group`
--
ALTER TABLE `swm_user_group`
  MODIFY `sug_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK  รหัสกลุ่มสมาชิก', AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
