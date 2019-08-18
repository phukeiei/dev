-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 08:37 PM
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
-- Table structure for table `umicon`
--

CREATE TABLE `umicon` (
  `IcID` int(3) UNSIGNED ZEROFILL NOT NULL,
  `IcName` varchar(255) NOT NULL,
  `IcType` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umicon`
--

INSERT INTO `umicon` (`IcID`, `IcName`, `IcType`) VALUES
(081, 'defult-header.png', 'header'),
(002, 'Icon-1.png', 'menu'),
(066, 'Icon-100.png', 'menu'),
(067, 'Icon-101.png', 'menu'),
(070, 'Icon-102.png', 'menu'),
(071, 'Icon-103.png', 'menu'),
(072, 'Icon-104.png', 'menu'),
(076, 'Icon-106.png', 'menu'),
(003, 'Icon-11.png', 'menu'),
(015, 'Icon-12.png', 'menu'),
(016, 'Icon-13.png', 'menu'),
(017, 'Icon-14.png', 'menu'),
(018, 'Icon-15.png', 'menu'),
(019, 'Icon-16.png', 'menu'),
(020, 'Icon-17.png', 'menu'),
(021, 'Icon-18.png', 'menu'),
(022, 'Icon-19.png', 'menu'),
(004, 'Icon-2.png', 'menu'),
(005, 'Icon-3.png', 'menu'),
(023, 'Icon-30.png', 'menu'),
(024, 'Icon-31.png', 'menu'),
(025, 'Icon-32.png', 'menu'),
(026, 'Icon-33.png', 'menu'),
(027, 'Icon-34.png', 'menu'),
(028, 'Icon-341.png', 'menu'),
(029, 'Icon-35.png', 'menu'),
(030, 'Icon-351.png', 'menu'),
(031, 'Icon-36.png', 'menu'),
(032, 'Icon-361.png', 'menu'),
(033, 'Icon-37.png', 'menu'),
(034, 'Icon-38.png', 'menu'),
(035, 'Icon-39.png', 'menu'),
(006, 'Icon-4.png', 'menu'),
(036, 'Icon-40.png', 'menu'),
(037, 'Icon-41.png', 'menu'),
(038, 'Icon-42.png', 'menu'),
(039, 'Icon-44.png', 'menu'),
(040, 'Icon-45.png', 'menu'),
(041, 'Icon-46.png', 'menu'),
(042, 'Icon-47.png', 'menu'),
(043, 'Icon-48.png', 'menu'),
(044, 'Icon-49.png', 'menu'),
(008, 'Icon-6.png', 'menu'),
(009, 'Icon-7.png', 'menu'),
(011, 'Icon-8.png', 'menu'),
(013, 'Icon-9.png', 'menu'),
(077, 'logo-sas.png', 'header'),
(046, 'logo-UMS.png', 'header'),
(080, 'PBM.png', 'system'),
(058, 'S-1.png', 'system'),
(065, 'UMS.png', 'header'),
(047, 'User-1.png', 'gear'),
(060, 'User-10.png', 'gear'),
(048, 'User-2.png', 'gear'),
(049, 'User-3.png', 'gear'),
(052, 'User-4.png', 'gear'),
(054, 'User-5.png', 'gear'),
(055, 'User-6.png', 'gear'),
(057, 'User-8.png', 'gear');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umicon`
--
ALTER TABLE `umicon`
  ADD PRIMARY KEY (`IcName`),
  ADD UNIQUE KEY `IcID` (`IcID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umicon`
--
ALTER TABLE `umicon`
  MODIFY `IcID` int(3) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
