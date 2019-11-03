-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2019 at 12:28 PM
-- Server version: 5.7.17-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loginadminuser`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(4) NOT NULL,
  `b_name` varchar(250) NOT NULL,
  `b_author` varchar(50) NOT NULL,
  `b_year` varchar(4) NOT NULL,
  `b_amount` int(6) NOT NULL,
  `type_id` int(4) NOT NULL,
  `b_price` int(6) NOT NULL,
  `b_img` varchar(20) NOT NULL,
  `p_view` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `b_name`, `b_author`, `b_year`, `b_amount`, `type_id`, `b_price`, `b_img`, `p_view`) VALUES
(2, 'รักวุ่นๆ เล่ม2', 'no name', '2562', 100, 2, 280, '2.gif', 8),
(5, 'รักวุ่นๆ เล่ม3', 'no name', '2562', 100, 2, 255, '5.gif', 12),
(8, 'อ่านอังกฤษ ก็สอบติดมหาลัยได้', 'no name', '2561', 100, 1, 250, '6.jpg', 12),
(9, 'ฝึกสมอง', 'no name', '2562', 100, 1, 250, '7.png', 8),
(10, 'ระบบปฐิบัติการ', 'no name', '2561', 100, 1, 280, '10.jpg', 2),
(11, 'ศัพท์คอมพิวเตอร์', 'no name', '2561', 150, 1, 280, '11.jpg', 8);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `type_id` int(4) NOT NULL,
  `type_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`type_id`, `type_name`) VALUES
(1, 'Knowledge Book'),
(2, 'Fiction Book');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `userlevel` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `userlevel`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Suchaya', 'Kunjaetong', 'a'),
(2, 'jimin', '535ab76633d94208236a2e829ea6d888', 'Jimin', 'Bangtanboy', 'm'),
(3, 'suchaya_poom', '674f3c2c1a8a6f90461e8a66fb5550ba', 'yuyuyu', 'uiuiuiu', 'm'),
(4, 'pum', '62a415ea2b60a33b87aa005cb9c4e9ff', 'pumpui', 'jm', 'm'),
(5, 'father', '46771d1f432b42343f56f791422a4991', 'มณเฑียร', 'กุญแจทอง', 'm'),
(7, 'Atitaya', 'e92d74ccacdc984afa0c517ad0d557a6', 'อทิตยา', 'ศรีพรหม', 'm'),
(10, 'Thitinan', '7fa8282ad93047a4d6fe6111c93b308a', 'มันแกว', 'คนไม่สวย', 'm'),
(11, 'Suchaya', '62a415ea2b60a33b87aa005cb9c4e9ff', 'Suchaya Ja', 'Kunjaetong', 'm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `type_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
