<?php include('public/includes/protect.php');?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Minha Conta</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    
    <section>
        <div class="container py-5">
            <div id="alert-container" class="col-12"></div>
            <?php
                include('public/includes/connect.php');
                $idUser = $_SESSION['id'];
                $sql_code = "SELECT * FROM cad_user WHERE id=$idUser limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $quantidade = $sql_query->num_rows;

                $user = $sql_query->fetch_object();
                // formatar data para brasileiro
                // $timestamp = strtotime($user->created);
                // $dataFormatada = date('d/m/Y', $timestamp);
            ?>
            <h2 class="font-title">Minha Conta</h2>
            <form>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="name" id="name" placeholder="Nome:" required value="<?php echo $user->name;?>">
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="username" id="username" placeholder="Nome de Usuário:" required value="<?php echo $user->username;?>">
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="email" name="email" id="email" placeholder="E-mail:" required  value="<?php echo $user->email;?>">
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <a href="change-password.php">Redefinir Senha</a>
                </div>
                <div>
                    <button class="btn-primary" type="submit" id="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </section> 
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/contact.js?10"></script>
    <script src="./public/src/js/alert.js?v1"></script>
    <script src="./public/src/js/users/my-account/functions.js?v4"></script>

</body>
</html>