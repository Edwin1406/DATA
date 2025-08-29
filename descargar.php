<?php
if (isset($_GET['file']) && isset($_GET['nombre'])) {
    $archivoNombre = basename($_GET['file']); 
    $archivo = __DIR__ . "/src/visor/" . $archivoNombre;
    $nombreDescarga = $_GET['nombre'] . ".pdf";

    if (file_exists($archivo)) {
        header("Content-Type: application/pdf");
        header("Content-Disposition: attachment; filename=\"" . $nombreDescarga . "\"");
        header("Content-Length: " . filesize($archivo));
        readfile($archivo);
        exit;
    } else {
        echo "⚠️ Archivo no encontrado.<br>";
        echo "Buscado: " . $archivo . "<br><br>";
        
        // Mostrar qué archivos hay en la carpeta
        echo "Archivos disponibles en src/visor/:<br>";
        foreach (glob(__DIR__ . "/src/visor/*.pdf") as $f) {
            echo basename($f) . "<br>";
        }
    }
} else {
    echo "Parámetros inválidos.";
}
?>
