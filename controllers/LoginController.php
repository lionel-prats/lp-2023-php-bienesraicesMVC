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
                // verificar si el email existe

                $resultado = $auth->existeUsuario();
                // $resultado === null si el usuario no existe
                // $resultado === mysql_result Object si existe

                if(!$resultado) {
                    $errors = Admin::getErrores();
                } else {
                    // verificar si el password existe 

                    // autenticar al usuario
                }
            }
        }

        $router->render("auth/login", [
            "errors" => $errors,
            "email" => $auth->email
        ]);
    }
    
    public static function logout() {
        echo "desde logout";

    }
}