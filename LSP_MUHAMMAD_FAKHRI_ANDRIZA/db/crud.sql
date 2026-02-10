-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2026 at 08:51 AM
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
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `tp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `password`, `tp`, `alamat`, `role`) VALUES
(7, 'admin', '$2y$10$Dm2BFuROjxzmqMucdOEspOoaK5DYE0GFuVEStgrr0ZLm0gCB7B.G6', NULL, NULL, 'administrator'),
(9, 'user1', '$2y$10$BKwNIfH/SeeeRcBWTmIl1OJOJ65ky5fLeO8JkmTx56JDVE0aQnBDe', NULL, NULL, 'pembeli'),
(10, 'user2', '$2y$10$R3w.wyjsryykI4EAs8q1De.rHPYycIOiK7JSzOSbDzELyo5q2vXjy', NULL, NULL, 'pembeli'),
(12, 'petugas', '$2y$10$.vhykdnVg07secMlcvwtUesn8.mIXKUxna5VWjn7Ua1cJKha/PVOO', NULL, NULL, 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `id` int(11) NOT NULL,
  `penjualanid` int(11) NOT NULL,
  `produkid` int(11) NOT NULL,
  `jumlahproduk` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `namaproduk` varchar(100) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `waktu` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`id`, `penjualanid`, `produkid`, `jumlahproduk`, `subtotal`, `namaproduk`, `harga`, `waktu`) VALUES
(67, 71, 16, 5, 22500000, NULL, NULL, NULL),
(68, 72, 17, 2, 14000000, NULL, NULL, NULL),
(69, 73, 18, 3, 3300000, NULL, NULL, NULL),
(70, 74, 19, 2, 8000000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `idakun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `idakun`) VALUES
(3, 7),
(5, 9),
(6, 10),
(8, 12);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` int(11) NOT NULL,
  `tanggalpenjualan` date DEFAULT NULL,
  `totalharga` decimal(10,0) DEFAULT NULL,
  `pelangganid` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `tanggalpenjualan`, `totalharga`, `pelangganid`, `created_at`) VALUES
(11, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(12, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(13, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(14, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(15, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(16, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(17, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(18, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(19, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(20, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(21, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(22, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(23, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(24, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(25, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(26, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(27, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(28, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(29, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(30, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(31, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(32, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(33, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(34, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(35, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(36, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(37, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(38, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(39, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(40, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(41, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(42, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(43, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(44, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(45, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(46, '2026-02-09', 10000, 3, '2026-02-10 14:19:08'),
(58, '2026-02-10', 36000000, 5, '2026-02-10 14:19:08'),
(59, '2026-02-10', 36000000, 5, '2026-02-10 14:19:08'),
(60, '2026-02-10', 1200000, 5, '2026-02-10 14:19:08'),
(61, '2026-02-10', 4100000, 5, '2026-02-10 14:19:08'),
(62, '2026-02-10', 12000000, 6, '2026-02-10 14:19:08'),
(63, '2026-02-10', 54000000, 6, '2026-02-10 14:19:08'),
(64, '2026-02-10', 2400000, 6, '2026-02-10 14:19:08'),
(65, '2026-02-10', 4100000, 6, '2026-02-10 14:19:08'),
(70, '2026-02-10', 4500000, 5, '2026-02-10 14:19:08'),
(71, '2026-02-10', 22500000, 5, '2026-02-10 14:26:27'),
(72, '2026-02-10', 14000000, 5, '2026-02-10 14:26:32'),
(73, '2026-02-10', 3300000, 5, '2026-02-10 14:26:36'),
(74, '2026-02-10', 8000000, 5, '2026-02-10 14:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `namaproduk` varchar(255) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `namaproduk`, `harga`, `stok`) VALUES
(16, 'hp', 4500000, 394),
(17, 'laptop', 7000000, 348),
(18, 'keyboard + mouse', 1100000, 597),
(19, 'monitor', 4000000, 348);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualanid` (`penjualanid`),
  ADD KEY `produkid` (`produkid`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idakun` (`idakun`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pelangganid` (`pelangganid`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_ibfk_1` FOREIGN KEY (`penjualanid`) REFERENCES `penjualan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD CONSTRAINT `pelanggan_ibfk_1` FOREIGN KEY (`idakun`) REFERENCES `akun` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_ibfk_1` FOREIGN KEY (`pelangganid`) REFERENCES `pelanggan` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
