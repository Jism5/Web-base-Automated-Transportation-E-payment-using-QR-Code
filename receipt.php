<?php
require_once "controluserdata.php";
require_once "check.php";

   // $text = $_POST['text'];
    $email = $_SESSION['email'];
    $select1 = "SELECT * FROM userdata WHERE role = 'rider' and email = '$email' ";
    $result1 = mysqli_query($conn, $select1);
    $row1 = mysqli_fetch_assoc($result1);
    $riderid = $row1['id'];

    $id = $_GET['pid'];
    $select = "SELECT * FROM passenger_info WHERE passenger_id ='$id'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $mail = $row['passenger_id'];
    

    $getrider = mysqli_query($conn, "SELECT * FROM rider_info WHERE riders_id = '$riderid'");
    $infoid = mysqli_fetch_assoc($getrider);
    $idget = $infoid['riders_id'];
    date_default_timezone_set('Asia/Manila');

    if(isset($_POST['name'])){
   $id = $_POST['id'];
   $name = $_POST['name'];
   $rname = $_POST['rname'];
   $plate = $_POST['plate'];
   $rid = $_POST['idr'];
   $fare = $_POST['fare'];
   $destination = $_POST['destination'];
   $time = date('h:i:s');
   $date = date('y-m-d');
   
   $mark = "new";
   $timein = "";
   $timeout = "";

   
   $sql = "INSERT INTO history(passenger_id,username,riders_id,ridername,mark,plate,fee,destination,qrtime,created) 
            VALUES('$id','$name','$rid','$rname','$mark','$plate','$fare','$destination','$time','$date')";
   if (mysqli_query($conn, $sql)) {
       $reset = mysqli_query($conn, "UPDATE passenger_info SET destination = '', fare = 0 WHERE passenger_id = '$mail'");
    header("location: Rider.php");
 } else {
    echo "Error: " . $sql . ":-" . mysqli_error($conn);
 }
}  
       ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/receipt.css">
   <style>
        .disclaimer{
        display:none;
            }</style>
 </head>
 <body>
   
 <!--  Receipt -->

 <table class="body-wrap">
    <tbody><tr>
        <td></td>
        <td class="container" >
            <div class="content">
                
                <table class="main" width="" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2>Your Receipt</h2>
                                    </td>
                                </tr>
                                <tr>
                                  <?php
                                    if($row && $row1){
                                  ?>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody>
                                                <td><?php echo "Name: " .  $row['name'];?></tr>
                                                <td><?php echo "Destination: "   .   $row['destination'];?></tr>
                                                <td><?php date_default_timezone_set('Asia/Manila'); echo "Time: "   .   date('h:i:s');?></tr>
                                                <td><?php echo "Date: " .   date('y-m-d'); ?></tr>   
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                            <td>Payment</td>
                                                            <td class="alignright"><?php echo $row['fare'];?></td>
                                                        </tr>                                        
                                                        <tr class="total">
                                                            <td class="alignright" width="10%">Total:</td>
                                                            <td class="alignright"> <?php echo $row['fare'];?></td>
                                                        </tr>
                 
                                    <td class="content-block">
                                        
                                    <form action="receipt.php" method="POST" class="form-horizontal" style="border:none;">                                  
                                    <div class="form-group">
                                    <input class="btn btn-primary ml-2" type="submit" name="data" value="Confirm">

                                    <input type="text" name="id" id="id" value="<?php echo $id;?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="name" id="name" value="<?php echo $row['name'];?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="fare" id="fare" value="<?php echo $row['fare'];?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="destination" id="destination" value="<?php echo $row['destination'];?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="idr" id="idr" value="<?php echo $row1['id'];?>" class="form-control" style="border:none; margin:1px;display:none;">
                                    <input type="text" name="rname" id="rname" value="<?php echo $infoid['name'];?>" class="form-control" style="border:none; margin:1px;display:none;">
                                    <input type="text" name="plate" id="plate" value="<?php echo $infoid['plate'];?>" class="form-control" style="border:none; margin:1px;display:none;">
                                    <input type="text" name="cdate" id="cdate" value="<?php date_default_timezone_set('Asia/Manila'); echo date('y-m-d');?>" class="form-control" style="border:none; margin:1px;display:none;">
                                    <input type="text" name="qrtime" id="qrtime" value="<?php  echo date('h:i:s');?>" class="form-control" style="border:none; margin:1px;display:none;">   
                                </div>
                                    </form>


                <div class="footer">
                    <table width="">
                        </table>
                </div></div>
        </td>
        <td></td>
    </tr>
</tbody></table>

 </body>
 </html>      
 <?php
  }else{
      $conn->error;
  }
?>