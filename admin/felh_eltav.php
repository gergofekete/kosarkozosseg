<?php
include('../session.php');
access("ADMIN");
include('../connect.php');

$felhasznalok = mysqli_query($connect, "SELECT * FROM user WHERE admine = '0'");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['search']) && isset($_POST['felhasznalonev'])) {
        $keres = $_POST['felhasznalonev'];
        $felhasznalok = mysqli_query($connect, "SELECT * FROM user WHERE (admine = '0' AND username LIKE '%$keres%')");
    }
    if(isset($_POST['torol'])) {
        $felh_id = $_POST['felh_id'];
        $torol = mysqli_query($connect, "DELETE FROM user WHERE user_id = '$felh_id'");
        header("Refresh:0");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin felület</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">

    <style>
        @import "../style/navstyle.css";
        @import "../style/adminkezdolap.css";
    </style>
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light">
        <div class="navbar-header">
            <a class="navbar-brand" href="../admin/adminkezdolap.php"><b>Admin</b> Felület</a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="../admin/felh_eltav.php">Felhasználók eltávolítása</a></li>
                <li><a href="../admin/adminuzenetek.php">Üzenetek</a></li>
                <li><a href="../admin/adminprofil.php">Profilom</a></li>
            </ul>
            <ul class="nav navbar-form form-inline navbar-right ml-auto">
                <li style="float: right;text-align:right; color: black;"><a href="../logout.php">Kijelentkezés</a></li>
            </ul>
        </div>
    </nav>

    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Regisztrált <b>felhasználók</b></h2>
                </div>
                <div class="col-sm-6">
                    <form method="post">
                        <h4>Keresés: &nbsp;<input style="color: black;" type="text" name="felhasznalonev" placeholder="Felhasználónév">&nbsp;<button type="submit" name="search" style="color: black;"><i class="fas fa-search"></i></button></h4>
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Név</th>
                    <th>Felahsználónév</th>
                    <th>E-mail</th>
                    <th>Eltávolítás</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($felhasznalok)) {
                    while ($row = mysqli_fetch_assoc($felhasznalok)) {
                        $user_id = $row['user_id']
                ?>
                        <form method="post">
                            <tr>
                                <td><?php echo $row['user_id']; ?></td>
                                <td><?php echo $row['lname'] . ' ' . $row['fname']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <input type="hidden" name="felh_id" value="<?php echo $user_id; ?>">
                                <td><button type="submit" name="torol" style="background-color: #ba1717; color: white" onclick="confirmDelete(<?php echo $user_id; ?>);">Törlés</button></td>
                            </tr>
                        </form>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>