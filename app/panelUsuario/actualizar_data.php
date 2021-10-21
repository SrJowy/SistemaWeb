<?php

if (isset($_POST['actCorreo'])) {
    actualizarCorreo();
} elseif (isset($_POST['actNum'])) {
    actualizarTel();
} elseif (isset($_POST['actUsername'])) {
    actualizarNombreUsuario();
} elseif (isset($_POST['actContraNueva'])) {
    actualizarContra();
} elseif (isset($_POST['actNombre'])) {
    actualizarNombre();
} elseif (isset($_POST['actApellidos'])) {
    actualizarApellidos();
} elseif (isset($_POST['actFecha'])) {
    actualizarFecha();
} elseif (isset($_POST['actDni'])) {
    actualizarDni();
}

function actualizarCorreo() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $correo = $_POST['actCorreo'];
    $user_check_query = "SELECT * FROM usuario WHERE email = '$correo';";
    $res = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $_SESSION['errorActMail'] = true;
    } else {
        $query = "UPDATE usuario SET email = '$correo' WHERE nombreUsuario = '$nombreUsuario';";
        mysqli_query($db, $query);
        $_SESSION['successActMail'] = true;
    }
    header('location: cambiarDatos.php');

}

function actualizarTel() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $tel = $_POST['actNum'];
    $query = "UPDATE usuario SET telefono = '$tel' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActNum'] = true;
    header('location: cambiarDatos.php');
}

function actualizarNombreUsuario() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $NnombreUsuario = $_POST['actUsername'];
    $user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$NnombreUsuario';";
    $res = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $_SESSION['errorActUser'] = true;
    } else {
        $query = "UPDATE usuario SET nombreUsuario = '$NnombreUsuario' WHERE nombreUsuario = '$nombreUsuario';";
        mysqli_query($db, $query);
        $_SESSION['successActUser'] = true;
        $_SESSION['username'] = $NnombreUsuario;
    }
    header('location: cambiarDatos.php');
}

function actualizarContra() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $contraN = $_POST['actContraNueva'];
    $contraAct = $_POST['actContraAct'];
    $query = "UPDATE usuario SET contra = '$contraN' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActContra'] = true;
    header('location: cambiarDatos.php');
    
}

function actualizarNombre() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $nombre = $_POST['actNombre'];
    $query = "UPDATE usuario SET nombre = '$nombre' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActNombre'] = true;
    header('location: cambiarDatos.php');
    
}

function actualizarApellidos() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $apellidos = $_POST['actApellidos'];
    $query = "UPDATE usuario SET apellidos = '$apellidos' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActApellidos'] = true;
    header('location: cambiarDatos.php');
    
}

function actualizarFecha() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $fecha = $_POST['actFecha'];
    $query = "UPDATE usuario SET fecha_nac = '$fecha' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActFecha'] = true;
    header('location: cambiarDatos.php');
}

function actualizarDni() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'root', 'webapp');
    $dni = $_POST['actDni'];
    $query = "UPDATE usuario SET dni = '$dni' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActDni'] = true;
    header('location: cambiarDatos.php');
}

?>