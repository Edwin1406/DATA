<?php
if (isset($_GET['file']) && isset($_GET['nombre'])) {
    $archivoNombre = basename($_GET['file']); 

    // 👇 Ajuste correcto: buscar dentro de public/src/visor/
    $archivo = __DIR__ . "/src/visor/" . $archivoNombre;

    $nombreDescarga = $_GET['nombre'] . ".pdf";

    if (file_exists($archivo)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $nombreDescarga . "\"");
        header("Content-Length: " . filesize($archivo));
        readfile($archivo);
        exit;
    } else {
        echo "Archivo no encontrado.<br>";
        echo "Ruta buscada: " . $archivo;
    }
} else {
    echo "Parámetros inválidos.";
}
?>
