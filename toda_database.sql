-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 07:11 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toda_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `butaw`
--

CREATE TABLE `butaw` (
  `id` int(11) NOT NULL,
  `created` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `butaw`
--

INSERT INTO `butaw` (`id`, `created`, `price`) VALUES
(1, '2022-06-16', 232);

-- --------------------------------------------------------

--
-- Table structure for table `cashout_history`
--

CREATE TABLE `cashout_history` (
  `id` int(11) NOT NULL,
  `plate` text NOT NULL,
  `time_in` int(11) NOT NULL,
  `time_out` int(11) NOT NULL,
  `cashout` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cashout_history`
--

INSERT INTO `cashout_history` (`id`, `plate`, `time_in`, `time_out`, `cashout`) VALUES
(6, 'ME092767', 0, 0, 0),
(7, 'ME092767', 0, 0, 0),
(8, 'ME092767', 6, 6, 15),
(9, 'ME092767', 6, 6, 65);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `riders_id` int(11) NOT NULL,
  `ridername` text NOT NULL,
  `mark` text NOT NULL,
  `plate` text NOT NULL,
  `fee` int(11) NOT NULL,
  `destination` text NOT NULL,
  `qrtime` text NOT NULL,
  `created` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `passenger_id`, `username`, `riders_id`, `ridername`, `mark`, `plate`, `fee`, `destination`, `qrtime`, `created`) VALUES
(4, 9, 'billy', 10, '', 'old', '', 15, 'Floodway', '11:13:37', '22-06-03'),
(5, 9, 'billy', 10, '', 'old', '', 15, 'Floodway', '11:17:41', '22-06-03'),
(6, 9, 'billy', 10, '', 'old', '', 15, 'Floodway', '11:18:21', '22-06-03'),
(10, 9, 'billy', 10, '', 'old', '', 15, 'Floodway', '12:01:18', '22-06-04'),
(11, 9, 'billy', 10, '', 'old', '', 15, 'Floodway', '12:40:02', '22-06-04'),
(12, 9, 'billy', 10, '', 'old', '', 15, 'floodway', '12:47:31', '22-06-04'),
(13, 9, 'billy', 10, '', 'old', '', 15, 'floodway', '12:49:16', '22-06-04'),
(14, 9, 'billy', 10, '', 'old', '', 10, 'Floodway', '12:55:17', '22-06-04'),
(15, 9, 'billy', 10, '', 'old', '', 10, 'Floodway', '12:55:30', '22-06-04'),
(16, 9, 'billy', 10, '', 'old', '', 10, 'Floodway', '12:55:45', '22-06-04'),
(17, 9, 'billy', 10, '', 'old', '', 10, 'Floodway', '12:56:24', '22-06-04'),
(18, 9, 'billy', 10, '', 'old', '', 10, 'Floodway', '12:56:34', '22-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `load_history`
--

CREATE TABLE `load_history` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `cname` text NOT NULL,
  `reference` int(11) NOT NULL,
  `load_amount` int(11) NOT NULL,
  `request_load_status` text NOT NULL,
  `load_time` text NOT NULL,
  `load_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `load_history`
--

INSERT INTO `load_history` (`id`, `passenger_id`, `cname`, `reference`, `load_amount`, `request_load_status`, `load_time`, `load_date`) VALUES
(1, 9, 'billy', 64345, 12, 'active', '10:09:11', '22-06-04'),
(2, 9, 'billy', 1001001, 121, 'Loaded', '10:10:53', '22-06-04'),
(3, 9, 'billy', 123432, 100, 'Loaded', '10:13:07', '22-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `passenger_info`
--

CREATE TABLE `passenger_info` (
  `id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `balance` int(11) NOT NULL,
  `image_url` text NOT NULL,
  `destination` text NOT NULL,
  `fare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `passenger_info`
--

INSERT INTO `passenger_info` (`id`, `passenger_id`, `name`, `balance`, `image_url`, `destination`, `fare`) VALUES
(1, 4, 'ivan', 0, 'IMG-6299ea33f12b98.79896065.jpeg', '', 0),
(2, 9, 'billy', 310, 'IMG-6299ea33f12b98.79896065.jpeg', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` int(11) NOT NULL,
  `destination` text NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `destination`, `price`) VALUES
(1, 'dumagete', 20),
(2, 'leyte', 100),
(3, 'Floodway', 15);

-- --------------------------------------------------------

--
-- Table structure for table `rider_info`
--

CREATE TABLE `rider_info` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `riders_id` int(11) NOT NULL,
  `contact` int(11) NOT NULL,
  `address` text NOT NULL,
  `plate` text NOT NULL,
  `license` int(11) NOT NULL,
  `created` text NOT NULL,
  `storage` int(11) NOT NULL,
  `cashout_status` text NOT NULL,
  `image_url` text NOT NULL,
  `license_url` text NOT NULL,
  `verify_status` text NOT NULL,
  `time_in` text NOT NULL,
  `time_out` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rider_info`
--

INSERT INTO `rider_info` (`id`, `name`, `riders_id`, `contact`, `address`, `plate`, `license`, `created`, `storage`, `cashout_status`, `image_url`, `license_url`, `verify_status`, `time_in`, `time_out`) VALUES
(7, '', 8, 0, '', '', 0, '13', 0, '', '', '', '', '', ''),
(8, 'Erwin', 10, 917337278, 'batingan', 'ME092767', 13124, '13', 0, '', 'IMG-6299eec15c6604.47974594.jpg', 'IMG-6299eeb6a30d64.12069361.png', 'verified', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `role` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `code` int(11) NOT NULL,
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `role`, `email`, `password`, `code`, `status`) VALUES
(7, 'admin', 'admintoda@gmail.com', '$2y$10$eYagk.nSHCdJxBe/gJ3G..N1I64vmtegUpY5KdbYIRINuouAoDL8m', 0, 'verified'),
(8, '', '', '$2y$10$N21J9Ax4R1Jad3UOacycXufrku2QAcUbYGDU.zzarG0QQgnMTkiEG', 643581, 'notverified'),
(9, 'user', 'jismendiola05@gmail.com', '$2y$10$YemCiMtQUaztAGw3UMJQTecfbeSHipKI24.BOSoYbdeT541x8KuyC', 0, 'verified'),
(10, 'rider', 'atcommuter001@gmail.com', '$2y$10$Mn6swz.Om7leoVOuaw96CeYZH4g//GzuZjLQMyxQb9BE5RYjyJYtG', 0, 'verified');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `butaw`
--
ALTER TABLE `butaw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashout_history`
--
ALTER TABLE `cashout_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `load_history`
--
ALTER TABLE `load_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `passenger_info`
--
ALTER TABLE `passenger_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rider_info`
--
ALTER TABLE `rider_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `butaw`
--
ALTER TABLE `butaw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cashout_history`
--
ALTER TABLE `cashout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `load_history`
--
ALTER TABLE `load_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `passenger_info`
--
ALTER TABLE `passenger_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rider_info`
--
ALTER TABLE `rider_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
