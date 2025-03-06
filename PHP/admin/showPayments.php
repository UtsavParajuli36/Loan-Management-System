<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    // $sql="SELECT * FROM emi as e
    // inner join loans as l WHERE e.loan_id=l.loan_id";
    $sql = "SELECT *
    FROM emi AS e
    INNER JOIN loans AS l ON e.loan_id = l.loan_id
    INNER JOIN members AS m ON l.member_id = m.member_id;";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Member ID</th>
        <th>Member Name</th>
        <th>EMI Amount</th>
        <th>Paid Date</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['member_id']."</td>";
            echo "<td>".$row['member_name']."</td>";
            echo "<td>".$row['emi_amount']."</td>";
            echo "<td>".$row['paid_date']."</td>";
            // echo "<td>".$row['balance']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    // echo "<h1>Grouped by Member ID";
    echo "<br>";
    $sql1 = "SELECT m.member_id, m.member_name, SUM(e.emi_amount) AS total_emi, MAX(e.paid_date) AS last_paid_date
        FROM emi AS e
        INNER JOIN loans AS l ON e.loan_id = l.loan_id
        INNER JOIN members AS m ON l.member_id = m.member_id
        GROUP BY m.member_id, m.member_name";
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result1) > 0) {
    echo "<table border='1px'>";
    echo "<tr>";
    echo "<th>Member ID</th>";
    echo "<th>Member Name</th>";
    echo "<th>Total EMI Amount</th>";
    echo "<th>Last Paid Date</th>";
    echo "</tr>";

    while ($row1 = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>".$row1['member_id']."</td>";
        echo "<td>".$row1['member_name']."</td>";
        echo "<td>".$row1['total_emi']."</td>";
        echo "<td>".$row1['last_paid_date']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/table.css">
</head>
<body>
    
</body>
</html>
