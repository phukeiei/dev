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
-- Table structure for table `umgroupdefault`
--

CREATE TABLE `umgroupdefault` (
  `GdGpID` int(11) NOT NULL DEFAULT '0',
  `GdWgID` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umgroupdefault`
--

INSERT INTO `umgroupdefault` (`GdGpID`, `GdWgID`) VALUES
(200014, 5),
(200045, 8),
(200047, 8),
(200047, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umgroupdefault`
--
ALTER TABLE `umgroupdefault`
  ADD PRIMARY KEY (`GdGpID`,`GdWgID`),
  ADD KEY `GdWgID` (`GdWgID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
