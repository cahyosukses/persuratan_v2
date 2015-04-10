<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Disposisi Keluar</b>
				</div>
				<ul class="nav navbar-nav">
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/surat_masuk/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
						</form>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<?php echo $this->session->flashdata("k");?>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="22%">Tujuan</th>
						<th width="15%">Intruksi, Kecepatan</th>
						<th width="13%">Tanggal Selesai</th>
						<th width="20%">Isi Disposisi</th>
						<th width="15%">Status Disposisi</th>
						<th width="15%">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					if (empty($data)) {
						echo "<tr><td colspan='6' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td></tr>";
					} else {
						$no 	= ($this->uri->segment(4) + 1);
						foreach ($data as $b) {
						$dibaca_flag	= $b->flag_read == "Y" ? "<div class='label label-success'>Yes</div>" : "<div class='label label-warning'>No</div>";
						$ditolak_flag	= $b->flag_tolak == "Y" ? "<div class='label label-danger' title='".$b->alasan."'>Yes</div>" : "<label class='label label-success'>No</label>";
						$lanjut_flag	= $b->flag_lanjut == "Y" ? "<div class='label label-success'>Sudah</div>" : "<label class='label label-warning'>Belum</label>";
						
					?>
					<tr>
						<td><?php echo $b->nama_user." (".$b->level.")<br>".$b->tujuan;?></td>
						<td><?php echo $b->intruksi."<br>".$b->kecepatan;?></td>
						<td class="ctr"><?php echo tgl_jam_sql($b->tgl_end);?></td>
						<td><?php echo $b->isi_disposisi;?></td>
						<td><?php echo "Dibaca : ".$dibaca_flag."<br>Ditolak : ".$ditolak_flag."<br>Ditindaklanjuti : ".$lanjut_flag;?></td>
						
						<td class="ctr">
							<div class="btn-group">
								<?php 
								if ($b->flag_lanjut == "Y") {
									$file_		= gval("disposisi_tanggapan", "id_disposisi", "file", $b->id);
									
									$filenya	= empty($file_) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/disposisi_tanggapan/".$file_."' target='_blank'><b>Download / Lihat</b></a>";
									
									$data_tanggapan	= gval("disposisi_tanggapan", "id_disposisi", "catatan", $b->id);
									
									if (!empty($file_)) {
								?>
									<a href="#unit" rel="tooltip" role="button" data-toggle="modal" onclick="return setData('<?php echo gval("disposisi_tanggapan", "id_disposisi", "catatan", $b->id); ?>', '<?php echo $filenya; ?>');" class="btn btn-success btn-sm" title="(i) Klik Disini, untuk melihat detil laporan disposisi ..."><i class="fa fa-hand-o-right">  </i> Sudah dilaporkan</a>
								<?php 
									} else { 
								?>
									<a href="#" class="btn btn-success btn-sm"><i class="fa fa-hand-o-right">  </i> Sudah dilaporkan</a>
								<?php 
									}
								}else { ?>
									<a href="#" class="btn btn-warning btn-sm" title="Belum"><i class="fa fa-hand-o-right">  </i> Belum ditindaklanjuti</a>
								<?php } ?>
							</div>	
						</td>
					</tr>
					<?php 
						$no++;
						}
					}
					?>
				</tbody>
			</table>
		<center><ul class="pagination"><?php echo $pagi; ?></ul></center>
	</div>
						<!-- /.table-responsive -->
					</div>
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

<div class="modal col-lg-12 fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Detil Laporan</h4>
			</div>
			<div class="modal-body">
				<table width="100%" class="table-form" align="center">
					<tr><td width="40%">Isi Laporan</td><td><div id="data1"></td></tr>
					<tr><td width="40%">File Attachment</td><td><a id="data2" class="btn btn-success" href="#" target="_blank"><i class="fa fa-download"> </i> View/Download</a></td></tr>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
function setData(data1, data2) {
	$("#data1").html(data1);
	$("#data2").prop('href', data2);
}
</script>