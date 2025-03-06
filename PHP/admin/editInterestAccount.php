<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    if(isset($_POST['submit'])) {
		$acc_type = $_POST['account_type'];
        $account_type=strtolower($acc_type);
		$interest_rate = $_POST['interest_rate'];

        if(($account_type=="general saving" || $account_type=="generalsaving") && $interest_rate>0){
            $sql1="UPDATE accounts 
            SET interest_rate=$interest_rate WHERE account_no LIKE 'gs%'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for General Saving Account changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for general saving'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if(($account_type=="fixed deposit" || $account_type=="fixeddeposit") && $interest_rate>0){
            $sql2="UPDATE accounts 
            SET interest_rate=$interest_rate WHERE account_no LIKE 'fd%'";
            $result=mysqli_query($conn,$sql2);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Fixed Deposit Account changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for fixed deposit'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        }
        else{
            mysqli_close($conn);
            echo '<script>
                  alert("Account Type or Interest Rate format is wrong!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
        }
        
    }
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/table.css">
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
</head>
<body>
    <form action="" method="post">
        Account Type: <input type="text" name="account_type"><br> <br>
        Interest Rate: <input type="number" name="interest_rate"><br> <br>
        <input type="submit" name="submit" value="Change Interest Rate">
    </form>
</body>
</html>
