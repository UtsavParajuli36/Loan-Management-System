<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sending Loan Request</title>
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
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        Loan Type:
        <select name="loan_type" required>
            <option value="" disabled selected>Select one option</option>
            <option value="Personal Loan">Personal Loan</option>
            <option value="Working Capital Loan">Working Capital Loan</option>
            <option value="Educational Loan">Educational Loan</option>
            <option value="Business Loan">Business Loan</option>
            <option value="Agricultural Loan">Agricultural Loan</option>
            <option value="Industrial Loan">Industrial Loan</option>
            <option value="Higher Purchase Loan">Higher Purchase Loan</option>
            <option value="Home Loan">Home Loan</option>
        </select> <br> <br>
        Loan Amount: <input type="number" name="loan_amount" max="2500000" required><br> <br>
        Total Term For Loan Payment In Months: <input type="number" name="term_months" max="36" required><br> <br>
        Account Number Of Backer: <input type="text" name="account_no_of_backer" required><br> <br>
        <input type="submit" name="submit" value="Send"><br>
    </form>
</body>

</html>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        $member_id = $_SESSION['member_id'];
        $loan_type = $_POST['loan_type'];
        $loan_amount = $_POST['loan_amount'];
        $term_months = $_POST['term_months'];
        $account_no_of_backer = $_POST['account_no_of_backer'];

        if (empty($loan_type) || empty($loan_amount) || empty($term_months) || empty($account_no_of_backer)) {
            echo "<script>alert('Do not leave the text boxes empty');</script>";
        } else if ($loan_amount <= 10000) {
            echo "<script>alert('Loan Amount should not be less than 10000');</script>";
        } else if ($term_months < 0) {
            echo "<script>alert('The maturity period cannot be negative');</script>";
        } else {
            $dbconfigs = include ('../config.db.php');
            $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            //         $conn->autocommit(false);

            //         try {
            //             $stmt1 = $conn->prepare("INSERT INTO loans (loan_type, loan_amount, term_months, member_id) VALUES (?, ?, ?, ?)");
            //             $stmt1->bind_param("siii", $loan_type, $loan_amount, $term_months, $member_id);

            //             $stmt2 = $conn->prepare("INSERT INTO backers (member_id, account_no_of_backer) VALUES (?, ?)");
            //             $stmt2->bind_param("is", $member_id, $account_no_of_backer);

            //             $stmt1->execute();
            //             $stmt2->execute();

            //             $conn->commit();
            //             echo '<script>
            //                 alert("Loan Request Sent successfully");
            //                 setTimeout(function() {
            //                     window.location.href = "memberDashboard.php";
            //                 }, 10); 
            //             </script>';
            //         } catch (Exception $e) {
            //             $conn->rollback();
            //             echo '<script>
            //                 alert("Loan Request Could not be sent. A single account holder cannot be a backer for mulitiple loans.");
            //                 setTimeout(function() {
            //                     window.location.href = "memberDashboard.php";
            //                 }, 10); 
            //             </script>';
            //         }

            //         $stmt1->close();
            //         $stmt2->close();
            //         $conn->close();
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            try {
                // Start a transaction
                $conn->begin_transaction();

                // Prepare the SQL statement for loans
                $stmt1 = $conn->prepare("INSERT INTO loans (loan_type, loan_amount, term_months, member_id) VALUES (?, ?, ?, ?)");
                $stmt1->bind_param("siii", $loan_type, $loan_amount, $term_months, $member_id);
                $stmt1->execute();

                // Prepare the SQL statement for backers
                $stmt2 = $conn->prepare("INSERT INTO backers (member_id, account_no_of_backer) VALUES (?, ?)");
                $stmt2->bind_param("is", $member_id, $account_no_of_backer);
                $stmt2->execute();

                // Commit the transaction
                $conn->commit();

                echo '<script>
        alert("Loan Request Sent successfully");
        setTimeout(function() {
            window.location.href = "memberDashboard.php";
        }, 10); 
    </script>';
            } catch (mysqli_sql_exception $e) {
                // Rollback the transaction if an exception occurs
                $conn->rollback();
                echo '<script>
        alert("Loan Request could not be sent.");
        setTimeout(function() {
            window.location.href = "memberDashboard.php";
        }, 10); 
    </script>';
            } finally {
                // Close the statements and the connection
                $stmt1->close();
                $stmt2->close();
                $conn->close();
            }
        }
    }
}
?>