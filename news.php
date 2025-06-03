<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Notícias</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/gallery.css">
    <link rel="stylesheet" href="./css/contact.css">

</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section class="background" style="background-image: url('./public/src/img/bgs/bg-3.jpg');">
        <div class="overlay">
            <div class="container py-5" style="min-height: 80vh;">
                <div id="alert-container"></div>            
                <h2 class="font-title">Notícias</h2>
                <?php if(isset($_SESSION['id'])):?>
                    <a href="#" class="btn-primary open-modal-new">+ Nova Notícia</a>
                <?php endif;?>
                <div id="list"></div>
            </div>
        </div>
    </section>
    <?php if(isset($_SESSION['id'])):?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Nova Notícia</h2>
                <form>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="title" id="title" placeholder="Titulo:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="text" id="text" placeholder="Texto da Notícia:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Criar Notícia</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Notícia</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" required>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="titleEdit" id="titleEdit" placeholder="Titulo:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="textEdit" id="textEdit" placeholder="Texto da Notícia:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-edit">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Atualizar Notícia</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Notícia</h2>
                <form>
                    <p class="color-white m-0">Tem certeza que gostaria de excluír essa notícia?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deleteNew('news')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif;?>
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/news/functions.js?v7"></script>
</body>
</html>