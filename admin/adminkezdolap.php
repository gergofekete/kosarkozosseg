<?php
include('../session.php');
access("ADMIN");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kezdőlap</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script src="https://kit.fontawesome.com/cce7f5b7f8.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.2/css/fontawesome.min.css">

    <style>
        @import "../style/navstyle.css";
        @import "../style/adminkezdolap.css";
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../user/eladas.php">Eladás</a></li>
                <li><a href="../user/hirdeteseim.php">Hirdetéseim</a></li>
                <li><a href="../user/vasarlas.php">Vásárlás</a></li>
                <li><a href="../user/kosark.php">Mi az a kosárközösség?</a></li>
                <li><a href="../user/uzenet.php">Üzenetek</a></li>
                <li><a href="../user/profile.php">Profilom</a></li>
                <!--<li><a href="rolunk.php">Rólunk</a></li>-->
            </ul>
            <ul class="nav navbar-form form-inline navbar-right ml-auto">
                <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
            </ul>
        </div>
    </nav>

    <div class="signup-form">
        <form method="post" enctype="multipart/form-data">
            <h2>Új hirdetés feladása</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="termek_neve" placeholder="Termék neve" value=""></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="hirdeto_nev" placeholder="Hirdető neve" value=""></div>
                    <div class="col-xs-6">
                        <select class="form-control" id="kategoria" name="kategoria">
                            <option value="" disabled selected hidden>Kategória</option>
                            <option value="1">Zöldség</option>
                            <option value="2">Gyümölcs</option>
                            <option value="3">Lekvárok</option>
                            <option value="4">Borok</option>
                            <option value="5">Gyümölcs levek</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="mennyiseg" value="" placeholder="Mennyiség"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="ar" value="" placeholder="Ár"></div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg btn-block" type="submit" name="upload">Hirdetés feladása</button>
            </div>
        </form>
    </div>
</body>

</html>