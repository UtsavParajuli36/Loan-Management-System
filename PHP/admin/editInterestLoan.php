<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    if(isset($_POST['submit'])) {
		$lo_type = $_POST['loan_type'];
        $loan_type=strtolower($lo_type);
		$interest_rate = $_POST['interest_rate'];

        if($loan_type=="personal loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Personal Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Personal Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Personal Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="working capital loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Working Capital Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Working Capital Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Working Capital Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="educational loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Educational Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Educational Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Educational Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="business loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Business Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Business Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Business Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="agricultural loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Agricultural Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Agricultural Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Agricultural Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="industrial loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Industrial Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Industrial Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Industrial Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="higher purchase loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Higher Purchase Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Higher Purchase Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Higher Purchase Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        } else if($loan_type=="home loan" && $interest_rate>0){
            $sql1="UPDATE loans 
            SET interest_rate=$interest_rate WHERE loan_type='Home Loan' && status='active'";
            $result=mysqli_query($conn,$sql1);
            if (mysqli_affected_rows($conn) >= 1) {
                echo '<script>
                  alert("Interest Rate for Home Loan changed!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
            else{
                echo '<script>
                  alert("Data update failed for Home Loan'.mysqli_error($conn).'");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php"
                  }, 10);
                </script>';
            }
        }
        else{
            mysqli_close($conn);
            echo '<script>
                  alert("Loan Type or Interest Rate format is wrong!");
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
        Loan Type: <input type="text" name="loan_type"><br> <br>
        Interest Rate: <input type="number" name="interest_rate"><br> <br>
        <input type="submit" name="submit" value="Change Interest Rate">
    </form>
</body>
</html>
