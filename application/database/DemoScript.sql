CREATE DATABASE  IF NOT EXISTS `iac353_2` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `iac353_2`;
-- MySQL dump 10.13  Distrib 8.0.21, for macos10.15 (x86_64)
--
-- Host: localhost    Database: iac353_2
-- ------------------------------------------------------
-- Server version	8.0.22

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `email`
--

DROP TABLE IF EXISTS `email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `email` (
  `emailId` int NOT NULL AUTO_INCREMENT,
  `fromEid` int NOT NULL,
  `toEid` int NOT NULL,
  `subject` varchar(256) DEFAULT NULL,
  `body` varchar(1000) DEFAULT NULL,
  `emailStatus` varchar(256) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `outboxDelete` int NOT NULL,
  `inboxDelete` int NOT NULL,
  PRIMARY KEY (`emailId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email`
--

LOCK TABLES `email` WRITE;
/*!40000 ALTER TABLE `email` DISABLE KEYS */;
INSERT INTO `email` VALUES (1,7,6,'Christmas invitation','You are not invited','Read','2020-12-04 19:16:51',0,0),(2,6,7,'RE: Christmas invitation','I dont care about your party ok?\r\n\r\n=========================================================\r\nfrom: [khadijaumer@email.com] 	 on: [2020-12-04 19:16:51]\r\n=========================================================\r\nYou are not invited','Read','2020-12-04 19:17:32',0,0),(3,7,6,'Christmas invitation','','Read','2020-12-04 19:18:28',1,0),(4,2,2,'Test Email','This is a test email','Read','2020-12-04 19:21:57',0,0),(5,7,6,'RE: RE: Christmas invitation','okay okay... you can join me         \r\n===========================================================\r\nfrom: [tiffanyahking@email.com] 	 on: [2020-12-04 19:17:32]\r\n===========================================================\r\nI dont care about your party ok?\r\n\r\n=========================================================\r\nfrom: [khadijaumer@email.com] 	 on: [2020-12-04 19:16:51]\r\n=========================================================\r\nYou are not invited','Read','2020-12-04 19:25:28',0,0),(6,7,2,'Message from the Future','You will get an error while uploading an image.','Read','2020-12-04 19:28:09',0,0),(7,7,6,'humble request','C\'mon now .... wont you joing me ???','Read','2020-12-04 19:33:16',0,0),(8,6,7,'RE: Christmas invitation','why am I not invited\r\n=========================================================\r\nfrom: [khadijaumer@email.com] 	 on: [2020-12-04 19:16:51]\r\n=========================================================\r\nYou are not invited','Read','2020-12-04 20:23:52',0,0),(9,7,6,'RE: RE: Christmas invitation','because i love you soooo much\r\n===========================================================\r\nfrom: [tiffanyahking@email.com] 	 on: [2020-12-04 20:23:52]\r\n===========================================================\r\nwhy am I not invited\r\n=========================================================\r\nfrom: [khadijaumer@email.com] 	 on: [2020-12-04 19:16:51]\r\n=========================================================\r\nYou are not invited','Read','2020-12-04 20:24:08',0,0),(10,7,7,'FW: RE: Christmas invitation','why am I not invited\r\n=========================================================\r\nfrom: [khadijaumer@email.com] 	 on: [2020-12-04 19:16:51]\r\n=========================================================\r\nYou are not invited','Read','2020-12-07 12:48:25',0,0);
/*!40000 ALTER TABLE `email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entity`
--

DROP TABLE IF EXISTS `entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entity` (
  `eid` int NOT NULL AUTO_INCREMENT,
  `userId` varchar(255) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `entityType` int DEFAULT NULL,
  `user_group` tinyint(1) DEFAULT NULL,
  `pwrd` varchar(255) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entity`
--

LOCK TABLES `entity` WRITE;
/*!40000 ALTER TABLE `entity` DISABLE KEYS */;
INSERT INTO `entity` VALUES (-1,'PUBLIC',NULL,NULL,NULL,NULL,NULL,-1,0,''),(0,'admin',NULL,NULL,NULL,NULL,NULL,NULL,0,'admin'),(2,'emperor42','Matthew','Giancola',22,'matthewgiancola@email.com','1234567890',0,0,'password'),(6,'tiffany910','Tiffany','Ah King',22,'tiffanyahking@email.com','1234567891',0,0,'password'),(7,'khadijasubtain','Khadija','Umer',22,'khadijaumer@email.com','1234567892',0,0,'password'),(8,'dgovi','Daniel','Gauvin',22,'danielgauvin@email.com','1234567894',0,0,'password'),(9,'Very Good Condo Association',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(13,'1998 Niagara Club',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(14,'jsmith','John','Smith',2020,'johnsmith@gmail.com','9876543210',0,0,'password'),(16,'Avengers',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(18,'Avengers',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(19,'Concordia ALum',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(20,'Concordia ALum',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(21,'party planer',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(22,'Concordia ALum',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(23,'Gina Cody Students',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(24,'Gina Cody Students',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(25,'GCS Students',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(26,'Testing group',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(27,'Testing group',NULL,NULL,NULL,NULL,NULL,NULL,1,''),(29,'dingdong','horse','dong',2020,'ding@dong.com','1234567890',0,0,'password'),(31,'sausage',NULL,NULL,NULL,NULL,NULL,NULL,1,'');
/*!40000 ALTER TABLE `entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `groups` (
  `gid` int NOT NULL AUTO_INCREMENT,
  `groupId` int NOT NULL,
  `groupName` varchar(255) DEFAULT NULL,
  `groupDescription` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`gid`),
  KEY `fk_groups_1_idx` (`groupId`),
  CONSTRAINT `fk_groups_1` FOREIGN KEY (`groupId`) REFERENCES `entity` (`eid`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,9,'Very Good Condo Association','A very good condo association and development company'),(2,13,'1998 Niagara Club','A club for 1998 Niagara'),(3,16,'Avengers','End Game'),(4,19,'Concordia ALum','A group for Cocordia Students'),(5,21,'party planer','party planner for condo association'),(6,26,'Testing group','this is another group'),(7,26,'Testing group','this is another group'),(9,31,'sausage','sausage group');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `manager` (
  `eid` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  KEY `eid` (`eid`),
  KEY `pid` (`pid`),
  CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  CONSTRAINT `manager_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `property` (`pid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `manager`
--

LOCK TABLES `manager` WRITE;
/*!40000 ALTER TABLE `manager` DISABLE KEYS */;
INSERT INTO `manager` VALUES (9,1),(9,2),(9,3),(9,4),(9,5),(9,6);
/*!40000 ALTER TABLE `manager` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `mid` int NOT NULL AUTO_INCREMENT,
  `replyTO` int DEFAULT NULL,
  `msgTo` int DEFAULT NULL,
  `msgFrom` int DEFAULT NULL,
  `msgSubject` varchar(255) DEFAULT NULL,
  `msgText` varchar(2550) DEFAULT NULL,
  `msgAttach` varchar(2550) DEFAULT NULL,
  PRIMARY KEY (`mid`),
  KEY `msgTo` (`msgTo`),
  KEY `msgFrom` (`msgFrom`),
  KEY `fk_messages_1_idx` (`replyTO`),
  CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`msgTo`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`msgFrom`) REFERENCES `entity` (`eid`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (-1,-1,NULL,NULL,NULL,NULL,NULL),(8,-1,-1,8,'POST','I have just moved into my new condo',''),(9,-1,-1,8,'POST','I have just taken this photo near my new condo','../public/assets/uploads/8IMG_20170409_122805.jpg'),(10,-1,-1,8,'POST','I like my condo',''),(11,-1,-1,8,'EVENTS','Online Amung Us Party',NULL),(12,11,-1,8,'EVENTSDATE','2021-12-07',NULL),(13,11,-1,8,'EVENTSTIME','04:01',NULL),(14,11,-1,8,'EVENTSLOCATION','Online',NULL),(19,14,NULL,8,'VOTES',NULL,NULL),(20,12,NULL,8,'VOTES',NULL,NULL),(21,-1,-1,9,'POST','We are having a fish fry on the 15th of the month',''),(22,-1,-1,9,'POST','We are having a fish fry on the 15th of the month',''),(25,21,9,2,'COMMENT','I want to go to the fish fry',''),(26,21,9,2,'COMMENT','I want to go to the fish fry',''),(27,8,8,2,'COMMENT','Excellent',''),(28,8,8,2,'COMMENT','Excellent',''),(29,-1,-1,2,'POST','now edit the text','../public/assets/uploads/2IMG_20161121_130829.jpg'),(30,-1,-1,7,'PAD','Check out the pic','../public/assets/uploads/7IMG_20191205_0001.jpg'),(31,-1,13,2,'POST','This shoudl be the logo for our club','/public/assets/uploads/2aims.png'),(32,-1,-1,2,'POST','This is a new image that I took','../public/assets/uploads/2IMG_20170409_122805.jpg'),(34,-1,-1,7,'PAD','Image please work','../public/assets/uploads/7IMG_20191205_0002.jpg'),(35,-1,-1,7,'PAD','oh boy!! what wrong',''),(37,36,7,7,'COMMENT','what gives?',''),(38,27,2,7,'COMMENT','Yeah',''),(39,-1,-1,7,'POST','My concern is that modify comments are not working',''),(42,-1,-1,7,'CONTRACTS','Contract to fix bugs',NULL),(43,42,-1,7,'CONTRACTSCOMPLETE','I will pay 0.2 cents',NULL),(44,42,-1,7,'CONTRACTSOFFER','I will pay 0.5 cents',NULL),(45,-1,13,13,'POST','We are having a meeting on the 15th',''),(47,-1,9,9,'POST','We are having a general meeting on the 15th of the month',''),(50,41,NULL,0,'VOTEYEA',NULL,NULL),(52,46,NULL,0,'VOTENAY',NULL,NULL),(53,-1,9,2,'PM','Hello this is the first group chat',''),(54,-1,9,7,'PM','hello',''),(55,-1,9,7,'PM','World',''),(56,-1,9,2,'PM','so now we can have a group chat',''),(57,-1,9,7,'PM','we should not show flash message after each submit',''),(58,-1,9,2,'PM','wait it deleted the things',''),(59,-1,9,7,'PM','auto refresh in progress',''),(60,-1,9,7,'PM','should we add time stamps to past messages?',''),(61,-1,9,7,'PM','Or at least the name of person who sent a chat text',''),(62,-1,9,7,'PM','else ppl will say nasty things and will get away with it. Zero accountability',''),(63,-1,9,2,'PM','I mean its maybe alright but it can be added in if we need',''),(64,-1,9,6,'PM','HELLO YOU STINK',''),(65,-1,9,2,'PM','this is a new message',''),(66,-1,9,2,'PM','wow harsh number 6',''),(67,39,7,6,'COMMENT','what happened',''),(68,-1,9,7,'PM','oh boy',''),(69,-1,6,2,'PM','Hello World',''),(70,-1,2,7,'PM','This is a first private message',''),(71,-1,2,7,'PM','','../public/assets/uploads/7IMG_20191205_0001.jpg'),(72,-1,9,7,'PM','no one knows I was here ... no one saw me',''),(75,14,NULL,7,'VOTES',NULL,NULL),(76,-1,2,7,'PM','can we vote down ?',''),(77,12,NULL,7,'VOTES',NULL,NULL),(78,-1,2,7,'PM','nvm it works',''),(79,-1,6,7,'PM','should i delete you again?',''),(80,-1,7,6,'PM','hellooo',''),(81,-1,6,0,'PM','hekki',''),(82,-1,6,7,'PM','yo whazup',''),(83,-1,6,7,'PM','whats cooking',''),(84,-1,0,6,'PM','hello admin',''),(85,-1,6,7,'PM','im trying to say in a way of slang lol \'',''),(86,-1,6,7,'PM','!@#$%^&*()(*&^%$#!@#$%^&*',''),(89,12,NULL,6,'VOTES',NULL,NULL),(90,14,NULL,6,'VOTES',NULL,NULL),(91,-1,-1,0,'CONTRACTS','Somebody fix the door in the hallway',NULL),(92,91,-1,0,'CONTRACTSCOMPLETE','a new offer for 15',NULL),(94,-1,0,0,'POLLS','Should we open up the condo to more pwople',NULL),(95,-1,0,0,'POLLS','This is a test',NULL),(96,-1,0,0,'POLLS','A new poll',NULL),(97,-1,0,0,'CONTRACTS','Test Contract 2',NULL),(98,-1,-1,2,'POLLS','Be it resukved that we switch to led',NULL),(100,-1,0,0,'EVENTS','Bake Sale',NULL),(102,-1,9,2,'POLLS','Switch to led for every light outside',NULL),(103,8,8,2,'COMMENT','This is a comment',''),(107,-1,13,0,'EVENTS','Emergency',NULL),(110,108,NULL,7,'VOTEYEA',NULL,NULL),(111,45,13,7,'COMMENT','hello can some one guide me with condo assoc',''),(114,-1,0,21,'POLLS','Part at old port',NULL),(117,114,NULL,7,'VOTEYEA',NULL,NULL),(118,-1,13,0,'POST','I dont think we should party during pandemic',''),(119,-1,19,2,'PM','Hello world',''),(120,29,2,2,'COMMENT','comment layer 1',''),(121,-1,13,0,'POST','I dont think we should party during pandemic',''),(122,-1,13,21,'POST','I dont think we should party during pandemic',''),(123,91,-1,7,'CONTRACTSCOMPLETE','i call 50.. and logs and some hinges thanks',NULL),(124,13,NULL,2,'VOTES',NULL,NULL),(125,12,NULL,-1,'VOTES',NULL,NULL),(127,14,NULL,-1,'VOTES',NULL,NULL),(128,13,NULL,7,'VOTES',NULL,NULL),(129,11,-1,7,'EVENTSTIME','14:18',NULL),(130,11,-1,7,'EVENTSLOCATION','works better for me',NULL),(131,107,-1,7,'EVENTSLOCATION','no its all good',NULL),(132,131,NULL,7,'VOTES',NULL,NULL),(133,-1,-1,2,'POST','Can i edit',''),(134,102,NULL,7,'VOTEYEA',NULL,NULL),(135,-1,9,8,'PM','hello',''),(136,8,8,7,'COMMENT','congratulations',''),(137,21,9,7,'COMMENT','yumm.. i\'ll bring beer',''),(138,102,NULL,0,'VOTEYEA',NULL,NULL),(139,133,2,7,'COMMENT','sure.. go ahead',''),(140,14,NULL,0,'VOTES',NULL,NULL),(141,11,-1,0,'EVENTSDATE','2020-12-01',NULL),(142,11,-1,0,'EVENTSTIME','14:26',NULL),(143,102,NULL,8,'VOTEYEA',NULL,NULL),(144,28,2,-1,'COMMENT','This is a comment on a comment',''),(145,-1,9,0,'PM','','../public/assets/uploads/09hk7rsyqq0261.jpg'),(146,25,2,8,'COMMENT','i like fish fry','');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `own`
--

DROP TABLE IF EXISTS `own`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `own` (
  `eid` int DEFAULT NULL,
  `pid` int DEFAULT NULL,
  `myShare` int DEFAULT NULL,
  KEY `eid` (`eid`),
  KEY `pid` (`pid`),
  CONSTRAINT `own_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  CONSTRAINT `own_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `property` (`pid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `own`
--

LOCK TABLES `own` WRITE;
/*!40000 ALTER TABLE `own` DISABLE KEYS */;
INSERT INTO `own` VALUES (8,1,100),(2,2,100),(7,3,100),(6,4,100),(2,6,100);
/*!40000 ALTER TABLE `own` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `payTo` int DEFAULT NULL,
  `payFrom` int DEFAULT NULL,
  `total` int NOT NULL,
  `outstanding` int NOT NULL,
  `class` varchar(255) DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pid`),
  KEY `payTo` (`payTo`),
  KEY `payFrom` (`payFrom`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`payTo`) REFERENCES `entity` (`eid`),
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`payFrom`) REFERENCES `entity` (`eid`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,9,9,100000,97000,'BUDGET','The budget for 2021 outlined for general repairs and assorted whatnot, some has already been spent on filter upgrades for hvac ','2020-12-02 18:20:37'),(2,2,8,100,900,'PAY','I had a tv','2020-12-05 02:46:38'),(3,2,9,50,50,'FEE','A condo late fee','2020-12-07 18:24:03'),(4,9,14,1000,9000,'UPKEEP','Security company costs','2020-12-07 18:25:24');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `property`
--

DROP TABLE IF EXISTS `property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `property` (
  `pid` int NOT NULL AUTO_INCREMENT,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property`
--

LOCK TABLES `property` WRITE;
/*!40000 ALTER TABLE `property` DISABLE KEYS */;
INSERT INTO `property` VALUES (1,'1-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),(2,'2-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),(3,'3-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),(4,'4-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),(5,'5-1998 Rue Niagara, Montreal, Quebec, Canada H1H 2H3'),(6,'123 Fake Street'),(7,'123 Fake Street'),(8,'123 Fake Street'),(9,'123 Fake Street'),(10,'123 Fake Street');
/*!40000 ALTER TABLE `property` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `relate`
--

DROP TABLE IF EXISTS `relate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `relate` (
  `relType` int NOT NULL,
  `relSup` int DEFAULT NULL,
  `eid` int DEFAULT NULL,
  `tid` int DEFAULT NULL,
  KEY `eid` (`eid`),
  KEY `tid` (`tid`),
  CONSTRAINT `relate_ibfk_1` FOREIGN KEY (`eid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE,
  CONSTRAINT `relate_ibfk_2` FOREIGN KEY (`tid`) REFERENCES `entity` (`eid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `relate`
--

LOCK TABLES `relate` WRITE;
/*!40000 ALTER TABLE `relate` DISABLE KEYS */;
INSERT INTO `relate` VALUES (3,0,8,9),(3,0,2,9),(3,0,7,9),(0,0,0,13),(0,0,2,13),(0,0,0,9),(3,0,8,9),(3,0,7,13),(0,0,0,16),(0,0,0,19),(0,0,2,19),(0,0,0,21),(0,0,7,21),(0,0,0,26),(0,0,2,26),(0,0,0,26),(0,0,2,26),(3,0,6,9),(0,0,0,31),(0,0,8,31);
/*!40000 ALTER TABLE `relate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-07 14:35:34
