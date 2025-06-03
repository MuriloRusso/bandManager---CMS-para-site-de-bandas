<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Agenda</title>
    <?php include ('public/includes/head.php'); ?>
    <link rel="stylesheet" href="./css/calendar.css?001">

</head>

<body>
    <?php include ('public/includes/header.php'); ?>
    <section style="background-image: url('./public/src/img/bgs/bg-3.jpg');" class="background">
        <div class="overlay">
            <div class="container py-5 d-flex flex-column align-items-center" style="min-height: 80vh;" id="particles-js">
                <div id="alert-container" class="col-12"></div>
                <div class="col-md- d-flex flex-wrap justify-content-between col-12">
                    <div class="col-md-4 col-12">
                        <img src="./public/src/img/calendar/singler.jpg" alt="">
                    </div>
                    <div class="col-md-8 col-12 py-3 py-md-0">
                        <div class="px-3">
                            <h2 class="font-title">Agenda</h2>
                            <?php if (isset($_SESSION['id'])): ?>
                                <div class="py-3">
                                    <a href="#" class="btn-primary open-modal-new">+ Novo Evento</a>
                                </div>
                            <?php endif; ?>
                            <div id="list"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script> <!-- stats.js lib -->
    <script src="http://threejs.org/examples/js/libs/stats.min.js"></script>

    <script>
        // particlesJS("particles-js", { "particles": { "number": { "value": 10, "density": { "enable": true, "value_area": 800 } }, "color": { "value": "#ffffff" }, "shape": { "type": "image", "stroke": { "width": 0, "color": "#000000" }, "polygon": { "nb_sides": 5 }, "image": { "src": "https://murilorusso.com.br/band/musical-note.png", "width": 100, "height": 100 } }, "opacity": { "value": 0.5, "random": false, "anim": { "enable": false, "speed": 1, "opacity_min": 0.1, "sync": false } }, "size": { "value": 20, "random": true, "anim": { "enable": false, "speed": 40, "size_min": 0.1, "sync": false } }, "line_linked": { "enable": false, "distance": 150, "color": "#ffffff", "opacity": 0.4, "width": 1 }, "move": { "enable": true, "speed": 2, "direction": "none", "random": false, "straight": false, "out_mode": "out", "bounce": false, "attract": { "enable": false, "rotateX": 600, "rotateY": 1200 } } }, "interactivity": { "detect_on": "canvas", "events": { "onhover": { "enable": false, "mode": "repulse" }, "onclick": { "enable": false, "mode": "push" }, "resize": true }, "modes": { "grab": { "distance": 400, "line_linked": { "opacity": 1 } }, "bubble": { "distance": 400, "size": 40, "duration": 2, "opacity": 8, "speed": 3 }, "repulse": { "distance": 200, "duration": 0.4 }, "push": { "particles_nb": 4 }, "remove": { "particles_nb": 2 } } }, "retina_detect": true }); var count_particles, stats, update; stats = new Stats; stats.setMode(0); stats.domElement.style.position = 'absolute'; stats.domElement.style.left = '0px'; stats.domElement.style.top = '0px'; document.body.appendChild(stats.domElement); count_particles = document.querySelector('.js-count-particles'); update = function () { stats.begin(); stats.end(); if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) { count_particles.innerText = window.pJSDom[0].pJS.particles.array.length; } requestAnimationFrame(update); }; requestAnimationFrame(update);;
    </script>


    <?php if (isset($_SESSION['id'])): ?>
        <!-- modal insert -->
        <div class="modal modal-new">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Novo Evento</h2>
                <form>
                    <div class="form-group col-12 my-3">
                        <select name="tipo" id="tipo">
                            <option value="">Selecione o tipo do evento</option>
                            <?php
                            $sql_code = "SELECT * FROM lst_events";
                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                            $quantidade = $sql_query->num_rows;
                            while ($eventType = $sql_query->fetch_object()):
                                print "<option value='$eventType->id'>$eventType->title</option>";
                            endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="local" id="local" placeholder="Local do Evento:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="datetime-local" name="date_calendar" id="date_calendar" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="address" id="address" placeholder="Endereço do Evento:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-new">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submit">Criar Evento</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal update -->
        <div class="modal modal-edit">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Atualizar Evento</h2>
                <form>
                    <input type="hidden" name="idEdit" id="idEdit" require>
                    <div class="form-group col-12 my-3">
                        <select name="tipoEdit" id="tipoEdit">
                            <option value="">Selecione o tipo do evento</option>
                            <?php
                            $sql_code = "SELECT * FROM lst_events";
                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);
                            $quantidade = $sql_query->num_rows;
                            while ($eventType = $sql_query->fetch_object()):
                                print "<option value='$eventType->id'>$eventType->title</option>";
                            endwhile;
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="text" name="local" id="localEdit" placeholder="Local do Evento:" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <input type="datetime-local" name="date_calendarEdit" id="date_calendarEdit" required>
                    </div>
                    <div class="form-group col-12 my-3">
                        <textarea name="addressEdit" id="addressEdit" placeholder="Endereço do Evento:" required></textarea>
                    </div>
                    <div>
                        <a class="btn-primary-reverse close-modal-edit">Cancelar</a>
                        <button class="btn-primary mx-md-3 my-3" type="submit" id="submit">Atualizar Evento</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- modal delete -->
        <div class="modal modal-delete">
            <div class="container py-5 col-md-6 col-12">
                <h2 class="font-title">Excluír Evento</h2>
                <form>
                    <p class="color-white m-0">Tem certeza que gostaria de excluír esse evento?</p>
                    <input type="hidden" name="idDelete" id="idDelete" required>
                    <p class='color-white' id="titleText"></p>
                    <div>
                        <a class="btn-primary-reverse close-modal-delete">Cancelar</a>
                        <a class="btn-primary mx-md-3 my-3" type="submit" id="submit"
                            onclick="deleteEvent('calendar')">Excluir</a>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <?php include ('public/includes/footer.php'); ?>
    <script src="./public/src/js/calendar/functions.js?v7"></script>
</body>

</html>