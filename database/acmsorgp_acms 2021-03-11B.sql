-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2021 at 10:19 AM
-- Server version: 10.2.36-MariaDB-cll-lve
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acmsorgp_acms`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `last_name`, `first_name`, `middle_name`) VALUES
(1, 'Dizon M.D', 'Michael', 'J.'),
(2, 'Manarang M.D', 'Maria Jesusa', 'S.'),
(3, 'Cordero M.D', 'Jocelyn ', 'T.'),
(4, 'Batac M.D', 'Angela', 'D.'),
(5, 'Patio M.D', 'Ericson Lloyd', 'A.'),
(6, 'Alfonso M.D', 'Gil', 'E.'),
(7, 'Garcia M.D', 'Emil Bryan', 'M.'),
(8, 'Ocampo M.D', 'Ann Mitzel', 'M.'),
(9, 'Ocampo M.D', 'Pius Jonas', 'F.'),
(10, 'Bondoc M.D', 'Faith Aureole', 'C.'),
(11, 'Gaddi M.D', 'Nathaniel', 'H.'),
(12, 'Labrador M.D', 'Myrna Grace', 'M.'),
(13, 'Roa M.D', 'Kristine', 'A.'),
(14, 'Tuazon M.D', 'Aldelfo', 'T.'),
(15, 'Rivera M.D', 'Heidi', 'B.');

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
-- Table structure for table `tally`
--

CREATE TABLE `tally` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tally`
--

INSERT INTO `tally` (`id`, `voter_id`, `candidate_id`) VALUES
(1, 221, 14),
(2, 221, 4),
(3, 221, 8),
(4, 221, 7),
(5, 221, 5),
(6, 221, 10),
(7, 221, 6),
(8, 221, 15),
(9, 221, 3),
(10, 221, 13),
(11, 221, 2),
(12, 221, 1),
(13, 221, 12),
(14, 221, 11),
(15, 221, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(12) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `middle_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `mailing_address` varchar(128) NOT NULL,
  `contact_num` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `birthday` date NOT NULL,
  `pma_number` varchar(128) NOT NULL,
  `prc_number` varchar(128) NOT NULL,
  `expiration_date` date NOT NULL,
  `field_of_practice` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `is_update` int(1) NOT NULL DEFAULT 0,
  `level_access` varchar(128) NOT NULL DEFAULT 'user',
  `profile_image` varchar(128) NOT NULL DEFAULT 'img/default_profile.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `mailing_address`, `contact_num`, `email`, `birthday`, `pma_number`, `prc_number`, `expiration_date`, `field_of_practice`, `username`, `password`, `is_update`, `level_access`, `profile_image`) VALUES
(1, 'Aris', '', 'Lopez', '', '', 'arislopez@gmail.com', '2021-03-07', '0', '0', '2021-03-07', '', 'arislopez@gmail.com', 'aris', 0, 'admin', 'img/default_profile.png'),
(2, 'RONIEeee', 'CALIGAGAN', 'BITUIN', '#066 BRGY. CUAYAN, ANGELES CITY', '+639270417431', 'ronieb03@gmail.com', '2021-03-07', '0', '0', '2021-04-01', 'Wala', 'ronie', 'ronie', 1, 'admin', 'img/default_profile.png'),
(3, 'ABAD, ANTONIO FRANCO MANUEL', '', '', '', '', '', '0000-00-00', '0', '0124047', '0000-00-00', '', '0124047', '4047', 0, 'user', 'img/default_profile.png'),
(4, 'ABREA, LETICIA ROSARIO', '', '', '', '', '', '0000-00-00', '0', '0058195', '0000-00-00', '', '0058195', '8195', 0, 'user', 'img/default_profile.png'),
(5, 'ABREA, REYNALDO TOLENTINO', '', '', '', '', '', '0000-00-00', '0', '0058196', '0000-00-00', '', '0058196', '8196', 0, 'user', 'img/default_profile.png'),
(6, ' AGUILAR, CHRISTOPHER C.', '', '', '', '', '', '2021-03-01', '', '0100553', '2021-03-02', '', '0100553', '0553', 0, 'user', 'img/default_profile.png'),
(7, 'ALBARRACIN-SIBAL, MARIGOLD I.', '', '', '', '', '', '2021-04-09', '', '0104200', '2021-03-07', '', '0104200', '4200', 0, 'user', 'img/default_profile.png'),
(8, 'ALFONSO, BEVERLY Q.', '', '', '', '', '', '2021-03-07', '', '0101822', '2021-03-07', '', '0101822', '1822', 0, 'user', 'img/default_profile.png'),
(9, 'ALVARADO, JOANNA MARIE AGUILAR', '', '', '', '', 'sample@email.com', '2021-03-07', 'PMA Number Here', '0135172', '2021-03-07', 'Sample Field of Practice', '0135172', '5172', 0, 'user', 'img/default_profile.png'),
(10, 'ALFONSO, CYNTHIA EDQUILAG', '', '', '', '', '', '2021-03-07', '', '0047123', '2021-03-07', '', '0047123', '7123', 0, 'user', 'img/default_profile.png'),
(11, 'ALFONSO, EDUARDO MALLARI', '', '', '', '', '', '2021-03-07', '', '0046841', '2021-03-07', '', '0046841', '6841', 0, 'user', 'img/default_profile.png'),
(12, 'Gil', 'Edquilag', 'Alfonso', 'Don Severino corner Don Angel, Citicenter Phase 1, Pandan, Angeles City', '09190968072', 'gilealfonso@gmail.com', '1979-09-15', 'C8-864', '0109383', '2022-09-15', 'Internal Medicine - Adult Cardiology', '0109383', 'Simonkiel10171!', 1, 'user', 'img/default_profile.png'),
(13, 'ALONZO, ANTONINA G.', '', '', '', '', '', '2021-03-07', '', '0032465', '2021-03-07', '', '0032465', '2465', 0, 'user', 'img/default_profile.png'),
(14, 'ANGELES, ANDREW L', '', '', '', '', '', '2021-03-07', '', '0082247', '2021-03-07', '', '0082247', '2247', 0, 'user', 'img/default_profile.png'),
(15, 'ANGELES, IVY G.', '', '', '', '', '', '2021-03-07', 'C-8-953-0113539', '0113539', '2021-03-07', '', '0113539', '3539', 0, 'user', 'img/default_profile.png'),
(16, 'ANGELES, MARY LYNN DUE', '', '', '', '', '', '2021-03-07', 'C-8-708-0092634', '0092634', '2021-03-07', '', '0092634', '2634', 0, 'user', 'img/default_profile.png'),
(17, 'ANGELES, RAYMUND T', '', '', '', '', '', '2021-03-07', '', '0076233', '2021-03-07', '', '0076233', '6233', 0, 'user', 'img/default_profile.png'),
(18, 'ANGELES, UNIKA LEAH C', '', '', '', '', '', '2021-03-07', '', '0082843', '2021-03-07', '', '0082843', '2843', 0, 'user', 'img/default_profile.png'),
(19, 'ANTONIO, MARK QUIZON', '', '', '', '', '', '2021-03-07', '', '0113840', '2021-03-07', '', '0113840', '3840', 0, 'user', 'img/default_profile.png'),
(20, 'Freddie', 'Catanghal ', 'Anunciacion ', '989 David St., Talimundok Phase 1, Dau, Mabalacat City, Pampanga ', '09223308360', 'dokfreddie62@yahoo.com', '1962-11-26', 'C 8- 403', '0068121', '2021-11-26', 'Family Medicine ', '0068121', 'Docfca8121', 1, 'user', 'img/default_profile.png'),
(21, ' AQUINO, MA. CLARA', '', '', '', '', '', '2021-03-07', '', '0061693', '2021-03-07', '', '0061693', '1693', 0, 'user', 'img/default_profile.png'),
(22, 'AQUINO, PRINCESS MAY PINEDA', '', '', '', '', '', '2021-03-07', '', '0105204', '2021-03-07', '', '0105204', '5204', 0, 'user', 'img/default_profile.png'),
(23, 'AQUINO, RALPH C', '', '', '', '', '', '2021-03-07', '', '0099368', '2021-03-07', '', '0099368', '9368', 0, 'user', 'img/default_profile.png'),
(24, 'ARAOS, CARLEEN NICOLE DELOS SANTOS', '', '', '', '', '', '2021-03-07', '', '0140203', '2021-03-07', '', '0140203', '0203', 0, 'user', 'img/default_profile.png'),
(25, 'ARAOS, CARLEEN NICOLE DELOS SANTOS', '', '', '', '', '', '2021-03-07', '', '0140203', '2021-03-07', '', '0140203', '0203', 0, 'user', 'img/default_profile.png'),
(26, 'ARCEBIDO, VIRGILIO CHITO G', '', '', '', '', '', '2021-03-07', '', '0075342', '2021-03-07', '', '0075342', '5342', 0, 'user', 'img/default_profile.png'),
(27, 'ARCEO, ED NABONG', '', '', '', '', '', '2021-03-07', '', '0068528', '2021-03-07', '', '0068528', '8528', 0, 'user', 'img/default_profile.png'),
(28, 'ARCEO, REBECCA NABONG', '', '', '', '', '', '2021-03-07', '', '0043941', '2021-03-07', '', '0043941', '3941', 0, 'user', 'img/default_profile.png'),
(29, 'ARCILLA, MATTHEW NARSING', '', '', '', '', '', '2021-03-07', '', '0142879', '2021-03-07', '', '0142879', '2879', 0, 'user', 'img/default_profile.png'),
(30, 'ARENAS, MIRIAM SUN', '', '', '', '', '', '2021-03-07', '', '0070034', '2021-03-07', '', '0070034', '0034', 0, 'user', 'img/default_profile.png'),
(31, 'AREVALO, MARITES AMISOLA', '', '', '', '', '', '2021-03-07', '', '0078315', '2021-03-07', '', '0078315', '8315', 0, 'user', 'img/default_profile.png'),
(32, 'AREVALO, ORESTES S', '', '', '', '', '', '2021-03-07', '', '0029186', '2021-03-07', '', '0029186', '9186', 0, 'user', 'img/default_profile.png'),
(33, 'AREVALO, JR, ORESTES CARSON', '', '', '', '', '', '2021-03-07', '', '0078363', '2021-03-07', '', '0078363', '8363', 0, 'user', 'img/default_profile.png'),
(34, 'ASTUDILLO, PAULITA PAMELA PANTIG', '', '', '', '', '', '2021-03-07', '', '0108767', '2021-03-07', '', '0108767', '8767', 0, 'user', 'img/default_profile.png'),
(35, 'ASTUDILLO, SIR EMMANUEL SOLLER', '', '', '', '', '', '2021-03-07', '', '0103187', '2021-03-07', '', '0103187', '3187', 0, 'user', 'img/default_profile.png'),
(36, 'ASUNCION, JENNIFER JOYCE E', '', '', '', '', '', '2021-03-07', '', '0098157', '2021-03-07', '', '0098157', '8157', 0, 'user', 'img/default_profile.png'),
(37, 'ASUNCION-ALVARADO, MARIA CIELO GARCIA', '', '', '', '', '', '2021-03-07', '', '0113878', '2021-03-07', '', '0113878', '3878', 0, 'user', 'img/default_profile.png'),
(38, 'ASUNCION-ALVARADO, MARIA CIELO GARCIA', '', '', '', '', '', '2021-03-07', '', '0113878', '2021-03-07', '', '0113878', '3878', 0, 'user', 'img/default_profile.png'),
(39, 'ATOY, IMMEE S', '', '', '', '', '', '2021-03-07', '', '0090889', '2021-03-07', '', '0090889', '0889', 0, 'user', 'img/default_profile.png'),
(40, 'AURELIO, OSCAR R', '', '', '', '', '', '2021-03-07', '', '0069394', '2021-03-07', '', '0069394', '9394', 0, 'user', 'img/default_profile.png'),
(41, 'AURELIO, STEPHEN R', '', '', '', '', '', '2021-03-07', '', '0108122', '2021-03-07', '', '0108122', '8122', 0, 'user', 'img/default_profile.png'),
(42, 'AVENIR, ERIN JEAN ALFONSO', '', '', '', '', '', '2021-03-07', '', '0143754', '2021-03-07', '', '0143754', '3754', 0, 'user', 'img/default_profile.png'),
(43, 'AYRO, AARON JOSEPH TAMAYO', '', '', '', '', '', '2021-03-07', '', '0143117', '2021-03-07', '', '0143117', '3117', 0, 'user', 'img/default_profile.png'),
(44, 'AYRO, JUANITO ARNEL Q', '', '', '', '', '', '2021-03-07', '', '0071021', '2021-03-07', '', '0071021', '1021', 0, 'user', 'img/default_profile.png'),
(45, 'AYRO, KATHRYNA LESLEY T', '', '', '', '', '', '2021-03-07', '', '0079384', '2021-03-07', '', '0079384', '9384', 0, 'user', 'img/default_profile.png'),
(46, 'AYSON, BENJAMIN TAN', '', '', '', '', '', '2021-03-07', '', '0062179', '2021-03-07', '', '0062179', '2179', 0, 'user', 'img/default_profile.png'),
(47, 'AYSON, DONNA MAE CRUZ', '', '', '', '', '', '2021-03-07', '', '0070033', '2021-03-07', '', '0070033', '0033', 0, 'user', 'img/default_profile.png'),
(48, 'AYSON, JOEL TAMAYO', '', '', '', '', '', '2021-03-07', '', '0062057', '2021-03-07', '', '0062057', '2057', 0, 'user', 'img/default_profile.png'),
(49, 'AYSON, MA LUCINA V', '', '', '', '', '', '2021-03-07', '', '0013205', '2021-03-07', '', '0013205', '3205', 0, 'user', 'img/default_profile.png'),
(50, 'Nelson', 'Manaloto', 'Ayson', '25-17 camelia st. Timog Park Subdivision, Angeles City', '+639209627029', 'nma922013@yahoo.com', '1967-08-28', 'C-8-601', '0084164', '2023-08-28', 'General Surgery', '0084164', 'AlexaRafaboy@3112021', 1, 'user', 'img/assets/PhotoID-50-2021-03-11-07-00-28.jpeg'),
(51, 'AYUYAO, LUCIELLE F', '', '', '', '', '', '2021-03-07', '', '0043273', '2021-03-07', '', '0043273', '3273', 0, 'user', 'img/default_profile.png'),
(52, 'AYUYAO, NILO FERNANDEZ', '', '', '', '', '', '2021-03-07', '', '0096175', '2021-03-07', '', '0096175', '6175', 0, 'user', 'img/default_profile.png'),
(53, 'BACUD, DONITA D', 'Dominguez', 'Bacud', '#55 purok 2, Camachiles, Mabalacat City, Pampanga', '09175108565', 'donitabacud@yahoo.com', '1967-05-11', 'C-8-468', '0080323', '2021-05-11', 'Ob-gyne', '0080323', 'dane1993', 1, 'user', 'img/default_profile.png'),
(54, 'BADIOLA, JENNYLIN C', '', '', '', '', '', '2021-03-07', '', ' 0061936', '2021-03-07', '', ' 0061936', '1936', 0, 'user', 'img/default_profile.png'),
(55, 'BADIOLA, ROLANDO ESCOBAR', '', '', '', '', '', '2021-03-07', '', ' 0060907', '2021-03-07', '', ' 0060907', '0907', 0, 'user', 'img/default_profile.png'),
(56, 'BAGASAN, KHEREN VICTORIANO', '', '', '', '', '', '2021-03-07', '', ' 0122090', '2021-03-07', '', ' 0122090', '2090', 0, 'user', 'img/default_profile.png'),
(57, 'BAKER-VILLARIN, CATHERINE BUENA', '', '', '', '', '', '2021-03-07', '', ' 0113577', '2021-03-07', '', ' 0113577', '3577', 0, 'user', 'img/default_profile.png'),
(58, 'BAKIL, LUZONIA R', '', '', '', '', '', '2021-03-07', '', ' 0025629', '2021-03-07', '', ' 0025629', '5629', 0, 'user', 'img/default_profile.png'),
(59, 'BALAJADIA, EDWIN B', '', '', '', '', '', '2021-03-07', '', ' 0090877', '2021-03-07', '', ' 0090877', '0877', 0, 'user', 'img/default_profile.png'),
(60, 'BALBIN, NICOLAS B', '', '', '', '', '', '2021-03-07', '', '0016585', '2021-03-07', '', '0016585', '6585', 0, 'user', 'img/default_profile.png'),
(61, 'BALGAN, CYNTHIA AYSON', '', '', '', '', '', '2021-03-07', '', ' 0095463', '2021-03-07', '', ' 0095463', '5463', 0, 'user', 'img/default_profile.png'),
(62, 'BALGAN, HANS CHRISTIAN A', '', '', '', '', '', '2021-03-07', '', ' 0101757', '2021-03-07', '', ' 0101757', '1757', 0, 'user', 'img/default_profile.png'),
(63, 'BALISA, NELSON JUNE B', '', '', '', '', '', '2021-03-07', '', '0084265', '2021-03-07', '', '0084265', '4265', 0, 'user', 'img/default_profile.png'),
(64, 'BALUYUT, ABEL DIZON', '', '', '', '', '', '2021-03-07', '', '0083283', '2021-03-07', '', '0083283', '3283', 0, 'user', 'img/default_profile.png'),
(65, 'BALUYUT, LORELIE NAGRAMPA', '', '', '', '', '', '2021-03-07', '', '0091955', '2021-03-07', '', '0091955', '1955', 0, 'user', 'img/default_profile.png'),
(66, 'BANSIL, PAUL ANTHONY ESPIRITU', '', '', '', '', '', '2021-03-07', '', '0124064', '2021-03-07', '', '0124064', '4064', 0, 'user', 'img/default_profile.png'),
(67, 'BAQUIRAN, MERLYN', '', '', '', '', '', '2021-03-07', '', '0052917', '2021-03-07', '', '0052917', '2917', 0, 'user', 'img/default_profile.png'),
(68, 'BARON, ESMERALDA BUCU', '', '', '', '', '', '2021-03-07', '', ' 0096291', '2021-03-07', '', ' 0096291', '6291', 0, 'user', 'img/default_profile.png'),
(69, 'BARRO, RAMSEY JAMES S', '', '', '', '', '', '2021-03-07', '', '0089914', '2021-03-07', '', '0089914', '9914', 0, 'user', 'img/default_profile.png'),
(70, 'BARTOLOME, MARCELINA VIVIAN TUAZON', '', '', '', '', '', '2021-03-07', '', ' 0064364', '2021-03-07', '', ' 0064364', '4364', 0, 'user', 'img/default_profile.png'),
(71, 'BASA, AGAPITO MENDOZA', '', '', '', '', '', '2021-03-07', '', '0047851', '2021-03-07', '', '0047851', '7851', 0, 'user', 'img/default_profile.png'),
(72, 'BASA-LACSON, CHRISTINE R', '', '', '', '', '', '2021-03-07', '', '0096286', '2021-03-07', '', '0096286', '6286', 0, 'user', 'img/default_profile.png'),
(73, 'BASILIO-VERGARA, ANNABELLE', '', '', '', '', '', '2021-03-07', '', '0071984', '2021-03-07', '', '0071984', '1984', 0, 'user', 'img/default_profile.png'),
(74, 'BATAC, ANGELA DY', '', '', '', '', '', '2021-03-07', '', '0096687', '2021-03-07', '', '0096687', '6687', 0, 'user', 'img/default_profile.png'),
(75, 'BATHAN, LYNDON L', '', '', '', '', '', '2021-03-07', '', '0094105', '2021-03-07', '', '0094105', '4105', 0, 'user', 'img/default_profile.png'),
(76, 'BAUTISTA, EUTIQUIANO (ETTY) V', '', '', '', '', '', '2021-03-07', '', '0024976', '2021-03-07', '', '0024976', '4976', 0, 'user', 'img/default_profile.png'),
(77, 'BAUTISTA, EXPEDITO A', '', '', '', '', '', '2021-03-07', '', '0070691', '2021-03-07', '', '0070691', '0691', 0, 'user', 'img/default_profile.png'),
(78, 'BAUTISTA, MARIA PAZ IRENE LUCIDO', '', '', '', '', '', '2021-03-07', '', '0086214', '2021-03-07', '', '0086214', '6214', 0, 'user', 'img/default_profile.png'),
(79, 'BAUTISTA, NINES P', '', '', '', '', '', '2021-03-07', '', ' 0086211', '2021-03-07', '', ' 0086211', '6211', 0, 'user', 'img/default_profile.png'),
(80, 'BAYUBAY, MARIA EMILIA DEOGRACIAS TAALA', '', '', '', '', '', '2021-03-07', '', '0097970', '2021-03-07', '', '0097970', '7970', 0, 'user', 'img/default_profile.png'),
(81, 'BEJAR, JUDITH BENJAMINA D', '', '', '', '', '', '2021-03-07', '', ' 0071824', '2021-03-07', '', ' 0071824', '1824', 0, 'user', 'img/default_profile.png'),
(82, 'ROBERTO-ARIEL', 'TEMPONGKO', 'BELMONTE', '2057 GEN. AQUINO ST., BGY STA. TERESITA, ANGELES CITY', '09175101109', 'drbobph@yahoo.com', '1960-11-09', 'C-8-448', '0063987', '2030-12-05', 'RADIOLOGY', '0063987', 'robbie1109', 1, 'user', 'img/default_profile.png'),
(83, 'BERNABE, RUSSELL F', '', '', '', '', '', '2021-03-07', '', '0078233', '2021-03-07', '', '0078233', '8233', 0, 'user', 'img/default_profile.png'),
(84, 'BIAG, LAURO DELA CRUZ', '', '', '', '', '', '2021-03-07', '', '0078582', '2021-03-07', '', '0078582', '8582', 0, 'user', 'img/default_profile.png'),
(85, 'BISPO, KAREN MAE G', '', '', '', '', '', '2021-03-07', '', '0122393', '2021-03-07', '', '0122393', '2393', 0, 'user', 'img/default_profile.png'),
(86, 'BITUIN, LOURDES REMEDIOS DIZON', '', '', '', '', '', '2021-03-07', '', '0061829', '2021-03-07', '', '0061829', '1829', 0, 'user', 'img/default_profile.png'),
(87, 'BOGNOT, RONA RONQUILLO', '', '', '', '', '', '2021-03-07', '', '0124209', '2021-03-07', '', '0124209', '4209', 0, 'user', 'img/default_profile.png'),
(88, 'Alvin', 'Caisip', 'Bondoc', '882 San Jose st San ignacio phase 1,Pandan rd', '00175120095', 'bondocalvin236@yahoo.com', '1979-05-26', '05261979', '0106989', '2023-05-27', 'Family medicine', '0106989', 'sacchaROSE49', 1, 'user', 'img/default_profile.png'),
(89, 'BONDOC, EDGARDO MALLARI', '', '', '', '', '', '2021-03-07', '', '0053116', '2021-03-07', '', '0053116', '3116', 0, 'user', 'img/default_profile.png'),
(90, 'BONDOC, FAITH AUREOLE C', '', '', '', '', '', '2021-03-07', '', '0107118', '2021-03-07', '', '0107118', '7118', 0, 'user', 'img/default_profile.png'),
(91, 'BONDOC, LUNEIDA MENDOZA', '', '', '', '', '', '2021-03-07', '', '0143174', '2021-03-07', '', '0143174', '3174', 0, 'user', 'img/default_profile.png'),
(92, 'BONDOC-DIAZ, MARY GRACE PAMINTUAN', '', '', '', '', '', '2021-03-07', '', '0108393', '2021-03-07', '', '0108393', '8393', 0, 'user', 'img/default_profile.png'),
(93, 'BRANZUELA, SONNY', '', '', '', '', '', '2021-03-07', '', '0100378', '2021-03-07', '', '0100378', '0378', 0, 'user', 'img/default_profile.png'),
(94, 'BUCANEG, NENETTE NACPIL', '', '', '', '', '', '2021-03-07', '', '0088247', '2021-03-07', '', '0088247', '8247', 0, 'user', 'img/default_profile.png'),
(95, 'BUENCAMINO, EDUARDO FELIPE T', '', '', '', '', '', '2021-03-07', '', '0046961', '2021-03-07', '', '0046961', '6961', 0, 'user', 'img/default_profile.png'),
(96, 'BUENDIA, BENLOR C', '', '', '', '', '', '2021-03-07', '', '0101932', '2021-03-07', '', '0101932', '1932', 0, 'user', 'img/default_profile.png'),
(97, 'BUENDIA, MIA D', '', '', '', '', '', '2021-03-07', '', '0100162', '2021-03-07', '', '0100162', '0162', 0, 'user', 'img/default_profile.png'),
(98, 'BUHAYO, BERNADETTE S', '', '', '', '', '', '2021-03-07', '', '0070583', '2021-03-07', '', '0070583', '0583', 0, 'user', 'img/default_profile.png'),
(99, 'BULATAO, RENNETTE T', '', '', '', '', '', '2021-03-07', '', '0069905', '2021-03-07', '', '0069905', '9905', 0, 'user', 'img/default_profile.png'),
(100, 'BUNQUE, HENRY B', '', '', '', '', '', '2021-03-07', '', '0105601', '2021-03-07', '', '0105601', '5601', 0, 'user', 'img/default_profile.png'),
(101, 'BUSTOS, MEDIATRIX SUNGA', '', '', '', '', '', '2021-03-07', '', '0045760', '2021-03-07', '', '0045760', '5760', 0, 'user', 'img/default_profile.png'),
(102, 'CABANTOG, JOSEPH DE CASTRO', '', '', '', '', '', '2021-03-07', '', '0102792', '2021-03-07', '', '0102792', '2792', 0, 'user', 'img/default_profile.png'),
(103, 'CABILANGAN, ALONA PERVIAN N', '', '', '', '', '', '2021-03-07', '', '0077169', '2021-03-07', '', '0077169', '7169', 0, 'user', 'img/default_profile.png'),
(104, 'CALADIAO, CAMILLE C', '', '', '', '', '', '2021-03-07', '', '0119595', '2021-03-07', '', '0119595', '9595', 0, 'user', 'img/default_profile.png'),
(105, 'CALAGUAS, EDWIN LACSON', '', '', '', '', '', '2021-03-07', '', '0056590', '2021-03-07', '', '0056590', '6590', 0, 'user', 'img/default_profile.png'),
(106, 'Tristan Angelo', 'Macasa', 'Calaquian', '82-22 DoÃ±a Aurora St.', '09088628103', 'tamcalaquian2014@gmail.com', '2021-07-30', 'C-8-1042-0130803', '0130803', '2021-07-30', 'General Medicine, Occupational Medicine, Medical Education', '0130803', 'Konstantinou@#$%331', 1, 'user', 'img/default_profile.png'),
(107, 'CALMA, DIANNE BEVERLY D', '', '', '', '', '', '2021-03-07', '', '0122039', '2021-03-07', '', '0122039', '2039', 0, 'user', 'img/default_profile.png'),
(108, 'CALMA, JUDEL R', '', '', '', '', '', '2021-03-07', '', '0096771', '2021-03-07', '', '0096771', '6771', 0, 'user', 'img/default_profile.png'),
(109, 'CALMA-GALANG, TERESITA ARNIE C', '', '', '', '', '', '2021-03-07', '', '0070157', '2021-03-07', '', '0070157', '0157', 0, 'user', 'img/default_profile.png'),
(110, 'CAMPO, JANELLE AQUINO', '', '', '', '', '', '2021-03-07', '', '0101016', '2021-03-07', '', '0101016', '1016', 0, 'user', 'img/default_profile.png'),
(111, 'CANAG, ANA MAE CAMARINO', '', '', '', '', '', '2021-03-07', '', '0118055', '2021-03-07', '', '0118055', '8055', 0, 'user', 'img/default_profile.png'),
(112, 'CANIVEL, DAPHNE L', '', '', '', '', '', '2021-03-07', '', '0093146', '2021-03-07', '', '0093146', '3146', 0, 'user', 'img/default_profile.png'),
(113, 'CANLAS, FRANCIS ADRIAN ANGELES', '', '', '', '', '', '2021-03-07', '', '0126059', '2021-03-07', '', '0126059', '6059', 0, 'user', 'img/default_profile.png'),
(114, 'CANLAS, FROILAN A', '', '', '', '', '', '2021-03-07', '', '0082498', '2021-03-07', '', '0082498', '2498', 0, 'user', 'img/default_profile.png'),
(115, 'CANLAS, NENITA TAN', '', '', '', '', '', '2021-03-07', '', '0058172', '2021-03-07', '0058172', '0058172', '8172', 0, 'user', 'img/default_profile.png'),
(116, 'CANLAS, RAUL N', '', '', '', '', '', '2021-03-07', '', '0086676', '2021-03-07', '', '0086676', '6676', 0, 'user', 'img/default_profile.png'),
(117, 'CANLAS, SARRIE JOYCE CUPINO', '', '', '', '', '', '2021-03-07', '', '0116313', '2021-03-07', '', '0116313', '6313', 0, 'user', 'img/default_profile.png'),
(118, 'CANONO, GERTRUDES SORIANO', '', '', '', '', '', '2021-03-07', '', '0027077', '2021-03-07', '', '0027077', '7077', 0, 'user', 'img/default_profile.png'),
(119, 'CANONO, JOSE ANTONIO S', '', '', '', '', '', '2021-03-07', '', '0089913', '2021-03-07', '', '0089913', '9913', 0, 'user', 'img/default_profile.png'),
(120, 'CANONO, RAYZEN VENTINILLA', '', '', '', '', '', '2021-03-07', '', '0118567', '2021-03-07', '', '0118567', '8567', 0, 'user', 'img/default_profile.png'),
(121, 'CAPILI, NINO M', '', '', '', '', '', '2021-03-07', '', '0110082', '2021-03-07', '', '0110082', '0082', 0, 'user', 'img/default_profile.png'),
(122, 'CAPULONG, AIDA C', '', '', '', '', '', '2021-03-07', '', '0073288', '2021-03-07', '', '0073288', '3288', 0, 'user', 'img/default_profile.png'),
(123, 'CARA, ELMA ESPINOSA', '', '', '', '', '', '2021-03-07', '', '0051069', '2021-03-07', '', '0051069', '1069', 0, 'user', 'img/default_profile.png'),
(124, 'CARANTO, NOMAR TAMAYO', '', '', '', '', '', '2021-03-07', '', '0123059', '2021-03-07', '', '0123059', '3059', 0, 'user', 'img/default_profile.png'),
(125, 'CARINO, DIOSDADO QUITEVIS', '', '', '', '', '', '2021-03-07', '', '0087259', '2021-03-07', '', '0087259', '7259', 0, 'user', 'img/default_profile.png'),
(126, 'CARLOS, MARCELA DIANALYNN SAZON', '', '', '', '', '', '2021-03-07', '', '0079478', '2021-03-07', '', '0079478', '9478', 0, 'user', 'img/default_profile.png'),
(127, 'CARREON, CARLO RODRIGO S', '', '', '', '', '', '2021-03-07', '', '0097584', '2021-03-07', '', '0097584', '7584', 0, 'user', 'img/default_profile.png'),
(128, 'CARREON, MARIA JESUSA GUINTU', '', '', '', '', '', '2021-03-07', '', '0085802', '2021-03-07', '', '0085802', '5802', 0, 'user', 'img/default_profile.png'),
(129, 'CASINO, DOMINGO REGINO B', '', '', '', '', '', '2021-03-07', '', '0085878', '2021-03-07', '', '0085878', '5878', 0, 'user', 'img/default_profile.png'),
(130, 'CASTRO, ESTRELLA TENGCO', '', '', '', '', '', '2021-03-07', '', '0093190', '2021-03-07', '', '0093190', '3190', 0, 'user', 'img/default_profile.png'),
(131, 'CASTRO, RUTH YBAY', '', '', '', '', '', '2021-03-07', '', '0075939', '2021-03-07', '', '0075939', '5939', 0, 'user', 'img/default_profile.png'),
(132, 'CASTRO, ZENAIDA RAQUEPO', '', '', '', '', '', '2021-03-07', '', '0015870', '2021-03-07', '', '0015870', '5870', 0, 'user', 'img/default_profile.png'),
(133, 'CATUNGAL, MARIZEL MALLARI', '', '', '', '', '', '2021-03-07', '', '0083706', '2021-03-07', '', '0083706', '3706', 0, 'user', 'img/default_profile.png'),
(134, 'CAYLAN, PAZ DELOS CIENTOS', '', '', '', '', '', '2021-03-07', '', '0036370', '2021-03-07', '', '0036370', '6370', 0, 'user', 'img/default_profile.png'),
(135, 'CAYLO, CARLO ZALDY ROMERO', '', '', '', '', '', '2021-03-07', '', '0142937', '2021-03-07', '', '0142937', '2937', 0, 'user', 'img/default_profile.png'),
(136, 'CHAN, FRANCIS T', '', '', '', '', '', '2021-03-07', '', '0098857', '2021-03-07', '', '0098857', '8857', 0, 'user', 'img/default_profile.png'),
(137, 'CHAN, NATHANIEL PIONELA', '', '', '', '', '', '2021-03-07', '', '0093219', '2021-03-07', '', '0093219', '3219', 0, 'user', 'img/default_profile.png'),
(138, 'CHAVARIA, RICARDO BUCU', '', '', '', '', '', '2021-03-07', '', '0064635', '2021-03-07', '', '0064635', '4635', 0, 'user', 'img/default_profile.png'),
(139, 'CHUA, IMELDA SANTOS', '', '', '', '', '', '2021-03-07', '', '0090166', '2021-03-07', '', '0090166', '0166', 0, 'user', 'img/default_profile.png'),
(140, 'CHUA, JOCEL L', '', '', '', '', '', '2021-03-07', '', '0097654', '2021-03-07', '', '0097654', '7654', 0, 'user', 'img/default_profile.png'),
(141, 'CHUA, MICHAEL HERBERT P', '', '', '', '', '', '2021-03-07', '', '0086027', '2021-03-07', '', '0086027', '6027', 0, 'user', 'img/default_profile.png'),
(142, 'CHUA, NANETTE S', '', '', '', '', '', '2021-03-07', '', '0108684', '2021-03-07', '', '0108684', '8684', 0, 'user', 'img/default_profile.png'),
(143, 'CHUA, NOEL S', '', '', '', '', '', '2021-03-07', '', '0105678', '2021-03-07', '', '0105678', '5678', 0, 'user', 'img/default_profile.png'),
(144, 'CHUIDIAN, CZARINNA TENORIO', '', '', '', '', '', '2021-03-07', '', '0112253', '2021-03-07', '', '0112253', '2253', 0, 'user', 'img/default_profile.png'),
(145, 'CLAVIO, JOSEPH AARON C', '', '', '', '', '', '2021-03-07', '', '0091484', '2021-03-07', '', '0091484', '1484', 0, 'user', 'img/default_profile.png'),
(146, 'CONTRERAS, ARMAND P', '', '', '', '', '', '2021-03-07', '', '0082772', '2021-03-07', '', '0082772', '2772', 0, 'user', 'img/default_profile.png'),
(147, 'CORDERO, JOCELYN TOLENTINO', '', '', '', '', '', '2021-03-07', '', '0078806', '2021-03-07', '', '0078806', '8806', 0, 'user', 'img/default_profile.png'),
(148, 'CORONEL, PANCHO FRANCISCO S', '', '', '', '', '', '2021-03-07', '', '0083922', '2021-03-07', '', '0083922', '3922', 0, 'user', 'img/default_profile.png'),
(149, 'CORPUZ, BERLETTE G', '', '', '', '', '', '2021-03-07', '', '0098315', '2021-03-07', '', '0098315', '8315', 0, 'user', 'img/default_profile.png'),
(150, 'CORPUZ, FATIMA ANNE CARANGUIAN', '', '', '', '', '', '2021-03-07', '', '0144059', '2021-03-07', '', '0144059', '4059', 0, 'user', 'img/default_profile.png'),
(151, 'CORTEZ, IVAN SMITH BAUTISTA', '', '', '', '', '', '2021-03-07', '', '0138117', '2021-03-07', '', '0138117', '8117', 0, 'user', 'img/default_profile.png'),
(152, 'CRISOSTOMO, EDGAR CHYRUSS DE GUZMAN', '', '', '', '', '', '2021-03-07', '', '0146923', '2021-03-07', '', '0146923', '6923', 0, 'user', 'img/default_profile.png'),
(153, 'CRUZ, ALETH S', '', '', '', '', '', '2021-03-07', '', '0130781', '2021-03-07', '', '0130781', '0781', 0, 'user', 'img/default_profile.png'),
(154, 'CRUZ, DANIEL P', '', '', '', '', '', '2021-03-07', '', '0063516', '2021-03-07', '', '0063516', '3516', 0, 'user', 'img/default_profile.png'),
(155, 'CRUZ, EILEEN GOMEZ', '', '', '', '', '', '2021-03-07', '', '0087871', '2021-03-07', '', '0087871', '7871', 0, 'user', 'img/default_profile.png'),
(156, 'CRUZ, ISID JASON L', '', '', '', '', '', '2021-03-07', '', '0120568', '2021-03-07', '', '0120568', '0568', 0, 'user', 'img/default_profile.png'),
(157, 'CRUZ, IVY DIANE CORTEZ', '', '', '', '', '', '2021-03-07', '', '0115036', '2021-03-07', '', '0115036', '5036', 0, 'user', 'img/default_profile.png'),
(158, 'CRUZ, JAY TUBIG', '', '', '', '', '', '2021-03-07', '', '0096321', '2021-03-07', '', '0096321', '6321', 0, 'user', 'img/default_profile.png'),
(159, 'CRUZ, MISAEL C', '', '', '', '', '', '2021-03-07', '', '0083284', '2021-03-07', '', '0083284', '3284', 0, 'user', 'img/default_profile.png'),
(160, 'CRUZ, PATRICIA ALMARIO', '', '', '', '', '', '2021-03-07', '', '0105837', '2021-03-07', '', '0105837', '5837', 0, 'user', 'img/default_profile.png'),
(161, 'CRUZ, RINA PAMINTUAN', '', '', '', '', '', '2021-03-07', '', '0084171', '2021-03-07', '', '0084171', '4171', 0, 'user', 'img/default_profile.png'),
(162, 'CUNANAN, CYRINE ALMARIO', '', '', '', '', '', '2021-03-07', '', '0137169', '2021-03-07', '', '0137169', '7169', 0, 'user', 'img/default_profile.png'),
(163, 'CUNANAN, DANIELLA PATTINE DIZON', '', '', '', '', '', '2021-03-07', '', '0147856', '2021-03-07', '', '0147856', '7856', 0, 'user', 'img/default_profile.png'),
(164, 'CUNANAN, JIM KIRBY PUNO', '', '', '', '', '', '2021-03-07', '', '0142756', '2021-03-07', '', '0142756', '2756', 0, 'user', 'img/default_profile.png'),
(165, 'DABU, ADELINA V', '', '', '', '', '', '2021-03-07', '', '0039704', '2021-03-07', '', '0039704', '9704', 0, 'user', 'img/default_profile.png'),
(166, 'DABU, DARNEL V', '', '', '', '', '', '2021-03-07', '', '0094550', '2021-03-07', '', '0094550', '4550', 0, 'user', 'img/default_profile.png'),
(167, 'DAILEG, ILDEFONSO', '', '', '', '', '', '2021-03-07', '', '0073475', '2021-03-07', '', '0073475', '3475', 0, 'user', 'img/default_profile.png'),
(168, 'DANAC, EMERITA CRISTOBAL', '', '', '', '', '', '2021-03-07', '', '0083847', '2021-03-07', '', '0083847', '3847', 0, 'user', 'img/default_profile.png'),
(169, 'DATU, NATHANIEL R', '', '', '', '', '', '2021-03-07', '', '0098639', '2021-03-07', '', '0098639', '8639', 0, 'user', 'img/default_profile.png'),
(170, 'DAVID, DARDANI C', '', '', '', '', '', '2021-03-07', '', '0025871', '2021-03-07', '', '0025871', '5871', 0, 'user', 'img/default_profile.png'),
(171, 'DAVID, DOLORES', '', '', '', '', '', '2021-03-07', '', '0081013', '2021-03-07', '', '0081013', '1013', 0, 'user', 'img/default_profile.png'),
(172, 'DAVID, GIRLIE LU', '', '', '', '', '', '2021-03-07', '', '0111195', '2021-03-07', '', '0111195', '1195', 0, 'user', 'img/default_profile.png'),
(173, 'Harold', 'Juico', 'David', '1433 Ipil St, L and S Subd, Sto. Domingo, Angeles City', '09189426810', 'haroldjdavid21@yahoo.com', '1970-02-21', 'C -8-542', '0089080', '2022-02-21', 'Pediatrics', '0089080', 'Pediatrics02211970', 1, 'user', 'img/assets/PhotoID-173-2021-03-10-22-26-18.jpeg'),
(174, 'DAVID, MA CECILIA NIERVA', '', '', '', '', '', '2021-03-07', '', '0084185', '2021-03-07', '', '0084185', '4185', 0, 'user', 'img/default_profile.png'),
(175, 'DAVID, MA LOURDES LIMJOCO', '', '', '', '', '', '2021-03-07', '', '0057543', '2021-03-07', '', '0057543', '7543', 0, 'user', 'img/default_profile.png'),
(176, 'DAVID, MAURA LORNA TORRES', '', '', '', '', '', '2021-03-07', '', '0083720', '2021-03-07', '', '0083720', '3720', 0, 'user', 'img/default_profile.png'),
(177, 'DAVID, PAOLO LIMJOCO', '', '', '', '', '', '2021-03-07', '', '0127507', '2021-03-07', '', '0127507', '7507', 0, 'user', 'img/default_profile.png'),
(178, 'DAVID, PATRICK LIMJOCO', '', '', '', '', '', '2021-03-07', '', '0136667', '2021-03-07', '', '0136667', '6667', 0, 'user', 'img/default_profile.png'),
(179, 'DAVID, RICO JOSE MANUEL B', '', '', '', '', '', '2021-03-07', '', '0118578', '2021-03-07', '', '0118578', '8578', 0, 'user', 'img/default_profile.png'),
(180, 'DAVID, ROMERICO C', '', '', '', '', '', '2021-03-07', '', '0055466', '2021-03-07', '', '0055466', '5466', 0, 'user', 'img/default_profile.png'),
(181, 'DAVID, JR, RESTITUTO DUENAS', '', '', '', '', '', '2021-03-07', '', '0057925', '2021-03-07', '', '0057925', '7925', 0, 'user', 'img/default_profile.png'),
(182, 'DAYRIT, ALAIN G', '', '', '', '', '', '2021-03-07', '', '0086390', '2021-03-07', '', '0086390', '6390', 0, 'user', 'img/default_profile.png'),
(183, 'DAYRIT-CANETE, LIBERTY L', '', '', '', '', '', '2021-03-07', '', '0096855', '2021-03-07', '', '0096855', '6855', 0, 'user', 'img/default_profile.png'),
(184, 'Arnold', 'Santos', 'De Guzman', '2-6 Sunset Drive, Carmenville Subdivision', '09088744111', 'noldmd@yahoo.com', '1973-10-07', 'C8839', '0096282', '2023-10-20', 'IM/Cardio', '0096282', 'asawako1223', 1, 'user', 'img/default_profile.png'),
(185, 'DE GUZMAN, JA MARIE GARCIA', '', '', '', '', '', '2021-03-07', '', '0139366', '2021-03-07', '', '0139366', '9366', 0, 'user', 'img/default_profile.png'),
(186, 'DE GUZMAN, JAE-JEGVINNE R', '', '', '', '', '', '2021-03-07', '', '0107988', '2021-03-07', '', '0107988', '7988', 0, 'user', 'img/default_profile.png'),
(187, 'DE GUZMAN, LEAH PAMINTUAN', '', '', '', '', '', '2021-03-07', '', '0100811', '2021-03-07', '', '0100811', '0811', 0, 'user', 'img/default_profile.png'),
(188, 'DE GUZMAN, LIZA', '', '', '', '', '', '2021-03-07', '', '0068234', '2021-03-07', '', '0068234', '8234', 0, 'user', 'img/default_profile.png'),
(189, 'DE GUZMAN, WILNER REINEL M', '', '', '', '', '', '2021-03-07', '', '0081312', '2021-03-07', '', '0081312', '1312', 0, 'user', 'img/default_profile.png'),
(190, 'DE LARA, APOLONIO H', '', '', '', '', '', '2021-03-07', '', '0036986', '2021-03-07', '', '0036986', '6986', 0, 'user', 'img/default_profile.png'),
(191, 'DE LARA, KRISTIAN ALEXIS HERRERA', '', '', '', '', '', '2021-03-07', '', '0124687', '2021-03-07', '', '0124687', '4687', 0, 'user', 'img/default_profile.png'),
(192, 'DEALA, ESTRELLA B', '', '', '', '', '', '2021-03-07', '', '0063973', '2021-03-07', '', '0063973', '3973', 0, 'user', 'img/default_profile.png'),
(193, 'DEANG, EMMANUEL T', '', '', '', '', '', '2021-03-07', '', '0066030', '2021-03-07', '', '0066030', '6030', 0, 'user', 'img/default_profile.png'),
(194, 'DEANG, RICARDO PAULO A', '', '', '', '', '', '2021-03-07', '', '0083164', '2021-03-07', '', '0083164', '3164', 0, 'user', 'img/default_profile.png'),
(195, 'DEL CASTILLO, MARIA MONINA ANNE FLORES', '', '', '', '', '', '2021-03-07', '', '0112226', '2021-03-07', '', '0112226', '2226', 0, 'user', 'img/default_profile.png'),
(196, 'DELA CRUZ, JUNCES PACHECO', '', '', '', '', '', '2021-03-07', '', '0117554', '2021-03-07', '', '0117554', '7554', 0, 'user', 'img/default_profile.png'),
(197, 'DELA CRUZ, LADY FRANCE GUTIERREZ', '', '', '', '', '', '2021-03-07', '', '0129459', '2021-03-07', '', '0129459', '9459', 0, 'user', 'img/default_profile.png'),
(198, 'DELA CRUZ, MA PAULA RAISA L', '', '', '', '', '', '2021-03-07', '', '0120715', '2021-03-07', '', '0120715', '0715', 0, 'user', 'img/default_profile.png'),
(199, 'DELA CRUZ, MELCHOR S', '', '', '', '', '', '2021-03-07', '', '0068061', '2021-03-07', '', '0068061', '8061', 0, 'user', 'img/default_profile.png'),
(200, 'DELA CRUZ, MICHAEL JAMES B', '', '', '', '', '', '2021-03-07', '', '0109650', '2021-03-07', '', '0109650', '9650', 0, 'user', 'img/default_profile.png'),
(201, 'DELA CRUZ, VILMA BONDOC', '', '', '', '', '', '2021-03-07', '', '0046951', '2021-03-07', '', '0046951', '6951', 0, 'user', 'img/default_profile.png'),
(202, 'DELA TORRE, ROMULO CRUZ', '', '', '', '', '', '2021-03-07', '', '0045593', '2021-03-07', '', '0045593', '5593', 0, 'user', 'img/default_profile.png'),
(203, 'DIAZ, JULIETA V', '', '', '', '', '', '2021-03-07', '', '0087417', '2021-03-07', '', '0087417', '7417', 0, 'user', 'img/default_profile.png'),
(204, 'DIAZ, ROY MANALO', '', '', '', '', '', '2021-03-07', '', '0080249', '2021-03-07', '', '0080249', '0249', 0, 'user', 'img/default_profile.png'),
(205, 'DIAZ-DAYRIT, ZARRAH VIDA S', '', '', '', '', '', '2021-03-07', '', '0105818', '2021-03-07', '', '0105818', '5818', 0, 'user', 'img/default_profile.png'),
(206, 'DIMABUYU, MARIA JEAN AVY GAMBOA', '', '', '', '', '', '2021-03-07', '', '0124690', '2021-03-07', '', '0124690', '4690', 0, 'user', 'img/default_profile.png'),
(207, 'DIONISIO, EMMA PULIDO', '', '', '', '', '', '2021-03-07', '', '0076980', '2021-03-07', '', '0076980', '6980', 0, 'user', 'img/default_profile.png'),
(208, 'DIRECTO, MARIBETH A', '', '', '', '', '', '2021-03-07', '', '0087006', '2021-03-07', '', '0087006', '7006', 0, 'user', 'img/default_profile.png'),
(209, 'DIZON, ALFRED PETER JUSTINE EUFEMIO', '', '', '', '', '', '2021-03-07', '', '0125149', '2021-03-07', '', '0125149', '5149', 0, 'user', 'img/default_profile.png'),
(210, 'DIZON, ANTONIO DE GUZMAN', '', '', '', '', '', '2021-03-07', '', '0050326', '2021-03-07', '', '0050326', '0326', 0, 'user', 'img/default_profile.png'),
(211, 'DEN LOWELL ', 'LOPEZ ', 'DIZON ', 'Blk 1 lot 21 Buena Vista subd. Sta. Maria, Mabalacat City', '09178260260', 'den_den_dizon@yahoo.com', '1973-03-18', 'C-8-614', '0092353', '2023-03-18', 'General Surgery ', '0092353', 'docdenden', 1, 'user', 'img/assets/PhotoID-211-2021-03-11-10-33-15.jpeg'),
(212, 'DIZON, FLORENCIO C', '', '', '', '', '', '2021-03-07', '', '0055598', '2021-03-07', '', '0055598', '5598', 0, 'user', 'img/default_profile.png'),
(213, 'DIZON, HERIBERTO', '', '', '', '', '', '2021-03-07', '', '0064465', '2021-03-07', '', '0064465', '4465', 0, 'user', 'img/default_profile.png'),
(214, 'DIZON, JENNIFER LAGMAN', '', '', '', '', '', '2021-03-07', '', '0136011', '2021-03-07', '', '0136011', '6011', 0, 'user', 'img/default_profile.png'),
(215, 'DIZON, MARIA RAMONA THERESA A', '', '', '', '', '', '2021-03-07', '', '0092090', '2021-03-07', '', '0092090', '2090', 0, 'user', 'img/default_profile.png'),
(216, 'MICHAEL', 'JEFFREY', 'DIZON', '38-02 Erlinda Lane, Sunset Estates, Angeles City 2009', '09175034991', 'mjdizonmd@yahoo.com', '1984-02-04', 'C-8-862-0119635', '0119635', '2023-02-04', 'Occupational Medicine', '0119635', '11963511011', 1, 'admin', 'img/default_profile.png'),
(217, 'DIZON, REBECCA ROSARIO', '', '', '', '', '', '2021-03-07', '', '0058192', '2021-03-07', '', '0058192', '8192', 0, 'user', 'img/default_profile.png'),
(218, 'DIZON, REYNALDO CABIGTING', '', '', '', '', '', '2021-03-07', '', '0053199', '2021-03-07', '', '0053199', '3199', 0, 'user', 'img/default_profile.png'),
(219, 'DIZON, RUBEN ONG', '', '', '', '', '', '2021-03-07', '', '0077306', '2021-03-07', '', '0077306', '7306', 0, 'user', 'img/default_profile.png'),
(220, 'DIZON, WALTER OMAR R', '', '', '', '', '', '2021-03-07', '', '0083679', '2021-03-07', '', '0083679', '3679', 0, 'user', 'img/default_profile.png'),
(221, 'WILHELMINA ', 'TANHUECO', 'DIZON-ALFONSO ', '1210 del Pilar Street Purok Panday Pira Dau Mabalacat City ', '09175100810 ', 'helmydizon@yahoo.com', '1964-08-10', 'C-8-377', '0071894', '2023-08-10', 'Family Medicine ', '0071894', 'alfonso0071894', 1, 'user', 'img/default_profile.png'),
(222, 'DOBLES, MARIA CLEMENCITA DAYRIT', '', '', '', '', '', '2021-03-07', '', '0080309', '2021-03-07', '', '0080309', '0309', 0, 'user', 'img/default_profile.png'),
(223, 'DOMDOM, REMAR LOPEZ', '', '', '', '', '', '2021-03-07', '', '0130446', '2021-03-07', '', '0130446', '0446', 0, 'user', 'img/default_profile.png'),
(224, 'DUCUSIN, CHERRY BLESILDA D', '', '', '', '', '', '2021-03-07', '', '0129585', '2021-03-07', '', '0129585', '9585', 0, 'user', 'img/default_profile.png'),
(225, 'DUEÃ‘AS, MANILEN E', '', '', '', '', '', '2021-03-07', '', '0122833', '2021-03-07', '', '0122833', '2833', 0, 'user', 'img/default_profile.png'),
(226, 'DUMAS, ERMA JEAN ESGUERRA', '', '', '', '', '', '2021-03-07', '', '0120606', '2021-03-07', '', '0120606', '0606', 0, 'user', 'img/default_profile.png'),
(227, 'DUNGCA, LEONARDO MIRANDA', '', '', '', '', '', '2021-03-07', '', '0053203', '2021-03-07', '', '0053203', '3203', 0, 'user', 'img/default_profile.png'),
(228, 'DUNGCA, RODEL G', '', '', '', '', '', '2021-03-07', '', '0070690', '2021-03-07', '', '0070690', '0690', 0, 'user', 'img/default_profile.png'),
(229, 'DUNGCA, VANESSA AUDREY PINEDA', '', '', '', '', '', '2021-03-07', '', '0138241', '2021-03-07', '', '0138241', '8241', 0, 'user', 'img/default_profile.png'),
(230, 'DUNGCA-ARRIBE, CARMIE P', '', '', '', '', '', '2021-03-07', '', '0102844', '2021-03-07', '', '0102844', '2844', 0, 'user', 'img/default_profile.png'),
(231, 'DUQUE, ALEX G', '', '', '', '', '', '2021-03-07', '', '0083237', '2021-03-07', '', '0083237', '3237', 0, 'user', 'img/default_profile.png'),
(232, 'DUYA, ABIGAIL DE LEON', '', '', '', '', '', '2021-03-07', '', '0134223', '2021-03-07', '', '0134223', '4223', 0, 'user', 'img/default_profile.png'),
(233, 'DUYA, JOSE EDUARDO DE LEON', '', '', '', '', '', '2021-03-07', '', '0118803', '2021-03-07', '', '0118803', '8803', 0, 'user', 'img/default_profile.png'),
(234, 'DYCHINGCO, CRISLE ONG', '', '', '', '', '', '2021-03-07', '', '0095987', '2021-03-07', '', '0095987', '5987', 0, 'user', 'img/default_profile.png'),
(235, 'DYCHIOCO, JOSELITO T', '', '', '', '', '', '2021-03-07', '', '0056788', '2021-03-07', '', '0056788', '6788', 0, 'user', 'img/default_profile.png'),
(236, 'DYCHIOCO, MA TERESA S', '', '', '', '', '', '2021-03-07', '', '0060969', '2021-03-07', '', '0060969', '0969', 0, 'user', 'img/default_profile.png'),
(237, 'ENCARNACION, THANG CHING LEE CHU', '', '', '', '', '', '2021-03-07', '', '0102053', '2021-03-07', '', '0102053', '2053', 0, 'user', 'img/default_profile.png'),
(238, 'ENRIQUEZ, ANGELO MARTIN FRANCO', '', '', '', '', '', '2021-03-07', '', '0149043', '2021-03-07', '', '0149043', '9043', 0, 'user', 'img/default_profile.png'),
(239, 'ENRIQUEZ, ARIEL DAVID', '', '', '', '', '', '2021-03-07', '', '0107153', '2021-03-07', '', '0107153', '7153', 0, 'user', 'img/default_profile.png'),
(240, 'ENRIQUEZ, CLARE ANGELI GUINTO', '', '', '', '', '', '2021-03-07', '', '0130837', '2021-03-07', '', '0130837', '0837', 0, 'user', 'img/default_profile.png'),
(241, 'ENRIQUEZ, GRACE GUINTO', '', '', '', '', '', '2021-03-07', '', '0057085', '2021-03-07', '', '0057085', '7085', 0, 'user', 'img/default_profile.png'),
(242, 'ENRIQUEZ, ROMEO YU', '', '', '', '', '', '2021-03-07', '', '0056678', '2021-03-07', '', '0056678', '6678', 0, 'user', 'img/default_profile.png'),
(243, 'ENRIQUEZ, SHERWIN JAE G', '', '', '', '', '', '2021-03-07', '', '0135030', '2021-03-07', '', '0135030', '5030', 0, 'user', 'img/default_profile.png'),
(244, 'ESCOBAR, TOMAS M', '', '', '', '', '', '2021-03-07', '', '0040613', '2021-03-07', '', '0040613', '0613', 0, 'user', 'img/default_profile.png'),
(245, 'ESGUERRA, TERESITA ALFONSO', '', '', '', '', '', '2021-03-07', '', '0045407', '2021-03-07', '', '0045407', '5407', 0, 'user', 'img/default_profile.png'),
(246, 'ESPANTA, JOSIAH JOMA M', '', '', '', '', '', '2021-03-07', '', '0092352', '2021-03-07', '', '0092352', '2352', 0, 'user', 'img/default_profile.png'),
(247, 'ESPIRITU, NERESITO TIAMSON', '', '', '', '', '', '2021-03-07', '', '0083914', '2021-03-07', '', '0083914', '3914', 0, 'user', 'img/default_profile.png'),
(248, 'ESPIRITU, JR, NESTOR TIAMSON', '', '', '', '', '', '2021-03-07', '', '0066324', '2021-03-07', '', '0066324', '6324', 0, 'user', 'img/default_profile.png'),
(249, 'ESTRADA, FRANCIS GERARD M', '', '', '', '', '', '2021-03-07', '', '0093033', '2021-03-07', '', '0093033', '3033', 0, 'user', 'img/default_profile.png'),
(250, 'EULALIA, REMEDIOS GARCIA', '', '', '', '', '', '2021-03-07', '', '0124890', '2021-03-07', '', '0124890', '4890', 0, 'user', 'img/default_profile.png'),
(251, 'FAJARDO, ALEXTER JOHN C', '', '', '', '', '', '2021-03-07', '', '0116066', '2021-03-07', '', '0116066', '6066', 0, 'user', 'img/default_profile.png'),
(252, 'FAUSTO, ERLYNE MARIA R', '', '', '', '', '', '2021-03-07', '', '0075709', '2021-03-07', '', '0075709', '5709', 0, 'user', 'img/default_profile.png'),
(253, 'FELICIANO, BEATRIZ ANGELICA GOMEZ', '', '', '', '', '', '2021-03-07', '', '0143197', '2021-03-07', '', '0143197', '3197', 0, 'user', 'img/default_profile.png'),
(254, 'FELICIANO, CAROLINE I', '', '', '', '', '', '2021-03-07', '', '0111196', '2021-03-07', '', '0111196', '1196', 0, 'user', 'img/default_profile.png'),
(255, 'FELICIANO, JOEL IBE', '', '', '', '', '', '2021-03-07', '', '0122282', '2021-03-07', '', '0122282', '2282', 0, 'user', 'img/default_profile.png'),
(256, 'FELICIANO, LARA VANESSA ESTRADA', '', '', '', '', '', '2021-03-07', '', '0103267', '2021-03-07', '', '0103267', '3267', 0, 'user', 'img/default_profile.png'),
(257, 'FELICIANO, ORGIE I', '', '', '', '', '', '2021-03-07', '', '0110215', '2021-03-07', '', '0110215', '0215', 0, 'user', 'img/default_profile.png'),
(258, 'FELICIANO-RIVERA, CHRISTINE MICLAT', '', '', '', '', '', '2021-03-07', '', '0104441', '2021-03-07', '', '0104441', '4441', 0, 'user', 'img/default_profile.png'),
(259, 'FERNANDEZ, JR, ARTURO M', '', '', '', '', '', '2021-03-07', '', '0094134', '2021-03-07', '', '0094134', '4134', 0, 'user', 'img/default_profile.png'),
(260, 'FERNANDO, MARCELO DANAN', '', '', '', '', '', '2021-03-07', '', '0033176', '2021-03-07', '', '0033176', '3176', 0, 'user', 'img/default_profile.png'),
(261, 'FILOTEO, LORETA D', '', '', '', '', '', '2021-03-07', '', '0081118', '2021-03-07', '', '0081118', '1118', 0, 'user', 'img/default_profile.png'),
(262, 'FLORES, ALAIN JESUS P', '', '', '', '', '', '2021-03-07', '', '0082006', '2021-03-07', '', '0082006', '2006', 0, 'user', 'img/default_profile.png'),
(263, 'FLORES, JOSEPHINE GOMEZ', '', '', '', '', '', '2021-03-07', '', '0080287', '2021-03-07', '', '0080287', '0287', 0, 'user', 'img/default_profile.png'),
(264, 'FLORES, ROBERT C', '', '', '', '', '', '2021-03-07', '', '0095641', '2021-03-07', '', '0095641', '5641', 0, 'user', 'img/default_profile.png'),
(265, 'FRANCISCO, EDGARDO Z', '', '', '', '', '', '2021-03-07', '', '0043292', '2021-03-07', '', '0043292', '3292', 0, 'user', 'img/default_profile.png'),
(266, 'FRANCO, MELODY BONDOC', '', '', '', '', '', '2021-03-07', '', '0097414', '2021-03-07', '', '0097414', '7414', 0, 'user', 'img/default_profile.png'),
(267, 'FRIGILLANA, MELIZA PEMPENGCO', '', '', '', '', '', '2021-03-07', '', '0098790', '2021-03-07', '', '0098790', '8790', 0, 'user', 'img/default_profile.png'),
(268, 'GADDI, NATHANIEL H', '', '', '', '', '', '2021-03-07', '', '0095306', '2021-03-07', '', '0095306', '5306', 0, 'user', 'img/default_profile.png'),
(269, 'GAGUI, GINA ESGUERRA', '', '', '', '', '', '2021-03-07', '', '0059238', '2021-03-07', '', '0059238', '9238', 0, 'user', 'img/default_profile.png'),
(270, 'GALANG, ANNALUZ DEANG', '', '', '', '', '', '2021-03-07', '', '0081010', '2021-03-07', '', '0081010', '1010', 0, 'user', 'img/default_profile.png'),
(271, 'GALANG, SHAENA GAYLE SARMIENTO', '', '', '', '', '', '2021-03-07', '', '0127751', '2021-03-07', '', '0127751', '7751', 0, 'user', 'img/default_profile.png'),
(272, 'GALICIA, MARLYN', '', '', '', '', '', '2021-03-07', '', '0127541', '2021-03-07', '', '0127541', '7541', 0, 'user', 'img/default_profile.png'),
(273, 'GALURA, ENRIQUE', '', '', '', '', '', '2021-03-07', '', '0042058', '2021-03-07', '', '0042058', '2058', 0, 'user', 'img/default_profile.png'),
(274, 'GALURA, RACHEL P', '', '', '', '', '', '2021-03-07', '', '0082115', '2021-03-07', '', '0082115', '2115', 0, 'user', 'img/default_profile.png'),
(275, 'GANA, ARNOLD C', '', '', '', '', '', '2021-03-07', '', '0099081', '2021-03-07', '', '0099081', '9081', 0, 'user', 'img/default_profile.png'),
(276, 'GARCIA, ANNABEL SANGUYU', '', '', '', '', '', '2021-03-07', '', '0095227', '2021-03-07', '', '0095227', '5227', 0, 'user', 'img/default_profile.png'),
(277, 'GARCIA, EMIL BRYAN M', '', '', '', '', '', '2021-03-07', '', '0099979', '2021-03-07', '', '0099979', '9979', 0, 'user', 'img/default_profile.png'),
(278, 'GARCIA, LORENA MALACASTE', '', '', '', '', '', '2021-03-07', '', '0098687', '2021-03-07', '', '0098687', '8687', 0, 'user', 'img/default_profile.png'),
(279, 'GARCIA, MA CLARITA', '', '', '', '', '', '2021-03-07', '', '0098677', '2021-03-07', '', '0098677', '8677', 0, 'user', 'img/default_profile.png'),
(280, 'GARCIA, MARIZA DEL ROSARIO', '', '', '', '', '', '2021-03-07', '', '0047592', '2021-03-07', '', '0047592', '7592', 0, 'user', 'img/default_profile.png'),
(281, 'GARCIA, PERLA T', '', '', '', '', '', '2021-03-07', '', '0078123', '2021-03-07', '', '0078123', '8123', 0, 'user', 'img/default_profile.png'),
(282, 'GARCIA, SALVADOR R', '', '', '', '', '', '2021-03-07', '', '0069823', '2021-03-07', '', '0069823', '9823', 0, 'user', 'img/default_profile.png'),
(283, 'GARCIA, SHYLA L', '', '', '', '', '', '2021-03-07', '', '0100134', '2021-03-07', '', '0100134', '0134', 0, 'user', 'img/default_profile.png'),
(284, 'GARCIA, VERMIE L', '', '', '', '', '', '2021-03-07', '', '0103263', '2021-03-07', '', '0103263', '3263', 0, 'user', 'img/default_profile.png'),
(285, 'GARCIA, JR, ALEJANDRO LAHOZ', '', '', '', '', '', '2021-03-07', '', '0103411', '2021-03-07', '', '0103411', '3411', 0, 'user', 'img/default_profile.png'),
(286, 'GAVIOLA-PEREGRINO, ROSALYN MANANKIL', '', '', '', '', '', '2021-03-07', '', '0110996', '2021-03-07', '', '0110996', '0996', 0, 'user', 'img/default_profile.png'),
(287, 'GAY-YA-PIONELA, CRISSA MARIE ARIOLA', '', '', '', '', '', '2021-03-07', '', '0113964', '2021-03-07', '', '0113964', '3964', 0, 'user', 'img/default_profile.png'),
(288, 'GO, MICHELLE DAGDAG', '', '', '', '', '', '2021-03-07', '', '0111672', '2021-03-07', '', '0111672', '1672', 0, 'user', 'img/default_profile.png'),
(289, 'GODISAN, ROSALIE', '', '', '', '', '', '2021-03-07', '', '0073890', '2021-03-07', '', '0073890', '3890', 0, 'user', 'img/default_profile.png'),
(290, 'GOINGCO, RENEAH N', '', '', '', '', '', '2021-03-07', '', '0096853', '2021-03-07', '', '0096853', '6853', 0, 'user', 'img/default_profile.png'),
(291, 'Harold Michael', 'Pangan', 'Gomez', '24-22 Ma victoria rd, essel park, csf pampanga', '09188233321', 'drgomez_aufsom@yahoo.com', '1970-09-07', 'c-8-649', '0085486', '2021-09-25', 'rheumatology', '0085486', 'P@ssw0rd', 1, 'user', 'img/default_profile.png'),
(292, 'GOMEZ, IRMINA LACSINA', '', '', '', '', '', '2021-03-07', '', '0111327', '2021-03-07', '', '0111327', '1327', 0, 'user', 'img/default_profile.png'),
(293, 'GOMEZ, KAREN JOYCE D', '', '', '', '', '', '2021-03-07', '', '0134222', '2021-03-07', '', '0134222', '4222', 0, 'user', 'img/default_profile.png'),
(294, 'GOMEZ, MARY GRACE ANGELICA S', '', '', '', '', '', '2021-03-07', '', '0134222', '2021-03-07', '', '0118564', '8564', 0, 'user', 'img/default_profile.png'),
(295, 'GOMEZ, NELSON D', '', '', '', '', '', '2021-03-07', '', '0064190', '2021-03-07', '', '0064190', '4190', 0, 'user', 'img/default_profile.png'),
(296, 'GOMEZ, OLIVERT G', '', '', '', '', '', '2021-03-07', '', '0089611', '2021-03-07', '', '0089611', '9611', 0, 'user', 'img/default_profile.png'),
(297, 'GOMEZ, TRACY CANLAS', '', '', '', '', '', '2021-03-07', '', '0135278', '2021-03-07', '', '0135278', '5278', 0, 'user', 'img/default_profile.png'),
(298, 'GOMEZ, WILLIAM FRANCIS PANGAN', '', '', '', '', '', '2021-03-07', '', '0101638', '2021-03-07', '', '0101638', '1638', 0, 'user', 'img/default_profile.png'),
(299, 'GONDA, MAEDA J', '', '', '', '', '', '2021-03-07', '', '0102337', '2021-03-07', '', '0102337', '2337', 0, 'user', 'img/default_profile.png'),
(300, 'GONZALES, JENNIFER OLALIA', '', '', '', '', '', '2021-03-07', '', '0091014', '2021-03-07', '', '0091014', '1014', 0, 'user', 'img/default_profile.png'),
(301, 'CATHERINE', 'ZAPANTA ', 'GONZALEZ', '238 Manibaug Libutad Porac, Pampanga 2008', '+ 840385720205', 'czg_gomez@yahoo.com', '1985-03-12', '0118572', '0118572', '2022-03-12', 'General Practice', '0118572', '118572Md', 1, 'user', 'img/assets/PhotoID-301-2021-03-10-23-27-48.jpeg'),
(302, 'GOPEZ, ARMANDO LIM', '', '', '', '', '', '2021-03-07', '', '0024218', '2021-03-07', '', '0024218', '4218', 0, 'user', 'img/default_profile.png'),
(303, 'GOZUM, BRYAN CANLAS', '', '', '', '', '', '2021-03-07', '', '0142855', '2021-03-07', '', '0142855', '2855', 0, 'user', 'img/default_profile.png'),
(304, 'GUALBERTO, CHARLEMAGNE H', '', '', '', '', '', '2021-03-07', '', '0095724', '2021-03-07', '', '0095724', '5724', 0, 'user', 'img/default_profile.png'),
(305, 'GUECO, CYNTHIA GOMEZ', '', '', '', '', '', '2021-03-07', '', '0098852', '2021-03-07', '', '0098852', '8852', 0, 'user', 'img/default_profile.png'),
(306, 'GUECO, GEMALYN PINEDA', '', '', '', '', '', '2021-03-07', '', '0106838', '2021-03-07', '', '0106838', '6838', 0, 'user', 'img/default_profile.png'),
(307, 'GUERZON, RONEL VINCENT LOZANO', '', '', '', '', '', '2021-03-07', '', '0130005', '2021-03-07', '', '0130005', '0005', 0, 'user', 'img/default_profile.png'),
(308, 'GUEVARRA, JOSEPH L', '', '', '', '', '', '2021-03-07', '', '0104224', '2021-03-07', '', '0104224', '4224', 0, 'user', 'img/default_profile.png');
INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `mailing_address`, `contact_num`, `email`, `birthday`, `pma_number`, `prc_number`, `expiration_date`, `field_of_practice`, `username`, `password`, `is_update`, `level_access`, `profile_image`) VALUES
(309, 'GUEVARRA, JUSTINE CARLO GARCIA', '', '', '', '', '', '2021-03-07', '', '0147811', '2021-03-07', '', '0147811', '7811', 0, 'user', 'img/default_profile.png'),
(310, 'GUEVARRA, PRINCESS', '', '', '', '', '', '2021-03-07', '', '0118748', '2021-03-07', '', '0118748', '8748', 0, 'user', 'img/default_profile.png'),
(311, 'GUIAO, FRANCISCO PURI', '', '', '', '', '', '2021-03-07', '', '0095308', '2021-03-07', '', '0095308', '5308', 0, 'user', 'img/default_profile.png'),
(312, 'GUIAO, JOHN NIKKO TUAZON', '', '', '', '', '', '2021-03-07', '', '0142807', '2021-03-07', '', '0142807', '2807', 0, 'user', 'img/default_profile.png'),
(313, 'GUIAO, RONALD D', '', '', '', '', '', '2021-03-07', '', '0087673', '2021-03-07', '', '0087673', '7673', 0, 'user', 'img/default_profile.png'),
(314, 'GUIAO, TOSCA CAMILLE SEIBERT', '', '', '', '', '', '2021-03-07', '', '0130799', '2021-03-07', '', '0130799', '0799', 0, 'user', 'img/default_profile.png'),
(315, 'GUIAO, JR, ZACARIAS S', '', '', '', '', '', '2021-03-07', '', '0032484', '2021-03-07', '', '0032484', '2484', 0, 'user', 'img/default_profile.png'),
(316, 'GUINTO-YAP, MELANIE M', '', '', '', '', '', '2021-03-07', '', '0106847', '2021-03-07', '', '0106847', '6847', 0, 'user', 'img/default_profile.png'),
(317, 'GURNOTE, DIANE NATASHA DYCHIOCO', '', '', '', '', '', '2021-03-07', '', '0127823', '2021-03-07', '', '0127823', '7823', 0, 'user', 'img/default_profile.png'),
(318, 'GUTIERREZ, FELIX EMMANUEL Z', '', '', '', '', '', '2021-03-07', '', '0097647', '2021-03-07', '', '0097647', '7647', 0, 'user', 'img/default_profile.png'),
(319, 'GUTIERREZ, MA ANGELITA C', '', '', '', '', '', '2021-03-07', '', '0095300', '2021-03-07', '', '0095300', '5300', 0, 'user', 'img/default_profile.png'),
(320, 'GUTIERREZ, RACHELL P', '', '', '', '', '', '2021-03-07', '', '0095498', '2021-03-07', '', '0095498', '5498', 0, 'user', 'img/default_profile.png'),
(321, 'GUTIERREZ, RICKY', '', '', '', '', '', '2021-03-07', '', '0099210', '2021-03-07', '', '0099210', '9210', 0, 'user', 'img/default_profile.png'),
(322, 'GUZMAN, ANTONIO JAVIER', '', '', '', '', '', '2021-03-07', '', '0046011', '2021-03-07', '', '0046011', '6011', 0, 'user', 'img/default_profile.png'),
(323, 'HALILI, JEREMY OCAMPO', '', '', '', '', '', '2021-03-07', '', '0126052', '2021-03-07', '', '0126052', '6052', 0, 'user', 'img/default_profile.png'),
(324, 'HENSON, GODOFREDO C', '', '', '', '', '', '2021-03-07', '', '0079027', '2021-03-07', '', '0079027', '9027', 0, 'user', 'img/default_profile.png'),
(325, 'HENSON, RAOUL PAOLO DIZON', '', '', '', '', '', '2021-03-07', '', '0082468', '2021-03-07', '', '0082468', '2468', 0, 'user', 'img/default_profile.png'),
(326, 'HENSON, III, RUBEN EMIL D', '', '', '', '', '', '2021-03-07', '', '0090259', '2021-03-07', '', '0090259', '0259', 0, 'user', 'img/default_profile.png'),
(327, 'HENSON, JR, RUBEN DE GUZMAN', '', '', '', '', '', '2021-03-07', '', '0021854', '2021-03-07', '', '0021854', '1854', 0, 'user', 'img/default_profile.png'),
(328, 'HIPOLITO, CORAZON F', '', '', '', '', '', '2021-03-07', '', '0014826', '2021-03-07', '', '0014826', '4826', 0, 'user', 'img/default_profile.png'),
(329, 'HIPOLITO, REY P', '', '', '', '', '', '2021-03-07', '', '0065570', '2021-03-07', '', '0065570', '5570', 0, 'user', 'img/default_profile.png'),
(330, 'IBALE, MARK GIBSON DALEJA', '', '', '', '', '', '2021-03-07', '', '0138571', '2021-03-07', '', '0138571', '8571', 0, 'user', 'img/default_profile.png'),
(331, 'ICASIANO, MARIA TERESA A', '', '', '', '', '', '2021-03-07', '', '0067775', '2021-03-07', '', '0067775', '7775', 0, 'user', 'img/default_profile.png'),
(332, 'ICBAN, AILEEN TALAVERA', '', '', '', '', '', '2021-03-07', '', '0103691', '2021-03-07', '', '0103691', '3691', 0, 'user', 'img/default_profile.png'),
(333, 'JORQUIA, SHIRLEY ESTACIO', '', '', '', '', '', '2021-03-07', '', '0082754', '2021-03-07', '', '0082754', '2754', 0, 'user', 'img/default_profile.png'),
(334, 'JOSE, JHONNATAN', '', '', '', '', '', '2021-03-07', '', '0091213', '2021-03-07', '', '0091213', '1213', 0, 'user', 'img/default_profile.png'),
(335, 'JOSON, ELIZABETH FLORES', '', '', '', '', '', '2021-03-07', '', '0053528', '2021-03-07', '', '0053528', '3528', 0, 'user', 'img/default_profile.png'),
(336, 'JUMAQUIO, PERLITA ELARMO', '', '', '', '', '', '2021-03-07', '', '0080504', '2021-03-07', '', '0080504', '0504', 0, 'user', 'img/default_profile.png'),
(337, 'KIT, JOHN JOHN V', '', '', '', '', '', '2021-03-07', '', '0081698', '2021-03-07', '', '0081698', '1698', 0, 'user', 'img/default_profile.png'),
(338, 'KWONG, ARKAY KRISTINE MALLARI', '', '', '', '', '', '2021-03-07', '', '0146243', '2021-03-07', '', '0146243', '6243', 0, 'user', 'img/default_profile.png'),
(339, 'LA MADRID-HERRERA, MARIA VICTORIA ROWENA B', '', '', '', '', '', '2021-03-07', '', '0097528', '2021-03-07', '', '0097528', '7528', 0, 'user', 'img/default_profile.png'),
(340, 'LACANLALE, EDGAR CORNELIO D', '', '', '', '', '', '2021-03-07', '', '0079177', '2021-03-07', '', '0079177', 'dokiton1414', 0, 'user', 'img/default_profile.png'),
(341, 'LACSON, ROMULO GARCIA', '', '', '', '', '', '2021-03-07', '', '0061297', '2021-03-07', '', '0061297', '1297', 0, 'user', 'img/default_profile.png'),
(342, 'LAGMAN, ARNOLD DAVID', '', '', '', '', '', '2021-03-07', '', '0097312', '2021-03-07', '', '0097312', '7312', 0, 'user', 'img/default_profile.png'),
(343, 'LAGUNILLA, FERDINAND SANTARINA', '', '', '', '', '', '2021-03-07', '', '0052235', '2021-03-07', '', '0052235', '2235', 0, 'user', 'img/default_profile.png'),
(344, 'LAGUNILLA, KRISTINA THERESE G', '', '', '', '', '', '2021-03-07', '', '0113736', '2021-03-07', '', '0113736', '3736', 0, 'user', 'img/default_profile.png'),
(345, 'LAGUNILLA, MARIA LOURDES GUEVARRA', '', '', '', '', '', '2021-03-07', '', '0052234', '2021-03-07', '', '0052234', '2234', 0, 'user', 'img/default_profile.png'),
(346, 'LAMUG, FERDINAND C', '', '', '', '', '', '2021-03-07', '', '0078857', '2021-03-07', '', '0078857', '8857', 0, 'user', 'img/default_profile.png'),
(347, 'LAO, CAROL MEDINA', '', '', '', '', '', '2021-03-07', '', '0057562', '2021-03-07', '', '0057562', '7562', 0, 'user', 'img/default_profile.png'),
(348, 'LAO, RICARDO LEONCIO B', '', '', '', '', '', '2021-03-07', '', '0060716', '2021-03-07', '', '0060716', '0716', 0, 'user', 'img/default_profile.png'),
(349, 'LAO, RICHARD CHRISTOPHER MEDINA', '', '', '', '', '', '2021-03-07', '', '0131241', '2021-03-07', '', '0131241', '1241', 0, 'user', 'img/default_profile.png'),
(350, 'LAPIRA, AIDA R', '', '', '', '', '', '2021-03-07', '', '0059205', '2021-03-07', '', '0059205', '9205', 0, 'user', 'img/default_profile.png'),
(351, 'LAPUZ, JILL ACIERTO', '', '', '', '', '', '2021-03-07', '', '0112572', '2021-03-07', '', '0112572', '2572', 0, 'user', 'img/default_profile.png'),
(352, 'LAPUZ, PRINCESS O', '', '', '', '', '', '2021-03-07', '', '0116662', '2021-03-07', '', '0116662', '6662', 0, 'user', 'img/default_profile.png'),
(353, 'LAQUINDANUM, MAAN KATHRYN SANTOS', '', '', '', '', '', '2021-03-07', '', '0144339', '2021-03-07', '', '0144339', '4339', 0, 'user', 'img/default_profile.png'),
(354, 'LARAGAN, LORETO L', '', '', '', '', '', '2021-03-07', '', '0039477', '2021-03-07', '', '0039477', '9477', 0, 'user', 'img/default_profile.png'),
(355, 'ALEXIS', 'Mallari ', 'Laxamana ', '1980 Jesus street Brgy Lourdes Northwest Angeles City ', '09173017697', 'alex.lxmn@gmail.com', '1977-11-02', 'C-8-968', '0122728', '2021-11-02', 'Private and Company', '0122728', 'darkangel110277', 1, 'user', 'img/default_profile.png'),
(356, 'LAXAMANA, JOMAN Q', '', '', '', '', '', '2021-03-07', '', '0121488', '2021-03-07', '', '0121488', '1488', 0, 'user', 'img/default_profile.png'),
(357, 'LAXAMANA, SHELLA MAY PROMENTILLA', '', '', '', '', '', '2021-03-07', '', '0119965', '2021-03-07', '', '0119965', '9965', 0, 'user', 'img/default_profile.png'),
(358, 'LAYSON, PIERRE GIVENCHY GARCIA', '', '', '', '', '', '2021-03-07', '', '0123107', '2021-03-07', '', '0123107', '3107', 0, 'user', 'img/default_profile.png'),
(359, 'LAZO, KIM VERNES ESGUERRA', '', '', '', '', '', '2021-03-07', '', '0142377', '2021-03-07', '', '0142377', '2377', 0, 'user', 'img/default_profile.png'),
(360, 'LIBOR, IRISH CHRISTIAN L', '', '', '', '', '', '2021-03-07', '', '0119312', '2021-03-07', '', '0119312', '9312', 0, 'user', 'img/default_profile.png'),
(361, 'LIM, SHERWIN JOURDAN SY', '', '', '', '', '', '2021-03-07', '', '0128903', '2021-03-07', '', '0128903', '8903', 0, 'user', 'img/default_profile.png'),
(362, 'LIMJOCO, MYKHAIL DEANG', '', '', '', '', '', '2021-03-07', '', '0137013', '2021-03-07', '', '0137013', '7013', 0, 'user', 'img/default_profile.png'),
(363, 'LIMJOCO, NOA ALEXANDRA DEANG', '', '', '', '', '', '2021-03-07', '', '0121915', '2021-03-07', '', '0121915', '1915', 0, 'user', 'img/default_profile.png'),
(364, 'LIMOS, RAUL IGNACIO', '', '', '', '', '', '2021-03-07', '', '0059399', '2021-03-07', '', '0059399', '9399', 0, 'user', 'img/default_profile.png'),
(365, 'LIMOS, SANDRA MORILLO', '', '', '', '', '', '2021-03-07', '', '0059398', '2021-03-07', '', '0059398', '9398', 0, 'user', 'img/default_profile.png'),
(366, 'LINGAD, MAJA KATHERINE B', '', '', '', '', '', '2021-03-07', '', '0145852', '2021-03-07', '', '0145852', '5852', 0, 'user', 'img/default_profile.png'),
(367, 'LISING, RAFAEL L', '', '', '', '', '', '2021-03-07', '', '0094471', '2021-03-07', '', '0094471', '4471', 0, 'user', 'img/default_profile.png'),
(368, 'LIWANAG, ROLANDA A', '', '', '', '', '', '2021-03-07', '', '0043927', '2021-03-07', '', '0043927', '3927', 0, 'user', 'img/default_profile.png'),
(369, 'LOGATOC, GARRY P', '', '', '', '', '', '2021-03-07', '', '0099803', '2021-03-07', '', '0099803', 'gianmartin15', 0, 'user', 'img/default_profile.png'),
(370, 'LOPEZ-TAN, PATRICIA W', '', '', '', '', '', '2021-03-07', '', '0056306', '2021-03-07', '', '0056306', '6306', 0, 'user', 'img/default_profile.png'),
(371, 'LUMANG, TERESITA G', '', '', '', '', '', '2021-03-07', '', '0058043', '2021-03-07', '', '0058043', '8043', 0, 'user', 'img/default_profile.png'),
(372, 'LUMBOY, ELAINE B', '', '', '', '', '', '2021-03-07', '', '0119899', '2021-03-07', '', '0119899', '9899', 0, 'user', 'img/default_profile.png'),
(373, 'LUMBOY, ERLINDA BONIFACIO', '', '', '', '', '', '2021-03-07', '', '0045426', '2021-03-07', '', '0045426', '5426', 0, 'user', 'img/default_profile.png'),
(374, 'JOHN WYETH ', 'DAYRIT', 'LUMBOY', '66 San Pedro 2, Magalang Pampanga', '09273791733', 'wydlum@yahoo.com', '1974-10-17', 'C8-1037', '0099510', '2023-10-17', 'Internal Medicine', '0099510', 'wydlum@74', 1, 'user', 'img/default_profile.png'),
(375, 'MARIE ANTONETTE ', 'MALUNGCUT', 'TAYAG-LUMBOY', '66 San Pedro 2, Magalang Pampanga', '09175104621', 'annettetayag@yahoo.com', '1976-01-01', 'C8-1038', '0098880', '2023-01-01', 'Internal Medicine', '0098880', 'Annetteyobmul76', 1, 'user', 'img/default_profile.png'),
(376, 'MABANTA, CARMELITA G', '', '', '', '', '', '2021-03-07', '', '0079202', '2021-03-07', '', '0079202', '9202', 0, 'user', 'img/default_profile.png'),
(377, 'MACAPAGAL, NOEL CHRISTI CUBANGAY', '', '', '', '', '', '2021-03-07', '', '0133419', '2021-03-07', '', '0133419', '3419', 0, 'user', 'img/default_profile.png'),
(378, 'FERNANDO', 'kendle', 'macarayo', '3-5 maya street, sta maria village, brgy balibago, angeles city 2009 pampanga', '09175111528', 'julietmacarayomd@yahoo.com', '1960-06-15', 'C8289', '0062738', '2023-06-15', 'anesthesiology', '0062738', 'FEma1528', 1, 'user', 'img/default_profile.png'),
(379, 'MARIA JULIET ', 'ENRIQUEZ', 'MACARAYO', '3-5 MAYA ST, STA. MARIA VILLAGE, BRGY BALIBAGO, ANGELES CITY 2009 PAMPANGA', '09175104020', 'julietmacarayomd@yahoo.com', '1962-04-28', 'C8335', '0063438', '2023-04-28', 'dermatology', '0063438', 'JUma1528', 1, 'user', 'img/default_profile.png'),
(380, 'MACASPAC, ORVI GEM RIVERA', '', '', '', '', '', '2021-03-07', '', '0120607', '2021-03-07', '', '0120607', '0607', 0, 'user', 'img/default_profile.png'),
(381, 'MAGNO, JOSE DONATO ACUÃ‘A', '', '', '', '', '', '2021-03-07', '', '0102983', '2021-03-07', '', '0102983', '2983', 0, 'user', 'img/default_profile.png'),
(382, 'MAGNO, KATRINA CHARISSE TORRES', '', '', '', '', '', '2021-03-07', '', '0116765', '2021-03-07', '', '0116765', '6765', 0, 'user', 'img/default_profile.png'),
(383, 'MAGTOTO, ALEXIS T', '', '', '', '', '', '2021-03-07', '', '0104088', '2021-03-07', '', '0104088', '4088', 0, 'user', 'img/default_profile.png'),
(384, 'MAGTOTO, IAN JASON CASTRO', '', '', '', '', '', '2021-03-07', '', '0125389', '2021-03-07', '', '0125389', '5389', 0, 'user', 'img/default_profile.png'),
(385, 'MALABANAN, GERALDO FRANCISCO J', '', '', '', '', '', '2021-03-07', '', '0088064', '2021-03-07', '', '0088064', '8064', 0, 'user', 'img/default_profile.png'),
(386, 'MALIWAT, LAWRENCE YAP', '', '', '', '', '', '2021-03-07', '', '0128981', '2021-03-07', '', '0128981', '8981', 0, 'user', 'img/default_profile.png'),
(387, 'MALIWAT, ROSEMARIE YAP', '', '', '', '', '', '2021-03-07', '', '0051346', '2021-03-07', '', '0051346', '1346', 0, 'user', 'img/default_profile.png'),
(388, 'MALLARI, RAYMUND S', '', '', '', '', '', '2021-03-07', '', '0097600', '2021-03-07', '', '0097600', '7600', 0, 'user', 'img/default_profile.png'),
(389, 'MALLARI-LABRADOR, MYRNA GRACE C', '', '', '', '', '', '2021-03-07', '', '0057847', '2021-03-07', '', '0057847', 'mahogany', 0, 'user', 'img/default_profile.png'),
(390, 'MALONZO, ERLINDA F', '', '', '', '', '', '2021-03-07', '', '0049749', '2021-03-07', '', '0049749', '9749', 0, 'user', 'img/default_profile.png'),
(391, 'MALONZO, ROMMEL G', '', '', '', '', '', '2021-03-07', '', '0087844', '2021-03-07', '', '0087844', '7844', 0, 'user', 'img/default_profile.png'),
(392, 'MALONZO, VANESSA FELICE FERREOL', '', '', '', '', '', '2021-03-07', '', '0135599', '2021-03-07', '', '0135599', '5599', 0, 'user', 'img/default_profile.png'),
(393, 'MALONZO, VICTOR SANTOS', '', '', '', '', '', '2021-03-07', '', '0049750', '2021-03-07', '', '0049750', '9750', 0, 'user', 'img/default_profile.png'),
(394, 'MALONZO, VINCENT EMANUEL F', '', '', '', '', '', '2021-03-07', '', '0119955', '2021-03-07', '', '0119955', '9955', 0, 'user', 'img/default_profile.png'),
(395, 'VITORIO NICOLAS', 'Ferreol', 'Malonzo ', '1230 miranda st. angeles city ', '09328120684', 'vitorionicolas@yahoo.com', '1984-12-06', '121198', '0121198', '2023-12-07', 'Orthopedics', '0121198', 'porschegt3rs', 1, 'user', 'img/default_profile.png'),
(396, 'MAMAWI, JASPER M', '', '', '', '', '', '2021-03-07', '', '0112034', '2021-03-07', '', '0112034', '2034', 0, 'user', 'img/default_profile.png'),
(397, 'MANALASTAS, DIONELLA S', '', '', '', '', '', '2021-03-07', '', '0110386', '2021-03-07', '', '0110386', '0386', 0, 'user', 'img/default_profile.png'),
(398, 'MANALASTAS, EDGARDO T', '', '', '', '', '', '2021-03-07', '', '0053202', '2021-03-07', '', '0053202', '3202', 0, 'user', 'img/default_profile.png'),
(399, 'MANALASTAS, IRENE CAPATI', '', '', '', '', '', '2021-03-07', '', '0053470', '2021-03-07', '', '0053470', '3470', 0, 'user', 'img/default_profile.png'),
(400, 'MANALASTAS, PAOLO CAPATI', '', '', '', '', '', '2021-03-07', '', '0127939', '2021-03-07', '', '0127939', '7939', 0, 'user', 'img/default_profile.png'),
(401, 'MANALASTAS, PATRICIA ISABEL C', '', '', '', '', '', '2021-03-07', '', '0118385', '2021-03-07', '', '0118385', '8385', 0, 'user', 'img/default_profile.png'),
(402, 'MANALASTAS, RENE EDGARDO CAPATI', '', '', '', '', '', '2021-03-07', '', '0122862', '2021-03-07', '', '0122862', '2862', 0, 'user', 'img/default_profile.png'),
(403, 'MANALILI, RACHEL GALURA', '', '', '', '', '', '2021-03-07', '', '0082115', '2021-03-07', '', '0082115', '2115', 0, 'user', 'img/default_profile.png'),
(404, 'MANALILI, RONAJOY GATMAITAN', '', '', '', '', '', '2021-03-07', '', '0139087', '2021-03-07', '', '0139087', '9087', 0, 'user', 'img/default_profile.png'),
(405, 'MANALO, MARIE LHEN GONZALES', '', '', '', '', '', '2021-03-07', '', '0119725', '2021-03-07', '', '0119725', '9725', 0, 'user', 'img/default_profile.png'),
(406, 'MANALO, MARWIN ROMAN TADEO M', '', '', '', '', '', '2021-03-07', '', '0086034', '2021-03-07', '', '0086034', '6034', 0, 'user', 'img/default_profile.png'),
(407, 'MANALO, MERLY M', '', '', '', '', '', '2021-03-07', '', '0082752', '2021-03-07', '', '0082752', '2752', 0, 'user', 'img/default_profile.png'),
(408, 'MANALOTO, MARIA SARAH LAUS', '', '', '', '', '', '2021-03-07', '', '0142608', '2021-03-07', '', '0142608', '2608', 0, 'user', 'img/default_profile.png'),
(409, 'MANALOTO, ZANETA JOY DIAZ', '', '', '', '', '', '2021-03-07', '', '0138053', '2021-03-07', '', '0138053', '8053', 0, 'user', 'img/default_profile.png'),
(410, 'MANALOTO-ESTARIS, MARIANNE TANGLAO', '', '', '', '', '', '2021-03-07', '', '0106514', '2021-03-07', '', '0106514', '6514', 0, 'user', 'img/default_profile.png'),
(411, 'MANANSALA, JOAN M', '', '', '', '', '', '2021-03-07', '', '0109567', '2021-03-07', '', '0109567', '9567', 0, 'user', 'img/default_profile.png'),
(412, 'MANARANG, MA JESUSA SICAT', '', '', '', '', '', '2021-03-07', '', '0073211', '2021-03-07', '', '0073211', '3211', 0, 'user', 'img/default_profile.png'),
(413, 'MANDAL, ANITA VARONA', '', '', '', '', '', '2021-03-07', '', '0049056', '2021-03-07', '', '0049056', '9056', 0, 'user', 'img/default_profile.png'),
(414, 'MANDAL, NAE-ANNE VARONA', '', '', '', '', '', '2021-03-07', '', '0121842', '2021-03-07', '', '0121842', '1842', 0, 'user', 'img/default_profile.png'),
(415, 'MANDAL, NAEGELE V', '', '', '', '', '', '2021-03-07', '', '0113364', '2021-03-07', '', '0113364', '3364', 0, 'user', 'img/default_profile.png'),
(416, 'MANDAL, NAEL-IZA V', '', '', '', '', '', '2021-03-07', '', '0124166', '2021-03-07', '', '0124166', '4166', 0, 'user', 'img/default_profile.png'),
(417, 'MANDIGAL, REYMUNDO C', '', '', '', '', '', '2021-03-07', '', '0079604', '2021-03-07', '', '0079604', '9604', 0, 'user', 'img/default_profile.png'),
(418, 'MANGUBAT, ROWENA M', '', '', '', '', '', '2021-03-07', '', '0091069', '2021-03-07', '', '0091069', '1069', 0, 'user', 'img/default_profile.png'),
(419, 'MANGUNE-MUÃ‘OZ, IRIS ROSE PEL', '', '', '', '', '', '2021-03-07', '', '0115035', '2021-03-07', '', '0115035', '5035', 0, 'user', 'img/default_profile.png'),
(420, 'MANICDAO, JEMIMA E', '', '', '', '', '', '2021-03-07', '', '0100160', '2021-03-07', '', '0100160', '0160', 0, 'user', 'img/default_profile.png'),
(421, 'MANUEL, ARVIN JOHN PABALAN', '', '', '', '', '', '2021-03-07', '', '0135457', '2021-03-07', '', '0135457', '5457', 0, 'user', 'img/default_profile.png'),
(422, 'MANUEL, RACHEL CHEN', '', '', '', '', '', '2021-03-07', '', '0135839', '2021-03-07', '', '0135839', '5839', 0, 'user', 'img/default_profile.png'),
(423, 'MANUNTAG, JOSEPH LIWANAG', '', '', '', '', '', '2021-03-07', '', '0136502', '2021-03-07', '', '0136502', '6502', 0, 'user', 'img/default_profile.png'),
(424, 'MANZON, EDWIN R', '', '', '', '', '', '2021-03-07', '', '0077265', '2021-03-07', '', '0077265', '7265', 0, 'user', 'img/default_profile.png'),
(425, 'MANZON, MARTHA CONCESA G', '', '', '', '', '', '2021-03-07', '', '0077273', '2021-03-07', '', '0077273', '7273', 0, 'user', 'img/default_profile.png'),
(426, 'MARCELO, GEMMA JOYCE TAMAYO', '', '', '', '', '', '2021-03-07', '', '0129665', '2021-03-07', '', '0129665', '9665', 0, 'user', 'img/default_profile.png'),
(427, 'MARQUEZ, CLAUDINE TAN', '', '', '', '', '', '2021-03-07', '', '0103685', '2021-03-07', '', '0103685', '3685', 0, 'user', 'img/default_profile.png'),
(428, 'MARQUEZ, DEBBIE YAP', '', '', '', '', '', '2021-03-07', '', '0090778', '2021-03-07', '', '0090778', '0778', 0, 'user', 'img/default_profile.png'),
(429, 'MARQUEZ, RAYMOND RODEL PARAS', '', '', '', '', '', '2021-03-07', '', '0076985', '2021-03-07', '', '0076985', '6985', 0, 'user', 'img/default_profile.png'),
(430, 'MARQUEZ, JR, RAYMUNDO P', '', '', '', '', '', '2021-03-07', '', '0087674', '2021-03-07', '', '0087674', '7674', 0, 'user', 'img/default_profile.png'),
(431, 'MARTINEZ, MARIA FATIMA VERGARA', '', '', '', '', '', '2021-03-07', '', '0143092', '2021-03-07', '', '0143092', '3092', 0, 'user', 'img/default_profile.png'),
(432, 'MASANGCAY, GINA G', '', '', '', '', '', '2021-03-07', '', '0104206', '2021-03-07', '', '0104206', '4206', 0, 'user', 'img/default_profile.png'),
(433, 'MASBANG, ARMIN NACPIL', '', '', '', '', '', '2021-03-07', '', '0120594', '2021-03-07', '', '0120594', '0594', 0, 'user', 'img/default_profile.png'),
(434, 'Faye Clarice', 'Mallari', 'Maturan', '040 Kalsadang Bayu, Sta. Rita, Macabebe, Pampanga', '09175102692', 'fayeclarice@gmail.com', '1984-12-29', 'C-8-1033', '0124389', '2023-12-29', 'Family and Community Medicine', '0124389', 'MCM@2r@n120211', 1, 'user', 'img/assets/PhotoID-434-2021-03-11-10-04-12.jpeg'),
(435, 'Juan Paulo', 'Chua', 'Maturan', '040 Kalsadang Bayu Sta Rita Macabebe Pampanga ', '09176521046', 'juanpcmaturan@gmail.com', '1984-07-31', 'C-8-1032', '0120435', '2024-07-31', 'Family and Community Medicine ', '0120435', '0120435', 1, 'user', 'img/default_profile.png'),
(436, 'MEDINA, ELIZABETH ANNE Y', '', '', '', '', '', '2021-03-07', '', '0105584', '2021-03-07', '', '0105584', '5584', 0, 'user', 'img/default_profile.png'),
(437, 'Ana Lyn', 'Pangilinan', 'Mendoza', '3596, P.Gomez Street Lourdes Northwest, Angeles City', '09175054410', 'docana9212@gmail.com', '1970-06-11', 'C-8644', '0089123', '2021-03-07', 'Pediatrics', '0089123', 'DocAna2021', 1, 'user', 'img/default_profile.png'),
(438, 'MENDOZA, BERNADETTE H', '', '', '', '', '', '2021-03-07', '', '0101283', '2021-03-07', '', '0101283', '1283', 0, 'user', 'img/default_profile.png'),
(439, 'MENDOZA, BYRONE GAGUI', '', '', '', '', '', '2021-03-07', '', '0102142', '2021-03-07', '', '0102142', '2142', 0, 'user', 'img/default_profile.png'),
(440, 'MENDOZA, CLARO B', '', '', '', '', '', '2021-03-07', '', '0099509', '2021-03-07', '', '0099509', '9509', 0, 'user', 'img/default_profile.png'),
(441, 'MENDOZA, MARIA CHARISSA THALIA FLORES', '', '', '', '', '', '2021-03-07', '', '0128169', '2021-03-07', '', '0128169', '8169', 0, 'user', 'img/default_profile.png'),
(442, 'MENDOZA, MARIA ELEANOR P', '', '', '', '', '', '2021-03-07', '', '0067864', '2021-03-07', '', '0067864', '7864', 0, 'user', 'img/default_profile.png'),
(443, 'MENDOZA, JR, NICIAS V', '', '', '', '', '', '2021-03-07', '', '0051156', '2021-03-07', '', '0051156', '1156', 0, 'user', 'img/default_profile.png'),
(444, 'MENESES, WARREN B', '', '', '', '', '', '2021-03-07', '', '0089561', '2021-03-07', '', '0089561', '9561', 0, 'user', 'img/default_profile.png'),
(445, 'MERCADO, EMMA DE LEON', '', '', '', '', '', '2021-03-07', '', '0082756', '2021-03-07', '', '0082756', '2756', 0, 'user', 'img/default_profile.png'),
(446, 'MERCADO, JOHN B', '', '', '', '', '', '2021-03-07', '', '0084045', '2021-03-07', '', '0084045', '4045', 0, 'user', 'img/default_profile.png'),
(447, 'MERCADO, MARIA DOLORES AMBAT', '', '', '', '', '', '2021-03-07', '', '0089063', '2021-03-07', '', '0089063', '9063', 0, 'user', 'img/default_profile.png'),
(448, 'MESINA, RENZ MICHELLE DE GUZMAN', '', '', '', '', '', '2021-03-07', '', '0143931', '2021-03-07', '', '0143931', '3931', 0, 'user', 'img/default_profile.png'),
(449, 'MIOLE, GRACE LYN BONDOR', '', '', '', '', '', '2021-03-07', '', '0123165', '2021-03-07', '', '0123165', '3165', 0, 'user', 'img/default_profile.png'),
(450, 'MIRANDA, MICHELLE TANGLAO', '', '', '', '', '', '2021-03-07', '', '0104207', '2021-03-07', '', '0104207', '4207', 0, 'user', 'img/default_profile.png'),
(451, ' CARLA MAJA LIZL', 'Alfonso', 'MontaÃ±a', 'Aond St, bagong Pagasa Subd, San Vicente, Apalit, Pampanga', '09150551045', 'maja.montana@yahoo.com', '1989-10-22', 'C811060131088', '0131088', '2021-10-22', 'General Pediatrics', '0131088', 'acms22', 1, 'user', 'img/default_profile.png'),
(452, 'MONTEMAYOR, FRANGELITO G', '', '', '', '', '', '2021-03-07', '', '0095307', '2021-03-07', '', '0095307', '5307', 0, 'user', 'img/default_profile.png'),
(453, 'MONTEMAYOR, MARY JANE S', '', '', '', '', '', '2021-03-07', '', '0090716', '2021-03-07', '', '0090716', '0716', 0, 'user', 'img/default_profile.png'),
(454, 'MONTEROLA, MA VICTORIA SANTIAGO', '', '', '', '', '', '2021-03-07', '', '0060382', '2021-03-07', '', '0060382', '0382', 0, 'user', 'img/default_profile.png'),
(455, 'MORALES, CHRISTINA ANNE DIANELO', '', '', '', '', '', '2021-03-07', '', '0142817', '2021-03-07', '', '0142817', '2817', 0, 'user', 'img/default_profile.png'),
(456, 'MORANTE, JUAN G', '', '', '', '', '', '2021-03-07', '', '0062296', '2021-03-07', '', '0062296', '2296', 0, 'user', 'img/default_profile.png'),
(457, 'MULDONG, FRANCES BANTING', '', '', '', '', '', '2021-03-07', '', '0135562', '2021-03-07', '', '0135562', '5562', 0, 'user', 'img/default_profile.png'),
(458, 'NABONG, ROSARIO', '', '', '', '', '', '2021-03-07', '', '0061212', '2021-03-07', '', '0061212', '1212', 0, 'user', 'img/default_profile.png'),
(459, 'NABUA, TERESITA BUHION', '', '', '', '', '', '2021-03-07', '', '0086920', '2021-03-07', '', '0086920', '6920', 0, 'user', 'img/default_profile.png'),
(460, 'NALO, PENELOPE SANTIAGO', '', '', '', '', '', '2021-03-07', '', '0125622', '2021-03-07', '', '0125622', '5622', 0, 'user', 'img/default_profile.png'),
(461, 'NALO,JR, RICARDO R', '', '', '', '', '', '2021-03-07', '', '0091505', '2021-03-07', '', '0091505', '1505', 0, 'user', 'img/default_profile.png'),
(462, 'NARCISO, JEANNE MARIE RIVERA', '', '', '', '', '', '2021-03-07', '', '0139085', '2021-03-07', '', '0139085', '9085', 0, 'user', 'img/default_profile.png'),
(463, 'NATINO, EFREN BACHAR', '', '', '', '', '', '2021-03-07', '', '0056960', '2021-03-07', '', '0056960', '6960', 0, 'user', 'img/default_profile.png'),
(464, 'NATIVIDAD, MA LOURDES DIZON', '', '', '', '', '', '2021-03-07', '', '0064217', '2021-03-07', '', '0064217', '4217', 0, 'user', 'img/default_profile.png'),
(465, 'NATIVIDAD, MARIFEL C', '', '', '', '', '', '2021-03-07', '', '0092519', '2021-03-07', '', '0092519', '2519', 0, 'user', 'img/default_profile.png'),
(466, 'NAVARRO, AURELIA V', '', '', '', '', '', '2021-03-07', '', '0104724', '2021-03-07', '', '0104724', '4724', 0, 'user', 'img/default_profile.png'),
(467, 'NAVIDAD, NELSON D', '', '', '', '', '', '2021-03-07', '', '0094344', '2021-03-07', '', '0094344', '4344', 0, 'user', 'img/default_profile.png'),
(468, 'NEFULDA, CESAR S', '', '', '', '', '', '2021-03-07', '', '0089727', '2021-03-07', '', '0089727', '9727', 0, 'user', 'img/default_profile.png'),
(469, 'NEPOMUCENO, RAYMOND JOHN S', '', '', '', '', '', '2021-03-07', '', '0087356', '2021-03-07', '', '0087356', '7356', 0, 'user', 'img/default_profile.png'),
(470, 'NICOLAS, JR, EDGAR S', '', '', '', '', '', '2021-03-07', '', '0089200', '2021-03-07', '', '0089200', '9200', 0, 'user', 'img/default_profile.png'),
(471, 'NOEL, ANNA AURELIA MABINI', '', '', '', '', '', '2021-03-07', '', '0120611', '2021-03-07', '', '0120611', '0611', 0, 'user', 'img/default_profile.png'),
(472, 'NUDO, JAHZIEL MANICDAO', '', '', '', '', '', '2021-03-07', '', '0095352', '2021-03-07', '', '0095352', '5352', 0, 'user', 'img/default_profile.png'),
(473, 'NUNAG, CARMELINO M', '', '', '', '', '', '2021-03-07', '', '0029339', '2021-03-07', '', '0029339', '9339', 0, 'user', 'img/default_profile.png'),
(474, 'OBRIQUE, MARY ANN DIANA L', '', '', '', '', '', '2021-03-07', '', '0067186', '2021-03-07', '', '0067186', '7186', 0, 'user', 'img/default_profile.png'),
(475, 'OCAMPO, ANN MITZEL MATA', '', '', '', '', '', '2021-03-07', '', '0117983', '2021-03-07', '', '0117983', '7983', 0, 'user', 'img/default_profile.png'),
(476, 'OCAMPO, ARIEL L', '', '', '', '', '', '2021-03-07', '', '0094813', '2021-03-07', '', '0094813', '4813', 0, 'user', 'img/default_profile.png'),
(477, 'OCAMPO, JONAS S', '', '', '', '', '', '2021-03-07', '', '0061695', '2021-03-07', '', '0061695', '1695', 0, 'user', 'img/default_profile.png'),
(478, 'OCAMPO, JOY FERNANDO', '', '', '', '', '', '2021-03-07', '', '0063293', '2021-03-07', '', '0063293', '3293', 0, 'user', 'img/default_profile.png'),
(479, 'OCAMPO, PIUS JONAS FERNANDO', '', '', '', '', '', '2021-03-07', '', '0117978', '2021-03-07', '', '0117978', '7978', 0, 'user', 'img/default_profile.png'),
(480, 'OCLARIT, KRIZIA AIRA JAVIERTO', '', '', '', '', '', '2021-03-07', '', '0130880', '2021-03-07', '', '0130880', '0880', 0, 'user', 'img/default_profile.png'),
(481, 'OLALIA, JAYSON SAMPAGA', '', '', '', '', '', '2021-03-07', '', '0148776', '2021-03-07', '', '0148776', '8776', 0, 'user', 'img/default_profile.png'),
(482, 'OLIVAS, ALANO T', '', '', '', '', '', '2021-03-07', '', '0093088', '2021-03-07', '', '0093088', '3088', 0, 'user', 'img/default_profile.png'),
(483, 'OLIVAS, CINDY SALVADOR', '', '', '', '', '', '2021-03-07', '', '0093085', '2021-03-07', '', '0093085', '3085', 0, 'user', 'img/default_profile.png'),
(484, 'ONG, JAY MARK ZAPANTA', '', '', '', '', '', '2021-03-07', '', '0133557', '2021-03-07', '', '0133557', '3557', 0, 'user', 'img/default_profile.png'),
(485, 'ONG, MELODY LIM', '', '', '', '', '', '2021-03-07', '', '0094011', '2021-03-07', '', '0094011', '4011', 0, 'user', 'img/default_profile.png'),
(486, 'ONTOG, MARLENE ESTACIO', '', '', '', '', '', '2021-03-07', '', '0061864', '2021-03-07', '', '0061864', '1864', 0, 'user', 'img/default_profile.png'),
(487, 'ORETA, EDWIN H', '', '', '', '', '', '2021-03-07', '', '0108199', '2021-03-07', '', '0108199', '8199', 0, 'user', 'img/default_profile.png'),
(488, 'ORPILLA, MARLYN Y', '', '', '', '', '', '2021-03-07', '', '0113396', '2021-03-07', '', '0113396', '3396', 0, 'user', 'img/default_profile.png'),
(489, 'ORTIZ, MARIA JASMIN D', '', '', '', '', '', '2021-03-07', '', '0109638', '2021-03-07', '', '0109638', '9638', 0, 'user', 'img/default_profile.png'),
(490, 'PABUSTAN, FERDINAND B', '', '', '', '', '', '2021-03-07', '', '0086624', '2021-03-07', '', '0086624', '6624', 0, 'user', 'img/default_profile.png'),
(491, 'PACHECO, RICARDO O', '', '', '', '', '', '2021-03-07', '', '0081968', '2021-03-07', '', '0081968', '1968', 0, 'user', 'img/default_profile.png'),
(492, 'PACIA-TUAZON, CECILIA', '', '', '', '', '', '2021-03-07', '', '0063865', '2021-03-07', '', '0063865', '3865', 0, 'user', 'img/default_profile.png'),
(493, 'PALAD, SHERYL S', '', '', '', '', '', '2021-03-07', '', '0131585', '2021-03-07', '', '0131585', '1585', 0, 'user', 'img/default_profile.png'),
(494, 'PAMINTUAN, NOEL VICTOR SOLANO', '', '', '', '', '', '2021-03-07', '', '0134655', '2021-03-07', '', '0134655', '4655', 0, 'user', 'img/default_profile.png'),
(495, 'NOVA', 'TANGLAO', 'PAMINTUAN', 'Lot 18 Block 26 Phase 2 Sineguelas St, Clark Manor Subd, Brgy. Duquit  Mabalacat City', '09088893486', 'novatpchua@gmail.com', '1972-11-02', 'C-8-689', '0092431', '2023-11-02', 'Neurology', '0092431', '2431', 1, 'user', 'img/assets/PhotoID-495-2021-03-11-07-34-03.jpg'),
(496, 'PAMINTUAN, PHIL PATAWARAN', '', '', '', '', '', '2021-03-07', '', '0128019', '2021-03-07', '', '0128019', '8019', 0, 'user', 'img/default_profile.png'),
(497, 'PAMINTUAN, JR, AUGURIO GONZALES', '', '', '', '', '', '2021-03-07', '', '0128221', '2021-03-07', '', '0128221', '8221', 0, 'user', 'img/default_profile.png'),
(498, 'PAMINTUAN-DAVID, ANGELI KATRINE MANALOTO', '', '', '', '', '', '2021-03-07', '', '0135252', '2021-03-07', '', '0135252', '5252', 0, 'user', 'img/default_profile.png'),
(499, 'PANGA, EDGAR M', '', '', '', '', '', '2021-03-07', '', '0079379', '2021-03-07', '', '0079379', '9379', 0, 'user', 'img/default_profile.png'),
(500, 'PANGALANGAN, RACHELLE SANDALO', '', '', '', '', '', '2021-03-07', '', '0109123', '2021-03-07', '', '0109123', '9123', 0, 'user', 'img/default_profile.png'),
(501, 'PANGAN, RENATO S', '', '', '', '', '', '2021-03-07', '', '0069638', '2021-03-07', '', '0069638', '9638', 0, 'user', 'img/default_profile.png'),
(502, 'PANGANIBAN, JORDAN S', '', '', '', '', '', '2021-03-07', '', '0117508', '2021-03-07', '', '0117508', '7508', 0, 'user', 'img/default_profile.png'),
(503, 'PANGILINAN, ANNA MARIE G', '', '', '', '', '', '2021-03-07', '', '0096385', '2021-03-07', '', '0096385', '6385', 0, 'user', 'img/default_profile.png'),
(504, 'PANGILINAN, JEFFREY ANGELES', '', '', '', '', '', '2021-03-07', '', '0117571', '2021-03-07', '', '0117571', '7571', 0, 'user', 'img/default_profile.png'),
(505, 'PANGILINAN, MARY CATHERINE GALANG', '', '', '', '', '', '2021-03-07', '', '0119732', '2021-03-07', '', '0119732', '9732', 0, 'user', 'img/default_profile.png'),
(506, 'PANGILINAN, SVETLANA SANCHEZ', '', '', '', '', '', '2021-03-07', '', '0080590', '2021-03-07', '', '0080590', '0590', 0, 'user', 'img/default_profile.png'),
(507, 'WILLIAM', 'SERRANO ', 'PANGILINAN ', '18-14 Yangtze street Riverside Subd Brgy Anunas Angeles City ', '09175555357', 'doklyam@yahoo.com', '1975-05-29', 'C-8-704', '0101926', '2022-05-29', 'General Medicine ', '0101926', 'yanyanmito', 1, 'user', 'img/assets/PhotoID-507-2021-03-10-22-50-02.jpeg'),
(508, 'PANLILIO, ARISTIDES G', '', '', '', '', '', '2021-03-07', '', '0054672', '2021-03-07', '', '0054672', '4672', 0, 'user', 'img/default_profile.png'),
(509, 'PANLILIO, HAZEL LIZETTE M', '', '', '', '', '', '2021-03-07', '', '0131853', '2021-03-07', '', '0131853', '1853', 0, 'user', 'img/default_profile.png'),
(510, 'PANLILIO, LILIA MAGAT', '', '', '', '', '', '2021-03-07', '', '0056537', '2021-03-07', '', '0056537', '6537', 0, 'user', 'img/default_profile.png'),
(511, 'PANLILIO, MARIO CABIGTING', '', '', '', '', '', '2021-03-07', '', '0061198', '2021-03-07', '', '0061198', '1198', 0, 'user', 'img/default_profile.png'),
(512, 'PANLILIO, NOEL M', '', '', '', '', '', '2021-03-07', '', '0062190', '2021-03-07', '', '0062190', '2190', 0, 'user', 'img/default_profile.png'),
(513, 'PANTIG, CONCEPCION GARCIA', '', '', '', '', '', '2021-03-07', '', '0054985', '2021-03-07', '', '0054985', '4985', 0, 'user', 'img/default_profile.png'),
(514, 'PANTIG, FRANCESCA MAE TAN', '', '', '', '', '', '2021-03-07', '', '0120413', '2021-03-07', '', '0120413', '0413', 0, 'user', 'img/default_profile.png'),
(515, 'PANTIG, JULIE TAN', '', '', '', '', '', '2021-03-07', '', '0053098', '2021-03-07', '', '0053098', '3098', 0, 'user', 'img/default_profile.png'),
(516, 'PANTIG, PERINO P', '', '', '', '', '', '2021-03-07', '', '0055984', '2021-03-07', '', '0055984', '5984', 0, 'user', 'img/default_profile.png'),
(517, 'PANTIG, VIRGILIO D', '', '', '', '', '', '2021-03-07', '', '0074317', '2021-03-07', '', '0074317', '4317', 0, 'user', 'img/default_profile.png'),
(518, 'PANTIG, VITTORIO', '', '', '', '', '', '2021-03-07', '', '0053894', '2021-03-07', '', '0053894', '3894', 0, 'user', 'img/default_profile.png'),
(519, 'PASAYLO, VANESSA SANTOS', '', '', '', '', '', '2021-03-07', '', '0117576', '2021-03-07', '', '0117576', '7576', 0, 'user', 'img/default_profile.png'),
(520, 'PASCUAL, JOHANNA MARIE P', '', '', '', '', '', '2021-03-07', '', '0115068', '2021-03-07', '', '0115068', '5068', 0, 'user', 'img/default_profile.png'),
(521, 'PASUMBAL, EMELY P', '', '', '', '', '', '2021-03-07', '', '0062571', '2021-03-07', '', '0062571', '2571', 0, 'user', 'img/default_profile.png'),
(522, 'PATAWARAN, EDUARDO C', '', '', '', '', '', '2021-03-07', '', '0042346', '2021-03-07', '', '0042346', '2346', 0, 'user', 'img/default_profile.png'),
(523, 'PATAWARAN, ESMERALDA L', '', '', '', '', '', '2021-03-07', '', '0042164', '2021-03-07', '', '0042164', '2164', 0, 'user', 'img/default_profile.png'),
(524, 'PATAWARAN, JEFFREY LAO', '', '', '', '', '', '2021-03-07', '', '0110915', '2021-03-07', '', '0110915', '0915', 0, 'user', 'img/default_profile.png'),
(525, 'PATAWARAN, JOEL L', '', '', '', '', '', '2021-03-07', '', '0091833', '2021-03-07', '', '0091833', '1833', 0, 'user', 'img/default_profile.png'),
(526, 'PATIO, CRISTINE JOY SALVELLANO', '', '', '', '', '', '2021-03-07', '', '0115165', '2021-03-07', '', '0115165', '5165', 0, 'user', 'img/default_profile.png'),
(527, 'ERICSON LLOYD ', 'ALFORTE', 'PATIO', '229 1st St. Brgy. Ninoy Aquino (Marisol) ', '09437071343', 'docericpatio@gmail.com', '1980-04-25', 'C-8-847', '0115170', '2021-04-24', 'Family Medicine', '0115170', 'epatioMD115170', 1, 'user', 'img/default_profile.png'),
(528, 'PAULE, BERNICE C', '', '', '', '', '', '2021-03-07', '', '0081019', '2021-03-07', '', '0081019', '1019', 0, 'user', 'img/default_profile.png'),
(529, 'PAULE, JOSE RANILO M', '', '', '', '', '', '2021-03-07', '', '0081718', '2021-03-07', '', '0081718', '1718', 0, 'user', 'img/default_profile.png'),
(530, 'PAYUMO, ELAINE CASUPANAN', '', '', '', '', '', '2021-03-07', '', '0098175', '2021-03-07', '', '0098175', '8175', 0, 'user', 'img/default_profile.png'),
(531, 'PEKSON, FRANZ JOSSEF', '', '', '', '', '', '2021-03-07', '', '0098621', '2021-03-07', '', '0098621', '8621', 0, 'user', 'img/default_profile.png'),
(532, 'PEKSON-REYES, NINA MALIWAT', '', '', '', '', '', '2021-03-07', '', '0053530', '2021-03-07', '', '0053530', '3530', 0, 'user', 'img/default_profile.png'),
(533, 'PELAYO, MICHELLE MANARANG', '', '', '', '', '', '2021-03-07', '', '0113316', '2021-03-07', '', '0113316', '3316', 0, 'user', 'img/default_profile.png'),
(534, 'PEREGRINO, JOVELL IAN M', '', '', '', '', '', '2021-03-07', '', '0105227', '2021-03-07', '', '0105227', '5227', 0, 'user', 'img/default_profile.png'),
(535, 'PINEDA, BEATRICE CORRINA C', '', '', '', '', '', '2021-03-07', '', '0048268', '2021-03-07', '', '0048268', '8268', 0, 'user', 'img/default_profile.png'),
(536, 'PINEDA, EMERITA D', '', '', '', '', '', '2021-03-07', '', '0062417', '2021-03-07', '', '0062417', '2417', 0, 'user', 'img/default_profile.png'),
(537, 'PINEDA, FRANCIS IVAN GUTIERREZ', '', '', '', '', '', '2021-03-07', '', '0134110', '2021-03-07', '', '0134110', '4110', 0, 'user', 'img/default_profile.png'),
(538, 'PINEDA, IGNACIO DAVID', '', '', '', '', '', '2021-03-07', '', '0051231', '2021-03-07', '', '0051231', '1231', 0, 'user', 'img/default_profile.png'),
(539, 'PINEDA, JERICHO ROBERT N', '', '', '', '', '', '2021-03-07', '', '0109629', '2021-03-07', '', '0109629', '9629', 0, 'user', 'img/default_profile.png'),
(540, 'PINEDA-DELA ROSA, CHARMAINE M', '', '', '', '', '', '2021-03-07', '', '0117391', '2021-03-07', '', '0117391', '7391', 0, 'user', 'img/default_profile.png'),
(541, 'PINPIN, CRISTINA SHERYLL G', '', '', '', '', '', '2021-03-07', '', '0100174', '2021-03-07', '', '0100174', '0174', 0, 'user', 'img/default_profile.png'),
(542, 'PINPIN, RICARDO E', '', '', '', '', '', '2021-03-07', '', '0080061', '2021-03-07', '', '0080061', '0061', 0, 'user', 'img/default_profile.png'),
(543, 'PIOQUINTO, LINDA POTESTAS', '', '', '', '', '', '2021-03-07', '', '0042365', '2021-03-07', '', '0042365', '2365', 0, 'user', 'img/default_profile.png'),
(544, 'POSADAS, MA SOCORRO EBUEN', '', '', '', '', '', '2021-03-07', '', '0080163', '2021-03-07', '', '0080163', '0163', 0, 'user', 'img/default_profile.png'),
(545, 'POSADAS, NELSON V', '', '', '', '', '', '2021-03-07', '', '0083093', '2021-03-07', '', '0083093', '3093', 0, 'user', 'img/default_profile.png'),
(546, 'RICHELLE ', 'Cruz', 'Puno', 'Blk 14 Lot 13 chicago st timog park homea angeles city', '09999935082', 'richellecpuno@yahoo.com.ph', '1975-11-13', 'c-8-726', '0102223', '2022-11-13', 'General/Occupational Medicine', '0102223', 'Ethanaki2018', 1, 'user', 'img/default_profile.png'),
(547, 'PUNSALAN, ALFREDO D', '', '', '', '', '', '2021-03-07', '', '0052191', '2021-03-07', '', '0052191', '2191', 0, 'user', 'img/default_profile.png'),
(548, 'PUNSALAN, JOAN MARIZ TAYAG', '', '', '', '', '', '2021-03-07', '', '0148775', '2021-03-07', '', '0148775', '8775', 0, 'user', 'img/default_profile.png'),
(549, 'QUEMUEL, RACHELLE DE LA ROSA', '', '', '', '', '', '2021-03-07', '', '0105383', '2021-03-07', '', '0105383', '5383', 0, 'user', 'img/default_profile.png'),
(550, 'MANUEL', 'GOMEZ', 'QUIAMBAO', '5435 Rosas Street, Timog Park Subdivision,', '09778157853', 'mgquiambaomd@gmail.com', '1970-03-07', 'C-8-626-0088968', '0088968', '2022-03-07', 'General Occupational Health ', '0088968', 'jasonadq13', 1, 'user', 'img/assets/PhotoID-550-2021-03-11-02-14-47.jpg'),
(551, 'QUITALIG, JR, ERNESTO GARCIA', '', '', '', '', '', '2021-03-07', '', '0073714', '2021-03-07', '', '0073714', '3714', 0, 'user', 'img/default_profile.png'),
(552, 'QUITO, EDERLYN PUNZALAN', '', '', '', '', '', '2021-03-07', '', '0122984', '2021-03-07', '', '0122984', '2984', 0, 'user', 'img/default_profile.png'),
(553, 'QUIZON, AILYN C', '', '', '', '', '', '2021-03-07', '', '0106843', '2021-03-07', '', '0106843', '6843', 0, 'user', 'img/default_profile.png'),
(554, 'QUIZON, CHRISTINE DE GUZMAN', '', '', '', '', '', '2021-03-07', '', '0097529', '2021-03-07', '', '0097529', '7529', 0, 'user', 'img/default_profile.png'),
(555, 'RAMIREZ, RAQUEL DESALIZA', '', '', '', '', '', '2021-03-07', '', '0102336', '2021-03-07', '', '0102336', '2336', 0, 'user', 'img/default_profile.png'),
(556, 'RAMISCAL, RAMENDO MENDOZA', '', '', '', '', '', '2021-03-07', '', '0080503', '2021-03-07', '', '0080503', '0503', 0, 'user', 'img/default_profile.png'),
(557, 'RAMOS, HALLEY ABRIEL YDEO', '', '', '', '', '', '2021-03-07', '', '0139081', '2021-03-07', '', '0139081', '9081', 0, 'user', 'img/default_profile.png'),
(558, 'RAMOS, JADE LIZABETH S', '', '', '', '', '', '2021-03-07', '', '0105246', '2021-03-07', '', '0105246', '5246', 0, 'user', 'img/default_profile.png'),
(559, 'RAMOS, MARY JANE CASTRO', '', '', '', '', '', '2021-03-07', '', '0106534', '2021-03-07', '', '0106534', '6534', 0, 'user', 'img/default_profile.png'),
(560, 'RAMOS, JR, ROSENDO NARCISO S', '', '', '', '', '', '2021-03-07', '', '0063808', '2021-03-07', '', '0063808', '3808', 0, 'user', 'img/default_profile.png'),
(561, 'RAZON, GERARD SICAT', '', '', '', '', '', '2021-03-07', '', '0096048', '2021-03-07', '', '0096048', '6048', 0, 'user', 'img/default_profile.png'),
(562, 'REA, LEONORA', '', '', '', '', '', '2021-03-07', '', '0080452', '2021-03-07', '', '0080452', '0452', 0, 'user', 'img/default_profile.png'),
(563, 'REBLANDO, MYRNA REMOT', '', '', '', '', '', '2021-03-07', '', '0047558', '2021-03-07', '', '0047558', '7558', 0, 'user', 'img/default_profile.png'),
(564, 'RELOJ-CHOI, JERNELYN PLACIDO', '', '', '', '', '', '2021-03-07', '', '0116777', '2021-03-07', '', '0116777', '6777', 0, 'user', 'img/default_profile.png'),
(565, 'REYES, ARISTOTLE LINGAT', '', '', '', '', '', '2021-03-07', '', '0119736', '2021-03-07', '', '0119736', '9736', 0, 'user', 'img/default_profile.png'),
(566, 'REYES, BERNADETTE RONQUILLO', '', '', '', '', '', '2021-03-07', '', '0050149', '2021-03-07', '', '0050149', '0149', 0, 'user', 'img/default_profile.png'),
(567, 'REYES, CHAD JOHN MARTIN U', '', '', '', '', '', '2021-03-07', '', '0096053', '2021-03-07', '', '0096053', '6053', 0, 'user', 'img/default_profile.png'),
(568, 'REYES, ERIC MANOLO SANTOS', '', '', '', '', '', '2021-03-07', '', '0062640', '2021-03-07', '', '0062640', '2640', 0, 'user', 'img/default_profile.png'),
(569, 'REYES, ETHEL', '', '', '', '', '', '2021-03-07', '', '0107193', '2021-03-07', '', '0107193', '7193', 0, 'user', 'img/default_profile.png'),
(570, 'REYES, NANCY JANE B', '', '', '', '', '', '2021-03-07', '', '0097330', '2021-03-07', '', '0097330', '7330', 0, 'user', 'img/default_profile.png'),
(571, 'REYNES, DANILO DEL MUNDO', '', '', '', '', '', '2021-03-07', '', '0065439', '2021-03-07', '', '0065439', '5439', 0, 'user', 'img/default_profile.png'),
(572, 'RICO, NOEL', '', '', '', '', '', '2021-03-07', '', '0070680', '2021-03-07', '', '0070680', '0680', 0, 'user', 'img/default_profile.png'),
(573, 'RIVERA, LILIBETH NEPOMUCENO', '', '', '', '', '', '2021-03-07', '', '0091552', '2021-03-07', '', '0091552', '1552', 0, 'user', 'img/default_profile.png'),
(574, 'RIVERA, NINA FRANCESCA LINDO', '', '', '', '', '', '2021-03-07', '', '0146254', '2021-03-07', '', '0146254', '6254', 0, 'user', 'img/default_profile.png'),
(575, 'RIVERA, PRINCESS MARIVIC DELA CRUZ', '', '', '', '', '', '2021-03-07', '', '0129362', '2021-03-07', '', '0129362', '9362', 0, 'user', 'img/default_profile.png'),
(576, 'ROA, KRISTINE A', '', '', '', '', '', '2021-03-07', '', '0101083', '2021-03-07', '', '0101083', 'MRLRoa302209', 0, 'user', 'img/default_profile.png'),
(577, 'ROJO, KRISTINE GAIL ROMERO', '', '', '', '', '', '2021-03-07', '', '0138431', '2021-03-07', '', '0138431', '8431', 0, 'user', 'img/default_profile.png'),
(578, 'ROJO, MA FELINA R', '', '', '', '', '', '2021-03-07', '', '0083165', '2021-03-07', '', '0083165', '3165', 0, 'user', 'img/default_profile.png'),
(579, 'ROMERO, IVY KAREN B', '', '', '', '', '', '2021-03-07', '', '0103477', '2021-03-07', '', '0103477', '3477', 0, 'user', 'img/default_profile.png'),
(580, 'ROMERO, MARIO', '', '', '', '', '', '2021-03-07', '', '0053679', '2021-03-07', '', '0053679', '3679', 0, 'user', 'img/default_profile.png'),
(581, 'ROMERO, RAYMOND DEANG', '', '', '', '', '', '2021-03-07', '', '0104033', '2021-03-07', '', '0104033', '4033', 0, 'user', 'img/default_profile.png'),
(582, 'ROMERO-SORRETA, JOY D', '', '', '', '', '', '2021-03-07', '', '0077059', '2021-03-07', '', '0077059', '7059', 0, 'user', 'img/default_profile.png'),
(583, 'ROSALES, RUDYARDO L', '', '', '', '', '', '2021-03-07', '', '0077059', '2021-03-07', '', '0041016', '1016', 0, 'user', 'img/default_profile.png'),
(584, 'ROXAS, MARK ANTHONY PUNO', '', '', '', '', '', '2021-03-07', '', '0147864', '2021-03-07', '', '0147864', '7864', 0, 'user', 'img/default_profile.png'),
(585, 'SABIO, LEO VALDEHUESA', '', '', '', '', '', '2021-03-07', '', '0025769', '2021-03-07', '', '0025769', '5769', 0, 'user', 'img/default_profile.png'),
(586, 'SADSAD, GOLDWIN QUIAZON', '', '', '', '', '', '2021-03-07', '', '0140090', '2021-03-07', '', '0140090', '0090', 0, 'user', 'img/default_profile.png'),
(587, 'SALANGAD, JON VAN A', '', '', '', '', '', '2021-03-07', '', '0126692', '2021-03-07', '', '0126692', '6692', 0, 'user', 'img/default_profile.png'),
(588, 'SALANGAD, NORBERTO Q', '', '', '', '', '', '2021-03-07', '', '0013782', '2021-03-07', '', '0013782', '3782', 0, 'user', 'img/default_profile.png'),
(589, 'SALANGAD, ROSELYN A', '', '', '', '', '', '2021-03-07', '', '0099504', '2021-03-07', '', '0099504', '9504', 0, 'user', 'img/default_profile.png'),
(590, 'SALAS-PANGILINAN, LYZETTE VIRAY', '', '', '', '', '', '2021-03-07', '', '0116564', '2021-03-07', '', '0116564', '6564', 0, 'user', 'img/default_profile.png'),
(591, 'SALCEDO, DANIEL M', '', '', '', '', '', '2021-03-07', '', '0056825', '2021-03-07', '', '0056825', '6825', 0, 'user', 'img/default_profile.png'),
(592, 'SALUNGA, MARIE ADRIANNE G', '', '', '', '', '', '2021-03-07', '', '0096949', '2021-03-07', '', '0096949', '6949', 0, 'user', 'img/default_profile.png'),
(593, 'SAMERA, RENATO P', '', '', '', '', '', '2021-03-07', '', '0101846', '2021-03-07', '', '0101846', '1846', 0, 'user', 'img/default_profile.png'),
(594, 'SAMONTE, MELBEN PALO', '', '', '', '', '', '2021-03-07', '', '0082367', '2021-03-07', '', '0082367', '2367', 0, 'user', 'img/default_profile.png'),
(595, 'SAMPANG, MARIA CLARITA GARCIA', '', '', '', '', '', '2021-03-07', '', '0098677', '2021-03-07', '', '0098677', '8677', 0, 'user', 'img/default_profile.png'),
(596, 'SAMPANG, RICO Y', '', '', '', '', '', '2021-03-07', '', '0081797', '2021-03-07', '', '0081797', '1797', 0, 'user', 'img/default_profile.png'),
(597, 'SAMSON, ADEL VERGEL DIZON', '', '', '', '', '', '2021-03-07', '', '0077846', '2021-03-07', '', '0077846', '7846', 0, 'user', 'img/default_profile.png'),
(598, 'SAN ANDRES, NEIL GALANG', '', '', '', '', '', '2021-03-07', '', '0103956', '2021-03-07', '', '0103956', '3956', 0, 'user', 'img/default_profile.png'),
(599, 'SAN JOSE, CRISOSTOMO Z', '', '', '', '', '', '2021-03-07', '', '0071435', '2021-03-07', '', '0071435', '1435', 0, 'user', 'img/default_profile.png'),
(600, 'SAN JOSE, MILLICENT R', '', '', '', '', '', '2021-03-07', '', '0082250', '2021-03-07', '', '0082250', '2250', 0, 'user', 'img/default_profile.png'),
(601, 'SANCHEZ, ANITA S', '', '', '', '', '', '2021-03-07', '', '0066174', '2021-03-07', '', '0066174', '6174', 0, 'user', 'img/default_profile.png'),
(602, 'SANGALANG, JUANITO G', '', '', '', '', '', '2021-03-07', '', '0074476', '2021-03-07', '', '0074476', '4476', 0, 'user', 'img/default_profile.png'),
(603, 'LYNNETH ', 'Naguit', 'Santiago', '1584 Gonzales ave. San vicente, apalit, pampanga', '09258161031', 'lynneth.santiago@gmail.com', '1975-10-30', 'C-8-900', '0098400', '2023-10-30', 'Community medicine, occupational medicine', '0098400', '0515', 1, 'user', 'img/default_profile.png'),
(604, 'SANTIAGO, MARC REINALD G', '', '', '', '', '', '2021-03-07', '', '0105682', '2021-03-07', '', '0105682', '5682', 0, 'user', 'img/default_profile.png'),
(605, 'SANTOS, AILEEN PINEDA', '', '', '', '', '', '2021-03-07', '', '0108664', '2021-03-07', '', '0108664', '8664', 0, 'user', 'img/default_profile.png'),
(606, 'SANTOS, FERNANDO RENE M', '', '', '', '', '', '2021-03-07', '', '0097554', '2021-03-07', '', '0097554', '7554', 0, 'user', 'img/default_profile.png'),
(607, 'SANTOS, LENARIO T', '', '', '', '', '', '2021-03-07', '', '0054673', '2021-03-07', '', '0054673', '4673', 0, 'user', 'img/default_profile.png'),
(608, 'SANTOS, MARK STEPHEN ROGER PATAWARAN', '', '', '', '', '', '2021-03-07', '', '0142881', '2021-03-07', '', '0142881', '2881', 0, 'user', 'img/default_profile.png'),
(609, 'SANTOS, ROGELIO L', '', '', '', '', '', '2021-03-07', '', '0041043', '2021-03-07', '', '0041043', '1043', 0, 'user', 'img/default_profile.png'),
(610, 'SANTOS, ROWENA BONIFACIO', '', '', '', '', '', '2021-03-07', '', '0078638', '2021-03-07', '', '0078638', '8638', 0, 'user', 'img/default_profile.png'),
(611, 'SANTOS, VEREDIGNA S', '', '', '', '', '', '2021-03-07', '', '0066989', '2021-03-07', '', '0066989', '031536', 0, 'user', 'img/default_profile.png'),
(612, 'SAPNU, KARREN KAYE R', '', '', '', '', '', '2021-03-07', '', '0109709', '2021-03-07', '', '0109709', '9709', 0, 'user', 'img/default_profile.png'),
(613, 'SAPORNE, JOSE T', '', '', '', '', '', '2021-03-07', '', '0119730', '2021-03-07', '', '0119730', '9730', 0, 'user', 'img/default_profile.png'),
(614, 'SARMIENTO, CHRISTINE ANNE R', '', '', '', '', '', '2021-03-07', '', '0108178', '2021-03-07', '', '0108178', '8178', 0, 'user', 'img/default_profile.png');
INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `mailing_address`, `contact_num`, `email`, `birthday`, `pma_number`, `prc_number`, `expiration_date`, `field_of_practice`, `username`, `password`, `is_update`, `level_access`, `profile_image`) VALUES
(615, 'SARMIENTO, NONNATUS PARAS', '', '', '', '', '', '2021-03-07', '', '0063688', '2021-03-07', '', '0063688', '3688', 0, 'user', 'img/default_profile.png'),
(616, 'SARMIENTO, VINCENT P', '', '', '', '', '', '2021-03-07', '', '0088025', '2021-03-07', '', '0088025', '8025', 0, 'user', 'img/default_profile.png'),
(617, 'SERRANO, ROMMEL L', '', '', '', '', '', '2021-03-07', '', '0090741', '2021-03-07', '', '0090741', '0741', 0, 'user', 'img/default_profile.png'),
(618, 'SIAPENGCO, ALIZER P', '', '', '', '', '', '2021-03-07', '', '0082056', '2021-03-07', '', '0082056', '2056', 0, 'user', 'img/default_profile.png'),
(619, 'SIBAL, JOHN CARLO MANALO', '', '', '', '', '', '2021-03-07', '', '0126190', '2021-03-07', '', '0126190', '6190', 0, 'user', 'img/default_profile.png'),
(620, 'SIBAL, JOSEPHUS PINEDA', '', '', '', '', '', '2021-03-07', '', '0105681', '2021-03-07', '', '0105681', '5681', 0, 'user', 'img/default_profile.png'),
(621, 'SIBAL, MARK JOSEPH PINEDA', '', '', '', '', '', '2021-03-07', '', '0131796', '2021-03-07', '', '0131796', '1796', 0, 'user', 'img/default_profile.png'),
(622, 'SIBUG, ROSALIE CABRAL', '', '', '', '', '', '2021-03-07', '', '0142726', '2021-03-07', '', '0142726', '2726', 0, 'user', 'img/default_profile.png'),
(623, 'LOU ANTHONY', 'SANTOS', 'SICO', '153 Ma. Myrna St., Villa Gloria Subd., Angeles City', '09232273237 / 09186770130', 'lousico153@gmail.com', '1988-03-15', 'C-8-1066-0140091', '0140091', '2024-03-15', 'Occupational Medicine', '0140091', 'sico0140091', 1, 'user', 'img/default_profile.png'),
(624, 'SICO, LUISITO L', '', '', '', '', '', '2021-03-07', '', '0065932', '2021-03-07', '', '0065932', '5932', 0, 'user', 'img/default_profile.png'),
(625, 'SILANG, ISHMAEL N', '', '', '', '', '', '2021-03-07', '', '0068291', '2021-03-07', '', '0068291', '8291', 0, 'user', 'img/default_profile.png'),
(626, 'SILANG, JEAN MARLENE VELASCO', '', '', '', '', '', '2021-03-07', '', '0063896', '2021-03-07', '', '0063896', '3896', 0, 'user', 'img/default_profile.png'),
(627, 'SIMBULAN, LEAN ANGELO DEALA', '', '', '', '', '', '2021-03-07', '', '0144082', '2021-03-07', '', '0144082', '4082', 0, 'user', 'img/default_profile.png'),
(628, 'SIMPAO, JEFFREY DIMALANTA', '', '', '', '', '', '2021-03-07', '', '0123358', '2021-03-07', '', '0123358', '3358', 0, 'user', 'img/default_profile.png'),
(629, 'SIMPAUCO, JAN NOEL L', '', '', '', '', '', '2021-03-07', '', '0134360', '2021-03-07', '', '0134360', '4360', 0, 'user', 'img/default_profile.png'),
(630, 'SISCAR, AILEEN L', '', '', '', '', '', '2021-03-07', '', '0101271', '2021-03-07', '', '0101271', '1271', 0, 'user', 'img/default_profile.png'),
(631, 'SISON, DOMINGO FILEX G', '', '', '', '', '', '2021-03-07', '', '0087926', '2021-03-07', '', '0087926', '7926', 0, 'user', 'img/default_profile.png'),
(632, 'SOLAS, MYRA CASIPLE', '', '', '', '', '', '2021-03-07', '', '0123680', '2021-03-07', '', '0123680', '3680', 0, 'user', 'img/default_profile.png'),
(633, 'SONGCO, BERNADETT A', '', '', '', '', '', '2021-03-07', '', '0134565', '2021-03-07', '', '0134565', '4565', 0, 'user', 'img/default_profile.png'),
(634, 'SONGCO, RICARDO DAVID', '', '', '', '', '', '2021-03-07', '', '0049242', '2021-03-07', '', '0049242', '9242', 0, 'user', 'img/default_profile.png'),
(635, 'SUAREZ, RAMON JOSE F', '', '', '', '', '', '2021-03-07', '', '0103001', '2021-03-07', '', '0103001', '3001', 0, 'user', 'img/default_profile.png'),
(636, 'SUAZON, CHRISTOPHER M', '', '', '', '', '', '2021-03-07', '', '0099161', '2021-03-07', '', '0099161', '9161', 0, 'user', 'img/default_profile.png'),
(637, 'SUGAY, ISSER N', '', '', '', '', '', '2021-03-07', '', '0108721', '2021-03-07', '', '0108721', '8721', 0, 'user', 'img/default_profile.png'),
(638, 'SULIT, BRYAN PAUL DELFIN', '', '', '', '', '', '2021-03-07', '', '0095224', '2021-03-07', '', '0095224', '5224', 0, 'user', 'img/default_profile.png'),
(639, 'SUNGA, HAROLD C', '', '', '', '', '', '2021-03-07', '', '0107162', '2021-03-07', '', '0107162', '7162', 0, 'user', 'img/default_profile.png'),
(640, 'SUNGLAO-VILLANUEVA, ROSE ANNE TIBERIO', '', '', '', '', '', '2021-03-07', '', '0115039', '2021-03-07', '', '0115039', '5039', 0, 'user', 'img/default_profile.png'),
(641, 'SUPAN, MA THERESA JINGCO', '', '', '', '', '', '2021-03-07', '', '0111200', '2021-03-07', '', '0111200', '1200', 0, 'user', 'img/default_profile.png'),
(642, 'SUPAN, RUBEN A', '', '', '', '', '', '2021-03-07', '', '0097044', '2021-03-07', '', '0097044', '7044', 0, 'user', 'img/default_profile.png'),
(643, 'SUSI-PRING, RUTH T', '', '', '', '', '', '2021-03-07', '', '0092591', '2021-03-07', '', '0092591', '2591', 0, 'user', 'img/default_profile.png'),
(644, 'SY, EILEEN C', '', '', '', '', '', '2021-03-07', '', '0074789', '2021-03-07', '', '0074789', '4789', 0, 'user', 'img/default_profile.png'),
(645, 'SY, GEORGE A', '', '', '', '', '', '2021-03-07', '', '0057339', '2021-03-07', '', '0057339', '7339', 0, 'user', 'img/default_profile.png'),
(646, 'TABLANTE, EMILIANO BAULA', '', '', '', '', '', '2021-03-07', '', '0060383', '2021-03-07', '', '0060383', '0383', 0, 'user', 'img/default_profile.png'),
(647, 'TABLANTE, MA ROSARIO VICTORIA C', '', '', '', '', '', '2021-03-07', '', '0124065', '2021-03-07', '', '0124065', '4065', 0, 'user', 'img/default_profile.png'),
(648, 'TALENTO, ALDRINE CARLO CUENCO', '', '', '', '', '', '2021-03-07', '', '0147000', '2021-03-07', '', '0147000', '7000', 0, 'user', 'img/default_profile.png'),
(649, 'TAN, AMELIA MIRANDA', '', '', '', '', '', '2021-03-07', '', '0044069', '2021-03-07', '', '0044069', '4069', 0, 'user', 'img/default_profile.png'),
(650, 'EDWARD', 'DAYRIT', 'TAN', '36-17 Sunset Drive Carmenville Subd Angeles City', '09175225825', 'tan_edmd@yahoo.com', '1958-06-21', 'C 8 40', '0058269', '2020-06-21', 'Dermatology', '0058269', 'acms575', 1, 'user', 'img/assets/PhotoID-650-2021-03-11-15-51-39.jpeg'),
(651, 'TAN, REMIGIO E', '', '', '', '', '', '2021-03-07', '', '0044245', '2021-03-07', '', '0044245', '4245', 0, 'user', 'img/default_profile.png'),
(652, 'TANGLAO, DON PEPITO C', '', '', '', '', '', '2021-03-07', '', '0039669', '2021-03-07', '', '0039669', '9669', 0, 'user', 'img/default_profile.png'),
(653, 'TANGLAO, JOHN T', '', '', '', '', '', '2021-03-07', '', '0079549', '2021-03-07', '', '0079549', '9549', 0, 'user', 'img/default_profile.png'),
(654, 'TANGLAO, ROLAND SOTERO', '', '', '', '', '', '2021-03-07', '', '0079706', '2021-03-07', '', '0079706', '9706', 0, 'user', 'img/default_profile.png'),
(655, 'TANHUECO, CHERIANE CANLAS', '', '', '', '', '', '2021-03-07', '', '0104364', '2021-03-07', '', '0104364', '4364', 0, 'user', 'img/default_profile.png'),
(656, 'TANJUAKIO, ERNESTO D', '', '', '', '', '', '2021-03-07', '', '0033497', '2021-03-07', '', '0033497', '3497', 0, 'user', 'img/default_profile.png'),
(657, 'Rocelle', 'Tantingco', 'Manalo', '36-16 Street 1 , Carmenville Subd , Angeles City', '09178666612', 'rpt_manalo@yahoo.com', '1967-02-16', 'C-8-939', '0079629', '2024-02-16', 'Family Medicine', '0079629', 'love', 1, 'user', 'img/assets/PhotoID-657-2021-03-10-22-58-56.jpeg'),
(658, 'TARUC, MARIA CAROLINA VALENCIA', '', '', '', '', '', '2021-03-07', '', '0063678', '2021-03-07', '', '0063678', '3678', 0, 'user', 'img/default_profile.png'),
(659, 'TAYAG, ERIN CATHRINA NARCISO', '', '', '', '', '', '2021-03-07', '', '0116166', '2021-03-07', '', '0116166', '6166', 0, 'user', 'img/default_profile.png'),
(660, 'TAYAG, ERVIN CHINO NARCISO', '', '', '', '', '', '2021-03-07', '', '0123386', '2021-03-07', '', '0123386', '3386', 0, 'user', 'img/default_profile.png'),
(661, 'TAYAG, RICARDO', '', '', '', '', '', '2021-03-07', '', '0008323', '2021-03-07', '', '0008323', '8323', 0, 'user', 'img/default_profile.png'),
(662, 'TE, BETTY CHUA', '', '', '', '', '', '2021-03-07', '', '0046470', '2021-03-07', '', '0046470', '6470', 0, 'user', 'img/default_profile.png'),
(663, 'TECSON-TAN, MARIA JOSEFINA R', '', '', '', '', '', '2021-03-07', '', '0113290', '2021-03-07', '', '0113290', '3290', 0, 'user', 'img/default_profile.png'),
(664, 'TEJADA, FERNANDO MIGUEL CLEMENTE', '', '', '', '', '', '2021-03-07', '', '0131816', '2021-03-07', '', '0131816', '1816', 0, 'user', 'img/default_profile.png'),
(665, 'TEODORO, JUAN PAOLO V', '', '', '', '', '', '2021-03-07', '', '0112546', '2021-03-07', '', '0112546', '2546', 0, 'user', 'img/default_profile.png'),
(666, 'TIAMSON, EDEL MARLA SANTOS', '', '', '', '', '', '2021-03-07', '', '0075814', '2021-03-07', '', '0075814', '5814', 0, 'user', 'img/default_profile.png'),
(667, 'TIANGCO, MARK HOMER GUILLERMO T', '', '', '', '', '', '2021-03-07', '', '0094309', '2021-03-07', '', '0094309', '4309', 0, 'user', 'img/default_profile.png'),
(668, 'TIBAYAN, BRIAN ANDREI GUEVARRA', '', '', '', '', '', '2021-03-07', '', '0142421', '2021-03-07', '', '0142421', '2421', 0, 'user', 'img/default_profile.png'),
(669, 'TICSAY, DANIEL', '', '', '', '', '', '2021-03-07', '', '0118675', '2021-03-07', '', '0118675', '8675', 0, 'user', 'img/default_profile.png'),
(670, 'TIGLAO, ADORA GAYE V', '', '', '', '', '', '2021-03-07', '', '0123058', '2021-03-07', '', '0123058', '3058', 0, 'user', 'img/default_profile.png'),
(671, 'TIGLAO, JACQUELINE DELA CRUZ', '', '', '', '', '', '2021-03-07', '', '0126057', '2021-03-07', '', '0126057', '6057', 0, 'user', 'img/default_profile.png'),
(672, 'TIMBOL, AEDEN BERNICE GUECO', '', '', '', '', '', '2021-03-07', '', '0121648', '2021-03-07', '', '0121648', '1648', 0, 'user', 'img/default_profile.png'),
(673, 'TIMBOL, EDGAR WILSON GUECO', '', '', '', '', '', '2021-03-07', '', '0114055', '2021-03-07', '', '0114055', '4055', 0, 'user', 'img/default_profile.png'),
(674, 'TIMBOL, EDGARDO S', '', '', '', '', '', '2021-03-07', '', '0049791', '2021-03-07', '', '0049791', '9791', 0, 'user', 'img/default_profile.png'),
(675, 'TIMBOL, MARIA KATHRINA SB', '', '', '', '', '', '2021-03-07', '', '0128665', '2021-03-07', '', '0128665', '8665', 0, 'user', 'img/default_profile.png'),
(676, 'Brian', 'Lagman', 'Tiopengco', 'B7L4 Royal Palm, St. Kolbe Estate 1, City of San Fernando, Pampanga', '09322165148 ', 'brian_tiopengco@yahoo.com', '1987-02-15', 'C-8-1002-0125436', '0125436', '2022-02-15', 'Pediatrics', '0125436', 'Kuwatog0215', 1, 'user', 'img/default_profile.png'),
(677, 'TO, STEPHEN S', '', '', '', '', '', '2021-03-07', '', '0096551', '2021-03-07', '', '0096551', '6551', 0, 'user', 'img/default_profile.png'),
(678, 'TOLENTINO, ANGELO M', '', '', '', '', '', '2021-03-07', '', '0087925', '2021-03-07', '', '0087925', '7925', 0, 'user', 'img/default_profile.png'),
(679, 'TOLENTINO, ANN MARY ULAMA', '', '', '', '', '', '2021-03-07', '', '0083156', '2021-03-07', '', '0083156', '3156', 0, 'user', 'img/default_profile.png'),
(680, 'TOLENTINO, ROMMEL ENRIQUEZ', '', '', '', '', '', '2021-03-07', '', '0080422', '2021-03-07', '', '0080422', '0422', 0, 'user', 'img/default_profile.png'),
(681, 'TOLENTINO, TYREL ENRIQUEZ', '', '', '', '', '', '2021-03-07', '', '0092367', '2021-03-07', '', '0092367', '2367', 0, 'user', 'img/default_profile.png'),
(682, 'TOMIAMPOS, ANNES B', '', '', '', '', '', '2021-03-07', '', '0120294', '2021-03-07', '', '0120294', '0294', 0, 'user', 'img/default_profile.png'),
(683, 'TONGOL, EUGENE A', '', '', '', '', '', '2021-03-07', '', '0096530', '2021-03-07', '', '0096530', '6530', 0, 'user', 'img/default_profile.png'),
(684, 'TORNO, CARMELITA ALLANIGUE', '', '', '', '', '', '2021-03-07', '', '0053791', '2021-03-07', '', '0053791', '3791', 0, 'user', 'img/default_profile.png'),
(685, 'TORNO, CORSINO BALUS', '', '', '', '', '', '2021-03-07', '', '0052295', '2021-03-07', '', '0052295', '2295', 0, 'user', 'img/default_profile.png'),
(686, 'TORNO, EDUARDO P', '', '', '', '', '', '2021-03-07', '', '0120010', '2021-03-07', '', '0120010', '0010', 0, 'user', 'img/default_profile.png'),
(687, 'TORRES, ALFREDO', '', '', '', '', '', '2021-03-07', '', '0049399', '2021-03-07', '', '0049399', '9399', 0, 'user', 'img/default_profile.png'),
(688, 'TORRES, CARLOMAGNO DALUZ', '', '', '', '', '', '2021-03-07', '', '0047698', '2021-03-07', '', '0047698', '7698', 0, 'user', 'img/default_profile.png'),
(689, 'TORRES, JIMCER', '', '', '', '', '', '2021-03-07', '', '0069728', '2021-03-07', '', '0069728', '9728', 0, 'user', 'img/default_profile.png'),
(690, 'TORRES, KARA MELISSA T', '', '', '', '', '', '2021-03-07', '', '0118117', '2021-03-07', '', '0118117', '8117', 0, 'user', 'img/default_profile.png'),
(691, 'TORRES, NILA TIANGCO', '', '', '', '', '', '2021-03-07', '', '0047682', '2021-03-07', '', '0047682', '7682', 0, 'user', 'img/default_profile.png'),
(692, 'TRANQUILINO, PANCHO CARLO PAMINTUAN', '', '', '', '', '', '2021-03-07', '', '0123460', '2021-03-07', '', '0123460', '3460', 0, 'user', 'img/default_profile.png'),
(693, 'TRANQUILINO, JR, JOSE MA PASCUAL', '', '', '', '', '', '2021-03-07', '', '0047701', '2021-03-07', '', '0047701', '7701', 0, 'user', 'img/default_profile.png'),
(694, 'TRINIDAD, MA ROSELLE DIAZ', '', '', '', '', '', '2021-03-07', '', '0099845', '2021-03-07', '', '0099845', '9845', 0, 'user', 'img/default_profile.png'),
(695, 'TUAZON, ADELFO T', '', '', '', '', '', '2021-03-07', '', '0044254', '2021-03-07', '', '0044254', '4254', 0, 'user', 'img/default_profile.png'),
(696, 'TUAZON, ALAIN BLUE D', '', '', '', '', '', '2021-03-07', '', '0109625', '2021-03-07', '', '0109625', '9625', 0, 'user', 'img/default_profile.png'),
(697, 'TUAZON, CHERYL ADELINE PARAS', '', '', '', '', '', '2021-03-07', '', '0148982', '2021-03-07', '', '0148982', '8982', 0, 'user', 'img/default_profile.png'),
(698, 'TUAZON, EDITHA COLOMA', '', '', '', '', '', '2021-03-07', '', '0068583', '2021-03-07', '', '0068583', '8583', 0, 'user', 'img/default_profile.png'),
(699, 'TUAZON, JOSE VICENTE A', '', '', '', '', '', '2021-03-07', '', '0123398', '2021-03-07', '', '0123398', '3398', 0, 'user', 'img/default_profile.png'),
(700, 'TUAZON, KELVIN LOUIES PARAS', '', '', '', '', '', '2021-03-07', '', '0126519', '2021-03-07', '', '0126519', '6519', 0, 'user', 'img/default_profile.png'),
(701, 'TUAZON, MARIA CHERYL PARAS', '', '', '', '', '', '2021-03-07', '', '0055464', '2021-03-07', '', '0055464', '5464', 0, 'user', 'img/default_profile.png'),
(702, 'TUAZON, REINERIO TANJUAQUIO', '', '', '', '', '', '2021-03-07', '', '0064908', '2021-03-07', '', '0064908', '4908', 0, 'user', 'img/default_profile.png'),
(703, 'TUAZON, JR, ADELFO P', '', '', '', '', '', '2021-03-07', '', '0115187', '2021-03-07', '', '0115187', '5187', 0, 'user', 'img/default_profile.png'),
(704, 'TULUD, HERNAND BAUZON', '', '', '', '', '', '2021-03-07', '', '0078324', '2021-03-07', '', '0078324', '8324', 0, 'user', 'img/default_profile.png'),
(705, 'TULUD, TRISTAN BAUZON', '', '', '', '', '', '2021-03-07', '', '0071850', '2021-03-07', '', '0071850', '1850', 0, 'user', 'img/default_profile.png'),
(706, 'TUMANG, KATRINA JOY AGUAS', '', '', '', '', '', '2021-03-07', '', '0139561', '2021-03-07', '', '0139561', '9561', 0, 'user', 'img/default_profile.png'),
(707, 'TUNGOL, ABENIR L', '', '', '', '', '', '2021-03-07', '', '0049033', '2021-03-07', '', '0049033', '9033', 0, 'user', 'img/default_profile.png'),
(708, 'TUVERA, HEIDI B', '', '', '', '', '', '2021-03-07', '', '0092826', '2021-03-07', '', '0092826', '2826', 0, 'user', 'img/default_profile.png'),
(709, 'UDARBE, DEBBIE LYN AQUINO', '', '', '', '', '', '2021-03-07', '', '0119877', '2021-03-07', '', '0119877', '9877', 0, 'user', 'img/default_profile.png'),
(710, 'UMALI, KATHRYN CECILLE R', '', '', '', '', '', '2021-03-07', '', '0116729', '2021-03-07', '', '0116729', '6729', 0, 'user', 'img/default_profile.png'),
(711, 'UNTALAN, MELISSA ISLA', '', '', '', '', '', '2021-03-07', '', '0077163', '2021-03-07', '', '0077163', '7163', 0, 'user', 'img/default_profile.png'),
(712, 'Melody', 'Bamba', 'Ursal', '717 Mc Arthur Highway San Francisco Mabalacat Pampanga', '09171196768', 'melodyursal6186@gmail.com', '1986-06-01', 'C-1286-131828', '0131828', '2021-06-01', 'Internal Medicine', '0131828', 'Charmed01(y)', 1, 'user', 'img/default_profile.png'),
(713, 'UY, LOLITA WONG', '', '', '', '', '', '2021-03-07', '', '0062081', '2021-03-07', '', '0062081', '2081', 0, 'user', 'img/default_profile.png'),
(714, 'UY CANA, DENNIS NIU', '', '', '', '', '', '2021-03-07', '', '0051824', '2021-03-07', '', '0051824', '1824', 0, 'user', 'img/default_profile.png'),
(715, 'VALENZONA, GALAHAD C', '', '', '', '', '', '2021-03-07', '', '0104121', '2021-03-07', '', '0104121', '4121', 0, 'user', 'img/default_profile.png'),
(716, 'VALERIO, AMIEL S', '', '', '', '', '', '2021-03-07', '', '0092762', '2021-03-07', '', '0092762', '2762', 0, 'user', 'img/default_profile.png'),
(717, 'VALERIO, MARIA ROWENA B', '', '', '', '', '', '2021-03-07', '', '0096685', '2021-03-07', '', '0096685', '6685', 0, 'user', 'img/default_profile.png'),
(718, 'VARGAS, VICTOR G', '', '', '', '', '', '2021-03-07', '', '0083485', '2021-03-07', '', '0083485', '3485', 0, 'user', 'img/default_profile.png'),
(719, 'VELASQUEZ, MELISSA AQUINO', '', '', '', '', '', '2021-03-07', '', '0113318', '2021-03-07', '', '0113318', 'Kckenkassy08', 0, 'user', 'img/default_profile.png'),
(720, 'VELEZ, RICHARD UY', '', '', '', '', '', '2021-03-07', '', '0055369', '2021-03-07', '', '0055369', '5369', 0, 'user', 'img/default_profile.png'),
(721, 'VICENTE-PASCUAL, BEATRICE SANTOS', '', '', '', '', '', '2021-03-07', '', '0069596', '2021-03-07', '', '0069596', '9596', 0, 'user', 'img/default_profile.png'),
(722, 'VILLACORTA, SUSAN PATRICIA B', '', '', '', '', '', '2021-03-07', '', '0095246', '2021-03-07', '', '0095246', '5246', 0, 'user', 'img/default_profile.png'),
(723, 'VILLALUNA, RICHARD ARTHUR LECHONSITO', '', '', '', '', '', '2021-03-07', '', '0119846', '2021-03-07', '', '0119846', '9846', 0, 'user', 'img/default_profile.png'),
(724, 'VILLAMOR, MARIVIC A', '', '', '', '', '', '2021-03-07', '', '0063861', '2021-03-07', '', '0063861', '3861', 0, 'user', 'img/default_profile.png'),
(725, 'VILLAMUCHO, NOEL', '', '', '', '', '', '2021-03-07', '', '0045607', '2021-03-07', '', '0045607', '5607', 0, 'user', 'img/default_profile.png'),
(726, 'VILLANUEVA, DENISE DELIARTE', '', '', '', '', '', '2021-03-07', '', '0138710', '2021-03-07', '', '0138710', '8710', 0, 'user', 'img/default_profile.png'),
(727, 'VILLANUEVA, LORINA D', '', '', '', '', '', '2021-03-07', '', '0054121', '2021-03-07', '', '0054121', '4121', 0, 'user', 'img/default_profile.png'),
(728, 'VILLANUEVA, SHERRYL J', '', '', '', '', '', '2021-03-07', '', '0116818', '2021-03-07', '', '0116818', '6818', 0, 'user', 'img/default_profile.png'),
(729, 'VILLANUEVA, JR, GAUDENCIO A', '', '', '', '', '', '2021-03-07', '', '0054670', '2021-03-07', '', '0054670', '4670', 0, 'user', 'img/default_profile.png'),
(730, 'VILLARIN, FRANCEL V', '', '', '', '', '', '2021-03-07', '', '0101929', '2021-03-07', '', '0101929', '1929', 0, 'user', 'img/default_profile.png'),
(731, 'VILLARRUZ, MA VIVIAN VIRAY', '', '', '', '', '', '2021-03-07', '', '0058870', '2021-03-07', '', '0058870', '8870', 0, 'user', 'img/default_profile.png'),
(732, 'VILLARUEL, LUDOVICO R', '', '', '', '', '', '2021-03-07', '', '0051055', '2021-03-07', '', '0051055', '1055', 0, 'user', 'img/default_profile.png'),
(733, 'VILLAZOR, LUZ DATU', '', '', '', '', '', '2021-03-07', '', '0026284', '2021-03-07', '', '0026284', '6284', 0, 'user', 'img/default_profile.png'),
(734, 'VITUG, VYERON PEARL PARAS', '', '', '', '', '', '2021-03-07', '', '0131712', '2021-03-07', '', '0131712', '1712', 0, 'user', 'img/default_profile.png'),
(735, 'VIVARES, EDWIN', '', '', '', '', '', '2021-03-07', '', '0047766', '2021-03-07', '', '0047766', '7766', 0, 'user', 'img/default_profile.png'),
(736, 'VIZCAYNO, VINCE BRYAN BONDOC', '', '', '', '', '', '2021-03-07', '', '0137575', '2021-03-07', '', '0137575', '7575', 0, 'user', 'img/default_profile.png'),
(737, 'WANIA, JIMMY E', '', '', '', '', '', '2021-03-07', '', '0042577', '2021-03-07', '', '0042577', '2577', 0, 'user', 'img/default_profile.png'),
(738, 'YABUT, ISAGANI C', '', '', '', '', '', '2021-03-07', '', '0097444', '2021-03-07', '', '0097444', '7444', 0, 'user', 'img/default_profile.png'),
(739, 'YALUNG, SUZETTE V', '', '', '', '', '', '2021-03-07', '', '0060742', '2021-03-07', '', '0060742', '0742', 0, 'user', 'img/default_profile.png'),
(740, 'YAMBAO, MA LOURDES TUAZON', '', '', '', '', '', '2021-03-07', '', '0126025', '2021-03-07', '', '0126025', '6025', 0, 'user', 'img/default_profile.png'),
(741, 'YAMBAO, PAUL EMMANUEL LUGTU', '', '', '', '', '', '2021-03-07', '', '0131890', '2021-03-07', '', '0131890', '1890', 0, 'user', 'img/default_profile.png'),
(742, 'YAMZON, NOEL G', '', '', '', '', '', '2021-03-07', '', '0054671', '2021-03-07', '', '0054671', '4671', 0, 'user', 'img/default_profile.png'),
(743, 'YANG, RICARDO S', '', '', '', '', '', '2021-03-07', '', '0061281', '2021-03-07', '', '0061281', '1281', 0, 'user', 'img/default_profile.png'),
(744, 'Maria Minnie', 'Uy', 'Yao', '41 Dona Gloria Ave Villa Gloria Subd Angeles  Ciity', '09175111778', 'minnie_jo2003@yahoo.com', '1972-01-01', '08719', '0093671', '2024-01-01', 'Otolaryngology Head and Neck Surgery', '0093671', 'Minnie010172', 1, 'user', 'img/default_profile.png'),
(745, 'YAP, ALEXANDER T', '', '', '', '', '', '2021-03-07', '', '0054439', '2021-03-07', '', '0054439', '4439', 0, 'user', 'img/default_profile.png'),
(746, 'YAP, JUDITH IZZA CUNANAN', '', '', '', '', '', '2021-03-07', '', '0119919', '2021-03-07', '', '0119919', '9919', 0, 'user', 'img/default_profile.png'),
(747, 'YAP, JUSTINE IRIS C', '', '', '', '', '', '2021-03-07', '', '0109070', '2021-03-07', '', '0109070', '9070', 0, 'user', 'img/default_profile.png'),
(748, 'YOSUICO, ARNOLD TIMOTHY D', '', '', '', '', '', '2021-03-07', '', '0057197', '2021-03-07', '', '0057197', '7197', 0, 'user', 'img/default_profile.png'),
(749, 'YOSUICO, EUGENIO R', '', '', '', '', '', '2021-03-07', '', '0061438', '2021-03-07', '', '0061438', '1438', 0, 'user', 'img/default_profile.png'),
(750, 'YTURRALDE, ERICK MARTIN HALAL', '', '', '', '', '', '2021-03-07', '', '0128644', '2021-03-07', '', '0128644', '8644', 0, 'user', 'img/default_profile.png'),
(751, 'YTURRALDE, MARIE CARMINA SABARRE', '', '', '', '', '', '2021-03-07', '', '0093723', '2021-03-07', '', '0093723', '3723', 0, 'user', 'img/default_profile.png'),
(752, 'YTURRALDE, MARIETTA L', '', '', '', '', '', '2021-03-07', '', '0022435', '2021-03-07', '', '0022435', '2435', 0, 'user', 'img/default_profile.png'),
(753, 'YUMIACO, EVELYN B', '', '', '', '', '', '2021-03-07', '', '0079844', '2021-03-07', '', '0079844', '9844', 0, 'user', 'img/default_profile.png'),
(754, 'YUMUL, ARVIN ROMERO', '', '', '', '', '', '2021-03-07', '', '0120480', '2021-03-07', '', '0120480', '0480', 0, 'user', 'img/default_profile.png'),
(755, 'YUMUL, NORBERTO P', '', '', '', '', '', '2021-03-07', '', '0053180', '2021-03-07', '', '0053180', '3180', 0, 'user', 'img/default_profile.png'),
(756, 'YUSI, JAN AXEL LOPEZ', '', '', '', '', '', '2021-03-07', '', '0137577', '2021-03-07', '', '0137577', '7577', 0, 'user', 'img/default_profile.png'),
(757, 'ZABLAN, MARANATHA MONTALBAN', '', '', '', '', '', '2021-03-07', '', '0098938', '2021-03-07', '', '0098938', '8938', 0, 'user', 'img/default_profile.png'),
(758, 'ZALAMEA, CONCHITA MADAYAG', '', '', '', '', '', '2021-03-07', '', '0040817', '2021-03-07', '', '0040817', '0817', 0, 'user', 'img/default_profile.png'),
(759, 'ZAMBRANO, NOREEN CALICA', '', '', '', '', '', '2021-03-07', '', '0129664', '2021-03-07', '', '0129664', '9664', 0, 'user', 'img/default_profile.png'),
(760, 'ZAMORA, ANGELO MARK N', '', '', '', '', '', '2021-03-07', '', '0118838', '2021-03-07', '', '0118838', '8838', 0, 'user', 'img/default_profile.png'),
(761, 'ZAPANTA, JAN MELVIN M', '', '', '', '', '', '2021-03-07', '', '0118256', '2021-03-07', '', '0118256', '8256', 0, 'user', 'img/default_profile.png'),
(762, 'Maria Victoria ', 'Herradura', 'Garcia', 'L1B7 Dela Paz Sur, City of San Fernando, Pampanga', '09228568619', 'docmavicgarcia@gmail.com', '2021-02-04', 'C-', '0099980', '2024-02-04', 'FAMILY MEDICIBE', '0099980', 'sophia91107', 1, 'user', 'img/default_profile.png'),
(763, 'MERIN CALSI DEGUZMAN', '', '', '', '', '', '2021-03-11', '', '0071926', '2021-03-11', '', '0071926', '1926', 0, 'user', 'img/default_profile.png');

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
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tally`
--
ALTER TABLE `tally`
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
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tally`
--
ALTER TABLE `tally`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=764;

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
