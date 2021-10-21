<?php
session_start();
$nombreP = $_POST['partida'];
$username = $_SESSION['username'];
$db = mysqli_connect('172.17.0.2:3306', 'root', 'root', 'webapp');
$query = "DELETE FROM partida WHERE num_partida = '$nombreP' AND nombreUsuario = '$username';";
mysqli_query($db, $query);
header('location: ../partidasGuardadas.php');

?>