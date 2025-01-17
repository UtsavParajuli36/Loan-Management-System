<?php
$admin_id = $_GET['admin_id'];
$dbconfigs = include ('../config.db.php');
$conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
if (!$conn) {
    echo "Connection failed.";
}
$sql = "DELETE FROM admins
WHERE admin_id=$admin_id";
mysqli_query($conn, $sql);
// header('location:adminDashboard.php');
echo "<script>
        alert('Deleted admin successfully')
        setTimeout(function() {
            window.location.href = 'adminDashboard.php'
        }, 10); 
    </script>";
?>