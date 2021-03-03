-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2019 at 05:10 AM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.3.6

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
-- Table structure for table `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_reset`
--

INSERT INTO `password_reset` (`id`, `email`, `token`) VALUES
(2, 'ronieB03@gmail.com', '6b389637b76657e64c9047ae895acfbc706aea4046a70de6eb6482ad0667900b0305245b372f3c93520464a5c3dc5dcf8969');

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
(1, 'Einor', 'Niutib', 'ronieb03@gmail.com', 'ronie', 'user', 'img/default_profile.png'),
(2, 'Ronie', 'Bituin', 'ronie', 'ronie', 'user', 'img/default_profile.png'),
(3, 'Matthew', 'Mics', 'matt@gmail.com', 'ronie', 'user', 'img/default_profile.png'),
(4, 'Jeff', 'IsthatYou', 'jeff', 'jeff', 'user', 'img/default_profile.png'),
(5, 'Sample', 'User', 'user', 'user', 'user', 'img/assets/PhotoID-52019-10-06-10-10-34.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_links`
--

CREATE TABLE `user_links` (
  `id` int(11) NOT NULL,
  `from_user_id` int(12) NOT NULL,
  `to_user_id` int(12) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `linked` varchar(12) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_links`
--

INSERT INTO `user_links` (`id`, `from_user_id`, `to_user_id`, `date_added`, `linked`) VALUES
(30, 1, 2, '2019-09-22 16:38:13', 'true'),
(31, 2, 5, '2019-09-22 17:06:32', 'true'),
(32, 2, 3, '2019-09-22 17:07:23', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `user_posts`
--

CREATE TABLE `user_posts` (
  `id` int(11) NOT NULL,
  `user_id` varchar(12) DEFAULT NULL,
  `user_post` text DEFAULT NULL,
  `user_status` varchar(12) DEFAULT NULL,
  `user_long` text DEFAULT NULL,
  `user_lat` text DEFAULT NULL,
  `user_location` text DEFAULT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_posts`
--

INSERT INTO `user_posts` (`id`, `user_id`, `user_post`, `user_status`, `user_long`, `user_lat`, `user_location`, `date_added`) VALUES
(39, '2', 'I am safe no worry.', 'safe', '120.5503604', '15.1461778', 'Poinsettia Avenue, Angeles, Pampanga, Philippines', '2019-10-05 23:35:31'),
(40, '2', 'I am not safe. Help!', 'danger', '120.5503', '15.146534534', 'Poinsettia Avenue, Angeles, Pampanga, Philippines', '2019-10-05 23:36:08'),
(42, '2', 'asd', 'safe', '120.5504231', '15.146170699999999', 'Poinsettia Avenue, Angeles, Pampanga, Philippines', '2019-10-05 23:46:12'),
(47, '2', 'in danger', 'danger', '120.5504232', '15.146170699999999', 'Poinsettia Avenue, Angeles, Pampanga, Philippines', '2019-10-05 23:57:23'),
(49, '2', 'In Danger from profile', 'safe', '120.7120023', '15.4827722', 'Unnamed Road, La Paz, Tarlac, Philippines', '2019-10-06 00:09:19'),
(50, '5', 'I am safe', 'safe', '120.5504247', '15.146171599999999', 'Poinsettia Avenue, Angeles, Pampanga, Philippines', '2019-10-06 10:09:49'),
(51, '5', 'Help Im in danger', 'danger', '120.7120023', '15.4827722', 'Unnamed Road, La Paz, Tarlac, Philippines', '2019-10-06 10:31:09'),
(52, '5', 'Dont worry I am safe now', 'safe', '120.7120023', '15.4827722', 'Unnamed Road, La Paz, Tarlac, Philippines', '2019-10-06 10:31:33');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_links`
--
ALTER TABLE `user_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user_posts`
--
ALTER TABLE `user_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
