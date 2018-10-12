-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Out-2018 às 22:28
-- Versão do servidor: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sgm`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbmembros`
--

CREATE TABLE `tbmembros` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `comentarios` mediumtext,
  `usuario` varchar(30) NOT NULL,
  `senha` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbmembros`
--

INSERT INTO `tbmembros` (`id`, `nome`, `email`, `telefone`, `comentarios`, `usuario`, `senha`) VALUES
(67, 'Junior', 'junior@hotmail.com', '(21)97530-9167', 'dasdasdasdas', '', ''),
(68, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(69, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(70, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(71, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(72, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(73, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(74, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(75, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(76, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(77, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(78, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(79, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(80, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(81, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(82, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(83, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(84, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(85, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(86, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(87, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(88, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(89, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(90, 'Junior', 'junior@hotmail.com', '(21)97530-9167', '', '', ''),
(91, 'Antonio', 'antonio@antonio.com.br', '1111', 'Bom dia, vai tomar no cu', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbmembros`
--
ALTER TABLE `tbmembros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbmembros`
--
ALTER TABLE `tbmembros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
