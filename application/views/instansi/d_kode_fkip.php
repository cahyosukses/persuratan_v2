<?php 
$pil_level	= array('admin root','pimpinan','tata usaha','staff');
$pil_apps	= array('instansi','aset','surat');
?>

<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Kode Surat</b>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="#fkip" data-toggle="modal" onclick="return isi_fkip('','0','','','add-sub')" class="btn-info"><i class="fa fa-plus-circle fa-fw"> </i> Tambah Root</a></li>
					
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<!--
                        <form class="navbar-form" method="post" action="<?=base_URL()?>instansi/atur_user/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
							<a href="<?php echo base_url() . 'instansi/atur_user/';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
						</form>
                -->
					</ul>
				</div><!-- /.nav-collapse -->
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
							<?php echo $this->session->flashdata("k");?>
                            <?=$table_fkip;?>						
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


<div class="modal fade" id="fkip" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form id="form-modal" action="#" method="post">
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			  <h4 class="modal-title" id="myModalLabel">Kode Surat</h4>
			</div>
			<div class="modal-body">		
				  <input type="hidden" name="id" id="id">
				  <input type="hidden" name="id_parent" id="id_parent">
				  <input type="text" name="kode" id="kode" autofocus class="form-control col-lg-12" placeholder="kode" required><br>
				  <br>
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
function isi_fkip(id, id_parent, nama, kode, aksi) {
	$("#id").val(id);
	$("#id_parent").val(id_parent);	
	$("#nama").val(nama);
    $("#kode").val(kode);    
	$("#form-modal").attr('action','<?=base_url();?>instansi/kode_surat/' + aksi);    
	$("#nama").focus();
}
</script>