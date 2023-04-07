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

         // se puede acceder a una explicacion mas detallada de toda esta configuracion en z.notas.txt -> VIDEO 425 
         
         $mail = new PHPMailer(true);

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
         $mail->addAddress('bsastop@gmail.com', 'BsAs Top');
         $mail->Subject = 'Ref. Dev Python Jr.';

         // Habilitar HTML
         $mail->isHTML(true);     
         $mail->CharSet = "UTF-8";

         // Definir el contenido 
         $contenido = "<h1><p>Adjunto <span style=\"color:green;\">mi CV</span>. Saludos!</p></h1>";
         $mail->Body = $contenido;
         $mail->AltBody = "Adjunto mi CV. Saludos!";

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