<?php
 require_once "controluserdata.php";
 require_once "check.php";

                        $email = $_SESSION['email'];
                            $query = "SELECT * FROM riders_log WHERE email = '$email'";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                            $id = $row['id'];

if(isset($_POST['update_stud_data']))
{
    
    $name = $_POST['name'];
    $add = $_POST['address'];
    $plate = $_POST['plate'];
    $lic = $_POST['license'];

    $query = "UPDATE riders_log SET name='$name', address='$add' , plate='$plate', license='$lic' WHERE id='$id' ";
    $query_run = mysqli_query($conn, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Data Updated Successfully";
        header("Location: Rider.php");
    }
    else
    {
        $_SESSION['status'] = "Not Updated";
        header("Location: Rider.php");
    }
}

?>