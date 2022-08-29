<?php require_once "controluserdata.php"?>
<?php 
$email = $_SESSION['email'];
if($email == false){
  header('Location: rider-log.php');
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Set New Password  </title>
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
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">New password</h3></div>
                                    <div class="card-body">
                                        <form action="new-password.php" method="POST">
                                        <?php 
                                        if(isset($_SESSION['info'])){
                                            ?>
                                            <div class="alert alert-success text-center">
                                                <?php echo $_SESSION['info']; ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if(count($errors) > 0){
                                            ?>
                                            <div class="alert alert-danger text-center">
                                                <?php
                                                foreach($errors as $showerror){
                                                    echo $showerror;
                                                }
                                                ?>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="password" type="password" placeholder="Create new password" required />
                                                <label for="inputEmail">Create new password</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" name="cpassword" type="password" placeholder="Create new password" required />
                                                <label for="inputEmail">Confirm your password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                
                                                <input class="btn btn-primary" type="submit" name="change-password" value="Change">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="rider-reg.php">Need an account? Sign up!</a></div>
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
