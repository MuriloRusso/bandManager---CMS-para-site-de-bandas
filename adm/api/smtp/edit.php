<?php

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['host']) || isset($_POST['port']) || isset($_POST['secure']) || isset($_POST['auth']) || isset($_POST['email']) || isset($_POST['password'])):
        if(strlen($_POST['host']) == 0):
            echo json_encode([
                'message' => 'Host em Branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['port']) == 0):
            echo json_encode([
                'message' => 'Porta em branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['secure']) == 0):
            echo json_encode([
                'message' => 'Secure em branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['auth']) == 0):
            echo json_encode([
                'message' => 'Autorização em branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['email']) == 0):
            echo json_encode([
                'message' => 'E-mail  em branco',
                'status' => 401,
            ]);
            http_response_code(401);

        elseif(strlen($_POST['password']) == 0):
            echo json_encode([
                'message' => 'Senha em braco',
                'status' => 401,
            ]);
            http_response_code(401);



        else:
            $host = $_POST['host'];
            $port = $_POST['port'];
            $secure = $_POST['secure'];
            $auth = $_POST['auth'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql_code = "UPDATE smtp SET host='{$host}', port='{$port}', secure='{$secure}', auth='{$auth}', email='{$email}', password='{$password}' WHERE id=1";

            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            http_response_code(200);
            echo json_encode([
                'message' => 'Dados de SMTP atualizados com sucesso!',
                'status' => 200, 
            ]);

        endif;
    endif;