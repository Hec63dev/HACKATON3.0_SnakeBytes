<?php
require "./backend/conexion.php";
session_start();

if (!isset($_SESSION["correo"])) {
    header("Location: recuperar.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_SESSION["correo"];
    $nueva = password_hash($_POST["nueva"], PASSWORD_DEFAULT);

    $sql = "UPDATE usuarios SET contrasenia = '$nueva' WHERE correo = '$correo'";
    if (mysqli_query($conectar, $sql)) {
        echo "✅ Contraseña actualizada.";
        session_destroy();
        echo "<br><a href='login.php'>Iniciar sesión</a>";
    } else {
        echo "❌ Error al actualizar.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="css/estilo_login.css">
</head>
<body>
  <div class="login-container">
    <div class="titulo">
      <h1>GenMyCV</h1>
    </div>
    <br>
    <form method="POST">
    <label>Nueva contraseña:</label>
    <input type="password" name="nueva" required>
    <button type="submit">Actualizar</button>
</form>

</body>
</html>