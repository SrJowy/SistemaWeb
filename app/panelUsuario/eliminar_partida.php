<?php
session_start();
$nombreP = $_POST['partida'];
$username = $_SESSION['username'];
$db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
$query = "DELETE FROM partida WHERE num_partida = '$nombreP' AND nombreUsuario = '$username';";
mysqli_query($db, $query);
header('location: partidasGuardadas.php');

?>