<?php
require "./clases/personaStandar.php";
// leer linea por linea-> echo fgets($file);

$file=fopen("archivo.txt",'r');
$array = array();
$aux = array();
while (!feof($file))//leer hasta llegar al final del archivo 
{
    $string= fgets($file);// leer linea por linea
    $aux = explode("-",$string);
    $obj = new personaStandar($aux[0],$aux[1],$aux[2]);
    array_push($array,$obj);    
}
//var_dump($array);
for ($i=0; $i <count($array) ; $i++) 
{ 
    echo "hola ".$array[$i]->nombre. " ". $array[$i]->apellido." ".$array[$i]->legajo;
}

fclose($file);


