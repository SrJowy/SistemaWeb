<?php 
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Inicio de sesión</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='second.css'>
    <script src='bootstrap.bundle.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Iniciar sesión</h1>
    </div>
        <div class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name = "inic" action= "inicio_server.php" method="POST">
                <div class="mb-3">
                    <label for="user" class="form-label">Usuario</label>
                    <input name = "nombre" type="text" class="form-control" id="controlUser">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "pass" type="password" class="form-control" id="controlPass">
                </div>
                <?php if (isset($_SESSION[errUserContra])) : ?>
                    <p class="text-danger" id="errUsername">El correo o contraseña no son correctos</p>
                <?php endif; ?>
                <button type="submit" class= " btn btn-primary "> Enviar</button>
            </form>
        <p class="mt-4 mb-0">¿No estás registrado aún? <a href="registro.php">Únete</a></p>
        </div>
        <div class="contenedorRegistro margenVolver">
            <a class="textLinks" href="index.php"> < Volver a inicio</a>
        </div>
</body>
</html>
<?php
unset($_SESSION[errUserContra]);
?>