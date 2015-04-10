<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Instansi Pengguna</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">

				<?php echo $this->session->flashdata("k_passwod");?>

				<form action="<?=base_URL().$admin_apps?>/setting_header/act_edt" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				
				<input type="hidden" name="idp" value="<?php echo $id = empty($data->id) ? "" : $data->id; ?>">
				<div class="col-lg-12">
					<table width="100%" class="table-form">
					<tr><td width="20%">Nama</td><td><input type="text" name="nama" required value="<?php echo $nama = empty($data->nama) ? "" : $data->nama; ?>" style="width: 400px" class="form-control" tabindex="1" autofocus></td></tr>
					<tr><td width="20%">Alamat Instansi</td><td><textarea name="alamat" style="width: 400px; height: 90px" class="form-control" tabindex="2"><?php echo $alamat = empty($data->alamat) ? "" : $data->alamat; ?></textarea></td></tr>	
					<tr><td width="20%">File Logo</td><td><input type="file" name="logo"  style="width: 300px" class="form-control" tabindex="3"></td></tr>	
					<tr><td width="20%">File Logo Background</td><td><input type="file" name="background_logo"  style="width: 300px" class="form-control" tabindex="4"></td></tr>	
					<tr><td width="20%">File Logo Login</td><td><input type="file" name="login_logo_header"  style="width: 300px" class="form-control" tabindex="4"></td></tr>	

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
