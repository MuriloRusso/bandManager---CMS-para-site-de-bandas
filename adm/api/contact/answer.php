<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    include('../../../public/includes/connect.php');
    include('../cors.php');
    include('../../../public/includes/protect.php');
    if(isset($_POST['title']) || isset($_POST['text']) || isset($_POST['email']) || isset($_POST['name'])):
        if(strlen($_POST['title']) == 0):
            echo json_encode([
                'message' => 'Assunto em branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['text']) == 0):
            echo json_encode([
                'message' => 'Corpo em branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['email']) == 0):
            echo json_encode([
                'message' => 'E-mail em branco',
                'status' => 401,
            ]);
            http_response_code(401);
        elseif(strlen($_POST['name']) == 0):
            echo json_encode([
                'message' => 'Nome em branco',
                'status' => 401,
            ]);
            http_response_code(401);

        else:
            $assunto = $_POST['title'];
            $corpo = $_POST['text'];
            $email = $_POST['email'];
            $name = $_POST['name'];


            $sql_code = "SELECT * from settings";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            $settings = $sql_query->fetch_object();

            /*

            $sql_code = "INSERT INTO contact (name, email, telephone, message) VALUES ('{$name}', '{$email}', '{$telephone}', '{$msg}')";
            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
            */

            // envio do email

            date_default_timezone_set('America/Sao_Paulo');
            $data_envio = date('Y-m-d');
            $hora_envio = date('H:i:s');

            require '../../../PHPMailer/PHPMailer-master/src/Exception.php';
            require '../../../PHPMailer/PHPMailer-master/src/PHPMailer.php';
            require '../../../PHPMailer/PHPMailer-master/src/SMTP.php';

            $mail = new PHPMailer();
            $mail->isSMTP();

            include('../smtp.php');

            $mail->setFrom($mail->Username, $settings->band_name);
            $mail->addReplyTo($email, $name);
            $mail->addAddress($email, $name);
            $mail->Subject = $assunto;
            $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';
            $mail->isHTML(true);
            $mailContent = $corpo;
            $mailContent = utf8_decode($mailContent);
            $mail->Body = $mailContent;
            if($mail->send()):
                http_response_code(200);
                echo json_encode([
                    'error' => $mysqli->error,
                    'message' => 'Mensagem enviada com sucesso!',
                    'status' => 200, 
                ]);            
            else:
                http_response_code(200);
                echo json_encode([
                    'error' => $mysqli->error,
                    'message' => 'Mensagem armazenada com sucesso, porém e-mail não foi enviado, mas fique tranquilo, nossa equipe receberá a mensagem da mesma forma!',
                    'status' => 200,
                ]);
            endif;
        endif;
    endif;