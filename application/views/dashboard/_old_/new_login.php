<!DOCTYPE html>
<html dir="ltr" lang="id"><head>
    <meta http-equiv="Content-type" content="text/html; charset=UTF-8">    
	<link rel="stylesheet" href="<?php echo base_URL() . 'aset/'?>new_login/style.css" type="text/css">		
    <link rel="shortcut icon" href="<?php echo base_URL() . 'aset/'?>new_login/favicon.ico" type="image/x-icon">    
    <link rel="stylesheet" href="<?php echo base_URL() . 'aset/'?>new_login/validationEngine.css" type="text/css">

    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery-1.js" type="text/javascript"></script>     
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery.js" type="text/javascript"></script>
    <script src="<?php echo base_URL() . 'aset/'?>new_login/jquery_002.js" type="text/javascript"></script>        
    <script src="<?php echo base_URL() . 'aset/'?>new_login/main.js" type="text/javascript"></script>
    
    <title>Aplikasi Perkantoran Elektronik (E-Office)</title>

<body style="background-color:#d6e3ef">

	<div style="width:1000px;margin:0 auto;background-color:white;min-height:460px">
	<?php 
		$q_instansi	= $this->db->query("SELECT * FROM instansi LIMIT 1")->row();
	?>
	<img src="<?php echo base_url(); ?>upload/<?php echo $login_logo_header = empty($q_instansi->login_logo_header) ? "logo_login.jpg" : $q_instansi->login_logo_header; ?>" style="width:1000px;height:120px">
	<form id="main_form" method="POST" action="<?php echo base_URL() . 'dashboard/do_login';?>">
		<input type="hidden" name="ta" value="<?php echo date('Y'); ?>">
		<table style="width:100%;margin-top:10px">
			<tbody><tr>
				<td style="padding:20px;padding-left:50px">
					<h1>Aplikasi Perkantoran Elektronik (E-OFFICE)</h1>
					<br>
					<img src="<?php echo base_URL() . 'aset/'?>new_login/usedstamps.gif">
				</td>
				<td style="padding:20px;width:300px;">
					<div class="section">
						
					<h2>Login</h2>
					<table style="margin-left:50px">
						<tbody>
							<tr>
								<td style="vertical-align:middle;padding-right:5px">
									Username
								</td>
								<td style="vertical-align:middle">
									<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center;" name="u" id="username" size="20" class="validate[required]" required type="text">
								</td>
							</tr>
							<tr>
								<td style="vertical-align:middle;padding-right:5px">
									Password
								</td>
								<td style="vertical-align:middle">
									<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;" name="p" id="password" size="20" required type="password">
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td align="left">
									<input class="btn_login" value="Login" id="btnLogin" type="submit">
																			
									<span id="loading_gif" style="text-align:right;display:none">
									<img src="<?php echo base_URL() . 'aset/'?>new_login/loading.gif"></span>
								</td>
							</tr>
							<tr>
								<td colspan="2" height="30" align="center">
									<div id="retMessage" class="widefat" style="background-color:#de5870;color:#fff;padding:2px;margin-top:3px;display:none"></div>
								</td>
							</tr>
							
						</tbody>
					</table>

					</div>
					
				</td>
			</tr>
		</tbody></table>
		<div style="text-align:right;padding-right:10px">
		<a href="<?php echo base_URL() . 'dashboard/jejak_surat'?>">Jejak Surat</a>
		</div>
	</form>

	</div>
	<div style="width:1000px;margin:0 auto;background-color:#2c6a8b;color:white;height:100px;text-align:center;padding-top:10px">
		<h4 style="color:white">E-Office © 2015</h4>
	</div>
</body></html>