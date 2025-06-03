<?php
    include('public/includes/connect.php');
    $id = $_GET['id'];
    $sql_code = "SELECT * FROM post WHERE id=$id";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $post = $sql_query->fetch_object();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Post - <?php echo $post->title;?></title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/blog.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section>
        <div class="container py-5">
            <h2 class="font-title">
                <a href="blog.php" class="text-decoration-none color-white">
                    Blog
                </a>
                > 
                <?php echo $post->title;?>
            </h2>
            <?php

                if($quantidade === 0):
                    print '<p class="color-white">Postagem não encontrada!</p>';
                endif;

                $data = explode("-", $post->created);
                $sql_codeUser = "SELECT * FROM cad_user Where id=$post->user_created";
                $sql_queryUser = $mysqli->query($sql_codeUser) or die("Falha na execução do código SQL" . $mysqli->error);
                $user_created = $sql_queryUser->fetch_object();

                // formatar data para brasileiro
                $timestamp = strtotime($post->created);
                $dataFormatada = date('d/m/Y', $timestamp);
            ?>
            <div class="post py-5">
                <div class="col-12">
                    <p class="date"><?php echo $dataFormatada ?></p>
                    <p class="color-white m-0">Publicado Por: <?php echo $user_created->name; ?></p>
                </div>
                <div class="col-12">
                    <img src="public/src/img/upload/post/<?php echo $post->capa.'.'.$post->format; ?>" alt="">
                </div>
                <div class="col-12">
                    <div class="px-1">
                        <h3 class="font-title pt-3"><?php echo $post->title; ?></h3>
                        <p class="color-white"><?php echo $post->text; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('public/includes/footer.php'); ?>
</body>
</html>