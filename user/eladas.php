<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");


$kat_all = mysqli_query($connect, "SELECT * FROM kategoria");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_user = $_SESSION['bejelentkezett'];
    $login_email = $_SESSION['bejelentkezett_email'];
    $result = mysqli_query($connect, "SELECT user_id FROM user WHERE (username = '$login_user' OR email = '$login_email')");
    $row = mysqli_fetch_assoc($result);
    $id = $row['user_id'];
    $termek_neve = $_POST['termek_neve'];
    $kategoria = $_POST['kategoria'];
    $mennyiseg = $_POST['mennyiseg'];
    $ar = $_POST['ar'];
    $leiras = $_POST['leiras'];
    $feltoltes_date = date("Y-m-d h:i:s");

    $file_name = $_FILES['feltoltes']['name'];
    $destination = '../uploads/' . $file_name;
    $extension = pathinfo($file_name, PATHINFO_EXTENSION);
    $kep = $_FILES['feltoltes']['tmp_name'];

    if (move_uploaded_file($kep, $destination)) {
        $file_type = pathinfo($file_name, PATHINFO_EXTENSION);
        $file_size = filesize($destination);
        $upload_date = date('Y-m-d h:i:s');
        $kep_leiras = "Kép a termékhez: $termek_neve";

        $image_query = "INSERT INTO `kepek` (file_name, file_type, file_size, upload_date, kep_leiras)
                        VALUES  ('$file_name', '$file_type', '$file_size', '$upload_date', '$kep_leiras')";

        if (mysqli_query($connect, $image_query)) {
            $_last_imageId = mysqli_insert_id($connect);

            $query = "INSERT INTO `termekek` (kategoria_id, hirdeto_id, nev, leiras, mennyiseg, ar, kep_id, feltoltes_date, jovahagyva, torolve)
                    VALUES ('$kategoria', '$id', '$termek_neve', '$leiras', '$mennyiseg', '$ar', '$_last_imageId', '$feltoltes_date', '0', '0')";

            if (mysqli_query($connect, $query)) {
                header("Location: ../user/hirdeteseim.php");
            } else {
                echo "Sikertelen hirdetés feladás!";
            }
        } else {
            echo "Hiba történt a kép feltöltése során!";
        }
    } else {
        echo "Hiba történt a kép feltöltése során!";
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        @import url(../style/navstyle.css);
        @import url(../style/eladas.css);
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../user/kezdolap.php">Szekszárdi Kosár<b>Közösség</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../user/eladas.php">Eladás</a></li>
                <li><a href="../user/hirdeteseim.php">Hirdetéseim</a></li>
                <li><a href="../user/vasarlas.php">Vásárlás</a></li>
                <li><a href="../user/kosark.php">Mi az a kosárközösség?</a></li>
                <li><a href="../user/uzenet.php">Üzenetek</a></li>
                <li><a href="../user/profile.php">Profilom</a></li>
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
                    <div class="col-xs-6"><input type="text" class="form-control" name="termek_neve" placeholder="Termék neve" value="" required="required"></div>
                    <div class="col-xs-6">
                        <select class="form-control" id="kategoria" name="kategoria" required>
                            <option value="" disabled selected hidden>Kategória</option>
                            <?php
                            while ($kat_row = mysqli_fetch_assoc($kat_all)) { ?>
                                <option value="<?php echo $kat_row['kategoria_id']; ?>"><?php echo $kat_row['nev']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                function setMennyisegPlaceholder() {
                                    var selectedCategory = $("#kategoria").val();
                                    var mennyisegInput = document.querySelector('input[name="mennyiseg"]');
                                    var arInput = document.querySelector('input[name="ar"]');
                                    var mennyisegPlaceholder = "Mennyiség";
                                    var arPlaceholder = "Ár";

                                    if (selectedCategory === "1" || selectedCategory === "2") {
                                        mennyisegPlaceholder += " (kg)";
                                        arPlaceholder += " (Ft/kg)";
                                    } else if (selectedCategory === "3" || selectedCategory === "4") {
                                        mennyisegPlaceholder += " (üveg)";
                                        arPlaceholder += " (Ft/üveg)";
                                    } else if (selectedCategory === "5" || selectedCategory === "6") {
                                        mennyisegPlaceholder += " (liter)";
                                        arPlaceholder += " (Ft/liter)";
                                    } else if (selectedCategory === "7") {
                                        mennyisegPlaceholder += " (db)";
                                        arPlaceholder += " (Ft)";
                                    }

                                    mennyisegInput.setAttribute("placeholder", mennyisegPlaceholder);
                                    arInput.setAttribute("placeholder", arPlaceholder);
                                }

                                $("#kategoria").change(setMennyisegPlaceholder);

                                setMennyisegPlaceholder();
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="mennyiseg" value="" placeholder="Mennyiség" required="required"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="ar" value="" placeholder="Ár" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="leiras" style="height: 150px;" placeholder="Leírás"></textarea>
            </div>
            <script>
                function preview() {
                    thumb.src = URL.createObjectURL(event.target.files[0]);
                }
            </script>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Kép feltöltése: </h4>
                    </div>
                    <input type="file" id="feltoltes" onchange="preview()" name="feltoltes" style="margin-top: 10px;" accept="image/*" value="" />
                    <img id="thumb" src="" width="150px"/>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg btn-block" type="submit" name="upload">Hirdetés feladása</button>
            </div>
        </form>
    </div>
</body>

</html>