<?php
    $collateral_id=$_GET['collateral_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql = "SELECT * FROM collaterals AS c
        INNER JOIN members AS m ON c.member_id = m.member_id
        WHERE c.collateral_id = $collateral_id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Member Name</th>
        <th>Email</th>
        <th>Account Number</th>
        <th>Collateral Type</th>
        <th>Collateral Value</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['member_name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['account_no']."</td>";
            echo "<td>".$row['collateral_type']."</td>";
            echo "<td>".$row['collateral_value']."</td>";
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
    <link rel="stylesheet" href="../../CSS/table.css">
    <style>
        .back{
            padding:10px;
            margin-top:10px;
            margin-left:45%;
        }
    </style>
</head>
<body>
    <button class="back"><a href="adminDashboard.php">Back To Dashboard</a></button>
</body>
</html>