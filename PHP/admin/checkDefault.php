<?php
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$current_date = date("Y-m-d");
$sql = "
    SELECT 
        l.loan_id, 
        l.start_date, 
        MAX(e.paid_date) as latest_paid_date,
        TIMESTAMPDIFF(MONTH, IFNULL(MAX(e.paid_date), l.start_date), '$current_date') as months_difference
    FROM loans l
    LEFT JOIN emi e ON l.loan_id = e.loan_id
    WHERE l.status = 'active'
    GROUP BY l.loan_id, l.start_date
";
$result = $conn->query($sql);

// Check and display the results
if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Loan ID</th>
                <th>Loan Start Date</th>
                <th>Latest EMI Paid Date</th>
                <th>Latest EMI Paid Date's Difference from today (in months)</th>
                <th>Confirm Action</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        $latest_paid_date = $row['latest_paid_date'] ? $row['latest_paid_date'] : 'No Payments';
        $months_difference = $row['months_difference'];

        echo "<tr>
                <td>" . $row['loan_id'] . "</td>
                <td>" . $row['start_date'] . "</td>
                <td>" . $latest_paid_date . "</td>
                <td>" . $months_difference . "</td>";
        
        if ($months_difference >= 3) {
            echo "<td><button><a href='defaulter.php?loan_id=" . $row['loan_id'] . "'>Default</a></button></td>";
        } else {
            echo "<td></td>";
        }

        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No loans found.";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/table.css">
    <style>
        table{
            width: 95%;
        }
    </style>
</head>
<body>
    
</body>
</html>
