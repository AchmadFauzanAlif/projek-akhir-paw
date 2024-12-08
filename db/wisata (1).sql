-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2024 at 06:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_tiket`
--

CREATE TABLE `detail_tiket` (
  `id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `pembayaran_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_tiket`
--

INSERT INTO `detail_tiket` (`id`, `transaksi_id`, `nama_pelanggan`, `telp`, `pembayaran_id`) VALUES
(1, 16, 'wahyudi', '9999', 1),
(2, 16, 'rafli', '8888', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_kelamin` enum('L','P') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `user_id`, `nama`, `jenis_kelamin`, `telp`, `alamat`) VALUES
(6, 1, 'dicky pras', 'L', '081234567891', 'Surabaya'),
(7, 2, 'Rafli', 'L', '08123456788', 'Bangkalan'),
(8, 5, 'Fitrah', 'L', '085924854545', 'Sumenep');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int NOT NULL,
  `pembarayan` enum('dana','gopay','bni','bri','bca','mandiri') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nopol_kendaraan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `total_harga` int NOT NULL,
  `pemesanan_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `pembarayan`, `nopol_kendaraan`, `total_harga`, `pemesanan_id`) VALUES
(4, 'dana', '0', 110000, 3),
(5, 'bri', 'M 3793 TM, M 3639 TM', 1250000, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id` int NOT NULL,
  `jumlah_tiket` int NOT NULL,
  `waktu_transaksi` date NOT NULL,
  `tipe_tiket` enum('Normal','VIP','VVIP','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pelanggan_id` int NOT NULL,
  `status_pembayaran` enum('Pending','Sukses') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id`, `jumlah_tiket`, `waktu_transaksi`, `tipe_tiket`, `pelanggan_id`, `status_pembayaran`) VALUES
(3, 1, '2024-12-04', 'Normal', 6, 'Sukses'),
(4, 5, '2024-12-04', 'Normal', 6, 'Pending'),
(5, 5, '2024-12-04', 'VIP', 6, 'Sukses'),
(6, 4, '2024-12-05', 'VVIP', 6, 'Pending'),
(14, 2, '2024-01-10', 'VIP', 7, 'Sukses'),
(15, 3, '2024-02-14', 'Normal', 6, 'Sukses'),
(16, 2, '2024-12-09', 'VIP', 6, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `status pemesanan`
--

CREATE TABLE `status pemesanan` (
  `id` int NOT NULL,
  `pelanggan_id` int NOT NULL,
  `telp` int NOT NULL,
  `tanggal_booking` date NOT NULL,
  `tipe_tiket` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `level`) VALUES
(1, 'dicky', 'password', 2),
(2, 'rafli', 'password', 2),
(5, 'fitrah', 'password', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_tiket`
--
ALTER TABLE `detail_tiket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaksi_id` (`transaksi_id`),
  ADD KEY `pembayaran_id` (`pembayaran_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemesanan_pembayaran` (`pemesanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `status pemesanan`
--
ALTER TABLE `status pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_tiket`
--
ALTER TABLE `detail_tiket`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `status pemesanan`
--
ALTER TABLE `status pemesanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_tiket`
--
ALTER TABLE `detail_tiket`
  ADD CONSTRAINT `detail_tiket_ibfk_2` FOREIGN KEY (`transaksi_id`) REFERENCES `pemesanan` (`id`);

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `fk_pemesanan_pembayaran` FOREIGN KEY (`pemesanan_id`) REFERENCES `pemesanan` (`id`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
