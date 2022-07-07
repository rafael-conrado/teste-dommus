-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Jul-2022 às 15:23
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `teste_dommus`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `enterprises`
--

CREATE TABLE `enterprises` (
  `id` int(11) NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `localization` varchar(120) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `delivery_forecast` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `blocs` int(11) NOT NULL,
  `units_per_bloc` int(11) NOT NULL,
  `unit_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enterprise_units`
--

CREATE TABLE `enterprise_units` (
  `id` int(11) NOT NULL,
  `bloc` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `value` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `enterprise_id` int(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `enterprises`
--
ALTER TABLE `enterprises`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `enterprise_units`
--
ALTER TABLE `enterprise_units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `enterprises`
--
ALTER TABLE `enterprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enterprise_units`
--
ALTER TABLE `enterprise_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
