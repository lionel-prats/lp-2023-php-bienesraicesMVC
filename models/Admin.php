<?php 

namespace Model;

class Admin extends ActiveRecord {
    
    protected static $tabla = "usuarios";
    protected static $columnasDB = ['id','email','password'];
    
    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar() {
        if(!$this->email) {
            self::$errores[] = "El email es obligatorio"; 
        } elseif (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "El email ingresado es inválido"; 
        }
        if(!$this->password) {
            self::$errores[] = "El password es obligatorio";
        }
        return self::$errores;
    }
}