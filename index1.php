<?php require_once "controluserdata.php"; 
        require_once "check.php";

        $email = $_SESSION['email'];
        $sql = mysqli_query($conn, "SELECT * FROM userdata WHERE  email = '$email' and role = 'user' ");
        $result = mysqli_fetch_assoc($sql);
        $currentemail = $result['email'];
        $currentid = $result['id'];

        $getinfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM passenger_info WHERE passenger_id = '$currentid'"));
        $idd = $getinfo['passenger_id'];
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
            
            .alb img{
                margin-top: 4em;
                display: inline-block;
                margin-left:30px;
                width: 250px;
                height: 250px;
                border-radius: 50%;
                object-fit: cover;
                box-shadow: 0px 1px 2px #eee, 0px 2px 2px #e9e9e9, 0px 3px 2px #ccc, 0px 4px 2px #c9c9c9, 0px 5px 2px #bbb, 0px 6px 2px #b9b9b9, 0px 7px 2px #999, 0px 7px 2px rgba(0, 0, 0, 0.5), 0px 7px 2px rgba(0, 0, 0, 0.1), 0px 7px 2px rgba(0, 0, 0, 0.73), 0px 3px 5px rgba(0, 0, 0, 0.3), 0px 5px 10px rgba(0, 0, 0, 0.37), 0px 10px 10px rgba(0, 0, 0, 0.1), 0px 20px 20px rgba(0, 0, 0, 0.1);

            }
            
          .codepen {
            margin: 2em auto;
            h1 {
              color: lighten($base-text-color, 20);
              font-weight: 100;
            }
            a {
              color: $base-link-color;
              &:hover {
                color: $base-hover-color;
              }
            }
          }

          .profile {
            @extend .codepen;
            max-width: $profile-card-size;
            border: 1px solid lighten($base-text-color, 80);
            border-radius: 20px;
            padding: 2em;
            margin: 1em;
            display: flex;
            flex-flow: row wrap;
            justify-content: space-between;
            align-items: center;
            align-content: center;
            position: relative;
            
            figure {
              margin: 0;
              img {
                max-width: $profile-avatar-size;
                max-height: $profile-avatar-size;
                border-radius: 50%;
                padding: 10px;
                box-shadow: 0px 0px 20px rgba($base-text-color, .15);
              }
            } // end figure
            
            header {
              h1 {
                margin: 0;
                padding: 0;
                line-height: 1;
                small {
                  display: block;
                  clear: both;
                  font-size: 18px;
                  opacity: 0.6;
                  
                }
              }
            } // end header
              
            main {
              display: none;

              dl {
                display: block;
                width: 100%;
                dt,
                dd {
                  float: left;
                  padding: 8px 5px;
                  margin: 0;
                  border-bottom: 1px solid lighten($base-text-color, 80);
                  a {
                    padding-right: 5px;
                  }
                }
                dt {
                  width: 30%;
                  padding-right: 10px;
                  font-weight: bold;
                  &:after {
                    content: ":"
                  }
                }
                dd {
                  width: 70%;
                }
              }
            } 
            }
          .disclaimer{
              display:none;
          }
        </style>
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
                    <!-- get image to database -->
                    <?php                        
                         $sql = "SELECT * FROM passenger_info WHERE passenger_id = '$currentid' ";
                         $res = mysqli_query($conn, $sql);
 
                         if (mysqli_num_rows($res) > 0) {
                             while ($images = mysqli_fetch_assoc($res)) {  ?>
                             
                             <div class="alb ml-2 mt-4">
                                 <img src="userfile/uploads/<?=$images['image_url']?> ">
                             </div>
                                
                    <?php } }?>

                    <br>
                    
                        <!-- display profile -->
                              <div class="profile">
                          <header>
                            <h1><?php echo $getinfo['name'];?></h1>
                            <h4>Current balance: <?php echo " ". $getinfo['balance'];?></h4>
                            <small>Selected Destination: <?php echo " ". $getinfo['destination'];?></small><br>
                            <small>Fare: <?php echo " ". $getinfo['fare'];?></small>
                          </header>

                          <div class="resume-section-content">
                    
                    <div class="subheading">
                    
                                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary ml-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Request load
                </button>
                             <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Request</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <div class="load-reference">
                        <!-- send request -->
                        <?php
                        if(isset($_POST['request'])){
                            $id = $_POST['userid'];
                            $name = $_POST['name'];
                            $reference = $_POST['reference'];
                            $amount = $_POST['amount'];
                            $email = $_SESSION['email'];
                            $status = "active";

                            date_default_timezone_set('Asia/Manila');
                            $time = date('h:i:s');
                            $date = date('y-m-d');

                            // check reference duplication
                            $select = mysqli_query($conn, "SELECT * FROM load_history WHERE reference = $reference");
                            $get = mysqli_num_rows($select);

                            if($get > 0){
                                echo '<script>
                                function myFunction() {
                                  alert("Confirm");
                                }
                                </script>';
                            }else{
                                $sql = mysqli_query($conn, "INSERT INTO load_history (passenger_id,cname,reference,load_amount,request_load_status,load_time,load_date) 
                                                            VALUES ('$id','$name','$reference','$amount','$status','$time','$date')");
                            if($sql){
                                echo '<div class="alert alert-success text-center">
                                <h3>Request sent!</h3>
                            </div>';
                            die($conn);
                            }else{
                              echo '<div class="alert alert-danfer text-center">
                              <h3>Something went wrong!</h3>
                          </div>'; $con->connect_error;
                            }
                            }    
                        }
                        ?>
                        
                        <form action="" method="POST">
                        <form>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="userid" value="<?php echo $idd;?>" aria-describedby="emailHelp"  readonly required>                         
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="<?php echo $getinfo['name'];?>" aria-describedby="emailHelp"  readonly required>                         
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="reference" aria-describedby="emailHelp" placeholder="Reference #" required>                         
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="amount" aria-describedby="emailHelp" placeholder="Amount #" required>                         
                        </div>
                        
                        <button type="submit" class="btn btn-primary" name="request" value="Send Request">Send Request</button>                      
              </div>
                    </div>
                    
                    </div>
                </div>
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
