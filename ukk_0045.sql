-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2018 at 02:51 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ukk_0045`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_pengguna`
--

CREATE TABLE `data_pengguna` (
  `id` int(11) NOT NULL,
  `uname` varchar(255) NOT NULL,
  `upass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `aktif` enum('Y','T') NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `data_pengguna`
--

INSERT INTO `data_pengguna` (`id`, `uname`, `upass`, `level`, `aktif`, `nama`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Y', 'admin'),
(2, 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', 'operator', 'Y', 'dd'),
(3, 'lingga', '458d0f67bec87022f05530adf3c4c64a', 'admin', 'Y', 'Ardelingga');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_disposisi`
--

CREATE TABLE `tbl_disposisi` (
  `id` int(11) NOT NULL,
  `no_disposisi` varchar(10) NOT NULL,
  `tgl_disposisi` date NOT NULL,
  `no_agenda` int(11) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `asal_surat` varchar(50) NOT NULL,
  `intruksi` varchar(255) NOT NULL,
  `diteruskan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_disposisi`
--

INSERT INTO `tbl_disposisi` (`id`, `no_disposisi`, `tgl_disposisi`, `no_agenda`, `perihal`, `asal_surat`, `intruksi`, `diteruskan`) VALUES
(1, 'D07010', '2006-01-03', 1, 'Pengajuan dana bantuan BOS', 'Kemdikbud', 'Tidak disetujui oleh kepala sekolah', 2),
(2, '8677879097', '2018-04-11', 5, 'Makan Akbar', 'Kantor Kuwu', 'Jangan masuk sekolah', 4),
(3, 'AD4356', '2018-04-13', 1, 'Muncak Bareng', 'Kantor Kuwu', 'Sungkan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_petugas`
--

CREATE TABLE `tbl_petugas` (
  `id` int(11) NOT NULL,
  `nama_petugas` varchar(30) NOT NULL,
  `jenis_kelamin` enum('Laki-Laki','Perempuan') NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_petugas`
--

INSERT INTO `tbl_petugas` (`id`, `nama_petugas`, `jenis_kelamin`, `alamat`, `no_telp`) VALUES
(1, 'Ardelingga Pramesta Kusuma', 'Laki-Laki', 'Dusun 1 Kramat RT 001 RW 001 Desa Sumbakeling Kec.Pancalang ', '083824560942'),
(2, 'Nafi Sulhikam', 'Laki-Laki', 'Desa Cipetir Kec. Luragung Kab. Kuningan', '083824560941'),
(4, 'Ahmad Syah Yasin', 'Laki-Laki', 'Indramayu', '085467746784'),
(5, 'Anggini Fitriyani', 'Perempuan', 'Losari ', '087546789975'),
(6, 'Cusaerih', 'Perempuan', 'Indramayu', '075578654568'),
(7, 'Siti Halimah', 'Perempuan', 'Kali Buntu', '0564335677865');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_keluar`
--

CREATE TABLE `tbl_surat_keluar` (
  `id` int(11) NOT NULL,
  `no_agenda` varchar(7) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `tgl_kirim` date NOT NULL,
  `jenis_surat` enum('Surat Resmi','Surat Dinas','Surat Niaga') NOT NULL,
  `dari` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `petugas_pengirim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_keluar`
--

INSERT INTO `tbl_surat_keluar` (`id`, `no_agenda`, `no_surat`, `tgl_kirim`, `jenis_surat`, `dari`, `kepada`, `perihal`, `petugas_pengirim`) VALUES
(1, 'AB005', '001/N09.A36/LL/2018', '2006-01-18', '', 'Kepala Sekolah', 'Kemdikbud', 'Permohonan dana sekolah', 2),
(2, 'AB0098', '005/5603/103.04/2018', '2006-01-26', 'Surat Niaga', 'BNN', 'Kepala TU', 'Berlomba-lomba dalam kebaikan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_masuk`
--

CREATE TABLE `tbl_surat_masuk` (
  `id` int(11) NOT NULL,
  `no_agenda` varchar(7) NOT NULL,
  `no_surat` varchar(20) NOT NULL,
  `tgl_surat` date NOT NULL,
  `jenis_surat` enum('Surat Resmi','Surat Dinas','Surat Niaga') NOT NULL,
  `dari` varchar(50) NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `petugas_penerima` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_surat_masuk`
--

INSERT INTO `tbl_surat_masuk` (`id`, `no_agenda`, `no_surat`, `tgl_surat`, `jenis_surat`, `dari`, `kepada`, `perihal`, `petugas_penerima`) VALUES
(1, 'DN07007', '005/5603/103.04/2012', '2006-01-11', 'Surat Dinas', 'Kemdikbud', 'Kepala Sekolah', 'Wacana permintaan data siswa', 2),
(5, '9886566', '5456645', '2018-04-13', 'Surat Resmi', 'sdgrgsrg', 'hsthhtr', 'thrherheh', 1),
(6, 'AX86876', 'ADS536457', '2018-04-19', 'Surat Niaga', 'Kuwu', 'Kades', 'Makan Bersama', 4),
(7, 'ASD5435', 'AD64670764', '2018-04-14', 'Surat Dinas', 'Joko Widodo', 'Ardelingga ', 'Bisnis COD', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diteruskan` (`diteruskan`),
  ADD KEY `no_agenda` (`no_agenda`);

--
-- Indexes for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_pengirim` (`petugas_pengirim`);

--
-- Indexes for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_penerima` (`petugas_penerima`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_pengguna`
--
ALTER TABLE `data_pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_petugas`
--
ALTER TABLE `tbl_petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_disposisi`
--
ALTER TABLE `tbl_disposisi`
  ADD CONSTRAINT `tbl_disposisi_ibfk_2` FOREIGN KEY (`diteruskan`) REFERENCES `tbl_petugas` (`id`),
  ADD CONSTRAINT `tbl_disposisi_ibfk_3` FOREIGN KEY (`no_agenda`) REFERENCES `tbl_surat_masuk` (`id`);

--
-- Constraints for table `tbl_surat_keluar`
--
ALTER TABLE `tbl_surat_keluar`
  ADD CONSTRAINT `tbl_surat_keluar_ibfk_1` FOREIGN KEY (`petugas_pengirim`) REFERENCES `tbl_petugas` (`id`);

--
-- Constraints for table `tbl_surat_masuk`
--
ALTER TABLE `tbl_surat_masuk`
  ADD CONSTRAINT `tbl_surat_masuk_ibfk_1` FOREIGN KEY (`petugas_penerima`) REFERENCES `tbl_petugas` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
