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
$nombre = htmlspecialchars($_POST['nombre']);
$apellidos = htmlspecialchars($_POST['apellidos']);
$dni = htmlspecialchars($_POST['dni']);
$tel = htmlspecialchars($_POST['tel']);
$fecha = htmlspecialchars($_POST['fecha']);
$email = htmlspecialchars($_POST['email']);
$nombreUsuario = htmlspecialchars($_POST['username']);
$contra = htmlspecialchars($_POST['contra']);
$cuenta = htmlspecialchars($_POST['cuenta_bancaria']);
$error = false;

$salt = md5($contra);
$encryptedPass = crypt($contra,$salt);
$encryptedAccount = openssl_encrypt($cuenta,"AES-128-ECB",$salt);

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
    $query = "INSERT INTO usuario VALUES (?,?,?,?,?,?,?,?,?,?);";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("sssissssss", $nombre, $apellidos, $dni, $tel, $fecha, $email, $encryptedPass, $encryptedAccount, $salt, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    header('location: ../index.php');

    
} else {    
    header('location: ../registro.php');
}

?>



