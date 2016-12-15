-- MySQL dump 10.13  Distrib 5.7.9, for Win32 (AMD64)
--
-- Host: localhost    Database: kikmidia
-- ------------------------------------------------------
-- Server version	5.7.9

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
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`cliente_id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (21,'Maria da silva','','maria@gmail.com'),(22,'asdfas','asdfasf','asdfas'),(23,'1231231','123123','123123'),(24,'Ermesom LourenÃ§o','52 92254 6548','ermesom@kikvendas.com.br');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_acompanhamentos`
--

DROP TABLE IF EXISTS `clientes_acompanhamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_acompanhamentos` (
  `acompanhamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `cliente_rede_social_id` int(11) NOT NULL,
  `tipo_servico` varchar(30) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `representante` varchar(60) DEFAULT NULL,
  `preco` decimal(10,2) DEFAULT NULL,
  `comissao` decimal(10,2) DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `status` char(1) DEFAULT 'A',
  PRIMARY KEY (`acompanhamento_id`),
  KEY `acompanhamento_cliente_id_idx` (`cliente_id`),
  KEY `acompanhamento_rede_social_id` (`cliente_rede_social_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_acompanhamentos`
--

LOCK TABLES `clientes_acompanhamentos` WRITE;
/*!40000 ALTER TABLE `clientes_acompanhamentos` DISABLE KEYS */;
INSERT INTO `clientes_acompanhamentos` VALUES (9,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(10,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(11,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(12,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(13,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(14,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(15,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(16,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(17,12,8,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(18,12,8,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(19,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(20,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(21,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(22,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(23,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(24,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(25,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(26,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(27,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(28,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(29,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(30,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(31,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(32,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(33,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(34,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(35,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(36,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(37,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(38,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(39,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(40,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(41,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(42,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(43,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(44,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(45,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(46,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(47,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(48,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(49,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(50,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(51,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(52,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(53,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(54,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(55,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(56,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(57,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(58,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(59,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(60,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(61,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(62,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(63,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(64,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(65,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(66,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A'),(67,24,4,'Mensalista',NULL,'Ermesom',125.00,12.50,'2016-10-25','A');
/*!40000 ALTER TABLE `clientes_acompanhamentos` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_ALL_TABLES,NO_AUTO_CREATE_USER' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `kikmidia`.`clientes_acompanhamentos_BEFORE_INSERT_1` BEFORE INSERT ON `clientes_acompanhamentos` FOR EACH ROW
BEGIN
	SET NEW.DATA_CADASTRO = NOW();
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `clientes_redes_sociais`
--

DROP TABLE IF EXISTS `clientes_redes_sociais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes_redes_sociais` (
  `rede_social_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) NOT NULL,
  `rede_social` varchar(40) NOT NULL,
  `login` varchar(40) NOT NULL,
  `senha` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`rede_social_id`,`cliente_id`,`rede_social`,`login`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_redes_sociais`
--

LOCK TABLES `clientes_redes_sociais` WRITE;
/*!40000 ALTER TABLE `clientes_redes_sociais` DISABLE KEYS */;
INSERT INTO `clientes_redes_sociais` VALUES (1,22,'asdfas','asdf','asdf'),(2,23,'1','1','1'),(3,24,'Facebook','ermesomlourenco','nadadesenhaaqui'),(4,24,'Instagram','ermesominsta','nadadesenhaaquitambÃ©m');
/*!40000 ALTER TABLE `clientes_redes_sociais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vw_acompanhamentos`
--

DROP TABLE IF EXISTS `vw_acompanhamentos`;
/*!50001 DROP VIEW IF EXISTS `vw_acompanhamentos`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE VIEW `vw_acompanhamentos` AS SELECT 
 1 AS `acompanhamento_id`,
 1 AS `cliente_id`,
 1 AS `nome`,
 1 AS `cliente_rede_social_id`,
 1 AS `rede_social`,
 1 AS `preco`,
 1 AS `comissao`,
 1 AS `data_cadastro`,
 1 AS `status`*/;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'kikmidia'
--

--
-- Dumping routines for database 'kikmidia'
--

--
-- Final view structure for view `vw_acompanhamentos`
--

/*!50001 DROP VIEW IF EXISTS `vw_acompanhamentos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vw_acompanhamentos` AS select `aco`.`acompanhamento_id` AS `acompanhamento_id`,`aco`.`cliente_id` AS `cliente_id`,`cli`.`nome` AS `nome`,`aco`.`cliente_rede_social_id` AS `cliente_rede_social_id`,`red`.`rede_social` AS `rede_social`,`aco`.`preco` AS `preco`,`aco`.`comissao` AS `comissao`,`aco`.`data_cadastro` AS `data_cadastro`,`aco`.`status` AS `status` from ((`clientes_acompanhamentos` `aco` join `clientes` `cli` on((`cli`.`cliente_id` = `aco`.`cliente_id`))) join `clientes_redes_sociais` `red` on((`red`.`rede_social_id` = `aco`.`cliente_rede_social_id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-10-26  8:41:42
