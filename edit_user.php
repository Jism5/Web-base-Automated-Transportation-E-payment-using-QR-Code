<?php
// including the database connection file
include_once("config.php");

if(isset($_POST['update']))
{	

    $id = mysqli_real_escape_string($con, $_POST['id']);
	$des = mysqli_real_escape_string($con, $_POST['des']);
	$pri = mysqli_real_escape_string($con, $_POST['pri']);
	// checking empty fields
	if(empty($des) || empty($pri)) {	
			
		if(empty($des)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($age)) {
			echo "<font color='red'>Age field is empty.</font><br/>";
		}	
	} else {	
		//updating the table
		$result = mysqli_query($conn, "UPDATE places SET destination='$des',price='$pri' WHERE id = $id");
		
		//redirectig to the display page. In our case, it is index.php
		header("Location: destinations.php");
	}
}
?>
<?php
//getting id from url
$id = $_GET['id'];

//selecting data associated with this particular id
$result = mysqli_query($conn, "SELECT * FROM places WHERE id=$id");

while($res = mysqli_fetch_array($result))
{
	$des = $res['destination'];
	$pri = $res['price'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>	
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<style>
        .disclaimer{
        display:none;
            }</style>
</head>

<body>
<div class="card m-20" style="width: 18rem; margin:7%;">
  <div class="card-body">
    <h5 class="card-title">Edit Destination</h5>

	<form name="form1" method="post" action="edit_user.php">
			<label for="recipient-name" class="col-form-label">Destination:</label>
            <input type="text" class="form-control" id="recipient-name" name="des" value="<?php echo $des;?>">

			<label for="recipient-name" class="col-form-label">Price:</label>
            <input type="text" class="form-control" id="recipient-name" name="pri" value="<?php echo $pri;?>">

			<td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
				<td><input type="submit" class="btn btn-primary mt-3" name="update" value="Update"></td>
		</form>
          </div>
          </div>
		  
  </div>
</div>

</body>
</html>
