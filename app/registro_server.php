<script src='main.js'></script>
<?php
session_start();
unset($_SESSION['errorUsername']);

$nombre = "";
$apellidos = "";
$dni = "";
$tel = "0";
$fecha = "";
$email = "";
$nombreUsuario="";
$contra = "";

$db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
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
$usuario = mysqli_fetch_assoc($res);

if ($usuario) {
    $error = true;
}

if (!$error){
    $query = "INSERT INTO usuario VALUES ('$nombre', '$apellidos', '$dni', '$tel', '$fecha', '$email', '$contra', '$nombreUsuario');";    
    $res = mysqli_query($db, $query);
    header('location: index.php');
} else {
    //echo '<script type="text/javascript"> errorDatos(); </script>';
    $_SESSION['errorUsername'] = $nombreUsuario;
    header('location: registro.php');
}


?>



