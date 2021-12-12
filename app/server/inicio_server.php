<?php
session_start();

$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$nombre = $_POST['nombre'];
$contra = $_POST['pass'];

$encryptedPass = encriptar($contra);

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombre' AND contra = '$encryptedPass';";
$res = mysqli_query($db, $user_check_query);
$usuario = mysqli_fetch_assoc($res);

if ($usuario) {
    $_SESSION['username'] = $nombre;
    $_SESSION['success'] = "Hola, $nombre";
<<<<<<< HEAD
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + 60;
=======
>>>>>>> 6e48e185b992195f26fe102e249ffec9e5c72fa0
    $exito = 1;
    $sesion = "INSERT INTO sesion (nombreUsuario, exito) VALUES ('$nombre', '$exito')";
    mysqli_query($db, $sesion);
    header('location: ../index.php');
} else {
    $_SESSION['errUserContra'] = true;
    $exito = 0;
    $sesion = "INSERT INTO sesion (nombreUsuario, exito) VALUES ('$nombre', '$exito')";
    mysqli_query($db, $sesion);
    header('location: ../inicioSesion.php');
}

mysqli_close($db);

function encriptar($pass) {
    $salt = md5($pass);
    $encryptedPass = crypt($pass,$salt);
    return $encryptedPass;
}

?>