<?php

    include('../../public/includes/connect.php');
    include('cors.php');
    if(isset($_POST['username']) || isset($_POST['password'])):
        if(strlen($_POST['username']) == 0):
            // echo "Nome de usuário em Branco";
            echo json_encode([
                'message' => 'Nome de usuário em Branco', 
                'status' => 401, 
            ]);
            http_response_code(401);
        elseif(strlen($_POST['password']) == 0):
            // echo "Preencha o campo Senha";
            echo json_encode([
                'message' => 'Preencha o campo Senha', 
                'status' => 401, 
            ]);
            http_response_code(401);
        else:
            $user = $_POST['username'];
            $senha = md5($_POST['password']);

            $sql_code = "SELECT * FROM cad_user WHERE username = '$user' AND password = '$senha'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
            if($quantidade == 1):
                $usuario = $sql_query->fetch_assoc();
                if(!isset($_SESSION)):
                    session_start();
                endif;
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['name'] = $usuario['name'];
                $_SESSION['username'] = $usuario['username'];
                $_SESSION['email'] = $usuario['email'];
        
                http_response_code(200);
                echo json_encode([
                    'message' => 'Login realizado com sucesso!', 
                    'status' => 200, 
                ]);
            else:
                // echo "Falha ao Logar, email ou senha incorretos!";
                echo json_encode([
                    'message' => 'Falha ao Logar, email ou senha incorretos!', 
                    'status' => 401, 
                ]);
                http_response_code(401);
            endif;
        endif;
    endif;