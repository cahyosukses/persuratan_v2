<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Surat extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->model('web_model');
	}
	
	//function _count_surat_masuk(){
	//	$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
	//	
	//	$wh = empty($a['admin_id_unit']) ? "" : "WHERE penerima = '".$a['admin_id_unit']."'";
	//	$a	= $this->db->query("SELECT COUNT(surat_masuk.id) as belum_dibaca
	//							FROM surat_masuk
	//							INNER JOIN unit ON surat_masuk.penerima = unit.kode_gabung
	//							$wh  AND flag_del = 'Y' AND flag_read = 'N'");
	//	return $a->row();
	//	
	//}
	
	public function index() {
		$admin_valid			= $this->session->userdata('admin_valid');
		$admin_id				= $this->session->userdata('admin_id');
		$admin_level			= $this->session->userdata('admin_level');
		$admin_ta				= $this->session->userdata('admin_ta');
		$admin_id_unit			= $this->session->userdata('admin_id_unit');
		
		if ($admin_valid == FALSE || $admin_id == "") { redirect("apps/login"); } 	
		
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = $admin_id")->row();
		$a['not_surat_masuk']	= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_read = 'N' AND flag_del = 'Y'")->num_rows();
		$a['not_surat_lanjut']	= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_read = 'N' AND flag_lanjut = 'N' AND flag_del = 'Y'")->num_rows();
		$a['not_disp_masuk']	= $this->db->query("SELECT id FROM disposisi WHERE penerima = '$admin_id_unit' AND penerima_user = '$admin_id' AND flag_read = 'N' AND flag_lanjut = 'N'")->num_rows();
		$a['not_konsep_masuk']	= $this->db->query("SELECT id FROM surat_keluar WHERE pemeriksa_user = '$admin_id' AND flag_setuju = 'N' AND flag_del = 'Y'")->num_rows();
		
		$a['page']				= "surat/d_amain";
		
		$this->load->view('aaa', $a);
	} 
	
	public function surat_masuk() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 3, "surat"); 	
 	
		
		/* pagination */	
		$total_row				= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '".$a['admin_id_unit']."' AND flag_del = 'Y'")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		//$tgl_diterima			= addslashes($this->input->post('tgl_diterima'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$pengirim				= addslashes($this->input->post('pengirim'));
		$nomor					= addslashes($this->input->post('nomor'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$penerima				= addslashes($this->input->post('penerima'));
		$tembusan				= addslashes($this->input->post('tembusan'));
		$perihal				= addslashes($this->input->post('perihal'));
		$kecepatan				= addslashes($this->input->post('kecepatan'));
		
		$cari					= addslashes($this->input->post('q'));//pencarian

		//upload config 
		$config['upload_path'] 		= './upload/surat_masuk';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '8000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		
		if ($mau_ke == "del") {
			$this->db->query("UPDATE surat_masuk SET flag_del = 'N' WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data dihapus </div>");
			redirect('surat/surat_masuk');
		} else if ($mau_ke == "cari") {
			/*
			$a['data']		= $this->db->query("SELECT * FROM surat_masuk WHERE perihal LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "surat/l_surat_masuk";
			*/
			
			/* FIX */
			$a['cari'] = $cari;
			$wh = empty($a['admin_id_unit']) ? "" : "WHERE penerima = '".$a['admin_id_unit']."'";
			$a['data']		= $this->db->query("SELECT surat_masuk.*, unit.nama_unit AS penerimanya, 
												(SELECT nama_unit FROM unit WHERE kode_gabung = surat_masuk.tembusan) AS tembusannya
												FROM surat_masuk 
												INNER JOIN unit ON surat_masuk.penerima = unit.kode_gabung
												$wh  AND flag_del = 'Y' AND perihal LIKE '%$cari%' ORDER BY id DESC ")->result();
			$a['page']		= "surat/l_surat_masuk";
			
		} else if ($mau_ke == "add") {
			$a['page']		= "surat/f_surat_masuk";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM surat_masuk WHERE id = '$idu'")->row();	
			$a['page']		= "surat/f_surat_masuk";
		} else if ($mau_ke == "act_add") {	
			$detil_penerima		= $this->db->query("SELECT pengguna.*, unit.nama_unit FROM pengguna INNER JOIN unit ON pengguna.id_unit = unit.kode_gabung WHERE pengguna.id_unit = '$penerima'")->result();

			cek_empty_post("apps/surat_masuk");
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO surat_masuk VALUES (NULL, NOW(), '$tgl_surat', '$pengirim', '$nomor', '$no_agenda', '$penerima', '$tembusan', '$perihal', '$kecepatan', '".$up_data['file_name']."', 'N', 'Y', 'N', 'N', '')");
			} else {
				$this->db->query("INSERT INTO surat_masuk VALUES (NULL, NOW(), '$tgl_surat', '$pengirim', '$nomor', '$no_agenda', '$penerima', '$tembusan', '$perihal', '$kecepatan', '', 'N', 'Y', 'N', 'N', '')");
			}
			
			$email_kir	= "";
			if (!empty($detil_penerima)) {
				foreach ($detil_penerima as $dp) {
				$isi_pesan 			= "			
				Kepada Yth. ".$dp->username." (".$dp->nama.") 
				
				Anda (".strtoupper($dp->level)." ".$dp->nama_unit.") menerima surat masuk, dari ".$pengirim." tertanggal ".tgl_jam_sql($tgl_surat).", perihal ".$perihal."
				
				Terima kasih. 
				ttd
				Admin Surat
				
				*) Do not reply this email..";

					kirim_email($dp->email, "E-Persuratan - Pemberitahuan Surat Masuk ", $isi_pesan);
				}
				$email_kir	.= "Email terkirim";
			} else {
				$email_kir	.= "Email tidak terkirim";
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan dan $email_kir. ".$this->upload->display_errors()."</div>");
			redirect('surat/surat_masuk');
		} else if ($mau_ke == "act_edt") {
			cek_empty_post("surat/surat_masuk");
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				$filenya		= gval("surat_masuk", "id", "file", $idp);
				@unlink("./upload/surat_masuk/".$filenya);
							
				$this->db->query("UPDATE surat_masuk SET tgl_surat = '$tgl_surat', pengirim = '$pengirim', nomor = '$nomor', no_agenda = '$no_agenda', penerima = '$penerima', tembusan = '$tembusan', perihal = '$perihal', kecepatan = '$kecepatan', file = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE surat_masuk SET tgl_surat = '$tgl_surat', pengirim = '$pengirim', nomor = '$nomor', no_agenda = '$no_agenda', penerima = '$penerima', tembusan = '$tembusan', perihal = '$perihal', kecepatan = '$kecepatan' WHERE id = '$idp'");
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data diupdate. ".$this->upload->display_errors()."</div>");			
			redirect('surat/surat_masuk');
		} else if($mau_ke == "baca"){
			
			$nama_file = $this->db->query("SELECT file FROM surat_masuk WHERE id = $idu")->row();		
			
			if(!empty($nama_file)){
				$this->load->helper('download');
				
				$data = file_get_contents('upload/surat_masuk/' . $nama_file); // Read the file's contents
				$extensi = '.' . pathinfo('upload/surat_masuk/' . $nama_file, PATHINFO_EXTENSION);
				
				force_download(str_pad((int)$idu,3,0,STR_PAD_LEFT) . $extensi , $data);			
			}
			
			$this->db->query("UPDATE surat_masuk SET flag_read = 'Y' WHERE id = $idu");
			
		} else {
			$wh = empty($a['admin_id_unit']) ? "" : "WHERE penerima = '".$a['admin_id_unit']."'";
			$a['data']		= $this->db->query("SELECT surat_masuk.*, unit.nama_unit AS penerimanya, 
												(SELECT nama_unit FROM unit WHERE kode_gabung = surat_masuk.tembusan) AS tembusannya
												FROM surat_masuk 
												INNER JOIN unit ON surat_masuk.penerima = unit.kode_gabung
												$wh  AND flag_del = 'Y' LIMIT $awal, $akhir ")->result();
			$a['page']		= "surat/l_surat_masuk";
		}
		
		$this->load->view('aaa', $a);
	}

	public function jenis_surat() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		//cek_akses_menu(($a['menu']->id_menu), 1, "instansi"); 	

		$a['data']				= $this->db->query("SELECT * FROM r_jenis_surat ORDER BY id ASC")->result();
		
		/* url */
		$aksi_u					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		/* $post */
		$aksi_post				= $this->input->post('aksi');
		$aksi_lagi				= empty($aksi_post) ? $aksi_u : $aksi_post;
		$idp					= $this->input->post('id');
		$nama					= $this->input->post('nama');
		$cari					= addslashes($this->input->post('q'));//pencarian
		$a['cari'] 				= $cari;
		
		if ($aksi_lagi == "act_edit") {
			$this->db->query("UPDATE r_jenis_surat SET nama = '$nama' WHERE id = $idp");
			redirect('surat/jenis_surat');
		} else if ($aksi_lagi == "del") {
			$this->db->query("DELETE FROM r_jenis_surat WHERE id = $id_u");
			redirect('surat/jenis_surat');
		} else if ($aksi_lagi == "add_") {
			$this->db->query("INSERT INTO r_jenis_surat VALUES (NULL, '$nama')");
			redirect('surat/jenis_surat');
			
		}else if($aksi_lagi == "cari"){
			
			$a['data']				= $this->db->query("SELECT * FROM r_jenis_surat WHERE nama LIKE '%$cari%' ORDER BY id ASC")->result();
			$a['page']				= "surat/d_jenis_surat";
		} else {
			$a['page']				= "surat/d_jenis_surat";
		}
		$this->load->view('aaa', $a);
	}
	
	public function surat_tanggapan() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat"); 	

		/* pagination 	
		$total_row				= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_del = 'Y'")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		*/
		$a['pagi']				= "";
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$catatan				= addslashes($this->input->post('catatan'));
		
		$id_surat				= addslashes($this->input->post('id_surat'));
		$alasan					= addslashes($this->input->post('alasan_tolak'));
		
		//upload config 
		$config['upload_path'] 		= './upload/surat_tanggapan';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		
		/*if ($mau_ke == "simpan") {	
			cek_empty_post("surat/surat_tanggapan/$idu");
			if ($this->upload->do_upload('file_tanggapan_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO surat_tanggapan VALUES (NULL, '$id_surat', '$catatan', '".$up_data['file_name']."', NOW())");
			} else {
				$this->db->query("INSERT INTO surat_tanggapan VALUES (NULL, '$id_surat', '$catatan', '', NOW())");
			}	
			$this->db->query("UPDATE surat_masuk SET flag_read = 'Y', flag_lanjut = 'Y' WHERE id = '$id_surat'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('surat/surat_masuk');
		} else */if ($mau_ke == "tolak") {
			$this->db->query("UPDATE surat_masuk SET flag_tolak = 'Y', flag_lanjut = 'N', alasan = '$alasan' WHERE id = '$id_surat'");
			$this->db->query("UPDATE surat_masuk SET flag_lanjut = 'N' WHERE id = '$id_surat'");
			redirect('surat/surat_masuk');
		} /*else if ($mau_ke == "add") {
			$a['data']		= $this->db->query("SELECT disposisi.*, unit.nama_unit AS nama_unit, pengguna.nama AS nama_pengguna, pengguna.level AS level_pengguna FROM disposisi 
			INNER JOIN unit ON disposisi.dari = unit.kode_gabung 
			INNER JOIN pengguna ON disposisi.dari_user = pengguna.id
			WHERE disposisi.id = '$idu'")->row();
			//echo $this->db->last_query();
			//echo $this->db->last_query()." - - - ".$admin_level;
			$a['page']		= "surat/f_surat_tanggapan";
		}*/
		
		$this->load->view('aaa', $a);
	}
	
	public function disposisi_masuk() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 5, "surat"); 	
		
		$a['pagi']				= "";
		$mau_ke					= $this->uri->segment(3);
		
		$cari					= addslashes($this->input->post('q'));//pencarian

		if ($mau_ke == "add") {
			$id_data		= $this->uri->segment(4);
			$asal_data		= $this->uri->segment(5);
			
			if (empty($id_data) || empty($asal_data)) { redirect("apps"); }
			$tabel			= $asal_data == "surat" ? "surat_masuk" : "disposisi";
			$view			= $asal_data == "surat" ? "surat/f_disposisi_out_surat" : "surat/f_disposisi_out_disposisi";
			$a['detil_data']= $this->db->query("SELECT * FROM $tabel WHERE id = '$id_data'")->row();
			$a['page']		= $view;
			
		} else if ($mau_ke == "act_add") {	
			cek_empty_post("surat/surat_masuk");
			$idp			= addslashes($this->input->post('idp'));
			$id_data		= addslashes($this->input->post('id_data'));
			$asal			= addslashes($this->input->post('asal'));
			$penerima		= addslashes($this->input->post('penerima'));
			$intruksi		= addslashes($this->input->post('intruksi'));
			$kecepatan		= addslashes($this->input->post('kecepatan'));
			$tgl_selesai	= addslashes($this->input->post('tgl_selesai'));
			$isi_disposisi	= addslashes($this->input->post('isi_disposisi'));
			
			$this->db->query("INSERT INTO disposisi VALUES (NULL, '$asal', '$id_data', '".$a['admin_id_unit']."', '$penerima', '$intruksi', '$kecepatan', '$tgl_selesai', '$isi_disposisi', NOW())");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan</div>");
			redirect('surat/surat_masuk');
		} else {
			$a['data']		= $this->db->query("
			SELECT disposisi.*, pengguna.level AS level, pengguna.nama AS nama_user, unit.nama_unit AS tujuan, surat_masuk.pengirim AS pengirim, surat_masuk.perihal AS perihal_surat, surat_masuk.file AS file_surat
			FROM disposisi 
			INNER JOIN unit ON disposisi.penerima = unit.kode_gabung 
			INNER JOIN pengguna ON disposisi.dari_user = pengguna.id 
			INNER JOIN surat_masuk ON disposisi.id_surat = surat_masuk.id
			WHERE disposisi.penerima = '".$a['admin_id_unit']."' AND disposisi.penerima_user = '".$a['admin_id']."' 
			AND disposisi.flag_tolak = 'N'")->result();
			//echo $this->db->last_query()." - - - ".$admin_level;
			$a['page']		= "surat/l_disposisi_masuk";
		}
		
		$this->load->view('aaa', $a);
	}
		
	public function disposisi_keluar() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		
		$a['menu']				= $this->db->query("SELECT id_menu
												    FROM pengguna
													WHERE id = ".$a['admin_id']."")->row();		
		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		if($a['admin_level'] !== 'tata usaha'){
			cek_akses_menu(($a['menu']->id_menu), 6, "surat"); 		
		}
		

		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
				
		$a['pagi']				= "";
		$mau_ke					= $this->uri->segment(3);
		
		$cari					= addslashes($this->input->post('q'));//pencarian

		if ($mau_ke == "add") {
			$id_data		= $this->uri->segment(4);
			$asal_data		= $this->uri->segment(5);
			
			if (empty($id_data) || empty($asal_data)) { redirect("apps"); }
			if ($asal_data == "surat") {
				$this->db->query("UPDATE surat_masuk SET flag_read = 'Y' WHERE id = '$id_data'");
				$a['detil_data']	= $this->db->query("SELECT * FROM surat_masuk WHERE id = '$id_data'")->row();
				$a['page']			= "surat/f_disposisi_out_surat";
			} else if ($asal_data == "disposisi") {
				$this->db->query("UPDATE disposisi SET flag_read = 'Y' WHERE id = '$id_data'");
				$q_ambil_id_surat	= $this->db->query("SELECT id_surat FROM disposisi WHERE id = '$id_data'")->row();
				$a['detil_surat']	= $this->db->query("SELECT * FROM surat_masuk WHERE id = '".$q_ambil_id_surat->id_surat."'")->row();
				$a['riwayat_disp']	= $this->db->query("SELECT disposisi.*, 
														unit.nama_unit AS pemberi_nama_unit, pengguna.level AS pemberi_level, pengguna.nama AS pemberi_nama,
														b.nama_unit AS penerima_nama_unit, c.level AS penerima_level, c.nama AS penerima_nama
														FROM disposisi
														INNER JOIN unit ON disposisi.dari = unit.kode_gabung
														INNER JOIN pengguna ON disposisi.dari_user = pengguna.id 
														INNER JOIN unit AS b ON disposisi.penerima = b.kode_gabung
														INNER JOIN pengguna AS c ON disposisi.penerima_user = c.id
														WHERE disposisi.id_surat = '".$q_ambil_id_surat->id_surat."'")->result();
				$a['page']			= "surat/f_disposisi_out_disposisi";		
			}
			
		} else if ($mau_ke == "act_add") {	
			cek_empty_post("apps/surat_masuk");
			$idp			= addslashes($this->input->post('idp'));
			$id_data		= addslashes($this->input->post('id_data'));
			$id_surat		= addslashes($this->input->post('id_surat'));
			$asal			= addslashes($this->input->post('asal'));
			$penerima		= addslashes($this->input->post('penerima'));
			$user			= addslashes($this->input->post('user'));
			$intruksi		= addslashes($this->input->post('intruksi'));
			$kecepatan		= addslashes($this->input->post('kecepatan'));
			$tgl_selesai	= addslashes($this->input->post('tgl_selesai'));
			$isi_disposisi	= addslashes($this->input->post('isi_disposisi'));
			
			$g_disp_ke		= gli3("disposisi", "disp_ke", 1, "WHERE id_surat = '$id_surat'");
			
			$disp_ke		= $asal == "surat" ? 1 : $g_disp_ke;
			
			$this->db->query("INSERT INTO disposisi VALUES (NULL, '$id_surat', '$asal', '$id_surat', '".$a['admin_id_unit']."', '".$a['admin_id']."', '$penerima', '$user', '$intruksi', '$kecepatan', '$tgl_selesai', '$isi_disposisi', NOW(), 'N', 'N', 'N', '', '$disp_ke')");
			$this->db->query("UPDATE surat_masuk SET flag_lanjut = 'Y' WHERE id = '$id_surat'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan</div>");
			
			redirect('surat/disposisi_keluar');
			
		} else if ($mau_ke == "detil") {
			$a['data']		= $this->db->query("SELECT disposisi.*, pengguna.level AS level, pengguna.nama AS nama_user,
												unit.nama_unit AS tujuan FROM disposisi 
												INNER JOIN unit ON disposisi.penerima = unit.kode_gabung 
												INNER JOIN pengguna ON disposisi.penerima_user = pengguna.id 
												WHERE disposisi.id_surat = '".$this->uri->segment(4)."'")->result();
			$a['page']		= "surat/l_disposisi_keluar";
		} else {
			$a['data']		= $this->db->query("SELECT disposisi.*, pengguna.level AS level, pengguna.nama AS nama_user,
												unit.nama_unit AS tujuan FROM disposisi 
												INNER JOIN unit ON disposisi.penerima = unit.kode_gabung 
												INNER JOIN pengguna ON disposisi.penerima_user = pengguna.id 
												WHERE disposisi.dari = '".$a['admin_id_unit']."' AND disposisi.dari_user = '".$a['admin_id']."'")->result();
			//echo $this->db->last_query()." - - - ".$admin_level;
			$a['page']		= "surat/l_disposisi_keluar";
		}
		
		$this->load->view('aaa', $a);
	}

	public function disposisi_tanggapan() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat"); 	

		/* pagination 	
		$total_row				= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_del = 'Y'")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		*/
		$a['pagi']				= "";
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$id_disposisi			= addslashes($this->input->post('id_disposisi'));
		$catatan				= addslashes($this->input->post('catatan'));
		
		$id_disposisi			= addslashes($this->input->post('id_disposisi'));
		$id_surat				= addslashes($this->input->post('id_surat'));
		$alasan					= addslashes($this->input->post('alasan_tolak'));
		
		//upload config 
		$config['upload_path'] 		= './upload/disposisi_tanggapan';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		
		if ($mau_ke == "simpan") {	
			cek_empty_post("surat/disposisi_tanggapan/$idu");
			if ($this->upload->do_upload('file_tanggapan_disposisi')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO disposisi_tanggapan VALUES (NULL, '$id_disposisi', '$catatan', '".$up_data['file_name']."', NOW())");
			} else {
				$this->db->query("INSERT INTO disposisi_tanggapan VALUES (NULL, '$id_disposisi', '$catatan', '', NOW())");
			}	
			$this->db->query("UPDATE disposisi SET flag_read = 'Y', flag_lanjut = 'Y' WHERE id = '$id_disposisi'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan. ".$this->upload->display_errors()."</div>");
			redirect('surat/disposisi_masuk');
		} else if ($mau_ke == "tolak") {
			$this->db->query("UPDATE disposisi SET flag_tolak = 'Y', alasan = '$alasan' WHERE id = '$id_disposisi'");
			$this->db->query("UPDATE surat_masuk SET flag_lanjut = 'N' WHERE id = '$id_surat'");
			redirect('surat/disposisi_masuk');
		} else if ($mau_ke == "add") {
			$a['data']		= $this->db->query("SELECT disposisi.*, unit.nama_unit AS nama_unit, pengguna.nama AS nama_pengguna, pengguna.level AS level_pengguna FROM disposisi 
			INNER JOIN unit ON disposisi.dari = unit.kode_gabung 
			INNER JOIN pengguna ON disposisi.dari_user = pengguna.id
			WHERE disposisi.id = '$idu'")->row();
			//echo $this->db->last_query();
			//echo $this->db->last_query()." - - - ".$admin_level;
			$a['page']		= "surat/f_disposisi_tanggapan";
		}
		
		$this->load->view('aaa', $a);
	}
	
	public function surat_keluar() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 4, "surat"); 	
		
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
		//echo $this->db->last_query();
		/* pagination */	
		$total_row				= $this->db->query("SELECT * FROM surat_keluar")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));
		$a['cari'] 				= $cari;

		if ($mau_ke == "del") {
			$filenya	= gval("surat_keluar", "id", "file", $idu);
			@unlink("./upload/surat_keluar/".$filenya);
			$this->db->query("DELETE FROM surat_keluar WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data dihapus </div>");
			redirect('surat/surat_keluar');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM surat_keluar WHERE perihal LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "surat/l_surat_keluar";
		} else if ($mau_ke == "detil") {
			$data			= $this->db->query("SELECT *, unit.nama_unit AS unit_pengirim, pengguna.nama AS pemeriksa_u,
												(SELECT pengguna.nama FROM pengguna WHERE id = surat_keluar.pengirim_user) AS pembuat
												FROM surat_keluar
												INNER JOIN unit ON unit.kode_gabung = surat_keluar.pengirim
												INNER JOIN pengguna ON pengguna.id = surat_keluar.pemeriksa_user 
												WHERE surat_keluar.id = '".$_GET['id']."'")->row();
			if (!empty($data)) { 
				echo "<table class='table-form' width='100%'>
						<tr><td width='30%'>Unit Pengirim</td><td width='5%'>:</td><td width='65%'>".$data->unit_pengirim."</td></tr>
						<tr><td>Dibuat oleh</td><td>:</td><td>".$data->pembuat."</td></tr>
						<tr><td>Tgl. Surat</td><td>:</td><td>".tgl_jam_sql($data->tgl_surat)."</td></tr>
						<tr><td>Nomor Agenda</td><td>:</td><td>".$data->no_agenda."</td></tr>
						<tr><td>Nomor Surat</td><td>:</td><td>".$data->no_surat."</td></tr>
						<tr><td>Penerima</td><td>:</td><td>".$data->penerima."</td></tr>
						<tr><td>Perihal</td><td>:</td><td>".$data->perihal."</td></tr>
						<tr><td>Kecepatan</td><td>:</td><td>".$data->kecepatan."</td></tr>
						<tr><td>Diperiksa oleh</td><td>:</td><td>".$data->pemeriksa_u."</td></tr>
					  </table>";
			}			
			exit;
		} else {
			if ($a['admin_level'] == "tata usaha") {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y'
													ORDER BY no_agenda
													LIMIT $awal, $akhir ")->result();
			} else {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y' AND pengirim = '".$a['admin_id_unit']."'
													ORDER BY no_agenda
													LIMIT $awal, $akhir ")->result();
			}
			$a['page']		= "surat/l_surat_keluar";
		}
		
		$this->load->view('aaa', $a);
	}
	
	//get nomor surat keluar
	public function get_nomor_surat($id){
		//Nomor : 001/UN21.1.7/KM/2014
		$nomor_surat = $this->db->query(" SELECT CONCAT(LPAD(a.id,3,'0'),'/',
												 IFNULL(c.kode,'_________'),'/',
												 IFNULL(d.kode,'___'),'/',
												 YEAR(a.tgl_surat)) as nomor_surat 
										  FROM surat_keluar a
										  LEFT JOIN pengguna b ON a.pengirim_user = b.id
										  LEFT JOIN kode_fkip c ON b.id_kode_fkip = c.id
										  LEFT JOIN kode_hal_org d ON a.id_kode_hal_org = d.id
										  WHERE a.id = $id")->row()->nomor_surat;
		echo $nomor_surat;		
	}
	
	public function konsep() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat"); 	
		
		 	
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
		//echo $this->db->last_query();
		/* pagination */	
		$total_row				= $this->db->query("SELECT * FROM surat_keluar")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));
		$a['cari'] 				=  $cari;

		//ambil variabel Postingan
		$id_surat				= addslashes($this->input->post('id_surat'));
		$no_agenda				= addslashes($this->input->post('no_agenda'));
		$no_surat				= addslashes($this->input->post('no_surat'));
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$tgl_surat				= addslashes($this->input->post('tgl_surat'));
		$penerima				= addslashes($this->input->post('penerima'));
		$kecepatan				= addslashes($this->input->post('kecepatan'));
		$pemeriksa				= addslashes($this->input->post('pemeriksa'));
		$user					= addslashes($this->input->post('user'));
		$perihal				= addslashes($this->input->post('perihal'));
		$jenis_syurat			= addslashes($this->input->post('jenis_syurat'));
		$tipe					= addslashes($this->input->post('tipe'));
		$id_kode_hal_org		= addslashes($this->input->post('id_kode_hal_org'));
		$isi_surat				= addslashes($this->input->post('isi_surat'));
		
		
		$cari					= addslashes($this->input->post('q'));//pencarian
				
		//upload config 
		$config['upload_path'] 		= './upload/surat_keluar';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '8000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		
		if ($mau_ke == "kirim") {
			
			cek_empty_post("apps/konsep");
			$this->db->query("UPDATE surat_keluar SET flag_keluar = 'Y', no_agenda = '$no_agenda', no_surat = '$no_surat' WHERE id = '$id_surat'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Surat telah dikirimkan dan Otomatis dipindahkan ke Surat Keluar</div>");			
			redirect('surat/konsep');
			
		} else if ($mau_ke == "add") {
			$a['r_kode_hal_org'] = $this->db->query("SELECT * FROM kode_hal_org");
			$a['page']		= "surat/f_surat_keluar";
			
		} else if ($mau_ke == "edit") {
			$a['r_kode_hal_org'] = $this->db->query("SELECT * FROM kode_hal_org");
			$a['datdet']	= $this->db->query("SELECT * FROM surat_keluar WHERE id = '$idu'")->row();
			$id_user = 	$this->session->userdata('admin_id');
			
			if($a['datdet']->pemeriksa_user === $id_user){
				$this->session->set_userdata('IS_REVISI','TRUE');	
			}
			
			$a['page']		= "surat/f_surat_keluar";
			
		} else if ($mau_ke == "detil") {
			
			$data			= $this->db->query("SELECT *, unit.nama_unit AS unit_pengirim, pengguna.nama AS pemeriksa_u,
												(SELECT pengguna.nama FROM pengguna WHERE id = surat_keluar.pengirim_user) AS pembuat
												FROM surat_keluar
												INNER JOIN unit ON unit.kode_gabung = surat_keluar.pengirim
												INNER JOIN pengguna ON pengguna.id = surat_keluar.pemeriksa_user 
												WHERE surat_keluar.id = '".$_GET['id']."'")->row();
			if (!empty($data)) { 
				echo "<table class='table-form' width='100%'>
						<tr><td width='30%'>Unit Pengirim</td><td width='5%'>:</td><td width='65%'>".$data->unit_pengirim."</td></tr>
						<tr><td>Dibuat oleh</td><td>:</td><td>".$data->pembuat."</td></tr>
						<tr><td>Tgl. Surat</td><td>:</td><td>".tgl_jam_sql($data->tgl_surat)."</td></tr>
						<tr><td>Nomor Agenda</td><td>:</td><td>".$data->no_agenda."</td></tr>
						<tr><td>Nomor Surat</td><td>:</td><td>".$data->no_surat."</td></tr>
						<tr><td>Penerima</td><td>:</td><td>".$data->penerima."</td></tr>
						<tr><td>Perihal</td><td>:</td><td>".$data->perihal."</td></tr>
						<tr><td>Kecepatan</td><td>:</td><td>".$data->kecepatan."</td></tr>
						<tr><td>Diperiksa oleh</td><td>:</td><td>".$data->pemeriksa_u."</td></tr>
					  </table>";
			}			
			exit;
		} else if ($mau_ke == "act_add") {	
			cek_empty_post("apps/konsep");
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT INTO surat_keluar(pengirim,
														  pengirim_user,
														  tgl_surat,
														  penerima,
														  perihal,
														  kecepatan,
														  pemeriksa,
														  pemeriksa_user,
														  flag_setuju,
														  flag_keluar,
														  flag_del,
														  flag_revisi,
														  tipe,
														  file,
														  id_jenis_surat,
														  isi_surat,
														  id_kode_hal_org)
								  VALUES ('".$a['admin_id_unit']."',
								          '".$a['admin_id']."',
										  '$tgl_surat',
										  '$penerima',
										  '$perihal',
										  '$kecepatan',
										  '$pemeriksa',
										  '$user',
										  'N',
										  'N',
										  'N',
										  'N',
										  '$tipe',
										  '".$up_data['file_name']."',
										  '$jenis_syurat',
										  '$isi_surat',
										  '$id_kode_hal_org')");
			} else {
				$this->db->query("INSERT INTO surat_keluar(pengirim,
														  pengirim_user,
														  tgl_surat,
														  penerima,
														  perihal,
														  kecepatan,
														  pemeriksa,
														  pemeriksa_user,
														  flag_setuju,
														  flag_keluar,
														  flag_del,
														  flag_revisi,
														  tipe,
											
														  id_jenis_surat,
														  isi_surat,
														  id_kode_hal_org)
								  VALUES ('".$a['admin_id_unit']."',
								          '".$a['admin_id']."',
										  '$tgl_surat',
										  '$penerima',
										  '$perihal',
										  '$kecepatan',
										  '$pemeriksa',
										  '$user',
										  'N',
										  'N',
										  'N',
										  'N',
										  '$tipe',										  
										  '$jenis_syurat',
										  '$isi_surat',
										  '$id_kode_hal_org')");
			}	
			
			//echo $isi_surat;
			//exit(0);
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data ditambahkan dan menunggu persetujuan pemeriksa. ".$this->upload->display_errors()."</div>");
			redirect('surat/konsep');
		}  else if ($mau_ke == "act_edt") {	
			
			cek_empty_post("surat/konsep");
			$status_revisi =$this->session->userdata('IS_REVISI');
			
			if ($this->upload->do_upload('file_surat')) {
				$up_data	 	= $this->upload->data();
				
				if($status_revisi === 'TRUE'){
					$this->db->query("UPDATE surat_keluar
								 SET tgl_surat = '$tgl_surat',
									 penerima = '$penerima',
									 perihal = '$perihal',
									 kecepatan = '$kecepatan',									 
									 file = '".$up_data['file_name']."',
									 id_jenis_surat = '$jenis_syurat',
									 isi_surat = '$isi_surat',
									 id_kode_hal_org = '$id_kode_hal_org'									 
									 WHERE id = '$idp'");
				}else{
					$this->db->query("UPDATE surat_keluar
								 SET tgl_surat = '$tgl_surat',
									 penerima = '$penerima',
									 perihal = '$perihal',
									 kecepatan = '$kecepatan',
									 pemeriksa = '$pemeriksa',
									 pemeriksa_user = '$user',
									 file = '".$up_data['file_name']."',
									 id_jenis_surat = '$jenis_syurat',
									 isi_surat = '$isi_surat',
									 id_kode_hal_org = '$id_kode_hal_org'									 
									 WHERE id = '$idp'");	
				}
				
				
			} else {
				if($status_revisi === 'TRUE'){
					$this->db->query("UPDATE surat_keluar
									  SET tgl_surat = '$tgl_surat',
										  penerima = '$penerima',
										  perihal = '$perihal',
										  kecepatan = '$kecepatan',										  
										  id_jenis_surat = '$jenis_syurat',
										  isi_surat = '$isi_surat',
										  id_kode_hal_org = '$id_kode_hal_org'									 
									  WHERE id = '$idp'");	
				}else{
					$this->db->query("UPDATE surat_keluar
									  SET tgl_surat = '$tgl_surat',
										  penerima = '$penerima',
										  perihal = '$perihal',
										  kecepatan = '$kecepatan',
										  pemeriksa = '$pemeriksa',
										  pemeriksa_user = '$user',
										  id_jenis_surat = '$jenis_syurat',
										  isi_surat = '$isi_surat',
										  id_kode_hal_org = '$id_kode_hal_org'									 
									  WHERE id = '$idp'");	
				}
				
			}	
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data diupdate. ".$this->upload->display_errors()."</div>");
			/*redirect('surat/konsep');*/
			redirect('surat/surat_keluar');
			
		} else if ($mau_ke == "setujui") {
			
			$this->db->query("UPDATE surat_keluar SET flag_setuju = 'Y' WHERE id = '$idu'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Surat telah disetujui </div>");			
			redirect('surat/konsep');
			
		}else if($mau_ke == "cari"){
			
			if ($a['admin_level'] == "tata usaha") {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'N' AND perihal LIKE '%$cari%'
													LIMIT $awal, $akhir ")->result();
			} else if ($a['admin_level'] == "staff") {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE (flag_keluar = 'N' OR flag_keluar = 'Y') AND pengirim = '".$a['admin_id_unit']."'
													AND pengirim_user = '".$a['admin_id']."' AND perihal LIKE '%$cari%'
													LIMIT $awal, $akhir ")->result();
				
			} else {													
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'N' OR flag_keluar = 'N' AND (pemeriksa = '".$a['admin_id_unit']."' 
													OR pemeriksa_user = '".$a['admin_id']."') AND perihal LIKE '%$cari%'
													LIMIT $awal, $akhir")->result();
			}
			
			$a['page']		= "surat/l_konsep";
			
		} elseif($mau_ke == "paraf"){
			//http://localhost/persuratan/surat/konsep/paraf/idu/id_paraf
			//$mau_ke					= $this->uri->segment(3);
			
			//operator -> Kabag Tata Usaha FKIP Universitas Jambi -> wakil dekan 1 ->wakil dekan 2 ->wakil dekan 3 -> dekan ->operator
			
			//$idu					= $this->uri->segment(4);
			
			$id_surat = "";
			$id_paraf = "";
			$catatan = "";
			
			$id_surat 				=	$this->input->post('id_surat');
			$id_paraf				= 	$this->input->post('pemeriksa_user'); //next user
			$catatan				= 	$this->input->post('catatan');
			
			/*	
			if(!empty($_POST)){
				
				
			}else{
				$id_surat					= $this->uri->segment(4);
				$id_paraf					= $this->uri->segment(5);
			}
			*/
			
			$id_user 				= 	$this->session->userdata('admin_id');
			
			//update pemeriksa_user			
			$this->db->where('id',$id_surat);
			$this->db->update('surat_keluar',array(
												   'pemeriksa_user'=>$id_paraf,
												   'catatan'=>$catatan
												   )
							  );
			
			//update paraf_list
			$this->db->query("UPDATE surat_keluar
							  SET paraf_list = CONCAT(IFNULL(paraf_list,''), '$id_user,')
							  WHERE id = $id_surat");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Surat telah diparaf </div>");			
			redirect('surat/konsep');
			
		}else if($mau_ke === 'revisi'){
			
			$revisi = $this->input->post('revisi');
			$id_surat = $this->input->post('id_surat');
			$pengirim_user = $this->input->post('pengirim_user');
			$id_user = 	$this->session->userdata('admin_id');
			
			/*
				'pemeriksa_user'=>$pengirim_user,
				'catatan_revisi'=>$catatan_revisi,
				'pemeriksa_revisi' => $id_user
			*/
			//update pemeriksa_user			
			$this->db->where('id',$id_surat);
			$this->db->update('surat_keluar',array(												   
												   'flag_revisi'=>'Y',
												   'pemeriksa_user'=>$pengirim_user,
												   'paraf_list'=>NULL
												   )
							  );
			
			date_default_timezone_set('Asia/Jakarta');
			$date = date('Y-m-d H:i:s');
			$this->db->insert('surat_keluar_revisi',array('tanggal'=>$date,
														  'id_surat'=>$id_surat,
														  'id_pengguna'=>$id_user,
														  'isi_revisi'=>$revisi)
							  );
			redirect('surat/konsep');
			
		}else if($mau_ke === 'get_revisi'){
			$id_surat = $_GET['id_surat'];
			$cr = $this->db->query("SELECT DATE(a.tanggal) as tanggal,b.nama,a.isi_revisi
								    FROM surat_keluar_revisi a
									LEFT JOIN pengguna b ON a.id_pengguna = b.id
									WHERE a.id_surat = $id_surat
									ORDER BY a.tanggal DESC");
			//echo $cr->catatan_revisi;
			$str = "";
			if ($cr->num_rows() > 0) { 
				$str .= " <table class='table table-bordered table-hover'>
							<tr>
								<th width='20%'>Tanggal</th>
								<th width='30%'>Diminta Oleh</th>
								<th>Isi Revisi</th>							
							</tr>";
				foreach($cr->result() as $row){
					$str .="<tr>
							<td>" . tgl_jam_sql($row->tanggal) . "</td>
							<td>" . $row->nama ."</td>
							<td>" . $row->isi_revisi ."</td>
						  </tr>";
				}
				
				$str .= "</table>";
			}else{
				$str .= "<div class=\"alert alert-info\" id=\"alert\">Belum ada permintaan revisi </div>";
			}
			echo $str;
			exit(0);
			
		}else if($mau_ke === 'udah_revisi'){
			$id_surat = $_GET['id_surat'];			
			$pemeriksa_user = $_GET['pemeriksa_user'];
			
			//update paraflist null
			//update pemeriksa_user
			
			//update pemeriksa_user			
			$this->db->where('id',$id_surat);
			$this->db->update('surat_keluar',array(												   
												   'flag_revisi'=>'N',
												   'pemeriksa_user'=>$pemeriksa_user,
												   'paraf_list'=>NULL
												   )
							  );
			
			//redirect('surat/konsep');
		}else if($mau_ke === 'get_catatan'){
			$id = $_GET['id'];
			$catatan = $this->db->query("SELECT catatan FROM surat_keluar WHERE id = $id")->row()->catatan;
			echo $catatan;
			exit(0);
		}else {
			/*
				NOTE : 
			*/
			if ($a['admin_level'] == "tata usaha") {
			
				$a['data']		= $this->db->query("SELECT surat_keluar.*
												    FROM surat_keluar 
													WHERE IF(flag_revisi = 'Y',flag_setuju = 'N',flag_setuju = 'Y') AND flag_keluar = 'N' 
													LIMIT $awal, $akhir ")->result();
				
			} else if ($a['admin_level'] == "staff") {
				
				/*$idu					= $this->uri->segment(4);
				$id_paraf				= $this->uri->segment(5); //next user
				$id_user = $this->session->userdata('admin_id');
				*/
			
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE (flag_keluar = 'N' OR flag_keluar = 'Y') AND pemeriksa = '".$a['admin_id_unit']."'
													AND pemeriksa_user = '".$a['admin_id']."'
													LIMIT $awal, $akhir ")->result();				
				
				
				
				
				
			
				
			} else {													
				//pimpinan
				/*
					13 nov 2014
					:hanya pimpinan yang surat_keluar.pemeriksa_user yang boleh baca
				*/
				
				/*$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE (flag_setuju = 'N' OR flag_keluar = 'N') AND
													(pemeriksa = '".$a['admin_id_unit']."' OR pemeriksa_user = '".$a['admin_id']."')
													LIMIT $awal, $akhir")->result();
				*/									
				
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE (flag_setuju = 'N' OR flag_keluar = 'N') AND
													(pemeriksa_user = '".$a['admin_id']."')
													LIMIT $awal, $akhir")->result();
			}
			
			$a['page']		= "surat/l_konsep";
		}
		
		$this->load->view('aaa', $a);
	}
	
	
	/*
		edit by : kirana.avalokiteshvara
	*/
	
	function show_pdf($id){
		$data = array();
		$data['rs_surat'] = $this->db->query(	"SELECT a.no_surat,b.nama,b.nomor_induk,IF(b.kehadiran_status = 'hadir','blank.jpg',b.ttd_image) as ttd,a.isi_surat ".
											"FROM surat_keluar a ".
											"LEFT JOIN pengguna b ".
											"ON a.pemeriksa_user = b.id ".
											"WHERE a.id = $id");
		
		$data['isi_surat'] = $this->db->query("SELECT isi_surat FROM surat_keluar WHERE id = $id")->row()->isi_surat;
		$this->load->view('surat/pdf_report',$data);
	}
	
	
	function pdf_report($id){
		
		$data = array();
		
		$pdfFilePath = FCPATH.'/pdf/Surat_Keluar_'.date('dMy').'.pdf';
		//echo $pdfFilePath;
		// boost the memory limit if it's low <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">
		ini_set('memory_limit','32M');
		$data['rs_surat'] = $this->db->query(
											"SELECT a.no_surat,b.nama,b.nomor_induk,IF(b.kehadiran_status = 'hadir','blank.jpg',b.ttd_image) as ttd,a.isi_surat ".
											"FROM surat_keluar a ".
											"LEFT JOIN pengguna b ".
											"ON a.pemeriksa_user = b.id ".
											"WHERE a.id = $id");
		
		$data['isi_surat'] = $this->db->query("SELECT isi_surat FROM surat_keluar WHERE id = $id")->row()->isi_surat;		
		$html = $this->load->view('surat/pdf_report', $data, true); // render the view into HTML
		
	
		include_once APPPATH.'/third_party/mpdf/mpdf.php';
		$param = '"en-GB-x","A4-P","","",10,10,10,10,6,3'; 
		$pdf = new mPDF();
		
		$pdf->AddPage('P','','','','',10,10,2,10,6,3);
		
		//$pdf = $this->pdf->load($param);
		// Add a footer for good measure <img src="http://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley"> 
		//$pdf->SetFooter($_SERVER['HTTP_HOST'].'|{PAGENO}|'.date(DATE_RFC822)); 
		$pdf->WriteHTML($html); // write the HTML into the PDF
		$pdf->Output($pdfFilePath, 'F'); // save to file because we can
		
		
		$this->load->helper('download');
		$data = file_get_contents($pdfFilePath); // Read the file's contents
		$name = 'Surat_Keluar_'.date('dMy').'.pdf';

		force_download($name, $data);
	}
	
	function cetak($id){
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat");
		
		$a['goto'] = 'surat_keluar';
		
		$a['rs_surat'] = $this->db->query(	"SELECT a.no_surat,b.nama,b.nomor_induk,IF(b.kehadiran_status = 'hadir','blank.jpg',b.ttd_image) as ttd,a.isi_surat,a.perihal ".
											"FROM surat_keluar a ".
											"LEFT JOIN pengguna b ".
											"ON a.pemeriksa_user = b.id ".
											"WHERE a.id = $id");
		
		$a['isi_surat'] = $this->db->query("SELECT isi_surat FROM surat_keluar WHERE id = $id")->row()->isi_surat;
		$a['show_print_button'] = TRUE;
		$a['page']		= "surat/cetak";
		
		$this->load->view('aaa', $a);
	}
	
	function lihat_surat($id = null,$goto = null){
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat");
		
		$a['goto'] = $goto;
		$a['isi_surat'] = $this->db->query("SELECT isi_surat FROM surat_keluar WHERE id = $id")->row()->isi_surat;
		
		$a['page']		= "surat/surat_keluar_lihat";
		
		$this->load->view('aaa', $a);
	}
	
	function konsep_edit($id = null,$goto=null){
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		cek_akses_menu(($a['menu']->id_menu), 7, "surat");
		
		
		if(!empty($_POST)){
			
			$isi_surat = $this->input->post('isi_surat');
			
			$data = array('isi_surat' => $isi_surat);
			
			$this->db->where('id',$id);
			$this->db->update('surat_keluar',$data);
			
			redirect(base_URL() . 'surat/konsep','reload');			
		}
		
		$a['goto'] = $goto;
		
		$a['isi_surat'] = $this->db->query("SELECT isi_surat FROM surat_keluar WHERE id = $id")->row()->isi_surat;
		
		$a['page']		= "surat/konsep_edit";
		
		$this->load->view('aaa', $a);
	}
	
	/*public function kop_surat() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 11, "surat"); 
		
		$a['pagi']				= "";
				
		/* mulai data inti 
		$a['data']				= $this->db->query("SELECT * FROM kop_surat")->result();
		
		
		/* url *
		$mau_ke					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		/* $post *
		$idp					= $this->input->post('idp');
		$judul					= $this->input->post('judul');
		$nama_lbg				= $this->input->post('nama_lbg');
		$alamat					= $this->input->post('alamat');
		$notelp					= $this->input->post('notelp');
		$kdpos					= $this->input->post('kdpos');
		$nofax					= $this->input->post('nofax');
		$tmp_lbg				= $this->input->post('tmp_lbg');
		$site					= $this->input->post('site');
		$email					= $this->input->post('email');
		
		//upload config 
		$config['upload_path'] 		= './upload/kop_surat_logo';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';
		$this->load->library('upload', $config);
		
		if ($mau_ke == "add") {
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['page']			= "surat/f_kop_surat";
		} else if ($mau_ke == "edit") {
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['data']		 	= $this->db->query("SELECT * FROM kop_surat WHERE id = '$id_u'")->row();
			$a['page']			= "surat/f_kop_surat";
		} else if ($mau_ke == "aksi_tambah") {
			if ($this->upload->do_upload('file_logo')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("INSERT kop_surat VALUES (NULL, '$judul', '$nama_lbg', '$alamat', '$notelp', '$kdpos', '$nofax', '$tmp_lbg', '$site', '$email', '".$up_data['file_name']."', NOW(), '".$a['admin_id']."')");
			} else {
				$this->db->query("INSERT kop_surat VALUES (NULL, '$judul', '$nama_lbg', '$alamat', '$notelp', '$kdpos', '$nofax', '$tmp_lbg', '$site', '$email', '', NOW(), '".$a['admin_id']."')");
			}
			$this->session->set_flashdata("k", "<div class='alert alert-success'>Kop surat telah dibuat</div>");
			redirect('surat/kop_surat');
		} else if ($mau_ke == "aksi_edit") {
			if ($this->upload->do_upload('file_logo')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("UPDATE kop_surat SET judul = '$judul', nama_lbg = '$nama_lbg', alamat = '$alamat', notelp = '$notelp', kdpos = '$kdpos', nofax = '$nofax', tmp_lbg = '$tmp_lbg', site = '$site', email = '$email', logo = '".$up_data['file_name']."' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE kop_surat SET judul = '$judul', nama_lbg = '$nama_lbg', alamat = '$alamat', notelp = '$notelp', kdpos = '$kdpos', nofax = '$nofax', tmp_lbg = '$tmp_lbg', site = '$site', email = '$email' WHERE id = '$idp'");
			}
		} else if ($mau_ke == "del") {
			$this->db->query("DELETE FROM kop_surat WHERE id = $id_u");
			redirect('surat/kop_surat');
		} else {
			$a['page']				= "surat/d_kop_surat";
		}
		
		$this->load->view('aaa', $a);
	}
	*/
		
	public function search_per_jenis_surat(){
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 4, "surat"); 	
		
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
		//echo $this->db->last_query();
		$jenis_surat			= $this->uri->segment(3);
		$cari					= addslashes($this->input->post('q'));
		$a['cari']   		    = $cari;
		
		if ($a['admin_level'] == "tata usaha") {
			$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
												WHERE flag_setuju = 'Y' AND flag_keluar = 'Y'  AND id_jenis_surat = '$jenis_surat' AND perihal LIKE '%$cari%' ORDER BY id DESC")->result();
		} else {
			$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
												WHERE flag_setuju = 'Y' AND flag_keluar = 'Y' AND pengirim = '".$a['admin_id_unit']."'
												AND id_jenis_surat = '$jenis_surat' AND perihal LIKE '%$cari%' ORDER BY id DESC")->result();
		}
		
		$a['jenis_surat'] = $jenis_surat;
		$a['page']		= "surat/l_surat_keluar";
		$this->load->view('aaa', $a);
	}
	
	public function per_jenis_surat() { 
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 4, "surat"); 	
		
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
		//echo $this->db->last_query();
		$jenis_surat			= $this->uri->segment(3);
		/* pagination */	
		$total_row				= $this->db->query("SELECT * FROM surat_keluar WHERE id_jenis_surat = '$jenis_surat'")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(5); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 5, base_url()."surat/per_jenis_surat/".$jenis_surat."/p/");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
			
		$cari					= addslashes($this->input->post('q'));
		$a['jenis_surat'] = $jenis_surat;

		if ($mau_ke == "del") {
			$filenya	= gval("surat_keluar", "id", "file", $idu);
			@unlink("./upload/surat_keluar/".$filenya);
			$this->db->query("DELETE FROM surat_keluar WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data dihapus </div>");
			redirect('surat/per_jenis_surat/'.$jenis_surat);
		/*
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM surat_keluar WHERE perihal LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "surat/l_surat_keluar";
		*/	
		} else if ($mau_ke == "detil") {
			$data			= $this->db->query("SELECT *, unit.nama_unit AS unit_pengirim, pengguna.nama AS pemeriksa_u,
												(SELECT pengguna.nama FROM pengguna WHERE id = surat_keluar.pengirim_user) AS pembuat
												FROM surat_keluar
												INNER JOIN unit ON unit.kode_gabung = surat_keluar.pengirim
												INNER JOIN pengguna ON pengguna.id = surat_keluar.pemeriksa_user 
												WHERE surat_keluar.id = '".$_GET['id']."'")->row();
			if (!empty($data)) { 
				echo "<table class='table-form' width='100%'>
						<tr><td width='30%'>Unit Pengirim</td><td width='5%'>:</td><td width='65%'>".$data->unit_pengirim."</td></tr>
						<tr><td>Dibuat oleh</td><td>:</td><td>".$data->pembuat."</td></tr>
						<tr><td>Tgl. Surat</td><td>:</td><td>".tgl_jam_sql($data->tgl_surat)."</td></tr>
						<tr><td>Nomor Agenda</td><td>:</td><td>".$data->no_agenda."</td></tr>
						<tr><td>Nomor Surat</td><td>:</td><td>".$data->no_surat."</td></tr>
						<tr><td>Penerima</td><td>:</td><td>".$data->penerima."</td></tr>
						<tr><td>Perihal</td><td>:</td><td>".$data->perihal."</td></tr>
						<tr><td>Kecepatan</td><td>:</td><td>".$data->kecepatan."</td></tr>
						<tr><td>Diperiksa oleh</td><td>:</td><td>".$data->pemeriksa_u."</td></tr>
					  </table>";
			}			
			exit;
		}else if($mau_ke == "cari"){
			
			if ($a['admin_level'] == "tata usaha") {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y'  AND id_jenis_surat = '$jenis_surat' AND perihal LIKE '%$cari%' ORDER BY id DESC")->result();
			} else {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y' AND pengirim = '".$a['admin_id_unit']."'
													AND id_jenis_surat = '$jenis_surat' AND perihal LIKE '%$cari%' ORDER BY id DESC")->result();
			}
			
			$a['page']		= "surat/l_surat_keluar";
		} else {
			if ($a['admin_level'] == "tata usaha") {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y'  AND id_jenis_surat = '$jenis_surat'
													LIMIT $awal, $akhir ")->result();
			} else {
				$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'Y' AND flag_keluar = 'Y' AND pengirim = '".$a['admin_id_unit']."'
													AND id_jenis_surat = '$jenis_surat'
													LIMIT $awal, $akhir ")->result();
			}
			$a['page']		= "surat/l_surat_keluar";
		}
		
		$this->load->view('aaa', $a);
	}
	
	public function jq_priview_kop() {
		$id_kop		= $_GET['id_kop'];
		$a['d']		= $this->db->query("SELECT * FROM kop_surat WHERE id = '$id_kop'")->row();
		$this->load->view('surat/jq_priview_kop', $a);	
	}
	/*public function setuju_surat() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = ".$a['admin_id']."")->row();		
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		cek_akses_menu(($a['menu']->id_menu), 4, "surat"); 	
		
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
		//echo $this->db->last_query();
		/* pagination *
		$total_row				= $this->db->query("SELECT * FROM surat_keluar")->num_rows();
		$per_page				= 10;
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir					= $per_page;
		
		$a['pagi']				= _page($total_row, $per_page, 4, base_url()."surat/surat_masuk/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$id_surat				= $this->uri->segment(4);
			
		if ($mau_ke == "ok") {
			$this->db->query("UPDATE surat_keluar SET flag_setuju = 'Y' WHERE id = '$id_surat'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Surat telah disetujui </div>");			
			redirect('surat/setuju_surat');
		} else {
			$a['data']		= $this->db->query("SELECT surat_keluar.* FROM surat_keluar 
													WHERE flag_setuju = 'N' AND flag_keluar = 'N' AND pemeriksa = '".$a['admin_id_unit']."' 
													AND pemeriksa_user = '".$a['admin_id']."'
													LIMIT $awal, $akhir ")->result();
			$a['page']		= "surat/l_setuju";
		}
		
		$this->load->view('aaa', $a);
	}
	*/
	
	
	/*******************************************************************************/
	
	function download_surat($id){
		//  cek apakah file copy_nama_image.docx ada ?
		//     'Y' : delete and copy original file to copy_nama_image.docx
		//     'N' : just copy original file to copy_nama_image.docx
		
		//cek apakah status kehadiran pemeriksa = 'hadir'
		//jika keluar:
		//	replace image
		//  then download
		//jika hadir:
		//  just download
		
		$nama_surat = $this->web_model->get_surat_keluar_by_id($id)->row()->file;
		$ttd_image = $this->web_model->get_pengguna_by_id($this->session->userdata('admin_id'))->row()->ttd_image;
		
		if(file_exists('./upload/surat_keluar/copy_'.$nama_surat)){
			//echo "ada";
			unlink('./upload/surat_keluar/copy_'.$nama_surat);			
		}
		
		//echo "tidak_Ada";
		if(!copy('./upload/surat_keluar/'.$nama_surat,'./upload/surat_keluar/copy_'.$nama_surat)){
			//echo "failed";
		}else{
			//echo "file copyed";
		}
		
		$this->load->helper('download');
		
		if(!$this->web_model->is_pemeriksa_hadir($id)){		    
			$this->load->library('PHPWord');			
			$document = $this->phpword->loadTemplate("./upload/surat_keluar/copy_" . $nama_surat);
			$document->replaceImage('./ttd_img/' . $ttd_image);
			$document->save("./upload/surat_keluar/copy_" . $nama_surat);
		}
		
		$data = file_get_contents("./upload/surat_keluar/copy_" . $nama_surat);
		force_download($nama_surat,$data);
		
	}
	
	
	function export_data($tipe,$jenis){
		
		if($tipe === 'surat_masuk'){
			
			//Tanggal Terima, Nomor Surat (Tgl. Surat), Perihal, Pengirim, Penerima.
			$query = $this->db->query("SELECT date(a.tgl_diterima) as tgl_terima ,
											  a.nomor as nomor_surat,
											  a.tgl_surat as tgl_surat,
											  a.perihal as perihal,
											  a.pengirim as pengirim,
											  b.nama_unit as penerima
									   FROM	surat_masuk a
									   LEFT JOIN unit b ON a.penerima = b.kode_gabung
									   ORDER BY a.tgl_diterima DESC");
			if(!$query)
			 return false;
			
			$this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
			$objPHPExcel->setActiveSheetIndex(0);
			// Field names in the first row
			
			$fields = $query->list_fields();
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper($field));
				$col++;
			}
			
			// Fetching the table data
			$row = 2;
			foreach($query->result() as $data)
			{
				$col = 0;
				foreach ($fields as $field)
				{
					if($col == 0 || $col == 2){
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, tgl_jam_sql($data->$field));										
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);					
					}
					
					$col++;
				}			 
				$row++;
			}
			
			foreach(range('A','F') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
											  ->setAutoSize(true);
				
			}
			
			/*
			$num_rows = $query->num_rows() + 1;
			
			foreach(range('E','G') as $columnID) {
				$objPHPExcel->getActiveSheet()->getStyle( $columnID . '2:' . $columnID .$num_rows)
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);							  
			}
			*/
			
			$objPHPExcel->setActiveSheetIndex(0);
	 
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Surat_masuk'.date('dMy').'.xls"');
			header('Cache-Control: max-age=0');
	 
			$objWriter->save('php://output');

			
		}else if($tipe === 'surat_keluar'){
			
			$str_query = "";
			if($jenis === 'all'){
				//no_agenda,tanggal,nomor_surat,perihal,penerima
				$str_query = 	"SELECT CONCAT(' ',no_agenda,' ') as no_agenda,
										tgl_surat,
										no_surat,
										perihal,
										penerima
								FROM surat_keluar";
				
			}else{
				//no_agenda,tanggal,nomor_surat,perihal,penerima
				$str_query = 	"SELECT CONCAT(' ',no_agenda,' ') as no_agenda,
										tgl_surat,
										no_surat,
										perihal,
										penerima
								FROM surat_keluar
								WHERE id_jenis_surat = $jenis";
			}
			
			$query = $this->db->query($str_query);
			
			if(!$query)
			 return false;
			
			$this->load->library('PHPExcel');
			$this->load->library('PHPExcel/IOFactory');
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
			$objPHPExcel->setActiveSheetIndex(0);
			// Field names in the first row

			$fields = $query->list_fields();
			$col = 0;
			foreach ($fields as $field)
			{
				$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, strtoupper($field));
				$col++;
			}
			
			// Fetching the table data
			$row = 2;
			foreach($query->result() as $data)
			{
				$col = 0;
				foreach ($fields as $field)
				{
					if($col == 1){
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, tgl_jam_sql($data->$field));										
					}else{
						$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);					
					}
					
					$col++;
				}			 
				$row++;
			}
			
			foreach(range('A','E') as $columnID) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($columnID)
											  ->setAutoSize(true);
				
			}
			
			/*
			$num_rows = $query->num_rows() + 1;
			
			foreach(range('E','G') as $columnID) {
				$objPHPExcel->getActiveSheet()->getStyle( $columnID . '2:' . $columnID .$num_rows)
							->getAlignment()
							->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);							  
			}
			*/
			
			$objPHPExcel->setActiveSheetIndex(0);
	 
			$objWriter = IOFactory::createWriter($objPHPExcel, 'Excel5');
	 
			// Sending headers to force the user to download the file
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="Surat_keluar'.date('dMy').'.xls"');
			header('Cache-Control: max-age=0');
	 
			$objWriter->save('php://output');
			
		}
	}
	
	
}