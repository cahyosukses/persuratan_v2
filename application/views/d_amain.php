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
							<a href="'.base_url().$this->session->userdata('admin_apps').'/'.$url.'" class="thumbnail" title="(i) Shortcut Menu ini digunakan untuk melihat data '.$nama.'">
								<i class="fa fa-'.$ico.'" style="font-size: 80px; margin: 10px 0"></i><br>
								<h4 class="">'.$nama.'</h4>
							</a>
						</div>';
				}
			}
			
			?>
			
		</div>
			<!-- /.panel-body -->
			</div>
			<!-- /.panel -->
		
		</div>
	</div>
		
</div>