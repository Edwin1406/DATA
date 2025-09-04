<?php 
namespace Model;




class Carrito extends ActiveRecord {

    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id', 'id_usuario','tipo_maquina','tipo_clasificacion','casos','cantidad','metros_lineales','n_laminas','n_cambios','consumo_almidon','consumo_resina','consumo_recubrimiento'];

    public $id;
    public $id_usuario;
    public $tipo_maquina;
    public $tipo_clasificacion;
    public $casos;
    public $cantidad;
    public $metros_lineales;
    public $n_laminas;
    public $n_cambios;
    public $consumo_almidon;
    public $consumo_resina;
    public $consumo_recubrimiento;
    


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->id_usuario = $args['id_usuario'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->tipo_clasificacion = $args['tipo_clasificacion'] ?? null;
        $this->casos = $args['casos'] ?? null;
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->metros_lineales = $args['metros_lineales'] ?? 0;
        $this->n_laminas = $args['n_laminas'] ?? 0;
        $this->n_cambios = $args['n_cambios'] ?? 0;
        $this->consumo_almidon = $args['consumo_almidon'] ?? 0;
        $this->consumo_resina = $args['consumo_resina'] ?? 0;
        $this->consumo_recubrimiento = $args['consumo_recubrimiento'] ?? 0;

    }


    










}