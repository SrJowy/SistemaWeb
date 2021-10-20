<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: index.php');
} else {
    $db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
    $user = $_SESSION['username'];
    $user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);

    //Obtener las partidas del usuario
    $partidas_query = "SELECT * FROM partida WHERE nombreUsuario = '$user';";
    $res = mysqli_query($db, $partidas_query);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Call of Stats</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../second.css'>
    <script src='../bootstrap.bundle.js'></script>
    <script src='../main.js'></script>
    <script src='eliminar.js'></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
        rel="stylesheet"  type='text/css'> <!--- Iconos --->

</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Call of Stats</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navi" aria-control="navi" 
                aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navi">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Base de datos</a>
                        </li>
                    </ul>
                    <?php if (!isset($_SESSION['username'])) : ?>
                        <button onclick="location.href='../inicioSesion.php'" type="button" class="btn btn-outline-dark me-2">Iniciar sesión</button>
                        <button onclick="location.href='../registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class= "dropdown me-5">
                            <a href="#" class ="d-block link-dark text-decoration-none dropdown-toggle" id = 'dropUser' data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/userphoto.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class ="dropdown-menu text-small" aria-labelledby="dropUser" style>
                                <li>
                                    <a class="dropdown-item" href="#">Panel Usuario</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../cerrar.php">Cerrar Sesión</a>
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
            <div class="p-4 mb-4 text-white rounded bg-dark">
                <div class = "row">
                    <h3>Panel del usuario</h3>
                </div>
            </div>
            <div class= "row">
            <div class="col-3 ps-4">
                <div class="row">
                    <button type="button" class="botonAjustes" onclick="location.href='cambiarDatos.php'">Actualizar datos  ></button>
                </div>
                <div class="row">
                    <button type="button" class="botonAjustes seleccionado" onclick="location.href='#'">Partidas guardadas  ></button>
                </div>
                <div class="row">
                    <button type="button" class="botonAjustes">Añadir partidas  ></button>
                </div>
                <div class="row">
                    <button type="button" class="botonAjustes">Puntos  ></button>
                </div>
            </div>
            <div class ="col-9">
                <div class="text-white rounded bg-dark">
                    <div class = "row p-5">
                        <?php
                            if (mysqli_num_rows($res) == 0):
                                echo "No se han encontrado partidas";
                            else :
                                while ($row = mysqli_fetch_array ($res)) :
                                    $num_partida = $row['num_partida'];
                                    $mapa = $row['mapa'];
                                    $puntos = $row['puntos'];
                                    $bajas = $row['bajas'];
                                    $muertes = $row['muertes'];
                                    $kda = number_format($bajas/$muertes, 2);
                                ?>
                            <div class ="col-12 bordePartidas mt-4">
                            <div class = "row p-3 text-dark bg-light">
                                <h3>Partida <?php echo $num_partida ?></h3>
                            </div>
                            <div class= row>
                                <div class ="col-lg-5 p-4">
                                    <div class = "row">
                                        <?php if ($mapa == "Cartel") : ?>
                                            <img class = "imgMapa" src="../img/m1.png">
                                        <?php elseif ($mapa == "Nuketown") : ?>
                                            <img class = "imgMapa" src="../img/m2.png">
                                        <?php elseif ($mapa == "The Pines") : ?>
                                            <img class = "imgMapa" src="../img/m3.png">
                                        <?php endif; ?>
                                    </div>
                                    <div class = "row text-center mt-3">
                                        <h4>Mapa: <?php echo $mapa ?></h4>
                                    </div>
                                    <div class = "row mt-5 mx-5">
                                        <form id="partida_<?php echo $num_partida?>" name="partida_<?php echo $num_partida?>" method="POST" action="eliminar_partida.php">
                                            <input type = "hidden" name="partida" value="<?php echo $num_partida?>">
                                            <button type="button" name="<?php echo $num_partida?>" id="<?php echo $num_partida?>" class ="btn btn-outline-danger" onclick="eliminarPartida(this)"><i class="fa fa-close me-3"></i>Eliminar partida</button>
                                        </form>
                                    </div>
                                </div>
                                <div class ="col-lg-3 p-4">
                                    <div class = "row mb-3">
                                        <h4>Puntos: <?php echo $puntos ?></h4>
                                    </div>
                                    <div class = "row mb-3">
                                        <h4>Bajas: <?php echo $bajas ?></h4>
                                    </div>
                                    <div class = "row mb-3">
                                        <h4>Muertes: <?php echo $muertes ?></h4>
                                    </div>
                                    <div class = "row mb-3">
                                        <h4>K/D: <?php  echo $kda ?></h4>
                                    </div>
                                </div>
                                <div class ="col-lg-4 p-4">
                                    <div class = "row mb-3">
                                        <h4>Ventajas equipadas:</h4>
                                    </div>
                                    <div class = "row centered text-center">
                                        <img  class="ventaja mb-2" src="../img/v2.png">
                                        <p>Avión espía</p>
                                    </div>
                                    <div class = "row centered text-center">
                                        <img  class="ventaja mb-2" src="../img/v1.png">
                                        <p>Napalm</p>
                                    </div>
                                    <div class = "row centered text-center">
                                        <img  class="ventaja mb-2" src="../img/v3.png">
                                        <p>Vtol</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                            endif; ?>

                    </div>
                </div>
            </div>
            </div>
                    <div class="my-3 my-md-3 bg-white"></div>
                    <div class="p-4 p-md-5 bg-white">
                            <div class="row">
                                <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                    <div class="container bg-dark rounded p-0">
                                        <img class="imgCuadrada" src="../img/juancarsecae.png">
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
        <p>Sígueme en los internetes</p>
        <p>
          <a href="#">Arriba</a>
        </p>
    </footer>
</body>
</html>
<?php
unset($_SESSION['errorActMail']);
unset($_SESSION['successActMail']);
unset($_SESSION['successActNum']);
unset($_SESSION['successActUser']);
unset($_SESSION['errorActUser']);
unset($_SESSION['successActContra'])
?>