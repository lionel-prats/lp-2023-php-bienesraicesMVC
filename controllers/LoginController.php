<?php 

namespace Controllers;

//use MVC\Router;
use Model\Admin;

class LoginController {
    public static function login(/* Router */ $router) {
        // $router es instancia de Router, creada en /public/index.php, y enviada a este controlador desde la funcion nativa de PHP call_user_func(), ejecutada dentro del metodo comprobarRutas(), tambien de la clase Router), gracias a lo cual podemos acceder al metodo render() de Router, que permite renderizar arcivos dentro de /views (VIDEO 430)

        $errors = [];
        $email = "";

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            debuguear("autenticando usuario");
        }

        $router->render("auth/login", [
            "errors" => $errors,
            "email" => $email
        ]);
    }
    
    public static function logout() {
        echo "desde logout";

    }
}