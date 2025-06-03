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

                // $sql_code = "SELECT * from gallery where id=$id";
                // $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                // $post = $sql_query->fetch_object();               

                //Capa Post
                $photo = $_FILES['file'];
                $folder = "../../../public/src/img/upload/gallery/";
                $fileName = $photo['name'];
                $newFileName = '';
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if($extension != ''):
                     $newFileName = uniqid();
                endif;

                $path = $folder . $newFileName . "." . $extension;
                // $path = $folder . $post->capa . "." . $extension;
                $itsRight = move_uploaded_file($photo["tmp_name"], $path);
                // $itsRight = move_uploaded_file($post->capa, $path);

                $sql_code = "UPDATE gallery SET title='{$title}', text='{$text}', capa='{$newFileName}', format='{$extension}' WHERE id=$id";
                // $sql_code = "UPDATE post SET title='{$title}', text='{$text}', capa='{$post->capa}', format='{$extension}' WHERE id=$id";

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