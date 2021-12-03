-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 04:16 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survei_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `id_responden` int(11) NOT NULL,
  `pernah_dengar` tinyint(1) NOT NULL,
  `dengar_dimana` varchar(255) NOT NULL,
  `popularitas` int(11) NOT NULL,
  `sentimen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `responden`
--

CREATE TABLE `responden` (
  `id_responden` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_responden` (`id_responden`);

--
-- Indexes for table `responden`
--
ALTER TABLE `responden`
  ADD PRIMARY KEY (`id_responden`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `responden`
--
ALTER TABLE `responden`
  MODIFY `id_responden` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_responden`) REFERENCES `responden` (`id_responden`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
