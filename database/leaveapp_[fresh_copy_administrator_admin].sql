/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 50545
Source Host           : localhost:3306
Source Database       : leaveapp_[fresh_copy_administrator_admin]

Target Server Type    : MYSQL
Target Server Version : 50545
File Encoding         : 65001

Date: 2015-09-04 17:12:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `employeeblood`
-- ----------------------------
DROP TABLE IF EXISTS `employeeblood`;
CREATE TABLE `employeeblood` (
  `bId` int(11) NOT NULL AUTO_INCREMENT,
  `bName` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`bId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeeblood
-- ----------------------------
INSERT INTO `employeeblood` VALUES ('1', 'AB+');
INSERT INTO `employeeblood` VALUES ('2', 'AB-');
INSERT INTO `employeeblood` VALUES ('3', 'A+');
INSERT INTO `employeeblood` VALUES ('4', 'A-');
INSERT INTO `employeeblood` VALUES ('5', 'B+');
INSERT INTO `employeeblood` VALUES ('6', 'B-');
INSERT INTO `employeeblood` VALUES ('7', 'O+');
INSERT INTO `employeeblood` VALUES ('8', 'O-');

-- ----------------------------
-- Table structure for `employeedepartment`
-- ----------------------------
DROP TABLE IF EXISTS `employeedepartment`;
CREATE TABLE `employeedepartment` (
  `dptId` int(11) NOT NULL AUTO_INCREMENT,
  `dptName` varchar(100) DEFAULT NULL,
  `dptEmployeeCodeNumberWhoAddDept` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`dptId`),
  KEY `employeedepartment_ibfk_1` (`dptEmployeeCodeNumberWhoAddDept`),
  CONSTRAINT `employeedepartment_ibfk_1` FOREIGN KEY (`dptEmployeeCodeNumberWhoAddDept`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeedepartment
-- ----------------------------

-- ----------------------------
-- Table structure for `employeedesignation`
-- ----------------------------
DROP TABLE IF EXISTS `employeedesignation`;
CREATE TABLE `employeedesignation` (
  `desiId` int(11) NOT NULL AUTO_INCREMENT,
  `desiDptId` int(11) DEFAULT NULL,
  `desiDesignationName` varchar(100) DEFAULT NULL,
  `desiEmployeeCodeNumberWhoAddDesi` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`desiId`),
  KEY `desiDptId` (`desiDptId`) USING BTREE,
  KEY `desiDesignationName` (`desiDesignationName`),
  KEY `employeedesignation_ibfk_1` (`desiEmployeeCodeNumberWhoAddDesi`),
  CONSTRAINT `employeedesignation_ibfk_1` FOREIGN KEY (`desiDptId`) REFERENCES `employeedepartment` (`dptId`),
  CONSTRAINT `employeedesignation_ibfk_2` FOREIGN KEY (`desiEmployeeCodeNumberWhoAddDesi`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeedesignation
-- ----------------------------

-- ----------------------------
-- Table structure for `employeeinfo`
-- ----------------------------
DROP TABLE IF EXISTS `employeeinfo`;
CREATE TABLE `employeeinfo` (
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeeinfo
-- ----------------------------
INSERT INTO `employeeinfo` VALUES ('1', 'Administrator', 'System', 'Admin', null, null, null, null, null, null, null, null, null, 'kisorniru@gmail.com', 'admin', null, '1', null, null, '1');

-- ----------------------------
-- Table structure for `employeeleaveapplicationdetails`
-- ----------------------------
DROP TABLE IF EXISTS `employeeleaveapplicationdetails`;
CREATE TABLE `employeeleaveapplicationdetails` (
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
  KEY `lWhoApproved` (`lWhoApproved`),
  CONSTRAINT `employeeleaveapplicationdetails_ibfk_1` FOREIGN KEY (`lEmployeeCodeNumberWhoApply`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  CONSTRAINT `employeeleaveapplicationdetails_ibfk_2` FOREIGN KEY (`lLeaveId`) REFERENCES `leavedetails` (`lId`),
  CONSTRAINT `employeeleaveapplicationdetails_ibfk_3` FOREIGN KEY (`lWhoRecomand`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  CONSTRAINT `employeeleaveapplicationdetails_ibfk_4` FOREIGN KEY (`lWhoApproved`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeeleaveapplicationdetails
-- ----------------------------

-- ----------------------------
-- Table structure for `employeeleaveapplicationdetails_history`
-- ----------------------------
DROP TABLE IF EXISTS `employeeleaveapplicationdetails_history`;
CREATE TABLE `employeeleaveapplicationdetails_history` (
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
  KEY `lWhoApproved` (`lWhoApproved`),
  CONSTRAINT `employeeleaveapplicationdetails_history_ibfk_1` FOREIGN KEY (`lEmployeeCodeNumberWhoApply`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  CONSTRAINT `employeeleaveapplicationdetails_history_ibfk_2` FOREIGN KEY (`lLeaveId`) REFERENCES `leavedetails` (`lId`),
  CONSTRAINT `employeeleaveapplicationdetails_history_ibfk_3` FOREIGN KEY (`lWhoRecomand`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`),
  CONSTRAINT `employeeleaveapplicationdetails_history_ibfk_4` FOREIGN KEY (`lWhoApproved`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of employeeleaveapplicationdetails_history
-- ----------------------------

-- ----------------------------
-- Table structure for `leavedetails`
-- ----------------------------
DROP TABLE IF EXISTS `leavedetails`;
CREATE TABLE `leavedetails` (
  `lId` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lType` varchar(30) DEFAULT NULL,
  `lTotalDays` int(11) DEFAULT NULL,
  `lEmployeeCodeNumberWhoAddLeave` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`lId`),
  KEY `lType` (`lType`),
  KEY `employeeleave_ibfk_1` (`lEmployeeCodeNumberWhoAddLeave`),
  CONSTRAINT `leavedetails_ibfk_1` FOREIGN KEY (`lEmployeeCodeNumberWhoAddLeave`) REFERENCES `employeeinfo` (`eEmployeeCodeNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of leavedetails
-- ----------------------------
INSERT INTO `leavedetails` VALUES ('1', 'Casual Leave', '18', 'Administrator');
INSERT INTO `leavedetails` VALUES ('2', 'Sick Leave', '10', 'Administrator');
INSERT INTO `leavedetails` VALUES ('3', 'Earn Leave', '15', 'Administrator');
INSERT INTO `leavedetails` VALUES ('4', 'Metarnity Leave', '180', 'Administrator');
