<?php
include('../session.php');
access("ADMIN");
include('../connect.php');

$hirdetes_id = $_GET['hirdetesId'];
$hirdetes_adat = mysqli_query($connect, "SELECT * FROM termekek WHERE termek_id = '$hirdetes_id'");
$hirdetes_row = mysqli_fetch_assoc($hirdetes_adat);
$termek_id = $hirdetes_row['termek_id'];
$felado_id = $hirdetes_row['hirdeto_id'];
$kat_id = $hirdetes_row['kategoria_id'];

$kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id = '$hirdetes_row[kep_id]'");
$kep_row = mysqli_fetch_assoc($kepek);

$felado = mysqli_query($connect, "SELECT lname, fname FROM user WHERE user_id = '$felado_id'");
$felado_row = mysqli_fetch_assoc($felado);
$felado_name = $felado_row['lname'] . ' ' . $felado_row['fname'];

$kat = mysqli_query($connect, "SELECT nev FROM kategoria WHERE kategoria_id = '$kat_id'");
$kat_row = mysqli_fetch_assoc($kat);
$kat_name = $kat_row['nev'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirdetés kezelés</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <style>
        @import "../style/navstyle.css";
        @import url(../style/hirdeteskezeles.css);
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
        </div>
    </nav>
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div>
                        <img class="center" src="../uploads/<?php echo $kep_row['file_name']; ?>" width="auto" height="170" alt="" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h3>
                            Termék neve: &nbsp; <?php echo $hirdetes_row['nev']; ?>
                        </h3>
                        <br>
                        <h4>
                            Leírás: &nbsp; <?php echo $hirdetes_row['leiras']; ?>
                        </h4>
                        <br>
                        <h4>
                            Kategória: &nbsp; <?php echo $kat_name ?>
                        </h4>
                        <br>
                        <h4>
                            Mennyiség: &nbsp; <?php if ($hirdetes_row['kategoria_id'] == '1' || $hirdetes_row['kategoria_id'] == '2') {
                                                    echo $hirdetes_row['mennyiseg'] . ' kg';
                                                } else if ($hirdetes_row['kategoria_id'] == '3' || $hirdetes_row['kategoria_id'] == '4') {
                                                    echo $hirdetes_row['mennyiseg'] . ' üveg';
                                                } else if ($hirdetes_row['kategoria_id'] == '5' || $hirdetes_row['kategoria_id'] == '6') {
                                                    echo $hirdetes_row['mennyiseg'] . ' liter';
                                                } else {
                                                    echo $hirdetes_row['mennyiseg'] . ' db';
                                                } ?>
                        </h4>
                        <br>
                        <h4>
                            Ár: &nbsp; <?php if ($hirdetes_row['kategoria_id'] == '1' || $hirdetes_row['kategoria_id'] == '2') {
                                            echo $hirdetes_row['ar'] . ' Ft/kg';
                                        } else if ($hirdetes_row['kategoria_id'] == '3' || $hirdetes_row['kategoria_id'] == '4') {
                                            echo $hirdetes_row['ar'] . ' Ft/üveg';
                                        } else if ($hirdetes_row['kategoria_id'] == '5' || $hirdetes_row['kategoria_id'] == '6') {
                                            echo $hirdetes_row['ar'] . ' Ft/liter';
                                        } else {
                                            echo $hirdetes_row['ar'] . ' Ft/db';
                                        } ?>
                        </h4>
                        <br>
                        <h4>
                            Eladó: &nbsp; <?php echo $felado_name; ?>
                        </h4>
                        <br>
                    </div>
                </div>
            </div>
            <form method="post" style="text-align: center;">
                <button class="btn del-btn" style="display: block; margin: 0 auto 10px; background: #7a0f12; color: #fff;" id="del" name="del">Törlés</button>
                <?php if($hirdetes_row['jovahagyva'] == '0') {
                    echo '<button class="btn sub-btn" style="display: block; margin: 10px auto; background: #3f9b3f; color: #fff;" id="approval" name="approval">Jóváhagyás</button>';
                } ?>
                
            </form>
            <?php
            if (isset($_POST['del'])) {
                $torol = mysqli_query($connect, "UPDATE termekek SET torolve = '1' WHERE termek_id = '$termek_id'");
                header("location: adminkezdolap.php");
            }
            if(isset($_POST['approval'])) {
                $approval = mysqli_query($connect, "UPDATE termekek SET jovahagyva = '1' WHERE termek_id = '$termek_id'");
                header("location: adminkezdolap.php");
            } ?>

        </form>
    </div>
</body>

</html>