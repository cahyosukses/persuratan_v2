<?php
$pil_kecepatan	= array('sangat segera', 'segera', 'biasa');
$pil_intruksi	= array('Ditindaklanjuti', 'Ditanggapi tertulis', 'Disiapkan makalah/sambutan/presentasi sesuai tema', 'Koordinasikan dengan', 'Diwakili & laporkan hasilnya', 'Dihadiri & dilaporkan hasilnya', 'Disiapkan surat/memo dinas (internal)', 'File');


$mode			= $this->uri->segment(3);
$id_data		= $this->uri->segment(4);
$asal			= $this->uri->segment(5);

if ($mode == "edt" || $mode == "act_edt") {
	$act			= "act_edt";
	$idp			= $datpil->id;
	$tgl_diterima	= $datpil->tgl_diterima;
	$tgl_surat		= $datpil->tgl_surat;
	$pengirim		= $datpil->pengirim;
	$nomor			= $datpil->nomor;
	$no_agenda		= $datpil->no_agenda;
	$penerima		= $datpil->penerima;
	$tembusan		= $datpil->tembusan;
	$perihal		= $datpil->perihal;
	$kecepatan		= $datpil->kecepatan;
	
} else {
	$act			= "act_add";
	$idp			= "";
	$tgl_diterima	= "";
	$tgl_surat		= "";
	$pengirim		= "";
	$nomor			= "";
	$no_agenda		= "";
	$penerima		= "";
	$tembusan		= "";
	$perihal		= "";
	$kecepatan		= "";
}
?>
<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">
				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Disposisi Surat</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<?php 
			$filenya	= empty($detil_data->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<b><a href='".base_URL()."upload/surat_masuk/".$detil_data->file."' target='_blank'><i class='fa fa-download'></i> Download / Lihat</a></b>";
			?>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
				<div class="col-lg-3">
					<div class="alert alert-info"><b>Detil Surat</b></div>
					<table  class="table-form">
					<tr><td width="35%">Tgl Surat</td><td><b>: <?php echo tgl_jam_sql($detil_data->tgl_surat);?></b></td></tr>	
					<tr><td>Tgl Diterima</td><td><b>: <?php echo tgl_jam_sql($detil_data->tgl_diterima);?></b></td></tr>	
					<tr><td>Pengirim</td><td><b>: <?php echo $detil_data->pengirim;?></b></td></tr>	
					<tr><td>No. Surat</td><td><b>: <?php echo $detil_data->nomor;?></b></td></tr>	
					<tr><td>No. Agenda</td><td><b>: <?php echo $detil_data->no_agenda;?></b></td></tr>	
					<tr><td>Perihal</td><td><b>: <?php echo $detil_data->perihal;?></b></td></tr>	
					<tr><td>Kecepatan</td><td><b>: <?php echo $detil_data->kecepatan;?></b></td></tr>	
					<tr><td>File</td><td><?php echo $filenya; ?></td></tr>	
					</table>
				</div>
				
				<form id="form-disposisi" action="<?=base_URL().$admin_apps?>/disposisi_keluar/add_disposisi" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
				
				<input type="hidden" name="idp" value="<?php echo $id_data; ?>">
				<input type="hidden" name="id_data" value="<?php echo $id_data; ?>">
				<input type="hidden" name="id_surat" value="<?php echo $detil_data->id; ?>">
				<input type="hidden" name="asal" value="<?php echo $asal; ?>">
				
				<div class="col-lg-9">					
					<div class="alert alert-info" style="margin-bottom:2px"><b>Data Disposisi</b></div>
					<div id="table-no-item">
						<table class="table table-bordered table-hover">
							<thead>
							<tr>
								<th width="30%">Penerima</th>							
								<th>Intruksi</th>														
								<th width="15%">Tgl Selesai</th>
								<th width="15%">Aksi</th>
							</tr>	
							</thead>
							<tbody>
								<tr>
									<td colspan="4" style="text-align: center; font-weight: bold">
                                   		<div class="alert alert-danger" style="margin-bottom: 0px">Data Disposisi Belum Ada</div>
                                 	</td>
								</tr>
							</tbody>
						</table>
					</div>

					<div id="table-item">
						<table id="table-item-body" class="table table-bordered table-hover">
							<thead>
							<tr>
								<th width="30%">Penerima</th>							
								<th>Intruksi</th>														
								<th width="15%">Tgl Selesai</th>
								<th width="15%">Aksi</th>
							</tr>	
							</thead>
							<tbody>
							<?php foreach ($this->cart->contents() as $item){ ?> 
							<?php 
								$nama_unit = $this->basecrud_m->get_where('unit',array('kode_gabung' => $item['penerima']))->row()->nama_unit;
								$nama_penerima = $this->basecrud_m->get_where('pengguna',array('id' => $item['user']))->row()->nama;
							?>	
								<tr id="row_<?php echo $item['rowid'] ?>">														
								<td>
									<?php echo $nama_unit;?><br>
									<?php echo $nama_penerima;?>
								</td>	
								<?php 
									$label_kec = null;
									$kec = $item['kecepatan'];
									if($kec === 'sangat segera'){
										$label_kec = 'label-danger';
									}elseif($kec === 'segera'){
										$label_kec = 'label-warning';
									}else{
										$label_kec = 'label-success';
									}
								?>
	                            <td>
	                            	Kecepatan : <div class="label <?php echo $label_kec;?>"><?php echo $item['kecepatan'];?></div><br>
	                            	Intruksi : <?php echo $item['intruksi'];?><br>
	                            	<?php echo $item['isi_disposisi'];?><br>                            	
	                            </td>		                            
	                            <td><?php echo $item['tgl_selesai'];?></td>
								<td class="ctr">
									<div class="btn-group">                                                                         
										<button type="button" class="btn btn-danger btn-sm" onclick="del_disposisi('<?php echo $item['rowid'];?>')"><i class="fa fa-trash-o "></i>Hapus</button>                                         
									</div>
								</td>
							</tr>
							<?php } ?>	
							</tbody>
						</table>
						<table style="margin-top:5px;margin-bottom:5px">
							<tr>
								<td style="width:88%;text-align:right;padding-right:10px">
									<a href="<?=base_URL().$admin_apps?>/disposisi_keluar/act_add" class="btn btn-success" tabindex="10" data-original-title=""><i class="fa fa-check-circle"></i> Kirim Disposisi</a>									
								</td>
							</tr>
						</table>	
					</div>
					
					<div class="alert alert-info" style="margin-bottom:2px"><b>Form Disposisi</b></div>
					<table  class="table-form">
						<tr>
							<td width="20%">Penerima</td>
							<td>
								<select name="penerima" id="penerima" class="form-control col-lg-6" required tabindex="1" autofocus><?php echo select_unit_aktif($admin_id_unit); ?></select> 
						
								<div class="col-lg-2" style="margin-top: 10px">User</div>
								<select name="user" id="user" class="form-control col-lg-4" required tabindex="1">
									<?php 
									if (!empty($user)) {
										foreach ($user as $u) {
											if ($u->id != $this->session->userdata('admin_id')) {
												echo "<option value='".$u->id."' class='".$u->id_unit."'>".$u->jabatan." (".$u->username.")</option>";
											} else {
												echo "<option value='".$u->id."' class='".$u->id_unit."'>Saya (".$u->level.")</option>";
											}
										}
									}
									?>
								</select>
							</td>
						</tr>
						
						<tr>
							<td>Intruksi</td>
							<td>
								<select name="intruksi" class="form-control col-lg-12" tabindex="9"><?php echo select_array($pil_intruksi, $pil_intruksi); ?></select>
							</td>
						</tr>	
						<tr>
							<td>Isi Disposisi</td>
							<td>
								<textarea id="isi_disposisi" name="isi_disposisi" class="form-control col-lg-12" tabindex="2" style="height: 70px"></textarea>
							</td>
						</tr>	
						<tr>
							<td>Kecepatan</td>
							<td>
								<select name="kecepatan" class="form-control col-lg-5" tabindex="9"><?php echo select_array($pil_kecepatan, $pil_kecepatan); ?></select>
								<div class="col-lg-3" style="margin-top: 7px">Tgl Selesai</div>
								<input type="text" name="tgl_selesai" required class="form-control col-lg-4 tag_tgl" tabindex="2">
							</td>
						</tr>	
					</table>
					<table style="margin-top:20px">
						<tr>
							<td style="width:88%;text-align:right;padding-right:10px">
								<button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Tambah Disposisi</button>
							</td>
							<td>
								<a href="<?=base_URL().$admin_apps?>/surat_masuk" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
							</td>
						</tr>
					</table>	
				</div>
				
				<div class="col-lg-12 pull-right" style="margin-top: 20px; margin-bottom: 20px">
					
					
				</div>

				</form>
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
	$("#user").chained("#penerima");

	<?php if($this->cart->total_items() == 0){ ?>
      $('#table-no-item').show();
      $('#table-item').hide();
  	<?php }else{ ?>
      $('#table-no-item').hide();
      $('#table-item').show();      
  	<?php } ?>

	$('#form-disposisi').submit(function(){
		var page_url = $(this).attr("action");
		$.ajax({
			url: page_url,
			type: 'POST',		 
			data: $('#form-disposisi').serialize(),		 
			success: function (data) {				

				$('#table-no-item').hide();
              	$('#table-item').show();

				$('#table-item-body').find("tr:gt(0)").remove();
				$('#table-item-body').append(data);
				$('#isi_disposisi').val('');
			},
			error: function () {	
			 console.error('Error !');	
			}

		});	
  	  	return false;
	});

	function del_disposisi(id){
      
	  var answer =  confirm('Anda yakin ingin menghapus data ini?');
     
      if (answer) {
          $.ajax({
            type:'POST',
            async: false,
            cache: false,
            url: '<?php echo base_url() . 'surat/disposisi_keluar/del_disposisi/';?>' + id,
            success: function(data){				                		
                var tr  = $('#row_' + id);
                tr.css("background-color","").css("background-color","#FF3700");
                tr.fadeOut(400, function(){
                   tr.remove();

                   if (data == 0)
                   {                     
                     $('#table-no-item').show();
                     $('#table-item').hide();                                         
                   }else{                     
                     $('#table-no-item').hide();
                     $('#table-item').show();                    
                   }

                });
                
                
            }
          });
      }
   }
</script>