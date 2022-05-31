-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: countpay
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.24-MariaDB

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
-- Table structure for table `cartao`
--

DROP TABLE IF EXISTS `cartao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao` (
  `id_cartao` int(11) NOT NULL AUTO_INCREMENT,
  `apelido` varchar(64) NOT NULL,
  `tipo_cartao` varchar(64) NOT NULL,
  `vence_dia` int(2) DEFAULT NULL,
  `limite` decimal(8,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cartao`),
  KEY `cartao_ibfk_1` (`id_usuario`),
  KEY `cartao_ibfk_2` (`id_instituicao`),
  CONSTRAINT `cartao_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_USUARIO`),
  CONSTRAINT `cartao_ibfk_2` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`ID_INSTITUICAO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartao`
--

LOCK TABLES `cartao` WRITE;
/*!40000 ALTER TABLE `cartao` DISABLE KEYS */;
INSERT INTO `cartao` VALUES (1,'Cartão Nubank','Crédito',15,2000.00,1,260),(2,'Cartão Itau','Debito',10,1500.00,2,341),(3,'Cartão Next','Crédito',15,1000.00,2,260),(4,'Cartão Picpay','Crédito',10,500.00,143,380);
/*!40000 ALTER TABLE `cartao` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`contador_cartao` AFTER INSERT ON `cartao` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT COUNT(id_cartao) FROM cartao);
    
    UPDATE cartao_dados
    SET quantidade_cartao = contador
    WHERE id_cartao_dados = 1;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`delete_cartao` AFTER DELETE ON `cartao` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT COUNT(id_cartao) FROM cartao);
    
    UPDATE cartao_dados
    SET quantidade_cartao = contador
    WHERE id_cartao_dados = 1;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `cartao_dados`
--

DROP TABLE IF EXISTS `cartao_dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cartao_dados` (
  `id_cartao_dados` int(11) NOT NULL,
  `quantidade_cartao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_cartao_dados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cartao_dados`
--

LOCK TABLES `cartao_dados` WRITE;
/*!40000 ALTER TABLE `cartao_dados` DISABLE KEYS */;
INSERT INTO `cartao_dados` VALUES (1,4);
/*!40000 ALTER TABLE `cartao_dados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Salário'),(2,'Emprestimo'),(3,'Shopping'),(4,'Alimentação'),(5,'Energia'),(6,'Lazer'),(7,'Horas Extra'),(8,'Internet'),(9,'Outros');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conta`
--

DROP TABLE IF EXISTS `conta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conta` (
  `id_conta` int(11) NOT NULL AUTO_INCREMENT,
  `apelido` varchar(64) NOT NULL,
  `tipo_conta` varchar(64) NOT NULL,
  `saldo` decimal(10,2) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_conta`),
  KEY `conta_ibfk_1` (`id_usuario`),
  KEY `conta_ibfk_2` (`id_instituicao`),
  CONSTRAINT `conta_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`ID_USUARIO`),
  CONSTRAINT `conta_ibfk_2` FOREIGN KEY (`id_instituicao`) REFERENCES `instituicao` (`ID_INSTITUICAO`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conta`
--

LOCK TABLES `conta` WRITE;
/*!40000 ALTER TABLE `conta` DISABLE KEYS */;
INSERT INTO `conta` VALUES (1,'Conta Nubank','Conta Corrente',5000.00,1,260),(2,'Conta Inter','Conta Corrente',4500.00,2,77),(3,'Conta Santander','Cartao',1500.00,2,260),(4,'Conta Master','Conta',100.00,143,260);
/*!40000 ALTER TABLE `conta` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`contador_contas` AFTER INSERT ON `conta` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT COUNT(id_conta) FROM conta);
    
    UPDATE conta_dados
    SET quantidade_conta = contador
    WHERE id_conta_dados = 1;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`delete_conta` AFTER DELETE ON `conta` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT COUNT(id_conta) FROM conta);
    
    UPDATE conta_dados
    SET quantidade_conta = contador
    WHERE id_conta_dados = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `conta_dados`
--

DROP TABLE IF EXISTS `conta_dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conta_dados` (
  `id_conta_dados` int(11) NOT NULL,
  `quantidade_conta` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_conta_dados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conta_dados`
--

LOCK TABLES `conta_dados` WRITE;
/*!40000 ALTER TABLE `conta_dados` DISABLE KEYS */;
INSERT INTO `conta_dados` VALUES (1,'4');
/*!40000 ALTER TABLE `conta_dados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequencia`
--

DROP TABLE IF EXISTS `frequencia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequencia` (
  `id_frequencia` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `dias` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_frequencia`)
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequencia`
--

LOCK TABLES `frequencia` WRITE;
/*!40000 ALTER TABLE `frequencia` DISABLE KEYS */;
INSERT INTO `frequencia` VALUES (1,'Semanalmente',7,NULL),(2,'Quinzenalmente',15,NULL),(3,'Mensalmente',30,1),(4,'Bimestral',60,2),(5,'Trimestral',90,3),(6,'Semestral',180,6),(7,'Anualmente',365,12);
/*!40000 ALTER TABLE `frequencia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `instituicao`
--

DROP TABLE IF EXISTS `instituicao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `instituicao` (
  `id_instituicao` int(11) NOT NULL,
  `nome` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `instituicao`
--

LOCK TABLES `instituicao` WRITE;
/*!40000 ALTER TABLE `instituicao` DISABLE KEYS */;
INSERT INTO `instituicao` VALUES (1,'Banco do Brasil'),(33,'Banco Santander'),(77,'Banco Inter'),(93,'Pelocred'),(104,'Caixa Econômica Federal'),(121,'Agibank'),(125,'Banco Genial'),(197,'Stone Pagamentos'),(212,'Banco Original'),(218,'BS2'),(237,'Banco Bradesco'),(260,'Nubank'),(280,'Meupag!'),(290,'Pagseguro'),(323,'Mercado Pago'),(335,'Banco Digio'),(336,'C6 Bank'),(340,'Superdigital'),(341,'Banco Itaú'),(356,'Banco Real'),(380,'PicPay'),(389,'Banco Mercantil do Brasil S.A'),(396,'Hub Pagamentos'),(399,'HSBC Bank Brasil'),(401,'Iugu'),(422,'Banco Safra'),(450,'Fitbank'),(453,'Banco Rural'),(633,'Banco Rendimento'),(652,'Itaú Unibanco Holding'),(654,'Banco Digi+'),(735,'Neon'),(745,'Banco Citibank');
/*!40000 ALTER TABLE `instituicao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lancamento`
--

DROP TABLE IF EXISTS `lancamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento` (
  `id_lancamento` int(11) NOT NULL AUTO_INCREMENT,
  `descricao_lancamento` varchar(120) DEFAULT NULL,
  `tipo_lancamento` varchar(64) DEFAULT NULL,
  `valor` decimal(8,2) DEFAULT NULL,
  `data_lancamento` date DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_conta` int(11) DEFAULT NULL,
  `id_cartao` int(11) DEFAULT NULL,
  `id_categoria` int(11) DEFAULT NULL,
  `quantidade_parcelas` varchar(30) DEFAULT NULL,
  `frequencia` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento`),
  KEY `usuario` (`id_usuario`),
  KEY `conta` (`id_conta`),
  KEY `cartao` (`id_cartao`),
  KEY `categoria` (`id_categoria`),
  CONSTRAINT `cartao` FOREIGN KEY (`id_cartao`) REFERENCES `cartao` (`id_cartao`),
  CONSTRAINT `categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`),
  CONSTRAINT `conta` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`),
  CONSTRAINT `usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=15983 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento`
--

LOCK TABLES `lancamento` WRITE;
/*!40000 ALTER TABLE `lancamento` DISABLE KEYS */;
INSERT INTO `lancamento` VALUES (15977,'Empréstimo c/ Juros ','Receita Parcelada',300.00,'2022-05-26',143,4,4,2,'1 / 5','Mensalmente'),(15978,'Empréstimo c/ Juros ','Receita Parcelada',300.00,'2022-06-26',143,4,4,2,'2 / 5','Mensalmente'),(15979,'Empréstimo c/ Juros ','Receita Parcelada',300.00,'2022-07-26',143,4,4,2,'3 / 5','Mensalmente'),(15980,'Empréstimo c/ Juros ','Receita Parcelada',300.00,'2022-08-26',143,4,4,2,'4 / 5','Mensalmente'),(15981,'Empréstimo c/ Juros ','Receita Parcelada',300.00,'2022-09-26',143,4,4,2,'5 / 5','Mensalmente'),(15982,'Teste','Receita',50.00,'2022-05-27',143,4,NULL,4,NULL,NULL);
/*!40000 ALTER TABLE `lancamento` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`lancamento_valor` AFTER INSERT ON `lancamento` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT SUM(valor) FROM lancamento);
    
    UPDATE lancamento_dados
    SET lancamento_total = contador
    WHERE id_lancamento_dados = 1;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`update_lancamento` AFTER UPDATE ON `lancamento` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT SUM(valor) FROM lancamento);
    
    UPDATE lancamento_dados
    SET lancamento_total = contador
    WHERE id_lancamento_dados = 1;

END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`delete_lancamento` AFTER DELETE ON `lancamento` FOR EACH ROW
BEGIN
DECLARE contador INT;
	SET contador = (SELECT SUM(valor) FROM lancamento);
    
    UPDATE lancamento_dados
    SET lancamento_total = contador
    WHERE id_lancamento_dados = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `lancamento_dados`
--

DROP TABLE IF EXISTS `lancamento_dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lancamento_dados` (
  `id_lancamento_dados` int(11) NOT NULL,
  `lancamento_total` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id_lancamento_dados`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lancamento_dados`
--

LOCK TABLES `lancamento_dados` WRITE;
/*!40000 ALTER TABLE `lancamento_dados` DISABLE KEYS */;
INSERT INTO `lancamento_dados` VALUES (1,1550.00);
/*!40000 ALTER TABLE `lancamento_dados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meta`
--

DROP TABLE IF EXISTS `meta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `meta` (
  `id_meta` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL,
  `objetivo` varchar(256) DEFAULT NULL,
  `valor` decimal(10,2) NOT NULL,
  `data_inicial` date DEFAULT NULL,
  `data_final` date DEFAULT NULL,
  `notificacoes` varchar(126) DEFAULT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `id_conta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_meta`),
  KEY `id_conta` (`id_conta`),
  CONSTRAINT `meta_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `conta` (`id_conta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meta`
--

LOCK TABLES `meta` WRITE;
/*!40000 ALTER TABLE `meta` DISABLE KEYS */;
/*!40000 ALTER TABLE `meta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_receita`
--

DROP TABLE IF EXISTS `tipo_receita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_receita` (
  `id_tipo_receita` int(11) NOT NULL,
  `descricao` varchar(120) NOT NULL,
  PRIMARY KEY (`id_tipo_receita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_receita`
--

LOCK TABLES `tipo_receita` WRITE;
/*!40000 ALTER TABLE `tipo_receita` DISABLE KEYS */;
INSERT INTO `tipo_receita` VALUES (1,'Receita'),(2,'Receita Fixa'),(3,'Receita Parcelada');
/*!40000 ALTER TABLE `tipo_receita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador'),(2,'Usuario');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(24) NOT NULL,
  `sobrenome` varchar(24) NOT NULL,
  `email` varchar(128) NOT NULL,
  `data_nascimento` date NOT NULL,
  `login` varchar(48) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `usuario_ibfk_1` (`id_tipo_usuario`),
  CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Lucas','Heideric','lucas@countpay.com.br','2000-07-24','theheideric','123456',1),(2,'Mateus','Ramos','mateus@countpay.com.br','2001-08-25','theramos','123456',1),(3,'Raphael','Rocha','raphel@gmail.com','1993-06-06','Mateuzin','Mateuzão',2),(4,'Alexandre','Galhardo 2','alexandre@countpay.com.br','1999-05-05','xande','123456',1),(143,'usuario','usuario','usuario@gmail.com','2022-05-19','usuario','usuario',2);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`contador_usuarios` AFTER INSERT ON `usuario` FOR EACH ROW
BEGIN

DECLARE contador INT;
	SET contador = (SELECT COUNT(id_usuario) FROM usuario);
    
    UPDATE usuario_dados
    SET quantidade_usuario = contador
    WHERE id_usuario_dados = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER `countpay`.`delete_usuarios` AFTER DELETE ON `usuario` FOR EACH ROW
BEGIN

DECLARE contador INT;
	SET contador = (SELECT COUNT(id_usuario) FROM usuario);
    
    UPDATE usuario_dados
    SET quantidade_usuario = contador
    WHERE id_usuario_dados = 1;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `usuario_dados`
--

DROP TABLE IF EXISTS `usuario_dados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario_dados` (
  `id_usuario_dados` int(11) NOT NULL AUTO_INCREMENT,
  `quantidade_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario_dados`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_dados`
--

LOCK TABLES `usuario_dados` WRITE;
/*!40000 ALTER TABLE `usuario_dados` DISABLE KEYS */;
INSERT INTO `usuario_dados` VALUES (1,5);
/*!40000 ALTER TABLE `usuario_dados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'countpay'
--
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_normal` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_normal`(
	
    pid_usuario INT,
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    ptipo_lancamento VARCHAR(100),
    pdata_lancamento DATE,
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT
    
    
)
BEGIN

	INSERT INTO lancamento (id_usuario, descricao_lancamento, valor, tipo_lancamento, data_lancamento, id_conta, id_cartao, id_categoria) VALUES
						   (pid_usuario, pdescricao_lancamento, pvalor, ptipo_lancamento, pdata_lancamento, pid_conta, pid_cartao, pid_categoria);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_lancamento_parcelado` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_lancamento_parcelado`(

	pid_usuario INT,
    ptipo_lancamento VARCHAR(100),
    pdescricao_lancamento VARCHAR(100),
    pvalor DECIMAL(10,2),
    pparcela VARCHAR(30),
    pdata_lancamento DATE,
    pfrequencia VARCHAR(100),
    pid_conta INT,
    pid_cartao INT,
    pid_categoria INT
    
    

)
BEGIN

	INSERT INTO lancamento (id_usuario, tipo_lancamento, descricao_lancamento, valor, quantidade_parcelas, data_lancamento, frequencia, id_conta, id_cartao, id_categoria) VALUES
						   (pid_usuario, ptipo_lancamento, pdescricao_lancamento, pvalor, pparcela, pdata_lancamento, pfrequencia, pid_conta, pid_cartao, pid_categoria);
                           
	SELECT id_lancamento FROM lancamento WHERE id_lancamento = LAST_INSERT_ID();

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_usuario_inserir` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_ZERO_IN_DATE,NO_ZERO_DATE,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_usuario_inserir`(

pnome VARCHAR(100),
psobrenome VARCHAR(100),
pemail VARCHAR(200),
pdata_nascimento DATE,
plogin VARCHAR(100),
psenha VARCHAR(500),
pid_tipo_usuario INT

)
BEGIN

	INSERT INTO USUARIO (nome, sobrenome, email, data_nascimento, login, senha, id_tipo_usuario) VALUES (pnome, psobrenome, pemail, pdata_nascimento, plogin, psenha, pid_tipo_usuario);
	
    SELECT * FROM USUARIO WHERE id_usuario = LAST_INSERT_ID();
    
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-27 20:27:28
