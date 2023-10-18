<?php
include("session.php");
access("FELHASZNALO");
include("connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['termekId'])) {
    $termekID = $_POST['termekId'];
    // Ellenőrizd, hogy a felhasználó jogosult-e törölni a terméket (ha szükséges).

    // Törlés végrehajtása a MySQL adatbázisban
    $deleteQuery = "UPDATE termekek SET torolve = '1' WHERE termek_id = $termekID";
    $result = mysqli_query($connect, $deleteQuery);

    if ($result) {
        echo "A termék sikeresen törölve.";
    } else {
        echo "Hiba történt a termék törlése során: " . mysqli_error($connect);
    }
    // Vissza a hirdeteseim.php oldalra vagy bárhova, ahová továbbítani szeretnéd a felhasználót.
}
?>
