<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Tanggapan Disposisi</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<form action="<?=base_URL().$admin_apps?>/disposisi_tanggapan/simpan" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="">
				<input type="hidden" name="id_disposisi" value="<?php echo $data->id; ?>">
				
				<div class="col-lg-12">
					<table  class="table-form">
					<tr><td width="25%">Tujuan</td><td><?php echo $data->nama_pengguna." (".$data->level_pengguna.") ---| ".$data->nama_unit; ?></td></tr>
					<tr><td>Catatan</td><td><textarea name="catatan" class="form-control col-lg-6" tabindex="1"></textarea></b></td></tr>	
					<tr><td>File Attachment</td><td>
					<input type="file" name="file_tanggapan_disposisi" class="form-control col-lg-4" tabindex="2">
					</td></tr>
					
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary" tabindex="3"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/disposisi_masuk" class="btn btn-success" tabindex="4"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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

