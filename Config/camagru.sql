-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 04, 2020 at 09:00 AM
-- Server version: 5.6.43
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camagru`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id_comment` int(6) UNSIGNED NOT NULL,
  `no_user` int(6) UNSIGNED DEFAULT NULL,
  `username` varchar(80) NOT NULL,
  `id_photo` int(6) UNSIGNED NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `like_photo`
--

CREATE TABLE `like_photo` (
  `id_photo` int(6) UNSIGNED DEFAULT NULL,
  `no_user` int(6) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id_photo` int(6) UNSIGNED NOT NULL,
  `no_user` int(6) UNSIGNED NOT NULL,
  `filename` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stickers`
--

CREATE TABLE `stickers` (
  `id_sticker` int(6) UNSIGNED NOT NULL,
  `sticker_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stickers`
--

INSERT INTO `stickers` (`id_sticker`, `sticker_name`) VALUES
(1, 'flower-1.png'),
(2, 'flower-2.png'),
(3, 'vintage-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `no` int(6) UNSIGNED NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(400) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '1',
  `verify_id` text NOT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `fgt_pwd_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`no`, `username`, `password`, `email`, `notification`, `verify_id`, `confirmed`, `fgt_pwd_time`) VALUES
(1, 'test123', '$2y$10$kU9RIp64GUyTQjJTcwKQ7emO8Ao7.hUMg9c2BbJprqk6.iqNgoI.a', 'arash.keymon@uuluu.org', 1, '11540595415e5fdbee9bf92', 1, '2020-03-04 17:48:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id_comment`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id_photo`);

--
-- Indexes for table `stickers`
--
ALTER TABLE `stickers`
  ADD PRIMARY KEY (`id_sticker`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id_comment` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id_photo` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stickers`
--
ALTER TABLE `stickers`
  MODIFY `id_sticker` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `no` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
