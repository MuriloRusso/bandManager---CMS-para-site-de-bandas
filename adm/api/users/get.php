<?php

    include('../../../public/includes/connect.php');
    include('cors.php');
    $sql_code = "SELECT id, name, username, email, id_hierarchy FROM cad_user";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    // $users = $sql_query->fetch_object();
    $users = [];
    while ($user = $sql_query->fetch_object()) {
        $users[] = $user;
    }
    echo json_encode($users);
    http_response_code(200);
