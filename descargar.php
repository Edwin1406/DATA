<?php
if (isset($_GET['file']) && isset($_GET['nombre'])) {
    // Seguridad: solo nombre del archivo
    $archivoNombre = basename($_GET['file']); 

    // Ruta real (subimos un nivel desde /public hasta la raíz del proyecto)
    $archivo = dirname(__DIR__) . "/src/visor/" . $archivoNombre;

    // Nombre final para la descarga
    $nombreDescarga = $_GET['nombre'] . ".pdf";

    if (file_exists($archivo)) {
        // Forzar descarga
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $nombreDescarga . "\"");
        header("Content-Length: " . filesize($archivo));
        readfile($archivo);
        exit;
    } else {
        // ⚠️ Depuración
        echo "Archivo no encontrado.<br>";
        echo "Ruta buscada: " . $archivo;
    }
} else {
    echo "Parámetros inválidos.";
}
?>
