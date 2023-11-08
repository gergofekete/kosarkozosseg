<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");
?>

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

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

  <script src="https://use.fontawesome.com/45e03a14ce.js"></script>
  <style>
    @import url(../style/navstyle.css);
    @import url(../style/uzenet.css);
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
        <li class="active"><a href="../user/uzenet.php">Üzenetek</a></li>
        <li><a href="../user/profile.php">Profilom</a></li>
        <!--<li><a href="rolunk.php">Rólunk</a></li>-->
      </ul>
      <ul class="nav navbar-form form-inline navbar-right ml-auto">
        <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
      </ul>
    </div>
  </nav>

  <div class="main_section">
    <div class="container">
      <div class="chat_container">
        <div class="col-sm-3 chat_sidebar">
          <div class="row">
            <div id="custom-search-input">
              <div class="input-group col-md-12">
                <input type="text" class="  search-query form-control" placeholder="Conversation" />
                <button class="btn btn-danger" type="button">
                  <span class=" glyphicon glyphicon-search"></span>
                </button>
              </div>
            </div>

            <div class="member_list">
              <ul class="list-unstyled">
                <li class="left clearfix">
                  <span class="chat-img pull-left">
                    <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                  </span>
                  <div class="chat-body clearfix">
                    <div class="header_sec">
                      <strong class="primary-font">Jack Sparrow</strong> <strong class="pull-right">
                        09:45AM</strong>
                    </div>
                    <div class="contact_sec">
                      <strong class="primary-font">(123) 123-456</strong> <span class="badge pull-right">3</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--chat_sidebar-->


        <div class="col-sm-9 message_section">
          <div class="row">
            <div class="new_message_head">
            </div><!--new_message_head-->

            <div class="chat_area">
              <ul class="list-unstyled">
                <li class="left clearfix">
                  <span class="chat-img1 pull-left">
                    <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">
                  </span>
                  <div class="chat-body1 clearfix">
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.</p>
                    <div class="chat_time pull-right">09:40PM</div>
                  </div>
                </li>
              </ul>
            </div><!--chat_area-->


            <div class="message_write">
              <textarea class="form-control" placeholder="type a message"></textarea>
              <div class="clearfix"></div>
              <div class="chat_bottom">
                <a href="#" class="pull-right btn btn-success">
                  Send</a>
              </div>
            </div>
          </div>
        </div> <!--message_section-->
      </div>
    </div>
  </div>
</body>

</html>