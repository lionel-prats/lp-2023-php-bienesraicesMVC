<?php 

namespace Controllers;
use MVC\Router; 

class PropiedadController {
    public static function index(/* Router  */$router) {
        // $router es la instancia de Router creada en /public/index.php
        // con el prefijo "Router" especifico que el parametro $router tiene que ser instancia de Router
        // este argumento llega desde el metodo comprobarRutas de Router (call_user_func()) (VIDEO 400)
        $router->render("propiedades/admin");
    }
    public static function crear(/* Router */ $router) {
        debuguear($router);
    }
    public static function actualizar(/* Router */ $router) {
        debuguear($router);
    }
} // VIDEO 399