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

    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '$this->email' LIMIT 1";

        $resultado = self::$db->query($query); 
        // el metodo query() retorna un mysqli_result Object, una instancia de mysqli (la conexion a la base de datos) almacenada y presente en el atributo $db de ActiveRecord y en todas las clases que heredan de ella
        /*  
        mysqli_result Object
        (
            [current_field] => 0
            [field_count] => 3
            [lengths] => 
            [num_rows] => 1 // cantidad de registros devueltos por la consulta a la DB
            [type] => 0
        )
        */
        if(!$resultado->num_rows) {
            self::$errores[] = "El usuario no existe";
            return; 
            // si no existe usuario en la tabla usuarios con el mail ingresado por el cliente ($resultado->num_rows === 0) ...
            // esta funcion agregara un mensaje a $errores y no retornara nada (VIDEO 433)
        }
        return $resultado;
        // si existe usuario en la tabla usuarios con el mail ingresado por el cliente ($resultado->num_rows > 0) ...
        // el if(){} de arriba no se ejecutara y esta funcion retornara el objeto que retorna el metodo query() (VIDEO 433)
    }

    public function comprobarPassword($resultado) { 
        $usuario = $resultado->fetch_object();
        // como $usuario almacena una instancia de mysqli, podemos acceder al metodo fetch_object() para acceder a la informacion del registro encontrado de la tabla usuarios (VIDEO 434)
        // esta informacion la retorna en formato stdClass Object (VIDEO 434)
        // usamos fetch_object para acceder al password del registro encontrado en la base ($usuario->password), y poder comparar ese password con el ingresado por usuario

        $autenticado = password_verify($this->password, $usuario->password);
        // TRUE si ambos pass coinciden 
        // FALSE si los pass no coinciden

        if(!$autenticado) {
            self::$errores[] = "El password es incorrecto";
        }
        return $autenticado;
    }
}