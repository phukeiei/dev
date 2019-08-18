-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 09:01 PM
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
-- Table structure for table `ummission`
--

CREATE TABLE `ummission` (
  `MsID` int(11) NOT NULL COMMENT 'รหัสพันธกิจ',
  `MsName` varchar(256) NOT NULL COMMENT 'ชื่อพันธกิจ',
  `MsSeq` int(11) NOT NULL COMMENT 'ลำดับของพันธกิจ',
  `MsColor` varchar(10) NOT NULL COMMENT 'สีตามแท็ป',
  `MsColorBody` varchar(50) NOT NULL COMMENT 'สีของ body',
  `MsColorHead` varchar(50) NOT NULL COMMENT 'สีของ head gear'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ummission`
--

INSERT INTO `ummission` (`MsID`, `MsName`, `MsSeq`, `MsColor`, `MsColorBody`, `MsColorHead`) VALUES
(1, 'ด้านบริหาร', 2, '#D73D32', 'rgba(163, 231, 216, 0.09)', '#9E9E9E'),
(2, 'ด้านผลิตบัณฑิต', 3, '#C97F00', 'rgba(163, 231, 216, 0.09)', '#9E9E9E'),
(3, 'ด้านผลงานวิจัยและวิชาการ', 4, '#2D5F9A', 'rgba(163, 231, 216, 0.09)', '#9E9E9E'),
(4, 'ด้านบริการวิชาการ', 5, '#00BFFF', 'rgba(163, 231, 216, 0.09)', '#9E9E9E'),
(5, 'BCNT Dashboard', 1, '#2D5F9A', 'rgba(163, 231, 216, 0.09)', '#9E9E9E'),
(6, 'ด้านทำนุบำรุงศิลปวัฒนธรรม', 6, '#00AA00', 'rgba(163, 231, 216, 0.09)', '#9E9E9E');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ummission`
--
ALTER TABLE `ummission`
  ADD PRIMARY KEY (`MsID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ummission`
--
ALTER TABLE `ummission`
  MODIFY `MsID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพันธกิจ', AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
