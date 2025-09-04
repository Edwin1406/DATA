<?php

namespace Model;

use DateTime;

class DetalleVenta extends ActiveRecord {    
    protected static $tabla = 'DETALLE_VENTA';
    protected static $columnasDB = ['id','id_venta','tipo_maquina','cantidad','casos'];

    public ?int $id;
    public ?int $id_venta;
    public ?string $tipo_maquina;
    public ?int $cantidad;
    public $casos;




    public function __construct(array $args = []) {
       

        $this->id = $args['id'] ?? null;
        $this->id_venta = $args['id_venta'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->casos = $args['casos'] ?? null;

    }











}