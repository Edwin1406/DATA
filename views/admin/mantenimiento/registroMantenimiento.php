<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// 1. Obtener datos desde la API
$apiUrl = "https://megawebsistem.com/admin/api/apiConsumoGeneral";
$jsonData = file_get_contents($apiUrl);
$data = json_decode($jsonData, true);

// 2. Verificar estructura (puede venir dentro de "data")
if (isset($data["data"])) {
    $data = $data["data"];
}

// Si no hay datos, salir con mensaje
if (empty($data)) {
    die("⚠ No se encontraron datos en la API.");
}

// 3. Crear Excel
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// 4. Encabezados
$headers = ["ID", "Tipo Máquina", "Total General", "Fecha Creación", "Acción"];
$col = "A";
foreach ($headers as $header) {
    $sheet->setCellValue($col . "1", $header);
    $col++;
}

// 5. Insertar registros
$row = 2;
foreach ($data as $item) {
    $sheet->setCellValue("A" . $row, $item["id"]);
    $sheet->setCellValue("B" . $row, $item["tipo_maquina"]);
    $sheet->setCellValue("C" . $row, $item["total_general"]);
    $sheet->setCellValue("D" . $row, $item["created_at"]);
    $sheet->setCellValue("E" . $row, $item["accion"]);
    $row++;
}

// 6. Descargar Excel
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
