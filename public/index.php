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