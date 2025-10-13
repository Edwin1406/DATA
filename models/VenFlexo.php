<?php

namespace Model;

use DateTime;

class VenFlexo extends ActiveRecord {    
    protected static $tabla = 'VENFLEXO';
    protected static $columnasDB = ['id','id_usuario','consumo_papel','n_unidades','un_programadas','turno',
    'n_cambios','operador','total','hora_inicio','hora_fin','estandar','tiempo_cambio_medida','tiempo_inactivo','motivo_inactividad','fecha'];

    public ?int $id;
    public ?int $id_usuario;
    public ?float $consumo_papel;
    public ?int $n_unidades;
    public ?int $un_programadas;
    public ?string $turno;
    public ?int $n_cambios;
   
    public ?string $operador;
    public ?float $total;
    public ?string $hora_inicio;
    public ?string $hora_fin;
    public ?string $estandar;
    public $tiempo_cambio_medida;
    public $tiempo_inactivo;
    public ?string $motivo_inactividad;
  
    public ?string $fecha;

    public function __construct(array $args = []) {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s');
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->consumo_papel = $args['consumo_papel'] ?? null;
        $this->n_unidades = $args['n_unidades'] ?? null;
        $this->un_programadas = $args['un_programadas'] ?? 12000;
        $this->turno = $args['turno'] ?? null;
        $this->n_cambios = $args['n_cambios'] ?? null;
      
        $this->operador = $args['operador'] ?? null;
        $this->total = $args['total'] ?? null;
        $this->hora_inicio = $args['hora_inicio'] ?? null;
        $this->hora_fin = $args['hora_fin'] ?? null;
        $this->estandar = $args['estandar'] ?? 4500;
        $this->tiempo_cambio_medida = $args['tiempo_cambio_medida'] ?? 0;
        $this->tiempo_inactivo = $args['tiempo_inactivo'] ?? null;
        $this->motivo_inactividad = $args['motivo_inactividad'] ?? null;
        $this->fecha = $args['fecha'] ?? $fecha;
    }

}


