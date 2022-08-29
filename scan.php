<?php
require_once "controluserdata.php";
require_once "check.php";

    $sql = "SELECT * FROM userdata WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $currentid = $row['id'];
    $riderinfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rider_info WHERE riders_id = '$currentid'"));

    $date = $riderinfo['time_in'];
    $out = $riderinfo['cashout_status'];
    $lic = $riderinfo['verify_status'];


if(empty($date) ){
    echo '<style> video{
        display: none;
        margin: 0 20px;
    } </style>' . '<h3> Time In first! </h3>';
}elseif($out == 'Pending' || $lic != "verified" ){
    echo '<style> video{
        display: none;
        margin: 0 20px;
    } </style>' . '<h3> Wait admin to activate your account </h3>';
}
else{
    echo '<style> .form{
        display: block;
    } </style>';
}
 ?>


<html>
    <head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	  <title>QR Code | Log in</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <title>Resume - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/rider.css" rel="stylesheet" />
        <style>
         .box {
         background: transparent;
         position: relative;
         width:auto;
         }
         .frame {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         border: 5px solid #e9e9e9;
         z-index: 3;
         }
         .preview{
         width:300px;
         border-radius:10px;
         border:10px solid;
         border-style: outset;
         box-shadow: 0px 1px 2px #eee, 0px 2px 2px #e9e9e9, 0px 3px 2px #ccc, 0px 4px 2px #c9c9c9, 0px 5px 2px #bbb, 0px 6px 2px #b9b9b9, 0px 7px 2px #999, 0px 7px 2px rgba(0, 0, 0, 0.5), 0px 7px 2px rgba(0, 0, 0, 0.1), 0px 7px 2px rgba(0, 0, 0, 0.73), 0px 3px 5px rgba(0, 0, 0, 0.3), 0px 5px 10px rgba(0, 0, 0, 0.37), 0px 10px 10px rgba(0, 0, 0, 0.1), 0px 20px 20px rgba(0, 0, 0, 0.1);
         }
            .disclaimer{display:none;}
       
      </style>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                <span class="d-none d-lg-block">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rider.php">Profile</a></li>
                    <li class="nav-item" <?php if ($date == "" || $lic != "verified"){ header("location: Rider.php");?>style="display:none"<?php } ?>><a class="nav-link js-scroll-trigger scan" id = "scan" href="scan.php">QR Scanner</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rhistory.php">History</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="RChistory.php">Cashout Transactions</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rsetting.php">Setting</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>

                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
<?php
                
                ?>
            <!-- scanner-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                       QR Code Scanner
                    </h1>
                    <div class="box">
                  <figure class="box frame" style="width:150px;height:150px"> </figure>
                    <div class="subheading mb-3">
                    <video id="preview" name="preview" width="100%"></video>   
                    <br>
                </div>
                

                 <!-- scanner method -->
                 <form action="scan.php" method="POST" class="form-horizontal">
               <input type="number" name="text" readonly="" id="text" placeholder="scan qrcode" class="form-control w-50" style="display:none;" autofocus> 
            </form>
            </section>    
        </div>

        <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="scanner.js"></script>
		
        <script>
           let scanner = new Instascan.Scanner({ video: document.getElementById('preview')});
           Instascan.Camera.getCameras().then(function(cameras){
               if(cameras.length > 0 ){
                   scanner.start(cameras[0]);
               } else{
                   alert('No cameras found');
               }

           }).catch(function(e) {
               console.error(e);
           });

           scanner.addListener('scan',function(c){
               document.getElementById('text').value=c;
               document.forms[0].submit();
               fps(30,30,20);
               video.msHorizontalMirror = true;
           });
        </script>
		
    </body>
</html>
