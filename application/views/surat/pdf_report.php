<html>
   <head>
      <meta content="text/html; charset=ISO-8859-1"
         http-equiv="content-type">
      <title>test</title>
   </head>
   <body>
	  <?php foreach($rs_surat->result() as $surat){}; ?>
      <img style="width: 645px; height: 189px;" alt=""
         src="<?php echo base_url();?>upload/header.png" alt="" width="737" height="154"> <br>
		 
		 <?php echo str_ireplace('{NOMOR}','___/' . $surat->no_surat,$isi_surat);?>
      <table style="text-align: left; width: 600px; height: 290px;" border="0"
         cellpadding="2" cellspacing="2">
         <tbody>
            <tr>
               <td style="vertical-align: top;">
                   <!--<?php echo str_ireplace('{NOMOR}','___/' . $surat->no_surat,$isi_surat);?>-->
				  <br>
                  <br>
                  <br>
                  <table
                     style="text-align: left; width: 203px; height: 116px; margin-left: auto; margin-right: 0px;"
                     border="0" cellpadding="2" cellspacing="2">
                     <tbody>
                        <tr>
                           <td style="vertical-align: top; text-align: center;">Dekan<br>
                              <br>
                              <img src="<?php echo base_url();?>ttd_img/<?php echo $surat->ttd;?>" alt="" width="129" height="106" /><br>
                              <br>
                              <span
                                 style="font-family: times new roman,times; font-size: small;"
                                 data-mce-style="font-family: times new roman,times; font-size: small;">
								<?php echo $surat->nama;?>
								 <br>
                              </span>
							  <span  style="font-family: times new roman,times; font-size: small;"  data-mce-style="font-family: times new roman,times; font-size: small;">
								 NIP : <?php echo $surat->nomor_induk;?>
							  </span><br>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <br>
               </td>
            </tr>
         </tbody>
      </table>     
   </body>
</html>