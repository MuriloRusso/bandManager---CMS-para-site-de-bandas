<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Membros</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/gallery.css">
    <link rel="stylesheet" href="./css/contact.css">

</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section style="background-image: url('./public/src/img/bgs/bg-3.jpg');" class="background">
        <div class="col-12 overlay">
            <div class="container py-5" style="min-height: 80vh;">
                <div id="alert-container"></div>
                <h2 class="font-title">Membros</h2>
                <?php if(isset($_SESSION['id'])): ?>
                    <a href="#" class="btn-primary open-modal-new">+ Novo Membro</a>
                <?php endif; ?>
                <div class="col-md-8 col-12" id="list"></div>
            </div>
        </div>
    </section>

    <?php if(isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Novo Membro(a)</h2>
                <form enctype="multipart/form-data">
                    <div class="form-group col-12 my-3">
                        <input type="text" name="title" id="title" placeholder="Nome:" required>
                    </div>
                    <div class="form-group">
                        <label  for="upload" class="upload">
                            <span class="upload-image">	</span>
                        </label>
                        <input name="file" type="file" accept="image/*" id="upload" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="functionMember" id="functionMember" placeholder="Função:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="date" name="date_inclusion" id="date_inclusion" placeholder="Date de início:" required>
                        <small class="color-white">Selecione acima a data que o membro entrou para a banda.</small>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="text" id="text" placeholder="Introdução do Membro:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Incluír Membro</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Membro</h2>
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
                        <input type="text" name="functionMemberEdit" id="functionMemberEdit" placeholder="Função:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="date" name="date_inclusion_edit" id="date_inclusion_edit" placeholder="Date de início:" required>
                        <small class="color-white">Selecione acima a data que o membro entrou para a banda.</small>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="textEdit" id="textEdit" placeholder="Texto da Postagem:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-edit">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Atualizar Membro</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Membro</h2>
                <form>
                    <p class="color-white m-0">Tem certeza que gostaria de excluír esse membro?</p>
                    <input type="hidden" name="idDelete" id="idDelete" require>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit" onclick="deleteMember('members')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/upload-img.js?v2"></script>
    <script src="./public/src/js/members/functions.js?v13"></script>

</body>
</html>