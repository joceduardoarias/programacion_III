<?php

include "funciones.php";
require_once "funciones.php"; //llamamos a la misma libreria pero con el once evitamos una doble llmadad 
//require_once "clases/persona.php";
require "./clases/alumno.php";

$persona = new persona ("jorge", 123456);

$persona->saludar();

$alumno = new alumno (1,20191,"jose arias",123456);
echo "<br>";
$alumno->saludar();