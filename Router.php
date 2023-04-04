<?php 

namespace MVC;

// debuguear() la puedo usar siempre que desde un archivo que requiera esta clase, requiera a su vez el archivo /includes/funciones.php (si un archivo requiere /includes/app.php, esta requiriendo a su vez /includes/funciones.php)
class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas() {
        
        $urlActual = $_SERVER["PATH_INFO"] ?? "/"; // VIDEO 398
        $metodo = $_SERVER["REQUEST_METHOD"]; // VIDEO 398

        if($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
        }

        if($fn) {
            call_user_func($fn, $this); // VIDEO 398

        } else {
            debuguear("404 NOT FOUND");
        }

    }
}