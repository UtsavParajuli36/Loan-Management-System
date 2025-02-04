<!-- if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
    // Proceed with your logic here
    $dbconfigs = include ('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    $sql = "UPDATE loans SET request_status='rejected' where loan_id = $loan_id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_affected_rows($conn) == 1) {
        setcookie("sucMessage", "Successfully Rejected Loan Request!", time() + 5, "/");
        header('location:adminDashboard.php');
        exit;
    } else {
        // echo "Data Update failed".mysqli_error($conn);
        setcookie("failMessage", "Loan Request Rejection Failed", time() + 5, "/");
        header('Location: adminDashboard.php');
        exit;
    }

} else {
    setcookie("failMessage", "Loan ID is not provided in the URL.", time() + 5, "/");
    header('Location: adminDashboard.php');
    exit;
    // echo "Loan ID is not provided in the URL.";
} -->
<?php
if (isset($_GET['loan_id'])) {
    $loan_id = $_GET['loan_id'];
    // Proceed with your logic here
    $dbconfigs = include ('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Start transaction
    mysqli_begin_transaction($conn);

    // First query: Update the loan request status
    $sql_update = "UPDATE loans SET request_status='rejected' WHERE loan_id = $loan_id";
    $res_update = mysqli_query($conn, $sql_update);

    // Second query: Delete the last added row from backers table
    $sql_delete = "DELETE FROM backers ORDER BY backer_id DESC LIMIT 1";
    $res_delete = mysqli_query($conn, $sql_delete);

    if ($res_update && $res_delete) {
        mysqli_commit($conn);
        setcookie("sucMessage", "Successfully Rejected Loan Request!", time() + 5, "/");
        header('Location: adminDashboard.php');
        exit;
    } else {
        mysqli_rollback($conn);
        setcookie("failMessage", "Operation Failed", time() + 5, "/");
        header('Location: adminDashboard.php');
        exit;
    }
} else {
    setcookie("failMessage", "Loan ID is not provided in the URL.", time() + 5, "/");
    header('Location: adminDashboard.php');
    exit;
}
?>
