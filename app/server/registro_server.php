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

$encryptedPass = encriptar($contra);

$user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = ?;";
$stmt = $db -> prepare($user_check_query);
$stmt -> bind_param("s", $nombreUsuario);
$stmt -> execute();
$result = $stmt -> get_result();
$usuarioNombre = $result -> fetch_assoc();
$stmt-> close();

$user_check_query = "SELECT * FROM usuario WHERE email = ?;";
$stmt = $db -> prepare($user_check_query);
$stmt -> bind_param("s", $email);
$stmt -> execute();
$result = $stmt -> get_result();
$usuarioMail = $result -> fetch_assoc();
$stmt-> close();

if ($usuarioMail || $usuarioNombre) {
    $error = true;
    if ($usuarioMail) $_SESSION['errorMail'] = $email;
    if ($usuarioNombre) $_SESSION['errorUsername'] = $nombreUsuario;
}

if (!$error){
    $query = "INSERT INTO usuario VALUES (?,?,?,?,?,?,?,?);";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("sssissss", '$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$encryptedPass', '$nombreUsuario');
    $stmt -> execute();
    $stmt-> close();
    $res = mysqli_query($db, $query);
    header('location: ../index.php');

    
} else {    
    header('location: ../registro.php');
}

function encriptar($pass) {
    $salt = md5($pass);
    $encryptedPass = crypt($pass,$salt);
    return $encryptedPass;
}

?>



