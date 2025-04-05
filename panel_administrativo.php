<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPanel</title>
    <link rel="stylesheet" href="css/estilo_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <header class="nav-bar">
        <figure class="logo">
            <img src="imagenes/GenMyCV-r.png" alt="">
        </figure>

        <!-- Menú -->
        <nav class="menu">
            <ul class="nav-menu" id="contenedormenu">
                <a href="#" class="cerrar-menu" id="cerrarMenu"><i class="fas fa-times"></i></a>
                <li><a href="#"><i class="fa fa-house"></i> <span>Inicio</span></a></li>
                <li><a href="#"><i class="fa fa-file-alt"></i> <span>Mis CV's</span></a></li>
                <li><a href="#"><i class="fa fa-user"></i> <span>Mi Perfil</span></a></li>
                <li><a href="./backend/salir.php"><i class="fa fa-sign-out-alt"></i> <span>Cerrar Sesión</span></a></li>
            </ul>
        </nav>

        <!-- Ícono hamburguesa -->
        <a href="#" id="iconomenu" class="btn_bar"><i class="fa-solid fa-bars"></i></a>
    </header>


    <a href="#" id="iconomenu" class="btn_bar"><i class="fa-solid fa-bars"></i></a>

    </header>

    <main class="dashboard">
        <h2>Bienvenido(a)</h2>

        <div class="cards">
            <div class="card">
                <p>Total de CVs</p>
                <h3>12</h3>
                <small>+2 desde el mes pasado</small>
            </div>
        </div>

    </main>
    <script>
        $("#iconomenu").click(function() {
            $("#contenedormenu").toggleClass("abrir_menu");
        });

        $(".btn-ancla").click(function() {
            $("#contenedormenu").removeClass("abrir_menu");
        });
        $("#cerrarMenu").click(function() {
            $("#contenedormenu").removeClass("abrir_menu");
        });
    </script>
</body>

</html>