<?php
namespace Model;

use DateTime;

class ProduccionDiaria extends ActiveRecord {

    protected static $tabla = 'produccion_diaria';
    
    protected static $columnasDB = [
        'id',
        'fecha',
        'peso_un',
        'unidad_x_dia',
        'metros_lineales',
        'kilos_x_dia',
        'hora_inicio',
        'hora_fin',
        'turno',
        'horas_maquina',
        'cambios',
        'tiempo_x_cambio',
        'unidades_x_procesar',
        'kilos_x_procesar',
        'linea',
        'id_corrugador'
    ];


    public $id;
    public $fecha;
    public $peso_un;
    public $unidad_x_dia;
    public $metros_lineales;
    public $kilos_x_dia;
    public $hora_inicio;
    public $hora_fin;
    public $desperdicio_lamina;
    public $turno;
    public $horas_maquina;
    public $cambios;
    public $tiempo_x_cambio;
    public $unidades_x_procesar;
    public $kilos_x_procesar;
    public $linea;
    public $id_corrugador;

    public function __construct($args = []) {
        //date_default_timezone_set('America/Guayaquil');
        //$fechaHoy = date('Y-m-d');

        $this->id = $args['id'] ?? null;
        $this->fecha = $args['fecha'] ?? null;
        $this->peso_un = $args['peso_un'] ?? null;
        $this->unidad_x_dia = $args['unidad_x_dia'] ?? 0;
        $this->metros_lineales = $args['metros_lineales'] ?? null;
        $this->kilos_x_dia = $args['kilos_x_dia'] ?? null;
        $this->hora_inicio = $args['hora_inicio'] ?? null;
        $this->hora_fin = $args['hora_fin'] ?? null;
        $this->desperdicio_lamina = $args['desperdicio_lamina'] ?? null;
        $this->turno = $args['turno'] ?? null;
        $this->horas_maquina = $args['horas_maquina'] ?? null;
        $this->cambios = $args['cambios'] ?? null;
        $this->tiempo_x_cambio = $args['tiempo_x_cambio'] ?? null;
        $this->unidades_x_procesar = $args['unidades_x_procesar'] ?? null;
        $this->kilos_x_procesar = $args['kilos_x_procesar'] ?? null;
        $this->linea = $args['linea'] ?? null;
        $this->id_corrugador = $args['id_corrugador'] ?? null;
    }
}
?>