<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>E-PERSURATAN | FKIP</title>

    <!-- Core CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>aset/css/bootstrap.css" rel="stylesheet">	
    <link href="<?php echo base_url(); ?>aset/font-awesome/css/font-awesome.css" rel="stylesheet">	
	<link href="<?php echo base_url(); ?>aset/css/toggle-switch.css" rel="stylesheet">
	
    <!-- Page-Level Plugin CSS - Dashboard --
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="<?php echo base_url(); ?>aset/css/sb-admin.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>aset/js/ui/jquery-ui.css" rel="stylesheet">	
	
	
	<script src="<?php echo base_url(); ?>aset/js/jquery-1.10.2.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/ui/jquery-ui.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/jquery.chained.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/bootstrap-modal.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/bootstrap-dropdown.js"></script>
	<script src="<?php echo base_url(); ?>aset/js/bootstrap-tooltip.js"></script>
    <script src="<?php echo base_url(); ?>aset/js/plugins/metisMenu/jquery.metisMenu.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>texteditor/tiny_mce/tiny_mce.js"></script>
	

    <!-- Page-Level Plugin Scripts - Dashboard --
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?php echo base_url(); ?>aset/js/sb-admin.js"></script>
    <script type="text/javascript">
		var serverTime = <?php echo time() * 1000; ?>; //this would come from the server
		var localTime = +Date.now();
		var timeDiff = serverTime - localTime;

		setInterval(function () {
			var realtime 	= +Date.now() + timeDiff;
			var date 		= new Date(realtime);
			var hours 		= date.getHours();
			var minutes 	= date.getMinutes();
			var seconds 	= date.getSeconds();
			
			var jam			= hours < 10 ? '0' + hours : hours;
			var menit		= minutes < 10 ? '0' + minutes : minutes;
			var detik		= seconds < 10 ? '0' + seconds : seconds;
			
			// will display time in 10:30:23 format
			var waktunya = jam + ':' + menit + ':' + detik;

			$('#waktu').html(waktunya); 
		}, 1000);
	</script>
	<script type="text/javascript">
	$(document).ready(function () {
		$('a').tooltip('hide');
		$(function() {
			$( ".tag_tgl" ).datepicker({
				changeMonth: true,
				changeYear: true,
				dateFormat: 'yy-mm-dd'
			});
		});
		$('.hanya_angka').keypress(function(event) {
			var charCode = (event.which) ? event.which : event.keyCode
			if ((charCode >= 48 && charCode <= 57) || charCode == 46 || charCode == 44)
				return true;
			return false;
		});
	});
	// ]]>
	</script>
	
	 <script type="text/javascript">
		
		
		
		<?php if(!isset($show_print_button)){ ?>
		
		tinyMCE.init({
				mode : "exact",
				elements : "tinyMCE",
				theme : "advanced",
				plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : false,
				width: 755,
				height:800,
				
				//Mad File Manager				
				relative_urls : false,
				file_browser_callback : MadFileBrowser
		});
		
		<?php }else{ ?>
		<!--hai-->
		tinyMCE.init({
				mode : "textareas",
				theme : "advanced",
				plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : false,				
				width: 755,
				height:800,
				
				//Mad File Manager				
				relative_urls : false,
				file_browser_callback : MadFileBrowser
			});
		
		
		<?php } ?>
		
		function MadFileBrowser(field_name, url, type, win) {
			  tinyMCE.activeEditor.windowManager.open({
			      file : "<?php echo base_url();?>texteditor/mfm.php?field=" + field_name + "&url=" + url + "",
			      title : 'File Manager',
			      width : 640,
			      height : 450,
			      resizable : "no",
			      inline : "yes",
			      close_previous : "no"
			  }, {
			      window : win,
			      input : field_name
			  });
			  return false;
		}
		
	 </script>

</head>

<?php 
$q_instansi	= $this->db->query("SELECT * FROM instansi LIMIT 1")->row();
?>

<body>

    <div id="wrapper">
		<div style="height: 150px; border-top: solid 5px #1E4A7A; background: url(<?php echo base_url(); ?>upload/<?php echo $background_logo = empty($q_instansi->background_logo) ? "no_background.png" : $q_instansi->background_logo; ?>)">
			<div class="col-lg-2">
				<img src="<?php echo base_url(); ?>upload/<?php echo $logo = empty($q_instansi->logo) ? "no_foto.png" : $q_instansi->logo; ?>" class="" style="margin: 10px 0 0 40px; width: 120px; height: 120px">
			</div>
			<div>
				<h2>Workflow Management System (WMS) FKIP</h2>
				<h3 style="margin-top: 0px"><?php echo $nama_instansi = empty($q_instansi->nama) ? "Nama Instansi Belum Disetting" : $q_instansi->nama; ?></h3>
				<h4><b>Alamat : <?php echo $alamat_instansi = empty($q_instansi->alamat) ? "Belum Disetting" : $q_instansi->alamat; ?></b></h4>
			</div>
		</div>
		
		<?php
		    /*
				COUNT SURAT MASUK
		    */
			
			$level = $this->session->userdata('admin_level');
			$admin_id_unit		= $this->session->userdata('admin_id_unit');
			
			if ( $level === "tata usaha" || $level === 'staff') {
				
				$a	= $this->db->query("SELECT COUNT(surat_masuk.id) as belum_dibaca,
											  (SELECT COUNT(surat_masuk.id)
											   FROM surat_masuk
											   WHERE flag_del = 'Y') as total_surat
										FROM surat_masuk									
										WHERE flag_del = 'Y' AND flag_read = 'N'");
				
			}else if($level === "pimpinan"){
				
				if(empty($admin_id_unit)){
					$a	= $this->db->query("SELECT COUNT(surat_masuk.id) as belum_dibaca,
											  (SELECT COUNT(surat_masuk.id)
											   FROM surat_masuk
											   WHERE flag_del = 'Y') as total_surat
										FROM surat_masuk									
										WHERE flag_del = 'Y' AND flag_read = 'N'");
				}else{
					$wh = empty($admin_id_unit) ? " WHERE " : "WHERE penerima = '".$admin_id_unit."' AND ";
					$a	= $this->db->query("SELECT COUNT(surat_masuk.id) as belum_dibaca,
												  (SELECT COUNT(surat_masuk.id)
												   FROM surat_masuk
												   WHERE penerima = '".$admin_id_unit."' AND flag_del = 'Y'
												   ) as total_surat
											FROM surat_masuk									
											$wh flag_del = 'Y' AND flag_read = 'N'");	
				}					
				
			}
			
			
			if($level !== "admin root"){
				$jml_surat_belum_baca =  $a->row()->belum_dibaca;
				$total_surat = $a->row()->total_surat;	
			}
			
		?>
		
		<?php
		/*
			COUNT KONSEP
		*/
		
		$level = $this->session->userdata('admin_level');
		$admin_id = $this->session->userdata('admin_id');
		$admin_id_unit	= $this->session->userdata('admin_id_unit');
		
		if ($level === "tata usaha") {
				
				$a		= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_konsep
											FROM surat_keluar 
											WHERE IF(flag_revisi = 'Y',flag_setuju = 'N',flag_setuju = 'Y') AND
											      flag_keluar = 'N' ");
				
			} else if ($level === "staff") {
				
				$a		= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_konsep
										    FROM surat_keluar 
											WHERE (flag_keluar = 'N'
													OR flag_keluar = 'Y')
											        AND pemeriksa = '".$admin_id_unit."'
													AND pemeriksa_user = '".$admin_id."'");
				
			} else {
				
				if(empty($admin_id_unit)){
					
					$a		= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_konsep,
												   (SELECT COUNT(surat_keluar.id) 
												    FROM surat_keluar
													WHERE flag_setuju = 'Y' AND flag_keluar = 'N'
													AND (pemeriksa = '".$admin_id_unit."' 
														  OR pemeriksa_user = '".$admin_id."')
												   ) as jml_konsep_setuju
										    FROM surat_keluar 
											WHERE (flag_keluar = 'N')
											AND (pemeriksa_user = '".$admin_id."')");
				}else{
					
					$a		= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_konsep,
												   (SELECT COUNT(surat_keluar.id) 
												    FROM surat_keluar
													WHERE (flag_setuju = 'Y' AND flag_keluar = 'N')
														  AND (pemeriksa = '".$admin_id_unit."' 
														  OR pemeriksa_user = '".$admin_id."')
												   ) as jml_konsep_setuju
										    FROM surat_keluar 
											WHERE flag_keluar = 'N'
												  AND (pemeriksa_user = '".$admin_id."')");
					
				}
				
				
			}
			
			$jml_konsep = empty($a->row()->jml_konsep) ? 0 : $a->row()->jml_konsep;
			$jml_konsep_setuju = empty($a->row()->jml_konsep_setuju) ? 0 : $a->row()->jml_konsep_setuju	 ;
			$jml_konsep_belum_setuju = $jml_konsep - $jml_konsep_setuju;
		
		?>
		
		<?php
		/*
			COUNT SURAT KELUAR
		*/
			$level = $this->session->userdata('admin_level');
			$admin_id = $this->session->userdata('admin_id');
			$admin_id_unit	= $this->session->userdata('admin_id_unit');
		
			if ($level == "tata usaha") {
				$a	= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_surat_keluar
									    FROM surat_keluar 
										WHERE flag_setuju = 'Y' AND flag_keluar = 'Y'");
			} else {
				$a	= $this->db->query("SELECT COUNT(surat_keluar.id) as jml_surat_keluar
									    FROM surat_keluar 
										WHERE flag_setuju = 'Y' AND flag_keluar = 'Y' AND pengirim = '".$admin_id_unit."'");
			}
			
			$jml_surat_keluar = $a->row()->jml_surat_keluar;
		?>
		
		
        <nav class="navbar navbar-default navbar-static-top  sidebar-collapse" role="navigation" style="margin-bottom: 0; z-index: initial">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- /.navbar-header -->
			
            <ul class="nav navbar-top-links">
				<!--<li style="font-weight: bold; color: #fff; margin: 13px 20px 0 20px">
				<?php echo tgl_jam_sql(date('Y-m-d')); ?> <div style="display: inline" id="waktu"></div>
				</li>-->
				
				<li style="margin-left: 10px"><a href="<?php echo base_URL(); ?>" title="(i) Kembali ke halaman Dashboard (Halaman depan)"><i class="fa fa-home" style="font-size: 20px"> </i>  </a></li>

				<?php 
				$admin_nama		= $this->session->userdata('admin_nama');	
				$admin_level	= $this->session->userdata('admin_level');
				$admin_id_unit	= $this->session->userdata('admin_id_unit');
				$admin_apps		= $this->session->userdata('admin_apps');
				$unit			= gval("unit","kode_gabung","nama_unit",$admin_id_unit);
				
				
				if (!empty($menu->id_menu)) {
					$pc_jumlah_menu = explode(",",$menu->id_menu);
					$jumlah_menu	= count($pc_jumlah_menu);
					
					for ($i = 0; $i < ($jumlah_menu-1); $i++) {
						$url	= gval("menu", "id", "url", $pc_jumlah_menu[$i]);
						$ico	= gval("menu", "id", "icon", $pc_jumlah_menu[$i]);
						$nama	= gval("menu", "id", "nama", $pc_jumlah_menu[$i]);
						//HACK-----------------
						if($nama === 'S. Masuk'){
							
							echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.' { '. $jml_surat_belum_baca . ' / ' . $total_surat . ' }</a></li>';
							
						}else if($nama === 'Konsep'){
							
							if ($level === "tata usaha") {
								
								echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.' { ' . $jml_konsep . ' }</a></li>';
								
							} else if ($level === "staff") {
								
								echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.' { ' . $jml_konsep . ' }</a></li>';
								
							}else{
								
								echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.' { ' . $jml_konsep_belum_setuju . ' / ' .   $jml_konsep . ' }</a></li>';
								
							}
							
						}else if($nama === "S. Keluar"){
							echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.' { ' . $jml_surat_keluar . ' }</a></li>';	
						}else{
							echo '<li><a href="'.base_URL().$admin_apps.'/'.$url.'" title="(i) Klik disini untuk melihat data '.$nama.'"><i class="fa fa-'.$ico.'"> </i> '.$nama.'</a></li>';	
						}
						//END HACK-
						
					}
				}
				
				$level = $this->session->userdata('admin_level');
				
				if ($admin_apps == "surat" && $level !== 'staff' && $level ==='tata usaha') {
				?>
				
				<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-th-list"></i> Per Jenis Surat <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
						<?php
						$jenis_sk	= $this->db->query("SELECT * FROM r_jenis_surat ORDER BY id ASC")->result();
						if (!empty($jenis_sk)) {
							foreach ($jenis_sk as $js) {
						?>
							<li><a tabindex="-1" href="<?php echo base_url().$admin_apps?>/per_jenis_surat/<?php echo $js->id; ?>"><i class="fa fa-th-list"> </i> <?php echo $js->nama; ?></a></li>
						<?php 
							}
						}
						?>
						
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
				<?php } ?>
				<li class="dropdown pull-right">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <?Php echo $admin_nama." (".strtoupper($admin_level).")"; ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                       <li><a tabindex="-1" href="<?php echo base_url()?>dashboard/passwod"><i class="fa fa-wrench"> </i> Ubah Password</a></li>
                       <li><a tabindex="-1" href="<?php echo base_url()?>dashboard/log_akses"><i class="fa fa-exchange"> </i> Log Akses</a></li>
                       <li><a tabindex="-1" href="<?php echo base_url()?>dashboard/upload_ttd"><i class="fa fa-file-o"> </i> Upload Gambar TTD</a></li>
					   <li><a tabindex="-1" href="<?php echo base_url()?>dashboard/status_kehadiran"><i class="fa fa-user"> </i> Status Kehadiran</a></li>					   
					   <li><a tabindex="-1" href="<?php echo base_url()?>dashboard/logout"><i class="fa fa-sign-out"> </i> Logout</a></li>
					   
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->

            </ul>
            <!-- /.navbar-top-links -->

        </nav>
        <!-- /.navbar-static-top -->

        <?php $this->load->view($page); ?>


    </div>
    <!-- /#wrapper --
	<div style="padding: 10px 20px; width: 100%; background: #327ABD; color: #fff; position: fixed; bottom: 0; z-index: 1000">
	Username : <b><?php echo $this->session->userdata('admin_user'); ?></b> | 
	Jabatan : <b><?php echo $this->session->userdata('admin_jabatan'); ?></b> | 
	Satuan Kerja : <b>
	<?php 
	$id_unit		= $this->session->userdata('admin_id_unit');
	echo gval("unit", "kode_gabung", "nama_unit", $id_unit); 
	//echo $id_unit;
	?></b> | 
	
	<!--Load in {elapsed_time} second. Memory Usage {memory_usage} MB. --Aplikasi TNDE <b>&copy; 2014</b></div>
    <!-- Core Scripts - Include with every page -->

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference --
    <script src="js/demo/dashboard-demo.js"></script>-->
	<script type="text/javascript">
	/* hanya boleh Angka */
	$(document).ready(function () {
		/* Modal */
		(function(){
		   var bsModal = null;
		   $("[data-toggle=modal]").click(function(e) {
			  e.preventDefault();
			  var trgId = $(this).attr('data-target'); 
			  if ( bsModal == null ) 
			   bsModal = $(trgId).modal;
			  $.fn.bsModal = bsModal;
			  $(trgId + " .modal-body").load($(this).attr("href"));
			  $(trgId).bsModal('show');
			});
		 })();
	});
	/* <![CDATA[ */
	
	
	</script>	

</body>

</html>

