<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generador de CV con IA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f1f2f6, #dbeafe);
            color: #333;
        }
        header {
            background: rgb(2,0,36);
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(34,85,118,1) 35%, rgba(0,212,255,1) 100%);
            padding: 20px;
            text-align: center;
            color: white;
        }
        header h1 {
            font-size: 2.5em;
        }
        .hero {
    position: relative;
    background-image: url('imagenes/slide.jpeg');
    background-size: cover;
    background-position: center;
    padding: 60px 20px;
    color: white;
    text-align: center;
    z-index: 1;
}

.hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Fondo oscuro con 50% opacidad */
    z-index: -1;
}

        .hero h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .hero p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }
        .hero button {
            padding: 15px 30px;
            background-color: #0d6efd;
            border: none;
            color: white;
            font-size: 1em;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .hero button:hover {
            background-color: #084298;
        }
        .features {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 40px 20px;
            background-color: white;
        }
        .feature {
            max-width: 300px;
            margin: 20px;
            padding: 20px;
            border-radius: 12px;
            background-color: #f1f5f9;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            text-align: center;
        }
        .feature h3 {
            margin-bottom: 10px;
        }
        footer {
            background: rgb(2,0,36);
background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(115,32,84,1) 35%, rgba(0,212,255,1) 100%);
            text-align: center;
            padding: 15px;
            color: white;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Generador Inteligente de CV</h1>
    </header>

    <section class="hero">
        <h2>¡Crea tu CV profesional en minutos!</h2>
        <p>Con nuestro chatbot inteligente, responde preguntas clave y genera tu currículum al instante.</p>
        <button onclick="location.href='login.php'">Comenzar Ahora</button>
    </section>

    <section class="features">
        <div class="feature">
            <h3>Asistente por Chat</h3>
            <p>Un chatbot interactivo te guiará paso a paso para recolectar tu información.</p>
        </div>
        <div class="feature">
            <h3>Plantillas Profesionales</h3>
            <p>Elige entre múltiples estilos para tu CV y personalízalo según tu perfil.</p>
        </div>
        <div class="feature">
            <h3>Exportación Rápida</h3>
            <p>Descarga tu CV en PDF o envíalo por correo directamente desde la app.</p>
        </div>
    </section>

    <footer>
        &copy; 2025 Generador de CV | Desarrollado por TuEquipo
    </footer>
</body>
</html>
