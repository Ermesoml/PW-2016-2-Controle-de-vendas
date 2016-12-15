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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
  `qtd_seg_inicial` int(11) DEFAULT NULL,
  `qtd_seg_atual` int(11) DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`acompanhamento_id`),
  KEY `acompanhamento_cliente_id_idx` (`cliente_id`),
  KEY `acompanhamento_rede_social_id_idx` (`cliente_rede_social_id`),
  KEY `acompanhamentos_clientes_usuarios_idx` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `usuario_id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(70) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `senha` blob NOT NULL,
  `tipo` char(1) NOT NULL DEFAULT 'V',
  `banido` char(1) NOT NULL DEFAULT 'N',
  `cargo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_unico_idx` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

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
 1 AS `telefone`,
 1 AS `representante`,
 1 AS `cliente_rede_social_id`,
 1 AS `rede_social`,
 1 AS `login`,
 1 AS `preco`,
 1 AS `comissao`,
 1 AS `descricao`,
 1 AS `data_cadastro`,
 1 AS `status`,
 1 AS `usuario_id`,
 1 AS `qtd_seg_inicial`,
 1 AS `qtd_seg_atual`*/;
SET character_set_client = @saved_cs_client;

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
/*!50001 VIEW `vw_acompanhamentos` AS select `aco`.`acompanhamento_id` AS `acompanhamento_id`,`aco`.`cliente_id` AS `cliente_id`,`cli`.`nome` AS `nome`,`cli`.`telefone` AS `telefone`,`aco`.`representante` AS `representante`,`aco`.`cliente_rede_social_id` AS `cliente_rede_social_id`,`red`.`rede_social` AS `rede_social`,`red`.`login` AS `login`,`aco`.`preco` AS `preco`,`aco`.`comissao` AS `comissao`,`aco`.`descricao` AS `descricao`,`aco`.`data_cadastro` AS `data_cadastro`,`aco`.`status` AS `status`,`aco`.`usuario_id` AS `usuario_id`,`aco`.`qtd_seg_inicial` AS `qtd_seg_inicial`,`aco`.`qtd_seg_atual` AS `qtd_seg_atual` from ((`clientes_acompanhamentos` `aco` join `clientes` `cli` on((`cli`.`cliente_id` = `aco`.`cliente_id`))) join `clientes_redes_sociais` `red` on((`red`.`rede_social_id` = `aco`.`cliente_rede_social_id`))) */;
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

-- Dump completed on 2016-12-08 23:31:02
