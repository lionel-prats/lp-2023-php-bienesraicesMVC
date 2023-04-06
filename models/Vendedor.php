<?php 

namespace Model;

class Vendedor extends ActiveRecord {
    protected static $tabla = "vendedores";
    protected static $columnasDB = ['id','nombre','apellido','telefono'];

    protected static $expresion_regular= "|^\d\d\d\d\d\d\d\d\d?\d?$|"; 
    // entre 8 y 10 caracteres numericos
    // ver z.expresiones-regulares.php

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }
    public function validar() {
        if(!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio"; 
        }
        if(!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }
        if(!$this->telefono) {
            self::$errores[] = "El nro. de teléfono es obligatorio";
        } elseif(!preg_match(self::$expresion_regular, $this->telefono)) {
            self::$errores[] = "El nro. de teléfono ingresado no es válido";
        }
        return self::$errores;
    }
}