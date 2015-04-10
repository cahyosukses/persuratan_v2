<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Konsep</b>
            </div>
            <ul class="nav navbar-nav">
               <li><a href="<?php echo base_URL().$admin_apps; ?>/konsep/add" class="btn-info"><i class="fa fa-edit fa-fw"> </i> Buat Konsep</a></li>
            </ul>
            <!--
               <ul class="nav navbar-nav">
               	<li>
               		<div class="btn-group">
               			<a href="<?php echo base_URL().$admin_apps; ?>/konsep/add" class="btn btn-info btn-large"><i class="fa fa-edit fa-fw"> </i> Buat Konsep</a>
               			<!---
               			
               			<ul class="dropdown-menu">
               				<li><a href="#"><i class="fa fa-th-list"> </i> Biasa</a></li>
               				<li><a href="<?php echo base_URL().$admin_apps; ?>/konsep/add"><i class="fa fa-upload"> </i> Dengan File Upload</a></li>
               			</ul>
               		</div>
               	</li>
               </ul>-->
            <div class="navbar-collapse collapse navbar-inverse-collapse" >
               <ul class="nav navbar-nav navbar-right">
                  <form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/konsep/cari">
                     <input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
                     <button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
					 <a href="<?php echo base_url() . $admin_apps . '/konsep';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
                  </form>
               </ul>
            </div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="row">
               <div class="col-lg-12">
                  <div class="table-responsive">
                     <?php echo $this->session->flashdata("k");?>
                     <table class="table table-bordered table-hover">
                        <thead>
                           <tr>
                              <th width="10%">Tanggal</th>
                              <th width="20%">Nomor Surat, File</th>
                              <th width="20%">Perihal<br>Penerima</th>
                              <th width="25%">Status</th>
                              <th width="40%">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              if (empty($data)) {
                              	echo "<tr><td colspan='5' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td></tr>";
                              } else {
                              	$no 	= ($this->uri->segment(4) + 1);
                              	foreach ($data as $b) {
                              		$no_surat	= empty($b->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $b->no_surat;
									         $filenya	= empty($b->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$b->file."' target='_blank'><b>Download / Lihat</b></a>";
                              			
                              		$no_agenda	= empty($b->no_agenda) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $b->no_agenda;
                              		
                              		
                              		$stat_setuju	= $b->flag_setuju == "N" ? "<span class='label label-danger'>Belum diperiksa</span>" : "<span class='label label-success'>Sudah diperiksa dan setuju</span>";
                              		$stat_keluar	= $b->flag_keluar == "N" ? "<span class='label label-danger'>Belum dikirim</span>" : "<span class='label label-success'>Sudah dikirim</span>";
									         $stat_revisi	= $b->flag_revisi == "Y" ? "- <span class='label label-danger'>Perlu Revisi</span>" : "";
									         $stat_catatan	= !empty($b->catatan) ?  "- <a href='#catatan' data-toggle='modal' onclick='return load_catatan(" . $b->id . ");'><span class='label label-danger'>Lihat Catatan</span></a>" : "";
									
                              ?>
                           <tr>
                              <td class="ctr"><?php echo tgl_jam_sql($b->tgl_surat);?></td>
                              <td>
									<?=$no_surat."<br><b>Attachment : </b>".$filenya.""?><br>
									
									<?php if ($admin_level == "pimpinan" && $b->pemeriksa_user == $admin_id) { ?>
									<b>Format Surat : </b><a class="label label-info" href="<?php echo base_url() . 'surat/konsep_edit/' . $b->id . '/konsep';?>"><b>Lihat / Edit</b></a>
									<?php }else{ ?>
									<b>Format Surat : </b><a class="label label-info" href="<?php echo base_url() . 'surat/lihat_surat/' . $b->id . '/konsep';?>"><b>Lihat</b></a>
									<?php } ?>
									<br>
									 <?php if($admin_level !=='tata usaha'){ ?>
									   <b>Catatan Revisi:</b> <a href="#daftar_revisi" data-toggle="modal" class="label label-success" title="Lihat Catatan Revisi Surat" onclick="return getRevisiData('<?php echo $b->id;?>');"><i class="fa fa-pencil-square-o"> </i> Lihat</a>
									<?php } ?>
							  </td>
                              <td><?=$b->perihal."<br><b>Penerima : </b>".$b->penerima?></td>
                              <td>
								 
								 <?php
									$paraf_list = $this->db->query("SELECT IF(paraf_list IS NULL OR paraf_list = '','NULL',paraf_list) as paraf_list FROM surat_keluar WHERE id = $b->id")->row()->paraf_list;
									if($paraf_list === 'NULL'){
									   
									}else{
									   $paraf_list = substr($paraf_list, 0, -1);
									   
									   $arr_paraf_list = explode(",",$paraf_list);
									   
									   $c = count($arr_paraf_list);
									   $msg = null;
									   
									   for($i = 0;$i < $c;$i++){
										  $jabatan = $this->db->query("SELECT jabatan FROM pengguna WHERE id = $arr_paraf_list[$i]")->row()->jabatan;
										  $msg .=  "<span class='label label-success'>Paraf $jabatan</span><br>";										   
									   }									   

									   echo $msg;
									}
								 ?>
								 <?php echo $stat_setuju." - ".$stat_keluar . $stat_revisi . $stat_catatan;?>
								
							  </td>
                              <td class="ctr">
                                 <a href="#detil_surat" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Detil Data" onclick="return load_data(<?php echo $b->id; ?>);"><i class="fa fa-th-list"> </i> Detail</a>
                                 <?php 
                                    //echo var_dump($this->session->userdata);
                                    //echo $b->pemeriksa_user."-".$admin_id."-".$admin_level;
								 
								 if ($admin_id == $b->pemeriksa_user && $b->flag_setuju == "N" && $admin_level !== "pimpinan")
								 { ?>
									<?php
									   $id_dekan = $this->db->query("SELECT id FROM pengguna WHERE jabatan LIKE '%Dekan FKIP%'")->row()->id;
									   
									   $r = $this->db->query("SELECT id FROM pengguna
										 				      WHERE jabatan LIKE '%Wakil Dekan%'")->result();
									   
									   $arr_id_pimpinan  = array();
									   
									   foreach($r as $row){
										  $arr_id_pimpinan[] = $row->id;  
									   }
									?>
									
								 <?php if(in_array($admin_id,$arr_id_pimpinan)){ ?>
									<a href="#revisi" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Revisi Surat" onclick="setRevisiData('<?php echo $b->id;?>','<?php echo $b->pengirim_user;?>');return false"><i class="fa fa-pencil-square-o"> </i> Revisi</a>
									<!--<a href="<?php echo base_url() . 'surat/konsep/paraf/' . $b->id . '/' . $id_dekan; ?>" role="button" class="btn btn-success btn-sm" title="Paraf Surat"><i class="fa fa-sign-out"> </i> Paraf</a>-->
									<a href="#last-paraf" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Paraf Surat" onclick="setLastParaf('<?php echo $b->id;?>','<?php echo $id_dekan;?>')"><i class="fa fa-sign-out"> </i> Paraf</a>
								 <?php }else if($admin_level !== "tata usaha"){ ?>								 
									<a href="#revisi" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Revisi Surat" onclick="setRevisiData('<?php echo $b->id;?>','<?php echo $b->pengirim_user;?>');return false"><i class="fa fa-pencil-square-o"> </i> Revisi</a>
									<a href="#paraf" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Paraf Surat" onclick="setParafData('<?php echo $b->id;?>');return false"><i class="fa fa-sign-out"> </i> Paraf</a>
								 <?php }else{ ?>
									<?php
									   $paraf_list = $this->db->query("SELECT IF(paraf_list IS NULL OR paraf_list = '','NULL',paraf_list) as paraf_list
																	   FROM surat_keluar
																	   WHERE id = $b->id")->row()->paraf_list;
									   
									   $pemeriksa_user = "";
									   if($paraf_list === 'NULL'){
										  //jika NULL maka ambil dari revisi
										  $pemeriksa_user = $this->db->query("SELECT id_pengguna
																			  FROM surat_keluar_revisi
																			  WHERE id_surat = $b->id
																			  ORDER BY id ASC
																			  LIMIT 1")->row()->id_pengguna;
									   }else{
										  //jika ngga maka ambil dari paraf pertama
										  $paraf_list = substr($paraf_list, 0, -1);
									   
										  $arr_paraf_list = explode(",",$paraf_list);
										  $pemeriksa_user = $arr_paraf_list[0];
									   }
									   
									?>
									<a href="<?=base_URL().$admin_apps?>/konsep/edit/<?=$b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edt</a>
									<a href="#daftar_revisi" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Lihat Catatan Revisi Surat" onclick="return getRevisiData('<?php echo $b->id;?>');"><i class="fa fa-pencil-square-o"> </i> Baca Revisi</a>
									<a href="<?php echo base_URL().$admin_apps; ?>/konsep/" role="button" class="btn btn-success btn-sm" title="Lanjut" onclick="setAfterRevisi('<?php echo $b->id;?>','<?php echo $pemeriksa_user;?>');"><i class="fa fa-sign-out"> </i> Kirim</a>
								 <?php } ?>
									
									
								 <?php
								 } else if ($this->session->userdata('admin_level') === 'tata usaha')
								 { ?>						
									
									
									<a href="#unit" role="button" onclick="return setData('<?php echo $b->id; ?>');" data-toggle="modal" class="btn btn-success btn-sm" title="Kirim Surat"><i class="fa fa-sign-out"> </i> Kirim Surat</a>
									<?php 
                                 } else if ($admin_level == "pimpinan" && $b->pemeriksa_user == $admin_id)
								 {
                                  	if ($b->flag_setuju == "N")
									{
									   ?>
									   <a href="<?php echo base_URL().$admin_apps; ?>/konsep/setujui/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Setujui Konsep"><i class="fa fa-check"> </i> Setujui </a>
									   <?php
                                    }
                                    } else if ($admin_id == $b->pengirim_user && $b->flag_setuju == "N")
									{
									   ?>
									   <a href="<?php echo base_URL().$admin_apps; ?>/konsep/edit/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Konsep Surat"><i class="fa fa-edit"> </i> Edit Surat</a>
									   <?php
									}
                                    ?>
                              </td>
                           </tr>
                           <?php 
                              $no++;
                              }
                              }
                              ?>
                        </tbody>
                     </table>
                     <center>
                        <ul class="pagination"><?php echo $pagi; ?></ul>
                     </center>
                  </div>
                  <!-- /.table-responsive -->
               </div>
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

<!-- MODAL DETIL SURAT -->
<div class="modal col-lg-12 fade" id="detil_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Detil Surat</h4>
         </div>
         <div class="modal-body">
            <div id="detil_div"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
         </div>
         
      </div>
   </div>
</div>

<!-- MODAL REVISI -->
<div class="modal col-lg-12 fade" id="revisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form action="<?php echo base_url().$admin_apps; ?>/konsep/revisi" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Revisi Surat</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id_surat" id="id-surat-revisi">
			   <input type="hidden" name="pengirim_user" id="pengirim_user">	  
               <table width="100%" class="table-form" align="center">
                  <tr>
                     <td width="40%">Catatan</td>
                     <td><textarea name="revisi" id="revisi" required class="form-control col-lg-12" rows="6"></textarea></td>
                  </tr>
               </table>
            </div>
            <div class="modal-footer">
			   <?php if($admin_level !== "tata usaha"){ ?>
               <button type="submit" class="btn btn-primary">Lanjut</button>
			   <?php } ?>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- MODAL DAFTAR REVISI -->
<div class="modal col-lg-12 fade" id="daftar_revisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Daftar Revisi Surat</h4>
            </div>
            <div class="modal-body">
               <div id="table_daftar_revisi"></div>
            </div>
            <div class="modal-footer">			   
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>

      </div>
   </div>
</div>

<!-- MODAL LIHAT CATATAN -->

<div class="modal col-lg-12 fade" id="catatan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">         
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Catatan Surat</h4>
            </div>
            <div class="modal-body">              
               <table width="100%" class="table-form" align="center">
				  <tr>					 
                     <td><textarea id="textarea_catatan" class="form-control col-lg-12" rows="6" readonly></textarea></td>					 
				  </tr>
               </table>
            </div>
            <div class="modal-footer">               
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>         
      </div>
   </div>
</div>


<!-- MODAL PARAF -->

<div class="modal col-lg-12 fade" id="paraf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="form-paraf" action="<?php echo base_url() . 'surat/konsep/paraf';?>" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Paraf Surat</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id_surat" id="id-surat-paraf">
               <table width="100%" class="table-form" align="center">
                  <tr>
                     <td width="40%">Pemeriksa Lanjutan</td>
                     <td>						
						<select name="pemeriksa_user" id="pemeriksa_user" class="form-control col-lg-12"required>
						   <?php
							  $r = $this->db->query("SELECT * FROM pengguna WHERE jabatan LIKE '%Wakil Dekan%'");
							  foreach($r->result() as $row){
						   ?>						   
						   <option value="<?php echo $row->id;?>"><?php echo $row->nama . ' (' . $row->jabatan . ')';?></option>
						   <?php } ?>
						</select>
					 </td>
                  </tr>
				  <tr>
					 <td width="40%">Catatan</td>
                     <td><textarea name="catatan" class="form-control col-lg-12" rows="6"></textarea></td>					 
				  </tr>
               </table>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Lanjut</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>

<!-- MODAL LAST PARAF -->
<div class="modal col-lg-12 fade" id="last-paraf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form id="form-last-paraf" action="<?php echo base_url() . 'surat/konsep/paraf';?>" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Paraf Surat</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id_surat" id="id-surat-paraf-last">
			   <input type="hidden" name="pemeriksa_user" id="id-pemeriksa-user-last">
               <table width="100%" class="table-form" align="center">
				  <tr>
					 <td width="40%">Catatan</td>
                     <td><textarea name="catatan" class="form-control col-lg-12" rows="6"></textarea></td>					 
				  </tr>
               </table>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Lanjut</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>


<!-- MODAL KIRIM SURAT -->
<div class="modal col-lg-12 fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <form action="<?php echo base_url().$admin_apps; ?>/konsep/kirim" method="post">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Kirim Surat</h4>
            </div>
            <div class="modal-body">
               <input type="hidden" name="id_surat" id="id_surat">
               <table width="100%" class="table-form" align="center">
                  <tr>
                     <td width="40%">Nomor Agenda</td>
                     <td><input type="text" name="no_agenda" value="<?php echo gli("surat_keluar", "no_agenda", 5); ?>" class="form-control col-lg-12" required></td>
                  </tr>
                  <tr>
                     <td width="40%">Nomor Surat</td>
                     <td><input type="text" id="no_surat" name="no_surat" class="form-control col-lg-12" required autofocus></td>
                  </tr>
               </table>
            </div>
            <div class="modal-footer">
               <button type="submit" class="btn btn-primary">Simpan</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   
   function setLastParaf(id,pemeriksa_user) {
	  
	  $('#id-surat-paraf-last').val(id);
	  $('#id-pemeriksa-user-last').val(pemeriksa_user);
	  
   }
   function setParafData(id_surat){
	  
	  //alert(id_surat);
	  $("#id-surat-paraf").val(id_surat);
   }
   
   function setRevisiData(id_surat,pengirim_user){
	  
	  //alert(id_surat);
	  $("#pengirim_user").val(pengirim_user)
	  $("#id-surat-revisi").val(id_surat);
   }

   function setAfterRevisi(id_surat,pemeriksa_user) {
	  $.get("<?php echo base_URL(); ?>surat/konsep/udah_revisi?id_surat="+id_surat + "&pemeriksa_user=" + pemeriksa_user,
		 function(data,status){
			//location.reload();
		 }
	  );
   }
   
   function getRevisiData(id_surat) {
	  $.get("<?php echo base_URL(); ?>surat/konsep/get_revisi?id_surat="+id_surat,
		 function(data,status){
			//$("#detil_div").html('Loading...');
			//$("#detil_div").html(data);
			$('#table_daftar_revisi').html(data);
		 }
	  );
   }
   
   function load_catatan(id) {
	  $.get("<?php echo base_URL(); ?>surat/konsep/get_catatan?id=" + id, function(data,status){
		  $("#textarea_catatan").val(data);		  
	  });
   }
   
   function load_data(data1) {
	  $.get("<?php echo base_URL(); ?>surat/konsep/detil?id="+data1, function(data,status){
		  $("#detil_div").html('Loading...');
		  $("#detil_div").html(data);
	  });
   }
   
   function setData(data1) {
	  
	  $.get("<?php echo base_URL(); ?>surat/get_nomor_surat/" + data1,
		 function(data,status){
		   //$("#detil_div").html('Loading...');
		   //$("#detil_div").html(data);
		   $("#no_surat").val(data);   
	  });
	  
	  $("#id_surat").val(data1);
	  
   }
   
</script>