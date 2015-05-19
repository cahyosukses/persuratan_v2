<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <title>Sistem Informasi Tata Persuratan</title>
      <link href="<?php echo base_URL() . 'aset/'?>login_v2/webicon.ico" rel="shortcut icon" type="image/x-icon">
      <meta name="robots" content="index, follow">
      <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
      <meta name="author" content="RapidxHTML">
      <link href="<?php echo base_URL() . 'aset/'?>login_v2/style.css" rel="stylesheet" type="text/css">
      <script language="javascript" src="<?php echo base_URL() . 'aset/'?>login_v2/jquery.js"></script>
      <script language="javascript" src="<?php echo base_URL() . 'aset/'?>login_v2/global.js" type="text/javascript"></script>
      <script language="javascript" type="text/javascript">
         function setFocus() 
         {
         	document.xlogin.xusername.select();
         	document.xlogin.xusername.focus();
         }
         
      </script>
      <script type="text/javascript" src="<?php echo base_URL() . 'aset/'?>login_v2/jquery_002.js"></script>
      <script type="text/javascript" src="<?php echo base_URL() . 'aset/'?>login_v2/easySlider1.js"></script>
      <script type="text/javascript">
         $(document).ready(function()
         {
         	$("#slider").easySlider(
         	{
         		auto: true, 
         		continuous: true,
         		numeric: true
         	});
         });
         
      </script>
      <link href="<?php echo base_URL() . 'aset/'?>login_v2/screen.css" rel="stylesheet" type="text/css" media="screen">
      <script>try {  for(var lastpass_iter=0; lastpass_iter < document.forms.length; lastpass_iter++){    var lastpass_f = document.forms[lastpass_iter];    if(typeof(lastpass_f.lpsubmitorig)=="undefined"){      if (typeof(lastpass_f.submit) == "function") {        lastpass_f.lpsubmitorig = lastpass_f.submit;        lastpass_f.submit = function(){          var form = this;          try {            if (document.documentElement && 'createEvent' in document)            {              var forms = document.getElementsByTagName('form');              for (var i=0 ; i<forms.length ; ++i)                if (forms[i]==form)                {                  var element = document.createElement('lpformsubmitdataelement');                  element.setAttribute('formnum',i);                  element.setAttribute('from','submithook');                  document.documentElement.appendChild(element);                  var evt = document.createEvent('Events');                  evt.initEvent('lpformsubmit',true,false);                  element.dispatchEvent(evt);                  break;                }            }          } catch (e) {}          try {            form.lpsubmitorig();          } catch (e) {}        }      }    }  }} catch (e) {}</script>
   </head>
   <body>
   	<?php 
		$q_instansi	= $this->db->query("SELECT * FROM instansi LIMIT 1")->row();
	?>
      <div class="rapidxwpr floatholder">
         <div id="header">
            <a href="<?php echo base_URL();?>">
            	<img id="logo" class="correct-png" src="<?php echo base_URL();?>upload/<?php echo $login_logo_header = empty($q_instansi->login_logo_header) ? "logo_login.jpg" : $q_instansi->login_logo_header; ?>" alt="Home" title="Home">
            </a>
         </div>
         <div id="middle">
            <div class="main-image">
               <img src="" alt="">
            </div>
            <div id="main" class="clearingfix">
               <div id="mainmiddle" class="floatbox">
                  <div id="right" class="clearingfix">
                     <div class="benefits">
                        <div class="benefits-bg clearingfix">
                           <h4><font size="+1"><b>Login</b></font></h4>
                           <form name="xlogin" id="form-login" method="post" action="<?php echo base_URL() . 'dashboard/do_login';?>">
                              <table>
                                 <tbody>
                                    <tr>
                                       <td>Nama Pengguna&nbsp;</td>
                                       <td>&nbsp;<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;" name="u" id="username" class="inputbox" size="25" type="text"></td>
                                    </tr>
                                    <tr>
                                       <td>Kata Sandi&nbsp;</td>
                                       <td>&nbsp;<input style="background-image: url(&quot;data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=&quot;); background-repeat: no-repeat; background-attachment: scroll; background-position: right center; cursor: auto;" name="p" id="password" class="inputbox" size="25" type="password"></td>
                                    </tr>
                                    <tr>
                                       <td>&nbsp;</td>
                                       <td>
                                          <input style="border: 0pt none ; margin: 0pt; padding: 0pt; width: 0px; height: 0px;" value="Login" type="submit">
                                          <input name="xlogin" value="28B60A2D" type="hidden">
                                          <div class="button2-left">
                                             <div class="next">
                                                <a onclick="Btn_Submit('xlogin');">Login</a>
                                             </div>
                                          </div>

                                          <div class="button2-left" style="margin-left:50px">
                                             <div class="next">
                                                <a href="<?php echo base_URL() . 'dashboard/jejak_surat'?>">Jejak Surat</a>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>                              
                           </form>
                           <h5>&nbsp;</h5>
                        </div>
                     </div>
                  </div>
                  <div id="content" class="clearingfix">
                     <div class="floatbox">
                        <div class="box">
                           <div class="box-bg">
                              <div id="container">
                                 <div id="judul">
                                    <h1></h1>
                                    <h1 style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif ; color:#555555">Selamat Datang<br>
                                       <span><font style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif" size="3" color="#555555"><b>di Sistem Informasi Tata Persuratan</b></font><b><br>
                                       </b>
                                       </span>
                                    </h1>
                                    <b></b>
                                 </div>
                                 <b>
                                    <div id="isi">
                                       <div id="slider">
                                          <ul>
                                             <li><a href=""><img src="<?php echo base_URL() . 'aset/'?>login_v2/01x.jpg" alt=""></a></li>
                                             <li><a href=""><img src="<?php echo base_URL() . 'aset/'?>login_v2/01x.jpg" alt=""></a></li>
                                             <li><a href=""><img src="<?php echo base_URL() . 'aset/'?>login_v2/01x.jpg" alt=""></a></li>                                             
                                          </ul>
                                       </div>
                                       <!--
                                       <ol id="controls">
                                          <li class="current" id="controls1"><a rel="0" href="javascript:void(0);">1</a></li>
                                       </ol>
                                       -->
                                    </div>
                                 </b>
                              </div>
                              <b>
                              </b>
                           </div>
                           
                           <b>
                           </b>
                        </div>
                        <b>
                        </b>
                     </div>
                     <b>
                     </b>
                  </div>
                  <b>
                  </b>
               </div>
               <b>
               </b>
            </div>
            <b>
            </b>
         </div>
         <b>
         </b>
      </div>
      <b>
         <!--
         <div class="rapidxwpr">
            <div id="footer" class="clearingfix">
               <div style="font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif">
                  <a href="<?php echo base_URL();?>"><font color="#555555">E-Office - 2015</font></a>
               </div>
            </div>
         </div>
         -->
      </b>
   </body>
</html>