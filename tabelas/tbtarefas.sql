-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 12-Out-2018 às 22:29
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
-- Estrutura da tabela `tbtarefas`
--

CREATE TABLE `tbtarefas` (
  `id` int(11) NOT NULL,
  `idmembro` int(11) DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `descriçao` varchar(50000) DEFAULT NULL,
  `situaçao` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbtarefas`
--

INSERT INTO `tbtarefas` (`id`, `idmembro`, `titulo`, `descriçao`, `situaçao`) VALUES
(5, 65, 'das', 'dasdad', 'Pendente'),
(7, 65, 'dasdasd', 'dadasda', 'Pendente'),
(8, 65, 'dasdas', 'dasdasdas', 'Pendente'),
(9, 65, 'dasdasd', 'dasdas', 'Pendente'),
(10, 66, 'dasdwwwwwwwwwwwwwww1111111111111', 'asdasss111111111111', 'Pendente'),
(11, 66, 'tarefa do 66', 'sddd', 'Pendente'),
(12, 67, 'sdfsdf', 'fdsfsf', 'Pendente');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbtarefas`
--
ALTER TABLE `tbtarefas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbtarefas`
--
ALTER TABLE `tbtarefas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
