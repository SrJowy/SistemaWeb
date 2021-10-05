<?php
session_start();

$nombre = "";
$apellidos = "";
$dni = "";
$tel = "0";
$fecha = "";
$email = "";
$contra = "";

$db = msqli_connect('localhost', 'root', 'f34HJ5L8.', 'webserver');

if (isset($_POST['reg'])) {
    $nombre = mysql_real_escape_string($db, $_GET['nombre']);
    $apellidos = mysql_real_escape_string($db, $_GET['apellidos']);
    $dni = mysql_real_escape_string($db, $_GET['dni']);
    $tel = mysql_real_escape_string($db, $_GET['tel']);
    $fecha = mysql_real_escape_string($db, $_GET['fecha']);
    $email = mysql_real_escape_string($db, $_GET['email']);
    $contra = mysql_real_escape_string($db, $_GET['contra']);


    $user_check_query = "SELECT * FROM usuario WHERE dni = '$dni';";
    $res = mysqli_query($db, $user_check_query);
    $usuario = mysqli_fetch_assoc($res);

    /*if ($dni) {
        if ($usuario['dni'] === $dni) {} //Completar más tarde
    }*/

    $contra_c = md5($contra);

    $query = "INSERT INTO usuario (nombre, apellidos, dni, telefono, fecha_nac, email, contra)
            VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$contra');";
    mysqli_query($db, $query);
    header('location: index.html');

}