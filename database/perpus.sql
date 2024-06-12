SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

CREATE TABLE `manajer` (
    `id_manajer` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(50) NOT NULL,
    `password` VARCHAR(50) NOT NULL,
    `nama` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id_manajer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `manajer` (`id_manajer`, `username`, `password`, `nama`) VALUES
(1, 'manajer', 'c21422354a901fb890163829ae175294', 'manajer');

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(45) NOT NULL,
  `nama` varchar(35) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `admin` (`id_admin`, `username`, `password`, `nama`) VALUES
(1, 'admin', 'c21422354a901fb890163829ae175294', 'Admin');

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(25) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `ttl` varchar(150) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_berakhir` date NOT NULL,
  `status_aktif` enum('0','1') NOT NULL,
  PRIMARY KEY (`id_anggota`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `anggota` (`id_anggota`, `uid`, `nama`, `ttl`, `tgl_daftar`, `tgl_berakhir`, `status_aktif`) VALUES
(1, '1464102031', 'Siswa test', 'Demak, 16 Mei 1993', '2016-05-12', '2016-07-12', '0'),
(2, '1464102032', 'Roisul Musthofa', 'Demak, 16 Mei 1993', '2016-04-28', '2016-06-04', '1'),
(4, '1464102033', 'Eka Bella 123', 'Kendal, 17 Juli 1993', '2016-05-06', '2016-05-24', '1'),
(5, '1464102034', 'Eko Hardiyanto', 'Kendal, 17 Juli 1993', '2016-05-06', '2016-06-23', '1');

CREATE TABLE `buku` (
  `id_buku` int(5) NOT NULL AUTO_INCREMENT,
  `uid_buku` varchar(25) NOT NULL DEFAULT '0',
  `judul` varchar(50) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `tahun` year(4) NOT NULL,
  `stok` int(2) NOT NULL,
  `rak` int(2) NOT NULL,
  `kategori` int(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_buku`),
  UNIQUE KEY `uid_buku` (`uid_buku`),
  KEY `FK__rak` (`rak`),
  KEY `FK__kategori` (`kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `buku` (`id_buku`, `uid_buku`, `judul`, `pengarang`, `penerbit`, `isbn`, `tahun`, `stok`, `rak`, `kategori`, `created_at`) VALUES
(1, '1464171409', 'Bahasa dan Sastra', 'Roisul Musthofa', 'Gramedia', '12345678', '2014', 6, 1, 2, '2016-05-25 09:47:46');

CREATE TABLE `denda` (
  `id_denda` int(1) NOT NULL AUTO_INCREMENT,
  `nominal` int(4) NOT NULL,
  PRIMARY KEY (`id_denda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `denda` (`id_denda`, `nominal`) VALUES
(5, 500);

CREATE TABLE `kategori` (
  `id_kategori` int(2) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(30) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Bahasa'),
(2, 'IPA'),
(3, 'IPS'),
(4, 'Matematika'),
(5, 'Seni');

CREATE TABLE `pendapatan` (
  `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `total` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_pendapatan`),
  KEY `FK_pendapatan_transaksi` (`transaksi_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pendapatan` (`id_pendapatan`, `transaksi_id`, `total`, `created_at`) VALUES
(1, 5, 500, '2016-06-01 12:15:28');

CREATE TABLE `rak` (
  `id_rak` int(2) NOT NULL AUTO_INCREMENT,
  `nama_rak` varchar(10) NOT NULL,
  PRIMARY KEY (`id_rak`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `rak` (`id_rak`, `nama_rak`) VALUES
(1, '1A'),
(2, '2A');

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `buku_id` int(5) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status_kembali` enum('0','1') NOT NULL,
  `telat_per_hari` int(2) NOT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `FK__buku` (`buku_id`),
  KEY `FK__anggota` (`anggota_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transaksi` (`id_transaksi`, `buku_id`, `anggota_id`, `tgl_pinjam`, `tgl_kembali`, `status_kembali`, `telat_per_hari`) VALUES
(1, 1, 4, '2016-05-28', '2016-05-31', '1', 1),
(2, 1, 5, '2016-05-28', '2016-06-04', '1', -3),
(3, 1, 2, '2016-05-28', '2016-06-04', '0', 0),
(4, 1, 2, '2016-05-28', '2016-06-04', '0', 0),
(5, 1, 4, '2016-05-29', '2016-05-31', '1', 1);

ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `buku`
  MODIFY `id_buku` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `denda`
  MODIFY `id_denda` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `kategori`
  MODIFY `id_kategori` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `pendapatan`
  MODIFY `id_pendapatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `rak`
  MODIFY `id_rak` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `buku`
  ADD CONSTRAINT `FK__kategori` FOREIGN KEY (`kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__rak` FOREIGN KEY (`rak`) REFERENCES `rak` (`id_rak`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `pendapatan`
  ADD CONSTRAINT `FK_pendapatan_transaksi` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK__anggota` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id_anggota`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK__buku` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;


