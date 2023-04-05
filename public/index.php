<?php 

require_once __DIR__ . "/../includes/app.php";

use MVC\Router; 
use Controllers\PropiedadController; 

$router = new Router();

$router->get("/admin", [PropiedadController::class, "index"]); 
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->post("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/eliminar", [PropiedadController::class, "eliminar"]);
// $router->get() -> VIDEO 398

$router->comprobarRutas();

/* 

Ref. Phyton Developer Jr. (referido) 

Buenas tardes,

Mi nombre es Lionel Prats y soy desarrollador web con conocimiento y experiencia tanto en front como en back.

Me avisó Pablo Antunez de la búsqueda de referencia que están realizando.

Me interesa la propuesta, me gustaría ser tenido en cuenta.

Adjunto mi CV con mis datos de contacto.

Desde ya muchas gracias. 

Quedo a disposición.

Saludos.




*/