<?php 
   $pil_app		= array('instansi','surat');
   $mode			= $this->uri->segment(3);
   
   if ($mode == "add") {
      $idp          = "";
      $act          = "aksi_tambah";
      $id_unit      = "";
      $username     = "";
      $nomor_induk  = "";
      $jabatan      = "";
      $jenjang      = "";
      $nama         = "";
      $level        = "";
      $id_kode_fkip = "";
      $email        = "";
      $aplikasi     = "";
      $menu         = array("");
      $readonly     = "";
   } else if ($mode == "edit") {
      $idp          = $datdet->id;
      $act          = "aksi_edit";
      $id_unit      = $datdet->id_unit;
      $username     = $datdet->username;
      $nomor_induk  = $datdet->nomor_induk;
      $jabatan      = $datdet->jabatan;
      $jenjang      = $datdet->jenjang;
      $nama         = $datdet->nama;
      $level        = $datdet->level;
      $id_kode_fkip = $datdet->id_kode_fkip;
      $email        = $datdet->email;
      $aplikasi     = $datdet->apps;
      $menu         = explode(",",$datdet->id_menu);
      $readonly     = "readonly";
   }
   
   ?>
<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Atur User</b>
            </div>
            <div class="navbar-collapse" style="margin-bottom: 20px"></div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="col-lg-12">
               <?php echo $this->session->flashdata("k_passwod");?>
			   <?php echo $this->session->flashdata("msg");?>
               <form action="<?=base_URL().$admin_apps?>/atur_user/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  <input type="hidden" name="idp" value="<?php echo $idp; ?>">
                  <div class="col-lg-12">
                     <div class="alert alert-info">*) Setiap user yang dibuat, password otomatis adalah : <b>123456</b></div>
                     <table width="100%" class="table-form" align="center">
                        <tr>
                           <td width="15%">Unit Kerja</td>
                           <td><select name="id_unit" id="data2" onchange="return pengaruhi_level('<?php echo $level; ?>');" class="form-control col-lg-6" autofocus><?php echo select_unit_val($id_unit); ?></select></td>
                        </tr>
                        <tr>
                           <td>Username</td>
                           <td>
                              <input type="text" name="username" class="form-control col-lg-3" required value="<?php echo $username; ?>" <?php echo $readonly; ?>>
                              <!--<div class="col-lg-2" style="margin-top: 7px">Nama</div>-->
                              <!--<input type="text" name="nama" class="form-control col-lg-3" required value="<?php echo $nama; ?>">-->
                           </td>
                        </tr>
						<tr>
							<td>Nama</td>
							<td>
								<input type="text" name="nama" class="form-control col-lg-3" required value="<?php echo $nama; ?>">
							</td>
						</tr>
						
						<tr>
							<td>Nomor Induk</td>
							<td>
								<input type="text" name="nomor_induk" class="form-control col-lg-3" required value="<?php echo $nomor_induk; ?>">
							</td>
						</tr>
						
						<tr>
							<td>Jabatan</td>
							<td>
								<input type="text" name="jabatan" class="form-control col-lg-3" required value="<?php echo $jabatan; ?>">
							</td>
						</tr>
						<!--
						<tr>
							<td>jenjang</td>
							<td>
							  <select name="jenjang" class="form-control col-lg-3" required="">
								 <option value=""> -- </option>
								 <option value="S1"	<?php echo $jenjang === 'S1' ? 'selected':'';?>>S1</option>
								 <option value="S2"	<?php echo $jenjang === 'S2' ? 'selected':'';?>>S2</option>
								 <option value="S3"	<?php echo $jenjang === 'S3' ? 'selected':'';?>>S3</option>
							  </select>
						   </td>
						</tr>
                  -->
						
                        <tr>
                           <td>Level</td>
                           <td>
                              <select name="level" id="data4" class="form-control col-lg-3" required></select>
                              <!--<div class="col-lg-2" style="margin-top: 7px">Set Aplikasi</div>
                              <select name="aplikasi" id="aplikasi" class="form-control col-lg-3" required onchange="return set_menu_pilih();">
                                 <option value="">--</option>
                                 <?php echo select_array_selected($pil_app, $pil_app, $aplikasi); ?>						
                              </select>-->
                           </td>
                        </tr>
						<tr>
						   <td>Set Aplikasi</td>
						   <td>
							  <select name="aplikasi" id="aplikasi" class="form-control col-lg-3" required onchange="return set_menu_pilih();">
                                 <option value="">--</option>
                                 <?php echo select_array_selected($pil_app, $pil_app, $aplikasi); ?>						
                              </select>
						   </td>
						</tr>
						<tr>
						   <td>Kode Surat</td>
						   <td>
							  <?=$select_fkip;?>
						   </td>
						</tr>
                        <tr>
                           <td>Email</td>
                           <td>
                              <?php echo form_input('email', $email, 'class="form-control col-lg-6" required'); ?>
                           </td>
                           <!--<tr><td>Akses Menu</td>
                              <td><div class="col-lg-8 well" style="padding-left: 0px">
                              <?php 
                                 if (!empty($list_menu)) {
                                 	foreach ($list_menu as $lm) {
                                 		$id_menu	= $lm->id;
                                 		if (in_array($id_menu, $menu) == TRUE) {
                                 			echo "<div class='col-lg-4'><label class='".$lm->sub_dari."'><input type='checkbox' name='menu[]' value='".$lm->id."' id='menu_".$lm->id."' checked> &nbsp; <i class='fa fa-".$lm->icon."'> </i> ".$lm->nama."</label></div>";
                                 		} else {
                                 			echo "<div class='col-lg-4'><label class='".$lm->sub_dari."'><input type='checkbox' name='menu[]' value='".$lm->id."' id='menu_".$lm->id."'> &nbsp; <i class='fa fa-".$lm->icon."'> </i> ".$lm->nama."</label></div>";
                                 		}
                                 	}
                                 }
                                 ?>
                              </div></td></tr>-->
                        <tr>
                           <td colspan="2">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"> </i> Simpan</button>
                              <a href="<?=base_URL().$admin_apps?>/atur_user" class="btn btn-success"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
                           </td>
                        </tr>
                     </table>
                  </div>
               </form>
            </div>
            <!-- /.row -->
         </div>
         <!-- /.panel-body -->
      </div>
      <!-- /.panel -->
   </div>
   <!-- /.col-lg-4 -->
</div>
<!-- /.row -->
<script type="text/javascript">
   $(document).ready(function () {
	  pengaruhi_level('<?php echo $level; ?>');
	  set_menu_pilih();
	  $('select[name="id_kode_fkip"]').find('option[value="' + <?=$id_kode_fkip;?> + '"]').attr("selected", true);
   });
   
   function set_menu_pilih() {
   	var apps = $("#aplikasi").val();
   	$('label').css('display', 'none');
   	$('label[class='+apps+']').css('display', 'block');
   }	
   function pengaruhi_level(aktif) {
   	var unit_kerja = $("#data2").val();
   	
   	var pilihan	= "<option value=''> -- </option>";
   	if (unit_kerja == "") {
   		var pilih = new Array("admin root","pimpinan","tata usaha","staff");
   		for (i=0; i<pilih.length; i++) {
   			if (aktif == pilih[i]) {
   				pilihan += "<option value='"+pilih[i]+"' selected>"+pilih[i]+"</option>";
   			} else {
   				pilihan += "<option value='"+pilih[i]+"'>"+pilih[i]+"</option>";
   			}
   		}
   	} else {	
   		var pilih = new Array("pimpinan","staff");
   		for (i = 0; i < pilih.length; i++) {
   			if (aktif == pilih[i]) {
   				pilihan += "<option value='"+pilih[i]+"' selected>"+pilih[i]+"</option>";
   			} else {
   				pilihan += "<option value='"+pilih[i]+"'>"+pilih[i]+"</option>";
   			}
   		}
   	}
   	$("#data4").html(pilihan);
   	
   }
</script>
