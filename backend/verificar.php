<?php

require "conexion.php";

$correo = addslashes($_POST['correo']);
$contrasenia = addslashes($_POST['contrasenia']);

$comparar = "SELECT * FROM usuarios WHERE correo = '$correo' LIMIT 1";
$resultado = mysqli_query($conectar, $comparar);

if (mysqli_num_rows($resultado) > 0) {
    $fila = $resultado->fetch_array();

    if (password_verify($contrasenia, $fila["contrasenia"])) {
        session_start();
        $_SESSION["username"] = $correo;
        $_SESSION["autentificar"] = "SI";
        header("Location: ../panel_administrativo.php");
        exit();
    } else {
        header("Location: ../login.php?errorusuario=SI");
        exit();
    }
} else {
    // Usuario no encontrado
    header("Location: ../login.php?errorusuario=SI");
    exit();
}

mysqli_free_result($resultado);
mysqli_close($conectar);
