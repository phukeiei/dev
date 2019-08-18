-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 08:36 PM
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
-- Table structure for table `umgroup`
--

CREATE TABLE `umgroup` (
  `GpID` int(11) NOT NULL,
  `GpNameT` varchar(50) DEFAULT NULL,
  `GpNameE` varchar(50) DEFAULT NULL,
  `GpDesc` varchar(255) DEFAULT NULL,
  `GpStID` int(11) DEFAULT NULL,
  `GpIcon` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umgroup`
--

INSERT INTO `umgroup` (`GpID`, `GpNameT`, `GpNameE`, `GpDesc`, `GpStID`, `GpIcon`) VALUES
(10001, 'ผู้ดูแลระบบ', 'Admin', 'Admin UMS', 1, 'User-10.png'),
(200011, 'ผู้ดูแลระบบม.บูรพา', '-', '', 4, 'User-2.png'),
(200012, ' ผู้ดูแลระบบประจำวิทยาลัย', '--', 'รองวิชาการ', 4, 'User-2.png'),
(200013, 'ผู้รับผิดชอบหลักสูตร', '---', 'ประธานหลักสูตร', 4, 'User-1.png'),
(200014, 'อาจารย์ผู้สอน', '----', '', 4, 'User-10.png'),
(200015, 'ผู้อำนวยการวิทยาลัย', '-----', '', 4, 'User-1.png'),
(200016, 'หัวหน้าภาค / หัวหน้ากลุ่มวิชา', 'Eng', '', 4, 'User-3.png'),
(200017, 'ผู้ดูแลระบบครุภัณฑ์', 'Admin_EQS', '', 5, 'User-6.png'),
(200018, 'นักพัฒนา', 'Developer', '', 6, 'User-2.png'),
(200020, 'เจ้าหน้าที่แผนปฏิบัติการ', 'Action Plan staff', '', 6, 'User-6.png'),
(200021, 'ผู้ดูแลระบบ', 'Admin', '', 11, 'User-2.png'),
(200022, 'เจ้าหน้าที่', 'staff', '', 11, 'User-3.png'),
(200027, 'ผู้อำนวยการวิทยาลัย', 'director college', '', 11, NULL),
(200028, 'รองผู้อำนวยการวิทยาลัย', 'deputy director college', '', 11, NULL),
(200029, 'อาจารย์', 'Teacher', '', 11, NULL),
(200030, 'การเจ้าหน้าที่', 'Officer', '', 12, NULL),
(200031, 'เจ้าหน้าที่วิจัยและวิชาการ', 'research admin', '', 7, NULL),
(200036, 'เจ้าหน้าที่ระบบงานบริการวิชาการ', 'Academic Service Staff', '', 8, NULL),
(200037, 'เจ้าหน้าที่ระบบงานทำนุบำรุงฯ', 'Culture Project Staff', '', 13, NULL),
(200038, 'ผู้ใช้ทั่วไป', 'General User', '', 12, NULL),
(200039, 'ผู้ดูระบบระดับสถาบัน ', 'Admin Of Collage', 'ผู้ดูแลระบบประจำวิทยาลัย', 1, 'User-4.png'),
(200040, 'เจ้าหน้าที่วิชาค่าย', 'Staff', 'For Specific staff.', 14, NULL),
(200041, 'นิสิตวิชาค่าย', 'Ossd student', 'For student', 14, NULL),
(200042, 'เจ้าหน้าที่', ' Staff', '', 15, NULL),
(200045, 'ผู้พัฒนาระบบจัดการสนาม', 'football_manager', 'ผู้พัฒนาระบบจัดการสนาม', 16, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umgroup`
--
ALTER TABLE `umgroup`
  ADD PRIMARY KEY (`GpID`),
  ADD KEY `GpStID` (`GpStID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umgroup`
--
ALTER TABLE `umgroup`
  MODIFY `GpID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200046;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
