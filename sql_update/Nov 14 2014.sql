-- Dumping structure for table hk2y3243_surat.kode_fkip
CREATE TABLE IF NOT EXISTS `kode_fkip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kode` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat.kode_fkip: ~8 rows (approximately)
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


-- Dumping structure for table hk2y3243_surat.kode_hal_org
CREATE TABLE IF NOT EXISTS `kode_hal_org` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(50) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table hk2y3243_surat.kode_hal_org: ~2 rows (approximately)
DELETE FROM `kode_hal_org`;
/*!40000 ALTER TABLE `kode_hal_org` DISABLE KEYS */;
INSERT INTO `kode_hal_org` (`id`, `kode`, `nama`, `keterangan`) VALUES
	(3, 'AKJ', 'Akreditas', '-'),
	(4, 'AJ', 'Analisis Jabatan', '-');
/*!40000 ALTER TABLE `kode_hal_org` ENABLE KEYS */;

ALTER TABLE `menu` ALTER `nama` DROP DEFAULT;
ALTER TABLE `menu` CHANGE COLUMN `nama` `nama` VARCHAR(50) NOT NULL AFTER `sub_dari`;

INSERT INTO `menu` (`sub_dari`, `nama`, `url`, `icon`) VALUES ('instansi', 'Kode Hal Organisasi', 'kode_hal_org', 'envelope-o');
INSERT INTO `menu` (`sub_dari`, `nama`, `url`, `icon`) VALUES ('instansi', 'Kode Surat', 'kode_surat', 'envelope-o');

ALTER TABLE `pengguna` ADD COLUMN `id_kode_fkip` INT(11) NULL AFTER `apps`;

UPDATE `pengguna` SET `id_menu`='1,2,9,13,14,' WHERE  `id`=1;

ALTER TABLE `surat_keluar` ADD COLUMN `paraf_list` VARCHAR(50) NULL DEFAULT NULL AFTER `pemeriksa_user`;

ALTER TABLE `surat_keluar` ADD COLUMN `id_kode_hal_org` INT(11) NOT NULL AFTER `isi_surat`;
