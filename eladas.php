
<?php
include("session.php");
access("FELHASZNALO");
include("connect.php");

// if(isset($_POST['kepupload'])) {
//     $file_name = $_FILES['feltoltes']['name'];
//     $destination = 'uploads/' . $file_name;
//     $extension = pathinfo($file_name, PATHINFO_EXTENSION);
//     $kep = $_FILES['feltoltes']['tmp_name'];
//     if(move_uploaded_file($kep, $destination)) {

//     } else {
//         echo "Hiba a kép feltöltése során!";
//     }
// }


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_user = $_SESSION['bejelentkezett'];
    $result = mysqli_query($connect, "SELECT user_id FROM user WHERE username = '$login_user'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['user_id'];
    $termek_neve = $_POST['termek_neve'];
    $kategoria = $_POST['kategoria'];
    $mennyiseg = $_POST['mennyiseg'];
    $ar = $_POST['ar'];
    $leiras = $_POST['leiras'];

    if(isset($_POST['upload'])) {
        $file_name = $_FILES['feltoltes']['name'];
        $destination = 'uploads/' . $file_name;
        $extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $kep = $_FILES['feltoltes']['tmp_name'];
        if(move_uploaded_file($kep, $destination)) {

        } else {
            echo "Hiba a kép feltöltése során!";
        }
        $query = "INSERT INTO `termekek` (kategoria_id, hirdeto_id, nev, leiras, mennyiseg, ar, kep, jovahagyva)
        VALUES ('$kategoria', '$id', '$termek_neve', '$leiras', '$mennyiseg', '$ar', '$kep', '0')";
        if(mysqli_query($connect, $query)) {
            echo "siker";
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
            <li><a href="hirdeteseim.php">Hirdetéseim</a></li>
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
    <form method="post" enctype="multipart/form-data">
        <h2>Új hirdetés feladása</h2>
        <p class="hint-text" style="color: #d00000"><?php if (isset($_POST['register'])){echo $error;} ?></p>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="termek_neve" placeholder="Termék neve" value="<?php echo isset($_POST['termek_neve']) ? $_POST['termek_neve'] : ''; ?>" required="required"></div>
                <div class="col-xs-6">
                    <select class="form-control" id="kategoria" name="kategoria" required>
                        <option value="" disabled selected hidden>Kategória</option>
                        <option value="1" <?php echo (isset($_POST['kategoria']) && $_POST['kategoria'] == 1) ? 'selected' : ''; ?>>Zöldség</option>
                        <option value="2" <?php echo (isset($_POST['kategoria']) && $_POST['kategoria'] == 2) ? 'selected' : ''; ?>>Gyümölcs</option>
                        <option value="3" <?php echo (isset($_POST['kategoria']) && $_POST['kategoria'] == 3) ? 'selected' : ''; ?>>Lekvárok</option>
                        <option value="4" <?php echo (isset($_POST['kategoria']) && $_POST['kategoria'] == 4) ? 'selected' : ''; ?>>Borok</option>
                        <option value="5" <?php echo (isset($_POST['kategoria']) && $_POST['kategoria'] == 5) ? 'selected' : ''; ?>>Gyümölcs levek</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><input type="text" class="form-control" name="mennyiseg" value="<?php echo isset($_POST['mennyiseg']) ? $_POST['mennyiseg'] : ''; ?>" placeholder="Mennyiség" required="required"></div>
                <div class="col-xs-6"><input type="text" class="form-control" name="ar" value="<?php echo isset($_POST['ar']) ? $_POST['ar'] : ''; ?>"  placeholder="Ár (Ft)" required="required"></div>
            </div>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="leiras" style="height: 150px;" placeholder="Leírás"><?php echo isset($_POST['leiras']) ? $_POST['leiras'] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-xs-6"><h4>Kép feltöltése: </h4></div>
                <input type="file" id="feltoltes" name="feltoltes" style="margin-top: 10px;" accept="image/*" value="<?php echo isset($file_name) ? `$file_name` : ''; ?>"/>
                <?php
                if(isset($file_name)) {
                    echo '<img src="uploads/'.$file_name.'" style="width: 50px; height: 50px;" alt="Feltöltött kép">';
                }
                ?>
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-success btn-lg btn-block" type="submit" name="upload">Hirdetés feladása</button>
        </div>
    </form>
</div>
</body>
</html>
