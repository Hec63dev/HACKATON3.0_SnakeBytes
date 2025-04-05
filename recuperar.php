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
        <form action="enviar_codigo.php" method="POST">
            <label>Ingresa tu correo:</label>
            <input type="email" name="correo" required>
            <button type="submit">Enviar código</button>
        </form>
    </div>
</body>

</html>