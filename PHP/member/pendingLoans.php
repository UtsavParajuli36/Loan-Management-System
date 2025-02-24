<?php
    session_start(); // Start the session
    $member_id=$_SESSION['member_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM loans WHERE request_status='pending' AND member_id=$member_id";
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
        <th>Collateral Id</th>
        <th>Backer Id</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['loan_type']."</td>";
            echo "<td>".$row['loan_amount']."</td>";
            echo "<td>".$row['term_months']."</td>";
            echo "<td>".$row['interest_rate']."</td>";
            echo "<td>".$row['start_date']."</td>";
            echo "<td>".$row['request_status']."</td>";
            echo "<td>".$row['collateral_id']."</td>";
            echo "<td>".$row['backer_id']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<h1>You have no Pending loan.</h1>";
    }
mysqli_close($conn);
?>
