<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class jqueri extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		echo "error 505";
	}
	
	public function update_flag_read() {
		$id = empty($_GET['id']) ? NULL : $_GET['id'];
			
		$this->db->query("UPDATE surat_masuk SET flag_read = 'Y' WHERE id = '$id'");
	}

}