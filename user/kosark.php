<?php
include('../session.php');
access("FELHASZNALO");
?>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kosárközösségek</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <style>
        @import url(../style/navstyle.css);
        @import url(../style/kosark.css);
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
                <li class="active"><a href="../user/kosark.php">Mi az a kosárközösség?</a></li>
                <li><a href="../user/uzenet.php">Üzenetek</a></li>
                <li><a href="../user/profile.php">Profilom</a></li>
            </ul>
            <ul class="nav navbar-form form-inline navbar-right ml-auto">
                <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="20000">
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="../style/kezdolap1.jpg" alt="">
                            <div class="carousel-caption">
                                <h3>Mik azok a kosárközösségek?</h3>
                                <p>
                                    A kosárközösségek olyan kezdeményezések szerte az országban, amelyek a helyi termelőktől származó termékeket
                                    segítik eljuttatni a helyi fogyasztókhoz. Az ilyen közösségek része továbbá egy önkéntes csapat, amely a termékek
                                    áramlásában tölt be fontos szerepet.
                                </p>
                                <p>
                                    Ha szeretne ennek a közösségnek a részese lenni, akkor a legjobb helyen jár!
                                </p>

                            </div>
                        </div>
                        <div class="item">
                            <img src="../style/gyumolcsok.jpg" alt="">
                            <div class="carousel-caption">
                                <h3>Vásárolj helyi termelőktől!</h3>
                                <p>Így friss és egészséges élelmiszerekhez tudsz hozzájutni, támogatod a helyi termelőket és környezettudatosabb is.</p>
                                <div class="carousel-action">
                                    <a href="../user/vasarlas.php" class="btn btn-primary">Vásárolok</a>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <img src="../style/zoldsegek.png" alt="">
                            <div class="carousel-caption">
                                <h3>Add el saját terményeidet!</h3>
                                <p>Add el gyorsan és egyszerűen saját számodra fölösleges terményeidet.</p>
                                <div class="carousel-action">
                                    <a href="../user/eladas.php" class="btn btn-primary">Eladás</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="carousel-control right" href="#myCarousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>