<?php 

require_once __DIR__ . "/../includes/app.php";

use MVC\Router; 
use Controllers\LoginController;
use Controllers\PaginasController;
use Controllers\VendedorController; 
use Controllers\PropiedadController; 

$router = new Router();

$router->get("/admin", [PropiedadController::class, "index"]); 

// $router->get() -> VIDEO 398

// zona privada - solo usuarios autenticados - CRUD propiedades
$router->get("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->post("/propiedades/crear", [PropiedadController::class, "crear"]);
$router->get("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/actualizar", ["Controllers\PropiedadController", "actualizar"]);
$router->post("/propiedades/eliminar", [PropiedadController::class, "eliminar"]);

// zona privada - solo usuarios autenticados - CRUD vendedores
$router->get("/vendedores/crear", [VendedorController::class, "crear"]);
$router->post("/vendedores/crear", [VendedorController::class, "crear"]);
$router->get("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
$router->post("/vendedores/actualizar", [VendedorController::class, "actualizar"]);
$router->post("/vendedores/eliminar", [VendedorController::class, "eliminar"]);

// zona publica - todos los usuarios
$router->get("/", [PaginasController::class, "index"]);
$router->get("/nosotros", [PaginasController::class, "nosotros"]);
$router->get("/propiedades", [PaginasController::class, "propiedades"]);
$router->get("/propiedad", [PaginasController::class, "propiedad"]);
$router->get("/blog", [PaginasController::class, "blog"]);
$router->get("/entrada", [PaginasController::class, "entrada"]);
$router->get("/contacto", [PaginasController::class, "contacto"]);
$router->post("/contacto", [PaginasController::class, "contacto"]);
$router->get("/contacto2", [PaginasController::class, "contacto2"]);
$router->post("/contacto2", [PaginasController::class, "contacto2"]);

// login y autenticacion
$router->get("/login", [LoginController::class, "login"]);
$router->post("/login", [LoginController::class, "login"]);
$router->get("/logout", [LoginController::class, "logout"]);

$router->comprobarRutas();

//echo "<hr>luego de renderizar una vista, se sigue ejecutando el codigo PHP de este archivo";