<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Status Kehadiran</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
            <?php foreach($rs_kehadiran->result() as $kehadiran){} ?>
            
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-6">
				
				<?php if(isset($msg)):?>
                <div id="alert" class="alert alert-danger"><?php echo $msg;?></div>
                <?php endif;?>

				

				
				<form action="<?=base_URL()?>dashboard/status_kehadiran" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
					<table class="table-form" style="width: 489px;" border="0" cellspacing="0" cellpadding="0">
						<colgroup>
							 <col width="102" />
							 <col width="130" />
							 <col width="64" />
							 <col width="193" />
						</colgroup>
						<tbody>
						   <tr>
							  <td class="xl65" width="102">&nbsp;Status</td>
							  <td class="xl65" width="130">
								 <label onclick="" class="switch-toggle well">
									 <input id="hadir" name="kehadiran_status" value="hadir" type="radio" <?php echo $kehadiran->kehadiran_status === 'hadir' ? 'checked':'';?>>
									 <label for="hadir" onclick="">Hadir</label>
		 
									 <input id="keluar" name="kehadiran_status" value="keluar" type="radio" <?php echo $kehadiran->kehadiran_status === 'keluar' ? 'checked':'';?>>
									 <label for="keluar" onclick="">Keluar</label>
									 <a class="btn btn-primary"></a>
								 </label>							
							  </td>
							  <td class="xl65" width="64">&nbsp;</td>
							  <td class="xl65" width="193">&nbsp;</td>
						   </tr>
						   <tr>
							  <td class="xl65">&nbsp;Keterangan</td>
							  <td class="xl66" colspan="3">&nbsp;							
								 <input type="text" tabindex="2" class="form-control col-lg-12" id="kehadiran_keterangan" value="<?php echo $kehadiran->kehadiran_keterangan;?>" required="" name="kehadiran_keterangan">
							  </td>
						   </tr>						   
						   <tr>							
							  <td colspan="2">
								<br>
								<button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"> </i> Simpan</button>
								<a href="<?=base_URL()?>" class="btn btn-success"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
							  </td>
							  <td></td>
							  <td></td>
						   </tr>
						</tbody>
					 </table>
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
function ubah_password_juga() {
	var ok = $("#passwod_ubah").val();
	
	if (ok == "1") {
		alert('ok');
		$("#p1").attr("required");
		$("#p2").attr("required");
		$("#p3").attr("required");
		$("#p1").attr("readonly");
		$("#p2").attr("readonly");
		$("#p3").attr("readonly");
	} else {
		alert('tidak ok');
		$("#p1").removeAttr("required");
		$("#p2").removeAttr("required");
		$("#p3").removeAttr("required");
		$("#p1").removeAttr("readonly");
		$("#p2").removeAttr("readonly");
		$("#p3").removeAttr("readonly");
	}
}
</script>