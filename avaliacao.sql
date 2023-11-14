-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29/08/2017 às 01:40
-- Versão do servidor: 5.7.14
-- Versão do PHP: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `celke`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacos`
--

CREATE TABLE `avaliacos` (
  `id` int(11) NOT NULL,
  `qnt_estrela` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `avaliacos`
--

INSERT INTO `avaliacos` (`id`, `qnt_estrela`, `created`, `modified`) VALUES
(1, 3, '2017-08-28 22:35:17', NULL),
(2, 5, '2017-08-28 22:35:35', NULL);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `avaliacos`
--
ALTER TABLE `avaliacos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `avaliacos`
--
ALTER TABLE `avaliacos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
