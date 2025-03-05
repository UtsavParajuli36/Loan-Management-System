<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT DISTINCT loan_type,interest_rate FROM loans WHERE status='active'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<button class='editInt'><a href='editInterestLoan.php'>Edit Interest Rate</a></button>";
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Loan Type</th>
        <th>Interest Rate</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['loan_type']."</td>";
            echo "<td>".$row['interest_rate']."</td>";
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
    <style type="text/css">
        .editInt{
            margin:0 20px 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
</body>
</html>
