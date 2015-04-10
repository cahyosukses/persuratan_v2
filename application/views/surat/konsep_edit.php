<div class="row" style="margin-top: 20px">
   <div class="col-lg-12">
      <!-- /.panel -->
      <div class="panel panel-info">
         <div class="panel-heading">
            <div class="navbar-header">
               <b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Surat Keluar</b>
            </div>
            <div class="navbar-collapse" style="margin-bottom: 20px"></div>
            <!-- /.nav-collapse -->
         </div>
         <!-- /.panel-heading -->
         <div class="panel-body">
            <div class="col-lg-12">
                
               <form method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                  
				  <div class="col-lg-8" style="margin-top: 20px">				  
					<table class="table-form">
						<tbody>
							<tr>								
								<td>
									<textarea id="tinyMCE" name="isi_surat"><?php echo $isi_surat;?></textarea>
								</td>                                
							</tr>
                            <tr>
                                <td>
                                    <button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
                                    <a href="<?=base_URL().$admin_apps . '/' . $goto?>" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                                </td>
                            </tr>
						</tbody>
					</table>				  
				  </div>
				  <!--
                  <div class="col-lg-12" style="margin-top: 20px">
                     <button type="submit" class="btn btn-primary" tabindex="10"><i class="fa fa-check-circle"></i> Simpan</button>
                     <a href="<?=base_URL().$admin_apps?>/konsep" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                  </div>
                  -->
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
