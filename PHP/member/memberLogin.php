<!-- <!DOCTYPE html> -->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Login</title>
    <link rel="stylesheet" href="../../CSS/login.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css">
</head>
<body>

<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <?php
                    if (isset($error_message)) {
                        echo "<div class='alert alert-danger' id='error_bar'>";
                        echo "<strong > Error! </strong > $error_message";
                        echo "</div>";
                    }
                    ?>
                    <h1>Sunaulo Mahankal Saving and Credit Co-Operatives Limited</h1>
                    <form id="login_form" action="memberLoginHandler.php" method="post">
                        <div class="form-group">
                            <label for="key" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <label for="key" class="sr-only">Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                   placeholder="Password">
                        </div>
                        <input type="submit" id="btn-login" class="btn btn-lg btn-block" value="Log in">
                    </form>
                </div>
            </div>
            <!-- /.col-xs-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</section>

</body>
</html>