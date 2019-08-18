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
-- Table structure for table `ummenu`
--

CREATE TABLE `ummenu` (
  `MnStID` int(11) DEFAULT NULL,
  `MnID` int(11) NOT NULL,
  `MnSeq` int(11) DEFAULT NULL,
  `MnIcon` varchar(100) DEFAULT NULL,
  `MnNameT` varchar(150) DEFAULT NULL,
  `MnNameE` varchar(100) DEFAULT NULL,
  `MnURL` varchar(100) DEFAULT NULL,
  `MnDesc` varchar(255) DEFAULT NULL,
  `MnToolbar` varchar(50) DEFAULT NULL,
  `MnToolbarSeq` int(11) DEFAULT NULL,
  `MnToolbarIcon` varchar(50) DEFAULT NULL,
  `MnParentMnID` int(11) DEFAULT NULL,
  `MnLevel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ummenu`
--

INSERT INTO `ummenu` (`MnStID`, `MnID`, `MnSeq`, `MnIcon`, `MnNameT`, `MnNameE`, `MnURL`, `MnDesc`, `MnToolbar`, `MnToolbarSeq`, `MnToolbarIcon`, `MnParentMnID`, `MnLevel`) VALUES
(1, 100001, 1, 'Icon-30.png', 'ระบบงาน - เมนู', 'system - menu', '#', '', '', 0, '', 0, 0),
(1, 100002, 2, 'Icon-100.png', 'ข้อมูลระบบ - เมนู', 'system', 'UMS/showSystem', '', '', 0, '', 100001, 1),
(1, 100003, 6, 'Icon-3.png', 'ข้อมูลผู้ใช้', 'User', '#', '', '', 0, '', 0, 0),
(1, 100004, 3, 'Icon-18.png', 'ข้อมูลกลุ่มระบบงาน - กำหนดสิทธิ์', 'Group', 'UMS/showWorkGroup', '', '', 0, '', 100001, 1),
(1, 100005, 4, 'Icon-8.png', 'ข้อมูลคำถามส่วนตัว', 'Question', 'UMS/showQuestion', '', '', 0, '', 100001, 1),
(1, 100006, 8, 'Icon-41.png', 'ข้อมูลผู้ใช้งานระบบ - กำหนดสิทธิ์', 'User Management', 'UMS/showUser', '', '', 0, '', 100003, 1),
(1, 100008, 5, 'Icon-44.png', 'ข้อมูลกลุ่มผู้ใช้', 'WorkGroupService', 'UMS/showWGroup', '', '', 0, '', 100001, 1),
(1, 100011, 16, 'Icon-13.png', 'จัดการไอคอนระบบ', 'config System\'s Icon', '#', '', '', 0, '', 0, 0),
(1, 100012, 18, 'Icon-106.png', 'จัดการรูปแบบของระบบ', 'TemplateManagement', 'UMS/configSystem', '', '', 0, '', 100011, 1),
(1, 100013, 17, 'Icon-104.png', 'อัพโหลดไอคอน', 'show Icon', 'UMS/showIcon', '', '', 0, '', 100011, 1),
(1, 100016, 6, '1378994127_173.png', 'ข้อมูลการจัดการระบบ-ข้อมูลกลุ่มผู้ใช้', 'Systemadd & Workgroupadd', 'UMS/showsystemworkgroup', '', '', 0, '', 0, 1),
(1, 7000802, 7, 'Icon-18.png', 'เพิ่มข้อมูลผู้ใช้งาน', 'Add User', 'UMS/showUser/showuseradd', '', '', 0, '', 100003, 1),
(1, 7000820, 11, 'Icon-11.png', 'รายงาน', 'Report', '#', '', '', 0, '', 0, 0),
(1, 7000821, 12, 'Icon-2.png', 'รายงานสถิติของระบบ', 'ReportStatistics', 'UMS/showReport/reportUser', '', '', 0, '', 7000820, 1),
(1, 7000822, 13, 'Icon-37.png', 'ประวัติการเพิ่มลดสิทธิ์ผู้ใช้', 'Editpermission', 'UMS/showReport/reportEditpermission', '', '', 0, '', 7000820, 1),
(1, 7000823, 14, 'Icon-102.png', 'รายงานการเข้าใช้งานระบบ', 'ReportLog', 'UMS/showLog', '', '', 0, '', 7000820, 1),
(1, 7000824, 15, 'Icon-103.png', 'ประวัติการใช้งาน', 'User History', 'UMS/showReport', '', '', 0, '', 7000820, 1),
(1, 7000883, 9, 'Icon-101.png', 'นำเข้าข้อมูลบุคลากร', 'Sync Person', 'UMS/syncHRsingle', '', '', 0, '', 100003, 1),
(1, 7000933, 10, 'Icon-19.png', 'นำเข้าข้อมูลนักศึกษา', 'Import Students', 'UMS/syncByExcel', '', '', 0, '', 100003, 1),
(NULL, 7000971, NULL, 'Computer.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(14, 7001108, 5, 'Icon-30.png', 'HTML', 'HTML', '#', '', '', 0, '', 0, 0),
(14, 7001109, 10, 'Icon-11.png', 'HTML Avenxo', 'Example', 'HTML_CSS/example_html', '', '', 0, '', 7001108, 1),
(14, 7001110, 7, 'Icon-102.png', 'HTML-01', 'HTML-01', 'HTML_CSS/html01', '-', NULL, NULL, NULL, 7001108, 1),
(14, 7001111, 8, 'Icon-13.png', 'CSS-01', 'CSS-01', 'HTML_CSS/css01', '', '', 0, '', 7001108, 1),
(14, 7001112, 6, 'Icon-17.png', 'HTML', 'HTML', 'HTML_CSS/index_html', '-', NULL, NULL, NULL, 7001108, 1),
(14, 7001113, 3, 'Icon-341.png', 'จัดการ', 'จัดการ', '#', '', NULL, NULL, NULL, 0, 0),
(14, 7001114, 4, 'Icon-6.png', 'แสดงผลทั้งหมด', 'แสดงผลทั้งหมด', 'Manager/random_user', '', '', 0, '', 7001113, 1),
(14, 7001115, 14, 'Icon-17.png', 'PHP', 'PHP', '#', '', '', 0, '', 0, 0),
(14, 7001116, 15, 'Icon-7.png', 'PHP-01', 'PHP-01', 'PHP/php01', '', '', 0, '', 7001115, 1),
(14, 7001117, 16, 'Icon-7.png', 'PHP-02', 'PHP-02', 'PHP/php02', '', NULL, NULL, NULL, 7001115, 1),
(14, 7001118, 17, 'Icon-7.png', 'PHP-03', 'PHP-03', 'PHP/php03', '', NULL, NULL, NULL, 7001115, 1),
(14, 7001119, 18, 'Icon-46.png', 'หัดเขียน PHP', 'PHP Example', 'PHP/example_php', '', '', 0, '', 7001115, 1),
(14, 7001120, 9, 'Icon-103.png', 'CSS-02', 'CSS-02', 'HTML_CSS/css02', '', NULL, NULL, NULL, 7001108, 1),
(14, 7001121, 19, 'Icon-12.png', 'หัดเขียน Ex-01', 'PHP Ex-01', 'PHP/ex_php_01', '', '', 0, '', 7001115, 1),
(14, 7001122, 20, 'Icon-351.png', 'หัดเขียน Ex-02', 'หัดเขียน Ex-02', 'PHP/ex_php_02', '', '', 0, '', 7001115, 1),
(14, 7001123, 21, 'Icon-351.png', 'หัดเขียน Ex-03', 'หัดเขียน Ex-03', 'PHP/ex_php_03', '', '', 0, '', 7001115, 1),
(14, 7001124, 25, 'Icon-106.png', 'MVC', 'MVC', '-', '', NULL, NULL, NULL, 0, 0),
(14, 7001127, 30, 'Icon-8.png', 'แบบฟอร์มข้อมูลนักศึกษา', '', 'MVC/student_form_input', '2560-03-09', NULL, NULL, NULL, 7001124, 1),
(14, 7001128, 31, 'Icon-106.png', 'JS', 'JS', '#', '', NULL, NULL, NULL, 0, 0),
(14, 7001129, 32, 'Icon-14.png', ' lab01_1', ' lab01_1', 'JS/lab01_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001130, 33, 'Icon-14.png', 'lab01_2', 'lab01_2', 'JS/lab01_2', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001131, 34, 'Icon-14.png', 'lab02_1', 'lab02_1', 'JS/lab02_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001132, 35, 'Icon-14.png', 'lab02_2', 'lab02_2', 'JS/lab02_2', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001133, 36, 'Icon-14.png', 'lab03_1', 'lab03_1', 'JS/lab03_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001134, 37, 'Icon-14.png', 'lab03_2', 'lab03_2', 'JS/lab03_2', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001135, 38, 'Icon-14.png', 'lab04_1', 'lab04_1', 'JS/lab04_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001136, 39, 'Icon-14.png', 'lab04_2', 'lab04_2', 'JS/lab04_2', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001137, 40, 'Icon-14.png', 'lab05_1', 'lab05_1', 'JS/lab05_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001138, 41, 'Icon-14.png', 'lab05_2', 'lab05_2', 'JS/lab05_2', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001139, 42, 'Icon-14.png', 'lab06_1', 'lab06_1', 'JS/lab06_1', '', NULL, NULL, NULL, 7001128, 1),
(14, 7001140, 43, 'Icon-7.png', 'lab07_1', 'lab07_1', 'JS/lab07_1', '', '', 0, '', 7001128, 1),
(14, 7001141, 46, 'Icon-106.png', 'jQuery & AJAX', 'jQuery & AJAX', '#', '', NULL, NULL, NULL, 0, 0),
(14, 7001142, 47, 'Icon-100.png', 'jQuery Test', 'jQuery Test', 'Jquery_AJAX/jquery_test', '', NULL, NULL, NULL, 7001141, 1),
(14, 7001143, 48, 'Icon-100.png', 'AJAX Test', 'AJAX Test', 'Jquery_AJAX/ajax_test', '', NULL, NULL, NULL, 7001141, 1),
(14, 7001144, 49, 'Icon-7.png', 'Popup Quiz', 'Popup Quiz', 'Popup_quiz/', 'Popup Quiz', NULL, NULL, NULL, 0, 0),
(14, 7001145, 11, 'Icon-100.png', 'Template Avenxo', 'Template Avenxo', '#', '', NULL, NULL, NULL, 0, 0),
(14, 7001146, 12, 'Icon-106.png', 'Example Avenxo', 'Example Avenxo', 'HTML_CSS/example_html', '', '', 0, '', 7001145, 1),
(14, 7001147, 13, 'Icon-102.png', 'Avenxo-01', 'HTML Use Avenxo', 'HTML_CSS/Avenxo01', '', '', 0, '', 7001145, 1),
(14, 7001148, 22, 'Icon-15.png', 'หัดเขียน Ex-04', 'หัดเขียน Ex-04', 'PHP/ex_php_04', '', NULL, NULL, NULL, 7001115, 1),
(14, 7001149, 23, 'Icon-35.png', 'หัดเขียน Ex-05', 'หัดเขียน Ex-05', 'PHP/ex_php_05', '', NULL, NULL, NULL, 7001115, 1),
(14, 7001150, 24, 'Icon-9.png', 'หัดเขียน Ex-06', 'หัดเขียน Ex-06', 'PHP/ex_php_06', '', NULL, NULL, NULL, 7001115, 1),
(14, 7001151, 1, 'Icon-49.png', 'SQL', 'SQL', '#', '', NULL, NULL, NULL, 0, 0),
(14, 7001152, 2, 'Icon-49.png', 'SQL-01', 'SQL-01', '../56160000/SQL/SkillSQL', '', NULL, NULL, NULL, 7001151, 1),
(14, 7001153, 29, 'Icon-44.png', 'แบบปอร์มข้อมูลเพศ', 'gender', 'MVC/gender_input', '', NULL, NULL, NULL, 7001124, 1),
(14, 7001154, 26, 'Icon-1.png', 'MVC_01', 'mvc01', 'MVC/mvc_01', '', NULL, NULL, NULL, 7001124, 1),
(14, 7001155, 27, 'Icon-1.png', 'MVC_02', 'mvc02', 'MVC/mvc_02', '', NULL, NULL, NULL, 7001124, 1),
(14, 7001156, 28, 'Icon-44.png', 'ข้อมูล', 'da', 'MVC/gender_list', '', NULL, NULL, NULL, 7001124, 1),
(14, 7001157, 44, 'Icon-45.png', 'lab07_2', 'lab07_2', 'JS/lab07_2', 'lab07_2', NULL, NULL, NULL, 7001128, 1),
(14, 7001158, 45, 'Icon-49.png', 'AJAX_2', 'AJAX 2', 'AJAX/ajax_form_input', '', NULL, NULL, NULL, 7001128, 1),
(15, 7001159, 10, 'Icon-2.png', 'ค้นหาคำร้อง(รายงาน)', 'Report', '#', '', '', 0, '', 0, 0),
(15, 7001160, 11, 'Icon-14.png', 'เทศบาล', 'main de', 'cpt/report/C_cpt_report/report_bangpla', '', '', 0, '', 7001159, 1),
(15, 7001161, 12, 'Icon-14.png', 'ศูนย์ดำรงธรรม', 'Sub', 'cpt/report/C_cpt_report/report_dumrongthum', '', '', 0, '', 7001159, 1),
(15, 7001162, 13, 'Icon-14.png', 'รายงานคำร้องสถิติคำนวณ', 'Report sum', 'cpt/report/C_cpt_report/report_sta', '', '', 0, '', 7001159, 1),
(15, 7001163, 15, 'Icon-11.png', 'การติดตามคำร้อง', 'tracking', '#', '', NULL, NULL, NULL, 0, 0),
(15, 7001164, 16, 'Icon-103.png', 'ผู้ใช้ทั่วไป', 'public', 'cpt/report/C_cpt_tracking/tracking_front', '', NULL, NULL, NULL, 7001163, 1),
(15, 7001165, 17, 'Icon-35.png', 'เจ้าหน้าที่นิติกร', 'staff', 'cpt/report/C_cpt_tracking/tracking_back', '', '', 0, '', 7001163, 1),
(15, 7001166, 18, 'Icon-4.png', 'แจ้งผลการดำเนินงาน', 'report result', '#', '', '', 0, '', 0, 0),
(15, 7001167, 19, 'Icon-18.png', 'รายงานการดำเนินงาน', 'report Process', 'cpt/report/C_cpt_result', '', NULL, NULL, NULL, 7001166, 1),
(15, 7001168, 14, 'Icon-32.png', 'รายงานคำร้องสถิติตามประเภท', 'Report type', 'cpt/report/C_cpt_report/report_sta_type', '', NULL, NULL, NULL, 7001159, 1),
(15, 7001170, 1, 'Icon-1.png', 'ข้อมูลพื้นฐาน', '', '#', '', NULL, NULL, NULL, 0, 0),
(15, 7001171, 5, 'Icon-34.png', 'ข้อมูลหน่วยงาน', 'Department', 'cpt/basedata/Department', '', '', 0, '', 7001170, 1),
(15, 7001172, 6, 'Icon-34.png', 'ข้อมูลประเภทคำร้องเรียน/ร้องทุกข์', 'Complaint data type', 'cpt/basedata/Complaint_data_type', '', '', 0, '', 7001170, 1),
(15, 7001173, 2, 'Icon-34.png', 'ข้อมูลเรื่องคำร้องเรียน/ร้องทุกข์', 'Complaint data', 'cpt/basedata/Complaint_data', '', NULL, NULL, NULL, 7001170, 1),
(15, 7001174, 3, 'Icon-34.png', 'ข้อมูลสถานะการดำเนินการ', 'Complaint document status', 'cpt/basedata/Complaint_doc_status', '', NULL, NULL, NULL, 7001170, 1),
(15, 7001175, 4, 'Icon-34.png', 'ข้อมูลสถานะเอกสาร', 'Complaint document case', 'cpt/basedata/Complaint_doc_case', '', NULL, NULL, NULL, 7001170, 1),
(15, 7001176, 7, 'Icon-11.png', 'รับเรื่องร้องเรียน/ร้องทุกข์', 'Complaint approve request', '#', '', '', 0, '', 0, 0),
(15, 7001177, 8, 'Icon-13.png', 'ตั้งค่าเส้นทางคำร้องเรียน/ร้องทุกข์', 'Complaint mapping', 'cpt/approve/Complaint_mapping', '', NULL, NULL, NULL, 7001176, 1),
(15, 7001178, 9, 'Icon-12.png', 'อนุมัติคำร้องเรียน/ร้องทุกข์', 'Complaint approve', 'cpt/approve/Complaint_approve', '', NULL, NULL, NULL, 7001176, 1),
(16, 7001179, NULL, 'Icon-102.png', 'รายงาน', 'report', 'ffm/backend/Dashboard', 'รายงาน', NULL, NULL, NULL, 0, 0),
(16, 7001180, NULL, 'Icon-13.png', 'จัดการสนาม', 'Field management', 'ffm/backend/Field_manage', 'จัดการสนาม', NULL, NULL, NULL, 0, 0),
(16, 7001181, NULL, 'Icon-40.png', 'จัดการคำขอร้องใช้สนาม', 'Field reservation', 'ffm/backend/Field_reservation', 'จัดการคำขอร้องใช้สนาม', NULL, NULL, NULL, 0, 0),
(16, 7001182, NULL, 'Icon-45.png', 'จัดการใบเสร็จ', 'Bill managenebt', 'ffm/backend/Bill', 'จัดการใบเสร็จ', NULL, NULL, NULL, 0, 0),
(16, 7001183, 0, 'Icon-11.png', 'ประวัติการใช้งาน', 'Field history#', '#', '', '', 0, '', 0, 0),
(16, 7001184, NULL, 'Icon-44.png', 'ประวัติผู้ใช้งาน', 'Person history', 'ffm/backend/History/v_history_user', 'ประวัติผู้ใช้งาน', NULL, NULL, NULL, 7001183, 1),
(16, 7001185, NULL, 'Icon-39.png', 'ประวัติการใช้งานสนาม', 'Field history2', 'ffm/backend/History/v_history_field', 'ประวัติการใช้งานสนาม', NULL, NULL, NULL, 7001183, 1),
(16, 7001186, NULL, 'Icon-35.png', 'ประวัติรายได้', 'Income history', 'ffm/backend/History/v_history_income', 'ประวัติรายได้', NULL, NULL, NULL, 7001183, 1),
(16, 7001187, NULL, 'Icon-48.png', 'จัดการการแสดงความคิดเห็น', 'Complaint management', '#', 'จัดการการแสดงความคิดเห็น', NULL, NULL, NULL, 0, 0),
(16, 7001188, NULL, 'Icon-37.png', 'รายการความคิดเห็น', 'Complaint list', 'ffm/backend/Complain/v_complain_list', 'รายการความคิดเห็น', NULL, NULL, NULL, 7001187, 1),
(16, 7001189, NULL, 'Icon-351.png', 'จัดการประเภทความคิดเห็น', 'Complaint type', 'ffm/backend/Type_complain', 'จัดการประเภทความคิดเห็น', NULL, NULL, NULL, 7001187, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ummenu`
--
ALTER TABLE `ummenu`
  ADD PRIMARY KEY (`MnID`),
  ADD KEY `MnStID` (`MnStID`),
  ADD KEY `MnParentMnID` (`MnParentMnID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ummenu`
--
ALTER TABLE `ummenu`
  MODIFY `MnID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7001190;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
