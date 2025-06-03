<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['title']) || isset($_POST['text']) || isset($_POST['id'])):
        if(strlen($_POST['title']) == 0):
            echo json_encode([
                'message' => 'Título da notícia em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['text']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Texto da Noticia',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $id = $_POST['id'];
            $title = $_POST['title'];
            $text = $_POST['text'];
            $sql_code = "UPDATE news SET title='{$title}', text='{$text}' WHERE id=$id";

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Notícia atualizada com sucesso!',
                'status' => 200, 
            ]);

        endif;
    endif;