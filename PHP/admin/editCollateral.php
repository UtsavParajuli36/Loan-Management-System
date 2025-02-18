<?php
$collateral_id = $_GET['collateral_id'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
	if(isset($_POST['submit'])) {
		
		$collateral_id = $_POST['collateral_id'];
		$collateral_type = $_POST['collateral_type'];
		$collateral_value = $_POST['collateral_value'];
        $member_id=$_POST['member_id'];
		
		$sql = "UPDATE collaterals set collateral_type = '$collateral_type' , collateral_value = '$collateral_value', member_id='$member_id' where collateral_id = '$collateral_id'";
		mysqli_query($conn, $sql);
		
		if (mysqli_affected_rows($conn) == 1) {
	 	
	 	header('location:adminDashboard.php');
	 }
	 else{
	 	echo "Data update failed".mysqli_error($conn);
	 }
	}
	$sql1 = "select * from collaterals where collateral_id = $collateral_id";
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
</head>
<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="hidden" name="collateral_id" value="<?php echo $data['collateral_id']; ?>">
		<label>Collateral Type</label>
		<input type="text" name="collateral_type" value="<?php echo $data['collateral_type']; ?>">
		<br>
		<br>
		<label>Collateral Value</label>
		<input type="text" name="collateral_value" value="<?php echo $data['collateral_value']; ?>">
		
		<input type="hidden" name="member_id" value="<?php echo $data['member_id']; ?>">
		<br>
		<br>
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>