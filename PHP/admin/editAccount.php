<?php
$account_no = $_GET['account_no'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if (!empty($errors)) {
	echo "<div class='error'>";
	foreach ($errors as $error) {
		echo "<p>$error</p>";
	}
	echo "</div>";
}
	else {
		if(isset($_POST['submit'])){

		$account_no = $_POST['account_no'];
		$account_type = $_POST['account_type'];
		$interest_rate = $_POST['interest_rate'];
        $balance=$_POST['balance'];
		
		// echo $account_no;
		$sql = "UPDATE accounts set account_type = '$account_type' , interest_rate = '$interest_rate', balance='$balance' where account_no = '$account_no'";
		
		try{
			mysqli_query($conn, $sql);
		
		if (mysqli_affected_rows($conn) == 1) {	
			setcookie("sucMessage", "Successfully updated!", time() + 5, "/");
 			 header('Location: adminDashboard.php');
 			 exit; 
		}
		
	 else{
		setcookie("failMessage", "Update Failed!", time() + 5, "/");
		header('Location: adminDashboard.php');
 			 exit;
	 }
	}
	catch(Exception $e){
		setcookie("failMessage", "Update Failedd", time() + 5, "/");
		header('Location: adminDashboard.php');
 			 exit;
	}
	}
	$sql1 = "select * from accounts where account_no = '$account_no'";
	$res = mysqli_query($conn, $sql1);
	$data = mysqli_fetch_assoc($res);
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Data Into Form</title>
	<style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="number"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
	<style type="text/css">
		.error{
			color: red;
			display: block;
		}
	</style>
	<script>
        function validateForm() {
            let interestRate = document.forms["accountForm"]["interest_rate"].value;
            let balance = document.forms["accountForm"]["balance"].value;
            let errors = [];

            if (interestRate == "" || isNaN(interestRate) || interestRate <= 0) {
                errors.push("Interest Rate must be a positive number");
            }
            if (balance == "" || isNaN(balance) || balance < 0) {
                errors.push("Balance must be a non-negative number");
            }

            if (errors.length > 0) {
                alert(errors.join("\n"));
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="return validateForm()>
		<input type="hidden" name="account_no" value="<?php echo $data['account_no']; ?>">
		<label>Account Type</label>
		<input type="text" name="account_type" value="<?php echo $data['account_type']; ?> "readonly>
		<br>
		<br>
		<label>Interest Rate</label>
		<input type="text" name="interest_rate" value="<?php echo $data['interest_rate']; ?>">
		<br>
		<br>	
        <label>Balance</label>
		<input type="text" name="balance" value="<?php echo $data['balance']; ?>">
		<br>
		<br>
		<input type="submit" name="submit" value="submit" >
	</form>
</body>
</html>