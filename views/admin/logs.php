<?php
// ----------- CONFIG ------------
$archivo = __DIR__ . "/logs/requests.log"; // Ajusta según tu estructura

// ----------- FUNCION REGISTRO ------------
function registrarLog($ruta, $archivo) {
    $fecha   = date("Y-m-d H:i:s");
    $ip      = $_SERVER['REMOTE_ADDR'] ?? 'desconocida';
    $metodo  = $_SERVER['REQUEST_METHOD'] ?? 'CLI';
    $linea   = "$fecha [$metodo] ($ip) $ruta" . PHP_EOL;
    file_put_contents($archivo, $linea, FILE_APPEND);
}

// ----------- GUARDAR LOG (opcional) -----------
// Si pasas una ruta en la URL (?add=/ejemplo), se guarda en el log
if (isset($_GET['add'])) {
    registrarLog($_GET['add'], $archivo);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?')); // recargar sin parámetros
    exit;
}

// ----------- LEER LOGS ------------
$lineas = [];
if (file_exists($archivo)) {
    $lineas = array_reverse(file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logs de Peticiones</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { display: flex; align-items: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #333; color: #fff; }
        tr:nth-child(even) { background: #f9f9f9; }
    </style>
</head>
<body>
    <h1>📊 Logs de Peticiones</h1>

    <?php if (empty($lineas)): ?>
        <p>No hay registros todavía.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Método</th>
                <th>IP</th>
                <th>Ruta</th>
            </tr>
            <?php foreach ($lineas as $linea): ?>
                <?php if (preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) \[(\w+)\] \((.*?)\) (.+)$/', $linea, $m)): ?>
                    <tr>
                        <td><?= htmlspecialchars($m[1]) ?></td>
                        <td><?= htmlspecialchars($m[2]) ?></td>
                        <td><?= htmlspecialchars($m[3]) ?></td>
                        <td><?= htmlspecialchars($m[4]) ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
