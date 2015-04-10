<?php
$pil_kecepatan	= array('sangat segera', 'segera', 'biasa');
$pil_intruksi	= array('Ditindaklanjuti', 'Ditanggapi tertulis', 'Disiapkan makalah/sambutan/presentasi sesuai tema', 'Koordinasikan dengan', 'Diwakili & laporkan hasilnya', 'Dihadiri & dilaporkan hasilnya', 'Disiapkan surat/memo dinas (internal)', 'File');


$filenya	= empty($detil_data->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<b><a href='".base_URL()."upload/surat_masuk/".$detil_data->file."' target='_blank'><i class='fa fa-download'></i> Download / Lihat</a></b>";

$mode			= $this->uri->segment(3);
$id_data		= $this->uri->segment(4);
$asal			= $this->uri->segment(5);

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
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Disposisi</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<div class="col-lg-3" style="height: 350px; overflow: auto">
					<div class="alert alert-info"><b>Riwayat Surat</b></div>
					<table  class="table table-bordered">
						<thead>
							<tr>
								<th width="25%">Tgl. Surat, Tgl Diterima</th>
								<th width="25%">Pengirim, No. Surat</th>
								<th width="25%">Perihal, File</th>
								<th width="25%">No. Agd, Kecepatan</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo tgl_jam_sql($detil_surat->tgl_surat);?><br>
								<?php echo tgl_jam_sql($detil_surat->tgl_diterima);?></td>	
								<td><?php echo $detil_surat->pengirim;?><br>
								<?php echo $detil_surat->nomor;?></td>
								<td><?php echo $detil_surat->perihal;?><br>
								<?php echo $filenya; ?></td>
								<td><?php echo $detil_surat->no_agenda;?><br>
								<?php echo $detil_surat->kecepatan;?></td>
							</tr>
						</tbody>
					</table>
					<div class="alert alert-info"><b>Riwayat Disposisi</b></div>
					<table  class="table table-bordered">
						<thead>
							<tr>
								<th width="5%">No</th>
								<th width="20%">Pemberi Disp</th>
								<th width="25%">Penerima Disp</th>
								<th width="25%">Intruksi</th>
								<th width="25%">Kecepatan</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if (!empty($riwayat_disp)) {
								foreach($riwayat_disp as $r) {
							?>
							<tr>
								<td class="ctr"><?php echo $r->disp_ke;?></td>	
								<td><?php echo $r->pemberi_nama_unit;?><br>
								<?php echo "(".$r->pemberi_level.") ".$r->pemberi_nama;?></td>
								<td><?php echo $r->penerima_nama_unit;?><br>
								<?php echo "(".$r->penerima_level.") ".$r->penerima_nama;?></td>
								<td><?php echo $r->intruksi;?><br>
								<?php echo $r->isi_disposisi;?></td>
								<td><?php echo $r->kecepatan;?><br>
								<?php echo tgl_jam_sql($r->tgl_end);?></td>
							</tr>
							<?php }
							} else {
								echo "<tr><td colspan='5' style='text-align: center; font-weight: bold'>-Belum ada-</td></tr>";
							}
							?>							
						</tbody>
					</table>
				</div>
				
				<form action="<?=base_URL().$admin_apps?>/disposisi_keluar/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="<?php echo $id_data; ?>">
				<input type="hidden" name="id_data" value="<?php echo $id_data; ?>">
				<input type="hidden" name="id_surat" value="<?php echo $detil_surat->id; ?>">
				<input type="hidden" name="asal" value="<?php echo $asal; ?>">
				
				<div class="col-lg-9">	
					<div class="alert alert-info"><b>Data Disposisi <?php echo $admin_id_unit; ?></b></div>
					<table  class="table-form">
					<tr>
						<td width="20%">Penerima</td>
						<td>
							<select name="penerima" id="penerima" class="form-control col-lg-6" required tabindex="1" autofocus><?php echo select_unit_aktif($admin_id_unit); ?></select> 
					
							<div class="col-lg-2" style="margin-top: 10px">User</div>
							<select name="user" id="user" class="form-control col-lg-4" required tabindex="1">
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
					
					<tr><td>Intruksi</td><td><select name="intruksi" class="form-control col-lg-12" tabindex="9"><?php echo select_array($pil_intruksi, $pil_intruksi); ?></select></td></tr>	
					<tr><td>Isi Disposisi</td><td><textarea name="isi_disposisi" class="form-control col-lg-12" tabindex="2" style="height: 70px"></textarea></td></tr>	
					<tr><td>Kecepatan</td><td>
					<select name="kecepatan" class="form-control col-lg-5" tabindex="9"><?php echo select_array($pil_kecepatan, $pil_kecepatan); ?></select>
					<div class="col-lg-3" style="margin-top: 7px">Tgl Selesai</div>
					<input type="text" name="tgl_selesai" required value="<?php //echo $intruksi; ?>" class="form-control col-lg-4 tag_tgl" tabindex="2"></td></tr>	
					</table>	
				</div>
				
				<div class="col-lg-12" style="margin-top: 20px; margin-bottom: 20px">
					<button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
					<a href="<?=base_URL().$admin_apps?>/disposisi_masuk" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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
$("#user").chained("#penerima");
</script>