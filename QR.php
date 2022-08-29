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
        <title>YourQR</title>
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
                    <!-- generate qr code -->
                <?php
                            if(isset($_SESSION['email'])){    
                                $sql = "SELECT * FROM passenger_info WHERE passenger_id = '$currentid'";
                                $qry = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($qry);
                                if($result){
                        
                                }
                                else{
                                    echo "error" . $sql .'<br>'. $con->error;
                                }
                                $data = $result['passenger_id'];
                        
                                $url = " https://quickchart.io/qr?text={$data}";
                                $output = $url;
 
                            }                     
                            ?>

                            <!-- output the qr code -->
                                    <?php if(isset($output)) { ?>
                                    <div class="qr">
                                        <img src="<?php echo $output ?>" alt="QR Code" width="360px" height="360px">
  
                                    </div>
                                    <?php } ?>
                                    <div class="container-fluid px-4">
                                    <?php

                                if(isset($_POST['save'])){
                                    $email = $_SESSION['email'];
                                    $select = $_POST['event_type'];
                                    $price = mysqli_query($conn , "SELECT * FROM places WHERE id = '$select'");
                                    $get = mysqli_fetch_assoc($price);
                                    $des = $get['destination'];
                                    $pri = $get['price'];
                                    if($price){
                                        $sql1 = mysqli_query($conn, "UPDATE passenger_info SET destination = '$des' , fare = '$pri'  WHERE passenger_id = '$currentid'");
                                    }
 
                                    if($sql1){
                                        $sql = mysqli_query($conn, "SELECT destination, fare FROM passenger_info WHERE passenger_id = '$currentid'");
                                        $row = mysqli_fetch_assoc($sql);
                                        echo "Destination: " . $row['destination'];?><br><?php
                                        echo "Price: ". $row['fare'];

                                    }else{
                                        echo $conn->error;
                                    }
                                }
                                ?>
                                    <!-- form -->
                                     <form action="" method="post">
                                     <h3>Select you Destination:</h3> 
                                        <?php 
                                            $sql = "SELECT * FROM places";
                                            $query = mysqli_query ($conn,$sql);
                                     
                                            echo " <select name='event_type' class='btn btn-secondary ml-5 mt-2'>";
                                            while ($result = mysqli_fetch_array($query)){
                                            echo "<option value='".$result['id'] ."']>" . $result['destination'] ."</option>";         
                                        }
                                            echo "</select>"; 
                                            ?>
                                    <div class="mt-3 ml-5">
                                        <button type="submit" name="save" class="btn btn-danger ">Save</button>
                                    </div><br>
                                    <a type="submit" href="cancel.php" class="btn btn-primary ml-5" name="canceldes" style="color: white">
                        Cancel Destination
                            </a>
                                </form>
                                
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
