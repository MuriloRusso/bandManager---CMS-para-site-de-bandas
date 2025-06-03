<?php
    include('connect.php');
    $sql_code = "SELECT * FROM settings WHERE id=1 limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $settings = $sql_query->fetch_object();
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<!--links redes sociais -->	
<meta property="og:type" content="website" />		
<meta property="og:title" content="<?php echo $settings->band_name;?>" />		
<meta property="og:description" content="<?php echo $settings->intro_text;?>" />
<meta property="og:image" itemprop="image" content="./public/src/img/banner/desktop/<?php echo $settings->banner;?>" />

<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:locale" content="pt_BR" />
<meta property="og:url" content="https://murilorusso.com.br/" />

<meta name="description" content="<?php echo $settings->intro_text;?>">
<meta name="author" content="Murilo Russo">



<!-- css -->
<link rel="stylesheet" href="./css/style.css?v5">
<link rel="stylesheet" href="./css/btn.css?v6">
<link rel="stylesheet" href="./css/modal.css?v3">
<link rel="stylesheet" href="./css/loading.css?v2">
<link rel="stylesheet" href="./css/alert.css?2">
<link rel="stylesheet" href="./css/menu.css?v4">
<link rel="stylesheet" href="./css/midias.css?v3">
<link rel="stylesheet" href="./css/contact.css?v2">
<link rel="stylesheet" href="./css/footer.css?v2">

<!-- favico -->
<link rel="icon" type="image/x-icon" href="./public/src/img/favico/<?php echo $settings->favico;?>" alt="Logo <?php echo $settings->band_name;?>">


<!-- bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<!-- fontes -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script:wght@400;700&family=Playwrite+ES+Deco:wght@100..400&display=swap" rel="stylesheet">

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- animate on scroll -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

          
<?php session_start(); ?>