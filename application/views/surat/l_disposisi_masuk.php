<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Disposisi Masuk</b>
				</div>
				<ul class="nav navbar-nav">
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/disposisi_masuk/cari">
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
						<th width="32%">Asal Disposisi, <i>Isi Disposisi</i></th>
						<th width="25%">Intruksi<br>Perihal Surat</th>
						<th width="18%">Kecepatan<br>Dateline</th>
						<th width="25%">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					if (empty($data)) {
						echo "<tr><td colspan='6' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td></tr>";
					} else {
						$no 	= ($this->uri->segment(4) + 1);
						foreach ($data as $b) {
					?>
					<tr>
						<td><?php echo $b->nama_user." (".$b->level.")<br>".$b->tujuan."<br><b>Catatan : </b><i>".$b->isi_disposisi."</i>";?></td>
						<td><?php echo $b->intruksi."<br><b>Perihal : </b><i>".$b->perihal_surat."</i><br><a href='".base_URL()."upload/surat_masuk/".$b->file_surat."' target='_blank' class='label label-success'>File attachment</a>";?></td>
						<td><?php echo $b->kecepatan."<br><i>".tgl_jam_sql($b->tgl_end)."</i>";?></td>
						
						<td class="ctr">
							<div class="btn-group">
								<?php 
								if ($b->flag_lanjut == "Y") {
								?>
									<a href="<?php echo base_URL()."upload/disposisi_tanggapan/".gval("disposisi_tanggapan", "id_disposisi", "file", $b->id);?>" target="_blank" class="btn btn-success btn-sm" title="OK"><i class="fa fa-hand-o-right">  </i> Sudah ditindaklanjuti</a>
								<?php } else { ?>
									<a href="<?=base_URL().$admin_apps?>/disposisi_keluar/add/<?=$b->id?>/disposisi" class="btn btn-info btn-sm" title="Disposisi"><i class="fa fa-hand-o-right">  </i> Disposisi</a>
									<a href="<?=base_URL().$admin_apps?>/disposisi_tanggapan/add/<?=$b->id?>" class="btn btn-success btn-sm" title="Tanggapi"><i class="fa fa-edit"> </i> Tanggapi</a>
									<a href="#unit" role="button" onclick="return setData('<?php echo $b->id."', '".$b->id_rel; ?>');" data-toggle="modal"  class="btn btn-danger btn-sm" title="Tolak"><i class="fa fa-minus-circle"> </i> Tolak</a>
								<?php } ?>
								<!--<a href="<?=base_URL()?>apps/surat_masuk/del/<?=$b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="fa fa-times">  </i> Del</a>-->
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

<!-- MODAL TOLAK DISPOSISI -->
<div class="modal col-lg-12 fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?php echo base_url().$admin_apps; ?>/disposisi_tanggapan/tolak" method="post">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Tolak Disposisi</h4>
			</div>
			<div class="modal-body">
				<input type="hidden" name="id_disposisi" id="id_disposisi">
				<input type="hidden" name="id_surat" id="id_surat">
				<table width="100%" class="table-form" align="center">
					<tr><td width="40%">Alasan ditolak</td>
					<td><textarea name="alasan_tolak" class="form-control col-lg-12" autofocus style="height: 60px"></textarea></td></tr>

				</table>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
function setData(data1, data2) {
	$("#id_disposisi").val(data1);
	$("#id_surat").val(data2);
}
</script>
