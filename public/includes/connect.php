<?php 
	// error_reporting(0);
	$user = 'root';
	$password = '';
	$database = 'band';
	$host = 'localhost';	

	$mysqli = new mysqli($host, $user, $password, $database);
	$mysqli->set_charset("utf8");
	if($mysqli->error):
		die('Falha ao conectar ao banco de dados');
	endif;
    session_start();
?>