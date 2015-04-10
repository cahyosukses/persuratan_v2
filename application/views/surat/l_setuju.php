<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Setujui Surat</b>
				</div>
				<ul class="nav navbar-nav">
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/surat_keluar/cari">
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
						<th width="10%">Tanggal</th>
						<th width="27%">Nomor Surat, File</th>
						<th width="25%">Perihal<br>Penerima</th>
						<th width="21%">Status</th>
						<th width="17%">Aksi</th>
					</tr>
				</thead>
				
				<tbody>
					<?php 
					if (empty($data)) {
						echo "<tr><td colspan='5' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td></tr>";
					} else {
						$no 	= ($this->uri->segment(4) + 1);
						foreach ($data as $b) {
							$filenya	= empty($b->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$b->file."' target='_blank'><b>Download / Lihat</b></a>";
							
							$no_agenda	= empty($b->no_agenda) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $b->no_agenda;
							$no_surat	= empty($b->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $b->no_surat;
							
							$stat_setuju	= $b->flag_setuju == "N" ? "<span class='label label-danger'>Belum diperiksa</span>" : "<span class='label label-success'>Sudah diperiksa dan setuju</span>";
							$stat_keluar	= $b->flag_keluar == "N" ? "<span class='label label-danger'>Belum dikirim</span>" : "<span class='label label-success'>Sudah dikirim</span>";
					?>
					<tr>
						<td class="ctr"><?php echo tgl_jam_sql($b->tgl_surat);?></td>
						<td><?=$no_surat."<br><b>File : </b>".$filenya.""?></td>
						<td><?=$b->perihal."<br><b>Penerima : </b>".$b->penerima?></td>
						<td><?php echo $stat_setuju." - ".$stat_keluar; ?></td>
						
						<td class="ctr">
							<?php 
							if ($this->session->userdata('admin_level') == 'pimpinan' && $b->penerima_user == $admin_id) {
							?>
							<a href="<?php echo base_URL().$admin_apps; ?>/konsep/setujui/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Kirim Surat"><i class="fa fa-check"> </i> Setujui </a>
							<?php } else { ?>
							<a href="" role="button" onclick="#" data-toggle="modal" class="btn btn-success btn-sm" title="Detil Konsep Surat"><i class="fa fa-th-list"> </i> Detil Konsep</a>
							<?php } ?>
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