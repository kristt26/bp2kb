-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2021 at 11:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendataan_penduduk`
--

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id` int(11) NOT NULL,
  `keluargaid` int(11) NOT NULL,
  `pertanyaanid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kecamatans`
--

CREATE TABLE `kecamatans` (
  `id` int(11) NOT NULL,
  `kecamatan` varchar(45) NOT NULL,
  `jenis` enum('Kecamatan','Distrik') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kecamatans`
--

INSERT INTO `kecamatans` (`id`, `kecamatan`, `jenis`) VALUES
(1, 'Kaureh', 'Kecamatan'),
(2, 'Airu', 'Kecamatan'),
(3, 'Yapsi', 'Kecamatan'),
(4, 'Kemtuk', 'Kecamatan'),
(5, 'Kemtuk Gresi', 'Kecamatan'),
(6, 'Gresi Selatan', 'Kecamatan'),
(7, 'Nimboran', 'Kecamatan'),
(8, 'Nimboran Timur / Namblong', 'Kecamatan'),
(9, 'Nimbokrang', 'Kecamatan'),
(10, 'Unurum Guay', 'Kecamatan'),
(11, 'Demta', 'Kecamatan'),
(12, 'Yokari', 'Kecamatan'),
(13, 'Depapre', 'Kecamatan'),
(14, 'Ravenirara', 'Kecamatan'),
(15, 'Sentani Barat', 'Kecamatan'),
(16, 'Waibu', 'Kecamatan'),
(17, 'Sentani', 'Kecamatan'),
(18, 'Ebungfau', 'Kecamatan'),
(19, 'Sentani Timur', 'Kecamatan');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `id` int(11) NOT NULL,
  `rtid` int(11) NOT NULL,
  `jumlahanggora` int(11) NOT NULL,
  `kontak` varchar(45) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kelurahans`
--

CREATE TABLE `kelurahans` (
  `id` int(11) NOT NULL,
  `kelurahan` varchar(45) DEFAULT NULL,
  `jenis` enum('Kalurahan','Desa','Kampung') DEFAULT NULL,
  `kecamatanid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kelurahans`
--

INSERT INTO `kelurahans` (`id`, `kelurahan`, `jenis`, `kecamatanid`) VALUES
(1, 'Soskotek', 'Desa', 1),
(2, 'Lapua', 'Desa', 1),
(3, 'Umbron', 'Desa', 1),
(4, 'Yadauw', 'Desa', 1),
(5, 'Pagai', 'Desa', 2),
(6, 'Hulu Atas', 'Desa', 2),
(7, 'Aurina', 'Desa', 2),
(8, 'Muara Nawa', 'Desa', 2),
(9, 'Kamikaru', 'Desa', 2),
(10, 'Naira', 'Desa', 2),
(11, 'Tabbeyan', 'Desa', 3),
(12, 'Ongan Jaya', 'Desa', 3),
(13, 'Kwarja', 'Desa', 3),
(14, 'Bumi Sahaja', 'Desa', 3),
(15, 'Nawa Mulya', 'Desa', 3),
(16, 'Nawa Mukti', 'Desa', 3),
(17, 'Takwa Bangun', 'Desa', 3),
(18, 'Purnawa Jati', 'Desa', 3),
(19, 'Kwansu', 'Desa', 4),
(20, 'Nambon', 'Desa', 4),
(21, 'Namei', 'Desa', 4),
(22, 'Mamda', 'Desa', 4),
(23, 'Mandayawan', 'Desa', 4),
(24, 'Sama', 'Desa', 4),
(25, 'Soaib', 'Desa', 4),
(26, 'Sabeab Kecil', 'Desa', 4),
(27, 'Sekori', 'Desa', 4),
(28, 'Skoaim', 'Desa', 4),
(29, 'Aib', 'Desa', 4),
(30, 'Bengguin Progo', 'Desa', 4),
(31, 'Nembugresi', 'Desa', 5),
(32, 'Ibub', 'Desa', 5),
(33, 'Hatib', 'Desa', 5),
(34, 'Bring', 'Desa', 5),
(35, 'Pupehabu', 'Desa', 5),
(36, 'Damoi Kati', 'Desa', 5),
(37, 'Demetim', 'Desa', 5),
(38, 'Yanbra', 'Desa', 5),
(39, 'Braso', 'Desa', 5),
(40, 'Hyansip', 'Desa', 5),
(41, 'Jagrang', 'Desa', 5),
(42, 'Swentab', 'Desa', 5),
(43, 'Klaisu', 'Desa', 6),
(44, 'Bangai', 'Desa', 6),
(45, 'Iwon', 'Desa', 6),
(46, 'Omon', 'Desa', 6),
(47, 'Oyengsi', 'Desa', 7),
(48, 'Singgriway', 'Desa', 7),
(49, 'Tabri', 'Desa', 7),
(50, 'Singgri', 'Desa', 7),
(51, 'Benyom', 'Desa', 7),
(52, 'Kuipons', 'Desa', 7),
(53, 'Imsar', 'Desa', 7),
(54, 'Kaitemung', 'Desa', 7),
(55, 'Kuwase', 'Desa', 7),
(56, 'Pobaim', 'Desa', 7),
(57, 'Yenggu Baru', 'Desa', 7),
(58, 'Sanggai', 'Desa', 8),
(59, 'Sarmai Atas', 'Desa', 8),
(60, 'Sarmai Bawah', 'Desa', 8),
(61, 'Yakasib', 'Desa', 8),
(62, 'Karya Bumi', 'Desa', 8),
(63, 'Imestum', 'Desa', 8),
(64, 'Hanggai Hamong', 'Desa', 8),
(65, 'Benyom Jaya I', 'Desa', 9),
(66, 'Benyom Jaya Ii', 'Desa', 9),
(67, 'Nembukrang', 'Desa', 9),
(68, 'Nimbokrang Sari', 'Desa', 9),
(69, 'Berab', 'Desa', 9),
(70, 'Wahab', 'Desa', 9),
(71, 'Hamongkrang', 'Desa', 9),
(72, 'Bunyom', 'Desa', 9),
(73, 'Rhepang Muaib', 'Desa', 9),
(74, 'Guriyad', 'Desa', 10),
(75, 'Sentosa', 'Desa', 10),
(76, 'Beneik', 'Desa', 10),
(77, 'Garusa', 'Desa', 10),
(78, 'Sawesuma', 'Desa', 10),
(79, 'Nandalzi', 'Desa', 10),
(80, 'Kamdera', 'Desa', 11),
(81, 'Muaif', 'Desa', 11),
(82, 'Ambora', 'Desa', 11),
(83, 'Yaugapsa', 'Desa', 11),
(84, 'Demta Kota', 'Desa', 11),
(85, 'Yakore', 'Desa', 11),
(86, 'Muris Kecil', 'Desa', 11),
(87, 'Maruway', 'Desa', 12),
(88, 'Meukisi', 'Desa', 12),
(89, 'Endokisi', 'Desa', 12),
(90, 'Snamai', 'Desa', 12),
(91, 'Buseryo', 'Desa', 12),
(92, 'Kendate', 'Desa', 13),
(93, 'Entiyebo', 'Desa', 13),
(94, 'Waiya', 'Desa', 13),
(95, 'Tablasupa', 'Desa', 13),
(96, 'Yepase', 'Desa', 13),
(97, 'Wambena', 'Desa', 13),
(98, 'Yewena', 'Desa', 13),
(99, 'Doromena', 'Desa', 13),
(100, 'Yongsu Sapari', 'Desa', 14),
(101, 'Yongsu Dosoyo', 'Desa', 14),
(102, 'Ormuwari', 'Desa', 14),
(103, 'Necheibe (nehiba / Nacha Tawa)', 'Desa', 14),
(104, 'Sabron Sari', 'Desa', 15),
(105, 'Sabron Yoru', 'Desa', 15),
(106, 'Dosai', 'Desa', 15),
(107, 'Waibron', 'Desa', 15),
(108, 'Maribu', 'Desa', 15),
(109, 'Dondai', 'Desa', 16),
(110, 'Kwadeware', 'Desa', 16),
(111, 'Yakonde', 'Desa', 16),
(112, 'Sosiri', 'Desa', 16),
(113, 'Doyo Lama', 'Desa', 16),
(114, 'Doyo Baru', 'Desa', 16),
(115, 'Bambar', 'Desa', 16),
(116, 'Hobong', 'Desa', 17),
(117, 'Ifale / Ajau', 'Desa', 17),
(118, 'Yoboy / Kehusa / Kehiran', 'Desa', 17),
(119, 'Dobonsolo', 'Desa', 17),
(120, 'Yobeh', 'Desa', 17),
(121, 'Ifar Besar', 'Desa', 17),
(122, 'Sentani Kota', 'Desa', 17),
(123, 'Hinekombe', 'Desa', 17),
(124, 'Yahim', 'Desa', 17),
(125, 'Babrongko', 'Desa', 18),
(126, 'Simporo', 'Desa', 18),
(127, 'Khameyaka', 'Desa', 18),
(128, 'Atabar', 'Desa', 18),
(129, 'Ebungfa', 'Desa', 18),
(130, 'Puai', 'Desa', 19),
(131, 'Itakiwa', 'Desa', 19),
(132, 'Asei Besar', 'Desa', 19),
(133, 'Asei Kecil', 'Desa', 19),
(134, 'Nolokla', 'Desa', 19),
(135, 'Nendali', 'Desa', 19),
(136, 'Yokiwa', 'Desa', 19);

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `keluargaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rt`
--

CREATE TABLE `rt` (
  `id` int(11) NOT NULL,
  `rt` varchar(45) NOT NULL,
  `rwid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rw`
--

CREATE TABLE `rw` (
  `id` int(11) NOT NULL,
  `rw` varchar(45) NOT NULL,
  `kelurahansid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usersinroles`
--

CREATE TABLE `usersinroles` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `roleid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `wilayahkerja`
--

CREATE TABLE `wilayahkerja` (
  `id` int(11) NOT NULL,
  `kelurahanid` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jawaban_pertanyaan1_idx` (`pertanyaanid`),
  ADD KEY `fk_jawaban_keluarga1_idx` (`keluargaid`);

--
-- Indexes for table `kecamatans`
--
ALTER TABLE `kecamatans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_keluarga_rt1_idx` (`rtid`);

--
-- Indexes for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_kelurahans_kecamatans1_idx` (`kecamatanid`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_penduduk_keluarga1_idx` (`keluargaid`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_petugas_users1_idx` (`users_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rt`
--
ALTER TABLE `rt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rt_rw1_idx` (`rwid`);

--
-- Indexes for table `rw`
--
ALTER TABLE `rw`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_rw_kelurahans1_idx` (`kelurahansid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usersinroles`
--
ALTER TABLE `usersinroles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usersinroles_users_idx` (`userid`),
  ADD KEY `fk_usersinroles_roles1_idx` (`roleid`);

--
-- Indexes for table `wilayahkerja`
--
ALTER TABLE `wilayahkerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_wilayahkerja_kelurahans1_idx` (`kelurahanid`),
  ADD KEY `fk_wilayahkerja_petugas1_idx` (`petugas_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kecamatans`
--
ALTER TABLE `kecamatans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelurahans`
--
ALTER TABLE `kelurahans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rt`
--
ALTER TABLE `rt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rw`
--
ALTER TABLE `rw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usersinroles`
--
ALTER TABLE `usersinroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayahkerja`
--
ALTER TABLE `wilayahkerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `fk_jawaban_keluarga1` FOREIGN KEY (`keluargaid`) REFERENCES `keluarga` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jawaban_pertanyaan1` FOREIGN KEY (`pertanyaanid`) REFERENCES `pertanyaan` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `fk_keluarga_rt1` FOREIGN KEY (`rtid`) REFERENCES `rt` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `kelurahans`
--
ALTER TABLE `kelurahans`
  ADD CONSTRAINT `fk_kelurahans_kecamatans1` FOREIGN KEY (`kecamatanid`) REFERENCES `kecamatans` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `fk_penduduk_keluarga1` FOREIGN KEY (`keluargaid`) REFERENCES `keluarga` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `fk_petugas_users1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rt`
--
ALTER TABLE `rt`
  ADD CONSTRAINT `fk_rt_rw1` FOREIGN KEY (`rwid`) REFERENCES `rw` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rw`
--
ALTER TABLE `rw`
  ADD CONSTRAINT `fk_rw_kelurahans1` FOREIGN KEY (`kelurahansid`) REFERENCES `kelurahans` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `usersinroles`
--
ALTER TABLE `usersinroles`
  ADD CONSTRAINT `fk_usersinroles_roles1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usersinroles_users` FOREIGN KEY (`userid`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `wilayahkerja`
--
ALTER TABLE `wilayahkerja`
  ADD CONSTRAINT `fk_wilayahkerja_kelurahans1` FOREIGN KEY (`kelurahanid`) REFERENCES `kelurahans` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_wilayahkerja_petugas1` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
