<?php require_once "controluserdata.php" ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="css/dashstyle.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <style>
        .disclaimer{
        display:none;
            }</style>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account as</h3></div>
                                    <div class="card-body">

                                        <form action="rider-reg.php" method="POST">
                                        <?php
                                        if(count($errors) == 1){
                                            ?>
                                            <div class="alert alert-danger text-center">
                                                <?php
                                                foreach($errors as $showerror){
                                                    echo $showerror;
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }elseif(count($errors) > 1){
                                            ?>
                                            <div class="alert alert-danger">
                                                <?php
                                                foreach($errors as $showerror){
                                                    ?>
                                                    <li><?php echo $showerror; ?></li>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        
                                        ?>
                                        <a href="rider-reg.php" style="width: 100%;" class="btn btn-primary mb-5">Rider</a>
                                        <a href="com-reg.php" style="width: 100%;" class="btn btn-primary" >Commuter</a>
                                           
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="Login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
        <script src="js/scripts.js"></script>
    </body>
</html>
