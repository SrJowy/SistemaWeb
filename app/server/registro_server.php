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

<<<<<<< HEAD
$encryptedPass = encriptar($contra);
=======
$contra_split = str_split($contra);
$mayus = False;
$minus = False;
$num = False;
$extra = False;
$errorContra = False;
foreach ($contra_split as &$char) {
    if (48<=ord($char)<=57){
        $num = True;
    } elseif (65<=ord($char)<=90) {
        $mayus = True; 
    } elseif (97<=ord($char)<=122) {
        $minus = True;
    } elseif (33<=ord($char)<=47 || 58<=ord($char)<=64 || 91<=ord($char)<=96 || 123<=ord($char)<=126) {
        $extra = True;
    } else {
        $errorContra = True;
    }
}
>>>>>>> 6e48e185b992195f26fe102e249ffec9e5c72fa0

if (strlen($contra)<8) {
    //error la contraseña debe tener al menos 8 caracteres
} elseif ( !$num || !$mayus || !$minus || !$extra || $errorContra ){
    //error la contraseña debe de tener al menos un número, una minuscula, una mayúscula y un caracter no alfanúmerico
} else {
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

<<<<<<< HEAD
if (!$error){
    $query = "INSERT INTO usuario VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$encryptedPass', '$nombreUsuario');";    
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

=======
    if (!$error){
        $query = "INSERT INTO usuario VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$contra', '$nombreUsuario');";    
        $res = mysqli_query($db, $query);
        header('location: ../index.php');
    } else {    
        header('location: ../registro.php');
    }
}

>>>>>>> 6e48e185b992195f26fe102e249ffec9e5c72fa0
?>



