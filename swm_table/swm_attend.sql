-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 02:38 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tsp60_swmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `swm_attend`
--

CREATE TABLE `swm_attend` (
  `sa_id` int(11) NOT NULL,
  `sa_su_id` int(11) DEFAULT NULL,
  `sa_scp_id` int(11) NOT NULL,
  `sa_real_cost` int(11) DEFAULT NULL,
  `sa_create_date` date DEFAULT '0000-00-00',
  `sa_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `swm_attend`
--

INSERT INTO `swm_attend` (`sa_id`, `sa_su_id`, `sa_scp_id`, `sa_real_cost`, `sa_create_date`, `sa_time`) VALUES
(1, 1, 1, 50, '2019-05-16', '11:20:32'),
(2, 7, 1, 50, '2019-05-17', '11:20:32'),
(3, NULL, 3, 350, '2019-05-20', '02:00:00'),
(4, 1, 2, 500, '2019-05-21', '12:41:00'),
(6, 1, 2, 500, '2019-05-21', '14:04:00'),
(7, 1, 2, 500, '2019-05-21', '14:28:00'),
(8, 0, 4, 550, '2019-05-21', '15:05:00'),
(9, 2, 4, 550, '2019-05-21', '13:05:00'),
(10, 2, 4, 50, '2019-05-20', '11:05:00'),
(11, 0, 2, 500, '2019-05-22', '13:59:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `swm_attend`
--
ALTER TABLE `swm_attend`
  ADD PRIMARY KEY (`sa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `swm_attend`
--
ALTER TABLE `swm_attend`
  MODIFY `sa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
