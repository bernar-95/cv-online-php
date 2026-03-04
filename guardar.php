<?php
// Recibimos datos enviados por fetch
$datos = file_get_contents("php://input");

// Guardamos en archivo JSON
file_put_contents("datos.json", $datos);

// Confirmación
echo "Datos guardados correctamente";
?>