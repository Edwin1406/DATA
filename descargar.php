<?php
if (isset($_GET['file']) && isset($_GET['nombre'])) {
    // Seguridad: solo nombre del archivo
    $archivoNombre = basename($_GET['file']); 

    // Ruta donde realmente están tus PDFs
    $archivo = __DIR__ . "/src/visor/" . $archivoNombre;

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
        // ⚠️ Mensaje de depuración para saber qué ruta está buscando
        echo "Archivo no encontrado.<br>";
        echo "Ruta buscada: " . $archivo;
    }
} else {
    echo "Parámetros inválidos.";
}
?>
