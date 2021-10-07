<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Registro</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <link rel='stylesheet' type='text/css' media='screen' href='second.css'>
    <script src='bootstrap.bundle.js'></script>
    <script src='main.js'></script>
</head>
<body>
    <div class= "container text-center mt-5">
        <h1>Registro</h1>
    </div>
        <div id="princ" class = "contenedorRegistro margenRegistro p-5 bordeRegistro rounded-3">
            <form name="reg" action="registro_server.php" method="POST">
                <div id="c1" class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input name = "nombre" type="text" class="form-control" id="controlName">
                </div>
                <div id = "c2" class="mb-3">
                    <label for="surnames" class="form-label">Apellidos</label>
                    <input name= "apellidos" type="text" class="form-control" id="controlSurname">
                </div>
                <div id = "c3" class="mb-3">
                    <label for="id" class="form-label">DNI</label>
                    <input name = "dni" type="text" class="form-control" id="controlDNI">
                </div>
                <div id = "c4" class="mb-3">
                    <label for="tel" class="form-label">Teléfono</label>
                    <input name = "tel" type="tel" class="form-control" id="controlTel">
                </div>
                <div id = "c5" class="mb-3">
                    <label for="date" class="form-label">Fecha de nacimiento</label>
                    <input name = "fecha" type="date" class="form-control" id="controlFecha">
                </div>
                <div id = "c6" class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input name = "email" type="email" class="form-control" id="controlEmail">
                </div>
                <div id = "c7" class="mb-3">
                    <label for="usern" class="form-label">Nombre de usuario</label>
                    <input name= "username" type="text" class="form-control" id="controlUsername">
                </div>
                <div id = "c8" class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input name = "contra" type="password" class="form-control" id="controlPass">
                </div>
                <button type="button" class= "btn btn-primary" onclick="comprobardatos()"> Enviar</button>
            </form>
        </div>
</body>
</html>