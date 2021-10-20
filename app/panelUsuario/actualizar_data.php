<?php

if (isset($_POST['actCorreo'])) {
    actualizarCorreo();
} elseif (isset($_POST['actNum'])) {
    actualizarTel();
} elseif (isset($_POST['actUsername'])) {
    actualizarNombreUsuario();
} elseif (isset($_POST['actContraNueva'])) {
    actualizarContra();
}

function actualizarCorreo() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
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
    $db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
    $tel = $_POST['actNum'];
    $query = "UPDATE usuario SET telefono = '$tel' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActNum'] = true;
    header('location: cambiarDatos.php');
}

function actualizarNombreUsuario() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
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
    $db = mysqli_connect('localhost', 'root', 'f34HJ5L8.', 'webapp');
    $contraN = $_POST['actContraNueva'];
    $contraAct = $_POST['actContraAct'];
    $query = "UPDATE usuario SET contra = '$contraN' WHERE nombreUsuario = '$nombreUsuario';";
    mysqli_query($db, $query);
    $_SESSION['successActContra'] = true;
    header('location: cambiarDatos.php');
    
}
?>