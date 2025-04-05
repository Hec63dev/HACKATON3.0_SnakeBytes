<?php
require "./backend/conexion.php";

$correo = $_POST['correo'];
$sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
$resultado = mysqli_query($conectar, $sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Código de Verificación</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
      color: #333;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background-color: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      max-width: 400px;
      text-align: center;
    }
    .codigo {
      font-size: 24px;
      font-weight: bold;
      color: #225576;
      margin: 20px 0;
    }
    a {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: white;
      background-color: #225576;
      padding: 10px 20px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }
    a:hover {
      background-color: #1a3e59;
    }
    .error {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="card">
    <?php
    if (mysqli_num_rows($resultado) > 0) {
        session_start();
        $codigo = rand(100000, 999999);
        $_SESSION['codigo'] = $codigo;
        $_SESSION['correo'] = $correo;

        echo "<p>Hemos generado tu código de verificación:</p>";
        echo "<div class='codigo'>$codigo</div>";
        echo "<a href='verificar_codigo.php'>Continuar</a>";
    } else {
        echo "<p class='error'>❌ El correo ingresado no está registrado.</p>";
    }
    ?>
  </div>
</body>
</html>
