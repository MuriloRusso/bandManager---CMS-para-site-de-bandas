<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['title']) || isset($_POST['text']) || isset($_POST['function']) || isset($_POST['inclusion'])):
        if(strlen($_POST['title']) == 0):
            echo json_encode([
                'message' => 'Nome do Membro em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['text']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Texto da Postagem',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['function']) == 0):
            echo json_encode([
                'message' => 'Função do membro em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['inclusion']) == 0):
            echo json_encode([
                'message' => 'Data de ínicio em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $title = $_POST['title'];
            $text = $_POST['text'];
            $function = $_POST['function'];
            $inclusion = $_POST['inclusion'];
            $id_user = $_SESSION['id'];

            //Capa Post
            $photo = $_FILES['file'];
            $folder = "../../../public/src/img/upload/member/";
            $fileName = $photo['name'];
            $newFileName = '';
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if($extension != ''):
                $newFileName = uniqid();
            endif;

            $path = $folder . $newFileName . "." . $extension;
            $itsRight = move_uploaded_file($photo["tmp_name"], $path);

            //------------------------------------

            $sql_code = "INSERT INTO cad_member (name, function, date_inclusion, text, photo, format, user_created) VALUES ('{$title}', '{$function}', '{$inclusion}', '{$text}', '{$newFileName}', '{$extension}', '{$id_user}')";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            
            http_response_code(200);
            echo json_encode([
                'message' => 'Membro adicionado(a) com sucesso!',
                'status' => 200, 
            ]);

        endif;
    endif;