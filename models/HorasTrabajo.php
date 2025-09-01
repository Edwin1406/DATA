<?php

namespace Model;

use DateTime;

class HorasTrabajo extends ActiveRecord {    
    protected static $tabla = 'horas_trabajo';
    protected static $columnasDB = ['id','hora_trabajo','fecha'];

    public ?int $id;
    public ?string $hora_trabajo;
    public string $fecha = '';
    


    public function __construct($args = [])

    // fecha automatica
    
    {
        $this->id = $args['id'] ?? null;
        $this->hora_trabajo = $args['hora_trabajo'] ?? null;
        // $this->fecha = $args['fecha'] ?? null;
        $this->fecha = new DateTime();
    }

















}