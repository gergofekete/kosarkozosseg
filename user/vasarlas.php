<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");

$kat_all = mysqli_query($connect, "SELECT * FROM kategoria");

$login_user = $_SESSION['bejelentkezett'];
$login = mysqli_query($connect, "SELECT user_id FROM user WHERE (username = '$login_user' OR email = '$login_user')");
$login_row = mysqli_fetch_assoc($login);
$login_id = $login_row['user_id'];
$termekek = mysqli_query($connect, "SELECT * FROM termekek WHERE hirdeto_id != '$login_id' AND jovahagyva = '1' AND torolve = '0' ORDER BY termek_id DESC");
$kepek = mysqli_query($connect, "SELECT * FROM kepek INNER JOIN termekek WHERE kepek.kep_id = termekek.kep_id");
$kep_row = mysqli_fetch_assoc($kepek);


if (isset($_POST['keres'])) {
    $termek_neve = $_POST['termek_neve'];
    $termekek = mysqli_query($connect, "SELECT * FROM termekek
                                            WHERE hirdeto_id != '$login_id'
                                            AND jovahagyva = '1'
                                            AND torolve = '0'
                                            AND (nev LIKE '%$termek_neve%')
                                            ORDER BY termek_id DESC");

    $kepek = mysqli_query($connect, "SELECT * FROM kepek INNER JOIN termekek WHERE kepek.kep_id = termekek.kep_id");
    $kep_row = mysqli_fetch_assoc($kepek);

    if (isset($_POST['kategoria']) && $_POST['kategoria'] != '0') {
        $termek_kategoria = $_POST['kategoria'];
        $termekek = mysqli_query($connect, "SELECT * FROM termekek
                                            WHERE hirdeto_id != '$login_id'
                                            AND jovahagyva = '1'
                                            AND torolve = '0'
                                            AND (nev LIKE '%$termek_neve%')
                                            AND (kategoria_id = '$termek_kategoria')
                                            ORDER BY termek_id DESC");
        $kepek = mysqli_query($connect, "SELECT * FROM kepek INNER JOIN termekek WHERE kepek.kep_id = termekek.kep_id");
        $kep_row = mysqli_fetch_assoc($kepek);
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
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        @import url(../style/navstyle.css);
        @import url(../style/hirdeteseim.css);
    </style>
</head>

<body>
    <form method="post">
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
                    <li><a href="../user/eladas.php">Eladás</a></li>
                    <li><a href="../user/hirdeteseim.php">Hirdetéseim</a></li>
                    <li class="active"><a href="../user/vasarlas.php">Vásárlás</a></li>
                    <li><a href="../user/kosark.php">Mi az a kosárközösség?</a></li>
                    <li><a href="../user/uzenet.php">Üzenetek</a></li>
                    <li><a href="../user/profile.php">Profilom</a></li>
                </ul>
                <ul class="nav navbar-form form-inline navbar-right ml-auto">
                    <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
        </div>
        <section class="search-sec">
            <div class="container">
                <form method="post" novalidate="novalidate">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <input type="text" name="termek_neve" class="form-control search-slt" placeholder="Termék neve" value="<?php if(isset($_POST['termek_neve'])) {echo $_POST['termek_neve'];} ?>">
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <select class="form-control search-slt" name="kategoria" id="kategoria">
                                        < <option value="0">Mind</option>
                                            <?php
                                            while ($kat_row = mysqli_fetch_assoc($kat_all)) {
                                                if ($kat_row['kategoria_id'] == $_POST['kategoria']) { ?>
                                                    <option value="<?php echo $kat_row['kategoria_id']; ?>" selected><?php echo $kat_row['nev']; ?></option>
                                                <?php
                                                } else { ?>
                                                    <option value="<?php echo $kat_row['kategoria_id']; ?>"><?php echo $kat_row['nev']; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 p-0">
                                    <button type="submit" name="keres" class="btn wrn-btn" style="background-color: #3f9b3f; color: white">Keresés</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($termekek)) {
                        if(mysqli_num_rows($termekek) == '0') {
                            echo "&nbsp &nbsp &nbsp Nincs a megadott keresési feltételeknek megfelelő termék";
                        }
                        while ($row = mysqli_fetch_assoc($termekek)) {
                            $hirdeto_id = $row['hirdeto_id'];
                            $hirdeto = mysqli_query($connect, "SELECT lname, fname FROM user WHERE user_id = '$hirdeto_id'");
                            $hirdeto_row = mysqli_fetch_assoc($hirdeto);
                            $hirdeto_name = $hirdeto_row['lname'] . ' ' . $hirdeto_row['fname'];
                            $kepid = $row['kep_id'];
                            $kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id =  '$kepid'");
                            $kep_row = mysqli_fetch_assoc($kepek); ?>
                            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                <div class="panel panel-pricing">
                                    <div class="panel-heading">
                                        <i class="fa"><img src="../uploads/<?php echo $kep_row['file_name'] ?>" style="width: auto; height: 100px;" alt="" /></i>
                                        <h3>Termék neve: &nbsp; <?php echo $row['nev']; ?></h3>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p class="p-title">Hirdető neve: &nbsp; <?php echo $hirdeto_name; ?></p>
                                        <p class="p-title">Elérhető mennyiség: &nbsp;
                                            <?php if ($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                                echo $row['mennyiseg'] . " kg";
                                            } else if ($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                                echo $row['mennyiseg'] . " üveg";
                                            } else {
                                                echo $row['mennyiseg'] . " liter";
                                            } ?></p>
                                        <p class="p-title">Ár/<?php if ($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                                                    echo "kg: &nbsp;" . $row['ar'] . " Ft";
                                                                } else if ($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                                                    echo "üveg: &nbsp;" . $row['ar'] . " Ft";
                                                                } else {
                                                                    echo "liter: &nbsp;" . $row['ar'] . " Ft";
                                                                } ?></p>
                                    </div>
                                    <?php
                                    $maxLength = 18;

                                    if (isset($row['leiras'])) {
                                        $leiras = $row['leiras'];
                                        if (strlen($leiras) > $maxLength) {
                                            $shortDescription = substr($leiras, 0, $maxLength);
                                            $shortDescription .= '...';
                                        } else {
                                            $shortDescription = $leiras;
                                        }
                                    }
                                    ?>
                                    <div class="panel-body text-center">
                                        <p class="p-info">Leírás: &nbsp; <?php echo $shortDescription; ?></p>
                                    </div>
                                    <?php $termek_id = $row['termek_id']; ?>
                                    <form>
                                        <div>
                                            <a href="../user/veglegesit.php?termekId=<?php echo $termek_id; ?>"><input type="button" class="btn sub-btn" name="szerk" id="szerk" value="Vásárlás"></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>


                </div>

            </div>
        </section>
    </form>
</body>

</html>