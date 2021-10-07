<?php
session_start();
if (!isset($_SESSION['username'])) {

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>TBA</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='second.css'>
    <script src='bootstrap.bundle.js'></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Viva España</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Base de datos</a>
                        </li>
                    </ul>
                    <?php if (!isset($_SESSION['username'])) : ?>
                        <button onclick="location.href='inicioSesion.html'" type="button" class="btn btn-outline-dark me-2">Iniciar sesión</button>
                        <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class= "dropdown text-end">
                            <a href="#" class ="d-block link-dark text-decoration-none dropdown-toggle" id = 'dropUser' data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="img/userphoto.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class ="dropdown-menu text-small" aria-labelledby="dropUser" style>
                                <li>
                                    <a class="dropdown-item" href="#">Panel Usuario</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="cerrar.php">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                    <?php endif ?>
                    </div>
            </div>
        </nav>
    </div>
    
    <main>
        <div class="container">
            <div class="p-4 p-md-5 text-white rounded bg-dark">
                <div class = "row">
                    <div class="col-12 col-md-6">
                        <h1 class="display-4">Buenas tardes y viva España</h1>
                        <p class="lead">Únete a la mayor web de amantes de nuestra amada nación ESPAÑA</p>
                        <button type="button" class="btn btn-secondary">Crear cuenta</button>
                    </div>
                    <div class ="col-12 col-lg-6 mt-3 mt-lg-0">
                            <h3 class="text-center">Top 3 de la semana</h3>
                            <div class="container my-3 px-md-6">
                                <div class="p-4 rounded bg-white text-dark text-end">
                                    <div class = "row">
                                        <div class="col-4">
                                            <!---<img src="img/juancarsecae.png" class="imgRedonda">--->
                                        </div>
                                        <div class="col-8">
                                            <p class="my-4">#1 - PacoPiernasCortas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container my-3 px-md-6">
                                <div class="p-4 rounded bg-white text-dark text-end">
                                    <div class = "row">
                                        <div class="col-4">
                                            <img src="img/juancarsecae.png" class="imgRedonda">
                                        </div>
                                        <div class="col-8">
                                            <p class="my-4">#2 - Juancar</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container my-3 px-md-6">
                                <div class="p-4 rounded bg-white text-dark text-end">
                                    <div class = "row">
                                        <div class="col-4">
                                            <!---<img src="img/juancarsecae.png" class="imgRedonda">--->
                                        </div>
                                        <div class="col-8">
                                            <p class="my-4">#3 - RiveraCousin</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="my-3 my-md-3 bg-white"></div>
                <div class="p-4 p-md-5 bg-white">
                        <div class="row">
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                    <img class="imgCuadrada" src="img/juancarsecae.png">
                                    <div class="container text-white p-2 text-center">
                                        <h1>Grandes oponentes</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark p-4 rounded"></div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark p-4 rounded"></div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark p-4 rounded"></div>
                            </div>
                        </div>
                </div>
                <div class="my-md-5 bg-white"></div>
            </div>
            
        </div>
    </main>
    <footer class="modal-footer">
        <p>Sígueme y te sigo papi</p>
        <p>
          <a href="#">Arriba</a>
        </p>
    </footer>
</body>
</html>