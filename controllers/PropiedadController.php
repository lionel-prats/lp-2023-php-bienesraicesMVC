<?php 

namespace Controllers;
use MVC\Router; 
use Model\Propiedad; 
use Model\Vendedor; 

class PropiedadController {
    public static function index(/* Router  */$router) {
        // $router es la instancia de Router creada en /public/index.php
        // con el prefijo "Router" especifico que el parametro $router tiene que ser instancia de Router
        // este argumento llega desde el metodo comprobarRutas de Router (call_user_func()) (VIDEO 400)

        $propiedades = Propiedad::all();
        $result = null;

        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "result" => $result
        ]);
    }
    public static function crear(/* Router */ $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            debuguear($_POST);
        }

        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
        ]);
    }
    public static function actualizar(/* Router */ $router) {
        debuguear($router);
    }
} // VIDEO 399