<?php
if (isset($_GET['file']) && isset($_GET['nombre'])) {
    $archivo = __DIR__ . "/src/visor/" . basename($_GET['file']); // seguridad con basename
    $nombreDescarga = $_GET['nombre'] . ".pdf";

    if (file_exists($archivo)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $nombreDescarga . "\"");
        readfile($archivo);
        exit;
    } else {
        echo "Archivo no encontrado.";
    }
}
?>
