<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header Page</title>
    <link rel="stylesheet" href="../CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="../JS/dropdown.js"></script>
</head>

<body>

    <div class="navbar">
        <div class="logo">
            <img src="../IMAGES/logo.png" alt="Company Logo">
            <span class="company-name">SMSC</span>
        </div>
        <div class="menu">
            <a href="#content" class="active" ><i class="fa fa-home"></i> Home</a>
            <a href="#about-us"><i class="fa fa-info-circle"></i> About</a>
            <a href="#reviews"><i class="fa fa-star"></i> Reviews</a>
        </div>
        <div class="buttons">
            <a href="register.php" class="button">Register</a>
            <div class="dropdown">
                <button onclick="toggleDropdown()" class="dropbtn">Login</button>
                <div id="myDropdown" class="dropdown-content">
                    <a href="admin/adminLogin.php">Admin Login</a>
                    <a href="member/memberLogin.php">Member Login</a>
                </div>
            </div>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="toggleMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <script src="../JS/script.js"></script>

</body>

</html>