<?php

    include('../../public/includes/connect.php');
    $sql_code = "SELECT * FROM smtp Limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $smtp = $sql_query->fetch_object();

    $mail->Host = $smtp->host;
    $mail->Port = $smtp->port;
    $mail->SMTPSecure = $smtp->secure;
    $mail->SMTPAuth = $smtp->auth;
    $mail->Username = $smtp->email;
    $mail->Password = $smtp->password;
?>