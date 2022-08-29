<?php
require_once "controluserdata.php";
require_once "check.php";

$plate = $_GET['plate'];

$sql = mysqli_query($conn, "SELECT * FROM rider_info WHERE plate = '$plate'");
$row = mysqli_fetch_assoc($sql);
$tplate =$row['plate'];
$intime =$row['time_in'];
$outime =$row['time_out'];
$cashout =$row['storage'];
$type = "cash_out";
$mark = "old";

if($row){
    $new = mysqli_query($conn, "INSERT INTO cashout_history(plate, time_in, time_out, cashout) VALUES('$plate','$intime','$outime','$cashout')");
    $qry = mysqli_query($conn, "UPDATE rider_info SET time_in = '', time_out = '', storage = 0 , cashout_status = '' WHERE plate = '$plate'");
    header("location: cashout_receipt.php?plate=$tplate&&int=$intime&&ont=$outime&&amount=$cashout");
}else{
    echo  $conn->error;
}