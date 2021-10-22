<?php
session_start();
$username = $_SESSION['username'];
$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$partidaAct = $_SESSION['partidaAct'];
$numP = $_POST['actIDPartida'];
$mapa = $_POST['actMapa'];
$puntos = $_POST['actPuntos'];
$bajas = $_POST['actBajas'];
$muertes = $_POST['actMuertes'];

$query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP';";
$res = mysqli_query($db,$query);
$partida = mysqli_fetch_assoc($res);

if ($partida) {
    $query = "UPDATE partida SET num_partida = '$numP', mapa = '$mapa', puntos='$puntos', bajas = '$bajas', muertes = '$muertes' WHERE nombreUsuario = '$username' AND num_partida = '$partidaAct';";
} else {
    $query = "INSERT INTO partida VALUES ('$numP', '$mapa', '$puntos', '$bajas', '$muertes', '$username');";
}
mysqli_query($db,$query);
header('location: ../partidasGuardadas.php');
?>