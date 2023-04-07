<?php 

namespace Controllers;

use MVC\Router;
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
   public static function nosotros() {
      echo "nosotros de la aplicacion";
   }
   public static function propiedades() {
      echo "propiedades de la aplicacion";
   }
   public static function propiedad() {
      echo "propiedad de la aplicacion";
   }
   public static function blog() {
      echo "blog de la aplicacion";
   }
   public static function entrada() {
      echo "entrada de la aplicacion";
   }
   public static function contacto() {
      echo "contacto de la aplicacion";
   }
}