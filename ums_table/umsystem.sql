-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 08:42 PM
-- Server version: 5.6.38-log
-- PHP Version: 7.0.26-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsp60_umsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `umsystem`
--

CREATE TABLE `umsystem` (
  `StID` int(11) NOT NULL,
  `StNameT` varchar(100) DEFAULT NULL,
  `StNameE` varchar(100) DEFAULT NULL,
  `StAbbrT` char(3) DEFAULT NULL,
  `StAbbrE` char(3) DEFAULT NULL,
  `StDesc` varchar(255) DEFAULT NULL,
  `StURL` varchar(100) DEFAULT NULL,
  `StIcon` varchar(50) DEFAULT '',
  `StMsID` int(11) NOT NULL COMMENT 'รหัสพันธกิจ',
  `StSeq` int(11) NOT NULL COMMENT 'ลำดับของระบบตามพันธกิจ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umsystem`
--

INSERT INTO `umsystem` (`StID`, `StNameT`, `StNameE`, `StAbbrT`, `StAbbrE`, `StDesc`, `StURL`, `StIcon`, `StMsID`, `StSeq`) VALUES
(1, 'ระบบจัดการผู้ใช้', 'User Management System', 'จก', 'UMS', 'test', 'UMS', 'UMS.gif', 1, 4),
(14, 'วิชาค่าย', 'OSSD', 'ค่า', 'oss', 'ใช้ในการจัดการเรียนการสอนวิชาค่าย', 'Camp_controller/index_html', 'S-1.png', 2, 2),
(15, 'ระบบรับแจ้งใบคำร้อง ', 'Complaint system', 'รจค', 'cpt', '', 'cpt/Complaint_controller', 'S-1.png', 0, 0),
(16, 'ระบบจัดการสนามฟุตบอล', 'football field management', 'ฟุต', 'ffm', 'ระบบจัดการสนามฟุตบอล', 'ffm/backend/Dashboard', 'S-1.png', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umsystem`
--
ALTER TABLE `umsystem`
  ADD PRIMARY KEY (`StID`),
  ADD UNIQUE KEY `StNameT` (`StNameT`),
  ADD UNIQUE KEY `StNameE` (`StNameE`),
  ADD UNIQUE KEY `StNameT_2` (`StNameT`,`StNameE`),
  ADD UNIQUE KEY `StNameT_3` (`StNameT`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umsystem`
--
ALTER TABLE `umsystem`
  MODIFY `StID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
