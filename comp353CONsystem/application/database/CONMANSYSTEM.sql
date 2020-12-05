-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 03, 2020 at 09:11 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CONMANSYSTEM`
--
CREATE DATABASE IF NOT EXISTS `CONMANSYSTEM` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `CONMANSYSTEM`;

-- --------------------------------------------------------

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
CREATE TABLE `email` (
  `emailId` int(11) NOT NULL,
  `fromEid` int(11) NOT NULL,
  `toEid` int(11) NOT NULL,
  `subject` varchar(256) DEFAULT NULL,
  `body` varchar(1000) DEFAULT NULL,
  `emailStatus` varchar(256) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `outboxDelete` int(11) NOT NULL,
  `inboxDelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `entity`
--

DROP TABLE IF EXISTS `entity`;
CREATE TABLE `entity` (
  `eid` int(11) NOT NULL,
  `userId` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `entityType` int(11) DEFAULT NULL,
  `user_group` tinyint(1) DEFAULT NULL,
  `pwrd` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `entity`
--

INSERT INTO `entity` (`eid`, `userId`, `firstName`, `lastName`, `age`, `email`, `phone`, `entityType`, `user_group`, `pwrd`) VALUES
(-1, 'PUBLIC', NULL, NULL, NULL, NULL, NULL, -1, 0, ''),
(0, 'admin', NULL, NULL, NULL, NULL, NULL, NULL, 0, 'admin'),
(2, 'emperor42', 'Matthew', 'Giancola', 22, 'matthewgiancola@email.com', '1234567890', 0, 0, 'password'),
(6, 'tiffany910', 'Tiffany', 'Ah King', 22, 'tiffanyahking@email.com', '1234567891', 0, 0, 'password'),
(7, 'khadijasubtain', 'Khadija', 'Umer', 22, 'khadijaumer@email.com', '1234567892', 0, 0, 'password'),
(8, 'dgovi', 'Daniel', 'Gauvin', 22, 'danielgauvin@email.com', '1234567894', 0, 0, 'password'),
(9, 'Very Good Condo Association', NULL, NULL, NULL, NULL, NULL, NULL, 1, ''),
(13, '1998 Niagara Club', NULL, NULL, NULL, NULL, NULL, NULL, 1, ''),
(14, 'jsmith', 'John', 'Smith', 2020, 'johnsmith@gmail.com', '9876543210', 0, 0, 'password');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `groupId` int(11) NOT NULL,
  `groupName` varchar(255) DEFAULT NULL,
  `groupDescription` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groupId`, `groupName`, `groupDescription`) VALUES
(9, 'Very Good Condo Association', 'A very good condo association and development company'),
(13, '1998 Niagara Club', 'A club for 1998 Niagara');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE `manager` (
  `eid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`eid`, `pid`) VALUES
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `mid` int(11) NOT NULL,
  `replyTO` int(11) DEFAULT NULL,
  `msgTo` int(11) DEFAULT NULL,
  `msgFrom` int(11) DEFAULT NULL,
  `msgSubject` varchar(255) DEFAULT NULL,
  `msgText` varchar(2550) DEFAULT NULL,
  `msgAttach` varchar(2550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `replyTO`, `msgTo`, `msgFrom`, `msgSubject`, `msgText`, `msgAttach`) VALUES
(8, -1, -1, 8, 'POST', 'I have just moved into my new condo', ''),
(9, -1, -1, 8, 'POST', 'I have just taken this photo near my new condo', '../public/assets/uploads/8IMG_20170409_122805.jpg'),
(10, -1, -1, 8, 'POST', 'I like my condo', ''),
(11, -1, -1, 8, 'EVENTS', 'Online Amung Us Party', NULL),
(12, 11, -1, 8, 'EVENTSDATE', '2021-12-07', NULL),
(13, 11, -1, 8, 'EVENTSTIME', '04:01', NULL),
(14, 11, -1, 8, 'EVENTSLOCATION', 'Online', NULL),
(19, 14, NULL, 8, 'VOTES', NULL, NULL),
(20, 12, NULL, 8, 'VOTES', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `own`
--

DROP TABLE IF EXISTS `own`;
CREATE TABLE `own` (
  `eid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `myShare` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `own`
--

INSERT INTO `own` (`eid`, `pid`, `myShare`) VALUES
(8, 1, 100),
(2, 2, 100),
(7, 3, 100),
(6, 4, 100);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `pid` int(11) NOT NULL,
  `payTo` int(11) DEFAULT NULL,
  `payFrom` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `outstanding` int(11) NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `posted` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`pid`, `payTo`, `payFrom`, `total`, `outstanding`, `class`, `memo`, `posted`) VALUES
(1, 9, 9, 100000, 97000, 'BUDGET', 'The budget for 2021 outlined for general repairs and assorted whatnot, some has already been spent on filter upgrades for hvac ', '2020-12-02 18:20:37');

-- --------------------------------------------------------

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
CREATE TABLE `property` (
  `pid` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `property`
--

INSERT INTO `property` (`pid`, `address`) VALUES
(1, '1-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),
(2, '2-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),
(3, '3-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),
(4, '4-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),
(5, '5-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3');

-- --------------------------------------------------------

--
-- Table structure for table `relate`
--

DROP TABLE IF EXISTS `relate`;
CREATE TABLE `relate` (
  `relType` int(11) NOT NULL,
  `relSup` int(11) DEFAULT NULL,
  `eid` int(11) DEFAULT NULL,
  `tid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `relate`
--

INSERT INTO `relate` (`relType`, `relSup`, `eid`, `tid`) VALUES
(3, 0, 8, 9),
(3, 0, 2, 9),
(3, 0, 7, 9),
(3, 0, 6, 9),
(0, 0, 0, 13),
(0, 0, 2, 13),
(0, 0, 0, 9),
(3, 0, 8, 9),
(3, 0, 7, 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `email`
--
ALTER TABLE `email`
  ADD PRIMARY KEY (`emailId`);

--
-- Indexes for table `entity`
--
ALTER TABLE `entity`
  ADD PRIMARY KEY (`eid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD KEY `eid` (`eid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`),
  ADD KEY `msgTo` (`msgTo`),
  ADD KEY `msgFrom` (`msgFrom`);

--
-- Indexes for table `own`
--
ALTER TABLE `own`
  ADD KEY `eid` (`eid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `payTo` (`payTo`),
  ADD KEY `payFrom` (`payFrom`);

--
-- Indexes for table `property`
--
ALTER TABLE `property`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `relate`
--
ALTER TABLE `relate`
  ADD KEY `eid` (`eid`),
  ADD KEY `tid` (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `email`
--
ALTER TABLE `email`
  MODIFY `emailId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entity`
--
ALTER TABLE `entity`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `property`
--
ALTER TABLE `property`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `entity` (`eid`) ON DELETE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  ADD CONSTRAINT `manager_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `property` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`msgTo`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`msgFrom`) REFERENCES `entity` (`eid`) ON DELETE CASCADE;

--
-- Constraints for table `own`
--
ALTER TABLE `own`
  ADD CONSTRAINT `own_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  ADD CONSTRAINT `own_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `property` (`pid`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`payTo`) REFERENCES `entity` (`eid`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`payFrom`) REFERENCES `entity` (`eid`);

--
-- Constraints for table `relate`
--
ALTER TABLE `relate`
  ADD CONSTRAINT `relate_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  ADD CONSTRAINT `relate_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
