<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Galeria</title>
    <?php include('./public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<?php
    if(isset($_SESSION['id'])):
        header('Location: index.php');
    endif;
?>
<body>
    <?php include('./public/includes/header.php'); ?>
    <section>
        <div class="container py-5 d-flex flex-column align-items-center justify-content-center" style="min-height: 70vh;">
            <div id="alert-container" class="col-12"></div>

            <h2 class="font-title">Login</h2>
            <?php
                include('connect.php');
                $sql_code = "SELECT * FROM settings Limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $settings = $sql_query->fetch_object();
            ?>
            <img id="logo" src="./public/src/img/logo/<?php echo $settings->logo;?>" style="max-width: 300px;" alt="<?php echo $settings->band_name;?>">

            <form class="col-md-4 col-10" id="login-form">
                <div class="form-group col-12 my-3">
                    <input type="text" name="username" id="username" placeholder="Username:" require>
                </div>
                <div class="form-group col-12 my-3">
                    <input type="password" name="password" id="password" placeholder="Senha:" require>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn-primary">Entrar</button>
                </div>
            </form>
        </div>
    </section>
    <?php include('./public/includes/footer.php'); ?>
    <script src="./public/src/js/login/functions.js"></script>
</body>
</html>