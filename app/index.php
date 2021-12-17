<?php
session_start();
$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
if (!$db) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
if ($_SESSION['ult_actividad'] < time() - $_SESSION['expira']) {
    session_unset();
    session_destroy();
} else {
    $_SESSION['ult_actividad'] = time();
}

$query = "SELECT nombreUsuario, SUM(puntos) FROM partida GROUP BY nombreUsuario ORDER BY SUM(puntos) DESC LIMIT 3;";  
$res = mysqli_query($db, $query);
$i = 0;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Call of Data</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='js/bootstrap.bundle.js'></script>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Call of Data</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Inicio</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Base de datos</a>
                        </li>-->
                    </ul>
                    <?php if (!isset($_SESSION['username'])) : ?>
                        <button onclick="location.href='inicioSesion.php'" type="button" class="btn btn-outline-dark me-2">Iniciar sesión</button>
                        <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <p class = "p-3 pb-0"><?php echo $_SESSION['success']; ?></p>
                        <div class= "dropdown me-5">
                            <a href="#" class ="d-block link-dark text-decoration-none dropdown-toggle me-5" id = 'dropUser' data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="img/av1.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class ="dropdown-menu text-small" aria-labelledby="dropUser" style>
                                <li>
                                    <a class="dropdown-item" href="panelUsuario/cambiarDatos.php">Panel Usuario</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="server/cerrar.php">Cerrar Sesión</a>
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
                        <h3 class="display-4">Juega, compite y ¡GANA!</h3>
                        <p class="lead">Únete a la mayor web de competición para Call of Duty: Cold War y juega contra otros jugadores 
                            para ganar premios y experiencias únicas.
                        </p>
                        <button type="button" class="btn btn-secondary" onclick="location.href='registro.php'">Crear cuenta</button>
                    </div>
                    <div class ="col-12 col-lg-6 mt-3 mt-lg-0">
                            <h3 class="text-center">Top 3 jugadores</h3>
                            <?php while ($row = mysqli_fetch_array ($res)) : 
                                $i++;?>
                                <div class="container my-3 px-md-6">
                                    <div class="p-4 rounded bg-white text-dark text-end">
                                        <div class = "row">
                                            <div class="col-4">
                                                <img src="img/av1.png" class="imgRedonda">
                                            </div>
                                            <div class="col-8">
                                                <p class="my-4">#<?php echo "{$i} - {$row['nombreUsuario']}"; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
                <div class="my-3 my-md-3 bg-white"></div>
                <div class="p-4 p-md-5 bg-white">
                        <div class="row">
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                    <img class="imgCuadrada" src="img/fb1.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Compite contra otros jugadores</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/fb2.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Participa en torneos exclusivos</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/fb3.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Gana recompensas para el juego</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="img/fb4.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Únete a tus amigos para ser invatibles</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="my-md-5 bg-white"></div>
            </div>
            
        </div>
    </main>
    <footer class="modal-footer">
        <p>Sígueme en los internetes</p>
        <p>
          <a href="#">Arriba</a>
        </p>
    </footer>
</body>
</html>