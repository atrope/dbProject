-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: softwareCompany
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.17.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `engineer`
--

DROP TABLE IF EXISTS `engineer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineer` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `zeut` int(11) unsigned NOT NULL,
  `specialization` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sid` (`specialization`),
  CONSTRAINT `sid` FOREIGN KEY (`specialization`) REFERENCES `softwareField` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineer`
--

LOCK TABLES `engineer` WRITE;
/*!40000 ALTER TABLE `engineer` DISABLE KEYS */;
INSERT INTO `engineer` VALUES (1,'Gay Goed','1985-11-21',334863079,2),(2,'Rowena Searle','1951-12-11',317275303,5),(3,'Madelaine Klemensiewicz','1962-08-23',293204669,3),(4,'Rupert Whittles','1969-02-04',396703129,4),(5,'Ysabel Crasswell','1967-09-21',252405726,2),(6,'Kristy Siggs','1968-05-23',243458684,2),(7,'Carroll Bridgwater','1990-07-04',302481182,2),(8,'Lenna Morpeth','1996-01-06',265435780,2),(9,'Daven Poytheras','1982-05-14',230138029,4),(10,'Zabrina Genever','1985-10-25',230416357,1),(11,'Camey Chessum','1991-07-19',220408449,1),(12,'Minny Bruckenthal','1968-09-11',373724511,3),(13,'Samson Harmston','1992-12-25',321844146,1),(14,'Geoffry Aizlewood','1976-05-09',305256781,5),(15,'Christa Jahn','1993-02-07',313420675,2),(16,'Jilli Iceton','1957-11-15',358226982,3);
/*!40000 ALTER TABLE `engineer` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER engineer_before_update BEFORE UPDATE ON engineer FOR EACH ROW
BEGIN
    INSERT INTO engineer_audit SET
    action = 'update',
    engineerId = OLD.id,
    name = OLD.name,
    birthday = OLD.birthday,
    zeut = OLD.zeut,
    specialization = OLD.specialization;
  END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER engineer_before_delete BEFORE DELETE ON engineer FOR EACH ROW
  BEGIN
  INSERT INTO engineer_audit SET
  action = 'delete',
  engineerId = OLD.id,
  name = OLD.name,
  birthday = OLD.birthday,
  zeut = OLD.zeut,
  specialization = OLD.specialization;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `engineerAddress`
--

DROP TABLE IF EXISTS `engineerAddress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineerAddress` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `engineerId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eidEA` (`engineerId`),
  CONSTRAINT `eidEA` FOREIGN KEY (`engineerId`) REFERENCES `engineer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineerAddress`
--

LOCK TABLES `engineerAddress` WRITE;
/*!40000 ALTER TABLE `engineerAddress` DISABLE KEYS */;
INSERT INTO `engineerAddress` VALUES (1,'Galatás','38 Stone Corner Pass','Greece','90415',1),(2,'Cabiao','7 Sage Hill','Philippines','58813',2),(3,'Larochette','73 Knutson Park','Luxembourg','54213',3),(4,'Nîmes','81 Bobwhite Circle','France','71902',4),(5,'Krivodanovka','6 Colorado Terrace','Russia','85740',5),(6,'Novo-Peredelkino','7 Corben Park','Russia','64452',6),(7,'Estancia','178 Steensland Road','Philippines','58187',7),(8,'Xiangcheng','691 Marquette Park','China','75668',8),(9,'Hisings Kärra','7324 Mallard Point','Sweden','35431',9),(10,'Beloye','8506 Sugar Parkway','Russia','90021',10),(11,'Resende','2016 Thackeray Crossing','Portugal','64770',11),(12,'Songshi','2 Scoville Street','China','47734',12),(13,'Guohe','30293 Cordelia Lane','China','97710',13),(14,'Chimboy Shahri','850 Kings Circle','Uzbekistan','89865',14),(15,'Caseros','317 Luster Lane','Argentina','54407',15),(16,'Luleå','7 Acker Road','Sweden','52261',16);
/*!40000 ALTER TABLE `engineerAddress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engineerPhones`
--

DROP TABLE IF EXISTS `engineerPhones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineerPhones` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phone` varchar(30) NOT NULL,
  `engineerId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `eidEP` (`engineerId`),
  CONSTRAINT `eidEP` FOREIGN KEY (`engineerId`) REFERENCES `engineer` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineerPhones`
--

LOCK TABLES `engineerPhones` WRITE;
/*!40000 ALTER TABLE `engineerPhones` DISABLE KEYS */;
INSERT INTO `engineerPhones` VALUES (1,'57991884',1),(2,'55281340',2),(3,'58330469',3),(4,'56364075',4),(5,'59916278',5),(6,'59632974',6),(7,'55589975',7),(8,'57568987',8),(9,'55944875',9),(10,'50855864',10),(11,'55459403',11),(12,'52125981',12),(13,'56832305',13),(14,'56333672',14),(15,'59395698',15),(16,'59246758',16);
/*!40000 ALTER TABLE `engineerPhones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `engineer_audit`
--

DROP TABLE IF EXISTS `engineer_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `engineer_audit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `engineerId` int(11) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `zeut` int(11) unsigned NOT NULL,
  `specialization` int(11) unsigned DEFAULT NULL,
  `action` varchar(50) DEFAULT NULL,
  `changedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `engineer_audit`
--

LOCK TABLES `engineer_audit` WRITE;
/*!40000 ALTER TABLE `engineer_audit` DISABLE KEYS */;
INSERT INTO `engineer_audit` VALUES (1,1,'Gay Goede','1985-11-21',334863079,2,'update','2018-01-10 16:08:03');
/*!40000 ALTER TABLE `engineer_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `value` int(11) NOT NULL,
  `data` date NOT NULL,
  `projectId` int(11) unsigned NOT NULL,
  `engineerId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_Tools` (`projectId`,`engineerId`,`data`),
  KEY `eidG` (`engineerId`),
  CONSTRAINT `eidG` FOREIGN KEY (`engineerId`) REFERENCES `engineer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pidG` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades`
--

LOCK TABLES `grades` WRITE;
/*!40000 ALTER TABLE `grades` DISABLE KEYS */;
INSERT INTO `grades` VALUES (1,10,'2018-01-01',5,1),(2,6,'2018-01-01',7,1),(3,4,'2017-01-01',3,4),(5,4,'2017-02-01',3,4),(6,2,'2017-03-01',3,4),(7,6,'2017-04-01',3,4),(8,7,'2017-05-01',3,4),(9,8,'2017-06-01',3,4),(10,2,'2017-07-01',3,4),(11,1,'2017-08-01',3,4),(12,7,'2017-09-01',3,4),(13,9,'2017-10-01',3,4),(14,9,'2017-11-01',3,4),(15,9,'2017-12-01',3,4),(16,10,'2018-01-01',6,10),(17,6,'2018-01-01',7,14),(18,7,'2018-01-01',6,14);
/*!40000 ALTER TABLE `grades` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER grades_before_update BEFORE UPDATE ON grades FOR EACH ROW
BEGIN
    INSERT INTO grades_audit SET
    action = 'update',
    gradesId = OLD.id,
    value = OLD.value,
    data = OLD.data,
    projectId = OLD.projectId,
    engineerId = OLD.engineerId;
  END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER grades_before_delete BEFORE DELETE ON grades FOR EACH ROW
  BEGIN
      INSERT INTO grades_audit SET
      action = 'delete',
      gradesId = OLD.id,
      value = OLD.value,
      data = OLD.data,
      projectId = OLD.projectId,
      engineerId = OLD.engineerId;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `grades_audit`
--

DROP TABLE IF EXISTS `grades_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `grades_audit` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `gradesId` int(11) unsigned NOT NULL,
  `value` int(11) NOT NULL,
  `data` date NOT NULL,
  `projectId` int(11) unsigned NOT NULL,
  `engineerId` int(11) unsigned NOT NULL,
  `action` varchar(50) DEFAULT NULL,
  `changedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grades_audit`
--

LOCK TABLES `grades_audit` WRITE;
/*!40000 ALTER TABLE `grades_audit` DISABLE KEYS */;
/*!40000 ALTER TABLE `grades_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `milestone`
--

DROP TABLE IF EXISTS `milestone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `milestone` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `moneysum` decimal(15,2) NOT NULL,
  `done` tinyint(4) DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `projectId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pidM` (`projectId`),
  CONSTRAINT `pidM` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `milestone`
--

LOCK TABLES `milestone` WRITE;
/*!40000 ALTER TABLE `milestone` DISABLE KEYS */;
INSERT INTO `milestone` VALUES (1,'Vulpes vulpes','2018-01-04','2019-01-12',20214.82,0,'Unsp bus occupant injured in clsn w oth and unsp mv nontraf',6),(2,'Eolophus roseicapillus','2018-01-17','2019-05-14',55284.63,0,'Other disorders of continuity of bone, right humerus',5),(3,'Varanus komodensis','2018-01-05','2019-03-17',54193.51,0,'Other ossification of muscle, unspecified site',2),(4,'Nycticorax nycticorax','2018-01-04','2019-11-09',72610.50,0,'Nondisplaced oblique fracture of shaft of left radius, init',1),(5,'Bos mutus','2018-01-17','2019-03-17',30033.99,0,'Adverse effect of amphetamines',5),(6,'Martes americana','2018-01-06','2019-06-24',88490.15,0,'Unsp athscl nonaut bio bypass of the extrm, bilateral legs',3),(7,'Boa caninus','2018-01-25','2019-11-20',62229.28,0,'Surg instrumnt,matrl & gen hosp/persnl-use dev assoc w incdt',7),(8,'Sciurus niger','2018-01-25','2019-08-22',72175.25,0,'Fracture of nasal bones, subs for fx w delay heal',7),(9,'Ramphastos tucanus','2018-01-29','2019-08-05',53906.66,0,'Nondisp bimalleol fx l low leg, subs for clos fx w malunion',8),(10,'Cacatua tenuirostris','2018-01-05','2019-09-28',92593.01,0,'Lacerat extn musc/fasc/tend l rng fngr at wrs/hnd lv, sqla',2),(11,'Ciconia ciconia','2018-01-10','2019-04-14',94300.90,0,'Bathroom in prison as place',4),(12,'unavailable','2018-01-04','2019-06-08',53693.70,0,'Toxic effect of contact w Portugese Man-o-war, undet, init',6),(13,'Coendou prehensilis','2018-01-17','2019-09-01',42344.06,0,'Athscl autol vein bypass of the extrm w rest pain, right leg',5),(14,'Felis concolor','2018-01-25','2020-01-04',98848.70,0,'Schmorl\'s nodes, thoracolumbar region',7),(15,'Hymenolaimus malacorhynchus','2018-01-04','2019-09-29',54480.60,0,'Other hypertrophic osteoarthropathy, left hand',1),(16,'Haematopus ater','2018-01-25','2019-12-19',29126.17,0,'Burn of unspecified degree of left shoulder, init encntr',7),(17,'Bubo virginianus','2018-01-06','2019-04-18',91909.77,0,'Inj deep peroneal nrv at ank/ft level, right leg, sequela',3),(18,'Bassariscus astutus','2018-01-06','2019-07-16',61892.67,0,'Cont preg aft spon abort of one fts or more, third tri, fts4',3),(19,'Sciurus vulgaris','2018-01-04','2019-02-13',82835.00,0,'Acute pancreatitis without necrosis or infection, unsp',9),(20,'Physignathus cocincinus','2018-01-04','2019-06-17',65078.92,0,'Disp fx of low epiphy (separation) of r femr, 7thG',9);
/*!40000 ALTER TABLE `milestone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `stage` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Nicolas LLC','2017-01-04','Nondisp fx of medial cuneiform of unspecified foot, sequela',6),(2,'Wisozk-Quigley','2018-01-05','Siderosis',5),(3,'Goyette Inc','2017-01-06','Corrosion of second degree of right ankle and foot, sequela',1),(4,'Mitchell, Schulist and Koch','2018-01-10','3-part fx surgical neck of l humerus, subs for fx w malunion',1),(5,'Price, Renner and Weissnat','2018-01-17','Toxic effect of venom of venomous lizard, self-harm, init',1),(6,'Schinner-Halvorson','2018-01-04','Displacement of carotid arterial graft (bypass), init encntr',1),(7,'Huels LLC','2018-01-25','Displ suprcndl fx w intrcndl extn low end r femr, 7thJ',1),(8,'Sawayn-Kuhic','2018-01-29','Displ seg fx shaft of r tibia, init for opn fx type 3A/B/C',1),(9,'Kessler, Erdman and Gorczany','2018-01-04','Toxic effect of cadmium and its compounds, undet, sequela',1);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER project_before_update BEFORE UPDATE ON project FOR EACH ROW
    BEGIN
        INSERT INTO project_audit SET
        action = 'update',
        projectId = OLD.id,
        name = OLD.name,
        startdate = OLD.startdate,
        description = OLD.description,
        stage = OLD.stage;
      END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = latin1 */ ;
/*!50003 SET character_set_results = latin1 */ ;
/*!50003 SET collation_connection  = latin1_swedish_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER project_before_delete BEFORE DELETE ON project FOR EACH ROW
      BEGIN
          INSERT INTO project_audit SET
          action = 'delete',
          projectId = OLD.id,
          name = OLD.name,
          startdate = OLD.startdate,
          description = OLD.description,
          stage = OLD.stage;
        END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `projectSoftware`
--

DROP TABLE IF EXISTS `projectSoftware`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projectSoftware` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `projectId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pidS` (`projectId`),
  CONSTRAINT `pidS` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projectSoftware`
--

LOCK TABLES `projectSoftware` WRITE;
/*!40000 ALTER TABLE `projectSoftware` DISABLE KEYS */;
/*!40000 ALTER TABLE `projectSoftware` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_audit`
--

DROP TABLE IF EXISTS `project_audit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `stage` tinyint(4) DEFAULT '1',
  `action` varchar(50) DEFAULT NULL,
  `changedate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_audit`
--

LOCK TABLES `project_audit` WRITE;
/*!40000 ALTER TABLE `project_audit` DISABLE KEYS */;
INSERT INTO `project_audit` VALUES (1,1,'Nicolas LLC','2018-01-04','Nondisp fx of medial cuneiform of unspecified foot, sequela',1,'update','2018-01-10 16:04:20'),(2,1,'Nicolas LLC','2018-01-04','Nondisp fx of medial cuneiform of unspecified foot, sequela',6,'update','2018-01-10 16:28:12'),(3,3,'Goyette Inc','2018-01-06','Corrosion of second degree of right ankle and foot, sequela',1,'update','2018-01-10 16:49:46');
/*!40000 ALTER TABLE `project_audit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `softwareField`
--

DROP TABLE IF EXISTS `softwareField`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `softwareField` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `specialization` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `softwareField`
--

LOCK TABLES `softwareField` WRITE;
/*!40000 ALTER TABLE `softwareField` DISABLE KEYS */;
INSERT INTO `softwareField` VALUES (1,'Undergraduate','Engineers Undergraduated'),(2,'Graduated','Engineers Graduated'),(3,'Master','Engineer with a Master Degree'),(4,'Doctorate','Engineer with a Doctorate'),(5,'Nobel Prize Winner','Engineer with a Nobel Prize');
/*!40000 ALTER TABLE `softwareField` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stages`
--

LOCK TABLES `stages` WRITE;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
INSERT INTO `stages` VALUES (1,'Config'),(2,'Task Management'),(3,'Planning'),(4,'Require Management'),(5,'Design Coding'),(6,'Unit Testing'),(7,'Software Testing');
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tools`
--

DROP TABLE IF EXISTS `tools`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tools` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tools`
--

LOCK TABLES `tools` WRITE;
/*!40000 ALTER TABLE `tools` DISABLE KEYS */;
INSERT INTO `tools` VALUES (1,'Github'),(2,'Asana'),(3,'Artificial intelligence'),(4,'Rapid prototyping'),(5,'Natural language processing'),(6,'Instagram'),(7,'A/B testing'),(8,'C++'),(9,'Swift'),(10,'Brand strategy'),(11,'Marketo marketing automation'),(12,'Penetration testing'),(13,'Docker development'),(14,'Relationship management'),(16,'AngularJS development'),(17,'Accounting (CPA)'),(18,'Machine learning'),(19,'JIRA administration');
/*!40000 ALTER TABLE `tools` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toolsProjects`
--

DROP TABLE IF EXISTS `toolsProjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toolsProjects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `projectId` int(11) unsigned NOT NULL,
  `toolsId` int(11) unsigned NOT NULL,
  `stageId` int(11) unsigned DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_Tools` (`projectId`,`toolsId`,`stageId`),
  KEY `tidT` (`toolsId`),
  KEY `sidT` (`stageId`),
  CONSTRAINT `pidT` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `sidT` FOREIGN KEY (`stageId`) REFERENCES `stages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `tidT` FOREIGN KEY (`toolsId`) REFERENCES `tools` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toolsProjects`
--

LOCK TABLES `toolsProjects` WRITE;
/*!40000 ALTER TABLE `toolsProjects` DISABLE KEYS */;
INSERT INTO `toolsProjects` VALUES (37,1,1,3),(40,1,1,4),(88,1,1,7),(25,1,2,1),(63,1,6,6),(5,1,8,2),(82,1,9,3),(4,1,10,2),(42,1,16,3),(60,1,17,1),(67,1,18,2),(41,2,2,4),(81,2,4,4),(53,2,4,6),(90,2,5,5),(38,2,7,3),(29,2,7,4),(52,2,8,1),(17,2,10,2),(39,2,10,7),(97,2,11,7),(54,2,12,1),(6,2,12,5),(68,2,14,1),(98,2,14,6),(62,2,18,1),(18,2,19,6),(50,3,1,5),(15,3,2,7),(73,3,4,1),(19,3,4,6),(56,3,4,7),(45,3,5,2),(84,3,5,6),(34,3,10,2),(92,3,13,7),(14,3,14,2),(9,3,17,4),(24,4,1,6),(99,4,4,4),(2,4,7,2),(3,4,7,4),(7,4,9,4),(91,4,10,2),(48,4,16,5),(78,4,17,6),(102,5,1,1),(70,5,1,3),(86,5,5,2),(26,5,5,4),(85,5,5,7),(103,5,6,1),(33,5,8,2),(49,5,9,3),(21,5,12,5),(80,5,19,7),(31,6,2,5),(44,6,5,2),(47,6,5,5),(8,6,8,6),(59,6,9,6),(43,6,10,1),(32,6,12,3),(79,6,12,5),(30,6,13,3),(23,6,16,3),(65,6,16,7),(64,6,18,5),(101,7,1,1),(13,7,5,7),(77,7,12,2),(96,7,13,5),(10,7,14,1),(72,7,14,4),(27,7,18,2),(57,7,19,3),(36,8,1,3),(46,8,1,6),(94,8,3,4),(71,8,4,6),(12,8,5,2),(51,8,11,2),(100,8,14,3),(76,8,14,4),(16,8,16,6),(95,9,2,2),(55,9,8,6),(20,9,9,2),(58,9,11,3),(87,9,11,7),(69,9,13,3),(89,9,16,5),(74,9,17,4);
/*!40000 ALTER TABLE `toolsProjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `works`
--

DROP TABLE IF EXISTS `works`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `works` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `projectId` int(11) unsigned NOT NULL,
  `engineerId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UK_Tools` (`projectId`,`engineerId`),
  KEY `eidW` (`engineerId`),
  CONSTRAINT `eidW` FOREIGN KEY (`engineerId`) REFERENCES `engineer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pidW` FOREIGN KEY (`projectId`) REFERENCES `project` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `works`
--

LOCK TABLES `works` WRITE;
/*!40000 ALTER TABLE `works` DISABLE KEYS */;
INSERT INTO `works` VALUES (1,1,1),(10,1,14),(19,2,1),(20,2,6),(2,2,8),(21,2,11),(11,2,14),(3,3,3),(12,3,14),(4,4,3),(13,4,14),(5,5,11),(14,5,14),(6,6,10),(22,6,14),(16,7,14),(7,7,15),(17,8,14),(8,8,16),(9,9,2),(18,9,14);
/*!40000 ALTER TABLE `works` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-10 17:33:12
