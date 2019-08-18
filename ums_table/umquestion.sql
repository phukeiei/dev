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
-- Table structure for table `umquestion`
--

CREATE TABLE `umquestion` (
  `QsID` int(11) NOT NULL DEFAULT '0',
  `QsDescT` varchar(50) DEFAULT NULL,
  `QsDescE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umquestion`
--

INSERT INTO `umquestion` (`QsID`, `QsDescT`, `QsDescE`) VALUES
(2, 'ชื่อสัตว์เลี้ยงของท่านคือ', 'What is your pet\'s name?'),
(3, 'อาหารที่ท่านชอบทานที่สุด', 'What is you favorite food?');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umquestion`
--
ALTER TABLE `umquestion`
  ADD PRIMARY KEY (`QsID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
