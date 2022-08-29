<?php
require_once "controluserdata.php";
require_once "check.php";
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM userdata WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id=$row['id'];

    $sql1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM rider_info WHERE riders_id = '$id'"));
    $date = $sql1['time_in'];
    $lis = $sql1['verify_status'];
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
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/rider.css" rel="stylesheet" />
        <style>

            .alb img{
                display: inline-block;
                width: 200px;
                height: 200px;
                border-radius: 50%;
                object-fit: cover;
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
                    
                <?php if (isset($_GET['error'])): ?>
                    <p><?php echo $_GET['error']; ?></p>
                <?php endif ?>
                <!-- get image to database -->
                <?php 
                        
                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$id' ";
                        $res = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($res) > 0) {
                            while ($images = mysqli_fetch_assoc($res)) {  ?>
                            
                            <div class="alb ml-4 mt-4">
                                <img src="uploads/<?=$images['image_url']?> " alt=" ">
                            </div>
                                
                    <?php } }?>

                        <br><br>
                        <br><br>

     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <?php 
                    if(isset($_SESSION['status']))
                    {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey!</strong> <?php echo $_SESSION['status']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        unset($_SESSION['status']);
                    }
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Update your info</h4>
                    </div>
                    <div class="card-body">

                    <!-- image profile -->
                    <form action="Rupload.php" method="post" enctype="multipart/form-data" class="">
                     <label class="form-label" for="customFile">Your Image Profile</label>
                      <input type="file" name="my_image" class="form-control" id="customFile" style="width: 110px;" />
                      <input type="submit" name="submit" class="btn btn-primary mt-3" value="Update your Photo" style="color: white"><br>  	
                      </form><br>

                    <!-- license image -->
                    <form action="license.php" method="post" class="form" enctype="multipart/form-data" class="m-4">
           <label class="form-label" for="customFile">Update Driver's Lincense</label>
            <input type="file" name="my_image" class="form-control" style="width:110px" id="customFile" />
            <input type="submit" name="submit"class="btn btn-primary mt-3" value="Update" style="color: white" ><br>  	
             </form><br>
                    <!-- profile info -->
                        <form action="edit.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <input type="text" name="address" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Plate #</label>
                                <input type="text" name="plate" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">License #</label>
                                <input type="number" name="license" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="update_stud_data" class="btn btn-primary" style="color: white">Update </button>
                            </div>
                        </form>

                    </div>
                </div>

                
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
        <script src="js/scripts.js"></script>
    </body>
</html>
