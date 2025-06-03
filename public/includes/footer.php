
<footer>
    <div class="container d-flex">
        <p>
            <?php 
                $currentYear = date("Y");
                echo $currentYear;
            ?> © Desenvolvido por <a href="https://murilorusso.com.br/" class="color-white" target="_blank">Murilo Russo</a>
        </p>
    </div>
</footer>

<?php include('loading.php') ?>
<!-- scripts do site -->
<script src="./public/src/js/adm.js?v9"></script>
<script src="./public/src/js/menu.js"></script>
<script src="./public/src/js/alert.js?v4"></script>
<script src="./public/src/js/loading.js?2"></script>
<script src="./public/src/js/modal.js?v4"></script>
<script src="https://kit.fontawesome.com/ba0bbbdb6d.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- anime on scroll -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>