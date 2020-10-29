-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Out-2020 às 17:24
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.4.11

create database livrariaonline;
use livrariaonline;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `livrariaonline`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Autor` varchar(30) NOT NULL,
  `QtdPaginas` int(11) NOT NULL,
  `Preco` double NOT NULL,
  `Disponibilidade` tinyint(1) NOT NULL DEFAULT 0,
  `DataDeCriacao` datetime NOT NULL DEFAULT current_timestamp(),
  `DataDeEdicao` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`Id`, `Nome`, `Autor`, `QtdPaginas`, `Preco`, `Disponibilidade`, `DataDeCriacao`, `DataDeEdicao`) VALUES
(1, 'Arte da Guerra', 'Sun Tzu', 120, 24, 1, '2020-10-27 20:50:41', '2020-10-28 13:05:28'),
(2, 'Revolução dos Bichos', 'George Orwell', 84, 54, 1, '2020-10-27 20:52:03', '2020-10-28 17:02:07'),
(3, '1984', 'George Orwell', 161, 145.99, 0, '2020-10-27 20:55:06', '2020-10-29 12:56:28'),
(4, 'O Guia do Mochileiro das Galáxias', 'Douglas Adams', 240, 67, 0, '2020-10-28 12:31:11', '2020-10-28 13:09:29');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
