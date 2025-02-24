<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM loans WHERE status='active'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Loan Type</th>
        <th>Loan Amount</th>
        <th>Repayment Period</th>
        <th>Interest Rate</th>
        <th>Start Date</th>
        <th>Request Status</th>
        <th>Loan Status</th>
        <th>Collateral Id</th>
        <th>Backer Id</th>
        <th>Member Id</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['loan_type']."</td>";
            echo "<td>".$row['loan_amount']."</td>";
            echo "<td>".$row['term_months']."</td>";
            echo "<td>".$row['interest_rate']."</td>";
            echo "<td>".$row['start_date']."</td>";
            echo "<td>".$row['request_status']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "<td><a href='showColInfo.php?collateral_id=" . $row['collateral_id'] . "'>" . $row['collateral_id'] . "</a></td>";
            echo "<td><a href='showBackInfo.php?backer_id=".$row['backer_id']."'>".$row['backer_id']."</a></td>";
            echo "<td><a>".$row['member_id']."</a></td>";
            echo "</tr>";
        }
        echo "</table>";
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
        td button{
            margin:5px;
        }
    </style>
</head>
<body>
    
</body>
</html>
