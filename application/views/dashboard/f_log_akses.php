<div class="row" style="margin-top: 20px">
	<div class="col-lg-12">
		<!-- /.panel -->
		<div class="panel panel-info">
			<div class="panel-heading" style="margin-bottom: 40px">
				<div class="navbar-header">
					<b class="navbar-brand"><i class="fa fa-file-o"> </i> &nbsp; Log Akses</b>
				</div>
				<ul class="nav navbar-nav pull-right">
					<li><a href="<?php echo base_url(); ?>" class="btn btn-info"><i class="fa fa-arrow-circle-left"> </i> Kembali</a></li>
				</ul>
					
				<div class="navbar-collapse collapse navbar-inverse-collapse" style="margin-bottom: 2px">
				</div><!-- /.nav-collapse -->

			</div>
			
			<!-- /.panel-heading -->
			<div class="panel-body">
				<div class="col-lg-12">
					<pre style="height: 275px; overflow: auto"><ol><?php echo $data_log; ?></ol></pre>
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