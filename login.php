<?php
include('connect.php');

session_start();
session_destroy();
session_start();

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $password = md5($password);

    $felhasznalo = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$username' AND password = '$password' AND admine = '0') OR (email = '$username' AND password = '$password' AND admine = '0')");
    $admin = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$username' AND password = '$password' AND admine = '1') OR (email = '$username' AND password = '$password' AND admine = '1')");

    $felh_row = mysqli_fetch_assoc($felhasznalo);
    $admin_row = mysqli_fetch_assoc($admin);

    $felh_email = $felh_row['email'];
    $admin_email = $admin_row['email'];

    $fcount = mysqli_num_rows($felhasznalo);
    $acount = mysqli_num_rows($admin);

    if($acount == 1) {
        $_SESSION['bejelentkezett'] = $username;
        $_SESSION['bejelentkezett_email'] = $admin_email;
        $_SESSION['access'] = 1;
        $error = "";
        header("location: ./admin/adminkezdolap.php");
    }
    else if($fcount == 1) {
        $_SESSION['bejelentkezett'] = $username;
        $_SESSION['bejelentkezett_email'] = $felh_email;
        $_SESSION['access'] = 0;
        $error = "";
        header("location: ./user/kezdolap.php");
    }
    else {
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
    <style>
       @import url(style/login.css);
    </style>
</head>
<body>
<div class="login-form">
    <form method="post">
        <h2 class="text-center">Bejelentkezés</h2>
        <p class="text-center" style="color: #d00000"><?php if (isset($_POST['login'])){echo $error;} ?></p>
        <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="E-mail vagy felhasználónév" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Jelszó" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">Bejelentkezés</button>
        </div>
        <div class="clearfix">
            <p class="pull-left" style="color: #000000;">Még nincs fiókom, &nbsp;</p><a href="register.php"> REGISZTRÁLOK!</a>
        </div>
    </form>
</div>
</body>
</html>