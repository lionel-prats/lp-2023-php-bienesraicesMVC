<?php 

namespace MVC;

// debuguear() la puedo usar acá siempre que desde un archivo que requiera esta clase Router, requiera a su vez el archivo /includes/funciones.php (si un archivo requiere /includes/app.php, esta requiriendo a su vez /includes/funciones.php)
class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    // esta funcion edita el atributo $this->rutasGET
    public function get($url, $fn) {
        // $url va a ser un string con una ruta valida de nuestra aplicacion
        // $fn va a ser un arreglo con el namespace de un controlador y un metodo interno de ese controlador 
        $this->rutasGET[$url] = $fn;
    } // -> VIDEO 398

    public function comprobarRutas() {
        $urlActual = $_SERVER["PATH_INFO"] ?? "/"; // VIDEO 398
        $metodo = $_SERVER["REQUEST_METHOD"]; // VIDEO 398
        if($metodo === "GET") {
            $fn = $this->rutasGET[$urlActual] ?? NULL;
            //array(2) {
                //[0]=>
                //string(31) "Controllers\PropiedadController"
                //[1]=>
                //string(5) "index"
            //}
        }
        if($fn) {
            call_user_func($fn, $this); // VIDEO 398
            // esta funcion manda ejecutar el metodo de un controlador, especificado en $fn
            // a su vez, le paso a este metodo la instancia de Router creada en /public/index.php como 2do argumento
        } else {
            debuguear("404 NOT FOUND");
        }
    }

    // muestra una vista
    public function render($view) {
        include __DIR__ . "/views/$view.php";
    }
} // VIDEO 398