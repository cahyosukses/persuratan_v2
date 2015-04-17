<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Instansi extends CI_Controller {
	function __construct() {
		parent::__construct();
	}
	
	public function index() {
		$admin_id			= $this->session->userdata('admin_id');
		$admin_id_unit		= $this->session->userdata('admin_id_unit');

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
		
		$a['menu']				= $this->db->query("SELECT id_menu FROM pengguna WHERE id = '$admin_id'")->row();
		$a['not_surat_masuk']	= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_read = 'N' AND flag_del = 'Y'")->num_rows();
		$a['not_surat_lanjut']	= $this->db->query("SELECT id FROM surat_masuk WHERE penerima = '$admin_id_unit' AND flag_read = 'N' AND flag_lanjut = 'N' AND flag_del = 'Y'")->num_rows();
		$a['not_disp_masuk']	= $this->db->query("SELECT id FROM disposisi WHERE penerima = '$admin_id_unit' AND penerima_user = '$admin_id' AND flag_read = 'N' AND flag_lanjut = 'N'")->num_rows();
		$a['not_konsep_masuk']	= $this->db->query("SELECT id FROM surat_keluar WHERE pemeriksa_user = '$admin_id' AND flag_setuju = 'N' AND flag_del = 'Y'")->num_rows();
		
		$a['page']				= "d_amain";
		
		$this->load->view('aaa', $a);
	} 
	
	public function atur_instansi() {
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
		
		cek_akses_menu(($a['menu']->id_menu), 1, "instansi"); 	

		
		$a['cek_super']			= $this->db->query("SELECT * FROM unit WHERE unit_0 = '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->row();
		
		$a['dtree']				= "";
		$dtree					= "";
		$kode_00				= $this->db->query("SELECT * FROM unit 
													WHERE unit_0 != '' AND unit_1 = '' AND unit_2 = '' 
													AND unit_3 = '' ORDER BY id ASC")->result();
		
		if (!empty($kode_00)) {
			foreach ($kode_00 as $k0) {
				$kode_01		= $this->db->query("SELECT * FROM unit WHERE unit_0 = '".$k0->unit_0."' AND unit_1 != '' AND unit_2 = '' AND unit_3 = '' ORDER BY id ASC")->result();

				$dtree .= '
					<tr><td class="ctr" width="5%">
					<a href="#unit" role="button" onclick="return isiunit(\''.$k0->id.'\', \''.$k0->unit_0.'\', \''.$k0->unit_1.'\', \''.$k0->unit_2.'\', \''.$k0->unit_3.'\', \''.$k0->nama_unit.'\', \'act_edit\');" data-toggle="modal" title="Edit data"><i class="fa fa-edit"> </i> </a> 
					<a href="'.base_url().$a['admin_apps'].'/unit/del/'.$k0->id.'" onclick="return confirm(\'Anda yakin..?\');"  title="Hapus data"><i class="fa fa-times"> </i> </a> 
					</td><td colspan="5">'.$k0->nama_unit.'
					 &nbsp;<a href="#unit" role="button" onclick="return isiunit(\'\', \''.$k0->unit_0.'\', \'\', \'\', \'\', \'\', \'add_01\');" data-toggle="modal" title="Tambah Unit"><i class="fa fa-plus-circle"> </i> Tambah Sub</a>
					</td></tr>
					';
					
				if (!empty($kode_01)) {
					foreach ($kode_01 as $k1) {
						$kode_02		= $this->db->query("SELECT * FROM unit WHERE unit_0 = '".$k0->unit_0."' AND unit_1 = '".$k1->unit_1."' AND unit_2 != '' AND unit_3 = '' ORDER BY id ASC")->result();

						$dtree .= '
							<tr><td></td><td class="ctr" width="5%">
							<a href="#unit" role="button" onclick="return isiunit(\''.$k1->id.'\', \''.$k1->unit_0.'\', \''.$k1->unit_1.'\', \''.$k1->unit_2.'\', \''.$k1->unit_3.'\', \''.$k1->nama_unit.'\', \'act_edit\');" data-toggle="modal" title="Edit data"><i class="fa fa-edit"> </i> </a> 
							<a href="'.base_url().$a['admin_apps'].'/unit/del/'.$k1->id.'" onclick="return confirm(\'Anda yakin..?\');"  title="Hapus data"><i class="fa fa-times"> </i> </a> 
							</td><td colspan="5">'.$k1->nama_unit.'
							 &nbsp;<a href="#unit" role="button" onclick="return isiunit(\'\', \''.$k0->unit_0.'\', \''.$k1->unit_1.'\', \'\', \'\', \'\', \'add_02\');" data-toggle="modal" title="Tambah Unit"><i class="fa fa-plus-circle"> </i> Tambah Sub</a>
							</td></tr>
							';
						if (!empty($kode_02)) {
							foreach ($kode_02 as $k2) {
								$kode_03  	= $this->db->query("SELECT * FROM unit WHERE unit_0 = '".$k0->unit_0."' AND unit_1 = '".$k1->unit_1."' AND unit_2 = '".$k2->unit_2."' AND unit_3 != '' ORDER BY id ASC")->result();
								
								$dtree .= '
									<tr><td></td><td></td><td class="ctr" width="5%">
									<a href="#unit" role="button" onclick="return isiunit(\''.$k2->id.'\', \''.$k2->unit_0.'\', \''.$k2->unit_1.'\', \''.$k2->unit_2.'\', \''.$k2->unit_3.'\', \''.$k2->nama_unit.'\', \'act_edit\');" data-toggle="modal" title="Edit data"><i class="fa fa-edit"> </i> </a> 
									<a href="'.base_url().$a['admin_apps'].'/unit/del/'.$k2->id.'" onclick="return confirm(\'Anda yakin..?\');"  title="Hapus data"><i class="fa fa-times"> </i> </a> 
									</td><td colspan="5">'.$k2->nama_unit.'
									&nbsp;<a href="#unit" role="button" onclick="return isiunit(\'\', \''.$k0->unit_0.'\', \''.$k1->unit_1.'\', \''.$k2->unit_2.'\', \'\', \'\', \'add_03\');" data-toggle="modal" title="Tambah Unit"><i class="fa fa-plus-circle"> </i> Tambah Sub</a>
									</td></tr>
									';
								
								if (!empty($kode_03)) {
									foreach ($kode_03 as $k3) {
										$dtree .= '
											<tr><td></td><td><td></td></td><td class="ctr" width="5%">
											<a href="#unit" role="button" onclick="return isiunit(\''.$k3->id.'\', \''.$k3->unit_0.'\', \''.$k3->unit_1.'\', \''.$k3->unit_2.'\', \''.$k3->unit_3.'\', \''.$k3->nama_unit.'\', \'act_edit\');" data-toggle="modal" title="Edit data"><i class="fa fa-edit"> </i> </a> 
											<a href="'.base_url().$a['admin_apps'].'/unit/del/'.$k3->id.'" onclick="return confirm(\'Anda yakin..?\');"  title="Hapus data"><i class="fa fa-times"> </i> </a> 
											</td><td colspan="5">'.$k3->nama_unit.'
											</td></tr>
											';
									}
								}
							}
						}
						//$dtree .= '<tr><td></td><td></td><td colspan="3"></td></tr>';
					}	
				} 
				//$dtree .= '<tr><td></td><td colspan="4"></td></tr>';
			}
		}
		$dtree .= '<tr><td colspan="5"> &nbsp;<a href="#unit" role="button" onclick="return isiunit(\'\', \'\', \'\', \'\', \'\', \'\', \'add_00\');" data-toggle="modal" title="Tambah Unit"><i class="fa fa-plus-circle"> </i> Tambah Sub</a></td></tr>';
		
		$a['dtree']				= $dtree;
		$a['page']				= "instansi/d_atur_instansi";
		
		$this->load->view('aaa', $a);
	}
	
	function _data_udah_ada($nama_tbl,$kolom_unik,$nilai_unik){
	
		$r = $this->db->query("SELECT * FROM $nama_tbl WHERE $kolom_unik = '$nilai_unik'");
	
		return $r->num_rows() > 0 ? TRUE : FALSE;
	
	}
	
	public function kode_hal_org(){
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
		
		cek_akses_menu(($a['menu']->id_menu), 13, "instansi"); 
		
		$a['pagi']				= "";
		
		/* url */
		$mau_ke					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		$cari					= addslashes($this->input->post('q'));
		$a['cari'] 				= $cari;
		
		if ($mau_ke == "add") {
			
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['page']			= "instansi/f_kode_hal_org";
			
		}else if($mau_ke ==='aksi_add'){
			
			$this->form_validation->set_rules('kode','Kode','xss_clean|required');
			$this->form_validation->set_rules('nama','Nama','xss_clean|required');
			$this->form_validation->set_rules('keterangan','Keterangan','xss_clean|required');
			
			if($this->form_validation->run() == TRUE){
			  
			  $add['kode'] = $this->input->post('kode');
			  $add['nama'] = $this->input->post('nama');
			  $add['keterangan'] = $this->input->post('keterangan');
			  
			  $this->db->insert('kode_hal_org',$add);
			  
			  $this->session->set_flashdata("k", "<div class='alert alert-success'>Kode Hal Organisasi Baru berhasil ditambahkan</div>");	
				
			  redirect('instansi/kode_hal_org');
			  
			}else{		
			  $data['k'] = validation_errors();
			}
			
			$a['page']	= "instansi/f_kode_hal_org";
			
		} else if ($mau_ke == "edit") {
			
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['datdet']	 	= $this->db->query("SELECT * FROM kode_hal_org WHERE id = '$id_u'")->row();
			$a['page']			= "instansi/f_kode_hal_org";
			
		} else if ($mau_ke == "aksi_edit") {			
			
			$this->form_validation->set_rules('kode','Kode','xss_clean|required');
			$this->form_validation->set_rules('nama','Nama','xss_clean|required');
			$this->form_validation->set_rules('keterangan','Keterangan','xss_clean|required');
			
			if($this->form_validation->run() == TRUE){
			  
			  $update['kode'] = $this->input->post('kode');
			  $update['nama'] = $this->input->post('nama');
			  $update['keterangan'] = $this->input->post('keterangan');
			  
			  $this->db->where('id',$id_u);
			  $this->db->update('kode_hal_org',$update);
			  
			  $this->session->set_flashdata("k", "<div class='alert alert-success'>Kode Hal Organisaisi berhasil diupdate</div>");	
				
			  redirect('instansi/kode_hal_org');
			  
			}else{		
			  $data['k'] = validation_errors();
			}
			
			$a['page']	= "instansi/f_kode_hal_org";
			
		} else if ($mau_ke == "del") {
			
			$this->db->query("DELETE FROM kode_hal_org WHERE id = $id_u");
			redirect('instansi/kode_hal_org');
			
		}else if($mau_ke == "cari"){
			
			$a['data']				= $this->db->query("SELECT *
													   FROM kode_hal_org													   
													   WHERE kode LIKE '%$cari%' OR nama LIKE '%$cari%' OR keterangan LIKE '%$cari%'
													   ORDER BY id ASC")->result();
			$a['page'] 				= "instansi/d_kode_hal_org";
			
		} else {
			/* mulai data inti */
			$a['data']				= $this->db->query("SELECT * FROM kode_hal_org
														ORDER BY id ASC")->result();
			$a['page']				= "instansi/d_kode_hal_org";
		}
		
		
		$this->load->view('aaa', $a);
	}
	/*
	function _get_select_fak_kip_list($id_parent,$space = ''){
		//$data = array();
        $this->db->from('kode_fkip');
        $this->db->where('id_parent', $id_parent);
        $result = $this->db->get();
    
		if($p_cid==0){  
			$space='';  
		}else{  
			$space .="    ";  
		}
		
		$select = "<select name='id_parent'>";
		$select .= "<option value='0'>-- ROOT --</option>";  
        
		foreach ($result->result() as $row)
        {
			$select .= "<option value='" . $row->id . "'>" . $space . $row->nama ."</option>";
			$this->_get_fak_kip_list($row->id,$space); 
        }
		
		$select .= "</select>";
		
        return $select;
	}
	*/
	
	function _get_fak_kip_list($id_parent){
		
		$data = array();
		$this->db->from('kode_fkip');
        $this->db->where('id_parent', $id_parent);
		$this->db->order_by('kode','ASC');
        $result = $this->db->get();
    		
		foreach ($result->result() as $row)
        {
            $data[] = array(
				'id_parent' => $row->id_parent,
                'id' => $row->id,
                'nama' => $row->nama,
				'kode' => $row->kode,
                // recursive
                'child' => $this->_get_fak_kip_list($row->id)
            );
        }
        return $data;
	}
	
	function _print_recursive_select_kip($data,$space=""){
		$str = "";
		$space .= "--- | ";
		foreach($data as $td)
		{
			$str .= "<option value=\"" . $td['id'] . "\">" . $space . $td['nama']. "</option>";			
			$str .= $this->_print_recursive_table_kip($td['child'],$space);
		}
		return $str;
	}
	
	function _get_select_fkip(){
		$row_fkip = $this->_get_fak_kip_list(0);
		$select = "<select id=\"id_kode_fkip\" class=\"form-control col-lg-6\" required name=\"id_kode_fkip\">";
		if(count($row_fkip) == 0){
			
		}else{
			foreach($row_fkip as $r){
				$select .= "<option value=\"" . $r['id'] . "\">" . $r['nama']. "</option>";	
				$select .= $this->_print_recursive_select_kip($r['child']);
			}
		}
		
		$select .="";
		return $select;
	}
	
	function _print_recursive_table_kip($data,$space=""){
		$str = "";
		//$space .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$space .= "--- | "; 
		foreach($data as $td)
		{
			$str .= "<tr>";
			$str .= "	<td>".$td['kode']."</td>";
			$str .= "	<td>".$space . $td['nama']."</td>";
			$str .= "	<td class=\"ctr\">
							<div class=\"btn-group\">
								<a href=\"#fkip\" data-toggle=\"modal\" onclick=\"return isi_fkip('','" . $td['id']  .  "','','','add-sub'"  . ")\" class=\"btn btn-info btn-sm\" title=\"Add Sub\"><i class=\"fa fa-plus-circle fa-fw\"> </i> Add Sub</a>
								<a href=\"#fkip\" data-toggle=\"modal\" onclick=\"return isi_fkip('". $td['id'] . "','" . $td['id_parent'] .  "','" . $td['nama'] . "','" . $td['kode']  . "','edit'"  . ")\" class=\"btn btn-success btn-sm\" title=\"Edit Data\"><i class=\"fa fa-edit\"> </i> Edt</a>
								<a href=\"" . base_URL() . 'instansi/kode_surat/del/' . $td['id'] . "\" class=\"btn btn-warning btn-sm\" title=\"Hapus Data\" onclick=\"return confirm('Anda Yakin..?')\"><i class=\"fa fa-times\">  </i> Del</a>
							</div>
						</td>";
			$str .= "</tr>";
			$str .= $this->_print_recursive_table_kip($td['child'],$space);
		}
		return $str;
	}
	
	function _get_table_fkip(){
		$row_fkip = $this->_get_fak_kip_list(0);
		//echo count($row_fkip);
		//$this->load->view('test',$data);
		$table = "	<table class=\"table table-bordered table-hover\">
						<thead>
							<tr>
								<th>Kode</th>
								<th>Nama</th>									
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>";
		if(count($row_fkip) == 0){
			$table .= "<tr><td colspan='3'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
		}else{
			foreach($row_fkip as $r){
				$table .= "<tr style=\"background-color:#CCCCCC\">";
				$table .= "	<td>".$r['kode']."</td>";
				$table .= "	<td>&nbsp;".$r['nama']."</td>";
				$table .= "	<td class=\"ctr\">
								<div class=\"btn-group\">
									<a href=\"#fkip\" data-toggle=\"modal\" onclick=\"return isi_fkip('','" . $r['id'] . "','','','add-sub'"  . ")\" class=\"btn btn-info btn-sm\" title=\"Add Sub\"><i class=\"fa fa-plus-circle fa-fw\"> </i> Add Sub</a>
									<a href=\"#fkip\" data-toggle=\"modal\" onclick=\"return isi_fkip('". $r['id'] . "','0','" . $r['nama'] . "','" . $r['kode']  . "','edit'"  . ")\" class=\"btn btn-success btn-sm\" title=\"Edit Data\"><i class=\"fa fa-edit\"> </i> Edt</a>
									<a href=\"" . base_URL() . 'instansi/kode_surat/del/' . $r['id'] . "\" class=\"btn btn-warning btn-sm\" title=\"Hapus Data\" onclick=\"return confirm('Anda Yakin..?')\"><i class=\"fa fa-times\">  </i> Del</a>
								</div>
							</td>";
				$table .= "</tr>";
				
				$table .= $this->_print_recursive_table_kip($r['child']);
				
			}
		}
		
		
		$table .= "		</tbody>";
		$table .= "</table>";
		
		return $table;
		
	}
	
	function kode_surat(){
		
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
		
		cek_akses_menu(($a['menu']->id_menu), 14, "instansi"); 
		
		$a['pagi']				= "";	
		
		
		
		/* url */
		$mau_ke					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		/* $post */
		$idp					= $this->input->post('idp');
		$id_unit				= $this->input->post('id_unit');
		$nomor_induk			= $this->input->post('nomor_induk');
		$jabatan				= $this->input->post('jabatan');
		$jenjang                = $this->input->post('jenjang');
		$username				= $this->input->post('username');		
		$nama					= $this->input->post('nama');
		$level					= $this->input->post('level');
		$email					= $this->input->post('email');
		$aplikasi				= $this->input->post('aplikasi');
		$menu				 	= empty($_POST['menu']) ? NULL : $_POST['menu'];
		$jumlah_cek				= count($menu);
		
		
		if ($mau_ke == "add-sub") {
			
			$this->form_validation->set_rules('nama','Nama','xss_clean|required');
			$this->form_validation->set_rules('kode','Kode','xss_clean|required');
			$this->form_validation->set_rules('id_parent','id_parent','xss_clean|required');
			
			if($this->form_validation->run() == TRUE){
			  
			  $ins['nama'] = $this->input->post('nama');
			  $ins['kode'] = $this->input->post('kode');			  
			  $ins['id_parent'] = $this->input->post('id_parent');
			  
			  
			  $this->db->insert('kode_fkip',$ins);
			  
			  $this->session->set_flashdata("k", "<div class='alert alert-success'>Kode Surat baru berhasil ditambahkan</div>");	
				
			  redirect('instansi/kode_surat');
			  
			}else{		
			  $data['k'] = validation_errors();
			}
			
		} else if ($mau_ke == "edit") {
			
			$this->form_validation->set_rules('nama','Nama','xss_clean|required');
			$this->form_validation->set_rules('kode','Kode','xss_clean|required');
			//$this->form_validation->set_rules('id_parent','id_parent','xss_clean|required');
			
			if($this->form_validation->run() == TRUE){
			  
			  $id = $this->input->post('id');
			  $edit['nama'] = $this->input->post('nama');
			  $edit['kode'] = $this->input->post('kode');			  
			  //$edit['id_parent'] = $this->input->post('id_parent');
			  
			  $this->db->where('id',$id);
			  $this->db->update('kode_fkip',$edit);
			  
			  $this->session->set_flashdata("k", "<div class='alert alert-success'>Kode Surat berhasil diubah</div>");	
				
			  redirect('instansi/kode_surat');
			  
			}else{		
			  $data['k'] = validation_errors();
			}
			
		} else if ($mau_ke == "del") {
			$this->db->where('id',$id_u);
			$this->db->delete('kode_fkip');
			redirect('instansi/kode_surat');
		} else{
			$a['table_fkip'] = $this->_get_table_fkip();
			$a['page'] 		 = "instansi/d_kode_fkip";
		}
		
		$this->load->view('aaa', $a);
		
	}
	
	
	public function atur_user() {
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
		
		cek_akses_menu(($a['menu']->id_menu), 2, "instansi"); 
		
		$a['pagi']				= "";
				
		
		
		
		/* url */
		$mau_ke					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		/* $post */
		$idp					= $this->input->post('idp');
		$id_unit				= $this->input->post('id_unit');
		$nomor_induk			= $this->input->post('nomor_induk');
		$jabatan				= $this->input->post('jabatan');
		$jenjang                = $this->input->post('jenjang');
		$username				= $this->input->post('username');		
		$nama					= $this->input->post('nama');
		$level					= $this->input->post('level');
		$email					= $this->input->post('email');
		$aplikasi				= $this->input->post('aplikasi');
		$id_kode_fkip			= $this->input->post('id_kode_fkip');
		$menu				 	= empty($_POST['menu']) ? NULL : $_POST['menu'];
		$jumlah_cek				= count($menu);
		
		$cari					= addslashes($this->input->post('q'));
		$a['cari'] 				= $cari;
		
		if ($mau_ke == "add") {
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['select_fkip'] = $this->_get_select_fkip();
			$a['page']			= "instansi/f_atur_user";
		} else if ($mau_ke == "edit") {
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['datdet']	 	= $this->db->query("SELECT * FROM pengguna WHERE id = '$id_u'")->row();
			$a['select_fkip'] = $this->_get_select_fkip();
			$a['page']			= "instansi/f_atur_user";
		} else if ($mau_ke == "aksi_edit") {
			
			$menu_yang_ok	= "";
			
			if($level == "admin root") {
				
				$menu_yang_ok = "1,2,9,13,14,";
				
			} else if ($level == "pimpinan") {
				
				$menu_yang_ok = "3,4,5,6,7,8,";
				
			} else if ($level == "tata usaha") {
				
				$menu_yang_ok = "3,4,7,8,12,";
				
			} else if ($level == "staff") {
				
				$menu_yang_ok = "5,6,7,8,";
				
			}
			
			if ((strlen($username)) < 5) {
				$this->session->set_flashdata("k", "<div class='alert alert-danger'>Username minimal 5 karakter</div>");
			} else {
				$this->db->query("UPDATE pengguna
								  SET id_unit = '$id_unit',
									  nomor_induk = '$nomor_induk',
									  jabatan = '$jabatan',
									  jenjang = '$jenjang',
									  username = '$username',
									  nama = '$nama',
									  level = '$level',
									  apps = '$aplikasi',
									  id_kode_fkip = '$id_kode_fkip',
									  email = '$email',
									  id_menu = '$menu_yang_ok'
								  WHERE id = $idp");
			}
			redirect('instansi/atur_user');
		} else if ($mau_ke == "aksi_tambah") {
			$menu_yang_ok	= "";
			if($level == "admin root") {
				$menu_yang_ok = "1,2,9,13,14,";
			} else if ($level == "pimpinan") {
				$menu_yang_ok = "3,4,5,6,7,8,";
			} else if ($level == "tata usaha") {
				$menu_yang_ok = "3,4,7,8,12,";
			} else if ($level == "staff") {
				$menu_yang_ok = "5,6,7,8,";
			}
			
			$cek_tersedia	= $this->db->query("SELECT id FROM pengguna
											    WHERE username = '$username'")->num_rows();
			
			//perlu dicek spasi			
			if ((strlen($username)) < 5) {
				$this->session->set_flashdata("k", "<div class='alert alert-danger'>Username minimal 5 karakter...</div>");
			} else {
				$data['id_unit'] = $id_unit;
				$data['nama'] = $nama;
				$data['nomor_induk'] = $nomor_induk;
				$data['jabatan'] = $jabatan;
				$data['jenjang'] = $jenjang;
				$data['username']= $username;
				$data['password'] = md5(123456);
				$data['tgl_aktif'] = date('Y-m-d H:i:s');
				$data['status'] = 'Y';
				$data['level'] = $level;
				$data['apps'] = $aplikasi;
				$data['id_menu'] = $menu_yang_ok;
				$data['email'] = $email;
				
				$this->db->insert('pengguna',$data);
				
				//$this->db->query("INSERT pengguna VALUES (NULL, '$id_unit', '$nama','$nomor_induk','$username',
				//                  md5(123456), NOW(), 'Y', '$level', '$aplikasi',
				//                 '$menu_yang_ok', '$email')");
				$this->session->set_flashdata("k", "<div class='alert alert-success'>Username <b>$username</b> telah dibuat. Password default : <b>123456</b></div>");
			}
			$browser 	= detect();
			$nama_file	= "./capedeh/log_user/".md5($username).".log";
			if (!file_exists($nama_file)) { 
				_buat_baru($username, $nama_file);
			}
			/*
			if (!(file_exists($nama_file))) {
				$file_baru	= fopen($nama_file,"w");
				fputs($file_baru,"Log akses $username (".date('d-m-Y h:i:s')."). IP : ".$this->input->ip_address().", browser : ".$browser['name']." versi : ".$browser['version'].", OS : ".$browser['platform']."\r\n====================\r\n");
				fclose($nama_file);
			}*/
			
			redirect('instansi/atur_user');
		} else if ($mau_ke == "del") {
			$this->db->query("DELETE FROM pengguna WHERE id = $id_u");
			redirect('instansi/atur_user');
		}else if($mau_ke == "cari"){
			$a['data']				= $this->db->query("SELECT pengguna.*, unit.nama_unit AS nama_unit
													   FROM pengguna
													   INNER JOIN unit ON pengguna.id_unit = unit.kode_gabung
													   WHERE pengguna.nama LIKE '%$cari%' OR pengguna.username LIKE '%$cari%'
													   ORDER BY pengguna.id ASC")->result();
			$a['page'] 				= "instansi/d_atur_user";
			
		} else if($mau_ke == "import"){
			//oktober 13, 2014
			$a['list_menu']		= $this->db->query("SELECT * FROM menu ORDER BY sub_dari ASC")->result();
			$a['page']			= "instansi/f_import_user";
			
		} else if($mau_ke == "aksi_import"){	
			//oktober 13, 2014
			$data = array();
			
			if(!empty($_POST['hidden_input'])){
			    $conf['upload_path'] = './upload';
				$conf['allowed_types'] = 'xls';
				
				$this->load->library('upload',$conf);
				
				if(!$this->upload->do_upload('userfile')){
				
					echo $this->upload->display_errors();
					var_dump($this->upload->data());
					exit(0);
					
				}else{
					
					include_once ( APPPATH."libraries/excel_reader2.php");
					$xl_data = new Spreadsheet_Excel_Reader($_FILES['userfile']['tmp_name']);
					
					$j = 0;
					$new_rows = 0;
					$updated_rows = 0;
					
					//baris data dimulai dari baris ke 2
					//echo $xl_data->rowcount($sheet_index=0);
					//exit(0);
					for ($i = 2; $i < ($xl_data->rowcount($sheet_index=0)); $i++){
						/*
							id_unit,nama,nomor_induk,jabatan,jenjang,username,password,tgl_aktif=timestamp,status=y,
							level = 'admin root','pimpinan','tata usaha','staff',
							id_menu,
							apps = 'instansi','aset','surat',
							email
						*/
						
						$nama_unit		= $xl_data->val($i, 1);						
						
						$id_unit 		= $this->db->query("SELECT kode_gabung
															FROM unit
															WHERE nama_unit LIKE '%$nama_unit%'
															LIMIT 1");
						
						
						
							
						//exit(0);	
							
						$nama 			= $xl_data->val($i, 2);
						$nomor_induk 	= $xl_data->val($i, 3);
						$jabatan 		= $xl_data->val($i, 4);
						//$jenjang 		= $xl_data->val($i, 5);
						$username		= $xl_data->val($i, 5);
						$password		= md5($username);
						$tgl_aktif		= date('Y-m-d H:i:s');
						$status			= 'Y';
						$level			= $xl_data->val($i, 6);
						
						if($level == "admin root") {
							$menu_yang_ok = "1,2,9,13,14,";
						} else if ($level == "pimpinan") {
							$menu_yang_ok = "3,4,5,6,7,8,";
						} else if ($level == "tata usaha") {
							$menu_yang_ok = "3,4,7,8,12,";
						} else if ($level == "staff") {
							$menu_yang_ok = "5,6,7,8,";
						}
						
						$id_menu 		= $menu_yang_ok;
						$apps 			= $xl_data->val($i, 7);
						$email			= $xl_data->val($i, 8);
						
						if(empty($nama)) continue;
						
						//key : email
						if(!$this->_data_udah_ada('pengguna','email',$email)){
							//insert
							$insert_data = array(//'id_unit' 		=> 	$id_unit,
												 'nama' 		=> 	$nama,
												 'nomor_induk' 	=> 	$nomor_induk,
												 'jabatan' 		=>	$jabatan,
												// 'jenjang' 		=>	$jenjang,
												 'username'		=> 	$username,
												 'password' 	=> 	$password,
												 'tgl_aktif' 	=> 	$tgl_aktif,
												 'status' 		=> 	$status,
												 'level' 		=> 	$level,
												 'id_menu' 		=> 	$id_menu,
												 'apps' 		=> 	$apps,
												 'email' 		=> 	$email
												 );
							
							$insert_data['id_unit'] = $id_unit->num_rows() == 0 ? '' : $id_unit->row()->kode_gabung;
							//var_dump($insert_data);
							//exit(0);
							$this->db->insert('pengguna',$insert_data);	
							$new_rows++;
						}else{
							//update
							$update_data = array(//'id_unit' 		=> 	$id_unit,
												 'nama' 		=> 	$nama,
												 'nomor_induk' 	=> 	$nomor_induk,
												 'jabatan' 		=>	$jabatan,
												 //'jenjang' 		=>	$jenjang,
												 'username'		=> 	$username,
												 //'password' 	=> 	$password,
												 'tgl_aktif' 	=> 	$tgl_aktif,
												 'status' 		=> 	$status,
												 'level' 		=> 	$level,
												 'id_menu' 		=> 	$id_menu,
												 'apps' 		=> 	$apps,
												 'email' 		=> 	$email
												 );
							
							$update_data['id_unit'] = $id_unit->num_rows() == 0 ? '' : $id_unit->row()->kode_gabung;
							
							$this->db->where('email',$email);
							$this->db->update('pengguna',$update_data);
							$updated_rows++;
						}
						
					}
					
					echo unlink('./upload/'. $_FILES['userfile']['name']);
					//$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
					$this->session->set_flashdata('k',"<div class=\"alert alert-success\" id=\"alert\">Data berhasil diubah dengan ". $new_rows . " Data baru dan " . $updated_rows . " Data Update</div>"); 			
					redirect('instansi/atur_user');
				}
	
			}
			
		} else {
			/* mulai data inti */
			$a['data']				= $this->db->query("SELECT pengguna.*,
															   unit.nama_unit AS nama_unit
														FROM pengguna
														INNER JOIN unit ON pengguna.id_unit = unit.kode_gabung
														ORDER BY pengguna.id ASC")->result();
			$a['page']				= "instansi/d_atur_user";
		}
		
		
		$this->load->view('aaa', $a);
	}
	
	public function unit() {
		$a['admin_id']			= $this->session->userdata('admin_id');
		$a['admin_id_unit']		= $this->session->userdata('admin_id_unit');
		$a['admin_user']		= $this->session->userdata('admin_user');
		$a['admin_nama']		= $this->session->userdata('admin_nama');
		$a['admin_ta']			= $this->session->userdata('admin_ta');
		$a['admin_level']		= $this->session->userdata('admin_level');
		$a['admin_apps']		= $this->session->userdata('admin_apps');
		$a['admin_valid']		= $this->session->userdata('admin_valid');
		if ($a['admin_valid'] == FALSE || $a['admin_id'] == "") { redirect("dashboard/login"); } 		
		
		/* url */
		$aksi_u					= $this->uri->segment(3);
		$id_u					= $this->uri->segment(4);
		
		/* $post */
		$aksi_post				= $this->input->post('aksi');
		$aksi_lagi				= empty($aksi_post) ? $aksi_u : $aksi_post;
		$idp					= $this->input->post('id');
		$kode_00				= $this->input->post('kode_00');
		$kode_01				= $this->input->post('kode_01');
		$kode_02				= $this->input->post('kode_02');
		$kode_03				= $this->input->post('kode_03');
		$nama					= $this->input->post('nama');
		
		if ($aksi_lagi == "act_edit") {
			$this->db->query("UPDATE unit SET nama_unit = '$nama' WHERE id = $idp");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "del") {
			$this->db->query("DELETE FROM unit WHERE id = $id_u");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "add_") {
			$this->db->query("INSERT INTO unit VALUES (NULL, '', '', '', '', '', '$nama')");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "add_00") {
			$id_terakhir	= gli("unit", "unit_0", 2);
			$this->db->query("INSERT INTO unit VALUES (NULL, '$id_terakhir', '', '', '', '$id_terakhir', '$nama')");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "add_01") {
			$q_terakhir_u1	= $this->db->query("SELECT MAX(unit_1) AS lid FROM unit WHERE unit_0 = '$kode_00' AND unit_2 = '' AND unit_3 = ''")->row();
			$lid_u1			= intval($q_terakhir_u1->lid) + 1;
			$lid_u1			= str_pad($lid_u1, 2, '0', STR_PAD_LEFT);
			
			$this->db->query("INSERT INTO unit VALUES (NULL, '$kode_00', '$lid_u1', '', '', '".$kode_00.$lid_u1."', '$nama')");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "add_02") {
			$q_terakhir_u2	= $this->db->query("SELECT MAX(unit_2) AS lid FROM unit WHERE unit_0 = '$kode_00' AND unit_1 = '$kode_01' AND unit_3 = ''")->row();
			$lid_u2			= intval($q_terakhir_u2->lid) + 1;
			$lid_u2			= str_pad($lid_u2, 2, '0', STR_PAD_LEFT);
			
			$this->db->query("INSERT INTO unit VALUES (NULL, '$kode_00', '$kode_01', '$lid_u2', '', '".$kode_00.$kode_01.$lid_u2."', '$nama')");
			redirect('instansi/atur_instansi');
		} else if ($aksi_lagi == "add_03") {
			$q_terakhir_u3	= $this->db->query("SELECT MAX(unit_3) AS lid FROM unit WHERE unit_0 = '$kode_00' AND unit_1 = '$kode_01' AND unit_2 = '$kode_02'")->row();
			$lid_u3			= intval($q_terakhir_u3->lid) + 1;
			$lid_u3			= str_pad($lid_u3, 2, '0', STR_PAD_LEFT);
			
			$this->db->query("INSERT INTO unit VALUES (NULL, '$kode_00', '$kode_01', '$kode_02', '$lid_u3', '".$kode_00.$kode_01.$kode_02.$lid_u3."', '$nama')");
			redirect('instansi/atur_instansi');
		} else {
			redirect('instansi/atur_instansi');
		}
	}
		
	public function setting_header() {
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
		
		cek_akses_menu(($a['menu']->id_menu), 9, "instansi"); 
		 	
		
		$a['user']				= $this->db->query("SELECT * FROM pengguna WHERE status = 'Y'")->result();
				
		//ambil variabel URL
		$mau_ke					= $this->uri->segment(3);
		
		//ambil variabel Postingan
		$idp					= addslashes($this->input->post('idp'));
		$nama					= addslashes($this->input->post('nama'));
		$alamat					= addslashes($this->input->post('alamat'));
		
		$cari					= addslashes($this->input->post('q'));

		//upload config 
		$config['upload_path'] 		= './upload';
		$config['allowed_types'] 	= 'gif|jpg|png';
		$config['max_size']			= '2000';
		$config['max_width']  		= '3000';
		$config['max_height'] 		= '3000';

		$this->load->library('upload', $config);
		
		if ($mau_ke == "act_edt") {
			if (empty($idp)) {
				if ($this->upload->do_upload('logo')) {
					$up_data_logo = $this->upload->data();
					
					//then upload background
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('background_logo')) {
						$up_data_background = $this->upload->data();
						$this->db->query("INSERT INTO instansi VALUES (NULL, '$nama', '$alamat', '".$up_data_logo['file_name']."','".$up_data_background['file_name']."')");
					}else{						
						$this->db->query("INSERT INTO instansi VALUES (NULL, '$nama', '$alamat', '".$up_data_logo['file_name']."')");
					}


				} else {
					$this->db->query("INSERT INTO instansi VALUES (NULL, '$nama', '$alamat', '')");
				}		
			} else {
				
				$data = array();

				//logo
				if ($this->upload->do_upload('logo')) {
					$up_logo 		= $this->upload->data();
					$data['logo']	= $up_logo['file_name'];
				}
				
				//background_logo
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('background_logo')) {
					$up_background_logo 	 = $this->upload->data();
					$data['background_logo'] = $up_background_logo['file_name'];
				}

				//login_logo_header
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('login_logo_header')) {
					$up_login_logo_header      = $this->upload->data();
					$data['login_logo_header'] = $up_login_logo_header['file_name'];
				}
				
				
				/*
				if ($this->upload->do_upload('logo')) {
					$up_data_logo 	= $this->upload->data();
					
					//then upload background
					$this->load->library('upload', $config);
					if ($this->upload->do_upload('background_logo')){
						$up_data_background = $this->upload->data();
						$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat', logo = '".$up_data_logo['file_name']."', background_logo = '".$up_data_background['file_name']."' WHERE id = '$idp'");
					}else{
						$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat', logo = '".$up_data_logo['file_name']."' WHERE id = '$idp'");
					}

				} else {

					if ($this->upload->do_upload('background_logo')){
						$up_data_background = $this->upload->data();
						$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat', background_logo = '".$up_data_background['file_name']."'  WHERE id = '$idp'");	
					}else{
						$this->db->query("UPDATE instansi SET nama = '$nama', alamat = '$alamat' WHERE id = '$idp'");	
					}
					
				}
				*/
				
				$data['nama']   = $nama;
				$data['alamat'] = $alamat;

				$this->db->where('id', $idp);
        		$this->db->update('instansi', $data);	

			}

			$this->session->set_flashdata("k", "<div class=\"alert alert-success\" id=\"alert\">Data has been updated</div>");			
			redirect('instansi');
		} else {
			$a['data']		= $this->db->query("SELECT * FROM instansi WHERE id = '1' LIMIT 1")->row();
			$a['page']		= "instansi/f_pengguna";
		}
		
		$this->load->view('aaa', $a);	
	}

}