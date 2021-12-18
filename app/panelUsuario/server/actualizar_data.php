<?php

if (isset($_POST['actCorreo'])) { //Se comprueba que botón se ha pulsado y se ejecuta una función
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
} elseif (isset($_POST['actCuenta'])) {
    actualizarCuenta();
}

function actualizarCorreo() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $correo = htmlspecialchars($_POST['actCorreo']);
    $user_check_query = "SELECT * FROM usuario WHERE email = '$correo';";
    $res = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($res);

    if ($user) { //Si existe usuario con el correo introducido --> error
        $_SESSION['errorActMail'] = true;
    } else {
        $query = "UPDATE usuario SET email = ? WHERE nombreUsuario = ?;"; //Actualizamos el correo
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $correo, $nombreUsuario);
        $stmt -> execute();
        $stmt-> close();
        $_SESSION['successActMail'] = true;
    }
    header('location: ../cambiarDatos.php');

}

function actualizarTel() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $tel = htmlspecialchars($_POST['actNum']);
    $query = "UPDATE usuario SET telefono = ? WHERE nombreUsuario = ?;";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("is", $tel, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    $_SESSION['successActNum'] = true;
    header('location: ../cambiarDatos.php');
}

function actualizarNombreUsuario() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $NnombreUsuario = htmlspecialchars($_POST['actUsername']);
    $user_check_query = "SELECT * FROM usuario WHERE nombreUsuario = '$NnombreUsuario';";
    $res = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($res);

    if ($user) {
        $_SESSION['errorActUser'] = true;
    } else {
        $query = "UPDATE usuario SET nombreUsuario = ? WHERE nombreUsuario = ?;"; //Actualizamos el usuario
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $NnombreUsuario, $nombreUsuario);
        $stmt -> execute();
        $stmt-> close();
        $query = "UPDATE partida SET nombreUsuario = ? WHERE nombreUsuario = ?;"; //Actualizamos las partidas de ese usuario
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $NnombreUsuario, $nombreUsuario);
        $stmt -> execute();
        $stmt-> close();
        $_SESSION['successActUser'] = true;
        $_SESSION['username'] = $NnombreUsuario; //Cambiamos las variables de sesión
        $_SESSION['success'] = "Hola, $NnombreUsuario";
    }
    header('location: ../cambiarDatos.php');
}

function actualizarContra() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $contraN = htmlspecialchars($_POST['actContraNueva']);
    $contraAct = htmlspecialchars($_POST['actContraAct']);
    
    $query = "SELECT * FROM usuario WHERE nombreUsuario = '$nombreUsuario';";
    $res = mysqli_query($db, $query);
    $usuario = mysqli_fetch_assoc($res);

    $salt = $usuario['salt'];
    $encryptedPass = crypt($contraAct, $salt);

    if ($encryptedPass == $usuario['contra']) {
        $newEncryptedPass = crypt($contraN, $salt);
        $query = "UPDATE usuario SET contra = ? WHERE nombreUsuario = ?;";
        $stmt = $db -> prepare($query);
        $stmt -> bind_param("ss", $newEncryptedPass, $nombreUsuario);
        $stmt -> execute();
        $stmt-> close();
        mysqli_query($db, $query);
        $_SESSION['successActContra'] = true;
        header('location: ../cambiarDatos.php');
    } else {
        $_SESSION['errorActContra'] = true;
        header('location: ../cambiarDatos.php');
    }
    
    
}

function actualizarNombre() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $nombre = htmlspecialchars($_POST['actNombre']);
    $query = "UPDATE usuario SET nombre = ? WHERE nombreUsuario = ?;";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("ss", $nombre, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    mysqli_query($db, $query);
    $_SESSION['successActNombre'] = true;
    header('location: ../cambiarDatos.php');
    
}

function actualizarApellidos() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $apellidos = htmlspecialchars($_POST['actApellidos']);
    $query = "UPDATE usuario SET apellidos = ? WHERE nombreUsuario = ?;";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("ss", $apellidos, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    mysqli_query($db, $query);
    $_SESSION['successActApellidos'] = true;
    header('location: ../cambiarDatos.php');
    
}

function actualizarFecha() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $fecha = htmlspecialchars($_POST['actFecha']);
    $query = "UPDATE usuario SET fecha_nac = ? WHERE nombreUsuario = ?;";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("ss", $fecha, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    mysqli_query($db, $query);
    $_SESSION['successActFecha'] = true;
    header('location: ../cambiarDatos.php');
}

function actualizarDni() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');
    $dni = htmlspecialchars($_POST['actDni']);
    $query = "UPDATE usuario SET dni = ? WHERE nombreUsuario = ?;";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("ss", $dni, $nombreUsuario);
    $stmt -> execute();
    $stmt-> close();
    mysqli_query($db, $query);
    $_SESSION['successActDni'] = true;
    header('location: ../cambiarDatos.php');
}

function actualizarCuenta() {
    session_start();
    $nombreUsuario = $_SESSION['username'];
    $db = mysqli_connect('172.17.0.2:3306', 'admin', 'test', 'database');

    $salt_query = "SELECT salt FROM usuario WHERE nombreUsuario = '$nombreUsuario';";
    $res = mysqli_query($db, $salt_query);
    $salt = mysqli_fetch_assoc($res);

    $cuenta = htmlspecialchars($_POST['actCuenta']);
    $encryptedAccount = openssl_encrypt($cuenta,"AES-128-ECB",$salt['salt']);

    $query = "UPDATE usuario SET cuenta = ? WHERE nombreUsuario = '$nombreUsuario';";
    $stmt = $db -> prepare($query);
    $stmt -> bind_param("s", $encryptedAccount);
    $stmt -> execute();
    $stmt-> close();
    $_SESSION['successActAccount'] = true;
    header('location: ../cambiarDatos.php');
}

?>