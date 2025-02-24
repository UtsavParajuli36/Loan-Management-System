<?php
    $backer_id=$_GET['backer_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql = "SELECT * FROM backers AS b
        INNER JOIN members AS m ON b.account_no_of_backer = m.account_no 
        WHERE b.backer_id = $backer_id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Member Name</th>
        <th>Email</th>
        <th>Account Number</th>
        <th>Address</th>
        <th>Phone</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['member_name']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td>".$row['account_no']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['phone']."</td>";
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