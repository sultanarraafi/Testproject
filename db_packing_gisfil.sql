-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2026 at 06:18 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_packing_gisfil`
--

-- --------------------------------------------------------

--
-- Table structure for table `packing`
--

CREATE TABLE `packing` (
  `id` int NOT NULL,
  `nomor_box` varchar(30) NOT NULL,
  `mesin` varchar(10) NOT NULL,
  `no_lot` varchar(50) DEFAULT NULL,
  `berat_kategori` varchar(10) NOT NULL,
  `jumlah_cone` int NOT NULL,
  `berat_timbang` decimal(10,2) NOT NULL,
  `operator` varchar(50) NOT NULL,
  `tanggal_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `packing`
--

INSERT INTO `packing` (`id`, `nomor_box`, `mesin`, `no_lot`, `berat_kategori`, `jumlah_cone`, `berat_timbang`, `operator`, `tanggal_input`) VALUES
(1, 'GSF-20260213-001', '5A', NULL, '3.x kg', 8, '2650.00', 'SA', '2026-02-13 02:42:28'),
(2, 'GSF-20260213-002', '1A', NULL, '3.x kg', 9, '292.00', 'sa', '2026-02-13 02:43:13'),
(3, 'GSF-20260213-003', '1A', NULL, '3.x kg', 9, '264.00', 'sa', '2026-02-13 02:44:19'),
(4, 'GSF-20260213-004', '6A', NULL, '3.x kg', 8, '26.50', 'sa', '2026-02-13 02:47:04'),
(5, 'GSF-20260213-005', '6A', 'ws 11622', '3.x kg', 8, '28.60', 'sa', '2026-02-13 03:00:44'),
(6, 'GSF-20260213-006', '15A', 'T 30167', '5.x kg', 6, '27.40', 'SA', '2026-02-13 15:59:25'),
(17, 'GSF-20260218-001', '1A', 'ED 30759', '5.x kg', 6, '31.20', 'Sultan Arraafi', '2026-02-17 17:25:27'),
(18, 'GSF-20260218-002', '1A', 'ED 30759', '1.x kg', 15, '22.70', 'Sultan Arraafi', '2026-02-17 17:32:06'),
(19, 'GSF-20260218-003', '5A', 'ES 13828', '3.x kg', 8, '25.80', 'Sultan Arraafi', '2026-02-17 17:32:49'),
(20, 'GSF-20260218-004', '2A', 'ES 18878', '3.x kg', 8, '28.10', 'Sultan Arraafi', '2026-02-17 17:33:15'),
(21, 'GSF-20260218-005', '5A', 'ES 13828', '2.x kg', 12, '26.50', 'Sultan Arraafi', '2026-02-17 17:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'operator', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `packing`
--
ALTER TABLE `packing`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_box` (`nomor_box`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `packing`
--
ALTER TABLE `packing`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
