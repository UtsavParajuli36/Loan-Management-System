<?php
$dbconfigs = include('../config.db.php');
$db = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
       
    // username and password sent from form
    // $myemail = addslashes($_POST['email']);
    // $mypassword = addslashes($_POST['password']);

    // $encrypt_password = md5($mypassword);
    // $encrypted_password = stripslashes($encrypt_password);
    
    $myemail = $_POST['email'];
    $mypassword = $_POST['password'];

    try{
    $sql = "SELECT * FROM members WHERE BINARY email='$myemail' and BINARY password='$mypassword'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result);
    $member_id=$row['member_id'];
    $member_name=$row['member_name'];
    $account_no=$row['account_no'];
    $count = mysqli_num_rows($result);

    $sql1 = "SELECT * FROM loans WHERE member_id=$member_id && status ='active'";
    $result1 = mysqli_query($db, $sql1);
    $row1 = mysqli_fetch_array($result1);
    $loan_id = $row1['loan_id'];
    // If result matched $myemail and $mypassword, table row must be 1 row
    if ($count == 1) {
        session_start();
        $_SESSION['memberLogin_email'] = $myemail;
        $_SESSION['member_name']= $member_name;
        $_SESSION['member_id']=$member_id;
        $_SESSION['account_no']=$account_no;
        $_SESSION['loan_id']=$loan_id;
        header("location: memberDashboard.php");
    } else {
        $error_message = "Invalid Username or Password";
        header("location:memberLogin.php?error_message=" . $error_message);
        
    }
}
catch(Exception $e){
    echo '<script>
                alert("Invalid login credentials");
                  setTimeout(function() {
                    window.location.href = "memberLogin.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
}
}
else{
    echo "Fail";
}
?>
