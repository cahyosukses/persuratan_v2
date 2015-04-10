<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pengguna extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("login");
		}
		
		$a['page']	= "d_amain";
		
		$this->load->view('pengguna/aaa', $a);
	}
	
	public function passwod() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("login");
		}
		
		$ke				= $this->uri->segment(3);
		$id_user		= $this->session->userdata('admin_id');
		
		//var post
		$p1				= md5($this->input->post('p1'));
		$p2				= md5($this->input->post('p2'));
		$p3				= md5($this->input->post('p3'));
		
		if ($ke == "simpan") {
			$cek_password_lama	= $this->db->query("SELECT password FROM pengguna WHERE id = $id_user")->row();
			//echo 
			
			if ($cek_password_lama->password != $p1) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Lama tidak sama</div>');
				redirect('pengguna/passwod');
			} else if ($p2 != $p3) {
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-error">Password Baru 1 dan 2 tidak cocok</div>');
				redirect('pengguna/passwod');
			} else {
				$this->db->query("UPDATE pengguna SET password = '$p3' WHERE id = '".$this->session->userdata('admin_id')."'");
				$this->session->set_flashdata('k_passwod', '<div id="alert" class="alert alert-success">Password berhasil diperbaharui</div>');
				redirect('pengguna/passwod');
			}
		} else {
			$a['page']	= "f_passwod";
		}
		
		$this->load->view('pengguna/aaa', $a);
	}
	
	public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE || $this->session->userdata('admin_id') == "" || $this->session->userdata('admin_level') != "Super Admin") {
			redirect("login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM pengguna")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."surat/manage_admin/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$username				= addslashes($this->input->post('username'));
		$password				= md5(addslashes($this->input->post('password')));
		$nama					= addslashes($this->input->post('nama'));
		$prodi					= addslashes($this->input->post('prodi'));
		$level					= addslashes($this->input->post('level'));
		$akses					= addslashes($this->input->post('akses'));
		
		$cari					= addslashes($this->input->post('q'));
		
		$last_id				= $this->db->query("SELECT RIGHT(MAX(id),3) AS lid FROM pengguna")->row();
		$last_id_dipakai		= $prodi.str_pad(intval($last_id->lid)+1, 3, '0', STR_PAD_LEFT);

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM pengguna WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('pengguna/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT pengguna.id, pengguna.username, pengguna.nama, pengguna.level, ref_prodi.nama FROM pengguna INNER JOIN ref_prodi ON pengguna.prodi = ref_prodi.id WHERE pengguna.nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM pengguna WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {	
			$this->db->query("INSERT INTO pengguna VALUES ('$last_id_dipakai', '$username', '$password', '$nama', '$prodi', '$level', '$akses')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('pengguna/manage_admin');
		} else if ($mau_ke == "act_edt") {
			if ($password = md5("-")) {
				$this->db->query("UPDATE pengguna SET username = '$username', nama = '$nama', prodi = '$prodi', level = '$level', akses = '$akses' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE pengguna SET username = '$username', password = '$password', nama = '$nama', prodi = '$prodi', level = '$level', akses = '$akses' WHERE id = '$idp'");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");			
			redirect('pengguna/manage_admin');
		} else {
			$a['data']		= $this->db->query("SELECT pengguna.id, pengguna.username, pengguna.nama, pengguna.level, pengguna.akses, ref_prodi.nama AS nama_prodi FROM pengguna INNER JOIN ref_prodi ON pengguna.prodi = ref_prodi.id ORDER BY id ASC LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_manage_admin";
		}
		
		$this->load->view('pengguna/aaa', $a);
	}
	
	public function instansi() {
		if ($this->session->userdata('admin_valid') == FALSE || $this->session->userdata('admin_id') == "" || $this->session->userdata('admin_level') != "Super Admin") {
			redirect("login");
		}		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		$kepsek					= addslashes($this->input->post('kepsek'));
		$nip_kepsek				= addslashes($this->input->post('nip_kepsek'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload';
		$config['allowed_types'] 	= 'gif|jpg|png|pdf|doc|docx';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "act_edt") {
			if ($this->upload->do_upload('logo')) {
				$up_data	 	= $this->upload->data();
				
				$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek', logo = '".$up_data['file_name']."' WHERE id = '$idp'");

			} else {
				$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat', kepsek = '$kepsek', nip_kepsek = '$nip_kepsek' WHERE id = '$idp'");
			}		

			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('pengguna');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "f_pengguna";
		}
		
		$this->load->view('pengguna/aaa', $a);	
	}
	
	public function logout(){
        $this->session->sess_destroy();
		redirect('login');
    }

	public function alat_bekres() {
		if ($this->session->userdata('admin_valid') == FALSE || $this->session->userdata('admin_id') == "" || $this->session->userdata('admin_level') != "Super Admin") {
			redirect("login");
		}
		
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		if ($mau_ke == "backup") {
			$this->load->dbutil();
			$nama_file	= 'bck_aset_'.date('Y-m-d');
			$prefs = array(
					'tables'      => array('aset_history_trans', 'aset_t_alatmesin', 'aset_t_gedung', 'aset_t_tanah', 'ref_aset_ruang', 'ref_surat_klasifikasi', 'surat_disposisi', 'surat_surat_keluar', 'surat_surat_masuk'),  // Array of tables to backup.
					'ignore'      => array(),           // List of tables to omit from the backup
					'format'      => 'zip',             // gzip, zip, txt
					'filename'    => $nama_file.'.sql',    // File name - NEEDED ONLY WITH ZIP FILES
					'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
					'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
					'newline'     => "\n"               // Newline character used in backup file
				  );

			// Backup your entire database and assign it to a variable
			$backup =& $this->dbutil->backup($prefs);

			// Load the file helper and write the file to your server
			$this->load->helper('file');
			write_file('/path/to/'.$nama_file.'.gz', $backup); 

			$this->load->helper('download');
			force_download($nama_file.'.gz', $backup);
			
		} else if ($mau_ke == "restore") {
			$config['upload_path'] 		= './upload/temp';
			$config['allowed_types'] 	= 'sql|txt';
			$config['max_size']			= '50000';
			$config['max_width']  		= '2000';
			$config['max_height']  		= '2000';
			
			$this->load->library('upload', $config);
			
			if ($this->upload->do_upload('file_backup')) {
				$up_data	 	= $this->upload->data();
				$direktori		= "upload/temp/".$up_data['file_name'];
				$isi_file		= file_get_contents($direktori);
				$string_query	= rtrim($isi_file, "\n;" );
				$array_query	= explode(";", $string_query);
				
				foreach ($array_query as $query) {
					$this->db->query($query);
				}
				$this->session->set_flashdata('k_restore', '<div id="alert" class="alert alert-success">Restore berhasil</div>');
			} else {
				$this->session->set_flashdata('k_restore', '<div id="alert" class="alert alert-error">'.$this->upload->display_errors().'</div>');
			}
			redirect('pengguna/alat_bekres');
			
		} else {
			$a['page']	= "alat_bakres";
		}
		$this->load->view('pengguna/aaa', $a);
	}
	
	public function unit_kerja() {
		if ($this->session->userdata('admin_valid') == FALSE || $this->session->userdata('admin_id') == "" || $this->session->userdata('admin_level') != "Super Admin") {
			redirect("login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_unit_kerja")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."surat/unit_kerja/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
	
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_unit_kerja WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_unit_kerja";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_unit_kerja";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_unit_kerja WHERE id = '$idu'")->row();	
			$a['page']		= "f_unit_kerja";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO ref_unit_kerja VALUES (NULL, '$nama')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");			
			redirect('pengguna/unit_kerja');
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE ref_unit_kerja SET nama = '$nama' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('pengguna/unit_kerja');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM ref_unit_kerja LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_unit_kerja";
		}
		
		$this->load->view('pengguna/aaa', $a);
	}
	
	public function prodi() {
		if ($this->session->userdata('admin_valid') == FALSE || $this->session->userdata('admin_id') == "" || $this->session->userdata('admin_level') != "Super Admin") {
			redirect("login");
		}
		
		/* pagination */	
		$total_row		= $this->db->query("SELECT * FROM ref_prodi")->num_rows();
		$per_page		= 10;
		
		$awal	= $this->uri->segment(4); 
		$awal	= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."surat/prodi/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$jenjang				= addslashes($this->input->post('jenjang'));
	
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM ref_prodi WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_prodi";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_prodi";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM ref_prodi WHERE id = '$idu'")->row();	
			$a['page']		= "f_prodi";
		} else if ($mau_ke == "act_add") {
			$this->db->query("INSERT INTO ref_prodi VALUES (NULL, '$nama', '$jenjang')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");			
			redirect('pengguna/prodi');
		} else if ($mau_ke == "act_edt") {
			$this->db->query("UPDATE ref_prodi SET nama = '$nama', jenjang = '$jenjang' WHERE id = '$idp'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('pengguna/prodi');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM ref_prodi LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_prodi";
		}
		
		$this->load->view('pengguna/aaa', $a);
	}
	
}	