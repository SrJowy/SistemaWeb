<?php
session_start();

$nombre = "";
$apellidos = "";
$dni = "";
$tel = "0";
$fecha = "";
$email = "";
$nombreUsuario="";
$contra = "";

$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$tel = $_POST['tel'];
$fecha = $_POST['fecha'];
$email = $_POST['email'];
$nombreUsuario = $_POST['username'];
$contra = $_POST['contra'];
$error = false;


$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario';";
$res = mysqli_query($db, $user_check_query);
$usuarioNombre = mysqli_fetch_assoc($res);

$user_check_query = "SELECT * FROM usuario WHERE email = '$email';";
$res = mysqli_query($db, $user_check_query);
$usuarioMail = mysqli_fetch_assoc($res);

if ($usuarioMail || $usuarioNombre) {
    $error = true;
    if ($usuarioMail) $_SESSION['errorMail'] = $email;
    if ($usuarioNombre) $_SESSION['errorUsername'] = $nombreUsuario;
}

if (!$error){
    $query = "INSERT INTO usuario VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$contra', '$nombreUsuario');";    
    $res = mysqli_query($db, $query);
    header('location: ../index.php');
} else {    
    header('location: ../registro.php');
}


?>



