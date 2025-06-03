<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Galeria</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/gallery.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section style="background-image: url('./public/src/img/bgs/bg-3.jpg');" class="background">
        <div class="overlay">
            <div class="container py-5" style="min-height: 75vh;">
                <div id="alert-container"></div>
                <h2 class="font-title">Galeria</h2>
                <?php if(isset($_SESSION['id'])):?>
                        <a href="#" class="btn-primary open-modal-new">+ Nova Galeria</a>
                <?php endif;?>
                <div class="d-flex flex-wrap justify-content-between" id="list"></div>
            </div>
        </div>
    </section>
    <?php if(isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Nova Galeria</h2>
                <form enctype="multipart/form-data">
                    <div class="form-group col-12 my-3">
                        <input type="text" name="title" id="title" placeholder="Titulo:" required>
                    </div>
                    <div class="form-group">
                        <label  for="upload" class="upload">
                            <span class="upload-image">	</span>
                        </label>
                        <input name="file" type="file" accept="image/*" id="upload" required>
                    </div>

                    <div class="form-group col-12 my-3">
                        <textarea name="text" id="text" placeholder="Texto da Postagem:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Criar Galeria</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Galeria</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" required>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="titleEdit" id="titleEdit" placeholder="Titulo:" require>
                    </div>
                    <div class="form-group">
                        <label  for="uploadEdit" class="uploadEdit upload">
                            <span class="upload-image upload-image-edit">
                                <img src="" alt="" class="img-atual">
                            </span>
                        </label>
                        <input name="fileEdit" type="file" accept="image/*" id="uploadEdit">
                    </div>

                    <div class="form-group col-12 my-3">
                        <textarea name="textEdit" id="textEdit" placeholder="Texto da Postagem:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-edit">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submitEdit">Atualizar Galeria</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Galeria</h2>
                <form enctype="multipart/form-data">
                    <p class="color-white m-0">Tem certeza que gostaria de excluír essa Galeria?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deleteGallery('gallery')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/upload-img.js?v2"></script>
    <script src="./public/src/js/gallery/functions.js?v7"></script>
</body>
</html>