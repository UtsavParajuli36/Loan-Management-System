<?php
session_start();
if (session_destroy()) {
    header("location:../homepage.php");
    // header("Location: ../HTML/homepage.html");
}
?>