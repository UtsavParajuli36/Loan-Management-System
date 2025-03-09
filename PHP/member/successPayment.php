<?php
    session_start();
    $emi=$_SESSION['totalAmount'];
    $actualEMI=$_SESSION['emi_amt']; 
    $account_no = $_SESSION['account_no'];
    $paid_date = date("Y/m/d");
    $loan_id=$_SESSION['loan_id'];
    $dbconfigs = include ('../config.db.php');
     $conn = mysqli_connect($dbconfigs->hostname, $dbconfigs->username, $dbconfigs->password, $dbconfigs->database);

    if (!$conn) {
       die("Connection failed: " . mysqli_connect_errno());
    }
    $sql = "UPDATE accounts SET balance = balance + $emi WHERE account_no = '$account_no'";
		mysqli_query($conn, $sql);
    if (!(mysqli_affected_rows($conn) == 1)) {
      echo '<script>
                  alert("Could not update account");
                  setTimeout(function() {
                    window.location.href = "memberDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';
    }
    else{
    $conn->begin_transaction();

	try {
        // Perform operations within the transaction
       
        $query1 = "UPDATE accounts SET balance = balance - $actualEMI WHERE account_no = '$account_no'";
        $query2 = "INSERT INTO emi (emi_amount,paid_date,loan_id) VALUES
        ('$actualEMI','$paid_date','$loan_id')";
    
        $conn->query($query1);
        $conn->query($query2);
        
        // Commit the transaction if all operations are successful
        $conn->commit();

        echo '<script>
                  alert("Payment Made successfully");
                  setTimeout(function() {
                    window.location.href = "memberDashboard.php";
                  }, 10); // Adjust delay in milliseconds
                </script>';

    } catch (Exception $e) {
        // Rollback the transaction if any operation fails
        $conn->rollback();
        echo '<script>
        alert("Account has been credited but insufficient balance for EMI payment' . $e->getMessage() . '");
        setTimeout(function() {
          window.location.href = "memberDashboard.php";
        }, 10); // Adjust delay in milliseconds
      </script>';
    }  
    mysqli_close($conn);
  }
?>