<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['title']) || isset($_POST['text']) || isset($_POST['id'])):
        if(strlen($_POST['title']) == 0):
            echo json_encode([
                'message' => 'Título da Galeria em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['text']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Texto da Galeria',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $id = $_POST['id'];
            $title = $_POST['title'];
            $text = $_POST['text'];
            $id_user = $_SESSION['id'];

            if($_FILES['file']):

                $folder = "../../../public/src/img/upload/gallery/";

                $sql_code = "SELECT * FROM gallery WHERE id=$id Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                $file = "$folder$item->capa.$item->format";
                unlink($file);

                //Capa Post
                $photo = $_FILES['file'];
                $fileName = $photo['name'];
                $newFileName = '';
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if($extension != ''):
                     $newFileName = uniqid();
                endif;

                $path = $folder . $newFileName . "." . $extension;
                $itsRight = move_uploaded_file($photo["tmp_name"], $path);
                $sql_code = "UPDATE gallery SET title='{$title}', text='{$text}', capa='{$newFileName}', format='{$extension}' WHERE id=$id";

                // ------------------------------------

            else:
                $sql_code = "UPDATE gallery SET title='{$title}', text='{$text}' WHERE id=$id";
            endif;

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Galeria atualizada com sucesso!',
                'status' => 200,
            ]);

        endif;
    endif;