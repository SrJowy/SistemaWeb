<?php
session_start();

$db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
$nombre = $_POST['nombre'];
$contra = $_POST['pass'];

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombre' AND contra = '$contra';";
$res = mysqli_query($db, $user_check_query);
$usuario = mysqli_fetch_assoc($res);

$_SESSION['username'] = $nombre;
$_SESSION['success'] = "Hola, $nombre";
header('location: index.php');

?>