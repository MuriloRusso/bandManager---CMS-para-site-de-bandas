<?php
    include('connect.php');
    $sql_code = "SELECT * FROM settings Limit 1";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $settings = $sql_query->fetch_object();

    $sql_code = "SELECT * from contact Where view=0";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
    $contacts = $sql_query->fetch_object();
    $quantContactsUnread = $sql_query->num_rows;
?>
<header>
    <div id="midias" class="container justify-content-md-end justify-content-center">
        <?php if($settings->facebook):?>
            <a href="<?php echo $settings->facebook;?>" id="facebook" title="facebook" target="_blank"><i class="fa fa-facebook icon"></i></a>
        <?php endif;?>
        <?php if($settings->instagram):?>
            <a href="<?php echo $settings->instagram;?>" id="instagram" title="instagram" target="_blank"><i class="fa-brands fa-instagram"></i></a>
        <?php endif;?>
        <?php if($settings->twitter):?>
            <a href="<?php echo $settings->twitter;?>" id="twitter" title="twitter" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        <?php endif;?>
        <?php if($settings->youtube):?>
            <a href="<?php echo $settings->youtube;?>" id="youtube" title="youtube" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        <?php endif;?>
    </div>
    <div class="container">
        <nav class="d-flex flex-wrap align-items-center justify-content-md-between justify-content-center flex-md-row flex-column">
            <h1>
                <a href="index.php">
                    <img id="logo" src="./public/src/img/logo/<?php echo $settings->logo;?>" style="max-width: 300px;" alt="<?php echo $settings->band_name;?>">
                </a>
                <!-- <a href="index.php">Music Band</a> -->
            </h1>
            <button id="btn-menu-mobile" title="Menu">
                <hr>
                <hr>
                <hr>
                <span>X</span>
            </button>
            <ul id="menu" class="p-0 m-0 flex-md-row flex-column">
                <li>
                    <a href="./">Início</a>
                </li>
                <li>
                    <a href="./calendar.php">Agenda</a>
                </li>
                <li>
                    <a href="./members.php">Membros</a>
                </li>
                <li>
                    <a href="./gallery.php">Galeria</a>
                </li>
                <li>
                    <a href="./blog.php">Blog</a>
                </li>
                <li>
                    <a href="./news.php">Noticias</a>
                </li>
                <li>
                    <a href="./contact.php" class="d-flex align-items-center">Contatos
                        <?php
                            if(isset($_SESSION['id'])):
                                if($quantContactsUnread > 0 && $quantContactsUnread < 10 && isset($_SESSION['id'])):
                        ?>
                                    <span class="notification color-white text-center">
                                        <?php echo $quantContactsUnread;?>
                                    </span>
                        <?php
                                elseif($quantContactsUnread > 9):
                        ?>
                                    <span class="notification color-white text-center">9+</span>
                        <?php
                                endif;
                            endif;
                        ?>
                    </a>
                </li>
                <?php if(isset($_SESSION['id'])):?>
                    <li>
                        <a href="#">
                            <i class="fa-solid fa-user"></i>
                            <span style="margin-left: 5px;">
                                <?php 
                                    $name = $_SESSION['name'];
                                    try{
                                        $name = explode(' ', $name);
                                        $name = $name[0];
                                    }
                                    catch(err){}
                                    echo $name;
                                ?>
                            </span>
                        </a>
                        <ul>
                            <li>
                                <a href="./my-account.php"><i class="fa-solid fa-user my-3 mx-2" aria-hidden="true"></i>Minha Conta</a>
                            </li>
                            <li>
                                <a href="./users.php"><i class="fa-solid fa-users my-3 mx-2" aria-hidden="true"></i>Usuários</a>
                            </li>
                            <li>
                                <a href="./smtp.php"><i class="fa-solid fa-envelope my-3 mx-2" aria-hidden="true"></i>SMTP</a>
                            </li>
                            <li>
                                <a href="./settings.php"><i class="fa-solid fa-gear my-3 mx-2" aria-hidden="true"></i>Configurações</a>
                            </li>
                            <li>
                                <a href="./adm/api/logout.php"><i class="fa-solid fa-right-from-bracket my-3 mx-2" aria-hidden="true"></i>Sair</a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>