<?php
include("session.php");
access("FELHASZNALO");
include("connect.php");
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
                <!-- item -->
                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="panel panel-pricing">
                        <div class="panel-heading">
                            <i class="fa"><img src="uploads/banan_1.jpg" style="width: auto; height: 100px;" alt=""></i>
                            <h3>Plan -1</h3>
                        </div><!--panel-heading close-->
                        <div class="panel-body text-center">
                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                            <p class="p-time">2 days - 30 Mins</p><!--p-time close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-body text-center">
                            <p class="p-price">₦ 50.00 </p><!--p-price close-->
                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-footer">
                            <a class="btn sub-btn" href="#">Subscribe Now</a>
                        </div>
                    </div><!--panel panel-pricing close-->
                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->


                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="panel panel-pricing">
                        <div class="panel-heading">
                            <i class="fa"><img src="uploads/gyumolcsok.jpg" style="width: auto; height: 100px;" alt=""></i>
                            <h3>Plan -2</h3>
                        </div><!--panel-heading close-->
                        <div class="panel-body text-center">
                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                            <p class="p-time">7 days - 90 Mins</p><!--p-time close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-body text-center">
                            <p class="p-price">₦ 150.00 </p><!--p-price close-->
                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-footer">
                            <a class="btn sub-btn" href="#">Subscribe Now</a>
                        </div>
                    </div><!--panel panel-pricing close-->
                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->



                <div class="col-md-4 col-sm-4 col-xs-12 text-center">
                    <div class="panel panel-pricing">
                        <div class="panel-heading">
                            <i class="fa"><img src="uploads/banan_1.jpg" style="width: auto; height: 100px;" alt=""></i>
                            <h3>Plan -3</h3>
                        </div><!--panel-heading close-->
                        <div class="panel-body text-center">
                            <p class="p-title">Subscription Duration</p><!--p-title close-->
                            <p class="p-time">30 days - 250 Mins</p><!--p-time close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-body text-center">
                            <p class="p-price">₦ 400.00 </p><!--p-price close-->
                            <p class="p-tax">All inclusive</p><!--p-tax close-->
                        </div><!--panel-body text-center close-->
                        <div class="panel-footer">
                            <a class="btn sub-btn" href="#">Subscribe Now</a>
                        </div>
                    </div><!--panel panel-pricing close-->
                </div><!--col-md-4 col-sm-4 col-xs-12 text-center close-->

                
            </div><!--row close-->
            
        </div><!--container close-->
    </section><!--section close-->
</body>

</html>