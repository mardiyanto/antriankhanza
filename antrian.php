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
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/default.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="conf/validator.js"></script>
    <title>Jadwal Praktek Dokter</title>
    <script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
    <script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>

  <!-- Google Font: Source Sans Pro -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="tema/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- Theme style -->
  <link rel="stylesheet" href="tema/css/adminlte.min.css">
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>
<?php        $token      = trim(isset($_GET['iyem']))?trim($_GET['iyem']):NULL;
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
            
        
		?>
$(document).ready(function(){
	setInterval(function(){
		$("#screen").load('<?php echo"getantrol.php?iyem=".encrypt_decrypt("{\"kd_poli\":\"".$kd_poli."\",\"kd_dokter\":\"".$kd_dokter."\"}","e")."";?>')
    }, 2000);
});
</script>
</head>
<body class="hold-transition">
<div class="wrapper">
  <!-- Navbar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper1">
<!-- Main content -->
    <section class="content">
        <div class="row">
		<div class="col-md-6" id="screen"></div>
		
          <div class="col-md-6">
  <div class="card card-widget">
              <div class="card-header">
           
                 
                  <span class="username"><a href="#">video</a></span>
          
            
                <!-- /.user-block -->
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" title="Mark as read">
                    <i class="far fa-circle"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <a href="poli.php" btn btn-default data-card-widget="remove">
                   KEMBALI
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
  <video width="100%" height="100%" controls autoplay>
            <source src="jkn.mp4" type="video/mp4"></video>



              </div>
            
            </div>
          </div>
          <!-- /.col -->

          <!-- /.col -->
        </div>
        <!-- /.row -->

      
</div>
<!-- ./wrapper -->


</body>
</html>

