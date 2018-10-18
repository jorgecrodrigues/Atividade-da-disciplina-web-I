-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 18/10/2018 às 07:31
-- Versão do servidor: 5.7.23-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `web`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `coordinators`
--

CREATE TABLE `coordinators` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `coordinators`
--

INSERT INTO `coordinators` (`id`, `name`) VALUES
(1, 'Jorge Rodrigues'),
(2, 'Jivago Medeiros'),
(3, 'Itacir Cabral');

-- --------------------------------------------------------

--
-- Estrutura para tabela `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `coordinator_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `begin` datetime NOT NULL,
  `end` datetime NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `courses`
--

INSERT INTO `courses` (`id`, `coordinator_id`, `title`, `description`, `address`, `begin`, `end`, `about`) VALUES
(1, 2, 'Minicurso 1', 'Descrição do minicurso 1', 'Local do minicurso 1', '2018-10-18 07:28:34', '2018-10-18 08:00:00', 'Nulla volutpat odio lacus, eget congue arcu aliquet eu. Maecenas sagittis lorem nunc, nec condimentum nisl blandit vel. Suspendisse dapibus metus et tempus consequat. Aliquam nec justo tincidunt, gravida quam a, accumsan velit. Proin mauris magna, laoreet ac dui eget, lobortis ultricies quam. '),
(2, 1, 'Minicurso 2', 'Descrição do minicurso 2', 'Local do minicurso', '2018-10-31 08:00:00', '2018-10-31 12:00:00', 'Praesent quis nibh non erat dictum malesuada a quis neque. Nullam facilisis condimentum velit a fermentum. Quisque non eleifend leo. Aenean faucibus, lacus non pharetra gravida, purus leo cursus turpis, sit amet tristique est est vitae purus. Aenean mauris elit, volutpat in elementum sit amet, aliquet eu nisl. Suspendisse potenti. Sed eu quam eget eros lobortis blandit at quis nibh. Nam blandit turpis et nibh iaculis, ut luctus turpis ullamcorper. Vivamus semper ante nisl, in finibus purus cursus ac. Integer dictum nibh egestas mauris sagittis pretium. Cras consectetur orci nec mi venenatis pharetra eget vel nisi. Fusce dignissim leo ac mauris pellentesque consequat. Morbi eu nisi fermentum, semper mauris sit amet, finibus massa. Nulla lacinia risus quam, vitae pharetra purus molestie a. Praesent ultrices tincidunt neque in pellentesque.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Jorge Rodrigues', 'jorgerodrigues9@outlook.com', '202cb962ac59075b964b07152d234b70');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `coordinators`
--
ALTER TABLE `coordinators`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coordinator` (`coordinator_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `coordinators`
--
ALTER TABLE `coordinators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `coordinator` FOREIGN KEY (`coordinator_id`) REFERENCES `coordinators` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
