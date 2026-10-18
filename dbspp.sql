-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jan 2025 pada 23.42
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbspp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kelas`
--

CREATE TABLE `tb_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_kelas`
--

INSERT INTO `tb_kelas` (`id_kelas`, `nama_kelas`, `kompetensi_keahlian`) VALUES
(46, '10', 'Administrasi Perkantoran'),
(47, '10', 'Akuntansi'),
(48, '10', 'Rekayasa Perangkat Lunak'),
(49, '10', 'Teknik Bisnis Sepeda Motor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  `nisn` char(10) NOT NULL,
  `bulan` varchar(20) NOT NULL,
  `nobayar` varchar(20) DEFAULT NULL,
  `jatuh_tempo` date NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `ket` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_petugas`, `nisn`, `bulan`, `nobayar`, `jatuh_tempo`, `tgl_bayar`, `id_spp`, `jumlah_bayar`, `ket`) VALUES
(61, 2, '12345', 'Januari 2025', '2501210000', '2025-01-10', '2025-01-21', 2, 175000, 'LUNAS'),
(62, 2, '12345', 'Februari 2025', '2501210001', '2025-02-10', '2025-01-21', 2, 175000, 'LUNAS'),
(63, 2, '12345', 'Maret 2025', '2501210002', '2025-03-10', '2025-01-21', 2, 175000, 'LUNAS'),
(64, 7, '12345', 'April 2025', '2501210003', '2025-04-10', '2025-01-21', 2, 175000, 'LUNAS'),
(65, NULL, '12345', 'Mei 2025', NULL, '2025-05-10', NULL, 2, 175000, 'BELUM BAYAR'),
(66, NULL, '12345', 'Juni 2025', NULL, '2025-06-10', NULL, 2, 175000, 'BELUM BAYAR'),
(67, NULL, '12345', 'Juli 2025', NULL, '2025-07-10', NULL, 2, 175000, 'BELUM BAYAR'),
(68, NULL, '12345', 'Agustus 2025', NULL, '2025-08-10', NULL, 2, 175000, 'BELUM BAYAR'),
(69, NULL, '12345', 'September 2025', NULL, '2025-09-10', NULL, 2, 175000, 'BELUM BAYAR'),
(70, NULL, '12345', 'Oktober 2025', NULL, '2025-10-10', NULL, 2, 175000, 'BELUM BAYAR'),
(71, NULL, '12345', 'November 2025', NULL, '2025-11-10', NULL, 2, 175000, 'BELUM BAYAR'),
(72, NULL, '12345', 'Desember 2025', NULL, '2025-12-10', NULL, 2, 175000, 'BELUM BAYAR');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `id_petugas` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_petugas` varchar(35) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_petugas`
--

INSERT INTO `tb_petugas` (`id_petugas`, `username`, `password`, `nama_petugas`, `alamat`, `telepon`, `level`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '---', '087821485664', 'admin'),
(7, 'petugas', 'afb91ef692fd08c445e8cb1bab2ccf9c', 'petugas', 'petugas', '0800000000', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nisn` char(10) NOT NULL,
  `nis` char(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_siswa`
--

INSERT INTO `tb_siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_hp`, `id_spp`) VALUES
('12345', '1234', 'siswa', 47, 'sekolah', '08123456789', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_spp`
--

CREATE TABLE `tb_spp` (
  `id_spp` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_spp`
--

INSERT INTO `tb_spp` (`id_spp`, `tahun`, `nominal`) VALUES
(1, 2019, 200000),
(2, 2018, 175000),
(5, 2021, 250000),
(6, 2022, 275000),
(8, 2019, 190000),
(9, 2000, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `nisn` (`nisn`),
  ADD KEY `id_petugas` (`id_petugas`),
  ADD KEY `id_spp` (`id_spp`);

--
-- Indeks untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nisn`),
  ADD KEY `id_spp` (`id_spp`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indeks untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_kelas`
--
ALTER TABLE `tb_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT untuk tabel `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_spp`
--
ALTER TABLE `tb_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_3` FOREIGN KEY (`nisn`) REFERENCES `tb_siswa` (`nisn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_4` FOREIGN KEY (`id_petugas`) REFERENCES `tb_petugas` (`id_petugas`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_pembayaran_ibfk_5` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `tb_siswa_ibfk_2` FOREIGN KEY (`id_spp`) REFERENCES `tb_spp` (`id_spp`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_siswa_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `tb_kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
