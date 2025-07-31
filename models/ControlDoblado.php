<?php
namespace Model;

class ControlDoblado extends ActiveRecord {
    protected static $tabla = 'control_doblado';
    protected static $columnasDB = [
        'id',
        'fecha',
        'turno',
        'area',
        'horas_programadas',
        'cantidad_laminas',
        'cantidad_maquina_hora',
        'n_cambio',
        'desperdicio_kg',
        

    ];

    public $id;
    public $fecha;
    public $turno;
    public $area;
    public $horas_programadas;
    public $cantidad_laminas;
    public $cantidad_maquina_hora;
    public $n_cambio;
    public $desperdicio_kg;


    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->fecha = $data['fecha'] ?? null;
        $this->turno = $data['turno'] ?? null;
        $this->area = $data['area'] ?? null;
        $this->horas_programadas = $data['horas_programadas'] ?? null;
        $this->cantidad_laminas = $data['cantidad_laminas'] ?? null;
        $this->cantidad_maquina_hora = $data['cantidad_maquina_hora'] ?? null;
        $this->n_cambio = $data['n_cambio'] ?? null;
        $this->desperdicio_kg = $data['desperdicio_kg'] ?? null;
    }


     public function validar() {
        if(!$this->fecha) {
            self::$alertas['error'][] = 'La fecha es obligatoria';
        } 

        if(!$this->turno) {
            self::$alertas['error'][] = 'El turno es obligatorio';
        }

        if(!$this->area) {
            self::$alertas['error'][] = 'El área es obligatoria';
        }

        if(!$this->horas_programadas) {
            self::$alertas['error'][] = 'Las horas programadas son obligatorias';
        }

        if(!$this->cantidad_laminas) {
            self::$alertas['error'][] = 'La cantidad de láminas es obligatoria';
        }

        if(!$this->cantidad_maquina_hora) {
            self::$alertas['error'][] = 'La cantidad de máquina por hora es obligatoria';
        }

        if(!$this->n_cambio) {
            self::$alertas['error'][] = 'El número de cambio es obligatorio';
        }

        if(!$this->desperdicio_kg) {
            self::$alertas['error'][] = 'El desperdicio en kg es obligatorio';
        }

        return self::$alertas;
    }
}