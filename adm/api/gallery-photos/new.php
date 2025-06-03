<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id_gallery'])):

        $id_user = $_SESSION['id'];
        $idGallery = $_POST['id_gallery'];


        //Foto
        $photo = $_FILES['file'];
        $folder = "../../../public/src/img/upload/gallery/photos/";
        $fileName = $photo['name'];
        $newFileName = '';
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if($extension != ''):
            $newFileName = uniqid();
        endif;

        $path = $folder . $newFileName . "." . $extension;
        $itsRight = move_uploaded_file($photo["tmp_name"], $path);

        //------------------------------------

        $sql_code = "INSERT INTO photo (id_gallery, photo, format, user_created) VALUES ('{$idGallery}', '{$newFileName}', '{$extension}', '{$id_user}')";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $quantidade = $sql_query->num_rows;
        http_response_code(200);
        echo json_encode([
            'message' => 'Foto adicionada com sucesso!',
            'status' => 200, 
        ]);

    endif;