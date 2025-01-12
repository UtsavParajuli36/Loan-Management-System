<?php
if (isset($_POST['submit'])) {
    if (($_POST['submit']) != false) {
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $accNo = $_POST['accNo'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['rpassword'];
        $conn = mysqli_connect('localhost', 'root', '', 'SMSC_project');
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_errno());
        }
        if (
            empty($name)
            || !(preg_match("/^[a-zA-Z ]*$/", $name))
            || empty($address)
            || empty($phone)
            || !(preg_match("/^98[0-9]{8}$/", $phone))
            || empty($accNo)
            || !(preg_match("/^[a-zA-Z0-9]*$/", $accNo))
            || empty($email)
            || !(filter_var($email, FILTER_VALIDATE_EMAIL))
            || empty($password)
            || empty($rpassword)
            || ($password != $rpassword)
        ) {
            echo '<script>
                alert("Please fill all fields correctly and ensure passwords match.");
                window.location.href = "register.php";
            </script>';
            mysqli_close($conn);
        }
        $sql = "SELECT COUNT(*) FROM members WHERE account_no = ?";
        $stmt = $conn->prepare($sql);

        // Bind the parameter to the query
        $stmt->bind_param("s", $accNo);

        // Execute the query
        $stmt->execute();

        // Bind the result to a variable
        $stmt->bind_result($count);
        $stmt->fetch();

        if ($count > 0) {
            echo '<script>
            alert("A member already exists with the provided account number!");
            window.location.href = "register.php";
            </script>';
            $stmt->close();
        } else {
            $stmt->close();
            $sql1 = "INSERT INTO members(member_name,address,phone,email,password,account_no)
            VALUES 
            ('$name','$address','$phone','$email','$password','$accNo')";
            try {
                if (mysqli_query($conn, $sql1)) {
                    echo '<script>
                    alert("Your information has been submitted.");
                    window.location.href = "member/memberLogin.php";
                </script>';
                }
            } catch (Exception $e) {
                echo '<script>
                alert("Error: ' . $e->getMessage() . '");
                window.location.href = "register.php";
            </script>';
            }
        }

        mysqli_close($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <style type="text/css">
        * {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <br>
    <button><a href="register.php">Back To Register</a></button>
</body>

</html>