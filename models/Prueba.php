<?php

namespace Model;

class Prueba extends ActiveRecord {    
    protected static $tabla = 'prueba';
    protected static $columnasDB = ['id', 'name', 'last'];


    public ?int $id;
    public string $name;
    public string $last;


    public function __construct(array $args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last = $args['last'] ?? '';
    }


    public function validar(): array {
        if (!$this->name) {
            self::$alertas['error'][] = 'El Nombre es Obligatorio';
        }
        if (!$this->last) {
            self::$alertas['error'][] = 'El Apellido es Obligatorio';
        }
        return self::$alertas;
    }



    





}