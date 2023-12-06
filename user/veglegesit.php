<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");

$termek_id = $_POST['termekId'];

$selectedQuantity = 0;

$termek_adat = mysqli_query($connect, "SELECT * FROM termekek WHERE termek_id = '$termek_id'");
$termek_row = mysqli_fetch_assoc($termek_adat);

$kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id = '$termek_row[kep_id]'");
$kep_row = mysqli_fetch_assoc($kepek);

$selectedQuantity = 0;

$termek_adat = mysqli_query($connect, "SELECT * FROM termekek WHERE termek_id = $termek_id");
$termek_row = mysqli_fetch_assoc($termek_adat);

$kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id = '$termek_row[kep_id]'");
$kep_row = mysqli_fetch_assoc($kepek);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['vasarlas'])) {
    $db = $_POST['selectedQuantity'];
    $login_user = $_SESSION['bejelentkezett'];
    $login_email = $_SESSION['bejelentkezett_email'];
    $user = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$login_user' OR email = '$login_email')");
    $user_row = mysqli_fetch_assoc($user);
    $user_id = $user_row['user_id'];
    $username = $user_row['username'];
    $cimzett_id = $termek_row['hirdeto_id'];
    $termek_id = $termek_row['termek_id'];
    $termek_nev = $termek_row['nev'];
    $fizetendo = $_POST['fizetendo'];
    $vasarlas_date = date("Y-m-d H:i:s");

    $maradek = $termek_row['mennyiseg'] - $db;
    if ($maradek >= 0) {
        $sql = mysqli_query($connect, "UPDATE termekek SET mennyiseg = '$maradek' WHERE termek_id = '$termek_id'");
        $uzenet = mysqli_query($connect, "INSERT INTO uzenetek (felado_id, cimzett_id, termek_id, targy, szoveg, kuldes_date)
                            VALUES ('$user_id', '$cimzett_id', '$termek_id', '$termek_nev', 'Tájékoztatjuk, hogy rendelése érkezett $username-tól/től.
                            Rendelés tartalma: $termek_nev, rendelt mennyiség: $db
                            Fizetendő összeg: $fizetendo Ft', '$vasarlas_date')");
        header("Location: ../user/vasarlas.php");
    } else {
        echo '<script>alert("Nincs elegendő mennyiség!")</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vásárlás</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <style>
        @import url(../style/navstyle.css);
        @import url(../style/veglegesit.css);
    </style>
</head>

<body>
    <form method="post">
        <nav class="navbar navbar-default navbar-expand-lg navbar-light">
            <div class="navbar-header">
                <a class="navbar-brand" href="../user/vasarlas.php">Szekszárdi Kosár<b>Közösség</b></a>
                <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
                    <span class="navbar-toggler-icon"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="nav navbar-form form-inline navbar-right ml-auto">
                <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
            </ul>
            </div>
        </nav>

        <div class="container">
            <div class="card">
                <div class="container-fliud">
                    <div class="wrapper row">
                        <div class="preview col-md-6">

                            <div class="preview-pic tab-content">
                                <div class="tab-pane active" id="pic-1"><img src="../uploads/<?php echo $kep_row['file_name']; ?>" /></div>
                            </div>
                        </div>
                        <div class="details col-md-6">
                            <h3 class="product-title"><?php echo $termek_row['nev']; ?></h3>
                            <p class="product-description"><?php echo $termek_row['leiras']; ?></p>
                            <p class="product-description">Feltöltés dátuma: &nbsp <?php echo $termek_row['feltoltes_date']; ?></p>
                            <h5 class="price">Elérhető mennyiség: <?php if ($termek_row['kategoria_id'] == '1' || $termek_row['kategoria_id'] == '2') {
                                                                        echo $termek_row['mennyiseg'] . ' kg';
                                                                    } else if ($termek_row['kategoria_id'] == '3' || $termek_row['kategoria_id'] == '4') {
                                                                        echo $termek_row['mennyiseg'] . ' üveg';
                                                                    } else if ($termek_row['kategoria_id'] == '5' || $termek_row['kategoria_id'] == '6') {
                                                                        echo $termek_row['mennyiseg'] . ' liter';
                                                                    } else {
                                                                        echo $termek_row['mennyiseg'];
                                                                    } ?></h4>
                                <h5 class="price">Ár: <?php if ($termek_row['kategoria_id'] == '1' || $termek_row['kategoria_id'] == '2') {
                                                            echo $termek_row['ar'] . ' Ft/kg';
                                                        } else if ($termek_row['kategoria_id'] == '3' || $termek_row['kategoria_id'] == '4') {
                                                            echo $termek_row['ar'] . ' Ft/üveg';
                                                        } else if ($termek_row['kategoria_id'] == '5' || $termek_row['kategoria_id'] == '6') {
                                                            echo $termek_row['ar'] . ' Ft/liter';
                                                        } else {
                                                            echo $termek_row['ar'];
                                                        } ?></h4>
                                    <br>
                                    <label>
                                        <h5 class="price">Megvásárolni kívánt mennyiség: </h5>
                                    </label>
                                    <select style="width: 130px;" name="selectedQuantity" require>
                                        <option value="" disabled selected hidden>Mennyiség</option>
                                        <?php for ($i = 1; $i <= $termek_row['mennyiseg']; $i++) {
                                            if ($termek_row['kategoria_id'] == '1' || $termek_row['kategoria_id'] == '2') {
                                                echo '<option value="' . $i . '">' . $i . ' kg</option>';
                                            } else if ($termek_row['kategoria_id'] == '3' || $termek_row['kategoria_id'] == '4') {
                                                echo '<option value="' . $i . '">' . $i . ' üveg</option>';
                                            } else if ($termek_row['kategoria_id'] == '5' || $termek_row['kategoria_id'] == '6') {
                                                echo '<option value="' . $i . '">' . $i . ' liter</option>';
                                            } else {
                                                echo '<option value="' . $i . '">' . $i . ' db</option>';
                                            }
                                        } ?>
                                    </select>
                                    <script>
                                        function calculateTotal() {
                                            var selectedQuantity = parseFloat(document.querySelector('select').value);
                                            var pricePerUnit = parseFloat(<?php echo $termek_row['ar']; ?>);
                                            var totalAmount = selectedQuantity * pricePerUnit;
                                            document.querySelector('[name="fizetendo"]').value = totalAmount;
                                        }

                                        document.querySelector('select').addEventListener('input', calculateTotal);
                                    </script>

                                    <h5 class="price"> Fizetendő összeg: &nbsp; <input type="text" name="fizetendo" readonly /> Ft</h5>
                                    <form method="post">
                                        <div class="action">
                                            <input type="hidden" name="termekId" value="<?php echo $termek_id; ?>">
                                            <input type="submit" class="add-to-cart btn btn-default" name="vasarlas" id="vasarlas" value="Vásárlás">
                                            <a href="../user/vasarlas.php"><button type="button" class="back btn btn-default">Mégse</button></a>
                                        </div>
                                    </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</body>

</html>