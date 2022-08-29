<?php
require_once "controluserdata.php";
require_once "check.php";
   

$id = $_GET['id']; 

$sql = mysqli_query($conn, "UPDATE load_history SET request_load_status = 'Loaded' WHERE reference = '$id' ");
    $sql1 = mysqli_query($conn, "SELECT * FROM load_history WHERE reference = '$id'");
    $result = mysqli_fetch_assoc($sql1);
if($result){
    $user = $result['passenger_id'];
    $amount = $result['load_amount'];
    $refe = $result['reference'];
    $status = $result['request_load_status'];
if($id === $refe && $status === 'active'){
    echo "Account has been loaded";
}else{
    $update = mysqli_query($conn, "UPDATE passenger_info SET balance =  balance + '$amount' WHERE passenger_id = '$user'");
if($update){
    header("location: load-request.php");
}else{
    echo "error";
    $sql = mysqli_query($conn, "UPDATE load_history SET request_load_status = 'active' WHERE reference = '$id' ");
}
}
    
    }
