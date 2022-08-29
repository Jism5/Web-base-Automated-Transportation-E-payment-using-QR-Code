<?php require_once "controluserdata.php"; 
        require_once "check.php";

$email = $_SESSION['email'];
$qry = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM userdata WHERE email = '$email'"));
$id = $qry['id'];
$sql = mysqli_query($conn , "UPDATE passenger_info SET destination='', fare = 0 WHERE passenger_id = '$id'");
if($sql){
    header("location: index.php");
}else{
    echo mysqli_error($conn);
}