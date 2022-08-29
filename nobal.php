<?php require_once "controluserdata.php"; 


if(isset($_SESSION['email'])){

    $email = $_SESSION['email'];
    $id = $_GET['pid'];
    $select = "SELECT * FROM passenger_info WHERE passenger_id ='$id'";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $date = date("y-m-d");
    $time = date("h-m-s");
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
        <td class="container" width="600">
            <div class="content">
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
                    <tbody><tr>
                        <td class="content-wrap aligncenter">
                            <table width="100%" cellpadding="0" cellspacing="0">
                                <tbody><tr>
                                    <td class="content-block">
                                        <h2>Error </h2>
                                    </td>
                                </tr>
                                <tr>
                                  <?php
                                  if($row){

                                  
                                  ?>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody><tr>
                                                <td><?php echo "NAME: ". $row['name']?><br><?php echo "ID: ". $row['passenger_id']?><br><?php echo "DATE: " . $date?> <br> <?php echo "TIME: " . $time ?></td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                            <tr>
                                                            <td>Payment</td>
                                                            <td class="alignright"><?php echo "Php 25"?></td>
                                                        </tr>

                                                        
                                                       
                                                        <tr class="total">
                                                            <td class="alignright" width="90%">Total:</td>
                                                            <td class="alignright"> Error occur</td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <a type ="submit" class="confirm" href="Rider.php">Close</a>
                                    </td>
                                </tr>
                            </tbody></table>
                        </td>
                    </tr>
                </tbody></table>
                <div class="footer">
                    <table width="100%">
                        </table>
                </div></div>
        </td>
        <td></td>
    </tr>
</tbody></table>

 </body>
 </html>      
 <?php
  }}else{
    $conn->error;
  }
?>