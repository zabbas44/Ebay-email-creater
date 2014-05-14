-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2014 at 05:03 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cars_mng`
--


-- --------------------------------------------------------

--
-- Table structure for table `ci_cookies`
--

CREATE TABLE IF NOT EXISTS `ci_cookies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('a4c8ed92e8e3c898e9a998fe0a7d14a2', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0', 1392825540, 'a:7:{s:9:"user_data";s:0:"";s:9:"user_name";s:11:"umairmajeed";s:12:"is_logged_in";b:1;s:20:"manufacture_selected";s:1:"0";s:22:"search_string_selected";s:2:"dd";s:5:"order";s:2:"id";s:10:"order_type";s:3:"Asc";}');

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`id`, `name`) VALUES
(1, 'a'),
(2, 'd');

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE IF NOT EXISTS `membership` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email_addres` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `pass_word` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `membership`
--

INSERT INTO `membership` (`id`, `first_name`, `last_name`, `email_addres`, `user_name`, `pass_word`) VALUES
(1, 'umair', 'majeed', 'umair_majeed786@live.com', 'umairmajeed', 'e7aabb41315aaff23439860e5788349d');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rfid` varchar(255) NOT NULL,
  `make` varchar(255) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `vin` varchar(255) DEFAULT NULL,
  `stock` varchar(255) DEFAULT NULL,
  `year` varchar(11) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `geo_location` varchar(255) DEFAULT NULL,
  `miles` varchar(255) DEFAULT NULL,
  `gps_number` varchar(255) DEFAULT NULL,
  `history_of_scan` varchar(255) DEFAULT NULL,
  `pic_of_car` varchar(255) DEFAULT NULL,
  `pic_gps_tag` varchar(255) DEFAULT NULL,
  `pic_inside` varchar(255) DEFAULT NULL,
  `tag_number` varchar(255) DEFAULT NULL,
  `days` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `rfid`, `make`, `model`, `vin`, `stock`, `year`, `color`, `location`, `status`, `geo_location`, `miles`, `gps_number`, `history_of_scan`, `pic_of_car`, `pic_gps_tag`, `pic_inside`, `tag_number`, `days`) VALUES
(1, '', 'as', '44', '44', '443', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '', 's', 'sad', 'asdfa', 'sdfas', 'dfasdf', 'asdasdf', 'adsfasd', 'Active', 'asdf', 'asdfa', 'sdfasd', 'fasd', '', '', '', '423ds', 'asds323'),
(3, '', 's', 'sad', 'asdfa', 'sdfas', 'dfasdf', 'asdasdf', 'adsfasd', 'Active', 'asdf', 'asdfa', 'sdfasd', 'fasd', 'uploads//HU-at-LSC_05-e12931107849712.jpg', 'uploads//LSE_talk_in_Ashton1.png', 'uploads//33-pakmed-net-january-13-2013-medical-education-kjikjfdds1.jpg', '423ds', 'asds323'),
(4, 'dd', 's', 'sad', 'asdfa', 'sdfas', 'dfasdf', 'asdasdf', 'adsfasd', 'Active', 'asdf', 'asdfa', 'sdfasd', 'fasd', 'uploads/HU-at-LSC_05-e12931107849713.jpg', 'uploads/LSE_talk_in_Ashton2.png', 'uploads/33-pakmed-net-january-13-2013-medical-education-kjikjfdds2.jpg', '423ds434', 'asds323');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
