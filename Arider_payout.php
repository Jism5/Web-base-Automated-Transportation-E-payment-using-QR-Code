<?php
require_once "controluserdata.php";
require_once "check.php";

    $email = $_SESSION['email'];
    $sql11 = "SELECT * FROM userdata WHERE email = '$email' and role = 'rider'";
    $sql = mysqli_query($conn, "SELECT * FROM rider_info ");
    $row = mysqli_fetch_assoc($sql);
    $currentid = $row['id'];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard -  Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="adminfile/css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
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

            <?php

            
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Rider's Payout</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                            </div>

                            <!-- riders table -->
                            <div class="table-responsive-sm card-body">
                                <table id="datatablesSimple" class="">
                                    <thead>
                                        <tr>
                                            <th>Rider Name:</th>
                                            <th>Plate #: </th>
                                            <th>Time In: </th>
                                            <th>Time Out: </th>
                                            <th>Total Day Fare: </th>
                                        </tr>
                                    </thead>
                                    <?php
                                        while($row = $sql->fetch_assoc()){
                                            
                                        ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $row['name'];?></td>
                                            <td><?php echo $row['plate']?></td>
                                            <td><?php echo $row['time_in']?></td>
                                            <td><?php echo $row['time_out']?></td>
                                            <td><?php echo $row['storage'];?></td>
                                           <?php echo "<td><a  href=\"cashout.php?plate=".$row['plate']."\">Cashout</a></td>";?>     
                                        </tr>   
                                    </tbody>
                                    <?php
                                        }                                  
                                            ?>
                                </table>
                            </div>
                        </div>
                    </div> 
                </main>
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
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="adminfile/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="adminfile/assets/demo/chart-area-demo.js"></script>
        <script src="adminfile/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="adminfile/js/datatables-simple-demo.js"></script>
    </body>
</html>
