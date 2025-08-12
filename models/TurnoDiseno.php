<?php

namespace Model;

use DateTime;

class TurnoDiseno extends ActiveRecord {    
    protected static $tabla = 'turno_diseno';
    protected static $columnasDB = ['id', 'codigo','detalle','vendedor','observaciones','estado','fecha_creacion','fecha_entrega'];

    public ?int $id;
    public ?string $codigo;
    public ?string $detalle;
    public ?string $vendedor;
    public ?string $observaciones;
    public ?string $estado;
    public ?string $fecha_creacion;
    public ?string $fecha_entrega;


      public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->codigo = $args['codigo'] ?? null;
        $this->detalle = $args['detalle'] ?? null;
        $this->vendedor = $args['vendedor'] ?? null;
        $this->observaciones = $args['observaciones'] ?? null;
        $this->estado = $args['estado'] ?? null;
        $this->fecha_creacion = $args['fecha_creacion'] ?? null;
        $this->fecha_entrega = $args['fecha_entrega'] ?? null;
    }


    // validar


    public function validar(): array {
        if (!$this->codigo) {
            self::$alertas['error'][] = 'El código es obligatorio';
        }
        if (!$this->detalle) {
            self::$alertas['error'][] = 'El detalle es obligatorio';
        }
        if (!$this->vendedor) {
            self::$alertas['error'][] = 'El vendedor es obligatorio';
        }
        return self::$alertas;
    }



    















}