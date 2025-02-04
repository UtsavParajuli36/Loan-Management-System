<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <textarea name="description" id="" placeholder="Write Desciption For Rejection"></textarea>
    </form>
</body>
</html>
<?php
// if (isset($_GET['loan_id'])) {
//     $loan_id = $_GET['loan_id'];
//     // Proceed with your logic here
//     $dbconfigs = include ('../config.db.php');
//     $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
//     $desc=$_POST['description'];
//     $status='rejected';
//     $sql = "INSERT INTO description VALUES ($desc,$loan_id,$status)";
//     $res = mysqli_query($conn, $sql);

//     if (mysqli_affected_rows($conn) == 1) {
//         setcookie("sucMessage", "Successfully Added Desription", time() + 5, "/");
//         header("location:rejectLoanRequest.php?loan_id=$loan_id");
//         exit;
//     } else {
//         // echo "Data Update failed".mysqli_error($conn);
//         setcookie("failMessage", "Failed to add Description", time() + 5, "/");
//         header('Location: adminDashboard.php');
//         exit;
//     }

// } else {
//     setcookie("failMessage", "Loan ID is not provided in the URL.", time() + 5, "/");
//     header('Location: adminDashboard.php');
//     exit;
// } 
?> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reject Loan Request</title>
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

        textarea,
        input[type="submit"],
        select {
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
        <textarea name="description" id="description" placeholder="Write Description For Rejection" required></textarea>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>

<?php
if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
        $dbconfigs = include('../config.db.php');
        $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Get and sanitize the input
        $desc = mysqli_real_escape_string($conn, $_POST['description']);
        $status = 'rejected';

        // Insert the description
        $sql = "INSERT INTO description (description, loan_id, status) VALUES ('$desc', $loan_id, '$status')";
        $res = mysqli_query($conn, $sql);

        if ($res && mysqli_affected_rows($conn) == 1) {
            setcookie("sucMessage", "Successfully Added Description", time() + 5, "/");
            mysqli_close($conn);
            header("Location: rejectLoanRequest.php?loan_id=$loan_id");
            exit;
        } else {
            setcookie("failMessage", "Failed to add Description", time() + 5, "/");
            mysqli_close($conn);
            header('Location: adminDashboard.php');
            exit;
        }
    }
} else {
    setcookie("failMessage", "Loan ID is not provided in the URL.", time() + 5, "/");
    // header('Location: adminDashboard.php');
    exit;
}
?>

