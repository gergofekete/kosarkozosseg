<?php
//include('connect.php');
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
<?php
/*if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $pw = $_POST['password'];
    $pw = md5($pw);
    $sql = "SELECT * FROM users WHERE (username = '$username' AND pw = '$pw') OR (email = '$username' AND pw = '$pw')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if($count == 1) {
        echo "Sikeres bejelentkezés";
        $_SESSION['login_user'] = $username;
        //$_SESSION['access'] = '';
        header("location: ./kezdolap.php");
    }
    else {
        $error = "Hibás felhasználónév vagy jelszó!";
    }
}*/
?>
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
            <a href="#" class="pull-left">Elfelejtett jelszó</a>
        </div>
        <div class="clearfix">
            <a href="signup.php" class="pull-left">Még nincs fiókom, regisztrálok!</a>
        </div>
    </form>
</div>
</body>
</html>