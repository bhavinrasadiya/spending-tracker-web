-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 29, 2018 at 10:38 AM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spending_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

DROP TABLE IF EXISTS `expense`;
CREATE TABLE IF NOT EXISTS `expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL,
  `amount` float NOT NULL,
  `payer` varchar(20) NOT NULL,
  `group_id` varchar(20) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `description`, `amount`, `payer`, `group_id`, `date`) VALUES
(1, 'nasto', 500, '1', 'joker', '2018-10-09'),
(2, 'nasoo', 45, '1', 'joker', '2018-10-09'),
(3, 'zkhj', 656, '1', 'joker', '2018-10-12'),
(4, 'liugiud', 520, '1', 'joker', '2018-10-09'),
(5, 'Milk', 80, '1', 'joker', '2018-10-09'),
(6, 'asdf', 6, '1', 'joker', '2018-10-16'),
(7, 'Milk', 60, '11', 'joker', '2018-10-18'),
(8, 'Agm', 60, '11', 'joker', '2018-10-18'),
(9, 'Amj', 120, '2', 'joker', '2018-10-18'),
(10, 'Diwali', 45, '4', 'joker', '2018-11-01'),
(11, 'milk', 45, '2', 'joker', '2018-11-24'),
(12, 'D-Mart', 1500, '1', 'joker', '2018-12-09'),
(13, 'speakar', 500, '2', 'joker', '2018-12-26'),
(14, 'Amg', 79, '2', 'joker', '2018-12-26'),
(15, 'Dinner', 56, '2', 'joker', '2018-12-26'),
(16, 'dinner', 500, '2', 'joker', '2018-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `expense_divide`
--

DROP TABLE IF EXISTS `expense_divide`;
CREATE TABLE IF NOT EXISTS `expense_divide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exp_id` int(11) NOT NULL,
  `amount` float NOT NULL,
  `group_id` varchar(20) NOT NULL,
  `frd_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_divide`
--

INSERT INTO `expense_divide` (`id`, `exp_id`, `amount`, `group_id`, `frd_id`) VALUES
(1, 1, 125, 'joker', 1),
(2, 1, 125, 'joker', 2),
(3, 1, 125, 'joker', 3),
(4, 1, 125, 'joker', 4),
(5, 2, 11.25, 'joker', 1),
(6, 2, 11.25, 'joker', 2),
(7, 2, 11.25, 'joker', 3),
(8, 2, 11.25, 'joker', 4),
(9, 3, 164, 'joker', 1),
(10, 3, 164, 'joker', 2),
(11, 3, 164, 'joker', 3),
(12, 3, 164, 'joker', 4),
(13, 4, 130, 'joker', 1),
(14, 4, 130, 'joker', 2),
(15, 4, 130, 'joker', 3),
(16, 4, 130, 'joker', 4),
(17, 5, 20, 'joker', 1),
(18, 5, 20, 'joker', 2),
(19, 5, 20, 'joker', 3),
(20, 5, 20, 'joker', 4),
(21, 6, 1.5, 'joker', 1),
(22, 6, 1.5, 'joker', 2),
(23, 6, 1.5, 'joker', 3),
(24, 6, 1.5, 'joker', 4),
(25, 7, 15, 'joker', 1),
(26, 7, 15, 'joker', 2),
(27, 7, 15, 'joker', 3),
(28, 7, 15, 'joker', 4),
(29, 8, 60, 'joker', 1),
(30, 9, 120, 'joker', 11),
(31, 10, 11.25, 'joker', 1),
(32, 10, 11.25, 'joker', 2),
(33, 10, 11.25, 'joker', 4),
(34, 10, 11.25, 'joker', 11),
(35, 11, 9, 'joker', 1),
(36, 11, 9, 'joker', 2),
(37, 11, 9, 'joker', 3),
(38, 11, 9, 'joker', 4),
(39, 11, 9, 'joker', 11),
(40, 12, 300, 'joker', 1),
(41, 12, 300, 'joker', 2),
(42, 12, 300, 'joker', 3),
(43, 12, 300, 'joker', 4),
(44, 12, 300, 'joker', 11),
(45, 13, 125, 'joker', 1),
(46, 13, 125, 'joker', 2),
(47, 13, 125, 'joker', 4),
(48, 13, 125, 'joker', 11),
(49, 14, 19.75, 'joker', 1),
(50, 14, 19.75, 'joker', 2),
(51, 14, 19.75, 'joker', 4),
(52, 14, 19.75, 'joker', 11),
(53, 15, 14, 'joker', 1),
(54, 15, 14, 'joker', 2),
(55, 15, 14, 'joker', 4),
(56, 15, 14, 'joker', 11),
(57, 16, 166.667, 'joker', 1),
(58, 16, 166.667, 'joker', 3),
(59, 16, 166.667, 'joker', 4);

-- --------------------------------------------------------

--
-- Table structure for table `friend_detail`
--

DROP TABLE IF EXISTS `friend_detail`;
CREATE TABLE IF NOT EXISTS `friend_detail` (
  `frd_id` int(11) NOT NULL AUTO_INCREMENT,
  `frd_name` varchar(20) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `email_id` varchar(50) NOT NULL,
  PRIMARY KEY (`frd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_detail`
--

INSERT INTO `friend_detail` (`frd_id`, `frd_name`, `mob_no`, `email_id`) VALUES
(1, 'Sanket', '9277111311', 'buhasanket@gmail.com'),
(2, 'Keval', '8155886801', 'kevallanghanoja111@gmail.com'),
(3, 'Bhavin', '8153907578', 'bhavinrasadiya@gmail.com'),
(4, 'Maulik Kanani', '959595995', 'maulikkanani@gmail.com'),
(5, 'test', '8153907845', 'test@gmail.com'),
(6, 'test2', '8754213690', 'test2@gmail.com'),
(7, 'Abhay', '9725106853', 'arvadiya@gmail.com'),
(8, 'jenish', '798898998', 'jenish@gmail.com'),
(9, 'ramesh', '9737254500', 'ramesh@gmail.com'),
(10, 'keval', '8155886801', 'keval@gmail.com'),
(11, 'Parth', '1234567890', 'parth@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `groups_detail`
--

DROP TABLE IF EXISTS `groups_detail`;
CREATE TABLE IF NOT EXISTS `groups_detail` (
  `group_name` varchar(20) NOT NULL,
  `group_id` varchar(11) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups_detail`
--

INSERT INTO `groups_detail` (`group_name`, `group_id`, `password`) VALUES
('Akshat', 'akshaticon', '123'),
('joker_house', 'joker', '1234567'),
('LDRP', 'ldrp', '1234'),
('LDRP Hostel', 'ldrphostel', 'abc123'),
('Test', 'test', '123');

-- --------------------------------------------------------

--
-- Table structure for table `group_member`
--

DROP TABLE IF EXISTS `group_member`;
CREATE TABLE IF NOT EXISTS `group_member` (
  `group_id` varchar(11) NOT NULL,
  `frd_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_member`
--

INSERT INTO `group_member` (`group_id`, `frd_id`) VALUES
('joker', 1),
('joker', 2),
('joker', 3),
('joker', 4),
('test', 5),
('test', 6),
('ldrphostel', 7),
('ldrphostel', 8),
('ldrphostel', 9),
('ldrp', 10),
('ldrp', 0),
('joker', 11);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
