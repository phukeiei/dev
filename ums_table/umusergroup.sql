-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 17, 2019 at 08:41 PM
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
-- Table structure for table `umusergroup`
--

CREATE TABLE `umusergroup` (
  `UgID` int(11) NOT NULL,
  `UgGpID` int(11) NOT NULL,
  `UgUsID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `umusergroup`
--

INSERT INTO `umusergroup` (`UgID`, `UgGpID`, `UgUsID`) VALUES
(11, 200011, 1),
(13, 200020, 1),
(14, 200012, 1),
(15, 200013, 1),
(16, 200014, 1),
(17, 200015, 1),
(18, 200016, 1),
(231, 200022, 1),
(232, 200023, 1),
(233, 200024, 1),
(247, 200026, 1),
(289, 200039, 1),
(298, 200040, 1),
(349, 200042, 1),
(382, 200035, 1),
(384, 200043, 1),
(385, 200044, 1),
(1000, 200049, 1),
(1025, 200060, 1),
(1026, 200062, 1),
(1033, 200067, 1),
(1049, 550001, 1),
(1050, 550002, 1),
(1051, 550003, 1),
(1052, 550004, 1),
(1053, 550005, 1),
(1176, 230001, 1),
(1177, 230002, 1),
(1179, 200036, 1),
(1180, 200037, 1),
(1181, 200038, 1),
(1182, 550006, 1),
(1183, 550007, 1),
(1184, 550008, 1),
(1185, 550009, 1),
(1186, 550010, 1),
(1191, 200048, 1),
(1271, 200053, 1),
(1281, 550018, 1),
(1282, 550019, 1),
(1283, 550020, 1),
(1289, 550021, 1),
(1452, 230003, 1),
(1453, 230004, 1),
(1454, 230005, 1),
(1455, 230006, 1),
(1456, 230007, 1),
(1457, 230008, 1),
(1458, 230009, 1),
(1459, 230010, 1),
(1513, 550032, 1),
(1531, 550033, 1),
(1647, 550013, 1),
(1648, 550014, 1),
(1649, 550015, 1),
(1650, 550016, 1),
(1651, 550017, 1),
(1652, 550029, 1),
(1653, 550030, 1),
(1665, 550022, 1),
(1666, 550026, 1),
(1667, 200030, 1),
(1668, 200031, 1),
(1669, 200032, 1),
(1670, 200033, 1),
(1671, 200034, 1),
(1784, 550057, 1),
(1893, 10001, 1),
(1923, 550073, 1),
(2182, 550083, 1),
(2231, 550080, 1),
(2234, 200021, 1),
(2235, 200025, 1),
(2236, 550081, 1),
(2237, 550082, 1),
(2238, 550084, 1),
(2267, 200027, 1),
(2277, 200017, 1),
(2291, 200040, 3),
(2292, 200041, 3),
(2425, 10001, 309),
(2427, 200041, 309),
(2683, 10001, 310),
(2684, 200041, 310),
(2687, 200041, 313),
(2688, 200041, 314),
(2689, 200041, 315),
(2690, 200041, 316),
(2691, 200041, 317),
(2692, 200041, 318),
(2693, 200041, 319),
(2694, 200041, 320),
(2695, 200041, 321),
(2696, 200041, 322),
(2697, 200041, 323),
(2698, 200041, 324),
(2699, 200041, 325),
(2700, 200041, 326),
(2702, 200041, 328),
(2703, 200041, 329),
(2704, 200041, 330),
(2705, 200041, 331),
(2706, 200041, 332),
(2707, 200041, 333),
(2708, 200041, 334),
(2709, 200041, 335),
(2710, 200041, 336),
(2711, 200041, 337),
(2712, 200041, 338),
(2713, 200041, 339),
(2714, 200041, 340),
(2715, 200041, 341),
(2716, 200041, 342),
(2717, 200041, 343),
(2718, 200041, 344),
(2719, 200041, 345),
(2720, 200041, 346),
(2721, 200041, 347),
(2722, 200041, 348),
(2723, 200041, 349),
(2724, 200041, 350),
(2725, 200041, 351),
(2726, 200041, 352),
(2727, 200041, 353),
(2728, 200041, 354),
(2729, 200041, 355),
(2730, 200041, 356),
(2731, 200041, 357),
(2732, 200041, 358),
(2733, 200041, 359),
(2734, 200041, 360),
(2735, 200041, 361),
(2736, 200041, 362),
(2737, 200041, 363),
(2738, 200041, 364),
(2739, 200041, 365),
(2740, 200041, 366),
(2741, 200041, 367),
(2742, 200041, 368),
(2743, 200041, 369),
(2744, 200041, 370),
(2745, 200041, 371),
(2746, 200041, 372),
(2747, 200041, 373),
(2748, 200041, 374),
(2749, 200041, 375),
(2751, 200041, 377),
(2752, 200041, 378),
(2753, 200041, 379),
(2754, 200041, 380),
(2755, 200041, 381),
(2756, 200041, 382),
(2757, 200041, 383),
(2758, 200041, 384),
(2759, 200041, 385),
(2760, 200041, 386),
(2761, 200041, 387),
(2762, 200041, 388),
(2763, 200042, 310),
(2764, 200043, 310),
(2765, 200043, 327),
(2766, 200043, 332),
(2767, 200043, 338),
(2768, 200043, 346),
(2769, 200043, 314),
(2770, 200043, 341),
(2771, 200043, 319),
(2772, 200043, 324),
(2774, 200044, 317),
(2775, 200044, 322),
(2776, 200044, 326),
(2777, 200044, 330),
(2778, 200044, 340),
(2779, 200044, 345),
(2780, 200044, 348),
(2781, 200045, 1),
(2782, 200045, 323),
(2783, 200045, 342),
(2784, 200045, 337),
(2785, 200045, 313),
(2786, 200045, 331),
(2787, 200045, 318),
(2788, 200045, 335),
(2789, 200042, 376);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `umusergroup`
--
ALTER TABLE `umusergroup`
  ADD PRIMARY KEY (`UgGpID`,`UgUsID`),
  ADD KEY `UgUsID` (`UgUsID`),
  ADD KEY `UgGpID` (`UgGpID`),
  ADD KEY `UgID` (`UgID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `umusergroup`
--
ALTER TABLE `umusergroup`
  MODIFY `UgID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2790;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
