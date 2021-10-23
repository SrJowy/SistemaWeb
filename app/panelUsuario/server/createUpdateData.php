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

if ($partidaAct == null) {
    $query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP';";
    $res = mysqli_query($db,$query);
    $partida = mysqli_fetch_assoc($res);
    if ($partida) {
        $_SESSION['errorPartidaExiste'] = true;
        $_SESSION['numP'] = $numP;
        $_SESSION['mapa'] = $mapa;
        $_SESSION['puntos'] = $puntos;
        $_SESSION['bajas'] = $bajas;
        $_SESSION['muertes'] = $muertes;
        $_SESSION['partidaAnt'] = $partidaAct;
        header('location: ../modificar.php');
    } else {
        $query = "INSERT INTO partida VALUES ('$numP', '$mapa', '$puntos', '$bajas', '$muertes', '$username');";
        mysqli_query($db,$query);
        unset($_SESSION['errorPartidaExiste']);
        header('location: ../partidasGuardadas.php');
    }
} else {
    $query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP';";
    $res = mysqli_query($db,$query);
    $partida = mysqli_fetch_assoc($res);
    if ($partida) {
        $_SESSION['errorPartidaExiste'] = true;
        $_SESSION['numP'] = $numP;
        $_SESSION['mapa'] = $mapa;
        $_SESSION['puntos'] = $puntos;
        $_SESSION['bajas'] = $bajas;
        $_SESSION['muertes'] = $muertes;
        $_SESSION['partidaAnt'] = $partidaAct;
        header('location: ../modificar.php');
    } else {
        $query = "UPDATE partida SET num_partida = '$numP', mapa = '$mapa', puntos='$puntos', bajas = '$bajas', muertes = '$muertes' WHERE nombreUsuario = '$username' AND num_partida = '$partidaAct';";
        unset($_SESSION['errorPartidaExiste']);
        mysqli_query($db,$query);
        header('location: ../partidasGuardadas.php');
    }
}
?>