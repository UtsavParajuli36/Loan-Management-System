<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Account</title>
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
        Account Number: <input type="text" name="account_no" required><br>
        Account Type: <input type="text" name="account_type" required><br>
        Interest Rate: <input type="number" name="interest_rate" required><br>
        Balance: <input type="number" name="balance" required><br>    
        <input type="submit" name="submit" value="Create Account"><br>
    </form>

    <?php
    // if(isset($_POST['submit'])){
    //     $account_no=$_POST['account_no'];
    //     $account_type=$_POST['account_type'];
    //     $interest_rate=$_POST['interest_rate'];
    //     $balance=$_POST['balance'];
    //     if(empty($account_no) || empty($account_type) || empty($interest_rate) || empty($balance)){
    //         echo "Do not Leave the text box Empty";
    //     }
        
    //     else {
    //         $dbconfigs = include('../config.db.php');
    //         $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    //         if(!$conn){
    //             die("Connection failed: ".
    //             mysqli_connect_errno() );
    //         }
    //         $sql = "INSERT INTO accounts
    //         VALUES 
    //         ('$account_no','$account_type','$interest_rate','$balance')";
    //         if(mysqli_query($conn, $sql)) {
    //             echo "New record created successfully";
    //             header('location:adminDashboard.php');
    //         }
    //         else {
    //             echo "Error: " .$sql. "<br>" . mysqli_error($conn);
    //         }
    //         mysqli_close($conn);
    //     }

    // }
    ?>
    
</body>
</html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Creating Account</title>
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
    <script>
        function validateForm() {
            let accountNo = document.forms["accountForm"]["account_no"].value;
            let accountType = document.forms["accountForm"]["account_type"].value;
            let interestRate = document.forms["accountForm"]["interest_rate"].value;
            let balance = document.forms["accountForm"]["balance"].value;
            let errors = [];

            if (accountNo == "") {
                errors.push("Account Number must be filled out");
            }
            if (accountType == "") {
                errors.push("Account Type must be filled out");
            }
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
    <form name="accountForm" action="" method="post" onsubmit="return validateForm()">
        Account Number: <input type="text" name="account_no" required><br>
        Account Type: <input type="text" name="account_type" required><br>
        Interest Rate: <input type="number" name="interest_rate" step="0.01" required><br>
        Balance: <input type="number" name="balance" step="0.01" required><br>    
        <input type="submit" name="submit" value="Create Account"><br>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $account_no = trim($_POST['account_no']);
        $account_type = trim($_POST['account_type']);
        $acType=strtolower($account_type);
        $interest_rate = trim($_POST['interest_rate']);
        $balance = trim($_POST['balance']);
        $errors = [];

        if (empty($account_no)) {
            $errors[] = "Account Number must be filled out";
        }
        if (empty($account_type)) {
            $errors[] = "Account Type must be filled out";
        }
        if (empty($interest_rate) || !is_numeric($interest_rate) || $interest_rate <= 0) {
            $errors[] = "Interest Rate must be a positive number";
        }
        if (empty($balance) || !is_numeric($balance) || $balance < 0) {
            $errors[] = "Balance must be a non-negative number";
        }
        if($acType!='general saving' && $acType!='fixed deposit' && $acType!='generalsaving' && $acType!='fixeddeposit'){
            $errors[] = "Account Type not valid";
        }

        if (!empty($errors)) {
            echo "<div class='error'>";
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
            echo "</div>";
        } else {
            $dbconfigs = include('../config.db.php');
            $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_errno());
            }
            $sql = "INSERT INTO accounts (account_no, account_type, interest_rate, balance)
                    VALUES ('$account_no', '$account_type', '$interest_rate', '$balance')";
            try{
                if (mysqli_query($conn, $sql)) {
                    echo '<script>
                    alert("New Account Created Successfully");
                    setTimeout(function() {
                        window.location.href = "adminDashboard.php";
                    }, 10); 
                </script>';
                // echo "New record created successfully";
                // header('Location: adminDashboard.php');
                // exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }catch(Exception $e){
            echo '<script>
                    alert("Account number cannot be same");
                    setTimeout(function() {
                        window.location.href = "adminDashboard.php";
                    }, 10); 
                </script>';
        }
            mysqli_close($conn);
        }
    }
    ?>
    
</body>
</html>
