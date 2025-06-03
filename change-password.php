<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Redefinir Senha</title>
    <?php include('public/includes/head.php'); include('public/includes/protect.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    
    <section>
        <div class="container py-5">
            <div id="alert-container"></div>
            <?php
                include('public/includes/connect.php');
                $idUser = $_SESSION['id'];
                $sql_code = "SELECT * FROM cad_user WHERE id=$idUser limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $quantidade = $sql_query->num_rows;

                $user = $sql_query->fetch_object();
            ?>
            <h2 class="font-title">Redefina sua senha abaixo</h2>
            <form>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="password" name="password" id="password" placeholder="Senha Atual:" required>
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="password" name="new-password" id="new-password" placeholder="Senha Nova:" required>
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="password" name="password-confirm" id="password-confirm" placeholder="Confirme a Senha Nova:" required>
                </div>
                <div>
                    <!-- <a class="btn-primary" type="submit" onclick="changePassword()">Alterar Senha</a> -->
                    <button class="btn-primary" type="submit">Alterar Senha</button>
                </div>
            </form>
        </div>
    </section> 
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/contact.js?10"></script>
    <script src="./public/src/js/alert.js?40001"></script>
    <script src="./public/src/js/adm/my-account/functions.js?15"></script>
</body>
</html>