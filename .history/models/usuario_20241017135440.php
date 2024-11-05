<?php

namespace Model;

class usuario extends ActiveRecord{

    // Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;    
        $this->nombre = $args['nombre'] ?? '';    
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? null;
        $this->confirmado = $args['confirmado'] ?? null;
        $this->token = $args['tooken'] ?? '';
            
    }

    // mensajes de validacion para la creacion de una cuenta

    public function validarNuevaCuenta(){
        if(!$this->nombre){
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido){
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->email){
            self::$alertas['error'][] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$alertas['error'][] = 'La contraseña es obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe contener al menos 6 caracteres'; 
        }

        return self::$alertas;
        
    }
    // revisa que el usuario ya existe
    public function existeUsuario(){
        $query = " SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email  . "'  "
    }
}