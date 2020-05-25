-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 27 Agu 2019 pada 00.30
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` varchar(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL,
  `bobot_kriteria` double NOT NULL,
  `minmax` varchar(10) NOT NULL,
  `tipe_preferensi` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `tipe_kriteria`, `bobot_kriteria`, `minmax`, `tipe_preferensi`) VALUES
('K01', 'Modal Awal', 'cost', 0.25, 'max', 1),
('K02', 'Biaya Operasional', 'cost', 0.3, 'max', 1),
('K03', 'Lama Panen', 'cost', 0.15, 'max', 1),
('K04', 'Harga Jual', 'benefit', 0.25, 'max', 1),
('K05', 'Keuntungan', 'benefit', 0.05, 'max', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilaikriteria`
--

CREATE TABLE `nilaikriteria` (
  `id_tanaman` varchar(11) NOT NULL,
  `id_kriteria` varchar(11) NOT NULL,
  `nilai_kriteria` double NOT NULL,
  `nilai_normalisasi` double NOT NULL,
  `bobot_normalisasi` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nilaikriteria`
--

INSERT INTO `nilaikriteria` (`id_tanaman`, `id_kriteria`, `nilai_kriteria`, `nilai_normalisasi`, `bobot_normalisasi`) VALUES
('A01', 'K01', 891000, 0.85409652076319, 0.2135241301908),
('A01', 'K02', 284000, 0.52464788732394, 0.15739436619718),
('A01', 'K03', 90, 0.27777777777778, 0.041666666666667),
('A01', 'K04', 15000, 0.6, 0.15),
('A01', 'K05', 166000, 0.5886524822695, 0.029432624113475),
('A02', 'K01', 1183000, 0.64327979712595, 0.16081994928149),
('A02', 'K02', 230000, 0.64782608695652, 0.19434782608696),
('A02', 'K03', 90, 0.27777777777778, 0.041666666666667),
('A02', 'K04', 25000, 1, 0.25),
('A02', 'K05', 145000, 0.51418439716312, 0.025709219858156),
('A03', 'K01', 976000, 0.7797131147541, 0.19492827868852),
('A03', 'K02', 268000, 0.55597014925373, 0.16679104477612),
('A03', 'K03', 40, 0.625, 0.09375),
('A03', 'K04', 12000, 0.48, 0.12),
('A03', 'K05', 152000, 0.53900709219858, 0.026950354609929),
('A04', 'K01', 1011000, 0.75272007912957, 0.18818001978239),
('A04', 'K02', 196000, 0.76020408163265, 0.2280612244898),
('A04', 'K03', 30, 0.83333333333333, 0.125),
('A04', 'K04', 12000, 0.48, 0.12),
('A04', 'K05', 164000, 0.58156028368794, 0.029078014184397),
('A05', 'K01', 1211000, 0.62840627580512, 0.15710156895128),
('A05', 'K02', 149000, 1, 0.3),
('A05', 'K03', 60, 0.41666666666667, 0.0625),
('A05', 'K04', 15000, 0.6, 0.15),
('A05', 'K05', 106000, 0.3758865248227, 0.018794326241135),
('A06', 'K01', 1281000, 0.59406713505074, 0.14851678376269),
('A06', 'K02', 255000, 0.5843137254902, 0.17529411764706),
('A06', 'K03', 40, 0.625, 0.09375),
('A06', 'K04', 10000, 0.4, 0.1),
('A06', 'K05', 125000, 0.44326241134752, 0.022163120567376),
('A07', 'K01', 1041000, 0.73102785782901, 0.18275696445725),
('A07', 'K02', 166000, 0.89759036144578, 0.26927710843373),
('A07', 'K03', 45, 0.55555555555556, 0.083333333333333),
('A07', 'K04', 15000, 0.6, 0.15),
('A07', 'K05', 134000, 0.47517730496454, 0.023758865248227),
('A08', 'K01', 761000, 1, 0.25),
('A08', 'K02', 168000, 0.88690476190476, 0.26607142857143),
('A08', 'K03', 25, 1, 0.15),
('A08', 'K04', 15000, 0.6, 0.15),
('A08', 'K05', 282000, 1, 0.05),
('A09', 'K01', 776000, 0.98067010309278, 0.2451675257732),
('A09', 'K02', 168000, 0.88690476190476, 0.26607142857143),
('A09', 'K03', 30, 0.83333333333333, 0.125),
('A09', 'K04', 10000, 0.4, 0.1),
('A09', 'K05', 132000, 0.46808510638298, 0.023404255319149),
('A10', 'K01', 991000, 0.76791120080727, 0.19197780020182),
('A10', 'K02', 248000, 0.6008064516129, 0.18024193548387),
('A10', 'K03', 60, 0.41666666666667, 0.0625),
('A10', 'K04', 15000, 0.6, 0.15),
('A10', 'K05', 127000, 0.45035460992908, 0.022517730496454),
('A11', 'K01', 941000, 0.80871413390011, 0.20217853347503),
('A11', 'K02', 193000, 0.7720207253886, 0.23160621761658),
('A11', 'K03', 45, 0.55555555555556, 0.083333333333333),
('A11', 'K04', 15000, 0.6, 0.15),
('A11', 'K05', 257000, 0.9113475177305, 0.045567375886525),
('A12', 'K01', 891000, 0.85409652076319, 0.2135241301908),
('A12', 'K02', 240000, 0.62083333333333, 0.18625),
('A12', 'K03', 60, 0.41666666666667, 0.0625),
('A12', 'K04', 12000, 0.48, 0.12),
('A12', 'K05', 120000, 0.42553191489362, 0.021276595744681);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanaman`
--

CREATE TABLE `tanaman` (
  `id_tanaman` varchar(11) NOT NULL,
  `nama_tanaman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tanaman`
--

INSERT INTO `tanaman` (`id_tanaman`, `nama_tanaman`) VALUES
('A01', 'Tanaman Bawang Merah'),
('A02', 'Tanaman Cabai Rawit Hijau '),
('A03', 'Tanaman Sawi Hijau'),
('A04', 'Tanaman Terong Bulat Hijau'),
('A05', 'Tanaman Oyong/Gambas'),
('A06', 'Tanaman Ketimun'),
('A07', 'Tanaman Kacang Panjang'),
('A08', 'Tanaman Bayam'),
('A09', 'Tanaman Kangkung'),
('A10', 'Tanaman Tomat'),
('A11', 'Tanaman Kembang Kol'),
('A12', 'Tanaman Peria/Pare');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` varchar(20) NOT NULL,
  `user_level` varchar(20) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `user_level`, `nama_lengkap`, `username`, `password`) VALUES
('U01', 'koordinator', 'wahyudin', 'wahyudin', 'c4ca4238a0b923820dcc509a6f75849b'),
('U02', 'petani', 'yogi', 'yogi', 'c4ca4238a0b923820dcc509a6f75849b');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `nilaikriteria`
--
ALTER TABLE `nilaikriteria`
  ADD PRIMARY KEY (`id_tanaman`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `tanaman`
--
ALTER TABLE `tanaman`
  ADD PRIMARY KEY (`id_tanaman`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `nilaikriteria`
--
ALTER TABLE `nilaikriteria`
  ADD CONSTRAINT `nilaikriteria_ibfk_1` FOREIGN KEY (`id_tanaman`) REFERENCES `tanaman` (`id_tanaman`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nilaikriteria_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
