-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16/04/2026 às 01:35
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
-- Banco de dados: `pw2-26-t1-imc`
--
CREATE DATABASE IF NOT EXISTS `pw2-26-t1-imc` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pw2-26-t1-imc`;


-- --------------------------------------------------------


--
-- Estrutura para tabela `log_alteracoes`
--


CREATE TABLE `log_alteracoes` (
  `id` int(11) NOT NULL,
  `acao` varchar(50) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------


--
-- Estrutura para tabela `pessoas`
--


CREATE TABLE `pessoas` (
  `idpessoa` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(30) NOT NULL,
  `idade` int(3) NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


--
-- Despejando dados para a tabela `pessoas`
--


INSERT INTO `pessoas` (`idpessoa`, `nome`, `sobrenome`, `idade`, `peso`, `altura`) VALUES
(25, 'Ana', 'Silva', 18, 45, 1.65),
(26, 'Bruno', 'Souza', 25, 70, 1.75),
(27, 'Carlos', 'Oliveira', 30, 85, 1.7),
(28, 'Daniela', 'Pereira', 40, 95, 1.65),
(29, 'Eduardo', 'Costa', 50, 120, 1.75),
(30, 'Fernanda', 'Almeida', 60, 140, 1.6),
(31, 'Gabriel', 'Rocha', 16, 60, 1.72),
(32, 'Helena', 'Martins', 75, 68, 1.6),
(33, 'Igor', 'Fernandes', 35, 150, 1.8),
(34, 'Julia', 'Barbosa', 28, 40, 1.6);


--
-- Índices para tabelas despejadas
--


--
-- Índices de tabela `log_alteracoes`
--
ALTER TABLE `log_alteracoes`
  ADD PRIMARY KEY (`id`);


--
-- Índices de tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`idpessoa`);


--
-- AUTO_INCREMENT para tabelas despejadas
--


--
-- AUTO_INCREMENT de tabela `log_alteracoes`
--
ALTER TABLE `log_alteracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `idpessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;





