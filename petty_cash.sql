-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2023 at 12:13 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `petty_cash`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id_area` int(11) NOT NULL,
  `area` varchar(50) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id_area`, `area`, `id_kota`, `created_at`, `updated_at`) VALUES
(1, 'Cidadap', 1, '2023-01-26 01:20:18', '2023-01-30 06:52:00'),
(2, 'Kuta', 2, '2023-01-26 01:20:27', '2023-01-30 06:52:12'),
(3, 'Tebet', 3, '2023-01-26 01:22:46', '2023-01-30 06:52:42');

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id_asset` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `id_data` int(11) DEFAULT NULL,
  `tipe` char(20) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id_asset`, `nama`, `id_data`, `tipe`, `id_user`, `created_at`, `updated_at`) VALUES
(1, '1675052611_7f2e30f23d3bfa623f32.jpg', 2, 'klaim', 1, '2023-01-30 04:23:31', '2023-01-30 04:23:31'),
(2, '1675052657_5545f9b809f1af076fb6.jpg', 3, 'klaim', 1, '2023-01-30 04:24:17', '2023-01-30 04:24:17'),
(3, '1675052696_d446697a1aa02a049598.jpg', 4, 'klaim', 1, '2023-01-30 04:24:56', '2023-01-30 04:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `kota` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `kota`, `created_at`, `updated_at`) VALUES
(1, 'Bandung', '2023-01-25 14:12:05', '2023-01-25 14:43:04'),
(2, 'Bali', '2023-01-25 14:12:08', '2023-01-25 14:43:28'),
(3, 'Jakarta', '2023-01-25 14:12:16', '2023-01-25 14:43:46');

-- --------------------------------------------------------

--
-- Table structure for table `petty_cash_group`
--

CREATE TABLE `petty_cash_group` (
  `id_petty_cash_group` int(11) NOT NULL,
  `petty_cash_group` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petty_cash_group`
--

INSERT INTO `petty_cash_group` (`id_petty_cash_group`, `petty_cash_group`, `created_at`, `updated_at`) VALUES
(1, 'Group Petty 1', '2023-01-26 11:52:06', '2023-01-26 04:02:06'),
(2, 'Perlengkapan Kantor', '2023-01-26 11:52:15', '2023-01-28 23:14:46'),
(3, 'Group Petty 3', '2023-01-26 03:58:52', '2023-01-26 03:58:52');

-- --------------------------------------------------------

--
-- Table structure for table `record_kas`
--

CREATE TABLE `record_kas` (
  `id_kas` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `sumber` varchar(50) DEFAULT NULL,
  `bukti_kas` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0:draft,1:publish',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_kas`
--

INSERT INTO `record_kas` (`id_kas`, `tanggal`, `jumlah`, `sumber`, `bukti_kas`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-01-01 00:00:00', '40000000', 'BCA', NULL, 1, 1, '2023-01-28 00:40:43', '2023-01-28 01:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `record_klaim`
--

CREATE TABLE `record_klaim` (
  `id_klaim` int(11) NOT NULL,
  `tanggal` datetime DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `id_site` int(11) DEFAULT NULL,
  `id_petty_cash_group` int(11) DEFAULT NULL,
  `id_user_petty_cash` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '{0: not rembust, 1: rembust}',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_klaim`
--

INSERT INTO `record_klaim` (`id_klaim`, `tanggal`, `total`, `id_site`, `id_petty_cash_group`, `id_user_petty_cash`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(1, '2023-01-20 15:23:01', '15000000', 1, 2, 1, 1, 0, '2023-01-27 15:23:40', '2023-01-27 15:23:41'),
(2, '2023-01-27 15:23:53', '1000000', 1, 2, 2, 1, 0, '2023-01-27 15:24:21', '2023-01-27 15:24:21'),
(3, '2023-01-30 00:00:00', '346000', 4, 2, 2, 1, 0, '2023-01-30 04:14:56', '2023-01-30 09:35:19'),
(4, '2023-01-30 00:00:00', '15000', 1, 2, 2, 1, 0, '2023-01-30 04:24:36', '2023-01-30 08:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `record_klaim_detail`
--

CREATE TABLE `record_klaim_detail` (
  `id_klaim_detail` int(11) NOT NULL,
  `id_klaim` int(11) DEFAULT 0,
  `nama` varchar(50) DEFAULT '0',
  `harga` decimal(10,0) DEFAULT 0,
  `jumlah` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_klaim_detail`
--

INSERT INTO `record_klaim_detail` (`id_klaim_detail`, `id_klaim`, `nama`, `harga`, `jumlah`, `created_at`, `updated_at`) VALUES
(36, 4, 'Buku', '5000', 2, '2023-01-30 08:52:11', '2023-01-30 08:52:11'),
(37, 4, 'Pensil', '1000', 5, '2023-01-30 08:52:11', '2023-01-30 08:52:11'),
(38, 3, 'Kertas A4', '24000', 4, '2023-01-30 09:35:19', '2023-01-30 09:35:19'),
(39, 3, 'Pulpen', '5000', 10, '2023-01-30 09:35:19', '2023-01-30 09:35:19'),
(40, 3, 'Buku', '10000', 20, '2023-01-30 09:35:19', '2023-01-30 09:35:19');

-- --------------------------------------------------------

--
-- Table structure for table `record_reimburse`
--

CREATE TABLE `record_reimburse` (
  `id_reimburse` int(11) NOT NULL,
  `id_klaim` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `bukti_reimburse` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_reimburse`
--

INSERT INTO `record_reimburse` (`id_reimburse`, `id_klaim`, `tanggal`, `jumlah`, `bukti_reimburse`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-01-01 00:00:00', '160991', '3124124124', 1, '2023-01-27 07:45:11', '2023-01-27 07:45:11'),
(3, 1, '2023-01-01 00:00:00', '160991', NULL, 1, '2023-01-28 13:09:43', '2023-01-28 13:18:18');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id_site` int(11) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id_site`, `site`, `id_area`, `id_kota`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 'Pondok Lensa Bali', 2, 2, 'Jl. Raya Kuta No.74A, Kuta', '2023-01-26 09:35:14', '2023-01-30 09:18:52'),
(3, 'Pondok Lensa Bandung', 1, 1, 'Jl. Ciumbuleuit No.22, Hegarmanah, Kec. Cidadap, Kota Bandung, Jawa Barat', '2023-01-26 02:11:52', '2023-01-30 07:08:35'),
(4, 'Pondok Lensa Jakarta', 3, 3, 'Jl. Tebet Raya No.45A, RT.2/RW.2, Tebet Tim., Kec. Tebet, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta', '2023-01-27 12:50:35', '2023-01-30 07:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id_group_user` int(11) NOT NULL,
  `group_user` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id_group_user`, `group_user`, `created_at`, `updated_at`) VALUES
(1, 'Group 1', '2023-01-26 10:50:33', '2023-01-26 10:50:35'),
(2, 'Group 2', '2023-01-26 10:50:47', '2023-01-26 10:50:48'),
(3, 'Group 3', '2023-01-26 03:21:50', '2023-01-26 03:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_petty_cash`
--

CREATE TABLE `user_petty_cash` (
  `id_user_petty_cash` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `ktp` varchar(50) DEFAULT NULL,
  `telpon` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_group_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_petty_cash`
--

INSERT INTO `user_petty_cash` (`id_user_petty_cash`, `nama`, `ktp`, `telpon`, `email`, `alamat`, `id_group_user`, `created_at`, `updated_at`) VALUES
(1, 'Gde Dian Adi Juliartha', '12412512512512512', '0981283484', 'adijuliartha@gmail.com', 'Jalan Sedap Malam', 1, '2023-01-26 12:09:01', '2023-01-26 12:09:02'),
(2, 'Ni Putu Meyan Pratiwi', '4124124125125125', '0128402840', 'meyan@gmail.com', 'Jalan Kemiri', 2, '2023-01-26 12:09:53', '2023-01-30 09:25:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id_asset`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `petty_cash_group`
--
ALTER TABLE `petty_cash_group`
  ADD PRIMARY KEY (`id_petty_cash_group`);

--
-- Indexes for table `record_kas`
--
ALTER TABLE `record_kas`
  ADD PRIMARY KEY (`id_kas`);

--
-- Indexes for table `record_klaim`
--
ALTER TABLE `record_klaim`
  ADD PRIMARY KEY (`id_klaim`);

--
-- Indexes for table `record_klaim_detail`
--
ALTER TABLE `record_klaim_detail`
  ADD PRIMARY KEY (`id_klaim_detail`);

--
-- Indexes for table `record_reimburse`
--
ALTER TABLE `record_reimburse`
  ADD PRIMARY KEY (`id_reimburse`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`id_site`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id_group_user`);

--
-- Indexes for table `user_petty_cash`
--
ALTER TABLE `user_petty_cash`
  ADD PRIMARY KEY (`id_user_petty_cash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record_klaim_detail`
--
ALTER TABLE `record_klaim_detail`
  MODIFY `id_klaim_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
