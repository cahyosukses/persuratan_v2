<?php
$label_ 	= ""; 
if ($this->uri->segment(2) == "per_jenis_surat" || $this->uri->segment(2) == "search_per_jenis_surat") {
	$label_	= gval("r_jenis_surat", "id", "nama", $this->uri->segment(3));
}
?>

<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Surat Keluar (<?php echo $label_ ; ?>)</b>
					<?php if ($this->session->userdata('admin_level') == "tata usaha") { ?>
					
					<?php if (!empty($data)) { ?>
					<ul class="nav navbar-nav">
						<?php if(!empty($label_)){?>
						<li><a href="<?php echo base_URL().$admin_apps.'/'; ?>export_data/surat_keluar/<?php echo $this->uri->segment(3);?>"  class="btn-success"><i class="fa fa-mail-forward fa-fw"> </i> Export Data</a></li>
						<?php }else{ ?>
						<li><a href="<?php echo base_URL().$admin_apps.'/'; ?>export_data/surat_keluar/all" class="btn-success"><i class="fa fa-mail-forward fa-fw"> </i> Export Data</a></li>
						<?php } ?>						
					</ul>
					<?php } ?>
					
					<?php } ?>
				</div>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<?php if(!isset($jenis_surat)) { ?>
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/surat_keluar/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
							<a href="<?php echo base_url() . $admin_apps . '/surat_keluar';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
						</form>
						<?php }else{ ?>
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/search_per_jenis_surat/<?php echo $jenis_surat;?>/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
							<a href="<?php echo base_url() . $admin_apps . '/per_jenis_surat/' . $jenis_surat;?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
						</form>
						<?php } ?>
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
						<th width="10%">No. Agenda<br><i>Tanggal</i></th>
						<th width="20%">Nomor Surat, File</th>
						<th width="25%">Perihal<br><i>Penerima</i></th>
						<th width="25%">Status</th>
						<th width="35%">Aksi</th>
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
						<td class="ctr"><?php echo "<b>".$b->no_agenda."</b><br><i>".tgl_jam_sql($b->tgl_surat)."</i>";?></td>
						<td>
							<?=$no_surat."<br><b>Attachment : </b>".$filenya.""?><br>
							<b>Format Surat : </b><!--<a class="label label-info" href="<?php echo base_url() . 'surat/lihat_surat/' . $b->id . '/surat_keluar';?>"><b>Lihat</b></a>-->
							<a class="label label-info" href="<?php echo base_url() . 'surat/pdf_report/' . $b->id;?>"><b>Download as PDF</b></a><br>
						</td>
						<td><?=$b->perihal."<br><b>Penerima : </b>".$b->penerima?></td>
						<td><?php echo $stat_setuju." - ".$stat_keluar; ?></td>
						
						<td>
							<?php
							$level		= $this->session->userdata('admin_level');
							
							if ($level !== 'tata usaha') {
							?>
							<a href="#detil_surat" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Edit Data" onclick="return load_data(<?php echo $b->id; ?>);"><i class="fa fa-th-list"> </i> Detil</a>
							
							<?php 
							} else { 
								if ($b->flag_keluar === "Y") {
							?>
							<a href="<?=base_URL().$admin_apps?>/konsep/edit/<?=$b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edt</a>
							<a href="#detil_surat" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Edit Data" onclick="return load_data(<?php echo $b->id; ?>);"><i class="fa fa-th-list"> </i> Detil</a>
							<a href="<?php echo base_url() . 'surat/cetak/' . $b->id;?>" role="button" class="btn btn-success btn-sm" title="Cetak Data"><i class="fa fa-th-list"> </i> Lihat / Cetak</a>
							<?php 
								} else {
							?>
							<div class="btn-group">
								<a href="<?=base_URL().$admin_apps?>/surat_keluar/edt/<?=$b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edt</a>
								<a href="<?=base_URL().$admin_apps?>/surat_keluar/del/<?=$b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="fa fa-times">  </i> Del</a>
							</div>	
							<?php 
								}
							}
							?>
						</td>
					</tr>
					<?php 
						$no++;
						}
					}
					?>
				</tbody>
			</table>
		<center>
		<?php if(!isset($jenis_surat)) { ?>
			<ul class="pagination"><?php echo $pagi; ?></ul>
		<?php } ?>	
		</center>
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

<!-- MODAL DETIL SURAT -->
<div class="modal col-lg-12 fade" id="detil_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Detil Surat</h4>
			</div>
			<div class="modal-body">
				<div id="detil_div"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
			</div>
			</form>
		</div>
	</div>
</div>


<script type="text/javascript">
function load_data(data1) {
	$.get("<?php echo base_URL(); ?>surat/surat_keluar/detil?id="+data1, function(data,status){
		$("#detil_div").html('Loading...');
		$("#detil_div").html(data);
	});
}
</script>