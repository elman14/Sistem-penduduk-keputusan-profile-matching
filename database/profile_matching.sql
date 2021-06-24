-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2019 at 02:50 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profile_matching`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(4, 'admin2', 'admin2');

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `nama_alternatif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id_alternatif`, `nama_alternatif`) VALUES
(1, 'Aceng Fikri'),
(2, 'Jamaludin'),
(3, 'Entis Sutisna'),
(4, 'Siti Juleha');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(50) NOT NULL,
  `nilai` double(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`, `nilai`) VALUES
(1, 'Core Factor (CF)', 0.6),
(2, 'Secondary Factor (SF)', 0.4);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(50) NOT NULL,
  `id_jenis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `id_jenis`) VALUES
(1, 'Tingkat Kehadiran', 1),
(2, 'Target Pekerjaan', 1),
(3, 'Pelanggaran', 2),
(4, 'Usia', 2);

-- --------------------------------------------------------

--
-- Table structure for table `opt_alternatif`
--

CREATE TABLE `opt_alternatif` (
  `id_opt` int(11) NOT NULL,
  `id_alternatif` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_subkriteria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `opt_alternatif`
--

INSERT INTO `opt_alternatif` (`id_opt`, `id_alternatif`, `id_kriteria`, `id_subkriteria`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 5),
(3, 1, 3, 8),
(4, 1, 4, 11),
(5, 2, 1, 1),
(6, 2, 2, 6),
(7, 2, 3, 7),
(8, 2, 4, 13),
(9, 3, 1, 3),
(10, 3, 2, 4),
(11, 3, 3, 9),
(12, 3, 4, 12),
(13, 4, 1, 1),
(14, 4, 2, 5),
(15, 4, 3, 9),
(16, 4, 4, 14);

-- --------------------------------------------------------

--
-- Table structure for table `selisih`
--

CREATE TABLE `selisih` (
  `id_selisih` int(11) NOT NULL,
  `nilai_selisih` int(11) NOT NULL,
  `bobot` double(11,1) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selisih`
--

INSERT INTO `selisih` (`id_selisih`, `nilai_selisih`, `bobot`, `keterangan`) VALUES
(1, 0, 5.0, 'Tidak ada selisih (kompetensi sesuai dengan yang dibutuhkan)'),
(2, 1, 4.5, 'Kompetensi individu kelebihan 1 tingkat'),
(3, -1, 4.0, 'Kompetensi individu kekurangan 1 tingkat'),
(4, 2, 3.5, 'Kompetensi individu kelebihan 2 tingkat'),
(5, -2, 3.0, 'Kompetensi individu kekurangan 2 tingkat'),
(6, 3, 2.5, 'Kompetensi individu kelebihan 3 tingkat'),
(7, -3, 2.0, 'Kompetensi individu kekurangan 3 tingkat'),
(8, 4, 1.5, 'Kompetensi individu kelebihan 4 tingkat'),
(9, -4, 1.0, 'Kompetensi individu kekurangan 4 tingkat');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `id_subkriteria` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nama_subkriteria` varchar(100) NOT NULL,
  `nilai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`id_subkriteria`, `id_kriteria`, `nama_subkriteria`, `nilai`) VALUES
(1, 1, '100%', 5),
(2, 1, 'Antara 80 - 100%', 3),
(3, 1, 'Dibawah 80%', 2),
(4, 2, 'Melebihi target', 5),
(5, 2, 'Sesuai target', 3),
(6, 2, 'Tidak sesuai target', 2),
(7, 3, 'Tanpa pelanggaran', 4),
(8, 3, '1 kali pelanggaran', 3),
(9, 3, '2 kali pelanggaran', 2),
(10, 3, 'Lebih dari 2 kali', 1),
(11, 4, 'Dibawah 30 tahun', 4),
(12, 4, 'Antara 30 - 40 tahun', 3),
(13, 4, 'Antara 40 - 50 tahun', 2),
(14, 4, 'Diatas 50 tahun', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id_alternatif`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `opt_alternatif`
--
ALTER TABLE `opt_alternatif`
  ADD PRIMARY KEY (`id_opt`),
  ADD KEY `id_alternatif` (`id_alternatif`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_subkriteria` (`id_subkriteria`);

--
-- Indexes for table `selisih`
--
ALTER TABLE `selisih`
  ADD PRIMARY KEY (`id_selisih`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`id_subkriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id_alternatif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `opt_alternatif`
--
ALTER TABLE `opt_alternatif`
  MODIFY `id_opt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `selisih`
--
ALTER TABLE `selisih`
  MODIFY `id_selisih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `id_subkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `kriteria_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis` (`id_jenis`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `opt_alternatif`
--
ALTER TABLE `opt_alternatif`
  ADD CONSTRAINT `opt_alternatif_ibfk_1` FOREIGN KEY (`id_alternatif`) REFERENCES `alternatif` (`id_alternatif`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `opt_alternatif_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `opt_alternatif_ibfk_3` FOREIGN KEY (`id_subkriteria`) REFERENCES `subkriteria` (`id_subkriteria`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD CONSTRAINT `subkriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
