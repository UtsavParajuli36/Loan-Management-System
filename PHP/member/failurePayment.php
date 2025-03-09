<?php
    echo '<script>
    alert("Payment Failure due to one of following reasons: pending, full_refund, partial_refund, ambiguous, not_found, cancelled, Service_Unavailable");
    setTimeout(function() {
      window.location.href = "memberDashboard.php";
    }, 10); // Adjust delay in milliseconds
  </script>';
?>