<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminPanel</title>
    <link rel="stylesheet" href="css/estilo_panel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .chat-container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      height: 60vh;
      display: flex;
      flex-direction: column;
    }
    .chat-box {
      flex: 1;
      overflow-y: auto;
      margin-bottom: 10px;
    }
    .message {
      padding: 10px;
      margin: 5px 0;
      border-radius: 8px;
      max-width: 80%;
    }
    .user {
      background: #d1e7dd;
      align-self: flex-end;
    }
    .bot {
      background: #f8d7da;
      align-self: flex-start;
    }
    form {
      display: flex;
    }
    input[type="text"] {
      flex: 1;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
    button {
      padding: 10px;
      border: none;
      background: #0d6efd;
      color: white;
      border-radius: 5px;
      margin-left: 10px;
      cursor: pointer;
    }
  </style>
</head>

<body>
    <?php
    require "encabezado.php";
    ?>

    </header>

    <main class="dashboard">
        <h2>Bienvenido(a)</h2>

        <div class="cards">
            <div class="chat-container">
                <h3>Asistente para Crear CV</h3>
                <div class="chat-box" id="chat-box">
                    <!-- Los mensajes del chat aparecerán aquí -->
                </div>

                <div class="input-container">
                    <input type="text" id="user-message" placeholder="Escribe tu mensaje..." required>
                    <button onclick="sendMessage()">Enviar</button>
                </div>
            </div>
        </div>

    </main>

    <script>
        function sendMessage() {
        const userMessage = document.getElementById('user-message').value;
        if (userMessage.trim() === '') return;

        // Añadir el mensaje del usuario al chat
        const chatBox = document.getElementById('chat-box');
        chatBox.innerHTML += `<div class="message user-message">${userMessage}</div>`;
        document.getElementById('user-message').value = '';

        // Enviar el mensaje al servidor
        fetch('chat.php', {
            method: 'POST',
            body: new URLSearchParams({
                'text': userMessage
            }),
        })
        .then(response => response.text())
        .then(data => {
            // Añadir la respuesta del bot al chat
            chatBox.innerHTML += `<div class="message bot-message">${data}</div>`;
            chatBox.scrollTop = chatBox.scrollHeight; // Desplazar hacia abajo
        })
        .catch(error => {
            chatBox.innerHTML += `<div class="message bot-message">Error al procesar tu mensaje.</div>`;
        });
    }

        // Enviar primer mensaje automáticamente
        window.addEventListener('load', async () => {
            const response = await fetch('chat.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    message: ""
                })
            });
            const data = await response.json();
            messages.innerHTML += `<div class="message bot"><strong>Bot:</strong> ${data.reply}</div>`;
        });
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