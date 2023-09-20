<?php
include('connect.php');

function access($rank){
    if($rank == "ADMIN"){
        if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$rank]){
            header("Location: adminkezdolap.php");
        }
    }
    if($rank == "FELHASZNALO") {
        if(isset($_SESSION["ACCESS"]) && !$_SESSION["ACCESS"][$rank]) {
            header("Location: kezdolap.php");
        }
    }
}

$_SESSION["ACCESS"]["ADMIN"] = isset($_SESSION["access"]) && $_SESSION["access"] == '1';
$_SESSION["ACCESS"]["FELHASZNALO"] = isset($_SESSION["access"]) && $_SESSION["access"] == '0';

if(!isset($_SESSION['login_user'])) {
    header("location: ../login.php ");
    die();
}
?>