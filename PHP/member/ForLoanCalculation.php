<?php
session_start();
$member_id = $_SESSION['member_id'];
$loan_id = $_SESSION['loan_id'];
$dbconfigs = include ('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}
$sql1 = "SELECT * FROM emi WHERE loan_id='$loan_id'";
$result1 = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result1) >= 0) {
    $sql = "SELECT * FROM loans WHERE member_id='$member_id' and status='active'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $n = $row['term_months'];
        $loan_amount = $row['loan_amount'];
        $interest_rate = $row['interest_rate'];
        $i = ($interest_rate / 100) / 12;
        $a = pow((1 + $i), -$n);
        $EMI = $loan_amount / ((1 - ($a)) / $i);
        $EMI_amount = round($EMI, 2);

        // Setting Cookie for Calculating Total Principal + Interest Rate
        $totalLoanAmount = $EMI_amount * $n;
        setcookie("totalamount", $totalLoanAmount, time() + (86400 * 30 * $n), "/");
        header('location:payments.php');
    } else {
        echo "<h1>You have no active loans to pay EMI.</h1>";
    }
}
 else {
    header('location:payments.php');
}
?>