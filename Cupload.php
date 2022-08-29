<?php 
require_once "controluserdata.php"; 
require_once "check.php";

$email= $_SESSION['email'];
$sql = "SELECT * FROM userdata WHERE email = '$email' and role = 'user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$currentid = $row['id'];
$riderinfo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM passenger_info WHERE passenger_id = '$currentid'"));
$final = $riderinfo['passenger_id'];

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {
	include "check.php";

	echo "<pre>";
	print_r($_FILES['my_image']);
	echo "</pre>";

	$img_name = $_FILES['my_image']['name'];
	$img_size = $_FILES['my_image']['size'];
	$tmp_name = $_FILES['my_image']['tmp_name'];
	$error = $_FILES['my_image']['error'];

	if ($error === 0) {
		if ($img_size > 405000) {
			$em = "Sorry, your file is too large.";
		    header("Location: Index.php?error=$em");
		}else {
			$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
			$img_ex_lc = strtolower($img_ex);

			$allowed_exs = array("jpg", "jpeg", "png"); 

			if (in_array($img_ex_lc, $allowed_exs)) {
				$new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
				$img_upload_path = 'userfile/uploads/'.$new_img_name;
				move_uploaded_file($tmp_name, $img_upload_path);

				// Insert into Database
				$sql = "UPDATE passenger_info
				        SET image_url = ('$new_img_name')
						WHERE passenger_id = '$final'";
				mysqli_query($conn, $sql);
				header("Location: index.php");
			}else {
				$em = "You can't upload files of this type";
		        header("Location: index.php?error=$em");
			}
		}
	}else {
		$em = "unknown error occurred!";
		header("Location: index.php?error=$em");
	}

}else {
	header("Location: setting.php");
}