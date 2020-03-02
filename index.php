<?php
/** 
 * La diferencia entre require y include, esta sijeta al tratamiento del error.
 * include permite que el codigo siga ejecutandose y mostrara un warning, pero require detiene la 
 * ejecucion mostrando un fatal error.
 * */   
include ("./entidades/usuario.php");
include ("./entidades/DAO.php");
include ("./archivos/archivos.php");
$path = 'C:\xampp\htdocs\backend\PP\usuarios.json';
// $archivos = new archivos();
$DAO = new DAO();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($_POST["tipo"]) {
        case 'alta':
            $usuario = new usuario($_POST["legajo"],$_POST["email"],$_POST["nombre"],$_POST["clave"],$_POST["img"],$path);
            if (!$DAO->Alta($usuario,$path)) {
                echo "Ya esta registrado o el archivo no existe!!!";
               } else {
                   echo "Alta exitosa";
               }
            break;
        
        default:
            # code...
            break;
    }
  
} else {
    # code...
}

/**
 * El Alta funciona sin la carga de imagenes!!! 
 */