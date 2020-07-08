-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 20, 2020 at 12:12 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Progetto`
--

-- --------------------------------------------------------

--
-- Table structure for table `contatti`
--

CREATE TABLE `contatti` (
  `id` int(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `nascita` varchar(255) NOT NULL,
  `cap` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contatti`
--

INSERT INTO `contatti` (`id`, `nome`, `cognome`, `nascita`, `cap`, `email`) VALUES
(1, 'MARIO', 'ROSSI', '01/01/2000', '45543', 'mario.rossi@gmail.com'),
(2, 'MARIA', 'BIANCHI', '11/11/1999', '12345', 'm.bianchi@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `telefoni`
--

CREATE TABLE `telefoni` (
  `id` int(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `raccordo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `telefoni`
--

INSERT INTO `telefoni` (`id`, `tipo`, `numero`, `raccordo`) VALUES
(1, 'CASA', '1111111111', '1'),
(2, 'LAVORO', '121212121', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contatti`
--
ALTER TABLE `contatti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `telefoni`
--
ALTER TABLE `telefoni`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contatti`
--
ALTER TABLE `contatti`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `telefoni`
--
ALTER TABLE `telefoni`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
