<?php
session_start();
header('Content-Type: application/json');

$preguntas = [
    "¿Cuál es tu nombre completo?",
    "¿Cuál es tu número de teléfono y correo electrónico?",
    "¿Tienes LinkedIn, portafolio web o redes profesionales relevantes?",
    "¿Cuál es tu dirección (opcional, dependiendo del país)?",
    "¿Cuál es tu profesión o área de expertise?",
    "¿Qué te define como profesional en 3-4 líneas?",
    "¿Qué valor puedes aportar a una empresa?",
    "¿Cuáles han sido tus trabajos anteriores (empresa, puesto, periodo)?",
    "¿Cuáles fueron tus principales logros en cada puesto?",
    "¿Tienes experiencia freelance o proyectos relevantes?",
    "¿Qué títulos o certificaciones tienes (universidad, técnico, cursos)?",
    "¿Incluyes año de inicio y graduación?",
    "¿Qué habilidades técnicas dominas (herramientas, idiomas, software)?",
    "¿Qué habilidades interpersonales destacan en ti?",
    "¿Has recibido premios, reconocimientos o certificaciones relevantes?",
    "¿Has participado en voluntariados o proyectos extracurriculares?",
    "¿Qué idiomas hablas y en qué nivel (B1, C2, nativo)?",
    "¿Incluirás referencias laborales o será 'disponibles bajo petición'?",
    "¿Tienes disponibilidad para viajar o reubicarte?",
    "¿Quieres añadir información adicional (intereses, blog, publicaciones)?"
];

// Inicializa sesión si no existe
if (!isset($_SESSION['chuy'])) {
    $_SESSION['chuy'] = 0;
    $_SESSION['respuestas'] = [];
}

// Recoge respuesta del usuario y avanza
$data = json_decode(file_get_contents('php://input'), true);
$respuestaUsuario = $data['message'] ?? '';

if ($_SESSION['chuy'] > 0) {
    $_SESSION['respuestas'][] = $respuestaUsuario;
}

if ($_SESSION['chuy'] < count($preguntas)) {
    $preguntaActual = $preguntas[$_SESSION['chuy']];
    $_SESSION['chuy']++;
    echo json_encode(["reply" => $preguntaActual]);
} else {
    // Fin del flujo de preguntas: arma un resumen (o podríamos exportar un PDF aquí)
    $resumen = "¡Gracias! Has completado el cuestionario. Aquí están tus respuestas:\n\n";
    foreach ($preguntas as $i => $pregunta) {
        $resumen .= $pregunta . "\n" . ($_SESSION['respuestas'][$i] ?? 'No respondido') . "\n\n";
    }

    // Limpiar sesión si se quiere reiniciar
    session_destroy();

    echo json_encode(["reply" => nl2br($resumen)]);
}
