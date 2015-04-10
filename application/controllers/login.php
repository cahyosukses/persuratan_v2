<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$this->load->view('login');
	}
	
	public function do_login() {
		$u 		= $this->security->xss_clean($this->input->post('u'));
		$ta 	= $this->security->xss_clean($this->input->post('ta'));
        $p 		= md5($this->security->xss_clean($this->input->post('p')));
         
		$q_cek	= $this->db->query("SELECT * FROM pengguna WHERE username = '".$u."' AND password = '".$p."'");
		$j_cek	= $q_cek->num_rows();
		$d_cek	= $q_cek->row();
		
        if($j_cek == 1) {
            $data = array(
                    'admin_id' 		=> $d_cek->id,
                    'admin_user' 	=> $d_cek->username,
                    'admin_nama' 	=> $d_cek->nama,
                    'admin_prodi' 	=> $d_cek->prodi,
                    'admin_ta' 		=> $ta,
                    'admin_level' 	=> $d_cek->level,
                    'admin_akses' 	=> $d_cek->akses,
					'admin_valid' 	=> true
                    );
            $this->session->set_userdata($data);
            redirect('simaset');
        } else {	
			$this->session->set_flashdata("k", "<div id=\"alert\" class=\"alert alert-error\">username or password is not valid</div>");
			redirect('login');
		}
	}
	
	public function dashboard() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
			redirect("login");
		}
		$this->load->view('dashboard');
	}

	public function manage_admin() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
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
		$nip					= addslashes($this->input->post('nip'));
		$level					= addslashes($this->input->post('level'));
		$akses					= addslashes($this->input->post('akses'));
		
		$cari					= addslashes($this->input->post('q'));

		
		if ($mau_ke == "del") {
			$this->db->query("DELETE FROM pengguna WHERE id = '$idu'");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been deleted </div>");
			redirect('login/manage_admin');
		} else if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT * FROM pengguna WHERE nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_manage_admin";
		} else if ($mau_ke == "add") {
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "edt") {
			$a['datpil']	= $this->db->query("SELECT * FROM pengguna WHERE id = '$idu'")->row();	
			$a['page']		= "f_manage_admin";
		} else if ($mau_ke == "act_add") {	
			$this->db->query("INSERT INTO pengguna VALUES (NULL, '$username', '$password', '$nama', '$nip', '$level', '$akses')");
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been added</div>");
			redirect('login/manage_admin');
		} else if ($mau_ke == "act_edt") {
			if ($password = md5("-")) {
				$this->db->query("UPDATE pengguna SET username = '$username', nama = '$nama', nip = '$nip', level = '$level', akses = '$akses' WHERE id = '$idp'");
			} else {
				$this->db->query("UPDATE pengguna SET username = '$username', password = '$password', nama = '$nama', nip = '$nip', level = '$level', akses = '$akses' WHERE id = '$idp'");
			}
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated </div>");			
			redirect('login/manage_admin');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM pengguna LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_manage_admin";
		}
		
		$this->load->view('surat/aaa_manage_admin', $a);
	}
	
	public function pengguna() {
		if ($this->session->userdata('admin_valid') == FALSE && $this->session->userdata('admin_id') == "") {
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
			redirect('login/pengguna');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "f_pengguna";
		}
		
		$this->load->view('surat/aaa_manage_admin', $a);	
	}
	
	public function logout(){
        $this->session->sess_destroy();
		redirect('login');
    }
	
	public function request() {
		$admin_valid			= $this->session->userdata('admin_valid');
		$admin_id				= $this->session->userdata('admin_id');
		$admin_level			= $this->session->userdata('admin_level');
		$admin_prodi			= $this->session->userdata('admin_prodi');
		$admin_ta				= $this->session->userdata('admin_ta');
		
		if ($admin_valid == FALSE && $admin_id == "") { redirect("login"); } //cek login
		/* pagination */	
		$total_row				= $this->db->query("SELECT * FROM permintaan_surat WHERE tujuan = '$admin_prodi'")->num_rows();
		$per_page				= 10;
		
		$awal					= $this->uri->segment(4); 
		$awal					= (empty($awal) || $awal == 1) ? 0 : $awal;
		
		//if (empty($awal) || $awal == 1) { $awal = 0; } { $awal = $awal; }
		$akhir	= $per_page;
		
		$a['pagi']	= _page($total_row, $per_page, 4, base_url()."login/request/p");
		
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		$idu					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));

		
		$cari					= addslashes($this->input->post('q'));
		
		if ($mau_ke == "cari") {
			$a['data']		= $this->db->query("SELECT permintaan_surat.*, ref_db_mahasiswa.nama FROM permintaan_surat INNER JOIN ref_db_mahasiswa ON permintaan_surat.id_peminta = ref_db_mahasiswa.id WHERE ref_db_mahasiswa.nama LIKE '%$cari%' ORDER BY id DESC")->result();
			$a['page']		= "l_permintaan";
		} else if ($mau_ke == "update") {
			$this->db->query("UPDATE permintaan_surat SET cek = 'Y', tgl_selesai = NOW(), id_user = '$admin_id' WHERE id = '$idu'");
			
			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">OK .. </div>");			
			redirect('login/request');
		} else {
			$a['data']		= $this->db->query("SELECT permintaan_surat.*, ref_db_mahasiswa.nama FROM permintaan_surat INNER JOIN ref_db_mahasiswa ON permintaan_surat.id_peminta = ref_db_mahasiswa.id WHERE tujuan = '$admin_prodi' ORDER BY id DESC LIMIT $awal, $akhir ")->result();
			$a['page']		= "l_permintaan";
		}
		
		$this->load->view('pengguna/aaa', $a);
	}
}	