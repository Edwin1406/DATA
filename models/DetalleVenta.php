<?php

namespace Model;

use DateTime;

class DetalleVenta extends ActiveRecord {    
    protected static $tabla = 'DETALLE_VENTA';
    protected static $columnasDB = ['id','id_venta','tipo_maquina','cantidad','casos','metros_lineales','n_laminas','n_cambios','consumo_almidon','consumo_resina','consumo_recubrimiento'];

    public ?int $id;
    public ?int $id_venta;
    public ?string $tipo_maquina;
    public ?int $cantidad;
    public $casos;
    public float $metros_lineales;
    public float $n_laminas;
    public int $n_cambios;
    public float $consumo_almidon;
    public float $consumo_resina;
    public float $consumo_recubrimiento;






    public function __construct(array $args = []) {
       

        $this->id = $args['id'] ?? null;
        $this->id_venta = $args['id_venta'] ?? null;
        $this->tipo_maquina = $args['tipo_maquina'] ?? null;
        $this->cantidad = $args['cantidad'] ?? null;
        $this->casos = $args['casos'] ?? null;
        $this->metros_lineales = $args['metros_lineales'] ?? null;
        $this->n_laminas = $args['n_laminas'] ?? null;
        $this->n_cambios = $args['n_cambios'] ?? null;
        $this->consumo_almidon = $args['consumo_almidon'] ?? null;
        $this->consumo_resina = $args['consumo_resina'] ?? null;
        $this->consumo_recubrimiento = $args['consumo_recubrimiento'] ?? null;



    }











}