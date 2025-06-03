<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    $sql_code = "SELECT * FROM news Order by created Desc";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    // $users = $sql_query->fetch_object();
    $items = [];
    while ($item = $sql_query->fetch_object()) {
        $items[] = $item;
    }
    echo json_encode($items);
    http_response_code(200);
