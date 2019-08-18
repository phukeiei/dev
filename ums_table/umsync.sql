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
-- Table structure for table `umsync`
--

CREATE TABLE `umsync` (
  `syncID` int(11) NOT NULL,
  `syncFilename` varchar(50) NOT NULL,
  `syncUsID` int(11) NOT NULL,
  `syncTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umsync`
--

INSERT INTO `umsync` (`syncID`, `syncFilename`, `syncUsID`, `syncTime`) VALUES
(1, 'sync201701120246', 1, '2017-01-12 09:46:32'),
(2, 'sync201801101207', 1, '2018-01-10 12:07:17'),
(3, 'sync201901021204', 1, '2019-01-02 12:04:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umsync`
--
ALTER TABLE `umsync`
  ADD PRIMARY KEY (`syncID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umsync`
--
ALTER TABLE `umsync`
  MODIFY `syncID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
