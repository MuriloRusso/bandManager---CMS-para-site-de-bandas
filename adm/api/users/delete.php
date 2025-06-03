<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id'])):
        $id = $_POST['id'];

        $sql_code = "SELECT * FROM cad_user WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $user = $sql_query->fetch_object();

        if($_POST['id'] === $_SESSION['id']):
            http_response_code(401);
            echo json_encode([
                'message' => 'Você não pode excluir o seu próprio usuário!',
                'status' => 401,
            ]);
        elseif($user->id_hierarchy == 1):
            http_response_code(401);
            echo json_encode([
                'message' => 'Você não pode excluir um Administrador Master!',
                'status' => 401,
            ]);
        else:
            $sql_code = "DELETE FROM cad_user WHERE id=$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Usuário excluído com sucesso!',
                'status' => 200,
            ]);
        endif;
    endif;