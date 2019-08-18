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
-- Table structure for table `umnotification`
--

CREATE TABLE `umnotification` (
  `id` int(11) NOT NULL,
  `state_id` int(11) NOT NULL,
  `state_name` varchar(250) NOT NULL,
  `system_id` int(11) NOT NULL,
  `system_state` int(11) DEFAULT NULL,
  `doc_id` int(11) NOT NULL,
  `messsage` varchar(250) NOT NULL,
  `link` varchar(250) NOT NULL,
  `no_wgid` int(11) NOT NULL,
  `priority` int(5) NOT NULL,
  `no_usid` int(11) NOT NULL,
  `dlc_id` int(11) NOT NULL,
  `dpId` int(11) NOT NULL,
  `checkin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umnotification`
--
ALTER TABLE `umnotification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umnotification`
--
ALTER TABLE `umnotification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
