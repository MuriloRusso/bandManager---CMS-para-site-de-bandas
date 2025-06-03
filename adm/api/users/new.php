<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['name']) || isset($_POST['username']) || isset($_POST['email']) || isset($_POST['password'])):

        $sql_code = "SELECT * FROM settings Limit 1";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $settings = $sql_query->fetch_object();

        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $passwordMd5 = md5($_POST['password']);

        function hasSpacesOrSpecialChars($string) {
            // Expressão regular para verificar espaços ou caracteres especiais
            return preg_match('/[\s\W]/', $string);
        }

        if(strlen($_POST['name']) == 0):
            echo json_encode([
                'message' => 'Nome em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(hasSpacesOrSpecialChars($_POST['username'])):
            echo json_encode([
                'message' => 'Não são permitidos espaços ou caracteres especiais no nome de usuário',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['username']) == 0):
            echo json_encode([
                'message' => 'Nome de Usuário em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['email']) == 0):
            echo json_encode([
                'message' => 'E-mail em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['password']) == 0):
            echo json_encode([
                'message' => 'Senha em Branco',
                'status' => 401,
            ]);
            return http_response_code(401);
        elseif(strlen($_POST['password']) < 6):
            echo json_encode([
                'message' => 'Senha muito curta',
                'status' => 401,
            ]);
            return http_response_code(401);
        else:
            $sql_code = "SELECT * FROM cad_user WHERE username='$username'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse nome de usuário',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;

            $sql_code = "SELECT * FROM cad_user WHERE email='$email'";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse e-mail',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;


            $sql_code = "INSERT INTO cad_user (name, username, email, password) VALUES ('{$name}', '{$username}', '{$email}', '{$passwordMd5}')";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;


            require '../../../PHPMailer/PHPMailer-master/src/Exception.php';
            require '../../../PHPMailer/PHPMailer-master/src/PHPMailer.php';
            require '../../../PHPMailer/PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer();
            $mail->isSMTP();

            include('../smtp.php');

            $mail->setFrom($mail->Username, $settings->band_name);

            $remetenteName = '=?UTF-8?B?'.base64_encode($settings->band_name).'?=';
            $mail->addReplyTo($settings->email_contact, $remetenteName);

            $mail->addAddress($email, $name);
            $mail->Subject = "Seus Dados de Acesso - $settings->band_name";
            $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';
            $mail->isHTML(true);
            $mailContent = "
                Foi criado um acesso de administrador com seu e-mail no site da banda $settings->band_name.<br><br>
                
                Abaixo os dados de acesso para acessar a plataforma:<br>

                Usuário: $username<br>
                Senha: $password
                
            ";
            $mailContent = utf8_decode($mailContent);
            $mail->Body = $mailContent;
            if($mail->send()):
                http_response_code(200);
                echo json_encode([
                    'error' => $mysqli->error,
                    'message' => 'Usuário adicionado(a) com sucesso!',
                    'status' => 200, 
                ]);
            else:            
                http_response_code(200);
                echo json_encode([
                    'message' => 'Usuário adicionado(a) com sucesso, porém, o e-mail com os dados de acesso não foi enviado!',
                    'status' => 200, 
                ]);
            endif;
        endif;
    endif;