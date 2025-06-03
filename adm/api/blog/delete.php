<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id'])):
        $id = $_POST['id'];

        $sql_code = "SELECT * FROM post WHERE id=$id Limit 1";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $item = $sql_query->fetch_object();
        $file = "../../../public/src/img/upload/post/$item->capa.$item->format";
        unlink($file);

        $sql_code = "DELETE FROM post WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $quantidade = $sql_query->num_rows;
        http_response_code(200);
        echo json_encode([
            'message' => 'Postagem excluída com sucesso!',
            'status' => 200,
        ]);
    endif;