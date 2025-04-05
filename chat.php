<?php
include "conexiont.php";

$apiKey = "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";  // Reemplaza con tu API Key real
$userMessage = $_POST['text'] ?? '';

session_start();
if (!isset($_SESSION['historial'])) $_SESSION['historial'] = [];

array_push($_SESSION['historial'], ["role" => "user", "content" => $userMessage]);

$data = [
    "model" => "anthropic/claude-3-haiku",
    "messages" => array_merge(
        [["role" => "system", "content" => "Eres un asistente para ayudar a crear un CV. Realiza preguntas paso a paso y espera la respuesta antes de continuar."]],
        $_SESSION['historial']
    ),
    "temperature" => 0.7
];

$headers = [
    "Authorization: Bearer $apiKey",
    "Content-Type: application/json",
    "HTTP-Referer: https://tusitio.com",
    "X-Title: CVBot"
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openrouter.ai/api/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response, true);

if (isset($result['choices'][0]['message']['content'])) {
    $respuesta = $result['choices'][0]['message']['content'];
    array_push($_SESSION['historial'], ["role" => "assistant", "content" => $respuesta]);

    // GUARDAR en la base de datos
    $stmt = $con->prepare("INSERT INTO respuestas_cv (pregunta, respuesta) VALUES (?, ?)");
    $stmt->bind_param("ss", $userMessage, $respuesta);
    $stmt->execute();
    $stmt->close();

    echo nl2br($respuesta);
} else {
    echo "❌ Error:<pre>" . print_r($result, true) . "</pre>";
}
?>