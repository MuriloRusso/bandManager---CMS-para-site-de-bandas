<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>SMTP</title>
    <?php include('public/includes/head.php');?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    
    <section>
        <div class="container py-5">
            <div id="alert-container"></div>
            <h2 class="font-title">SMTP</h2>
            <form>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="host" id="host" placeholder="Host:" required>
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="port" id="port" placeholder="Porta:" required>
                </div>
                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="secure" id="secure" placeholder="Secure:" required>
                </div>

                <div class="form-group col-md-3 col-12 my-3">
                    <input type="text" name="auth" id="auth" placeholder="Auth:" required>
                </div>

                <div class="form-group col-md-3 col-12 my-3">
                    <input type="email" name="email" id="email" placeholder="E-mail:" required>
                </div>

                <div class="form-group col-md-3 col-12 my-3">
                    <input type="password" name="password" id="password" placeholder="Senha:" required>
                </div>
                <div>
                    <button class="btn-primary" type="submit" id="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </section> 
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/adm/smtp/functions.js?v2"></script>
    <script src="./public/src/js/alert.js"></script>
</body>
</html>