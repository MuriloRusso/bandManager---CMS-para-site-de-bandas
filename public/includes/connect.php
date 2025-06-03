<?php 
	// error_reporting(0);
	$user = 'u103987529_bandUser';
	$password = 'Teste234234*';
	$database = 'u103987529_band';
	$host = 'srv1311.hstgr.io';	

	$mysqli = new mysqli($host, $user, $password, $database);
	$mysqli->set_charset("utf8");
	if($mysqli->error):
		die('Falha ao conectar ao banco de dados');
	endif;
    session_start();
?>