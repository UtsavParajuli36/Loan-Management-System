<?php
    session_start(); // Start the session
    $member_id=$_SESSION['member_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    // $sql="SELECT * FROM loans WHERE request_status='rejected' && member_id=$member_id";
    $sql = "SELECT *
        FROM loans as l
        INNER JOIN description as d
        ON l.loan_id = d.loan_id
        WHERE l.request_status = 'rejected' AND l.member_id = $member_id AND d.status='rejected'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Loan Type</th>
        <th>Loan Amount</th>
        <th>Repayment Period</th>
        <th>Request Status</th>
        <th>Description</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['loan_type']."</td>";
            echo "<td>".$row['loan_amount']."</td>";
            echo "<td>".$row['term_months']."</td>";
            echo "<td>".$row['request_status']."</td>";
            echo "<td>".$row['description']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<h1>You have no Rejected loans.</h1>";
    }
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table{
            width:95%;
        }
        /* td button{
            margin:5px;
        } */
    </style>
</head>
<body>
    
</body>
</html>
