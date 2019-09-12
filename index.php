<?php
if(isset($_SESSION['login']) && $_SESSION['login'] === 1) {
    header('Location: http://10.208.133.79/rocomplaints/complaints.php');
} else {
    session_start();
    session_destroy();
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ONGC|MR|Complaints</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
    </head>
    <body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="banner">
                    Online Complaints Portal<br><small>Regional Office, Mumbai</small>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="logo">
                    <img src="images/logo.png" class="img-rounded" alt="ONGC Logo" width="112"">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <div class="login-form">
                    <form action="" method="post">
                        <h2 class="text-center">Sign In</h2>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input id="cpf" name="cpf" type="number" class="form-control" placeholder="CPF Number" required="required">
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input id="pwd" name="password" type="password" class="form-control" placeholder="Domain Password" required="required">
                        </div>
                        <div class="form-group">
                            <button id="login" type="button" class="btn btn-primary btn-block" onclick="adlogin()">Log in</button>
                        </div>
                        <div id="login_result">

                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</body>
</html>