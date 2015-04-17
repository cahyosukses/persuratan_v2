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

-- Dumping database structure for db_office
CREATE DATABASE IF NOT EXISTS `db_office` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_office`;


-- Dumping structure for table db_office.disposisi
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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.disposisi: 1 rows
DELETE FROM `disposisi`;
/*!40000 ALTER TABLE `disposisi` DISABLE KEYS */;
INSERT INTO `disposisi` (`id`, `id_surat`, `asal`, `id_rel`, `dari`, `dari_user`, `penerima`, `penerima_user`, `intruksi`, `kecepatan`, `tgl_end`, `isi_disposisi`, `tgl_input`, `flag_read`, `flag_lanjut`, `flag_tolak`, `alasan`, `disp_ke`) VALUES
	(10, 13, 'surat', 13, '02', 7, '02', 15, 'Ditindaklanjuti', 'sangat segera', '2015-04-03 00:00:00', 'Segera', '2015-04-03 00:12:08', 'Y', 'Y', 'N', '', 1);
/*!40000 ALTER TABLE `disposisi` ENABLE KEYS */;


-- Dumping structure for table db_office.disposisi_tanggapan
CREATE TABLE IF NOT EXISTS `disposisi_tanggapan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_disposisi` int(10) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.disposisi_tanggapan: 1 rows
DELETE FROM `disposisi_tanggapan`;
/*!40000 ALTER TABLE `disposisi_tanggapan` DISABLE KEYS */;
INSERT INTO `disposisi_tanggapan` (`id`, `id_disposisi`, `catatan`, `file`, `tgl_kirim`) VALUES
	(7, 10, 'Segera Ditanggapi', '', '2015-04-03 00:13:46');
/*!40000 ALTER TABLE `disposisi_tanggapan` ENABLE KEYS */;


-- Dumping structure for table db_office.instansi
CREATE TABLE IF NOT EXISTS `instansi` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `background_logo` varchar(100) NOT NULL,
  `login_logo_header` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table db_office.instansi: ~1 rows (approximately)
DELETE FROM `instansi`;
/*!40000 ALTER TABLE `instansi` DISABLE KEYS */;
INSERT INTO `instansi` (`id`, `nama`, `alamat`, `logo`, `background_logo`, `login_logo_header`) VALUES
	(1, 'BTIKP DINAS PENDIDIKAN PROVINSI JAMBI', 'Jl. Jendral A. Yani No.06 Telaneipura Jambi\r\nTel/Fax: +62 741 63197', 'unja12.png', 'back_32.png', 'logo_login.jpg');
/*!40000 ALTER TABLE `instansi` ENABLE KEYS */;


-- Dumping structure for table db_office.kode_fkip
CREATE TABLE IF NOT EXISTS `kode_fkip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.kode_fkip: ~3 rows (approximately)
DELETE FROM `kode_fkip`;
/*!40000 ALTER TABLE `kode_fkip` DISABLE KEYS */;
INSERT INTO `kode_fkip` (`id`, `id_parent`, `nama`, `kode`) VALUES
	(1, 0, 'KASUBAG. TATA USAHA', 'BTIKP'),
	(2, 1, 'SUB. BAGIAN PENGEMBANGAN TEKNOLOGI PEMBELAJARAN BERBASIS RTF DAN MULTIMEDIA', 'BTIKP-1'),
	(3, 1, 'SUB. BAGIAN JEJARING DAN WEB', 'BTIKP-2');
/*!40000 ALTER TABLE `kode_fkip` ENABLE KEYS */;


-- Dumping structure for table db_office.kode_hal_org
CREATE TABLE IF NOT EXISTS `kode_hal_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.kode_hal_org: ~1 rows (approximately)
DELETE FROM `kode_hal_org`;
/*!40000 ALTER TABLE `kode_hal_org` DISABLE KEYS */;
INSERT INTO `kode_hal_org` (`id`, `kode`, `nama`, `keterangan`) VALUES
	(3, 'DISDIK', 'Dinas Pendidikan Provinsi Jambi', '-');
/*!40000 ALTER TABLE `kode_hal_org` ENABLE KEYS */;


-- Dumping structure for table db_office.menu
CREATE TABLE IF NOT EXISTS `menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `sub_dari` enum('instansi','aset','surat') NOT NULL,
  `nama` varchar(50) NOT NULL,
  `url` varchar(25) NOT NULL,
  `icon` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table db_office.menu: 11 rows
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


-- Dumping structure for table db_office.pengguna
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
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.pengguna: 7 rows
DELETE FROM `pengguna`;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` (`id`, `id_unit`, `nama`, `nomor_induk`, `jabatan`, `jenjang`, `username`, `password`, `tgl_aktif`, `status`, `level`, `apps`, `id_kode_fkip`, `id_menu`, `email`, `ttd_image`, `kehadiran_status`, `kehadiran_keterangan`) VALUES
	(1, '', 'Hely Kurniawan', '11', 'Admin E-Persuratan', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2014-05-20 09:10:20', 'Y', 'admin root', 'instansi', 1, '1,2,9,13,14,', 'helykurniawan@gmail.com', '1f53738431bd77296ed51e2a9b787dab.jpg', 'hadir', 'hadir'),
	(7, '02', 'Azwan, S.Sos., M.E', '197012191994031005', 'Kepala Bidang', '', '197012191994031005', '166982af1c60f416c9dd8f21aed56dce', '2014-05-27 08:29:55', 'Y', 'pimpinan', 'surat', 1, '3,4,5,6,7,', 'azwan@yahoo.com', '1f53738431bd77296ed51e2a9b787dab.jpg', 'hadir', 'HADIR OK'),
	(15, '02', 'Hasan Basri, S.Ag', '196804211993031002', 'Kasi. Pengembangan Teknologi Pembelajaran Berbasis', '', '196804211993031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:48:58', 'Y', 'staff', 'surat', 2, '5,6,7,', 'hasbas@yahoo.com', 'blank.jpg', 'hadir', ''),
	(16, '02', 'Welma', '196505091992031003', 'Kasi. Jejaring dan Web', '', '196505091992031003', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:50:35', 'Y', 'staff', 'surat', 3, '5,6,7,', 'welma@yahoo.com', 'blank.jpg', 'hadir', ''),
	(17, '02', 'Munzzani', '196701061993031002', 'Kasubag. Tata Usaha', '', '196701061993031002', 'e10adc3949ba59abbe56e057f20f883e', '2014-10-16 14:55:09', 'Y', 'staff', 'surat', 1, '5,6,7,', 'munzanni@yahoo.com', 'blank.jpg', 'hadir', ''),
	(68, '02', 'Muhammad Tohir, M.Pd', '123444', 'PPTK', '0', 'mtoher', 'e10adc3949ba59abbe56e057f20f883e', '2015-04-02 17:18:49', 'Y', 'staff', 'surat', NULL, '5,6,7,', 'mtoher@yahoo.com', 'blank.jpg', 'hadir', ''),
	(67, '02', 'Adam Ibrahim, S.IP', '1313131', 'Admin Surat', '', 'admin_surat', 'e10adc3949ba59abbe56e057f20f883e', '2015-04-02 17:04:23', 'Y', 'staff', 'surat', 1, '5,6,7,', 'adam@yahoo.com', 'blank.jpg', 'hadir', '');
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;


-- Dumping structure for table db_office.r_jenis_surat
CREATE TABLE IF NOT EXISTS `r_jenis_surat` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.r_jenis_surat: 3 rows
DELETE FROM `r_jenis_surat`;
/*!40000 ALTER TABLE `r_jenis_surat` DISABLE KEYS */;
INSERT INTO `r_jenis_surat` (`id`, `nama`) VALUES
	(1, 'Surat Tugas'),
	(8, 'Surat Undangan'),
	(7, 'Surat Pemberitahuan');
/*!40000 ALTER TABLE `r_jenis_surat` ENABLE KEYS */;


-- Dumping structure for table db_office.surat_keluar
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
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.surat_keluar: 2 rows
DELETE FROM `surat_keluar`;
/*!40000 ALTER TABLE `surat_keluar` DISABLE KEYS */;
INSERT INTO `surat_keluar` (`id`, `id_rel_surat_masuk`, `id_rel_disposisi`, `pengirim`, `pengirim_user`, `tgl_surat`, `no_agenda`, `no_surat`, `penerima`, `perihal`, `kecepatan`, `pemeriksa`, `pemeriksa_user`, `paraf_list`, `flag_setuju`, `flag_keluar`, `flag_del`, `flag_revisi`, `tipe`, `id_buat_surat`, `file`, `id_jenis_surat`, `isi_surat`, `id_kode_hal_org`, `catatan`) VALUES
	(27, 0, 0, '02', 67, '2015-04-03', '', '', 'sfsfsfsf', 'sdfsf', 'sangat segera', '02', 17, NULL, 'N', 'N', 'N', 'N', 'file', 0, '', 1, '<p>sfsffsfsfsfsfs</p>', 3, NULL),
	(26, 0, 0, '', 67, '2015-04-03', '', '', 'Sekertaris', 'Surat Undangan Rapat', 'sangat segera', '02', 15, NULL, 'N', 'N', 'N', 'N', 'file', 0, '', 8, '<p>dENGAN INI SAYA LAMPIRAKN</p>', 3, NULL);
/*!40000 ALTER TABLE `surat_keluar` ENABLE KEYS */;


-- Dumping structure for table db_office.surat_keluar_revisi
CREATE TABLE IF NOT EXISTS `surat_keluar_revisi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` datetime DEFAULT NULL,
  `id_surat` int(11) DEFAULT NULL,
  `id_pengguna` int(11) DEFAULT NULL,
  `isi_revisi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.surat_keluar_revisi: ~0 rows (approximately)
DELETE FROM `surat_keluar_revisi`;
/*!40000 ALTER TABLE `surat_keluar_revisi` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_keluar_revisi` ENABLE KEYS */;


-- Dumping structure for table db_office.surat_masuk
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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.surat_masuk: 1 rows
DELETE FROM `surat_masuk`;
/*!40000 ALTER TABLE `surat_masuk` DISABLE KEYS */;
INSERT INTO `surat_masuk` (`id`, `tgl_diterima`, `tgl_surat`, `pengirim`, `nomor`, `no_agenda`, `penerima`, `tembusan`, `perihal`, `kecepatan`, `file`, `flag_read`, `flag_del`, `flag_lanjut`, `flag_tolak`, `alasan`) VALUES
	(13, '2015-04-03 00:09:46', '2015-04-03', 'KADIS', 'S234/DISDIK/BTKIP-1/I/2015', '000001', '02', '', 'Undangan Rapat', 'sangat segera', 'PROGRAM_DAN_KEGIATAN_BTIKP.docx', 'Y', 'Y', 'Y', 'N', '');
/*!40000 ALTER TABLE `surat_masuk` ENABLE KEYS */;


-- Dumping structure for table db_office.surat_tanggapan
CREATE TABLE IF NOT EXISTS `surat_tanggapan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_surat` int(10) NOT NULL,
  `catatan` varchar(250) NOT NULL,
  `file` varchar(250) NOT NULL,
  `tgl_kirim` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Dumping data for table db_office.surat_tanggapan: 0 rows
DELETE FROM `surat_tanggapan`;
/*!40000 ALTER TABLE `surat_tanggapan` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat_tanggapan` ENABLE KEYS */;


-- Dumping structure for table db_office.unit
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

-- Dumping data for table db_office.unit: 25 rows
DELETE FROM `unit`;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` (`id`, `unit_0`, `unit_1`, `unit_2`, `unit_3`, `kode_gabung`, `nama_unit`) VALUES
	(1, '', '', '', '', '', 'Dinas Pendidikan Provinsi Jambi'),
	(44, '02', '04', '02', '', '020402', 'PG-PAUD'),
	(45, '02', '04', '03', '', '020403', 'Bimbingan Konseling'),
	(6, '02', '', '', '', '02', 'BALAI TEKNOLOGI INFORMASI & KOMUNIKASI (BTIKP)'),
	(43, '02', '04', '01', '', '020401', 'Pendidikan Guru Sekolah Dasar (PGSD)'),
	(9, '03', '01', '', '', '0301', 'Pendidikan Bahasa Indonesia'),
	(10, '03', '02', '', '', '0302', 'Pendidikan Bahasa Inggris'),
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
	(49, '02', '04', '07', '', '020407', 'Administrasi Pendidikan');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
