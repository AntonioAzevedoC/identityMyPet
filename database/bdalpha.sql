-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 01:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdalpha`
--

-- --------------------------------------------------------

--
-- Table structure for table `fotospets`
--

CREATE TABLE `fotospets` (
  `idFoto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idPet` int(11) NOT NULL,
  `imagem` varchar(80) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fotospets`
--

INSERT INTO `fotospets` (`idFoto`, `idUsuario`, `idPet`, `imagem`, `data`) VALUES
(93, 41, 101, '6f72d314cb7bf18b8a9d33b3baf77501.jfif', '2023-10-12 20:48:10'),
(94, 41, 102, 'f40253767f9fd0907375c3f30b305726.jfif', '2023-10-12 20:48:15'),
(99, 42, 107, 'd055ee1c10a6c596f7d805d6f94d46cb.jpg', '2023-10-17 19:12:00'),
(101, 42, 109, '8e2021fe568b8211a7662e0b177337a8.jpg', '2023-10-17 19:23:28'),
(102, 42, 110, '7845a1740542184dd1336d07fcad571c.jpg', '2023-10-17 19:26:53'),
(103, 42, 111, '13ccacb816d9c1a16f4bae4abed68804.jpg', '2023-10-17 19:54:24'),
(104, 42, 112, '94828a14e70250709e48e0b47116ff16.jpg', '2023-10-17 19:52:16'),
(105, 42, 113, '4223f19dfd5b65442d654a6112218246.jpg', '2023-10-17 20:16:29'),
(106, 42, 115, '261cb54fde43f67c433ac73d25fe3aa1.jpeg', '2023-10-31 21:53:20');

-- --------------------------------------------------------

--
-- Table structure for table `fotosusuarios`
--

CREATE TABLE `fotosusuarios` (
  `idFoto` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `imagem` varchar(80) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fotosusuarios`
--

INSERT INTO `fotosusuarios` (`idFoto`, `idUsuario`, `imagem`, `data`) VALUES
(3, 41, '297a6cfcee33345cb626b2f95d5620b6.jfif', '2023-10-12 20:53:08'),
(4, 42, 'bca7138ae020b722e3ed4b9595a6dfe6.png', '2023-10-31 21:54:31'),
(5, 43, '7b77dee3f91bfd56bd532ef76ca06651.jfif', '2023-08-27 22:36:05'),
(6, 44, '94174b715270d9f0abdb26fe2d6fe576.jfif', '2023-08-27 22:36:55');

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `idPet` int(11) NOT NULL,
  `idUsuario` int(11) DEFAULT NULL,
  `nomeResponsavel` varchar(255) DEFAULT NULL,
  `telefoneResponsavel` varchar(20) DEFAULT NULL,
  `nomePet` varchar(255) DEFAULT NULL,
  `especie` varchar(50) DEFAULT NULL,
  `raca` varchar(50) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  `tamanho` varchar(20) DEFAULT NULL,
  `idade` varchar(20) DEFAULT NULL,
  `castrado` tinyint(1) DEFAULT NULL,
  `vermifugo` tinyint(1) DEFAULT NULL,
  `antipulgas` tinyint(1) DEFAULT NULL,
  `vacinaV8v10` tinyint(1) DEFAULT NULL,
  `vacinaAntirrabica` tinyint(1) DEFAULT NULL,
  `vacinaBronchiguard` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`idPet`, `idUsuario`, `nomeResponsavel`, `telefoneResponsavel`, `nomePet`, `especie`, `raca`, `sexo`, `tamanho`, `idade`, `castrado`, `vermifugo`, `antipulgas`, `vacinaV8v10`, `vacinaAntirrabica`, `vacinaBronchiguard`) VALUES
(107, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Hume', 'cachorro', 'Doges', 'm', 'grande', 'jovem', 1, 1, 1, 0, 1, 0),
(109, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Callista', 'gato', 'siberiano', 'f', 'pequeno', 'jovem', 1, 1, 1, 0, 1, 0),
(110, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Locke', 'cachorro', 'husky', 'm', 'medio', 'jovem', 1, 1, 1, 0, 1, 0),
(111, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Anne', 'cachorro', 'chow chow', 'f', 'medio', 'filhote', 1, 1, 1, 0, 1, 0),
(112, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Seneca', 'cachorro', 'dalmata', 'm', 'medio', 'filhote', 1, 1, 1, 0, 1, 0),
(113, 42, 'weriksonn wyllis', '(16) 99327 - 4138', 'Rose', 'cachorro', 'cocker spaniel', 'm', 'pequeno', 'filhote', 1, 1, 1, 0, 1, 0),
(115, 42, 'weriksonn wyllis', '(86) 72354 - 8123', 'kants', 'cachorro', 'vira lata', 'm', 'pequeno', 'filhote', 1, 1, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(5) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `idioma` varchar(10) NOT NULL,
  `darkMode` int(2) NOT NULL DEFAULT 1,
  `fonte` int(3) NOT NULL DEFAULT 100
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `nome`, `email`, `senha`, `idioma`, `darkMode`, `fonte`) VALUES
(41, 'antonio de azevedo cabreira', 'antonioazevedo@gmail.com', '64152dca77571da61a16e9c84f9604969bc03f28', 'fr-be', 2, 0),
(42, 'Weriksonn Wyllis Martinez de Oliveira', 'weriksuuwyllis@gmail.com', '64152dca77571da61a16e9c84f9604969bc03f28', 'pt-br', 1, 0),
(43, 'keyce layne', 'keycelayne@gmail.com', '64152dca77571da61a16e9c84f9604969bc03f28', 'en-us', 2, 100),
(44, 'joao vitor rodrugues guerra segundo', 'joaoguerra@gmail.com', '64152dca77571da61a16e9c84f9604969bc03f28', 'pt-br', 1, 125);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotospets`
--
ALTER TABLE `fotospets`
  ADD PRIMARY KEY (`idFoto`);

--
-- Indexes for table `fotosusuarios`
--
ALTER TABLE `fotosusuarios`
  ADD PRIMARY KEY (`idFoto`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`idPet`),
  ADD KEY `usuario_id` (`idUsuario`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fotospets`
--
ALTER TABLE `fotospets`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `fotosusuarios`
--
ALTER TABLE `fotosusuarios`
  MODIFY `idFoto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `idPet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `Pets_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
