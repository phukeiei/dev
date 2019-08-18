-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 09:02 PM
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
-- Table structure for table `umservice`
--

CREATE TABLE `umservice` (
  `SvID` int(11) NOT NULL,
  `SvNameT` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `SvNameE` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `SvURL` varchar(100) CHARACTER SET tis620 DEFAULT NULL,
  `SvIcon` varchar(50) CHARACTER SET tis620 DEFAULT NULL,
  `SvTarget` varchar(10) CHARACTER SET tis620 NOT NULL DEFAULT '_self'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umservice`
--

INSERT INTO `umservice` (`SvID`, `SvNameT`, `SvNameE`, `SvURL`, `SvIcon`, `SvTarget`) VALUES
(1, 'อีเมล์', 'e-mail', 'email', 'email.gif', '_self'),
(2, 'ปฏิทินส่วนตัว', 'Calendar', 'calendar', 'calendar1.gif', '_self');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umservice`
--
ALTER TABLE `umservice`
  ADD PRIMARY KEY (`SvID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umservice`
--
ALTER TABLE `umservice`
  MODIFY `SvID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
