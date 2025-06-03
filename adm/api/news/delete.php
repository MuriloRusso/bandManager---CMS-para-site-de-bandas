<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id'])):        
        $id = $_POST['id'];
        $sql_code = "DELETE FROM news WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $quantidade = $sql_query->num_rows;
        http_response_code(200);
        echo json_encode([
            'message' => 'Notícia excluída com sucesso!',
            'status' => 200,
        ]);
    endif;