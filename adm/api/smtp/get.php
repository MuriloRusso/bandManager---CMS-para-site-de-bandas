<?php

    include('../../../public/includes/connect.php');
    include('../../../public/includes/protect.php');
    include('../cors.php');
    $sql_code = "SELECT * FROM smtp Limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $item = $sql_query->fetch_object();
    echo json_encode($item);
    http_response_code(200);
