<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Member</title>
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
        input[type="password"],
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
        Name: <input type="text" name="member_name"><br> <br>
        Address: <input type="text" name="address"><br> <br>
        Phone: <input type="number" name="phone"><br> <br>
        Email: <input type="text" name="email"><br> <br>
        Password: <input type="password" name="password"><br> <br> 
        Account Number: <input type="text" name="account_no"><br> <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <?php
    if(isset($_POST['submit'])){
        $member_name=$_POST['member_name'];
        $address=$_POST['address'];
        $phone=$_POST['phone'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $account_no=$_POST['account_no'];
        if(empty($member_name) || empty($address) || empty($phone) || empty($email) || empty($password) || empty($account_no)){
            echo "Do not Leave the text box Empty";
        }
        else {
            $dbconfigs = include('../config.db.php');
            $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
            if(!$conn){
                die("Connection failed: ".
                mysqli_connect_errno() );
            }
            $sql = "INSERT INTO members(member_name,address,phone,email,password,account_no)
            VALUES 
            ('$member_name','$address','$phone','$email','$password','$account_no')";
            if(mysqli_query($conn, $sql)) {
                echo "New record created successfully";
                header('location:adminDashboard.php');
            }
            else {
                echo "Error: " .$sql. "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }

    }
    ?>
    
</body>
</html>