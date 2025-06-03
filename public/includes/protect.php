<?php
	if(!isset($_SESSION)):
		session_start();
	endif;
	if(!isset($_SESSION['id'])):
		header("Location: ../../index.php");
		die("Você não está logado");
    endif;
?>