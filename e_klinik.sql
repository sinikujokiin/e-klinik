-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 07, 2025 at 08:17 PM
-- Server version: 10.11.10-MariaDB-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `n1574432_e_klinik`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `fullname` varchar(50) DEFAULT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `token` varchar(120) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `role_id`, `username`, `password`, `fullname`, `status`, `token`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'admin', '$2y$10$duxQUAYfc4/xMbSY.ODr5.4HjVSM/xAj4ApMg10sTxZ2w6GdaUBiq', 'Administrator', 'Aktif', '6764e933b5e90241220034907TDJEWjN5YlBYNFRLc2JLSzN6MCtPdz09', '2024-12-20 03:49:07', '2023-01-11 02:45:27', '2024-12-20 03:49:07', NULL),
(2, 2, 'tirta', '$2y$10$jtWaFcASRoCIfBmO3QTJSubrYauluxnY/apbYe.eu3b6v6Knlm9.6', 'Dr. Tirta', 'Aktif', '654ab0703b262231107094728VlptMVlTL0pGNFFOZ0dyWWM1Q1J4QT09', '2023-11-07 21:47:28', '2023-06-18 13:48:38', '2023-11-07 21:47:28', NULL),
(3, 3, 'apoteker', '$2y$10$pfhwsMI1S.Ib6kRPSBzL1.fFf0PXCUPpgQiVuc2Yt2u5wxA2ohvsy', 'Apoteker 1', 'Aktif', '654aafebc0b7b231107094515UDhGcGNNWkhrRU5uVER1d0dQQTYvdz09', '2023-11-07 21:45:15', '2023-06-19 14:43:35', '2023-11-07 21:45:15', NULL),
(4, 2, 'dokter', '$2y$10$ab90xpfvtJ7cvzzbcByeKOG1kbFlP4hFD3NV7zmHVkCKRfH7u1H.K', 'Dokter 1', 'Aktif', '6498357e216fe230625123926UytYUHluZ3BDUEhUcWM2bHA2OE1tZz09', '2023-06-25 12:39:26', '2023-06-25 12:22:55', '2023-06-25 13:33:06', '2023-06-25 13:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `no_reg` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pob` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('-','Laki-Laki','Perempuan') NOT NULL DEFAULT '-',
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `user_id`, `code`, `no_reg`, `name`, `pob`, `dob`, `gender`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'DTR0001', '2054844805', 'Dr. Tirta', 'Jakarta', '1985-12-12', 'Laki-Laki', 'Aktif', '2023-06-18 18:48:25', '2023-06-18 13:48:38', NULL),
(2, 4, 'DTR0002', '54046460469', 'Dokter 1', 'Jakarta', '1960-06-18', 'Laki-Laki', 'Aktif', '2023-06-25 19:22:25', '2023-06-25 13:33:06', '2023-06-25 13:33:06'),
(3, NULL, 'DTR0002', '123456789', 'dr. Hasril ', 'Tanggerang', '1970-04-13', 'Laki-Laki', 'Aktif', '2023-06-25 20:35:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `inspections`
--

CREATE TABLE `inspections` (
  `id` int(10) UNSIGNED NOT NULL,
  `patient_id` int(10) UNSIGNED DEFAULT NULL,
  `doctor_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `symptom` text DEFAULT NULL,
  `diagnosis` text DEFAULT NULL,
  `treatment` text DEFAULT NULL,
  `tension` tinyint(3) UNSIGNED DEFAULT NULL,
  `height` tinyint(3) UNSIGNED DEFAULT NULL,
  `weight` tinyint(3) UNSIGNED DEFAULT NULL,
  `cost` decimal(10,0) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Dalam Penanganan',
  `date` date DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inspections`
--

INSERT INTO `inspections` (`id`, `patient_id`, `doctor_id`, `code`, `symptom`, `diagnosis`, `treatment`, `tension`, `height`, `weight`, `cost`, `status`, `date`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'PRS230001', 'Lapar', 'Kurang Makan', '[\"Parasetamol (Acetaminophen)\",\"Vitamin C\"]', NULL, NULL, NULL, 25000, 'Selesai', '2023-06-19', 2, '2023-06-19 19:45:31', '2023-06-19 17:38:24', NULL),
(2, 2, NULL, 'PRS230002', 'Ngantuk', 'Kurang Tidur', '[\"Paracetamolor\",\"Ibuprofen\"]', 100, 155, 65, 25000, 'Selesai', '2023-06-19', 1, '2023-06-19 22:57:32', '2023-06-20 00:36:31', NULL),
(3, 2, 1, 'PRS230003', 'Batuk n pilek ', 'Flu', '[\"Parasetamol (Acetaminophen)\",\"Paracetamolor\",\"Ibuprofen\"]', 0, 0, 0, 25000, 'Selesai', '2023-06-24', 2, '2023-06-24 19:09:44', '2023-06-24 14:35:43', NULL),
(4, 1, NULL, 'PRS230004', 'Sakit di ulu hati dan mual', 'maag', NULL, NULL, NULL, NULL, 50000, 'Menunggu Pemeriksaan Dokter', '2023-06-25', 2, '2023-06-25 09:40:08', '2023-06-25 11:57:41', '2023-06-25 11:57:41'),
(5, 1, 2, 'PRS230004', 'Haus', 'Kurang Minum', '[\"Vitamin C\"]', 0, 0, 0, 25000, 'Selesai', '2023-06-25', 1, '2023-06-25 19:39:08', '2023-06-25 12:41:06', NULL),
(6, 1, NULL, 'PRS230005', 'Test Keluhan ', 'Test Diagnosa', '[\"Parasetamol (Acetaminophen)\",\"Cetirizine\"]', 0, 0, 0, 150000, 'Selesai', '2023-08-22', 1, '2023-08-22 10:02:59', '2023-11-07 21:33:25', NULL),
(7, 3, 1, 'PRS230006', 'Keluhannya', 'Diagnosanya', '[\"Ibuprofen\",\"Vitamin C\"]', 100, 165, 75, 75000, 'Selesai', '2023-11-08', 1, '2023-11-08 04:41:16', '2023-11-07 21:45:23', NULL),
(8, 3, 1, 'PRS230007', 'Test', 'Test', '[\"Ibuprofen\",\"Vitamin C\"]', 100, 180, 88, 0, 'Telah mendapatkan resep', '2023-11-08', 2, '2023-11-08 04:47:44', '2023-11-07 21:48:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(10) UNSIGNED NOT NULL,
  `stock_min` int(11) NOT NULL,
  `purchase_price` decimal(10,0) NOT NULL,
  `selling_price` decimal(10,0) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `type` varchar(15) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Active',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `code`, `name`, `description`, `stock`, `stock_min`, `purchase_price`, `selling_price`, `unit`, `type`, `image`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'OBT001', 'Paracetamolor', 'Obat penurun demam dan pereda nyeri', 0, 5, 5000, 8000, 'PCS', 'Oral', '/uploads/medicines/64833b7f21d6b-23-06-09-apotek_online_k24klik_20211213114006359225_PXL-20211209-025150276-removebg-preview.png', 'Aktif', '2023-06-09 21:09:28', '2023-06-24 14:35:43', NULL),
(2, 'OBT002', 'Cetirizine', 'Antihistamin untuk alergi', 29, 5, 6000, 10000, 'PCS', 'Oral', '/uploads/medicines/64833be0076bd-23-06-09-cetirizine_10_mg_3.png', 'Aktif', '2023-06-09 21:10:46', '2023-11-07 21:33:25', NULL),
(3, 'OBT003', 'Ibuprofen', 'Analgesik dan antiinflamasi', 34, 0, 8000, 12000, 'PCS', 'Oral', '/uploads/medicines/64833bfcec311-23-06-09-apotek_online_k24klik_20211210093212359225_IBUPROFEN-TRIMAN-400MG-TAB-100S-removebg-preview.png', 'Aktif', '2023-06-09 21:11:11', '2023-11-07 21:45:23', NULL),
(4, 'OBT004', 'Antasida', 'Obat maag dan gangguan pencernaan', 20, 0, 7000, 11000, 'PCS', 'Oral', '/uploads/medicines/64833c1a10c53-23-06-09-apotek_online_k24klik_20211227022147359225_ANTASIDA-FM-TAB-100S-removebg-preview.png', 'Aktif', '2023-06-09 21:11:44', '2023-06-12 01:20:37', NULL),
(5, 'OBT005', 'Vitamin C', 'Suplemen untuk meningkatkan imunitas', 53, 4, 3000, 5000, 'PCS', 'Oral', '/uploads/medicines/64833c3a94532-23-06-09-apotek_online_k24klik_20160502112820291_BECEFORT-SYR-60ML.png', 'Aktif', '2023-06-09 21:12:13', '2023-11-07 21:45:23', NULL),
(6, 'OBT0006', 'Parasetamol (Acetaminophen)', 'Obat ini digunakan untuk meredakan nyeri ringan hingga sedang, serta mengurangi demam. Parasetamol bekerja dengan menghambat produksi prostaglandin di otak yang bertanggung jawab atas sensasi nyeri dan peningkatan suhu tubuh.', 7, 5, 5000, 8000, 'Botol', 'Injeksi', '/uploads/medicines/648656a727184-23-06-12-apotek_online_k24klik_20211224013127359225_PARACETAMOL-FM-120MG-5ML-SYR-60ML-removebg-preview.png', 'Aktif', '2023-06-12 06:20:07', '2023-11-07 21:33:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_transactions`
--

CREATE TABLE `medicine_transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `medicine_id` int(10) UNSIGNED DEFAULT NULL,
  `qty` tinyint(4) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_transactions`
--

INSERT INTO `medicine_transactions` (`id`, `medicine_id`, `qty`, `price`, `created_at`, `updated_at`, `deleted_at`, `created_by`) VALUES
(1, 6, 1, 8000, '2023-06-19 14:48:12', '2023-06-19 14:48:12', NULL, 2),
(2, 5, 1, 5000, '2023-06-19 14:48:12', '2023-06-19 14:48:12', NULL, 2),
(3, 1, 1, 8000, '2023-06-19 17:58:16', '2023-06-19 17:58:16', NULL, 1),
(4, 3, 1, 12000, '2023-06-19 17:58:16', '2023-06-19 17:58:16', NULL, 1),
(5, 6, 1, 8000, '2023-06-24 12:12:49', '2023-06-24 12:12:49', NULL, 2),
(6, 1, 1, 8000, '2023-06-24 12:12:49', '2023-06-24 12:12:49', NULL, 2),
(7, 3, 1, 12000, '2023-06-24 12:12:49', '2023-06-24 12:12:49', NULL, 2),
(8, 5, 5, 5000, '2023-06-25 12:40:24', '2023-06-25 12:40:24', NULL, 4),
(9, 6, 1, 8000, '2023-11-07 21:32:57', '2023-11-07 21:32:57', NULL, 1),
(10, 2, 1, 10000, '2023-11-07 21:32:57', '2023-11-07 21:32:57', NULL, 1),
(11, 3, 1, 12000, '2023-11-07 21:44:34', '2023-11-07 21:44:34', NULL, 2),
(12, 5, 1, 5000, '2023-11-07 21:44:34', '2023-11-07 21:44:34', NULL, 2),
(13, 4, 1, 11000, '2023-11-07 21:48:01', '2023-11-07 21:48:01', NULL, 2),
(14, 5, 1, 5000, '2023-11-07 21:48:01', '2023-11-07 21:48:01', NULL, 2),
(15, 3, 1, 12000, '2023-11-07 21:48:22', '2023-11-07 21:48:22', NULL, 2),
(16, 3, 1, 12000, '2023-11-07 21:48:40', '2023-11-07 21:48:40', NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `url` varchar(100) DEFAULT '#',
  `icon` varchar(50) DEFAULT NULL,
  `sort` smallint(5) UNSIGNED NOT NULL,
  `access` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`access`)),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `name`, `url`, `icon`, `sort`, `access`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Dashboard', 'dashboard', 'bi bi-house', 1, NULL, '2023-01-11 02:50:35', '2023-01-22 13:16:44', NULL),
(2, NULL, 'Setting', '#', 'bi bi-gear', 6, NULL, '2023-01-11 02:50:35', '2023-06-15 23:37:06', NULL),
(3, 2, 'Menu', 'menus', 'bi bi-file-ruled', 3, '[\"read\", \"create\", \"update\", \"delete\"]', '2023-01-11 02:52:00', '2023-01-23 02:08:23', NULL),
(5, 2, 'Role', 'roles', '#', 1, '[\"read\", \"create\", \"update\", \"delete\", \"access\"]', '2023-01-11 05:52:43', '2023-01-23 02:09:07', NULL),
(6, 2, 'Pengguna', 'accounts', 'bi bi-person', 2, '[\"read\", \"create\", \"update\", \"delete\"]', '2023-01-11 06:15:13', '2023-01-23 02:09:26', NULL),
(8, NULL, 'Master Data', '#', 'bi bi-database', 3, NULL, '2023-01-11 22:47:22', '2023-01-23 02:07:44', NULL),
(9, 8, 'Dokter', 'doctors', '#', 2, '[\"read\",\"create\",\"update\",\"delete\"]', '2023-01-11 22:47:54', '2024-05-02 13:53:13', NULL),
(11, 8, 'Obat', 'medicines', '#', 3, '[\"read\",\"create\",\"update\",\"delete\"]', '2023-01-12 04:41:27', '2024-05-02 13:53:13', NULL),
(12, 8, 'Pasien', 'patients', '#', 1, '[\"create\",\"read\",\"update\",\"delete\",\"history\"]', '2023-01-12 07:40:27', '2023-06-25 11:47:57', NULL),
(13, 8, 'Apoteker', 'pharmacists', '#', 4, '[\"read\",\"create\",\"update\",\"delete\"]', '2023-01-12 08:09:01', '2023-06-25 11:47:57', NULL),
(14, 8, 'Program Kreativitas Mahasiswa (PKM)', 'p_k_m', '#', 13, '[\"read\", \"create\", \"update\", \"delete\"]', '2023-01-12 08:10:03', '2023-06-20 01:09:47', '2023-06-20 01:09:47'),
(15, NULL, 'Monitoring', '#', 'bi bi-tv', 2, NULL, '2023-01-12 09:39:23', '2023-01-22 13:17:22', NULL),
(16, 15, 'Laporan Pemeriksaan', 'inspection_reports', '#', 1, '[\"read\",\"download\"]', '2023-01-12 10:24:02', '2023-06-23 22:55:25', '2023-06-23 22:55:25'),
(17, 8, 'Total Mahasiswa', 'total_students', '#', 12, '[\"read\", \"create\", \"update\", \"delete\"]', '2023-01-12 10:37:11', '2023-06-20 01:09:54', '2023-06-20 01:09:54'),
(18, 8, 'Tindakan', 'treathments', '#', 5, '[\"read\",\"create\",\"update\",\"delete\"]', '2023-01-12 11:49:26', '2023-06-23 22:55:10', '2023-06-23 22:55:10'),
(19, 8, 'Indikator Monitoring', 'monitoring_indicators', '#', 6, '[\"read\", \"create\", \"update\", \"delete\", \"rule\"]', '2023-01-12 11:50:41', '2023-06-20 01:10:01', '2023-06-20 01:10:01'),
(20, 8, 'Tenaga Kependidikan', 'educational_staffs', '#', 7, '[\"read\", \"create\", \"update\", \"delete\"]', '2023-01-13 14:34:43', '2023-06-20 01:10:10', '2023-06-20 01:10:10'),
(21, 8, 'Matriks Penilaian', 'assessment_matrices', '#', 8, '[\"read\", \"update\"]', '2023-01-20 03:28:00', '2023-06-20 01:10:17', '2023-06-20 01:10:17'),
(22, 15, 'Laporan Data Pasien', 'patient_reports', '#', 2, '[\"read\",\"download\"]', '2023-01-20 10:55:57', '2023-06-23 22:55:32', '2023-06-23 22:55:32'),
(23, 15, 'Laporan Data Pembayaran', 'payment_reports', '#', 1, '[\"read\",\"download\"]', '2023-01-20 10:56:22', '2023-06-25 01:41:19', NULL),
(24, 8, 'Master Dokumen', 'master_documents', '#', 9, '[\"read\", \"update\"]', '2023-01-20 21:20:05', '2023-06-20 01:10:24', '2023-06-20 01:10:24'),
(25, 8, 'Target Capaian', 'achievement_targets', '#', 10, '[\"read\", \"download\", \"update\"]', '2023-01-22 04:08:09', '2023-06-20 01:10:31', '2023-06-20 01:10:31'),
(26, 2, 'Urutan Menu', 'sorting_menu', '#', 4, '[\"read\", \"update\"]', '2023-01-22 12:47:22', '2023-01-23 02:08:37', NULL),
(27, 8, 'Evaluasi Standar', 'standard_evaluations', '#', 11, '[\"read\", \"download\"]', '2023-01-23 06:10:24', '2023-06-20 01:10:44', '2023-06-20 01:10:44'),
(28, 2, 'Website', 'setting', '#', 5, '[\"read\",\"update\"]', '2023-06-09 13:28:00', '2023-06-15 23:37:06', NULL),
(29, NULL, 'Pemeriksaan Pasien', 'inspections', 'fa fa-list', 4, '[\"read\",\"create\",\"update\",\"delete\",\"process\",\"read_by\",\"detail\"]', '2023-06-10 06:10:38', '2023-06-25 11:50:20', NULL),
(30, NULL, 'Resep Obat', 'recipes', 'fa fa-list', 5, '[\"read\",\"print\",\"process\"]', '2023-06-15 23:36:47', '2023-06-15 23:37:09', NULL),
(31, 15, 'Laporan Stok Obat', 'medicine_reports', '#', 2, '[\"read\",\"download\"]', '2023-06-18 12:47:57', '2023-06-24 12:24:35', NULL),
(32, 1, 'Data barang ', 'Y', 'F', 1, 'null', '2024-05-02 13:52:11', '2024-05-02 13:52:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pob` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`age`)),
  `gender` enum('-','Laki-Laki','Perempuan') NOT NULL DEFAULT '-',
  `address` text DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `type` enum('UMUM','BPJS') NOT NULL DEFAULT 'UMUM',
  `bpjs_number` varchar(25) DEFAULT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'Aktif',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `code`, `name`, `pob`, `dob`, `age`, `gender`, `address`, `phone`, `email`, `type`, `bpjs_number`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RM230001', 'Luthfi Ihdalhusnayain', 'Jakarta', '1998-04-26', '{\"year\":25,\"month\":1}', 'Laki-Laki', 'Jalan Gang Regge, Marunda, Cilincing', '0895322316585', 'luthfi.ihdalhusnayain@gmail.com', 'UMUM', '', 'Aktif', '2023-06-18 18:51:07', '2024-05-02 13:49:41', '2024-05-02 13:49:41'),
(2, 'RM230002', 'Siti Aisyah', 'Bogor', '1999-07-02', '{\"year\":23,\"month\":11}', 'Perempuan', 'Leuwiliang', '085890836201', 'aisyahsiti461@gmail.com', 'UMUM', '', 'Aktif', '2023-06-19 22:57:06', NULL, NULL),
(3, 'RM230003', 'Fulan bin fulana', 'Antah Berantah', '1991-02-21', '{\"year\":32,\"month\":8}', 'Laki-Laki', 'Not Found Location', '0808080808080', 'fulan@gmail.com', 'BPJS', '00800541', 'Aktif', '2023-11-08 04:40:35', '2023-11-08 02:09:53', NULL),
(4, 'RM230004', 'Muhamad Aryansyah ', 'Tanggerang', '2002-11-06', '{\"year\":21,\"month\":0}', 'Laki-Laki', 'Lampung ', '085212334522', 'muhammadaryansyah17@gmail.com', 'UMUM', '', 'Aktif', '2023-11-08 08:09:21', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `no_reg` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `pob` varchar(50) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('-','Laki-Laki','Perempuan') NOT NULL DEFAULT '-',
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`id`, `user_id`, `code`, `no_reg`, `name`, `pob`, `dob`, `gender`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'APTK0001', '0814984084', 'Apoteker 1', 'Jakarta', '1975-10-10', 'Laki-Laki', 'Aktif', '2023-06-19 19:43:22', '2023-06-19 14:43:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `id` int(10) UNSIGNED NOT NULL,
  `inspection_id` int(10) UNSIGNED DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `recipe` text NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'belum dibayar',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `apoteker_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`id`, `inspection_id`, `code`, `recipe`, `total`, `status`, `created_by`, `apoteker_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'RSP230001', '[{\"name\":\"Parasetamol (Acetaminophen)\",\"qty\":\"1\",\"price\":\"8000\"},{\"name\":\"Vitamin C\",\"qty\":\"1\",\"price\":\"5000\"}]', 13000, 'selesai', 1, 1, '2023-06-19 14:48:12', '2023-06-19 17:38:24', NULL),
(2, 2, 'RSP230002', '[{\"name\":\"Paracetamolor\",\"qty\":\"1\",\"price\":\"8000\"},{\"name\":\"Ibuprofen\",\"qty\":\"1\",\"price\":\"12000\"}]', 20000, 'selesai', NULL, NULL, '2023-06-19 17:58:16', '2023-06-20 00:36:31', NULL),
(3, 3, 'RSP230003', '[{\"name\":\"Parasetamol (Acetaminophen)\",\"qty\":\"1\",\"price\":\"8000\"},{\"name\":\"Paracetamolor\",\"qty\":\"1\",\"price\":\"8000\"},{\"name\":\"Ibuprofen\",\"qty\":\"1\",\"price\":\"12000\"}]', 28000, 'selesai', 1, 1, '2023-06-24 12:12:49', '2023-06-24 14:35:43', NULL),
(4, 5, 'RSP230004', '[{\"name\":\"Vitamin C\",\"qty\":\"5\",\"price\":\"5000\"}]', 25000, 'selesai', 2, 1, '2023-06-25 12:40:24', '2023-06-25 12:41:06', NULL),
(5, 6, 'RSP230005', '[{\"name\":\"Parasetamol (Acetaminophen)\",\"qty\":\"1\",\"price\":\"8000\"},{\"name\":\"Cetirizine\",\"qty\":\"1\",\"price\":\"10000\"}]', 18000, 'selesai', NULL, NULL, '2023-11-07 21:32:57', '2023-11-07 21:33:25', NULL),
(6, 7, 'RSP230006', '[{\"name\":\"Ibuprofen\",\"qty\":\"1\",\"price\":\"12000\"},{\"name\":\"Vitamin C\",\"qty\":\"1\",\"price\":\"5000\"}]', 17000, 'selesai', 1, 1, '2023-11-07 21:44:34', '2023-11-07 21:45:23', NULL),
(7, 8, 'RSP230007', '[{\"name\":\"Ibuprofen\",\"qty\":\"1\",\"price\":\"12000\"},{\"name\":\"Vitamin C\",\"qty\":\"1\",\"price\":\"5000\"}]', 17000, 'belum dibayar', 1, NULL, '2023-11-07 21:48:01', '2023-11-07 21:48:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', '', '2023-01-11 02:44:05', '2023-06-14 14:59:18', NULL),
(2, 'Dokter', '', '2023-01-11 02:44:05', '2023-06-09 15:06:26', NULL),
(3, 'Apoteker', '', '2023-01-11 02:44:05', '2023-06-09 15:06:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_accesses`
--

CREATE TABLE `role_accesses` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `access` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`access`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `role_accesses`
--

INSERT INTO `role_accesses` (`id`, `role_id`, `menu_id`, `access`) VALUES
(1, 1, 1, NULL),
(2, 1, 2, NULL),
(3, 1, 3, '[\"read\",\"create\",\"update\",\"delete\"]'),
(4, 1, 5, '[\"read\",\"create\",\"update\",\"delete\",\"access\"]'),
(5, 1, 6, '[\"read\",\"create\",\"update\",\"delete\"]'),
(7, 1, 8, NULL),
(8, 1, 9, '[\"read\",\"create\",\"update\",\"delete\"]'),
(10, 1, 11, '[\"read\",\"create\",\"update\",\"delete\"]'),
(11, 1, 12, '[\"create\",\"read\",\"update\",\"delete\",\"history\"]'),
(12, 1, 13, '[\"read\",\"create\",\"update\",\"delete\"]'),
(17, 1, 15, NULL),
(25, 1, 23, '[\"read\",\"download\"]'),
(28, 3, 1, NULL),
(29, 3, 15, NULL),
(30, 3, 16, '[\"read\",\"download\"]'),
(31, 3, 22, '[\"read\",\"download\"]'),
(32, 3, 23, '[\"read\",\"download\"]'),
(33, 3, 25, '[\"read\",\"download\"]'),
(34, 1, 26, '[\"read\",\"update\"]'),
(36, 2, 1, NULL),
(37, 2, 15, NULL),
(41, 2, 8, NULL),
(43, 2, 11, '[\"read\",\"create\",\"update\",\"delete\"]'),
(48, 2, 12, '[\"create\",\"read\",\"update\",\"delete\",\"history\"]'),
(56, 3, 27, '[\"read\",\"download\"]'),
(57, 5, 1, NULL),
(58, 5, 15, NULL),
(59, 5, 16, '[\"read\", \"download\"]'),
(60, 5, 22, '[\"read\", \"download\"]'),
(61, 5, 23, '[\"read\", \"download\"]'),
(62, 5, 8, NULL),
(63, 5, 25, '[\"read\", \"download\"]'),
(64, 5, 27, '[\"read\", \"download\"]'),
(65, 3, 8, NULL),
(66, 7, 2, NULL),
(67, 7, 5, '[\"read\",\"create\"]'),
(68, 7, 6, '[\"read\",\"create\"]'),
(69, 7, 3, '[\"read\"]'),
(70, 7, 26, '[\"read\"]'),
(71, 7, 1, NULL),
(72, 1, 28, '[\"read\",\"update\"]'),
(73, 1, 29, '[\"read\",\"create\",\"update\",\"delete\",\"process\",\"read_by\",\"detail\"]'),
(74, 1, 30, '[\"read\",\"print\",\"process\"]'),
(75, 2, 29, '[\"read\",\"create\",\"update\",\"delete\",\"process\",\"read_by\",\"detail\"]'),
(76, 3, 11, '[\"read\",\"create\",\"update\",\"delete\"]'),
(77, 3, 30, '[\"read\",\"print\",\"process\"]'),
(78, 1, 31, '[\"read\",\"download\"]'),
(79, 2, 23, '[\"read\",\"download\"]'),
(80, 2, 31, '[\"read\",\"download\"]');

-- --------------------------------------------------------

--
-- Table structure for table `treathments`
--

CREATE TABLE `treathments` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `status` varchar(25) NOT NULL DEFAULT 'Aktif',
  `medicine_query` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `treathments`
--

INSERT INTO `treathments` (`id`, `parent_id`, `name`, `price`, `status`, `medicine_query`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, 'Tindakan', 0, 'Aktif', '', '2023-06-12 21:59:25', NULL, NULL),
(2, 1, 'Infus RL', 175000, 'Aktif', '', '2023-06-12 22:01:45', NULL, NULL),
(3, NULL, 'Laboratorium', 0, 'Aktif', '', '2023-06-12 22:02:53', NULL, NULL),
(4, 3, 'Cek GDS', 30000, 'Aktif', '', '2023-06-12 22:03:43', NULL, NULL),
(5, NULL, 'Obat Injeksi', 0, 'Aktif', 'select * from medicines where type = \'Injeksi\'', '2023-06-12 22:05:04', NULL, NULL),
(6, NULL, 'Obat Oral', 0, 'Aktif', 'select * from medicines where type = \'Oral\'', '2023-06-12 22:11:12', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relation_role` (`role_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inspections`
--
ALTER TABLE `inspections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `medicine_transactions`
--
ALTER TABLE `medicine_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `no_reg` (`no_reg`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_accesses`
--
ALTER TABLE `role_accesses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `relation_role` (`role_id`),
  ADD KEY `relation_menu` (`menu_id`);

--
-- Indexes for table `treathments`
--
ALTER TABLE `treathments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inspections`
--
ALTER TABLE `inspections`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medicine_transactions`
--
ALTER TABLE `medicine_transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_accesses`
--
ALTER TABLE `role_accesses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `treathments`
--
ALTER TABLE `treathments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accounts`
--
ALTER TABLE `accounts`
  ADD CONSTRAINT `roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `role_accesses`
--
ALTER TABLE `role_accesses`
  ADD CONSTRAINT `relation_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `relation_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
