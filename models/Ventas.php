<?php

namespace Model;

use DateTime;

class Ventas extends ActiveRecord {    
    protected static $tabla = 'VENTAS';
    protected static $columnasDB = ['id','id_usuario','consumo_papel','metros_lineales','n_laminas','n_cambios','consumo_almidon','consumo_resina','consumo_recubrimiento','total','fecha'];

    public ?int $id;
    public ?int $id_usuario;
    public ?int $consumo_papel;
    public ?int $metros_lineales;
    public ?int $n_laminas;
    public ?int $n_cambios;
    public ?float $consumo_almidon;
    public ?float $consumo_resina;
    public ?float $consumo_recubrimiento;
    public ?float $total;
    public ?string $fecha;

    public function __construct(array $args = []) {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s');

        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->consumo_papel = $args['consumo_papel'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->fecha = $args['fecha'] ?? $fecha;

    }

}


