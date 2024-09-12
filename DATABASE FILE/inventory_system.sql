-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2024 at 02:47 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(121, 'Cable'),
(122, 'Cctv'),
(118, 'Computer'),
(123, 'Printer'),
(120, 'Switch Internet'),
(35, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `name`, `email`, `message`, `created_at`) VALUES
(34, 'Rizel Bracerooo', 'rizelbrace442@gmail.com', 'RIZELBRAWLDWW\r\n', '2024-07-24 09:17:17'),
(35, 'AWDWADWD', 'rizelbrace2@gmail.com', 'AWDWADWAD', '2024-07-24 09:17:37'),
(36, 'Ramil bracero Bracero', 'rizelbrace2@gmail.com', 'awdwd', '2024-07-24 09:17:47'),
(37, 'Ramil bracero Bracero', 'rizelbrace2@gmail.com', 'wadwdwd', '2024-07-24 10:03:35'),
(38, 'Alexes Iloveyou', 'alexesbaunsit@gmail.com', 'Iloveyoualways', '2024-07-25 09:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `chord1`
--

CREATE TABLE `chord1` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chord1`
--

INSERT INTO `chord1` (`id`, `file_name`, `file_type`) VALUES
(1279, 'i (1).jpg', 'image/jpeg'),
(1280, 'i (2).jpg', 'image/jpeg'),
(1281, 'i (3).jpg', 'image/jpeg'),
(1282, 'i (4).jpg', 'image/jpeg'),
(1283, 'i (5).jpg', 'image/jpeg'),
(1284, 'i (6).jpg', 'image/jpeg'),
(1285, 'i (7).jpg', 'image/jpeg'),
(1286, 'i (8).jpg', 'image/jpeg'),
(1287, 'i (9).jpg', 'image/jpeg'),
(1288, 'i (10).jpg', 'image/jpeg'),
(1289, 'i (11).jpg', 'image/jpeg'),
(1290, 'i (12).jpg', 'image/jpeg'),
(1291, 'i (13).jpg', 'image/jpeg'),
(1292, 'i (14).jpg', 'image/jpeg'),
(1293, 'i (15).jpg', 'image/jpeg'),
(1294, 'i (16).jpg', 'image/jpeg'),
(1295, 'i (17).jpg', 'image/jpeg'),
(1296, 'i (18).jpg', 'image/jpeg'),
(1297, 'i (19).jpg', 'image/jpeg'),
(1298, 'i (20).jpg', 'image/jpeg'),
(1299, 'i (21).jpg', 'image/jpeg'),
(1300, 'i (22).jpg', 'image/jpeg'),
(1301, 'i (23).jpg', 'image/jpeg'),
(1302, 'i (24).jpg', 'image/jpeg'),
(1303, 'i (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `chord2`
--

CREATE TABLE `chord2` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chord2`
--

INSERT INTO `chord2` (`id`, `file_name`, `file_type`) VALUES
(1079, 'j (1).jpg', 'image/jpeg'),
(1080, 'j (2).jpg', 'image/jpeg'),
(1081, 'j (3).jpg', 'image/jpeg'),
(1082, 'j (4).jpg', 'image/jpeg'),
(1083, 'j (5).jpg', 'image/jpeg'),
(1084, 'j (6).jpg', 'image/jpeg'),
(1085, 'j (7).jpg', 'image/jpeg'),
(1086, 'j (8).jpg', 'image/jpeg'),
(1087, 'j (9).jpg', 'image/jpeg'),
(1088, 'j (10).jpg', 'image/jpeg'),
(1089, 'j (11).jpg', 'image/jpeg'),
(1090, 'j (12).jpg', 'image/jpeg'),
(1091, 'j (13).jpg', 'image/jpeg'),
(1092, 'j (14).jpg', 'image/jpeg'),
(1093, 'j (15).jpg', 'image/jpeg'),
(1094, 'j (16).jpg', 'image/jpeg'),
(1095, 'j (17).jpg', 'image/jpeg'),
(1096, 'j (18).jpg', 'image/jpeg'),
(1097, 'j (19).jpg', 'image/jpeg'),
(1098, 'j (20).jpg', 'image/jpeg'),
(1099, 'j (21).jpg', 'image/jpeg'),
(1100, 'j (22).jpg', 'image/jpeg'),
(1101, 'j (23).jpg', 'image/jpeg'),
(1102, 'j (24).jpg', 'image/jpeg'),
(1103, 'j (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `computer`
--

CREATE TABLE `computer` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `computer`
--

INSERT INTO `computer` (`id`, `file_name`, `file_type`) VALUES
(2879, 'a (1).jpeg', 'image/jpeg'),
(2880, 'a (2).jpeg', 'image/jpeg'),
(2881, 'a (3).jpeg', 'image/jpeg'),
(2882, 'a (4).jpeg', 'image/jpeg'),
(2883, 'a (5).jpeg', 'image/jpeg'),
(2884, 'a (6).jpeg', 'image/jpeg'),
(2885, 'a (7).jpeg', 'image/jpeg'),
(2886, 'a (8).jpeg', 'image/jpeg'),
(2887, 'a (9).jpeg', 'image/jpeg'),
(2888, 'a (10).jpeg', 'image/jpeg'),
(2889, 'a (11).jpeg', 'image/jpeg'),
(2890, 'a (12).jpeg', 'image/jpeg'),
(2891, 'a (13).jpeg', 'image/jpeg'),
(2892, 'a (14).jpeg', 'image/jpeg'),
(2893, 'a (15).jpeg', 'image/jpeg'),
(2894, 'a (16).jpeg', 'image/jpeg'),
(2895, 'a (17).jpeg', 'image/jpeg'),
(2896, 'a (18).jpeg', 'image/jpeg'),
(2897, 'a (19).jpeg', 'image/jpeg'),
(2898, 'a (20).jpeg', 'image/jpeg'),
(2899, 'a (21).jpeg', 'image/jpeg'),
(2900, 'a (22).jpeg', 'image/jpeg'),
(2901, 'a (23).jpeg', 'image/jpeg'),
(2902, 'a (24).jpeg', 'image/jpeg'),
(2903, 'a (25).jpeg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `cpu`
--

CREATE TABLE `cpu` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cpu`
--

INSERT INTO `cpu` (`id`, `file_name`, `file_type`) VALUES
(579, 'n (1).jpg', 'image/jpeg'),
(580, 'n (2).jpg', 'image/jpeg'),
(581, 'n (3).jpg', 'image/jpeg'),
(582, 'n (4).jpg', 'image/jpeg'),
(583, 'n (5).jpg', 'image/jpeg'),
(584, 'n (6).jpg', 'image/jpeg'),
(585, 'n (7).jpg', 'image/jpeg'),
(586, 'n (8).jpg', 'image/jpeg'),
(587, 'n (9).jpg', 'image/jpeg'),
(588, 'n (10).jpg', 'image/jpeg'),
(589, 'n (11).jpg', 'image/jpeg'),
(590, 'n (12).jpg', 'image/jpeg'),
(591, 'n (13).jpg', 'image/jpeg'),
(592, 'n (14).jpg', 'image/jpeg'),
(593, 'n (15).jpg', 'image/jpeg'),
(594, 'n (16).jpg', 'image/jpeg'),
(595, 'n (17).jpg', 'image/jpeg'),
(596, 'n (18).jpg', 'image/jpeg'),
(597, 'n (19).jpg', 'image/jpeg'),
(598, 'n (20).jpg', 'image/jpeg'),
(599, 'n (21).jpg', 'image/jpeg'),
(600, 'n (22).jpg', 'image/jpeg'),
(601, 'n (23).jpg', 'image/jpeg'),
(602, 'n (24).jpg', 'image/jpeg'),
(603, 'n (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `hddssdgb`
--

CREATE TABLE `hddssdgb` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hddssdgb`
--

INSERT INTO `hddssdgb` (`id`, `file_name`, `file_type`) VALUES
(68, 'o (1).jpg', 'image/jpeg'),
(69, 'o (2).jpg', 'image/jpeg'),
(70, 'o (3).jpg', 'image/jpeg'),
(71, 'o (4).jpg', 'image/jpeg'),
(72, 'o (5).jpg', 'image/jpeg'),
(73, 'o (6).jpg', 'image/jpeg'),
(74, 'o (7).jpg', 'image/jpeg'),
(75, 'o (8).jpg', 'image/jpeg'),
(76, 'o (9).jpg', 'image/jpeg'),
(77, 'o (10).jpg', 'image/jpeg'),
(78, 'o (11).jpg', 'image/jpeg'),
(79, 'o (12).jpg', 'image/jpeg'),
(80, 'o (13).jpg', 'image/jpeg'),
(81, 'o (14).jpg', 'image/jpeg'),
(82, 'o (15).jpg', 'image/jpeg'),
(83, 'o (16).jpg', 'image/jpeg'),
(84, 'o (17).jpg', 'image/jpeg'),
(85, 'o (18).jpg', 'image/jpeg'),
(86, 'o (19).jpg', 'image/jpeg'),
(87, 'o (20).jpg', 'image/jpeg'),
(88, 'o (21).jpg', 'image/jpeg'),
(89, 'o (22).jpg', 'image/jpeg'),
(90, 'o (23).jpg', 'image/jpeg'),
(91, 'o (24).jpg', 'image/jpeg'),
(92, 'o (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `keyboard`
--

CREATE TABLE `keyboard` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keyboard`
--

INSERT INTO `keyboard` (`id`, `file_name`, `file_type`) VALUES
(2479, 'c (1).png', 'image/png'),
(2480, 'c (2).png', 'image/png'),
(2481, 'c (3).png', 'image/png'),
(2482, 'c (4).png', 'image/png'),
(2483, 'c (5).png', 'image/png'),
(2484, 'c (6).png', 'image/png'),
(2485, 'c (7).png', 'image/png'),
(2486, 'c (8).png', 'image/png'),
(2487, 'c (9).png', 'image/png'),
(2488, 'c (10).png', 'image/png'),
(2489, 'c (11).png', 'image/png'),
(2490, 'c (12).png', 'image/png'),
(2491, 'c (13).png', 'image/png'),
(2492, 'c (14).png', 'image/png'),
(2493, 'c (15).png', 'image/png'),
(2494, 'c (16).png', 'image/png'),
(2495, 'c (17).png', 'image/png'),
(2496, 'c (18).png', 'image/png'),
(2497, 'c (19).png', 'image/png'),
(2498, 'c (20).png', 'image/png'),
(2499, 'c (21).png', 'image/png'),
(2500, 'c (22).png', 'image/png'),
(2501, 'c (23).png', 'image/png'),
(2502, 'c (24).png', 'image/png'),
(2503, 'c (25).png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(50, 'Computer.jpg', 'image/jpeg'),
(51, 'Printer.jpg', 'image/jpeg'),
(52, 'TV.jpg', 'image/jpeg'),
(53, 'ElectricFan.jpg', 'image/jpeg'),
(54, 'Cctv.jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `monitor`
--

CREATE TABLE `monitor` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `monitor`
--

INSERT INTO `monitor` (`id`, `file_name`, `file_type`) VALUES
(2679, 'b (1).jpeg', 'image/jpeg'),
(2680, 'b (2).jpeg', 'image/jpeg'),
(2681, 'b (3).jpeg', 'image/jpeg'),
(2682, 'b (4).jpeg', 'image/jpeg'),
(2683, 'b (5).jpeg', 'image/jpeg'),
(2684, 'b (6).jpeg', 'image/jpeg'),
(2685, 'b (7).jpeg', 'image/jpeg'),
(2686, 'b (8).jpeg', 'image/jpeg'),
(2687, 'b (9).jpeg', 'image/jpeg'),
(2688, 'b (10).jpeg', 'image/jpeg'),
(2689, 'b (11).jpeg', 'image/jpeg'),
(2690, 'b (12).jpeg', 'image/jpeg'),
(2691, 'b (13).jpeg', 'image/jpeg'),
(2692, 'b (14).jpeg', 'image/jpeg'),
(2693, 'b (15).jpeg', 'image/jpeg'),
(2694, 'b (16).jpeg', 'image/jpeg'),
(2695, 'b (17).jpeg', 'image/jpeg'),
(2696, 'b (18).jpeg', 'image/jpeg'),
(2697, 'b (19).jpeg', 'image/jpeg'),
(2698, 'b (20).jpeg', 'image/jpeg'),
(2699, 'b (21).jpeg', 'image/jpeg'),
(2700, 'b (22).jpeg', 'image/jpeg'),
(2701, 'b (23).jpeg', 'image/jpeg'),
(2702, 'b (24).jpeg', 'image/jpeg'),
(2703, 'b (25).jpeg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mother`
--

CREATE TABLE `mother` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mother`
--

INSERT INTO `mother` (`id`, `file_name`, `file_type`) VALUES
(879, 'k (1).jpg', 'image/jpeg'),
(880, 'k (2).jpg', 'image/jpeg'),
(881, 'k (3).jpg', 'image/jpeg'),
(882, 'k (4).jpg', 'image/jpeg'),
(883, 'k (5).jpg', 'image/jpeg'),
(884, 'k (6).jpg', 'image/jpeg'),
(885, 'k (7).jpg', 'image/jpeg'),
(886, 'k (8).jpg', 'image/jpeg'),
(887, 'k (9).jpg', 'image/jpeg'),
(888, 'k (10).jpg', 'image/jpeg'),
(889, 'k (11).jpg', 'image/jpeg'),
(890, 'k (12).jpg', 'image/jpeg'),
(891, 'k (13).jpg', 'image/jpeg'),
(892, 'k (14).jpg', 'image/jpeg'),
(893, 'k (15).jpg', 'image/jpeg'),
(894, 'k (16).jpg', 'image/jpeg'),
(895, 'k (17).jpg', 'image/jpeg'),
(896, 'k (18).jpg', 'image/jpeg'),
(897, 'k (19).jpg', 'image/jpeg'),
(898, 'k (20).jpg', 'image/jpeg'),
(899, 'k (21).jpg', 'image/jpeg'),
(900, 'k (22).jpg', 'image/jpeg'),
(901, 'k (23).jpg', 'image/jpeg'),
(902, 'k (24).jpg', 'image/jpeg'),
(903, 'k (25).jpg', 'image/jpeg'),
(904, 'k (26).jpg', 'image/jpeg'),
(905, 'k (27).jpg', 'image/jpeg'),
(906, 'k (28).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `mouse`
--

CREATE TABLE `mouse` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mouse`
--

INSERT INTO `mouse` (`id`, `file_name`, `file_type`) VALUES
(2279, 'd (1).jpg', 'image/jpeg'),
(2280, 'd (2).jpg', 'image/jpeg'),
(2281, 'd (3).jpg', 'image/jpeg'),
(2282, 'd (4).jpg', 'image/jpeg'),
(2283, 'd (5).jpg', 'image/jpeg'),
(2284, 'd (6).jpg', 'image/jpeg'),
(2285, 'd (7).jpg', 'image/jpeg'),
(2286, 'd (8).jpg', 'image/jpeg'),
(2287, 'd (9).jpg', 'image/jpeg'),
(2288, 'd (10).jpg', 'image/jpeg'),
(2289, 'd (11).jpg', 'image/jpeg'),
(2290, 'd (12).jpg', 'image/jpeg'),
(2291, 'd (13).jpg', 'image/jpeg'),
(2292, 'd (14).jpg', 'image/jpeg'),
(2293, 'd (15).jpg', 'image/jpeg'),
(2294, 'd (16).jpg', 'image/jpeg'),
(2295, 'd (17).jpg', 'image/jpeg'),
(2296, 'd (18).jpg', 'image/jpeg'),
(2297, 'd (19).jpg', 'image/jpeg'),
(2298, 'd (20).jpg', 'image/jpeg'),
(2299, 'd (21).jpg', 'image/jpeg'),
(2300, 'd (22).jpg', 'image/jpeg'),
(2301, 'd (23).jpg', 'image/jpeg'),
(2302, 'd (24).jpg', 'image/jpeg'),
(2303, 'd (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `media_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `donate` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `dreceived` date DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `recievedby` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `serial` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `other_images` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `barrow` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other`
--

INSERT INTO `other` (`id`, `name`, `media_id`, `donate`, `dreceived`, `date`, `categorie_id`, `recievedby`, `serial`, `other_images`, `barrow`) VALUES
(64, 'Faculty', '50', 'HouseofIT', '2024-08-27', '2024-09-11 17:57:51', 121, ' ITdepartment', 'ac3', 'Maintenance', ''),
(66, 'Faculty', '51', ' HouseofIT', '2024-08-26', '2024-09-12 17:56:12', 121, ' ITdepartment', ' ac2', '2', ''),
(67, 'Faculty', '50', ' ITdepartment', '2024-08-26', '2024-09-12 17:56:31', 122, ' HouseofIT', ' ac2s', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `other_images`
--

CREATE TABLE `other_images` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `other_images`
--

INSERT INTO `other_images` (`id`, `file_name`, `file_type`) VALUES
(1, 'Screenshot (199).png', 'image/png'),
(2, 'o (10).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `power1`
--

CREATE TABLE `power1` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power1`
--

INSERT INTO `power1` (`id`, `file_name`, `file_type`) VALUES
(1679, 'g (1).jpg', 'image/jpeg'),
(1680, 'g (2).jpg', 'image/jpeg'),
(1681, 'g (3).jpg', 'image/jpeg'),
(1682, 'g (4).jpg', 'image/jpeg'),
(1683, 'g (5).jpg', 'image/jpeg'),
(1684, 'g (6).jpg', 'image/jpeg'),
(1685, 'g (7).jpg', 'image/jpeg'),
(1686, 'g (8).jpg', 'image/jpeg'),
(1687, 'g (9).jpg', 'image/jpeg'),
(1688, 'g (10).jpg', 'image/jpeg'),
(1689, 'g (11).jpg', 'image/jpeg'),
(1690, 'g (12).jpg', 'image/jpeg'),
(1691, 'g (13).jpg', 'image/jpeg'),
(1692, 'g (14).jpg', 'image/jpeg'),
(1693, 'g (15).jpg', 'image/jpeg'),
(1694, 'g (16).jpg', 'image/jpeg'),
(1695, 'g (17).jpg', 'image/jpeg'),
(1696, 'g (18).jpg', 'image/jpeg'),
(1697, 'g (19).jpg', 'image/jpeg'),
(1698, 'g (20).jpg', 'image/jpeg'),
(1699, 'g (21).jpg', 'image/jpeg'),
(1700, 'g (22).jpg', 'image/jpeg'),
(1701, 'g (23).jpg', 'image/jpeg'),
(1702, 'g (24).jpg', 'image/jpeg'),
(1703, 'g (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `power2`
--

CREATE TABLE `power2` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `power2`
--

INSERT INTO `power2` (`id`, `file_name`, `file_type`) VALUES
(1479, 'h (1).jpg', 'image/jpeg'),
(1480, 'h (2).jpg', 'image/jpeg'),
(1481, 'h (3).jpg', 'image/jpeg'),
(1482, 'h (4).jpg', 'image/jpeg'),
(1483, 'h (5).jpg', 'image/jpeg'),
(1484, 'h (6).jpg', 'image/jpeg'),
(1485, 'h (7).jpg', 'image/jpeg'),
(1486, 'h (8).jpg', 'image/jpeg'),
(1487, 'h (9).jpg', 'image/jpeg'),
(1488, 'h (10).jpg', 'image/jpeg'),
(1489, 'h (11).jpg', 'image/jpeg'),
(1490, 'h (12).jpg', 'image/jpeg'),
(1491, 'h (13).jpg', 'image/jpeg'),
(1492, 'h (14).jpg', 'image/jpeg'),
(1493, 'h (15).jpg', 'image/jpeg'),
(1494, 'h (16).jpg', 'image/jpeg'),
(1495, 'h (17).jpg', 'image/jpeg'),
(1496, 'h (18).jpg', 'image/jpeg'),
(1497, 'h (19).jpg', 'image/jpeg'),
(1498, 'h (20).jpg', 'image/jpeg'),
(1499, 'h (21).jpg', 'image/jpeg'),
(1500, 'h (22).jpg', 'image/jpeg'),
(1501, 'h (23).jpg', 'image/jpeg'),
(1502, 'h (24).jpg', 'image/jpeg'),
(1503, 'h (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(250) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `monitor` varchar(255) NOT NULL,
  `Keyboard` varchar(255) NOT NULL,
  `mouse` varchar(255) NOT NULL,
  `v1` varchar(255) NOT NULL,
  `p1` varchar(255) NOT NULL,
  `p2` varchar(255) NOT NULL,
  `power1` varchar(255) NOT NULL,
  `system` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `cpu` varchar(255) NOT NULL,
  `ram` varchar(255) NOT NULL,
  `power2` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `h` varchar(255) NOT NULL,
  `donate` varchar(255) NOT NULL,
  `dreceived` date DEFAULT NULL,
  `recievedby` varchar(255) NOT NULL,
  `computer_images` varchar(255) DEFAULT NULL,
  `monitor_images` varchar(255) DEFAULT NULL,
  `keyboard_images` varchar(255) DEFAULT NULL,
  `mouse_images` varchar(255) DEFAULT NULL,
  `vgahdmi_images` varchar(255) DEFAULT NULL,
  `chord1_images` varchar(255) DEFAULT NULL,
  `chord2_images` varchar(255) DEFAULT NULL,
  `cpu_images` varchar(255) DEFAULT NULL,
  `hddssdgb_images` varchar(255) DEFAULT NULL,
  `mother_images` varchar(255) DEFAULT NULL,
  `power1_images` varchar(255) DEFAULT NULL,
  `power2_images` varchar(255) DEFAULT NULL,
  `ram_images` varchar(255) DEFAULT NULL,
  `system_images` varchar(255) DEFAULT NULL,
  `video_images` varchar(255) DEFAULT NULL,
  `barrow` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `categorie_id`, `media_id`, `date`, `monitor`, `Keyboard`, `mouse`, `v1`, `p1`, `p2`, `power1`, `system`, `mother`, `cpu`, `ram`, `power2`, `video`, `h`, `donate`, `dreceived`, `recievedby`, `computer_images`, `monitor_images`, `keyboard_images`, `mouse_images`, `vgahdmi_images`, `chord1_images`, `chord2_images`, `cpu_images`, `hddssdgb_images`, `mother_images`, `power1_images`, `power2_images`, `ram_images`, `system_images`, `video_images`, `barrow`) VALUES
(597, 'Com lab 4', 118, '50', '2024-09-12 20:20:09', ' Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', 'CD024', ' Acer ', '  Acer', '  Acer', '  Acer', '  Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2902', '2702', '2502', '2302', '1902', '1302', '1102', '602', '91', '902', '1702', '1502', '502', '2102', '302', ''),
(598, 'Com lab 3', 118, '50', '2024-09-12 20:20:53', '   Acer', '    Acer', '    Acer', '    Acer', '   Acer', '   Acer', '   Acer', '   Acer', 'CD023', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   HouseofIT', '2020-01-01', '   ITdepartment', '2901', '2701', '2501', '2301', '1901', '1301', '1101', '601', '90', '901', '1701', '1501', '501', '2101', '301', ''),
(599, 'Com lab 2', 118, '50', '2024-09-12 20:21:36', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD022', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2900', '2700', '2500', '2300', '1900', '1300', '1100', '600', '89', '900', '1700', '1500', '500', '2100', '300', ''),
(600, 'Com lab 1', 118, '50', '2024-09-12 20:22:21', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', 'CD021', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   HouseofIT', '2020-01-01', '   ITdepartment', '2899', '2699', '2499', '2299', '1899', '1299', '1099', '599', '88', '899', '1699', '1499', '499', '2099', '299', ''),
(601, 'Com lab 4', 118, '50', '2024-09-12 20:19:13', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'Acer ', ' Acer', ' Acer', 'CD025', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2903', '2703', '2503', '2303', '1903', '1303', '1103', '603', '92', '903', '1703', '1503', '503', '2103', '303', ''),
(602, 'Server Room', 118, '50', '2024-09-12 20:33:46', ' Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', 'CD002', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  HouseofIT', '0000-00-00', '  ITdepartment', '2880', '2680', '2480', '2280', '1880', '1280', '1080', '580', '69', '880', '1680', '1480', '480', '2080', '280', ''),
(604, 'Server Room', 118, '50', '2024-09-12 20:35:15', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', 'CD003', '  Acer', '  Acer', '  Acer', '  Acer', '  ', '  HouseofIT', '2020-01-01', '  ITdepartment', '2881', '2681', '2481', '2281', '1881', '1281', '1081', '581', '70', '881', '1681', '1481', '481', '2081', '281', ''),
(605, 'Server Room', 118, '50', '2024-09-12 20:36:04', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD004', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2882', '2682', '2482', '2282', '1882', '1282', '1082', '582', '71', '882', '1682', '1482', '482', '2082', '282', ''),
(606, 'Faculty', 118, '50', '2024-09-12 20:31:13', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD001', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2879', '2679', '2479', '2279', '1879', '1279', '1079', '579', '68', '879', '1679', '1479', '479', '2079', '279', 'Return'),
(607, 'Server Room', 118, '50', '2024-09-12 20:36:53', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD005', 'Acer ', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '0000-00-00', ' ITdepartment', '2883', '2683', '2483', '2283', '1883', '1283', '1083', '583', '72', '883', '1683', '1483', '483', '2083', '283', 'awdwd'),
(608, 'Server Room', 118, '50', '2024-09-12 20:38:08', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', 'CD006', '  ', '  Acer', '  Acer', '  Acer', '  Acer', '  HouseofIT', '0000-00-00', '  ITdepartment', '2884', '2684', '2484', '2284', '1884', '1284', '1084', '584', '73', '884', '1684', '1484', '484', '2084', '284', ''),
(610, 'Server Room', 118, '50', '2024-09-12 20:39:57', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', 'CD007', '  Acer', '  Acer', '  Acer', '  Acer', '  Acer', '  HouseofIT', '2020-01-01', '  ITdepartment', '2885', '2685', '2485', '2285', '1885', '1285', '1085', '585', '74', '885', '1685', '1485', '485', '2085', '285', ''),
(611, 'Server Room', 118, '50', '2024-09-12 20:42:25', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'Acer ', ' Acer', ' Acer', 'CD008', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '0000-00-00', ' ITdepartment', '2886', '2686', '2486', '2286', '1886', '1286', '1086', '586', '75', '886', '1686', '1486', '486', '2086', '286', ''),
(612, 'Server Room', 118, '50', '2024-09-12 20:43:31', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'Acer', ' Acer', ' Acer', 'CD010', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2888', '2688', '2488', '2288', '1888', '1288', '1088', '588', '77', '888', '1688', '1488', '488', '2088', '288', ''),
(613, 'Server Room', 118, '50', '2024-09-12 20:44:15', 'Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD011', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2889', '2689', '2489', '2289', '1889', '1289', '1089', '589', '78', '889', '1689', '1489', '489', '2089', '289', ''),
(614, 'Server Room', 118, '50', '2024-09-12 20:44:58', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD012', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2890', '2690', '2490', '2290', '1890', '1290', '1090', '590', '79', '890', '1690', '1490', '490', '2090', '290', ''),
(615, 'Server Room', 118, '50', '2024-09-12 20:31:27', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD013', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2891', '2691', '2491', '2291', '1891', '1291', '1091', '591', '80', '891', '1691', '1491', '491', '2091', '291', ''),
(616, 'Server Room', 118, '50', '2024-09-12 20:45:39', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD014', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2892', '2692', '2492', '2292', '1892', '1292', '1092', '592', '81', '892', '1692', '1492', '492', '2092', '292', ''),
(617, 'Server Room', 118, '50', '2024-09-12 20:29:21', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD015', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2893', '2693', '2493', '2293', '1893', '1293', '1093', '593', '82', '893', '1693', '1493', '493', '2094', '293', ''),
(618, 'Server Room', 118, '50', '2024-09-12 20:27:59', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'Acer ', 'CD016', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2894', '2694', '2494', '2294', '1894', '1294', '1094', '594', '83', '894', '1694', '1494', '494', '2093', '294', ''),
(619, 'Server Room', 118, '50', '2024-09-12 20:26:56', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD017', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2895', '2695', '2495', '2295', '1895', '1295', '1095', '595', '84', '895', '1695', '1495', '495', '2095', '295', ''),
(620, 'Server Room', 118, '50', '2024-09-12 20:25:59', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD018', 'Acer ', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2896', '2696', '2496', '2296', '1896', '1296', '1096', '596', '85', '896', '1696', '1496', '496', '2096', '296', ''),
(621, 'Server Room', 118, '50', '2024-09-12 20:24:49', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', 'CD019', ' Acer', ' Acer', ' Acer', ' Acer', ' Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2897', '2697', '2497', '2297', '1897', '1297', '1097', '597', '86', '897', '1697', '1497', '497', '2097', '297', ''),
(624, 'Server Room', 118, '50', '2024-09-12 20:23:36', ' Acer', '  Acer', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', '  Acer ', 'CD020', '   Acer', '   Acer', '   Acer', '   Acer', '   Acer', ' HouseofIT', '2020-01-01', ' ITdepartment', '2898', '2698', '2498', '2298', '1898', '1298', '1098', '598', '87', '898', '1698', '1498', '498', '2098', '298', '');

-- --------------------------------------------------------

--
-- Table structure for table `ram`
--

CREATE TABLE `ram` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ram`
--

INSERT INTO `ram` (`id`, `file_name`, `file_type`) VALUES
(479, 'l (1).jpg', 'image/jpeg'),
(480, 'l (2).jpg', 'image/jpeg'),
(481, 'l (3).jpg', 'image/jpeg'),
(482, 'l (4).jpg', 'image/jpeg'),
(483, 'l (5).jpg', 'image/jpeg'),
(484, 'l (6).jpg', 'image/jpeg'),
(485, 'l (7).jpg', 'image/jpeg'),
(486, 'l (8).jpg', 'image/jpeg'),
(487, 'l (9).jpg', 'image/jpeg'),
(488, 'l (10).jpg', 'image/jpeg'),
(489, 'l (11).jpg', 'image/jpeg'),
(490, 'l (12).jpg', 'image/jpeg'),
(491, 'l (13).jpg', 'image/jpeg'),
(492, 'l (14).jpg', 'image/jpeg'),
(493, 'l (15).jpg', 'image/jpeg'),
(494, 'l (16).jpg', 'image/jpeg'),
(495, 'l (17).jpg', 'image/jpeg'),
(496, 'l (18).jpg', 'image/jpeg'),
(497, 'l (19).jpg', 'image/jpeg'),
(498, 'l (20).jpg', 'image/jpeg'),
(499, 'l (21).jpg', 'image/jpeg'),
(500, 'l (22).jpg', 'image/jpeg'),
(501, 'l (23).jpg', 'image/jpeg'),
(502, 'l (24).jpg', 'image/jpeg'),
(503, 'l (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `name`) VALUES
(16, 'Faculty'),
(17, 'Server Room'),
(18, 'Com lab 1'),
(19, 'Com lab 2'),
(20, 'Com lab 3'),
(21, 'Com lab 4');

-- --------------------------------------------------------

--
-- Table structure for table `system`
--

CREATE TABLE `system` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system`
--

INSERT INTO `system` (`id`, `file_name`, `file_type`) VALUES
(2079, 'e (1).jpg', 'image/jpeg'),
(2080, 'e (2).jpg', 'image/jpeg'),
(2081, 'e (3).jpg', 'image/jpeg'),
(2082, 'e (4).jpg', 'image/jpeg'),
(2083, 'e (5).jpg', 'image/jpeg'),
(2084, 'e (6).jpg', 'image/jpeg'),
(2085, 'e (7).jpg', 'image/jpeg'),
(2086, 'e (8).jpg', 'image/jpeg'),
(2087, 'e (9).jpg', 'image/jpeg'),
(2088, 'e (10).jpg', 'image/jpeg'),
(2089, 'e (11).jpg', 'image/jpeg'),
(2090, 'e (12).jpg', 'image/jpeg'),
(2091, 'e (13).jpg', 'image/jpeg'),
(2092, 'e (14).jpg', 'image/jpeg'),
(2093, 'e (16).jpg', 'image/jpeg'),
(2094, 'e (15).jpg', 'image/jpeg'),
(2095, 'e (17).jpg', 'image/jpeg'),
(2096, 'e (18).jpg', 'image/jpeg'),
(2097, 'e (19).jpg', 'image/jpeg'),
(2098, 'e (20).jpg', 'image/jpeg'),
(2099, 'e (21).jpg', 'image/jpeg'),
(2100, 'e (22).jpg', 'image/jpeg'),
(2101, 'e (23).jpg', 'image/jpeg'),
(2102, 'e (24).jpg', 'image/jpeg'),
(2103, 'e (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `verification` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`, `verification`) VALUES
(1, 'Rizel Bracero', 'rizbracero@gmail.com', '47bd799abccadc42c88fa2caf7c5d7da94e35daa', 1, 'n7khs9o1.jpg', 1, '2024-09-12 19:17:50', '669f5190d2cf9'),
(47, 'Jennilee Deleon', 'Deleon.jennilee.27@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.jpg', 1, NULL, ''),
(48, 'Jupiter Desuyo', 'Jupiteracampadodesuyo@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.jpg', 1, NULL, ''),
(49, 'Rinalyn Desamparado', 'Desamparadoysuldy81@gmail.com', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.jpg', 1, '2024-09-12 18:46:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vgahdmi`
--

CREATE TABLE `vgahdmi` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vgahdmi`
--

INSERT INTO `vgahdmi` (`id`, `file_name`, `file_type`) VALUES
(1879, 'f (1).jpg', 'image/jpeg'),
(1880, 'f (2).jpg', 'image/jpeg'),
(1881, 'f (3).jpg', 'image/jpeg'),
(1882, 'f (4).jpg', 'image/jpeg'),
(1883, 'f (5).jpg', 'image/jpeg'),
(1884, 'f (6).jpg', 'image/jpeg'),
(1885, 'f (7).jpg', 'image/jpeg'),
(1886, 'f (8).jpg', 'image/jpeg'),
(1887, 'f (9).jpg', 'image/jpeg'),
(1888, 'f (10).jpg', 'image/jpeg'),
(1889, 'f (11).jpg', 'image/jpeg'),
(1890, 'f (12).jpg', 'image/jpeg'),
(1891, 'f (13).jpg', 'image/jpeg'),
(1892, 'f (14).jpg', 'image/jpeg'),
(1893, 'f (15).jpg', 'image/jpeg'),
(1894, 'f (16).jpg', 'image/jpeg'),
(1895, 'f (17).jpg', 'image/jpeg'),
(1896, 'f (18).jpg', 'image/jpeg'),
(1897, 'f (19).jpg', 'image/jpeg'),
(1898, 'f (20).jpg', 'image/jpeg'),
(1899, 'f (21).jpg', 'image/jpeg'),
(1900, 'f (22).jpg', 'image/jpeg'),
(1901, 'f (23).jpg', 'image/jpeg'),
(1902, 'f (24).jpg', 'image/jpeg'),
(1903, 'f (25).jpg', 'image/jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file_type` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `file_name`, `file_type`) VALUES
(279, 'm (1).jpg', 'image/jpeg'),
(280, 'm (2).jpg', 'image/jpeg'),
(281, 'm (3).jpg', 'image/jpeg'),
(282, 'm (4).jpg', 'image/jpeg'),
(283, 'm (5).jpg', 'image/jpeg'),
(284, 'm (6).jpg', 'image/jpeg'),
(285, 'm (7).jpg', 'image/jpeg'),
(286, 'm (8).jpg', 'image/jpeg'),
(287, 'm (9).jpg', 'image/jpeg'),
(288, 'm (10).jpg', 'image/jpeg'),
(289, 'm (11).jpg', 'image/jpeg'),
(290, 'm (12).jpg', 'image/jpeg'),
(291, 'm (13).jpg', 'image/jpeg'),
(292, 'm (14).jpg', 'image/jpeg'),
(293, 'm (15).jpg', 'image/jpeg'),
(294, 'm (16).jpg', 'image/jpeg'),
(295, 'm (17).jpg', 'image/jpeg'),
(296, 'm (18).jpg', 'image/jpeg'),
(297, 'm (19).jpg', 'image/jpeg'),
(298, 'm (20).jpg', 'image/jpeg'),
(299, 'm (21).jpg', 'image/jpeg'),
(300, 'm (22).jpg', 'image/jpeg'),
(301, 'm (23).jpg', 'image/jpeg'),
(302, 'm (24).jpg', 'image/jpeg'),
(303, 'm (25).jpg', 'image/jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chord1`
--
ALTER TABLE `chord1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chord2`
--
ALTER TABLE `chord2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `computer`
--
ALTER TABLE `computer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hddssdgb`
--
ALTER TABLE `hddssdgb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keyboard`
--
ALTER TABLE `keyboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mother`
--
ALTER TABLE `mother`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mouse`
--
ALTER TABLE `mouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_images`
--
ALTER TABLE `other_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power1`
--
ALTER TABLE `power1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `power2`
--
ALTER TABLE `power2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system`
--
ALTER TABLE `system`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- Indexes for table `vgahdmi`
--
ALTER TABLE `vgahdmi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `chord1`
--
ALTER TABLE `chord1`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1304;

--
-- AUTO_INCREMENT for table `chord2`
--
ALTER TABLE `chord2`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1104;

--
-- AUTO_INCREMENT for table `computer`
--
ALTER TABLE `computer`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2904;

--
-- AUTO_INCREMENT for table `cpu`
--
ALTER TABLE `cpu`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- AUTO_INCREMENT for table `hddssdgb`
--
ALTER TABLE `hddssdgb`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `keyboard`
--
ALTER TABLE `keyboard`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2504;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2704;

--
-- AUTO_INCREMENT for table `mother`
--
ALTER TABLE `mother`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=907;

--
-- AUTO_INCREMENT for table `mouse`
--
ALTER TABLE `mouse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2304;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `other_images`
--
ALTER TABLE `other_images`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `power1`
--
ALTER TABLE `power1`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1704;

--
-- AUTO_INCREMENT for table `power2`
--
ALTER TABLE `power2`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1504;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=626;

--
-- AUTO_INCREMENT for table `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=504;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `system`
--
ALTER TABLE `system`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2104;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vgahdmi`
--
ALTER TABLE `vgahdmi`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1904;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=304;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
