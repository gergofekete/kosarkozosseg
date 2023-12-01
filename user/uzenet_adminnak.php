<?php
include("../session.php");
access("FELHASZNALO");
include("../connect.php");

$login_user = $_SESSION['bejelentkezett'];
$login_email = $_SESSION['bejelentkezett_email'];
$me = mysqli_query($connect, "SELECT user_id, username FROM user WHERE (username = '$login_user' OR email = '$login_email')");
$me_row = mysqli_fetch_assoc($me);
$me_id = $me_row['user_id'];

$admin_id = '9';

$uzenet = mysqli_query($connect, "SELECT * FROM uzenetek WHERE (felado_id = '$me_id' OR felado_id = '$admin_id') AND (cimzett_id = '$me_id' OR cimzett_id = '$admin_id') ORDER BY kuldes_date");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['kuld'])) {
        if (isset($_POST['uzenet']) && $_POST['uzenet'] != '') {

            $szoveg = $_POST['uzenet'];
            $kuldes_date = date("Y-m-d H:i:s");
            $termek_id = '0';

            $kuldes = mysqli_query($connect, "INSERT INTO uzenetek (felado_id, cimzett_id, termek_id, targy, szoveg, kuldes_date)
                                VALUES ('$me_id', '$admin_id','$termek_id', 'admin', '$szoveg', '$kuldes_date')");

            header("Refresh:0");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Üzeneteim</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../script.js"></script>



    <style>
        @import url(../style/navstyle.css);
        @import url(../style/uzenet2.css);
    </style>

</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../user/uzenet.php">Vissza az <b>Üzenetekre</b></a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-form form-inline navbar-right ml-auto">
                <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="messaging">
            <div class="inbox_msg">
                <div class="inbox_people">
                    <div class="headind_srch">
                        <div class="recent_heading">
                            <h4>Üzenetek </h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <div class="chat_list active_chat">
                            <div class="chat_people">
                                <div class="chat_ib">
                                    <h5>ADMIN</h5>

                                    <h5><span class="chat_date">Dec 25</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                        <?php
                        if (isset($uzenet)) {
                            while ($row = mysqli_fetch_assoc($uzenet)) {
                                if ($row['felado_id'] == '9' || $row['cimzett_id'] == $me_id) {
                        ?>
                                    <div class="incoming_msg">
                                        <div class="received_msg">
                                            <div class="received_withd_msg">
                                                <p><?php echo $row['szoveg']; ?>
                                                </p>
                                                <span class="time_date"><?php echo $row['kuldes_date']; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                } else if ($row['felado_id'] == $me_id || $row['cimzett_id'] == '9') {
                                ?>
                                    <div class="outgoing_msg">
                                        <div class="sent_msg">
                                            <p><?php echo $row['szoveg']; ?>
                                            </p>
                                            <span class="time_date"><?php echo $row['kuldes_date']; ?></span>
                                        </div>
                                    </div>
                        <?php
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="type_msg">
                        <form method="post">
                            <div class="input_msg_write">
                                <input type="text" class="write_msg" name="uzenet" placeholder="Üzenet írása" />
                                <button class="msg_send_btn" type="submit" name="kuld"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>