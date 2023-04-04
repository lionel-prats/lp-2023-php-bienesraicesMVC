<?php 

// URL -> http://localhost:3000/prueba.autoload.video.396.php

/*
// bloque de codigo (VIDEOS 354 y 355)
// este script detecta las posibles invocaciones a una clase dentro del archivo donde se ejecuta y permite que se puedan cargar correctamente
// prueba -> comentar este script y comprobar como falla
function autoload($class) {
    $nameClass = explode("\\", $class);
    require __DIR__ . "/../models/" . $nameClass[1] . ".php";
}
spl_autoload_register("autoload");
// fin bloque de codigo
*/

// VIDEO 358
//require "../vendor/autoload.php";
//require __DIR__ . '/../vendor/autoload.php';
//en este ejemplo, cualquiera de las dos formas de require son validas

require_once __DIR__ . "/../includes/app.php";
// esto funciona porque app.php tiene un require de autoload.php

use Model\ActiveRecord;
use Model\Prueba;

$activeRecord = new ActiveRecord();
$prueba = new Prueba();

echo "prueba.autoload.video.396.php -> se instanciaron las 2 clases correctamente...";