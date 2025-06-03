<?php

    include('../../../../public/includes/connect.php');
    include('../../cors.php');
    include('../../../../public/includes/protect.php');
    if(isset($_POST['password']) || isset($_POST['new-password'])):
        $id = $_SESSION['id'];
        if(strlen($_POST['password']) == 0):
            echo json_encode([
                'message' => 'Senha em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['new-password']) == 0):
            echo json_encode([
                'message' => 'Nova Senha em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['new-password']) < 6):
            echo json_encode([
                'message' => 'Nova Senha é muito curta',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif($id != $_SESSION['id']):
            echo json_encode([
                'message' => 'Você não pode alterar a senha de outro usuário!',
                'status' => 401,
            ]);
            return http_response_code(401);
        else:

            $password = md5($_POST['password']);
            $newPassword = md5($_POST['new-password']);
            $passwordConfirm = md5($_POST['password-confirm']);

            $sql_code = "SELECT * FROM cad_user WHERE id=$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;

            $user = $sql_query->fetch_object();

            if($user->password === $password):
                $sql_code = "UPDATE cad_user SET password='{$newPassword}' WHERE id=$id";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $quantidade = $sql_query->num_rows;
                http_response_code(200);
                echo json_encode([
                    'message' => 'Senha atualizada com sucesso!',
                    'status' => 200,
                ]);
            else:
                http_response_code(401);
                echo json_encode([
                    'message' => 'Senha incorreta!',
                    'status' => 401,
                ]);
            endif;
        endif;
    endif;