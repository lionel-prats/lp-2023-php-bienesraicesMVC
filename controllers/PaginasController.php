<?php 

namespace Controllers;

//use MVC\Router;
use Model\Propiedad;

class PaginasController {
   public static function index($router) {
      $propiedades = Propiedad::get(3);
      $inicio = TRUE;
      $router->render("/paginas/index", [
         "propiedades" => $propiedades,
         "inicio" => $inicio
      ]);
   }
   public static function nosotros($router) {
      $router->render("/paginas/nosotros");
   }
   public static function propiedades($router) {
      $propiedades = Propiedad::all();
      $router->render("/paginas/propiedades", [
         "propiedades" => $propiedades,
      ]);
   }
   public static function propiedad($router) {
      $id = validarORedireccionar("GET", "/");
      $propiedad = Propiedad::find($id);
      if(is_null($propiedad))
         header("Location: /");
      $router->render("/paginas/propiedad", [
         "propiedad" => $propiedad,
      ]);
   }
   public static function blog($router) {
      $router->render("/paginas/blog");
   }
   public static function entrada($router) {
      $router->render("/paginas/entrada");
   }
   public static function contacto($router) {
      echo "contacto de la aplicacion";
   }
}