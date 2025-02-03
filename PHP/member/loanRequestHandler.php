<?php
    session_start();
    $member_id = $_SESSION['member_id'];
    $dbconfigs = include('../config.db.php');
    $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);
    
    if(!$conn){
        die("Connection failed: " . mysqli_connect_errno());
    }
    
    $sql = "SELECT * FROM loans WHERE (status='active' || request_status='pending') && member_id=$member_id";
    $result=mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        echo '<script>
                  alert("You have an active loan or pending request for loan");
                  setTimeout(function() {
                    window.location.href = "memberDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
    }
    else{
        header('location:sendLoanRequest.php');
    }
?>

