<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-th-large"> </i> &nbsp; Arsip Surat</b>
            </div>
            <ul class="nav navbar-nav">
               <li><a href="<?php echo base_URL();?>surat/arsip/add" class="btn-info"><i class="fa fa-edit fa-fw"> </i> Buat Arsip</a></li>
            </ul>
            <div class="navbar-collapse collapse navbar-inverse-collapse" >
               <ul class="nav navbar-nav navbar-right">                 
                  <form class="navbar-form" method="post" action="<?=base_URL()?>/surat/arsip/cari">
                     <input type="text" class="form-control" name="q" style="width: 200px" value="<?php echo isset($cari) ? $cari : '';?>" placeholder="Kata kunci pencarian ..." required>
                     <button type="submit" class="btn btn-info"><i class="fa fa-search fa-fw"> </i> Cari</button>
                     <a href="<?php echo base_url() . '/surat/arsip';?>"><button type="button" class="btn btn-info"><i class="fa fa-times fa-fw"> </i> Clear</button></a>
                  </form>                  
               </ul>
            </div>
            <!-- /.nav-collapse -->
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
                              <th width="10%">Tanggal Surat</th>
                              <th width="20%">Nomor Surat</th>
                              <th width="20%">Perihal</th>
                              <th width="15%">Penerima</th>
                              <th width="15%">File Attachment</th>
                              <th width="20%">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php 
                              if (empty($data)) {
                              	echo "<tr>
                                          <td colspan='6' style='text-align: center; font-weight: bold'>
                                             <div class='alert alert-danger' style='margin-bottom: 0px'>Data tidak ditemukan</div>
                                          </td>
                                       </tr>";
                              } else {
                              	$no 	= ($this->uri->segment(4) + 1);
                              	foreach ($data as $b) {
                              		$filenya	= empty($b->file) ? "<div class='label label-warning'>Tidak tersedia</div>" : "<a class='label label-success' href='".base_URL()."upload/surat_keluar/".$b->file."' target='_blank'><b>Download / Lihat</b></a>";                              		
                                    $no_surat	= empty($b->no_surat) ? "<span class='label label-danger'>Belum diberi nomor</span>" : $b->no_surat;
                              ?>
                           <tr>
                              <td class="ctr"><?php echo "<i>".tgl_jam_sql($b->tgl_surat)."</i>";?></td>
                              <td>
                                 <?php echo $no_surat;?><br>
                                 <b>Format Surat : </b>
                                 <a class="label label-info" href="<?php echo base_url() . 'surat/pdf_report/' . $b->id;?>"><b>Download as PDF</b></a><br>
                              </td>
                              <td><?php echo $b->perihal;?></td>
                              <td><?php echo $b->penerima;?></td>
                              <td class="ctr"><?php echo $filenya;?></td>
                              <td class="ctr">
                                 <a href="#detil_surat" role="button" data-toggle="modal" class="btn btn-success btn-sm" title="Edit Data" onclick="return load_data(<?php echo $b->id; ?>);"><i class="fa fa-th-list"> </i> Detil</a>
                              <?php $level = $this->session->userdata('admin_level');?>
                              <?php if( $level !== 'staff'){ ?>
                                 <a href="<?=base_URL();?>surat/arsip/edit/<?php echo $b->id?>" class="btn btn-success btn-sm" title="Edit Data"><i class="fa fa-edit"> </i> Edit</a>
                                 <a href="<?=base_URL();?>surat/arsip/del/<?php echo $b->id?>" class="btn btn-warning btn-sm" title="Hapus Data" onclick="return confirm('Anda Yakin..?')"><i class="fa fa-times">  </i> Del</a>
                              <?php } ?>
                              </td>
                           </tr>
                           <?php 
                                 $no++;
                                 }
                              }
                              ?>
                        </tbody>
                     </table>
                     <center>
                        <?php if(!isset($jenis_surat)) { ?>
                        <ul class="pagination"><?php echo $pagi; ?></ul>
                        <?php } ?>	
                     </center>
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
<!-- MODAL DETIL SURAT -->
<div class="modal col-lg-12 fade" id="detil_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Detil Surat</h4>
         </div>
         <div class="modal-body">
            <div id="detil_div"></div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">OK</button>
         </div>
         </form>
      </div>
   </div>
</div>
<script type="text/javascript">
   function load_data(data1) {
   	$.get("<?php echo base_URL(); ?>surat/arsip/detil?id=" + data1, function(data,status){
   		$("#detil_div").html('Loading...');
   		$("#detil_div").html(data);
   	});
   }
</script>