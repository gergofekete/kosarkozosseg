<?php
include('connect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <style>
        @import url(style/register.css);
    </style>
</head>
<?php

if(isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password = md5($password);
    $taken = mysqli_query($connect, "SELECT username, email FROM user");
    if(isset($taken)) {
        while($row = mysqli_fetch_assoc($taken)) {
            if($row["email"] == $email) {
                $error = "Ezen az email címen már van fiók regisztálva!";
            }
            else if($row["username"] == $username) {
                $error = "Ez a felhasználónév már foglalt!";
            }
            else {
                $jo = 1;
            }
        }
        if($jo == 1) {
            $sql = "INSERT INTO user (username, lname, fname, email, password) VALUES ('$username', '$lname', '$fname', '$email', '$password')";
            header("Location: ../kosarkozosseg/login.php");
            if($connect->query($sql)=== TRUE) {
                echo "SIKER";
            }
            else {
                echo "SAJNOS NEM JOTT OSSZE";
            }
            $connect->close();
        }
    }
}
?>
<body>
<div class="signup-form">
    <form method="post">
        <h2>Regisztráció</h2>
        <p class="hint-text" style="color: #d00000"><?php if (isset($_POST['register'])){echo $error;} ?></p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="lname" placeholder="Vezetéknév" required="required"></div>
                <div class="col-xs-6"><input type="text" class="form-control" name="fname" placeholder="Keresztnév" required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <input type="username" class="form-control" name="username" placeholder="Felhasználónév" required="required">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="E-mail" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Jelszó" required="required">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="confirm_password" placeholder="Jelszó megerősítése" required="required">
        </div>
        <div class="form-group">
            <button type="submit" name="register" class="btn btn-success btn-lg btn-block">Regisztráció</button>
        </div>
    </form>
    <div class="text-center">Már van fiókod? <a href="login.php">BEJELENTKEZÉS</a></div>
</div>
</body>
</html>