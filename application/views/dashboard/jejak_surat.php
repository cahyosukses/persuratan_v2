<!DOCTYPE html>
<html dir="ltr" lang="id">
<head>

    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">    
	<link rel="stylesheet" href="<?php echo base_URL() . 'aset/'?>new_login/style.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_URL() . 'aset/'?>new_login/jquery.modal.css" type="text/css">		    
    <link rel="shortcut icon" href="<?php echo base_URL() . 'aset/'?>new_login/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="tracksurat_files/validationEngine.css" type="text/css">

    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery-1.js" type="text/javascript"></script>     
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery_002.js" type="text/javascript"></script>
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery.modal.min.js" type="text/javascript"></script>
    <script src="<?php echo base_URL() . 'aset/'?>new_login/main.js" type="text/javascript"></script>
	
		
	    
    <title>Aplikasi Perkantoran Elektronik (E-Office)</title>

    <!-- CSS goes in the document HEAD or added to your external stylesheet -->
	<style type="text/css">
	table.gridtable {
		font-family: verdana,arial,sans-serif;
		font-size:11px;
		color:#333333;
		border-width: 1px;
		border-color: #666666;
		border-collapse: collapse;
	}
	table.gridtable th {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #666666;
		background-color: #dedede;
	}
	table.gridtable td {
		border-width: 1px;
		padding: 8px;
		border-style: solid;
		border-color: #666666;
		background-color: #ffffff;
	}
	</style>

</head>
<body style="background-color:#d6e3ef">

	<!-- Modal HTML embedded directly into document -->
	  <div id="ex1" style="display:none;">
	    	<form id="main_form" method="POST" action="<?php echo base_URL() . 'dashboard/auth_download';?>">				
				<input id="f_jenis" type="hidden" name="jenis" value="">
				<input id="f_is_attachment" type="hidden" name="is_attachment" value="">
				<input id="f_id" type="hidden" name="id" value="">

				<table style="width:100%;margin-top:10px">
					<tbody>
						<tr>							
							<td style="padding:20px;width:300px;">
								<div class="section">									
								<h2 style="text-align:center">Username dan Password Diperlukan</h2>
								<table style="margin-left:50px">
									<tbody>
										<tr>
											<td style="vertical-align:middle;padding-right:5px">
												Username
											</td>
											<td style="vertical-align:middle">
												<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;" name="u" id="username" size="20" class="validate[required]" required type="text">
											</td>
										</tr>
										<tr>
											<td style="vertical-align:middle;padding-right:5px">
												Password
											</td>
											<td style="vertical-align:middle">
												<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;" name="p" id="password" size="20" required type="password">
											</td>
										</tr>
										<tr>
											<td>&nbsp;</td>
											<td align="left">
												<input class="btn_login" value="Download File" id="btnLogin" type="submit">												
											</td>
										</tr>
										<tr>
											<td colspan="2" height="30" align="center">
												<div id="retMessage" class="widefat" style="background-color:#de5870;color:#fff;padding:2px;margin-top:3px;display:none"></div>
											</td>
										</tr>
										
									</tbody>
								</table>

								</div>
								
							</td>
						</tr>
					</tbody>
				</table>				
			</form>
	  </div>

  	<div style="width:1000px;margin:0 auto;background-color:white;min-height:460px">
	<?php $q_instansi	= $this->db->query("SELECT * FROM instansi LIMIT 1")->row(); ?>
	<img src="<?php echo base_url(); ?>upload/<?php echo $login_logo_header = empty($q_instansi->login_logo_header) ? "logo_login.jpg" : $q_instansi->login_logo_header; ?>" style="width:1000px;height:120px">

	    <div style="padding:10px">

			<h1>Jejak Surat</h1>
			<br>
			<h3>Silakan anda masukkan nomor surat yang akan dicari.</h3>
			<div class="section" style="width:400px">
				<form name="forgot_form" method="post" action="">
					<span style="width:120px;display:inline-block">No. Surat</span>
					<input name="nosurat" id="nosurat" style="width:200px" type="text" value="<?php echo set_value('nosurat','');?>">
					
					<span style="width:120px;display:inline-block">Jenis Surat</span>
					<select name="jenis" style="width:200px">
						<option <?php echo set_select('jenis','surat_keluar',TRUE);?> value="surat_keluar">Surat Keluar</option>
						<option <?php echo set_select('jenis','surat_masuk');?> value="surat_masuk">Surat Masuk</option>
						<option <?php echo set_select('jenis','arsip_surat');?> value="arsip_surat">Arsip Surat</option>
					</select>
					
					<span style="width:120px;display:inline-block"></span>
					<input id="submit_search" value="Cari" type="submit">
				</form>
			</div>
			<div>
			
			<?php 
				if(!empty($r_cari)){
			?>

			<!-- Table goes in the document BODY -->
			<?php if($jenis === 'surat_masuk'){ ?>	
			<table class="gridtable" width="100%">
				<tr>									
					<th>Tgl.Terima</th>
					<th>Nomor Surat , Tgl.Surat</th>
					<th>Perihal , File</th>
					<th>Pengirim , Penerima</th>
					<th>Dibaca</th>
					<th>Ditindak Lanjuti</th>
					<th>Status</th>					
				</tr>
				<?php if ($r_cari->num_rows() == 0) { ?>
					<tr>
						<td colspan='7' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td>
					</tr>
					</table>
				<?php }else{ ?>				
					<?php foreach ($r_cari->result() as $cari){ ?>
					<?php 
						$filenya = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_masuk/".$cari->file."' target='_blank'><b>Download / Lihat</b></a>";
						$read    = $cari->flag_read == "Y" ? "<div class='label label-success'>Sudah</div>" : "<div class='label label-danger'>Belum</div>";
						$lnjt    = $cari->flag_lanjut == "Y" ? "<div class='label label-success'>Sudah</div>" : "<div class='label label-danger'>Belum</div>";
					?>
					<tr>
						<td>
							<?php echo tgl_jam_sql($cari->tgl_surat);?>
						</td>	
						<td>
							<?php echo $cari->nomor."<br>(".tgl_jam_sql($cari->tgl_surat).")"?>
						</td>
						<td>
							<?php $allow_download = $this->session->userdata('allow_download'); ?>
							<?php if($allow_download){?>
							<?php echo $cari->perihal."<br><b>File : </b> ".$filenya.""?>
							<?php }else{ ?>
							<?php $filenya   = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a rel='modal:open' class='label label-success' onclick=\"set_vars('surat_masuk','Y'," . $cari->id . ")\" href='#ex1'><b>Download / Lihat</b></a>";?>
							<?php echo $cari->perihal."<br><b>File : </b> ".$filenya.""?>
							<?php } ?>
							
						</td>
						<td><?php echo "Dari : ".$cari->pengirim."<br>Penerima : ".$cari->penerimanya.""?></td>
						<td class="ctr"><?php echo $read; ?></td>
						<td class="ctr"><?php echo $lnjt; ?></td>
						<td class="ctr">
						<?php if($cari->flag_lanjut == "N"){ ?>
							<div class='label label-danger'>Belum Disposisi</div>
						<?php }elseif($cari->flag_lanjut == "Y"){ ?>
							<div class='label label-success'>Sudah Disposisi</div>
						<?php } ?>							
						</td>
					</tr>	
					<?php } ?>					
							
			</table>
			<?php }}elseif($jenis === 'surat_keluar'){ ?>
			<table class="gridtable" width="100%">
				<tr>									
					<th>No. Agenda<br><i>Tanggal</i></th>
					<th>Nomor Surat, File</th>
					<th>Perihal<br><i>Penerima</i></th>
					<th>Status</th>								
				</tr>
				<?php if ($r_cari->num_rows() == 0) { ?>
					<tr>
						<td colspan='7' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td>
					</tr>
					</table>
				<?php }else{ ?>				
					<?php foreach ($r_cari->result() as $cari){ ?>
					<?php 
						$allow_download = $this->session->userdata('allow_download');
						$filenya = null;
						$format_surat = null;

						if($allow_download){
							$filenya     = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$cari->file."' target='_blank'><b>Download / Lihat</b></a>";
							$format_surat = "<a class='label label-info' href='" . base_url() . "dashboard/pdf_report/" . $cari->id . "'><b>Download as PDF</b></a><br>";							
						}else{
							//jika belum masukin login
							$filenya     = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a rel='modal:open' class='label label-success' onclick=\"set_vars('surat_keluar','Y'," . $cari->id . ")\" href='#ex1'><b>Download / Lihat</b></a>";
							$format_surat = "<a rel='modal:open' class='label label-info' onclick=\"set_vars('surat_keluar','N'," . $cari->id . ")\" href='#ex1'><b>Download as PDF</b></a><br>";							
						}						
					
						$no_surat    = empty($cari->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $cari->no_surat;
						$stat_setuju = $cari->flag_setuju == "N" ? "<span class='label label-danger'>Belum diperiksa</span>" : "<span class='label label-success'>Sudah diperiksa dan setuju</span>";
						$stat_keluar = $cari->flag_keluar == "N" ? "<span class='label label-danger'>Belum dikirim</span>" : "<span class='label label-success'>Sudah dikirim</span>";

					?>
					<tr>
						<td class="ctr"><?php echo "<b>".$cari->no_agenda."</b><br><i>".tgl_jam_sql($cari->tgl_surat)."</i>";?></td>
						<td>
							<?=$no_surat."<br><b>Attachment : </b>".$filenya.""?><br>
							<b>Format Surat : </b><?php echo $format_surat;?>
							
						</td>
						<td><?php echo $cari->perihal."<br><b>Penerima : </b>".$cari->penerima?></td>
						<td><?php echo $stat_setuju." - ".$stat_keluar; ?></td>
					</tr>
					<?php } ?>
			</table>

			<?php }}else{ ?>
			<table class="gridtable" width="100%">
				<tr>									
					<th>Tanggal</th>
					<th>Nomor Surat</th>
					<th>Perihal</th>
					<th>Penerima</th>
					<th>File Attachment</th>
				</tr>
				<?php if ($r_cari->num_rows() == 0) { ?>
					<tr>
						<td colspan='5' style='text-align: center; font-weight: bold'><div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div></td>
					</tr>
					</table>
				<?php }else{ ?>				
					<?php foreach ($r_cari->result() as $cari){ ?>
					<?php 
						$allow_download = $this->session->userdata('allow_download');
						$filenya = null;
						$format_surat = null;

						if($allow_download){
							$filenya     = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$cari->file."' target='_blank'><b>Download / Lihat</b></a>";
							//$format_surat = "<a class='label label-info' href='" . base_url() . "dashboard/pdf_report/" . $cari->id . "'><b>Download as PDF</b></a><br>";							
						}else{
							//jika belum masukin login
							$filenya     = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a rel='modal:open' class='label label-success' onclick=\"set_vars('arsip_surat','Y'," . $cari->id . ")\" href='#ex1'><b>Download / Lihat</b></a>";
							//$format_surat = "<a rel='modal:open' class='label label-info' onclick=\"set_vars('arsip_surat','N'," . $cari->id . ")\" href='#ex1'><b>Download as PDF</b></a><br>";							
						}						
					
						$no_surat    = empty($cari->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $cari->no_surat;
						
					?>
					<tr>
						<td class="ctr"><?php echo tgl_jam_sql($cari->tgl_surat);?></td>
						<td><?php echo $no_surat;?></td>
						<td><?php echo $cari->perihal;?></td>
						<td><?php echo $cari->penerima;?></td>
						<td><?php echo $filenya; ?></td>
					</tr>
					<?php } ?>
			</table>

			<?php }} ?>
			
			<?php } ?>
			</div>
			<div style="margin-top:50px"><a href="<?php echo base_URL() . 'dashboard/login'?>">Kembali ke halaman utama</a></div>

		</div>
	</div>
	<div style="width:1000px;margin:0 auto;background-color:#2c6a8b;color:white;height:100px;text-align:center;padding-top:10px">
		<h4 style="color:white">E-Office © 2015</h4>
	</div>

	<script type="text/javascript">
		
		function set_vars(s_jenis,s_is_attachment,d_id) {
			$("#f_jenis").val(s_jenis);   
			$("#f_is_attachment").val(s_is_attachment);   
			$("#f_id").val(d_id);   			
		}

		$('#main_form').submit(function(msg) {  	

			$.post("<?php echo base_URL() . 'dashboard/auth_download'?>",
				   $('#main_form').serialize(),
				   function(data){	

			});

			
			//$.modal.close();			
			//location.replace(location.pathname);
			//$('#submit_search').trigger('click');

    	});

    	$('#ex1').on($.modal.CLOSE, function(event, modal) {		 
    		
    		$('#submit_search').trigger('click');
    		
		});
	</script>
</body>
</html>