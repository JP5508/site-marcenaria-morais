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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.catalogo: ~25 rows (aproximadamente)
INSERT INTO `catalogo` (`Cat_id`, `Cat_img1`, `Cat_img2`, `Cat_img3`, `Cat_img4`, `Cat_nome`, `Cat_cate`, `Cat_desc`) VALUES
	(1, 'cat_armario.png', 'cat_armario.png', 'cat_armario.png', 'cat_armario.png', 'Armario', 'Cozinha', 'Armario para Cozinha Marrom'),
	(2, 'cat_bancada-cozinha.png', 'cat_bancada-cozinha.png', 'cat_bancada-cozinha.png', 'cat_bancada-cozinha.png', 'Bancada Planejada', 'Cozinha', 'Bancada Planejada para cozinha'),
	(3, 'cat_banco.png', 'cat_banco.png', 'cat_banco.png', 'cat_banco.png', 'Banco', 'Variados', 'Banco marrom para ambientes'),
	(4, 'cat_banquinho.png', 'cat_banquinho.png', 'cat_banquinho.png', 'cat_banquinho.png', 'Banco', 'Variados', 'Banco pequeno para ambientes externos'),
	(5, 'cat_caixa-de-ferramenta.png', 'cat_caixa-de-ferramenta.png', 'cat_caixa-de-ferramenta.png', 'cat_caixa-de-ferramenta.png', 'Caixa de Ferramentas', 'Variados', 'Exclente caixa para guardar ferramentas!'),
	(6, 'cat_cama.png', 'cat_cama.png', 'cat_cama.png', 'cat_cama.png', 'Cama', 'Quarto', 'Cama de solteiro com cama auxiliar em baixo'),
	(7, 'cat_cesto-de-roupa.png', 'cat_cesto-de-roupa.png', 'cat_cesto-de-roupa.png', 'cat_cesto-de-roupa.png', 'Cesto de Roupas', 'Quarto', 'Cesto para guardar roupas sujas'),
	(8, 'cat_cozinha.png', 'cat_cozinha.png', 'cat_cozinha.png', 'cat_cozinha.png', 'Cozinha Planejada', 'Cozinha', 'Cozinha Planejada cinza e moderna'),
	(9, 'cat_escrivaninha.png', 'cat_escrivaninha.png', 'cat_escrivaninha.png', 'cat_escrivaninha.png', 'Escrivaninha', 'Escritório', 'Escrivaninha de madeira'),
	(10, 'cat_gabinete.png', 'cat_gabinete.png', 'cat_gabinete.png', 'cat_gabinete.png', 'Gabinete para Banheiro Planejado', 'Banheiro', 'Gabinete para Banheiro Planejado marrom'),
	(11, 'cat_gaveteiro.png', 'cat_gaveteiro.png', 'cat_gaveteiro.png', 'cat_gaveteiro.png', 'Gaveteiro', 'Quarto', 'Gaveteiro multifuncional'),
	(12, 'cat_guardaroupa.png', 'cat_guardaroupa.png', 'cat_guardaroupa.png', 'cat_guardaroupa.png', 'Guarda Roupas', 'Quarto', 'Guarda Roupa de madeira'),
	(13, 'cat_guarda-roupa-casal.png', 'cat_guarda-roupa-casal.png', 'cat_guarda-roupa-casal.png', 'cat_guarda-roupa-casal.png', 'Guarda Roupas', 'Quarto', 'Guarda Roupas grande para casal'),
	(14, 'cat_guardaroupas.png', 'cat_guardaroupas.png', 'cat_guardaroupas.png', 'cat_guardaroupas.png', 'Guarda Roupas', 'Quarto', 'Guarda Roupas pequeno ideal para solteiro'),
	(15, 'cat_mesa.png', 'cat_mesa.png', 'cat_mesa.png', 'cat_mesa.png', 'Mesa', 'Cozinha', 'Mesa para cozinha'),
	(16, 'cat_mesa-lateral.png', 'cat_mesa-lateral.png', 'cat_mesa-lateral.png', 'cat_mesa-lateral.png', 'Mesa de Centro', 'Sala de Estar', 'Mesinha de centro para sala de estar'),
	(17, 'cat_painel-decorativo.png', 'cat_painel-decorativo.png', 'cat_painel-decorativo.png', 'cat_painel-decorativo.png', 'Painel Ripado', 'Quarto', 'Painel excelente para closet'),
	(18, 'cat_painel-tv.png', 'cat_painel-tv.png', 'cat_painel-tv.png', 'cat_painel-tv.png', 'Painel para Televisão', 'Sala de Estar', 'Painel para Televisão para tamanhos variados'),
	(19, 'cat_porta-de-madeira.png', 'cat_porta-de-madeira.png', 'cat_porta-de-madeira.png', 'cat_porta-de-madeira.png', 'Porta de Madeira', 'Sala de Estar', 'Porta principal de casa'),
	(20, 'cat_porta-retrato.png', 'cat_porta-retrato.png', 'cat_porta-retrato.png', 'cat_porta-retrato.png', 'Porta Retrato', 'Variados', 'Porta retrato para fotos'),
	(21, 'cat_prateleira.png', 'cat_prateleira.png', 'cat_prateleira.png', 'cat_prateleira.png', 'Prateleira', 'Escritório', 'Prateleira para escritório'),
	(22, 'cat_sapateira.png', 'cat_sapateira.png', 'cat_sapateira.png', 'cat_sapateira.png', 'Sapateira', 'Quarto', 'Sapateira'),
	(23, 'cat_sofa.png', 'cat_sofa.png', 'cat_sofa.png', 'cat_sofa.png', 'Sofa', 'Sala de Estar', 'Sofa para sala de estar'),
	(24, 'cat_suporte-para-livro.png', 'cat_suporte-para-livro.png', 'cat_suporte-para-livro.png', 'cat_suporte-para-livro.png', 'Suporte para livro', 'Variados', 'Suporte para livro'),
	(25, 'cat_suporte-para-planta.png', 'cat_suporte-para-planta.png', 'cat_suporte-para-planta.png', 'cat_suporte-para-planta.png', 'Suporte para planta', 'Variados', 'Suporte para planta');

-- Copiando estrutura para tabela marcenaria_morais.categoria_funcionario
CREATE TABLE IF NOT EXISTS `categoria_funcionario` (
  `Catg_id` int NOT NULL AUTO_INCREMENT,
  `Catg_nome` varchar(255) DEFAULT NULL,
  `Catg_sal` double(10,2) NOT NULL,
  PRIMARY KEY (`Catg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.categoria_funcionario: ~3 rows (aproximadamente)
INSERT INTO `categoria_funcionario` (`Catg_id`, `Catg_nome`, `Catg_sal`) VALUES
	(1, 'Marceneiro', 3591.89),
	(2, 'Auxiliar de Marceneiro', 2385.77),
	(3, 'Vendedor', 2974.10);

-- Copiando estrutura para tabela marcenaria_morais.cliente
CREATE TABLE IF NOT EXISTS `cliente` (
  `Cli_cpf` bigint NOT NULL,
  `Cli_nome` varchar(255) NOT NULL,
  `Cli_tel1` bigint NOT NULL,
  `Cli_tel2` bigint DEFAULT NULL,
  `Cli_cep` int NOT NULL,
  `Cli_bairro` varchar(255) NOT NULL,
  `Cli_rua` varchar(255) NOT NULL,
  `Cli_num_casa` int NOT NULL,
  `Cli_complemento` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Cli_cpf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.cliente: ~10 rows (aproximadamente)
INSERT INTO `cliente` (`Cli_cpf`, `Cli_nome`, `Cli_tel1`, `Cli_tel2`, `Cli_cep`, `Cli_bairro`, `Cli_rua`, `Cli_num_casa`, `Cli_complemento`) VALUES
	(3998429859, 'Maitê Sophia Fogaça', 11935722687, 11999278820, 4880070, 'Recanto Campo Belo', 'Rua Leonardo La Bella', 378, 'Próximo ao Catita'),
	(14130505815, 'Ryan Bryan Monteiro', 11929527751, 11987661635, 5618090, 'Vila Inah', 'Praça Apalóide', 879, 'Próximo a Etec Irmã Agostina'),
	(16458176872, 'Carlos Pedro das Neves', 11927974245, 11985899497, 5314001, 'Vila Leopoldina', 'Avenida Doutor Gastão Vidigal', 496, 'Próximo a Vita Sport Academia'),
	(23931147851, 'Isis Mariah Pires', 11929149811, 11991158196, 3347000, 'Vila Regente Feijó', 'Rua Oiti', 512, 'Próximo ao Cantinho dos Bixos'),
	(38868922800, 'Levi Julio Diogo Nogueira', 11927467886, 11988160569, 1445020, 'Jardim Paulistano', 'Rua Venceslau Flexa', 104, 'Próximo a Padaria Altas Horas'),
	(40406182892, 'Alícia Sophia Fernandes', 11925316685, 11984839659, 2759100, 'Vila Bancária Munhoz', 'Rua Vicente Jorge', 921, 'Próximo ao mercadinho Marino'),
	(73171676818, 'Lorena Tereza Souza', 11937965226, 11994404470, 3086030, 'Parque São Jorge', 'Rua Santa Elvira', 424, 'Próximo ao Eskina pizza'),
	(77469281886, 'Renato Manoel Araújo', 11928895379, 11991873725, 4613050, 'Campo Belo', 'Rua Barão de Mambucaba', 642, 'Próximo ao Dois Primos Sorveteria'),
	(89854227820, 'Kauê Roberto Rodrigo Araújo', 11935718093, 11986640079, 4542010, 'Itaim Bibi', 'Rua Leopoldo Couto de Magalhães Júnior', 386, 'Próximo a Mansão Maromba'),
	(93965445820, 'Marcos Vinicius Rodrigo Rodrigues', 11989352852, 11925199864, 2288040, 'Vila Ayrosa', 'Rua dos Rouxinóis Amarelos', 307, 'Próximo a Delegacia 100');

-- Copiando estrutura para tabela marcenaria_morais.estoque
CREATE TABLE IF NOT EXISTS `estoque` (
  `Estq_id` int NOT NULL AUTO_INCREMENT,
  `Estq_produto` varchar(255) NOT NULL,
  `Estq_quant` int NOT NULL,
  `Estq_tel_forne` bigint DEFAULT NULL,
  `Estq_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Estq_id`),
  UNIQUE KEY `Estq_produto` (`Estq_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.estoque: ~10 rows (aproximadamente)
INSERT INTO `estoque` (`Estq_id`, `Estq_produto`, `Estq_quant`, `Estq_tel_forne`, `Estq_img`) VALUES
	(1, 'Pregos 10x12mm', 2000, 11937271861, 'estq_prego.png'),
	(2, 'Parafusos Chipboard Philips 4x12mm', 5000, 11937271861, 'estq_parafuso.png'),
	(3, 'Chapa de Pinus 1.7mmx20cmx120cm', 20, 11928374424, 'estq_pinus.png'),
	(4, 'Chapa de Compensado Naval 2.2mx1.6mx15mm', 50, 11932913818, 'estq_naval.png'),
	(5, 'Pino de madeira 60x10mm', 5000, 11937271861, 'estq_pino.png'),
	(6, 'Cantoneira L 1x1cm', 500, 11925263192, 'estq_cantoneira.png'),
	(7, 'Dobradiça de pressão 35mm', 1500, 11925518342, 'estq_dobradica.png'),
	(8, 'Corrediça Telescópica 45cm 450mm PAR', 100, 11937271861, 'estq_corredica.png'),
	(9, 'Puxador Slim', 50, 11928085848, 'estq_puxador.png'),
	(10, 'Parafusos diversos', 10000, 11933714265, 'estq_parafusos_diversos.png');

-- Copiando estrutura para tabela marcenaria_morais.financeiro
CREATE TABLE IF NOT EXISTS `financeiro` (
  `Fin_id` int NOT NULL AUTO_INCREMENT,
  `Fin_mov_desc` varchar(255) NOT NULL,
  `Fin_mov_val` float(10,2) NOT NULL,
  `Fin_data` date NOT NULL,
  PRIMARY KEY (`Fin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.financeiro: ~10 rows (aproximadamente)
INSERT INTO `financeiro` (`Fin_id`, `Fin_mov_desc`, `Fin_mov_val`, `Fin_data`) VALUES
	(1, 'Compra de cantoneiras', 199.10, '2025-01-24'),
	(2, 'Compra de parafusos e pregos', 585.89, '2025-02-11'),
	(3, 'Compra de materiais para projetos futuros', 2154.74, '2025-03-25'),
	(4, 'Pagamento de fornecedor', 12976.21, '2025-03-28'),
	(5, 'Compra de chapas de compensado', 10000.00, '2025-04-23'),
	(6, 'Pagamento de funcionários', 25367.81, '2025-05-05'),
	(7, 'Compra de equipamentos', 20349.99, '2025-06-08'),
	(8, 'Compra de chapas de madeira pinus', 15900.00, '2025-06-17'),
	(9, 'Pagamento de contas fixas mensais', 1432.82, '2025-08-01'),
	(10, 'Compra de placas para painel ripado', 599.90, '2025-09-13');

-- Copiando estrutura para tabela marcenaria_morais.funcionario
CREATE TABLE IF NOT EXISTS `funcionario` (
  `Func_cpf` bigint NOT NULL,
  `Func_nome` varchar(255) DEFAULT NULL,
  `Func_tel1` bigint DEFAULT NULL,
  `Func_tel2` bigint DEFAULT NULL,
  `Func_desc` varchar(255) NOT NULL,
  `Catg_id` int NOT NULL,
  PRIMARY KEY (`Func_cpf`),
  KEY `Catg_id` (`Catg_id`),
  CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`Catg_id`) REFERENCES `categoria_funcionario` (`Catg_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.funcionario: ~10 rows (aproximadamente)
INSERT INTO `funcionario` (`Func_cpf`, `Func_nome`, `Func_tel1`, `Func_tel2`, `Func_desc`, `Catg_id`) VALUES
	(773544860, 'Ruan Marcos Vinicius Dias', 11927229926, 11987469049, 'Trabalha como auxiliar de projetos do Benício Benjamin', 2),
	(9446964814, 'Benício Benjamin Ricardo Souza', 11925140128, 11996889347, 'Trabalha com projetos de clientes na empresa', 1),
	(17188721866, 'Rodrigo Guilherme Marcelo Bernardes', 11938802773, 11991913296, 'Trabalha vendendo os projetos e captando novos clientes', 3),
	(17459625817, 'Elias César Leandro Barros', 11927229926, 11997663475, 'Trabalha como auxiliar de projetos do Benício Benjamin', 2),
	(32654765881, 'Lorenzo Ricardo Fernandes', 11936382542, 11991521798, 'Trabalha com projetos de clientes na empresa', 1),
	(42796787826, 'Mateus Marcos Enzo Freitas', 11927229926, 11997663475, 'Trabalha como auxiliar de projetos do Raphael Morais', 2),
	(56986461801, 'José Samuel Novaes', 11935868958, 11986948624, 'Trabalha vendendo os projetos e captando novos clientes', 3),
	(67422907819, 'Cauã Martin Pereira', 11937541076, 11982316808, 'Trabalha como auxiliar de projetos do Raphael Morais', 2),
	(86871100814, 'Bryan Osvaldo Ribeiro', 11937998977, 11991163884, 'Trabalha como auxiliar de projetos do Lorenzo Ricardo', 2),
	(96348696880, 'Mário Levi Renato Lima', 11927896399, 11997387831, 'Trabalha como auxiliar de projetos do Lorenzo Ricardo', 2);

-- Copiando estrutura para tabela marcenaria_morais.pedido
CREATE TABLE IF NOT EXISTS `pedido` (
  `Ped_id` int NOT NULL AUTO_INCREMENT,
  `Ped_realizado` date NOT NULL,
  `Ped_entrega` date NOT NULL,
  `Ped_executado` tinyint(1) NOT NULL,
  `Ped_desc` varchar(255) NOT NULL,
  `Ped_valor` float(10,2) NOT NULL,
  `Cli_cpf` bigint NOT NULL,
  `Estq_id1` int NOT NULL,
  `Estq_id2` int DEFAULT NULL,
  `Estq_id3` int DEFAULT NULL,
  `Estq_id4` int DEFAULT NULL,
  `Estq_id5` int DEFAULT NULL,
  PRIMARY KEY (`Ped_id`),
  KEY `Cli_cpf` (`Cli_cpf`),
  KEY `Estq_id1` (`Estq_id1`),
  KEY `Estq_id2` (`Estq_id2`),
  KEY `Estq_id3` (`Estq_id3`),
  KEY `Estq_id4` (`Estq_id4`),
  KEY `Estq_id5` (`Estq_id5`),
  CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`Cli_cpf`) REFERENCES `cliente` (`Cli_cpf`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`Estq_id1`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`Estq_id2`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_4` FOREIGN KEY (`Estq_id3`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_5` FOREIGN KEY (`Estq_id4`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `pedido_ibfk_6` FOREIGN KEY (`Estq_id5`) REFERENCES `estoque` (`Estq_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela marcenaria_morais.pedido: ~10 rows (aproximadamente)
INSERT INTO `pedido` (`Ped_id`, `Ped_realizado`, `Ped_entrega`, `Ped_executado`, `Ped_desc`, `Ped_valor`, `Cli_cpf`, `Estq_id1`, `Estq_id2`, `Estq_id3`, `Estq_id4`, `Estq_id5`) VALUES
	(1, '2025-02-04', '2025-02-15', 1, 'Bancada e mesa planejada para área de serviço madeira bruta', 2000.00, 73171676818, 2, 3, 5, 8, 9),
	(2, '2025-02-14', '2025-03-10', 1, 'Armários para cozinha e cuba de pia, cozinha toda planejada cor branca', 7500.00, 14130505815, 4, 6, 8, 9, 10),
	(3, '2025-04-18', '2025-05-26', 1, 'Armários completos para cozinha planejada', 3000.00, 93965445820, 1, 2, 6, 7, 10),
	(4, '2025-07-02', '2025-07-25', 1, 'Guarda Roupa de casal planejado cor bege com espelhos madeira bruta', 15000.00, 3998429859, 1, 2, 8, 9, 10),
	(5, '2025-07-21', '2025-08-23', 1, 'Painel ripado com gavetas planejado branco e marrom', 1500.00, 16458176872, 5, 6, 7, 9, 10),
	(6, '2025-08-07', '2025-08-29', 1, 'Guarda Roupas, estante para tv e escrivaninha planejados cor marrom escuro', 5900.00, 23931147851, 2, 3, 5, 6, 10),
	(7, '2025-08-29', '2025-09-15', 1, 'Armários para cozinha planejados cor madeira clara', 1500.00, 23931147851, 1, 2, 3, 4, 5),
	(8, '2025-09-13', '2025-10-01', 0, 'Armários e pia para banheiro planejados cor preta', 4500.00, 40406182892, 1, 2, 3, 4, 5),
	(9, '2025-09-19', '2025-10-06', 0, 'Armários planejados para área de lazer cor preta', 2250.00, 77469281886, 1, 2, 7, 8, 9),
	(10, '2025-09-22', '2025-10-11', 0, 'Escritório completo planejado madeira bruta', 22000.00, 38868922800, 1, 2, 3, 4, 10);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
