-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 08, 2016 at 03:52 PM
-- Server version: 5.1.73
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `CollegeBytes`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE IF NOT EXISTS `Admin` (
  `Admin_ID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `User_ID` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Admin_Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Admin_Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Admin`
--

INSERT INTO `Admin` (`Admin_ID`, `User_ID`, `Admin_Name`, `Admin_Password`) VALUES
('root', NULL, 'Default', 'Pa55W0rd');

-- --------------------------------------------------------

--
-- Table structure for table `Assignments`
--

CREATE TABLE IF NOT EXISTS `Assignments` (
  `Assignment_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Assignment_Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Class_Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Grade_Type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Completion` text COLLATE utf8_unicode_ci NOT NULL,
  `Due_Date` date NOT NULL,
  `Grade` int(3) DEFAULT NULL,
  `User_ID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Assignment_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `Assignments`
--

INSERT INTO `Assignments` (`Assignment_ID`, `Assignment_Name`, `Class_Name`, `Grade_Type`, `Completion`, `Due_Date`, `Grade`, `User_ID`) VALUES
(1, 'Testyes', 'SomeClass', 'Test', 'Yes', '2016-06-20', 100, 'chrisrk192@gmail.com'),
(2, 'AssNine', 'That', 'Quiz', 'No', '2016-04-27', 0, 'chrisrk192@gmail.com'),
(3, 'homework', 'That', 'Home Work', 'No', '2016-04-27', 0, 'chrisrk192@gmail.com'),
(4, 'tmorw', 'Biology', 'Quiz', 'No', '2016-04-28', 0, 'chrisrk192@gmail.com'),
(5, 'Stupid Project', 'CIS222', 'Lab', 'No', '2016-05-09', 0, 'derin.r.coates@gmail.com'),
(6, 'Journal', 'Hiking106', 'Home Work', 'No', '2016-05-02', 0, 'chrisrk192@gmail.com'),
(7, 'suck it the 4th', 'That', 'Quiz', 'No', '2016-05-02', 0, 'chrisrk192@gmail.com'),
(8, 'the big one', 'Select', 'Quiz', 'Yes', '2016-09-22', 0, 'davevan41@gmail.com'),
(9, 'the one', 'Select', 'Test', 'No', '0000-00-00', 0, 'davevan41@gmail.com'),
(10, 'hmk', 'CIS222', 'Quiz', 'Yes', '2016-09-14', 0, 'davevan41@gmail.com'),
(13, 'test', 'Hiking106', 'Test', 'Yes', '2016-05-07', 50, 'chrisrk192@gmail.com'),
(14, 'something', 'Hiking106', 'Quiz', 'No', '2016-05-08', 20, 'chrisrk192@gmail.com'),
(15, 'Due today', 'Hiking106', 'Lab', 'No', '2016-05-07', 0, 'chrisrk192@gmail.com'),
(16, 'newTest', 'SomeClass', 'Test', 'Yes', '2016-06-20', 100, 'chrisrk192@gmail.com'),
(17, 'alertTest', 'Hiking106', 'Lab', 'No', '2016-05-07', 0, 'chrisrk192@gmail.com'),
(18, 'Lab 10', 'CIS250', 'Lab', 'No', '2016-05-10', 0, 'derin.r.coates@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE IF NOT EXISTS `Classes` (
  `Class_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Teach_ID` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Class_Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Class_Desc` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'No Description',
  `Sun` tinyint(1) NOT NULL DEFAULT '0',
  `Mon` tinyint(1) NOT NULL DEFAULT '0',
  `Tue` tinyint(1) NOT NULL DEFAULT '0',
  `Wed` tinyint(1) NOT NULL DEFAULT '0',
  `Thu` tinyint(1) NOT NULL DEFAULT '0',
  `Fri` tinyint(1) NOT NULL DEFAULT '0',
  `Sat` tinyint(1) NOT NULL DEFAULT '0',
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Test_Weight` int(4) NOT NULL,
  `Quiz_Weight` int(4) NOT NULL,
  `HW_Weight` int(4) NOT NULL,
  `Lab_Weight` int(4) NOT NULL,
  `Room` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `User_ID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Class_ID`),
  UNIQUE KEY `Teach_ID` (`Teach_ID`),
  KEY `Teach_ID_2` (`Teach_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`Class_ID`, `Teach_ID`, `Class_Name`, `Class_Desc`, `Sun`, `Mon`, `Tue`, `Wed`, `Thu`, `Fri`, `Sat`, `Start_Time`, `End_Time`, `Test_Weight`, `Quiz_Weight`, `HW_Weight`, `Lab_Weight`, `Room`, `User_ID`) VALUES
(12, 'Jack Donato', 'CIS250', 'PITA Class', 0, 0, 1, 0, 1, 0, 0, '14:00:00', '15:20:00', 20, 20, 20, 40, 'E-120', 'derin.r.coates@gmail.com'),
(13, 'Ernie Rosenblatz', 'HIS245', 'No Description', 0, 1, 0, 1, 0, 1, 0, '13:00:00', '14:00:00', 100, 100, 100, 100, 'E-110', 'derin.r.coates@gmail.com'),
(14, 'ObamaAA', 'SomeClass', 'This is some class about some type of subject lol', 1, 0, 0, 0, 0, 0, 1, '15:00:00', '17:00:00', 30, 20, 10, 40, 'E102', 'chrisrk192@gmail.com'),
(15, NULL, 'That Class', 'No Description', 0, 1, 1, 1, 1, 1, 0, '12:55:00', '15:05:00', 100, 100, 100, 100, '6102', 'chrisrk192@gmail.com'),
(16, NULL, 'Biology 106', 'No Description', 0, 1, 0, 1, 0, 1, 0, '14:00:00', '15:00:00', 30, 30, 10, 30, '800 A', 'chrisrk192@gmail.com'),
(17, 'CJ Jackson', 'CIS222', 'No Description', 0, 1, 0, 1, 0, 1, 0, '14:30:00', '16:25:00', 100, 100, 100, 100, '6-201', 'derin.r.coates@gmail.com'),
(18, NULL, 'CIS123', 'No Description', 0, 0, 0, 0, 1, 0, 0, '12:00:00', '13:59:00', 100, 100, 100, 100, '201-1', 'jason.ballinger@live.com'),
(19, 'Joe Smith', 'Hiking106', 'This is a description', 1, 0, 0, 0, 0, 0, 1, '07:00:00', '19:00:00', 100, 100, 100, 100, 'OutSide', 'chrisrk192@gmail.com'),
(20, NULL, 'CIS222', 'Systems analysis and design', 0, 1, 0, 1, 0, 0, 0, '14:30:00', '17:25:00', 25, 10, 10, 20, '6-201', 'davevan41@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `Student_ID` int(25) NOT NULL AUTO_INCREMENT,
  `Password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `User_First_Name` text COLLATE utf8_unicode_ci NOT NULL,
  `User_Last_Name` text COLLATE utf8_unicode_ci NOT NULL,
  `User_Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Student_ID`),
  UNIQUE KEY `Student_ID` (`Student_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`Student_ID`, `Password`, `User_First_Name`, `User_Last_Name`, `User_Email`) VALUES
(1, 'Pa55W0rd', 'Derin', 'Coates', 'derin.r.coates@gmail.com'),
(2, 'password', 'Chris', 'King', 'chrisrk192@gmail.com'),
(3, 'password', 'David', 'Vandenburg', 'davevan41@gmail.com'),
(4, 'password', 'Jason', 'Ballinger', 'jason.ballinger@live.com'),
(8, 'password', 'David', 'Vandenburg', 'davevan41@gmail.com'),
(9, 'password', 'Bob', 'Smith', 'bob@smith.com'),
(10, 'dv197036', 'David', 'Vandenburg', 'davevan41@gmail.com'),
(12, 'dv197036', 'david ', 'vandenburg', 'davevan41@gmail.com'),
(13, 'Pa55W0rd', 'Bye', 'Falisha', 'B@B.com');

-- --------------------------------------------------------

--
-- Table structure for table `Student_Contact`
--

CREATE TABLE IF NOT EXISTS `Student_Contact` (
  `Student_Contact_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Student_Contact_Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Class_Name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Student_Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Student_Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `User_ID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Student_Contact_ID`),
  UNIQUE KEY `Student_Phone` (`Student_Phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Student_Contact`
--

INSERT INTO `Student_Contact` (`Student_Contact_ID`, `Student_Contact_Name`, `Class_Name`, `Student_Phone`, `Student_Email`, `User_ID`) VALUES
(1, 'Mickey Mouse', 'CIS250', '315-555-1234', 'mickey@mouse.com', 'derin.r.coates@gmail.com'),
(2, 'Yo ydoe', 'SomeClass', '3155552345', '1@1.com', 'chrisrk192@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `Teacher_Contact`
--

CREATE TABLE IF NOT EXISTS `Teacher_Contact` (
  `Teacher_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Teacher_Name` text COLLATE utf8_unicode_ci NOT NULL,
  `Class_Name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Teacher_Phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Teacher_Office` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `Teacher_Email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `User_ID` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Teacher_ID`),
  UNIQUE KEY `Teacher_Phone` (`Teacher_Phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Teacher_Contact`
--

INSERT INTO `Teacher_Contact` (`Teacher_ID`, `Teacher_Name`, `Class_Name`, `Teacher_Phone`, `Teacher_Office`, `Teacher_Email`, `User_ID`) VALUES
(8, 'Jack Donato', 'CIS250', '315-555-9876', '5-123', 'jdonato@sunyjefferson.edu', 'derin.r.coates@gmail.com'),
(9, 'Ernie Rosenblatz', 'HIS245', '315-555-1234', 'E-110', 'erosenblatz@email.com', 'derin.r.coates@gmail.com'),
(10, 'CJ Jackson', 'CIS222', '315-555-4567', '5-124', 'cjackson@sunyjefferson.edu', 'derin.r.coates@gmail.com'),
(12, 'Mrs Doldo', 'CIS222', '315-354-8765', '7-283', 'ujdwjjwj@ikjvpj.com', 'davevan41@gmail.com'),
(13, 'Joe Smith', 'Hiking106', '3152333340', 'Outside', 'null@nothere.com', 'chrisrk192@gmail.com'),
(15, 'ObamaAA', 'SomeClass', '3155552345', 'White Ho', 'ob@wh.com', 'chrisrk192@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
