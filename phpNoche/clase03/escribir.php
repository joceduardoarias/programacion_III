<?php
// con el modo w si no existe lo crea y si existe lo sobreescribe
//fopen: el primer parametro puede ser el nombre o la ruta/nombre donde se quiere guardar 
//constante para hacer un salto de linea PHP_EOL estandar y que funcione en win,mac y linux.
$nombre = $_POST['nombre'];
$apellido=$_POST['apellido'];
$legajo = $_POST['legajo'];
$file = fopen("archivo.txt","a");
$cant = fwrite($file,$nombre." - ".$apellido." - ".$legajo.PHP_EOL);

fclose($file);