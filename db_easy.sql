-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Out-2017 às 05:14
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_easy`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `email`, `senha`, `nivel`) VALUES
(1, 'admin@email.com', '21232f297a57a5a743894a0e4a801fc3', 3),
(2, 'leo@email.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(4, 'rafael@email.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(5, 'usuario@email.com', 'c4ca4238a0b923820dcc509a6f75849b', 1),
(6, 'rodrigo@cotemig.com.br', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(15, 'teste@email', 'c4ca4238a0b923820dcc509a6f75849b', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista`
--

CREATE TABLE `lista` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `produtos_codigo` int(11) NOT NULL,
  `quantidade` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `preco` double UNSIGNED NOT NULL,
  `datavalidade` date DEFAULT NULL,
  `foto` varchar(20) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `nome`, `categoria`, `preco`, `datavalidade`, `foto`) VALUES
(8, 'Coca cola', 'Bebida', 8, '2017-08-02', 'coca.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `supermercados`
--

CREATE TABLE `supermercados` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cnpj` varchar(14) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `numero` bigint(20) UNSIGNED NOT NULL,
  `cep` int(8) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `telefone` bigint(20) NOT NULL,
  `foto` varchar(20) NOT NULL DEFAULT 'default.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `supermercados`
--

INSERT INTO `supermercados` (`id`, `nome`, `cnpj`, `logradouro`, `bairro`, `numero`, `cep`, `cidade`, `estado`, `telefone`, `foto`) VALUES
(1, 'EPA', '12345678901234', 'R. Joaquim Nabuco', 'Nova Suissa', 0, 30460040, 'Belo Horizonte', 'MG', 3133715480, 'default.jpg'),
(2, 'Super Nosso', '12345678901234', 'Av. Herï¿½clito Mourï¿½o de Miranda', 'Castelo', 0, 31330142, 'Belo Horizonte', 'MG', 3133593253, 'default.jpg'),
(4, 'BH', '11111', 'ddd', 'oooo', 11, 11111, 'ooooo', 'mg', 1111111, 'coca.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `codigo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `datanascimento` date NOT NULL,
  `telefone` int(13) NOT NULL,
  `cep` int(8) NOT NULL,
  `logradouro` varchar(255) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `numero` bigint(20) UNSIGNED NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` char(2) NOT NULL,
  `id_cadastro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`codigo`, `nome`, `cpf`, `datanascimento`, `telefone`, `cep`, `logradouro`, `bairro`, `numero`, `cidade`, `estado`, `id_cadastro`) VALUES
(2, 'Rafael GuimarÃ£es', '14884656652', '1999-07-25', 2147483647, 30421270, 'Rua JoÃ£o Caetano', 'Nova SuÃ­ssa', 0, 'Belo Horizonte', 'MG', 4),
(3, 'Rodrigo', '11111111', '1111-11-11', 0, 0, 'aa', 'aa', 0, 'aa', 'aa', 5),
(7, 'Arthur', '3231231', '1996-12-24', 12323, 123123, 'casa', 'bairro', 11, 'cidade', 'MG', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lista`
--
ALTER TABLE `lista`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produtos_codigo` (`produtos_codigo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`codigo`);

--
-- Indexes for table `supermercados`
--
ALTER TABLE `supermercados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codigo`),
  ADD KEY `id_cadastro` (`id_cadastro`),
  ADD KEY `id_cadastro_2` (`id_cadastro`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `lista`
--
ALTER TABLE `lista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `supermercados`
--
ALTER TABLE `supermercados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `lista`
--
ALTER TABLE `lista`
  ADD CONSTRAINT `id_usuario_lista` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lista_ibfk_1` FOREIGN KEY (`produtos_codigo`) REFERENCES `produtos` (`codigo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `id_usuario_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
