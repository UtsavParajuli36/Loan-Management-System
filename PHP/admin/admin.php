<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM admins";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Id</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['admin_id']."</td>";
            echo "<td>".$row['admin_name']."</td>";
            echo "<td>".$row['admin_email']."</td>";
            // echo "<td>".$row['password']."</td>";

?>
        <td>
            <button><a href="<?php echo 'editAdmin.php?admin_id=' . $row['admin_id'] ?>">Edit</a></button>
            <button class="delBtn"><a href="<?php echo 'deleteAdmin.php?admin_id=' . $row['admin_id']?>" class="unclickable-link">Delete</a></button>
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
    <button class="aButton"><a href="createAdmin.php" class="first">Create Admin</a></button>
</body>
</html>
