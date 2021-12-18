<?php
session_start();
$username = $_SESSION['username'];
$db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
$partidaAct = $_SESSION['partidaAct'];
$numP = htmlspecialchars($_POST['actIDPartida']);
$mapa = htmlspecialchars($_POST['actMapa']);
$puntos = htmlspecialchars($_POST['actPuntos']);
$bajas = htmlspecialchars($_POST['actBajas']);
$muertes = htmlspecialchars($_POST['actMuertes']);

if ($partidaAct == null) { //Si no existe partida actual --> Creando partida nueva
    $query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP';";
    $res = mysqli_query($db,$query);
    $partida = mysqli_fetch_assoc($res);
    if ($partida) { //Si existe partida con el código introducido --> error
        $_SESSION['errorPartidaExiste'] = true;
        $_SESSION['numP'] = $numP; //Enviamos de vuelta los datos introducidos previamente
        $_SESSION['mapa'] = $mapa;
        $_SESSION['puntos'] = $puntos;
        $_SESSION['bajas'] = $bajas;
        $_SESSION['muertes'] = $muertes;
        $_SESSION['partidaAnt'] = $partidaAct;
        header('location: ../modificar.php');
    } else {
        $query = "INSERT INTO partida VALUES (?,?,?,?,?,?);";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ssiiis", $numP, $mapa, $puntos, $bajas, $muertes, $username);
        $stmt -> execute();
        $stmt-> close();
        unset($_SESSION['errorPartidaExiste']);
        header('location: ../partidasGuardadas.php');
    }
} else { //Si existe partida actual --> Editando partida
    $query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP';";
    $res = mysqli_query($db,$query);
    $partida = mysqli_fetch_assoc($res);
    if ($partida) { //Si existe partida con el código introducido --> buscar si se han hecho cambios
        $query = "SELECT * FROM partida WHERE nombreUsuario = '$username' AND num_partida = '$numP' AND mapa = '$mapa' AND bajas = '$bajas' AND puntos = '$puntos' AND muertes = '$muertes';";
        $res = mysqli_query($db, $query);
        $partida = mysqli_fetch_assoc($res);
        if ($partida) { //Si no existen cambios --> error
            $_SESSION['errorPartidaExiste'] = true;
            $_SESSION['numP'] = $numP;  //Enviamos de vuelta todos los datos ya introducidos previamente
            $_SESSION['mapa'] = $mapa;
            $_SESSION['puntos'] = $puntos;
            $_SESSION['bajas'] = $bajas;
            $_SESSION['muertes'] = $muertes;
            $_SESSION['partidaAnt'] = $partidaAct;
            header('location: ../modificar.php');
        } elseif ($partidaAct == $numP) { //Si se han hecho cambios --> actualizar datos partida
            $query = "UPDATE partida SET num_partida = ?, mapa = ?, puntos= ?, bajas = ?, muertes = ? WHERE nombreUsuario = ? AND num_partida = ?;";
            $stmt = $db -> prepare($query);
            $stmt -> bind_param("ssiiiss", $numP, $mapa, $puntos, $bajas, $muertes, $username, $partidaAct);
            $stmt -> execute();
            $stmt-> close();
            unset($_SESSION['errorPartidaExiste']);
            header('location: ../partidasGuardadas.php');
        } else {
            $_SESSION['errorPartidaExiste'] = true;
            $_SESSION['numP'] = $numP;  //Enviamos de vuelta todos los datos ya introducidos previamente
            $_SESSION['mapa'] = $mapa;
            $_SESSION['puntos'] = $puntos;
            $_SESSION['bajas'] = $bajas;
            $_SESSION['muertes'] = $muertes;
            $_SESSION['partidaAnt'] = $partidaAct;
            header('location: ../modificar.php');
        }
    } else { //Si la partida no existe --> actualizar partida con datos nuevos (nuevo códido de partida)
        $query = "UPDATE partida SET num_partida = ?, mapa = ?, puntos= ?, bajas = ?, muertes = ? WHERE nombreUsuario = ? AND num_partida = ?;";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ssiiiss", $numP, $mapa, $puntos, $bajas, $muertes, $username, $partidaAct);
        $stmt -> execute();
        $stmt-> close();
        unset($_SESSION['errorPartidaExiste']);
        header('location: ../partidasGuardadas.php');
    }
}
?>