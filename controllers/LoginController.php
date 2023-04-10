<?php 

namespace Controllers;

//use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(/* Router */ $router) {
        // $router es instancia de Router, creada en /public/index.php, y enviada a este controlador desde la funcion nativa de PHP call_user_func(), ejecutada dentro del metodo comprobarRutas(), tambien de la clase Router), gracias a lo cual podemos acceder al metodo render() de Router, que permite renderizar arcivos dentro de /views (VIDEO 430)

        $errors = Admin::getErrores();
        $auth = new Admin();

        if($_SERVER["REQUEST_METHOD"] === "POST") {

            $auth = new Admin($_POST);
            $errors = $auth->validar();

            if(empty($errors)) { 
            // no hay errores, entramos a la autenticacion de usuario

                $resultado = $auth->existeUsuario();
                // $resultado === null, si el mail ingresado por el usuario no existe
                // $resultado === mysqli_result Object, si el mail ingresado por el usuario existe
                
                if(!$resultado) {
                // el mail no existe en la base
                    $errors = Admin::getErrores();
                } else {
                // el mail existe en la base, vamos a verificar si el pass ingresado por el usuario coincide con el del registro asociado a ese mail 
                    $autenticado = $auth->comprobarPassword($resultado);
                    // TRUE si ambos pass coinciden 
                    // FALSE si los pass no coinciden
                    if($autenticado) {
                    // $autenticado === TRUE, los pass coinciden. autenticamos al usuario
                        $auth->autenticar();



                    } else {
                    // $autenticado === FALSE, los pass no coinciden
                        $errors = Admin::getErrores();
                    }
                }
            }
        }

        $router->render("auth/login", [
            "errors" => $errors,
            "email" => $auth->email
        ]);
    }
    
    public static function logout() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            session_start();
            session_destroy();
            // $_SESSION = []; -> otra forma de vaciar el arreglo superglobal $_SESSION
            header("Location: /");
        }
    }
}