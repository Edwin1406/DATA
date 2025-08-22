<?php
function registrarLog($ruta) {
    $archivo = __DIR__ . "/logs/requests.log";
    $fecha = date("Y-m-d H:i:s");
    $ip    = $_SERVER['REMOTE_ADDR'] ?? 'desconocida';
    $metodo = $_SERVER['REQUEST_METHOD'] ?? 'CLI';
    $linea = "$fecha [$metodo] ($ip) $ruta" . PHP_EOL;
    file_put_contents($archivo, $linea, FILE_APPEND);
}
