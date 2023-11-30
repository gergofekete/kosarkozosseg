<?php
include('connect.php');

session_start();
session_destroy();
session_start();

$felh_email = "";
$admin_email = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);

    $felhasznalo = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$username' AND password = '$password' AND admine = '0') OR (email = '$username' AND password = '$password' AND admine = '0')");
    $admin = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$username' AND password = '$password' AND admine = '1') OR (email = '$username' AND password = '$password' AND admine = '1')");

    $felh_row = mysqli_fetch_assoc($felhasznalo);
    $admin_row = mysqli_fetch_assoc($admin);

    if($felh_row !== null) {
        $felh_email = $felh_row['email'];
    }

    if($admin_row !== null) {
        $admin_email = $admin_row['email'];
    }

    $fcount = mysqli_num_rows($felhasznalo);
    $acount = mysqli_num_rows($admin);

    if ($acount == 1) {
        $_SESSION['bejelentkezett'] = $username;
        $_SESSION['bejelentkezett_email'] = $admin_email;
        $_SESSION['access'] = 1;
        $error = "";
        header("location: ./admin/adminkezdolap.php");
    } else if ($fcount == 1) {
        $_SESSION['bejelentkezett'] = $username;
        $_SESSION['bejelentkezett_email'] = $felh_email;
        $_SESSION['access'] = 0;
        $error = "";
        header("location: ./user/kezdolap.php");
    } else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        @import url(./style/login.css);
        @import url(./style/navstyle.css);
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="">Szekszárdi Kosár<b>Közösség</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </nav>
    <div class="signup-form">
        <form method="post">
            <h2>Bejelentkezés</h2>
            <p class="hint-text" style="color: #d00000"><?php if (isset($_POST['login'])) {
                                                            echo $error;
                                                        } ?></p>
            <div class="form-group">
                <input type="username" class="form-control" name="username" placeholder="Felhasználónév vagy e-mail cím" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Jelszó" required="required">
            </div>
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-success btn-lg btn-block">Bejelentketés</button>
            </div>
        </form>
        <div class="text-center">Még nincs fiókod? <a href="register.php">REGISZTRÁCIÓ</a></div>
    </div>
</body>

</html>