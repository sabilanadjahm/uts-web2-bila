-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 03:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pmb`
--

-- --------------------------------------------------------

--
-- Table structure for table `biaya_pendaftaran`
--

CREATE TABLE `biaya_pendaftaran` (
  `id` int(11) NOT NULL,
  `tahun_pmb` year(4) NOT NULL,
  `nominal` int(11) NOT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biaya_pendaftaran`
--

INSERT INTO `biaya_pendaftaran` (`id`, `tahun_pmb`, `nominal`, `keterangan`, `updated_at`) VALUES
(1, '2025', 650000, 'gelombang pertama', '2025-04-23 04:10:18');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_tes`
--

CREATE TABLE `jadwal_tes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `jenis_tes` varchar(50) NOT NULL,
  `tanggal_tes` date NOT NULL,
  `jam_tes` time NOT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `nilai` decimal(5,2) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_tes`
--

INSERT INTO `jadwal_tes` (`id`, `username`, `jenis_tes`, `tanggal_tes`, `jam_tes`, `lokasi`, `nilai`, `keterangan`) VALUES
(1, 'bila06', 'Tulis', '2025-04-30', '08:00:00', 'Kampus', 90.00, 'Bagus!'),
(2, 'icha03', 'Wawancara', '2025-04-30', '11:00:00', 'Kampus', 89.00, 'Bagus!'),
(3, 'jihan03', 'Tulis', '2025-04-30', '07:30:00', 'Kampus', 95.00, 'Bagus!'),
(4, 'bili09', 'Tulis', '2025-04-30', '13:45:00', 'Kampus', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pendaftar`
--

CREATE TABLE `pendaftar` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `prodi` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `asal_sekolah` varchar(100) DEFAULT NULL,
  `tahun_lulus` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status_verifikasi` enum('belum','sudah') DEFAULT 'belum',
  `status_kelulusan` enum('Lulus','Tidak Lulus','Belum Ditetapkan') DEFAULT 'Belum Ditetapkan',
  `bukti_pembayaran` varchar(255) DEFAULT NULL,
  `status_pembayaran` enum('belum','sudah') DEFAULT 'belum'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pendaftar`
--

INSERT INTO `pendaftar` (`id`, `username`, `prodi`, `nama`, `whatsapp`, `asal_sekolah`, `tahun_lulus`, `created_at`, `status_verifikasi`, `status_kelulusan`, `bukti_pembayaran`, `status_pembayaran`) VALUES
(1, 'bila06', 'Teknik Informatika', 'Sabila Nadjah M', '0895339511146', 'SMAN 1 CICALENGKA', 2023, '2025-04-22 17:57:30', 'sudah', 'Lulus', NULL, 'belum'),
(2, 'icha03', 'Hukum', 'Saniyah Habibah M', '08965236589', 'SMAN 1 CICALENGKA', 2024, '2025-04-22 19:35:23', 'sudah', 'Lulus', NULL, 'belum'),
(3, 'jihan03', 'Sistem Informasi', 'Jihan Adilah', '087963173511', 'SMAN 1 CICALENGKA', 2025, '2025-04-23 01:18:01', 'sudah', 'Lulus', NULL, 'belum'),
(4, 'bili09', 'Akuntansi', 'Sabila Nadjah Maripah', '089678913791', 'SMAN 3 Bandung', 2023, '2025-04-23 01:43:14', 'sudah', 'Belum Ditetapkan', NULL, 'belum');

-- --------------------------------------------------------

--
-- Table structure for table `pengunjung`
--

CREATE TABLE `pengunjung` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `platform` varchar(20) DEFAULT NULL,
  `time_access` datetime DEFAULT NULL,
  `last_access` datetime DEFAULT NULL,
  `count_access` int(11) DEFAULT NULL,
  `count_clicks` int(11) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `periode_pendaftaran`
--

CREATE TABLE `periode_pendaftaran` (
  `id` int(11) NOT NULL,
  `tahun_pmb` year(4) DEFAULT NULL,
  `nama_gelombang` varchar(50) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_berakhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periode_pendaftaran`
--

INSERT INTO `periode_pendaftaran` (`id`, `tahun_pmb`, `nama_gelombang`, `tanggal_mulai`, `tanggal_berakhir`) VALUES
(1, '2025', 'Gelombang 1', '2025-04-01', '2025-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Petugas PMB','Kepala PMB','Keuangan','Sarana','Pimpinan','Operator Tes') DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `role`, `status`) VALUES
(1, 'Bila', 'bila64', '$2y$10$J7/GP1YGI.uAvvkhLhHP9.GRwltuWJPb7AKa2AAtRfWzuglTLdCmS', 'Kepala PMB', 'Aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biaya_pendaftaran`
--
ALTER TABLE `biaya_pendaftaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_tes`
--
ALTER TABLE `jadwal_tes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `pendaftar`
--
ALTER TABLE `pendaftar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `pengunjung`
--
ALTER TABLE `pengunjung`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `periode_pendaftaran`
--
ALTER TABLE `periode_pendaftaran`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `biaya_pendaftaran`
--
ALTER TABLE `biaya_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jadwal_tes`
--
ALTER TABLE `jadwal_tes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pendaftar`
--
ALTER TABLE `pendaftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengunjung`
--
ALTER TABLE `pengunjung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `periode_pendaftaran`
--
ALTER TABLE `periode_pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal_tes`
--
ALTER TABLE `jadwal_tes`
  ADD CONSTRAINT `jadwal_tes_ibfk_1` FOREIGN KEY (`username`) REFERENCES `pendaftar` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
