-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 12:43 PM
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
(1, '1675161743_19f463e72521eb5e86ca.jpg', 1, 'kas', 1, '2023-01-31 10:42:23', '2023-01-31 10:42:23'),
(2, '1675161771_15828f1b68a20de40f1b.jpg', 2, 'kas', 1, '2023-01-31 10:42:51', '2023-01-31 10:42:51'),
(3, '1675162427_2ae8e67df59377fc1d8e.jpg', 1, 'klaim', 1, '2023-01-31 10:53:47', '2023-01-31 10:53:47'),
(4, '1675162483_2bc4bc3ee8de83115d7e.jpg', 2, 'klaim', 1, '2023-01-31 10:54:43', '2023-01-31 10:54:43'),
(5, '1675164799_10cc57c56dd483ed5140.jpg', 1, 'reimburse', 1, '2023-01-31 11:33:19', '2023-01-31 11:33:19'),
(6, '1675164827_8e9b4636b77b5cdc2409.jpg', 2, 'reimburse', 1, '2023-01-31 11:33:47', '2023-01-31 11:33:47'),
(7, '1675164877_da453142b00029a46d06.jpg', 3, 'reimburse', 1, '2023-01-31 11:34:37', '2023-01-31 11:34:37'),
(8, '1675164952_0f03510ee1f8c5672481.jpg', 3, 'klaim', 1, '2023-01-31 11:35:52', '2023-01-31 11:35:52');

-- --------------------------------------------------------

--
-- Table structure for table `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'fsafasf', NULL, '2023-01-30 12:56:42', 0),
(2, '::1', 'pondoklensa@gmail.com', 4, '2023-01-30 13:12:09', 1),
(3, '::1', 'pondoklensa@gmail.com', 4, '2023-01-30 14:02:19', 1),
(4, '::1', 'pondoklensa@gmail.com', 4, '2023-01-30 14:14:55', 1),
(5, '::1', 'pondoklensa@gmail.com', 4, '2023-01-30 23:29:04', 1),
(6, '::1', 'pondoklensa@gmail.com', 4, '2023-01-31 01:31:25', 1),
(7, '::1', 'pondoklensa@gmail.com', 4, '2023-01-31 01:32:36', 1),
(8, '::1', 'pondoklensa@gmail.com', 4, '2023-01-31 04:44:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1675080136, 1);

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
(1, 'Konsumsi', '2023-01-26 11:52:06', '2023-01-31 06:01:55'),
(2, 'Perlengkapan Kantor', '2023-01-26 11:52:15', '2023-01-28 23:14:46'),
(3, 'Telpon', '2023-01-26 03:58:52', '2023-01-31 06:02:47');

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
(1, '2023-01-01 00:00:00', '5000000', 'BCA', NULL, 1, 1, '2023-01-31 10:42:11', '2023-01-31 10:42:25'),
(2, '2023-01-17 00:00:00', '1000000', 'Bank Mandiri', NULL, 1, 1, '2023-01-31 10:42:33', '2023-01-31 10:42:52');

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
(1, '2023-01-03 00:00:00', '203000', 1, 1, 1, 1, 1, '2023-01-31 10:52:59', '2023-01-31 11:33:55'),
(2, '2023-01-09 00:00:00', '210000', 3, 2, 2, 1, 1, '2023-01-31 10:53:59', '2023-01-31 11:34:44'),
(3, '2023-01-12 00:00:00', '500000', 1, 3, 1, 1, 0, '2023-01-31 11:35:23', '2023-01-31 11:36:09');

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
(47, 1, 'Aqua Gelas Dus', '25000', 3, '2023-01-31 10:53:49', '2023-01-31 10:53:49'),
(48, 1, 'Aqua Galon', '16000', 8, '2023-01-31 10:53:49', '2023-01-31 10:53:49'),
(49, 2, 'Pulpen', '8000', 20, '2023-01-31 10:54:52', '2023-01-31 10:54:52'),
(50, 2, 'Kertas A4', '25000', 2, '2023-01-31 10:54:52', '2023-01-31 10:54:52'),
(51, 3, 'Service Hp', '1', 200000, '2023-01-31 11:36:09', '2023-01-31 11:36:09'),
(52, 3, 'Pulsa', '100000', 3, '2023-01-31 11:36:09', '2023-01-31 11:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `record_reimburse`
--

CREATE TABLE `record_reimburse` (
  `id_reimburse` int(11) NOT NULL,
  `id_klaim` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `record_reimburse`
--

INSERT INTO `record_reimburse` (`id_reimburse`, `id_klaim`, `tanggal`, `jumlah`, `id_user`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-01-01 00:00:00', '100000', 1, '2023-01-31 11:33:09', '2023-01-31 11:33:23'),
(2, 1, '2023-01-01 00:00:00', '103000', 1, '2023-01-31 11:33:34', '2023-01-31 11:33:56'),
(3, 2, '2023-01-11 00:00:00', '210000', 1, '2023-01-31 11:34:07', '2023-01-31 11:34:44');

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'pondoklensa@gmail.com', 'pondoklensa', '$2y$10$zgsnRhVpFt5etpHV/LwfL.t/5aO9NdWa9g1O1QRqKC/WSgApz/uKq', 'ec3d9715083f2bbbe15d98b9c912b263', NULL, '2023-01-31 01:41:16', NULL, NULL, NULL, 1, 0, '2023-01-30 13:12:00', '2023-01-31 00:41:16', NULL);

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
-- Indexes for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indexes for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indexes for table `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indexes for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

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
-- AUTO_INCREMENT for table `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `record_klaim_detail`
--
ALTER TABLE `record_klaim_detail`
  MODIFY `id_klaim_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
