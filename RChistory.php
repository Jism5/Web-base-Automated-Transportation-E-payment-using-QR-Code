<?php
require_once "controluserdata.php";
require_once "check.php";

    $email = $_SESSION['email'];
    $sql = "SELECT * FROM userdata WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];


    $get = mysqli_query($conn, "SELECT * FROM rider_info WHERE riders_id = '$id'");
    $sql1 = mysqli_fetch_assoc($get);
    $lis = $sql1['verify_status'];
    $date = $sql1['time_in'];
    $riderid = $sql1['plate'];
    $plate = mysqli_query($conn, "SELECT * FROM cashout_history WHERE plate = '$riderid'");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Resume - Start Bootstrap Theme</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/rider.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rider.php">Profile</a></li>
                    <li class="nav-item" <?php if ($date == "" || $lis != "verified"){ ?>style="display:none"<?php } ?>><a class="nav-link js-scroll-trigger scan" id = "scan" href="scan.php">QR Scanner</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rhistory.php">History</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="RChistory.php">Cashout Transactions</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Rsetting.php">Setting</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="logout.php">Logout</a></li>

                </ul>
            </div>
        </nav>
        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- profile-->
            <form action="history.php" methos="POST">

            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <h1 class="mb-0" name="history" id="history">
                       <br><br>
                        <span class="text-primary">Cashout Transactions</span>
                    </h1>

                            <!-- Commuters table -->

                            <table class="table table-stripped">
                                <thead class="thead-dark">
                                    <tr>
                                    
                                    <th scope="col">Plate #</th>
                                    <th scope="col">Time In</th>
                                    <th scope="col">Time Out</th>
                                    <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                            while($row = $plate->fetch_assoc()){
                                                ?>
                                    <tr>
                                    <td><?php echo $row['plate'];?></td>
                                    <td><?php echo $row['time_in'];?></td>
                                    <td><?php echo $row['time_out'];?></td>
                                    <td><?php echo $row['cashout'];?></td>
                                    </tr>
                                            <?php  
                                                    }
                                                    ?> 
                                    </tbody>
                                                </table>
            </section>
            </form>
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
        <script src="scripts.js"></script>
    </body>
</html>
