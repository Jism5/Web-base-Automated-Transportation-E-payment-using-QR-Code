<?php require_once "controluserdata.php"; 
        require_once "check.php";
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
            <a class="navbar-brand ps-3" href="Admin.php">Arenda TODA</a>
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
                        Admin
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">

                         <?php
                            $email = $_SESSION['email'];
                            $query = "SELECT * FROM places";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['id']
                            ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Admin</h1>
                      
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Destinations
                            </div>

                            <!-- riders table -->
                            <div class="table-responsive-sm card-body">
                                <table id="datatablesSimple" class="">
                                    <thead>
                                        <tr>
                                            <th>Destination</th>
                                            <th>Prices</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                        
                                        <?php
                                        while($row = $result->fetch_assoc()){
                                            
                                        ?>
                                        
                                            <td><?php echo $row['destination'];?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td><a href="edit_user.php?id=<?php echo $row["id"]; ?>" name = "update" class="btn btn-primary">Edit</a>                                     
                                            <a href="delete_user.php?id=<?php echo $row["id"]; ?>" name = "delete" class="btn btn-danger">Delete</a></td>                                       
                                            </tr>                              
                                        <?php
                                        
                                        }
                                        ?>                                 
                                            
                                          
                                    </tbody>
                                </table>
                        <div class="resume-section-content">
                    
                    <div class="subheading mt-5">
                    
                                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Destinations
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
                        if(isset($_POST['addnew'])){
                            $des = $_POST['des'];
                            $pri = $_POST['pri'];

                            $sql = mysqli_query($conn, "INSERT INTO places (destination, price) VALUES ('$des','$pri')");
                            if($sql) {
                                $message = "New User Added Successfully";
                                header("location: Admin.php");
                                
                            }
                        }
                        ?>

                        <form action="" method="POST">       
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="des"  placeholder="Destination"  aria-describedby="emailHelp"  required>                         
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="exampleInputEmail1" name="pri" placeholder="Price" aria-describedby="emailHelp"  required>                         
                        </div>

                        <button type="submit" class="btn btn-primary" name="addnew" value="Send Request">Add</button>
                            </form>
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
        <script src="adminfile/js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="adminfile/assets/demo/chart-area-demo.js"></script>
        <script src="adminfile/assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="adminfile/js/datatables-simple-demo.js"></script>
    </body>
</html>
