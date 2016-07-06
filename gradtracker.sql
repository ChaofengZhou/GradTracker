DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `uid` char(8) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
);

DROP TABLE IF EXISTS `Role`;
CREATE TABLE `Role` (
  `uid` char(8) NOT NULL,
  `role` char(10) NOT NULL,
  PRIMARY KEY (`uid`,`role`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Student`;
CREATE TABLE `Student` (
  `uid` char(8) NOT NULL,
  `degree` varchar(30) DEFAULT NULL,
  `track` varchar(30) DEFAULT NULL,
  `semesterAdmitted` char(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Advisor`;
CREATE TABLE `Advisor` (
  `uid` char(8) NOT NULL,
  `officeRoom` char(10) DEFAULT NULL,
  `officePhone` char(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Staff`;
CREATE TABLE `Staff` (
  `uid` char(8) NOT NULL,
  `officeRoom` char(10) DEFAULT NULL,
  `officePhone` char(15) DEFAULT NULL,
  PRIMARY KEY (`uid`),
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Advises`;
CREATE TABLE `Advises` (
  `advisorId` char(8) NOT NULL,
  `studentId` char(8) NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`advisorId`,`studentId`),
  FOREIGN KEY (`advisorId`) REFERENCES `Advisor` (`uid`),
  FOREIGN KEY (`studentId`) REFERENCES `Student` (`uid`)
);

DROP TABLE IF EXISTS `IsCommitteeOf`;
CREATE TABLE `IsCommitteeOf` (
  `advisorId` char(8) NOT NULL,
  `studentId` char(8) NOT NULL,
  PRIMARY KEY (`advisorId`,`studentId`),
  FOREIGN KEY (`advisorId`) REFERENCES `Advisor` (`uid`) ON DELETE CASCADE,
  FOREIGN KEY (`studentId`) REFERENCES `Student` (`uid`) ON DELETE CASCADE
);

DROP TABLE IF EXISTS `Form`;
CREATE TABLE `Form` (
  `formId` int(11) NOT NULL AUTO_INCREMENT,
  `uid` char(8) NOT NULL,
  `createdDate` datetime NOT NULL,
  `modifiedDate` datetime NOT NULL,
  `numOfSemesters` int(11) DEFAULT NULL,
  `identifyAdvisor` int(11) DEFAULT NULL,
  `programApprovedInitial` int(11) DEFAULT NULL,
  `teachingMentorship` int(11) DEFAULT NULL,
  `completeRequiredCourse` int(11) DEFAULT NULL,
  `committeeFormed` int(11) DEFAULT NULL,
  `programApproved` int(11) DEFAULT NULL,
  `writtenQualifier` int(11) DEFAULT NULL,
  `oralProposal` int(11) DEFAULT NULL,
  `dissertationDefense` int(11) DEFAULT NULL,
  `finalDocument` int(11) DEFAULT NULL,
  `progressDescription` text,
  `submitted` INT(1) NOT NULL,
  `approvedByAdvisor` char(8) DEFAULT NULL,
  `advisorApprovedDate` date DEFAULT NULL,
  `approvedByStaff` char(8) DEFAULT NULL,
  `staffApprovedDate` date DEFAULT NULL,
  `dgsApproved` INT(1) NOT NULL,
  `dgsApprovedDate` date DEFAULT NULL,
  PRIMARY KEY (`formId`, `modifiedDate`),
  FOREIGN KEY (`uid`) REFERENCES `Student` (`uid`) ON DELETE CASCADE,
  FOREIGN KEY (`approvedBYAdvisor`) REFERENCES `Advisor` (`uid`) ON DELETE CASCADE,
  FOREIGN KEY (`approvedByStaff`) REFERENCES `Staff` (`uid`) ON DELETE CASCADE
);


-- DROP TABLE IF EXISTS `CommitteeOnForm`;
-- CREATE TABLE `CommitteeOnForm` (
--   `formId` int(11) NOT NULL,
--   `advisorId` char(8) NOT NULL,
--   PRIMARY KEY (`formId`,`advisorId`),
--   FOREIGN KEY (`formId`) REFERENCES `Form` (`formId`) ON DELETE CASCADE,
--   FOREIGN KEY (`advisorId`) REFERENCES `Advisor` (`uid`) ON DELETE CASCADE
-- );


DROP TABLE IF EXISTS `Comments`;
CREATE TABLE `Comments` (
  `uid` char(8) NOT NULL,
  `formId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`uid`,`formId`),
  FOREIGN KEY (`formId`) REFERENCES `Form` (`formId`) ON DELETE CASCADE,
  FOREIGN KEY (`uid`) REFERENCES `User` (`uid`) ON DELETE CASCADE
);
