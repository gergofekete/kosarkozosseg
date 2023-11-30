<?php
include('connect.php');

if (isset($_POST['register'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $taken = mysqli_query($connect, "SELECT username, email FROM user");
    $jo = 0;
    if (isset($taken)) {
        while ($row = mysqli_fetch_assoc($taken)) {
            if ($row["username"] === $username) {
                $error = "Ez a felhasználónév már foglalt!";
                break;
            } else if ($row["email"] === $email) {
                $error = "Ezen az email címen már van fiók regisztrálva!";
                break;
            }
        }

        if (!isset($error)) {
            if ($password == $confirm_password) {
                $password = md5($password);
                $jo = 1;
            } else {
                $error = "A megadott jelszavak nem egyeznek!";
            }
        }

        if ($jo == 1) {
            $sql = "INSERT INTO user (username, lname, fname, email, password) VALUES ('$username', '$lname', '$fname', '$email', '$password')";
            header("Location: ../kosarkozosseg/login.php");
            if ($connect->query($sql) === TRUE) {
            } else {
                $error = "Hiba történt a regisztráció során.";
            }
            $connect->close();
        }
    }
}
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

    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        @import url(./style/register.css);
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
            <h2>Regisztráció</h2>
            <p class="hint-text" style="color: #d00000"><?php if (isset($_POST['register'])) {
                                                            echo $error;
                                                        } ?></p>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="lname" placeholder="Vezetéknév" value="<?php if (isset($_POST['lname'])) {
                                                                                                                                    echo $_POST['lname'];
                                                                                                                                } ?>" required="required"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="fname" placeholder="Keresztnév" value="<?php if (isset($_POST['fname'])) {
                                                                                                                                    echo $_POST['fname'];
                                                                                                                                } ?>" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <input type="username" class="form-control" name="username" placeholder="Felhasználónév" value="<?php if (isset($_POST['username'])) {
                                                                                                                    echo $_POST['username'];
                                                                                                                } ?>" required="required">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="E-mail" value="<?php if (isset($_POST['email'])) {
                                                                                                        echo $_POST['email'];
                                                                                                    } ?>" required="required">
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