<?php
session_start();

$db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
$nombre = $_POST['nombre'];
$contra = $_POST['pass'];

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombre' AND contra = '$contra';";
$res = mysqli_query($db, $user_check_query);
$usuario = mysqli_fetch_assoc($res);

if ($usuario) {
    $_SESSION['username'] = $nombre;
    $_SESSION['success'] = "Hola, $nombre";
    header('location: index.php');
} else {
    $_SESSION['errUserContra'] = true;
    header('location: inicioSesion.php');
}



?>