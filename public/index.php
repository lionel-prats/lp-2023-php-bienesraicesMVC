<?php 

require_once __DIR__ . "/../includes/app.php";

use MVC\Router; 
use Controllers\PropiedadController; 
use Controllers\VendedorController; 

$router = new Router();

$router->get("/admin", [PropiedadController::class, "index"]); 

// $router->get() -> VIDEO 398

// CRUD propiedades
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->post("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/eliminar", [PropiedadController::class, "eliminar"]);

// CRUD vendedores
$router->get("/vendedores/crear", [VendedorController::class, "crear"]);
$router->post("/vendedores/crear", [VendedorController::class, "crear"]);
$router->get("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
$router->post("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
$router->post("/vendedores/eliminar", [VendedorController::class, "eliminar"]);

$router->comprobarRutas();