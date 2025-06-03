<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Usuários</title>
    <?php include('public/includes/head.php'); include('public/includes/protect.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section>
        <div class="container py-5">
        <div id="alert-container"></div>
            <h2 class="font-title">Usuários</h2>
            <?php if(isset($_SESSION['id'])): ?>
                <a href="#" class="btn-primary open-modal-new">+ Novo Usuário</a>
            <?php endif; ?>
            <div id="list">
            </div>
        </div>
    </section>
    <?php if(isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Novo Usuário</h2>
                <form enctype="multipart/form-data">
                    <div class="form-group col-12 my-3">
                        <input type="text" name="name" id="name" placeholder="Nome:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="username" id="username" placeholder="Nome de Usuário:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="email" name="email" id="email" placeholder="E-mail:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="password" name="password" id="password" placeholder="Senha:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="password" name="password-confirm" id="password-confirm" placeholder="Confirme a Senha:" require>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Criar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Usuário</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" require>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="nameEdit" id="nameEdit" placeholder="Nome:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="usernameEdit" id="usernameEdit" placeholder="Nome de Usuário:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="email" name="emailEdit" id="emailEdit" placeholder="E-mail:" require>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-edit">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Atualizar Usuário</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Usuário</h2>
                <form>
                    <p class="color-white m-0">Tem certeza que gostaria de excluír esse usuário?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" onclick="deleteUser('users')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/users/functions.js?v2"></script>
    <script src="./public/src/js/alert.js?4"></script>
</body>
</html>