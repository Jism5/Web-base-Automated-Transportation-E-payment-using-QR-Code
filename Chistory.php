<?php require_once "controluserdata.php"; require_once "check.php";

$email = $_SESSION['email'];
$sql = mysqli_query($conn, "SELECT * FROM userdata WHERE  email = '$email' and role = 'user' ");
$result = mysqli_fetch_assoc($sql);
$currentemail = $result['email'];
$currentid = $result['id'];

$getinfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM passenger_info WHERE passenger_id = '$currentid'"))

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SB Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="userfile/css/dashstyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        .disclaimer{
        display:none;
            }</style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">Arenda TODA</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            
            <!-- Navbar-->
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                          <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"></div>
                                Dashboard
                            </a>
                            
                            <a class="nav-link" href="QR.php">
                                <div class="sb-nav-link-icon"></div>
                                Your QR Code
                            </a>
                            <a class="nav-link" href="Chistory.php">
                                <div class="sb-nav-link-icon"></div>
                                History
                            </a>
                            <a class="nav-link" href="Csetting.php">
                                <div class="sb-nav-link-icon"></div>
                                Setting
                            </a>
                            <a class="nav-link" href="logout.php">
                                <div class="sb-nav-link-icon"><i class="material-icons" style="font-size:20px">Logout</i></div>
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Commuter
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">History</li>
                        </ol>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Commuter's Activities
                            </div>

                            <?php
                            
                            $query = "SELECT * FROM history WHERE passenger_id ='$currentid' and mark = 'old' ";
                            $result = $conn->query($query);
                            if($result->num_rows > 0){
                                
                            ?>
                            <!-- Commuters table -->
                            <div class="table-responsive-sm card-body">
                                <table id="datatablesSimple" class="">
                                    <thead>
                                        <tr>
                                            <th>Time</th>
                                            <th>Date</th>                                           
                                            <th>Driver's Name</th>
                                            <th>Destination</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                      
                                            <?php
                                            while($row = $result->fetch_assoc()){
                                                ?>
                                                <tr>
                                                <td><?php echo $row['qrtime'];?></td>
                                                <td><?php echo $row['created'];?></td>
                                                <td><?php echo $row['ridername'];?></td>
                                                <td><?php echo $row['destination'];?></td>
                                                </tr>
                                                <?php  
                                            }
                                            ?>
                                             
                                   <?php
                                   }?>     
                                    </tbody>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="userfile/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="userfile/js/datatables-simple-demo.js"></script>
    </body>
</html>
