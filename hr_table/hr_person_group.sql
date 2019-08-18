-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 02:37 PM
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
-- Database: `tsp60_hrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_person_group`
--

CREATE TABLE `hr_person_group` (
  `pg_id` int(11) NOT NULL COMMENT 'รหัส',
  `pg_ps_id` int(11) NOT NULL COMMENT 'รหัสบุคลากร (hr_person)',
  `pg_gp_id` int(11) NOT NULL COMMENT 'รหัสกลุ่ม (hr_group)',
  `gp_start_date` date NOT NULL COMMENT 'วันที่เริ่มใช้งาน',
  `gp_end_date` date NOT NULL COMMENT 'วันที่สิ้นสุดการใช้งาน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='จัดบุคลากรตามกลุ่ม';

--
-- Dumping data for table `hr_person_group`
--

INSERT INTO `hr_person_group` (`pg_id`, `pg_ps_id`, `pg_gp_id`, `gp_start_date`, `gp_end_date`) VALUES
(28, 950, 3, '2017-03-13', '2017-03-15'),
(29, 1144, 3, '2017-03-13', '2017-03-15'),
(30, 1145, 3, '2017-03-13', '2017-03-15'),
(31, 1147, 3, '2017-03-13', '2017-03-15'),
(52, 1144, 4, '2017-03-13', '2017-03-15'),
(53, 1163, 4, '2017-03-13', '2017-03-15'),
(60, 950, 5, '2017-03-13', '2017-03-15'),
(61, 1185, 5, '2017-03-13', '2017-03-15'),
(70, 1146, 2, '2017-03-13', '2017-03-15'),
(71, 1145, 2, '2017-03-13', '2017-03-15'),
(72, 1148, 2, '2017-03-13', '2017-03-15'),
(79, 950, 7, '2017-03-13', '2017-03-15'),
(80, 1145, 7, '2017-03-13', '2017-03-15'),
(81, 1148, 7, '2017-03-13', '2017-03-15'),
(93, 1147, 8, '2017-03-13', '2017-03-15'),
(97, 1150, 9, '2017-03-13', '2017-03-15'),
(98, 1160, 9, '2017-03-13', '2017-03-15'),
(99, 1166, 9, '2017-03-13', '2017-03-15'),
(100, 1179, 9, '2017-03-13', '2017-03-15'),
(101, 0, 10, '2017-03-13', '2017-03-15'),
(106, 950, 1, '2017-03-13', '2017-03-15'),
(107, 1166, 1, '2017-03-13', '2017-03-15'),
(108, 1147, 1, '2017-03-13', '2017-03-15'),
(109, 1148, 1, '2017-03-13', '2017-03-15'),
(110, 1587, 1, '2017-03-13', '2017-03-15'),
(111, 950, 6, '2017-03-13', '2017-03-15'),
(112, 1146, 6, '2017-03-13', '2017-03-15'),
(113, 1147, 6, '2017-03-13', '2017-03-15'),
(114, 3949, 6, '2017-03-13', '2017-03-15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_person_group`
--
ALTER TABLE `hr_person_group`
  ADD PRIMARY KEY (`pg_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_person_group`
--
ALTER TABLE `hr_person_group`
  MODIFY `pg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
