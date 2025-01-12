<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style type="text/css">
        body {
            background-image: url(../IMAGES/background.png);
        }
        .form{
            display: flex;
            width: 100%;
            justify-content: center;
        }
        fieldset{
            border-radius:10px;
            border-color:black;
        }
        /* legend{
            justify-content: center;
            align-items: center;
            justify-self:center;
        } */
    </style>
</head>

<body>
    <?php include('header.php'); ?>
    <div class='form'>
        <fieldset>
            <legend>Become A Member of SMSC</legend>
            <form name="validation" method="post" action="http://localhost/LoanMgmtSystem/PHP/BecomeMember.php">
                <table>
                    <tr>
                        <td>Name</td>
                        <td id="no"><input type="text" name="name"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td id="no"><input type="text" name="address"></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td id="no"><input type="number" name="phone"></td>
                    </tr>
                    <tr>
                        <td>Account Number</td>
                        <td id="no"><input type="text" name="accNo"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td id="no"><input type="text" name="email"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td id="no"><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td>Re-enter the password</td>
                        <td id="no"><input type="password" name="rpassword"></td>
                    </tr>
            </form>
            <tr>
                <td><input type="submit" name="submit" value="Submit" onclick="FormValidation()"></td>
            </tr>
            </table>
        </fieldset>
    </div>
    <script type="text/javascript" src="..\JS\Validation.js"></script>
</body>

</html>