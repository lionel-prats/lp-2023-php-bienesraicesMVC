<?php 

namespace Controllers;
use MVC\Router; 
use Model\Propiedad; 
use Model\Vendedor; 
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(/* Router  */$router) {
        // $router es la instancia de Router creada en /public/index.php
        // con el prefijo "Router" especifico que el parametro $router tiene que ser instancia de Router
        // este argumento llega desde el metodo comprobarRutas de Router (call_user_func()) (VIDEO 400)

        $propiedades = Propiedad::all();

        // creado/actualizado/eliminado correctamente
        $result = $_GET["result"] ?? null;

        $router->render("propiedades/admin", [
            "propiedades" => $propiedades,
            "result" => $result
        ]);
    }
    public static function crear(/* Router */ $router) {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        // peticion POST para crear propiedad
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $propiedad = new Propiedad($_POST["propiedad"]);
            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $fileName = $_FILES["propiedad"]["name"]["imagen"];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $numero_10_digitos_aleatorio = rand(); 
                $nombre_imagen = md5( uniqid( $numero_10_digitos_aleatorio, true ) ) . "." . $fileExtension; 
                $propiedad->setImagen($nombre_imagen);
            }
            $errores = $propiedad->validar();
            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) 
                    mkdir(CARPETA_IMAGENES);
                // realizo un resize a la imagen con la libreria importada intervention image
                $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);
                // guardo la imagen enviada por el usuario en el servidor, usando la libreria intervention image
                $image->save(CARPETA_IMAGENES. $nombre_imagen);
                $propiedad->guardar();
            }
        }
        $router->render("propiedades/crear", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function actualizar(/* Router */ $router) {
        
        $id = validarORedireccionar("/admin");
        
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores(); 

        // peticion POST para actualizar propiedad
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $args = $_POST["propiedad"];
            $propiedad->sincronizar($args);
            if($_FILES["propiedad"]["tmp_name"]["imagen"]) {
                $oldImage = $propiedad->imagen;
                $fileName = $_FILES["propiedad"]["name"]["imagen"];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $numero_10_digitos_aleatorio = rand(); 
                $nombre_imagen = md5( uniqid( $numero_10_digitos_aleatorio, true ) ) . "." . $fileExtension; 
                $propiedad->setImagen($nombre_imagen);
            }
            $errores = $propiedad->validar();
            if(empty($errores)) {            
                // si el usuario quiere cambiar la imagen, elimino la anterior del servidor
                if(isset($oldImage)) {
                    $propiedad->deleteImage($oldImage);
                    // ajusto y almaceno la nueva imagen en el disco duro
                    $image = Image::make($_FILES["propiedad"]["tmp_name"]["imagen"])->fit(800, 600);    
                    $image->save(CARPETA_IMAGENES. $nombre_imagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render("propiedades/actualizar", [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores,
            "errores" => $errores
        ]);
    }
    public static function eliminar() {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // verificamos que haya llegado un int (evitamos inyeccion SQL, ya que se puede modificar el value del input:hidden - chequeado que funciona)
            if($id){  
                $tipo = $_POST["tipo"];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }   
            } 
        }
    }
} // VIDEO 399