<?php
    $member_id=$_GET['member_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);  
    if(isset($_POST['submit'])) {

		$member_id = $_POST['member_id'];
		$member_name = $_POST['member_name'];
        $address = $_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
		$password = $_POST['password'];
        $account_no = $_POST['account_no'];
		
		$sql = "UPDATE members set member_name = '$member_name' ,address = '$address',phone = '$phone',
        email ='$email', password = '$password',account_no='$account_no' where member_id = $member_id";
		mysqli_query($conn, $sql);
		
		if (mysqli_affected_rows($conn) == 1) {
	 	
	 	header('location:adminDashboard.php');
	 }
	 else{
	 	echo "Data update failed".mysqli_error($conn);
	 }
	}  
    $sql1 = "select * from members where member_id = $member_id";
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
		<input type="hidden" name="member_id" value="<?php echo $data['member_id']; ?>">
        <label>Name</label>
		<input type="text" name="member_name" value="<?php echo $data['member_name']; ?>"><br> <br>
        <label>Address</label>
        <input type="text" name="address" value="<?php echo $data['address']; ?>"><br> <br>
        <label>Phone</label>
        <input type="number" name="phone" value="<?php echo $data['phone']; ?>"><br> <br>
        <label>Email</label>
        <input type="text" name="email" value="<?php echo $data['email']; ?>"><br> <br>
		<label>Password</label>
		<input type="text" name="password" value="<?php echo $data['password']; ?>"><br> <br>
        <label>Account Number</label>
		<input type="text" name="account_no" value="<?php echo $data['account_no']; ?>"><br> <br>

		<br>
		<br>
		<input type="submit" name="submit" value="submit">
	</form>
</body>
</html>
    
