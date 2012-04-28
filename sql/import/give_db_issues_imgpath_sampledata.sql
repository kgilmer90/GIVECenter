-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2012 at 02:23 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

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
-- Table structure for table `addr`
--

DROP TABLE IF EXISTS `addr`;
CREATE TABLE IF NOT EXISTS `addr` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state_us` varchar(30) DEFAULT NULL,
  `zip` char(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=108 ;

--
-- Dumping data for table `addr`
--

INSERT INTO `addr` (`id`, `street`, `city`, `state_us`, `zip`) VALUES
(1, '310 S Clark St', NULL, NULL, NULL),
(2, '435 N Cobb St Suite A', NULL, NULL, NULL),
(3, '119 Grimes Road NE', NULL, NULL, NULL),
(4, '3312 Nothside Dr Suite 140A', NULL, NULL, NULL),
(5, '195 Holt Ave', NULL, NULL, NULL),
(6, '248 Jesse Scott Rd', NULL, NULL, NULL),
(7, 'P.O. Box 1032', NULL, NULL, NULL),
(8, '953 Barrows Ferry Rd', NULL, NULL, NULL),
(9, '184 NW Robinson Mill Rd', NULL, NULL, NULL),
(10, '130 S Jefferson St', NULL, NULL, NULL),
(11, '155 Highway 49 West', NULL, NULL, NULL),
(12, '155 Highway 49 West', NULL, NULL, NULL),
(13, '155 Highway 49 West', NULL, NULL, NULL),
(14, '100 North ABC St', NULL, NULL, NULL),
(15, '211 South Clark St', NULL, NULL, NULL),
(16, 'P.O. Box 1143', NULL, NULL, NULL),
(17, 'P. O. Box 1143', NULL, NULL, NULL),
(18, '800 N Glynn', NULL, NULL, NULL),
(19, 'P.O. Box 541', NULL, NULL, NULL),
(20, 'P.O. Box 701', NULL, NULL, NULL),
(21, '54 Hwy 22 W', NULL, NULL, NULL),
(22, '620 Broad St', NULL, NULL, NULL),
(23, '325 Allen Memorial Dr', NULL, NULL, NULL),
(24, 'P.O. Box 783', NULL, NULL, NULL),
(25, '102 Airport Road', NULL, NULL, NULL),
(26, '440 N Columbia St', NULL, NULL, NULL),
(27, '1045 N Jefferson St', NULL, NULL, NULL),
(28, '1045 N Jefferson St', NULL, NULL, NULL),
(29, '451 S Wayne St', NULL, NULL, NULL),
(30, '154 Roberson Mill Road', NULL, NULL, NULL),
(31, '100 N ABC St', NULL, NULL, NULL),
(32, '119 NE Ivey Weaver Rd', NULL, NULL, NULL),
(33, '116 Frank Bond Rd', NULL, NULL, NULL),
(34, '330 S Liberty St', NULL, NULL, NULL),
(35, '210 South Wayne Street', NULL, NULL, NULL),
(36, '156 Roberson Mill Rd', NULL, NULL, NULL),
(37, '624 W Martin Luther King Dr', NULL, NULL, NULL),
(38, 'GCSu Campus Box 002', NULL, NULL, NULL),
(39, '2249 Vinson Highway', NULL, NULL, NULL),
(40, '6869 Columbus Road', NULL, NULL, NULL),
(41, '5171 Eisenhower Parkway', NULL, NULL, NULL),
(42, '5171 Eisenhower Parkway macon', NULL, NULL, NULL),
(43, '313 Allen Memorial Dr', NULL, NULL, NULL),
(44, 'P.O. Box 605', NULL, NULL, NULL),
(45, '182 W. Lakeview Drive NE', NULL, NULL, NULL),
(46, '241 N Jefferson St', NULL, NULL, NULL),
(47, '214 Hwy 49E', NULL, NULL, NULL),
(48, '115 Stevens Dr', NULL, NULL, NULL),
(49, '811 North Cobb St', NULL, NULL, NULL),
(50, '197 Log Cabin Road', NULL, NULL, NULL),
(51, '112 Jacqueline Terrace', NULL, NULL, NULL),
(52, '1023 Milledgeville Rd', NULL, NULL, NULL),
(53, '234 Lake Laurel Rd', NULL, NULL, NULL),
(54, '630 N Wayne St', NULL, NULL, NULL),
(55, '1111 N Jefferson St', NULL, NULL, NULL),
(56, '1534 Iriwenton Road', NULL, NULL, NULL),
(57, '2720 Sheraton Drive, Suite 235D', NULL, NULL, NULL),
(58, '244 Sinclair Rd SE eatonton', NULL, NULL, NULL),
(59, 'P.O. Box 642 hardwick', NULL, NULL, NULL),
(60, '366 Log Cabin Road', NULL, NULL, NULL),
(61, '545 Martin Luther King Blvd', NULL, NULL, NULL),
(62, '203 OConner Dr', NULL, NULL, NULL),
(63, '821 N Cobb St', NULL, NULL, NULL),
(64, 'PO Box 1422', NULL, NULL, NULL),
(65, '125 W McIntosh St', NULL, NULL, NULL),
(66, '125 W Mcintosh St', NULL, NULL, NULL),
(67, '104 Montpelier Ch Rd', NULL, NULL, NULL),
(68, '3046 Heritage Rd', NULL, NULL, NULL),
(69, 'P.O. Box 794', NULL, NULL, NULL),
(70, 'PO Box 1586', NULL, NULL, NULL),
(71, 'P.O. Box 1013', NULL, NULL, NULL),
(72, 'P.O. Box 1827', NULL, NULL, NULL),
(73, '131 N Jefferson St', NULL, NULL, NULL),
(74, 'P.O. Box 474', NULL, NULL, NULL),
(75, '821 N Cobb St', NULL, NULL, NULL),
(76, '821 N. Cobb St.', NULL, NULL, NULL),
(77, '201 E Green St', NULL, NULL, NULL),
(78, 'P.O. Box 1177', NULL, NULL, NULL),
(79, 'P.O. Box 693', NULL, NULL, NULL),
(80, '120 Earnest Byner St', NULL, NULL, NULL),
(81, '108 Cambridge Drive South', NULL, NULL, NULL),
(82, '195 ivey Drive, SW', NULL, NULL, NULL),
(83, '175 Emory Highway macon', NULL, NULL, NULL),
(84, '175 Emory Highway macon', NULL, NULL, NULL),
(85, '110 N Jefferson St', NULL, NULL, NULL),
(86, 'P.O. Box 1822', NULL, NULL, NULL),
(87, '204 Harrisburg Rd', NULL, NULL, NULL),
(88, '102 Airport Rd', NULL, NULL, NULL),
(89, 'CSH Box 27', NULL, NULL, NULL),
(90, '161 Swint Ave', NULL, NULL, NULL),
(91, '220 S. Wayne St', NULL, NULL, NULL),
(92, '215 S Wayne St', NULL, NULL, NULL),
(93, 'Suite B6', NULL, NULL, NULL),
(94, '165 Garrett Way', NULL, NULL, NULL),
(95, '146 Myrick Rd', NULL, NULL, NULL),
(96, '106 W Hancock St', NULL, NULL, NULL),
(97, '151 S Jefferson St', NULL, NULL, NULL),
(98, '151 S Jefferson St', NULL, NULL, NULL),
(99, '165 Garrett Way', NULL, NULL, NULL),
(100, '277 MLK Jr Blvd Suite 301 macon', NULL, NULL, NULL),
(101, '1980 N Jefferson St', NULL, NULL, NULL),
(102, '2592 N Columbia St', NULL, NULL, NULL),
(103, '211 S Clark St', NULL, NULL, NULL),
(104, '173 Hopewell Church Rd', NULL, NULL, NULL),
(105, '273 W Highway 49', NULL, NULL, NULL),
(106, 'Campus Box 04', NULL, NULL, NULL),
(107, '156 Lake Laurel Road', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `agency`
--

DROP TABLE IF EXISTS `agency`;
CREATE TABLE IF NOT EXISTS `agency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `descript` varchar(1000) DEFAULT NULL,
  `p_contact_id` int(10) unsigned DEFAULT NULL,
  `addr` int(10) unsigned DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `phone` char(10) DEFAULT NULL,
  `fax` char(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `agency`
--

INSERT INTO `agency` (`id`, `name`, `descript`, `p_contact_id`, `addr`, `mail`, `phone`, `fax`) VALUES
(1, '100 Black Men of Mil', NULL, NULL, NULL, NULL, NULL, NULL),
(2, '4H for Baldwin Count', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'American Cancer Soci', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'American Lung Assn M', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'American Red Cross', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Andalusia, Home of F', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Angel Food Ministrie', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Animal Rescue Founda', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Babies Cant Wait', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Baldwin Bowling Cent', NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Baldwin Bulletin', NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Baldwin Charter Scho', NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Baldwin County Chamb', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Baldwin High School', NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Baldwin High School ', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Baptist Collegiate M', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'BBBS Heart of Ga.', NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Big Brothers/Big Sis', NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Bill Ireland YDC', NULL, NULL, NULL, NULL, NULL, NULL),
(20, 'Blandy Hills Elemant', NULL, NULL, NULL, NULL, NULL, NULL),
(21, 'Boy Scouts', NULL, NULL, NULL, NULL, NULL, NULL),
(22, 'Boys & Girls Club', NULL, NULL, NULL, NULL, NULL, NULL),
(23, 'Caring4 Creatures In', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 'Central Georgia Tech', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 'Central State Hospit', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 'CGTC Adult Learning ', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 'Chaplinwood Nursing ', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 'Childrens Medical Ho', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 'Community in Schools', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 'Compassionate Care C', NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Council of Catholic ', NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'Covenant Presbyteria', NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'Creative Expressions', NULL, NULL, NULL, NULL, NULL, NULL),
(34, 'Crossroads Pregnancy', NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'DFACS', NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'Dogwood Retirement H', NULL, NULL, NULL, NULL, NULL, NULL),
(37, 'Eagle Ridge Elementa', NULL, NULL, NULL, NULL, NULL, NULL),
(38, 'Early Learning Cente', NULL, NULL, NULL, NULL, NULL, NULL),
(39, 'Evergreen Baptist Ch', NULL, NULL, NULL, NULL, NULL, NULL),
(40, 'Experience Works, In', NULL, NULL, NULL, NULL, NULL, NULL),
(41, 'Fathers Heart Int. C', NULL, NULL, NULL, NULL, NULL, NULL),
(42, 'First Baptist Church', NULL, NULL, NULL, NULL, NULL, NULL),
(43, 'First Presbyterian C', NULL, NULL, NULL, NULL, NULL, NULL),
(44, 'Flagg Chapel', NULL, NULL, NULL, NULL, NULL, NULL),
(45, 'Ga Dept of Labor', NULL, NULL, NULL, NULL, NULL, NULL),
(46, 'Georgia Cancer Speci', NULL, NULL, NULL, NULL, NULL, NULL),
(47, 'Georgia College & St', NULL, NULL, NULL, NULL, NULL, NULL),
(48, 'Georgia Military Col', NULL, NULL, NULL, NULL, NULL, NULL),
(49, 'Georgia Power', NULL, NULL, NULL, NULL, NULL, NULL),
(50, 'Georgia War Veterans', NULL, NULL, NULL, NULL, NULL, NULL),
(51, 'Georgias Porch', NULL, NULL, NULL, NULL, NULL, NULL),
(52, 'Girl Scouts of Histo', NULL, NULL, NULL, NULL, NULL, NULL),
(53, 'Good Will', NULL, NULL, NULL, NULL, NULL, NULL),
(54, 'Goodwill Industries ', NULL, NULL, NULL, NULL, NULL, NULL),
(55, 'Goodwill Works', NULL, NULL, NULL, NULL, NULL, NULL),
(56, 'Green Acres Nursing ', NULL, NULL, NULL, NULL, NULL, NULL),
(57, 'Habitat for Humanity', NULL, NULL, NULL, NULL, NULL, NULL),
(58, 'Habitat For Humanity', NULL, NULL, NULL, NULL, NULL, NULL),
(59, 'Hardwick Baptist Foo', NULL, NULL, NULL, NULL, NULL, NULL),
(60, 'Harolds Department S', NULL, NULL, NULL, NULL, NULL, NULL),
(61, 'Harriets Closet', NULL, NULL, NULL, NULL, NULL, NULL),
(62, 'Historical Society', NULL, NULL, NULL, NULL, NULL, NULL),
(63, 'Hope Lutheran Church', NULL, NULL, NULL, NULL, NULL, NULL),
(64, 'Hopewell United Meth', NULL, NULL, NULL, NULL, NULL, NULL),
(65, 'Hospice Care Options', NULL, NULL, NULL, NULL, NULL, NULL),
(66, 'John Milledge Academ', NULL, NULL, NULL, NULL, NULL, NULL),
(67, 'Josephs Storehouse', NULL, NULL, NULL, NULL, NULL, NULL),
(68, 'Lakeside Baptist Chu', NULL, NULL, NULL, NULL, NULL, NULL),
(69, 'Life & Peace Christi', NULL, NULL, NULL, NULL, NULL, NULL),
(70, 'Life & Peace Christi', NULL, NULL, NULL, NULL, NULL, NULL),
(71, 'Life Enrichment Cent', NULL, NULL, NULL, NULL, NULL, NULL),
(72, 'Lockerly Arboretum', NULL, NULL, NULL, NULL, NULL, NULL),
(73, 'MakeAWish Foundation', NULL, NULL, NULL, NULL, NULL, NULL),
(74, 'Meals On Wheels', NULL, NULL, NULL, NULL, NULL, NULL),
(75, 'Meals on Wheels', NULL, NULL, NULL, NULL, NULL, NULL),
(76, 'Midway Elementary', NULL, NULL, NULL, NULL, NULL, NULL),
(77, 'Milledgeville Alumna', NULL, NULL, NULL, NULL, NULL, NULL),
(78, 'Milledgeville Cares', NULL, NULL, NULL, NULL, NULL, NULL),
(79, 'Milledgeville First ', NULL, NULL, NULL, NULL, NULL, NULL),
(80, 'Milledgeville Housin', NULL, NULL, NULL, NULL, NULL, NULL),
(81, 'Milledgeville Jewish', NULL, NULL, NULL, NULL, NULL, NULL),
(82, 'Milledgeville Junior', NULL, NULL, NULL, NULL, NULL, NULL),
(83, 'Milledgeville MainSt', NULL, NULL, NULL, NULL, NULL, NULL),
(84, 'Milledgeville Police', NULL, NULL, NULL, NULL, NULL, NULL),
(85, 'Montpelier United Me', NULL, NULL, NULL, NULL, NULL, NULL),
(86, 'National Alliance on', NULL, NULL, NULL, NULL, NULL, NULL),
(87, 'Northside Baptist Ch', NULL, NULL, NULL, NULL, NULL, NULL),
(88, 'Oak Hill Middle Scho', NULL, NULL, NULL, NULL, NULL, NULL),
(89, 'Ocmulgee CASA', NULL, NULL, NULL, NULL, NULL, NULL),
(90, 'Oconee Area Citizen ', NULL, NULL, NULL, NULL, NULL, NULL),
(91, 'Oconee Center', NULL, NULL, NULL, NULL, NULL, NULL),
(92, 'Oconee Center Commun', NULL, NULL, NULL, NULL, NULL, NULL),
(93, 'Oconee Center comuni', NULL, NULL, NULL, NULL, NULL, NULL),
(94, 'Oconee Center CSB', NULL, NULL, NULL, NULL, NULL, NULL),
(95, 'Oconee Prevention Re', NULL, NULL, NULL, NULL, NULL, NULL),
(96, 'Oconee Regional Medi', NULL, NULL, NULL, NULL, NULL, NULL),
(97, 'Oconee River Greenwa', NULL, NULL, NULL, NULL, NULL, NULL),
(98, 'Old Capital Museum', NULL, NULL, NULL, NULL, NULL, NULL),
(99, 'Overview', NULL, NULL, NULL, NULL, NULL, NULL),
(100, 'Pathfinders Christia', NULL, NULL, NULL, NULL, NULL, NULL),
(101, 'Pecan Hills of Mille', NULL, NULL, NULL, NULL, NULL, NULL),
(102, 'Pilot Club', NULL, NULL, NULL, NULL, NULL, NULL),
(103, 'Pilot Club of Milled', NULL, NULL, NULL, NULL, NULL, NULL),
(104, 'Recovery Resources', NULL, NULL, NULL, NULL, NULL, NULL),
(105, 'Relay for Life', NULL, NULL, NULL, NULL, NULL, NULL),
(106, 'River Edge Beh. Heal', NULL, NULL, NULL, NULL, NULL, NULL),
(107, 'River Edge Behaviora', NULL, NULL, NULL, NULL, NULL, NULL),
(108, 'Sacred Heart Catholi', NULL, NULL, NULL, NULL, NULL, NULL),
(109, 'Salvation Army', NULL, NULL, NULL, NULL, NULL, NULL),
(110, 'Samaritians Inn', NULL, NULL, NULL, NULL, NULL, NULL),
(111, 'Sams Voice', NULL, NULL, NULL, NULL, NULL, NULL),
(112, 'Shiloh Baptist churc', NULL, NULL, NULL, NULL, NULL, NULL),
(113, 'Sinclair Baptist Chu', NULL, NULL, NULL, NULL, NULL, NULL),
(114, 'Sodexho', NULL, NULL, NULL, NULL, NULL, NULL),
(115, 'Special Olympics', NULL, NULL, NULL, NULL, NULL, NULL),
(116, 'St Patricks', NULL, NULL, NULL, NULL, NULL, NULL),
(117, 'St. Stephens Episcop', NULL, NULL, NULL, NULL, NULL, NULL),
(118, 'St. Stephens Food Pa', NULL, NULL, NULL, NULL, NULL, NULL),
(119, 'Susan G. Komen Found', NULL, NULL, NULL, NULL, NULL, NULL),
(120, 'The Saviors Touch Bo', NULL, NULL, NULL, NULL, NULL, NULL),
(121, 'The Union Recorder', NULL, NULL, NULL, NULL, NULL, NULL),
(122, 'Thera Pups', NULL, NULL, NULL, NULL, NULL, NULL),
(123, 'TreBella', NULL, NULL, NULL, NULL, NULL, NULL),
(124, 'Twin Lakes/Mary Vins', NULL, NULL, NULL, NULL, NULL, NULL),
(125, 'Union Recorder', NULL, NULL, NULL, NULL, NULL, NULL),
(126, 'United Cerebal Palsy', NULL, NULL, NULL, NULL, NULL, NULL),
(127, 'United Way of Centra', NULL, NULL, NULL, NULL, NULL, NULL),
(128, 'Vaughn Chapel Baptis', NULL, NULL, NULL, NULL, NULL, NULL),
(129, 'Wal Mart', NULL, NULL, NULL, NULL, NULL, NULL),
(130, 'Walter B. Williams', NULL, NULL, NULL, NULL, NULL, NULL),
(131, 'Wesley Foundation', NULL, NULL, NULL, NULL, NULL, NULL),
(132, 'Westview Baptist Chu', NULL, NULL, NULL, NULL, NULL, NULL),
(133, 'Womens Resource Cent', NULL, NULL, NULL, NULL, NULL, NULL),
(134, 'Z97', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_history`
--

DROP TABLE IF EXISTS `contact_history`;
CREATE TABLE IF NOT EXISTS `contact_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) DEFAULT NULL,
  `program_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `contact_history`
--

INSERT INTO `contact_history` (`id`, `contact_id`, `program_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

DROP TABLE IF EXISTS `hours`;
CREATE TABLE IF NOT EXISTS `hours` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `hours` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `hours`
--

INSERT INTO `hours` (`id`, `hours`) VALUES
(1, 'Morning'),
(2, 'Afternoon'),
(3, 'Evening'),
(4, 'Night'),
(5, 'Graveyard');

-- --------------------------------------------------------

--
-- Table structure for table `image_paths`
--

DROP TABLE IF EXISTS `image_paths`;
CREATE TABLE IF NOT EXISTS `image_paths` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_type` varchar(20) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `image_paths`
--

INSERT INTO `image_paths` (`id`, `image_type`, `path`, `name`) VALUES
(1, 'banner', 'img/giveBannerThin.jpg', 'give_banner');

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

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agency` int(10) unsigned NOT NULL,
  `addr` int(11) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `p_contact` int(10) unsigned NOT NULL,
  `s_contact` int(10) unsigned NOT NULL,
  `descript` varchar(400) DEFAULT NULL,
  `referal` tinyint(1) DEFAULT NULL,
  `notes` varchar(400) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `agency`, `addr`, `name`, `p_contact`, `s_contact`, `descript`, `referal`, `notes`, `duration`) VALUES
(1, 1, 1, '100 Black Men of Mil', 1, 1, 'The mission of the 100 Black Men of America, Inc. is to improve the quality of life within our communities and enhance educational and economic opportunities for all African Americans.', 1, '100 Black Men of America, Inc.', '3 Hours'),
(2, 2, 2, '4H for Baldwin Count', 2, 0, 'To assist youth in acquiring knowledge,developing life skills andforming attitudes that will enable them tobecome selfdirecting, productive and contributing citizens.', NULL, NULL, NULL),
(3, 3, 2, 'Survivor Buddies', 3, 0, 'The American Cancer Society is the nationwide, communitybased, voluntary health organization dedicated to eliminating cancer as a major health problem by preventing cancer, saving lives, and diminishing suffering from cancer, through research, education, advocacy, and service', NULL, NULL, NULL),
(4, 3, 2, 'American Cancer Soci', 4, 0, 'The American Cancer Society is the nationwide, communitybased, voluntary health organization dedicated to eliminating cancer as a major health problem by preventing cancer, saving lives, and diminishing suffering from cancer, through research, education, advocacy, and service', NULL, NULL, NULL),
(5, 3, 2, 'American Cancer Soci', 5, 0, 'The American Cancer Society is the nationwide, communitybased, voluntary health organization dedicated to eliminating cancer as a major health problem by preventing cancer, saving lives, and diminishing suffering from cancer, through research, education, advocacy, and service', NULL, NULL, NULL),
(6, 4, 2, 'American Lung Assn M', 6, 0, 'To save lives by improving lung health and preventing lung disease.', NULL, NULL, NULL),
(7, 4, 3, 'American Lung Assn M', 7, 0, 'To save lives by improving lung health and preventing lung disease.', NULL, NULL, NULL),
(8, 4, 4, 'American Lung Assn M', 8, 0, 'To save lives by improving lung health and preventing lung disease.', NULL, NULL, NULL),
(9, 5, 5, 'Blood Drives', 9, 0, 'The American Red Cross, a humanitarian organization led by volunteers and guided by its Congressional Charter and the Fundamental Principles of the International Red Cross Movement, will provide relief to victims of disaster and help people prevent, prepare for, and respond to emergencies.', NULL, NULL, NULL),
(10, 6, 5, 'Andalusia, Home of F', 10, 0, 'Flannery OConners historical home', NULL, NULL, NULL),
(11, 7, 6, 'Angel Food Ministrie', 11, 0, 'Angel Food Ministries is a nonprofit, nondenominational organization dedicated to providing food relief and financial support to communities throughout the United States.', NULL, NULL, NULL),
(12, 8, 7, 'Animal Rescue Founda', 12, 0, 'Animal shelter that provides housing for animals without a home, adoption agency as well.', NULL, NULL, NULL),
(13, 9, 8, 'Babies Cant Wait', 13, 0, 'Babies Cant Wait BCW is Georgias statewide interagency service delivery system for infants and toddlers with developmental delays or disabilities and their families.', NULL, NULL, NULL),
(14, 10, 9, 'Baldwin Bowling Cent', 14, 0, 'Local bowling center', NULL, NULL, NULL),
(15, 11, 9, 'Baldwin Bulletin', 15, 0, 'local newspaper', NULL, NULL, NULL),
(16, 12, 9, 'Baldwin Charter Scho', 16, 0, NULL, NULL, NULL, NULL),
(17, 13, 10, 'Baldwin County Chamb', 17, 0, 'The chamber is a voluntary organization of business owners, professionals, manufacturers, and individuals.', NULL, NULL, NULL),
(18, 14, 11, 'Baldwin High School', 18, 0, 'local high school', NULL, NULL, NULL),
(19, 14, 12, 'Baldwin High School', 19, 0, 'local high school', NULL, NULL, NULL),
(20, 14, 13, 'Baldwin High School', 20, 0, 'local high school', NULL, NULL, NULL),
(21, 15, 14, 'Baldwin High School ', 21, 0, NULL, NULL, NULL, NULL),
(22, 16, 15, 'Baptist Collegiate M', 22, 0, 'a Christcentered student organization on the campus of Georgia College & State University. Our goal is to focus on learning, living, and sharing our faith in partnership with the local Church. We commit to challenge and equip one another, our campus, and our community to strive for maturity in faith and practice', NULL, NULL, NULL),
(23, 17, 15, 'BBBS Heart of Ga.', 23, 0, 'To help children reach their potential through professionally supported onetoone relationships.', NULL, NULL, NULL),
(24, 18, 16, 'Big Brothers/Big Sis', 24, 0, 'To help children reach their potential through professionally supported onetoone relationships.', NULL, NULL, NULL),
(25, 18, 17, 'Big Brothers/Big Sis', 25, 0, 'To help children reach their potential through professionally supported onetoone relationships.', NULL, NULL, NULL),
(26, 19, 18, 'Bill Ireland YDC', 26, 0, 'To protect and serve the citizens of Georgia by holding youthful offenders accountable for their actions through the delivery of treatment services and sanctions in appropriate settings and by establishing youth in their communities as productive and law abiding citizens.', NULL, NULL, NULL),
(27, 20, 18, 'Blandy Hills Elemant', 27, 0, 'one of the local elementary schools', NULL, NULL, NULL),
(28, 21, 18, 'Boy Scouts', 28, 0, 'The Boy Scouts of America provides a program for young people that builds character, trains them in the responsibilities of participating citizenship, and develops personal fitness.', NULL, NULL, NULL),
(29, 21, 19, 'Boy Scouts', 29, 0, 'The Boy Scouts of America provides a program for young people that builds character, trains them in the responsibilities of participating citizenship, and develops personal fitness.', NULL, NULL, NULL),
(30, 22, 20, 'Boys & Girls Club', 30, 0, 'To enable all young people, especially those who need us most, to reach their full potential as productive, caring, responsible citizens.', NULL, NULL, NULL),
(31, 23, 20, 'Caring4 Creatures In', 31, 0, 'Caring4Creatures exists to invite and inspire all of humanity to live in harmony and balance, wherever and whenever possible. All Gods creatures are valuable and caring4creatures is about promoting the life and welfare of each one, to live out a purposeful existance in a healthy, loving and nurturing environment.', NULL, NULL, NULL),
(32, 24, 21, 'Central Georgia Tech', 32, 0, 'local technical college', NULL, NULL, NULL),
(33, 25, 22, 'Central State Hospit', 33, 0, 'Hospital for the mentally ill ', NULL, NULL, NULL),
(34, 25, 22, 'Central State Hospit', 34, 0, 'Hospital for the mentally ill ', NULL, NULL, NULL),
(35, 26, 22, 'CGTC Adult Learning ', 35, 0, 'Help each adult learner in Bibb, Baldwin, Crawford, Jones, Monroe, Putnam, Twiggs and Wilkinson counties to acquire the basic skills of listening, speaking, reading, writing, computation and technology necessary to: 1 compete successfully in todays workplace, 2 strengthen individual character and family foundations, and 3 exercise full citizenship.', NULL, NULL, NULL),
(36, 27, 23, 'Young at Heart', 36, 0, 'Chaplinwood Nursing Home provides extendedstay nursing care to seniors with varying levels of disabilities', NULL, NULL, NULL),
(37, 28, 23, 'DM for the Kids', 37, 0, 'The ChildrenÃ¢â‚¬â„¢s Hospital provides exceptional medical care and specialized services for children from birth through adolescence.', NULL, NULL, NULL),
(38, 29, 24, 'Community in Schools', 38, 0, 'The mission of Communities In Schools is to champion the connection of needed community resources with schools to help young people successfully learn, stay in school and prepare for life.', NULL, NULL, NULL),
(39, 30, 25, 'Compassionate Care C', 39, 0, NULL, NULL, NULL, NULL),
(40, 31, 25, 'Council of Catholic ', 40, 0, 'he National Council of Catholic Women acts through its members to support, empower and educate all Catholic women in spirituality, leadership and service. NCCW programs respond with Gospel values to the needs of the Church and society in the modern world.', NULL, NULL, NULL),
(41, 32, 26, 'Covenant Presbyteria', 41, 0, NULL, NULL, NULL, NULL),
(42, 33, 27, 'Creative Expressions', 42, 0, 'Creative Expressionsis an integrated arts program thatis part of a nonprofit organization, The Life Enrichment Centerthat promotes creativity and selfexpression for artists with developmental disabilities through the use of music therapy, nature explorers, visual arts, and performing arts.', NULL, NULL, NULL),
(43, 33, 28, 'Best Buddies', 43, 0, 'Creative Expressionsis an integrated arts program thatis part of a nonprofit organization, The Life Enrichment Centerthat promotes creativity and selfexpression for artists with developmental disabilities through the use of music therapy, nature explorers, visual arts, and performing arts.', NULL, NULL, NULL),
(44, 34, 29, 'Crossroads Pregnancy', 44, 0, 'We are a nonprofit, Christian organization dedicated to assisting abortionvulnerable women and men who are involved in a crisis pregnancy, to choose life for their unborn children. Toward the same end, we are committed to encouraging godly sexual attitudes and practices in our community. ', NULL, NULL, NULL),
(45, 35, 30, 'DFACS', 45, 0, 'the part of DHS that investigates child abuse, finds foster homes for abused and neglected children, helps low income, outofwork parents get back on their feet, assists with childcare costs for low income parents who are working or in job training, and provides numerous support services and innovative programs to help troubled families.', NULL, NULL, NULL),
(46, 36, 30, 'Young @ Heart', 46, 0, 'Retirement home for the elderly', NULL, NULL, NULL),
(47, 37, 30, 'Eagle Ridge Elementa', 47, 0, 'one of the local elementary schools', NULL, NULL, NULL),
(48, 38, 31, 'Academic Outreach', 48, 0, 'Our mission is to provide a nurturing environment that will enable children andfamilies to experience success in acquiring knowledge, skills, and positive attitudes that prepare them to become responsible citizens and continuous learners.', NULL, NULL, NULL),
(49, 39, 32, 'Evergreen Baptist Ch', 49, 0, 'local baptist church', NULL, NULL, NULL),
(50, 40, 32, 'Experience Works, In', 50, 0, 'Experience Works helps lowincome seniors, with multiple barriers to employment,get the training they need to find good jobs in their local communities.', NULL, NULL, NULL),
(51, 41, 33, 'Fathers Heart Int. C', 51, 0, NULL, NULL, NULL, NULL),
(52, 42, 34, 'First Baptist Church', 52, 0, NULL, NULL, NULL, NULL),
(53, 43, 35, 'First Presbyterian C', 53, 0, NULL, NULL, NULL, NULL),
(54, 44, 35, 'Flagg Chapel', 54, 0, NULL, NULL, NULL, NULL),
(55, 45, 36, 'Ga Dept of Labor', 55, 0, NULL, NULL, NULL, NULL),
(56, 45, 36, 'Ga Dept of Labor', 56, 0, NULL, NULL, NULL, NULL),
(57, 46, 37, 'Survivor Buddies', 57, 0, 'Georgia Cancer Specialists, I, P.C. strives to deliver compassionate, stateoftheart, costeffective, and communitybased medical care to the adult cancer and hematology patient while recognizing quality of life as a crucial focus.', NULL, NULL, NULL),
(58, 47, 38, 'Georgia College & St', 58, 0, NULL, NULL, NULL, NULL),
(59, 47, 38, 'Georgia College & St', 59, 0, NULL, NULL, NULL, NULL),
(60, 47, 38, 'Georgia College & St', 60, 0, NULL, NULL, NULL, NULL),
(61, 47, 38, 'Georgia College & St', 61, 0, NULL, NULL, NULL, NULL),
(62, 47, 38, 'Georgia College & St', 62, 0, NULL, NULL, NULL, NULL),
(63, 47, 38, 'Georgia College & St', 63, 0, NULL, NULL, NULL, NULL),
(64, 47, 38, 'Georgia College & St', 64, 0, NULL, NULL, NULL, NULL),
(65, 47, 38, 'Georgia College & St', 65, 0, NULL, NULL, NULL, NULL),
(66, 47, 38, 'Georgia College & St', 66, 0, NULL, NULL, NULL, NULL),
(67, 47, 38, 'Georgia College & St', 67, 0, NULL, NULL, NULL, NULL),
(68, 47, 38, 'Georgia College & St', 68, 0, NULL, NULL, NULL, NULL),
(69, 48, 38, 'Georgia Military Col', 69, 0, NULL, NULL, NULL, NULL),
(70, 48, 38, 'Georgia Military Col', 70, 0, NULL, NULL, NULL, NULL),
(71, 49, 38, 'Georgia Power', 71, 0, NULL, NULL, NULL, NULL),
(72, 50, 39, 'VisitAVeteran', 72, 0, NULL, NULL, NULL, NULL),
(73, 51, 39, 'Georgias Porch', 73, 0, 'is a program designed to provide specialized services for those who experience trauma and grief after a homicide or suicide. Services are also provided when trauma results from life threatening and/or critical incidents in the state of Georgia.', NULL, NULL, NULL),
(74, 52, 39, 'Girl Scouts of Histo', 74, 0, 'Girl Scouting builds girls of courage, confidence, and character, who make the world a better place.', NULL, NULL, NULL),
(75, 52, 40, 'Kappa Delta', 75, 0, NULL, NULL, NULL, NULL),
(76, 53, 40, 'Good Will', 76, 0, 'Goodwill Industries International enhances the dignity and quality of life of individuals, families and communities by eliminating barriers to opportunity and helping people in need reach their fullest potential through the power of work.', NULL, NULL, NULL),
(77, 54, 41, 'Goodwill Industries ', 77, 0, NULL, NULL, NULL, NULL),
(78, 55, 42, 'Goodwill Works', 78, 0, 'Goodwills Mission is to build lives, families, and communities Ã¢â‚¬â€œ one job at a time Ã¢â‚¬â€œ by helping people discover and develop their Godgiven gifts through work and career development services.', NULL, NULL, NULL),
(79, 56, 43, 'Young @ Heart', 79, 0, 'Goodwills Mission is to build lives, families, and communities Ã¢â‚¬â€œ one job at a time Ã¢â‚¬â€œ by helping people discover and develop their Godgiven gifts through work and career development services.', NULL, NULL, NULL),
(80, 57, 44, 'Strong Enough to Car', 80, 0, 'Habitat for Humanity works in partnership with God and people everywhere, from all walks of life, to develop communities with people in need by building and renovating houses so that there are decent houses in decent communities in which every person can experience GodÃ¢â‚¬â„¢s love and can live and grow into all that God intends.', NULL, NULL, NULL),
(81, 58, 44, 'Circle K', 81, 0, 'Habitat for Humanity works in partnership with God and people everywhere, from all walks of life, to develop communities with people in need by building and renovating houses so that there are decent houses in decent communities in which every person can experience GodÃ¢â‚¬â„¢s love and can live and grow into all that God intends.', NULL, NULL, NULL),
(82, 59, 44, 'Hardwick Baptist Foo', 82, 0, NULL, NULL, NULL, NULL),
(83, 60, 44, 'Harolds Department S', 83, 0, NULL, NULL, NULL, NULL),
(84, 61, 45, 'Harriets Closet', 84, 0, NULL, NULL, NULL, NULL),
(85, 61, 45, 'Harriets Closet', 85, 0, NULL, NULL, NULL, NULL),
(86, 62, 46, 'Historical Society', 86, 0, NULL, NULL, NULL, NULL),
(87, 63, 47, 'Hope Lutheran Church', 87, 0, NULL, NULL, NULL, NULL),
(88, 64, 48, 'Hopewell United Meth', 88, 0, NULL, NULL, NULL, NULL),
(89, 65, 49, 'Hospice Care Options', 89, 0, NULL, NULL, NULL, NULL),
(90, 66, 50, 'John Milledge Academ', 90, 0, NULL, NULL, NULL, NULL),
(91, 66, 50, 'John Milledge Academ', 91, 0, NULL, NULL, NULL, NULL),
(92, 67, 51, 'Josephs Storehouse', 92, 0, NULL, NULL, NULL, NULL),
(93, 68, 52, 'Lakeside Baptist Chu', 93, 0, NULL, NULL, NULL, NULL),
(94, 69, 53, 'Life & Peace Christi', 94, 0, 'As a word of faith/discipleship Church, we seek to provide regular teachings of the Bible, meaningful times of worship, opportunities for fellowship, prayer, outreach, and numerous other ministries for people of all ages. ', NULL, NULL, NULL),
(95, 70, 54, 'Life & Peace Christi', 95, 0, 'As a word of faith/discipleship Church, we seek to provide regular teachings of the Bible, meaningful times of worship, opportunities for fellowship, prayer, outreach, and numerous other ministries for people of all ages. ', NULL, NULL, NULL),
(96, 71, 54, 'Best Buddies', 96, 0, 'The purpose of the Life Enrichment Center is to provide individuals with developmental disabilitiesthe opportunity to meet individualized goals through Employment and Personal and Social Services.', NULL, NULL, NULL),
(97, 71, 55, 'Creative Expressions', 97, 0, 'The purpose of the Life Enrichment Center is to provide individuals with developmental disabilitiesthe opportunity to meet individualized goals through Employment and Personal and Social Services.', NULL, NULL, NULL),
(98, 72, 56, 'Lockerly Arboretum', 98, 0, 'To provide outstanding ecological, horticultural and historical education in order to promote preservation and stewardship of the environment, by fostering an understanding of and an appreciation for the natural world.', NULL, NULL, NULL),
(99, 72, 56, 'Lockerly Arboretum', 99, 0, 'To provide outstanding ecological, horticultural and historical education in order to promote preservation and stewardship of the environment, by fostering an understanding of and an appreciation for the natural world.', NULL, NULL, NULL),
(100, 73, 57, 'MakeAWish', 100, 0, 'We grant the wishes of children with lifethreatening medical conditions to enrich the human experience with hope, strength and joy.', NULL, NULL, NULL),
(101, 74, 58, 'Meals On Wheels', 101, 0, 'To provide meals and other services for senior citizens', NULL, NULL, NULL),
(102, 75, 59, 'Meals on Wheels', 102, 0, 'To provide meals and other services for senior citizens', NULL, NULL, NULL),
(103, 76, 59, 'Midway Elementary', 103, 0, 'one of the local elementary schools', NULL, NULL, NULL),
(104, 77, 59, 'Milledgeville Alumna', 104, 0, 'a private, nonprofit organization whose purpose is to provide assistance and support through established programs in local communities throughout the world.', NULL, NULL, NULL),
(105, 78, 59, 'Milledgeville Cares', 105, 0, 'The purpose of Milledgeville Cares, Inc. shall be to provide a means whereby service agencies, as well as faithbased institutions, can efficiently work together providing basic necessities, emotional support, and information sessions, as needed, in a time of challenge, and opportunity.', NULL, NULL, NULL),
(106, 79, 60, 'Milledgeville First ', 106, 0, NULL, NULL, NULL, NULL),
(107, 80, 61, 'Milledgeville Housin', 107, 0, NULL, NULL, NULL, NULL),
(108, 81, 62, 'Milledgeville Jewish', 108, 0, NULL, NULL, NULL, NULL),
(109, 81, 63, 'Milledgeville Jewish', 109, 0, NULL, NULL, NULL, NULL),
(110, 82, 63, 'Milledgeville Junior', 110, 0, NULL, NULL, NULL, NULL),
(111, 83, 64, 'Milledgeville MainSt', 111, 0, 'To inspire public and private investment in the revitalization and preservation of the downtown business district in order to strengthen the economic base of MilledgevilleBaldwin County.', NULL, NULL, NULL),
(112, 84, 65, 'Milledgeville Police', 112, 0, NULL, NULL, NULL, NULL),
(113, 84, 66, 'SNAP', 113, 0, NULL, NULL, NULL, NULL),
(114, 85, 67, 'Montpelier United Me', 114, 0, NULL, NULL, NULL, NULL),
(115, 86, 68, 'National Alliance on', 115, 0, 'NAMI is a grassroots organization of individuals with mental illnesses, especially serious mental illnesses, their family members, and friends whose mission is to advocate for effective prevention, diagnosis, treatment, support, research and recovery that improves the quality of life of persons of all ages who are affected by mental illnesses.', NULL, NULL, NULL),
(116, 87, 69, 'Northside Baptist Ch', 116, 0, NULL, NULL, NULL, NULL),
(117, 88, 69, 'Oak Hill Middle Scho', 117, 0, NULL, NULL, NULL, NULL),
(118, 88, 69, 'Oak Hill Middle Scho', 118, 0, NULL, NULL, NULL, NULL),
(119, 89, 70, 'Ocmulgee CASA', 119, 0, 'the mission to recruit, train, manage and support volunteers to act as the Court Appointed Special Advocate Ã¢â‚¬Å“CASAÃ¢â‚¬Â? for neglected, abused, deprived, or otherwise dependent children of the Ocmulgee Circuit, to represent the best interests of these children in court proceedings, and to follow these childrenÃ¢â‚¬â„¢s cases until they achieve permanency or reach majority.', NULL, NULL, NULL),
(120, 90, 71, 'Oconee Area Citizen ', 120, 0, NULL, NULL, NULL, NULL),
(121, 91, 72, 'Oconee Center', 121, 0, 'public, nonprofit agency organized to provide Mental Health, Developmental Disabilities, and Addictive Diseases in the six county areas including: Baldwin, Hancock, Jasper, Putnam, Washington, and Wilkinson.', NULL, NULL, NULL),
(122, 91, 72, 'Oconee Center', 122, 0, 'public, nonprofit agency organized to provide Mental Health, Developmental Disabilities, and Addictive Diseases in the six county areas including: Baldwin, Hancock, Jasper, Putnam, Washington, and Wilkinson.', NULL, NULL, NULL),
(123, 92, 72, 'Oconee Center Commun', 123, 0, NULL, NULL, NULL, NULL),
(124, 93, 72, 'Oconee Center comuni', 124, 0, NULL, NULL, NULL, NULL),
(125, 94, 73, 'Oconee Center CSB', 125, 0, NULL, NULL, NULL, NULL),
(126, 95, 74, 'Oconee Prevention Re', 126, 0, 'We value and believe that the citizens of the Oconee Region have the right to live in a safe community, free from alcohol abuse and illegal drug use. We do work to create to create conditions to promote the wellbeing of all people.', NULL, NULL, NULL),
(127, 96, 75, 'Survivor Buddies', 127, 0, 'TheMission of Oconee Regional Medical Center is to provide high quality, safe, compassionate and patientfocused healthcare.', NULL, NULL, NULL),
(128, 96, 76, 'Oconee Regional Medi', 128, 0, 'TheMission of Oconee Regional Medical Center is to provide high quality, safe, compassionate and patientfocused healthcare.', NULL, NULL, NULL),
(129, 97, 77, 'Oconee River Greenwa', 129, 0, 'To create a corridor along the Oconee River that will become a regionally and nationally recognized resource that integrates local economic benefits, increased public use and resource protection and enhancement', NULL, NULL, NULL),
(130, 98, 78, 'Old Capital Museum', 130, 0, NULL, NULL, NULL, NULL),
(131, 99, 79, 'Overview', 131, 0, NULL, NULL, NULL, NULL),
(132, 100, 80, 'Pathfinders Christia', 132, 0, NULL, NULL, NULL, NULL),
(133, 101, 81, 'Pecan Hills of Mille', 133, 0, NULL, NULL, NULL, NULL),
(134, 102, 81, 'Pilot Club', 134, 0, 'The purpose of this organization is to serve members of our community with brain related disorders, which are either a result of head traumas or genetic disorders. No one is refused service, as it is a needbased organization, which is supported by fundraisers.', NULL, NULL, NULL),
(135, 103, 81, 'Pilot Club of Milled', 135, 0, NULL, NULL, NULL, NULL),
(136, 104, 82, 'Recovery Resources', 136, 0, NULL, NULL, NULL, NULL),
(137, 105, 82, 'Relay for Life', 137, 0, 'The American Cancer Society is the nationwide communitybased voluntary health organization dedicated to eliminating cancer as a major health problem by preventing cancer, saving lives, and diminishing suffering from cancer, through research, education, advocacy, and service.', NULL, NULL, NULL),
(138, 106, 83, 'River Edge Beh. Heal', 138, 0, NULL, NULL, NULL, NULL),
(139, 107, 84, 'River Edge Behaviora', 139, 0, NULL, NULL, NULL, NULL),
(140, 108, 85, 'Campus Catholics', 140, 0, NULL, NULL, NULL, NULL),
(141, 109, 86, 'Salvation Army', 141, 0, 'The Salvation Army, an international movement, is an evangelical part of the universal Christian Church. Its message is based on the Bible. Its ministry is motivated by the love of God. Its mission is to preach the gospel of Jesus Christ and to meet human needs in His name without discrimination.', NULL, NULL, NULL),
(142, 110, 86, 'Samaritians Inn', 142, 0, 'The Samaritans Inn exists to support, educate, counsel, and empower young women who are single and pregnant, and to enable them to take responsible action for the life of their child.', NULL, NULL, NULL),
(143, 111, 86, 'Sams Voice', 143, 0, NULL, NULL, NULL, NULL),
(144, 112, 87, 'Shiloh Baptist churc', 144, 0, NULL, NULL, NULL, NULL),
(145, 113, 88, 'Sinclair Baptist Chu', 145, 0, NULL, NULL, NULL, NULL),
(146, 114, 88, 'Sodexho', 146, 0, NULL, NULL, NULL, NULL),
(147, 115, 89, 'Best Buddies', 147, 0, 'To provide yearround sports training and athletic competition in a variety of Olympictype sports for children and adults with intellectual disabilities, giving them continuing opportunities to develop physical fitness, demonstrate courage, experience joy and participate in a sharing of gifts, skills and friendship with their families, other Special Olympics athletes and the community.', NULL, NULL, NULL),
(148, 116, 90, 'St Patricks', 148, 0, NULL, NULL, NULL, NULL),
(149, 117, 91, 'St. Stephens Episcop', 149, 0, 'Outreach to the community is a vital and integral part of the life at St. Stephens. We generously share our facilities with the community, operate a food pantry, and participate in and support other important community activities. ', NULL, NULL, NULL),
(150, 118, 92, 'Soul Food??', 150, 0, 'The Chard Wray Memorial Food Pantry was established in 1989 as an outreach program of St. Stephens. Today the Food Pantry is called upon to feed hundreds of people each year Ã¢â‚¬â€œ in fact, our records from January of 2004 through April 2007 indicate that 1706 families totaling 4,555 people received food.  A dedicated volunteer group of more than 40 individuals from St. Stephens, First United Me', NULL, NULL, NULL),
(151, 119, 92, 'Zeta Tau Alpha??', 151, 0, 'As the worldÃ¢â‚¬â„¢s largest grassroots network of breast cancer survivors and activists, weÃ¢â‚¬â„¢re working together to save lives, empower people, ensure quality care for all and energize science to find the cures.', NULL, NULL, NULL),
(152, 120, 93, 'The Saviors Touch Bo', 152, 0, NULL, NULL, NULL, NULL),
(153, 121, 94, 'The Union Recorder', 153, 0, 'The local newspaper', NULL, NULL, NULL),
(154, 122, 94, 'Thera Pups', 154, 0, 'A service program that takes people and their welltrained dogs to nursing homes and hospitals to visit the patients and bring a little joy to their day.', NULL, NULL, NULL),
(155, 122, 95, 'Thera Pups', 155, 0, 'A service program that takes people and their welltrained dogs to nursing homes and hospitals to visit the patients and bring a little joy to their day.', NULL, NULL, NULL),
(156, 123, 96, 'TreBella', 156, 0, NULL, NULL, NULL, NULL),
(157, 124, 97, 'First Book', 157, 0, 'The Twin Lakes Library Systems mission is to improve and enhance the educational, cultural and recreational life of the communities served in order to increase the intellectual potential of the community. The System does this by promoting access to information, offering innovative programs and providing welltrained staff.', NULL, NULL, NULL),
(158, 124, 98, 'Twin Lakes/Mary Vins', 158, 0, NULL, NULL, NULL, NULL),
(159, 124, 98, 'Twin Lakes/Mary Vins', 159, 0, NULL, NULL, NULL, NULL),
(160, 125, 99, 'Union Recorder', 160, 0, 'The local newspaper', NULL, NULL, NULL),
(161, 125, 99, 'Union Recorder', 161, 0, 'The local newspaper', NULL, NULL, NULL),
(162, 125, 99, 'Union Recorder', 162, 0, 'The local newspaper', NULL, NULL, NULL),
(163, 126, 99, 'United Cerebal Palsy', 163, 0, 'The United Cerebral Palsy UCP mission is to advance the independence, productivity and full citizenship of people with disabilities through an affiliate network.', NULL, NULL, NULL),
(164, 127, 100, 'United Way of Centra', 164, 0, 'to provide leadership to the community in setting the human care agenda, and by mobilizing human and financial resources to solve our most important social problems. ', NULL, NULL, NULL),
(165, 128, 101, 'Vaughn Chapel Baptis', 165, 0, NULL, NULL, NULL, NULL),
(166, 129, 102, 'Wal Mart', 166, 0, NULL, NULL, NULL, NULL),
(167, 130, 102, 'Walter B. Williams', 167, 0, NULL, NULL, NULL, NULL),
(168, 131, 103, 'Wesley Foundation', 168, 0, 'the mission of the GCSU Wesley Foundation is to develop authentic disciples of Jesus Christ for the transformation of lives, the campus, and the world. We serve the campus of Georgia College & State University as well as Georgia Military College.', NULL, NULL, NULL),
(169, 132, 104, 'Westview Baptist Chu', 169, 0, NULL, NULL, NULL, NULL),
(170, 132, 105, 'Westview Baptist Chu', 170, 0, NULL, NULL, NULL, NULL),
(171, 133, 106, 'Womens Resource Cent', 171, 0, 'Our mission is to promote a GCSU community that is safe, equitable, and supportive for women and that celebrates their experiences, achievements, and diversity through education, leadership, support, empowerment, and advocacy.', NULL, NULL, NULL),
(172, 134, 107, 'Z97', 172, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_hours`
--

DROP TABLE IF EXISTS `program_hours`;
CREATE TABLE IF NOT EXISTS `program_hours` (
  `hours_id` int(10) unsigned NOT NULL,
  `program_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`hours_id`,`program_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_hours`
--

INSERT INTO `program_hours` (`hours_id`, `program_id`) VALUES
(1, 1),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `program_issues`
--

DROP TABLE IF EXISTS `program_issues`;
CREATE TABLE IF NOT EXISTS `program_issues` (
  `program_id` int(10) unsigned NOT NULL,
  `issue_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`program_id`,`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_issues`
--

INSERT INTO `program_issues` (`program_id`, `issue_id`) VALUES
(1, 18);

-- --------------------------------------------------------

--
-- Table structure for table `program_seasons`
--

DROP TABLE IF EXISTS `program_seasons`;
CREATE TABLE IF NOT EXISTS `program_seasons` (
  `program_id` int(10) unsigned NOT NULL DEFAULT '0',
  `season_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`program_id`,`season_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `program_seasons`
--

INSERT INTO `program_seasons` (`program_id`, `season_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `pro_contact`
--

DROP TABLE IF EXISTS `pro_contact`;
CREATE TABLE IF NOT EXISTS `pro_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(30) DEFAULT NULL,
  `l_name` varchar(30) DEFAULT NULL,
  `f_name` varchar(30) DEFAULT NULL,
  `m_name` varchar(30) DEFAULT NULL,
  `suf` varchar(3) DEFAULT NULL,
  `m_phone` char(10) DEFAULT NULL,
  `w_phone` char(10) DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=173 ;

--
-- Dumping data for table `pro_contact`
--

INSERT INTO `pro_contact` (`id`, `title`, `l_name`, `f_name`, `m_name`, `suf`, `m_phone`, `w_phone`, `mail`) VALUES
(1, 'Mr', 'Lunsford', 'James', NULL, 'Sr', NULL, '4784527990', 'jameslunsford1@yahoo.com'),
(2, NULL, 'Palmer', 'Janet', NULL, NULL, NULL, '4784454394', 'janetp@uga.edu'),
(3, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL),
(5, NULL, 'Pearson', 'Lindsi', NULL, NULL, NULL, '4787436391', 'lindsi.pearson@cancer.org'),
(6, NULL, 'Douglas', 'Brenda', NULL, NULL, NULL, '4787435455', 'fdouglas@windstream.net'),
(7, NULL, 'Turk', 'Barbara', NULL, NULL, NULL, '0', 'bat100@windstream.net'),
(8, NULL, 'Marshall', 'Kaye', NULL, NULL, NULL, '4784523170', 'bat100@windstream.net'),
(9, NULL, 'Kight', 'Tracy', NULL, NULL, NULL, '4784522675', 'tkight@centralgaredcross.org'),
(10, NULL, 'Amason', 'Craig', NULL, NULL, NULL, '0', 'wiseblood@windstream.net'),
(11, NULL, 'Arnold', 'Melanie', NULL, NULL, NULL, '4784537710', 'cectpam@windstream.net'),
(12, NULL, 'Thompson', 'Bobbie', NULL, NULL, NULL, '4784541273', 'info@animalrescuefoundation.org'),
(13, NULL, 'Kuehn', 'Gina', NULL, NULL, NULL, '4784451587', 'gmkuehn@dhr.state.ga.us'),
(14, NULL, 'Ashworth', 'John', NULL, NULL, NULL, '4784587545', 'jashw70824@aol.com'),
(15, NULL, 'Beer', 'Pam', NULL, NULL, NULL, '4784521777', 'pbeer@thebaldwinbulletin.com'),
(16, NULL, 'Pendergast', 'Iona', NULL, NULL, NULL, '0', 'ipendergast@yahoo.com'),
(17, NULL, 'Peters', 'Tara', NULL, NULL, NULL, '4784539311', 'mbcchamber@windstream.net'),
(18, NULL, 'Wade', 'Wilhelmenia', NULL, NULL, NULL, '0', 'wilhelmenia.wade@baldwin.k12.ga.us'),
(19, 'Mrs.', 'Swain', 'Jessica', NULL, NULL, NULL, '478 451303', 'jswain@baldwin.k12.ga.us'),
(20, NULL, 'Robinson', 'Margie', NULL, NULL, NULL, '0', 'margie@baldwin.k12.ga.us'),
(21, NULL, 'Archer', 'Wendy', NULL, NULL, NULL, '4784572461', 'warcher@baldwin.k12.ga.us'),
(22, NULL, 'Wesley', 'Mitch', NULL, NULL, NULL, '4784524008', 'mwesley@windstream.net'),
(23, NULL, 'Glymph', 'Dianna', NULL, NULL, NULL, '0', 'dianna.glymph@bbbsheartga.org'),
(24, NULL, 'Fields', 'Keisha', NULL, NULL, NULL, '4787189233', 'keisha.fields@bbbs.org'),
(25, NULL, 'Williamson', 'Patricia', NULL, NULL, NULL, '4784527488', 'patricia.williamson@bbbs.org'),
(26, NULL, 'Thomas', 'Belinda', NULL, NULL, NULL, '4784454479', 'belindathomas@djj.state.ga.us'),
(27, NULL, 'Mitchell', 'Pam', NULL, NULL, NULL, '0', 'pmitchell@baldwin.k12.ga.us'),
(28, NULL, 'McCue', 'James', 'C', NULL, NULL, '4784562252', 'detjcmccue37@yahoo.com'),
(29, NULL, 'Howell', 'Matt', NULL, NULL, '4789183124', '0', 'mhowell@bsamail.org'),
(30, NULL, 'Bernard', 'Paul', NULL, NULL, NULL, '4784522315', 'boysgirlsclub@windstream.net'),
(31, NULL, 'Ragusa', 'Karen', NULL, NULL, NULL, '6782754055', 'karen@caring4creatures.com'),
(32, NULL, 'Harris', 'Rose', NULL, NULL, NULL, '4784450869', 'rharriscgtc@gmail.com'),
(33, NULL, 'Reese', 'Pam', NULL, NULL, NULL, '4784458270', 'preese_2@charter.net'),
(34, NULL, 'Shinholster', 'Denise', NULL, NULL, NULL, '4784554094', 'drshinho@dhr.state.ga.us'),
(35, NULL, 'Dennis', 'Melvene', NULL, NULL, NULL, '0', 'mdenniscgtc@gmail.com'),
(36, NULL, 'Franklin', 'Ramona', NULL, NULL, NULL, '4784538514', 'rfranklin@ethicahealth.org'),
(37, NULL, 'Britton', 'Tarver', NULL, NULL, NULL, '4786337890', 'Britton.Tarver@mccg.org'),
(38, NULL, 'Walker', 'Vanessa', NULL, NULL, '4782880276', '4784453110', 'cismilledgevillebaldwin@gmail.com'),
(39, NULL, 'Easterwood', 'Jerry', NULL, NULL, NULL, '4784565995', 'jerry.easterwood@us.army.mil'),
(40, NULL, 'Phillips', 'Jayne', NULL, NULL, NULL, '0', 'jaynephillips01@hotmail.com'),
(41, NULL, 'Adams', 'Andrew', NULL, NULL, NULL, '4784539628', 'gaadams_2@charter.net'),
(42, NULL, 'Bowen', 'Megan', 'T.', NULL, NULL, '4784452270', 'megan_bowen@windstream.net'),
(43, NULL, 'Whipple', 'Katie', NULL, NULL, NULL, '4784452270', 'kwhipple@creativeexpressionsstudio.org'),
(44, NULL, 'Alford', 'Pam', NULL, NULL, NULL, '4784527376', 'pjmama2001@yahoo.com'),
(45, NULL, 'Stevenson', 'Eva', NULL, NULL, NULL, '4784451959', 'emstevenson@dhr.state.ga.us'),
(46, NULL, NULL, NULL, NULL, NULL, NULL, '0', 'dogwoodr@windstream.net'),
(47, NULL, 'Scott', 'Jeanette', NULL, NULL, NULL, '0', 'jscott@baldwin.k12.ga.us'),
(48, NULL, 'Hollis', 'Cathy', NULL, NULL, NULL, '4784572465', 'Cathy.Hollis@baldwin.k12.ga.us'),
(49, NULL, 'Bazemore', 'Greg', NULL, NULL, NULL, '4784565042', 'greg.bazemore.gpcu@statefarm.com'),
(50, NULL, 'Sabree', 'Saleemah', NULL, NULL, NULL, '4784455465', 'ssabree541@charter.net'),
(51, NULL, 'Pulliam', 'Peggy', NULL, NULL, NULL, '4783630251', 'pastor_travis_cox@yahoo.com'),
(52, NULL, 'Bradley', 'Jerry', NULL, NULL, NULL, '4784520502', 'jbradley@fbcmilledgeville.com'),
(53, NULL, 'Baker', 'Mary', NULL, NULL, NULL, '4784529394', 'fpchurch@windstream.net'),
(54, NULL, 'Ferrell', 'Yvonne', NULL, NULL, NULL, '0', 'yebrooks18@windstream.net'),
(55, NULL, 'Stanelle', 'Lynn', NULL, NULL, NULL, '4784455465', 'lynn.stanelle@dol.state.ga.us'),
(56, NULL, 'Hawkins', 'Larry', NULL, NULL, NULL, '0', 'rehab@dol.state.ga.us'),
(57, NULL, 'Walker', 'Debbie', NULL, NULL, NULL, '4784531806', 'Debcares22357@aol.com'),
(58, NULL, 'DanielTyson', 'Camille', NULL, NULL, NULL, '0', 'camille.danieltyson@gcsu.edu'),
(59, NULL, 'Mercado', 'Chesley', NULL, NULL, NULL, '0', 'chesley.mercado@gcsu.edu'),
(60, NULL, 'Kaufman', 'Gregg', NULL, NULL, NULL, '0', 'gregg.kaufman@gcsu.edu'),
(61, NULL, 'GrahamStephens', 'Jennifer', NULL, NULL, NULL, '0', 'jennifer.grahamstephens@gcsu.edu'),
(62, NULL, 'WatsonKaufman', 'Linda', NULL, NULL, NULL, '0', 'linda.watsonkaufman@gcsu.edu'),
(63, NULL, 'Pogue', 'Revel', NULL, NULL, NULL, '0', 'revel.pogue@gcsu.edu'),
(64, NULL, 'Eilers', 'Ruth', NULL, NULL, NULL, '4784450810', 'ruth.eilers@gcsu.edu'),
(65, NULL, 'Faircloth', 'Sara', NULL, NULL, NULL, '0', 'sara.faircloth@gcsu.edu'),
(66, NULL, 'Miles', 'Tom', NULL, NULL, '1478414804', '4784452561', 'tom.miles@gcsu.edu'),
(67, NULL, 'Stiles', 'Kendall', 'M.', NULL, '4784562405', '4784455936', 'kendall.stiles@gcsu.edu'),
(68, NULL, 'Sedor', 'Paul', 'F.', 'II', NULL, '0', 'paul.sedor@gcsu.edu'),
(69, NULL, 'Grant', 'P', NULL, NULL, NULL, '0', 'pgrant@gmc.cc.ga.us'),
(70, NULL, 'Brown', 'Brenda', NULL, NULL, NULL, '0', 'bbrown@gmc.cc.ga.us'),
(71, NULL, 'Ross', 'Charlie', NULL, NULL, NULL, '0', 'chross@southernco.com'),
(72, NULL, 'Roach', 'Jenny', NULL, NULL, NULL, '4784455672', 'jroach1@windstream.net'),
(73, NULL, 'Doss', 'Cindy', NULL, NULL, NULL, '4784451783', 'gaporch@windstream.net'),
(74, NULL, 'Williamson', 'Charlotte', NULL, NULL, '7064842335', '8008684475', 'cwilliamson@gshg.org'),
(75, NULL, 'Satterwhite', 'Patsy', NULL, NULL, NULL, '0', 'patsysatterwhite@hotmail.com'),
(76, NULL, 'Stiff', 'J', NULL, NULL, NULL, '0', 'jstiff@goodwillworks.org'),
(77, NULL, 'Hall', 'Ivey', NULL, NULL, NULL, '4784714879', 'ihall@goodwillworks.org'),
(78, NULL, 'Philpot', 'Audrey', NULL, NULL, NULL, '4784714879', 'aphilpot@goodwillworks.org'),
(79, NULL, 'Avant', 'Jennifer', NULL, NULL, NULL, '4784539437', 'javant@ethicahealth.org'),
(80, NULL, 'Babb', 'Carol', NULL, NULL, '4786962829', '4784539617', 'habitat@windstream.net'),
(81, NULL, 'Hickey', 'Jack', NULL, NULL, '0', '4784539617', 'habitatforhumanity@windstream.net'),
(82, NULL, 'Hornsby', 'Carissa', NULL, NULL, '0', '4784524330', 'fhornsby@windstream.net'),
(83, NULL, 'Goodrich', 'Nathalie', NULL, NULL, '0', '4784520228', 'natgoodrich@charter.net'),
(84, NULL, NULL, NULL, NULL, NULL, '0', '0', 'info@harrietscloset.org'),
(85, NULL, 'Siragusa', 'Tamara', NULL, NULL, '0', '0', 'info@harrietscloset.org'),
(86, NULL, 'Hobbs', 'Victor', NULL, NULL, '0', '4784525090', NULL),
(87, NULL, 'Heqedus', 'Deanna', NULL, NULL, '0', '4784523696', 'hopeluth@windstream.net'),
(88, NULL, 'Beasley', 'Nancy', NULL, NULL, '0', '4784450518', 'nancy.beasley@gcsu.edu'),
(89, NULL, 'Taylor', 'Mary', NULL, NULL, '4782302331', '4784538573', 'mtaylor@hcoga.com'),
(90, NULL, 'Nunn', 'Cindy', NULL, NULL, '0', '478 452748', 'cnunn@johnmilledge.org'),
(91, NULL, 'Miller', 'Jason', NULL, NULL, '0', '4784525570', 'jmiller@johnmilledge.org'),
(92, NULL, 'Stair', 'Terry', NULL, NULL, '0', '4784455936', 'drstair@windstream.net'),
(93, NULL, 'Sowell', 'Randy', NULL, NULL, '0', '4784577881', 'jrsowell@windstream.net'),
(94, NULL, 'Barnes', 'Gregory', NULL, NULL, '0', '4784541831', 'pastorgregory@lpkingdomcenter.org'),
(95, NULL, 'Hill', 'Adrianne', NULL, NULL, '0', '4784568561', 'adrianne_rae@yahoo.com'),
(96, NULL, 'Cheely', 'Sheryl', NULL, NULL, '0', '0', 'sheryldc2004@yahoo.com'),
(97, NULL, 'Coleman', 'Barbara', NULL, NULL, '478 456752', '478 445572', 'bcoleman@thelifeenrichmentcenter.org'),
(98, NULL, 'Prance', 'Gloria', NULL, NULL, '0', '4784522112', 'lockerly@windstream.net'),
(99, NULL, 'Eilers', 'Greg', NULL, NULL, '0', '4784522112', 'geilers917@yahoo.com'),
(100, NULL, 'Gatti', 'Mary', NULL, NULL, '0', '4787558450', 'mgatti@gaal.wish.org'),
(101, NULL, 'Enchelmayer', 'Carl', 'R.', NULL, '4783630178', '4784529007', 'cenchel@hotmail.com'),
(102, NULL, 'Jasnau', 'Ken', NULL, NULL, '0', '7064858137', 'jasnau@hotmail.com'),
(103, NULL, 'Davis', 'Tori', NULL, NULL, '0', '0', 'tdavis@baldwin.k12.ga.us'),
(104, NULL, 'Fraley', 'Jean', NULL, NULL, '0', '0', 'jfraley02@yahoo.com'),
(105, NULL, 'Hallman', 'Paula', NULL, NULL, '0', '0', 'psioux1@windstream.net'),
(106, NULL, 'Dalrymple', 'Collene', NULL, NULL, '0', '4784524597', 'cdalrymple@milledgevillefumc.org'),
(107, NULL, 'Washington', 'Debra', NULL, NULL, '0', '4784452878', 'dwashington@windstream.net'),
(108, NULL, 'Goodrich', 'Ellen', NULL, NULL, '0', '4784527734', 'ellen59@windstream.net'),
(109, NULL, 'Noel', 'Cookie', NULL, NULL, '0', '4784539463', 'rcnoel@windstream.net'),
(110, NULL, 'Dean', 'Catherine', NULL, NULL, '0', '0', 'cjdean@windstream.net'),
(111, NULL, 'Washlesky', 'Belinda', NULL, NULL, '0', '4784144014', 'bwashlesky@milledgevillega.us'),
(112, NULL, 'Blue', 'Woodrow', NULL, NULL, '0', '4784144000', NULL),
(113, NULL, 'Reese', 'Paul', NULL, NULL, '0', '4784144000', 'mpdadmin@milledgevillepd.com'),
(114, NULL, 'Baker', 'Amy', NULL, NULL, '0', '4784146943', 'bbaker104@windstream.net'),
(115, NULL, 'Harris', 'Don', NULL, NULL, '0', '4784528600', 'harris0879@yahoo.com'),
(116, NULL, 'Furr', 'Brandon', NULL, NULL, '0', '4784574750', 'brandoncfurr@yahoo.com'),
(117, NULL, 'Ingram', 'Michelle', NULL, NULL, '0', '0', 'michingram@baldwin.k12.ga.us'),
(118, NULL, 'Vincent', 'Lucy', NULL, NULL, '0', '0', 'lvincent@baldwin.k12.ga.us'),
(119, NULL, 'Muggridge', 'Lori', NULL, NULL, '0', '4784529170', 'OCasalm@baldwin.k12.ga.us'),
(120, NULL, 'Chambliss', 'Margaret', NULL, NULL, '4784566705', '4784526968', 'bccainc@hotmail.com'),
(121, NULL, 'HicksHill', 'Angela', NULL, NULL, '0', '4784454817', 'oconeejaws@windstream.net'),
(122, NULL, 'Meeks', 'Veronica', NULL, NULL, '0', '0', 'oconeessc@windstream.net'),
(123, NULL, 'Brett', 'Dena', NULL, NULL, '4782328239', '4785532342', 'mdgbrett@yahoo.com'),
(124, NULL, 'Johnson', 'Angelika', NULL, NULL, '4784567853', '4785532342', 'ajohnson@oconeecenter.com'),
(125, NULL, 'Powell', 'Peggy', NULL, NULL, '0', '4784454818', 'oconeeacct@windstream.net'),
(126, NULL, 'Keim', 'Judith', NULL, NULL, '0', '4784562713', 'JKeim@windstream.net'),
(127, NULL, 'Moody', 'Lani', NULL, NULL, '0', '4784543705', 'lmoody@ormcinc.org'),
(128, NULL, 'McCulley', 'Colin', NULL, NULL, '0', '478 457212', 'cmcculley@ormcinc.org'),
(129, NULL, 'Langston', 'Heather', NULL, NULL, '0', '4784453462', NULL),
(130, NULL, 'Gerlich', 'Grant', NULL, NULL, '0', '4784531803', 'info@oldcapitalmuseum.org'),
(131, NULL, 'Gunn', 'Vickie', NULL, NULL, '0', '4784534111', 'vggunn@windstream.net'),
(132, NULL, 'Seagraves', 'Scott', NULL, NULL, '0', '4784525077', 'pathfinderschristianchurch@windstream.ne'),
(133, NULL, 'Jarrett', 'Carrie', NULL, NULL, '0', '4784532081', 'cjarrett2081@charter.net'),
(134, NULL, 'Miller', 'Nancy', NULL, NULL, '0', '0', 'nancy.miller@gcsu.edu'),
(135, NULL, 'Wilkinson', 'Patricia', NULL, NULL, '0', '0', 'wilkinsonusedcars@windstream.net'),
(136, NULL, 'Cofer', 'Charles', NULL, NULL, '0', '4784541811', 'mrcharlescofer@yahoo.com'),
(137, NULL, 'Nutt', 'Jan', NULL, NULL, '4784517573', '0', 'janrelay@yahoo.com'),
(138, NULL, 'Gray', 'Jamie', NULL, NULL, '0', '4784451290', 'jgray@riveredge.org'),
(139, NULL, 'Boone', 'Jean', NULL, NULL, '0', '4787514519', 'jboone@riveredge.org'),
(140, 'Dr', 'Bassilio', 'Cesar', NULL, NULL, '0', '4784574141', 'sacredheartmga@windstream.net'),
(141, NULL, 'Frazier', 'Helen', NULL, NULL, '0', '4784526940', 'helenfrazier@windstream.net'),
(142, NULL, 'Schulze', 'Heather', NULL, NULL, '0', '0', 'hdschulze@windstream.net'),
(143, NULL, 'Waddell', 'Julie', NULL, NULL, '0', '0', 'samsvoiceinc@yahoo.com'),
(144, NULL, 'Johnson', 'Mary', NULL, NULL, '0', '4784532157', 'shilohbaptistchurch204@yahoo.com'),
(145, NULL, 'Hall', 'Andy', NULL, NULL, '0', '4784524242', 'pastorandy624@yahoo.com'),
(146, NULL, 'Garland', 'Billy', NULL, NULL, '0', NULL, 'billy.garland@gcsu.edu'),
(147, NULL, 'New', 'Shannon', NULL, NULL, '0', '4784455777', 'sanew@dhr.state.ga.us'),
(148, NULL, 'McKnight', 'Lin', NULL, NULL, '0', '4784520008', 'birthflowers@yahoo.com'),
(149, NULL, 'Joris', 'Mary', 'Ann', NULL, '0', '4784522710', 'ststephens@windstream.net'),
(150, NULL, 'Sargent', 'George', NULL, NULL, '0', '4784523941', 'drs1212@windstream.net'),
(151, NULL, 'Walker', 'Amy', 'Gerwig', NULL, '0', '4783904828', 'amygerwig@hotmail.com'),
(152, NULL, 'Jackson', 'Teresa', NULL, NULL, '0', '7064855560', 'saviorstouch@windstream.net'),
(153, NULL, 'Hinton', 'Melissa', NULL, NULL, '0', '4784531434', 'mhinton@unionrecorder.com'),
(154, NULL, 'Chandler', 'Melaine', NULL, NULL, '0', '0', 'mcandler@ormcinc.org'),
(155, NULL, 'Hester', 'Pat', NULL, NULL, '4784717175', '0', 'pshester@windstream.net'),
(156, NULL, 'Bramlett', 'Adeline', NULL, NULL, '4789368557', '4784523110', 'trebella@windstream.net'),
(157, NULL, 'Carpenter', 'Kell', NULL, NULL, '0', '4784520677', 'kellcarpenter@tllsga.org'),
(158, NULL, 'Bender', 'Elizabeth', NULL, NULL, '0', '4784520677', 'elizabethbender@tllsga.org'),
(159, NULL, 'Reese', 'Barry', NULL, NULL, '0', '0', 'barryreese@twinlakeslibrarysystem.org'),
(160, NULL, 'LaBrun', 'Melissa', NULL, NULL, '0', '4784520567', 'imasur54@yahoo.com'),
(161, NULL, 'Cain', 'Alex', NULL, NULL, '0', '4784531458', 'acain@unionrecorder.com'),
(162, NULL, 'Clemmons', 'Shelia', NULL, NULL, '0', '4784531416', 'sclemmons@cnhi.com'),
(163, NULL, 'Ingles', 'Hurb', NULL, NULL, '0', '4782510756', 'hurbi@sprynet.com'),
(164, NULL, 'Baxter', 'Sandra', NULL, NULL, '4784575429', '4784522006', 'sbaxter@unitedwaycg.com'),
(165, NULL, 'Shinholster', 'Lisa', NULL, NULL, '0', '4784538976', 'vaughnchapel@windstream.net'),
(166, NULL, 'Huff', 'Candi', NULL, NULL, '0', '4784530667', 'chuff36@yahoo.com'),
(167, NULL, 'McNair', 'Bill', NULL, NULL, '0', '0', 'bmcnai9@windstream.net'),
(168, NULL, 'Barker', 'Bill', NULL, NULL, '0', '4784576779', 'bbaker104@yahoo.com'),
(169, NULL, 'Merritt', 'Dan', NULL, NULL, '0', '4786963365', 'dan_merritt2000@yahoo.com'),
(170, NULL, 'Branch', 'Jody', NULL, NULL, '0', '4784529140', 'jody_branch@hotmail.com'),
(171, NULL, 'Stephens', 'Jennifer', NULL, NULL, '0', '4784458156', 'womenscenter@gcsu.edu'),
(172, NULL, 'Taylor', 'Tony', NULL, NULL, '4784565397', '4784539406', 'z97mail@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `seasons`
--

DROP TABLE IF EXISTS `seasons`;
CREATE TABLE IF NOT EXISTS `seasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `season` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `seasons`
--

INSERT INTO `seasons` (`id`, `season`) VALUES
(1, 'Spring'),
(2, 'Summer'),
(3, 'Fall'),
(4, 'Winter');

-- --------------------------------------------------------

--
-- Table structure for table `student_contact`
--

DROP TABLE IF EXISTS `student_contact`;
CREATE TABLE IF NOT EXISTS `student_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_name` varchar(20) DEFAULT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `suf` char(3) DEFAULT NULL,
  `m_phone` char(10) DEFAULT NULL,
  `w_phone` char(10) DEFAULT NULL,
  `mail` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `student_contact`
--

INSERT INTO `student_contact` (`id`, `l_name`, `f_name`, `m_name`, `suf`, `m_phone`, `w_phone`, `mail`) VALUES
(1, 'Student', 'A', 'New', 'Jr', '1231231234', NULL, 'Student@gcsu.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(30) NOT NULL,
  `passwd` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`uname`,`passwd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `passwd`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3'),
('guest', 'd41d8cd98f00b204e9800998ecf8427e');
