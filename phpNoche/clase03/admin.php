<?php

require_once "./clases/personaStandar.php";
require_once "./clases/personasDao.php";
        $nombre = $_POST['nombre'];
        $apellido=$_POST['apellido'];
        $legajo = $_POST['legajo'];
//$request = $_SERVER['REQUEST_METHOD'];
$opt = 'LISTAR';
switch ($opt) {
    case 'ALTA':
    $obj = new personaStandar($nombre,$apellido,$legajo);
    if (personasDao::Guardar($obj))
    {
        echo "Alta correcta";    
    }
           
        break;
    case 'LISTAR':
    echo "<p> LISTAR </p>";
    $array = personasDao::listarTodos();
    for ($i=0; $i <count($array) ; $i++) 
    { 
        echo "hola ".$array[$i]->nombre. " ". $array[$i]->apellido." ".$array[$i]->legajo;
    }
        break;
    default:
        break;
}

