<?php
session_start();
if (!isset($_SESSION['codigo'])) {
    header("Location: recuperar.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["codigo"] == $_SESSION["codigo"]) {
        header("Location: nueva_contrasena.php");
        exit();
    } else {
        echo "❌ Código incorrecto.";
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
    <label>Introduce el código que se te dio:</label>
    <input type="text" name="codigo" required>
    <button type="submit">Verificar</button>
</form>
  </div>
</body>
</html>
