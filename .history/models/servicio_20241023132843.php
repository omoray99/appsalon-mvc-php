<?php

namespace Model;

class Servicio extends ActiveRecord {
    // base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['id', 'nombre', 'precio'];


}