<?php
session_start();

$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$nombre = $_POST['nombre'];
$contra = $_POST['pass'];

$encryptedPass = encriptar($contra);

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = ? AND contra = ?;";
$stmt = $db -> prepare($user_check_query);
$stmt -> bind_param("ss", $nombre, $encryptedPass);
$stmt -> execute();
$result = $stmt -> get_result();
$usuario = $result -> fetch_assoc();
$stmt-> close();

if ($usuario) {
    $_SESSION['username'] = $nombre;
    $_SESSION['success'] = "Hola, $nombre";
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + 60;
    $exito = 1;
    $sesion = "INSERT INTO sesion (nombreUsuario, exito) VALUES (?, ?)";
    $stmt = $db -> prepare($sesion);
    $stmt -> bind_param("si", $nombre, $exito);
    $stmt -> execute();
    $stmt-> close();
    header('location: ../index.php');
} else {
    $_SESSION['errUserContra'] = true;
    $exito = 0;
    $sesion = "INSERT INTO sesion (nombreUsuario, exito) VALUES (?, ?)";
    $stmt = $db -> prepare($sesion);
    $stmt -> bind_param("si", $nombre, $exito);
    $stmt -> execute();
    $stmt-> close();
    header('location: ../inicioSesion.php');
}

mysqli_close($db);

function encriptar($pass) {
    $salt = md5($pass);
    $encryptedPass = crypt($pass,$salt);
    return $encryptedPass;
}

?>