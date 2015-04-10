<div id="" style="margin-top: 40px">
	<div class="row col-lg-12">
		<div class="col-lg-9">
			<?php echo $this->session->flashdata("k"); ?>
			<!--<div class="alert alert-dismissable alert-success col-lg-3" style="overflow: auto">
				User : <strong><?php echo $this->session->userdata('admin_nama'); ?></strong> 
				<hr>
			</div>-->
			<?php 
			if (!empty($menu->id_menu)) {
				$pc_jumlah_menu = explode(",",$menu->id_menu);
				$jumlah_menu	= count($pc_jumlah_menu);
				
				for ($i = 0; $i < ($jumlah_menu-1); $i++) {
					$url	= gval("menu", "id", "url", $pc_jumlah_menu[$i]);
					$ico	= gval("menu", "id", "icon", $pc_jumlah_menu[$i]);
					$nama	= gval("menu", "id", "nama", $pc_jumlah_menu[$i]);
					echo '
						<div class="col-lg-3" style="text-align: center;">
							<a href="'.base_url().$admin_apps.'/'.$url.'" class="thumbnail" title="(i) Shortcut Menu ini digunakan untuk melihat data '.$nama.'">
								<i class="fa fa-'.$ico.'" style="font-size: 80px; margin: 10px 0"></i><br>
								<h4 class="">'.$nama.'</h4>
							</a>
						</div>';
				}
			}
			
			?>
			
		</div>
		<div class="col-lg-3">
		
			<!--<div class="panel panel-info">
				<div class="panel-heading" style="height: 51px">
					<div class="navbar-header"><b class="navbar-brand"><i class="fa fa-bell"> </i> &nbsp; Pemberitahuan</b></div>
				</div>

				<!-- /.panel-heading --
				<div class="panel-body" style="height: 300px; overflow: auto">
					<div class="row">
						<div class="col-lg-12" style="padding: 0">
						
							<a href="<?php echo base_url(); ?>apps/surat_masuk" title="(i) Klik disini, Anda mendapatkan <?php echo $not_surat_masuk; ?> surat masuk">							
								<div class="alert alert-info col-lg-12"> 
									<div class="col-lg-1"><i class="fa fa-folder-open-o" style="font-size: 30px; margin-left: -15px"> </i></div>
									<div class="col-lg-10" style="padding-right: 0px">Ada <span class="badge"><?php echo $not_surat_masuk; ?></span> surat masuk belum dibaca</div>
								</div>
							</a>
							
							<a href="<?php echo base_url(); ?>apps/surat_masuk" title="(i) Klik disini, Ada <?php echo $not_surat_masuk; ?> surat masuk untuk Anda, <?php echo $not_surat_lanjut; ?> belum ditindaklanjuti">							
								<div class="alert alert-success col-lg-12"> 
									<div class="col-lg-1"><i class="fa fa-external-link" style="font-size: 30px; margin-left: -15px"> </i></div>
									<div class="col-lg-10" style="padding-right: 0px">Ada <span class="badge"><?php echo $not_surat_lanjut; ?></span> surat masuk belum ditindaklanjuti</div>
								</div>
							</a>
							
							<a href="<?php echo base_url(); ?>apps/disposisi_masuk" title="(i) Klik disini, Ada <?php echo $not_disp_masuk; ?>  untuk Anda">							
								<div class="alert alert-danger col-lg-12"> 
									<div class="col-lg-1"><i class="fa fa-hand-o-right" style="font-size: 30px; margin-left: -15px"> </i></div>
									<div class="col-lg-10" style="padding-right: 0px">Ada <span class="badge"><?php echo $not_disp_masuk; ?></span> disposisi masuk untuk Anda</div>
								</div>
							</a>
							
							<a href="<?php echo base_url(); ?>apps/konsep_masuk" title="(i) Klik disini, Ada <?php echo $not_konsep_masuk; ?>  konsep masuk yang perlu Anda periksa">							
								<div class="alert alert-info col-lg-12"> 
									<div class="col-lg-1"><i class="fa fa-align-left" style="font-size: 30px; margin-left: -15px"> </i></div>
									<div class="col-lg-10" style="padding-right: 0px">Ada <span class="badge"><?php echo $not_konsep_masuk; ?></span> konsep masuk yang perlu Anda periksa</div>
								</div>
							</a>
							
						</div>
					</div>
				<!-- /.row --
				</div>
			<!-- /.panel-body --
			</div>
			<!-- /.panel -->
		
		</div>
	</div>
		
</div>