-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2019 at 02:37 PM
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
-- Database: `tsp60_hrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `hr_prefix`
--

CREATE TABLE `hr_prefix` (
  `pf_id` int(11) NOT NULL COMMENT 'รหัส',
  `pf_name` varchar(50) NOT NULL COMMENT 'ชื่อเต็ม(ไทย)',
  `pf_name_en` varchar(50) NOT NULL COMMENT 'ชื่อเต็ม(อังกฤษ)',
  `pf_name_abbr` varchar(50) NOT NULL COMMENT 'ชื่อย่อ(ไทย)',
  `pf_name_abbr_en` varchar(50) NOT NULL COMMENT 'ชื่อย่อ(อังกฤษ)',
  `pf_gd_id` int(11) NOT NULL COMMENT 'รหัสจากตาราง hr_gender',
  `pf_pftype_id` int(11) NOT NULL DEFAULT '1' COMMENT 'ประเภทคำนำหน้า (ตาราง hr_prefix_type)',
  `pf_seq_no` int(11) NOT NULL COMMENT 'ลำดับการแสดงผล',
  `pf_active` char(1) NOT NULL COMMENT 'สถานะการถูกลบ(Y=ไม่ถูกลบ N=ถูกลบแล้ว)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='คำนำหน้าชื่อ/ยศ';

--
-- Dumping data for table `hr_prefix`
--

INSERT INTO `hr_prefix` (`pf_id`, `pf_name`, `pf_name_en`, `pf_name_abbr`, `pf_name_abbr_en`, `pf_gd_id`, `pf_pftype_id`, `pf_seq_no`, `pf_active`) VALUES
(1, 'นาย', 'Mister', 'นาย', 'Mr.', 2, 1, 25, 'Y'),
(2, 'นางสาว', 'Miss', 'นางสาว', 'Miss', 3, 1, 2, 'Y'),
(3, 'นาง', 'Mistress', 'นาง', 'Mrs.', 3, 1, 3, 'Y'),
(4, 'เด็กหญิง', '-', 'ด.ญ.', '-', 3, 0, 4, 'Y'),
(5, 'เด็กชาย', '-', 'ด.ช.', '-', 2, 0, 5, 'Y'),
(6, 'Mister ', 'Mister', 'Mr.', 'Mr.', 2, 1, 25, 'Y'),
(7, 'Miss ', 'Miss', 'Miss', 'Miss', 3, 1, 2, 'Y'),
(8, 'Mistress ', 'Mistress', 'Mrs.', 'Mrs.', 3, 1, 3, 'Y'),
(9, 'อาจารย์', 'Teacher', 'อ.', 'Teach.', 0, 2, 3, 'Y'),
(10, 'ศาสตราจารย์', 'Professor', 'ศจ.', 'Prof.', 0, 3, 28, 'Y'),
(11, 'ดอกเตอร์', 'Doctor', 'ดร.', 'Dr', 0, 1, 0, 'Y'),
(15, 'พันจ่าเอก', 'Chief Petty Officer First Class', 'พ.จ.อ.', 'CPO 1', 2, 2, 4, 'Y'),
(37, 'ว่าที่ ร.ต. (ร.น.)', '', 'ว่าที่ ร.ต. (ร.น.)', '', 1, 2, 5, 'Y'),
(74, 'สิบเอก', 'Sergeant', 'ส.อ.', 'SGT', 2, 2, 6, 'Y'),
(80, 'จ่าสิบเอก', 'Master Sergeant First Class', 'จ.ส.อ.', '1MSGT / SMG', 2, 2, 7, 'Y'),
(88, 'ร้อยโทหญิง', 'First Lieutenant', 'ร.ท.หญิง', 'Lt.', 3, 2, 8, 'Y'),
(109, 'ว่าที่ร้อยโทหญิง', '-', 'ว่าที่ ร.ท.หญิง', '-', 3, 2, 9, 'Y'),
(116, 'สิบตำรวจเอกหญิง', 'Police Sergeant', 'ส.ต.อ.หญิง', 'POL.SGT', 3, 2, 10, 'Y'),
(124, 'ร้อยตำรวจตรีหญิง', 'Police Sub-Lieutenant', 'ร.ต.ต.หญิง', 'POL.SUB.LT.', 3, 2, 11, 'Y'),
(131, 'พันตำรวจโทหญิง', 'Police Lieutenant Colonel', 'พ.ต.ท.หญิง', 'POL.LT.COL.', 3, 2, 12, 'Y'),
(132, 'สิบตรี', 'Private 1st Class', 'ส.ต.', 'pfc.', 2, 2, 13, 'Y'),
(133, 'ว่าที่เรือตรี', 'Acting Sub-Lieutenant', 'ว่าที่เรือตรี', 'Acting Sub.Lt.', 2, 2, 14, 'Y'),
(134, 'ว่าที่ร้อยตำรวจโทหญิง', '', 'ว่าที่ ร.ต.ท.หญิง', '', 3, 2, 15, 'Y'),
(135, 'ว่าที่ ร้อยตรี', 'Acting Second Lieutenant', 'ว่าที่ ร.ต.', 'Acting 2Lt.', 0, 2, 16, 'Y'),
(136, 'เรืออากาศโทหญิง', 'Flying Officer', 'ร.ท.หญิง', 'Flg Off', 3, 2, 17, 'Y'),
(137, 'หม่อมหลวง', 'Mom Luang', 'ม.ล.', 'M.L.', 0, 4, 18, 'Y'),
(138, 'หม่อมราชวงศ์', 'Mom Rajawongse', 'ม.ร.ว.', 'M.R.', 0, 4, 19, 'Y'),
(139, 'เภสัชกรหญิง', 'Pharmacist', 'ภกญ.', 'Pharm.', 3, 2, 20, 'Y'),
(140, 'เภสัชกร', 'Pharmacist', 'ภก.', 'Pharm.', 2, 2, 21, 'Y'),
(141, 'นายแพทย์', '-', 'นพ.', '-', 2, 2, 22, 'Y'),
(142, 'แพทย์หญิง', '-', 'พญ.', '-', 3, 2, 23, 'Y'),
(143, 'ศาตราจารย์ ดอกเตอร์', '-', 'ศ.ดร.1', '-', 3, 2, 27, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_prefix`
--
ALTER TABLE `hr_prefix`
  ADD PRIMARY KEY (`pf_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_prefix`
--
ALTER TABLE `hr_prefix`
  MODIFY `pf_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=144;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
