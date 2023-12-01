<?php
include('../session.php');
access("ADMIN");
include('../connect.php');

$user_id = $_GET['felhId'];

$user = mysqli_query($connect, "SELECT * FROM user WHERE user_id = '$user_id'");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['del'])) {
        $torol = mysqli_query($connect, "DELETE FROM user WHERE user_id = $user_id");
        header("Location: ../admin/felh_eltav.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hirdetés kezelés</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <style>
        @import "../style/navstyle.css";
        @import url(../style/hirdeteskezeles.css);
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
        </div>
    </nav>
    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    if (isset($user)) {
                        while ($row = mysqli_fetch_assoc($user)) {
                    ?>
                            <div class="profile-head">
                                <h3>
                                    Felhasználónév: &nbsp; <?php echo $row['username']; ?>
                                </h3>
                                <br>
                                <h4>
                                    Azonosító: &nbsp; <?php echo $row['user_id']; ?>
                                </h4>
                                <br>
                                <h4>
                                    Név: &nbsp; <?php echo $row['lname'] . ' ' . $row['fname']; ?>
                                </h4>
                                <br>
                                <h4>
                                    E-mail: &nbsp; <?php echo $row['email']; ?>
                                </h4>
                                <br>
                            </div>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <form method="post" style="text-align: center;">
                <button class="btn del-btn" style="display: block; margin: 0 auto 10px; background: #7a0f12; color: #fff;" id="del" name="del">Törlés</button>
            </form>

        </form>
    </div>
</body>

</html>