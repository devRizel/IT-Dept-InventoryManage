-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 06:19 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `other`
--

CREATE TABLE `other` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `media_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `donate` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dreceived` date DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `dreceived` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`, `verification`) VALUES
(1, 'Rizel Bracero', 'rizbracero@gmail.com', '2266fbea6565d14614ba4c0305ffe1e7f2779a4f', 1, '9v7xdeaw1.png', 1, '2024-07-20 00:17:34', '669a915cc4ec6');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1);

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
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `other`
--
ALTER TABLE `other`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `other`
--
ALTER TABLE `other`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=420;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
