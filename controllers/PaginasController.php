<?php 

namespace Controllers;

//use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

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
      if($_SERVER["REQUEST_METHOD"] === "POST") {

         $respuestas = $_POST["contacto"];

         // se puede acceder a una explicacion mas detallada de toda esta configuracion en z.notas.txt -> VIDEO 425 

         $mail = new PHPMailer();

         $mail->isSMTP(); // para decirle que vamos a usar SMTP para envio de correos 
         $mail->Host = 'sandbox.smtp.mailtrap.io'; // especificamos el dominio   
         $mail->SMTPAuth = true; // decimos que nos vamos a autenticar
         $mail->Username = 'a65ab5083ded37'; // usuario 
         $mail->Password = 'e3ffbe3f60333a'; // password 
         $mail->SMTPSecure = "tls"; 
         $mail->Port = 2525; // el puerto sobre el cual se va a conectar 
         
         // Configurar el contenido del email
         // Destinatario y asunto 
         $mail->setFrom('danimerlo@yahoo.com.ar');
         $mail->addAddress('lionel.prats.c@gmail.com', 'BsAs Top');
         $mail->Subject = 'Ref. Dev Python Jr.';

         // Habilitar HTML
         $mail->isHTML(true);     
         $mail->CharSet = "UTF-8";

         // Definir el contenido 
         $contenido = "<h1><p>Adjunto <span style=\"color:green;\">mi CV</span>. Saludos!</p></h1>";

         $contenido = "<html>";
         $contenido .= "<p>Tienes un nuevo mensaje</p>";
         $contenido .= "<p>Nombre: ". $respuestas["nombre"] ."</p>";
         $contenido .= "<p>Email: ". $respuestas["email"] ."</p>";
         $contenido .= "<p>Teléfono: ". $respuestas["telefono"] ."</p>";
         $contenido .= "<p>Mensaje: ". $respuestas["mensaje"] ."</p>";
         $contenido .= "<p>Vende o Compra: ". $respuestas["tipo"] ."</p>";
         $contenido .= "<p>Precio o Presupuesto: $". $respuestas["precio"] ."</p>";
         $contenido .= "<p>Prefiere ser contactado por: ". $respuestas["contacto"] ."</p>";
         $contenido .= "<p>Fecha de Contacto: ". $respuestas["fecha"] ."</p>";
         $contenido .= "<p>Hora: ". $respuestas["hora"] ."</p>";
         $contenido .= "</html>";

         /* echo $contenido;
         debuguear(""); */

         $mail->Body = $contenido;
         $mail->AltBody = $contenido;;

         // Enviar el email 
         if($mail->send()) {
         // el metodo send() nos retorna TRUE si se envió el mail y FALSE si no se envió
            echo "Mensaje Enviado Correctamente";
         } else {
            echo "El Mensaje No Se Pudo Enviar";
         }
      }
      $router->render("/paginas/contacto");
   }
}