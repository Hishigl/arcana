-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 10:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arcana`
--

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `kode_gejala` varchar(3) NOT NULL,
  `nama_gejala` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`kode_gejala`, `nama_gejala`) VALUES
('1', 'Kulit wajah terlihat tidak berminyak'),
('10', 'Kulit wajah terasa kering'),
('11', 'Pori-pori wajah hampir tidak terlihat'),
('12', 'Tekstur kulit wajah terasa tipis'),
('13', 'Kerutan halus pada wajah sangat terlihat'),
('14', 'Kulit wajah berminyak pada bagian tertentu'),
('15', 'Kulit wajah terasa kering pada bagian tertentu'),
('16', 'Kulit wajah berjerawat pada saat tertentu (misalnya saat masa period)'),
('17', 'Sulit mencari produk kosmetik yang cocok '),
('18', 'Mudah alergi'),
('19', 'Mudah iritasi dan terluka'),
('2', 'Kulit wajah terasa segar dan halus'),
('20', 'Kulit wajah terlihat kemerahan '),
('3', 'Bahan kosmetik mudah menempel pada kulit wajah'),
('4', 'Kulit wajah terlihat kusam'),
('5', 'Wajah tidak berjerawat'),
('6', 'Kulit wajah cocok terhadap semua jenis produk kosmetik '),
('7', 'Pori-pori di area hidung, pipi, dan dagu sangat terlihat'),
('8', 'Kulit wajah terlihat lebih mengkilap'),
('9', 'Kulit wajah sering berjerawat');

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id` int(10) NOT NULL,
  `kondisi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id`, `kondisi`) VALUES
(1, 'Tidak'),
(2, 'Tidak Yakin'),
(3, 'Kurang Yakin'),
(4, 'Cukup Yakin'),
(5, 'Yakin'),
(6, 'Sangat Yakin');

-- --------------------------------------------------------

--
-- Table structure for table `tipewajah`
--

CREATE TABLE `tipewajah` (
  `kode_tipewajah` varchar(3) NOT NULL,
  `nama_tipewajah` varchar(100) NOT NULL,
  `det_tipewajah` varchar(2000) NOT NULL,
  `srn_tipewajah` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tipewajah`
--

INSERT INTO `tipewajah` (`kode_tipewajah`, `nama_tipewajah`, `det_tipewajah`, `srn_tipewajah`) VALUES
('K01', 'Kulit Wajah Normal', 'Normal', 'Normal'),
('K02', 'Kulit Wajah Berminyak', 'Kulit Wajah Berminyak', 'Kulit Wajah Berminyak'),
('K03', 'Kulit Wajah Kering', 'Kulit Wajah Kering', 'Kulit Wajah Kering'),
('K04', 'Kulit Wajah Kombinasi', 'Kulit Wajah Kombinasi', 'Kulit Wajah Kombinasi'),
('K05', 'Kulit Wajah Sensitif', 'Kulit Wajah Sensitif', 'Kulit Wajah Sensitif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD UNIQUE KEY `id_gejala` (`kode_gejala`) USING BTREE;

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD UNIQUE KEY `id_kondisi` (`id`);

--
-- Indexes for table `tipewajah`
--
ALTER TABLE `tipewajah`
  ADD UNIQUE KEY `id_tipewajah` (`kode_tipewajah`) USING BTREE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
