<?php
$collateral_id = $_GET['collateral_id'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if(!$conn){
    echo "Connection failed.";
}
$sql1="DELETE FROM collaterals
WHERE collateral_id=$collateral_id";
mysqli_query($conn,$sql1);
header('location:adminDashboard.php');
?>

