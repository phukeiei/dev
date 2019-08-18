-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 08:35 PM
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
-- Table structure for table `umpermission`
--

CREATE TABLE `umpermission` (
  `pmUsID` int(11) NOT NULL DEFAULT '0',
  `pmMnID` int(11) NOT NULL DEFAULT '0',
  `pmSeq` int(11) DEFAULT NULL,
  `pmX` int(1) DEFAULT NULL,
  `pmC` int(1) DEFAULT NULL,
  `pmR` int(1) DEFAULT NULL,
  `pmU` int(1) DEFAULT NULL,
  `pmD` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umpermission`
--

INSERT INTO `umpermission` (`pmUsID`, `pmMnID`, `pmSeq`, `pmX`, `pmC`, `pmR`, `pmU`, `pmD`) VALUES
(1, 5010532, 0, 1, 1, 1, 1, 1),
(1, 5010573, 0, 1, 1, 1, 1, 1),
(1, 5010579, 0, 1, 1, 1, 1, 1),
(1, 5010581, 0, 1, 1, 1, 1, 1),
(1, 5010582, 0, 1, 1, 1, 1, 1),
(1, 5010583, 0, 1, 1, 1, 1, 1),
(1, 5010585, 0, 1, 1, 1, 1, 1),
(1, 5010586, 0, 1, 1, 1, 1, 1),
(1, 5010986, 0, 1, 1, 1, 1, 1),
(1, 5011121, 0, 1, 1, 1, 1, 1),
(1, 5011122, 0, 1, 1, 1, 1, 1),
(1, 5011123, 0, 1, 1, 1, 1, 1),
(1, 5011124, 0, 1, 1, 1, 1, 1),
(1, 5011157, 0, 1, 1, 1, 1, 1),
(1, 5011166, 0, 1, 1, 1, 1, 1),
(1, 5011173, 0, 1, 1, 1, 1, 1),
(1, 5011191, 0, 1, 1, 1, 1, 1),
(1, 5011193, 0, 1, 1, 1, 1, 1),
(1, 5011194, 0, 1, 1, 1, 1, 1),
(1, 5011195, 0, 1, 1, 1, 1, 1),
(1, 5011219, 0, 1, 1, 1, 1, 1),
(1, 5011220, 0, 1, 1, 1, 1, 1),
(1, 5011221, 0, 1, 1, 1, 1, 1),
(1, 7000128, 0, 1, 1, 1, 1, 1),
(1, 7000155, 0, 1, 1, 1, 1, 1),
(1, 7000156, 0, 1, 1, 1, 1, 1),
(1, 7000936, 0, 1, 1, 1, 1, 1),
(1, 7000937, 0, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umpermission`
--
ALTER TABLE `umpermission`
  ADD PRIMARY KEY (`pmUsID`,`pmMnID`),
  ADD KEY `pmMnID` (`pmMnID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
