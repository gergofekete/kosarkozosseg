<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");

$login_user = $_SESSION['bejelentkezett'];
$login_email = $_SESSION['bejelentkezett_email'];
$hirdeto = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$login_user' OR email = '$login_email')");
$hirdeto_row = mysqli_fetch_assoc($hirdeto);
$hirdeto_id = $hirdeto_row['user_id'];
$termekek = mysqli_query($connect, "SELECT * FROM termekek WHERE hirdeto_id = '$hirdeto_id' AND torolve = '0' ORDER BY termek_id DESC");

$kepek = mysqli_query($connect, "SELECT * FROM kepek INNER JOIN termekek WHERE kepek.kep_id = termekek.kep_id");
$kep_row = mysqli_fetch_assoc($kepek);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirdetéseim</title>
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
    <script type="text/javascript">
        function confirmDelete(termekId) {
            var confirmed = confirm('Biztosan törli a hirdetést?');
            if (confirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../torles.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.send('termekId=' + termekId);
            }
            location.reload();
            return confirmed;
        }
    </script>

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
                    <li class="active"><a href="../user/hirdeteseim.php">Hirdetéseim</a></li>
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
        <div class="container-fluid">

            <div class="plans col-md-12 col-sm-12 col-xs-12 text-center">
                <h5>Hirdetett Termékeim</h5>
            </div>
        </div>
        <section>
            <div class="container">
                <div class="row">
                    <?php
                    if (isset($termekek)) {
                        while ($row = mysqli_fetch_assoc($termekek)) {
                            $kepid = $row['kep_id'];
                            $termek_id = $row['termek_id'];
                            $kepek = mysqli_query($connect, "SELECT * FROM kepek WHERE kep_id =  '$kepid'");
                            $kep_row = mysqli_fetch_assoc($kepek); ?>
                            <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                                <div class="panel panel-pricing">
                                    <div class="panel-heading">
                                        <i class="fa"><img src="../uploads/<?php echo $kep_row['file_name'] ?>" style="width: auto; height: 100px;" alt="" /></i>
                                        <h3><?php echo $row['nev']; ?></h3>
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
                                        <p class="p-title">Elérhető mennyiség: &nbsp;
                                            <?php if ($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                                echo $row['mennyiseg'] . " kg";
                                            } else if ($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                                echo $row['mennyiseg'] . " üveg";
                                            } else if ($row['kategoria_id'] == 5 || $row['kategoria_id'] == 6) {
                                                echo $row['mennyiseg'] . " liter";
                                            } else {
                                                echo $row['mennyiseg'] . " db";
                                            } ?></p>
                                        <p class="p-title">Ár/<?php if ($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                                                    echo "kg: &nbsp;" . $row['ar'] . " Ft";
                                                                } else if ($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                                                    echo "üveg: &nbsp;" . $row['ar'] . " Ft";
                                                                } else if ($row['kategoria_id'] == 5 ||$row['kategoria_id'] == 6) {
                                                                    echo "liter: &nbsp;" . $row['ar'] . " Ft";
                                                                } else {
                                                                    echo "darab: &nbsp;" . $row['ar'] . " Ft";
                                                                } ?></p>
                                        <p class="p-info">Leírás: &nbsp; <?php echo $shortDescription; ?></p>
                                    </div>
                                    <div class="panel-body text-center">
                                        <p class="p-info">Státusz: &nbsp; <?php if ($row['jovahagyva'] == '0') {
                                                                                echo "Jóváhagyásra vár";
                                                                            } else if ($row['jovahagyva'] == '1') {
                                                                                echo "Jóváhagyva";
                                                                            } ?></p>
                                    </div>

                                    <?php
                                    $torolni = $row['termek_id'];
                                    ?>
                                    <form action="">
                                        <div>
                                            <a href="../user/szerkesztes.php?termekId=<?php echo $termek_id; ?>"><button type="button" class="btn sub-btn">Szerkesztés</button></a>
                                        </div>
                                    </form>

                                    <form method="post" onsubmit="return confirmDelete(<?php echo $torolni; ?>)">
                                        <div class="panel-footer">
                                            <input type="hidden" id="torles_termek_id" name="torles_termek_id" value="<?php echo $torolni; ?>">
                                            <button type="button" class="btn del-btn" onclick="confirmDelete(<?php echo $torolni; ?>);">Törlés</button>
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