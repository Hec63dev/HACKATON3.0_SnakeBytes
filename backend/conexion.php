<?php
// $host = "localhost";
// $user = "u335201238_fulanito";
// $password = "Ertertertert45654g464677g4@";
// $bd = "u335201238_gencv";

$host = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "GenMyCV";

$conectar = mysqli_connect($host, $usuario, $contrasena, $basedatos);

if (!$conectar) {
  echo "No se pudo conectar con el servidor";
}
