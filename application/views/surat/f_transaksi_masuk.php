<?php
$pil_trans	= 	array(
				'100' => 'Saldo Awal',
				'101' => 'Pembelian',
				'102' => 'Transfer Masuk',
				'103' => 'Hibah Masuk',
				'107' => 'Reklasifikasi Masuk',
				'301' => 'Penghapusan',
				'302' => 'Transfer Keluar',
				'303' => 'Hibah Keluar',
				'304' => 'Reklasifikasi Keluar'
			);
$pil_jendok	= 	array(
				'1' => 'Faktur',
				'2' => 'Kuitansi',
				'3' => 'Berita Acara Serah Terima',
				'4' => 'Lainnya'
			);
$mode			= $this->uri->segment(3);

if ($mode == "edt" || $mode == "act_edt") {
	$act			= "act_edt";
	$idp			= $datpil->id;
	$no_bukti		= $datpil->no_bukti;
	$tgl_bukti		= $datpil->tgl_bukti;
	$jenis_trans	= $datpil->jenis_trans;
	$jenis_bukti	= $datpil->jenis_bukti;
	$ket			= $datpil->ket;
	
} else {
	$act			= "act_add";
	$idp			= "";
	$no_bukti		= "";
	$tgl_bukti		= "";
	$jenis_trans	= "";
	$jenis_bukti	= "";
	$ket			= "";
}
?>
<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Transaksi Masuk</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<form action="<?=base_URL().$admin_apps?>/transaksi_masuk/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="<?php echo $idp; ?>">
				
				<div class="col-lg-6">
					<table  class="table-form">
						<tr><td width="25%">Jenis Transaksi</td><td>
							<?php 
							$prop1	= "class='form-control col-lg-6' required autofocus tabindex='1'";
							echo form_dropdown('jenis_trans', $pil_trans, $jenis_trans, $prop1);
							?>
						</td></tr>
					
					</table>
				</div>
				
				<div class="col-lg-6">	
					<table  class="table-form">
					
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px">
					<button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/transaksi_masuk" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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