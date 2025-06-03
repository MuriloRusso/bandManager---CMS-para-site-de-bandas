<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Blog</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/blog.css?3">


    <!-- <script src="https://cdn.ckeditor.com/4.4.5.1-lts/standard/ckeditor.js"></script> -->
    <script src="ckeditor-full/ckeditor.js"></script>


</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section style="background-image: url('./public/src/img/bgs/bg-3.jpg');" class="background">
        <div class="overlay">
            <div class="container py-5" style="min-height: 75vh;">
                <div id="alert-container"></div>
                <h2 class="font-title">Blog</h2>
                <?php if(isset($_SESSION['id'])): ?>
                    <a href="#" class="btn-primary open-modal-new">+ Novo Post</a>
                <?php endif; ?>
                <div id="list"></div>
            </div>
        </div>
    </section>

    <?php if(isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Novo Post</h2>
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
                        <textarea name="text" id="text" placeholder="Texto da Postagem:" class="ckeditor" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submit">Criar Postagem</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Postagem</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" required>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="titleEdit" id="titleEdit" placeholder="Titulo:" required>
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
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submitEdit">Atualizar Postagem</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Post</h2>
                <form enctype="multipart/form-data">
                    <p class="color-white m-0">Tem certeza que gostaria de excluír esse post?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deletePost('blog')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/upload-img.js?v2"></script>
    <script src="./public/src/js/blog/functions.js?v11"></script>


    <!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> -->
    <script type="text/javascript">
        //bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); // convert all text areas to rich text editor on that page

        /*bkLib.onDomLoaded(function() {
            new nicEditor().panelInstance('text');
            document.getElementById('text').style.width = '500px';

        }); */// convert text area with id area1 to rich text editor.
/*
        bkLib.onDomLoaded(function() {
             new nicEditor({fullPanel : true}).panelInstance('area2');
        }); // convert text area with id area2 to rich text editor with full panel.
        */
    </script>



    <!-- Bootstrap-WYSIWYG -->
    <!-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->


   <!-- Place the first <script> tag in your HTML's <head> -->
    <!-- <script src="https://cdn.tiny.cloud/1/u5w7ofm79s7ufqmgyd3wmq321zqnr4y624wypyhs9d1crecr/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> -->

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    // tinymce.init({
    //     selector: 'textarea#text',
    //     plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount linkchecker',
    //     toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    // });
    </script>

    <script>
        // CKEDITOR.replace( 'text' );
    </script>

</body>
</html>