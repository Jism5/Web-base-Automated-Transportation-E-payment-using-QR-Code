<?php
require_once "comcontrollerUserData.php";
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
        <title>Dashboard - SB Admin</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="adminfile/css/styles.css" rel="stylesheet" />
        <style>
        .disclaimer{
        display:none;
            }</style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="Admin.php">ADMIN BOARD</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            
            <!-- Navbar-->
           
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="Admin.php">
                                <div class="sb-nav-link-icon"></div>
                                Dashboard
                            </a>
                            <a class="nav-link" href="charts.php">
                                <div class="sb-nav-link-icon"></div>
                                Charts
                            </a>
                            <a class="nav-link" href="Atables.php">
                                <div class="sb-nav-link-icon"></div>
                                Commuter's Table
                            </a>
                            <a class="nav-link" href="Arider_payout.php">
                                <div class="sb-nav-link-icon"></div>
                                Rider's Payout
                            </a>
                            <a class="nav-link" href="Ahistory.php">
                                <div class="sb-nav-link-icon"></div>
                                History
                            </a>
                            <a class="nav-link" href="Alhistory.php">
                                <div class="sb-nav-link-icon"></div>
                                Load History
                            </a>
                            <a class="nav-link" href="Aload-request.php">
                                <div class="sb-nav-link-icon"></div>
                                Load Request
                            </a>
                            <a class="nav-link" href="Aload.php">
                                <div class="sb-nav-link-icon"></div>
                                Load Station
                            </a>
                            <a class="nav-link" href="Adestinations.php">
                                <div class="sb-nav-link-icon"></div>
                                Available Destinations
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"></div>
                                Logout
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        ADMIN
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Load Station</li>
                        </ol>
                       <!-- scanner-->
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0">
                       Load
                    </h1>
                    <!-- scanner method -->
                 <form action="Aload.php" method="POST" class="form-horizontal">
              
              <input type="number" name="text" readonly="" id="text" placeholder="scan qrcode" class="form-control w-50" style="display:none;" autofocus> 
            
                     <input class="form-control button mb-2" type="number" name="load" placeholder="Input amount:" required >

         </form>

                            <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Confirm
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Your QR</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <video id="preview" width="100%" ></video>   
                    </div>
                    
                    </div>
                </div>
                </div>
                 

            </section>
            
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="adminfile/js/scanner.js"></script>
		
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
           });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="adminfile/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="adminfile/assets/demo/chart-area-demo.js"></script>
        <script src="adminfile/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="adminfile/js/datatables-simple-demo.js"></script>
    </body>
</html>
