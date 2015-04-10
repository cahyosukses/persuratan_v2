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
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Kop Surat</b>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="<?php echo base_URL().$admin_apps.'/'; ?>/kop_surat/add" class="btn-info"><i class="fa fa-plus-circle fa-fw"> </i> Tambah Data</a></li>
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL()?>/kop_surat/cari">
							<input type="text" class="form-control" name="q" style="width: 200px" placeholder="Kata kunci pencarian ..." required>
							<button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
						</form>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>

			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-5">
						<div class="table-responsive">
							<?php echo $this->session->flashdata("k");?>
							<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th width="5%">Id</th>
									<th width="65%">Nama</th>
									<th width="30%">Aksi</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
								if (empty($data)) {
									echo "<tr><td colspan='3'  style='text-align: center; font-weight: bold'>--Data tidak ditemukan--</td></tr>";
								} else {
									$no 	= ($this->uri->segment(4) + 1);
									foreach ($data as $b) {
								?>
								<tr onclick="return priview_kop('<?php echo $b->id; ?>');" title="Klik untuk melihat priview-nya">
									<td class="ctr"><?php echo $no;?></td>
									<td><?php echo $b->judul;?></td>
									<td class="ctr">
										<div class="btn-group">
											<a href="<?=base_URL().$admin_apps?>/kop_surat/edit/<?=$b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edt</a>
											<a href="<?=base_URL().$admin_apps?>/kop_surat/del/<?=$b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="fa fa-times">  </i> Del</a>
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
					<div class="col-lg-7">
						<div class="panel panel-info" style="border: dashed 1px #DDDDDD">
						<div class="panel-body" id="priview_kop">
						Priview ...
						</div>
					</div>
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

<script type="text/javascript">
	function priview_kop(id) {
		$("#priview_kop").html("Loading..");
		$("#priview_kop").load("<?php echo base_URL().$admin_apps; ?>/jq_priview_kop?id_kop="+id+"");
		return false;
	};
</script>