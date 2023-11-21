<?php
include('../session.php');
access("FELHASZNALO");
include("../connect.php");

$kat_all = mysqli_query($connect, "SELECT * FROM kategoria");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kezdőlap</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css" type="text/css" rel="stylesheet" />
    <script src="//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>

    <style>
        @import "../style/navstyle.css";
        @import url(../style/kezdolap.css);
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
                <li><a href="../user/eladas.php">Eladás</a></li>
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
    <header class="masthead text-white text-center">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 mx-auto mt-5">
                    <h1 class="mb-5">Frissesség • Tudatosság • Fenntarthatóság</h1>
                </div>
                <div class="col-xl-9 mx-auto mt-5">
                    <h1 class="mb-5">ÜDVÖZÖLJÜK A SZEKSZÁRDI KOSÁRKÖZÖSSÉG WEBOLDALÁN!</h1>
                </div>
            </div>
        </div>
    </header>

    <!--Gallery-->
    <section id="photos">
        <h1 class="mb-5 text-center">KÖZÖSSÉGÜNK CÉLJA</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <img class="card-img-top" src="../style/kosar_atad.png" alt="">
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <img class="card-img-top" src="" alt="">
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <img class="card-img-top" src="" alt="">
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">

                    <img class="card-img-top" src="" alt="">
                    <a href="#">
                        <h2>Shushi rolls</h2>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">

                    <img class="card-img-top" src="" alt="">
                    <a href="#">
                        <h2>Spaghetti</h2>
                    </a>

                </div>
                <div class="col-lg-4 col-sm-6 portfolio-item">

                    <img class="card-img-top" src="" alt="">
                    <a href="#">
                        <h2>Pasta</h2>
                    </a>

                </div>

            </div>
        </div>
    </section>
    <!--gallery end-->

    <!-- Testimonials -->
    <section class="testimonials text-center mybg">
        <div class="container">
            <h2 class="mb-5">Kiemelt termelőink</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="../style/profil1.png" alt="">
                        <h5>F. Zsófia</h5>
                        <p class="font-weight-dark mb-0">"Nézd a kézmműves termékeimet."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="" alt="">
                        <h5>E. Réka</h5>
                        <p class="font-weight-dark mb-0">"Kostold meg a házi finomságaimat."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="testimonial-item mx-auto mb-5 mb-lg-0">
                        <img class="img-fluid rounded-circle mb-3" src="../style/profil3.png" alt="">
                        <h5>F. Gergő</h5>
                        <p class="font-weight-dark mb-0">"Az oldal alkotója"</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <section id="footer">
        <div class="container">
            <div class="row text-xs-center text-sm-left text-md-left mb-5">
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <h5 class="txt-upper">Rólunk</h5>
                    <p class="myfont-color text-justify">BLA BLA BLA</p>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3 myfont-color">
                    <h5 class="txt-upper"></h5>
                    <p> LUNCH:
                        <br> Mon-Fri: 11:30 AM - 2:30 PM
                        <br>
                        <br> DINNER:

                        <br> Mon-Thu: 4:45 PM - 10:30 PM
                        <br> Fri: 4:45 PM - 11 PM
                        <br> Sat: 4:30 PM - 11 PM
                        <br> Sun: 5:00 PM - 10:30 PM
                    <p>

                </div>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <h5 class="txt-upper">Termék kategóriák</h5>
                    <ul class="list-unstyled quick-links">
                        <?php if(isset($kat_all)) {
                            while ($kat_row = mysqli_fetch_assoc($kat_all)) { ?>
                            <li><a href=""><?php echo $kat_row['nev'] ?></a></li>

                        <?php    }
                        } ?>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-3">
                    <h5 class="txt-upper">Hivatkozások</h5>
                    <ul class="list-unstyled quick-links">
                        <li><a href="javascript:void();">Eladás</a></li>
                        <li><a href="javascript:void();">Hirdetéseim</a></li>
                        <li><a href="javascript:void();">Vásárlás</a></li>
                        <li><a href="javascript:void();">Mi az a kosárközösség?</a></li>
                        <li><a href="javascript:void();">Üzenetek</a></li>
                        <li><a href="javascript:void();">Profilom</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!--Footer -->

    <div class="scroll-top-wrapper ">
        <span class="scroll-top-inner">
            <i class="fa fa-2x fa-arrow-circle-up"></i>
        </span>
    </div>
</body>

</html>