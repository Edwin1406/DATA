<?php

namespace Model;

use DateTime;

class Ventas extends ActiveRecord {    
    protected static $tabla = 'VENTAS';
    protected static $columnasDB = ['id','id_usuario','consumo_papel','n_laminas','metros_lineales','turno','n_cambios','consumo_almidon','consumo_resina',
    'consumo_recubrimiento','operador','total','hora_inicio','hora_fin','motivo_inactividad','unidades_pendientes','fecha'];

    public ?int $id;
    public ?int $id_usuario;
    public ?float $consumo_papel;
    public ?int $n_laminas;
    public ?float $metros_lineales;
    public ?string $turno;
    public ?int $n_cambios;
    public ?float $consumo_almidon;
    public ?float $consumo_resina;
    public ?float $consumo_recubrimiento;
    public ?string $operador;
    public ?float $total;
    public ?string $hora_inicio;
    public ?string $hora_fin;
    public ?string $motivo_inactividad;
    public ?int $unidades_pendientes;
    public ?string $fecha;

    public function __construct(array $args = []) {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s');

        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->consumo_papel = $args['consumo_papel'] ?? null;
        $this->n_laminas = $args['n_laminas'] ?? null;
        $this->metros_lineales = $args['metros_lineales'] ?? null;
        $this->turno = $args['turno'] ?? null;
        $this->n_cambios = $args['n_cambios'] ?? null;
        $this->consumo_almidon = $args['consumo_almidon'] ?? null;
        $this->consumo_resina = $args['consumo_resina'] ?? null;
        $this->consumo_recubrimiento = $args['consumo_recubrimiento'] ?? null;
        $this->operador = $args['operador'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->hora_inicio = $args['hora_inicio'] ?? null;
        $this->hora_fin = $args['hora_fin'] ?? null;
        $this->motivo_inactividad = $args['motivo_inactividad'] ?? null;
        $this->unidades_pendientes = $args['unidades_pendientes'] ?? 0;
        $this->fecha = $args['fecha'] ?? $fecha;
    }

}


