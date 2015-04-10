<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uji extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
	
	}
	
	public function kirim_email() {

	$isi_pesan 			= "			
	Kepada Yth. Tes

	Anda Tes menerima surat masuk, dari (dari) tertanggal (tanggal), perihal (perihal)

	Terima kasih. 
	ttd
	Admin Surat

	*) Do not reply this email..";
	
	if (kirim_email("akhwan90@gmail.com", "AMS - Pemberitahuan Surat Masuk (nur-akhwan.web.id)", $isi_pesan) == TRUE) {
		echo "terkirim";
	} else {
		echo "tidak terkirim";
	} 
	}

	
}