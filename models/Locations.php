<?php

namespace Model;

use DateTime;

class Vehiculos extends ActiveRecord {    
    protected static $tabla = 'vehicle_locations';
    protected static $columnasDB = ['id','vehicle_code','vehicle_name','lat','lng','accuracy','heading','speed','measured_at','is_last','created_at','updated_at'];

    public ?int $id;
    public ?string $vehicle_code;
    public ?string $vehicle_name;
    public ?float $lat;
    public ?float $lng;
    public ?float $accuracy;
    public ?float $heading;
    public ?float $speed;
    public ?string $measured_at;
    public ?bool $is_last;
    public ?string $created_at;
    public ?string $updated_at;

    public function __construct(array $args = []) {
        date_default_timezone_set('America/Guayaquil');
        $fecha = date('Y-m-d H:i:s');

        $this->id = $args['id'] ?? null;
        $this->vehicle_code = $args['vehicle_code'] ?? '';
        $this->vehicle_name = $args['vehicle_name'] ?? '';
        $this->lat = $args['lat'] ?? null;
        $this->lng = $args['lng'] ?? null;
        $this->accuracy = $args['accuracy'] ?? null;
        $this->heading = $args['heading'] ?? null;
        $this->speed = $args['speed'] ?? null;
        $this->measured_at = $args['measured_at'] ?? null;
        $this->is_last = $args['is_last'] ?? null;
        $this->created_at = $args['created_at'] ?? $fecha;
        $this->updated_at = $args['updated_at'] ?? $fecha;

    }

}


