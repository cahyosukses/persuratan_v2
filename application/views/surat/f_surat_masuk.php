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
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Surat Masuk</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<form action="<?=base_URL().$admin_apps?>/surat_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				
				<div class="col-lg-6">
					<table  class="table-form">
					<tr><td width="25%">No. Agenda</td><td><input type="text" name="no_agenda" required value="<?php echo gli3("surat_masuk", "no_agenda", 6, "WHERE flag_del = 'Y'"); ?>"class="form-control col-lg-3" tabindex="1"></td></tr>
					<tr><td>Tanggal Surat</td><td><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" class="form-control col-lg-5 tag_tgl" tabindex="2"></td></tr>	
					<tr><td>Pengirim</td><td><input type="text" name="pengirim" required value="<?php echo $pengirim; ?>" id="pengirim" class="form-control col-lg-12" tabindex="3"></td></tr>		
					<tr><td>Nomor Surat</td><td><input type="text" name="nomor" required value="<?php echo $nomor; ?>" class="form-control col-lg-12" tabindex="4"></td></tr>	
					<tr><td colspan="2">
					</td></tr>
					</table>
				</div>
				
				<div class="col-lg-6">	
					<table  class="table-form">
					<tr><td width="30%">Penerima</td><td><select name="penerima" class="form-control col-lg-12" required tabindex="5"><?php echo select_unit_val($penerima); ?></select></td></tr>	
					<!--<tr><td>Tembusan</td><td><select name="tembusan" class="form-control col-lg-12" required tabindex="6"><?php echo select_unit(); ?></select></td></tr>-->
					<tr><td>Perihal surat</td><td><input type="text" name="perihal" required value="<?php echo $perihal; ?>" id="perihal" class="form-control col-lg-12" tabindex="7"></td></tr>	
					<tr><td>File Berkas (Scan)</td><td>
					<input type="file" name="file_surat" class="form-control col-lg-4" tabindex="8">
					<div class="col-lg-3" style="margin-top: 8px">Kecepatan</div>
					<select name="kecepatan" class="form-control col-lg-5" tabindex="9"><?php echo select_array($pil_kecepatan, $pil_kecepatan); ?></select>
					</td></tr>
					
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/surat_masuk" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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