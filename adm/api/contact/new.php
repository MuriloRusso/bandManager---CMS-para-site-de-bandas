<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('../../../public/includes/connect.php');
    include('../cors.php');
    if(isset($_POST['name']) || isset($_POST['email']) || isset($_POST['telephone']) || isset($_POST['msg'])):
        
        $sql_code = "SELECT * from settings";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
        $settings = $sql_query->fetch_object();

        if(strlen($_POST['name']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Nome',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['email']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo E-mail',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['telephone']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Telefone',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['msg']) == 0):
            echo json_encode([
                'message' => 'Preencha o campo Messagem',
                'status' => 401,
            ]);
            http_response_code(401);
        else:
            $name = $_POST['name'];
            $email = $_POST['email'];
            $telephone = $_POST['telephone'];
            $msg = $_POST['msg'];

            $sql_code = "INSERT INTO contact (name, email, telephone, message) VALUES ('{$name}', '{$email}', '{$telephone}', '{$msg}')";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);

            // envio do email

            if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip = filter_var($_SERVER['HTTP_X_FORWARDED_FOR']);
            } else {
                $ip = filter_var($_SERVER['REMOTE_ADDR']);
            }

            require '../../../PHPMailer/PHPMailer-master/src/Exception.php';
            require '../../../PHPMailer/PHPMailer-master/src/PHPMailer.php';
            require '../../../PHPMailer/PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer();
            $mail->isSMTP();

            include('../smtp.php');

            $mail->setFrom($mail->Username, $name);
            $mail->addReplyTo($email, $name);
            // $mail->addAddress($settings->email_contact, $settings->band_name);
            $mail->CharSet = 'UTF-8'; // Ensure the character set is set to UTF-8
            $mail->addAddress(utf8_encode($settings->email_contact), utf8_encode($settings->band_name));

            $mail->Subject = 'Contato Via Site';
            $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';
            $mail->isHTML(true);
            $mailContent = "
                <strong>Nome: </strong> $name<br>
                <strong>E-mail: </strong> $email<br>
                <strong>Telefone: </strong> $telephone<br>
                $msg<br><br>

            ";
            $mailContent = utf8_decode($mailContent);
            $mail->Body = $mailContent;
            if($mail->send()){        
                http_response_code(200);
                echo json_encode([
                    'message' => 'Mensagem enviada com sucesso!',
                    'status' => 200, 
                ]);
            }    
            else{
                http_response_code(200);
                echo json_encode([
                    'message' => 'Mensagem armazenada com sucesso, porém e-mail não foi enviado, mas fique tranquilo, nossa equipe receberá a mensagem da mesma forma!',
                    'status' => 200, 
                ]);
            }                        
        endif;
    endif;