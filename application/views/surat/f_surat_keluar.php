<?php
   $pil_kecepatan	= array('sangat segera', 'segera', 'biasa');
   $pil_jenis		= $this->db->query("SELECT * FROM r_jenis_surat")->result();
   $a_pil_jenis	= array();
   foreach($pil_jenis as $apil) {
   	$a_pil_jenis[$apil->id]	= $apil->nama;
   }
   $mode			= $this->uri->segment(3);
   
   if ($mode == "edit" || $mode == "act_edt") {
      $act                = 	"act_edt";
      $idp                = 	$datdet->id;
      $id_rel_surat_masuk =	$datdet->id_rel_surat_masuk;
      $id_rel_disposisi   =	$datdet->id_rel_disposisi;
      $pengirim           =	$datdet->pengirim;
      $pengirim_user      =	$datdet->pengirim_user;
      $tgl_surat          =	$datdet->tgl_surat;
      $no_agenda          =	$datdet->no_agenda;
      $no_surat           =	$datdet->no_surat;
      $penerima           =	$datdet->penerima;
      $perihal            =	$datdet->perihal;
      $kecepatan          =	$datdet->kecepatan;
      $pemeriksa          =	$datdet->pemeriksa;
      $pemeriksa_user     =	$datdet->pemeriksa_user;
      $flag_setuju        =	$datdet->flag_setuju;
      $flag_keluar        =	$datdet->flag_keluar;
      $flag_del           =	$datdet->flag_del;
      $file               =	$datdet->file;
      $isi_surat          =	$datdet->isi_surat;
      $jenis_ok           =	$datdet->id_jenis_surat;
      $id_kode_hal_org    =   $datdet->id_kode_hal_org;
   } else {
      $act                = 	"act_add";
      $idp                = 	"";
      $id_rel_surat_masuk =	"";
      $id_rel_disposisi   =	"";
      $pengirim           =	"";
      $pengirim_user      =	"";
      $tgl_surat          =	"";
      $no_agenda          =	"";
      $no_surat           =	"";
      $penerima           =	"";
      $perihal            =	"";
      $kecepatan          =	"";
      $pemeriksa          =	"";
      $pemeriksa_user     =	"";
      $flag_setuju        =	"";
      $flag_keluar        =	"";
      $flag_del           =	"";
      $file               =	"";
      $isi_surat          =	"";
      $jenis_ok           =	"";
      $id_kode_hal_org    =   "";
   }
   ?>
<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Surat Keluar</b>
            </div>
            <div class="navbar-collapse" style="margin-bottom: 20px"></div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="col-lg-12">
               <form action="<?=base_URL().$admin_apps?>/konsep/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                  <input type="hidden" name="idp" value="<?php echo $idp; ?>">
                  <input type="hidden" name="tipe" value="file">
                  <div class="col-lg-6">
                     <table  class="table-form">
                        <tr>
                           <td>Tanggal Surat</td>
                           <td><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" class="form-control col-lg-5 tag_tgl" tabindex="1" autofocus></td>
                        </tr>
                        <tr>
                           <td>Penerima</td>
                           <td><input type="text" name="penerima" required value="<?php echo $penerima; ?>" id="penerima" class="form-control col-lg-12" tabindex="2"></td>
                        </tr>
                        <tr>
                           <td width="25%">Kecepatan</td>
                           <td><select name="kecepatan" class="form-control col-lg-5" tabindex="3"><?php echo select_array($pil_kecepatan, $pil_kecepatan); ?></select></td>
                        </tr>
                        <tr>
                           <td width="25%">Jenis Surat</td>
                           <td><?php echo form_dropdown('jenis_syurat', $a_pil_jenis, $jenis_ok, "class='form-control col-lg-5' tabindex='4'"); ?></td>
                        </tr>
                        <tr>
                           <td colspan="2">
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-lg-6">
                     <table  class="table-form">
                        <tr>
                           <td width="30%">Pemeriksa</td>
                           <td>
                              <select name="pemeriksa" id="pemeriksa" class="form-control col-lg-6" tabindex="5" ><?php echo select_unit(); ?></select> 
                              <!--
                              <div class="col-lg-2" style="margin-top: 10px">User</div>
                              <select name="user" id="user" class="form-control col-lg-4" tabindex="6">
                              <?php 
                                 if (!empty($user)) {
                                 	foreach ($user as $u) {
                                 		//echo "<option value='".$u->id."'>".$u->username."</option>";
                                 		
                                 		if ($u->id != $this->session->userdata('admin_id')) {
                                 			echo "<option value='".$u->id."' class='".$u->id_unit."'>".$u->jabatan." (".$u->username.")</option>";
                                 		} else {
                                 			echo "<option value='".$u->id."' class='".$u->id_unit."'>Saya (".$u->level.")</option>";
                                 		}
                                 	}
                                 } 
                                 ?>
                              </select>
                              -->
                           </td>
                        </tr>
                        
                        <tr>
                           <td width="30%">User</td>
                           <td>
                              <select name="user" id="user" class="form-control col-lg-12 pull-left" style="left: 0; right: auto;" tabindex="6">
                              <?php 
                                 if (!empty($user)) {
                                    foreach ($user as $u) {
                                       //echo "<option value='".$u->id."'>".$u->username."</option>";
                                       
                                       if ($u->id != $this->session->userdata('admin_id')) {
                                          echo "<option value='".$u->id."' class='".$u->id_unit."'>".$u->jabatan." (".$u->username.")</option>";
                                       } else {
                                          echo "<option value='".$u->id."' class='".$u->id_unit."'>Saya (".$u->level.")</option>";
                                       }
                                    }
                                 } 
                                 ?>
                              </select>
                           </td>
                        </tr>
                        
                        <tr>
                           <td>Perihal surat</td>
                           <td><input type="text" name="perihal" required value="<?php echo $perihal; ?>" id="perihal" class="form-control col-lg-12" tabindex="7"></td>
                        </tr>
      						<tr>
      						   <td>Kode Hal Org. dan Tata kerja</td>
      						   <td>
      							  <select name="id_kode_hal_org" id="id_kode_hal_org" class="form-control col-lg-6" tabindex="6">
      								 <?php foreach($r_kode_hal_org->result() as $r){ ?>
      								 <option value="<?=$r->id;?>"><?php echo $r->nama . ' (' . $r->kode . ')';?></option>
      								 <?php }?>
      							  </select>
      						   </td>
      						</tr>
                        <tr>
                           <td>File Berkas (Scan)</td>
                           <td>
                              <input type="file" name="file_surat" class="form-control col-lg-6" tabindex="8" >
                           </td>
                        </tr>
                     </table>
                  </div>
				  <div class="col-lg-12" style="margin-top: 20px">				  
					<table class="table-form">
						<tbody>
							<tr>
								<td width="12%">Isi Surat</td>
								<td>
									<textarea name="isi_surat" id="tinyMCE"><?=$isi_surat;?></textarea>
								</td>
							</tr>
						</tbody>
					</table>				  
				  </div>
				  
                  <div class="col-lg-12" style="margin-top: 20px">
                     <button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
                     <a href="<?=base_URL().$admin_apps?>/konsep" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
  <?php if ($mode == "edit" || $mode == "act_edt") { ?>
    $(document).ready(function () {
		$('select[name="pemeriksa"]').find('option[value="<?=$pemeriksa ;?>"]').attr("selected", true);
		$("#user").chained("#pemeriksa");
		$('select[name="user"]').find('option[value="<?=$pemeriksa_user ;?>"]').attr("selected", true);
		$('select[name="id_kode_hal_org"]').find('option[value="' + <?=$id_kode_hal_org ;?> + '"]').attr("selected", true);
	});
  <?php }else{ ?>
  
	$("#user").chained("#pemeriksa");
	
  <?php } ?> 
</script>
<?php //echo "<pre>".var_dump($user)."</pre>"; ?>