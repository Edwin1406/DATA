<?php

namespace Model;

use DateTime;

class DetalleVenta extends ActiveRecord {    
    protected static $tabla = 'DETALLE_VENTA';
    protected static $columnasDB = ['id','id_venta','tipo_maquina','cantidad','precio_unitario'];

    public ?int $id;
    public ?int $id_venta;
    public ?string $tipo_maquina;
    public ?int $cantidad;
    public ?float $precio_unitario;




    public function __construct(array $args = []) {
       

        $this->id = $args['id'] ?? null;
        $this->id_venta = $args['id_venta'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->precio_unitario = $args['precio_unitario'] ?? null;
       

    }











}