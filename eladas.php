<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eladás</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        @import url(style/navstyle.css);
        @import url(style/eladas.css);

        select:invalid {
            color: gray;
        }
    </style>
</head> 
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
    <div class="navbar-header">
        <a class="navbar-brand" href="kezdolap.php">Szekszárdi Kosár<b>Közösség</b></a>         
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="navbar-toggler-icon"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="eladas.php">Eladás</a></li>
            <li><a href="vasarlas.php">Vásárlás</a></li>            
            <li><a href="kosark.php">Mi az a kosárközösség?</a></li>
            <li><a href="uzenet.php">Üzenetek</a></li>
            <li><a href="profile.php">Profilom</a></li>
            <!--<li><a href="rolunk.php">Rólunk</a></li>-->
        </ul>
        <ul class="nav navbar-form form-inline navbar-right ml-auto">
            <li style="float: right;text-align:right; color: black;"><a href="logout.php">Kijelentkezés</a></li>
        </ul>
    </div>
</nav>
<div class="signup-form">
    <form method="post">
        <h2>Új hirdetés feladása</h2>
        <p class="hint-text" style="color: #d00000"><?php if (isset($_POST['register'])){echo $error;} ?></p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="termek_neve" placeholder="Termék neve" required="required"></div>
                <div class="col-xs-6">
                    <select class="form-control" id="kategoria" required>
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
                <div class="col-xs-6"><input type="text" class="form-control" name="mennyiseg" placeholder="Mennyiség" required="required"></div>
                <div class="col-xs-6"><input type="text" class="form-control" name="ar" placeholder="Ár (Ft)" required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="leiras" style="height: 150px;" placeholder="Leírás"></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><h4>Kép feltöltése: </h4></div>
                <div class="col-xs-6"><input type="file" style="margin-top: 10px;" name="fetoltes" value="" accept="image/png, image/jpg, image/jpeg, image/img, image/raw"/></div>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg btn-block" type="submit" name="upload">Hirdetés feladása</button>
        </div>
    </form>
</div>
</body>
</html>                            
