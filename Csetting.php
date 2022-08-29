<?php require_once "controluserdata.php"; 
        require_once "check.php";


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
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="userfile/css/dashstyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>

            .alb img{
                margin-top: 4em;
                display: inline-block;
                margin-left:20px;
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
            <div class="profile">
            <?php if (isset($_GET['error'])): ?>
                    <p><?php echo $_GET['error']; ?></p>
                <?php endif ?>
                <!-- get image to database -->
                <?php 
                        
                        $sql = "SELECT * FROM passenger_info WHERE passenger_id = '$currentid' ";
                        $res = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($res) > 0) {
                            while ($images = mysqli_fetch_assoc($res)) {  ?>
                            
                            <div class="alb ml-4 mt-4">
                                <img src="userfile/uploads/<?=$images['image_url']?> ">
                            </div>
                                
                    <?php } }?>
     <form action="Cupload.php"
           method="post"
           enctype="multipart/form-data" class="m-3">

           <input type="file" 
                class="btn btn-primary"
                  name="my_image">
<br>
           <input type="submit"name="submit"
                  class="btn btn-primary mt-3"
                  value="Update your Photo">
     	
     </form>
     
     <?php if(isset($_POST['save'])){

        $name =  $_POST['name'];

        $result = mysqli_query($conn, "UPDATE passenger_info SET name='$name' WHERE passenger_id = '$currentid'");
		header("Location: index.php");
                
     } ?>

     <?php 
     $update =mysqli_query($conn, "SELECT * FROM passenger_info WHERE passenger_id = '$currentid'");

        while($get = mysqli_fetch_array($update)){
            $name = $get['name'];
        }
     ?>

                
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

                        <form action="edit.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="form-group mb-3">
                                <button type="submit" name="update_stud_data" class="btn btn-primary">Update </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
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
