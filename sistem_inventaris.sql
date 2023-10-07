-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 08, 2023 at 12:14 AM
-- Server version: 8.0.33-0ubuntu0.20.04.4
-- PHP Version: 8.1.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_inventaris`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int NOT NULL,
  `kode_barang` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `kategori` enum('Kendaraan','Perlengkapan') COLLATE utf8mb4_general_ci NOT NULL,
  `id_kendaraan` int DEFAULT NULL,
  `id_perlengkapan` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int NOT NULL,
  `no_polisi` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `merek` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `type` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun_pembuatan` int NOT NULL,
  `tanggal_register` date NOT NULL,
  `no_rangka` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `no_mesin` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `no_bpkb` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `cara_perolehan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_perolehan` int NOT NULL,
  `penempatan` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `kondisi` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('Barang Lama','Penerimaan Barang') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perlengkapan`
--

CREATE TABLE `perlengkapan` (
  `id_perlengkapan` int NOT NULL,
  `nama_perlengkapan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_register` date NOT NULL,
  `jumlah` int NOT NULL,
  `status` enum('Barang Lama','Penerimaan Barang') COLLATE utf8mb4_general_ci NOT NULL,
  `satuan` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_perolehan` int NOT NULL,
  `cara_perolehan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `penempatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `level` enum('admin','camat') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`) VALUES
(1, 'Admin', 'admin', '$2y$10$eU03vDt/Lo3mxdjbi7OFz.rCY17w96ZeqTWsPsg1tOWX39N7bpcb2', 'admin'),
(36, 'asdfasd', 'fasdf', '$2y$10$E4oIWDl1ehroqYycuV7sLucJS8e6pi25IV.ztSChJA8/jnAuQl6OG', 'admin'),
(38, 'sdfasda', 'asdfasd', '$2y$10$dp0AfOpPeVe/Xu7IXtpW4uMb10n8o8bWbgPohdWyYWsMB6qyUiLFy', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`),
  ADD KEY `kendaraan_id` (`id_kendaraan`),
  ADD KEY `perlengkapan_id` (`id_perlengkapan`),
  ADD KEY `kendaraan_id_2` (`id_kendaraan`),
  ADD KEY `perlengkapan_id_2` (`id_perlengkapan`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`);

--
-- Indexes for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  ADD PRIMARY KEY (`id_perlengkapan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  MODIFY `id_perlengkapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kendaraan`) REFERENCES `kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_perlengkapan`) REFERENCES `perlengkapan` (`id_perlengkapan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
