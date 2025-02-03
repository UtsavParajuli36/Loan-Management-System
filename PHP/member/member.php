<?php
    session_start();
    $member_id=$_SESSION['member_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM members WHERE member_id=$member_id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "
        <th>Name</th>
        <th>Address</th>
        <th>Contact Info</th>
        <th>Email</th>
        <th>Account Number</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            // echo "<td>".$row['member_id']."</td>";
            echo "<td>".$row['member_name']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['email']."</td>";
            // echo "<td>".$row['password']."</td>";
            echo "<td>".$row['account_no']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
mysqli_close($conn);
?>
