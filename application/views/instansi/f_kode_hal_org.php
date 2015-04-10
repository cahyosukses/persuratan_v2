<?php
  
  $mode	= $this->uri->segment(3);
  
  if($mode === 'edit' || $mode === 'aksi_edit'){
        
    $id = $datdet->id;
    $kode = $mode === 'edit' ? $datdet->kode : set_value('kode');
    $nama = $mode === 'edit' ? $datdet->nama : set_value('nama');
    $keterangan = $mode === 'edit' ? $datdet->keterangan : set_value('keterangan');    
    
    $act = 'aksi_edit/' . $id;
    
  }else{
    
    $kode = $mode === 'add' ? '' : set_value('kode');
    $nama = $mode === 'add' ? '' : set_value('nama');
    $keterangan = $mode === 'add' ? '' : set_value('keterangan');
    
    $act = 'aksi_add';    
  }

?>

<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Kode Hal Organisasi</b>
            </div>
            <div class="navbar-collapse" style="margin-bottom: 20px"></div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="col-lg-12">
               <?php echo $this->session->flashdata("k");?>
			   
               <form action="<?=base_URL().$admin_apps?>/kode_hal_org/<?php echo $act; ?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                  
                  <div class="col-lg-12">                     
                     <table width="100%" class="table-form" align="center">
                        <tr>
                           <td>Kode</td>
                           <td>
                              <input type="text" name="kode" class="form-control col-lg-3" required style="width: 400px" value="<?php echo $kode; ?>">                              
                           </td>
                        </tr>
						<tr>
							<td>Nama</td>
							<td>
								<input type="text" name="nama" class="form-control col-lg-3" required style="width: 400px" value="<?php echo $nama; ?>">
							</td>
						</tr>
						
						<tr>
							<td>Keterangan</td>
							<td>
								<textarea name="keterangan" class="form-control col-lg-3" required style="width: 400px; height: 148px;"><?php echo $keterangan; ?></textarea>
							</td>
						</tr>
                        <tr>
                           <td colspan="2">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"> </i> Simpan</button>
                              <a href="<?=base_URL().$admin_apps?>/kode_hal_org" class="btn btn-success"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
                           </td>
                        </tr>
                     </table>
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
