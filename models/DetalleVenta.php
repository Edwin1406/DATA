<?php

namespace Model;

use DateTime;

class DetalleVenta extends ActiveRecord {    
    protected static $tabla = 'DETALLE_VENTA';
    protected static $columnasDB = ['id','id_venta','id_producto','cantidad','precio_unitario'];

    public ?int $id;
    public ?int $id_venta;
    public ?int $id_producto;
    public ?int $cantidad;
    public ?float $precio_unitario;




    public function __construct(array $args = []) {
       

        $this->id = $args['id'] ?? null;
        $this->id_venta = $args['id_venta'] ?? null;
        $this->id_producto = $args['id_producto'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->precio_unitario = $args['precio_unitario'] ?? null;
       

    }











}