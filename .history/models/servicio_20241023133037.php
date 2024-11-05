<?php

namespace Model;

class Servicio extends ActiveRecord {
    // base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];

    public $id;
    public $nombre;
    public $precio;

    public function __construct($Args[])
    {
        $this->id = $args['id'] ?? null;   
        $this->nombre = $args['nombre'];
        $this->precio = $args['precio'];
    }

}