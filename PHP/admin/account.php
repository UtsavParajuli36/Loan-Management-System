<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM accounts";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Account Number</th>
        <th>Account Type</th>
        <th>Interest Rate</th>
        <th>Balance</th>
        <th>Action</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['account_no']."</td>";
            echo "<td>".$row['account_type']."</td>";
            echo "<td>".$row['interest_rate']."</td>";
            echo "<td>".$row['balance']."</td>";

?>
        <td>
            <button><a href="<?php echo 'editAccount.php?account_no=' . $row['account_no'] ?>">Edit</a></button>
            <button class="delBtn"><a href="<?php echo 'deleteAccount.php?account_no=' . $row['account_no']?>" class="unclickable-link">Delete</a></button>
        </td>
<?php
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
        .unclickable-link {
    pointer-events: none;
    color: gray; 
    }
    </style>
</head>
<body>
    <button class="aButton"><a href="createAccount.php" class="first">Create a new Account</a></button>
</body>
</html>