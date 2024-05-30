-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/05/2024 às 03:07
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `acme_fitness`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categorias`
--

INSERT INTO `categorias` (`id`, `codigo`, `nome`, `descricao`) VALUES
(1, '001', 'Eletrônicos', 'Produtos eletrônicos diversos'),
(2, '002', 'Roupas', 'Roupas masculinas e femininas'),
(3, '003', 'Acessórios', 'Diversos acessórios de moda');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`id`, `nome`, `cpf`, `data_nascimento`) VALUES
(1, 'João Silva', '123.456.789-00', '1990-01-15'),
(2, 'Maria Souza', '987.654.321-00', '1985-05-20'),
(3, 'Pedro Santos', '456.789.123-00', '1998-10-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `numero` varchar(10) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `complemento` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `codigo`, `logradouro`, `cidade`, `bairro`, `numero`, `cep`, `complemento`) VALUES
(1, '001', 'Rua das Flores', 'São Paulo', 'Centro', '100', '12345-678', 'Apto 101'),
(2, '002', 'Avenida Principal', 'Rio de Janeiro', 'Copacabana', '500', '54321-098', NULL),
(3, '003', 'Rua das Palmeiras', 'Salvador', 'Barra', '300', '87654-321', 'Casa 2');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens_pedido`
--

CREATE TABLE `itens_pedido` (
  `id` int(11) NOT NULL,
  `pedido_id` int(11) DEFAULT NULL,
  `variacao_id` int(11) DEFAULT NULL,
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `endereco_id` int(11) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `valor_frete` decimal(10,2) NOT NULL,
  `desconto` decimal(10,2) NOT NULL,
  `forma_pagamento` enum('PIX','Boleto','Cartao') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `peso` decimal(10,2) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `codigo`, `nome`, `cor`, `imagem`, `preco`, `descricao`, `data_cadastro`, `peso`, `categoria_id`) VALUES
(1, 'PROD001', 'Smartphone XYZ', 'Preto', 'imagem1.jpg', 999.99, 'Um smartphone de última geração', '2024-05-25', 0.20, 1),
(2, 'PROD002', 'Camiseta Estampada', 'Azul', 'imagem2.jpg', 29.99, 'Camiseta de algodão com estampa', '2024-05-25', 0.30, 2),
(3, 'PROD003', 'Bolsa de Couro', 'Marrom', 'imagem3.jpg', 79.99, 'Bolsa de couro genuíno', '2024-05-25', 0.50, 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `variacoes`
--

CREATE TABLE `variacoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `quantidade_estoque` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantidade_vendas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `variacoes`
--

INSERT INTO `variacoes` (`id`, `nome`, `quantidade_estoque`, `produto_id`, `quantidade_vendas`) VALUES
(1, 'Pequeno', -40, 1, 70),
(2, 'Médio', -15, 1, 93),
(3, 'Grande', -71, 1, 91),
(4, 'P', 50, 2, 11),
(5, 'M', 40, 2, 1),
(6, 'G', 30, 2, 111),
(7, 'Único', 25, 3, 767);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `tamanho_id` (`variacao_id`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `endereco_id` (`endereco_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices de tabela `variacoes`
--
ALTER TABLE `variacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produto_id` (`produto_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `itens_pedido`
--
ALTER TABLE `itens_pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `variacoes`
--
ALTER TABLE `variacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens_pedido`
--
ALTER TABLE `itens_pedido`
  ADD CONSTRAINT `itens_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `itens_pedido_ibfk_2` FOREIGN KEY (`variacao_id`) REFERENCES `variacoes` (`id`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`endereco_id`) REFERENCES `enderecos` (`id`);

--
-- Restrições para tabelas `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Restrições para tabelas `variacoes`
--
ALTER TABLE `variacoes`
  ADD CONSTRAINT `variacoes_ibfk_1` FOREIGN KEY (`produto_id`) REFERENCES `produtos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
