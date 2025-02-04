<?php
if(!isset($_POST['submit'])){
    if(isset($_GET['loan_id'])) {
        $loan_id = $_GET['loan_id'];
        // Proceed with your logic here
        $dbconfigs = include('../config.db.php');
        $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
        $sql1 = "select * from loans where loan_id = $loan_id";
	    $res = mysqli_query($conn, $sql1);
	    $data = mysqli_fetch_assoc($res);
} 
}
else if(isset($_POST['submit'])) {
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
	

		$loan_idd=$_POST['loan_id'];
		$loan_type = $_POST['loan_type'];
        $loan_amount = $_POST['loan_amount'];
        $term_months = $_POST['term_months'];
		$interest_rate = $_POST['interest_rate'];
        $start_date = date("Y/m/d");
        $request_status='approved';
        $status='active';
		$member_id=$_POST['member_id'];
		
        $sql1="SELECT collateral_id FROM collaterals WHERE member_id=$member_id";
        $result=mysqli_query($conn,$sql1);
        $data = mysqli_fetch_assoc($result);
        $collateral_id=$data['collateral_id'];
        $sql1="SELECT backer_id FROM backers WHERE member_id=$member_id";
        $result=mysqli_query($conn,$sql1);
        $data = mysqli_fetch_assoc($result);
        $backer_id=$data['backer_id'];
        

		$sql = "UPDATE loans set loan_type = '$loan_type' ,loan_amount=$loan_amount,term_months=$term_months, interest_rate = '$interest_rate',start_date='$start_date',request_status='$request_status',status='$status', member_id='$member_id',collateral_id='$collateral_id',backer_id='$backer_id' where loan_id = $loan_idd";
		mysqli_query($conn, $sql);
		
		if (mysqli_affected_rows($conn) == 1) {
			setcookie("sucMessage", "Successfully Accepted Loan Request!", time() + 5, "/");
            header('location:adminDashboard.php');
 			 exit;
	 }
	 else{
	 	echo "Data update failed".mysqli_error($conn);
	 }
	
	$sql1 = "select * from loans where loan_id = $loan_id";
	$res = mysqli_query($conn, $sql1);
	$data = mysqli_fetch_assoc($res);
} else {
    echo "Loan ID is not provided in the URL.";
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
		/* .error{
			color: red;
			display: block;
		} */
	</style>
</head>
<body>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
		<input type="hidden" name="loan_id" value="<?php echo $data['loan_id']; ?>">
		<input type="hidden" name="loan_type" value="<?php echo $data['loan_type']; ?>">
		<br>
		<br>
        <label>Loan Amount</label>
		<input type="text" name="loan_amount" value="<?php echo $data['loan_amount']; ?>">
		<br>
		<br>
        <label>Repayment Period</label>
		<input type="text" name="term_months" value="<?php echo $data['term_months']; ?>">
		<br>
		<br>	
		<label>Interest Rate</label>
		<input type="text" name="interest_rate" value="<?php echo $data['interest_rate']; ?>">
		
		<input type="hidden" name="start_date" value="<?php echo $data['start_date']; ?>">
        <input type="hidden" name="request_status" value="<?php echo $data['request_status']; ?>">
        <input type="hidden" name="status" value="<?php echo $data['status']; ?>">
        <input type="hidden" name="member_id" value="<?php echo $data['member_id']; ?>">
        <input type="hidden" name="collateral_id" value="<?php echo $data['collateral_id']; ?>">
        <input type="hidden" name="backer_id" value="<?php echo $data['backer_id']; ?>">
		<br>
		<br>
		<input type="submit" name="submit" value="Approve">
	</form>
</body>
</html>