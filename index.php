<?php
    include('public/includes/connect.php');
    $sql_code = "SELECT * FROM settings Limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $settings = $sql_query->fetch_object();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo $settings->band_name;?></title>
    <?php include('public/includes/head.php');?>
</head>
<body>
    <?php include('public/includes/header.php'); ?>    
    <section style="text-align: center;" class="d-sm-block d-none">
        <img src="./public/src/img/banner/desktop/<?php echo $settings->banner;?>" alt="" style="width: 100%;">
    </section>

    <section style="text-align: center;" class="d-sm-none d-block">
        <img src="./public/src/img/banner/mobile/<?php echo $settings->banner_mobile;?>" alt="" style="width: 100%;">
    </section>

    <section class="py-5">
        <div class="container">
            <h2 class="font-title text-center fs-1"><?php echo $settings->intro_title;?></h2>
            <div class="px-0 px-md-5">
                <p class="text-center px-md-5 color-white fs-4 fw-bold"><?php echo $settings->intro_text;?></p>
            </div>
        </div>
    </section>



    <section id="cards">
        <div class="container d-flex flex-wrap">
            <div class="col-12 col-md-4 py-5 color-white">
                <div class="d-flex pl-5 align-items-start">
                    <img src="./public/src/img/cards/card-1/<?php echo $settings->card_img_1 ?>" alt="">
                    <div class="px-3">
                        <h3 class="font-title"><?php echo $settings->card_title_1 ?></h3>
                        <p class="text-uppercase"><?php echo $settings->card_sub_title_1 ?></p>
                        <p class="short-text"><?php echo $settings->card_text_1 ?></p>
                        <!-- <a href="#" class="font-title btn-secondary">mais</a> -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 py-5 color-white">
                <div class="d-flex pl-5 align-items-start">
                    <img src="./public/src/img/cards/card-2/<?php echo $settings->card_img_2 ?>" alt="">
                    <div class="px-3">
                        <h3 class="font-title"><?php echo $settings->card_title_2 ?></h3>
                        <p class="text-uppercase"><?php echo $settings->card_sub_title_2 ?></p>
                        <p class="short-text"><?php echo $settings->card_text_2 ?></p>
                        <!-- <a href="#" class="font-title btn-secondary">mais</a> -->
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 py-5 color-white">
                <div class="d-flex pl-5 align-items-start">
                    <img src="./public/src/img/cards/card-3/<?php echo $settings->card_img_3 ?>" alt="">
                    <div class="px-3">
                        <h3 class="font-title"><?php echo $settings->card_title_3 ?></h3>
                        <p class="text-uppercase"><?php echo $settings->card_sub_title_3 ?></p>
                        <p class="short-text"><?php echo $settings->card_text_3 ?></p>
                        <!-- <a href="#" class="font-title btn-secondary">mais</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="container d-flex flex-wrap">
            <div class="col-12 col-md-4 py-5 color-white border-right">
                <div class="pr-3">
                    <h3 class="text-title">Nosso Blog!</h3>
                    <?php
                        $sql_code = "SELECT * FROM post ORDER by created Desc Limit 1";
                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                        $quantidade = $sql_query->num_rows;

                        if($quantidade === 0):
                            print '<p class="color-white">Sem Postagens por enquanto!</p>';
                        endif;    
                        while($post = $sql_query->fetch_object()):
                        // formatar data para brasileiro
                        $timestamp = strtotime($post->created);
                        $dataFormatada = date('d/m/Y', $timestamp);

                    ?>
                        <img src="./public/src/img/upload/post/<?php echo "$post->capa.$post->format" ?>" alt="" style="padding-right: 5px">
                        <p class="text-uppercase py-2"><?php echo $post->title; ?></p>
                        <p class="short-text"><?php echo substr($post->text, 0, 150)."..."; ?></p>
                        <a href="post.php?id=<?php echo "$post->id" ?>" class="btn-primary">mais</a>
                    <?php
                        endwhile;
                    ?>
                </div>
            </div>
            <div class="col-12 col-md-4 py-5 color-white border-right">
                <div class="px-md-5">
                    <h3 class="text-title">Notícias</h3>
                    <?php
                        include('public/includes/connect.php');
                        $sql_code = "SELECT * FROM news ORDER by created Desc Limit 3";
                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                        $quantidade = $sql_query->num_rows;

                        if($quantidade === 0):
                            print '<p class="color-white">Sem Notícias por enquanto!</p>';
                        endif;    
                        while($news = $sql_query->fetch_object()):
                        // formatar data para brasileiro
                        $timestamp = strtotime($news->created);
                        $dataFormatada = date('d/m/Y', $timestamp);

                    ?>
                        <div class="new">
                            <p class="date mb-0 color-gray"><?php echo $dataFormatada ?></p>
                            <a href="new.php?id=<?php echo $news->id ?>" class="text-decoration-none">
                                <p class="text-uppercase py-2 mb-0 color-white"><?php echo $news->title ?></p>
                            </a>
                            <p class="short-text"><?php echo substr($news->text, 0, 150)."..." ?></p>
                        </div>
                    <?php
                        endwhile;
                    ?>
                    <a href="news.php" class="btn-primary">Ver tudo</a>
                </div>
            </div>

            <div class="col-12 col-md-4 py-5 color-white">
                <div class="px-md-5">
                    <h3 class="text-title">Agenda</h3>
                    <a href="calendar.php" class="text-decoration-none">
                        <p class="text-uppercase py-2 mb-0 color-white">Confira a nossa agenda para ficar ligado em tudo que temos pela frente.</p>
                    </a>
                    <?php
                        $sql_code = "SELECT * FROM calendar WHERE id_event=1 ORDER by date_calendar Desc Limit 4";
                        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                        $quantidade = $sql_query->num_rows;

                        if($quantidade === 0):
                            print '<p class="color-white">Sem Eventos na agenda por enquanto!</p>';
                        endif;
    
                        while($event = $sql_query->fetch_object()):
                        // formatar data para brasileiro
                        $timestamp = strtotime($event->date_calendar);
                        $dataFormatada = date('d/m/Y', $timestamp);
                    ?>
                        <div class="event d-flex align-items-start py-2">
                            <img src="public/src/img/icons/calendar.png" alt="" style="width: 50px;">
                            <div class="px-3">
                                <p class="short-text m-0 color-gray"><?php echo $dataFormatada ?></p>
                                <p class="short-text m-0">Local: <?php echo $event->local_name ?></p>
                                <p class="short-text m-0"><?php echo $event->address ?></p>
                            </div>
                        </div>
                    <?php
                        endwhile;
                    ?>
                    <div class="my-3">
                        <a href="calendar.php" class="btn-primary">Ver agenda</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include('public/includes/footer.php'); ?>
</body>
</html>