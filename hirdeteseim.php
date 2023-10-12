<?php
include("session.php");
access("FELHASZNALO");
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET' || $_SERVER['REQUEST_METHOD'] == 'POST') {
    $login_user = $_SESSION['bejelentkezett'];
    $hirdeto = mysqli_query($connect, "SELECT user_id FROM user WHERE username = '$login_user'");
    $hirdeto_row = mysqli_fetch_assoc($hirdeto);
    $hirdeto_id = $hirdeto_row['user_id'];
    $termekek = mysqli_query($connect, "SELECT * FROM termekek WHERE hirdeto_id = '$hirdeto_id' AND jovahagyva = '0' AND torolve = '0'");
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
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        @import url(style/navstyle.css);
        @import url(style/hirdeteseim.css);
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
                <li><a href="eladas.php">Eladás</a></li>
                <li class="active"><a href="hirdeteseim.php">Hirdetéseim</a></li>
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
    <div class="container-fluid">

        <div class="plans col-md-12 col-sm-12 col-xs-12 text-center">
            <h5>Hirdetett Termékeim</h5>
        </div>
    </div><!--container-fluid close-->
    <section>
        <div class="container">
        <div class="row">
            <?php
            if (isset($termekek)) {
                while ($row = mysqli_fetch_assoc($termekek)) {?>
                    <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="panel panel-pricing">
                        <div class="panel-heading">
                            <i class="fa"><img src="data:image/jpg;base64,'.base64_encode($row['kep']).'" style="width: auto; height: 100px;" alt=""/></i>
                            <h3>Termék neve: &nbsp; <?php echo $row['nev']; ?></h3>
                        </div><!--panel-heading close-->
                        <div class="panel-body text-center">
                            <p class="p-title">Elérhető mennyiség:  &nbsp;
                                <?php if($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                    echo $row['mennyiseg']." kg";
                                } else if($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                    echo $row['mennyiseg']." üveg";
                                } else {
                                    echo $row['mennyiseg']." liter";
                                } ?></p>
                            <p class="p-title">Ár/<?php if($row['kategoria_id'] == 1 || $row['kategoria_id'] == 2) {
                                    echo "kg: &nbsp;".$row['ar']." Ft";
                                } else if($row['kategoria_id'] == 3 || $row['kategoria_id'] == 4) {
                                    echo "üveg: &nbsp;".$row['ar']." Ft";
                                } else {
                                    echo "liter: &nbsp;".$row['ar']." Ft";
                                } ?></p>
                        </div><!--panel-body text-center close-->
                        <div class="panel-body text-center">
                            <p class="p-tax">Leírás: &nbsp; <?php echo $row['leiras']; ?></p>
                        </div><!--panel-body text-center close-->

                        <?php
                            $torolni = $row['termek_id'];
                        
                            if(isset($_POST['torles'.$torolni.''])) {
                                echo "TRRGSDFSFSFSDFSDFSDFSD";
                                $eltavolit = mysqli_query($connect, "UPDATE termekek SET torolve = '1' WHERE termek_id = '$torolni'");
                                echo '<script>
                                location.reload()
                                </script>';
                            }
                            else {
                                echo "AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAa";
                            }
                        ?>
                        <form method="post">
                            <div class="panel-footer">
                                <input type="submit" class="btn sub-btn" name="szerk" id="szerk" value="Szerkesztés">
                                <input type="submit" class="btn del-btn" name="torles<?php echo $torolni; ?>" id="torles" value="Törlés">
                            </div>
                        </form>
                    </div><!--panel panel-pricing close-->
                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->
                <?php
                }
            }
            ?>


        </div><!--row close-->

        </div><!--container close-->
    </section><!--section close-->
</body>

</html>