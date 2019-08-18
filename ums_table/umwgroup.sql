-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 09:03 PM
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
-- Table structure for table `umwgroup`
--

CREATE TABLE `umwgroup` (
  `WgID` int(11) NOT NULL,
  `WgNameT` varchar(50) DEFAULT NULL,
  `WgNameE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umwgroup`
--

INSERT INTO `umwgroup` (`WgID`, `WgNameT`, `WgNameE`) VALUES
(1, 'ผู้ดูแลระบบ', 'Administrator'),
(2, 'ผู้บริหารระดับสูง', 'CEO'),
(3, 'ผู้จัดการ', 'Manager'),
(4, 'เจ้าหน้าที่', 'Officer'),
(5, 'อาจารย์', 'tecacher'),
(6, 'นักศึกษา', 'students'),
(7, 'หัวหน้าหน่วยงาน', 'Leader'),
(8, 'เจ้าหน้าที่', 'personstaff'),
(9, 'บุคคลนอกองค์กร', 'Outside'),
(10, 'ผู้ใช้ทั่วไป', 'Normal User'),
(11, 'ผู้ดูแลระบบหน่วยงาน', 'Department Admin'),
(12, 'ประชาชน', 'People'),
(14, 'ทีมผู้พัฒนาระบบ ม. บูรพา', 'Developers BUU');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umwgroup`
--
ALTER TABLE `umwgroup`
  ADD PRIMARY KEY (`WgID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umwgroup`
--
ALTER TABLE `umwgroup`
  MODIFY `WgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
