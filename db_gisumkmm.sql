-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 09:43 AM
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
-- Database: `db_gisumkm`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_bukutamu`
--

CREATE TABLE `tb_bukutamu` (
  `id_bukutamu` int(10) NOT NULL,
  `nama` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_events`
--

CREATE TABLE `tb_events` (
  `id_event` int(10) NOT NULL,
  `nama_event` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `tgl_posting` timestamp NOT NULL DEFAULT current_timestamp(),
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_events`
--

INSERT INTO `tb_events` (`id_event`, `nama_event`, `deskripsi`, `alamat`, `tgl_mulai`, `tgl_selesai`, `tgl_posting`, `foto`) VALUES
(1, 'bangsal menggawe', 'hh', 'gang walet jaln senggigi', '2025-05-03 15:25:00', '2029-06-03 15:25:00', '2025-05-02 16:00:00', 'Activity Diagram Penjualan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_umkm`
--

CREATE TABLE `tb_kategori_umkm` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `icon` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kategori_umkm`
--

INSERT INTO `tb_kategori_umkm` (`id_kategori`, `nama_kategori`, `icon`) VALUES
(1, 'kuliner', 'umaat logo.png'),
(5, 'kiosh', 'WhatsApp Image 2024-12-03 at 06.13.42.jpeg'),
(6, 'pakaian', 'umaat logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_marking`
--

CREATE TABLE `tb_marking` (
  `id_marking` int(10) NOT NULL,
  `latitude` varchar(150) NOT NULL,
  `longitude` varchar(150) NOT NULL,
  `status` enum('aktif','pending') NOT NULL DEFAULT 'aktif',
  `id_umkm` int(10) NOT NULL,
  `id_user` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_marking`
--

INSERT INTO `tb_marking` (`id_marking`, `latitude`, `longitude`, `status`, `id_umkm`, `id_user`) VALUES
(1, '-8.40494461964932', '116.10308647155763', 'aktif', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_umkm`
--

CREATE TABLE `tb_umkm` (
  `id_umkm` int(10) NOT NULL,
  `nama_umkm` varchar(100) NOT NULL,
  `nama_pemilik` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `deskripsi` text NOT NULL,
  `kontak` varchar(50) DEFAULT NULL,
  `id_user` int(10) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_umkm`
--

INSERT INTO `tb_umkm` (`id_umkm`, `nama_umkm`, `nama_pemilik`, `alamat`, `deskripsi`, `kontak`, `id_user`, `id_kategori`, `foto`) VALUES
(1, 'es boba', 'kaspi', 'gang walet jaln senggigi', 'baru berjalan', '0987877', 1, 1, 'umaat logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `status` enum('aktif','pending') NOT NULL DEFAULT 'aktif',
  `gambar` varchar(100) DEFAULT NULL,
  `jenis` enum('admin','member') NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama_user`, `alamat`, `email`, `username`, `password`, `jenis_kelamin`, `status`, `gambar`, `jenis`) VALUES
(1, 'Admin Utama', 'Jl. Utama No.1', 'admin@example.com', 'admin', 'admin123', 'Laki-laki', 'aktif', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_bukutamu`
--
ALTER TABLE `tb_bukutamu`
  ADD PRIMARY KEY (`id_bukutamu`);

--
-- Indexes for table `tb_events`
--
ALTER TABLE `tb_events`
  ADD PRIMARY KEY (`id_event`);

--
-- Indexes for table `tb_kategori_umkm`
--
ALTER TABLE `tb_kategori_umkm`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_marking`
--
ALTER TABLE `tb_marking`
  ADD PRIMARY KEY (`id_marking`),
  ADD KEY `id_umkm` (`id_umkm`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD PRIMARY KEY (`id_umkm`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kategori` (`id_kategori`) USING BTREE;

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_bukutamu`
--
ALTER TABLE `tb_bukutamu`
  MODIFY `id_bukutamu` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_events`
--
ALTER TABLE `tb_events`
  MODIFY `id_event` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_kategori_umkm`
--
ALTER TABLE `tb_kategori_umkm`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_marking`
--
ALTER TABLE `tb_marking`
  MODIFY `id_marking` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  MODIFY `id_umkm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_marking`
--
ALTER TABLE `tb_marking`
  ADD CONSTRAINT `fk_marking_umkm` FOREIGN KEY (`id_umkm`) REFERENCES `tb_umkm` (`id_umkm`),
  ADD CONSTRAINT `fk_marking_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);

--
-- Constraints for table `tb_umkm`
--
ALTER TABLE `tb_umkm`
  ADD CONSTRAINT `fk_umkm_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `tb_kategori_umkm` (`id_kategori`),
  ADD CONSTRAINT `fk_umkm_user` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
