<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Upload Gambar Tanda Tangan</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			<?php foreach($rs_pengguna->result() as $pengguna){}; ?>
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
                
                <?php if(isset($msg)):?>
                <div id="alert" class="alert alert-danger"><?php echo $msg;?></div>
                <?php endif;?>
                  
				<form action="<?=base_URL();?>dashboard/upload_ttd" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="col-lg-12">
					<table width="100%" class="table-form">
					<tr>
                      <td width="20%">Gambar</td>
                      <td>
                        <img src="<?php echo base_url() . 'ttd_img/' . $pengguna->ttd_image;?>" class="" style="width: 120px; height: 120px">
                      </td>
                    </tr>
                    
					<input name="hidden_input" value="hidden_val" type="hidden">
                           
					<tr><td width="20%">File TTD</td><td><input type="file" name="ttd_image"  style="width: 300px" class="form-control" tabindex="3"></td></tr>	
					<tr><td colspan="2">
					<br>
					<button type="submit" class="btn btn-primary" tabindex="4"><i class="fa fa-hdd-o"> </i> Simpan</button>
					<a href="<?=base_URL()?>" class="btn btn-success" tabindex="5"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
					</td></tr>
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
