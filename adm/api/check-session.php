<?php
	if(!isset($_SESSION)):
		session_start();
	endif;
	if(isset($_SESSION['id'])):
        http_response_code(200);
        echo json_encode([
            'session' => true,
            'id' => $_SESSION['id'],
            'name' => $_SESSION['name'],
            'username' => $_SESSION['username'],
            'email' => $_SESSION['email'],
            'status' => 200,
        ]);
    else:
        http_response_code(200);
        echo json_encode([
            'session' => false,
            'status' => 200,
        ]);
    endif;
?>