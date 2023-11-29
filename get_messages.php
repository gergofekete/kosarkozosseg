<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['felado_id'], $_POST['cimzett_id'], $_POST['termek_id'])) {
        $felado_id = $_POST['felado_id'];
        $cimzett_id = $_POST['cimzett_id'];
        $termek_id = $_POST['termek_id'];

        $response = array(
            'felado_id' => $felado_id,
            'cimzett_id' => $cimzett_id,
            'termek_id' => $termek_id,
            'message' => 'Sikeres adatfeldolgozás!'
        );

        header('Content-Type: application/json');
        echo json_encode($response);
    } else {

        http_response_code(400);
        echo "Hiányzó adatok a kérésben.";
    }
} else {

    http_response_code(405);
    echo "Csak POST kérést fogadunk el.";
}
?>
