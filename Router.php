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

    // esta funcion edita el atributo $this->rutasPOST
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    } // -> VIDEO 405

    // este metodo manda a llamar al metodo del controlador que corresponda, segun la URL y el metodo por el quye el cliente este haciendo la peticion
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
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? NULL;
        }
        if($fn) {
            call_user_func($fn, $this); // VIDEO 398
            // esta funcion manda ejecutar el metodo de un controlador, especificado en $fn
            // $fn es un arreglo con el namespace de un controlador y un metodo interno de ese controlador 
            // a su vez, le paso a este metodo la instancia de Router creada en /public/index.php como 2do argumento
        } else {
            debuguear("404 NOT FOUND");
        }
    }

    // muestra una vista
    public function render($view, $datos = []) {

         // VIDEO 402 -> es una forma de mapear un array creando una variable por cada $key, que mantenga el mismo nombre y el mismo $value
        foreach($datos as $key=>$value){
            $$key = $value;
        }

        ob_start(); // -> VIDEO 401 -> almacenamiento en memoria durante un momento
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); // limpia el buffer
        // hasta aca se guardo en memoria, en $contenido, el archivo del include de arriba, y se limpia la memoria

        include __DIR__ . "/views/layout.php";
        // se renderiza este archivo, que como adentro tiene un echo $contenido, va a renderizar a su vez, el contenido de $contenido
    }
} // VIDEO 398