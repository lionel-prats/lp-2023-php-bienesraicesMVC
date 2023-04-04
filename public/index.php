<?php 

require_once __DIR__ . "/../includes/app.php";

use MVC\Router; 
use Controllers\PropiedadController; 

$router = new Router();

//debuguear(PropiedadController::class);

$router->get("/admin", [PropiedadController::class, "index"]); 
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
// $router->get() -> VIDEO 398

//debuguear($router->rutasGET);
$router->comprobarRutas();