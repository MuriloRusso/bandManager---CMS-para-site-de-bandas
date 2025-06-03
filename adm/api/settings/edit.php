<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['title']) || isset($_POST['text']) || isset($_POST['band_name']) || isset($_POST['email_contact']) ||
    isset($_POST['cardTitle1']) || isset($_POST['cardSubTitle1']) || isset($_POST['cardText1']) ||
    isset($_POST['cardTitle2']) || isset($_POST['cardSubTitle2']) || isset($_POST['cardText2']) ||
    isset($_POST['cardTitle3']) || isset($_POST['cardSubTitle3']) || isset($_POST['cardText3'])):
        if(strlen($_POST['title']) == 0):
            echo json_encode([
                'message' => 'Título do site em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['text']) == 0):
            echo json_encode([
                'message' => 'Texto de introdução do site em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['band_name']) == 0):
            echo json_encode([
                'message' => 'Nome da banda em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['email_contact']) == 0):
            echo json_encode([
                'message' => 'E-mail de contato em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        // card 1
        elseif(strlen($_POST['cardTitle1']) == 0):
            echo json_encode([
                'message' => 'Título do Card 1 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardSubTitle1']) == 0):
            echo json_encode([
                'message' => 'Sub-Título do Card 1 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardText1']) == 0):
            echo json_encode([
                'message' => 'Texto do Card 1 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        // card 2
        elseif(strlen($_POST['cardTitle2']) == 0):
            echo json_encode([
                'message' => 'Título do Card 2 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardSubTitle2']) == 0):
            echo json_encode([
                'message' => 'Sub-Título do Card 2 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardText2']) == 0):
            echo json_encode([
                'message' => 'Texto do Card 2 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        // card 3
        elseif(strlen($_POST['cardTitle3']) == 0):
            echo json_encode([
                'message' => 'Título do Card 3 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardSubTitle3']) == 0):
            echo json_encode([
                'message' => 'Sub-Título do Card 3 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['cardText3']) == 0):
            echo json_encode([
                'message' => 'Texto do Card 3 em Branco',
                'status' => 401,
            ]);
            http_response_code(401);


        else:
            $bandName = $_POST['band_name'];
            $emailContact = $_POST['email_contact'];
            $title = $_POST['title'];
            $text = $_POST['text'];

            $cardTitle1 = $_POST['cardTitle1'];
            $cardSubTitle1 = $_POST['cardSubTitle1'];
            $cardText1 = $_POST['cardText1'];

            $cardTitle2 = $_POST['cardTitle2'];
            $cardSubTitle2 = $_POST['cardSubTitle2'];
            $cardText2 = $_POST['cardText2'];

            $cardTitle3 = $_POST['cardTitle3'];
            $cardSubTitle3 = $_POST['cardSubTitle3'];
            $cardText3 = $_POST['cardText3'];

            //redes sociais
            $facebook = $_POST['facebook'];
            $instagram = $_POST['instagram'];
            $twitter = $_POST['twitter'];
            $youtube = $_POST['youtube'];


            $id_user = $_SESSION['id'];


            if($_FILES['logo']):

                $folder = "../../../public/src/img/logo";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                $file = "$folder/$item->logo";
                unlink($file);

                //Logo
                $logo = $_FILES['logo'];
                $fileName = $logo['name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


                // $path = $folder . "/logo." . $extension;
                $path = $folder . "/$fileName";
                $itsRight = move_uploaded_file($logo["tmp_name"], $path);
                // $sql_code = "UPDATE settings SET format_logo='{$extension}' WHERE id=1";
                $sql_code = "UPDATE settings SET logo='{$fileName}', format_logo='{$extension}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


            endif;



            if($_FILES['favico']):

                $folder = "../../../public/src/img/favico";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                $file = "$folder/$item->favico";
                unlink($file);

                //favico
                $favico = $_FILES['favico'];
                $fileName = $favico['name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $path = $folder . "/$fileName";
                $itsRight = move_uploaded_file($favico["tmp_name"], $path);
                $sql_code = "UPDATE settings SET favico='{$fileName}', format_favico='{$extension}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


            endif;

            if($_FILES['loading']):

                $folder = "../../../public/src/img/loading";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                $file = "$folder/$item->loading";
                unlink($file);

                //favico
                $loading = $_FILES['loading'];
                $fileName = $loading['name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $path = $folder . "/$fileName";
                $itsRight = move_uploaded_file($loading["tmp_name"], $path);
                $sql_code = "UPDATE settings SET loading='{$fileName}', format_loading='{$extension}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


            endif;



            if($_FILES['banner']):

                $folder = "../../../public/src/img/banner/desktop";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                // $file = "$folder/banner.$item->format";
                $file = "$folder/$item->banner";
                unlink($file);

                //Banner
                $banner = $_FILES['banner'];
                $fileName = $banner['name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));


                // $path = $folder . "/banner." . $extension;
                // $path = $folder . "/$fileName." . $extension;
                $path = $folder . "/$fileName";


                $itsRight = move_uploaded_file($banner["tmp_name"], $path);
                $sql_code = "UPDATE settings SET banner='{$fileName}', format='{$extension}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            endif;


            if($_FILES['banner_mobile']):

                $folder = "../../../public/src/img/banner/mobile";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                // $file = "$folder/banner.$item->format";
                $file = "$folder/$item->banner";
                unlink($file);

                //Banner mobile
                $bannerMobile = $_FILES['banner_mobile'];
                $fileName = $bannerMobile['name'];
                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                $path = $folder . "/$fileName";

                $itsRight = move_uploaded_file($bannerMobile["tmp_name"], $path);
                $sql_code = "UPDATE settings SET banner_mobile='{$fileName}', format_banner_mobile='{$extension}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            endif;


            if($_FILES['card_img_1']):

                $folder = "../../../public/src/img/cards/card-1";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                // $file = "$folder/banner.$item->format";
                $file = "$folder/$item->card_img_1";
                unlink($file);

                //Banner mobile
                $card_img = $_FILES['card_img_1'];
                $fileName = $card_img['name'];
                // $fileName = 'card_img_1';

                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // $fileName = 'card_img_1.'.$extension;

                $path = $folder . "/$fileName";

                $itsRight = move_uploaded_file($card_img["tmp_name"], $path);
                // $itsRight = move_uploaded_file($fileName, $path);
                $sql_code = "UPDATE settings SET card_img_1='{$fileName}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            endif;


            if($_FILES['card_img_2']):

                $folder = "../../../public/src/img/cards/card-2";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                // $file = "$folder/banner.$item->format";
                $file = "$folder/$item->card_img_2";
                unlink($file);

                //Banner mobile
                $card_img = $_FILES['card_img_2'];
                $fileName = $card_img['name'];
                // $fileName = 'card_img_2';

                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // $fileName = 'card_img_2.'.$extension;

                $path = $folder . "/$fileName";

                $itsRight = move_uploaded_file($card_img["tmp_name"], $path);
                // $itsRight = move_uploaded_file($fileName, $path);
                $sql_code = "UPDATE settings SET card_img_2='{$fileName}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            endif;


            if($_FILES['card_img_3']):

                $folder = "../../../public/src/img/cards/card-3";

                $sql_code = "SELECT * FROM settings WHERE id=1 Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $item = $sql_query->fetch_object();
                // $file = "$folder/banner.$item->format";
                $file = "$folder/$item->card_img_3";
                unlink($file);

                //Banner mobile
                $card_img = $_FILES['card_img_3'];
                $fileName = $card_img['name'];
                // $fileName = 'card_img_3';

                $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                // $fileName = 'card_img_3.'.$extension;

                $path = $folder . "/$fileName";

                $itsRight = move_uploaded_file($card_img["tmp_name"], $path);
                // $itsRight = move_uploaded_file($fileName, $path);
                $sql_code = "UPDATE settings SET card_img_3='{$fileName}' WHERE id=1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            endif;

            
            $sql_code = "UPDATE settings SET band_name='{$bandName}', email_contact='{$emailContact}', intro_title='{$title}', intro_text='{$text}', 
            card_title_1='{$cardTitle1}', card_sub_title_1='{$cardSubTitle1}', card_text_1='{$cardText1}',
            card_title_2='{$cardTitle2}', card_sub_title_2='{$cardSubTitle2}', card_text_2='{$cardText2}',
            card_title_3='{$cardTitle3}', card_sub_title_3='{$cardSubTitle3}', card_text_3='{$cardText3}',
            facebook='{$facebook}', instagram='{$instagram}', twitter='{$twitter}', youtube='{$youtube}'
            WHERE id=1";

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            http_response_code(200);
            echo json_encode([
                'message' => 'Configurações atualizadas com sucesso!',
                'status' => 200,
            ]);

        endif;
    endif;