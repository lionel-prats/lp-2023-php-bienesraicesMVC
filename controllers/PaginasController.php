<?php 

namespace Controllers;

//use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use Helpers\FormValidate;
use stdClass;

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

      $response = new FormValidate(); // instancia de FormValidate
      $errors = []; // GET -> array para los mensajes de error de la vista 

      if($_SERVER["REQUEST_METHOD"] === "POST") {

         $respuestas = $_POST["contacto"];
         
         $response = new FormValidate($respuestas); // POST -> instancia de FormValidate, pasandole un array con la info de todos los campos del form enviados por el usuario

         // $validations -> array con los campos del form que queremos validar, los tipos de validaciones, y el mensaje de error (en caso de haber) para cada tipo de validacion
         $validations = [
            "nombre" => [
               "empty" => "Debes ingresar un nombre de contacto"
            ], 
            "mensaje" => [
               "empty" => "Debes ingresar un mensaje"
            ], 
            "tipo" => [
               "empty" => "Debes seleccionar un tipo de operación"
            ], 
            "precio" => [
               "empty" => "Debes indicar un presupuesto estimado"
            ],
            "contacto" => [
               "empty" => "Debes seleccionar una forma de contacto"
            ]
         ];
         if(isset($respuestas["contacto"]) and $respuestas["contacto"] === "telefono") {
            $min = 8;
            $max = 10;
            $validations["telefono"] = [
               "empty" => "Debes ingresar un teléfono de contacto",
               "int_min_max" => [$min, $max, "Debes ingresar solo números (entre $min y $max dígitos)"]
            ];
         } elseif(isset($respuestas["contacto"]) and $respuestas["contacto"] === "email") {
            $validations["email"] = [
               "empty" => "Debes ingresar un email de contacto", 
               "email" => "El mail ingresado no es válido" 
            ];
         }
         // fin array $validations

         $errors = $response->validate($validations);

         $mensaje = null;

         if(empty($errors)) {
            
            // se puede acceder a una explicacion mas detallada de toda esta configuracion en z.notas.txt -> VIDEO 425 

            $mail = new PHPMailer();

            $mail->isSMTP(); // para decirle que vamos a usar SMTP para envio de correos 
            $mail->Host = 'sandbox.smtp.mailtrap.io'; // especificamos el dominio (es ek host de Mailtrap (?))  
            $mail->SMTPAuth = true; // decimos que nos vamos a autenticar
            $mail->Username = 'a65ab5083ded37'; // usuario 
            $mail->Password = 'e3ffbe3f60333a'; // password 
            $mail->SMTPSecure = "tls"; 
            $mail->Port = 2525; // el puerto sobre el cual se va a conectar 
            
            // Configurar el contenido del email
            // Destinatario y asunto 
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar HTML
            $mail->isHTML(true);     
            $mail->CharSet = "UTF-8";

            $contenido = "<html>";
            $contenido .= "<p style='font-weiht: bold;'>Tienes un nuevo mensaje</p>";
            $contenido .= "<p>Nombre: ". $response->nombre ."</p>";
            $contenido .= "<p>Forma de contacto: ". $response->contacto ."</p>";
            // enviar de forma condicional algunos campos de email y telefono
            if($response->contacto === "telefono") {
               $contenido .= "<p>Teléfono: ". $response->telefono ."</p>";
               if($response->fecha) {
                  $date_formated = date('d-m-Y', strtotime($response->fecha));
                  $contenido .= "<p>Fecha para ser contactado: ". $date_formated ."</p>";
               } else {
                  $contenido .= "<p>Fecha para ser contactado: No seleccionada. </p>";
               }
               if($response->hora) {
                  $contenido .= "<p>Horario para ser contactado: ". $response->hora ."</p>";
               } else {
                  $contenido .= "<p>Horario para ser contactado: No seleccionado. </p>";
               }
            } else {
               $contenido .= "<p>Email: ". $response->email ."</p>";
            } 
            $contenido .= "<p>Vende o Compra: ". $response->tipo ."</p>";
            $contenido .= "<p>Precio o Presupuesto: $". $response->precio ."</p>";
            $contenido .= "<p>Mensaje: ". $response->mensaje ."</p>";
            $contenido .= "</html>";

            $mail->Body = $contenido;
            $mail->AltBody = $contenido;

            // Enviar el email 
            if($mail->send()) {
            // el metodo send() nos retorna TRUE si el formulario se envió correctamente al servidor de mails y FALSE si no se envió
               $mensaje = "Mensaje Enviado Correctamente";
            } else {
               $mensaje = "El Mensaje No Se Pudo Enviar";
            }
         }
      }
      $router->render("/paginas/contacto", [
         "errors" => $errors,
         "response" => $response,
         "mensaje" => $mensaje,
      ]);
   }
}