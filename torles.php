<?php
include("session.php");
access("FELHASZNALO");
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['termekId'])) {
    $termekID = $_POST['termekId'];

    $deleteQuery = "UPDATE termekek SET torolve = '1' WHERE termek_id = $termekID";
    $result = mysqli_query($connect, $deleteQuery);

    if ($result) {
        echo "A termék sikeresen törölve.";
    } else {
        echo "Hiba történt a termék törlése során: " . mysqli_error($connect);
    }
    header("Location: ../user/hirdeteseim.php");
}
?>
