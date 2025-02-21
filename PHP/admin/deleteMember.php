<?php
$member_id = $_GET['member_id'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if(!$conn){
    echo "Connection failed.";
}
$sql="DELETE FROM members
WHERE member_id=$member_id";
mysqli_query($conn,$sql);
header('location:adminDashboard.php');
?>

