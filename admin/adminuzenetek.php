<?php
include("../session.php");
access("ADMIN");
include("../connect.php");

$login_user = $_SESSION['bejelentkezett'];
$login_email = $_SESSION['bejelentkezett_email'];
$me = mysqli_query($connect, "SELECT user_id, username FROM user WHERE (username = '$login_user' OR email = '$login_email')");
$me_row = mysqli_fetch_assoc($me);
$me_id = $me_row['user_id'];
$me_username = $me_row['username'];



$uzeneteim = mysqli_query($connect, "
    SELECT u.*, felado.username AS felado_username, cimzett.username AS cimzett_username
    FROM uzenetek u
    JOIN user felado ON u.felado_id = felado.user_id
    JOIN user cimzett ON u.cimzett_id = cimzett.user_id
    WHERE (felado.username = '$login_user' OR cimzett.username = '$login_user')
      AND (felado.username != '$login_user')  -- Ezt a sort hozzáadtuk
    GROUP BY felado_username, cimzett_username
    ORDER BY u.kuldes_date DESC
");




if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['felado_id'], $_POST['cimzett_id'], $_POST['termek_id'], $_POST['message'])) {
        $felado_id = $_POST['felado_id'];
        $cimzett_id = $_POST['cimzett_id'];
        $termek_id = $_POST['termek_id'];
    } else if (isset($_POST['kuld'])) {
        $termek_id = $_POST['termek_id'];
        $felado_id = $_POST['felado_id'];
        $cimzett_id = $_POST['cimzett_id'];

        if (isset($_POST['uzenet']) && $_POST['uzenet'] != '') {
            $termek = mysqli_query($connect, "SELECT nev FROM termekek WHERE termek_id = '$termek_id'");
            $t_row = mysqli_fetch_assoc($termek);
            $szoveg = $_POST['uzenet'];

            $kuldes_date = date("Y-m-d H:i:s");

            if ($felado_id == $me_id) {
                $send_message = mysqli_query($connect, "INSERT INTO uzenetek (felado_id, cimzett_id, termek_id, targy, szoveg, kuldes_date)
                                            VALUES ('$me_id', '$cimzett_id', '0', 'admin', '$szoveg', '$kuldes_date')");
            } else if ($cimzett_id == $me_id) {
                $send_message = mysqli_query($connect, "INSERT INTO uzenetek (felado_id, cimzett_id, termek_id, targy, szoveg, kuldes_date)
                                            VALUES ('$me_id', '$felado_id', '0', 'admin', '$szoveg', '$kuldes_date')");
            }
            header("Reload:0");
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
    <script src="../adminscript.js"></script>



    <style>
        @import url(../style/navstyle.css);
        @import url(../style/uzenet2.css);
    </style>

</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="../admin/felh_eltav.php">Felhasználók eltávolítása</a></li>
                <li class="active"><a href="../admin/adminuzenetek.php">Üzenetek</a></li>
                <li><a href="../admin/adminprofil.php">Profilom</a></li>
            </ul>
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
                            <h4>Üzenetek</h4>
                        </div>
                    </div>
                    <div class="inbox_chat">
                        <?php while ($row = mysqli_fetch_assoc($uzeneteim)) {
                            $felado_id = $row['felado_id'];
                            $felado_name = mysqli_query($connect, "SELECT username FROM user WHERE user_id = '$felado_id'");
                            $felado_name_row = mysqli_fetch_assoc($felado_name);

                            $cimzett_id = $row['cimzett_id'];
                            $cimzett_name = mysqli_query($connect, "SELECT username FROM user WHERE user_id = '$cimzett_id'");
                            $cimzett_name_row = mysqli_fetch_assoc($cimzett_name);

                            $termek_id = $row['termek_id'];

                            $idobelyeg = strtotime($row['kuldes_date']);
                            $date = date("Y-m-d", $idobelyeg);

                            if ($me_id == $felado_id) {
                                $latest = mysqli_query($connect, "SELECT szoveg FROM uzenetek WHERE felado_id = '$me_id' AND cimzett_id = '$cimzett_id' AND termek_id = '$termek_id' ORDER BY kuldes_date DESC LIMIT 1");
                                $latest_row = mysqli_fetch_assoc($latest);
                                $latest_szoveg = $latest_row['szoveg'];
                            } else {
                                $latest = mysqli_query($connect, "SELECT szoveg FROM uzenetek WHERE felado_id = '$felado_id' AND cimzett_id = '$me_id' AND termek_id = '$termek_id' ORDER BY kuldes_date DESC LIMIT 1");
                                $latest_row = mysqli_fetch_assoc($latest);
                                $latest_szoveg = $latest_row['szoveg'];
                            }

                            $maxLength = 130;
                            if (isset($latest_szoveg)) {
                                if (strlen($latest_szoveg) > $maxLength) {
                                    $short = substr($latest_szoveg, 0, $maxLength);
                                    $short .= '...';
                                } else {
                                    $short = $latest_szoveg;
                                }
                            }

                            if (isset($_POST['felado_id']) && isset($_POST['cimzett_id']) && $felado_id == $_POST['felado_id'] && $cimzett_id == $_POST['cimzett_id']) {
                        ?>
                                <div class="chat_list active_chat" onclick="listItemClick(<?php echo $felado_id; ?>, <?php echo $cimzett_id; ?>, <?php echo $termek_id; ?>)">

                                    <div class="chat_people">
                                        <div class="chat_ib">
                                            <h5><?php if ($me_id == $row['felado_id']) {
                                                    echo $cimzett_name_row['username'];
                                                } else if ($me_id == $row['cimzett_id']) {
                                                    echo $felado_name_row['username'];
                                                } ?><span><?php echo $row['targy']; ?></span></h5>
                                            <p><?php echo $short; ?></p>
                                            <h5><span><?php echo $date; ?></span></h5>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="chat_list" onclick="listItemClick(<?php echo $felado_id; ?>, <?php echo $cimzett_id; ?>, <?php echo $termek_id; ?>)">

                                    <div class="chat_people">
                                        <div class="chat_ib">
                                            <h5><?php if ($me_id == $row['felado_id']) {
                                                    echo $cimzett_name_row['username'];
                                                } else if ($me_id == $row['cimzett_id']) {
                                                    echo $felado_name_row['username'];
                                                } ?><span><?php echo $row['targy']; ?></span></h5>
                                            <p><?php echo $short; ?></p>
                                            <h5><span><?php echo $date; ?></span></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } ?>
                    </div>
                </div>
                <div class="mesgs">
                    <div class="msg_history">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            if (isset($_POST['felado_id'], $_POST['cimzett_id'], $_POST['termek_id'], $_POST['message']) || isset($_POST['kuld'])) {
                                $felado_id = $_POST['felado_id'];
                                $cimzett_id = $_POST['cimzett_id'];
                                $termek_id = $_POST['termek_id'];

                                $chat = mysqli_query($connect, "SELECT * FROM uzenetek WHERE (felado_id = '$me_id' OR cimzett_id = '$me_id') AND (felado_id = '$felado_id' OR cimzett_id = '$felado_id' )");

                                while ($row = mysqli_fetch_assoc($chat)) {
                                    if ($row['felado_id'] == $me_id) { ?>
                                        <div class="outgoing_msg">
                                            <div class="sent_msg">
                                                <p><?php echo $row['szoveg']; ?></p>
                                                <span class="time_date"><?php echo $row['kuldes_date']; ?></span>
                                            </div>
                                        </div>
                                    <?php

                                    } else { ?>
                                        <div class="incoming_msg">
                                            <div class="received_msg">
                                                <div class="received_withd_msg">
                                                    <p><?php echo $row['szoveg']; ?></p>
                                                    <span class="time_date"><?php echo $row['kuldes_date']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                        <?php

                                    }
                                }
                            } else {
                                http_response_code(400);
                            }
                        }
                        ?>
                    </div>
                    <div class="type_msg">
                        <div class="input_msg_write">
                            <form method="post">

                                <input type="hidden" name="termek_id" value="<?php echo $termek_id; ?>">
                                <input type="hidden" name="felado_id" value="<?php echo $felado_id; ?>">
                                <input type="hidden" name="cimzett_id" value="<?php echo $cimzett_id; ?>">
                                <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') { ?>
                                    <input type="text" class="write_msg" name="uzenet" placeholder="Üzenet írása" />
                                    <button class="msg_send_btn" type="submit" name="kuld"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                <?php
                                } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>