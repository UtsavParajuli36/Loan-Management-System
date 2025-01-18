<?php
$account_no = $_GET['account_no'];
$dbconfigs = include('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if(!$conn){
    echo "Connection failed.";
}
$sql1="DELETE FROM members
WHERE account_no='$account_no'";
$sql2="DELETE FROM accounts
WHERE account_no='$account_no'";
mysqli_query($conn,$sql1);
mysqli_query($conn,$sql2);
// header('location:adminDashboard.php');
if(mysqli_affected_rows($conn)>=0){

echo '<script>
                    alert("Account Deleted Successfully");
                    setTimeout(function() {
                        window.location.href = "adminDashboard.php";
                    }, 10); 
                </script>';
}else{
    echo '<script>
                    alert("Account could not be Deleted");
                    setTimeout(function() {
                        window.location.href = "adminDashboard.php";
                    }, 10); 
                </script>';
}
?>

