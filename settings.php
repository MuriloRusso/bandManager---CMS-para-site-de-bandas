<?php include('public/includes/protect.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Configurações</title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/contact.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    
    <section>
        <div class="container py-5">
            <div id="alert-container"></div>
            <?php
                include('public/includes/connect.php');
                $idUser = $_SESSION['id'];
                $sql_code = "SELECT * FROM settings WHERE id=1 limit 1";
                $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                $settings = $sql_query->fetch_object();
            ?>
            <form enctype="multipart/form-data">
                <div>
                    <h2 class="font-title pt-5">Nome da Banda</h2>
                    <div class="form-group col-md-4 col-12 my-3">
                        <input type="text" name="band_name" id="band_name" placeholder="Digite aqui o Nome da banda:" required value="<?php echo $settings->band_name;?>">
                    </div>
                </div>
                <div>
                    <h2 class="font-title pt-5">Email de Contato</h2>
                    <div class="form-group col-md-7 col-12 my-3">
                        <small class="color-white">Preencher com e-mail que deve receber as mensagens da página de contato.</small>
                        <input type="email" name="email_contact" id="email_contact" placeholder="Digite aqui o E-mail de contato:" required value="<?php echo $settings->email_contact;?>">
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-around align-items-baseline">
                    <div class="col-12 col-md-4">
                        <h2 class="font-title">Logo</h2>
                        <div class="form-group" style="max-width: 380px;">
                            <label  for="uploadLogo" class="upload">
                                <span class="upload-image upload_logo">
                                    <img src="./public/src/img/logo/<?php echo "$settings->logo";?>" alt="" class="logo-atual">
                                </span>
                            </label>
                            <input name="logo" type="file" accept="image/*" id="uploadLogo">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <h2 class="font-title pt-5">Favicon</h2>
                        <div class="form-group" style="max-width: 380px;">
                            <label  for="uploadFavico" class="upload">
                                <span class="upload-image upload_favico">
                                    <img src="./public/src/img/favico/<?php echo "$settings->favico";?>" alt="" class="favico-atual">
                                </span>
                            </label>
                            <input name="uploadFavico" type="file" accept="image/*" id="uploadFavico">
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <h2 class="font-title pt-5">Loading</h2>
                        <div class="form-group" style="max-width: 380px;">
                            <label  for="uploadLoading" class="upload">
                                <span class="upload-image upload_loading">
                                    <img src="./public/src/img/loading/<?php echo "$settings->loading";?>" alt="" class="loading-atual">
                                </span>
                            </label>
                            <input name="uploadLoading" type="file" accept="image/*" id="uploadLoading">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-title pt-5">Banner</h2>
                        <div class="form-group" style="max-width: 380px;">
                            <label  for="upload" class="upload">
                                <span class="upload-image upload_banner">
                                    <img src="./public/src/img/banner/desktop/<?php echo "$settings->banner";?>" alt="" class="banner-atual">
                                </span>
                            </label>
                            <input name="banner" type="file" accept="image/*" id="upload">
                        </div>
                    </div>
                    <div>
                        <h2 class="font-title pt-5">Banner Mobile</h2>
                        <div class="form-group" style="max-width: 380px;">
                            <label  for="uploadBannerMobile" class="upload">
                                <span class="upload-image upload_banner_mobile">
                                    <img src="./public/src/img/banner/mobile/<?php echo "$settings->banner_mobile";?>" alt="" class="banner-mobile-atual">
                                </span>
                            </label>
                            <input name="uploadBannerMobile" type="file" accept="image/*" id="uploadBannerMobile">
                        </div>
                    </div>
                </div>
                <div>
                    <h2 class="font-title pt-5">Texto de Introdução</h2>
                    <div class="form-group col-md-4 col-12 my-3">
                        <input type="text" name="title" id="title" placeholder="Título de introdução da página inicial:" required value="<?php echo $settings->intro_title;?>">
                    </div>
                    <div class="form-group col-md-8 col-12 my-3">
                        <textarea name="text" id="text" placeholder="Texto de introdução da página inicial:"><?php echo $settings->intro_text;?></textarea>
                    </div>
                </div>
                <h2 class="font-title pt-5">Cards</h2>
                <div class="d-flex flex-wrap justify-content-between align-items-baseline">
                    <!-- card 1 -->
                    <div class="col-md-3 col-12">
                        <h3 class="color-white">Card 1</h3>
    
                        <div class="form-group">
                            <label  for="card_img_1" class="upload">
                                <span class="upload-image upload_card_img_1">
                                    <img src="./public/src/img/cards/card-1/<?php echo "$settings->card_img_1";?>" alt="" class="card_img_1_atual">
                                </span>
                            </label>
                            <input name="card_img_1" type="file" accept="image/*" id="card_img_1">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-title-1" id="card-title-1" placeholder="Título do Card 1:" required value="<?php echo $settings->card_title_1;?>">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-sub-title-1" id="card-sub-title-1" placeholder="Sub-Título do Card 1:" required value="<?php echo $settings->card_sub_title_1;?>">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <textarea name="card-text-1" id="card-text-1" placeholder="Texto do Card 1:"><?php echo $settings->card_text_1;?></textarea>
                        </div>

                    </div>


                    <!-- card 2 -->
                    <div class="col-md-3 col-12">
                        <h3 class="color-white">Card 2</h3>
    
                        <div class="form-group">
                            <label  for="card_img_2" class="upload">
                                <span class="upload-image upload_card_img_2">
                                    <img src="./public/src/img/cards/card-2/<?php echo "$settings->card_img_2";?>" alt="" class="card_img_2_atual">
                                </span>
                            </label>
                            <input name="card_img_2" type="file" accept="image/*" id="card_img_2">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-title-2" id="card-title-2" placeholder="Título do Card 2:" required value="<?php echo $settings->card_title_2;?>">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-sub-title-2" id="card-sub-title-2" placeholder="Sub-Título do Card 2:" required value="<?php echo $settings->card_sub_title_2;?>">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <textarea name="card-text-2" id="card-text-2" placeholder="Texto do Card 2:"><?php echo $settings->card_text_2;?></textarea>
                        </div>

                    </div>


                    <!-- card 3 -->
                    <div class="col-md-3 col-12">
                        <h3 class="color-white">Card 3</h3>
    
                        <div class="form-group">
                            <label  for="card_img_3" class="upload">
                                <span class="upload-image upload_card_img_3">
                                    <img src="./public/src/img/cards/card-3/<?php echo "$settings->card_img_3";?>" alt="" class="card_img_3_atual">
                                </span>
                            </label>
                            <input name="card_img_3" type="file" accept="image/*" id="card_img_3">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-title-3" id="card-title-3" placeholder="Título do Card 3:" required value="<?php echo $settings->card_title_3;?>">
                        </div>
    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="card-sub-title-3" id="card-sub-title-3" placeholder="Título do Card 3:" required value="<?php echo $settings->card_sub_title_3;?>">
                        </div>
    
    
                        <div class="form-group col-12 my-3">
                            <textarea name="card-text-3" id="card-text-3" placeholder="Texto do Card 3:" required><?php echo $settings->card_text_3;?></textarea>
                        </div>
                    </div>


                </div>

                <h2 class="font-title pt-5">Redes Sociais</h2>
                <div>
                    <!-- Facebook -->
                    <div class="col-md-8 col-12">
                        <h3 class="color-white">Facebook</h3>    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="facebookInput" id="facebookInput" placeholder="Link do Facebook:" value="<?php echo $settings->facebook;?>">
                        </div>
                    </div>
                    
                    <!-- Instagram -->
                    <div class="col-md-8 col-12">
                        <h3 class="color-white">Instagram</h3>    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="instagramInput" id="instagramInput" placeholder="Link do Instagram:" value="<?php echo $settings->instagram;?>">
                        </div>
                    </div>

                    <!-- Twitter -->
                    <div class="col-md-8 col-12">
                        <h3 class="color-white">Twitter</h3>    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="twitterInput" id="twitterInput" placeholder="Link do Twitter:" value="<?php echo $settings->twitter;?>">
                        </div>
                    </div>

                    <!-- Youtube -->
                    <div class="col-md-8 col-12">
                        <h3 class="color-white">Youtube</h3>    
                        <div class="form-group col-12 my-3">
                            <input type="text" name="youtubeInput" id="youtubeInput" placeholder="Link do canal do Youtube:" value="<?php echo $settings->youtube;?>">
                        </div>
                    </div>
                </div>


                <div class="py-3">
                    <button class="btn-primary" type="submit" id="submit">Atualizar</button>
                </div>
            </form>
        </div>
    </section> 
    <?php include('public/includes/footer.php'); ?>
    <script src="./public/src/js/settings/functions.js?v6"></script>
    <script src="./public/src/js/settings/upload-img.js"></script>
</body>
</html>