<?php
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    if(!$conn){
     die("Connection failed: ".mysqli_connect_errno());
    }
    $sql="SELECT * FROM collaterals";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo "<table border='1px'>";
        echo "<tr>";
        echo "<th>Collateral Id</th>
        <th>Collateral Type</th>
        <th>Collateral Value</th>
        <th>Member Id</th>
        <th>Action</th>";
        echo "</tr>";
        while($row=mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$row['collateral_id']."</td>";
            echo "<td>".$row['collateral_type']."</td>";
            echo "<td>".$row['collateral_value']."</td>";
            echo "<td>".$row['member_id']."</td>";

?>
        <td>
            <button><a href="<?php echo 'editCollateral.php?collateral_id=' . $row['collateral_id'] ?>">Edit</a></button>
            <button class="delBtn"><a href="<?php echo 'deleteCollateral.php?collateral_id=' . $row['collateral_id']?>">Delete</a></button>
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
    <button class="aButton"><a href="createCollateral.php" class="first">Create a new Collateral</a></button>
</body>
</html>
