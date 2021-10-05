<?php
session_start();

$nombre = "";
$apellidos = "";
$dni = "";
$tel = "0";
$fecha = "";
$email = "";
$contra = "";

$db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$dni = $_POST['dni'];
$tel = $_POST['tel'];
$fecha = $_POST['fecha'];
$email = $_POST['email'];
$contra = $_POST['contra'];


$user_check_query = "SELECT * FROM usuario WHERE dni = '$dni';";
$res = mysqli_query($db, $user_check_query);
$usuario = mysqli_fetch_assoc($res);

    /*if ($dni) {
        if ($usuario['dni'] === $dni) {} //Completar más tarde
    }*/

//$contra_c = md5($contra);

$query = "INSERT INTO usuario VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$contra');";    
$res = mysqli_query($db, $query);
header('location: index.html');

?>