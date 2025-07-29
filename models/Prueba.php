<?php

namespace Model;

class Prueba extends ActiveRecord {    
    protected static $tabla = 'prueba';
    protected static $columnasDB = ['id', 'name', 'last'];


    public ?int $id;
    public string $name;
    // public string $last;
    // En tu modelo Prueba
public array $last = [];



    // public function __construct(array $args = [])
    // {
    //     $this->id = $args['id'] ?? null;
    //     $this->name = $args['name'] ?? '';
    //     $this->last = $args['last'] ?? '';
    // }


    public function __construct(array $args = []) {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        
        // Si viene como array (desde formulario), convertir a string
        if (isset($args['last'])) {
            if (is_array($args['last'])) {
                $this->last = implode(',', $args['last']);
            } else {
                $this->last = $args['last'];
            }
        } else {
            $this->last = '';
        }
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