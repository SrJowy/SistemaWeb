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
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Call of Stats</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='second.css'>
    <script src='bootstrap.bundle.js'></script>
    <script src='main.js'></script>
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
                            <a class="nav-link" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Novedades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Base de datos</a>
                        </li>
                    </ul>
                    <?php if (!isset($_SESSION['username'])) : ?>
                        <button onclick="location.href='inicioSesion.php'" type="button" class="btn btn-outline-dark me-2">Iniciar sesión</button>
                        <button onclick="location.href='registro.php'" type="button" class="btn btn-dark">Crear cuenta</button>
                    <?php endif ?>
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class= "dropdown me-5">
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
            <div class="p-4 mb-4 text-white rounded bg-dark">
                <div class = "row">
                    <h3>Panel del usuario</h3>
                </div>
            </div>
                <div class="p-4 text-white rounded bg-dark">
                    <div class = "row">
                        <div class="col-4">
                            <div class="row">
                            <button type="button" class="botonAjustes bbtm">Actualizar datos  ></button>
                            </div>
                            <div class="row">
                            <button type="button" class="botonAjustes bbtm">Partidas guardadas  ></button>
                            </div>
                            <div class="row">
                            <button type="button" class="botonAjustes bbtm">Añadir partidas  ></button>
                            </div>
                            <div class="row">
                            <button type="button" class="botonAjustes bbtm">Puntos  ></button>
                            </div>
                            <div class="row">
                            <button type="button" class="botonAjustes">Actualizar datos  ></button>
                            </div>
                        </div>
                        <div class ="col-12 col-lg-8 mt-3 mt-lg-0">
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end">
                                    <p>Nombre: </p>
                                </div>
                                <div class="col-lg-3 text-start ps-5">
                                    <?php 
                                    echo $usuario['nombre'];
                                    ?>
                                </div>
                                <div class="col-lg-1 text-end">
                                    <p>Apellidos: </p>
                                </div>
                                <div class="col-lg-4 text-start ps-5">
                                    <?php 
                                    echo $usuario['apellidos'];
                                    ?>
                                </div>
                            </div>
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end">
                                    <p>Fecha de nacimiento: </p>
                                </div>
                                <div class="col-lg-3 text-start ps-5">
                                    <?php 
                                    echo $usuario['fecha_nac'];
                                    ?>
                                </div>
                                <div class="col-lg-1 text-end">
                                    <p>DNI:  </p>
                                </div>
                                <div class="col-lg-4 text-start ps-5">
                                    <?php 
                                    echo $usuario['dni'];
                                    ?>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-lg-4 text-end">
                                    <p>Correo electrónico: </p>
                                </div>
                                <div class="col-lg-8 ps-5 text-start">
                                    <?php
                                    echo $usuario['email'];
                                    ?>
                                </div>
                            </div>
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end p-2">
                                    <p>Nuevo correo electrónico: </p>
                                </div>
                                <div class="col-lg-4 ps-5 text-start" id = "correo">
                                    <form name= "actCorreo" action="actualizar_data.php" method="POST">
                                        <input name = "actCorreo" type="email" class="form-control" id="actCorreo">
                                    </form>
                                        <?php if (isset($_SESSION['errorActMail'])) : ?>
                                            <p class= 'text-danger'>El correo ya está registrado</p>
                                        <?php elseif (isset($_SESSION['successActMail'])) : ?>
                                            <p class='text-success'>Se cambiado el correo</p>
                                        <?php endif ?>
                                    </form>
                                </div>
                                <div class = "col-lg-4">
                                    <button name = "corBot" type="button" class= "btn btn-primary" onclick="comprobarCorreo()"> Actualizar correo</button>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-lg-4 text-end">
                                    <p>Nombre de usuario:  </p>
                                </div>
                                <div class="col-lg-8 ps-5 text-start">
                                    <?php
                                    echo $usuario['nombreUsuario'];
                                    ?>
                                </div>
                            </div>
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end p-2">
                                    <p>Nuevo nombre de usuario: </p>
                                </div>
                                <div class="col-lg-4 ps-5 text-start" id = "nomUsuario">
                                    <form name= "actUsername" action="actualizar_data.php" method="POST">
                                        <input name = "actUsername" type="text" class="form-control" id="actUsername">
                                    </form>
                                        <?php if (isset($_SESSION['errorActUser'])) : ?>
                                            <p class= 'text-danger'>El nombre de usuario no está disponible</p>
                                        <?php elseif (isset($_SESSION['successActUser'])) : ?>
                                            <p class='text-success'>Se cambiado el nombre de usuario</p>
                                        <?php endif ?>
                                </div>
                                <div class = "col-lg-4">
                                    <button name = "corBot" type="button" class= "btn btn-primary" onclick="comprobarNombreUsuario()"> Actualizar nombre de usuario</button>
                                </div>
                            </div>
                            <div class = "row">
                                <div class="col-lg-4 text-end">
                                    <p>Número de teléfono:  </p>
                                </div>
                                <div class="col-lg-8 ps-5 text-start">
                                    <?php
                                    echo $usuario['telefono'];
                                    ?>
                                </div>
                            </div>
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end p-2">
                                    <p>Nuevo teléfono:  </p>
                                </div>
                                <div class="col-lg-4 ps-5 text-start" id = "tlf">
                                    <form name= "actNum" action="actualizar_data.php" method="POST">
                                        <input name = "actNum" type="tel" class="form-control" id="actNum">
                                    </form>
                                        <?php if (isset($_SESSION['successActNum'])) : ?>
                                            <p class= 'text-success'>El teléfono se ha actualizado</p>
                                        <?php endif ?>
                                </div>
                                <div class = "col-lg-4">
                                    <button name = "numBot" type="button" class= "btn btn-primary" onclick="comprobarNumero()"> Actualizar teléfono</button>
                                </div>
                            </div>
                            <div class = "row">
                            <div class="col-lg-12 text-center p-2">
                                <p>Cambiar contraseña</p>
                            </div>
                            </div>
                            <div class = "row mb-2">
                                <div class="col-lg-4 text-end p-2">
                                    <p>Contraseña actual: </p>
                                </div>
                                <div class="col-lg-4 ps-5 text-start" id = "contraAct">
                                    <form name= "actContraAct" action="actualizar_data.php" method="POST">
                                        <input name = "actContraAct" type="password" class="form-control" id="actContraAct">
                                    </form>
                                </div>
                            </div>
                            <div class = "row mb-4">
                                <div class="col-lg-4 text-end p-2">
                                    <p>Nueva contraseña: </p>
                                </div>
                                <div class="col-lg-4 ps-5 text-start" id = "contraNueva">
                                    <form name= "actContraNueva" action="actualizar_data.php" method="POST">
                                        <input name = "actContraNueva" type="password" class="form-control" id="actContraNueva">
                                    </form>
                                        <?php if (isset($_SESSION['successActContra'])) : ?>
                                            <p class= 'text-success'>La contraseña se ha actualizado</p>
                                        <?php endif ?>
                                </div>
                                <div class = "col-lg-4">
                                    <button name = "contraBot" type="button" class= "btn btn-primary" onclick="comprobarContra()"> Actualizar contraseña</button>
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