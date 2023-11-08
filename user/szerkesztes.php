<?php
include('../session.php');
access("FELHASZNALO");
include('../connect.php');

$termek_id = $_GET['termekId'];

$termek_adat = mysqli_query($connect, "SELECT * FROM termekek WHERE termek_id = $termek_id");
$termek_row = mysqli_fetch_assoc($termek_adat);

$kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id = '$termek_row[kep_id]'");
$kep_row = mysqli_fetch_assoc($kepek);

if (isset($_POST['upload'])) {
    $login_user = $_SESSION['bejelentkezett'];
    $result = mysqli_query($connect, "SELECT user_id FROM user WHERE username = '$login_user'");
    $row = mysqli_fetch_assoc($result);
    $id = $row['user_id'];
    $termek_neve = $_POST['termek_neve'];
    $kategoria = $_POST['kategoria'];
    $mennyiseg = $_POST['mennyiseg'];
    $ar = $_POST['ar'];
    $leiras = $_POST['leiras'];

    $modosit = mysqli_query($connect, "UPDATE termekek SET nev = '$termek_neve', kategoria_id = '$kategoria', mennyiseg = '$mennyiseg', ar = '$ar', leiras = '$leiras' WHERE termek_id = '$termek_id'");
    header("Location: hirdeteseim.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirdetés szerkesztése</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
            <a class="navbar-brand" href="../user/hirdeteseim.php">Szekszárdi Kosár<b>Közösség</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </nav>

    <div class="signup-form">
        <form method="post" enctype="multipart/form-data">
            <h2>Hirdetés módosítása</h2>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="termek_neve" placeholder="Termék neve" value="<?php echo $termek_row['nev']; ?>" required="required"></div>
                    <div class="col-xs-6">
                        <select class="form-control" id="kategoria" name="kategoria" required>
                            <option value="" disabled selected hidden>Kategória</option>
                            <option value="1" <?php echo (isset($termek_row['kategoria_id']) && $termek_row['kategoria_id'] == 1) ? 'selected' : ''; ?>>Zöldség</option>
                            <option value="2" <?php echo (isset($termek_row['kategoria_id']) && $termek_row['kategoria_id'] == 2) ? 'selected' : ''; ?>>Gyümölcs</option>
                            <option value="3" <?php echo (isset($termek_row['kategoria_id']) && $termek_row['kategoria_id'] == 3) ? 'selected' : ''; ?>>Lekvárok</option>
                            <option value="4" <?php echo (isset($termek_row['kategoria_id']) && $termek_row['kategoria_id'] == 4) ? 'selected' : ''; ?>>Borok</option>
                            <option value="5" <?php echo (isset($termek_row['kategoria_id']) && $termek_row['kategoria_id'] == 5) ? 'selected' : ''; ?>>Gyümölcs levek</option>
                        </select>
                        <script>
                            document.addEventListener("DOMContentLoaded", function() {
                                // Funkció a placeholder beállítására a kiválasztott kategória nevére
                                function setMennyisegPlaceholder() {
                                    var selectedCategory = $("#kategoria").val();
                                    var mennyisegInput = document.querySelector('input[name="mennyiseg"]');
                                    var arInput = document.querySelector('input[name="ar"]');
                                    var mennyisegPlaceholder = "Mennyiség";
                                    var arPlaceholder = "Ár";

                                    // A kategóriától függően módosítjuk a placeholder szöveget
                                    if (selectedCategory === "1" || selectedCategory === "2") {
                                        mennyisegPlaceholder += " (kg)";
                                        arPlaceholder += " (Ft/kg)";
                                    } else if (selectedCategory === "3" || selectedCategory === "4") {
                                        mennyisegPlaceholder += " (üveg)";
                                        arPlaceholder += " (Ft/üveg)";
                                    } else if (selectedCategory === "5") {
                                        mennyisegPlaceholder += " (liter)";
                                        arPlaceholder += " (Ft/liter)";
                                    }

                                    mennyisegInput.setAttribute("placeholder", mennyisegPlaceholder);
                                    arInput.setAttribute("placeholder", arPlaceholder);
                                }

                                // Az eseménykezelő a kategória kiválasztás változására
                                $("#kategoria").change(setMennyisegPlaceholder);

                                // Alapértelmezett placeholder beállítása az oldal betöltésekor
                                setMennyisegPlaceholder();
                            });
                        </script>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6"><input type="text" class="form-control" name="mennyiseg" value="<?php echo $termek_row['mennyiseg']; ?>" placeholder="Mennyiség" required="required"></div>
                    <div class="col-xs-6"><input type="text" class="form-control" name="ar" value="<?php echo $termek_row['ar']; ?>" placeholder="Ár" required="required"></div>
                </div>
            </div>
            <div class="form-group">
                <textarea class="form-control" name="leiras" style="height: 150px;" placeholder="Leírás"><?php echo $termek_row['leiras']; ?></textarea>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-xs-6">
                        <h4>Feltöltött kép: </h4>
                        <?php
                        if (isset($kep_row['file_name'])) {
                            echo '<img src="../uploads/' . $kep_row['file_name'] . '" style="width: auto; height: 150px;">';
                        }
                        ?>
                    </div>
                    <script>
                        function preview() {
                            thumb.src = URL.createObjectURL(event.target.files[0]);
                        }
                    </script>
                    <h4>Új kép feltölése: </h4>
                    <input type="file" id="feltoltes" name="feltoltes" style="margin-top: 10px;" accept="image/*" value="" onchange="preview()" />
                    <img id="thumb" src="" width="150px" height="auto" />
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-success btn-lg btn-block" type="submit" name="upload">Hirdetés módosítása</button>
            </div>
        </form>
    </div>

</body>

</html>