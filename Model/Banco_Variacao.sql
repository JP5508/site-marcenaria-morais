-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para marcenaria_morais
CREATE DATABASE IF NOT EXISTS `marcenaria_morais` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `marcenaria_morais`;

-- Copiando estrutura para tabela marcenaria_morais.catalogo
CREATE TABLE IF NOT EXISTS `catalogo` (
  `Cat_id` int NOT NULL AUTO_INCREMENT,
  `Cat_img1` varchar(255) NOT NULL,
  `Cat_img2` varchar(255) DEFAULT NULL,
  `Cat_img3` varchar(255) DEFAULT NULL,
  `Cat_img4` varchar(255) DEFAULT NULL,
  `Cat_nome` varchar(255) NOT NULL,
  `Cat_cate` varchar(255) NOT NULL,
  `Cat_desc` varchar(255) NOT NULL,
  PRIMARY KEY (`Cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela marcenaria_morais.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `Cli_cpf` int NOT NULL,
  `Cli_nome` varchar(255) NOT NULL,
  `Cli_tel1` int NOT NULL,
  `Cli_tel2` int DEFAULT NULL,
  `Cli_cep` int NOT NULL,
  `Cli_bairro` varchar(255) NOT NULL,
  `Cli_rua` varchar(255) NOT NULL,
  `Cli_num_casa` int NOT NULL,
  `Cli_complemento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Cli_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela marcenaria_morais.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `Estq_id` int NOT NULL AUTO_INCREMENT,
  `Estq_produto` varchar(255) NOT NULL,
  `Estq_quant` int NOT NULL,
  `Estq_tel_forne` int DEFAULT NULL,
  `Estq_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Estq_id`),
  UNIQUE KEY `Estq_produto` (`Estq_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela marcenaria_morais.financeiro
CREATE TABLE IF NOT EXISTS `financeiro` (
  `Fin_id` int NOT NULL AUTO_INCREMENT,
  `Fin_mov_desc` varchar(255) NOT NULL,
  `Fin_mov_val` float(10,2) NOT NULL,
  `Fin_data` date NOT NULL,
  PRIMARY KEY (`Fin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela marcenaria_morais.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `Ped_id` int NOT NULL AUTO_INCREMENT,
  `Ped_realizado` date NOT NULL,
  `Ped_entrega` date NOT NULL,
  `Ped_executado` tinyint(1) NOT NULL,
  `Ped_desc` varchar(255) NOT NULL,
  `Ped_valor` float(10,2) NOT NULL,
  `Cli_cpf` int NOT NULL,
  PRIMARY KEY (`Ped_id`),
  KEY `Cli_cpf` (`Cli_cpf`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Cli_cpf`) REFERENCES `cliente` (`Cli_cpf`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

-- Copiando estrutura para tabela marcenaria_morais.pedido_item
CREATE TABLE IF NOT EXISTS `pedido_item` (
  `Ped_id` int NOT NULL,
  `Estq_id` int NOT NULL,
  PRIMARY KEY (`Ped_id`,`Estq_id`),
  KEY `Estq_id` (`Estq_id`),
  CONSTRAINT `pedido_item_ibfk_1` FOREIGN KEY (`Ped_id`) REFERENCES `pedido` (`Ped_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_item_ibfk_2` FOREIGN KEY (`Estq_id`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Exportação de dados foi desmarcado.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
