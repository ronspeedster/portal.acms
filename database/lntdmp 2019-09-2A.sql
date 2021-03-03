-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 20, 2019 at 01:18 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lntdmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `firstname` varchar(128) NOT NULL,
  `lastname` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `level_access` varchar(128) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `level_access`) VALUES
(1, 'Einor', 'Niutib', 'ronieb03@gmail.com', 'ronie', 'user'),
(2, 'Ronie', 'Bituin', 'ronie', 'ronie', 'user'),
(3, 'Matthew', 'Mics', 'matt@gmail.com', 'ronie', 'user'),
(4, 'Jeff', 'IsthatYou', 'jeff', 'jeff', 'user'),
(5, 'Sample', 'User', 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id` int(11) NOT NULL,
  `from_user_id` int(12) NOT NULL,
  `to_user_id` int(12) NOT NULL,
  `linked` varchar(12) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_links`
--

INSERT INTO `user_links` (`id`, `from_user_id`, `to_user_id`, `linked`) VALUES
(17, 2, 5, 'false'),
(18, 2, 4, 'false'),
(19, 5, 4, 'false'),
(20, 5, 3, 'false'),
(21, 5, 1, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) DEFAULT NULL,
  `user_post` text DEFAULT NULL,
  `user_location` text DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `user_id`, `user_post`, `user_location`, `date_added`) VALUES
(20, '2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, '2019-09-20 15:13:20'),
(21, '2', 'On June 27, 1985 at Santa Isabel Building in Balibago, Angeles City, five person came together and formed Systems Plus Inc. (SPI). The primary purpose of forming this organization was to conduct seminars for those who were planning to enter the electronic data processing as programmers, encoders and system analysts.\r\n\r\nTutorial programs for students and professionals started at the institution in July 7, 1985. This date also served as the schools foundation day.\r\n\r\nIn subsequent years, Systems Plus Inc. saw increased enrollment. In June 1987, the institution started offering associate courses and later on, bachelors degree and graduate degree programs.\r\n\r\nThe growth of the school has been outstanding. Recent times has seen it open four campuses in Cubao, Caloocan City, San Fernando and in Miranda, Angeles City. ', NULL, '2019-09-20 15:14:20'),
(22, '2', 'On June 27, 1985 at Santa Isabel Building in Balibago, Angeles City, five person came together and formed Systems Plus Inc. (SPI). The primary purpose of forming this organization was to conduct seminars for those who were planning to enter the electronic data processing as programmers, encoders and system analysts. Tutorial programs for students and professionals started at the institution in July 7, 1985. This date also served as the schools foundation day. In subsequent years, Systems Plus Inc. saw increased enrollment. In June 1987, the institution started offering associate courses and later on, bachelors degree and graduate degree programs. The growth of the school has been outstanding. Recent times has seen it open four campuses in Cubao, Caloocan City, San Fernando and in Miranda, Angeles City. ', NULL, '2019-09-20 15:14:38'),
(23, '2', 'I now have the ability to post things', NULL, '2019-09-20 16:10:26'),
(24, '2', 'What happened?!', NULL, '2019-09-20 16:10:54'),
(25, '2', 'I now have the ability to post things. Like feeds :)', NULL, '2019-09-20 16:11:35'),
(26, '5', 'Sample User Created by me :)', NULL, '2019-09-20 16:13:19'),
(27, '2', 'Sample News Feed', NULL, '2019-09-20 19:05:44'),
(28, '2', 'Hello !!!!!! :', NULL, '2019-09-20 19:05:55'),
(29, '5', 'Hello!!!!', NULL, '2019-09-20 19:06:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_links`
--
ALTER TABLE `user_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_posts`
--
ALTER TABLE `user_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
