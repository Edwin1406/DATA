<?php 
namespace Model;




class Carrito extends ActiveRecord {

    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'id_usuario','tipo_maquina','tipo_clasificacion','cantidad','precio_unitario'];

    public $id;
    public $id_usuario;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $cantidad;
    public $precio_unitario;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? null;    
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->precio_unitario = $args['precio_unitario'] ?? 0.0;
    }





}