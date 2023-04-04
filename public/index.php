<?php 

require_once __DIR__ . "/../includes/app.php";

use MVC\Router; 

$router = new Router();

$router->get("/", "homeController"); 
$router->get("/contacto", "contactController");
$router->get("/nosotros", "aboutController");
$router->get("/tienda", "marketController");
// $router->get() -> VIDEO 398

$router->comprobarRutas();