<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Jenis Masuk</b>
				</div>
				<?php
				if ($this->session->userdata('admin_level') == "tata usaha") {
				?>
				
				<ul class="nav navbar-nav">
					<li><a href="#unit" role="button" onclick="return isiunit('', '', 'add_');" data-toggle="modal" title="Tambah Jenis Surat" class="btn-info"><i class="fa fa-plus-circle fa-fw"> </i> Tambah Data</a></li>
				</ul>
				
				<?php } ?>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/jenis_surat/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
							<a href="<?php echo base_url() . $admin_apps . '/jenis_surat';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
						</form>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">

						<table class="table table-bordered">
							<thead>
							<tr><th width="5%">No</th><th width="80%">Nama</th><th width="15%">Aksi</th></tr>	
							</thead><tbody>
							<?php 
							if (empty($data)) {
								echo "<tr><td colspan='3'><div class='alert alert-danger'>Data tidak ada</div></td></tr>";
							} else {
								$no = 1;
								foreach ($data as $d) {
							?>
								<tr>
									<td class="ctr"><?php echo $no++; ?></td>
									<td><?php echo $d->nama; ?></td>
									<td class="ctr">
									<a href="#unit" role="button" onclick="return isiunit('<?php echo $d->id; ?>', '<?php echo $d->nama; ?>', 'act_edit');" data-toggle="modal" title="Edit data" class="btn btn-success btn-sm"><i class="fa fa-edit"> </i> </a> 
									<a href="<?php echo base_url().$admin_apps; ?>/jenis_surat/del/<?php echo $d->id; ?>" title="Hapus data" onclick="return confirm('Anda yakin..?');" class="btn btn-danger btn-sm"><i class="fa fa-times"> </i> </a></td>
								</tr>
							<?php	
								}
							}
							?>
							</tbody>
						</table>
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

<div class="modal fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form action="<?php echo base_url().$admin_apps; ?>/jenis_surat/" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Jenis Surat</h4>
      </div>
      <div class="modal-body">
			<input type="hidden" name="aksi" id="aksi">
			<input type="hidden" name="id" id="id">
			<input type="text" name="nama" id="nama" autofocus class="form-control col-lg-12" placeholder="Nama" required><br>
		
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
function isiunit(id, nama, aksi) {
	$("#id").val(id);
	$("#nama").val(nama);
	$("#aksi").val(aksi);
	$("#nama").focus();
}
</script>