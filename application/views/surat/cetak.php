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
                <?php foreach($rs_surat->result() as $surat){}; ?>
                
               <form method="post" accept-charset="utf-8" enctype="multipart/form-data" autocomplete="off">
                  
				  <div class="col-lg-8" style="margin-top: 20px">				  
					<table class="table-form">
						<tbody>
                            <tr>
                                <td>
                                    <a href="<?=base_URL().$admin_apps . '/' . $goto;?>" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
									<a href="" onclick="tinyMCE.activeEditor.execCommand('mcePrint');" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Cetak</a>
                                </td>
                            </tr>

							<tr>								
								<td>
									<textarea name="isi_surat" id="tinyMCE">
                                        <p style="text-align: center;"><span style="font-family: 'arial black', 'avant garde'; font-size: large;"><strong><img src="<?php echo base_url();?>upload/header.png" alt="" width="737" height="154" /></strong></span></p>
                                        <table style="width:700px" border="0px solid #ffffff;" cellpadding="20" >
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left;">
													<?php echo 'Nomor:' . $surat->no_surat; ?><br>
													<?php echo 'Lampiran:'; ?><br>
													<?php echo 'Perihal:' . $surat->perihal; ?><br>
                                                    <!--str_ireplace('{NOMOR}','___/' . $surat->no_surat,$isi_surat);-->
													
                                                    </td>
                                                </tr>
												<tr>
												   <td><?php echo $surat->isi_surat;?></td>
												</tr>
                                            </tbody>
                                        </table>    
                                        
                                        <p style="text-align: left;">&nbsp;</p>
										<table style="float: right; border-color: #ffffff; border-width: 0px; border-style: solid; width: 256px; height: 229px;" border="0px" cellpadding="50">
										  <tbody>
											 <tr>
												<td>
												   <p style="text-align: center;"><span style="font-family: times new roman,times; font-size: small;">Dekan</span></p>
												   <p><span style="font-family: times new roman,times; font-size: small;"><img src="<?php echo base_url();?>ttd_img/<?php echo $surat->ttd;?>" alt="" width="129" height="106" /></span></p>
                                                        <p><span style="font-family: times new roman,times; font-size: small;"><?php echo $surat->nama;?></span></p>
                                                        <p><span style="font-family: times new roman,times; font-size: small;">NIP : <?php echo $surat->nomor_induk;?></span></p>                                                        
												</td>
											 </tr>
										  </tbody>
									   </table>
                                    </textarea>
								</td>                                
							</tr>
                            <!--<tr>
                                <td>
                                    <a href="<?=base_URL().$admin_apps . '/' . $goto;?>" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
									<a href="" onclick="tinyMCE.activeEditor.execCommand('mcePrint');" class="btn btn-success" tabindex="11"><i class="fa fa-arrow-circle-left"></i> Cetak</a>
                                </td>
                            </tr>-->
							
						</tbody>
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
