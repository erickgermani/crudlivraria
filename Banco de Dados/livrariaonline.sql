-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 28-Out-2020 às 23:38
-- Versão do servidor: 5.7.17
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `livrariaonline`
--

create database livrariaonline;
use livrariaonline;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Autor` varchar(30) NOT NULL,
  `qtdpaginas` int(11) NOT NULL,
  `Preco` double NOT NULL,
  `Disponibilidade` tinyint(1) NOT NULL DEFAULT '0',
  `DataDeCriacao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DataDeEdicao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`Id`, `Nome`, `Autor`, `qtdpaginas`, `Preco`, `Disponibilidade`, `DataDeCriacao`, `DataDeEdicao`) VALUES
(1, 'Arte da Guerra', 'Sun Tzu', 120, 24, 1, '2020-10-27 20:50:41', '2020-10-28 13:05:28'),
(2, 'RevoluÃ§Ã£o dos Bichos', 'George Orwell', 84, 54, 1, '2020-10-27 20:52:03', '2020-10-28 17:02:07'),
(3, '1984', 'George Orwell', 161, 145.99, 1, '2020-10-27 20:55:06', '2020-10-28 19:21:48'),
(4, 'O Guia do Mochileiro das GalÃ¡xias', 'Douglas Adams', 240, 67, 1, '2020-10-28 12:31:11', '2020-10-28 13:09:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `livro`
--
ALTER TABLE `livro`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
