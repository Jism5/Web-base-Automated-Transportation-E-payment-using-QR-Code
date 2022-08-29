<?php
require_once "controluserdata.php";
require_once "check.php";

   // $text = $_POST['text'];

    $plate = $_GET['plate'];
    $intime = $_GET['int'];
    $outime = $_GET['ont'];
    $amount = $_GET['amount'];
       ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link rel="stylesheet" href="css/receipt.css">
 </head>
 <style>
        .disclaimer{
        display:none;
            }</style>
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
                                    <td class="content-block">
                                        <table class="invoice">
                                            <tbody>
                                                <td><?php echo "Plate #: " . $plate;?></tr>
                                                <td><?php echo "Time In : ".      $intime;?></tr>
                                                <td><?php echo "Time Out : " . $outime; ?></tr>   
                                                <td><?php echo "Amount  : " .$amount; ?></tr>   
                                                <td>
                                                    <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                        <tbody>
                                                                                                  
                                                        <tr class="total">
                                                            <td class="alignright" width="10%">Total:</td>
                                                            <td class="alignright"> <?php echo $amount;?></td>
                                                        </tr>
                                                        
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                            
                                        </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                                
                            </tbody></table>
                            <a class = "btn btn-primary mr-10" width="100px" href="Arider_payout.php">Confirm</a>
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