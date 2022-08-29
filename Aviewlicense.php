<?php
require_once "controluserdata.php";
require_once "check.php";

$id = $_GET['id'];


                        $sql = "SELECT * FROM rider_info WHERE riders_id = '$id'";
                        $res = mysqli_query($conn, $sql);
                        
                        

                        if(isset($_POST['approve'])){
                            $sql = mysqli_query($conn, "UPDATE rider_info SET verify_status = 'verified' WHERE riders_id ='$id' and license_url != '' ");
                            header("location: Admin.php");

                        }if(isset($_POST['decline'])){
                            $sql = mysqli_query($conn, "UPDATE rider_info SET verify_status = 'declined! send another' WHERE riders_id ='$id'");
                            header("location: Admin.php");
                        }
                        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        .disclaimer{
        display:none;
            }
        .app{
            margin-left: 680px;
        }
            </style>
</head>
<body>
<?php
                    if (mysqli_num_rows($res) > 0) {
                            while ($images = mysqli_fetch_assoc($res)) {  
                                ?>
                            
                            <div class="alb">
                            <img src="uploads/<?=$images['license_url']?>" class="rounded mx-auto d-block " style="width:500px; height:auto; margin: 20px; padding:20px;" alt="...">
                            </div>
                                
                    <?php } } 
                    else{
                        echo mysqli_error($con);
                    }
                    ?>
    <form action="" method="post">

    <button name = "approve" class="btn btn-primary app" >Approve</button>
    <button name = "decline" class="btn btn-danger des" >Decline</button>


    </form>
</body>
</html>