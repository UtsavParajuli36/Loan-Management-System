<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM members";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Id</th>
        <th>Name</th>
        <th>Address</th>
        <th>Contact Info</th>
        <th>Email</th>
        <th>Account Number</th>
        <th>Action</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['member_id']."</td>";
            echo "<td>".$row['member_name']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['phone']."</td>";
            echo "<td>".$row['email']."</td>";
            // echo "<td>".$row['password']."</td>";
            echo "<td>".$row['account_no']."</td>";

?>
        <td>
            <button><a href="<?php echo 'editMember.php?member_id=' . $row['member_id'] ?>">Edit</a></button>
            <!-- <button class="delBtn"><a href="<?php echo 'deleteMember.php?member_id=' . $row['member_id']?>">Delete</a></button> -->
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
</head>
<body>
    <button class="aButton"><a href="createMember.php" class="first">Create Member</a></button>
</body>
</html>
