<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Üzeneteim</title>
<link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto|Oswald:300,400" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    @import url(style/navstyle.css);
    @import url(style/uzenet.css);
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
            <li><a href="hirdeteseim.php">Hirdetéseim</a></li>
            <li><a href="vasarlas.php">Vásárlás</a></li>            
            <li><a href="kosark.php">Mi az a kosárközösség?</a></li>
            <li class="active"><a href="uzenet.php">Üzenetek</a></li>
            <li><a href="profile.php">Profilom</a></li>
            <!--<li><a href="rolunk.php">Rólunk</a></li>-->
        </ul>
        <ul class="nav navbar-form form-inline navbar-right ml-auto">
            <li style="float: right;text-align:right; color: black;"><a href="logout.php">Kijelentkezés</a></li>
        </ul>
    </div>
</nav>

<h2>Chat Messages</h2>

<div class="container">
  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Hello. How are you today?</p>
  <span class="time-right">11:00</span>
</div>

<div class="container darker">
  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
  <p>Hey! I'm fine. Thanks for asking!</p>
  <span class="time-left">11:01</span>
</div>

<div class="container">
  <img src="/w3images/bandmember.jpg" alt="Avatar" style="width:100%;">
  <p>Sweet! So, what do you wanna do today?</p>
  <span class="time-right">11:02</span>
</div>

<div class="container darker">
  <img src="/w3images/avatar_g2.jpg" alt="Avatar" class="right" style="width:100%;">
  <p>Nah, I dunno. Play soccer.. or learn more coding perhaps?</p>
  <span class="time-left">11:05</span>
</div>
</body>
</html>                            
