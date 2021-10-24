<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='css/second.css'>
    <link rel="icon" href='img/logo.ico' type ='image/x-icon'>
    <script src='js/bootstrap.bundle.js'></script>
    <script src='js/main.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Registro</h1>
    </div>
        <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name="reg" action="server/registro_server.php" method="POST">
                <div id="c1" class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input name = "nombre" type="text" class="form-control" id="controlName" placeholder = "ej: Antonio">
                </div>
                <div id = "c2" class="mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input name= "apellidos" type="text" class="form-control" id="controlSurname" placeholder = "ej: Pérez Gómez">
                </div>
                <div id = "c3" class="mb-3">
                    <label for="id" class="form-label">DNI</label>
                    <input name = "dni" type="text" class="form-control" id="controlDNI" placeholder = "ej: 11111111Z">
                </div>
                <div id = "c4" class="mb-3">
                    <label for="tel" class="form-label">Teléfono</label>
                    <input name = "tel" type="tel" class="form-control" id="controlTel" placeholder = "ej: 660066006">
                </div>
                <div id = "c5" class="mb-3">
                    <label for="date" class="form-label">Fecha de nacimiento</label>
                    <input name = "fecha" type="date" class="form-control" id="controlFecha">
                </div>
                <div id = "c6" class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input name = "email" type="email" class="form-control" id="controlEmail" placeholder = "ej: ejemplo@gmail.com">
                </div>
                <div id = "c7" class="mb-3">
                    <label for="usern" class="form-label">Nombre de usuario</label>
                    <input name= "username" type="text" class="form-control" id="controlUsername" placeholder = "ej: AnttonPer3">
                </div>
                <div id = "c8" class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "contra" type="password" class="form-control" id="controlPass">
                </div>
                <?php if (isset($_SESSION['errorUsername'])) : ?>
                    <p class="text-danger" id="errUsername">El nombre de usuario ya está elegido</p>
                <?php endif; ?>
                <?php if (isset($_SESSION['errorMail'])) : ?>
                    <p class="text-danger" id="errMail">El correo electrónico ya está registrado</p>
                <?php endif; ?>
                <button type="button" class= "btn btn-primary" onclick="comprobardatos()"> Enviar</button>
            </form>
        </div>
        <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="index.php"> < Volver a inicio</a>
        </div>
</body>
</html>
<?php
unset($_SESSION['errorUsername']);
unset($_SESSION['errorMail']);
?>