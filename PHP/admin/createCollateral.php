<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Collateral</title>
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
    </style>
</head>
<body>
    <form action="" method="post">
        Collateral Type: <input type="text" name="collateral_type"><br>
        Collateral Value: <input type="number" name="collateral_value"><br>
        Member Id: <input type="number" name="member_id"><br>    
        <input type="submit" name="submit" value="Submit"><br>
    </form>

    <?php
    if(isset($_POST['submit'])){
		$collateral_type = $_POST['collateral_type'];
		$collateral_value = $_POST['collateral_value'];
        $member_id=$_POST['member_id'];

        if(empty($collateral_type) || empty($collateral_value) || empty($member_id)){
            echo "Do not Leave the text box Empty";
        }
        else {
            $dbconfigs = include('../config.db.php');
            $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
            if(!$conn){
                die("Connection failed: ".
                mysqli_connect_errno() );
            }
            $sql = "INSERT INTO collaterals
            (collateral_type,collateral_value,member_id)
            VALUES 
            ('$collateral_type','$collateral_value','$member_id')";
            try{
            if(mysqli_query($conn, $sql)) {
                // echo "New record created successfully";
                // header('location:adminDashboard.php');
                echo '<script>
                  alert("New collateral created successfully");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
            }
            else {
                echo '<script>
                  alert("New collateral could not be created. Fill the form correctly!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
                // echo "Error: " .$sql. "<br>" . mysqli_error($conn);
            }
        }
        catch(Exception $e){
            echo '<script>
                  alert("New collateral could not be created. Fill the form correctly!");
                  setTimeout(function() {
                    window.location.href = "adminDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
        }
            mysqli_close($conn);
        }

    }
    ?>
    
</body>
</html>