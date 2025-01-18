<?php
$admin_id = $_GET['admin_id'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
	if(isset($_POST['submit'])) {
		
		$admin_name = $_POST['admin_name'];
		$password = $_POST['password'];
		$admin_id = $_POST['admin_id'];
		
		$sql = "UPDATE admins set admin_name = '$admin_name' , password = '$password' where admin_id = '$admin_id'";
		try{
		mysqli_query($conn, $sql);
		
		if (mysqli_affected_rows($conn) == 1) {
			setcookie("sucMessage", "Successfully Edited Admin!", time() + 5, "/");
			header('Location: adminDashboard.php');
			exit;
	 }
	}
	//  else{
	//  	echo "Data update failed".mysqli_error($conn);
	//  }
	catch(Exception $e){
		setcookie("failMessage", "Failed to edit Admin!", time() + 5, "/");
                header('Location: adminDashboard.php');
                exit;
	}
	}
	$sql1 = "select * from admins where admin_id = $admin_id";
	$res = mysqli_query($conn, $sql1);
	$data = mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Data Into Form</title>
	<style type="text/css">
		.error{
			color: red;
			display: block;
		}
	</style>
	<link rel="stylesheet" href="../../CSS/formStyle.css">
</head>
<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="hidden" name="admin_id" value="<?php echo $data['admin_id']; ?>">
		<label>Username</label>
		<input type="text" name="admin_name" value="<?php echo $data['admin_name']; ?>">
		<label>Password</label>
		<input type="text" name="password" value="<?php echo $data['password']; ?>">
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>