-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Bulan Mei 2025 pada 11.57
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jati`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `jenis_kayu`
--

CREATE TABLE `jenis_kayu` (
  `no` int(5) NOT NULL,
  `jenis_kayu` varchar(50) NOT NULL,
  `deskripsi` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `jenis_kayu`
--

INSERT INTO `jenis_kayu` (`no`, `jenis_kayu`, `deskripsi`) VALUES
(1, 'Hevea', 'Kayu Hevea berasal dari pohon karet dengan serat halus dan tahan terhadap keausan'),
(2, 'Acacia', 'Kayu Acacia memiliki serat yang kuat dan berwarna cokelat keemasan'),
(3, 'Sungkai', 'Kayu Sungkai ringan dengan serat halus, cocok untuk perabotan dan panel kayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pabrik`
--

CREATE TABLE `pabrik` (
  `no` int(5) NOT NULL,
  `nama_pabrik` varchar(20) NOT NULL,
  `lokasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pabrik`
--

INSERT INTO `pabrik` (`no`, `nama_pabrik`, `lokasi`) VALUES
(1, 'Pabrik A', 'Semarang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `no` int(11) NOT NULL,
  `nama_pabrik` varchar(100) DEFAULT NULL,
  `jenis_kayu` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jumlah_m3` int(11) DEFAULT NULL,
  `harga_per_m3` int(11) DEFAULT NULL,
  `pembeli` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`no`, `nama_pabrik`, `jenis_kayu`, `tanggal`, `jumlah_m3`, `harga_per_m3`, `pembeli`) VALUES
(1, 'Pabrik A', 'Hevea', '2024-03-05', 200, 150, 'Company X'),
(2, 'Pabrik A', 'Acacia', '2024-03-08', 100, 200, 'Company Y'),
(3, 'Pabrik A', 'Sungkai', '2024-03-12', 300, 180, 'Retail Store'),
(4, 'Pabrik A', 'Hevea', '2024-03-18', 400, 160, 'Wholesale Inc'),
(5, 'Pabrik A', 'Acacia', '2024-03-22', 150, 210, 'Furniture World'),
(6, 'Pabrik A', 'Sungkai', '2024-03-28', 250, 190, 'Interior Designs'),
(7, 'Pabrik A', 'Hevea', '2024-04-02', 300, 155, 'Home Depot'),
(8, 'Pabrik A', 'Acacia', '2024-04-08', 180, 220, 'Construction Co'),
(9, 'Pabrik A', 'Sungkai', '2025-04-14', 350, 195, 'Office Supplies Ltd'),
(10, 'Pabrik A', 'Hevea', '2024-04-20', 250, 160, 'Wholesale Inc'),
(11, 'Pabrik A', 'Acacia', '2024-04-25', 120, 225, 'Furniture World'),
(12, 'Pabrik A', 'Sungkai', '2025-05-02', 280, 200, 'Retail Store'),
(13, 'Pabrik A', 'Hevea', '2025-05-08', 350, 165, 'Home Depot'),
(14, 'Pabrik A', 'Acacia', '2025-05-15', 200, 230, 'Construction Co'),
(15, 'Pabrik A', 'Sungkai', '2025-05-22', 300, 205, 'Interior Designs'),
(16, 'Pabrik A', 'Hevea', '2025-05-28', 400, 170, 'Office SuppliesLtd'),
(17, 'Pabrik A', 'Acacia', '2025-06-03', 180, 240, 'Furniture Word'),
(18, 'Pabrik A', 'Hevea', '2024-06-08', 300, 170, 'Home Depot'),
(19, 'Pabrik A', 'Acacia', '2024-06-12', 150, 220, 'Furniture World'),
(20, 'Pabrik A', 'Sungkai ', '2024-06-18', 250, 195, 'Interior Designs'),
(21, 'Pabrik A', 'Hevea', '2024-06-22', 350, 175, 'Retail Store'),
(22, 'Pabrik A', 'Acacia', '2024-06-28', 180, 230, 'Construction Co');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produksi`
--

CREATE TABLE `produksi` (
  `no` int(5) NOT NULL,
  `nama_pabrik` varchar(250) NOT NULL,
  `jenis_kayu` varchar(250) NOT NULL,
  `tanggal_produksi` date NOT NULL,
  `jumlah_m3` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `produksi`
--

INSERT INTO `produksi` (`no`, `nama_pabrik`, `jenis_kayu`, `tanggal_produksi`, `jumlah_m3`) VALUES
(1, 'Pabrik A', 'Hevea', '2024-03-01', 500),
(2, 'Pabrik A', 'Acacia', '2024-03-05', 300),
(3, 'Pabrik A', 'Sungkai', '2024-03-10', 450),
(4, 'Pabrik A', 'Hevea', '2024-03-15', 600),
(5, 'Pabrik A', 'Acacia', '2024-03-20', 400),
(6, 'Pabrik A', 'Sungkai', '2024-03-25', 550),
(7, 'Pabrik A', 'Hevea', '2024-04-01', 700),
(8, 'Pabrik A', 'Acacia', '2024-05-04', 350),
(9, 'Pabrik A', 'Sungkai', '2024-04-10', 480),
(10, 'Pabrik A', 'Hevea', '2024-04-15', 550),
(11, 'Pabrik A', 'Acacia', '2024-05-20', 420),
(12, 'Pabrik A', 'Sungkai', '2024-04-25', 580),
(13, 'Pabrik A', 'Hevea', '2024-05-01', 600),
(14, 'Pabrik A', 'Acacia', '2024-05-05', 380),
(15, 'Pabrik A', 'Sungkai', '2024-05-10', 650),
(16, 'Pabrik A', 'Hevea', '2024-05-15', 650),
(17, 'Pabrik A', 'Acacia', '2024-05-20', 300),
(18, 'Pabrik A', 'Sungkai', '2024-06-10', 480),
(19, 'Pabrik A', 'Hevea', '2024-06-15', 550),
(20, 'Pabrik A', 'Acacia', '2024-06-20', 420),
(21, 'Pabrik A', 'Sungkai', '2024-06-25', 580);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `jenis_kayu`
--
ALTER TABLE `jenis_kayu`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `pabrik`
--
ALTER TABLE `pabrik`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no`);

--
-- Indeks untuk tabel `produksi`
--
ALTER TABLE `produksi`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jenis_kayu`
--
ALTER TABLE `jenis_kayu`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pabrik`
--
ALTER TABLE `pabrik`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `produksi`
--
ALTER TABLE `produksi`
  MODIFY `no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
