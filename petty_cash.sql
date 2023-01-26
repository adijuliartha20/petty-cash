-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2023 at 09:05 AM
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
(1, 'Lembang', 1, '2023-01-26 01:20:18', '2023-01-26 01:22:00'),
(2, 'Kuta', 2, '2023-01-26 01:20:27', '2023-01-26 01:20:27'),
(3, 'Jakarta Selatan', 3, '2023-01-26 01:22:46', '2023-01-26 01:22:46');

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
(2, 'Group Petty 2', '2023-01-26 11:52:15', '2023-01-26 04:01:44'),
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
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `bukti_klaim` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `record_klaim_detail`
--

CREATE TABLE `record_klaim_detail` (
  `id_klaim_detail` int(11) NOT NULL,
  `id_klaim` int(11) DEFAULT 0,
  `nama` int(11) DEFAULT 0,
  `harga` decimal(10,0) DEFAULT 0,
  `jumlah` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `id_site` int(11) NOT NULL,
  `site` varchar(50) DEFAULT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_kota` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id_site`, `site`, `id_area`, `id_kota`, `created_at`, `updated_at`) VALUES
(1, 'Mall Bali Galeria 5', 2, 2, '2023-01-26 09:35:14', '2023-01-26 02:36:56'),
(3, 'Mall Jepara', 1, 1, '2023-01-26 02:11:52', '2023-01-26 02:11:52');

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
(2, 'Meyan', '4124124125125125', '0128402840', 'meyan@gmail.com', 'Jalan Kemiri', 2, '2023-01-26 12:09:53', '2023-01-26 12:09:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

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
  MODIFY `id_klaim_detail` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
