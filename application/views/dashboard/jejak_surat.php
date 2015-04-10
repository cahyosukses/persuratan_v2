<!DOCTYPE html>
<html dir="ltr" lang="id">
<head>

    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">    
	<link rel="stylesheet" href="<?php echo base_URL() . 'aset/'?>new_login/style.css" type="text/css">
		
    <link rel="shortcut icon" href="<?php echo base_URL() . 'aset/'?>new_login/favicon.ico" type="image/x-icon">
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery-1.js" type="text/javascript"></script> 

    <link rel="stylesheet" href="tracksurat_files/validationEngine.css" type="text/css">
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery_002.js" type="text/javascript"></script>

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
					</select>
					
					<span style="width:120px;display:inline-block"></span>
					<input value="Lihat" type="submit">
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
						<td><?php echo $cari->perihal."<br><b>File : </b> ".$filenya.""?></td>
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
			<?php }}else{ ?>
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
						$filenya     = empty($cari->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$cari->file."' target='_blank'><b>Download / Lihat</b></a>";
						$no_surat    = empty($cari->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $cari->no_surat;
						$stat_setuju = $cari->flag_setuju == "N" ? "<span class='label label-danger'>Belum diperiksa</span>" : "<span class='label label-success'>Sudah diperiksa dan setuju</span>";
						$stat_keluar = $cari->flag_keluar == "N" ? "<span class='label label-danger'>Belum dikirim</span>" : "<span class='label label-success'>Sudah dikirim</span>";

					?>
					<tr>
						<td class="ctr"><?php echo "<b>".$cari->no_agenda."</b><br><i>".tgl_jam_sql($cari->tgl_surat)."</i>";?></td>
						<td>
							<?=$no_surat."<br><b>Attachment : </b>".$filenya.""?><br>
							<b>Format Surat : </b>
							<a class="label label-info" href="<?php echo base_url() . 'dashboard/pdf_report/' . $cari->id;?>"><b>Download as PDF</b></a><br>
						</td>
						<td><?php echo $cari->perihal."<br><b>Penerima : </b>".$cari->penerima?></td>
						<td><?php echo $stat_setuju." - ".$stat_keluar; ?></td>
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
</body>
</html>