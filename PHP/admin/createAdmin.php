<!DOCTYPE html>
<html lang="en">

<head>
    <title>Creating Admin</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            /* margin: 0;
            padding: 0; */
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        input[type="text"],
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
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <form action="" method="post" onsubmit="return formValidation()">
        Name: <input type="text" name="admin_name" id="admin_name">
        Email: <input type="text" name="email" id="email">
        Password: <input type="password" name="password" id="password">
        <input type="submit" name="submit" value="Submit">
    </form>
    <script type="text/javascript">
        function formValidation() {
            var adminName = document.getElementById("admin_name").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var emailExp = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,5})+$/;

            if (adminName === "") {
                alert("Enter Name");
                return false;
            }

            if (email === "") {
                alert("Enter Email");
                return false;
            }

            if (!email.match(emailExp)) {
                alert("Wrong email format.");
                return false;
            }

            if (password === "") {
                alert("Enter Password");
                return false;
            }

            return true;
        }
    </script>

    <?php
    if (isset($_POST['submit'])) {
        $admin_name = $_POST['admin_name'];
        $admin_email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($admin_name) || empty($admin_email) || empty($password)) {
            echo "<div class='error'>Do not leave any fields empty.</div>";
        } else {
            $dbconfigs = include ('../config.db.php');
            $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
            if (!$conn) {
                die("Connection failed: " .
                    mysqli_connect_errno());
            }
            $sql = "INSERT INTO admins(admin_name,admin_email,password)
            VALUES 
            ('$admin_name','$admin_email','$password')";
            try {
                if (mysqli_query($conn, $sql)) {
                    setcookie("sucMessage", "Successfully Added New Admin!", time() + 5, "/");
                    header('Location: adminDashboard.php');
                    exit;
                }
            } catch (Exception $e) {
                setcookie("failMessage", "Failed to add new Admin!", time() + 5, "/");
                header('Location: adminDashboard.php');
                exit;
                // echo "Error: " .$sql. "<br>" . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
    }
    ?>

</body>

</html>