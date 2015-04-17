<?php 
	
	$mode			= $this->uri->segment(3);
	$id             = $this->uri->segment(4);

	if ($mode == "edit" || $mode == "act_edt") {

		$tgl_kirim     = $datdet->tgl_kirim;
		$penerima      = $datdet->penerima;      
		$penerima_user = $datdet->penerima_user;
		$perihal       = $datdet->perihal;
		$catatan       = $datdet->catatan;
		
		$act           = "act_edt/" . $id;
	}else{

		$tgl_kirim     = "";
		$penerima      = "";
		$penerima_user = "";
		$perihal       = "";
		$catatan       = "";
		$act           = "act_add";
	}	
?>

<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Pelaporan</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<form action="<?=base_URL().$admin_apps . '/pelaporan/' . $act;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				
				<div class="col-lg-12">
					<table  class="table-form">
					<tr>
                       <td>Tanggal Pelaporan</td>
                       <td><input type="text" name="tgl_kirim" required id="tgl_kirim" class="form-control col-lg-4 tag_tgl" value="<?php echo $tgl_kirim;?>" tabindex="1" <?php echo $mode === 'act_add' ? 'autofocus' : ''?>></td>
                	</tr>
					<tr>
                        <td width="30%">Organisasi</td>
                           <td>
                              <select name="penerima" id="penerima" class="form-control col-lg-6" tabindex="5" ><?php echo select_unit(); ?></select> 
                           </td>
                        </tr>
                        
                        <tr>
                           <td width="30%">Penerima</td>
                           <td>
                              <select name="penerima_user" id="penerima_user" class="form-control col-lg-6 pull-left" style="left: 0; right: auto;" tabindex="6">
                              <?php 
                                 if (!empty($user)) {
                                    foreach ($user as $u) {
                                      
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
						<td>Perihal</td>
						<td><input type="textbox" name="perihal" class="form-control col-lg-6" value="<?php echo $perihal;?>" tabindex="1"></td>
					</tr>	
					<tr><td>Catatan</td><td><textarea name="catatan" class="form-control col-lg-6" rows="5" tabindex="1"><?php echo $catatan;?></textarea></b></td></tr>	
					<tr><td>File Attachment</td><td>
					<input type="file" name="file_pelaporan" class="form-control col-lg-4" tabindex="2">
					</td></tr>
					
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary" tabindex="3"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/pelaporan" class="btn btn-success" tabindex="4"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
		$('select[name="penerima"]').find('option[value="<?=$penerima ;?>"]').attr("selected", true);
		$("#penerima_user").chained("#penerima");
		$('select[name="penerima_user"]').find('option[value="<?=$penerima_user ;?>"]').attr("selected", true);		
	});
  <?php }else{ ?>
	$("#penerima_user").chained("#penerima");
  <?php } ?>	
</script>

