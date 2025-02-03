<?php
session_start(); // Start the session
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_errno());
}

$sql = "SELECT * FROM loans WHERE request_status='pending'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1px'>";
    echo "<tr>
        <th>Loan Type</th>
        <th>Loan Amount</th>
        <th>Repayment Period</th>
        <th>Interest Rate</th>
        <th>Start Date</th>
        <th>Request Status</th>
        <th>Collateral Id</th>
        <th>Backer Id</th>
        <th>Member Id</th>
        <th>Action</th>
    </tr>";

    function isCollateralAdded($conn, $member_id)
    {
        $result1 = mysqli_query($conn, "SELECT collateral_id FROM collaterals WHERE member_id = $member_id");
        if ($result1) {
            $row1 = mysqli_fetch_assoc($result1);
            return !empty($row1['collateral_id']);
        } else {
            return false;
        }
    }

    // Loop through each row of the result
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['loan_type'] . "</td>";
        echo "<td>" . $row['loan_amount'] . "</td>";
        echo "<td>" . $row['term_months'] . "</td>";
        echo "<td>" . $row['interest_rate'] . "</td>";
        echo "<td>" . $row['start_date'] . "</td>";
        echo "<td>" . $row['request_status'] . "</td>";
        echo "<td>" . $row['collateral_id'] . "</td>";
        echo "<td>" . $row['backer_id'] . "</td>";
        echo "<td>" . $row['member_id'] . "</td>";

        $collateral_added = isCollateralAdded($conn, $row['member_id']);

        echo "<td>";
        if ($collateral_added) {
            echo "<button class='aprBtn'><a href='approveLoanRequest.php?loan_id=" . $row['loan_id'] . "'>Approve</a></button>";
        } else {
            echo "<button disabled>No Collateral</button>";
        }
        echo "<button class='delBtn'><a href='rejectDescription.php?loan_id=" . $row['loan_id'] . "'>Reject</a></button>";
        echo "</td>";

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No pending loan requests.";
}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Management System</title>
    <link rel="stylesheet" href="../../CSS/table.css">
    <style>
        table {
            width: 95%;
            border-collapse: collapse;
        }
        td button {
            margin: 5px;
        }
        .aprBtn a{
            color: green;
        }
        .delBtn a {
            text-decoration: none;
            color: red;
        }
    </style>
</head>
<body>
</body>
</html>
