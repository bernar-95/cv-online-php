<?php
// Recibe datos desde JS
$input = json_decode(file_get_contents("php://input"), true);

$texto = $input["texto"];
$origen = $input["origen"];
$destino = $input["destino"];

// API pública de traducción
$url = "https://translate.argosopentech.com/translate";

// Datos que se enviarán a la API
$data = [
    "q" => $texto,
    "source" => $origen,
    "target" => $destino,
    "format" => "text"
];

// Configuración de la petición
$options = [
    "http" => [
        "header"  => "Content-Type: application/json",
        "method"  => "POST",
        "content" => json_encode($data)
    ]
];

// Crear contexto y ejecutar petición
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);

// Devuelve respuesta al navegador
echo $result;
?>