<?php
   
   $pil_jenis		= $this->db->query("SELECT * FROM r_jenis_surat")->result();
   $a_pil_jenis	= array();
   foreach($pil_jenis as $apil) {
   	$a_pil_jenis[$apil->id]	= $apil->nama;
   }

   $mode			= $this->uri->segment(3);
   
   $p = null;
   
   if ($mode == "edit" || $mode == "act_edt") {
      
      $act                = 	"act_edt";
      $idp                = 	$datdet->id;
      $pengirim           =	$datdet->pengirim;
      $pengirim_user      =	$datdet->pengirim_user;
      $tgl_surat          =	$datdet->tgl_surat;      
      $no_surat           =	$datdet->no_surat;
      $penerima           =	$datdet->penerima;
      $perihal            =	$datdet->perihal;
      $file               =	$datdet->file;
      $jenis_ok           =	$datdet->id_jenis_surat;

   } else {
      $act                = 	"act_add";
      $idp                = 	"";      
      $pengirim           =	"";
      $pengirim_user      =	"";
      $tgl_surat          =	"";     
      $no_surat           =	"";
      $penerima           =	"";
      $perihal            =	"";      
      $file               =	"";     
      $jenis_ok           =	"";
     
   }
   

   ?>

<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Arsip Surat</b>
            </div>
            <div class="navbar-collapse" style="margin-bottom: 20px"></div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="col-lg-12">
               <form action="<?=base_URL();?>surat/arsip/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                  <input type="hidden" name="idp" value="<?php echo $idp; ?>">
                  <input type="hidden" name="tipe" value="file">
                  <div class="col-lg-6">
                     <table  class="table-form">
                        <tr>
                           <td>Tanggal Surat</td>
                           <td><input type="text" name="tgl_surat" required value="<?php echo $tgl_surat; ?>" id="tgl_surat" class="form-control col-lg-5 tag_tgl" tabindex="1" autofocus></td>
                        </tr>
                        <tr>
                           <td>No. Surat</td>
                           <td><input type="text" name="no_surat" required value="<?php echo $no_surat; ?>" id="no_surat" class="form-control col-lg-12" tabindex="2"></td>
                        </tr>
                        <tr>
                           <td>Penerima</td>
                           <td><input type="text" name="penerima" required value="<?php echo $penerima; ?>" id="penerima" class="form-control col-lg-12" tabindex="3"></td>
                        </tr>
                        
                        <tr>
                           <td width="25%">Jenis Surat</td>
                           <td><?php echo form_dropdown('jenis_syurat', $a_pil_jenis, $jenis_ok, "class='form-control col-lg-5' tabindex='4'"); ?></td>
                        </tr>
                        <tr>
                           <td colspan="2">
                           </td>
                        </tr>
                     </table>
                  </div>
                  <div class="col-lg-6">
                     <table  class="table-form">                        
                        <tr>
                           <td>Perihal surat</td>
                           <td><input type="text" name="perihal" required value="<?php echo $perihal; ?>" id="perihal" class="form-control col-lg-12" tabindex="5"></td>
                        </tr>      						
                        <tr>
                           <td>File Berkas (Scan)</td>
                           <td>
                              <input type="file" name="file_surat" class="form-control col-lg-6" tabindex="8" >
                           </td>
                        </tr>
                     </table>
                  </div>				  
				  
                  <div class="col-lg-12" style="margin-top: 20px">
                     <button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
                     <a href="<?=base_URL();?>surat/arsip" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
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