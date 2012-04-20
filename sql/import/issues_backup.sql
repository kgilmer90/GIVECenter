-- phpMyAdmin SQL Dump
-- version 3.3.2deb1ubuntu1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2012 at 08:38 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.2-1ubuntu4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `give_ctr_agencies`
--

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

DROP TABLE IF EXISTS `issues`;
CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`) VALUES
(5, 'alumni'),
(6, 'animals'),
(7, 'children'),
(8, 'disabilities'),
(9, 'disasters'),
(10, 'education'),
(11, 'elderly'),
(12, 'environment'),
(13, 'female issues'),
(14, 'fine arts'),
(15, 'general service'),
(16, 'health'),
(17, 'male issues'),
(18, 'minority issues'),
(19, 'office'),
(20, 'patriotic'),
(21, 'poverty'),
(22, 'PR'),
(23, 'recreation'),
(24, 'religious'),
(25, 'service leaders'),
(26, 'technology');
