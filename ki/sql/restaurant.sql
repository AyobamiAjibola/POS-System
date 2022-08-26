-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2019 at 08:32 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `buy_bulk`
--

CREATE TABLE IF NOT EXISTS `buy_bulk` (
  `buy_bulk_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` longtext NOT NULL,
  `customer` longtext NOT NULL,
  `total_prod` int(11) NOT NULL,
  `amount` longtext NOT NULL,
  `sold_by` int(11) NOT NULL,
  `buy_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`buy_bulk_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `buy_bulk`
--

INSERT INTO `buy_bulk` (`buy_bulk_id`, `reference`, `customer`, `total_prod`, `amount`, `sold_by`, `buy_date`) VALUES
(1, '890887867', '', 2, '4000', 2, '2019-05-15 01:47:47'),
(2, '5cdb869b0688f', '', 2, '15000', 1, '2019-05-15 03:25:15'),
(3, '5cdb883a7800a', '', 2, '3000', 1, '2019-05-15 03:32:10'),
(5, '5cdb8af33aafe', '', 1, '24000', 1, '2019-05-15 03:43:47'),
(6, '5cdb96fb85aed', '', 1, '30000', 1, '2019-05-15 04:35:07'),
(7, '5cdbb0488800e', '', 1, '102000', 1, '2019-05-15 06:23:04'),
(8, '5cdbb2734d581', '', 1, '15000', 1, '2019-05-15 06:32:19'),
(9, '5cdbb2c16cb55', '', 1, '60000', 1, '2019-05-15 06:33:37'),
(10, '5cdbb3fd0c879', '', 1, '72000', 1, '2019-05-15 06:38:53'),
(11, '5cdbb61abff82', '', 1, '96000', 1, '2019-05-15 06:47:54'),
(12, '5cdbb70e76f4d', '', 1, '72000', 1, '2019-05-15 06:51:58'),
(13, '5cdbb7833a933', '', 1, '108000', 1, '2019-05-15 06:53:55'),
(14, '5cdbb943f2d1e', '', 2, '34500', 1, '2019-05-15 07:01:24'),
(15, '5cdbb967b35ab', '', 2, '75000', 1, '2019-05-15 07:01:59'),
(16, '5cdbba1a54ecb', '', 1, '7500', 1, '2019-05-15 07:04:58'),
(17, '5cdbba4561fa1', '', 1, '4500', 1, '2019-05-15 07:05:41'),
(18, '5cdbc5c1671d2', '', 1, '324000', 1, '2019-05-15 07:54:41'),
(19, '5cdbd40d02d5a', '', 2, '22000', 1, '2019-05-15 08:55:41'),
(20, '5cdbd44f8df2a', '', 1, '18000', 1, '2019-05-15 08:56:47'),
(21, '5cdbd4803d159', '', 1, '24000', 1, '2019-05-15 08:57:36'),
(22, '5cdbd6066ad0f', '', 2, '3000', 5, '2019-05-15 09:04:06'),
(23, '5cddf5595efc6', 'Briggs Mile', 2, '58000', 1, '2019-05-16 23:42:17'),
(24, '5cddf5a4bfbdf', 'Briggs mile', 2, '58000', 1, '2019-05-16 23:43:32'),
(25, '5cdf94d978a62', 'Micheal tricks', 1, '10000', 1, '2019-05-18 05:15:05'),
(26, '5cdf955d006a4', 'Jonas', 1, '2000', 1, '2019-05-18 05:17:17'),
(27, '5cdf9570a30b0', 'Jonas', 1, '3000', 1, '2019-05-18 05:17:36'),
(28, '5cdf97124dcf9', 'James', 1, '2000', 1, '2019-05-18 05:24:34'),
(29, '5cdf9792595d5', 'James', 1, '3000', 1, '2019-05-18 05:26:42'),
(30, '5cdf97d2e3791', 'James', 1, '3000', 1, '2019-05-18 05:27:46'),
(31, '5cdf97fbb2b9f', 'Mic', 1, '2000', 1, '2019-05-18 05:28:27'),
(32, '5cdf9815acfc5', 'Mic', 1, '2000', 1, '2019-05-18 05:28:53'),
(33, '5cdf9f07b18ce', 'Jude', 1, '2000', 1, '2019-05-18 05:58:31'),
(34, '5cdf9f471e3e0', 'Mike', 1, '2000', 1, '2019-05-18 05:59:35'),
(35, '5cdf9f7c500eb', 'Jude Law', 1, '4000', 1, '2019-05-18 06:00:28'),
(36, '5cdfa0b4a1913', 'Jude', 1, '5000', 1, '2019-05-18 06:05:40'),
(37, '5cdfa20ca1bb7', 'Jude', 1, '2000', 1, '2019-05-18 06:11:24'),
(38, '5cdfa2c6a415e', 'Jude', 1, '4000', 1, '2019-05-18 06:14:30'),
(39, '5cdfa3ab80b50', 'Janes', 1, '3000', 1, '2019-05-18 06:18:19'),
(40, '5cdfa3c8d5587', 'Mike', 1, '5000', 1, '2019-05-18 06:18:48'),
(41, '5cdfa3ea615bc', 'Jude', 2, '12000', 1, '2019-05-18 06:19:22'),
(42, '5cdffd23cc951', 'Grace Hill', 2, '9000', 1, '2019-05-18 12:40:03'),
(43, '5cdffe2f9f017', 'Grace Hill', 2, '11000', 1, '2019-05-18 12:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `buy_detail`
--

CREATE TABLE IF NOT EXISTS `buy_detail` (
  `buy_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` longtext NOT NULL,
  `customer` longtext NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity_sold` int(11) NOT NULL,
  `item_price` longtext NOT NULL,
  `sold_by_id` int(11) NOT NULL,
  `handled` int(11) NOT NULL,
  `item_buy_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`buy_detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=62 ;

--
-- Dumping data for table `buy_detail`
--

INSERT INTO `buy_detail` (`buy_detail_id`, `reference`, `customer`, `item_id`, `quantity_sold`, `item_price`, `sold_by_id`, `handled`, `item_buy_date`) VALUES
(1, '890887867', '', 2, 3, '2000', 1, 0, '2019-05-15 01:48:58'),
(2, '890887867', '', 3, 2, '2000', 1, 1, '2019-05-15 01:48:58'),
(5, '5cdb869b0688f', '', 2, 5, '5000', 1, 0, '2019-05-15 03:25:15'),
(6, '5cdb869b0688f', '', 4, 10, '10000', 1, 0, '2019-05-15 03:25:15'),
(7, '5cdb883a7800a', '', 4, 2, '2000', 1, 0, '2019-05-15 03:32:10'),
(8, '5cdb883a7800a', '', 2, 1, '1000', 1, 0, '2019-05-15 03:32:10'),
(10, '5cdb8af33aafe', '', 3, 4, '24000', 1, 1, '2019-05-15 03:43:47'),
(11, '5cdb96fb85aed', '', 3, 5, '30000', 1, 1, '2019-05-15 04:35:07'),
(12, '5cdbb0488800e', '', 3, 17, '102000', 1, 1, '2019-05-15 06:23:04'),
(13, '5cdbb2734d581', '', 5, 10, '15000', 1, 0, '2019-05-15 06:32:19'),
(14, '5cdbb2c16cb55', '', 3, 10, '60000', 1, 1, '2019-05-15 06:33:37'),
(15, '5cdbb3fd0c879', '', 3, 12, '72000', 1, 1, '2019-05-15 06:38:53'),
(16, '5cdbb61abff82', '', 3, 16, '96000', 1, 1, '2019-05-15 06:47:54'),
(17, '5cdbb70e76f4d', '', 3, 12, '72000', 1, 1, '2019-05-15 06:51:58'),
(18, '5cdbb7833a933', '', 3, 18, '108000', 1, 1, '2019-05-15 06:53:55'),
(19, 'tyu67866', '', 3, 23, '1500', 1, 1, '2019-05-15 06:56:18'),
(20, 'tyu67866', '', 4, 2, '2300', 1, 0, '2019-05-15 06:56:18'),
(21, '456yyu7', '', 3, 2, '1299', 1, 1, '2019-05-15 06:58:53'),
(22, '456yyu7', '', 4, 2, '5666', 1, 0, '2019-05-15 06:58:53'),
(23, '5cdbb943f2d1e', '', 5, 3, '4500', 1, 0, '2019-05-15 07:01:23'),
(24, '5cdbb943f2d1e', '', 3, 5, '30000', 1, 1, '2019-05-15 07:01:24'),
(25, '5cdbb967b35ab', '', 3, 10, '60000', 1, 1, '2019-05-15 07:01:59'),
(26, '5cdbb967b35ab', '', 5, 10, '15000', 1, 0, '2019-05-15 07:01:59'),
(27, '5cdbba1a54ecb', '', 5, 5, '7500', 1, 0, '2019-05-15 07:04:58'),
(28, '5cdbba4561fa1', '', 5, 3, '4500', 1, 0, '2019-05-15 07:05:41'),
(29, '5cdbc5c1671d2', '', 3, 54, '324000', 1, 1, '2019-05-15 07:54:41'),
(30, '5cdbd40d02d5a', '', 4, 10, '10000', 1, 0, '2019-05-15 08:55:41'),
(31, '5cdbd40d02d5a', '', 3, 2, '12000', 1, 1, '2019-05-15 08:55:41'),
(32, '5cdbd44f8df2a', '', 3, 3, '18000', 1, 1, '2019-05-15 08:56:47'),
(33, '5cdbd4803d159', '', 3, 4, '24000', 1, 1, '2019-05-15 08:57:36'),
(34, '5cdbd6066ad0f', '', 2, 2, '2000', 5, 0, '2019-05-15 09:04:06'),
(35, '5cdbd6066ad0f', '', 4, 1, '1000', 5, 0, '2019-05-15 09:04:06'),
(36, '5cddf5595efc6', 'Briggs mile', 4, 34, '34000', 1, 0, '2019-05-16 23:00:00'),
(37, '5cddf5595efc6', 'Briggs Mile', 3, 4, '24000', 5, 1, '2019-05-16 23:00:00'),
(38, '5cddf5a4bfbdf', 'Briggs Mile', 3, 4, '24000', 5, 1, '2019-05-16 23:43:32'),
(39, '5cddf5a4bfbdf', 'Briggs mile', 4, 34, '34000', 1, 0, '2019-05-16 23:43:32'),
(40, '5cdf94d978a62', 'Micheal tricks', 4, 10, '10000', 1, 0, '2019-05-18 05:15:05'),
(41, '5cdf955d006a4', 'Jonas', 4, 2, '2000', 1, 0, '2019-05-18 05:17:17'),
(42, '5cdf9570a30b0', 'Jonas', 4, 3, '3000', 1, 0, '2019-05-18 05:17:36'),
(43, '5cdf97124dcf9', 'James', 4, 2, '2000', 1, 0, '2019-05-18 05:24:34'),
(44, '5cdf9792595d5', 'James', 4, 3, '3000', 1, 0, '2019-05-18 05:26:42'),
(45, '5cdf97d2e3791', 'James', 4, 3, '3000', 1, 0, '2019-05-18 05:27:46'),
(46, '5cdf97fbb2b9f', 'Mic', 4, 2, '2000', 1, 0, '2019-05-18 05:28:27'),
(47, '5cdf9815acfc5', 'Mic', 4, 2, '2000', 1, 0, '2019-05-18 05:28:53'),
(48, '5cdf9f07b18ce', 'Jude', 4, 2, '2000', 1, 0, '2019-05-18 05:58:31'),
(49, '5cdf9f471e3e0', 'Mike', 4, 2, '2000', 1, 0, '2019-05-18 05:59:35'),
(50, '5cdf9f7c500eb', 'Jude Law', 4, 4, '4000', 1, 0, '2019-05-18 06:00:28'),
(51, '5cdfa0b4a1913', 'Jude', 4, 5, '5000', 1, 0, '2019-05-18 06:05:40'),
(52, '5cdfa20ca1bb7', 'Jude', 4, 2, '2000', 1, 0, '2019-05-18 06:11:24'),
(53, '5cdfa2c6a415e', 'Jude', 4, 4, '4000', 1, 0, '2019-05-18 06:14:30'),
(54, '5cdfa3ab80b50', 'Janes', 4, 3, '3000', 1, 0, '2019-05-18 06:18:19'),
(55, '5cdfa3c8d5587', 'Mike', 4, 5, '5000', 1, 0, '2019-05-18 06:18:48'),
(56, '5cdfa3ea615bc', 'Jude', 4, 7, '7000', 1, 0, '2019-05-18 06:19:22'),
(57, '5cdfa3ea615bc', 'Jude', 2, 5, '5000', 1, 0, '2019-05-18 06:19:22'),
(58, '5cdffd23cc951', 'Grace hill', 4, 5, '5000', 1, 0, '2019-05-18 12:40:03'),
(59, '5cdffd23cc951', 'Grace Hill', 2, 4, '4000', 1, 0, '2019-05-18 12:40:03'),
(60, '5cdffe2f9f017', 'Grace Hill', 4, 5, '5000', 1, 0, '2019-05-18 12:44:31'),
(61, '5cdffe2f9f017', 'Grace Hill', 2, 6, '6000', 1, 0, '2019-05-18 12:44:31');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(200) NOT NULL,
  `item_type_id` int(11) NOT NULL,
  `price` longtext NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`item_id`),
  UNIQUE KEY `item` (`item`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `item`, `item_type_id`, `price`, `quantity`, `date_added`) VALUES
(2, 'Fanta', 3, '1000', 30, '2019-05-14 20:37:03'),
(3, 'Rice', 1, '6000', 2816, '2019-05-15 01:46:37'),
(4, 'Coke', 3, '1000', 20, '2019-05-15 01:46:50'),
(5, 'Juice', 3, '1500', 39, '2019-05-15 01:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `item_type`
--

CREATE TABLE IF NOT EXISTS `item_type` (
  `item_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `item_type` varchar(200) NOT NULL,
  PRIMARY KEY (`item_type_id`),
  UNIQUE KEY `item_type` (`item_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_type`
--

INSERT INTO `item_type` (`item_type_id`, `item_type`) VALUES
(3, 'Bar'),
(1, 'Kitchen');

-- --------------------------------------------------------

--
-- Table structure for table `sett`
--

CREATE TABLE IF NOT EXISTS `sett` (
  `sett_id` int(11) NOT NULL AUTO_INCREMENT,
  `system_title` longtext NOT NULL,
  `logo` longtext NOT NULL,
  PRIMARY KEY (`sett_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sett`
--

INSERT INTO `sett` (`sett_id`, `system_title`, `logo`) VALUES
(1, 'Brigss', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` longtext NOT NULL,
  `last_name` longtext NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` longtext NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `user_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `password`, `user_type_id`, `user_added`) VALUES
(1, 'Briggs', 'bits', 'henboc', '$2y$10$JkaY.S6olZgjIDcjVHDcEebH0FdFaoIgh3ewu.MQZCYvnOn6kmrBu', 1, '2019-05-14 16:24:58'),
(4, 'Jazmine', 'Samuels', 'jazz', '$2y$10$eH9APsDUYRECLa0Ooerj5.w1l3TFBTDQMzoydFWl5hjn7GIIMucOq', 2, '2019-05-15 07:11:31'),
(5, 'Joice', 'Johna', 'peace', '$2y$10$XzbLd5Zyd49l/IU5v4sRq.Evyn7dNCxsiFtvV1mb3UCrr50B9Uoke', 3, '2019-05-15 07:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE IF NOT EXISTS `user_type` (
  `user_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(200) NOT NULL,
  PRIMARY KEY (`user_type_id`),
  UNIQUE KEY `user_type` (`user_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `user_type`) VALUES
(1, 'Management'),
(2, 'Restaurant'),
(3, 'Retail');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
