<?php

namespace Model;

use DateTime;

class DetalleVenta extends ActiveRecord {    
    protected static $tabla = 'DETALLE_VENTA';
    protected static $columnasDB = ['id','id_venta','tipo_maquina','cantidad','casos','observaciones','fecha'];

    public ?int $id;
    public ?int $id_venta;
    public ?string $tipo_maquina;
    public $cantidad;
    public $casos;
    public ?string $observaciones;
    public $fecha;






    public function __construct(array $args = []) {
       

        $this->id = $args['id'] ?? null;
        $this->id_venta = $args['id_venta'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->casos = $args['casos'] ?? null;
        $this->observaciones = $args['observaciones'] ?? null;
        $this->fecha = $args['fecha'] ?? null;

    }

    // validar
    public function validar() {
        if(!$this->id_venta) {
            self::$alertas['error'][] = 'El id de la venta es obligatorio';
        }
        if(!$this->tipo_maquina) {
            self::$alertas['error'][] = 'El tipo de maquina es obligatorio';
        }
        if(!$this->cantidad) {
            self::$alertas['error'][] = 'La cantidad es obligatoria';
        }
        if(!$this->casos) {
            self::$alertas['error'][] = 'El numero de casos es obligatorio';
        }
        return self::$alertas;
    }










}