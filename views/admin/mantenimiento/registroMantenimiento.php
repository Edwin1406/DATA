<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$apiUrl = "https://megawebsistem.com/admin/api/apiConsumoGeneral";
$jsonData = file_get_contents($apiUrl);
$data = json_decode($jsonData, true);

// --- Detectar dónde están los registros ---
if (isset($data["data"]) && is_array($data["data"])) {
    $rows = $data["data"];
} elseif (isset($data["records"]) && is_array($data["records"])) {
    $rows = $data["records"];
} elseif (is_array($data)) {
    $rows = $data;
} else {
    die("⚠ No se encontraron datos en la API.");
}

// 2. Crear Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 3. Encabezados
$headers = ["ID", "Tipo Máquina", "Total General", "Fecha Creación", "Acción"];
$col = "A";
foreach ($headers as $header) {
    $sheet->setCellValue($col . "1", $header);
    $col++;
}

// 4. Insertar registros
$row = 2;
foreach ($rows as $item) {
    $sheet->setCellValue("A" . $row, $item["id"] ?? "");
    $sheet->setCellValue("B" . $row, $item["tipo_maquina"] ?? "");
    $sheet->setCellValue("C" . $row, $item["total_general"] ?? "");
    $sheet->setCellValue("D" . $row, $item["created_at"] ?? "");
    $sheet->setCellValue("E" . $row, $item["accion"] ?? "");
    $row++;
}

// 5. Descargar Excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="consumo_general.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Descargar Consumo General</title>
</head>
<body>
    <h2>Exportar datos de Consumo General</h2>
    <form action="export.php" method="post">
        <button type="submit">📥 Descargar Excel</button>
    </form>
</body>
</html>
