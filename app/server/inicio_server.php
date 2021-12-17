<?php
session_start();

$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$nombre = htmlspecialchars($_POST['nombre']);
$contra = htmlspecialchars($_POST['pass']);

$salt = md5($contra);
$encryptedPass = crypt($contra,$salt);

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
    $_SESSION['expira'] = 60;
    $_SESSION['ult_actividad'] = time();
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

?>