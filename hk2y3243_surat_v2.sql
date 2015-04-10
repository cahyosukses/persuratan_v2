-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.20 - Source distribution
-- Server OS:                    Linux
-- HeidiSQL Version:             9.1.0.4886
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for hk2y3243_surat_v2
CREATE DATABASE IF NOT EXISTS `hk2y3243_surat_v2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `hk2y3243_surat_v2`;


-- Dumping structure for table hk2y3243_surat_v2.disposisi
CREATE TABLE IF NOT EXISTS `disposisi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_surat` int(10) NOT NULL,
  `asal` enum('surat','disposisi') NOT NULL,
  `id_rel` int(10) NOT NULL,
  `dari` varchar(10) NOT NULL,
  `dari_user` int(6) NOT NULL,
  `penerima` varchar(10) NOT NULL,
  `penerima_user` int(6) NOT NULL,
  `intruksi` varchar(100) NOT NULL,
  `kecepatan` enum('sangat segera','segera','biasa') NOT NULL,
  `tgl_end` datetime NOT NULL,
  `isi_disposisi` varchar(255) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `flag_read` enum('Y','N') NOT NULL,
  `flag_lanjut` enum('Y','N') NOT NULL,
  `flag_tolak` enum('Y','N') NOT NULL,
  `alasan` varchar(255) NOT NULL,
  `disp_ke` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.disposisi: 4 rows
DELETE FROM `disposisi`;
/*!40000 ALTER TABLE `disposisi` DISABLE KEYS */;
INSERT INTO `disposisi` (`id`, `id_surat`, `asal`, `id_rel`, `dari`, `dari_user`, `penerima`, `penerima_user`, `intruksi`, `kecepatan`, `tgl_end`, `isi_disposisi`, `tgl_input`, `flag_read`, `flag_lanjut`, `flag_tolak`, `alasan`, `disp_ke`) VALUES
	(6, 10, 'disposisi', 10, '02', 16, '02', 20, 'Ditindaklanjuti', 'sangat segera', '2014-10-28 00:00:00', 'Segera Laporkan', '2014-10-28 15:08:35', 'Y', 'Y', 'N', '', 2),
	(5, 10, 'surat', 10, '02', 7, '02', 16, 'Dihadiri & dilaporkan hasilnya', 'segera', '2014-10-29 00:00:00', 'DI TANGGAPI', '2014-10-28 12:13:38', 'Y', 'Y', 'N', '', 1),
	(7, 10, 'disposisi', 10, '02', 20, '02', 21, 'Dihadiri & dilaporkan hasilnya', 'sangat segera', '2014-10-28 00:00:00', 'Ditindaklanjuti', '2014-10-28 15:10:22', 'Y', 'Y', 'N', '', 3),
	(8, 11, 'surat', 11, '02', 7, '02', 15, 'Ditindaklanjuti', 'sangat segera', '2014-11-03 00:00:00', 'Segera ditunjuk beberapa dosen untuk mengahadiri rapat', '2014-11-03 14:32:40', 'Y', 'Y', 'N', '', 1);
/*!40000 ALTER TABLE `disposisi` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.disposisi_tanggapan
CREATE TABLE IF NOT EXISTS `disposisi_tanggapan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_disposisi` int(10) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.disposisi_tanggapan: 4 rows
DELETE FROM `disposisi_tanggapan`;
/*!40000 ALTER TABLE `disposisi_tanggapan` DISABLE KEYS */;
INSERT INTO `disposisi_tanggapan` (`id`, `id_disposisi`, `catatan`, `file`, `tgl_kirim`) VALUES
	(3, 7, 'Sudah Ditindaklanjuti', '', '2014-10-28 15:11:07'),
	(4, 6, 'Telah di tanggapi, ACC', '', '2014-10-28 15:17:06'),
	(5, 5, 'Sudah ditanggapi', '', '2014-10-29 00:08:50'),
	(6, 8, 'Sudah ditunjuk beberapa dosen untuk mengikuti undangan rapat.', '', '2014-11-03 14:38:09');
/*!40000 ALTER TABLE `disposisi_tanggapan` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.instansi
CREATE TABLE IF NOT EXISTS `instansi` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `background_logo` varchar(100) NOT NULL,
  `login_logo_header` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table hk2y3243_surat_v2.instansi: ~1 rows (approximately)
DELETE FROM `instansi`;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` (`id`, `nama`, `alamat`, `logo`, `background_logo`, `login_logo_header`) VALUES
	(1, 'Universitas Jambi', 'Jl. Raya Jambi - Ma.Bulian KM 15 Mendalo Darat Jambi,\nINDONESIA\nTel/Fax: +62 741 583453', 'unja12.png', 'back_32.png', 'logo_login.jpg');
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.kode_fkip
CREATE TABLE IF NOT EXISTS `kode_fkip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.kode_fkip: ~8 rows (approximately)
DELETE FROM `kode_fkip`;
/*!40000 ALTER TABLE `kode_fkip` DISABLE KEYS */;
INSERT INTO `kode_fkip` (`id`, `id_parent`, `nama`, `kode`) VALUES
	(1, 0, 'Bagian Tata Usaha', 'UN21.1'),
	(2, 1, 'Sub. Bagian Pendidikan', 'UN21.1.1.1'),
	(3, 1, 'Sub. Bagian Umum dan Perlengkapan', 'UN21.1.1.2'),
	(4, 1, 'Sub. Bagian Keuangan dan Kepegawaian', 'UN21.1.1.3'),
	(5, 1, 'Sub. Bagian Kemahasiswaaan', 'UN21.1.1.4'),
	(6, 0, 'Jurusan Pendidikan Bahasa dan Seni', 'UN21.1.2'),
	(7, 6, 'Prodi. Pendidikan Bahasa dan Sastra Indonesia dan daerah', 'UN21.1.2.1'),
	(8, 6, 'Prodi. Pendidikan Bahasa Inggris', 'UN21.1.2.2');
/*!40000 ALTER TABLE `kode_fkip` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.kode_hal_org
CREATE TABLE IF NOT EXISTS `kode_hal_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.kode_hal_org: ~2 rows (approximately)
DELETE FROM `kode_hal_org`;
/*!40000 ALTER TABLE `kode_hal_org` DISABLE KEYS */;
INSERT INTO `kode_hal_org` (`id`, `kode`, `nama`, `keterangan`) VALUES
	(3, 'AKJ', 'Akreditas', '-'),
	(4, 'AJ', 'Analisis Jabatan', '-');
/*!40000 ALTER TABLE `kode_hal_org` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `sub_dari` enum('instansi','aset','surat') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `url` varchar(25) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table hk2y3243_surat_v2.menu: 11 rows
DELETE FROM `menu`;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` (`id`, `sub_dari`, `nama`, `url`, `icon`) VALUES
	(1, 'instansi', 'Instansi', 'atur_instansi', 'briefcase'),
	(2, 'instansi', 'Pengguna', 'atur_user', 'user'),
	(3, 'surat', 'S. Masuk', 'surat_masuk', 'folder-open-o'),
	(4, 'surat', 'S. Keluar', 'surat_keluar', 'folder'),
	(5, 'surat', 'Disp. Masuk', 'disposisi_masuk', 'hand-o-right'),
	(6, 'surat', 'Disp. Keluar', 'disposisi_keluar', 'hand-o-down'),
	(7, 'surat', 'Konsep', 'konsep', 'align-left'),
	(9, 'instansi', 'Setting Header', 'setting_header', 'star'),
	(12, 'surat', 'Jenis Surat', 'jenis_surat', 'thumb-tack'),
	(13, 'instansi', 'Kode Hal Organisasi', 'kode_hal_org', 'envelope-o'),
	(14, 'instansi', 'Kode Surat', 'kode_surat', 'envelope-o');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.pengguna
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_unit` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nomor_induk` varchar(50) NOT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `jenjang` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(75) NOT NULL,
  `tgl_aktif` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `level` enum('admin root','pimpinan','tata usaha','staff') NOT NULL,
  `apps` enum('instansi','aset','surat') NOT NULL,
  `id_kode_fkip` int(11) DEFAULT NULL,
  `id_menu` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `ttd_image` varchar(50) NOT NULL DEFAULT 'blank.jpg',
  `kehadiran_status` enum('hadir','keluar') NOT NULL DEFAULT 'hadir',
  `kehadiran_keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.pengguna: 53 rows
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `id_unit`, `nama`, `nomor_induk`, `jabatan`, `jenjang`, `username`, `password`, `tgl_aktif`, `status`, `level`, `apps`, `id_kode_fkip`, `id_menu`, `email`, `ttd_image`, `kehadiran_status`, `kehadiran_keterangan`) VALUES
	(1, '', 'Hely Kurniawan', '11', 'Admin E-Persuratan', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2014-05-20 09:10:20', 'Y', 'admin root', 'instansi', 1, '1,2,9,13,14,', 'helykurniawan@gmail.com', '1f53738431bd77296ed51e2a9b787dab.jpg', 'hadir', 'hadir'),
	(7, '02', 'Prof. Dr. M. Rusdi, M.Sc', '197012191994031005', 'Dekan FKIP', 'S1', '197012191994031005', '166982af1c60f416c9dd8f21aed56dce', '2014-05-27 08:29:55', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'rusdi@gmail.com', '1f53738431bd77296ed51e2a9b787dab.jpg', 'hadir', 'HADIR OK'),
	(15, '02', 'Drs. Aripuddin, M.Hum', '196804211993031002', 'Wakil Dekan I', 'S1', '196804211993031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:48:58', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'aripuddin@ymail.com', 'blank.jpg', 'hadir', ''),
	(16, '02', 'Drs. Akhyaruddin, M.Hum', '196505091992031003', 'Wakil Dekan II', 'S1', '196505091992031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:50:35', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'akhyaruddin, M.Hum', 'blank.jpg', 'hadir', ''),
	(17, '02', 'Drs. Abu Bakar, M.Pd', '196701061993031002', 'Wakil Dekan III', 'S1', '196701061993031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:55:09', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'abubakar@ymail.com', 'blank.jpg', 'hadir', ''),
	(18, '02', 'Drs. Agus Setyonegoro, M.Pd', '196708041993031005', 'Ketua Tim Pengembangan', 'S1', '196708041993031005', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:00:00', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'agus@yahoo.com', 'blank.jpg', 'hadir', ''),
	(19, '02', 'Dr. Jefri Marzal, M.Sc', '196806021993031004', 'Ketua Tim Penjaminan Mutu dan Sistem Informasi', 'S1', '196806021993031004', 'd0b5899ecc64bf18bc5ab69110d37c89', '2014-10-16 15:02:25', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'jeff_marsal@yahoo.com', 'blank.jpg', 'hadir', ''),
	(20, '02', 'Drs. sulaiman', '-', 'Kabag Tata Usaha FKIP Universitas Jambi', 'S1', 'kabag_tu', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:06:10', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'sulaiman@yahoo.com', 'blank.jpg', 'hadir', ''),
	(21, '02', 'Parinem', '-', 'Kasub Bagian Pendidikan/Akademik', 'S1', 'kasub_bp', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:07:41', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'parinem@yahoo.com', 'blank.jpg', 'hadir', ''),
	(22, '02', 'Darliati, S.Pd', '-', 'Kasub Bagian Keuangan dan Kepegawaian', 'S1', 'kasub_bkk', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:09:02', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'darliati@yahoo.com', 'blank.jpg', 'hadir', ''),
	(23, '02', 'Dra. Novi Yanti', '-', 'Kasub Bagian Kemahasiswaan', 'S1', 'kasub_bkmhs', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:11:06', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'novi@yahoo.com', 'blank.jpg', 'hadir', ''),
	(24, '02', 'Mohd. Hafif, SE., M.M', '-', 'Kasub Bagian Umum dan Perlengkapan ', 'S1', 'kasub_bup', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:12:09', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'hafif@yahoo.com', 'blank.jpg', 'hadir', ''),
	(25, '01', 'Rosmiati, S.Pd., M.Pd', '197706142006042002', 'Ketua Jurusan', 'S1', '197706142006042002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:47:37', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'rosmiati@yahoo.com', 'blank.jpg', 'hadir', ''),
	(54, '', 'Admin Surat FKIP', '-', 'Tata Usaha', 'S1', 'adm_surat', '3385843480a5acf5e46069b77a552cfe', '2014-10-17 09:38:17', 'Y', 'tata usaha', 'surat', 7, '3,4,7,12,', 'admn@yahoo.com', 'blank.jpg', 'hadir', ''),
	(26, '0202', 'Dr. Kamid, M.Si', '196609041992031002', 'Ketua Jurusan', 'S1', '196609041992031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:53:21', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'kamid@ymail.com', 'blank.jpg', 'hadir', ''),
	(27, '03', 'Dr. Hj. Yusra Dewi, M.Pd', '196310241988032001', 'Ketua Jurusan', 'S1', '196310241988032001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 15:56:11', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'yusra@yahoo.com', 'blank.jpg', 'hadir', ''),
	(28, '04', 'Drs. Rasimin, M.Pd', '196011051986031003', 'Ketua Jurusan', 'S1', '196011051986031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 16:00:41', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'rasimin@yahoo.com', 'blank.jpg', 'hadir', ''),
	(29, '020301', 'Drs. Albertus Sinaga, M.Pd', '195806061986031005', 'Ketua Program Studi', 'S1', '195806061986031005', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 16:22:50', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'albertus@gmail.com', 'blank.jpg', 'hadir', ''),
	(30, '020302', 'Failasofah, S.Pd., M.Pd', '198409252009122001', 'Ketua Program Studi', 'S1', '198409252009122001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 16:30:42', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'failasofah@ymail.com', 'blank.jpg', 'hadir', ''),
	(31, '020203', 'Drs. Epinur, M.Si', '196302281991031002', 'Ketua Program Studi', 'S1', '196302281991031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 16:54:20', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'epinur@gmail.com', 'blank.jpg', 'hadir', ''),
	(32, '020201', 'Dra. Sofnidar, M.Si', '196612311993032009', 'Ketua Program Studi', 'S1', '196612311993032009', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 16:55:58', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'sofnidar@yahoo.com', 'blank.jpg', 'hadir', ''),
	(33, '020202', 'Drs. M. Hidayat, M.Si', '196709231993031003', 'Ketua Program Studi', 'S1', '196709231993031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:04:21', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'hidayat@gmail.com', 'blank.jpg', 'hadir', ''),
	(34, '020204', 'Retni Sulistioning B, S.Pd., M.Si', '196909171994032003', 'Ketua Program Studi', 'S1', '196909171994032003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:06:04', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'retni@yahoo.com', 'blank.jpg', 'hadir', ''),
	(35, '020401', 'Drs. Maryono, M.Pd', '196107071986031003', 'Ketua Program Studi', 'S1', '196107071986031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:09:39', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'maryono@ymail.com', 'blank.jpg', 'hadir', ''),
	(36, '020402', 'Drs. Tumewa Pangaribuan, M.Pd', '195910101985031006', 'Ketua Program Studi', 'S1', '195910101985031006', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:10:56', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'tumewa@ymail.com', 'blank.jpg', 'hadir', ''),
	(37, '020406', 'Muhammad Ali, S.Pd., M.Pd', '197406182005011004', 'Ketua Program Studi', 'S1', '197406182005011004', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:13:57', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'mali@yahoo.com', 'blank.jpg', 'hadir', ''),
	(38, '020403', 'Prof. Dr. Hj. Emosda, M.Pd Kons', '195603231981032002', 'Ketua Program Studi', 'S1', '195603231981032002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:15:18', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'emosda@gmail.com', 'blank.jpg', 'hadir', ''),
	(39, '020205', 'Nazaruddin, S.Si., M.Si., Ph.D', '197404121999031004', 'Ketua Program Studi', 'S1', '197404121999031004', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:16:39', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'nazar@ymail.com', 'blank.jpg', 'hadir', ''),
	(40, '020404', 'Drs. M. Salam, M.Si', '195907111985031002', 'Ketua Program Studi', 'S1', '195907111985031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:21:10', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'msalam@yahoo.com', 'blank.jpg', 'hadir', ''),
	(41, '020405', 'Nehru, S.Si., M.Si', '197602082001121002', 'Ketua Program Studi', 'S1', '197602082001121002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:22:26', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'nehru@yahoo.com', 'blank.jpg', 'hadir', ''),
	(42, '020407', 'Drs. Akmal Sutja, M.Pd', '195912311984031011', 'Ketua Program Studi', 'S1', '195912311984031011', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 17:24:16', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'akmal@yahoo.com', 'blank.jpg', 'hadir', ''),
	(43, '05', 'Dr. Herman Budiyono, M.Pd', '196111201987031006', 'Ketua Program Studi', 'S2', '196111201987031006', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 18:59:36', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'herman_budiyono@ymail.co.id', 'blank.jpg', 'hadir', ''),
	(44, '06', 'Dr. Rachmawati, M.Pd', '195907031987022001', 'Ketua Program Studi', 'S2', '195907031987022001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:01:04', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'rachmawati@gmail.com', 'blank.jpg', 'hadir', ''),
	(45, '14', 'Prof. Dr. Asrial, M.Si', '196308071990031002', 'Ketua Program Studi', 'S3', '196308071990031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:02:34', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'asrial@ymail.com', 'blank.jpg', 'hadir', ''),
	(46, '15', 'Prof. Dr. Mujiyono Wiryotinoyo, M.Pd', '195202201979031003', 'Ketua Program Studi', 'S3', '195202201979031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:03:52', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'mujiyono@yahoo.com', 'blank.jpg', 'hadir', ''),
	(47, '08', 'Dr. Syamsurizal, M.Si', '196809181993031003', 'Ketua Program Studi', 'S2', '196809181993031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:05:04', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'syamsurizal68@gmail.com', 'blank.jpg', 'hadir', ''),
	(48, '13', 'Dr. Ali Idrus, M.Pd., M.E', '196011181985031002', 'Ketua Program Studi', 'S2', '196011181985031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:07:45', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'ali_idrus@yahoo.com', 'blank.jpg', 'hadir', ''),
	(49, '07', 'Prof. Dr. Rahmat Murbojono, M.Pd', '195008081984031003', 'Ketua Program Studi', 'S2', '195008081984031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:09:13', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'rahmat_murbojono@yahoo.com', 'blank.jpg', 'hadir', ''),
	(50, '09', 'Dr. Suratno, M.Pd', '196005281989021001', 'Ketua Program Studi', 'S2', '196005281989021001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:10:14', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'suratnounja@gmail.com', 'blank.jpg', 'hadir', ''),
	(51, '10', 'M. Haris Effendi, S.Pd., M.Si., Ph.D', '197301232000031001', 'Ketua Program Studi', 'S2', '197301232000031001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:11:29', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'haris@ymail.com', 'blank.jpg', 'hadir', ''),
	(52, '11', 'Dr. Nazurty, M.Pd', '195907251985032003', 'Ketua Program Studi', 'S2', '195907251985032003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:13:11', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'nazurty@yahoo.com', 'blank.jpg', 'hadir', ''),
	(53, '12', 'Dr. Kamid, M.Si', '196609041992031002', 'Ketua Program Studi', 'S2', '196609041992031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 19:14:24', 'Y', 'pimpinan', 'surat', NULL, '3,4,5,6,7,', 'kamid@ymail.com', 'blank.jpg', 'hadir', ''),
	(55, '0205', 'Dr. Herman Budiyono, M.Pd', '196111201987031006', 'Ketua Program Studi', 'S2', '196111201987031006', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-28 23:44:30', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'herman_budiyono@yahoo.com', 'blank.jpg', 'hadir', ''),
	(56, '0206', 'Dr. Rachmawati, M.Pd', '195907031987022001', 'Ketua Program Studi', 'S2', '195907031987022001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-28 23:57:33', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'rachmawati@gmail.com', 'blank.jpg', 'hadir', ''),
	(57, '0207', 'Prof. Dr. Rahmat Murbojono, M.Pd', '195008081984031003', 'Ketua Program Studi', 'S2', '195008081984031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:00:07', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'rahmat@yahoo.com', 'blank.jpg', 'hadir', ''),
	(58, '0208', 'Dr. Syamsurizal, M.Si', '196809181993031003', 'Ketua Program Studi', 'S2', '196809181993031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:02:16', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'syamsurizal@gmail.com', 'blank.jpg', 'hadir', ''),
	(59, '0209', 'Dr. Suratno, M.Pd', '196005281989021001', 'Ketua Program Studi', 'S2', '196005281989021001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:09:01', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'suratnounja@gmail.com', 'blank.jpg', 'hadir', ''),
	(60, '0210', 'M. Haris Effendi, S.Pd., M.Si., Ph.D', '197301232000031001', 'Ketua Program Studi', 'S2', '197301232000031001', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:10:42', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'haris@yahoo.com', 'blank.jpg', 'hadir', ''),
	(61, '0211', 'Dr. Nazurty, M.Pd', '195907251985032003', 'Ketua Program Studi', 'S2', '195907251985032003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:12:29', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'nazurty@yahoo.com', 'blank.jpg', 'hadir', ''),
	(62, '0212', 'Dr. Kamid, M.Si', '196609041992031002', 'Ketua Program Studi', 'S2', '196609041992031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:20:33', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'kamid@ymail.com', 'blank.jpg', 'hadir', ''),
	(63, '0213', 'Dr. Ali Idrus, M.Pd., M.E', '196011181985031002', 'Ketua Program Studi', 'S2', '196011181985031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:21:50', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'aliidrus@yahoo.com', 'blank.jpg', 'hadir', ''),
	(64, '0214', 'Prof. Dr. Asrial, M.Si', '196308071990031002', 'Ketua Program Studi', 'S3', '196308071990031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:23:50', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'asrial@yahoo.com', 'blank.jpg', 'hadir', ''),
	(65, '0215', 'Prof. Dr. Mujiyono Wiryotinoyo, M.Pd', '195202201979031003', 'Ketua Program Studi', 'S3', '195202201979031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-29 00:25:27', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'mujiyono@yahoo.com', 'blank.jpg', 'hadir', '');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.r_jenis_surat
CREATE TABLE IF NOT EXISTS `r_jenis_surat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.r_jenis_surat: 3 rows
DELETE FROM `r_jenis_surat`;
/*!40000 ALTER TABLE `r_jenis_surat` DISABLE KEYS */;
INSERT INTO `r_jenis_surat` (`id`, `nama`) VALUES
	(1, 'Surat Tugas'),
	(8, 'Surat Undangan'),
	(7, 'Surat Pemberitahuan');
/*!40000 ALTER TABLE `r_jenis_surat` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.surat_keluar
CREATE TABLE IF NOT EXISTS `surat_keluar` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_rel_surat_masuk` int(6) NOT NULL,
  `id_rel_disposisi` int(6) NOT NULL,
  `pengirim` varchar(10) NOT NULL,
  `pengirim_user` int(5) NOT NULL,
  `tgl_surat` date NOT NULL,
  `no_agenda` varchar(10) NOT NULL,
  `no_surat` varchar(100) NOT NULL,
  `penerima` varchar(200) NOT NULL,
  `perihal` text NOT NULL,
  `kecepatan` enum('sangat segera','segera','biasa') NOT NULL,
  `pemeriksa` varchar(10) NOT NULL,
  `pemeriksa_user` int(6) NOT NULL,
  `paraf_list` varchar(50) DEFAULT NULL,
  `flag_setuju` enum('Y','N') NOT NULL,
  `flag_keluar` enum('Y','N') NOT NULL,
  `flag_del` enum('Y','N') NOT NULL,
  `flag_revisi` enum('Y','N') NOT NULL DEFAULT 'N',
  `tipe` enum('template','file') NOT NULL,
  `id_buat_surat` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `id_jenis_surat` int(11) NOT NULL,
  `isi_surat` text NOT NULL,
  `id_kode_hal_org` int(11) NOT NULL,
  `catatan` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.surat_keluar: 5 rows
DELETE FROM `surat_keluar`;
/*!40000 ALTER TABLE `surat_keluar` DISABLE KEYS */;
INSERT INTO `surat_keluar` (`id`, `id_rel_surat_masuk`, `id_rel_disposisi`, `pengirim`, `pengirim_user`, `tgl_surat`, `no_agenda`, `no_surat`, `penerima`, `perihal`, `kecepatan`, `pemeriksa`, `pemeriksa_user`, `paraf_list`, `flag_setuju`, `flag_keluar`, `flag_del`, `flag_revisi`, `tipe`, `id_buat_surat`, `file`, `id_jenis_surat`, `isi_surat`, `id_kode_hal_org`, `catatan`) VALUES
	(12, 0, 0, '020202', 33, '2014-10-28', '00001', '01/02/SK/2014', 'Dekan FKIP', 'Tugas Belajar', 'sangat segera', '02', 7, NULL, 'Y', 'N', 'N', 'N', 'file', 0, 'Catatan_E-PERSURATAN1.docx', 1, '<p>Pengusulan Surat Tugas test</p>', 4, ''),
	(13, 0, 0, '', 54, '2014-11-03', '00002', '12/SU/2014', 'Universitas Negeri Jakarta', 'Usulan Dosen Untuk Mengikuti Undangan Rapat', 'sangat segera', '02', 7, NULL, 'Y', 'Y', 'N', 'N', 'file', 0, 'USULAN_NAMA_DOSEN_UNUTK_MENGIKUTI_UNDANGAN_RAPAT.docx', 1, '<p><span style="font-size: small; font-family: arial black,avant garde;">USULAN NAMA-NAMA DOSEN UNTUK MENGIKUTI UNDANGAN RAPAT</span></p>\n<p><span style="font-size: small; font-family: arial black,avant garde;">xxxxx</span></p>', 4, ''),
	(24, 0, 0, '', 54, '2014-11-15', '00004', '024/UN21.1.2.1/AKJ/2014', 'penerima', 'perihal', 'sangat segera', '02', 7, '20,15,', 'Y', 'Y', 'N', 'N', 'file', 0, '', 1, '<p>isi</p>', 3, ''),
	(23, 0, 0, '', 54, '2014-11-15', '00005', '023/UN21.1.2.1/AKJ/2014', 'penerima', 'perihal', 'sangat segera', '02', 7, '20,15,', 'Y', 'N', 'N', 'N', 'file', 0, '', 1, '<p>isi surat update paling baru</p>', 3, 'last catatan'),
	(25, 0, 0, '', 54, '2014-11-25', '00006', '025/UN21.1.2.1/AKJ/2014', 'penerima', 'perihal', 'sangat segera', '02', 20, NULL, 'N', 'N', 'N', 'N', 'file', 0, '', 1, '<p>test ajah udah revisi</p>', 3, '');
/*!40000 ALTER TABLE `surat_keluar` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.surat_keluar_revisi
CREATE TABLE IF NOT EXISTS `surat_keluar_revisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `isi_revisi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.surat_keluar_revisi: ~0 rows (approximately)
DELETE FROM `surat_keluar_revisi`;
/*!40000 ALTER TABLE `surat_keluar_revisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_keluar_revisi` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.surat_masuk
CREATE TABLE IF NOT EXISTS `surat_masuk` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tgl_diterima` datetime NOT NULL,
  `tgl_surat` date NOT NULL,
  `pengirim` varchar(200) NOT NULL,
  `nomor` varchar(200) NOT NULL,
  `no_agenda` varchar(10) NOT NULL,
  `penerima` varchar(10) NOT NULL,
  `tembusan` varchar(10) NOT NULL,
  `perihal` text NOT NULL,
  `kecepatan` enum('sangat segera','segera','biasa') NOT NULL,
  `file` varchar(255) NOT NULL,
  `flag_read` enum('Y','N') NOT NULL,
  `flag_del` enum('Y','N') NOT NULL,
  `flag_lanjut` enum('Y','N') NOT NULL,
  `flag_tolak` enum('Y','N') NOT NULL,
  `alasan` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.surat_masuk: 2 rows
DELETE FROM `surat_masuk`;
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
INSERT INTO `surat_masuk` (`id`, `tgl_diterima`, `tgl_surat`, `pengirim`, `nomor`, `no_agenda`, `penerima`, `tembusan`, `perihal`, `kecepatan`, `file`, `flag_read`, `flag_del`, `flag_lanjut`, `flag_tolak`, `alasan`) VALUES
	(10, '2014-10-20 20:02:37', '2014-10-20', 'UNJ', '01/DT/2014', '000001', '02', '', 'Undangan Seminar ICETS', 'sangat segera', 'ICETS_Paper_Template.pdf', 'N', 'Y', 'N', 'N', ''),
	(11, '2014-11-03 14:16:03', '2014-11-03', 'Universitad Negeri Malang', '01/DT/SU/2014', '000002', '02', '', 'Undangan Rapat', 'sangat segera', 'Undangan_Rapat_Dari_UNM.docx', 'Y', 'Y', 'Y', 'N', '');
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.surat_tanggapan
CREATE TABLE IF NOT EXISTS `surat_tanggapan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_surat` int(10) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat_v2.surat_tanggapan: 0 rows
DELETE FROM `surat_tanggapan`;
/*!40000 ALTER TABLE `surat_tanggapan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_tanggapan` ENABLE KEYS */;


-- Dumping structure for table hk2y3243_surat_v2.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `unit_0` varchar(2) NOT NULL,
  `unit_1` varchar(2) NOT NULL,
  `unit_2` varchar(2) NOT NULL,
  `unit_3` varchar(2) NOT NULL,
  `kode_gabung` varchar(8) NOT NULL,
  `nama_unit` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_gabung` (`kode_gabung`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table hk2y3243_surat_v2.unit: 40 rows
DELETE FROM `unit`;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` (`id`, `unit_0`, `unit_1`, `unit_2`, `unit_3`, `kode_gabung`, `nama_unit`) VALUES
	(1, '', '', '', '', '', 'Universitas Jambi'),
	(44, '02', '04', '02', '', '020402', 'PG-PAUD'),
	(45, '02', '04', '03', '', '020403', 'Bimbingan Konseling'),
	(6, '02', '', '', '', '02', 'Fakultas Keguruan dan Ilmu Pendidikan'),
	(43, '02', '04', '01', '', '020401', 'Pendidikan Guru Sekolah Dasar (PGSD)'),
	(9, '03', '01', '', '', '0301', 'Pendidikan Bahasa Indonesia'),
	(10, '03', '02', '', '', '0302', 'Pendidikan Bahasa Inggris'),
	(11, '02', '01', '', '', '0201', 'Pendidikan Ilmu Pengetahuan Sosial (PIPS)'),
	(12, '02', '02', '', '', '0202', 'Pendidikan Matematika dan Ilmu Pengetahuan Alam (PMIPA)'),
	(13, '02', '03', '', '', '0203', 'Pendidikan Bahasa Dan Sastra (PBS)'),
	(14, '02', '04', '', '', '0204', 'Ilmu Pendidikan (IP)'),
	(36, '02', '02', '01', '', '020201', 'Pendidikan Matematika'),
	(16, '04', '01', '', '', '0401', 'Pendidikan Guru Sekolah Dasar'),
	(17, '04', '02', '', '', '0402', 'PG-PAUD'),
	(18, '04', '03', '', '', '0403', 'Bimbingan Konseling'),
	(19, '04', '04', '', '', '0404', 'PSKGJ'),
	(20, '04', '05', '', '', '0405', 'Program Mandiri'),
	(23, '04', '06', '', '', '0406', 'Pendidikan Olahraga dan Kesehatan'),
	(24, '04', '07', '', '', '0407', 'Administrasi Pendidikan'),
	(42, '02', '03', '02', '', '020302', 'Pendidikan Bahasa Inggris'),
	(40, '02', '02', '05', '', '020205', 'PGMIPA-U'),
	(41, '02', '03', '01', '', '020301', 'Pendidikan Bahasa Indonesia'),
	(39, '02', '02', '04', '', '020204', 'Pendidikan Biologi'),
	(38, '02', '02', '03', '', '020203', 'Pendidikan Kimia'),
	(37, '02', '02', '02', '', '020202', 'Pendidikan Fisika'),
	(46, '02', '04', '04', '', '020404', 'PSKGJ'),
	(47, '02', '04', '05', '', '020405', 'Program Mandiri'),
	(48, '02', '04', '06', '', '020406', 'Pendidikan Olahraga dan Kesehatan (PORKES)'),
	(49, '02', '04', '07', '', '020407', 'Administrasi Pendidikan'),
	(50, '02', '05', '', '', '0205', 'Magister Pendidikan Bahasa dan Sastra Indonesia (PS-MPBSI)'),
	(51, '02', '06', '', '', '0206', 'Master of Education Teaching English as a Foreign Leanguage (TEFL)'),
	(52, '02', '07', '', '', '0207', 'Magister Manajemen Pendidikan'),
	(53, '02', '08', '', '', '0208', 'Magister Pendidikan IPA'),
	(54, '02', '09', '', '', '0209', 'Magister Pendidikan Ekonomi'),
	(55, '02', '10', '', '', '0210', 'Magister Pendidikan Kimia'),
	(56, '02', '11', '', '', '0211', 'Magister Pendidikan Dasar'),
	(57, '02', '12', '', '', '0212', 'Magister Pendidikan Matematika'),
	(58, '02', '13', '', '', '0213', 'Magister Teknologi Pendidikan'),
	(59, '02', '14', '', '', '0214', 'Doktor Pendidikan MIPA'),
	(60, '02', '15', '', '', '0215', 'Doktor Kependidikan ');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
