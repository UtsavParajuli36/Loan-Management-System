<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="../../CSS/dashboard.css">
    <link rel="stylesheet" href="../../CSS/table.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="main">
    <div id="sidebar">
        <h1>SMSC</h1>
        <ul>
            <li><a href="member.php" class="load-member">See My Profile</a></li>
            <li><a href="memberAccount.php" class="load-account">My Account</a></li>
            <li><a href="loanRequestHandler.php">Requests for loan</a></li>
            <li><a href="pendingLoans.php" class="load-pen-loan">Pending Loans</a></li>
            <li><a href="approvedLoans.php" class="load-app-loan">Approved Loans</a></li>
            <li><a href="rejectedLoans.php" class="load-rej-loan">Rejected Loans</a></li>
            <li><a href="activeLoan.php" class="load-act-loan">Active Loan</a></li>
            <li><a href="expiredLoans.php" class="load-exp-loan">Expired Loan</a></li>
            <li><a href="defaultedLoans.php" class="load-def-loan">Defaulted Loan</a></li>
            <li><a href="ForLoanCalculation.php" class="load-payment">Pay EMI</a></li>
        </ul>
    </div>

    <div class="total-content">
        <div id="login-btn" class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user"></i> <?php echo $_SESSION['member_name']; ?>
            </button>
            <div class="dropdown-menu profile-menu">
                <a class="dropdown-item" href="logout.php">Logout</a>
            </div>
        </div>

        <div id="content">
          <h2>This is member dashboard. To view particular information about your account,
          navigate to the links given in the sidebar.</h2>
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
  $('.load-member').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});
$(document).ready(function() {
  $('.load-account').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});
$(document).ready(function() {
  $('.load-pen-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});
$(document).ready(function() {
  $('.load-app-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});
$(document).ready(function() {
  $('.load-rej-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-act-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-exp-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-def-loan').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-payment').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
  $('.load-emi').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior
  
    var url = $(this).attr('href'); // Get the URL from the clicked link
  
    $('#content').load(url); // Load the content into the specified div
  });
});
</script>

<button id="myButton" ><a href="emiCalculator.php" class="load-emi">EMI Calculator</a></button>
</body>
</html>
