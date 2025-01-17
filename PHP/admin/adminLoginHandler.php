<?php
session_start();
$dbconfigs = include('../config.db.php');
$db = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
    // username and password sent from form
    // $myemail = addslashes($_POST['email']);
    // $mypassword = addslashes($_POST['password']);

    // $encrypt_password = md5($mypassword);
    // $encrypted_password = stripslashes($encrypt_password);
    
    $adminEmail = $_POST['email'];
    $adminPassword = $_POST['password'];

    try{
    $sql = "SELECT * FROM admins WHERE BINARY admin_email='$adminEmail' and BINARY password='$adminPassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $admin_name=$row['admin_name'];
    $count = mysqli_num_rows($result);

    // If result matched $myemail and $mypassword, table row must be 1 row
    if ($count == 1) {
        session_start();
        $_SESSION['adminLogin_email'] = $adminEmail;
        $_SESSION['admin_name']= $admin_name;
        header("location: adminDashboard.php");
    } else {
        // $error_message = "Invalid Username or Password";
        // header("location: adminLogin.php?error_message=" . $error_message);
        echo '<script>
                alert("Invalid login credentials");
                  setTimeout(function() {
                    window.location.href = "adminLogin.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
    }}
    catch(Exception $e){
        echo '<script>
                alert("Invalid login credentials");
                  setTimeout(function() {
                    window.location.href = "adminLogin.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
    }
}
else{
    echo "Request Method Invalid";
}
?>
