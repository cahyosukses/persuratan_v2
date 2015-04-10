<div id="">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Atur Instansi</h1>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<!-- /.row -->
	
	<div class="col-lg-12">
		<table class="table table-bordered">
		<?php 
		if (empty($cek_super)) {
		?>
		<tr><th colspan="6" style="background: #ddd"><h4 style="text-align: left; margin-left: 10px; font-weight: bold"><i class="fa fa-home"></i> <a href="#unit" role="button" onclick="return isiunit('', '', '', '', '', '', 'add_');" data-toggle="modal" title="Tambah Unit"><i class="fa fa-plus-circle"> </i> Tambah Instansi Utama</a></h4></th></tr>
		<?php } else { ?>
		<tr><th colspan="6" style="background: #ddd"><h4 style="text-align: left; margin-left: 10px; font-weight: bold"><i class="fa fa-home"></i> 
		<?php echo $cek_super->nama_unit; ?>
		<a href="#unit" role="button" onclick="return isiunit('<?php echo $cek_super->id; ?>', '', '', '', '', '<?php echo $cek_super->nama_unit; ?>', 'act_edit');" data-toggle="modal" title="Edit data"><i class="fa fa-edit"> </i> </a>
		</h4>
		</th></tr>
		<?php } ?>
			<?php echo $dtree; ?>
		</table>
	</div>
		<!-- second row -->
		
		<div class="col-lg-12">
			<div class="col-lg-2">
		
			</div>
		</div>
</div>

<div class="modal fade" id="unit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form action="<?php echo base_url().$admin_apps; ?>/unit/" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Satuan Kerja</h4>
      </div>
      <div class="modal-body">
			<input type="hidden" name="aksi" id="aksi">
			<input type="hidden" name="id" id="id">
			<input type="hidden" name="kode_00" id="kode_00">
			<input type="hidden" name="kode_01" id="kode_01">
			<input type="hidden" name="kode_02" id="kode_02">
			<input type="hidden" name="kode_03" id="kode_03">
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
function isiunit(id, kode_00, kode_01, kode_02, kode_03, nama, aksi) {
	$("#id").val(id);
	$("#kode_00").val(kode_00);
	$("#kode_01").val(kode_01);
	$("#kode_02").val(kode_02);
	$("#kode_03").val(kode_03);
	$("#nama").val(nama);
	$("#aksi").val(aksi);
	$("#nama").focus();
}
</script>