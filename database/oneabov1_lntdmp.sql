-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 06, 2019 at 09:58 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oneabov1_lntdmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`) VALUES
(11, 'ronieB03@gmail.com', '9e7e36871dfce54e6ade9d00b3691a8a914d343ce5c0fe2a1f6ed74179c929ef9b8d573e71efcca8fac5c7479580298f43e5'),
(10, 'ronieB03@gmail.com', 'eecff5b9425ea4c47cd1b1352f23cfb2dbc4a6a5693b128cf0869361e183ba7ad1746108655c057a5dbc0e56c50bc9a74102'),
(9, 'ronieB03@gmail.com', 'a77bac14f2a0cc441117bef27cc8365259ae09e1dbedbce10c9835f6efb013ea406797f5cc4c3619877a3588637e05109592');

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
  `level_access` varchar(128) NOT NULL DEFAULT 'user',
  `profile_image` varchar(128) NOT NULL DEFAULT 'img/default_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `level_access`, `profile_image`) VALUES
(1, 'User', 'Sample', 'usersample', 'usersample', 'user', 'img/default_profile.png'),
(2, 'Admin', 'Sample', 'admin', 'admin', 'user', 'img/assets/PhotoID-22019-10-07-08-44-21.jpg'),
(3, 'Matthew', 'Mics', 'matt@gmail.com', 'admin', 'user', 'img/default_profile.png'),
(4, 'Jeff', 'IsthatYou', 'jeff', 'jeff', 'user', 'img/default_profile.png'),
(5, 'Sample', 'User', 'user', 'user', 'user', 'img/assets/PhotoID-52019-10-07-08-42-51.png'),
(6, 'Agiela', 'Algassir ', 'akheala22@gmail.com', '123456789', 'user', 'img/default_profile.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id` int(11) NOT NULL,
  `from_user_id` int(12) NOT NULL,
  `to_user_id` int(12) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `linked` varchar(12) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_links`
--

INSERT INTO `user_links` (`id`, `from_user_id`, `to_user_id`, `date_added`, `linked`) VALUES
(30, 1, 2, '2019-09-22 16:38:13', 'true'),
(31, 2, 5, '2019-09-22 17:06:32', 'true'),
(32, 2, 3, '2019-09-22 17:07:23', 'false'),
(33, 5, 6, '2019-10-06 01:27:48', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) DEFAULT NULL,
  `user_post` text,
  `user_status` varchar(12) DEFAULT NULL,
  `user_long` text,
  `user_lat` text,
  `user_location` text,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `user_id`, `user_post`, `user_status`, `user_long`, `user_lat`, `user_location`, `date_added`) VALUES
(66, '2', 'I am safe here', 'safe', '120.59216300000001', '15.1585247', '4278 Mcarthur Hwy, Angeles, 2009 Pampanga, Philippines', '2019-10-06 19:57:07'),
(67, '2', 'I am in danger now', 'danger', '120.59220743741615', '15.1584308432583', '4278 Mcarthur Hwy, Angeles, 2009 Pampanga, Philippines', '2019-10-06 19:57:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
