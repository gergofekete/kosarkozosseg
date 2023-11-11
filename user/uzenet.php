<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");
$login_user = $_SESSION['bejelentkezett'];
$login_email = $_SESSION['bejelentkezett_email'];
$user = mysqli_query($connect, "SELECT * FROM user WHERE (username = '$login_user' OR email = '$login_email')");
$user_row = mysqli_fetch_assoc($user);
$user_id = $user_row['user_id'];

$kuldo = mysqli_query($connect, "SELECT * FROM uzenetek WHERE felado_id = '$user_id' OR cimzett_id = '$user_id' ORDER BY kuldes_date");

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

  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
                <?php
                if (isset($kuldo)) {
                  while ($row = mysqli_fetch_assoc($kuldo)) {

                    $felado_id = $row['felado_id'];
                    $felado_name = mysqli_query($connect, "SELECT username FROM user WHERE user_id = '$felado_id'");
                    $felado_name_row = mysqli_fetch_assoc($felado_name);

                    $cimzett_id = $row['cimzett_id'];
                    $cimzett_name = mysqli_query($connect, "SELECT username FROM user WHERE user_id = '$cimzett_id'");
                    $cimzett_name_row = mysqli_fetch_assoc($cimzett_name);

                    $idobelyeg = strtotime($row['kuldes_date']);
                    $date = date("Y-m-d", $idobelyeg);
                ?>
                    <li class="left clearfix">
                      <div class="chat-body clearfix">
                        <div class="header_sec">
                          <strong class="primary-font"><?php if ($user_id == $row['felado_id']) {
                                                          echo $cimzett_name_row['username'];
                                                        } else if ($user_id == $row['cimzett_id']) {
                                                          echo $felado_name_row['username'];
                                                        } ?>
                          </strong> <strong class="pull-right"><?php echo $date; ?></strong>
                        </div>
                        <div class="contact_sec">
                          <strong class="primary-font"><?php echo $row['targy']; ?></strong> <span class="badge pull-right">3</span>
                        </div>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>
              </ul>
            </div>
          </div>
        </div>


        <div class="col-sm-9 message_section">
          <div class="row">
            <div class="chat_area">
              <ul class="list-unstyled">
                <?php
                $uzenet = mysqli_query($connect, "SELECT * FROM uzenetek WHERE (felado_id = '$user_id' OR cimzett_id = '$user_id') AND targy = 'Eper lekvár' ORDER BY kuldes_date");
                if (isset($uzenet)) {
                  while ($uzenet_row = mysqli_fetch_assoc($uzenet)) { ?>
                    <li class="left clearfix">
                      <div class="chat-body1 clearfix">
                        <p><?php echo $uzenet_row['szoveg']; ?></p>
                        <div class="chat_time pull-right"><?php echo $uzenet_row['kuldes_date']; ?></div>
                      </div>
                    </li>
                <?php
                  }
                }
                ?>
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