-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2019 at 02:58 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs518`
--

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `cat` varchar(256) NOT NULL,
  `plat` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `name`, `cat`, `plat`) VALUES
(1, 'Build-A-Lot', 'Simulation', 'windows'),
(2, 'Runaway, A Road Adventure', 'Adventure', 'windows'),
(3, 'Virtual Villagers: A New Home', 'Casual;Simulation', 'windows'),
(4, 'BRAINPIPE: A Plunge to Unhumanity', 'Casual;Indie', 'windows;mac'),
(5, 'A Game of Thrones - Genesis', 'Strategy', 'windows'),
(6, 'Runaway: A Twist of Fate', 'Adventure', 'windows'),
(7, 'A Stroke of Fate: Operation Valkyrie', 'Adventure', 'windows'),
(8, 'AaAaAA!!! - A Reckless Disregard for Gravity', 'Action;Indie;Sports', 'windows'),
(9, 'Discovery! A Seek and Find Adventure', 'Casual', 'windows'),
(10, 'TriJinx: A Kristine Kross Mystery™', 'Casual', 'windows;mac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
