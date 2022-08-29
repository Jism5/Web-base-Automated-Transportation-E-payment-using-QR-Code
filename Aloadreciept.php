<?php
require_once "comcontrollerUserData.php";

   // $text = $_POST['text'];
    $id = $_GET['id'];
    $load = $_GET['amount'];
    $select = "SELECT * FROM passenger_info WHERE passenger_id='$id' ";
    $result = mysqli_query($conn, $select);
    $row = mysqli_fetch_assoc($result);
    $mail = $row['passenger_id'];
    $time = date('Y-m-d');

    if(isset($_POST['name'])){
   $id = $_POST['passenger_id'];
   $load1 = $_POST['load'];
   $name = $_POST['name'];
      
   $sql = "INSERT INTO load_history(passenger_id,cname,load_amount,load_date) 
                    VALUES('$id','$name','$load1',CURRENT_TIMESTAMP)";
   if (mysqli_query($conn, $sql)) {
    header("location: Aload.php");
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
        <td class="container" width="600">
            <div class="content">
                
                <table class="main" width="100%" cellpadding="0" cellspacing="0">
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
                                    if($row){
                                  ?>
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody>
                                                <td><?php echo "NAME: " .  $row['cname'];?></tr>
                                                <td><?php echo "ID: ".      $id;?></tr>
                                                <td><?php echo "DATE: " . $time ?></tr>   
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                                                                  
                                                        <tr class="total">
                                                            <td class="alignright" width="10%">Total:</td>
                                                            <td class="alignright"> <?php echo $load;?></td>
                                                        </tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                    <form action="Aloadreciept.php" method="POST" class="form-horizontal" style="border:none;">

                                    <div class="form-group">
                                    <input type="text" name="id" id="id" value="<?php echo $id;?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="name" id="name" value="<?php echo $row['name'];?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    <input type="text" name="load" id="load" value="<?php echo $load;?>" class="form-control" style="border:none; margin:1px; display:none;">
                                    </div>
                                    <input class="form-control button" type="submit" name="data" value="Confirm">

                                        </form>

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
  }else{
      $conn->error;
  }
?>