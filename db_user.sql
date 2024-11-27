-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 06:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_user`
--

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `resto_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `resto_id`, `nama`, `harga`, `foto`) VALUES
(5, 5, 'Pahe 1', 20000, 'menuImg/Screenshot 2023-03-12 192005.png'),
(6, 5, 'Pahe 2', 24000, 'menuImg/Screenshot 2023-03-12 192014.png');

-- --------------------------------------------------------

--
-- Table structure for table `resto`
--

CREATE TABLE `resto` (
  `id` int(11) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `min_price` int(11) NOT NULL,
  `max_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resto`
--

INSERT INTO `resto` (`id`, `added_by`, `nama`, `alamat`, `foto`, `min_price`, `max_price`) VALUES
(5, 'yogi', 'Oti Fried Chicken', 'jalan diponegoro nomoer sekian', 'image/Screenshot 2023-03-15 212813.png', 15000, 30000);

-- --------------------------------------------------------

--
-- Table structure for table `simpan_resto`
--

CREATE TABLE `simpan_resto` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `resto_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_mitra` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_mitra`) VALUES
(1, 'yogi', '$2y$10$vTYkMzbz13j5q48EcxwD4e.3IvNcvplvs28HCESvAoUCfDJN/jQLu', 1),
(2, 'mael', '$2y$10$Ap17rf8OTbbJvJ6qKqV1TeYWHEh66IhJxuxHhcJbdtSbi4uLf4kmu', 1),
(3, 'adit', '$2y$10$ZVwOejRx61rVSKqwvZGXt.bP45Xx/Nm5FyIekI5GttRBc4WqhXqja', 0),
(4, 'cia', '$2y$10$zNnxTE9vBncli5IM9/K7teFMFKUVgGc445AKoRNsm4adfkxrMhgHG', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resto_id` (`resto_id`);

--
-- Indexes for table `resto`
--
ALTER TABLE `resto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `added_by` (`added_by`),
  ADD KEY `nama` (`nama`),
  ADD KEY `username` (`added_by`);

--
-- Indexes for table `simpan_resto`
--
ALTER TABLE `simpan_resto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`),
  ADD KEY `resto_id` (`resto_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `resto`
--
ALTER TABLE `resto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `simpan_resto`
--
ALTER TABLE `simpan_resto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `menu_ibfk_1` FOREIGN KEY (`resto_id`) REFERENCES `resto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `resto`
--
ALTER TABLE `resto`
  ADD CONSTRAINT `resto_ibfk_1` FOREIGN KEY (`added_by`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `simpan_resto`
--
ALTER TABLE `simpan_resto`
  ADD CONSTRAINT `simpan_resto_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `simpan_resto_ibfk_2` FOREIGN KEY (`resto_id`) REFERENCES `resto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
