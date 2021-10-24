<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location: index.php');
} else {
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $user = $_SESSION['username'];
    $user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$user';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);

    //Obtener variables a modificar
    if (isset($_SESSION['partidaAnt'])) {
        $partida = $_SESSION['partidaAnt'];
    } else {
        $partida = $_POST['partida'];
    }
    
    $mapa = $_POST['mapa'];
    $puntos = $_POST['puntos'];
    $bajas = $_POST['bajas'];
    $muertes = $_POST['muertes'];

    $query = "SELECT SUM(puntos) FROM partida WHERE nombreUsuario = '$user';";
    $res2 = mysqli_query($db,$query);
    $puntosMostrar = mysqli_fetch_assoc($res2);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Call of Data</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='../css/second.css'>
    <link rel="icon" href='../img/logo.ico' type ='image/x-icon'>
    <script src='../js/bootstrap.bundle.js'></script>
    <script src='../js/main.js'></script>
    <script src='js/eliminar.js'></script>
    <script src='js/comprobarDatos.js'></script>
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css" 
        rel="stylesheet"  type='text/css'> <!--- Iconos --->

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
                            <a class="nav-link" href="../index.php">Inicio</a>
                        </li>
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Base de datos</a>
                        </li>-->
                    </ul>
                    <?php if (!isset($_SESSION['username'])) : ?>
                        <button onclick="location.href='../inicioSesion.php'" type="button" class="btn btn-outline-dark me-2">Iniciar sesión</button>
                        <button onclick="location.href='../registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <p class = "p-3 pb-0"><?php echo $_SESSION['success']; ?></p>
                        <div class= "dropdown me-5">
                            <a href="#" class ="d-block link-dark text-decoration-none dropdown-toggle me-5" id = 'dropUser' data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/av1.png" alt="mdo" width="32" height="32" class="rounded-circle">
                            </a>
                            <ul class ="dropdown-menu text-small" aria-labelledby="dropUser" style>
                                <li>
                                    <a class="dropdown-item" href="#">Panel Usuario</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="../server/cerrar.php">Cerrar Sesión</a>
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
                    <button type="button" class="botonAjustes" onclick="location.href='partidasGuardadas.php'">Partidas guardadas  ></button>
                </div>
                <div class="row">
                    <button type="button" class="botonAjustes seleccionado" onclick="location.href='#'">Añadir partidas  ></button>
                </div>
                <div class="row">
                    <div class= "p-4 rounded bg-primary text-dark text-end">
                        <div class= "row">
                            <div class = "col-4">
                                <img src="../img/av1.png" class="imgRedonda p-1">
                            </div>
                            <div class = "col-8 text-white">
                                <h2><?php echo $user ?></h2>
                            </div>
                            <div class = "col-12 text-white text-end pt-3">
                                <h4>Puntos totales: <?php echo $puntosMostrar['SUM(puntos)'] ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class ="col-9">
                <div class="text-white rounded bg-dark">
                    <div class = "row p-5 text-center pb-0">
                        <?php if ($partida != null) : ?>
                            <h3>Edición de datos de la partida <?php echo $partida ?></h3>
                            <?php $_SESSION['partidaAct'] = $partida ?>
                        <?php else : ?>
                            <h3>Añadir una partida</h3>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['errorPartidaExiste'])) : ?>
                            <p class = "text-danger">Esa partida ya está registrada</p>
                        <?php endif; ?>
                    </div>
                    <form name="createUpdateData" action="server/createUpdateData.php" method="POST">
                        <div class = "row p-4 pb-0">
                            <div class = "col-4 text-end p-2">
                                <p class = "pb-0">ID de la partida:</p>
                            </div>
                            <div class = "col-6 px-5" id = "idPartida">
                                <?php if (!isset($_SESSION['numP'])) : ?>
                                    <input name = "actIDPartida" type="text" class="form-control" id="actIDPartida" placeholder="ej: FFFF0000" value=<?php echo $partida?>>
                                <?php else : ?>
                                    <input name = "actIDPartida" type="text" class="form-control" id="actIDPartida" placeholder="ej: FFFF0000" value=<?php echo $_SESSION['numP']?>>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class = "row p-4 pb-0">
                            <div class = "col-4 text-end p-2">
                                <p class = "pb-0">Mapa: </p>
                            </div>
                            <div class = "col-6 px-5 p-2">
                                <select id ="actMapa" name= "actMapa">
                                    <option value="The Pines" <?php if ($mapa == "The Pines" || $_SESSION['mapa'] == "The Pines") : ?> selected <?php endif; ?>>The Pines</option>
                                    <option value="Nuketown" <?php if ($mapa == "Nuketown" || $_SESSION['mapa'] == "Nuketown") : ?> selected <?php endif; ?>>Nuketown</option>
                                    <option value="Cartel" <?php if ($mapa == "Cartel" || $_SESSION['mapa'] == "Cartel") : ?> selected <?php endif; ?>>Cartel</option>
                                </select>
                            </div>
                        </div>
                        <div class = "row p-4 pb-0">
                            <div class = "col-4 text-end p-2">
                                <p class = "pb-0">Puntos:</p>
                            </div>
                            <div class = "col-6 px-5" id ="puntos">
                                <?php if (!isset($_SESSION['puntos'])) : ?>
                                    <input name = "actPuntos" type="text" class="form-control" id="actPuntos" placeholder="ej: 24000" value=<?php echo $puntos?>>
                                <?php else : ?>
                                    <input name = "actPuntos" type="text" class="form-control" id="actPuntos" placeholder="ej: 24000" value=<?php echo $_SESSION['puntos']?>>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class = "row p-4 pb-0">
                            <div class = "col-4 text-end p-2">
                                <p class = "pb-0">Bajas:</p>
                            </div>
                            <div class = "col-6 px-5" id ="bajas">
                                <?php if (!isset($_SESSION['bajas'])) : ?>
                                    <input name = "actBajas" type="text" class="form-control" id="actBajas" placeholder="ej: 15" value=<?php echo $bajas?>>
                                <?php else : ?>
                                    <input name = "actBajas" type="text" class="form-control" id="actBajas" placeholder="ej: 15" value=<?php echo $_SESSION['bajas']?>>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class = "row p-4 pb-0">
                            <div class = "col-4 text-end p-2">
                                <p class = "pb-0">Muertes:</p>
                            </div>
                            <div class = "col-6 px-5" id="muertes">
                                <?php if (!isset($_SESSION['muertes'])) : ?>
                                    <input name = "actMuertes" type="text" class="form-control" id="actMuertes" placeholder="ej: 7" value=<?php echo $muertes?>>
                                <?php else : ?>
                                    <input name = "actMuertes" type="text" class="form-control" id="actMuertes" placeholder="ej: 7" value=<?php echo $_SESSION['muertes']?>>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class ="row p-4 mx-5 float-end">
                            <div class = "col-4">
                                <?php if ($partida != null) : ?>
                                    <button type = "button" class = "btn btn-primary" onclick="comprobarDatosIntroducidos()">Actualizar</button>
                                <?php else : ?>
                                    <button type = "button" class = "btn btn-primary" onclick="comprobarDatosIntroducidos()">Añadir</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                    <div class ="row p-5 mx-5"></div>
                    <div class ="row p-3 mx-5"></div>
                </div>
            </div>
            </div>
                    <div class="my-3 my-md-3 bg-white"></div>
                    <div class="p-4 p-md-5 bg-white">
                        <div class="row">
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                    <img class="imgCuadrada" src="../img/fb1.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Compite contra otros jugadores</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="../img/fb2.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Participa en torneos exclusivos</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="../img/fb3.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Gana recompensas para el juego</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto mx-sm-0 col-8 col-sm-6 col-lg-3 my-lg-0 mb-3">
                                <div class="container bg-dark rounded p-0">
                                <img class="imgCuadrada" src="../img/fb4.png">
                                    <div class="container text-white p-2 text-center">
                                        <h3>Únete a tus amigos para ser invatibles</h3>
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
<?php
unset($_SESSION['errorActMail']);
unset($_SESSION['successActMail']);
unset($_SESSION['successActNum']);
unset($_SESSION['successActUser']);
unset($_SESSION['errorActUser']);
unset($_SESSION['successActContra']);
unset($_SESSION['errorPartidaExiste']);
unset($_SESSION['numP']);
unset($_SESSION['mapa']);
unset($_SESSION['bajas']);
unset($_SESSION['puntos']);
unset($_SESSION['muertes']);
unset($_SESSION['partidaAnt']);
?>