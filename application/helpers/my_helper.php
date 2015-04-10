<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* ambil database */
function gli($tabel, $field_kunci, $pad) {
	$CI 	=& get_instance();
	$nama	= $CI->db->query("SELECT max($field_kunci) AS last FROM $tabel")->row();
	$data	= (intval($nama->last)) + 1;
	$last	= str_pad($data, $pad, '0', STR_PAD_LEFT);
	return $last;
}
function gli3($tabel, $field_kunci, $pad, $wh) {
	$CI 	=& get_instance();
	$nama	= $CI->db->query("SELECT max($field_kunci) AS last FROM $tabel $wh")->row();
	$data	= (intval($nama->last)) + 1;
	$last	= str_pad($data, $pad, '0', STR_PAD_LEFT);
	return $last;
}
function gli2($tabel, $field_kunci) {
	$CI 	=& get_instance();
	$nama	= $CI->db->query("SELECT max($field_kunci) AS last FROM $tabel")->row();
	$data	= (intval($nama->last)) + 1;
	return $data;
}
function gval($tabel, $field_kunci, $diambil, $where) {
	$CI =& get_instance();	
	$nama	= $CI->db->query("SELECT $diambil FROM $tabel WHERE $field_kunci = '$where'")->row();
	$data	= empty($nama) ? "-" : $nama->$diambil;
	return $data;
}

function select_array($array_val, $array_view) {
	$select	= "";
	for ($i = 0; $i < sizeof($array_val); $i++) {
		$select .= "<option value='".$array_val[$i]."'>".$array_view[$i]."</option>";
	}
	return $select;
}

function select_array_selected($array_val, $array_view, $selected) {
	$select	= "";
	for ($i = 0; $i < sizeof($array_val); $i++) {
		if ($array_val[$i] == $selected) {
			$select .= "<option value='".$array_val[$i]."' selected>".$array_view[$i]."</option>";
		} else {
			$select .= "<option value='".$array_val[$i]."'>".$array_view[$i]."</option>";
		}
	}
	return $select;
}


function cekbox_menu() {
	$CI =& get_instance();
	
	$cek_menu	= "<div class='col-lg-12' style='margin-left: -30px'>";
	$q_menu		= $CI->db->query("SELECT * FROM menu ORDER BY id")->result();
	
	if (!empty($q_menu)) {
		foreach ($q_menu as $m) {
			$cek_menu .= "<div class='col-lg-6'><label><input type='checkbox' name='menu[]' value='".$m->id."' id='menu_".$m->id."'> &nbsp; <i class='fa fa-".$m->icon."'> </i> ".$m->nama."</label></div>";
		}
	}
	$cek_menu	.= "</div>";
	
	return $cek_menu;	
}


function select_unit() {
	$CI =& get_instance();	
	
	$u__	= $CI->db->query("SELECT * FROM unit WHERE unit_0 = '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->row();
	$select = "<option value='".$u__->unit_0."'>* ".$u__->nama_unit."</option>";
	
	$unit	= $CI->db->query("SELECT * FROM unit WHERE unit_0 != '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->result();
	if (!empty($unit)) {	
		foreach ($unit as $u) {
			$unit2 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 != '' AND unit_2 = '' AND unit_3 = ''	")->result();
			if (!empty($unit2)) {
				$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
				foreach ($unit2 as $u2) {
					$unit3 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 != '' AND unit_3 = ''")->result();
					if (!empty($unit3)) {
						$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
						foreach ($unit3 as $u3) {
							$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 = '".$u3->unit_2."' AND unit_3 != ''")->result();
							if (!empty($unit4)) {
								$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
								foreach ($unit4 as $u4) {
									$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
								}
							} else {
								$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
							}
						}
					} else {
						$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
					}
				}
			} else {
				$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
			}
		}
	}
	
	return $select;
}

function select_unit_aktif($unit_aktif) {
	$CI =& get_instance();	
	$select = "<option value=''> -- </option>";
	$tingkat	= strlen($unit_aktif);
	
	if ($tingkat == 0) {
		$u__	= $CI->db->query("SELECT * FROM unit WHERE unit_0 = '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->row();
		$select = "<option value='".$u__->unit_0."'>* ".$u__->nama_unit."</option>";
		
		$unit	= $CI->db->query("SELECT * FROM unit WHERE unit_0 != '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->result();
		
		if (!empty($unit)) {	
			foreach ($unit as $u) {
				$unit2 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 != '' AND unit_2 = '' AND unit_3 = ''	")->result();
				if (!empty($unit2)) {
					$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
					foreach ($unit2 as $u2) {
						$unit3 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 != '' AND unit_3 = ''")->result();
						if (!empty($unit3)) {
							$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
							foreach ($unit3 as $u3) {
								$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 = '".$u3->unit_2."' AND unit_3 != ''")->result();
								if (!empty($unit4)) {
									$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
									foreach ($unit4 as $u4) {
										$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
									}
								} else {
									$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
								}
							}
						} else {
							$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
						}
					}
				} else {
					$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
				}
			}
		}
	} else if ($tingkat == 2) {
		
		$unit2 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$unit_aktif."' AND unit_1 != '' AND unit_2 = '' AND unit_3 = ''	")->result();
		
		if (!empty($unit2)) {
			$select .= '<option value="'.$unit_aktif.'">'.gval("unit", "kode_gabung", "nama_unit", $unit_aktif).'</option>';			
			
			foreach ($unit2 as $u2) {
				
				$unit3 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u2->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 != '' AND unit_3 = ''")->result();
				if (!empty($unit3)) {
					$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
					//break;
					
					foreach ($unit3 as $u3) {
						
						$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u3->unit_0."' AND unit_1 = '".$u3->unit_1."' AND unit_2 = '".$u3->unit_2."' AND unit_3 != ''")->result();
						if (!empty($unit4)) {
							$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
							
							foreach ($unit4 as $u4) {
								$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
							}
							
						} else {
							$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
						}
					}
					
				} else {
					$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
				}
			}
			
		} else {
			$select .= '<option value="'.$unit_aktif.'">'.gval("unit", "kode_gabung", "nama_unit", $unit_aktif).'</option>';
		}
		
	} else if ($tingkat == 4) {
		$unit3 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".substr($unit_aktif,0,2)."' AND unit_1 = '".substr($unit_aktif,2,2)."' AND unit_2 != '' AND unit_3 = ''")->result();
		if (!empty($unit3)) {
			$select .= '<option value="'.$unit_aktif.'">--- | '.gval("unit", "kode_gabung", "nama_unit", $unit_aktif).'</option>';
			foreach ($unit3 as $u3) {
				$select 	.= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
				$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u3->unit_0."' AND unit_1 = '".$u3->unit_1."' AND unit_2 = '".$u3->unit_2."' AND unit_3 != ''")->result();
				if (!empty($unit4)) {
					foreach ($unit4 as $u4) {
						$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
					}
				}
			}
		} else {
			$select .= '<option value="'.$unit_aktif.'">--- | '.gval("unit", "kode_gabung", "nama_unit", $unit_aktif).'</option>';
		}			
	} else if ($tingkat == 6) {
		$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".substr($unit_aktif,0,2)."' AND unit_1 = '".substr($unit_aktif,-4,-2)."' AND unit_2 = '".substr($unit_aktif,4,2)."' AND unit_3 != ''")->result();
		$select .= '<option value="'.$unit_aktif.'">--- | --- | '.gval("unit", "kode_gabung", "nama_unit", $unit_aktif).'</option>';
		if (!empty($unit4)) {
			foreach ($unit4 as $u4) {
				$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
			}
		}		
	} else {
		$select .= "<option value=''>-Kosong-</option>";
	}
	
	return $select;
}


function select_unit_val($val) {
	$CI =& get_instance();	
	
	$u__	= $CI->db->query("SELECT * FROM unit WHERE unit_0 = '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->row();
	
	if ($val == $u__->unit_0) {
		$select = "<option value='".$u__->unit_0."' selected>* ".$u__->nama_unit."</option>";
	} else {
		$select = "<option value='".$u__->unit_0."'>* ".$u__->nama_unit."</option>";
	}
	
	$unit	= $CI->db->query("SELECT * FROM unit WHERE unit_0 != '' AND unit_1 = '' AND unit_2 = '' AND unit_3 = ''")->result();
	if (!empty($unit)) {	
		foreach ($unit as $u) {
			$unit2 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 != '' AND unit_2 = '' AND unit_3 = ''	")->result();
			if (!empty($unit2)) {
				if ($val == $u->kode_gabung) {
					$select .= '<option value="'.$u->kode_gabung.'" selected>'.$u->nama_unit.'</option>';
				} else {
					$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
				}
				foreach ($unit2 as $u2) {
					$unit3 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 != '' AND unit_3 = ''")->result();
					if (!empty($unit3)) {
						if ($val == $u2->kode_gabung) {
							$select .= '<option value="'.$u2->kode_gabung.'" selected>--- | '.$u2->nama_unit.'</option>';
						} else {
							$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
						}	
						
						foreach ($unit3 as $u3) {
							$unit4 = $CI->db->query("SELECT * FROM unit WHERE unit_0 = '".$u->unit_0."' AND unit_1 = '".$u2->unit_1."' AND unit_2 = '".$u3->unit_2."' AND unit_3 != ''")->result();
							if (!empty($unit4)) {
								if ($val == $u3->kode_gabung) {
									$select .= '<option value="'.$u3->kode_gabung.'" selected>--- | --- | '.$u3->nama_unit.'</option>';
								} else {
									$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
								}	
								
								foreach ($unit4 as $u4) {
									if ($val == $u4->kode_gabung) {
										$select .= '<option value="'.$u4->kode_gabung.'" selected>--- | --- | --- | '.$u4->nama_unit.'</option>';
									} else {
										$select .= '<option value="'.$u4->kode_gabung.'">--- | --- | --- | '.$u4->nama_unit.'</option>';
									}		
								}
							} else {
								if ($val == $u3->kode_gabung) {
									$select .= '<option value="'.$u3->kode_gabung.'" selected>--- | --- | '.$u3->nama_unit.'</option>';
								} else {
									$select .= '<option value="'.$u3->kode_gabung.'">--- | --- | '.$u3->nama_unit.'</option>';
								}
							}
						}
					} else {
						if ($val == $u2->kode_gabung) {
							$select .= '<option value="'.$u2->kode_gabung.'" selected>--- | '.$u2->nama_unit.'</option>';
						} else {
							$select .= '<option value="'.$u2->kode_gabung.'">--- | '.$u2->nama_unit.'</option>';
						}	
						
					}
				}
			} else {
				if ($val == $u->kode_gabung) {
					$select .= '<option value="'.$u->kode_gabung.'" selected>'.$u->nama_unit.'</option>';
				} else {
					$select .= '<option value="'.$u->kode_gabung.'">'.$u->nama_unit.'</option>';
				}
			}
		}
	}
	
	return $select;
}

/* fungsi non database */
function tgl_jam_sql ($tgl) {
	$pc_satu	= explode(" ", $tgl);
	if (count($pc_satu) < 2) {	
		$tgl1		= $pc_satu[0];
		$jam1		= "";
	} else {
		$jam1		= $pc_satu[1];
		$tgl1		= $pc_satu[0];
	}
	
	$pc_dua		= explode("-", $tgl1);
	$tgl		= $pc_dua[2];
	$bln		= $pc_dua[1];
	$thn		= $pc_dua[0];
	
	
	if ($bln == "01") { $bln_txt = "Jan"; }  
	else if ($bln == "02") { $bln_txt = "Feb"; }  
	else if ($bln == "03") { $bln_txt = "Mar"; }  
	else if ($bln == "04") { $bln_txt = "Apr"; }  
	else if ($bln == "05") { $bln_txt = "Mei"; }  
	else if ($bln == "06") { $bln_txt = "Jun"; }  
	else if ($bln == "07") { $bln_txt = "Jul"; }  
	else if ($bln == "08") { $bln_txt = "Ags"; }  
	else if ($bln == "09") { $bln_txt = "Sep"; }  
	else if ($bln == "10") { $bln_txt = "Okt"; }  
	else if ($bln == "11") { $bln_txt = "Nov"; }  
	else if ($bln == "12") { $bln_txt = "Des"; }  	
	else { $bln_txt = ""; }
	
	return $tgl." ".$bln_txt." ".$thn."  ".$jam1;
}

/* penyederhanaan fungsi */
function _page($total_row, $per_page, $uri_segment, $url) {
	$CI 	=& get_instance();
	$CI->load->library('pagination');
	$config['base_url'] 	= $url;
	$config['total_rows'] 	= $total_row;
	$config['uri_segment'] 	= $uri_segment;
	$config['per_page'] 	= $per_page; 
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close']= '</li>';
	$config['prev_link'] 	= '&lt;';
	$config['prev_tag_open']='<li>';
	$config['prev_tag_close']='</li>';
	$config['next_link'] 	= '&gt;';
	$config['next_tag_open']='<li>';
	$config['next_tag_close']='</li>';
	$config['cur_tag_open']='<li class="active disabled"><a href="#"  style="background: #e3e3e3">';
	$config['cur_tag_close']='</a></li>';
	$config['first_tag_open']='<li>';
	$config['first_tag_close']='</li>';
	$config['last_tag_open']='<li>';
	$config['last_tag_close']='</li>';
	
	$CI->pagination->initialize($config); 
	return $CI->pagination->create_links();
}

function _print_pdf($file, $data) {
	require_once('h2p/html2fpdf.php');          // agar dapat menggunakan fungsi-fungsi html2pdf
	ob_start();                            		// memulai buffer
	error_reporting(1);                     	// turn off warning for deprecated functions
	$pdf= new HTML2FPDF();                  	// membuat objek HTML2PDF
	$pdf->DisplayPreferences('Fullscreen');
	
	$html = $data;               		// mengambil data dengan format html, dan disimpan di variabel
	ob_end_clean();                         	// mengakhiri buffer dan tidak menampilkan data dalam format html
	$pdf->addPage();                        	// menambah halaman di file pdf
	$pdf->WriteHTML($html);                 	// menuliskan data dengan format html ke file pdf
	return $pdf->Output($file,'D'); 
}

function cek_akses_data($admin_id, $data_id, $tabel, $redirek) {
	$CI =& get_instance();	
	$data_pengolah	= $CI->db->query("SELECT pengolah FROM $tabel WHERE id = '$data_id'")->row();
	
	if ($admin_id != $data_pengolah->pengolah) {
		redirect($redirek);
	}
}

function cek_akses_data_2($admin_id, $tentu, $kunci, $data_id, $tabel, $redirek) {
	$CI =& get_instance();	
	$data_pengolah	= $CI->db->query("SELECT $tentu FROM $tabel WHERE $kunci = '$data_id'")->row();
	
	if ($admin_id != $data_pengolah->$tentu) {
		redirect($redirek);
	}
}

function cek_empty_post($redirek) {
	if (empty($_POST)) {
		redirect($redirek);
	}
}

function _tulis_f($data, $file) {
	$fp = fopen($file, 'a'); 
	fwrite($fp, $data); 
	fclose($fp);
}

function _buat_baru($user, $file) {
	$CI 		=& get_instance();
	$browser	= detect(); 
	$fp = fopen($file, "w");;
	fwrite($fp, "Log akses dibuat untuk username : $user (pada ".date('d-m-Y h:i:s')."). IP : ".$CI->input->ip_address().", browser : ".$browser['name']." versi : ".$browser['version'].", OS : ".$browser['platform']."\r\n====================\r\n");
	fclose($fp);
}


function detect() {
	$userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);

	if (preg_match('/opera/', $userAgent)) {
	  $name = 'Opera';
	} elseif (preg_match('/webkit/', $userAgent)) {
	  $name = 'Safari/Chrome';
	} elseif (preg_match('/msie/', $userAgent)) {
	  $name = 'Internet Explorer';
	} elseif (preg_match('/mozilla/', $userAgent) && !preg_match('/compatible/', $userAgent)) {
	  $name = 'Mozilla Firefox';
	} else {
	  $name = 'unrecognized';
	}


	if (preg_match('/.+(?:fox|it|ra|ie)[\/: ]([\d.]+)/', $userAgent, $matches)) {
	  $version = $matches[1];
	} else {
	  $version = 'unknown';
	}


	if (preg_match('/linux/', $userAgent)) {             
		$platform = 'linux';         
	} elseif (preg_match('/macintosh|mac os x/', $userAgent)) {             
		$platform = 'mac';         
	} elseif (preg_match('/NT 7.0/i', $userAgent)) {             
		$platform = 'Windows 2010';         
	} elseif (preg_match('/NT 6.1/i', $userAgent)) {             
		$platform = 'Windows 7';         
	} elseif (preg_match('/NT 6.0/i', $userAgent)) {             
		$platform = 'Windows Vista';         
	} elseif (preg_match('/NT 5.2/i', $userAgent)) {             
		$platform = 'Windows Server 2003';         
	} elseif (preg_match('/NT 5.1/i', $userAgent)) {             
		$platform = 'Windows XP';         
	} elseif (preg_match('/NT 5.0/i', $userAgent)) {             
		$platform = 'Windows 2000';         
	} else {             
		$platform = '???';         
	}

	return array(
	'name' => $name,
	'version' => $version,
	'platform' => $platform,
	'userAgent' => $userAgent
	);

}

function cek_akses_menu($menu, $yg_dicek, $redirek) {
	$CI =& get_instance();
	$pc_a_menu		= explode(",", $menu);
	if (in_array($yg_dicek, $pc_a_menu) == FALSE ) { 
		$CI->session->set_flashdata("k", "<div class='alert alert-danger'>Anda tidak mempunyai hak akses pada menu ini ...!!</div>"); 
		redirect($redirek); 
	}
}

function kirim_email($to, $subject, $message) {
	$from 		= "admin_surat@hk2903.web.id";
	$headers 	= "From:" . $from;
	$kirim		= mail($to,$subject,$message,$headers);
	
	if ($kirim == TRUE) {
		return TRUE;
	} else {
		return FALSE;
	}
}