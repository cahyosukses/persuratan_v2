<?php 
$pil_app		= array('instansi','aset','surat');
$mode			= $this->uri->segment(3);

if ($mode == "add") {
	$idp				= "";
	$act				= "aksi_tambah";
	$judul				= "";
	$nama_lbg			= "";
	$alamat				= "";
	$notelp				= "";
	$kdpos				= "";
	$nofax				= "";
	$tmp_lbg			= "";
	$site				= "";
	$email				= "";
	$logo				= "";
	$tglinput			= "";
	$userid				= "";

} else if ($mode == "edit") {
	$idp				= $data->id;
	$act				= "aksi_edit";
	$judul				= $data->judul;
	$nama_lbg			= $data->nama_lbg;
	$alamat				= $data->alamat;
	$notelp				= $data->notelp;
	$kdpos				= $data->kdpos;
	$nofax				= $data->nofax;
	$tmp_lbg			= $data->tmp_lbg;
	$site				= $data->site;
	$email				= $data->email;
	$logo				= $data->logo;
	$tglinput			= $data->tglinput;
	$userid				= $data->userid;

}

?>
<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Kop Surat</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">

				<?php echo $this->session->flashdata("k_passwod");?>

				<form action="<?=base_URL().$admin_apps?>/kop_surat/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				<div class="col-lg-12">
					<table width="100%" class="table-form" align="center">
						<tr><td width="25%">Judul Kop</td><td><input type="text" name="judul" value="<?php echo $judul; ?>" class="form-control col-lg-6" required></td></tr>
						<tr><td>Nama Lembaga</td><td><textarea name="nama_lbg" class="form-control col-lg-8" style="height: 50px" ><?php echo $nama_lbg; ?></textarea></td></tr>
						<tr><td>Alamat</td><td><input type="text" name="alamat" value="<?php echo $alamat; ?>" class="form-control col-lg-8" required></td></tr>
						<tr><td>No. Telp</td><td><input type="text" name="notelp" value="<?php echo $notelp; ?>" class="form-control col-lg-5" required></td></tr>
						<tr><td>No. Fax</td><td><input type="text" name="nofax" value="<?php echo $nofax; ?>" class="form-control col-lg-5" required></td></tr>
						<tr><td>Kode Pos</td><td><input type="text" name="kdpos" value="<?php echo $kdpos; ?>" class="form-control col-lg-5" required></td></tr>
						<tr><td>Tempat Lembaga</td><td><input type="text" name="tmp_lbg" value="<?php echo $tmp_lbg; ?>" class="form-control col-lg-8" required></td></tr>
						<tr><td>Website</td><td><input type="text" name="site" value="<?php echo $site; ?>" class="form-control col-lg-6" required></td></tr>
						<tr><td>Email</td><td><input type="text" name="email" value="<?php echo $email; ?>" class="form-control col-lg-6" required></td></tr>
						<tr><td>Logo</td><td><input type="file" name="file_logo" value="<?php echo $logo; ?>" class="form-control col-lg-6"></td></tr>
						
						
						<tr><td colspan="2">
						<button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"> </i> Simpan</button>
						<a href="<?=base_URL().$admin_apps?>/kop_surat" class="btn btn-success"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
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