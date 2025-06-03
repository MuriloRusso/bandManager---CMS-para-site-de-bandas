<?php
    include('connect.php');
    $sql_code = "SELECT * FROM settings WHERE id=1 limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $settings = $sql_query->fetch_object();
?>
<div id="loading">
    <img src="./public/src/img/loading/<?php echo $settings->loading;?>" alt="Carregando...">
</div>