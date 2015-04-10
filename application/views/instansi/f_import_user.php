<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading">				
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Upload Data Pengguna</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
			  <div class="col-lg-12">
                
                <?php if(isset($msg)):?>
                <div id="alert" class="alert alert-danger"><?php echo $msg;?></div>
                <?php endif;?>
                  
				<form action="<?=base_URL();?>instansi/atur_user/aksi_import" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="col-lg-10">
					<table width="100%" class="table-form">
					
                    
                      <input name="hidden_input" value="hidden_val" type="hidden">
                           
                      <tr>
                        <td width="20%">File Data (*.xls)</td>
                        <td><input type="file" name="userfile"  style="width: 300px" class="form-control" tabindex="3"></td>
                      </tr>
                      <tr>
                        <td colspan=2>
                        <p>
                          * Berikut ini adalah format import data (*.xls) <br>
                          ** data dimulai dari baris ke 2 (baris pertama berisi header) <br>
                          ** berikut ini merupakan urutan kolom beserta nilainya
                        </p>  
                        </td>                        
                      </tr>
                      <tr>
                        <td bgcolor="#FFFF66">Urutan Kolom</td>
                        <td bgcolor="#FFFF99">Nama Kolom</td>
                        <td bgcolor="#FFFFCC">Keterangan Nilai</td>
                      </tr>
                      <tr>
                        <td>Kolom ke 1</td>
                        <td>nama_unit (Nama unit kerja)</td>
                        <td>
                            <?php $r_unit = $this->db->query("SELECT nama_unit FROM unit");?>
                            <?php foreach($r_unit->result() as $unit){ ?>
                            <br><?=$unit->nama_unit;?>                             
                            <?php } ?><br>
                            * pilih salah satu
                        </td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 2</td>
                        <td>Nama</td>
                        <td>Nama lengkap pengguna</td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 3</td>
                        <td>Nomor Induk</td>
                        <td>Nomor induk pengguna</td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 4</td>
                        <td>Jabatan</td>
                        <td>Jabatan pengguna</td>
                      </tr>
                      <!--
                      <tr>
                        <td>Kolom ke 5</td>
                        <td>Jenjang (Jenjang pendidikan terakhir pengguna)</td>
                        <td>S1 , S2 , S3 <br>*pilih salah satu</td>
                      </tr>
                      -->
                      <tr>
                        <td>Kolom ke 5</td>
                        <td>User Name</td>
                        <td>username pengguna untuk login<br>*Jika data baru maka password = username</td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 6</td>
                        <td>Level</td>
                        <td>admin root , pimpinan , tata usaha , staff <br>*pilih salah satu</td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 7</td>
                        <td>Set Aplikasi</td>
                        <td>instansi , aset , surat <br>*pilih salah satu</td>
                      </tr>
                      
                      <tr>
                        <td>Kolom ke 8</td>
                        <td>Email</td>
                        <td>Alamat email pengguna</td>
                      </tr>
                      
                      <tr>
                        <td colspan="2">
                        <br>
                        <button type="submit" class="btn btn-primary" tabindex="4"><i class="fa fa-hdd-o"> </i> Upload</button>
                        <a href="<?=base_URL() . 'instansi/atur_user'?>" class="btn btn-success" tabindex="5"><i class="fa fa-arrow-circle-left"> </i> Kembali</a>
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
<!-- /.row -->
