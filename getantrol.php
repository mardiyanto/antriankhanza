<?php
$bg_array = array("#CEED9D","#ECED9D","#EDCF9D","#EC9CA7","#ED9DD0","#EE9DE2","#D69DEC","#9E9CEC");
$bg = array_rand($bg_array,1);
?>
<?php
 session_start();
 require_once('conf/conf.php');
 header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT"); 
 header("Cache-Control: no-store, no-cache, must-revalidate"); 
 header("Cache-Control: post-check=0, pre-check=0", false);
 header("Pragma: no-cache"); // HTTP/1.0
 $tanggal= mktime(date("m"),date("d"),date("Y"));
 date_default_timezone_set('Asia/Jakarta');
 $jam=date("H:i");
?>
	<script type="text/javascript">
		AC_AX_RunContent( 'width','32','height','32' ); //end AC code
	</script>
	<noscript>
       <object width="32" height="32">
         <embed width="32" height="32"></embed>
       </object>
     </noscript>
<div class="banner"  >
          <div >
            <!-- Box Comment -->
            <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="tema/img/user1-128x128.jpg" alt="User Image">
                  <span class="username" style="background-color:<?php echo $bg_array[$bg];?>;"> RS WISMARINI PRINGSEWU</span>
                </div>
                <!-- /.user-block -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" title="Mark as read">
                    <i class="far fa-circle"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- post text -->
                <?php
        $token      = trim(isset($_GET['iyem']))?trim($_GET['iyem']):NULL;
        $token      = json_decode(encrypt_decrypt($token,"d"),true);
        $kd_poli    = "";
        $kd_dokter  = "";
        if (isset($token["kd_poli"])) {
            $kd_poli    = $token["kd_poli"];
            $kd_dokter  = $token["kd_dokter"];
        }else{
            exit(header("Location: https://www.google.com"));
        }
        
        $kd_poli    = validTeks4($kd_poli,20);
        $kd_dokter  = validTeks4($kd_dokter,20);
            
        $setting    = mysqli_fetch_array(bukaquery("select setting.nama_instansi,setting.alamat_instansi,setting.kabupaten,setting.propinsi,setting.kontak,setting.email,setting.logo from setting"));
        echo "   
           <table class='table' width='100%' align='center' border='0' class='tbl_form' cellspacing='0' cellpadding='0'>
                  <tr>
            
                        <td>
                           <center>
                        
                                  <font size='5'  face='Tahoma' >Antrian Poli ".getOne("select nm_poli from poliklinik where kd_poli='".$kd_poli."'").", Dokter ".getOne("select nm_dokter from dokter where kd_dokter='".$kd_dokter."'")."<br> ".date("d-M-Y", $tanggal)."  ". $jam."</font>
                                  <br><br>
                           </center>
                        </td>   
                                                             
                 </tr>
          </table> "; 
    ?>
    <table width='100%' bgcolor='FFFFFF' border='0' align='center' cellpadding='0' cellspacing='0'>
         <tr class='head5'>
           <td width='100%'><div align='center'>PANGILAN ATAS NAMA :</div></td>
         </tr>
    </table>
    <table class='table' border='0' witdh='100%' cellpadding='0' cellspacing='0'>
        <tr class='head2' border='0'>
            <td width='64%' align='center'>
            <?php 
                $_sql="select * from antripoli where antripoli.kd_poli='".$kd_poli."' and antripoli.kd_dokter='".$kd_dokter."'" ;  
                $hasil=bukaquery($_sql);
                while ($data = mysqli_fetch_array ($hasil)){
                    echo "<font size='8' color='#DD0000'><b>".getOne("select concat(reg_periksa.no_reg,' ',pasien.nm_pasien) from reg_periksa inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis where reg_periksa.no_rawat='".$data['no_rawat']."'")."</b></font>";
                    if($data['status']=="1"){
                        echo "<audio autoplay='true' src='bell.wav'>";
                        bukaquery2("update antripoli set antripoli.status='0' where antripoli.kd_poli='".$kd_poli."' and antripoli.kd_dokter='".$kd_dokter."'");
                    }   
                }
            ?>
            </td>
        </tr>
        </tr>
    </table>    
    <table class='table' width='100%' bgcolor='FFFFFF' border='0' align='center' cellpadding='0' cellspacing='0'>
        <tr class='head4'>
          <td width='10%'><div align='center'><font size='5'><b>NO</b></font></div></td>
          <td width='65%'><div align='center'><font size='5'><b>NAMA PASIEN</b></font></div></td>
        </tr>
        <?php  
                $_sql="select reg_periksa.no_reg,reg_periksa.no_rawat,pasien.nm_pasien 
                       from reg_periksa inner join pasien on reg_periksa.no_rkm_medis=pasien.no_rkm_medis
                       where reg_periksa.kd_poli='".$kd_poli."' and reg_periksa.kd_dokter='".$kd_dokter."' 
                       and reg_periksa.tgl_registrasi='".date("Y-m-d", $tanggal)."' and stts='Belum' order by reg_periksa.no_reg" ;  
                $hasil=bukaquery($_sql);

                while ($data = mysqli_fetch_array ($hasil)){
                        echo "<tr class='isi7' >
                                <td align='center'><font size='5' color='gray' face='Tahoma'>".$data['no_reg']."</font></td>
                       
                                <td align='center'><font color='gren' size='5'  face='Tahoma'>".$data['nm_pasien']."</font></td>
                            </tr> ";
                }
        ?>
    </table>
    <table width='100%' bgcolor='FFFFFF' border='0' align='center' cellpadding='0' cellspacing='0'>
         <tr class='head5'>
              <td width='100%'><div align='center'></div></td>
         </tr>
    </table>
                
              </div>
              <!-- /.card-body -->
           
            </div>
            <!-- /.card -->
          </div>
</div>
