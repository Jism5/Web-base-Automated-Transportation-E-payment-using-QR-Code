<?php
require_once "controluserdata.php";

date_default_timezone_set('Asia/Manila');
$date = date('y-m-d');

    $result = mysqli_query($conn, "SELECT * FROM history WHERE created = '$date'");
    $result1 = mysqli_query($conn, "SELECT * FROM rider_info WHERE time_in != ''");
    $rider = $result1->num_rows;
    $count= $result->num_rows;
    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Charts - SB Admin</title>
        <link href="adminfile/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Charts</h1>
                            <?php //while($row = mysqli_fetch_object($result)):?> 
                        <div class="p-3 mb-2 bg-warning text-dark" style="width:50%;"><h2>Today's Passengers:</h2><h3><?php echo $count ?></h3></div>     
                        
                        <!-- button collapse -->
                        <a class="btn " data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">
                                View
                            </a>
                            <!-- show today's commuters -->
                            <!-- button collapse body -->
                            <div class="collapse mt-2" id="collapseExample1" style="width:50%;" >
                            <div class="card card-body">
                            <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Time</th>
                                        </tr>
                                    </thead>  
                                    
                                    <tbody>
                                    <?php 
                                            while($row = mysqli_fetch_assoc($result)) {?>
                                        <tr>
                                            
                                        <td><?php echo $row['username']?> </td>
                                        <td><?php echo $row['destination']?></td>
                                        <td><?php echo $row['created']?></td>                                        
                                        </tr>
                                        <?php  } ; ?> 
                                    </tbody>                                    
                                    </table>
                       </div>
                            </div><br>

                            <div class="p-3 mb-2 bg-warning text-dark mt-2" style="width:50%;"><h2>Active Drivers:</h2><h3><?php echo $rider ?></h3></div>     

                             <!-- button collapse -->
                        <a class="btn " data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                                View
                            </a>
                            <!-- show today's riders -->
                            <!-- button collapse body -->
                            <div class="collapse mt-2 mb-2" id="collapseExample2" style="width:50%;" >
                            <div class="card card-body">
                            <table class="table">
                                    <thead>
                                        <tr>
                                        <th scope="col">Rider's name</th>
                                        <th scope="col">Plate #</th>
                                        <th scope="col">Time</th>
                                        </tr>
                                    </thead>  
                                    
                                    <tbody>
                                    <?php 
                                            while($row1 = mysqli_fetch_assoc($result1)) {?>
                                        <tr>
                                            
                                        <td><?php echo $row1['name']?> </td>
                                        <td><?php echo $row1['plate']?></td>
                                        <td><?php echo $row1['time_in']?></td>                                        
                                        </tr>
                                        <?php  } ; ?> 
                                    </tbody>                                    
                                    </table>
                                </div>
                            </div>
                           <h1>Select Date</h1>
                            <!-- filter from calendar -->
                            <form action="" method="post">
                            <input type="date" name="pdate" class="btn btn-secondary mt-2">
                            <input type="submit" name="sub" class="btn btn-danger mt-2" value="Check">
                            <input type="date" class="btn btn-danger mt-2" name="endate">
                            </form>
                            <?php
                                                if(isset($_POST['sub'])){
                                                    $cdate = $_POST['pdate'];
                                                    $endate = $_POST['endate'];
                                                    if(empty($cdate) && empty($endate)){
                                                        $select = date('Y-m-d');
                                                        $yearEnd = date('Y-m-d', strtotime('last day of october'));
                                                        $sql1 = mysqli_query($conn, "SELECT * FROM history WHERE  created = '$select' or created = '$select' and created between '$cdate' and '$endate' ");
                                                        $list = $sql1->num_rows; 
                                                        echo $yearEnd , $select;
                                                        ?> <small> Select date first </small><?php
                                                    }else{
                                                    $sql = mysqli_query($conn, "SELECT * FROM history WHERE created = '$cdate' or created = '$endate' and created between '$cdate' and '$endate' ");
                                                    $list = $sql->num_rows;                                             
                                                ?>
                            <table class="table" style="width:50%;">
                                    <thead>
                                        <tr>
                                        <th scope="col">Passenger</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Rider's Name</th>
                                        <th scope="col">Plate #</th>
                                        <th scope="col">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php while($fet = mysqli_fetch_assoc($sql)){ ?>
                                        <tr>
                                        <td><?php echo $fet['username'];?></td>
                                        <td><?php echo $fet['destination'];?></td>
                                        <td><?php echo $fet['ridername'];?></td>
                                        <td><?php echo $fet['plate'];?></td>
                                        <td><?php echo $fet['created'];?></td>
                                       
                                        </tr>
                                        <?php 
                                         } }?>
                                         <br>
                                         <h3> Passengers:<?php echo " ". $list?></h3> 
                                    </tbody>
                                    
                                    </table>
                                    <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
                            <br>
                                <?php }
                                
                                date_default_timezone_set('Asia/Manila');
                                if(isset($_POST['butaw'])){
                                    $butaw = $_POST['bdate'];
                                    $butawm = $_POST['butaw_amount'];
                                    if(!empty($butaw)){
                                        $but = mysqli_query($conn, "UPDATE butaw SET created = '$butaw' , price = '$butawm'");
                                        echo $butaw;
                                    }else{
                                        mysqli_close($conn);
                                    }
                                    
                                }
                                                ?>
                                    <h1> Butaw Date</h1>            
                                 <form action="" method="post">
                                 <input type="date" class="btn btn-danger mt-2" name="bdate">
                                 <input type="number" class="form-control mt-2" style="width:50%" name="butaw_amount" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Butaw amount" required>
                                 <input type="submit" name="butaw" class="btn btn-danger mt-2" value="Check">
                                 </form>        
  
                            
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
        <script src="adminfile/assets/demo/chart-pie-demo.js"></script>
    </body>
</html>
