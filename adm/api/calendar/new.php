<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['tipo']) || isset($_POST['local']) || isset($_POST['dateCalendar']) || isset($_POST['address'])):
        if(strlen($_POST['tipo']) == 0):
            echo json_encode([
                'message' => 'Tipo do evento em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['local']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Local do evento',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['dateCalendar']) == 0):
            echo json_encode([
                'message' => 'Data do evento em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['address']) == 0):
            echo json_encode([
                'message' => 'Endereço do evento em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $tipo = $_POST['tipo'];
            $local = $_POST['local'];
            $dateCalendar = $_POST['dateCalendar'];
            $address = $_POST['address'];
            $id_user = $_SESSION['id'];
            //$id_user = 1;
            $sql_code = "INSERT INTO calendar (id_event, local_name, date_calendar, address, user_created) VALUES ('{$tipo}', '{$local}', '{$dateCalendar}', '{$address}', '{$id_user}')";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Evento adicionado com sucesso!',
                'status' => 200, 
            ]);
        endif;
    endif;