<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Galeria</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/gallery.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section>
        <div class="container py-5" style="min-height: 80vh;">
            <?php
                include('public/includes/connect.php');
                $id = $_GET['id'];
                $sql_code = "SELECT * FROM gallery WHERE id=$id";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $quantidade = $sql_query->num_rows;
            ?>
            <a href="gallery.php" class="text-decoration-none">
                <h2 class="font-title">
                    <?php
                        if($quantidade === 0):
                            echo 'Galeria não encontrada!';
                        else:
                            $gallery = $sql_query->fetch_object();
                            echo $gallery->title;
                        endif;                
                    ?>
                </h2>
            </a>
            <?php
                if(isset($_SESSION['id'])):
            ?>
                    <div class="py-3">
                        <a href="#" class="btn-primary open-modal-new">+ Nova Foto</a>
                    </div>
            <?php
                endif;
            ?>
            <div class="d-flex flex-wrap justify-content-between">
                
            </div>
        </div>
    </section>


    <?php
        if(isset($_SESSION['id'])):
    ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Nova Foto</h2>
                <form enctype="multipart/form-data">
                    <div class="form-group">
                        <label  for="upload" class="upload">
                            <span class="upload-image">	</span>
                        </label>
                        <input name="file" type="file" accept="image/*" id="upload">
                    </div>
                    <div>
                        <a class="btn-primary close-modal-new">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="newGallery()">Incluír Foto</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Foto</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" require>
                    <div class="form-group">
                        <label  for="uploadEdit" class="uploadEdit upload">
                            <span class="upload-image upload-image-edit">
                                <img src="" alt="" class="img-atual">
                            </span>
                        </label>
                        <input name="fileEdit" type="file" accept="image/*" id="uploadEdit">
                    </div>
                    <div>
                        <a class="btn-primary close-modal-edit">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submitEdit" onclick="editGallery()">Atualizar Galeria</a>
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
                        <a class="btn-primary close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deleteItem('gallery-photos')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php
        endif;
    ?>

    <script src="./public/src/js/upload-img.js?8"></script>
    <script src="./public/src/js/gallery-photos/modal.js?888"></script>

    <?php
        if(isset($_GET['alert'])){
            if($_GET['alert'] === 'new'){
                print '<script>createAlert("alert-success", "Foto criada com sucesso!")</script>';
            }
            if($_GET['alert'] === 'edit'){
                print '<script>createAlert("alert-success", "Foto Atualizada com sucesso!")</script>';
            }
            if($_GET['alert'] === 'delete'){
                print '<script>createAlert("alert-danger", "Foto excluída com sucesso!")</script>';
            }
        }
    ?>

    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/contact.js"></script>
</body>
</html>