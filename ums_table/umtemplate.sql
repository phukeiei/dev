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
-- Table structure for table `umtemplate`
--

CREATE TABLE `umtemplate` (
  `temID` int(11) NOT NULL,
  `StID` int(11) NOT NULL,
  `HeadIcon` text NOT NULL,
  `HeightHeadTop` int(10) UNSIGNED NOT NULL,
  `MarginHeadTop` int(10) UNSIGNED NOT NULL,
  `ColorHeadTop` text NOT NULL,
  `ColorHeadBottom` text NOT NULL,
  `ColorTopButton` text NOT NULL,
  `ColorBottomButton` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umtemplate`
--

INSERT INTO `umtemplate` (`temID`, `StID`, `HeadIcon`, `HeightHeadTop`, `MarginHeadTop`, `ColorHeadTop`, `ColorHeadBottom`, `ColorTopButton`, `ColorBottomButton`) VALUES
(174, 52, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(175, 4, 'UMS-Header.gif', 0, 0, '#61d3ff', '', '', ''),
(177, 5, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(178, 6, 'PBM-logo.png', 0, 0, '#607d8b', '', '', ''),
(179, 7, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(180, 8, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(183, 11, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(185, 12, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(186, 13, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(188, 14, 'logo-UMS.png', 0, 0, '#94cbe0', '', '', ''),
(189, 16, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(191, 20, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(192, 17, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(193, 18, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(194, 1, 'UMS.png', 0, 0, '#94cbe0', '', '', ''),
(195, 2, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(196, 15, 'logo-UMS.png', 0, 0, '#94cbe0', '', '', ''),
(198, 0, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black'),
(199, 16, 'UMSBUU-10.png', 58, 0, '#94cbe0', '#eee8e8', 'white', 'black');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umtemplate`
--
ALTER TABLE `umtemplate`
  ADD PRIMARY KEY (`temID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umtemplate`
--
ALTER TABLE `umtemplate`
  MODIFY `temID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
