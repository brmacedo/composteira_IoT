-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Mar-2021 às 00:57
-- Versão do servidor: 10.4.15-MariaDB
-- versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u952250523_alimentador`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `composteira_configuracao`
--

CREATE TABLE `composteira_configuracao` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo_exibir` int(11) NOT NULL COMMENT '2 para exibir por range de data e 1 para exibir os x últimos valores',
  `timestamp_inicio` timestamp NULL DEFAULT NULL,
  `timestamp_fim` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `valores_max_temperatura` int(11) NOT NULL,
  `valores_max_umidade` int(11) NOT NULL,
  `valores_max_pressao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `composteira_configuracao`
--
ALTER TABLE `composteira_configuracao`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `composteira_configuracao`
--
ALTER TABLE `composteira_configuracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
