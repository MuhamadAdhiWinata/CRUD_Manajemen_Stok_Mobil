-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2024 at 06:41 PM
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
-- Database: `responsi`
--

-- --------------------------------------------------------

--
-- Table structure for table `stokmobil`
--

CREATE TABLE `stokmobil` (
  `id_mobil` int(11) NOT NULL,
  `merk_mobil` varchar(100) NOT NULL,
  `tipe_mobil` varchar(100) NOT NULL,
  `warna_mobil` varchar(50) NOT NULL,
  `gambar_mobil` varchar(255) DEFAULT NULL,
  `status_mobil` enum('terjual','masih ada') NOT NULL,
  `harga_mobil` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stokmobil`
--

INSERT INTO `stokmobil` (`id_mobil`, `merk_mobil`, `tipe_mobil`, `warna_mobil`, `gambar_mobil`, `status_mobil`, `harga_mobil`) VALUES
(15, 'Toyota', 'Avanza', 'Putih', 'avanza-jputih.jpg', 'masih ada', 200000000.00),
(18, 'Honda', 'Civic', 'Hitam', 'Civic Hitam.png', 'masih ada', 300000000.00),
(19, 'Suzuki', 'Ertiga', 'Merah', 'Ertiga Merah.png', 'masih ada', 120000000.00),
(21, 'Mitsubhisi', 'Xpander', 'Abu abu', 'xpander-abu abu.jpg', 'masih ada', 250000000.00),
(22, 'Nissan', 'March', 'Biru', 'march blue.png', 'masih ada', 120000000.00),
(23, 'Wuling', 'Almaz', 'Abu abu', 'Wuling Almaz.png', 'masih ada', 256000000.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `stokmobil`
--
ALTER TABLE `stokmobil`
  ADD PRIMARY KEY (`id_mobil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `stokmobil`
--
ALTER TABLE `stokmobil`
  MODIFY `id_mobil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
