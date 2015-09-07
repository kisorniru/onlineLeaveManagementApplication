-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2015 at 10:10 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `leaveapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `employeeblood`
--

CREATE TABLE IF NOT EXISTS `employeeblood` (
  `bId` int(11) NOT NULL AUTO_INCREMENT,
  `bName` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`bId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `employeeblood`
--

INSERT INTO `employeeblood` (`bId`, `bName`) VALUES
(1, 'AB+'),
(2, 'AB-'),
(3, 'A+'),
(4, 'A-'),
(5, 'B+'),
(6, 'B-'),
(7, 'O+'),
(8, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `employeedepartment`
--

CREATE TABLE IF NOT EXISTS `employeedepartment` (
  `dptId` int(11) NOT NULL AUTO_INCREMENT,
  `dptName` varchar(100) DEFAULT NULL,
  `dptEmployeeCodeNumberWhoAddDept` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dptId`),
  KEY `employeedepartment_ibfk_1` (`dptEmployeeCodeNumberWhoAddDept`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `employeedepartment`
--

INSERT INTO `employeedepartment` (`dptId`, `dptName`, `dptEmployeeCodeNumberWhoAddDept`) VALUES
(1, 'BOE', 'BOE0001'),
(2, 'Presentation', 'BOE0001');

-- --------------------------------------------------------

--
-- Table structure for table `employeedesignation`
--

CREATE TABLE IF NOT EXISTS `employeedesignation` (
  `desiId` int(11) NOT NULL AUTO_INCREMENT,
  `desiDptId` int(11) DEFAULT NULL,
  `desiDesignationName` varchar(100) DEFAULT NULL,
  `desiEmployeeCodeNumberWhoAddDesi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`desiId`),
  KEY `desiDptId` (`desiDptId`) USING BTREE,
  KEY `desiDesignationName` (`desiDesignationName`),
  KEY `employeedesignation_ibfk_1` (`desiEmployeeCodeNumberWhoAddDesi`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employeedesignation`
--

INSERT INTO `employeedesignation` (`desiId`, `desiDptId`, `desiDesignationName`, `desiEmployeeCodeNumberWhoAddDesi`) VALUES
(1, 1, 'Software Developer', 'BOE0001'),
(2, 2, 'Sr. Executive', 'BOE0001'),
(3, 2, 'Executive', 'BOE0001'),
(4, 2, 'Jr. Executive', 'BOE0001');

-- --------------------------------------------------------

--
-- Table structure for table `employeeinfo`
--

CREATE TABLE IF NOT EXISTS `employeeinfo` (
  `eId` int(11) NOT NULL AUTO_INCREMENT,
  `eEmployeeCodeNumber` varchar(100) DEFAULT NULL,
  `eFirstName` varchar(45) DEFAULT NULL,
  `eLastName` varchar(45) DEFAULT NULL,
  `eDateOfBirth` date DEFAULT NULL,
  `eBloodGroup` int(11) DEFAULT NULL,
  `eGender` varchar(10) DEFAULT NULL,
  `ePhoneNumberPersonal` varchar(20) DEFAULT NULL,
  `ePhoneNumberOffice` varchar(20) DEFAULT NULL,
  `eParmanentAddress` varchar(255) DEFAULT NULL,
  `ePresentAddress` varchar(255) DEFAULT NULL,
  `eDptId` int(11) DEFAULT NULL,
  `eDesignationId` int(11) DEFAULT NULL,
  `eEmailAddress` varchar(100) DEFAULT NULL,
  `ePassword` varchar(255) DEFAULT NULL,
  `eEmployeeCodeNumberWhoAddEmployee` varchar(45) DEFAULT NULL,
  `eEmployeeVerification` int(11) DEFAULT NULL,
  `eWhoVerifytheEmployee` varchar(45) DEFAULT NULL,
  `eLastLogin` datetime DEFAULT NULL,
  `eEmpType` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`eId`),
  UNIQUE KEY `eCodeNumber_UNIQUE` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `employeeinfo`
--

INSERT INTO `employeeinfo` (`eId`, `eEmployeeCodeNumber`, `eFirstName`, `eLastName`, `eDateOfBirth`, `eBloodGroup`, `eGender`, `ePhoneNumberPersonal`, `ePhoneNumberOffice`, `eParmanentAddress`, `ePresentAddress`, `eDptId`, `eDesignationId`, `eEmailAddress`, `ePassword`, `eEmployeeCodeNumberWhoAddEmployee`, `eEmployeeVerification`, `eWhoVerifytheEmployee`, `eLastLogin`, `eEmpType`) VALUES
(1, 'BOE0001', 'Noor-A-Alam', 'Siddique', '1991-03-02', 1, 'Male', '+8801673888920', '+8801841710175', 'test Parmanent Address', 'test Present Address', 1, 1, 'kisorniru@gmail.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-30 11:59:31', 1),
(2, 'PRE0001', 'kisor', 'niru', '1991-03-02', 1, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 2, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 2),
(3, 'BOE0002', 'First Name', 'Last Name', '1991-02-03', 2, 'Male', '1345654654', '+889876543210', 'test Parmanent Address', 'test Present Address', 1, 1, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 20:19:32', 3),
(4, 'PRE0002', 'First Name', 'Last Name', '1991-02-03', 2, 'Male', '+880123456789', '', 'test Parmanent Address', 'test Present Address', 2, 3, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(5, 'BOE0003', 'First Name', 'Last Name', '1991-02-03', 3, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 1, 1, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(6, 'PRE0003', 'First Name', 'Last Name', '1991-02-03', 3, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 2, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(7, 'PRE0004', 'First Name', 'Last Name', '1991-02-03', 4, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 2, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(8, 'PRE0005', 'First Name', 'Last Name', '1991-02-03', 4, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 2, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(9, 'PRE0006', 'First Name', 'Last Name', '1991-02-03', 5, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 4, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(10, 'PRE0007', 'First Name', 'Last Name', '1991-02-03', 6, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 4, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(12, 'PRE0008', 'First Name', 'Last Name', '1991-02-03', 7, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 2, 4, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(13, 'BOE0004', 'First Name', 'Last Name', '1991-02-03', 8, 'Male', '+880123456789', '+889876543210', 'test Parmanent Address', 'test Present Address', 1, 1, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 13:17:17', 3),
(14, 'BOE0012', 'FTest ', 'LTest', '1987-11-05', 1, 'Male', '65416464', '266663645', 'sdfsdf', 'sdfsdfsd', 1, 3, 'test@test.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-30 11:59:47', 3),
(15, 'ET00633', 'Rakib', 'Hossen', '2015-01-01', 1, 'Male', '123456789', '987654321', 'parmanent address', 'present address', 1, 2, 'rakibhossen49@gmail.com', '123', 'BOE0001', 1, 'BOE0001', '2015-08-24 19:35:47', 3);

-- --------------------------------------------------------

--
-- Table structure for table `employeeleaveapplicationdetails`
--

CREATE TABLE IF NOT EXISTS `employeeleaveapplicationdetails` (
  `lId` int(11) NOT NULL AUTO_INCREMENT,
  `lEmployeeCodeNumberWhoApply` varchar(45) DEFAULT NULL,
  `lApplyDate` date DEFAULT NULL,
  `lLeaveId` tinyint(4) DEFAULT NULL,
  `lEmployeeImargencyAddress` varchar(255) DEFAULT NULL,
  `lLeaveFromDate` date DEFAULT NULL,
  `lLeaveToDate` date DEFAULT NULL,
  `lTotalLeaveDays` int(11) DEFAULT NULL,
  `lTotalLeaveDaysRemain` int(11) DEFAULT NULL,
  `lLeaveReason` varchar(255) DEFAULT NULL,
  `lAlternativeEmployeeCardNumber` varchar(45) DEFAULT NULL,
  `lIsApproved` tinyint(4) DEFAULT NULL,
  `lIsRecomanded` tinyint(4) DEFAULT NULL,
  `lWhoRecomand` varchar(100) DEFAULT NULL,
  `lWhoApproved` varchar(100) DEFAULT NULL,
  `lWhoEdit` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`lId`),
  KEY `lEmployeeLeaveType_fk_lType` (`lLeaveId`),
  KEY `lEmployeeCodeNumberWhoApply` (`lEmployeeCodeNumberWhoApply`),
  KEY `lWhoRecomand` (`lWhoRecomand`),
  KEY `lWhoApproved` (`lWhoApproved`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employeeleaveapplicationdetails`
--

INSERT INTO `employeeleaveapplicationdetails` (`lId`, `lEmployeeCodeNumberWhoApply`, `lApplyDate`, `lLeaveId`, `lEmployeeImargencyAddress`, `lLeaveFromDate`, `lLeaveToDate`, `lTotalLeaveDays`, `lTotalLeaveDaysRemain`, `lLeaveReason`, `lAlternativeEmployeeCardNumber`, `lIsApproved`, `lIsRecomanded`, `lWhoRecomand`, `lWhoApproved`, `lWhoEdit`) VALUES
(1, 'BOE0001', '2015-08-24', 2, 'sfsadf', '2015-08-24', '2015-08-27', 3, 12, 'fsdfaf', 'BOE0012', 1, 1, 'BOE0001', 'BOE0001', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leavedetails`
--

CREATE TABLE IF NOT EXISTS `leavedetails` (
  `lId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lType` varchar(30) DEFAULT NULL,
  `lTotalDays` int(11) DEFAULT NULL,
  `lEmployeeCodeNumberWhoAddLeave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lId`),
  KEY `lType` (`lType`),
  KEY `employeeleave_ibfk_1` (`lEmployeeCodeNumberWhoAddLeave`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `leavedetails`
--

INSERT INTO `leavedetails` (`lId`, `lType`, `lTotalDays`, `lEmployeeCodeNumberWhoAddLeave`) VALUES
(1, 'Casual Leave', 18, NULL),
(2, 'Sick Leave', 15, NULL),
(3, 'Earn Leave', 12, NULL),
(4, 'Maternity Leave', 180, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employeedepartment`
--
ALTER TABLE `employeedepartment`
  ADD CONSTRAINT `employeedepartment_ibfk_1` FOREIGN KEY (`dptEmployeeCodeNumberWhoAddDept`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`);

--
-- Constraints for table `employeedesignation`
--
ALTER TABLE `employeedesignation`
  ADD CONSTRAINT `desiDeptId_fk_dptId` FOREIGN KEY (`desiDptId`) REFERENCES `employeedepartment` (`dptId`),
  ADD CONSTRAINT `employeedesignation_ibfk_1` FOREIGN KEY (`desiEmployeeCodeNumberWhoAddDesi`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`);

--
-- Constraints for table `employeeleaveapplicationdetails`
--
ALTER TABLE `employeeleaveapplicationdetails`
  ADD CONSTRAINT `employeeleaveapplicationdetails_ibfk_1` FOREIGN KEY (`lEmployeeCodeNumberWhoApply`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  ADD CONSTRAINT `employeeleaveapplicationdetails_ibfk_2` FOREIGN KEY (`lLeaveId`) REFERENCES `leavedetails` (`lId`),
  ADD CONSTRAINT `employeeleaveapplicationdetails_ibfk_3` FOREIGN KEY (`lWhoRecomand`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  ADD CONSTRAINT `employeeleaveapplicationdetails_ibfk_4` FOREIGN KEY (`lWhoApproved`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`);

--
-- Constraints for table `leavedetails`
--
ALTER TABLE `leavedetails`
  ADD CONSTRAINT `leavedetails_ibfk_1` FOREIGN KEY (`lEmployeeCodeNumberWhoAddLeave`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
