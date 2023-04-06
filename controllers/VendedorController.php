<?php 

namespace Controllers;
use MVC\Router; 
use Model\Vendedor; 

class VendedorController {
    public static function crear(/* Router */ $router) {
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores(); 
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $vendedor = new Vendedor($_POST["vendedor"]);
            $errores = $vendedor->validar();
            if(empty($errores)) {
                $vendedor->guardar();
            }
        }
        $router->render("vendedores/crear", [
            "vendedor" => $vendedor,
            "errores" => $errores,
        ]);
    }
    public static function actualizar(/* Router */ $router) {
        $id = validarORedireccionar("GET", "/admin");
        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores(); 
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST["vendedor"];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();
            if(empty($errores)) {
                $vendedor->guardar();
            }
        } 
        $router->render("vendedores/actualizar", [
            "vendedor" => $vendedor,
            "errores" => $errores,
        ]);
    }
    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = validarORedireccionar("POST", "/admin");
            // verificamos que haya llegado un int (evitamos inyeccion SQL, ya que se puede modificar el value del input:hidden - chequeado que funciona)
            if($id){  
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)) {
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } else {
                    header("Location: /admin");
                }  
            } 
        }
    }
}