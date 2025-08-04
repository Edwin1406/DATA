<?php
namespace Model;

class ControlConvertidor extends ActiveRecord {
    protected static $tabla = 'control_convertidor';
    protected static $columnasDB = [
        'id',
        'fecha',
        'turno',
        'area',
        'personal',
        'horas_programadas',
        'cantidad_resmas',
        'cantidad_resmas_hora',
        'n_cambio',
        'gramaje',
        'desperdicio_kg',
    ];

    public $id;
    public $fecha;
    public $turno;
    public $area;
    public $personal; // Comma-separated string of personal names
    public $horas_programadas;
    public $cantidad_resmas;
    public $cantidad_resmas_hora;
    public $n_cambio;
    public $gramaje;
    public $desperdicio_kg;



    public function __construct($data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->fecha = $data['fecha'] ?? null;
        $this->turno = $data['turno'] ?? null;
        $this->area = $data['area'] ?? 'Convertidor'; // Default area
        $this->personal = $data['personal'] ?? null;
        $this->horas_programadas = $data['horas_programadas'] ?? null;
        $this->cantidad_resmas = $data['cantidad_resmas'] ?? null;
        $this->cantidad_resmas_hora = $data['cantidad_resmas_hora'] ?? null;
        $this->n_cambio = $data['n_cambio'] ?? null;
        $this->gramaje = $data['gramaje'] ?? null;
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

        if(!$this->cantidad_resmas) {
            self::$alertas['error'][] = 'La cantidad de resmas es obligatoria';
        }

        if(!$this->n_cambio) {
            self::$alertas['error'][] = 'El número de cambio es obligatorio';
        }

        return self::$alertas;
    }
    public function convertirHorasADecimal($horas) {
        $partes = explode(':', $horas);
        if (count($partes) === 2) {
            $horasDecimal = (int)$partes[0] + ((int)$partes[1] / 60);
            return $horasDecimal;
        }
        return 0; // Si no es un formato válido, retornar 0
    }


}