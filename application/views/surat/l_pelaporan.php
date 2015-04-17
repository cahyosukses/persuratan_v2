<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Pelaporan</b>
				</div>
				 <ul class="nav navbar-nav">
               		<li><a href="<?php echo base_URL() . $admin_apps; ?>/pelaporan/add" class="btn-info"><i class="fa fa-edit fa-fw"> </i> Buat Pelaporan</a></li>
            	</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" >
					<ul class="nav navbar-nav navbar-right">
						<form class="navbar-form" method="post" action="<?=base_URL().$admin_apps?>/pelaporan/cari">
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
										<th width="15%">Tgl Pelaporan</i></th>
										<th width="20%">Pelapor ,Penerima</i></th>
										<th width="20%">Perihal</i></th>
										<th width="20%">Isi Laporan, File</th>
										<th>Status</th>										
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
									?>
									<tr>
										<td>
											<?php echo tgl_jam_sql($b->tgl_kirim);?><br>
											<?php if($admin_id == $b->id_penerima){ ?>	
											<div class="label label-success">Pelaporan Masuk</div>
											<?php }else{ ?>
											<div class="label label-warning">Pelaporan Keluar</div>
											<?php } ?>
										</td>
										<td>
											<?php echo "Pelapor : " . $b->pengirim ;?><br>
											<?php echo "Penerima : " . $b->penerima ;?>
										</td>	
										<td>
											<?php echo $b->perihal;?>
										</td>
										<td>
											<pre style="margin-bottom: 0px;margin-top: 0px;padding:0px;background-color: #fff;border:0px"><b><?php echo $b->catatan;?></b></pre>
											File : <a href="<?php echo base_URL() . 'upload/' . $b->file;?>" class="label label-success" target="_blank"><b>Download / Lihat</b></a>
										</td>
										<td class="ctr">
											<?php if ($b->status_periksa == "Y") { ?>													
											<div class="label label-success">Sudah Diperiksa</div>
											<?php } else { ?>
											<div class="label label-warning">Belum Diperiksa</div>
											<?php } ?>
										</td>										
										<td class="ctr">
											<div class="btn-group">
												<?php if($admin_id == $b->id_penerima){ ?>	
													<?php if ($b->status_periksa == "Y") { ?>
														
														<a href="" class="btn btn-info btn-sm disabled" data-original-title="Sudah Diperiksa">
															<i class="fa fa-hand-o-right"></i> Update Status
														</a>
													<?php } else { ?>														
														<a href="<?php echo base_URL() . $admin_apps . '/pelaporan'?>" onclick="return update_status(<?php echo $b->id?>)" class="btn btn-warning btn-sm" data-original-title="Klik jika anda sudah memeriksa">
															<i class="fa fa-hand-o-right"></i> Update Status
														</a>
													<?php } ?>
												<?php }else{ ?>													
													<?php if ($b->status_periksa == "Y") { ?>													
													<a href="<?php echo base_URL().$admin_apps; ?>/pelaporan/edit/<?php echo $b->id; ?>" class="btn btn-success disabled btn-sm" title="Edit Pelaporan"><i class="fa fa-edit"> </i> Edit Pelaporan</a>
													<?php } else { ?>													
													<a href="<?php echo base_URL().$admin_apps; ?>/pelaporan/edit/<?php echo $b->id; ?>" class="btn btn-success btn-sm" title="Edit Pelaporan"><i class="fa fa-edit"> </i> Edit Pelaporan</a>
													<?php } ?>
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


<script type="text/javascript">	
	function update_status(id) {
		$.ajax({
			url: "<?php echo base_URL(); ?>surat/pelaporan/update_status",
			data: "id=" + id,
			success: function(data) {	
				
			}
		});

	}
</script>