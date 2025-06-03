<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Fale Conosco</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section style="min-height: 75vh;">
        <div class="container py-5">
            <div id="alert-container"></div>
            <?php if(!isset($_SESSION['id'])): ?>
                <h2 class="font-title">Fale Conosco</h2>
                <form class="d-flex flex-wrap justify-content-between">
                    <div class="form-group col-md-3 col-12 my-3">
                        <input type="text" name="name" placeholder="Nome:" require>
                    </div>
                    <div class="form-group col-md-3 col-12 my-3">
                        <input type="text" name="email" placeholder="E-mail:" require>
                    </div>
                    <div class="form-group col-md-3 col-12 my-3">
                        <input type="text" name="phone" placeholder="Telefone:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="msg" id="msg" placeholder="Mensagem:"></textarea>
                    </div>
                    <div>
                        <button class="btn-primary" id="clean" type="reset">Limpar</button>
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submit">Enviar</button>
                    </div>
                </form>
            <?php else: ?>
                <h2 class="font-title">Contatos</h2>

                <?php
                    include('public/includes/connect.php');
                    $sql_code = "SELECT * FROM contact Order by created Desc";
                    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                    $quantidade = $sql_query->num_rows;

                    if($quantidade === 0):
                        print '<p class="color-white">Sem Contatos por enquanto!</p>';
                    endif;
                    while($contatct = $sql_query->fetch_object()):
                    // formatar data para brasileiro
                    $timestamp = strtotime($contatct->created);
                    $dataFormatada = date('d/m/Y', $timestamp);
                ?>
                    <div class="contact my-5">
                        <p class="date mb-0 color-gray"><?php echo $dataFormatada ?></p>
                        <?php if($contatct->view == 0): ?>
                            <h2 class="text-uppercase py-2 mb-0 color-white fst-italic"><?php echo $contatct->name ?></h2>
                        <?php else: ?>
                            <h2 class="text-uppercase py-2 mb-0 color-white"><?php echo $contatct->name ?></h2>
                        <?php endif; ?>
                        <p class="mb-0 color-white pb-3"><?php echo $contatct->email ?></p>
                        <div class="py-1 d-flex">
                            <a href="#" class="btn-primary btn-view" title="Ver Mensagem" onclick="openView(<?php echo $contatct->id ?>)">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="#" class="btn-primary btn-answer mx-2" title="Responder" onclick="openAnswer(<?php echo $contatct->id ?>)">
                                <i class="fa-solid fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </section>
    <?php if(isset($_SESSION['id'])):?>
        <!-- modal View -->
        <div class="modal modal-view">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Contato</h2>
                <p class="date mb-0 color-gray" id="date"></p>
                <h3 id="name" class="color-white"></h3>
                <p class="color-white m-0">E-mail:</p>
                <p id="email" class="color-white"></p>
                <p class="color-white m-0">Telefone:</p>
                <p id="telefone" class="color-white"></p>
                <p class="color-white m-0">Mensagem:</p>
                <p id="msg" class="color-white"></p>
                <div class="py-3 d-flex">
                    <a class="btn-primary-reverse close-modal-view">Fechar</a>
                    <a href="#" class="btn-primary btn-answer" title="Responder">
                        <i class="fa-solid fa-envelope"></i>
                    </a>
                </div>
            </div>
        </div>
        <!-- modal Answaer -->
        <div class="modal modal-answer">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Responder</h2>
                <form>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="title" id="title" placeholder="Assunto:" require>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="text" id="text" placeholder="Corpo:"></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-answer">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif;?>
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/contact.js?v1"></script>
    <script src="./public/src/js/alert.js?4"></script>
    <script src="./public/src/js/adm/contact/functions.js?v4"></script>    
</body>
</html>