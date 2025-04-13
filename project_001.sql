-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.10.0.7000
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for project_001
CREATE DATABASE IF NOT EXISTS `project_001` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `project_001`;

-- Dumping structure for table project_001.cabang
CREATE TABLE IF NOT EXISTS `cabang` (
  `cabang_id` int(11) NOT NULL AUTO_INCREMENT,
  `cabang_nama` varchar(350) DEFAULT NULL,
  `cabang_alamat` text DEFAULT NULL,
  `cabang_notelp` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`cabang_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.cabang: ~0 rows (approximately)
INSERT INTO `cabang` (`cabang_id`, `cabang_nama`, `cabang_alamat`, `cabang_notelp`) VALUES
	(1, 'SMKN Budi Asih 2', 'Jl. MH Thamrin no 23', '091298739');

-- Dumping structure for table project_001.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.cache: ~0 rows (approximately)

-- Dumping structure for table project_001.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.cache_locks: ~0 rows (approximately)

-- Dumping structure for table project_001.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table project_001.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `jabatan_id` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan_nama` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`jabatan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.jabatan: ~3 rows (approximately)
INSERT INTO `jabatan` (`jabatan_id`, `jabatan_nama`) VALUES
	(1, 'Wali Kelas'),
	(2, 'Kepala Sekolah'),
	(4, 'Ketua Yayasan');

-- Dumping structure for table project_001.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.jobs: ~0 rows (approximately)

-- Dumping structure for table project_001.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.job_batches: ~0 rows (approximately)

-- Dumping structure for table project_001.karyawan
CREATE TABLE IF NOT EXISTS `karyawan` (
  `karyawan_id` int(11) NOT NULL AUTO_INCREMENT,
  `karyawan_nik` varchar(255) NOT NULL,
  `karyawan_nama` varchar(255) NOT NULL,
  `karyawan_cabang` varchar(255) DEFAULT NULL,
  `karyawan_email` varchar(255) NOT NULL,
  `karyawan_username` varchar(25) NOT NULL,
  `karyawan_password` varchar(35) NOT NULL,
  `karyawan_role` enum('User','Kepala Sekolah','Super Admin','Ketua Yayasan') NOT NULL DEFAULT 'User',
  `karyawan_aktif` enum('Aktif','Tidak Aktif') NOT NULL DEFAULT 'Aktif',
  `karyawan_numseq` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`karyawan_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- Dumping data for table project_001.karyawan: 5 rows
/*!40000 ALTER TABLE `karyawan` DISABLE KEYS */;
INSERT INTO `karyawan` (`karyawan_id`, `karyawan_nik`, `karyawan_nama`, `karyawan_cabang`, `karyawan_email`, `karyawan_username`, `karyawan_password`, `karyawan_role`, `karyawan_aktif`, `karyawan_numseq`) VALUES
	(22, 'US/2503-00001', 'Ahmad Sutedjodd', 'SMKN Budi Asih 2', 'a@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super Admin', 'Aktif', 1),
	(38, 'US/2504-00003', 'Kepsek', 'SMKN Budi Asih 2', 'bb', 'bb', '21ad0bd836b90d08f4cf640b4c298e7c', 'Kepala Sekolah', 'Aktif', 3),
	(37, 'US/2504-00002', 'aa', 'SMKN Budi Asih 2', 'aa', 'aa', '4124bc0a9335c27f086f24ba207a4912', 'User', 'Aktif', 2),
	(39, 'US/2504-00004', 'cc', NULL, 'cc', 'cc', 'e0323a9039add2978bf5b49550572c7c', 'Ketua Yayasan', 'Aktif', 4),
	(40, 'US/2504-00005', 'dd', 'SMKN Budi Asih 2', 'dd', 'dd', '1aabac6d068eef6a7bad3fdf50a05cc8', 'User', 'Aktif', 5);
/*!40000 ALTER TABLE `karyawan` ENABLE KEYS */;

-- Dumping structure for table project_001.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.migrations: ~3 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table project_001.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table project_001.peminjaman
CREATE TABLE IF NOT EXISTS `peminjaman` (
  `pinjam_id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjam_no` varchar(50) DEFAULT NULL,
  `pinjam_asset` int(11) DEFAULT NULL,
  `pinjam_jumlah` int(11) DEFAULT NULL,
  `pinjam_peminjam` int(11) DEFAULT NULL,
  `pinjam_cabang` varchar(350) DEFAULT NULL,
  `pinjam_tglpinjam` date DEFAULT NULL,
  `pinjam_estbalik` date DEFAULT NULL,
  `pinjam_tglbalik` date DEFAULT NULL,
  `pinjam_keterangan` text DEFAULT NULL,
  `pinjam_status` enum('Pending','Menunggu Persetujuan','Dikembalikan','Dipinjam','Ditolak') DEFAULT 'Pending',
  `pinjam_numseq` int(11) DEFAULT NULL,
  PRIMARY KEY (`pinjam_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.peminjaman: ~4 rows (approximately)
INSERT INTO `peminjaman` (`pinjam_id`, `pinjam_no`, `pinjam_asset`, `pinjam_jumlah`, `pinjam_peminjam`, `pinjam_cabang`, `pinjam_tglpinjam`, `pinjam_estbalik`, `pinjam_tglbalik`, `pinjam_keterangan`, `pinjam_status`, `pinjam_numseq`) VALUES
	(1, 'P-2504-00001', 1, NULL, 40, 'SMKN Budi Asih 2', '2025-04-03', '2025-04-10', '2025-04-03', NULL, 'Dikembalikan', 1),
	(2, 'P-2504-00002', 2, NULL, 40, 'SMKN Budi Asih 2', '2025-04-03', '2025-04-10', NULL, NULL, 'Dipinjam', 2),
	(3, 'P-2504-00003', 1, NULL, 40, 'SMKN Budi Asih 2', '2025-04-04', '2025-04-10', NULL, NULL, 'Dipinjam', 3),
	(4, 'P-2504-00004', 2, NULL, 37, 'SMKN Budi Asih 2', '2025-04-10', '2025-04-18', NULL, NULL, 'Menunggu Persetujuan', 4);

-- Dumping structure for table project_001.peminjaman_approval
CREATE TABLE IF NOT EXISTS `peminjaman_approval` (
  `pinjamappr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pinjamappr_no` varchar(50) DEFAULT NULL,
  `pinjamappr_person` int(11) DEFAULT NULL,
  `pinjamappr_cabang` varchar(350) DEFAULT NULL,
  `pinjamappr_scheme` int(11) DEFAULT NULL,
  `pinjamappr_role` varchar(150) DEFAULT NULL,
  `pinjamappr_dateapprv` date DEFAULT NULL,
  `pinjamappr_status` enum('Disetujui','Ditolak','Menunggu') DEFAULT NULL,
  PRIMARY KEY (`pinjamappr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.peminjaman_approval: ~6 rows (approximately)
INSERT INTO `peminjaman_approval` (`pinjamappr_id`, `pinjamappr_no`, `pinjamappr_person`, `pinjamappr_cabang`, `pinjamappr_scheme`, `pinjamappr_role`, `pinjamappr_dateapprv`, `pinjamappr_status`) VALUES
	(1, 'P-2504-00001', 37, 'SMKN Budi Asih 2', 1, 'Persetujuan Penanggung Jawab', '2025-04-03', 'Disetujui'),
	(2, 'P-2504-00001', 38, 'SMKN Budi Asih 2', 2, 'Persetujuan Kepala Sekolah', '2025-04-03', 'Disetujui'),
	(3, 'P-2504-00002', 38, 'SMKN Budi Asih 2', 1, 'Persetujuan Kepala Sekolah', '2025-04-03', 'Disetujui'),
	(4, 'P-2504-00003', 37, 'SMKN Budi Asih 2', 1, 'Persetujuan Penanggung Jawab', '2025-04-03', 'Disetujui'),
	(5, 'P-2504-00003', 38, 'SMKN Budi Asih 2', 2, 'Persetujuan Kepala Sekolah', '2025-04-03', 'Disetujui'),
	(6, 'P-2504-00004', 38, 'SMKN Budi Asih 2', 1, 'Persetujuan Kepala Sekolah', NULL, 'Menunggu');

-- Dumping structure for table project_001.pengadaan
CREATE TABLE IF NOT EXISTS `pengadaan` (
  `pengadaan_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengadaan_no` varchar(50) NOT NULL DEFAULT '0',
  `pengadaan_asset` int(11) DEFAULT NULL,
  `pengadaan_unit` varchar(350) DEFAULT NULL,
  `pengadaan_tglbeli` date DEFAULT NULL,
  `pengadaan_harga` double DEFAULT NULL,
  `pengadaan_jumlah` int(11) DEFAULT NULL,
  `pengadaan_total` double DEFAULT NULL,
  `pengadaan_creator` varchar(350) DEFAULT NULL,
  `pengadaan_keterangan` text DEFAULT NULL,
  `pengadaan_status` enum('Menunggu Persetujuan','Disetujui','Ditolak') DEFAULT NULL,
  `pengadaan_numseq` int(11) DEFAULT NULL,
  PRIMARY KEY (`pengadaan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.pengadaan: ~2 rows (approximately)
INSERT INTO `pengadaan` (`pengadaan_id`, `pengadaan_no`, `pengadaan_asset`, `pengadaan_unit`, `pengadaan_tglbeli`, `pengadaan_harga`, `pengadaan_jumlah`, `pengadaan_total`, `pengadaan_creator`, `pengadaan_keterangan`, `pengadaan_status`, `pengadaan_numseq`) VALUES
	(1, 'PE-2504-00001', 2, 'SMKN Budi Asih 2', '2025-04-03', 1500000, 2, 3000000, 'Kepsek', NULL, 'Disetujui', 1),
	(2, 'PE-2504-00002', 1, 'SMKN Budi Asih 2', '2025-04-03', 750000, 2, 1500000, 'aa', NULL, 'Disetujui', 2);

-- Dumping structure for table project_001.pengadaan_approval
CREATE TABLE IF NOT EXISTS `pengadaan_approval` (
  `pengadaanappr_id` int(11) NOT NULL AUTO_INCREMENT,
  `pengadaanappr_no` varchar(50) DEFAULT NULL,
  `pengadaanappr_cabang` varchar(350) DEFAULT NULL,
  `pengadaanappr_person` int(11) DEFAULT NULL,
  `pengadaanappr_scheme` int(11) DEFAULT NULL,
  `pengadaanappr_role` varchar(150) DEFAULT NULL,
  `pengadaanappr_dateapprv` date DEFAULT NULL,
  `pengadaanappr_status` enum('Disetujui','Ditolak','Menunggu') DEFAULT NULL,
  PRIMARY KEY (`pengadaanappr_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table project_001.pengadaan_approval: ~3 rows (approximately)
INSERT INTO `pengadaan_approval` (`pengadaanappr_id`, `pengadaanappr_no`, `pengadaanappr_cabang`, `pengadaanappr_person`, `pengadaanappr_scheme`, `pengadaanappr_role`, `pengadaanappr_dateapprv`, `pengadaanappr_status`) VALUES
	(1, 'PE-2504-00001', 'SMKN Budi Asih 2', 39, 1, 'Persetujuan Ketua Yayasan', '2025-04-03', 'Disetujui'),
	(2, 'PE-2504-00002', 'SMKN Budi Asih 2', 38, 1, 'Persetujuan Kepala Sekolah', '2025-04-03', 'Disetujui'),
	(3, 'PE-2504-00002', 'SMKN Budi Asih 2', 39, 2, 'Persetujuan Ketua Yayasan', '2025-04-03', 'Disetujui');

-- Dumping structure for table project_001.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('7hzC6YjlLMjCmqPUwR3P4fioQZ7Z8YagdqhrITX2', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YToxMDp7czo2OiJfdG9rZW4iO3M6NDA6IkRTUTdIUWs0QVZaU1kySXpxOEloSzRFR2wwQlVZRGVMS3k0TTlmWW8iO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMxOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJpc0xvZ2luIjtiOjE7czoxMjoia2FyeWF3YW5fbmlrIjtzOjEzOiJVUy8yNTAzLTAwMDAxIjtzOjEzOiJrYXJ5YXdhbl9uYW1hIjtzOjE1OiJBaG1hZCBTdXRlZGpvZGQiO3M6MTU6Imthcnlhd2FuX2NhYmFuZyI7czoxNjoiU01LTiBCdWRpIEFzaWggMiI7czoxNDoia2FyeWF3YW5fZW1haWwiO3M6MTE6ImFAZ21haWwuY29tIjtzOjExOiJrYXJ5YXdhbl9pZCI7aToyMjtzOjEzOiJrYXJ5YXdhbl9yb2xlIjtzOjExOiJTdXBlciBBZG1pbiI7fQ==', 1744545000);

-- Dumping structure for table project_001.tb_asset
CREATE TABLE IF NOT EXISTS `tb_asset` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_uuid` varchar(50) DEFAULT uuid(),
  `asset_no` varchar(50) DEFAULT NULL,
  `asset_nama` varchar(350) DEFAULT NULL,
  `asset_kategori` varchar(50) DEFAULT NULL,
  `asset_cabang` varchar(350) DEFAULT NULL,
  `asset_lokasi` int(11) DEFAULT NULL,
  `asset_merek` varchar(150) DEFAULT NULL,
  `asset_total` int(11) DEFAULT NULL,
  `asset_tglbeli` date DEFAULT NULL,
  `asset_hargabeli` double DEFAULT 0,
  `asset_status` enum('Available','Rusak','Dalam Perbaikan','Dipinjam') DEFAULT NULL,
  `asset_gambar` text DEFAULT NULL,
  `asset_numseq` int(11) DEFAULT NULL,
  PRIMARY KEY (`asset_id`),
  UNIQUE KEY `asset_uuid` (`asset_uuid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.tb_asset: ~5 rows (approximately)
INSERT INTO `tb_asset` (`asset_id`, `asset_uuid`, `asset_no`, `asset_nama`, `asset_kategori`, `asset_cabang`, `asset_lokasi`, `asset_merek`, `asset_total`, `asset_tglbeli`, `asset_hargabeli`, `asset_status`, `asset_gambar`, `asset_numseq`) VALUES
	(1, 'c2dbdf30-1094-11f0-ae84-fc5cee70ff2d', 'ASSET-2504-00001', 'Printer Epson', 'Hardware', 'SMKN Budi Asih 2', 1, 'Epson L3610', 1, NULL, 0, 'Available', NULL, 1),
	(2, 'cec93e5e-1094-11f0-ae84-fc5cee70ff2d', 'ASSET-2504-00002', 'Printer Kepsek', 'Hardware', 'SMKN Budi Asih 2', 2, 'Epson L50', 0, NULL, 0, 'Dipinjam', NULL, 2),
	(7, '99bbecdb-1856-11f0-a8bc-b81ea4d16e30', 'ASSET-2504-00003', 'asss', 'Hardware', 'SMKN Budi Asih 2', 2, 'Epson L3610', 0, NULL, 0, 'Available', 'fA5Oe109TnxXHVVXQxVPvR2aQUYAb8tmuV3dwjNy.png', 3),
	(8, '7be85082-1859-11f0-a8bc-b81ea4d16e30', 'ASSET-2504-00004', 'ffffffff', 'Hardware', 'SMKN Budi Asih 2', 2, 'Epson L3610', 0, NULL, 0, 'Available', '0qxrGeMsZU5834jNXYyRRGVHlZUQ3S4t5tybjV90.png', 4),
	(9, '048ef3a5-185b-11f0-a8bc-b81ea4d16e30', 'ASSET-2504-00005', 'ggggg', 'Hardware', 'SMKN Budi Asih 2', 2, 'Epson L3610', 0, NULL, 0, 'Available', '1744543948_Screenshot_44.png', 5);

-- Dumping structure for table project_001.tb_lokasi
CREATE TABLE IF NOT EXISTS `tb_lokasi` (
  `lokasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `lokasi_cabang` varchar(350) NOT NULL DEFAULT '0',
  `lokasi_nama` varchar(350) DEFAULT NULL,
  `lokasi_sub` varchar(150) DEFAULT NULL,
  `lokasi_penanggungjawab` int(11) DEFAULT NULL,
  PRIMARY KEY (`lokasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.tb_lokasi: ~2 rows (approximately)
INSERT INTO `tb_lokasi` (`lokasi_id`, `lokasi_cabang`, `lokasi_nama`, `lokasi_sub`, `lokasi_penanggungjawab`) VALUES
	(1, 'SMKN Budi Asih 2', 'Gedung AC', 'Lantai 1', 37),
	(2, 'SMKN Budi Asih 2', 'Gedung Kepsek', 'Lantai 1', 38);

-- Dumping structure for table project_001.tb_setting_approval
CREATE TABLE IF NOT EXISTS `tb_setting_approval` (
  `settappr_id` int(11) NOT NULL AUTO_INCREMENT,
  `settappr_person` int(11) DEFAULT NULL,
  `settappr_scheme` int(11) DEFAULT 1,
  `settappr_keterangan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`settappr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.tb_setting_approval: ~0 rows (approximately)
INSERT INTO `tb_setting_approval` (`settappr_id`, `settappr_person`, `settappr_scheme`, `settappr_keterangan`) VALUES
	(1, 30, 1, 'Persetujuan 1');

-- Dumping structure for table project_001.tb_setting_divisi
CREATE TABLE IF NOT EXISTS `tb_setting_divisi` (
  `settd_id` int(11) NOT NULL AUTO_INCREMENT,
  `settd_nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settd_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table project_001.tb_setting_divisi: ~0 rows (approximately)
INSERT INTO `tb_setting_divisi` (`settd_id`, `settd_nama`) VALUES
	(3, 'Sistem Informasi');

-- Dumping structure for table project_001.tb_setting_kategori
CREATE TABLE IF NOT EXISTS `tb_setting_kategori` (
  `settk_id` int(11) NOT NULL AUTO_INCREMENT,
  `settk_nama` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`settk_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

-- Dumping data for table project_001.tb_setting_kategori: ~0 rows (approximately)
INSERT INTO `tb_setting_kategori` (`settk_id`, `settk_nama`) VALUES
	(3, 'Hardware');

-- Dumping structure for table project_001.tb_setting_merek
CREATE TABLE IF NOT EXISTS `tb_setting_merek` (
  `settm_id` int(11) NOT NULL AUTO_INCREMENT,
  `settm_no` varchar(20) NOT NULL DEFAULT '0',
  `settm_nama` varchar(150) DEFAULT NULL,
  `settm_tipe` varchar(150) DEFAULT NULL,
  `settm_numseq` int(11) DEFAULT 0,
  PRIMARY KEY (`settm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table project_001.tb_setting_merek: ~2 rows (approximately)
INSERT INTO `tb_setting_merek` (`settm_id`, `settm_no`, `settm_nama`, `settm_tipe`, `settm_numseq`) VALUES
	(3, 'SETTM2502-00001', 'Epson', 'L3610', 1),
	(4, 'SETTM2502-00002', 'Epson', 'L50', 2);

-- Dumping structure for table project_001.users
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_karyawan` int(10) unsigned NOT NULL DEFAULT 0,
  `user_name` varchar(150) NOT NULL DEFAULT '0',
  `user_password` varchar(35) NOT NULL,
  `user_role` enum('Admin','User') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table project_001.users: ~0 rows (approximately)
INSERT INTO `users` (`user_id`, `user_karyawan`, `user_name`, `user_password`, `user_role`, `created_at`, `updated_at`) VALUES
	(1, 1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '2025-02-16 09:11:37', '2025-02-16 09:11:38');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
