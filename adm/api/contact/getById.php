<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_GET['id'])):        
        $id = $_GET['id'];
        $sql_code = "SELECT * FROM contact WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $quantidade = $sql_query->num_rows;
        http_response_code(200);
        echo json_encode( $sql_query->fetch_object());
    endif;