<?php

namespace Model;

use DateTime;

class Ventas extends ActiveRecord {    
    protected static $tabla = 'VENTAS';
    protected static $columnasDB = ['id','id_usuario','consumo_papel','n_laminas','metros_lineales','turno','n_cambios','operador','total','hora_inicio','hora_fin','tiempo_inactivo','motivo_inactividad','fecha','linea'];

    public ?int $id;
    public ?int $id_usuario;
    public ?float $consumo_papel;
    public ?int $n_laminas;
    public ?float $metros_lineales;
    public ?string $turno;
    public ?int $n_cambios;
   
    public ?string $operador;
    public ?float $total;
    public ?string $hora_inicio;
    public ?string $hora_fin;
    public $tiempo_inactivo;
    public ?string $motivo_inactividad;
    // public ?int $unidades_pendientes;
    public ?string $fecha;
    public ?string $linea;

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
      
        $this->operador = $args['operador'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->hora_inicio = $args['hora_inicio'] ?? null;
        $this->hora_fin = $args['hora_fin'] ?? null;
        $this->tiempo_inactivo = $args['tiempo_inactivo'] ?? null;
        $this->motivo_inactividad = $args['motivo_inactividad'] ?? null;
        // $this->unidades_pendientes = $args['unidades_pendientes'] ?? 0;
        $this->fecha = $args['fecha'] ?? $fecha;
        $this->linea = $args['linea'] ?? null;
    }



    // Validar




}


