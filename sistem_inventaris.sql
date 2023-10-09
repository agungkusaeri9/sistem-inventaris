-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2023 at 06:16 AM
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

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `kategori`, `id_kendaraan`, `id_perlengkapan`) VALUES
(6, 'BRG001', 'Kendaraan', 5, NULL),
(7, 'BRG002', 'Perlengkapan', NULL, 10),
(8, 'BRG004', 'Kendaraan', 7, NULL),
(9, 'BRG005', 'Perlengkapan', NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `barang_rusak`
--

CREATE TABLE `barang_rusak` (
  `id_barang_rusak` int NOT NULL,
  `id_barang` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_barang` int NOT NULL,
  `jenis_kerusakan` enum('Rusak Ringan','Rusak Sedang','Rusak Berat') COLLATE utf8mb4_general_ci NOT NULL,
  `status_rusak` enum('Barang Rusak','Barang Tidak Layak Pakai') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_rusak`
--

INSERT INTO `barang_rusak` (`id_barang_rusak`, `id_barang`, `tanggal`, `jumlah_barang`, `jenis_kerusakan`, `status_rusak`) VALUES
(9, 6, '2023-10-09', 5, 'Rusak Berat', 'Barang Rusak'),
(10, 6, '2023-10-08', 10, 'Rusak Berat', 'Barang Tidak Layak Pakai'),
(12, 7, '2023-10-08', 2, 'Rusak Sedang', 'Barang Rusak'),
(13, 7, '2023-10-06', 2, 'Rusak Ringan', 'Barang Tidak Layak Pakai');

-- --------------------------------------------------------

--
-- Table structure for table `barang_service`
--

CREATE TABLE `barang_service` (
  `id_barang_service` int NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_barang` int NOT NULL,
  `biaya_service` int NOT NULL,
  `keterangan` text COLLATE utf8mb4_general_ci NOT NULL,
  `id_barang` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_service`
--

INSERT INTO `barang_service` (`id_barang_service`, `tanggal`, `jumlah_barang`, `biaya_service`, `keterangan`, `id_barang`) VALUES
(1, '2023-10-12', 5, 1000001, 'sudah service ya ', 6),
(4, '2023-10-08', 2, 10000, 'rusak bagian aki', 7);

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
  `status` enum('Barang Lama','Penerimaan Barang') COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_dibuat` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_polisi`, `merek`, `type`, `tahun_pembuatan`, `tanggal_register`, `no_rangka`, `no_mesin`, `no_bpkb`, `cara_perolehan`, `harga_perolehan`, `penempatan`, `kondisi`, `status`, `tanggal_dibuat`) VALUES
(5, 'Culpa cumque quibus', 'Reiciendis eum sequi', 'Fuga Blanditiis aut', 84, '1992-11-15', 'Aliquam ullamco fugi', 'Quis labore sint lab', 'Non unde maiores dol', 'Veniam consequatur ', 90, 'Blanditiis ut iste e', 'Et ad voluptatem dol', 'Penerimaan Barang', '2023-10-09 21:05:25'),
(6, 'Maiores eos omnis ex', 'Et ex sunt sequi es', 'Magna quisquam in te', 33, '1970-04-24', 'In esse numquam prae', 'Omnis et autem culpa', 'Nulla sit dolorum o', 'Eos autem praesentiu', 16, 'Eiusmod Nam eiusmod ', 'Quibusdam nisi deser', 'Penerimaan Barang', '2023-10-09 21:05:45'),
(7, 'Eveniet mollitia co', 'Fugiat fuga Tempori', 'Omnis non quibusdam ', 4, '1985-10-24', 'Minima quia quae iru', 'Velit sed nobis et m', 'Sit iusto magnam par', 'Iure ex corporis qui', 59, 'Et dolore in volupta', 'Fugiat aut nostrud l', 'Penerimaan Barang', '2023-10-09 21:06:01');

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
  `penempatan` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `tanggal_dibuat` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perlengkapan`
--

INSERT INTO `perlengkapan` (`id_perlengkapan`, `nama_perlengkapan`, `tanggal_register`, `jumlah`, `status`, `satuan`, `harga_perolehan`, `cara_perolehan`, `penempatan`, `tanggal_dibuat`) VALUES
(10, 'Ut rerum amet itaqu', '2010-03-15', 84, 'Penerimaan Barang', 'Ab odit aliquam dolo', 33, 'Enim similique offic', 'Cillum ut consectetu', '2023-10-09 21:19:58'),
(11, 'Aliqua Sint ipsam d', '1994-01-24', 48, 'Penerimaan Barang', 'Molestiae voluptas a', 600000, 'Qui eum sed aute dig', 'In ipsam esse conse', '2023-10-09 21:21:31');

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
-- Indexes for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD PRIMARY KEY (`id_barang_rusak`),
  ADD KEY `id_barang` (`id_barang`);

--
-- Indexes for table `barang_service`
--
ALTER TABLE `barang_service`
  ADD PRIMARY KEY (`id_barang_service`),
  ADD KEY `id_barang` (`id_barang`);

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
  MODIFY `id_barang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  MODIFY `id_barang_rusak` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `barang_service`
--
ALTER TABLE `barang_service`
  MODIFY `id_barang_service` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `perlengkapan`
--
ALTER TABLE `perlengkapan`
  MODIFY `id_perlengkapan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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

--
-- Constraints for table `barang_rusak`
--
ALTER TABLE `barang_rusak`
  ADD CONSTRAINT `barang_rusak_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `barang_service`
--
ALTER TABLE `barang_service`
  ADD CONSTRAINT `barang_service_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
