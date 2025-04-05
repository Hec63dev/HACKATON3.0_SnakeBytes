<?php
session_start();

// Conexión a la base de datos
$host = "localhost"; // Cambia esto si tu base de datos está en otro servidor
$user = "root"; // Reemplaza con tu usuario de MySQL
$pass = ""; // Reemplaza con tu contraseña de MySQL
$db = "chatbot_cv"; // Nombre de la base de datos

// Establecer la conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("❌ Error en la conexión: " . $conn->connect_error);
}

// API Key válida de OpenRouter
$apiKey = "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";  // Reemplaza esto con tu propia clave API

// Verificar si el mensaje ha sido enviado por el usuario
$userMessage = $_POST['text'] ?? '¡Hola! Soy tu asistente para ayudarte a crear tu CV. ¿Te gustaría comenzar proporcionando tu nombre?';  // Mensaje por defecto si no se recibe uno

// Inicializar el historial de la conversación si no existe
if (!isset($_SESSION['chat_history'])) {
    $_SESSION['chat_history'] = [];
}

// Agregar el mensaje del usuario al historial
$_SESSION['chat_history'][] = ["role" => "user", "content" => $userMessage];

// Configuración de la solicitud a la API
$data = [
    "model" => "anthropic/claude-3-haiku",  // Modelo válido y gratuito
    "messages" => array_merge(
        [["role" => "system", "content" => "Eres un asistente experto en creación de CVs. Ayuda al usuario a recopilar la información necesaria para crear un CV profesional."]], 
        $_SESSION['chat_history']  // Incluir todo el historial de la conversación
    ),
    "temperature" => 0.7  // Control de creatividad de la respuesta
];

// Cabeceras necesarias para la solicitud HTTP
$headers = [
    "Authorization: Bearer $apiKey",  // Asegúrate de que la clave esté correcta
    "Content-Type: application/json",  // El tipo de contenido es JSON
    "HTTP-Referer: https://tusitio.com",  // Reemplaza con el dominio de tu sitio
    "X-Title: MiBotPHP"  // Nombre de tu aplicación o bot
];

// Inicializar cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openrouter.ai/api/v1/chat/completions");  // Endpoint para crear chat completions
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Incluir cabeceras
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));  // Datos a enviar

// Ejecutar la solicitud y obtener la respuesta
$response = curl_exec($ch);

// Verificar si ocurrió algún error en la solicitud
if ($response === false) {
    echo "Error: " . curl_error($ch);
    curl_close($ch);
    exit;
}

// Cerrar la conexión cURL
curl_close($ch);

// Decodificar la respuesta JSON
$result = json_decode($response, true);

// Verificar si la respuesta contiene un mensaje válido
if (isset($result['choices'][0]['message']['content'])) {
    // Mostrar la respuesta del bot
    $botResponse = $result['choices'][0]['message']['content'];
    echo nl2br($botResponse);
    
    // Agregar la respuesta del bot al historial
    $_SESSION['chat_history'][] = ["role" => "assistant", "content" => $botResponse];

    // Guardar la pregunta del usuario en la base de datos
    $preguntaUsuario = $userMessage;  // La pregunta del usuario es el mensaje recibido

    // Insertar la pregunta en la base de datos
    $stmt = $conn->prepare("INSERT INTO respuestas_cv (pregunta) VALUES (?)");
    $stmt->bind_param("s", $preguntaUsuario);  // Se asegura de que sea un string
    $stmt->execute();
    $stmt->close();
} else {
    echo "❌ Error en la respuesta:<br><pre>";
    print_r($result);  // Mostrar error completo si no se obtiene respuesta válida
    echo "</pre>";
}

// Cerrar la conexión con la base de datos
$conn->close();
?>
