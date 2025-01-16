<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../CSS/adminDashboard.css">
    <link rel="stylesheet" href="../../CSS/table.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="main">
    <div id="sidebar">
        <h1>SMSC</h1>
        <ul>
            <li><a href="admin.php" class="load-admin">Admins</a></li>  
            <li><a href="account.php" class="load-account">Accounts</a></li>
            <li><a href="member.php" class="load-member">Members</a></li>
            <li><a href="collateral.php" class="load-collateral">Collaterals</a></li>
            <li><a href="loanRequest.php" class="load-loanReq">Loan Requests</a></li>
            <li><a href="approvedLoans.php" class="load-appLoan">Approved Loans</a></li>
            <li><a href="rejectedLoans.php" class="load-rejLoan">Rejected Loans</a></li>
            <li><a href="activeLoans.php" class="load-actLoan">Active Loans</a></li>
            <li><a href="expiredLoans.php" class="load-expLoan">Expired Loans</a></li>
            <li><a href="defaultedLoans.php" class="load-defLoan">Defaulted Loans</a></li>
            <li><a href="interestLoan.php" class="load-intLoan">Change interest_rate(Loans)</a></li>
            <li><a href="interestAccount.php" class="load-intAcc">Change interest_rate(Accounts)</a></li>
            <li><a href="showPayments.php" class="load-payInf">Show Payment Information</a></li>
        </ul>
    </div>

    <div class="total-content">
        <div id="login-btn" class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $_SESSION['admin_name']; ?>
            </button>
            <div class="dropdown-menu profile-menu">
                <a class="dropdown-item" href="">Your Profile</a>
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>

        <div id="content">
            
        </div>

        <div class="sucMessage">
          <?php
          if(isset($_COOKIE['sucMessage'])) {
            $message = $_COOKIE['sucMessage'];
            echo $message;
        }        
          ?>
        </div>
        <div class="failMessage">
          <?php
          if(isset($_COOKIE['failMessage'])) {
            $message = $_COOKIE['failMessage'];
            echo $message;
        }        
          ?>
        </div>
        
    </div>
</div>

<script type="text/javascript">
    const loginBtn = document.getElementById('login-btn');
    const profileMenu = loginBtn.querySelector('.dropdown-menu');

    loginBtn.addEventListener('click', () => {
    // Toggle the visibility of the dropdown menu
      if (profileMenu.classList.contains('show')) {
        profileMenu.classList.remove('show');
      } else {
        profileMenu.classList.add('show');
    }
});
</script>

<script>
$(document).ready(function() {
  $('.load-admin').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-account').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-member').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-collateral').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-loanReq').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-appLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-rejLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-actLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-expLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-defLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-intLoan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-intAcc').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-payInf').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-def').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});

</script>

<button id="myButton" ><a href="checkDefault.php" class="load-def">Check For Defaulters</a></button>
</body>
</html>
