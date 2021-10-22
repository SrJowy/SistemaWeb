<?php
session_start();

$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$nombre = $_POST['nombre'];
$contra = $_POST['pass'];

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombre' AND contra = '$contra';";
$res = mysqli_query($db, $user_check_query);
$usuario = mysqli_fetch_assoc($res);

if ($usuario) {
    $_SESSION['username'] = $nombre;
    $_SESSION['success'] = "Hola, $nombre";
    header('location: ../index.php');
} else {
    $_SESSION['errUserContra'] = true;
    header('location: ../inicioSesion.php');
}



?>