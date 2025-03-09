<?php
session_start();
$member_id = $_SESSION['member_id'];
$dbconfigs = include ('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}

$sql = "SELECT * FROM loans WHERE member_id='$member_id' and status='active'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_array($result);

    $loan_id = $row['loan_id'];
    $n = $row['term_months'];
    $start_date = $row['start_date'];

    $s = strtotime($start_date);
    $e = strtotime('+' . $n . 'months', $s);
    $end_date = date("Y-m-d ", $e);


    $loan_amount = $row['loan_amount'];
    $interest_rate = $row['interest_rate'];
    $i = ($interest_rate / 100) / 12;


    $a = pow((1 + $i), -$n);
    $EMI = $loan_amount / ((1 - ($a)) / $i);
    $EMI_amount = round($EMI, 2);
    $_SESSION['emi_amt'] = $EMI_amount;


    $eemi = ceil($EMI / 100) * 100;

    $sql1 = "SELECT * FROM emi WHERE loan_id=$loan_id";
    $result1 = mysqli_query($conn, $sql1);
    $emi_amount = 0;
    if (mysqli_num_rows($result1) > 0) {

        while ($row1 = mysqli_fetch_assoc($result1)) {
            $emi_amount = $emi_amount + $row1['emi_amount'];
        }
        // echo $emi_amount;
        $member_id=$_SESSION['member_id'];
        $totalamount=$_COOKIE['totalamount'];
        $remaining_amount=$totalamount-$emi_amount;
    } else {
        // Yet to add more amount. Only principal amount has been shown here.
        $remaining_amount = $loan_amount;
    }
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1px'>";
        echo "<tr>";
        echo "
        <th>Loan Id</th>
        <th>Loan Amount</th>
        <th>Interest Rate</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>EMI Amount</th>
        <th>Remaining Amount</th>";
        echo "</tr>";

        echo "<tr>";
        echo "<td>" . $row['loan_id'] . "</td>";
        echo "<td>" . $row['loan_amount'] . "</td>";
        echo "<td>" . $row['interest_rate'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $end_date . "</td>";
        echo "<td>" . $EMI_amount . "</td>";
        echo "<td>" . $remaining_amount . "</td>";
        echo "</tr>";

        echo "</table>";
    }
    include ('dummyForPayment.php');
    // if($remaining_amount >= -5 && $remaining_amount < 5){
    //     include ('dummyForPayment.php');
    // }
    
} else {
    echo "<h1>You have no active loans to pay EMI.</h1>";
}
?>