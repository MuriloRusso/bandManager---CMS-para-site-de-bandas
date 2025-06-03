<?php
    include('public/includes/connect.php');
    $id = $_GET['id'];
    $sql_code = "SELECT * FROM news Where id=$id";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $quantidade = $sql_query->num_rows;
    $new = $sql_query->fetch_object();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Notícias - <?php echo $new->title ?></title>
    <?php include('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/gallery.css">
</head>
<body>
    <?php include('public/includes/header.php'); ?>
    <section>
        <div class="container py-5" style="min-height: 80vh;">

            <h2 class="font-title">
                <a href="news.php" class="text-decoration-none color-white">
                    Notícias
                </a>
                > 
                <?php echo $new->title;?>
            </h2>

            <div>
                <?php

                    if($quantidade === 0):
                        print '<p class="color-white">Notícia não encontrada!</p>';
                    endif;

                    $createdSplit = explode(" ", $new->created);

                    $created = explode('-', $createdSplit[0]);

                ?>
                    <div class="new my-5">
                        <p class="date mb-0 color-gray"><?php echo $created[2] . '/' . $created[1] . '/' . $created[0] . ' ' . $createdSplit[1]; ?></p>

                            <a href="new.php?id=<?php echo $new->id ?>" class="text-decoration-none">
                                <h2 class="text-uppercase py-2 mb-0 color-white"><?php echo $new->title ?></h2>
                            </a>
                        <p class="color-white"><?php echo $new->text ?></p>
                    </div>
            </div>
        </div>
    </section>
    <?php include('public/includes/footer.php'); ?>
</body>
</html>