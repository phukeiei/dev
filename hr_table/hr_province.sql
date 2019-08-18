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
-- Table structure for table `hr_province`
--

CREATE TABLE `hr_province` (
  `pv_id` int(11) NOT NULL COMMENT 'รหัส',
  `pv_name` varchar(100) NOT NULL COMMENT 'ชื่อจังหวัด(ไทย)',
  `pv_name_en` varchar(100) NOT NULL COMMENT 'ชื่อจังหวัด(อังกฤษ)',
  `pv_zone_id` int(11) NOT NULL COMMENT 'id จากตารางภาค hr_zone',
  `pv_active` char(1) NOT NULL COMMENT 'Y=ไม่ถูกลบ N=ถูกลบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='จังหวัด';

--
-- Dumping data for table `hr_province`
--

INSERT INTO `hr_province` (`pv_id`, `pv_name`, `pv_name_en`, `pv_zone_id`, `pv_active`) VALUES
(1, 'กรุงเทพมหานคร', 'Bangkok', 2, 'Y'),
(2, 'สมุทรปราการ', 'Samut Prakan', 2, 'Y'),
(3, 'นนทบุรี', 'Nonthaburi', 2, 'Y'),
(4, 'ปทุมธานี', 'Pathum Thani', 2, 'Y'),
(5, 'พระนครศรีอยุธยา', 'Phra Nakhon Si Ayutthaya', 2, 'Y'),
(6, 'อ่างทอง', 'Ang Thong', 2, 'Y'),
(7, 'ลพบุรี', 'Loburi', 2, 'Y'),
(8, 'สิงห์บุรี', 'Sing Buri', 2, 'Y'),
(9, 'ชัยนาท', 'Chai Nat', 2, 'Y'),
(10, 'สระบุรี', 'Saraburi', 2, 'Y'),
(11, 'ชลบุรี', 'Chon Buri', 5, 'Y'),
(12, 'ระยอง', 'Rayong', 5, 'Y'),
(13, 'จันทบุรี', 'Chanthaburi', 5, 'Y'),
(14, 'ตราด', 'Trat', 5, 'Y'),
(15, 'ฉะเชิงเทรา', 'Chachoengsao', 5, 'Y'),
(16, 'ปราจีนบุรี', 'Prachin Buri', 5, 'Y'),
(17, 'นครนายก', 'Nakhon Nayok', 2, 'Y'),
(18, 'สระแก้ว', 'Sa Kaeo', 5, 'Y'),
(19, 'นครราชสีมา', 'Nakhon Ratchasima', 3, 'Y'),
(20, 'บุรีรัมย์', 'Buri Ram', 3, 'Y'),
(21, 'สุรินทร์', 'Surin', 3, 'Y'),
(22, 'ศรีสะเกษ', 'Si Sa Ket', 3, 'Y'),
(23, 'อุบลราชธานี', 'Ubon Ratchathani', 3, 'Y'),
(24, 'ยโสธร', 'Yasothon', 3, 'Y'),
(25, 'ชัยภูมิ', 'Chaiyaphum', 3, 'Y'),
(26, 'อำนาจเจริญ', 'Amnat Charoen', 3, 'Y'),
(27, 'หนองบัวลำภู', 'Nong Bua Lam Phu', 3, 'Y'),
(28, 'ขอนแก่น', 'Khon Kaen', 3, 'Y'),
(29, 'อุดรธานี', 'Udon Thani', 3, 'Y'),
(30, 'เลย', 'Loei', 3, 'Y'),
(31, 'หนองคาย', 'Nong Khai', 3, 'Y'),
(32, 'มหาสารคาม', 'Maha Sarakham', 3, 'Y'),
(33, 'ร้อยเอ็ด', 'Roi Et', 3, 'Y'),
(34, 'กาฬสินธุ์', 'Kalasin', 3, 'Y'),
(35, 'สกลนคร', 'Sakon Nakhon', 3, 'Y'),
(36, 'นครพนม', 'Nakhon Phanom', 3, 'Y'),
(37, 'มุกดาหาร', 'Mukdahan', 3, 'Y'),
(38, 'เชียงใหม่', 'Chiang Mai', 1, 'Y'),
(39, 'ลำพูน', 'Lamphun', 1, 'Y'),
(40, 'ลำปาง', 'Lampang', 1, 'Y'),
(41, 'อุตรดิตถ์', 'Uttaradit', 1, 'Y'),
(42, 'แพร่', 'Phrae', 1, 'Y'),
(43, 'น่าน', 'Nan', 1, 'Y'),
(44, 'พะเยา', 'Phayao', 1, 'Y'),
(45, 'เชียงราย', 'Chiang Rai', 1, 'Y'),
(46, 'แม่ฮ่องสอน', 'Mae Hong Son', 1, 'Y'),
(47, 'นครสวรรค์', 'Nakhon Sawan', 2, 'Y'),
(48, 'อุทัยธานี', 'Uthai Thani', 2, 'Y'),
(49, 'กำแพงเพชร', 'Kamphaeng Phet', 2, 'Y'),
(50, 'ตาก', 'Tak', 4, 'Y'),
(51, 'สุโขทัย', 'Sukhothai', 2, 'Y'),
(52, 'พิษณุโลก', 'Phitsanulok', 2, 'Y'),
(53, 'พิจิตร', 'Phichit', 2, 'Y'),
(54, 'เพชรบูรณ์', 'Phetchabun', 2, 'Y'),
(55, 'ราชบุรี', 'Ratchaburi', 4, 'Y'),
(56, 'กาญจนบุรี', 'Kanchanaburi', 4, 'Y'),
(57, 'สุพรรณบุรี', 'Suphan Buri', 2, 'Y'),
(58, 'นครปฐม', 'Nakhon Pathom', 2, 'Y'),
(59, 'สมุทรสาคร', 'Samut Sakhon', 2, 'Y'),
(60, 'สมุทรสงคราม', 'Samut Songkhram', 2, 'Y'),
(61, 'เพชรบุรี', 'Phetchaburi', 4, 'Y'),
(62, 'ประจวบคีรีขันธ์', 'Prachuap Khiri Khan', 4, 'Y'),
(63, 'นครศรีธรรมราช', 'Nakhon Si Thammarat', 6, 'Y'),
(64, 'กระบี่', 'Krabi', 6, 'Y'),
(65, 'พังงา', 'Phangnga', 6, 'Y'),
(66, 'ภูเก็ต', 'Phuket', 6, 'Y'),
(67, 'สุราษฎร์ธานี', 'Surat Thani', 6, 'Y'),
(68, 'ระนอง', 'Ranong', 6, 'Y'),
(69, 'ชุมพร', 'Chumphon', 6, 'Y'),
(70, 'สงขลา', 'Songkhla', 6, 'Y'),
(71, 'สตูล', 'Satun', 6, 'Y'),
(72, 'ตรัง', 'Trang', 6, 'Y'),
(73, 'พัทลุง', 'Phatthalung', 6, 'Y'),
(74, 'ปัตตานี', 'Pattani', 6, 'Y'),
(75, 'ยะลา', 'Yala', 6, 'Y'),
(76, 'นราธิวาส', 'Narathiwat', 6, 'Y'),
(77, 'บึงกาฬ', 'buogkan', 3, 'Y');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hr_province`
--
ALTER TABLE `hr_province`
  ADD PRIMARY KEY (`pv_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hr_province`
--
ALTER TABLE `hr_province`
  MODIFY `pv_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัส', AUTO_INCREMENT=78;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
