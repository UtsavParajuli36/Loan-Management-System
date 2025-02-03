<?php
    session_start(); // Start the session
    $account_no=$_SESSION['account_no'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM accounts WHERE account_no='$account_no'";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Account Number</th>
        <th>Account Type</th>
        <th>Interest Rate</th>
        <th>Balance</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['account_no']."</td>";
            echo "<td>".$row['account_type']."</td>";
            echo "<td>".$row['interest_rate']."</td>";
            echo "<td>".$row['balance']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
mysqli_close($conn);
?>
