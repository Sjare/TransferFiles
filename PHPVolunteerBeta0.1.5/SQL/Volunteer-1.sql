-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 29, 2011 at 03:27 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VolDemo`
--

-- --------------------------------------------------------

--
-- Table structure for table `AccessGroups`
--

CREATE TABLE IF NOT EXISTS `AccessGroups` (
  `AccessID` int(11) NOT NULL AUTO_INCREMENT,
  `AccessName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`AccessID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `AccessGroups`
--

INSERT INTO `AccessGroups` (`AccessID`, `AccessName`) VALUES
(2, 'Volunteer'),
(3, 'Chair'),
(4, 'Report User'),
(9, 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `Blog`
--

CREATE TABLE IF NOT EXISTS `Blog` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `postTitle` text CHARACTER SET latin1 NOT NULL,
  `postBody` text CHARACTER SET latin1 NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`postID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Blog`
--


-- --------------------------------------------------------

--
-- Table structure for table `Documents`
--

CREATE TABLE IF NOT EXISTS `Documents` (
  `id_files` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `description` tinytext CHARACTER SET latin1 NOT NULL,
  `VOL_ID` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_files`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Documents`
--


-- --------------------------------------------------------

--
-- Table structure for table `Hours`
--

CREATE TABLE IF NOT EXISTS `Hours` (
  `HoursID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` varchar(11) NOT NULL,
  `Date` date DEFAULT NULL,
  `Hours` varchar(45) DEFAULT NULL,
  `HoursLocation` varchar(11) DEFAULT NULL,
  `HoursNotes` text,
  `HoursStatus` varchar(25) NOT NULL,
  PRIMARY KEY (`HoursID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Hours`
--


-- --------------------------------------------------------

--
-- Table structure for table `LocationAssignments`
--

CREATE TABLE IF NOT EXISTS `LocationAssignments` (
  `LocID` int(11) NOT NULL AUTO_INCREMENT,
  `Location` int(11) DEFAULT NULL,
  `VIP_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`LocID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `LocationAssignments`
--


-- --------------------------------------------------------

--
-- Table structure for table `Locations`
--

CREATE TABLE IF NOT EXISTS `Locations` (
  `LocationID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Address` varchar(150) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `Zip` varchar(7) DEFAULT NULL,
  `Notes` text,
  PRIMARY KEY (`LocationID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `Locations`
--

INSERT INTO `Locations` (`LocationID`, `Name`, `Address`, `City`, `State`, `Zip`, `Notes`) VALUES
(1, 'Test Location One', 'Test A', 'City A', 'St', 'AAAAA', 'This is A Test Location\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `ProfilePics`
--

CREATE TABLE IF NOT EXISTS `ProfilePics` (
  `id_files` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `description` tinytext NOT NULL,
  `VOL_ID` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_files`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `ProfilePics`
--


-- --------------------------------------------------------

--
-- Table structure for table `SiteVars`
--

CREATE TABLE IF NOT EXISTS `SiteVars` (
  `SiteVarCode` varchar(120) NOT NULL,
  `SiteVar` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SiteVars`
--

INSERT INTO `SiteVars` (`SiteVarCode`, `SiteVar`) VALUES
('CompanyName', 'PHP'),
('ApplicationTitle', 'Volunteer Management'),
('CreatedBy', '<a href="http://geekismybloodtype.com">Shawn M Bradley</a>'),
('BlogMod', 'Active'),
('NewsBlock1', '<h4>You can edit this information from the admin page!</h4>'),
('NewsBlock2', '<div>\r\n<h4>You can edit this information from the admin page!</h4>\r\n</div>'),
('NewsBlock3', '<h4>You can edit this information from the admin page!</h4>'),
('Assistance', '<p>If you need assistance please contact your technical support team.</p>'),
('HomeWelcome', '<div>\r\n<h4>You can edit this information from the admin page!</h4>\r\n</div>'),
('ReportsWelcome', '<div>\r\n<h4>You can edit this information from the admin page!</h4>\r\n</div>'),
('AdminWelcome', '<div>\r\n<h4>You can edit this information from the admin page!</h4>\r\n</div>'),
('WallMod', 'Active'),
('TaskMod', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `StatusLevels`
--

CREATE TABLE IF NOT EXISTS `StatusLevels` (
  `StatusLevelCode` varchar(3) CHARACTER SET latin1 NOT NULL,
  `StatusLevel` varchar(25) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `StatusLevels`
--

INSERT INTO `StatusLevels` (`StatusLevelCode`, `StatusLevel`) VALUES
('2', 'Active'),
('3', 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `Tasks`
--

CREATE TABLE IF NOT EXISTS `Tasks` (
  `TaskID` int(11) NOT NULL AUTO_INCREMENT,
  `TaskLocation` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `TaskDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `TaskStatus` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `TaskDateClosed` date NOT NULL,
  `TaskDateOpened` date NOT NULL,
  `TaskAssignedTo` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `TaskCreatedBy` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `TaskDueDate` date NOT NULL,
  `TaskHours` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TaskVolunteerNotes` text COLLATE utf8_unicode_ci NOT NULL,
  `TaskVerified` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`TaskID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Tasks`
--


-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `regIP` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `dt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `fn` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ln` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `VolunteerGender` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `VolunteerRace` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `VolunteerDOB` date NOT NULL,
  `VolunteerStartDate` date NOT NULL,
  `VolunteerEndDate` date NOT NULL,
  `AccessLevel` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `UserStatus` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `VolAddress` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `VolCity` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `VolState` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `VolZip` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `HomePhone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `WorkPhone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `CellPhone` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `Notes` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `pass`, `email`, `regIP`, `dt`, `fn`, `ln`, `VolunteerGender`, `VolunteerRace`, `VolunteerDOB`, `VolunteerStartDate`, `VolunteerEndDate`, `AccessLevel`, `UserStatus`, `VolAddress`, `VolCity`, `VolState`, `VolZip`, `HomePhone`, `WorkPhone`, `CellPhone`, `Notes`) VALUES
(1, '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', '', '0000-00-00 00:00:00', 'Super', 'Administrator', 'Male', 'White', '2011-03-29', '2011-03-29', '2011-03-29', '9', 'Active', '', '', '', '', '', '', '', ''),
(2, '5f4dcc3b5aa765d61d8327deb882cf99', 'Vollunteer', '', '0000-00-00 00:00:00', 'Volunteer', 'Test', 'Female', 'Black', '2011-03-29', '2011-03-29', '2011-03-29', '2', 'Active', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `UsersAccessLevel`
--

CREATE TABLE IF NOT EXISTS `UsersAccessLevel` (
  `id` int(11) NOT NULL DEFAULT '0',
  `ln` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `fn` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `AccessID` int(11) DEFAULT NULL,
  `AccessName` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `UsersAccessLevel`
--


-- --------------------------------------------------------

--
-- Table structure for table `Wall`
--

CREATE TABLE IF NOT EXISTS `Wall` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `postBody` text CHARACTER SET latin1 NOT NULL,
  `postUserID` varchar(10) CHARACTER SET latin1 NOT NULL,
  `postDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`postID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `Wall`
--

