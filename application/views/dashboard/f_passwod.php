<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Rubah Password</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">

				<?php echo $this->session->flashdata("k_passwod");?>
	
				<form action="<?=base_URL()?>dashboard/passwod/simpan" method="post" accept-charset="utf-8" enctype="multipart/form-data">	
					<table class="table-form" width="100%">
					<tr><td width="20%">Username</td><td><b><input type="text" name="username" class="form-control" readonly value="<?=$this->session->userdata('admin_user')?>" style="width: 200px"></b></td></tr>
					<tr><td>Nama User</td><td><input type="text" name="nama" value="<?php echo gval("pengguna", "id", "nama", $this->session->userdata('admin_id')); ?>" class="form-control" style="width: 200px" required> &nbsp;&nbsp;
					<!--<label><input type="checkbox" id="passwod_ubah" value="1" onclick="return ubah_password_juga();"> Ubah password juga ..?</label>-->
					</td></tr>
					<tr><td>Password lama</td><td><input type="password" name="p1" id="p1" class="form-control" style="width: 200px" required></td></tr>		
					<tr><td>Password baru</td><td><input type="password" name="p2" id="p2" class="form-control" style="width: 200px" required></td></tr>		
					<tr><td>Ulangi Password baru</td><td><input type="password" class="form-control" name="p3" id="p3" style="width: 200px" required></td></tr>		
					
					<tr><td colspan="2">
					<br>
					<button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"> </i> Simpan</button>
					<a href="<?=base_URL()?>" class="btn btn-success"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
					</td></tr>
					</table>
					</fieldset>
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