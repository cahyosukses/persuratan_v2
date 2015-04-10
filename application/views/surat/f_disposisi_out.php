<?php
$pil_kecepatan	= array('sangat segera', 'segera', 'biasa');
$mode			= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act			= "act_edt";
	$idp			= $datpil->id;
	$tgl_diterima	= $datpil->tgl_diterima;
	$tgl_surat		= $datpil->tgl_surat;
	$pengirim		= $datpil->pengirim;
	$nomor			= $datpil->nomor;
	$no_agenda		= $datpil->no_agenda;
	$penerima		= $datpil->penerima;
	$tembusan		= $datpil->tembusan;
	$perihal		= $datpil->perihal;
	$kecepatan		= $datpil->kecepatan;
	
} else {
	$act			= "act_add";
	$idp			= "";
	$tgl_diterima	= "";
	$tgl_surat		= "";
	$pengirim		= "";
	$nomor			= "";
	$no_agenda		= "";
	$penerima		= "";
	$tembusan		= "";
	$perihal		= "";
	$kecepatan		= "";
}
?>
<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Disposisi Surat</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<form action="<?=base_URL().$admin_apps?>/disposisi_out/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				
				<div class="col-lg-6">
					<table  class="table-form">
					<tr><td>Tanggal Surat</td><td><b></b></td></tr>	
					
					</table>
				</div>
				
				<div class="col-lg-6">	
					<table  class="table-form">
					<tr><td width="30%">Penerima</td><td><select name="penerima" class="form-control col-lg-12" required tabindex="5"><?php echo select_unit(); ?></select></td></tr>	
					<tr><td>Tembusan</td><td><select name="tembusan" class="form-control col-lg-12" required tabindex="6"><?php echo select_unit(); ?></select></td></tr>	
					<tr><td>Perihal surat</td><td><b><input type="text" name="perihal" required value="<?php echo $perihal; ?>" id="perihal" class="form-control col-lg-12" tabindex="7"></b></td></tr>	
					<tr><td>File Berkas (Scan)</td><td>
					<input type="file" name="file_surat" class="form-control col-lg-4" tabindex="8">
					<div class="col-lg-3" style="margin-top: 8px">Kecepatan</div>
					<select name="kecepatan" class="form-control col-lg-5" tabindex="9"><?php echo select_array($pil_kecepatan, $pil_kecepatan); ?></select>
					</td></tr>
					
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/disposisi_keluar" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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