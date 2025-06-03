<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    $sql_code = "SELECT post.*, cad_user.name AS user_name
    FROM post
    JOIN cad_user ON post.user_created = cad_user.id
    ORDER BY post.created DESC";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $items = [];
    while ($item = $sql_query->fetch_object()) {
        $items[] = $item;
    }
    echo json_encode($items);
    http_response_code(200);
