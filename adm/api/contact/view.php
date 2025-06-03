<?php
    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id'])):
        if(strlen($_POST['id']) == 0):
            echo json_encode([
                'message' => 'ID em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $id = $_POST['id'];
            $sql_code = "UPDATE contact SET view=1 Where id=$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            http_response_code(200);
            echo json_encode([
                'message' => 'Mensagem marcada como vista com sucesso!',
                'status' => 200,
            ]);
        endif;
    endif;