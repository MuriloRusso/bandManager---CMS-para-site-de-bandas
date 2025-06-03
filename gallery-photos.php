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
            <div class="container py-5" style="min-height: 80vh;">
                <div id="alert-container"></div>
    
                <?php
                    include('public/includes/connect.php');
                    $id = $_GET['id'];
                    $sql_code = "SELECT * FROM gallery WHERE id=$id";
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                    $quantidade = $sql_query->num_rows;
                ?>
    
                <h2 class="font-title">
                    <a href="gallery.php" class="text-decoration-none color-white">
                        Galeria
                    </a>
                    > 
                    <?php
                        if($quantidade === 0):
                            echo 'Galeria não encontrada!';
                        else:
                            $gallery = $sql_query->fetch_object();
                            echo $gallery->title;
                        endif;
                    ?>
                </h2>
    
                <?php if(isset($_SESSION['id'])): ?>
                    <div class="py-3">
                        <a href="#" class="btn-primary open-modal-new">+ Nova Foto</a>
                    </div>
                <?php endif; ?>
                <div class="d-flex flex-wrap justify-content-between" id="list"></div>
            </div>
        </div>
    </section>

    <!-- modal Gallery item -->
    <div class="modal modal-gallery-item">
        <div class="container py-5 col-md-6 col-12 text-center">
            <img src="" alt="image">
            <div class="py-3">
                <a class="btn-primary close-modal-gallery-item">Fechar</a>
            </div>
        </div>
    </div>

    <?php if(isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Nova Foto</h2>
                <form enctype="multipart/form-data">
                    <input type="hidden" name="id_gallery" id="id_gallery" require value="<?php echo $gallery->id; ?>">
                    <div class="form-group">
                        <label  for="upload" class="upload">
                            <span class="upload-image">	</span>
                        </label>
                        <input name="file" type="file" accept="image/*" id="upload">
                    </div>
                    <div class="py-3">
                        <a class="btn-primary close-modal-new">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="newPhoto()">Incluír Foto</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Foto</h2>
                <form enctype="multipart/form-data">
                    <p class="color-white m-0">Tem certeza que gostaria de excluír essa Foto?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deletePhoto('gallery-photos')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/upload-img.js?v2"></script>
    <script src="./public/src/js/gallery-photos/functions.js?v7"></script>
</body>
</html>