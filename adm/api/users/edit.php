<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['id']) || isset($_POST['name']) || isset($_POST['username']) || isset($_POST['email'])):

        $sql_code = "SELECT * FROM settings Limit 1";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $settings = $sql_query->fetch_object();

        $id = $_POST['id'];
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql_code = "SELECT * FROM cad_user WHERE id=$id";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $user = $sql_query->fetch_object();

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
        elseif($id === $_SESSION['id']):
            http_response_code(401);
            echo json_encode([
                'message' => 'Você não pode editar o seu próprio usuário!',
                'status' => 401,
            ]);
        elseif($user->id_hierarchy == 1):
            http_response_code(401);
            echo json_encode([
                'message' => 'Você não pode editar um Administrador Master!',
                'status' => 401,
            ]);
        else:

            $sql_code = "SELECT * FROM cad_user WHERE username='$username' And id<>$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse nome de usuário',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;

            $sql_code = "SELECT * FROM cad_user WHERE email='$email' And id<>$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $quantidade = $sql_query->num_rows;
    
            if($quantidade > 0):
                echo json_encode([
                    'message' => 'Já existe um usuário com esse e-mail',
                    'status' => 401,
                ]);
                return http_response_code(401);
            endif;

            $sql_code = "UPDATE cad_user SET name='{$name}', username='{$username}', email='{$email}' WHERE id=$id";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);


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
                Os seus dados no site da banda $settings->band_name foram alterados.<br><br>
                
                Abaixo os novos dados após edição:<br>

                Usuário: $name<br>
                Nome: $username<br>
                E-mail: $email<br>

                
            ";
            $mailContent = utf8_decode($mailContent);
            $mail->Body = $mailContent;
            if($mail->send()):
                http_response_code(200);
                echo json_encode([
                    'error' => $mysqli->error,
                    'message' => 'Usuário atualizado com sucesso!',
                    'status' => 200, 
                ]);
            else:            
                http_response_code(200);
                echo json_encode([
                    'message' => 'Usuário atualizado com sucesso, porém, o e-mail com os dados de acesso não foi enviado!',
                    'status' => 200, 
                ]);
            endif;
        endif;
    endif;