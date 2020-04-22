-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 22, 2020 at 11:54 AM
-- Server version: 5.7.24
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_471`
--
CREATE DATABASE IF NOT EXISTS `project_471` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `project_471`;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DeptNum` int(11) NOT NULL,
  `DeptName` varchar(50) DEFAULT NULL,
  `managerSSN` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DeptNum`, `DeptName`, `managerSSN`) VALUES
(1, 'CSC', 222222222),
(2, 'MATH', 222222221),
(3, 'CHEM', 222222223);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `SSN` int(9) NOT NULL,
  `DOB` varchar(10) DEFAULT NULL,
  `Fname` varchar(30) DEFAULT NULL,
  `Mname` varchar(30) DEFAULT NULL,
  `Lname` varchar(30) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`SSN`, `DOB`, `Fname`, `Mname`, `Lname`, `Address`) VALUES
(111111111, '01/01/1998', 'Tyler', 'J', 'Rock', '1000 Northwest Rd. Nc'),
(111111112, '01/02/1998', 'Kelly', 'A', 'Smith', '1001 Northwest Rd. Nc'),
(111111113, '01/03/1998', 'Jack', 'K', 'Galaxy', '1003 Northwest Rd. Nc');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `ProjName` varchar(50) NOT NULL,
  `ProjNum` int(11) NOT NULL,
  `ProjDesc` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`ProjName`, `ProjNum`, `ProjDesc`) VALUES
('Large', 3, 'Large project'),
('Medium', 2, 'Medium project'),
('Small', 1, 'Small project');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `SSN` int(9) DEFAULT NULL,
  `ProjName` varchar(50) DEFAULT NULL,
  `ProjNum` int(100) DEFAULT NULL,
  `DeptNum` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`SSN`, `ProjName`, `ProjNum`, `DeptNum`) VALUES
(111111111, 'Small', 1, 1),
(111111112, 'Medium', 2, 2),
(111111113, 'Large', 3, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DeptNum`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`SSN`),
  ADD UNIQUE KEY `SSN` (`SSN`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`ProjName`,`ProjNum`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD KEY `SSN` (`SSN`),
  ADD KEY `DeptNum` (`DeptNum`),
  ADD KEY `ProjName` (`ProjName`,`ProjNum`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `works`
--
ALTER TABLE `works`
  ADD CONSTRAINT `works_ibfk_1` FOREIGN KEY (`SSN`) REFERENCES `employee` (`SSN`),
  ADD CONSTRAINT `works_ibfk_2` FOREIGN KEY (`DeptNum`) REFERENCES `department` (`DeptNum`),
  ADD CONSTRAINT `works_ibfk_3` FOREIGN KEY (`ProjName`,`ProjNum`) REFERENCES `project` (`ProjName`, `ProjNum`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
