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
      echo "propiedad de la aplicacion";
   }
   public static function blog($router) {
      echo "blog de la aplicacion";
   }
   public static function entrada($router) {
      echo "entrada de la aplicacion";
   }
   public static function contacto($router) {
      echo "contacto de la aplicacion";
   }
}