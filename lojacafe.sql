-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/11/2025 às 23:32
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lojacafe`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `CarrinhoID` int(11) NOT NULL,
  `UsuarioID` int(11) DEFAULT 1,
  `ValorTotal` decimal(10,2) DEFAULT 0.00,
  `DataCriacao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carrinho`
--

INSERT INTO `carrinho` (`CarrinhoID`, `UsuarioID`, `ValorTotal`, `DataCriacao`) VALUES
(1, 1, 0.00, '2025-11-15 23:13:00'),
(2, 1, 0.00, '2025-11-15 23:13:42'),
(3, 1, 0.00, '2025-11-15 23:16:25'),
(4, 1, 35.50, '2025-11-15 23:19:29'),
(5, 1, 12.50, '2025-11-15 23:25:03'),
(6, 1, 18.50, '2025-11-15 23:25:16'),
(7, 1, 0.00, '2025-11-16 00:13:27'),
(8, 1, 70.00, '2025-11-16 00:14:10'),
(9, 1, 15.00, '2025-11-16 00:17:15'),
(10, 1, 15.00, '2025-11-16 00:18:50'),
(11, 1, 40.00, '2025-11-16 00:19:55'),
(12, 1, 40.00, '2025-11-16 00:20:41'),
(13, 1, 15.00, '2025-11-16 00:22:31'),
(14, 1, 15.00, '2025-11-16 00:24:50'),
(15, 1, 20.00, '2025-11-16 00:25:12'),
(16, 1, 15.00, '2025-11-16 00:28:54'),
(17, 1, 15.00, '2025-11-16 00:33:05'),
(18, 1, 10.00, '2025-11-16 00:34:16'),
(19, 1, 15.00, '2025-11-16 00:36:10'),
(20, 1, 25.00, '2025-11-16 00:36:26'),
(21, 1, 40.00, '2025-11-16 00:39:05'),
(22, 1, 20.00, '2025-11-16 00:39:13'),
(23, 1, 25.00, '2025-11-16 00:39:20'),
(24, 1, 15.00, '2025-11-16 00:40:34'),
(25, 1, 25.00, '2025-11-16 00:40:38'),
(26, 1, 15.00, '2025-11-16 00:40:49'),
(27, 1, 25.00, '2025-11-16 00:40:55'),
(28, 1, 15.00, '2025-11-16 00:49:50'),
(29, 1, 30.00, '2025-11-16 00:55:54'),
(30, 1, 15.00, '2025-11-16 00:56:04'),
(31, 1, 15.00, '2025-11-16 00:56:29'),
(32, 1, 45.00, '2025-11-16 00:59:53'),
(33, 1, 10.00, '2025-11-16 01:04:52'),
(34, 1, 10.00, '2025-11-16 02:43:41'),
(35, 1, 40.00, '2025-11-16 03:10:53'),
(36, 1, 15.00, '2025-11-16 03:50:44'),
(37, 1, 20.00, '2025-11-16 03:50:52'),
(38, 1, 40.00, '2025-11-16 03:57:52'),
(39, 1, 15.00, '2025-11-16 04:04:51'),
(40, 1, 15.00, '2025-11-16 04:05:06'),
(41, 1, 10.00, '2025-11-16 04:05:23'),
(42, 1, 15.00, '2025-11-16 04:08:11'),
(43, 1, 25.00, '2025-11-16 04:08:16'),
(44, 1, 15.00, '2025-11-16 04:16:32'),
(45, 1, 0.00, '2025-11-16 07:47:32'),
(46, 1, 15.00, '2025-11-16 07:48:27'),
(47, 1, 15.00, '2025-11-16 07:50:32'),
(48, 1, 20.00, '2025-11-16 07:50:39'),
(49, 1, 25.00, '2025-11-16 07:50:51'),
(50, 1, 15.00, '2025-11-16 08:28:08'),
(51, 1, 15.00, '2025-11-16 08:29:55'),
(52, 1, 15.00, '2025-11-16 08:30:17'),
(53, 1, 55.00, '2025-11-16 08:30:27'),
(54, 1, 15.00, '2025-11-16 08:31:11'),
(55, 1, 15.00, '2025-11-16 08:32:21'),
(56, 1, 0.00, '2025-11-16 08:37:27'),
(57, 1, 0.00, '2025-11-16 08:51:56'),
(58, 1, 0.00, '2025-11-16 08:55:27'),
(59, 1, 0.00, '2025-11-16 08:56:31'),
(60, 1, 0.00, '2025-11-16 08:57:12'),
(61, 1, 35.00, '2025-11-16 09:00:57'),
(62, 1, 30.00, '2025-11-16 09:14:34'),
(63, 1, 0.00, '2025-11-16 09:15:26'),
(64, 1, 0.00, '2025-11-16 09:18:49'),
(65, 1, 0.00, '2025-11-16 09:20:37'),
(66, 1, 35.00, '2025-11-16 09:23:06'),
(67, 1, 40.00, '2025-11-16 09:38:49'),
(68, 1, 60.00, '2025-11-16 09:39:21'),
(69, 1, 95.00, '2025-11-16 09:41:14'),
(70, 1, 85.00, '2025-11-16 09:41:51'),
(71, 1, 0.00, '2025-11-16 10:27:21'),
(72, 1, 0.00, '2025-11-16 10:33:12'),
(73, 1, 0.00, '2025-11-16 10:33:39'),
(74, 1, 0.00, '2025-11-16 10:37:47'),
(75, 1, 0.00, '2025-11-16 10:41:00'),
(76, 1, 0.00, '2025-11-16 10:48:44'),
(77, 1, 0.00, '2025-11-16 10:56:24'),
(78, 1, 0.00, '2025-11-16 11:18:32'),
(79, 1, 0.00, '2025-11-16 12:33:39'),
(80, 1, 0.00, '2025-11-16 13:01:49'),
(81, 1, 0.00, '2025-11-16 13:05:52'),
(82, 1, 0.00, '2025-11-16 13:10:10'),
(83, 1, 0.00, '2025-11-16 13:31:56'),
(84, 1, 0.00, '2025-11-16 15:31:52'),
(85, 1, 0.00, '2025-11-16 15:58:32'),
(86, 1, 0.00, '2025-11-16 15:58:58'),
(87, 1, 0.00, '2025-11-16 16:45:43'),
(88, 1, 0.00, '2025-11-16 19:13:51'),
(89, 1, 0.00, '2025-11-16 19:16:11'),
(90, 1, 0.00, '2025-11-16 19:19:33'),
(91, 1, 0.00, '2025-11-16 19:22:42'),
(92, 1, 0.00, '2025-11-16 19:23:04'),
(93, 1, 0.00, '2025-11-16 19:46:15'),
(94, 1, 0.00, '2025-11-16 19:46:51'),
(95, 1, 0.00, '2025-11-16 19:50:12'),
(96, 1, 0.00, '2025-11-16 19:53:13'),
(97, 1, 0.00, '2025-11-16 19:53:39'),
(98, 1, 100.00, '2025-11-16 20:53:56'),
(99, 1, 120.00, '2025-11-16 20:59:14'),
(100, 1, 0.00, '2025-11-16 21:11:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho_produtos`
--

CREATE TABLE `carrinho_produtos` (
  `CarrinhoProdutoID` int(11) NOT NULL,
  `CarrinhoID` int(11) DEFAULT NULL,
  `ProdutoID` int(11) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `newsletter`
--

CREATE TABLE `newsletter` (
  `ID` int(11) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `DataRegistro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `PedidoID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `DataPedido` datetime NOT NULL,
  `Status` enum('Pendente','Em Preparo','Pronto','Entregue') DEFAULT 'Pendente',
  `FormaPagamento` varchar(50) DEFAULT NULL,
  `ValorTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pedidos`
--

INSERT INTO `pedidos` (`PedidoID`, `UsuarioID`, `DataPedido`, `Status`, `FormaPagamento`, `ValorTotal`) VALUES
(1, 1, '2025-11-16 05:52:05', 'Pendente', NULL, 30.00),
(2, 1, '2025-11-16 05:55:30', 'Pendente', NULL, 25.00),
(3, 1, '2025-11-16 05:56:43', 'Pendente', NULL, 20.00),
(4, 1, '2025-11-16 05:58:05', 'Pendente', NULL, 65.00),
(5, 1, '2025-11-16 06:05:28', 'Pendente', NULL, 35.00),
(6, 1, '2025-11-16 06:14:43', 'Pendente', NULL, 30.00),
(7, 1, '2025-11-16 06:15:33', 'Pendente', NULL, 55.00),
(8, 1, '2025-11-16 06:18:53', 'Pendente', NULL, 65.00),
(9, 1, '2025-11-16 06:20:42', 'Pendente', NULL, 40.00),
(10, 1, '2025-11-16 06:23:23', 'Pendente', NULL, 35.00),
(11, 1, '2025-11-16 06:39:00', 'Pendente', NULL, 40.00),
(12, 1, '2025-11-16 06:39:38', 'Pendente', NULL, 60.00),
(13, 1, '2025-11-16 06:41:37', 'Pendente', NULL, 95.00),
(14, 1, '2025-11-16 07:27:11', 'Pendente', NULL, 125.00),
(15, 1, '2025-11-16 07:32:50', 'Pendente', NULL, 110.00),
(16, 1, '2025-11-16 07:33:21', 'Pendente', NULL, 120.00),
(17, 1, '2025-11-16 07:35:39', 'Pendente', NULL, 125.00),
(18, 2, '2025-11-16 16:01:43', '', NULL, 165.00),
(19, 2, '2025-11-16 16:01:59', '', NULL, 90.00),
(20, 2, '2025-11-16 16:02:02', '', NULL, 90.00),
(21, 2, '2025-11-16 16:10:40', '', NULL, 90.00),
(22, 2, '2025-11-16 16:13:27', '', NULL, 90.00),
(23, 2, '2025-11-16 16:13:55', '', NULL, 80.00),
(24, 2, '2025-11-16 16:16:17', '', NULL, 75.00),
(25, 2, '2025-11-16 16:19:36', '', NULL, 40.00),
(40, 2, '2025-11-16 17:54:17', '', NULL, 85.00),
(41, 2, '2025-11-16 17:54:17', '', NULL, 85.00),
(42, 2, '2025-11-16 17:59:19', '', NULL, 120.00),
(43, 2, '2025-11-16 17:59:19', '', NULL, 120.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_itens`
--

CREATE TABLE `pedido_itens` (
  `ItemID` int(11) NOT NULL,
  `PedidoID` int(11) NOT NULL,
  `ProdutoID` int(11) NOT NULL,
  `Quantidade` int(11) NOT NULL,
  `ValorUnitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `ProdutoID` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Descricao` text DEFAULT NULL,
  `Valor` decimal(10,2) DEFAULT NULL,
  `Quantidade` int(11) DEFAULT NULL,
  `Imagem` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`ProdutoID`, `Nome`, `Descricao`, `Valor`, `Quantidade`, `Imagem`) VALUES
(1, 'Expresso', 'Água quente que passa sob uma pressão quase 10 vezes maior que a normal pelo grão moído, é mais encorpado e conta com um sabor mais intenso ', 15.00, 100, 'xicara.jpg'),
(2, 'Cappuccino', 'Feito com café expresso, leite vaporizado, aquela espuma cremosa e com chocolate polvilhado por cima', 25.00, 100, 'capittino.jpg'),
(3, 'Macchiato', 'Uma dose de espresso, finalizada com uma pequena quantidade de espuma de leite vaporizado', 20.00, 100, 'cafe_au_latte.jpg'),
(4, 'Americano', 'Feito com café expresso e água quente, o que a torna uma opção mais suave para aqueles que preferem um sabor menos intenso', 10.00, 100, 'americano.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `UsuarioID` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Endereco` varchar(200) NOT NULL,
  `Complemento` varchar(100) DEFAULT NULL,
  `Telefone` varchar(20) DEFAULT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`UsuarioID`, `Nome`, `Email`, `Endereco`, `Complemento`, `Telefone`, `Senha`) VALUES
(1, 'Carlos Navas ', 'carlosnqf@gmail.com', 'Rua da Constituinte 168', '', '11982658783', '$2y$10$dwbiIrh4xuoSWZjDPPVpNucib4KFfuPSZQwYIhn5pln1Je0Wau6WS'),
(2, 'Rodrigo dos Santos Freitas', 'r.sfreitas@hotmail.com', 'rua Stefano Mauser 157', NULL, '11993996868', '$2y$10$K4IiWsgNZKb821JUFC4nleDaLouNMao9w6dmAzFB4yi.LZQEWeRh.');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`CarrinhoID`);

--
-- Índices de tabela `carrinho_produtos`
--
ALTER TABLE `carrinho_produtos`
  ADD PRIMARY KEY (`CarrinhoProdutoID`),
  ADD UNIQUE KEY `uq_carrinho_produto` (`CarrinhoID`,`ProdutoID`),
  ADD UNIQUE KEY `CarrinhoID` (`CarrinhoID`,`ProdutoID`),
  ADD KEY `ProdutoID` (`ProdutoID`);

--
-- Índices de tabela `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Índices de tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`PedidoID`),
  ADD KEY `UsuarioID` (`UsuarioID`);

--
-- Índices de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD PRIMARY KEY (`ItemID`),
  ADD KEY `PedidoID` (`PedidoID`),
  ADD KEY `ProdutoID` (`ProdutoID`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`ProdutoID`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`UsuarioID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `CarrinhoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de tabela `carrinho_produtos`
--
ALTER TABLE `carrinho_produtos`
  MODIFY `CarrinhoProdutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT de tabela `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `PedidoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de tabela `pedido_itens`
--
ALTER TABLE `pedido_itens`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `ProdutoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho_produtos`
--
ALTER TABLE `carrinho_produtos`
  ADD CONSTRAINT `carrinho_produtos_ibfk_1` FOREIGN KEY (`CarrinhoID`) REFERENCES `carrinho` (`CarrinhoID`),
  ADD CONSTRAINT `carrinho_produtos_ibfk_2` FOREIGN KEY (`ProdutoID`) REFERENCES `produtos` (`ProdutoID`);

--
-- Restrições para tabelas `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `usuarios` (`UsuarioID`);

--
-- Restrições para tabelas `pedido_itens`
--
ALTER TABLE `pedido_itens`
  ADD CONSTRAINT `pedido_itens_ibfk_1` FOREIGN KEY (`PedidoID`) REFERENCES `pedidos` (`PedidoID`),
  ADD CONSTRAINT `pedido_itens_ibfk_2` FOREIGN KEY (`ProdutoID`) REFERENCES `produtos` (`ProdutoID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
