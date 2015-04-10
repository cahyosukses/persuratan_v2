<!DOCTYPE html>
<html>

<head>
    <link rel="icon" type="image/gif" href="<?php echo base_url();?>aset/img/favicon.gif">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-PERSURATAN | FKIP</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>aset/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>aset/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard --
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>aset/css/sb-admin.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>aset/js/jquery-1.10.2.js"></script>
<body style="">
	<p>
	  <?php 
	$q_instansi	= $this->db->query("SELECT * FROM instansi LIMIT 1")->row();
	?>
    </p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<div class="row">
	<div class="col-lg-4"></div>
	<div class="col-lg-4">
		<div style="text-align: center;"><!-- /.panel -->
		<img src="<?php echo base_url(); ?>upload/<?php echo $logo = empty($q_instansi->logo) ? "no_foto.png" : $q_instansi->logo; ?>" class="" style="margin: 10px 0 -15px 0; width: 100px; height: 100px;">
		
		<div style="">
			<h2 style="font-size: 18px; margin-bottom: 5px"><strong>e-Persuratan</strong>
			  <!--<h4 style="font-size: 14px"><b>Alamat : <?php echo $alamat_instansi = empty($q_instansi->alamat) ? "Belum Disetting" : $q_instansi->alamat; ?></b></h4>-->
		</h2>
			<p style="font-size: 18px; margin-bottom: 5px"><strong>Universitas Jambi</strong></p>
		</div>
	  </div>
		
		<div class="panel panel-info">
			<div class="panel-heading">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-lock"> </i> &nbsp; Login Admin</b>
				</div>
				<div class="navbar-collapse" style="margin-bottom: 20px"></div><!-- /.nav-collapse -->
			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="row">
					<div class="col-lg-12">
						<div class="table-responsive">
						<!-- MULAI -->
							<?php echo form_open('dashboard/do_login'); ?>
							<?=$this->session->flashdata("k")?>
							<input type="hidden" name="ta" value="<?php echo date('Y'); ?>">
							<table align="center" class="table-form" width="100%">
								<tr><td width="50%">Username</td><td><input type="text" name="u" required autofocus class="form-control col-lg-12" placeholder="Username ... " tabindex="1"></td></tr>
								<tr><td>Password</td><td><input type="password" name="p" required class="form-control col-lg-12" placeholder="Password ... " tabindex="2"></td></tr>
								<!--<tr><td>Tahun</td><td><select name="ta" class="form-control col-lg-12" required tabindex="3"><option value="">--</option>
								<?php 
								for ($i = 2012; $i <= (date('Y')); $i++) {
									if (date('Y') == $i) {
										echo "<option value='$i' selected>$i</option>";
									} else {
										echo "<option value='$i'>$i</option>";
									}
								}
								?>
								</select>
								</td></tr>-->
								<tr><td></td><td><input type="submit" class="btn btn-success" value="Login" tabindex="5"></td></tr>
							</table>
							<?php echo form_close(); ?>

							<!-- AKHIR -->
							</div>
						<!-- /.table-responsive -->
					</div>
				</div>
				<!-- /.row -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
		<div class="ctr">Copyright &copy; FKIP 2014</div>	
	</div>
	<!-- /.col-lg-4 -->
	<div class="col-lg-4"></div>
</div>
<!-- /.row -->
	
	<script type="text/javascript">
	$(document).ready(function(){
		$(" #alert" ).fadeOut(6000);
	});
	</script>
	<!-- Core Scripts - Include with every page -->
	<script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard --
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo base_url(); ?>aset/js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference --
    <script src="js/demo/dashboard-demo.js"></script>-->

</body>

</html>


</body></html>
