<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Logs de Peticiones</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #333; color: #fff; }
        tr:nth-child(even) { background: #f2f2f2; }
    </style>
</head>
<body>
    <h1>📊 Logs de Peticiones</h1>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Método</th>
            <th>IP</th>
            <th>Ruta</th>
        </tr>
      <?php foreach($lineas as $linea): ?>
    <?php if(preg_match('/^(\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}) \[(\w+)\] \((.*?)\) (.+)$/', $linea, $m)): ?>
        <tr>
            <td><?= htmlspecialchars($m[1]) ?></td>
            <td><?= htmlspecialchars($m[2]) ?></td>
            <td><?= htmlspecialchars($m[3]) ?></td>
            <td><?= htmlspecialchars($m[4]) ?></td>
        </tr>
    <?php endif; ?>
<?php endforeach; ?>

    </table>
</body>
</html>
