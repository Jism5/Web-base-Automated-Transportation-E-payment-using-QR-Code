<?php
require_once "controluserdata.php";
require_once "check.php";
    //user basic data
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM userdata WHERE email = '$email' and role ='rider'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $currentid = $row['id'];

    
    //butaw date
    $butaw = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM butaw"));
    $des = $butaw['created'];
    $amo = $butaw['price'];

    //rider information
    $riderinfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rider_info WHERE riders_id = '$currentid'"));
    $id=$row['id'];   
    $date=$riderinfo['time_in'];   
    $lis = $riderinfo['verify_status'];

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Rider</title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     
<!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/rider.css" rel="stylesheet" />
        <style>

            .alb img{
                display: inline-block;
                margin-left: 40px;
                width: 250px;
                height: 250px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0px 1px 2px #eee, 0px 2px 2px #e9e9e9, 0px 3px 2px #ccc, 0px 4px 2px #c9c9c9, 0px 5px 2px #bbb, 0px 6px 2px #b9b9b9, 0px 7px 2px #999, 0px 7px 2px rgba(0, 0, 0, 0.5), 0px 7px 2px rgba(0, 0, 0, 0.1), 0px 7px 2px rgba(0, 0, 0, 0.73), 0px 3px 5px rgba(0, 0, 0, 0.3), 0px 5px 10px rgba(0, 0, 0, 0.37), 0px 10px 10px rgba(0, 0, 0, 0.1), 0px 20px 20px rgba(0, 0, 0, 0.1);

            }
            
        .disclaimer{
        display:none;
            }
        </style>
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
            <section class="resume-section" id="about">
                <div class="resume-section-content">
                    <!-- get image to database -->
                <?php    
                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$currentid' ";
                        $res = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($res) > 0) {
                            while ($images = mysqli_fetch_assoc($res)) {  ?>
                            
                            <div class="alb ">
                                <img src="uploads/<?=$images['image_url']?> " alt=" " >
                            </div>
                                
                    <?php } }
                        
                    ?>
                        <!-- profile info -->
                        <br><br>
                        <h3 class="text-primary " style="color:black;">
                        <?php echo "Name: " . $riderinfo['name'];?>
                        </h3>
                        <h3 class="text-primary " style="color:black;">
                        <?php echo "Date joined: " . $riderinfo['created'];?>
                        </h3>
                        <h3 class="text-primary " style="color:black;">
                        <?php echo "Address: " . $riderinfo['address'];?>
                        </h3>
                        <h3 class="text-primary " style="color:black;">
                        <?php echo "Plate #: " . $riderinfo['plate'];?>
                        </h3>
                        <h3 class="text-primary " style="color:black;">
                        <?php echo "License #: " . $riderinfo['license'];?>
                        </h3>
                        <h5 class=" " style="color:black;">
                        <?php echo "Driver's License Status: " . $riderinfo['verify_status'];?>
                        </h5>

                        <!-- display profile and check time in and time out -->
                        <?php
                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$id' ";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($res);
                        $lic = $row['license_url'];
                        $time = $row['time_in'];
                        $timo = $row['time_out'];
                        $stat = $row['cashout_status'];
                        $cash = $row['storage'];
                        $verit = $row['verify_status'];
                        $verify = "Upload your driver's license to verify";

                        if(empty($lic)){
                            echo $verify;                          
                        }elseif($verit == 'verified'){
                            $sql = mysqli_query($conn, "UPDATE rider_info SET verify_status = 'verified' WHERE riders_id ='$id'");
                            echo '<style> 
                             .form {display: none; }
                             </style>';                            
                        }elseif($verit == 'Pending'){
                            echo '<style> 
                             .form {display: none; }
                             </style>';  
                        }
                      
                        ?><br><br><?php
                        echo  "Time In: " . $time; ?><br><?php
                        echo  "Time Out: " . $timo; ?><br><?php
                        echo  "Request Cash Out: " . $stat;?><br><?php
                        echo  "Amount to Cash Out: " . $cash;

                        ?>

            <!-- insert image to database -->
                        <form action="license.php" method="post" class="form" enctype="multipart/form-data" class="m-4">
           <label class="form-label" for="customFile">Verify your Driver's Lincense</label>
            <input type="file" name="my_image" class="form-control" style="width:110px" id="customFile" />
            <input type="submit" name="submit"class="btn btn-primary mt-3" value="Upload Your Driver's license"><br>  	
     </form><br>
                    <!-- set time in -->
                    <?php
                    if(isset($_POST['yes'])){
                        date_default_timezone_set('Asia/Manila');
                        $date = date('m/d/Y h:i a', time());
                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$id' ";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($res);
                        $rider = $row['verify_status'];
                        
                        if($rider != 'verified'){
                            echo "Your not verified yet";
                            mysqli_close($conn);
                        }else{
                           $ins = mysqli_query($conn, "UPDATE rider_info SET time_in = '$date' WHERE riders_id = '$id'");
                            if($ins){
                            header("location: Rider.php");
                        } 
                        }
                        
                    }
                    // cancel set time
                    if(isset($_POST['cancel'])){
                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$id' ";
                        $res = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_assoc($res);
                        $out = $row["time_out"];
                        $st = $row["storage"];
                        if(!empty($out)){
                            echo "<h5>Settle first you cash out transaction!<h5>";
                        }elseif(!empty($st)){
                            echo "You have amount to cashout!";
                        }else{
                            $ins = mysqli_query($conn, "UPDATE rider_info SET time_in = '' WHERE riders_id = '$id'");
                            header("location: Rider.php");
                        }

                    }
                    ?>
                   
                        <!-- time in -->
                        <!-- Button trigger modal -->
                        <button type="button" id = "yes" class="btn btn-primary yes mt-5 mb-4" data-toggle="modal" data-target="#exampleModalCenter">
                    Time in
                    </button>
                    <button type="button" id = "yes" class="btn btn-primary yes mt-5 mb-4" data-toggle="modal" data-target="#exampleModalCenter1">
                    Cancel
                    </button><br>

                    <!-- Modal time in-->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Time In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to Time in?
                        </div>
                        <form action="" method="post">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <input type="submit" class="btn btn-primary" name="yes" value="Yes">
                        </div>
                        
                        </div>
                    </div>
                    </div>
                    </form>

                     <!-- Modal cancel time in-->
                     <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Time In</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to cancel Time in?
                        </div>
                        <form action="" method="post">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <input type="submit" class="btn btn-primary" name="cancel" value="Yes">
                        </div>
                        
                        </div>
                    </div>
                    </div>
                    </form>

                    <!-- cash out -->
                    <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                        Cash Out
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">Cash Out</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                date_default_timezone_set('Asia/Manila');
                                $time = date('h:i:s');
                                $date = date('y-m-d');
                                
                                $sql1 = mysqli_query($conn, "SELECT * FROM history WHERE riders_id = '$id' and created = '$date' and mark = 'new'");
                                                          
                                ?>    
                                
                                
                                <!-- table -->
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                        <th scope="col">Client</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Fare</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Date</th>
                                        
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <tr>
                                        <?php while($row = $sql1->fetch_assoc()) {?>                                     
                                        <td><?php echo $row['username'];?></td>
                                        <td><?php echo $row['destination'];?></td>
                                        <td><?php echo $row['fee'];?></td>
                                        <td><?php echo $row['qrtime'];?></td>
                                        <td><?php echo $row['created'];?></td>
                                        
                                        </tr>
                                        </tbody>
                                        <?php } ?>

                                        <thead>
                                            <tr>
                                                <!-- sum of all transactions -->
                                            <th scope="col">Clients </th>
                                            <th scope="col">Butaw </th>
                                          <th scope="col">Total Cash </th>
                                          
                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $qry = mysqli_query($conn, "SELECT * FROM history WHERE riders_id = '$id' and created = '$date' and mark = 'new'");
                                                $rows = mysqli_num_rows($qry);
                                            
                                             $sql_qry = "SELECT SUM(fee) AS total FROM history  WHERE riders_id = '$id' and created = '$date' and mark = 'new'";
                                                                $duration = $conn->query($sql_qry);
                                                                $record = $duration->fetch_array();
                                                                $check = $record['total'];
                                                                date_default_timezone_set('Asia/Manila');
                                                                $w = date('w');
                                                                $select = date('Y-m-d');
                                                                $yearEnd = date('Y-m-d', strtotime('last day of december'));
                                                                if($select == $amo){
                                                                    if($check > $amo){
                                                                        $total = $check - $amo;
                                                                        $echo = " -" . $amo;
                                                                    }
                                                                    
                                                                }else{
                                                                    $total = $check;
                                                                }

                                                                
                                                            ?>
                                                            
                                            <tr>                                               
                                                <td><?php echo $rows; ?></td>
                                                <td><?php echo $echo; ?></td>
                                                <td><?php echo $total; ?></td>
                                                
                                                            
                                            </tr>
                                            
                                        </tbody>
                                        
                                        
                                    

                                    </table>
                                                                              
                                    <!-- request cashout -->
                            </div>
                            <?php 
                            $cashstat = "Pending";
                            $mark = "old";
                                                if(isset($_POST['save'])){
                                                    date_default_timezone_set('Asia/Manila');
                                                    $date = date('m/d/Y h:i a', time());
                                                    $bate = date('y-m-d');
                                                    $sql = "SELECT * FROM rider_info WHERE riders_id = '$id' ";
                                                    $res = mysqli_query($conn, $sql);
                                                    $row = mysqli_fetch_assoc($res);
                                                    $ctime = $row['time_in'];
                                                    $store = $row['storage'];
                                                    $cashout = $row['cashout_status'];
                                                    if(empty($ctime) or $store == 0){                
                                                        echo "Time in first!";
                                                        $conn->error;
                                                    }else{
                                                        if($cashout != "Pending"){
                                                            $new = mysqli_query($conn, "UPDATE history SET mark = '$mark' WHERE riders_id = '$id' and created = '$bate' and mark = 'new' ");
                                                            $sql = mysqli_query($conn, "UPDATE rider_info SET storage = '$total' , cashout_status = '$cashstat', time_out = '$date'  WHERE riders_id = '$id'"); 
                                                         header("location: Rider.php");                             
                                                        }else{
                                                            mysqli_close($conn);
                                                        }
                                                        
                                                    }
                                                    }
                                                ?>
                            <div class="modal-footer">
                            <div class="modal-body">
                            Confirm your cash out?
                             </div>
                             <form action="" method="post">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="save" class="btn btn-primary">Save</button>
                                </form>
                            </div>
                            </div>
                            
                        </div>
                        </div>
                        
                    <div class="subheading mb-5">                   
                </div>
            </section>
        </div>

       <script> document.addEventListener('contextmenu', event => event.preventDefault());
</script>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        
    </body>
</html>
