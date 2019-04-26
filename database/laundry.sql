-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2019 at 11:30 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `hak_akses` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `hak_akses`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `harga`
--

CREATE TABLE `harga` (
  `harga_per_kilo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `harga`
--

INSERT INTO `harga` (`harga_per_kilo`) VALUES
(5000);

-- --------------------------------------------------------

--
-- Table structure for table `pakaian`
--

CREATE TABLE `pakaian` (
  `pakaian_id` int(11) NOT NULL,
  `pakaian_transaksi` int(11) NOT NULL,
  `pakaian_jenis` varchar(11) NOT NULL,
  `pakaian_jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pakaian`
--

INSERT INTO `pakaian` (`pakaian_id`, `pakaian_transaksi`, `pakaian_jenis`, `pakaian_jumlah`) VALUES
(1, 6, 'celana', 0),
(2, 6, 'topi', 0),
(3, 12, 'Array', 0),
(4, 12, 'Array', 0),
(9, 15, 'celana', 3),
(10, 15, 'topi', 2),
(14, 20, 'patu', 12),
(15, 20, 'sendal', 3),
(16, 20, 'songkok', 2),
(20, 30, 'celanax', 3),
(21, 30, 'bajux', 0),
(26, 30, 'sendalx', 2),
(27, 30, 'tambah', 10),
(28, 27, '', 0),
(29, 27, '', 0),
(30, 31, 'songko', 3),
(31, 31, 'baju', 2),
(32, 31, 'sepatu', 1),
(33, 32, 'seprai', 2),
(34, 32, 'kaos kutang', 2),
(35, 33, 'seprai', 2),
(36, 33, 'kaos kutang', 2),
(37, 34, 'celana luar', 2),
(38, 34, 'topi', 1),
(39, 35, 'xxxxx', 0),
(40, 36, 'dsdsada', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(255) NOT NULL,
  `pelanggan_hp` varchar(20) NOT NULL,
  `pelanggan_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_hp`, `pelanggan_alamat`) VALUES
(1, 'Fahrudin Aray', '0893840230', 'Kp. Bogor desa setia asih Tarumajaya'),
(2, 'Deny Wahyudi', '08948594849', 'Gg. Becek jalan samudra'),
(31, 'ari', '089384', 'asjdkf'),
(34, 'umam', '4234324', 'bgfdgr'),
(35, 'abi', '123', 'aser'),
(36, 'aswq', '123', 'cxcsdcd'),
(37, 'sdsdew', '1212321', 'cxzcsdc');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tgl` date NOT NULL,
  `transaksi_pelanggan` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL,
  `transaksi_berat` int(11) NOT NULL,
  `transaksi_tgl_selesai` date NOT NULL,
  `transaksi_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tgl`, `transaksi_pelanggan`, `transaksi_harga`, `transaksi_berat`, `transaksi_tgl_selesai`, `transaksi_status`) VALUES
(1, '0000-00-00', 1, 2147483647, 0, '0000-00-00', 0),
(6, '2018-11-03', 2, 26000, 4, '2018-11-08', 0),
(17, '2018-11-10', 1, 13000, 2, '2018-11-10', 0),
(22, '2019-01-04', 2, 6500, 1, '2019-01-04', 0),
(24, '2019-01-04', 34, 13000, 2, '2019-01-10', 0),
(26, '2019-01-04', 36, 6500, 1, '2019-01-23', 0),
(27, '2019-01-11', 31, 6500, 2, '2019-01-10', 0),
(28, '2019-01-12', 1, 15000, 3, '2019-01-12', 1),
(30, '2019-01-25', 31, 30000, 6, '2019-01-26', 2),
(31, '2019-03-06', 37, 25000, 5, '2019-03-06', 0),
(32, '2019-03-06', 34, 15000, 3, '2019-03-08', 0),
(33, '2019-03-06', 34, 15000, 3, '2019-03-08', 0),
(34, '2019-03-06', 1, 15000, 3, '2019-03-07', 0),
(35, '2019-03-06', 35, 20000, 4, '2019-03-06', 0),
(36, '2019-03-06', 35, 10000, 2, '2019-03-06', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakaian`
--
ALTER TABLE `pakaian`
  ADD PRIMARY KEY (`pakaian_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `transaksi_pelanggan` (`transaksi_pelanggan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pakaian`
--
ALTER TABLE `pakaian`
  MODIFY `pakaian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_pelanggan` FOREIGN KEY (`transaksi_pelanggan`) REFERENCES `pelanggan` (`pelanggan_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
