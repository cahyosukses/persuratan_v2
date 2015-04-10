<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Surat Masuk <?=$this->session->userdata('admin_level')?></b>
				</div>
				<?php
				$level = $this->session->userdata('admin_level');
				if ($level === "tata usaha") {
				?>
				
				<?php if (empty($data)) { ?>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL().$admin_apps; ?>/surat_masuk/add" class="btn-info"><i class="fa fa-plus-circle fa-fw"> </i> Tambah Data</a></li>
					<li><a href="<?php echo base_URL().$admin_apps.'/'; ?>export_data/surat_masuk/all" class="btn-success"><i class="fa fa-mail-forward fa-fw"> </i> Export Data</a></li>
				</ul>
				<?php }else{ ?>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL().$admin_apps; ?>/surat_masuk/add" class="btn-info"><i class="fa fa-plus-circle fa-fw"> </i> Tambah Data</a></li>
				</ul>
				<?php } ?>
				<?php } ?>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/surat_masuk/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
							<a href="<?php echo base_url() . $admin_apps . '/surat_masuk';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
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
										<th width="10%">Tgl. Terima</th>
										<th width="15%">Nomor Surat (Tgl. Surat), File</th>
										<th width="20%">Perihal</th>
										<th width="20%">Pengirim, Penerima</th>
										<th width="7%">Dibaca</th>
										<th width="8%">Ditindaklanjuti</th>
										<?php if($this->session->userdata('admin_level') !== "pimpinan"){ ?>
										<th width="8%">Status</th>
										<?php } ?>
										<th width="20%">Aksi</th>
									</tr>
								</thead>
								
								<tbody>
									<?php 
									if (empty($data)) {
										echo "<tr><td colspan='8' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td></tr>";
									} else {
										$no 	= ($this->uri->segment(4) + 1);
										foreach ($data as $b) {
											// hanya jika penerima yang baca, maka update read status
											$jvs		= ($admin_id_unit == $b->penerima) ?  "onclick='return update_read(".$b->id.");'" : "";
											
											$filenya	= empty($b->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_masuk/".$b->file."' target='_blank' $jvs><b>Download / Lihat</b></a>";
											//$filenya	= empty($b->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."surat/surat_masuk/baca/".$b->id."' target='_blank' $jvs><b>Download / Lihat</b></a>";
											$read = $b->flag_read == "Y" ? "<div class='label label-success'>Sudah</div>" : "<div class='label label-danger'>Belum</div>";
											$lnjt = $b->flag_lanjut == "Y" ? "<div class='label label-success'>Sudah</div>" : "<div class='label label-danger'>Belum</div>";
									?>
									<tr>
										<td class="ctr"><?php echo tgl_jam_sql($b->tgl_surat);?></td>
										<td><?=$b->nomor."<br>(".tgl_jam_sql($b->tgl_surat).")"?></td>
										<td><?=$b->perihal."<br><b>File : </b> ".$filenya.""?></td>
										<!--<td><?=$b->perihal."<br><b>File : </b> ".base_url() . 'surat_masuk/baca/'. $b->id . ""?></td>-->
										<td><?="Dari : ".$b->pengirim."<br>Penerima : ".$b->penerimanya.""?></td>
										<td class="ctr"><?php echo $read; ?></td>
										<td class="ctr"><?php echo $lnjt; ?></td>
										
										<?php if($this->session->userdata('admin_level') !== "pimpinan"){ ?>
										<td class="ctr">
											<?php if($b->flag_lanjut == "N"){ ?>
											Belum Disposisi
											<?php }else if($b->flag_lanjut == "Y"){ ?>
											<a href="<?=base_URL().$admin_apps?>/disposisi_keluar/detil/<?php echo $b->id; ?>" class="btn btn-info btn-sm" title="Sudah Disposisi"><i class="fa fa-hand-o-right">  </i> Sudah Disposisi</a>
											<?php } ?>							
										</td>
										<?php } ?>
										
										<td class="ctr">
											<div class="btn-group">
												<?php 
												if ($this->session->userdata('admin_level') == "pimpinan" && $b->flag_lanjut == "N") {
												?>
												
												<a href="<?=base_URL().$admin_apps?>/disposisi_keluar/add/<?=$b->id?>/surat" class="btn btn-info btn-sm" title="Disposisi"><i class="fa fa-hand-o-right" onclick="return update_read(<?php echo $b->id; ?>);">  </i> Disposisi</a>
												
												<?php } else if ($this->session->userdata('admin_level') == "pimpinan" && $b->flag_lanjut == "Y") { ?>
												<a href="<?=base_URL().$admin_apps?>/disposisi_keluar/detil/<?php echo $b->id; ?>" class="btn btn-info btn-sm" title="Sudah Disposisi"><i class="fa fa-hand-o-right">  </i> Sudah Disposisi</a>
												
												<?php } else { ?>
												
												<a href="<?=base_URL().$admin_apps?>/surat_masuk/edt/<?=$b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edt</a>
												<a href="<?=base_URL().$admin_apps?>/surat_masuk/del/<?=$b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="fa fa-times">  </i> Del</a>
												
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
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /.col-lg-4 -->
</div>
<!-- /.row -->

<script type="text/javascript">
function update_read(id) {
	$.ajax({
		url: "<?php echo base_URL(); ?>jqueri/update_flag_read",
		data: "id=" + id,
		success: function(data) {	
			return true;
		}
	});

}
</script>
